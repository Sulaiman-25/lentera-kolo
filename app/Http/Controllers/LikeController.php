<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\News;
use App\Models\TitipTulisan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    // Like / Unlike News
    public function likeNews(Request $request, News $news)
    {
        if (!$request->session()->has('device_id')) {
            $deviceId = Str::uuid()->toString();
            $request->session()->put('device_id', $deviceId);
        } else {
            $deviceId = $request->session()->get('device_id');
        }

        $like = Like::where('device_id', $deviceId)->where('news_id', $news->id)->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'device_id' => $deviceId,
                'news_id' => $news->id,
            ]);
        }

        return back();
    }

    // Like / Unlike TitipTulisan
    public function likeTitipTulisan(Request $request, TitipTulisan $titipTulisan)
    {
        if (!$request->session()->has('device_id')) {
            $deviceId = Str::uuid()->toString();
            $request->session()->put('device_id', $deviceId);
        } else {
            $deviceId = $request->session()->get('device_id');
        }

        $like = Like::where('device_id', $deviceId)
                    ->where('titip_tulisan_id', $titipTulisan->id)
                    ->first();

        if ($like) {
            $like->delete();
        } else {
            Like::create([
                'device_id' => $deviceId,
                'titip_tulisan_id' => $titipTulisan->id,
            ]);
        }

        return back();
    }
}
