<?php
 if(php_sapi_name()!=="cli"){
 echo "Must be run from the commend line.";
 };
/**
 * Setup a magento instance so we can run this export from the command line.
 */
require_once('../app/Mage.php');
Mage::app('admin');
umask(0);
if (!Mage::isInstalled()) {
    echo "Application is not installed yet, please complete install wizard first.";
    exit;
}
// Only for urls // Don't remove this
$_SERVER['SCRIPT_NAME'] = str_replace(basename(__FILE__), 'index.php', $_SERVER['SCRIPT_NAME']);
$_SERVER['SCRIPT_FILENAME'] = str_replace(basename(__FILE__), 'index.php', $_SERVER['SCRIPT_FILENAME']);
Mage::app('admin')->setUseSessionInUrl(false);
Mage::setIsDeveloperMode(true); ini_set('display_errors', 1); error_reporting(E_ALL);
try {
    Mage::getConfig()->init();
    Mage::app();   
} catch (Exception $e) {
    Mage::printException($e);
}
ini_set('memory_limit','500M');
$customerCount = 0;
try{
    //configure the collection filters.
    $collection = Mage::getResourceModel('customer/customer_collection')
    ->addAttributeToSelect('entity_id')
    ->addAttributeToSelect('group_id')
    ->addAttributeToSelect('firstname')
    ->addAttributeToSelect('middlename')
    ->addAttributeToSelect('lastname')
    ->addAttributeToSelect('email')
    ->addAttributeToSelect('created_at')
    ->addAttributeToSelect('updated_at')
    ->addAttributeToSelect('is_active')
    //->addAttributeToSelect('default_billing')
    //->addAttributeToSelect('default_shipping')
    //->addAttributeToSelect('password_hash')
    //->addAttributeToSelect('created_in')
    //->addAttributeToSelect('*')
    ->joinAttribute('billing_firstname', 'customer_address/firstname', 'default_billing', null, 'left')
    ->joinAttribute('billing_lastname', 'customer_address/lastname', 'default_billing', null, 'left')
    ->joinAttribute('billing_company', 'customer_address/company', 'default_billing', null, 'left')
    ->joinAttribute('billing_street', 'customer_address/street', 'default_billing', null, 'left')
    ->joinAttribute('billing_postcode', 'customer_address/postcode', 'default_billing', null, 'left')
    ->joinAttribute('billing_telephone', 'customer_address/telephone', 'default_billing', null, 'left')
    ->joinAttribute('billing_city', 'customer_address/city', 'default_billing', null, 'left')
    ->joinAttribute('billing_region', 'customer_address/region', 'default_billing', null, 'left')
    ->joinAttribute('billing_country_id', 'customer_address/country_id', 'default_billing', null, 'left')
    
    ->joinAttribute('shipping_firstname', 'customer_address/firstname', 'default_shipping', null, 'left')
    ->joinAttribute('shipping_lastname', 'customer_address/lastname', 'default_shipping', null, 'left')
    ->joinAttribute('shipping_company', 'customer_address/company', 'default_shipping', null, 'left')
    ->joinAttribute('shipping_street', 'customer_address/street', 'default_shipping', null, 'left')
    ->joinAttribute('shipping_postcode', 'customer_address/postcode', 'default_shipping', null, 'left')
    ->joinAttribute('shipping_telephone', 'customer_address/telephone', 'default_shipping', null, 'left')
    ->joinAttribute('shipping_city', 'customer_address/city', 'default_shipping', null, 'left')
    ->joinAttribute('shipping_region', 'customer_address/region', 'default_shipping', null, 'left')
    ->joinAttribute('shipping_country_id', 'customer_address/country_id', 'default_shipping', null, 'left')
    ->addFieldToFilter('group_id',array('eq'=>7));
    //Add a page size to the result set.
    $collection->setPageSize(50);
    //discover how many page the result will be.
    $pages = $collection->getLastPageNumber();
    $currentPage = 1;
    //This is the file to append the output to.
    $fp = fopen('customers.csv', 'w');
    $addedKeys = false;
    do{
         //Tell the collection which page to load.
         $collection->setCurPage($currentPage);
         $collection->load();
         foreach ($collection as $customer){
            //write the collection array as a CSV.
            $customerArray = $customer->toArray();
            if($addedKeys == false){
            	$keys = array_keys($customerArray);
            	fputcsv($fp, $keys);
            	$addedKeys = true;
            }
            //var_dump($customerArray); echo "\n\n";
            fputcsv($fp, $customerArray);
            //fwrite($fp,print_r($customerArray,true) . chr(10) );
            $customerCount++;
         }
         $currentPage++;
         //make the collection unload the data in memory so it will pick up the next page when load() is called.
         $collection->clear();
         //break; //DEBUG
         echo "Finished page $currentPage of $pages \n"; 
    } while ($currentPage <= $pages);
    fclose($fp);
} catch (Exception $e) {
    //$response['error'] = $e->getMessage();
    Mage::printException($e);
}
echo "Saved $customerCount customers to csv file \n";