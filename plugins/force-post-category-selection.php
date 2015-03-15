<?php
/*
Plugin Name: IPX Form Validation
Description: Forces user to assign all required fields before publishing
Contributors: j_p_s
Author: Jatinder Pal Singh
Author URI: http://www.jpsays.com
Tags: post, category, publish, without, require, force, must, draft
Requires at least: 3.x
Tested up to: 4.x
Stable tag: 1.1
Version: 1.1
*/
function force_post_cat_init()
{
  wp_enqueue_script('jquery');
}
function force_post_cat()
{
  echo "<script type='text/javascript'>\n";
  echo "
  jQuery('#publish').click(function()
  {
   	var featuredimage = jQuery('[id^=\"set-post-thumbnail\"]').html();
   	if(featuredimage==\"Set featured image\"){
		alert('You have chosen a featured image for the post. Kindly chose a featured image.');
		setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
		jQuery('[id^=\"set-post-thumbnail\"]').css('background', '#F96');
		setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
		var setreturn = false;
   	}

   	var excerpt = jQuery('[id^=\"excerpt\"]').val();
	if(!excerpt)
	{
		alert('You have not filled in excerpt for the post. Kindly fill in excerpt.');
		setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
		jQuery('[id^=\"taxonomy-category\"]').css('background', '#F96');
		setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
		var setreturn = false;
	}

   	var setreturn=true;
   	var cats = jQuery('[id^=\"taxonomy-category\"]')
      .find('.selectit')
      .find('input');
	if(cats.length)
	{
		category_selected=false;
		for (counter=0; counter<cats.length; counter++)
		{
			if (cats.get(counter).checked==true)
			{
				category_selected=true;
				break;
			}
		}
		if(category_selected==false)
		{
			alert('You have not selected any category for the post. Kindly select post category.');
			setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
			jQuery('[id^=\"taxonomy-category\"]').find('.tabs-panel').css('background', '#F96');
			setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
			var setreturn = false;
		}
	}

   	var zones = jQuery('[id^=\"taxonomy-zone\"]')
      .find('.selectit')
      .find('input');
	if(zones.length)
	{
		zone_selected=false;
		for (counter=0; counter<zones.length; counter++)
		{
			if (zones.get(counter).checked==true)
			{
				zone_selected=true;
				break;
			}
		}
		if(zone_selected==false)
		{
			alert('You have not selected any zone for the post. Kindly select post zone.');
			setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
			jQuery('[id^=\"taxonomy-zone\"]').find('.tabs-panel').css('background', '#F96');
			setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
			var setreturn = false;
		}
	}
	if(!setreturn){
		return false;
	}

  });
  ";
   echo "</script>\n";
}
add_action('admin_init', 'force_post_cat_init');
add_action('edit_form_advanced', 'force_post_cat');
?>