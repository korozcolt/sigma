<?php

namespace App\Console\Commands;

use App\Enums\EntityStatus;
use App\Helpers\Helper;
use Illuminate\Console\Command;

class UpdateVoterStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'voter:update-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the status of a voter if the DNI exists in ExternalNumber';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $voters = \App\Models\Voter::all();
        $voters->each(function ($voter){
            Helper::voterExists($voter->dni) ? $voter->update(['status' => EntityStatus::VERIFICADO]) : $voter->update(['status' => EntityStatus::RECHAZADO]);
        });
        return Command::SUCCESS;
    }
}
