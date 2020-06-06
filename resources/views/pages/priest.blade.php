@extends('layouts.app')

@section('info')
    <p>Daftar hadits dari beberapa imam.</p>
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
            <h2 class="el-title">Imam</h2>
            <div class="row">
                @foreach($priests as $priest)
                    <div class="col-md-4" style="padding-left: 25px;padding-right: 25px">
                        <div class="zoom">
                            <a href="{{ route('hadith.priest.list', ['priest' => slugify($priest->name)]) }}" class="card shadow">
                                <div class="card-body text-center">
                                    <h5>{{ $priest->name }}</h5>
                                    <b style="color: black">
                                        {{ $priest->hadiths([1, 2, 3, 4], false)->count() }} hadits
                                    </b>
                                </div>
                            </a>
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
