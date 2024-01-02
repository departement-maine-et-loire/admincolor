<?php

include ("../../../inc/includes.php");

Session::checkLoginUser();

if ($_SESSION["glpiactiveprofile"]["interface"] == "central") {
   Html::header("ConfAdmincolor", $_SERVER['PHP_SELF'], "plugins", "pluginadmincolor", "");
} else {
   Html::helpHeader("ConfAdmincolor", $_SERVER['PHP_SELF']);
}

$config = new PluginAdmincolorConfig();

$config->showForm($config->getColors());

Html::closeForm();

Html::footer();