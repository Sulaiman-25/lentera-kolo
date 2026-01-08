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
                <li class="nav-item active">
                    <a>Manage</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Manage Tulisan Tamu</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="basic-datatables" class="display table table-striped table-hover text-center">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Pengirim</th>
                                        <th>Email</th>
                                        <th>Kategori</th>
                                        <th>Status</th>
                                        <th>Views</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $all; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($item->judul); ?></td>
                                        <td><?php echo e($item->nama_pengirim); ?></td>
                                        <td><?php echo e($item->email_pengirim); ?></td>
                                        <td><?php echo e($item->category->name); ?></td>
                                        <td>
                                            <?php
                                                $badge = 'secondary';

                                                // --- REVISI: Mengkonversi status ke huruf kecil untuk perbandingan yang aman ---
                                                $statusLower = strtolower($item->status);

                                                if($statusLower == 'accept') {
                                                    $badge = 'success'; // Hijau
                                                } elseif($statusLower == 'reject') {
                                                    $badge = 'danger'; // Merah
                                                } elseif($statusLower == 'pending') {
                                                    $badge = 'warning'; // Kuning/Oranye
                                                }
                                                // --------------------------------------------------------------------------
                                            ?>
                                            <span class="badge bg-<?php echo e($badge); ?>"><?php echo e($item->status); ?></span>
                                        </td>
                                        <td><?php echo e($item->views); ?></td>
                                        <td>
                                            <div class="d-flex justify-content-center">
                                                <a href="<?php echo e(route('admin.titip-tulisan.view', $item->id)); ?>" class="btn btn-link btn-primary btn-sm me-1" title="View">
                                                    <i class="far fa-eye"></i>
                                                </a>
                                                <button class="btn btn-link btn-danger btn-sm delete-btn" data-url="<?php echo e(route('admin.titip-tulisan.destroy', $item->id)); ?>" title="Delete">
                                                    <i class="fas fa-trash"></i>
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
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-footer'); ?>
<script>
    $(document).ready(function() {
        // Pastikan DataTable diinisialisasi
        $("#basic-datatables").DataTable();

        // SweetAlert untuk hapus (Ajax Request)
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            let url = $(this).data('url');

            Swal.fire({
                title: 'Yakin ingin menghapus tulisan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: { _token: '<?php echo e(csrf_token()); ?>' },
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
                                text: err.responseJSON?.message || 'Gagal menghapus data.',
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/titip-tulisan/manage.blade.php ENDPATH**/ ?>