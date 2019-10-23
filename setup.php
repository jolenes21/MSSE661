<!DOCTYPE html>
<html>
  <head>
    <title>Setting up database</title>
  </head>
  <body>

    <h3>Setting up...</h3>

<?php // setup.php
    require_once 'functions.php';

    createTable('memberType', 
                'typeID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                typeName varchar (50)');

    createTable('gender',
                'genderID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                 genderName varchar(50)');
  
    createTable('members',
                'memberID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                username varchar (255),
                password varchar (255),
                firstName varchar (255),
                lastName varchar (255),
                birthday date,
                memberTypeID int,
                memberGenderID int,
                memberGenderInterestID int,
                active bit,
                FOREIGN KEY (memberTypeID) REFERENCES memberType(typeID),
                FOREIGN KEY (memberGenderID) REFERENCES gender(genderID),
                FOREIGN KEY (memberGenderInterestID) REFERENCES gender(genderID)');

    createTable('matches',
                'matchID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                baseMemberID int,
                matchMemberID int,
                FOREIGN KEY (baseMemberID) REFERENCES members(memberID),
                FOREIGN KEY (matchMemberID) REFERENCES members(memberID)');

    createTable('profile',
                'profileID int NOT NULL AUTO_INCREMENT PRIMARY KEY,
                profileMemberID int,
                memberPhoto blob,
                memberBio varchar(500),
                memberAge int,
                FOREIGN KEY (profileMemberID) REFERENCES members(memberID)');
    
    deleteTable('memberType');
    updateTable('memberType','1','"Matchee"');
    updateTable('memberType','2','"Matcher"');
    
    deleteTable('gender');
    updateTable('gender','1','"Male"');
    updateTable('gender','2','"Female"');
    updateTable('gender','3','"Nonbinary"');
    
?>

    <br>...done.
  </body>
</html>
