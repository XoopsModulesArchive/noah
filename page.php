<?php
// $Id: page.php,v 1.1 2006/03/10 17:16:16 mikhail Exp $
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
 

//***************************************************
// Page Header 
//***************************************************

// Include the module header file initating mainfile
require( 'header.php' );
     
// We must always set our main template before including the header 
$xoopsOption['template_main'] = 'page.html'; 

// Include the page header 
include(XOOPS_ROOT_PATH.'/header.php');

//***************************************************
// Initiate page variables
//***************************************************

/**
* @var	string	$navname	defines the name of requested page
*/
$navname = 'sample';

/**
* check $_GET for a requested navname
*/
if ( isset($_GET['navname']))
 $navname = $_GET['navname'];

/**
* check $_post for a requested navname
*/
if ( isset($_POST['navname']))
 $navname = $_POST['navname'];


//***************************************************
// Execute page functionality
//***************************************************

$myPage = new NoAhPage('pages');


// load page details into local variable and also assign 
// to page output array
$pageinfo = $myPage->getPageDetails($navname);

//assing navname to page output
$page['navname'] = $pageinfo['nav_name'];

// Grab our page title
$page['title'] = $myPage->getPageTitle();

// if a page template is provided assign the to page array
if ( isset($pageinfo['page_template']))
{
	$xoopsTpl->assign('pagetpl', $pageinfo['page_template']);	
	$page['tpl'] = $pageinfo['page_template'];
}

// if page has a custom script include it here
if ( $pageinfo['page_script'] )
{
	// assing script name to page output
	$page['script'] = $pageinfo['page_script'];
    $scriptpath = MOD_PATH . '/page/'.$pageinfo['page_script'];
    // echo("getting file $scriptpath <br/>");
    require_once( $scriptpath );

} 

if ( $pageinfo['bid'] ) {

	/**
     * Load block content from database
     */
    $sql = "SELECT content FROM ".$xoopsDB->prefix('newblocks')." WHERE bid = ".$pageinfo['bid'];
    
    $res = $xoopsDB->query($sql);
    $row = $xoopsDB->fetchArray($res);

    $page['block_content'] = $row['content'];

}


// echo "<pre>";
// print_r ($page);
// print_r ($pageinfo);
// echo "</pre>";



//***************************************************
// Finalize page // Assign output to smarty
//***************************************************

// Assign page details to template
$xoopsTpl->assign('page', $page );
$xoopsTpl->assign('mod_dir', $xoopsModule->dirname() );

// Include the page footer 
include(XOOPS_ROOT_PATH.'/footer.php');
?>