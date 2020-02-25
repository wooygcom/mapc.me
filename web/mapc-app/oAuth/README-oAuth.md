### 2019-12-21 db 데이터
### oAuth 로그인 기능을 이용하기 위해서는 mc_user_info 테이블의 client_id, client_secret, redirect_uri 값을 db table에 있는 값과 동일하게 세팅해줘야 함
-- --------------------------------------------------------
-- 호스트:                          127.0.0.1
-- 서버 버전:                        5.7.24 - MySQL Community Server (GPL)
-- 서버 OS:                        Win32
-- HeidiSQL 버전:                  10.3.0.5771
-- --------------------------------------------------------
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- 테이블 mysql.mc_user_info 구조 내보내기
DROP TABLE IF EXISTS `mc_user_info`;
CREATE TABLE IF NOT EXISTS `mc_user_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_uid` varchar(25) DEFAULT NULL,
  `user_name` varchar(45) DEFAULT NULL,
  `user_id` varchar(60) DEFAULT NULL,
  `user_passwd` varchar(128) DEFAULT NULL,
  `user_group` varchar(25) DEFAULT NULL,
  `user_type` varchar(10) DEFAULT NULL COMMENT 'adm, mng, rol',
  `user_status` varchar(45) DEFAULT NULL,
  `user_sign_up_date` datetime DEFAULT NULL,
  `user_sign_in_date_latest` datetime DEFAULT NULL,
  `user_email` varchar(100) DEFAULT NULL,
  `user_etc` char(3) DEFAULT NULL,
  `client_id` varchar(60) DEFAULT NULL,
  `client_secret` varchar(128) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_uid_UNIQUE` (`user_uid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- 테이블 데이터 mysql.mc_user_info:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `mc_user_info` DISABLE KEYS */;
INSERT INTO `mc_user_info` (`id`, `user_uid`, `user_name`, `user_id`, `user_passwd`, `user_group`, `user_type`, `user_status`, `user_sign_up_date`, `user_sign_in_date_latest`, `user_email`, `user_etc`, `client_id`, `client_secret`, `redirect_uri`) VALUES
	(1, 'testclient', 'testclient', 'testclient', 'eN3IVVuxZ3/1r3W6X8Asswu1krBhAneuFQVeGJt3/j/aSW5QJ6PZnshdVJQa3uHMF0tQQ4/cIdgtCnn4W1jPRA==', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'testclient', 'eN3IVVuxZ3/1r3W6X8Asswu1krBhAneuFQVeGJt3/j/aSW5QJ6PZnshdVJQa3uHMF0tQQ4/cIdgtCnn4W1jPRA==', 'http://127.0.0.1/web/mapc-public/');
/*!40000 ALTER TABLE `mc_user_info` ENABLE KEYS */;

-- 테이블 mysql.oauth_access_tokens 구조 내보내기
DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `access_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`access_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 테이블 데이터 mysql.oauth_access_tokens:~1 rows (대략적) 내보내기
/*!40000 ALTER TABLE `oauth_access_tokens` DISABLE KEYS */;
INSERT INTO `oauth_access_tokens` (`access_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
	('0109136c8a20df1e6bdff8ae2fe4c61d0a51dc5c', 'testclient', NULL, '2019-12-11 13:29:31', NULL),
	('2d6b10410a3193172187789fb5d7aea3c4d96ad9', 'testclient', NULL, '2019-12-21 13:37:15', NULL);
/*!40000 ALTER TABLE `oauth_access_tokens` ENABLE KEYS */;

-- 테이블 mysql.oauth_authorization_codes 구조 내보내기
DROP TABLE IF EXISTS `oauth_authorization_codes`;
CREATE TABLE IF NOT EXISTS `oauth_authorization_codes` (
  `authorization_code` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `redirect_uri` varchar(2000) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  `id_token` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`authorization_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 테이블 데이터 mysql.oauth_authorization_codes:~6 rows (대략적) 내보내기
/*!40000 ALTER TABLE `oauth_authorization_codes` DISABLE KEYS */;
INSERT INTO `oauth_authorization_codes` (`authorization_code`, `client_id`, `user_id`, `redirect_uri`, `expires`, `scope`, `id_token`) VALUES
	('09c24636cd13c43f8cd6436852e9f77d8046f194', 'testclient', NULL, 'http://127.0.0.1/web/mapc-public/', '2019-12-21 12:32:03', NULL, NULL),
	('27e5ac511a720a3707c1bbd56d072040585e1369', 'testclient', NULL, 'http://localhost/web/mapc-public/', '2019-12-11 12:29:25', NULL, NULL),
	('2e3e2214c1d20d3a674b8828156928b3e61f02b8', 'testclient', NULL, 'http://localhost/web/mapc-public/', '2019-12-11 12:29:20', NULL, NULL),
	('353b379e867a5f8697d0e42a6ad7a76fb85e8247', 'testclient', NULL, 'http://localhost/web/mapc-public/', '2019-12-11 12:28:12', NULL, NULL),
	('a2b0274b935efee8f8499de69f790acac5c59da7', 'testclient', NULL, 'http://localhost/web/mapc-public/', '2019-12-11 12:28:59', NULL, NULL),
	('ad84572784777dd701c9f7ee674dd65f28585d6c', 'testclient', NULL, 'http://localhost/web/mapc-public/', '2019-12-11 12:29:45', NULL, NULL);
/*!40000 ALTER TABLE `oauth_authorization_codes` ENABLE KEYS */;

-- 테이블 mysql.oauth_jwt 구조 내보내기
DROP TABLE IF EXISTS `oauth_jwt`;
CREATE TABLE IF NOT EXISTS `oauth_jwt` (
  `client_id` varchar(80) NOT NULL,
  `subject` varchar(80) DEFAULT NULL,
  `public_key` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 테이블 데이터 mysql.oauth_jwt:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `oauth_jwt` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_jwt` ENABLE KEYS */;

-- 테이블 mysql.oauth_refresh_tokens 구조 내보내기
DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `refresh_token` varchar(40) NOT NULL,
  `client_id` varchar(80) NOT NULL,
  `user_id` varchar(80) DEFAULT NULL,
  `expires` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `scope` varchar(4000) DEFAULT NULL,
  PRIMARY KEY (`refresh_token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 테이블 데이터 mysql.oauth_refresh_tokens:~1 rows (대략적) 내보내기
/*!40000 ALTER TABLE `oauth_refresh_tokens` DISABLE KEYS */;
INSERT INTO `oauth_refresh_tokens` (`refresh_token`, `client_id`, `user_id`, `expires`, `scope`) VALUES
	('25f51272af4f6187094ea5585b6e54af6d57fe3d', 'testclient', NULL, '2020-01-04 12:32:25', NULL),
	('64b78dc81dfffca7003f851207cc8f9c5af6360b', 'testclient', NULL, '2019-12-25 12:29:31', NULL),
	('fa940b3a2662a0f8069d408d85786cfb912804d2', 'testclient', NULL, '2020-01-04 12:37:15', NULL);
/*!40000 ALTER TABLE `oauth_refresh_tokens` ENABLE KEYS */;

-- 테이블 mysql.oauth_scopes 구조 내보내기
DROP TABLE IF EXISTS `oauth_scopes`;
CREATE TABLE IF NOT EXISTS `oauth_scopes` (
  `scope` varchar(80) NOT NULL,
  `is_default` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`scope`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- 테이블 데이터 mysql.oauth_scopes:~0 rows (대략적) 내보내기
/*!40000 ALTER TABLE `oauth_scopes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth_scopes` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;





### 2019-12-11 mc_user_info 필드추가
ALTER TABLE mc_user_info ADD COLUMN client_id VARCHAR(60);
ALTER TABLE mc_user_info ADD COLUMN client_secret VARCHAR(128);
ALTER TABLE mc_user_info ADD COLUMN redirect_uri VARCHAR(2000);

### 2019-12-11 mc_user_info 데이터 추가
### 아이디 : testclient 비밀번호 : testpass
INSERT INTO `mc_user_info` (`id`, `user_uid`, `user_name`, `user_id`, `user_passwd`, `user_group`, `user_type`, `user_status`, `user_sign_up_date`, `user_sign_in_date_latest`, `user_email`, `user_etc`, `client_id`, `client_secret`, `redirect_uri`) VALUES (1, 'testclient', 'testclient', 'testclient', 'eN3IVVuxZ3/1r3W6X8Asswu1krBhAneuFQVeGJt3/j/aSW5QJ6PZnshdVJQa3uHMF0tQQ4/cIdgtCnn4W1jPRA==', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'testclient', 'eN3IVVuxZ3/1r3W6X8Asswu1krBhAneuFQVeGJt3/j/aSW5QJ6PZnshdVJQa3uHMF0tQQ4/cIdgtCnn4W1jPRA==', 'http://localhost/web/mapc-public/');
 


### 임시 oAuth 관련 table

CREATE TABLE oauth_clients (
  client_id             VARCHAR(80)   NOT NULL,
  client_secret         VARCHAR(80),
  redirect_uri          VARCHAR(2000),
  grant_types           VARCHAR(80),
  scope                 VARCHAR(4000),
  user_id               VARCHAR(80),
  PRIMARY KEY (client_id)
);

CREATE TABLE oauth_access_tokens (
  access_token         VARCHAR(40)    NOT NULL,
  client_id            VARCHAR(80)    NOT NULL,
  user_id              VARCHAR(80),
  expires              TIMESTAMP      NOT NULL,
  scope                VARCHAR(4000),
  PRIMARY KEY (access_token)
);

CREATE TABLE oauth_authorization_codes (
  authorization_code  VARCHAR(40)     NOT NULL,
  client_id           VARCHAR(80)     NOT NULL,
  user_id             VARCHAR(80),
  redirect_uri        VARCHAR(2000),
  expires             TIMESTAMP       NOT NULL,
  scope               VARCHAR(4000),
  id_token            VARCHAR(1000),
  PRIMARY KEY (authorization_code)
);

CREATE TABLE oauth_refresh_tokens (
  refresh_token       VARCHAR(40)     NOT NULL,
  client_id           VARCHAR(80)     NOT NULL,
  user_id             VARCHAR(80),
  expires             TIMESTAMP       NOT NULL,
  scope               VARCHAR(4000),
  PRIMARY KEY (refresh_token)
);

CREATE TABLE oauth_users (
  username            VARCHAR(80),
  password            VARCHAR(80),
  first_name          VARCHAR(80),
  last_name           VARCHAR(80),
  email               VARCHAR(80),
  email_verified      BOOLEAN,
  scope               VARCHAR(4000),
  PRIMARY KEY (username)
);

CREATE TABLE oauth_scopes (
  scope               VARCHAR(80)     NOT NULL,
  is_default          BOOLEAN,
  PRIMARY KEY (scope)
);

CREATE TABLE oauth_jwt (
  client_id           VARCHAR(80)     NOT NULL,
  subject             VARCHAR(80),
  public_key          VARCHAR(2000)   NOT NULL
);