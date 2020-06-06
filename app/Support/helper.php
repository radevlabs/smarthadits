<?php

use Carbon\Carbon;
use \Illuminate\Support\Str;
use \Illuminate\Support\Facades\Route;
use Intervention\Image\Facades\Image;

if (!function_exists('hari')) {
    /**
     * Mendapatkan nama hari dari object carbon
     *
     * @param \Carbon\Carbon $carbon
     * @return string
     */
    function hari($carbon)
    {
        $daftarHari = [
            'Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'
        ];

        return $daftarHari[$carbon->dayOfWeek];
    }
}

if (!function_exists('bulan')) {
    /**
     * Mendapatkan nama bulan dari object carbon
     *
     * @param \Carbon\carbon $carbon
     * @return string
     */
    function bulan($carbon)
    {
        $daftarBulan = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        return $daftarBulan[$carbon->month - 1];
    }
}

if (!function_exists('zero_prefix')) {
    /**
     * Memberi tambahan 0 pada angka yang lebih kecil dari 10
     *
     * @param int $number
     * @return string
     */
    function zero_prefix($number)
    {
        if ($number < 10)
            return '0' . $number;

        return $number;
    }
}

if (!function_exists('format_date')) {
    /**
     * Melakukan formatting tanggal
     *
     * @param Carbon $carbon
     * @return string
     */
    function format_date(Carbon $carbon, $namaHari = false, $jam = true, $splitterHari = ', ')
    {
        return ($namaHari ? hari($carbon) . $splitterHari : '') . zero_prefix($carbon->day) . ' ' . bulan($carbon) . ' ' . $carbon->year . ($jam ? ', ' . zero_prefix($carbon->hour) . ':' . zero_prefix($carbon->minute) : '');
    }

}

if (!function_exists('parse_post')) {
    function parse_post($posts)
    {
        $posts->each(function ($post, $key) {
            preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $post->isi, $image);
            $post->thumbnail = isset($image['src']) ? $image['src'] : 'img/not-available.png';
            preg_match("/(?:\w+(?:\W+|$)){0,50}/", strip_tags($post->isi), $isi);
            $post->summary = $isi[0];
            preg_match("/(?:\w+(?:\W+|$)){0,10}/", strip_tags($post->isi), $singkat);
            $post->brief = $singkat[0] . ' ...';
        });

        return $posts;
    }
}

if (!function_exists('number_to_roman')) {
    function number_to_roman($number)
    {
        $map = array('M' => 1000, 'CM' => 900, 'D' => 500, 'CD' => 400, 'C' => 100, 'XC' => 90, 'L' => 50, 'XL' => 40, 'X' => 10, 'IX' => 9, 'V' => 5, 'IV' => 4, 'I' => 1);
        $returnValue = '';
        while ($number > 0) {
            foreach ($map as $roman => $int) {
                if ($number >= $int) {
                    $number -= $int;
                    $returnValue .= $roman;
                    break;
                }
            }
        }
        return $returnValue;
    }
}

if (!function_exists('number_to_word')) {
    function number_to_word($number)
    {
        return (new NumberFormatter("id", NumberFormatter::SPELLOUT))->format($number);
    }
}

if (!function_exists('array_to_string')) {
    function array_to_string($array, $splitter = ', ', $lastSplitter = ' and ')
    {
        $string = implode($splitter, $array);
        $string = str_replace($splitter . last($array), $lastSplitter . last($array), $string);

        return $string;
    }
}

if (!function_exists('boolean_print')) {
    function boolean_print($bool)
    {
        return $bool ? 'Ya' : 'Tidak';
    }
}

if (!function_exists('asset_exists')) {
    function asset_exists($path)
    {
        if (empty($path)){
            return false;
        }

        return file_exists(public_path($path));
    }
}

if (!function_exists('fill_empty')) {
    function fill_empty($var, $fill)
    {
        return empty($var) ? $fill : $var;
    }
}

if (!function_exists('str_singular')) {
    function str_singular($value)
    {
        return Str::singular($value);
    }
}

if (!function_exists('camel_case')) {
    function camel_case($value)
    {
        return Str::camel($value);
    }
}

if (!function_exists('is_current_route')){
    function is_current_route($routeName, $mustMatch = true)
    {
        if ($mustMatch) {
            return Route::currentRouteName() == $routeName;
        }

        return Str::contains(Route::currentRouteName(), $routeName);
    }
}

if (!function_exists('rupiah')){
    function rupiah($angka)
    {
        $hasil_rupiah = "Rp " . number_format($angka,0,',','.');
        return $hasil_rupiah;
    }
}

if (!function_exists('scan_whole_dir')) {
    function scan_whole_dir($path)
    {
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($path));
        $iterator = iterator_to_array($iterator);
        $dirs = array_keys($iterator);

        return collect($dirs);
    }
}

if (!function_exists('badge')) {
    function badge($text)
    {
        $badges = collect(['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark']);

        return '<span class="badge badge-'.$badges->random().'">'.$text.'</span>';
    }
}

if (!function_exists('base64_file_size')){
    function base64_file_size($base64String, $sizeType = 'KB')
    {
        $fileSize = strlen(base64_decode($base64String));
        if ($sizeType == 'KB'){
            $fileSize = $fileSize / 1024;
        } elseif ($sizeType == 'MB') {
            $fileSize = $fileSize / 1024 / 1024;
        }

        return $fileSize;
    }
}

if (!function_exists('base64_compress')){
    function base64_compress($base64String, $maxExpectedKBSize = 512)
    {
        if (base64_file_size($base64String) <= $maxExpectedKBSize) {
            return $base64String;
        }

        foreach ([0.6, 04, 0.35, 0.25, 0.1] as $quality){
            $img = Image::make($base64String);
            $img->resize(
                (int)floor($img->width() * $quality),
                (int)floor($img->height() * $quality)
            );
            $img = (string)$img->encode('data-url');

            if (base64_file_size($img) <= $maxExpectedKBSize) {
                return $img;
            }
        }

        return $img;
    }
}

if (!function_exists('lang')){
    function lang($language = null)
    {
        if (!empty($language)){
            session()->put('lang', $language);
        }

        if (!session()->has('lang')) {
            session()->put('lang', 'id');
        }

        $language = session('lang')[0];
        $language = (strlen($language) == 1) ? session('lang') : $language;

        return $language;
    }
}

if (!function_exists('route_name')){
    function route_name($url){
        return Route::match(['get', 'post', 'delete', 'patch', 'put'], $url)->getName();
    }
}

if (!function_exists('smadmenu')){
    function smadmenu($lang = null)
    {
        $lang = $lang == null ? lang() : $lang;

        $menu = [
            'id' => ['Beranda', 'Portofolio',
                'Produk',
                'Desain',
                'Blog', 'Hubungi Kami'],
            'en' => ['Home', 'Portofolio',
                'Product',
                'Design',
                'Blog', 'Contact Us']
        ];

        $routeNames = ['profile.home', 'profile.portofolio',
            'profile.product',
            'profile.design',
            'profile.blog', 'profile.contact'];

        return collect($routeNames)->combine($menu[$lang]);
    }
}

if (!function_exists('slugify')){
    function slugify($text){
        return Str::slug($text);
    }
}

if (!function_exists('overview')){
    function overview($text, int $maxAlphabet = 20, $addText = ' ...'){
        if (strlen($text) <= $maxAlphabet){
            return $text;
        }

        return substr($text, 0, $maxAlphabet).$addText;
    }
}

if (!function_exists('narrator')){
    function narrator($text)
    {
        if (count(explode(']', collect(explode('[', $text))->last())) == 1){
            $text = $text.']';
        }

        $text = str_replace('[', '<b>', $text);
        $text = str_replace(']', '</b>', $text);

        return $text;
    }
}

if (!function_exists('nasab')){
    function nasab($text)
    {
        $text = str_replace('binti', 'bin', $text);

        return array_reverse(explode('bin', $text));
    }
}

if (!function_exists('raw_statement')){
    function query_statement($query, $dump = false)
    {
        $sql_str = $query->toSql();
        $bindings = $query->getBindings();

        $wrapped_str = str_replace('?', "'?'", $sql_str);

        return Str::replaceArray('?', $bindings, $wrapped_str);
    }
}

if (!function_exists('remove_diacritic')){
    function remove_diacritic($text)
    {
        $diacritics = ['ِ', 'ُ', 'ٓ', 'ٰ', 'ْ', 'ٌ', 'ٍ', 'ً', 'ّ', 'َ'];
        $text = str_replace($diacritics, '', $text);

        return $text;
    }
}
