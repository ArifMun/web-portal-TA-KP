<style>
    .divider {
        width: 100%;
        height: 2px;
        background: #BBB;
        margin: 1rem 0;
    }
</style>
<div class="sidebar">
    <div class="sidebar-background"></div>
    <div class="sidebar-wrapper scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav">
                <li class="nav-item {{  Request()->is('dashboard')? 'active' : ''  }}">
                    <a href="dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li class="nav-item {{ Request()->is('kerja-praktik*') || Request()->is('seminar-kp*') 
                    || Request()->is('bimbingan-kp*')|| Request()->is('data-kp*') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-user"></i>
                        @if (UserCheck::levelMhs())
                        <p>Kerja Praktik</p>
                        <span class="caret"></span>
                        @else
                        <p>Kerja Praktik</p>
                        <span class="caret"></span>
                        @if (!empty(Notification::CountMenu()))
                        <span class="badge badge-warning badge-count">{{
                            Notification::CountMenu() }}</span>
                        @endif
                        @endif
                    </a>
                    <div class="collapse {{ Request()->is('kerja-praktik*') || Request()->is('seminar-kp*') 
                    || Request()->is('bimbingan-kp*') || Request()->is('data-kp*') ? 'show' : '' }}" id="base">
                        <ul class="nav nav-collapse">

                            @if (UserCheck::userExceptDosen())
                            <li class="nav-item {{ Request()->is('kerja-praktik')? 'active' : '' }}">
                                <a href="kerja-praktik">
                                    @if (Auth::user()->level==0)
                                    <span class="sub-item">Daftar KP</span>
                                    @else
                                    <span class="sub-item">Pendaftar KP</span>
                                    @if (!empty(Notification::CountKP()))
                                    <span class="badge badge-warning badge-count">{{
                                        Notification::CountKP() }}</span>
                                    @endif
                                    @endif
                                </a>
                            </li>
                            @endif

                            @if (UserCheck::authBimbinganKP())
                            <li class="nav-item {{ Request()->is('bimbingan-kp')? 'active' : '' }}">
                                <a href="bimbingan-kp">
                                    <span class="sub-item">Bimbingan KP</span>
                                </a>
                            </li>
                            @endif

                            @if (UserCheck::userExceptDosen())
                            @if (Auth::user()->level!=0)
                            <li class="nav-item {{ Request()->is('seminar-kp')? 'active' : '' }}">
                                <a href="seminar-kp">
                                    <span class="sub-item">Pendaftar Seminar KP</span>
                                    @if (!empty(Notification::CountSeminar()))
                                    <span class="badge badge-warning badge-count">{{
                                        Notification::CountSeminar() }}</span>
                                    @endif
                                </a>
                            </li>

                            @elseif(UserCheck::checkBimbinganKP())
                            <li class="nav-item {{ Request()->is('seminar-kp')? 'active' : '' }}">
                                <a href="seminar-kp">
                                    <span class="sub-item">Daftar Seminar KP</span>
                                </a>
                            </li>
                            @endif

                            @endif
                            <li class="nav-item {{ Request()->is('data-kp')? 'active' : '' }}">
                                <a href="data-kp">
                                    <span class="sub-item">Data KP</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                @if (UserCheck::checkSeminarKP()||Auth::user()->level ==1)
                <li class="nav-item {{ Request()->is('daftar-ta*') || Request()->is('sidang-ta*') || 
                    Request()->is('bimbingan-ta*') || Request()->is('data-ta*') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-user-graduate"></i>
                        @if (UserCheck::levelMhs())
                        <p>Tugas Akhir</p>
                        <span class="caret"></span>
                        @else
                        <p>Tugas Akhir</p>
                        <span class="caret"></span>
                        @if (!empty(Notification::CountMenuTA()))
                        <span class="badge badge-warning badge-count">{{
                            Notification::CountMenuTA() }}</span>
                        @endif
                        @endif
                    </a>
                    <div class="collapse {{ Request()->is('daftar-ta*') || Request()->is('sidang-ta*') ||
                        Request()->is('bimbingan-ta*') || Request()->is('data-ta*') ? 'show' : '' }}" id="forms">
                        <ul class="nav nav-collapse">

                            @if (UserCheck::userExceptDosen())
                            <li class="nav-item {{ Request()->is('daftar-ta')? 'active' : '' }}">
                                <a href="daftar-ta">
                                    @if (Auth::user()->level==0)
                                    <span class="sub-item">Daftar TA</span>
                                    @else
                                    <span class="sub-item">Pendaftar TA</span>
                                    @if (!empty(Notification::CountTA()))
                                    <span class="badge badge-warning badge-count">{{
                                        Notification::CountTA() }}</span>
                                    @endif
                                    @endif
                                </a>
                            </li>
                            @endif

                            @if (UserCheck::authBimbinganTA())
                            <li class="nav-item {{ Request()->is('bimbingan-ta')? 'active' : '' }}">
                                <a href="bimbingan-ta">
                                    <span class="sub-item">Bimbingan TA</span>
                                </a>
                            </li>
                            @endif

                            @if (UserCheck::userExceptDosen())
                            @if (Auth::user()->level!=0)
                            <li class="nav-item {{ Request()->is('sidang-ta')? 'active' : '' }}">
                                <a href="sidang-ta">
                                    <span class="sub-item">Pendaftar Sidang TA</span>
                                    @if (!empty(Notification::CountSidang()))
                                    <span class="badge badge-warning badge-count">{{
                                        Notification::CountSidang() }}</span>
                                    @endif
                                </a>
                            </li>
                            {{-- belum FIX --}}
                            @elseif(UserCheck::checkBimbinganTA())
                            <li class="nav-item {{ Request()->is('sidang-ta')? 'active' : '' }}">
                                <a href="sidang-ta">
                                    <span class="sub-item">Daftar Sidang TA</span>
                                </a>
                            </li>
                            @endif

                            @endif

                            <li class="nav-item {{ Request()->is('data-ta')? 'active' : '' }}">
                                <a href="data-ta">
                                    <span class="sub-item">Data TA</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                @else
                @endif

                <li class="nav-item {{ Request()->is('dosen*') ? 'active' : '' }}">
                    <a href="dosen">
                        <i class="fas fa-list"></i>
                        <p>Data Dosen</p>
                        {{-- <span class="caret"></span> --}}
                    </a>
                </li>

                @if(Auth::user()->level==2)

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Administrator</h4>
                </li>
                <li class="nav-item {{ Request()->is('registrasi')? 'active' : '' }}">
                    <a href="registrasi">
                        <i class="fas fa-address-book"></i>
                        <p>Daftar Akun</p>
                    </a>
                </li>

                <li class="nav-item {{ Request()->is('manajemen-form')? 'active' : '' }}">
                    <a href="manajemen-form">
                        <i class="fas fa-cog"></i>
                        <p>Pengaturan</p>
                    </a>
                </li>
                @endif
                <li class="nav-item mt-5 ml-2 mr-2">
                    {{-- <div class="divider"></div> --}}
                    <h4 class="text-dark text-center font-weight-bold">Teknologi Informasi Universitas Muhammadiyah
                        Purworejo</h4>
                    {{-- <p class="text-dark text-center font-weight-normal">NSPN : Terakreditasi Baik</p> --}}
                    <div class="divider "></div>
                    <h6 class="text-dark font-weight-normal">
                        Jl. Taman Siswa II, Plaosan, Purworejo, Kec. Purworejo, Kabupaten Purworejo, Jawa Tengah 54151
                    </h6>
                </li>
            </ul>
        </div>
        {{-- <div class="sidebar-content">
            <ul class="nav">
                <li class="nav-item">
                    <a href="a">a</a>
                </li>
            </ul>
        </div> --}}
    </div>
</div>