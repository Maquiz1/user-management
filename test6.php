<?php

// $begin = new DateTime('2021-05-24');
// $end = new DateTime('2021-07-09');

$begin = 0;
$end = 728;

$day = 1;

if($day==1 or $day==2 or $day==3){
    // $interval = DateInterval::createFromDateString('1 day');
    $interval = 1;
}

// $period = new DatePeriod($begin, $interval, $end);
$period = array($begin, $interval, $end);

// foreach ($period as $dt) {
//     // echo $dt->format("l Y-m-d H:i:s\n").'<br>';
//     echo $dt.'<br>';
// }


foreach (range($begin, $end) as $val) {
    echo $val."\n<br />";
}

?>