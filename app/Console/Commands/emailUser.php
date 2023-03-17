<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Quote;
use Mail;

class emailUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:user';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will send remainder email to user';

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
      //  echo 'i am test cron job';
        $from = Carbon::now()->subDays(6)->startOfDay();
        $to = Carbon::now()->subDays(8)->endOfDay();
        // dd($to);
        $quote = Quote::where('status', 'sent')
            ->where('created_at', '<=', $from)
            ->where('created_at', '>=', $to)
            ->get();

        if ($quote) {
            // dd($quote);
            foreach ($quote as $email) {
                $emails = $email->client->email;

                Mail::send('pdf_email.reminder', [
                    "name" => $email->client->name,
                ], function ($mail) use ($emails) {
                    $mail->from('info@furniturepaintspraying.co.uk', 'Roka Spraying');

                    $mail->to($emails)->subject('Roka Spraying quote Reminder email');

                });

                $email->status = 'reminder';
                $email->save();
            }
        }
    }
}
