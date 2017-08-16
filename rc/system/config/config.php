<?php

/*
    URL that represents link to your website's root folder
    Example : http://somewebsite.com/
    Or localy : http://localhost/somedirectory
*/
$config['base_url'] = 'http://yourapp.com/';

/*
    Your Application's name (Optional)
*/
$config['app_name'] = 'rcframework';

/*
    Your index page. If you're using redirection via .htaccess, set it to "".
*/
$config['index'] = "index.php";

/*
    Your default controler. It will load if no controller is provided.
*/
$config['default_controller'] = "welcome";


/*
Set your enviroment; DEV for development, PROD for production
*/
$config['enviroment'] = DEV;

/*
    Helpers to load. All helpers are loaded globaly.
    Example:
    $helpers = array('session', 'whoops');
*/
$helpers = array('');
