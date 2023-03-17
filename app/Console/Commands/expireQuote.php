<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Client;
use App\Models\Product;
use App\Models\Quote;
use App\Models\Deal;

class expireQuote extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'expire:quote';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This is quote expire cron job';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $month = Carbon::now()->subMonth(2);
        $quote = Quote::with('deals', 'deals.product', 'client')
            ->where('status', 'reminder')
            ->where('created_at','<=', $month)
            ->get();
        if($quote) {
            //dd($quote);
            foreach($quote as $expired){
                $expired->status = 'expired';
                $expired->save();
            }
        }
    }
}
