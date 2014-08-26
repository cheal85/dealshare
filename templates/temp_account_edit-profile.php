
<div id="account-edit" class="span-9 res right account-block">
	<div class="padding-20 ">
        <h2 class="color-5 text-centre span-12">Edit Details</h2>
        <div class="span-7 centre res clear form-wrapper " >
		  <?php 
            echo '<div class="top-bottom" >';
                $USER['image'] = $myImageManager -> GetImage($USER['id_image'], 'medium');
                echo '<div class="user-upload-image js-image clear centre " >';
                    echo '<div class="js-loading clear centre padding " style="display:none; ">';
                    echo '<div class="centre" style="width: 64px; height: 64px;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>';
                    echo '</div>';
                    echo '<img src="' . $USER['image']['full_path'] . '" class="content left ' . $USER['image']['orientation'] . '" />';
                echo '</div>';
            echo '</div>';
            echo '<div id="image-uploader" class="span-6 res clear centre" >  </div>';
            include(DIR_FORMS . '/form_account_edit-profile.php'); 
          ?>
	    </div> 
	</div>
</div>



