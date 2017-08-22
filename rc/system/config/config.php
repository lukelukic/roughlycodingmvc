<?php

/*
    URL that represents link to your website's root folder
    Example : http://somewebsite.com/
    Or localy : http://localhost/somedirectory
*/
$config['base_url'] = 'http://localhost/diet/';

/*
    Your Application's name (Optional)
*/
$config['app_name'] = 'Diet tracker';

/*
    Your index page. If you're using redirection via .htaccess, set it to "".
*/
$config['index'] = "";

/*
    Your default controler. It will load if no controller is provided.
*/
$config['default_controller'] = "Welcome";


/*
Set your enviroment; DEV for development, PROD for production
*/
$config['environment'] = DEV;

/*
Set up your timezone
*/

$config['time_zone'] = "Europe/Belgrade";

/*
    Helpers to load. All helpers are loaded globaly.
    Example:
    $helpers = array('session', 'whoops');
*/
$helpers = array('request','session');
