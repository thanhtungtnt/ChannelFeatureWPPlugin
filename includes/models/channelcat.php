<?php
/**
 * Description of ChannelCat
 *
 * 
 */
class TNT_ChannelCat {
    private $chcatID; 
    private $chcatName;
    private $chcatParent;
    
    private $_getters = array('chcatID', 'chcatName', 'chcatParent');
    private $_setters = array('chcatID', 'chcatName', 'chcatParent');
    
    public function __construct()
    {
        $this->chcatID          = 0;
        $this->chcatName       = "";
        $this->chcatParent      = 0;
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
     * Function Insert Channel Cat
     *
     * @return 0 : if failed 
     *         ID generated for the AUTO_INCREMENT: if sucessful
     */
    function tntInsertChannelCat()
    {
        $result = "";        
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel_cats";
        if($this->chcatName == "")
        {
            $result = 0;
        }
        else
        {
            $wpdb->insert( 
                $tableName, 
                array( 
                    'chcat_name'       =>  $this->chcatName,
                    'chcat_parent'      =>  $this->chcatParent
                ), 
                array( 
                    '%s', 
                    '%d'
                ) 
            );
            $result = $wpdb->insert_id;
        }
        return $result;
    }

    /**
     * Function Update Channel Category
     *
     * @return false : if errors 
     *         the number of rows affected : if successful.
     */
    function tntUpdateChannelCat()
    {
        $result = "";        
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel_cats";
        if($this->chcatName == "")
        {
            $result = false;
        }
        else
        {
            $result = $wpdb->update( 
                $tableName, 
                array( 
                    'chcat_name'           =>  $this->chcatName,
                    'chcat_parent'       =>  $this->chcatParent
                ), 
                array('chcat_id' => $this->chcatID),
                array( 
                    '%s', 
                    '%d'
                ),
                array('%d') 
            );
        }
        return $result;
    }

    /**
     * Function Delete Channel Category
     *
     * @return false : if errors 
     *         the number of rows affected : if successful.
     */
    function tntDeleteChannelCat()
    {
        $result = false;        
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel_cats";
        if($this->chcatID != 0)
        {
            $sql = "DELETE FROM $tableName WHERE chcat_id = $this->chcatID";
            $result = $wpdb->query($sql);    
        }
        return $result;
    }

    /**
     * Function: Get all cats
     *
     * @param   int     $ID     ID of Cat (optional)
     * @return  object          List of cats
     */
    public static function tntGetCats($catID = 0)
    {
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel_cats";
        $sql = "";
        if($catID == 0)
        {
            $sql = "SELECT chcat_id, chcat_name, chcat_parent 
                    FROM $tableName";
        }
        else
        {
            $sql = "SELECT chcat_id, chcat_name, chcat_parent
                    FROM $tableName
                    WHERE chcat_id = $catID";
        }
        $sql .= " ORDER BY chcat_name ASC";
        $results = $wpdb->get_results($sql);
        return $results;
    }

    /**
     * Function: Get cat by ID
     *
     * @param   int             $ID     ID of Channel cat (optional)
     * @return  0: if errors
     *          object          ChannelCat
     */
    public function tntGetCat($catID = 0)
    {
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel_cats";
        $sql = "";
        if($catID != 0)
        {
            $sql = "SELECT chcat_id, chcat_name, chcat_parent
                    FROM $tableName
                    WHERE chcat_id = $catID";
            $tntCat = $wpdb->get_row($sql);
            $this->chcatID     = $tntCat->chcat_id;
            $this->chcatName   = $tntCat->chcat_name;
            $this->chcatParent = $tntCat->chcat_parent;
        }
        else
        {
            wp_die("Error function tntGetCat : not found catID"); 
            exit;
        }
    }

    /**
     * Display List of Channel Category
     * @param   int     ID of category selected
     * @return  string  the selecbox contains list category
     */
    public static function tntDisplayListCat($catID = 0)
    {
        $listCat = TNT_ChannelCat::tntGetCats();
        $view = "";
        $view .= '<select class="sbChannel" name="sbChannelCat[]">'; 
        foreach ($listCat as $cat) {
            if($catID == $cat->chcat_id)
            {
                $view .= '<option value="'.$cat->chcat_id.'" selected>'.$cat->chcat_name.'</option>';    
            }
            else
            {
                $view .= '<option value="'.$cat->chcat_id.'">'.$cat->chcat_name.'</option>';        
            }
            
        }
        $view .= '</select>'; 
        return $view;
    }
}

?>
