<?php
require_once('../app/Mage.php');
Mage::app('admin'); 
$customer = Mage::getModel("customer/customer");
  $website_id = 1;
  $customer->setWebsiteId($website_id);
  $customer->loadByEmail('faroque.golam@gmail.com');
  
  // if customer does not already exists, by email
  if($customer->getId()) {
		$address = Mage::getModel("customer/address");
		$address->setCustomerId($customer->getId())
			->setFirstname($customer->getFirstname())
			->setMiddleName($customer->getMiddlename())
			->setLastname($customer->getLastname())
			->setCountryId('FI')
			->setPostcode('33400')
			->setCity('Osijek')
			->setTelephone('505558457')
			->setFax('')
			->setCompany('Inchoo')
			->setStreet('Teivaalantie 7')
			->setIsDefaultBilling('1')
			->setIsDefaultShipping('1')
			->setSaveInAddressBook('1');
			
		try{
		$address->save();
		}
		catch (Exception $e) {
			Zend_Debug::dump($e->getMessage());
		}
  
  } else {
  }
?>