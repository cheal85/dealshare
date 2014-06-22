
<div id="account-edit" class="span-9 res right account-block">
	<div class="padding-20 ">
        <h2 class="color-5 text-centre span-12">Edit Details</h2>
            <div class="span-7 centre res clear form-wrapper " >
                      <?php 
					  	echo '<div class="padding-20" >';
						  	$USER['image'] = $myImageManager -> GetImage($USER['id_image'], 'medium');
		                  	echo '<div class="user-profile-image js-avatar clear centre " >';
						  		echo '<img src="' . $USER['image']['full_path'] . '" class="content left ' . $USER['image']['orientation'] . '" />';
							echo '</div>';
	                      	echo '<div class="centre" style="display:none; width: 200px; height: 200px;"><img src="" class="img-loading" /></div>';
						echo '</div>';
                      	echo '<div id="user-uploader" class="span-6 res clear centre" >  </div>';
		            include(DIR_FORMS . '/form_account_edit-profile.php'); 
					?>
            
            
			<!-- <div class="span-4 res  right" >
				<div class="span-12 shadow">
				  <div class="padding-10 ">
				    <h3 class="color-5">Select an Avatar</h3>
				      <div class="sep-10">&nbsp;</div>
				      <div class=" upload-holder ">
				          <?php $image = $myImageManager -> GetImage($USER['id_image'], 'medium');
				          echo '<div class="js-avatar clear centre padding " style="width: 200px; height: 200px;"><img src="' . $image['full_path'] . '" class="centre avatar ' . $image['orientation'] . '" /></div>';
				          #echo <div class="centre" style="display:none; width: 200px; height: 200px;"><img src="" class="img-loading" /></div>
				          ?>
				          <div id="user-uploader" class="span-12 clear centre" >  </div>
				      </div>
				  </div>
				</div>          
				<div class="sep-10">&nbsp;</div>
				<div class="span-12 shadow right form-wrapper relative" >
				  <div class="padding-10 relative">
				      <?php include(DIR_FORMS . '/form_account_change-password.php'); ?>
				  </div>
				</div>
			</div>-->
        </div> 
	</div>
</div>



