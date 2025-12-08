@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tulisan Tamu</h3>
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
                    <a href="{{ route('admin.titip-tulisan.manage') }}">Manage</a>
                </li>
                <li class="separator">
                    <i class="icon-arrow-right"></i>
                </li>
                <li class="nav-item active">
                    <a>View</a>
                </li>
            </ul>
        </div>

        {{-- Content --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                    {{-- Tombol Accept / Reject --}}
                    @if ($titipTulisan->status != 'Accept')
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div class="card-title">{{ $titipTulisan->judul }}</div>
                        <div class="d-flex gap-2">
                            <button class="btn btn-success text-light status-btn" data-id="{{ $titipTulisan->id }}" data-status="Accept">Accept</button>
                            <button class="btn btn-danger text-light status-btn" data-id="{{ $titipTulisan->id }}" data-status="Reject">Reject</button>
                        </div>
                    </div>
                    @endif

                    <div class="card-body">
                        {{-- Gambar --}}
                        @if ($titipTulisan->image)
                        <div class="position-relative rounded mb-3">
                            <img src="{{ asset('storage/titip-tulisan/' . $titipTulisan->image) }}" class="img-fluid rounded w-100" alt="">
                            <div class="position-absolute text-white px-4 py-2 bg-primary rounded" style="top:20px; right:20px;">
                                {{ $titipTulisan->category->name }}
                            </div>
                        </div>
                        @endif

                        {{-- Konten --}}
                        <p class="my-2">{!! $titipTulisan->isi !!}</p>

                        {{-- Status --}}
                        <div class="mb-3">
                            @php
                                $badge = 'secondary';
                                if($titipTulisan->status == 'Accept') $badge = 'success';
                                elseif($titipTulisan->status == 'Reject') $badge = 'danger';
                            @endphp
                            <span class="badge bg-{{ $badge }}">{{ $titipTulisan->status }}</span>
                        </div>

                        {{-- Pengirim --}}
                        <div class="card-footer">
                            <div class="row g-2 align-items-center mt-1">
                                <div class="col-12">
                                    <h4>{{ $titipTulisan->nama_pengirim }}</h4>
                                    <p class="mb-0">{{ $titipTulisan->email_pengirim }}</p>
                                </div>
                            </div>
                        </div>

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
    // Tombol Accept / Reject dengan SweetAlert
    $('.status-btn').click(function() {
        let id = $(this).data('id');
        let status = $(this).data('status'); // Accept atau Reject

        Swal.fire({
            title: `Yakin ingin merubah status menjadi "${status}"?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if(result.isConfirmed){
                $.ajax({
                    url: `/admin/titip-tulisan/status/${id}`,
                    type: 'PATCH',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
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
                            text: err.responseJSON?.message || 'Status gagal diperbarui.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});
</script>
@endsection
