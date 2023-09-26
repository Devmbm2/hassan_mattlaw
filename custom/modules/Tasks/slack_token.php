<?php
$slack_config = $GLOBALS['sugar_config']['slack'];
echo '<a href="https://slack.com/oauth/authorize?scope=client&client_id='.$slack_config['client_id'].'"><img alt="Add to Slack" height="40" width="139" src="https://platform.slack-edge.com/img/add_to_slack.png" srcset="https://platform.slack-edge.com/img/add_to_slack.png 1x, https://platform.slack-edge.com/img/add_to_slack@2x.png 2x" /></a>';
print"<pre>";print($_REQUEST);die;