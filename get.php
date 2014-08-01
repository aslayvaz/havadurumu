<?php

set_time_limit(720);

$iller = array('adana','adiyaman','afyonkarahisar','agri','aksaray','amasya','ankara','antalya','ardahan','artvin','aydin','balikesir','bartin','batman','bayburt','bilecik','bingol','bitlis','bolu','burdur','bursa','canakkale','cankiri','corum','denizli','diyarbakir','duzce','edirne','elazig','erzincan','erzurum','eskisehir','gaziantep','giresun','gumushane','hakkari','hatay','igdir','isparta','istanbul','izmir','kahramanmaras','karabuk','karaman','kars','kastamonu','kayseri','kibris','kilis','kirikkale','kirklareli','kirsehir','kocaeli','konya','kutahya','malatya','manisa','mardin','mersin','mugla','mus','nevsehir','nigde','ordu','osmaniye','rize','sakarya','samsun','sanliurfa','siirt','sinop','sirnak','sivas','tekirdag','tokat','trabzon','tunceli','usak','van','yalova','yozgat','zonguldak');

$url = 'http://api.worldweatheronline.com/free/v1/weather.ashx?q={SEHIRADI}%2Cturkey&format=json&num_of_days=5&lang=tr&key=f0febdbe13d2093060fc0bffa5a115285a9f12c0';

$return = array();

foreach ($iller as $k=>$sehiradi) {
    //echo "<h1>$sehiradi</h1>";
    
    $thisUrl = strtr($url,array('{SEHIRADI}'=>$sehiradi));
    //echo $thisUrl.'<br />';
    
    $json   = file_get_contents($thisUrl);
    $array  = json_decode($json,true);
    
    $val = $array['data']['current_condition'][0];
    $return[$sehiradi]['now'] = array(
        'temp'=>$val['temp_C'],
        'kod'=>$val['weatherCode'],
        'info'=>$val['lang_tr'][0]['value']
    );
    
    for ($i=0;$i<5;$i++) {
        $val = $array['data']['weather'][$i];
        $return[$sehiradi]['days'][$i] = array(
            'date'=>$val['date'],
            'tempmin'=>$val['tempMinC'],
            'tempmax'=>$val['tempMaxC'],
            'kod'=>$val['weatherCode'],
            'info'=>$val['lang_tr'][0]['value']
        );
    
    }
    
    //echo '<pre>',"\n",print_r($return),"\n",'</pre>';
    //exit;
    
    
    sleep(4);
}


$file = fopen('havadata.json','w');
fwrite($file,json_encode($return));
fclose($file);
