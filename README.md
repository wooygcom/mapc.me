mapc.me
==================================================

정의
-------------------------------------------------------------------------------

* MapC.me = PHP Codebone + CMS With Dublin core


특징
-------------------------------------------------------------------------------

* Pure PHP

* MVC

* Easy update for site manager

* Fast running time


설치방법
-------------------------------------------------------------------------------
1. 데몬설치

    Apache, PHP, MySQL 설치

2. 의존성도구 설치

    Composer, NPM, NPX 설치 ($ npm i -g npx)

3. Git Clone

    ```
    $ git clone https://github.com/wooygcom/mapc.me.git
    ```

4. composer update

    ```
    $ cd MAPC_ME_ROOT/web
    $ composer update (또는 php composer.phar update)
    $ npm install
    $ npx webpack
    ```

5. 접속

    1. 개발할 때의 접속주소
        http://접속주소/mapc.me/web/mapc-public/

    2. 실 서버에서는 "mapc-public'이 웹루트가 되도록 설정할 것!!!(보안)


새로운 페이지 만드는 방법
-------------------------------------------------------------------------------

1. /my/diary/edit 라는 페이지를 만드려면

    1. mapc-app/ 디렉토리의 "bare" 디렉토리를 "my"라는 디렉토리로 복사하고
    2. "my/controllers 와 views 각 디렉토리 안의 index.php를 edit.php로 복사하면
    3. 설치된URL/my/diary/edit 로 접속 할 수 있다.

2. // #TODO 설명서 만들어야 됨


프로그램 구동절차
-------------------------------------------------------------------------------

0. //URL/[VENDOR]/[MODULE]/[ACTION] 로 접속 할 경우 벌어지는 일~
    (아래는 //URL/Common/posts/123/edit 으로 접속 할 경우를 예로 들었음)

1. /mapc-public/index.php
    1. 상수값 설정, 환경설정을 불러옴
        1. env에서 기본환경설정(디렉토리, URL설정) 불러옴
            어느 디렉토리에서 환경설정불러올지 설정할 수 있음
            기본은 config 이고 이걸 config.site 이런식으로 바꿀 수 있음
            여러가지 환경설정을 만들어두고 필요에 따라 바꿀 수 있음
        2. config(사이트별 특화된 환경설정), routes(Routes설정) 불러옴
            Common/config/routes.php 에서 Common/posts/123/edit([VENDOR]/[MODULE]/[ID]/[ACTION]) 순으로 Argument를 받게끔 설정됨

    2. 입력값(벤더, 모듈, 액션 등)에 따라서 필요한 파일 불러오기(다음장으로)
        /mapc-app/Common/index.php

2. /mapc-app/Common/index.php
    1. Controllers/PostsController.php 불러옴
    2. Views/PostsView.php 불러옴

3. 각각의 PostsController.php, PostsView.php
    1. PostsController(또는 View) 안에서 switch case 문을 사용해서 각 action을 프로그램해도 되고...
    2. posts/edit.php 불러오게 해도 됨
    3. 아래처럼
        1. Controller에서 전부 처리하게해도 되고
            PostsController.php
            switch($ROUTES['action']) {
                case 'edit':
            }
        2. 각각의 Action별로 나누고 불러오는 방식으로 해도 되고...
            include('posts/edit.php');


4. 실제 프로그램 영역
    Controller/posts/edit.php 에서 선처리!!!!! (array $v에 출력할 내용을 저장)
    View/posts/edit.php 에서 화면출력!!!!!
    전체에 같은 설정을 적용하려면 PostsView.php 에서 header 등 필요한 내용을 설정
    각각의 페이지에서 화면출력을 따로 설정하려면 posts/edit.php 에서 header나 footer등을 불러오게 하면 됨
