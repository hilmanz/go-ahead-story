<?php /* Smarty version 2.6.13, created on 2014-02-06 14:44:14
         compiled from application/web//apps/goahead.html */ ?>
<div id="main-menu-wrapper" class="clearfix">
    <ul id="main-menu" class="fl">
        <li class="<?php if ($this->_tpl_vars['main'] == 'default' || $this->_tpl_vars['main'] == 'gallery'): ?>current<?php endif; ?>  resNav">
			<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
goahead/gallery" class="hoverslide">Gallery</a>
		</li>
        <li class="<?php if ($this->_tpl_vars['main'] == 'join'): ?>current<?php endif; ?>  resNav">
			<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
goahead/join" class="hoverslide">Join</a>
		</li>
        <li class="<?php if ($this->_tpl_vars['main'] == 'story'): ?>current<?php endif; ?>  resNav">
			<a href="<?php echo $this->_tpl_vars['basedomain']; ?>
goahead/story" class="hoverslide">trivia</a>
		</li>
    </ul>
</div>
<?php if ($this->_tpl_vars['main'] == 'default' || $this->_tpl_vars['main'] == 'gallery'): ?>
	<?php echo $this->_tpl_vars['goahead_gallery_list']; ?>

<?php elseif ($this->_tpl_vars['main'] == 'join'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "application/web/widgets/goahead-join.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php elseif ($this->_tpl_vars['main'] == 'story'): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "application/web/apps/story-pages.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>