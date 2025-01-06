<aside class="left-sidebar" data-sidebarbg="skin5">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav" class="p-t-30">
                <li class="sidebar-item">
                    <a href="{{ Route('dashboard') }}" class="sidebar-link waves-effect waves-dark sidebar-link"
                        aria-expanded="false">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item {{ Request::is('pengaduan*') ? 'selected' : ' ' }}">
                    <a href="{{ Route('pengaduan') }}" class="sidebar-link waves-effect waves-dark sidebar-link"
                        aria-expanded="false">
                        <i class="mdi mdi-information"></i>
                        <span class="hide-menu">Pengaduan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="{{ route('laporan') }}"
                        class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('laporan*') ? 'selected' : ' ' }}"
                        aria-expanded="false">
                        <i class="mdi mdi-book-multiple"></i>
                        <span class="hide-menu">Laporan</span>
                    </a>
                </li>
                @if (Auth::user()->role == 'Admin')
                    <li class="sidebar-item">
                        <a href="{{ route('respon') }}"
                            class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('pengaduan*') ? 'selected' : ' ' }}"
                            aria-expanded="false">
                            <i class="mdi mdi-message-text"></i>
                            <span class="hide-menu">Respon</span>
                        </a>
                    </li>
                    <li class="sidebar-item">
                        <a href="{{ route('user') }}"
                            class="sidebar-link waves-effect waves-dark sidebar-link {{ Request::is('user*') ? 'selected' : ' ' }}"
                            aria-expanded="false">
                            <i class="mdi mdi-account-multiple"></i>
                            <span class="hide-menu">User</span>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
