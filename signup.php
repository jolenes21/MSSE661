<?php // signup.php
  require_once 'header.php';

echo <<<_END
  <script>
    function checkUser(username)
    {
      if (username.value == '')
      {
        $('#used').html('&nbsp;')
        return
      }

      $.post
      (
        'checkuser.php',
        { username : username.value },
        function(data)
        {
          $('#used').html(data)
        }
      )
    }
  </script>
  <script>
    $(document).ready(function(){
      $("#loginForm").submit(function(){
        var password = $("#password").val();
        if(password.value.length >= 8)
        {
            $("error").text("");
            return true;
        }
        else
        {
            $("error").text("Password does not contain 8 characters");
            return false;
        }
    });
   });
  </script>
  
_END;

$error = $username = $password = $firstName = $lastName = $birthday = $gender = $genderInterest = "";

    if (isset($_SESSION['username'])) destroySession();

    if (isset($_POST['submit']))
    {
        $username = sanitizeString($_POST['username']);
        $password = sanitizeString($_POST['password']);
        $firstName = sanitizeString($_POST['firstName']);
        $lastName = sanitizeString($_POST['lastName']);
        $birthday = sanitizeString($_POST['birthday']);
        $gender = sanitizeString($_POST['gender']);
        $genderInterest = sanitizeString($_POST['genderInterest']);

        if (($username == "") || ($password == "") || ($firstName == "") || ($lastName == "") || ($birthday == "") || ($gender == "") || ($genderInterest == ""))
            $error = 'Not all fields were entered<br><br>';
        else
            {
                $result = queryMysql("SELECT * FROM members WHERE username='$username'");

                if ($result->num_rows)
                $error = 'That username already exists<br><br>';
                else
                {
                    $result = queryMysql("INSERT INTO members (username, password, firstName, lastName, birthday, memberTypeID, memberGenderID, memberGenderInterestID, active) VALUES ('$username', '$password', '$firstName','$lastName', '$birthday', 1, '$gender', '$genderInterest', 1)");
                        die("<h4>Account created</h4>Please Log in.</div></body></html>");

                    if ($result->num_rows)
                        $error = 'Unable to create user. Please try again.';
                }
        }
    }

echo <<<_END
      <form method='post' action='signup.php' id='loginForm'>$error
      <div data-role='fieldcontain'>
        <label></label>
        Please enter your details to sign up
      </div>
      <div data-role='fieldcontain'>
        <label>Username</label>
        <input type='text' maxlength='16' name='username' value='$username'
          onBlur='checkUser(this)'>
      </div>
      <!--<div data-role='fieldcontain'>
        <label>Password</label>
        <input type='text' maxlength='16' name='password' value='$password'>
      </div>-->
        <table>
            <tr>
                <td>Password</td>
                <td><input type="password" id="password" value="$password" required></td>
                <td><span id="error" style="color:red;"></span></td>
            </tr>
        </table>
      <div data-role='fieldcontain'>
        <label>First Name</label>
        <input type='text' maxlength='16' name='firstName' value='$firstName'>
      </div>
      <div data-role='fieldcontain'>
        <label>Last Name</label>
        <input type='text' maxlength='16' name='lastName' value='$lastName'>
      </div>
      <div data-role='fieldcontain'>
        <label>Birthday</label>
        <input type='date' name='birthday' value='$birthday'/>
      </div>
        <div data-role='fieldcontain'>
        <label>Gender</label>
        <select name='gender'>
           <option value="">Select</option>
           <option value="1">Male</option>
           <option value="2">Female</option>
           <option value="3">Non-binary</option>
        </select>
        <div data-role='fieldcontain'>
        <label>Gender Interested In</label>
        <select name='genderInterest'/>
        <option value="">Select</option>
        <option value='1'>Male</option>
        <option value='2'>Female</option>
        <option value='3'>Non-binary</option>
        </select>
      <div data-role='fieldcontain'>
        <label></label>
        <input data-transition='slide' type='submit' name='submit' value='Sign Up'>
      </div>
    </div>
  </body>
</html>
_END;
?>
