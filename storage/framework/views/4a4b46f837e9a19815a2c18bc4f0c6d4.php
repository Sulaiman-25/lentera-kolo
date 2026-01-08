<?php $__env->startSection('content'); ?>

    <!-- Category Header End -->

    <!-- Category Content Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-8">
                    <!-- Tab Navigation -->
                    <ul class="nav nav-tabs mb-4" id="categoryTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="news-tab" data-bs-toggle="tab" data-bs-target="#news"
                                    type="button" role="tab" aria-controls="news" aria-selected="true">
                                <i class="fa fa-newspaper me-2"></i>Berita (<?php echo e($latestNews->total()); ?>)
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="titip-tab" data-bs-toggle="tab" data-bs-target="#titip"
                                    type="button" role="tab" aria-controls="titip" aria-selected="false">
                                <i class="fa fa-pen me-2"></i>Titip Tulisan (<?php echo e($latestTitip->total()); ?>)
                            </button>
                        </li>
                    </ul>

                    <!-- Tab Content -->
                    <div class="tab-content" id="categoryTabContent">
                        <!-- News Tab -->
                        <div class="tab-pane fade show active" id="news" role="tabpanel" aria-labelledby="news-tab">
                            <?php if($latestNews->count() > 0): ?>
                                <!-- Featured News -->
                                <?php if($latestNews->first()): ?>
                                    <?php $featuredNews = $latestNews->first(); ?>
                                    <div class="row g-4 mb-5">
                                        <div class="col-12">
                                            <div class="position-relative overflow-hidden rounded">
                                                <img src="<?php echo e($featuredNews->image ? asset('storage/images/' . $featuredNews->image) : asset('img/noimg.jpg')); ?>"
                                                    class="img-fluid rounded img-zoomin w-100" alt="" style="height: 400px; object-fit: cover;" />
                                                <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                                                    style="top: 20px; right: 20px">
                                                    <?php echo e($categories->name); ?>

                                                </div>
                                                <div class="position-absolute bottom-0 start-0 end-0 p-4 text-white"
                                                     style="background: linear-gradient(transparent, rgba(0,0,0,0.8))">
                                                    <a href="<?php echo e(route('news.show', $featuredNews->slug)); ?>"
                                                        class="h2 text-white text-decoration-none"><?php echo e($featuredNews->title); ?></a>
                                                    <div class="d-flex mt-3">
                                                        <div class="me-4"><i class="fa fa-clock"></i> <?php echo e($featuredNews->created_at->translatedFormat('d F Y')); ?></div>
                                                        <div class="me-4"><i class="fa fa-eye"></i> <?php echo e($featuredNews->views); ?></div>
                                                        <div><i class="fa fa-thumbs-up"></i> <?php echo e($featuredNews->likes->count()); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Other News Grid -->
                                <div class="row g-4">
                                    <?php $__currentLoopData = $latestNews->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="bg-light rounded overflow-hidden h-100">
                                                <div class="position-relative">
                                                    <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                                         class="img-fluid w-100" alt="<?php echo e($news->title); ?>"
                                                         style="height: 200px; object-fit: cover;">
                                                    <div class="position-absolute top-0 end-0 p-2">
                                                        <span class="badge bg-primary"><?php echo e($categories->name); ?></span>
                                                    </div>
                                                </div>
                                                <div class="p-4">
                                                    <a href="<?php echo e(route('news.show', $news->slug)); ?>"
                                                       class="h5 d-block mb-3 text-decoration-none text-dark link-hover">
                                                        <?php echo e(Str::limit($news->title, 70, '...')); ?>

                                                    </a>
                                                    <div class="d-flex justify-content-between text-muted small mb-3">
                                                        <span><i class="fa fa-user me-1"></i><?php echo e($news->author->name ?? 'Admin'); ?></span>
                                                        <span><i class="fa fa-calendar me-1"></i><?php echo e($news->created_at->translatedFormat('d M Y')); ?></span>
                                                    </div>
                                                    <p class="mb-0">
                                                        <?php echo Str::limit(strip_tags($news->content), 120, '...'); ?>

                                                    </p>
                                                    <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                                                        <small><i class="fa fa-eye me-1"></i><?php echo e($news->views); ?> views</small>
                                                        <small><i class="fa fa-thumbs-up me-1"></i><?php echo e($news->likes->count()); ?> likes</small>
                                                        <small><i class="fa fa-comment me-1"></i>0 comments</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <!-- Pagination -->
                                <?php if($latestNews->hasPages()): ?>
                                <div class="mt-5">
                                    <?php echo e($latestNews->appends(['titip_page' => $latestTitip->currentPage()])->links('pagination::bootstrap-5')); ?>

                                </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fa fa-newspaper fa-4x text-muted mb-3"></i>
                                    <h4 class="text-muted">Belum ada berita di kategori ini</h4>
                                    <p class="text-muted">Silakan kembali lagi nanti</p>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Titip Tulisan Tab -->
                        <div class="tab-pane fade" id="titip" role="tabpanel" aria-labelledby="titip-tab">
                            <?php if($latestTitip->count() > 0): ?>
                                <!-- Featured Titip Tulisan -->
                                <?php if($latestTitip->first()): ?>
                                    <?php $featuredTitip = $latestTitip->first(); ?>
                                    <div class="row g-4 mb-5">
                                        <div class="col-12">
                                            <div class="position-relative overflow-hidden rounded">
                                                <img src="<?php echo e($featuredTitip->image ? asset('storage/titip-tulisan/' . $featuredTitip->image) : asset('img/noimg.jpg')); ?>"
                                                    class="img-fluid rounded img-zoomin w-100" alt="" style="height: 400px; object-fit: cover;" />
                                                <div class="position-absolute text-white px-4 py-2 bg-success rounded"
                                                    style="top: 20px; right: 20px">
                                                    Titip Tulisan
                                                </div>
                                                <div class="position-absolute bottom-0 start-0 end-0 p-4 text-white"
                                                     style="background: linear-gradient(transparent, rgba(0,0,0,0.8))">
                                                    <a href="<?php echo e(route('titip-tulisan.show', $featuredTitip->slug)); ?>"
                                                        class="h2 text-white text-decoration-none"><?php echo e($featuredTitip->judul); ?></a>
                                                    <div class="d-flex mt-3">
                                                        <div class="me-4"><i class="fa fa-clock"></i> <?php echo e($featuredTitip->created_at->translatedFormat('d F Y')); ?></div>
                                                        <div class="me-4"><i class="fa fa-eye"></i> <?php echo e($featuredTitip->views ?? 0); ?></div>
                                                        <div><i class="fa fa-thumbs-up"></i> <?php echo e($featuredTitip->likes->count()); ?></div>
                                                    </div>
                                                    <div class="mt-2">
                                                        <i class="fa fa-user me-1"></i><?php echo e($featuredTitip->nama_pengirim); ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>

                                <!-- Other Titip Tulisan Grid -->
                                <div class="row g-4">
                                    <?php $__currentLoopData = $latestTitip->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-6 col-md-6">
                                            <div class="bg-light rounded overflow-hidden h-100">
                                                <div class="position-relative">
                                                    <img src="<?php echo e($titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg')); ?>"
                                                         class="img-fluid w-100" alt="<?php echo e($titip->judul); ?>"
                                                         style="height: 200px; object-fit: cover;">
                                                    <div class="position-absolute top-0 end-0 p-2">
                                                        <span class="badge bg-success">Titip Tulisan</span>
                                                    </div>
                                                </div>
                                                <div class="p-4">
                                                    <a href="<?php echo e(route('titip-tulisan.show', $titip->slug)); ?>"
                                                       class="h5 d-block mb-3 text-decoration-none text-dark link-hover">
                                                        <?php echo e(Str::limit($titip->judul, 70, '...')); ?>

                                                    </a>
                                                    <div class="d-flex justify-content-between text-muted small mb-3">
                                                        <span><i class="fa fa-user me-1"></i><?php echo e($titip->nama_pengirim); ?></span>
                                                        <span><i class="fa fa-calendar me-1"></i><?php echo e($titip->created_at->translatedFormat('d M Y')); ?></span>
                                                    </div>
                                                    <p class="mb-0">
                                                        <?php echo Str::limit(strip_tags($titip->isi), 120, '...'); ?>

                                                    </p>
                                                    <div class="d-flex justify-content-between mt-3 pt-3 border-top">
                                                        <small><i class="fa fa-eye me-1"></i><?php echo e($titip->views ?? 0); ?> views</small>
                                                        <small><i class="fa fa-thumbs-up me-1"></i><?php echo e($titip->likes->count()); ?> likes</small>
                                                        <small><i class="fa fa-comment me-1"></i>0 comments</small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                                <!-- Pagination -->
                                <?php if($latestTitip->hasPages()): ?>
                                <div class="mt-5">
                                    <?php echo e($latestTitip->appends(['news_page' => $latestNews->currentPage()])->links('pagination::bootstrap-5')); ?>

                                </div>
                                <?php endif; ?>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fa fa-pen fa-4x text-muted mb-3"></i>
                                    <h4 class="text-muted">Belum ada titip tulisan di kategori ini</h4>
                                    <p class="text-muted">Jadilah yang pertama menulis di kategori ini!</p>
                                    <a href="<?php echo e(route('titip-tulisan.create')); ?>" class="btn btn-primary mt-3">
                                        <i class="fa fa-plus me-1"></i>Buat Titip Tulisan
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="row g-4">
                        <!-- Category Info -->
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h5 class="mb-3">Tentang Kategori</h5>
                                <div class="mb-3">
                                    <h6><?php echo e($categories->name); ?></h6>
                                    <p class="text-muted mb-2">
                                        <i class="fa fa-eye me-1"></i> <?php echo e($categories->views); ?> views
                                    </p>
                                    <p class="text-muted mb-2">
                                        <i class="fa fa-newspaper me-1"></i> <?php echo e($categories->news()->where('status', 'Accept')->count()); ?> Berita
                                    </p>
                                    <p class="text-muted mb-0">
                                        <i class="fa fa-pen me-1"></i> <?php echo e($categories->titipTulisans()->where('status', 'Accept')->count()); ?> Titip Tulisan
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Popular News -->
                        <?php if($popularNews->count() > 0): ?>
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h5 class="mb-3">Populer di Kategori Ini</h5>
                                <?php $__currentLoopData = $popularNews->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mb-3 pb-2 border-bottom">
                                        <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="h6 d-block text-decoration-none">
                                            <?php echo e(Str::limit($news->title, 40, '...')); ?>

                                        </a>
                                        <small class="text-muted">
                                            <i class="fa fa-thumbs-up me-1"></i><?php echo e($news->likes->count()); ?> likes
                                        </small>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Popular Titip Tulisan -->
                        <?php if($popularTitip->count() > 0): ?>
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h5 class="mb-3">Titip Tulisan Populer</h5>
                                <?php $__currentLoopData = $popularTitip->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mb-3 pb-2 border-bottom">
                                        <a href="<?php echo e(route('titip-tulisan.show', $titip->slug)); ?>" class="h6 d-block text-decoration-none">
                                            <?php echo e(Str::limit($titip->judul, 40, '...')); ?>

                                        </a>
                                        <small class="text-muted">
                                            <i class="fa fa-user me-1"></i><?php echo e($titip->nama_pengirim); ?>

                                        </small>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>

                        <!-- Other Categories -->
                        <?php if($otherCategories->count() > 0): ?>
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h5 class="mb-3">Kategori Lainnya</h5>
                                <?php $__currentLoopData = $otherCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="mb-2">
                                        <a href="<?php echo e(route('news.viewCategory', $category->slug)); ?>" class="text-decoration-none">
                                            <i class="fa fa-folder me-2 text-primary"></i>
                                            <?php echo e($category->name); ?>

                                            <span class="badge bg-secondary float-end">
                                                <?php echo e($category->news()->where('status', 'Accept')->count() + $category->titipTulisans()->where('status', 'Accept')->count()); ?>

                                            </span>
                                        </a>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category Content End -->

    <style>
        .nav-tabs .nav-link {
            color: #6c757d;
            font-weight: 500;
            border: none;
            padding: 0.75rem 1.5rem;
        }
        .nav-tabs .nav-link.active {
            color: #3498db;
            border-bottom: 3px solid #3498db;
            background-color: transparent;
        }
        .nav-tabs {
            border-bottom: 1px solid #dee2e6;
        }
        .link-hover:hover {
            color: #3498db !important;
            text-decoration: underline;
        }
        .tab-content {
            padding-top: 1.5rem;
        }
        .img-zoomin {
            transition: transform 0.3s ease;
        }
        .img-zoomin:hover {
            transform: scale(1.05);
        }
    </style>

    <script>
        // Tab switching with URL hash
        document.addEventListener('DOMContentLoaded', function() {
            const hash = window.location.hash;
            if (hash === '#titip') {
                const titipTab = new bootstrap.Tab(document.getElementById('titip-tab'));
                titipTab.show();
            }

            // Update URL hash when tab changes
            const tabEls = document.querySelectorAll('#categoryTab button[data-bs-toggle="tab"]');
            tabEls.forEach(tabEl => {
                tabEl.addEventListener('shown.bs.tab', function (event) {
                    const target = event.target.getAttribute('data-bs-target');
                    window.location.hash = target.replace('#', '');
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/viewCategory.blade.php ENDPATH**/ ?>
