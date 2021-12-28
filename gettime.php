<?php
	session_start();
	
	$name =$_COOKIE['name'];
	$id =$_COOKIE['id'];
	$paper =$_COOKIE['paper'];
	$conn=mysqli_connect('rm-2ze8d57a30h9j734tho.mysql.rds.aliyuncs.com','exam','hv2SuPc#kCL3K7M','exam','3306');
	
	$sql="select ztime from times where id='$id' and paper='$paper' ;";
	$result=mysqli_query($conn,$sql);
	$sstime=mysqli_fetch_array($result);
	
	$sql="select title,stime,etime,ztime from papers where paper='$paper';";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	$var_time=$row[3];
	date_default_timezone_set('PRC');
	
	$Nowtime = time();
	$title=$row[0];
	$starttimestr= $row[1];
	if(empty($sstime[0])){
		$endtimestr= $row[2];
		$endtime = strtotime($endtimestr);
	} else {
		$endtimestr= $sstime[0];
		$endtime  = strtotime($endtimestr);
		$endtime =$endtime+60*$var_time;
	}
	 
	 $starttime = strtotime($starttimestr);
	 setcookie('starttime', $starttime, time()+24*60*60);
	 setcookie('endtime', $endtime, time()+24*60*60);
	
	if ($Nowtime < $starttime) {
	echo "<script>alert('本场考试还未开始！本场考试时间是：{$starttimestr}至{$endtimestr}');location='login.html'</script>";
	exit("未开始");
	}
	if ($endtime >= $Nowtime) {
	$lefttime = $endtime - $Nowtime; //实际剩下的时间（秒）
	} else {
	$lefttime = 0;
	echo "<script>alert('本场考试已经结束！');location='login.html'</script>";
	exit("已结束");
	}
						 

echo time2string($lefttime);
function time2string($second){
	     $day = floor($second/(3600*24));
	     $second = $second%(3600*24);//除去整天之后剩余的时间
	     $hour = floor($second/3600);
	     $second = $second%3600;//除去整小时之后剩余的时间 
	     $minute = floor($second/60);
	     $second = $second%60;//除去整分钟之后剩余的时间 
	     //返回字符串
	     return $day.'天'.$hour.'小时'.$minute.'分'.$second.'秒';
	 }
?>