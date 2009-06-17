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
$Id: swg_contentor_iviewer.php,v 1.5 2009/03/03 08:57:33 s4u Exp $
#echo(sWGcontentorVersion)#
sWG/#echo(__FILEPATH__)#
----------------------------------------------------------------------------
NOTE_END //n*/
/**
* Provides the iviewer which calls parser and returns standardized values for
* output.
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

//f// direct_datalinker_contentor_iviewer ($f_viewer_data,&$f_object)
/**
* This iviewer is responsible for contentor objects. It will check the read
* rights and return standardized values.
*
* @param  array $f_viewer_data Found iviewer entry
* @param  direct_datalinker &$f_object DataLinker object
* @uses   direct_basic_functions::include_file()
* @uses   direct_datalinker_contentor()
* @uses   direct_datalinker_contentor_iviewer_cat()
* @uses   direct_datalinker_contentor_iviewer_doc()
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return array Parsed entry (ready for output)
* @since  v0.1.00
*/
function direct_datalinker_contentor_iviewer ($f_viewer_data,&$f_object)
{
	global $direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_datalinker_contentor_iviewer (+f_viewer_data,+f_object)- (#echo(__LINE__)#)"); }

	$f_return = array ();

	if (isset ($f_viewer_data['handler']))
	{
		$f_continue_check = $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/functions/datalinker/swg_contentor.php");
		if ($f_continue_check) { $f_object_iview =& direct_datalinker_contentor ($f_object,false); }

		if ($f_object_iview)
		{
			switch ($f_viewer_data['action'])
			{
			case "cat":
			{
				$f_return = direct_datalinker_contentor_iviewer_cat ($f_viewer_data,$f_object_iview);
				break 1;
			}
			case "doc":
			{
				$f_return = direct_datalinker_contentor_iviewer_doc ($f_viewer_data,$f_object_iview);
				break 1;
			}
			}
		}
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_datalinker_contentor_iviewer ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
}

//f// direct_datalinker_contentor_iviewer_cat ($f_viewer_data,&$f_object)
/**
* iviewer for direct_contentor_cat objects.
*
* @param  array $f_viewer_data Found iviewer entry
* @param  direct_datalinker &$f_object DataLinker object
* @uses   direct_basic_functions::include_file()
* @uses   direct_contentor_cat::get()
* @uses   direct_contentor_cat::is_readable()
* @uses   direct_contentor_cat::parse()
* @uses   direct_debug()
* @uses   direct_linker()
* @uses   direct_local_get()
* @uses   direct_local_integration()
* @uses   USE_debug_reporting
* @return array Parsed entry (ready for output)
* @since  v0.1.00
*/
function direct_datalinker_contentor_iviewer_cat ($f_viewer_data,&$f_object)
{
	global $direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_datalinker_contentor_iviewer_cat (+f_viewer_data,+f_object)- (#echo(__LINE__)#)"); }

	direct_local_integration ("contentor");

$f_return = array (
"object_id" => "",
"object_title_type" => direct_local_get ("contentor_cat"),
"object_title" => direct_local_get ("core_datasub_no_access_title"),
"object_symbol" => "",
"object_desc" => direct_local_get ("core_datasub_no_access"),
"object_entries" => "",
"object_last_username" => "",
"object_last_userpageurl" => "",
"object_last_useravatar" => "",
"object_preview" => "",
"object_content" => "",
"object_last_time" => "",
"object_url" => "",
"object_available" => false,
"object_view_url" => "",
"object_extended_available" => false,
"object_new" => false
);

	if (isset ($f_viewer_data['handler']))
	{
		$f_object_array = $f_object->get ();
		$f_parent_check = true;

		if (is_array ($f_object_array))
		{
			$f_parent_object = new direct_contentor_cat ();

			if ($f_object_array['ddbdatalinker_id_parent'])
			{
				if ($f_parent_object)
				{
					$f_parent_array = $f_parent_object->get ($f_object_array['ddbdatalinker_id_parent']);
					$f_parent_check = $f_parent_object->is_readable ();
				}
			}
			else { $f_parent_check = false; }
		}

		if (!is_array ($f_object_array)) { $f_return['object_desc'] = direct_local_get ("errors_contentor_cid_invalid"); }
		elseif ($f_object->is_readable ())
		{
			if ($f_object_array['ddbcontentor_cats_doctype'] == "all") { $f_parsed_array = $f_object->parse ("m=datalinker&dsd=deid+[oid]"); }
			else { $f_parsed_array = $f_object->parse ("m=contentor&a=[a]&dsd=[oid][page]"); }

			$f_return['object_id'] = $f_parsed_array['oid'];
			$f_return['object_title'] = $f_parsed_array['title'];

			if (($direct_settings['datalinker_datacenter_symbols'])&&($f_viewer_data['symbol']))
			{
				$f_symbol_path = $direct_classes['basic_functions']->varfilter ($direct_settings['datalinker_datacenter_path_symbols'],"settings");
				$f_return['object_symbol'] = direct_linker_dynamic ("url0","s=cache&dsd=dfile+".$f_symbol_path.$f_viewer_data['symbol']);
			}

			$f_return['object_desc'] = $f_parsed_array['desc'];

			if ($f_object_array['ddbcontentor_cats_doctype'] == "all") { $f_return['object_url'] = direct_linker ("url0","m=datalinker&dsd=deid+".$f_object_array['ddbdatalinker_id']); }
			else { $f_return['object_url'] = $f_parsed_array['pageurl']; }

			$f_return['object_available'] = true;

			if (($f_parent_check)&&(is_array ($f_parent_array))&&($f_parent_array['ddbcontentor_cats_doctype'] != "all"))
			{
				$f_parsed_array = $f_parent_object->parse ("m=contentor&a=[a]&dsd=[oid][page]");
				$f_return['category_id'] = $f_parsed_array['oid'];
				$f_return['category_title_type'] = direct_local_get ("contentor_cat");
				$f_return['category_title'] = $f_parsed_array['title'];
				$f_return['category_desc'] = $f_parsed_array['desc'];
				$f_return['category_url'] = $f_parsed_array['pageurl'];
				$f_return['category_entries'] = $f_parsed_array['objects'];
			}
		}
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_datalinker_contentor_iviewer_cat ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
}

//f// direct_datalinker_contentor_iviewer_doc ($f_viewer_data,&$f_object)
/**
* iviewer for direct_contentor_doc objects.
*
* @param  array $f_viewer_data Found iviewer entry
* @param  direct_datalinker &$f_object DataLinker object
* @uses   direct_basic_functions::include_file()
* @uses   direct_class_init()
* @uses   direct_contentor_cat::get()
* @uses   direct_contentor_cat::is_readable()
* @uses   direct_contentor_doc::get()
* @uses   direct_contentor_doc::is_readable()
* @uses   direct_contentor_doc::parse()
* @uses   direct_debug()
* @uses   direct_formtags::cleanup()
* @uses   direct_html_encode_special()
* @uses   direct_linker()
* @uses   direct_local_get()
* @uses   direct_local_integration()
* @uses   USE_debug_reporting
* @return array Parsed entry (ready for output)
* @since  v0.1.00
*/
function direct_datalinker_contentor_iviewer_doc ($f_viewer_data,&$f_object)
{
	global $direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_datalinker_contentor_iviewer_doc (+f_viewer_data,+f_object)- (#echo(__LINE__)#)"); }

	direct_local_integration ("contentor");

$f_return = array (
"object_id" => "",
"object_title_type" => direct_local_get ("contentor_doc"),
"object_title" => direct_local_get ("core_datasub_no_access_title"),
"object_symbol" => "",
"object_desc" => direct_local_get ("core_datasub_no_access"),
"object_entries" => "",
"object_last_username" => "",
"object_last_userpageurl" => "",
"object_last_useravatar" => "",
"object_preview" => "",
"object_content" => "",
"object_last_time" => "",
"object_url" => "",
"object_available" => false,
"object_view_url" => "",
"object_extended_available" => false,
"object_new" => false
);

	if (isset ($f_viewer_data['handler']))
	{
		$f_continue_check = $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_cat.php");
		if ($f_continue_check) { $f_continue_check = $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/swg_formtags.php"); }
		if ($f_continue_check) { $f_continue_check = direct_class_init ("formtags"); }

		$f_cat_array = NULL;
		$f_doc_array = NULL;
		$f_subs_check = false;

		if ($f_continue_check) { $f_doc_array = $f_object->get ("",false); }

		if (is_array ($f_doc_array))
		{
			$f_cat_object = new direct_contentor_cat ();

			if ($f_doc_array['ddbdatalinker_id_main'])
			{
				if ($f_cat_object) { $f_cat_array = $f_cat_object->get ($f_doc_array['ddbdatalinker_id_main']); }
			}
			else { $f_subs_check = true; }
		}

		if ((($f_subs_check)||(!is_array ($f_cat_array)))&&(!is_array ($f_doc_array))) { $f_return['object_desc'] = direct_local_get ("errors_contentor_did_invalid"); }
		elseif (($f_object->is_readable ())&&(($f_subs_check)||($f_cat_object->is_readable ())))
		{
			if ($f_doc_array['ddbcontentor_docs_doctype'] == "all") { $f_parsed_array = $f_object->parse ("m=datalinker&dsd=deid+[oid]"); }
			else { $f_parsed_array = $f_object->parse ("m=contentor&a=[a]&dsd=[oid][page]"); }

			$f_return['object_id'] = $f_parsed_array['oid'];
			$f_return['object_title'] = $f_parsed_array['title'];

			if (($direct_settings['datalinker_datacenter_symbols'])&&($f_viewer_data['symbol']))
			{
				$f_symbol_path = $direct_classes['basic_functions']->varfilter ($direct_settings['datalinker_datacenter_path_symbols'],"settings");
				$f_return['object_symbol'] = direct_linker_dynamic ("url0","s=cache&dsd=dfile+".$f_symbol_path.$f_viewer_data['symbol']);
			}

			$f_return['object_desc'] = $f_parsed_array['desc'];

			if ($f_parsed_array['ownername'])
			{
				$f_return['object_last_username'] = $f_parsed_array['ownername'];
				$f_return['object_last_userpageurl'] = $f_parsed_array['ownerpageurl'];
				$f_return['object_last_useravatar'] = $f_parsed_array['owneravatar_small'];
			}
			else
			{
				$f_return['object_last_username'] = "";
				$f_return['object_last_userpageurl'] = "";
				$f_return['object_last_useravatar'] = "";
			}

			$f_return['object_content'] = "";

			if ($f_doc_array['ddbdatalinker_sorting_date']) { $f_return['object_last_time'] = $direct_classes['basic_functions']->datetime ("shortdate&time",$f_doc_array['ddbdatalinker_sorting_date'],$direct_settings['user']['timezone'],(direct_local_get ("datetime_dtconnect"))); }
			else { $f_return['object_last_time'] = direct_local_get ("core_unknown"); }

			if (isset ($f_parsed_array['pageurl_counted'])) { $f_return['object_url'] = $f_parsed_array['pageurl_counted']; }
			else { $f_return['object_url'] = $f_parsed_array['pageurl']; }

			$f_return['object_available'] = true;
			$f_return['object_new'] = $f_parsed_array['new'];

			if ((!$f_subs_check)&&($f_cat_array['ddbcontentor_cats_doctype'] != "all"))
			{
				$f_parsed_array = $f_cat_object->parse ("m=contentor&a=[a]&dsd=[oid][page]");

				$f_return['category_id'] = $f_parsed_array['oid'];
				$f_return['category_title_type'] = direct_local_get ("contentor_cat");
				$f_return['category_title'] = $f_parsed_array['title'];
				$f_return['category_desc'] = $f_parsed_array['desc'];
				$f_return['category_url'] = $f_parsed_array['pageurl'];
				$f_return['category_entries'] = $f_parsed_array['objects'];
			}
		}
	}

	return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -direct_datalinker_contentor_iviewer_doc ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
}

//j// Script specific commands

if (!isset ($direct_settings['datalinker_datacenter_symbols'])) { $direct_settings['datalinker_datacenter_symbols'] = false; }
if (!isset ($direct_settings['datalinker_datacenter_path_symbols'])) { $direct_settings['datalinker_datacenter_path_symbols'] = $direct_settings['path_themes']."/$direct_settings[theme]/"; }

//j// EOF
?>