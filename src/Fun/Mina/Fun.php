<?php
namespace WeiXin\Fun\Mina;

trait Fun
{
	/**
	 * 发送模板消息
	 * 
	 * @param  array  $config  
	 * @param  array  $session 
	 * @return array
	 */
	public static function sendTemplateMessage(array $config,array $session)
	{
		$url = "https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token={$session['access_token']}";

        $timeout = 5;
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_POST, 1);
        $post_data = [
            "touser" => $session['openid'],
            "template_id" => "LDuVv_pgihoDTEQS0DqhqHNjscgquzucEeM_I2f4TjY",
            "form_id" =>  $config['formId'],
            "emphasis_keyword" => "keyword1.DATA",
            "data" =>[
                "keyword1" => [
                    "value" => "339208499",
                    "color" => "#173177"
                ],
                "keyword2" => [
                    "value" => "2015年01月05日 12:30",
                    "color" => "#173177"
                ],
                "keyword3" => [
                    "value" => "粤海喜来登酒店",
                    "color" => "#173177"
                ],
                "keyword4" => [
                    "value" => "广州市天河区天河路208号",
                    "color" => "#173177"
                ]
            ]
        ];


        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($post_data));
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
        curl_setopt($ch, CURLOPT_HEADER, false);
        $file_contents = curl_exec($ch);
        curl_close($ch);
        return json_decode($file_contents，true);
	}
}