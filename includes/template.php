<?php 
	/**
	 * Author: Tung Pham
	 */

	/**
	 * Add css to frondend
	 */
	add_action('wp_enqueue_scripts', 'tntAddFrontEndCSS');
	function tntAddFrontEndCSS()
	{
		if (!is_admin()) {
			wp_enqueue_style('tntstyle1', TNT_CSS_URL.'/style.css');
		}
	}

	/**
	 * Add javascript to footer of frondend
	 */
	add_action('init', 'tntAddFrontEndJS');
	function tntAddFrontEndJS() {
        if (!is_admin()) {
            wp_enqueue_script('tntscript1', TNT_JS_URL.'/custom.js', false, '1.0', true);
        }
    }
	   
	/**
     * Add css to backend
     */
    add_action('admin_print_styles', 'tntAddBackEndCSS');
    function tntAddBackEndCSS()
    {
        if (is_admin()) {
            wp_enqueue_style('tntstyleAdmin', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/jquery-ui.min.css');  
            wp_enqueue_style('tntstyleAdmin2', 'https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/themes/base/theme.min.css');  
            wp_enqueue_style('tntstyleAdmin3', TNT_CSS_URL.'/admin.css');        
        }
    }
    /**
     * Add javascript to footer of backend
     */
    add_action('init', 'tntAddBackEndJS');
    function tntAddBackEndJS() {
        if (is_admin()) {
            wp_enqueue_script('jquery-ui-dialog', 'jquery', '1.1', true);
            wp_enqueue_script('tntscriptAdmin1', TNT_JS_URL.'/jquery.validate.js', false, '1.1', true);
            wp_enqueue_script('tntscriptAdmin2', TNT_JS_URL.'/admin.js', false, '1.2', true);
        }
    }
    add_action ( 'admin_enqueue_scripts', function () {
        if (is_admin ())
            wp_enqueue_media ();
    } );

	/**
	 * Template to show videos list
	 * @param 	$argsVideo([0]=>array('videoTitle' => title of Video, 'videoFrame' => iFrame of video))
	 * @return  html 	html of videos list
	 */

	function tntTemplateVideoList($argsList = null, $paginator = null, $columns = 2)
	{	
		$tntOptions = get_option('tntVideoManageOptions');
		echo $tntOptions["tntSocialFeature"];
		$view = "";


		$socialFeature   = (($tntOptions["socialFeature"] == 1) && ($tntOptions["socialFeatureFB"] == 1 || $tntOptions["socialFeatureTW"] == 1 || $tntOptions["socialFeatureG"] == 1 ||$tntOptions["socialFeatureP"] == 1)) ? "dpb" : "dpn";
		$socialFeatureFB = ($tntOptions["socialFeatureFB"] == 1) ? "dpb" : "dpn";
		$socialFeatureTW = ($tntOptions["socialFeatureTW"] == 1) ? "dpb" : "dpn";
		$socialFeatureG  = ($tntOptions["socialFeatureG"] == 1) ? "dpb" : "dpn";
		$socialFeatureP  = ($tntOptions["socialFeatureP"] == 1) ? "dpb" : "dpn";

		$socialFeatureTitle = ($tntOptions["socialFeatureIconSize"] == "") ? "tntSocialShareTitle32" : "tntSocialShareTitle".$tntOptions["socialFeatureIconSize"];
		$socialFeatureFBIcon = ($tntOptions["socialFeatureIconSize"] == "") ? "tntIcon32 tntFIcon32" : "tntIcon".$tntOptions["socialFeatureIconSize"]." tntFIcon".$tntOptions["socialFeatureIconSize"];
		$socialFeatureTWIcon = ($tntOptions["socialFeatureIconSize"] == "") ? "tntIcon32 tntTIcon32" : "tntIcon".$tntOptions["socialFeatureIconSize"]." tntTIcon".$tntOptions["socialFeatureIconSize"];
		$socialFeatureGIcon = ($tntOptions["socialFeatureIconSize"] == "") ? "tntIcon32 tntGIcon32" : "tntIcon".$tntOptions["socialFeatureIconSize"]." tntGIcon".$tntOptions["socialFeatureIconSize"];
		$socialFeaturePIcon = ($tntOptions["socialFeatureIconSize"] == "") ? "tntIcon32 tntPIcon32" : "tntIcon".$tntOptions["socialFeatureIconSize"]." tntPIcon".$tntOptions["socialFeatureIconSize"];

		if($argsList != null)
		{
			$view .= '<div class="tntVideoList" width="'.$argsList[0]['videoWidth'].'" height="'.$argsList[0]['videoHeight'].'" rel="'.$columns.'">';
			$i = 1;
			foreach ($argsList as $video)
			{
				if($i % $columns == 1)
				{
					$view .= '<div class="tntVideoItem noML">';	
				}
				else
				{
					$view .= '<div class="tntVideoItem">';
				}
				$view .= '<h3>'. $video['videoTitle'] . '</h3>';
				$view .= '<a class="videoLink" href="'.$video['videoEmbed'].'" title="'.$video['videoTitle'].'">';
				$view .= '<img src="'.$video['videoThumb'].'" />';
				$view .= '</a>';

				$view .= '<div class="tntVideoSocialShare '.$socialFeature.'">';
				$view .= '<h4 class="'.$socialFeatureTitle.'">Share:</h4>';
				$view .= '<ul>';
				$view .= '<li class="'.$socialFeatureFB.'"><a class="'.$socialFeatureFBIcon.'" href="https://www.facebook.com/sharer/sharer.php?u='.$video['videoEmbed'].'" target="_blank" title="Share on Facebook">Share on Facebook</a></li>';
				$view .= '<li class="'.$socialFeatureTW.'"><a class="'.$socialFeatureTWIcon.'" href="https://twitter.com/home?status='.$video['videoEmbed'].'" target="_blank" title="Share on Twitter">Share on Twitter</a></li>';
				$view .= '<li class="'.$socialFeatureG.'"><a class="'.$socialFeatureGIcon.'" href="https://plus.google.com/share?url='.$video['videoEmbed'].'" target="_blank" title="Share on Google+">Share on Google+</a></li>';
				$view .= '<li class="'.$socialFeatureP.'"><a class="'.$socialFeaturePIcon.'" href="https://pinterest.com/pin/create/button/?url='.$video['videoEmbed'].'&media='.$video['videoThumb'].'&description=" target="_blank" title="Share on Pinterest">Share on Pinterest</a></li>';
				$view .= '</ul>';
				$view .= '<div class="clear"></div>';
				$view .= '</div>';
				$view .= '<div class="clear"></div>';
				$view .= '</div>';
				if($i % $columns == 0)
				{
					$view .= '<div class="tntClear"></div>';
				}
				$i++;
			}
			$view .= '<div class="tntClear"></div>';
			$view .= '</div>';	
		}
		$view .= '<div class="pagiWrap">';
		$view .= $paginator;
		$view .= '</div>';
		return $view;
	}
	
	/**
	 * Template to show video item
	 * Author: Tung Pham
	 * @param 	$argsVideo([0]=>array('videoTitle' => title of Video, 'videoFrame' => iFrame of video))
	 * @return  html 	html of videos list
	 */
	function tntTemplateVideoItem($tntVideo = null)
	{	
		$view = "";
		if($tntVideo != null)
		{
			$view .= '<div class="tntVideoSingle">';
			$view .= '<h3>'. $tntVideo['videoTitle'] . '</h3>';
			$view .= $tntVideo['videoFrame'];
			$view .= '</div>';
		}
		return $view;
	}	
?>