<?php /* Smarty version 2.6.13, created on 2014-02-06 14:44:13
         compiled from application/web/widgets/goahead-gallery.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'truncate', 'application/web/widgets/goahead-gallery.html', 25, false),)), $this); ?>
<div id="articlePage">
	<div class="blog-content clearfix">	
		<div id="photo_gallery" class="article_image_content" >
			<?php if ($this->_tpl_vars['article']): ?>
				<?php unset($this->_sections['i']);
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['article']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
					<div class="box photo cols2">
						<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['hasfile']): ?>
							<a href="#popup-photography" class="showPopup thumb120 articledetail" articleType="music"  contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
">
									<img class="greyscale" src="
									<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['video_thumbnail']): ?>https://img.youtube.com/vi/<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['video_thumbnail']; ?>
/0.jpg
									<?php else: ?>
										<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['image']):  echo $this->_tpl_vars['basedomain']; ?>
public_assets/<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['imagepath']; ?>
/<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['image']; ?>

										<?php else:  echo $this->_tpl_vars['basedomain']; ?>
assets/content/thumb/default_music.jpg<?php endif; ?>
									<?php endif; ?>" />
							</a>
						<?php else: ?>
						<a href="#popup-photography" class="showPopup thumb300 articledetail"  contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
">
														<img class="greyscale" src="<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['video_thumbnail']): ?>https://img.youtube.com/vi/<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['video_thumbnail']; ?>
/0.jpg<?php else:  if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['image']):  echo $this->_tpl_vars['basedomain']; ?>
public_assets/article/<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['image'];  else:  echo $this->_tpl_vars['basedomain']; ?>
assets/content/thumb/default_image.jpg<?php endif;  endif; ?>"/>
						</a>
						<?php endif; ?>
						
						<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['hasfile']): ?>
							<div class="isi_boxLittle">
							<h3><a contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
" articleType="music" class="showPopup articledetail" href="#popup-photography"><?php echo ((is_array($_tmp=$this->_tpl_vars['article'][$this->_sections['i']['index']]['title'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 50, ' ') : smarty_modifier_truncate($_tmp, 50, ' ')); ?>
</a></h3>
							<span><a href="#popup-photography" class="showPopup articledetail" articleType="music" contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
">
							<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['author']): ?>
								<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['profilepath']): ?><a href="<?php echo $this->_tpl_vars['basedomain'];  echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['profilepath']; ?>
/<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['author']['authorid']; ?>
" ><?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['author']['name']; ?>
</a>
								<?php else:  echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['author']['name']; ?>

								<?php endif; ?>
							<?php else: ?>anonymous<?php endif; ?>
							
							<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['hasfile'] && $this->_tpl_vars['article'][$this->_sections['i']['index']]['file']): ?>
								<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['can_save']): ?><a href="<?php echo $this->_tpl_vars['basedomain']; ?>
music/downloadit/<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['file']; ?>
" target="_blank" class="icon_download" title="download"></a><?php endif; ?>
							<?php endif; ?>
							</span>
							<?php if (! $this->_tpl_vars['article'][$this->_sections['i']['index']]['video_thumbnail']): ?>
								<div class="mp3Player">
									<?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['hasfile'] && $this->_tpl_vars['article'][$this->_sections['i']['index']]['file']): ?>
									<div class="mp3Player fr">
										<audio src="<?php echo $this->_tpl_vars['basedomain']; ?>
public_assets/music/mp3/<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['file']; ?>
" type="audio/mp3" controls="controls" width="150"></audio>	
									</div>	
									<?php endif; ?>
								</div>
							<?php endif; ?>
							<div class="content_action">
								<ul>
									<li><a title="add favourite" class="icon_love count" counttype="favorite" count="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['favorite']; ?>
" contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
" href="javascript:void(0)"><?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['favorite']; ?>
</a></li>
									<li><a title="total comment" style="display:inline;" class="icon_comment count showPopup articledetail" counttype="comment" count="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['commentcount']; ?>
" contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
" href="#popup-photography"><?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['commentcount']; ?>
</a></li>
									<li><a title="total view" class="icon_view count" counttype="views" count="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['views']; ?>
" contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
" href="javascript:void(0)"><?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['views']; ?>
</a></li>
								</ul>
							</div>
							</div>
						<?php else: ?>
						<div class="entry-box">
							<div class="judul_galery">
								<a href="#popup-photography" class="showPopup thumb300 articledetail"  contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
">
								<h3><?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['title']; ?>
</h3>
								</a>
								<span><?php if ($this->_tpl_vars['article'][$this->_sections['i']['index']]['author']):  echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['author']['name'];  else: ?>anonymous<?php endif; ?></span>
							</div>
							
							<div class="content_action right articleAct">
								<ul>
								<li><a title="add favourite" class="icon_love count" counttype="favorite" count="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['favorite']; ?>
" contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
" href="javascript:void(0)"><?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['favorite']; ?>
</a></li>
								<li><a title="total comment" style="display:inline;"  class="icon_comment count showPopup articledetail" counttype="comment" count="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['commentcount']; ?>
" contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
" href="#popup-photography"><?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['commentcount']; ?>
</a></li>
								<li><a title="total view" class="icon_view count" counttype="views" count="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['views']; ?>
" contentid="<?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['id']; ?>
" href="javascript:void(0)"><?php echo $this->_tpl_vars['article'][$this->_sections['i']['index']]['views']; ?>
</a></li>
								</ul>
						  </div>
						</div>
						<?php endif; ?>
					</div>
				<?php endfor; endif; ?>
			<?php else: ?>
				<div class="notFound">
					<br>
					<p><?php echo $this->_tpl_vars['locale']['notfounddatagoaheadgallery']; ?>
</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="paging" id="goaheadGalleryPaging"></div>
</div>

<!-- this will trigger auto popup if content id is existing -->
<?php if ($this->_tpl_vars['cid']): ?>
<a href="#popup-photography" class="showPopup articledetail"  contentid="<?php echo $this->_tpl_vars['cid']; ?>
" id="autopopupdetail" style="display:none"></a>
<?php echo '
	<script>
		$(document).ready(function(){$("#autopopupdetail").trigger("click");});
	</script>	
'; ?>

<?php endif; ?>

<script>
	var filter_goaheadGallery = "<?php echo $this->_tpl_vars['filter_goaheadGallery']; ?>
"
	getpaging(<?php echo $this->_tpl_vars['start']; ?>
,<?php echo $this->_tpl_vars['total']; ?>
,"goaheadGalleryPaging","paging_ajax_goaheadGallery",10);
</script>