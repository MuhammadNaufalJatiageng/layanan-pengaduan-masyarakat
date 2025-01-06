<header class="topbar" data-navbarbg="skin5">
    <nav class="navbar top-navbar navbar-expand-md navbar-dark">
        <div class="navbar-header" data-logobg="skin5">
            <!-- This is for the sidebar toggle which is visible on mobile only -->
            <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- ============================================================== -->
            <!-- Logo -->
            <!-- ============================================================== -->
            <a class="navbar-brand" href="/">
                <!-- Logo icon -->
                <b class="logo-icon p-l-10">
                    <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                    <!-- Dark Logo icon -->
                    <img src="{{ asset('assets/images/logo.png') }}" alt="homepage" class="light-logo"
                        style="width: 40px" />

                </b>
                <!--End Logo icon -->
                <!-- Logo text -->
                {{-- <span class="logo-text">
                    <!-- dark Logo text -->
                    <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" />

                </span> --}}
                <!-- Logo icon -->
                <!-- <b class="logo-icon"> -->
                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                <!-- Dark Logo icon -->
                <!-- <img src="assets/images/logo-text.png" alt="homepage" class="light-logo" /> -->

                <!-- </b> -->
                <!--End Logo icon -->
            </a>
            <!-- ============================================================== -->
            <!-- End Logo -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Toggle which is visible on mobile only -->
            <!-- ============================================================== -->
            <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)"
                data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
        </div>
        <!-- ============================================================== -->
        <!-- End Logo -->
        <!-- ============================================================== -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
            <!-- ============================================================== -->
            <!-- toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-left mr-auto">
                <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light"
                        href="javascript:void(0)" data-sidebartype="mini-sidebar"><i
                            class="mdi mdi-menu font-24"></i></a></li>
                <!-- ============================================================== -->
                <!-- Search -->
                <!-- ============================================================== -->
                <li class="nav-item search-box"> <a class="nav-link waves-effect waves-dark"
                        href="javascript:void(0)"><i class="ti-search"></i></a>
                    <form action="{{ route('search') }}" class="app-search position-absolute" method="POST">
                        @csrf
                        <input name="keyword" type="text" class="form-control" placeholder="Search &amp; enter"> <a
                            class="srh-btn"><i class="ti-close"></i></a>
                    </form>
                </li>
            </ul>
            <!-- ============================================================== -->
            <!-- Right side toggle and nav items -->
            <!-- ============================================================== -->
            <ul class="navbar-nav float-right">
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Messages -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle waves-effect waves-dark notifikasi" href="" id="2"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="font-24 mdi mdi-comment-processing ">
                            @if (count($notif) > 0)
                                <span class="text-warning">*</span>
                            @endif
                        </i>

                    </a>
                    <div class="dropdown-menu dropdown-menu-right mailbox animated bounceInDown" aria-labelledby="2">
                        <ul class="list-style-none">
                            <li>
                                <div class="">
                                    @if (count($notif) != 0)
                                        @foreach ($notif as $item)
                                            @php
                                                $id = Crypt::encrypt($item->id);
                                            @endphp
                                            <!-- Message -->
                                            <a href="{{ route('show', $id) }}" class="link border-top">
                                                <div class="d-flex no-block align-items-center p-10">
                                                    <div class="m-l-10">
                                                        <h6 class="m-b-0">
                                                            {{ $item->judul ? $item->judul : $item->total . ' pesan baru!' }}
                                                        </h6>
                                                        <p class="mail-desc">Untuk pengaduan
                                                            "{{ $item->peng_judul }}"</p>
                                                        <p class="text-muted">Ketuk untuk lihat</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @else
                                        <p class="text-muted text-center  p-10">Tidak ada pesan.</p>
                                    @endif
                                </div>
                            </li>
                        </ul>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- End Messages -->
                <!-- ============================================================== -->

                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark pro-pic" href=""
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img
                            src="{{ asset('assets/images/users/1.jpg') }}" alt="user" class="rounded-circle"
                            width="31"></a>
                    <div class="dropdown-menu dropdown-menu-right user-dd animated">
                        <a class="dropdown-item" href="{{ route('profile') }}"><i class="ti-user m-r-5 m-l-5"></i> My
                            Profile</a>
                        <div class="dropdown-divider"></div>
                        <form action="{{ route('logout') }}" id="formLogout" method="post">@csrf</form>
                        <a class="dropdown-item" onclick="logout()" href="javascript:void(0)"><i
                                class="fa fa-power-off m-r-5 m-l-5"></i>
                            Logout</a>
                    </div>
                </li>
                <!-- ============================================================== -->
                <!-- User profile and search -->
                <!-- ============================================================== -->
            </ul>
        </div>
    </nav>
</header>
