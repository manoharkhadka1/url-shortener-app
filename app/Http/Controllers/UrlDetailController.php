<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UrlDetail;
use carbon\carbon;

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
            if(!empty($actualUrl) && $actualUrl['status'] == 1) {
                return redirect($actualUrl['url'],302);
            } else if($actualUrl['status'] == 2) {
                return response()->json('This url is already expired');
            }
        }

        return back();
    }

    public function getAllUrl()
    {
        $this->checkIfUrlExpired();
        $allUrl = UrlDetail::all();
        return response()->json($allUrl);
    }

    public function addExpirationTimeToUrl(Request $request)
    {
        $urlDetail = UrlDetail::find($request->id);
        $output['status'] = 0;
        if($urlDetail) {
            $output['status'] = 1;
            $output['message'] = 'Expiration time added successfully.';
            $urlDetail->expiration_time = convertToDatabaseDateTime($request->date,$request->time);
            $urlDetail->save();
        } else {
            $output['message'] = 'Something went wrong. Please try again.';
        }

        return response()->json($output);
    }

    public function destroy($id)
    {
        $urlDetail = UrlDetail::find($id);
        $output['status'] = 0;
        if ($urlDetail->delete()) {
            $output['status'] = 1;
            $output['message'] = 'Record deleted successfully';
        } else {
            $output['message'] = 'Something went wrong. Please try again.';
        }

        return response($output, 410);
    }

    public function checkIfUrlExpired()
    {
        $currentDateTime = date('Y-m-d H:i:s');
        $allUrl = UrlDetail::where('expiration_time','<',$currentDateTime)->get();

        if ($allUrl->count()) {
           foreach ($allUrl as $url) {
               $url->status = 2;
               $url->save();
           }
        }
    }
}
