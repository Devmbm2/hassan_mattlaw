<?php
require_once('include/MVC/View/views/view.detail.php');
class NEG_NegotiationsViewDetail extends ViewDetail {
        function NEG_NegotiationsViewDetail(){
        parent::ViewDetail();
}

function display() {

        if($this->bean->type == "Mediation_Offer"){
          //hide field
          unset($this->dv->defs['panels']['default'][7][1]);
        }
        $this->th = new TemplateHandler();
        $this->th->clearCache($this->module);
        parent::display();
}
}
?>
