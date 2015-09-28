SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

CREATE TABLE IF NOT EXISTS `mc_mapc_post` (
  `post_seq` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `post_uid` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '고유값',
  `post_lang` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_content` text COLLATE utf8_unicode_ci,
  `post_origin_type` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_origin_server` varchar(127) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_origin_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '원본의 위치\ndirectory/filename.ext\nhttp://url/directory/filename.ext',
  `post_write_date` datetime DEFAULT NULL,
  `post_edit_date_latest` datetime DEFAULT NULL,
  `post_status` char(3) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '예. cate-status, key-normal, value-일반',
  `post_user_uid` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `post_etc` char(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`post_seq`),
  UNIQUE KEY `UID_LANG` (`post_uid`,`post_lang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `mc_mapc_postmeta` (
  `postmeta_seq` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `postmeta_post_uid` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postmeta_lang` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postmeta_key` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postmeta_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postmeta_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `postmeta_etc` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`postmeta_seq`),
  KEY `fk_mc_mapc_postmeta_mc_mapc_post_idx` (`postmeta_post_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `mc_system_code` (
  `code_seq` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code_cate` varchar(20) DEFAULT NULL,
  `code_key` varchar(10) DEFAULT NULL,
  `code_lang` char(3) DEFAULT NULL,
  `code_value` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`code_seq`),
  UNIQUE KEY `lang_value` (`code_lang`,`code_value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='code_cate 테이블이름.필드이름\ncode_key 코드\ncode_lang 언어\ncode_value 코드의뜻\n\n예.\nuser.user_type\nadm\nkor\n관리자\n\nuser.user_type 필드에\nadm 이라는 코드는 한글로는 "관리자"라는 뜻\n\n특정테이블이 아닌 일반적인 코드는\ncode_cate 에 common이라고 기록한다.\n\n예.\ncommon\nISO 639-3\nkor\nISO 639-3 언어코드\n\n이렇게 해놓음으로 해서\nsystem_code테이블에\n시소러스의 기능도 기대할 수 있음\n';

CREATE TABLE IF NOT EXISTS `mc_user_group` (
  `group_seq` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `group_uid` varchar(25) DEFAULT NULL,
  `group_type` varchar(10) DEFAULT NULL,
  `group_status` varchar(45) DEFAULT NULL,
  `group_create_date` datetime DEFAULT NULL,
  `group_edit_date_latest` datetime DEFAULT NULL,
  `group_etc` char(3) DEFAULT NULL,
  PRIMARY KEY (`group_seq`),
  UNIQUE KEY `group_uid_uniqu` (`group_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mc_user_groupmeta` (
  `groupmeta_seq` int(11) NOT NULL AUTO_INCREMENT,
  `groupmeta_group_uid` varchar(25) DEFAULT NULL,
  `groupmeta_lang` varchar(5) DEFAULT NULL,
  `groupmeta_key` varchar(255) DEFAULT NULL,
  `groupmeta_value` text,
  `groupmeta_desc` varchar(255) DEFAULT NULL,
  `groupmeta_etc` char(3) DEFAULT NULL,
  PRIMARY KEY (`groupmeta_seq`),
  KEY `group_uid_idx` (`groupmeta_group_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `mc_user_info` (
  `user_seq` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_uid` varchar(25) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_id` varchar(60) DEFAULT NULL,
  `user_passwd` varchar(64) DEFAULT NULL,
  `user_type` varchar(10) DEFAULT NULL COMMENT 'adm, mng, rol',
  `user_status` varchar(45) DEFAULT NULL,
  `user_sign_up_date` datetime DEFAULT NULL,
  `user_sign_in_date_latest` datetime DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_etc` char(3) DEFAULT NULL,
  `fk_user_group_uid` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`user_seq`),
  UNIQUE KEY `user_uid_UNIQUE` (`user_uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

CREATE TABLE IF NOT EXISTS `mc_user_infometa` (
  `usermeta_seq` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `usermeta_user_uid` varchar(25) DEFAULT NULL,
  `usermeta_lang` varchar(5) DEFAULT NULL,
  `usermeta_key` varchar(255) DEFAULT NULL,
  `usermeta_value` text,
  `usermeta_desc` varchar(255) DEFAULT NULL,
  `usermeta_etc` char(3) DEFAULT NULL,
  PRIMARY KEY (`usermeta_seq`),
  KEY `fk_mc_user_infometa_mc_user_info1_idx` (`usermeta_user_uid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

CREATE TABLE IF NOT EXISTS `mc_user_log` (
  `seq` int(11) NOT NULL AUTO_INCREMENT,
  `user_uid` varchar(25) NOT NULL,
  `action` varchar(45) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `memo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`seq`),
  KEY `fk_mc_user_log_mc_user_info1_idx` (`user_uid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `mc_user_infometa`
  ADD CONSTRAINT `fk_mc_user_infometa_mc_user_info1` FOREIGN KEY (`usermeta_user_uid`) REFERENCES `mc_user_info` (`user_uid`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `mc_user_log`
  ADD CONSTRAINT `fk_mc_user_log_mc_user_info1` FOREIGN KEY (`user_uid`) REFERENCES `mc_user_info` (`user_uid`) ON DELETE NO ACTION ON UPDATE NO ACTION;

