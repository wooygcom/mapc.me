  <body>

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
					<?php if($user['user_id']) { ?>
						<a href="http://user.rank.best/login/logout?url=http%3A%2F%2Frank.best">로그아웃</a>
					<?php } else { ?>
						<a href="http://user.rank.best">로그인</a>
					<?php } ?>
					</li>
				</ul>
			</nav>

		</aside> <!-- END COLORLIB-ASIDE -->
		<div id="colorlib-main">
