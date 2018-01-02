<?php

require_once('../../app/Mage.php');
Mage::app('admin'); 
$customer = Mage::getModel("customer/customer");
  $website_id = 1;
  $customer->setWebsiteId($website_id);
		$email = 'faroque.golam@gmail.com';
		$firstname = 'Golam';
		$gender = '';
		$lastname = 'Faroque';
		$password = '976d000663ecd9f5a817c456899f9168:VLnn49Aea3QXzbTQTTyPGfM6C1tLqk0E';
		$customer->loadByEmail($email);

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
			  } catch (Exception $e) {
				  echo $e->getMessage();
			  }
	  } else {

	  }
		
		
	}

}




?>