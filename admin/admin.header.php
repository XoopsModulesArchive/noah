<?php
// $Id: admin.header.php,v 1.1 2006/03/10 17:15:55 mikhail Exp $
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

require('../../../mainfile.php'); 
include(XOOPS_ROOT_PATH."/include/cp_header.php");
global $xoopsModule;

$mod_path = XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname();

define('MOD_PATH', XOOPS_ROOT_PATH.'/modules/'.$xoopsModule->dirname());

define('MOD_DIR', $xoopsModule->dirname());


include(XOOPS_ROOT_PATH."/class/xoopsformloader.php");
include(MOD_PATH.'/class/tabs.php');
include(MOD_PATH.'/class/noahloader.php');

require_once(MOD_PATH.'/class/formtimestamp.php');

?>