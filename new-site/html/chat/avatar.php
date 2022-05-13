<?php 

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';

include 'incl/open_doc.inc';
?>

<script type="text/javascript">
document.body.style.overflow='auto';

function set_av(w){
if(window.opener && window.opener.document.forms.length!=0){
window.opener.document.forms.fms.avatar.value=w;self.close()}
window.opener.document.getElementById('avtr').src=w;return false}
</script>
<div style="padding:5px">

<?php

if(isset($blab_id)&&isset($blab_pass)){

$allp=array();
$fold='avatars';
$handle=opendir($fold);
while($entry=readdir($handle)){
$txt='_'.$entry;
if(is_file('avatars/'.$entry)&&(stristr($txt,'png')||stristr($txt,'jpg')||stristr($txt,'jpeg')||stristr($txt,'gif'))){
$allp[]=$entry;}}
closedir($handle);

sort($allp);

for($i=0;$i<count($allp);$i++){
$pic='<a href="../info.php?reason=link" style="margin:1px" onclick="return set_av(\'avatars/'.$allp[$i].'\')"><img src="avatars/'.$allp[$i].'" alt="" class="i" style="width:80px;height:80px" /></a>';
print $pic;
}}
?>

</div></body></html>