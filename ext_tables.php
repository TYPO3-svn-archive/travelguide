<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

t3lib_extMgm::allowTableOnStandardPages("tx_travelguide_main");


t3lib_extMgm::addToInsertRecords("tx_travelguide_main");

$TCA["tx_travelguide_main"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main",		
		"label" => "name",	
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"default_sortby" => "ORDER BY name",	
		"delete" => "deleted",	
		"enablecolumns" => Array (		
			"disabled" => "hidden",
		),
		"type" => "type",
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_travelguide_main.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, desc_clicks, map_clicks, name, cat, logo, address, place, tel, fax, email, site, type, par1, par1alt, foto1, par2, par2alt, foto2, par3, par3alt, foto3, par4, par4alt, map, par5, par5alt",
	)
);


t3lib_extMgm::allowTableOnStandardPages("tx_travelguide_cat");

$TCA["tx_travelguide_cat"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_cat",		
		"label" => "title",	
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"default_sortby" => "ORDER BY title",	
		"delete" => "deleted",	
		"enablecolumns" => Array (		
			"disabled" => "hidden",
		),
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_travelguide_cat.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "hidden, title, titlealt",
	)
);


t3lib_extMgm::allowTableOnStandardPages("tx_travelguide_place");

$TCA["tx_travelguide_place"] = Array (
	"ctrl" => Array (
		"title" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_place",		
		"label" => "placename",	
		"tstamp" => "tstamp",
		"crdate" => "crdate",
		"cruser_id" => "cruser_id",
		"default_sortby" => "ORDER BY placename",	
		"delete" => "deleted",	
		"dynamicConfigFile" => t3lib_extMgm::extPath($_EXTKEY)."tca.php",
		"iconfile" => t3lib_extMgm::extRelPath($_EXTKEY)."icon_tx_travelguide_place.gif",
	),
	"feInterface" => Array (
		"fe_admin_fieldList" => "placename, cap",
	)
);


t3lib_div::loadTCA("tt_content");
$TCA["tt_content"]["types"]["list"]["subtypes_excludelist"][$_EXTKEY."_pi1"]="layout,select_key";


t3lib_extMgm::addPlugin(Array("LLL:EXT:travelguide/locallang_db.php:tt_content.list_type_pi1", $_EXTKEY."_pi1"),"list_type");


if (TYPO3_MODE=="BE")	$TBE_MODULES_EXT["xMOD_db_new_content_el"]["addElClasses"]["tx_travelguide_pi1_wizicon"] = t3lib_extMgm::extPath($_EXTKEY)."pi1/class.tx_travelguide_pi1_wizicon.php";
?>