<?php
function reply_msg($txtin,$replyToken)
{
 $access_token = ‘0m3Aahxa+/i0bXe2QXF5JREOkIerEzseZOTJBKQ/ULQvoHXR+Y4TFsvEbiJ/yk7KNfiH2TjobG9J8E0fe0aB71meAGNe3gunTm27OoDLrGXrtAfbsNRqhg6eFE68zK903swb/J4lFcrVHMM/1bFLxwdB04t89/1O/w1cDnyilFU=
’;
 $messages = [‘type’ => ‘text’,’text’ => $txtin];
 $url = ‘https://api.line.me/v2/bot/message/reply’;
 $data = [
 ‘replyToken’ => $replyToken,
 ‘messages’ => [$messages],
 ];
 $post = json_encode($data);
 $headers = array(‘Content-Type: application/json’, ‘Authorization: Bearer ‘ . $access_token);
 $ch = curl_init($url);
 curl_setopt($ch, CURLOPT_CUSTOMREQUEST, “POST”);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
 curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
 curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
 curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
 $result = curl_exec($ch);
 curl_close($ch);
 echo $result . “\r\n”;
}
$content = file_get_contents(‘php://input’);
$events = json_decode($content, true);
if (!is_null($events[‘events’])) 
{
 foreach ($events[‘events’] as $event) 
 {
 if ($event[‘type’] == ‘message’ && $event[‘message’][‘type’] == ‘text’)
 {
 $replyToken = $event[‘replyToken’];
 $txtin = $event[‘message’][‘text’];
 reply_msg($txtin,$replyToken); 
 }
 }
}
echo “BOT OK”;
?>
