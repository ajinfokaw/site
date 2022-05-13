<?php

/************************************************************/
/* OpenTable Functions                                      */
/*                                                          */
/* Define the tables look&feel for you whole site. For this */
/* we have two options: OpenTable and OpenTable2 functions. */
/* Then we have CloseTable and CloseTable2 function to      */
/* properly close our tables. The difference is that        */
/* OpenTable has a 100% width and OpenTable2 has a width    */
/* according with the table content                         */
/************************************************************/

function OpenTable() {
    global $bgcolor1, $bgcolor2;
?> 
<table width="100%"  border="0" cellpadding="0" cellspacing="0" style="margin-top:15px;">
  <tr>
    <td align="left" valign="top" style="background-color:#eeeeee; border:solid 1px  #ffffff">
	
	<table width="100%" style="height:100%;  " border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td valign="top" style="padding:10px; border: solid 1px #000000">
<div style=" width:100%; color:#000000; background:none;">
      <?
}

function CloseTable() {
   ?>
    </div>		
		</td>
	  </tr>
	</table>
	
	</td>
  </tr>
</table>
<?
}

function OpenTable2() {
    global $bgcolor1, $bgcolor2;
   ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="left" valign="top" style="border:1px solid #7D7D7D;"><div style="padding-left:10px; padding-top:5px; padding-bottom:10px; padding-right:10px">
      <?
}

function CloseTable2() {
       ?>
    </div></td>
  </tr>
</table>
<?
}

?>