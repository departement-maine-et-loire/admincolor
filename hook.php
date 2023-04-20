<?php
/**
 * Install hook
 *
 * @return boolean
 */
function plugin_admincolor_install() {

   global $DB;

   include_once(GLPI_ROOT . "/plugins/admincolor/inc/config.class.php");

   //Create table only if it does not exists yet!
   if (!$DB->tableExists('glpi_plugin_admincolor_user_settings')) {
      $query = "CREATE TABLE `glpi_plugin_admincolor_user_settings` (
         `id` INT(11) NOT NULL AUTO_INCREMENT,
         `user_id` INT(11) NOT NULL,
         `settings_hidden` TINYINT,
         `user_settings` TINYINT,
          PRIMARY KEY  (`id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";
      $DB->queryOrDie($query, $DB->error());
   }

   if (!$DB->tableExists('glpi_plugin_admincolor_config')) {
      $query = "CREATE TABLE `glpi_plugin_admincolor_config` (
       `id` INT(11) NOT NULL AUTO_INCREMENT,
       `user_id` INT(11),
       `color1` VARCHAR(7) NOT NULL,
       `color2` VARCHAR(7) NOT NULL,
       `fontSizePolice` VARCHAR(10) NOT NULL,
       `language` VARCHAR(5) NOT NULL,
        PRIMARY KEY  (`id`)
     ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

      $DB->query($query) or die("error creating glpi_plugin_admincolor_config " . $DB->error());
   }

   if (!$DB->TableExists("glpi_plugin_admincolor_profile_rights")) {
      $query = "CREATE TABLE `glpi_plugin_admincolor_profile_rights` (
        `id` INT(11) NOT NULL AUTO_INCREMENT,
        `profile` INT(11) NOT NULL,
        `right` CHAR(2) NOT NULL,
         PRIMARY KEY  (`id`)
      ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci";

      $DB->query($query) or die("error creating glpi_plugin_admincolor_profile_rights " . $DB->error());
      PluginAdmincolorProfileRights::createAdminAccess($_SESSION['glpiactiveprofile']['id']);
   }


   return true;
}

/**
 * Uninstall hook
 *
 * @return boolean
 */
function plugin_admincolor_uninstall() {

    global $DB;

    $tables = array('glpi_plugin_admincolor_user_settings', 'glpi_plugin_admincolor_config', 'glpi_plugin_admincolor_profile_rights');

    foreach ($tables as $table) {
      $DB->query("DROP TABLE IF EXISTS `$table`;");
    }
 
    return true;
}