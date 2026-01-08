<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Komentar Berita Saya</h3>
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
                    <a href="<?php echo e(route('admin.comments.index')); ?>">Komentar</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>Berita Saya</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Daftar Berita Saya</h4>
                        </div>
                    </div>

                    <div class="card-body">
                        <?php if($newsList->count() > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="50%">Judul Berita</th>
                                            <th width="20%">Status</th>
                                            <th width="15%">Jumlah Komentar</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__currentLoopData = $newsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td>
                                                <strong><?php echo e($news->title); ?></strong><br>
                                                <small class="text-muted"><?php echo e($news->created_at->format('d/m/Y H:i')); ?></small>
                                            </td>
                                            <td>
                                                <?php if($news->status == 'published'): ?>
                                                    <span class="badge bg-success">Published</span>
                                                <?php elseif($news->status == 'draft'): ?>
                                                    <span class="badge bg-warning">Draft</span>
                                                <?php elseif($news->status == 'pending'): ?>
                                                    <span class="badge bg-info">Pending</span>
                                                <?php elseif($news->status == 'rejected'): ?>
                                                    <span class="badge bg-danger">Rejected</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <span class="badge bg-primary"><?php echo e($news->comment_count); ?> Komentar</span>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="<?php echo e(route('admin.comments.newsComments', $news->id)); ?>"
                                                       class="btn btn-sm btn-primary">
                                                        <i class="fas fa-comments"></i> Lihat Komentar
                                                    </a>
                                                    <a href="<?php echo e(route('news.show', $news->slug)); ?>"
                                                       class="btn btn-sm btn-info"
                                                       target="_blank">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="text-center py-5">
                                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                                <h5>Belum ada berita</h5>
                                <p class="text-muted">Anda belum membuat berita apapun</p>
                                <a href="<?php echo e(route('news.create')); ?>" class="btn btn-primary mt-3">
                                    <i class="fas fa-plus"></i> Buat Berita Baru
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/admin/comments/my-news-list.blade.php ENDPATH**/ ?>
