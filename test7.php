<?php
if (isset($_POST['submit'])) {
    //get Date diff as intervals
    $d1 = new DateTime("2018-01-10 00:00:00");
    $d2 = new DateTime("2019-05-18 01:23:45");
    $interval = $d1->diff($d2);
    $diffInSeconds = $interval->s; //45
    $diffInMinutes = $interval->i; //23
    $diffInHours   = $interval->h; //8
    $diffInDays    = $interval->d; //21
    $diffInMonths  = $interval->m; //4
    $diffInYears   = $interval->y; //1

//or get Date difference as total difference
    $d1 = strtotime("2018-01-10 00:00:00");
    $d2 = strtotime("2019-05-18 01:23:45");
    $totalSecondsDiff = abs($d1-$d2); //42600225
    $totalMinutesDiff = $totalSecondsDiff/60; //710003.75
    $totalHoursDiff   = $totalSecondsDiff/60/60;//11833.39
    $totalDaysDiff    = $totalSecondsDiff/60/60/24; //493.05
    $totalMonthsDiff  = $totalSecondsDiff/60/60/24/30; //16.43
    $totalYearsDiff   = $totalSecondsDiff/60/60/24/365; //1.35

    $begin = $_POST['start'];  
    $added = strtotime($begin . '+728 day');
    $end = date('Y-m-d', $added);



    $new_begin = new DateTime($begin);
    $new_end = new DateTime($end);

    
    
    $interval = DateInterval::createFromDateString('1 day');    
    $period = new DatePeriod($new_begin, $interval, $new_end);

    //Range of days
    $begin_days = strtotime($begin);

    $end_days = strtotime($end); // or your date as well

    $datediff = $end_days - $begin_days;

    $datediff = round($datediff / (60 * 60 * 24));

    $next_date1 = date('Y-m-d', strtotime($begin. ' +1 day'));
    $next_date2 = date('Y-m-d', strtotime($begin. ' +2 day'));
    $next_date3 = date('Y-m-d', strtotime($begin. ' +3 day'));
    $next_date4 = date('Y-m-d', strtotime($begin. ' +4 day'));
    $next_date5 = date('Y-m-d', strtotime($begin. ' +5 day'));
    $next_date6 = date('Y-m-d', strtotime($begin. ' +6 day'));
    $next_date7 = date('Y-m-d', strtotime($begin. ' +7 day'));
    $next_date14 = date('Y-m-d', strtotime($begin. ' +14 day'));

    $next_date28 = date('Y-m-d', strtotime($begin. ' +28 day'));
    $next_date29 = date('Y-m-d', strtotime($begin. ' +29 day'));
    $next_date30 = date('Y-m-d', strtotime($begin. ' +30 day'));
    $next_date31 = date('Y-m-d', strtotime($begin. ' +31 day'));
    $next_date32 = date('Y-m-d', strtotime($begin. ' +32 day'));
    $next_date33 = date('Y-m-d', strtotime($begin. ' 33 day'));
    $next_date34 = date('Y-m-d', strtotime($begin. ' +34 day'));
    $next_date35 = date('Y-m-d', strtotime($begin. ' +35 day'));
    $next_date42 = date('Y-m-d', strtotime($begin. ' +42 day'));
    

    $next_date56 = date('Y-m-d', strtotime($begin. ' +56 day'));
    $next_date57 = date('Y-m-d', strtotime($begin. ' +57 day'));
    $next_date58 = date('Y-m-d', strtotime($begin. ' +58 day'));
    $next_date59 = date('Y-m-d', strtotime($begin. ' +59 day'));
    $next_date60 = date('Y-m-d', strtotime($begin. ' +60 day'));
    $next_date61 = date('Y-m-d', strtotime($begin. ' +61 day'));
    $next_date62 = date('Y-m-d', strtotime($begin. ' +62 day'));
    $next_date63 = date('Y-m-d', strtotime($begin. ' +63 day'));
    $next_date70 = date('Y-m-d', strtotime($begin. ' +70 day'));
    $next_date84 = date('Y-m-d', strtotime($begin. ' +84 day'));
    $next_date140 = date('Y-m-d', strtotime($begin. ' +140 day'));
    $next_date240 = date('Y-m-d', strtotime($begin. ' +240 day'));
    $next_date392 = date('Y-m-d', strtotime($begin. ' +392 day'));
    $next_date728 = date('Y-m-d', strtotime($begin. ' +728 day'));
  


    // switch ($datediff) {
    // case $datediff == 1:
    //     $next_date = date('Y-m-d', strtotime($start. ' +1 day'));
    //   break;
    // case $datediff == 7:
    //     $next_date = date('Y-m-d', strtotime($start. ' +7 day'));
    //   break;
    // case $datediff == 14:
    //     $next_date = date('Y-m-d', strtotime($start. ' +14 day'));
    //   break;

    // default:
    // $next_date = date('Y-m-d', strtotime($start. ' +14 day'));
    
    // }

    // foreach (range($v1, $current) as $val) {
    //     echo $val."\n<br />";
    // }


    echo '<table>
    <tr>
          <th>Visit Code</ht>
          <th>Date</ht>
    </tr>';    
    foreach ($period as $dt) {
        if($next_date1){
            $visit_code = 'V1 + 1';
        }elseif ($next_date2) {
            $visit_code = 'V1 + 2';
        }elseif ($next_date3) {
            $visit_code = 'V1 + 3';
        }elseif ($next_date4) {
            $visit_code = 'V1 + 4';
        }elseif ($next_date5) {
            $visit_code = 'V1 + 5';
        }elseif ($next_date6) {
            $visit_code = 'V1 + 6';
        }elseif ($next_date7) {
            $visit_code = 'V1 + 7';
        }elseif ($next_date14) {
            $visit_code = 'V1 + 14';
        }elseif ($next_date28) {
            $visit_code = 'V1 + 28';
        }elseif ($next_date29) {
            $visit_code = 'V2 + 1';
        }elseif ($next_date30) {
            $visit_code = 'V2 + 2';
        }elseif ($next_date31) {
            $visit_code = 'V2 + 3';
        }elseif ($next_date32) {
            $visit_code = 'V2 + 4';
        }elseif ($next_date33) {
            $visit_code = 'V2 + 5';
        }elseif ($next_date34) {
            $visit_code = 'V2 + 6';
        }elseif ($next_date35) {
            $visit_code = 'V2 + 7';
        }elseif ($next_date42) {
            $visit_code = 'V2 + 14';
        }elseif ($next_date56) {
            $visit_code = 'V2 + 1';
        }elseif ($next_date57) {
            $visit_code = 'V3 + 2';
        }elseif ($next_date58) {
            $visit_code = 'V3 + 3';
        }elseif ($next_date59) {
            $visit_code = 'V3 + 4';
        }elseif ($next_date60) {
            $visit_code = 'V3 + 5';
        }elseif ($next_date61) {
            $visit_code = 'V3 + 6';
        }elseif ($next_date62) {
            $visit_code = 'V3 + 7';
        }elseif ($next_date63) {
            $visit_code = 'V3 + 14';
        }elseif ($next_date70) {
            $visit_code = 'V3 + 28';
        }elseif ($next_date84) {
            $visit_code = 'V3 + 84';
        }elseif ($next_date140) {
            $visit_code = 'V3 + 140';
        }elseif ($next_date240) {
            $visit_code = 'V3 + 240';
        }elseif ($next_date392) {
            $visit_code = 'V3 + 392';
        }elseif ($next_date728) {
            $visit_code = 'V3 + 728';
        }else{
            $visit_code = 'Unscheduled';
        }
       echo $output = 
                  '<tr>'.
                    '<td>'.$dt->format("l Y-m-d H:i:s\n").'<br>'.'</td>'.
                    '<td>'.$visit_code.'<br>'.'</td>'.
                 ' </tr>';
    }

    echo '</table>';

}


?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>test</title>
</head>

<body>
    <form action="test7.php" method="post">
        <div>
        <input type="date" name="start">
        </div>
        <div>
            <input type="submit" name="submit" value="submit">
        </div>
    </form>

</body>

</html>