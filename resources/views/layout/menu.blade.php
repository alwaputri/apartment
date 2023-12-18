<ul class="nav">
    <li class="{{ Request::is('Dashboard') ? 'active' : '' }}">
        <a href="{{ url('/') }}">
            <i class="nc-icon nc-bank"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="{{ Request::is('kamars') ? 'active' : '' }}">
        <a href="{{ url('kamars') }}">
            <i class="nc-icon nc-paper"></i>
            <p>Daftar Kamar</p>
        </a>
    </li>
    <li class="{{ Request::is('booking') ? 'active' : '' }}">
        <a href="{{ url('booking') }}">
            <i class="nc-icon nc-basket"></i>
            <p>History Reservasi</p>
        </a>
    </li>
    <li class="{{ Request::is('DaftarPenghuni') ? 'active' : '' }}">
        <a href="{{ url('DaftarPenghuni') }}">
            <i class="nc-icon nc-single-02"></i>
            <p>Daftar Penghuni</p>
        </a>
    </li>
</ul>
