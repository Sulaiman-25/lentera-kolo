<!DOCTYPE html>
<html lang="id">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Dashboard Admin</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{ asset('admin/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('components.admin-header')
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <div class="sidebar" data-background-color="dark">
            <div class="sidebar-logo">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark">
                    <a href="{{ route('index') }}" class="logo">
                        <img src="{{ asset('img/lentera.jpg') }}" alt="navbar brand"
                            class="navbar-brand" height="50" />
                        <P class="text-white p-2"> LENTERA KOLO</P>
                    </a>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="gg-menu-right"></i>
                        </button>
                        <button class="btn btn-toggle sidenav-toggler">
                            <i class="gg-menu-left"></i>
                        </button>
                    </div>
                    <button class="topbar-toggler more">
                        <i class="gg-more-vertical-alt"></i>
                    </button>
                </div>
                <!-- End Logo Header -->
            </div>
            <div class="sidebar-wrapper scrollbar scrollbar-inner">
                <div class="sidebar-content">
                    <ul class="nav nav-secondary">
                        <li class="nav-item {{ Route::is('dashboard') ? 'active' : '' }}">
                            <a href="{{ route('dashboard') }}">
                                <i class="fas fa-home"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-section">
                            <span class="sidebar-mini-icon">
                                <i class="fa fa-ellipsis-h"></i>
                            </span>
                            <h4 class="text-section">Menu Utama</h4>
                        </li>
                        <li
                            class="nav-item {{ Route::is('admin.news.*') || (Route::is('news.*') && !Route::is('news.draft')) ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#news">
                                <i class="fas fa-newspaper"></i>
                                <p>Berita</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ Route::is('admin.news.*') || (Route::is('news.*') && !Route::is('news.draft')) ? 'show' : '' }}"
                                id="news">
                                <ul class="nav nav-collapse">
                                    @if (auth()->user()->hasRole('Super Admin'))
                                        <li>
                                            <a href="{{ route('admin.news.manage') }}">
                                                <span class="sub-item">Kelola Berita</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasRole('Editor') || auth()->user()->hasRole('Super Admin'))
                                        <li>
                                            <a href="{{ route('admin.news.status') }}">
                                                <span class="sub-item">Status Berita</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (auth()->user()->hasRole('Writer') || auth()->user()->hasRole('Super Admin'))
                                        <li>
                                            <a href="{{ route('news.create') }}">
                                                <span class="sub-item">Buat Berita</span>
                                            </a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @if (auth()->user()->hasRole('Super Admin'))
                            <li class="nav-item {{ Route::is('admin.category.*') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#category">
                                    <i class="fas fa-list"></i>
                                    <p>Kategori</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Route::is('admin.category.*') ? 'show' : '' }}" id="category">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="{{ route('admin.category.manage') }}">
                                                <span class="sub-item">Kelola Kategori</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        @if (auth()->user()->hasRole('Writer') || auth()->user()->hasRole('Super Admin'))
                            <li
                                class="nav-item {{ Route::is('admin.users.*') || Route::is('news.draft') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#users">
                                    <i class="fas fa-users-cog"></i>
                                    <p>Pengguna</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Route::is('admin.users.*') || Route::is('news.draft') ? 'show' : '' }}"
                                    id="users">
                                    <ul class="nav nav-collapse">
                                        @if (auth()->user()->hasRole('Super Admin'))
                                            <li>
                                                <a href="{{ route('admin.users.manage') }}">
                                                    <span class="sub-item">Kelola Pengguna</span>
                                                </a>
                                            </li>
                                        @endif
                                        <li>
                                            <a href="{{ route('news.draft') }}">
                                                <span class="sub-item">Draft Saya</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif

                        <!-- Menu Tulisan Tamu -->
                        @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Editor'))
                            <li
                                class="nav-item {{ Route::is('admin.titip-tulisan.*') || Route::is('titip-tulisan.*') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#titip">
                                    <i class="fas fa-pen-nib"></i>
                                    <p>Tulisan Tamu</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Route::is('admin.titip-tulisan.*') || Route::is('titip-tulisan.*') ? 'show' : '' }}"
                                    id="titip">
                                    <ul class="nav nav-collapse">
                                        <li class="{{ Route::is('titip-tulisan.create') ? 'active' : '' }}">
                                            <a href="{{ route('titip-tulisan.create') }}">
                                                <span class="sub-item">Buat Tulisan</span>
                                            </a>
                                        </li>
                                        <li class="{{ Route::is('admin.titip-tulisan.manage') ? 'active' : '' }}">
                                            <a href="{{ route('admin.titip-tulisan.manage') }}">
                                                <span class="sub-item">Kelola Tulisan</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif


                        @if (auth()->user()->hasRole('Super Admin'))
                            <li class="nav-item {{ Route::is('admin.kontak.*') ? 'active' : '' }}">
                                <a href="{{ route('admin.kontak.index') }}">
                                    <i class="fas fa-envelope"></i>
                                    <p>Kelola Pesan</p>
                                </a>
                            </li>
                        @endif
                        @php
                            $showCommentsMenu =
                                auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Writer');
                        @endphp

                        @if ($showCommentsMenu)
                            <li class="nav-item {{ Route::is('admin.comments.*') ? 'active' : '' }}">
                                <a data-bs-toggle="collapse" href="#comments">
                                    <i class="fas fa-comments"></i>
                                    <p>Komentar</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse {{ Route::is('admin.comments.*') ? 'show' : '' }}" id="comments">
                                    <ul class="nav nav-collapse">
                                        {{-- Semua komentar untuk Super Admin --}}
                                        @if (auth()->user()->hasRole('Super Admin'))
                                            <li class="{{ Route::is('admin.comments.index') ? 'active' : '' }}">
                                                <a href="{{ route('admin.comments.index') }}">
                                                    <span class="sub-item">Semua Komentar</span>
                                                </a>
                                            </li>
                                        @endif

                                        {{-- Komentar berita sendiri untuk Writer --}}
                                        @if (auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Writer'))
                                            <li
                                                class="{{ Route::is('admin.comments.myNewsComments') ? 'active' : '' }}">
                                                <a href="{{ route('admin.comments.myNewsComments') }}">
                                                    <span class="sub-item">Komentar Berita Saya</span>
                                                    @php
                                                        $userNewsIds = \App\Models\News::when(
                                                            auth()->user()->hasRole('Writer'),
                                                            function ($query) {
                                                                $query->where('user_id', auth()->id());
                                                            },
                                                        )->pluck('id');

                                                        $myNewsCommentsCount = \App\Models\Comment::where(
                                                            'commentable_type',
                                                            \App\Models\News::class,
                                                        )
                                                            ->when(auth()->user()->hasRole('Writer'), function (
                                                                $query,
                                                            ) use ($userNewsIds) {
                                                                $query->whereIn('commentable_id', $userNewsIds);
                                                            })
                                                            ->count();
                                                    @endphp
                                                    @if ($myNewsCommentsCount > 0)
                                                        <span
                                                            class="badge badge-primary badge-pill">{{ $myNewsCommentsCount }}</span>
                                                    @endif
                                                </a>
                                            </li>
                                        @endif

                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- End Sidebar -->

        <div class="main-panel">
            <div class="main-header">
                <div class="main-header-logo">
                    <!-- Logo Header -->
                    <div class="logo-header" data-background-color="dark">
                        <a href="{{ route('index') }}" class="logo">
                            <img src="{{ asset('admin/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                                class="navbar-brand" height="20" />
                        </a>
                        <div class="nav-toggle">
                            <button class="btn btn-toggle toggle-sidebar">
                                <i class="gg-menu-right"></i>
                            </button>
                            <button class="btn btn-toggle sidenav-toggler">
                                <i class="gg-menu-left"></i>
                            </button>
                        </div>
                        <button class="topbar-toggler more">
                            <i class="gg-more-vertical-alt"></i>
                        </button>
                    </div>
                    <!-- End Logo Header -->
                </div>
                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom">
                    <div class="container-fluid">
                        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
                            <li class="nav-item topbar-icon dropdown hidden-caret me-4">
                                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="notification" id="unread-notification-count"></span>
                                </a>
                                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                                    <li>
                                        <div class="dropdown-title">
                                            @if (auth()->user()->notifications->count() > 0)
                                                Anda memiliki notifikasi
                                            @else
                                                Tidak ada notifikasi
                                            @endif
                                        </div>
                                    </li>
                                    <li>
                                        <div class="notif-scroll scrollbar-outer">
                                            <div class="notif-center" id="notifications-container">
                                                {{-- JS --}}
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="nav-item topbar-user dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <div class="avatar-sm">
                                        <img src="{{ auth()->user()->image ? asset('storage/images/' . auth()->user()->image) : asset('img/default.jpeg') }}"
                                            alt="Foto Profil" class="avatar-img rounded-circle" />
                                    </div>
                                    <span class="profile-username">
                                        <span class="op-7">Halo,</span>
                                        <span class="fw-bold">{{ auth()->user()->name }}</span>
                                    </span>
                                </a>

                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                <div class="avatar-lg">
                                                    <img src="{{ auth()->user()->image ? asset('storage/images/' . auth()->user()->image) : asset('img/default.jpeg') }}"
                                                        alt="Foto Profil" class="avatar-img rounded" />
                                                </div>
                                                <div class="u-text">
                                                    <h4>{{ auth()->user()->name }}</h4>
                                                    <p class="text-muted">{{ auth()->user()->email }}
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider bg-light"></div>
                                            <a class="dropdown-item"
                                                href="{{ route('profile.edit', auth()->user()->id) }}">Profil
                                                Saya</a>
                                            <div class="dropdown-divider bg-light"></div>
                                            <form action="{{ route('logout') }}" method="POST">
                                                @csrf
                                                <button type="submit" class="dropdown-item">Keluar</button>
                                            </form>
                                        </li>
                                    </div>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            @yield('content')

            <footer class="footer">
                <div class="container-fluid d-flex justify-content-between">
                    <nav class="pull-left">
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="http://www.themekita.com">
                                    ThemeKita
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Bantuan </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#"> Lisensi </a>
                            </li>
                        </ul>
                    </nav>
                    <div class="copyright">
                        2025, <i class="fa fa-heart heart text-danger"></i> oleh
                        <a href="https://www.instagram.com/sulaiman_nabiyan_ali/?igsh=MXU2ZjhidGV0OGJrag%3D%3D#">Sulaiman</a>
                    </div>
                    <div>
                        Didistribusikan oleh
                        <a target="_blank" href="https://www.instagram.com/sulaiman_nabiyan_ali/?igsh=MXU2ZjhidGV0OGJrag%3D%3D#/">Sulaiman</a>.
                    </div>
                </div>
            </footer>
        </div>
    </div>

    @include('components.admin-footer')

    @yield('scripts')
</body>

</html>
