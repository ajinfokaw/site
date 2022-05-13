<?php 

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

$my_details=array();
if(isset($blab_id)&&isset($blab_pass)){
$blab_id=explode('-',$blab_id);
$fname=(int)$blab_id[0];
$fname=$fname.'-'.substr(hsh($fname.$salt),0,5);

if(isset($blab_id[1])&&hsh($blab_id[0].$settings['random'])==$blab_id[1]){

$blab_id[0]=neutral_escape($blab_id[0],9,'int');
$blab_pass=neutral_escape($blab_pass,32,'str');

$query='SELECT * FROM '.$prefix."_users WHERE usr_id=$blab_id[0] AND usr_pass='$blab_pass' AND usr_status='0'";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){$my_details=neutral_fetch_array($result);}}}

if(!isset($my_details['usr_status'])||$my_details['usr_status']!='0'||$settings['max_upload']<5){
redirect('info.php?reason=no_permission',0,0);}

include 'incl/open_doc.inc';
?>
<div style="padding:12px" class="s">

<?php
$max_size=$settings['max_upload']*1024;
if(isset($_FILES['pic'])&&isset($_FILES['pic']['size'])&&$_FILES['pic']['size']<$max_size){

$msg='OK';$thnm='photos/'.$fname.'.jpg';
if(move_uploaded_file($_FILES['pic']['tmp_name'],$thnm)){  
chmod("$thnm",0644);$msg='OK';
print '<script type="text/javascript">';
print 'if(window.opener){';
print "window.opener.document.forms.fms.avatar.value='$thnm';";
print 'rr=Math.round(99999999*Math.random());';
print "window.opener.document.getElementById('avtr').src='$thnm'+'?r='+rr;";
print 'self.close();}</script>';} 
else{$msg=$lang['upload_err'];}
die($msg.'</div></body></html>');}

?>
<form action="upload.php" id="fms" method="post" enctype="multipart/form-data">
<div class="s"><input type="hidden" name="MAX_FILE_SIZE" value="<?php $max=$settings['max_upload']*1024;print $max;?>" />MAX: <?php print $settings['max_upload'];?> kB
<input type="file" name="pic" style="font-family:verdana,sans-serif;font-size:10px;color:#000;background-color:#eee" onchange="rr=confirm('<?php print $lang['confirm'];?>');if(rr && document.forms[0].pic.value.length>1){document.forms.fms.submit()}" />
</div></form></div></body></html>
