<?php
$thisurl =  $_SERVER['HTTP_HOST'];

if(($thisurl=="www.insidepulse.com")||($thisurl=="insidepulse.com")){
	$site = "insidepulse";
	$dbname = "insidepulsecom";
	$server = "localhost";
	$dbusername = "insidepulsecom";
	$dbpass = "v9L7rIf1ysG";
}
elseif(($thisurl=="www.insidepulse.net")||($thisurl=="insidepulse.net")){
	$site = "insidepulsenet";
	$dbname = "db145717_insidepulsenet_wp";
	$server = "internal-db.s145717.gridserver.com";
	$dbusername = "db145717";
	$dbpass = "8uhb8uhb";
}
elseif(($thisurl=="www.diehardgamefan.com")||($thisurl=="diehardgamefan.com")){
	$site = "diehardgamefan";
	$dbname = "diehardgamefanc";
	$server = "localhost";
	$dbusername = "diehardgamefanc";
	$dbpass = "98RbnRy2rWu";
}
elseif(($thisurl=="wrestling.insidepulse.com")||($thisurl=="wrestling.insidepulse.com")){
	$site = "wrestling";
	$dbname = "wrestlinginside";
	$server = "localhost";
	$dbusername = "wrestlinginside";
	$dbpass = "Fez0SgbAWnf";
}

elseif(($thisurl=="www.insidepulsedev.com")||($thisurl=="insidepulsedev.com")){
	$site = "insidepulsedev";
	$dbname = "db145717_insidepulse_wp";
	$server = "internal-db.s145717.gridserver.com";
	$dbusername = "db145717";
	$dbpass = "8uhb8uhb";
}
elseif(($thisurl=="www.widroverse.com")||($thisurl=="widroverse.com")){
	$site = "widroverse";
	$dbname = "db145717_widroverse";
	$server = "internal-db.s145717.gridserver.com";
	$dbusername = "db145717";
	$dbpass = "8uhb8uhb";
}


/*db connection*/
$connection = mysql_connect($server, $dbusername, $dbpass) or die("Couldn't connect.");
$db = mysql_select_db($dbname) or die("Couldn't select database");


/*get vars*/
$action = $_GET['action'];




if($datef=="month"){
	$dateformat1 = "%Y %m";
}
elseif($datef=="day"){
	$dateformat1 = "%Y %m %d";
}
elseif($datef=="year"){
	$dateformat1 = "%Y";
}
else{
	$datef = "day";
	$dateformat1 = "%Y %m %d";
}


//functions
function autoimagesform($slug){

	$output .= "<form method='post' action='tempadmin.php?action=autoimages' style='width:400px;float:left;'>";
	if($slug){
		$output .= "<br><br>$slug<input id='slug' name='slug' type='hidden' value='$slug'>";
	}
	else{
		$output .= gettagdropdown();
	}
	$output .= "<br><br>120x120 - <input type='text' name='topstory120x120' id='topstory120x120'>";
	$output .= "<br><br>500x250 -<input type='text' name='topstory500x250' id='topstory500x250'>";
	$output .= "<input type='hidden' name='formsubmit' id='formsubmit' value='yes'>";
	$output .= "<br><br><input type='submit' value='Add AutoImg'>";
	$output .= "</form>";

	if($slug){
		$output .= "<iframe src='tempadmin.php?action=autoimages_log&slug=$slug' style='width:300px;float:left;height:200px;'></iframe>";
	}
	$output .= "<div style='clear:both;height:50px;'></div>";

	return $output;
}



function gettagdropdown(){
	$sql = "
	select wpt.term_id, wpt.name, wpt.slug, wtt.count
	from wp_terms wpt, wp_term_taxonomy wtt
	where wtt.taxonomy = 'post_tag'
	and wpt.term_id = wtt.term_id
	order by wpt.name
	";

	$result = mysql_query($sql) or die($sql);
	$output .= "<select name='slug' id='slug'>
	<option value=''>--- tag ---</option>
	";

	while($row=mysql_fetch_array($result)){
		$term_id = $row['term_id'];
		$name = $row['name'];
		$slug = $row['slug'];
		$count = $row['count'];

		$output .= "<option value='$slug'>$name ($count)</option>
		";
	}
	$output.="</select>";

	return $output;

}

function authordropdown(){
	$sql = "
	select *
	from wp_users
	order by display_name
	";

	$result = mysql_query($sql) or die($sql);


	$output.="<select id='author_id' name='author_id'>";
	$output .= "<option value=''>--- choose --- </option>";

	while($row=mysql_fetch_array($result)){
		$display_name = $row['display_name'];
		$ID = $row['ID'];

		$output .= "<option value='$ID'>$display_name</option>
		";
	}
	$output.="</select>";

	return $output;
}









if($action=="thisdayinpulsehistory"){

	$today_year = "2005";
	$today_month = "01";
	$today_day = "20";


	$sql = "
	select wpp.post_date, wpp.post_title, wpu.display_name, wpp.ID
	from wp_posts wpp, wp_users wpu
	where wpp.post_date LIKE '".$today_year."-".$today_month."-".$today_day."%'
	and wpp.post_status = 'publish'
	and wpp.post_author = wpu.ID
	order by wpp.post_date asc
	";

	$sql = "
	select wpp.post_date, wpp.post_title, wpp.post_content, wpu.display_name, wpp.ID
	from wp_posts wpp, wp_users wpu
	where wpp.post_date >= DATE_ADD('".$today_year."-".$today_month."-".$today_day." 00:00:00', INTERVAL -1 WEEK)
	and wpp.post_date <= DATE_ADD('".$today_year."-".$today_month."-".$today_day." 00:00:00', INTERVAL 1 WEEK)
	and wpp.post_status = 'publish'
	and wpp.post_author = wpu.ID
	order by wpp.post_date asc
	";

	$result = mysql_query($sql) or die($sql);

	$headertext = "This Day In Pulse History ";


	$output .="<table class='table table-striped'>";
	$output .= "<tr>";
	$output .= "<th>Date</th>";
	$output .= "<th>ID</th>";
	$output .= "<th>Zone</th>";
	$output .= "<th>Title</th>";
	$output .= "<th>Author</th>";
	$output .= "<th>Grab</th>";
	$output .= "<th>Link</th>";
	$output .= "</tr>";

	while($row=mysql_fetch_array($result)){
		$post_date = $row['post_date'];
		$post_title = $row['post_title'];
		$post_content = $row['post_content'];
		$post_content = substr($post_content, 0, 2000);
		$display_name = $row['display_name'];
		$post_ID = $row['ID'];

		//get zone

		$sql_zone = "
		select wptt.description
		from wp_terms wpt, wp_term_taxonomy wptt, wp_term_relationships wptr
		where wptr.object_id = '$post_ID'
		and wptr.term_taxonomy_id = wptt.term_taxonomy_id
		and wptt.taxonomy = 'zone'
		and wptt.term_id = wpt.term_id
		";

		$result_zone = mysql_query($sql_zone) or die($sql_zone);
		while($row_zone=mysql_fetch_array($result_zone)){
			$zone = $row_zone['description'];
		}

$sampleoutput = "
<h3>$post_title</h3>
<p>$post_content</p>
<a href=\"/?p=$post_ID\">&raquo; Continue Reading</a>
";

		$output .= "<tr>";
		$output .= "<td>$post_date</td>";
		$output .= "<td>$post_ID</td>";
		$output .= "<td>$zone</td>";
		$output .= "<td>$post_title</td>";
		$output .= "<td>$display_name</td>";
		$output .= "<td><textarea style='width:300px;height:100px;font-size:9px;'>$sampleoutput</textarea></td>";
		$output .= "<td><a href='/?p=$post_ID'>/?p=$post_ID</a></td>";
		$output .= "</tr>";
	}

	$output.="</table>";
}

if($action=="activeusers"){
	$sql = "
	select distinct(wpp.post_author), wpu.display_name, wpu.user_email
	from wp_posts wpp, wp_users wpu
	where wpp.post_date > '2013-12-31'
	and wpp.post_author = wpu.ID
	";

	$result = mysql_query($sql) or die($sql);

	$headertext = "Users Active in 2014 ";


	$output .="<table class='table table-striped'>";
	$output .= "<tr>";
	$output .= "<th>Name</th>";
	$output .= "<th>Email</th>";
	$output .= "</tr>";

	while($row=mysql_fetch_array($result)){
		$display_name = $row['display_name'];
		$user_email = $row['user_email'];

		$output .= "<tr>";
		$output .= "<td>$display_name</td>";
		$output .= "<td>$user_email</td>";
		$output .= "</tr>";
	}

	$output.="</table>";

}

if($action=="gimmicks"){

}


if($action=="post_count"){

	if($_GET['author_id']){
		$author_id = $_GET['author_id'];
		$sqladd = "and post_author = $author_id";
	}


	$sql = "
	select count(id) as total, date_format(post_date,'$dateformat1') as date
	from wp_posts
	where post_status = 'publish'
	$sqladd
	group by date
	order by date desc
	";

	$result = mysql_query($sql) or die($sql);

	$headertext = "Posts by ";

	$output.= "<div class='filter_bar'>";
	$output.= "<form id='filterform' name='filterform' method='get'>";
	$output.= "Filter by:";
	$output.= authordropdown();
	$output.= "<input type='submit' class='filterbutton' value='Filter Submit!'>";
	$output.= "<input type='hidden' id='action' name='action' value='$action'>";
	$output.= "</form>";
	$output.= "</div>";

	$output.="<table class='table table-striped'>";
	$output .= "<tr>";
	$output .= "<th>Date</th>";
	$output .= "<th>Total</th>";
	$output .= "</tr>";

	$starttotal = 0;
	while($row=mysql_fetch_array($result)){
		$total = $row['total'];
		$date = $row['date'];

		$output .= "<tr>";
		$output .= "<td>$date</td>";
		$output .= "<td>$total</td>";
		$output .= "</tr>";
	}
	$output.="</table>";

}




if($action=="autoimages_log"){

	$getslug = $_GET['slug'];

	$sql = "
	select *
	from autoimages_log
	where tag_slug = '$getslug'
	order by tag_slug
	";

	$result = mysql_query($sql) or die($sql);

	$headertext = "Auto Images Log for $getslug";

	$output.="<table class='table table-striped'>";

	if(mysql_num_rows($result)>0){
		$output .= "<tr>";
		$output .= "<th colspan=2>Log of old entries</th>";
		$output .= "</tr>";
		$output .= "<tr>";
		$output .= "<th>120x120</th>";
		$output .= "<th>500x250</th>";
		$output .= "</tr>";
		while($row=mysql_fetch_array($result)){
			$tag_slug = $row['tag_slug'];
			$topstory120x120 = $row['topstory120x120'];
			$topstory500x250 = $row['topstory500x250'];

			$output .= "<tr>";
			$output .= "<td><img src='$topstory120x120' height=50></td>";
			$output .= "<td><img src='$topstory500x250' height=50></td>";
			$output .= "</tr>";
		}
	}
	else{
		$output .= "<tr>";
		$output .= "<th colspan=2>NONE</th>";
		$output .= "</tr>";
	}
	$output.="</table>";
	echo $output;
	exit();
}

if($action=="autoimages"){

	$getslug = $_GET['slug'];

	if($_POST['formsubmit']=='yes'){

		$postedslug = $_POST['slug'];
		$getslug = $_POST['slug'];
		$topstory120x120_new = $_POST['topstory120x120'];
		$topstory500x250_new = $_POST['topstory500x250'];

		$sql1 = "
		select *
		from autoimages
		where tag_slug = '$postedslug'
		order by tag_slug
		";

		$result1 = mysql_query($sql1) or die($sql1);

		while($row1=mysql_fetch_array($result1)){
			$topstory120x120_old = $row1['topstory120x120'];
			$topstory500x250_old = $row1['topstory500x250'];
		}

		if($topstory120x120_old){


			$sql2a1 = "
			insert into autoimages_log
			(tag_slug, topstory120x120, topstory500x250)
			VALUES
			('$postedslug', '$topstory120x120_old', '$topstory500x250_old')
			";

			$result2a1 = mysql_query($sql2a1) or die($sql2a1);

			$sql2a2 = "
			update autoimages
			set topstory120x120 = '$topstory120x120_new', topstory500x250 = '$topstory500x250_new'
			where tag_slug = '$postedslug'
			";

			$result2a2 = mysql_query($sql2a2) or die($sql2a2);


		}
		else{
			$sql2b = "
			insert into autoimages
			(tag_slug, topstory120x120, topstory500x250)
			VALUES
			('$postedslug', '$topstory120x120_new', '$topstory500x250_new')
			";

			$result2b = mysql_query($sql2b) or die($sql2b);
		}


	}

	$sql = "
	select *
	from autoimages
	order by tag_slug
	";

	$result = mysql_query($sql) or die($sql);

	$headertext = "Auto Images";

	$output .= autoimagesform($getslug);

	$output.="<table class='table table-striped'>";
	$output .= "<tr>";
	$output .= "<th>slug</th>";
	$output .= "<th>120x120</th>";
	$output .= "<th>500x250</th>";
	$output .= "<th>Edit</th>";
	$output .= "<th>View Log</th>";
	$output .= "</tr>";

	while($row=mysql_fetch_array($result)){
		$tag_slug = $row['tag_slug'];
		$topstory120x120 = $row['topstory120x120'];
		$topstory500x250 = $row['topstory500x250'];

		$output .= "<tr>";
		$output .= "<td>$tag_slug</td>";
		$output .= "<td><img src='$topstory120x120' height=50></td>";
		$output .= "<td><img src='$topstory500x250' height=50></td>";
		$output .= "<td><a href='tempadmin.php?action=autoimages&slug=$tag_slug'>Edit</a></td>";
		$output .= "<td><a href='tempadmin.php?action=autoimages_log&slug=$tag_slug'>View Log</a></td>";
		$output .= "</tr>";
	}
	$output.="</table>";

}



if($action=="socialmedialinks"){

	//hardcode change to only ip db
	$site = "insidepulse";
	$dbname = "insidepulsecom";
	$server = "localhost";
	$dbusername = "insidepulsecom";
	$dbpass = "v9L7rIf1ysG";

	/*db connection*/
	$connection = mysql_connect($server, $dbusername, $dbpass) or die("Couldn't connect.");
	$db = mysql_select_db($dbname) or die("Couldn't select database");

	$sql = "
	select *
	from socialmedialinks
	where 1 = 1
	order by name
	";

	$result = mysql_query($sql) or die($sql);

	$headertext = "Twitter and Instagram Links";

	$output.="<table class='table table-striped'>";
	$output .= "<tr>";
	$output .= "<th>zone</th>";
	$output .= "<th>zone2</th>";
	$output .= "<th>name</th>";
	$output .= "<th>twitter</th>";
	$output .= "<th>instagram</th>";
	$output .= "</tr>";

	while($row=mysql_fetch_array($result)){
		$zone = $row['zone'];
		$zone2 = $row['zone2'];
		$name = $row['name'];
		$twitter = $row['twitter'];
		$instagram = $row['instagram'];

		$output .= "<tr>";
		$output .= "<td>$zone</td>";
		$output .= "<td>$zone2</td>";
		$output .= "<td>$name</td>";
		$output .= "<td><a href='$twitter'>$twitter</a></td>";
		$output .= "<td><a href='$instagram'>$instagram</a></td>";
		$output .= "</tr>";

	}
	$output.="</table>";
}
?>




<html>
<head>
<title>Temp Admin</title>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>

</head>


<body>
<div class="container">
<h1>Inside Pulse Non-Wordpress Admin Tools</h1>
<div class="navbar navbar-default" role="navigation" style="background:inherit; border:0;-webkit-box-shadow:none;">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
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
      <ul class="nav navbar-nav" style="margin-left:200px;">
		<li class="cell<?php if($action==""){echo " active";} ?>"><a href="tempadmin.php">Home</a></li>
		<li class="cell<?php if($action=="post_count"){echo " active";} ?>"><a href="tempadmin.php?action=post_count"># of Posts</a></li>
		<li class="cell<?php if($action=="autoimages"){echo " active";} ?>"><a href="tempadmin.php?action=autoimages">AutoImg</a></li>
		<li class="cell<?php if($action=="socialmedialinks"){echo " active";} ?>"><a href="tempadmin.php?action=socialmedialinks">Social Media Link</a></li>
		<li class="cell<?php if($action=="thisdayinpulsehistory"){echo " active";} ?>"><a href="tempadmin.php?action=thisdayinpulsehistory">This Day Pulse hist</a></li>
		<li class="cell<?php if($action=="activeusers"){echo " active";} ?>"><a href="tempadmin.php?action=activeusers">activeusers</a></li>
		<li class="cell<?php if($action=="gimmicks"){echo " active";} ?>"><a href="tempadmin.php?action=gimmicks">gimmicks</a></li>
      </ul>

      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Site: <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
			<li class="cell<?php if($site=="insidepulse"){echo " active";} ?>"><a href="http://insidepulse.com/wp-content/themes/insidepulsex/tempadmin.php">Inside Pulse</a></li>
			<li class="cell<?php if($site=="insidepulsenet"){echo " active";} ?>"><a href="http://insidepulse.net/wp-content/themes/insidepulsex/tempadmin.php">Dev</a></li>
			<li class="cell<?php if($site=="wrestling"){echo " active";} ?>"><a href="http://wrestling.insidepulse.com/wp-content/themes/insidepulsex/tempadmin.php">Wrestling</a></li>
			<li class="cell<?php if($site=="insidepulsedev"){echo " active";} ?>"><a href="http://insidepulsedev.com/wp-content/themes/insidepulsex/tempadmin.php">Wrestling Dev</a></li>
			<li class="cell<?php if($site=="diehardgamefan"){echo " active";} ?>"><a href="http://diehardgamefan.com/wp-content/themes/insidepulsex/tempadmin.php">Diehard</a></li>
			<li class="cell<?php if($site=="widroverse"){echo " active";} ?>"><a href="http://widroverse.com/wp-content/themes/insidepulsex/tempadmin.php">Diehard Dev</a></li>
          </ul>
        </li>
      </ul>

    </div>
  </div>
</div>



<?php
if($headertext){
	echo "<h3>" . $headertext . "<br>" .  $headertext2 . "</h3>";
}

if($showbottomlinks){
	$output.="<table class='table table-striped'>";
	$output .= "<tr>";
	$output .= "<td colspan=10 align=center>$prevlink | $nextlink</td>";
	$output .= "</tr>";
	$output.="</table>";
}

echo $output;

?>

</body>
</html>