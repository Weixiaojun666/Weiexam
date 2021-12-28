
<?php
session_start();
$conn=mysqli_connect();
 
$id=$_POST['userid'];
$name=$_POST['username'];
$password=$_POST['password'];

$sql="select paper from papers where password='$password';";
$result=mysqli_query($conn,$sql);
$row=mysqli_num_rows($result);
if(empty($row)){
	echo "<script>alert('试卷密码错误，请核对后输入');location='login.html'</script>";
	}
		$sql="select info from student where name='$name' and id ='$id';";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_num_rows($result);
if(empty($row)){
	echo "<script>alert('学号或姓名错误，请重新输入');location='login.html'</script>";
    }
    else{
		$sql="select paper from papers where password='$password';";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_array($result);
		$paper=$row[0];
		setcookie('paper', $paper, time()+24*60*60);
		setcookie('name', $name, time()+24*60*60);
		setcookie('id', $id, time()+24*60*60);
		$_SESSION['islogin'] = 1;
		$conn->close();
        echo "<script>location='exam.php'</script>";
    };
?>