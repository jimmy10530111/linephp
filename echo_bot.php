<?php

/*session_start();
//$count = 1;
$servername = "localhost";
username = "cat";
$password = "cat";
$dbname = "bug";
//creat connection
$con=mysqli_connect($servername,$username,$password,$dbname);
// Check connection
if (!$con) {
	die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con,"utf8");*/

require_once('./LINEBotTiny.php');

$channelAccessToken = '<your channel access token>';
$channelSecret = '<your channel secret>';

//$sql = "SELECT * FROM gato WHERE 1";
//$result = mysqli_query($con,$sql);

$client = new LINEBotTiny($channelAccessToken, $channelSecret);
foreach ($client->parseEvents() as $event) {
    switch ($event['type']) {
        case 'message':
            $message = $event['message'];
            switch ($message['type']) {
                case 'text':
                    $client->replyMessage([
                        'replyToken' => $event['replyToken'],
                        'messages' => [
                            [
                                'type' => 'text',
                                //'text' => $row["Time"]
								'text' => $message['text']
                            ]
                        ]
                    ]);
                    break;
                default:
                    error_log('Unsupported message type: ' . $message['type']);
                    break;
            }
            break;
        default:
            error_log('Unsupported event type: ' . $event['type']);
            break;
    }
};
