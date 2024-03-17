<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Models\UserWatchedVideo;

class ApiController extends Controller
{
    private $apiKey;
    private $youTubeEndPoint;
    private $defaultSearchParameters;

    public function __construct()
    {
        $this->apiKey = Config::get('youtube.api_key');
        $this->youTubeEndPoint = Config::get('youtube.search_endpoint');
        $this->defaultSearchParameters = Config::get('youtube.default_search_parameters');
    }

    public function index()
    {
        $watchedVideos = auth()->user()->watchedVideos;
        $historyVideo = $this->historyVideos();
        $historyVideos = array_values(array_slice($historyVideo, 0, 5));
        $mostWatchedVideos = $this->mostWatched();
        $mostWatched = array_values(array_slice($mostWatchedVideos, 0, 5));
        // dd($mostWatched);
        $allVideoTitles = $watchedVideos->pluck('video_title')->toArray();

        $mostFrequentKeyword = $this->extractKeyword($allVideoTitles);
        // dd($mostFrequentKeyword);
        $videoLists = $this->videoLists($mostFrequentKeyword);

        return view('index', compact('videoLists', 'historyVideos', 'mostWatched'));
    }


    public function results(Request $request)
    {
        $searchKeyword = $request->search_query;
        $videoLists = $this->videoLists($searchKeyword);
        return view('results', compact('videoLists', 'searchKeyword'));
    }

    public function watch($id, $searchKeyword = null)
    {
        $singleVideo = $this->singleVideo($id);
        $videoTitle = $singleVideo->items[0]->snippet->title;
        $videoId = $singleVideo->items[0]->id;
        $thumbnail = $singleVideo->items[0]->snippet->thumbnails->medium->url;
        $tag = implode(', ', $singleVideo->items[0]->snippet->tags ?? []);
        $tags = substr($tag, 0, 50); // Trim tags to fit within the column length

        $watched_video = UserWatchedVideo::create([
            'user_id' => auth()->id(),
            'video_title' => $videoTitle,
            'tags' => $tags,
            'video_id' => $videoId,
            'thumbnail_url' => $thumbnail,
        ]);

        $searchKeyword = $searchKeyword ?? 'laravel';
        $videoLists = $this->videoLists($searchKeyword);

        return view('watch', compact('singleVideo', 'videoLists', 'searchKeyword'));
    }

    public function history()
    {
        $historyVideo = $this->historyVideos();
        $limit = count($historyVideo);
        $historyVideos = array_values(array_slice($historyVideo, 0, $limit));
        // dd($historyVideos);
        return view('history', compact('historyVideos'));
    }

    public function mostliked()
    {
        $mostLikedVideos = $this->mostWatched();
        return view('most_watched',compact('mostLikedVideos'));
    }

    public function destroy($videoId)
    {
        // dd($videoId);
        $video = UserWatchedVideo::find($videoId);
        if ($video) {
            // Video exists, so delete it
            $video->delete();
            return Redirect::back()->with('success', 'Video deleted successfully.');
        } else {
            // Video not found, handle the error (e.g., redirect with an error message)
            return Redirect::back()->with('error', 'Video not found.');
        }
    }
    




    protected function mostWatched()
    {
        $userId = auth()->id();

        $mostWatchedVideoDetails = UserWatchedVideo::select('video_id', 'video_title', 'thumbnail_url')
            ->where('user_id', $userId) // Filter by the logged-in user's ID
            ->whereIn('video_id', function ($query) {
                $query->select('video_id')
                    ->from('user_watched_videos')
                    ->groupBy('video_id')
                    ->having(DB::raw('COUNT(*)'), '>', 1);
            })
            ->orderBy('video_id')
            ->orderByDesc('created_at')
            ->distinct('video_id')
            ->get();

        $formattedDetails = $mostWatchedVideoDetails->map(function ($entry) {
            return [
                'video_id' => $entry->video_id,
                'title' => $entry->video_title,
                'thumbnail_url' => $entry->thumbnail_url,
                'created_at' => $entry->created_at,
                // Add other properties as needed
            ];
        })->toArray();
        return $formattedDetails;
    }


    protected function historyVideos()
    {
        $user = auth()->user();
        $historyVideos = UserWatchedVideo::select('id','video_id', 'video_title', 'thumbnail_url', 'created_at')
            ->where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();
        // Filter out duplicate video IDs
        $uniqueVideos = [];
        foreach ($historyVideos as $video) {
            if (!isset($uniqueVideos[$video->video_id])) {
                $uniqueVideos[$video->video_id] = [
                    'id' =>  $video->id,
                    'video_id' => $video->video_id,
                    'title' => $video->video_title,
                    'created_at' => $video->created_at,
                    'thumbnail_url' => $video->thumbnail_url,
                ];
            }
        }
        // Limit to 5 unique videos
        // $historyVideos = array_values(array_slice($uniqueVideos, 0, 5));

        return $uniqueVideos;
    }


    protected function extractKeyword($allVideoTitles)
    {
        $stopWords = ['the', 'in', 'for', 'a', 'how', 'and', 'to', 'on', 'of', 'with','Seconds','is','till','that','an','it','are','using','from','this','will','they','but','only','have','each',]; 

        $allKeywords = [];
        foreach ($allVideoTitles as $title) {
            // Using regular expression to extract alphanumeric words
            preg_match_all('/\b(?![0-9]+\b)\w+\b/', $title, $titleKeywords);
            $filteredKeywords = array_diff($titleKeywords[0], $stopWords); // Remove stop words
            $allKeywords = array_merge($allKeywords, $filteredKeywords);
        }
        $keywordCounts = array_count_values($allKeywords);
        arsort($keywordCounts);
        $mostFrequentKeyword = key($keywordCounts);
        return $mostFrequentKeyword;
    }



    protected function videoLists($keywords)
    {
        $searchParameters = array_merge($this->defaultSearchParameters, ['q' => urlencode($keywords)]);

        $url = $this->buildYouTubeUrl($searchParameters);
        $response = Http::get($url);
        $results = json_decode($response->getBody());

        File::put(storage_path('app/public/results.json'), $response->getBody());
        return $results;
    }

    protected function singleVideo($id)
    {
        $part = 'snippet';
        $url = "https://www.googleapis.com/youtube/v3/videos?part={$part}&id={$id}&key={$this->apiKey}";
        $response = Http::get($url);
        $results = json_decode($response->getBody());

        File::put(storage_path('app/public/single.json'), $response->getBody());
        return $results;
    }

    private function buildYouTubeUrl($searchParameters)
    {
        $queryParams = http_build_query($searchParameters);
        return "https://{$this->youTubeEndPoint}?{$queryParams}&key={$this->apiKey}";
    }
}
