@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Kelola Komentar</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>Semua Komentar</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="card-title mb-0">Semua Komentar</h4>
                            <div class="d-flex gap-2">
                                <button class="btn btn-sm btn-outline-primary filter-btn active" data-status="all">
                                    Semua
                                </button>
                                <button class="btn btn-sm btn-outline-success filter-btn" data-status="News">
                                    Berita
                                </button>
                                <button class="btn btn-sm btn-outline-info filter-btn" data-status="TitipTulisan">
                                    Tulisan Tamu
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if($comments->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th width="40%">Komentar</th>
                                            <th width="15%">Postingan</th>
                                            <th width="15%">Pengguna</th>
                                            <th width="15%">Tanggal</th>
                                            <th width="15%">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($comments as $comment)
                                        @php
                                            // PERBAIKAN: Gunakan class_basename untuk konsistensi
                                            $type = class_basename($comment->commentable_type);
                                            $badgeClass = $type === 'News' ? 'success' : 'info';
                                            $typeText = $type === 'News' ? 'Berita' : 'Tulisan Tamu';
                                        @endphp
                                        <tr class="comment-row" data-type="{{ $type }}">
                                            <td>
                                                <div class="d-flex align-items-start">
                                                    <div class="flex-shrink-0 me-2">
                                                        @if($comment->user)
                                                            <img src="{{ $comment->user->image ? asset('storage/images/' . $comment->user->image) : asset('img/default.jpeg') }}"
                                                                 class="rounded-circle"
                                                                 width="40"
                                                                 height="40"
                                                                 alt="{{ $comment->user->name }}">
                                                        @else
                                                            <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center rounded-circle"
                                                                 style="width: 40px; height: 40px;">
                                                                {{ strtoupper(substr($comment->name, 0, 1)) }}
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="flex-grow-1">
                                                        <div class="mb-1">
                                                            <strong>{{ $comment->name }}</strong>
                                                            @if($comment->email)
                                                                <small class="text-muted ms-2">{{ $comment->email }}</small>
                                                            @endif
                                                        </div>
                                                        <p class="mb-0 text-break">{{ Str::limit($comment->content, 100) }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-{{ $badgeClass }} mb-1">{{ $typeText }}</span>
                                                <br>
                                                @if($comment->commentable)
                                                    @if($type === 'News')
                                                        <a href="{{ route('news.show', $comment->commentable->slug) }}"
                                                           target="_blank"
                                                           class="text-decoration-none">
                                                            {{ Str::limit($comment->commentable->title, 30) }}
                                                        </a>
                                                    @else
                                                        <a href="{{ route('titip-tulisan.show', $comment->commentable->slug) }}"
                                                           target="_blank"
                                                           class="text-decoration-none">
                                                            {{ Str::limit($comment->commentable->judul, 30) }}
                                                        </a>
                                                    @endif
                                                @else
                                                    <span class="text-danger">Postingan dihapus</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($comment->user_id)
                                                    <span class="badge bg-primary">User Terdaftar</span>
                                                @else
                                                    <span class="badge bg-secondary">Tamu</span>
                                                @endif
                                            </td>
                                            <td>
                                                <small class="text-muted">{{ $comment->created_at->format('d/m/Y') }}</small><br>
                                                <small>{{ $comment->created_at->format('H:i') }}</small>
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <!-- Tombol Hapus -->
                                                    <button class="btn btn-sm btn-danger delete-comment-btn"
                                                            data-id="{{ $comment->id }}"
                                                            data-name="{{ $comment->name }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>

                                                    <!-- Tombol Lihat Lengkap -->
                                                    <button class="btn btn-sm btn-primary view-comment-btn"
                                                            data-content="{{ $comment->content }}"
                                                            data-name="{{ $comment->name }}"
                                                            data-email="{{ $comment->email }}"
                                                            data-date="{{ $comment->created_at->format('d F Y H:i') }}"
                                                            data-post-title="{{ $comment->commentable ? ($type === 'News' ? $comment->commentable->title : $comment->commentable->judul) : 'Postingan dihapus' }}"
                                                            data-post-type="{{ $typeText }}">
                                                        <i class="fas fa-eye"></i>
                                                    </button>

                                                    <!-- Link ke Postingan -->
                                                    @if($comment->commentable)
                                                        <a href="{{ $type === 'News' ? route('news.show', $comment->commentable->slug) : route('titip-tulisan.show', $comment->commentable->slug) }}"
                                                           class="btn btn-sm btn-info"
                                                           target="_blank">
                                                            <i class="fas fa-external-link-alt"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $comments->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                                <h5>Belum ada komentar</h5>
                                <p class="text-muted">Tidak ada komentar yang tersedia</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Komentar Terhapus (Hanya Super Admin) -->
                @if(Auth::user()->is_admin && $deletedComments->count() > 0)
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h4 class="card-title mb-0 text-danger">Komentar Terhapus</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Komentar</th>
                                        <th>Postingan</th>
                                        <th>Dihapus Pada</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($deletedComments as $comment)
                                    @php
                                        $type = class_basename($comment->commentable_type);
                                    @endphp
                                    <tr>
                                        <td>
                                            <div class="mb-1">
                                                <strong>{{ $comment->name }}</strong>
                                            </div>
                                            <p class="mb-0 text-break text-muted">{{ Str::limit($comment->content, 80) }}</p>
                                        </td>
                                        <td>
                                            @if($comment->commentable)
                                                {{ Str::limit($type === 'News' ? $comment->commentable->title : $comment->commentable->judul, 30) }}
                                            @else
                                                <span class="text-danger">Postingan dihapus</span>
                                            @endif
                                        </td>
                                        <td>
                                            <small>{{ $comment->deleted_at->format('d/m/Y H:i') }}</small>
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <button class="btn btn-sm btn-success restore-comment-btn"
                                                        data-id="{{ $comment->id }}">
                                                    <i class="fas fa-undo"></i> Pulihkan
                                                </button>
                                                <button class="btn btn-sm btn-danger force-delete-comment-btn"
                                                        data-id="{{ $comment->id }}"
                                                        data-name="{{ $comment->name }}">
                                                    <i class="fas fa-trash-alt"></i> Hapus Permanen
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal View Comment -->
<div class="modal fade" id="viewCommentModal" tabindex="-1" role="dialog" aria-labelledby="viewCommentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewCommentModalLabel">Detail Komentar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Nama:</strong>
                        <p id="modal-comment-name" class="mb-0"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        <p id="modal-comment-email" class="mb-0"></p>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Tanggal:</strong>
                        <p id="modal-comment-date" class="mb-0"></p>
                    </div>
                    <div class="col-md-6">
                        <strong>Tipe Postingan:</strong>
                        <p id="modal-comment-type" class="mb-0"></p>
                    </div>
                </div>
                <div class="mb-3">
                    <strong>Judul Postingan:</strong>
                    <p id="modal-post-title" class="mb-0"></p>
                </div>
                <div class="mb-3">
                    <strong>Komentar:</strong>
                    <div id="modal-comment-content" class="bg-light p-3 rounded"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('custom-footer')
<script>
    $(document).ready(function() {
        // Filter by type
        $('.filter-btn').click(function() {
            const type = $(this).data('status');

            // Update active button
            $('.filter-btn').removeClass('active');
            $(this).addClass('active');

            // Filter table rows
            if (type === 'all') {
                $('.comment-row').show();
            } else {
                $('.comment-row').hide();
                $(`.comment-row[data-type="${type}"]`).show();
            }
        });

        // View comment modal
        $('.view-comment-btn').click(function() {
            const name = $(this).data('name');
            const email = $(this).data('email');
            const content = $(this).data('content');
            const date = $(this).data('date');
            const postTitle = $(this).data('post-title');
            const postType = $(this).data('post-type');

            $('#modal-comment-name').text(name);
            $('#modal-comment-email').text(email || '-');
            $('#modal-comment-date').text(date);
            $('#modal-post-title').text(postTitle);
            $('#modal-comment-type').text(postType);
            $('#modal-comment-content').text(content);

            $('#viewCommentModal').modal('show');
        });

        // Delete comment
        $('.delete-comment-btn').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const url = "{{ route('admin.comments.destroy', ':id') }}".replace(':id', id);

            Swal.fire({
                title: 'Hapus Komentar?',
                html: `<p class="mb-3">Anda yakin ingin menghapus komentar dari:</p>
                      <p class="fw-bold">"${name}"</p>
                      <p class="text-danger small">Komentar akan dipindahkan ke sampah dan bisa dipulihkan</p>`,
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
                            let errorMsg = err.responseJSON?.message || 'Gagal menghapus komentar';
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

        // Restore deleted comment (Super Admin only)
        @if(Auth::user()->is_admin)
        $('.restore-comment-btn').click(function() {
            const id = $(this).data('id');
            const url = "{{ route('admin.comments.restore', ':id') }}".replace(':id', id);

            Swal.fire({
                title: 'Pulihkan Komentar?',
                text: 'Komentar akan dikembalikan ke daftar aktif',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#28a745',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Pulihkan!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url: url,
                        type: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}'
                        },
                        success: function(response){
                            Swal.fire({
                                title: 'Berhasil!',
                                text: 'Komentar berhasil dipulihkan',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err){
                            let errorMsg = err.responseJSON?.message || 'Gagal memulihkan komentar';
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

        // Force delete comment (Super Admin only)
        $('.force-delete-comment-btn').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const url = "{{ route('admin.comments.forceDelete', ':id') }}".replace(':id', id);

            Swal.fire({
                title: 'Hapus Permanen?',
                html: `<p class="mb-3">Anda yakin ingin menghapus permanen komentar dari:</p>
                      <p class="fw-bold">"${name}"</p>
                      <p class="text-danger small">Aksi ini tidak dapat dibatalkan!</p>`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus Permanen!',
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
                                text: response.message || 'Komentar berhasil dihapus permanen',
                                icon: 'success',
                                timer: 1500,
                                showConfirmButton: false
                            }).then(() => {
                                location.reload();
                            });
                        },
                        error: function(err){
                            Swal.close();
                            let errorMsg = err.responseJSON?.message || 'Gagal menghapus komentar';
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
        @endif
    });
</script>

<style>
    .avatar-circle {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .comment-row:hover {
        background-color: rgba(0, 123, 255, 0.05);
    }

    .text-break {
        word-break: break-word;
    }

    .filter-btn.active {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
</style>
@endsection
