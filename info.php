<?php
/**
 * Created by PhpStorm.
 * User: Marion
 * Date: 17/07/16
 * Time: 16:47
 */

session_start();

if(isset($_SESSION['id']) && $_SESSION['id'] == 1) {
    die(phpinfo());
}
else {
    echo '<script>window.location.href="accueil";</script>';
}
