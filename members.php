<?php // members.php
  require_once 'header.php';

 /* echo <<<_INIT
<!DOCTYPE html> 
<html>
  <head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:900|Work+Sans:300" rel="stylesheet">
    <link rel='stylesheet' href='styles.css' type='text/css'>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-black.css">
_INIT;*/
  
  if (!$loggedin) die("</div></body></html>");

  if (isset($_GET['view']))
  {
    $view = sanitizeString($_GET['view']);
    
    if ($view == $username) $name = "Your";
    else                $name = "$view's";
    
    echo "<div class='center'<h3>$name Profile</h3></div>";
    showProfile($view);
    echo "<a data-role='button' data-transition='slide'
          href='messages.php?view=$view'>View $name messages</a>";
    die("</div></body></html>");
  }

  if (isset($_GET['add']))
  {
    $add = sanitizeString($_GET['add']);

    $result = queryMysql("SELECT * FROM matches WHERE baseMemberID=(SELECT memberID FROM members WHERE username = '$username') AND matchMemberID=(SELECT memberID FROM members WHERE username = '$add')");
    if (!$result->num_rows)
      queryMysql("INSERT INTO matches (baseMemberID, matchMemberID) VALUES ((SELECT memberID FROM members WHERE username = '$username'),(SELECT memberID FROM members WHERE username = '$add'))");
  }
  elseif (isset($_GET['remove']))
  {
    $remove = sanitizeString($_GET['remove']);
    queryMysql("DELETE FROM matches WHERE baseMemberID=(SELECT memberID FROM members WHERE username = '$username') AND matchMemberID=(SELECT memberID FROM members WHERE username = '$add')");
  }

  $result = queryMysql("SELECT username FROM members ORDER BY username");
  $num    = $result->num_rows;

  echo "<h3>Maybes</h3><ul>";

  for ($j = 0 ; $j < $num ; ++$j)
  {
    $row = $result->fetch_array(MYSQLI_ASSOC);
    if ($row['username'] == $username) continue;
    
    echo "<li><a data-transition='slide' href='members.php?view=" .
      $row['username'] . "'>" . $row['username'] . "</a>";
    $follow = "follow";

    $result1 = queryMysql("SELECT * FROM matches WHERE
      baseMemberID='" . $row['baseMemberID'] . "' AND matchMemberID='$username'");
    $t1      = $result1->num_rows;
    $result1 = queryMysql("SELECT * FROM matches WHERE
      baseMemberID='$username' AND matchMemberID='" . $row['matchMemberID'] . "'");
    $t2      = $result1->num_rows;

    if (($t1 + $t2) > 1) echo " &harr; is a mutual friend";
    elseif ($t1)         echo " &larr; you are following";
    elseif ($t2)       { echo " &rarr; is following you";
                         $follow = "recip"; }
    
    if (!$t1) echo " [<a data-transition='slide'
      href='members.php?add=" . $row['username'] . "'>$follow</a>]";
    else      echo " [<a data-transition='slide'
      href='members.php?remove=" . $row['username'] . "'>drop</a>]";
  }
?>
    </ul></div>
  </body>
</html>
