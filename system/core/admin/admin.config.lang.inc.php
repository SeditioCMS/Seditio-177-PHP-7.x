<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditiocms.com
[BEGIN_SED]
File=admin.config.lang.inc.php
Version=177
Updated=2015-feb-06
Type=Core.admin
Author=Neocrome
Description=Administration panel
[END_SED]
==================== */

if (!defined('SED_CODE') || !defined('SED_ADMIN')) { die('Wrong URL.'); }

$handle = opendir("system/lang/");

while ($f = readdir($handle))
	{
	if ($f[0] != '.')
		{ $langlist[] = $f; }
	}
closedir($handle);
sort($langlist);

$t = new XTemplate(sed_skinfile('admin.config.lang', true)); 

//while(list($i,$x) = each($langlist))
	foreach($langlist as $i => $x)
	{
	$info = sed_infoget("system/lang/$x/main.lang.php");		
	$lang_name = (empty($sed_languages[$x])) ? $sed_countries[$x] : $sed_languages[$x];
	$lang_code = $x;
	$lang_desc = $L['Version']." : ".$info['Version']."<br />";
	$lang_desc .= $L['Author']." : ".$info['Author']."<br />";
	$lang_desc .= $L['Updated']." : ".$info['Updated'];
	$lang_default = ($x == $cfg['defaultlang']) ? $out['img_checked'] : '';	
	
	$t -> assign(array( 
		"LANG_LIST_NAME" => $lang_name,
		"LANG_LIST_DESC" => $lang_desc,
		"LANG_LIST_CODE" => $lang_code,
		"LANG_LIST_DEFAULT" => $lang_default
	));
		
	$t -> parse("ADMIN_CONFIG_LANG.LANG_LIST");
	}
  
$t -> parse("ADMIN_CONFIG_LANG");
$adminmain .= $t -> text("ADMIN_CONFIG_LANG");  	

?>
