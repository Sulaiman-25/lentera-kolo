<?php $__env->startSection('custom-header'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/profile.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Profil</h3>
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
                        <a href="<?php echo e(route('profile.edit', $user->id)); ?>">Profil</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item active">
                        <a>Edit Profil</a>
                    </li>
                </ul>
            </div>

            
            <form method="POST" action="<?php echo e(route('profile.update', $user->id)); ?>" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php echo method_field('PUT'); ?>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card mb-4 mb-xl-0">
                            <div class="card-header">Foto Profil</div>
                            <div class="card-body text-center">
                                <img class="img-account-profile rounded-circle mb-3"
                                    src="<?php echo e($user->image ? asset('storage/images/' . $user->image) : asset('img/default.jpeg')); ?>"
                                    alt="Foto Profil" id="pictPreview">
                                <div class="small font-italic text-muted mb-4">JPEG, JPG, atau PNG tidak lebih dari 2 MB</div>
                                <label class="btn btn-dark text-light">
                                    Unggah gambar baru
                                    <input type="file" class="d-none" name="image" id="pictInput">
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header">Detail Akun</div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputUsername">Nama Lengkap</label>
                                    <input class="form-control" id="inputUsername" type="text"
                                        value="<?php echo e($user->name); ?>" placeholder="Masukkan nama baru Anda" name="name">
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="inputBio">Bio</label>
                                    <textarea class="form-control" id="inputBio" rows="5" placeholder="Masukkan bio baru Anda" name="bio"><?php echo e($user->bio); ?></textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="small mb-1" for="inputEmailAddress">Email</label>
                                    <input class="form-control" id="inputEmailAddress" type="email"
                                        value="<?php echo e($user->email); ?>" placeholder="Masukkan email baru Anda" name="email">
                                </div>

                                <div class="row gx-3 mb-3">
                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputPassword">Kata Sandi Baru</label>
                                        <div class="position-relative">
                                            <input class="form-control pe-5" id="inputPassword" type="password"
                                                placeholder="Masukkan kata sandi baru" name="password">
                                            <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y pe-3"
                                                id="togglePassword"></i>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label class="small mb-1" for="inputConfirmPassword">Konfirmasi Kata Sandi</label>
                                        <div class="position-relative">
                                            <input class="form-control" id="inputConfirmPassword" type="password"
                                                placeholder="Masukkan konfirmasi kata sandi" name="password_confirmation">
                                            <i class="fa fa-eye position-absolute top-50 end-0 translate-middle-y pe-3"
                                                id="toggleConfirmPassword"></i>
                                        </div>
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit" id="submitButton">Simpan Perubahan</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-footer'); ?>
    <script src="<?php echo e(asset('js/togglePassword.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/admin/profile.blade.php ENDPATH**/ ?>