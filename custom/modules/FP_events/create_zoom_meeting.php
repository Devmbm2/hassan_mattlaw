<?php
if(!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

	class zoom{

		function create_zoom_meeting($bean, $event, $arguments){
			if(isset($bean->type_c) && !empty($bean->type_c) && $bean->type_c == 'Virtual_Meeting_Online'){
				include_once 'custom/include/zoom/Zoom_Api.php';
				$GLOBALS['sugar_config']['zoom']['email'] = $GLOBALS['current_user']->email1;
				$zoom_meeting = new Zoom_Api($GLOBALS['sugar_config']['zoom']);

				$data = array();
				$data['topic'] 		= $bean->name;
				$data['start_date'] = date("Y-m-d h:i:s", strtotime($bean->date_start));
				$data['duration'] 	= 30;
				$data['type'] 		= 2;
				$data['password'] 	= "12345";

				/* try { */
				$response = $zoom_meeting->createMeeting($data);
				$bean->meeting_id = $response->id;
				$bean->meeting_password = $response->password;
				$bean->meeting_url = $response->join_url;
				if($response->id){
					SugarApplication::appendErrorMessage("Your New Meeting has been created. You can start the meeting with zoom Credentials.");
				}else{
					SugarApplication::appendErrorMessage("Zoom meeting has not created: {$response->code} : {$response->message}");
				}	
				/* } catch (Exception $ex) {
					echo $ex;
				} */
			}
		}

function syncCalendarEventsScheduler($bean, $event, $arguments){
    global $db,$sugar_config;
    $source_id = 'ext_eapm_google';
    $source = SourceFactory::getSource($source_id);
    $properties = $source->getProperties();
    $client_id = $properties['oauth2_client_id'];
    $client_secret = $properties['oauth2_client_secret'];
    // $sql0 = "SELECT users.id from users where deleted = 0";
    // $result0 = $db->query($sql0);
    // while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
        // $id = $record0['id'];
        // if (!empty($id)) {
            $sql = "SELECT eapm.api_data from eapm where assigned_user_id = 1 AND deleted = 0";
            $result = $db->query($sql);
            $record = $GLOBALS["db"]->fetchByAssoc($result);
            if (!empty($record)) {
                $api_data = $record['api_data'];
                $api_data = str_replace("&quot;", '"', $api_data);
                $tokenPath = 'custom/include/calendar-work/my-work/token.json';
                if (!file_exists(dirname($tokenPath))) {
                    mkdir(dirname($tokenPath), 0700, true);
                }
                file_put_contents($tokenPath, $api_data);

                require 'custom/include/calendar-work/vendor/autoload.php';
                $client = new Google_Client();
                $client->setApplicationName('Google Calendar API');
                $client->setScopes(Google_Service_Calendar::CALENDAR_READONLY);
                $client->setClientId($client_id);
                $client->setClientSecret($client_secret);
                $client->setAccessType('offline');
                $client->setPrompt('select_account consent');

                if (file_exists($tokenPath)) {
                    $accessToken = json_decode(file_get_contents($tokenPath), true);
                    $client->setAccessToken($accessToken);
                }

                // =====Google Calendar Syncing=====
                 $service = new Google_Service_Calendar($client);
                
// $setstartdate = DateTime::createFromFormat('m/d/Y H:i', $_REQUEST['date_start']);
$setstartdate = date("Y-m-d H:i:s", strtotime($_REQUEST['date_start']));
// $datestartFormated = $setstartdate->format('Y-m-d H:i:s');
$datetimestart = new DateTime($setstartdate, new DateTimeZone('Asia/Karachi'));
$datestart = $datetimestart->format('c');
echo $datestart;
// $setenddate = DateTime::createFromFormat('m/d/Y H:i', $_REQUEST['date_end']);
$setenddate = date("Y-m-d H:i:s", strtotime($_REQUEST['date_end']));
// $dateendFormated = $setenddate->format('Y-m-d H:i:s');
$datetimeend = new DateTime($setenddate, new DateTimeZone('Asia/Karachi'));
$dateend = $datetimeend->format('c');
echo $dateend;
// die();
$event = new Google_Service_Calendar_Event(array(
  'summary' => $bean->name,
  // 'location' => '800 Howard St., San Francisco, CA 94103',
  'description' => $bean->description,
  'start' => array(
    'dateTime' => $datestart,
    'timeZone' => 'Asia/Karachi',
  ),
  'end' => array(
    'dateTime' => $dateend,
    'timeZone' => 'Asia/Karachi',
  ),
  // 'recurrence' => array(
  //   'RRULE:FREQ=DAILY;COUNT=2'
  // ),
  // 'attendees' => array(
  //   array('email' => 'lpage@example.com'),
  //   array('email' => 'sbrin@example.com'),
  // ),
  // 'reminders' => array(
  //   'useDefault' => FALSE,
  //   'overrides' => array(
  //     array('method' => 'email', 'minutes' => 24 * 60),
  //     array('method' => 'popup', 'minutes' => 10),
  //   ),
  // ),
));
// $event = $service->events->get('primary', 'eventId');
// echo $event->id;
// die();
$calendarId = 'a4ef6c620840fc147064163ad01f5ee273b0762f652978992afa820365b710fb@group.calendar.google.com';
if(empty($bean->gsync_id) || $bean->gsync_id == Null){
	// echo "here";
	// die();
$event = $service->events->insert($calendarId, $event);
printf('Event created: %s\n', $event->htmlLink);
$bean->gsync_id = $event->getId();
}
else{
    try {
    $checkevent = $service->events->get($calendarId, $bean->gsync_id);
} catch (Google_Service_Exception $e) {
    // Error
    print_r($e->getMessage());
    $checkevent = Null;
}
    if(!empty($checkevent) || $checkevent != Null){
        $updatedEvent = $service->events->update($calendarId, $bean->gsync_id, $event);
    }
    else{
    }
}
    if (empty($events)) {
        print "No upcoming events found.\n";
    } else {
        print "Upcoming events:\n";
       
    }
            }
        // }
    // }
}
	}

