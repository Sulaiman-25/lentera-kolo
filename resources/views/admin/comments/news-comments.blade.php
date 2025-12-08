@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Komentar Berita</h3>
            <ul class="breadcrumbs mb-3">
                <li class="nav-home">
                    <a href="{{ route('dashboard') }}">
                        <i class="icon-home"></i>
                    </a>
                </li>
                @if(auth()->user()->is_admin || auth()->user()->hasRole('Editor'))
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.comments.index') }}">Semua Komentar</a>
                </li>
                @endif
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>{{ $news->title }}</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h4 class="card-title mb-0">Komentar: {{ $news->title }}</h4>
                                <p class="text-muted mb-0 mt-1">
                                    <i class="fas fa-user me-1"></i>{{ $news->author->name }} |
                                    <i class="fas fa-calendar me-1"></i>{{ $news->created_at->format('d F Y') }} |
                                    <i class="fas fa-eye me-1"></i>{{ $news->views }} views
                                </p>
                            </div>
                            <div class="d-flex gap-2">
                                <a href="{{ route('news.show', $news->slug) }}"
                                   class="btn btn-sm btn-info"
                                   target="_blank">
                                    <i class="fas fa-external-link-alt me-1"></i>Lihat Berita
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="card-body">
                        @if($comments->count() > 0)
                            <div class="alert alert-info d-flex align-items-center mb-4">
                                <i class="fas fa-info-circle me-2 fa-lg"></i>
                                <div>
                                    <strong>Info:</strong>
                                    @if(auth()->user()->is_admin)
                                        Anda dapat menghapus komentar apa pun.
                                    @elseif(auth()->user()->hasRole('Editor'))
                                        Anda dapat menghapus komentar dari semua berita.
                                    @elseif(auth()->user()->hasRole('Writer'))
                                        Anda hanya dapat menghapus komentar dari berita yang Anda buat.
                                    @endif
                                </div>
                            </div>

                            <div class="comments-list">
                                @foreach($comments as $comment)
                                <div class="comment-item mb-4 pb-4 border-bottom">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="flex-shrink-0 me-3">
                                            @if($comment->user)
                                                <img src="{{ $comment->user->image ? asset('storage/images/' . $comment->user->image) : asset('img/default.jpeg') }}"
                                                     class="rounded-circle"
                                                     width="50"
                                                     height="50"
                                                     alt="{{ $comment->user->name }}">
                                            @else
                                                <div class="avatar-circle bg-primary text-white d-flex align-items-center justify-content-center rounded-circle"
                                                     style="width: 50px; height: 50px; font-size: 1.25rem;">
                                                    {{ strtoupper(substr($comment->name, 0, 1)) }}
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-grow-1">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div>
                                                    <h6 class="mb-1 fw-bold">{{ $comment->name }}</h6>
                                                    @if($comment->user_id)
                                                        <span class="badge bg-primary me-2">User Terdaftar</span>
                                                    @else
                                                        <span class="badge bg-secondary me-2">Tamu</span>
                                                    @endif
                                                    @if($comment->email)
                                                        <small class="text-muted">{{ $comment->email }}</small>
                                                    @endif
                                                </div>
                                                <div class="d-flex gap-2">
                                                    <small class="text-muted">{{ $comment->created_at->format('d/m/Y H:i') }}</small>
                                                    <button class="btn btn-sm btn-danger delete-news-comment-btn"
                                                            data-id="{{ $comment->id }}"
                                                            data-name="{{ $comment->name }}">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="comment-content mt-3 p-3 bg-light rounded">
                                                <p class="mb-0">{{ $comment->content }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <!-- Pagination -->
                            <div class="d-flex justify-content-center mt-4">
                                {{ $comments->links() }}
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-comment-slash fa-3x text-muted mb-3"></i>
                                <h5>Belum ada komentar</h5>
                                <p class="text-muted">Tidak ada komentar untuk berita ini</p>
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
        // Delete comment from news page
        $('.delete-news-comment-btn').click(function() {
            const id = $(this).data('id');
            const name = $(this).data('name');
            const url = "{{ route('admin.comments.destroy', ':id') }}".replace(':id', id);

            Swal.fire({
                title: 'Hapus Komentar?',
                html: `<p class="mb-3">Anda yakin ingin menghapus komentar dari:</p>
                      <p class="fw-bold">"${name}"</p>`,
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
    });
</script>

<style>
    .avatar-circle {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    }

    .comment-content {
        line-height: 1.6;
    }

    .comment-item:hover {
        background-color: rgba(0, 123, 255, 0.05);
        border-radius: 8px;
        padding-left: 10px;
        padding-right: 10px;
    }
</style>
@endsection
