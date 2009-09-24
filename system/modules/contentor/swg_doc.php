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
* contentor/swg_doc.php
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

if (!isset ($direct_settings['datalinker_title_min'])) { $direct_settings['datalinker_title_min'] = 3; }
if (!isset ($direct_settings['datalinker_title_max'])) { $direct_settings['datalinker_title_max'] = 255; }
if (!isset ($direct_settings['contentor_datacenter_symbols'])) { $direct_settings['contentor_datacenter_symbols'] = false; }
if (!isset ($direct_settings['contentor_datacenter_symbols_preselect'])) { $direct_settings['contentor_datacenter_symbols_preselect'] = ""; }
if (!isset ($direct_settings['contentor_datacenter_path_symbols'])) { $direct_settings['contentor_datacenter_path_symbols'] = $direct_settings['path_themes']."/$direct_settings[theme]/"; }
if (!isset ($direct_settings['contentor_doc_teaser_length'])) { $direct_settings['contentor_doc_teaser_length'] = 500; }
if (!isset ($direct_settings['contentor_doc_default_gright'])) { $direct_settings['contentor_doc_default_gright'] = "r"; }
if (!isset ($direct_settings['contentor_doc_edit_credits_onetime'])) { $direct_settings['contentor_doc_edit_credits_onetime'] = 0; }
if (!isset ($direct_settings['contentor_doc_new_credits_onetime'])) { $direct_settings['contentor_doc_new_credits_onetime'] = 0; }
if (!isset ($direct_settings['contentor_doc_new_credits_periodically'])) { $direct_settings['contentor_doc_new_credits_periodically'] = 0; }
if (!isset ($direct_settings['contentor_handbooks'])) { $direct_settings['contentor_handbooks'] = false; }
if (!isset ($direct_settings['contentor_https_handbooks_edit'])) { $direct_settings['contentor_https_handbooks_edit'] = false; }
if (!isset ($direct_settings['contentor_https_news_edit'])) { $direct_settings['contentor_https_news_edit'] = false; }
if (!isset ($direct_settings['contentor_https_pages_edit'])) { $direct_settings['contentor_https_pages_edit'] = false; }
if (!isset ($direct_settings['contentor_https_wiki_edit'])) { $direct_settings['contentor_https_wiki_edit'] = false; }
if (!isset ($direct_settings['contentor_https_handbooks_new'])) { $direct_settings['contentor_https_handbooks_new'] = false; }
if (!isset ($direct_settings['contentor_https_news_new'])) { $direct_settings['contentor_https_news_new'] = false; }
if (!isset ($direct_settings['contentor_https_pages_new'])) { $direct_settings['contentor_https_pages_new'] = false; }
if (!isset ($direct_settings['contentor_https_wiki_new'])) { $direct_settings['contentor_https_wiki_new'] = false; }
if (!isset ($direct_settings['contentor_news'])) { $direct_settings['contentor_news'] = false; }
if (!isset ($direct_settings['contentor_pages'])) { $direct_settings['contentor_pages'] = false; }
if (!isset ($direct_settings['contentor_subs_types_supported'])) { $direct_settings['contentor_subs_types_supported'] = array (); }
if (!isset ($direct_settings['contentor_teaser_min'])) { $direct_settings['contentor_teaser_min'] = 2; }
if (!isset ($direct_settings['contentor_teaser_max'])) { $direct_settings['contentor_teaser_max'] = $direct_settings['contentor_doc_teaser_length']; }
if (!isset ($direct_settings['contentor_text_min'])) { $direct_settings['contentor_text_min'] = 25; }
if (!isset ($direct_settings['contentor_title_min'])) { $direct_settings['contentor_title_min'] = $direct_settings['datalinker_title_min']; }
if (!isset ($direct_settings['contentor_title_max'])) { $direct_settings['contentor_title_max'] = $direct_settings['datalinker_title_max']; }
if (!isset ($direct_settings['contentor_wiki'])) { $direct_settings['contentor_wiki'] = false; }
if (!isset ($direct_settings['formtags_overview_document_url'])) { $direct_settings['formtags_overview_document_url'] = "m=contentor&a=view&dsd=cdid+dng_{$direct_settings['lang']}_2_90000000001"; }
if (!isset ($direct_settings['serviceicon_default_back'])) { $direct_settings['serviceicon_default_back'] = "mini_default_back.png"; }
if (!isset ($direct_settings['swg_data_limit'])) { $direct_settings['swg_data_limit'] = 16777216; }
$direct_settings['additional_copyright'][] = array ("Module contentor #echo(sWGcontentorVersion)# - (C) ","http://www.direct-netware.de/redirect.php?swg","direct Netware Group"," - All rights reserved");

//j// BOS
switch ($direct_settings['a'])
{
//j// ($direct_settings['a'] == "edit")||($direct_settings['a'] == "edit-save")
case "edit":
case "edit-save":
{
	$g_mode_save = (($direct_settings['a'] == "edit-save") ? true : false);
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }

	$g_did = (isset ($direct_settings['dsd']['cdid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cdid'])) : "");
	$g_connector = (isset ($direct_settings['dsd']['connector']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['connector'])) : "");
	$g_source = (isset ($direct_settings['dsd']['source']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['source'])) : "");
	$g_target = (isset ($direct_settings['dsd']['target']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['target'])) : "");

	$g_connector_url = ($g_connector ? base64_decode ($g_connector) : "m=contentor&a=[a]&dsd=[oid]");
	$g_source_url = ($g_source ? base64_decode ($g_source) : "m=contentor&a=view&dsd=[oid]");

	if ($g_target) { $g_target_url = base64_decode ($g_target); }
	else
	{
		$g_target = $g_source;
		$g_target_url = ($g_source ? $g_source_url : "");
	}

	$g_back_link = (((!$g_source)&&($g_connector_url)) ? preg_replace (array ("#\[a\]#","#\[oid\]#","#\[(.*?)\]#"),(array ("view","cdid+{$g_did}++","")),$g_connector_url) : str_replace ("[oid]","cdid+{$g_did}++",$g_source_url));

	if ($g_mode_save)
	{
		$direct_cachedata['page_this'] = "";
		$direct_cachedata['page_backlink'] = "m=contentor&s=doc&a=edit&dsd=cdid+$g_did++connector+".(urlencode ($g_connector))."++source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
		$direct_cachedata['page_homelink'] = $g_back_link;
	}
	else
	{
		$direct_cachedata['page_this'] = "m=contentor&s=doc&a=edit&dsd=cdid+$g_did++connector+".(urlencode ($g_connector))."++source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
		$direct_cachedata['page_backlink'] = $g_back_link;
		$direct_cachedata['page_homelink'] = $g_back_link;
	}

	if ($direct_classes['kernel']->service_init_default ())
	{
	//j// BOA
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_cat.php");
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_doc.php");
	direct_local_integration ("contentor");

	$g_cat_array = NULL;
	$g_datasub_check = false;
	$g_doc_object = new direct_contentor_doc ();
	$g_rights_check = false;

	$g_doc_array = ($g_doc_object ? $g_doc_object->get ($g_did) : NULL);

	if ((is_array ($g_doc_array))&&(isset ($direct_settings["contentor_".$g_doc_array['ddbcontentor_docs_doctype']])))
	{
		if ($g_doc_array['ddbdatalinker_id_main'])
		{
			$g_cat_object = new direct_contentor_cat ();
			if ($g_cat_object) { $g_cat_array = $g_cat_object->get ($g_doc_array['ddbdatalinker_id_main']); }
			if ((is_array ($g_cat_array))&&(($g_doc_object->is_writable ())||(($g_doc_object->is_writable_group ())&&($direct_classes['kernel']->v_group_user_check_group ($g_cat_array['ddbcontentor_cats_owner_group']))))&&($g_cat_object->is_writable ())) { $g_rights_check = true; }
		}
		else
		{
			$g_datasub_check = true;
			$g_rights_check = $g_doc_object->is_writable ();
		}
	}

	if ((!$g_datasub_check)&&(!is_array ($g_cat_array))) { $direct_classes['error_functions']->error_page ("standard","contentor_did_invalid","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	elseif ($g_rights_check)
	{
		if ($g_mode_save)
		{
			if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_edit_{$g_did}_form_save","pre_module_service_action"); }
			else { direct_output_related_manager ("contentor_doc_edit_{$g_cat_array['ddbdatalinker_id']}_{$g_did}_form_save","pre_module_service_action"); }
		}
		elseif ($g_datasub_check) { direct_output_related_manager ("contentor_doc_edit_{$g_did}_form","pre_module_service_action"); }
		else { direct_output_related_manager ("contentor_doc_edit_{$g_cat_array['ddbdatalinker_id']}_{$g_did}_form","pre_module_service_action"); }

		if (!$g_mode_save) { $direct_classes['kernel']->service_https ($direct_settings["contentor_https_{$g_doc_array['ddbcontentor_docs_doctype']}_edit"],$direct_cachedata['page_this']); }
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formbuilder_datetime.php");
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/functions/swg_credits_manager.php");
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/functions/swg_tmp_storager.php");

		if (($direct_settings['contentor_datacenter_symbols'])&&(isset ($direct_settings['contentor_datacenter_symbols_did'])))
		{
			$direct_classes['basic_functions']->settings_get ($direct_settings['path_data']."/settings/swg_datacenter.php",true);
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_datacenter.php");
		}

		direct_class_init ("formbuilder");

		if ($g_doc_array['ddbcontentor_docs_doctype'] == "wiki")
		{
			direct_local_integration ("contentor_wiki");
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags_wiki.php");
			direct_class_init ("formtags");

			if ($g_datasub_check) { $direct_classes['formtags']->define_connector ("m=contentor&s=wiki&a=[a]&dsd=cdid+{$g_did}++[oid]"); }
			else { $direct_classes['formtags']->define_connector ("m=contentor&s=wiki&a=[a]&dsd=ccid+{$g_cat_array['ddbdatalinker_id']}++[oid]"); }
		}
		else
		{
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags.php");
			direct_class_init ("formtags");
		}

		direct_class_init ("output");
		$direct_classes['output']->options_insert (2,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

		if (($g_datasub_check)||(!$g_cat_object->is_writable_as_submission ()))
		{
			$g_credits_periodically = 0;
			if (!$g_datasub_check) { direct_credits_payment_get_specials ("contentor_doc_edit",$g_cat_array['ddbdatalinker_id'],$direct_settings['contentor_doc_edit_credits_onetime'],$g_credits_periodically); }
			$direct_cachedata['output_credits_information'] = direct_credits_payment_info ($direct_settings['contentor_doc_edit_credits_onetime'],0);
			$direct_cachedata['output_credits_payment_data'] = direct_credits_payment_check (true,$direct_settings['contentor_doc_edit_credits_onetime']);
		}

		if ($g_datasub_check) { $g_rights_check = (($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']) > 3) ? true : false); }
		else { $g_rights_check = $g_cat_object->is_moderator (); }

		if ($g_mode_save)
		{
/* -------------------------------------------------------------------------
We should have input in save mode
------------------------------------------------------------------------- */

			$direct_cachedata['i_ctitle'] = (isset ($GLOBALS['i_ctitle']) ? ($direct_classes['basic_functions']->inputfilter_basic ($GLOBALS['i_ctitle'])) : "");
			$direct_cachedata['i_cteaser'] = (isset ($GLOBALS['i_cteaser']) ? ($direct_classes['basic_functions']->inputfilter_basic ($GLOBALS['i_cteaser'])) : "");
			if (($direct_settings['contentor_datacenter_symbols'])&&(isset ($direct_settings['contentor_datacenter_symbols_did']))) { $direct_cachedata['i_csymbol'] = (isset ($GLOBALS['i_csymbol']) ? (urlencode ($GLOBALS['i_csymbol'])) : ""); }
			$direct_cachedata['i_ctext'] = (isset ($GLOBALS['i_ctext']) ? ($direct_classes['basic_functions']->inputfilter_basic ($GLOBALS['i_ctext'])) : "");

			$direct_cachedata['i_0_cpubdate'] = (isset ($GLOBALS['i_0_cpubdate']) ? (str_replace ("'","",$GLOBALS['i_0_cpubdate'])) : "");
			$direct_cachedata['i_1_cpubdate'] = (isset ($GLOBALS['i_1_cpubdate']) ? (str_replace ("'","",$GLOBALS['i_1_cpubdate'])) : "");
			$direct_cachedata['i_2_cpubdate'] = (isset ($GLOBALS['i_2_cpubdate']) ? (str_replace ("'","",$GLOBALS['i_2_cpubdate'])) : "");
			$direct_cachedata['i_0_cpubtime'] = (isset ($GLOBALS['i_0_cpubtime']) ? (str_replace ("'","",$GLOBALS['i_0_cpubtime'])) : "");
			$direct_cachedata['i_1_cpubtime'] = (isset ($GLOBALS['i_1_cpubtime']) ? (str_replace ("'","",$GLOBALS['i_1_cpubtime'])) : "");
			$direct_cachedata['i_2_cpubtime'] = (isset ($GLOBALS['i_2_cpubtime']) ? (str_replace ("'","",$GLOBALS['i_2_cpubtime'])) : "");

			$direct_cachedata['i_cpreview'] = (isset ($GLOBALS['i_cpreview']) ? (str_replace ("'","",$GLOBALS['i_cpreview'])) : "");
			$direct_cachedata['i_cpreview'] = str_replace ("<value value='$direct_cachedata[i_cpreview]' />","<value value='$direct_cachedata[i_cpreview]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

			if ((!$g_datasub_check)&&($g_cat_array['ddbcontentor_cats_front_id']))
			{
				$direct_cachedata['i_cfrontpage'] = (isset ($GLOBALS['i_cfrontpage']) ? (str_replace ("'","",$GLOBALS['i_cfrontpage'])) : "");
				$direct_cachedata['i_cfrontpage'] = str_replace ("<value value='$direct_cachedata[i_cfrontpage]' />","<value value='$direct_cachedata[i_cfrontpage]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");
			}

			if ($g_rights_check)
			{
				$direct_cachedata['i_cviews_count'] = (isset ($GLOBALS['i_cviews_count']) ? (str_replace ("'","",$GLOBALS['i_cviews_count'])) : "");
				$direct_cachedata['i_cviews_count'] = str_replace ("<value value='$direct_cachedata[i_cviews_count]' />","<value value='$direct_cachedata[i_cviews_count]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

				$direct_cachedata['i_csubs_allowed'] = (isset ($GLOBALS['i_csubs_allowed']) ? (str_replace ("'","",$GLOBALS['i_csubs_allowed'])) : "");
				$direct_cachedata['i_csubs_allowed'] = str_replace ("<value value='$direct_cachedata[i_csubs_allowed]' />","<value value='$direct_cachedata[i_csubs_allowed]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

				$direct_cachedata['i_csubs_hidden'] = (isset ($GLOBALS['i_csubs_hidden']) ? (str_replace ("'","",$GLOBALS['i_csubs_hidden'])) : "");
				$direct_cachedata['i_csubs_hidden'] = str_replace ("<value value='$direct_cachedata[i_csubs_hidden]' />","<value value='$direct_cachedata[i_csubs_hidden]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

				$direct_cachedata['i_csubs_type'] = (isset ($GLOBALS['i_csubs_type']) ? (str_replace ("'","",$GLOBALS['i_csubs_type'])) : 0);

				if ((!$g_datasub_check)&&($g_cat_object->is_diversity_dms ()))
				{
					$direct_cachedata['i_ceditcurrent'] = (isset ($GLOBALS['i_ceditcurrent']) ? (str_replace ("'","",$GLOBALS['i_ceditcurrent'])) : "");
					$direct_cachedata['i_ceditcurrent'] = str_replace ("<value value='$direct_cachedata[i_ceditcurrent]' />","<value value='$direct_cachedata[i_ceditcurrent]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

					$direct_cachedata['i_ceditpubdatetime'] = (isset ($GLOBALS['i_ceditpubdatetime']) ? (str_replace ("'","",$GLOBALS['i_ceditpubdatetime'])) : "");
					$direct_cachedata['i_ceditpubdatetime'] = str_replace ("<value value='$direct_cachedata[i_ceditpubdatetime]' />","<value value='$direct_cachedata[i_ceditpubdatetime]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");
				}

				if ($g_doc_object->is_published ())
				{
					$direct_cachedata['i_cpublic'] = (isset ($GLOBALS['i_cpublic']) ? (str_replace ("'","",$GLOBALS['i_cpublic'])) : "");
					$direct_cachedata['i_cpublic'] = str_replace ("<value value='$direct_cachedata[i_cpublic]' />","<value value='$direct_cachedata[i_cpublic]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");
				}

				$direct_cachedata['i_cgright'] = (isset ($GLOBALS['i_cgright']) ? (str_replace ("'","",$GLOBALS['i_cgright'])) : "");

				if ($g_doc_object->is_published ()) { $direct_cachedata['i_cpright'] = (isset ($GLOBALS['i_cpright']) ? (str_replace ("'","",$GLOBALS['i_cpright'])) : ""); }

				$direct_cachedata['i_csticky'] = (isset ($GLOBALS['i_csticky']) ? (str_replace ("'","",$GLOBALS['i_csticky'])) : "");
				$direct_cachedata['i_csticky'] = str_replace ("<value value='$direct_cachedata[i_csticky]' />","<value value='$direct_cachedata[i_csticky]' /><selected value='1' />","<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>");

				$direct_cachedata['i_clocked'] = (isset ($GLOBALS['i_clocked']) ? (str_replace ("'","",$GLOBALS['i_clocked'])) : "");
				$direct_cachedata['i_clocked'] = str_replace ("<value value='$direct_cachedata[i_clocked]' />","<value value='$direct_cachedata[i_clocked]' /><selected value='1' />","<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>");
			}
			elseif ((!$g_datasub_check)&&(!$g_cat_object->is_writable_as_submission ())&&($g_doc_object->is_published ()))
			{
				if ((!$g_datasub_check)&&($g_cat_object->is_sub_allowed ()))
				{
					$direct_cachedata['i_csubs_allowed'] = (isset ($GLOBALS['i_csubs_allowed']) ? (str_replace ("'","",$GLOBALS['i_csubs_allowed'])) : "");
					$direct_cachedata['i_csubs_allowed'] = str_replace ("<value value='$direct_cachedata[i_csubs_allowed]' />","<value value='$direct_cachedata[i_csubs_allowed]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

					$direct_cachedata['i_csubs_hidden'] = (isset ($GLOBALS['i_csubs_hidden']) ? (str_replace ("'","",$GLOBALS['i_csubs_hidden'])) : "");
					$direct_cachedata['i_csubs_hidden'] = str_replace ("<value value='$direct_cachedata[i_csubs_hidden]' />","<value value='$direct_cachedata[i_csubs_hidden]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

					$direct_cachedata['i_csubs_type'] = (isset ($GLOBALS['i_csubs_type']) ? (str_replace ("'","",$GLOBALS['i_csubs_type'])) : 0);
				}

				$direct_cachedata['i_cpublic'] = (isset ($GLOBALS['i_cpublic']) ? (str_replace ("'","",$GLOBALS['i_cpublic'])) : "");
				$direct_cachedata['i_cpublic'] = str_replace ("<value value='$direct_cachedata[i_cpublic]' />","<value value='$direct_cachedata[i_cpublic]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");
			}
		}
		else
		{
			$direct_cachedata['i_ctitle'] = $g_doc_array['ddbdatalinker_title'];
			$direct_cachedata['i_cteaser'] = $direct_classes['formtags']->recode_newlines (direct_output_smiley_cleanup ($g_doc_array['ddbcontentor_docs_desc']),false);

			if (($direct_settings['contentor_datacenter_symbols'])&&(isset ($direct_settings['contentor_datacenter_symbols_did'])))
			{
				$direct_cachedata['i_csymbol'] = uniqid ("");

$g_task_array = array (
"core_sid" => "d4d66a02daefdb2f70ff2507a78fd5ec",
// md5 ("datacenter")
"datacenter_marker_type" => "files-only",
"datacenter_selection_did" => $direct_settings['contentor_datacenter_symbols_did'],
"datacenter_selection_done" => 0,
"datacenter_selection_path" => $direct_settings['contentor_datacenter_path_symbols'],
"datacenter_selection_quantity" => 1,
"uuid" => $direct_settings['uuid']
);

				$g_symbol_marked_object = ($g_doc_array['ddbdatalinker_symbol'] ? new direct_datacenter () : NULL);
				$g_symbol_marked_array = ($g_symbol_marked_object ? $g_symbol_marked_object->get_aid ("ddbdatacenter_plocation",$g_doc_array['ddbdatalinker_symbol']) : NULL);
				if ($g_symbol_marked_array) { $g_task_array['datacenter_objects_marked'] = array ($g_symbol_marked_array['ddbdatacenter_id'] => $g_symbol_marked_array['ddbdatacenter_id']); }

				direct_tmp_storage_write ($g_task_array,$direct_cachedata['i_csymbol'],"d4d66a02daefdb2f70ff2507a78fd5ec","task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));
				// md5 ("datacenter")
			}

			$direct_cachedata['i_ctext'] = $direct_classes['formtags']->recode_newlines (direct_output_smiley_cleanup ($g_doc_array['ddbdata_data']),false);

			if ((!$g_datasub_check)&&($g_cat_object->is_diversity_dms ()))
			{
				$direct_cachedata['i_cpubdate'] = $direct_cachedata['core_time'];
				$direct_cachedata['i_cpubtime'] = $direct_cachedata['core_time'];
			}
			else
			{
				$direct_cachedata['i_cpubdate'] = $g_cat_array['ddbdatalinker_sorting_date'];
				$direct_cachedata['i_cpubtime'] = $g_cat_array['ddbdatalinker_sorting_date'];
			}

			$direct_cachedata['i_cpreview'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>";

			if ((!$g_datasub_check)&&($g_cat_array['ddbcontentor_cats_front_id']))
			{
				if ($g_doc_array['ddbcontentor_docs_id_front']) { $direct_cachedata['i_cfrontpage'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
				else { $direct_cachedata['i_cfrontpage'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
			}

			if ($g_rights_check)
			{
				if ($g_doc_object->is_views_counting ()) { $direct_cachedata['i_cviews_count'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
				else { $direct_cachedata['i_cviews_count'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

				if ($g_doc_array['ddbdatalinker_datasubs_new']) { $direct_cachedata['i_csubs_allowed'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
				else { $direct_cachedata['i_csubs_allowed'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

				if ($g_doc_array['ddbdatalinker_datasubs_hide']) { $direct_cachedata['i_csubs_hidden'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
				else { $direct_cachedata['i_csubs_hidden'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

				$direct_cachedata['i_csubs_type'] = (isset ($g_doc_array['ddbdatalinker_datasubs_type']) ? str_replace ("'","",$g_doc_array['ddbdatalinker_datasubs_type']) : 0);

				if ((!$g_datasub_check)&&($g_cat_object->is_diversity_dms ()))
				{
					$direct_cachedata['i_ceditcurrent'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>";
					$direct_cachedata['i_ceditpubdatetime'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>";
				}

				if ($g_doc_object->is_published ())
				{
					if ($g_doc_array['ddbcontentor_docs_public']) { $direct_cachedata['i_cpublic'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
					else { $direct_cachedata['i_cpublic'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
				}

				$direct_cachedata['i_cgright'] = str_replace ("'","",$g_doc_array['ddbdata_mode_group']);

				if ($g_doc_object->is_published ()) { $direct_cachedata['i_cpright'] = str_replace ("'","",$g_doc_array['ddbdata_mode_all']); }

				if ($g_doc_object->is_sticky ()) { $direct_cachedata['i_csticky'] = "<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>"; }
				else { $direct_cachedata['i_csticky'] = "<evars><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>"; }

				if ($g_doc_object->is_locked ()) { $direct_cachedata['i_clocked'] = "<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>"; }
				else { $direct_cachedata['i_clocked'] = "<evars><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>"; }
			}
			elseif ((!$g_datasub_check)&&(!$g_cat_object->is_writable_as_submission ())&&($g_doc_object->is_published ()))
			{
				if ((!$g_datasub_check)&&($g_cat_object->is_sub_allowed ()))
				{
					if ($g_doc_array['ddbdatalinker_datasubs_new']) { $direct_cachedata['i_csubs_allowed'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
					else { $direct_cachedata['i_csubs_allowed'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

					if ($g_doc_array['ddbdatalinker_datasubs_hide']) { $direct_cachedata['i_csubs_hidden'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
					else { $direct_cachedata['i_csubs_hidden'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

					$direct_cachedata['i_csubs_type'] = (isset ($g_doc_array['ddbdatalinker_datasubs_type']) ? str_replace ("'","",$g_doc_array['ddbdatalinker_datasubs_type']) : 0);
				}

				if ($g_doc_array['ddbcontentor_docs_public']) { $direct_cachedata['i_cpublic'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
				else { $direct_cachedata['i_cpublic'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
			}
		}

		if (isset ($direct_cachedata['i_csubs_type']))
		{
$direct_cachedata['i_csubs_type'] = str_replace ("<value value='$direct_cachedata[i_csubs_type]' />","<value value='$direct_cachedata[i_csubs_type]' /><selected value='1' />","<evars>
<default><value value='0' /><text><![CDATA[".(direct_local_get ("core_datasub_title_default"))."]]></text></default><attachments><value value='1' /><text><![CDATA[".(direct_local_get ("core_datasub_title_attachments"))."]]></text></attachments><downloads><value value='2' /><text><![CDATA[".(direct_local_get ("core_datasub_title_downloads"))."]]></text></downloads><links><value value='3' /><text><![CDATA[".(direct_local_get ("core_datasub_title_links"))."]]></text></links>
</evars>");
		}

		if ($g_rights_check)
		{
			if (isset ($direct_cachedata['i_cgright']))
			{
$direct_cachedata['i_cgright'] = str_replace ("<value value='$direct_cachedata[i_cgright]' />","<value value='$direct_cachedata[i_cgright]' /><selected value='1' />","<evars>
<norights><value value='-' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_0"))."]]></text></norights><read><value value='r' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_r"))."]]></text></read><write><value value='w' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_w"))."]]></text></write>
</evars>");
			}

			if (isset ($direct_cachedata['i_cpright']))
			{
$direct_cachedata['i_cpright'] = str_replace ("<value value='$direct_cachedata[i_cpright]' />","<value value='$direct_cachedata[i_cpright]' /><selected value='1' />","<evars>
<norights><value value='-' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_0"))."]]></text></norights><read><value value='r' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_r"))."]]></text></read><write><value value='w' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_w"))."]]></text></write>
</evars>");
			}
		}

/* -------------------------------------------------------------------------
Build the form
------------------------------------------------------------------------- */

		$direct_classes['formbuilder']->entry_add ("subtitle","doc_info",(direct_local_get ("contentor_doc_info")));
		$direct_classes['formbuilder']->entry_add_text ("ctitle",(direct_local_get ("contentor_title")),true,"m",$direct_settings['contentor_title_min'],$direct_settings['contentor_title_max']);
		$direct_classes['formbuilder']->entry_add_jfield_textarea ("cteaser",(direct_local_get ("contentor_teaser")),false,"s",$direct_settings['contentor_teaser_min'],$direct_settings['contentor_teaser_max']);
		if (isset ($direct_cachedata['i_csymbol'])) { $direct_classes['formbuilder']->entry_add_embed ("csymbol",(direct_local_get ("contentor_symbol")),false,"m=dataport&s=swgap;datacenter;selector_icons&dsd=",false,"s"); }
		$direct_classes['formbuilder']->entry_add ("spacer");

		if ($direct_settings['formtags_overview_document_url']) { $direct_classes['formbuilder']->entry_add_jfield_textarea ("ctext",(direct_local_get ("contentor_text")),true,"l",$direct_settings['contentor_text_min'],$direct_settings['swg_data_limit'],(direct_local_get ("formtags_overview_document")),(direct_linker ("url0",$direct_settings['formtags_overview_document_url']))); }
		else { $direct_classes['formbuilder']->entry_add_jfield_textarea ("ctext",(direct_local_get ("contentor_text")),true,"l",$direct_settings['contentor_text_min'],$direct_settings['swg_data_limit']); }

		$direct_classes['formbuilder']->entry_add_date ("cpubdate",(direct_local_get ("contentor_pubdate")),true);
		$direct_classes['formbuilder']->entry_add_time ("cpubtime",(direct_local_get ("contentor_pubtime")),true);
		$direct_classes['formbuilder']->entry_add ("spacer");
		$direct_classes['formbuilder']->entry_add_radio ("cpreview",(direct_local_get ("core_preview")));

		if (isset ($direct_cachedata['i_cfrontpage']))
		{
			$direct_classes['formbuilder']->entry_add ("spacer");
			$direct_classes['formbuilder']->entry_add_radio ("cfrontpage",(direct_local_get ("contentor_doc_on_frontpage")),true);
		}

		if ($g_rights_check)
		{
			$direct_classes['formbuilder']->entry_add ("spacer");
			$direct_classes['formbuilder']->entry_add_select ("cviews_count",(direct_local_get ("contentor_doc_views_count")),true,"s");
			$direct_classes['formbuilder']->entry_add_select ("csubs_allowed",(direct_local_get ("core_datasub_allowed")),true,"s");
			$direct_classes['formbuilder']->entry_add_select ("csubs_hidden",(direct_local_get ("core_datasub_hide")),true,"s");
			$direct_classes['formbuilder']->entry_add_radio ("csubs_type",(direct_local_get ("core_datasub_type")),true);
			$direct_classes['formbuilder']->entry_add ("spacer");

			if (isset ($direct_cachedata['i_ceditcurrent']))
			{
				$direct_classes['formbuilder']->entry_add_select ("ceditcurrent",(direct_local_get ("contentor_doc_edit_current")),true,"s");
				$direct_classes['formbuilder']->entry_add_select ("ceditpubdatetime",(direct_local_get ("contentor_doc_edit_pub_datetime")),true,"s");
				$direct_classes['formbuilder']->entry_add ("spacer");
			}

			if (isset ($direct_cachedata['i_cpublic'])) { $direct_classes['formbuilder']->entry_add_select ("cpublic",(direct_local_get ("contentor_doc_public")),true,"s"); }
			$direct_classes['formbuilder']->entry_add_select ("cgright",(direct_local_get ("contentor_doc_gright")),false,"s");
			if (isset ($direct_cachedata['i_cpright'])) { $direct_classes['formbuilder']->entry_add_select ("cpright",(direct_local_get ("contentor_doc_pright")),false,"s"); }
			$direct_classes['formbuilder']->entry_add ("spacer");
			$direct_classes['formbuilder']->entry_add_select ("csticky",(direct_local_get ("contentor_doc_stick")),false,"s");
			$direct_classes['formbuilder']->entry_add_select ("clocked",(direct_local_get ("contentor_doc_lock")),false,"s");
		}
		elseif (isset ($direct_cachedata['i_cpublic']))
		{
			$direct_classes['formbuilder']->entry_add ("spacer");

			if (isset ($direct_cachedata['i_csubs_allowed']))
			{
				$direct_classes['formbuilder']->entry_add_select ("csubs_allowed",(direct_local_get ("core_datasub_allowed")),true,"s");
				$direct_classes['formbuilder']->entry_add_select ("csubs_hidden",(direct_local_get ("core_datasub_hide")),true,"s");
				$direct_classes['formbuilder']->entry_add_radio ("csubs_type",(direct_local_get ("core_datasub_type")),true);
			}

			$direct_classes['formbuilder']->entry_add_select ("cpublic",(direct_local_get ("contentor_doc_public")),true,"s");
		}

		$direct_cachedata['output_formbutton'] = direct_local_get ("core_save");
		$direct_cachedata['output_formelements'] = $direct_classes['formbuilder']->form_get ($g_mode_save);
		$direct_cachedata['output_formtarget'] = "m=contentor&s=doc&a=edit-save&dsd=cdid+$g_did++connector+".(urlencode ($g_connector))."++source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
		$direct_cachedata['output_formtitle'] = direct_local_get ("contentor_doc_edit");

		if (($g_mode_save)&&($direct_classes['formbuilder']->check_result))
		{
/* -------------------------------------------------------------------------
Save data edited
------------------------------------------------------------------------- */

			if (isset ($direct_cachedata['i_ceditcurrent']))
			{
				if (!$direct_cachedata['i_ceditcurrent']) { $direct_cachedata['i_ceditpubdatetime'] = 1; }
			}
			else
			{
				$direct_cachedata['i_ceditcurrent'] = 0;
				$direct_cachedata['i_ceditpubdatetime'] = 1;
			}

			$direct_cachedata['i_cpublic'] = (((isset ($direct_cachedata['i_cpublic']))&&($direct_cachedata['i_cpublic'])) ? 1 : 0);
			$direct_cachedata['i_csticky'] = (((isset ($direct_cachedata['i_csticky']))&&($direct_cachedata['i_csticky'])) ? 1 : 0);
			$direct_cachedata['i_clocked'] = (((isset ($direct_cachedata['i_clocked']))&&($direct_cachedata['i_clocked'])) ? 1 : 0);

			if (!isset ($direct_cachedata['i_cgright']))
			{
				if ((!$g_datasub_check)&&($g_cat_array['ddbcontentor_cats_owner_group'])) { $direct_cachedata['i_cgright'] = (($g_cat_object->is_moderated ()) ? "r" : "w"); }
				else { $direct_cachedata['i_cgright'] = "-"; }
			}

			if (!isset ($direct_cachedata['i_cpright'])) { $direct_cachedata['i_cpright'] = ((($g_doc_object->is_published ())&&(($g_datasub_check)||($g_cat_array['ddbcontentor_cats_public']))) ? "r" : "-"); }

			$g_continue_check = (((!$g_datasub_check)&&($g_cat_object->is_writable_as_submission ())) ? true : direct_credits_payment_check (false,$direct_settings['contentor_doc_edit_credits_onetime']));

			if ($g_continue_check)
			{
				$direct_cachedata['i_cteaser'] = ((trim ($direct_cachedata['i_cteaser'])) ? $direct_classes['formtags']->encode ($direct_cachedata['i_cteaser']) : "");
				$direct_cachedata['i_ctext'] = $direct_classes['formtags']->encode ($direct_cachedata['i_ctext']);

				if (!$direct_cachedata['i_cteaser'])
				{
					$direct_cachedata['i_cteaser'] = preg_replace ("#\[page:(.*?)\]#i"," ",$direct_cachedata['i_ctext']);
					$direct_cachedata['i_cteaser'] = mb_substr ($direct_cachedata['i_cteaser'],0,$direct_settings['contentor_doc_teaser_length']);
				}

				$direct_cachedata['i_ctext'] = direct_output_smiley_encode ($direct_cachedata['i_ctext']);

				if ($direct_cachedata['i_cpreview'])
				{
					$direct_cachedata['output_title'] = direct_html_encode_special ($direct_cachedata['i_ctitle']);
					$direct_cachedata['output_teaser'] = $direct_classes['formtags']->decode ($direct_cachedata['i_cteaser']);

					$direct_cachedata['output_text'] = preg_replace ("#\[page:(.*?)\]#i","[newline][hr]\\1[hr]",$direct_cachedata['i_ctext']);
					$direct_cachedata['output_text'] = $direct_classes['formtags']->decode ($direct_cachedata['output_text']);

					$direct_cachedata['output_username'] = $direct_settings['user']['name_html'];

					$direct_cachedata['output_preview_function_file'] = "swgi_contentor";
					$direct_cachedata['output_preview_function'] = "contentor_oset_doc_preview";

					if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_edit_{$g_did}_form_save","post_module_service_action"); }
					else { direct_output_related_manager ("contentor_doc_edit_{$g_cat_array['ddbdatalinker_id']}_{$g_did}_form_save","post_module_service_action"); }

					$direct_classes['output']->oset ("default","form_preview");
					$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
					$direct_classes['output']->page_show ($direct_cachedata['output_formtitle']);
				}
				else
				{
					$direct_classes['db']->v_transaction_begin ();

					if ((!$g_datasub_check)&&($g_cat_object->is_diversity_dms ())&&(!$direct_cachedata['i_ceditcurrent']))
					{
						if ((!$g_cat_object->is_writable_as_submission ())&&($direct_cachedata['i_cpublic']))
						{
							$g_doc_array['ddbdatalinker_id_object'] = uniqid ("");
							$g_doc_array['ddbcontentor_docs_id'] = $g_doc_array['ddbdatalinker_id_object'];

							if ($g_doc_array['ddbdatalinker_type'] == 3)
							{
								$g_did = $g_doc_array['ddbdatalinker_id_parent'];
								$g_doc_active_object = new direct_contentor_doc ();

								$g_doc_active_array = ($g_doc_active_object ? $g_doc_active_object->get ($g_did) : $g_doc_array);

								$g_doc_array['ddbdatalinker_id'] = $g_did;
								$g_doc_array['ddbdatalinker_id_parent'] = $g_doc_active_array['ddbdatalinker_id_main'];
								$g_doc_array['ddbdatalinker_type'] = 2;
								$g_doc_array['ddbdatalinker_subs'] = $g_doc_active_array['ddbdatalinker_subs'];
								$g_doc_array['ddbdatalinker_objects'] = (1 + $g_doc_active_array['ddbdatalinker_objects']);
							}
							else { $g_doc_array['ddbdatalinker_objects'] += 1; }

							$g_continue_check = $g_doc_object->update_latest_version ();
						}
						elseif ($g_doc_array['ddbcontentor_docs_public'])
						{
							$g_doc_array['ddbdatalinker_id'] = uniqid ("");
							$g_doc_array['ddbdatalinker_id_object'] = $g_doc_array['ddbdatalinker_id'];
							if ($g_doc_array['ddbdatalinker_id_parent'] == $g_doc_array['ddbdatalinker_id_main']) { $g_doc_array['ddbdatalinker_id_parent'] = $g_did; }
							$g_doc_array['ddbdatalinker_type'] = 3;
							$g_doc_array['ddbdatalinker_subs'] = 0;
							$g_doc_array['ddbdatalinker_objects'] = 0;
							$g_doc_array['ddbcontentor_docs_id'] = $g_doc_array['ddbdatalinker_id'];
							$g_did = $g_doc_array['ddbdatalinker_id'];
						}

						$g_insert_check = true;
					}
					else { $g_insert_check = false; }

					if ($g_continue_check)
					{
						if (isset ($direct_cachedata['i_csymbol']))
						{
							$g_task_array = direct_tmp_storage_get ("evars",$direct_cachedata['i_csymbol'],"d4d66a02daefdb2f70ff2507a78fd5ec","selector_cache");
							// md5 ("datacenter")
							$direct_cachedata['i_csymbol'] = "";

							if ((is_array ($g_task_array['datacenter_objects_marked']))&&(!empty ($g_task_array['datacenter_objects_marked'])))
							{
								$g_symbol_marked_id = array_shift ($g_task_array['datacenter_objects_marked']);
								$g_symbol_marked_object = ($g_symbol_marked_id ? new direct_datacenter () : NULL);
								if (($g_symbol_marked_object)&&($g_symbol_marked_object->get ($g_symbol_marked_id))) { $direct_cachedata['i_csymbol'] = $g_symbol_marked_object->get_plocation (); }
							}
						}
						else { $direct_cachedata['i_csymbol'] = ""; }

						$g_doc_array['ddbdatalinker_position'] = $direct_cachedata['i_csticky'];

						if ($direct_cachedata['i_ceditpubdatetime'])
						{
							$g_date_array = explode (".",$direct_cachedata['i_cpubdate']);
							$g_time_array = explode (".",$direct_cachedata['i_cpubtime']);
							$g_doc_array['ddbdatalinker_sorting_date'] = gmmktime ($g_time_array[0],$g_time_array[1],$g_time_array[2],$g_date_array[1],$g_date_array[0],$g_date_array[2]);
						}

						$g_doc_array['ddbdatalinker_symbol'] = $direct_cachedata['i_csymbol'];
						$g_doc_array['ddbdatalinker_title'] = $direct_cachedata['i_ctitle'];

						if (isset ($direct_cachedata['i_csubs_allowed']))
						{
							if ($direct_cachedata['i_csubs_allowed'])
							{
								$g_doc_array['ddbdatalinker_datasubs_type'] = $direct_cachedata['i_csubs_type'];
								$g_doc_array['ddbdatalinker_datasubs_hide'] = $direct_cachedata['i_csubs_hidden'];
								$g_doc_array['ddbdatalinker_datasubs_new'] = 1;
							}
							else { $g_doc_array['ddbdatalinker_datasubs_new'] = 0; }
						}

						if (isset ($direct_cachedata['i_cviews_count'])) { $g_doc_array['ddbdatalinker_views_count'] = ($direct_cachedata['i_cviews_count'] ? 1 : 0); }
						if (isset ($direct_cachedata['i_cfrontpage'])) { $g_doc_array['ddbcontentor_docs_id_front'] = ($direct_cachedata['i_cfrontpage'] ? $g_cat_array['ddbcontentor_cats_id_front'] : ""); }

						if ((!$g_datasub_check)&&($g_cat_object->is_writable_as_submission ()))
						{
							if ($g_doc_array['ddbcontentor_docs_author_id'] != $direct_settings['user']['id']) { $g_doc_array['ddbcontentor_docs_author_id'] = $direct_settings['user']['id']; }
							$g_doc_array['ddbcontentor_docs_author_ip'] = $direct_settings['user_ip'];
							$g_doc_array['ddbcontentor_docs_owner_id'] = "";
							$g_doc_array['ddbcontentor_docs_owner_ip'] = "";
						}
						elseif ($g_doc_object->is_published ())
						{
							if ($g_doc_array['ddbcontentor_docs_owner_id'] != $direct_settings['user']['id']) { $g_doc_array['ddbcontentor_docs_owner_id'] = $direct_settings['user']['id']; }
							$g_doc_array['ddbcontentor_docs_owner_ip'] = $direct_settings['user_ip'];
						}

						$g_doc_array['ddbcontentor_docs_time'] = $direct_cachedata['core_time'];
						$g_doc_array['ddbcontentor_docs_desc'] = $direct_cachedata['i_cteaser'];
						$g_doc_array['ddbcontentor_docs_locked'] = $direct_cachedata['i_clocked'];
						$g_doc_array['ddbcontentor_docs_public'] = (((!$g_datasub_check)&&($g_cat_object->is_writable_as_submission ())) ? 0 : $direct_cachedata['i_cpublic']);
						$g_doc_array['ddbdata_data'] = $direct_cachedata['i_ctext'];

						$g_continue_check = ($g_insert_check ? $g_doc_object->set_insert ($g_doc_array) : $g_doc_object->set_update ($g_doc_array));

						if (($g_continue_check)&&($direct_classes['db']->v_transaction_commit ()))
						{
							direct_credits_payment_exec ("contentor","doc_edit",$g_did,$direct_settings['user']['id'],$direct_settings['contentor_doc_edit_credits_onetime'],0);

							$direct_cachedata['output_job'] = direct_local_get ("contentor_doc_edit");
							$direct_cachedata['output_job_desc'] = direct_local_get ("contentor_done_doc_edit");

							if ($g_target_url)
							{
								$direct_cachedata['output_jsjump'] = 2000;
								$g_target_link = str_replace ("[oid]","cdid_d+{$g_did}++",$g_target_url);
							}
							elseif ($g_connector_url)
							{
								$direct_cachedata['output_jsjump'] = 2000;
								$g_target_link = str_replace (array ("[a]","[oid]"),(array ("view","cdid_d+{$g_did}++")),$g_connector_url);
							}
							else { $direct_cachedata['output_jsjump'] = 0; }

							if ($direct_cachedata['output_jsjump'])
							{
								$direct_cachedata['output_pagetarget'] = str_replace ('"',"",(direct_linker ("url0",$g_target_link)));
								$direct_cachedata['output_scripttarget'] = str_replace ('"',"",(direct_linker ("url0",$g_target_link,false)));
							}

							if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_edit_{$g_did}_form_save","post_module_service_action"); }
							else { direct_output_related_manager ("contentor_doc_edit_{$g_cat_array['ddbdatalinker_id']}_{$g_did}_form_save","post_module_service_action"); }

							$direct_classes['output']->oset ("default","done");
							$direct_classes['output']->options_flush (true);
							$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
							$direct_classes['output']->page_show ($direct_cachedata['output_job']);
						}
						else
						{
							$direct_classes['db']->v_transaction_rollback ();
							$direct_classes['error_functions']->error_page ("fatal","core_database_error","FATAL ERROR:<br />An error occured while saving the document<br />sWG/#echo(__FILEPATH__)# _a=edit-save_ (#echo(__LINE__)#)");
						}
					}
					else
					{
						$direct_classes['db']->v_transaction_rollback ();
						$direct_classes['error_functions']->error_page ("fatal","core_database_error","FATAL ERROR:<br />An error occured while updating document details<br />sWG/#echo(__FILEPATH__)# _a=edit-save_ (#echo(__LINE__)#)");
					}
				}
			}
			else { $direct_classes['error_functions']->error_page ("standard","core_credits_insufficient","SERVICE ERROR:<br />".(-1 * $direct_settings['contentor_doc_edit_credits_onetime'])." Credits are required but not available. This error has been reported by the sWG Credits Manager.<br />sWG/#echo(__FILEPATH__)# _a=edit-save_ (#echo(__LINE__)#)"); }
		}
		else
		{
/* -------------------------------------------------------------------------
View form
------------------------------------------------------------------------- */

			if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_edit_{$g_did}_form","post_module_service_action"); }
			else { direct_output_related_manager ("contentor_doc_edit_{$g_cat_array['ddbdatalinker_id']}_{$g_did}_form","post_module_service_action"); }

			$direct_classes['output']->oset ("default","form");
			$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
			$direct_classes['output']->page_show ($direct_cachedata['output_formtitle']);
		}
	}
	else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	//j// EOA
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// ($direct_settings['a'] == "new")||($direct_settings['a'] == "new-save")
case "new":
case "new-save":
{
	$g_mode_save = (($direct_settings['a'] == "new-save") ? true : false);
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }

	$g_cid = (isset ($direct_settings['dsd']['ccid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['ccid'])) : "");
	$g_title = (isset ($direct_settings['dsd']['ctitle']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['ctitle'])) : "");
	$g_type = (isset ($direct_settings['dsd']['ctype']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['ctype'])) : "");
	$g_connector = (isset ($direct_settings['dsd']['connector']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['connector'])) : "");
	$g_source = (isset ($direct_settings['dsd']['source']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['source'])) : "");
	$g_target = (isset ($direct_settings['dsd']['target']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['target'])) : "");

	$g_connector_url = ($g_connector ? base64_decode ($g_connector) : "m=contentor&a=[a]&dsd=[oid]");
	$g_source_url = ($g_source ? base64_decode ($g_source) : "m=contentor&a=list&dsd=[oid]");

	if ($g_target) { $g_target_url = base64_decode ($g_target); }
	else
	{
		$g_target = $g_source;
		$g_target_url = ($g_source ? $g_source_url : "");
	}

	$g_back_link = (((!$g_source)&&($g_connector_url)) ? preg_replace (array ("#\[a\]#","#\[oid\]#","#\[(.*?)\]#"),(array ("list","ccid+{$g_cid}++","")),$g_connector_url) : str_replace ("[oid]","ccid+{$g_cid}++",$g_source_url));

	if ($g_mode_save)
	{
		$direct_cachedata['page_this'] = "";
		$direct_cachedata['page_backlink'] = "m=contentor&s=doc&a=new&dsd=ccid+$g_cid++ctitle+".(urlencode ($g_title))."++ctype+$g_type++connector+".(urlencode ($g_connector))."++source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
		$direct_cachedata['page_homelink'] = $g_back_link;
	}
	else
	{
		$direct_cachedata['page_this'] = "m=contentor&s=doc&a=new&dsd=ccid+$g_cid++ctitle+".(urlencode ($g_title))."++ctype+$g_type++connector+".(urlencode ($g_connector))."++source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
		$direct_cachedata['page_backlink'] = $g_back_link;
		$direct_cachedata['page_homelink'] = $g_back_link;
	}

	if ($direct_classes['kernel']->service_init_default ())
	{
	//j// BOA
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_cat.php");
	direct_local_integration ("contentor");

	if ($g_mode_save) { $direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_doc.php"); }

	$g_continue_check = false;
	$g_cat_object = new direct_contentor_cat ();
	$g_datasub_check = false;

	if ($g_cat_object)
	{
		if (is_string ($direct_settings['contentor_subs_types_supported'])) { $direct_settings['contentor_subs_types_supported'] = array ($direct_settings['contentor_subs_types_supported']); }
		$g_cat_array = $g_cat_object->get ($g_cid);
		if (!$g_cat_object->is_of_type ("87ecbe0ba0a0b3c7e60030043614e655",1)) { $g_datasub_check = $g_cat_object->is_sub_allowed (); }

		if ((is_array ($g_cat_array))&&(isset ($direct_settings["contentor_".$g_cat_array['ddbcontentor_cats_doctype']])))
		{
			$g_continue_check = true;
			$g_type = $g_cat_array['ddbcontentor_cats_doctype'];
		}
		elseif (($g_datasub_check)&&(isset ($direct_settings["contentor_".$g_type]))&&(in_array ($g_type,$direct_settings['contentor_subs_types_supported']))) { $g_continue_check = true; }
	}
	else { $g_cat_array = NULL; }

	if (!$g_continue_check) { $direct_classes['error_functions']->error_page ("standard","contentor_cid_invalid","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	elseif (($g_datasub_check)||($g_cat_object->is_writable ()))
	{
		if ($g_mode_save)
		{
			if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_new_form_save","pre_module_service_action"); }
			else { direct_output_related_manager ("contentor_doc_new_{$g_cid}_form_save","pre_module_service_action"); }
		}
		elseif ($g_datasub_check) { direct_output_related_manager ("contentor_doc_new_form","pre_module_service_action"); }
		else { direct_output_related_manager ("contentor_doc_new_{$g_cid}_form","pre_module_service_action"); }

		if (!$g_mode_save) { $direct_classes['kernel']->service_https ($direct_settings["contentor_https_{$g_type}_new"],$direct_cachedata['page_this']); }
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formbuilder_datetime.php");
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/functions/swg_credits_manager.php");
		$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/functions/swg_tmp_storager.php");

		if (($direct_settings['contentor_datacenter_symbols'])&&(isset ($direct_settings['contentor_datacenter_symbols_did'])))
		{
			$direct_classes['basic_functions']->settings_get ($direct_settings['path_data']."/settings/swg_datacenter.php",true);
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_datacenter.php");
		}

		direct_class_init ("formbuilder");

		if ($g_type == "wiki")
		{
			direct_local_integration ("contentor_wiki");
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags_wiki.php");
			direct_class_init ("formtags");
			$direct_classes['formtags']->define_connector ("m=contentor&s=wiki&a=[a]&dsd=ccid+{$g_cid}++[oid]");
		}
		else
		{
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/swg_formtags.php");
			direct_class_init ("formtags");
		}

		direct_class_init ("output");
		$direct_classes['output']->options_insert (2,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

		if (($g_datasub_check)||(!$g_cat_object->is_writable_as_submission ()))
		{
			if (!$g_datasub_check) { direct_credits_payment_get_specials ("contentor_doc_new",$g_cat_array['ddbdatalinker_id'],$direct_settings['contentor_doc_new_credits_onetime'],$direct_settings['contentor_doc_new_credits_periodically']); }
			$direct_cachedata['output_credits_information'] = direct_credits_payment_info ($direct_settings['contentor_doc_new_credits_onetime'],$direct_settings['contentor_doc_new_credits_periodically']);
			$direct_cachedata['output_credits_payment_data'] = direct_credits_payment_check (true,$direct_settings['contentor_doc_new_credits_onetime']);
		}

		if ($g_datasub_check) { $g_rights_check = (($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']) > 3) ? true : false); }
		else { $g_rights_check = $g_cat_object->is_moderator (); }

		if ($g_mode_save)
		{
/* -------------------------------------------------------------------------
We should have input in save mode
------------------------------------------------------------------------- */

			$direct_cachedata['i_ctitle'] = ($g_title ? base64_decode ($g_title) : "");
			$direct_cachedata['i_ctitle'] = (isset ($GLOBALS['i_ctitle']) ? ($direct_classes['basic_functions']->inputfilter_basic ($GLOBALS['i_ctitle'])) : $direct_cachedata['i_ctitle']);

			$direct_cachedata['i_cteaser'] = (isset ($GLOBALS['i_cteaser']) ? ($direct_classes['basic_functions']->inputfilter_basic ($GLOBALS['i_cteaser'])) : "");
			if (($direct_settings['contentor_datacenter_symbols'])&&(isset ($direct_settings['contentor_datacenter_symbols_did']))) { $direct_cachedata['i_csymbol'] = (isset ($GLOBALS['i_csymbol']) ? (urlencode ($GLOBALS['i_csymbol'])) : ""); }
			$direct_cachedata['i_ctext'] = (isset ($GLOBALS['i_ctext']) ? ($direct_classes['basic_functions']->inputfilter_basic ($GLOBALS['i_ctext'])) : "");

			$direct_cachedata['i_0_cpubdate'] = (isset ($GLOBALS['i_0_cpubdate']) ? (str_replace ("'","",$GLOBALS['i_0_cpubdate'])) : "");
			$direct_cachedata['i_1_cpubdate'] = (isset ($GLOBALS['i_1_cpubdate']) ? (str_replace ("'","",$GLOBALS['i_1_cpubdate'])) : "");
			$direct_cachedata['i_2_cpubdate'] = (isset ($GLOBALS['i_2_cpubdate']) ? (str_replace ("'","",$GLOBALS['i_2_cpubdate'])) : "");
			$direct_cachedata['i_0_cpubtime'] = (isset ($GLOBALS['i_0_cpubtime']) ? (str_replace ("'","",$GLOBALS['i_0_cpubtime'])) : "");
			$direct_cachedata['i_1_cpubtime'] = (isset ($GLOBALS['i_1_cpubtime']) ? (str_replace ("'","",$GLOBALS['i_1_cpubtime'])) : "");
			$direct_cachedata['i_2_cpubtime'] = (isset ($GLOBALS['i_2_cpubtime']) ? (str_replace ("'","",$GLOBALS['i_2_cpubtime'])) : "");

			$direct_cachedata['i_cpreview'] = (isset ($GLOBALS['i_cpreview']) ? (str_replace ("'","",$GLOBALS['i_cpreview'])) : "");
			$direct_cachedata['i_cpreview'] = str_replace ("<value value='$direct_cachedata[i_cpreview]' />","<value value='$direct_cachedata[i_cpreview]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

			if ((!$g_datasub_check)&&($g_cat_array['ddbcontentor_cats_front_id']))
			{
				$direct_cachedata['i_cfrontpage'] = (isset ($GLOBALS['i_cfrontpage']) ? (str_replace ("'","",$GLOBALS['i_cfrontpage'])) : "");
				$direct_cachedata['i_cfrontpage'] = str_replace ("<value value='$direct_cachedata[i_cfrontpage]' />","<value value='$direct_cachedata[i_cfrontpage]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");
			}

			if ($g_rights_check)
			{
				$direct_cachedata['i_cviews_count'] = (isset ($GLOBALS['i_cviews_count']) ? (str_replace ("'","",$GLOBALS['i_cviews_count'])) : "");
				$direct_cachedata['i_cviews_count'] = str_replace ("<value value='$direct_cachedata[i_cviews_count]' />","<value value='$direct_cachedata[i_cviews_count]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

				$direct_cachedata['i_csubs_allowed'] = (isset ($GLOBALS['i_csubs_allowed']) ? (str_replace ("'","",$GLOBALS['i_csubs_allowed'])) : "");
				$direct_cachedata['i_csubs_allowed'] = str_replace ("<value value='$direct_cachedata[i_csubs_allowed]' />","<value value='$direct_cachedata[i_csubs_allowed]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

				$direct_cachedata['i_csubs_hidden'] = (isset ($GLOBALS['i_csubs_hidden']) ? (str_replace ("'","",$GLOBALS['i_csubs_hidden'])) : "");
				$direct_cachedata['i_csubs_hidden'] = str_replace ("<value value='$direct_cachedata[i_csubs_hidden]' />","<value value='$direct_cachedata[i_csubs_hidden]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

				$direct_cachedata['i_csubs_type'] = (isset ($GLOBALS['i_csubs_type']) ? (str_replace ("'","",$GLOBALS['i_csubs_type'])) : 0);

				$direct_cachedata['i_cpublic'] = (isset ($GLOBALS['i_cpublic']) ? (str_replace ("'","",$GLOBALS['i_cpublic'])) : "");
				$direct_cachedata['i_cpublic'] = str_replace ("<value value='$direct_cachedata[i_cpublic]' />","<value value='$direct_cachedata[i_cpublic]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

				$direct_cachedata['i_cgright'] = (isset ($GLOBALS['i_cgright']) ? (str_replace ("'","",$GLOBALS['i_cgright'])) : "");

$direct_cachedata['i_cgright'] = str_replace ("<value value='$direct_cachedata[i_cgright]' />","<value value='$direct_cachedata[i_cgright]' /><selected value='1' />","<evars>
<norights><value value='-' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_0"))."]]></text></norights><read><value value='r' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_r"))."]]></text></read><write><value value='w' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_w"))."]]></text></write>
</evars>");

				$direct_cachedata['i_cpright'] = (isset ($GLOBALS['i_cpright']) ? (str_replace ("'","",$GLOBALS['i_cpright'])) : "");

$direct_cachedata['i_cpright'] = str_replace ("<value value='$direct_cachedata[i_cpright]' />","<value value='$direct_cachedata[i_cpright]' /><selected value='1' />","<evars>
<norights><value value='-' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_0"))."]]></text></norights><read><value value='r' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_r"))."]]></text></read><write><value value='w' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_w"))."]]></text></write>
</evars>");

				$direct_cachedata['i_csticky'] = (isset ($GLOBALS['i_csticky']) ? (str_replace ("'","",$GLOBALS['i_csticky'])) : "");
				$direct_cachedata['i_csticky'] = str_replace ("<value value='$direct_cachedata[i_csticky]' />","<value value='$direct_cachedata[i_csticky]' /><selected value='1' />","<evars><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>");
			}
			elseif ((!$g_datasub_check)&&(!$g_cat_object->is_writable_as_submission ())&&($g_doc_object->is_published ()))
			{
				if ((!$g_datasub_check)&&($g_cat_object->is_sub_allowed ()))
				{
					$direct_cachedata['i_csubs_allowed'] = (isset ($GLOBALS['i_csubs_allowed']) ? (str_replace ("'","",$GLOBALS['i_csubs_allowed'])) : "");
					$direct_cachedata['i_csubs_allowed'] = str_replace ("<value value='$direct_cachedata[i_csubs_allowed]' />","<value value='$direct_cachedata[i_csubs_allowed]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

					$direct_cachedata['i_csubs_hidden'] = (isset ($GLOBALS['i_csubs_hidden']) ? (str_replace ("'","",$GLOBALS['i_csubs_hidden'])) : "");
					$direct_cachedata['i_csubs_hidden'] = str_replace ("<value value='$direct_cachedata[i_csubs_hidden]' />","<value value='$direct_cachedata[i_csubs_hidden]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");

					$direct_cachedata['i_csubs_type'] = (isset ($GLOBALS['i_csubs_type']) ? (str_replace ("'","",$GLOBALS['i_csubs_type'])) : 0);
				}

				$direct_cachedata['i_cpublic'] = (isset ($GLOBALS['i_cpublic']) ? (str_replace ("'","",$GLOBALS['i_cpublic'])) : "");
				$direct_cachedata['i_cpublic'] = str_replace ("<value value='$direct_cachedata[i_cpublic]' />","<value value='$direct_cachedata[i_cpublic]' /><selected value='1' />","<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>");
			}
		}
		else
		{
			$direct_cachedata['i_ctitle'] = ($g_title ? base64_decode ($g_title) : "");
			$direct_cachedata['i_cteaser'] = "";

			if (($direct_settings['contentor_datacenter_symbols'])&&(isset ($direct_settings['contentor_datacenter_symbols_did'])))
			{
				$direct_cachedata['i_csymbol'] = uniqid ("");

$g_task_array = array (
"core_sid" => "d4d66a02daefdb2f70ff2507a78fd5ec",
// md5 ("datacenter")
"datacenter_marker_type" => "files-only",
"datacenter_selection_did" => $direct_settings['contentor_datacenter_symbols_did'],
"datacenter_selection_done" => 0,
"datacenter_selection_path" => $direct_settings['contentor_datacenter_path_symbols'],
"datacenter_selection_quantity" => 1,
"uuid" => $direct_settings['uuid']
);

				if ($direct_settings['contentor_datacenter_symbols_preselect']) { $g_task_array['datacenter_objects_marked'] = array ($direct_settings['contentor_datacenter_symbols_preselect'] => $direct_settings['contentor_datacenter_symbols_preselect']); }

				direct_tmp_storage_write ($g_task_array,$direct_cachedata['i_csymbol'],"d4d66a02daefdb2f70ff2507a78fd5ec","task_cache","evars",$direct_cachedata['core_time'],($direct_cachedata['core_time'] + 3600));
				// md5 ("datacenter")
			}

			$direct_cachedata['i_ctext'] = "";
			$direct_cachedata['i_cpubdate'] = $direct_cachedata['core_time'];
			$direct_cachedata['i_cpubtime'] = $direct_cachedata['core_time'];
			$direct_cachedata['i_cpreview'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>";
			if ((!$g_datasub_check)&&($g_cat_array['ddbcontentor_cats_front_id'])) { $direct_cachedata['i_cfrontpage'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

			if ($g_rights_check)
			{
				if ((!$g_datasub_check)&&($g_cat_object->is_views_counting ())) { $direct_cachedata['i_cviews_count'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
				else { $direct_cachedata['i_cviews_count'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

				if ((!$g_datasub_check)&&($g_cat_array['ddbdatalinker_datasubs_new'])) { $direct_cachedata['i_csubs_allowed'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
				else { $direct_cachedata['i_csubs_allowed'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

				if (($g_datasub_check)||($g_cat_array['ddbdatalinker_datasubs_hide'])) { $direct_cachedata['i_csubs_hidden'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
				else { $direct_cachedata['i_csubs_hidden'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

				$direct_cachedata['i_csubs_type'] = (((!$g_datasub_check)&&(isset ($g_cat_array['ddbdatalinker_datasubs_type']))) ? str_replace ("'","",$g_cat_array['ddbdatalinker_datasubs_type']) : 0);
				$direct_cachedata['i_cpublic'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>";

				if ((!$g_datasub_check)&&($g_cat_array['ddbcontentor_cats_owner_group'])&&(!$g_cat_object->is_moderated ())) { $direct_cachedata['i_cgright'] = "<evars><norights><value value='-' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_0"))."]]></text></norights><read><value value='r' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_r"))."]]></text></read><write><value value='w' /><selected value='1' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_w"))."]]></text></write></evars>"; }
				else { $direct_cachedata['i_cgright'] = "<evars><norights><value value='-' /><selected value='1' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_0"))."]]></text></norights><read><value value='r' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_r"))."]]></text></read><write><value value='w' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_w"))."]]></text></write></evars>"; }

				if (($g_datasub_check)||($g_cat_array['ddbcontentor_cats_public'])) { $direct_cachedata['i_cpright'] = "<evars><norights><value value='-' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_0"))."]]></text></norights><read><value value='r' /><selected value='1' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_r"))."]]></text></read><write><value value='w' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_w"))."]]></text></write></evars>"; }
				else { $direct_cachedata['i_cpright'] = "<evars><norights><value value='-' /><selected value='1' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_0"))."]]></text></norights><read><value value='r' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_r"))."]]></text></read><write><value value='w' /><text><![CDATA[".(direct_local_get ("contentor_doc_dright_w"))."]]></text></write></evars>"; }

				$direct_cachedata['i_csticky'] = "<evars><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes></evars>";
			}
			elseif ((!$g_datasub_check)&&(!$g_cat_object->is_writable_as_submission ()))
			{
				if ((!$g_datasub_check)&&($g_cat_object->is_sub_allowed ()))
				{
					$direct_cachedata['i_csubs_allowed'] = $direct_cachedata['i_csubs_allowed'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>";;

					if ($g_cat_array['ddbdatalinker_datasubs_hide']) { $direct_cachedata['i_csubs_hidden'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }
					else { $direct_cachedata['i_csubs_hidden'] = "<evars><yes><value value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>"; }

					$direct_cachedata['i_csubs_type'] = (isset ($g_cat_array['ddbdatalinker_datasubs_type']) ? str_replace ("'","",$g_cat_array['ddbdatalinker_datasubs_type']) : 0);
				}

				$direct_cachedata['i_cpublic'] = "<evars><yes><value value='1' /><selected value='1' /><text><![CDATA[".(direct_local_get ("core_yes"))."]]></text></yes><no><value value='0' /><text><![CDATA[".(direct_local_get ("core_no"))."]]></text></no></evars>";
			}
		}

		if (isset ($direct_cachedata['i_csubs_type']))
		{
$direct_cachedata['i_csubs_type'] = str_replace ("<value value='$direct_cachedata[i_csubs_type]' />","<value value='$direct_cachedata[i_csubs_type]' /><selected value='1' />","<evars>
<default><value value='0' /><text><![CDATA[".(direct_local_get ("core_datasub_title_default"))."]]></text></default><attachments><value value='1' /><text><![CDATA[".(direct_local_get ("core_datasub_title_attachments"))."]]></text></attachments><downloads><value value='2' /><text><![CDATA[".(direct_local_get ("core_datasub_title_downloads"))."]]></text></downloads><links><value value='3' /><text><![CDATA[".(direct_local_get ("core_datasub_title_links"))."]]></text></links>
</evars>");
		}

/* -------------------------------------------------------------------------
Build the form
------------------------------------------------------------------------- */

		$direct_classes['formbuilder']->entry_add ("subtitle","doc_info",(direct_local_get ("contentor_doc_info")));

		if (($g_title)&&(strlen ($direct_cachedata['i_ctitle']))) { $direct_classes['formbuilder']->entry_add ("info","ctitle",(direct_local_get ("contentor_title")),true); }
		else { $direct_classes['formbuilder']->entry_add_text ("ctitle",(direct_local_get ("contentor_title")),true,"m",$direct_settings['contentor_title_min'],$direct_settings['contentor_title_max']); }

		$direct_classes['formbuilder']->entry_add_jfield_textarea ("cteaser",(direct_local_get ("contentor_teaser")),false,"s",$direct_settings['contentor_teaser_min'],$direct_settings['contentor_teaser_max']);
		if (isset ($direct_cachedata['i_csymbol'])) { $direct_classes['formbuilder']->entry_add_embed ("csymbol",(direct_local_get ("contentor_symbol")),false,"m=dataport&s=swgap;datacenter;selector_icons&dsd=",false,"s"); }
		$direct_classes['formbuilder']->entry_add ("spacer");

		if ($direct_settings['formtags_overview_document_url']) { $direct_classes['formbuilder']->entry_add_jfield_textarea ("ctext",(direct_local_get ("contentor_text")),true,"l",$direct_settings['contentor_text_min'],$direct_settings['swg_data_limit'],(direct_local_get ("formtags_overview_document")),(direct_linker ("url0",$direct_settings['formtags_overview_document_url']))); }
		else { $direct_classes['formbuilder']->entry_add_jfield_textarea ("ctext",(direct_local_get ("contentor_text")),true,"l",$direct_settings['contentor_text_min'],$direct_settings['swg_data_limit']); }

		$direct_classes['formbuilder']->entry_add_date ("cpubdate",(direct_local_get ("contentor_pubdate")),true);
		$direct_classes['formbuilder']->entry_add_time ("cpubtime",(direct_local_get ("contentor_pubtime")),true);
		$direct_classes['formbuilder']->entry_add ("spacer");
		$direct_classes['formbuilder']->entry_add_radio ("cpreview",(direct_local_get ("core_preview")));

		if (isset ($direct_cachedata['i_cfrontpage']))
		{
			$direct_classes['formbuilder']->entry_add ("spacer");
			$direct_classes['formbuilder']->entry_add_radio ("cfrontpage",(direct_local_get ("contentor_doc_on_frontpage")),true);
		}

		if ($g_rights_check)
		{
			$direct_classes['formbuilder']->entry_add ("spacer");
			$direct_classes['formbuilder']->entry_add_select ("cviews_count",(direct_local_get ("contentor_doc_views_count")),true,"s");
			$direct_classes['formbuilder']->entry_add_select ("csubs_allowed",(direct_local_get ("core_datasub_allowed")),true,"s");
			$direct_classes['formbuilder']->entry_add_select ("csubs_hidden",(direct_local_get ("core_datasub_hide")),true,"s");
			$direct_classes['formbuilder']->entry_add_radio ("csubs_type",(direct_local_get ("core_datasub_type")),true);
			$direct_classes['formbuilder']->entry_add ("spacer");
			$direct_classes['formbuilder']->entry_add_select ("cpublic",(direct_local_get ("contentor_doc_public")),true,"s");
			$direct_classes['formbuilder']->entry_add_select ("cgright",(direct_local_get ("contentor_doc_gright")),false,"s");
			$direct_classes['formbuilder']->entry_add_select ("cpright",(direct_local_get ("contentor_doc_pright")),false,"s");
			$direct_classes['formbuilder']->entry_add ("spacer");
			$direct_classes['formbuilder']->entry_add_select ("csticky",(direct_local_get ("contentor_doc_stick")),false,"s");
		}
		elseif (isset ($direct_cachedata['i_cpublic']))
		{
			$direct_classes['formbuilder']->entry_add ("spacer");

			if (isset ($direct_cachedata['i_csubs_allowed']))
			{
				$direct_classes['formbuilder']->entry_add_select ("csubs_allowed",(direct_local_get ("core_datasub_allowed")),true,"s");
				$direct_classes['formbuilder']->entry_add_select ("csubs_hidden",(direct_local_get ("core_datasub_hide")),true,"s");
				$direct_classes['formbuilder']->entry_add_radio ("csubs_type",(direct_local_get ("core_datasub_type")),true);
			}

			$direct_classes['formbuilder']->entry_add_select ("cpublic",(direct_local_get ("contentor_doc_public")),true,"s");
		}

		$direct_cachedata['output_formbutton'] = direct_local_get ("core_save");
		$direct_cachedata['output_formelements'] = $direct_classes['formbuilder']->form_get ($g_mode_save);
		$direct_cachedata['output_formtarget'] = "m=contentor&s=doc&a=new-save&dsd=ccid+$g_cid++ctitle+".(urlencode ($g_title))."++ctype+$g_type++connector+".(urlencode ($g_connector))."++source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
		$direct_cachedata['output_formtitle'] = direct_local_get ("contentor_doc_new");

		if (($g_mode_save)&&($direct_classes['formbuilder']->check_result))
		{
/* -------------------------------------------------------------------------
Save data edited
------------------------------------------------------------------------- */

			$direct_cachedata['i_csubs_allowed'] = (((isset ($direct_cachedata['i_csubs_allowed']))&&($direct_cachedata['i_csubs_allowed'])) ? 1 : 0);

			if ((isset ($direct_cachedata['i_cviews_count']))&&($direct_cachedata['i_cviews_count'])) { $direct_cachedata['i_cviews_count'] = 1; }
			elseif ($g_cat_object->is_views_counting ()) { $direct_cachedata['i_cviews_count'] = 1; }
			else { $direct_cachedata['i_cviews_count'] = 0; }

			$direct_cachedata['i_csticky'] = (((isset ($direct_cachedata['i_csticky']))&&($direct_cachedata['i_csticky'])) ? 1 : 0);
			$direct_cachedata['i_cpublic'] = (((isset ($direct_cachedata['i_cpublic']))&&($direct_cachedata['i_cpublic'])) ? 1 : 0);

			if (!isset ($direct_cachedata['i_cgright']))
			{
				if ((!$g_datasub_check)&&($g_cat_array['ddbcontentor_cats_owner_group'])) { $direct_cachedata['i_cgright'] = (($g_cat_object->is_moderated ()) ? "r" : "w"); }
				else { $direct_cachedata['i_cgright'] = "-"; }
			}

			if (!isset ($direct_cachedata['i_cpright'])) { $direct_cachedata['i_cpright'] = ((($g_datasub_check)||($g_cat_array['ddbcontentor_cats_public'])) ? "r" : "-"); }

			$g_continue_check = (((!$g_datasub_check)&&($g_cat_object->is_writable_as_submission ())) ? true : direct_credits_payment_check (false,$direct_settings['contentor_doc_edit_credits_onetime']));

			if ($g_continue_check)
			{
				$direct_cachedata['i_cteaser'] = ((trim ($direct_cachedata['i_cteaser'])) ? $direct_classes['formtags']->encode ($direct_cachedata['i_cteaser']) : "");
				$direct_cachedata['i_ctext'] = $direct_classes['formtags']->encode ($direct_cachedata['i_ctext']);

				if (!$direct_cachedata['i_cteaser'])
				{
					$direct_cachedata['i_cteaser'] = preg_replace ("#\[page:(.*?)\]#i"," ",$direct_cachedata['i_ctext']);
					$direct_cachedata['i_cteaser'] = mb_substr ($direct_cachedata['i_cteaser'],0,$direct_settings['contentor_doc_teaser_length']);
				}

				$direct_cachedata['i_ctext'] = direct_output_smiley_encode ($direct_cachedata['i_ctext']);

				if ($direct_cachedata['i_cpreview'])
				{
					$direct_cachedata['output_title'] = direct_html_encode_special ($direct_cachedata['i_ctitle']);
					$direct_cachedata['output_teaser'] = $direct_classes['formtags']->decode ($direct_cachedata['i_cteaser']);

					$direct_cachedata['output_text'] = preg_replace ("#\[page:(.*?)\]#i","[newline][hr]\\1[hr]",$direct_cachedata['i_ctext']);
					$direct_cachedata['output_text'] = $direct_classes['formtags']->decode ($direct_cachedata['output_text']);

					$direct_cachedata['output_username'] = $direct_settings['user']['name_html'];

					$direct_cachedata['output_preview_function_file'] = "swgi_contentor";
					$direct_cachedata['output_preview_function'] = "contentor_oset_doc_preview";

					if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_new_form_save","post_module_service_action"); }
					else { direct_output_related_manager ("contentor_doc_new_{$g_cid}_form_save","post_module_service_action"); }

					$direct_classes['output']->oset ("default","form_preview");
					$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
					$direct_classes['output']->page_show ($direct_cachedata['output_formtitle']);
				}
				else
				{
					$direct_classes['db']->v_transaction_begin ();

					if (isset ($direct_cachedata['i_csymbol']))
					{
						$g_task_array = direct_tmp_storage_get ("evars",$direct_cachedata['i_csymbol'],"d4d66a02daefdb2f70ff2507a78fd5ec","selector_cache");
						// md5 ("datacenter")
						$direct_cachedata['i_csymbol'] = "";

						if ((is_array ($g_task_array['datacenter_objects_marked']))&&(!empty ($g_task_array['datacenter_objects_marked'])))
						{
							$g_symbol_marked_id = array_shift ($g_task_array['datacenter_objects_marked']);
							$g_symbol_marked_object = ($g_symbol_marked_id ? new direct_datacenter () : NULL);
							if (($g_symbol_marked_object)&&($g_symbol_marked_object->get ($g_symbol_marked_id))) { $direct_cachedata['i_csymbol'] = $g_symbol_marked_object->get_plocation (); }
						}
					}
					else { $direct_cachedata['i_csymbol'] = ""; }

					$g_doc_id = uniqid ("");
					$g_date_array = explode (".",$direct_cachedata['i_cpubdate']);
					$g_time_array = explode (".",$direct_cachedata['i_cpubtime']);

$g_insert_array = array (
"ddbdatalinker_id" => $g_doc_id,
"ddbdatalinker_sid" => "87ecbe0ba0a0b3c7e60030043614e655",
// md5 ("contentor")
"ddbdatalinker_type" => 2,
"ddbdatalinker_position" => $direct_cachedata['i_csticky'],
"ddbdatalinker_subs" => 0,
"ddbdatalinker_objects" => 0,
"ddbdatalinker_sorting_date" => gmmktime ($g_time_array[0],$g_time_array[1],$g_time_array[2],$g_date_array[1],$g_date_array[0],$g_date_array[2]),
"ddbdatalinker_symbol" => $direct_cachedata['i_csymbol'],
"ddbdatalinker_title" => $direct_cachedata['i_ctitle'],
"ddbdatalinker_views_count" => $direct_cachedata['i_cviews_count'],
"ddbdatalinker_views" => 0,
"ddbcontentor_docs_id" => $g_doc_id,
"ddbcontentor_docs_time" => $direct_cachedata['core_time'],
"ddbcontentor_docs_desc" => $direct_cachedata['i_cteaser'],
"ddbcontentor_docs_pages" => NULL,
"ddbcontentor_docs_locked" => 0,
"ddbcontentor_docs_public" => $direct_cachedata['i_cpublic'],
"ddbdata_data" => $direct_cachedata['i_ctext'],
"ddbdata_mode_user" => "w",
"ddbdata_mode_group" => $direct_cachedata['i_cgright'],
"ddbdata_mode_all" => $direct_cachedata['i_cpright']
);

					if ($g_datasub_check)
					{
						$g_insert_array['ddbdatalinker_id_parent'] = $g_cid;
						$g_insert_array['ddbcontentor_docs_doctype'] = $g_type;
					}
					else
					{
						$g_insert_array['ddbdatalinker_id_parent'] = $g_cat_array['ddbdatalinker_id'];
						$g_insert_array['ddbdatalinker_id_main'] = $g_cat_array['ddbdatalinker_id'];
						$g_insert_array['ddbcontentor_docs_doctype'] = $g_type;
					}

					if ($direct_cachedata['i_csubs_allowed'])
					{
						$g_insert_array['ddbdatalinker_datasubs_type'] = $direct_cachedata['i_csubs_type'];
						$g_insert_array['ddbdatalinker_datasubs_hide'] = $direct_cachedata['i_csubs_hidden'];
						$g_insert_array['ddbdatalinker_datasubs_new'] = 1;
					}
					elseif (!$g_datasub_check)
					{
						$g_insert_array['ddbdatalinker_datasubs_type'] = $g_cat_array['ddbdatalinker_datasubs_type'];
						$g_insert_array['ddbdatalinker_datasubs_hide'] = $g_cat_array['ddbdatalinker_datasubs_hide'];
						$g_insert_array['ddbdatalinker_datasubs_new'] = $g_cat_array['ddbdatalinker_datasubs_new'];
					}

					$g_insert_array['ddbcontentor_docs_id_front'] = (((isset ($direct_cachedata['i_cfrontpage']))&&($direct_cachedata['i_cfrontpage'])) ? $g_cat_array['ddbcontentor_cats_id_front'] : "");

					if ((!$g_datasub_check)&&($g_cat_object->is_writable_as_submission ()))
					{
						$g_insert_array['ddbcontentor_docs_author_id'] = $direct_settings['user']['id'];
						$g_insert_array['ddbcontentor_docs_author_ip'] = $direct_settings['user_ip'];
						$g_insert_array['ddbcontentor_docs_owner_id'] = "";
						$g_insert_array['ddbcontentor_docs_owner_ip'] = "";
					}
					else
					{
						$g_insert_array['ddbcontentor_docs_author_id'] = "";
						$g_insert_array['ddbcontentor_docs_author_ip'] = "";
						$g_insert_array['ddbcontentor_docs_owner_id'] = $direct_settings['user']['id'];
						$g_insert_array['ddbcontentor_docs_owner_ip'] = $direct_settings['user_ip'];
					}

					$g_doc_object = new direct_contentor_doc ();

					$g_continue_check = ($g_doc_object ? $g_doc_object->set_insert ($g_insert_array) : false);
					if ($g_continue_check) { $g_continue_check = $g_cat_object->add_docs (1); }

					if (($g_continue_check)&&($direct_classes['db']->v_transaction_commit ()))
					{
						$direct_cachedata['output_job'] = direct_local_get ("contentor_doc_new");

						if ((!$g_datasub_check)&&($g_cat_object->is_writable_as_submission ()))
						{
							$direct_cachedata['output_job_desc'] = direct_local_get ("contentor_done_doc_submit");
							$direct_cachedata['output_jsjump'] = 5000;
						}
						else
						{
							direct_credits_payment_exec ("contentor","doc_new",$g_doc_id,$direct_settings['user']['id'],$direct_settings['contentor_doc_new_credits_onetime'],$direct_settings['contentor_doc_new_credits_periodically']);

							$direct_cachedata['output_job_desc'] = direct_local_get ("contentor_done_doc_new");
							$direct_cachedata['output_jsjump'] = 2000;
						}

						if ($g_target_url) { $g_target_link = str_replace ("[oid]","cdid_d+{$g_doc_id}++",$g_target_url); }
						elseif ($g_connector_url) { $g_target_link = str_replace (array ("[a]","[oid]"),(array ("view","cdid_d+{$g_doc_id}++")),$g_connector_url); }
						else { $direct_cachedata['output_jsjump'] = 0; }

						if ($direct_cachedata['output_jsjump'])
						{
							$direct_cachedata['output_pagetarget'] = str_replace ('"',"",(direct_linker ("url0",$g_target_link)));
							$direct_cachedata['output_scripttarget'] = str_replace ('"',"",(direct_linker ("url0",$g_target_link,false)));
						}

						if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_new_form_save","post_module_service_action"); }
						else { direct_output_related_manager ("contentor_doc_new_{$g_cid}_form_save","post_module_service_action"); }

						$direct_classes['output']->oset ("default","done");
						$direct_classes['output']->options_flush (true);
						$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
						$direct_classes['output']->page_show ($direct_cachedata['output_job']);
					}
					else
					{
						$direct_classes['db']->v_transaction_rollback ();
						$direct_classes['error_functions']->error_page ("fatal","core_database_error","FATAL ERROR:<br />An error occured while saving the document<br />sWG/#echo(__FILEPATH__)# _a=new-save_ (#echo(__LINE__)#)");
					}
				}
			}
			else { $direct_classes['error_functions']->error_page ("standard","core_credits_insufficient","SERVICE ERROR:<br />".(-1 * $direct_settings['contentor_doc_new_credits_onetime'])." Credits are required but not available. This error has been reported by the sWG Credits Manager.<br />sWG/#echo(__FILEPATH__)# _a=new-save_ (#echo(__LINE__)#)"); }
		}
		else
		{
/* -------------------------------------------------------------------------
View form
------------------------------------------------------------------------- */

			if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_new_form","post_module_service_action"); }
			else { direct_output_related_manager ("contentor_doc_new_{$g_cid}_form","post_module_service_action"); }

			$direct_classes['output']->oset ("default","form");
			$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
			$direct_classes['output']->page_show ($direct_cachedata['output_formtitle']);
		}
	}
	else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a={$direct_settings['a']}_ (#echo(__LINE__)#)"); }
	//j// EOA
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// ($direct_settings['a'] == "state")
case "state":
{
	if (USE_debug_reporting) { direct_debug (1,"sWG/#echo(__FILEPATH__)# _a=state_ (#echo(__LINE__)#)"); }

	$g_did = (isset ($direct_settings['dsd']['cdid']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cdid'])) : "");
	$g_change_type = (isset ($direct_settings['dsd']['cchange']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['cchange'])) : "");
	$g_connector = (isset ($direct_settings['dsd']['connector']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['connector'])) : "");
	$g_source = (isset ($direct_settings['dsd']['source']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['source'])) : "");
	$g_target = (isset ($direct_settings['dsd']['target']) ? ($direct_classes['basic_functions']->inputfilter_basic ($direct_settings['dsd']['target'])) : "");

	$g_connector_url = ($g_connector ? base64_decode ($g_connector) : "m=contentor&a=[a]&dsd=[oid]");
	$g_source_url = ($g_source ? base64_decode ($g_source) : "m=contentor&a=view&dsd=[oid]");

	if ($g_target) { $g_target_url = base64_decode ($g_target); }
	else
	{
		$g_target = $g_source;
		$g_target_url = ($g_source ? $g_source_url : "");
	}

	$g_back_link = (((!$g_source)&&($g_connector_url)) ? preg_replace (array ("#\[a\]#","#\[oid\]#","#\[(.*?)\]#"),(array ("view","cdid+{$g_did}++","")),$g_connector_url) : str_replace ("[oid]","cdid+{$g_did}++",$g_source_url));

	$direct_cachedata['page_this'] = "";
	$direct_cachedata['page_backlink'] = "m=contentor&s=doc&a=state&dsd=cdid+$g_did++cchange+{$g_change_type}++connector+".(urlencode ($g_connector))."++source+".(urlencode ($g_source))."++target+".(urlencode ($g_target));
	$direct_cachedata['page_homelink'] = $g_back_link;

	if ($direct_classes['kernel']->service_init_default ())
	{
	//j// BOA
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_cat.php");
	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/classes/dhandler/swg_contentor_doc.php");
	direct_local_integration ("contentor");

	$g_cat_array = NULL;
	$g_datasub_check = false;
	$g_doc_object = new direct_contentor_doc ();
	$g_rights_check = false;

	$g_doc_array = ($g_doc_object ? $g_doc_object->get ($g_did) : NULL);

	if (is_array ($g_doc_array))
	{
		if (isset ($direct_settings["contentor_".$g_doc_array['ddbcontentor_docs_doctype']]))
		{
			if ($g_doc_array['ddbdatalinker_id_main'])
			{
				$g_cat_object = new direct_contentor_cat ();
				if ($g_cat_object) { $g_cat_array = $g_cat_object->get ($g_doc_array['ddbdatalinker_id_main']); }
				if ((is_array ($g_cat_array))&&($g_cat_object->is_moderator ())) { $g_rights_check = true; }
			}
			else
			{
				$g_datasub_check = true;
				if ($direct_classes['kernel']->v_usertype_get_int ($direct_settings['user']['type']) > 3) { $g_rights_check = true; }
			}
		}
	}

	if ((!$g_datasub_check)&&(!is_array ($g_cat_array))) { $direct_classes['error_functions']->error_page ("standard","contentor_did_invalid","sWG/#echo(__FILEPATH__)# _a=state_ (#echo(__LINE__)#)"); }
	elseif ($g_rights_check)
	{
		if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_state_".$g_did,"pre_module_service_action"); }
		else { direct_output_related_manager ("contentor_doc_state_{$g_cat_array['ddbdatalinker_id']}_".$g_did,"pre_module_service_action"); }

		direct_class_init ("output");
		$direct_classes['output']->options_insert (2,"servicemenu",$direct_cachedata['page_backlink'],(direct_local_get ("core_back")),$direct_settings['serviceicon_default_back'],"url0");

		switch ($g_change_type)
		{
		case "lock":
		{
			$direct_cachedata['output_job'] = direct_local_get ("contentor_doc_lock");
			$g_continue_check = $g_doc_object->define_lock (true,true);

			break 1;
		}
		case "publish":
		{
			$direct_cachedata['output_job'] = direct_local_get ("contentor_doc_publish");
			$direct_classes['db']->v_transaction_begin ();

			if (empty ($g_doc_array['ddbcontentor_docs_owner_id']))
			{
				if (!empty ($g_doc_array['ddbcontentor_docs_author_id']))
				{
					if (!$g_datasub_check) { direct_credits_payment_get_specials ("contentor_doc_new",$g_cat_array['ddbdatalinker_id'],$direct_settings['contentor_doc_new_credits_onetime'],$direct_settings['contentor_doc_new_credits_periodically']); }
					direct_credits_payment_exec ("contentor","doc_new",$g_doc_array['ddbdatalinker_id'],$g_doc_array['ddbcontentor_docs_author_id'],$direct_settings['contentor_doc_new_credits_onetime'],$direct_settings['contentor_doc_new_credits_periodically']);
				}

				$g_doc_array['ddbcontentor_docs_owner_id'] = $direct_settings['user']['id'];
				$g_doc_array['ddbcontentor_docs_owner_ip'] = $direct_settings['user_ip'];
			}

			$g_continue_check = $g_doc_object->set_update ($g_doc_array);

			if ($g_continue_check) { $direct_classes['db']->v_transaction_commit (); }
			else { $direct_classes['db']->v_transaction_rollback (); }

			break 1;
		}
		case "stick":
		{
			$direct_cachedata['output_job'] = direct_local_get ("contentor_doc_stick");
			$g_continue_check = $g_doc_object->define_stick (true,true);

			break 1;
		}
		case "unlock":
		{
			$direct_cachedata['output_job'] = direct_local_get ("contentor_doc_unlock");
			$g_continue_check = ($g_doc_object->define_lock (false,true) ? false : true);

			break 1;
		}
		case "unstick":
		{
			$direct_cachedata['output_job'] = direct_local_get ("contentor_doc_unstick");
			$g_continue_check = ($g_doc_object->define_stick (false,true) ? false : true);

			break 1;
		}
		}

		if ($g_continue_check)
		{
			$direct_cachedata['output_job_desc'] = direct_local_get ("contentor_done_doc_change_state");

			if ($g_target_url)
			{
				$direct_cachedata['output_jsjump'] = 2000;
				$g_target_link = str_replace ("[oid]","cdid_d+{$g_did}++",$g_target_url);
			}
			elseif ($g_connector_url)
			{
				$direct_cachedata['output_jsjump'] = 2000;
				$g_target_link = str_replace (array ("[a]","[oid]"),(array ("view","cdid_d+{$g_did}++")),$g_connector_url);
			}
			else { $direct_cachedata['output_jsjump'] = 0; }

			if ($direct_cachedata['output_jsjump'])
			{
				$direct_cachedata['output_pagetarget'] = str_replace ('"',"",(direct_linker ("url0",$g_target_link)));
				$direct_cachedata['output_scripttarget'] = str_replace ('"',"",(direct_linker ("url0",$g_target_link,false)));
			}

			if ($g_datasub_check) { direct_output_related_manager ("contentor_doc_state_".$g_did,"post_module_service_action"); }
			else { direct_output_related_manager ("contentor_doc_state_{$g_cat_array['ddbdatalinker_id']}_".$g_did,"post_module_service_action"); }

			$direct_classes['output']->oset ("default","done");
			$direct_classes['output']->options_flush (true);
			$direct_classes['output']->header (false,true,$direct_settings['p3p_url'],$direct_settings['p3p_cp']);
			$direct_classes['output']->page_show ($direct_cachedata['output_job']);
		}
		else { $direct_classes['error_functions']->error_page ("fatal","core_database_error","sWG/#echo(__FILEPATH__)# _a=state_ (#echo(__LINE__)#)"); }
	}
	else { $direct_classes['error_functions']->error_page ("login","core_access_denied","sWG/#echo(__FILEPATH__)# _a=state_ (#echo(__LINE__)#)"); }
	//j// EOA
	}

	$direct_cachedata['core_service_activated'] = true;
	break 1;
}
//j// EOS
}

//j// EOF
?>