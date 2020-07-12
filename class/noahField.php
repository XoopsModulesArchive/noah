<?php
// $Id: noahField.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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


	class NoAhField extends NoAhPage
	{

		function NoAhField()
		{
		}
		
		/**
		* returns an array of field data
		*
		* Field data contains information on handling
		* individual requirements for group data
		*
		* @param	group id
		* @returns	array of group fields and there requirements
		*/
		function getFields( $id )
		{
		$ret = array();

			$sql = "SELECT * FROM ".$this->db->prefix('noah_sysfield')."
				WHERE groupid = $id ORDER BY fieldweight, fieldlabel ASC";
			if (! $res = $this->db->query($sql))
				echo( $this->db->error() . "<br /> $sql");
			$n = 0;
			while( $row = $this->db->fetchArray($res))
			{
				foreach ( $row as $k=>$v )
				{
					if( $v )
					$ret[$n][$k] = $v;
				}
			$n++;
			}
			
			// loop through fields and add relation info if one
			foreach ( $ret as $k=>$field )
			{
				if ( $field['fieldtype'] == 'select' || $field['fieldtype'] == 'syslist' || $field['fieldtype'] == 'site_list'  ) 
				$ret[$k]['relation'] =& NoAhField::fieldReplationships( $field['fieldid'] );
			}
			
		return $ret;
		}
		
		
		/**
		* get the name of the primary field of a group
		*
		* @param	group id
		* @return	primary field name
		*/
		function getPrimaryField( $id )
		{
		$ret = array();
			$sql = "SELECT db_field FROM ".$this->db->prefix('noah_sysfield')."
				WHERE groupid = $id AND is_prim = 1 LIMIT 1" ;
			if ( ! $res = $this->db->query($sql) )
				echo( $this->db->error() );
			
			$ret = $this->db->fetchRow($res);
		return $ret[0];
		}
		
		/**
		* @return	array	default values for our group's fields
		*/
		function getFieldDefaults()
		{
		$defaults = array();
			foreach ( $this->group['field'] as $key=>$field )
			{
				if ( isset($field['fielddefault']) )
				$defaults[$field['db_field']] = $field['fielddefault'];
			}
		return $defaults;
		}
		
		/**
		* returns an array of related field data
		*
		* Related fields are found by looking over
		* field type and field options for individual fields
		* the data returned can be used assist in building
		* select statements and relation views
		*
		* @param	array of group fields
		* @returns	array of related fields
		*/
		function fieldReplationships( $id )
		{
		$rel = array();
				$sql = "SELECT * FROM ".$this->db->prefix('noah_relation')."
					WHERE fieldid = $id LIMIT 1";
				
				if ( $res = $this->db->query($sql))
				{
					$rel = $this->db->fetchArray($res);
				}
				
        //        print_r($rel);

				$rel['sel_name'] =& NoAhField::relationSelectName( $rel );

		return $rel; 
		}
		
		/**
		* @param	results from fieldRelationships
		* @return	name of field to use in select statement
		*/
		function relationSelectName( $rel )
		{
		  $sel_name = '';

			switch ( $rel['relationtype'] )
			{
				case 'join':
					$sel_name = $this->db->prefix( $rel['jn_table'] ).'.'.$rel['jn_display'];
				break;
                case 'syslist':
					$listname =& NoAhCommon::syslistName( $rel['listid'] );
					$sel_name = $listname;
				break;
                case 'sitelist':
                    $listname =& NoAhCommon::syslistName( $rel['sitelistid'], $sitelist=true );
                    $sel_name = $listname;
                break;
			}	
					
		return $sel_name;
		}

		
	} // END CLASS
	

?>