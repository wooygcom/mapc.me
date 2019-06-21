Views
==================================================

Form
--------------------------------------------------

### 기본형태

1. 기본
```
include($ROUTES['callback'] . '.php');
```

2. 단순 : moduleView.php에서 모두처리, 스크립트 처리가 필요없는 프로그램에서만 사용, 1번 기본형 추천
```
<?php
/**
 *
 * View
 *
 * @version 0.1
 *
 */
$layout = 'core';
include(LAYOUT_PATH . $layout . '/head.html');
include(LAYOUT_PATH . $layout . '/header.html');
?>

내용

<?php
include(LAYOUT_PATH . $layout . '/footer.html');
include(LAYOUT_PATH . $layout . '/foot.html');

// this is it
```


### 스크립트 추가할 때

```
$v['head']['extension'] = <<< EOT
<!-- include libraries(jQuery, bootstrap) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script> 
EOT;
```


### 폼 입력할 때 기본형태
<form method="post" action="./" enctype="multipart/form-data">
    <input type="hidden" name="_method" value="update" /><!-- POST, PUT, PATCH, DELETE -->
    <input type="hidden" name="content_type" value="<?= $ROUTES['action'] ? $ROUTES['action'] : 'intro'; ?>" />
</form>
