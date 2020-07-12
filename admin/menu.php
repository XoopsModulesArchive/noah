<?php
// $Id: menu.php,v 1.1 2006/03/10 17:15:55 mikhail Exp $
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



$adminmenu[0]['title'] = _MI_NA_ADMIN_INDEX;
$adminmenu[0]['link'] = "admin/index.php";


$adminmenu[1]['title'] = _MI_NA_SYS_GROUPS;
$adminmenu[1]['link'] = "admin/list.php?op=sysgroups";


$adminmenu[3]['title'] = _MI_NA_SYS_RELATION;
$adminmenu[3]['link'] = "admin/list.php?op=relations";


$adminmenu[4]['title'] = _MI_NA_SYS_LISTS;
$adminmenu[4]['link'] = "admin/list.php?op=syslists";  

$adminmenu[5]['title'] = _MI_NA_PREFS;
$adminmenu[5]['link'] = "admin/list.php?op=sysprefs";

$adminmenu[9]['title'] = _MI_NA_PAGES;
$adminmenu[9]['link'] = "admin/list.php?op=pages";

//$adminmenu[4]['title'] = _MI_NA_SITE_LISTS;

//$adminmenu[0]['link'] = "admin/index.php?op=sitelists";



//$adminmenu[4]['title'] = _MI_NA_SITE_VALUES;

//$adminmenu[0]['link'] = "admin/index.php?op=sitevalues";



?>