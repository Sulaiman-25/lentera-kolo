@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Header Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="page-header text-center">
                <h1 class="fw-bold text-primary mb-3">Profil Kelurahan Kolo</h1>
                <div class="separator">
                    <span class="separator-line"></span>
                    <i class="fas fa-landmark separator-icon"></i>
                    <span class="separator-line"></span>
                </div>
                <p class="lead text-muted">Kecamatan Asakota - Kota Bima - Nusa Tenggara Barat</p>
            </div>
        </div>
    </div>

    <!-- Visi Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-bullseye me-3 fa-lg"></i>
                        <h3 class="mb-0">Visi</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="text-center p-4">
                        <div class="vision-icon mb-4">
                            <i class="fas fa-flag fa-3x text-primary"></i>
                        </div>
                        <h4 class="vision-text fw-bold">
                            "Terwujudnya Kelurahan Kolo Sebagai Kelurahan Yang Sejahtera, Maju dan Mandiri"
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Misi Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-success text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-tasks me-3 fa-lg"></i>
                        <h3 class="mb-0">Misi</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mission-list">
                        <div class="mission-item">
                            <div class="mission-number">1</div>
                            <div class="mission-content">
                                <h5>Meningkatkan kualitas sumber daya manusia yang kreatif</h5>
                                <p class="text-muted mb-0">Sehingga mampu menggerakan potensi sumber daya yang tersedia</p>
                            </div>
                        </div>

                        <div class="mission-item">
                            <div class="mission-number">2</div>
                            <div class="mission-content">
                                <h5>Pemberdayaan masyarakat dilakukan oleh masyarakat sendiri</h5>
                                <p class="text-muted mb-0">Untuk menentukan sikap hidupnya agar menuju masyarakat sejahtera, maju dan mandiri</p>
                            </div>
                        </div>

                        <div class="mission-item">
                            <div class="mission-number">3</div>
                            <div class="mission-content">
                                <h5>Meningkatkan dan memelihara sarana dan prasarana kebutuhan dasar</h5>
                                <p class="text-muted mb-0">Politik, sosial, ekonomi dan kelembagaan yang bertumpu pada upaya percepatan untuk meningkatkan pertumbuhan ekonomi guna menciptakan kesejahteraan masyarakat secara berkelanjutan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Sejarah Section -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-info text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-history me-3 fa-lg"></i>
                        <h3 class="mb-0">Sejarah Kelurahan</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Awal Mula</h5>
                                <p>Sejak awal, Kolo merupakan salah satu desa yang terletak di bagian utara wilayah Kota Administratif Bima.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-gavel"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Perubahan Status (2003)</h5>
                                <p>Setelah disahkannya Undang-Undang Nomor 13 Tahun 2002 tentang Pembentukan Kota Bima di Provinsi Nusa Tenggara Barat, status Kolo berubah dari desa menjadi kelurahan melalui Peraturan Daerah Kota Bima Nomor 2 Tahun 2003 tentang Perubahan Status Desa Menjadi Kelurahan.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Wilayah Administratif</h5>
                                <p>Saat ini, Kelurahan Kolo berada dalam wilayah administratif Kecamatan Asakota.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Perkembangan Regulasi</h5>
                                <p>Pada mulanya, kelurahan berfungsi sebagai Perangkat Daerah sesuai Peraturan Daerah Kota Bima Nomor 5 Tahun 2008 tentang Pembentukan, Susunan, Kedudukan, Tugas Pokok dan Fungsi Kecamatan dan Kelurahan.</p>
                                <p>Namun, seiring perkembangan regulasi mengenai Perangkat Daerah, kelurahan tidak lagi menjadi perangkat daerah, melainkan menjadi bagian dari Perangkat Kecamatan. Perubahan ini ditetapkan dalam Peraturan Daerah Nomor 5 Tahun 2016 tentang Pembentukan dan Susunan Perangkat Daerah Kota Bima.</p>
                            </div>
                        </div>

                        <div class="timeline-item">
                            <div class="timeline-icon">
                                <i class="fas fa-user-tie"></i>
                            </div>
                            <div class="timeline-content">
                                <h5>Struktur Pemerintahan</h5>
                                <p>Kelurahan dipimpin oleh seorang Lurah yang berada di bawah dan bertanggung jawab kepada Camat. Lurah memiliki tugas membantu Camat dalam melaksanakan urusan pemerintahan, perekonomian, dan pembangunan di wilayah kelurahan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gambaran Umum Section -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-warning text-dark">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-globe-asia me-3 fa-lg"></i>
                        <h3 class="mb-0">Gambaran Umum Kelurahan</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="overview-grid">
                        <!-- Lokasi -->
                        <div class="overview-item">
                            <div class="overview-icon">
                                <i class="fas fa-map-pin"></i>
                            </div>
                            <div class="overview-content">
                                <h5>Lokasi Geografis</h5>
                                <p>Kelurahan Kolo merupakan salah satu kelurahan yang berada di wilayah pesisir utara Kecamatan Asakota, Kota Bima, Provinsi Nusa Tenggara Barat.</p>
                            </div>
                        </div>

                        <!-- Alam -->
                        <div class="overview-item">
                            <div class="overview-icon">
                                <i class="fas fa-mountain"></i>
                            </div>
                            <div class="overview-content">
                                <h5>Bentang Alam</h5>
                                <p>Wilayah ini dikenal dengan bentang alam pantainya yang khas dan menjadi salah satu kawasan yang memiliki potensi wisata alami. Secara geografis, Kolo memiliki lingkungan perbukitan, garis pantai, serta permukiman masyarakat yang tersebar di beberapa titik pesisir.</p>
                            </div>
                        </div>

                        <!-- Ekonomi -->
                        <div class="overview-item">
                            <div class="overview-icon">
                                <i class="fas fa-industry"></i>
                            </div>
                            <div class="overview-content">
                                <h5>Perekonomian</h5>
                                <p>Penduduk Kelurahan Kolo sebagian besar bekerja di sektor perikanan, pertanian lahan kering, dan usaha kecil yang berkaitan dengan aktivitas pesisir.</p>
                            </div>
                        </div>

                        <!-- Sosial -->
                        <div class="overview-item">
                            <div class="overview-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="overview-content">
                                <h5>Kehidupan Sosial</h5>
                                <p>Kehidupan sosial masyarakatnya masih sangat kental dengan budaya gotong royong, tercermin dari berbagai kegiatan kebersihan lingkungan, pengelolaan kawasan pantai, hingga kegiatan adat dan keagamaan yang rutin dilaksanakan bersama.</p>
                            </div>
                        </div>

                        <!-- Pemerintahan -->
                        <div class="overview-item">
                            <div class="overview-icon">
                                <i class="fas fa-landmark"></i>
                            </div>
                            <div class="overview-content">
                                <h5>Pemerintahan</h5>
                                <p>Dalam aspek pemerintahan, Kelurahan Kolo dipimpin oleh seorang Lurah yang berada di bawah koordinasi Camat Asakota. Pemerintahan kelurahan berfungsi sebagai ujung tombak pelayanan publik, mulai dari administrasi kependudukan, penyelenggaraan pembangunan, hingga pembinaan kemasyarakatan.</p>
                            </div>
                        </div>

                        <!-- Potensi -->
                        <div class="overview-item">
                            <div class="overview-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="overview-content">
                                <h5>Potensi dan Prospek</h5>
                                <p>Dengan keindahan alamnya, kehidupan sosial yang harmonis, serta dukungan pemerintahan yang terus berbenah, Kelurahan Kolo menjadi salah satu wilayah yang memiliki prospek perkembangan yang positif di Kota Bima. Kelurahan ini tidak hanya menyimpan potensi ekonomi dan pariwisata, namun juga menawarkan karakter masyarakat pesisir yang ramah, dinamis, dan penuh semangat kebersamaan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Gallery Section (Optional) -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-secondary text-white">
                    <div class="d-flex align-items-center">
                        <i class="fas fa-images me-3 fa-lg"></i>
                        <h3 class="mb-0">Potensi Kelurahan Kolo</h3>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <div class="feature-card text-center p-4 h-100">
                                <div class="feature-icon mb-3">
                                    <i class="fas fa-umbrella-beach fa-3x text-primary"></i>
                                </div>
                                <h5>Wisata Pantai</h5>
                                <p class="text-muted">Pantai Kolo sebagai daya tarik wisata utama dengan pemandangan alam yang indah.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="feature-card text-center p-4 h-100">
                                <div class="feature-icon mb-3">
                                    <i class="fas fa-fish fa-3x text-success"></i>
                                </div>
                                <h5>Potensi Perikanan</h5>
                                <p class="text-muted">Sektor perikanan yang menjadi tulang punggung perekonomian masyarakat pesisir.</p>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="feature-card text-center p-4 h-100">
                                <div class="feature-icon mb-3">
                                    <i class="fas fa-hands-helping fa-3x text-info"></i>
                                </div>
                                <h5>Gotong Royong</h5>
                                <p class="text-muted">Kebersamaan dan kerja sama masyarakat dalam membangun kelurahan.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    /* Header Styles */
    .page-header {
        padding: 2rem 0;
    }

    .separator {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 1rem 0;
    }

    .separator-line {
        width: 80px;
        height: 3px;
        background-color: #007bff;
        margin: 0 15px;
    }

    .separator-icon {
        color: #007bff;
        font-size: 1.5rem;
    }

    /* Card Styles */
    .card {
        border-radius: 15px;
        overflow: hidden;
    }

    .card-header {
        border-radius: 15px 15px 0 0 !important;
        padding: 1.2rem 1.5rem;
    }

    /* Visi Styles */
    .vision-icon {
        color: #007bff;
    }

    .vision-text {
        line-height: 1.8;
        color: #2c3e50;
    }

    /* Misi Styles */
    .mission-list {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .mission-item {
        display: flex;
        align-items: flex-start;
        gap: 1.5rem;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 10px;
        transition: transform 0.3s ease;
    }

    .mission-item:hover {
        transform: translateY(-5px);
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .mission-number {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #28a745;
        color: white;
        border-radius: 50%;
        font-weight: bold;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .mission-content h5 {
        color: #28a745;
        margin-bottom: 0.5rem;
    }

    /* Timeline Styles */
    .timeline {
        position: relative;
        padding-left: 30px;
    }

    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 0;
        bottom: 0;
        width: 3px;
        background: linear-gradient(to bottom, #17a2b8, transparent);
    }

    .timeline-item {
        position: relative;
        margin-bottom: 2rem;
        padding-left: 30px;
    }

    .timeline-icon {
        position: absolute;
        left: -10px;
        top: 0;
        width: 40px;
        height: 40px;
        background: #17a2b8;
        color: white;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
    }

    .timeline-content {
        background: white;
        padding: 1.5rem;
        border-radius: 10px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .timeline-content h5 {
        color: #17a2b8;
        margin-bottom: 0.5rem;
    }

    /* Overview Styles */
    .overview-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .overview-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        padding: 1.5rem;
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
    }

    .overview-item:hover {
        background: #e9ecef;
        transform: translateX(5px);
    }

    .overview-icon {
        flex-shrink: 0;
        width: 50px;
        height: 50px;
        background: #ffc107;
        color: #212529;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }

    .overview-content h5 {
        color: #ffc107;
        margin-bottom: 0.5rem;
    }

    /* Feature Cards */
    .feature-card {
        background: #f8f9fa;
        border-radius: 10px;
        transition: all 0.3s ease;
        height: 100%;
    }

    .feature-card:hover {
        background: white;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        transform: translateY(-5px);
    }

    .feature-icon {
        color: inherit;
    }

    /* Responsive Styles */
    @media (max-width: 768px) {
        .mission-item, .overview-item {
            flex-direction: column;
            text-align: center;
        }

        .mission-number, .overview-icon {
            align-self: center;
        }

        .timeline {
            padding-left: 20px;
        }

        .timeline-item {
            padding-left: 20px;
        }

        .timeline-icon {
            left: -5px;
        }

        .overview-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Animasi scroll untuk section
    document.addEventListener('DOMContentLoaded', function() {
        const sections = document.querySelectorAll('.card');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, {
            threshold: 0.1
        });

        sections.forEach(section => {
            section.style.opacity = '0';
            section.style.transform = 'translateY(20px)';
            section.style.transition = 'opacity 0.5s ease, transform 0.5s ease';
            observer.observe(section);
        });
    });
</script>
@endsection
