<?php

set_time_limit(600);

$icons = array(395,392,389,386,377,374,371,368,365,362,359,356,353,350,338,335,332,329,326,323,320,317,314,311,308,305,302,299,296,293,284,281,266,263,260,248,230,227,200,185,182,179,176,143,122,119,116,113);

$url = 'http://cdn.worldweatheronline.net/images/weather/large/{kod}_{type}_lg.png';

$return = array();

foreach ($icons as $k=>$iconCode) {
    
    $thisUrl = strtr($url,array('{kod}'=>$iconCode,'{type}'=>'day'));
    $return = file_get_contents($thisUrl);
    $fileName = $iconCode.'.png';
    $file = fopen('icons/'.$fileName,'w');
    fwrite($file,$return);
    fclose($file);

    $thisUrl = strtr($url,array('{kod}'=>$iconCode,'{type}'=>'night'));
    $return = file_get_contents($thisUrl);
    $fileName = $iconCode.'_n.png';
    $file = fopen('icons/'.$fileName,'w');
    fwrite($file,$return);
    fclose($file);

}


