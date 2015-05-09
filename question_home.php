<?php

require_once('bookmark_fns.php');
session_start();

do_html_header('Home');
check_valid_user();
$qid=$_GET['qid'];
$username=$_SESSION['valid_user'];

display_questionhome($qid,$username);

do_html_footer();

?>