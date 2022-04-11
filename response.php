<?php
session_start();
$from_time1 = date('Y-m-d H:i:s');
$to_time1 = $_SESSION["end_time"];
$timefirst = strtotime($from_time1);
$timesecond = strtotime($to_time1);
$differenceinseconds = $timesecond - $timefirst;
if($differenceinseconds < 0){
  // unset($_SESSION["start_time"]);
  // unset($_SESSION["end_time"]);
  // unset($_SESSION['duration']);
  echo $differenceinseconds=-1;
}else{
    echo gmdate("H:i:s",$differenceinseconds);
}
?>