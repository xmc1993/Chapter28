<?php

function db_connect() {
   $result = new mysqli('localhost', 'x_m_c', 'xmc1993', 'questionsdatabase');
   $result->set_charset("utf8");
   if (!$result) {
     throw new Exception('Could not connect to database server');
   } else {
     return $result;
   }
}

?>
