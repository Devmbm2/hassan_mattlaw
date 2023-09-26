<?php
require_once 'modules/AOP_Case_Updates/CaseUpdatesHook.php';
class custom_CaseUpdatesHook extends CaseUpdatesHook {
    public function assignAccount($case, $event, $arguments)
      {   
       
        if ($arguments['module'] !== 'Cases' || $arguments['related_module'] !== 'Contacts') {
            return;
        }
        if (!isAOPEnabled()) {
            return;
        }
        $contact = BeanFactory::getBean('Contacts', $arguments['related_id']);
        if ($contact) {
            $contact->load_relationship('accounts');
        }
        if (!$contact || !$contact->account_id) {
            return;
        }
        $this->linkAccountAndCase($case->id, $contact->account_id);
    }
}