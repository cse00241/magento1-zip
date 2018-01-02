<?php
require_once('../app/Mage.php');
Mage::app('admin'); 

class TradeOrders
{
    private static $headers = array(
            "order_id",
            "email",
            "firstname",
            "lastname",
            "prefix",
            "middlename",
            "suffix",
            "taxvat",
            "created_at",
            "updated_at",
            "invoice_created_at",
            "shipment_created_at",
            "creditmemo_created_at",
            "tax_amount",
            "base_tax_amount",
            "discount_amount",
            "base_discount_amount",
            "shipping_tax_amount",
            "base_shipping_tax_amount",
            "base_to_global_rate",
            "base_to_order_rate",
            "store_to_base_rate",
            "store_to_order_rate",
            "subtotal_incl_tax",
            "base_subtotal_incl_tax",
            "coupon_code",
            "shipping_incl_tax",
            "base_shipping_incl_tax",
            "shipping_method",
            "shipping_amount",
            "subtotal",
            "base_subtotal",
            "grand_total",
            "base_grand_total",
            "base_shipping_amount",
            "adjustment_positive",
            "adjustment_negative",
            "refunded_shipping_amount",
            "base_refunded_shipping_amount",
            "refunded_subtotal",
            "base_refunded_subtotal",
            "refunded_tax_amount",
            "base_refunded_tax_amount",
            "refunded_discount_amount",
            "base_refunded_discount_amount",
            "store_id",
            "order_status",
            "order_state",
            "hold_before_state",
            "hold_before_status",
            "store_currency_code",
            "base_currency_code",
            "order_currency_code",
            "total_paid",
            "base_total_paid",
            "is_virtual",
            "total_qty_ordered",
            "remote_ip",
            "total_refunded",
            "base_total_refunded",
            "total_canceled",
            "total_invoiced",
            "customer_id",
            "billing_prefix",
            "billing_firstname",
            "billing_middlename",
            "billing_lastname",
            "billing_suffix",
            "billing_street_full",
            "billing_city",
            "billing_region",
            "billing_country",
            "billing_postcode",
            "billing_telephone",
            "billing_company",
            "billing_fax",
            "customer_id",
            "shipping_prefix",
            "shipping_firstname",
            "shipping_middlename",
            "shipping_lastname",
            "shipping_suffix",
            "shipping_street_full",
            "shipping_city",
            "shipping_region",
            "shipping_country",
            "shipping_postcode",
            "shipping_telephone",
            "shipping_company",
            "shipping_fax",
            "payment_method",
            "product_sku",
            "product_name",
            "qty_ordered",
            "qty_invoiced",
            "qty_shipped",
            "qty_refunded",
            "qty_canceled",
            "product_type",
            "original_price",
            "base_original_price",
            "row_total",
            "base_row_total",
            "row_weight",
            "price_incl_tax",
            "base_price_incl_tax",
            "product_tax_amount",
            "product_base_tax_amount",
            "product_tax_percent",
            "product_discount",
            "product_base_discount",
            "product_discount_percent",
            "is_child",
            "product_option"
        );
    
    public static function get($from, $to) {
        
        // Fetch all UK Trade orders within specified date range
        Mage::app()->getStore()->setId(1);
        $orders = Mage::getModel('sales/order')
          ->getCollection();
          //->addAttributeToFilter('status', array('eq' => 'complete'));
          //->addAttributeToFilter('created_at', array('from' => $from, 'to' => $to,));
        
        // Prepare CSV file
        $f = fopen('TradeOrders.csv', 'w+');
        fputcsv($f, self::$headers);
		$i=0;
        foreach ($orders as $order) {

            $items = $order->getAllItems();
            
            // Build array of product SKUs within the order
            $skus = array();
            foreach ($items as $item) {
               $skus[] = $item->getSku();
				/*
			  echo '<br>';
			    echo $skus[] = $item->getQty_ordered();
				echo '<br>';
				echo $old_email = $order->getCustomerEmail();	
				*/
            }
            
            // Remove duplicate SKU entries
            $skus = array_unique($skus);
			
            // Write record to CSV file
            foreach ($skus as $sku) {
			
				$i++;
				if($i > 20){
					exit();
				}
		$orderObject = Mage::getModel('sales/order')->load($order->getId());	
		$shippingAddress = !$order->getIsVirtual() ? $order->getShippingAddress() : null;
        $billingAddress = $order->getBillingAddress();
        if (!$shippingAddress)
            $shippingAddress = $billingAddress;
		
		
		
		
		$old_email = $order->getCustomerEmail();		
		$old_order_id = $order->getIncrementId();		
		$old_first_name = $order->getCustomerFirstname();		
		$old_last_name = $order->getCustomerLastname();
		$old_prefix = $order->getCustomerPrefix();
		$old_middlename = $order->getCustomerMiddlename();
		$old_suffix = $order->getCustomerSuffix();
		$old_taxvat = $order->getCustomerTaxvat();
		$created_at = $order->getCreated_at();
		$updated_at = $order->getUpdated_at();
		$old_invoice_created_at = $orderObject->getCreated_at();
		//$old_shipment_created_at = $orderObject->getShipment_created_at(); 
		//$old_creditmemo_created_at = $orderObject->getCreditmemo_created_at(); 
		$old_tax_amount = $orderObject->getTax_amount();
		$old_base_tax_amount = $orderObject->getBase_tax_amount();
		$old_discount_amount = $orderObject->getDiscount_amount();
		$old_base_discount_amount = $orderObject->getBase_discount_amount();
		$old_shipping_tax_amount = $orderObject->getShipping_tax_amount();
		$old_base_shipping_tax_amount = $orderObject->getBase_shipping_tax_amount();
		$old_base_to_order_rate = $orderObject->getBase_to_order_rate();
		$old_store_to_base_rate = $orderObject->getStore_to_base_rate();
		$old_store_to_order_rate = $orderObject->getStore_to_order_rate();
		$old_subtotal_incl_tax = $orderObject->getSubtotal_incl_tax();
		$old_base_subtotal_incl_tax = $orderObject->getBase_subtotal_incl_tax();
		$old_coupon_code = $orderObject->getCoupon_code();
		$old_shipping_incl_tax = $orderObject->getShipping_incl_tax();
		$old_base_shipping_incl_tax = $orderObject->getBase_shipping_incl_tax();
		//$old_shipping_method = $orderObject->getShipping_method();
		$old_shipping_amount = $orderObject->getShipping_amount();
		$old_subtotal = $orderObject->getSubtotal();
		$old_base_subtotal = $orderObject->getBase_subtotal();
		$old_grand_total = $orderObject->getGrand_total();
		$old_base_grand_total = $orderObject->getBase_grand_total();
		$old_base_shipping_amount = $orderObject->getBase_shipping_amount();
		/* credit_detail
		$old_adjustment_positive = $orderObject->getAdjustment_positive();
		$old_adjustment_negative = $orderObject->getAdjustment_negative();
		$old_shipping_amount = $orderObject->getShipping_amount();
		$old_base_shipping_amount = $orderObject->getBase_shipping_amount();
		$old_subtotal = $orderObject->getSubtotal();
		$old_base_subtotal = $orderObject->getBase_subtotal();
		$old_tax_amount = $orderObject->getTax_amount();
		$old_Base_tax_amount = $orderObject->getBase_tax_amount();
		$old_discount_amount = $orderObject->getDiscount_amount();
		$old_base_discount_amount = $orderObject->getBase_discount_amount();
		*/
		$old_store_id = $orderObject->getStore_id();
		$old_status = $orderObject->getStatus();
		$old_state = $orderObject->getState();
		$old_holdBeforeState = $orderObject->getHoldBeforeState();
		$old_holdBeforeStatus = $orderObject->getHoldBeforeStatus();
		$old_store_currency_code = $orderObject->getStore_currency_code();
		$old_base_currency_code = $orderObject->getBase_currency_code();
		$old_order_currency_code = $orderObject->getOrder_currency_code();
		$old_total_paid = $orderObject->getTotal_paid();
		$old_base_total_paid = $orderObject->getBase_total_paid();
		$old_is_virtual = $orderObject->getIs_virtual();
		$old_total_qty_ordered = $orderObject->getTotal_qty_ordered();
		$old_remote_ip = $orderObject->getRemote_ip();
		$old_total_refunded = $orderObject->getTotal_refunded();
		$old_total_canceled = $orderObject->getTotal_canceled();
		$old_customer_id = $order->getCustomer_id();
		$old_billing_prefix = $order->getBillingAddress()->getData('prefix');
		$old_billing_firstname = $order->getBillingAddress()->getData('firstname');
		$old_billing_middlename = $order->getBillingAddress()->getData('middlename');
		$old_billing_lastname = $order->getBillingAddress()->getData('lastname');
		$old_billing_suffix = $order->getBillingAddress()->getData('suffix');
		$old_billing_street = $order->getBillingAddress()->getData('street');
		$old_billing_city = $order->getBillingAddress()->getData('city');
		$old_billing_region = $order->getBillingAddress()->getData('region');
		$old_billing_country_id = $order->getBillingAddress()->getData('country_id');
		$old_billing_postcode = $order->getBillingAddress()->getData('postcode');
		$old_billing_telephone = $order->getBillingAddress()->getData('telephone');
		$old_billing_company = $order->getBillingAddress()->getData('company');
		$old_billing_fax = $order->getBillingAddress()->getData('fax');
		$old_customer_id = $order->getData('customer_id');
		$old_shippingAddress_prefix = $shippingAddress->getData('prefix');
		$old_shippingAddress_firstname = $shippingAddress->getData('firstname');
		$old_shippingAddress_middlename = $shippingAddress->getData('middlename');
		$old_shippingAddress_lastname = $shippingAddress->getData('lastname');
		$old_shippingAddress_suffix = $shippingAddress->getData('suffix');
		$old_shippingAddress_street = $shippingAddress->getData('street');
		$old_shippingAddress_city = $shippingAddress->getData('city');
		$old_shippingAddress_region = $shippingAddress->getData('region');
		$old_shippingAddress_country_id = $shippingAddress->getData('country_id');
		$old_shippingAddress_postcode = $shippingAddress->getData('postcode');
		$old_shippingAddress_telephone = $shippingAddress->getData('telephone');
		$old_shippingAddress_company = $shippingAddress->getData('company');
		$old_shippingAddress_fax = $shippingAddress->getData('fax');
		//$old_getPaymentMethod = $shippingAddress->getgetPaymentMethod('fax');
		
		
		
		
		//exit();
		if($old_order_id != $data['order_id']){
			$data['order_id']     = $order->getIncrementId();
		}else{
			$data['order_id']        = '';
		}
		
		if($old_email != $data['email']){
			$data['email']        = $order->getCustomerEmail();
		}else{
			$data['email']        = '';
		}
		
		
		
		if($old_first_name != $data['first_name']){
			$data['first_name']   = $order->getCustomerFirstname();
		}else{
			$data['first_name']        = '';
		}
		if($old_last_name != $data['last_name']){
			$data['last_name']        = $order->getCustomerLastname();
		}else{
			$data['last_name']        = '';
		}
	    
			//echo 
			//echo $data['last_name']    = $order->getCustomerLastname();

		//exit();
		/*
		$data['prefix']       = $sku;
		$data['suffix']       = $sku;
		$data['taxvat']       = $sku;
		$data['created_at']       = $sku;
		$data['updated_at']       = $sku;
		$data['invoice_created_at']       = $sku;
		$data['shipment_created_at']       = $sku;
		$data['creditmemo_created_at']       = $sku;
		$data['tax_amount']       = $sku;
		$data['base_tax_amount']       = $sku;
		$data['discount_amount']       = $sku;
		$data['base_discount_amount']       = $sku;
		$data['shipping_tax_amount']       = $sku;
		$data['base_shipping_tax_amount']       = $sku;
		$data['base_to_global_rate']       = $sku;
		$data['base_to_order_rate']       = $sku;
		$data['store_to_base_rate']       = $sku;
		$data['store_to_order_rate']       = $sku;
		$data['subtotal_incl_tax']       = $sku;
		$data['base_subtotal_incl_tax']       = $sku;
		$data['coupon_code']       = $sku;
		$data['shipping_incl_tax']       = $sku;
		$data['base_shipping_incl_tax']       = $sku;
		$data['shipping_method']       = $sku;
		$data['shipping_amount']       = $sku;
		$data['subtotal']       = $sku;
		$data['base_subtotal']       = $sku;
		$data['grand_total']       = $sku;
		$data['base_grand_total']       = $sku;
		$data['base_shipping_amount']       = $sku;
		$data['adjustment_positive']       = $sku;
		$data['adjustment_negative']       = $sku;
		$data['refunded_shipping_amount']       = $sku;
		$data['base_refunded_shipping_amount']       = $sku;
		$data['refunded_subtotal']       = $sku;
		$data['base_refunded_subtotal']       = $sku;
		$data['refunded_tax_amount']       = $sku;
		$data['base_refunded_tax_amount']       = $sku;
		$data['refunded_discount_amount']       = $sku;
		$data['base_refunded_discount_amount']       = $sku;
		$data['store_id']       = $sku;
		$data['order_status']       = $sku;
		$data['order_state']       = $sku;
		$data['hold_before_state']       = $sku;
		$data['hold_before_status']       = $sku;
		$data['store_currency_code']       = $sku;
		$data['base_currency_code']       = $sku;
		$data['order_currency_code']       = $sku;
		$data['total_paid']       = $sku;
		$data['base_total_paid']       = $sku;
		$data['is_virtual']       = $sku;
		$data['total_qty_ordered']       = $sku;
		$data['remote_ip']       = $sku;
		$data['total_refunded']       = $sku;
		$data['base_total_refunded']       = $sku;
		$data['total_canceled']       = $sku;
		$data['total_invoiced']       = $sku;
		$data['customer_id']       = $sku;
		$data['billing_prefix']       = $sku;
		$data['billing_firstname']       = $sku;
		$data['billing_middlename']       = $sku;
		$data['billing_lastname']       = $sku;
		$data['billing_suffix']       = $sku;
		$data['billing_street_full']       = $sku;
		$data['billing_city']       = $sku;
		$data['billing_region']       = $sku;
		$data['billing_country']       = $sku;
		$data['billing_postcode']       = $sku;
		$data['billing_telephone']       = $sku;
		$data['billing_company']       = $sku;
		$data['billing_fax']       = $sku;
		$data['customer_id']       = $sku;
		$data['shipping_prefix']       = $sku;
		$data['shipping_firstname']       = $sku;
		$data['shipping_middlename']       = $sku;
		$data['shipping_lastname']       = $sku;
		$data['shipping_suffix']       = $sku;
		$data['shipping_street_full']       = $sku;
		$data['shipping_city']       = $sku;
		$data['shipping_region']       = $sku;
		$data['shipping_country']       = $sku;
		$data['shipping_postcode']       = $sku;
		$data['shipping_telephone']       = $sku;
		$data['shipping_company']       = $sku;
		$data['shipping_fax']       = $sku;
		$data['payment_method']       = $sku;
		$data['product_sku']       = $sku;
		$data['product_name']       = $sku;
		$data['qty_ordered']       = $sku;
		$data['qty_invoiced']       = $sku;
		$data['qty_shipped']       = $sku;
		$data['qty_refunded']       = $sku;
		$data['qty_canceled']       = $sku;
		$data['product_type']       = $sku;
		$data['original_price']       = $sku;
		$data['base_original_price']       = $sku;
		$data['row_total']       = $sku;
		$data['base_row_total']       = $sku;
		$data['row_weight']       = $sku;
		$data['price_incl_tax']       = $sku;
		$data['base_price_incl_tax']       = $sku;
		$data['product_tax_amount']       = $sku;
		$data['product_base_tax_amount']       = $sku;
		$data['product_tax_percent']       = $sku;
		$data['product_discount']       = $sku;
		$data['product_base_discount']       = $sku;
		$data['product_discount_percent']       = $sku;
		$data['is_child']       = $sku;
		$data['product_option']       = $sku;
		*/
		
		//$data['product_name'] = $item->getName();
		$i = 0;
		
		 foreach ($items as $item) {
				if($i == 0){
					echo $email = $order->getCustomerEmail();
					echo '<br>';
					echo $skus[] = $item->getOriginal_price();	
					echo $skus[] = $item->getQty_ordered();	
					echo '<br>';
					echo $skus[] = $item->getQty_ordered();	
					echo '<hr>';
					
					$i = 1;
					
				}else{
					echo $email = '';
					echo $skus = $item->getSku();
					echo '<br>';
					echo $original_price = $item->getOriginal_price();	
					echo $qty_ordered = $item->getQty_ordered();	
					echo '<br>';
					echo $skus[] = $item->getQty_ordered();	
					echo '<hr>';
				}
				
            }
		
                if ('dvnrth565@gmail.com' != $data['email']) {
                    //fputcsv($f, $data);
                }
            }
        echo '<hr>';
		} 
		// echo $i;
		//exit();
    }
}
$format = 'Y-m-d G:i:s';
$from   = date($format, strtotime('-100000000 days'));
$to     = date($format, strtotime('-4 hours'));
TradeOrders::get($from, $to);