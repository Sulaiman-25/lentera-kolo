<!--   Core JS Files   -->
<script src="<?php echo e(asset('admin/js/core/jquery-3.7.1.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/core/popper.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/core/bootstrap.min.js')); ?>"></script>

<!-- jQuery Scrollbar -->
<script src="<?php echo e(asset('admin/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')); ?>"></script>

<!-- Chart JS -->
<script src="<?php echo e(asset('admin/js/plugin/chart.js/chart.min.js')); ?>"></script>

<!-- jQuery Sparkline -->
<script src="<?php echo e(asset('admin/js/plugin/jquery.sparkline/jquery.sparkline.min.js')); ?>"></script>

<!-- Chart Circle -->
<script src="<?php echo e(asset('admin/js/plugin/chart-circle/circles.min.js')); ?>"></script>

<!-- Datatables -->
<script src="<?php echo e(asset('admin/js/plugin/datatables/datatables.min.js')); ?>"></script>

<!-- Bootstrap Notify -->
<script src="<?php echo e(asset('admin/js/plugin/bootstrap-notify/bootstrap-notify.min.js')); ?>"></script>

<!-- jQuery Vector Maps -->
<script src="<?php echo e(asset('admin/js/plugin/jsvectormap/jsvectormap.min.js')); ?>"></script>
<script src="<?php echo e(asset('admin/js/plugin/jsvectormap/world.js')); ?>"></script>

<!-- Google Maps Plugin -->
<script src="<?php echo e(asset('admin/js/plugin/gmaps/gmaps.js')); ?>"></script>

<!-- Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?php echo e(asset('js/alert.js')); ?>"></script>

<script src="<?php echo e(asset('admin/js/plugin/sweetalert/sweetalert.min.js')); ?>"></script>

<!-- Kaiadmin JS -->
<script src="<?php echo e(asset('admin/js/kaiadmin.min.js')); ?>"></script>


<script src="<?php echo e(asset('js/previewImage.js')); ?>"></script>

<?php if (! (request()->is('login') || request()->is('register'))): ?>
    
    <script src="<?php echo e(asset('js/notifications.js')); ?>"></script>
<?php endif; ?>

<?php echo $__env->yieldContent('custom-footer'); ?>
<?php /**PATH C:\website\lentera-kolo\resources\views/components/admin-footer.blade.php ENDPATH**/ ?>