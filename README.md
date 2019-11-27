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


Git 사용방법
-------------------------------------------------------------------------------
* 푸쉬

    1. git add .
    2. git commit -m "바꾼내용"
    3. git push origin master

* 삭제

    1. git rm -r --cached .


프로그램 구동절차
-------------------------------------------------------------------------------

0. //URL/[VENDOR]/[MODULE]/[ACTION] 로 접속 할 경우 벌어지는 일~
    (아래는 //URL/common/posts/123/edit 으로 접속 할 경우를 예로 들었음)

1. /mapc-public/index.php
    1. 상수값 설정, 환경설정을 불러옴
        1. env에서 기본환경설정(디렉토리, URL설정) 불러옴
            어느 디렉토리에서 환경설정불러올지 설정할 수 있음
            기본은 config 이고 이걸 config.site 이런식으로 바꿀 수 있음
            여러가지 환경설정을 만들어두고 필요에 따라 바꿀 수 있음
        2. config(사이트별 특화된 환경설정), routes(Routes설정) 불러옴
            common/config/routes.php 에서 common/posts/123/edit([VENDOR]/[MODULE]/[ID]/[ACTION]) 순으로 Argument를 받게끔 설정됨

    2. 입력값(벤더, 모듈, 액션 등)에 따라서 필요한 파일 불러오기(다음장으로)
        /mapc-app/common/index.php

2. /mapc-app/common/index.php
    1. Controllers/PostsController.php 불러옴
    2. Views/PostsView.php 불러옴

3. 각각의 PostsController.php, PostsView.php
    posts/edit.php 불러옴
3. 실제 프로그램 영역
    Controller/posts/edit.php 에서 선처리!!!!! (array $v에 출력할 내용을 저장
    View/posts/edit.php 에서 화면출력!!!!!
    전체에 같은 설정을 적용하려면 PostsView.php 에서 header 등 필요한 내용을 설정
    각각의 페이지에서 화면출력을 따로 설정하려면 posts/edit.php 에서 header나 footer등을 불러오게 하면 됨


잡담
-------------------------------------------------------------------------------

### 프로그램의 목적 ###

* 오프라인에서도 특별한 변환이 필요 없이 파일을 열수 있어야 한다. (파일 단위로 저장)

* 특정 프로그램에 얽매이지 않고 자료편집이 가능해야한다.

* 자료 형태(이미지,글,북마크 따위)로 구분하지 않고 주제로 구분한다.
