<?php

$dictionary["Account"]["fields"]['case_role'] = array (
      'name' => 'case_role',
      'type' => 'enum',
      'source' => 'non-db',
      'vname' => 'LBL_CASE_ACCOUNT_ROLE',
      'options' => 'relationship_to_case_list',
      'link' => 'accounts',
    );
