<?php
//j// BOF

/*n// NOTE
----------------------------------------------------------------------------
secured WebGine
net-based application engine
----------------------------------------------------------------------------
(C) direct Netware Group - All rights reserved
http://www.direct-netware.de/redirect.php?swg

The following license agreement remains valid unless any additions or
changes are being made by direct Netware Group in a written form.

This program is free software; you can redistribute it and/or modify it
under the terms of the GNU General Public License as published by the
Free Software Foundation; either version 2 of the License, or (at your
option) any later version.

This program is distributed in the hope that it will be useful, but WITHOUT
ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for
more details.

You should have received a copy of the GNU General Public License along with
this program; if not, write to the Free Software Foundation, Inc.,
59 Temple Place, Suite 330, Boston, MA 02111-1307, USA.
----------------------------------------------------------------------------
http://www.direct-netware.de/redirect.php?licenses;gpl
----------------------------------------------------------------------------
$Id: swg_contentor_doc.php,v 1.8 2009/05/05 13:57:34 s4u Exp $
#echo(sWGcontentorVersion)#
sWG/#echo(__FILEPATH__)#
----------------------------------------------------------------------------
NOTE_END //n*/
/**
* OOP (Object Oriented Programming) requires an abstract data
* handling. The sWG is OO (where it makes sense).
*
* @internal   We are using phpDocumentor to automate the documentation process
*             for creating the Developer's Manual. All sections including
*             these special comments will be removed from the release source
*             code.
*             Use the following line to ensure 76 character sizes:
* ----------------------------------------------------------------------------
* @author     direct Netware Group
* @copyright  (C) direct Netware Group - All rights reserved
* @package    sWG
* @subpackage contentor
* @uses       direct_product_iversion
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/

/* -------------------------------------------------------------------------
All comments will be removed in the "production" packages (they will be in
all development packets)
------------------------------------------------------------------------- */

//j// Functions and classes

/* -------------------------------------------------------------------------
Testing for required classes
------------------------------------------------------------------------- */

$g_continue_check = true;
if (defined ("CLASS_direct_contentor_doc")) { $g_continue_check = false; }
if (!defined ("CLASS_direct_datalinker")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_datalinker.php"); }
if (!defined ("CLASS_direct_datalinker")) { $g_continue_check = false; }

if ($g_continue_check)
{
//c// direct_contentor_doc
/**
* This abstraction layer provides document (contentor) specific functions.
*
* @author     direct Netware Group
* @copyright  (C) direct Netware Group - All rights reserved
* @package    sWG
* @subpackage contentor
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/
class direct_contentor_doc extends direct_datalinker
{
/**
	* @var array $class_versions Cached document version objects
*/
	protected $class_versions;
/**
	* @var string $data_cid Category ID to be used
*/
	protected $data_cid;
/**
	* @var array $data_pages Splitted pages cache of this document
*/
	protected $data_pages;
/**
	* @var array $data_structure Document structure (pages + titles)
*/
	protected $data_structure;
/**
	* @var boolean $data_locked True if this document is locked
*/
	protected $data_locked;
/**
	* @var boolean $data_published True if this document has been published
*/
	protected $data_published;
/**
	* @var boolean $data_readable True if the current user is allowed to
	*      read this document
*/
	protected $data_readable;
/**
	* @var boolean $data_readable_group True if the current user is in a
	*      group that is allowed to read this document
*/
	protected $data_readable_group;
/**
	* @var boolean $data_writable True if the current user is allowed to
	*      write to this document
*/
	protected $data_writable;
/**
	* @var boolean $data_writable_group True if the current user is in a
	*      group that is allowed to write to this document
*/
	protected $data_writable_group;

/* -------------------------------------------------------------------------
Extend the class
------------------------------------------------------------------------- */

	//f// direct_contentor_doc->__construct ()
/**
	* Constructor (PHP5) __construct (direct_contentor_doc)
	*
	* @param mixed $f_data String containing the allowed category ID or an array
	*        with options
	* @uses  direct_basic_functions::include_file()
	* @uses  direct_class_init()
	* @uses  direct_debug()
	* @uses  USE_debug_reporting
	* @since v0.1.00
*/
	public function __construct ($f_data = "")
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->__construct (direct_contentor_doc)- (#echo(__LINE__)#)"); }

		if (!defined ("CLASS_direct_formtags")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/swg_formtags.php"); }
		if (!isset ($direct_classes['formtags'])) { direct_class_init ("formtags"); }

/* -------------------------------------------------------------------------
My parent should be on my side to get the work done
------------------------------------------------------------------------- */

		parent::__construct ();

/* -------------------------------------------------------------------------
Informing the system about available functions 
------------------------------------------------------------------------- */

		$this->functions['define_cid'] = true;
		$this->functions['define_lock'] = true;
		$this->functions['define_readable'] = true;
		$this->functions['define_stick'] = true;
		$this->functions['define_writable'] = true;
		$this->functions['get_document_structure'] = true;
		$this->functions['get_page'] = true;
		$this->functions['get_pages'] = true;
		$this->functions['get_rights'] = true;
		$this->functions['get_structure'] = true;
		$this->functions['get_versions'] = true;
		$this->functions['is_locked'] = true;
		$this->functions['is_published'] = true;
		$this->functions['is_readable'] = true;
		$this->functions['is_readable_group'] = true;
		$this->functions['is_sticky'] = true;
		$this->functions['is_writable'] = true;
		$this->functions['is_writable_group'] = true;
		$this->functions['parse'] = isset ($direct_classes['formtags']);
		$this->functions['update_latest_version'] = true;

/* -------------------------------------------------------------------------
Set up an additional post class element :)
------------------------------------------------------------------------- */

		$this->class_versions = array ();
		$this->data_cid = "";
		$this->data_pages = array ();
		$this->data_structure = array ();
		$this->data_locked = false;
		$this->data_published = true;
		$this->data_readable = false;
		$this->data_readable_group = false;
		$this->data_sid = "87ecbe0ba0a0b3c7e60030043614e655";
		$this->data_writable = false;
		$this->data_writable_group = false;

		if (is_string ($f_data)) { $this->data_cid = $f_data; }
		elseif (isset ($f_data['cid'])) { $this->data_cid = $f_data['cid']; }
	}

	//f// direct_contentor_doc->define_cid ($f_cid)
/**
	* Sets the category ID of this document.
	*
	* @param  string $f_cid Category ID to use
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return string Accepted category ID
	* @since  v0.1.00
*/
	public function define_cid ($f_cid)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_cid (+f_cid)- (#echo(__LINE__)#)"); }

		if (is_string ($f_cid)) { $this->data_cid = $f_cid; }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_cid ()- (#echo(__LINE__)#)",:#*/$this->data_cid/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->define_lock ($f_state = NULL,$f_update = false)
/**
	* Sets the locking state of this document.
	*
	* @param  mixed $f_state Boolean indicating the state or NULL to switch
	*         automatically
	* @param  boolean $f_update True to update the database entry
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean Accepted state
	* @since  v0.1.00
*/
	public function define_lock ($f_state = NULL,$f_update = false)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_lock (+f_state,+f_update)- (#echo(__LINE__)#)"); }
		$f_return = false;

		if (count ($this->data) > 1)
		{
			if (((is_bool ($f_state))||(is_string ($f_state)))&&($f_state)) { $f_return = true; }
			elseif (($f_state === NULL)&&(!$this->data['ddbcontentor_docs_locked'])) { $f_return = true; }

			if ($f_return) { $this->data['ddbcontentor_docs_locked'] = 1; }
			else { $this->data['ddbcontentor_docs_locked'] = 0; }

			$this->data_changed['ddbcontentor_docs_locked'] = true;	
			if ($f_update) { $this->update (false,true); }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_lock ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->define_readable ($f_state = NULL)
/**
	* Sets the reading right state of this document.
	*
	* @param  mixed $f_state Boolean indicating the state or NULL to switch
	*         automatically
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean Accepted state
	* @since  v0.1.00
*/
	public function define_readable ($f_state = NULL)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_readable (+f_state)- (#echo(__LINE__)#)"); }

		if (((is_bool ($f_state))||(is_string ($f_state)))&&($f_state)) { $this->data_readable = true; }
		elseif (($f_state === NULL)&&(!$this->data_readable)) { $this->data_readable = true; }
		else { $this->data_readable = false; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_readable ()- (#echo(__LINE__)#)",:#*/$this->data_readable/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->define_stick ($f_state = NULL,$f_update = false)
/**
	* Sets the sticking state of this document.
	*
	* @param  mixed $f_state Boolean indicating the state or NULL to switch
	*         automatically
	* @param  boolean $f_update True to update the database entry
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean Accepted state
	* @since  v0.1.00
*/
	public function define_stick ($f_state = NULL,$f_update = false)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_stick (+f_state,+f_update)- (#echo(__LINE__)#)"); }
		$f_return = false;

		if (count ($this->data) > 1)
		{
			if (((is_bool ($f_state))||(is_string ($f_state)))&&($f_state)) { $f_return = true; }
			elseif (($f_state === NULL)&&(!$this->data['ddbdatalinker_position'])) { $f_return = true; }

			if ($f_return) { $this->data['ddbdatalinker_position'] = 1; }
			else { $this->data['ddbdatalinker_position'] = 0; }

			$this->data_changed['ddbdatalinker_position'] = true;	
			if ($f_update) { parent::update (true,false); }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_stick ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->define_writable ($f_state = NULL)
/**
	* Sets the writing right state of this document.
	*
	* @param  mixed $f_state Boolean indicating the state or NULL to switch
	*         automatically
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean Accepted state
	* @since  v0.1.00
*/
	public function define_writable ($f_state = NULL)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_writable (+f_state)- (#echo(__LINE__)#)"); }

		if (((is_bool ($f_state))||(is_string ($f_state)))&&($f_state)) { $this->data_writable = true; }
		elseif (($f_state === NULL)&&(!$this->data_writable)) { $this->data_writable = true; }
		else { $this->data_writable = false; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->define_writable ()- (#echo(__LINE__)#)",:#*/$this->data_writable/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->get ($f_did = "",$f_content = true,$f_load = true)
/**
	* Reads the defined document with the given ID from the database.
	*
	* @param  string $f_did Document ID
	* @param  boolean $f_content True to get the document content as well
	* @param  boolean $f_load Load DataLinker data from the database
	* @uses   direct_contentor_cat::get_aid()
	* @uses   USE_debug_reporting
	* @return mixed issue data array; false on error
	* @since  v0.1.00
*/
	public function get ($f_did = "",$f_content = true,$f_load = true)
	{
		if (USE_debug_reporting) { direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->get ($f_did,+f_content,+f_load)- (#echo(__LINE__)#)"); }
		$f_return = false;

		if (($f_content)||($f_load)) { $f_return = $this->get_aid (NULL,$f_did,$f_content); }
		else { $f_return = parent::get ($f_did,false); }

		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -contentor_doc->get ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->get_aid ($f_attributes = NULL,$f_values = "",$f_content = true)
/**
	* Request and load the category object based on a custom attribute ID.
	* Please note that only attributes of type "string" are supported.
	*
	* @param  mixed $f_attributes Attribute name(s) (array or string)
	* @param  mixed $f_values Attribute value(s) (array or string)
	* @param  boolean $f_content True to read the document content as well
	* @uses   direct_contentor_doc::get_rights()
	* @uses   direct_datalinker::define_extra_attributes()
	* @uses   direct_datalinker::define_extra_conditions()
	* @uses   direct_datalinker::define_extra_joins()
	* @uses   direct_datalinker::get_aid()
	* @uses   direct_db::define_row_conditions_encode()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return mixed Document data array; false on error
	* @since  v0.1.00
*/
	public function get_aid ($f_attributes = NULL,$f_values = "",$f_content = true)
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_aid (+f_attributes,+f_values,+f_content)- (#echo(__LINE__)#)"); }

		$f_return = false;

		if (count ($this->data) > 1) { $f_return = $this->data; }
		elseif ((is_array ($f_values))||(is_string ($f_values)))
		{
$f_select_attributes = array ($direct_settings['contentor_docs_table'].".*",$direct_settings['data_table'].".ddbdata_sid",$direct_settings['data_table'].".ddbdata_mode_user",$direct_settings['data_table'].".ddbdata_mode_group",$direct_settings['data_table'].".ddbdata_mode_all",
"owner.ddbusers_type AS owner_type","owner.ddbusers_banned AS owner_banned","owner.ddbusers_deleted AS owner_deleted","owner.ddbusers_name AS owner_name","owner.ddbusers_title AS owner_title","owner.ddbusers_avatar AS owner_avatar","owner.ddbusers_signature AS owner_signature","owner.ddbusers_rating AS owner_rating",
"author.ddbusers_type AS author_type","author.ddbusers_banned AS author_banned","author.ddbusers_deleted AS author_deleted","author.ddbusers_name AS author_name","author.ddbusers_title AS author_title","author.ddbusers_avatar AS author_avatar","author.ddbusers_signature AS author_signature","author.ddbusers_rating AS author_rating");

			if ($f_content) { $f_select_attributes[] = $direct_settings['data_table'].".ddbdata_data"; }
			$this->define_extra_attributes ($f_select_attributes);

$f_select_joins = array (
array ("type" => "left-outer-join","table" => $direct_settings['contentor_docs_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['contentor_docs_table']}.ddbcontentor_docs_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>"),
array ("type" => "left-outer-join","table" => $direct_settings['data_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['data_table']}.ddbdata_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>"),
array ("type" => "left-outer-join","table" => $direct_settings['users_table']." AS owner","condition" => "<sqlconditions><element1 attribute='owner.ddbusers_id' value='{$direct_settings['contentor_docs_table']}.ddbcontentor_docs_owner_id' type='attribute' /></sqlconditions>"),
array ("type" => "left-outer-join","table" => $direct_settings['users_table']." AS author","condition" => "<sqlconditions><element1 attribute='author.ddbusers_id' value='{$direct_settings['contentor_docs_table']}.ddbcontentor_docs_author_id' type='attribute' /></sqlconditions>")
);

			$this->define_extra_joins ($f_select_joins);
			if (strlen ($this->data_cid)) { $this->define_extra_conditions ($direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinker_table'].".ddbdatalinker_id_main",$this->data_cid,"string")); }

			$f_result_array = parent::get_aid ($f_attributes,$f_values);

			if (($f_result_array)&&($f_result_array['ddbdatalinker_sid'] == $this->data_sid)&&(($f_result_array['ddbdatalinker_type'] == 2)||($f_result_array['ddbdatalinker_type'] == 3)))
			{
				$this->data = $f_result_array;

				if ($this->data['ddbcontentor_docs_locked']) { $this->data_locked = true; }
				else { $this->data_locked = false; }

				$f_result_array = $this->get_rights ();
				$this->data_readable = $f_result_array[0];
				$this->data_readable_group = $f_result_array[1];
				$this->data_writable = $f_result_array[2];
				$this->data_writable_group = $f_result_array[3];

				if ((!$this->data['ddbcontentor_docs_public'])&&(empty ($this->data['ddbcontentor_docs_owner_id']))) { $this->data_published = false; }

				if (($this->data_readable)||($this->data_readable_group))
				{
					if ($f_content) { $this->get_document_structure ($this->data['ddbdata_data']); }
					$f_return = $this->data;
				}
			}
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_aid ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->get_document_structure ($f_data)
/**
	* Parses the document structure (pages) of $f_data.
	*
	* @param  string $f_data Raw document data
	* @uses   direct_debug()
	* @uses   direct_local_get()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	protected function get_document_structure ($f_data)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_document_structure (+f_data)- (#echo(__LINE__)#)"); }
		$f_return = false;

		if (empty ($this->data_structure))
		{
			$f_results_array = preg_split ("#\[(page):(.*?)\]#si",$f_data,-1,PREG_SPLIT_DELIM_CAPTURE);

			if (empty ($f_results_array)) { $f_return = false; }
			elseif (count ($f_results_array) <= 1)
			{
				$this->data_pages[1] = $f_data;
				$this->data_structure[1] = direct_local_get ("contentor_doc_first_multipage");
				$f_return = true;
			}
			else
			{
				if ((!empty ($f_results_array[0]))||($f_results_array[1] != "page"))
				{
					$f_page = 1;
					$this->data_structure[1] = direct_local_get ("contentor_doc_first_multipage");
				}
				else { $f_page = 0; }

				$f_page_active = false;

				foreach ($f_results_array as $f_result_element)
				{
					if ($f_result_element == "page")
					{
						$f_page_active = true;
						$f_page++;
					}
					elseif ($f_page_active)
					{
						$f_page_active = false;

						if (strlen ($f_result_element)) { $this->data_structure[$f_page] = $f_result_element; }
						else { $this->data_structure[$f_page] = $f_page; }
					}
					else { $this->data_pages[$f_page] = preg_replace (array ("#^(\[newline\]+)#si","#(\[newline\]+)$#si"),"",$f_result_element); }
				}

				$f_return = true;
			}
		}
		else { $f_return = true; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_document_structure ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->get_page ($f_page)
/**
	* Returns the page with the given page number.
	*
	* @param  integer $f_page Document page number
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return string Page content or an empty string if the page is invalid
	* @since  v0.1.00
*/
	public function get_page ($f_page)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_page ($f_page)- (#echo(__LINE__)#)"); }

		if ($f_page == "all") { $f_return = implode ("[newline][newline]",$this->data_pages); }
		elseif (isset ($this->data_pages[$f_page])) { $f_return = $this->data_pages[$f_page]; }
		else { $f_return = ""; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_page ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->get_pages ()
/**
	* Returns the number of pages.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return integer Number of pages
	* @since  v0.1.00
*/
	public function get_pages ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_pages ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_pages ()- (#echo(__LINE__)#)",(:#*/count ($this->data_pages)/*#ifdef(DEBUG):),true):#*/;
	}

	//f// direct_contentor_doc->get_rights ()
/**
	* Check the user rights based on the defined object.
	*
	* @uses   direct_debug()
	* @uses   direct_kernel_system::v_group_user_check_group()
	* @uses   direct_kernel_system::v_group_user_check_right()
	* @uses   direct_kernel_system::v_usertype_get_int()
	* @uses   USE_debug_reporting
	* @return array Array with the results to read, read as group member,
	*         write and write as group member
	* @since  v0.1.00
*/
	protected function get_rights ()
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_rights ()- (#echo(__LINE__)#)"); }

		$f_return = array (false,false,false,false);

		if ($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']) > 3)
		{
			$f_return[0] = true;
			$f_return[2] = true;
		}
		elseif ($direct_settings['user']['type'] != "gt")
		{
			if (($direct_settings['user']['id'] == $this->data['ddbcontentor_docs_owner_id'])||($direct_settings['user']['id'] == $this->data['ddbcontentor_docs_author_id']))
			{
				if ($this->data['ddbdata_mode_user'] == "w")
				{
					$f_return[0] = true;
					if (!$this->data_locked) { $f_return[2] = true; }
				}
				elseif ($this->data['ddbdata_mode_user'] == "r") { $f_return[0] = true; }
			}
		}

		if ($this->data['ddbcontentor_docs_public'])
		{
			if ($this->data['ddbdata_mode_group'] == "r") { $f_return[1] = true; }
			elseif ($this->data['ddbdata_mode_group'] == "w")
			{
				$f_return[1] = true;
				if (!$this->data_locked) { $f_return[3] = true; }
			}

			if ($this->data['ddbdata_mode_all'] == "r") { $f_return[0] = true; }
			elseif ($this->data['ddbdata_mode_all'] == "w")
			{
				$f_return[0] = true;
				if (!$this->data_locked) { $f_return[2] = true; }
			}
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_rights ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->get_structure ()
/**
	* Returns the document page structure.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return mixed Array containing the page structure; False on error
	* @since  v0.1.00
*/
	public function get_structure ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_structure ()- (#echo(__LINE__)#)"); }

		if (empty ($this->data_structure)) { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_structure ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_structure ()- (#echo(__LINE__)#)",:#*/$this->data_structure/*#ifdef(DEBUG):,true):#*/; }
	}

	//f// direct_contentor_doc->get_versions ()
/**
	* Returns the document page versions.
	*
	* @param  integer $f_offset Offset for the result list
	* @param  integer $f_perpage Object count limit for the result list
	* @param  string $f_sorting_mode Sorting algorithm
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return mixed Array containing the page versions; False on error
	* @since  v0.1.00
*/
	public function get_versions ($f_offset = 0,$f_perpage = "",$f_sorting_mode = "time-sticky-desc")
	{
		global $direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_versions ($f_offset,$f_perpage,$f_sorting_mode)- (#echo(__LINE__)#)"); }

		$f_return = array ();
		$f_cache_signature = md5 ($this->data['ddbdatalinker_id'].$f_offset.$f_perpage.$f_sorting_mode);

		if (isset ($this->class_versions[$f_cache_signature])) { $f_return =& $this->class_versions[$f_cache_signature]; }
		elseif (isset ($this->data['ddbdatalinker_id']))
		{
$f_select_attributes = array ($direct_settings['contentor_docs_table'].".*",$direct_settings['data_table'].".ddbdata_sid",$direct_settings['data_table'].".ddbdata_mode_user",$direct_settings['data_table'].".ddbdata_mode_group",$direct_settings['data_table'].".ddbdata_mode_all",
"owner.ddbusers_type AS owner_type","owner.ddbusers_banned AS owner_banned","owner.ddbusers_deleted AS owner_deleted","owner.ddbusers_name AS owner_name","owner.ddbusers_title AS owner_title","owner.ddbusers_avatar AS owner_avatar","owner.ddbusers_signature AS owner_signature","owner.ddbusers_rating AS owner_rating",
"author.ddbusers_type AS author_type","author.ddbusers_banned AS author_banned","author.ddbusers_deleted AS author_deleted","author.ddbusers_name AS author_name","author.ddbusers_title AS author_title","author.ddbusers_avatar AS author_avatar","author.ddbusers_signature AS author_signature","author.ddbusers_rating AS author_rating");

			$this->define_extra_attributes ($f_select_attributes);

$f_select_joins = array (
array ("type" => "left-outer-join","table" => $direct_settings['contentor_docs_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['contentor_docs_table']}.ddbcontentor_docs_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>"),
array ("type" => "left-outer-join","table" => $direct_settings['data_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['data_table']}.ddbdata_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>"),
array ("type" => "left-outer-join","table" => $direct_settings['users_table']." AS owner","condition" => "<sqlconditions><element1 attribute='owner.ddbusers_id' value='{$direct_settings['contentor_docs_table']}.ddbcontentor_docs_owner_id' type='attribute' /></sqlconditions>"),
array ("type" => "left-outer-join","table" => $direct_settings['users_table']." AS author","condition" => "<sqlconditions><element1 attribute='author.ddbusers_id' value='{$direct_settings['contentor_docs_table']}.ddbcontentor_docs_author_id' type='attribute' /></sqlconditions>")
);

			$this->define_extra_joins ($f_select_joins);

			$this->class_versions[$f_cache_signature] = parent::get_subs ("direct_contentor_doc",NULL,$this->data['ddbdatalinker_id'],"87ecbe0ba0a0b3c7e60030043614e655",3,$f_offset,$f_perpage,$f_sorting_mode);
			// md5 ("contentor")

			$f_return =& $this->class_versions[$f_cache_signature];
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->get_docs ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->is_locked ()
/**
	* Returns true if the document is locked.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_locked ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_locked ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_locked ()- (#echo(__LINE__)#)",:#*/$this->data_locked/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->is_published ()
/**
	* Returns true if the document is published.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_published ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_published ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_published ()- (#echo(__LINE__)#)",:#*/$this->data_published/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->is_readable ()
/**
	* Returns true if the current user is allowed to read this document.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_readable ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_readable ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_readable ()- (#echo(__LINE__)#)",:#*/$this->data_readable/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->is_readable_group ()
/**
	* Returns true if the current user is in a group that is allowed to read this
	* document.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_readable_group ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc-> ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_readable_group ()- (#echo(__LINE__)#)",:#*/$this->data_readable_group/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->is_sticky ()
/**
	* Returns true if the document is sticky.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_sticky ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_sticky ()- (#echo(__LINE__)#)"); }

		if ($this->data['ddbdatalinker_position']) { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_sticky ()- (#echo(__LINE__)#)",:#*/true/*#ifdef(DEBUG):,true):#*/; }
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_sticky ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
	}

	//f// direct_contentor_doc->is_writable ()
/**
	* Returns true if the current user is allowed to write to this document.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_writable ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_writable ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_writable ()- (#echo(__LINE__)#)",:#*/$this->data_writable/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->is_writable_group ()
/**
	* Returns true if the current user is in a group that is allowed to write to
	* this document.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_writable_group ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_writable_group ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->is_writable_group ()- (#echo(__LINE__)#)",:#*/$this->data_writable_group/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->parse ($f_connector,$f_connector_type = "url0",$f_prefix = "")
/**
	* Parses this document and returns valid (X)HTML.
	*
	* @param  string $f_connector Connector for links
	* @param  string $f_connector_type Linking mode: "url0" for internal links,
	*         "url1" for external ones, "form" to create hidden fields or
	*         "optical" to remove parts of a very long string.
	* @param  string $f_prefix Key prefix
	* @uses   direct_basic_functions::datetime()
	* @uses   direct_basic_functions::varfilter()
	* @uses   direct_datalinker::parse()
	* @uses   direct_debug()
	* @uses   direct_formtags::decode()
	* @uses   direct_html_encode_special()
	* @uses   direct_kernel_system::v_user_parse()
	* @uses   direct_kernel_system::v_usertype_get_int()
	* @uses   direct_linker()
	* @uses   direct_local_get()
	* @uses   USE_debug_reporting
	* @return array Output data
	* @since  v0.1.00
*/
	public function parse ($f_connector,$f_connector_type = "url0",$f_prefix = "")
	{
		global $direct_cachedata,$direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->parse ($f_connector,$f_connector_type,$f_prefix)- (#echo(__LINE__)#)"); }

		$f_return = parent::parse ($f_prefix);

		if (($f_return)&&($this->data_readable)&&(count ($this->data) > 1))
		{
			$f_return[$f_prefix."id"] = "swgdhandlercontentordoc".$this->data['ddbdatalinker_id'];

			if (($f_connector_type != "asis")&&(strpos ($f_connector,"javascript:") === 0)) { $f_connector_type = "asis"; }

			$f_pageurl = str_replace ("[a]","view",$f_connector);

			if ($f_connector_type == "asis") { $f_pageurl = str_replace ("[oid]",$this->data['ddbdatalinker_id'],$f_pageurl); }
			else { $f_pageurl = str_replace ("[oid]","cdid+{$this->data['ddbdatalinker_id']}++",$f_pageurl); }

			$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
			$f_return[$f_prefix."pageurl"] = direct_linker ($f_connector_type,$f_pageurl);

			if ($f_return[$f_prefix."views_counted"])
			{
				$f_source = urlencode (base64_encode ($f_pageurl));
				$f_return[$f_prefix."pageurl_counted"] = direct_linker ("url0","m=datalinker&a=count&dsd=deid+{$this->data['ddbdatalinker_id']}++source+".$f_source);
			}

			if ($this->data['ddbdatalinker_id_main'])
			{
				$f_pageurl = str_replace ("[a]","list",$f_connector);

				if ($f_connector_type == "asis") { $f_pageurl = str_replace ("[oid]",$this->data['ddbdatalinker_id_main'],$f_pageurl); }
				else { $f_pageurl = str_replace ("[oid]","ccid+{$this->data['ddbdatalinker_id_main']}++",$f_pageurl); }

				$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
				$f_return[$f_prefix."pageurl_main"] = direct_linker ($f_connector_type,$f_pageurl);
			}
			else { $f_return[$f_prefix."pageurl_main"] = ""; }

			if (($this->data['ddbcontentor_docs_owner_id'])&&($this->data['owner_name']))
			{
$f_user_array = array (
"ddbusers_type" => $this->data['owner_type'],
"ddbusers_banned" => $this->data['owner_banned'],
"ddbusers_deleted" => $this->data['owner_deleted'],
"ddbusers_name" => $this->data['owner_name'],
"ddbusers_title" => $this->data['owner_title'],
"ddbusers_avatar" => $this->data['owner_avatar'],
"ddbusers_signature" => $this->data['owner_signature'],
"ddbusers_rating" => $this->data['owner_rating']
);

				$f_user_array = $direct_classes['kernel']->v_user_parse ($this->data['ddbcontentor_docs_owner_id'],$f_user_array,$f_prefix."owner");
			}
			else
			{
$f_user_array = array (
$f_prefix."ownerid" => "",
$f_prefix."ownername" => "",
$f_prefix."ownerpageurl" => "",
$f_prefix."ownertype" => direct_local_get ("core_unknown"),
$f_prefix."ownertitle" => "",
$f_prefix."owneravatar" => "",
$f_prefix."owneravatar_small" => "",
$f_prefix."owneravatar_large" => "",
$f_prefix."ownerrating" => direct_local_get ("core_unknown"),
$f_prefix."ownersignature" => ""
);
			}

			$f_return = array_merge ($f_return,$f_user_array);

			if (($this->data['ddbcontentor_docs_author_id'])&&($this->data['author_name']))
			{
$f_user_array = array (
"ddbusers_type" => $this->data['author_type'],
"ddbusers_banned" => $this->data['author_banned'],
"ddbusers_deleted" => $this->data['author_deleted'],
"ddbusers_name" => $this->data['author_name'],
"ddbusers_title" => $this->data['author_title'],
"ddbusers_avatar" => $this->data['author_avatar'],
"ddbusers_signature" => $this->data['author_signature'],
"ddbusers_rating" => $this->data['author_rating']
);

				$f_user_array = $direct_classes['kernel']->v_user_parse ($this->data['ddbcontentor_docs_author_id'],$f_user_array,$f_prefix."author");
			}
			else
			{
$f_user_array = array (
$f_prefix."authorid" => "",
$f_prefix."authorname" => "",
$f_prefix."authorpageurl" => "",
$f_prefix."authortype" => direct_local_get ("core_unknown"),
$f_prefix."authortitle" => "",
$f_prefix."authoravatar" => "",
$f_prefix."authoravatar_small" => "",
$f_prefix."authoravatar_large" => "",
$f_prefix."authorrating" => direct_local_get ("core_unknown"),
$f_prefix."authorsignature" => ""
);
			}

			$f_return = array_merge ($f_return,$f_user_array);

			if ($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']) > 3)
			{
				$f_return[$f_prefix."ownerip"] = $this->data['ddbcontentor_docs_owner_ip'];
				$f_return[$f_prefix."authorip"] = $this->data['ddbcontentor_docs_author_ip'];
			}
			else
			{
				$f_return[$f_prefix."ownerip"] = "";
				$f_return[$f_prefix."authorip"] = "";
			}

			if ($this->data['ddbdatalinker_symbol'])
			{
				$f_symbol_path = $direct_classes['basic_functions']->varfilter ($direct_settings['contentor_datacenter_path_symbols'],"settings");
				$f_return[$f_prefix."symbol"] = direct_linker_dynamic ("url0","s=cache&dsd=dfile+".$f_symbol_path.$this->data['ddbdatalinker_symbol'],true,false);
			}
			else { $f_return[$f_prefix."symbol"] = ""; }

			if ($this->data['ddbcontentor_docs_time']) { $f_return[$f_prefix."time"] = $direct_classes['basic_functions']->datetime ("longdate&time",$this->data['ddbcontentor_docs_time'],$direct_settings['user']['timezone'],(direct_local_get ("datetime_dtconnect"))); }
			else { $f_return[$f_prefix."time"] = direct_local_get ("core_unknown"); }

			if ($this->data['ddbdatalinker_sorting_date']) { $f_return[$f_prefix."pubtime"] = $direct_classes['basic_functions']->datetime ("longdate&time",$this->data['ddbdatalinker_sorting_date'],$direct_settings['user']['timezone'],(direct_local_get ("datetime_dtconnect"))); }
			else { $f_return[$f_prefix."pubtime"] = direct_local_get ("core_unknown"); }

			$f_return[$f_prefix."desc"] = $direct_classes['formtags']->decode ($this->data['ddbcontentor_docs_desc']);
			$f_return[$f_prefix."locked"] = $this->data_locked;

			if ($direct_cachedata['kernel_lastvisit'] < $this->data['ddbdatalinker_sorting_date']) { $f_return[$f_prefix."new"] = true; }
			else { $f_return[$f_prefix."new"] = false; }

			if ($this->data['ddbdatalinker_position'] > 0) { $f_return[$f_prefix."sticky"] = true; }
			else { $f_return[$f_prefix."sticky"] = false; }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->parse ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->set ($f_data)
/**
	* Sets (and overwrites existing) data for this document.
	*
	* @param  array $f_data Document data
	* @uses   direct_contentor_doc::get_rights()
	* @uses   direct_datalinker::set()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function set ($f_data)
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -contentor_doc->set (+f_data)- (#echo(__LINE__)#)"); }

		$f_return = parent::set ($f_data);

		if (($f_return)&&(isset ($f_data['ddbcontentor_docs_time'],$f_data['ddbcontentor_docs_desc'],$f_data['ddbcontentor_docs_doctype'],$f_data['ddbcontentor_docs_locked'],$f_data['ddbcontentor_docs_public'],$f_data['ddbdata_mode_user'],$f_data['ddbdata_mode_group'],$f_data['ddbdata_mode_all'])))
		{
			if (!isset ($f_data['ddbcontentor_docs_id_front'])) { $f_data['ddbcontentor_docs_id_front'] = ""; }
			if (!isset ($f_data['ddbdata_sid'])) { $f_data['ddbdata_sid'] = $f_data['ddbdatalinker_sid']; }

			if (!isset ($f_data['ddbcontentor_docs_owner_id'],$f_data['ddbcontentor_docs_owner_ip']))
			{
				$f_data['ddbcontentor_docs_owner_id'] = "";
				$f_data['ddbcontentor_docs_owner_ip'] = "";
			}
			elseif (!isset ($f_data['owner_type'],$f_data['owner_banned'],$f_data['owner_deleted'],$f_data['owner_name'],$f_data['owner_title'],$f_data['owner_avatar'],$f_data['owner_signature'],$f_data['owner_rating']))
			{
				$f_user_array = $direct_classes['kernel']->v_user_get ($f_data['ddbcontentor_docs_owner_id']);

				if ($f_user_array)
				{
					$f_data['owner_type'] = $f_user_array['ddbusers_type'];
					$f_data['owner_banned'] = $f_user_array['ddbusers_banned'];
					$f_data['owner_deleted'] = $f_user_array['ddbusers_deleted'];
					$f_data['owner_name'] = $f_user_array['ddbusers_deleted'];
					$f_data['owner_title'] = $f_user_array['ddbusers_title'];
					$f_data['owner_avatar'] = $f_user_array['ddbusers_avatar'];
					$f_data['owner_signature'] = $f_user_array['ddbusers_signature'];
					$f_data['owner_rating'] = $f_user_array['ddbusers_rating'];
				}
			}

			if ((!$direct_settings['swg_ip_save2db'])&&(strlen ($f_data['ddbcontentor_docs_owner_ip']))) { $f_data['ddbcontentor_docs_owner_ip'] = "unknown"; }

			if (!isset ($f_data['ddbcontentor_docs_author_id'],$f_data['ddbcontentor_docs_author_ip']))
			{
				$f_data['ddbcontentor_docs_author_id'] = "";
				$f_data['ddbcontentor_docs_author_ip'] = "";
			}
			elseif (!isset ($f_data['author_type'],$f_data['author_banned'],$f_data['author_deleted'],$f_data['author_name'],$f_data['author_title'],$f_data['author_avatar'],$f_data['author_signature'],$f_data['author_rating']))
			{
				$f_user_array = $direct_classes['kernel']->v_user_get ($f_data['ddbcontentor_docs_author_id']);

				if ($f_user_array)
				{
					$f_data['author_type'] = $f_user_array['ddbusers_type'];
					$f_data['author_banned'] = $f_user_array['ddbusers_banned'];
					$f_data['author_deleted'] = $f_user_array['ddbusers_deleted'];
					$f_data['author_name'] = $f_user_array['ddbusers_deleted'];
					$f_data['author_title'] = $f_user_array['ddbusers_title'];
					$f_data['author_avatar'] = $f_user_array['ddbusers_avatar'];
					$f_data['author_signature'] = $f_user_array['ddbusers_signature'];
					$f_data['author_rating'] = $f_user_array['ddbusers_rating'];
				}
			}

			if ((!$direct_settings['swg_ip_save2db'])&&(strlen ($f_data['ddbcontentor_docs_author_ip']))) { $f_data['ddbcontentor_docs_author_ip'] = "unknown"; }

			if (isset ($f_data['ddbdata_data']))
			{
				$this->get_document_structure ($f_data['ddbdata_data']);
				if ((!isset ($f_data['ddbcontentor_docs_pages']))||($f_data['ddbcontentor_docs_pages'] == NULL)) { $f_data['ddbcontentor_docs_pages'] = count ($this->data_pages); }
			}
			else { $f_data['ddbcontentor_docs_pages'] = NULL; }

$f_attributes = array ("ddbcontentor_docs_id_front","ddbcontentor_docs_owner_id","ddbcontentor_docs_owner_ip","ddbcontentor_docs_author_id","ddbcontentor_docs_author_ip","ddbcontentor_docs_time","ddbcontentor_docs_desc","ddbcontentor_docs_doctype","ddbcontentor_docs_pages","ddbcontentor_docs_locked","ddbcontentor_docs_public",
"ddbdata_sid","ddbdata_mode_user","ddbdata_mode_group","ddbdata_mode_all","owner_type","owner_banned","owner_deleted","owner_name","owner_title","owner_avatar","owner_signature","owner_rating","author_type","author_banned","author_deleted","author_name","author_title","author_avatar","author_signature","author_rating");

			if (isset ($f_data['ddbdata_data'])) { $f_attributes[] = "ddbdata_data"; }

			$this->set_extras ($f_data,$f_attributes);
			$this->data_cid = $this->data['ddbdatalinker_id_main'];

			if ($this->data['ddbcontentor_docs_locked']) { $this->data_locked = true; }
			else { $this->data_locked = false; }

			$f_result_array = $this->get_rights ();
			$this->data_readable = $f_result_array[0];
			$this->data_readable_group = $f_result_array[1];
			$this->data_writable = $f_result_array[2];
			$this->data_writable_group = $f_result_array[3];

			if ((!$this->data['ddbcontentor_docs_public'])&&(empty ($this->data['ddbcontentor_docs_owner_id']))) { $this->data_published = false; }
			if ((!$this->data_readable)&&(!$this->data_readable_group)) { $f_return = false; }
		}
		else { $f_return = false; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->set ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->set_update ($f_data,$f_doc_content = true,$f_doc_settings = true)
/**
	* Updates (and overwrites) the existing DataLinker entry and saves it to the
	* database. Note: If "set()" fails because of permission problems 
	* "update()" has to be called manually to write data to the database.
	* Please make sure that this is the intended behavior. You can use
	* "is_empty()" to check for the current data state of this object.
	*
	* @param  array $f_data Document data
	* @param  boolean $f_doc_content True to update the data entry
	* @param  boolean $f_doc_settings True to update the settings entry
	* @uses   direct_contentor_doc::set()
	* @uses   direct_contentor_doc::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @since  v0.1.00
*/
	public function set_update ($f_data,$f_doc_content = true,$f_doc_settings = true)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->set_update (+f_data,+f_doc_content,+f_doc_settings)- (#echo(__LINE__)#)"); }

		if ($this->set ($f_data))
		{
			$this->data_insert_mode = false;
			return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->set_update ()- (#echo(__LINE__)#)",(:#*/$this->update ($f_doc_content,$f_doc_settings)/*#ifdef(DEBUG):),true):#*/;
		}
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->set_update ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
	}

	//f// direct_contentor_doc->update ($f_doc_content = true,$f_doc_settings = true,$f_insert_mode_deactivate = true)
/**
	* Writes the object data to the database.
	*
	* @param  boolean $f_doc_content True to update the data entry
	* @param  boolean $f_doc_settings True to update the settings entry
	* @param  boolean $f_insert_mode_deactivate Deactive insert mode after calling
	*         update ()
	* @uses   direct_db::define_values()
	* @uses   direct_db::define_values_keys()
	* @uses   direct_db::define_values_encode()
	* @uses   direct_db::init_replace()
	* @uses   direct_db::optimize_random()
	* @uses   direct_db::query_exec()
	* @uses   direct_db::v_transaction_begin()
	* @uses   direct_db::v_transaction_commit()
	* @uses   direct_db::v_transaction_rollback()
	* @uses   direct_dbsync_event()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function update ($f_doc_content = true,$f_doc_settings = true,$f_insert_mode_deactivate = true)
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->update (+f_doc_content,+f_doc_settings,+f_insert_mode_deactivate)- (#echo(__LINE__)#)"); }

		if (empty ($this->data_changed)) { $f_return = true; }
		else
		{
			$direct_classes['db']->v_transaction_begin ();
			$f_return = parent::update ($f_doc_settings,$f_doc_settings,false);

			if (($f_return)&&(count ($this->data) > 1))
			{
				if (($f_doc_settings)&&($this->is_changed (array ("ddbcontentor_docs_id_front","ddbcontentor_docs_owner_id","ddbcontentor_docs_owner_ip","ddbcontentor_docs_author_id","ddbcontentor_docs_author_ip","ddbcontentor_docs_time","ddbcontentor_docs_desc","ddbcontentor_docs_doctype","ddbcontentor_docs_pages","ddbcontentor_docs_locked","ddbcontentor_docs_public"))))
				{
					if ($this->data['ddbcontentor_docs_pages'] == NULL) { $f_return = false; }
					else
					{
						if ($this->data_insert_mode) { $direct_classes['db']->init_insert ($direct_settings['contentor_docs_table']); }
						else { $direct_classes['db']->init_update ($direct_settings['contentor_docs_table']); }

						$f_update_values = "<sqlvalues>";
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdatalinker_id_object']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_id",$this->data['ddbdatalinker_id_object'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_id_front']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_id_front",$this->data['ddbcontentor_docs_id_front'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_owner_id']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_owner_id",$this->data['ddbcontentor_docs_owner_id'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_owner_ip']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_owner_ip",$this->data['ddbcontentor_docs_owner_ip'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_author_id']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_author_id",$this->data['ddbcontentor_docs_author_id'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_author_ip']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_author_ip",$this->data['ddbcontentor_docs_author_ip'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_time']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_time",$this->data['ddbcontentor_docs_time'],"number"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_desc']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_desc",$this->data['ddbcontentor_docs_desc'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_doctype']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_doctype",$this->data['ddbcontentor_docs_doctype'],"string"); }
						$f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_pages",(count ($this->data_pages)),"number");
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_locked']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_locked",$this->data['ddbcontentor_docs_locked'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_public']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_public",$this->data['ddbcontentor_docs_public'],"string"); }
						$f_update_values .= "</sqlvalues>";

						$direct_classes['db']->define_set_attributes ($f_update_values);
						if (!$this->data_insert_mode) { $direct_classes['db']->define_row_conditions ("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>"); }
						$f_return = $direct_classes['db']->query_exec ("co");

						if ($f_return)
						{
							if (function_exists ("direct_dbsync_event"))
							{
								if ($this->data_insert_mode) { direct_dbsync_event ($direct_settings['contentor_docs_table'],"insert",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>")); }
								else { direct_dbsync_event ($direct_settings['contentor_docs_table'],"update",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>")); }
							}

							if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->optimize_random ($direct_settings['contentor_docs_table']); }
						}
					}
				}

				if (($f_return)&&($f_doc_content)&&($this->is_changed (array ("ddbdatalinker_id_main","ddbcontentor_docs_owner_id","ddbdata_data","ddbdata_mode_user","ddbdata_mode_group","ddbdata_mode_all"))))
				{
					if (isset ($this->data['ddbdata_data']))
					{
						if ($this->data_insert_mode) { $direct_classes['db']->init_insert ($direct_settings['data_table']); }
						else { $direct_classes['db']->init_update ($direct_settings['data_table']); }

						$f_update_values = "<sqlvalues>";
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdatalinker_id_object']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_id",$this->data['ddbdatalinker_id_object'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdatalinker_id_main']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_id_cat",$this->data['ddbdatalinker_id_main'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_docs_owner_id']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_owner",$this->data['ddbcontentor_docs_owner_id'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdata_data']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_data",$this->data['ddbdata_data'],"string"); }
						if ($this->data_insert_mode) { $f_update_values .= "<element1 attribute='{$direct_settings['data_table']}.ddbdata_sid' value='{$this->data_sid}' type='string' />"; }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdata_mode_user']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_mode_user",$this->data['ddbdata_mode_user'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdata_mode_group']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_mode_group",$this->data['ddbdata_mode_group'],"string"); }
						if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdata_mode_all']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['data_table'].".ddbdata_mode_all",$this->data['ddbdata_mode_all'],"string"); }
						$f_update_values .= "</sqlvalues>";

						$direct_classes['db']->define_set_attributes ($f_update_values);
						if (!$this->data_insert_mode) { $direct_classes['db']->define_row_conditions ("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['data_table'].".ddbdata_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>"); }
						$f_return = $direct_classes['db']->query_exec ("co");

						if ($f_return)
						{
							if (function_exists ("direct_dbsync_event"))
							{
								if ($this->data_insert_mode) { direct_dbsync_event ($direct_settings['data_table'],"insert",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['data_table'].".ddbdata_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>")); }
								else { direct_dbsync_event ($direct_settings['data_table'],"update",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['data_table'].".ddbdata_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>")); }
							}

							if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->optimize_random ($direct_settings['data_table']); }
						}
					}
					else { $f_return = false; }
				}
			}

			if (($f_insert_mode_deactivate)&&($this->data_insert_mode)) { $this->data_insert_mode = false; }

			if ($f_return) { $direct_classes['db']->v_transaction_commit (); }
			else { $direct_classes['db']->v_transaction_rollback (); }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->update ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_doc->update_latest_version ()
/**
	* Prepare the database for this document to become the latest version.
	*
	* @uses   direct_db::define_row_conditions()
	* @uses   direct_db::define_row_conditions_encode()
	* @uses   direct_db::define_set_attributes()
	* @uses   direct_db::define_set_attributes_encode()
	* @uses   direct_db::init_update()
	* @uses   direct_db::optimize_random()
	* @uses   direct_db::query_exec()
	* @uses   direct_db::v_transaction_begin()
	* @uses   direct_db::v_transaction_commit()
	* @uses   direct_db::v_transaction_rollback()
	* @uses   direct_dbsync_event()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function update_latest_version ()
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_doc->update_latest_version ()- (#echo(__LINE__)#)"); }

		$f_return = $direct_classes['db']->v_transaction_begin ();

		if (count ($this->data) > 1)
		{
			$direct_classes['db']->init_update ($direct_settings['datalinker_table']);

$f_update_values = ("<sqlvalues>
".($direct_classes['db']->define_set_attributes_encode ($direct_settings['datalinker_table'].".ddbdatalinker_id",(uniqid ("")),"string"))."
".($direct_classes['db']->define_set_attributes_encode ($direct_settings['datalinker_table'].".ddbdatalinker_id_parent",$this->data['ddbdatalinker_id'],"string"))."
<element1 attribute='{$direct_settings['datalinker_table']}.ddbdatalinker_type' value='3' type='number' />
</sqlvalues>");

			$direct_classes['db']->define_set_attributes ($f_update_values);

			$f_update_criteria = "<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinker_table'].".ddbdatalinker_id",$this->data['ddbdatalinker_id'],"string"))."</sqlconditions>";
			$direct_classes['db']->define_row_conditions ($f_update_criteria);

			$f_return = $direct_classes['db']->query_exec ("co");

			if ($f_return)
			{
				if (function_exists ("direct_dbsync_event")) { direct_dbsync_event ($direct_settings['datalinker_table'],"update",$f_update_criteria); }
				if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->optimize_random ($direct_settings['datalinker_table']); }

				$direct_classes['db']->init_update ($direct_settings['datalinkerd_table']);

$f_update_values = ("<sqlvalues>
<element1 attribute='{$direct_settings['datalinkerd_table']}.ddbdatalinker_subs' value='0' type='number' />
<element2 attribute='{$direct_settings['datalinkerd_table']}.ddbdatalinker_objects' value='0' type='number' />
</sqlvalues>");

				$direct_classes['db']->define_set_attributes ($f_update_values);

				$f_update_criteria = "<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinkerd_table'].".ddbdatalinkerd_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>";
				$direct_classes['db']->define_row_conditions ($f_update_criteria);

				$f_return = $direct_classes['db']->query_exec ("co");
			}

			if ($f_return)
			{
				if (function_exists ("direct_dbsync_event")) { direct_dbsync_event ($direct_settings['datalinkerd_table'],"update",$f_update_criteria); }
				if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->optimize_random ($direct_settings['datalinkerd_table']); }
			}
		}

		if ($f_return) { $direct_classes['db']->v_transaction_commit (); }
		else { $direct_classes['db']->v_transaction_rollback (); }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_doc->update_latest_version ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}
}

/* -------------------------------------------------------------------------
Mark this class as the most up-to-date one
------------------------------------------------------------------------- */

define ("CLASS_direct_contentor_doc",true);

//j// Script specific commands

if (!isset ($direct_settings['contentor_datacenter_path_symbols'])) { $direct_settings['contentor_datacenter_path_symbols'] = $direct_settings['path_themes']."/$direct_settings[theme]/"; }
if (!isset ($direct_settings['swg_auto_maintenance'])) { $direct_settings['swg_auto_maintenance'] = false; }
if (!isset ($direct_settings['swg_ip_save2db'])) { $direct_settings['swg_ip_save2db'] = true; }
}

//j// EOF
?>