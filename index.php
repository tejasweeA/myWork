
<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  

<?php

include("studentDatabase.php");

// define variables and set to empty values
$firstnameErr = $lastnameErr = $genderErr =$rnErr = "";
$firstname = $lastname = $gender = $rn = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {


  if (empty($_POST["rollno"])) {
    $rnErr = "roll number is required";
  } else {
    $rn = test_input($_POST["rollno"]);
  }
}

  if (empty($_POST["fname"])) {
    $fnameErr = "Name is required";
  } else {
    $firstname = test_input($_POST["fname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$firstname)) {
      $firstnameErr = "Only letters and white space allowed";
    }
  }


if (empty($_POST["lname"])) {
    $lastnameErr = "Name is required";
  } else {
    $lastname = test_input($_POST["lname"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$lastname)) {
      $lastnameErr = "Only letters and white space allowed";
    }
  }


  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}



$sql = "INSERT INTO studentDetails (rno,firstname, lastname, gender)
VALUES ($rn,$firstname,$lastname,$gender)";
mysqli_query($conn,$sql);


?>

<h2>PHP Form Validation Example</h2>
<p><span class="error">* required field</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Rollno: <input type="text" name="rollno" value="<?php echo $rn;?>">
  <span class="error">* <?php echo $rnErr;?></span>
  <br><br>
  Firstname: <input type="text" name="fname" value="<?php echo $firstname;?>">
  <span class="error">* <?php echo $firstnameErr;?></span>
  <br><br>
  Lastname: <input type="text" name="lname" value="<?php echo $lastname;?>">
  <span class="error"><?php echo $lastnameErr;?></span>
  <br><br>
  Gender:
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="female") echo "checked";?> value="female">Female
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="male") echo "checked";?> value="male">Male
  <input type="radio" name="gender" <?php if (isset($gender) && $gender=="other") echo "checked";?> value="other">Other  
  <span class="error">* <?php echo $genderErr;?></span>
  <br><br>
  <input type="submit" name="submit" value="Submit">  
</form>

<?php
echo "<h2>Your Input:</h2>";
echo $rn;
echo "<br>";
echo $firstname;
echo "<br>";
echo $lastname;
echo "<br>";
echo $gender;
?>

</body>
</html>

