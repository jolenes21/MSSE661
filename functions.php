<?php // functions.php
$dbhost  = 'localhost';
$dbname  = 'approvd';
$dbuser  = 'phpuser';
$dbpass  = 'phpuserpw';

$connection = new mysqli($dbhost, $dbuser, $dbpass, $dbname);
    if ($connection->connect_error) die("Fatal Error");

    function createTable($table, $query)
    {
        queryMysql("CREATE TABLE IF NOT EXISTS $table($query)");
        echo "Table '$table' created or already exists.<br>";
    }

    function deleteTable($table)
    {
        queryMysql("DELETE FROM $table");
    }

    function updateTable($table, $ID, $name)
    {
        queryMysql("INSERT INTO $table VALUES ($ID, $name)");
        echo "Table '$table' row $ID has been updated.<br>";
    }

    function addUser($table, $ID, $username, $password, $firstName, $lastName, $birthday, $memberTypeID, $memberGenderID, $memberGenderInterestID, $active)
    {
        queryMysql("INSERT INTO $table VALUES ($ID, $username, $password, $firstName, $lastName, $birthday, $memberTypeID, $memberGenderID, $memberGenderInterestID, $active)");
        echo "User '$username' has been added.<br>";
    }

    function queryMysql($query)
    {
        global $connection;
        $result = $connection->query($query);
        if (!$result) die("Fatal Error");
        return $result;
    }

    function destroySession()
    {
    $_SESSION=array();

        if (session_id() != "" || isset($_COOKIE[session_name()]))
          setcookie(session_name(), '', time()-2592000, '/');

    session_destroy();
    }

    function sanitizeString($var)
    {
    global $connection;
    $var = strip_tags($var);
    $var = htmlentities($var);
        if (get_magic_quotes_gpc())
          $var = stripslashes($var);
        return $connection->real_escape_string($var);
    }

    function showProfile($username)
    {
        if (file_exists("/var/www/html/NetBeansProjects/NanositeApprovd/images/$username.jpg"))
        {
            echo "<div class='center'>
                  <img src='/var/www/html/NetBeansProjects/NanositeApprovd/images/$username.jpg' alt='$username.jpg'>
                  </div><br>";
        }
        else echo "<p>Upload an image!</p><br>";

        $result = queryMysql("SELECT * FROM profile WHERE profileMemberID=(SELECT memberID FROM members WHERE username = '$username')");

        if ($result->num_rows)
        {
            $row = $result->fetch_array(MYSQLI_ASSOC);
            echo stripslashes($row['memberBio']) . "<br style='clear:center;'><br>";
        }
        else echo "<p>Nothing to see here, yet</p><br>";
    }

?>
