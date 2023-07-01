<nav class="navbar navbar-header navbar-expand-lg">

    <div class="container-fluid">
        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
            <li class="nav-item dropdown hidden-caret">
                <a href="/registrasi" style="text-decoration: none;">
                    <span class="text-capitalize text-light text-bold">
                        Selamat Datang,
                        {{ Auth::user()->biodata->nama }} | {{ Auth::user()->biodata->jabatan }}
                    </span>
                </a>
                <a class="nav-link dropdown-toggle" href="/logout">
                    {{-- <span class="notification">4</span> --}}
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </li>
            <ul class="dropdown-menu dropdown-user animated fadeIn">
                <li>
                    <div class="user-box">
                        <div class="avatar-lg"><img src="/assets/img/profile.jpg" alt="image profile"
                                class="avatar-img rounded"></div>
                        <div class="u-text">
                            {{-- <h4>{{ Auth::user()->biodata->nama }}</h4> --}}
                            <a href="profile.html" class="btn btn-rounded btn-danger btn-sm">View Profile</a>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">My Profile</a>
                    <a class="dropdown-item" href="/logout">Logout</a>
                </li>
            </ul>
            </li>

        </ul>
    </div>
</nav>