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
   setTimeout("start()",1000);
  }
 }
}
start();