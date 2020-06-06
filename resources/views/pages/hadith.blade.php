@extends('layouts.app')

@section('info')
    <button class="btn btn-outline-secondary" onclick="$('#p').toggle()">Biografi</button>
    <br><br>
    <p id="p">{!! str_replace("\n", '<br>', $priest->biography) !!}</p>
@endsection

@push('head')
    <style>
        .zoom {
            transition: transform .2s; /* Animation */
        }

        .zoom:hover {
            transform: scale(1.025); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
    </style>
@endpush

@section('content')
    <div class="elements-section">
        <div class="element">
            <h2 class="el-title">
                {{ $priest->name }}
                <br>
                <small><small><small>{{ $hadiths->total() }} hadits</small></small></small>
            </h2>
            <div>
                <a href="{{ route('hadith.priest.list', ['priest' => slugify($priest->name), 'npath' => $npath]) }}"
                   class="btn @if(!in_array(strtolower($v), ['shahih', 'hasan', 'dhaif', 'maudhu'])) btn-dark @else btn-outline-dark @endif">Semua Tingkat</a>
                @foreach($vs as $item)
                    <a href="{{ route('hadith.priest.list', ['priest' => slugify($priest->name), 'v' => $item, 'npath' => $npath]) }}" class="btn @if(strtolower($v) == $item) btn-dark @else btn-outline-dark @endif">{{ ucwords($item) }}</a>
                @endforeach
            </div>
            <br>
            <div>
                <a href="{{ route('hadith.priest.list', ['priest' => slugify($priest->name), 'v' => $v]) }}"
                   class="btn @if(!in_array($npath, $npaths)) btn-dark @else btn-outline-dark @endif"><span class="align-bottom">Semua Jalur</span></a>
                @foreach($npaths as $item)
                    <a href="{{ route('hadith.priest.list', ['priest' => slugify($priest->name), 'v' => $v, 'npath' => $item]) }}"
                       class="btn @if($npath == $item) btn-dark @else btn-outline-dark @endif">{{ $item }} Jalur</a>
                @endforeach
            </div>

            <br><br><br>
            @foreach($hadiths as $hadith)
                <div class="zoom">
                    <a target="_blank" href="{{ route('hadith.detail', [
                    'priest' => slugify($priest->name),
                    'no' => $hadith->no
                    ]) }}" class="card shadow"style="margin-left: 25px;margin-right: 25px" title="Detail">
                        <div class="card-body">
                            <p>
                                <b>{{ strtoupper($hadith->validity()->first()->name) }}</b> |
                                <b>Kitab: {{ $hadith->book()->first()->name }}</b> |
                                <b>Bab: {{ $hadith->chapter()->first()->name }}</b>
                            </p>
                            <p>{!! narrator(overview($hadith->languages[0]->pivot->content, 500)) !!}</p>
                        </div>
                    </a>
                </div>
                <br>
            @endforeach
            <div class="table-responsive">
                {{ $hadiths->links() }}
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        setTimeout(function () {
            $('#p').hide()
        }, 500)
    </script>
@endpush
