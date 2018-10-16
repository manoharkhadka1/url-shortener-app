<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UrlDetail;

class UrlDetailController extends Controller
{
    /**
     * get short url
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function shortUrl(Request $request) {
        $this->validate($request,UrlDetail::rules());

        $urlDetail = new UrlDetail();
        $url = $request->actual_url;
        $output = $urlDetail->getShortUrl($url);

        return response()->json($output);
    }


    public function getActualUrl($code)
    {
        $actualUrl = UrlDetail::findUrlFromCode($code);
        if($actualUrl != false) {
            if(!empty($actualUrl)) {
                return redirect($actualUrl);
            }
        }

        return back();
    }

    public function getAllUrl()
    {
        $allUrl = UrlDetail::all();
        return response()->json($allUrl);
    }
}
