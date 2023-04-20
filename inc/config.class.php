<?php

if (!defined('GLPI_ROOT')) {
 die("Sorry. You can't access directly to this file");
}

class PluginAdmincolorConfig extends CommonDBTM
{

    /**
     * Get configuration infos from database
     * @global type $DB
     */
    public static function getColors()
    {
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

    public static function getAllColors()
    {
        return $data = self::getColors();   
    }

     /**
     * Set configuration infos in database
     * @global type $DB
     * @param $id
     * @param $color1
     */
    public function setColors1($color1, $id=null)
    {
        global $DB;

        $user_id = Session::getLoginUserID();

        if(isset($color1)){
            $query = "UPDATE glpi_plugin_admincolor_config
            SET color1 = '$color1'
            WHERE user_id = $user_id;";

            $DB->query($query);
        }
    }

         /**
     * Set configuration infos in database
     * @global type $DB
     * @param $id
     * @param $color2
     */
    public function setColors2($color2, $id=null)
    {
        global $DB;

        $user_id = Session::getLoginUserID();

        if(isset($color2)){
            $query = "UPDATE glpi_plugin_admincolor_config
            SET color2 = '$color2'
            WHERE user_id = $user_id;";

            $DB->query($query);
        }
    }

             /**
     * Set configuration infos in database
     * @global type $DB
     * @param $id
     * @param $fontSizePolice
     */
    public function setFontSizePolice($fontSizePolice, $id=null)
    {
        global $DB;

        $user_id = Session::getLoginUserID();

        if(isset($fontSizePolice)){
            $query = "UPDATE glpi_plugin_admincolor_config
            SET fontSizePolice = '$fontSizePolice'
            WHERE user_id = $user_id;";

            $DB->query($query);
        }
    }

                 /**
     * Set configuration infos in database
     * @global type $DB
     * @param $id
     * @param $language
     */
    public function setLanguage($language, $id=null)
    {
        global $DB;

        $user_id = Session::getLoginUserID();

        if(isset($language)){
            $query = "UPDATE glpi_plugin_admincolor_config
            SET language = '$language'
            WHERE user_id = $user_id;";

            $DB->query($query);
        }
    }

    public function showForm($id, $options= [] ){

        global $CFG_GLPI;

        $modify = false;
        $create = false;
        $color1 = "";
        $color2 = "";
        $fontSizePolice = "";
        $language = "";
        $configData = self::getColors();
        $color1 = $configData[0]; 
        $color2 = $configData[1];
        $fontSizePolice = $configData[2];
        $language = $configData[3];
   
        if (!Session::haveRight("profile",1)) {
           return false;
        }

        if(isset($_POST['color1'])) {
            $changeColor1 = self::setColors1($_POST['color1']);
            $configData = self::getColors();
            $color1 = $configData[0];
        }

        if(isset($_POST['color2'])) {
            $changeColor2 = self::setColors2($_POST['color2']);
            $configData = self::getColors();
            $color2 = $configData[1];
        }

        if(isset($_POST['fontSizePolice'])) {
            $changefontSizePolice = self::setFontSizePolice($_POST['fontSizePolice']);
            $configData = self::getColors();
            $fontSizePolice = $configData[2];
        }

        if(isset($_POST['language'])) {
            $changelanguage = self::setLanguage($_POST['language']);
            $configData = self::getColors();
            $language = $configData[3];
        }

        if($color1 != "") {
            $modify = true;
            $createUpdate = "Modifier";
        } else {
            $create = true;
            $createUpdate = "Ajouter";
        }

        if($color2 != "") {
            $modify = true;
            $createUpdate = "Modifier";
        } else {
            $create = true;
            $createUpdate = "Ajouter";
        }

        if($fontSizePolice != "") {
            $modify = true;
            $createUpdate = "Modifier";
        } else {
            $create = true;
            $createUpdate = "Ajouter";
        }

        if($language != "") {
            $modify = true;
            $createUpdate = "Modifier";
        } else {
            $create = true;
            $createUpdate = "Ajouter";
        }
        
        if (!Session::haveRight("profile", READ)) {
            return false;
         }
   
         $canedit = Session::haveRight("profile", CREATE);
         $prof = new Profile();
        
        echo("
        <div style='height:100%; width:100%; margin:0; display:flex;'>
            <form style='margin:auto;' action='./config.form.php' method='post'>
                <table>
                    <tr>
                        <th style='background-color: red; color:white; width: 30rem; padding: .5rem; text-align: center;' colspan='2'>".__("Paramètres Admincolor", "admincolor")."</th>
                    </tr>
                    <tr>
                        <td><label for ='color1'>".__("Couleur de l'arrère-plan", "admincolor")." : </label></td>
                        <td><input type ='color' id='color1' value= '$color1' name='color1'></td>
                    </tr>
                    <tr>
                        <td><label for ='color2'>".__("Couleur de la police", "admincolor")." : </label></td>
                        <td><input type ='color' id='color2' value= '$color2' name='color2'></td>
                    </tr>
                    <tr>
                        <td><label for ='fontSizePolice'>".__("Taille de la police", "admincolor")." : </label></td>
                        <td><input type ='number' id='fontSizePolice' value= '$fontSizePolice' name='fontSizePolice'></td>
                    </tr>
                    <tr>
                        <td>
                            <label for ='language'>".__("Langue de la police", "admincolor")." : </label>
                        </td>
                        <td class='admincolorlanguage'>
                            <select name='language' id='AClanguage'>
                                <option id='ACFR' value='fr-FR'>Français</option>
                                <option id='ACEN' value='en-GB'>English</option>
                            </select>
                        </td>
                    </tr>
                </table>
        ");

    if((Session::haveRight("profile", CREATE))){
        echo("
        <div style='text-align: center;'>
            <input type='hidden' name='$createUpdate'>
            <button type='submit' name='$createUpdate' style='display:inline-flex;align-items: center;justify-content: center;white-space: nowrap;background-color: #fec95c;color: #1e293b;border: 1px solid rgba(98, 105, 118, 0.24);border-radius: 4px;font-weight: 500;line-height: 1.4285714286;padding: 0.4375rem 1rem;'>".__("Envoyer", "admincolor")."</button>
        </div>
        ");
    }
        Html::closeForm();
        echo("</div>");
    }
};
?>