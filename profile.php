<?php // profile.php
  require_once 'header.php';

  if (!$loggedin) die("</div></body></html>");

  echo "<div class='center'><h2>Your Profile</h2></div>";
  
  $result = queryMysql("SELECT * FROM profile WHERE profileMemberID=(SELECT memberID FROM members WHERE username = '$username')");

// Start memberBio
  if (isset($_POST['memberBio']))
  {
    $memberBio = sanitizeString($_POST['memberBio']);
    $memberBio = preg_replace('/\s\s+/', ' ', $memberBio);
  
    if ($result->num_rows)
         queryMysql("UPDATE profile SET memberBio='$memberBio' where profileMemberID=(SELECT memberID FROM members WHERE username = '$username')");
    else queryMysql("INSERT INTO profile (profileMemberID, memberBio) VALUES ((SELECT memberID FROM members WHERE username = '$username'), '$memberBio')");
  }
  else
  {
    if ($result->num_rows)
    {
      $row  = $result->fetch_array(MYSQLI_ASSOC);
      $memberBio = stripslashes($row['memberBio']);
    }
    else $memberBio = "";
  }

  $memberBio = stripslashes(preg_replace('/\s\s+/', ' ', $memberBio));

showProfile($username);
  
// Start memberPhoto
  $currentDir = "/var/www/html/NetBeansProjects/NanositeApprovd";
  $uploadDirectory = "/images/";

  $errors = []; // Store all foreseen and unforseen errors here

  $fileExtensions = ['jpeg','jpg','png']; // Get all the file extensions

    $fileName = $_FILES['memberPhoto']['name'];
    $fileSize = $_FILES['memberPhoto']['size'];
    $fileTmpName  = $_FILES['memberPhoto']['tmp_name'];
    $fileType = $_FILES['memberPhoto']['type'];
    $fileExtension = strtolower(end(explode('.',$fileName)));
    $saveto = "$username".".jpg";

    $uploadPath = $currentDir . $uploadDirectory . basename($saveto);  
    
    if (isset($_POST['submit']))
        {        
    if ($result->num_rows)
            queryMysql("UPDATE profile SET memberPhoto='$memberPhoto' where profileMemberID=(SELECT memberID FROM members WHERE username = '$username')");
       else queryMysql("INSERT INTO profile (profileMemberID, memberPhoto) VALUES ((SELECT memberID FROM members WHERE username = '$username'), '$memberPhoto')");    
    }
    
        if (! in_array($fileExtension,$fileExtensions) && !empty($fileName)) {
            $errors[] = "This file extension is not allowed. Please upload a JPEG or PNG file";
        }

        if ($fileSize > 2000000) {
            $errors[] = "This file is more than 2MB. Sorry, it has to be less than or equal to 2MB";
        }

        if (empty($errors) && !empty($fileName)) {
            $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

            if ($didUpload && !empty($fileName)) {
                echo "The file " . basename($fileName) . " has been uploaded <br>";
            } else {
                echo "An error occurred somewhere. Try again or contact the admin";
            }
        } else {
        foreach ($errors as $error ) {
            echo "Errors: " . "<br>" . $error;
        }
    }


echo "<br>";
  
echo <<<_END
        <form method='post' action='profile.php' enctype='multipart/form-data'>
        <div data-role='fieldcontain'>
        <label>Enter or edit your details and/or upload an image</label><br>
        <textarea rows='5' cols='50' maxlength='500' name='memberBio' value='$memberBio'>$memberBio</textarea><br>
        </div>
        <div id="content">
        Image:
        <input type='file' name='memberPhoto' id='fileToUpload' value='$memberPhoto'>
        </form>
        <!--Image: <input type='file' name='image' size='14'><br>-->
        <div data-role='fieldcontain'>
        <label></label>
        <input data-transition='slide' type='submit' name='submit' value='Save Profile'>
        </div><br>
  </body>
</html
_END;
?>

