<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WebSocket as WebSocketService;

class WebSocket extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'web:socket';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '聊天室服务';

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
        //
        $sk=new WebSocketService('127.0.0.1',8000);
        //对创建的socket循环进行监听，处理数据
        $sk->run();
    }
}
