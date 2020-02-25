<?php
header("Content-type: application/json");

$result = ['users' => $v['users']];

echo json_encode($result);

// this is it
