<?php 


function render($view, $data = [], $layout = 'layout') {

    extract($data); // extract the variables
 
    // start output bufferring as temporary container
    ob_start();

    // include specific file from views
    require __DIR__ . '/views/' . $view . '.php';

    // get content from output bufferring
    $content = ob_get_clean();
    //gets a selected layout or defaults to layout
    require __DIR__ . "/views/" . $layout . ".php";
}