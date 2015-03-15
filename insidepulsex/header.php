<?php

global $thisurl;
$thisurl =  $_SERVER['HTTP_HOST'];
global $diehardgamefanurl;
global $wrestlingurl;
global $homeurl;
$diehardgamefanurl = "diehardgamefan.com";
$wrestlingurl = "wrestling.insidepulse.com";
$diehardgamefanurl = "widroverse.com";
$wrestlingurl = "insidepulsedev.com";
$homeurl = "insidepulse.com";

global $disqusslug;
$disqusslug = "inside-pulse";

global $featuredauthors;
$featuredauthors = "4|7|2|1|874";

global $active_zone;
// diehardgamefan
if($thisurl==$diehardgamefanurl){
	$active_zone = "diehardgamefan";
	$active_nav_games = "class=\"active\"";
	$disqusslug = "diehardgamefan";
	$featuredauthors = "21|345|1367|605|884|41|869|1382|1396|37";
}

// wrestling
elseif($thisurl==$wrestlingurl){
	$active_zone = "wrestling";
	$active_nav_wrestling = "class=\"active\"";
	$disqusslug = "pulsewrestling";
	$featuredauthors = "8|207|896|842|885|888|889|917|1";
}
else{
	if($zone){
		$active_zone=$zone;
	}
	elseif(is_home()||is_page('home')){
		$active_zone = "home";
		$featuredauthors = "2|7|178|177|220|172|874";
	}

	elseif(in_zone("diehard-gamefan")){
		$active_zone = "diehardgamefan";
		$active_nav_games = "class=\"active\"";
	}

	elseif(in_zone("pulsecasts")||is_page("pulsecasts")){
		$active_zone = "pulsecasts";
	}

	elseif(is_page("comics-nexus")||is_page("comics")){
		$active_zone = "comics-nexus";
		$active_nav_comics = "active";
	}

	elseif(in_zone("inside-fights")||is_page("inside-fights")||is_page("insidefights")){
		$active_zone = "insidefights";
		$active_nav_fights = "active";
		$featuredauthors = "220|2";
	}

	elseif(in_zone("figures")||is_page("figures")){
		$active_zone = "figures";
		$active_nav_figures = "active";
	}

	elseif(in_zone("movies")||is_page("movies")){
		$active_zone = "movies";
		$active_nav_movies = "active";
		$featuredauthors = "7|220|198|221|131|222";
	}

	elseif(in_zone("tv")||is_page("tv")){
		$active_zone = "tv";
		$active_nav_tv = "active";
		$featuredauthors = "2|110|172|874";
	}

	elseif(in_zone("games")){
		$active_zone = "games";
		$active_nav_games = "active";
	}

	//comics
	elseif(in_zone("comics-nexus")||is_page("comics-nexus")||is_page("comics")){
		$active_zone = "comics-nexus";
		$active_nav_comics = "active";
		$featuredauthors = "7|220|198|221|131|222";
	}

	//music
	elseif(in_zone("music")||is_page("music")){
		$active_zone = "music";
		$active_nav_music = "active";
	}

	//sports
	elseif(in_zone("sports")||is_page("sports")){
		$active_zone = "sports";
		$active_nav_sports = "active";
	}

	else{
		//$active_zone = "home";
		$home_tabcss = "tab_cell_nav_on";
	}
}


?><html <?php language_attributes();?> xmlns="http://www.w3.org/1999/xhtml"
      xmlns:og="http://ogp.me/ns#"
      xmlns:fb="http://www.facebook.com/2008/fbml">
<head>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<title>

<?php bloginfo('name'); ?>

<?php
	//if ( !(is_404()) && (is_single()) or (is_page()) or (is_archive()) ) {
	if ( !(is_404()) && (is_single()) or (is_archive()) ) {
	?>
	|
	<?php } ?>

	<?php wp_title(''); ?>
</title>
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />

</head>
<?php wp_head(); ?>

<body>

<div class="navbar navbar-default navbar-fixed-top top" role="navigation" style="">
  <div class="container">

    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
	<!--<a class="navbar-logo" href="#"><img src="/wp-content/themes/insidepulsex/images/logo_white.png" class="logo" height="50" style="padding-top:10px;"></a>-->
	<a class="navbar-logo" href="#"><img src="http://media.insidepulse.com/shared/images/v7/logo.png" class="logo" height="50" style="padding-top:10px;"></a>
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#topnav">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <!--
      <a class="navbar-brand" href="#">Brand</a>
      -->
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
	<div class="collapse navbar-collapse" id="topnav">
      <ul class="nav navbar-nav">

        <li class="navbar-link <?php echo $active_nav_tv; ?>"><a href="/tv">TV</a></li>
        <li class="navbar-link <?php echo $active_nav_movies; ?>"><a href="/movies">Movies</a></li>
        <li class="navbar-link <?php echo $active_nav_comics; ?>"><a href="/comics-nexus">Comics</a></li>
        <li class="navbar-link <?php echo $active_nav_games; ?>"><a href="http://diehardgamefan.com">Games</a></li>
        <li class="navbar-link <?php echo $active_nav_wrestling; ?>"><a href="http://wrestling.insidepulse.com">Wrestling</a></li>
        <li class="navbar-link <?php echo $active_nav_fights; ?>"><a href="/inside-fights">Fights</a></li>
        <!--
        <li class="navdot">&middot;</li>
        <li <?php echo $active_nav_music; ?>><a href="/music">Music</a></li>
        <li class="navdot">&middot;</li>
        <li <?php echo $active_nav_sports; ?>><a href="/sports">Sports</a></li>
        <li class="navdot">&middot;</li>
        <li <?php echo $active_nav_gadgets; ?>><a href="/movies">Gadgets</a></li>
        <li class="navdot">&middot;</li>
        <li <?php echo $active_nav_figures; ?>><a href="/figures">Figures</a></li>
        -->
      </ul>


      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control topnavsearch" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>


		<!--
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li><a href="#">Separated link</a></li>
          </ul>
        </li>
      </ul>
		-->

    </div>
  </div>
</div>
