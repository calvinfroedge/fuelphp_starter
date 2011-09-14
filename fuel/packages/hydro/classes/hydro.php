<?php
namespace Hydro;

class Hydro
{
	/*
	* Considered HTML
	*/
	protected static $_considered_html = '';
	
	/*
	* Treat any descendants as children with nested tag from config
	*/
	protected static $_as_children = '';
	
	/*
	* Called automatically when class is initiated
	*/
	public static function _init()
	{
		\Config::load('hydro', true);
		self::$_considered_html = \Config::get('hydro.considered_html');
		self::$_as_children = \Config::get('hydro.as_children');
	}
	
	public static function parse($content)
	{
		$return_string = '';
		if(is_array($content))
		{
			foreach($content as $k=>$v)
			{
				//Check to see if the tag has a class
				if(strstr($k, '.'))
				{
					$k = explode('.', $k);
					$tag = $k[0];
					$class = $k[1];	
					$attributes = array('class' => $class);
				}
				else
				{
					$tag = $k;
					$class = null;
					$attributes = array();
				}
						
				//Check to see if the tag is an html element and does not contain spaces, if not make it a div		
				if(!in_array($tag, self::$_considered_html) AND !strstr($tag, ' '))
				{
					$attributes = array('class' => $tag);
					$return_string .= html_tag('div', $attributes, self::parse($v));
				}
				//End "tag is html?" check
				
				//Check to see if the tag is a parent tag, like a <ul>
				if(array_key_exists($tag, self::$_as_children))
				{	
					if(method_exists('Html', strtolower($tag)))
					{
						$return_string .= \Html::$tag($v, $attributes);
					}
					else
					{
						$return_string .= html_tag($tag, $attributes, $v);
					}
				}
				//End parent tag check
				
				if(is_string($v))
				{
					$return_string .= html_tag($tag, $attributes, $v);
				}
			}
		}
		else
		{
			return $content;
		}
		return $return_string;
	}
}