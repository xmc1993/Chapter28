<?php

require_once('bookmark_fns.php');
session_start();

do_html_header('Home');
check_valid_user();
do_html_footer();


?>