<?php /* Smarty version 2.6.13, created on 2014-02-06 14:44:14
         compiled from application/web//footer.html */ ?>

<div id="footer">
    <div class="wrapper">
        <p>Informasi dalam website ini ditujukan untuk perokok berusia 18 tahun atau lebih dan tinggal di wilayah Indonesia. 
        Jika kamu tidak ingin dihubungi oleh PT HM Sampoerna Tbk melalui email, kamu bisa hapus kontak kamu dengan mengklik link hapus saya dibawah ini.</p>
        <a href="<?php echo $this->_tpl_vars['basedomain']; ?>
">Halaman Utama </a>
        <a target="_blank" href="https://login.goaheadpeople.com/Templates/Termsandconditions.aspx" >Syarat dan Ketentuan</a>
        <a target="_blank" href="https://login.goaheadpeople.com/Templates/RemoveMe.aspx">Hapus saya</a>
        <a target="_blank" href="https://login.goaheadpeople.com/Templates/Contactus.aspx">Kontak Kami</a>
        <a target="_blank" href="https://www.pmi.com/id/smokingandhealth">Perihal Merokok</a>   
    </div>
</div><!-- END #footer -->
<?php if ($this->_tpl_vars['pages'] == home): ?>
<div id="hw">
  	 <img src="<?php echo $this->_tpl_vars['basedomain']; ?>
assets/images/hw4.jpg" />
</div><!-- END #hw -->
<?php endif;  echo '
<script>
$(\'.mp3Player audio\').mediaelementplayer({
    audioHeight: 30,
    startVolume: 0.8,
    loop: false,
    enableAutosize: true,
    features: [\'playpause\',\'current\',\'progress\'] 
});
 $(function(){
        $(\'.thePlayer audio\').mediaelementplayer({
            success: function (mediaElement, domObject) {
                mediaElement.addEventListener(\'ended\', function (e) {
                    mejsPlayNext(e.target);
                }, false);
            },
            keyActions: []
        });

        $(document).on(\'click\',\'.icon_play\', function() {
            $(this).addClass(\'current\').siblings().removeClass(\'current\');
            var audio_src = $(this).attr(\'rel\');
            $(\'audio#mejs:first\').each(function(){
                this.player.pause();
                this.player.setSrc(audio_src);
                this.player.play();
            });
			return false;
        });

    });

    function mejsPlayNext(currentPlayer) {
        if ($(\'.mejs-list tbody tr.current\').length > 0){ // get the .current song
            var current_item = $(\'.mejs-list tbody tr.current:first\'); // :first is added if we have few .current classes
            var audio_src = $(current_item).next().text();
            $(current_item).next().addClass(\'current\').siblings().removeClass(\'current\');
            console.log(\'if \'+audio_src);
        }else{ // if there is no .current class
            var current_item = $(\'.mejs-list tbody tr:first\'); // get :first if we don\'t have .current class
            var audio_src = $(current_item).next().text();
            $(current_item).next().addClass(\'current\').siblings().removeClass(\'current\');
            console.log(\'elseif \'+audio_src);
        }

        if( $(current_item).is(\':last-child\') ) { // if it is last - stop playing
            $(current_item).removeClass(\'current\');
        }else{
            currentPlayer.setSrc(audio_src);
            currentPlayer.play();
        }
    }

</script>
	
<script>
  (function(i,s,o,g,r,a,m){i[\'GoogleAnalyticsObject\']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,\'script\',\'//www.google-analytics.com/analytics.js\',\'ga\');

  ga(\'create\', \'UA-867847-61\', \'goaheadpeople.com\');
  ga(\'send\', \'pageview\');
</script>

'; ?>


<script type="text/javascript">
var pages = "<?php echo $this->_tpl_vars['pages']; ?>
";
var acts = "<?php echo $this->_tpl_vars['acts']; ?>
";
var timeoutmop = "<?php echo $this->_tpl_vars['timeoutmop']; ?>
";
	<?php echo '
	$(document).ready(function(){
		setTimeout(trackuser, 3000);
		//my_timer = setTimeout(trackuser, timeoutmop);
		inboxsync = setTimeout(getinboxcount, 1000);
		
	});
	
	function trackuser(){
			$.post(basedomain+\'track\',{onpage:pages,onact:acts},function(data){
				//if(!data) location.href = basedomain+"logout.php";
				my_timer = setTimeout(trackuser, timeoutmop);
			},"JSON");
	}
	
	function getinboxcount(){
		$.post(basedomain+\'my/ajax\',{needs:"inbox-count"},function(data){
			
				if(data) $(".count-inbox").html(data);
				inboxsync = setTimeout(getinboxcount, 10000);
			},"JSON");
	}
</script>
	'; ?>

	