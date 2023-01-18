<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= site_url('welcome') ?>" class="brand-link">
        <img src="<?= base_url() . 'uploads/' . $imgpath  ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->


        <!-- SidebarSearch Form -->
        <div class="form-inline mt-5">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item menu-open">
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?= site_url('welcome') ?>" class="nav-link">
                                <i class="far fa-user nav-icon"></i>
                                <p>Welcome Page</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() . 'welcome/insert' ?>" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>Crud Opperation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() . 'welcome/calender' ?>" class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>Calendar</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() . 'welcome/email' ?>" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>Email Sender</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?= base_url() . 'welcome/convert' ?>" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>Currency Converter</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>