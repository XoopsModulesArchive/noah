<?php
// $Id: database_discovery.php,v 1.2 2006/03/19 20:04:37 mikhail Exp $
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
* Database_Discovery.php contains functions for finding tables
* and fields in the xoops database.
*/

/**
* @return	array	table names from our database
*/
function listTables()
{
 $result = mysql_list_tables(XOOPS_DB_NAME);
 $i = 0;
 while ($i < mysql_numrows($result)) {
   $tb_names[$i] = mysql_tablename($result, $i);
   //echo $tb_names[$i]."<br />";
   $i++;
 }
 return $tb_names;
}


/**
* @results	all tables in the database
* @param	string	$table name of a table
* @return	array
*/
function listFields( $table )
{ 
global $xoopsDB;

$link = mysql_connect(XOOPS_DB_HOST, XOOPS_DB_USER, XOOPS_DB_PASS);
$fields = mysql_list_fields(XOOPS_DB_NAME, $xoopsDB->prefix($table), $link );
$columns = mysql_num_fields($fields);

	for ($i = 0; $i < $columns; $i++) {
  	 	$results[$i] = mysql_field_name($fields, $i);
		// print $results[$i];
	}
 
 return $results;
}

/**
* @param	string	$table name of a table
* @param	string	$field name of a field
*/
function getFieldType( $table, $field )
{
	global $xoopsDB;
	$link = mysql_connect(XOOPS_DB_HOST, XOOPS_DB_USER, XOOPS_DB_PASS);
	$result = mysql_query ("SELECT * FROM $table", $link);
	$fields = mysql_num_fields ($result);
	$rows   = mysql_num_rows ($result);

	$i = 0;

	$table = mysql_field_table ($result, $i);

	echo "Your '".$table."' table has ".$fields." fields and ".$rows." records <br />";
	echo "The table has the following fields <br />"; 
	while ($i < $fields) {
    $type  = mysql_field_type  ($result, $i);
    $name  = mysql_field_name  ($result, $i);
    $len   = mysql_field_len   ($result, $i);
    $flags = mysql_field_flags ($result, $i);
    echo $type." ".$name." ".$len." ".$flags."<br />";
    $i++;
	}
return;
}

/**
* @param	string	$table name of a table
* @param	array	$sys_fields an array of NoAh fields
*/
function findMissingFields( $table, $sys_fields )
{
	$table_fields = listFields($table);
	//	print "<pre>";
	//	print_r($table_fields);
	//	print "</pre>";
	// assume no fields are missing
	$n = 0;
	foreach ( $table_fields as $k=>$v )
	{
		$match_found = false;
		foreach ( $sys_fields as $field )
		{
			if( $field['db_field'] == $v )
			$match_found = true;
		}
	
		if ( ! $match_found )
		{
			$miss[$n] = $v;
		$n++;
		}
	}

return $miss;
}

// this function check the database for existing fields
// so that we don't try and create duplicates.
function checkForFields( $field, $table )
{

	$table_fields = listFields( $table );
	
	foreach ( $table_fields as $k=>$v )
	{
		if ( $field == $v )
		{
			$field_found = true;
			return true;
		}
	}
return false;
}

// this function looks in the database to make sure the
// table that the person is trying to add doesn't already
// exsist. If the table does exist return 1 if not return 0
function checkForTable( $table )
{
	$table_list = listTables();
	foreach ( $table_list as $k=>$v )
	{
		$v = str_replace(XOOPS_DB_PREFIX.'_', '', $v);
	
		if( $v == $table )
		{
			$match_found = true;
		}
	}
	if ( $match_found )
	{
		$result = 1;
	}
		else
	{
		$result = 0;
	}
	
return $result;	
}

function findMissingGroups()
{
	global $xoopsDB;
	
	$table_list = listTables();

	$sql = "SELECT table_name FROM ".$xoopsDB->prefix('noah_sysgroup');
	
	if( ! $result = $xoopsDB->query($sql) )
		echo( $xoopsDB->error()." <br /> $sql ");
	
		$n = 0;
		while ( $row = $xoopsDB->fetchArray($result) )
		{
			foreach ( $row as $k=>$v )
			{
				$group[$n] = $v;
			}
		$n++;
		}

		$n = 0;
		foreach ( $table_list as $k=>$v )
		{
		$match_found = false;
		$v = str_replace(XOOPS_DB_PREFIX.'_', '', $v );
//		echo("v = $v <br/>");
			foreach ( $group as $gk=>$gv )
			{
//		echo("gv = $gv <br/>");
				if ( $v == $gv )
				{
					$match_found = true;
				}
			}

			if ( $match_found != true )
			{
				$miss[$n++] = $v;
			}
		}

return $miss;
}

function getTablePrimary ($table)
{
	global $xoopsDB;

$query = "DESC ".$xoopsDB->prefix($table);
$results = $xoopsDB->query($query);

while ($row = $xoopsDB->fetchArray($results))
{
	if ($row[Type]="PRI")
   {
		// print "I found the primary key! <br />";
		$prime = $row[Field];
		// print $row[Field];
		/* drop out , as we've found the key */ 
		break;  
   }
}
return $prime;
}

?>