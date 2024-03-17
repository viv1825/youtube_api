@extends('layouts.app')

@section('content')

@section('header')
    <h4 class="check fw-bolder fs-3 mb-0 p-2">History</h4>
@endsection


<div class="container  mb-5">
    <div class="row ">
        <div class="col-lg-8 p-0 mx-auto">
            <div class="embed-responsive embed-responsive-16by9 col-lg-12">
                <iframe src="https://www.youtube.com/embed/{{ $historyVideos[0]['video_id'] }}"
                    class="embed-responsive-item" frameborder="0"
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                    allowfullscreen></iframe>
            </div>
            {{-- <a href="{{ route('watch', $historyVideos[0]['video_id']) }}">
                    <img src="{{ $historyVideos[0]['thumbnail_url'] }}" class="img w-100" alt="{{ $historyVideos[0]['title'] }}">
                </a> --}}
                <div class="col-lg-12 fs-3" style="background-color:aliceblue">
                    <p>{{ $historyVideos[0]['title'] }}</p>
                </div>
        </div>
        {{-- <div class="col-lg-4 p-0" style="background-color:#eef4f0">
                <p>{{ $historyVideos[0]['title'] }}</p>
            </div> --}}
    </div>

    <div class="row mt-4">
        @if (!empty($historyVideos))
            @foreach ($historyVideos as $index => $video)
                <div class="col-md-3 mt-4">
                    <a href="{{ route('watch', $video['video_id']) }}" style="text-decoration: none;color:black">
                        <div class="card cards mb-3"
                            style="height: 100%; transition: all 0.3s;background-color:#eef4f0">
                            <img src="{{ $video['thumbnail_url'] }}" class="img-fluid" alt="{{ $video['title'] }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title" style="max-height: 50px; overflow: hidden; margin-bottom: 2px; "
                                    title="{{ $video['title'] }}">{{ $video['title'] }}</h5>
                    </a>
                    <div class="mt-auto">
                        <div class="card-footer text-muted d-flex justify-content-between align-items-center"
                            style="background-color:#eaf2ed">
                            <span>Watched at {{ date('F j, Y h:i A', strtotime($video['created_at'])) }}</span>
                            <form id="deleteForm_{{ $video['id'] }}" action="{{ route('delete', $video['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <i class="fa-solid fa-trash text" data-video-id="{{ $video['id'] }}"
                                    style="cursor: pointer;padding: 5px; border-radius: 5px; background-color:bisque"
                                    onclick="confirmDelete('{{ $video['id'] }}')"></i>
                            </form>
                        </div>
                    </div>
                    
                </div>
    </div>

</div>
@endforeach
@else
<p>No videos found.</p>
@endif
</div>
</div>
@endsection


