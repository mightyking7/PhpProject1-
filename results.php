

<html>
<head>
<title>
Book-O-Rama Search results
</title>
</head>
<body>
    <h1> Book O-Rama Search Results</h1>
    <?php 
    /* How to set up a MySQL connection
1.Check and filter data coming from the user 
2.Set up connection to appropriate DB 
3.Query the DB
4.Retreive the results
5.Present the results back to the User
  */

    //create short variable names
    $searchtype = $_POST['searchtype'];
    $searchterm = trim($_POST['searchterm']);
    
    //first trim whitespaces then check that the user enetered data
    if (!$searchtype|| !$searchterm){
        echo 'You have not eneterd search details';
        //end the program 
        exit;
    }
    
    if(!get_magic_quotes_gpc()){
        $searchtype = addslashes($searchtype);
        $searchterm= addslashes($searchterm);
    }
    // opnen up a database connection
    @ $db= new mysqli('localhost','bookorama', 'bookorama123', 'books');
    
    if(mysqli_connect_errno()){
        echo 'Error: Could not connect to Database. Please try again later';
        exit;
    }
    
     $query = "select * from books where ".$searchtype." like '%".$searchterm."%'";
    $result = $db->query($query);
    
    $num_results = $result->num_rows;
    
    echo "<p>Number of books found:". $num_results. "</p>";
    
    for ($i =0;$i<$num_results; $i++) {
        //process results
        $row = $result -> fetch_assoc();
        //fetch_assoc() takes each row from the result and returns an associative array
        echo'<p><strong>'. ($i+1).".Title:";
        echo htmlspecialchars(stripslashes($row['title']));
        echo "</strong><br/> Author: ";
        echo stripslashes($row['author']);
        echo '<br/> ISBN: ';
        echo stripslashes($row['isbn']);
        echo "<br/> Price: ". stripslashes($row['price']);
        echo'</p>';
    }
    
    $result-> free();
    $db ->close();

    ?>
</body>
</html>