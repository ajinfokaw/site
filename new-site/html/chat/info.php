<?php 

// ++=============================================================++//
// || Blab! Chat v3.3 - nulled by someone@.....ru - Nulled.WS     ||//
// ++ ============================================================++//

require_once 'config.php';
require_once 'incl/main.inc';
include 'incl/open_doc.inc';
?>
<div class="x"><div style="float:right"><?php include 'banner.html';?></div></div>
<div class="y1"><?php if(isset($reason)){switch($reason){case 'info':include $php;break;case 'link':print $lang['error_lnk'];break;case 'no_permission':print $lang['error_nop'];break;case 'browser':print $lang['error_bro'];break;case 'NaN':print $lang['error_nan'].'<br /><br /><a href="./"><b>'.$lang['continue'].'</b></a>';break;default:print $lang['error_unk'].$reason;break;}}?>
</div><div class="z"></div></body></html>