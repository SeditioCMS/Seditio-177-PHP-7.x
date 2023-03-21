<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditiocms.com
[BEGIN_SED]
File=index.inc.php
Version=177
Updated=2015-feb-06
Type=Core
Author=Neocrome
Description=Home page
[END_SED]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

/* === Hook === */
$extp = sed_getextplugins('index.first');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include('plugins/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('index', 'a');

/* === Hook === */
$extp = sed_getextplugins('index.main');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include('plugins/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */


require("system/header.php");

$mskin = sed_skinfile('index');
$t = new XTemplate($mskin);

/* === Hook === */
$extp = sed_getextplugins('index.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include('plugins/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */    

$t->parse("MAIN");
$t->out("MAIN");

require("system/footer.php");

?>
