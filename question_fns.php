<?php
require_once('db_fns.php');
//添加问题
function add_question($qtitle, $qcontent, $qtag){
	$valid_user=$_SESSION['valid_user'];
	
	$conn=db_connect();
	
	if(!$conn->query("insert into question values
	(null,'".$qtitle."','".$qcontent."',null,'".$valid_user."')")){
		throw new Exception('发布问题失败。');
	}
	
	$result=$conn->query("select qid from question where qtitle='".$qtitle."' 
							and username='".$valid_user."'");
	$row=$result->fetch_row();
	$qid=$row[0];
	//添加标签
	foreach($qtag as $tag){
		$conn->query("insert into questiontag values
	('".$qid."','".$tag."')");
	}	
	return true;
	}
	
function get_myquestion(){
	$valid_user=$_SESSION['valid_user'];
	$conn=db_connect();
	if(!$result=$conn->query("select * from question where username='".$valid_user."'")){
		throw new Exception('查询数据库失败');
	}
	return $result;
	
}

function get_tag($id){
	$conn=db_connect();
	if(!$tagresult=$conn->query("select qtag from questiontag where qid='".$id."'")){
		throw new Exception("访问数据库失败。");
	}
	$ids=array();
	foreach($tagresult as $tag){
		array_push($ids,$tag['qtag']);
	}
	return $ids;
}
/*
根据标签获得标签对应的问题
*/
function get_classifyquestion($query){
	$conn=db_connect();
	$tagresult=get_classifyquestion_id($query,$conn);
	$classify_result=array();
	foreach($tagresult as $tag){   //每一个问题id获得问题的具体内容.
		$id=$tag['qid'];
		if(!$questionresult=$conn->query("select * from question where qid='".$id."'")){
		throw new Exception("访问数据库失败。");}
		$row=$questionresult->fetch_assoc();
		array_push($classify_result,$row);
	}
	return $classify_result;
}

function get_classifyquestion_id($query,&$conn){
	$tagresult=$conn->query("select qid from questiontag where qtag='".$query."'");
	return $tagresult;
}
/*
根据问题的qid获得问题的详细信息
*/

function get_question_by_id($qid){
	if(!$conn=db_connect()){
		throw new Exception("访问数据库失败。");
	}
	if(!$result=$conn->query("select * from question where qid='".$qid."'")){
		throw new exception("该问题不存在");
	}
	$question=$result->fetch_assoc();
	return $question;
}

/*
根据问题的qid获得它的评论
*/
function get_comment_by_qid($qid){
	if(!$conn=db_connect()){
		throw new Exception("访问数据库失败。");
	}
	$result=$conn->query("select * from questioncomment where qid='".$qid."'");
	
	return $result;
}
/*
根据问题的qid获得它被点赞的次数
*/
function get_numofnice_by_qid($qid){
	if(!$conn=db_connect()){
		throw new Exception("访问数据库失败。");
	}
	$result=$conn->query("select count(*) as total from questionnice where qid='".$qid."'");
	
	$row=$result->fetch_assoc();
	$num_nice=$row['total'];
	
	return $num_nice;
}
/*
发布评论
*/
function put_mycomment($qid,$comment,$username){
	if(!$conn=db_connect()){
		throw new Exception("访问数据库失败。");
	}
	if(!$conn->query("insert into questioncomment values
	(null,'".$qid."','".$username."',null,'".$comment."')")){
	throw new Exception("访问数据库失败。");
	}
}
/*判读是否已经点过赞*/
function is_already_nice($qid,$username){
	if(!$conn=db_connect()){
		throw new Exception("访问数据库失败。");
	}
	$result=$conn->query("select * from questionnice where qid='".$qid."' and username='".$username."'");
	if($result->num_rows==0){
		return false;
	}
	return true;
}
/*点赞功能*/
function put_mynice($qid,$username){
		if(!$conn=db_connect()){
		throw new Exception("访问数据库失败。");
		}
	if(!$conn->query("insert into questionnice values
	('".$qid."','".$username."',null)")){
	throw new Exception("访问数据库失败。");
	}
}
/*根据基本评论的cid获得该评论的后继评论*/
function get_morecomment($cid){
		if(!$conn=db_connect()){
		throw new Exception("访问数据库失败。");
		}
		$result=$conn->query("select * from morecomment where cid='".$cid."'");
		return $result;
}

/*将morecomment存入数据库*/
function put_mymorecomment($cid,$username_1,$username_2,$mcomment){
		if(!$conn=db_connect()){
		throw new Exception("访问数据库失败。");
		}
	    if(!$conn->query("insert into morecomment values
	    ('".$cid."','".$username_1."','".$username_2."','".$mcomment."',null)")){
	    throw new Exception("访问数据库失败。");
	    }
}

?>



