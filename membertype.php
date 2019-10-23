<?php  //memeberType.php
require_once 'header.php';

echo <<<_END

<html>
    <body>
        <div class='center'>Which type of member are you?<br><br>
        <div class='center'>
            <a data-role='button' data-inline='true' data-icon='plus'
              data-transition="slide" href='signup.php'>Matchee</a><br>
            <a data-role='button' data-inline='true' data-icon='check'
              data-transition="slide" href='underconstruction.php'>Matcher</a>
        </div>
    </body>
</html>
_END;

?>