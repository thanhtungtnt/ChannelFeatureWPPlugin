<?php 
/**
 * Custom Menu Display
 * 
 * Author: Tung Pham
 */

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

				$tntChannels = TNT_Channel::tntGetChannels(array('channelCat' => $catID));
				$items = count($tntChannels);

				$numLimit = 10; 
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
				    $limit = "LIMIT 0, 10";
				}
			?>
			<!-- Message -->
			<div class='<?php echo ($items > 0) ? "updated" : "error" ?>'><p><?php echo $items ?> Result(s) found!</p></div>    
			<!--End  Message -->

			<form method="POST" action="">
			<table>
				<tr>
					<!-- <td align="left" width="70">Actions</td> -->
					<td align="left" width="95">
						<select name="tntActions" style="display: none;">
							<!-- <option value="1">Publish</option>
							<option value="2">Unpublish</option> -->
							<option value="3">Delete</option>
						</select>
						<input type="submit" class="button-secondary btnAct" name="tntBtnAct" value="Delete" />
					</td>	
				</tr>
			</table>
			
			<!-- List Video -->
			<table class="tntTable widefat">
				<thead>
					<tr>
						<td><input type="checkbox" name="tntChkAll" class="tntChkAll" /></td>
						<th>ID</th>
						<th>Channel Number</th>
						<th>Name</th>
						<th>Image</th>
						<th>Category</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th></th>
						<th>ID</th>
						<th>Channel Number</th>
						<th>Name</th>
						<th>Image</th>
						<th>Category</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					<?php 
						$tntChannels = TNT_Channel::tntGetChannels(array('channelCat' => $catID, 'limitText' => $limit, 'orderBy' => $orderBy, 'order' => $order));
						foreach ($tntChannels as $tntV):
					 ?>
							<tr id="channel<?php echo $tntV->channel_id;?>">
								<td><input type="checkbox" name="tntChkVideos[]" class="tntSubChk" value="<?php echo $tntV->channel_id ?>" /></td>
								<td><?php echo $tntV->channel_id ?></td>
								<td><?php echo $tntV->channel_number ?></td>
								<td><?php echo $tntV->channel_name ?></td>
								<td><img src="<?php echo $tntV->channel_image;?>" alt="<?php echo $tntV->channel_name; ?>" width="100" /></td>
								<td><?php echo $tntV->chcat_name ?></td>
								<td>
									<a href="#" rel="<?php echo $tntV->channel_id ?>" class="editChannel button-secondary">Edit</a> 
									<a href="#" rel="<?php echo $tntV->channel_id; ?>" class="deleteChannel button-secondary">Delete</a>
									<div id="delDialog" style="display: none;">
										<p>Are you sure?</p>
										<input type="hidden" value="<?php echo $tntV->channel_id; ?>">
									</div>
								</td>
							</tr>
					 <?php endforeach ?>
				</tbody>
			</table><!-- List Video -->

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

					if(rs == false)
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
		</script>
	<?php
}//tnt_channel_manage

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
						<td>Select Category</td>
						<td>
							<?php echo TNT_ChannelCat::tntDisplayListCat(); ?>
						</td>
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
						<th width="20%">Channel Number</th>
						<th width="40%">Name</th>
						<th width="40%">Image</th>

					</tr>
					</thead>
					<tfoot>
						<tr>
							<th>Channel Number</th>
							<th>Name</th>
							<th>Image</th>
						</tr>
					</tfoot>
					<tbody>
						<tr valign="top">
							<td><input type="text" name="txtChannelNumber[]" placeholder="Channel Number" /></td>
							<td><input type="text" name="txtChannelName[]" placeholder="Channel Name" size="50"/></td>
							<td><input type="text" name="txtImgUrl[]" style="vertical-align: top;" /> <button class="set_custom_images button">Set Image ID</button> <img src="http://www.equaladventure.org/wp-content/themes/equal-adventure/images/default-thumbnail.jpg" alt="no thumbnail" width="100" ></td> 
						</tr>
					</tbody>	
				</table>
			</form>
		</div>
	<?php
}//tnt_channel_add

/**
 * Function to display the "video category manage" page
 */
function tnt_channel_cat_manager(){
	?>
		<div class="wrap">
			<?php screen_icon('upload') ?>
			<h2>Channel Category Manage</h2>
			<hr />
			<table class="tntTable widefat">

				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Amount of Channels</th>
						<th>Parent</th>
						<th>Shortcode</th>
						<th>Action</th>
					</tr>
				</thead>
				<tfoot>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Amount of Channels</th>
						<th>Parent</th>
						<th>Shortcode</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					<?php 
						$tntChannelCats = TNT_ChannelCat::tntGetCats();
						foreach ($tntChannelCats as $tntC):
					 ?>
							<tr>
								<td><?php echo $tntC->chcat_id ?></td>
								<td><b><a href="<?php echo admin_url() ?>admin.php?page=tnt_channel_cat_edit_page&catID=<?php echo $tntC->chcat_id; ?>"><?php echo $tntC->chcat_name ?></a></b></td>
								<td>
									<?php 
										$channels = TNT_Channel::tntGetChannels(array('channelCat'=>$tntC->chcat_id)) ;
										$channelsCount = count($channels);
									?>
									<b><a href="<?php echo admin_url() ?>admin.php?page=tnt_channel_manage_page&vCat=<?php echo $tntC->chcat_id; ?>"><?php echo $channelsCount ?></a></b>
								</td>
								<td><?php echo $tntC->chcat_parent ?></td>
								<td><?php echo '[tnt_channel_list id='.$tntC->chcat_id.']' ?></td>
								<td>
									<a href="<?php echo admin_url() ?>admin.php?page=tnt_channel_cat_edit_page&catID=<?php echo $tntC->chcat_id; ?>" class="button-secondary">Edit</a> 
									<a href="<?php echo admin_url() ?>admin.php?page=tnt_channel_cat_del_page&catID=<?php echo $tntC->chcat_id; ?>" class="button-secondary">Delete</a>
								</td>
							</tr>
					 <?php endforeach ?>
				</tbody>
			</table>
		</div>
	<?php
}//tnt_channel_cat_manager

/**
 * Function to display the "Add Channel category" page
 */
function tnt_channel_cat_add(){
	?>
		<div class="wrap">
			<?php screen_icon('edit') ?>
			<h2>Add Channel Category</h2>
			<?php 
				//show message
				if(isset($_GET["m"]))
				{
					$m = $_GET["m"];
					if($m) 
					{
						showMessage("Your channel category added successfully!", $m);
					}
					else
					{
						showMessage("Your channel category added failed!", $m);	
					}	
				}
			 ?>
			<form method="POST" action="">
				<table class="tntFormTable form-table">
					<tr valign="top">
						<th scope="row"><label for="catTitle">Category Name</label></th>
						<td>
							<input type="text" size="50" name="catTitle" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"></th>
						<td>
							<input type="submit" name="tntAddChannelCat" value="Add Category" class="button-primary"/>
							<input type="submit" name="reset" value="Reset" class="button-secondary">
						</td>
					</tr>
				</table>
			</form>
		</div>
	<?php
}//tnt_channel_cat_add

/**
 * Function to display the "edit video category" page
 */
function tnt_channel_cat_edit(){
	?>
		<div class="wrap">
			<?php screen_icon('edit') ?>
			<h2>Edit Channel Category</h2>
			<?php
				$catID = (isset($_GET['catID'])) ? $_GET['catID'] : 0;
				$c = new TNT_ChannelCat(); 
				if($catID != 0)
				{
					$c->tntGetCat($catID);	
				}
				else
				{
					wp_die("catID not found");
				}

				//show message
				if(isset($_GET["m"]))
				{
					$m = $_GET["m"];
					if($m) 
					{
						showMessage("Your video category edited successfully!", $m);
					}
					else
					{
						showMessage("Your video category edited failed!", $m);	
					}	
				}
			 ?>
			<form id="editVideoCatForm" method="POST" action="">
				<input type="hidden" name="catID" value="<?php echo $c->chcatID ?>" /> 
				<table class="tntFormTable form-table">
					<tr valign="top">
						<th scope="row"><label for="catTitle">Category Title</label></th>
						<td>
							<input type="text" size="50" name="catTitle" value="<?php echo $c->chcatName ?>" />
						</td>
					</tr>
					<tr valign="top">
						<th scope="row"></th>
						<td>
							<input type="submit" name="tntEditChannelCat" value="Edit Category" class="button-primary"/>
							<input type="submit" name="reset" value="Reset" class="button-secondary">
						</td>
					</tr>
				</table>
			</form>
		</div>
	<?php
}//tnt_channel_cat_edit

/**
 * Function to display the "delete video cat" page
 */
function tnt_channel_cat_del(){
	?>
		<div class="wrap">
			<?php screen_icon('edit') ?>
			<h2>Delete Channel Category</h2>
			<?php
				$c = new TNT_ChannelCat(); 
				$catID = (isset($_GET['catID'])) ? $_GET['catID'] : 0;
				if($catID != 0)
				{
					$c->tntGetCat($catID);
				}
				else
				{
					wp_die("catID not found");
				}
			 ?>
			<form method="POST" action="">
				<input type="hidden" name="catID" value="<?php echo $c->chcatID ?>" />
				<div style="padding-bottom: 10px;">
					<p>Do you want to delete the channel category "<?php echo $c->chcatName ?>" ? </p>
					<input type="submit" name="tntDelChannelCat_Yes" class="button-secondary" value="Yes" />
					<input type="submit" name="tntDelChannelCat_No" class="button-secondary" value="No" />
				</div>
			</form>
		</div>
	<?php
}//tnt_channel_cat_del
?>