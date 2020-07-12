<?php
// $Id: noahPage.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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
	class NoAhPage extends XoopsObject
	{

        var $sortby;
        var $sortdir;
        var $paginate_link;
        var $filters = array();
        var $filter_string;
        var $lock = array();

       /**
		* class constructor for NoAhPage
		* 
		* creates an instance of xoops database object and builds
		* array of group details for the provided group name.
		*
		* @param	string $group name of a noah group
		* @return	object
		*/
		function NoAhPage( $group='sysgroups' )
		{
			$this->db =& Database::getInstance();
			$this->group = $this->getGroupDetails( $group );
			$this->_title = $this->group['group_label'];
            $this->sortby = $this->group['prime'];
            $this->sortdir = 'ASC';
            $this->paginate_link = 'list.php?';
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
		* @param	string $group name of a noah group
		* @return	array of group details
		*/
		function getGroupDetails( $group )
		{
			$sql = "SELECT * FROM ".$this->db->prefix('noah_sysgroup')."
				WHERE group_name = '$group' LIMIT 1";
			$res = $this->db->fetchArray($this->db->query($sql));

			// add count for all list fields
			$res['lf_count'] =& NoAhList::fieldCount( $res['groupid'] );
			// add count for all form fields
			$res['f_count'] =& NoAhGroup::fieldCount( $res['groupid'] );
			
			// add name of primary field
			$res['prime'] =& NoAhField::getPrimaryField( $res['groupid'] ); 

			// add field info to group details
			$res['field'] =& NoAhField::getFields( $res['groupid'] );
			
		return $res;
		}
		
     /**
      * When enabled some noAh scripts will echo() notes while performing
      * operations. This helps fatman debug and should be left off typically.
      * @return  boolean
      */
		function showVerbose()
		{
			return $this->getConf('show_verbose');
		}

		/**
		* @see NoAhGroup::groupDetails()
		*/		
		function groupDetails( $group )
		{
			return NoAhGroup::groupDetails( $group );
		}

        function groupNameFromId( $id )
        {
            return NoAhGroup::groupNameFromId( $id );
        }

        /**
         * @see NoAhList::getContent()
         */
        function getContent($p=1, $session_filter=false, $all_fields=false)
        {
            return NoAhList::getContent($p, $session_filter, $all_fields);
        }
		
     /**
      * Get the current page title
      * @return  string
      */
		function getPageTitle()
		{
			return $this->_title;
		}
		
     /**
      * This method sets the title for the page being displayed
      * @param      string $title page title
      */
		function setPageTitle( $title )
		{
			$this->_title = $title;
		}

     /**
      * Get an array of all the extra info which should be displayed with
      * our form fields. This data is created with setFormExtra
      * @return  array
      */
		function getFormExtra()
		{
			return $this->_formextra;
		}
		
     /**
      * @param   string $field the name of the field being set
      * @param   string $extra the extra info to append to field
      */
		function setFormExtra( $field, $extra )
		{
			$this->_formextra[$field] = $extra;
		}


	   /**
		* @see NoAhGroup::groupSummary()
		*/		
		function groupSummary()
		{
			return NoAhGroup::groupSummary();
		}

	   /**
		* @see NoAhGroup::itemDetails()
		*/		
		function itemDetails( $id )
		{
			return NoAhGroup::itemDetails( $id );
		}

	   /**
		* @see NoAhGroup::itemDetails()
		*/		
		function getConf( $name='' )
		{
			return NoAhCommon::noahConfig( $name );
		}

	   /**
		* @see NoAhList::getListData()
		*/		
		function getListData( $p=1, $sub='', $lock=array(), $paginate_on=true, $session_filter=false )
		{
			return NoAhList::getListData( $p, $sub, $lock, $paginate_on, $session_filter );
		}

	   /**
		* @see NoAhListForm::getListFormRow()
		*/		
		function getListFormRow( &$tray, $row, $cols )
		{
			return NoAhListForm::getListFormRow( &$tray, $row, $cols );
		}


	   /**
		* @see NoAhCommon::getSQL()
		*/		
		function getSQL( $pfunc='list' )
		{
			return NoAhCommon::getSQL( $pfunc );
		}

	   /**
		* @see NoAhList::getListColumns()
		*/		
		function getListColumns()
		{
			return NoAhList::getListColumns();
		}

	   /**
		* @see NoAhList::getListInfo()
		*/		
		function getListInfo()
		{
			return NoAhList::getListInfo();
		}

	   /**
		* @see NoAhForm::getFormView()
		*/		
		function getFormView( &$form, $values=array(), $lock=array(), $search=0 )
		{
			return NoAhForm::getFormView( &$form, $values, $lock, $search );
		}

	   /**
		* @see NoAhFormProcess::formFinalize()		
		*/		
		function formFinalize( $form, $button='' )
		{
			return NoAhFormProcess::formFinalize( $form, $button );
		}

	   /**
		* @see NoAhFormProcess::updateItem()
		*/		
		function updateItem( $post )
		{
			return NoAhFormProcess::updateItem( $post );
		}

	   /**
		* @see NoAhGroup::deleteItem()
		*/		
		function deleteItem( $op, $id, $conf=false )
		{
			return NoAhGroup::deleteItem( $op, $id, $conf );
		}


	   /**
		* @see NoAhField::updateItem()
		*/		
		function getFieldDefaults()
		{
			return NoAhField::getFieldDefaults();
		}

	   /**
		* @see NoAhSitePage::getPageDetails()
		*/		
		function getPageDetails( $nav )
		{
			return NoAhSitePage::getPageDetails( $nav );
		}

	   /**
		* @see NoAhField::updateItem()
		*/		
		function findMissingFields($table, $sys_fields)
		{
			return NoAhDbDiscovery::findMissingFields($table, $sys_fields);
		}
		
	   /**
		* @see NoAhGroup::getRelationInfo
		*/
		function getRelationInfo( $id )
		{
			return NoAhGroup::getRelationInfo( $id );
		}

        
       /**
         * Sorts any list view of content
         * @param   string  $field  the field(s) sorting should be applied to
         * @param   string  $dir    the direction sorting should use ASC or DESC
         */
        function setSort( $field, $dir='ASC' )
        {
          $this->sortby = $field;
          $this->sortdir = $dir;
        }
        
        /**
         * Sets the value for sortby this should be the name of the field to sort the list view by You shouldn't have to call this. Call  setSort instead
         * @param   string  $value  the name of the content field that you want to sort by
         */
        function setSortBy( $value )
        {
            $this->sortby = $value;
        }

        /**
         * Sets the value for sortdir, this should be the direction
         * a list view should be sorted by (asc or desc). You DO NOT need to call this method directly, use  setSort instead.
         * * @param string  $value  set to either ASC or DESC and is appended to ORDER BY in SQL statments used to get content lists
         */
        function setSortDir( $value )
        {
            $this->sortdir = $value;
        }

        /**
         * This sets the base link to use when getting paginate info
         * @param   string  $value  set to the base href you want to use for links autogenerated in a content view. This is typically the page which is displaying the content view. 
         */
        function setPaginateLink( $value )
        {
            $this->paginate_link = $value;
        }

        /**
         * Adds a filter clause to any list view. You can add multiple calls to addFilter to 
         * further narrow down your search
         * @param   string  $field  the field on which the search will be conducted
         * @param   string  $value  the value to search for
         * @param   boolean $session_filter   set to true to save the filter to user session if the filter is saved then it will be applied everytime the getListData asks for it.
         * @return  void
         */
        function addFilter($field, $value, $session_filter=false)
        {
            $this->filter[$field] = $value;
            NoAhCommon::setFilter($session_filter);
        }

        /**
         * Applies a complete search string or SQL WHERE clause to any content list view
         * @param   string  $string  must be a properly formated SQL  'WHERE ' statement
         * @return  void
         */
        function addFilterString( $string )
        {
            $this->filter_str = $string;
        }

        /**
         * Clears any filter stored in _SESSION for current content group
         * @param   string  $retstr    URL to return the user to after filter is cleared
         */
        function killFilter( $retstr )
        {
            NoAhCommon::killFilter( $retstr );
        }

        
        /**
         * Takes an array of filter information and constructs filter string automatically.
         * @param   array   $array  an array of filter data in form of  $array[$field] = $value;
         * @param   boolean $session_filter   set to true to save the filter to user session if the filter is saved then it will be applied everytime the getListData asks for it.
         */
        function addFilterArray( $array, $session_filter=false )
        {
            NoAhCommon::addFilterArray( $array, $session_filter );
        }

        /**
         * This method addes a set of values to the $this->lock parameter.
         * When a field is locked the it is automatically turned into a HIdden Field with the value provided as a string in the field extra's array
         * @param   string  $field  the name of the field to lock
         * @param   string  $value  the value to lock the field to
         * @return  void
         */
        function addLock( $field, $value, $display=true )
        {
            $this->lock[$field]['value'] = $value;
            $this->lock[$field]['display'] = $display;
        }

        /**
         * This method addes an array of locked values set of values to the $this->lock parameter.
         * When a field is locked the it is automatically turned into a HIdden Field with the value provided as a string in the field extra's array
         * @param   array  $array  an array of fields to lock and the values to lock them at
         * @return  void
         */
        function addLockArray( $array )
        {
            foreach ( $array as $k=>$v )
            {
                $this->addLock( $v['field'], $v['value'], $v['display'] );
            }
        }



	} 
?>
