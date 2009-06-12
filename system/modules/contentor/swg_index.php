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
$Id: swg_index.php,v 1.5 2009/01/14 09:15:21 s4u Exp $
#echo(sWGcontentorVersion)#
sWG/#echo(__FILEPATH__)#
----------------------------------------------------------------------------
NOTE_END //n*/
/**
* contentor/swg_index.php
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

if (!isset ($direct_settings['contentor_handbooks_docs_per_page'])) { $direct_settings['contentor_handbooks_docs_per_page'] = 15; }
if (!isset ($direct_settings['contentor_https_handbooks_list'])) { $direct_settings['contentor_https_handbooks_list'] = false; }
if (!isset ($direct_settings['contentor_https_news_list'])) { $direct_settings['contentor_https_news_list'] = false; }
if (!isset ($direct_settings['contentor_https_pages_list'])) { $direct_settings['contentor_https_pages_list'] = false; }
if (!isset ($direct_settings['contentor_https_wiki_list'])) { $direct_settings['contentor_https_wiki_list'] = false; }
if (!isset ($direct_settings['contentor_https_handbooks_view'])) { $direct_settings['contentor_https_handbooks_view'] = false; }
if (!isset ($direct_settings['contentor_https_news_view'])) { $direct_settings['contentor_https_news_view'] = false; }
if (!isset ($direct_settings['contentor_https_pages_view'])) { $direct_settings['contentor_https_pages_view'] = false; }
if (!isset ($direct_settings['contentor_https_wiki_view'])) { $direct_settings['contentor_https_wiki_view'] = false; }
if (!isset ($direct_settings['contentor_news_docs_per_page'])) { $direct_settings['contentor_news_docs_per_page'] = 21; }
if (!isset ($direct_settings['contentor_pages_docs_per_page'])) { $direct_settings['contentor_pages_docs_per_page'] = 15; }
if (!isset ($direct_settings['contentor_versions_per_page'])) { $direct_settings['contentor_versions_per_page'] = 15; }
if (!isset ($direct_settings['contentor_wiki_docs_per_page'])) { $direct_settings['contentor_wiki_docs_per_page'] = 15; }
if (!isset ($direct_settings['serviceicon_contentor_doc_edit'])) { $direct_settings['serviceicon_contentor_doc_edit'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_contentor_doc_lock'])) { $direct_settings['serviceicon_contentor_doc_lock'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_contentor_doc_new'])) { $direct_settings['serviceicon_contentor_doc_new'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_contentor_doc_stick'])) { $direct_settings['serviceicon_contentor_doc_stick'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_contentor_doc_unlock'])) { $direct_settings['serviceicon_contentor_doc_unlock'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_contentor_doc_unstick'])) { $direct_settings['serviceicon_contentor_doc_unstick'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_contentor_docv_list'])) { $direct_settings['serviceicon_contentor_docv_list'] = "mini_default_option.png"; }
if (!isset ($direct_settings['serviceicon_default_back'])) { $direct_settings['serviceicon_default_back'] = "mini_default_back.png"; }
$direct_settings['additional_copyright'][] = array ("Module contentor #echo(sWGcontentorVersion)# - (C) ","http://www.direct-netware.de/redirect.php?swg","direct Netware Group"," - All rights reserved");

if ($direct_settings['a'] == "index") { $direct_settings['a'] = "list"; }
//j// BOS
switch ($direct_settings['a'])
{
//j// $direct_settings['a'] == "list"
case "list":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=list_ (#echo(__LINE__)#)"); }

	$g_cid_d = (isset ($direct_settings['dsd']['ccid_d']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['ccid_d'])) : "");
	$g_cid = (isset ($direct_settings['dsd']['ccid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['ccid'])) : $g_cid_d);
	$g_type = (isset ($direct_settings['dsd']['ctype']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['ctype'])) : "");
	$direct_cachedata['output_page'] = (isset ($direct_settings['dsd']['page']) ? ($direct_classes['basic_functions']->inputfilter_number ($direct_settings['dsd']['page'])) : 1);

	$direct_cachedata['page_this'] = "m=contentor&a=list&dsd=ccid+{$g_cid}++ctype+{$g_type}++page+".$direct_cachedata['output_page'];
	$direct_cachedata['page_backlink'] = "";
	$direct_cachedata['page_homelink'] = "";

	if ($direct_classes['kernel']->service_init_default ())
	{
	//j// BOA
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_cat.php");
	direct_local_integration ("contentor");

	if ((!$g_cid)&&($g_type)&&(isset ($direct_settings["contentor_{$g_type}_front_cid"]))&&($direct_settings["contentor_{$g_type}_front_cid"])) { $g_cid = $direct_settings["contentor_{$g_type}_front_cid"]; }
	$g_cat_object = new direct_contentor_cat ();

	if ($g_cat_object) { $g_cat_array = $g_cat_object->get ($g_cid); }
	else { $g_cat_array = NULL; }

	$g_docs_array = NULL;

	if (is_array ($g_cat_array))
	{
		$g_type = $g_cat_array['ddbcontentor_cats_doctype'];

		if (isset ($direct_settings["contentor_{$g_type}_docs_per_page"]))
		{
			if ((!$direct_cachedata['output_page'])||($direct_cachedata['output_page'] < 1)) { $direct_cachedata['output_page'] = 1; }
			$g_offset = (($direct_cachedata['output_page'] - 1) * $direct_settings["contentor_{$g_type}_docs_per_page"]);

			switch ($g_type)
			{
			case "handbooks":
			{
				$g_docs_array = $g_cat_object->get_docs ($g_offset,$direct_settings["contentor_{$g_type}_docs_per_page"],"id-asc");
				break 1;
			}
			case "news":
			{
				$g_docs_array = $g_cat_object->get_docs ($g_offset,$direct_settings["contentor_{$g_type}_docs_per_page"],"time-sticky-desc",true);
				break 1;
			}
			default: { $g_docs_array = $g_cat_object->get_docs ($g_offset,$direct_settings["contentor_{$g_type}_docs_per_page"]); }
			}
		}
	}

	if (!is_array ($g_docs_array)) { $direct_classes['error_functions']->error_page ("standard","contentor_cid_invalid","sWG/#echo(__FILEPATH__)# _a=list_ (#echo(__LINE__)#)"); }
	elseif ($g_cat_object->is_readable ())
	{
		direct_output_related_manager ("contentor_index_{$g_type}_list_".$g_cid,"pre_module_service_action");
		$direct_classes['kernel']->service_https ($direct_settings["contentor_https_{$g_type}_list"],$direct_cachedata['page_this']);

		direct_class_init ("output");
		$direct_classes['output']->servicemenu ("contentor_".$g_type);

		if ($g_type == "wiki")
		{
			direct_local_integration ("contentor_wiki");
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags_wiki.php");
			direct_class_init ("formtags");
			$direct_classes['formtags']->define_connector ("m=contentor&s=wiki&a=[a]&dsd=ccid+{$g_cid}++[oid]source+".(urlencode (base64_encode ($direct_cachedata['page_this']))));
		}
		else
		{
			direct_class_init ("formtags");
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags.php");
		}

		$g_connector = urlencode (base64_encode ("m=contentor&a=[a]&dsd=[oid]"));
		if ($g_cat_object->is_writable ()) { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=new&dsd=ccid+{$g_cid}++connector+".$g_connector,(direct_local_get ("contentor_doc_new")),$direct_settings['serviceicon_contentor_doc_new'],"url0"); }

		$direct_cachedata['output_cat'] = $g_cat_object->parse ("m=contentor&a=[a]&dsd=[oid]");
		$direct_cachedata['output_cats'] = array ();

		if ($g_cat_array['ddbdatalinker_subs'] > 0)
		{
			$g_subcats_array = $g_cat_object->get_subcats ();

			if ((is_array ($g_subcats_array))&&(!empty ($g_subcats_array)))
			{
				foreach ($g_subcats_array as $g_subcat_object) { $direct_cachedata['output_cats'][] = $g_subcat_object->parse ("m=contentor&s=handbooks&a=[a]&dsd=[oid]"); }
			}
		}

		$direct_cachedata['output_docs'] = array ();

		if (!empty ($g_docs_array))
		{
			foreach ($g_docs_array as $g_doc_object) { $direct_cachedata['output_docs'][] = $g_doc_object->parse ("m=contentor&a=[a]&dsd=[oid]"); }
		}

		$direct_cachedata['output_page_url'] = "m=contentor&a=list&dsd=ccid+{$g_cid}++";
		$direct_cachedata['output_pages'] = ceil ($g_cat_array['ddbdatalinker_objects'] / $direct_settings["contentor_{$g_type}_docs_per_page"]);
		$direct_cachedata['output_pages_show'] = true;

		direct_output_related_manager ("contentor_index_{$g_type}_list_".$g_cid,"post_module_service_action");
		$direct_classes['output']->oset ("contentor_".$g_type,"list");
		$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
		$direct_classes['output']->page_show ($direct_cachedata['output_cat']['title']);
	}
	else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a=list_ (#echo(__LINE__)#)"); }
	//j// EOA
	}

	$direct_cachedata['core_service_activated'] = 1;
	break 1;
}
//j// $direct_settings['a'] == "versions"
case "versions":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=versions_ (#echo(__LINE__)#)"); }

	$g_did = (isset ($direct_settings['dsd']['cdid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cdid'])) : $g_did_d);
	$g_connector = (isset ($direct_settings['dsd']['connector']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['connector'])) : "");
	$direct_cachedata['output_page'] = (isset ($direct_settings['dsd']['page']) ? ($direct_classes['basic_functions']->inputfilter_number ($direct_settings['dsd']['page'])) : 1);
	$g_source = (isset ($direct_settings['dsd']['source']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['source'])) : "");

	$g_back_link = "";

	if ($g_source)
	{
		$g_source_url = base64_decode ($g_source);
		if ($g_source_url) { $g_back_link = str_replace ("[oid]","cdid+{$g_did}++",$g_source_url); }
	}

	if ($g_connector) { $g_connector_url = base64_decode ($g_connector); }
	else { $g_connector_url = NULL; }

	if (!$g_connector_url)
	{
		$g_connector_url = "m=contentor&a=[a]&dsd=[oid]";
		$g_connector = urlencode (base64_encode ($g_connector_url));
	}

	if ((!$g_source)&&($g_connector_url)) { $g_back_link = str_replace (array ("[a]","[oid]"),(array ("view","cdid+{$g_did}++")),$g_connector_url); }

	$direct_cachedata['page_this'] = "m=contentor&s=index&a=versions&dsd=&a=versions&dsd=cdid+{$g_did}++connector+".(urlencode ($g_connector))."++page+{$direct_cachedata['output_page']}++source+".(urlencode ($g_source));
	$direct_cachedata['page_backlink'] = $g_back_link;
	$direct_cachedata['page_homelink'] = $g_back_link;

	if ($direct_classes['kernel']->service_init_default ())
	{
	//j// BOA
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_cat.php");
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_doc.php");
	direct_local_integration ("contentor");

	$g_datasub_check = false;
	$g_doc_object = new direct_contentor_doc ();

	if ($g_doc_object) { $g_doc_array = $g_doc_object->get ($g_did); }
	else { $g_doc_array = NULL; }

	$g_cat_array = NULL;

	if ($g_doc_array)
	{
		$g_type = $g_doc_array['ddbcontentor_docs_doctype'];

		if ($g_doc_array['ddbdatalinker_id_main'])
		{
			$g_cat_object = new direct_contentor_cat ();
			$g_cat_array = $g_cat_object->get ($g_doc_array['ddbdatalinker_id_main']);
		}
		else { $g_datasub_check = true; }
	}

	if ((!$g_datasub_check)&&(!is_array ($g_cat_array))) { $direct_classes['error_functions']->error_page ("standard","contentor_did_invalid","sWG/#echo(__FILEPATH__)# _a=view_ (#echo(__LINE__)#)"); }
	elseif (($g_doc_object->is_readable ())&&(($g_datasub_check)||($g_cat_object->is_readable ())))
	{
		if ($g_datasub_check) { direct_output_related_manager ("contentor_index_{$g_type}_versions_".$g_did,"pre_module_service_action"); }
		else { direct_output_related_manager ("contentor_index_{$g_type}_versions_{$g_cat_array['ddbdatalinker_id']}_".$g_did,"pre_module_service_action"); }

		$direct_classes['kernel']->service_https ($direct_settings["contentor_https_{$g_type}_view"],$direct_cachedata['page_this']);
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags.php");

		direct_class_init ("output");
		$direct_classes['output']->servicemenu ("contentor_".$g_type);
		$direct_classes['output']->options_insert (1,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

		if ((!$g_datasub_check)&&($g_type == "wiki"))
		{
			direct_local_integration ("contentor_wiki");
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags_wiki.php");
			direct_class_init ("formtags");
			$direct_classes['formtags']->define_connector ("m=contentor&s=wiki&a=[a]&dsd=ccid+{$g_cat_array['ddbdatalinker_id']}++[oid]source+".(urlencode (base64_encode ($direct_cachedata['page_this']))));
		}
		else
		{
			direct_class_init ("formtags");
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags.php");
		}

		if (!$g_datasub_check)
		{
			$g_source_link = urlencode (base64_encode ($direct_cachedata['page_this']));
			if ($g_cat_object->is_writable ()) { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=new&dsd=ccid+{$g_cat_array['ddbdatalinker_id']}++connector+{$g_connector}++source+".$g_source_link,(direct_local_get ("contentor_doc_new")),$direct_settings['serviceicon_contentor_doc_new'],"url0"); }
		}

		$direct_cachedata['output_doc_versions'] = array ($g_doc_object->parse ($g_connector_url));

		if ((!$direct_cachedata['output_page'])||($direct_cachedata['output_page'] < 1)) { $direct_cachedata['output_page'] = 1; }
		$direct_cachedata['output_page_url'] = "m=contentor&s=index&a=versions&dsd=&a=versions&dsd=cdid+{$g_did}++connector+".(urlencode ($g_connector))."++source+".(urlencode ($g_source))."++";

		if (($g_doc_array['ddbdatalinker_objects'] > 0)&&($g_cat_object->is_diversity_dms ()))
		{
			$direct_cachedata['output_pages'] = ceil ($g_doc_array['ddbdatalinker_objects'] / $direct_settings['contentor_versions_per_page']);
			if ($direct_cachedata['output_pages'] < 1) { $direct_cachedata['output_pages'] = 1; }

			$g_offset = (($direct_cachedata['output_page'] - 1) * $direct_settings['contentor_versions_per_page']);
			$g_versions_array = $g_doc_object->get_versions ($g_offset,($direct_settings['contentor_versions_per_page'] - 1));

			if ($g_versions_array)
			{
				foreach ($g_versions_array as $g_version_object) { $direct_cachedata['output_doc_versions'][] = $g_version_object->parse ($g_connector_url); }
			}
		}
		else { $direct_cachedata['output_pages'] = 1; }

		if ($g_datasub_check) { direct_output_related_manager ("contentor_index_{$g_type}_versions_".$g_did,"post_module_service_action"); }
		else { direct_output_related_manager ("contentor_index_{$g_type}_versions_{$g_cat_array['ddbdatalinker_id']}_".$g_did,"post_module_service_action"); }

		$direct_classes['output']->oset ("contentor_".$g_type,"versions");
		$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
		$direct_classes['output']->page_show (direct_local_get ("contentor_docv_list"));
	}
	else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a=versions_ (#echo(__LINE__)#)"); }
	//j// EOA
	}

	$direct_cachedata['core_service_activated'] = 1;
	break 1;
}
//j// $direct_settings['a'] == "view"
case "view":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=view_ (#echo(__LINE__)#)"); }

	$g_did_d = (isset ($direct_settings['dsd']['cdid_d']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cdid_d'])) : "");
	$g_did = (isset ($direct_settings['dsd']['cdid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cdid'])) : $g_did_d);
	$g_type = (isset ($direct_settings['dsd']['ctype']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['ctype'])) : "");
	$direct_cachedata['output_page'] = (isset ($direct_settings['dsd']['page']) ? ($direct_classes['basic_functions']->inputfilter_number ($direct_settings['dsd']['page'])) : 1);

	$direct_cachedata['page_this'] = "m=contentor&a=view&dsd=cdid+{$g_did}++ctype+{$g_type}++page+".$direct_cachedata['output_page'];
	$direct_cachedata['page_backlink'] = "";
	$direct_cachedata['page_homelink'] = "";

	if ($direct_classes['kernel']->service_init_default ())
	{
	//j// BOA
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_cat.php");
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_doc.php");
	direct_local_integration ("contentor");

	$g_datasub_check = false;
	if ((!$g_did)&&($g_type)&&(isset ($direct_settings["contentor_{$g_type}_front_did"]))&&($direct_settings["contentor_{$g_type}_front_did"])) { $g_did = $direct_settings["contentor_{$g_type}_front_did"]; }
	$g_doc_object = new direct_contentor_doc ();

	if ($g_doc_object) { $g_doc_array = $g_doc_object->get ($g_did); }
	else { $g_doc_array = NULL; }

	$g_cat_array = NULL;

	if ($g_doc_array)
	{
		$g_type = $g_doc_array['ddbcontentor_docs_doctype'];

		if ($g_doc_array['ddbdatalinker_id_main'])
		{
			$g_cat_object = new direct_contentor_cat ();
			$g_cat_array = $g_cat_object->get ($g_doc_array['ddbdatalinker_id_main']);
		}
		else { $g_datasub_check = true; }
	}

	if ((!$g_datasub_check)&&(!is_array ($g_cat_array))) { $direct_classes['error_functions']->error_page ("standard","contentor_did_invalid","sWG/#echo(__FILEPATH__)# _a=view_ (#echo(__LINE__)#)"); }
	elseif (($g_doc_object->is_readable ())&&(($g_datasub_check)||($g_cat_object->is_readable ())))
	{
		if ($g_datasub_check) { direct_output_related_manager ("contentor_index_{$g_type}_view_".$g_did,"pre_module_service_action"); }
		else { direct_output_related_manager ("contentor_index_{$g_type}_view_{$g_cat_array['ddbdatalinker_id']}_".$g_did,"pre_module_service_action"); }

		$direct_classes['kernel']->service_https ($direct_settings["contentor_https_{$g_type}_view"],$direct_cachedata['page_this']);
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags.php");

		direct_class_init ("output");
		$direct_classes['output']->servicemenu ("contentor_".$g_type);

		if ((!$g_datasub_check)&&($g_type == "wiki"))
		{
			direct_local_integration ("contentor_wiki");
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags_wiki.php");
			direct_class_init ("formtags");
			$direct_classes['formtags']->define_connector ("m=contentor&s=wiki&a=[a]&dsd=ccid+{$g_cat_array['ddbdatalinker_id']}++[oid]source+".(urlencode (base64_encode ($direct_cachedata['page_this']))));
		}
		else
		{
			direct_class_init ("formtags");
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags.php");
		}

		if ($g_datasub_check) { $g_connector = ""; }
		else { $g_connector = urlencode (base64_encode ("m=contentor&a=[a]&dsd=[oid]")); }

		$direct_cachedata['output_source'] = urlencode (base64_encode ($direct_cachedata['page_this']));
		$g_rights_check = false;

		if ($g_doc_object->is_writable ()) { $g_rights_check = true; }
		elseif ((!$g_datasub_check)&&($g_doc_object->is_writable_group ())&&($direct_classes['kernel']->v_group_user_check_group ($g_cat_array['ddbcontentor_cats_owner_group']))) { $g_rights_check = true; }

		if ((($g_datasub_check)&&($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']) > 3))||((!$g_datasub_check)&&($g_cat_object->is_moderator ())))
		{
			if ($g_doc_object->is_sticky ()) { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=state&dsd=cdid+{$g_did}++cchange+unstick++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_doc_unstick")),$direct_settings['serviceicon_contentor_doc_unstick'],"url0"); }
			else { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=state&dsd=cdid+{$g_did}++cchange+stick++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_doc_stick")),$direct_settings['serviceicon_contentor_doc_stick'],"url0"); }

			if ($g_doc_object->is_locked ()) { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=state&dsd=cdid+{$g_did}++cchange+unlock++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_doc_unlock")),$direct_settings['serviceicon_contentor_doc_unlock'],"url0"); }
			else { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=state&dsd=cdid+{$g_did}++cchange+lock++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_doc_lock")),$direct_settings['serviceicon_contentor_doc_lock'],"url0"); }

			if (!$g_doc_object->is_published ()) { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=state&dsd=cdid+{$g_did}++cchange+publish++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_doc_publish")),$direct_settings['serviceicon_contentor_doc_publish'],"url0"); }
		}

		if ($g_datasub_check)
		{
			if ($g_rights_check){ $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=edit&dsd=cdid+{$g_did}++connector+{$g_connector}++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_doc_edit")),$direct_settings['serviceicon_contentor_doc_edit'],"url0"); }
		}
		else
		{
			if (($g_cat_object->is_writable ())&&($g_rights_check)) { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=edit&dsd=cdid+{$g_did}++connector+{$g_connector}++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_doc_edit")),$direct_settings['serviceicon_contentor_doc_edit'],"url0"); }

			if ($g_cat_object->is_diversity_dms ())
			{
				if ($g_doc_array['ddbdatalinker_objects'] > 0) { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=handbooks&a=versions&dsd=cdid+{$g_did}++connector+{$g_connector}++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_docv_list")),$direct_settings['serviceicon_contentor_docv_list'],"url0"); }
				elseif ($g_doc_array['ddbdatalinker_type'] == 3) { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=handbooks&a=versions&dsd=cdid+{$g_doc_array['ddbdatalinker_id_parent']}++connector+{$g_connector}++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_docv_list")),$direct_settings['serviceicon_contentor_docv_list'],"url0"); }
			}

			if ($g_cat_object->is_writable ()) { $direct_classes['output']->options_insert (1,"servicemenu","m=contentor&s=doc&a=new&dsd=ccid+{$g_cat_array['ddbdatalinker_id']}++connector+{$g_connector}++source+".$direct_cachedata['output_source'],(direct_local_get ("contentor_doc_new")),$direct_settings['serviceicon_contentor_doc_new'],"url0"); }

			$direct_cachedata['output_cat'] = $g_cat_object->parse ("m=contentor&a=[a]&dsd=[oid]");
		}

		$direct_cachedata['output_page_url'] = "m=contentor&a=view&dsd=cdid+{$g_did}++";
		$direct_cachedata['output_pages'] = $g_doc_object->get_pages ();

		if ($direct_cachedata['output_pages'] < 1) { $direct_cachedata['output_pages'] = 1; }
		if ((!$direct_cachedata['output_page'])||($direct_cachedata['output_page'] < 1)) { $direct_cachedata['output_page'] = 1; }
		if ($direct_cachedata['output_page'] > $direct_cachedata['output_pages']) { $direct_cachedata['output_page'] = $direct_cachedata['output_pages']; }

		if ($g_type == "handbooks") { $direct_cachedata['output_pages_show'] = true; }
		elseif ($direct_cachedata['output_pages'] > 1) { $direct_cachedata['output_pages_show'] = true; }
		else { $direct_cachedata['output_pages_show'] = false; }

		$direct_cachedata['output_doc'] = $g_doc_object->parse ("m=contentor&a=[a]&dsd=[oid]");
		$direct_cachedata['output_content'] = $direct_classes['formtags']->decode ($g_doc_object->get_page ($direct_cachedata['output_page']));

		$direct_cachedata['output_pages_structure'] = array ();
		$g_structure_array = $g_doc_object->get_structure ();

		if ($g_structure_array)
		{
			foreach ($g_structure_array as $g_page => $g_page_title)
			{
$direct_cachedata['output_pages_structure'][$g_page] = array (
"name" => $g_page_title,
"url" => direct_linker ("url0","m=contentor&a=view&dsd=cdid+{$g_did}++page+".$g_page)
);
			}
		}

		if ($g_datasub_check) { direct_output_related_manager ("contentor_index_{$g_type}_view_".$g_did,"post_module_service_action"); }
		else { direct_output_related_manager ("contentor_index_{$g_type}_view_{$g_cat_array['ddbdatalinker_id']}_".$g_did,"post_module_service_action"); }

		$direct_classes['output']->oset ("contentor_".$g_type,"view");
		$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
		$direct_classes['output']->page_show ($direct_cachedata['output_doc']['title']);
	}
	else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a=view_ (#echo(__LINE__)#)"); }
	//j// EOA
	}

	$direct_cachedata['core_service_activated'] = 1;
	break 1;
}
//j// EOS
}

//j// EOF
?>