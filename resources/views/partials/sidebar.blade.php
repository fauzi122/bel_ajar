    <aside class="sidebar">
        <div class="sidebar-start">
            <div class="sidebar-head">
                <a href="/" class="logo-wrapper" title="Dashboard">
                    <span class="sr-only">Dashboard</span>
                    <span class="sidebar-user-img" aria-hidden="true">
                        <picture><img src="{{ asset('assets/img/avatar/logo.png') }}" alt="User name"></picture>
                    </span>
                    <div class="logo-text">
                        <span class="logo-title">E-SPP</span>
                        <span class="logo-subtitle">Dashboard</span>
                    </div>
                </a>
                <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                    <span class="sr-only">Toggle menu</span>
                    <span class="icon menu-toggle" aria-hidden="true"></span>
                </button>
            </div>
            <div class="sidebar-body">
                <ul class="sidebar-body-menu">
                    <li>
                        <a class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}"
                            href="{{ route('dashboard.index') }}"><span class="icon category"
                                aria-hidden="true"></span>Dashboard</a>
                    </li>
                    <li>
                </ul>
                <span class="system-menu__title">Kelola Data Master</span>
                @if (auth()->user()->level === 'admin')
                    <ul class="sidebar-body-menu ">
                        <span class="category__btn transparent-btn show-cat-btn cat-sub-menu" title="Open list">
                            <span class="sr-only">Open List</span>
                        </span>
                        <li>
                            <a class="{{ request()->routeIs('siswa.index', 'siswa.create', 'siswa.edit') ? 'active' : '' }}"
                                href="{{ route('siswa.index') }}"><span class="icon user-2 "
                                    aria-hidden="true"></span>Kelola Data Siswa</a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('petugas.index', 'petugas.create', 'petugas.edit') ? 'active' : '' }}"
                                href="{{ route('petugas.index') }}"><span class="icon user-3"
                                    aria-hidden="true"></span>Kelola Data Petugas</a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('kelas.index', 'kelas.create', 'kelas.edit') ? 'active' : '' }}"
                                href="{{ route('kelas.index') }}"><span class="icon home"
                                    aria-hidden="true"></span>Kelola Data Kelas</a>
                        </li>
                        <li>
                            <a class="{{ request()->routeIs('spp.index', 'spp.create', 'spp.edit') ? 'active' : '' }}"
                                href="{{ route('spp.index') }}"><span class="icon money"
                                    aria-hidden="true"></span>Kelola Data SPP</a>
                        </li>
                    </ul>
                @endif
                @if (auth()->user()->level === 'petugas')
                    <ul class="sidebar-body-menu ">
                        <span class="category__btn transparent-btn show-cat-btn cat-sub-menu"title="Open list">
                            <span class="sr-only">Open List</span>
                        </span>

                    
                        <li>
                            <a class="{{ request()->routeIs('pembayaran.index', 'pembayaran.create', 'pembayaran.edit') ? 'active' : '' }} show-cat-btn"
                                href="##">
                                <span class="icon edit" aria-hidden="true"></span>Pembayaran
                                <span class="category__btn transparent-btn rotated" title="Open list">
                                    <span class="sr-only">Open list</span>
                                    <span class="icon arrow-down" aria-hidden="true"></span>
                                </span>
                            </a>
                            <ul class="cat-sub-menu ">
                                <li>
                                    <a href="{{ route('pembayaran.index') }}"
                                        class="{{ request()->routeIs('pembayaran.index', 'pembayaran.create', 'pembayaran.edit') ? 'active' : '' }}">SPP</a>
                                </li>

                                <li>
                                    <a href="{{ route('pembayaranujian.index') }}"
                                        class="{{ request()->routeIs('pembayaranujian.index', 'pembayaran.create', 'pembayaran.edit') ? 'active' : '' }}">UTS/UAS</a>
                                </li>

                                <li>
                                    <a href="{{ route('pembayaran.index') }}"
                                        class="{{ request()->routeIs('pembayaran.index', 'pembayaran.create', 'pembayaran.edit') ? 'active' : '' }}">Buku</a>
                                </li>
                                <li>
                                    <a href="{{ route('pembayaran.index') }}"
                                        class="{{ request()->routeIs('pembayaran.index', 'pembayaran.create', 'pembayaran.edit') ? 'active' : '' }}">Kegiatan</a>
                                </li>
                                
                            </ul>
                        </li>


                        <li>
                            <a class="{{ request()->routeIs('laporan', 'tunggakan') ? 'active' : '' }} show-cat-btn"
                                href="##">
                                <span class="laporan" aria-hidden="true"></span>Laporan
                                <span class="category__btn transparent-btn rotated" title="Open list">
                                    <span class="sr-only">Open list</span>
                                    <span class="icon arrow-down" aria-hidden="true"></span>
                                </span>
                            </a>
                            <ul class="cat-sub-menu ">
                                <li>
                                    <a href="{{ route('laporan') }}"
                                        class="{{ request()->routeIs('laporan') ? 'active' : '' }}">Rekap Kelas</a>
                                </li>
                                <li>
                                    <a href="{{ route('tunggakan') }}"
                                        class="{{ request()->routeIs('tunggakan') ? 'active' : '' }}">Tunggakan
                                        Kelas</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                @endif
            </div>
        </div>
        <div class="pt-5">
            <div class="pt-5">
                <div class="pt-5">
                        <div class="pt-5">
                            <div class="pt-5">
                        <div class="pt-5">
                            <div class="pt-5">
                                <a href="#" class="sidebar-user">
                                    <span class="sidebar-user-img">
                                        <picture><img src="{{ asset('assets/img/avatar/kawai.jpg') }}" alt="User name"></picture>
                                    </span>
                                    <div class="sidebar-user-info">
                                        <span class="sidebar-user__title"> {{ auth()->User()->nama_petugas }}</span>
                                        <span class="sidebar-user__subtitle ">{{ auth()->User()->level }}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </aside>
