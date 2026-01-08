@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Status Tulisan Tamu</h3>
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
                    <a>Status</a>
                </li>
            </ul>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Tulisan Tamu (Pending/Reject)</h4>
                        <p class="text-muted mb-0">Manage tulisan yang belum/tidak diterima</p>
                    </div>
                    <div class="card-body">
                        @if($pending->count() > 0)
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover text-center">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Judul</th>
                                            <th>Pengirim</th>
                                            <th>Email</th>
                                            <th>Kategori</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pending as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->judul }}</td>
                                            <td>{{ $item->nama_pengirim }}</td>
                                            <td>{{ $item->email_pengirim }}</td>
                                            <td>{{ $item->category->name }}</td>
                                            <td>
                                                @php
                                                    $badge = 'secondary'; // Default jika status tidak teridentifikasi

                                                    // Logika yang diperbarui untuk status
                                                    if($item->status == 'Accept') {
                                                        $badge = 'success'; // Hijau
                                                    } elseif($item->status == 'Reject') {
                                                        $badge = 'danger'; // Merah
                                                    } elseif($item->status == 'Pending') {
                                                        $badge = 'warning'; // Kuning/Oranye untuk Pending
                                                    }
                                                @endphp
                                                {{-- Menggunakan badge dengan warna yang sesuai --}}
                                                <span class="badge bg-{{ $badge }}">{{ $item->status }}</span>
                                            </td>
                                            <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="d-flex justify-content-center">
                                                    <a href="{{ route('admin.titip-tulisan.view', $item->id) }}"
                                                       class="btn btn-link btn-primary btn-sm me-1"
                                                       title="View">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                    <button class="btn btn-link btn-danger btn-sm delete-btn"
                                                            data-url="{{ route('admin.titip-tulisan.destroy', $item->id) }}"
                                                            title="Delete">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5">
                                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                                <h5>Tidak ada tulisan yang perlu ditinjau</h5>
                                <p class="text-muted">Semua tulisan sudah diproses</p>
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
        // Inisialisasi DataTable
        $("#basic-datatables").DataTable();

        // SweetAlert untuk hapus
        $('.delete-btn').click(function(e) {
            e.preventDefault();
            let url = $(this).data('url');

            Swal.fire({
                title: 'Yakin ingin menghapus tulisan ini?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if(result.isConfirmed){
                    $.ajax({
                        url: url,
                        type: 'DELETE',
                        data: { _token: '{{ csrf_token() }}' },
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
                                text: err.responseJSON?.message || 'Gagal menghapus data.',
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
