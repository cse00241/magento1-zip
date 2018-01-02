<?php
error_reporting(E_ALL | E_STRICT);
require_once '../app/Mage.php';
Mage::app('admin');
Mage::setIsDeveloperMode(true);
ini_set('display_errors', 1);
Mage::app();
$products = Mage::getModel("catalog/product")->getCollection();
$products->addAttributeToSelect('category_ids');
$products->addAttributeToFilter('status', 1);//optional for only enabled products
$products->addAttributeToFilter('visibility', 4);//optional for products only visible in catalog and search
$fp = fopen('exports.csv', 'w');
$csvHeader = array("sku", "category_ids");
fputcsv( $fp, $csvHeader,",");
foreach ($products as $product){
    $sku = $product->getSku();
    $categoryIds = implode('|', $product->getCategoryIds());//change the category separator if needed
    fputcsv($fp, array($sku, $categoryIds), ",");
}
fclose($fp);