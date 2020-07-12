<?php
// $Id: noahSitePage.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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
	* NoAhPage Class File  
	* 
	* NoAhPage is the no-ah master class file, it provides
	* access methods from the NoAh sub classes. 
	*
	* @author		fatman < noah.kerkness.ca >
	* @version		0.8
	* @package		NoAh
	*/
	class NoAhSitePage extends NoAhPage
	{

		function NoAhSitePage()
		{
		}
		
		/**
		* provides an array of details from a noah pages record
		* @param	string $navname name of requested page
		* @return	array
		*/
		function getPageDetails( $navname )
		{
			$table = $this->db->prefix('noah_page');
			$sql = "SELECT * FROM $table WHERE nav_name = '$navname'";
			
			if( ! $res = $this->db->query($sql))
				echo( $this->db->error()."getPageDetails : <br/>$sql<br/>");
				
			$details = $this->db->fetchArray($res);
			
			// set our page title
			$this->setPageTitle( $details['page_title'] );

            //set the full link to page
            if ( isset($details['usessl']) && $details['usessl'] == 1 ) {
                $basehref = str_replace('http://', 'https://', XOOPS_URL);
            } else {
                $basehref = XOOPS_URL;
            }
            $details['basehref'] = $basehref;
			
			return $details;
		}
		
		
	} 
?>