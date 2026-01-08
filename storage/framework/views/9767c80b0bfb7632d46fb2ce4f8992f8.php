<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Kelola Komentar</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>Semua Komentar</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Semua Komentar</h4>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-primary filter-btn active" data-status="all">
                                    Semua
                                </button>
                                <button class="btn btn-sm btn-outline-success filter-btn" data-status="News">
                                    Berita
                                </button>
                                <button class="btn btn-sm btn-outline-info filter-btn" data-status="TitipTulisan">
                                    Tulisan Tamu
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if($comments->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="40%">Komentar</th>
                                            <th width="15%">Postingan</th>
                                            <th width="15%">Pengguna</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            // PERBAIKAN: Gunakan class_basename untuk konsistensi
                                            $type = class_basename($comment->commentable_type);
                                            $badgeClass = $type === 'News' ? 'success' : 'info';
                                            $typeText = $type === 'News' ? 'Berita' : 'Tulisan Tamu';
                                        ?>
                                        <tr class="comment-row" data-type="<?php echo e($type); ?>">
                                            <td>
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0 me-2">
                                                        <?php if($comment->user): ?>
                                                            <img src="<?php echo e($comment->user->image ? asset('storage/images/' . $comment->user->image) : asset('img/default.jpeg')); ?>"
                                                                 class="rounded-circle"
                                                                 width="40"
                                                                 height="40"
                                                                 alt="<?php echo e($comment->user->name); ?>">
                                                        <?php else: ?>
                                                            <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center rounded-circle"
                                                                 style="width: 40px; height: 40px;">
                                                                <?php echo e(strtoupper(substr($comment->name, 0, 1))); ?>

                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="mb-1">
                                                            <strong><?php echo e($comment->name); ?></strong>
                                                            <?php if($comment->email): ?>
                                                                <small class="text-muted ms-2"><?php echo e($comment->email); ?></small>
                                                            <?php endif; ?>
                                                        </div>
                                                        <p class="mb-0 text-break"><?php echo e(Str::limit($comment->content, 100)); ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-<?php echo e($badgeClass); ?> mb-1"><?php echo e($typeText); ?></span>
                                                <br>
                                                <?php if($comment->commentable): ?>
                                                    <?php if($type === 'News'): ?>
                                                        <a href="<?php echo e(route('news.show', $comment->commentable->slug)); ?>"
                                                           target="_blank"
                                                           class="text-decoration-none">
                                                            <?php echo e(Str::limit($comment->commentable->title, 30)); ?>

                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('titip-tulisan.show', $comment->commentable->slug)); ?>"
                                                           target="_blank"
                                                           class="text-decoration-none">
                                                            <?php echo e(Str::limit($comment->commentable->judul, 30)); ?>

                                                        </a>
                                                    <?php endif; ?>
                                                <?php else: ?>
                                                    <span class="text-danger">Postingan dihapus</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if($comment->user_id): ?>
                                                    <span class="badge bg-primary">User Terdaftar</span>
                                                <?php else: ?>
                                                    <span class="badge bg-secondary">Tamu</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <small class="text-muted"><?php echo e($comment->created_at->format('d/m/Y')); ?></small><br>
                                                <small><?php echo e($comment->created_at->format('H:i')); ?></small>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-sm btn-danger delete-comment-btn"
                                                            data-id="<?php echo e($comment->id); ?>"
                                                            data-name="<?php echo e($comment->name); ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <!-- Tombol Lihat Lengkap -->
                                                    <button class="btn btn-sm btn-primary view-comment-btn"
                                                            data-content="<?php echo e($comment->content); ?>"
                                                            data-name="<?php echo e($comment->name); ?>"
                                                            data-email="<?php echo e($comment->email); ?>"
                                                            data-date="<?php echo e($comment->created_at->format('d F Y H:i')); ?>"
                                                            data-post-title="<?php echo e($comment->commentable ? ($type === 'News' ? $comment->commentable->title : $comment->commentable->judul) : 'Postingan dihapus'); ?>"
                                                            data-post-type="<?php echo e($typeText); ?>">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <!-- Link ke Postingan -->
                                                    <?php if($comment->commentable): ?>
                                                        <a href="<?php echo e($type === 'News' ? route('news.show', $comment->commentable->slug) : route('titip-tulisan.show', $comment->commentable->slug)); ?>"
                                                           class="btn btn-sm btn-info"
                                                           target="_blank">
                                                            <i class="fas fa-external-link-alt"></i>
                                                        </a>
                                                    <?php endif; ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                <?php echo e($comments->links()); ?>

                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                <h5>Belum ada komentar</h5>
                                <p class="text-muted">Tidak ada komentar yang tersedia</p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Komentar Terhapus (Hanya Super Admin) -->
                <?php if(Auth::user()->is_admin && $deletedComments->count() > 0): ?>
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h4 class="card-title mb-0 text-danger">Komentar Terhapus</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Komentar</th>
                                        <th>Postingan</th>
                                        <th>Dihapus Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $deletedComments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php
                                        $type = class_basename($comment->commentable_type);
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="mb-1">
                                                <strong><?php echo e($comment->name); ?></strong>
                                            </div>
                                            <p class="mb-0 text-break text-muted"><?php echo e(Str::limit($comment->content, 80)); ?></p>
                                        </td>
                                        <td>
                                            <?php if($comment->commentable): ?>
                                                <?php echo e(Str::limit($type === 'News' ? $comment->commentable->title : $comment->commentable->judul, 30)); ?>

                                            <?php else: ?>
                                                <span class="text-danger">Postingan dihapus</span>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <small><?php echo e($comment->deleted_at->format('d/m/Y H:i')); ?></small>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-sm btn-success restore-comment-btn"
                                                        data-id="<?php echo e($comment->id); ?>">
                                                    <i class="fas fa-undo"></i> Pulihkan
                                                </button>
                                                <button class="btn btn-sm btn-danger force-delete-comment-btn"
                                                        data-id="<?php echo e($comment->id); ?>"
                                                        data-name="<?php echo e($comment->name); ?>">
                                                    <i class="fas fa-trash-alt"></i> Hapus Permanen
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal View Comment -->
<div class="modal fade" id="viewCommentModal" tabindex="-1" role="dialog" aria-labelledby="viewCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCommentModalLabel">Detail Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama:</strong>
                        <p id="modal-comment-name" class="mb-0"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p id="modal-comment-email" class="mb-0"></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Tanggal:</strong>
                        <p id="modal-comment-date" class="mb-0"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Tipe Postingan:</strong>
                        <p id="modal-comment-type" class="mb-0"></p>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Judul Postingan:</strong>
                    <p id="modal-post-title" class="mb-0"></p>
                </div>
                <div class="mb-3">
                    <strong>Komentar:</strong>
                    <div id="modal-comment-content" class="bg-light p-3 rounded"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-footer'); ?>
<script>
    $(document).ready(function() {
        // Filter by type
        $('.filter-btn').click(function() {
            const type = $(this).data('status');

            // Update active button
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');

            // Filter table rows
            if (type === 'all') {
                $('.comment-row').show();
            } else {
                $('.comment-row').hide();
                $(`.comment-row[data-type="${type}"]`).show();
            }
        });

        // View comment modal
        $('.view-comment-btn').click(function() {
            const name = $(this).data('name');
            const email = $(this).data('email');
            const content = $(this).data('content');
            const date = $(this).data('date');
            const postTitle = $(this).data('post-title');
            const postType = $(this).data('post-type');

            $('#modal-comment-name').text(name);
            $('#modal-comment-email').text(email || '-');
            $('#modal-comment-date').text(date);
            $('#modal-post-title').text(postTitle);
            $('#modal-comment-type').text(postType);
            $('#modal-comment-content').text(content);

            $('#viewCommentModal').modal('show');
        });

        // Delete comment
        $('.delete-comment-btn').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const url = "<?php echo e(route('admin.comments.destroy', ':id')); ?>".replace(':id', id);

            Swal.fire({
                title: 'Hapus Komentar?',
                html: `<p class="mb-3">Anda yakin ingin menghapus komentar dari:</p>
                      <p class="fw-bold">"${name}"</p>
                      <p class="text-danger small">Komentar akan dipindahkan ke sampah dan bisa dipulihkan</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if(result.isConfirmed){
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
                        success: function(response){
                            Swal.close();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err){
                            Swal.close();
                            let errorMsg = err.responseJSON?.message || 'Gagal menghapus komentar';
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

        // Restore deleted comment (Super Admin only)
        <?php if(Auth::user()->is_admin): ?>
        $('.restore-comment-btn').click(function() {
            const id = $(this).data('id');
            const url = "<?php echo e(route('admin.comments.restore', ':id')); ?>".replace(':id', id);

            Swal.fire({
                title: 'Pulihkan Komentar?',
                text: 'Komentar akan dikembalikan ke daftar aktif',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Pulihkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '<?php echo e(csrf_token()); ?>'
                        },
                        success: function(response){
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Komentar berhasil dipulihkan',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err){
                            let errorMsg = err.responseJSON?.message || 'Gagal memulihkan komentar';
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

        // Force delete comment (Super Admin only)
        $('.force-delete-comment-btn').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const url = "<?php echo e(route('admin.comments.forceDelete', ':id')); ?>".replace(':id', id);

            Swal.fire({
                title: 'Hapus Permanen?',
                html: `<p class="mb-3">Anda yakin ingin menghapus permanen komentar dari:</p>
                      <p class="fw-bold">"${name}"</p>
                      <p class="text-danger small">Aksi ini tidak dapat dibatalkan!</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Permanen!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if(result.isConfirmed){
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
                        success: function(response){
                            Swal.close();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message || 'Komentar berhasil dihapus permanen',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err){
                            Swal.close();
                            let errorMsg = err.responseJSON?.message || 'Gagal menghapus komentar';
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
        <?php endif; ?>
    });
</script>

<style>
    .avatar-circle {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .comment-row:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    .text-break {
        word-break: break-word;
    }

    .filter-btn.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/admin/comments/index.blade.php ENDPATH**/ ?>
