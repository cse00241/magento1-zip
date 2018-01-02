<?php
    require_once '../app/Mage.php';
    Mage::app('admin');
    Mage::app('default');
    Mage::getSingleton('core/session', array('name' => 'frontend'));

    function getOptions(){
        return array(
            array(
                'title' => 'Deliver Once',
                'price' =>0.00,
                'price_type' => 'fixed',
                'sort_order' => '0'
            ),
            array(
                'title' => 'Now and Every Day',
                'price' =>0.00,
                'price_type' => 'fixed',
                'sort_order' => '1'
            ),
            array(
                'title' => 'Now and Every 7 Days',
                'price' =>0.00,
                'price_type' => 'fixed',
                'sort_order' => '2'
            ),
            array(
                'title' => 'Now and Every 15 Days',
                'price' =>0.00,
                'price_type' => 'fixed',
                'sort_order' => '3'
            ),
            array(
                'title' => 'Now and Every 30 Days',
                'price' =>0.00,
                'price_type' => 'fixed',
                'sort_order' => '4'
            ),
            array(
                'title' => 'Now and Every 45 Days',
                'price' =>0.00,
                'price_type' => 'fixed',
                'sort_order' => '5'
            ),
            array(
                'title' => 'Now and Every 60 Days',
                'price' =>0.00,
                'price_type' => 'fixed',
                'sort_order' => '6'
            ),
            array(
                'title' => 'Now and Every 90 Days',
                'price' =>0.00,
                'price_type' => 'fixed',
                'sort_order' => '7'
            ),
            array(
                'title' => 'Now and Every 120 Days',
                'price' =>0.00,
                'price_type' => 'fixed',
                'sort_order' => '8'
            )
        );
    }

    $option = array(
        'title' => 'Delivery Frequency',
        'type' => 'drop_down', // could be drop_down ,checkbox , multiple
        'is_require' => 1,
        'sort_order' => 0,
        'values' => getOptions()
    );


    $obj = Mage::getModel('catalog/product');
    $id = 904;
    $product = $obj->load($id);
    $optionInstance = $product->getOptionInstance()->unsetOptions();
    $product->setHasOptions(1);
    $optionInstance->addOption($option);
    $optionInstance->setProduct($product);
    $product->save();
    unset($product);
    echo "Done";
    
    $id = 903;
    $product = $obj->load($id);
    $optionInstance = $product->getOptionInstance()->unsetOptions();
    $product->setHasOptions(1);
    $optionInstance->addOption($option);
    $optionInstance->setProduct($product);
    $product->save();
    unset($product);
    echo "Done";
    
    
    
    
    
    
    /*
    $id = 904; //product id 
    $_product = Mage::getModel('catalog/product')->load($id);
    echo $product_data["name"] = $_product->getName();
    $product_data["id"] =  $_product->getId();
    $product_data["sku"] =  $_product->getSku();
    $product_data["name"] = $_product->getName();
    $product_data["type"] =  $_product->getTypeId();       
    $product_data["image"]  = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB).'media/catalog/product'.$_product->getImage();
    $product_data["url"] =  $_product->getProductUrl();
    $product_data["visibility"] =  $_product->isVisibleInSiteVisibility(); //getVisibility(); 
    $product_data["weight"] =  $_product->getWeight();
    $product_data["status"] =  $_product->getStatus(); 
    $product_data["category"] =  $_product->getCategoryIds(); 
    $product_data["weight"] = number_format((float)$_product->getWeight(), 2, '.', '');
    $product_data["description"]['short'] =  $_product->getShortDescription();
    $product_data["description"]['full'] = $_product->getDescription();
    $product_data["price"]["regular"] = $_product->getPrice();
    $product_data["price"]["final"] = $_product->getFinalPrice();
    $product_data["stock"] = Mage::getModel('cataloginventory/stock_item')->loadByProduct($id)->getData(); */
    
    
    exit();
    /*
    require_once 'Zend/Crypt/Hmac.php';
    $collection = Mage::getResourceModel('catalog/product_collection');
    foreach($collection as $product) {
        echo $product->getId();
    }
    
    
    
    
    umask(0);
    Mage::app('default');
    Mage::getSingleton('core/session', array('name' => 'frontend'));

    function getOptions(){
        return array(
            array(
                'title' => 'Option Value 1',
                'price' =>100,
                'price_type' => 'fixed',
                'sort_order' => '1'
            ),
            array(
                'title' => 'Option Value 2',
                'price' =>100,
                'price_type' => 'fixed',
                'sort_order' => '1'
            ),
            array(
                'title' => 'Option Value 3',
                'price' =>100,
                'price_type' => 'fixed',
                'sort_order' => '1'
            )
        );
    }

    $option = array(
        'title' => 'custom option title',
        'type' => 'radio', // could be drop_down ,checkbox , multiple
        'is_require' => 1,
        'sort_order' => 0,
        'values' => getOptions()
    );


    $obj = Mage::getModel('catalog/product');

    $product_id = $obj->getIdBySku('skuid1');
    $product = $obj->load($product_id);
    $optionInstance = $product->getOptionInstance()->unsetOptions();
    $product->setHasOptions(1);
    $optionInstance->addOption($option);
    $optionInstance->setProduct($product);
    $product->save();
    unset($product);
    echo "Done";

    $product_id = $obj->getIdBySku('skuid2');
    $product = $obj->load($product_id);
    $optionInstance = $product->getOptionInstance()->unsetOptions();
    $product->setHasOptions(1);
    $optionInstance->addOption($option);
    $optionInstance->setProduct($product);
    $product->save();
    unset($product);
    echo "Done";
    */
?>