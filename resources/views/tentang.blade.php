@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="fw-bold text-center mb-4 text-primary">
        Dinamika Ekonomi Kolo: Transisi dari Jaring Ikan ke Jaring Wisata
    </h1>

    <!-- Hero Image -->
    <div class="text-center mb-4">
        <img src="{{ asset('img/lentera.jpg') }}"
             class="img-fluid rounded shadow-sm"
             alt="Wisata Pantai di Kolo">
        <small class="text-muted d-block mt-2" style="font-size: 14px;">
            Sumber: Dokumentasi Publik – Potensi wisata bahari Kolo
        </small>
    </div>

    <p class="text-secondary">Kota Bima, NTB – Kelurahan Kolo di Kecamatan Asakota, Kota Bima kini tengah berada di persimpangan jalan ekonomi. Secara historis, identitas dan mata pencaharian utama masyarakat Kolo berakar kuat pada sektor kelautan dan perikanan. Namun, dalam dekade terakhir, profil ekonomi Kolo mulai bertransisi seiring dengan pesatnya pengembangan potensi pariwisata bahari.</p>

    <h4 class="mt-4 fw-semibold">Penguatan Identitas Nelayan di Tengah Geliat Turisme</h4>
    <p>Meskipun potensi wisata di sekitar Pantai Kolo, Pondok Wisata, dan Pantai Sonumbe terus dikembangkan, profesi nelayan tetap menjadi tulang punggung perekonomian bagi sebagian besar penduduk. Masyarakat Kolo, yang dikenal memiliki semangat juang tinggi, memanfaatkan kekayaan laut sebagai sumber utama penghidupan mereka.</p>
    <p>Kondisi ini menimbulkan tantangan sekaligus peluang: bagaimana mengintegrasikan sektor perikanan dengan sektor pariwisata agar keduanya saling mendukung?</p>

    <h4 class="mt-4 fw-semibold">Kontribusi Pariwisata Terhadap Diversifikasi Pendapatan</h4>
    <p>Kehadiran destinasi populer seperti Pondok Wisata Kolo dan peningkatan akses ke pantai-pantai lain seperti Buntu dan Sonumbe secara langsung membuka peluang diversifikasi pendapatan bagi warga:</p>

    <ul>
        <li><strong>Jasa Akomodasi dan Kuliner:</strong> pembangunan pondok wisata mendorong warga untuk terlibat dalam penginapan, kuliner, dan jasa pendukung wisata.</li>
        <li><strong>Pemberdayaan Masyarakat:</strong> Program seperti Dashat (Dapur Sehat Atasi Stunting) di Kampung KB Kolo menjadi bagian dari upaya meningkatkan kesejahteraan ekonomi keluarga berbasis sumber daya lokal.</li>
    </ul>

    <h4 class="mt-4 fw-semibold">Tantangan Partisipasi dan Kesejahteraan Merata</h4>
    <p>Walaupun peluang ekonomi terbuka, implementasi pembangunan di Kolo masih harus menghadapi tantangan besar terkait partisipasi masyarakat dan keadilan sosial. Isu sengketa lahan kawasan hutan menunjukkan adanya ketidakseimbangan antara pembangunan dan hak-hak tradisional warga.</p>
    <p>Pembangunan harus melibatkan seluruh elemen masyarakat—LPM, RT/RW, dan tokoh masyarakat—agar manfaat ekonomi dapat dirasakan secara merata dan berkelanjutan.</p>

    <p class="mt-3">Kelurahan Kolo kini memiliki tugas penting untuk menciptakan model ekonomi yang mempertahankan identitasnya sebagai masyarakat pesisir yang kuat sambil merangkul peluang dari industri pariwisata yang sedang berkembang.</p>

    <hr class="my-4">

    <h5 class="fw-bold">Sumber Referensi</h5>
    <ul class="mb-4">
        <li>Visi Kelurahan Kolo: “Sejahtera, Maju dan Mandiri” sejak 2018.</li>
        <li>Potensi wisata: Pondok Wisata Kolo, Pantai Sonumbe, Pantai Buntu.</li>
        <li>Sumber ekonomi utama tetap dari sektor perikanan.</li>
        <li>Program Dashat mendukung pemberdayaan ekonomi keluarga.</li>
        <li>Sengketa lahan kawasan hutan masih menjadi isu utama.</li>
    </ul>
</div>
@endsection
