<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Status News</h3>
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
                        <!-- PERBAIKAN: route('admin.news.status') -->
                        <a href="<?php echo e(route('admin.news.status')); ?>">News Status</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>List</a>
                    </li>
                </ul>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <h4 class="card-title">News Pending/Reject Status</h4>
                                <span class="badge badge-primary"><?php echo e($draftNews->count()); ?> News</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <?php if(session('success')): ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo e(session('success')); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <?php if(session('error')): ?>
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <?php echo e(session('error')); ?>

                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            <?php endif; ?>

                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Category</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Updated At</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $__empty_1 = true; $__currentLoopData = $draftNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($news->id); ?></td>
                                                <td>
                                                    <div class="d-flex flex-column">
                                                        <strong><?php echo e(Str::limit($news->title, 60)); ?></strong>
                                                        <small class="text-muted">Slug: <?php echo e($news->slug); ?></small>
                                                    </div>
                                                </td>
                                                <td>
                                                    <span class="badge badge-info"><?php echo e($news->category->name); ?></span>
                                                </td>
                                                <td><?php echo e($news->author->name); ?></td>
                                                <td>
                                                    <?php if($news->status == 'Pending'): ?>
                                                        <span class="badge badge-warning">
                                                            <i class="fas fa-clock mr-1"></i> Pending
                                                        </span>
                                                    <?php elseif($news->status == 'Reject'): ?>
                                                        <span class="badge badge-danger">
                                                            <i class="fas fa-times-circle mr-1"></i> Rejected
                                                        </span>
                                                    <?php endif; ?>
                                                </td>
                                                <td><?php echo e($news->updated_at->format('d/m/Y H:i')); ?></td>
                                                <td>
                                                    <div class="btn-group" role="group">
                                                        <!-- PERBAIKAN: route('admin.news.view') -->
                                                        <a href="<?php echo e(route('admin.news.view', ['news' => $news->slug])); ?>"
                                                           class="btn btn-primary btn-sm"
                                                           data-toggle="tooltip"
                                                           title="View & Update Status">
                                                            <i class="fas fa-eye"></i> View
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                            <tr>
                                                <td colspan="8" class="text-center py-4">
                                                    <div class="alert alert-info">
                                                        <i class="fas fa-info-circle mr-2"></i>
                                                        No news with Pending or Reject status found.
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Status Legend:</strong>
                                    <span class="badge badge-warning ml-2">Pending</span>
                                    <span class="badge badge-danger ml-2">Rejected</span>
                                </div>
                                <div>
                                    <a href="<?php echo e(route('dashboard')); ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-left mr-1"></i> Back to Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#basic-datatables').DataTable({
            "order": [[6, "desc"]], // Sort by updated_at descending
            "pageLength": 10,
            "language": {
                "search": "Search:",
                "lengthMenu": "Show _MENU_ entries",
                "info": "Showing _START_ to _END_ of _TOTAL_ entries",
                "infoEmpty": "Showing 0 to 0 of 0 entries",
                "infoFiltered": "(filtered from _MAX_ total entries)",
                "paginate": {
                    "first": "First",
                    "last": "Last",
                    "next": "Next",
                    "previous": "Previous"
                }
            }
        });

        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .badge-warning {
        background-color: #ffc107;
        color: #212529;
    }

    .badge-danger {
        background-color: #dc3545;
        color: white;
    }

    .badge-info {
        background-color: #17a2b8;
        color: white;
    }

    .badge-primary {
        background-color: #007bff;
        color: white;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-group .btn {
        margin-right: 5px;
    }

    .btn-group .btn:last-child {
        margin-right: 0;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/news/status.blade.php ENDPATH**/ ?>