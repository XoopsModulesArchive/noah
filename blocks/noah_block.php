<?php
// $Id: noah_block.php,v 1.1 2006/03/10 17:15:55 mikhail Exp $
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

 * NoAhMenuBlock renders a navigation menu to NoAhPages

 */

function NoAhMenuBlock( $options )

{

   global $xoopsUser; $xoopsDB; $xoopsConfig;

   require_once( XOOPS_ROOT_PATH.'/modules/noah/class/noahloader.php');

   $block = array();



   $noAh = new NoAhPage('pages');



   $noAh->setSortBy('page_weight');

   $noAh->setSortDir('ASC');



   $mypages = $noAh->getListData();





   foreach( $mypages['list'] as $k=>$page)

   {

      if ($page['page_shownav'] == 1) {

          $block['page'][$k] = $page;



          /* Set up the link for the page */

          if ( $page['page_types'] == 'content_page' ) {

              

              if ( $page['usessl'] ) {

                  $linkbase = str_replace('http://','https://', XOOPS_URL);

                  } else {

                  $linkbase = XOOPS_URL;

                }

              

              $link = $linkbase.'/modules/noah/page.php?navname='.$page['nav_name'];

              $block['page'][$k]['link'] = $link;

          }

      }

   }



   if ( $xoopsUser ) {

       $logout['page_label'] = _NA_BLOCK_LOGOUT_LABEL;

       $logout['link'] = XOOPS_URL.'/user.php?op=logout';

       $logout['page_weight'] = 99;

       $block['page'][] = $logout;

   }



   return $block;

}





?>

