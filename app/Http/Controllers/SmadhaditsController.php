<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Guest;
use App\Models\Hadith;
use App\Models\Narrator;
use App\Models\Path;
use App\Models\Priest;
use App\Models\Validity;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Sastrawi\Stemmer\StemmerFactory;

class SmadhaditsController extends Controller
{
    public function index()
    {
        Guest::init();

        $category = Category::query()
            ->whereIn('id', [1, 2, 8, 9, 10])
            ->get()
            ->random();

        $hadith = $category->hadiths()
            ->where('ambiguism', false)
            ->whereIn('validity_id', [1, 2, 3])
            ->whereHas('languages', function ($query) {
                return $query->whereRaw('length(hadith_languages.content) <= 600')
                    ->where('name', 'Indonesia');
            })->inRandomOrder()
            ->first();

        return view('pages.home', [
            'hadith' => $hadith,
            'category' => $category
        ]);
    }

    public function priest(Request $request)
    {
        Guest::init();

        $priests = Priest::query()
            ->whereHas('books.chapters.hadiths', function ($query) {
                return $query->where('ambiguism', false)
                    ->where('validity_id', '!=', 5);
            })->get();

        $validities = Validity::query()
            ->where('id', '!=', 5)
            ->get();

        return view('pages.priest', [
            'priests' => $priests,
            'validities' => $validities
        ]);
    }

    public function hadith(Request $request, $priest)
    {
        Guest::init();

        $priest = Priest::query()
            ->select(['id', 'name'])
            ->get()
            ->filter(function ($value, $key) use ($priest) {
                return slugify($value->name) == $priest;
            });

        if ($priest->count() == 0){
            return abort(404);
        }

        $priest = $priest->first();

        $vs = ['shahih', 'hasan', 'dhaif', 'maudhu'];

        $v = strtolower($request->v);
        $v = !in_array($v, $vs) ? null : $v;

        $npaths = Path::query()
            ->select(DB::raw('distinct count(hadith_id) as n'))
            ->whereIn('hadith_id', function ($query) use ($priest) {
                $statement = $priest->hadiths([1, 2, 3, 4], false)
                    ->select('id');
                $statement = query_statement($statement);
                $statement = substr($statement, 7);

                return $query->select(DB::raw($statement));
            })->groupBy('hadith_id')
            ->orderBy('n')
            ->get()
            ->pluck('n')
            ->toArray();

        $npath = $request->npath;
        $npath = !in_array($npath, $npaths) ? null : $npath;

        $hadiths = $priest->hadiths([1, 2, 3, 4], false)
            ->when($npath, function ($query) use ($npath) {
                return $query->has('paths', $npath);
            })->when($v, function ($query) use ($v) {
                return $query->whereHas('validity', function ($query) use ($v) {
                    return $query->where('name', $v);
                });
            })->with(['languages' => function ($query) {
                return $query->where('name', 'Indonesia');
            }])->paginate(10)
            ->appends($request->all());

        return view('pages.hadith', [
            'hadiths' => $hadiths,
            'priest' => $priest,
            'v' => $request->v,
            'vs' => $vs,
            'npath' => $npath,
            'npaths' => $npaths
        ]);
    }

    public function hadithDetail(Request $request, $priest, $no)
    {
        Guest::init();

        $priest = Priest::all()
            ->filter(function ($value, $key) use ($priest) {
                return slugify($value->name) == $priest;
            });

        if ($priest->count() == 0){
            return abort(404);
        }

        $priest = $priest->first();

        $hadith = $priest->hadiths()
            ->where('no', $no)
            ->get();

        if ($hadith->count() == 0){
            return abort(404);
        }

        $hadith = $hadith->first();

        return view('pages.hadith-detail', [
            'hadith' => $hadith,
            'priest' => $priest
        ]);
    }

    public function classification(Request $request)
    {
        Guest::init();

        return view('pages.classification', []);
    }

    public function classificationResult(Request $request)
    {
        Guest::init();

        $hadith = $request->hadith;
        $hadith = mb_convert_encoding($hadith, "ASCII");

        try{
            $client = new Client();
            $result = $client->post('http://api.smadhadits.smadia.id/', [
                'form_params' => [
                    'hadith' => $hadith
                ]
            ]);
            $result = $result->getBody()
                ->getContents();
            $result = json_decode($result);
        } catch (ClientException $exception){
            return $exception->getResponse()->getBody()->getContents();
        } catch (ServerException $exception){
            return $exception->getResponse()->getBody()->getContents();
        }

        $narrators = [];
        foreach ($result->narrators as $narrator){
            $narrator = ucwords($narrator);
            $narrator = str_replace('Bin', 'bin', $narrator);
            $narrator = str_replace('Binti', 'binti', $narrator);
            $narrators[] = $narrator;
        }
        $chadith = narrator($result->cleaned_hadith);
        $result = $result->result;

        return view('pages.classification-detail', [
            'narrators' => $narrators,
            'chadith' => $chadith,
            'result' => $result,
            'hadith' => $request->hadith
        ]);
    }

    public function retrieval(Request $request)
    {
        Guest::init();

        $mode = $request->mode;
        $mode = (in_array(strtolower($mode), ['match', 'full-text-search'])) ? $mode : 'full-text-search';

        if (!empty($request->q)){
            if ($mode == 'match'){
                $hadiths = Hadith::query()
                    ->whereIn('id', function ($query) use ($request){
                        return $query->from('hadith_languages')
                            ->select('hadith_id')
                            ->where('content', 'like', "%$request->q%");
                    })->paginate(10)
                    ->appends($request->all());
            } else {
                $hadiths = Hadith::search($request->q)
                    ->paginate(10)
                    ->appends($request->all());
            }
        } else {
            $hadiths = [];
        }

        return view('pages.retrieval', [
            'hadiths' => $hadiths,
            'q' => $request->q,
            'mode' => $mode
        ]);
    }

    public function stats(Request $request)
    {
        $guests = Guest::query()
            ->orderByDesc('created_at')
            ->paginate(10)
            ->appends($request->all());

        return view('pages.stats', [
            'guests' => $guests
        ]);
    }
}
