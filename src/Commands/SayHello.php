<?php

namespace Stonecutter\LaravelLogWeChat\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class SayHello extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wechat:hello';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Say Hello to WeChat';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        Log::info('start ' . $this->signature);

        // 5分钟内不可发布重复消息
        Log::error('你好，之华', ['city' => 'Shanghai', 'sender' => '尹川']);
        //Log::error('你好，旧时光', ['导演' => '沙漠', '主演' => ['李兰迪', '张新成', '周澄奥', '李牵', '许梦圆']]);
        //Log::error('Hello！树先生', ['导演' => '韩杰', '主演' => ['王宝强', '谭卓', '何洁']]);

        Log::info('end ' . $this->signature);
    }
}
