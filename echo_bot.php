<?php

session_start();
//$count = 1;
$servername = "localhost";
username = "cat";
$password = "cat";
$dbname = "cat";
//creat connection
$con=mysqli_connect($servername,$username,$password,$dbname);
// Check connection
if (!$con) {
	die("Connection failed: " . mysqli_connect_error());
}
mysqli_set_charset($con,"utf8");

require_once('./LINEBotTiny.php');

$channelAccessToken = '1bb5FOnOqLXnv2W6KeZ+3ms0neF09E8h2KVffW1wjiqSGskGKLQ7/2PDNNBxUWTg6M8UzBtADTqq+hDcec0SbHKRHcVb9Fs8714MJA8MmLWWracX3dnFmJAz5vE7pJErclmgPAE60+M74Cm56+LyEgdB04t89/1O/w1cDnyilFU=';
$channelSecret = '705311288e013e163f3ff55d0e735958';

$sql = "SELECT * FROM gato WHERE 1";
$result = mysqli_query($con,$sql);
//$test123='123';

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
								'text' => $row["Date"]
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
