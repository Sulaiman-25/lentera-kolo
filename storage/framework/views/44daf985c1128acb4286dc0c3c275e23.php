<?php $__env->startSection('content'); ?>
    <!-- Main Post Section Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-7 col-xl-8 mt-0">
                    <!-- Berita Utama dari News -->
                    <?php $__currentLoopData = $latestNews->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="position-relative overflow-hidden rounded">
                            <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                class="img-fluid rounded img-zoomin w-100" alt="" style="height: 475px" />
                            <div class="d-flex justify-content-center px-4 position-absolute flex-wrap"
                                style="bottom: 10px; left: 0">
                                <div class="text-white me-4"><i class="fa fa-clock"></i>
                                    <?php echo e($news->created_at->translatedFormat('d F Y')); ?></div>
                                <div class="text-white me-4"><i class="fa fa-eye"></i> <?php echo e($news->views); ?></div>
                                <div class="text-white me-4"><i class="fa fa-thumbs-up"></i> <?php echo e($news->likes->count()); ?>

                                </div>
                            </div>
                        </div>
                        <div class="border-bottom py-3">
                            <a href="<?php echo e(route('news.show', $news->slug)); ?>"
                                class="display-4 text-dark mb-0 link-hover"><?php echo e($news->title); ?></a>
                        </div>
                        <p class="mt-3 mb-4">
                            <?php echo Str::limit($news->content, 450, '...'); ?>

                        </p>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <!-- Top Views dari TitipTulisan -->
                    <?php if($popularTitip->isNotEmpty()): ?>
                        <?php $__currentLoopData = $popularTitip->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-light p-4 rounded">
                                <div class="news-2">
                                    <h3 class="mb-4">Top Views - Titip Tulisan</h3>
                                </div>
                                <div class="row g-4 align-items-center">
                                    <div class="col-md-6">
                                        <div class="rounded overflow-hidden">
                                            <img src="<?php echo e($titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg')); ?>"
                                                class="img-fluid rounded img-zoomin w-100" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column">
                                            <a href="<?php echo e(route('titip-tulisan.show', $titip->slug)); ?>" class="h3"><?php echo e($titip->judul); ?></a>
                                            <p class="mb-0 fs-5 ms-1">
                                                <i class="fa fa-clock">
                                                    <?php echo e($titip->created_at->translatedFormat('d F Y H:i')); ?></i>
                                            </p>
                                            <p class="mb-0 fs-5 ms-1">
                                                <i class="fa fa-thumbs-up">
                                                    <?php echo e($titip->likes->count()); ?> Likes</i>
                                            </p>
                                            <p class="mb-0 fs-5 ms-1 text-muted">
                                                <i class="fa fa-user"></i> Oleh: <?php echo e($titip->nama_pengirim); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </div>

                <div class="col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 pt-0">
                        <div class="row g-4">
                            <!-- Latest News Kedua -->
                            <?php if($latestNews->count() > 1): ?>
                                <?php $__currentLoopData = $latestNews->skip(1)->take(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12">
                                        <div class="rounded overflow-hidden">
                                            <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                                class="img-fluid rounded img-zoomin w-100" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column">
                                            <a href="<?php echo e(route('news.show', $news->slug)); ?>"
                                                class="h4 mb-2"><?php echo e($news->title); ?></a>
                                            <p class="fs-5 mb-0">
                                                <i class="fa fa-clock">
                                                    <?php echo e($news->created_at->translatedFormat('d F Y H:i')); ?></i>
                                            </p>
                                            <p class="fs-5 mb-0">
                                                <i class="fa fa-eye"> <?php echo e($news->views); ?></i>
                                            </p>
                                            <p class="fs-5 mb-0">
                                                <i class="fa fa-thumbs-up">
                                                    <?php echo e($news->likes->count()); ?></i>
                                            </p>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>

                            <!-- Latest Titip Tulisan -->
                            <?php if($latestTitip->isNotEmpty()): ?>
                                <div class="col-12">
                                    <h5 class="mb-3 border-bottom pb-2">Titip Tulisan Terbaru</h5>
                                    <?php $__currentLoopData = $latestTitip->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="row g-4 align-items-center mb-3">
                                            <div class="col-5">
                                                <div class="overflow-hidden rounded">
                                                    <img src="<?php echo e($titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg')); ?>"
                                                        class="img-zoomin img-fluid rounded w-100" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="features-content d-flex flex-column">
                                                    <a href="<?php echo e(route('titip-tulisan.show', $titip->slug)); ?>"
                                                        class="h6"><?php echo e($titip->judul); ?></a>
                                                    <small><i class="fa fa-clock">
                                                            <?php echo e($titip->created_at->translatedFormat('d F Y H:i')); ?> </i>
                                                    </small>
                                                    <small><i class="fa fa-thumbs-up"> <?php echo e($titip->likes->count()); ?></i></small>
                                                    <small class="text-muted">
                                                        <i class="fa fa-user"></i> <?php echo e($titip->nama_pengirim); ?>

                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            <!-- Latest News Lainnya -->
                            <?php if($latestNews->count() > 2): ?>
                                <?php $__currentLoopData = $latestNews->skip(2)->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="col-12">
                                        <div class="row g-4 align-items-center">
                                            <div class="col-5">
                                                <div class="overflow-hidden rounded">
                                                    <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                                        class="img-zoomin img-fluid rounded w-100" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="features-content d-flex flex-column">
                                                    <a href="<?php echo e(route('news.show', $news->slug)); ?>"
                                                        class="h6"><?php echo e($news->title); ?></a>
                                                    <small><i class="fa fa-clock">
                                                            <?php echo e($news->created_at->translatedFormat('d F Y H:i')); ?> </i>
                                                    </small>
                                                    <small><i class="fa fa-eye"> <?php echo e($news->views); ?></i></small>
                                                    <small>
                                                        <i class="fa fa-thumbs-up">
                                                            <?php echo e($news->likes->count()); ?></i>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Post Section End -->

    <!-- Latest News Start -->
    <div class="container-fluid latest-news py-5">
        <div class="container py-5">
            <h2 class="mb-4">Latest News</h2>
            <div class="latest-news-carousel owl-carousel">
                <?php $__currentLoopData = $latestNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="latest-news-item">
                        <div class="bg-light rounded">
                            <div class="rounded-top overflow-hidden">
                                <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                    class="img-zoomin img-fluid rounded-top w-100" alt="" />
                            </div>
                            <div class="d-flex flex-column p-4">
                                <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="h4">
                                    <?php echo e(Str::limit($news->title, 35, '...')); ?></a>
                                <div class="d-flex justify-content-between">
                                    <small class="small text-body"><?php echo e('by ' . $news->author->name); ?></small>
                                    <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                        <?php echo e($news->created_at->translatedFormat('j F Y')); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <!-- Latest News End -->

    <!-- Latest Titip Tulisan Start -->
    <?php if($latestTitip->isNotEmpty()): ?>
    <div class="container-fluid latest-news py-5">
        <div class="container py-5">
            <h2 class="mb-4">Latest Titip Tulisan</h2>
            <div class="latest-news-carousel owl-carousel">
                <?php $__currentLoopData = $latestTitip; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="latest-news-item">
                        <div class="bg-light rounded">
                            <div class="rounded-top overflow-hidden">
                                <img src="<?php echo e($titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg')); ?>"
                                    class="img-zoomin img-fluid rounded-top w-100" alt="" />
                            </div>
                            <div class="d-flex flex-column p-4">
                                <a href="<?php echo e(route('titip-tulisan.show', $titip->slug)); ?>" class="h4">
                                    <?php echo e(Str::limit($titip->judul, 35, '...')); ?></a>
                                <div class="d-flex justify-content-between">
                                    <small class="small text-muted"><?php echo e('by ' . $titip->nama_pengirim); ?></small>
                                    <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                        <?php echo e($titip->created_at->translatedFormat('j F Y')); ?></small>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- Latest Titip Tulisan End -->

    <!-- Most Popular News Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <div class="tab-class mb-4">
                <div class="row g-4">
                    <div class="col-lg-8 col-xl-9">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                            <h1 class="mb-4">Trending Category</h1>
                            <ul class="nav nav-pills d-inline-flex text-center">
                                <?php $__currentLoopData = $topCategory->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item mb-3">
                                        <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill"
                                            href="#tab-<?php echo e($key + 1); ?>">
                                            <span class="text-dark" style="width: 100px"><?php echo e($categories->name); ?></span>
                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                        </div>

                        <div class="tab-content mb-4">
                            <?php $__currentLoopData = $topCategory->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div id="tab-<?php echo e($key + 1); ?>"
                                    class="tab-pane fade show p-0 <?php echo e($key === 0 ? 'active' : ''); ?>">
                                    <div class="row g-4">
                                        <!-- Berita Populer dari Kategori (News) -->
                                        <?php $__currentLoopData = $categories->news()->where('status', 'Accept')->withCount('likes')->orderBy('likes_count', 'desc')->take(1)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="col-lg-8">
                                                <div class="position-relative rounded overflow-hidden">
                                                    <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                                        class="img-zoomin img-fluid rounded w-100" alt="" />
                                                    <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                                                        style="top: 20px; right: 20px">
                                                        <?php echo e($categories->name); ?>

                                                    </div>
                                                </div>
                                                <div class="my-4">
                                                    <a href="<?php echo e(route('news.show', $news->slug)); ?>"
                                                        class="h4"><?php echo e($news->title); ?></a>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="text-dark me-4"><i class="fa fa-clock"></i>
                                                        <?php echo e($news->created_at->translatedFormat('d F Y')); ?></div>
                                                    <div class="text-dark me-4"><i class="fa fa-eye"></i>
                                                        <?php echo e($news->views); ?></div>
                                                    <div class="text-dark me-4"><i class="fa fa-thumbs-up"></i>
                                                        <?php echo e($news->likes->count()); ?>

                                                    </div>
                                                </div>
                                                <p class="my-4">
                                                    <?php echo Str::limit($news->content, 450, '...'); ?>

                                                </p>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <div class="col-lg-4">
                                            <!-- Titip Tulisan dari Kategori yang Sama -->
                                            <?php $__currentLoopData = $categories->titipTulisans()->where('status', 'Accept')->orderBy('created_at', 'desc')->take(3)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row g-4">
                                                    <div class="col-12">
                                                        <div class="row g-4 align-items-center pb-4">
                                                            <div class="col-5">
                                                                <div class="overflow-hidden rounded">
                                                                    <img src="<?php echo e($titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg')); ?>"
                                                                        class="img-zoomin img-fluid rounded w-100"
                                                                        alt="" />
                                                                </div>
                                                            </div>
                                                            <div class="col-7">
                                                                <div class="features-content d-flex flex-column">
                                                                    <p class="text-uppercase mb-2"><?php echo e($categories->name); ?>

                                                                    </p>
                                                                    <a href="<?php echo e(route('titip-tulisan.show', $titip->slug)); ?>"
                                                                        class="h6"><?php echo e($titip->judul); ?></a>
                                                                    <small class="text-body d-block"><i
                                                                            class="fas fa-calendar-alt me-1"></i>
                                                                        <?php echo e($titip->created_at->translatedFormat('j F Y')); ?>

                                                                    </small>
                                                                    <small class="text-muted d-block">
                                                                        <i class="fas fa-user me-1"></i><?php echo e($titip->nama_pengirim); ?>

                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                            <!-- Berita Lainnya dari Kategori (News) -->
                                            <?php $__currentLoopData = $categories->news()->where('status', 'Accept')->withCount('likes')->orderBy('likes_count', 'desc')->skip(1)->take(2)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div class="row g-4">
                                                    <div class="col-12">
                                                        <div class="row g-4 align-items-center pb-4">
                                                            <div class="col-5">
                                                                <div class="overflow-hidden rounded">
                                                                    <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                                                        class="img-zoomin img-fluid rounded w-100"
                                                                        alt="" />
                                                                </div>
                                                            </div>
                                                            <div class="col-7">
                                                                <div class="features-content d-flex flex-column">
                                                                    <p class="text-uppercase mb-2"><?php echo e($categories->name); ?>

                                                                    </p>
                                                                    <a href="<?php echo e(route('news.show', $news->slug)); ?>"
                                                                        class="h6"><?php echo e($news->title); ?></a>
                                                                    <small class="text-body d-block"><i
                                                                            class="fas fa-calendar-alt me-1"></i>
                                                                        <?php echo e($news->created_at->translatedFormat('j F Y')); ?>

                                                                    </small>
                                                                    <small class="text-body d-block"><i
                                                                            class="fas fa-eye me-1"></i>
                                                                        <?php echo e($news->views); ?>

                                                                    </small>
                                                                    <small class="text-body d-block"><i
                                                                            class="fas fa-thumbs-up me-1"></i>
                                                                        <?php echo e($news->likes->count()); ?>

                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <div class="col-lg-4 col-xl-3">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="p-3 rounded border">
                                    <!-- Popular Titip Tulisan -->
                                    <?php if($popularTitip->isNotEmpty()): ?>
                                    <h5 class="mb-3">Popular Titip Tulisan</h5>
                                    <?php $__currentLoopData = $popularTitip->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mb-3">
                                            <a href="<?php echo e(route('titip-tulisan.show', $titip->slug)); ?>" class="h6 d-block">
                                                <?php echo e(Str::limit($titip->judul, 30, '...')); ?>

                                            </a>
                                            <small class="text-muted">
                                                <i class="fa fa-thumbs-up"></i> <?php echo e($titip->likes->count()); ?> likes
                                                | Oleh: <?php echo e($titip->nama_pengirim); ?>

                                            </small>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <hr>
                                    <?php endif; ?>

                                    <!-- Popular News -->
                                    <h5 class="mb-3">Popular News</h5>
                                    <?php $__currentLoopData = $popularNews->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="mb-3">
                                            <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="h6 d-block">
                                                <?php echo e(Str::limit($news->title, 30, '...')); ?>

                                            </a>
                                            <small class="text-muted">
                                                <i class="fa fa-eye"></i> <?php echo e($news->views); ?> views
                                                | Likes: <?php echo e($news->likes->count()); ?>

                                            </small>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Most Popular News End -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/home.blade.php ENDPATH**/ ?>