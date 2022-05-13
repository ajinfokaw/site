<?php 
print '<?xml version="1.0" encoding="utf-8"?>';
print '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">';
print '<html xmlns="http://www.w3.org/1999/xhtml"><head>';
print '<title>';output($settings['title'],1);print '</title>';
print '<meta http-equiv="content-type" content="text/html; charset=utf-8" />';
print '<link rel="stylesheet" type="text/css" href="'.$skin_dir.'/style.css" />';
print '<script type="text/javascript">';
print 'skin_dir=\''.$skin_dir.'\';';
$i=0;while(list($key,$val)=each($navi)){
$preload=explode("|",$navi[$key]);
if(isset($preload[3])){
if(is_file("$skin_dir/$preload[0]")){print "pca$i=new Image();pca$i.src='$skin_dir/$preload[0]';";}
if(is_file("$skin_dir/$preload[1]")){print "pcb$i=new Image();pcb$i.src='$skin_dir/$preload[1]';";}
$i++;}}
print '</script>';
print '<script type="text/javascript" src="incl/blab.js"></script></head><body onload="setWH()" class="y">';
?>