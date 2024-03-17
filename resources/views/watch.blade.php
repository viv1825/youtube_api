@extends('layouts.app')

@section('content')


@section('header')
    <h4 class="text-center">{{ $searchKeyword }}</h4>
@endsection

@section('footer')
    <p class="text-center">content for {{ $searchKeyword }}.</p>
@endsection

<div class="container pt-4">
    <div class="row">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="embed-responsive embed-responsive-16by9">
                    <div class="embed-responsive embed-responsive-16by9 col-lg-12">
                        <iframe src="https://www.youtube.com/embed/{{ $singleVideo->items[0]->id }}"
                            class="embed-responsive-item" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen></iframe>
                    </div>
                </div>
                <div class="card-body" style="background-color:#eaf2ed">
                    <h5>{{ $singleVideo->items[0]->snippet->title }}</h5>
                    <p class="text-secondary">Published
                        at {{ date('d M Y', strtotime($singleVideo->items[0]->snippet->publishedAt)) }}</p>
                    <p>{!! nl2br(e($singleVideo->items[0]->snippet->description)) !!}</p>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="container">
                <div class="row">
                    @foreach (array_slice($videoLists->items, 0, 8) as $key => $item)
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('watch', $item->id->videoId) }}" style="text-decoration:none">
                                <div class="card side-card"
                                    style="height: 100%; transition: all 0.3s; background-color:#eaf2ed">
                                    <img src="{{ $item->snippet->thumbnails->medium->url }}" class="card-img-top"
                                        alt="">
                                    <div class="card-body">
                                        <h6 class="card-title">
                                            {{ \Illuminate\Support\Str::limit($item->snippet->title, $limit = 50, $end = ' ...') }}
                                        </h6>
                                    </div>
                                    <div class="card-footer text-muted" style="background-color:#eaf2ed">
                                        Published at {{ date('d M Y', strtotime($item->snippet->publishTime)) }}
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
