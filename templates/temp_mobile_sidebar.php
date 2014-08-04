
<div class="clear left res-mob res-tab js-menu back-color-4 ">
    <div class=" menu-content span-12">
        <div  id="account-side-top" class="left span-12 text-left">
            <div class="padding-20 ">
            	<?php
				echo '<h2 class="color-5 padding-10" >Menu</h2>';
				?>
            </div>
        </div>
        <div  id="account-sidebar" class="clear span-12 left">
          	<div class="padding-20 text-left">
	            <ul>
	            	<?php
		                echo '<li class="side-menu-item span-12 clear ' . ($page == 'homepage'? ' on' : '') . '">';
		                echo '<a href="/" class="padding-20 color-5">Home</a></li>';
						
						if(LOGGED_IN) {
							echo '<li class="side-menu-item span-12 clear ' . ($page == 'account'? ' on' : '') . '">';
							echo '<a href="/account/" class="padding-20 color-5">My Account</a></li>';
							
							echo '<li class="side-menu-item span-12 clear ' . ($page == 'deals'? ' on' : '') . '">';
							echo '<a href="/account/my-deals/" class="padding-20 color-5">My Deals</a></li>';
							
							echo '<li class="side-menu-item span-12 clear ' . ($page == 'add-deals'? ' on' : '') . '">';
							echo '<a href="/account/my-deals/" class="padding-20 color-5">Share a Deal</a></li>';
							
							echo '<li class="side-menu-item span-12 clear ' . ($page == 'edit-profile'? ' on' : '') . '">';
							echo '<a href="/account/edit-profile/" class="padding-20 color-5">Edit your Details</a></li>';							
	  					}
						
						echo '<li class="side-menu-item span-12 clear ' . ($page == 'contact'? ' on' : '') . '">';
						echo '<a href="/contact/" class="padding-20 color-5">Contact us</a></li>';
						
						echo '<li class="side-menu-item span-12 clear ' . ($page == 'about'? ' on' : '') . '">';
						echo '<a href="/about/" class="padding-20 color-5">About us</a></li>';
						
						if(LOGGED_IN) {
							echo '<li class="side-menu-item span-12 clear">';
							echo '<a href="/scripts/processing/logout.php" class="padding-20 color-5">Logout</a></li>';
						}
						else {
							echo '<li class="side-menu-item span-12 clear">';
			                echo '<a href="javscript:;" class="js-login padding-20 color-5">Login</a></li>';
						}
						
						
					?>
	            </ul>
           	</div>
        </div>
    </div>
</div>
    	