jQuery(document).ready(function($){
	//Set width for each element .tntVideoItem
	var tntMenuUl = $('li.toplevel_page_tnt_channel_manage_page');
	tntMenuUl.find('a[href*="tnt_channel_edit_page"]').css('display', 'none');
	tntMenuUl.find('a[href*="tnt_channel_del_page"]').css('display', 'none');
	tntMenuUl.find('a[href*="tnt_channel_cat_edit_page"]').css('display', 'none');
	tntMenuUl.find('a[href*="tnt_channel_cat_del_page"]').css('display', 'none');

	var tntInfoChannel = '<tr>';
	tntInfoChannel += '<td class="cNumber"><input type="text" name="txtChannelNumber[]" placeholder="Number" /></td>';
	tntInfoChannel += '<td class="cName"><input type="text" name="txtChannelName[]" placeholder="Name" /></td>';
	tntInfoChannel += '<td class="cImage"><input type="hidden" name="txtImgUrl[]" style=" width:100px; vertical-align: top;" /> <button class="set_custom_images button">Choose</button> <img src="http://www.equaladventure.org/wp-content/themes/equal-adventure/images/default-thumbnail.jpg" alt="no thumbnail" width="100" ></td>';
	tntInfoChannel += '<td class="cCat">'+ getListCat() +'</td>';
	tntInfoChannel += '<td class="cCountry">'+ getListCountry() +'</td>';
	tntInfoChannel += '<td class="cLanguage">'+ getListLanguage() +'</td>';
	tntInfoChannel += '<td class="cAction"><a href="#" class="removeItem button-secondary">Remove</a></td>';
	tntInfoChannel += '</tr>';

	var tntVideoMessageError = '<p>Errors! Please check again infos you enter <br />';
	tntVideoMessageError += '- Video title is not empty <br />';
	tntVideoMessageError += '- Video link is not empty and must be link format (ex: http://www.youtube.com/watch?v=9bZkp7q19f0) <br />';
	tntVideoMessageError += '- Order is not empty and must be digits</p>';

	$('.addMoreChannel').click(function(e){
		e.preventDefault();
		e.stopPropagation();
		$('.channelList tbody').append(tntInfoChannel);
		return false;
	});

	$(document).on('click', '.removeItem', function(e){
		e.preventDefault();
		$(this).parent().parent().remove();
	});

	jQuery(document).ready(function() {
	    var $ = jQuery;
	    if ($('.set_custom_images').length > 0) {
	        if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
	            $(document).on('click', '.set_custom_images', function(e) {
	                e.preventDefault();
	                var button = $(this);
	                var id = button.prev();
	                var img = button.next();
	                wp.media.editor.send.attachment = function(props, attachment) {
	                    id.val(attachment.id);
	                    img.attr("src",attachment.url);
	                    img.attr("alt",attachment.title);
	                };
	                wp.media.editor.open(button);
	                return false;
	            });
	        }
	    }
	});

	$('.editChannel').click(function(e){
		e.preventDefault();
		var tr = $(this).parent().parent();
		var channelID       = tr.find('input.chnID').val();
		var channelName     = tr.find('input.chnName').val();
		var channelNumber   = tr.find('input.chnNumber').val();
		var channelImage    = tr.find('input.chnImage').val();
		var channelCat      = tr.find('input.chnCat').val();
		var channelCountry  = tr.find('input.chnCountry').val();
		var channelLanguage = tr.find('input.chnLang').val();

		var cNumberHTML = '<input type="hidden" class="chnID" value="'+ channelID +'"> <input type="hidden" class="chnName" value="'+channelName+'"> <input type="hidden" class="chnNumber" value="'+channelNumber+'"> <input type="hidden" class="chnImage" value="'+channelImage+'"> <input type="hidden" class="chnCat" value="'+channelCat+'"> <input type="hidden" class="chnCountry" value="'+channelCountry+'"> <input type="hidden" class="chnLang" value="'+channelLanguage+'"><input type="text" name="txtChannelNumber" value="'+channelNumber+'" />';
		var cNameHTML = '<input type="text" name="txtChannelName" value="'+ channelName +'" />';
		var cImageHTML = '<input type="hidden" name="txtImgUrl[]" style=" width:100px; vertical-align: top;" /> <button class="set_custom_images button">Choose</button> <img src="'+getDefaultThumbnail()+'" alt="no thumbnail" width="100" >';
		tr.find('td').eq(1).html(cNumberHTML);
		tr.find('td').eq(2).html(cNameHTML);
		tr.find('td').eq(3).html(cImageHTML);


	});

	$('.deleteChannel').click(function(e){
		e.preventDefault();
		console.log('delete works');
		var channelID = $(this).attr("rel");
		console.log(channelID);
		var delDialog = $(this).next();
		$('#delDialog').dialog({
	      resizable: false,
	      height: "auto",
	      width: 400,
	      modal: true,
	      buttons: {
	        "Delete": function() {
				$(this).dialog("close");
				$('.tntTable #channel'+channelID).fadeOut();
				$.ajax({
				  url: 'http://setvnow.local/wp-admin/admin-ajax.php',
				  dataType: 'json',
				  data: {
				      action: 'tnt_ajax_delete_channel',
				      cID: channelID 
				  },
				  success: function(data){
				      console.log(data);
				  }
				});
	        },
	        Cancel: function() {
	          $( this ).dialog( "close" );
	        }
	      }
	    });
	});	


	$('.removeVideoItem').live('click', function(){
		$(this).parent().parent().parent().parent().remove();
	});

	$("#addVideoForm").validate();
	var validator = $("#addVideoForm").bind("invalid-form.validate", function() {
		$(".errorContainer").html(tntVideoMessageError);
		$(".errorContainer").addClass("dpb");
	}).validate({
		debug: true,
		errorElement: "em",
		errorContainer: $(".errorContainer")
	});

	$('#editVideoForm').validate({
		rules:{
			vTitle: {
				required: true
			},
			vLink: {
				required: true,
				url: true
			},
			vOrder: {
				required: true,
				digits: true
			}
		},
		messages:{
			vTitle: {
				required: "Please enter video title"
			},
			vLink: {
				required: "Please enter video link",
				url: "Must be link format"
			},
			vOrder: {
				required: "Please enter order number"
			}
		}
	});

	$('#editVideoCatForm').validate({
		rules:{
			catTitle : "required"
		},
		messages:{
			catTitle :{
				required: "Please enter category title"
			}
		}
	});

	$('#optionVideoForm').validate({
		rules:{
			videoLimit:{
				required: true,
				digits: true
			},
			videoLimitAdmin:{
				required: true,
				digits: true
			},
			videoColumn:{
				required: true,
				digits: true
			},
			videoWidth:{
				required: true,
				digits: true
			},
			videoHeight:{
				required: true,
				digits: true
			}
		}
	});
});	