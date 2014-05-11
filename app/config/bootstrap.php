<?php
// application
require_once APP_DIR.'app_controller.php';
require_once APP_DIR.'app_exception.php';
require_once APP_DIR.'app_json_view.php';
require_once APP_DIR.'app_layout_view.php';
require_once APP_DIR.'app_model.php';

// lib
require_once LIB_DIR.'SimpleDBI/src/SimpleDBI.php';

// helpers
require_once HELPERS_DIR.'html_helper.php';

// config
require_once CONFIG_DIR.'database.php';
require_once CONFIG_DIR.'log.php';
require_once CONFIG_DIR.'time.php';

// others
define('WEBROOT_DIR', APP_DIR.'webroot/');
define('IMG_DIR', WEBROOT_DIR.'img/');

spl_autoload_register(function($name) {
    $filename = Inflector::underscore($name).'.php';
    if(strpos($name, 'Controller') !== false) {
        require CONTROLLERS_DIR . $filename;
    } else {
        if (file_exists(MODELS_DIR . $filename)) {
            require MODELS_DIR . $filename;
        }
    }
});
