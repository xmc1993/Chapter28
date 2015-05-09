<?php
 require_once('bookmark_fns.php');
  //create short variable name
  $mcomment= $_POST['comment'];
  $username_1=$_POST['username1'];
  $username_2=$_POST['username2'];
  $cid=$_GET['cid'];
  
  put_mymorecomment($cid,$username_1,$username_2,$mcomment);
 // require_once('question_home.php');
  
  
?>