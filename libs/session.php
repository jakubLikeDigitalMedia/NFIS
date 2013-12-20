<?php
//
//=-----------------------------------------------------------=
// session.php
//=-----------------------------------------------------------=
// Author: Richard Mogendorff 19-Oct-2013
//
// Version 0.1
//
// This file contains the core session handling code that will be used in the website and CMS.
// A few extra things will be done when a session is created to try and avoid some common security problems:
//
// 1. A 'created' variable will be added to the session data to verify that we were the ones who created this session
//    (this helps avoid session fixation attacks).
//
// 2. A hash of the client's USER_AGENT string will be recorded along with another string to reduce the chance of a
//    compromised session id being used successfully.
//
//define('USER_AGENT_SALT', 'th1sIsaBitranDominnIt');

//
//=-----------------------------------------------------------=
// nuke_session
//=-----------------------------------------------------------=
// This function completely destroys a session and all of its data after a user has been logged out of the system.
// In addition to destroying the session data, the session cookie is destroyed and it is also make sure that
// $_SESSION is unset.
//
function nuke_session()
{
	session_destroy();
	setcookie(session_name(), '', time() - 999999);
	$_SESSION[] = array();
}

//---------------------------------------------
// Only grant session if $_SERVER['HTTP_USER_AGENT'] is set
//---------------------------------------------

session_start();

/*
if (isset($_SERVER['HTTP_USER_AGENT']))
{
	
	// One of these sessions can last 60 minutes.
	ini_set('session.gc_maxlifetime', 999999);
	session_start();
		
	// Try to prevent session fixation by ensuring that the session id was created by the website.
	if (!isset($_SESSION['created']))
	{
		session_regenerate_id();
		$_SESSION['created'] = TRUE;
	}
	
	// Try to limit the damage from a compromised session id by saving a hash of the User-Agent: string with another value
	if (!isset($_SESSION['user_agent']))
	{
		// Create a hash user agent and a string to store in session data and user cookies
		$_SESSION['user_agent'] = md5($_SERVER['HTTP_USER_AGENT'] . USER_AGENT_SALT);
		setcookie('ag', $_SESSION['user_agent'], 0);
	}
	else
	{
		// Verify the user agent matches the session data and cookies.
		if ($_SESSION['user_agent'] != md5($_SERVER['HTTP_USER_AGENT'] . USER_AGENT_SALT)
				or (isset($_COOKIE['ag']) and $_COOKIE['ag'] != $_SESSION['user_agent']))
		{
			// Possible Security Violation. Tell the user what happened and refuse to continue.
			throw new SessionCompromisedException();
		}
	}
}
*/
?>