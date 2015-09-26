          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="<?= $active['user']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>회원</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['admin']; ?>user/user-crud/"><i class="fa fa-circle-o"></i> 회원</a></li>
                <li><a href="<?= $URL['core']['admin']; ?>user/points/"><i class="fa fa-circle-o"></i> 마일리지</a></li>
                <li><a href="<?= $URL['core']['admin']; ?>user/actions/"><i class="fa fa-circle-o"></i> 활동기록</a></li>
              </ul>
            </li>
            <li class="<?= $active['bbs']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>게시판</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['root']; ?>admin-mapc/list/"><i class="fa fa-circle-o"></i> 게시판</a></li>
              </ul>
            </li>
            <li class="<?= $active['shop']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>쇼핑몰</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['root']; ?>admin-mapc/cate/"><i class="fa fa-circle-o"></i> 카테고리</a></li>
                <li><a href="<?= $URL['core']['root']; ?>admin-mapc/prod/"><i class="fa fa-circle-o"></i> 상품</a></li>
                <li><a href="<?= $URL['core']['root']; ?>admin-mapc-shop/orders/"><i class="fa fa-circle-o"></i> 주문</a></li>
              </ul>
            </li>
            <li class="<?= $active['calendar']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>일정</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['admin']; ?>cal/dashboard/"><i class="fa fa-circle-o"></i> 일정</a></li>
              </ul>
            </li>
            <li class="<?= $active['etc']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>기타</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['admin']; ?>popup/list/"><i class="fa fa-circle-o"></i> 팝업</a></li>
              </ul>
            </li>
            <li class="<?= $active['academy']; ?> treeview">
              <a href="#">
                <i class="fa fa-circle-o text-aqua"></i>
                <span>학원관리</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?= $URL['core']['admin']; ?>academy/attend/"><i class="fa fa-circle-o"></i> 출석관리</a></li>
              </ul>
            </li>
          </ul>
