<?php

$bean = BeanFactory::newBean('Documents');
$relation_name = 'medb_medical_bills_documents_reductions';
var_dump($bean->load_relationship($relation_name));
