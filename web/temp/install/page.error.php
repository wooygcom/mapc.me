<h1 class="header">에러</h1>

<div>
    <p>

<?php
    if(is_array($path_name)) {
        foreach ($path_name as $key => $value) {
?>

        <?= $value; ?><br /><br />

<?php
        }
?>

        위 디렉토리의 퍼미션을 <?= $path_permission; ?>로 변경하여 주십시오.

        (또는 <a href="<?= $_SERVER['PHP_SELF']; ?>?act=site_code">사이트 고유값 변경</a>를 눌러주세요.)

<?php
    }
?>

    </p>
</div>
