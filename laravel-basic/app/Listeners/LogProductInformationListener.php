<?php

namespace App\Listeners;

use App\Events\ProductAddedEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogProductInformationListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(ProductAddedEvent $event): void
    {
        // イベントのインスタンスに含まれている商品情報をログに記録する
        Log::info('新商品が追加されました:', ['product' => $event->product]);
    }
}
