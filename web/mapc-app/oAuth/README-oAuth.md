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