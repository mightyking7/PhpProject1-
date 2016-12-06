<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->


<html><head>
        <title> Bob's Auto parts -order results</title>
    </head> 
    <body>
        <h1> Bob's Auto Parts</h1>
        <h2> order results </h2>
        <?php 
        // create short variable names
        $tireqty= $_POST['tireqty'];
        $oilqty= $_POST['oilqty'];
        $sparkqty= $_POST['sparkqty'];
        $address= $_POST['address'];
        $DOCUMENT_ROOT=$_SERVER['DOCUMENT_ROOT'];
        $date= date('H:i, jS F Y');
        ?>
        <?php
        echo '<p> Order processed at '; 
        echo date('H:i, jS F Y');
        echo '</p>';
        echo '<p> Your order is as follows : </p>';
        echo $tireqty. ' tires <br/>';
        echo $oilqty. ' bottles of oil <br/>';
        echo $sparkqty. ' spark plugs <br/>';
         $totalqty;
    $totalqty= $tireqty+ $oilqty + $sparkqty;
    echo "Items ordered: ". $totalqty."<br/>";
    $totalamount;
    define('TIREPRICE', 100);
    define("OILPRICE", 10);
    define("SPARKPRICE", 4);
    $totalamount= $tireqty* TIREPRICE+ $oilqty*OILPRICE+ $sparkqty*SPARKPRICE;
    number_format($totalamount, 2 ,".", ",");
            echo "Subtotal: $". $totalamount."<br/>";
            $taxrate=.10;// local sale tax is 10%
            $totalamount*=(1+$taxrate);
            echo "Total including tax: $" .  number_format($totalamount,2,'.',',')."<br/>";
            
            $outputstring= $date."\t".$tireqty." tires \t".$oilqty." oil\t"
					.$sparkqty." spark plugs\t".$totalamount
					."\t". $address."\r\n";
            //open the file for appeding
             $fp= fopen('C:\Users\might\Documents\orders.txt','ab');
            flock($fp, LOCK_EX);
            if(!$fp)
                {
                print "<p> <strong> Your order couldn't be processed at this time."
                ."\n please try again later".'</strong></p>';
                exit;
            }
            fwrite($fp, $outputstring, strlen($outputstring));
            flock($fp,LOCK_UN);
            fclose($fp);
            echo "<p> Thank you for your business!</p>";  
        ?>
        
       
         
    </body>
</html>