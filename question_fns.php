<?php
require_once('db_fns.php');
//�������
function add_question($qtitle, $qcontent, $qtag){
	$valid_user=$_SESSION['valid_user'];
	
	$conn=db_connect();
	
	if(!$conn->query("insert into question values
	(null,'".$qtitle."','".$qcontent."',null,'".$valid_user."')")){
		throw new Exception('��������ʧ�ܡ�');
	}
	
	$result=$conn->query("select qid from question where qtitle='".$qtitle."' 
							and username='".$valid_user."'");
	$row=$result->fetch_row();
	$qid=$row[0];
	//��ӱ�ǩ
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
		throw new Exception('��ѯ���ݿ�ʧ��');
	}
	return $result;
	
}

function get_tag($id){
	$conn=db_connect();
	if(!$tagresult=$conn->query("select qtag from questiontag where qid='".$id."'")){
		throw new Exception("�������ݿ�ʧ�ܡ�");
	}
	$ids=array();
	foreach($tagresult as $tag){
		array_push($ids,$tag['qtag']);
	}
	return $ids;
}
/*
���ݱ�ǩ��ñ�ǩ��Ӧ������
*/
function get_classifyquestion($query){
	$conn=db_connect();
	$tagresult=get_classifyquestion_id($query,$conn);
	$classify_result=array();
	foreach($tagresult as $tag){   //ÿһ������id�������ľ�������.
		$id=$tag['qid'];
		if(!$questionresult=$conn->query("select * from question where qid='".$id."'")){
		throw new Exception("�������ݿ�ʧ�ܡ�");}
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
���������qid����������ϸ��Ϣ
*/

function get_question_by_id($qid){
	if(!$conn=db_connect()){
		throw new Exception("�������ݿ�ʧ�ܡ�");
	}
	if(!$result=$conn->query("select * from question where qid='".$qid."'")){
		throw new exception("�����ⲻ����");
	}
	$question=$result->fetch_assoc();
	return $question;
}

/*
���������qid�����������
*/
function get_comment_by_qid($qid){
	if(!$conn=db_connect()){
		throw new Exception("�������ݿ�ʧ�ܡ�");
	}
	$result=$conn->query("select * from questioncomment where qid='".$qid."'");
	
	return $result;
}
/*
���������qid����������޵Ĵ���
*/
function get_numofnice_by_qid($qid){
	if(!$conn=db_connect()){
		throw new Exception("�������ݿ�ʧ�ܡ�");
	}
	$result=$conn->query("select count(*) as total from questionnice where qid='".$qid."'");
	
	$row=$result->fetch_assoc();
	$num_nice=$row['total'];
	
	return $num_nice;
}
/*
��������
*/
function put_mycomment($qid,$comment,$username){
	if(!$conn=db_connect()){
		throw new Exception("�������ݿ�ʧ�ܡ�");
	}
	if(!$conn->query("insert into questioncomment values
	(null,'".$qid."','".$username."',null,'".$comment."')")){
	throw new Exception("�������ݿ�ʧ�ܡ�");
	}
}
/*�ж��Ƿ��Ѿ������*/
function is_already_nice($qid,$username){
	if(!$conn=db_connect()){
		throw new Exception("�������ݿ�ʧ�ܡ�");
	}
	$result=$conn->query("select * from questionnice where qid='".$qid."' and username='".$username."'");
	if($result->num_rows==0){
		return false;
	}
	return true;
}
/*���޹���*/
function put_mynice($qid,$username){
		if(!$conn=db_connect()){
		throw new Exception("�������ݿ�ʧ�ܡ�");
		}
	if(!$conn->query("insert into questionnice values
	('".$qid."','".$username."',null)")){
	throw new Exception("�������ݿ�ʧ�ܡ�");
	}
}
/*���ݻ������۵�cid��ø����۵ĺ������*/
function get_morecomment($cid){
		if(!$conn=db_connect()){
		throw new Exception("�������ݿ�ʧ�ܡ�");
		}
		$result=$conn->query("select * from morecomment where cid='".$cid."'");
		return $result;
}

/*��morecomment�������ݿ�*/
function put_mymorecomment($cid,$username_1,$username_2,$mcomment){
		if(!$conn=db_connect()){
		throw new Exception("�������ݿ�ʧ�ܡ�");
		}
	    if(!$conn->query("insert into morecomment values
	    ('".$cid."','".$username_1."','".$username_2."','".$mcomment."',null)")){
	    throw new Exception("�������ݿ�ʧ�ܡ�");
	    }
}

?>



