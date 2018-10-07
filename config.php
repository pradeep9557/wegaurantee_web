<?php
// HTTP
define('HTTP_SERVER', 'http://192.168.0.2/projects/weapp/live/');

// HTTPS
define('HTTPS_SERVER', 'http://192.168.0.2/projects/weapp/live/');

// DIR
define('DIR_APPLICATION', '/Users/user/www/projects/weapp/live/catalog/');
define('DIR_SYSTEM', '/Users/user/www/projects/weapp/live/system/');
define('DIR_IMAGE', '/Users/user/www/projects/weapp/live/image/');
define('DIR_STORAGE', '/Users/user/www/projects/weapp/live/storage/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/theme/');
define('DIR_CONFIG', DIR_SYSTEM . 'config/');
define('DIR_CACHE', DIR_STORAGE . 'cache/');
define('DIR_DOWNLOAD', DIR_STORAGE . 'download/');
define('DIR_LOGS', DIR_STORAGE . 'logs/');
define('DIR_MODIFICATION', DIR_STORAGE . 'modification/');
define('DIR_SESSION', DIR_STORAGE . 'session/');
define('DIR_UPLOAD', DIR_STORAGE . 'upload/');

// DB
define('DB_DRIVER', 'mysqli');
define('DB_HOSTNAME', 'localhost');
define('DB_USERNAME', 'allrounder');
define('DB_PASSWORD', 'allrounder');
define('DB_DATABASE', 'wegaurantee');
define('DB_PORT', '3306');
define('DB_PREFIX', 'weguarantee_');



// Use HTTP Strict Transport Security to force client to use secure connections only
$use_sts = false;

// iis sets HTTPS to 'off' for non-SSL requests
if ($use_sts && isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') {
    header('Strict-Transport-Security: max-age=31536000');
} elseif ($use_sts) {
    header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], true, 301);
    // we are in cleartext at the moment, prevent further execution and output
    die();
}