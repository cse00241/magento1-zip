<?php
require_once('../app/Mage.php');
Mage::app('admin'); 

        Mage::app()->getStore()->setId(1);
		
		
		$resource = Mage::getSingleton('core/resource');
	
	/**
	 * Retrieve the read connection
	 */
	$readConnection = $resource->getConnection('core_read');
	
	/**
	 * Retrieve the write connection
	 */
	$writeConnection = $resource->getConnection('core_write');
		
		
		//$sql = "upda tbl set col = '30'";
		$table = $resource->getTableName('sales/order');
		$entity_id = 915;
	$query = "UPDATE {$table} SET customer_id = '999' WHERE entity_id = "
			 . (int)$entity_id;
	
	/**
	 * Execute the query
	 */
	$writeConnection->query($query);	
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		
		/*
        $orders = Mage::getModel('sales/order')
          ->getCollection();

        foreach ($orders as $order) {
            $items = $order->getAllItems();
            $skus = array();
            foreach ($items as $item) {
                $skus[] = $item->getSku();
            }

            $skus = array_unique($skus);
            
            // Write record to CSV file
            foreach ($skus as $sku) {
				$data['email']        = $order->getCustomerEmail();
				$data['order_id']     = $order->getId();
                if ('1229cse00241@gmail.com' == $data['email'] && $data['order_id']==915 ) {
					
						$data['id']        = $order->getCustomerId();
                   		/*
						echo $data['order_id']     = $order->getId();
						echo '<br>';
						echo $data['id']        = $order->getCustomerId();
						echo '<br>';
						echo $data['email']        = $order->getCustomerEmail();
						echo '<br>';
						echo $data['first_name']   = $order->getCustomerFirstname();
						echo '<br>';
						$data['last_name']    = $order->getCustomerLastname();
						echo '</br>';
						
						echo $data['order_id']     = $order->getId();
						echo '<br>';
						if($order->getCustomerId() ==NULL){
							echo 'nulled<br>';
						}else{
							echo 'not nulled<br>';
						}
						
					$order->setCustomerId($data['id']);
					$order->save();
                }
			}
		}*/