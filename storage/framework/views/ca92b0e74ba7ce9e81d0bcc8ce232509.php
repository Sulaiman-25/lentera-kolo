<?php $__env->startSection('content'); ?>
    <div class="container py-5">
        <div class="row">
            <div class="col-lg-8">
                <!-- Header Pencarian -->
                <div class="search-header mb-4">
                    <h1 class="h3 mb-3">Hasil Pencarian</h1>
                    <div class="search-info bg-light p-3 rounded">
                        <p class="mb-0">
                            <i class="fas fa-search me-2"></i>
                            Menampilkan hasil untuk:
                            <strong>"<?php echo e($query); ?>"</strong>
                        </p>
                        <small class="text-muted">
                            Ditemukan <?php echo e($newsResults->count() + $titipResults->count()); ?> hasil
                        </small>
                    </div>
                </div>

                <!-- Tab Navigasi -->
                <ul class="nav nav-tabs mb-4" id="searchTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                            type="button" role="tab">
                            Semua (<?php echo e($newsResults->count() + $titipResults->count()); ?>)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="news-tab" data-bs-toggle="tab" data-bs-target="#news" type="button"
                            role="tab">
                            Berita (<?php echo e($newsResults->count()); ?>)
                        </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="titip-tab" data-bs-toggle="tab" data-bs-target="#titip" type="button"
                            role="tab">
                            Tulisan <small class="text-muted"></small> (<?php echo e($titipResults->count()); ?>)
                        </button>
                    </li>
                </ul>

                <!-- Tab Content -->
                <!-- Hasil Tulisan  Tamu -->
                <?php if($titipResults->count() > 0): ?>
                    <div class="search-section">
                        <h4 class="mb-3 text-success">
                            <i class="fas fa-pencil-alt me-2"></i>Tulisan  Tamu
                        </h4>
                        <?php $__currentLoopData = $titipResults; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $titip): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="card mb-3 border-0 shadow-sm">
                                <div class="row g-0">
                                    <?php if($titip->image): ?>
                                        <div class="col-md-3">
                                            <img src="<?php echo e($titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg')); ?>"
                                                class="img-fluid rounded-start h-100 object-fit-cover"
                                                alt="<?php echo e($titip->judul); ?>">
                                        </div>
                                    <?php endif; ?>
                                    <div class="<?php echo e($titip->image ? 'col-md-9' : 'col-md-12'); ?>">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <a href="<?php echo e(route('titip-tulisan.show', $titip)); ?>"
                                                    class="text-decoration-none">
                                                    <?php echo e($titip->judul); ?>

                                                </a>
                                            </h5>
                                            <p class="card-text text-muted small">
                                                <i class="fas fa-user me-1"></i> <?php echo e($titip->user->name ?? 'Anonim'); ?>

                                                <i class="fas fa-calendar ms-3 me-1"></i>
                                                <?php echo e($titip->created_at->format('d M Y')); ?>

                                                <i class="fas fa-heart ms-3 me-1"></i> <?php echo e($titip->likes_count ?? 0); ?>

                                            </p>
                                            <p class="card-text">
                                                <?php echo Str::limit(strip_tags($titip->isi), 200); ?>

                                            </p>
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="<?php echo e(route('titip-tulisan.show', $titip)); ?>"
                                                    class="btn btn-sm btn-outline-success">
                                                    Baca Selengkapnya
                                                </a>
                                                <?php if($titip->category): ?>
                                                    <span class="badge bg-success"><?php echo e($titip->category->name); ?></span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>

            </div>

            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sticky-top" style="top: 20px;">
                    <!-- Form Pencarian Ulang -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="fas fa-search me-2"></i>Cari Lagi
                            </h5>
                            <form action="<?php echo e(route('search')); ?>" method="GET">
                                <div class="input-group">
                                    <input type="text" name="q" class="form-control"
                                        placeholder="Masukkan kata kunci..." value="<?php echo e($query); ?>" required>
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <div class="mt-3">
                                <small class="text-muted">
                                    <i class="fas fa-lightbulb me-1"></i>
                                    Gunakan kata kunci yang lebih spesifik untuk hasil yang lebih akurat
                                </small>
                            </div>
                        </div>
                    </div>

                    <!-- Tips Pencarian -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="fas fa-tips me-2"></i>Tips Pencarian
                            </h5>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Gunakan kata kunci yang relevan
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Periksa ejaan kata kunci
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check text-success me-2"></i>
                                    Gunakan filter tab untuk menyaring hasil
                                </li>
                                <li>
                                    <i class="fas fa-check text-success me-2"></i>
                                    Coba kata kunci lain yang mirip
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Kategori Populer -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title mb-3">
                                <i class="fas fa-tags me-2"></i>Kategori Populer
                            </h5>
                            <div class="d-flex flex-wrap gap-2">
                                <?php
                                    $categories = \App\Models\Category::orderBy('views', 'desc')->take(8)->get();
                                ?>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('news.viewCategory', $category->slug)); ?>"
                                        class="badge bg-secondary text-decoration-none">
                                        <?php echo e($category->name); ?>

                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS Tambahan -->
    <style>
        .search-header {
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            padding: 2rem;
            border-radius: 10px;
            color: white;
        }

        .search-header h1 {
            color: white;
        }

        .search-info {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: white;
        }

        .search-info strong {
            color: #ffdd40;
        }

        .nav-tabs .nav-link {
            color: #6c757d;
            border: none;
            padding: 0.75rem 1.5rem;
            font-weight: 500;
        }

        .nav-tabs .nav-link.active {
            color: #0d6efd;
            border-bottom: 3px solid #0d6efd;
            background-color: transparent;
        }

        .search-section h4 {
            padding-bottom: 0.5rem;
            border-bottom: 2px solid;
            display: inline-block;
        }

        .card {
            transition: transform 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
        }

        .object-fit-cover {
            object-fit: cover;
        }

        .sticky-top {
            z-index: 1;
        }

        .badge {
            padding: 0.5em 0.8em;
            font-weight: 500;
        }

        @media (max-width: 768px) {
            .search-header {
                padding: 1.5rem;
            }

            .nav-tabs .nav-link {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }
        }
    </style>

    <!-- JavaScript untuk Tab -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Bootstrap tabs
            var triggerTabList = [].slice.call(document.querySelectorAll('#searchTab button'))
            triggerTabList.forEach(function(triggerEl) {
                var tabTrigger = new bootstrap.Tab(triggerEl)
                triggerEl.addEventListener('click', function(event) {
                    event.preventDefault()
                    tabTrigger.show()
                })
            });

            // Highlight search terms in results
            function highlightText(text, searchTerm) {
                if (!searchTerm) return text;
                const regex = new RegExp(`(${searchTerm})`, 'gi');
                return text.replace(regex, '<mark class="bg-warning px-1">$1</mark>');
            }

            // Apply highlighting to content
            const searchTerm = "<?php echo e($query); ?>";
            const contentElements = document.querySelectorAll('.card-text');

            contentElements.forEach(element => {
                const originalText = element.textContent;
                element.innerHTML = highlightText(originalText, searchTerm);
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/search.blade.php ENDPATH**/ ?>