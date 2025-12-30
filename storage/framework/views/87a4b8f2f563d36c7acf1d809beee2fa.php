<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Detail Berita</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="<?php echo e(route('dashboard')); ?>">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <?php if($news->status == 'Accept'): ?>
                            <a href="<?php echo e(route('admin.news.manage')); ?>">Manage (Diterima)</a>
                        <?php else: ?>
                            <!-- PERBAIKAN: route('admin.news.status') -->
                            <a href="<?php echo e(route('admin.news.status')); ?>">Status Review</a>
                        <?php endif; ?>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>Detail</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- Header dengan Status dan Tombol -->
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h4 class="card-title mb-0"><?php echo e($news->title); ?></h4>

                                        <div class="mt-2">
                                            <?php
                                                $badgeClass = 'secondary';
                                                if ($news->status == 'Accept') {
                                                    $badgeClass = 'success';
                                                } elseif ($news->status == 'Pending') {
                                                    $badgeClass = 'warning';
                                                } elseif ($news->status == 'Reject') {
                                                    $badgeClass = 'danger';
                                                }

                                                $statusText = $news->status;
                                                if ($news->status == 'Accept') {
                                                    $statusText = 'Diterima';
                                                } elseif ($news->status == 'Pending') {
                                                    $statusText = 'Menunggu Review';
                                                } elseif ($news->status == 'Reject') {
                                                    $statusText = 'Ditolak';
                                                }
                                            ?>
                                            <span class="badge bg-<?php echo e($badgeClass); ?> fs-6">
                                                <?php echo e($statusText); ?>

                                            </span>
                                        </div>


                                </div>

                                <?php if(auth()->user()->hasRole('Super Admin') || auth()->user()->hasRole('Editor')): ?>
                                    <?php if($news->status != 'Accept'): ?>
                                        <div class="d-flex gap-2">
                                            <button class="btn btn-success status-btn" data-status="Accept">
                                                <i class="fas fa-check me-1"></i>Terima
                                            </button>
                                            <button class="btn btn-danger status-btn" data-status="Reject">
                                                <i class="fas fa-times me-1"></i>Tolak
                                            </button>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>

                            </div>
                        </div>

                        <div class="card-body">
                            <!-- Informasi Utama -->
                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-3">
                                                <i class="fas fa-user-circle me-2"></i>Informasi Pengirim
                                            </h6>
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <strong>Nama:</strong>
                                                    <p class="mb-0"><?php echo e($news->author->name); ?></p>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <strong>Email:</strong>
                                                    <p class="mb-0"><?php echo e($news->author->email); ?></p>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <strong>Tanggal Kirim:</strong>
                                                    <p class="mb-0"><?php echo e($news->created_at->format('d F Y H:i')); ?></p>
                                                </div>
                                                <div class="col-12">
                                                    <strong>Terakhir Diupdate:</strong>
                                                    <p class="mb-0"><?php echo e($news->updated_at->format('d F Y H:i')); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card bg-light">
                                        <div class="card-body">
                                            <h6 class="card-title text-muted mb-3">
                                                <i class="fas fa-info-circle me-2"></i>Informasi Berita
                                            </h6>
                                            <div class="row">
                                                <div class="col-12 mb-2">
                                                    <strong>Kategori:</strong>
                                                    <span class="badge bg-info"><?php echo e($news->category->name); ?></span>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <strong>Views:</strong>
                                                    <span class="badge bg-secondary"><?php echo e($news->views); ?></span>
                                                </div>
                                                <div class="col-12 mb-2">
                                                    <strong>Karakter:</strong>
                                                    <span class="badge bg-secondary"><?php echo e(strlen($news->content)); ?></span>
                                                </div>
                                                <div class="col-12">
                                                    <strong>ID:</strong>
                                                    <span class="text-muted">#<?php echo e($news->id); ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gambar -->
                            <?php if($news->image): ?>
                                <div class="position-relative rounded mb-4">
                                    <img src="<?php echo e($news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg')); ?>"
                                        class="img-fluid rounded w-100" style="max-height: 400px; object-fit: cover;"
                                        alt="<?php echo e($news->title); ?>">
                                    <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                                        style="top:20px; right:20px;">
                                        <?php echo e($news->category->name); ?>

                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Konten Berita -->
                            <div class="content-section mb-4">
                                <h5 class="mb-3 border-bottom pb-2">
                                    <i class="fas fa-file-alt me-2"></i>Isi Berita
                                </h5>
                                <div class="content p-4 bg-light rounded">
                                    <?php echo $news->content; ?>

                                </div>
                            </div>

                            <!-- Tombol Aksi -->
                            <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top">
                                <div>
                                    <?php if($news->status == 'Accept'): ?>
                                        <a href="<?php echo e(route('news.show', $news->slug)); ?>" class="btn btn-outline-info"
                                            target="_blank">
                                            <i class="fas fa-external-link-alt me-1"></i>Lihat di Publik
                                        </a>
                                    <?php endif; ?>
                                </div>

                                <div class="d-flex gap-2">
                                    <?php if($news->status == 'Accept'): ?>
                                        <a href="<?php echo e(route('admin.news.manage')); ?>" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left me-1"></i>Kembali ke Manage
                                        </a>
                                    <?php else: ?>
                                        <!-- PERBAIKAN: route('admin.news.status') -->
                                        <a href="<?php echo e(route('admin.news.status')); ?>" class="btn btn-secondary">
                                            <i class="fas fa-arrow-left me-1"></i>Kembali ke Status
                                        </a>
                                    <?php endif; ?>

                                    <?php if(auth()->user()->is_admin): ?>
                                        <button class="btn btn-danger delete-btn" data-id="<?php echo e($news->id); ?>"
                                            data-title="<?php echo e($news->title); ?>">
                                            <i class="fas fa-trash me-1"></i>Hapus Berita
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-footer'); ?>
    <script>
        $(document).ready(function() {
            // Tombol Status (Terima/Tolak)
            $('.status-btn').click(function() {
                const status = $(this).data('status');
                const id = "<?php echo e($news->id); ?>";
                const title = "<?php echo e($news->title); ?>";
                const statusText = status === 'Accept' ? 'Terima' : 'Tolak';
                const url = "<?php echo e(route('admin.news.updateStatus', ':id')); ?>".replace(':id', id);

                Swal.fire({
                    title: `${statusText} Berita?`,
                    html: `<p class="mb-3">Anda yakin ingin <strong>${statusText.toLowerCase()}</strong> berita:</p>
                      <p class="fw-bold">"${title}"</p>
                      <p class="text-muted small">Berita akan dipindahkan ke halaman yang sesuai</p>`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: status === 'Accept' ? '#28a745' : '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: `Ya, ${statusText}`,
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'PATCH',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>',
                                status: status
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Memproses...',
                                    text: 'Mohon tunggu sebentar',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    willOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },
                            success: function(response) {
                                Swal.close();
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    if (response.redirect_url) {
                                        window.location.href = response
                                            .redirect_url;
                                    }
                                });
                            },
                            error: function(err) {
                                Swal.close();
                                let errorMsg = err.responseJSON?.message ||
                                    'Gagal memperbarui status';
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: errorMsg,
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });

            // Tombol Hapus
            $('.delete-btn').click(function() {
                const id = $(this).data('id');
                const title = $(this).data('title');
                const url = "<?php echo e(route('admin.news.destroy', ':id')); ?>".replace(':id', id);

                Swal.fire({
                    title: 'Hapus Berita?',
                    html: `<p class="mb-3">Anda yakin ingin menghapus berita:</p>
                      <p class="fw-bold">"${title}"</p>
                      <p class="text-danger small">Aksi ini tidak dapat dibatalkan!</p>`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: url,
                            type: 'DELETE',
                            data: {
                                _token: '<?php echo e(csrf_token()); ?>'
                            },
                            beforeSend: function() {
                                Swal.fire({
                                    title: 'Menghapus...',
                                    text: 'Mohon tunggu sebentar',
                                    allowOutsideClick: false,
                                    showConfirmButton: false,
                                    willOpen: () => {
                                        Swal.showLoading();
                                    }
                                });
                            },
                            success: function(response) {
                                Swal.close();
                                Swal.fire({
                                    title: 'Berhasil!',
                                    text: response.message,
                                    icon: 'success',
                                    timer: 1500,
                                    showConfirmButton: false
                                }).then(() => {
                                    if (response.redirect_url) {
                                        window.location.href = response
                                            .redirect_url;
                                    }
                                });
                            },
                            error: function(err) {
                                Swal.close();
                                let errorMsg = err.responseJSON?.message ||
                                    'Gagal menghapus berita';
                                Swal.fire({
                                    title: 'Gagal!',
                                    text: errorMsg,
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });
        });
    </script>

    <style>
        .content-section .content {
            line-height: 1.8;
        }

        .content-section .content p {
            margin-bottom: 1rem;
        }

        .content-section .content img {
            max-width: 100%;
            height: auto;
            margin: 10px 0;
            border-radius: 8px;
        }

        .card.bg-light {
            border: 1px solid #dee2e6;
        }

        .content-section h5 {
            color: #495057;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/news/view.blade.php ENDPATH**/ ?>