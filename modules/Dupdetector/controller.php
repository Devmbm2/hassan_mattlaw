<?php
/*
   Created By : Urdhva Tech Pvt. Ltd.
 Created date : 09/29/2017
   Contact at : contact@urdhva-tech.com
          Web : www.urdhva-tech.com
        Skype : urdhvatech
       Module : Dupdetector 1.2
*/
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');
class DupDetectorController extends SugarController
{
    /**
     * Action Field Config
     */
    protected function action_fieldconfig()
    {
        $this->view = 'fieldconfig';
    }
}
