<?php 
$path=getcwd();$path=strtr($path,"\\","/");
mt_srand((double)microtime()*1000000);

$sizex=162;                          // image size X
$sizey=45;                           // image size Y
$sizef=30;                           // fontsize, px
$left=6;                            // left||digits
$top=35;                             // top||digits
$step=30;                            // space between digits
$font="$path/incl/04b.ttf";          // ABSOLUTE path to a TTF font (might work without changes)

$im=imagecreate($sizex,$sizey);

$bcolor=imagecolorallocate($im,$bg['r'],$bg['g'],$bg['b']);
$fcolor=imagecolorallocate($im,$fg['r'],$fg['g'],$fg['b']);

$i=0;while($i<$sizey){$m=mt_rand(10,20);
$i+=$m;imageline($im,0,$i,$sizex,$i,$fcolor);}

$i=0;while($i<$sizex){$m=mt_rand(10,30);
$i+=$m;imageline($im,$i,0,$i,$sizey,$fcolor);}

$number=mt_rand(10000,99999);
$md5s=hsh($number.$settings['random']);
$u=mt_rand(0,999999);
for($i=0;$i<5;$i++){
$s=substr($number,$i,1);$m=mt_rand(-2,2);
imagettftext($im,$sizef,0,$left,$top,$fcolor,$font,$s);
$top+=$m;$left+=$step;}

imagepng($im,"turing_number.png");imagedestroy($im);
print '<tr class="c"><td></td>';
print '<td class="c" style="text-align:right"><input type="hidden" name="md5num" value="'.$md5s.'" /><span class="s">'.$lang['turing'].':</span></td>';
print '<td class="c"><input type="text" size="25" name="turnum" maxlength="5" /></td><td></td></tr>';
print '<tr class="c"><td colspan="2"></td>';
print '<td class="c"><img src="turing_number.png?u='.$u.'" width="'.$sizex.'" height="'.$sizey.'" alt="" style="border:1px solid #000" /></td>';
print '<td></td></tr>'."\n";

?>
