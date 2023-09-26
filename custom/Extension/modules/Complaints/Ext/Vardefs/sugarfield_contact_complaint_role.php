<?php

 $dictionary["Complaint"]["fields"]['contact_role'] = array (
      'name' => 'contact_role',
      'type' => 'enum',
      'source' => 'non-db',
      'vname' => 'LBL_CONTACT_COMPLAINT_ROLE',
      'options' => 'relationship_to_complaint_list',
      'link' => 'contacts',
    );
