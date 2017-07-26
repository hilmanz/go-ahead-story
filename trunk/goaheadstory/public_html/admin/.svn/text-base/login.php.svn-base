<?php
/**
* ADMINISTRATION PAGE
* @author Hapsoro Renaldy N <hapsoro.renaldy@winixmedia.com>
*/
include_once "common.php";
$admin = new Admin();

$_captcha = $admin->Request->getPost('captcha');

if(isset($_SESSION['codeBookCaptcha'])){
$_valid = (md5($_captcha) == $_SESSION['codeBookCaptcha']) ? true : false;
$_SESSION['codeBookCaptcha'] = "bed" . rand(00000000,99999999) . "bed";
}else $_valid = false;

if($_valid) {
	if($admin->user->check($admin->Request->getPost("username"),$admin->Request->getPost("password"))){
		$admin->Session->addVariable("username",$admin->Request->getPost("username"));
		$admin->Session->addVariable("isLogin","1");
		$admin->Session->addVariable("uid",$admin->user->userID);
		$levelisValid = $admin->perm->checkAdminLevel();
		if(!$levelisValid) {
			session_destroy();
			sendRedirect("index.php?f=1");
		}else{
			$admin->log->sendActivity('login','just login');
			sendRedirect("index.php");
		}
	}else{
		sendRedirect("index.php?f=1");
	}
}else{
	sendRedirect("index.php?f=1");
}
print $admin->View->toString($MAIN_TEMPLATE);
?>