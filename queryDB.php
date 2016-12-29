<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Order Summary</title>
	<link rel="stylesheet"
          type="text/css"
          href="myRestaurant4.css" />
    <script type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript"
            src="myRestaurant.js">
    </script>
    
	
   <script>
   function myFunction() {
      window.open("contact.html", "_blank", "toolbar=yes, scrollbars=yes, resizable=yes, top=300, left=500, width=400, height=400");
     }
    </script>

</head>

<body>

<div class="loader"></div>
    <img class = "name" src="images/name.png"/>
   <div class="sideBar">
   
  <div class="homeB"><a href='index.html' ><span>HOME</span></a></div >
   <div class="orderB"><a href='order.html'><span>ORDER</span></a></div >
   <div class="menuB"><a href='menu.html'><span>MENU</span></a></div >
   <div class="contactB"><a href=" " onclick="myFunction()"><span>CONTACT</span></a></div > 
   <div class="aboutB"><a href="about.html"><span>ABOUT</span></a></div >
   
   
       <img class = "home" src="images/bg1_menu.png"/>
	   <img class = "order" src="images/bg1_menu.png"/>
       <img class = "menu" src="images/bg1_menu.png"/>
       <img class = "contact" src="images/bg1_menu.png"/>		   
	   <img class = "about" src="images/bg1_menu.png"/>
	</div> 	

    
    <div class = "bg" ></div>
	<div class = "summary"><h1>Order Summary</h1></div>
    <div class = "footer"></div>
	<img class = "line" src="images/line.png"/>
    <div class="orderSummary">
    <p>
        <?php
            global $total;
            $total = 0;
        
            
            try {
                // Connect to the database.
                $con = new PDO("mysql:host=localhost;dbname=Xloop",
                               "Xloop", "Xloop");
                $con->setAttribute(PDO::ATTR_ERRMODE,
                                   PDO::ERRMODE_EXCEPTION);
                                   
                $first = filter_input(INPUT_GET, "firstName");
                $last  = filter_input(INPUT_GET, "lastName");
				$phoneNumber = filter_input(INPUT_GET, "phoneNumber");
				$sql = "ALTER TABLE orders AUTO_INCREMENT=1";
				$con->exec($sql);
           
				
                $sql = "INSERT INTO orders (FirstName, LastName, Phone) VALUE ('$first','$last','$phoneNumber')";
				
				$con->exec($sql);
				$query =  "SELECT ID FROM orders WHERE FirstName = '$first' AND LastName = '$last' ORDER BY ID DESC";
				$orderNum = $con->query($query);
				$row = $orderNum->fetch(PDO::FETCH_ASSOC);
				$orderNumber = $row['ID'];
				$query =  "SELECT ID FROM orders WHERE FirstName = '$first' AND LastName = '$last' ORDER BY ID DESC";
				$orderNum = $con->query($query);
				$row = $orderNum->fetch(PDO::FETCH_ASSOC);
				$orderNumber = $row['ID'];
				
                if ((strlen($first) > 0) && (strlen($last) > 0) ) {
                    print "<h4>Customer name: $first $last</h4>";
					print "<h4>Phone Number: $phoneNumber</h4>";
					print "<h4>Order Number: $orderNumber</h4>";
                }
				
				 
				$query =  "SELECT ID FROM orders WHERE FirstName = '$first' AND LastName = '$last' ORDER BY ID DESC";
				$orderNum = $con->query($query);
				$row = $orderNum->fetch(PDO::FETCH_ASSOC);
				$orderNumber = $row['ID'];
				
				
                $query = "SELECT * FROM Menu";
                // Construct an HTML table.
                print "<table  width='500'>\n";
                
                // Fetch the database field names.
                $result = $con->query($query);
                $row = $result->fetch(PDO::FETCH_ASSOC);
                
                // Construct the header row of the HTML table.
                print "            <tr>\n";
                foreach ($row as $field => $value) {
                    print "                <th>$field</th>\n";
                }
                print " <th>Qty</th>\n" ;
                print "            </tr>\n";
                
                // Constrain the query
                if(filter_has_var(INPUT_GET, "course1"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 1 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty1");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print " </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 1 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','1','$qty')";
							$con->exec($sql);			
                }

                if(filter_has_var(INPUT_GET, "course2"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 2 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty2");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 2 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','2','$qty')";
							$con->exec($sql);
                }

                 if(filter_has_var(INPUT_GET, "course3"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 3 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty3");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 3 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','3','$qty')";
							$con->exec($sql);
                }
               

            
                 if(filter_has_var(INPUT_GET, "course4"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 4 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty4");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 4 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','4','$qty')";
							$con->exec($sql);
                }
                
                
                 if(filter_has_var(INPUT_GET, "course5"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 5 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty5");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 5 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','5','$qty')";
							$con->exec($sql);
                }
                
                 if(filter_has_var(INPUT_GET, "course6"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 6 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty6");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 6 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','6','$qty')";
							$con->exec($sql);
                }

             
                 if(filter_has_var(INPUT_GET, "course7"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 7 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty7");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 7 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','7','$qty')";
							$con->exec($sql);
                }


                
                 if(filter_has_var(INPUT_GET, "course8"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 8 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty8");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 8 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','8','$qty')";
							$con->exec($sql);
                }
                
                
                 if(filter_has_var(INPUT_GET, "course9"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 9 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty9");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 9 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','9','$qty')";
							$con->exec($sql);
                }
                
                 if(filter_has_var(INPUT_GET, "course10"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 10 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty10");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 10 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','10','$qty')";
							$con->exec($sql);
                }
     
                 if(filter_has_var(INPUT_GET, "course11"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 11 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty11");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 11 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','11','$qty')";
							$con->exec($sql);
                }
                
                 if(filter_has_var(INPUT_GET, "course12"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 12 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty12");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 12 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','12','$qty')";
							$con->exec($sql);
                }
                
                 if(filter_has_var(INPUT_GET, "course13"))
                {
                    global $total;
                    $query = "SELECT * FROM Menu ".
                             "WHERE Number = 13 ";
                             $data = $con->query($query);
                             $data->setFetchMode(PDO::FETCH_ASSOC);
                
                             // Construct the HTML table row by row.
                            foreach ($data as $row) 
                            {
                                print "            <tr>\n";
                    
                                foreach ($row as $name => $value) 
                                {
                                    print "                <td>$value</td>\n";
                                }
                            }
                            
                            $qty  = filter_input(INPUT_GET, "Qty13");
                            if (!(strlen($qty) > 0)) 
                            {
                                    $qty = 0;
                            }                 
                            print "                <td>$qty</td>\n";
                            print "            </tr>\n";
                            $query = "SELECT Price FROM Menu "."WHERE Number = 13 ";
                            $data = $con->query($query);
                            $row = $data->fetch(PDO::FETCH_ASSOC);
                            $price =  $qty * $row['Price'];
                            $total += $price;
							$sql = "INSERT INTO order_course (orderID, courseID, QTY) VALUE ('$orderNumber','13','$qty')";
							$con->exec($sql);
                }


                print "</table>\n";
                
				$tax = $total * 0.0925;
				$total += $tax;
				$tax = sprintf('%0.2f',$tax);
				$total = sprintf('%0.2f',$total);
				print "<br/>Sales Tax: $tax";
                print "<br/>Total Price: $total";
				
            }
            catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }        
        ?>
    </p>
</div>
</body>
</html>