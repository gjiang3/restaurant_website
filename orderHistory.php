<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <title>Order</title>
	<link rel="stylesheet"
          type="text/css"
          href="myRestaurant4.css" />
    <script type="text/javascript"
            src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js">
    </script>
	<script type="text/javascript"
            src="myRestaurant.js">
    </script>
    </style>
</head>

<body>
<div class="loader"></div>
    <img class = "name" src="images/name.png"/>
   <div class="sideBar">
   
  <div class="homeB"><a href='index.html' ><span>HOME</span></a></div >
   <div class="orderB"><a href='order.html'><span>ORDER</span></a></div >
   <div class="menuB"><a href='menu.html'><span>MENU</span></a></div >
   <div class="contactB"><a href=" " onclick="myFunction()"><span>CONTACT</span></a></div > 
   <div class="aboutB"><a href='about.html'><span>ABOUT</span></a></div >
   
   
       <img class = "home" src="images/bg1_menu.png"/>
	   <img class = "order" src="images/bg1_menu.png"/>
       <img class = "menu" src="images/bg1_menu.png"/>
       <img class = "contact" src="images/bg1_menu.png"/>		   
	   <img class = "about" src="images/bg1_menu.png"/>
	</div> 	
    
	 <div class = "bg" ></div>
	<div class = "summary"><h1>Order History</h1></div>
    <div class = "footer"></div>
	<img class = "line" src="images/line.png"/>
    <div class="orderSummary">
	<a href="order.html" class="b1"><img src="images/back-button.png" 
   onmouseover="this.src='images/back-button2.png'"
   onmouseout="this.src='images/back-button.png'"></a>
    <p>
        <?php
		
		    $lastName = filter_input(INPUT_GET, "lastName");
            $firstName = filter_input(INPUT_GET, "firstName");
			$orderNumber = filter_input(INPUT_GET, "orderNumber");
			
			print "<h4>Customer name: $firstName $lastName</h4>";
			print "<h4>Order Number: $orderNumber</h4>";
			
            try{
				$con = new PDO("mysql:host=localhost;dbname=Xloop",
                               "Xloop", "Xloop");
                $con->setAttribute(PDO::ATTR_ERRMODE,
                                   PDO::ERRMODE_EXCEPTION);
	            $query ="SELECT Number, Course, Price, QTY FROM menu, orders, order_course WHERE LastName = :last AND FirstName = :first AND ID = :id AND ID = orderID AND courseID = Number ORDER BY ID";
			    $ps = $con->prepare($query);
                $ps->execute(array(':first' => $firstName, ':last' => $lastName, ':id' => $orderNumber )); 
				$data = $ps->fetchAll(PDO::FETCH_ASSOC);
				
				print "<table width='500'>\n";
				print "            <tr>\n";
                    print "                <th>Number</th>\n";
					print "                <th>Course</th>\n";
					print "                <th>Price</th>\n";
					print "                <th>QTY</th>\n";
				print "            </tr>\n";
				
				foreach ($data as $row) {
                    print "            <tr>\n";
                    foreach ($row as $name => $value) {
                        print "                <td>$value</td>\n";
                    }
                    print "            </tr>\n";
                }
                
                print "        </table>\n";

			}
            catch(PDOException $ex) {
                echo 'ERROR: '.$ex->getMessage();
            }  			
        ?>
    </p>
	</div>
</body>
</html>