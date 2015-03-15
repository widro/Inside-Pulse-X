<?php get_header(); ?>
<?php
	if(is_home()||is_page('home')){
		$topstorysqladd = "";
	}
	elseif(is_page("inside-fights")){
		$topstorysqladd = "&zone=inside-fights";
	}
	elseif(is_page("figures")){
		$topstorysqladd = "&zone=figures";
	}
	elseif(is_page("movies")){
		$topstorysqladd = "&zone=movies";
	}
	elseif(is_page("tv")){
		$topstorysqladd = "&zone=tv";
	}
	elseif(is_page("games")){
		$topstorysqladd = "&zone=games";
	}
	elseif(is_page("comics-nexus")){
		$topstorysqladd = "&zone=comics-nexus";
	}
	elseif(is_page("music")){
		$topstorysqladd = "&zone=music";
	}
	elseif(is_page("sports")){
		$topstorysqladd = "&zone=sports";
	}

?>

<div class="container containervx col-sm-14">

<?php

	// top story sql
	$the_query = new WP_Query('&showposts=6' . $topstorysqladd . '&category_name=top-story&orderby=post_date&order=desc');

	//top story loop
	$i=0;
	while ($the_query->have_posts()) : $the_query->the_post();
	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if(!$topstory120x120){
		$topstory120x120 = "http://media.insidepulse.com/shared/images/v7/default120x120_.jpg";
	}
	if(!$topstory500x250){
		$topstory500x250 = "http://media.insidepulse.com/shared/images/v7/default500x250_.jpg";
	}

	$thistitle = str_replace("\"", "", $post->post_title);
	$thistitle = substr(strip_tags($thistitle), 0, 90);

	$thisexcerpt = $post->post_excerpt;

	$clickthru=get_permalink($post->ID);
	$thisdate = mysql2date('m.d.y', $post->post_date);
	$author = "<a href=\"" . get_author_posts_url($post->post_author) . "\">" . get_the_author() . "</a>";

	if($i==0||$i==5){
		$class = "12";
	}
	else{
		$class = "6";
	}

	$varname = "img" . $i;

	$$varname = "
	<div class=\"col-sm-$class topstorybar$class\">
		<a href=\"$clickthru\">
			<img src=\"$topstory500x250\">
	    </a>
		<p>
			<a href=\"$clickthru\">$thistitle</a>
		</p>
	</div>
    ";

	if($i<5){
		$subtopstory .= "
			<div class=\"top_story_right_bottom_item\">
				<a href=\"$clickthru\"><img src=\"$topstory500x250\"></a>
				<a href=\"$clickthru\">$thistitle</a>
			</div>
		";
	}

	$i++;
	endwhile; ?>
	<div class="col-sm-6" style="padding:0;">
			<?php echo $img0; ?>
			<?php echo $img1; ?>
			<?php echo $img2; ?>
	</div>
	<div class="col-sm-6" style="padding:0;">
			<?php echo $img3; ?>
			<?php echo $img4; ?>
			<?php echo $img5; ?>
	</div>
	<div class="clear"></div>

	<div class="top_story_right_bottom">
		<div class="top_story_right_bottom_arrow">
			<img src="/wp-content/themes/insidepulsex/images/subtop_arrow_left.png">
		</div>
		<?php echo $subtopstory; ?>
		<div class="top_story_right_bottom_arrow">
			<img src="/wp-content/themes/insidepulsex/images/subtop_arrow_right.png">
		</div>
	</div>



























<div class="clear"></div>
	<div class="left col-sm-9 col-lg-9">
<script>
jQuery(document).ready(function($){ //fire on DOM ready

<?php
	if($active_zone == "diehardgamefan"){
		echo "$(\"#subheader\").hide();";
		echo "$(\"#cells_wrap\").hide();";
		echo "$(\"#magazine_wrap\").show();";
	}
	else{
		echo "$(\"#cells_wrap\").show();";
		echo "$(\"#magazine_wrap\").hide();";
	}
?>
	$("#subheader_latest").click(function(){
		$("#cells_wrap").show();
		$("#magazine_wrap").hide();
	});
	$("#subheader_magazine").click(function(){
		$("#cells_wrap").hide();
		$("#magazine_wrap").show();
	});
});

</script>

<div class="subheader" id="subheader">
	<div class="subheader_tab" id="subheader_latest">Latest</div>
	<div class="subheader_tab inactive" id="subheader_magazine">Magazine</div>
</div>
<div class="clear"></div>

<div id="cells_wrap">


<?php if (have_posts()) : ?>
<?php

$the_query = new WP_Query('&showposts=30' . $topstorysqladd . '&orderby=post_date&order=desc');
while ($the_query->have_posts()) : $the_query->the_post();
//while (have_posts()) : the_post();

			$topstory120x120 = get_the_post_thumbnail( $post->ID, 'thumbnail' );

			$topstory500x250 = get_the_post_thumbnail( $post->ID, 'large' );

			if(!$topstory120x120){
				$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
				if(!$topstory120x120){
					$topstory120x120 = "http://media.insidepulse.com/shared/images/v7/default120x120_.jpg";
				}
				$topstory120x120 = "<img src='$topstory120x120'>";
			}
			if(!$topstory500x250){
				$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
				if(!$topstory500x250){
					$topstory500x250 = "http://media.insidepulse.com/shared/images/v7/default500x250_.jpg";
				}
				$topstory500x250 = "<img src='$topstory500x250'>";
			}
	$thistitle = str_replace("\"", "", $post->post_title);
	//$thistitle = substr($thistitle, 0, 100);

	$thisexcerpt = $post->post_excerpt;

	$clickthru=get_permalink($thispostid);
	$thisdate = mysql2date('m.d.y', $post->post_date);
	$author = "<a href=\"" . get_author_posts_url($post->post_author) . "\">" . get_the_author() . "</a>";
	$zonearrows = "";

	//list terms in taxonomy
	// go thru zones of this article
	$types[0] = 'zone';
	foreach ($types as $type) {
		$taxonomy = $type;
		$terms = wp_get_object_terms( $post->ID, $taxonomy, '' );
		//if zones, what?
		if ($terms) {
			foreach ($terms as $term) {
				$thiszoneslug = $term->slug;
				$thiszonename = $term->name;

				$zonearrows .= "
				<div class=\"arrow_category\"><a href=\"/$thiszoneslug\">$thiszonename</a></div>
				";
			}
		}
	}
			//check for wrestling arrows
			if($thisurl==$wrestlingurl){
						$zonearrows .= "
						<div class=\"arrow_category\"><a href=\"/\">Wrestling</a></div>
						";
			}


?>

<div class="index_cell">
	<div class="index_cell_left">
		<div class="arrow_timestamp"><a href="#"><?php echo $thisdate ?></a></div>
		<div class="clear" style="height:50px;"></div>
		<?php echo $zonearrows ?>
	</div>
	<div class="index_cell_bar">
		<img src="/wp-content/themes/insidepulsex/images/whitecircle.png">
	</div>
	<div class="index_cell_center">
		<p class="index_cell_headline"><a href="<?php the_permalink() ?>"><?php the_title() ?></a></p>
		<p class="index_cell_byline">by <?php echo $author ?></p>
		<p class="index_cell_teaser"><?php the_excerpt() ?></p>
	</div>
	<div class="index_cell_right">
		<a href="<?php the_permalink() ?>"><?php echo $topstory120x120 ?></a>
	</div>
</div>
<div class="clear"></div>



<?php endwhile; endif; ?>

<div class="subheader">
	<div class="subheader_tab">Next</div>
	<div class="subheader_tab inactive">Previous</div>
</div>
</div>


<div id="magazine_wrap">

<?php

	//left4x2
	$left4x2values = array();
	$left4x2values[] = array('category_name', 'nintendo-3ds-2,nintendo_wii,nintendo_ds,nintendo-wiiu', 'Nintendo', '/latest-updates/?cat=nintendo-3ds-2,nintendo_wii,nintendo_ds,nintendo-wiiu');
	$left4x2values[] = array('category_name', 'sony-playstation-4,sony_ps3,sony_psp,sony-ps-vita', 'sony', '/latest-updates/?cat=sony-playstation-4,sony_ps3,sony_psp,sony-ps-vita');
	$left4x2values[] = array('category_name', 'microsoft-xbox-one,xbox_360', 'xbox', '/latest-updates/?cat=microsoft-xbox-one,xbox_360');
	$left4x2values[] = array('category_name', 'pc_games', 'pc games', '/category/pc_games');
	$left4x2values[] = array('category_name', 'tabletop-gaming', 'tabletop gaming', '/category/tabletop-gaming');
	$left4x2values[] = array('category_name', 'reviews', 'reviews', '/category/reviews');
	$left4x2values[] = array('category_name', 'features', 'features', '/category/features');
	$left4x2values[] = array('category_name', 'columns', 'columns', '/category/columns');

	$left4x2values[] = array('tag', 'dungeons-dragons', 'dungeons & dragons', '/tag/dungeons-dragons');
	$left4x2values[] = array('category_name', 'news', 'news', '/category/news');
	$left4x2values[] = array('tag', 'super-smash-bros', 'smash bros', '/tag/super-smash-bros');
	$left4x2values[] = array('tag', 'nippon-ichi', 'nippon ichi', '/tag/nippon-ichi');
?>

<?php
	$j=0;
	foreach($left4x2values as $left4x2value){
	$bottom = "";
	// top story sql
	$the_query = new WP_Query('&showposts=4&'.$left4x2value[0].'='.$left4x2value[1].'&orderby=post_date&order=desc');

	//top story loop
	$i=0;
	while ($the_query->have_posts()) : $the_query->the_post();
	$topstory120x120 = get_post_meta($post->ID, 'topstory120x120', true);
	$topstory500x250 = get_post_meta($post->ID, 'topstory500x250', true);
	if(!$topstory120x120){
		$topstory120x120 = "http://media.insidepulse.com/shared/images/v7/default120x120_.jpg";
	}
	if(!$topstory500x250){
		$topstory500x250 = "http://media.insidepulse.com/shared/images/v7/default500x250_.jpg";
	}

	$thistitle = str_replace("\"", "", $post->post_title);
	//$thistitle = substr($thistitle, 0, 100);

	$thisexcerpt = $post->post_excerpt;

	$clickthru=get_permalink($post->ID);
	$thisdate = mysql2date('m.d.y', $post->post_date);
	$author = "<a href=\"" . get_author_posts_url($post->post_author) . "\">" . get_the_author() . "</a>";
	$zonearrows = "";

	//list terms in taxonomy
	// go thru zones of this article
	$types[0] = 'zone';
	foreach ($types as $type) {
		$taxonomy = $type;
		$terms = wp_get_object_terms( $post->ID, $taxonomy, '' );
		//if zones, what?
		if ($terms) {
			foreach ($terms as $term) {
				$thiszoneslug = $term->slug;
				$thiszonename = $term->name;

				$zonearrows .= "
				<div class=\"arrow_category\"><a href=\"/$thiszoneslug\">$thiszonename</a></div>
				";
			}
		}
	}
	if($i==0){
		$top = "
			<a href=\"$clickthru\"><img src=\"$topstory500x250\"></a>
			<a href=\"$clickthru\">$thistitle</a>

		";
	}
	else{
		$bottom .= "
			<li><a href=\"$clickthru\">$thistitle</a></li>
		";

	}
?>

<?php
	$i++;
endwhile; ?>

<div class="magazine_column">
	<div class="magazine_header">
		<div class="magazine_tab"><?php echo $left4x2value[2]; ?></div>
	</div>
	<div class="magazine_image">
		<?php echo $top; ?>
	</div>
	<ul class="magazine_cell">
		<?php echo $bottom; ?>
	</ul>
	<div class="magazine_bottom">
		&raquo; <a href="#">see all</a>
	</div>
	<div class="clear"></div>
</div>



<?php
	if(($j==3)||($j==7)){
		echo "	<div class=\"clear\"></div>";
	}
	$j++;
}
?>










</div>






<div class="clear"></div>

	</div>
<?php include('sidebar.php'); ?>
</div>

<?php include('footer.php'); ?>