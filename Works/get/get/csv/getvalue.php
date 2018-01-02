<?PHP

$csv = array();
// prepare a file called customers.csv with email, firstname, lastname
if( ($handle = fopen('test.csv', "r")) !== FALSE) {
   $rowCounter = 0;
   while (($rowData = fgetcsv($handle, 0, ",")) !== FALSE) {
       if( 0 === $rowCounter) {
           $headerRecord = $rowData;
       } else {
           foreach( $rowData as $key => $value) {
               $csv[ $rowCounter - 1][ $headerRecord[ $key] ] = $value;  
           }
       }
       $rowCounter++;
   }
   fclose($handle);
}
$x = 0;

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	//$conn = new mysqli($servername, $username, $password, $dbname);
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}

$i = 1;
foreach ($csv as $customer) {
	$email = $customer['email'];
	if($customer['email']){
		$email_last = $customer['email'];
	}
	
	$firstname = $customer['firstname'];
	$gender = $customer['gender'];
	$lastname = $customer['lastname'];
	$password = $customer['password_hash'];
	
	$address_city = $customer['_address_city'];
	$address_country_code = $customer['_address_country_id'];
	$address_firstname = $customer['_address_firstname'];
	$address_lastname = $customer['_address_lastname'];
	$address_postalcode = $customer['_address_postcode'];
	$address_street = $customer['_address_street'];
	$address_telephone = $customer['_address_telephone'];
	$address_default_belling = $customer['_address_default_billing_'];
	$address_default_shipping = $customer['_address_default_shipping_'];
	echo $i++;
	
	if($email == ''){
		//echo $i;
		//echo $email_last;
		/*
		echo $customer['_address_city'];
		exit();
		$sql = "SELECT * FROM customers ORDER BY `id` DESC LIMIT 1";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				
				$address_city = $customer['_address_city'];
				$address_country_code = $customer['_address_country_id'];
				$address_firstname = $customer['_address_firstname'];
				$address_lastname = $customer['_address_lastname'];
				$address_postalcode = $customer['_address_postcode'];
				$address_street = $customer['_address_street'];
				$address_telephone = $customer['_address_telephone'];
				$address_default_belling = $customer['_address_default_billing_'];
				$address_default_shipping = $customer['_address_default_shipping_'];
			}
		}
		*/
		$email = $email_last;
		
	}else{
		//echo $i++;
		//echo $email;
		$sql = "INSERT INTO customers (email, firstname, gender,lastname,password)VALUES ('$email', '$firstname', '$gender','$lastname','$password')";
		if ($conn->query($sql) === TRUE) {
		//echo "New record created successfully";
		} else {
			//echo "Error: " . $sql . "<br>" . $conn->error;
		}
}
	
	
	$sql1 = "INSERT INTO customers_address (email,address_city,address_country_code,address_firstname,address_lastname,address_postalcode,address_street,address_telephone,address_default_belling,address_default_shipping)VALUES ('$email', '$address_city', '$address_country_code','$address_firstname','$address_lastname','$address_postalcode','$address_street','$address_telephone','$address_default_belling','$address_default_shipping')";
	if ($conn->query($sql1) === TRUE) {
		//echo "New record created successfully";
	}
	


	
	
	/*
	$x++;
	if($x>10){
		break;
	}
	*/
}
$conn->close();
?>