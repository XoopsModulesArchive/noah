<?php
// $Id: noahTableConsume.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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


	class NoAhTableConsume extends NoAhPage
	{

		/**
		* class constructor for NoAhTableConsume
		* NoAhTableConsume contains all functions associated with
		* creating a new NoAhGroup from an existing db table
		*/
		function NoAhTableConsume()
		{
		}
		
		
		function tableConsume ( $id )
		{
		
			$table_name = NoAhTableConsume::getTableNameFromId( $id );
			
			if ( $this->showVerbose() )
			echo(": looking for fields in table $table_name <br />");
			

			// check to see if table has been created or not
			if ( $istable = NoAhDbDiscovery::checkForTable( $table_name ) )
			{
				$prime = NoAhDbDiscovery::getTablePrimary($table_name);
				if ( $this->showVerbose() )
				echo(": Table found primary field set as $prime<br />");
			} else {
				if ( $this->showVerbose() )
				echo(": Table not found, creating table $table_name<br />");
				NoAhTableConsume::createTable( $table_name );
				$prime = NoAhDbDiscovery::getTablePrimary( $table_name );
				if ( $this->showVerbose() )
				echo(": Table created, setting prime as $prime<br />");
			}
						
			$addprime = NoAhTableConsume::addPrimeField( $id, $prime );

			if ( $this->showVerbose() )
			echo(": added primary field info to NoAh Fields <br />");

			if ( $this->showVerbose() )
			echo(": looking for more fields in table $table_name <br />");
			
			// get a list of fields in this table
			$table_fields = NoAhDbDiscovery::listFields( $table_name );
	
	
			foreach ( $table_fields as $field )
			{
				NoAhTableConsume::addTableFieldToNoah( $field, $id );
			}
	
		return ;
		}
		
		function addTableFieldToNoah ( $field, $id )
		{
			global $xoopsDB;
			
			// We certainly don't want to add duplicate fields
			// so let's check to make sure this field is not already
			// added to this group.
			$sql = "SELECT COUNT(*) FROM ".$xoopsDB->prefix('noah_sysfield');
			$sql .= " WHERE db_field = '$field' AND groupid = '$id'";
			$result = $xoopsDB->fetchRow($xoopsDB->query($sql));

			if ( $result[0] > 0 )
			{
				if ( $this->showVerbose() )
				echo(": ".$field.' already added, skipping <br />');
				return;
			}
			
			$sql = "INSERT INTO ".$xoopsDB->prefix('noah_sysfield');
			$sql .= " SET db_field = '$field', fieldlabel = '$field', fieldtype = 'text', ";
			$sql .= "field_options = '30|255', fieldweight='50', db_class = 'var', show_list = 1, show_form = 1, ";
			$sql .= "groupid = '$id'";
			
			if ( ! $result = $xoopsDB->query($sql) )
				echo( $this->db->error()." <br/> $sql <br/>");
				
			$newid = $this->db->getInsertId();
	
			if ( $this->showVerbose() && $result )
			echo(": ".$field.' info updated to NoAh Fields <br />');
		
		return $result;
		}
		
		
		function getTableNameFromId( $id )
		{
			// quickly get table name of group
			$sql = "SELECT table_name FROM ".$this->db->prefix('noah_sysgroup')." WHERE 
				groupid = $id";
			if( ! $res = $this->db->query($sql))
				echo( $this->db->error()."<br /> $sql <br /> " );
			
			$row = $this->db->fetchRow($res);
			
			$table_name = $row[0];

		return $table_name;
		}
		
		function createTable( $table )
		{
			$prime = $table."id";
			$table_name = $this->db->prefix($table);
			$prime = str_replace('_', '', $prime );
			$prime = str_replace('noah', '', $prime );
			
			$sql = "CREATE TABLE $table_name (
				$prime INT NOT NULL AUTO_INCREMENT ,
				UNIQUE ( $prime )
				)";

			if( ! $res = $this->db->query($sql))
				echo( $this->db->error()."<br /> $sql <br /> " );

		return $res;
		}
		
		function addPrimeField( $id, $prime )
		{
			$sql = "INSERT INTO ".$this->db->prefix('noah_sysfield');
			$sql .= " SET 
				db_field = '$prime', is_prim = 1, fieldlabel = 'ID',
				show_form = 0, show_list = 0, show_search = 0,
				fieldtype = 'auto', db_class = 'int', groupid = $id";
			if( ! $res = $this->db->query($sql))
				echo( $this->db->error()."<br /> $sql <br /> " );

		}
		
		function fieldConsume( $id )
		{
			// quickly get the name of the db_field
			$sql = "SELECT * FROM ".$this->db->prefix('noah_sysfield')."
				WHERE fieldid = $id";
				
			if( ! $res = $this->db->query($sql))
				echo( $this->db->error()."<br /> $sql <br /> " );
		
			$field = $this->db->fetchArray($res);
						
			$res = NoAhTableConsume::createNoahField( $field );

		return $res;			
		}
		
		function createNoahField( $field )
		{

		$table_name = NoAhTableConsume::getTableNameFromId( $field['groupid'] );
		
		// check to see if field already exsists in db
		if( NoAhDbDiscovery::checkForFields( $field['db_field'], $table_name ))
			return;
		
		// create varchar 255 with default
		$sql = "ALTER TABLE `xoops_".$table_name."` ADD `".$field['db_field']."`";
		
		if ( $field['fieldtype'] == 'textarea' )
		{
		$sql .= " TEXT";
		} else {
		$sql .= " VARCHAR( 255 )";
		}
		
		if ( $field['fielddefault'] != '' )
		{
		$sql .= " DEFAULT '".$post['fielddefault']."'";
		}
		
		$sql .= ';';
		
		if ( ! $result = $this->db->query($sql) )
			echo( $this->db->error()."<br/> $sql <br/>");

		return $result;
		}
		
}
	

?>