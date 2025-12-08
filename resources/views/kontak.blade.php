@extends('layouts.app')

@section('content')
<div class="container my-5">

    {{-- SweetAlert Success --}}
    @if (session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    title: "Berhasil!",
                    text: "{{ session('success') }}",
                    icon: "success",
                    confirmButtonColor: "#3085d6",
                });
            });
        </script>
    @endif

    <div class="text-center mb-4">
        <h2>Kontak Kami</h2>
        <p class="text-muted">Silakan tinggalkan pesan, kami akan segera menghubungi Anda</p>
    </div>

    <div class="row justify-content-center align-items-center">

        {{-- Informasi Kontak --}}
        <div class="col-lg-4 shadow-sm p-4 rounded mb-4">
            <h5 class="mb-3 fw-bold">Informasi Kontak</h5>
            <p class="mb-2"><i class="bi bi-telephone-fill"></i> <strong>No HP:</strong><br> 082213116457</p>
            <p class="mb-2"><i class="bi bi-envelope-fill"></i> <strong>Email:</strong><br> sulaimansut@gmail.com</p>
            <p class="mb-0"><i class="bi bi-geo-alt-fill"></i> <strong>Alamat:</strong><br>
                Jl. Ule-Kedo, Kelurahan Ule, Kota Bima <br>
                Kode Pos 84119
            </p>
        </div>

        {{-- Form Kontak --}}
        <div class="col-lg-7">
            <div class="card border-0 shadow-sm p-4">
                <h5 class="fw-bold mb-3 text-center">Kirim Pesan</h5>
                <form action="{{ route('kontak.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama') }}" placeholder="Masukkan nama Anda">
                        @error('nama')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                               value="{{ old('email') }}" placeholder="Masukkan email Anda">
                        @error('email')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea name="pesan" class="form-control @error('pesan') is-invalid @enderror"
                                  rows="4" placeholder="Tulis pesan Anda">{{ old('pesan') }}</textarea>
                        @error('pesan')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2 fw-semibold text-white">
                        Kirim Pesan
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>



@endsection
