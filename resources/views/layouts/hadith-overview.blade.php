<a target="_blank" href="{{ route('hadith.detail', ['priest' => slugify($hadith->priest()->first()->name), 'no' => $hadith->no]) }}" class="card shadow"style="margin-left: 25px;margin-right: 25px" title="Detail">
    <div class="card-body">
        <p>
            <b>{{ strtoupper($hadith->priest()->first()->name) }}</b> |
            <b>Riwayat: {{ $hadith->priest()->first()->name }}</b>
            <b>Kitab: {{ $hadith->book()->first()->name }}</b> |
            <b>Bab: {{ $hadith->chapter()->first()->name }}</b> |
            <b>No: {{ $hadith->no }}</b>
        </p>
        <p>{!! narrator(overview(explode(':', $hadith->languages[0]->pivot->content, 2)[1], 500)) !!}</p>
    </div>
</a>
