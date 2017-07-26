<?php include_once "db.php";class dashboardbot extends db{	function __construct(){			$this->webdb_schema = "amild_athreesix_web_2013";		$this->reportdb_schema = "rendra_athreesix_report_2013";				$this->datestart = date("Y-m-d", strtotime("-7 days"));		/* $this->datestart = "2013-04-12"; */						}	function top10useractivitypersubcultere(){			/* top 10 user activity per subculture */		$sql = "			SELECT count(*) num, action_id , ctn.title , ctn.articleType,action.activityName,type.type, DATE(log.date_time)dateday				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content ctn ON log.action_value = ctn.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content_type type ON ctn.articleType = type.id 			WHERE 			ctn.articleType IN (3,4,5,6,15) 			AND action.id IN (2,7,10,11,16,17,15,22,30)			AND log.date_time >= '{$this->datestart}'			GROUP BY action_id, ctn.articleType,dateday			ORDER BY articleType DESC,num DESC				";		$this->setSocketDB(0);		$qData = $this->fetch($sql,1);		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "			INSERT INTO  {$this->reportdb_schema}.usr_activity_subculture (num,action_id,title,articleType,activityName,type,dateday)			VALUES			('{$data->num}','{$data->action_id}',\"{$data->title}\",'{$data->articleType}','{$data->activityName}','{$data->type}','{$data->dateday}')			ON DUPLICATE KEY UPDATE			num = '{$data->num}', action_id='{$data->action_id}',title=\"{$data->title}\",articleType='{$data->articleType}',activityName='{$data->activityName}',type='{$data->type}',dateday='{$data->dateday}'			";						$datas[] = $this->query($sql);				}			print_r($datas);	}	function topvisitedpage(){			/* top 10 visited page */		$sql = "SELECT count(*) num, user_id, action_value, DATE(log.date_time)dateday				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id					WHERE log.user_id <> 0 				AND log.action_id = 6				AND log.date_time >= '{$this->datestart}'				GROUP BY action_value,dateday				ORDER BY dateday DESC, num DESC ";		$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.top_visited_page (num, user_id, action_value, dateday)					VALUES ('{$data->num}','{$data->user_id}','{$data->action_value}','{$data->dateday}')					ON DUPLICATE KEY UPDATE 					num='{$data->num}',user_id='{$data->user_id}',action_value='{$data->action_value}',dateday='{$data->dateday}'";			$datas[] = $this->query($sql);		}		print_r($datas);	}	function top3visitedcontentpersubculture(){			/* top 3 visited content page from each subculture */		$sql = "SELECT count(*) num,  action_value, log.user_id, cont.title, type.type, articleType,DATE(log.date_time)dateday				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content cont ON cont.id = log.action_value				LEFT JOIN {$this->webdb_schema}.athreesix_news_content_type type ON type.id = cont.articleType				WHERE log.user_id <> 0 				AND log.action_id = 2				AND articleType IN (3,4,5,6,15) 				AND log.date_time >= '{$this->datestart}'				GROUP BY action_value,dateday				ORDER BY  articleType  DESC ,num DESC";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.top_visited_page_subculture (num, action_value, user_id, title, type, articleType, dateday)					VALUES ('{$data->num}','{$data->action_value}',							'{$data->user_id}',\"{$data->title}\",\"{$data->type}\",							'{$data->articleType}','{$data->dateday}') 					ON DUPLICATE KEY UPDATE							num='{$data->num}',action_value='{$data->action_value}',user_id='{$data->user_id}',title=\"{$data->title}\",type=\"{$data->type}\",articleType='{$data->articleType}',dateday='{$data->dateday}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}	function top5activitycontent(){		/* top 5 viewed/played/blabla */		$sql = "SELECT count(*) num, action_id , ctn.title , ctn.articleType, action.activityName, type.type, DATE(date_time)dateday				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content ctn ON log.action_value = ctn.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content_type type ON ctn.articleType = type.id 				WHERE ctn.articleType IN (3,4,5,6,15) AND action.id IN (2,16,22)				AND log.date_time >= '{$this->datestart}'				GROUP BY action_id, action_value ,ctn.articleType, dateday ORDER BY articleType DESC,num DESC";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.top_content_vpd (num, action_id, title, articleType, activityName, type, dateday)					VALUES ('{$data->num}','{$data->action_id}',\"{$data->title}\",					'{$data->articleType}',\"{$data->activityName}\",\"{$data->type}\", '{$data->dateday}')					ON DUPLICATE KEY UPDATE num='{$data->num}',action_id='{$data->action_id}',title=\"{$data->title}\",articleType='{$data->articleType}',activityName=\"{$data->activityName}\",type=\"{$data->type}\", dateday='{$data->dateday}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}	function top10liked(){		/* top 10 liked*/		$sql = "SELECT count(*) num, action_id, activityName, sm.name, log.user_id, sm.img, DATE(date_time)dateday, sm.sex				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content ctn ON log.action_value = ctn.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content_type type ON ctn.articleType = type.id 				LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id 				WHERE 				ctn.articleType IN (3,4,5,6,15) 				AND action.id IN (11)				AND log.date_time >= '{$this->datestart}'				GROUP BY action_id, action_value ,ctn.articleType				ORDER BY articleType DESC,num DESC";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.usr_activity_like (num, action_id,activityName,name,user_id,img,dateday,sex)					VALUES ('{$data->num}','{$data->action_id}',\"{$data->activityName}\",\"{$data->name}\",					'{$data->user_id}',\"{$data->img}\", '{$data->dateday}',\"{$data->sex}\")					ON DUPLICATE KEY UPDATE num='{$data->num}',action_id='{$data->action_id}',activityName=\"{$data->activityName}\",name=\"{$data->name}\",user_id='{$data->user_id}',img=\"{$data->img}\", dateday='{$data->dateday}', sex=\"{$data->sex}\"";		$datas[] = $this->query($sql);		}		print_r($datas);			}	function top10comment(){		/* top 10 comment*/		$sql = "SELECT count(*) num, action_id, activityName, sm.name, log.user_id, sm.img, DATE(date_time)dateday, sm.sex				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content ctn ON log.action_value = ctn.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content_type type ON ctn.articleType = type.id 				LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id 				WHERE 				ctn.articleType IN (3,4,5,6,15) 				AND action.id IN (10)				AND log.date_time >= '{$this->datestart}'				GROUP BY action_id, action_value ,ctn.articleType				ORDER BY articleType DESC,num DESC";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.usr_activity_comment (num, action_id,activityName,name,user_id,img,dateday,sex)					VALUES ('{$data->num}','{$data->action_id}',\"{$data->activityName}\",\"{$data->name}\",					'{$data->user_id}',\"{$data->img}\", '{$data->dateday}',\"{$data->sex}\")					ON DUPLICATE KEY UPDATE num='{$data->num}',action_id='{$data->action_id}',activityName=\"{$data->activityName}\",name=\"{$data->name}\",user_id='{$data->user_id}',img=\"{$data->img}\", dateday='{$data->dateday}', sex=\"{$data->sex}\"";		$datas[] = $this->query($sql);		}		print_r($datas);	}	function top10download(){		/* top 10 download*/		$sql = "SELECT count(*) num, action_id, activityName, sm.name, log.user_id, sm.img, DATE(date_time)dateday, sm.sex				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content ctn ON log.action_value = ctn.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content_type type ON ctn.articleType = type.id 				LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id 				WHERE 				ctn.articleType IN (3,4,5,6,15) 				AND action.id IN (22)				AND log.date_time >= '{$this->datestart}'				GROUP BY action_id, action_value ,ctn.articleType				ORDER BY articleType DESC,num DESC";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.usr_activity_download (num, action_id,activityName,name,user_id,img,dateday,sex)					VALUES ('{$data->num}','{$data->action_id}',\"{$data->activityName}\",\"{$data->name}\",					'{$data->user_id}',\"{$data->img}\", '{$data->dateday}',\"{$data->sex}\")					ON DUPLICATE KEY UPDATE num='{$data->num}',action_id='{$data->action_id}',activityName=\"{$data->activityName}\",name=\"{$data->name}\",user_id='{$data->user_id}',img=\"{$data->img}\", dateday='{$data->dateday}', sex=\"{$data->sex}\"";		$datas[] = $this->query($sql);		}		print_r($datas);	}	function top10upload(){		/* top 10 uplaod */		$sql = "SELECT count(*) num, action_id, activityName, sm.name, log.user_id, sm.img, DATE(date_time)dateday, sm.sex				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content ctn ON log.action_value = ctn.id 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content_type type ON ctn.articleType = type.id 				LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id 				WHERE 				ctn.articleType IN (3,4,5,6,15) 				AND action.id IN (7)				AND log.date_time >= '{$this->datestart}'				GROUP BY action_id, action_value ,ctn.articleType				ORDER BY articleType DESC,num DESC";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.usr_activity_upload (num, action_id,activityName,name,user_id,img,dateday,sex)					VALUES ('{$data->num}','{$data->action_id}',\"{$data->activityName}\",\"{$data->name}\",					'{$data->user_id}',\"{$data->img}\", '{$data->dateday}',\"{$data->sex}\")					ON DUPLICATE KEY UPDATE num='{$data->num}',action_id='{$data->action_id}',activityName=\"{$data->activityName}\",name=\"{$data->name}\",user_id='{$data->user_id}',img=\"{$data->img}\", dateday='{$data->dateday}', sex=\"{$data->sex}\"";		$datas[] = $this->query($sql);		}		print_r($datas);	}	function mostviewedusers(){		/* Most viewed users all time (accumulation) by Number of unique user and by Frequency of viewed */		$sql = "SELECT count(*) num, action_id , action_value, user_id, sm.name, sm.img, DATE(date_time)dateday				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.social_member sm ON log.action_value = sm.id 				WHERE 				action.id IN (24)				AND log.date_time >= '{$this->datestart}'				GROUP BY action_value, dateday				ORDER BY num DESC";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.usr_most_view (num, action_id,action_value,user_id,name,img,dateday)					VALUES ('{$data->num}','{$data->action_id}','{$data->action_value}','{$data->user_id}',					\"{$data->name}\",\"{$data->img}\", '{$data->dateday}')					ON DUPLICATE KEY UPDATE num='{$data->num}',action_id='{$data->action_id}',action_value='{$data->action_value}',user_id='{$data->user_id}',name=\"{$data->name}\",img=\"{$data->img}\", dateday='{$data->dateday}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}	function mostvieweduserweekly(){		/* Most viewed users weekly */		$sql = "SELECT COUNT(*)  num, action_id , action_value, name,dateday, sex, user_id, img				FROM (				SELECT count(*) num, action_id , action_value, sm.name, user_id, DATE(date_time)dateday,WEEK(log.date_time)weekday, sm.sex, sm.img				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.social_member sm ON log.action_value = sm.id 				WHERE 				action.id IN (24)				AND log.date_time >= '{$this->datestart}'				GROUP BY user_id, action_value,weekday				ORDER BY num DESC				) a				GROUP BY action_value,dateday				ORDER BY num DESC";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.user_weekly (num, action_id,action_value,name,dateday,sex,user_id,img)					VALUES ('{$data->num}','{$data->action_id}','{$data->action_value}',\"{$data->name}\",					'{$data->dateday}',\"{$data->sex}\", '{$data->user_id}',\"{$data->img}\")					ON DUPLICATE KEY UPDATE num='{$data->num}',action_id='{$data->action_id}',					action_value='{$data->action_value}',name=\"{$data->name}\",dateday='{$data->dateday}',sex=\"{$data->sex}\", user_id='{$data->user_id}', img=\"{$data->img}\"";		$datas[] = $this->query($sql);		}		print_r($datas);			}	function mostfriendsuser(){		/* most friend */		$sql = "SELECT COUNT(*)num , userid , sm.name, DATE(date_time) dateday		FROM {$this->webdb_schema}.my_circle cirlce		LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = cirlce.userid		WHERE 				date_time >= '{$this->datestart}'		GROUP BY userid,dateday		ORDER BY num DESC";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.usr_based_on (num, userid,name,dateday)					VALUES ('{$data->num}','{$data->userid}',\"{$data->name}\",'{$data->dateday}')					ON DUPLICATE KEY UPDATE 					num='{$data->num}',userid='{$data->userid}',name=\"{$data->name}\",dateday='{$data->dateday}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}	function top10userperuseractivity(){		/* top 10 user per user activity */		$sql = "SELECT count(*) num, action_id , action.activityName, sm.name, sm.img , DATE(log.date_time) dateday, log.user_id				FROM {$this->webdb_schema}.tbl_activity_log log 				LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 				LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id					WHERE 				log.user_id <> 0 					AND log.date_time >= '{$this->datestart}'				GROUP BY action_id,log.user_id, dateday				ORDER BY  log.action_id ,num DESC"; 				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.usr_activity_per_usr (num, action_id,activityName,name,img,dateday,user_id)					VALUES ('{$data->num}','{$data->action_id}',\"{$data->activityName}\",\"{$data->name}\",					\"{$data->img}\", '{$data->dateday}','{$data->user_id}')					ON DUPLICATE KEY UPDATE num='{$data->num}',action_id='{$data->action_id}',activityName=\"{$data->activityName}\",name=\"{$data->name}\",img=\"{$data->img}\", dateday='{$data->dateday}',user_id='{$data->user_id}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}	function top10artistcontent(){		/* top 10 artist and content, */		$sql = "SELECT count(*) num, action_id , ctn.title , ctn.articleType,action.activityName,type.type, DATE(log.date_time) dateday, 			CASE ctn.fromwho 				  WHEN '0' THEN gmuser.name 				  WHEN '1' THEN sm.name				  ELSE  pages.name 			END	AS names			, CASE ctn.fromwho 				  WHEN '0' THEN 'user_'+gmuser.id 				  WHEN '1' THEN 'user_'+sm.id				  ELSE  'user_'+pages.id 			END	AS userid			, CASE ctn.fromwho 				  WHEN '0' THEN 'U'				  WHEN '1' THEN sm.sex				  ELSE  'UB'			END	AS gender			FROM {$this->webdb_schema}.tbl_activity_log log 			LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 			LEFT JOIN {$this->webdb_schema}.athreesix_news_content ctn ON log.action_value = ctn.id 			LEFT JOIN {$this->webdb_schema}.athreesix_news_content_type type ON ctn.articleType = type.id 			LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = ctn.authorid				LEFT JOIN {$this->webdb_schema}.my_pages pages ON pages.id = ctn.authorid				LEFT JOIN {$this->webdb_schema}.gm_member gmuser ON gmuser.id = ctn.authorid			WHERE 		ctn.articleType IN (3,4,5,6,15)		AND action.id IN (2,10,11,16,22)				AND log.date_time >= '{$this->datestart}'		GROUP BY action_id, action_value ,ctn.articleType,dateday		ORDER BY articleType DESC,num DESC";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.most_viewed_artist (num,action_id,title,articleType,activityName,type,dateday,names,userid,gender)					VALUES ('{$data->num}','{$data->action_id}',\"{$data->title}\",'{$data->articleType}',					\"{$data->activityName}\",\"{$data->type}\", '{$data->dateday}',\"{$data->names}\",'{$data->userid}',\"{$data->gender}\")					ON DUPLICATE KEY UPDATE num='{$data->num}',action_id='{$data->action_id}',title=\"{$data->title}\",					articleType='{$data->articleType}', activityName=\"{$data->activityName}\", type=\"{$data->type}\", dateday='{$data->dateday}', names=\"{$data->names}\", userid='{$data->userid}', gender=\"{$data->gender}\"					";		$datas[] = $this->query($sql);		}		print_r($datas);			}	function top5contentsearch(){		/* top 5 content search by keyword, */		$sql = "SELECT COUNT(*)  num, user_id, action_id , action_value, name,dateday		FROM (		SELECT count(*) num, action_id , action_value, sm.name, user_id, DATE(log.date_time) dateday			FROM {$this->webdb_schema}.tbl_activity_log log 			LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 			LEFT JOIN {$this->webdb_schema}.social_member sm ON log.action_value = sm.id 		WHERE 		action.id IN (32)				AND log.date_time >= '{$this->datestart}'		GROUP BY user_id, action_value,dateday		ORDER BY num DESC		) a		GROUP BY action_value,dateday		ORDER BY num DESC";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.top_content_search (num, user_id, action_id, action_value, name, dateday)					VALUES ('{$data->num}','{$data->user_id}','{$data->action_id}',\"{$data->action_value}\",					\"{$data->name}\",'{$data->dateday}')					ON DUPLICATE KEY UPDATE num='{$data->num}', user_id='{$data->user_id}', action_id='{$data->action_id}', action_value=\"{$data->action_value}\", name=\"{$data->name}\", dateday='{$data->dateday}'";		$datas[] = $this->query($sql);		}		print_r($datas);			}		function top10activeuser(){		/* top ten active user - day		 top ten super user - week		 top ten very active user - month		*/						$sql = "SELECT COUNT(*)  num, action_id ,name,dateday,sex,userid,img		FROM (		SELECT count(*) num, action_id , action.activityName, sm.name,log.user_id userid, DATE(log.date_time) dateday ,action_value,sm.sex,sm.img			FROM {$this->webdb_schema}.tbl_activity_log log 			LEFT JOIN {$this->webdb_schema}.tbl_activity_actions action ON log.action_id = action.id 			LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id			WHERE 		log.action_id = 1		AND log.user_id <> 0 				AND log.date_time >= '{$this->datestart}'		GROUP BY log.user_id,dateday		ORDER BY  log.action_id ,num DESC 		)a		GROUP BY userid		ORDER BY num DESC";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.user_monthly (num, action_id, name, dateday, sex, userid, img)					VALUES ('{$data->num}','{$data->action_id}',\"{$data->name}\",'{$data->dateday}',					\"{$data->sex}\",'{$data->userid}', \"{$data->img}\")					ON DUPLICATE KEY UPDATE num='{$data->num}', action_id='{$data->action_id}', name=\"{$data->name}\", dateday='{$data->dateday}', sex=\"{$data->sex}\", userid='{$data->userid}', img=\"{$data->img}\"";		$datas[] = $this->query($sql);		}		print_r($datas);			}		function userRegistrant(){		$sql = "SELECT count( * ) num, DATE_FORMAT( register_date, '%Y-%m-%d' ) datetime, sex				FROM {$this->webdb_schema}.social_member WHERE register_date >= '{$this->datestart}'				GROUP BY sex, datetime ORDER BY datetime";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.user_registrant (num, datetime, sex)					VALUES ('{$data->num}','{$data->datetime}','{$data->sex}')					ON DUPLICATE KEY UPDATE num='{$data->num}', datetime='{$data->datetime}', sex='{$data->sex}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}		function userunverif(){		$sql = "SELECT count( * ) num, sex, DATE_FORMAT( register_date, '%Y-%m-%d' ) datetime				FROM {$this->webdb_schema}.social_member				WHERE n_status =0 AND register_date >= '{$this->datestart}'				GROUP BY datetime				ORDER BY datetime";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.user_unverified (num, sex,datetime)					VALUES ('{$data->num}','{$data->sex}','{$data->datetime}')					ON DUPLICATE KEY UPDATE num='{$data->num}', sex='{$data->sex}', datetime='{$data->datetime}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}			function logindaily(){		$sql = "SELECT COUNT(*) num, datetime,sex				FROM 				(				SELECT count( * ) num, DATE_FORMAT( log.date_time, '%Y-%m-%d' ) datetime, sm.sex				FROM {$this->webdb_schema}.tbl_activity_log log				LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id				WHERE log.action_id =1 AND log.date_time >= '{$this->datestart}' AND sm.n_status = 1				GROUP BY sm.sex, datetime,user_id					ORDER BY datetime				) a				GROUP BY datetime,sex				ORDER BY datetime";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.login_user_daily (num, datetime, sex)					VALUES ('{$data->num}','{$data->datetime}','{$data->sex}')					ON DUPLICATE KEY UPDATE num='{$data->num}', datetime='{$data->datetime}', sex='{$data->sex}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}		function logindailyactive(){		$sql = "SELECT COUNT(*) num, datetime,sex				FROM 				(					SELECT count( * ) num, DATE_FORMAT( log.date_time, '%Y-%m-%d' ) datetime, sm.sex					FROM {$this->webdb_schema}.tbl_activity_log log					LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id					WHERE log.action_id =1 AND log.date_time >= '{$this->datestart}' AND sm.n_status = 1					GROUP BY sm.sex, datetime,user_id					HAVING count(*) > 1					ORDER BY datetime				) a				GROUP BY datetime,sex				ORDER BY datetime";						$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.login_user_daily_active (num, datetime, sex)					VALUES ('{$data->num}','{$data->datetime}','{$data->sex}')					ON DUPLICATE KEY UPDATE num='{$data->num}', datetime='{$data->datetime}', sex='{$data->sex}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}		function logindailyweekly(){		/*		$sql = "SELECT COUNT(*) num, datetime,sex				FROM 				(				SELECT COUNT(*) num, datetime,sex,weekperiod,user_id				FROM 				(				SELECT count( * ) num, DATE_FORMAT( log.date_time, '%Y-%m-%d' ) datetime, sm.sex,log.user_id, WEEK(log.date_time) weekperiod					FROM {$this->webdb_schema}.tbl_activity_log log					LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id					WHERE log.action_id =1 AND log.date_time >= '{$this->datestart}' AND sm.n_status = 1									GROUP BY sm.sex, datetime,user_id				ORDER BY datetime				) a								GROUP BY sex,weekperiod,user_id				HAVING count(*) > 1								ORDER BY datetime				) b 				GROUP BY sex,datetime				ORDER BY datetime";		*/		$sql ="SELECT COUNT(*) num, datetime,sex				FROM 				(				SELECT COUNT(*) num, 						DATE_SUB(						DATE_ADD(MAKEDATE(yeardates, 1), INTERVAL datetimes WEEK),						INTERVAL WEEKDAY(						DATE_ADD(MAKEDATE(yeardates, 1), INTERVAL datetimes WEEK)						 ) -1 DAY) datetime,sex,user_id				FROM 				(					SELECT count( * ) num, WEEK(log.date_time) datetimes, sm.sex,log.user_id, YEAR(log.date_time) yeardates					FROM {$this->webdb_schema}.tbl_activity_log log					LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id					WHERE log.action_id =1 AND WEEK(log.date_time) >= WEEK('{$this->datestart}') AND sm.n_status = 1									GROUP BY sm.sex, datetimes,user_id					HAVING count(*) > 1					ORDER BY datetimes				) a								GROUP BY sex,datetime,user_id															ORDER BY datetime				) b 				GROUP BY sex,datetime				ORDER BY datetime";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.login_user_weekly (num, datetime, sex)					VALUES ('{$data->num}','{$data->datetime}','{$data->sex}')					ON DUPLICATE KEY UPDATE num='{$data->num}', datetime='{$data->datetime}', sex='{$data->sex}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}		function logindailymonthly(){		$sql = "				SELECT COUNT(*) num, datetime,sex				FROM 				(				SELECT COUNT(*) num, DATE_SUB( DATE_ADD(MAKEDATE(yeardates, 1 ), INTERVAL datetimes MONTH),INTERVAL 1 DAY) datetime,sex,user_id				FROM 				(					SELECT count( * ) num,  MONTH(log.date_time) datetimes,  sm.sex,log.user_id, YEAR(log.date_time) yeardates					FROM {$this->webdb_schema}.tbl_activity_log log					LEFT JOIN {$this->webdb_schema}.social_member sm ON sm.id = log.user_id					WHERE log.action_id =1 AND MONTH(log.date_time) >= MONTH('{$this->datestart}') AND sm.n_status = 1								GROUP BY sm.sex, datetimes,user_id								HAVING count(*) > 1								ORDER BY datetimes				) a								GROUP BY sex,datetime,user_id																			ORDER BY datetime				) b 				GROUP BY sex,datetime				ORDER BY datetime				";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);								$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.login_user_monthly (num, datetime, sex)					VALUES ('{$data->num}','{$data->datetime}','{$data->sex}')					ON DUPLICATE KEY UPDATE num='{$data->num}', datetime='{$data->datetime}', sex='{$data->sex}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}		function province(){		$sql = "SELECT count(*) num, b.provinceName 				FROM {$this->webdb_schema}.social_member AS a 				LEFT JOIN {$this->webdb_schema}.athreesix_city_reference AS b ON a.city = b.id GROUP BY provinceid";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.tbl_province (num, provinceName)					VALUES ('{$data->num}','{$data->provinceName}')					ON DUPLICATE KEY UPDATE num='{$data->num}', provinceName='{$data->provinceName}'";			$this->query($sql);			 		}	}		function city(){		$sql = "SELECT count( * ) num, b.city				FROM {$this->webdb_schema}.social_member AS a				LEFT JOIN {$this->webdb_schema}.athreesix_city_reference AS b ON a.city = b.id				GROUP BY b.id";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.tbl_city (num, city)					VALUES ('{$data->num}','{$data->city}')					ON DUPLICATE KEY UPDATE num='{$data->num}', city='{$data->city}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}		function gender(){		$sql = "SELECT count( * ) AS num, IF( sex IS NULL , 'unknown', sex ) sex				FROM {$this->webdb_schema}.social_member				GROUP BY sex";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.tbl_gender (num, sex)					VALUES ('{$data->num}','{$data->sex}')					ON DUPLICATE KEY UPDATE num='{$data->num}', sex='{$data->sex}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}		function age(){		$sql = "SELECT count( * ) num, YEAR(				CURRENT_TIMESTAMP ) - YEAR( birthday ) - ( RIGHT(				CURRENT_TIMESTAMP , 5 ) < RIGHT( birthday, 5 ) ) AS age				FROM {$this->webdb_schema}.social_member				GROUP BY age";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);				foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.tbl_age (num, age)					VALUES ('{$data->num}','{$data->age}')					ON DUPLICATE KEY UPDATE num='{$data->num}', age='{$data->age}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}		function brandPref(){		$sql = "SELECT COUNT( * ) AS num, Brand1_ID, sex				FROM {$this->webdb_schema}.social_member				WHERE Brand1_ID IS NOT NULL				AND Brand1_ID <> ''				AND sex <> ''				AND sex IS NOT NULL				GROUP BY Brand1_ID, sex";				$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.brand_preference (num, Brand1_ID, sex)					VALUES ('{$data->num}','{$data->Brand1_ID}','{$data->sex}')					ON DUPLICATE KEY UPDATE num='{$data->num}', Brand1_ID='{$data->Brand1_ID}',sex='{$data->sex}'";		$datas[] = $this->query($sql);		}		print_r($datas);	}		function basedonContent(){		$sql = "SELECT COUNT( * ) num, a.action_id, b.id as content_id, c.type, DATE(a.date_time)dateday				FROM {$this->webdb_schema}.tbl_activity_log as a 				LEFT JOIN {$this->webdb_schema}.athreesix_news_content as b on a.action_value = b.id				LEFT JOIN {$this->webdb_schema}.athreesix_news_content_type as c on b.articleType = c.id				WHERE b.id AND c.type IS NOT NULL AND date_time >= '{$this->datestart}'				GROUP BY c.content_name ORDER BY date_time";			$this->setSocketDB(0);		$qData = $this->fetch($sql,1);					 		$this->setSocketDB(1);		foreach($qData as $data){			$sql = "INSERT INTO {$this->reportdb_schema}.based_on_content (num, action_id, content_id, type, dateday)					VALUES ('{$data->num}','{$data->action_id}','{$data->content_id}','{$data->type}','{$data->dateday}')					ON DUPLICATE KEY UPDATE num='{$data->num}', action_id='{$data->action_id}',content_id='{$data->content_id}',type='{$data->type}', dateday='{$data->dateday}' ";		$datas[] = $this->query($sql);		}		print_r($datas);	}		}$class = new dashboardbot;$class->top10useractivitypersubcultere(); $class->topvisitedpage(); $class->top3visitedcontentpersubculture(); $class->top5activitycontent(); $class->top10liked(); $class->top10comment(); $class->top10download(); $class->top10upload(); $class->mostviewedusers(); $class->mostvieweduserweekly(); $class->mostfriendsuser(); $class->top10userperuseractivity(); $class->top10artistcontent(); $class->top5contentsearch(); $class->top10activeuser();  $class->userRegistrant();  $class->userunverif();  $class->logindaily(); $class->logindailyactive(); $class->logindailyweekly(); $class->logindailymonthly();  $class->province();  $class->city();  $class->gender();  $class->age();  $class->brandPref();  $class->basedonContent(); die();?>