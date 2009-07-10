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
* FormTags enhanced version for wiki transcoding (and using wikilinks). Codes
* are based on http://www.mediawiki.org.
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
if (defined ("CLASS_direct_formtags_wiki")) { $g_continue_check = false; }
if (!defined ("CLASS_direct_formtags")) { $direct_classes['basic_functions']->include_file ($direct_settings['path_system']."/classes/swg_formtags.php"); }
if (!defined ("CLASS_direct_formtags")) { $g_continue_check = false; }

if ($g_continue_check)
{
//c// direct_formtags_wiki
/**
* This FormTags extensions allows us to use wikilink and some common Wiki
* formating tags.
*
* @author     direct Netware Group
* @copyright  (C) direct Netware Group - All rights reserved
* @package    sWG
* @subpackage contentor
* @uses       CLASS_direct_formtags
* @since      v0.1.00
* @license    http://www.direct-netware.de/redirect.php?licenses;gpl
*             GNU General Public License 2
*/
class direct_formtags_wiki extends direct_formtags
{
/**
	* @var string $connector Link connector definition
*/
	protected $connector;
/**
	* @var string $connector_type Link connector type
*/
	protected $connector_type;

/* -------------------------------------------------------------------------
Extend the class
------------------------------------------------------------------------- */

	//f// direct_formtags_wiki->__construct ()
/**
	* Constructor (PHP5) __construct (direct_formtags_wiki)
	*
	* @param  string $f_connector Connector for links
	* @param  string $f_connector_type Linking mode: "url0" for internal links,
	*         "url1" for external ones, "form" to create hidden fields or
	*         "optical" to remove parts of a very long string.
	* @uses  direct_debug()
	* @uses	 direct_local_integration()
	* @uses  USE_debug_reporting
	* @since v0.1.00
*/
	public function __construct ($f_connector = "",$f_connector_type = "url1")
	{
		if (USE_debug_reporting) { direct_debug (3,"sWG/#echo(__FILEPATH__)# -formtags_class->__construct (direct_formtags_wiki)- (#echo(__LINE__)#)"); }

/* -------------------------------------------------------------------------
My parent should be on my side to get the work done
------------------------------------------------------------------------- */

		parent::__construct ();

/* -------------------------------------------------------------------------
Informing the system about available functions 
------------------------------------------------------------------------- */

		$this->functions['define_connector'] = true;

/* -------------------------------------------------------------------------
Connector initalisation :)
------------------------------------------------------------------------- */

		$this->connector = $f_connector;

		if (($f_connector_type != "asis")&&(strpos ($f_connector,"javascript:") === 0)) { $this->connector_type = "asis"; }
		else { $this->connector_type = $f_connector_type; }
	}

	//f// direct_formtags_wiki->cleanup ($f_data,$f_break_urls = false)
/**
	* Removes FormTags from a given string.
	*
	* @param  string $f_data Input string containing FormTags
	* @param  boolean $f_break_urls True for changing URLs to be shorter (but not
	*         usable anymore)
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return string Filtered string
	* @since  v0.1.00
*/
	public function cleanup ($f_data,$f_break_urls = false)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -formtags_class->cleanup (+f_data,+f_break_urls)- (#echo(__LINE__)#)"); }

		$f_return = parent::cleanup ($f_data,$f_break_urls);
		unset ($f_data);

		if ($this->connector)
		{
			if (preg_match_all ("#\[url:\[rewrite:wikilink:(.+?)\]\](.+?)\[/url\]#i",$f_return,$f_results_array,PREG_SET_ORDER))
			{
				foreach ($f_results_array as $f_result_array)
				{
					$f_pageurl = str_replace ("[a]","wikilink",$this->connector);

					if ($this->connector_type == "asis") { $f_pageurl = str_replace ("[oid]",(urlencode (base64_encode ($f_result_array[1]))),$f_pageurl); }
					else { $f_pageurl = str_replace ("[oid]","cwikiid+".(urlencode (base64_encode ($f_result_array[1])))."++",$f_pageurl); }

					$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
					$f_return = str_replace ($f_result_array[0],$f_result_array[2]." (".(direct_linker ($this->connector_type,$f_pageurl)).")",$f_return);
				}
			}

			if (preg_match_all ("#\[rewrite:wikilink:(.+?)\]#i",$f_return,$f_results_array,PREG_SET_ORDER))
			{
				foreach ($f_results_array as $f_result_array)
				{
					$f_pageurl = str_replace ("[a]","wikilink",$this->connector);

					if ($this->connector_type == "asis") { $f_pageurl = str_replace ("[oid]",(urlencode (base64_encode ($f_result_array[1]))),$f_pageurl); }
					else { $f_pageurl = str_replace ("[oid]","cwikiid+".(urlencode (base64_encode ($f_result_array[1])))."++",$f_pageurl); }

					$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
					$f_return = str_replace ($f_result_array[0],$f_result_array[1]." (".(direct_linker ($this->connector_type,$f_pageurl)).")",$f_return);
				}
			}
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -formtags_class->cleanup ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_formtags_wiki->decode ($f_data)
/**
	* Converts all FormTags into valid XHTML 1.0 code.
	*
	* @param  string $f_data Input string containing FormTags
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return string Filtered string containing XHTML code
	* @since  v0.1.00
*/
	public function decode ($f_data)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -formtags_class->decode (+f_data)- (#echo(__LINE__)#)"); }

		$f_return = parent::decode ($f_data);
		unset ($f_data);

		if ($this->connector)
		{
			if (preg_match_all ("#\[url:\[rewrite:wikilink:(.+?)\]\](.+?)\[/url\]#i",$f_return,$f_results_array,PREG_SET_ORDER))
			{
				foreach ($f_results_array as $f_result_array)
				{
					$f_pageurl = str_replace ("[a]","wikilink",$this->connector);

					if ($this->connector_type == "asis") { $f_pageurl = str_replace ("[oid]",(urlencode (base64_encode ($f_result_array[1]))),$f_pageurl); }
					else { $f_pageurl = str_replace ("[oid]","cwikiid+".(urlencode (base64_encode ($f_result_array[1])))."++",$f_pageurl); }

					$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
					$f_return = str_replace ($f_result_array[0],"<a href=\"".(direct_linker ($this->connector_type,$f_pageurl))."\">{$f_result_array[2]}</a>",$f_return);
				}
			}

			if (preg_match_all ("#\[rewrite:wikilink:(.+?)\]#i",$f_return,$f_results_array,PREG_SET_ORDER))
			{
				foreach ($f_results_array as $f_result_array)
				{
					$f_pageurl = str_replace ("[a]","wikilink",$this->connector);

					if ($this->connector_type == "asis") { $f_pageurl = str_replace ("[oid]",(urlencode (base64_encode ($f_result_array[1]))),$f_pageurl); }
					else { $f_pageurl = str_replace ("[oid]","cwikiid+".(urlencode (base64_encode ($f_result_array[1])))."++",$f_pageurl); }

					$f_pageurl = preg_replace ("#\[(.*?)\]#","",$f_pageurl);
					$f_return = str_replace ($f_result_array[0],"<a href=\"".(direct_linker ($this->connector_type,$f_pageurl))."\">{$f_result_array[1]}</a>",$f_return);
				}
			}
		}

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -formtags_class->decode ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_formtags_wiki->define_connector ($f_connector)
/**
	* (Re)defines the link connector definition.
	*
	* @param  string $f_connector Connector for links
	* @param  string $f_connector_type Linking mode: "url0" for internal links,
	*         "url1" for external ones, "form" to create hidden fields or
	*         "optical" to remove parts of a very long string.
	* @uses  direct_debug()
	* @uses  USE_debug_reporting
	* @return string Accepted connector
	* @since v0.1.00
*/
	public function define_connector ($f_connector,$f_connector_type = "url1")
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -formtags_class->define_connector ($f_connector)- (#echo(__LINE__)#)"); }

		$this->connector = $f_connector;

		if (($f_connector_type != "asis")&&(strpos ($f_connector,"javascript:") === 0)) { $this->connector_type = "asis"; }
		else { $this->connector_type = $f_connector_type; }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -formtags_class->define_connector ()- (#echo(__LINE__)#)",:#*/$this->connector/*#ifdef(DEBUG):,true):#*/;
	}

	//f// direct_formtags_wiki->encode ($f_data,$f_withhtml = false,$f_withftg = true)
/**
	* Converts BBCode to FormTags and filters HTML and or simple HTML statements
	* for links or images.
	*
	* @param  string $f_data Input string
	* @param  boolean $f_withhtml True to not remove HTML tags
	* @param  boolean $f_withftg True for allowing FormTags in the input string
	* @uses   direct_debug()
	* @uses   USE_debug_reporting
	* @return string Filtered string containing FormTags
	* @since  v0.1.00
*/
	public function encode ($f_data,$f_withhtml = false,$f_withftg = true)
	{
		if (USE_debug_reporting) { direct_debug (5,"sWG/#echo(__FILEPATH__)# -formtags_class->encode (+f_data,$f_withhtml,$f_withftg)- (#echo(__LINE__)#)"); }

		$f_return = parent::encode ($f_data,$f_withhtml,$f_withftg);
		unset ($f_data);

//		if (stristr ($f_return,"<nowiki>")) { $this->tree_changer_rule_based ($f_return,"encode:nowiki"); }
		if (strstr ($f_return,"''")) { $f_return = preg_replace ("#''(.+?)''#si","[font:italic]\\1[/font]",$f_return); }
		if (strstr ($f_return,"'''")) { $f_return = preg_replace ("#'''(.+?)'''#si","[font:bold]\\1[/font]",$f_return); }
		if (strstr ($f_return,"'''''")) { $f_return = preg_replace ("#'''''(.+?)'''''#si","[font:italic][font:bold]\\1[/font][/font]",$f_return); }
		if (strstr ($f_return,"----")) { $f_return = preg_replace ("#^----$#msi","[hr]",$f_return); }

		return /*#ifdef(DEBUG):direct_debug (7,"sWG/#echo(__FILEPATH__)# -formtags_class->encode ()- (#echo(__LINE__)#)",:#*/$f_return/*#ifdef(DEBUG):,true):#*/;
	}
}

/* -------------------------------------------------------------------------
Mark this class as the most up-to-date one
------------------------------------------------------------------------- */

$direct_classes['@names']['formtags'] = "direct_formtags_wiki";
define ("CLASS_direct_formtags_wiki",true);
}

//j// EOF
?>