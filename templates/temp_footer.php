
<div id="site-footer" class="span-12 ">
  	<div class="back-color-5 span-12 foot-links">
    	<div class="w-960">
          	<div class=" padding-10">
            	<div class="left res span-3">
	                <h2 class="clear color-6 left span-12 bold">find out about us</h2>
	                <p><a class="color-6 " href="/about/" title="Read about Dealshare" >read about us</a></p>
	                <p><a class="color-6 " href="/documents/privacy-policy.pdf" title="View our Privacy Statement" >our privacy policy</a></p>
                </div>    
                <div class="left res span-3" >  
                	<h2 class="clear color-6 left span-12 bold">get in touch with us</h2> 
	                <p><a class="color-6 " href="/contact/" title="Contact us" >contact us</a></p>
	            </div> 
                <div class="left res span-3" >  
                	<h2 class="clear color-6 left span-12 bold">help</h2> 
	                <p><a class="color-6 " href="/help-browser/" title="Contact us" >upgrade your browser</a></p>
	                <!-- <p><a class="color-6 " href="/help-upload/" title="Contact us" >image upload</a></p> -->
	            </div> 
                <div class="right res span-3 foot-icons" >  
	                <a class="right" target="_blank" href="https://www.facebook.com/pages/Dealshareie/197027360483119" title="facebook" ><img src="/web_graphics/icons/icon-facebook.png" /></a>
	                <a class="right" target="_blank" href="https://twitter.com/Dealshareie" title="twitter" ><img src="/web_graphics/icons/icon-twitter.png" /></a>
	                <a class="right" target="_blank" href="https://plus.google.com/u/0/107906107118734896571/posts" title="google +" ><img src="/web_graphics/icons/icon-google.png" /></a>
	            </div> 
            </div>
                
                  
        </div>
    </div>
	<div class="w-960">
        	<div class="foot-partners left res-tab res-des padding-10">
            	<div class="padding-10">
                <h2 class="clear left span-12 bold">our partners</h2>
                <?php
					echo '<div class="span-3 left" >';
					for($i=0; $i<48; $i++) {
                		if((($i%12) == 0) && ($i > 0)) {
							echo '</div><div class="span-3 left" >';	
						}
						echo '<p><a href="http://www.' . $merchants[$i]['keyword'] . '" title="Vists ' . $merchants[$i]['title'] . '" >' . $merchants[$i]['title'] . '</a></p>';
					}
					echo '</div>';
                ?>
                </div>
            </div>
    </div>
	
	

</div>
