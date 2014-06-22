<div class="browse-header clear relative span-12 left ">
	<div class="clear span-12 res centre shadow back-color-2" >
		<div id="search-container" class="right res span-2 res-des">
	        <form id="search-form" method="post" class="centre padding-5" action="/scripts/processing/process.search.php" >
	            <input class="clear span-12 right" type="text" placeholder="search for deals" name="search" value="<?php echo $search; ?>" />
	            <input id="search" type="hidden" value=" <?php echo $search; ?> " />
	        </form>
	    </div>
	    
	    <div class="res span-6 left tabs" >
		    <p class="left span-4"><a class="js-browse-link on browse-tab centre " href="javascript:;" rel="browse-deals">deals</a></p>
		    <p class="left span-4"><a class="js-browse-link browse-tab" href="javascript:;" rel="browse-vouchers">vouchers</a></p>
		    <p class="left span-4"><a class="js-browse-link browse-tab" href="javascript:;" rel="browse-freebies">freebies</a></p>
	    </div>
    </div>
</div>
	
 