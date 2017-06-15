<?php 
/**
 * Register a shortcode
 */
add_shortcode('tnt_channel_list', 'showChannelList');
add_shortcode('tnt_channel_all_cat', 'showChannelListAll');
add_shortcode('tnt_channel_all_country', 'showChannelListAll');
add_shortcode('tnt_channel_all_language', 'showChannelListAll');


/**
 * Callback function for shortcode [tnt_video_list]
 */
function showChannelList($attr){
	$view = "";
	
	$channelList = TNT_Channel::tntGetChannels();
	$n = count($channelList);

	if($n > 0){
		$view .= "<ul class='channelItems'>";
		foreach ($channelList as $c) {
			$cID         = $c->channel_id;
			$cName       = $c->channel_name;
			$cNumber     = $c->channel_number;
			$cCatID      = $c->channel_cat;
			$cImageID    = $c->channel_image;
			$cCountryID  = $c->channel_country;
			$cLanguageID = $c->channel_language;

			if($cName != "")
			{
				$class = "";
				if($cCatID != 0)
				{
					$class .= " catBox";
				}
				if($cCountryID != 0){
					$class .= " countryBox";
				}
				if($cLanguageID != 0){
					$class .= " languageBox"; 
				}
				$img = '<img src="'.TNT_IMG_URL.'/default-thumbnail.jpg" alt="No Image" width="auto" height="50" />';
				if($cImageID > 0)
				{
					$img = wp_get_attachment_image($cImageID, array(9999,50));
				}
				
				$view .= "<li class='".$class."'>";
				$view .= $img;
				$view .= "<p>$cName</p>";
				$view .="</li>";
			}	
		}
		$view .= "</ul>";
	}
	else{
		$view .= "<p>This category doesn't have any channels</p>";
	}
	return $view;
}

function showChannelListAll($attr)
{
	$view = "";
	$type = $attr["type"];

	if($type == "all"){
		$args = null;
		showChannelListByType($args);
	}

	if($type == "cat")
	{
		$catList = TNT_ChannelCat::tntGetCats();
		foreach ($catList as $cat) {
			//Dem so luong channel trong cat
			$catID = $cat->chcat_id;
			$catName = $cat->chcat_name;
			$args = array(
				"channelCat"      => $catID
			);
			$channelList = TNT_Channel::tntGetChannels($args);
			$n = count($channelList);
			if($n > 0){
				$view .= "<h3>$catName</h3>";
				$view .= showChannelListByType($args);
			}
		}
	}

	if($type == "country"){
		$countryList = TNT_Country::tntGetCountries();
		foreach ($countryList as $country) {
			//Dem so luong channel trong cat
			$countryID = $country->id;
			$countryName = $country->country_name;
			$args = array(
				"channelCountry" => $countryID
			);
			$channelList = TNT_Channel::tntGetChannels($args);
			$n = count($channelList);
			if($n > 0){
				$view .= "<h3>$countryName</h3>";
				$view .= showChannelListByType($args);
			}
		}
	}

	if($type == "language"){
		$languageList = TNT_Language::tntGetLanguages();
		foreach ($languageList as $lang) {
			//Dem so luong channel trong cat
			$languageID = $lang->id;
			$languageName = $lang->language_name;
			$args = array(
				"channelLanguage" => $languageID
			);
			$channelList = TNT_Channel::tntGetChannels($args);
			$n = count($channelList);
			if($n > 0){
				$view .= "<h3>$languageName</h3>";
				$view .= showChannelListByType($args);
			}
		}
	}
	
	return $view;
}

function showChannelListByType($args){
	$view = "";
	$channelList = TNT_Channel::tntGetChannels($args);
	$n = count($channelList);

	if($n > 0){
		$view .= "<ul class='channelItems'>";
		foreach ($channelList as $c) {
			$cID         = $c->channel_id;
			$cName       = $c->channel_name;
			$cNumber     = $c->channel_number;
			$cCatID      = $c->channel_cat;
			$cImageID    = $c->channel_image;
			$cCountryID  = $c->channel_country;
			$cLanguageID = $c->channel_language;

			if($cName != "")
			{
				$class = "";
				if($cCatID != 0)
				{
					$class .= " catBox";
				}
				if($cCountryID != 0){
					$class .= " countryBox";
				}
				if($cLanguageID != 0){
					$class .= " languageBox"; 
				}
				$img = '<img src="'.TNT_IMG_URL.'/default-thumbnail.jpg" alt="No Image" width="auto" height="50" />';
				if($cImageID > 0)
				{
					$img = wp_get_attachment_image($cImageID, array(9999,50));
				}
				
				$view .= "<li class='".$class."'>";
				$view .= $img;
				$view .= "<p>$cName</p>";
				$view .="</li>";
			}	
		}
		$view .= "</ul>";
	}
	else{
		$view .= "<p>This category doesn't have any channels</p>";
	}
	return $view;
}



?>