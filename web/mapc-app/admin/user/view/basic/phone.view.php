<h1><?= $VIEW['body']['user_name']; ?> ( <?= $VIEW['body']['user_uid']; ?> )</h1>

<br />

<?php
foreach($VIEW['body']['phone'] as $var) {
?>
<br />
<a href="tel:<?= $var['number']; ?>"><?= $var['name']; ?> : <?= $var['number']; ?></a> <?= ($var['desc']) ? '(' . $var['desc'] . ')' : ''; ?>
<?php    
}
?>
