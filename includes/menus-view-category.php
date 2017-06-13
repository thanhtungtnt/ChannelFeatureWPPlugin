<?php
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