<?php declare(strict_types =1);

require_once('util/session.php');
$session = new Session();

require_once('database/connection.db.php');
require_once('database/restaurant.class.php');

require_once('template/common.tpl.php');
require_once('template/restaurant.tpl.php');

$db= getDatabaseConnection();
$restaurants = Restaurant::getRestaurantsFromOwner($db, intval($_GET['id']));

    drawHeaderProfileRes($session);
    drawRestaurantsFromOwner($restaurants, intval($_GET['id']));
    drawFooter();
  ?>
