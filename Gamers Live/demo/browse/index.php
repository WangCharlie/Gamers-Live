<?php
error_reporting(0);
include_once("../config.php");
include_once("../analyticstracking.php");

session_start();

// we first get data from our mysql database

    $search = $_GET["s"];

    // if search is empty or space
    if($search == null){
        $search = "Nothing...";
    }

    if($search == ""){
        $search = "Nothing...";
    }

if ($_SESSION['access'] != true) {
 $login_box = ' <div class="top_login_box"><a href="'.$conf_site_url.'/account/login/">Sign in</a><a href="'.$conf_site_url.'/account/register/">Register</a></div>';
}else{
$login_box = '<div class="top_login_box"><a href="'.$conf_site_url.'/account/logout/">Logout</a><a href="'.$conf_site_url.'/account/">Account</a></div>';
}
    include_once("".$conf_ht_docs_gl."/analyticstracking.php");

    $per_page = 25;

    $page = $_GET['p'];

    if($page == null){
        $page = 1;
    }

    // prev page
    if($page == 1){
        // then no prevs
        $prev_page = 1;
    }else{
        $prev_page = $page - 1;
    }

    // end and start count
    if($page == 1){
        $start_c = 0;
        $end_c = $per_page;
    }else{
        $end_c = $page * $per_page;
        $start_c = $end_c - $per_page + 1;
    }

    // connect to database
    

    // select the database we need
    

    // select features streamer who is online / active

    $result = mysql_query("SELECT * FROM channels WHERE channel_id LIKE '%$search%' OR game LIKE '%$search%' OR title LIKE '%$search%' ORDER BY viewers DESC LIMIT $start_c, $end_c");
    $count = mysql_num_rows($result);

    $total_res = mysql_query("SELECT * FROM channels WHERE channel_id LIKE '%$search%' OR game LIKE '%$search%' OR title LIKE '%$search%'");
    $total_count = mysql_num_rows($total_res);


    if($total_count > $per_page){
        // then we need more pages
        $pages_needed = ceil($total_count / $per_page); // total pages we need to make this done.
    }else{
        $pages_needed = 1;
    }

    // next page
    if($pages_needed > 1){
        $next_page = $page + 1;
    }else{
        $next_page = 1;
    }

    // calc when we need no more next pages
    if($page >= $pages_needed){
        $next_page = $page;
    }

    if($total_count > 0){
        $content = "<table width='100%' cellpadding='0' cellspacing='0'>
					<tbody>
					<thead>
					<tr>
						<th></th>
						<th>Title</th>
						<th>Streamer</th>
						<th>Game</th>
						<th>Viewers</th>
						<th>Channel Link</th>
					</tr>
					</thead>";
        $content_end = "<tbody>
						</table>";
    }else{
        $content = "<center><h4>Please try another search...</h4></center>"; // no content maybe error msg
        $content_end = "";
    }

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta name="Description" content="A short description of your company" />
    <meta name="Keywords" content="Some keywords that best describe your business" />
    <title><?=$conf_site_name?> - Browse</title>
    <link href="<?=$conf_site_url?>/style.css" media="screen" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?=$conf_site_url?>/js/jquery.min.js"></script>
    <script type="text/javascript" src="<?=$conf_site_url?>/js/preloadCssImages.js"></script>
    <script type="text/javascript" src="<?=$conf_site_url?>/js/jquery.color.js"></script>

    <script type="text/javascript" language="JavaScript" src="<?=$conf_site_url?>/js/general.js"></script>
    <script type="text/javascript" language="JavaScript" src="<?=$conf_site_url?>/js/jquery.tools.min.js"></script>
    <script type="text/javascript" language="JavaScript" src="<?=$conf_site_url?>/js/jquery.easing.1.3.js"></script>

    <script type="text/javascript" language="JavaScript" src="<?=$conf_site_url?>/js/slides.jquery.js"></script>

    <link rel="stylesheet" href="<?=$conf_site_url?>/css/prettyPhoto.css" type="text/css" media="screen" />
    <script src="<?=$conf_site_url?>/js/jquery.prettyPhoto.js" type="text/javascript"></script>

    <!--[if IE 7]>
    <link rel="stylesheet" type="text/css" href="<?=$conf_site_url?>css/ie.css" />
    <![endif]-->

</head>

<body>
<div class="body_wrap thinpage">

<div class="header_image" style="background-image:url(<?=$conf_site_url?>/images/header_wow.png)">&nbsp;</div>

<div class="header_menu">
	<div class="container">
		<div class="logo"><a href="<?=$conf_site_url?>/"><img src="<?=$conf_site_url?>/images/logo.png" alt="" /></a></div>
        <?=$login_box?>
        <div class="top_search">
        	<form id="searchForm" action="<?=$conf_site_url?>/browse/" method="get">
                <fieldset>
                	<input type="submit" id="searchSubmit" value="" />
                    <div class="input">
                        <input type="text" name="s" id="s" value="Type & press enter" />
                    </div>                    
                </fieldset>
            </form>
        </div>
        
          <!-- topmenu -->
        <div class="topmenu">
                    <ul class="dropdown">
                        <li><a href="<?=$conf_site_url?>/browse/?s=league+of+legends"><span>LoL</span></a></li>
                        <li><a href="<?=$conf_site_url?>/browse/?s=dota+2"><span>Dota 2</span></a></li>
                        <li><a href="<?=$conf_site_url?>/browse/?s=Heroes+of+Newerth"><span>HoN</span></a></li>
                        <li><a href="<?=$conf_site_url?>/browse/?s=Star+Craft+2"><span>SC 2</span></a></li>
                        <li><a href="<?=$conf_site_url?>/browse/?s=World+Of+Warcraft"><span>WoW</span></a></li>
                        <li><a href="<?=$conf_site_url?>/browse/?s=Call+Of+Duty"><span>Call Of Duty</span></a></li>
                        <li><a href="<?=$conf_site_url?>/browse/?s=Minecraft"><span>Minecraft</span></a></li>
                        <li><a href="<?=$conf_site_url?>/browse/"><span>Other</span></a></li>
                        <li><a href="<?=$conf_site_url?>/events/"><span>Events</span></a></li>
                        <li><a href="#"><span>More</span></a>                        
                        	<ul>
                                
                                <li><a href="<?=$conf_site_url?>/company/support/"><span>Contact</span></a></li>
                                <li><a href="<?=$conf_site_url?>/account/partner/"><span>Partner</span></a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
        	<!--/ topmenu -->
    </div>
</div>     	
<!--/ header -->



<!-- middle -->
<div class="middle full_width">
<div class="container_12">

	<div class="back_title">
    	<div class="back_inner">
		<a href="<?=$conf_site_url?>/"><span>Home</span></a>
        </div>
    </div> 	 
   
    
    <!-- content -->
    <div class="content">
    
    <div class="styled_table table_white"/>
    <br />
    <center><h1>Search results for string: <?=$search?> </h1>
    <h3>We found <?=$total_count?> results</h3></center>
                        <?php
error_reporting(0);


					echo $content;

					while($row = mysql_fetch_array($result))
					{
						echo "<tr>";
						echo "<td><center><img src='".$conf_site_url."/user/" . $row['channel_id'] . "/avatar.png' height='50' width='50'></center></td>";
						echo "<td>" . $row['title'] . "</td>";
						echo "<td>" . $row['channel_id'] . "</td>";
						echo "<td>" . $row['game'] . "</td>";
						echo "<td>" . $row['viewers'] . "</td>";
						echo "<td><a class='colorButton' href='".$conf_site_url."/user/" . $row['channel_id'] . "/'<span class='pointer'>Watch Live</span></a></td>";
						echo "</tr>";
					}
						echo $content_end;
					?>

</div>
    <div class="tf_pagination">
        <a class="page_next button_link" href="?s=<?=$search?>&p=<?=$next_page?>"><span>Next</span></a>
        <a class="page_prev button_link" href="?s=<?=$search?>&p=<?=$prev_page?>"><span>Previous</span></a>
    </div>
    </div>
    <!--/ content --> 
    
   
    <div class="clear"></div>
    
</div>
</div>
<!--/ middle -->
<!--/ middle -->

<div class="footer">
<div class="footer_inner">
<div class="container_12">
	
    <div class="grid_8">
    	<h3><?=$conf_site_name?></h3>   
		
        <div class="copyright">
		<?=$conf_site_copy?> <br /><a href="<?=$conf_site_url?>/company/legal/">Terms of Service</a> - <a href="<?=$conf_site_url?>/company/support/">Contact</a> -
		<a href="<?=$conf_site_url?>/company/legal/">Privacy guidelines</a> - <a href="<?=$conf_site_url?>/company/support/">Advertise with Us</a></p>
		</div>          
    </div>
    
    <div class="grid_4">
    	<h3>Follow us</h3>
        <div class="footer_social">
        	<a href="<?=$conf_site_url?>/facebook/" class="icon-facebook">Facebook</a> 
            <a href="<?=$conf_site_url?>/twitter/" class="icon-twitter">Twitter</a>
            <a href="<?=$conf_site_url?>/rss/" class="icon-rss">RSS</a>
            <div class="clear"></div>
        </div>
    </div>
    
    <div class="clear"></div>
</div>
</div>
</div>   

</div>   
</body>
</html>
