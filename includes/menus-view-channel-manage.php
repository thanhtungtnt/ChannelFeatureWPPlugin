<?php
/**
 * Function to display the "video manage" page
 */
function tnt_channel_manage(){
	?>
		<div class="wrap">
			<?php screen_icon('upload') ?>
			<h2>Channel Manager</h2>
			<hr />
			<?php
				//Get var filter
				$catID = (isset($_GET["vCat"])) ? $_GET["vCat"] : 0;
				$orderBy = (isset($_GET["orderBy"])) ? $_GET["orderBy"] : null;
				$order = (isset($_GET["order"])) ? $_GET["order"] : null;

				$tntChannels = TNT_Channel::tntGetChannelsNoCat();
				$items = count($tntChannels);

				$numLimit = 100; 
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
					<td width="100%">
						<select name="tntActions" style="display: none;">
							<!-- <option value="1">Publish</option>
							<option value="2">Unpublish</option> -->
							<option value="3">Delete</option>
						</select>
						<input type="submit" class="button-secondary btnAct" name="tntBtnAct" value="Delete" />
						<a class="button-secondary" href="<?php echo admin_url() ?>admin.php?page=tnt_channel_editall_page">Edit All Channels</a>
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
			<table class="tntTable widefat">
				<thead>
					<tr>
						<td><input type="checkbox" name="tntChkAll" class="tntChkAll" /></td>
						<th>Channel Number</th>
						<th>Name</th>
						<th>Image</th>
						<th>Category</th>
						<th>Country</th>
						<th>Language</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>Channel Number</th>
						<th>Name</th>
						<th>Image</th>
						<th>Category</th>
						<th>Country</th>
						<th>Language</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					<?php 
						$tntChannels = TNT_Channel::tntGetChannelsNoCat(array('channelCat' => $catID, 'limitText' => $limit, 'orderBy' => $orderBy, 'order' => $order));
						foreach ($tntChannels as $tntV):
					 ?>
							<tr id="channel<?php echo $tntV->channel_id;?>">
								<td><input type="checkbox" name="tntChkChannels[]" class="tntSubChk" value="<?php echo $tntV->channel_id ?>" /></td>
								<td>
									<?php echo $tntV->channel_number; ?>
								</td>
								<td><?php echo $tntV->channel_name ?></td>
								<td>
									<?php 
										$img = '<img src="'.TNT_IMG_URL.'/default-thumbnail.jpg" alt="No Image" />';
										if($tntV->channel_image != 0)
										{
											$img = wp_get_attachment_image($tntV->channel_image, array(100,100));	
										}
										echo $img;
									?>
								</td>
								<td>
									<?php 
										$catName = "Uncategorized";
										if($tntV->channel_cat != 0){
											$tntCat = new TNT_ChannelCat();
											$tntCat->tntGetCat($tntV->channel_cat);
											$catName = $tntCat->chcatName;
										}
										echo $catName;
									?>	
								</td>
								<td>
									<?php 
										$countryName = "No Country";
										if($tntV->channel_country != 0){
											//do something
										}
										echo $countryName;
									?>
								</td>
								<td>
									<?php 
										$languageName = "No Language";
										if($tntV->channel_language != 0){
											//do something
										}
										echo $languageName;
									?>
								</td>
								<td>
									<a href="#" rel="<?php echo $tntV->channel_id ?>" class="editChannel button-secondary" style="display: none;">Edit</a> 
									<a href="#" rel="<?php echo $tntV->channel_id; ?>" class="deleteChannel button-secondary">Delete</a>
								</td>
							</tr>
					 <?php endforeach ?>
				</tbody>
			</table><!-- List Video -->
			
			<div id="delDialog" style="display: none;">
				<p>Are you sure?</p>
				<input type="hidden" value="<?php echo $tntV->channel_id; ?>">
			</div>
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
}//tnt_channel_manage