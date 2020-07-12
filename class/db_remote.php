<?php
// $Id: db_remote.php,v 1.1 2006/03/10 17:15:56 mikhail Exp $
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




/*

* Database class for connecting to glb databases

* It extends xoops object.

*/



class myDB extends XoopsObject

{

	/**

	* @var	$host

	*/

	var $host ='';

	/**

	* @var	$user

	*/

	var $user = '';

	/**

	* @var	$password

	*/

	var $password = '';

	/**

	* @var	$database

	*/

	var $database = '';

	/**

	* @var	$persistent

	*/

	var $persistent = false;

	

	/**

	* @var	$conn

	*/

	var $conn = null;

	

	/**

	* @var	$result

	*/

	var $result = false;

	

	

	/**

	* @param	string	$host	database server

	* @param	string	$user	database user

	* @param	string	$password	database user pass

	* @param	string	$database	database name

	* @param	bool	$persistent	set to true to use a persistent db connection

	*/

	function myDB( $host, $user, $password, $database, $persistent = false)

	{

		$this->host = $host;

		$this->user = $user;

		$this->password = $password;

		$this->database = $database;

		$this->persistent = $persistent;

	}





    function myTest()

    {

        return 'test';

    }

	

	/**

	* Open the the database connection

	*/

	function dbOpen()

	{

		/* Choose the right connectoin type */

		if ( $this->persistent){

			$func = 'mysql_pconnect';

		} else {

			$func = 'mysql_connect';

		}

		/* Connect to Mysql Server */

		$this->conn = $func($this->host, $this->user, $this->password);

		if (!$this->conn){

			return false;

		}

		/* Select database */

		if ( @!mysql_select_db($this->database, $this->conn)){

			return false;

		}

	return true;

	}

	



	/**

	* Close the database connection

	*/

	function dbClose()

	{

		return(@mysql_close($this->conn));

	}

	

	/**

	* Function for returning database errors

	*/

	function dbError()

	{

		return (mysql_error());

	}

	

	/**

	* Function to query the database

	*/

	function dbQuery($sql)

	{

		$this->result = @mysql_query($sql, $this->conn);

		return($this->result != false);

	}

	

	/**

	* Function to get affected rows from query results

	*/

	function dbAffectedRows()

	{

		return(@mysql_affected_rows($this->conn));

	}


	/**

	* Function to get affected rows from query results

	*/

	function dbInsertId()

	{

		return(@mysql_insert_id($this->conn));

	}

	
	

	/**

	* function to return number of rows in a query results

	*/

	function dbNumRows()

	{

		return(@mysql_num_rows($this->result));

	}

	

	/*

	* functions to return result set

	*/

	function dbFetchObject()

	{

		return(@mysql_fetch_object($this->result, MYSQL_ASSOC));

	}

	function dbFetchArray()

	{

		return(@mysql_fetch_array($this->result, MYSQL_NUM));

	}



	function dbFetchRow()

	{

		return(@mysql_fetch_row($this->result));

	}





	function dbFetchAssoc()

	{

		return(@mysql_fetch_assoc($this->result));

	}

	

	/**

	* Function to free result set

	*/

	function dbFreeResult()

	{

		return(@mysql_free_result($this->result));

	}

}



?>

