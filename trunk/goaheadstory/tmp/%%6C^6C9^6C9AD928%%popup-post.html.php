<?php /* Smarty version 2.6.13, created on 2014-02-06 14:44:14
         compiled from application/web/widgets/popup-post.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'json_encode', 'application/web/widgets/popup-post.html', 23, false),)), $this); ?>

<div class="popup">
	<div class="popupContainer" id="popup-post">
        <div class="popupContent">
        	<div class="popupHead">
                <div class="the-title">
                    <h2 class="icon icon_smile"><span>New Post</span></h2>
                </div>
            </div>
        	<div id="popup-post-content" ></div>
        </div><!-- END .popupContent -->
    </div><!-- END .popupContainer -->
</div><!-- END .popup -->


<script type="text/javascript">
	var basedomain = "<?php echo $this->_tpl_vars['basedomain']; ?>
";
	var page = "<?php echo $this->_tpl_vars['pages']; ?>
";
	var immember = "<?php echo $this->_tpl_vars['user']->immember; ?>
";
	var ownerid = "<?php echo $this->_tpl_vars['user']->ownerid; ?>
";
	var hasband = "<?php echo $this->_tpl_vars['user']->hasband; ?>
";
	var hasdj = "<?php echo $this->_tpl_vars['user']->hasdj; ?>
";
	var localepages = <?php echo json_encode($this->_tpl_vars['locale']['pages']); ?>
;
	var localecityband = localepages.cek.city;
	var localecitydj = localepages.cek.city;
	var localegenreband = localepages.cek.genre;
	var localegenredj = localepages.cek.genre;
	var localeMemberPostMusic = localepages.cek.member.post_music;
	var localemsgkompetisi = <?php echo json_encode($this->_tpl_vars['locale']['msgkompetisi']); ?>
;

	<?php echo '
	
	$(document).on(\'click\',\'.showthispopuppost\',function(){
		$.post(basedomain+\'post\',function(data){
			
			$("#popup-post-content").html(data);
			initpost();
			Custom.init(); // customform js re-init
		});		
	});
	
	function categorypost(jenis_info){
		$.post(basedomain+\'post/getCategory\',{jenis_info:jenis_info},function(data){
			if(data){
				var html ="";
				//html += "<select name=\'id_cat\' id=\'category_jenis\' class=\'styled\'>";
				// style=\'padding: 1%; width: 55%\'
				html += "	<option value=\'\'>CATEGORY</option>";
				$.each(data,function(i,e){
					if(jenis_info==3) {
						if (hasband) {
							if(e.pageid==2) {
							html += "<option value=\'"+e.id+"\'>"+e.category.toUpperCase()+"</option>";
							}
						} else if (hasdj) {
							if(e.pageid==10) {
							html += "<option value=\'"+e.id+"\'>"+e.category.toUpperCase()+"</option>";
							}
						} else {
							html += "<option value=\'"+e.id+"\'>"+e.category.toUpperCase()+"</option>";
						}
					} else {
						html += "<option value=\'"+e.id+"\'>"+e.category.toUpperCase()+"</option>";
					}
				});
				//return html;
				//html +="</select>";
				$(\'#jenis_category select\').html(html);
				//Custom.init();
			}
		},"JSON");
				
		$("#category_jenis").change(function(){
			 var category_jenis = $("#category_jenis").val();
			$(".valcategory").attr("value",category_jenis);
		});
	}
	
	function initpost(){
		$("#music").hide();
		$("#upload-image").hide();
		$("#upload-music").hide();
		$("#upload-video").hide();
		$("#pilih-mp3").hide();
		$("#pilih-image").hide();
		$("#pilih-video").hide();
		$("#create-band").hide();
		$("#create-dj").hide();
		$(\'.msg_page\').hide();
		$(\'#jenis_category\').hide();
		
        $("#jenis-info").change(function(){
            var jenis_info = $("#jenis-info").val();
			
			if (jenis_info!=\'\') {
				$(\'#jenis_category\').show();
				$.post(basedomain+\'post/getJenis\',{jenis_info:jenis_info},function(data){
					if(data) $(".valjenis").attr("value",data);
					else $(".valjenis").html("");
				},"JSON");
				
				categorypost(jenis_info);
				
				var htm = "";
				//htm += "<h3><img width=\'200\'src=\'"+basedomain+"assets/images/a-create.png\' /></h3>";
				htm += "<br>"
				if (jenis_info==3) htm += "<font size=\'4\'>"+localemsgkompetisi+" kickfest?</font></br>";
				if (jenis_info==6) htm += "<font size=\'4\'>"+localemsgkompetisi+" self portrait?</font></br>";				
				htm += "<input type=\'checkbox\' value=\'\' id=\'check_competition\' onclick=\'pilih_competition()\'>";
				htm += "<label> Yes </label>";
				if (jenis_info==6) $(\'.box_competition\').html(htm);
				else $(\'.box_competition\').html("");
			} else {
				$(\'#jenis_category\').hide();
				var htm = "";
				$(\'.box_competition\').html(htm);
			}
			if (jenis_info==3) {
					$("#pilih-video").hide();
					$("#pilih-image").hide();
					$("#upload-image").hide();
					$("#upload-music").hide();
					$("#upload-video").hide();
				if (hasband==\'\' && hasdj==\'\') {
					$("#music").show();
					$("#pilih-video").hide();
					$("#pilih-image").hide();
					$("#upload-image").hide();
					$("#upload-music").hide();
					$("#upload-video").hide();
				} else {
					if (immember!=\'\') {
						if (hasband!=\'\') {
							var html = "<font size=4>"+localeMemberPostMusic+" Band Page</font>";
							$(\'.msg_member_page\').html(html);
							
						} else if (hasdj!=\'\') {
							var html = "<font size=4>"+localeMemberPostMusic+" DJ Page</font>";
							$(\'.msg_member_page\').html(html);
						}
					} else {
						$("#music").show();
					}
				}
			}else if (jenis_info==\'\') {
				$(".valjenis").attr("value",\'\');
				$(\'.msg_member_page\').html(\'\');
				$("#upload-image").hide();
				$("#pilih-image").hide();
				$("#pilih-mp3").hide();
				$("#pilih-video").hide();
				$("#upload-music").hide();
				$("#upload-video").hide();
				$("#music").hide();
				$("#create-band").hide();
				$("#create-dj").hide();
				$(\'.msg_page\').hide(\'\');
			} else {
				$(\'.msg_member_page\').html(\'\');
				$(".looks-style").attr("idtype",jenis_info);
				if (jenis_info!=4) {
					$(".looks-style").hide();
					$(".picks-style").hide();
				} else {
					if ($(\'#check_competition\').val()==1){
						$(".looks-style").hide();
						$(".picks-style").hide();
					} else {
						$(".looks-style").show(); $(".looks-style").attr("style","");
						$(".picks-style").show(); $(".picks-style").attr("style","");
					}
				}
				$("#upload-image").show();
				$(".image-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
				$(".video-style").attr("style",\'\');
				$("#pilih-image").show();
				$("#pilih-mp3").hide();
				$("#pilih-video").hide();
				$("#upload-music").hide();
				$("#music").hide();
				$("#create-band").hide();
				$("#create-dj").hide();
				$(\'.msg_page\').hide(\'\');
			}
        });
		
        $("#upload-as").change(function(){
            var upload_as = $("#upload-as").val();
			if (upload_as!=\'\') {
				$(".typemusic").attr("value",upload_as);
				$.post(basedomain+\'myband/ajaxcekBand\',{upload_as:upload_as},function(data){
					if(data.band==0){
						$(\'.msg_page\').html(\'\');
						var html = "<font size=5>"+localepages.cek.band+"</font>";
						$(\'.msg_page\').html(html);
						$(\'.msg_page\').show();
						$("#upload-music").hide();
						$("#pilih-mp3").hide();
						$("#pilih-video").hide();
						$("#create-band").show();
						$("#create-dj").hide();
						$("#add_member_band").hide();
						$("#canceladdmember").hide();
					} else if(data.dj==0){
						$(\'.msg_page\').html(\'\');
						var html = "<font size=5>"+localepages.cek.dj+"</font>";
						$(\'.msg_page\').html(html);
						$(\'.msg_page\').show();
						$("#upload-music").hide();
						$("#pilih-mp3").hide();
						$("#pilih-video").hide();
						$("#create-band").hide();
						$("#create-dj").show();
						$("#add_member_dj").hide();
						$("#canceladdmemberdj").hide();
					} else {
						$("#create-band").hide();
						$("#create-dj").hide();
						$("#upload-music").show();
						$(".video-style").attr("style",\'\');
						$(".mp3-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
						$(".image-style").attr("style",\'\');
						$("#pilih-mp3").show();
						$("#pilih-video").hide();
					}
				},"JSON");
			} else {
				$("#upload-music").hide();
				$("#create-band").hide();
				$("#create-dj").hide();
				$("#pilih-mp3").hide();
				$("#pilih-video").hide();
				$(\'.msg_page\').hide(\'\');
				$("#pilih-image").hide();
			}
        });
		
		$(\'#btn-add-member\').click(function(){
			if( $("#member_id").val() == \'\' ){
				alert("Please put valid member name");
				return false;
			}
			$(\'#list-members\').append(\'<div class="add-member-load"></div>\');
			$.post(basedomain+\'myband/getInfoMember\',{id: $("#member_id").val() },
				function(data){
					if(data.sukses){
						var htm = "";
						htm += \'<td class="member-list" id="mem-\'+data.id+\'">\';
						htm +=    \'<a href="javascript:;" class="smallAvatar">\';
						if (data.img) {
							htm +=        \'<img width="100" src="\'+basedomain+\'public_assets/user/photo/\'+data.img+\'" /> \'+data.name+\'\';
						} else {
							htm +=        \'<img width="100" src="\'+basedomain+\'public_assets/user/photo/default.jpg" /> \'+data.name+\'\';
						}
						htm +=    \'</a>\';
						htm +=        \'<a href="javascript:;" class="memberName"></a>\';
						//htm +=        	\'<a class="edit" href="javascript:editMember(\'+data.id+\',\'+data.id+\',\\\'\'+data.name+\'\\\');"> Edit</a> |\';
						htm +=            \'&nbsp;<a class="delete" href="javascript:deleteMember(\'+data.id+\');">Delete</a>\';
						htm += \'</td>\';
						
						//not[data.id] = \',\'+data.id;
						$(\'.add-member-load\').empty().remove();
						$(\'#form-create-band\').append(\'<input class="cband-person" id="hmem-\'+data.id+\'" type="hidden" name="person[]" value="\'+data.id+\'[:]\'+$("#instrument").val()+\'" />\');
						
						$(\'#list-members\').append(htm).fadeIn();
						$("#members").val(data.id);
						$("#member_name").val("");
						$("#member_id").val("");
						$("#instrument").val("");
						$("#add-member").css("background","none");
					}
				},
				\'json\'
			);
		});
		
		$(\'#member_name\').keyup(function(){
			var kw = $(this).val();	
			if (kw!=\'\') {
				var delay = (function(){
					var timer = 0;
					return function(callback, ms){
					clearTimeout (timer);
					timer = setTimeout(callback, ms);
					};
				})();
			
				$(this).addClass("putloader");
				delay(function(){
					$.post(basedomain+\'myband/searchMember\',{kw:kw},
					function(data){
						if(data.m){
							var num = data.m.length;
							var htm = "";
							for(i=0;i<num;i++){
								htm += \'<tr><td>\';
								htm += \'	<a href="javascript:addMemberPages(\'+data.m[i].id+\',\\\'\'+data.m[i].name+\'\\\');">\';
								if (data.m[i].img) {
									htm += \'	<img width="70" height="70" src="\'+basedomain+\'public_assets/user/photo/\'+data.m[i].img+\'" style="vertical-align:middle;"  />&nbsp;&nbsp;\'+data.m[i].name+\'</a>\';
								} else {
									htm += \'	<img width="70" height="70" src="\'+basedomain+\'public_assets/user/photo/default.jpg" style="vertical-align:middle;"  />&nbsp;&nbsp;\'+data.m[i].name+\'</a>\';
								}
								htm += \'<td></tr>\';
							}
								$(\'#select-member\').html(htm);
								$(\'#select-member\').hide(\'fast\',function(){
									$(this).slideToggle();
								});
								$(\'#member_name\').removeClass("putloader");
						}else{
							var htm = "";
							$(\'#member_name\').show();
							htm += \'<a href="javascript:;">no result</a>\';
							$(\'#select-member\').html(htm);
							$(\'#select-member\').hide(\'fast\',function(){
								$(this).slideToggle();
							});
							$(\'#member_name\').removeClass("putloader");
						}
					},
					\'json\'
				);
				}, 1000 );
			} else {
				$(\'#select-member\').hide();			
			}
		});
		
		$(\'#btn-add-memberdj\').click(function(){
			if( $("#member_id").val() == \'\' ){
				alert("Please put valid member name");
				return false;
			}
			$(\'#list-membersdj\').append(\'<div class="add-member-load"></div>\');
			$.post(basedomain+\'mydj/getInfoMember\',{id: $("#member_id").val() },
				function(data){
					if(data.sukses){
						var htm = "";
						htm += \'<td class="member-list" id="mem-\'+data.id+\'">\';
						htm +=    \'<a href="javascript:;" class="smallAvatar">\';
						if (data.img) {
							htm +=        \'<img src="\'+basedomain+\'public_assets/user/photo/\'+data.img+\'" />\';
						} else {
							htm +=        \'<img src="\'+basedomain+\'public_assets/user/photo/default.jpg" />\';
						}
						htm +=    \'</a>\';
						htm +=        \'<a href="javascript:;" class="memberName">\'+data.name+\'</a>\';
						//htm +=        	\'<a class="edit" href="javascript:editMember(\'+data.id+\',\'+data.id+\',\\\'\'+data.name+\'\\\');"> Edit</a> |\';
						htm +=            \'<a class="delete" href="javascript:deleteMember(\'+data.id+\');">Delete</a>\';
						htm += \'</td>\';
						
						//not[data.id] = \',\'+data.id;
						$(\'.add-member-load\').empty().remove();
						$(\'#form-create-dj\').append(\'<input class="cband-person" id="hmem-\'+data.id+\'" type="hidden" name="person[]" value="\'+data.id+\'[:]\'+$("#instrumentdj").val()+\'" />\');
						
						$(\'#list-membersdj\').append(htm).fadeIn();
						$("#members").val(data.id);
						$("#memberdj_name").val("");
						$("#member_id").val("");
						$("#instrumentdj").val("");
						$("#add-member").css("background","none");
					}
				},
				\'json\'
			);
		});
		
		$(\'#memberdj_name\').keyup(function(){
			var kw = $(this).val();
			if (kw!=\'\') {
				var delay = (function(){
					var timer = 0;
					return function(callback, ms){
					clearTimeout (timer);
					timer = setTimeout(callback, ms);
					};
				})();
				//alert(kw);
				$(this).addClass("putloader");
				delay(function(){
					$.post(basedomain+\'mydj/searchMember\',{kw:kw},
					function(data){
						if(data.m){
							var num = data.m.length;
							var htm = "";
							for(i=0;i<num;i++){
								htm += \'<tr><td>\';
								htm += \'	<a href="javascript:addMemberPagesdj(\'+data.m[i].id+\',\\\'\'+data.m[i].name+\'\\\');">\';
								if (data.m[i].img) {
									htm += \'	<img width="70" height="70" src="\'+basedomain+\'public_assets/user/photo/\'+data.m[i].img+\'" style="vertical-align:middle;"  />&nbsp;&nbsp;\'+data.m[i].name+\'</a>\';
								} else {
									htm += \'	<img width="70" height="70" src="\'+basedomain+\'public_assets/user/photo/default.jpg" style="vertical-align:middle;"  />&nbsp;&nbsp;\'+data.m[i].name+\'</a>\';
								}
								htm += \'<td></tr>\';
							}
								$(\'#select-memberdj\').html(htm);
								$(\'#select-memberdj\').hide(\'fast\',function(){
									$(this).slideToggle();
								});
								$(\'#memberdj_name\').removeClass("putloader");
						}else{
							var htm = "";
							$(\'#memberdj_name\').show();
							htm += \'<a href="javascript:;">no result</a>\';
							$(\'#select-memberdj\').html(htm);
							$(\'#select-memberdj\').hide(\'fast\',function(){
								$(this).slideToggle();
							});
							$(\'#memberdj_name\').removeClass("putloader");
						}
					},
					\'json\'
				);
				}, 1000 );
			}else {
				$(\'#select-memberdj\').hide();			
			}
		});		
		
    };
	
	function idCategory(idcat) {
		$(".valcategory").attr("value",idcat);
	}
	
	function pilih_competition() {
		var idsub = $(".valjenis").val();
		if ($(\'#check_competition\').is(\':checked\')) $("#check_competition").attr("value",1);
		else $("#check_competition").attr("value",0);
		var status = $("#check_competition").val();
		
		if ($("#check_competition").val()==1) {
			$(".untags_image").show();
			$(".untags_mp3").show();
			$(".untags_video").show();
		} else {
			$(".untags_image").show();
			$(".untags_mp3").show();
			$(".untags_video").show();		
		}
		
		
		if (idsub==4) {
			if ($("#check_competition").val()==1) {
				$(".looks-style").hide();
				$(".picks-style").hide();
				$(".valstyle").attr("value","");
				$(".image-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
				$("#pilih-image").show();
				$(".video-style").attr("style",\'\');
				$("#pilih-video").hide();
				
			} else {
				$(".looks-style").show();
				$(".picks-style").show();
				$(".image-style").attr("style",\'\');
				$(".video-style").attr("style",\'\');
				$(".looks-style").attr("style",\'\');
				$(".picks-style").attr("style",\'\');
				$("#pilih-image").show();
			}
		} else if (idsub==3) {
			if ($(\'#check_competition\').is(\':checked\')) {
				$(".image-style").hide();
				$("#pilih-image").hide();
			} else {
				$(".image-style").show();
			}
		} else {
			$(".looks-style").hide();
			$(".picks-style").hide();
		}
		
		$(".cek_competition").attr("value",status);
	}
	
	function pilih_upload_image() {
		var idsub = $(".valjenis").val();
		var check_competition = $("#check_competition").val();
		
		$(".valstyle").attr("value","");
		if (idsub==4) {
			if ($(\'#check_competition\').val()==1){
				$(".looks-style").hide();
				$(".picks-style").hide();
				$("#pilih-image").show();
				$(".video-style").attr("style",\'\');
				$(".mp3-style").attr("style",\'\');
				$(".image-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
				$("#pilih-mp3").hide();
				$("#pilih-video").hide();
			} else {
				$(".looks-style").attr("style",\'\');
				$(".looks-style").show();
				$(".picks-style").attr("style",\'\');
				$(".picks-style").show();
				$("#pilih-image").show();
				$(".video-style").attr("style",\'\');
				$(".mp3-style").attr("style",\'\');
				$(".image-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
				$("#pilih-mp3").hide();
				$("#pilih-video").hide();		
			}
		} else {
			$(".looks-style").hide();
			$(".picks-style").hide();			
			$(".video-style").attr("style",\'\');
			$("#pilih-video").hide();
			$(".mp3-style").attr("style",\'\');
			$("#pilih-mp3").hide();
			$(".image-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
			$("#pilih-image").show();
		}
		
		if (idsub==3) {
			if (check_competition==1) {
				$(".image-style").hide();
				$("#pilih-image").hide();
			} else {
				$(".image-style").show();
			}
		}
	}
	
	function pilih_upload_looks() {
		$("#pilih-image").show();
		$(".video-style").attr("style",\'\');
		$(".mp3-style").attr("style",\'\');
		$(".image-style").attr("style",\'\');
		$(".picks-style").attr("style",\'\');
		$(".looks-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
		$("#pilih-mp3").hide();
		$("#pilih-video").hide();
		$(".valstyle").attr("value","looks");
	}
	
	function pilih_upload_picks() {
		$("#pilih-image").show();
		$(".video-style").attr("style",\'\');
		$(".mp3-style").attr("style",\'\');
		$(".image-style").attr("style",\'\');
		$(".looks-style").attr("style",\'\');
		$(".picks-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
		$("#pilih-mp3").hide();
		$("#pilih-video").hide();
		$(".valstyle").attr("value","picks");
	}
	
	function pilih_upload_mp3() {
		var idsub = $(".valjenis").val();
		var check_competition = $("#check_competition").val();
		
		$("#pilih-mp3").show();
		$(".video-style").attr("style",\'\');
		$(".image-style").attr("style",\'\');
		$(".looks-style").attr("style",\'\');
		$(".picks-style").attr("style",\'\');
		$(".mp3-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
		$("#pilih-image").hide();
		$("#pilih-video").hide();
		
		if (idsub==3) {
			if (check_competition==1) {
				$(".image-style").hide();
				$("#pilih-image").hide();
			} else {
				$(".image-style").show();
			}
		}
	}
	
	function pilih_upload_video() {
		var idsub = $(".valjenis").val();
		var check_competition = $("#check_competition").val();
		
		$(".valstyle").attr("value","");
		if (idsub==4) {
			if ($(\'#check_competition\').val()==1){
				$(".looks-style").hide();
				$(".picks-style").hide();
				$("#pilih-mp3").hide();
				$("#pilih-image").hide();
				$(".mp3-style").attr("style",\'\');
				$(".image-style").attr("style",\'\');
				$(".video-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
				$("#pilih-video").show();
			} else {
				$("#pilih-mp3").hide();
				$("#pilih-image").hide();
				$(".mp3-style").attr("style",\'\');
				$(".image-style").attr("style",\'\');
				$(".looks-style").attr("style",\'\');
				$(".picks-style").attr("style",\'\');	
				$(".video-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
				$("#pilih-video").show();
			}
		} else {
			$(".looks-style").hide();
			$(".picks-style").hide();
			$(".video-style").attr("style",\'background-color:#E40404;color:#F2F2F2\');
			$("#pilih-video").show();
			$(".image-style").attr("style",\'\');
			$(".mp3-style").attr("style",\'\');
			$("#pilih-image").hide();
			$("#pilih-mp3").hide();
		}
		
		if (idsub==3) {
			if (check_competition==1) {
				$(".image-style").hide();
				$("#pilih-image").hide();
			} else {
				$(".image-style").show();
			}
		}
	}
	
	function linkaddmemberband() {
		$("#add_member_band").show();
		$("#canceladdmember").show();
	}
	
	function cancellinkband() {
		$("#add_member_band").hide();
		$("#canceladdmember").hide();
	}
	
	function linkaddmemberdj() {
		$("#add_member_dj").show();
		$("#canceladdmemberdj").show();
	}
	
	function cancellinkdj() {
		$("#add_member_dj").hide();
		$("#canceladdmemberdj").hide();
	}
	
	function addMember(id,name){
		$("#member_name").val(name);
		$("#member_id").val(id);
		$(\'#select-member\').hide();
		//$("#add-member").css("background","none");
	}	
	
	function addMemberPages(id,name){
		$(\'#list-members\').append(\'<div class="add-member-load"></div>\');var htm = "";
		$.post(basedomain+\'myband/getInfoMember\',{id: id },
			function(data){
				if(data.sukses){
					var htm = "";
					htm += \'<tr id="mem-\'+data.id+\'">\';
					htm += \'<td class="member-list" >\';
					htm +=    \'<a href="javascript:;" class="smallAvatar">\';
					if (data.img) {
						htm +=        \'<img width="70" height="70" src="\'+basedomain+\'public_assets/user/photo/\'+data.img+\'" />\';
					} else {
						htm +=        \'<img width="70" height="70" src="\'+basedomain+\'public_assets/user/photo/default.jpg" />\';
					}
					htm +=    \'</a>\';
					htm += \'</td>\';
					htm += \'<td width=3>&nbsp;</td>\';
					htm += \'<td width=300>\';
					htm +=        \'<a href="javascript:void(0)" class="memberName"></a>\';
					htm += 			data.name;
					htm +=            \'&nbsp;&nbsp;<a class="delete" href="javascript:deleteMember(\'+data.id+\');">Delete</a><br>\';
					htm += \'    INSTRUMENT <input type="text" id="instrument_\'+data.id+\'" name="instrument[\'+data.id+\']" size="20" value="" />\';
					htm += \'</td>\';
					htm += \'</tr>\';
					
					$(\'.add-member-load\').empty().remove();
					$(\'#form-create-band\').append(\'<input class="cband-person" id="hmem-\'+data.id+\'" type="hidden" name="person[\'+data.id+\']" value="\'+data.id+\'" />\');
					
					$(\'#list-members\').append(htm).fadeIn();
					$("#members").val(data.id);
					$("#member_name").val("");
					$("#member_id").val("");
					$("#instrument").val("");
					$("#add-member").css("background","none");
				}
			},
			\'json\'
		);
		$(\'#select-member\').hide();
	}
	
	function addMemberPagesdj(id,name){
		$(\'#list-membersdj\').append(\'<div class="add-member-load"></div>\');var htm = "";
		$.post(basedomain+\'mydj/getInfoMember\',{id: id },
			function(data){
				if(data.sukses){
					var htm = "";
					htm += \'<tr id="mem-\'+data.id+\'">\';
					htm += \'<td class="member-list" >\';
					htm +=    \'<a href="javascript:;" class="smallAvatar">\';
					if (data.img) {
						htm +=        \'<img width="70" height="70" src="\'+basedomain+\'public_assets/user/photo/\'+data.img+\'" />\';
					} else {
						htm +=        \'<img width="70" height="70" src="\'+basedomain+\'public_assets/user/photo/default.jpg" />\';
					}
					htm +=    \'</a>\';
					htm += \'</td>\';
					htm += \'<td width=3>&nbsp;</td>\';
					htm += \'<td width=300>\';
					htm +=        \'<a href="javascript:;" class="memberName"></a>\';
					htm += 			data.name;
					htm +=            \'&nbsp; &nbsp;|&nbsp; &nbsp;<a class="delete" href="javascript:deleteMember(\'+data.id+\');">Delete</a><br>\';
					htm += \'    INSTRUMENT <input type="text" id="instrument_\'+data.id+\'" name="instrument[\'+data.id+\']" size="20" value="" />\';
					htm += \'</td>\';
					htm += \'</tr>\';
					
					$(\'.add-member-load\').empty().remove();
					$(\'#form-create-dj\').append(\'<input class="cband-person" id="hmem-\'+data.id+\'" type="hidden" name="person[]" value="\'+data.id+\'" />\');
					
					$(\'#list-membersdj\').append(htm).fadeIn();
					$("#members").val(data.id);
					$("#member_name").val("");
					$("#member_id").val("");
					$("#instrument").val("");
					$("#add-member").css("background","none");
				}
			},
			\'json\'
		);
		$(\'#select-member\').hide();
	}
	
	function addMemberdj(id,name){
		$("#memberdj_name").val(name);
		$("#member_id").val(id);
		$(\'#select-memberdj\').hide();
		//$("#add-member").css("background","none");
	}
	
	function editMember(el,id,name,instru){
		$("#mem-"+el).remove();
		$("#hmem-"+el).remove();
		not[id] = "";
		$("#member_name").val(name);
		$("#member_id").val(id);
		$("#instrument").val(instru);
		$(\'#select-member\').hide();
		$("#add-member").css("background","#E01A22");
	}
	
	function deleteMember(id){
		$("#mem-"+id).remove();
		$("#hmem-"+id).remove();
		$(\'#select-member\').hide();
	}	
	
	//CEK FORM CREATE BAND & POST BY (AJAX)
	$(document).on(\'click\',\'.doPostCreateBand\', function(){
		if($(\'#cband-name\').val()==\'Nama Band\'){
			var htm = "<font size=4>"+localepages.cek.namaband+"</font>";
			$(\'.msg_formCreateBand\').html(htm);
			return false;
		}
		
		if($(\'#cityband\').val()==\'\'){
			var htm = "<font size=4>"+localecityband+"</font>";
			$(\'.msg_formCreateBand\').html(htm);
			return false;
		}
		
		if($(\'#genre\').val()==\'\'){
			var htm = "<font size=4>"+localegenreband+"</font>";
			$(\'.msg_formCreateBand\').html(htm);
			return false;
		}
		
		if ($(\'#setuju_createBand\').is(\':checked\')){
		
		} else {
			var htm = "<font size=4>"+localepages.cek.syarat+"</font>";
			$(\'.msg_formCreateBand\').html(htm);
			return false;
		}
		
	});	
	
	//CEK FORM CREATE DJ & POST BY (AJAX)
	$(document).on(\'click\',\'.doPostCreateDJ\', function(){
		if ($(\'#name_dj\').val()=="Nama DJ") {
			var htm = "<font size=4>"+localepages.cek.namadj+"</font>";
			$(\'.msg_formCreateDJ\').html(htm);
			return false;
		}
		if($(\'#citydj\').val()==\'\'){
			var htm = "<font size=4>"+localecitydj+"</font>";
			$(\'.msg_formCreateDJ\').html(htm);
			return false;
		}if($(\'#genredj\').val()==\'\'){
			var htm = "<font size=4>"+localegenredj+"</font>";
			$(\'.msg_formCreateDJ\').html(htm);
			return false;
		}
		if ($(\'#setuju_createDJ\').is(\':checked\')){
		
		}else{
			var htm = "<font size=4>"+localepages.cek.syarat+"</font>";
			$(\'.msg_formCreateDJ\').html(htm);
			return false;
		}
	});	
	
	//CEK FORM POST IMAGE & POST BY (AJAX)
	$(document).on(\'click\',\'.doPostImage\', function(){
		if($(\'#title_postimage\').val()==\'Title\'){
			var htm = "<font size=4>Title mohon di isi!</font>";
			$(\'.msg_formpostimage\').html(htm);
			return false;
		}
		if($(\'#content_postimage\').val()==\'Description\'){
			var htm = "<font size=4>Deskripsi mohon di isi!</font>";
			$(\'.msg_formpostimage\').html(htm);
			return false;
		}
		if($(\'#file_postimage\').val()==\'\'){
			var htm = "<font size=4>File Image mohon di isi!</font>";
			$(\'.msg_formpostimage\').html(htm);
			return false;
		}
		if ($(\'#check_postimage\').is(\':checked\')){
			
		} else {
			var htm = "<font size=4>"+localepages.cek.syarat+"</font>";
			$(\'.msg_formpostimage\').html(htm);
			return false;
		}
		
	});
	
	//CEK FORM POST MP3 & POST BY (AJAX)
	$(document).on(\'click\',\'.doPostmp3\', function(){
		if($(\'#title_postmp3\').val()==\'Title\'){
			var htm = "<font size=4>Title mohon di isi!</font>";
			$(\'.msg_formpostmp3\').html(htm);
			return false;
		}
		if($(\'#content_postmp3\').val()==\'Description\'){
			var htm = "<font size=4>Deskripsi mohon di isi!</font>";
			$(\'.msg_formpostmp3\').html(htm);
			return false;
		}
		if($(\'#file_postmp3\').val()==\'\'){
			var htm = "<font size=4>File Mp3 mohon di isi!</font>";
			$(\'.msg_formpostmp3\').html(htm);
			return false;
		}
		if ($(\'#check_postmp3\').is(\':checked\')){
			
		} else {
			var htm = "<font size=4>"+localepages.cek.syarat+"</font>";
			$(\'.msg_formpostmp3\').html(htm);
			return false;
		}		
	});
	
	//CEK FORM POST VIDEO & POST BY (AJAX)
	$(document).on(\'click\',\'.doPostvideo\', function(){
		if($(\'#title_postvideo\').val()==\'Title\'){
			var htm = "<font size=4>Title mohon di isi!</font>";
			$(\'.msg_formpostvideo\').html(htm);
			return false;
		}
		if($(\'#content_postvideo\').val()==\'Description\'){
			var htm = "<font size=4>Deskripsi mohon di isi!</font>";
			$(\'.msg_formpostvideo\').html(htm);
			return false;
		}
		if($(\'#url_postvideo\').val()==\'URL File\'){
			var htm = "<font size=4>URL video mohon di isi!</font>";
			$(\'.msg_formpostvideo\').html(htm);
			return false;
		}
		if ($(\'#check_postvideo\').is(\':checked\')){
			
		} else {
			var htm = "<font size=4>"+localepages.cek.syarat+"</font>";
			$(\'.msg_formpostvideo\').html(htm);
			return false;
		}		
	});
	
	//CEK SIZE FILE IMAGE CREATE BAND
	function getSizeBandImage() {
		$(\'#file_bandimage\').bind(\'change\', function() {
			if (this.files[0].size > 200000) {
				var htm = "<font size=4>Ukuran file terlalu besar!</font>";
				$(\'.msg_formCreateBand\').html(htm);
				return false;
			} else {
				$(\'.msg_formCreateBand\').html("");
				return false;
			}
		});
	}
	
	//CEK SIZE FILE IMAGE CREATE DJ
	function getSizeDjImage() {
		$(\'#file_djimage\').bind(\'change\', function() {
			if (this.files[0].size > 200000) {
				var htm = "<font size=4>Ukuran file terlalu besar!</font>";
				$(\'.msg_formCreateDJ\').html(htm);
				return false;
			} else {
				$(\'.msg_formCreateDJ\').html("");
				return false;
			}
		});
	}
	
	//CEK SIZE FILE POST IMAGE
	function getSize() {
		$(\'#file_postimage\').bind(\'change\', function() {
			//alert(this.files[0].size);
			if (this.files[0].size > 2000000) {
				var htm = "<font size=4>Ukuran file terlalu besar!</font>";
				$(\'.msg_formpostimage\').html(htm);
				return false;
			} else {
				$(\'.msg_formpostimage\').html("");
				return false;
			}
		});
	}
	
	//CEK SIZE FILE POST MP3
	function getSizemp3() {
		$(\'#file_postmp3\').bind(\'change\', function() {
			//alert(this.files[0].size);
			if (this.files[0].size > 5000000) {
				var htm = "<font size=4>Ukuran file mp3 terlalu besar!</font>";
				$(\'.msg_formpostmp3\').html(htm);
				return false;
			} else {
				$(\'.msg_formpostmp3\').html("");
				return false;
			}
		});
	}
</script>
'; ?>