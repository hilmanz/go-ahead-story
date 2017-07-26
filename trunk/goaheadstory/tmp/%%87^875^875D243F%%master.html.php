<?php /* Smarty version 2.6.13, created on 2014-02-06 14:44:14
         compiled from application/web//master.html */ ?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html dir="ltr" lang="en-US" class="ie6"> <![endif]-->
<!--[if IE 7]>    <html dir="ltr" lang="en-US" class="ie7"> <![endif]-->
<!--[if IE 8]>    <html dir="ltr" lang="en-US" class="ie8"> <![endif]-->
<!--[if gt IE 8]><!--> <html dir="ltr" lang="en-US"> <!--<![endif]-->
<!--[if IE 9]>    <html dir="ltr" lang="en-US" class="ie9"> <![endif]-->
<head>
<?php echo $this->_tpl_vars['meta']; ?>

</head>
<body <?php if ($this->_tpl_vars['pages'] == dj): ?>id="djPage"<?php endif; ?> class="<?php echo $this->_tpl_vars['pages']; ?>
">
	<div id="mainContainer">
        <div id="body" class="wrapper">
            <?php echo $this->_tpl_vars['header']; ?>

			<?php echo $this->_tpl_vars['mainContent']; ?>

        </div><!-- END .wrapper -->
        <?php echo $this->_tpl_vars['footer']; ?>

        
        <div class="turntable"></div>
        <div class="headphone"></div>
    </div><!-- END #mainContainer -->
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "application/web/widgets/popup-article-detail.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "application/web/widgets/popup-post.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	<a href="#popup-messagebox" class="showPopup messageboxpop" style="display:none"></a>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "application/web/widgets/popup-messagebox.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</body>
</html>