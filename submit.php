<?php
$id=$_COOKIE['id'];
$num=0;
$conn=mysqli_connect('rm-2ze8d57a30h9j734tho.mysql.rds.aliyuncs.com','exam','hv2SuPc#kCL3K7M','exam','3306');
if (!isset($_POST)) {
		echo "<script>alert('系统错误！');location='login.html'</script>";
} 
	$paper=$_COOKIE['paper'];
	while(true){
		$num++;

		$sql="select text from topic where papers='$paper' and tid ='$num';";
		$result=mysqli_query($conn,$sql);
		$rows=mysqli_fetch_array($result);
		if(!isset($rows[0])){
			break;
		}
		if (!empty($_POST[$num])) {
		$text=$_POST[$num];
		$sql="INSERT into answer values('$id','$text','$num','-1','$paper');";
		if ($conn->query($sql) === TRUE) {
		} else {
		    echo " 交卷错误！Error: " . $sql . "<br>" . $conn->error;
		}
		}
		echo "<script>alert('交卷成功！');location='login.html'</script>";
	}
?>