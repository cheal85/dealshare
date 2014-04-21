
<div class="span-9 res right ">
	<div class="padding-10 ">
        <div class="span-12 clear right" >
            <div class="span-8 shadow clear left form-wrapper" >
                <div class="padding-20">
                    <?php include(DIR_FORMS . '/form_account_add-deal.php'); ?>
                </div>
            </div>
            
            <div class="span-4 shadow right" >
                <div class="padding-10 ">
                    <div class=" upload-holder">
                        <?php $image = $myImageManager -> GetImage(2, 'medium');
                        echo '<div class="js-avatar clear centre padding " style="width: 90%; height: 90%;"><img src="' . $image['full_path'] . '" class="centre avatar ' . $image['orientation'] . '" /></div>';
                        #echo <div class="centre" style="display:none; width: 200px; height: 200px;"><img src="" class="img-loading" /></div>
                        ?>
                        <div id="user-uploader" class=" full clear centre" >  </div>
                    </div>
                </div>
            </div>
            <!--
           	<div class="span-12 shadow form-wrapper right res-tab res-mob" >
            	<div class="padding-10 ">
            	<?php #include(DIR_FORMS . '/form_account_add-deal_mobile.php'); ?>
                </div>
            </div>
            -->

		</div>
	</div>
</div>



