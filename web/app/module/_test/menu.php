
<script>
$('.collapse').on('shown.bs.collapse', function (e) {
  $('.collapse').not(this).removeClass('in');
});

$('[data-toggle=collapse]').click(function (e) {
  $('[data-toggle=collapse]').parent('li').removeClass('active');
  $(this).parent('li').toggleClass('active');
});
</script>
<style>
.navbar {
    margin-bottom:-1px;
    border-radius:0;
}

#submenu {
    background-color: #e7e7e7;
    margin-bottom:20px;
}

.collapsing {
    display:none;
}
</style>

<div class="container-fluid">
    <ul class="nav nav-justified navbar-default">
      <li class="dropdown">
        <a href="#" data-toggle="collapse" data-target="#one">One</a>
      </li>
      <li class="dropdown">
        <a href="#" data-toggle="collapse" data-target="#two">Two</a>
      </li>
      <li class="dropdown">
        <a href="#" data-toggle="collapse" data-target="#three">Three</a>
      </li>
      <li class="dropdown">
        <a href="#" data-toggle="collapse" data-target="#four">Four</a>
      </li>
      <li class="dropdown">
        <a href="#" data-toggle="collapse" data-target="#five">Five</a>
      </li>
    </ul>
</div>
<div class="container-fluid">
  <nav id="submenu">
    <ul class="nav nav-justified">
      <li>
        <ul class="nav nav-justified collapse" id="one">
          <li><a href="#" id="">One sub 1</a></li>
          <li><a href="#" id="">One sub 2</a></li>
          <li><a href="#" id="">One sub 3</a></li>
          <li><a href="#" id="">One sub 4</a></li>
        </ul>
       </li>
       <li>
         <ul class="nav nav-justified collapse" id="two">
            <li><a href="#" id="">Two sub 1</a></li>
            <li><a href="#" id="">Two sub 2</a></li>
            <li><a href="#" id="">Two sub 3</a></li>
          </ul>
       </li>
       <li>
          <ul class="nav nav-justified collapse" id="three">
            <li><a href="#" id="">Three sub 1</a></li>
            <li><a href="#" id="">Three sub 2</a></li>
          </ul>
       </li>
       <li>
          <ul class="nav nav-justified collapse" id="four">
            <li><a href="#" id="">Four sub 1</a></li>
            <li><a href="#" id="">Four sub 2</a></li>
          </ul>
       </li>
       <li>
          <ul class="nav nav-justified collapse" id="five">
            <li><a href="#" id="">Link</a></li>
            <li><a href="#" id="">Link</a></li>
          </ul>
       </li>
    </ul>
  </nav>
</div>


    <header class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/wygoing/vip/web/app/">OO학원</a>
        </div>
        <div class="navbar-collapse collapse">

            <ul class="nav navbar-nav"><li  class="dropdown" ><a href="#dummy" class="dropdown-toggle" data-toggle="dropdown">출석관리</a><ul class="dropdown-menu">
<li ><a href="/wygoing/vip/web/app/academy_admin/attend_detail/search_day/2015-02-26">일일출석</a></li>
<li ><a href="/wygoing/vip/web/app/academy_admin/attend/">월별출석</a></li>
</ul>
</li>
<li  class="dropdown" ><a href="#dummy" class="dropdown-toggle" data-toggle="dropdown">원생관리</a><ul class="dropdown-menu">
<li ><a href="/wygoing/vip/web/app/academy_admin/user_crud/search_status/in/">등록현황</a></li>
<li ><a href="/wygoing/vip/web/app/academy_admin/user_crud/search_status/pause/">휴원학생</a></li>
<li ><a href="/wygoing/vip/web/app/academy_admin/user_crud/search_status/out/">퇴원학생</a></li>
</ul>
</li>
<li  class="dropdown" ><a href="#dummy" class="dropdown-toggle" data-toggle="dropdown">금전출납</a><ul class="dropdown-menu">
<li ><a href="/wygoing/vip/web/app/money_admin/transac_crud/">수입지출내역</a></li>
</ul>
</li>
</ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="/wygoing/vip/web/app/user/sign_out/">나가기</a></li>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </header>
