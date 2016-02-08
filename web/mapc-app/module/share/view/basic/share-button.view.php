<?php
    $isSecure = false;
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
        $isSecure = true;
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
        $isSecure = true;
    }
    $REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';
    $currentPage = $REQUEST_PROTOCOL . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
?>

            <div class="border_box height_auto arl_view_sns">
                <a href="http://www.facebook.com/sharer.php?u=<?= urlencode($currentPage); ?>" target="_blank" class="c_tooltip avs_a facebook" title="페이스북"></a>
                <a href="https://story.kakao.com/share?url=<?= $urlencode($currentPage); ?>" target="_blank" class="c_tooltip avs_a kakaostory" title="카카오스토리"></a>
                <a href="http://www.band.us/plugin/share?body=<?= $urlencode($currentPage); ?>" target="_blank" class="c_tooltip avs_a band" title="네이버밴드"></a>
                <a href="http://twitter.com/intent/tweet?text=+<?= $urlencode($currentPage); ?>" target="_blank" class="c_tooltip avs_a twitter" title="트위터"></a>
                <a href="http://www.google.com/bookmarks/mark?<?= $urlencode($currentPage); ?>" target="_blank" class="c_tooltip avs_a google" title="구글"></a>
            </div>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5615342a18b5ae80" async="async"></script>
