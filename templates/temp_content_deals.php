
<div class="container res span-12 centre ">
	<div id="browse-deals" class="js-browse clear" rel="deal">
	    <div id="deals" class="deal-holder">
	    <!-- CONTENT IS ADDED THROUGH JAVASCRIPT  -->
	    <?php 
		//  ---------------------------------------------------- 
		//  load in the first 8 deals
	      $options = array('type' => 'deal', 'count' => 12);
		  $GLOBALS['myDbManager'] -> debug('page load');
	      if($deals = $myDealManager -> GetEntries(0, $options)) {
	          for($i=0; $i<count($deals); $i++) {
	              $data = format($deals[$i]);
	              include(DIR_TEMPLATES . '/temp_deals_item.php');
	          }
	      }
		//  ---------------------------------------------------- 
	    ?>
        </div>
        <div class="load-more clear left" >
	       <h4><a href="javascript;:" class="js-load-more" style="display:none;"  >LOAD MORE</a></h4>
	    </div>
			<div class="js-loading clear centre padding " style="display:none; ">
			<div class="centre" style="width: 64px; height: 64px;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>
			<p class="clear centre">Loading Deals</p></div>
	</div>	
    
    <div id="browse-vouchers" class="js-browse" style="display:none;" rel="voucher">
	    <div id="vouchers" class="deal-holder">
	    <!-- CONTENT IS ADDED THROUGH JAVASCRIPT  -->
	    <?php 
		//  ---------------------------------------------------- 
		//  load in the first 8 deals
	      $options = array('type' => 'voucher', 'count' => 12);
	      if($deals = $myDealManager -> GetEntries(0, $options)) {
	          for($i=0; $i<count($deals); $i++) {
	              $data = format($deals[$i]);
	              include(DIR_TEMPLATES . '/temp_deals_item.php');
	          }
	      }
		//  ---------------------------------------------------- 
	    ?>
        </div>
        <div class="load-more clear left" >
	       <h4><a href="javascript;:" class="js-load-more" style="display:none;"  >LOAD MORE</a></h4>
	    </div>
			<div class="js-loading clear centre padding " style="display:none; ">
			<div class="centre" style="width: 64px; height: 64px;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>
			<p class="clear centre">Loading Deals</p></div>
	</div>
    <div id="browse-freebies" class="js-browse" style="display:none;" rel="freebie">
	    <div id="freebies" class="deal-holder">
	    <!-- CONTENT IS ADDED THROUGH JAVASCRIPT  -->
	    <?php 
		//  ---------------------------------------------------- 
		//  load in the first 8 deals
	      $options = array('type' => 'freebie', 'count' => 12);
	      if($deals = $myDealManager -> GetEntries(0, $options)) {
	          for($i=0; $i<count($deals); $i++) {
	              $data = format($deals[$i]);
	              include(DIR_TEMPLATES . '/temp_deals_item.php');
	          }
	      }
		//  ---------------------------------------------------- 
	    ?>
        </div>
        <div class="load-more clear left" >
	       <h4><a href="javascript;:" class="js-load-more" style="display:none;"  >LOAD MORE</a></h4>
	    </div>
			<div class="js-loading clear centre padding " style="display:none; ">
			<div class="centre" style="width: 64px; height: 64px;"><img src="/web_graphics/backgrounds/loading.gif" class="img-loading" /></div>
			<p class="clear centre">Loading Deals</p></div>
	</div>
</div>
