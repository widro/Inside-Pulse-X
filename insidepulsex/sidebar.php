	<div class="col-sm-3 hidden-xs hidden-sm hidden-lg">
		<!--<a href="#"><img src="http://media.insidepulse.com/shared/images/v7/ad300.png"></a>-->

		<div class="rightcontainer">
			<div class="rightcontainer_header">
				Featured Writers
			</div>

			<?php
				$featuredauthorsarray = explode("|", $featuredauthors);
				foreach($featuredauthorsarray as $featured_userid){
					$featuredauthorfile = $overallpath.'generate/author/r-author-' . $featured_userid . '.html';
					$create_rightauthbox = create_authbox($featured_userid, "rightauthbox", $authorslug);
					echo $create_rightauthbox;
				}
			?>

		</div>

		<div class="clear" style="height:30px;"></div>

		<div class="rightcontainer">
			<div class="rightcontainer_header">
				Recent Comments
			</div>
			<script type="text/javascript" src="http://<?php echo $disqusslug ?>.disqus.com/recent_comments_widget.js?num_items=5&hide_avatars=0&avatar_size=32&excerpt_length=100"></script>
			<div class="rightcontainer_bottom">
				<a href="">&raquo; see all</a>
			</div>
		</div>

		<div class="clear" style="height:30px;"></div>

		<div class="rightcontainer" style="background:#ffffff;">
			<div class="rightcontainer_header">
				Inside Pulse Staples
			</div>

			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/10thoughts_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/6pulse_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/trivia_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/roundtable_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>

			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/battle_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/askpulse_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/pulsebites_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/pollofweek_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>

			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/pulseoftwitter_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/insideinstagram_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/calendar_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/animatedgifs_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>

			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/video_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/wallpaper_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/thisday_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/thisdaypulse_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>

			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/mcm_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/wcw_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/tbt_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>
			<a href="#"><img src="http://insidepulse.net/wp-content/themes/insidepulsex/images/ff_thumb.jpg" style="width:70px; margin:5px; margin-right:0px; float:left; border:2px solid #cccccc;"></a>

		</div>
	</div>
