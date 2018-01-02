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

    /*
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
    */
    
    $servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "myDB";
	$conn = mysqli_connect($servername, $username, $password, $dbname);
	if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
	}
    $sql = "SELECT * FROM product where flag=1 limit 0,10";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    $collection = Mage::getResourceModel('catalog/product_collection');
    $i = 0;
    foreach($collection as $product) {
        $obj = Mage::getModel('catalog/product');
        $id = $product->getId();
        $product = $obj->load($id);
        $optionInstance = $product->getOptionInstance()->unsetOptions();
        $product->setHasOptions(1);
        $optionInstance->addOption($option);
        $optionInstance->setProduct($product);
        $product->save();
        $sql = "UPDATE product SET flag=1 WHERE product_id='$id'";
        
        
        unset($product);
        echo "Done->".$id.'<br>';
        $i++;
    }
    }
    echo $i;
    
    