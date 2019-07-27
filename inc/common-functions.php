<?php
	function getDays($year, $month){
                   $start = new DateTime("{$year}-{$month}-01");
                   $month = $start->format('F');
                   $temp=array();
                    while($start->format('F') == $month){
                      // Add to array
                      $day              = $start->format('l');
                      $date             = $start->format('j');
                      array_push($temp,array("day"=>$day,"date"=>$date));
                      $start->add(new DateInterval("P1D"));
                   }
                   return json_encode($temp);
                }
?>