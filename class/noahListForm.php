<?php
// $Id: noahListForm.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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


	class NoAhListForm extends NoAhPage
	{

		/**
		* Class constructor for NoAhListForm
		*/ 
		function NoAhListForm()
		{
		}
		


		function getListFormRow( &$tray, $row, $cols )
		{
			// pull field types from cols array
			foreach( $cols as $k=>$col )
			{
				if ( isset( $col['relation']) )
				{
					if( $col['relation']['sel_name'] != '' && $col['relation']['relationtype'] != 'join' ){
						$mycols[$col['relation']['sel_name']] = $col;
					} else {
						$mycols[$k] = $col;
					}
				} else {
					$mycols[$k] = $col;
				}
			}
	
			foreach( $row as $field=>$value ) 
			{
				NoAhListForm::addToTray( &$tray, $mycols, $row['rowid'], $field, $value );
			}
			
			$tray->addElement( new XoopsFormHidden( $row['rowid'].'_row[rowid]', $row['rowid'] ));
			
			
		}
		
		function addToTray( &$tray, $mycols, $rowid, $field, $value )
		{

			if ( isset($mycols[$field]['db_field']))
			$id = $rowid."_row[".$mycols[$field]['db_field']."]";

			if ( isset($mycols[$field]['fieldlabel']))
			$caption = '';

			if ( isset($mycols[$field]['fieldtype']))
			$type = $mycols[$field]['fieldtype'];
	
			if ( isset($mycols[$field]['field_options']))
			$options = explode('|', $mycols[$field]['field_options']);
			
									
			//add row id to mycols fields
			$mycols[$field]['rowid'] = $rowid;
			
			if (isset($type)){
			switch ( $type )
			{
				case "text":
				 if ( ! isset($options) )
				 	$options = array( 15, 255 );
				$html = new XoopsFormText($caption, $id, 15, $options[1], $value );
				break;
		
				case "password":
				$html = new XoopsFormPassword($caption, $id, $options[0], $options[1], $value);
				break;
		
				case "textarea":
				 if ( ! isset($options) )
				 	$options = array( 3, 30 );
				$html = new XoopsFormTextArea($caption, $id, $value, $options[0], $options[1]);
				break;
		
				case "checkbox": 
				$html = new XoopsFormCheckBox($caption, $id, $value );
				$html->addOption( 1, ' &nbsp;' ) ;
				break;

				case "select":
					// TODO: check to see if we need to lock an item
					foreach ( $options as $k=>$v )
					{
						if ( $v == 'lock' )
						{
							$locked = true;
							break;
						} else {
							$locked = false;
						}
					}
						// set our value to 
						$sql = "SELECT ".$mycols[$field]['relation']['jn_field']; 
						$sql .= " FROM ".$this->db->prefix($mycols[$field]['relation']['jn_table'])." 
							WHERE ".$mycols[$field]['relation']['jn_display']." = '".$value."'";
							
						// echo($sql);
						if ( ! $res = $this->db->query($sql))
							echo( $this->db->error()."<br/>$sql<br/>");
						$row = $this->db->fetchRow($res);
						$value = $row[0];

						NoAhForm::makeSelectField ( &$tray, $mycols[$field], $value );
				break;
		
				case "timestamp":
					if ( $options[0] == 'all')
					{
						$value = time();
					}
					$html = new XoopsFormTimestamp($fieldlabel, $id, $value);
				break;
				
				case "hidden":
					$html = new XoopsFormHidden( $id, $value );
				break;				
		
			// set up a field for picking template files.
				case "list_templates":
					$options[] = 'dir';
					$options[] = 'templates/list';
					$html = NoAhFormDirSelect::makeDirSelect ( $id, $value, $options, $mycols[$field], &$tray );
				break;
		
			// set up a field for picking template files.
				case "form_templates":
					$options[] = 'dir';
					$options[] = 'templates/form';
					$html = NoAhFormDirSelect::makeDirSelect ( $id, $value, $options, $mycols[$field], &$tray );
				break;
		
			// set up a field for picking template files.
				case "detail_templates":
					$options[] = 'dir';
					$options[] = 'templates/item';
					$value = str_replace('db:item/', '', $value);
					$html = NoAhFormDirSelect::makeDirSelect ( $id, $value, $options, $mycols[$field], &$tray );
				break;
		
			// set up a field for picking script files.
				case "page_scripts":
					$options[] = 'dir';
					$options[] = 'pages/';
					$html = NoAhFormDirSelect::makeDirSelect ( $id, $value, $options, $mycols[$field], &$tray);
				break;
				
			   // set up a system list select box
		 	 	case "syslist":
					$html = NoAhForm::makeSysList ( $mycols[$field], &$tray, $value );
				break; 
		
			}}
			
				if( isset($extra) )
				{
					$html->setExtra($extra);
				}
				if( isset($html))
				$res = $tray->addElement($html);

		return;
		}



	}


?>