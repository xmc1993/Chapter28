<?php
 require_once('bookmark_fns.php');
  //create short variable name
  $comment= $_POST['comment'];
  $qid=$_GET['qid'];
  $username = $_GET['username'];
  
  put_mycomment($qid,$comment,$username);
  
  require_once('question_home.php');
  
?>