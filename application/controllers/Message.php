<?php

class MessageController extends Yaf_Controller_Abstract {

    protected static $textMsgTemplate =
        "<xml>
          <ToUserName><![CDATA[%s]]></ToUserName>
          <FromUserName><![CDATA[%s]]></FromUserName>
          <CreateTime>%s</CreateTime>
          <MsgType><![CDATA[%s]]></MsgType>
          <Content><![CDATA[%s]]></Content>
        </xml>";


    /**
     * 消息回复接口
     * 参考：https://mp.weixin.qq.com/wiki?t=resource/res_main&id=mp1421140453
     * @return bool
     */
    public function responseMsgAction() {

        // 获取到微信推送过来的 POST 数据（XML 格式）
        $postArr = file_get_contents('php://input');

        // 处理消息类型，并设置自动回复类型和内容
        $postArr = simplexml_load_string($postArr);

        // 判断该数据包是否是订阅的事件推送
        if ($postArr->MsgType == 'event') {
            // 如果是关注 subscribe 事件
            if ($postArr->Event == 'subscribe') {
                // 回复用户消息
                $toUser     = $postArr->FromUserName;
                $fromUser   = $postArr->ToUserName;
                $createTime = time();
                $msgType    = 'text';
                $content    = '欢迎关注我的微信公众号';
                $response   = sprintf(
                    self::$textMsgTemplate, $toUser, $fromUser, $createTime, $msgType, $content
                );
                exit($response);
            }
        }

        return FALSE;
    }

    private static function
}
