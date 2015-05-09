<?php
// include function files for this application
require_once('bookmark_fns.php');
session_start();

// start output html
do_html_header('Put my question.');

check_valid_user();

display_add_question_form();

do_html_footer();

?>
