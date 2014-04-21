

<div class="span-3 clear left res-des">
	<div class=" padding-10">
		<div class="span-12 back-color-2 shadow clear left">
            <div  id="account-side-top" class="">
                <div class="padding-10">
                    <h2 class="color-6" >Welcome <?php echo $USER['name']; ?>  </h2>
                    <p class="color-6 medium" >This is your Account sidebar</p>
                  </div>
            </div>
            <div  id="account-sidebar" class="clear full left">
                <ul>
                    <li class="account-menu-item span-12 clear <?php echo($page == 'homepage'? ' on' : '')?>">
                    <a href="/" class="padding-20">Home</a>
                    </li>
                    <li class="account-menu-item span-12 clear <?php echo($page == 'account'? ' on' : '')?>">
                    <a href="/account/" class="padding-20">My Account</a>
                    </li>
                    <li class="account-menu-item span-12 clear <?php echo($page == 'deals'? ' on' : '')?>">
                    <a href="/account/my-deals/" class="padding-20">My Deals</a>
                    </li>
                    <li class="account-menu-item span-12 clear <?php echo($page == 'edit-profile'? ' on' : '')?>">
                    <a href="/account/edit-profile/" class="padding-20">Edit Profile</a>
                    </li>
                    <li class="account-menu-item span-12 clear">
                    <a href="/scripts/processing/logout.php" class="padding-20">Logout</a>
                    </li>
                </ul>
            </div>
		</div>
	</div>
</div>

    	