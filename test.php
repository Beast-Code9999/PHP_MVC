<?php
require_once 'app/init.php';

$data = [
    'title' => 'Test Page',
    'message' => 'Test message',
];

render('home/index', $data);
?>