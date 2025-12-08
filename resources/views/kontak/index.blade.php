@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">

        <div class="page-header">
            <h3 class="fw-bold mb-3">Kelola Pesan Kontak</h3>
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
                    <a>Kontak</a>
                </li>
            </ul>
        </div>

        {{-- SweetAlert Sukses --}}
        @if(session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: '{{ session("success") }}',
                        confirmButtonColor: '#3085d6'
                    });
                });
            </script>
        @endif

        {{-- Jika Data Kosong --}}
        @if ($contacts->count() == 0)
            <div class="alert alert-info">Belum ada pesan masuk.</div>
        @endif

        <div class="row">
            @foreach($contacts as $contact)
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm border-0 rounded">
                        <div class="card-body">
                            <h5 class="fw-bold">{{ $contact->nama }}</h5>
                            <p class="text-muted mb-2"><strong>Email:</strong> {{ $contact->email }}</p>
                            <p>"{{ Str::limit($contact->pesan, 120) }}"</p>

                            <small class="text-secondary d-block mb-3">
                                Dikirim: {{ $contact->created_at->translatedFormat('d M Y H:i') }}
                            </small>

                            {{-- Form Hapus dengan SweetAlert --}}
                            <form id="delete-form-{{ $contact->id }}" action="{{ route('admin.kontak.destroy', $contact->id) }}"
                                  method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>

                            <button class="btn btn-sm btn-danger"
                                onclick="konfirmasiHapus({{ $contact->id }})">
                                <i class="fas fa-trash"></i> Hapus
                            </button>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $contacts->links() }}
        </div>

    </div>
</div>

{{-- Script SweetAlert Konfirmasi Hapus --}}
<script>
function konfirmasiHapus(id) {
    Swal.fire({
        title: 'Apakah Anda yakin?',
        text: "Pesan yang dihapus tidak dapat dikembalikan!",
        icon: 'peringatan',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById('delete-form-' + id).submit();
        }
    });
}
</script>

@endsection
