<?php /* Smarty version 2.6.13, created on 2014-02-06 14:44:05
         compiled from application/web//login.html */ ?>

	<div  style="padding-left:191px;">
	<form method="POST" id="formLogin" action="<?php echo $this->_tpl_vars['basedomain']; ?>
login/local">
		<div><h1>SIGN IN</h1></div>
		<div><h3>Username <input type="text" name="username" value="username" onCLick="this.value=''" /></h3></div>
		<div><h3>Password <input type="password" name="password"  onCLick="this.value=''"  value="111" /></h3></div>
		<input type="hidden" name="login" value="1" /> 
		<div><input type="submit" value="LOGIN" /></div> 
	</form>
	<div><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
register" >SIGNUP</a></div>
	<div style="clear:both" ></div>
	</div>


	