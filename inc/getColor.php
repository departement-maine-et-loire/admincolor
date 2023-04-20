<?php
include ('../../../inc/includes.php');

if (!isset($_SESSION['glpiactiveprofile']['id'])) {
   // Session is not valid then exit
   exit;
}

class pluginAdmincolorDefault extends CommonDBTM {
    public $getColors;

    public function __construct() {
        $this->getColors = $this->getColors();
    }

    public function getColors() {
        global $DB;

        $result = $DB->request([
            'FROM' => 'glpi_plugin_admincolor_config',
            'WHERE' => ['user_id' => Session::getLoginUserID()]
        ]);

        if(count($result) == 0) {
            $DB->insert(
                'glpi_plugin_admincolor_config',
                [
                    'user_id' => Session::getLoginUserID(),
                    'color1' => '#a5cbe2',
                    'color2' => '#FB335B',
                    'fontSizePolice' => '12',
                    'language' => 'fr-FR'
                ]
            );
            
            $result = $DB->request([
                'FROM' => 'glpi_plugin_admincolor_config',
                'WHERE' => ['user_id' => Session::getLoginUserID()]
            ]);
        }

        foreach($result as $data){
            return [$data['color1'], $data['color2'], $data['fontSizePolice'], $data['language']];
        }
    }
}

$colors = new pluginAdmincolorDefault;
$data = $colors->getColors();

print json_encode($data);
?>