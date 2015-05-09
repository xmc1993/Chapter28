<?php

function do_html_header($title) {
  // print an HTML header
?>
  <html>
  <head>
    <title><?php echo $title;?></title>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<link href="css/style.css" rel="stylesheet" type="text/css" media="screen" />
	<script type="text/javascript" src="jquery-1.11.1.js"></script>
	</head>
	<body>
		<div id="logo">
			<h1><a href="#">布吉岛  </a></h1>
			<p><em> 谁 问 谁 知 道</em></p>
		</div>
	<hr />
	<!-- end #logo -->
	<div id="header">
		<div id="menu">
			<ul>
				<li><a href="home.php" class="first">主页</a></li>
				<li class="current_page_item"><a href="myquestion.php">我的问题</a></li>
				<li><a href="#">我的回答</a></li>
				<li><a href="myquestion.php">Me</a></li>
				<li><a href="add_question_form.php">发布问题</a></li>
				<li><a href="logout.php">退出</a></li>
			</ul>
		</div>
		<!-- end #menu -->
		<div id="search">
			<form method="get" action="#">
				<fieldset>
				<input type="text" name="s" id="search-text" size="15" />
				<input type="submit" id="search-submit" value="GO" />
				</fieldset>
			</form>
		</div>
		<!-- end #search -->
	</div>
<?php
  if($title) {
    do_html_heading($title);
  }
}

function do_html_footer() {
  // print an HTML footer
?>
	<div id="footer">
		<p>Copyright (c) 2008 布吉岛. All rights reserved. Design by xmc.</p>
	</div>
	</body>
	</html>
<?php
}

function do_html_heading($heading) {
  // print heading
?>
  <h2><?php echo $heading;?></h2>
<?php
}

function do_html_URL($url, $name) {
  // output URL as link and br
?>
  <br /><a href="<?php echo $url;?>"><?php echo $name;?></a><br />
<?php
}

function display_site_info() {
  // display some marketing info
?>
<?php
}

function display_login_form() {
?>
  <div id="body">
  <div id="login-form">
  <p><a href="register_form.php">Not a member?</a></p>
  <form method="post" action="member.php">
  <table bgcolor="#cccccc">
   <tr>
     <td colspan="2">Members log in here:</td>
   <tr>
     <td>Username:</td>
     <td><input type="text" name="username"/></td></tr>
   <tr>
     <td>Password:</td>
     <td><input type="password" name="passwd"/></td></tr>
   <tr>
     <td colspan="2" align="center">
     <input type="submit" value="Log in"/></td></tr>
   <tr>
     <td colspan="2"><a href="forgot_form.php">Forgot your password?</a></td>
   </tr>
 </table></form>
 </div>
 </div>
<?php
}

function display_registration_form() {
?>
<div id="body">
<div id="register-form">
 <form method="post" action="register_new.php">
 <table bgcolor="#cccccc">
   <tr>
     <td>Email address:</td>
     <td><input type="text" name="email" size="30" maxlength="100"/></td></tr>
   <tr>
     <td>Preferred username <br />(max 16 chars):</td>
     <td valign="top"><input type="text" name="username"
         size="16" maxlength="16"/></td></tr>
   <tr>
     <td>Password <br />(between 6 and 16 chars):</td>
     <td valign="top"><input type="password" name="passwd"
         size="16" maxlength="16"/></td></tr>
   <tr>
     <td>Confirm password:</td>
     <td><input type="password" name="passwd2" size="16" maxlength="16"/></td></tr>
   <tr>
     <td colspan=2 align="center">
     <input type="submit" value="Register"></td></tr>
 </table></form>
 </div>
 </div>
<?php

}

function display_user_urls($url_array) {
  // display the table of URLs

  // set global variable, so we can test later if this is on the page
  global $bm_table;
  $bm_table = true;
?>
  <br />
  <form name="bm_table" action="delete_bms.php" method="post">
  <table width="300" cellpadding="2" cellspacing="0">
  <?php
  $color = "#cccccc";
  echo "<tr bgcolor=\"".$color."\"><td><strong>Bookmark</strong></td>";
  echo "<td><strong>Delete?</strong></td></tr>";
  if ((is_array($url_array)) && (count($url_array) > 0)) {
    foreach ($url_array as $url)  {
      if ($color == "#cccccc") {
        $color = "#ffffff";
      } else {
        $color = "#cccccc";
      }
      //remember to call htmlspecialchars() when we are displaying user data
      echo "<tr bgcolor=\"".$color."\"><td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td>
            <td><input type=\"checkbox\" name=\"del_me[]\"
                value=\"".$url."\"/></td>
            </tr>";
    }
  } else {
    echo "<tr><td>No bookmarks on record</td></tr>";
  }
?>
  </table>
  </form>
<?php
}

function display_user_menu() {
  // display the menu options on this page
?>
<hr />
<a href="member.php">Home</a> &nbsp;|&nbsp;
<a href="add_bm_form.php">Add BM</a> &nbsp;|&nbsp;
<?php
  // only offer the delete option if bookmark table is on this page
  global $bm_table;
  if ($bm_table == true) {
    echo "<a href=\"#\" onClick=\"bm_table.submit();\">Delete BM</a> &nbsp;|&nbsp;";
  } else {
    echo "<span style=\"color: #cccccc\">Delete BM</span> &nbsp;|&nbsp;";
  }
?>
<a href="change_passwd_form.php">Change password</a>
<br />
<a href="recommend.php">Recommend URLs to me</a> &nbsp;|&nbsp;
<a href="logout.php">Logout</a>
<hr />

<?php
}

function display_add_bm_form() {
  // display the form for people to ener a new bookmark in
?>
<form name="bm_table" action="add_bms.php" method="post">
<table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
<tr><td>New BM:</td>
<td><input type="text" name="new_url" value="http://"
     size="30" maxlength="255"/></td></tr>
<tr><td colspan="2" align="center">
    <input type="submit" value="Add bookmark"/></td></tr>
</table>
</form>
<?php
}

function display_password_form() {
  // display html change password form
?>
   <br />
   <form action="change_passwd.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Old password:</td>
       <td><input type="password" name="old_passwd"
            size="16" maxlength="16"/></td>
   </tr>
   <tr><td>New password:</td>
       <td><input type="password" name="new_passwd"
            size="16" maxlength="16"/></td>
   </tr>
   <tr><td>Repeat new password:</td>
       <td><input type="password" name="new_passwd2"
            size="16" maxlength="16"/></td>
   </tr>
   <tr><td colspan="2" align="center">
       <input type="submit" value="Change password"/>
   </td></tr>
   </table>
   <br />
<?php
}

function display_forgot_form() {
  // display HTML form to reset and email password
?>
   <br />
   <form action="forgot_passwd.php" method="post">
   <table width="250" cellpadding="2" cellspacing="0" bgcolor="#cccccc">
   <tr><td>Enter your username</td>
       <td><input type="text" name="username" size="16" maxlength="16"/></td>
   </tr>
   <tr><td colspan=2 align="center">
       <input type="submit" value="Change password"/>
   </td></tr>
   </table>
   <br />
<?php
}

function display_recommended_urls($url_array) {
  // similar output to display_user_urls
  // instead of displaying the users bookmarks, display recomendation
?>
  <br />
  <table width="300" cellpadding="2" cellspacing="0">
<?php
  $color = "#cccccc";
  echo "<tr bgcolor=\"".$color."\">
        <td><strong>Recommendations</strong></td></tr>";
  if ((is_array($url_array)) && (count($url_array)>0)) {
    foreach ($url_array as $url) {
      if ($color == "#cccccc") {
        $color = "#ffffff";
      } else {
        $color = "#cccccc";
      }
      echo "<tr bgcolor=\"".$color."\">
            <td><a href=\"".$url."\">".htmlspecialchars($url)."</a></td></tr>";
    }
  } else {
    echo "<tr><td>No recommendations for you today.</td></tr>";
  }
?>
  </table>
<?php
}
function display_add_question_form(){
?>
	<div id="page">
		<div id="content">
		  <div class="post">
				<h2 class="title"><a href="#">发布问题</a></h2>
				<p class="meta">Sunday, April 26, 2009 7:27 AM </a></p>
				<form method="post" action="add_question.php">
					问题标题：
					<br/>
					<input type="text" name="qtitle">
					<br/>
					问题内容:
					<br/>
					<textarea name="qcontent"  cols ="50" rows = "6"></textarea>
					<br/>
					&nbsp
					<input type="checkbox" name="C++" />
					C++ &nbsp
					<input type="checkbox" name="PHP" />
					PHP &nbsp
					<input type="checkbox" name="JAVA" />
					JAVA &nbsp
					<br/>
					<hr/>
					<br/>
					<br/>
					<input type="submit" value="发布问题"/>
				</form>
		  </div>
		  </div>
<?php
	display_rightsider();
?>
	</div>

<?php
}

function display_myquestion_form(){
$result=get_myquestion();
$num_result=$result->num_rows;
	$ids=array();
	$new_result=array();
	for($i=0;$i<$num_result;$i++){    //将问题的标签全部拿出来
		$row=$result->fetch_assoc();
		$mid=$row['qid'];
		array_push($ids,$mid);
		array_push($new_result,$row);
	}
?>
	
	<div id="page">
	<div id="content">
<?php
    for($j=0;$j<$num_result;$j++){
		$tags=get_tag($ids[$j]);  //拿到所有的标签
		$mes="";
		foreach($tags as $tag){
			$mes.=($tag.'  ');
		}
?>
		<div class="post">
				<h2 class="title"><a href="question_home.php?qid=<?php echo $new_result[$j]['qid']?>"><?php echo $new_result[$j]['qtitle'] ?></a></h2>
				<p class="meta"><?php echo $new_result[$j]['qtime']; echo '  标签  '; echo $mes;?></p>
				<div class="entry">
					<p><?php echo $new_result[$j]['qcontent']; ?></P>
				</div>
		</div>
<?php
		}
?>
		</div>
<?php
	display_rightsider();
?>
	    </div>
<?php
}

function display_rightsider(){
?>
		<div id="sidebar">
			<ul>
				<li>
					<h2>个人主页</h2>
					<p>Mauris vitae nisl nec metus placerat perdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, volutpat.</p>
				</li>
				<li>
					<h2>问题分类</h2>
					<ul>
						<li><a href="classify_question.php?query=C++">C++</a></li>
						<li><a href="classify_question.php?query=JAVA">JAVA</a></li>
						<li><a href="classify_question.php?query=PHP">PHP</a></li>
						<li><a href="classify_question.php?query=others">其他...</a></li>
					</ul>
				</li>
				<li>
					<h2>热点问题</h2>
					<ul>
						<li><a href="#">Nec metus sed donec</a></li>
						<li><a href="#">Magna lacus bibendum mauris</a></li>
						<li><a href="#">Velit semper nisi molestie</a></li>
						<li><a href="#">Eget tempor eget nonummy</a></li>
						<li><a href="#">Nec metus sed donec</a></li>
					</ul>
				</li>
			</ul>
		</div>
		<div style="clear: both;">&nbsp;</div>
<?php
}
function display_classifyquestion($query){
	$result=get_classifyquestion($query);
	$num_result=count($result);
	$ids=array();
	foreach($result as $problem){
		$id=$problem['qid'];
		array_push($ids,$id);
	}
?>
	<div id="page">
	<div id="content">
<?php
    for($j=0;$j<$num_result;$j++){
		$tags=get_tag($ids[$j]);  //拿到所有的标签
		$mes="";
		foreach($tags as $tag){
			$mes.=($tag.'  ');
		}
?>
		<div class="post">
				<h2 class="title"><a href="question_home.php?qid=<?php echo $result[$j]['qid']?>"><?php echo $result[$j]['qtitle'] ?></a></h2>
				<p class="meta"><?php echo $result[$j]['qtime']; echo '  标签  '; echo $mes;?></p>
				<div class="entry">
				<p><?php echo $result[$j]['qcontent']; ?></P>
				</div>
		</div>
<?php
		}
?>
		</div>
<?php
	display_rightsider();
?>
	    </div>
<?php
}

?>




