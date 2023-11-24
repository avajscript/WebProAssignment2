<?php
date_default_timezone_set('UTC');
// formats a date like so
// Fri, Nov 12:00 AM
function getDateElem($date) {
    $class = "";

    $date = date_format(date_create($date), "D, M d, g:i A");
    $curDate = date('Y/m/d H:i');

   $dateMil = strtotime($date);
   $curDateMil = strtotime($curDate);
   $timeDifHour = ($dateMil - $curDateMil) / 60 / 60;
    // date is upcoming

    if($timeDifHour > 0) {
        // check if task needs to be done within 24 hours
        if($timeDifHour < 24) {
            $class = 'date-today';
            // doesn't need to be done within 24 hours
        } else {
            $class = 'date-normal';
        }
    } else {
        $class = "date-passed";
    }
    return ["<div class = $class>
                <p>
                $date
                </p>
            </div>", $class];

}