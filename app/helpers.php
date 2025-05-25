<?php 

/**
 * VIEW RENDERING SYSTEM
 * =====================
 * Core MVC function that renders views with layouts and data
 * Separates content from presentation for clean, maintainable code
 * 
 * HOW IT WORKS:
 * 1. extract($data) - Converts array keys into variables
 *    ['title' => 'Home'] becomes $title = 'Home'
 * 
 * 2. ob_start() - Starts output buffering (temporary container)
 *    Captures all echo/print output instead of sending to browser
 * 
 * 3. require view file - Loads the specific page content
 *    View can use extracted variables: <?php echo $title; ?>
 * 
 * 4. ob_get_clean() - Captures buffered content and clears buffer
 *    All view output is now stored in $content variable
 * 
 * 5. require layout - Loads the wrapper template
 *    Layout uses $content variable to display the view content
 * 
 * EXAMPLE USAGE:
 * render('home/index', ['title' => 'Welcome'], 'hero_layout');
 * 
 * FLOW:
 * Controller → render() → View (with data) → Layout (with view content)
 * 
 * BENEFITS:
 * - Reusable layouts (header/footer only written once)
 * - Clean separation of data and presentation
 * - No HTML mixing with PHP logic in controllers
 * - Easy to switch layouts per page (hero, admin, etc.)
 */
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




/**
 * BASE URL HELPER FUNCTION
 * ========================
 * Automatically generates the full URL for your website
 * Works on localhost, staging, and production servers
 * 
 * HOW IT WORKS:
 * 1. Detects protocol (http:// or https://) based on server settings
 * 2. Gets the host/domain name (localhost, example.com, etc.)
 * 3. Finds the base directory path (/PHP_MVC/public/)
 * 4. Combines everything into a full URL
 * 
 * EXAMPLES:
 * base_url() → http://localhost/PHP_MVC/public/
 * base_url('user/login') → http://localhost/PHP_MVC/public/user/login
 * base_url('css/style.css') → http://localhost/PHP_MVC/public/css/style.css
 * 
 * BENEFITS:
 * - No hardcoded URLs - works anywhere you deploy
 * - Automatically handles http vs https
 * - Prevents broken links when moving between environments
 * - Makes your code portable and professional
 */
function base_url($path = '') {

    if(defined('BASE_URL')) {
        return BASE_URL . ltrim($path, '/');
    }

    // https:// or http://
    $protocol = 
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || 
    $_SERVER['SERVER_PORT'] === 443 ? "https://" : "http://";

    // server.com
    $host = $_SERVER['HTTP_HOST'];

    // example.com/blog
    $base = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

    return $protocol . $host . $base . '/' . ltrim($path, '/'); 
}

// find real path
function base_path($path = '') {
    // __DIR__ is located in PHP_MVC/app/
    return realpath(__DIR__ . '/../' . '/' . ltrim($path, '/'));
}

// views path
function views_path($path = '') {
    return base_path('app/views/' . ltrim($path, '/'));
}