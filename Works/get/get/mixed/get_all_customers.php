<?php
require_once '../app/Mage.php';
/*
$websiteId = Mage::app()->getWebsite()->getId();
$store = Mage::app()->getStore();
 
$customer = Mage::getModel("customer/customer");
$customer   ->setWebsiteId($websiteId)
            ->setStore($store)
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setEmail('hello@ex.com')
            ->setPassword('976d000663ecd9f5a817c456899f9168:VLnn49Aea3QXzbTQTTyPGfM6C1tLqk0E');
 
try{
    $customer->save();
}
catch (Exception $e) {
    Zend_Debug::dump($e->getMessage());
}

	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	
*/	
$websiteId = Mage::app()->getWebsite()->getId();
$store = Mage::app()->getStore();
 
$customer = Mage::getModel("customer/customer");
//$customer->setWebsiteId($websiteId)->setStore($store)->setFirstname('John')->setLastname('Doe')->setEmail('hello@ex.com')->setHash_passoword('976d000663ecd9f5a817c456899f9168:VLnn49Aea3QXzbTQTTyPGfM6C1tLqk0E');
$newCustomer = array(
                'email' => 'Amail_address@gmail.com',
                'password_hash' => '976d000663ecd9f5a817c456899f9168:VLnn49Aea3QXzbTQTTyPGfM6C1tLqk0E',
                'store_id' => 1,
                'website_id' => 1,
                'company' => '',
                'firstname' => 'Customer first name',
                'lastname' => 'Customer surname',
                'taxvat' => '',
            );
			
try{
	$customer = Mage::getModel('customer/customer');
    $customer->setData($newCustomer);
    $customer->save();
}
catch (Exception $e) {
    Zend_Debug::dump($e->getMessage());
}
exit();
	
Mage::app('admin'); 
$collection = mage::getModel('customer/customer')->getCollection();

foreach($collection as $k=>$v){
	$web = 'base';
	$store = 'default';
	$customer_id = $v->getId();
	$customerData = Mage::getModel('customer/customer')->load($v->getId())->getData();
	$object = (object) $customerData;
	$object = (object) $customerData;
	$email = $v->getEmail();
	
	if($email == 'paumaija@gmail.com' ):
	$email;
	//echo '<br>';
	$firstname = $object->firstname;
	//echo '<br>';
	$lastname = $object->lastname;
	//echo '<br>';
	$disable_auto_group_change = $object->disable_auto_group_change;
	//echo '<br>';
	$created_at = $object->created_at;
	//echo '<br>';
	$password = $object->password_hash;
	//echo '<br>';
	
	
	
	$customer = Mage::getModel('customer/customer')->load($customer_id); // insert customer ID
	$defaultBilling  = $customer->getPrimaryBillingAddress();
	$defaultShipping = $customer->getDefaultShippingAddress();
	
	foreach ($defaultBilling as $pba)
	{
		echo '<pre>';
		print_r($pba->getdata());
		echo '</pre>';
	}
	
	
	
	foreach ($customer->getAddresses() as $address)
	{
		$data = $address->toArray();
		echo '<pre>';
		print_r($data);
		echo '</pre>';
		
		$addressId = $address['entity_id'];
		$city = $address['city'];
		//echo '<br>';
		$postcode = $address['postcode'];
		//echo '<br>';
		 $country_id = $address['country_id'];
		//echo '<br>';
		 $city = $address['firstname'];
		//echo '<br>';
		$city = $address['lastname'];
		
		$address = Mage::getModel('customer/address')->load($addressId);
		$customer = $address->getCustomer();
		$defaultBilling = $customer->getDefaultBillingAddress();
		$defaultShipping = $customer->getDefaultShippingAddress();
		if ($defaultBilling) {
			if ($defaultBilling->getId() == $addressId) {
				echo 'is default billing '.$city.'<br>';
			} else {
				echo 'is not default billing '.$city.'<br>';
			}
		} else {
			//is not default billing
		}
		
		if ($defaultShipping) {
			if ($defaultShipping->getId() == $addressId) {
				echo 'is default Shipping '.$city.'<br>';
			} else {
				echo 'is not default Shipping '.$city.'<br>';
			}
		} else {
			//is not default billing
		}
	}
	
	$subscriberModel = Mage::getModel('newsletter/subscriber')->loadByEmail($email);
	$subbed = $subscriberModel->isSubscribed();
	//echo $subbed;
	
 




	exit();
	
	
/*
		$insert_data = "INSERT INTO () ";
		$sql = "INSERT INTO myDB (firstname, lastname, email)
	VALUES ('John', 'Doe', 'john@example.com')";

	if ($conn->query($sql) === TRUE) {
		echo "New record created successfully";
	} else {
		echo "Error: " . $sql . "<br>" . $conn->error;
	}
	
echo '<pre>';
print_r($collection);
echo '</pre>';
*/

endif;
}

$conn->close();


		   
		   
