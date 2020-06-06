<div class="site-menu-warp">
    <div class="close-menu">x</div>
    <!-- Main menu -->
    <ul class="site-menu">
        <li><a @if(is_current_route('home')) class="active" @endif href="{{ route('home') }}">Beranda</a></li>
        <li><a @if(is_current_route('classification', false)) class="active" @endif href="{{ route('classification') }}">Berdasarkan Perawi</a></li>
        <li><a @if(is_current_route('retrieval', false)) class="active" @endif href="{{ route('retrieval') }}">Pencarian Hadits</a></li>
        <li><a @if(is_current_route('hadith', false)) class="active" @endif href="{{ route('hadith.priest') }}">Daftar Hadits</a></li>
    </ul>
    <div class="menu-social">
        <a target="_blank" href="https://instagram.com/smadia.id"><i class="fa fa-instagram"></i></a>
        <a target="_blank" href="https://www.facebook.com/smadia.id"><i class="fa fa-facebook"></i></a>
        <a target="_blank" href="https://twitter.com/smadiaID"><i class="fa fa-twitter"></i></a>
    </div>
</div>
