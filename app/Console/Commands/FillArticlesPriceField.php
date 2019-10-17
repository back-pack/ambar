<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class FillArticlesPriceField extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'articles:fillprice';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command fills the price of all articles with the result of summing cost and margin';

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
        $articles = \App\Article::all();

        foreach ($articles as $article) {
            if ($article->price == 0.00) {
                $article->price = $article->cost + $article->margin;
                $article->save();
            }
        }
    }
}
