<!--
<div id="site-top" class="clear back-color-5">
	<div class="res span-12 centre " style="max-height: 30px;">

		<div class=" centre">
		    <div id="search-container" class="left res span-3">
		    	<form id="search-form" method="post" class="centre" action="/scripts/processing/process.search.php" >
					<input class="clear span-12 centre" type="text" placeholder="Search for Deals" name="search" value="<?php #echo $search; ?>" />
					<input id="search" type="hidden" value=" <?php #echo $search; ?> " />
		    	</form>
		    </div>
		    
		    <div id="account-links" class="right text-right res-des">
		    <?php
			/*
		        if(!LOGGED_IN)
		        {				
		            echo '<p class="right "><a id="" class="modal color-4 js-login" href="javascript:;" title="Login to your account">Login</a></p>';
		            #echo '<p class="right no-border res-mob res-tab"><a id="" class="modal color-4" href="/login/" title="Login to your account">Login</a></p>';
		        }
		        else
		        {
		            echo '<p class="right " ><a class="color-4" href="/scripts/processing/logout.php" title="Log out of your account" >Logout</a></p>';
		         	echo '<p class="right " ><a  class="color-4" href="/account/" title="View your Account" >Account</a></p>';
		        }
		         	echo '<p class="right " ><a  class="color-4" href="/contact/" title="Get in Touch" >Contact us</a></p>';
		         	echo '<p class="right no-border" ><a  class="color-4 " href="/about/" title="Learn more about Dealshare.ie" >About us</a></p>';
					*/
		    ?>
			
		    </div>
		</div>
	</div>
	
</div>
-->
<?php
//  ----------------------------------------------
//  display cookie bar
if(!$ALLOW_COOKIES) { //  if message has not already been dismissed
	include(DIR_TEMPLATES . '/temp_cookie_bar.php');
}

?>

<div id="header" class="clear ">
	<div class=" res span-12 centre ">
		<?php
        echo '<div class="logo-wrapper left res-des span-3 ">';
        echo '<a class="logo left block" href="/" title="Dealshare.ie" ><img src="/web_graphics/logo.png" alt="logo" class="landscape image-item" /></a>';
        echo '</div>';
        echo '<div class="logo-wrapper left res-tab span-6 ">';
        echo '<a href="javascript:;" class="js-menu-button span-3 left clear">&nbsp;</a>';
        echo '<a class="logo span-9 left" href="/" title="Dealshare.ie" ><img src="/web_graphics/logo.png" alt="logo" style="height: 100%;"/></a>';
        echo '</div>';
        echo '<div class="logo-wrapper left res-mob span-12 ">';
        echo '<a href="javascript:;" class="js-menu-button span-3 left clear">&nbsp;</a>';
        echo '<a class="logo span-9 left" href="/" title="Dealshare.ie" ><img src="/web_graphics/logo.png" class="left logo-image" alt="logo" /></a>';
        echo '</div>';
		
		echo '<div class="res-des right ">';
			if(LOGGED_IN) {
				$USER['image'] = format($myImageManager -> GetImage($USER['id_image'], 'tiny'));
				echo '<div class="padding-5 right" >';
					echo '<div class="user-image" ><a href="/account/" title="view your account" >';
					echo '<img src="' . $USER['image']['full_path'] . '" class="content ' . $USER['image']['orientation'] . '" />';
					echo '</a></div>';
				echo '</div>';
				//
				echo '<div class="right padding-5" >';
				echo '<p class="clear right ">Welcome, <a href="/account/" title="view your account" >' . $USER['name'] . '</a></p>';
				echo '<p class="clear right "><a class="text-small" href="/scripts/processing/logout.php" title="logout of your account" >logout</a></p>';
				echo '</div>';
			}
			else {
				echo '<div class="padding-5 right" >';
					echo '<div class="user-image" ><a class="modal js-login" href="javascript:;" title="login to your account" >';
					echo '<img src="/web_graphics/placeholder-1-grey-small.jpg" class="content portrait" />';
					echo '</a></div>';
				echo '</div>';
				//
				echo '<div class="right padding-10" >';
					echo '<p class="clear right "><a class="modal js-login" href="javascript:;" title="login to your account" >login</a></p>';
				echo '</div>';
			}
		echo '</div>';
		?>
	
	</div>
</div>
<?php
if($page == 'homepage') {
echo '<div class="sub-header back-color-4 clear span-12 ">';
    echo '<div class=" res span-12 text-centre centre" >';
    	echo '<div class=" span-12 nav-menu res-margin-top" >';
		    
	  		echo '<div id="search-container" class="left res span-2 res-tab res-mob ">';
	  	        echo '<form id="search-form" method="post" class="centre padding-5" action="/scripts/processing/process.search.php" >';
	  	            echo '<input class="clear span-12 left" type="text" placeholder="search for deals" name="search" value="' . $search . '" />';
	  	            echo '<input id="search" type="hidden" value="' . $search . '" />';
	  	        echo '</form>';
	  	    echo '</div>';
				/*
            	echo '<div id="account-links" class="left res-des ">';
			        if(!LOGGED_IN)
			        {				
			            echo '<p class="left "><a id="" class="modal color-4 js-login" href="javascript:;" title="Login to your account">Login</a></p>';
			            #echo '<p class="right no-border res-mob res-tab"><a id="" class="modal color-4" href="/login/" title="Login to your account">Login</a></p>';
			        }
			        else
			        {
			            #echo '<p class="left " ><a class="color-4" href="/scripts/processing/logout.php" title="Log out of your account" >Logout</a></p>';
			         	echo '<p class="left " ><a  class="color-4" href="/account/" title="View your Account" >Account</a></p>';
			        }
			         	echo '<p class="left " ><a  class="color-4" href="/contact/" title="Get in Touch" >Contact us</a></p>';
			         	echo '<p class="left " ><a  class="color-4 " href="/about/" title="Learn more about Dealshare.ie" >About us</a></p>';
					
				
			    echo '</div>';
				*/
				print '<div class=" right" >';
	            if(LOGGED_IN) {
					echo '<div class="right res-des span-3 text-right header-button-wrapper">';
						echo '<a class="add-deal-link button button-header button-add color-3 right " href="javascript:;" title="Share a Deal" >Share a Deal</a>';
					echo '</div>';
					echo '<div class="right res-tab span-6 text-right header-button-wrapper">';
						echo '<a class="add-deal-link button button-header button-add color-3 right " href="javascript:;" title="Share a Deal" >Share a Deal</a>';
					echo '</div>';
					echo '<div class="right res-mob span-12 text-right header-button-wrapper">';
						echo '<a class="add-deal-link button button-header button-add color-3 centre " href="javascript:;" title="Share a Deal" >Share a Deal</a>';
					echo '</div>';
					#echo '<a id="" class="button button-header button-add color-3 centre res-mob res-tab" href="/account/add-deal/" title="Share a Deal" >Share a Deal</a>';
				}
				else {
					echo '<div class="right res-des span-3 text-right header-button-wrapper">';
						echo '<a class="signup-link button button-header button-signup color-3 right js-tooltip-target" href="javascript:;" title="Sign up for an account" >Start  Sharing</a>';
					echo '</div>';
					echo '<div class="right res-tab span-6 text-right header-button-wrapper">';
						echo '<a class="signup-link button button-header button-signup color-3 right js-tooltip-target" href="javascript:;" title="Sign up for an account" >Start  Sharing</a>';
					echo '</div>';
					echo '<div class="right res-mob span-12 text-right header-button-wrapper">';
						echo '<a class="signup-link button button-header button-signup color-3 centre js-tooltip-target" href="javascript:;" title="Sign up for an account" >Start  Sharing</a>';
					echo '</div>';
					if(!IS_MEMBER) echo '<p id="tooltip-signup" class="tooltip-content-holder absolute" >Sign up today to start sharing!</p>';
				}
				print '</div>';
        echo '</div>';
    echo '</div>';
echo '</div>';
}
?>
	
 