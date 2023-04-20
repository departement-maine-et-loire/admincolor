<?php

define('ADMINCOLOR_VERSION', '1.0.0');

function plugin_init_admincolor() {

   // On initialise le plugin (obligatoire)
   global $PLUGIN_HOOKS;

   $PLUGIN_HOOKS['change_profile']['admincolor'] = ['PluginAdmincolorProfileRights', 'changeProfile'];
   $PLUGIN_HOOKS['csrf_compliant']['admincolor'] = true;

   // Ajout de la page de configuration
   $PLUGIN_HOOKS['config_page']['admincolor'] = 'front/config.form.php';

   // Si l'ID du profil actif est le 4 (Super-Admin), on déclare l'ajout du JS
   $plugin = new Plugin();
   if ($plugin->isActivated("admincolor")) {
      if (isset($_SESSION['glpiactiveprofile']['id'])) {
         if ($_SESSION['glpiactiveprofile']['id'] == 4) {
            if(stristr(GLPI_VERSION, "9.") !== FALSE) {
               $PLUGIN_HOOKS['add_javascript']['admincolor'] = "js/admincolor_glpi_9.js";
            } else if (stristr(GLPI_VERSION, "10.") !== FALSE) {
               $PLUGIN_HOOKS['add_javascript']['admincolor'] = "js/admincolor_glpi_10.js";
            }
         }
      }
   }
}

function plugin_version_admincolor() {
   return [
      'name'           => 'Admincolor',
      'version'        => ADMINCOLOR_VERSION,
      'author'         => 'Yannick COMBA',
      'license'        => 'GPL v2+',
      'homepage'       => '',
      'requirements'   => [
         'glpi'   => [
            'min' => '9.1'
         ]
      ]
   ];
}

function plugin_admincolor_check_prerequisites() {
   return true;
}

function plugin_admincolor_check_config($verbose = false) {
   if (true) {
      return true;
   }

   if ($verbose) {
      echo "Installed, but not configured";
   }

   return false;
}

function plugin_admincolor_options() {
   return [
      Plugin::OPTION_AUTOINSTALL_DISABLED => true,
   ];
}