$(document).ready(function(){
//  -------------------------------------------
//  Authored by Cathal Healy
//  For Dealshare.ie
//  -------------------------------------------


	//  -------------------------------------------
	//  EVENT HANDLER FOR COMMENT FORM
	$("#form-comment-add-1").live('submit', function()
	{
		//alert('comment');
		AddComment($(this));
		return false;
	});
	
	$("#form-comment-add-2").live('submit', function()
	{
		AddComment($(this));
		return false;
	});
	//  -------------------------------------------

	//  -------------------------------------------
	//  PROCESS COMMENT FORM REQUEST
	function AddComment($form) {
		var $button = $form.find('input[type="submit"]');
		//  Remove previous errors
		RemoveNotices($form);		
		var errors = ErrorChecking($form);
		var error = 'You have not entered a comment yet!';
		//
		if(errors)
		{
			$form.append(ErrorPanel(error));
		}
		else
		{
			ChangeButtonState($button, false, 'Please wait..');
			var formData = $form.serialize();
			//alert(formData);
			$.post('/scripts/processing/ajax.comment.add.php', formData, function(data)
			{
				ChangeButtonState($button, true, 'Add Comment');
				//alert('back');
				if(data['success'] == true) {
					ClearForm($form.attr('id'));
					$form.append(MessagePanel(data['message']));
				}
				else {
					$form.append(ErrorPanel(data['message']));
				}
			},
			"json"
			);
		}
	}
	//  -------------------------------------------
});