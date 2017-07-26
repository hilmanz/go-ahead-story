<?php /* Smarty version 2.6.13, created on 2014-02-06 14:43:27
         compiled from application/web/widgets/goahead-join.html */ ?>
<div class="popupContent">
	<div class="popupHead">
		<div class="the-title">
			<h2 class="icon icon_calendar"><span>JOIN</span></h2>
		</div>
	</div>
	<div>
		<form method="POST" enctype="multipart/form-data" action="<?php echo $this->_tpl_vars['basedomain']; ?>
goahead/join" class="formgoaheadjoin">
			<div class="row">
				<textarea value="Deskripsi" onfocus="if(this.value=='Deskripsi')this.value='';" onblur="if(this.value=='')this.value='Deskripsi';" name="desc">Deskripsi</textarea>
			</div>
			<div class="row rowsubmit">
				<input type="hidden" name="fromwho" value="1">
				<input type="hidden" name="submit" value="1">
				<input type="submit" value="Submit">
			</div>
		</form>
	</div>
</div>


<script>	
	var basedomain = "<?php echo $this->_tpl_vars['basedomain']; ?>
"
<?php echo '
	var optionjoin = {
		dataType:  \'json\',
		beforeSubmit: function(data) {
			$("#popup-messagebox .popupContent .entry-popup h3").html("<img src=\'"+basedomain+"assets/images/loader.gif\' />");
			$(".messageboxpop").trigger(\'click\');	
		},
		success:    function(data) {
			if(data) {
				$("#popup-messagebox .popupContent .entry-popup h3").html("Join GOAHEAD Berhasil");
				$(".messageboxpop").trigger(\'click\');
			}else {
				$("#popup-messagebox .popupContent .entry-popup h3").html("Join GOAHEAD gagal");
				$(".messageboxpop").trigger(\'click\');
			}
		}
	};
	
	$(".formgoaheadjoin").ajaxForm(optionjoin);
	
	$(document).on(\'click\',\'#fancybox-close\', function(){
		window.location.href= basedomain+\'goahead\';
	});
</script>
'; ?>