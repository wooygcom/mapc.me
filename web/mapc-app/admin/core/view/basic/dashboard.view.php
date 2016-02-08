<!-- Main content -->
<section class="content">

  <h1 class="page-header">요약보기</h1>

  <!-- Small boxes (Stat box) -->
  <div class="row">
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?= $VIEW['order'] ? $VIEW['order'] : 0; ?></h3>
          <p>예약</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">예약관리 <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $VIEW['user_count'] ? $VIEW['user_count'] : 0; ?></h3>
          <p>회원</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">회원관리 <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $VIEW['connect'] ? $VIEW['connect'] : 0; ?><sup style="font-size: 20px"></sup></h3>
          <p>접속</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">통계보기 <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3>Etc</h3>
          <p>기타</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="#" class="small-box-footer">환경설정 <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
  </div><!-- /.row -->
  <!-- Main row -->

</section><!-- /.content -->
