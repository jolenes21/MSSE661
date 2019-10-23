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
    <link rel='stylesheet' href='//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css'>
    <link href='https://fonts.googleapis.com/css?family=Montserrat:900|Work+Sans:300' rel="stylesheet">
    <link rel='stylesheet' href='styles.css' type='text/css'>
    <script src='//jsfiddle.net/vRqcb/11/'></script>
    <script src='javascript.js'></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="http://code.jquery.com/jquery-1.4.4.min.js"></script>
    <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js'></script>

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
                    <ul id="tabs">
                        <li><a data-role='button' data-inline='true' data-transition='slide' 
                            id="tab1" class="" href='members.php?view=$username'>Home</a></li>
                        <li><a data-role='button' data-inline='true' data-transition='slide' 
                            id="tab2" class="" href='members.php'>Maybes</a></li>
                        <li><a data-role='button' data-inline='true' data-transition='slide' 
                            id="tab3" href='matches.php'>Matches</a></li>
                        <li><a data-role='button' data-inline='true' data-transition='slide' 
                            id="tab4" href='underconstruction.php'>Matchers</a></li>
                        <li><a data-role='button' data-inline='true' data-transition='slide' 
                            id="tab5" href='messages.php'>Messages</a></li>
                        <li><a data-role='button' data-inline='true' data-transition='slide' 
                            id="tab6" href='profile.php'>Edit Profile</a></li>
                        <li><a data-role='button' data-inline='true' data-transition='slide' 
                            id="tab7" href='logout.php'>Log out</a></li>
                    </ul>
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
