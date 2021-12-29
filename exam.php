<!DOCTYPE html>
<html lang="zh-cn">
<script src="js/layui.js";></script>
<script src="js/wtime.js";></script>
<link rel="stylesheet" href="css/layui.css" ;>
<head>
    <meta charset="UTF-8">
    <title>21 应三 Java自律学习 在线考试系统</title>
</head>
<body style="background: #1E9FFF">
	<?php
	if (isset($_COOKIE['name'])) {
	$name =$_COOKIE['name'];
	$id =$_COOKIE['id'];
	$paper =$_COOKIE['paper'];
	} else {
		echo "<script>location='login.html'</script>";
	}
	
	$conn=mysqli_connect('rm-2ze8d57a30h9j734tho.mysql.rds.aliyuncs.com','exam','hv2SuPc#kCL3K7M','exam','3306');
	$sql="select title,stime,etime,ztime from papers where paper='$paper';";
	$result=mysqli_query($conn,$sql);
	$row=mysqli_fetch_array($result);
	
	 $title=$row[0];
	 $starttimestr= $row[1];
	 $endtimestr= $row[2];
	 $var_time=$row[3];
	 $starttime = strtotime($starttimestr);
	 $endtime  = strtotime($endtimestr);
	 
	?>
<div style="position: absolute; left: 50%; top: 50%;width: 500px; margin-left:-250px; margin-top: -200px">
    <div style="background: #FFFFFF; padding: 20px;border-radius: 4px;box-shadow: 5px 5px 20px #444444" >
        <div class="layui-form">
            <form action="start.php" method="post" name="start" οnsubmit="return InputCheck()">
                <div class="layui-form-item" style="color: gray">
                    <h2> <?php echo $title; ?></h2>
                </div>
                <hr>
                <div class="layui-form-item">
                    <div class="layui-input-block";>
                        <input type="submit" value="开始考试" class="layui-btn" name="start">
						<a>考生:<?php echo $name; ?></a>
						<br>
						<a>考试时间:<?php echo $starttimestr; ?>到<?php echo $endtimestr;; ?></a>
						<br>
						<a>限制用时:<?php echo $var_time; ?>分钟</a>
						<p>
						 距离本次考试结束还有：
						 <span id="showtime"></span_id>
						</p>
						                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>