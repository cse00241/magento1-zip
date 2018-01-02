<?php
require_once('../app/Mage.php');
Mage::app('admin');
Mage::app()->setCurrentStore(Mage::getModel('core/store')->load(Mage_Core_Model_App::ADMIN_STORE_ID));
 
$resource = Mage::getSingleton('core/resource');
$db_read = $resource->getConnection('core_read');
 
$categories = $db_read->fetchCol("SELECT entity_id FROM " . $resource->getTableName("catalog_category_entity") . " WHERE entity_id>1 ORDER BY entity_id DESC");
foreach ($categories as $category_id) {
    try {
        Mage::getModel("catalog/category")->load($category_id)->delete();
    } catch (Exception $e) {
        echo $e->getMessage() . "\n";
    }
}