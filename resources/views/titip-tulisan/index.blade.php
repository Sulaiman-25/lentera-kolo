@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-center">Daftar Titip Tulisan</h2>

    @if ($tulisans->isEmpty())
        <p class="text-center">Belum ada tulisan yang diterbitkan.</p>
    @else
        <div class="row g-4">
            @foreach ($tulisans as $tulisan)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $tulisan->title }}</h5>
                            <p class="card-text text-muted small">
                                Diposting pada {{ $tulisan->created_at->format('d M Y') }}
                            </p>
                            <p class="text-secondary text-truncate" style="max-width: 240px;">
                                {!! strip_tags($tulisan->content) !!}
                            </p>
                            <a href="{{ route('tulisan.show', $tulisan->id) }}" class="btn btn-primary btn-sm">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center mt-4">
            {{ $tulisans->links() }}
        </div>
    @endif
</div>
@endsection
