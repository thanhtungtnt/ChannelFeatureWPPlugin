<?php
/**
 * Function to display the "Add Channel" page
 */
function tnt_channel_add(){
	?>
		<div class="wrap">
			<?php screen_icon('edit') ?>
			<h2>Add Channel</h2>
			<form id="addVideoForm" method="POST" action="">
				<div id="message" class="errorContainer error dpn"></div>
				<?php 
					$currentUser = wp_get_current_user();
				?>
				<input type="hidden" name="vUserID" value="<?php echo $currentUser->ID; ?>" />
				<table>
					<tr>
						<td>
							<input type="submit" name="tntAddChannel" value="Add Channel" class="button-primary"/>
							<a href="#" class="addMoreChannel button-secondary">Add More</a>
							<input type="submit" name="reset" value="Reset" class="button-secondary">
						</td>
					</tr>
				</table>
				<table class="channelList widefat">
					<thead>
					<tr>
						<th class="cNumber">Number</th>
						<th class="cName">Name</th>
						<th class="cImage">Image</th>
						<th class="cCat">Category</th>
						<th class="cCountry">Country</th>
						<th class="cLanguage">Language</th>
						<th class="cAction"></th>
					</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Number</th>
							<th>Name</th>
							<th>Image</th>
							<th>Category</th>
							<th>Country</th>
							<th>Language</th>
							<th></th>
						</tr>
					</tfoot>
					<tbody>
						<tr valign="top">
							<td class="cNumber"><input type="text" name="txtChannelNumber[]" placeholder="Number" /></td>
							<td class="cName"><input type="text" name="txtChannelName[]" placeholder="Name" /></td>
							<td class="cImage"><input type="hidden" name="txtImgUrl[]" style=" width:100px; vertical-align: top;" /> <button class="set_custom_images button">Choose</button> <img src="<?php echo TNT_IMG_URL;?>/default-thumbnail.jpg" alt="no thumbnail" width="100" ></td> 
							<td class="cCat"><?php echo TNT_ChannelCat::tntDisplayListCat(); ?></td>
							<td class="cCountry"><?php echo TNT_Country::tntDisplayListCountry(); ?></td>
							<td class="cLanguage"><?php echo TNT_Language::tntDisplayListLanguage(); ?></td>
							<td class="cAction"><a href="#" class="removeItem button-secondary">Remove</a></td>
						</tr>
					</tbody>	
				</table>
			</form>
			<script type="text/javascript">
				function getListCat(){
					var html = '<?php echo TNT_ChannelCat::tntDisplayListCat(); ?>'; 
					return html;
				}

				function getListCountry(){
					var html = '<?php echo TNT_Country::tntDisplayListCountry(); ?>'; 
					return html;
				}

				function getListLanguage(){
					var html = '<?php echo TNT_Language::tntDisplayListLanguage(); ?>'; 
					return html; 
				}
				function getDefaultThumbnail(){
					var url = '<?php echo TNT_IMG_URL;?>/default-thumbnail.jpg ?>';
					return url;
				}
			</script>
		</div>
	<?php
}//tnt_channel_add