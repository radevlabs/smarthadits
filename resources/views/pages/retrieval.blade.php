@extends('layouts.app')

@section('info')
    <p>
        Mode <i>match</i> menggunakan query sql pada umumnya sedangkan <i>full text search</i> menggunakan TNTSearch yang memiliki fitur:<br>
        - fuzzy search<br>
        - as you type functionality<br>
        - geo-search<br>
        - text-classification<br>
        - stemming<br>
        - custom tokenizers<br>
        - bm25 ranking algorithm<br>
        - boolean search<br>
        - result highlighting<br>
    </p>
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
                Pencarian Hadits
            </h2>
            <form action="{{ url()->current() }}">
                <div class="form-group">
                    <div class="form-group">
                        <label for="hadithtext">Masukkan potongan hadits</label>
                        <textarea name="q" class="form-control" id="hadithtext" rows="5">{{ $q }}</textarea>
                    </div>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="mode" value="match" @if($mode == 'match') checked @endif>
                        Match
                    </label>
                </div>
                <div class="form-check-inline">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="mode" value="full-text-search" @if($mode == 'full-text-search') checked @endif>
                        Full Text Search
                    </label>
                </div>
                <br><br>
                <button id="submit" class="btn btn-outline-dark">Retrieve</button>
            </form>
        </div>
        <div class="element">
            <h2 class="el-title">
                Hasil
            </h2>
            @foreach($hadiths as $hadith)
                <div class="zoom">
                    @include('layouts.hadith-overview', [
                        'hadith' => $hadith,
                        'overview' => 600
                    ])
                </div>
                <br>
            @endforeach
            <div class="table-responsive">
                @if(!empty($hadiths)) {{ $hadiths->links() }} @endif
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
