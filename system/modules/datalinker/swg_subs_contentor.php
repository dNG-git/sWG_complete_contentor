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
* datalinker/swg_subs_contentor.php
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

//j// Basic configuration

/* -------------------------------------------------------------------------
Direct calls will be honored with an "exit ()"
------------------------------------------------------------------------- */

if (!defined ("direct_product_iversion")) { exit (); }

//j// Script specific commands

if (!isset ($direct_settings['contentor_subs_types_supported'])) { $direct_settings['contentor_subs_types_supported'] = array (); }
if (!isset ($direct_settings['datalinker_https_subs_new'])) { $direct_settings['datalinker_https_subs_new'] = false; }
if (!isset ($direct_settings['datalinker_subs_supported'])) { $direct_settings['datalinker_subs_supported'] = array (); }
if (!isset ($direct_settings['search_intext'])) { $direct_settings['search_intext'] = false; }
if (!isset ($direct_settings['search_intext_guests'])) { $direct_settings['search_intext_guests'] = false; }
if (!isset ($direct_settings['search_term_max'])) { $direct_settings['search_term_max'] = 256; }
if (!isset ($direct_settings['search_term_min'])) { $direct_settings['search_term_min'] = 4; }
if (!isset ($direct_settings['search_titledata'])) { $direct_settings['search_titledata'] = true; }
if (!isset ($direct_settings['serviceicon_default_back'])) { $direct_settings['serviceicon_default_back'] = "mini_default_back.png"; }
$direct_settings['additional_copyright'][] = array ("Module contentor #echo(sWGcontentorVersion)# - (C) ","http://www.direct-netware.de/redirect.php?swg","direct Netware Group"," - All rights reserved");

//j// BOS
switch ($direct_settings['a'])
{
//j// ($direct_settings['a'] == "new")||($direct_settings['a'] == "new-save")
case "new":
case "new-save":
{
	$g_mode_save = (($direct_settings['a'] == "new-save") ? true : false);
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }

	$g_tid = (isset ($direct_settings['dsd']['tid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['tid'])) : "");

	if ($g_mode_save)
	{
		$direct_cachedata['page_this'] = "";
		$direct_cachedata['page_backlink'] = "m=datalinker&s=subs_contentor&a=new&dsd=tid+".$g_tid;
		$direct_cachedata['page_homelink'] = "m=datalinker&s=subs&a=new&dsd=tid+".$g_tid;
	}
	else
	{
		$direct_cachedata['page_this'] = "m=datalinker&s=subs_contentor&a=new&dsd=tid+".$g_tid;
		$direct_cachedata['page_backlink'] = "m=datalinker&s=subs&a=new&dsd=tid+".$g_tid;
		$direct_cachedata['page_homelink'] = $direct_cachedata['page_backlink'] ;
	}

	$direct_classes['basic_functions']->settings_get ($direct_settings['path_data']."/settings/swg_contentor.php");
	if (is_string ($direct_settings['contentor_subs_types_supported'])) { $direct_settings['contentor_subs_types_supported'] = array ($direct_settings['contentor_subs_types_supported']); }
	if (is_string ($direct_settings['datalinker_subs_supported'])) { $direct_settings['datalinker_subs_supported'] = array ($direct_settings['datalinker_subs_supported']); }

	if ($direct_classes['kernel']->service_init_default ())
	{
	if ((!empty ($direct_settings['contentor_subs_types_supported']))&&(in_array ("contentor",$direct_settings['datalinker_subs_supported'])))
	{
	//j// BOA
	if ($g_mode_save) { direct_output_related_manager ("datalinker_subs_contentor_new_form_save","pre_module_service_action"); }
	else
	{
		direct_output_related_manager ("datalinker_subs_contentor_new_form","pre_module_service_action");
		$direct_classes['kernel']->service_https ($direct_settings['datalinker_https_subs_new'],$direct_cachedata['page_this']);
	}

	direct_local_integration ("datalinker");

	$g_continue_check = $direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/functions/swg_tmp_storager.php");
	if ($g_tid == "") { $g_tid = $direct_settings['uuid']; }

	if ($g_continue_check)
	{
		$g_task_array = direct_tmp_storage_get ("evars",$g_tid,"","task_cache");

		if (($g_task_array)&&(isset ($g_task_array['core_sid'],$g_task_array['datalinker_eid'],$g_task_array['uuid']))&&($g_task_array['datalinker_sub_mode'] == "new")&&(!$g_task_array['datalinker_subs_new_done'])&&(!$g_task_array['datalinker_subs_new_linked_done'])&&($g_task_array['uuid'] == $direct_settings['uuid']))
		{
			if (!$g_mode_save) { $direct_cachedata['page_homelink'] = str_replace ("[oid]","deid+{$g_task_array['datalinker_eid']}++",$g_task_array['core_back_return']); }
		}
		else { $g_continue_check = false; }
	}

	if ($g_continue_check)
	{
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formbuilder.php");
		direct_local_integration ("contentor");

		direct_class_init ("formbuilder");
		direct_class_init ("output");
		$direct_classes['output']->options_insert (2,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

/* -------------------------------------------------------------------------
We should have input in save mode
------------------------------------------------------------------------- */

		if ($g_mode_save) { $g_doctype_selected = (isset ($GLOBALS['i_dtype']) ? (str_replace ("'","",$GLOBALS['i_dtype'])) : ""); }
		else { $g_doctype_selected = (isset ($g_task_array['datalinker_contentor_type']) ? (str_replace ("'","",$g_task_array['datalinker_contentor_type'])) : ""); }

		$direct_cachedata['i_dtype'] = "<evars>";

		foreach ($direct_settings['contentor_subs_types_supported'] as $g_doctype)
		{
			$g_doctype_name = direct_string_id_translation ("contentor",(md5 ("contentor_types_".$g_doctype)));

			$direct_cachedata['i_dtype'] .= "<c$g_doctype><value value='$g_doctype' />";
			if ($g_doctype == $g_doctype_selected) { $direct_cachedata['i_dtype'] .= "<selected value='1' />"; }
			$direct_cachedata['i_dtype'] .= ($g_doctype_name ? "<text><![CDATA[$g_doctype_name]]></text>" : "<text><![CDATA[".(direct_local_get ("core_unknown"))." ($g_doctype)]]></text>");
			$direct_cachedata['i_dtype'] .= "</c$g_doctype>";
		}

		$direct_cachedata['i_dtype'] .= "</evars>";

/* -------------------------------------------------------------------------
Build the form
------------------------------------------------------------------------- */

		$direct_classes['formbuilder']->entry_add_radio ("dtype",(direct_local_get ("datalinker_subs_type")),true);

		$direct_cachedata['output_formelements'] = $direct_classes['formbuilder']->form_get ($g_mode_save);

		if (($g_mode_save)&&($direct_classes['formbuilder']->check_result))
		{
/* -------------------------------------------------------------------------
Save data edited
------------------------------------------------------------------------- */

			$g_task_array['datalinker_contentor_type'] = $direct_cachedata['i_dtype'];
			direct_tmp_storage_write ($g_task_array,$g_tid,$g_task_array['core_sid'],"task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));

			$g_source = urlencode (base64_encode ("m=datalinker&s=subs_contentor&a=new&dsd=tid+".$g_tid));
			$g_target = urlencode (base64_encode ("m=datalinker&s=subs_contentor&a=new-selected&dsd=tid+{$g_tid}++[oid]"));
			$direct_classes['output']->redirect (direct_linker ("url1","m=contentor&s=doc&a=new&dsd=ccid+{$g_task_array['datalinker_eid']}++ctype+{$direct_cachedata['i_dtype']}++source+{$g_source}++target+".$g_target,false));
		}
		else
		{
/* -------------------------------------------------------------------------
View form
------------------------------------------------------------------------- */

			$direct_cachedata['output_formbutton'] = direct_local_get ("core_continue");
			$direct_cachedata['output_formtarget'] = "m=datalinker&s=subs_contentor&a=new-save&dsd=tid+".$g_tid;
			$direct_cachedata['output_formtitle'] = direct_local_get ("datalinker_subs_mode_entry_new");

			direct_output_related_manager ("datalinker_subs_contentor_new_form","post_module_service_action");
			$direct_classes['output']->oset ("default","form");
			$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
			$direct_classes['output']->page_show ($direct_cachedata['output_formtitle']);
		}
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_tid_invalid","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	//j// EOA
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_service_inactive","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// $direct_settings['a'] == "new-selected"
case "new-selected":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=new-selected_ (#echo(__LINE__)#)"); }

	$g_did = (isset ($direct_settings['dsd']['cdid_d']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cdid_d'])) : "");
	$g_did = (isset ($direct_settings['dsd']['cdid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cdid'])) : $g_did);
	$g_tid = (isset ($direct_settings['dsd']['tid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['tid'])) : "");

	$direct_cachedata['page_this'] = "";
	$direct_cachedata['page_backlink'] = "m=datalinker&s=subs_contentor&a=select&dsd=tid+".$g_tid;
	$direct_cachedata['page_homelink'] = "m=datalinker&s=subs&a=new&dsd=tid+".$g_tid;

	if ($direct_classes['kernel']->service_init_default ())
	{
	if ($direct_settings['datalinker_subs_supported'])
	{
	//j// BOA
	$g_continue_check = $direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/functions/swg_tmp_storager.php");
	direct_local_integration ("datalinker");

	direct_class_init ("output");
	$direct_classes['output']->options_insert (2,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

	if ($g_tid == "") { $g_tid = $direct_settings['uuid']; }

	if ($g_continue_check)
	{
		$g_task_array = direct_tmp_storage_get ("evars",$g_tid,"","task_cache");
		if ((!$g_task_array)||(!isset ($g_task_array['core_sid'],$g_task_array['datalinker_eid'],$g_task_array['uuid']))||($g_task_array['datalinker_sub_mode'] != "new")||($g_task_array['datalinker_subs_new_done'])&&($g_task_array['datalinker_subs_new_linked_done'])||($g_task_array['uuid'] != $direct_settings['uuid'])) { $g_continue_check = false; }
	}

	if ($g_continue_check)
	{
		if ($g_did)
		{
			$g_task_array['datalinker_sub_id'] = $g_did;
			$g_task_array['datalinker_subs_new_linked_done'] = 1;
			$g_task_array['datalinker_subs_new_selected_done'] = 1;

			direct_tmp_storage_write ($g_task_array,$g_tid,$g_task_array['core_sid'],"task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));
			$direct_classes['output']->redirect (direct_linker ("url1","m=datalinker&s=subs&a=new-selected&dsd=tid+".$g_tid,false));
		}
		else { $direct_classes['output']->redirect (direct_linker ("url1","m=datalinker&s=subs_contentor&a=new&dsd=tid+".$g_tid,false)); }
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_tid_invalid","sWG/#echo(__FILEPATH__)# _a=new-selected_ (#echo(__LINE__)#)"); }
	//j// EOA
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_service_inactive","sWG/#echo(__FILEPATH__)# _a=new-selected_ (#echo(__LINE__)#)"); }
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// ($direct_settings['a'] == "select")||($direct_settings['a'] == "select-save")
case "select":
case "select-save":
{
	$g_mode_save = (($direct_settings['a'] == "select-save") ? true : false);
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }

	$g_tid = (isset ($direct_settings['dsd']['tid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['tid'])) : "");

	if ($g_mode_save)
	{
		$direct_cachedata['page_this'] = "";
		$direct_cachedata['page_backlink'] = "m=datalinker&s=subs_contentor&a=select&dsd=tid+".$g_tid;
		$direct_cachedata['page_homelink'] = "m=datalinker&s=subs&a=new&dsd=tid+".$g_tid;
	}
	else
	{
		$direct_cachedata['page_this'] = "m=datalinker&s=subs_contentor&a=select&dsd=tid+".$g_tid;
		$direct_cachedata['page_backlink'] = "m=datalinker&s=subs&a=new&dsd=tid+".$g_tid;
		$direct_cachedata['page_homelink'] = $direct_cachedata['page_backlink'] ;
	}

	if (is_string ($direct_settings['datalinker_subs_supported'])) { $direct_settings['datalinker_subs_supported'] = array ($direct_settings['datalinker_subs_supported']); }

	if ($direct_classes['kernel']->service_init_default ())
	{
	if (in_array ("contentor",$direct_settings['datalinker_subs_supported']))
	{
	//j// BOA
	if ($g_mode_save) { direct_output_related_manager ("datalinker_subs_contentor_select_form_save","pre_module_service_action"); }
	else
	{
		direct_output_related_manager ("datalinker_subs_contentor_select_form","pre_module_service_action");
		$direct_classes['kernel']->service_https ($direct_settings['datalinker_https_subs_new'],$direct_cachedata['page_this']);
	}

	direct_local_integration ("datalinker");

	$g_continue_check = $direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/functions/swg_tmp_storager.php");
	if ($g_tid == "") { $g_tid = $direct_settings['uuid']; }

	if ($g_continue_check)
	{
		$g_task_array = direct_tmp_storage_get ("evars",$g_tid,"","task_cache");

		if (($g_task_array)&&(isset ($g_task_array['core_sid'],$g_task_array['datalinker_eid'],$g_task_array['uuid']))&&($g_task_array['datalinker_sub_mode'] == "select")&&(!$g_task_array['datalinker_subs_new_done'])&&(!$g_task_array['datalinker_subs_new_linked_done'])&&($g_task_array['uuid'] == $direct_settings['uuid']))
		{
			if (!$g_mode_save) { $direct_cachedata['page_homelink'] = str_replace ("[oid]","deid+{$g_task_array['datalinker_eid']}++",$g_task_array['core_back_return']); }
		}
		else { $g_continue_check = false; }
	}

	if ($g_continue_check)
	{
		$direct_classes['basic_functions']->settings_get ($direct_settings['path_data']."/settings/swg_search.php",true);
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formbuilder.php");
		direct_local_integration ("search");

		direct_class_init ("formbuilder");
		direct_class_init ("output");
		$direct_classes['output']->options_insert (2,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

		$g_continue_check = false;
		$g_usertype = $direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']);

		if ($g_usertype > 2) { $g_continue_check = true; }
		elseif ($g_usertype)
		{
			if (($direct_settings['search_intitle'])||($direct_settings['search_intext'])) { $g_continue_check = true; }
		}
		else
		{
			if (($direct_settings['search_intitle_guests'])||($direct_settings['search_intext_guests'])) { $g_continue_check = true; }
		}

		if ($g_continue_check)
		{
			if ($g_mode_save)
			{
/* -------------------------------------------------------------------------
We should have input in save mode
------------------------------------------------------------------------- */

				$direct_cachedata['i_sterm'] = (isset ($GLOBALS['i_sterm']) ? ($direct_classes['basic_functions']->inputfilter_basic ($GLOBALS['i_sterm'])) : "");

				$direct_cachedata['i_swords'] = (isset ($GLOBALS['i_swords']) ? (str_replace ("'","",$GLOBALS['i_swords'])) : "");
				$direct_cachedata['i_swords'] = str_replace ("<value value='$direct_cachedata[i_swords]' />","<value value='$direct_cachedata[i_swords]' /><selected value='1' />","<evars><any><value value='any' /><text><![CDATA[".(direct_local_get ("search_word_behavior_any"))."]]></text></any><all><value value='all' /><text><![CDATA[".(direct_local_get ("search_word_behavior_all"))."]]></text></all></evars>");
			}
			else
			{
				$direct_cachedata['i_sterm'] = "";
				$direct_cachedata['i_swords'] = "<evars><any><value value='any' /><selected value='1' /><text><![CDATA[".(direct_local_get ("search_word_behavior_any"))."]]></text></any><all><value value='all' /><text><![CDATA[".(direct_local_get ("search_word_behavior_all"))."]]></text></all></evars>";
			}

			if ($g_usertype > 2) { $g_continue_check = true; }
			elseif (($g_usertype)&&($direct_settings['search_intitle'])&&($direct_settings['search_intext'])) { $g_continue_check = true; }
			elseif (($direct_settings['search_intitle_guests'])&&($direct_settings['search_intext_guests'])) { $g_continue_check = true; }
			else { $g_continue_check = false; }

			if ($g_continue_check)
			{
				$g_search_base = "<evars><title><value value='title' /><text><![CDATA[".(direct_local_get ("search_target_title_only"))."]]></text></title><data><value value='data' /><text><![CDATA[".(direct_local_get ("search_target_data"))."]]></text></data>";
				if ($direct_settings['search_titledata']) { $g_search_base .= "<both><value value='titledata' /><text><![CDATA[".(direct_local_get ("search_target_both"))."]]></text></both>"; }
				$g_search_base .= "</evars>";

				$direct_cachedata['i_sbase'] = (isset ($GLOBALS['i_sbase']) ? (str_replace ("'","",$GLOBALS['i_sbase'])) : "title");
				$direct_cachedata['i_sbase'] = str_replace ("<value value='$direct_cachedata[i_sbase]' />","<value value='$direct_cachedata[i_sbase]' /><selected value='1' />",$g_search_base);
			}

/* -------------------------------------------------------------------------
Build the form
------------------------------------------------------------------------- */

			$direct_classes['formbuilder']->entry_add_text ("sterm",(direct_local_get ("search_term")),true,"s",$direct_settings['search_term_min'],$direct_settings['search_term_max'],(direct_local_get ("search_helper_term")),"",true);
			if ($g_continue_check) { $direct_classes['formbuilder']->entry_add_select ("sbase",(direct_local_get ("search_target")),false,"s",(direct_local_get ("search_helper_target")),"",true); }
			$direct_classes['formbuilder']->entry_add_select ("swords",(direct_local_get ("search_word_behavior")),false,"s");

			$direct_cachedata['output_formelements'] = $direct_classes['formbuilder']->form_get ($g_mode_save);

			if (($g_mode_save)&&($direct_classes['formbuilder']->check_result))
			{
/* -------------------------------------------------------------------------
Save data edited
------------------------------------------------------------------------- */

				if (!$g_continue_check)
				{
					if ((($g_usertype)&&($direct_settings['search_intext']))||($direct_settings['search_intext_guests'])) { $direct_cachedata['i_sbase'] = ($direct_settings['search_titledata'] ? "titledata" : "data"); }
					else { $direct_cachedata['i_sbase'] = "title"; }
				}

				if ($direct_settings['user']['type'] == "gt")
				{
					$g_uuid_string = $direct_classes['kernel']->v_uuid_get ("s");

					if (!$g_uuid_string)
					{
						$g_uuid_string = "<evars><userid /></evars>";
						$direct_classes['kernel']->v_uuid_write ($g_uuid_string);
						$direct_classes['kernel']->v_uuid_cookie_save ();
					}
				}

				if (!isset ($g_task_array['contentor_back_return'])) { $g_task_array['contentor_back_return'] = $g_task_array['core_back_return']; }
				$g_task_array['core_back_return'] = "m=datalinker&s=subs_contentor&a=select-post&dsd=tid+".$g_tid;

				$g_task_array['search_base'] = $direct_cachedata['i_sbase'];
				$g_task_array['search_marker_return'] = "m=datalinker&s=subs_contentor&a=select-post&dsd=[oid]tid+".$g_tid;
				$g_task_array['search_result_handler'] = "m=dataport&s=swgap;search;selector&dsd=dtheme+1++[oid]";
				$g_task_array['search_selection_done'] = 0;
				$g_task_array['search_selection_quantity'] = 1;
				$g_task_array['search_services'] = array ("87ecbe0ba0a0b3c7e60030043614e655");
				// md5 ("contentor")
				$g_task_array['search_term'] = $direct_cachedata['i_sterm'];
				$g_task_array['search_words'] = $direct_cachedata['i_swords'];
 
				direct_tmp_storage_write ($g_task_array,$g_tid,$g_task_array['core_sid'],"task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));
				$direct_classes['output']->redirect (direct_linker ("url1","m=dataport&s=swgap;search;selector&a=run&dsd=dtheme+1++tid+".$g_tid,false));
			}
			else
			{
/* -------------------------------------------------------------------------
View form
------------------------------------------------------------------------- */

				$direct_cachedata['output_formbutton'] = direct_local_get ("search_new");
				$direct_cachedata['output_formtarget'] = "m=datalinker&s=subs_contentor&a=select-save&dsd=tid+".$g_tid;
				$direct_cachedata['output_formtitle'] = direct_local_get ("core_search");

				direct_output_related_manager ("datalinker_subs_contentor_select_form","post_module_service_action");
				$direct_classes['output']->oset ("default","form");
				$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
				$direct_classes['output']->page_show ($direct_cachedata['output_formtitle']);
			}
		}
		else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_tid_invalid","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	//j// EOA
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_service_inactive","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// $direct_settings['a'] == "select-post"
case "select-post":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=select-post_ (#echo(__LINE__)#)"); }

	$g_tid = (isset ($direct_settings['dsd']['tid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['tid'])) : "");

	$direct_cachedata['page_this'] = "";
	$direct_cachedata['page_backlink'] = "m=datalinker&s=subs_contentor&a=select&dsd=tid+".$g_tid;
	$direct_cachedata['page_homelink'] = "m=datalinker&s=subs&a=new&dsd=tid+".$g_tid;

	if ($direct_classes['kernel']->service_init_default ())
	{
	if ($direct_settings['datalinker_subs_supported'])
	{
	//j// BOA
	$g_continue_check = $direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/functions/swg_tmp_storager.php");
	direct_local_integration ("datalinker");

	direct_class_init ("output");
	$direct_classes['output']->options_insert (2,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

	if ($g_tid == "") { $g_tid = $direct_settings['uuid']; }

	if ($g_continue_check)
	{
		$g_task_array = direct_tmp_storage_get ("evars",$g_tid,"","task_cache");

		if (($g_task_array)&&(isset ($g_task_array['core_sid'],$g_task_array['datalinker_eid'],$g_task_array['uuid']))&&($g_task_array['datalinker_sub_mode'] == "select")&&(!$g_task_array['datalinker_subs_new_done'])&&(!$g_task_array['datalinker_subs_new_linked_done'])&&($g_task_array['uuid'] == $direct_settings['uuid']))
		{
			if (isset ($g_task_array['search_results_confirmed'])) { unset ($g_task_array['search_results_confirmed']); }
			if (isset ($g_task_array['search_results_possible'])) { unset ($g_task_array['search_results_possible']); }
			if (isset ($g_task_array['search_result_positions'])) { unset ($g_task_array['search_result_positions']); }
		}
		else { $g_continue_check = false; }
	}

	if ($g_continue_check)
	{
		if ((isset ($g_task_array['search_objects_marked']))&&(!empty ($g_task_array['search_objects_marked'])))
		{
			$g_eid = array_shift ($g_task_array['search_objects_marked']);
			unset ($g_task_array['search_objects_marked']);

			$g_task_array['core_back_return'] = "m=datalinker&s=subs_contentor&a=select-post&dsd=tid+".$g_tid;
			$g_task_array['datalinker_link_marker_return'] = "m=datalinker&s=subs_contentor&a=select-post&dsd=[oid]tid+".$g_tid;
			$g_task_array['datalinker_link_marker_title_0'] = direct_local_get ("datalinker_entry_select");
			$g_task_array['datalinker_link_selection_automark_one'] = 1;
			$g_task_array['datalinker_link_selection_confirm'] = 0;
			$g_task_array['datalinker_link_selection_done'] = 0;
			$g_task_array['datalinker_link_selection_quantity'] = 1;

			direct_tmp_storage_write ($g_task_array,$g_tid,$g_task_array['core_sid'],"task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));

			$g_target = urlencode (base64_encode ("m=dataport&s=swgap;datalinker;selector_link&dsd=dtheme+1++[oid]tid+".$g_tid));
			$direct_classes['output']->redirect (direct_linker ("url1","m=dataport&s=swgap;datalinker;selector&a=preselect&dsd=dtheme+1++deid+{$g_eid}++dconfirm+0++target+".$g_target,false));
		}
		elseif ((isset ($g_task_array['datalinker_link_objects_marked']))&&(!empty ($g_task_array['datalinker_link_objects_marked'])))
		{
			$g_eid = array_shift ($g_task_array['datalinker_link_objects_marked']);
			unset ($g_task_array['datalinker_link_objects_marked']);

			if (isset ($g_task_array['contentor_back_return']))
			{
				$g_task_array['core_back_return'] = $g_task_array['contentor_back_return'];
				unset ($g_task_array['contentor_back_return']);
			}

			$g_datalinker_cache = direct_tmp_storage_get ("evars",$direct_settings['uuid'],"4c6924b0583e6882d3db6aff277bfc3e","link_cache");

			if (isset ($g_datalinker_cache['datalinker_objects_selected']))
			{
				if (isset ($g_datalinker_cache['datalinker_objects_selected'][$g_eid]))
				{
					unset ($g_datalinker_cache['datalinker_objects_selected'][$g_eid]);
					direct_tmp_storage_write ($g_datalinker_cache,$direct_settings['uuid'],"4c6924b0583e6882d3db6aff277bfc3e","link_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));
					// md5 ("datalinker")
				}
			}

			$g_task_array['datalinker_sub_id'] = $g_eid;
			$g_task_array['datalinker_subs_new_selected_done'] = 1;

			direct_tmp_storage_write ($g_task_array,$g_tid,$g_task_array['core_sid'],"task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));
			$direct_classes['output']->redirect (direct_linker ("url1","m=datalinker&s=subs&a=new-link&dsd=tid+".$g_tid,false));
		}
		else
		{
			if (isset ($g_task_array['contentor_back_return']))
			{
				$g_task_array['core_back_return'] = $g_task_array['contentor_back_return'];
				unset ($g_task_array['contentor_back_return']);
			}

			direct_tmp_storage_write ($g_task_array,$g_tid,$g_task_array['core_sid'],"task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));
			$direct_classes['output']->redirect (direct_linker ("url1","m=datalinker&s=subs_contentor&a=select&dsd=tid+".$g_tid,false));
		}
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_tid_invalid","sWG/#echo(__FILEPATH__)# _a=select-post_ (#echo(__LINE__)#)"); }
	//j// EOA
	}
	else { $direct_classes['error_functions']->error_page ("standard","core_service_inactive","sWG/#echo(__FILEPATH__)# _a=select-post_ (#echo(__LINE__)#)"); }
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// EOS
}

//j// EOF
?>