<?php
require_once('../../app/Mage.php');
Mage::app('admin');
Mage::register('isSecureArea', true);

$customers = Mage::getModel("customer/customer")->getCollection();

foreach ($customers as $customer) {
    $customer->delete();
}