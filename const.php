<?php
//print_r($_SERVER);die;

/* C O N F   L O C A L   W I N D O W S   M A R I O N */
if($_SERVER['HTTP_HOST'] == 'www.coligo.local.lan') {

    ini_set("display_errors", 1);

    define('BASE_URL', 'www.coligo.local.lan/');
    define('BASE_PATH', 'C:/wamp64/www/coligo/');

    define('HOSTNAME', 'localhost');
    define('DBNAME', 'ColiGo');
    define('DBLOGIN', 'root');
    define('DBPWD', 'root');

    define('DEBUG', 1);
}

/* C O N F   L O C A L   M A C */
else if($_SERVER['HTTP_HOST'] == 'localhost:8888') {

    ini_set("display_errors", 1);

    define('BASE_URL', 'localhost:8888/ProjAnnuel2016/');
    define('BASE_PATH', '/Applications/MAMP/htdocs/ProjAnnuel2016/');

    define('HOSTNAME', 'localhost');
    define('DBNAME', 'ColiGo');
    define('DBLOGIN', 'root');
    define('DBPWD', 'root');

    define('DEBUG', 1);
}

/* C O N F   P R O D */
//else if(PROD) {
//    ini_set("display_errors", 0);
//    define('BASE_URL', 'http://coligo.fr.nf/');
//
//    define('DEBUG', 0);
//}
