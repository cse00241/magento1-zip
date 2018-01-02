<?php
require_once('../../../app/Mage.php');
umask(0);
Mage::app();
$customer = Mage::getModel('customer/customer');
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
foreach ($csv as $customer) {
	
	if($customer['email'] !=''){
		echo $customer['email'].'<br>';
	}else{
		echo $old['email'].'<br>';
	}
	echo $customer->getId();
  exit();
  //$website_id = Mage::app()->getWebsite()->getId();
  $website_id = 1;
  $customer->setWebsiteId($website_id);
  $customer->loadByEmail($customer['email']);
  
  // if customer does not already exists, by email
  if(!$customer->getId()) {
    
      $customer->setEmail($customer['email']);
      $customer->setFirstname($customer['firstname']);
      $customer->setLastname($customer['lastname']);
      
      // generate a new password
      $newPassword = $customer->generatePassword();
      $customer->changePassword($newPassword);
  
  } else {
      // do something here for existing customers
  }
  
  try {
    
      $customer->save();
      $customer->setConfirmation(null);
      $customer->save();
      
      // save successful, send new password
      // uncomment this to send the email to the customer
      // $customer->sendPasswordReminderEmail(); 
      
  } catch (Exception $e) {
      echo $e->getMessage();
  }
}
?>