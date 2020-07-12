<?php
// $Id: noahForm.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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
	* NoAhForm Class File
	* 
	* NoahForm provides methods which can are used to generate
	* form fields for display. This class 
	*
	* @author		Fatman < noah.kerkness.ca >
	* @version		0.8
	* @package		NoAh
	*/
	class NoAhForm extends NoAhPage
	{
		/**
		* creates an instance of XoopsForm
		* @param	object $form form object needs to be created first
		* @param	array $values populat form fields with an array of data
		* @return	boolean returns true if at least 1 element was added 
		*/
		function NoAhForm()
		{
		}
		

	   /**
		* build a form for display. returns true if at least 1 element was added to the form. 
		*
		* This method requires an already created form object
		* and basically assists with calling the proper xoopsForm
		* method for rendering form fields and pulling other
		* form information out of a groupDetails array 
		*
		* @param	object $form    a form object created in sript with $form = new XoopsSimpleForm()
		* @param	array $values   populat form fields with an array of data
        * @param   array   $lock    replace with a new property $this->locks
		* @return	boolean 
        * @param   boolean $search set to true if you need to render a search form.
		*/
		function getFormView( &$form, $values=array(), $lock=array(), $search=0 )
		{
		$res = 0;
		    //print $search;

			// if a locked field is being requested change the value array here
			// this is done inside the getFormView method so the feature is portabale
			if ( isset($lock['value']) && isset($lock['field']))
			{
				if( $lock['value'] != '' && $lock['field'] != '' )
				$values[$lock['field']] = $lock['value'];
			}

		
			// loop through fields and add field element
			foreach ( $this->group['field'] as $k=>$field )
			{
				if ( isset($field['show_form']) && ! $search )
				{
					if ( NoAhForm::addFieldElement( &$form, $field, $values, $lock ) )
					$res = 1;
				} elseif ( isset($field['show_search']) && $search )
                {
					if ( NoAhForm::addFieldElement( &$form, $field, $values, $lock, $search ) )
					$res = 1;
                }
			} 
		return $res;
		}
		
	
		
	   /**
		* add individual form element to a form object. Returns true if form element is added
		*
		* This method could probably use some updating it has been
		* converted from a different form object to XoopsForm and
		* could probably be simplified, for now it works 
		*
        * @param    object  $form       a form object created in sript with $form = new XoopsSimpleForm()
		* @param	array   $field      an array of field data found in $this->group['field'] 
		* @param	array   $values     optional array of values for the fields
        * @param    array   $lock       replace with a new property $this->lock
        * @param    boolean $search     set to 1 if field element will be added to a search form.
		* @return	boolean
		*/
		function addFieldElement( &$form, $field , $values=array(), $lock=array(), $search=0 )
		{
		
		
           // Pull some variables from $field  
            if ( isset( $field['fieldtype'] ))
			$type = $field['fieldtype'];
			
			if (isset($field['error_msg']))
			$required = $field['error_msg'] ;
	
			if (isset($field['db_field']))
			$id = $field['db_field'];
			
			if (isset($field['field_options']))
			$options = $field['field_options'];
			
			if (isset($field['fieldlabel']))
			$fieldlabel = $field['fieldlabel'];
		
			// set default extra value
			$extra = '';
		
			// Look in NoAh general preference settings to see if we want to show help tips
            if( $this->getConf('show_help')  )
			{
				if ( isset($field['help_info']) )	
				$extra .= $field['help_info'];
			}
	
			// Look for 'error' flag in field array to see if the field has any errors in it.
            // if it does have errors, add error message to field 'extra' array.
            if( isset( $values['error'][$field['db_field']] ) )
			{
				if( $this->getConf('show_help') && isset($field['help_info']) )
					$extra .= '<br/>';

                if ( defined($values['error'][$field['db_field']])) {
                    
                    if($this->showVerbose())
                        echo("<br/>: Loading constant as errormsg for " . $field['db_field']);

                    $errormsg = constant($values['error'][$field['db_field']]);
                } else {

                    if($this->showVerbose())
                        echo("<br/>: Loading string as errormsg for " . $field['db_field']);

                    $errormsg = $values['error'][$field['db_field']];
                }


				$extra .= "<span style='color:red;'>".$errormsg."</span>";
			}
		
		
		
			// by default set value as defined field default
			if ( ! isset($field['fielddefault']))
			$field['fielddefault'] = '';
			
			$value = $field['fielddefault'];
		
			// if values array has been submitted then use that as value
			if ( isset($values[$field['db_field']]) )
				$value = $values[$field['db_field']];
		
			// if for is recieving posted data display that
			if ( isset( $_POST[ $field['db_field'] ] ) )
			$value = $_POST[ $field['db_field'] ];
			
            if ( $search ) 
            $value = '';    
            //print $search;
		
			//	echo($options.'<br />');
            // Explode our $field options into an array
			if ( isset( $options ) )
			{
				if ( $options != '' )
				{
					$options = explode('|', $options);
				}
			}

            // set field type to locked if the field should be locked
            if ( $this->lock[$id] ) {
                $type = 'locked';
            }


			switch ( $type ) 
			{
		
            // case "locked"
                case "locked":
                $html = new XoopsFormHidden( $id, $this->lock[$id]['value'] );
                if ($this->lock[$id]['display']) {
                    $extra = $this->lock[$id]['value'];
                    $html = new XoopsFormLabel( $fieldlabel, $this->lock[$id]['value'] );
                }
                break;
    

			// set up a text field
				case "text":
				$html = new XoopsFormText($fieldlabel, $id, $options[0], $options[1], $value);
				break;

			// set up a text field
            // NOTE: this is not standard fare, I only include this by request when I use No-Ah
                // Actual wysiwyg class to use is in beta
				case "wysiwyg":
 				$html = new XoopsFormWysiwygTextArea( $fieldlabel, $id, $value, $options[0], $options[1],'',1);
				break;
		
			// set up a text field
				case "password":
				$html = new XoopsFormPassword($fieldlabel, $id, $options[0], $options[1], $value);
				break;
		
			// set up a text area field
				case "textarea":
				$html = new XoopsFormTextArea($fieldlabel, $id, $value, $options[0], $options[1]);
				break;
		
			// set up checkbox field
				case "checkbox": 
					$html = new XoopsFormCheckBox($fieldlabel, $id, $value );
					$html->addOption( 1, ' &nbsp;' ) ;
				break;
		
				case "country_select": 
				$html = new XoopsFormSelectCountry($fieldlabel, $id, $value, $size=1) ;
				break;
		
				case "state_select": 
				$html = new XoopsFormSelectUsState($fieldlabel, $id, $value, $size=1) ;
				break;
				
				case "group_select":
				$value = unserialize( $value );
				$html = new XoopsFormSelectGroup($fieldlabel, $id, $include_anon=true, $value, $size=3, $multiple=true);
				break;
		
		
			// set up a select box
				case "select":
                    $value = $values[$field['db_field']];
					if ( $extra != '' )
					$field['extra'] = $extra;
					NoAhForm::makeSelectField ( &$form, $field, $value, $search );
				break;
		
			// set up a time stamp field
				case "timestamp":
					if ( $options[0] == 'all')
					{
						$value = time();
					}
					$html = new XoopsFormTimestamp($fieldlabel, $id, $value);
				break;
		
			// set up a text area field
				case "date_select": //makeCaledarPop
				if ( ! $value )
					$value = time();
		//		echo($value);
				$html = new XoopsFormTextDateSelect ($fieldlabel, $id, 15, $value);
				break;
		
				case "date_time_select": //makeCaledarPop
				if ( ! $value )
					$value = time();
		//		echo($value);
				// $html = makePopUpCalendar();
				$cal_field = new XoopsFormTextDateSelect ($fieldlabel, $id, 15, $value);
				$form->addElement( $cal_field );
				$html = new XoopsFormText($fieldlabel.'_time', $id.'_time', 6, 5, $value);
				break;
		
		
			// set up a system list select box
                case "syslist":
                case "site_list":
    				$sel_name = $field['relation']['sel_name'];
					if( isset($values[$sel_name]))
					$value = $values[$sel_name];
					if ( $extra != '' )
					$field['extra'] = $extra;
					$html = NoAhForm::makeSysList ( $field, &$form, $value, $search );
				break; 
		
			// set up a field for uploading an image.
				case "upload":
		//			$html = makeUploadField ( $id, $value, $options );
				break;
		
			// set up a field for uploading an image.
				case "hidden":
					$html = new XoopsFormHidden( $id, $value );
				break;
		
			// set up a field for picking static blocks.
				case "static_blocks":
					if ( $extra != '' )
					$field['extra'] = $extra;
					$html = NoAhForm::makeStaticBlockSelect ( &$form, $field, $value );
				break;
		
		
			// set up a field for picking template files.
				case "list_templates":
					$options[] = 'dir';
					$options[] = 'templates/list';
					if ( $extra != '' )
					$field['extra'] = $extra;
					$html = NoAhFormDirSelect::makeDirSelect ( $id, $value, $options, $field, &$form );
				break;
		
			// set up a field for picking template files.
				case "form_templates":
					$options[] = 'dir';
					$options[] = 'templates/form';
					if ( $extra != '' )
					$field['extra'] = $extra;
					$html = NoAhFormDirSelect::makeDirSelect ( $id, $value, $options, $field, &$form );
				break;
		
			// set up a field for picking template files.
				case "detail_templates":
					$options[] = 'dir';
					$options[] = 'templates/item';
					$value = str_replace('db:item/', '', $value);
					if ( $extra != '' )
					$field['extra'] = $extra;
					$html = NoAhFormDirSelect::makeDirSelect ( $id, $value, $options, $field, &$form );
				break;
		
			// set up a field for picking script files.
				case "page_scripts":
					$options[] = 'dir';
					$options[] = 'page/';
					if ( $extra != '' )
					$field['extra'] = $extra;
					$html = NoAhFormDirSelect::makeDirSelect ( $id, $value, $options, $field, &$form );
				break;

			// set up a field for picking script files.
				case "page_templates":
					$options[] = 'dir';
					$options[] = 'templates/page/';
					if ( $extra != '' )
					$field['extra'] = $extra;
					$html = NoAhFormDirSelect::makeDirSelect ( $id, $value, $options, $field, &$form );
				break;
		
		
			} # end switch ( $type ) 
		
			// assign any extras to the elemnt
			if( $extra != '' )
			{
				$this->setFormExtra( $field['db_field'], $extra );
			}

			if( isset($required) )
			{
				$i = 1;
			} else {
				$i = 0;
			}
			
			$form->addElement($html, $i);

		
		return;
		}

		function makeSelectField ( &$form, $field, $value, $search=0  ) 
		{
		$allow_null = false;
			
			//check for allow_null
			$options = explode('|', $field['field_options']);
			foreach( $options as $k=>$v )
			{
				if ( $v == 'allow_null')
				$allow_null = true;
			}

            if ($search) {
                $allow_null = true;
            }
			
            if( $field['relation']['allow_null'] == 1 )
                $allow_null = true;
			
			$query = "SELECT * FROM ".$this->db->prefix($field['relation']['jn_table']);
			
			$result = $this->db->query( $query );
			
			while ( $row = $this->db->fetchArray($result) )
			{
				if( $allow_null )
				$str[''] = '--'; 
				
				$str[$row[$field['relation']['jn_field']]] = $row[$field['relation']['jn_display']];
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
				$this->setFormExtra( $field['db_field'], $field['extra'] );
                
               // $html->setExtra($field['extra']);
			}

			
			$form->addElement($html);
			
		
		}
		
		function makeSysList ( $field, &$form, $value, $search=0 ) {

            global $xoopsConfig, $xoopsModule;
            
            if ( $field['fieldtype'] == 'site_list') {
			$table = $this->db->prefix('noah_sitevalue');
            $listid = $field['relation']['sitelistid'];
            } else {
			$table = $this->db->prefix('noah_sysvalue');
            $listid = $field['relation']['listid'];
            }

            require_once( XOOPS_ROOT_PATH . '/modules/'.$xoopsModule->dirname().'/language/'.$xoopsConfig['language'].'/listvalues.php');
		
			$allow_null = false; $options = array();

			if ( isset($field['field_options']))
			$options = explode('|', $field['field_options']);
			foreach( $options as $k=>$v )
			{
				if ( $v == 'allow_null')
				$allow_null = true;
			}
            if ($search) {
                $allow_null = true;
            }

            if( $field['relation']['allow_null'] == 1 )
                $allow_null = true;
			
            $sel_name = $field['relation']['sel_name'];
			

			$sql = "SELECT * FROM $table WHERE listid=".$listid;
			
            // This line will enable list sorting. Must be added to NoAh SQL first
            // $sql = " ORDER BY weight ASC";

			if( ! $res = $this->db->query($sql))
				echo( $this->db->error()." <br /> $sql ");
			
			if( $allow_null )
			$str[''] = '--'; 

			while ( $row = $this->db->fetchArray($res) )
			{

              // print_r($row);

               if (isset($row['langconst']) && $row['langconst'] != '' ) {
                    $str[$row['value']] = constant($row['langconst']);
                } else {
                    $str[$row['value']] = $row['value'];
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
				$this->setFormExtra( $field['db_field'], $field['extra'] );
				//$html->setExtra($field['extra']);
			}
			
            $form->addElement($html);
		
		
		return;
		}
		
		/**
		* this function renders a select list of available static
		* HTML blocks created using the Xoops Block section of the 
		* Xoops control panel. These can then be used for static 
		* type content on your public pages.
		*/
		function makeStaticBlockSelect ( &$form, $field, $value='' )
		{
		
			$allow_null = false; $options = array();

			if ( isset($field['field_options']))
			$options = explode('|', $field['field_options']);
			foreach( $options as $k=>$v )
			{
				if ( $v == 'allow_null')
				$allow_null = true;
			}
		
			$sql = "SELECT * FROM ".$this->db->prefix('newblocks');
			$sql .= " WHERE mid = 0 AND func_num = 0 ORDER BY name ASC";
			if ( ! $result = $this->db->query($sql))
				echo( $this->db->error()."<br/>$sql<br/>");
			
			
			if ( $allow_null )
			{
				$list[''] = "--";	
			}
		
			while( $row = $this->db->fetchArray($result))
			{
				$list[$row['bid']] = $row['title'];	
			}

			if ( is_a( $form, 'XoopsFormElementTray' )){
			 $caption = '';
			 $id = $field['rowid']."_row[".$field['db_field']."]";
			 } else {
			 $caption = $field['fieldlabel'];
			 $id = $field['db_field'];
			}

		
			$html = new XoopsFormSelect($caption, $id, $value, $size=1, $multiple=false);
			$html->addOptionArray($list);

			// assign any extras to the elemnt
			if( isset($field['extra']) )
			{
				//$html->setExtra($field['extra']);
				$this->setFormExtra( $field['db_field'], $field['extra'] );
			}
			
			$form->addElement($html);

		return;
		}


		
	}

?>
