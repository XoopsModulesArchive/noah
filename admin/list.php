<?php
// $Id: list.php,v 1.1 2006/03/10 17:15:55 mikhail Exp $
//  ------------------------------------------------------------------------ //
//                No-Ah - PHP Content Architecture Stem                      //
//                    Copyright (c) 2004 KERKNESS.C                          //
//                       <http://noah.tetrasi.com/>                          //
//                          A XOOPS.org Module                               //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Ryan Mayberry AKA (fatman / kerkness)                             //
// URL: http://noah.tetrasi.com/                                             //   
// Thanks: To everyone at xoops.org, dev,xoops and all No-Ah developers      //
// Project: The No-Ah Project                                                //
// ------------------------------------------------------------------------- //


/**
* NoAh Admin Index 
* 
* main index file for NoAh control panel. 
*
* @author		fatman < noah.kerkness.ca >
* @version		0.8
* @package		NoAh
*/

include("admin.header.php");
include(MOD_PATH."/admin/noah_cptabs.php");

/**
* used to hold all page data that is collected for display
* @var	array $post	
*/
$page = array();

/**
* stands for option and is used to hold the requested NoAh Group name
* @var	string $op		
*/
$op = 'sysgroups';

/**
* stands for 'page function' and is used to hold requested view type 
* @var	string $pfunc	
*/
$pfunc = 'list';

/**
* used to hold an array of submitted data to the page
* @var	array $post	
*/
$post = array();
$posterror = false;


/**
* If $_Get vars are present check for page vars
*/
if ( isset( $_GET ) )
{
	if ( isset( $_GET['op'] ))
		$op = $_GET['op'];
	if ( isset( $_GET['pfunc'] ))
		$pfunc = $_GET['pfunc'];
	if ( isset( $_GET['rel'] ))
		$rel = $_GET['rel'];
	if ( isset( $_GET['id'] ))
		$itemid = $_GET['id'];
	if ( isset( $_GET['sortby'] ))
		$sortby = $_GET['sortby'];
	if ( isset( $_GET['sortdir'] ))
		$sortdir = $_GET['sortdir'];
	if ( isset( $_GET['p'] )){ 
		$p = $_GET['p']; 
	} else {
		$p = 1;
	}
}

/**
* If $_POST vars are present check for page vars
* This should follow collection of $_GET vars as
* POST vars take priority
*/
if ( isset( $_POST ) )
{
	if ( isset( $_POST['op'] ))
		$op = $_POST['op'];
	if ( isset( $_POST['pfunc'] ))
		$pfunc = $_POST['pfunc'];
	if ( isset( $_POST['rel'] ))
		$rel = $_POST['rel'];
	if ( isset( $_POST['itemid'] ))
		$itemid = $_POST['itemid'];
	if( isset( $_POST ))
		$post = $_POST;

}

/**
* Set up our admin tabs
*/
$mainTabs->setCurrent('content', 'tabs');

if ( $op == 'pages' ){
$mainTabs->setCurrent('pages', 'tabs');
}
if ( $op == 'sitelists' || $op == 'sitevalues' ){
$mainTabs->setCurrent('sitelists', 'tabs');
}
if ( $op == 'sysprefs' || $op == 'sysprefvalues' ){
$mainTabs->setCurrent('sysprefs', 'tabs');
}


$mainTabs->addSub('search', 'search.php?op='.$op, '['._NA_SEARCH.']', 55, $mainTabs->getCurrent() );

// ********************************************************* admin smarty start
global $xoopsModule;
xoops_cp_header();

 require_once XOOPS_ROOT_PATH.'/class/template.php';
 if ( !isset($xoopsTpl) ) { // Just in case, for new releases    
  $xoopsTpl = new XoopsTpl();
  $oldsystem = true;
 }else $oldsystem = false;

 $xoopsOption['template_main'] = 'admin/admin.html'; // To be compatible with existing system.
// ********************************************************* admin smarty start

$noAh = new NoAhPage( $op );

if ( isset($sortby) && isset($sortdir) ) {
    $noAh->setSort($sortby, $sortdir);
}
if ( $pfunc == 'search' ) {
    $noAh->addFilterArray( $_POST );
}

$page = $noAh->getListData( $p );



 /* Check to see if a sub processing script is assing and include if it is */
 if ( $page['info']['sub_processor'] && is_file(MOD_PATH.'/page/'.$page['info']['sub_processor']) ) {
       include( MOD_PATH.'/page/'.$page['info']['sub_processor']);
 }



	/**
	* Making use of NoAh database discovery feature
	*
	* NoAh provides the ability to generate the NoAhGroup
	* and NoAh field settings for any table already in your
	* database. 
	*
	* Only provide these features from the sysgroups
	*
	*/
	if ( $op == 'sysgroups' )
	{
		include_once( $mod_path.'/include/database_discovery.php' );
		$missinggroups = findMissingGroups( $noAh->group['table_name'], $noAh->group['field'] );
		
		if ( $missinggroups )
		$page['missinggroups'] = $missinggroups;
	}

	// if filters are on, show clear search button
   if ($page['info']['filter_on']) {
       $mainTabs->addSub('search', 'search.php?op='.$op, '['._NA_NEW_SEARCH.']', 55, $mainTabs->getCurrent() );
       $mainTabs->addSub('clsearch', 'search.php?op='.$op.'&pfunc=clear', '['._NA_CLEAR_SEARCH.']', 55, $mainTabs->getCurrent() );
   }
	
   // get our page title before assinging template
	$page['title'] = $noAh->getPageTitle();



// assign our page data to template
if ( isset( $page ) )
{
	$xoopsTpl->assign('page', $page);
}

	$xoopsTpl->assign( 'tabs', $mainTabs->getSet() );
// ********************************************************* admin smarty close
global $xoopsModule;
$xoopsTpl->assign('mod_dir', $xoopsModule->dirname() );

 if ($oldsystem) { // Don't execute if newer versions has smarty implemented.
  if (isset($xoopsOption['template_main'])) {
   $xoopsTpl->xoops_setCaching(0);
   $xoopsTpl->display('db:'.$xoopsOption['template_main']);
  }
 }
xoops_cp_footer();
// ********************************************************* admin smarty close



?>