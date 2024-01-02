<?php

include ("../../../inc/includes.php");

header("Content-Type: text/html; charset=UTF-8");
Html::header_nocache();
Session::checkLoginUser();

function getColors() {
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

/**
 * Affiche les données en json pour faire de l'ajax dans ../js/script.js
 *
 * @return void
 */
function showJsonData() {
    $getColors = getColors();
    
    echo json_encode($getColors);
}

showJsonData();