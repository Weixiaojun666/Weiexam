var xmlHttp;

function createXMLHttpRequest(){
 if(window.ActiveXObject){
  xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
 }
 else if(window.XMLHttpRequest){
  xmlHttp = new XMLHttpRequest();
 }
 }
function start(){
 createXMLHttpRequest();
 var url="getTime.php";
 xmlHttp.open("GET",url,true);
 xmlHttp.onreadystatechange = callback;
 xmlHttp.send(null);
}
function callback(){
 if(xmlHttp.readyState == 4){
  if(xmlHttp.status == 200){
   document.getElementById("showtime").innerHTML = xmlHttp.responseText;
   if(xmlHttp.responseText=="未开始"){
	   alert('本场考试未开始');
	   location='login.html';
   }
   if(xmlHttp.responseText=="已结束"){
   	   alert('本场考试已结束');
   	   location='login.html';
   }
   setTimeout("start()",1000);
  }
 }
}
start();