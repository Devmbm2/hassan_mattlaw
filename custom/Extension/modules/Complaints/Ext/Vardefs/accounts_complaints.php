<?php
$dictionary['Complaint']['fields']['accounts'] = array (
			'name' => 'accounts',
            'type' => 'link',
            'relationship' => 'account_complaints',
            'module' => 'Accounts',
            'bean_name' => 'Account',
            'source' => 'non-db',
            'vname' => 'LBL_ACCOUNTS',
);
$dictionary['Complaint']['fields']['injured_person_running_bills'] = array (
	'name' => 'injured_person_running_bills',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_INJURED_PERSON_RUNNING_BILLS',
);
$dictionary['Complaint']['fields']['injured_person_medical_providers'] = array (
	'name' => 'injured_person_medical_providers',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_INJURED_PERSON_MEDICAL_PROVIDERS',
);
$dictionary['Complaint']['fields']['injured_person_running_bills_pip'] = array (
	'name' => 'injured_person_running_bills_pip',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_INJURED_PERSON_RUNNING_BILLS_PIP',
);

$dictionary['Complaint']['fields']['related_drivers_complaints'] = array (
	'name' => 'related_drivers_complaints',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_RELATED_DRIVERS_COMPLAINTS',
);

$dictionary['Complaint']['fields']['related_owners_complaints'] = array (
	'name' => 'related_owners_complaints',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_RELATED_OWNERS_COMPLAINTS',
);
$dictionary['Complaint']['fields']['related_employers_complaints'] = array (
	'name' => 'related_employers_complaints',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_RELATED_EMPLOYERS_COMPLAINTS',
);

$dictionary['Complaint']['fields']['related_um_carrier_complaints'] = array (
	'name' => 'related_um_carrier_complaints',
	'type' => 'function',
	'source' => 'non-db',
	'vname' => 'LBL_RELATED_UM_CARRIER_COMPLAINTS',
);


