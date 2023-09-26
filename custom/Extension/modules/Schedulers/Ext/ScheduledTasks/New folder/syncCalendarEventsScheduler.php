<?php
$job_strings[] = 'syncCalendarEventsScheduler';
function syncCalendarEventsScheduler(){
    global $db,$sugar_config;
    $source_id = 'ext_eapm_google';
    $source = SourceFactory::getSource($source_id);
    $properties = $source->getProperties();
    $client_id = $properties['oauth2_client_id'];
    $client_secret = $properties['oauth2_client_secret'];
    $sql0 = "SELECT users.id from users where deleted = 0";
    $result0 = $db->query($sql0);
    while ($record0 = $GLOBALS["db"]->fetchByAssoc($result0)) {
        $id = $record0['id'];
        if (!empty($id)) {
            $sql = "SELECT eapm.api_data from eapm where assigned_user_id = '$id' AND deleted = 0";
            $result = $db->query($sql);
            $record = $GLOBALS["db"]->fetchByAssoc($result);
            if (!empty($record)) {
                $api_data = $record['api_data'];
                $api_data = str_replace("&quot;", '"', $api_data);
                $tokenPath = 'custom/include/calendar-work/my-work/' . $id . 'token.json';
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
                // Print the next 10 events on the user's calendar.
                $calendarId = 'primary';
                $optParams = array(
                    'maxResults' => 10,
                    'orderBy' => 'startTime',
                    'singleEvents' => true,
                    'timeMin' => date('c'),
                );
                $results = $service->events->listEvents($calendarId, $optParams);
                $events = $results->getItems();
                if (empty($events)) {
                    print "No upcoming events found.\n";
                } else {
                    print "Upcoming events:\n";
                    foreach ($events as $event) {
                        $sql = "SELECT count(*) as total from fp_events where fp_events.gsync_id = '{$event->getId()}' AND deleted = 0";
                        $result = $db->query($sql);
                        $count = $db->fetchByAssoc($result);
                        if ($count['total'] == 0) {
                            $FP_events_calendar = new FP_events();
                            $FP_events_calendar->name = $event->getSummary();
                            $FP_events_calendar->status = 'Google Event';
                            $start = $event->start->date;
                            $end = $event->end->date;
                            if (empty($start)) {
                                $start = $event->start->dateTime;
                            }
                            if (empty($end)) {
                                $end = $event->end->dateTime;
                            }
                            $datestart = date_create($start);
                            $s_date = date_format($datestart, 'Y-m-d H:i:s');
                            $dateend = date_create($end);
                            $e_date = date_format($dateend, 'Y-m-d H:i:s');
                            $FP_events_calendar->date_start = $s_date;
                            $FP_events_calendar->date_end = $e_date;
                            $FP_events_calendar->duration_hours = abs(strtotime($e_date) - strtotime($s_date)) / (60 * 60);
                            $diff2 = abs(strtotime($e_date) - strtotime($s_date));
                            $years = floor($diff2 / (365 * 60 * 60 * 24));
                            $months = floor(($diff2 - $years * 365 * 60 * 60 * 24)
                                / (30 * 60 * 60 * 24));
                            $days = floor(($diff2 - $years * 365 * 60 * 60 * 24 -
                                    $months * 30 * 60 * 60 * 24) / (60 * 60 * 24));

                            $hours = floor(($diff2 - $years * 365 * 60 * 60 * 24
                                    - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24)
                                / (60 * 60));
                            $FP_events_calendar->duration_minutes = floor(($diff2 - $years * 365 * 60 * 60 * 24
                                    - $months * 30 * 60 * 60 * 24 - $days * 60 * 60 * 24
                                    - $hours * 60 * 60) / 60);;
                            $FP_events_calendar->description = $event->description;
                            $FP_events_calendar->cases_fp_events_1cases_ida = '8464ee46-7790-11ec-918e-588a5a3fd4fa';
                            $FP_events_calendar->assigned_user_id = $id;
                            $FP_events_calendar->multiple_assigned_users = encodeMultienumValue('^' . $id . '^,^1^');
                            $FP_events_calendar->processed = true;
                            $FP_events_calendar->gsync_id = $event->getId();
                            $FP_events_calendar->type_c = 'Virtual_Meeting_Online';
                            preg_match('/Join Zoom Meeting\n(.*s?)\n\nMeeting ID: (.s?)\nPasscode: (.s?)/', $event->description, $m);
                            if ($m) {
                                $url = $m[1] . PHP_EOL;
                                $meeting_id = $m[2] . PHP_EOL;
                                $passcode = $m[3] . PHP_EOL;

                                $FP_events_calendar->meeting_id = $meeting_id;
                                $FP_events_calendar->meeting_password = $passcode;
                                $FP_events_calendar->meeting_url = $url;
                            }
                            preg_match('/Join (.*s?) Meeting/', $event->description, $m2);
                            preg_match('/JOIN (.*s?) MEETING/', $event->description, $m3);
                            if ($m2) {
                                $event_type = $m2[1] . PHP_EOL;
                                print_r($event_type);
                                $FP_events_calendar->event_type = 'on_zoom';
                            }
                            if ($m3) {
                                $event_type = $m3[1] . PHP_EOL;
                                print_r($event_type);
                                $FP_events_calendar->event_type = 'on_webx';
                            }
                            $FP_events_calendar->save();
                            $site_url = $sugar_config['site_url'];
                            require_once 'include/phpmailer/class.phpmailer.php';
                            require_once 'include/phpmailer/class.smtp.php';
                            $mail = new PHPMailer();
                            $mail->SMTPOptions = array(
                                'ssl' => array(
                                    'verify_peer' => false,
                                    'verify_peer_name' => false,
                                    'allow_self_signed' => true
                                )
                            );
                            $mail->IsSMTP();                              // send via SMTP
                            $mail->Host = "smtp.gmail.com";
                            $mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
                            $mail->SMTPAuth = true;
                            $mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for GMail
                            $mail->Port = 587;                  // turn on SMTP authentication
                            $mail->Username = $sugar_config['email_address'];        // SMTP username
                            $mail->Password = $sugar_config['email_password'];               // SMTP password
                            $email="hassanzaidi20@gmail.com";
                            $email2="raza80748@gmail.com";                // Recipients
                            $name = "Honey MattLaw";                              // Recipient's name
                            // $mail->From = $webmaster_email;
                            $mail->FromName = "New Calendar Meeting Event Sync with Honey";
                            $mail->AddAddress($email);
                            $mail->AddAddress($email2);
                            $mail->WordWrap = 50;                         // set word wrap
                            $mail->IsHTML(true);                          // send as HTML
                            $mail->Subject = "New Calendar Entry in Honey";
                            $mail->Body = "New Calendar Meeting Event Sync with Honey with Name" . " " . "' <b>" . $FP_events_calendar->name . "</b> '" . " Please assigned this event to the case!";
                            $mail->Body .= "<br><a href = '{$site_url}/index.php?entryPoint=viewEventEntryPoint&id={$FP_events_calendar->id}'>Click to View Event</a>";
                            if (!$mail->Send()) {
                                echo "Mailer Error: " . $mail->ErrorInfo;
                            } else {
                                echo "Message has been sent";
                            }
                        } else {
                            printf("event exist");
                        }
                    }
                }
            }
        }
    }
    return true;
}