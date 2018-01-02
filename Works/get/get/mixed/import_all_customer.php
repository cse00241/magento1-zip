<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM customers where flg=0 limit 0,1000";
$result = mysqli_query($conn, $sql);
//echo mysqli_num_rows($result);
require_once('../../app/Mage.php');
Mage::app('admin'); 
$customer = Mage::getModel("customer/customer");
  $website_id = 1;
  $customer->setWebsiteId($website_id);
  
if (mysqli_num_rows($result) > 0) {
	// output data of each row
	$i = 0;
	while($row = mysqli_fetch_assoc($result)) {
		$i++;
		$id = $row['id'];
		$email = $row['email'];
		$firstname = $row['firstname'];
		$gender = $row['gender'];
		$lastname = $row['lastname'];
		$password = $row['password'];
		$customer->loadByEmail($email);
	  // if customer does not already exists, by email
	  if(!$customer->getId()) {
			echo $i.' Done!!<br>';
			$websiteId = Mage::app()->getWebsite()->getId();
			$store = Mage::app()->getStore();
			$newCustomer = array(
							'email' => $email,
							'password_hash' => $password,
							'store_id' => 1,
							'website_id' => 1,
							'company' => '',
							'firstname' => $firstname,
							'lastname' => $lastname,
							'taxvat' => '',
						);
			  try {
				$customer = Mage::getModel('customer/customer');
				$customer->setData($newCustomer);
				$customer->save();
				$sql = "UPDATE customers SET flg=1 WHERE id='$id'";
				if ($conn->query($sql) === TRUE) {}
				  
			  } catch (Exception $e) {
				  $sql = "UPDATE customers SET flg=2 WHERE id='$id'";
				  if ($conn->query($sql) === TRUE) {} 
				  //echo $e->getMessage();
			  }
	  } else {

	  }
		
		
	}

}




?>