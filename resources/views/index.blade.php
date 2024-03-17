@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mb-0">
            {{-- 1st left card carousel --}}
            <div class="col-md-6 mt-4">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($historyVideos as $index => $video)
                            <button type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <p class="text-center fw-bolder  fs-3">History</p>
                    <div class="carousel-inner rounded-3">
                        @if ($historyVideos && isset($video))
                            @foreach ($historyVideos as $index => $video)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <a href="{{ route('watch', $video['video_id']) }}">
                                        <img src="{{ $video['thumbnail_url'] }}" alt="{{ $video['title'] }}"
                                            class="img-fluid" style="width:100vw">
                                        <div class="carousel-caption d-none d-md-block">
                                            {{-- <h5>{{ $video['title'] }}</h5> --}}
                                            {{-- <p>{{ $video['description'] }}</p> --}}
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <p>no videos found</p>
                        @endif
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            <div class="col-md-6 mt-4">
                <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        @foreach ($mostWatched as $index => $video)
                            <button type="button" data-bs-target="#carouselExampleCaptions"
                                data-bs-slide-to="{{ $index }}" class="{{ $index === 0 ? 'active' : '' }}"
                                aria-label="Slide {{ $index + 1 }}"></button>
                        @endforeach
                    </div>
                    <p class="text-center fw-bolder fs-3">Most watched</p>
                    <div class="carousel-inner rounded-3">
                        @foreach ($mostWatched as $index => $video)
                            <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                {{-- Use the w-100 class to make the image responsive --}}
                                <a href="{{ route('watch', $video['video_id']) }}">
                                    <img src="{{ $video['thumbnail_url'] }}" alt="{{ $video['title'] }}" class="img-fluid"
                                        style="width:100vw">
                                    <div class="carousel-caption d-none d-md-block">
                                        {{-- <h5>{{ $video['title'] }}</h5> --}}
                                        {{-- <p>{{ $video['description'] }}</p> --}}
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>

            {{-- main row video conainer --}}
            <div class="row p-5 ml-5 mr-5">
                <p class="check text-center fw-bolder fs-3 mb-0">Recomended</p>
                @if ($videoLists && isset($videoLists->items))
                    @foreach ($videoLists->items as $key => $item)
                        <div class="col-md-3 mt-4">
                            {{-- sdfpihsdushfwrfeufhvfer --}}
                            <a href="{{ route('watch', $item->id->videoId) }}" style="text-decoration: none">
                                <div class="card cards mb-3"
                                    style="height: 100%; transition: all 0.3s;background-color:#eef4f0">
                                    <img src="{{ $item->snippet->thumbnails->medium->url }}" class="img-fluid"
                                        alt="">
                                    <div class="card-body d-flex flex-column">
                                        <h5 class="card-title"
                                            style="max-height: 50px; overflow: hidden; margin-bottom: 2px; "
                                            title="{{ $item->snippet->title }}">{{ $item->snippet->title }}</h5>
                                        <div class="mt-auto">
                                            <div class="card-footer text-muted" style="background-color:#eaf2ed">
                                                Published at
                                                {{ date('F j, Y h:i A', strtotime($item->snippet->publishedAt)) }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>No videos found.</p>
                @endif
            </div>
        </div>
    @endsection
