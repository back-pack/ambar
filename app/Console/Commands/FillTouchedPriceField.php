<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FillTouchedPriceField extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order-articles:fill-touched-price';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $order_articles = \App\OrderArticle::all();

        foreach ($order_articles as $order_article) {
            $order_article->touched_price = $order_article->price - (($order_article->discount * $order_article->price) / 100);
            $order_article->save();
        }
    }
}
