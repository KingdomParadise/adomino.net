<?php

namespace App\Console\Commands;

use App\DailyVisit;
use App\Domain;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AddDailyVisitsToAdominoCom extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add-daily-visits-to-adomino-com';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add daily visits to adomino com database.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ssh_tunnel_call();

        $dailyVisits = DailyVisit::where('adomino_com_ok', false)->get();

        foreach ($dailyVisits as $visit) {
            $domain = Domain::find($visit->domain_id);

            // If domain not found or doesn't have adomino_com_id, skip this visit
            if( !isset($domain) || !isset($domain->adomino_com_id) ) continue;

            $record = DB::connection('adomino_com')
                ->table('dv_stats_requests')
                ->where('datum', $visit->day)
                ->where('domainid', $domain->adomino_com_id)
                ->where('stunde', 0)
                ->first();

            if ($record) {
                DB::connection('adomino_com')
                    ->table('dv_stats_requests')
                    ->where('datum', $visit->day)
                    ->where('domainid', $domain->adomino_com_id)
                    ->where('stunde', 0)
                    ->increment('num', $visit->visits);

                $visit->total = $visit->visits + $record->num;
            } else {
                DB::connection('adomino_com')
                    ->table('dv_stats_requests')
                    ->insert([
                        'datum' => $visit->day,
                        'domainid' => $domain->adomino_com_id,
                        'stunde' => 0,
                        'num' => $visit->visits,
                    ]);

                $visit->total = $visit->visits;
            }
            $visit->adomino_com_ok = true;
            $visit->save();
        }

        Log::info('Daily visits inserted successfully in adomino com.', [
            'daily_visits' => $dailyVisits
        ]);
    }
}
