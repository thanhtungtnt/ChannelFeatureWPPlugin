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


				//Get Plugin Options
				$tntOptions = get_option('tntVideoManageOptions');
				$numLimit = $tntOptions['limitAdminPerPage']; 
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
			<?php 
				//show message
				if(isset($_GET["m"]))
				{
					$m = $_GET["m"];
					if($m) 
					{
						showMessage("Your video(s) updated successfully!", $m);
					}
					else
					{
						showMessage("Your video(s) updated failed!", $m);	
					}	
				}
			 ?>
			<!-- List Video -->
			<table class="tntTable widefat">
				<thead>
					<tr>
						<td><input type="checkbox" name="tntChkAll" class="tntChkAll" /></td>
						<th>ID</th>
						<th>Channel Number</th>
						<th>Name</th>
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
						<th>Category</th>
						<th>Action</th>
					</tr>
				</tfoot>
				<tbody>
					<?php 
						$tntChannels = TNT_Channel::tntGetChannels(array('channelCat' => $catID, 'limitText' => $limit, 'orderBy' => $orderBy, 'order' => $order));
						foreach ($tntChannels as $tntV):
					 ?>
							<tr>
								<td><input type="checkbox" name="tntChkVideos[]" class="tntSubChk" value="<?php echo $tntV->channel_id ?>" /></td>
								<td><a href="<?php echo admin_url() ?>admin.php?page=tnt_channel_edit_page&videoID=<?php echo $tntV->channel_id; ?>"><b><?php echo $tntV->channel_id ?></b></a></td>
								<td><?php echo $tntV->channel_number ?></td>
								<td><b><a href="<?php echo admin_url() ?>admin.php?page=tnt_channel_edit_page&videoID=<?php echo $tntV->channel_id; ?>"><?php echo $tntV->channel_name ?></a></b></td>
								<td><?php echo $tntV->chcat_name ?></td>
								
								<td>
									<a href="<?php echo admin_url() ?>admin.php?page=tnt_channel_edit_page&channelID=<?php echo $tntV->channel_id; ?>" class="button-secondary">Edit</a> 
									<a href="<?php echo admin_url() ?>admin.php?page=tnt_channel_del_page&channelID=<?php echo $tntV->channel_id; ?>" class="button-secondary">Delete</a>
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
 * Function to display the "add video" page
 */
function tnt_channel_add(){
	?>
		<div class="wrap">
			<?php screen_icon('edit') ?>
			<h2>Add Video</h2>
			<?php 
				//show message
				if(isset($_GET["m"]))
				{
					$m = $_GET["m"];
					if($m) 
					{
						showMessage("Your video(s) added successfully!", $m);
					}
					else
					{
						showMessage("Your video(s) added failed!", $m);	
					}	
				}
			 ?>
			<form id="addVideoForm" method="POST" action="">
				<div id="message" class="errorContainer error dpn"></div>
				<?php 
					$currentUser = wp_get_current_user();
				?>
				<input type="hidden" name="vUserID" value="<?php echo $currentUser->ID; ?>" />
				<table class="borderB form-table">
					<tr valign="top">
						<th scope="row"><label for="vCat">Select Category</label></th>
						<td>
							<?php echo TNT_ChannelCat::tntDisplayListCat(); ?>
						</td>
					</tr>
				</table>
				<div class="infoVideoWrapper">
					<table class="infoVideo borderDB form-table">
						<tr valign="top">
							<th scope="row"><label for="vTitle">Title</label></th>
							<td><input type="text" class="required" size="50" name="vTitle[]" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="vLink">Link</label></th>
							<td><input type="url" class="required" size="50" name="vLink[]" /></td>
						</tr>
						<tr valign="top">
							<th scope="row"><label for="vStatus">Status</label></th>
							<td>
								<select name="vStatus[]">
									<option value="1">Published</option>
									<option value="0">Unpublished</option>
								</select>
							</td>
						</tr>
						<tr>
							<th scope="row"><label for="vOrder">Order Number</label></th>
							<td><input type="text" class="required digits" size="3" name="vOrder[]" value="100" /></td>
						</tr>
						<tr>
							<th scope="row"></th>
							<td><a href="#" class="removeVideoItem button-secondary" title="Remove Video Item">Remove</a></td>
						</tr>
					</table>
				</div>
				<table class="form-table">
					<tr valign="top">
						<th scope="row"></th>
						<td>
							<input type="submit" name="tntAddVideo" value="Add Video" class="button-primary"/>
							<button class="addMoreVideo button-secondary">Add More</button>
							<input type="submit" name="reset" value="Reset" class="button-secondary">
						</td>
					</tr>
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
 * Function to display the "add video category" page
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