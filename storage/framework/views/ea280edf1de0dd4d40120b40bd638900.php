<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tulisan Tamu</h3>
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
                    <a href="<?php echo e(route('admin.titip-tulisan.manage')); ?>">Manage</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>View</a>
                </li>
            </ul>
        </div>

        
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    
                    <?php if($titipTulisan->status != 'Accept'): ?>
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title"><?php echo e($titipTulisan->judul); ?></div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-success text-light status-btn" data-id="<?php echo e($titipTulisan->id); ?>" data-status="Accept">Accept</button>
                            <button class="btn btn-danger text-light status-btn" data-id="<?php echo e($titipTulisan->id); ?>" data-status="Reject">Reject</button>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="card-body">
                        
                        <?php if($titipTulisan->image): ?>
                        <div class="position-relative rounded mb-3">
                            <img src="<?php echo e(asset('storage/titip-tulisan/' . $titipTulisan->image)); ?>" class="img-fluid rounded w-100" alt="">
                            <div class="position-absolute text-white px-4 py-2 bg-primary rounded" style="top:20px; right:20px;">
                                <?php echo e($titipTulisan->category->name); ?>

                            </div>
                        </div>
                        <?php endif; ?>

                        
                        <p class="my-2"><?php echo $titipTulisan->isi; ?></p>

                        
                        <div class="mb-3">
                            <?php
                                $badge = 'secondary';
                                if($titipTulisan->status == 'Accept') $badge = 'success';
                                elseif($titipTulisan->status == 'Reject') $badge = 'danger';
                            ?>
                            <span class="badge bg-<?php echo e($badge); ?>"><?php echo e($titipTulisan->status); ?></span>
                        </div>

                        
                        <div class="card-footer">
                            <div class="row g-2 align-items-center mt-1">
                                <div class="col-12">
                                    <h4><?php echo e($titipTulisan->nama_pengirim); ?></h4>
                                    <p class="mb-0"><?php echo e($titipTulisan->email_pengirim); ?></p>
                                </div>
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
    // Tombol Accept / Reject dengan SweetAlert
    $('.status-btn').click(function() {
        let id = $(this).data('id');
        let status = $(this).data('status'); // Accept atau Reject

        Swal.fire({
            title: `Yakin ingin merubah status menjadi "${status}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: `/admin/titip-tulisan/status/${id}`,
                    type: 'PATCH',
                    data: {
                        _token: '<?php echo e(csrf_token()); ?>',
                        status: status
                    },
                    success: function(response){
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message,
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    },
                    error: function(err){
                        Swal.fire({
                            title: 'Gagal!',
                            text: err.responseJSON?.message || 'Status gagal diperbarui.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/titip-tulisan/view.blade.php ENDPATH**/ ?>