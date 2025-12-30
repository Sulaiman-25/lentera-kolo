<?php $__env->startSection('custom-header'); ?>
    
    <link rel="stylesheet" href="https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.css" />
    <script type="importmap">
   {
       "imports": {
           "ckeditor5": "https://cdn.ckeditor.com/ckeditor5/42.0.1/ckeditor5.js",
           "ckeditor5/": "https://cdn.ckeditor.com/ckeditor5/42.0.1/"
       }
   }
   </script>
    <script type="module" src="<?php echo e(asset('js/ckeditor.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">News</h3>
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
                        <a href="<?php echo e(route('admin.news.manage')); ?>">News</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>Create</a>
                    </li>
                </ul>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="card-title">Create News</div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <form action="<?php echo e(route('news.store')); ?>" method="POST" enctype="multipart/form-data"
                                        id="form">
                                        <?php echo csrf_field(); ?>
                                        <div class="col-12 mx-auto">
                                            <div class="form-group row">
                                                <label for="inlineinput" class="col-12 col-form-label">Title</label>
                                                <div class="col-12">
                                                    <input type="text" class="form-control input-full" id="inlineinput"
                                                        placeholder="Enter Input" name="title" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="editor" class="col-12">Content</label>
                                                <textarea class="form-control col-12" id="editor" name="content"></textarea>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="exampleFormControlSelect1">Category</label>
                                                <select class="form-select" id="exampleFormControlSelect1"
                                                    name="category_id">
                                                    <?php $__currentLoopData = $allCategory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $categories): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($categories->id); ?>"><?php echo e($categories->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label>Image</label>
                                                <input type="file" class="form-control" id="imageInput" name="image" />
                                                <img id="imagePreview" src="#" alt="Preview"
                                                    style="max-width: 200px; display: none;" class="img-fluid mt-4">
                                            </div>
                                            <div class="card-footer mt-3 d-flex justify-content-start">
                                                <button type="submit" class="btn btn-success me-1"
                                                    id="CKsubmitButton">Submit</button>
                                                <button class="btn btn-danger" id="CKdiscardButton">Discard</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/news/create.blade.php ENDPATH**/ ?>