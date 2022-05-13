<?php

$query="SELECT * FROM $ext1tble WHERE id=$ajx_unfo";
$result=neutral_query($query);

if(neutral_num_rows($result)>0){
$user=neutral_fetch_array($result);

print '<div class="s" style="float:right">Mambo</div>';

$name=output($user['username'],2);
$name=escape($name);
$name=convert_enc($name);

print '<b>'.$name.'</b><br /><br />';
}
?>