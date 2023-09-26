<?php
/**
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.
 *
 * SuiteCRM is an extension to SugarCRM Community Edition developed by SalesAgility Ltd.
 * Copyright (C) 2011 - 2016 SalesAgility Ltd.
 *
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU Affero General Public License version 3 as published by the
 * Free Software Foundation with the addition of the following permission added
 * to Section 15 as permitted in Section 7(a): FOR ANY PART OF THE COVERED WORK
 * IN WHICH THE COPYRIGHT IS OWNED BY SUGARCRM, SUGARCRM DISCLAIMS THE WARRANTY
 * OF NON INFRINGEMENT OF THIRD PARTY RIGHTS.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS
 * FOR A PARTICULAR PURPOSE.  See the GNU Affero General Public License for more
 * details.
 *
 * You should have received a copy of the GNU Affero General Public License along with
 * this program; if not, see http://www.gnu.org/licenses or write to the Free
 * Software Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA
 * 02110-1301 USA.
 *
 * You can contact SugarCRM, Inc. headquarters at 10050 North Wolfe Road,
 * SW2-130, Cupertino, CA 95014, USA. or at email address contact@sugarcrm.com.
 *
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU Affero General Public License version 3.
 *
 * In accordance with Section 7(b) of the GNU Affero General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * SugarCRM" logo and "Supercharged by SuiteCRM" logo. If the display of the logos is not
 * reasonably feasible for  technical reasons, the Appropriate Legal Notices must
 * display the words  "Powered by SugarCRM" and "Supercharged by SuiteCRM".
 */
require_once 'util.php';

/**
 * Class ComplaintUpdatesHook
 */
class ComplaintUpdatesHook
{
    private $slug_size = 50;

    /**
     * @return string
     */
    private function getAssignToUser()
    {
        require_once 'modules/AOP_Complaint_Updates/AOPAssignManager.php';
        $assignManager = new AOPAssignManager();

        return $assignManager->getNextAssignedUser();
    }

    /**
     * @return int
     */
    private function arrangeFilesArray()
    {
        $count = 0;
        foreach ($_FILES['complaint_update_file'] as $key => $vals) {
            foreach ($vals as $index => $val) {
                if (!array_key_exists('complaint_update_file' . $index, $_FILES)) {
                    $_FILES['complaint_update_file' . $index] = array();
                    ++$count;
                }
                $_FILES['complaint_update_file' . $index][$key] = $val;
            }
        }

        return $count;
    }

    /**
     * @param aComplaint $complaint
     */
    public function saveUpdate($complaint)
    {
        if (!isAOPEnabled()) {
            return;
        }
        global $current_user, $app_list_strings;
        if (empty($complaint->fetched_row) || !$complaint->id) {
            if (!$complaint->state) {
                $complaint->state = $app_list_strings['complaint_state_default_key'];
            }
            if ($complaint->status === 'New') {
                $complaint->status = $app_list_strings['complaint_status_default_key'];
            }

            //New complaint - assign
            if (!$complaint->assigned_user_id) {
                $userId = $this->getAssignToUser();
                $complaint->assigned_user_id = $userId;
                $complaint->notify_inworkflow = true;
            }

            return;
        }
        if ($_REQUEST['module'] === 'Import') {
            return;
        }
        //Grab the update field and create a new update with it.
        $text = $complaint->update_text;
        if (!$text && empty($_FILES['complaint_update_file'])) {
            //No text or files, so nothing really to save.
            return;
        }
        $complaint->update_text = '';
        $complaint_update = new AOP_Complaint_Updates();
        $complaint_update->name = $text;
        $complaint_update->internal = $complaint->internal;
        $complaint->internal = false;
        $complaint_update->assigned_user_id = $current_user->id;
        if (strlen($text) > $this->slug_size) {
            $complaint_update->name = substr($text, 0, $this->slug_size) . '...';
        }
        $complaint_update->description = nl2br($text);
        $complaint_update->complaint_id = $complaint->id;
        $complaint_update->save();

        $fileCount = $this->arrangeFilesArray();

        for ($x = 0; $x < $fileCount; ++$x) {
            if ($_FILES['complaint_update_file']['error'][$x] === UPLOAD_ERR_NO_FILE) {
                continue;
            }
            $uploadFile = new UploadFile('complaint_update_file' . $x);
            if (!$uploadFile->confirm_upload()) {
                continue;
            }
            $note = $this->newNote($complaint_update->id);
            $note->name = $uploadFile->get_stored_file_name();
            $note->file_mime_type = $uploadFile->mime_type;
            $note->filename = $uploadFile->get_stored_file_name();
            $note->save();
            $uploadFile->final_move($note->id);
        }
        $postPrefix = 'complaint_update_id_';
        foreach ($_POST as $key => $val) {
            if (empty($val) || strpos($key, $postPrefix) !== 0) {
                continue;
            }
            //Val is selected doc id
            $doc = BeanFactory::getBean('Documents', $val);
            if (!$doc) {
                continue;
            }
            $note = $this->newNote($complaint_update->id);
            $note->name = $doc->document_name;
            $note->file_mime_type = $doc->last_rev_mime_type;
            $note->filename = $doc->filename;
            $note->save();
            $srcFile = "upload://{$doc->document_revision_id}";
            $destFile = "upload://{$note->id}";
            copy($srcFile, $destFile);
        }
    }

    /**
     * @param $complaintUpdateId
     *
     * @return Note
     */
    private function newNote($complaintUpdateId)
    {
        $note = BeanFactory::newBean('Notes');
        $note->parent_type = 'AOP_Complaint_Updates';
        $note->parent_id = $complaintUpdateId;
        $note->not_use_rel_in_req = true;

        return $note;
    }

    /**
     * @param $complaint_id
     * @param $account_id
     */
    private function linkAccountAndComplaint($complaint_id, $account_id)
    {
        if (!$account_id || !$complaint_id) {
            return;
        }
        $complaint = BeanFactory::getBean('Complaints', $complaint_id);
        if (!$complaint->account_id) {
            $complaint->account_id = $account_id;
            $complaint->save();
        }
    }

    /**
     * @param aComplaint $complaint
     * @param $event
     * @param $arguments
     */
    public function assignAccount($complaint, $event, $arguments)
    {
        if ($arguments['module'] !== 'Complaints' || $arguments['related_module'] !== 'Contacts') {
            return;
        }
        if (!isAOPEnabled()) {
            return;
        }
        $contact = BeanFactory::getBean('Contacts', $arguments['related_id']);
        $contact->load_relationship('accounts');
        if (!$contact || !$contact->account_id) {
            return;
        }
        $this->linkAccountAndComplaint($complaint->id, $contact->account_id);
    }

    /**
     * Called when saving a new email and adds the complaint update to the complaint.
     *
     * @param Email $email
     */
    public function saveEmailUpdate($email)
    {
        if ($email->intent !== 'createcomplaint' || $email->parent_type !== 'Complaints') {
            $GLOBALS['log']->warn('ComplaintUpdatesHook: saveEmailUpdate: Not a create complaint or wrong parent type');

            return;
        }
        if (!isAOPEnabled()) {
            return;
        }
        if (!$email->parent_id) {
            $GLOBALS['log']->warn('ComplaintUpdatesHook: saveEmailUpdate No parent id');

            return;
        }

        if ($email->complaints) {
            $GLOBALS['log']->warn('ComplaintUpdatesHook: saveEmailUpdate complaints already set');

            return;
        }

        if ($email->fetched_row['parent_id']) {
            //Will have been processed already
            return;
        }

        $ea = new SugarEmailAddress();
        $beans = $ea->getBeansByEmailAddress($email->from_addr);
        $contact_id = null;
        foreach ($beans as $emailBean) {
            if ($emailBean->module_name === 'Contacts' && !empty($emailBean->id)) {
                $contact_id = $emailBean->id;
                $this->linkAccountAndComplaint($email->parent_id, $emailBean->account_id);
            }
        }
        $complaintUpdate = new AOP_Complaint_Updates();
        $complaintUpdate->name = $email->name;
        $complaintUpdate->contact_id = $contact_id;
        $updateText = $this->unquoteEmail($email->description_html ? $email->description_html : $email->description);
        $complaintUpdate->description = $updateText;
        $complaintUpdate->internal = false;
        $complaintUpdate->complaint_id = $email->parent_id;
        $complaintUpdate->save();
        $notes = $email->get_linked_beans('notes', 'Notes');
        foreach ($notes as $note) {
            //Link notes to complaint update also
            $newNote = BeanFactory::newBean('Notes');
            $newNote->name = $note->name;
            $newNote->file_mime_type = $note->file_mime_type;
            $newNote->filename = $note->filename;
            $newNote->parent_type = 'AOP_Complaint_Updates';
            $newNote->parent_id = $complaintUpdate->id;
            $newNote->save();
            $srcFile = "upload://{$note->id}";
            $destFile = "upload://{$newNote->id}";
            copy($srcFile, $destFile);
        }

        $this->updateComplaintStatus($complaintUpdate->complaint_id);
    }

    /**
     * Changes the status of the supplied complaint based on the complaint_status_changes config values.
     *
     * @param $complaintId
     */
    private function updateComplaintStatus($complaintId)
    {
        global $sugar_config;
        if (empty($complaintId) || empty($sugar_config['aop']['complaint_status_changes'])) {
            return;
        }
        $statusMap = json_decode($sugar_config['aop']['complaint_status_changes'], 1);
        if (empty($statusMap)) {
            return;
        }
        $complaint = BeanFactory::getBean('Complaints', $complaintId);
        if (!empty($complaint->id)) {
            return;
        }
        if (array_key_exists($complaint->status, $statusMap)) {
            $complaint->status = $statusMap[$complaint->status];
            $statusBits = explode('_', $complaint->status);
            $complaint->state = array_shift($statusBits);
            $complaint->save();
        }
    }

    /**
     * @param $text
     *
     * @return mixed|string
     */
    private function unquoteEmail($text)
    {
        global $app_strings;
        $text = html_entity_decode($text);
        $text = preg_replace('/(\r\n|\r|\n)/s', "\n", $text);
        $pos = strpos($text, $app_strings['LBL_AOP_EMAIL_REPLY_DELIMITER']);
        if ($pos !== false) {
            $text = substr($text, 0, $pos);
        }

        return $text;
    }

    /**
     * @param aComplaint $complaint
     */
    public function closureNotifyPrep($complaint)
    {
        if (isset($_REQUEST['module']) && $_REQUEST['module'] === 'Import') {
            return;
        }
        $complaint->send_closure_email = true;
        if ($complaint->state !== 'Closed' || $complaint->fetched_row['state'] === 'Closed') {
            $complaint->send_closure_email = false;
        }
    }

    /**
     * @param aComplaint $complaint
     */
    public function closureNotify($complaint)
    {
        if (isset($_REQUEST['module']) && $_REQUEST['module'] === 'Import') {
            return;
        }
        if ($complaint->state !== 'Closed' || !$complaint->send_closure_email) {
            return;
        }
        $this->sendClosureEmail($complaint);
    }

    /**
     * @param aComplaint $complaint
     *
     * @return bool
     */
    private function sendClosureEmail(aComplaint $complaint)
    {
        if (!isAOPEnabled()) {
            return true;
        }
        $GLOBALS['log']->warn('ComplaintUpdatesHook: sendClosureEmail called');
        require_once 'include/SugarPHPMailer.php';
        $mailer = new SugarPHPMailer();
        $admin = new Administration();
        $admin->retrieveSettings();

        $mailer->prepForOutbound();
        $mailer->setMailerForSystem();

        $emailTemplate = new EmailTemplate();
        $aop_config = $this->getAOPConfig();
        $emailTemplate->retrieve($aop_config['complaint_closure_email_template_id']);

        if (!$emailTemplate) {
            $GLOBALS['log']->warn('ComplaintUpdatesHook: sendClosureEmail template is empty');

            return false;
        }

        $contact = $complaint->get_linked_beans('contacts', 'Contact');
        if ($contact) {
            $contact = $contact[0];
        } else {
            return false;
        }

        $emailSettings = getPortalEmailSettings();

        $text = $this->populateTemplate($emailTemplate, $complaint, $contact);
        $mailer->Subject = $text['subject'];
        $mailer->Body = $text['body'];
        $mailer->isHTML(true);
        $mailer->AltBody = $text['body_alt'];
        $mailer->From = $emailSettings['from_address'];
        $mailer->FromName = $emailSettings['from_name'];

        $email = $contact->emailAddress->getPrimaryAddress($contact);

        $mailer->addAddress($email);

        try {
            if ($mailer->send()) {
                $this->logEmail($email, $mailer, $complaint->id);

                return true;
            }
        } catch (phpmailerException $exception) {
            $GLOBALS['log']->fatal('ComplaintUpdatesHook: sending email Failed:  ' . $exception->getMessage());
        }

        $GLOBALS['log']->info('ComplaintUpdatesHook: Could not send email:  ' . $mailer->ErrorInfo);

        return false;
    }

    /**
     * Called by the after_relationship_save logic hook in complaints. Checks to ensure this is a
     * contact being added and sends an email to that contact.
     *
     * @param $bean
     * @param $event
     * @param $arguments
     */
    public function creationNotify($bean, $event, $arguments)
    {
        if (isset($_REQUEST['module']) && $_REQUEST['module'] === 'Import') {
            return;
        }
        if ($arguments['module'] !== 'Complaints' || $arguments['related_module'] !== 'Contacts') {
            return;
        }
        if (!$bean->fetched_row) {
            return;
        }
        if (!empty($arguments['related_bean'])) {
            $contact = $arguments['related_bean'];
        } else {
            $contact = BeanFactory::getBean('Contacts', $arguments['related_id']);
        }
        $this->sendCreationEmail($bean, $contact);
    }

    /**
     * @param EmailTemplate $template
     * @param aComplaint $bean
     * @param $contact
     *
     * @return array
     */
    private function populateTemplate(EmailTemplate $template, aComplaint $bean, $contact)
    {
        global $app_strings, $sugar_config;
        //Order of beans seems to matter here so we place contact first.
        $beans = array(
            'Contacts' => $contact->id,
            'Complaints'    => $bean->id,
            'Users'    => $bean->assigned_user_id,
        );
        $ret = array();
        $ret['subject'] = from_html(aop_parse_template($template->subject, $beans));
        $ret['body'] = from_html(
            $app_strings['LBL_AOP_EMAIL_REPLY_DELIMITER'] . aop_parse_template(
                str_replace(
                    '$sugarurl',
                    $sugar_config['site_url'],
                    $template->body_html
                ),
                $beans
            )
        );
        $ret['body_alt'] = strip_tags(
            from_html(
                aop_parse_template(
                    str_replace(
                        '$sugarurl',
                        $sugar_config['site_url'],
                        $template->body
                    ),
                    $beans
                )
            )
        );

        return $ret;
    }

    /**
     * @return array
     */
    private function getAOPConfig()
    {
        global $sugar_config;
        if (!array_key_exists('aop', $sugar_config)) {
            return array();
        }

        return $sugar_config['aop'];
    }

    /**
     * @param aComplaint $bean
     * @param $contact
     *
     * @return bool
     */
    private function sendCreationEmail(aComplaint $bean, $contact)
    {
        if (!isAOPEnabled()) {
            return true;
        }
        require_once 'include/SugarPHPMailer.php';
        $mailer = new SugarPHPMailer();
        $admin = new Administration();
        $admin->retrieveSettings();

        $mailer->prepForOutbound();
        $mailer->setMailerForSystem();

        $emailTemplate = new EmailTemplate();

        $aop_config = $this->getAOPConfig();
        $emailTemplate->retrieve($aop_config['complaint_creation_email_template_id']);
        if (!$emailTemplate || !$aop_config['complaint_creation_email_template_id']) {
            $GLOBALS['log']->warn('ComplaintUpdatesHook: sendCreationEmail template is empty');

            return false;
        }

        $emailSettings = getPortalEmailSettings();
        $text = $this->populateTemplate($emailTemplate, $bean, $contact);
        $mailer->Subject = $text['subject'];
        $mailer->Body = $text['body'];
        $mailer->isHTML(true);
        $mailer->AltBody = $text['body_alt'];
        $mailer->From = $emailSettings['from_address'];
        $mailer->FromName = $emailSettings['from_name'];
        $email = $contact->emailAddress->getPrimaryAddress($contact);
        if (empty($email) && !empty($contact->email1)) {
            $email = $contact->email1;
        }
        $mailer->addAddress($email);

        try {
            if ($mailer->send()) {
                $this->logEmail($email, $mailer, $bean->id);

                return true;
            }
        } catch (phpmailerException $exception) {
            $GLOBALS['log']->fatal('ComplaintUpdatesHook: sending email Failed:  ' . $exception->getMessage());
        }

        $GLOBALS['log']->info('ComplaintUpdatesHook: Could not send email:  ' . $mailer->ErrorInfo);

        return false;
    }

    /**
     * @param string $email
     * @param SugarPHPMailer $mailer
     * @param string $complaintId
     */
    private function logEmail($email, SugarPHPMailer $mailer, $complaintId = null)
    {
        require_once 'modules/Emails/Email.php';
        $emailObj = new Email();
        $emailObj->to_addrs_names = $email;
        $emailObj->type = 'out';
        $emailObj->deleted = '0';
        $emailObj->name = $mailer->Subject;
        $emailObj->description = $mailer->AltBody;
        $emailObj->description_html = $mailer->Body;
        $emailObj->from_addr_name = $mailer->From;
        if ($complaintId) {
            $emailObj->parent_type = 'Complaints';
            $emailObj->parent_id = $complaintId;
        }
        $emailObj->date_sent = TimeDate::getInstance()->nowDb();
        $emailObj->modified_user_id = '1';
        $emailObj->created_by = '1';
        $emailObj->status = 'sent';
        $emailObj->save();
    }

    /**
     * @param SugarBean $bean
     */
    public function filterHTML($bean)
    {
        $bean->description = SugarCleaner::cleanHtml($bean->description, true);
    }

    /**
     * @param AOP_Complaint_Updates $complaintUpdate
     */
    public function sendComplaintUpdate(AOP_Complaint_Updates $complaintUpdate)
    {
        global $current_user, $sugar_config;
        $email_template = new EmailTemplate();
        if ($_REQUEST['module'] === 'Import') {
            //Don't send email on import
            return;
        }
        if (!isAOPEnabled()) {
            return;
        }
        if ($complaintUpdate->internal) {
            return;
        }
        $signature = array();
        $addDelimiter = true;
        $aop_config = $sugar_config['aop'];
        if ($complaintUpdate->assigned_user_id) {
            if ($aop_config['contact_email_template_id']) {
                $email_template = $email_template->retrieve($aop_config['contact_email_template_id']);
                $signature = $current_user->getDefaultSignature();
            }
            if ($email_template) {
                foreach ($complaintUpdate->getContacts() as $contact) {
                    $GLOBALS['log']->info('AOPComplaintUpdates: Calling send email');
                    $emails = array();
                    $emails[] = $contact->emailAddress->getPrimaryAddress($contact);
                    $complaintUpdate->sendEmail(
                        $emails,
                        $email_template,
                        $signature,
                        $complaintUpdate->complaint_id,
                        $addDelimiter,
                        $contact->id
                    );
                }
            }
        } else {
            $emails = $complaintUpdate->getEmailForUser();
            if ($aop_config['user_email_template_id']) {
                $email_template = $email_template->retrieve($aop_config['user_email_template_id']);
            }
            $addDelimiter = false;
            if ($emails && $email_template) {
                $GLOBALS['log']->info('AOPComplaintUpdates: Calling send email');
                $complaintUpdate->sendEmail(
                    $emails,
                    $email_template,
                    $signature,
                    $complaintUpdate->complaint_id,
                    $addDelimiter,
                    $complaintUpdate->contact_id
                );
            }
        }
    }
}
