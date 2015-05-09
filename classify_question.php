<?php

require_once('bookmark_fns.php');
session_start();

do_html_header('ClassifyProblem');
check_valid_user();

$query=$_GET['query'];

display_classifyquestion($query);

do_html_footer();


?>