<?php
// $Id: noahGroup.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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


	class NoAhGroup extends NoAhPage
	{

		/**
		* class constructor for NoAhGroup
		* NoAhGroup contains all functions associated with
		* no-ah groups. Methods will generally accept 
		* the name of a group or groupid and provide in return
		* information about the group
		*/
		function NoAhGroup()
		{
		}
		
		/**
		* get complete group details array
		* 
		* Used to gather a complete array of data
		* that can be used to manage this group in 
		* in other php classes, or pages. All details
		* about display and validation requirements
		* for group as a whole and it's individual fields
		* is returned.
		*
		* @param	group name
		* @return	complete array of info about group
		*/
		function groupDetails()
		{
			$res = $this->groupSummary();

			// add field info to group details
			$res['field'] =& NoAhField::getFields( $res['groupid'] );
			
		return $res;
		}
		
		function countItems()
		{
			$table = $this->db->prefix($this->group['table_name']);
			$sql = "SELECT COUNT(*) FROM $table";
			if( ! $res = $this->db->query($sql))
				echo( $this->db->error()."<br/> $sql <br/>");
			$count = $this->db->fetchRow($res);
		return $count[0];
		}


		/**
		* returns a summary of group information
		*/
		function groupSummary()
		{
			$sql = "SELECT * FROM ".$this->db->prefix('noah_sysgroup')."
				WHERE group_name = '".$this->group['group_name']."' LIMIT 1";
			
			if ( ! $result = $this->db->query($sql) )
				echo( $this->db->error()." <br /> $sql");
			
			$res = $this->db->fetchArray($result);

			// add count for all list fields
			$res['lf_count'] =& NoAhList::fieldCount( $res['groupid'] );
			$res['f_count'] =& NoAhGroup::fieldCount( $res['groupid'] );
			
			// add name of primary field
			$res['prime'] =& NoAhField::getPrimaryField( $res['groupid'] ); 

		return $res;
		}
		
		/**
		* @paran	int	$id  key for a NoAhGroup
		* @return	string
		*/
		function groupNameFromId( $id )
		{
			$sql = "SELECT group_name FROM ".$this->db->prefix('noah_sysgroup')."
				WHERE groupid = $id";
			
			if( ! $res = $this->db->query($sql) )
				echo( $this->db->error()." <br /> $sql " );

			$name = $this->db->fetchRow($res);

		return $name[0];
		}
		
		/**
		* counts the fields assigned to supplied group
		* 
		* @param 	groupid
		* @return	total number of fields assigned to group
		*/ 
		function fieldCount( $id )
		{
			$sql = "SELECT COUNT(*) FROM ".$this->db->prefix('noah_sysfield')."
				WHERE groupid = $id ";
			$res = $this->db->fetchRow($this->db->query($sql));
		return $res[0];
		}

		
		function deleteItem( $op, $id, $confirm=false )
		{
			if( ! isset($confirm))
			{
			echo('confirm not provided');
				return 0;
			}
			if( ! $confirm )
			{
			echo('confirm false');
				return 0;
			}
			
			$table = $this->db->prefix( $this->group['table_name'] );
			$prime = $this->group['prime'];
			
			$sql = "DELETE FROM $table WHERE $prime = $id";
			
			if( ! $res = $this->db->query($sql) )
			{
	 			echo( $this->db->error()) ;
				return 0;	
			}
			
			// if we are confirming the deletion of a system
			// group we need to trash all sysfields in this group
			if ( $op == 'sysgroups' && $confirm )
			{
				$table = $this->db->prefix('noah_sysfield');
				$sql = "DELETE FROM $table WHERE groupid = $id";
				if( ! $res = $this->db->query($sql) )
				 echo( 'ERROR Deleting Fields '.$this->db->error());
			}
			
		return 1;
		}
		
		function itemDetails( $id )
		{

			// $ginfo = $this->groupDetails($group);
			$table = $this->db->prefix( $this->group['table_name'] );
			$prime = $this->group['prime'];
			$data['info'] = $this->getListInfo();
			$data['info'] = $this->groupSummary();
			$data['info']['itemid'] = $id;

			$sql = $this->getSQL('item');

			$sql .= " WHERE $table.$prime = '$id'";
			if ( ! $res = $this->db->query($sql))
				echo( $this->db->error()."<br/> $sql ");

			$data['item'] = $this->db->fetchArray($res);
			$data['relation'] = NoAhGroup::getRelationLinks( $data['item'] );
			
			if( isset($data['item']['detail_tpl']) )
			{
				if( $data['item']['detail_tpl'] )
				$data['item']['detail_tpl'] = 'db:item/'.$data['item']['detail_tpl'];
			}

		//	print '<pre>';
		//	print_r($ginfo);
		//	print '</pre>';

		return $data;
		}
		
		
		/**
		* get links to related groups
		*
		* returns data that can be used to display links to
		* content groups which have relationships with the
		* current group being managed.
		*
		* @param	results from groupDetails
		* @return	array of groups with relationships	
		*/
		function getRelationLinks( $item )
		{
			$rel = array();
			$sets = NoAhGroup::getRelationSets();
			
			$n=0;
			foreach ( $sets as $set )
			{
				$id = $set['fieldid'];
				$sql = "SELECT groupid FROM ".$this->db->prefix('noah_sysfield')."
					WHERE fieldid = $id";
				if( ! $res = $this->db->query($sql) )
					echo( $this->db->error()." <br /> $sql" );
				
				$row = $this->db->fetchRow($res);
				$groupid = $row[0]; 
			
				$sql = "SELECT * FROM 
					".$this->db->prefix('noah_sysgroup')." WHERE 
					groupid = $groupid";
					
				if( ! $res = $this->db->query($sql) )
					echo( $this->db->error()." <br /> $sql" );
				
				$row = $this->db->fetchArray($res); 
				
				$fullset = array_merge_recursive($set, $row);
				
				$rel[$n] = $fullset;
				
				$rel[$n]['match_value'] = $item[$rel[$n]['jn_field']];

			$n++;
			}
			
		return $rel;	
		}
		
		/**
		* find relationships with provided groups
		*
		* @param	results from groupDetails
		* @return	array of noah_relation records which link to the group	
		*/
		function getRelationSets()
		{
		$rel = array();
			// loop through fields to find prime fieldid
			foreach ( $this->group['field'] as $k=>$field )
			{
				if ( $field['db_field'] == $this->group['prime'] )
				{	
					$id = $field['fieldid'];
					break;
				}
			}
			
			// create sql statement to look for relationships
			$sql = "SELECT * FROM ".$this->db->prefix('noah_relation')."
				WHERE relationtype = 'join' AND jn_table = '".$this->group['table_name']."' ";
			
			if ( ! $res = $this->db->query($sql))
				echo( $this->db->error()." <br /> $sql ");
				
			while( $row = $this->db->fetchArray($res) )
			{
				$rel[] = $row;
			}
			
		return $rel;			
		}
		
		/**
		* @param	int	$id	sets the id of the requested relationship
		*/
		function getRelationInfo( $id )
		{
			$sql = "SELECT * FROM ".$this->db->prefix('noah_relation')."
				WHERE relationid = $id";
				
			if ( ! $res = $this->db->query($sql))
				echo( $this->db->error()."<br/>$sql<br/>");

			$info = $this->db->fetchArray($res);
			
			return $info;
		}
		
		
	}
	

?>