<?php
 require_once('bookmark_fns.php');
 
  $qid=$_GET['qid'];
  $username = $_GET['username'];
  put_mynice($qid,$username);
  
  $response='"�Ѿ�ϲ��"';
  
  echo $response;
  
?>