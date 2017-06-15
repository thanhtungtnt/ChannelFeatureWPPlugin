<?php
/**
 * Function to display the "channel manage" page
 */
function tnt_channel_editall(){
	?>
		<div class="wrap">
			<?php screen_icon('upload') ?>
			<h2>Edit All Channels</h2>
			<hr />

			<?php require_once(TNT_INC_PATH . '/editall-channel/filter.php'); ?>

			<?php
				$tntChannels = TNT_Channel::tntGetChannelsNoCat(array(
					'channelCat'      => $filterCat,
					'channelCountry'  => $filterCountry,
					'channelLanguage' => $filterLanguage, 
					'limitText'       => $limit, 
					'orderBy'         => $sortBy, 
					'order'           => $sortOrder
				));
				$items = count($tntChannels);
				$numLimit = 50; 
				if($items > $numLimit) {
			        $p = new TNT_Pagination();
			        $p->items($items);
			        $p->limit($numLimit); // Limit entries per page
			        $p->target($_SERVER["REQUEST_URI"]); 
			        $p->calculate(); // Calculates what to show
			        $p->parameterName('paged');
			        $p->adjacents(1); //No. of page away from the current page
			                 
			        if(!isset($_GET['paged'])) {
			            $p->page = 1;
			        } else {
			            $p->page = $_GET['paged'];
			        }
			        $p->currentPage($p->page); // Gets and validates the current page
			         
			        //Query for limit paging
			        $limit = "LIMIT " . ($p->page - 1) * $p->limit  . ", " . $p->limit;
				         
				} else {
				    $limit = "LIMIT 0, 100";
				}
			?>
			<!-- Message -->
			<div class='<?php echo ($items > 0) ? "updated" : "error" ?>'><p><?php echo $items ?> Result(s) found!</p></div>    
			<!--End  Message -->
			<form method="POST" action="">
			<table width="100%" style="margin-bottom: 10px;">
				<tr>
					<!-- <td align="left" width="70">Actions</td> -->
					<td align="left" width="100%">
						<input type="submit" class="button-primary btnUpdateAll" name="btnUpdateAll" value="Update All" />
						<?php if ($items > $numLimit): ?>
							<div class="tablenav">
							    <div class='tablenav-pages'>
							        <?php echo $p->show();  // Echo out the list of paging. ?>
							    </div>
							</div>				
						<?php endif ?>
					</td>	
				</tr>
			</table>
			
			<!-- List Video -->
			<table class="channelList tntTable widefat">
				<thead>
					<tr>
						<th class="cNumber">Number</th>
						<th class="cName">Name</th>
						<th class="cImage">Image</th>
						<th class="cCat">Category</th>
						<th class="cCountry">Country</th>
						<th class="cLanguage">Language</th>
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
					</tr>
				</tfoot>
				<tbody>
					<?php 
						$tntChannels = TNT_Channel::tntGetChannelsNoCat(array(
							'channelCat'      => $filterCat,
							'channelCountry'  => $filterCountry,
							'channelLanguage' => $filterLanguage, 
							'limitText'       => $limit, 
							'orderBy'         => $sortBy, 
							'order'           => $sortOrder
						));
						foreach ($tntChannels as $tntV):
					 ?>
							<tr id="channel<?php echo $tntV->channel_id;?>">
								<td class="cNumber">
									<input type="hidden" name="txtChannelID[]" value="<?php echo $tntV->channel_id; ?>">
									<input type="text" name="txtChannelNumber[]" placeholder="Number" value="<?php echo $tntV->channel_number; ?>" />
								</td>
								<td class="cName"><input type="text" name="txtChannelName[]" placeholder="Name" value="<?php echo $tntV->channel_name ?>" /></td>
								<td class="cImage">
									<?php 
										$img = '<img src="'.TNT_IMG_URL.'/default-thumbnail.jpg" alt="No Image" height="50" />';
										if($tntV->channel_image != 0)
										{
											$img = wp_get_attachment_image($tntV->channel_image, array(50,50));	
										}
									?>
									<input type="hidden" name="txtImgUrl[]" style=" width:100px; vertical-align: top;" value="<?php echo $tntV->channel_image; ?>" /> <button class="set_custom_images button">Choose</button> <?php echo $img; ?>
								</td>
								<td class="cCat"><?php echo TNT_ChannelCat::tntDisplayListCat($tntV->channel_cat); ?></td>
								<td class="cCountry"><?php echo TNT_Country::tntDisplayListCountry($tntV->channel_country); ?></td>
								<td class="cLanguage"><?php echo TNT_Language::tntDisplayListLanguage($tntV->channel_language); ?></td>
							</tr>
					 <?php endforeach ?>
				</tbody>
			</table><!-- List Video -->
			
			<div id="delDialog" style="display: none;">
				<p>Are you sure?</p>
				<input type="hidden" value="<?php echo $tntV->channel_id; ?>">
			</div>
			<?php if ($items > $numLimit): ?>
				<div class="tablenav">
				    <div class='tablenav-pages'>
				        <?php echo $p->show();  // Echo out the list of paging. ?>
				    </div>
				</div>				
			<?php endif ?>
			</form>
		</div>
		<script type="text/javascript">
			jQuery(document).ready(function($){
				//check if have any videos checked
				$(".btnAct").click(function(e){
					var rs = false;
					$('.tntTable tr').each (function ()
					{
						var checkbox = $(this).find(".tntSubChk");
						if (checkbox.is (':checked'))
						{
							rs = true;
						}
					});
					if(rs === false)
					{
						alert("No Items checked");
						e.preventDefault();	
					}
				});
				$(".tntChkAll").click(function(){
					if($(this).is(":checked"))
					{
						$('.tntTable tr').each (function ()
						{
							var checkbox = $(this).find(".tntSubChk");
							checkbox.attr("checked", "checked");
						});
					}
					else
					{
						$('.tntTable tr').each (function ()
						{
							var checkbox = $(this).find(".tntSubChk");
							checkbox.removeAttr("checked");
						});	
					}
				});
			});	
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
	<?php
}//tnt_channel_editall