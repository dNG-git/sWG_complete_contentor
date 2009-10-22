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
* osets/default_etitle/swg_contentor_pages.php
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

//f// direct_output_oset_contentor_pages_list ()
/**
* direct_output_oset_contentor_pages_list ()
*
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_contentor_pages_list ()
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_contentor_pages_list ()- (#echo(__LINE__)#)"); }

	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_contentor.php");
	$f_return = "";

	if (isset ($direct_cachedata['output_cat']))
	{
		$direct_settings['theme_output_page_title'] = ((strlen ($direct_cachedata['output_cat']['title_alt'])) ? $direct_cachedata['output_cat']['title_alt'] : $direct_cachedata['output_cat']['title']);
		if (!empty ($direct_cachedata['output_cats'])) { $f_return .= direct_contentor_oset_cats_parse ($direct_cachedata['output_cats'],"simple"); }
	}

	if (empty ($direct_cachedata['output_docs'])) { $f_return .= "<p class='pagecontent' style='font-weight:bold'>".(direct_local_get ("contentor_docs_list_empty"))."</p>"; }
	else
	{
		if ($direct_cachedata['output_pages'] > 1) { $f_return .= "\n<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>"; }
		elseif (!empty ($direct_cachedata['output_cats'])) { $f_return .= "<span style='font-size:8px'>&#0160;</span>"; }

		$f_return .= direct_contentor_oset_docs_parse ($direct_cachedata['output_docs'],"simple");
		if ($direct_cachedata['output_pages'] > 1) { $f_return .= "\n<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>"; }
	}

	return $f_return;
}

//f// direct_output_oset_contentor_pages_view ()
/**
* direct_output_oset_contentor_pages_view ()
*
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_contentor_pages_view ()
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_contentor_pages_view ()- (#echo(__LINE__)#)"); }

	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_contentor.php");

	if (empty ($direct_cachedata['output_doc'])) { $f_return = ""; }
	else
	{
		$direct_settings['theme_output_page_title'] = ((strlen ($direct_cachedata['output_doc']['title_alt'])) ? $direct_cachedata['output_doc']['title_alt'] : $direct_cachedata['output_doc']['title']);
		$f_return = direct_contentor_oset_doc_parse ($direct_cachedata['output_doc'],$direct_cachedata['output_content'],$direct_cachedata['output_source'],$direct_cachedata['output_page'],$direct_cachedata['output_pages'],$direct_cachedata['output_pages_structure'],$direct_cachedata['output_pages_show'],"textonly");
	}

	return $f_return;
}

//f// direct_output_oset_contentor_pages_versions ()
/**
* direct_output_oset_contentor_pages_versions ()
*
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_output_oset_contentor_pages_versions ()
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_output_oset_contentor_pages_versions ()- (#echo(__LINE__)#)"); }

	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_contentor.php");
	$direct_settings['theme_output_page_title'] = direct_local_get ("contentor_docv_list");

	$f_return = (($direct_cachedata['output_pages'] > 1) ? "<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>\n" : "");
	$f_return .= direct_contentor_oset_doc_versions_parse ($direct_cachedata['output_doc_versions']);
	if ($direct_cachedata['output_pages'] > 1) { $f_return .= "\n<p class='pageborder2' style='text-align:center'><span class='pageextracontent' style='font-size:10px'>".(direct_output_pages_generator ($direct_cachedata['output_page_url'],$direct_cachedata['output_pages'],$direct_cachedata['output_page']))."</span></p>"; }

	return $f_return;
}

//j// EOF
?>