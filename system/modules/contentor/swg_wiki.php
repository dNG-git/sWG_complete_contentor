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
* contentor/swg_wiki.php
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

if (!isset ($direct_settings['serviceicon_default_back'])) { $direct_settings['serviceicon_default_back'] = "mini_default_back.png"; }
$direct_settings['additional_copyright'][] = array ("Module contentor #echo(sWGcontentorVersion)# - (C) ","http://www.direct-netware.de/redirect.php?swg","direct Netware Group"," - All rights reserved");

//j// BOS
switch ($direct_settings['a'])
{
//j// $direct_settings['a'] == "wikilink"
case "wikilink":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=wikilink_ (#echo(__LINE__)#)"); }

	$g_cid = (isset ($direct_settings['dsd']['ccid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['ccid'])) : "");
	$g_did = (isset ($direct_settings['dsd']['cdid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cdid'])) : "");
	$g_wiki_id = (isset ($direct_settings['dsd']['cwikiid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cwikiid'])) : "");
	$g_connector = (isset ($direct_settings['dsd']['connector']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['connector'])) : "");
	$g_source = (isset ($direct_settings['dsd']['source']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['source'])) : "");
	$g_target = (isset ($direct_settings['dsd']['target']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['target'])) : "");

	$g_connector_url = ($g_connector ? base64_decode ($g_connector) : "m=contentor&a=[a]&dsd=[oid]");

	if ($g_cid) { $g_source_url = ($g_source ? base64_decode ($g_source) : "m=contentor&a=list&dsd=[oid]"); }
	else { $g_source_url = ($g_source ? base64_decode ($g_source) : "m=contentor&a=view&dsd=[oid]"); }

	if ($g_target) { $g_target_url = base64_decode ($g_target); }
	else
	{
		$g_target = $g_source;
		$g_target_url = ($g_source ? $g_source_url : "");
	}

	if ($g_cid) { $g_back_link = (((!$g_source)&&($g_connector_url)) ? preg_replace (array ("#\[a\]#","#\[oid\]#","#\[(.*?)\]#"),(array ("list","ccid+{$g_cid}++","")),$g_connector_url) : str_replace ("[oid]","ccid+{$g_cid}++",$g_source_url)); }
	else { $g_back_link = (((!$g_source)&&($g_connector_url)) ? preg_replace (array ("#\[a\]#","#\[oid\]#","#\[(.*?)\]#"),(array ("view","cdid+{$g_did}++","")),$g_connector_url) : str_replace ("[oid]","cdid+{$g_did}++",$g_source_url)); }

	$direct_cachedata['page_this'] = "";
	$direct_cachedata['page_backlink'] = $g_back_link;
	$direct_cachedata['page_homelink'] = $g_back_link;

	if ($direct_classes['kernel']->service_init_default ())
	{
	//j// BOA
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_cat.php");
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_doc.php");
	direct_local_integration ("contentor");
	direct_local_integration ("contentor_wiki");

	$g_cat_array = NULL;
	$g_doc_array = NULL;

	if ((!$g_cid)&&($g_did))
	{
		$g_doc_object = new direct_contentor_cat ();

		if ($g_doc_object) { $g_doc_array = $g_doc_object->get ($g_did); }
		if ((is_array ($g_doc_array))&&($g_doc_array['ddbdatalinker_id'] != $g_doc_array['ddbdatalinker_id_object'])) { $g_doc_array = $g_doc_object->get ($g_doc_array['ddbdatalinker_id_object']); }
		if ((is_array ($g_doc_array))&&($g_doc_array['ddbdatalinker_id_main'])) { $g_cid = $g_doc_array['ddbdatalinker_id_main']; }
	}

	if ((!$g_cid)&&(isset ($direct_settings["contentor_wiki_front_cid"]))&&($direct_settings["contentor_wiki_front_cid"])) { $g_cid = $direct_settings["contentor_wiki_front_cid"]; }

	if ($g_cid)
	{
		$g_cat_object = new direct_contentor_cat ();

		if ($g_cat_object)
		{
			$g_cat_object->define_doctype ("wiki");
			$g_cat_array = $g_cat_object->get ($g_cid);
		}
	}

	if ((!$g_connector_url)||((!is_array ($g_cat_array))&&(!is_array ($g_doc_array)))||(!isset ($direct_settings["contentor_".$g_cat_array['ddbcontentor_cats_doctype']]))) { $direct_classes['error_functions']->error_page ("standard","contentor_wiki_wikiid_invalid","sWG/#echo(__FILEPATH__)# _a=wikilink_ (#echo(__LINE__)#)"); }
	elseif ($g_cat_object->is_readable ())
	{
		direct_output_related_manager ("contentor_wiki_wikilink_".$g_cid,"pre_module_service_action");

		direct_class_init ("output");
		$direct_classes['output']->servicemenu ("contentor_wiki");
		$direct_classes['output']->options_insert (1,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

		$g_wiki_title = ($g_wiki_id ? base64_decode ($g_wiki_id) : "");

		if (strlen ($g_wiki_title))
		{
			$g_target_link = "";

			if (preg_match ("#^category(|\:)$#i",$g_wiki_title)) { $g_target_link = str_replace (array ("[a]","[oid]"),(array ("list","ccid+{$g_cid}++")),$g_connector_url); }
			elseif (preg_match ("#^category\:(.+?)$#i",$g_wiki_title,$g_result_array))
			{
				$g_cat_object = new direct_contentor_cat ();
				$g_cat_array = ($g_cat_object ? $g_cat_object->get_aid ($direct_settings['datalinkerd_table'].".ddbdatalinker_title",$g_result_array[1]) : NULL);
				if (is_array ($g_cat_array)) { $g_target_link = str_replace (array ("[a]","[oid]"),(array ("list","ccid+{$g_cat_array['ddbdatalinker_id']}++")),$g_connector_url); }
			}
			else
			{
				$g_doc_object = new direct_contentor_doc ();
				$g_doc_array = ($g_doc_object ? $g_doc_object->get_aid (array ($direct_settings['datalinker_table'].".ddbdatalinker_id_main",$direct_settings['datalinkerd_table'].".ddbdatalinker_title"),(array ($g_cid,$g_wiki_title))) : NULL);
				if (is_array ($g_doc_array)) { $g_target_link = str_replace (array ("[a]","[oid]"),(array ("view","cdid+{$g_doc_array['ddbdatalinker_id']}++")),$g_connector_url); }
			}
		}
		else { $g_target_link = str_replace (array ("[a]","[oid]"),(array ("list","ccid+{$g_cid}++")),$g_connector_url); }

		if ($g_target_link) { $direct_classes['output']->redirect (direct_linker ("url1",$g_target_link,false)); }
		elseif ($g_cat_object->is_writable ())
		{
			$g_target_link = "m=contentor&s=doc&a=new&dsd=ccid+{$g_cid}++ctitle+".(urlencode ($g_wiki_id))."++connector+".(urlencode ($g_connector))."++source+".(urlencode (base64_encode ($direct_cachedata['page_homelink'])));
			$direct_classes['output']->redirect (direct_linker ("url1",$g_target_link,false));
		}
		else { $direct_classes['error_functions']->error_page ("login","contentor_wiki_writing_access_denied","sWG/#echo(__FILEPATH__)# _a=wikilink_ (#echo(__LINE__)#)"); }
	}
	else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a=wikilink_ (#echo(__LINE__)#)"); }
	//j// EOA
	}

	$direct_cachedata['core_service_activated'] = 1;
	break 1;
}
//j// EOS
}

//j// EOF
?>