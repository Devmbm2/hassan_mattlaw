<?php

/**
* The $objectList array, maps the module name to the Vardef property
* By default only a few core modules have this defined, since their Class/Object names differs from their Vardef Property
**/
$objectList['Contacts'] = 'Contact';

// $beanList maps the Bean/Module name to the Class name
$beanList['Contacts'] = 'CustomContact';

// $beanFiles maps the Class name to the PHP Class file
$beanFiles['CustomContact'] = 'custom/modules/Contacts/CustomContact.php';