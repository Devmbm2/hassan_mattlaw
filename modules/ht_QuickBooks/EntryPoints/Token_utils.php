<?php

if (!defined('sugarEntry') || !sugarEntry) {
    die('Not A Valid Entry Point');
}
require_once("modules/Administration/Administration.php");
require("modules/DT_QuickBooks/OAuth_2/Client.php");

class quickbooks_utils {	

	//public $qb_api_url = 'https://sandbox-quickbooks.api.intuit.com';
	public $qb_api_url = 'https://quickbooks.api.intuit.com';

	function get_qb_company_id()
	{
		$quickbooks_admin = new Administration();
		$settings_quickbooks = $quickbooks_admin->retrieveSettings('quickbooks_config');
		return $settings_quickbooks->settings['quickbooks_config_company_id'];
	}

	function get_access_token()
	{
		$quickbooks_admin = new Administration();
		$settings_quickbooks = $quickbooks_admin->retrieveSettings('quickbooks_config');
		return $settings_quickbooks->settings['quickbooks_config_access_token'];
	}

	function check_access()
	{			
		$quickbooks_admin = new Administration();
		$settings_quickbooks = $quickbooks_admin->retrieveSettings('quickbooks_config');
		$access_token_expire_time = $settings_quickbooks->settings['quickbooks_config_access_token_expire_time'];				

		$date = new DateTime();
		$current_timestamp = $date->getTimestamp();

		if($current_timestamp > $access_token_expire_time)
		{
			$refresh_token_expire_time = $settings_quickbooks->settings['quickbooks_config_refresh_token_expire_time'];
			if($current_timestamp > $refresh_token_expire_time)
			{
				$GLOBALS['log']->fatal("QB ERROR : Refresh Token Time is Expired");				
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token_expire_time', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token_expire_time', '');
				return false;
			}			
			$session_id = session_id();
			if (empty($session_id))
			{
			    session_start();
			}
			
			$refresh_token = $settings_quickbooks->settings['quickbooks_config_refresh_token'];
			$configs = include('modules/DT_QuickBooks/OAuth_2/config.php');
			$tokenEndPointUrl = $configs['tokenEndPointUrl'];
			$mainPage = $configs['mainPage'];
			$grant_type= 'refresh_token';
			$client_id = $settings_quickbooks->settings['quickbooks_config_client_id'];
			$client_secret = $settings_quickbooks->settings['quickbooks_config_client_secret'];
			$certFilePath = 'modules/DT_QuickBooks/OAuth_2/Certificate/cacert.pem';

			$client = new Client($client_id, $client_secret, $certFilePath);
			$result = $client->refreshAccessToken($tokenEndPointUrl, $grant_type, $refresh_token);
			if(isset($result['access_token']))
			{				
				$access_token_expires_in = $current_timestamp + $result['expires_in'];
				$refresh_token_expires_in = $current_timestamp + $result['x_refresh_token_expires_in'];

				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token', $result['access_token']);
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token', $result['refresh_token']);
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token_expire_time', $access_token_expires_in);
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token_expire_time', $refresh_token_expires_in);			
			}
			else
			{
				$GLOBALS['log']->fatal("QB ERROR : Access Token is not generated");
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'access_token_expire_time', '');
				$quickbooks_admin->saveSetting('quickbooks_config', 'refresh_token_expire_time', '');
				return false;
			}			
		}
		return true;
	}	
	
	function qb_response($name,$id,$operation)
	{		
		switch ($name) {
		    case "Customer":
		        $module = "customer";
				$result = $this->create_qb_contact($id,$module);
				return $result;
		        break;
		    case "Item":
		        $module = "item";
				$result = $this->create_qb_product($id,$module);
				return $result;
		        break;
		    case "Invoice":
		        $module = "invoice";
				$result = $this->create_qb_invoice($id,$module);
				return $result;
			}
	}

	function create_qb_contact($id,$module)
	{	
		$quickbooks_data = $this->get_quickbooks_data($id,$module);
		$data = $quickbooks_data['Customer'];
		
		if(empty($data))
		{
			$GLOBALS['log']->fatal("empty array for id={$id} and module={$module}");
			return "empty";
		}		
		$firstname = $data['GivenName'];
		$lastname = $data['FamilyName'];
		$companyname = $data['CompanyName'];
		$email = $data['PrimaryEmailAddr']['Address'];
		$phone = $data['PrimaryPhone']['FreeFormNumber'];
		$mobile = $data['Mobile']['FreeFormNumber'];
		$fax = $data['Fax']['FreeFormNumber'];
		$address = $data['BillAddr']['Line1'];
		$city = $data['BillAddr']['City'];
		$state = $data['BillAddr']['CountrySubDivisionCode'];
		$pincode = $data['BillAddr']['PostalCode'];
		$country = $data['BillAddr']['Country'];
		$salutation = $data['Title'];
		$qb_id = $data['Id'];

		if(!$lastname)
		{			
			$display_name = $data['DisplayName'];
		    if (strpos($display_name, ' ') !== false) {
		        $explode = explode(" ", $display_name);
		        if(!$firstname)
		        {
		        	$firstname = $explode[0];
		        }
		        $lastname = $explode[sizeof($explode)-1];
		    }
		    else
		    {
		        $lastname = $display_name;
		    }
		}		

		$sql = "SELECT id FROM contacts where quickbooks_id=".$id." and deleted=0 limit 1";
	    $result = $GLOBALS['db']->query($sql);
	    $total_rec = $result->num_rows;		

		if($total_rec > 0)
		{
			$row = $GLOBALS['db']->fetchByAssoc($result);
			$bean_id = $row['id'];			
	    	$GLOBALS['log']->fatal("updating contact ".$id);			
			$bean = BeanFactory::getBean('Contacts',$bean_id);   //update bean  using module name 						
		}
		else
		{			
	    	$GLOBALS['log']->fatal("creating contact ".$id);			
			$bean = BeanFactory::newBean('Contacts');   //Create bean  using module name 
		}		
		
		$bean->quickbooks_id = $qb_id;
		$bean->first_name = $firstname;
		$bean->last_name = $lastname;
		$bean->account_name = $companyname;
		$bean->email1 = $email;
		$bean->phone_work = $phone;
		$bean->phone_mobile = $mobile;
		$bean->phone_fax = $fax;
		$bean->primary_address_street = $address;
		$bean->primary_address_city = $city;
		$bean->primary_address_state = $state;
		$bean->primary_address_country = $country;
		$bean->primary_address_postalcode = $pincode;
		$bean->salutation = $salutation;
		
		$bean->save();   //Save
		$record_id = $bean->id;

		$sql = "update contacts set quickbooks_id=".$id." where id='".$record_id."'";
	    $result = $GLOBALS['db']->query($sql);

		return $record_id;
	}	

	function create_qb_product($id,$module)
	{		
		$quickbooks_data = $this->get_quickbooks_data($id,$module);
		$data = $quickbooks_data['Item'];

		if(empty($data))
		{
			$GLOBALS['log']->fatal("empty array for product id={$id} and module={$module}");
			return "empty";
		}
		
		$name = $data['Name'];
		$price = $data['UnitPrice'];
		$cost = $data['PurchaseCost'];
		$qb_id = $data['Id'];
		$price = isset($price) ? $price : 0;

		$sql = "SELECT id FROM aos_products where quickbooks_id=".$id." and deleted=0 limit 1";
	    $result = $GLOBALS['db']->query($sql);
	    $total_rec = $result->num_rows;

		if($total_rec > 0)
		{
			$row = $GLOBALS['db']->fetchByAssoc($result);
			$bean_id = $row['id'];			
	    	$GLOBALS['log']->fatal("updating product ".$id);			
			$bean = BeanFactory::getBean('AOS_Products',$bean_id);   //update bean  using module name 						
		}
		else
		{			
	    	$GLOBALS['log']->fatal("creating product ".$id);			
			$bean = BeanFactory::newBean('AOS_Products');   //Create bean  using module name 
		}
		
		$bean->name = $name;
		$bean->cost = $cost;
		$bean->price = $price;
		$bean->quickbooks_id = $qb_id;
		$bean->save();
		$record_id = $bean->id;
		return $record_id;
	}	

	function create_qb_invoice($id,$module)
	{		
		$quickbooks_data = $this->get_quickbooks_data($id,$module);
		$data = $quickbooks_data['Invoice'];
		
		if(empty($data))
		{
			$GLOBALS['log']->fatal("empty array for id={$id} and module={$module}");
			return "empty";
		}

	    $qb_id = $data['Id'];
		$name = $qb_id;
	    $invoice_date = $data['TxnDate'];
	    $customer_name = $data['CustomerRef']['name'];
	    $customer_id = $data['CustomerRef']['value'];
	    
	    //get products detail in array
	    $products = array();
	    $i=0;
	    foreach ($data['Line'] as $invoice_details) {
	        if($invoice_details['SalesItemLineDetail'])
	        {
	            $products[$i]['id'] = $invoice_details['Id'];
	            $products[$i]['product_id'] = $invoice_details['SalesItemLineDetail']['ItemRef']['value'];
	            $product_id = $invoice_details['SalesItemLineDetail']['ItemRef']['value'];
	            
	        	//create product if product is not in CRM
	            $sql_product = "SELECT id FROM aos_products where quickbooks_id=".$product_id." and deleted=0 limit 1";
			    $result_product = $GLOBALS['db']->query($sql_product);
			    $total_product_rec = $result_product->num_rows;
				if($total_product_rec == 0)
				{		            
					$module = "item";
					$result = $this->create_qb_product($product_id,$module);
				}				
	            $products[$i]['product_name'] = $invoice_details['SalesItemLineDetail']['ItemRef']['name'];	            
	            $products[$i]['unit_price'] = $invoice_details['SalesItemLineDetail']['UnitPrice'];
	            $products[$i]['quantity'] = $invoice_details['SalesItemLineDetail']['Qty'];
	            if($invoice_details['SalesItemLineDetail']['TaxInclusiveAmt'])
	            {
	                $products[$i]['taxincludingrate'] = $invoice_details['SalesItemLineDetail']['TaxInclusiveAmt']/$invoice_details['SalesItemLineDetail']['Qty'];
	                $products[$i]['amount'] = $invoice_details['SalesItemLineDetail']['TaxInclusiveAmt'];
	            }
	            else
	            {
	            	$products[$i]['amount'] = $invoice_details['Amount'];
	            }
	            $i++;
	        }
	        if($invoice_details['DetailType'] == "SubTotalLineDetail")
	        {
	            $subtotal_amount = $invoice_details['Amount'];            
	        }
	        if($invoice_details['DetailType'] == "DiscountLineDetail")
	        {
	            $discount_amount = $invoice_details['Amount'];
	        }
	    }
	    
	    $tax_amount = $data['TxnTaxDetail']['TotalTax'];	    

	    $billing_address = $data['BillAddr']['Line1'];
	    $billing_city = $data['BillAddr']['City'];
	    $billing_country = $data['BillAddr']['Country'];
	    $billing_state = $data['BillAddr']['CountrySubDivisionCode'];
	    $billing_pin = $data['BillAddr']['PostalCode'];

	    $shipping_address = $data['ShipAddr']['Line1'];
	    $shipping_city = $data['ShipAddr']['City'];
	    $shipping_country = $data['ShipAddr']['Country'];
	    $shipping_state = $data['ShipAddr']['CountrySubDivisionCode'];
	    $shipping_pin = $data['ShipAddr']['PostalCode'];

	    $due_date = $data['DueDate'];
	    $total_amount = $data['TotalAmt'];

	    foreach ($data['LinkedTxn'] as $quotes) {
	        if($quotes['TxnType'] == "Estimate")
	        {
	            $quote_number = $quotes['TxnId'];
	        }
	    }

	    //create customer if customer is not in CRM
	    $sql_customer = "SELECT id FROM contacts where quickbooks_id=".$customer_id." and deleted=0 limit 1";
	    $result_customer = $GLOBALS['db']->query($sql_customer);
	    $total_customer_rec = $result_customer->num_rows;
		if($total_customer_rec == 0)
		{			
			$quickbooks_contact_data = $this->get_quickbooks_data($customer_id,"customer");
			$customer_data = $quickbooks_contact_data['Customer'];
		
			if(empty($customer_data))
			{
				$GLOBALS['log']->fatal("empty array for id={$id} and module={$module}");
				return "empty";
			}		
			
			$customer_email = $customer_data['PrimaryEmailAddr']['Address'];
			$qb_contact_id = $customer_data['Id'];
			if(!empty($customer_email))
			{
				$email_upper = strtoupper($customer_email);	
				$query = $GLOBALS['db']->query("select bean_id from email_addresses as ea, email_addr_bean_rel as rlea where  ea.email_address_caps = '$email_upper' and ea.deleted=0 and rlea.deleted=0 and  rlea.bean_module='Contacts' and rlea.email_address_id=ea.id LIMIT 1",false);
				while (($row = $GLOBALS['db']->fetchByAssoc($query)) != null)
				{
				    $crm_contact_id = $row['bean_id'];
				}

				if(!empty($crm_contact_id))
				{
				    $customer_id = $crm_contact_id;
					$contact_bean = BeanFactory::getBean("Contacts",$crm_contact_id);
					$contact_bean->quickbooks_id = $qb_contact_id;
					$contact_bean->save();
				}
				else
				{
					$customer_id = $this->create_qb_contact($customer_id,"customer");		
				}
			}
			else
			{
				$customer_id = $this->create_qb_contact($customer_id,"customer");
			}			
		}
		else
		{
			while (($row = $GLOBALS['db']->fetchByAssoc($result_customer)) != null)
			{
			    $customer_id = $row['id'];
			}
		}

	    $sql = "SELECT id FROM aos_invoices where quickbooks_id=".$id." and deleted=0 limit 1";
	    $result = $GLOBALS['db']->query($sql);
	    $total_rec = $result->num_rows;
        
		if($total_rec > 0)
		{
			$row = $GLOBALS['db']->fetchByAssoc($result);
			$bean_id = $row['id'];			
	    	$GLOBALS['log']->fatal("updating invoice ".$id);			
			$bean = BeanFactory::getBean('AOS_Invoices',$bean_id);   //update bean  using module name 						
		}
		else
		{			
	    	$GLOBALS['log']->fatal("creating invoice ".$id);			
			$bean = BeanFactory::newBean('AOS_Invoices');   //Create bean  using module name 
		}

		$bean->name = $name;
		$bean->invoice_date = $invoice_date;
		$bean->due_date = $due_date;		
		$bean->billing_contact_id = $customer_id;
		$bean->quickbooks_id = $qb_id;

		$bean->billing_address_street = $billing_address;
		$bean->billing_address_city = $billing_city;
		$bean->billing_address_state = $billing_state;
		$bean->billing_address_postalcode = $billing_pin;
		$bean->billing_address_country = $billing_country;

		$bean->shipping_address_street = $shipping_address;
		$bean->shipping_address_city = $shipping_city;
		$bean->shipping_address_state = $shipping_state;
		$bean->shipping_address_postalcode = $shipping_pin;
		$bean->shipping_address_country = $shipping_country;

		$bean->quote_number = $quote_number;
		$bean->tax_amount = $tax_amount;
		$bean->discount_amount = $discount_amount;
		$bean->total_amt = $subtotal_amount;
		$bean->subtotal_amount = $subtotal_amount-$discount_amount;
		$bean->total_amount = $total_amount;

		$bean->save();
		$record_id = $bean->id;
		
		//invoice relationship aos_products_quotes
		//deleting existing line item against this invoice
		$sql1 = "delete FROM aos_products_quotes where parent_id='".$bean_id."'";
	    $result = $GLOBALS['db']->query($sql1);		

		foreach ($products as $product) {
			$bean_pq = BeanFactory::newBean('AOS_Products_Quotes');
			$bean_pq->name = $product['product_name'];
			$bean_pq->product_list_price = $product['unit_price'];			
			$unit_price = isset($product['taxincludingrate']) ? $product['taxincludingrate'] : $product['unit_price'];
			$bean_pq->product_unit_price = $unit_price;
			$bean_pq->product_qty = $product['quantity'];
			$bean_pq->product_total_price = $product['amount'];
			$bean_pq->parent_type = 'AOS_Invoices';
			$bean_pq->vat = '0';
			$bean_pq->parent_id = $bean->id;
			$bean_pq->save();
			//echo $record_id;
		}
		return $record_id;
	}	
	

	function get_quickbooks_data($id,$module)
	{		
		$qb_company_id = $this->get_qb_company_id();
		$check_access = $this->check_access();
		$qb_api_url = $this->qb_api_url;		

		if(!$check_access)
		{
			$GLOBALS['log']->fatal("Access not available from get_quickbooks_data");
			return false;
		}

		$access_token = $this->get_access_token();

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, ''.$qb_api_url.'/v3/company/'.$qb_company_id.'/'.$module.'/'.$id.'?minorversion=4');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		$headers = array();
		$headers[] = 'Accept: application/json';
		$headers[] = 'Cache-Control: no-cache';
		$headers[] = 'Authorization: Bearer '.$access_token.'';
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

		$result = curl_exec($ch);		
		$res = json_decode($result,true);
		curl_close ($ch);
		return $res;
	}

	function create_contact_in_quickbooks($record_id)
	{			
		$qb_company_id = $this->get_qb_company_id();
		$check_access = $this->check_access();
		$qb_api_url = $this->qb_api_url;		

		if(!$check_access)
		{
			$GLOBALS['log']->fatal("Access not available from create create_contact_in_quickbooks");
			return false;
		}
		$access_token = $this->get_access_token();

		$bean = BeanFactory::getBean('Contacts',$record_id);    //update bean  using module name 
		//start code for send to QuickBooks"	
        $firstname = $bean->first_name; 
        $lastname = $bean->last_name;
        $companyname = $bean->account_name;
        $email = $bean->email1;    
        $phoneno = $bean->phone_work;
        $mobile = $bean->phone_mobile;
        $fax = $bean->phone_fax;
        $address = $bean->primary_address_street;
        $city = $bean->primary_address_city;
        $state = $bean->primary_address_state;
        $country = $bean->primary_address_country;
        $pincode = $bean->primary_address_postalcode;
        $fullyqualifiedname = $firstname." ".$lastname;
        $displayname = $firstname." ".$lastname; 
        $title = $bean->salutation;
        $address = preg_replace('#\s+#','',trim($address));
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, ''.$qb_api_url.'/v3/company/'.$qb_company_id.'/customer?minorversion=4');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "{\n    \"BillAddr\": {\n        \"Line1\": \"".$address."\",\n        \"City\": \"".$city."\",\n        \"Country\": \"".$country."\",\n        \"CountrySubDivisionCode\": \"".$state."\",\n        \"PostalCode\": \"".$pincode."\"\n    },\n    \"Title\": \"".$title."\",\n    \"GivenName\": \"".$firstname."\",\n    \"FamilyName\": \"".$lastname."\",\n    \"FullyQualifiedName\": \"".$fullyqualifiedname."\",\n    \"CompanyName\": \"".$companyname."\",\n    \"DisplayName\": \"".$displayname."\",\n    \"PrimaryPhone\": {\n        \"FreeFormNumber\": \"".$phoneno."\"\n    },\n    \"Mobile\": {\n        \"FreeFormNumber\": \"".$mobile."\"\n    },\n    \"Fax\": {\n        \"FreeFormNumber\": \"".$fax."\"\n    },\n    \"PrimaryEmailAddr\": {\n        \"Address\": \"".$email."\"\n    }\n}\n");    
        curl_setopt($ch, CURLOPT_POST, 1);

        $headers = array();
        $headers[] = 'Content-Type: application/json';
        $headers[] = 'Accept: application/json';
        $headers[] = 'Authorization: Bearer '.$access_token.'';
        $headers[] = 'Cache-Control: no-cache';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        $res = json_decode($result,true);
        $data = $res['Customer'];        
        
        $qb_id = $data['Id'];
        $bean->quickbooks_id = $qb_id;
        $bean->save();
        
        if (curl_errno($ch)) {
            echo 'Error:' . curl_error($ch);
        }
        curl_close ($ch);
        if(!$qb_id)
        {
        	return false;
        }
        return true;
        //end code for send to QuickBooks   
	}
}
