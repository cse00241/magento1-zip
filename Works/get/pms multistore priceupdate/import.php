<?php
$servername = "localhost";
$username = "powerme1_magento";
$password = "fiBTY13q76Ls";
$dbname = "powerme1_magento1";
$conn = mysqli_connect($servername, $username, $password, $dbname);
$sql = "SELECT * FROM trz_medline_new_price where flg=0 limit 0,1";
$result = mysqli_query($conn, $sql);


error_reporting(E_ALL | E_STRICT);
require_once '../app/Mage.php';
Mage::app('admin');
Mage::setIsDeveloperMode(true);
ini_set('display_errors', 1);
Mage::app();

// Set Current Store id in mage:
#Mage::app()->setCurrentStore(2);

# get Product Information by sku

#$product = Mage::getModel('catalog/product');
#$product->setWebsiteIds(array(1));
if (mysqli_num_rows($result) > 0) {
	// output data of each row
	$i = 0;
	while($row = mysqli_fetch_assoc($result)) {
    $i++;
	$id = $row['id'];
	$sku = $row['sku'];
	$price = $row['price'];

    try {
        $product = Mage::getModel('catalog/product') -> loadByAttribute('sku', $sku);
        $product->setStoreId(2) -> setPrice($price) ->save() ;

        $sql = "UPDATE trz_medline_new_price SET flg=1 WHERE id='$id'";
        if ($conn->query($sql) === TRUE) {}
        echo 'done'.$i.'<br>';
    } catch (Exception $e) {
      #$sql = "UPDATE customers SET flg=0 WHERE id='$id'";
      if ($conn->query($sql) === TRUE) {} 
      //echo $e->getMessage();
    }

	}
}


