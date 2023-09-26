<?php
$dictionary['Case']['fields']['accounts'] = array (
			'name' => 'accounts',
            'type' => 'link',
            'relationship' => 'account_cases',
            'module' => 'Accounts',
            'bean_name' => 'Account',
            'source' => 'non-db',
            'vname' => 'LBL_ACCOUNTS',
);
$dictionary['Case']['fields']['injured_person_running_bills'] = array (
	'name' => 'injured_person_running_bills',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_INJURED_PERSON_RUNNING_BILLS',
);
$dictionary['Case']['fields']['injured_person_medical_providers'] = array (
	'name' => 'injured_person_medical_providers',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_INJURED_PERSON_MEDICAL_PROVIDERS',
);
$dictionary['Case']['fields']['injured_person_running_bills_pip'] = array (
	'name' => 'injured_person_running_bills_pip',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_INJURED_PERSON_RUNNING_BILLS_PIP',
);

$dictionary['Case']['fields']['related_drivers_cases'] = array (
	'name' => 'related_drivers_cases',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_RELATED_DRIVERS_CASES',
);

$dictionary['Case']['fields']['related_owners_cases'] = array (
	'name' => 'related_owners_cases',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_RELATED_OWNERS_CASES',
);
$dictionary['Case']['fields']['related_employers_cases'] = array (
	'name' => 'related_employers_cases',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_RELATED_EMPLOYERS_CASES',
);

$dictionary['Case']['fields']['related_um_carrier_cases'] = array (
	'name' => 'related_um_carrier_cases',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_RELATED_UM_CARRIER_CASES',
);


