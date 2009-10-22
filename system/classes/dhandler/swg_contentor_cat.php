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

$g_continue_check = ((defined ("CLASS_direct_contentor_cat")) ? false : true);
if (!defined ("CLASS_direct_datalinker")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_datalinker.php"); }
if (!defined ("CLASS_direct_datalinker")) { $g_continue_check = false; }

if ($g_continue_check)
{
//c// direct_contentor_cat
/**
* This abstraction layer provides category (contentor) specific functions.
*
* @author     direct Netware Group
* @copyright  (C) direct Netware Group - All rights reserved
* @package    sWG
* @subpackage contentor
* @uses       CLASS_direct_datalinker
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/
class direct_contentor_cat extends direct_datalinker
{
/**
	* @var array $class_cats Cached sub category objects
*/
	protected $class_cats;
/**
	* @var array $class_docs Cached document objects
*/
	protected $class_docs;
/**
	* @var boolean $data_diversity_dms True if this category is a diversity
	*      Document Management System (DMS)
*/
	protected $data_diversity_dms;
/**
	* @var string $data_doctype Optional required doctype for this category
*/
	protected $data_doctype;
/**
	* @var boolean $data_locked True if this category is locked
*/
	protected $data_locked;
/**
	* @var boolean $data_moderated True if this category is a moderated one
*/
	protected $data_moderated;
/**
	* @var boolean $data_moderator True if the user is a moderator for this
	*      category
*/
	protected $data_moderator;
/**
	* @var boolean $data_readable True if the current user is allowed to read
	*      documents in this category
*/
	protected $data_readable;
/**
	* @var boolean $data_writable True if the current user is allowed to
	*      create new and edit his own documents in this category
*/
	protected $data_writable;
/**
	* @var boolean $data_writable_as_submission True if the current user is
	*      allowed to submit new documents in this category
*/
	protected $data_writable_as_submission;

/* -------------------------------------------------------------------------
Extend the class
------------------------------------------------------------------------- */

	//f// direct_contentor_cat->__construct ()
/**
	* Constructor (PHP5) __construct (direct_contentor_cat)
	*
	* @uses  direct_basic_functions::include_file()
	* @uses  direct_class_init()
	* @uses  direct_debug()
	* @uses  USE_debug_reporting
	* @since v0.1.00
*/
	public function __construct ()
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->__construct (direct_contentor_cat)- (#echo(__LINE__)#)"); }

		if (!defined ("CLASS_direct_contentor_doc")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_doc.php"); }
		if (!defined ("CLASS_direct_formtags")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/swg_formtags.php"); }
		if (!isset ($direct_classes['formtags'])) { direct_class_init ("formtags"); }

/* -------------------------------------------------------------------------
My parent should be on my side to get the work done
------------------------------------------------------------------------- */

		parent::__construct ();

/* -------------------------------------------------------------------------
Informing the system about available functions 
------------------------------------------------------------------------- */

		$this->functions['add_docs'] = true;
		$this->functions['define_doctype'] = true;
		$this->functions['define_lock'] = true;
		$this->functions['define_readable'] = true;
		$this->functions['define_writable'] = true;
		$this->functions['delete'] = false;
		$this->functions['get_docs'] = defined ("CLASS_direct_contentor_doc");
		$this->functions['get_rights'] = true;
		$this->functions['get_subcats'] = true;
		$this->functions['insert_link'] = false;
		$this->functions['is_diversity_dms'] = true;
		$this->functions['is_locked'] = true;
		$this->functions['is_moderated'] = true;
		$this->functions['is_moderator'] = true;
		$this->functions['is_readable'] = true;
		$this->functions['is_writable'] = true;
		$this->functions['is_writable_as_submission'] = true;
		$this->functions['parse'] = isset ($direct_classes['formtags']);
		$this->functions['remove_docs'] = true;

/* -------------------------------------------------------------------------
Set up an additional variables :)
------------------------------------------------------------------------- */

		$this->class_cats = array ();
		$this->class_docs = array ();
		$this->data_diversity_dms = false;
		$this->data_doctype = "";
		$this->data_locked = false;
		$this->data_moderated = false;
		$this->data_moderator = false;
		$this->data_readable = false;
		$this->data_sid = "87ecbe0ba0a0b3c7e60030043614e655";
		$this->data_writable = false;
		$this->data_writable_as_submission = false;
	}

	//f// direct_contentor_cat->add_docs ($f_count,$f_update = true)
/**
	* Increases the document counter.
	*
	* @param  number $f_count Number to be added to the document counter
	* @param  boolean $f_update True to update the database entry
	* @uses   direct_datalinker::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function add_docs ($f_count,$f_update = true)
	{
		if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -contentor_cat->add_docs ($f_count,+f_update)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -contentor_cat->add_docs ()- (#echo(__LINE__)#)",(:#*/$this->add_objects ($f_count,$f_update)/*#ifdef(DEBUG):),true):#*/;
	}

	//f// direct_contentor_cat->define_doctype ($f_doctype)
/**
	* Sets the required document type.
	*
	* @param  string $f_doctype Document type
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return string Accepted document type
	* @since  v0.1.00
*/
	public function define_doctype ($f_doctype)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->define_doctype ($f_doctype)- (#echo(__LINE__)#)"); }

		if (is_string ($f_doctype)) { $this->data_doctype = (($f_doctype != "all") ? $f_doctype : ""); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->define_doctype ()- (#echo(__LINE__)#)",:#*/$this->data_doctype/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->define_lock ($f_state = NULL,$f_update = false)
/**
	* Sets the locking state of this category.
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
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->define_lock (+f_state,+f_update)- (#echo(__LINE__)#)"); }
		$f_return = false;

		if (count ($this->data) > 1)
		{
			if (((is_bool ($f_state))||(is_string ($f_state)))&&($f_state)) { $f_return = true; }
			elseif (($f_state === NULL)&&(!$this->data['ddbcontentor_cats_locked'])) { $f_return = true; }

			$this->data['ddbcontentor_cats_locked'] = ($f_return ? 1 : 0);
			$this->data_changed['ddbcontentor_cats_locked'] = true;
			if ($f_update) { $this->update (); }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->define_lock ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->define_readable ($f_state = NULL)
/**
	* Sets the reading right state of this category.
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
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->define_readable (+f_state)- (#echo(__LINE__)#)"); }

		if (((is_bool ($f_state))||(is_string ($f_state)))&&($f_state)) { $this->data_readable = true; }
		elseif (($f_state === NULL)&&(!$this->data_readable)) { $this->data_readable = true; }
		else { $this->data_readable = false; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->define_readable ()- (#echo(__LINE__)#)",:#*/$this->data_readable/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->define_writable ($f_state = NULL)
/**
	* Sets the writing right state of this category.
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
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->define_writable (+f_state)- (#echo(__LINE__)#)"); }

		if (((is_bool ($f_state))||(is_string ($f_state)))&&($f_state)) { $this->data_writable = true; }
		elseif (($f_state === NULL)&&(!$this->data_writable)) { $this->data_writable = true; }
		else { $this->data_writable = false; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->define_writable ()- (#echo(__LINE__)#)",:#*/$this->data_writable/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->delete ($f_link_data = true,$f_data = true)
/**
	* Delete the object from the database.
	*
	* @param  boolean $f_link_data Delete *_datalinker if true
	* @param  boolean $f_data Delete *_datalinkerd if true
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean Always false; TODO: Code me
	* @since  v0.1.00
*/
	public function delete ($f_link_data = true,$f_data = true)
	{
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -contentor_cat->delete (+f_link_data,+f_data)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->delete ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->get_aid ($f_attributes = NULL,$f_values = "")
/**
	* Request and load the category object based on a custom attribute ID.
	* Please note that only attributes of type "string" are supported.
	*
	* @param  mixed $f_attributes Attribute name(s) (array or string)
	* @param  mixed $f_values Attribute value(s) (array or string)
	* @uses   direct_contentor_cat::get_rights()
	* @uses   direct_datalinker::define_extra_attributes()
	* @uses   direct_datalinker::define_extra_conditions()
	* @uses   direct_datalinker::define_extra_joins()
	* @uses   direct_datalinker::get_aid()
	* @uses   direct_db::define_row_conditions_encode()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return mixed Category data array; false on error
	* @since  v0.1.00
*/
	public function get_aid ($f_attributes = NULL,$f_values = "")
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -contentor_cat->get_aid (+f_attributes,+f_values)- (#echo(__LINE__)#)"); }

		$f_return = false;

		if (count ($this->data) > 1) { $f_return = $this->data; }
		elseif ((is_array ($f_values))||(is_string ($f_values)))
		{
			$this->define_extra_attributes ($direct_settings['contentor_cats_table'].".*");
			$this->define_extra_joins (array (array ("type" => "left-outer-join","table" => $direct_settings['contentor_cats_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['contentor_cats_table']}.ddbcontentor_cats_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>")));
			if (strlen ($this->data_doctype)) { $this->define_extra_conditions ($direct_classes['db']->define_row_conditions_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_doctype",$this->data_doctype,"string")); }
			$f_result_array = parent::get_aid ($f_attributes,$f_values);

			if (($f_result_array)&&($f_result_array['ddbdatalinker_sid'] == $this->data_sid)&&(isset ($f_result_array['ddbcontentor_cats_id'])))
			{
				$this->data = $f_result_array;
				$this->data_locked = ($this->data['ddbcontentor_cats_locked'] ? true : false);

				$f_result_array = $this->get_rights ();
				$this->data_readable = $f_result_array[0];
				$this->data_writable = $f_result_array[1];
				$this->data_moderator = $f_result_array[2];

				if ($this->data['ddbcontentor_cats_vcontrol']) { $this->data_diversity_dms = true; }

				if ($this->data['ddbcontentor_cats_moderated'])
				{
					$this->data_moderated = true;
					if (($this->data_writable)&&(!$this->data_moderator)) { $this->data_writable_as_submission = true; }
				}

				if ($this->data_readable) { $f_return = $this->data; }
			}
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->get_aid ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->get_docs ($f_offset = 0,$f_perpage = "",$f_sorting_mode = "title-sticky-asc",$f_frontpage_mode = false)
/**
	* Returns all subobjects for the DataLinker with the given service ID and
	* type.
	*
	* @param  integer $f_offset Offset for the result list
	* @param  integer $f_perpage Object count limit for the result list
	* @param  string $f_sorting_mode Sorting algorithm
	* @param  boolean $f_frontpage_mode True to show elements from subcategories
	*         if this is their frontpage ID.
	* @uses   direct_datalinker::define_extra_attributes()
	* @uses   direct_datalinker::define_extra_conditions()
	* @uses   direct_datalinker::define_extra_joins()
	* @uses   direct_datalinker::get_subs()
	* @uses   direct_db::define_row_conditions_encode()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return array Array with pointers to the documents
	* @since  v0.1.00
*/
	public function get_docs ($f_offset = 0,$f_perpage = "",$f_sorting_mode = "title-sticky-asc",$f_frontpage_mode = false)
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->get_docs ($f_offset,$f_perpage,$f_sorting_mode,+f_frontpage_mode)- (#echo(__LINE__)#)"); }

		$f_return = array ();
		$f_cache_signature = ($f_frontpage_mode ? md5 ($this->data['ddbdatalinker_id_object']."1".$f_offset.$f_perpage.$f_sorting_mode) : md5 ($this->data['ddbdatalinker_id_object']."0".$f_offset.$f_perpage.$f_sorting_mode));

		if (isset ($this->class_docs[$f_cache_signature])) { $f_return =& $this->class_docs[$f_cache_signature]; }
		elseif (isset ($this->data['ddbdatalinker_id_object']))
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

			if ($f_frontpage_mode)
			{
$f_select_criteria = ("<sub1 type='sublevel'>
".($direct_classes['db']->define_row_conditions_encode ($direct_settings['datalinker_table'].".ddbdatalinker_id_main",$this->data['ddbdatalinker_id_object'],"string","==","or"))."
".($direct_classes['db']->define_row_conditions_encode ($direct_settings['contentor_docs_table'].".ddbcontentor_docs_id_front",$this->data['ddbdatalinker_id_object'],"string","==","or"))."
</sub1>");

				$this->define_extra_conditions ($f_select_criteria);			
				$this->class_docs[$f_cache_signature] = parent::get_subs ("direct_contentor_doc",NULL,NULL,"87ecbe0ba0a0b3c7e60030043614e655",2,$f_offset,$f_perpage,$f_sorting_mode);
				// md5 ("contentor")
			}
			else { $this->class_docs[$f_cache_signature] = parent::get_subs ("direct_contentor_doc",$this->data['ddbdatalinker_id_object'],NULL,"87ecbe0ba0a0b3c7e60030043614e655",2,$f_offset,$f_perpage,$f_sorting_mode); }

			$f_return =& $this->class_docs[$f_cache_signature];
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->get_docs ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->get_rights ()
/**
	* Check the user rights based on the defined object.
	*
	* @uses   direct_debug()
	* @uses   direct_kernel_system::v_group_user_check_group()
	* @uses   direct_kernel_system::v_group_user_check_right()
	* @uses   direct_kernel_system::v_usertype_get_int()
	* @uses   USE_debug_reporting
	* @return array Array with the results to read, write and moderate
	* @since  v0.1.00
*/
	protected function get_rights ()
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->get_rights ()- (#echo(__LINE__)#)"); }

		$f_return = array (false,false,false);

		if ($direct_settings['user']['type'] == "mo")
		{
			if (!$this->data_locked) { $f_return[2] = $direct_classes['kernel']->v_group_user_check_right ("contentor_{$this->data['ddbdatalinker_id_object']}_moderate"); }
			$f_return[0] = $f_return[2];
		}
		elseif ($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']) > 3)
		{
			$f_return[0] = true;
			$f_return[2] = true;
		}

		if ($f_return[2]) { $f_return[1] = true; }
		elseif ($this->data['ddbcontentor_cats_public'])
		{
			$f_return[0] = true;
			if (($this->data['ddbcontentor_cats_submissions'])&&(!$this->data_locked)&&($direct_settings['user']['type'] != "gt")) { $f_return[1] = true; }
		}
		else
		{
			$f_return[0] = $direct_classes['kernel']->v_group_user_check_right ("contentor_{$this->data['ddbdatalinker_id_object']}_read");

			if (!$this->data_locked) { $f_return[1] = $direct_classes['kernel']->v_group_user_check_right ("contentor_{$this->data['ddbdatalinker_id_object']}_write"); }
			if ($f_return[1]) { $f_return[0] = true; }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->get_rights ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// ->get_subcats ($f_offset = 0,$f_perpage = "",$f_sorting_mode = "title-sticky-asc")
/**
	* Returns all subobjects for the DataLinker with the given service ID and
	* type.
	*
	* @param  integer $f_offset Offset for the result list
	* @param  integer $f_perpage Object count limit for the result list
	* @param  string $f_sorting_mode Sorting algorithm
	* @uses   direct_datalinker::define_extra_attributes()
	* @uses   direct_datalinker::define_extra_conditions()
	* @uses   direct_datalinker::define_extra_joins()
	* @uses   direct_datalinker::get_subs()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return string Filtered string
	* @since  v0.1.00
*/
	public function get_subcats ($f_offset = 0,$f_perpage = "",$f_sorting_mode = "title-sticky-asc")
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->get_subcats ($f_offset,$f_perpage,$f_sorting_mode)- (#echo(__LINE__)#)"); }

		$f_return = array ();
		$f_cache_signature = md5 ($this->data['ddbdatalinker_id_object'].$f_offset.$f_perpage.$f_sorting_mode);

		if (isset ($this->class_cats[$f_cache_signature])) { $f_return =& $this->class_cats[$f_cache_signature]; }
		elseif (isset ($this->data['ddbdatalinker_id_object']))
		{
			$this->define_extra_attributes ($direct_settings['contentor_cats_table'].".*");
			$this->define_extra_joins (array (array ("type" => "left-outer-join","table" => $direct_settings['contentor_cats_table'],"condition" => "<sqlconditions><element1 attribute='{$direct_settings['contentor_cats_table']}.ddbcontentor_cats_id' value='{$direct_settings['datalinker_table']}.ddbdatalinker_id_object' type='attribute' /></sqlconditions>")));
			if (strlen ($this->data_doctype)) { $this->define_extra_conditions ($direct_classes['db']->define_row_conditions_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_doctype",$this->data_doctype,"string")); }

			$this->class_cats[$f_cache_signature] =& parent::get_subs ("direct_contentor_cat",NULL,$this->data['ddbdatalinker_id_object'],$this->data_sid,1,$f_offset,$f_perpage,$f_sorting_mode);
			// md5 ("contentor")

			$f_return =& $this->class_cats[$f_cache_signature];
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->get_subcats ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->insert ($f_insert_mode_deactivate = true)
/**
	* Writes new object data to the database.
	*
	* @param  boolean $f_insert_mode_deactivate Deactive insert mode after calling
	*         update ()
	* @uses   direct_contentor_cat::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function insert ($f_insert_mode_deactivate = true)
	{
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -contentor_cat->insert (+f_insert_mode_deactivate)- (#echo(__LINE__)#)"); }
		$this->data_insert_mode = true;
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->insert ()- (#echo(__LINE__)#)",(:#*/$this->update ($f_insert_mode_deactivate)/*#ifdef(DEBUG):),true):#*/;
	}

	//f// direct_contentor_cat->insert_link ($f_insert_mode_deactivate = true)
/**
	* Writes new object data to the database.
	*
	* @param  boolean $f_insert_mode_deactivate Deactive insert mode after calling
	*         update ()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean Always false; this method is unsupported
	* @since  v0.1.00
*/
	public function insert_link ($f_insert_mode_deactivate = true)
	{
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -contentor_cat->insert_link (+f_insert_mode_deactivate)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->insert_link ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->is_diversity_dms ()
/**
	* Returns true if the category is a diversity DMS.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_diversity_dms ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_diversity_dms ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_diversity_dms ()- (#echo(__LINE__)#)",:#*/$this->data_diversity_dms/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->is_locked ()
/**
	* Returns true if the category is locked.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_locked ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_locked ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_locked ()- (#echo(__LINE__)#)",:#*/$this->data_locked/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->is_moderated ()
/**
	* Returns true if the category is moderated.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_moderated ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_moderated ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_moderated ()- (#echo(__LINE__)#)",:#*/$this->data_moderated/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->is_moderator ()
/**
	* Returns true if the current user is a moderator of this category.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_moderator ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_moderator ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_moderator ()- (#echo(__LINE__)#)",:#*/$this->data_moderator/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->is_readable ()
/**
	* Returns true if the current user is allowed to read documents in this
	* category.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_readable ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_readable ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_readable ()- (#echo(__LINE__)#)",:#*/$this->data_readable/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->is_writable ()
/**
	* Returns true if the current user is allowed to create new and edit his own
	* documents in this category.
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_writable ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_writable ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_writable ()- (#echo(__LINE__)#)",:#*/$this->data_writable/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->is_writable_as_submission ()
/**
	* Returns true if the current user is allowed to submit new documents in this
	* category
	*
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True or false
	* @since  v0.1.00
*/
	public function is_writable_as_submission ()
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_writable_as_submission ()- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->is_writable_as_submission ()- (#echo(__LINE__)#)",:#*/$this->data_writable_as_submission/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->parse ($f_connector,$f_connector_type = "url0",$f_prefix = "")
/**
	* Parses this category and returns valid (X)HTML.
	*
	* @param  string $f_connector Connector for links
	* @param  string $f_connector_type Linking mode: "url0" for internal links,
	*         "url1" for external ones, "form" to create hidden fields or
	*         "optical" to remove parts of a very long string.
	* @param  string $f_prefix Key prefix
	* @uses   direct_datalinker::parse()
	* @uses   direct_debug()
	* @uses   direct_formtags::decode()
	* @uses   direct_linker()
	* @uses   USE_debug_reporting
	* @return array Output data
	* @since  v0.1.00
*/
	public function parse ($f_connector,$f_connector_type = "url0",$f_prefix = "")
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->parse ($f_connector,$f_connector_type,$f_prefix)- (#echo(__LINE__)#)"); }

		$f_return = parent::parse ($f_prefix);

		if (($f_return)&&($this->data_readable)&&(count ($this->data) > 1))
		{
			$f_return[$f_prefix."id"] = "swgdhandlercontentorcat".$this->data['ddbdatalinker_id'];

			if (($f_connector_type != "asis")&&(strpos ($f_connector,"javascript:") === 0)) { $f_connector_type = "asis"; }

			$f_pageurl = str_replace ("[a]","list",$f_connector);
			$f_pageurl = (($f_connector_type == "asis") ? str_replace ("[oid]",$this->data['ddbdatalinker_id'],$f_pageurl) : str_replace ("[oid]","ccid+{$this->data['ddbdatalinker_id']}++",$f_pageurl));
			$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
			$f_return[$f_prefix."pageurl"] = direct_linker ($f_connector_type,$f_pageurl);

			if ($this->data['ddbdatalinker_id_parent'])
			{
				$f_pageurl = str_replace ("[a]","list",$f_connector);
				$f_pageurl = (($f_connector_type == "asis") ? str_replace ("[oid]",$this->data['ddbdatalinker_id_parent'],$f_pageurl) : str_replace ("[oid]","ccid+{$this->data['ddbdatalinker_id_parent']}++",$f_pageurl));
				$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
				$f_return[$f_prefix."pageurl_parent"] = direct_linker ($f_connector_type,$f_pageurl);
			}
			else { $f_return[$f_prefix."pageurl_parent"] = ""; }

			if ($this->data['ddbdatalinker_id_main'])
			{
				$f_pageurl = str_replace ("[a]","list",$f_connector);
				$f_pageurl = (($f_connector_type == "asis") ? str_replace ("[oid]",$this->data['ddbdatalinker_id_main'],$f_pageurl) : str_replace ("[oid]","ccid+{$this->data['ddbdatalinker_id_main']}++",$f_pageurl));
				$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
				$f_return[$f_prefix."pageurl_main"] = direct_linker ($f_connector_type,$f_pageurl);
			}
			else { $f_return[$f_prefix."pageurl_main"] = ""; }

			if ($this->data['ddbdatalinker_symbol'])
			{
				$f_symbol_path = $direct_classes['basic_functions']->varfilter ($direct_settings['contentor_datacenter_path_symbols'],"settings");
				$f_return[$f_prefix."symbol"] = direct_linker_dynamic ("url0","s=cache&dsd=dfile+".$f_symbol_path.$this->data['ddbdatalinker_symbol'],true,false);
			}
			else { $f_return[$f_prefix."symbol"] = ""; }

			$f_return[$f_prefix."desc"] = $direct_classes['formtags']->decode ($this->data['ddbcontentor_cats_desc']);

			$f_return[$f_prefix."docs"] = $f_return[$f_prefix."objects"];
			$f_return[$f_prefix."subcats"] = $f_return[$f_prefix."subs"];
			$f_return[$f_prefix."locked"] = $this->data_locked;
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->parse ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->remove_docs ($f_count,$f_update = true)
/**
	* Decreases the document counter.
	*
	* @param  number $f_count Number to be removed from the document counter
	* @param  boolean $f_update True to update the database entry
	* @uses   direct_datalinker::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function remove_docs ($f_count,$f_update = true)
	{
		if (USE_debug_reporting) { direct_debug (8,"sWG/#echo(__FILEPATH__)# -contentor_cat->remove_docs ($f_count,+f_update)- (#echo(__LINE__)#)"); }
		return /*#ifdef(DEBUG):direct_debug (9,"sWG/#echo(__FILEPATH__)# -contentor_cat->remove_docs ()- (#echo(__LINE__)#)",(:#*/$this->remove_objects ($f_count,$f_update)/*#ifdef(DEBUG):),true):#*/;
	}

	//f// direct_contentor_cat->set ($f_data)
/**
	* Sets (and overwrites existing) data for this category.
	*
	* @param  array $f_data Category data
	* @uses   direct_contentor_cat::get_rights()
	* @uses   direct_datalinker::set()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success (data valid and current user has read
	*         rights)
	* @since  v0.1.00
*/
	public function set ($f_data)
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->set (+f_data)- (#echo(__LINE__)#)"); }

		$f_return = parent::set ($f_data);

		if (($f_return)&&(isset ($f_data['ddbcontentor_cats_desc'],$f_data['ddbcontentor_cats_owner_group'],$f_data['ddbcontentor_cats_vcontrol'],$f_data['ddbcontentor_cats_front_page'],$f_data['ddbcontentor_cats_front_id'],$f_data['ddbcontentor_cats_doctype'],$f_data['ddbcontentor_cats_locked'],$f_data['ddbcontentor_cats_public'],$f_data['ddbcontentor_cats_moderated'],$f_data['ddbcontentor_cats_submissions'])))
		{
			$this->set_extras ($f_data,(array ("ddbcontentor_cats_desc","ddbcontentor_cats_owner_group","ddbcontentor_cats_vcontrol","ddbcontentor_cats_front_page","ddbcontentor_cats_front_id","ddbcontentor_cats_doctype","ddbcontentor_cats_locked","ddbcontentor_cats_public","ddbcontentor_cats_moderated","ddbcontentor_cats_submissions")));

			$this->data_locked = ($this->data['ddbcontentor_cats_locked'] ? true : false);

			$f_result_array = $this->get_rights ();
			$this->data_readable = $f_result_array[0];
			$this->data_writable = $f_result_array[1];
			$this->data_moderator = $f_result_array[2];

			if ($this->data['ddbcontentor_cats_vcontrol']) { $this->data_diversity_dms = true; }

			if ($this->data['ddbcontentor_cats_moderated'])
			{
				$this->data_moderated = true;
				if (($this->data_writable)&&(!$this->data_moderator)) { $this->data_writable_as_submission = true; }
			}

			if (!$this->data_readable) { $f_return = false; }
		}
		else { $f_return = false; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->set ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_contentor_cat->set_insert ($f_data,$f_insert_mode_deactivate = true)
/**
	* Sets (and overwrites existing) the DataLinker entry and saves it to the
	* database. Note: If "set()" fails because of permission problems 
	* "update()" has to be called manually to write data to the database.
	* Please make sure that this is the intended behavior. You can use
	* "is_empty()" to check for the current data state of this object.
	*
	* @param  array $f_data DataLinker entry
	* @param  boolean $f_insert_mode_deactivate Deactive insert mode after calling
	*         update ()
	* @uses   direct_contentor_cat::set()
	* @uses   direct_contentor_cat::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function set_insert ($f_data,$f_insert_mode_deactivate = true)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->set_insert (+f_data,+f_insert_mode_deactivate)- (#echo(__LINE__)#)"); }

		if ($this->set ($f_data))
		{
			$this->data_insert_mode = true;
			return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->set_insert ()- (#echo(__LINE__)#)",(:#*/$this->update ($f_insert_mode_deactivate)/*#ifdef(DEBUG):),true):#*/;
		}
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->set_insert ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
	}

	//f// direct_contentor_cat->set_update ($f_data)
/**
	* Updates (and overwrites) the existing DataLinker entry and saves it to the
	* database. Note: If "set()" fails because of permission problems 
	* "update()" has to be called manually to write data to the database.
	* Please make sure that this is the intended behavior. You can use
	* "is_empty()" to check for the current data state of this object.
	*
	* @param  array $f_data DataLinker entry
	* @uses   direct_contentor_cat::set()
	* @uses   direct_contentor_cat::update()
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return boolean True on success
	* @since  v0.1.00
*/
	public function set_update ($f_data)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -contentor_cat->set_update (+f_data)- (#echo(__LINE__)#)"); }

		if ($this->set ($f_data))
		{
			$this->data_insert_mode = false;
			return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->set_update ()- (#echo(__LINE__)#)",(:#*/$this->update ()/*#ifdef(DEBUG):),true):#*/;
		}
		else { return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->set_update ()- (#echo(__LINE__)#)",:#*/false/*#ifdef(DEBUG):,true):#*/; }
	}

	//f// direct_contentor_cat->update ($f_insert_mode_deactivate = true)
/**
	* Writes the category data to the database.
	*
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
	public function update ($f_insert_mode_deactivate = true)
	{
		global $direct_classes,$direct_settings;
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -contentor_cat->update (+f_insert_mode_deactivate)- (#echo(__LINE__)#)"); }

		if (empty ($this->data_changed)) { $f_return = true; }
		else
		{
			$direct_classes['db']->v_transaction_begin ();
			$f_return = parent::update (true,true,false);

			if (($f_return)&&(count ($this->data) > 1))
			{
				if ($this->is_changed (array ("ddbcontentor_cats_desc","ddbcontentor_cats_owner_group","ddbcontentor_cats_vcontrol","ddbcontentor_cats_front_page","ddbcontentor_cats_front_id","ddbcontentor_cats_doctype","ddbcontentor_cats_locked","ddbcontentor_cats_public","ddbcontentor_cats_moderated","ddbcontentor_cats_submissions")))
				{
					if ($this->data_insert_mode) { $direct_classes['db']->init_insert ($direct_settings['contentor_cats_table']); }
					else { $direct_classes['db']->init_update ($direct_settings['contentor_cats_table']); }

					$f_update_values = "<sqlvalues>";
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbdatalinker_id_object']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_id",$this->data['ddbdatalinker_id_object'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_desc']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_desc",$this->data['ddbcontentor_cats_desc'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_owner_group']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_owner_group",$this->data['ddbcontentor_cats_owner_group'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_vcontrol']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_vcontrol",$this->data['ddbcontentor_cats_vcontrol'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_front_page']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_front_page",$this->data['ddbcontentor_cats_front_page'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_front_id']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_front_id",$this->data['ddbcontentor_cats_front_id'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_doctype']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_doctype",$this->data['ddbcontentor_cats_doctype'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_locked']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_locked",$this->data['ddbcontentor_cats_locked'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_public']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_public",$this->data['ddbcontentor_cats_public'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_moderated']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_moderated",$this->data['ddbcontentor_cats_moderated'],"string"); }
					if (($this->data_insert_mode)||(isset ($this->data_changed['ddbcontentor_cats_submissions']))) { $f_update_values .= $direct_classes['db']->define_set_attributes_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_submissions",$this->data['ddbcontentor_cats_submissions'],"string"); }
					$f_update_values .= "</sqlvalues>";

					$direct_classes['db']->define_set_attributes ($f_update_values);
					if (!$this->data_insert_mode) { $direct_classes['db']->define_row_conditions ("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>"); }
					$f_return = $direct_classes['db']->query_exec ("co");

					if ($f_return)
					{
						if (function_exists ("direct_dbsync_event"))
						{
							if ($this->data_insert_mode) { direct_dbsync_event ($direct_settings['contentor_cats_table'],"insert",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>")); }
							else { direct_dbsync_event ($direct_settings['contentor_cats_table'],"update",("<sqlconditions>".($direct_classes['db']->define_row_conditions_encode ($direct_settings['contentor_cats_table'].".ddbcontentor_cats_id",$this->data['ddbdatalinker_id_object'],"string"))."</sqlconditions>")); }
						}

						if (!$direct_settings['swg_auto_maintenance']) { $direct_classes['db']->optimize_random ($direct_settings['contentor_cats_table']); }
					}
				}
			}

			if (($f_insert_mode_deactivate)&&($this->data_insert_mode)) { $this->data_insert_mode = false; }

			if ($f_return) { $direct_classes['db']->v_transaction_commit (); }
			else { $direct_classes['db']->v_transaction_rollback (); }
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -contentor_cat->update ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}
}

/* -------------------------------------------------------------------------
Mark this class as the most up-to-date one
------------------------------------------------------------------------- */

define ("CLASS_direct_contentor_cat",true);

//j// Script specific commands

if (!isset ($direct_settings['contentor_datacenter_path_symbols'])) { $direct_settings['contentor_datacenter_path_symbols'] = $direct_settings['path_themes']."/$direct_settings[theme]/"; }
if (!isset ($direct_settings['swg_auto_maintenance'])) { $direct_settings['swg_auto_maintenance'] = false; }
}

//j// EOF
?>