@extends('layouts.app')

@push('head')
    <style>
        .zoom {
            transition: transform .2s; /* Animation */
        }

        .zoom:hover {
            transform: scale(1.025); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
        }
        /* Timeline holder */
        ul.timeline {
            list-style-type: none;
            position: relative;
            padding-left: 1.5rem;
        }

        /* Timeline vertical line */
        ul.timeline:before {
            content: ' ';
            background: #fff;
            display: inline-block;
            position: absolute;
            left: 16px;
            width: 4px;
            height: 100%;
            z-index: 400;
            border-radius: 1rem;
        }

        li.timeline-item {
            margin: 20px 0;
        }

        /* Timeline item arrow */
        .timeline-arrow {
            border-top: 0.5rem solid transparent;
            border-right: 0.5rem solid #fff;
            border-bottom: 0.5rem solid transparent;
            display: block;
            position: absolute;
            left: 2rem;
        }

        /* Timeline item circle marker */
        li.timeline-item::before {
            content: ' ';
            background: #ddd;
            display: inline-block;
            position: absolute;
            border-radius: 50%;
            border: 3px solid #fff;
            left: 11px;
            width: 14px;
            height: 14px;
            z-index: 400;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush

@section('info')
    <h3>
        {{ $priest->name }} -
        {{ $hadith->chapter()->first()->book()->first()->name }} -
        {{ $hadith->chapter()->first()->name }}
    </h3>
@endsection

@section('content')
    <div class="elements-section">
        <div class="element">
            <h2 class="el-title">No. {{ $hadith->no }}</h2>
            @php $summary = '-' @endphp
            @foreach($hadith->languages()->get() as $language)
                <h5>{{ $language->name }}</h5>
                <blockquote class="blockquote @if(\Illuminate\Support\Str::contains($language->name, 'Arab')) text-right @endif">
                    {!! narrator(explode(':', $language->pivot->content, 2)[1]) !!}
                </blockquote>
                <p class="@if(\Illuminate\Support\Str::contains($language->name, 'Arab')) text-right @endif">{{ $language->pivot->summary }}</p>
            @endforeach
            <blockquote class="blockquote text-right">
                <footer class="blockquote-footer">
                    {{ $hadith->chapter()->first()->book()->first()->priest()->first()->name }}
                    <cite title="Source Title">
                        {{ $hadith->chapter()->first()->book()->first()->name }} -
                        {{ $hadith->chapter()->first()->book()->first()->name }} -
                        No. {{ $hadith->no }} -
                        <span class="badge badge-dark">{{ strtoupper($hadith->validity()->first()->name) }}</span><br>
                    </cite>
                </footer>
            </blockquote>
        </div>
        <div class="element">
            <h2 class="el-title">Sanad</h2>
            <div class="tab-element">
                <div class="row">
                    <div class="col-md-3">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            @foreach($hadith->paths()->orderBy('order')->get() as $path)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->iteration == 1) active @endif" id="{{ $path->id }}-tab"
                                       data-toggle="tab" href="#tab-{{ $path->id }}" role="tab"
                                       aria-controls="tab-{{ $path->id }}"
                                       onclick="$('#info').html('Jalur {{ $path->order }} ({{ $path->narrators()->count() }} perawi)')"
                                       aria-selected="@if($loop->iteration == 1) true @else false @endif">
                                        Jalur {{ $path->order }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-md-9">
                        @php $path = $hadith->paths()->orderBy('order')->first() @endphp
                        <h3 id="info">Jalur {{ $path->order }} ({{ $path->narrators()->count() }} perawi)</h3>
                        <div class="tab-content" id="myTabContent">
                            @foreach($hadith->paths()->orderBy('order')->get() as $path)
                                <div class="tab-pane fade @if($loop->iteration == 1) show active @endif"
                                     id="tab-{{ $path->id }}" role="tabpanel" aria-labelledby="tab-{{ $path->id }}">
                                    <!-- Timeline -->
                                    <ul class="timeline">
                                        @foreach($path->narrators()->orderBy('path_narrators.order')->get() as $narrator)
                                            <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                                                <div class="timeline-arrow"></div>
                                                <div class="row">
                                                    <div class="col-md-1 col-sm-1 col-xl-1">
                                                        @if($loop->iteration <= 9)
                                                            <h1 class="text-center">{{ $narrator->pivot->order }}</h1>
                                                        @else
                                                            <h2 class="text-center">{{ $narrator->pivot->order }}</h2>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-11 col-sm-11 col-xl-11">
                                                        <h2 class="h5 mb-0">
                                                            {{ $narrator->name }}
                                                        </h2>
                                                        <p class="text-small mt-2 font-weight-light">
                                                            @php $s = '' @endphp
                                                            @foreach(nasab($narrator->name) as $name)
                                                                @php $s = $s.badge($name).' <b>></b> ' @endphp
                                                            @endforeach
                                                            {!! substr($s, 0, -9) !!}
                                                        </p>
                                                        <p class="text-small mt-2 font-weight-light">
                                                            @if(!empty($_ = $narrator->circle()->first()))
                                                                {!! badge('Kalangan: '.($_->name ?? '-')) !!}
                                                            @endif

                                                            {!! badge('Kuniyah: '.($narrator->kuniyah ?? '-')) !!}

                                                            {!! badge('Laqob: '.($narrator->laqob ?? '-')) !!}

                                                            {!! badge('Nasab: '.($narrator->lineage ?? '-')) !!}

                                                            @if(!empty($_ = $narrator->liveCountry()->first()))
                                                                {!! badge('Negara - hidup: '.$_->name ?? '-') !!}
                                                            @endif

                                                            @if(!empty($_ = $narrator->deadCountry()->first()))
                                                                {!! badge('Negara - wafat: '.$_->name ?? '-') !!}
                                                            @endif

                                                            {!! badge('Wafat: '.($narrator->dead_at ?? '-')) !!}
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul><!-- End -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($hadith->similiars()->count() != 0)
            <div class="element">
                <h2 class="el-title">Hadits Serupa</h2>
                @foreach($hadith->similiars()->get() as $hadith)
                    <div class="zoom">
                        @include('layouts.hadith-overview', [
                            'hadith' => $hadith,
                            'overview' => 600
                        ])
                    </div>
                    <br>
                @endforeach
            </div>
        @endif
    </div>
@endsection
