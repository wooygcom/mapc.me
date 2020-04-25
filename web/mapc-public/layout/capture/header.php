  <body>

	<!-- Go to www.addthis.com/dashboard to customize your tools --> <!--script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5e25bcadd93e9057"></script-->

	<div id="colorlib-page">
		<a href="#" class="js-colorlib-nav-toggle colorlib-nav-toggle"><i></i></a>
		<aside id="colorlib-aside" role="complementary" class="js-fullheight text-center">
			<h1 id="colorlib-logo"><a href="<?= ROOT_URL; ?>"><span class="flaticon-camera"></span><?= $v['site']['title']; ?></a></h1>
			<nav id="colorlib-main-menu" role="navigation">
				<ul>
					<li class="colorlib-active"><a href="<?= ROOT_URL; ?>">처음</a></li>
					<li><a href="<?= $v['url']['rankbest']; ?>etc/manual">설명서</a></li>
					<li><a href="<?= $v['url']['rankbest']; ?>etc/contact">의견</a></li>
					<li>
					<?php if(empty($_SESSION['rb_user_id']) && $_SESSION['rb_user_id'] != '__guest__') { ?>
						<a href="<?= $v['url']['user']['logout']; ?>">로그아웃</a>
					<?php } else { ?>
						<a href="<?= $v['url']['user']['login']; ?>">로그인</a>
					<?php } ?>
					</li>
				</ul>
			</nav>

		</aside> <!-- END COLORLIB-ASIDE -->
		<div id="colorlib-main">
