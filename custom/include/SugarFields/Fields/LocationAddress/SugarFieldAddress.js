/*********************************************************************************
 * SugarCRM Community Edition is a customer relationship management program developed by
 * SugarCRM, Inc. Copyright (C) 2004-2013 SugarCRM Inc.

 * SuiteCRM is an extension to SugarCRM Community Edition developed by Salesagility Ltd.
 * Copyright (C) 2011 - 2014 Salesagility Ltd.
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
 ********************************************************************************/
/*
   Created By : Urdhva Tech Pvt. Ltd.
   Created date : 12/06/2017
   Contact at : contact@urdhva-tech.com
   Module : Google Address
*/
(function(){
    

    var Dom = YAHOO.util.Dom,
        Event = YAHOO.util.Event;

    SUGAR.AddressField = function(checkId, fromKey, toKey){
        this.fromKey = fromKey;
        this.toKey = toKey;
        Event.onAvailable(checkId, this.testCheckboxReady, this);
        if(ut_google_key !='') {
            if(utgoogle_license == 'Ok'){
                if(typeof  ut_google_map_lib === 'undefined') {
                    ut_google_map_lib =true;
                    $.getScript("https://maps.googleapis.com/maps/api/js?key="+ut_google_key+"&v=3.exp&libraries=places", function() {
                        address_initialize(fromKey,toKey);
                    });
                }
                else{
                    if(ut_google_map_lib ==false){
                        ut_google_map_lib =true;
                         $.getScript("https://maps.googleapis.com/maps/api/js?key="+ut_google_key+"&v=3.exp&libraries=places", function() {
                            address_initialize(fromKey,toKey);
                        });
                    }
                    else {
                        setTimeout(function(){
                            address_initialize(fromKey,toKey);
                        }, 2000);
                    }
                        
                }    
            }
            else{
				
                jQuery('#'+toKey+'_location_address').val("License Error : " + utgoogle_license);    
            }
            
        }
        else{
            console.log("Google API key is not configured");
        }
        
    }

    SUGAR.AddressField.prototype = {
        elems  : ["address_street"], //, "address_city", "address_state", "address_postalcode", "address_country"
        tHasText : false,
        syncAddressCheckbox : true,
        originalBgColor : '#FFFFFF',
        testCheckboxReady : function (obj) {
			console.log('map : '+obj);
            for(var x in obj.elems) {
                var f = obj.fromKey + "_" +obj.elems[x];
                var t = obj.toKey + "_" + obj.elems[x];

                var e1 = Dom.get(t);
                var e2 = Dom.get(f);

                if(e1 != null && typeof e1 != "undefined" && e2 != null && typeof e2 != "undefined") {

                    if(!obj.tHasText && YAHOO.lang.trim(e1.value) != "") {
                       obj.tHasText = true;
                    }

                    if(e1.value != e2.value)
                    {
                       obj.syncAddressCheckbox = false;
                       break;
                    }
                    obj.originalBgColor = e1.style.backgroundColor;
                }
            }

            if(obj.tHasText && obj.syncAddressCheckbox)
            {
               Dom.get(this.id).checked = true;
               obj.syncFields();
            }
        },
        writeToSyncField : function(e) {
            var fromEl = Event.getTarget(e, true);
            if(typeof fromEl != "undefined") {
                var toEl = Dom.get(fromEl.id.replace(this.fromKey, this.toKey));
                var update = toEl.value != fromEl.value;
                toEl.value = fromEl.value;
                if (update) SUGAR.util.callOnChangeListers(toEl);
            }
        },
        syncFields : function (fromKey, toKey) {
            var fk = this.fromKey, tk = this.toKey;
            for(var x in this.elems) {
                var f = fk + "_" + this.elems[x];
                var e2 = Dom.get(f);
                var t = tk + "_" + this.elems[x];
                var e1 = Dom.get(t);
                if(e1 != null && typeof e1 != "undefined" && e2 != null && typeof e2 != "undefined") {
                    if(!Dom.get(tk + '_checkbox').checked) {
                        Dom.setStyle(e1,'backgroundColor',this.originalBgColor);
                        e1.removeAttribute('readOnly');
                        Event.removeListener(e2, 'change', this.writeToSyncField);
                    } else {
                        var update = e1.value != e2.value;
                        e1.value = e2.value;
                        if (update) SUGAR.util.callOnChangeListers(e1);
                        Dom.setStyle(e1,'backgroundColor','#DCDCDC');
                        e1.setAttribute('readOnly', true);
                        
                        Event.addListener(e2, 'change', this.writeToSyncField, this, true);
                    }
                }
            }
        }
    };
     address_initialize = function(fromKey,toKey){
        var element = toKey+'_location_address';
        var auto_element = toKey+'_temp_address';
        var options = {
                  types: ['establishment']
            };
    
        var auto_element = new google.maps.places.Autocomplete(document.getElementById(toKey+'_location_address'));
        google.maps.event.addListener(auto_element, 'place_changed', function() {
             var place = auto_element.getPlace();
			
             jQuery('#'+toKey+'_location_address').val("");
             /* jQuery('#'+toKey+'_address_city').val("");
             jQuery('#'+toKey+'_address_state').val("");
             jQuery('#'+toKey+'_address_country').val("");
             jQuery('#'+toKey+'_address_postalcode').val(""); */
             
             var street_name = "";
              $.each(place.address_components,function(key,element){
				   console.log('element : '+element);
                 if(jQuery.inArray("street_number", element.types) !== -1){
                     if(street_name !='')
                        street_name += " "+element.long_name;
                    else
                        street_name += element.long_name;
                 }
                if(jQuery.inArray("route", element.types) !== -1){
                    if(street_name !='')
                        street_name += " "+element.long_name;
                    else
                        street_name += element.long_name;
                 }
                 if(jQuery.inArray("administrative_area3", element.types) !== -1 || jQuery.inArray("locality", element.types) !== -1){            
                         jQuery('#'+toKey+'_address_city').val(element.long_name);
						 street_name += " "+element.long_name;
                 }
                 if(jQuery.inArray("administrative_area_level_1", element.types) !== -1){
                     jQuery('#'+toKey+'_address_state').val(element.long_name);
					 street_name += " ,"+element.long_name;
                 }
                 if(jQuery.inArray("country", element.types) !== -1){
                     jQuery('#'+toKey+'_address_country').val(element.long_name);
					 street_name += " ,"+element.long_name;
                 }
                 if(jQuery.inArray("postal_code", element.types) !== -1){
                        jQuery('#'+toKey+'_address_postalcode').val(element.long_name);
						street_name += " ,"+element.long_name;
                 }        
                 
             });
               window.setTimeout(function() {
                   jQuery('#'+toKey+'_of_incident_c').val(street_name);
                   jQuery('#'+toKey+'_address_country').focus();
                }, 200);
        });
     }
})();
