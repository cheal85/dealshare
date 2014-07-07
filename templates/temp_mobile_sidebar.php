
<div class="clear left res-mob js-menu back-color-4 ">
    <div class=" menu-content span-12">
        <div  id="account-side-top" class="left">
            <div class="padding-10 ">
            	<?php
 				if(($page == 'homepage') || ($page == 'contact') || ($page == 'about') || ($page == 'deal-page')) {
					echo '<h2 class="color-6" ><span class="bold">Deal</span>share menu</h2>';
					echo '<p class="color-6 medium" >Page Navigation menu</p>';
				}
				else {
					echo '<h2 class="color-6" >Welcome ' . $USER['name'] . '</h2>';
					echo '<p class="color-6 medium" >This is your Account sidebar</p>';
				}
				?>
            </div>
        </div>
        <div  id="account-sidebar" class="clear span-12 left">
            <ul>
            	<?php
	                echo '<li class="account-menu-item span-12 clear ' . ($page == 'homepage'? ' on' : '') . '">';
	                echo '<a href="/" class="padding-20">Home</a></li>';
					
					if(LOGGED_IN) {
						echo '<li class="account-menu-item span-12 clear ' . ($page == 'account'? ' on' : '') . '">';
						echo '<a href="/account/" class="padding-20">My Account</a></li>';
					}
						
					//  DIFFENT MENUS FOR ACCOUNT AND MAIN PAGES
					if(($page == 'homepage') || ($page == 'contact') || ($page == 'about') || ($page == 'deal-page')) {
						
		                echo '<li class="account-menu-item span-12 clear ' . ($page == 'contact'? ' on' : '') . '">';
		                echo '<a href="/contact/" class="padding-20 color-7">Contact us</a></li>';
						
		                echo '<li class="account-menu-item span-12 clear ' . ($page == 'about'? ' on' : '') . '">';
		                echo '<a href="/about/" class="padding-20 color-7">About us</a></li>';
					}
					else {
		                echo '<li class="account-menu-item span-12 clear ' . ($page == 'deals'? ' on' : '') . '">';
		                echo '<a href="/account/my-deals/" class="padding-20 color-7">My Deals</a></li>';
						
		                echo '<li class="account-menu-item span-12 clear ' . ($page == 'edit-profile'? ' on' : '') . '">';
		                echo '<a href="/account/edit-profile/" class="padding-20 color-7">Edit your Details</a></li>';
						
		                echo '<li class="account-menu-item span-12 clear ' . ($page == 'edit-profile'? ' on' : '') . '">';
		                echo '<a href="/account/add-deal/" class="padding-20 color-7">Share a Deal</a></li>';
					}
					
					if(LOGGED_IN) {
		                echo '<li class="account-menu-item span-12 clear">';
		                echo '<a href="/scripts/processing/logout.php" class="padding-20 color-7">Logout</a></li>';
					}
					else {
		                echo '<li class="account-menu-item span-12 clear">';
		                echo '<a href="javscript:;" class="js-login padding-20 color-7">Login</a></li>';
					}
				?>
            </ul>
        </div>
    </div>
</div>
    	