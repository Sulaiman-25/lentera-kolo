<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Kelola Pesan Kontak</h3>
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
                    <a>Kontak</a>
                </li>
            </ul>
        </div>


        <?php if(session('success')): ?>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '<?php echo e(session("success")); ?>',
                        confirmButtonColor: '#3085d6'
                    });
                });
            </script>
        <?php endif; ?>


        <?php if($contacts->count() == 0): ?>
            <div class="alert alert-info">Belum ada pesan masuk.</div>
        <?php endif; ?>

        <div class="row">
            <?php $__currentLoopData = $contacts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $contact): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body">
                            <h5 class="fw-bold"><?php echo e($contact->nama); ?></h5>
                            <p class="text-muted mb-2"><strong>Email:</strong> <?php echo e($contact->email); ?></p>
                            <p>"<?php echo e(Str::limit($contact->pesan, 120)); ?>"</p>

                            <small class="text-secondary d-block mb-3">
                                Dikirim: <?php echo e($contact->created_at->translatedFormat('d M Y H:i')); ?>

                            </small>


                            <form id="delete-form-<?php echo e($contact->id); ?>" action="<?php echo e(route('admin.kontak.destroy', $contact->id)); ?>"
                                  method="POST" style="display: none;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                            </form>

                            <button class="btn btn-sm btn-danger"
                                onclick="konfirmasiHapus(<?php echo e($contact->id); ?>)">
                                <i class="fas fa-trash"></i> Hapus
                            </button>

                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>


        <div class="d-flex justify-content-center mt-4">
            <?php echo e($contacts->links()); ?>

        </div>

    </div>
</div>


<script>
function konfirmasiHapus(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Pesan yang dihapus tidak dapat dikembalikan!",
        icon: 'peringatan',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/kontak/index.blade.php ENDPATH**/ ?>
