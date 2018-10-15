<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UrlDetail;

class UrlDetailController extends Controller
{
    public function shortUrl(Request $request) {
        $urlDetail = new UrlDetail();
        $url = 'https://www.youtube.com/watch?v=6BKak_TALOw&list=PLfdtiltiRHWEhJJgooJ8y_Bbiv2Zb7X6n&index=4';
        $test = $urlDetail->urlToShortCode($url);
        dd($test);
    }
}
