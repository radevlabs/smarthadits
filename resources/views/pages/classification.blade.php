@extends('layouts.app')

@push('head')

@endpush

@section('info')
    <p>Menggunakan PCA dan BNN</p>
    <p>
        Referensi:<br>
        - Jurnalnya <a target="_blank" href="https://www.instagram.com/nuha_tok/">Ulin Nuha</a> yang belum terbit
    </p>
@endsection

@section('content')
    <div class="elements-section">
        <div class="element">
            <h2 class="el-title">Klasifikasi hadits berdasarkan perawi</h2>
            <form action="{{ route('classification.result') }}" method="post" target="_blank">
                @csrf
                <div class="form-group">
                    <div class="form-group">
                        <label for="hadithtext">Masukkan hadits</label>
                        <textarea name="hadith" class="form-control" id="hadithtext" rows="5">contoh: Telah menceritakan kepada kami Abu Bakr bin Abu Syaibah, telah menceritakan kepada kami Yahya bin Ya'la At Taimi dari Muhammad bin Ishaq dari Ma'bad bin Ka'b dari Abu Qatadah ia berkata: Aku mendengar Rasulullah shallallahu 'alaihi wa sallam bersabda di atas mimbar ini: "Janganlah kalian banyak-banyak membacakan hadits dariku, maka barangsiapa berkata atas namaku, hendaklah ia berkata dengan benar atau jujur. Barangsiapa berkata atas namaku dengan sesuatu yang aku tidak mengatakannya, maka hendaklah ia menyiapkan tempat duduknya di neraka."</textarea>
                    </div>
                </div>
                <button id="submit" class="btn btn-outline-dark">Submit</button>
            </form>
        </div>
    </div>
@endsection
