@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <h3 class="mb-4 text-center fw-bold">Kirim Tulisan Anda</h3>

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

            <div class="card shadow-sm border-0">
                <div class="card-body">

                    <form action="{{ route('titip-tulisan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Nama Pengirim *</label>
                            <input type="text" name="nama_pengirim" class="form-control @error('nama_pengirim') is-invalid @enderror"
                                   value="{{ old('nama_pengirim') }}" required>
                            @error('nama_pengirim')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Email Pengirim *</label>
                            <input type="email" name="email_pengirim" class="form-control @error('email_pengirim') is-invalid @enderror"
                                   value="{{ old('email_pengirim') }}" required>
                            @error('email_pengirim')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Kategori *</label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Judul Tulisan *</label>
                            <input type="text" name="judul" class="form-control @error('judul') is-invalid @enderror"
                                   value="{{ old('judul') }}" required>
                            @error('judul')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Isi Tulisan *</label>
                            <textarea name="isi" rows="6" class="form-control @error('isi') is-invalid @enderror" required>{{ old('isi') }}</textarea>
                            @error('isi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Gambar (Opsional)</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Kirim Tulisan
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
