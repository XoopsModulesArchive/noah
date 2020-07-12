<?php
// $Id: noahFormDirSelect.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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



class NoAhFormDirSelect extends NoAhForm
{

	function NoAhFormDirSelect()
	{
	}


	function makeDirSelect ( $id, $value, $options='', $field, &$form )
	{
	global $xoopsModule;
	
		// echo("Value for $id is $value<br />");
	
		// options 0 = listid
		// look for optional options
		foreach ( $options as $k=>$v )
		{
			if ( $v == 'dir' )
			{
				$this_dir = $options[$k+1];
			}
			if ( $v == 'allow_null' )
			{
				$allow_null = true;
			}
			if ( $v == 'search' )
			{
				$search = true;
			}
		}
		
		$dirname = XOOPS_ROOT_PATH."/modules/".$xoopsModule->dirname()."/".$this_dir;
		$dh = opendir( $dirname ) or die('failed opening the directory');
		
		while ( ! ( ( $file = readdir( $dh )) === false )) 
		{
			/**
			* make sure that the file found is NOT a dir
			* make sure the file does not match any default tempalte names
			* itemdefault.html, formdefault.html, listdefault.html
			*/
			if ( ! is_dir( $dirname.'/'.$file ) && 
				$file != 'itemdefault.html' &&
				$file != 'listdefault.html' &&
				$file != 'formdefault.html' )
			{
	//			echo($file);
				$myfiles[] = $file;
			}
		}
		closedir( $dh );
		
		// print_r($myfiles);

			if( $allow_null )
				$str[0] = '--'; 

            if ( isset($myfiles) )
            {
                foreach( $myfiles as $k=>$v )
                {
                    $str[$v] = $v;
                }
            }
            			if ( is_a( $form, 'XoopsFormElementTray' )){
			 $caption = '';
			 $id = $field['rowid']."_row[".$field['db_field']."]";
 			 } else {
			 $caption = $field['fieldlabel'];
			 $id = $field['db_field'];
			}
		
			$html = new XoopsFormSelect($caption, $id, $value, $size=1, $multiple=false);
			$html->addOptionArray($str);

			// assign any extras to the elemnt
			if( isset($field['extra']) )
			{
				$html->setExtra($field['extra']);
			}
			
			$form->addElement($html);
	
	return;	 
	} 

}



?>