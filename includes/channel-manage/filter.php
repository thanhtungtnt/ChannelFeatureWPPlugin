<!-- Filter Feature -->
<form action="" method="GET">
<table width="100%" style="margin-bottom: 10px">
	<tr>
		<td width="10%">
			<?php 
				$filterCat = 0;
				$filterCountry = 0;
				$filterLanguage = 0;
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
				<input type="hidden" name="page" value="tnt_channel_manage_page">
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