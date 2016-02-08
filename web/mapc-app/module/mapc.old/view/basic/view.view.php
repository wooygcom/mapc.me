<?php
/**
 * 원본 자료를 화면에 출력
 *
 * 원본의 타입과 PATH를 기준으로 화면에 출력할 수 있게끔 변환
 * 예1, 그림화일이면 copyright를 붙이고 img태그를 사용해서 출력하는등의 작업을 함
 * 예2, 마크다운이면 html로 변환 후 출력
 *
 * @param function module_mapc_convert_file($type, $origin_url) 브라우저 출력에 맞게끔 각 화일을 변환해주는 함수, 화면에 표시할 수  없는 화일은 다운로드링크로 변환
 */
?>

<section>

	<article class="blog-post">

		<div class="panel panel-info">
			<div class="panel-heading">
				<h1 class="panel-title"><?= $post_info['post_title']; ?></h1>
			</div>
			<div class="panel-body">
	
				<?php
					$sep = '';
					if(! empty($post_info['post_write_date'])) {
						echo $sep . '글쓴날 : ' . $post_info['post_write_date'];
						$sep = ' / ';
					}
					if(! empty($post_info['post_edit_date_latest'])) {
						echo $sep . '고친날 : ' . $post_info['post_edit_date_latest'];
						$sep = ' / ';
					}
				?>

			</div>
		</div>

		<!-- 내용 : H -->
		<p>
            <?php
                module_mapc_convert_file($post_info['post_origin_type'], $PATH['mapc']['data'].$post_info['post_origin_url'], $post_info['post_content'], $post_info);
            ?>
		</p>
		<!-- 내용 : T -->

		<!-- 연결 : H -->
		<p>
			[ <a href="<?= $URL['mapc']['edit']; ?>mapc_uid/<?= $post_info['post_uid']; ?>/mapc_lang/<?= $post_info['post_lang']; ?>">편집</a>
			/ <a href="<?= $URL['mapc']['del']; ?>mapc_uid/<?= $post_info['post_uid']; ?>/mapc_lang/<?= $post_info['post_lang']; ?>">삭제</a> ]
			[
			<?php
		    	$sep = '';
			    if($view_prev[0]) {
			?>
			<a href="<?= $URL['mapc']['view']; ?>mapc_uid/<?= $view_prev[0]; ?>/mapc_lang/<?= $post_info['post_lang']; ?>">이전글</a>
			<?php
					$sep = '/';
			    }
			    if($view_next[0]) {
			    	echo $sep;
			?>
			<a href="<?= $URL['mapc']['view']; ?>mapc_uid/<?= $view_next[0]; ?>/mapc_lang/<?= $post_info['post_lang']; ?>">다음글</a>
			<?php
			    }
			?>
			]
		</p>
		<!-- 연결 : T -->

		<div class="panel panel-info">
			<div class="panel-heading">
				<h2 class="panel-title">추가정보</h2>
			</div>

			<div class="panel-body">

		        <?php
		        	// 덧붙임1 : H
		            if(count($title_another_lang) > 1) {
		        ?>
		            다른 언어 :
		            <?php
		                $temp_sep = '';
		                // 다른 언어로 된 똑같은 글 리스트 보기
		                foreach($title_another_lang as $var) {
		                    echo $temp_sep . ' <a href="' . $URL['mapc']['view'] . 'mapc_uid/' . $post_info['post_uid'] . '/mapc_lang/' . $var['postmeta_lang'] . '">'
		                        . '[' . $var['postmeta_lang'] . '] ' . $var['postmeta_value']
		                        . '</a>';
		                    $temp_sep = ', ';
		                }
		            ?>

		        <?php
			        	echo '<br />';
		            }
		        	// 덧붙임1 : T
		        ?>

		        <?php
		        	// 덧붙임2 : H #TODO 아래의 false 를 없애면 구현되기는 하지만... 경우에 따라 출력되는게 너무 많음;;; 영화나, 책... 따위에 옵션에 따라 이 내용을 출력할지 여부를 결정해야 될듯...
		            if(count($title_same_subject) > 1) {
		        ?>

		            이 글을 주제로 하는 글들 :
		            <?php
		                $temp_sep = '';
		                // 다른 언어로 된 똑같은 글 리스트 보기
		                foreach($title_same_subject as $var) {
		                    echo $temp_sep . ' <a href="' . $URL['mapc']['view'] . 'mapc_uid/' . $var['post_uid'] . '/mapc_lang/' . $var['post_lang'] . '">'
		                        . $var['post_title']
		                        . '</a>';
		                    $temp_sep = ', ';
		                }
		            ?>

		        <?php
			        	echo '<br />';
		            }
		        	// 덧붙임2 : T
		        ?>

				<?php
		        	// 덧붙임search : H
				?>

						제목 : [<?= $post_info['post_title']; ?>]으로 검색하기 :
						<a href="http://www.google.com/search?q=<?= $post_info['post_title']; ?>">구글</a> / 
						<a href="http://search.naver.com/search.naver?query=<?= $post_info['post_title']; ?>">네이버</a> / 
						<a href="http://search.daum.net/search?q=<?= $post_info['post_title']; ?>">다음</a> / 
						<a href="http://ko.wikipedia.org/wiki/<?= $post_info['post_title']; ?>">위키피디아</a>
					</li>
					<br /> 
				<?php
		        	// 덧붙임search : T
				?>


			</div>

		</div>

		<?php
			if(! DEBUG_MODE) {
		?>

			<!-- shareholic : h -->
			<span class='st_facebook_large' displayText='Facebook'></span>
			<span class='st_twitter_large' displayText='Tweet'></span>
			<span class='st_pinterest_large' displayText='Pinterest'></span>
			<span class='st_baidu_large' displayText='Baidu'></span>
			<span class='st_plusone_large' displayText='Google +1'></span>


			<script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
			<script type="text/javascript">stLight.options({publisher: "2d6869e3-8461-4fd9-9a6d-3c1780ca08e8", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
			<!-- shareholic : f -->

<?php
/*
	        <!-- shareaholic : h -->
	        <script type="text/javascript">
	        //<![CDATA[
	          (function() {
	            var shr = document.createElement('script');
	            shr.setAttribute('data-cfasync', 'false');
	            shr.src = '//dsms0mj1bbhn4.cloudfront.net/assets/pub/shareaholic.js';
	            shr.type = 'text/javascript'; shr.async = 'true';
	            shr.onload = shr.onreadystatechange = function() {
	              var rs = this.readyState;
	              if (rs && rs != 'complete' && rs != 'loaded') return;
	              var apikey = 'd9b084943e1d15fddb5c5ee670772f36';
	              try { Shareaholic.init(apikey); } catch (e) {}
	            };
	            var s = document.getElementsByTagName('script')[0];
	            s.parentNode.insertBefore(shr, s);
	          })();
	        //]]>
	        </script>
	        <div class='shareaholic-canvas' data-app='share_buttons' data-app-id='4649131'></div>
	        <!-- shareaholic : t -->
*/
?>
		<?php
			}
		?>
	</article>

</section>




<?php
// #TODO 이미지가 있을 때에만 아래의 스크립트 include
?>

<!-- Core CSS file -->
<link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/photoswipe/dist/photoswipe.css"> 

<!-- Skin CSS file (styling of UI - buttons, caption, etc.)
     In the folder of skin CSS file there are also:
     - .png and .svg icons sprite, 
     - preloader.gif (for browsers that do not support CSS animations) -->
<link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/photoswipe/dist/default-skin/default-skin.css"> 

<!-- Core JS file -->
<script src="<?= $URL['core']['root']; ?>vendor/photoswipe/dist/photoswipe.min.js"></script> 

<!-- UI JS file -->
<script src="<?= $URL['core']['root']; ?>vendor/photoswipe/dist/photoswipe-ui-default.min.js"></script> 



<!-- button id="btn">Open PhotoSwipe</button -->

<!-- Root element of PhotoSwipe. Must have class pswp. -->
<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

    <!-- Background of PhotoSwipe. 
         It's a separate element, as animating opacity is faster than rgba(). -->
    <div class="pswp__bg"></div>

    <!-- Slides wrapper with overflow:hidden. -->
    <div class="pswp__scroll-wrap">

        <!-- Container that holds slides. PhotoSwipe keeps only 3 slides in DOM to save memory. -->
        <div class="pswp__container">
            <!-- don't modify these 3 pswp__item elements, data is added later on -->
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
            <div class="pswp__item"></div>
        </div>

        <!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
        <div class="pswp__ui pswp__ui--hidden">

            <div class="pswp__top-bar">

                <!--  Controls are self-explanatory. Order can be changed. -->

                <div class="pswp__counter"></div>

                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>

                <button class="pswp__button pswp__button--share" title="Share"></button>

                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>

                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>

                <!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
                <!-- element will get class pswp__preloader--active when preloader is running -->
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                      <div class="pswp__preloader__cut">
                        <div class="pswp__preloader__donut"></div>
                      </div>
                    </div>
                </div>
            </div>

            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div> 
            </div>

            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
            </button>

            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
            </button>

            <div class="pswp__caption">
                <div class="pswp__caption__center"></div>
            </div>

          </div>

        </div>

</div>


<script src="//assets.codepen.io/assets/common/stopExecutionOnTimeout-f961f59a28ef4fd551736b43f94620b5.js"></script>

<script src='http://photoswipe.s3-eu-west-1.amazonaws.com/pswp/dist/photoswipe.min.js'></script>
<script src='http://photoswipe.s3-eu-west-1.amazonaws.com/pswp/dist/photoswipe-ui-default.min.js'></script>

<script>
    <?php
        $size_info = getimagesize($PATH['mapc']['data'].$post_info['post_origin_url']);
    ?>
    var openPhotoSwipe = function () {
	    var pswpElement = document.querySelectorAll('.pswp')[0];
	    var items = [
	        {
	            src: '<?= $URL['mapc']['file_view'] . 'mapc_uid/' . $post_info['post_uid']; ?>',
                w:<?= $size_info[0]; ?>,
                h:<?= $size_info[1]; ?>
	        }
	    ];
	    var options = {
	        history: false,
	        focus: false,
	        showAnimationDuration: 0,
	        hideAnimationDuration: 0
	    };
	    var gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, items, options);
	    gallery.init();
	    return false;
	};
//	openPhotoSwipe();
	document.getElementById('mapc_main_file').onclick = openPhotoSwipe;
	//@ sourceURL=pen.js
</script>

    
<script>
	if (document.location.search.match(/type=embed/gi)) {
		window.parent.postMessage("resize", "*");
	}
</script>
