<?php declare(strict_types=1);

namespace Stonecutter\LaravelLogWeChat;

use GuzzleHttp\Client as HttpClient;
use Monolog\Logger;
use Monolog\Handler\AbstractProcessingHandler;

/**
 * Sends notifications to WeChat through Push Bear
 *
 * @author sink cup <sink.cup@gmail.com>
 * @see    http://pushbear.ftqq.com/
 */
class WeChatHandler extends AbstractProcessingHandler
{
    private $url;
    private $sendKey;

    /**
     * The HTTP client instance.
     *
     * @var \GuzzleHttp\Client
     */
    private $http;

    /**
     * @param string|int $level The minimum logging level at which this handler will be triggered
     * @param bool $bubble Whether the messages that are handled can bubble up the stack or not
     * @param string $url Webhook URL
     * @param string $sendKey send key
     * @param HttpClient $http
     */
    public function __construct(
        $level = Logger::ERROR,
        bool $bubble = true,
        string $url = null,
        string $sendKey = null,
        HttpClient $http = null
    ) {
        parent::__construct($level, $bubble);

        $this->url = $url;
        $this->sendKey = $sendKey;
        $this->http = $http;
    }

    /**
     * {@inheritdoc}
     *
     * @param array $record
     */
    protected function write(array $record)
    {
        if (empty($this->url) || empty($this->sendKey)) {
            return false;
        }
        try {
            $res = $this->http->request('GET', $this->url, ['query' => [
                'sendkey' => $this->sendKey,
                'text' => mb_substr($record['message'], 0, 80), // 标题，必填。不超过80个字
                'desp' => str_replace("\n", "\n\n", json_encode(['time' => $record['datetime']->format(DATE_ATOM)] + $record['context'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)), // 长文本内容，选填。支持Markdown，换行需要一个空行
            ]]);
            file_put_contents('php://stdout', json_encode(json_decode((string) $res->getBody(), true), JSON_UNESCAPED_UNICODE) . "\n", FILE_APPEND);
        } catch (\Exception $exception) {
            // do nothing
            file_put_contents('php://stderr', $exception->getMessage() . "\n", FILE_APPEND);
        }
    }
}
