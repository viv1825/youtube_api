@extends('layouts.app')

@section('content')


@section('header')
    <h4 class="">Search result : {{ $searchKeyword }}</h4>
@endsection

@section('footer')
    <p class="text-center p-4">Showing total 40 results of {{ $searchKeyword }}.</p>
@endsection

<div class="container">
    <div class="row">
        @if ($videoLists && isset($videoLists->items))
            @foreach ($videoLists->items as $key => $item)
                <div class="col-md-3 mt-3">
                    <a href="{{ route('watch', ['videoId' => $item->id->videoId, 'searchKeyword' => $searchKeyword]) }}"
                        style="text-decoration: none">
                        <div class="card cards mb-4" style="height: 100%; transition: all 0.3s;background-color:#eaf2ed">
                            <img src="{{ $item->snippet->thumbnails->medium->url }}" class="img-fluid" alt="">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title" style="max-height: 50px; overflow: hidden; margin-bottom: 2px; "
                                    title="{{ $item->snippet->title }}">{{ $item->snippet->title }}</h5>
                                <div class="mt-auto">
                                    <div class="card-footer text-muted" style="background-color:#eaf2ed">
                                        Published at {{ date('F j, Y h:i A', strtotime($item->snippet->publishedAt)) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        @else
            <p>No videos found for this search.</p>
        @endif
    </div>
</div>
@endsection
