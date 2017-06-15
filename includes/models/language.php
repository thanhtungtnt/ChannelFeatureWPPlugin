<?php
/**
 * Description of ChannelCat
 *
 * 
 */
class TNT_Language {
    private $languageID; 
    private $languageCode;
    private $languageName;
    
    private $_getters = array('languageID', 'languageCode', 'languageName');
    private $_setters = array('languageID', 'languageCode', 'languageName');
    
    public function __construct()
    {
        $this->languageID   = 0;
        $this->languageCode = "";
        $this->languageName = "";
    } 
    
    public function __get($property) {
        if (in_array($property, $this->_getters)) 
        {
            return $this->$property;
        }         
        else if (method_exists($this, '_get_' . $property))
        {
            return call_user_func(array($this, '_get_' . $property));
        }
    }
    public function __set($property, $value) {
        if (in_array($property, $this->_setters)) 
        {
            $this->$property = $value;
        } 
        else if (method_exists($this, '_set_' . $property))
        {
            call_user_func(array($this, '_set_' . $property), $value);
        }
    }
    
    /**
     * Function: Get all languages
     *
     * @param   int     $ID     ID of Language (optional)
     * @return  object          List of languages
     */
    public static function tntGetLanguages($cID = 0)
    {
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_languages";
        $sql = "";
        if($cID == 0)
        {
            $sql = "SELECT id, language_name, language_code 
                    FROM $tableName";
        }
        else
        {
            $sql = "SELECT id, language_name, language_code
                    FROM $tableName
                    WHERE id = $cID";
        }
        $sql .= " ORDER BY language_name ASC";
        $results = $wpdb->get_results($sql);
        return $results;
    }
    /**
     * Function: Get language by ID
     *
     * @param   int             $ID     ID of Language (optional)
     * @return  0: if errors
     *          object          Language
     */
    public function tntGetLanguage($cID = 0)
    {
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel_cats";
        $sql = "";
        if($cID != 0)
        {
            $sql = "SELECT id, language_code, language_name
                    FROM $tableName
                    WHERE id = $cID";
            $tntC = $wpdb->get_row($sql);
            $this->languageID   = $tntC->id;
            $this->languageCode = $tntC->language_code;
            $this->languageName = $tntC->language_name;
        }
        else
        {
            wp_die("Error function tntGetLanguage : not found cID"); 
            exit;
        }
    }
    /**
     * Display Languages List
     * @param   int     ID of language selected
     * @return  string  the selecbox contains list language
     */
    public static function tntDisplayListLanguage($cID=0)
    {
        $cList = TNT_Language::tntGetLanguages();
        $view = "";
        $view .= '<select class="sbChannel" name="sbLanguage[]">'; 
        $view .= '<option value="0">Select Language</option>';
        foreach ($cList as $c) {
            if($cID == $c->id)
            {
                $view .= '<option value="'.$c->id.'" selected>'.$c->language_name.'</option>';    
            }
            else
            {
                $view .= '<option value="'.$c->id.'">'.$c->language_name.'</option>';        
            }
            
        }
        $view .= '</select>'; 
        return $view;
    }

    public static function tntDisplayListLanguageSingle($cID=0)
    {
        $cList = TNT_Language::tntGetLanguages();
        $view = "";
        $view .= '<select class="sbChannel" name="sbLanguage">'; 
        $view .= '<option value="0">Select Language</option>';
        foreach ($cList as $c) {
            if($cID == $c->id)
            {
                $view .= '<option value="'.$c->id.'" selected>'.$c->language_name.'</option>';    
            }
            else
            {
                $view .= '<option value="'.$c->id.'">'.$c->language_name.'</option>';        
            }
            
        }
        $view .= '</select>'; 
        return $view;
    }
}
?>
