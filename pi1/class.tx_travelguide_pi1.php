<?php
/***************************************************************
*  Copyright notice
*  
*  (c) 2003 David (typo3@intera.it)
*  All rights reserved
*
*  This script is part of the TYPO3 project. The TYPO3 project is 
*  free software; you can redistribute it and/or modify
*  it under the terms of the GNU General Public License as published by
*  the Free Software Foundation; either version 2 of the License, or
*  (at your option) any later version.
* 
*  The GNU General Public License can be found at
*  http://www.gnu.org/copyleft/gpl.html.
* 
*  This script is distributed in the hope that it will be useful,
*  but WITHOUT ANY WARRANTY; without even the implied warranty of
*  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*  GNU General Public License for more details.
*
*  This copyright notice MUST APPEAR in all copies of the script!
***************************************************************/
/** 
 * Plugin 'Travel guide' for the 'travelguide' extension.
 *
 * @author	David <typo3@intera.it>
 */


require_once(PATH_tslib."class.tslib_pibase.php");
require_once(PATH_t3lib."class.t3lib_stdgraphic.php");

class tx_travelguide_pi1 extends tslib_pibase {
	var $prefixId = "tx_travelguide_pi1";		// Same as class name
	var $scriptRelPath = "pi1/class.tx_travelguide_pi1.php";	// Path to this script relative to the extension dir.
	var $extKey = "travelguide";	// The extension key.

	/**
	 * [Put your description here]
	 */

	function main($content,$conf)	{

		//global $TSFE;
		//$TSFE->set_no_cache();    // Turning caching off - good while developing.

		$this->conf = $conf;
		$this->PSingle = intval($this->conf["PidSingle"]);
		$this->PMap = intval($this->conf["PidMap"]);
		$this->PSearch = intval($this->conf["PidSearch"]);
		$this->Lval = intval($this->conf["AltLangID"]);

		//this select the alternative language
		//$this->altlang=false;
		$this->L = t3lib_div::GPvar("L"); 
		if (!isset($this->L)) { 
			$this->L=0; $this->altlang=false; 
		}else { 
			if ($this->L == $this->Lval){
				$this->altlang=true; 
			}else{
				$this->altlang=false;
			}
		}//end if select the alternative language

		$categories=array();	
		$catComplete=array();
		$localities=array();	
		$locComplete=array();	

		$this->initCategories();
		$this->initLocalities();

		$this->tx_travelguide_pi1 = t3lib_div::GPvar("tx_travelguide_pi1");
		$this->local_cObj = t3lib_div::makeInstance("tslib_cObj");   // Local cObj.
		
		switch((string)$this->tx_travelguide_pi1["CMD"]) {
			case "singleView":
				$this->internal["currentTable"] = "tx_travelguide_main";
				$this->internal["currentRow"] = $this->pi_getRecord("tx_travelguide_main",intval($this->tx_travelguide_pi1["uid"]));
				return $this->pi_wrapInBaseClass($this->singleView($content,$conf));
			break;
			case "mapView":
				$this->internal["currentTable"] = "tx_travelguide_main";
				$this->internal["currentRow"] = $this->pi_getRecord("tx_travelguide_main",intval($this->tx_travelguide_pi1["uid"]));
				return $this->pi_wrapInBaseClass($this->mapView($content,$conf));
			break;
			default:
				if (strstr($this->cObj->currentRecord,"tt_content"))	{
					$conf["pidList"] = $this->cObj->data["pages"];
					$conf["recursive"] = $this->cObj->data["recursive"];
				}
				return $this->pi_wrapInBaseClass($this->listView($content,$conf));
			break;
		}
	}

	/**
	 * from tt_news by Kasper Skårhøj
	 */
	function initCategories()	{
			// Fetching catagories:
	 	$query = "select * from tx_travelguide_cat where 1=1 AND NOT tx_travelguide_cat.deleted AND NOT tx_travelguide_cat.hidden".$this->cObj->enableFields("tx_travelguide_cat");
		$res = mysql(TYPO3_db,$query);
		echo mysql_error();
		$this->categories=array();
		$this->catComplete=array();
		while($row = mysql_fetch_assoc($res))	{  // if serve per togliere il 4 stelle 
//&& $row["titlealt"]!=''
			if ($this->altlang  ) {
				(eregi('hotel', $row["titlealt"])) ? $this->categories[$row["uid"]] = "Hotel" : $this->categories[$row["uid"]] = $row["titlealt"];
				$this->catComplete[$row["uid"]] = $row["titlealt"];
			}else{
				(eregi('hotel', $row["title"])) ? $this->categories[$row["uid"]] = "Hotel" : $this->categories[$row["uid"]] = $row["title"];
				$this->catComplete[$row["uid"]] = $row["title"];
			}//end if
		}//end while	
	}//end function 

	/**
	 * from tt_news by Kasper Skårhøj
	 */
	function initLocalities()	{
			// Fetching catagories:
	 	$query = "select * from tx_travelguide_place where 1=1 AND  NOT tx_travelguide_place.deleted".$this->cObj->enableFields("tx_travelguide_place");
		$res = mysql(TYPO3_db,$query);
		echo mysql_error();
		$this->localities=array();
		$this->locComplete=array();
		while($row = mysql_fetch_assoc($res))	{
			$this->localities[$row["uid"]] = $row["cap"].' - '.$row["placename"];
			$this->locComplete[$row["uid"]] = $row["placename"];
		}	
	}
	
	/**
	 * [Put your description here]
	 */
	function listView($content,$conf)	{
		$this->conf=$conf;		// Setting the TypoScript passed to this function in $this->conf
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();		// Loading the LOCAL_LANG values

		$lConf = $this->conf["listView."];	// Local settings for the listView function
/*
		$this->piVars["showUid"] = $this->travel_guide_uid;
		if (!$this->piVars["showUid"]) {$this->piVars["showUid"] = $this->travel_guide_map_uid;}
		
		if ($this->piVars["showUid"])	{	// If a single element should be displayed:
			$this->internal["currentTable"] = "tx_travelguide_main";
			$this->internal["currentRow"] = $this->pi_getRecord("tx_travelguide_main",$this->piVars["showUid"]);
			
			if ($this->travel_guide_uid) {$content = $this->singleView($content,$conf);}
			if ($this->travel_guide_map_uid) {$content = $this->mapView($content,$conf);}
			return $content;
		} else { */
			$items=array(
				"1"=> $this->pi_getLL("list_mode_1","Mode 1"),
				"2"=> $this->pi_getLL("list_mode_2","Mode 2"),
				"3"=> $this->pi_getLL("list_mode_3","Mode 3"),
			);
			if (!isset($this->piVars["pointer"]))	$this->piVars["pointer"]=0;
			if (!isset($this->piVars["mode"]))	$this->piVars["mode"]=1;
	
				// Initializing the query parameters:
			
			list($this->internal["orderBy"],$this->internal["descFlag"]) = explode(":",$this->piVars["sort"]);
			$this->internal["results_at_a_time"]=t3lib_div::intInRange($lConf["results_at_a_time"],0,1000,3);		// Number of results to show in a listing.
			$this->internal["maxPages"]=t3lib_div::intInRange($lConf["maxPages"],0,1000,2);;		// The maximum number of "pages" in the browse-box: "Page 1", "Page 2", etc.
			//$this->internal["searchFieldList"]="name,address,tel,fax,email,site,par1,par2,par3,par4,par5";
			//$this->internal["orderByList"]="uid,name,tel,fax,email,site";

			$this->internal["searchFieldList"]="name,par1,par2,par3,par4,par5";

			if ($this->piVars["mode"]==1) $this->internal["orderByList"]="cat, name";
			if ($this->piVars["mode"]==2) $this->internal["orderByList"]="name";
			if ($this->piVars["mode"]==3) $this->internal["orderByList"]="place, name";

			$this->internal["orderByList"]= 'ORDER BY '.$this->internal["orderByList"];

				// Get number of records:

			(($this->piVars['sword']!='') OR (intval($this->piVars['scat'])>0) OR (intval($this->piVars['sloc'])>0)) ? $query = $this->tg_makesearchquery($this->piVars['sword'],$this->piVars['scat'],$this->piVars['sloc'],1) : $query = $this->pi_list_query("tx_travelguide_main",1);
			//$query = $this->pi_list_query("tx_travelguide_main",1);
                                                
			$res = mysql(TYPO3_db,$query);
			if (mysql_error())	debug(array(mysql_error(),$query));
			list($this->internal["res_count"]) = mysql_fetch_row($res);
	
			// Make listing query, pass query to MySQL:
                                                //pi_list_query($table,$count=0,$addWhere='',$mm_cat='',$groupBy='',$orderBy='',$query='') 
                                                //$query.= " ORDER BY ".$this->internal["orderByList"];

			if (($this->piVars['sword']!='') OR (intval($this->piVars['scat'])>0) OR (intval($this->piVars['sloc'])>0)) {
				$start_at = $this->piVars["pointer"] * $this->internal["results_at_a_time"];
				$limit= ' LIMIT '.$start_at.', '.$this->internal["results_at_a_time"];
				$query = $this->tg_makesearchquery($this->piVars['sword'],$this->piVars['scat'],$this->piVars['sloc'],0,$this->internal["orderByList"].$limit);
			}else{ 
				$query = $this->pi_list_query("tx_travelguide_main",'','','','',$this->internal["orderByList"],'');
			}
                                                //echo $query = $this->pi_list_query("tx_travelguide_main");

                                                //echo $query = "SELECT tx_travelguide_main.* FROM tx_travelguide_main WHERE pid IN (16) AND NOT tx_travelguide_main.deleted AND NOT tx_travelguide_main.hidden ORDER BY name LIMIT 0,15";

                                                $res = mysql(TYPO3_db,$query);
			if (mysql_error())	debug(array(mysql_error(),$query));
			$this->internal["currentTable"] = "tx_travelguide_main";

			//echo '<font color="#FFFFFF">'.$query.'</font>';

	
				// Put the whole list together:
			$fullTable="";	// Clear var;
			//$fullTable.=t3lib_div::view_array($this->piVars);	// DEBUG: Output the content of $this->piVars for debug purposes. REMEMBER to comment out the IP-lock in the debug() function in t3lib/config_default.php if nothing happens when you un-comment this line!
			//$fullTable.=t3lib_div::view_array($this->conf);	// DEBUG: Output the content of $this->piVars for debug purposes. REMEMBER to comment out the IP-lock in the debug() function in t3lib/config_default.php if nothing happens when you un-comment this line!

				// Adds the search box:			
			//$fullTable.= ($this->piVars['sword']!='') ? 'parola_on' : 'parola_off';
			$fullTable.=$this->tg_searchBox('',$this->PSearch);

			$fullTable.='
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td colspan="2"><img src=clear.gif width=6 height=6 alt=""></td></tr>
			<tr><td colspan="2" bgcolor="#D0D0D0"><img src=clear.gif width=1 height=1 alt=""></td></tr>
			<tr><td colspan="2"><img src=clear.gif width=6 height=6 alt=""></td></tr>
			</table>';

				// Adds the mode selector.
			$fullTable.= '<table cellspacing=0 cellpadding=0 border=0><tr><td>'. $this->pi_getLL("list_orderby","Order by :") .'</td><td>'. $this->pi_list_modeSelector($items,' cellspacing=2 cellpadding=2') .'</td></tr></table>';

                                                //echo '<br><font color="#FFFFFF"><b>$this->piVars[\'sword\']:</b> '.$this->piVars['sword'].'</font>';

			$fullTable.='
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr><td colspan="2"><img src=clear.gif width=6 height=6 alt=""></td></tr>
			<tr><td colspan="2" bgcolor="#D0D0D0"><img src=clear.gif width=1 height=1 alt=""></td></tr>
			<tr><td colspan="2"><img src=clear.gif width=6 height=6 alt=""></td></tr>
			</table>';

				// Adds the whole list table
			$fullTable.=$this->makelist($res);
			
				// Adds the result browser:
			$fullTable.=$this->pi_list_browseresults();
			
				// Returns the content from the plugin.
			return $fullTable;
		//}
	}
	/**
	 * [Put your description here]
	 */
	function makelist($res)	{
		$items=Array();
			// Make list table rows
		while($this->internal["currentRow"] = mysql_fetch_assoc($res))	{
			$items[]=$this->makeListItem();
		}
	
		$out = '<div'.$this->pi_classParam("listrow").'>
			'.implode(chr(10),$items).'
			</div>';
		return $out;
	}	
	
	function renderImage($image,$maxw,$alttag)	{	
		global $LANG;
		//$fI = $imgArr;
		$file = $image;
		$imgInfo='';
		$maxw = ($maxw) ? $maxw.'m' : '80m';

		$imgObj = t3lib_div::makeInstance('t3lib_stdGraphic');
		$imgObj->init();
		$imgObj->mayScaleUp=0;
		$imgObj->tempPath=PATH_site.$imgObj->tempPath;
		$imgInfo = $imgObj->getImageDimensions($file);
		//$ext = $fI['fileext'];

		if ($imgInfo)	{
			$imgInfo_scaled = $imgObj->imageMagickConvert($file,'web',$maxw,'',"",'',"",1);
			$imgInfo_scaled[3] = $this->backPath.'../'.substr($imgInfo_scaled[3],strlen(PATH_site));
			//$imageHTML = $imgObj->imgTag($imgInfo_scaled);
			$imageHTML = '<img src="'.$imgInfo_scaled[3].'" width="'.$imgInfo_scaled[0].'" height="'.$imgInfo_scaled[1].'" border="0" alt="'.$alttag.'" />';
/*
			$clipBoard = '';
			$infotext='';
			$infotext.='<b>'.$LANG->sL('LLL:EXT:lang/locallang_core.php:show_item.php.filesize').':</b><BR>'.t3lib_div::formatSize(@filesize($file)).'<BR><BR>';
			$infotext.='<b>'.$LANG->sL('LLL:EXT:lang/locallang_core.php:show_item.php.dimensions').':</b><BR>'.$imgInfo[0].'x'.$imgInfo[1].' pixels<br><br>';
			$infotext.=$clipBoard;
*/			
			$content.= $imageHTML;
		}
		return $content;
	}
	
	/**
	 * makeListItem for list view, David modded
	 */
	function makeListItem()	{

		$imgsrc= 'uploads/tx_travelguide/'.$this->getFieldContent("logo");
                                if (eregi('hotel', $this->catComplete[$this->getFieldContent("cat")])) { $categ1 = 'Hotel'; $categ2 = eregi_replace('hotel ','',$this->catComplete[$this->getFieldContent("cat")]); }
                                else { $categ1 = $this->catComplete[$this->getFieldContent("cat")]; $categ2=''; }

		$altinfo = $this->getFieldHeader("logo").' '.$categ1.' '.$this->getFieldContent("name");
		$logo_str = $this->renderImage($imgsrc,'80',$altinfo);

		$linkArrSingle = array(
			"tx_travelguide_pi1[uid]" => $this->internal["currentRow"]["uid"],
			"tx_travelguide_pi1[CMD]" => 'singleView'
			);
		
		$linkArrMap = array(
			"tx_travelguide_pi1[uid]" => $this->internal["currentRow"]["uid"],
			"tx_travelguide_pi1[CMD]" => 'mapView'
			);
		
		$name_singleView = '<span'.$this->pi_classParam("listrowField-cat").'>'.$categ1.'</span>&nbsp;<span'.$this->pi_classParam("listrowField-name").'>'.$this->getFieldContent("name").'</span>&nbsp;<span'.$this->pi_classParam("listrowField-cat").'>'.$categ2.'</span>';
		$logo_singleView = '<span'.$this->pi_classParam("listrowField-logo").'>'.$logo_str.'</span>';

		if ($this->PSingle>0){
			$link_singleView = $this->pi_linkToPage($this->getFieldHeader("des"),$this->PSingle,'_self',$linkArrSingle);
			$link_name_singleView = $this->pi_linkToPage($name_singleView,$this->PSingle,'_self',$linkArrSingle);
			//$link_logo_singleView = $this->pi_linkToPage($logo_singleView,$this->PSingle,'_self',$linkArrSingle);
			$link_logo_singleView = $logo_singleView;
		}else{
			$link_singleView = $this->pi_linkTP($this->getFieldHeader("des"),$linkArrSingle,1);
			$link_name_singleView = $this->pi_linkTP($name_singleView,$linkArrSingle,1);
			//$link_logo_singleView = $this->pi_linkTP($logo_singleView,$linkArrSingle,1);
			$link_logo_singleView = $logo_singleView;
		}
		
				
		if ($this->PMap>0){
			$link_mapView = $this->pi_linkToPage($this->getFieldHeader("par5"),$this->PMap,'_self',$linkArrMap);
		}else{
			$link_mapView = $this->pi_linkTP($this->getFieldHeader("par5"),$linkArrMap,1);
		}

		if ($this->getFieldContent("email")!=''){
		   $link_email = '<a href="mailto:'.$this->getFieldContent("email").'">'.$this->getFieldHeader("email").'</a>';
		   $str_email=  ' - 
			<span'.$this->pi_classParam("listrowField-email").'>'.$link_email.'</span>';
		}
		
		if ($this->getFieldContent("site")!=''){
		   $link_site = '<a href="http://'.$this->getFieldContent("site").'" target="_blank">'.$this->getFieldHeader("site").'</a>';
		   $str_site=  ' - 
			<span'.$this->pi_classParam("listrowField-site").'>'.$link_site.'</span>';
		}

		$out='<div'.$this->pi_classParam("listView").'>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
			<td>
				'.$link_name_singleView.'<br>
				<span'.$this->pi_classParam("listrowField-address").'>'.$this->getFieldContent("address").'</span> - 
				<span'.$this->pi_classParam("listrowField-place").'>'.$this->localities[$this->getFieldContent("place")].'</span><br>
				<span'.$this->pi_classParam("listrowField-tel").'>'.$this->getFieldHeader("tel").': '.$this->getFieldContent("tel").'</span> - 
				<span'.$this->pi_classParam("listrowField-fax").'>'.$this->getFieldHeader("fax").': '.$this->getFieldContent("fax").'</span><br>
				<span'.$this->pi_classParam("listrowField-desc").'>'.$link_singleView.'</span> - 
				<span'.$this->pi_classParam("listrowField-reachus").'>'.$link_mapView.'</span>
				'.$str_email.''.$str_site.'
			</td>
			<td>
				'.$link_logo_singleView.'
			</td>
		</tr>
			<tr><td colspan="2"><img src=clear.gif width=6 height=6 alt=""></td></tr>
			<tr><td colspan="2" bgcolor="#D0D0D0"><img src=clear.gif width=1 height=1 alt=""></td></tr>
			<tr><td colspan="2"><img src=clear.gif width=6 height=6 alt=""></td></tr>
		</table></div>';
		return $out;
	}

	
	/**
	 * David modded, Single view: the main description for the hotel...
	 */
	function singleView($content,$conf)	{

		$this->conf=$conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();

		// this is for a statistic of visits
		$inc_query = 'UPDATE tx_travelguide_main SET desc_clicks = desc_clicks+1 WHERE uid='.$this->internal["currentRow"]["uid"];
		mysql_query($inc_query);
		
		$imgMaxWidth = '150';
		$hclear = '15';
		
		$imgsrc= 'uploads/tx_travelguide/'.$this->getFieldContent("foto1");
		$altinfo = $this->getFieldContent("foto1alttext");
		($altinfo != '')? $altinfo .= ', ' : $altinfo .= '';
		$altinfo .= $this->categories[$this->getFieldContent("cat")].' '.$this->getFieldContent("name");
		$foto1_str = $this->renderImage($imgsrc,$imgMaxWidth,$altinfo);
		
		$imgsrc= 'uploads/tx_travelguide/'.$this->getFieldContent("foto2");
		$altinfo = $this->getFieldContent("foto2alttext");
		($altinfo != '')? $altinfo .= ', ' : $altinfo .= '';
		$altinfo .= $this->categories[$this->getFieldContent("cat")].' '.$this->getFieldContent("name");
		$foto2_str = $this->renderImage($imgsrc,$imgMaxWidth,$altinfo);
		
		$imgsrc= 'uploads/tx_travelguide/'.$this->getFieldContent("foto3");
		$altinfo = $this->getFieldContent("foto3alttext");
		($altinfo != '')? $altinfo .= ', ' : $altinfo .= '';
		$altinfo .= $this->categories[$this->getFieldContent("cat")].' '.$this->getFieldContent("name");
		$foto3_str = $this->renderImage($imgsrc,$imgMaxWidth,$altinfo);
		
		$content=$this->makeListItem();
		
		// This sets the title of the page for use in indexed search results:
		if ($this->internal["currentRow"]["title"])	$GLOBALS["TSFE"]->indexedDocTitle=$this->internal["currentRow"]["title"];

		// row divider:  <tr><td><img src=clear.gif width=1 height='.$hclear.' alt=""></td></tr><tr><td>
	
		if ($this->altlang) {
			$par1 = $this->getFieldContent("par1alt");
			$par2 = $this->getFieldContent("par2alt");
			$par3 = $this->getFieldContent("par3alt");
			$par4 = $this->getFieldContent("par4alt");
		}else{
			$par1 = $this->getFieldContent("par1");
			$par2 = $this->getFieldContent("par2");
			$par3 = $this->getFieldContent("par3");
			$par4 = $this->getFieldContent("par4");
		}
		$content.='<div'.$this->pi_classParam("singleView").'>
		<table border="0" cellspacing="0" cellpadding="0" width="100%"><tr><td>
		
		<table border="0" cellspacing="5" cellpadding="0" align="right">
		<tr>
			<td valign="top" '.$this->pi_classParam("singleViewField-foto1").'>'.$foto1_str.'</td>
		</tr>
		</table>
		<p'.$this->pi_classParam("singleViewField-par1").'>'.$par1.'</p>

		</td></tr><tr><td><img src=clear.gif width=1 height='.$hclear.' alt=""></td></tr><tr><td>

		<table border="0" cellspacing="5" cellpadding="0" align="left">
		<tr>
			<td valign="top" '.$this->pi_classParam("singleViewField-foto2").'>'.$foto2_str.'</td>
		</tr>
		</table>
		<p'.$this->pi_classParam("singleViewField-par2").'>'.$par2.'</p>

		</td></tr><tr><td><img src=clear.gif width=1 height='.$hclear.' alt=""></td></tr><tr><td>

		<table border="0" cellspacing="5" cellpadding="0" align="right">
		<tr>
			<td valign="top" '.$this->pi_classParam("singleViewField-foto3").'>'.$foto3_str.'</td>
		</tr>
		</table>
		<p'.$this->pi_classParam("singleViewField-par3").'>'.$par3.'</p>

		</td></tr><tr><td><img src=clear.gif width=1 height='.$hclear.' alt=""></td></tr><tr><td>

		<p'.$this->pi_classParam("singleViewField-par4").'>'.$par4.'</p>
		
		</td></tr></table>
		
                                <p><a href="javascript:history.back()">'.$this->pi_getLL("back","Back").'</a></p></div>'.
		$this->pi_getEditPanel();

                                // <p>'.$this->pi_list_linkSingle($this->pi_getLL("back","Back"),$this->getFieldContent("pid"),0).'</p></div>'.
	
		return $content;
	}	
	
	/**
	 * David modded
	 */
	function mapView($content,$conf)	{

		$this->conf=$conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();

		// this is for a statistic of visits
		$inc_query = 'UPDATE tx_travelguide_main SET map_clicks = map_clicks+1 WHERE uid='.$this->internal["currentRow"]["uid"];
		mysql_query($inc_query);

		$this->initCategories();
		$this->initLocalities();
		
		$imgMaxWidth = '350';
		
		$imgsrc= 'uploads/tx_travelguide/'.$this->getFieldContent("map");
		$altinfo = $this->getFieldContent("mapalttext");
		($altinfo != '')? $altinfo .= ', ' : $altinfo .= '';
		$altinfo .= $this->categories[$this->getFieldContent("cat")].' '.$this->getFieldContent("name");
		$map_str = $this->renderImage($imgsrc,$imgMaxWidth,$altinfo);
		
		$content=$this->makeListItem();		
		
		// This sets the title of the page for use in indexed search results:
		if ($this->internal["currentRow"]["title"])	$GLOBALS["TSFE"]->indexedDocTitle=$this->internal["currentRow"]["title"];
	
		if ($this->altlang) {
			$par5 = $this->getFieldContent("par5alt");
		}else{
			$par5 = $this->getFieldContent("par5");
		}
	
		$content.='<div'.$this->pi_classParam("mapView").'>                                   
				<p'.$this->pi_classParam("mapViewField-map").'>'.$map_str.'</p>
				<p'.$this->pi_classParam("mapViewField-par5").'>'.$par5.'</p>
		<p><a href="javascript:history.back()">'.$this->pi_getLL("back","Back").'</a></p></div>'.
		$this->pi_getEditPanel();
	
		return $content;                    
	}	

	/**
	 * [Put your description here]
	 */
	function getFieldContent($fN)	{
		switch($fN) {
			case "uid":
				return $this->pi_list_linkSingle($this->internal["currentRow"][$fN],$this->internal["currentRow"]["uid"],1);	// The "1" means that the display of single items is CACHED! Set to zero to disable caching.
			break;
			case "par1":
			case "par2":
			case "par3":
			case "par4":
			case "par5":
				//return $this->cObj->parseFunc(nl2br($this->internal["currentRow"][$fN]),$this->conf["parseFunc."]);
				return $this->cObj->parseFunc($this->internal["currentRow"][$fN],$this->conf["parseFunc."]);
                                                                //return $this->cObj->stdWrap($this->internal["currentRow"][$fN],$this->conf['rtefield_stdWrap.']);
			break;
			default:
				return $this->internal["currentRow"][$fN];
			break;
		}
	}
	/**
	 * [Put your description here]
	 */
	function getFieldHeader($fN)	{
		switch($fN) {
			
			default:
				return $this->pi_getLL("listFieldHeader_".$fN,"[".$fN."]");
			break;
		}
	}
	
	/**
	 * [Put your description here]
	 */
	function getFieldHeader_sortLink($fN)	{
		return $this->pi_linkTP_keepPIvars($this->getFieldHeader($fN),array("sort"=>$fN.":".($this->internal["descFlag"]?0:1)));
	}

	function tg_searchBox($tableParams='',$actionpage='')	{
			// Search box design:
		
		if ($actionpage!=''){
			$actionp= 'index.php?id='.$actionpage;
		}else{
			$actionp= htmlspecialchars(t3lib_div::getIndpEnv('REQUEST_URI'));
		}
		
		$optionCatList = '<option value="-1">&nbsp;</option>';
		foreach($this->catComplete as $key => $value){
			($key == $this->piVars['scat']) ? $optionCatList .= '<option value="'.$key.'" selected>'.$value.'</option>' : $optionCatList .= '<option value="'.$key.'">'.$value.'</option>' ;
		}
		
		$optionLocList = '<option value="-1">&nbsp;</option>';
		foreach($this->locComplete as $key => $value){
			($key == $this->piVars['sloc']) ? $optionLocList .= '<option value="'.$key.'" selected>'.$value.'</option>' : $optionLocList .= '<option value="'.$key.'">'.$value.'</option>' ;
		}
		
		$sTables = '<div'.$this->pi_classParam('searchbox').'><form action="'.$actionp.'" method="post"><input type="hidden" name="no_cache" value="0" /><label for="'.$this->prefixId.'[scat]">'.$this->pi_getLL("pi_list_searchBox_activity","Activity").'</label> <select id="'.$this->prefixId.'[scat]" name="'.$this->prefixId.'[scat]">'.$optionCatList.'</select>&nbsp;&nbsp;&nbsp;<label for="'.$this->prefixId.'[sloc]">'.$this->pi_getLL("pi_list_searchBox_locality","Locality").'</label> <select id="'.$this->prefixId.'[sloc]" name="'.$this->prefixId.'[sloc]">'.$optionLocList.'</select><br><label for="'.$this->prefixId.'[sword]">'.$this->pi_getLL("pi_list_searchBox_key","Key").'</label> <input id="'.$this->prefixId.'[sword]" type="text" name="'.$this->prefixId.'[sword]" value="'.htmlspecialchars($this->piVars['sword']).'"'.$this->pi_classParam('searchbox-sword').' />&nbsp;<input type="submit" value="'.htmlspecialchars($this->pi_getLL('pi_list_searchBox_search','Search')).'"'.$this->pi_classParam('searchbox-button').' /></form></div>';
		return $sTables;
	}

	function tg_makesearchquery($searchWord='',$searchCat=-1,$searchLoc=-1,$count=0,$orderby=''){
		($count==0) ? $sQuery = 'SELECT tx_travelguide_main.* ' : $sQuery = 'SELECT count(*) ';		
		$sQuery .= 'FROM tx_travelguide_main WHERE NOT tx_travelguide_main.deleted AND NOT tx_travelguide_main.hidden AND ';
		($searchCat==-1) ? $sQuery .=' ' : $sQuery .='cat='.$searchCat.' AND ';
		($searchLoc==-1) ? $sQuery .=' ' : $sQuery .='place='.$searchLoc.' AND ';
		($searchWord!='') ? $sQuery .= '(tx_travelguide_main.name LIKE "%'.$searchWord.'%" OR tx_travelguide_main.par1 LIKE "%'.$searchWord.'%" OR tx_travelguide_main.par2 LIKE "%'.$searchWord.'%" OR tx_travelguide_main.par3 LIKE "%'.$searchWord.'%" OR tx_travelguide_main.par4 LIKE "%'.$searchWord.'%" OR tx_travelguide_main.par5 LIKE "%'.$searchWord.'%") '.$orderby : $sQuery .= ' 1=1 '.$orderby;
		//echo $sQuery;
		return $sQuery;
	}
}


if (defined("TYPO3_MODE") && $TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/travelguide/pi1/class.tx_travelguide_pi1.php"])	{
	include_once($TYPO3_CONF_VARS[TYPO3_MODE]["XCLASS"]["ext/travelguide/pi1/class.tx_travelguide_pi1.php"]);
}

?>