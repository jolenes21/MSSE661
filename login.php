<?php // login.php
  require_once 'header.php';
  $error = $username = $password = "";

  if (isset($_POST['username']))
  {
    $username = sanitizeString($_POST['username']);
    $password = sanitizeString($_POST['password']);
    
    if ($username == "" || $password == "")
      $error = 'Not all fields were entered';
    else
    {
      $result = queryMySQL("SELECT username,password FROM members
        WHERE username='$username' AND password='$password'");

      if ($result->num_rows == 0)
      {
        $error = "Invalid login attempt";
      }
      else
      {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        die("<div class='center'>You are now logged in. Please
        <a data-transition='slide' href='members.php?view=$username'>click here</a>
        to continue.</div></div></body></html>");
      }
    }
  }

echo <<<_END
      <form method='post' action='login.php'>
        <div data-role='fieldcontain'>
          <label></label>
          <span class='error'>$error</span>
        </div>
        <div data-role='fieldcontain'>
          <label></label>
          Please enter your details to log in
        </div>
        <div data-role='fieldcontain'>
          <label>Username</label>
          <input type='text' maxlength='16' name='username' value='$username'>
        </div>
        <div data-role='fieldcontain'>
          <label>Password</label>
          <input type='password' maxlength='16' name='password' value='$password'>
        </div>
        <div data-role='fieldcontain'>
          <label></label>
          <input data-transition='slide' type='submit' value='Login'>
        </div>
      </form>
    </div>
  </body>
</html>
_END;
?>
