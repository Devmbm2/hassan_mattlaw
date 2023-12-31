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
require_once 'include/clean.php';

/**
 * Class AOP_Complaint_Updates.
 */
class AOP_Complaint_Updates extends Basic
{
    public $new_schema = true;
    public $module_dir = 'AOP_Complaint_Updates';
    public $object_name = 'AOP_Complaint_Updates';
    public $table_name = 'aop_complaint_updates';
    public $tracker_visibility = false;
    public $importable = false;
    public $disable_row_level_security = true;
    public $id;
    public $name;
    public $date_entered;
    public $date_modified;
    public $modified_user_id;
    public $modified_by_name;
    public $created_by;
    public $created_by_name;
    public $description;
    public $deleted;
    public $created_by_link;
    public $modified_user_link;
    public $assigned_user_id;
    public $assigned_user_name;
    public $assigned_user_link;
    public $complaint;
    public $complaint_name;
    public $complaint_id;
    public $contact;
    public $contact_name;
    public $contact_id;
    public $internal;
    public $notes;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @deprecated deprecated since version 7.6, PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code, use __construct instead
     */
    public function AOP_Complaint_Updates()
    {
        $deprecatedMessage = 'PHP4 Style Constructors are deprecated and will be remove in 7.8, please update your code';
        if (isset($GLOBALS['log'])) {
            $GLOBALS['log']->deprecated($deprecatedMessage);
        } else {
            trigger_error($deprecatedMessage, E_USER_DEPRECATED);
        }
        self::__construct();
    }

    /**
     * @param $interface
     *
     * @return bool
     */
    public function bean_implements($interface)
    {
        switch ($interface) {
            case 'ACL':
                return true;
            default:
                return false;
        }
    }

    /**
     * @param bool $check_notify
     * @return string
     */
    public function save($check_notify = false)
    {
        $this->name = SugarCleaner::cleanHtml($this->name);
        $this->description = SugarCleaner::cleanHtml($this->description);
        parent::save($check_notify);
        if (file_exists('custom/modules/AOP_Complaint_Updates/ComplaintUpdatesHook.php')) {
            require_once 'custom/modules/AOP_Complaint_Updates/ComplaintUpdatesHook.php';
        } else {
            require_once 'modules/AOP_Complaint_Updates/ComplaintUpdatesHook.php';
        }
        if (class_exists('CustomComplaintUpdatesHook')) {
            $hook = new CustomComplaintUpdatesHook();
        } else {
            $hook = new ComplaintUpdatesHook();
        }
        $hook->sendComplaintUpdate($this);

        return $this->id;
    }

    /**
     * @return aComplaint
     */
    public function getComplaint()
    {
        return BeanFactory::getBean('Complaints', $this->complaint_id);
    }

    /**
     * @return null|Contact[]
     */
    public function getContacts()
    {
        $complaint = $this->getComplaint();
        if ($complaint) {
            return $complaint->get_linked_beans('contacts', 'Contacts');
        }

        return null;
    }

    /**
     * @return null|Contact
     */
    public function getUpdateContact()
    {
        if ($this->contact_id) {
            return BeanFactory::getBean('Contacts', $this->contact_id);
        }

        return null;
    }

    /**
     * @return User
     */
    public function getUser()
    {
        return BeanFactory::getBean('Users', $this->getComplaint()->assigned_user_id);
    }

    /**
     * @return User
     */
    public function getUpdateUser()
    {
        return BeanFactory::getBean('Users', $this->assigned_user_id);
    }

    /**
     * @return array
     */
    public function getEmailForUser()
    {
        $user = $this->getUser();
        if ($user) {
            return array($user->emailAddress->getPrimaryAddress($user));
        }

        return array();
    }

    /**
     * @param EmailTemplate $template
     * @param bool          $addDelimiter
     * @param null          $contactId
     *
     * @return array
     */
    private function populateTemplate(EmailTemplate $template, $addDelimiter = true, $contactId = null)
    {
        global $app_strings, $sugar_config;

        $user = $this->getUpdateUser();
        if (!$user) {
            $this->getUser();
        }
        $beans = array('Contacts' => $contactId, 'Complaints' => $this->getComplaint()->id, 'Users' => $user->id, 'AOP_Complaint_Updates' => $this->id);
        $ret = array();
        $ret['subject'] = from_html(aop_parse_template($template->subject, $beans));
        $body = aop_parse_template(str_replace('$sugarurl', $sugar_config['site_url'], $template->body_html), $beans);
        $bodyAlt = aop_parse_template(str_replace('$sugarurl', $sugar_config['site_url'], $template->body), $beans);
        if ($addDelimiter) {
            $body = $app_strings['LBL_AOP_EMAIL_REPLY_DELIMITER'].$body;
            $bodyAlt = $app_strings['LBL_AOP_EMAIL_REPLY_DELIMITER'].$bodyAlt;
        }
        $ret['body'] = from_html($body);
        $ret['body_alt'] = strip_tags(from_html($bodyAlt));

        return $ret;
    }

    /**
     * @param array $emails
     * @param EmailTemplate $template
     * @param array $signature
     * @param null $complaintId
     * @param bool $addDelimiter
     * @param null $contactId
     *
     * @return bool
     */
    public function sendEmail(
        $emails,
        $template,
        $signature = array(),
        $complaintId = null,
        $addDelimiter = true,
        $contactId = null
    ) {
        $GLOBALS['log']->info('AOPComplaintUpdates: sendEmail called');
        require_once 'include/SugarPHPMailer.php';
        $mailer = new SugarPHPMailer();
        $admin = new Administration();
        $admin->retrieveSettings();

        $mailer->prepForOutbound();
        $mailer->setMailerForSystem();

        $signatureHTML = '';
        if ($signature && array_key_exists('signature_html', $signature)) {
            $signatureHTML = from_html($signature['signature_html']);
        }
        $signaturePlain = '';
        if ($signature && array_key_exists('signature', $signature)) {
            $signaturePlain = $signature['signature'];
        }
        $emailSettings = getPortalEmailSettings();
        $text = $this->populateTemplate($template, $addDelimiter, $contactId);
        $mailer->Subject = $text['subject'];
        $mailer->Body = $text['body'] . $signatureHTML;
        $mailer->isHTML(true);
        $mailer->AltBody = $text['body_alt'] . $signaturePlain;
        $mailer->From = $emailSettings['from_address'];
        $mailer->FromName = $emailSettings['from_name'];
        foreach ($emails as $email) {
            $mailer->addAddress($email);
        }
        try {
            if ($mailer->send()) {
                require_once 'modules/Emails/Email.php';
                $emailObj = new Email();
                $emailObj->to_addrs_names = implode(',', $emails);
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

                return true;
            }
        } catch (phpmailerException $exception) {
            $GLOBALS['log']->fatal('AOPComplaintUpdates: sending email Failed:  ' . $exception->getMessage());
        }
        $GLOBALS['log']->info('AOPComplaintUpdates: Could not send email:  ' . $mailer->ErrorInfo);

        return false;
    }
}
