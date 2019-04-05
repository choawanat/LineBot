<?php
    $accessToken = "Km/nSe34MqkF8aQtbb29wp1pVdMG//F982MU3xCaxd/kQfskstkTUHU0UMdx5JaWNxYPi6rWDtyIrHHwsPit45DOn/gY8em40k28IPq2WmKdQJYg2srF0hw3E4OxWHVSndQM8v2EUYeG6Yth/VWvzQdB04t89/1O/w1cDnyilFU=";
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
   
   //รับ id ของผู้ใช้
   $id = "U867a27fa07c368f915755ad7d4f3b4bf"; // Meng's line userID
   for($i=1;$i<=10;$i++){
	  $arrayPostData['to'] = $id;
	  $arrayPostData['messages'][0]['type'] = "text";
	  $arrayPostData['messages'][0]['text'] = "นับ " . $i;
	  pushMsg($arrayHeader,$arrayPostData);
   }
	
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