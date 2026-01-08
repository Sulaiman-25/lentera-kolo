<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3"><?php echo e(auth()->user()->name); ?> Draft</h3>
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
                        <a href="">Draft</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>My Draft</a>
                    </li>
                </ul>
            </div>
            <?php if(session('error')): ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert" id="error-alert">
                    <?php echo e(session('error')); ?>

                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> </button>
                </div>
            <?php endif; ?>

            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs nav-line nav-color-secondary justify-content-center" id="line-tab"
                            role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="line-draft-tab" data-bs-toggle="pill" href="#line-draft"
                                    role="tab" aria-controls="pills-home" aria-selected="true">Draft</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="line-accepted-tab" data-bs-toggle="pill" href="#line-accepted"
                                    role="tab" aria-controls="pills-profile" aria-selected="false">Accepted</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3 mb-3" id="line-tabContent">
                            <div class="tab-pane fade show active" id="line-draft" role="tabpanel"
                                aria-labelledby="line-draft-tab">
                                <div class="card-header mb-3">
                                    <h4 class="card-title">Manage News</h4>
                                </div>
                                <div class="table-responsive">
                                    <table id="basic-datatables"
                                        class="display table table-striped table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Updated At</th>
                                                <th>Status</th>
                                                <th style="width: 5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Updated At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $__currentLoopData = $notAcceptedNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($news->id); ?></td>
                                                    <td><?php echo e($news->title); ?></td>
                                                    <td><?php echo e($news->category->name); ?></td>
                                                    <td><?php echo e($news->updated_at->translatedFormat('m/d/Y H:i')); ?></td>
                                                    <td><?php echo e($news->status); ?></td>
                                                    <td>
                                                        <div
                                                            class="form-button-action d-flex justify-content-center align-items-center">
                                                            <?php if($news->status == 'Reject'): ?>
                                                                <span data-bs-toggle="tooltip" title="Edit">
                                                                    <a href="<?php echo e(route('news.edit', $news->id)); ?>"
                                                                        class="btn btn-link btn-primary btn-lg">
                                                                        <i class="fa fa-edit"></i>
                                                                    </a>
                                                                </span>
                                                            <?php elseif($news->status == 'Pending'): ?>
                                                                <span data-bs-toggle="tooltip" title="View">
                                                                    <a href="<?php echo e(route('news.view', $news->slug)); ?>"
                                                                        class="btn btn-link btn-primary btn-lg">
                                                                        <i class="far fa-eye"></i>
                                                                    </a>
                                                                </span>
                                                            <?php endif; ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="line-accepted" role="tabpanel"
                                aria-labelledby="line-accepted-tab">
                                <div class="card-header mb-3">
                                    <h4 class="card-title">Manage News</h4>
                                </div>
                                <div class="table-responsive">
                                    <table id="basic-datatables2"
                                        class="display table table-striped table-hover text-center">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Updated At</th>
                                                <th>Status</th>
                                                <th style="width: 5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>ID</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Updated At</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php $__currentLoopData = $acceptedNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td><?php echo e($loop->iteration); ?></td>
                                                    <td><?php echo e($news->id); ?></td>
                                                    <td><?php echo e($news->title); ?></td>
                                                    <td><?php echo e($news->category->name); ?></td>
                                                    <td><?php echo e($news->updated_at->translatedFormat('m/d/Y H:i')); ?></td>
                                                    <td><?php echo e($news->status); ?></td>
                                                    <td>
                                                        <div
                                                            class="form-button-action d-flex justify-content-center align-items-center">
                                                            <span data-bs-toggle="tooltip" title="View">
                                                              <a href="<?php echo e(route('news.show', $news->slug)); ?>"
                                                                    class="btn btn-link btn-primary btn-lg">
                                                                    <i class="far fa-eye"></i>
                                                                </a>
                                                            </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </tbody>
                                    </table>
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
            $("#basic-datatables").DataTable({});
        });

        $(document).ready(function() {
            $("#basic-datatables2").DataTable({});
        });
    </script>
<?php $__env->stopSection(); ?>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        setTimeout(() => {
            const alert = document.getElementById('error-alert');
            if (alert) {
                alert.classList.remove('show');
                alert.classList.add('fade');
                setTimeout(() => alert.remove(), 150);
            }
        }, 5000);
    });
</script>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/admin/users/draft.blade.php ENDPATH**/ ?>
