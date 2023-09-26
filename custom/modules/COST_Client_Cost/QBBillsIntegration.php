<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once("modules/ht_QuickBooks/QBAPIClient.php");

use QuickBooksOnline\API\Facades\Customer;
use QuickBooksOnline\API\Facades\Vendor;
use QuickBooksOnline\API\QueryFilter\QueryMessage;
use QuickBooksOnline\API\Facades\Bill as QBBill;
// Prep Data Services


class QBBillsIntegration
{
    
    function QBBillsOperations(&$bean, $event, $arguments){
		
		global $db;
		
		try{
			$qb_api_client = new QBAPIClient();
			$check_access = $qb_api_client->check_access();
			if(!$check_access)
			{
				SugarApplication::appendErrorMessage("Access not available from get_quickbooks_data");
				return false;
			}
			
			$qbDataService = $qb_api_client->getQBDataServiceObj();
			$account_id = $account_name = '';
			$type_list = array(
				'Postage_Shipping' => '92',
			);
			if(isset($type_list[$bean->type])){
				$account_id = $type_list[$bean->type];
			}
			
			// $customerBean = BeanFactory::getBean('Contacts', $bean->contact_id);
			
			$line_items[0] = [
				"Amount" => $bean->total_amount,
				// "Description" => $line['part_number'].' - '.$line['name'],
				"DetailType" => "AccountBasedExpenseLineDetail",
				"AccountBasedExpenseLineDetail" => [
					"AccountRef" => [
						// "name" => $account_name,
						"value" => $account_id
					],
					// "CustomerRef" => [
						// "name" => $customerBean->name,
						// "value" => $customerBean->quickbook_id
					// ],
				]
			];
			$vendorBean = BeanFactory::getBean('Accounts', $bean->account_id_c);
			if(empty($vendorBean->quickbook_id)){
				$vendorObj = array(
					"BillAddr" => array(
						"Line1" => $vendorBean->billing_address_street,
						"City" => $vendorBean->billing_address_city,
						"Country" => "USA",
						"CountrySubDivisionCode" => $vendorBean->billing_address_state,
						"PostalCode" => $vendorBean->billing_address_postalcode
					),
					"Notes" => $vendorBean->description,
					// "Title" => "Mr",
					"GivenName" => $vendorBean->name,
					// "MiddleName" => "B",
					"FamilyName" => $vendorBean->name,
					// "Suffix" => "Jr",
					"FullyQualifiedName" => $vendorBean->name,
					// "CompanyName" => "King Groceries",
					"DisplayName" => $vendorBean->name,
					"PrimaryPhone" => array(
						"FreeFormNumber" => $vendorBean->phone_office
					),
					"PrimaryEmailAddr" => array(
						"Address" => $vendorBean->email1
					)
				);
				$theResourceObj = Vendor::create($vendorObj);
				$resultingObj = $qbDataService->Add($theResourceObj);
				$vendorBean->quickbook_id = $resultingObj->Id;
				$vendorBean->save();
			}
			$bill_data = [
				"Line" => $line_items,
				"DocNumber" => $bean->invoice_number,
				
				"VendorRef" => [
					"name" => $vendorBean->name,
					"value" => $vendorBean->quickbook_id,
				],
				"PrivateNote" => $bean->name
				// "APAccountRef" => [
					// "name" => $account_name,
					// "value" => $account_id,
				// ],
			];
				
			
			if(!empty($bean->quickbook_id)){
				$bill = $qbDataService->FindbyId('bill', $bean->quickbook_id);
				$theResourceObj = QBBill::update($bill  , $bill_data);
				$resultingObj = $qbDataService->Update($theResourceObj);
			}else{
				$theResourceObj = QBBill::create($bill_data);
				$resultingObj = $qbDataService->Add($theResourceObj);
			}
			$bean->quickbook_id = $resultingObj->Id;
		}catch(Exception $e) {
			SugarApplication::appendErrorMessage('QB Error Message: '.$e->getMessage());
		}
	}
	function QBCustomerDeleteOperation($bean, $event, $arguments){
		
		if(!empty($bean->quickbook_id)){
			try{
				$qb_api_client = new QBAPIClient();
				$qbDataService = $qb_api_client->getQBDataServiceObj();
				$customer = $qbDataService->FindbyId('customer', $bean->quickbook_id);
				$theResourceObj = Customer::update($customer  , [
						"Active" => false
				]);
				$resultingObj = $qbDataService->Update($theResourceObj);
			}catch(Exception $e) {
				SugarApplication::appendErrorMessage('QB Error Message: '.$e->getMessage());
			}
		}
	}
    
}
