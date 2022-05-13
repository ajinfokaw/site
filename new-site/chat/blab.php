<?php

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

$my_details=array();
$logout_link='login.php';

if(isset($blab_id)&&isset($blab_pass)){

if($blab_id=='0'&&$blab_pass==hsh($settings['guest_pass'])){

mt_srand((double)microtime()*999999999);
$my_details['usr_id']=mt_rand(100000000,500000000);
$my_details['usr_name']=$settings['guest_name'].'-'.substr(microtime(),2,4);
$my_details['usr_format']='0';
$my_details['usr_snd']='1';
$my_details['usr_fun']='1';
$my_details['usr_mod']='0';
}

else{
$blab_id=explode('-',$blab_id);

if(isset($blab_id[1])&&hsh($blab_id[0].$settings['random'])==$blab_id[1]){

$blab_id[0]=neutral_escape($blab_id[0],9,'int');
$blab_pass=neutral_escape($blab_pass,32,'str');

$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$blab_id[0] AND usr_pass='$blab_pass' AND usr_status='0'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$my_details=neutral_fetch_array($result);}}}}

elseif(isset($settings['extension'])&&$settings['extension']!='0'){
$the_num=(int)$settings['extension'];
$ext=file('incl/extensions');
if(isset($ext[$the_num])){
$ext=explode(':',$ext[$the_num]);
if(isset($ext[6])){
$ext_name=trim($ext[0]);
$ext1file=trim($ext[1]);$ext2file=trim($ext[2]);
$ext1cook=trim($ext[3]);$ext2cook=trim($ext[4]);
$ext1tble=trim($ext[5]);$ext2tble=trim($ext[6]);
if(isset($$ext1cook)){$logout_link='../';require_once 'incl/'.$ext1file;}
}}}

if(!isset($my_details['usr_id'])){redirect('login.php?login=1',0,0);}


$ajx_name=$my_details['usr_name'];
$ajx_name=str_replace("'",'',$ajx_name);
$ajx_name=str_replace('&','',$ajx_name);
$ajx_name=str_replace('+','',$ajx_name);
$ajx_name=str_replace('"','',$ajx_name);
$ajx_name=str_replace('\\','',$ajx_name);
$ajx_name=trim($ajx_name);

$set_midd=substr($settings['random'],3,1);
$ajx_code=hsh($my_details['usr_id'].$ajx_name.$timestamp);
$ajx_sess=$timestamp;

/* --- */

include 'incl/open_doc.inc';
?>
<script type="text/javascript">

http_chat=http_obj();
http_room=http_obj();
http_user=http_obj();

ajx_last=0;ajx_room=0;
ajx_toid=0;ajx_line='';

ajx_code='<?php print $ajx_code;?>';
ajx_name='<?php print $ajx_name;?>';
ajx_sess=parseInt('<?php print $ajx_sess;?>');
ajx_zone=parseInt('<?php print $timezone;?>');
ajx_user=parseInt('<?php print $my_details['usr_id'];?>');
ajx_tfrm=parseInt('<?php print $my_details['usr_format'];?>');
ajx_sndd=parseInt('<?php print $my_details['usr_snd'];?>');
ajx_funn=parseInt('<?php print $my_details['usr_fun'];?>');
set_refr=parseInt('<?php print $update;?>');
set_midd=parseInt('<?php print $set_midd;?>');
set_uspr=parseInt('<?php print $settings['max_users'];?>');
set_extn=parseInt('<?php print $settings['extension'];?>');
sup_errs=parseInt('<?php print $no_errs;?>');

set_rnme='<?php print $lang['rooms'];?>';
set_onle='<?php print $lang['online'];?>';
set_disc='<?php print $lang['disconnect'];?>';
set_clck='<?php print $lang['continue'];?>';
set_usri='<?php print $lang['inf_pmssg'];?>';
set_usrs='<?php print $lang['users'];?>';
set_hist='<?php print $lang['history'];?>';

lock1=0;lock2=1;lock3=0;
txt='';tmp=0;
stlB=0;stlI=0;stlU=0;stlC=0;
</script>

<div id="dvx" class="x">
<div style="float:right" align="justify"><?php include 'banner.html';?></div>

<div style="float:left;margin:5px;white-space:nowrap">
<a href="info.php?reason=link" onclick="reset_all();go('admin.php');return false"><?php if($my_details['usr_id']==1){$pic=show_pic($navi['admin'],0);print $pic;}?></a>
<a href="info.php?reason=link" onclick="room();return false"><?php $pic=show_pic($navi['rooms'],0);print $pic;?></a>
<a href="info.php?reason=link" onclick="reset_all();go('profile.php');return false"><?php if(isset($blab_id)&&$blab_id!='0'){$pic=show_pic($navi['profl'],0);print $pic;}?></a>
<a href="info.php?reason=link" onclick="reset_all();go('<?php print $logout_link;?>');return false"><?php $pic=show_pic($navi['exitt'],0);print $pic;?></a>
<span id="dvJ" style="padding-left:15px;display:none">
<a href="info.php?reason=link" onclick="show_sound();return false"><?php $pic=show_pic($navi['sound'],0);print $pic;?></a>
<a href="info.php?reason=link" onclick="show_time();return false"><?php $pic=show_pic($navi['tzone'],0);print $pic;?></a>
<a href="info.php?reason=link" onclick="show_colors();return false"><?php $pic=show_pic($navi['color'],0);print $pic;?></a>
<a href="info.php?reason=link" onclick="show_smilies();return false"><?php $pic=show_pic($navi['smile'],0);print $pic;?></a>
</span></div>

<br style="clear:both" /></div>

<div id="dvA" class="y0"></div>
<div id="dvB" class="y1" style="display:none"></div>
<div id="dvC" class="y2" style="display:none"></div>
<div id="dvD" class="y3" style="display:block"></div>
<div id="dvE" class="y4" style="display:none">
<script type="text/javascript">
<?php
include $skin_dir.'/smilies.inc';

$sm_tag=array();
$sm_img=array();
$colors="'000000','000033','000066','000099','0000CC','000BFF','003300','003333','003366','003399','0033CC','0033FF','006600','006633','006666','006699','0066CC','0066FF','009900','009933','009966','009999','0099CC','0099FF','00CC00','00CC33','00CC66','00CC99','00CCCC','00CCFF','00FF00','00FF33','00FF66','00FF99','00FFCC','00FFFF','330000','330033','330066','330099','3300CC','3300FF','333300','333333','333366','333399','3333CC','3333FF','336600','336633','336666','336699','3366CC','3366FF','339900','339933','339966','339999','3399CC','3399FF','33CC00','33CC33','33CC66','33CC99','33CCCC','33CCFF','33FF00','33FF33','33FF66','33FF99','33FFCC','33FFFF','660000','660033','660066','660099','6600CC','6600FF','663300','663333','663366','663399','6633CC','6633FF','666600','666633','666666','666699','6666CC','6666FF','669900','669933','669966','669999','6699CC','6699FF','66CC00','66CC33','66CC66','66CC99','66CCCC','66CCFF','66FF00','66FF33','66FF66','66FF99','66FFCC','66FFFF','990000','990033','990066','990099','9900CC','9900FF','993300','993333','993366','993399','9933CC','9933FF','996600','996633','996666','996699','9966CC','9966FF','999900','999933','999966','999999','9999CC','9999FF','99CC00','99CC33','99CC66','99CC99','99CCCC','99CCFF','99FF00','99FF33','99FF66','99FF99','99FFCC','99FFFF','CC0000','CC0033','CC0066','CC0099','CC00CC','CC00FF','CC3300','CC3333','CC3366','CC3399','CC33CC','CC33FF','CC6600','CC6633','CC6666','CC6699','CC66CC','CC66FF','CC9900','CC9933','CC9966','CC9999','CC99CC','CC99FF','CCCC00','CCCC33','CCCC66','CCCC99','CCCCCC','CCCCFF','CCFF00','CCFF33','CCFF66','CCFF99','CCFFCC','CCFFFF','FF0000','FF0033','FF0066','FF0099','FF00CC','FF00FF','FF3300','FF3333','FF3366','FF3399','FF33CC','FF33FF','FF6600','FF6633','FF6666','FF6699','FF66CC','FF66FF','FF9900','FF9933','FF9966','FF9999','FF99CC','FF99FF','FFCC00','FFCC33','FFCC66','FFCC99','FFCCCC','FFCCFF','FFFF00','FFFF33','FFFF66','FFFF99','FFFFCC','FFFFFF'";

for($i=0;$i<count($emoticons);$i++){
$csm=explode(' ',$emoticons[$i]);
if(isset($csm[1])&&is_file("$skin_dir/smilies/$csm[1]")){
$sm_tag[]="'$csm[0]'";$sm_img[]="'$csm[1]'";}}

$sm_tag=implode(',',$sm_tag);
$sm_img=implode(',',$sm_img);

print 'smiles=new Array('.$sm_tag.');';
print 'sfiles=new Array('.$sm_img.');';
print 'colors=new Array('.$colors.');';
?>q1();</script></div>
<div id="dvF" class="y4" style="display:none"><script type="text/javascript">q2();</script></div>

<div id="dvG" class="y4" style="display:none">
<div id="dvH"></div>
<div class="s" style="padding:2px;float:left"><a href="info.php?reason=link" style="text-decoration:none" onclick="document.getElementById('dvG').style.display='none';return false"><b>&laquo;</b></a></div>
<?php 
if(isset($my_details['usr_mod'])&&$my_details['usr_mod']=='1'){
print '<div class="s" style="padding:2px;float:right">';
print '<a onclick="ban();return false" style="text-decoration:none" href="info.php?reason=link">'.$lang['ban'].'</a>';
print '</div>';}?>
<br style="clear:both" />
<form action="blab.php" style="margin:0px;padding:0px" onsubmit="set_private();return false">
<table style="margin:auto;width:100%" cellspacing="0"><tr>
<td style="width:90%"><input style="font-size:10px;width:100%" type="text" maxlength="127" id="pm" value="" /></td>
<td style="text-align:right"><input style="font-weight:bold;font-size:10px" type="submit" value="&nbsp;&raquo;&nbsp;" onclick="set_private();return false" /></td>
</tr></table></form></div>

<div id="dvI" class="y5" style="display:none">
<div class="s" style="text-align:center;font-weight:bold">
&laquo;<script type="text/javascript">q3();</script>&raquo;</div></div>

<div id="dvK" class="y4" style="display:none">
<div class="s" style="text-align:center;font-weight:bold">
<a href="info.php?reason=link" style="text-decoration:none" onclick="set_sound(1,'<?php print $lang['sound'].' ['.$lang['on'].']';?>');return false"><?php print $lang['on'];?></a> / 
<a href="info.php?reason=link" style="text-decoration:none" onclick="set_sound(0,'<?php print $lang['sound'].' ['.$lang['off'].']';?>');return false"><?php print $lang['off'];?></a></div></div>

<div id="dvz" class="z">
<form action="blab.php" style="margin:0px;padding:0px" onsubmit="set_post();return false">
<table cellspacing="1" id="inpt" style="float:left;margin:1px;padding-top:2px;visibility:hidden;width:100%">
<tr><td style="width:80%"><input type="text" size="25" style="width:100%" id="ln" value="" maxlength="127" /></td>
<td><input type="submit" value="<?php print $lang['ok'];?>" onclick="set_post();return false" /></td>
<td>&nbsp;&nbsp;</td>
<td style="text-align:right;white-space:nowrap">
<input class="m" type="button" value=" B " onclick="r=document.getElementById('ln');s=document.getElementById('pm');if(this.className=='m'){this.className='n';r.style.fontWeight='bold';s.style.fontWeight='bold';stlB=1}else{this.className='m';r.style.fontWeight='normal';s.style.fontWeight='normal';stlB=0};fc();return false" />
<input class="m" type="button" value=" I " onclick="r=document.getElementById('ln');s=document.getElementById('pm');if(this.className=='m'){this.className='n';r.style.fontStyle='italic';s.style.fontStyle='italic';stlI=1}else{this.className='m';r.style.fontStyle='normal';s.style.fontStyle='normal';stlI=0};fc();return false" />
<input class="m" type="button" value=" U " onclick="r=document.getElementById('ln');s=document.getElementById('pm');if(this.className=='m'){this.className='n';r.style.textDecoration='underline';s.style.textDecoration='underline';stlU=1}else{this.className='m';r.style.textDecoration='none';s.style.textDecoration='none';stlU=0};fc();return false" />
<input class="m" type="button" value=" &nbsp; " onclick="show_colors();return false" id="cl" />
&nbsp;</td></tr></table></form>

</div>
<div class="v"><span id="reqt">&nbsp;</span><span id="quer">&nbsp;</span></div>
<script type="text/javascript">
if(navigator.userAgent.indexOf('Opera/8')!=-1){dvB.style.overflow='auto'}
lock2=0;setTimeout('room()',500);</script>
</body></html>