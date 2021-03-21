<?php

namespace App\Console\Commands;

use App\{DailyVisit, Visit, Domain};
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DailyVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'daily-visits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Count daily visits before today from visits table.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $visits = Visit::where('created_at', '<', now()->format('Y-m-d'));

        $dailyVisits = $visits->get()->groupBy(function ($item) {
                return $item['created_at']->format('Y-m-d');
            })
            ->map(function ($visits, $date) {
                return $visits
                    ->groupBy('domain_id')
                    ->map(function ($visits, $domainId) use ($date) {
                        return [
                            'domain_id' => $domainId,
                            'day' => $date,
                            'visits' => $visits->unique('ip')->count(),
                            'created_at' => now(),
                            'updated_at' => now(),
                        ];
                    });
            })
            ->flatten(1)
            ->toArray();

        DailyVisit::insert($dailyVisits);
        Log::info('Daily visits inserted successfully.', [
            'daily_visits' => $dailyVisits
        ]);

        $visits->delete();
        Log::info('Visits deleted successfully.');
    }
}
