<?php
// $Id: noahCommon.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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
	 * NoAhCommon, a multipurpose collection of methods for accessing noah content 
     * 
     * NoAhCommon contains a variety of methods used by
     * the other core No-Ah class files. Methods for filtering, and
     * manipulating data before a list view or form view are created
     * will be kept here.
     * 
     * @author      Fatman ( Kerkness ) noah.tetrasi.com
     * 
	 */		
	class NoAhCommon extends NoAhPage
	{

		/**
		* class constructor for NoAhCommon. Doesn't need called directly.
         * @returns void
		*/
		function NoAhCommon()
		{
		
		}
		
        /**
         * noahConfig provides an array of all noAh configurations
         * or if name of config group is provided we open just that group.
         * @param   string  $name   Name of the config value requested
         * @return  string
  		 */
		function noahConfig( $name='' )
		{
			$sql = "SELECT pref_value FROM ".$this->db->prefix('noah_prefvalue');
			
			if( $name != '' )
				$sql .= " WHERE pref_name = '$name'";
			
			$sql .= " ORDER BY prefgroupid, pref_name";
			
			if ( ! $res = $this->db->query( $sql ))
				echo( $this->db->error()." <br /> $sql "); 
			
			$conf = $this->db->fetchArray($res);	

		return $conf['pref_value'];		
		}

		/**
		* return sql statement for list view
		* 
		* Used to get a base SELECT statement specifically
		* for a list view.
		*
		* @param 	results from NoAhList getList
		* @return	string 
		*/ 
		function getSQL( $pfunc='list' )
		{
			$table = $this->db->prefix( $this->group['table_name'] );

			// start SELECT
			$sql = 'SELECT';
			$sql .= NoAhCommon::getSelectFields( $pfunc );
			$sql .= " FROM ";
			$sql .= NoAhCommon::getSelectTables( $pfunc );
			$sql .= " ";
								
		return $sql;
		} // end function getListSQL
		
		
        
        /**
         * Takes an array of filter settings and creates a SQL WHERE statement to append to any results
         * from NoAhCommon::getSQL()
         * @param   array   $array  an array of filter values   field=>value
         * @param   boolean $session_filter set to true to have the filter details saved for the session
         * @return  void
         */
        function addFilterArray( $array, $session_filter=false )
        {
          $fields = $this->group['field'];
          $table = $this->db->prefix($this->group['table_name']);
          $sql = ' WHERE ';
                 
              foreach( $fields as $field )
              {
                  //print_r( $field );
                  if ( isset($field['show_search']) && $field['show_search'] == 1 && $array[$field['db_field']] ) {
                     
                      $filter[$field['db_field']] = $array[$field['db_field']];
                  }
    
              }
              $n = 0;
              foreach ($filter as $field=>$value) {
                  $sql .= " $table.$field LIKE '$value%'";

                  if ( ($n+1) < (count($filter))) {
                      $sql .= ' AND';
                  }
              $n++;
              }
          
              $this->filter_str = $sql;

              if ($session_filter) {
               NoAhCommon::setFilterCookie($sql);
              }
        }

        
        /**
         * function takes all filter values that have been added with  addFilter and creates a SQL WHERE statement. 
         * This WHERE statement is appended to getSQL()
         * @param   boolean $session_filter set to true to have the filter details stored for the session
         */
        function setFilter($session_filter=false)
        {
            $n = 0;
            $sql = " WHERE ";
            foreach ($this->filter as $field=>$value) {
            
                $sql .= " $field = '$value'";
            
                if ( ($n+1) < (count($this->filter))) {
                    $sql .= ' AND';
                }
            
            $n++;
            }

            if ($session_filter) {
             NoAhCommon::setFilterCookie($sql);
            }

        }

        /**
         * This method saves the contents of $string and adds it to the session var $_SESSION['filter'][GROUP_NAME]
         * @param   string  $string   should be a properly formed MySQL WHERE statement for the objects content group
         * @return  void
         */
        function setFilterCookie($string)
        {
           $xfilt = $_SESSION['filter'];
           $xfilt[$this->group['group_name']] = $string;
           $_SESSION['filter'] = $xfilt;
           $this->filter_str = $string;
        }

        /**
         * This method takes the value from the session filter and adds it to this object parameter  filter_str
         * @return void
         */
        function getFilterCookie()
        {
            $this->filter_str = $_SESSION['filter'][$this->group['group_name']];
        }

        
        /**
         * This method will clear the filter information that is stored in session filter for the content group
         * @param   string  $retstr     a URL or address where the user should be sent after the session has been unset
         */
        function killFilter( $retstr )
        {
            unset($_SESSION['filter'][$this->group['group_name']] );
            redirect_header($retstr, 1, _NA_FILTER_CLEARED );
        }

        /**
         * This method performs a SELECT COUNT(*) command for the current content group taking into consideration any filters
         * which may be applied to the content group. Returns the number of items in database for the content group
         * @param   array   $sub    contains an array of relationship data pulled from  itemDetails()
         * @param   array   $filter   an array of filter information which would be applied to the sql statement
         * @return  int     
         */
		function sqlCount( $sub=array(), $filter=array() )
		{
			$sql = "SELECT COUNT(*) FROM ".$this->db->prefix($this->group['table_name']);
			if( $sub )
			$sql .= NoAhCommon::getSqlSubPageFilter( $sub, true );

            if ( $this->$filter_str ) {
                print "| here in sqlCount |";
                $sql .= $this->$filter_str;
            }

            if( $filter && ! $this->filter && ! $this->filter_str )
            $sql .= " WHERE ".$filter['field']." = '".$filter['value']."'";

            if ( $this->filter && ! $this->filter_str) {

                $sql .= " WHERE";

                $n = 0;
                foreach ($this->filter as $field=>$value) {
                   
                    $sql .= " $field = '$value'";

                    if ( ($n+1) < (count($this->filter))) {
                        $sql .= ' AND';
                    }

                $n++;
                }

            }

			if ( ! $res = $this->db->query($sql) )
				echo( $this->db->error()."<br/> $sql <br/>");
			$items = $this->db->fetchRow($res);

		return $items[0];
		}
		
		
		/**
         * Constructs a SQL WHERE statement based on join information from a NoAh Relationship between two noah content groups
         * @param      array    $sub    array of relationship details 
         * @param   $short  set to true if you don't want to prefix table name to field name in sql.  NoAh standard is to leave this off.
         * @return     string
         */
        function getSqlSubPageFilter( $sub, $short=false )	
		{
			$field = $this->db->prefix($sub['jn_table']).".".$sub['jn_field'];
			
			if( $short )
			$field = $sub['jn_field'];
			
			$sql = " WHERE $field = '".$sub['match_value']."'";
			
		return $sql;
		}

		/**
         * Returns the name of a NoAh sysList or Site List
		* @param	listid for a system list
		* @return	list name
		*/		
		function syslistName( $id, $sitelist=false )
		{
            if ($sitelist) {
                $table = $this->db->prefix('noah_sitelist');
            } else {
                $table = $this->db->prefix('noah_syslist');
            }


			$name= '';
			$sql = "SELECT listname FROM $table WHERE listid=$id LIMIT 1 ";
			$res = $this->db->query($sql);
			$name= $this->db->fetchRow($res);

		return $name[0];
		}

		/**
         * Constructs a string containing a list of fields which can be used in a SELECT statement for this content group
		* @param    string  $pfunc  page function to control how string is constructed.
		* @return	string
		*/ 
		function getSelectFields( $pfunc )
		{
			switch ( $pfunc )
			{
			case 'item':
				$fmatch = 'db_field';
				$fcount = 'f_count';
			break;		
			case 'form':
				$fmatch = 'show_form';
				$fcount = 'ff_count';
			break;		
			default:
				$fmatch = 'show_list';
				$fcount = 'lf_count';
			break;
			}
			
			// echo('pfunc : '.$pfunc);
			
			$table = $this->db->prefix($this->group['table_name']);
		
			$sql = " $table.".$this->group['prime'].",";

			// loop through ginfo fields and add to select str
			$i=1;
			foreach( $this->group['field'] as $field )
			{
				if( isset( $field[$fmatch] ) )
				{
					if ( isset($field['relation']) )
					{
						if ( $field['relation']['relationtype'] == 'join' )
						{
							
							$sql .= ' '.$field['relation']['sel_name'];

							if( $pfunc == 'form' || $pfunc ==  'item' || $pfunc == 'edit' )
							$sql .= ", $table.".$field['db_field'];

						} else {
							$sql .= ' '.$this->db->prefix('noah_sysvalue') . $field['relation']['sel_name'].'.value
								AS '.$field['relation']['sel_name'];
						}
					} else {
						$sql .= " $table.".$field['db_field'];
					}
			
					if( $i < $this->group[$fcount] )
					$sql .= ',';

				$i++;
				}
			} 
		return $sql;
		}
		
		/**
         * Returns a string of Table details which can be used in a SELECT statement for this content group. In a properly
         * formatted SQL command, the results of this method would follow the results of  getSelectFields
		* @param	results from groupDetails
		* @return	string of tables with joins for select statment
		*/
		function getSelectTables( $pfunc )
		{
		$rel = array();
		$sql = '';
		$table = $this->db->prefix($this->group['table_name']);
		
			// roll field info into new array 
			// with only fields that have relationships
			foreach ( $this->group['field'] as $field )
			{
				if ( isset($field['relation'] ) )
				{
					$rel[] = $field;
				}
			}
			
			// relationship count
			$relcount = count($rel);
			
			// insert '(' into statment to open for each join
			for ( $i=0; $i < $relcount; $i++ )
			{
				$sql .= '(';
			}
			
			// add main table name to statment
			$sql .= " $table";
			
			// insert joins
			for ( $i=0; $i < $relcount; $i++ )
			{
				if ($rel[$i]['relation']['relationtype'] == 'join')
				{
					$reltable = $this->db->prefix( $rel[$i]['relation']['jn_table']);
					$relfield = $rel[$i]['relation']['jn_field'];
					$sql .= " LEFT JOIN $reltable 
					ON $table.".$rel[$i]['db_field']." = $reltable.$relfield
					  )";
				} else {
					$reltable = $this->db->prefix('noah_sysvalue');
					$astable = "$reltable".$rel[$i]['relation']['sel_name'];
					$sql .= " LEFT JOIN $reltable AS $astable
						ON $table.".$rel[$i]['db_field']." = $astable.value
					  )";
				}
			} // end for
			

		return $sql;
		}
		
		
	} // End Class NoAhPage

?>
