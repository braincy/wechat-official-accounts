<?php

class IndexController extends Yaf_Controller_Abstract {

    private static $token = 'wechat-official-accounts';

	public function indexAction() {

	    // 获得参数 signature, nonce, timestamp, echostr
        $nonce = $_GET['nonce'];
        $timeStamp = $_GET['timestamp'];
        $echoStr = $_GET['echostr'];
        $signature = $_GET['signature'];

        // 形成数组，按字典序排序
        $arr = [$nonce, $timeStamp, self::$token];
        sort($arr);

        // 拼接成字符串，使用 sha1 加密，然后与 signature 进行校验
        $str = sha1(implode($arr));
        if ($str == $signature) {
            exit ($echoStr);
        }

        return FALSE;
	}
}
