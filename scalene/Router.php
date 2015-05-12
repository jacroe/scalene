<?php

class Router
{
	private $parent;

	public function __construct(&$parent)
	{
		$this->parent = $parent;
	}

	public function route()
	{
		$uri = $this->_parse_request_uri();
		$uri = explode("/", $uri);
		$controller = array_splice($uri, 0, 1-count($uri))[0];

		if (empty($controller))
		{
			$controller = is_null($uri[0]) ? $uri[0] : "news";
			$method = "index";
			$params = array();
		}
		else
		{
			if (count($uri) > 1)
			{
				$method = array_splice($uri, 0, 1-count($uri))[0];
				$params = $uri;
			}
			else
			{
				$method = $uri[0];
				$params = array();
			}
		}

		$this->parent->load->controller($controller);
		if (!call_user_func_array(array($this->parent->$controller, $method), $params))
			echo "500";
	}

	/*
		From CodeIgniter's URL class
		https://github.com/bcit-ci/CodeIgniter/blob/cbf3a559583bcc9055fcee5f7564ca847d0b8dff/system/core/URI.php
	 */
	private function _parse_request_uri()
	{
		if ( ! isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']))
		{
			return '';
		}
		$uri = parse_url($_SERVER['REQUEST_URI']);
		$query = isset($uri['query']) ? $uri['query'] : '';
		$uri = isset($uri['path']) ? $uri['path'] : '';
		if (isset($_SERVER['SCRIPT_NAME'][0]))
		{
			if (strpos($uri, $_SERVER['SCRIPT_NAME']) === 0)
			{
				$uri = (string) substr($uri, strlen($_SERVER['SCRIPT_NAME']));
			}
			elseif (strpos($uri, dirname($_SERVER['SCRIPT_NAME'])) === 0)
			{
				$uri = (string) substr($uri, strlen(dirname($_SERVER['SCRIPT_NAME'])));
			}
		}
		// This section ensures that even on servers that require the URI to be in the query string (Nginx) a correct
		// URI is found, and also fixes the QUERY_STRING server var and $_GET array.
		if (trim($uri, '/') === '' && strncmp($query, '/', 1) === 0)
		{
			$query = explode('?', $query, 2);
			$uri = $query[0];
			$_SERVER['QUERY_STRING'] = isset($query[1]) ? $query[1] : '';
		}
		else
		{
			$_SERVER['QUERY_STRING'] = $query;
		}
		parse_str($_SERVER['QUERY_STRING'], $_GET);
		if ($uri === '/' OR $uri === '')
		{
			return '/';
		}
		// Do some final cleaning of the URI and return it
		return $this->_remove_relative_directory($uri);
	}

	private function _remove_relative_directory($uri)
	{
		$uris = array();
		$tok = strtok($uri, '/');
		while ($tok !== FALSE)
		{
			if (( ! empty($tok) OR $tok === '0') && $tok !== '..')
			{
				$uris[] = $tok;
			}
			$tok = strtok('/');
		}
		return implode('/', $uris);
	}
}