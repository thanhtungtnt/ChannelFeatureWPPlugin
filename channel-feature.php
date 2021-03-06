<?php 
/*
Plugin Name: Channel Feature
Plugin URI: http://tungit.net/
Description: Channel Feature is the wordpress plugin for managing channels, created by Tung Pham (email: tungpham.bh@gmail.com).
Version: 1.0
Author: Tung Pham
Author URI: http://tungit.net
License: GPLv2
*/
/*  Copyright 2012  TUNG PHAM  (email : thanhtungn1988@gmail.com)
       
    This program is free software; you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation; either version 2 of the License, or (at your option) any later version.
       
    This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.
       
    You should have received a copy of the GNU General Public License along with this program; if not, write to the Free Software Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
    /**
     * Define url
     */
    define("TNT_PLUG_PATH", plugin_dir_path(__FILE__));
    define("TNT_INC_PATH", TNT_PLUG_PATH."/includes");
    define("TNT_CLASS_PATH", TNT_PLUG_PATH."/includes/models");
    define("TNT_PLUG_URL", plugins_url()."/channel-feature");
    define("TNT_IMG_URL", TNT_PLUG_URL."/images");
    define("TNT_CSS_URL", TNT_PLUG_URL."/css");
    define("TNT_JS_URL", TNT_PLUG_URL."/js");
    /**
     * Class Require
     */
    require_once(TNT_CLASS_PATH . '/channel.php');
    require_once(TNT_CLASS_PATH . '/channelcat.php');
    require_once(TNT_CLASS_PATH . '/country.php');
    require_once(TNT_CLASS_PATH . '/language.php');
    require_once(TNT_CLASS_PATH . '/pagination.php');
 //    /**
 //     * Create tables
 //     */
 //    require_once(TNT_INC_PATH . '/create-table.php');
 //    register_activation_hook(__FILE__,'tnt_install_channels_table');
 //    register_activation_hook(__FILE__,'tnt_install_videos_cat_table');
 //    register_activation_hook(__FILE__,'tnt_install_videos_type_table');
 //    register_activation_hook(__FILE__,'tnt_install_data_videos_type_table');
 //    register_activation_hook(__FILE__,'tnt_install_data_videos_cat_table');
    /**
     * Message
     */
    require_once(TNT_INC_PATH . '/message.php');
	
	/**
	 * Create Menus
	 */
	require_once(TNT_INC_PATH . '/menus.php');
    require_once(TNT_INC_PATH . '/menus-view.php');
    require_once(TNT_INC_PATH . '/menus-process.php');
    define("TNT_PLUG_URL", plugins_url()."/channel-feature");
    define("TNT_IMG_URL", TNT_PLUG_URL."/images");
    define("TNT_CSS_URL", TNT_PLUG_URL."/css");
    define("TNT_JS_URL", TNT_PLUG_URL."/js");
    
    /**
     * AJAX
     */
    add_action('wp_ajax_tnt_ajax_delete_channel', 'tnt_ajax_delete_channel');
    add_action('wp_ajax_nopriv_tnt_ajax_delete_channel', 'tnt_ajax_delete_channel');
    function tnt_ajax_delete_channel(){
        $channelID = $_REQUEST["cID"];
        $tntC = new TNT_Channel();
        $tntC->tntGetChannel($channelID);
        $tntC->tntDeleteChannel();
        
        echo $channelID;
        die();
    }

    /**
     * Shortcode
     */
    require_once(TNT_INC_PATH . '/shortcode.php');
    
    /**
     * Template
     */
    require_once(TNT_INC_PATH . '/template.php');
 //    /**
 //     * Options
 //     */
 //    require_once(TNT_INC_PATH . '/options.php');    
 //    register_activation_hook(__FILE__,'tnt_videos_create_options');
 //    register_activation_hook(__FILE__,'tnt_update_databaseoption_videolistmanager');
?>