<!-- Fonts and icons -->
<script src="<?php echo e(asset('admin/js/plugin/webfont/webfont.min.js')); ?>"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    WebFont.load({
        google: {
            families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
            families: [
                "Font Awesome 5 Solid",
                "Font Awesome 5 Regular",
                "Font Awesome 5 Brands",
                "simple-line-icons",
            ],
            urls: ["<?php echo e(asset('admin/css/fonts.min.css')); ?>"],
        },
        active: function() {
            sessionStorage.fonts = true;
        },
    });
</script>


<?php echo $__env->yieldContent('custom-header'); ?>

<!-- CSS Files -->
<link rel="stylesheet" href="<?php echo e(asset('admin/css/bootstrap.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('admin/css/plugins.min.css')); ?>" />
<link rel="stylesheet" href="<?php echo e(asset('admin/css/kaiadmin.min.css')); ?>" />
<?php /**PATH C:\website\lentera-kolo\resources\views/components/admin-header.blade.php ENDPATH**/ ?>