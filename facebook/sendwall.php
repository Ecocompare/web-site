<?php
error_log(date('H:i:s')." appel:".$_POST['data']."\n",3,"/tmp/ecocompare.log");
if(!empty($_POST['data']))
 {     
$data=array();
 $data=unserialize($_POST['data']); 

$post = "message=".$data['message']."&access_token=".$data['token']."&link=".$data['link']."&picture=".$data['picture']."&name=".$data['name']."&caption=".$data['caption']."&description=".$data['description'];

error_log(date('H:i:s')." ".$post."\n",3,"/tmp/ecocompare.log");

$curl = curl_init("https://graph.facebook.com/".$data['user_id']."/feed");
 curl_setopt($curl,CURLOPT_POST, true);
 curl_setopt($curl,CURLOPT_POSTFIELDS,$post);
 curl_exec($curl);
 curl_close($curl);       
                         
} 
else

error_log(date('H:i:s')." vide\n",3,"/tmp/ecocompare.log");

?>
