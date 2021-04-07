<?php

namespace App\Console\Commands;

use App\DailyVisit;
use App\Domain;
use App\VisitsPerDay;
use Illuminate\Console\Command;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class AddTotalToVisitsPerDays extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'add-total-to-visits-per-day {day?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add total from daily visits to visits per days';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        ini_set('memory_limit', '-1');
        set_time_limit(0);
        $day = $this->argument('day') ?: 1;
        for ($i = 1; $i <= $day; $i++) {
            $date = now()->subDays($i);

            $columnName = 'day' . $date->format('Ymd');
            $columnExist = Schema::hasColumn('visits_per_days', $columnName);

            if (!$columnExist) {
                Schema::table('visits_per_days', function (Blueprint $table) use ($columnName) {
                    $table->integer($columnName)->default(0);
                });
            }
        }
        $dailyVisits = DailyVisit::where('day', '>=', $date->format('Y-m-d'))->get();
        foreach ($dailyVisits as $dailyVisit) {
            if ($dailyVisit->total == null) {
                $dailyVisit->total = 0;
            }
            VisitsPerDay::updateOrCreate(
                ['domain_id' => $dailyVisit->domain_id],
                ['day' . $dailyVisit->day->format('Ymd') => $dailyVisit->total]
            );
//            $dailyVisit->delete();
        }

        $existingDomains = VisitsPerDay::pluck('domain_id')->unique()->toArray();
        $nonAddedDomainsIds = Domain::whereNotIn('id', $existingDomains)->pluck('id');
        foreach ($nonAddedDomainsIds as $id) {
            VisitsPerDay::updateOrCreate(
                ['domain_id' => $id]
            );
        }
        Log::info('Data added to visits per days table.', [
            'daily_visits' => $dailyVisits,
        ]);
    }
}
