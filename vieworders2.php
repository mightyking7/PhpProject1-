
 
<html>
    <head> <title>Bob's Auto parts - Customer Orders</title></head>
    <body><h1> Bob's Auto parts</h1>
        <h2>Customer Orders</h2>
        
       
<?php 

 /* This form is meant to be accessible by Bob's employees in 
        order form them to send orders to customers.
       The underlying data source lies in a flat file
        */

//Read the entire file
//Each order becomes an element in the Array
 $oil_ttl= 0;
 $tires_ttl=0;
 $sparkplugs_ttl=0;
 $price_ttl=0.00;
$orders= file("C:\Users\might\Documents\orders.txt");

//count the number of orders in the array
$number_of_orders=count($orders);

if($number_of_orders==0)
 {
     print "<p><strong> No orders pending at this time, please try again later </strong></p>";
    }
echo "<table border=\"1\" >\n";
echo "<tr> <th bgcolor= \"#CCCCFF\"> Order date</th>
     <th bgcolor= \"#CCCCFF\"> Tires </th>
       <th bgcolor= \"#CCCCFF\"> Oil </th>
         <th bgcolor= \"#CCCCFF\"> Spark's</th>
           <th bgcolor= \"#CCCCFF\"> Total</th>
             <th bgcolor= \"#CCCCFF\"> Address</th>
             </tr>";
function append_front ( $string, $replacment){
    // Create a regular expression that will append character to the front of a string
    $search_patten= "/[^0-9,.]/";
    $string = " "+$string;
    $string= preg_replace($search_patten, $replacment, $string);
}
for($i=0;$i<$number_of_orders; $i++)
{
// split up each line
    
$line= explode("\t", $orders[$i]);

// keep only the number of items ordered in the Table

$line [1]= intval($line[1]);
$line [2]= intval($line[2]);
$line [3]= intval($line[3]);

/*Summate the $price_ttl then append a 
 dollar sign to the front of the number for 
 output to the table.*/

$price_ttl += $line[4];


//output each order

echo "<tr>
    <td>".$line[0]."</td>
        <td align=\"right\">".$line[1]."</td>
              <td align=\"right\">".$line[2]."</td>
                    <td align=\"right\">".$line[3]."</td>
                          <td align=\"right\">".$line[4]."</td>
                                <td align=\"right\">".$line[5]."</td>
                                    </tr>";

}


// exctrat the order description and create a subtotal

   for($i=0; $i<$number_of_orders;$i++)
   {
       $end_line = explode("\t", $orders[$i]);
       $tires_ttl +=intval($end_line[1]);
       $oil_ttl += intval($end_line[2]);
    $sparkplugs_ttl += intval($end_line[3]);
   }
   
   //output the subtotal
   
echo  "<tr><th bgcolor=\"#FFF333\"><strong> Subtotal </strong></th>
    <td align=\"right\" bgcolor=\" #FFF333\">".$tires_ttl."</td>
        <td align=\"right\" bgcolor=\" #FFF333\">".$oil_ttl."</td>
            <td align=\"right\" bgcolor=\" #FFF333\">".$sparkplugs_ttl."</td>";

                //Format $price_ttl to display the dollar ammount in the table
               
              echo"  <td align=\"right\" bgcolor=\" #5BFF33\">".number_format($price_ttl, 2, ".", ",")."</td></tr>";

echo "</table>";
?>
      
    </body>
</html>