<?PHP

/* ====================
Seditio - Website engine
Copyright Neocrome & Seditio Team
http://www.neocrome.net
http://www.seditiocms.com
[BEGIN_SED]
File=users.php
Version=177
Updated=2015-feb-06
Type=Core
Author=Neocrome
Description=Users
[END_SED]
==================== */

if (!defined('SED_CODE')) { die('Wrong URL.'); }

$y = sed_import('y','P','TXT');
$id = sed_import('id','G','INT');
$s = sed_import('s','G','ALP',13);
$w = sed_import('w','G','ALP',4);
$d = sed_import('d','G','INT');
$f = sed_import('f','G','TXT');

list($usr['auth_read'], $usr['auth_write'], $usr['isadmin']) = sed_auth('users', 'a');
sed_block($usr['auth_read']);

/* === Hook === */
$extp = sed_getextplugins('users.details.first');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include('plugins/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if (empty($id) && $usr['id']>0)
   { $id = $usr['id']; }

$sql = sed_sql_query("SELECT * FROM $db_users WHERE user_id='$id' LIMIT 1");
sed_die(sed_sql_numrows($sql)==0);
$urr = sed_sql_fetchassoc($sql);


$urr['user_website'] = sed_build_url($urr['user_website']);
$urr['user_age'] = ($urr['user_birthdate']!=0) ? sed_build_age($urr['user_birthdate']) : '';
$urr['user_birthdate'] = ($urr['user_birthdate']!=0) ? @date($cfg['formatyearmonthday'], $urr['user_birthdate']) : '';
$urr['user_gender'] = ($urr['user_gender']=='' || $urr['user_gender']=='U') ?  '' : $L["Gender_".$urr['user_gender']];

if (!$urr['user_text_ishtml'] && $cfg['textmode']=='html')
  {
	$urr['user_text'] = sed_build_usertext(sed_cc($urr['user_text'])); 
/*	$urr['user_text'] = sed_parse($urr['user_text'], 1, 1, 1);  */
	$sql3 = sed_sql_query("UPDATE $db_users SET user_text_ishtml=1, user_text='".sed_sql_prep($urr['user_text'])."' WHERE user_id=".$urr['user_id']); 
  }
if ($cfg['textmode']=='bbcode') {
	$urr['user_text'] = sed_build_usertext(sed_cc($urr['user_text']));
}

$out['subtitle'] = $L['User']." : ".sed_cc($urr['user_name']);
$title_tags[] = array('{MAINTITLE}', '{TITLE}', '{SUBTITLE}');
$title_tags[] = array('%1$s', '%2$s', '%3$s');
$title_data = array($cfg['maintitle'], $out['subtitle'], $cfg['subtitle']);
$out['subtitle'] = sed_title('userstitle', $title_tags, $title_data);

/* === Hook === */
$extp = sed_getextplugins('users.details.main');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include('plugins/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

require("system/header.php");

$mskin = sed_skinfile(array('users', 'details'));
$t = new XTemplate($mskin);

$t->assign(array(
	"USERS_DETAILS_TITLE" => "<a href=\"".sed_url("users")."\">".$L['Users']."</a> ".$cfg['separator']." ".sed_build_user($urr['user_id'], sed_cc($urr['user_name'])),
	"USERS_DETAILS_SUBTITLE" => $L['use_subtitle'],
	"USERS_DETAILS_ID" => $urr['user_id'],
	"USERS_DETAILS_PM" => sed_build_pm($urr['user_id']),
	"USERS_DETAILS_NAME" => sed_cc($urr['user_name']),
	"USERS_DETAILS_PASSWORD" => $urr['user_password'],
	"USERS_DETAILS_MAINGRP" => sed_build_group($urr['user_maingrp']),
	"USERS_DETAILS_MAINGRPID" => $urr['user_maingrp'],
	"USERS_DETAILS_MAINGRPSTARS" => sed_build_stars($sed_groups[$urr['user_maingrp']]['level']),
	"USERS_DETAILS_MAINGRPICON" => sed_build_userimage($sed_groups[$urr['user_maingrp']]['icon']),
	"USERS_DETAILS_GROUPS" => sed_build_groupsms($urr['user_id'], FALSE, $urr['user_maingrp']),
	"USERS_DETAILS_COUNTRY" => sed_build_country($urr['user_country']),
	"USERS_DETAILS_COUNTRYFLAG" => sed_build_flag($urr['user_country']),
	"USERS_DETAILS_TEXT" => $urr['user_text'],
	"USERS_DETAILS_AVATAR" => sed_build_userimage($urr['user_avatar']),
	"USERS_DETAILS_PHOTO" => sed_build_userimage($urr['user_photo']),
	"USERS_DETAILS_SIGNATURE" => sed_build_userimage($urr['user_signature']),
	"USERS_DETAILS_EXTRA1" => sed_cc($urr['user_extra1']),
	"USERS_DETAILS_EXTRA2" => sed_cc($urr['user_extra2']),
	"USERS_DETAILS_EXTRA3" => sed_cc($urr['user_extra3']),
	"USERS_DETAILS_EXTRA4" => sed_cc($urr['user_extra4']),
	"USERS_DETAILS_EXTRA5" => sed_cc($urr['user_extra5']),
	"USERS_DETAILS_EXTRA6" => sed_cc($urr['user_extra6']),
	"USERS_DETAILS_EXTRA7" => sed_cc($urr['user_extra7']),
	"USERS_DETAILS_EXTRA8" => sed_cc($urr['user_extra8']),
	"USERS_DETAILS_EXTRA9" => sed_cc($urr['user_extra9']),
	"USERS_DETAILS_EXTRA1_TITLE" => $cfg['extra1title'],
	"USERS_DETAILS_EXTRA2_TITLE" => $cfg['extra2title'],
	"USERS_DETAILS_EXTRA3_TITLE" => $cfg['extra3title'],
	"USERS_DETAILS_EXTRA4_TITLE" => $cfg['extra4title'],
	"USERS_DETAILS_EXTRA5_TITLE" => $cfg['extra5title'],
	"USERS_DETAILS_EXTRA6_TITLE" => $cfg['extra6title'],
	"USERS_DETAILS_EXTRA7_TITLE" => $cfg['extra7title'],
	"USERS_DETAILS_EXTRA8_TITLE" => $cfg['extra8title'],
	"USERS_DETAILS_EXTRA9_TITLE" => $cfg['extra9title'],
	"USERS_DETAILS_EMAIL" => sed_build_email($urr['user_email'], $urr['user_hideemail']),
	"USERS_DETAILS_PMNOTIFY" =>  $sed_yesno[$urr['user_pmnotify']],
	"USERS_DETAILS_SKIN" => $urr['user_skin'],
	"USERS_DETAILS_WEBSITE" => $urr['user_website'],
	"USERS_DETAILS_ICQ" => sed_build_icq($urr['user_icq']),
	"USERS_DETAILS_SKYPE" => sed_build_skype($urr['user_skype']),
	"USERS_DETAILS_IRC" => sed_cc($urr['user_irc']),
	"USERS_DETAILS_GENDER" => $urr['user_gender'],
	"USERS_DETAILS_BIRTHDATE" => $urr['user_birthdate'],
	"USERS_DETAILS_AGE" => $urr['user_age'],
	"USERS_DETAILS_TIMEZONE" => sed_build_timezone($urr['user_timezone']),
	"USERS_DETAILS_LOCATION" => sed_cc($urr['user_location']),
	"USERS_DETAILS_OCCUPATION" => sed_cc($urr['user_occupation']),
	"USERS_DETAILS_REGDATE" => sed_build_date($cfg['dateformat'], $urr['user_regdate'])." ".$usr['timetext'],
	"USERS_DETAILS_LASTLOG" => sed_build_date($cfg['dateformat'], $urr['user_lastlog'])." ".$usr['timetext'],
	"USERS_DETAILS_LOGCOUNT" => $urr['user_logcount'],
	"USERS_DETAILS_POSTCOUNT" => $urr['user_postcount'],
	"USERS_DETAILS_LASTIP" => $urr['user_lastip']
		));

/* === Hook === */
$extp = sed_getextplugins('users.details.tags');
if (is_array($extp))
	{ foreach($extp as $k => $pl) { include('plugins/'.$pl['pl_code'].'/'.$pl['pl_file'].'.php'); } }
/* ===== */

if ($usr['isadmin'])
		{
		$t-> assign(array(
			"USERS_DETAILS_ADMIN_EDIT" => "<a href=\"".sed_url("users", "m=edit&id=".$urr['user_id'])."\">".$L['Edit']."</a>"
			));

		$t->parse("MAIN.USERS_DETAILS_ADMIN");
		}

$t->parse("MAIN");
$t->out("MAIN");

require("system/footer.php");

?>