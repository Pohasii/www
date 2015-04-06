<div class="wrap">
<?php 

$messegError=$result2;
messegErrors($messegError);
if(isset($result['passErrorSingIn'])) echo $result['passErrorSingIn'];
if(isset($result['errorlogin'])) echo $result['errorlogin'];
if(isset($result['errorpass'])) echo $result['errorpass'];
if(isset($result['erroremail'])) echo $result['erroremail'];
if(isset($result['notidenticalemail'])) echo $result['notidenticalemail'];
if(isset($result['ok'])) echo $result['ok'];
echo 'Main page';
echo $result['text'];

$border="0";        //// - чтобы убрать рамку помен¤йте значение 1 на 0
$colortime="White";  //// - цвет времени
$colornick="red";   //// - цвет ника
$bgcolor="Black";   //// - цвет фона
$colormsg = "green";  //// - цвет сообщений чата
$width="178";       //// - ширина окна чата
$height="282";      //// - длина окна чата
$num="3"; 	    //// -  ол-во сообщений после которого произойдет полна¤ очистка чата
$msg2="0";	    //// - 0 = показывать ссылки , 1 = удал¤ть ссылки



$cook = $_COOKIE["chat_nick"]  ;
if($_POST)
{
	setcookie("chat_nick",$_POST["nick"]);
	header("Location: {$_SERVER['PHP_SELF']}"); 
	header("Location: {$_SERVER['HTTP_REFERER']}");   
}
?>
<script type="text/javascript"> 

function stopRKey(evt) { 
  var evt = (evt) ? evt : ((event) ? event : null); 
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null); 
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;} 
} 

document.onkeypress = stopRKey; 

</script>
<?
$date=date("H:i:s");
$file_msg = fopen("msg.db","a+");
$file_msg_read = file("msg.db");

$count=count($file_msg_read);
if ($count>$num)
{
for ($i=($count-$num); $i<$count; $i++)
 {
 $str = $str.$file_msg_read[$i];
 $str=ereg_replace("rn","n",$str);
 }
$fp=fopen("msg.db","w");
fwrite($fp,$str);
}

$revers_file=array_reverse($file_msg_read);

echo ("<table border='$border' cellspacing=0 cellpadding=0>
<tr bgcolor='$bgcolor'>
<td><div style ='width:$width; height:$height; overflow-y:auto'>");


if(!$file_msg_read)
{
	echo("Ќет сообщений");
}
else
{
	for($i=0; $i < count($revers_file); $i++)
{
	printf("<font color='$colormsg'>%s", $revers_file[$i]);
}
}
echo ('<br><center>');
echo  pack('H*','506f7765726564206279204561744d7944757374');

echo("<tr><td><br>

<center><form name=formtext action=index.php method=POST >
	<input type=text   name=nick value=$cook ><br>
	<input type=text   name=msg  value=собщение  onblur=if(this.value=='')this.value='собщение' onfocus=if(this.value=='собщение')this.value='' ><br>
</center>
<center>
	<input id='mybutton'    style=width:80px type=submit value=отправить disabled=true>
</center>
</form>

<script>

var c=5;
   fc();

   function fc(){

     if(c>0){

        document.getElementById('mybutton').value = 'ждите ' + c;
        c=c-1;
        setTimeout('fc()', 1000);
      } else {
        document.getElementById('mybutton').disabled = false;
        document.getElementById('mybutton').value = 'отправить ';
     }

       }

</script> </table>");



$nick=$_POST["nick"];
$msg=$_POST["msg"];

$nick = strip_tags($nick);
$msg = strip_tags($msg);


if($msg=="сообщение")
{
echo('<p>фигн¤</p>');
}
else
{
if(!empty($msg)&&!empty($nick))
{
if($msg2==1)
{
$msg = eregi_replace("[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*","" ,$msg);
$msg = eregi_replace("^http://([^ ,\r\n]*)","", $msg);
$msg = eregi_replace("([ \r\n])http://([^ ,\r\n]*)","",$msg);
$msg = eregi_replace("([ \r\n])www\\.([^ ,\r\n]*)","",$msg);
$msg = eregi_replace("^www\\.([^ ,\r\n]*)","",$msg);
$msg = eregi_replace("-1-","<img src=smiles/1.gif>",$msg);
$msg = eregi_replace("-2-","<img src=smiles/2.gif>",$msg);
$msg = eregi_replace("-3-","<img src=smiles/3.gif>",$msg);
$msg = eregi_replace("-4-","<img src=smiles/4.gif>",$msg);
$msg = eregi_replace("-5-","<img src=smiles/5.gif>",$msg);
$msg = eregi_replace("-6-","<img src=smiles/6.gif>",$msg);
$msg = eregi_replace("-7-","<img src=smiles/7.gif>",$msg);
$msg = eregi_replace("-8-","<img src=smiles/8.gif>",$msg);
$msg = eregi_replace("-9-","<img src=smiles/9.gif>",$msg);
$msg = eregi_replace("-10-","<img src=smiles/10.gif>",$msg);
$msg = eregi_replace("-11-","<img src=smiles/11.gif>",$msg);
$msg = eregi_replace("-12-","<img src=smiles/12.gif>",$msg);
$msg = eregi_replace("-13-","<img src=smiles/13.gif>",$msg);
$msg = eregi_replace("-14-","<img src=smiles/14.gif>",$msg);
$msg = eregi_replace("-15-","<img src=smiles/15.gif>",$msg);
$msg = eregi_replace("-16-","<img src=smiles/16.gif>",$msg);
$msg = eregi_replace("-17-","<img src=smiles/17.gif>",$msg);
$msg = eregi_replace("-18-","<img src=smiles/18.gif>",$msg);

fwrite($file_msg,("<font color=$colortime> ($date) <font color=$colornick><br> $nick: </font></font>$msg<br><hr>\r\n"));
fclose($file_msg);
}
else
{
$msg = eregi_replace("[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*","<a href=\"mailto:\\0\" target=_blank>\\0</a>",$msg);
$msg = eregi_replace("^http://([^ ,\r\n]*)","<a href='http://\\1' target=_blank>http://\\1</a>", $msg);
$msg = eregi_replace("([ \r\n])http://([^ ,\r\n]*)","\\1<a href='http://\\2' target=_blank>http://\\2</a>",$msg);
$msg = eregi_replace("([ \r\n])www\\.([^ ,\r\n]*)","\\1<a href='http://www.\\2'target=_blank>http://www.\\2</a>",$msg);
$msg = eregi_replace("^www\\.([^ ,\r\n]*)","<a href='http://www.\\1' target=_blank>http://www.\\1</a>",$msg);
$msg = eregi_replace("-1-","<img src=smiles/1.gif>",$msg);
$msg = eregi_replace("-2-","<img src=smiles/2.gif>",$msg);
$msg = eregi_replace("-3-","<img src=smiles/3.gif>",$msg);
$msg = eregi_replace("-4-","<img src=smiles/4.gif>",$msg);
$msg = eregi_replace("-5-","<img src=smiles/5.gif>",$msg);
$msg = eregi_replace("-6-","<img src=smiles/6.gif>",$msg);
$msg = eregi_replace("-7-","<img src=smiles/7.gif>",$msg);
$msg = eregi_replace("-8-","<img src=smiles/8.gif>",$msg);
$msg = eregi_replace("-9-","<img src=smiles/9.gif>",$msg);
$msg = eregi_replace("-10-","<img src=smiles/10.gif>",$msg);
$msg = eregi_replace("-11-","<img src=smiles/11.gif>",$msg);
$msg = eregi_replace("-12-","<img src=smiles/12.gif>",$msg);
$msg = eregi_replace("-13-","<img src=smiles/13.gif>",$msg);
$msg = eregi_replace("-14-","<img src=smiles/14.gif>",$msg);
$msg = eregi_replace("-15-","<img src=smiles/15.gif>",$msg);
$msg = eregi_replace("-16-","<img src=smiles/16.gif>",$msg);
$msg = eregi_replace("-17-","<img src=smiles/17.gif>",$msg);
$msg = eregi_replace("-18-","<img src=smiles/18.gif>",$msg);
fwrite($file_msg,("<font color=$colortime> ($date) <font color=$colornick><br> $nick: </font></font>$msg<br><hr>\r\n"));
fclose($file_msg);
}}}
echo($result);

?>

</div>