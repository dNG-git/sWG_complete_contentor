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
* osets/default_etitle/swg_contentor_news.php
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

//j// Functions and classes

//f// direct_output_oset_contentor_news_list ()
/**
* direct_output_oset_contentor_news_list ()
*
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_contentor_news_list ()
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_contentor_news_list ()- (#echo(__LINE__)#)"); }

	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_contentor.php");

	if (isset ($direct_cachedata['output_cat']))
	{
		if (strlen ($direct_cachedata['output_cat']['title_alt'])) { $direct_settings['theme_output_page_title'] = $direct_cachedata['output_cat']['title_alt']; }
		else { $direct_settings['theme_output_page_title'] = $direct_cachedata['output_cat']['title']; }

		if ($direct_cachedata['output_cat']['symbol']) { $f_cat_colspan = 3; }
		else { $f_cat_colspan = 2; }

$f_return = ("<table cellspacing='1' summary='' class='pageborder1' style='width:100%;table-layout:auto'>
<thead class='pagehide'><tr>
<td colspan='$f_cat_colspan' align='left' class='pagetitlecellbg' style='padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>{$direct_settings['theme_output_page_title']}</span></td>
</tr></thead><tbody>");

		if ($direct_cachedata['output_cat']['pageurl_parent']) { $f_return .= "<tr>\n<td colspan='$f_cat_colspan' align='left' class='pagebg' style='padding:$direct_settings[theme_form_td_padding]'><span class='pagecontent' style='font-size:10px'><a href=\"{$direct_cachedata['output_cat']['pageurl_parent']}\" target='_self'>".(direct_local_get ("core_level_up"))."</a></span></td>\n</tr>"; }

		$f_return .= "<tr>";
		if ($direct_cachedata['output_cat']['symbol']) { $f_return .= "\n<td valign='middle' align='left' class='pagebg' style='padding:$direct_settings[theme_td_padding]'><img src='{$direct_cachedata['output_cat']['symbol']}' border='0' alt='' title='' /></td>"; }
		$f_return .= "\n<td valign='middle' align='left' class='pagebg' style='width:90%;padding:$direct_settings[theme_td_padding]'>";

		if ($direct_cachedata['output_cat']['desc']) { $f_return .= "<span class='pagecontent'>{$direct_cachedata['output_cat']['desc']}</span>"; }
		else { $f_return .= "<span class='pagecontent'>".(direct_local_get ("contentor_cat_desc_empty"))."</span>"; }

$f_return .= ("</td>
<td align='center' class='pageextrabg' style='width:10%;padding:$direct_settings[theme_td_padding]'><span class='pageextracontent' style='font-size:10px'><span style='font-weight:bold'>".(direct_local_get ("contentor_docs")).":</span> {$direct_cachedata['output_cat']['docs']}</span></td>
</tr></tbody>
</table>");

		if (!empty ($direct_cachedata['output_cats'])) { $f_return .= "<span style='font-size:8px'>&#0160;</span>".(direct_contentor_oset_cats_parse ($direct_cachedata['output_cats'],"news")); }
	}
	else { $f_return = ""; }

	if (empty ($direct_cachedata['output_docs'])) { $f_return .= "\n<p class='pagecontent' style='font-weight:bold'>".(direct_local_get ("contentor_docs_list_empty"))."</p>"; }
	else
	{
		if ($direct_cachedata['output_pages'] > 1) { $f_return .= "\n<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>\n"; }
		elseif (isset ($direct_cachedata['output_cat'])) { $f_return .= "<span style='font-size:8px'>&#0160;</span>"; }

		$f_return .= direct_contentor_oset_docs_parse ($direct_cachedata['output_docs'],"news");
		if ($direct_cachedata['output_pages'] > 1) { $f_return .= "\n<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>"; }
	}

	return $f_return;
}

//f// direct_output_oset_contentor_news_view ()
/**
* direct_output_oset_contentor_news_view ()
*
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_contentor_news_view ()
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_contentor_news_view ()- (#echo(__LINE__)#)"); }

	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_contentor.php");

	if (!empty ($direct_cachedata['output_doc']))
	{
		if (strlen ($direct_cachedata['output_doc']['title_alt'])) { $direct_settings['theme_output_page_title'] = $direct_cachedata['output_doc']['title_alt']; }
		else { $direct_settings['theme_output_page_title'] = $direct_cachedata['output_doc']['title']; }
	}

	if (isset ($direct_cachedata['output_cat']))
	{
		if (strlen ($direct_cachedata['output_cat']['title_alt'])) { $f_cat_title = $direct_cachedata['output_cat']['title_alt']; }
		else { $f_cat_title = $direct_cachedata['output_cat']['title']; }

		if ($direct_cachedata['output_cat']['symbol']) { $f_cat_colspan = 3; }
		else { $f_cat_colspan = 2; }

$f_return = ("<table cellspacing='1' summary='' class='pageborder1' style='width:100%;table-layout:auto'>
<thead><tr>
<td colspan='$f_cat_colspan' align='left' class='pagetitlecellbg' style='padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'><a href=\"{$direct_cachedata['output_cat']['pageurl']}\" target='_self'>$f_cat_title</a></span></td>
</tr></thead><tbody>");

		if ($direct_cachedata['output_cat']['pageurl_parent']) { $f_return .= "<tr>\n<td colspan='$f_cat_colspan' align='left' class='pagebg' style='padding:$direct_settings[theme_form_td_padding]'><span class='pagecontent' style='font-size:10px'><a href=\"{$direct_cachedata['output_cat']['pageurl_parent']}\" target='_self'>".(direct_local_get ("core_level_up"))."</a></span></td>\n</tr>"; }

		$f_return .= "<tr>";
		if ($direct_cachedata['output_cat']['symbol']) { $f_return .= "\n<td valign='middle' align='left' class='pagebg' style='padding:$direct_settings[theme_td_padding]'><img src='{$direct_cachedata['output_cat']['symbol']}' border='0' alt='' title='' /></td>"; }
		$f_return .= "\n<td valign='middle' align='left' class='pagebg' style='width:90%;padding:$direct_settings[theme_td_padding]'>";

		if ($direct_cachedata['output_cat']['desc']) { $f_return .= "<span class='pagecontent'>{$direct_cachedata['output_cat']['desc']}</span>"; }
		else { $f_return .= "<span class='pagecontent'>".(direct_local_get ("contentor_cat_desc_empty"))."</span>"; }

$f_return .= ("</td>
<td align='center' class='pageextrabg' style='width:10%;padding:$direct_settings[theme_td_padding]'><span class='pageextracontent' style='font-size:10px'><span style='font-weight:bold'>".(direct_local_get ("contentor_docs")).":</span> {$direct_cachedata['output_cat']['docs']}</span></td>
</tr></tbody>
</table>");
	}
	else { $f_return = ""; }

	if (!empty ($direct_cachedata['output_doc']))
	{
		if (isset ($direct_cachedata['output_cat'])) { $f_return .= "<span style='font-size:8px'>&#0160;</span>"; }
		$f_return .= direct_contentor_oset_doc_parse ();
	}

	if ($direct_cachedata['output_pages'] > 1) { $f_return .= "\n<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>"; }

	return $f_return;
}

//f// direct_output_oset_contentor_news_versions ()
/**
* direct_output_oset_contentor_news_versions ()
*
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_contentor_news_versions ()
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_contentor_news_versions ()- (#echo(__LINE__)#)"); }

	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_contentor.php");
	$direct_settings['theme_output_page_title'] = direct_local_get ("contentor_docv_list");

	if ($direct_cachedata['output_pages'] > 1) { $f_return = "\n<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>\n"; }
	else { $f_return = ""; }

	$f_return .= direct_contentor_oset_doc_versions_parse ($direct_cachedata['output_doc_versions']);
	if ($direct_cachedata['output_pages'] > 1) { $f_return .= "\n<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>"; }

	return $f_return;
}

//j// Script specific commands

if (!isset ($direct_settings['theme_td_padding'])) { $direct_settings['theme_td_padding'] = "5px"; }
if (!isset ($direct_settings['theme_form_td_padding'])) { $direct_settings['theme_form_td_padding'] = "3px"; }

//j// EOF
?>