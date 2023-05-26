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

                <li
                    class="nav-item {{ Request()->is('kerja-praktik*') || Request()->is('seminar-kp*') || Request()->is('bimbingan-kp*') ? 'active' : '' }}">
                    <a data-toggle="collapse" href="#base">
                        <i class="fas fa-user"></i>
                        <p>Kerja Praktik</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="base">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ Request()->is('kerja-praktik')? 'active' : '' }}">
                                <a href="kerja-praktik">
                                    <span class="sub-item">Daftar KP</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request()->is('bimbingan-kp')? 'active' : '' }}">
                                <a href="bimbingan-kp">
                                    <span class="sub-item">Bimbingan KP</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request()->is('seminar-kp')? 'active' : '' }}">
                                <a href="seminar-kp">
                                    <span class="sub-item">Daftar Seminar KP</span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li>

                <li class="nav-item {{ Request()->is('daftar-ta*') || Request()->is('sidang-ta*')? 'active' : '' }}">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-user-graduate"></i>
                        <p>Tugas Akhir</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li class="nav-item {{ Request()->is('daftar-ta')? 'active' : '' }}">
                                <a href="daftar-ta">
                                    <span class="sub-item">Daftar TA</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request()->is('sidang-ta')? 'active' : '' }}">
                                <a href="sidang-ta">
                                    <span class="sub-item">Daftar Sidang TA</span>
                                </a>
                            </li>
                            <li class="nav-item {{ Request()->is('bimbingan-ta')? 'active' : '' }}">
                                <a href="bimbingan-ta">
                                    <span class="sub-item">Bimbingan TA</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
                {{--
                <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-user-graduate"></i>
                        <p>Data</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Data Dosen</span>
                                </a>
                            </li>
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Data Mahasiswa</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                @if(Auth::user()->level==1)

                <li class="nav-section">
                    <span class="sidebar-mini-icon">
                        <i class="fa fa-ellipsis-h"></i>
                    </span>
                    <h4 class="text-section">Administrator</h4>
                </li>
                <li class="nav-item {{ Request()->is('registrasi')? 'active' : '' }}">
                    <a href="registrasi">
                        <i class="fas fa-users"></i>
                        <p>Daftar Akun</p>
                    </a>
                </li>

                <li class="nav-item {{ Request()->is('manajemen-form')? 'active' : '' }}">
                    <a href="manajemen-form">
                        <i class="fas fa-pen-square"></i>
                        <p>Manajemen Form</p>
                    </a>
                </li>
                @endif
                {{-- <li class="nav-item">
                    <a data-toggle="collapse" href="#forms">
                        <i class="fas fa-pen-square"></i>
                        <p>Manajemen KP/TA</p>
                        <span class="caret"></span>
                    </a>
                    <div class="collapse" id="forms">
                        <ul class="nav nav-collapse">
                            <li>
                                <a href="forms/forms.html">
                                    <span class="sub-item">Tahun Akademik/span>
                                </a>
                            </li>

                        </ul>
                    </div>
                </li> --}}


            </ul>
        </div>
    </div>
</div>