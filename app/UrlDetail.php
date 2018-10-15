<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UrlDetail extends Model
{
    protected $checkIfUrlExists = true;

    protected $fillable = ['actual_url','url_code','url_counter','expiration_time','status'];

    /**
     * to get short url
     * @param null $url
     * @return mixed
     */
    public function getShortUrl($url = null) {
        $output['message'] = '';
        $output['status'] = 0;

        if (empty($url) || is_null($url)) {
            $output['message'] = "No URL was supplied.";
            return $output;
        }

        if ($this->validateUrlFormat($url) == false) {
            $output['message'] = "URL does not have a valid format.";
            return $output;

        }


        if ($this->checkIfUrlExists) {
            if (!$this->verifyUrlExists($url)) {
                $output['message'] = "URL does not appear to exist.";
                return $output;

            }
        }

        $shortCode = $this->ifUrlExistInTable($url);
        if ($shortCode == false) {
            $shortCode = $this->createShortCode($url);
        }

        $output['message'] = 'success';
        $output['status'] = 1;
        $output['url'] = url($shortCode);

        return $output;
    }


    protected function validateUrlFormat($url) {

        return filter_var($url, FILTER_VALIDATE_URL,
            FILTER_FLAG_HOST_REQUIRED);
    }

    /**
     * to verify if url exists
     * @param $url
     * @return bool
     */
    public function verifyUrlExists($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_NOBODY, true);
        curl_setopt($ch,  CURLOPT_RETURNTRANSFER, true);
        curl_exec($ch);
        $response = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        return (!empty($response) && $response != 404);
    }

    /**
     * to find if url exists in table
     * @param $url
     * @return bool
     */
    public function ifUrlExistInTable($url) {
        $urlDetail = $this->where('actual_url',$url)->first();
        return ($urlDetail) ? $urlDetail->url_code:false;
    }

    /**
     * to create short code from for given url
     * @param $url
     * @return string
     */
    public function createShortCode($url) {
        $id = $this->saveUrl($url);
        $shortCode = $this->convertToShortCode($id);
        $this->toInsertCodeIntoTable($id, $shortCode);
        return $shortCode;
    }

    /**
     * to save url to url_details table
     * @param $url
     * @return mixed
     */
    protected function saveUrl($url) {
        $data = [];
        $data['actual_url'] = $url;
        $urlAdded = $this->create($data);

        return $urlAdded->id;
    }

    /**
     * to convert to short code according to id (i.e given url)
     * @param $id
     * @return string
     */
    protected function convertToShortCode($id) {
        if($id > 0) {
            $urlCode = base_convert($id,10,36);
        }

        return $urlCode;
    }

    protected function toInsertCodeIntoTable($id, $code) {
        $output['message'] = '';
        if ($id == null || $code == null) {
            $output['message'] = "Input parameter(s) invalid.";
        }

        $urlDetail = $this->find($id);
        $urlDetail->url_code = $code;
        $urlDetail->save();

        return true;
    }

}
