<?php 

header('Content-type:text/html; charset=utf-8');


session_start();


if (isset($_COOKIE['name'])) {

echo "<script>location='exam.php'</script>";


} else {
	echo "<script>location='login.html'</script>";
}


 ?>