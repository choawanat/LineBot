<?php
    $accessToken = "Km/nSe34MqkF8aQtbb29wp1pVdMG//F982MU3xCaxd/kQfskstkTUHU0UMdx5JaWNxYPi6rWDtyIrHHwsPit45DOn/gY8em40k28IPq2WmKdQJYg2srF0hw3E4OxWHVSndQM8v2EUYeG6Yth/VWvzQdB04t89/1O/w1cDnyilFU=";
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
      
	$userId = "U867a27fa07c368f915755ad7d4f3b4bf"; // Meng's line userID
	$roomId = "Rd27df3cf18698dc7c17f338b267cefe3"; // room id
	$groupId = "C55ad8b4c9cc5be07b0edade88075c1f3"; // group id

	
	// to user
	$arrayPostData['to'] = $userId;
	$arrayPostData['messages'][0]['type'] = "text";
	$arrayPostData['messages'][0]['text'] = "Push message to user !!";
	pushMsg($arrayHeader,$arrayPostData);	
	
	// to room 
	$arrayPostData['to'] = $roomId;
	$arrayPostData['messages'][0]['type'] = "text";
	$arrayPostData['messages'][0]['text'] = "Push message to room !!";
	pushMsg($arrayHeader,$arrayPostData);
	
	// to group
	$arrayPostData['to'] = $groupId;
	$arrayPostData['messages'][0]['type'] = "text";
	$arrayPostData['messages'][0]['text'] = "Push message to group !!";
	pushMsg($arrayHeader,$arrayPostData);
	
	
	function pushMsg($arrayHeader,$arrayPostData){
      $strUrl = "https://api.line.me/v2/bot/message/push";
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL,$strUrl);
      curl_setopt($ch, CURLOPT_HEADER, false);
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($arrayPostData));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      $result = curl_exec($ch);
      curl_close ($ch);
   }
   
   exit;
?>