<?php
// $Id: noah_cptabs.php,v 1.1 2006/03/10 17:15:55 mikhail Exp $
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








/* set up our main tabs */

$mainTabs = new XoopsTabs();



// tab for main index

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/';

$mainTabs->addTab( 'index', $link, _NA_MAINMENU_CONTENT_INDEX, 0 );



// tab for content groups

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/list.php?op=sysgroups';

$mainTabs->addTab( 'content', $link, _NA_MAINMENU_CONTENT_GROUPS, 10 );



// add sub links to content groups

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/form.php?op=sysgroups&pfunc=add';

$mainTabs->addSub( 'new', $link, _NA_NEW_CONTENT_GROUP, 20, 'content');



// add sub links to content groups

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/list.php?op=sysgroups';

$mainTabs->addSub( 'list', $link, _NA_LIST_CONTENT_GROUPS, 20, 'content');











// tab for pages

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/list.php?op=pages';

$mainTabs->addTab( 'pages', $link, _NA_MAINMENU_PAGES, 20 );



// Sub tab for pages

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/form.php?op=pages&pfunc=add';

$mainTabs->addSub( 'new', $link, _NA_NEW_PAGE, 10, 'pages' );



// Sub tab for pages

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/list.php?op=pages';

$mainTabs->addSub( 'list', $link, _NA_LIST_PAGES, 20, 'pages' );



// tab for site lists

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/list.php?op=sitelists';

$mainTabs->addTab( 'sitelists', $link, _NA_MAINMENU_LISTS, 30 );



// Sub tab for pages

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/form.php?op=sitelists&pfunc=add';

$mainTabs->addSub( 'new', $link, _NA_NEW_LIST, 10, 'sitelists' );



// Sub tab for pages

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/list.php?op=sitelists';

$mainTabs->addSub( 'list', $link, _NA_LIST_LISTS, 20, 'sitelists' );



// tab for sysprefs

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/list.php?op=sysprefs';

$mainTabs->addTab( 'sysprefs', $link, _NA_MAINMENU_PREFS, 40 );



// Sub tab for sysprefs

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/form.php?op=sysprefs&pfunc=add';

$mainTabs->addSub( 'new', $link, _NA_NEW_PREFERENCE_SET, 10, 'sysprefs' );



// Sub tab for sysprefs

$link = XOOPS_URL.'/modules/'.$xoopsModule->dirname().'/admin/list.php?op=sysprefs';

$mainTabs->addSub( 'list', $link, _NA_LIST_PREFERENCE_SETS, 20, 'sysprefs' );







?>

