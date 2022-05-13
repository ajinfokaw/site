<?php 

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';

$url_path=$_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF'];


require_once 'lang/languages.inc';
$set_lang='lang/'.$lang_files[0];

require_once $set_lang;
require_once $skin_dir.'/skin.inc';
require_once 'incl/'.$db_type.'_functions.inc';

print '<?xml version="1.0" encoding="utf-8"?>';?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<title>INSTALL BlaB! 3.x</title>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="<?php print $skin_dir;?>/style.css" />
</head><body class="y"><div class="x"><div style="float:right"><?php include 'banner.html';?></div></div>
<?php 

if(isset($name)&&isset($pass)&&isset($mail)&&isset($dmll)&&isset($rand)&&isset($urll)){

$name=neutral_escape($name,64,'str');
$pass=neutral_escape($pass,64,'str');
$mail=neutral_escape($mail,64,'str');
$dmll=neutral_escape($dmll,32,'str');
$rand=neutral_escape($rand,40,'str');
$urll=neutral_escape($urll,64,'str');
if(isset($extn)){$extn=(int)$extn;}else{$extn=0;}
if($extn<1){$regon=1;}else{$regon=0;}

if(strlen($name)>2&&strlen($pass)>2&&strlen($mail)>6&&strlen($dmll)>6&&strlen($rand)==37&&strlen($urll)>7){

switch($db_type){
case 'sqlite'  :$auto_increment='integer NOT NULL PRIMARY KEY';$heap_type='';break;
case 'postgre' :$auto_increment='serial PRIMARY KEY';$heap_type='';break;
default        :$auto_increment='integer NOT NULL auto_increment PRIMARY KEY';$heap_type=' TYPE=HEAP MAX_ROWS=15000;';break;
}

$install=array();neutral_dbconnect();

$install[]='CREATE TABLE '.$prefix.'_settings(
set_id varchar(16) NOT NULL PRIMARY KEY,
set_value varchar(255) NOT NULL)';

$install[]='INSERT INTO '.$prefix."_settings VALUES('default_mail','$dmll')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('gzip','2')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('max_users','20')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('max_upload','200')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('suffix',' ^')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('turing_number','1')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('turing_live','15')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('url','$urll')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('title','BlaB!')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('guest_name','guest')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('guest_pass','guest')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('random','$rand')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('guest_help','1')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('activation','0')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('extension','$extn')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('reg_on','$regon')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('mail_header','[Message encoded as UTF-8]\r\n---------------------------------\r\n\r\nDear friend,')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('mail_footer','Best regards,\r\nThe team')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('a_message','%URL%\r\nYour account has been set active.')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('v_message','%URL%\r\nIn order to activate your account click on the link above. Your activation code is: %CODE%')";
$install[]='INSERT INTO '.$prefix."_settings VALUES('p_message','Your new password is: %PASSWORD%. You can login here: %URL%.')";

/* ---- */

$install[]='CREATE TABLE '.$prefix.'_tnumber(
tur_number integer NOT NULL PRIMARY KEY,
tur_stamp integer NOT NULL)';

/* ---- */

$install[]='CREATE TABLE '.$prefix.'_banned(
ban_entry varchar(15) NOT NULL,
ban_stamp integer NOT NULL)'.$heap_type;

/* ---- */

$install[]='CREATE TABLE '.$prefix.'_online(
usr_id integer NOT NULL,
usr_name varchar(64) NOT NULL,
usr_ip varchar(15) NOT NULL,
room_id smallint NOT NULL,
rtime integer NOT NULL)'.$heap_type;

/* ---- */

$install[]='CREATE TABLE '.$prefix.'_lines(
line_id integer NOT NULL,
room_id smallint NOT NULL,
from_id integer NOT NULL,
from_name varchar(64) NOT NULL,
to_id integer NOT NULL,
to_name varchar(64) NOT NULL,
line_stamp integer NOT NULL,
line_txt varchar(255) NOT NULL,
line_biu varchar(3) NOT NULL,
line_clr varchar(32) NOT NULL)'.$heap_type;

/* ---- */

$install[]='CREATE TABLE '.$prefix.'_rooms(
room_id '.$auto_increment.',
room_name varchar(64) NOT NULL,
room_desc varchar(255) NOT NULL,
room_mode smallint NOT NULL)';

$install[]='INSERT INTO '.$prefix."_rooms VALUES($autoinc,'ROOM #1','No description...',0)";
$install[]='INSERT INTO '.$prefix."_rooms VALUES($autoinc,'ROOM #2','No description...',0)";
$install[]='INSERT INTO '.$prefix."_rooms VALUES($autoinc,'ROOM #3','No description...',0)";
$install[]='INSERT INTO '.$prefix."_rooms VALUES($autoinc,'ROOM #4','No description...',0)";
$install[]='INSERT INTO '.$prefix."_rooms VALUES($autoinc,'ROOM #5','No description...',0)";


/* ---- */

$install[]='CREATE TABLE '.$prefix.'_users(
usr_id '.$auto_increment.',
usr_name varchar(64) NOT NULL,
usr_pass char(32) NOT NULL,
usr_mail varchar(32) NOT NULL,
usr_join_date integer NOT NULL,
usr_offset smallint NOT NULL,
usr_format smallint NOT NULL,
usr_sex smallint NOT NULL,
usr_snd smallint NOT NULL,
usr_fun smallint NOT NULL,
usr_mod smallint NOT NULL,
usr_lng smallint NOT NULL,
usr_age smallint NOT NULL,
usr_info varchar(255),
usr_location varchar(64),
usr_website varchar(50),
usr_avatar varchar(255),
usr_status varchar(8))';

$pass=md5(md5($pass).$salt);
$timestamp=time();
$install[]='INSERT INTO '.$prefix."_users VALUES($autoinc,'$name','$pass','$mail',$timestamp,0,0,0,1,1,1,0,0,'','','','','0')";

/* ---- */

for($i=0;$i<count($install);$i++){
neutral_query($install[$i]);}

print '<div class="y1"><b>Install completed!</b><br /><br />Remove <i>install.php</i> and <a href="info.php?reason=link" onclick="window.location=\'login.php\';return false"><b>click here</b></a>.</div>';
print '<div class="z"></div></body></html>';
die();}}

?>

<?php
if(!isset($ff)){
print '<div class="y1"><b>Installing BlaB! 3.x</b><br /><br />Preparing to install... <a href="info.php?reason=link" onclick="window.location=\'install.php?ff=1\';return false"><b>Click here</b></a> to continue with a database test. If the test fails, open <i>config.php</i> by a text editor, make sure that all required variables are correct and re-upload c<i>onfig.php</i>.</div>';
print '<div class="z"></div></body></html>';
die();}

if(isset($ff)&&$ff=='1'){neutral_dbconnect();}
?>
<form action="install.php" id="fms" method="post" onsubmit="return check_form()">
<div class="y1">
<script type="text/javascript">
function check_form(){
f=document.forms.fms;ok=1;
f.rand.value=f.key.value;a=f.name;b=f.pass;c=f.cass;d=f.urll;e=f.mail;g=f.rand;h=f.dmll
if(h.value.length < 7||h.value.indexOf('@')==-1||h.value.indexOf('.')==-1){
h.value='';h.focus();ok=0}
if(e.value.length < 7||e.value.indexOf('@')==-1||e.value.indexOf('.')==-1){
e.value='';e.focus();ok=0}
if(d.value.length < 7){d.value='';d.focus();ok=0}
if(b.value.length < 3){b.value='';b.focus();ok=0}
if(b.value!=c.value){b.value='';c.value='';b.focus();ok=0}
if(a.value.length < 3){a.value='';a.focus();ok=0}
if(g.value.length < 3){g.value='';g.focus();ok=0}
if(ok==1){return true}else{return false}}
</script>
<b>Installing BlaB! 3.x</b><br /><br />Database ok. Enter all required data and click <b>INSTALL</b> to continue...<br />If you do not have a license key, obtain one http://hot-things.net</a>.
<br /><br /><br />
<table style="width:400px">

<?php
   $random_source= array('0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f');
    $random_code= "xtd9-";
    for ($i=6;$i<=37;$i++)
    {
      $random_num   = rand(0,15);
      $random_code .=$random_source[$random_num];
    }
?>
<tr><td class="s" style="width:120px;text-align:right">License key:</td><td style="width:280px"><input type="text" style="width:100%" name="key" value="<?php echo $random_code; ?>" /></td></tr>

<tr><td colspan="2">&nbsp;</td></tr>

<tr><td class="s" style="text-align:right">Admin name: </td><td><input type="text" style="width:100%" maxlength="16" name="name" /></td></tr>
<tr><td class="s" style="text-align:right">Admin password: </td><td><input type="text" style="width:100%" maxlength="32" name="pass" /></td></tr>
<tr><td class="s" style="text-align:right">Confirm password: </td><td><input type="text" style="width:100%" maxlength="32" name="cass" /></td></tr>
<tr><td class="s" style="text-align:right">Admin mail: </td><td><input type="text" style="width:100%" maxlength="32" name="mail" /></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>

<tr><td class="s" style="text-align:right">URL address: </td><td><input type="text" style="width:100%" maxlength="64" name="urll" value="<?php print 'http://'.str_replace('/install.php','',$url_path);?>" /></td></tr>
<tr><td class="s" style="text-align:right">System mail: </td><td><input type="text" style="width:100%" maxlength="32" name="dmll" /></td></tr>

<tr><td class="s" style="text-align:right">Integration: </td>
<td>
<script type="text/javascript">
arr=new Array();
<?php
$ext=file('incl/extensions');
for($i=1;$i<count($ext);$i++){
$line=explode(':',$ext[$i]);
if(isset($line[0])&&isset($line[6])){
$ext_name=trim($line[0]);
print "arr[$i]='$ext_name';\n";}}
?>
</script>
<select class="s" style="width:100%" name="extn" onchange="qiq=document.getElementById('crfl');if(this.value!='0'){qiq.style.display='block';document.getElementById('prnt1').innerHTML=arr[this.value]+'&nbsp;';document.getElementById('prnt2').innerHTML=arr[this.value]+'&nbsp;';}else{qiq.style.display='none'}">
<?php
print '<option value="0">- Standalone -</option>';
$ext=file('incl/extensions');
for($i=1;$i<count($ext);$i++){
$line=explode(':',$ext[$i]);
if(isset($line[0])&&isset($line[6])){

$ext_name=trim($line[0]);
print '<option value="'.$i.'">'.$ext_name.'</option>'."\n";
}
}
?>
</select>
</td></tr>

<tr><td colspan="2"><div id="crfl" class="s" style="color:#000;background-color:#eee;display:none;border:1px solid #f00;padding:10px">Prior to running this installation, <span style="font-weight:bold" id="prnt1"></span>must be installed and its database must be set as a destination database for BlaB! in <b>config.php</b>!<br /><br />Please note that you may experience <span style="text-decoration:underline">some errors</span> if <span style="font-weight:bold" id="prnt2"></span>is not installed with its default settings or you are running a version that is too old. In this case simply submit a support ticket.</div></td></tr>
<tr><td></td><td style="text-align:right"><input type="hidden" name="ff" value="1" /><input type="hidden" name="rand" value="1" /><input type="submit" value=" INSTALL " /></td></tr>
</table></div></form>
<div class="z"></div>
</body></html>
