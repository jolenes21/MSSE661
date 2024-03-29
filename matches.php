<?php // matches.php
require_once 'header.php';

    if (!$loggedin) die("</div></body></html>");

    if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
    else                      $view = $username;

    if ($view == $username)
    {
        $name1 = $name2 = "Your";
        $name3 =          "You are";
    }
    else
    {
        $name1 = "<a data-transition='slide' href='members.php?view=$view'>$view</a>'s";
        $name2 = "$view's";
        $name3 = "$view is";
    }

// Uncomment this line if you wish the user�s profile to show here
// showProfile($view);

$followers = array();
$following = array();

$result = queryMysql("SELECT * FROM matches WHERE baseMemberID=(SELECT memberID FROM members WHERE username ='$view')");
$num    = $result->num_rows;

    for ($j = 0 ; $j < $num ; ++$j)
    {
        $row           = $result->fetch_array(MYSQLI_ASSOC);
        $followers[$j] = $row['matchMemberID'];
    }

$result = queryMysql("SELECT * FROM matches WHERE matchMemberID=(SELECT memberID FROM members WHERE username='$view')");
$num    = $result->num_rows;

    for ($j = 0 ; $j < $num ; ++$j)
    {
        $row           = $result->fetch_array(MYSQLI_ASSOC);
        $following[$j] = $row['baseMemberID'];
    }

$mutual    = array_intersect($followers, $following);
$followers = array_diff($followers/*, $mutual*/);
$following = array_diff($following/*, $mutual*/);
$matches   = FALSE;

echo "<br>";

    if (sizeof($mutual))
    {
        echo "<span class='subhead'>$name2 matches</span><ul>";
        foreach($mutual as $match)
        echo "<li><a data-transition='slide' href='members.php?view=$match'>$match</a>";
        echo "</ul>";
      $matches = TRUE;
    }

if (sizeof($followers))
{
    echo "<span class='subhead'>$name2 followers</span><ul>";
    foreach($followers as $friend)
    echo "<li><a data-transition='slide' href='members.php?view=$match'>$match</a>";
    echo "</ul>";
    $matches = TRUE;
}

if (sizeof($following))
{
    echo "<span class='subhead'>$name3 maybes</span><ul>";
    foreach($following as $match)
    echo "<li><a data-transition='slide' href='members.php?view=$match'>$match</a>";
    echo "</ul>";
    $matches = TRUE;
}

if (!$matches) echo "<br>You don't have any matches yet.";
?>
    </div><br>
  </body>
</html>
