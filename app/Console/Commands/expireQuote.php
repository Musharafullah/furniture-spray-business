<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Quote;

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
       // echo 'expire job cron';
        $month = Carbon::now()->subMonth(2);
        // dd($month);
        $quote = Quote::where('status', 'reminder')
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
