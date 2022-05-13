<?php

if(!$_POST) exit;

$email = $_POST['email'];


//$error[] = preg_match('/\b[A-Z0-9._%-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i', $_POST['email']) ? '' : 'ENDEREÇO DE EMAIL INVÁLIDO';
if(!eregi("^[a-z0-9]+([_\\.-][a-z0-9]+)*" ."@"."([a-z0-9]+([\.-][a-z0-9]+)*)+"."\\.[a-z]{2,}"."$",$email )){
	$error.="Email invalido";
	$errors=1;
}
if($errors==1) echo $error;
else{
	$values = array ('name','email','message');
	$required = array('name','email','message');
	 
	$your_email = "suporte@infokaw.com.br";
	$email_subject = "Contato infokaw: ".$_POST['subject'];
	$email_content = "Mensagem:\n";
	
	foreach($values as $key => $value){
	  if(in_array($value,$required)){
		if ($key != 'subject' && $key != 'company') {
		  if( empty($_POST[$value]) ) { echo 'POR FAVOR PREENCHA OS CAMPOS OBIRGATŔIO'; exit; }
		}
		$email_content .= $value.': '.$_POST[$value]."\n";
	  }
	}
	 
	if(@mail($your_email,$email_subject,$email_content)) {
		echo 'Mensagem enviada!'; 
	} else {
		echo 'ERROR!';
	}
}
?>