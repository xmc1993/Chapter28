<?php

require_once('bookmark_fns.php');
session_start();

do_html_header('Myquestion');
check_valid_user();

display_myquestion_form();

do_html_footer();


?>