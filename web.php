<?php
$name = $email = $address = $age = $gender =null;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";
 $errors = array();
 $conn = new mysqli($servername, $username, $password, $dbname);

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $address = $_POST["address"];
    $age = $_POST["age"];
    $gender = $_POST["gender"];

// Validation   name
    if (!preg_match("/^[a-zA-z]*$/", $_POST['name'])) {
            
        $errors['name'] = "Only alphabets and whitespace are allowed.";
    }
     //Validation  email
     $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$^";
     if (!preg_match($pattern, $email)) {
         $errors['email'] = "Email is not valid..";
     }
     // Validation  gender
     if (empty($_POST["gender"])) {  
        $errors['gender'] = "Gender is required..";
 }  
     
 if ($age < 10 || $age > 30){
    $errors['age'] = "<p>You must be between 10 and 30 years old to apply for this job</p>";
     
 }

 if(count($errors) === 0){
    // Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  
    $sql = "INSERT INTO stduent (name,address,age,email,gender)
    VALUES ('$name','$address','$age','$email','$gender')";
    
    if ($conn->query($sql) === TRUE) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
      
    
    
}else{
    echo 'Error Data';
}
$conn->close();

}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="">name</label><br>
        <input type="text" name="name" ><br>
        <?php if(isset($errors['name'])){echo "<span class='text-danger'>" .$errors['name']. "</span>"; } ?>
        <label for="">age</label><br>
        <input type="number" name="age" ><br>
        <?php if(isset($errors['age'])){echo "<span class='text-danger'>" .$errors['age']. "</span>"; } ?>
        <label for="">address</label><br>
        <input type="text" name="address"><br>
        <?php if(isset($errors['address'])){echo "<span class='text-danger'>" .$errors['address']. "</span>"; } ?>

        <label for="">email</label><br>
        <input type="text" name="email"><br>
        <?php if(isset($errors['email'])){echo "<span class='text-danger'>" .$errors['email']. "</span>"; } ?>
            <br>
        <label for="">Gender</label><br>
        <input type="radio" name="gender" value="male">Male
         <input type="radio"  name="gender" value="female">Female
           <br>
           <?php if(isset($errors['gender'])){echo "<span class='text-danger'>" .$errors['gender']. "</span>"; } ?>

           <br>
           <button type="submit">Add</button>
    </form>


</body>
</html>