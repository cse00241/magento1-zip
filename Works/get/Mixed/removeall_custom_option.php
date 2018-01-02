<?php
require_once '../app/Mage.php';
Mage::app('admin');
$collection = Mage::getResourceModel('catalog/product_collection');
foreach($collection as $product) {
    $productId = $product->getId();
    $product = Mage::getModel('catalog/product')->load($productId);
    $customOptions = $product->getOptions();
    foreach ($customOptions as $option) {
        $option->delete();
    }
    $product->setHasOptions(0);
    $product->save();
}

