<?php
// $Id: sample.php,v 1.2 2006/03/21 07:23:52 mikhail Exp $
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
* sample.php NoAh Sample custom PHP Page.
*
* This page serves as an example of a completely custom php
* page that was written for a NoAh content page. This example
* shows how to create dynamic content and make this available
* to a smarty template.
*
* Basic Instructions:
* 1: Create a php page using the source below as an example starting point
* 2: Upload your page to xoops_url/modules/noah/page/
* 3: Create or edit a SMARTY template to display your content
* 4: Upload SMARTY template to xoops_url/modules/noah/templates/page/
* 4: Create or edit a NoAh page to use your script and smarty template
*/  

/**
* Simple example assinging text string to page array
*/
$page['content']['txtstring'] = 'This is my sample txt string';

/**
* Simple example of assining current date to the page
*/
$page['content']['today'] = date('D, M g Y ', time());

/**
* write your own php functions and assing results to your page
*/
$page['content']['hello'] = sampleHelloWorld();

function sampleHelloWorld()
{
	return 'Hello World';
}

/**
* Example to show it's possible to access NoAh defined content
* This example opens a list of data from the NoAh content group 'syslist'
*/

/**
*  create instance of content group 'syslists'
*/
$noAh = new NoAhPage('syslists');

/**
* assing list data to php array	
*/
$myarray = $noAh->getListData();

/**
* asssing php array to smarty
*/
$xoopsTpl->assign( 'myarray', $myarray );

/**
*  release noAh object for next example
*/
unset($noAh);

/**
* Example to show it's possible to generate a form for NoAH content groups
* This example displays a form for the Content group 'pages'
*/
/**
* creates instance of content group 'pages'
*/
$noAh = new NoAhPage('pages');	

/**
* creates instance of xoops form, and set up form action parameters						
*/
$myForm = new XoopsSimpleForm( 'Form Title', 'sampleform', 'sample.php', 'POST' );	

/**
* assigns fields from NoAh content group to form
* optionally you can pass an array of values to populat the form with
*/
$noAh->getFormView(&$myForm, $values=array());	

/**
* If you have a need to add non-noah fields to your form you can
* The entire XoopsForm class is available to you. see Xoops wiki
* or xoopscube.org for more info on XoopsForms
* $myForm->addElement( new XoopsFormText('My Added Field', 'fieldname', '', 10. 30) );
*/

/**
* finalize form adds some required hidden fields and creates submit button
*/
$noAh->formFinalize(&$myForm);	

/**
* Assigns the form details to Smarty Template
*/
$myForm->assignByName($xoopsTpl);

/**
* release noAh object for next example
*/
unset($noAh);

?>
