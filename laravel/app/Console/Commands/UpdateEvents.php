<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use Carbon\Carbon;

class UpdateEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:events';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update events in database';

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
        $current = Carbon::now()->format('Y-m-d');
        $time = Carbon::now()->format('H:m:s');
        DB::table('events')
        ->where('date', '<', $current)
        ->update(array('status' => 'canceled', 'cancellation_description' => 'Date has expired.'));
        DB::table('events')
        ->where([['date', '=', $current], ['start', '<=', $time]])
        ->update(array('status' => 'canceled', 'cancellation_description' => 'Date has expired.'));
    }
}
