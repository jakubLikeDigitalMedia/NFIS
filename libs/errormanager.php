<?php
//=-----------------------------------------------------------=
// errormanager.php
//=-----------------------------------------------------------=
// Author: Richard Mogendorff 19-Oct-2013
//
// This file contains the errors that we will use in this web
// application.  Most notably, it replaces the default
// error and exception handlers, replacing them with new
// versions that redirect the user to a more friendly error
// page (you must ensure that error.php exists!!)
//
// We also define a number of new exceptions in this file that
// we will use to let us provide robust error handling in this
// web application.
//=-----------------------------------------------------------=

//NB - LOGFILE_PATH is now defined in config.php

//=-----------------------------------------------------------=
// app_error_handler
//=-----------------------------------------------------------=
// This function performs the default error handling for
// unhandled PHP errors such as E_ERROR, E_WARNING, E_NOTICE,
// etc.  We will direct to the error.php file as much as
// possible.
//
// Parameters:
//    $in_errno         - error number
//    $in_errstr        - text of message
//    $in_errfile       - script filename that generated msg
//    $in_errline       - line number in script of error
//    $in_errcontext    - may or may not contain the symbol
//                        table as it was at the time of the
//                        error.
//=-----------------------------------------------------------=
/*
function app_error_handler
(
  $in_errno,
  $in_errstr,
  $in_errfile,
  $in_errline,
  $in_errcontext
)
{

  // If we already have an error, then do no more.
  if (isset($_SESSION)
      and (isset($_SESSION['errstr'])
           or isset($_session['exception'])))
  {
    return;
  }
  
	
	if($in_errstr != "Undefined index: HTTP_USER_AGENT")
	{

	  // first, we will log the error so we know about it.
	  error_log(date('c')
				. " Unhandled Error ($in_errfile, $in_errline): "
				. "$in_errno, '$in_errstr'\r\n", 3, LOGFILE_PATH);
	
		//Now email the error to the webmaster
		// In case any of our lines are larger than 70 characters, we should use wordwrap()

		$message = wordwrap(date('c') . " Unhandled Error ($in_errfile, $in_errline): " . "$in_errno, '...$in_errstr...'\r\n", 70);
	
		// Send
		mail(WEBMASTER_EMAIL, 'Error from ' . PROJECT_NAME . ' site', $message);
	}

  // if we have session information, send the user to more
  // helpful pastures.
  if (isset($_SESSION))
  {
    $_SESSION['errstr'] = "$in_errstr ($in_errfile, line $in_errline)";
  }
  header('Location: ./error.php?err=' . $in_errno);
}

//=-----------------------------------------------------------=
// app_exception_handler
//=-----------------------------------------------------------=
// This is our default exception handler, which we will use to
// report the contents of uncaught exceptions.  our web
// application will throw exceptions when it encounters fatal
// errors from which it cannot recover.  we will write log
// information about the error and attempt to send the user to
// a more helpful page where we can give them less scary
// messages ...
//
// Parameters:
//    $in_exception         - the exception that was thrown.

function app_exception_handler($in_exception)
{

  //If we already have an error, then do no more.
  if (isset($_SESSION)
      and (isset($_SESSION['errstr'])
           or isset($_session['exception'])))
  {
    return;
  }

  //first, log the exception
  $class = get_class($in_exception);
  $file = $in_exception->getFile();
  $line = $in_exception->getLine();
  $msg = $in_exception->getMessage();

  error_log(date('c')
            . " Unhandled Exception: $class ($file, $line): "
            . "$msg\r\n", 3, LOGFILE_PATH);

		$message = wordwrap(date('c') . " Unhandled Error ($file, $line): " . "$class, '...$msg...'\r\n", 70);

		// Send
		mail(WEBMASTER_EMAIL, 'Error from ' . PROJECT_NAME . ' site', $message);

  //Now try to send the user to a better error page.
  if (isset($_SESSION))
  {
    $_SESSION['exception'] = $in_exception;
  }
  header('Location: ./error.php?err=exc');
}

// install these two new functions that we have written.
set_error_handler('app_error_handler');
set_exception_handler('app_exception_handler');
*/


//=-----------------------------------------------------------=
//=-----------------------------------------------------------=
//=-----------------------------------------------------------=
// These are the exceptions that we have defined
// ourselves for use in this application.
//=-----------------------------------------------------------=
//=-----------------------------------------------------------=
//=-----------------------------------------------------------=

class MyInvalidArgumentException extends Exception
{
  function __construct($in_argname)
  {
    parent::__construct("We're sorry, but an internal programming error has occurred in the web application.  The system administrators have been notified of the error and we kindly request that you try again in a little while. (param: $in_argname)");
  }
}

class SessionCompromisedException extends Exception
{
  function __construct()
  {
    parent::__construct('We\'re sorry, but there is a good chance that your connection to this site has been compromised.  Please ensure that you have applied the latest security fixes to your web browser, clear your browser cache entirely, and try again.');
  }
}

class DatabaseErrorException extends Exception
{
  function __construct($in_errmsg, $query = NULL)
  {
    parent::__construct("We're sorry, but an internal database error has occurred. Our system administrators have been notified and we kindly request that you try again in a little while.  Thank you for your patience. ($in_errmsg) \n SQL query $query");
  }
}

class NoSessionException extends Exception
{
  function __construct()
  {
    parent::__construct('We are sorry, but your browser appears to not have cookies enabled.  This site requires a temporary session cookie to help manage your wish list.  Please confirm under Tools/Options that you permit at least session cookies or use a more modern web browser.');
  }
}

class InternalErrorException extends Exception
{
  function __construct($in_msg)
  {
    parent::__construct("An internal error in the web application has occurred.  The site administrators have been notified and we kindly ask you to try back again in a bit.  (Message: '$in_msg')");
  }
}

class FacebookException extends Exception
{
  function __construct($in_msg)
  {
    parent::__construct("An internal error in from Facebook has occurred.  The site administrators have been notified and we kindly ask you to try back again in a bit.  (Message: '$in_msg')");
  }
}


class NoTemplateException extends Exception
{
    function __construct($templatePath)
    {
        parent::__construct("Can't load template at path: $templatePath.");
    }
}

class DuplicitDBValuesException extends Exception
{
    function __construct($table, $id)
    {
        parent::__construct("Duplicit values on column $id at table $table");
    }
}


?>