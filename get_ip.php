<?php

function get_ip(){
	
if (isset($_SERVER)) {
      if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
         $data_ip =  $_SERVER['HTTP_X_FORWARDED_FOR'];
      } else {
         $data_ip =  $_SERVER['REMOTE_ADDR'];
      }
   } else {
      if (isset($GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDER_FOR'])) {
         $data_ip =  $GLOBALS['HTTP_SERVER_VARS']['HTTP_X_FORWARDED_FOR'];
      } else {
         $data_ip =  $GLOBALS['HTTP_SERVER_VARS']['REMOTE_ADDR'];
      }
   }

$response = array(
	'data-ip' = >$data_ip
)
echo json_encode($response);

}

?>