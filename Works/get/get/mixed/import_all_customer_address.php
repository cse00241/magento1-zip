<?php
require_once('../../app/Mage.php');
Mage::app('admin'); 
$customer = Mage::getModel("customer/customer");
  $website_id = 1;
  $customer->setWebsiteId($website_id);
  $customer->loadByEmail('test@gmail.com');
  
  // if customer does not already exists, by email
  if(!$customer->getId()) {
		echo 'no repeat';
  
  } else {
	echo 'repeat';
	$address = Mage::getModel("customer/address");
	$address->setCustomerId($customer->getId())
			->setFirstname($customer->getFirstname())
			->setMiddleName($customer->getMiddlename())
			->setLastname($customer->getLastname())
			->setCountryId('HR')
			//->setRegionId('1') //state/province, only needed if the country is USA
			->setPostcode('31000')
			->setCity('Osijek')
			->setTelephone('0038511223344')
			->setFax('0038511223355')
			->setCompany('Inchoo')
			->setStreet('Kersov')
			->setIsDefaultBilling('1')
			->setIsDefaultShipping('1')
			->setSaveInAddressBook('1');
	try{
		$address->save();
	}
	catch (Exception $e) {
		Zend_Debug::dump($e->getMessage());
	}
	  exit();
  }
$websiteId = Mage::app()->getWebsite()->getId();
$store = Mage::app()->getStore();
$newCustomer = array(
                'email' => 'test@gmail.com',
                'password_hash' => '976d000663ecd9f5a817c456899f9168:VLnn49Aea3QXzbTQTTyPGfM6C1tLqk0E',
                'store_id' => 1,
                'website_id' => 1,
                'company' => '',
                'firstname' => 'Customer first name',
                'lastname' => 'Customer surname',
                'taxvat' => '',
            );
  try {
    $customer = Mage::getModel('customer/customer');
    $customer->setData($newCustomer);
    $customer->save();

      
  } catch (Exception $e) {
      echo $e->getMessage();
  }

?>