<?php
$viewdefs ['Employees'] = 
array (
  'DetailView' => 
  array (
    'templateMeta' => 
    array (
      'form' => 
      array (
        'buttons' => 
        array (
          0 => 
          array (
            'customCode' => '{if $DISPLAY_EDIT}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button" onclick="this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'EditView\'" type="submit" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_EDIT_BUTTON_LABEL}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_EDIT_BUTTON_TITLE}',
                'accessKey' => '{$APP.LBL_EDIT_BUTTON_KEY}',
                'class' => 'button',
                'onclick' => 'this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'EditView\';',
                'id' => 'edit_button',
                'name' => 'Edit',
              ),
              'template' => '{if $DISPLAY_EDIT}[CONTENT]{/if}',
            ),
          ),
          1 => 
          array (
            'customCode' => '{if $DISPLAY_DUPLICATE}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="this.form.return_module.value=\'{$module}\'     ; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.isDuplicate.value=true; this.form.action.value=\'EditView\'" type="submit" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if}',
            'sugar_html' => 
            array (
              'type' => 'submit',
              'value' => '{$APP.LBL_DUPLICATE_BUTTON_LABEL}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_DUPLICATE_BUTTON_TITLE}',
                'accessKey' => '{$APP.LBL_DUPLICATE_BUTTON_KEY}',
                'class' => 'button',
                'onclick' => 'this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.isDuplicate.value=true; this.form.action.value=\'EditView\';',
                'name' => 'Duplicate',
                'id' => 'duplicate_button',
              ),
              'template' => '{if $DISPLAY_DUPLICATE}[CONTENT]{/if}',
            ),
          ),
          2 => 
          array (
            'customCode' => '{if $DISPLAY_DELETE}<input title="{$APP.LBL_DELETE_BUTTON_LABEL}" accessKey="{$APP.LBL_DELETE_BUTTON_LABEL}" class="button" onclick="if( confirm(\'{$DELETE_WARNING}\') ) {ldelim} this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'index\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'delete\'; this.form.submit();{rdelim}" type="button" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if}',
            'sugar_html' => 
            array (
              'type' => 'button',
              'value' => '{$APP.LBL_DELETE_BUTTON_LABEL}',
              'htmlOptions' => 
              array (
                'title' => '{$APP.LBL_DELETE_BUTTON_LABEL}',
                'accessKey' => '{$APP.LBL_DELETE_BUTTON_LABEL}',
                'class' => 'button',
                'onclick' => 'if( confirm(\'{$DELETE_WARNING}\') ) {ldelim} this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'index\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'delete\'; this.form.submit();{rdelim}',
                'name' => 'Delete',
                'id' => 'delete_button',
              ),
              'template' => '{if $DISPLAY_DELETE}[CONTENT]{/if}',
            ),
          ),
        ),
      ),
      'maxColumns' => '2',
      'widths' => 
      array (
        0 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
        1 => 
        array (
          'label' => '10',
          'field' => '30',
        ),
      ),
      'useTabs' => true,
      'tabDefs' => 
      array (
        'DEFAULT' => 
        array (
          'newTab' => true,
          'panelDefault' => 'expanded',
        ),
      ),
    ),
    'panels' => 
    array (
      'default' => 
      array (
        0 => 
        array (
          0 => 'employee_status',
          1 => 'title',
        ),
        1 => 
        array (
          0 => 
          array (
            'name' => 'first_name',
            'label' => 'LBL_FIRST_NAME',
          ),
          1 => 
          array (
            'name' => 'last_name',
            'label' => 'LBL_LAST_NAME',
          ),
        ),
        2 => 
        array (
          0 => 'phone_work',
          1 => 'phone_mobile',
        ),
        3 => 
        array (
          0 => 
          array (
            'name' => 'address_street',
            'label' => 'LBL_ADDRESS_STREET',
          ),
          1 => 
          array (
            'name' => 'address_city',
            'label' => 'LBL_ADDRESS_CITY',
          ),
        ),
        4 => 
        array (
          0 => 'email1',
          1 => 
          array (
            'name' => 'initials_c',
            'label' => 'LBL_INITIALS',
          ),
        ),
        5 => 
        array (
          0 => 
          array (
            'name' => 'address_state',
            'label' => 'LBL_ADDRESS_STATE',
          ),
          1 => 
          array (
            'name' => 'address_postalcode',
            'label' => 'LBL_ADDRESS_POSTALCODE',
          ),
        ),
        6 => 
        array (
          0 => 
          array (
            'name' => 'atty_bar_number_c',
            'label' => 'LBL_ATTY_BAR_NUMBER',
          ),
          1 => 
          array (
            'name' => 'attorney_signature_c',
            'studio' => 'visible',
            'label' => 'LBL_ATTORNEY_SIGNATURE',
          ),
        ),
        7 => 
        array (
          0 => 'description',
        ),
      ),
    ),
  ),
);
$viewdefs['Employees']['DetailView']['templateMeta'] = array (
  'form' => 
  array (
    'buttons' => 
    array (
      0 => 
      array (
        'customCode' => '{if $DISPLAY_EDIT}<input title="{$APP.LBL_EDIT_BUTTON_TITLE}" accessKey="{$APP.LBL_EDIT_BUTTON_KEY}" class="button" onclick="this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'EditView\'" type="submit" name="Edit" id="edit_button" value="{$APP.LBL_EDIT_BUTTON_LABEL}">{/if}',
        'sugar_html' => 
        array (
          'type' => 'submit',
          'value' => '{$APP.LBL_EDIT_BUTTON_LABEL}',
          'htmlOptions' => 
          array (
            'title' => '{$APP.LBL_EDIT_BUTTON_TITLE}',
            'accessKey' => '{$APP.LBL_EDIT_BUTTON_KEY}',
            'class' => 'button',
            'onclick' => 'this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'EditView\';',
            'id' => 'edit_button',
            'name' => 'Edit',
          ),
          'template' => '{if $DISPLAY_EDIT}[CONTENT]{/if}',
        ),
      ),
      1 => 
      array (
        'customCode' => '{if $DISPLAY_DUPLICATE}<input title="{$APP.LBL_DUPLICATE_BUTTON_TITLE}" accessKey="{$APP.LBL_DUPLICATE_BUTTON_KEY}" class="button" onclick="this.form.return_module.value=\'{$module}\'     ; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.isDuplicate.value=true; this.form.action.value=\'EditView\'" type="submit" name="Duplicate" value="{$APP.LBL_DUPLICATE_BUTTON_LABEL}" id="duplicate_button">{/if}',
        'sugar_html' => 
        array (
          'type' => 'submit',
          'value' => '{$APP.LBL_DUPLICATE_BUTTON_LABEL}',
          'htmlOptions' => 
          array (
            'title' => '{$APP.LBL_DUPLICATE_BUTTON_TITLE}',
            'accessKey' => '{$APP.LBL_DUPLICATE_BUTTON_KEY}',
            'class' => 'button',
            'onclick' => 'this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'DetailView\'; this.form.return_id.value=\'{$id}\'; this.form.isDuplicate.value=true; this.form.action.value=\'EditView\';',
            'name' => 'Duplicate',
            'id' => 'duplicate_button',
          ),
          'template' => '{if $DISPLAY_DUPLICATE}[CONTENT]{/if}',
        ),
      ),
      2 => 
      array (
        'customCode' => '{if $DISPLAY_DELETE}<input title="{$APP.LBL_DELETE_BUTTON_LABEL}" accessKey="{$APP.LBL_DELETE_BUTTON_LABEL}" class="button" onclick="if( confirm(\'{$DELETE_WARNING}\') ) {ldelim} this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'index\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'delete\'; this.form.submit();{rdelim}" type="button" name="Delete" value="{$APP.LBL_DELETE_BUTTON_LABEL}" id="delete_button">{/if}',
        'sugar_html' => 
        array (
          'type' => 'button',
          'value' => '{$APP.LBL_DELETE_BUTTON_LABEL}',
          'htmlOptions' => 
          array (
            'title' => '{$APP.LBL_DELETE_BUTTON_LABEL}',
            'accessKey' => '{$APP.LBL_DELETE_BUTTON_LABEL}',
            'class' => 'button',
            'onclick' => 'if( confirm(\'{$DELETE_WARNING}\') ) {ldelim} this.form.return_module.value=\'{$module}\'; this.form.return_action.value=\'index\'; this.form.return_id.value=\'{$id}\'; this.form.action.value=\'delete\'; this.form.submit();{rdelim}',
            'name' => 'Delete',
            'id' => 'delete_button',
          ),
          'template' => '{if $DISPLAY_DELETE}[CONTENT]{/if}',
        ),
      ),
    ),
  ),
  'maxColumns' => '2',
  'widths' => 
  array (
    0 => 
    array (
      'label' => '10',
      'field' => '30',
    ),
    1 => 
    array (
      'label' => '10',
      'field' => '30',
    ),
  ),
  'useTabs' => true,
  'tabDefs' => 
  array (
    'DEFAULT' => 
    array (
      'newTab' => true,
      'panelDefault' => 'expanded',
    ),
  ),
);
?>
