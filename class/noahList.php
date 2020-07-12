<?php
// $Id: noahList.php,v 1.2 2006/03/19 20:04:36 mikhail Exp $
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


 class NoAhList extends NoAhPage
{
    
    /**
     * Class constructor for NoAhList
     * 
     * NoAhList contains all functions associated with
     * no-ah list view. Methods will generally accept 
     * the name of a group or groupid and provide in return
     * information about using that set of data in a list view
     */
     function NoAhList()
    {
         }
    

     /**
      * Returns Content from NoAh Content Groups. This method superseeds getListData
      * it condences the paramaters required in getListData making calls in page scripts simpler
      * @param  int $page   the page number for the content list. If 0 all content rows are returned
      * @param  boolean $filter  set to true to load session_filter
      * @param  boolean $all_fields set to true to return all content fields with each row
      */
     function getContent($p=1, $session_filter=false, $all_fields=false)
     {
         if ($p==0) {
             $paginate_on = false;
         } else {
             $paginate_on = true;
         }
         return $this->getListData( $p, '', '', $paginate_on, $session_filter, $all_fields );
     }
    
    /**
     * gathers from the database data for a list view
     * 
     * Used to get list view data for a specific group
     * it will use the group name or id
     * 
     * @param int $p page number for view
     * @param string $sub name of a NoAhGroup
     * @param array $lock lock = array( field=>fieldname, value=fieldvalue)
     * @param   boolean $paginate_on    set to true to have the results paged
     * @param   boolean $session_filter   set to true to have the current _SESSION filter value applied
     * @return array 
     */
     function getListData($p = 1, $sub = '', $lock = array(), $paginate_on = true, $session_filter = false, $all_fields = false )
    {
        /* Check for a cookie filter */
        if ( $session_filter ) {
            if ( ! $this->filter_str && $_SESSION['filter'][$this->group['group_name']]) {
                NoAhCommon::getFilterCookie();
            }
        }
        
        // set up info for locking field and assinging proper
        // key name to returned array
        if($lock)
        {
             foreach ($this -> group['field'] as $k => $field)
            {
                 if ($field['db_field'] == $lock['field'])
                {
                     if ($field['relation']['relationtype'] == 'join')
                     {
                         $rel_display = $field['relation']['jn_display'];
                         $rel_real = $field['db_field'];
                      }
                  }
              }
          }
        
         foreach ($this -> group['field'] as $k => $field)
         {
             if (isset($field['relation']))
             {
                 if ($field['relation']['relationtype'] == 'join')
                 {
                     $mydisplay = $field['relation']['jn_display'];
                     $myrel[$mydisplay] = $field['db_field'];
                  }
                
                /**
                 * The following is an attempt to get site list constants converted for the list
                 * view. I'm not sure this is the best place to handle this. I might try moving this
                 * till after the list of info is opened and loop I am looping through the results.
                 */
                
                 if ($field['relation']['relationtype'] == 'sitelist'){
                    
                     global $xoopsConfig;
                     require_once(XOOPS_ROOT_PATH . '/modules/' . MOD_DIR . '/language/' . $xoopsConfig['language'] . '/listvalues.php');
                     $listname = NoAhSiteList :: siteListNameFromId($field['relation']['sitelistid']);
                     $sitelist = new NoAhSiteList($listname);
                    
                     $sitelist_values = $sitelist -> getSiteListValues();
                     foreach ($sitelist_values as $list)
                     {
                         if ($list['langconst']){
                             $listvalues[$field['db_field']] = constant($list['langconst']);
                         }else{
                             $listvalues[$field['db_field']] = $list['valuelabel'];
                         }
                     }
                      
//                     print_r($listvalues);
                    
                    
                     }
                
                 }
             }
        
        
        
         $data['info'] = array_merge($this -> getListInfo(), $this -> groupSummary());
        
         if ($all_fields) {
             $get_fields = 'item';
         } else {
             $get_fields = 'list';
         }

        
         $sql = $this -> getSQL($get_fields);
        
         if ($sub || $lock || $this->filter_str ) {
             $filter_on = true;
         }

         if ( $sub && ! $lock && ! $this->filter && ! $this->filter_str )
         {
             $sql .= NoAhCommon::getSqlSubPageFilter( $sub  );
         } elseif( $lock && ! $this->filter && ! $this->filter_str ) {
             $sql.= " WHERE ".$this->db->prefix($this->group['table_name']).".".$lock['field']." = '".$lock['value']."'";
         } elseif( $this->filter && ! $this->filter_str ){

             $sql .= " WHERE";

             $n = 0;
             foreach ($this->filter as $field=>$value ) {

                 $sql .= " $field = '$value'";

                 if ( ($n+1) < (count($this->filter))) {
                     $sql .= ' AND';
                 }

             $n++;
             }

             // print_r($this->filter);

         } elseif ( $this->filter_str ) {
             $sql .= $this->filter_str;
             //if ( $this->showVerbose() ) echo($this->filter_str."<br/>");
         } // end if filter
        
        // Add order settings to SQL statment
        // $sql .= " ORDER BY " . $this->db->prefix( $this->group['table_name'] ).".".$this -> sortby . " " . $this -> sortdir . "";
        $sql .= " ORDER BY " . $this->sortby . " " . $this->sortdir . "";
        
         $total_items = NoAhGroup::countItems();
        
         $items = NoAhCommon::sqlCount($sub, $lock);
        
         $link = $this->paginate_link;
        
         $data['paginate'] = NoAhList::getPaginate($items, $limit = 20, $p, $total_items, $link);
        
         // apply paging limit to sql
        if ($paginate_on){
             $sql .= " LIMIT " . $data['paginate']['start'] . ", $limit";
             }
        
         if (! $res = $this->db->query($sql))
             echo($this->db->error() . '<br />' . $sql);
        
        // if($this->showVerbose())
        // echo($sql."<br/>");
        $n = 0;
		//print 'from getlistdata sql = '.$sql.'<br />';
         while($row = $this -> db -> fetchArray($res))
        {
            
             foreach($row as $k => $v)
            {
                $data['list'][$n]['rowid'] = $row[$this -> group['prime']];
                if ($k != $this -> group['prime'] && ! isset($myrel[$k])) {
                    $data['list'][$n][$k] = $v;
                }
                if (isset($myrel[$k])){
                     $data['list'][$n][$myrel[$k]] = $v;
                    // print $k.'<br />';
                }
                /**
                 * Check to see if our field is of type timestamp, If so 
                 * conver the output to a date format
                 */
                /**
                 * Loop through our group fields and make changes to our 
                 * sql results accordingly. Example, convert timestamp to readable 
                 * date format
                 */
                foreach ($this -> group['field'] as $field)
                {
                     if ($field['db_field'] == $k){
                         /* Make modifications based on field_type */
                         switch ($field['fieldtype']){
                            case 'timestamp':
                             $data['list'][$n][$k] = date($this -> getConf('date_format'), $v);
                            break;
                          }

                         /* Check for 'filter click' and create link */
                         //if ( $field['filter_click'] == 1 )
                         //{
                         //   $data['list'][$n][$k] = NoAhList::setFilterClickLink($field, $data['list'][$n][$k]); 
                         //}
                      }
                   }
                
                
                
                 }
             $n++;
             }
        
         $data['columns'] = $this -> getListColumns();
         $data['info']['count'] = count($data['list']);
         if ( $filter_on ) $data['info']['filter_on'] = 1;
        
      return $data;
     }
    
    
    /**
     * counts the list view fields assigned to supplied group
     * 
     * @param groupid $ 
     * @return total number of fields assigned to list view
     */
     function fieldCount($id)
    {
         $sql = "SELECT COUNT(*) FROM " . $this -> db -> prefix('noah_sysfield') . "
				WHERE groupid = $id AND show_list = 1";
         $res = $this -> db -> fetchRow($this -> db -> query($sql));
         return $res[0];
         }
    
    /**
     * return an array of list columns
     * 
     * Used when creating a list view so its easy 
     * to loop through just an array of column names
     * 
     * @param results $ from groupDetails
     * @return array of list columns
     */
     function getListColumns()
    {
        $cols = array();
        foreach ($this -> group['field'] as $k => $field)
        {
             if(isset($field['show_list']))
             {
                $cols['col'][$field['db_field']] = $field;
                   
                if (isset($field['db_field']['allow_sort'])){
                    
                    $sortlink = NoAhList :: setSortLink($cols['col'][$field['db_field']]);   
                    $cols['col'][$field['db_field']]['fieldlabel'] = $sortlink.' '.$field['fieldlabel']."</a>";
                
                }

              }

           
            }
        
         return $cols;
         } // end function getListSQL
    
    
    /**
     * return an array of list columns
     * 
     * Used when creating a list view so its easy 
     * to loop through just an array of column names
     * 
     * @param results $ from groupDetails
     * @return array of list columns
     */
     function getListInfo()
    {
         $info = array();
        
         $info['label'] = $this -> group['group_label'];
         $info['name'] = $this -> group['group_name'];
         $info['desc'] = $this -> group['groupdesc'];
         $info['groupid'] = $this -> group['groupid'];
         $info['prime'] = $this -> group['prime'];
        
         return $info;
         } // end function getListSQL
    
     function getPaginate($items, $limit, $page, $total_items, $link){
        
         if (! $page)
             $page = 1;
        
        
         if ($_GET)
        {
             foreach ($_GET as $k => $v)
            {
                 if ($k != 'p')
                     $link .= "$k=$v&";
                
                 }
             }
        
        
         if ($total_items > $items)
             $paginate['filter_on'] = true;
        
         // $paginate['template'] = XOOPS_ROOT_PATH.'/modules/noah/templates/paginate.html';
        $paginate['count'] = ceil($items / $limit);
         $paginate['link']['last_page'] = $link . 'p=' . $paginate['count'];
        
         if ($page > 1){
             $paginate['start'] = $limit * ($page-1);
             }else{
             $paginate['start'] = 0;
             }
        
         $paginate['first_rec'] = $paginate['start'] + 1;
         $paginate['last_rec'] = $paginate['start'] + $limit;
        
         if ($paginate['last_rec'] > $items)
             $paginate['last_rec'] = $items;
        
         $paginate['limit'] = $limit;
         $paginate['page'] = $page;
        
         if ($paginate['page'] <= $paginate['count'] and $paginate['count'] > 1){
             $paginate['prev'] = $paginate['page']-1;
             $paginate['link']['prev_page'] = $link . 'p=' . $paginate['prev'];
             }else{
             $paginate['prev'] = 0;
             }
         if ($paginate['page'] >= 1 and $paginate['count'] > 1 and $paginate['page'] < $paginate['count']){
             $paginate['next'] = $paginate['page'] + 1;
             $paginate['link']['next_page'] = $link . 'p=' . $paginate['next'];
             }else{
             $paginate['next'] = 0;
             }
        
         $paginate['total_items'] = $total_items;
         $paginate['link']['first_page'] = $link . 'p=1';
        
         return $paginate;
         }
    
    
    
    function setSortLink($field)
    {
        
        $op_dir = array( 'ASC'=>'DESC', 'DESC'=>'ASC');

        $link = "<a href='".NoAhList::basehref();
        
         if (isset($field['relation']))
         {
           if ($field['relation']['relationtype'] == 'join')
           {
                
                 $link .= '&sortby=' . $field['relation']['jn_display'] . '&sortdir=';
                 $sortby = $field['relation']['jn_display'];
                 
                 // print $link.'<br />';
           } else {
               $link .= '&sortby=' . $field['relation']['sel_name'] . '&sortdir=';
               $sortby = $field['relation']['sel_name'];
           }
            
         }else{
          $link .= '&sortby=' . $field['db_field'] . '&sortdir=';
          $sortby = $field['db_field'];
         }

         /* add direction to link */
         if ( $this->sortby == $sortby ) {
             $link .= $op_dir[$this->sortdir]."'> <img src='".XOOPS_URL."/modules/".MOD_DIR."/images/na_ico_sort_arrow_".strtolower($this->sortdir).".gif'>";
         } else {
             $link .= "ASC'>";
         }

        return $link;
       }


    function basehref()
    {
        global $_GET;
        $link = $this->paginate_link;

        $n = 0;
        foreach($_GET as $k => $v)
        {
          if (($k != 'sortby') && ($k != 'sortdir') && ($k != 'p')){
              if ($n > 0 ) $link .= '&'; 
              $link .= "$k=$v";
                 // print $link.'<br />';
          $n++;
          }
            
        }
        return $link;
    }



     
} // END CLASS

?>
