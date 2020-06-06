@extends('layouts.app')

@section('info')
    <h3>
        Statistik
    </h3>
@endsection

@section('content')
    <div class="elements-section">
        <div class="element">
            <h2 class="el-title">
                Visitor
            </h2>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            @php
                                $harian = abs((int)request('harian'));
                                $harian = $harian < 1 ? 1 : $harian;
                                $bulanan = abs((int)request('bulanan'));
                                $bulanan = $bulanan < 1 ? 1 : $bulanan;
                                $tahunan = abs((int)request('tahunan'));
                                $tahunan = $tahunan < 1 ? 1 : $tahunan;
                            @endphp
                            <form>
                                @foreach(request()->keys() as $key)
                                    @if(!in_array($key, ['harian', 'bulanan', 'tahunan']))
                                        <input type="hidden" name="{{ $key }}" value="{{ request($key) }}">
                                    @endif
                                @endforeach
                                <h5><input value="{{ $harian }}" type="number" name="harian" style="text-align: right">
                                    hari
                                    terakhir</h5>
                                @php
                                    $badges = collect(['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'])
                                @endphp
                                <br>
                                @foreach(collect(range(0, $harian - 1))->reverse() as $c)
                                    @php $c = -$c @endphp
                                    <span class="badge badge-{{ $badges->random() }}">
                                    <b>{{ hari(now()->addDays($c)) }}</b>
                                    <br>
                                    <b>{{ format_date(now()->addDays($c), false, false) }}</b>
                                    <br>
                                    {{ \App\Models\Guest::thisDay($c)->distinct()->get()->count() }} pengunjung
                                    <br>
                                    Diakses {{ \App\Models\Guest::thisDay($c)->count() }}x
                                </span>
                                @endforeach
                                <hr>
                                <h5><input value="{{ $bulanan }}" type="number" name="bulanan"
                                           style="text-align: right">
                                    bulan terakhir</h5>
                                <br>
                                @foreach(collect(range(0, $bulanan - 1))->reverse() as $c)
                                    @php $c = -$c @endphp
                                    <span class="badge badge-{{ $badges->random() }}">
                                <b>{{ bulan(now()->addMonths($c)) }} {{ now()->addMonths($c)->year }}</b>
                                <br>
                                {{ \App\Models\Guest::thisMonth($c)->distinct()->get()->count() }} pengunjung
                                    <br>
                                    Diakses {{ \App\Models\Guest::thisMonth($c)->count() }}x
                            </span>
                                @endforeach
                                <hr>
                                <h5><input value="{{ $tahunan }}" type="number" name="tahunan"
                                           style="text-align: right">
                                    tahun terakhir</h5>
                                <br>
                                @foreach(collect(range(0, $tahunan - 1))->reverse() as $c)
                                    @php $c = -$c @endphp
                                    <span class="badge badge-{{ $badges->random() }}">
                                <b>{{ now()->addYears($c)->year }}</b>
                                <br>
                                {{ \App\Models\Guest::thisYear($c)->distinct()->get()->count() }} pengunjung
                                    <br>
                                    Diakses {{ \App\Models\Guest::thisYear($c)->count() }}x
                            </span>
                                @endforeach
                                <button class="btn btn-info" style="display: none">Lihat</button>
                            </form>
                        </div>
                    </div>
                    <br>
                    <div class="card card-body">
                        Diakses {{ $guests->total() }}x
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>IP</th>
                                    <th>URL</th>
                                    <th>Negara</th>
                                    <th>Kota</th>
                                    <th>Kecamatan</th>
                                    <th>Tgl</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($guests as $key => $guest)
                                    <tr>
                                        <td>{{ $guests->firstItem() + $key }}</td>
                                        <td>{{ $guest->ip }}</td>
                                        <td><a href="{{ $guest->url }}" target="_blank">{{ $guest->url }}</a></td>
                                        <td>{{ $guest->country }}</td>
                                        <td>{{ $guest->city }}</td>
                                        <td>{{ $guest->state_name }}</td>
                                        <td>{{ format_date($guest->created_at) }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $guests->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
