<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Event;
use Carbon\Carbon;

class unpublishEvent extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'unpublish:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Commad Unpublishes Events Which Have The Dates Lesser Than Todays Date';

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
        $dt = Carbon::now()->toDateString();

    

        Event::where('event_end', '<', $dt)
                ->update([
                    'status' => '3'
                ]);
    }
}
