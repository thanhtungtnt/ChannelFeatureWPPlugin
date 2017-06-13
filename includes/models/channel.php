<?php
/**
 * Description of Channel
 *
 * 
 */
class TNT_Channel {
    private $channelID; 
    private $channelName;
    private $channelCat;
    private $channelNumber;
    private $channelImage;
    private $channelLanguage;
    private $channelCountry;
    
    private $_getters = array('channelID', 'channelName', 'channelCat', 'channelNumber', 'channelImage', 'channelLanguage', 'channelCountry');
    private $_setters = array('channelID', 'channelName', 'channelCat', 'channelNumber', 'channelImage', 'channelLanguage', 'channelCountry');
    
    public function __construct()
    {
        $this->channelID       = 0;
        $this->channelName     = "";
        $this->channelCat      = 0;
        $this->channelNumber   = 0;
        $this->channelImage    = "";
        $this->channelLanguage = 0;
        $this->channelCountry  = 0;
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
     * Function Insert Channel
     *
     * @return 0 : if failed 
     *         ID generated for the AUTO_INCREMENT: if sucessful
     */
    function tntInsertChannel()
    {
        $result = "";        
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel";
        if($this->channelName == "")
        {
            $result = 0;
        }
        else
        {
            $wpdb->insert( 
                $tableName, 
                array( 
                    'channel_name'     => $this->channelName,
                    'channel_cat'      => $this->channelCat,
                    'channel_number'   => $this->channelNumber,
                    'channel_image'    => $this->channelImage,
                    'channel_language' => $this->channelLanguage,
                    'channel_country'  => $this->channelCountry
                ), 
                array( 
                    '%s', 
                    '%d',
                    '%d',
                    '%s',
                    '%d',
                    '%d'
                ) 
            );
            $result = $wpdb->insert_id;
        }
        return $result;
    }

    /**
     * Function Update Channel
     *
     * @return false : if errors 
     *         the number of rows affected : if successful.
     */
    function tntUpdateChannel()
    {
        $result = "";        
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel";
        if($this->channelName == "")
        {
            $result = false;
        }
        else
        {
            $result = $wpdb->update( 
                $tableName, 
                array( 
                    'channel_name'     => $this->channelName,
                    'channel_cat'      => $this->channelCat,
                    'channel_number'   => $this->channelNumber,
                    'channel_image'    => $this->channelImage,
                    'channel_language' => $this->channelLanguage,
                    'channel_country'  => $this->channelCountry
                ), 
                array('channel_id' => $this->channelID),
                array( 
                    '%s', 
                    '%d',
                    '%d',
                    '%s',
                    '%d',
                    '%d'
                ),
                array('%d') 
            );
        }
        return $result;
    }

    /**
     * Function Delete Channel
     *
     * @return false : if errors 
     *         the number of rows affected : if successful.
     */
    function tntDeleteChannel()
    {
        $result = false;        
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel";
        if($this->channelID != 0)
        {
            $sql = "DELETE FROM $tableName WHERE channel_id = $this->channelID";
            $result = $wpdb->query($sql);    
        }
        return $result;
    }

    /**
     * Function: Get Channels by channelID, channelCat, channelNumber, or all
     *
     * @param   array     $args     $args('channelID' => $channelID, 'channelCat' => $channelCat, 'channelNumber' => $channelNumber)
     * @return  object              List of channels
     */

    public static function tntGetChannels($args = null, $keyword = null)
    {
        global $wpdb;
        $tableName1 = $wpdb->prefix."tnt_channel";
        $tableName2 = $wpdb->prefix."tnt_channel_cats";
        $tableName3 = $wpdb->prefix."tnt_countries";
        $tableName4 = $wpdb->prefix."tnt_languages";
        
        $v = "";
        $sql = "";
        $channelID       = (isset($args["channelID"])) ? $args["channelID"] : "0";
        $channelCat      = (isset($args["channelCat"])) ? $args["channelCat"] : "0";
        $channelNumber   = (isset($args["channelNumber"])) ? $args["channelNumber"] : "0";
        $channelLanguage = (isset($args["channelLanguage"])) ? $args["channelLanguage"] : "0";
        $channelCountry  = (isset($args["channelCountry"])) ? $args["channelCountry"] : "0";

        $sql = "SELECT $tableName1.channel_id, $tableName1.channel_name, $tableName1.channel_number, $tableName1.channel_image, $tableName1.channel_language, $tableName1.channel_country, $tableName2.chcat_name, $tableName3.country_name, $tableName4.language_name
                FROM $tableName1, $tableName2, $tableName3, $tableName4
                WHERE $tableName1.channel_cat = $tableName2.chcat_id AND $tableName1.channel_country = $tableName3.id AND $tableName1.channel_language = $tableName4.id";

        if($keyword != null)
        {
            $sql .= " AND $tableName1.channel_name like '%".$keyword."%'";
        }

        if($channelID != 0)
        {
            $sql .= " AND $tableName1.channel_id = $channelID";
        }
        
        if($channelCat != 0)
        {
            $sql .= " AND $tableName1.channel_cat = $channelCat";
        }
        
        if($channelNumber != 0)
        {
            $sql .= " AND $tableName1.channel_number = $channelNumber";
        }

        if($channelLanguage != 0)
        {
            $sql .= " AND $tableName1.channel_language = $channelLanguage";
        }

        if($channelCountry != 0)
        {
            $sql .= " AND $tableName1.channel_country = $channelCountry";
        }
        
        $results = $wpdb->get_results($sql);
        return $results;
    }

    public static function tntGetChannelsNoCat($args = null, $keyword = null)
    {
        global $wpdb;
        $limit   = (isset($args["limitText"])) ? $args["limitText"] : "";
        $orderby = (isset($args["orderBy"])) ? $args["orderBy"] : "0";
        $order   = (isset($args["order"])) ? $args["order"] : "0";

        $tableName1 = $wpdb->prefix."tnt_channel";
        

        $sql = "SELECT channel_id, channel_name, channel_cat, channel_number, channel_image, channel_language, channel_country
                FROM $tableName1";
        if($orderby != 0)
        {
            $sql .= " ORDER BY $orderby $order";
        }
        else{
            $sql .= " ORDER BY channel_number ASC";
        }

        if($limit != ""){
            $sql .= " $limit";
        }
        
        $results = $wpdb->get_results($sql);
        return $results;
    }

    /**
     * Function: Get channel by ID
     *
     * @param   int             $ID     ID of Channel (optional)
     * @return  0: if errors
     *          object Channel    Channel
     */
    public function tntGetChannel($channelID = 0)
    {
        global $wpdb;
        $tableName = $wpdb->prefix."tnt_channel";
        $sql = "";
        if($channelID != 0)
        {
            $sql = "SELECT channel_id, channel_name, channel_number, channel_image, channel_language, channel_country
                    FROM $tableName 
                    WHERE channel_id = $channelID";
            $channel = $wpdb->get_row($sql);
            $this->channelID       = $channel->channel_id;
            $this->channelName     = $channel->channel_name;
            $this->channelCat      = $channel->channel_cat;
            $this->channelNumber   = $channel->channel_number;
            $this->channelLanguage = $channel->channel_language;
            $this->channelCountry  = $channel->channel_country;
        }
        else
        {
            wp_die("Error function tntGetChannel : not found channelID"); 
            exit;
        }
    }
}

?>
