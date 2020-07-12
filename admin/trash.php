<?php
// $Id: trash.php,v 1.1 2006/03/10 17:15:55 mikhail Exp $
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

* will be set to true if delete confirmation is recieved.

* @var	boolean $confirm	

*/

$confirm = false;



/**

* used to hold an array of submitted data to the page

* @var	array $post	

*/

$post = array();

$res = 0;  // results of a submitted post



/**

* used to pass the name of a field which should have a

* set value and what that set value should be

* $var	array $lock

*/

$lock = array( 'field' => '', 'value' => '');



/**

* If $_Get vars are present check for page vars

*/

if ( isset( $_GET ) )

{

	if ( isset( $_GET['op'] ))

		$op = $_GET['op'];

	if ( isset( $_GET['id'] ))

		$itemid = $_GET['id'];

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

	if ( isset( $_POST['itemid'] ))

		$itemid = $_POST['itemid'];

	if ( isset( $_POST['confirm'] ))

		$confirm = true;

	

}



$noAh = new NoAhPage( $op );





// delete item if confirm = false nothing will happen 

// but we use the if to be on the safe side

if ( $confirm )

$res = $noAh->deleteItem( $op, $itemid, $confirm );





if( $res == 1 )

{

	$redirstr = XOOPS_URL."/modules/".$xoopsModule->dirname()."/admin/list.php?op=$op";

	redirect_header($redirstr, 2, $noAh->group['group_label']." Item # $itemid<br /> "._NA_DELETE_SUCCESS );

}





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





if ( ! $res )

{

	$page = $noAh->itemDetails( $itemid );

	$page['confirm_trash'] = _NA_TRASH_CONFIRM_NOTICE."<br />

		Item $id from ".$page['info']['group_label']."";

	

	$conform = new XoopsSimpleForm('', 'conform', 'trash.php', 'POST');

	$conform->addElement( new XoopsFormHidden( 'confirm', 1) );

	$conform->addElement( new XoopsFormHidden( 'op', $op) );

	$conform->addElement( new XoopsFormHidden( 'itemid', $id) );

	$conform->addElement( new XoopsFormButton( '', 'submit', _NA_TRASH_CONFIRM_BUTTON, 'submit') );

	$conform->assignByName( $xoopsTpl );

	

	// get our page title before assinging template

	$page['title'] = $noAh->getPageTitle();

	

	// assign our page data to template

	if ( isset( $page ) )

	{

		$xoopsTpl->assign('page', $page);

	}

}





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