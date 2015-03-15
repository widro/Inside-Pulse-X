<?php get_header(); ?>

<div class="container containervx col-sm-14">
	<div class="left col-sm-8 col-lg-8">
		<div class="subheader">
			<?php
			if(is_author()){
				$author = get_the_author();
				echo "
			<div class=\"subheader_tab\" style=\"width:auto;padding-right:10px;cursor:default;\">$author</div>
				";
			}
			elseif(is_category()){
				$category = single_cat_title("", false);
				echo "
			<div class=\"subheader_tab\">$category</div>
				";
			}
			elseif(is_tag()){
				$tag = single_tag_title("", false);
				echo "
			<div class=\"subheader_tab\">$tag</div>
				";
			}
			else{
				echo "
			<div class=\"subheader_tab\">Latest</div>
			<div class=\"subheader_tab inactive\">Popular</div>
				";
			}
			?>
		</div>
		<div class="clear"></div>


		<?php if (have_posts()) : ?>
		<?php

		$i=0;
		while (have_posts()) : the_post();
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
			$thistitle = substr($thistitle, 0, 100);

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



		<?php
		endwhile;
		?>
		<?php endif; ?>
		<div class="subheader">
			<div class="subheader_tab">Next</div>
			<div class="subheader_tab inactive">Previous</div>
		</div>
		<div class="clear"></div>
	</div>
<?php include('sidebar.php'); ?>
</div>
<?php include('footer.php'); ?>