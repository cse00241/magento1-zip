<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "myDB";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM customers_address where flg=0 limit 0,2000";
$result = mysqli_query($conn, $sql);

require_once('../../app/Mage.php');
Mage::app('admin'); 
$customer = Mage::getModel("customer/customer")->setWebsiteId(1);
  $website_id = 1;
  //$customer->setWebsiteId($website_id);
  if (mysqli_num_rows($result) > 0) {
	// output data of each row
	$i = 0;
	while($row = mysqli_fetch_assoc($result)) {
	
	$i++;
	$id = $row['id'];
	$email = $row['email'];
	$customer->loadByEmail($email);
	$firstname = $row['firstname'];
	$middlename = $row['firstname'];
	$lastname = $row['lastname'];
	$address_city = $row['address_city'];
	$address_country_code = $row['address_country_code'];
	$address_postalcode = $row['address_postalcode'];
	$address_street = $row['address_street'];
	$address_telephone = $row['address_telephone'];
	$address_default_belling = $row['address_default_belling'];
	$address_default_shipping = $row['address_default_shipping'];
	$customer->loadByEmail($email);
  // if customer does not already exists, by email
  if($customer->getId()) {
		echo $i.' Done<br>';
		$address = Mage::getModel("customer/address");
		$address->setCustomerId($customer->getId())
			->setFirstname($firstname)
			->setMiddleName($middlename)
			->setLastname($lastname)
			->setCountryId($address_country_code)
			//->setRegionId('1') //state/province, only needed if the country is USA
			->setPostcode($address_postalcode)
			->setCity($address_city)
			->setTelephone($address_telephone)
			->setFax('')
			->setCompany('')
			->setStreet($address_street)
			->setIsDefaultBilling($address_default_belling)
			->setIsDefaultShipping($address_default_shipping)
			->setSaveInAddressBook('1');
	try{
		$address->save();
		$sql = "UPDATE customers_address SET flg=1 WHERE id='$id'";
				if ($conn->query($sql) === TRUE) {}
	}
	catch (Exception $e) {
		$sql = "UPDATE customers_address SET flg=2 WHERE id='$id'";
				  if ($conn->query($sql) === TRUE) {} 
		Zend_Debug::dump($e->getMessage());
	}
  } else {

  }
	}
	}


?>