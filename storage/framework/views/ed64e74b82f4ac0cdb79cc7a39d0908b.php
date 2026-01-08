<?php $__env->startSection('content'); ?>
<div class="container py-5">

    <h1 class="fw-bold text-center mb-4 text-primary">
        Tentang Lentera Kolo
    </h1>

    <!-- Hero Image -->
    <div class="text-center mb-4">
        <img src="<?php echo e(asset('img/lentera.jpg')); ?>"
             class="img-fluid rounded shadow-sm"
             alt="Lentera Kolo">
        <small class="text-muted d-block mt-2" style="font-size: 14px;">
            Lentera Kolo – Media Informasi Kelurahan Kolo
        </small>
    </div>

    <p class="text-secondary" style="text-align: justify;">
        <strong>Lentera Kolo</strong> hadir sebagai platform berita dan informasi utama yang berdedikasi penuh
        untuk menerangi setiap aspek kehidupan di <strong>Kelurahan Kolo</strong>.
        Kami berkomitmen menyajikan liputan yang <strong>akurat, objektif, dan terpercaya</strong>
        sebagai sumber informasi masyarakat.
    </p>

    <p class="text-secondary" style="text-align: justify;">
        Misi kami tidak hanya terbatas pada penyampaian berita, tetapi juga menjadi
        <strong>promotor utama</strong> dalam mengangkat berbagai potensi luar biasa
        Kelurahan Kolo, mulai dari <strong>kekayaan budaya, kearifan lokal, potensi wisata,
        hingga aktivitas sosial kemasyarakatan</strong>.
    </p>

    <p class="text-secondary" style="text-align: justify;">
        Lentera Kolo berperan sebagai <strong>jembatan komunikasi</strong> yang efektif
        antara pemerintah kelurahan dan masyarakat, dengan tujuan mendorong
        <strong>partisipasi aktif warga</strong> dalam pembangunan serta menciptakan
        kemajuan yang harmonis dan berkelanjutan.
    </p>

    <p class="text-secondary" style="text-align: justify;">
        Selain itu, Lentera Kolo juga berupaya untuk
        <strong>meningkatkan literasi informasi masyarakat</strong>,
        agar warga Kelurahan Kolo semakin kritis, cerdas,
        dan aktif dalam menyikapi perkembangan sosial, ekonomi,
        dan budaya di lingkungannya.
    </p>

    <hr class="my-4">

    <h5 class="fw-bold text-primary">Visi Lentera Kolo</h5>
    <p class="text-secondary">
        Menjadi media informasi lokal yang edukatif, inspiratif,
        dan terpercaya bagi seluruh masyarakat Kelurahan Kolo.
    </p>

    <h5 class="fw-bold text-primary mt-3">Misi Lentera Kolo</h5>
    <ul class="text-secondary">
        <li>Menyajikan informasi yang akurat, berimbang, dan bertanggung jawab.</li>
        <li>Mempromosikan potensi lokal Kelurahan Kolo.</li>
        <li>Mendorong partisipasi aktif masyarakat dalam pembangunan.</li>
        <li>Meningkatkan literasi informasi dan kesadaran sosial warga.</li>
    </ul>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\website\lentera-kolo\resources\views/tentang.blade.php ENDPATH**/ ?>
