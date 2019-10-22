<?php // header.php
  session_start();

echo <<<_INIT
<!DOCTYPE html>
<nav>
    <div id="toggle">
      <div class="theme-switch-wrapper">
          <label class="theme-switch" for="checkbox">
              <input type="checkbox" id="checkbox" />
                  <div class="slider round"></div>
          </label>
              <em>Enable Dark Mode<br></em>
      </div>
    </div>
</nav>
  
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'> 
    <link href="https://fonts.googleapis.com/css?family=Montserrat:900|Work+Sans:300" rel="stylesheet">
    <link rel='stylesheet' href='styles.css' type='text/css'>
    <script src='javascript.js'></script>
    <script async src="//jsfiddle.net/vRqcb/11/"></script>


_INIT;

  require_once 'functions.php';

  $userstr = 'Home';

  if (isset($_SESSION['username']))
  {
    $username     = $_SESSION['username'];
    $loggedin = TRUE;
    $userstr  = "Logged in as: $username";
  }
  else $loggedin = FALSE;

echo <<<_MAIN
    <title>Approv.d $userstr</title>
  </head>
  <body class='body'>
    <div data-role='page'>
      <h1>
        <div data-role='header'>
          <div class='center'>
              Approv.d
          </div><br>
        </div>
      </h1>
    <div data-role='content'>
  </body>
_MAIN;

  if ($loggedin)
  {
echo <<<_LOGGEDIN
        <body class='h3'>
            <h3>
                <div class='center'>
                    <ul id='tabs'>
                        <li><a id='home' data-inline='true' data-transition='slide' 
                            href='members.php?view=$username'>Home</a></li>
                        <li><a id='maybes' data-inline='true' data-transition='slide' 
                            href='members.php'>Maybes</a></li>
                        <li><a id='matches' data-inline='true' data-transition='"slide" '
                            href='matches.php'>Matches</a></li>
                        <li><a id='matchers' data-inline='true' data-transition='slide' 
                            href='underconstruction.php'>Matchers</a></li>
                        <li><a id='matchers' data-inline='true' data-transition='slide'
                            href='messages.php'>Messages</a></li>
                        <li><a id='matchers' data-inline='true' data-transition='slide'
                            href='profile.php'>Edit Profile</a></li>
                        <li><a id='matchers' data-inline='true' data-transition='slide'
                            href='logout.php'>Log out</a></li>
                    </ul>
                  </div><br>
                </div>
            </h3>
        </body>
_LOGGEDIN;
  }
  else
  {
echo <<<_GUEST
        <body class='body'>
            <h3>
                <div class='center'>
                  <a data-role='button' data-inline='true' data-icon='plus'
                    data-transition='slide' href='membertype.php'>Sign Up</a>
                  <a data-role='button' data-inline='true' data-icon='check'
                    data-transition='slide' href='login.php'>Log In</a>
                </div>
            </h3>
            <p class='info'>(You must be logged in to use this app)</p>
        </body>
_GUEST;
  }
?>
