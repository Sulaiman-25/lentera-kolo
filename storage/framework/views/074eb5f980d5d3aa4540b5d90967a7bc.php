<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Category</h3>
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
                        <a href="<?php echo e(route('admin.category.manage')); ?>">Category</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>Manage</a>
                    </li>
                </ul>
            </div>

            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Manage Category</h4>
                                <button class="btn btn-primary btn-round ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#createCategoryModal">
                                    <i class="fa fa-plus"></i>
                                    Add Category
                                </button>

                                <!-- Create Modal -->
                                <div class="modal fade" id="createCategoryModal" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header border-0">
                                                <h5 class="modal-title">
                                                    <span class="fw-mediumbold">Create
                                                    </span>
                                                    <span class="fw-light">Category</span>
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="<?php echo e(route('admin.category.store')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <div class="modal-body">
                                                    <p class="small">
                                                        Create a new category using this form, make sure you
                                                        fill them all
                                                    </p>

                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group form-group-default">
                                                                <label>Name</label>
                                                                <input type="text" class="form-control"
                                                                    placeholder="Fill Name" name="name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0">
                                                    <button type="submit" id="submitButton" class="btn btn-primary">
                                                        Add
                                                    </button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                                        Close
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="add-row" class="display table table-striped table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Total News</th>
                                            <th style="width: 5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Total News</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php $__currentLoopData = $allCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($loop->iteration); ?></td>
                                                <td><?php echo e($categories->id); ?></td>
                                                <td><?php echo e($categories->name); ?></td>
                                                <td><?php echo e($categories->news->count()); ?></td>
                                                <td>
                                                    <div
                                                        class="form-button-action d-flex justify-content-center align-items-center">
                                                        <span data-bs-toggle="tooltip" title="Edit">
                                                            <button type="button" data-bs-toggle="modal"
                                                                class="btn btn-link btn-primary btn-lg"
                                                                data-bs-target="#editCategoryModal<?php echo e($categories->id); ?>">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </span>

                                                        <span data-bs-toggle="tooltip" title="Delete">
                                                            <form
                                                                action="<?php echo e(route('admin.category.destroy', $categories->id)); ?>"
                                                                id="deleteButton" data-id="<?php echo e($categories->id); ?>">
                                                                <?php echo csrf_field(); ?>
                                                                <?php echo method_field('DELETE'); ?>
                                                                <button type="submit" class="btn btn-link btn-danger">
                                                                    <i class="fa fa-times"></i>
                                                                </button>
                                                            </form>
                                                        </span>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <div class="modal fade" id="editCategoryModal<?php echo e($categories->id); ?>"
                                                tabindex="-1" role="dialog" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <h5 class="modal-title">
                                                                <span class="fw-mediumbold">Edit
                                                                </span>
                                                                <span class="fw-light">Category</span>
                                                            </h5>
                                                            <button type="button" class="close" data-bs-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <form id="editForm"
                                                            action="<?php echo e(route('admin.category.update', $categories->id)); ?>"
                                                            method="POST">
                                                            <?php echo csrf_field(); ?>
                                                            <?php echo method_field('PUT'); ?>
                                                            <div class="modal-body">
                                                                <p class="small">
                                                                    Update a category using this form, make sure you fill
                                                                    them all
                                                                </p>
                                                                <div class="row">
                                                                    <div class="col-sm-12">
                                                                        <div class="form-group form-group-default">
                                                                            <label>Name</label>
                                                                            <input type="text" class="form-control"
                                                                                placeholder="Fill name" name="name"
                                                                                value="<?php echo e($categories->name); ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0">
                                                                <button type="submit" class="btn btn-primary">
                                                                    Update
                                                                </button>
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-dismiss="modal">
                                                                    Close
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-footer'); ?>
    <script>
        $("#add-row").DataTable({
            pageLength: 5,
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/admin/category/manage.blade.php ENDPATH**/ ?>