<?php
    function check_disc_day($menu) {
        $output = 1;
        if ($menu->discpersen > 0 AND $menu->discactive == 0 AND $menu->date_start <= date('Y-m-d') AND $menu->date_end >= date('Y-m-d')) {
            if (($menu->time_start == "00:00:00" AND $menu->time_stop ="00:00:00") OR ($menu->time_start <= date('H:i:s') AND $menu->time_stop >= date('H:i:s'))) { 
                $today = date('D'); 
                switch ($today) {
                    case "Sun" :
                        if ($menu->sun == 0) {
                            $output = 0;
                        }
                        break;
                    case "Mon" :
                        if ($menu->mon == 0) {
                            $output = 0;
                        }
                        break;
                    case "Tue" :
                        if ($menu->tue == 0) {
                            $output = 0;
                        }
                        break;
                    case "Wed" :
                        if ($menu->wed == 0) {
                            $output = 0;
                        }
                        break;
                    case "Thu" :
                        if ($menu->thu == 0) {
                            $output = 0;
                        }
                        break;
                    case "Fri" :
                        if ($menu->fri == 0) {
                            $output = 0;
                        }
                        break;
                     case "Sat" : 
                        if ($menu->sat == 0) {
                            $output = 0; 
                        }
                        break;
                } 
               
            }                                                   
        }
        return $output;
    }
?>