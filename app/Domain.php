<?php

namespace App;

use App\Traits\SetGetDomain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Domain extends Model
{
//    use SoftDeletes, HasTranslations, SetGetDomain;
    use SoftDeletes, HasTranslations;

    public $translatable = ['info'];

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'created_at', 'updated_at',
    ];

    public static function findDomainByName($domain)
    {
        return Domain::where('domain', $domain)->first();
    }

    public static function displayDomain($domain, $domainId)
    {
        return "<a href='" . route('edit-domain', [$domainId]) . "'><img src='" . url('/img/wpage.gif') . "'/></a>&nbsp;" . '<a href="http://' . $domain . '" target="_blank">' . $domain . '</a>';
    }

    public static function deleteDomain($id)
    {
        return Domain::find($id)->delete();
    }

    public static function getDomain($id)
    {
        return Domain::find($id);
    }

    public static function getAllDomain($paginate = false)
    {
        if ($paginate) {
            return Domain::select('id', 'domain as text')->paginate(2000);
        }
    }

    public static function saveDomain($domainArray)
    {
        if (isset($domainArray['id']))
            $domain = Domain::find($domainArray['id']);
        else
            $domain = new Domain();
        foreach ($domainArray as $domain_col => $domain_val) {
            $domain->$domain_col = $domain_val;
        }
        $domain->save();
    }

    public static function getLandingPageMode()
    {
        return [
            'price_evaluation' => 'Domain Preis-Evaluierung',
            'review' => 'Domain in Prüfung',
            'request_offer' => 'Angebot anfordern',
            'sold' => 'Domain verkauft',
            'auction_preparing' => 'Auktion in Vorbereitung',
            'auction_soon' => 'Auktion startet in Kürze',
            'auction_active' => 'Auktion Aktiv',
            'auction_not_sold' => 'Auktion beendet ohne Verkauf',
            'auction_sold' => 'Auktion Domain verkauft',
        ];
    }

    /**
     * Get the inquiries for the domain.
     */
    public function inquiries()
    {
        return $this->hasMany('App\Inquiry');
    }

    /**
     * Get the visits for the domain.
     */
    public function visits()
    {
        return $this->hasMany('App\Visit');
    }

    /**
     * Get the visits for the domain.
     */
    public function dailyVisits()
    {
        return $this->hasMany('App\DailyVisit');
    }

    /**
     * Get the visits per day record associated with the user.
     */
    public function visitsPerDay()
    {
        return $this->hasOne('App\VisitsPerDay');
    }
}
