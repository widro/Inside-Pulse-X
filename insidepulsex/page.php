<?php
//zone pages
if(is_page('home')||is_page('inside-fights')||is_page('movies')||is_page('tv')||is_page('sports')||is_page('comics-nexus')||is_page('comics')||is_page('music')||is_page('commercials')||is_page('games')||is_page('figures')){
	include('home.php');
}

elseif($post->post_type=='forum'){
	include('page_forums.php');
}

elseif(strpos($_SERVER['PHP_SELF'], 'forums')){
	include('page_forums.php');
}

elseif($post->post_type=='topic'){
	include('page_forums.php');
}

else{
	include('page_default.php');
}

?>