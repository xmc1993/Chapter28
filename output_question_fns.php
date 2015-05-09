<?php
 require_once('bookmark_fns.php');

function display_questionhome($qid,$username){
	$question=get_question_by_id($qid);
	$qcomment=get_comment_by_qid($qid);
	$num_comment=$qcomment->num_rows;
	$comments=array();
	//获得每个评论的后继评论
	$morecomments=array();
	$mm_count=array();
	for($j=0;$j<$num_comment;$j++){
		$comment=$qcomment->fetch_assoc();
		array_push($comments,$comment);
		$cid=$comment['cid'];
		$morecomment=get_morecomment($cid);
		$num_mm=$morecomment->num_rows;
		$mm_array=array();
		for($k=0;$k<$num_mm;$k++){
			$mm_single=$morecomment->fetch_assoc();
			array_push($mm_array,$mm_single);
		}
		$count=count($mm_array);
		array_push($mm_count,$count);
		array_push($morecomments,$mm_array);
	}
	//获得已赞数
	$count_nice=get_numofnice_by_qid($qid);
	//获得所有的标签描述
	$tags=get_tag($question['qid']);
	$mes="";
	foreach($tags as $tag){
	$mes.=($tag.' ');
	}
	//获得与点赞相关的信息
	$already_nice=is_already_nice($qid,$username);
	$mes_nice='我喜欢';
	if($already_nice){
	$mes_nice='已经喜欢';
	}
?>
	<script>
	var count=1;
	function put_nice(boo,qid,username){
		if(boo){
			return;
		}
		if(count!=1){
			return;
		}
		count++;
		var xmlhttp=new XMLHttpRequest();
		xmlhttp.onreadystatechange=function()
		{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("my_nice").innerHTML="已经喜欢";
		}
		}
		xmlhttp.open("GET","put_nice.php?qid="+qid+"&username="+username,true);
		xmlhttp.send();
		}
	</script>

	<div id="page">
	 <div id="content">
		<div class="post">
				<h2 class="title"><a href="#"><?php echo $question['qtitle'] ?></a></h2>
				<p class="meta"><?php echo $question['qtime']; echo '  标签  '; echo $mes; echo $question['username']?></p>
				<div class="entry">
				<p><?php echo $question['qcontent']; ?></P>
				<p class="meta"><a href="#" onClick="put_nice('<?php echo $already_nice;?>','<?php echo $qid;?>','<?php echo $username;?>')" id="my_nice">
				<?php echo $mes_nice; ?></a></p>
				<p>评论：</p>
				<p>------------------------------------------------------------------------------------------------------------------------</p>
				<?php
					$ptr=0;
					for($i=0;$i<$num_comment;$i++){
				?>
				<p ><?php echo $comments[$i]['username'];  echo '        '; echo $comments[$i]['ctime']?></p>
				<p><?php echo $comments[$i]['qcomment'] ?></p>
				<p id='<?php echo $i; ?>' class="list">评论(<?php echo $mm_count[$i];?>)&nbsp&nbsp<a>回复</a></p>
				<div id="morecomment" class='<?php echo $i;?>'>
				<?php for($a=0;$a<$mm_count[$i];$a++){ ?>
				
				<p class="reply" id='<?php echo $a;?>'><span id="username1"><?php echo $morecomments[$i][$a]['username_2']; ?></span>
				回复<span id="username2"><?php echo $morecomments[$i][$a]['username_1'];?></span>:
				<?php echo $morecomments[$i][$a]['mcomment'];?>
				<a   id='<?php echo $i;?>' >回复</a>
				</p>
				
				<?php } ?>
				<div class="mm-input" >
				<form method='POST' onsubmit="return put_mm(this)" 
				action='put_mymorecomment.php?cid=<?php echo $comments[$i]['cid']?> ' >
				<input type="hidden"  value=<?php echo $question['username'];?> name="username1" id="un1">
				<input type="hidden" value='<?php echo $username; ?>' name="username2" id="un2">
				<textarea name="comment" cols="60" rows="2"></textarea>
				<br/>
				<input type='submit' value='提交评论'/>
				</form>
				</div>
				</div>
				<p>------------------------------------------------------------------------------------------------------------------------</p>
				<br/>
				<?php
				}
				?>
				<p>我的评论:</p>
				<head>
				<script>
				function myFunction(obj)
					{
						if(obj.comment.value==""){
						       alert("评论不能为空");
							   return false;
						}else{
								return true;
						}
					}
				</script>
				<form method='post' onsubmit="return myFunction(this)" 
				           action='put_comment.php?qid=<?php echo $qid;?>&username=<?php echo $question['username']?>' >
				<textarea name="comment"  cols ="60" rows = "4"></textarea>
				<br/>
				<input type='submit'   value='提交评论'/>
				</form>
				</div>
	    </div>
	 </div>
<?php
	display_rightsider();
?>
	</div>
	<script>
    $(document).ready(function(){
	$("p.list").click(function(e){
	var vid=$(e.target).attr('id');
					
	var ne="div."+vid;
	$(ne).show();
					
	});
	});
	</script>
	<script>
	$(document).ready(function(){
	$("p.reply a").click(function(e){
    var vid=$(e.target).attr('id');
	var ne="div."+vid+" "+".mm-input";
	var username1=$(e.target).prev().prev().text();
	var reply="回复："+username1;
	
	$(ne+" "+ "form"+" "+"#un1").val(username1);
	
	$(ne).show();
	$(ne+" "+"form"+" "+"textarea").focus();
	$(ne+" "+"form"+" "+"textarea").attr("placeholder", reply);
	});
	});
	</script>
	<script>
	$(document).ready(function(){
	$("p.list a").click(function(e){
    var vid=$(e.target).parent().attr('id');
	var path="div."+vid;
	$(path).show();
	var ne="div."+vid+" "+".mm-input";
	$(ne).show();
	$(ne+" "+"form"+" "+"textarea").focus();
	});
	});
	
	</script>
	<script>
	function put_mm(obj)
	{
	if(obj.comment.value==""){
					alert("评论不能为空");
					return false;
		}else{
					return true;
		}
	}
	</script>
<?php
}
//可以用doom节点节点获得！！
?>
