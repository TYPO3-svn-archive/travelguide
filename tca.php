<?php
if (!defined ("TYPO3_MODE")) 	die ("Access denied.");

$TCA["tx_travelguide_main"] = Array (
	"ctrl" => $TCA["tx_travelguide_main"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden, desc_clicks, map_clicks, name, cat, logo, address, place, tel, fax, email, site, type, par1, par1alt, foto1, par2, par2alt, foto2, par3, par3alt, foto3, par4, par4alt, map, par5, par5alt"
	),
	"feInterface" => $TCA["tx_travelguide_main"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (		
			"exclude" => 1,	
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"name" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.name",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
				"eval" => "required",
			)
		),
		"cat" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.cat",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_travelguide_cat",	
				"foreign_table_where" => "ORDER BY tx_travelguide_cat.uid",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"logo" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.logo",		
			"config" => Array (
				"type" => "group",
				"internal_type" => "file",
				"allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],	
				"max_size" => 500,	
				"uploadfolder" => "uploads/tx_travelguide",
				"show_thumbs" => 1,	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"address" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.address",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",	
				"rows" => "5",
			)
		),
		"place" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.place",		
			"config" => Array (
				"type" => "select",	
				"foreign_table" => "tx_travelguide_place",	
				"foreign_table_where" => "ORDER BY tx_travelguide_place.uid",	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"tel" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.tel",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"fax" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.fax",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"email" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.email",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"site" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.site",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"par1" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par1",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "3",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"par1alt" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par1alt",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "3",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"foto1" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.foto1",		
			"config" => Array (
				"type" => "group",
				"internal_type" => "file",
				"allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],	
				"max_size" => 500,	

				"uploadfolder" => "uploads/tx_travelguide",
				"show_thumbs" => 1,	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"foto1alttext" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.foto1alttext",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"par2" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par2",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "5",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"par2alt" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par2alt",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "5",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"foto2" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.foto2",		
			"config" => Array (
				"type" => "group",
				"internal_type" => "file",
				"allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],	
				"max_size" => 500,	
				"uploadfolder" => "uploads/tx_travelguide",
				"show_thumbs" => 1,	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"foto2alttext" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.foto2alttext",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"par3" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par3",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "5",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"par3alt" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par3alt",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "5",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"foto3" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.foto3",		
			"config" => Array (
				"type" => "group",

				"internal_type" => "file",
				"allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],	
				"max_size" => 500,	
				"uploadfolder" => "uploads/tx_travelguide",
				"show_thumbs" => 1,	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"foto3alttext" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.foto3alttext",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"par4" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par4",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "5",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"par4alt" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par4alt",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "5",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"map" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.map",		
			"config" => Array (
				"type" => "group",
				"internal_type" => "file",
				"allowed" => $GLOBALS["TYPO3_CONF_VARS"]["GFX"]["imagefile_ext"],	
				"max_size" => 500,	
				"uploadfolder" => "uploads/tx_travelguide",
				"show_thumbs" => 1,	
				"size" => 1,	
				"minitems" => 0,
				"maxitems" => 1,
			)
		),
		"mapalttext" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.mapalttext ",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
		"par5" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par5",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "5",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"par5alt" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.par5alt",		
			"config" => Array (
				"type" => "text",
				"cols" => "30",
				"rows" => "5",
				"wizards" => Array(
					"_PADDING" => 2,
					"RTE" => Array(
						"notNewRecords" => 1,
						"RTEonly" => 1,
						"type" => "script",
						"title" => "Full screen Rich Text Editing|Formatteret redigering i hele vinduet",
						"icon" => "wizard_rte2.gif",
						"script" => "wizard_rte.php",
					),
				),
			)
		),
		"desc_clicks" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.desc_clicks",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"eval" => "int",
			)
		),
		"map_clicks" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.map_clicks",		
			"config" => Array (
				"type" => "input",	
				"size" => "10",	
				"eval" => "int",
			)
		),
		"type" => Array (
			"exclude" => 0,
			"label" => $LANG_GENERAL_LABELS["type"],
			"config" => Array (
				"type" => "select",    
				"items" => Array (    
					Array("LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.type.0", 0),
					Array("LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.type.1", 1),
					Array("LLL:EXT:travelguide/locallang_db.php:tx_travelguide_main.type.2", 2),
				),
				"default" => 0
			)
		)
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, name;;2;;2-1-1, cat, logo, address, place, tel, fax, email, site, type"),
		"1" => Array("showitem" => "hidden;;1;;1-1-1, name;;2;;2-1-1, cat, logo, address, place, tel, fax, email, site, type, par1;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/], foto1, foto1alttext, par2;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/], foto2, foto2alttext, par3;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/], foto3, foto3alttext, par4;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/], map, mapalttext, par5;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/]"),
		"2" => Array("showitem" => "hidden;;1;;1-1-1, name;;2;;2-1-1, cat, logo, address, place, tel, fax, email, site, type, par1alt;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/], foto1, foto1alttext, par2alt;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/], foto2, foto2alttext, par3alt;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/], foto3, foto3alttext, par4alt;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/], map, mapalttext, par5alt;;;richtext[cut|copy|paste|formatblock|textcolor|bold|italic|underline|left|center|right|orderedlist|unorderedlist|outdent|indent|link|table|image|line|chMode]:rte_transform[mode=ts_css|imgpath=uploads/tx_travelguide/rte/]"),
	),
	"palettes" => Array (
		"1" => Array("showitem" => ""),
		"2" => Array("showitem" => "desc_clicks, map_clicks"),
	)
);



$TCA["tx_travelguide_cat"] = Array (
	"ctrl" => $TCA["tx_travelguide_cat"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "hidden,title,titlealt"
	),
	"feInterface" => $TCA["tx_travelguide_cat"]["feInterface"],
	"columns" => Array (
		"hidden" => Array (		
			"exclude" => 1,	
			"label" => "LLL:EXT:lang/locallang_general.php:LGL.hidden",
			"config" => Array (
				"type" => "check",
				"default" => "0"
			)
		),
		"title" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_cat.title",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
				"eval" => "required",
			)
		),
		"titlealt" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_cat.titlealt",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "hidden;;1;;1-1-1, title;;;;2-2-2, titlealt")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);



$TCA["tx_travelguide_place"] = Array (
	"ctrl" => $TCA["tx_travelguide_place"]["ctrl"],
	"interface" => Array (
		"showRecordFieldList" => "placename,cap"
	),
	"feInterface" => $TCA["tx_travelguide_place"]["feInterface"],
	"columns" => Array (
		"placename" => Array (		
			"exclude" => 1,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_place.placename",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",	
				"eval" => "required",
			)
		),
		"cap" => Array (		
			"exclude" => 0,		
			"label" => "LLL:EXT:travelguide/locallang_db.php:tx_travelguide_place.cap",		
			"config" => Array (
				"type" => "input",	
				"size" => "30",
			)
		),
	),
	"types" => Array (
		"0" => Array("showitem" => "placename;;;;1-1-1, cap")
	),
	"palettes" => Array (
		"1" => Array("showitem" => "")
	)
);
?>