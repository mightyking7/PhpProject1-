<html>
<head>
<title> Book-O-Rama Book Entry Results </title>
</head>
<body>
<h1> Book-O-Rama Book Entry Results </h1>
<?php
//create short variable names 
$isbn = $_POST['isbn'];
$author= $_POST['author'];
$title =$_POST['title'];
$price= $_POST['price'];

//make sure user has entered data

if(!$isbn || !$author || !$title || !$price) {
    echo "you have not enteres all the required details. <br/>"
    . "please go back and try again";

    //end the program
    exit;
}

//just in case magic_qoutes function is turned off 

if(!get_magic_quotes_gpc()){
$isbn =  addslashes($isbn);
$author = addslashes($author);
$title = addslashes($title);
$price= doubleval($price);
}

//establish connection to the database
@ $db = new mysqli('localhost','bookorama','bookorama123','books');

if(mysqli_connect_errno()){
    echo"Error: coud not connect to the database. Please try again later";
    exit;
}

// insert data into the database
$query= "insert into books values 
('".$isbn."', '".$author."', '".$title."', '".$price."')";
$result = $db->query($query);

// verify to the user that the data has been enteres into the database properly 

if ($query){
echo $db->affected_rows."book entered into the database.";
} else {
     echo "An error has occured. The item wasn't added";
}

//close the database connection 
$db->close();
?>

</body>
</html>