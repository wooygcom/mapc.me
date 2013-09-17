mapc.me
=======

특징
----

* 순수PHP

* 모듈과 페이지를 분리

* 이 프로그램을 사용하시는 분은 자신만의 페이지를 만들고 필요한 모듈이 있으면 (게시판, 달력 따위) 사용자가 만든 페이지에서 include만 하면 됩니다.

* 배포판에는 모듈만을 수정하기 때문에 업데이트를 받고나서도 사용자가 만든 페이지는 변경되지 않습니다.

* 실행에 꼭 필요한 스크립트만 불러오기 때문에 실행속도가 빠릅니다.

* DB를 사용하지 않는 프로그램을 위해 기본적인 코드는 PHP화일로 저장합니다.

* 클래스를 사용하지 않은 가장 PHP스러운 프레임웍입니다.

    * 클래스를 사용하지 않는 이유...  
      객체화의 특징이라고 꼽는 몇가지 가운데 아래의 기능들은 PHP와는 맞지 않기 때문입니다.  
      PHP에서는 완전한 클래스 프로그램을 사용할 수 없습니다.

        * 캡슐화 - 컴파일언어에서의 라이브러리 제작자를 위해 필요한 기능이지만,
          PHP처럼 소스를 그대로 볼 수 있는 (PHP는 컴파일 이후에도 소스를 볼 수 있습니다.) 언어에서는 소용이 없습니다.

        * 다형성 - PHP에서는 구현이 되어있지 않습니다.

        * 메시지 전달

          * 객체 안에서 또다른 객체를 사용할 수 있다는 뜻인데...

          * PHP는 메모리에 상주하지 않기 때문에...

          * JSP같은 각각의 클래스가 서로 다른 프로세스에서 실행되지 않는 이상 필요없습니다.  
            (JSP는 서블릿형태로 컴파일 된 이후에 실행됨)

        * 또한 클래스는 불필요한 함수도 전부 불러와야 합니다.

          * 클래스는 클래스안의 함수를 서로 다른 화일로 만들지 못하지만

          * 함수를 사용할 경우 각각의 함수를 서로 다른 화일로 나누고 꼭 필요한 함수만 불러들일 수도 있습니다.

          * 컴파일하고 난 다음 기억장치에 상주해 있는 각각의 메소드를 불러올 수 있다면 클래스가 빠르겠지만  
            인터프리터 언어라면 이 방법이 더 빠를것입니다.  
            (PHP 컴파일 툴이 있긴 하지만 PHP의 원래 사용법을 벗어난 얘기라 논외로...)


프로그램 구동절차
-----------------

1. 모듈의 페이지를 호출하는 경우와 페이지만 불러오는 경우가 있는데  
   갑 주식회사의 회사소개처럼 사이트에 특화된 페이지는 ?core_page=introduce 같은 형태로  
   갑 주식회사 묻고답하기처럼 범용적인 페이지는 ?core_modl=bbs&core_page=list 같은 형태로 호출합니다.

2. 모듈과 페이지 지정할 경우

    1. index.php 에서는 site.default.php를 호출합니다.  
        site.default.php없이 index.php에서 기본설정값을 지정할 수 있지만 분리해놓으면 같은 소스로 다른 사이트를 만들 경우에 유용합니다.  
        site.pension1.php, site.pension2.php 처럼 여러개의 사이트를 하나의 소스로 운영 가능하구요.

    2. site.default.php에서는 각 디렉토리의 위치를 상수에 저장합니다.  
        사이트를 여러개 운영할 경우 site.php를 여러개 만들고  
        CONFIG_PATH를  
        site.real.php => site/real/config  
        site.test.php => site/test/config  
        와 같이 지정하면 유용합니다.

    3. 환경설정(config.php)과 사용자설정(custom.php)을 호출합니다.

    4. 초기화를 끝내고 사용자가 지정한 값대로 모듈디렉토리/모듈/페이지.php (Controller)를 호출합니다.
        위키의 편집페이지에 접근할 때를 예로 들면
        사용자는 index.php?core_modl=wiki&core_page=edit로 접근하면
        index.php에서 디렉토리 지정 환경설정 불러오기 같은 초기화를 끝내고
        module/wiki/edit.php를 불러옵니다.
        edit.php 에서는 다시 크게 두 부분으로 나뉘어
        우선, 프로그램 내부적인 일들(DB, 연산 따위)을 처리하고 (Model)
        그 후, 출력에 필요한 일들을 처리합니다. (View)
        즉, 선처리 후출력 방식인데,
        이렇게 하면 출력하는 부분에서 DB에 같이 접근하는 것 보다는 빨라진다고 하네요.


2. 페이지만 호출하는 경우

    1. site/page/디렉토리에서 해당 페이지를 가져옵니다.

    2. 범용적이지 않은 특정 사이트에 특화된 페이지를 만들때 사용할 수 있습니다.


3. 간략설명

    1. 프로그램 처리에 필요한 디렉토리들 지정

    2. 환경설정 불러오기

    3. 실제 사용되는 컨트롤러(페이지) 불러오기

        1. 모듈을 지정할 경우(bbs/list.php 처럼 여러군데서 쓰일 가능성이 있을 경우)  
            모듈/컨트롤러.php 불러오기

        2. 모듈을 지정하지 않을 경우(사이트에 특화된 페이지 일 경우)  
            site/사이트명/컨트롤러.php

    4. 컨트롤러에서 처리하는 일들

        1. 사용자 입력값 체크

        2. model에 넘겨줄 값 체크

        3. model 처리

        4. view에 넘겨줄 값 체크

        5. 페이지 출력
