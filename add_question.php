<?php
 require_once('bookmark_fns.php');
 session_start();

  //create short variable name
  $qtitle = $_POST['qtitle'];
  $qcontent=$_POST['qcontent'];
  $qtag=array();

  do_html_header('Put my question');
  $count=0;
  if($_POST['C++']){
	$qtag[$count]="C++";
	$count++;
  }
  if($_POST['PHP']){
	$qtag[$count]='PHP';
	$count++;
  }
  if($_POST['JAVA']){
	$qtag[$count]='JAVA';
	$count++;
  }
  
  
  try {
    check_valid_user();
	
	if((!isset($qtitle))||(!isset($qcontent))||($qtitle=='')||($qcontent=='')){
		throw new Exception('请填写问题标题和内容。');
	}
	add_question($qtitle,$qcontent,$qtag);
	echo '问题已发布。';
	
/*	
    if (!filled_out($_POST)) {
      throw new Exception('Form not completely filled out.');
    }
    // check URL format
    if (strstr($new_url, 'http://') === false) {
       $new_url = 'http://'.$new_url;
    }

    // check URL is valid
    if (!(@fopen($new_url, 'r'))) {
      throw new Exception('Not a valid URL.');
    }

    // try to add bm
    add_bm($new_url);
    echo 'Bookmark added.';

    // get the bookmarks this user has saved
    if ($url_array = get_user_urls($_SESSION['valid_user'])) {
      display_user_urls($url_array);
    }
*/
  }
  catch (Exception $e) {
    echo $e->getMessage();
  }
  
  //display_user_menu();
  do_html_footer();
?>
