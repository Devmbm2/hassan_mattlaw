<?php
$custom_queries = array();
$custom_queries_list = array();
$custom_queries_list['Cases'][] = 'injured_person_running_bills';
$custom_queries_list['Cases'][] = 'injured_person_running_bills_pip';
$custom_queries_list['Cases'][] = 'injured_person_medical_providers';
$custom_queries_list['Cases'][] = 'related_drivers_cases';
$custom_queries_list['Cases'][] = 'related_um_carrier_cases';
$custom_queries_list['Cases'][] = 'related_owners_cases';
$custom_queries_list['Cases'][] = 'related_employers_cases';
$accounts_contacts_union = "SELECT
		a.id,
		a. name,
		CONCAT(
			a.`billing_address_street`,
			' ',
			a.billing_address_city,
			' ',
			a.billing_address_state,
			' ',
			a.billing_address_postalcode
		) AS address,
		a.phone_office AS phone,
		'' AS birthdate,
		'' AS drivers_license_c
	FROM
		accounts a
	INNER JOIN accounts_cases ac ON (
		ac.account_id = a.id
		AND ac.deleted = 0
	)
	INNER JOIN cases c ON (
		ac.case_id = c.id
		AND c.deleted = 0
	)
	WHERE
		a.deleted = 0
	AND c.id = '{$this->bean_datos->id}'

	UNION 
	
	SELECT
		c.id,
		CONCAT(c.first_name,' ', c.last_name) AS name,
		CONCAT(
			c.`primary_address_street`,
			' ',
			c.primary_address_city,
			' ',
			c.primary_address_state,
			' ',
			c.primary_address_postalcode
		) AS address,
		c.phone_work AS phone,
		c.birthdate,
		c.drivers_license_c
	FROM
		contacts c
	INNER JOIN contacts_cases cc ON (
		cc.contact_id = c.id
		AND cc.deleted = 0
	)
	INNER JOIN cases ca ON (
		cc.case_id = ca.id
		AND c.deleted = 0
	)
	WHERE
		c.deleted = 0
	AND ca.id = '{$this->bean_datos->id}' ";
$custom_queries['related_drivers_cases'] = " SELECT
		c.id,
		CONCAT(c.first_name,' ', c.last_name) AS name,
		CONCAT(
			c.`primary_address_street`,
			' ',
			c.primary_address_city,
			' ',
			c.primary_address_state,
			' ',
			c.primary_address_postalcode
		) AS address,
		c.phone_work AS phone,
		c.birthdate,
		c.drivers_license_c
	FROM
		contacts c
	INNER JOIN contacts_cases cc ON (
		cc.contact_id = c.id
		AND cc.deleted = 0
	)
	INNER JOIN cases ca ON (
		cc.case_id = ca.id
		AND c.deleted = 0
	)
	WHERE
		c.deleted = 0
	AND ca.id = '{$this->bean_datos->id}' ";
$custom_queries['related_um_carrier_cases'] = "SELECT
		a.id,
		a. name,
		CONCAT(
			a.`billing_address_street`,
			' ',
			a.billing_address_city,
			' ',
			a.billing_address_state,
			' ',
			a.billing_address_postalcode
		) AS address,
		a.phone_office AS phone,
		'' AS birthdate,
		'' AS drivers_license_c
	FROM
		accounts a
	INNER JOIN accounts_cases ac ON (
		ac.account_id = a.id
		AND ac.deleted = 0
	)
	INNER JOIN cases c ON (
		ac.case_id = c.id
		AND c.deleted = 0
	)
	WHERE
		a.deleted = 0
	AND c.id = '{$this->bean_datos->id}'";
$custom_queries['related_owners_cases'] = $accounts_contacts_union;
$custom_queries['related_employers_cases'] = $accounts_contacts_union;
$custom_queries['injured_person_running_bills'] = "
	SELECT FORMAT(mdb.balance,2) AS balance, FORMAT(mdb.reduction_amount,2) AS reduced_to, acc.`name` AS medical_provider, acc.`name`, acc.`id`
	FROM
		medb_medical_bills_contacts_c  mdb_cnt
	INNER JOIN medb_medical_bills  mdb ON (mdb.id = mdb_cnt.medb_medical_bills_contactsmedb_medical_bills_idb AND mdb.deleted = 0)
	INNER JOIN accounts acc ON (acc.id = mdb.account_id_c AND acc.deleted = 0)
	WHERE
		mdb_cnt.deleted = 0 AND mdb_cnt.medb_medical_bills_contactscontacts_ida = '{$this->bean_datos->contact_id2_c}' ";
$custom_queries['injured_person_running_bills_pip'] = "
	SELECT FORMAT(mdb.balance,2) AS balance, FORMAT(mdb.reduction_amount,2) AS reduced_to, acc.`name` AS medical_provider, acc.`name`, acc.`id`, mdb.claim_number 
	FROM
		medb_medical_bills_contacts_c  mdb_cnt
	INNER JOIN medb_medical_bills  mdb ON (mdb.id = mdb_cnt.medb_medical_bills_contactsmedb_medical_bills_idb AND mdb.deleted = 0)
	INNER JOIN accounts acc ON (acc.id = mdb.account_id_c AND acc.deleted = 0)
	LEFT JOIN medb_medical_bills_cstm mdbc ON (mdbc.id_c = mdb.id)
	WHERE
		mdb_cnt.deleted = 0 AND mdb_cnt.medb_medical_bills_contactscontacts_ida = '{$this->bean_datos->contact_id2_c}' 
		 AND mdbc.type_c = 'PIP' ";
		
$custom_queries['injured_person_medical_providers'] = "
	SELECT
		acc.`id`,
		acc.`name`,
		acc.`name` AS medical_provider,
		acc.`phone_office` AS phone_office,
		CONCAT(
			acc.`billing_address_street`,
			' ',
			acc.billing_address_city,
			' ',
			acc.billing_address_state,
			' ',
			acc.billing_address_postalcode
		) AS address
	FROM
		contacts_medp_medical_providers_1_c mdp_cnt
	INNER JOIN medp_medical_providers  mdp ON (mdp.id = mdp_cnt.contacts_medp_medical_providers_1medp_medical_providers_idb AND mdp.deleted = 0)
	INNER JOIN accounts acc ON (
		acc.id = mdp.account_id_c
		AND acc.deleted = 0
	)
	WHERE
		mdp_cnt.deleted = 0
	AND mdp_cnt.contacts_medp_medical_providers_1contacts_ida = '{$this->bean_datos->contact_id2_c}' ";
	