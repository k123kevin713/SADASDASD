<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Frameset//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-frameset.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" charset="utf-8" />
<title>眼動實驗第一題</title>

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#tabs" ).tabs();
  });
  </script>
<?php
error_reporting(0);
$aesid=$_COOKIE["myid"];

//echo $aesid;

//建立資料庫連結物件
      require_once("dbtools.inc.php");
      $link = create_connection();
	  
	  $sql="Select * From question order by no desc";
	  $result = execute_sql("ets", $sql, $link);
	  
	  $sqla="Select * From answer where id='$aesid'";
	  $resulta = execute_sql("ets", $sqla, $link);
	  
	  $sqln="Select * From note where id='$aesid'";
	  $resultn = execute_sql("ets", $sqln, $link);
?>
</head>
<body><font face="標楷體">
<form method="POST" id="form1" name="form1" action="ansupdate.php">
  
 <table align="center" style="width:100%;">
 <?php
$rs=mysql_fetch_row($result);
$rsa=mysql_fetch_row($resulta);
$rsn=mysql_fetch_row($resultn);
?>
         <TR>    
   <TD align="center" style="line-height:2;vertical-align:top;padding:10px;">    
    <font size="4"><b>第一題:<br><?php   echo $rs[1];?></b></font></TD>  
</tr>
<tr>
   <TD align="center"  colspan="2"><hr size="3px" width="100%" color="gray"><p>答案區<br>    
    <align="center"><font size="2"><textarea id="TextArea1" style="resize:none;width:90%;font-family:標楷體;" rows="8" name="ans" required><?php   echo $rsa[1];?></textarea></font>
	<input type="hidden" name="num" value="1">
	<input type="hidden" id="sysSend" name="sysSend" value="0">
	<input type="hidden" name="myid" value="<?=$aesid?>"><p>
	<input style="font-weight:bold;font-family:標楷體;" type="submit" value="送出答案">
	<script type="text/javascript">
var hours = 0;
var minutes = 7;
var seconds = 0;
var cache = 59;
function addtime(time){
        minutes += time;
        document.getElementById('show').innerHTML = '尚餘 '+minutes+' 分鐘 '+seconds+' 秒';
}
function count(addtime){
        if (hours==0 && minutes==0 && seconds==0){
			    $('#sysSend).val("1");
		        document.form1.submit();
                //window.open ("q2.php?action=timesup", "_self", "status=0,scrollbars=0,menubar=0,resizable=0,width=350,height=250");
        }else{
                setTimeout("count()", 1000);
                if (seconds == 0){
                        if (minutes == 0){
                                hours -= 1;
                                minutes = cache-1;
                                seconds = cache;
                        }else{
                                seconds = cache;
                                minutes = minutes-1;
                        }
                }else{
                        seconds = seconds-1;
                }
        }
        document.getElementById('show').innerHTML = '尚餘 '+minutes+' 分鐘 '+seconds+' 秒';
}
document.write('<div id="show" align="right">尚餘 '+minutes+' 分鐘 '+seconds+' 秒</div>');
count();
</script>
	</TD>    
   
	
	</TR>    
	
	
	
	<TR>    
     
   <TD align="center"  colspan="2"><hr size="3px" width="100%" color="gray"><p>筆記區<br>    
        
   <div id="tabs">
  <ul>
    <li><font face="標楷體"><a href="#tabs-1">第一題</a></font></li>
    <li><font face="標楷體"><a href="#tabs-2">第二題</a></font></li>
    <li><font face="標楷體"><a href="#tabs-3">第三題</a></font></li>
	<!--<li><a href="#tabs-4">第四題</a></li>-->
  </ul>
  <div id="tabs-1">
    <font size="2"><textarea id="TextArea5" style="resize:none;width:100%;font-family:標楷體;" rows="8" name="note"><?php   echo $rsn[1];?></textarea></font>
  </div>
  <div id="tabs-2">
    <font size="2"><textarea id="TextArea5" style="resize:none;width:100%;font-family:標楷體;" rows="8" readonly><?php   echo $rsn[2];?></textarea></font>
  </div>
  <div id="tabs-3">
    <font size="2"><textarea id="TextArea5" style="resize:none;width:100%;font-family:標楷體;" rows="8" readonly><?php   echo $rsn[3];?></textarea></font>
  </div>
  <!--<div id="tabs-4">
    <font size="2"><?php   echo $rsn[4];?></font>
  </div>-->
</div>
</td>
	</TR>    
	
<?php 
 
mysql_free_result($result);
mysql_free_result($resulta);
mysql_free_result($resultn);
      mysql_close($link);
?>       			  
      </table>
    </p>
    
  


     
      
</form></font>
</body>
</html>
