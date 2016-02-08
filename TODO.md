해야 되는 것들
===============

* Autoload

* 관리자 -> 메뉴
* 개인사용자 -> 자기 메뉴관리

* site/default/* 와 site/MYPROJECT/* 의 버전을 비교를 해서 새버전이 나왔을 경우 바뀐 내용을 알려주는 스크립트

* 1. 글쓸때 ?mapc_form=image(, mapc_form=movie(주제:영화, 디렉토리:movie/) 처럼 형태에 맞춰 기본 값들 미리 집어넣기
* 2. 더 나아가 영화면 감독,배우 필드들이 자동으로 추가되고 위치도 자동으로 조정게 하면 좋을듯...
switch($mapc_form) {
    defualt_field = 'subject:영화,type:Review';
    field_order = title1, subject2, type3, poster4... 이런식으로
}

* 스크랩 할 때
    * rdf 자동생성 여부 결정
    * 자동생성할 경우 "자동생성한 문서임"을 문서설명에 넣어줄 지 여부
    * 자동생성할 때 작성자 이름은 누구이름을 자동으로 넣을지 결정(input textl에 넣어줌)

* 마크다운 화면에 표시할 때 마크다운 문서안의 메타데이터 처리...

* 화일탐색기형태의 글관리
