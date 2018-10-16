<?php 
use Carbon\Carbon;

function dateFormatWithTime($datetime) {
    return Carbon::createFromFormat('Y-m-d H:i:s',$datetime)->format('Y-m-d h:i A');
}


function convertToDatabaseDateTime($date = null,$time = null) {
    return Carbon::parse($date.' '.$time)->format('Y-m-d H:i:s');
}