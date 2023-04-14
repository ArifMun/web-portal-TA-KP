<li class="nav-item">
        <a href="#" data-toggle="dropdown" role="button" aria-expanded="false" class="nav-link dropdown-toggle">
                <img src="img/product/pro4.jpg" alt="" />
                <span class="admin-name">Prof.Anderson</span>
                <i class="fa fa-angle-down edu-icon edu-down-arrow"></i>
        </a>
        <ul role="menu" class="dropdown-header-top author-log dropdown-menu animated zoomIn">
                <li><a href="#"><span class="edu-icon edu-home-admin author-log-ic"></span>My
                                Account</a>
                </li>
                <li><a href="#"><span class="edu-icon edu-user-rounded author-log-ic"></span>My
                                Profile</a>
                </li>
                <li><a href="#"><span class="edu-icon edu-money author-log-ic"></span>User
                                Billing</a>
                </li>
                <li><a href="#"><span class="edu-icon edu-settings author-log-ic"></span>Settings</a>
                </li>
                <li>
                        <form action="logout" method="POST">
                                @csrf
                                <button type="submit" class="edu-icon edu-locked author-log-ic">Log Out</button>
                        </form>
                </li>
        </ul>
</li>