<?php
/*
스킨디렉토리 변경...
--------------------------------------------------

### 기본

/public/layout/LAYOUT-NAME/
/site/view/SKIN-NAME/
/module/view/SKIN-NAME/

### 아래처럼 변경하려면...

/public/site/SITE_CODE/layout/
/site/view/
/site/view/MODULE_NAME/
*/

    // site/SITE_CODE/proc/publish_hook.proc.php

    $VIEW['layout_path']  = PUBLIC_PATH . 'site/' . SITE_CODE . '/layout/' . $CONFIG['layout'] . '/';
    $VIEW['layout_url']   = $URL['core']['root'] . 'site/' . SITE_CODE . '/layout/' . $CONFIG['layout'] . '/';
    $VIEW['section_path'] = PAGE_PATH . 'view/';


/*
네이버 신디케이션을 사용할 때
--------------------------------------------------
*/

    // custom.php

    $CUSTOM['naver_api_key_syndi'] = 'Bearer KKAARBaYmh9…(중략)…Wdjghm1c';
    $CUSTOM['naver_syndi_doc_url'] = 'http%3A%2F%2Fwww.example.com%2Fapi%2Fnaver_syndi%2F';


/*
자바스크립트, CSS CDN주소
*/
    <!-- jQuery http://code.jquery.com/ -->
    <script src="<?= $URL['core']['root']; ?>vendor/jquery/dist/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>


    <!-- jQuery http://code.jquery.com/ -->
    <script src="<?= $URL['core']['root']; ?>vendor/jquery-ui/jquery-ui.min.js"></script>

    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>


    <!-- Bootstrap http://www.bootstrapcdn.com/ -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">


    <!-- moment.js https://cdnjs.com/ -->
    <script src="<?= $URL['core']['root']; ?>vendor/moment/min/moment.min.js"></script>
    <script src="<?= $URL['core']['root']; ?>vendor/moment/locale/ko.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.6/locale/ko.js"></script>


    <!-- full calendar https://cdnjs.com/ -->
    <link rel="stylesheet" href="<?= $URL['core']['root']; ?>vendor/fullcalendar/dist/fullcalendar.min.css">
    <script src="<?= $URL['core']['root']; ?>vendor/fullcalendar/dist/fullcalendar.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/fullcalendar.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/2.4.0/lang/ko.js"></script>

    <!-- requireJS https://cdnjs.com/ -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/require.js/2.1.20/require.min.js"></script>
    <script src="<?= $URL['core']['root']; ?>vendor/requirejs/require.js"></script>
