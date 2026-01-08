<?php $__env->startSection('content'); ?>
    <!-- Single Product Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <ol class="breadcrumb justify-content-start mb-4">
                <li class="breadcrumb-item"><a href="<?php echo e(route('index')); ?>">Home</a></li>
                <?php if($titipTulisan->category): ?>
                    <li class="breadcrumb-item"><a
                            href="<?php echo e(route('news.viewCategory', $titipTulisan->category->slug)); ?>"><?php echo e($titipTulisan->category->name); ?></a>
                    </li>
                <?php endif; ?>
                <li class="breadcrumb-item active text-dark"><?php echo e($titipTulisan->judul); ?></li>
            </ol>
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="mb-4">
                        <h1 class="display-5"><?php echo e($titipTulisan->judul); ?></h1>
                        <div class="d-flex mt-3 flex-wrap">
                            <div class="text-dark me-4 mb-2"><i class="fa fa-clock"></i>
                                <?php echo e($titipTulisan->created_at->translatedFormat('d F Y H:i')); ?></div>
                            <div class="text-dark me-4 mb-2"><i class="fa fa-eye"></i> <?php echo e($titipTulisan->views ?? 0); ?></div>
                            <div class="text-dark me-4 mb-2"><i class="fa fa-thumbs-up"></i>
                                <?php echo e($titipTulisan->likes->count()); ?>

                            </div>
                            <div class="text-dark mb-2"><i class="fa fa-user"></i> <?php echo e($titipTulisan->nama_pengirim); ?></div>
                        </div>
                    </div>

                    <!-- Tombol Bagikan -->
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <span class="me-3 fw-medium">Bagikan:</span>
                            <div class="d-flex flex-wrap gap-2">
                                <!-- Facebook -->
                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(url()->current())); ?>&quote=<?php echo e(urlencode($titipTulisan->judul)); ?>"
                                    target="_blank"
                                    class="btn btn-sm btn-primary d-flex align-items-center px-3 py-2 share-btn">
                                    <i class="fab fa-facebook-f me-2"></i>
                                    <span>Facebook</span>
                                </a>

                                <!-- Twitter -->
                                <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($titipTulisan->judul)); ?>"
                                    target="_blank"
                                    class="btn btn-sm btn-info d-flex align-items-center px-3 py-2 share-btn">
                                    <i class="fab fa-twitter me-2"></i>
                                    <span>Twitter</span>
                                </a>

                                <!-- WhatsApp -->
                                <a href="https://wa.me/?text=<?php echo e(urlencode($titipTulisan->judul . ' - ' . url()->current())); ?>"
                                    target="_blank"
                                    class="btn btn-sm btn-success d-flex align-items-center px-3 py-2 share-btn">
                                    <i class="fab fa-whatsapp me-2"></i>
                                    <span>WhatsApp</span>
                                </a>

                                <!-- Telegram -->
                                <a href="https://t.me/share/url?url=<?php echo e(urlencode(url()->current())); ?>&text=<?php echo e(urlencode($titipTulisan->judul)); ?>"
                                    target="_blank"
                                    class="btn btn-sm btn-primary d-flex align-items-center px-3 py-2 share-btn">
                                    <i class="fab fa-telegram me-2"></i>
                                    <span>Telegram</span>
                                </a>

                                <!-- Salin Tautan -->
                                <button type="button"
                                    class="btn btn-sm btn-secondary d-flex align-items-center px-3 py-2 share-btn copy-link"
                                    data-url="<?php echo e(url()->current()); ?>">
                                    <i class="fas fa-link me-2"></i>
                                    <span>Salin Tautan</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="position-relative rounded overflow-hidden mb-4">
                        <img src="<?php echo e($titipTulisan->image ? asset('storage/titip-tulisan/' . $titipTulisan->image) : asset('img/noimg.jpg')); ?>"
                            class="img-zoomin img-fluid rounded w-100" alt=""
                            style="max-height: 500px; object-fit: cover;">
                        <?php if($titipTulisan->category): ?>
                            <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                                style="top: 20px; right: 20px;">
                                <?php echo e($titipTulisan->category->name); ?>

                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="content mb-5">
                        <?php echo nl2br(e($titipTulisan->isi)); ?>

                    </div>

                    <div class="tab-class mb-5">
                        <div class="d-flex justify-content-between border-bottom mb-4 flex-wrap">
                            <ul class="nav nav-pills d-inline-flex text-center mb-2">
                                <li class="nav-item mb-3">
                                    <h5 class="mt-2 me-3 mb-0">Tag:</h5>
                                </li>
                                <?php if($titipTulisan->category): ?>
                                    <li class="nav-item mb-3">
                                        <a href="<?php echo e(route('news.viewCategory', $titipTulisan->category->slug)); ?>"
                                            class="d-flex py-2 bg-light rounded-pill active me-2">
                                            <span class="text-dark"
                                                style="width: 100px;"><?php echo e($titipTulisan->category->name); ?></span>
                                        </a>
                                    </li>
                                <?php endif; ?>
                            </ul>
                            <div class="d-flex align-items-center mb-2">
                                <?php if(auth()->guard()->check()): ?>
                                    <form action="<?php echo e(route('titip-tulisan.like', $titipTulisan->id)); ?>" method="POST" class="like-form">
                                        <?php echo csrf_field(); ?>
                                        <?php
                                            $userLiked = $titipTulisan->likes->where('user_id', auth()->id())->count() > 0;
                                        ?>
                                        <button type="submit" class="btn btn-square like-button"
                                            data-liked="<?php echo e($userLiked ? 'true' : 'false'); ?>">
                                            <?php if($userLiked): ?>
                                                <i class="fas fa-thumbs-up text-primary"></i>
                                            <?php else: ?>
                                                <i class="far fa-thumbs-up text-primary"></i>
                                            <?php endif; ?>
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <a href="<?php echo e(route('login')); ?>" class="btn btn-square">
                                        <i class="far fa-thumbs-up text-primary"></i>
                                    </a>
                                <?php endif; ?>
                                <span class="ms-1 like-count"><?php echo e($titipTulisan->likes->count()); ?></span>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active">
                                <div class="row g-4 align-items-center">
                                    <div class="col-3">
                                        <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center rounded-circle"
                                             style="width: 100px; height: 100px; font-size: 2.5rem; font-weight: bold;">
                                            <?php echo e(strtoupper(substr($titipTulisan->nama_pengirim, 0, 1))); ?>

                                        </div>
                                    </div>
                                    <div class="col-9">
                                        <h3><?php echo e($titipTulisan->nama_pengirim); ?></h3>
                                        <p class="mb-2">
                                            <i class="fas fa-envelope me-1"></i><?php echo e($titipTulisan->email_pengirim); ?>

                                        </p>
                                        <p class="mb-0">Kontributor Titip Tulisan</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Bagian Komentar -->
                    <div class="comments-section bg-white rounded-lg shadow-lg p-5 mt-6">
                        <div class="d-flex align-items-center mb-5 pb-3 border-bottom">
                            <h3 class="h4 fw-bold text-gray-800 mb-0">
                                <i class="fas fa-comments text-primary me-2"></i>
                                Komentar (<span id="commentsCount"><?php echo e($titipTulisan->comments_count ?? 0); ?></span>)
                            </h3>
                        </div>

                        <!-- Form Komentar -->
                        <div class="comment-form mb-6 bg-light rounded p-4 border">
                            <h4 class="h5 fw-semibold mb-3 text-gray-700">Tambah Komentar</h4>
                            <form id="commentForm" action="<?php echo e(route('comments.store')); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="commentable_type" value="titip-tulisan">
                                <input type="hidden" name="commentable_id" value="<?php echo e($titipTulisan->id); ?>">

                                <div class="mb-3">
                                    <label for="content" class="form-label fw-medium text-gray-700 mb-2">
                                        Komentar Anda <span class="text-danger">*</span>
                                    </label>
                                    <textarea name="content" id="content" rows="4"
                                        class="form-control px-3 py-2 border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary transition resize-none"
                                        placeholder="Tulis komentar Anda di sini..." required maxlength="2000"></textarea>
                                    <div class="text-sm text-muted mt-1 d-flex justify-content-between">
                                        <span>Minimal 3 karakter</span>
                                        <span id="charCount">0/2000</span>
                                    </div>
                                </div>

                                <!-- Jika pengguna belum login -->
                                <?php if(auth()->guard()->guest()): ?>
                                    <div class="row g-3 mb-4">
                                        <div class="col-md-6">
                                            <label for="name" class="form-label text-gray-700">
                                                Nama
                                            </label>
                                            <input type="text" name="name" id="name"
                                                class="form-control px-3 py-2 border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary"
                                                placeholder="Masukkan nama Anda" maxlength="255">
                                            <small class="text-muted">Kosongkan untuk "Anonim"</small>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="email" class="form-label text-gray-700">
                                                Email
                                            </label>
                                            <input type="email" name="email" id="email"
                                                class="form-control px-3 py-2 border-gray-300 rounded focus:ring-2 focus:ring-primary focus:border-primary"
                                                placeholder="Masukkan email Anda (opsional)" maxlength="255">
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <div class="d-flex justify-content-end mt-4">
                                    <button type="submit" id="submitBtn"
                                        class="btn btn-primary px-4 py-2 rounded transition d-flex align-items-center shadow-sm hover-shadow">
                                        <span id="submitText">
                                            <i class="fas fa-paper-plane me-2"></i>Kirim Komentar
                                        </span>
                                        <div id="loadingSpinner" class="d-none ms-2 spinner-border spinner-border-sm" role="status">
                                            <span class="visually-hidden">Loading...</span>
                                        </div>
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Daftar Komentar -->
                        <div id="commentsList" class="comments-list">
                            <?php $__empty_1 = true; $__currentLoopData = $titipTulisan->comments->whereNull('deleted_at'); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="comment-item mb-4 pb-4 border-bottom">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center rounded-circle"
                                                 style="width: 50px; height: 50px; font-size: 1.25rem; font-weight: bold;">
                                                <?php echo e(strtoupper(substr($comment->author_name, 0, 1))); ?>

                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h5 class="mb-1 fw-bold text-gray-800 d-inline-block me-2">
                                                        <?php echo e($comment->author_name); ?>

                                                    </h5>
                                                    <?php if($comment->user_id): ?>
                                                        <span class="badge bg-primary-subtle text-primary fs-6">
                                                            <i class="fas fa-user-check me-1"></i>Pengguna
                                                        </span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary-subtle text-secondary fs-6">
                                                            <i class="fas fa-user me-1"></i>Tamu
                                                        </span>
                                                    <?php endif; ?>
                                                    <?php if(Auth::check() && Auth::user()->is_admin && $comment->author_email): ?>
                                                        <span class="text-muted ms-2 fs-6">
                                                            (<?php echo e($comment->author_email); ?>)
                                                        </span>
                                                    <?php endif; ?>
                                                </div>

                                                <!-- Tombol hapus untuk admin -->
                                                <?php if(Auth::check() && Auth::user()->is_admin): ?>
                                                    <form action="<?php echo e(route('admin.comments.destroy', $comment->id)); ?>"
                                                        method="POST" class="delete-comment-form d-inline"
                                                        data-comment-id="<?php echo e($comment->id); ?>">
                                                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                        <button type="submit"
                                                            class="btn btn-sm btn-link text-danger p-0"
                                                            title="Hapus komentar"
                                                            onclick="return confirm('Hapus komentar ini?')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                            <p class="text-muted mb-2">
                                                <i class="far fa-clock me-1"></i><?php echo e($comment->created_at->diffForHumans()); ?>

                                            </p>
                                        </div>
                                    </div>

                                    <div class="comment-content bg-white p-3 rounded border">
                                        <p class="mb-0 text-gray-700">
                                            <?php echo nl2br(e($comment->content)); ?>

                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div id="noComments" class="text-center py-5 bg-light rounded">
                                    <div class="text-muted mb-3">
                                        <i class="fas fa-comment-slash fa-3x"></i>
                                    </div>
                                    <h4 class="h5 fw-semibold text-gray-600 mb-2">Belum ada komentar</h4>
                                    <p class="text-muted">Jadilah yang pertama berkomentar!</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Tombol Muat Lebih Banyak -->
                        <?php if($titipTulisan->comments_count > 5): ?>
                            <div class="text-center mt-5">
                                <button id="loadMoreBtn"
                                    class="btn btn-outline-primary px-4 py-2 rounded">
                                    <i class="fas fa-sync-alt me-2"></i>Muat Lebih Banyak Komentar
                                </button>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Bagian Media Sosial -->
                    <div class="bg-light rounded p-4 mb-4">
                        <h4 class="mb-3">Ikuti Kami</h4>
                        <p class="text-muted mb-3">Ikuti kami di media sosial untuk informasi terbaru</p>
                        <div class="d-flex flex-wrap gap-2">
                            <!-- Facebook -->
                            <a href="https://www.facebook.com/profile.php?id=61570249997037" target="_blank"
                                class="btn btn-primary d-flex align-items-center px-3 py-2 social-follow">
                                <i class="fab fa-facebook-f me-2 fs-5"></i>
                                <span>Facebook</span>
                            </a>

                            <!-- Instagram -->
                            <a href="https://www.instagram.com/" target="_blank"
                                class="btn btn-danger d-flex align-items-center px-3 py-2 social-follow">
                                <i class="fab fa-instagram me-2 fs-5"></i>
                                <span>Instagram</span>
                            </a>

                            <!-- Twitter -->
                            <a href="https://x.com/Kelurahan_Kolo?t=JqoIVX5fQpyYA4DbHA2Iww&s=09" target="_blank"
                                class="btn btn-info d-flex align-items-center px-3 py-2 social-follow">
                                <i class="fab fa-twitter me-2 fs-5"></i>
                                <span>Twitter</span>
                            </a>

                            <!-- YouTube -->
                            <a href="https://www.youtube.com/@Lentera_kolo" target="_blank"
                                class="btn btn-danger d-flex align-items-center px-3 py-2 social-follow">
                                <i class="fab fa-youtube me-2 fs-5"></i>
                                <span>YouTube</span>
                            </a>

                            <!-- TikTok -->
                            <a href="https://vm.tiktok.com/ZSHvs7DBJJ4Th-vbkWu/" target="_blank"
                                class="btn btn-dark d-flex align-items-center px-3 py-2 social-follow">
                                <i class="fab fa-tiktok me-2 fs-5"></i>
                                <span>TikTok</span>
                            </a>

                            <!-- WhatsApp -->
                            <a href="https://wa.me/" target="_blank"
                                class="btn btn-success d-flex align-items-center px-3 py-2 social-follow">
                                <i class="fab fa-whatsapp me-2 fs-5"></i>
                                <span>WhatsApp</span>
                            </a>

                            <!-- Telegram -->
                            <a href="https://t.me/" target="_blank"
                                class="btn btn-primary d-flex align-items-center px-3 py-2 social-follow">
                                <i class="fab fa-telegram me-2 fs-5"></i>
                                <span>Telegram</span>
                            </a>
                        </div>
                    </div>

                    <?php if($random->isNotEmpty()): ?>
                        <div class="bg-light rounded my-4 p-4">
                            <h4 class="mb-4">Titip Tulisan Lainnya</h4>
                            <div class="row g-4">
                                <?php $__currentLoopData = $random; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $randomTitip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-lg-6">
                                        <div class="d-flex align-items-center p-3 bg-white rounded h-100">
                                            <div class="flex-shrink-0">
                                                <img src="<?php echo e($randomTitip->image ? asset('storage/titip-tulisan/' . $randomTitip->image) : asset('img/noimg.jpg')); ?>"
                                                    class="img-fluid rounded" alt=""
                                                    style="width: 100px; height: 100px; object-fit: cover;">
                                            </div>
                                            <div class="ms-3">
                                                <a href="<?php echo e(route('titip-tulisan.show', $randomTitip->slug)); ?>"
                                                    class="h6 mb-2 d-block"><?php echo e(Str::limit($randomTitip->judul, 50, '...')); ?></a>
                                                <p class="text-dark mt-2 mb-0">
                                                    <i class="fa fa-clock"></i>
                                                    <?php echo e($randomTitip->created_at->translatedFormat('d F Y')); ?>

                                                </p>
                                                <p class="text-muted mb-0">
                                                    <i class="fa fa-user"></i> <?php echo e($randomTitip->nama_pengirim); ?>

                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="col-lg-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h5 class="mb-3">Cari Konten</h5>
                                <form action="<?php echo e(route('search')); ?>" method="GET">
                                    <div class="input-group w-100 mx-auto d-flex mb-4">
                                        <input type="search" name="q" class="form-control p-3"
                                            placeholder="kata kunci" aria-describedby="search-icon-1"
                                            value="<?php echo e(request('q')); ?>">
                                        <button type="submit" id="search-icon-1"
                                            class="btn btn-primary input-group-text p-3">
                                            <i class="fa fa-search text-white"></i>
                                        </button>
                                    </div>
                                </form>

                                <?php $__env->startComponent('components.col-2'); ?>
                                <?php echo $__env->renderComponent(); ?>

                            </div>
                        </div>

                        <!-- Sidebar Berita Terbaru -->
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h5 class="mb-3">Berita Terbaru</h5>
                                <?php $__currentLoopData = \App\Models\News::where('status', 'Accept')->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mb-3 pb-2 border-bottom">
                                        <a href="<?php echo e(route('news.show', $latest->slug)); ?>"
                                            class="h6 d-block text-decoration-none">
                                            <?php echo e(Str::limit($latest->title, 40, '...')); ?>

                                        </a>
                                        <small class="text-muted">
                                            <i class="fa fa-clock"></i> <?php echo e($latest->created_at->diffForHumans()); ?>

                                        </small>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- Sidebar Titip Tulisan Terbaru -->
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h5 class="mb-3">Titip Tulisan Terbaru</h5>
                                <?php $__currentLoopData = \App\Models\TitipTulisan::where('status', 'Accept')->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latestTitip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mb-3 pb-2 border-bottom">
                                        <a href="<?php echo e(route('titip-tulisan.show', $latestTitip->slug)); ?>"
                                            class="h6 d-block text-decoration-none">
                                            <?php echo e(Str::limit($latestTitip->judul, 40, '...')); ?>

                                        </a>
                                        <small class="text-muted">
                                            <i class="fa fa-clock"></i> <?php echo e($latestTitip->created_at->diffForHumans()); ?>

                                        </small>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                        <!-- Sidebar Media Sosial -->
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h5 class="mb-3">Terhubung dengan Kami</h5>
                                <div class="d-flex flex-wrap gap-2 mb-3">
                                    <a href="https://www.facebook.com/profile.php?id=61570249997037" target="_blank"
                                        class="btn btn-primary btn-sm">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://x.com/Kelurahan_Kolo?t=JqoIVX5fQpyYA4DbHA2Iww&s=09" target="_blank"
                                        class="btn btn-info btn-sm">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://www.instagram.com/" target="_blank" class="btn btn-danger btn-sm">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                    <a href="https://wa.me/" target="_blank" class="btn btn-success btn-sm">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <a href="https://t.me/" target="_blank" class="btn btn-primary btn-sm">
                                        <i class="fab fa-telegram"></i>
                                    </a>
                                    <a href="https://www.youtube.com/@Lentera_kolo" target="_blank"
                                        class="btn btn-danger btn-sm">
                                        <i class="fab fa-youtube"></i>
                                    </a>
                                    <a href="https://vm.tiktok.com/ZSHvs7DBJJ4Th-vbkWu/" target="_blank"
                                        class="btn btn-dark btn-sm">
                                        <i class="fab fa-tiktok"></i>
                                    </a>
                                </div>
                                <p class="text-muted small mb-0">Ikuti kami untuk informasi terbaru</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single Product End -->

    <style>
        .content img {
            max-width: 100%;
            height: auto;
            margin: 20px 0;
            border-radius: 8px;
        }

        .content p {
            line-height: 1.8;
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .content h2,
        .content h3,
        .content h4 {
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #2c3e50;
        }

        .content ul,
        .content ol {
            margin-bottom: 1.5rem;
            padding-left: 1.5rem;
        }

        .content li {
            margin-bottom: 0.5rem;
        }

        .content blockquote {
            border-left: 4px solid #3498db;
            padding-left: 1rem;
            margin-left: 0;
            font-style: italic;
            color: #555;
        }

        .breadcrumb-item a {
            color: #3498db;
            text-decoration: none;
        }

        .breadcrumb-item a:hover {
            text-decoration: underline;
        }

        .btn-square {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            background: white;
            transition: all 0.3s;
        }

        .btn-square:hover {
            background: #f8f9fa;
            border-color: #3498db;
        }

        .share-btn,
        .social-follow {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .share-btn:hover,
        .social-follow:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-color: rgba(0, 0, 0, 0.1);
        }

        .like-button {
            transition: all 0.3s ease;
        }

        .like-button:hover {
            background-color: #f8f9fa;
            border-color: #3498db;
        }

        /* Styling untuk bagian komentar */
        .comment-content {
            margin-left: 63px; /* Sesuaikan dengan lebar avatar + margin */
        }

        .avatar-circle {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .comments-section {
            border: 1px solid #e5e7eb;
        }

        .comment-form textarea {
            min-height: 120px;
        }

        .comment-item:last-child {
            border-bottom: none !important;
            margin-bottom: 0 !important;
            padding-bottom: 0 !important;
        }

        @media (max-width: 768px) {
            .d-flex.flex-wrap {
                flex-direction: column;
                align-items: flex-start;
            }

            .d-flex.flex-wrap>div {
                margin-bottom: 10px;
            }

            .position-absolute.text-white {
                font-size: 0.8rem;
                padding: 4px 8px;
                top: 10px !important;
                right: 10px !important;
            }

            .comment-content {
                margin-left: 0;
                margin-top: 15px;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const commentForm = document.getElementById('commentForm');
            const commentsList = document.getElementById('commentsList');
            const noComments = document.getElementById('noComments');
            const submitBtn = document.getElementById('submitBtn');
            const submitText = document.getElementById('submitText');
            const loadingSpinner = document.getElementById('loadingSpinner');
            const contentTextarea = document.getElementById('content');
            const charCount = document.getElementById('charCount');

            // Penghitung karakter
            if (contentTextarea && charCount) {
                contentTextarea.addEventListener('input', function() {
                    const length = this.value.length;
                    charCount.textContent = `${length}/2000`;

                    if (length > 1900) {
                        charCount.classList.add('text-danger');
                    } else {
                        charCount.classList.remove('text-danger');
                    }
                });
            }

            // Handler pengiriman form
            if (commentForm) {
                commentForm.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    // Validasi
                    const content = contentTextarea.value.trim();
                    if (content.length < 3) {
                        showToast('Komentar minimal 3 karakter', 'warning');
                        return;
                    }

                    // Tampilkan status loading
                    submitText.innerHTML = '<i class="fas fa-spinner me-2"></i>Mengirim...';
                    loadingSpinner.classList.remove('d-none');
                    submitBtn.disabled = true;

                    try {
                        const formData = new FormData(this);

                        const response = await fetch('<?php echo e(route('comments.store')); ?>', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: formData
                        });

                        const result = await response.json();

                        if (result.success) {
                            // Reset form
                            this.reset();
                            charCount.textContent = '0/2000';

                            // Tampilkan pesan sukses
                            showToast('Komentar berhasil ditambahkan!', 'success');

                            // Sembunyikan pesan "belum ada komentar" jika ada
                            if (noComments) {
                                noComments.remove();
                            }

                            // Buat elemen komentar baru
                            const comment = result.comment;
                            const commentHtml = createCommentHtml(comment);

                            // Tambahkan ke daftar komentar
                            if (commentsList.querySelector('#noComments')) {
                                commentsList.innerHTML = commentHtml;
                            } else {
                                commentsList.insertAdjacentHTML('afterbegin', commentHtml);
                            }

                            // Perbarui jumlah komentar
                            const commentsCountElement = document.getElementById('commentsCount');
                            if (commentsCountElement) {
                                const currentCount = parseInt(commentsCountElement.textContent) || 0;
                                commentsCountElement.textContent = currentCount + 1;
                            }

                        } else {
                            // Tampilkan error validasi
                            let errorMessage = 'Gagal mengirim komentar';
                            if (result.errors) {
                                errorMessage = Object.values(result.errors).flat().join(', ');
                            }
                            showToast(errorMessage, 'danger');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showToast('Terjadi kesalahan saat mengirim komentar', 'danger');
                    } finally {
                        // Reset status tombol
                        submitText.innerHTML = '<i class="fas fa-paper-plane me-2"></i>Kirim Komentar';
                        loadingSpinner.classList.add('d-none');
                        submitBtn.disabled = false;
                    }
                });
            }

            // Fungsi untuk membuat HTML komentar
            function createCommentHtml(comment) {
                const isAdmin = <?php echo e(Auth::check() && Auth::user()->is_admin ? 'true' : 'false'); ?>;
                const userType = comment.user_id ?
                    '<span class="badge bg-primary-subtle text-primary fs-6"><i class="fas fa-user-check me-1"></i>Pengguna</span>' :
                    '<span class="badge bg-secondary-subtle text-secondary fs-6"><i class="fas fa-user me-1"></i>Tamu</span>';

                const adminEmail = isAdmin && comment.email ?
                    `<span class="text-muted ms-2 fs-6">(${comment.email})</span>` : '';

                const deleteButton = isAdmin ?
                    `<form action="/admin/comments/${comment.id}" method="POST" class="delete-comment-form d-inline" data-comment-id="${comment.id}">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-link text-danger p-0 ms-2" title="Hapus komentar" onclick="return confirm('Hapus komentar ini?')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>` : '';

                return `
                    <div class="comment-item mb-4 pb-4 border-bottom">
                        <div class="d-flex align-items-start mb-3">
                            <div class="flex-shrink-0 me-3">
                                <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center rounded-circle"
                                     style="width: 50px; height: 50px; font-size: 1.25rem; font-weight: bold;">
                                    ${comment.user ? comment.user.name.charAt(0) : (comment.name ? comment.name.charAt(0) : 'A')}
                                </div>
                            </div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h5 class="mb-1 fw-bold text-gray-800 d-inline-block me-2">
                                            ${comment.user ? comment.user.name : (comment.name || 'Anonim')}
                                        </h5>
                                        ${userType}
                                        ${adminEmail}
                                    </div>
                                    ${deleteButton}
                                </div>
                                <p class="text-muted mb-2">
                                    <i class="far fa-clock me-1"></i>Baru saja
                                </p>
                            </div>
                        </div>

                        <div class="comment-content bg-white p-3 rounded border">
                            <p class="mb-0 text-gray-700">
                                ${comment.content.replace(/\n/g, '<br>')}
                            </p>
                        </div>
                    </div>
                `;
            }

            // Muat lebih banyak komentar
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', async function() {
                    const currentCount = document.querySelectorAll('.comment-item').length;
                    const commentableType = document.querySelector('input[name="commentable_type"]').value;
                    const commentableId = document.querySelector('input[name="commentable_id"]').value;

                    try {
                        const response = await fetch(
                            `/comments/get?commentable_type=${commentableType}&commentable_id=${commentableId}&page=${Math.floor(currentCount / 10) + 1}`
                        );
                        const result = await response.json();

                        if (result.success && result.comments.data.length > 0) {
                            result.comments.data.forEach(comment => {
                                const commentHtml = createCommentHtml(comment);
                                commentsList.insertAdjacentHTML('beforeend', commentHtml);
                            });

                            // Sembunyikan tombol muat lebih banyak jika tidak ada lagi komentar
                            if (!result.comments.next_page_url) {
                                loadMoreBtn.style.display = 'none';
                            }
                        }
                    } catch (error) {
                        console.error('Error memuat lebih banyak komentar:', error);
                    }
                });
            }

            // Fungsi notifikasi toast
            function showToast(message, type) {
                // Hapus toast yang ada
                document.querySelectorAll('.toast-alert').forEach(toast => toast.remove());

                // Buat elemen toast
                const toast = document.createElement('div');
                const icon = type === 'success' ? 'check-circle' :
                    type === 'warning' ? 'exclamation-triangle' :
                    type === 'danger' ? 'exclamation-circle' : 'info-circle';

                toast.className = `toast-alert alert alert-${type} alert-dismissible fade show position-fixed`;
                toast.style.cssText = `
                    top: 20px;
                    right: 20px;
                    z-index: 9999;
                    min-width: 300px;
                    animation: slideIn 0.3s ease;
                    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
                `;

                toast.innerHTML = `
                    <div class="d-flex align-items-center">
                        <i class="fas fa-${icon} me-3 fs-5"></i>
                        <div class="flex-grow-1">${message}</div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                `;

                document.body.appendChild(toast);

                // Otomatis tutup setelah 5 detik
                setTimeout(() => {
                    if (toast.parentNode) {
                        const bsAlert = new bootstrap.Alert(toast);
                        bsAlert.close();
                    }
                }, 5000);
            }

            // Tambahkan CSS animasi
            if (!document.querySelector('#toast-animations')) {
                const style = document.createElement('style');
                style.id = 'toast-animations';
                style.textContent = `
                    @keyframes slideIn {
                        from {
                            transform: translateX(100%);
                            opacity: 0;
                        }
                        to {
                            transform: translateX(0);
                            opacity: 1;
                        }
                    }
                    .toast-alert {
                        border-radius: 8px;
                        border: none;
                    }
                `;
                document.head.appendChild(style);
            }

            // Fungsi untuk menyalin tautan
            const copyLinkBtn = document.querySelector('.copy-link');
            if (copyLinkBtn) {
                copyLinkBtn.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    navigator.clipboard.writeText(url).then(() => {
                        showToast('Tautan berhasil disalin!', 'success');
                    }).catch(() => {
                        showToast('Gagal menyalin tautan', 'danger');
                    });
                });
            }

            // Fungsi untuk like button
            const likeForms = document.querySelectorAll('.like-form');
            likeForms.forEach(form => {
                form.addEventListener('submit', async function(e) {
                    e.preventDefault();

                    const button = this.querySelector('.like-button');
                    const likeCount = this.nextElementSibling || this.parentElement.querySelector('.like-count');

                    try {
                        const response = await fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>',
                                'Accept': 'application/json'
                            }
                        });

                        const result = await response.json();

                        if (result.success) {
                            const isLiked = button.getAttribute('data-liked') === 'true';
                            button.setAttribute('data-liked', !isLiked);

                            if (isLiked) {
                                button.innerHTML = '<i class="far fa-thumbs-up text-primary"></i>';
                                likeCount.textContent = parseInt(likeCount.textContent) - 1;
                            } else {
                                button.innerHTML = '<i class="fas fa-thumbs-up text-primary"></i>';
                                likeCount.textContent = parseInt(likeCount.textContent) + 1;
                            }

                            showToast(result.message, 'success');
                        }
                    } catch (error) {
                        console.error('Error:', error);
                        showToast('Terjadi kesalahan', 'danger');
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/titip-tulisan/show.blade.php ENDPATH**/ ?>