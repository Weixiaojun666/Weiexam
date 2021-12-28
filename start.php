<!DOCTYPE html>
<html lang="zh-cn">
<script src="js/layui.js";></script>
<script src="js/wtime.js";></script>
<link rel="stylesheet" href="css/layui.css" ;>
<link rel="stylesheet" href="css/wei.css" ;>
<head>
    <meta charset="UTF-8">
    <title>21 应三 Java自律学习 在线考试系统</title>
	<form action="submit.php" method="post" name="submit" οnsubmit="return InputCheck()">
	<ul class="header_ul">
	<?php
	$id=$_COOKIE['id'];
	$name=$_COOKIE['name'];
	$paper=$_COOKIE['paper'];
	if (!isset($_COOKIE['name'])) {
		echo "<script>location='login.html'</script>";
		} 
	$conn=mysqli_connect();
	$sql="select topic from answer where Paper='0' and id ='$id';";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($result);

	if ($row==0){
		
		$sql="select title from papers where paper='$paper';";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result);
		$title=$row[0];
		$num=0;
		while(true){
			$num++;
			$sql="select text from topic where papers='$paper' and tid ='$num';";
			$result=mysqli_query($conn,$sql);
			$rows=mysqli_fetch_array($result);
			if(!isset($rows[0])){
				break;
			}
			echo '<li>';
			echo $num;
			echo '</li>';
			}
	} else {
			echo "<script>alert('您已经交过卷了，无法再次作答！');location='login.html'</script>";
	}
	$sql="select ztime from times where id='$id' and paper='$paper';";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_num_rows($result);
	if (empty($row)){
		$sql="INSERT into times values('$id','$paper',now());";
		if ($conn->query($sql) === TRUE) {
		} else {
		    echo "开考失败！Error: " . $sql . "<br>" . $conn->error;
		}
	} 
	$conn->close();
	?>
	</ul>

<p class="header_p"><?php echo $name ?>   剩余时间: <span id="showtime"></span_id></p>
<input type="submit" value="交卷" class="layui-btn" name="start">
	<h1><?php echo $title ?></h1>
</head>
<br>
<body>
	<div class="article_2_div">
<?php
	
	$num=0;
	while(true){
		$num++;
		$conn=mysqli_connect();
		$sql="select text from topic where papers='$paper' and tid ='$num';";
		$result=mysqli_query($conn,$sql);
		$rows=mysqli_fetch_array($result);
		if(!isset($rows[0])){
			break;
		}
		echo '<ul class="article_2_ul">';
		echo '<li class="article_2_li1"><span>';
		echo $num;
		echo '.</span>&nbsp;&nbsp;&nbsp;<span>';
		echo $rows[0];
		echo '</span></li>';
		echo '	<li class="article_2_li2">';
		echo '	<textarea type="textarea" class="text1 "';
		echo '  name="';
		echo $num;
		echo '" id=';
		echo $num;
		echo '"></textarea>	</li>';
		echo '	</ul>';
	}
		$name =$_COOKIE['name'];
		$id =$_COOKIE['id'];
		$paper =$_COOKIE['paper'];
		$endtime =$_COOKIE['endtime'];
		$starttime =$_COOKIE['starttime'];
		date_default_timezone_set('PRC');
	while(true){
			 $Nowtime = time();
			
			
			if ($Nowtime < $starttime) {
			echo "<script>alert('本场考试还未开始!');location='login.html'</script>";
			}
			if ($endtime >= $Nowtime) {
			$lefttime = $endtime - $Nowtime; //实际剩下的时间（秒）
			} else {
			$lefttime = 0;
			echo "<script>alert('本场考试已经结束！');location='index.php'</script>";
			}
			if($lefttime<300){
				echo "<script>alert('剩余答题时间五分钟！请尽快答题！');location='login.html'</script>";
			}
			sleep(3);
	}
	
	
	
	
	$conn->close();
?>
</div>
</form>
</body>
</html>