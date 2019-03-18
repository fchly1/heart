# Host: localhost  (Version: 5.5.53)
# Date: 2019-03-15 11:36:44
# Generator: MySQL-Front 5.3  (Build 4.234)

/*!40101 SET NAMES utf8 */;

#
# Structure for table "heart_admin_logs"
#

DROP TABLE IF EXISTS `heart_admin_logs`;
CREATE TABLE `heart_admin_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(50) NOT NULL DEFAULT '0',
  `moudel` varchar(100) NOT NULL DEFAULT '' COMMENT '目录',
  `controller` varchar(100) NOT NULL DEFAULT '' COMMENT '控制器',
  `action` varchar(100) NOT NULL DEFAULT '' COMMENT '方法',
  `message` varchar(200) DEFAULT '',
  `content` text,
  `action_user` varchar(100) DEFAULT '',
  `createtime` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2752 DEFAULT CHARSET=utf8;

#
# Data for table "heart_admin_logs"
#

/*!40000 ALTER TABLE `heart_admin_logs` DISABLE KEYS */;
INSERT INTO `heart_admin_logs` VALUES (2679,'127.0.0.1','admin','index','check_login','登录操作','{\"username\":\"admin\"}','admin',1460518739),(2680,'127.0.0.1','admin','index','check_login','登录操作','{\"username\":\"admin\"}','admin',1460518741),(2681,'127.0.0.1','admin','index','check_login','登录操作','{\"username\":\"root\"}','root',1460518745),(2682,'127.0.0.1','admin','index','check_login','登录操作','{\"username\":\"root\"}','root',1460518748),(2683,'127.0.0.1','admin','index','check_login','登陆状态:日常记录','{\"username\":\"test\"}','test',1460519229),(2684,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460519232),(2685,'127.0.0.1','admin','index','check_login','登陆:日常记录','{\"username\":\"12312\"}','12312',1460519296),(2686,'127.0.0.1','admin','index','check_login','登陆:日常记录','{\"username\":\"12312\"}','12312',1460519298),(2687,'127.0.0.1','admin','index','check_login','登陆:日常记录','{\"username\":\"12312\"}','12312',1460519299),(2688,'127.0.0.1','admin','index','check_login','登陆:日常记录','{\"username\":\"12312\"}','12312',1460519299),(2689,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460519302),(2690,'127.0.0.1','admin','index','check_login','登陆:日常记录','{\"username\":\"fsdfds\"}','fsdfds',1460519451),(2691,'127.0.0.1','admin','index','check_login','登陆:日常记录','{\"username\":\"fsdfds\"}','fsdfds',1460519703),(2692,'127.0.0.1','admin','index','check_login','登陆:日常记录','{\"username\":\"root\"}','root',1460519707),(2693,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460519709),(2694,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460521399),(2695,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460521479),(2696,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460521561),(2697,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460521723),(2698,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460523452),(2699,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460528038),(2700,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460528356),(2701,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460638376),(2702,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460638769),(2703,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460638779),(2704,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460639676),(2705,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460642394),(2706,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460642524),(2707,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460642807),(2708,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460686287),(2709,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460686396),(2710,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460686409),(2711,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460686870),(2712,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460687154),(2713,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460687396),(2714,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460687405),(2715,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460687565),(2716,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460687592),(2717,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460687602),(2718,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460687888),(2719,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460687897),(2720,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460687917),(2721,'127.0.0.1','admin','index','check_login','登陆状态','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460689128),(2722,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460689130),(2723,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460689157),(2724,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460704595),(2725,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460707354),(2726,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460707370),(2727,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460707399),(2728,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460707732),(2729,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460707775),(2730,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460707806),(2731,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460713389),(2732,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460713416),(2733,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460713426),(2734,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460713513),(2735,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460713524),(2736,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460713547),(2737,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460713560),(2738,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460714898),(2739,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"zhuangtingting\"}','zhuangtingting',1460714936),(2740,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460715082),(2741,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460952442),(2742,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460973451),(2743,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1460975940),(2744,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1461052587),(2745,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1461149041),(2746,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1461294886),(2747,'127.0.0.1','admin','index','check_login','登陆状态','{\"username\":\"root\"}','root',1461639756),(2748,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1461639759),(2749,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1462262546),(2750,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1462346404),(2751,'127.0.0.1','admin','index','check_login','登录成功','{\"username\":\"root\"}','root',1462788618);
/*!40000 ALTER TABLE `heart_admin_logs` ENABLE KEYS */;

#
# Structure for table "heart_admin_menu"
#

DROP TABLE IF EXISTS `heart_admin_menu`;
CREATE TABLE `heart_admin_menu` (
  `menuid` int(11) NOT NULL AUTO_INCREMENT,
  `parentid` int(4) NOT NULL,
  `name` varchar(100) NOT NULL COMMENT 'åå­—',
  `model` varchar(100) NOT NULL,
  `controller` varchar(100) NOT NULL COMMENT 'æŽ§åˆ¶å™¨_æ–‡ä»¶å',
  `action` varchar(100) NOT NULL COMMENT 'æ–¹æ³•',
  `param` varchar(100) DEFAULT '' COMMENT 'å‚æ•°',
  `display` int(2) NOT NULL DEFAULT '1' COMMENT '1=æ˜¾ç¤º 0=ä¸æ˜¾ç¤º',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT 'æŽ’åº',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(11) NOT NULL,
  `icon` varchar(100) NOT NULL,
  PRIMARY KEY (`menuid`)
) ENGINE=MyISAM AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='èœå•åˆ—è¡¨';

#
# Data for table "heart_admin_menu"
#

/*!40000 ALTER TABLE `heart_admin_menu` DISABLE KEYS */;
INSERT INTO `heart_admin_menu` VALUES (7,0,'我的面板','none','none','none','type=1&flag=open',1,1,1552547624,1552547624,'appicons/1.png'),(8,0,'系统设置','none','none','none','',1,2,1481440255,1481440255,'appicons/2.png'),(9,8,'管理员管理','admin','user','index','',1,2,1481377551,1481377551,''),(10,8,'后台菜单管理','admin','menu','index','type=1&flag=open',1,1,1481380134,1481380134,''),(11,7,'系统信息','admin','index','right','',1,0,1552547935,1552547935,''),(12,7,'面板2','none','none','none','',1,0,1481377835,1481377835,''),(13,7,'面板3','none','none','none','',1,0,1481377941,1481377941,''),(14,8,'角色管理','admin','role','index','',1,0,1481388513,1481388513,''),(15,14,'修改','admin','role','edit','',1,0,1481436695,1481436695,''),(16,14,'添加','admin','role','add','',1,0,1481390811,1481390811,''),(17,14,'删除','admin','role','del','',1,0,1481390863,1481390863,''),(18,0,'后台首页','admin','index','cms','',0,0,1481436041,1481436041,''),(19,0,'版权首页','admin','index','right','',0,0,1481436397,1481436397,''),(20,10,'添加','admin','menu','add','',1,0,1481436905,1481436905,''),(21,10,'修改','admin','menu','edit','',1,0,1481436922,1481436922,''),(22,10,'删除','admin','menu','del','',1,0,1481436948,1481436948,''),(23,9,'添加','admin','user','add','',1,0,1481437024,1481437024,''),(24,9,'修改','admin','user','edit','',1,0,1481437045,1481437045,''),(25,9,'删除','admin','user','del','',1,0,1481437060,1481437060,''),(26,0,'专题管理','none','none','none','',1,3,1481440340,1481440340,'appicons/5.png'),(27,10,'排序','admin','menu','sort','',1,0,1481437425,1481437425,''),(28,26,'专题管理','admin','special','index','',1,0,1481441227,1481441227,''),(29,28,'添加','admin','special','add','',1,0,1481441542,1481441542,''),(30,28,'修改','admin','special','edit','',1,0,1481441562,1481441562,''),(31,28,'删除','admin','special','del','',1,0,1481441599,1481441599,''),(32,28,'上传附件','admin','attachment','upload_dialog','',1,0,1481464197,1481464197,''),(33,28,'H5上传','admin','attachment','h5upload','',1,0,1481518602,1481518602,''),(34,28,'可视化编辑','admin','special','view','',1,0,1481686258,1481686258,''),(35,26,'数据模块','admin','special_data','index','',1,0,1481737282,1481737282,''),(37,26,'数据模型','admin','special_data_model','index','',1,0,1481787220,1481787220,''),(38,37,'添加模型','admin','special_data_model','add','',1,0,1481860322,1481860322,''),(39,37,'修改模型','admin','special_data_model','edit','',1,0,1481860350,1481860350,''),(40,37,'删除模型','admin','special_data_model','del','',1,0,1481860378,1481860378,''),(41,37,'字段列表','admin','special_data_model','index_field','',1,0,1481860466,1481860466,''),(42,37,'添加字段','admin','special_data_model','add_field','',1,0,1481860488,1481860488,''),(43,37,'修改字段','admin','special_data_model','edit_field','',1,0,1481860507,1481860507,''),(44,37,'删除字段','admin','special_data_model','del_field','',1,0,1481881419,1481881419,''),(45,28,'数据管理','admin','special_data','index','',1,0,1481885560,1481885560,''),(46,28,'编辑模板','admin','special_tpl','view','',1,0,1481907592,1481907592,''),(47,28,'碎片管理','admin','special_block','index','',1,0,1481993607,1481993607,''),(48,47,'添加碎片','admin','special_block','add','',1,0,1481994175,1481994175,''),(49,47,'修改碎片','admin','special_block','edit','',1,0,1481994200,1481994200,''),(50,47,'删除碎片','admin','special_block','del','',1,0,1481994227,1481994227,''),(51,28,'专题展示','admin','special','show','',1,0,1552551596,1552551596,''),(52,28,'发布专题','admin','special','mark_html','',1,0,1552614066,1552614066,'');
/*!40000 ALTER TABLE `heart_admin_menu` ENABLE KEYS */;

#
# Structure for table "heart_admin_role"
#

DROP TABLE IF EXISTS `heart_admin_role`;
CREATE TABLE `heart_admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `description` varchar(150) NOT NULL,
  `list` text NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='åˆ†ç»„';

#
# Data for table "heart_admin_role"
#

/*!40000 ALTER TABLE `heart_admin_role` DISABLE KEYS */;
INSERT INTO `heart_admin_role` VALUES (1,'后台管理员','后台管理员','18,19,7,11,12,13,8,14,15,16,17,10,20,21,22,27,9,23,24,25,26,37,40,39,38,41,42,44,43,35,28,52,34,33,32,31,51,47,50,49,48,46,30,29',1552614110,1552614110),(2,'审核人','','19,18,8,10,9,25,23',1481437224,1481437224),(3,'运营','运营','8,14,17,16,15,10,9,7,13,12,11',1481429844,1481429844),(4,'编辑','编辑','',1481429824,1481429824);
/*!40000 ALTER TABLE `heart_admin_role` ENABLE KEYS */;

#
# Structure for table "heart_admin_special"
#

DROP TABLE IF EXISTS `heart_admin_special`;
CREATE TABLE `heart_admin_special` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT 'ä¸“é¢˜åå­—',
  `description` text NOT NULL,
  `createtime` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(11) NOT NULL DEFAULT '0',
  `files` varchar(50) NOT NULL COMMENT 'æ–‡ä»¶ä¿¡æ¯',
  `status` int(1) NOT NULL DEFAULT '0' COMMENT 'çŠ¶æ€',
  `cover` varchar(200) NOT NULL DEFAULT '' COMMENT 'ä¸“é¢˜å°é¢',
  `zip` varchar(200) NOT NULL DEFAULT '' COMMENT 'ZIPåŽ‹ç¼©åŒ…',
  `directory` varchar(200) NOT NULL COMMENT 'ä¸“é¢˜ç›®å½•',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COMMENT='专题表';

#
# Data for table "heart_admin_special"
#

/*!40000 ALTER TABLE `heart_admin_special` DISABLE KEYS */;
INSERT INTO `heart_admin_special` VALUES (56,'其它','',1552612666,1552612666,'index.html',0,'','20190315/o_1d5vdbnos7qm1kbm4m14d41ph8a.zip','zxyy-0918'),(57,'测试','',1552617734,1552617734,'index.html',0,'','20190315/o_1d5vjktr91savnfvkss1h1416kta.zip','ffmtx-0914'),(58,'测试3','',1552618789,1552618789,'aaa.html,index.html',0,'','20190315/o_1d5vkl2pe1t24a0f69ehka1j2aa.zip','zylc-1123');
/*!40000 ALTER TABLE `heart_admin_special` ENABLE KEYS */;

#
# Structure for table "heart_admin_special_block"
#

DROP TABLE IF EXISTS `heart_admin_special_block`;
CREATE TABLE `heart_admin_special_block` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT 'ä¸“é¢˜ID',
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'blocké”®å€¼',
  `content` text NOT NULL COMMENT 'åŒºå—å†…å®¹ï¼Œä¾‹å¦‚HTMLæ¨¡æ¿ç­‰',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(11) NOT NULL DEFAULT '0',
  `type` int(2) NOT NULL DEFAULT '0' COMMENT '0=ä»£ç å—-ç¼–è¾‘å™¨ 1=ä»£ç å—-æ–‡æœ¬æ¡† 2=æ•°æ®åˆ—è¡¨',
  `mid` int(11) NOT NULL DEFAULT '0' COMMENT 'æ¨¡åž‹ID',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

#
# Data for table "heart_admin_special_block"
#

/*!40000 ALTER TABLE `heart_admin_special_block` DISABLE KEYS */;
INSERT INTO `heart_admin_special_block` VALUES (16,50,'代码快编辑器','<p>代码快编辑器代码快编辑器代码快编辑器</p>',1482061245,1482061245,0,1),(17,50,'代码快文本框','代码快 文本框代码快 文本框',1482061265,1482061265,1,1),(18,50,'数据列表','数据列表数据列表',1482061318,1482061318,2,1),(20,50,'title','我换一下标题如何',1482061815,1482061815,1,0),(21,50,'nav_daohang','<ul class=\"ab_topnav list-paddingleft-2\" style=\"margin-left:50px;\"><li><p><a href=\"#\">芭乐首页123</a></p></li><li><p><a href=\"#\">影视312</a></p></li><li><p><a href=\"#\">节目</a></p></li><li><p><a href=\"#\">芭乐拍</a></p></li></ul>',1482062136,1482062136,0,0),(22,50,'nav_daohang1','<ul class=\"ab_topnav\" style=\"margin-left:50px;\">\r\n<li><a href=\"#\">芭乐首页</a></li>\r\n<li><a href=\"#\">影视</a></li>\r\n<li><a href=\"#\">节目</a></li>\r\n<li class=\"an4\"><a href=\"#\">芭乐拍</a></li>\r\n</ul>',1482068229,1482068229,1,0),(23,53,'ddd','<a href=\"http://baidu.com\">百度</a>',1552548362,1552548362,1,0),(27,55,'导语','<p>山东省政府近日批复《山东半岛城市群发展规划（2016－2030年）》，到2030年山东半岛城市群将力争全面建成核心竞争力强的现代化国家级城市群。山东半岛城市群的规划早在2005就已提出，而发展到今天，重新规划定义，其意义、潜力不言而喻，其优势何在？破局何在？</p>',1552553839,1552553839,0,0),(28,55,'其它','<p>测试</p>',1552554206,1552554206,1,1),(29,58,'新闻','<p>大厦</p>',1552619540,1552619540,0,0);
/*!40000 ALTER TABLE `heart_admin_special_block` ENABLE KEYS */;

#
# Structure for table "heart_admin_special_model"
#

DROP TABLE IF EXISTS `heart_admin_special_model`;
CREATE TABLE `heart_admin_special_model` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'æ¨¡åž‹åç§°',
  `description` text NOT NULL COMMENT 'æ¨¡åž‹ç®€ä»‹',
  `type` int(2) NOT NULL COMMENT 'æ¨¡åž‹ç±»åˆ«',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(11) NOT NULL DEFAULT '0',
  `field` text NOT NULL COMMENT 'å­—æ®µJSONåˆ—è¡¨',
  `sid` int(11) NOT NULL DEFAULT '0' COMMENT 'æ‰€å±žä¸“é¢˜',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

#
# Data for table "heart_admin_special_model"
#

/*!40000 ALTER TABLE `heart_admin_special_model` DISABLE KEYS */;
INSERT INTO `heart_admin_special_model` VALUES (1,'推荐模型11','推荐模型1',0,1481816526,1481899896,'[{\"type\":\"editor\",\"field_name\":\"a_1111\",\"name\":\"%E5%AD%97%E6%AE%B5%E5%88%AB%E5%90%8D123sfds\",\"description\":\"%E5%AD%97%E6%AE%B5%E7%AE%80%E4%BB%8B%E5%AD%97%E6%AE%B5%E7%AE%80%E4%BB%8B\",\"updatetime\":\"1481882102\",\"createtime\":\"1481882102\"},{\"type\":\"datetime\",\"field_name\":\"a55511\",\"name\":\"%E5%AD%97%E6%AE%B5%E5%88%AB%E5%90%8D123rew11\",\"description\":\"%E5%AD%97%E6%AE%B5%E7%AE%80%E4%BB%8Brewrew11\",\"updatetime\":\"1481883262\",\"createtime\":\"1481883262\"}]',0),(3,'专题111','专题1321312',0,1481901124,1481901124,'',0);
/*!40000 ALTER TABLE `heart_admin_special_model` ENABLE KEYS */;

#
# Structure for table "heart_admin_users"
#

DROP TABLE IF EXISTS `heart_admin_users`;
CREATE TABLE `heart_admin_users` (
  `uid` int(4) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `password` varchar(80) NOT NULL,
  `encrypt` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `truename` varchar(100) NOT NULL COMMENT 'çœŸå®žå§“å',
  `createtime` int(11) NOT NULL DEFAULT '0',
  `updatetime` int(11) NOT NULL DEFAULT '0',
  `groupid` int(2) NOT NULL DEFAULT '0',
  `islock` int(1) NOT NULL DEFAULT '0' COMMENT 'æ˜¯å¦æ¿€æ´» 0=æœªæ¿€æ´» 1=æ¿€æ´»',
  PRIMARY KEY (`uid`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

#
# Data for table "heart_admin_users"
#

/*!40000 ALTER TABLE `heart_admin_users` DISABLE KEYS */;
INSERT INTO `heart_admin_users` VALUES (1,'root','c6e28a9122f0b9ace9479c8afe4544a4','EfBUnj','15501100090@163.com','zhangliang',1481313310,1552533707,1,0),(20,'zhangliang','bf1fbebdedeb281bfba6871f81f9d50c','pBJ4sD','','',1481429791,1481434331,2,0);
/*!40000 ALTER TABLE `heart_admin_users` ENABLE KEYS */;
