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
$Id: swgi_contentor.php,v 1.3 2009/03/28 07:56:07 s4u Exp $
#echo(sWGcontentorVersion)#
sWG/#echo(__FILEPATH__)#
----------------------------------------------------------------------------
NOTE_END //n*/
/**
* osets/default_etitle/swgi_contentor.php
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

//f// direct_contentor_oset_cats_parse ($f_cats,$f_type = "simple")
/**
* direct_contentor_oset_cats_parse ()
*
* @param  array $f_cats Categories
* @param  string $f_type Presentation type ("news" or "simple")
* @uses   direct_debug()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_contentor_oset_cats_parse ($f_cats,$f_type = "simple")
{
	global $direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_contentor_oset_cats_parse (+f_cats,$f_type)- (#echo(__LINE__)#)"); }

	$f_return = "";

	if (!empty ($f_cats))
	{
		if ($f_type == "news")
		{
$f_return = ("<table cellspacing='1' summary='' class='pageborder1' style='width:100%;table-layout:auto'>
<thead class='pagehide'><tr>
<td colspan='2' align='left' class='pagetitlecellbg' style='padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>".(direct_local_get ("contentor_cats"))."</span></td>
</tr></thead><tbody>");

			foreach ($f_cats as $f_cat_array)
			{
				if (isset ($f_right_switch))
				{
					if ($f_right_switch)
					{
						$f_return .= "</td>\n<td valign='middle' align='left' class='pagebg' style='width:50%;padding:$direct_settings[theme_form_td_padding]'>";
						$f_right_switch = false;
					}
					else
					{
						$f_return .= "</td>\n</tr><tr>\n<td valign='middle' align='left' class='pagebg' style='width:50%;padding:$direct_settings[theme_form_td_padding]'>";
						$f_right_switch = true;
					}
				}
				else
				{
					$f_return .= "<tr>\n<td valign='middle' align='left' class='pagebg' style='width:50%;padding:$direct_settings[theme_form_td_padding]'>";
					$f_right_switch = true;
				}

				if (strlen ($f_cat_array['title_alt'])) { $f_cat_title = $f_cat_array['title_alt']; }
				else { $f_cat_title = $f_cat_array['title']; }

				$f_return .= "<p class='pagecontenttitle'><a href=\"{$f_cat_array['pageurl']}\" target='_self'>$f_cat_title</a></p>\n<p class='pagecontent'>";

				if ($f_cat_array['symbol']) { $f_return .= "<img src='{$f_cat_array['symbol']}' border='0' alt='' title='' style='float:left;margin-right:5px' />"; }

				if ($f_cat_array['desc']) { $f_return .= $f_cat_array['desc']; }
				else { $f_return .= direct_local_get ("contentor_cat_desc_empty"); }

				$f_return .= "<br />\n<span style='font-size:10px'>";
				if ($f_cat_array['subcats']) { $f_return .= "<br />\n<span style='font-weight:bold'>".(direct_local_get ("contentor_cats")).":</span> {$f_cat_array['subcats']}<br />\n"; }
				$f_return .= "<span style='font-weight:bold'>".(direct_local_get ("contentor_docs")).":</span> {$f_cat_array['docs']}</span></p>";
			}

			if ($f_right_switch) { $f_return .= "</td>\n<td class='pagebg' style='width:50%'><span style='font-size:8px'>&#0160;</span></td>\n</tr></tbody>\n</table>"; }
			else { $f_return .= "</td>\n</tr></tbody>\n</table>"; }
		}
		else
		{
$f_return = ("<table cellspacing='1' summary='' class='pageborder1' style='width:100%;table-layout:auto'>
<thead class='pagehide'><tr>
<td colspan='2' align='left' class='pagetitlecellbg' style='padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>".(direct_local_get ("contentor_cats"))."</span></td>
</tr></thead><tbody>");

			foreach ($f_cats as $f_cat_array)
			{
				if (strlen ($f_cat_array['title_alt'])) { $f_cat_title = $f_cat_array['title_alt']; }
				else { $f_cat_title = $f_cat_array['title']; }

$f_return .= ("<tr>
<td align='left' class='pagebg' style='width:90%;padding:$direct_settings[theme_form_td_padding]'><p class='pagecontenttitle'><a href=\"{$f_cat_array['pageurl']}\" target='_self'>$f_cat_title</a></p>
<p class='pagecontent'>");

				if ($f_cat_array['symbol']) { $f_return .= "<img src='{$f_cat_array['symbol']}' border='0' alt='' title='' style='float:left;margin-right:5px' />"; }

				if ($f_cat_array['desc']) { $f_return .= $f_cat_array['desc']; }
				else { $f_return .= direct_local_get ("contentor_cat_desc_empty"); }

				$f_return .= "</p></td>\n<td align='center' class='pageextrabg' style='width:10%;padding:$direct_settings[theme_form_td_padding]'><span class='pageextracontent' style='font-size:10px'>";
				if ($f_cat_array['subcats']) { $f_return .= "<br />\n<span style='font-weight:bold'>".(direct_local_get ("contentor_cats")).":</span> {$f_cat_array['subcats']}<br />\n"; }
				$f_return .= "<span style='font-weight:bold'>".(direct_local_get ("contentor_docs")).":</span> {$f_cat_array['docs']}</span></td>\n</tr>";
			}

			$f_return .= "</tbody>\n</table>";
		}
	}

	return $f_return;
}

//f// direct_contentor_oset_doc_parse ($f_type = "default")
/**
* direct_contentor_oset_doc_parse ()
*
* @param  string $f_type Presentation type ("default","textonly" or "simple")
* @uses   direct_account_oset_parse_user_fullh()
* @uses   direct_contentor_oset_doc_pages_structure_parse()
* @uses   direct_debug()
* @uses   $direct_linker_dynamic()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_contentor_oset_doc_parse ($f_type = "default")
{
	global $direct_cachedata,$direct_classes,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_contentor_oset_doc_parse ($f_type)- (#echo(__LINE__)#)"); }

	$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_account_profile.php");
	$f_return = "";

	if (!empty ($direct_cachedata['output_doc']))
	{
		switch ($f_type)
		{
		case "default":
		{
$f_return = ("<table cellspacing='1' summary='' class='pageborder1' style='width:100%;table-layout:auto'>
<thead class='pagehide'><tr>
<td colspan='2' align='left' class='pagetitlecellbg' style='padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>".(direct_local_get ("contentor_doc"))."</span></td>
</tr></thead><tbody><tr>
<td valign='middle' align='left' class='pageextrabg' style='width:50%;padding:$direct_settings[theme_td_padding]'>");

			if ($direct_cachedata['output_doc']['authorid']) { $f_return .= direct_account_oset_parse_user_fullh ($direct_cachedata['output_doc'],"page","","","author"); }
			else { $f_return .= direct_account_oset_parse_user_fullh ($direct_cachedata['output_doc'],"page","","","owner"); }

$f_return .= ("</td>
<td valign='middle' align='center' class='pagebg' style='width:50%;padding:$direct_settings[theme_td_padding]'><p class='pagecontent' style='font-size:10px;font-weight:bold'>".(direct_local_get ("contentor_doc_last_edit_1")).$direct_cachedata['output_doc']['time'].(direct_local_get ("contentor_doc_last_edit_2"))."</p>
<p class='pagecontent' style='font-size:10px'>");

			if ($direct_cachedata['output_doc']['views_counted']) { $f_return .= (direct_local_get ("contentor_doc_views_1"))."<span style='font-weight:bold'>{$direct_cachedata['output_doc']['views']}</span>".(direct_local_get ("contentor_doc_views_2")); }
			else { $f_return .= direct_local_get ("contentor_doc_views_inactive"); }

			$f_return .= "</p></td>\n</tr>";
			if (($direct_cachedata['output_pages'] > 1)&&($direct_cachedata['output_pages_show'])) { $f_return .= "<tr>\n<td colspan='2' align='center' class='pagebg' style='padding:$direct_settings[theme_td_padding]'><span class='pagecontent'><span style='font-weight:bold'>".(direct_local_get ("core_pages")).":</span> ".(direct_contentor_oset_doc_pages_structure_parse ($direct_cachedata['output_pages_structure'],$direct_cachedata['output_page']))."</span></td>\n</tr>"; }
			$f_return .= "<tr>\n<td colspan='2' align='left' class='pagebg' style='padding:$direct_settings[theme_td_padding]'><p class='pagecontent'>";

			if ($direct_cachedata['output_doc']['symbol']) { $f_return .= "<img src='{$direct_cachedata['output_doc']['symbol']}' border='0' alt='' title='' style='float:left;margin-right:5px' />"; }
			if ($direct_cachedata['output_doc']['locked']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_locked.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_locked"))."' title='".(direct_local_get ("contentor_doc_locked"))."' style='float:right;margin-left:5px' />"; }
			if ($direct_cachedata['output_doc']['new']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_text_new.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_new_edited"))."' title='".(direct_local_get ("contentor_doc_new_edited"))."' style='float:right;margin-left:5px' />"; }
			if ($direct_cachedata['output_doc']['sticky']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_sticky.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_sticky"))."' title='".(direct_local_get ("contentor_doc_sticky"))."' style='float:right;margin-left:5px' />"; }

			$f_return .= $direct_cachedata['output_content']."</p>";

			if ($direct_cachedata['output_doc']['authorid'])
			{
				$f_return .= "\n<p class='pagecontent' style='font-size:10px'>";

				if ($direct_cachedata['output_doc']['ownerpageurl']) { $f_return .= (direct_local_get ("contentor_doc_published_1"))."<span style='font-weight:bold'><a href=\"{$direct_cachedata['output_doc']['ownerpageurl']}\" target='_blank'>{$direct_cachedata['output_doc']['ownername']}</a></span>"; }
				else { $f_return .= (direct_local_get ("contentor_doc_published_1"))."<span style='font-weight:bold'>{$direct_cachedata['output_doc']['ownername']}</span>"; }

				$f_return .= (direct_local_get ("contentor_doc_published_2"))."<span style='font-weight:bold'>{$direct_cachedata['output_doc']['pubtime']}</span>".(direct_local_get ("contentor_doc_published_3"))."</p>";
			}

$f_return .= ("</td>
</tr></tbody>
</table>");

			break 1;
		}
		case "textonly":
		{
			if ($direct_cachedata['output_content'])
			{
				if (($direct_cachedata['output_pages'] > 1)&&($direct_cachedata['output_pages_show'])) { $f_return .= "\n<p class='pageborder2' style='text-align:center'><span class='pagecontent'><span style='font-weight:bold'>".(direct_local_get ("core_pages")).":</span> ".(direct_contentor_oset_doc_pages_structure_parse ($direct_cachedata['output_pages_structure'],$direct_cachedata['output_page']))."</span></p>"; }
				$f_return .= "\n<p class='pagecontent'>";

				if ($direct_cachedata['output_doc']['symbol']) { $f_return .= "<img src='{$direct_cachedata['output_doc']['symbol']}' border='0' alt='' title='' style='float:left;margin-right:5px' />"; }
				if ($direct_cachedata['output_doc']['locked']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_locked.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_locked"))."' title='".(direct_local_get ("contentor_doc_locked"))."' style='float:right;margin-left:5px' />"; }
				if ($direct_cachedata['output_doc']['new']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_text_new.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_new_edited"))."' title='".(direct_local_get ("contentor_doc_new_edited"))."' style='float:right;margin-left:5px' />"; }
				if ($direct_cachedata['output_doc']['sticky']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_sticky.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_sticky"))."' title='".(direct_local_get ("contentor_doc_sticky"))."' style='float:right;margin-left:5px' />"; }

				$f_return .= $direct_cachedata['output_content']."</p>";
			}

			break 1;
		}
		default:
		{
			if (($direct_cachedata['output_pages'] > 1)&&($direct_cachedata['output_pages_show'])) { $f_return = "<p class='pageborder2' style='text-align:center'><span class='pagecontent'><span style='font-weight:bold'>".(direct_local_get ("core_pages")).":</span> ".(direct_contentor_oset_doc_pages_structure_parse ($direct_cachedata['output_pages_structure'],$direct_cachedata['output_page']))."</span></p>"; }
			$f_return .= "\n<p class='pagecontent'>";

			if ($direct_cachedata['output_doc']['symbol']) { $f_return .= "<img src='{$direct_cachedata['output_doc']['symbol']}' border='0' alt='' title='' style='float:left;margin-right:5px' />"; }
			if ($direct_cachedata['output_doc']['locked']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_locked.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_locked"))."' title='".(direct_local_get ("contentor_doc_locked"))."' style='float:right;margin-left:5px' />"; }
			if ($direct_cachedata['output_doc']['new']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_text_new.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_new_edited"))."' title='".(direct_local_get ("contentor_doc_new_edited"))."' style='float:right;margin-left:5px' />"; }
			if ($direct_cachedata['output_doc']['sticky']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_sticky.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_sticky"))."' title='".(direct_local_get ("contentor_doc_sticky"))."' style='float:right;margin-left:5px' />"; }

			$f_return .= $direct_cachedata['output_content']."</p>\n<p class='pagecontent' style='text-align:center;font-size:10px'>".(direct_local_get ("contentor_doc_last_edit_1")).$direct_cachedata['output_doc']['time'].(direct_local_get ("contentor_doc_last_edit_2"));

			if ($direct_cachedata['output_doc']['authorid'])
			{
				if ($direct_cachedata['output_doc']['authorpageurl']) { $f_return .= " (<span style='font-weight:bold'><a href=\"{$direct_cachedata['output_doc']['authorpageurl']}\" target='_blank'>{$direct_cachedata['output_doc']['authorname']}</a></span>)"; }
				else { $f_return .= " (<span style='font-weight:bold'>{$direct_cachedata['output_doc']['authorname']}</span>)"; }
			}

			$f_return .= "<br />\n";

			if ($direct_cachedata['output_doc']['ownerpageurl']) { $f_return .= (direct_local_get ("contentor_doc_published_1"))."<span style='font-weight:bold'><a href=\"{$direct_cachedata['output_doc']['ownerpageurl']}\" target='_blank'>{$direct_cachedata['output_doc']['ownername']}</a></span>"; }
			else { $f_return .= (direct_local_get ("contentor_doc_published_1"))."<span style='font-weight:bold'>{$direct_cachedata['output_doc']['ownername']}</span>"; }

			$f_return .= (direct_local_get ("contentor_doc_published_2"))."<span style='font-weight:bold'>{$direct_cachedata['output_doc']['pubtime']}</span>".(direct_local_get ("contentor_doc_published_3"))."<br />";

			if ($direct_cachedata['output_doc']['views_counted']) { $f_return .= (direct_local_get ("contentor_doc_views_1"))."<span style='font-weight:bold'>{$direct_cachedata['output_doc']['views']}</span>".(direct_local_get ("contentor_doc_views_2")); }
			else { $f_return .= direct_local_get ("contentor_doc_views_inactive"); }

			$f_return .= "</p>";
		}
		}

		if (($direct_cachedata['output_doc']['subs_allowed'])||($direct_cachedata['output_doc']['subs_available']))
		{
			$direct_classes['basic_functions']->require_file ($direct_settings['path_system']."/osets/$direct_settings[theme_oset]/swgi_datalinker_iview.php");
			$f_return .= "\n<p class='pagecontenttitle'>{$direct_cachedata['output_doc']['subs_title']}</p>\n".(direct_datalinker_oset_iview_subs ($direct_cachedata['output_doc'],7,$direct_cachedata['output_source'],"default"));
		}
	}

	return $f_return;
}

//f// direct_contentor_oset_doc_pages_structure_parse ($f_structure,$f_page)
/**
* direct_contentor_oset_doc_pages_structure_parse ()
*
* @param  array $f_structure Page structure array
* @param  integer $f_page Current page
* @uses   direct_debug()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_contentor_oset_doc_pages_structure_parse ($f_structure,$f_page)
{
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_contentor_oset_doc_pages_structure_parse (+f_structure,$f_page)- (#echo(__LINE__)#)"); }
	$f_return = "";

	if (!empty ($f_structure))
	{
		foreach ($f_structure as $f_page_number => $f_page_array)
		{
			if ($f_comma_check) { $f_return .= ", "; }
			else { $f_comma_check = true; }

			if ($f_page_number == $f_page) { $f_return .= $f_page_array['name']; }
			else { $f_return .= "<a href=\"{$f_page_array['url']}\">{$f_page_array['name']}</a>"; }
		}
	}

	return $f_return;
}

//f// direct_contentor_oset_doc_preview ()
/**
* direct_contentor_oset_doc_preview ()
*
* @uses   direct_debug()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_contentor_oset_doc_preview ()
{
	global $direct_cachedata,$direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_contentor_oset_doc_preview ()- (#echo(__LINE__)#)"); }

return ("<table cellspacing='1' summary='' class='pageborder1' style='width:100%;table-layout:auto'>
<thead><tr>
<td colspan='2' align='left' class='pagetitlecellbg' style='padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>{$direct_cachedata['output_title']}</span></td>
</tr></thead><tbody><tr>
<td valign='middle' align='left' class='pageextrabg' style='width:50%;padding:$direct_settings[theme_td_padding]'><div class='pageborder2' style='text-align:left'><p class='pagecontent' style='font-weight:bold'>{$direct_cachedata['output_username']}</p></div></td>
<td valign='middle' align='center' class='pagebg' style='width:50%;padding:$direct_settings[theme_td_padding]'><p class='pagecontent' style='font-size:10px'>".(direct_local_get ("contentor_doc_views_inactive"))."</p></td>
</tr><tr>
<td colspan='2' align='left' class='pagebg' style='padding:$direct_settings[theme_td_padding]'><p class='pagecontent'><span style='font-size:10px;font-weight:bold'>".(direct_local_get ("contentor_teaser")).":</span><br />
{$direct_cachedata['output_teaser']}</p></td>
</tr><tr>
<td colspan='2' align='left' class='pagebg' style='padding:$direct_settings[theme_td_padding]'><p class='pagecontent'><span style='font-size:10px;font-weight:bold'>".(direct_local_get ("contentor_text")).":</span><br />
{$direct_cachedata['output_text']}</p></td>
</tr></tbody>
</table>");
}

//f// direct_contentor_oset_doc_versions_parse ($f_doc_versions)
/**
* direct_contentor_oset_doc_versions_parse ()
*
* @param  array $f_doc_versions Document version list
* @uses   direct_debug()
* @uses   direct_linker_dynamic()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_contentor_oset_doc_versions_parse ($f_doc_versions)
{
	global $direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_contentor_oset_doc_versions_parse (+f_doc_versions)- (#echo(__LINE__)#)"); }

	$f_return = "";

	if (!empty ($f_doc_versions))
	{
$f_return = ("<table cellspacing='1' summary='' class='pageborder1' style='width:100%'>
<thead><tr>
<td valign='middle' align='center' class='pagetitlecellbg' style='width:75%;padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>".(direct_local_get ("contentor_doc_info"))."</span></td>
<td valign='middle' align='center' class='pagetitlecellbg' style='width:25%;padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent' style='font-size:10px'>".(direct_local_get ("contentor_doc_published"))."</span></td>
</tr></thead><tbody>");

		foreach ($f_doc_versions as $f_doc_array)
		{
			$f_return .= "<tr>\n<td valign='middle' align='left' class='pagebg' style='width:75%;padding:$direct_settings[theme_td_padding]'><span class='pagecontent'>";

			if ($f_doc_array['symbol']) { $f_return .= "<img src='{$f_doc_array['symbol']}' border='0' alt='' title='' style='float:left;margin-right:5px' />"; }
			if ($f_doc_array['locked']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_locked.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_locked"))."' title='".(direct_local_get ("contentor_doc_locked"))."' style='float:right;margin-left:5px' />"; }
			if ($f_doc_array['new']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_text_new.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_new_edited"))."' title='".(direct_local_get ("contentor_doc_new_edited"))."' style='float:right;margin-left:5px' />"; }
			if ($f_doc_array['sticky']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_sticky.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_sticky"))."' title='".(direct_local_get ("contentor_doc_sticky"))."' style='float:right;margin-left:5px' />"; }

			if (isset ($f_doc_array['pageurl_counted'])) { $f_doc_pageurl = $f_doc_array['pageurl_counted']; }
			else { $f_doc_pageurl = $f_doc_array['pageurl']; }

			if (strlen ($f_doc_array['title_alt'])) { $f_doc_title = $f_doc_array['title_alt']; }
			else { $f_doc_title = $f_doc_array['title']; }

$f_return .= ("<span style='font-weight:bold'><a href=\"$f_doc_pageurl\" target='_self'>$f_doc_title</a></span><br /><br />
<span style='font-size:10px'>{$f_doc_array['desc']}</span></span></td>
<td valign='middle' align='center' class='pageextrabg' style='width:25%;padding:$direct_settings[theme_td_padding]'><span class='pageextracontent' style='font-size:10px'><span style='font-weight:bold'>{$f_doc_array['pubtime']}</span> (");

			if ($f_doc_array['ownername'])
			{
				if ($f_doc_array['ownerpageurl']) { $f_return .= "<a href=\"{$f_doc_array['ownerpageurl']}\" target='_blank'>{$f_doc_array['ownername']}</a>"; }
				else { $f_return .= $f_doc_array['ownername']; }
			}
			else { $f_return .= direct_local_get ("core_unknown"); }

$f_return .= (")</span></td>
</tr>");
		}

		$f_return .= "</tbody>\n</table>";
	}

	return $f_return;
}

//f// direct_contentor_oset_docs_parse ($f_docs,$f_type = "simple")
/**
* direct_contentor_oset_docs_parse ()
*
* @param  array $f_docs Documents
* @param  string $f_type Presentation type ("news" or "simple")
* @uses   direct_debug()
* @uses   direct_linker_dynamic()
* @uses   direct_local_get()
* @uses   USE_debug_reporting
* @return string Valid XHTML code
* @since  v0.1.00
*/
function direct_contentor_oset_docs_parse ($f_docs,$f_type = "simple")
{
	global $direct_settings;
	if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -direct_contentor_oset_docs_parse (+f_docs,$f_type)- (#echo(__LINE__)#)"); }

	$f_return = "";

	if (!empty ($f_docs))
	{
		if ($f_type == "news")
		{
			$f_return = "<table cellspacing='1' summary='' class='pageborder1' style='width:100%'>\n<tbody>";

			foreach ($f_docs as $f_doc_array)
			{
				if (isset ($f_right_switch))
				{
					if ($f_right_switch)
					{
						$f_return .= "</td>\n<td valign='top' align='left' class='pagebg' style='width:50%;padding:$direct_settings[theme_td_padding]'>";
						$f_right_switch = false;
					}
					else
					{
						$f_return .= "</td>\n</tr><tr>\n<td valign='top' align='left' class='pagebg' style='width:50%;padding:$direct_settings[theme_td_padding]'>";
						$f_right_switch = true;
					}
				}
				else
				{
					$f_return .= "<tr>\n<td colspan='2' align='left' class='pagebg' style='padding:$direct_settings[theme_td_padding]'>";
					$f_right_switch = false;
				}

				if (isset ($f_doc_array['pageurl_counted'])) { $f_doc_pageurl = $f_doc_array['pageurl_counted']; }
				else { $f_doc_pageurl = $f_doc_array['pageurl']; }

				if (strlen ($f_doc_array['title_alt'])) { $f_doc_title = $f_doc_array['title_alt']; }
				else { $f_doc_title = $f_doc_array['title']; }

				$f_return .= "<p class='pagecontenttitle'><a href=\"$f_doc_pageurl\" target='_self'>$f_doc_title</a></p>\n<p class='pagecontent'>";
				if ($f_doc_array['symbol']) { $f_return .= "<img src='{$f_doc_array['symbol']}' border='0' alt='' title='' style='float:left;margin-right:5px' />"; }
				if ($f_doc_array['locked']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_locked.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_locked"))."' title='".(direct_local_get ("contentor_doc_locked"))."' style='float:right;margin-left:5px' />"; }
				if ($f_doc_array['new']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_text_new.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_new_edited"))."' title='".(direct_local_get ("contentor_doc_new_edited"))."' style='float:right;margin-left:5px' />"; }
				if ($f_doc_array['sticky']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_sticky.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_sticky"))."' title='".(direct_local_get ("contentor_doc_sticky"))."' style='float:right;margin-left:5px' />"; }

				$f_return .= $f_doc_array['desc']."</p>\n<p class='pagecontent' style='font-size:10px'>";

				if ($f_doc_array['ownername'])
				{
					if ($f_doc_array['ownerpageurl']) { $f_return .= (direct_local_get ("contentor_doc_published_1"))."<span style='font-weight:bold'><a href=\"{$f_doc_array['ownerpageurl']}\" target='_blank'>{$f_doc_array['ownername']}</a></span>"; }
					else { $f_return .= (direct_local_get ("contentor_doc_published_1"))."<span style='font-weight:bold'>{$f_doc_array['ownername']}</span>"; }
				}
				else { $f_return .= (direct_local_get ("contentor_doc_published_1")).(direct_local_get ("core_unknown")); }

				$f_return .= (direct_local_get ("contentor_doc_published_2"))."<span style='font-weight:bold'>{$f_doc_array['time']}</span>".(direct_local_get ("contentor_doc_published_3"))."<br />\n";

				if ($f_doc_array['views_counted']) { $f_return .= (direct_local_get ("contentor_doc_views_1"))."<span style='font-weight:bold'>{$f_doc_array['views']}</span>".(direct_local_get ("contentor_doc_views_2")); }
				else { $f_return .= direct_local_get ("contentor_doc_views_inactive"); }

				$f_return .= "</p>";
			}

			if ($f_right_switch) { $f_return .= "</td>\n<td class='pagebg' style='width:50%'><span style='font-size:8px'>&#0160;</span></td>\n</tr></tbody>\n</table>"; }
			else { $f_return .= "</td>\n</tr></tbody>\n</table>"; }
		}
		else
		{
$f_return = ("<table cellspacing='1' summary='' class='pageborder1' style='width:100%;table-layout:auto'>
<thead class='pagehide'><tr>
<td colspan='2' align='left' class='pagetitlecellbg' style='padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'>".(direct_local_get ("contentor_doc"))."</span></td>
</tr></thead><tbody>");

			foreach ($f_docs as $f_doc_array)
			{
				if (isset ($f_doc_array['pageurl_counted'])) { $f_doc_pageurl = $f_doc_array['pageurl_counted']; }
				else { $f_doc_pageurl = $f_doc_array['pageurl']; }

				if (strlen ($f_doc_array['title_alt'])) { $f_doc_title = $f_doc_array['title_alt']; }
				else { $f_doc_title = $f_doc_array['title']; }

$f_return .= ("<tr>\n<td align='left' class='pagetitlecellbg' style='padding:$direct_settings[theme_td_padding]'><span class='pagetitlecellcontent'><a href=\"$f_doc_pageurl\" target='_self'>$f_doc_title</a></span></td>
</tr><tr>
<td align='left' class='pagebg' style='padding:$direct_settings[theme_td_padding]'><p class='pagecontent'>");

				if ($f_doc_array['symbol']) { $f_return .= "<img src='{$f_doc_array['symbol']}' border='0' alt='' title='' style='float:left;margin-right:5px' />"; }
				if ($f_doc_array['locked']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_locked.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_locked"))."' title='".(direct_local_get ("contentor_doc_locked"))."' style='float:right;margin-left:5px' />"; }
				if ($f_doc_array['new']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_text_new.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_new_edited"))."' title='".(direct_local_get ("contentor_doc_new_edited"))."' style='float:right;margin-left:5px' />"; }
				if ($f_doc_array['sticky']) { $f_return .= "<img src='".(direct_linker_dynamic ("url0","s=cache&dsd=dfile+$direct_settings[path_themes]/$direct_settings[theme]/status_sticky.png",true,false))."' border='0' alt='".(direct_local_get ("contentor_doc_sticky"))."' title='".(direct_local_get ("contentor_doc_sticky"))."' style='float:right;margin-left:5px' />"; }

				$f_return .= $f_doc_array['desc']."</p>\n<p class='pagecontent' style='font-size:10px'>";

				if ($f_doc_array['ownername'])
				{
					if ($f_doc_array['ownerpageurl']) { $f_return .= (direct_local_get ("contentor_doc_published_1"))."<span style='font-weight:bold'><a href=\"{$f_doc_array['ownerpageurl']}\" target='_blank'>{$f_doc_array['ownername']}</a></span>"; }
					else { $f_return .= (direct_local_get ("contentor_doc_published_1"))."<span style='font-weight:bold'>{$f_doc_array['ownername']}</span>"; }
				}
				else { $f_return .= (direct_local_get ("contentor_doc_published_1")).(direct_local_get ("core_unknown")); }

				$f_return .= (direct_local_get ("contentor_doc_published_2"))."<span style='font-weight:bold'>{$f_doc_array['time']}</span>".(direct_local_get ("contentor_doc_published_3"))."<br />";

				if ($f_doc_array['views_counted']) { $f_return .= (direct_local_get ("contentor_doc_views_1"))."<span style='font-weight:bold'>{$f_doc_array['views']}</span>".(direct_local_get ("contentor_doc_views_2")); }
				else { $f_return .= direct_local_get ("contentor_doc_views_inactive"); }

				$f_return .= "</p></td>\n</tr>";
			}

			$f_return .= "</tbody>\n</table>";
		}
	}

	return $f_return;
}

//j// Script specific commands

if (!isset ($direct_settings['theme_td_padding'])) { $direct_settings['theme_td_padding'] = "5px"; }

//j// EOF
?>