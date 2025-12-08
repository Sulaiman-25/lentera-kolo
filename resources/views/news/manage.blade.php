@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tulisan Tamu (Diterima)</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.titip-tulisan.status') }}">Status Review</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>Manage (Diterima)</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Manage Tulisan Tamu (Diterima)</h4>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.titip-tulisan.status') }}" class="btn btn-outline-primary btn-sm">
                                    <i class="fas fa-clock me-1"></i>Status Review
                                </a>
                            </div>
                        </div>
                        <p class="text-muted mb-0 mt-2">Tulisan yang sudah diterima dan dipublikasikan</p>
                    </div>

                    <div class="card-body">
                        @if($all->count() > 0)
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">No</th>
                                            <th style="width: 25%">Judul</th>
                                            <th style="width: 15%">Pengirim</th>
                                            <th style="width: 10%">Kategori</th>
                                            <th style="width: 10%">Views</th>
                                            <th style="width: 10%">Komentar</th>
                                            <th style="width: 15%">Tanggal</th>
                                            <th style="width: 15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($all as $item)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    @if($item->image)
                                                    <div class="flex-shrink-0 me-2">
                                                        <img src="{{ asset('storage/titip-tulisan/' . $item->image) }}"
                                                             class="rounded"
                                                             style="width: 50px; height: 50px; object-fit: cover;"
                                                             alt="{{ $item->judul }}">
                                                    </div>
                                                    @endif
                                                    <div>
                                                        <strong class="d-block">{{ Str::limit($item->judul, 60, '...') }}</strong>
                                                        <small class="text-muted">{{ $item->email_pengirim }}</small>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center rounded-circle me-2"
                                                         style="width: 30px; height: 30px; font-size: 0.8rem;">
                                                        {{ strtoupper(substr($item->nama_pengirim, 0, 1)) }}
                                                    </div>
                                                    <span>{{ $item->nama_pengirim }}</span>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-info">{{ $item->category->name }}</span>
                                            </td>
                                            <td class="text-center">
                                                <span class="badge bg-secondary">{{ $item->views }}</span>
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $commentCount = \App\Models\Comment::where('commentable_type', 'App\Models\TitipTulisan')
                                                        ->where('commentable_id', $item->id)
                                                        ->count();
                                                @endphp
                                                @if($commentCount > 0)
                                                    <a href="{{ route('titip-tulisan.show', $item->slug) }}#comments"
                                                       class="btn btn-sm btn-warning"
                                                       title="Lihat {{ $commentCount }} Komentar"
                                                       target="_blank">
                                                        <i class="fas fa-comments"></i>
                                                        <span class="badge bg-danger">{{ $commentCount }}</span>
                                                    </a>
                                                @else
                                                    <span class="badge bg-light text-dark">0</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="d-block">{{ $item->created_at->format('d/m/Y') }}</small>
                                                <small class="text-muted">{{ $item->created_at->format('H:i') }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-center gap-1">
                                                    <!-- Lihat Publik -->
                                                    <a href="{{ route('titip-tulisan.show', $item->slug) }}"
                                                       class="btn btn-sm btn-info"
                                                       title="Lihat di Publik"
                                                       target="_blank">
                                                        <i class="fas fa-external-link-alt"></i>
                                                    </a>

                                                    <!-- Detail Admin -->
                                                    <a href="{{ route('admin.titip-tulisan.view', $item->id) }}"
                                                       class="btn btn-sm btn-primary"
                                                       title="Detail Admin">
                                                        <i class="fas fa-eye"></i>
                                                    </a>

                                                    <!-- Komentar (Admin/Editor) -->
                                                    @if(auth()->user()->is_admin || auth()->user()->hasRole('Editor'))
                                                    <a href="{{ route('titip-tulisan.show', $item->slug) }}#comments"
                                                       class="btn btn-sm btn-warning"
                                                       title="Kelola Komentar"
                                                       target="_blank">
                                                        <i class="fas fa-comment"></i>
                                                    </a>
                                                    @endif

                                                    <!-- Hapus -->
                                                    <button class="btn btn-sm btn-danger delete-btn"
                                                            data-id="{{ $item->id }}"
                                                            data-title="{{ $item->judul }}"
                                                            title="Hapus">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Info Stats -->
                            <div class="row mt-4">
                                <div class="col-md-3 mb-3">
                                    <div class="card card-stats bg-primary text-white">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="mb-0">{{ $all->count() }}</h5>
                                                    <small>Total Tulisan</small>
                                                </div>
                                                <i class="fas fa-file-alt fa-2x opacity-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card card-stats bg-success text-white">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="mb-0">{{ $all->sum('views') }}</h5>
                                                    <small>Total Views</small>
                                                </div>
                                                <i class="fas fa-eye fa-2x opacity-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card card-stats bg-info text-white">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    @php
                                                        $totalComments = 0;
                                                        foreach($all as $item) {
                                                            $totalComments += \App\Models\Comment::where('commentable_type', 'App\Models\TitipTulisan')
                                                                ->where('commentable_id', $item->id)
                                                                ->count();
                                                        }
                                                    @endphp
                                                    <h5 class="mb-0">{{ $totalComments }}</h5>
                                                    <small>Total Komentar</small>
                                                </div>
                                                <i class="fas fa-comments fa-2x opacity-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <div class="card card-stats bg-warning text-white">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h5 class="mb-0">{{ $all->unique('nama_pengirim')->count() }}</h5>
                                                    <small>Kontributor Unik</small>
                                                </div>
                                                <i class="fas fa-users fa-2x opacity-50"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <div class="mb-4">
                                    <i class="fas fa-check-circle fa-4x text-success opacity-50"></i>
                                </div>
                                <h4 class="text-muted mb-3">Belum ada tulisan yang diterima</h4>
                                <p class="text-muted mb-4">Tulisan yang sudah disetujui akan muncul di sini</p>
                                <a href="{{ route('admin.titip-tulisan.status') }}" class="btn btn-primary">
                                    <i class="fas fa-clock me-2"></i>Tinjau Tulisan Menunggu
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-footer')
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#basic-datatables').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            },
            "order": [[6, "desc"]], // Order by date descending
            "pageLength": 10,
            "columnDefs": [
                { "orderable": false, "targets": [7] } // Non-orderable untuk kolom aksi
            ]
        });

        // SweetAlert untuk hapus
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            let id = $(this).data('id');
            let title = $(this).data('title');
            let url = "{{ route('admin.titip-tulisan.destroy', ':id') }}".replace(':id', id);

            Swal.fire({
                title: 'Hapus Tulisan?',
                html: `<p class="mb-3">Anda yakin ingin menghapus tulisan:</p>
                      <p class="fw-bold">"${title}"</p>
                      <p class="text-danger small">Aksi ini tidak dapat dibatalkan!</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        beforeSend: function() {
                            Swal.fire({
                                title: 'Menghapus...',
                                text: 'Mohon tunggu sebentar',
                                allowOutsideClick: false,
                                showConfirmButton: false,
                                willOpen: () => {
                                    Swal.showLoading();
                                }
                            });
                        },
                        success: function(response){
                            Swal.close();
                            Swal.fire({
                                title: 'Berhasil!',
                                text: response.message,
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err){
                            Swal.close();
                            let errorMsg = err.responseJSON?.message || 'Gagal menghapus tulisan';
                            Swal.fire({
                                title: 'Gagal!',
                                text: errorMsg,
                                icon: 'error'
                            });
                        }
                    });
                }
            });
        });

        // Quick view for comments
        $(document).on('click', '.comment-count-btn', function(e) {
            e.preventDefault();
            const tulisanId = $(this).data('id');
            const tulisanTitle = $(this).data('title');

            // Load comments via AJAX
            $.ajax({
                url: "{{ route('comments.get') }}",
                type: 'GET',
                data: {
                    commentable_type: 'titip-tulisan',
                    commentable_id: tulisanId
                },
                beforeSend: function() {
                    Swal.fire({
                        title: 'Memuat komentar...',
                        text: 'Mohon tunggu sebentar',
                        allowOutsideClick: false,
                        showConfirmButton: false,
                        willOpen: () => {
                            Swal.showLoading();
                        }
                    });
                },
                success: function(response) {
                    Swal.close();

                    if (response.success && response.comments.data.length > 0) {
                        let commentsHtml = `<div style="max-height: 400px; overflow-y: auto;">
                            <h6 class="mb-3">Komentar untuk: "${tulisanTitle}"</h6>
                            <div class="list-group">`;

                        response.comments.data.forEach(function(comment) {
                            const timeAgo = moment(comment.created_at).fromNow();
                            commentsHtml += `
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">${comment.name}</h6>
                                        <small class="text-muted">${timeAgo}</small>
                                    </div>
                                    <p class="mb-1">${comment.content}</p>
                                    <small class="text-muted">${comment.email ? 'Email: ' + comment.email : 'Email tidak tersedia'}</small>
                                </div>`;
                        });

                        commentsHtml += `</div></div>`;

                        Swal.fire({
                            title: 'Komentar',
                            html: commentsHtml,
                            width: '600px',
                            showCloseButton: true,
                            showConfirmButton: false
                        });
                    } else {
                        Swal.fire({
                            title: 'Tidak ada komentar',
                            text: 'Belum ada komentar untuk tulisan ini',
                            icon: 'info'
                        });
                    }
                },
                error: function() {
                    Swal.close();
                    Swal.fire({
                        title: 'Error',
                        text: 'Gagal memuat komentar',
                        icon: 'error'
                    });
                }
            });
        });
    });
</script>

<style>
    .card-stats {
        border-radius: 10px;
        border: none;
        transition: transform 0.2s;
    }

    .card-stats:hover {
        transform: translateY(-2px);
    }

    .card-stats .card-body {
        padding: 1.25rem;
    }

    .card-stats h5 {
        font-size: 1.5rem;
        font-weight: bold;
    }

    .card-stats small {
        opacity: 0.8;
    }

    .avatar-circle {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .badge {
        font-size: 0.75em;
    }

    .table td {
        vertical-align: middle;
    }

    .btn-sm {
        padding: 0.25rem 0.5rem;
        font-size: 0.75rem;
    }

    @media (max-width: 768px) {
        .d-flex.gap-1 .btn {
            margin-bottom: 2px;
        }

        .card-stats {
            margin-bottom: 1rem;
        }
    }a
</style>
@endsection
