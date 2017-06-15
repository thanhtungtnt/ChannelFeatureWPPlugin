<!-- Filter Feature -->
<form action="" method="GET">
<table width="100%" class="tableFilter">
	<tr>
		<td width="10%">
			<?php 
				$filterCat = (isset($_GET["sbChannelCat"]) == true) ? $_GET["sbChannelCat"] : 0;
				$filterCountry = (isset($_GET["sbCountry"]) == true) ? $_GET["sbCountry"] : 0;
				$filterLanguage = (isset($_GET["sbLanguage"]) == true) ? $_GET["sbLanguage"] : 0;
				$sortBy   = "";
				$sortOrder = "";
				if(isset($_GET["btnFilter"])){
					$filterCat = $_GET["sbChannelCat"];
					$filterCountry = $_GET["sbCountry"];
					$filterLanguage = $_GET["sbLanguage"];
					$sortBy    = $_GET["sortBy"];
					$sortOrder = $_GET["sortOrder"];
				}
			 ?>
				<input type="hidden" name="page" value="tnt_channel_editall_page">
				Filter By: 
				<?php echo TNT_ChannelCat::tntDisplayListCatSingle($filterCat); ?>
				<?php echo TNT_Country::tntDisplayListCountrySingle($filterCountry); ?>
				<?php echo TNT_Language::tntDisplayListLanguageSingle($filterLanguage); ?>
		</td>
	</tr>
	<tr>
		<td width="10%">
			Sort By: 
			<select name="sortBy">
				<option value="channel_number" <?php echo ($sortBy == "channel_number") ? "selected" : ""; ?>>Channel Number</option>
				<option <?php echo ($sortBy == "channel_name") ? "selected" : ""; ?> value="channel_name">Channel Name</option>
			</select>
			<select name="sortOrder">
				<option value="ASC" <?php echo ($sortOrder == "ASC") ? "selected" : ""; ?>>Ascending</option>
				<option value="DESC" <?php echo ($sortOrder == "DESC") ? "selected" : ""; ?>>Descending</option>
			</select>
		</td>
	</tr>
	<tr>
		<td><input type="submit" name="btnFilter" class="button-secondary" value="Filter and Sort"></td>
	</tr>
</table><!-- end Filter Feature -->
</form>