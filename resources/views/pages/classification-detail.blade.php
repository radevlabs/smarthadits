@extends('layouts.app')

@push('head')
    <style>
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
    <p>Aplikasi ini hanya membantu memperkirakan keshahihan hadits (Shahih, Hasan dan Dhaif) dan tentu saja tidak bisa dijadikan patokan pasti karena aplikasi ini hanya membantu.</p>
@endsection

@section('content')
    <div class="elements-section">
        <div class="element">
            <h2 class="el-title">Masukan hadits</h2>
            <p>{{ $hadith }}</p>
        </div>
        <div class="element">
            <h2 class="el-title"><i>Preprocessing</i></h2>
            <p>{!! $chadith !!}</p>
        </div>
        <div class="element">
            <h2 class="el-title">Perkiraan Perawi</h2>
            <!-- Timeline -->
            <ul class="timeline">
                @foreach($narrators as $narrator)
                    <li class="timeline-item bg-white rounded ml-3 p-4 shadow">
                        <div class="timeline-arrow"></div>
                        <div class="row">
                            <div class="col-md-1 col-sm-1 col-xl-1">
                                @if($loop->iteration <= 9)
                                    <h1 class="text-center">{{ $loop->iteration }}</h1>
                                @else
                                    <h2 class="text-center">{{ $loop->iteration }}</h2>
                                @endif
                            </div>
                            <div class="col-md-11 col-sm-11 col-xl-11">
                                <h2 class="h5 mb-0">
                                    {{ $narrator }}
                                </h2>
                                <p class="text-small mt-2 font-weight-light">
                                    @php $s = '' @endphp
                                    @foreach(nasab($narrator) as $name)
                                        @php $s = $s.badge($name).' <b>></b> ' @endphp
                                    @endforeach
                                    {!! substr($s, 0, -9) !!}
                                </p>
                                <button class="btn btn-outline-dark btn-sm" onclick="$('#like-{{ $loop->iteration }}').toggle()">Perawi serupa</button>
                                <div class="table-responsive" id="like-{{ $loop->iteration }}">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Kuniyah</th>
                                            <th>Laqob</th>
                                            <th>Kalangan</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach(\App\Models\Narrator::search($narrator)->get()->take(5) as $narrator)
                                            <tr>
                                                <td>{{ $narrator->name }}</td>
                                                <td>{{ $narrator->kuniyah ?? '-' }}</td>
                                                <td>{{ $narrator->laqob ?? '-' }}</td>
                                                <td>{{ $narrator->circle()->first()->name ?? '-' }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <script>
                                    setTimeout(function () {
                                        $('#like-{{ $loop->iteration }}').hide()
                                    }, 2000)
                                </script>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul><!-- End -->
        </div>
        <div class="element">
            <h2 class="el-title">Hasil</h2>
            <h3><small>InsyaAllah</small> <div class="badge badge-info">{{ strtoupper($result) }}</div></h3>
        </div>
    </div>
@endsection
