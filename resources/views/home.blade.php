@extends('layouts.app')

@section('content')
    <!-- Main Post Section Start -->
    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="row g-4">
                <div class="col-lg-7 col-xl-8 mt-0">
                    <!-- Berita Utama dari News -->
                    @foreach ($latestNews->take(1) as $news)
                        <div class="position-relative overflow-hidden rounded">
                            <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                class="img-fluid rounded img-zoomin w-100" alt="" style="height: 475px" />
                            <div class="d-flex justify-content-center px-4 position-absolute flex-wrap"
                                style="bottom: 10px; left: 0">
                                <div class="text-white me-4"><i class="fa fa-clock"></i>
                                    {{ $news->created_at->translatedFormat('d F Y') }}</div>
                                <div class="text-white me-4"><i class="fa fa-eye"></i> {{ $news->views }}</div>
                                <div class="text-white me-4"><i class="fa fa-thumbs-up"></i> {{ $news->likes->count() }}
                                </div>
                            </div>
                        </div>
                        <div class="border-bottom py-3">
                            <a href="{{ route('news.show', $news->slug) }}"
                                class="display-4 text-dark mb-0 link-hover">{{ $news->title }}</a>
                        </div>
                        <p class="mt-3 mb-4">
                            {!! Str::limit($news->content, 450, '...') !!}
                        </p>
                    @endforeach

                    <!-- Top Views dari TitipTulisan -->
                    @if($popularTitip->isNotEmpty())
                        @foreach ($popularTitip->take(1) as $titip)
                            <div class="bg-light p-4 rounded">
                                <div class="news-2">
                                    <h3 class="mb-4">Top Views - Titip Tulisan</h3>
                                </div>
                                <div class="row g-4 align-items-center">
                                    <div class="col-md-6">
                                        <div class="rounded overflow-hidden">
                                            <img src="{{ $titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg') }}"
                                                class="img-fluid rounded img-zoomin w-100" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('titip-tulisan.show', $titip->slug) }}" class="h3">{{ $titip->judul }}</a>
                                            <p class="mb-0 fs-5 ms-1">
                                                <i class="fa fa-clock">
                                                    {{ $titip->created_at->translatedFormat('d F Y H:i') }}</i>
                                            </p>
                                            <p class="mb-0 fs-5 ms-1">
                                                <i class="fa fa-thumbs-up">
                                                    {{ $titip->likes->count() }} Likes</i>
                                            </p>
                                            <p class="mb-0 fs-5 ms-1 text-muted">
                                                <i class="fa fa-user"></i> Oleh: {{ $titip->nama_pengirim }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>

                <div class="col-lg-5 col-xl-4">
                    <div class="bg-light rounded p-4 pt-0">
                        <div class="row g-4">
                            <!-- Latest News Kedua -->
                            @if($latestNews->count() > 1)
                                @foreach ($latestNews->skip(1)->take(1) as $news)
                                    <div class="col-12">
                                        <div class="rounded overflow-hidden">
                                            <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                                class="img-fluid rounded img-zoomin w-100" alt="" />
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-flex flex-column">
                                            <a href="{{ route('news.show', $news->slug) }}"
                                                class="h4 mb-2">{{ $news->title }}</a>
                                            <p class="fs-5 mb-0">
                                                <i class="fa fa-clock">
                                                    {{ $news->created_at->translatedFormat('d F Y H:i') }}</i>
                                            </p>
                                            <p class="fs-5 mb-0">
                                                <i class="fa fa-eye"> {{ $news->views }}</i>
                                            </p>
                                            <p class="fs-5 mb-0">
                                                <i class="fa fa-thumbs-up">
                                                    {{ $news->likes->count() }}</i>
                                            </p>
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                            <!-- Latest Titip Tulisan -->
                            @if($latestTitip->isNotEmpty())
                                <div class="col-12">
                                    <h5 class="mb-3 border-bottom pb-2">Titip Tulisan Terbaru</h5>
                                    @foreach ($latestTitip->take(3) as $titip)
                                        <div class="row g-4 align-items-center mb-3">
                                            <div class="col-5">
                                                <div class="overflow-hidden rounded">
                                                    <img src="{{ $titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg') }}"
                                                        class="img-zoomin img-fluid rounded w-100" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="features-content d-flex flex-column">
                                                    <a href="{{ route('titip-tulisan.show', $titip->slug) }}"
                                                        class="h6">{{ $titip->judul }}</a>
                                                    <small><i class="fa fa-clock">
                                                            {{ $titip->created_at->translatedFormat('d F Y H:i') }} </i>
                                                    </small>
                                                    <small><i class="fa fa-thumbs-up"> {{ $titip->likes->count() }}</i></small>
                                                    <small class="text-muted">
                                                        <i class="fa fa-user"></i> {{ $titip->nama_pengirim }}
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            <!-- Latest News Lainnya -->
                            @if($latestNews->count() > 2)
                                @foreach ($latestNews->skip(2)->take(3) as $news)
                                    <div class="col-12">
                                        <div class="row g-4 align-items-center">
                                            <div class="col-5">
                                                <div class="overflow-hidden rounded">
                                                    <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                                        class="img-zoomin img-fluid rounded w-100" alt="" />
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="features-content d-flex flex-column">
                                                    <a href="{{ route('news.show', $news->slug) }}"
                                                        class="h6">{{ $news->title }}</a>
                                                    <small><i class="fa fa-clock">
                                                            {{ $news->created_at->translatedFormat('d F Y H:i') }} </i>
                                                    </small>
                                                    <small><i class="fa fa-eye"> {{ $news->views }}</i></small>
                                                    <small>
                                                        <i class="fa fa-thumbs-up">
                                                            {{ $news->likes->count() }}</i>
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Post Section End -->

    <!-- Latest News Start -->
    <div class="container-fluid latest-news py-5">
        <div class="container py-5">
            <h2 class="mb-4">Latest News</h2>
            <div class="latest-news-carousel owl-carousel">
                @foreach ($latestNews as $news)
                    <div class="latest-news-item">
                        <div class="bg-light rounded">
                            <div class="rounded-top overflow-hidden">
                                <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                    class="img-zoomin img-fluid rounded-top w-100" alt="" />
                            </div>
                            <div class="d-flex flex-column p-4">
                                <a href="{{ route('news.show', $news->slug) }}" class="h4">
                                    {{ Str::limit($news->title, 35, '...') }}</a>
                                <div class="d-flex justify-content-between">
                                    <small class="small text-body">{{ 'by ' . $news->author->name }}</small>
                                    <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                        {{ $news->created_at->translatedFormat('j F Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Latest News End -->

    <!-- Latest Titip Tulisan Start -->
    @if($latestTitip->isNotEmpty())
    <div class="container-fluid latest-news py-5">
        <div class="container py-5">
            <h2 class="mb-4">Latest Titip Tulisan</h2>
            <div class="latest-news-carousel owl-carousel">
                @foreach ($latestTitip as $titip)
                    <div class="latest-news-item">
                        <div class="bg-light rounded">
                            <div class="rounded-top overflow-hidden">
                                <img src="{{ $titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg') }}"
                                    class="img-zoomin img-fluid rounded-top w-100" alt="" />
                            </div>
                            <div class="d-flex flex-column p-4">
                                <a href="{{ route('titip-tulisan.show', $titip->slug) }}" class="h4">
                                    {{ Str::limit($titip->judul, 35, '...') }}</a>
                                <div class="d-flex justify-content-between">
                                    <small class="small text-muted">{{ 'by ' . $titip->nama_pengirim }}</small>
                                    <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i>
                                        {{ $titip->created_at->translatedFormat('j F Y') }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
    <!-- Latest Titip Tulisan End -->

    <!-- Most Popular News Start -->
    <div class="container-fluid populer-news py-5">
        <div class="container py-5">
            <div class="tab-class mb-4">
                <div class="row g-4">
                    <div class="col-lg-8 col-xl-9">
                        <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                            <h1 class="mb-4">Trending Category</h1>
                            <ul class="nav nav-pills d-inline-flex text-center">
                                @foreach ($topCategory->take(3) as $key => $categories)
                                    <li class="nav-item mb-3">
                                        <a class="d-flex py-2 bg-light rounded-pill me-2" data-bs-toggle="pill"
                                            href="#tab-{{ $key + 1 }}">
                                            <span class="text-dark" style="width: 100px">{{ $categories->name }}</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="tab-content mb-4">
                            @foreach ($topCategory->take(3) as $key => $categories)
                                <div id="tab-{{ $key + 1 }}"
                                    class="tab-pane fade show p-0 {{ $key === 0 ? 'active' : '' }}">
                                    <div class="row g-4">
                                        <!-- Berita Populer dari Kategori (News) -->
                                        @foreach ($categories->news()->where('status', 'Accept')->withCount('likes')->orderBy('likes_count', 'desc')->take(1)->get() as $news)
                                            <div class="col-lg-8">
                                                <div class="position-relative rounded overflow-hidden">
                                                    <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                                        class="img-zoomin img-fluid rounded w-100" alt="" />
                                                    <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                                                        style="top: 20px; right: 20px">
                                                        {{ $categories->name }}
                                                    </div>
                                                </div>
                                                <div class="my-4">
                                                    <a href="{{ route('news.show', $news->slug) }}"
                                                        class="h4">{{ $news->title }}</a>
                                                </div>
                                                <div class="d-flex">
                                                    <div class="text-dark me-4"><i class="fa fa-clock"></i>
                                                        {{ $news->created_at->translatedFormat('d F Y') }}</div>
                                                    <div class="text-dark me-4"><i class="fa fa-eye"></i>
                                                        {{ $news->views }}</div>
                                                    <div class="text-dark me-4"><i class="fa fa-thumbs-up"></i>
                                                        {{ $news->likes->count() }}
                                                    </div>
                                                </div>
                                                <p class="my-4">
                                                    {!! Str::limit($news->content, 450, '...') !!}
                                                </p>
                                            </div>
                                        @endforeach

                                        <div class="col-lg-4">
                                            <!-- Titip Tulisan dari Kategori yang Sama -->
                                            @foreach ($categories->titipTulisans()->where('status', 'Accept')->orderBy('created_at', 'desc')->take(3)->get() as $titip)
                                                <div class="row g-4">
                                                    <div class="col-12">
                                                        <div class="row g-4 align-items-center pb-4">
                                                            <div class="col-5">
                                                                <div class="overflow-hidden rounded">
                                                                    <img src="{{ $titip->image ? asset('storage/titip-tulisan/' . $titip->image) : asset('img/noimg.jpg') }}"
                                                                        class="img-zoomin img-fluid rounded w-100"
                                                                        alt="" />
                                                                </div>
                                                            </div>
                                                            <div class="col-7">
                                                                <div class="features-content d-flex flex-column">
                                                                    <p class="text-uppercase mb-2">{{ $categories->name }}
                                                                    </p>
                                                                    <a href="{{ route('titip-tulisan.show', $titip->slug) }}"
                                                                        class="h6">{{ $titip->judul }}</a>
                                                                    <small class="text-body d-block"><i
                                                                            class="fas fa-calendar-alt me-1"></i>
                                                                        {{ $titip->created_at->translatedFormat('j F Y') }}
                                                                    </small>
                                                                    <small class="text-muted d-block">
                                                                        <i class="fas fa-user me-1"></i>{{ $titip->nama_pengirim }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                            <!-- Berita Lainnya dari Kategori (News) -->
                                            @foreach ($categories->news()->where('status', 'Accept')->withCount('likes')->orderBy('likes_count', 'desc')->skip(1)->take(2)->get() as $news)
                                                <div class="row g-4">
                                                    <div class="col-12">
                                                        <div class="row g-4 align-items-center pb-4">
                                                            <div class="col-5">
                                                                <div class="overflow-hidden rounded">
                                                                    <img src="{{ $news->image ? asset('storage/images/' . $news->image) : asset('img/noimg.jpg') }}"
                                                                        class="img-zoomin img-fluid rounded w-100"
                                                                        alt="" />
                                                                </div>
                                                            </div>
                                                            <div class="col-7">
                                                                <div class="features-content d-flex flex-column">
                                                                    <p class="text-uppercase mb-2">{{ $categories->name }}
                                                                    </p>
                                                                    <a href="{{ route('news.show', $news->slug) }}"
                                                                        class="h6">{{ $news->title }}</a>
                                                                    <small class="text-body d-block"><i
                                                                            class="fas fa-calendar-alt me-1"></i>
                                                                        {{ $news->created_at->translatedFormat('j F Y') }}
                                                                    </small>
                                                                    <small class="text-body d-block"><i
                                                                            class="fas fa-eye me-1"></i>
                                                                        {{ $news->views }}
                                                                    </small>
                                                                    <small class="text-body d-block"><i
                                                                            class="fas fa-thumbs-up me-1"></i>
                                                                        {{ $news->likes->count() }}
                                                                    </small>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-lg-4 col-xl-3">
                        <div class="row g-4">
                            <div class="col-12">
                                <div class="p-3 rounded border">
                                    <!-- Popular Titip Tulisan -->
                                    @if($popularTitip->isNotEmpty())
                                    <h5 class="mb-3">Popular Titip Tulisan</h5>
                                    @foreach ($popularTitip->take(3) as $titip)
                                        <div class="mb-3">
                                            <a href="{{ route('titip-tulisan.show', $titip->slug) }}" class="h6 d-block">
                                                {{ Str::limit($titip->judul, 30, '...') }}
                                            </a>
                                            <small class="text-muted">
                                                <i class="fa fa-thumbs-up"></i> {{ $titip->likes->count() }} likes
                                                | Oleh: {{ $titip->nama_pengirim }}
                                            </small>
                                        </div>
                                    @endforeach
                                    <hr>
                                    @endif

                                    <!-- Popular News -->
                                    <h5 class="mb-3">Popular News</h5>
                                    @foreach ($popularNews->take(3) as $news)
                                        <div class="mb-3">
                                            <a href="{{ route('news.show', $news->slug) }}" class="h6 d-block">
                                                {{ Str::limit($news->title, 30, '...') }}
                                            </a>
                                            <small class="text-muted">
                                                <i class="fa fa-eye"></i> {{ $news->views }} views
                                                | Likes: {{ $news->likes->count() }}
                                            </small>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Most Popular News End -->
@endsection
