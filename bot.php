<?php
    $accessToken = "Km/nSe34MqkF8aQtbb29wp1pVdMG//F982MU3xCaxd/kQfskstkTUHU0UMdx5JaWNxYPi6rWDtyIrHHwsPit45DOn/gY8em40k28IPq2WmKdQJYg2srF0hw3E4OxWHVSndQM8v2EUYeG6Yth/VWvzQdB04t89/1O/w1cDnyilFU=";
    $content = file_get_contents('php://input');
    $arrayJson = json_decode($content, true);
    
    $arrayHeader = array();
    $arrayHeader[] = "Content-Type: application/json";
    $arrayHeader[] = "Authorization: Bearer {$accessToken}";
    

    $message = $arrayJson['events'][0]['message']['text'];
	

	if($message == "check"){
		$soureType = $arrayJson['events'][0]['source']['type'];
		
		if($soureType == "user") {
			$userId = $arrayJson['events'][0]['source']['userId'];

			$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
			$arrayPostData['messages'][0]['type'] = "text";
			$arrayPostData['messages'][0]['text'] = " สวัสดีจ้าาา คุณ : <" . $userId . ">";
			replyMsg($arrayHeader,$arrayPostData);
		}
		
		else if($soureType == "room") {
			$userId = $arrayJson['events'][0]['source']['userId'];
			$roomId = $arrayJson['events'][0]['source']['roomId'];
			
			$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
			$arrayPostData['messages'][0]['type'] = "text";
			$arrayPostData['messages'][0]['text'] = " สวัสดีจ้าาา คุณ : <" . $userId . ">";
			$arrayPostData['messages'][1]['type'] = "text";
			$arrayPostData['messages'][1]['text'] = "จาก Room <" . $roomId . ">";
			replyMsg($arrayHeader,$arrayPostData);
		}
		else if($soureType == "group") {
			$userId = $arrayJson['events'][0]['source']['userId'];
			$groudId = $arrayJson['events'][0]['source']['groupId'];
			
			$arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
			$arrayPostData['messages'][0]['type'] = "text";
			$arrayPostData['messages'][0]['text'] = " สวัสดีจ้าาา คุณ : <" . $userId . ">";
			$arrayPostData['messages'][1]['type'] = "text";
			$arrayPostData['messages'][1]['text'] = "จาก Group <" . $groudId . ">";
			replyMsg($arrayHeader,$arrayPostData);
		}
		
	}
    if($message == "สวัสดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = " สวัสดีจ้าาา ^^";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Sticker"
    else if($message == "ฝันดี"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "sticker";
        $arrayPostData['messages'][0]['packageId'] = "2";
        $arrayPostData['messages'][0]['stickerId'] = "46";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Image"
    else if($message == "รูปน้องแมว"){
        $image_url = "https://i.pinimg.com/originals/cc/22/d1/cc22d10d9096e70fe3dbe3be2630182b.jpg";
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "image";
        $arrayPostData['messages'][0]['originalContentUrl'] = $image_url;
        $arrayPostData['messages'][0]['previewImageUrl'] = $image_url;
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Location"
    else if($message == "พิกัดสยามพารากอน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "location";
        $arrayPostData['messages'][0]['title'] = "สยามพารากอน";
        $arrayPostData['messages'][0]['address'] =   "13.7465354,100.532752";
        $arrayPostData['messages'][0]['latitude'] = "13.7465354";
        $arrayPostData['messages'][0]['longitude'] = "100.532752";
        replyMsg($arrayHeader,$arrayPostData);
    }
    #ตัวอย่าง Message Type "Text + Sticker ใน 1 ครั้ง"
    else if($message == "ลาก่อน"){
        $arrayPostData['replyToken'] = $arrayJson['events'][0]['replyToken'];
        $arrayPostData['messages'][0]['type'] = "text";
        $arrayPostData['messages'][0]['text'] = "อย่าทิ้งกันไป";
        $arrayPostData['messages'][1]['type'] = "sticker";
        $arrayPostData['messages'][1]['packageId'] = "1";
        $arrayPostData['messages'][1]['stickerId'] = "131";
        replyMsg($arrayHeader,$arrayPostData);
    }
function replyMsg($arrayHeader,$arrayPostData){
        $strUrl = "https://api.line.me/v2/bot/message/reply";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$strUrl);
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $arrayHeader);    
        curl_setopt($ch, CURLOPT_POSTFIELDS,json_encode($arrayPostData));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $result = curl_exec($ch);
        curl_close ($ch);
    }
   exit;
?>