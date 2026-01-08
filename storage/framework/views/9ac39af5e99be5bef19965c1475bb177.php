<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Komentar Berita</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="<?php echo e(route('dashboard')); ?>">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <?php if(auth()->user()->is_admin || auth()->user()->hasRole('Editor')): ?>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="<?php echo e(route('admin.comments.index')); ?>">Semua Komentar</a>
                </li>
                <?php endif; ?>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a><?php echo e($news->title); ?></a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title mb-0">Komentar: <?php echo e($news->title); ?></h4>
                                <p class="text-muted mb-0 mt-1">
                                    <i class="fas fa-user me-1"></i><?php echo e($news->author->name); ?> |
                                    <i class="fas fa-calendar me-1"></i><?php echo e($news->created_at->format('d F Y')); ?> |
                                    <i class="fas fa-eye me-1"></i><?php echo e($news->views); ?> views
                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="<?php echo e(route('news.show', $news->slug)); ?>"
                                   class="btn btn-sm btn-info"
                                   target="_blank">
                                    <i class="fas fa-external-link-alt me-1"></i>Lihat Berita
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if($comments->count() > 0): ?>
                            <div class="alert alert-info d-flex align-items-center mb-4">
                                <i class="fas fa-info-circle me-2 fa-lg"></i>
                                <div>
                                    <strong>Info:</strong>
                                    <?php if(auth()->user()->is_admin): ?>
                                        Anda dapat menghapus komentar apa pun.
                                    <?php elseif(auth()->user()->hasRole('Editor')): ?>
                                        Anda dapat menghapus komentar dari semua berita.
                                    <?php elseif(auth()->user()->hasRole('Writer')): ?>
                                        Anda hanya dapat menghapus komentar dari berita yang Anda buat.
                                    <?php endif; ?>
                                </div>
                            </div>

                            <div class="comments-list">
                                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="comment-item mb-4 pb-4 border-bottom">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            <?php if($comment->user): ?>
                                                <img src="<?php echo e($comment->user->image ? asset('storage/images/' . $comment->user->image) : asset('img/default.jpeg')); ?>"
                                                     class="rounded-circle"
                                                     width="50"
                                                     height="50"
                                                     alt="<?php echo e($comment->user->name); ?>">
                                            <?php else: ?>
                                                <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center rounded-circle"
                                                     style="width: 50px; height: 50px; font-size: 1.25rem;">
                                                    <?php echo e(strtoupper(substr($comment->name, 0, 1))); ?>

                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1 fw-bold"><?php echo e($comment->name); ?></h6>
                                                    <?php if($comment->user_id): ?>
                                                        <span class="badge bg-primary me-2">User Terdaftar</span>
                                                    <?php else: ?>
                                                        <span class="badge bg-secondary me-2">Tamu</span>
                                                    <?php endif; ?>
                                                    <?php if($comment->email): ?>
                                                        <small class="text-muted"><?php echo e($comment->email); ?></small>
                                                    <?php endif; ?>
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <small class="text-muted"><?php echo e($comment->created_at->format('d/m/Y H:i')); ?></small>
                                                    <button class="btn btn-sm btn-danger delete-news-comment-btn"
                                                            data-id="<?php echo e($comment->id); ?>"
                                                            data-name="<?php echo e($comment->name); ?>">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="comment-content mt-3 p-3 bg-light rounded">
                                                <p class="mb-0"><?php echo e($comment->content); ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                <?php echo e($comments->links()); ?>

                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                                <h5>Belum ada komentar</h5>
                                <p class="text-muted">Tidak ada komentar untuk berita ini</p>
                            </div>
                        <?php endif; ?>
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
        // Delete comment from news page
        $('.delete-news-comment-btn').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const url = "<?php echo e(route('admin.comments.destroy', ':id')); ?>".replace(':id', id);

            Swal.fire({
                title: 'Hapus Komentar?',
                html: `<p class="mb-3">Anda yakin ingin menghapus komentar dari:</p>
                      <p class="fw-bold">"${name}"</p>`,
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
    });
</script>

<style>
    .avatar-circle {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .comment-content {
        line-height: 1.6;
    }

    .comment-item:hover {
        background-color: rgba(0, 123, 255, 0.05);
        border-radius: 8px;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/admin/comments/news-comments.blade.php ENDPATH**/ ?>
