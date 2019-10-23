<!DOCTYPE html>
<html>
  <head>
    <title>Adding test users</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php //testuser.php
    require_once 'functions.php';

    addUser('members','1','"emma"','"test"','"Emma"','"Smith"','"1970-12-18"','1','2','1','1');

    addUser('members','2','"ava"','"test"','"Ava"','"Johnson"','"1990-05-25"','1','2','1','1');

    addUser('members','3','"olivia"','"test"','"Olivia"','"Williams"','"1972-01-13"','1','2','1','1');

    addUser('members','4','"isabella"','"test"','"Isabella"','"Jones"','"1990-02-08"','1','2','1','1');

    addUser('members','5','"amelia"','"test"','"Amelia"','"Brown"','"1972-01-24"','1','2','1','1');

    addUser('members','6','"liam"','"test"','"Liam"','"Davis"','"1989-03-05"','1','1','2','1');

    addUser('members','7','"noah"','"test"','"Noah"','"Miller"','"1972-02-26"','1','1','2','1');

    addUser('members','8','"logan"','"test"','"Logan"','"Wilson"','"1988-01-11"','1','1','2','1');

    addUser('members','9','"james"','"test"','"James"','"Moore"','"1972-11-16"','1','1','2','1');

    addUser('members','10','"elijah"','"test"','"Elijah"','"Taylor"','"1986-08-25"','1','1','2','1');

    addUser('members','11','"alex"','"test"','"Alex"','"Anderson"','"1972-11-20"','1','3','3','1');

    addUser('members','12','"cameron"','"test"','"Cameron"','"Thomas"','"1979-06-25"','1','3','3','1');

    addUser('members','13','"devon"','"test"','"Devon"','"Jackson"','"1973-09-07"','1','3','3','1');

    addUser('members','14','"parker"','"test"','"Parker"','"White"','"1976-01-12"','1','3','3','1');

    addUser('members','15','"riley"','"test"','"Riley"','"Harris"','"1974-05-09"','1','3','3','1');

?>

        <br>...done.
  </body>
</html>
