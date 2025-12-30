<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <title>Pusat Berita</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <link rel="icon" href="<?php echo e(asset('img/lentera.jpg')); ?>" type="image/x-icon" />

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Raleway:wght@100;600;800&display=swap"
        rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Libraries Stylesheet -->
    <link href="<?php echo e(asset('th/lib/animate/animate.min.css')); ?>" rel="stylesheet" />
    <link href="<?php echo e(asset('th/lib/owlcarousel/assets/owl.carousel.min.css')); ?>" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="<?php echo e(asset('th/css/bootstrap.min.css')); ?>" rel="stylesheet" />

    <!-- Template Stylesheet -->
    <link href="<?php echo e(asset('th/css/style.css')); ?>" rel="stylesheet" />

    
    <link rel="stylesheet" href="<?php echo e(asset('css/scroll.css')); ?>">

    <style>
        /* Custom CSS untuk responsif */
        .nav-main-links {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        @media (max-width: 991.98px) {
            .navbar-collapse .d-flex {
                flex-direction: column;
                width: 100%;
            }

            .nav-main-links {
                justify-content: center;
                width: 100%;
                margin-bottom: 1rem;
            }

            .nav-main-links .nav-item {
                text-align: center;
            }

            .btn-search {
                align-self: center;
                margin-top: 1rem;
            }

            .scroll-container {
                width: 100%;
                margin-bottom: 1rem;
            }

            .scroll-content {
                max-width: 100% !important;
            }
        }

        @media (max-width: 767.98px) {
            .nav-main-links {
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
            }

            .nav-main-links .nav-link {
                font-size: 1rem !important;
            }
        }

        @media (max-width: 575.98px) {
            .topbar-top .top-info {
                flex-direction: column;
                align-items: flex-start;
            }

            .topbar-top .top-info .pe-2 {
                border-right: none !important;
                border-bottom: 1px solid rgba(255, 255, 255, 0.2);
                margin-bottom: 0.5rem;
                padding-bottom: 0.5rem;
                width: 100%;
            }

            .overflow-hidden {
                width: 100% !important;
            }

            .footer .row>div {
                margin-bottom: 2rem;
            }
        }
    </style>
</head>

<body>
    

    <!-- Navbar start -->
    <div class="container-fluid sticky-top px-0">
        <div class="container-fluid topbar bg-dark d-none d-lg-block">
            <div class="container px-0">
                <div class="topbar-top d-flex justify-content-between flex-lg-wrap">
                    <div class="top-info flex-grow-0 d-flex align-items-center flex-wrap">
                        <span class="rounded-circle btn-sm-square bg-primary me-2">
                            <i class="fas fa-bolt text-white"></i>
                        </span>
                        <div class="pe-2 me-3 border-end border-white d-flex align-items-center">
                            <p class="mb-0 text-white fs-6 fw-normal">Trending</p>
                        </div>
                        <?php $__currentLoopData = \App\Models\News::where('status', 'Accept')->withCount('likes')->orderBy('likes_count', 'desc')->take(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="overflow-hidden" style="width: 735px">
                                <div id="note" class="ps-2">
                                    <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                        class="img-fluid rounded-circle border border-3 border-primary me-2"
                                        style="width: 30px; height: 30px" alt="" />
                                    <a href="<?php echo e(route('news.show', $news->id)); ?>">
                                        <p class="text-white mb-0 link-hover">
                                            <?php echo e($news->title); ?>

                                        </p>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid bg-light">
            <div class="container px-0">
                <nav class="navbar navbar-light navbar-expand-xl">
                    <a href="<?php echo e(route('index')); ?>" class="navbar-brand d-block">
                        <img src="<?php echo e(asset('img/lentera.jpg')); ?>" alt="" class="img-fluid"
                            style="max-width: 60px;">
                    </a>
                    <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarCollapse">
                        <span class="fa fa-bars text-primary"></span>
                    </button>
                    <div class="collapse navbar-collapse bg-light py-3 justify-content-between" id="navbarCollapse">
                        <div class="scroll-container">
                            <button class="scroll-button left btn btn-outline-primary d-none d-xl-block"
                                id="scrollLeft">
                                <span>&lt;</span>
                            </button>
                            <div class="scroll-content">
                                <div class="navbar-nav mx-lg-4 border-top"
                                    style="white-space: nowrap; max-width: 60vw;">
                                    <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="<?php echo e(route('news.viewCategory', $category->slug)); ?>"
                                            class="nav-item nav-link mt-2"><?php echo e($category->name); ?></a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                            <button class="scroll-button right btn btn-outline-primary d-none d-xl-block"
                                id="scrollRight">
                                <span>&gt;</span>
                            </button>
                        </div>
                        <div
                            class="d-flex flex-nowrap border-top pt-3 pt-xl-0 mx-2 align-items-center justify-content-center justify-content-xl-end w-100 w-xl-auto">
                            <div class="nav-main-links">
                                <ul
                                    class="nav d-flex flex-wrap flex-xl-nowrap gap-2 gap-xl-4 align-items-center justify-content-center mb-2 mb-xl-0">
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('index')); ?>" class="nav-link text-secondary fs-5">Beranda</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('profile')); ?>"
                                            class="nav-link text-secondary fs-5">Profil</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('kontak')); ?>" class="nav-link text-secondary fs-5">Kontak
                                            Kami</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('tentang')); ?>" class="nav-link text-secondary fs-5">Tentang
                                            Kami</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="<?php echo e(route('titip-tulisan.create')); ?>"
                                            class="nav-link text-secondary fs-5">Buat Tulisan</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="ms-xl-3">
                                <button
                                    class="btn-search btn border border-primary btn-md-square rounded-circle bg-white"
                                    data-bs-toggle="modal" data-bs-target="#searchModal">
                                    <i class="fas fa-search text-primary"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Modal Pencarian Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content rounded-0">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Cari berdasarkan kata kunci
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                </div>
                <div class="modal-body d-flex align-items-center">
                    <div class="input-group w-75 mx-auto d-flex">
                        <input type="search" class="form-control p-3" placeholder="masukkan kata kunci"
                            aria-describedby="search-icon-1" />
                        <span id="search-icon-1" class="input-group-text p-3"><i class="fa fa-search"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Pencarian End -->

    <?php echo $__env->yieldContent('content'); ?>

    <!-- Footer Start -->
    <div class="container-fluid bg-dark footer py-5">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="footer-item-1">
                        <h4 class="mb-4 text-white">Hubungi Kami</h4>

                        <p class="text-secondary line-h">
                            Alamat: <span class="text-white">Jl. Ule-Kedo, Kelurahan Ule, Kota Bima — 84119</span>
                        </p>

                        <p class="text-secondary line-h">
                            Email: <span class="text-white">sulaimansut@gmail.com</span>
                        </p>

                        <p class="text-secondary line-h">
                            Telepon: <span class="text-white">0822-1311-6457</span>
                        </p>

                        <div class="d-flex line-h">
                            <a class="btn btn-light me-2 btn-md-square rounded-circle"
                                href="https://x.com/Kelurahan_Kolo?t=JqoIVX5fQpyYA4DbHA2Iww&s=09" target="_blank">
                                <i class="fab fa-twitter text-dark"></i>
                            </a>
                            <a class="btn btn-light me-2 btn-md-square rounded-circle"
                                href="https://www.facebook.com/profile.php?id=61570249997037" target="_blank">
                                <i class="fab fa-facebook-f text-dark"></i>
                            </a>
                            <a class="btn btn-light me-2 btn-md-square rounded-circle"
                                href="https://www.youtube.com/@Lentera_kolo" target="_blank">
                                <i class="fab fa-youtube text-dark"></i>
                            </a>
                            <a class="btn btn-light me-2 btn-md-square rounded-circle"
                                href="https://www.instagram.com/lentera_kolo?igsh=d2NhMGE4ZHlxYnFk" target="_blank">
                                <i class="fab fa-instagram text-dark"></i>
                            </a>
                            <a class="btn btn-light btn-md-square rounded-circle"
                                href="https://vm.tiktok.com/ZSHvs7DBJJ4Th-vbkWu/" target="_blank">
                                <i class="fab fa-tiktok text-dark"></i>
                            </a>
                        </div>

                    </div>
                </div>

                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="footer-item-2">
                        <?php $__currentLoopData = \App\Models\News::where('status', 'Accept')->orderBy('created_at', 'desc')->take(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex flex-column mb-4">
                                <h4 class="mb-4 text-white">Berita Terbaru</h4>
                                <a href="<?php echo e(route('news.viewCategory', $news->category->id)); ?>">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle border border-2 border-primary overflow-hidden">
                                            <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                                class="img-zoomin img-fluid rounded-circle w-100" alt=""
                                                style="width: 100px; height: 100px; object-fit: cover;" />
                                        </div>
                                        <div class="d-flex flex-column ps-4">
                                            <p class="text-uppercase text-white mb-3"><?php echo e($news->category->name); ?></p>
                                            <a href="<?php echo e(route('news.show', $news->id)); ?>" class="h6 text-white">
                                                <?php echo e($news->title); ?>

                                            </a>
                                            <small class="text-white d-block"><i class="fas fa-calendar-alt me-1"></i>
                                                <?php echo e($news->created_at->translatedFormat('j F Y')); ?></small>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = \App\Models\News::where('status', 'Accept')->orderBy('created_at', 'desc')->skip(1)->take(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="d-flex flex-column">
                                <a href="<?php echo e(route('news.viewCategory', $news->category->id)); ?>">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle border border-2 border-primary overflow-hidden">
                                            <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                                class="img-zoomin img-fluid rounded-circle w-100" alt=""
                                                style="width: 100px; height: 100px; object-fit: cover;" />
                                        </div>
                                        <div class="d-flex flex-column ps-4">
                                            <p class="text-uppercase text-white mb-3"><?php echo e($news->category->name); ?></p>
                                            <a href="<?php echo e(route('news.show', $news->id)); ?>" class="h6 text-white">
                                                <?php echo e($news->title); ?>

                                            </a>
                                            <small class="text-white d-block"><i class="fas fa-calendar-alt me-1"></i>
                                                <?php echo e($news->created_at->translatedFormat('j F Y')); ?></small>
                                            </small>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-xl-3">
                    <div class="d-flex flex-column text-start footer-item-3">
                        <h4 class="mb-4 text-white">Kategori</h4>
                        <?php $__currentLoopData = \App\Models\Category::orderBy('views', 'desc')->take(6)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a class="btn-link text-white"
                                href="<?php echo e(route('news.viewCategory', $categories->id)); ?>"><i
                                    class="fas fa-angle-right text-white me-2"></i> <?php echo e($categories->name); ?></a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <!-- Hak Cipta Start -->
    <div class="container-fluid copyright bg-dark py-4">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 text-center text-md-start mb-3 mb-md-0">
                    <span class="text-light"><a href="#"><i
                                class="fas fa-copyright text-light me-2"></i>Sulaiman</a>, Hak cipta dilindungi.</span>
                </div>
                <div class="col-12 col-md-6 my-auto text-center text-md-end text-white">
                    <!--/*** This template is free as long as you keep the below author's credit link/attribution link/backlink. ***/-->
                    <!--/*** If you'd like to use the template without the below author's credit link/attribution link/backlink, ***/-->
                    <!--/*** you can purchase the Credit Removal License from "https://htmlcodex.com/credit-removal". ***/-->
                    Dirancang Oleh
                    <a class="border-bottom"
                        href="https://www.instagram.com/sulaiman_nabiyan_ali?igsh=MXU2ZjhidGV0OGJrag==">Sulaiman</a>
                    Didistribusikan Oleh <a
                        href="https://www.instagram.com/sulaiman_nabiyan_ali?igsh=MXU2ZjhidGV0OGJrag==">Sulaiman</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Hak Cipta End -->

    <!-- Kembali ke Atas -->
    <a href="#" class="btn btn-primary border-2 border-white rounded-circle back-to-top"><i
            class="fa fa-arrow-up"></i></a>

    <!-- JavaScript Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo e(asset('th/lib/easing/easing.min.js')); ?>"></script>
    <script src="<?php echo e(asset('th/lib/waypoints/waypoints.min.js')); ?>"></script>
    <script src="<?php echo e(asset('th/lib/owlcarousel/owl.carousel.min.js')); ?>"></script>

    <!-- Template Javascript -->
    <script src="<?php echo e(asset('th/js/main.js')); ?>"></script>

    
    <script src="<?php echo e(asset('js/shortcut.js')); ?>"></script>
    <script src="<?php echo e(asset('js/scroll.js')); ?>"></script>

    <script>
        // Script untuk membuat navbar lebih responsif
        document.addEventListener('DOMContentLoaded', function() {
            // Responsif untuk navbar toggle
            const navbarToggler = document.querySelector('.navbar-toggler');
            const navbarCollapse = document.getElementById('navbarCollapse');

            if (navbarToggler && navbarCollapse) {
                navbarToggler.addEventListener('click', function() {
                    navbarCollapse.classList.toggle('show');
                });
            }

            // Adjust navbar on window resize
            function adjustNavbar() {
                const navMainLinks = document.querySelector('.nav-main-links');
                const btnSearch = document.querySelector('.btn-search');

                if (window.innerWidth < 992) {
                    // Pada layar kecil, pastikan elemen berada dalam kolom
                    if (navMainLinks && btnSearch) {
                        const parent = navMainLinks.parentElement;
                        if (parent && !parent.classList.contains('flex-column')) {
                            parent.classList.add('flex-column');
                        }
                    }
                } else {
                    // Pada layar besar, kembalikan ke layout normal
                    if (navMainLinks && btnSearch) {
                        const parent = navMainLinks.parentElement;
                        if (parent && parent.classList.contains('flex-column')) {
                            parent.classList.remove('flex-column');
                        }
                    }
                }
            }

            // Panggil fungsi saat resize
            window.addEventListener('resize', adjustNavbar);
            // Panggil sekali saat load
            adjustNavbar();
        });
    </script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>

</html>
<?php /**PATH C:\website\lentera-kolo\resources\views/layouts/app.blade.php ENDPATH**/ ?>