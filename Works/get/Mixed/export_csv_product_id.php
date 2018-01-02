<?php
error_reporting(E_ALL | E_STRICT);
require_once '../app/Mage.php';
Mage::app('admin');
Mage::setIsDeveloperMode(true);
ini_set('display_errors', 1);
Mage::app();
$products = Mage::getModel("catalog/product")->getCollection();
$fp = fopen('exports.csv', 'w');
$csvHeader = array("product_id");
fputcsv( $fp, $csvHeader,",");
$i = 0;
foreach ($products as $product){
    $id = $product->getId();
    $i++;
    fputcsv($fp, array($id), ",");
}
echo $i;
fclose($fp);