# Laravel Log WeChat

服务器错误日志发送到 多人微信。

支持：Laravel 5.6、5.7

感谢：[PushBear - 基于微信模板的一对多消息送达服务](http://pushbear.ftqq.com/)

## 使用步骤

登录 PushBear，创建 消息通道，获得二维码（多人扫码收消息）和秘钥。

![PushBear 消息通道管理](https://user-images.githubusercontent.com/4971414/48777307-371ff880-ed0d-11e8-8a96-c641d9ea7b2a.png)

把秘钥放在 Laravel 环境变量里，比如：

```
LOG_WECHAT_PUSHBEAR_SEND_KEY=6767-xxx
```

安装 package

```
composer require stonecutter/laravel-log-wechat
php artisan vendor:publish --tag=log-wechat-config --force
```

测试发送

```
php artisan wechat:hello
```

或者在项目代码里使用

```
Log::error('你好，之华', ['city' => 'Shanghai', 'sender' => '尹川']);
```

效果：

![微信收到消息](https://user-images.githubusercontent.com/4971414/48781358-d3023200-ed16-11e8-80e8-abe942e9edf4.png)
