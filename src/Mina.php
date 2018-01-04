<?php
namespace WeiXin;

use WeiXin\Fun\Mina\Fun;

class Mina
{
    use Fun;

	/**
	 * 微信小程序登录方法，换取openid等信息
	 * 
	 * @param array $config <'js_code','appid','secret'>
	 * @return array
	 */
	public static function login(array $config)
	{

		$res = json_decode(file_get_contents("https://api.weixin.qq.com/sns/jscode2session?appid={$config['appid']}&secret={$config['secret']}&js_code={$config['js_code']}&grant_type=authorization_code"),true);
		if(isset($res['openid'])){
			$session3rd = self::randomFromDev(16);
			$access_token_arr = json_decode(file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$config['appid']}&secret={$config['secret']}"),true);
			return [
				'status' => true,
				'session3rd' => $session3rd,
				'data' => [
					'session_key' => $res['session_key'],
	                'openid'      => $res['openid'],
	                'appid'   => $config['appid'],
	                'secret'  => $config['secret'],
	                'access_token' => isset($access_token_arr['access_token'])?$access_token_arr['access_token']:''
				]
			];
		}else{
			return [
				'status' => false,
                'data'   => $res
			];
		}
	}

	/**
	 * 生成3rd_session方法
	 * 
	 * @param  $len
	 * @return string
	 */
	private static function randomFromDev($len) {
        $fp = @fopen('/dev/urandom','rb');
        $result = '';
        if ($fp !== FALSE) {
            $result .= @fread($fp, $len);
            @fclose($fp);
        }
        else
        {
            trigger_error('Can not open /dev/urandom.');
        }
        $result = base64_encode($result);
        $result = strtr($result, '+/', '-_');

        return substr($result, 0, $len);
    }

    /**
     * 数组转xml
     * @param $arr
     * @return string
     */
    private static function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key=>$val)
        {
            if (is_numeric($val)){
                $xml.="<".$key.">".$val."</".$key.">";
            }else{
                $xml.="<".$key."><![CDATA[".$val."]]></".$key.">";
            }
        }
        $xml.="</xml>";
        return $xml;
    }
}