<?php
/**
 * Description of ChannelCat
 *
 * 
 */
class TNT_Country {
    private $countryID; 
    private $countryCode;
    private $countryName;
    
    private $_getters = array('countryID', 'countryCode', 'countryName');
    private $_setters = array('countryID', 'countryCode', 'countryName');
    
    public function __construct()
    {
        $this->countryID   = 0;
        $this->countryCode = "";
        $this->countryName = "";
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
     * Function: Get all countries
     *
     * @param   int     $ID     ID of Country (optional)
     * @return  object          List of countries
     */
    public static function tntGetCountries($cID = 0)
    {
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_country";
        $sql = "";
        if($cID == 0)
        {
            $sql = "SELECT id, country_name, country_code 
                    FROM $tableName";
        }
        else
        {
            $sql = "SELECT id, country_name, country_code
                    FROM $tableName
                    WHERE id = $cID";
        }
        $sql .= " ORDER BY country_name ASC";
        $results = $wpdb->get_results($sql);
        return $results;
    }
    /**
     * Function: Get country by ID
     *
     * @param   int             $ID     ID of Country (optional)
     * @return  0: if errors
     *          object          Country
     */
    public function tntGetCountry($cID = 0)
    {
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_country";
        $sql = "";
        if($cID != 0)
        {
            $sql = "SELECT id, country_code, country_name
                    FROM $tableName
                    WHERE id = $cID";
            $tntC = $wpdb->get_row($sql);
            $this->countryID   = $tntC->id;
            $this->countryCode = $tntC->country_code;
            $this->countryName = $tntC->country_name;
        }
        else
        {
            wp_die("Error function tntGetCountry : not found cID"); 
            exit;
        }
    }
    /**
     * Display Countries List
     * @param   int     ID of country selected
     * @return  string  the selecbox contains list country
     */
    public static function tntDisplayListCountry($cID=0)
    {
        $cList = TNT_Country::tntGetCountries();
        $view = "";
        $view .= '<select class="sbChannel" name="sbCountry[]">'; 
        $view .= '<option value="0">Select Country</option>';
        foreach ($cList as $c) {
            $name = str_replace("'","\'",$c->country_name);
            if($cID == $c->id)
            {
                $view .= '<option value="'.$c->id.'" selected>'.$name.'</option>';    
            }
            else
            {
                $view .= '<option value="'.$c->id.'">'.$name.'</option>';        
            }
            
        }
        $view .= '</select>'; 
        return $view;
    }

    public static function tntDisplayListCountrySingle($cID=0)
    {
        $cList = TNT_Country::tntGetCountries();
        $view = "";
        $view .= '<select class="sbChannel" name="sbCountry">'; 
        $view .= '<option value="0">Select Country</option>';
        foreach ($cList as $c) {
            $name = str_replace("'","\'",$c->country_name);
            if($cID == $c->id)
            {
                $view .= '<option value="'.$c->id.'" selected>'.$name.'</option>';    
            }
            else
            {
                $view .= '<option value="'.$c->id.'">'.$name.'</option>';        
            }
            
        }
        $view .= '</select>'; 
        return $view;
    }
}
?>
