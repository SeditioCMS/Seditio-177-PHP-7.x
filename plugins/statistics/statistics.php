<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditio.org
[BEGIN_SED]
File=plugins/statistics/statistics.php
Version=177
Updated=2015-feb-06
Type=Plugin
Author=Neocrome
Description=
[END_SED]

[BEGIN_SED_EXTPLUGIN]
Code=statistics
Part=main
File=statistics
Hooks=standalone
Tags=
Order=10
[END_SED_EXTPLUGIN]
==================== */

if (!defined('SED_CODE') || !defined('SED_PLUG')) { die('Wrong URL.'); }

$s = sed_import('s','G','TXT');
$m = sed_import('m','G','TXT');

if ($m=='share')
	{
	
	$output = "Seditio - Website engine<br />Copyright Neocrome & Seditio Team<br />";
	$output .= "<a href=\"http://www.seditiocms.com\">http://www.seditiocms.com</a><br />";
	$output .= "&nbsp;<br />[BEGIN_SED]<br />Title=".$cfg['maintitle']."<br />";
	$output .= "Subtitle=".$cfg['subtitle']."<br />Version=".$cfg['version']."<br />";
	$output .= "Pages=".sed_sql_rowcount($db_pages)."<br />Users=".sed_sql_rowcount($db_users)."<br />";
	$output .= "Pms=".sed_stat_get('totalpms')."<br />Forum_views=".$totaldbviews."<br />[END_SED]&nbsp;";
	die($output);
	}

$plugin_title = $L['plu_title'];

$totaldbpages = sed_sql_rowcount($db_pages);
$totaldbcomments = sed_sql_rowcount($db_com);
$totaldbratings = sed_sql_rowcount($db_ratings);
$totaldbratingsvotes = sed_sql_rowcount($db_rated);
$totaldbpolls = sed_sql_rowcount($db_polls);
$totaldbpollsvotes = sed_sql_rowcount($db_polls_voters);
$totaldbfiles = sed_sql_rowcount($db_pfs);
$totaldbusers = sed_sql_rowcount($db_users);

$totalpages = sed_stat_get('totalpages');
$totalmailsent = sed_stat_get('totalmailsent');
$totalpmsent = sed_stat_get('totalpms');

$totaldbfilesize = sed_sql_query("SELECT SUM(pfs_size) FROM $db_pfs");
$totaldbfilesize = sed_sql_result($totaldbfilesize,0,"SUM(pfs_size)");

$totalpmactive = sed_sql_query("SELECT COUNT(*) FROM $db_pm WHERE pm_state<2");
$totalpmactive = sed_sql_result($totalpmactive,0,"COUNT(*)");

$totalpmarchived = sed_sql_query("SELECT COUNT(*) FROM $db_pm WHERE pm_state=2");
$totalpmarchived = sed_sql_result($totalpmarchived,0,"COUNT(*)");

$totalpmold = sed_sql_query("SELECT COUNT(*) FROM $db_pm WHERE pm_state=3");
$totalpmold = sed_sql_result($totalpmold,0,"COUNT(*)");

$sql = sed_sql_query("SELECT stat_name FROM $db_stats WHERE stat_name LIKE '20%' ORDER BY stat_name ASC LIMIT 1");
$row = sed_sql_fetchassoc($sql);
$since = $row['stat_name'];

$sql = sed_sql_query("SELECT * FROM $db_stats WHERE stat_name LIKE '20%' ORDER BY stat_value DESC LIMIT 1");
$row = sed_sql_fetchassoc($sql);
$max_date = $row['stat_name'];
$max_hits = $row['stat_value'];

$plugin_body .= "<h4>".$L['Main'].": </h4><table class=\"cells striped\">";
$plugin_body .= "<tr><td colspan=\"2\">".$L['plu_maxwasreached']." ".$max_date.", ".$max_hits." ";
$plugin_body .= $L['plu_pagesdisplayedthisday']."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_totalpagessince']." ".$since."</td><td style=\"text-align:right;\">".$totalpages."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_registeredusers']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totaldbusers."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_dbpages']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totaldbpages."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_dbcomments']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totaldbcomments."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_totalmails']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totalmailsent."</td></tr></table>";

$plugin_body .= "<h4>".$L['plu_pm']." :</h4><table class=\"cells striped\">";
$plugin_body .= "<tr><td>".$L['plu_totalpms']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totalpmsent."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_totalactivepms']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totalpmactive."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_totalarchivedpms']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totalpmarchived."</td></tr></table>";

$plugin_body .= "<h4>".$L['plu_pollsratings']." :</h4><table class=\"cells striped\">";
$plugin_body .= "<tr><td>".$L['plu_pagesrated']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totaldbratings."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_votesratings']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totaldbratingsvotes."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_polls']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totaldbpolls."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_votespolls']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totaldbpollsvotes."</td></tr></table>";

$plugin_body .= "<h4>".$L['plu_pfs']." :</h4><table class=\"cells striped\">";
$plugin_body .= "<tr><td>".$L['plu_pfsspace']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totaldbfiles."</td></tr>";
$plugin_body .= "<tr><td>".$L['plu_pfssize']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".floor($totaldbfilesize/1024)." ".$L['kb']."</td></tr></table>";

$plugin_body .= "<h4>".$L['plu_contributions']." :</h4><table class=\"cells striped\">";

if ($usr['id']>0)
	{
	
	$sql = sed_sql_query("SELECT COUNT(*) FROM $db_com WHERE com_authorid='".$usr['id']."'");
	$user_comments = sed_sql_result($sql,0,"COUNT(*)");

	$plugin_body .= "<tr><td>".$L['plu_comments']."</td><td style=\"text-align:right;\">".$user_comments."</td></tr>";
	}
else
	{ $plugin_body .= $L['plu_notloggedin']; }

$plugin_body .= "</table>";

if ($s=='usercount')
	{
	$sql1 = sed_sql_query("DROP TEMPORARY TABLE IF EXISTS tmp1");
	$sql = sed_sql_query("CREATE TEMPORARY TABLE tmp1 SELECT user_country, COUNT(*) as usercount FROM $db_users GROUP BY user_country");
	$sql = sed_sql_query("SELECT * FROM tmp1 WHERE 1 ORDER by usercount DESC");
	$sql1 = sed_sql_query("DROP TEMPORARY TABLE IF EXISTS tmp1");
	}
else
	{
	$sql = sed_sql_query("SELECT user_country, COUNT(*) as usercount FROM $db_users GROUP BY user_country ASC");
	}

$sqltotal = sed_sql_query("SELECT COUNT(*) FROM $db_users WHERE 1");
$totalusers = sed_sql_result($sqltotal,0,"COUNT(*)");

$plugin_body .= "<h4>".$L['plu_membersbycountry']." :</h4><table class=\"cells striped\">";
$plugin_body .= "<tr><td colspan=\"2\" class=\"coltop\"><a href=\"".sed_url("plug", "e=statistics")."\">$sed_img_down</a> ".$L['plu_country']."</td>";
$plugin_body .= "<td style=\"text-align:center;\" class=\"coltop\"><a href=\"".sed_url("plug", "e=statistics&s=usercount")."\">$sed_img_down</a> ".$L['Users']."</td></tr>";

$ii = 0;

while ($row = sed_sql_fetchassoc($sql))
	{
	$country_code = $row['user_country'];

	if (!empty($country_code) && $country_code!='00')
		{
		$country_count = $row['usercount'];
		$country_name = sed_build_country($country_code);
		$country_flag = sed_build_flag($country_code);
		$ii = $ii + $country_count;
		$plugin_body .= "<tr><td style=\"text-align:center; width:32px;\">".$country_flag."</td>";
		$plugin_body .= "<td>".$country_name."</td><td style=\"text-align:right;\">".$country_count."</td></tr>";
		}
	}

$unknown_count = $totalusers - $ii;

$plugin_body .= "<tr><td style=\"text-align:center;\"><img src=\"system/img/flags/f-00.gif\" alt=\"\" /></td>";
$plugin_body .= "<td>".$L['plu_unknown']."</td><td style=\"text-align:right;\">".$unknown_count."</td></tr>";
$plugin_body .= "<tr><td colspan=\"2\" style=\"text-align:right;\">".$L['plu_total']."</td>";
$plugin_body .= "<td style=\"text-align:right;\">".$totalusers."</td></tr></table>";


?>
