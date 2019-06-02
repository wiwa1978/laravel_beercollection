<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;

class Collection extends Model
{

    const TYPE_BEERGLASSES = 'Beerglasses';
    const TYPE_BEERASHTRAYS = 'Beerashtrays';
    const TYPE_BEERCONTAINERS = 'Beercontainers';            //Bierbak
    const TYPE_BEERLABELS = 'Beerlabels';
    const TYPE_BEERBOTTLES = 'Beerbottles';                  //Bierfles
    const TYPE_BEERPLATEAUS = 'Beerplateaus';
    const TYPE_BEERADVERTISEMENTS = 'Beeradvertisements';
    const TYPE_BEERCOASTERS = 'Beercoasters';
    const TYPE_BEERSTONEJUGS = 'Beerstonejugs';


    protected $fillable = [
        'user_id', 'collection_name', 'collection_description', 'collection_type'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public static function getCollectionTypes()
    {
        return [
            self::TYPE_BEERGLASSES => self::TYPE_BEERGLASSES,
            self::TYPE_BEERASHTRAYS =>  self::TYPE_BEERASHTRAYS,
            self::TYPE_BEERCONTAINERS => self::TYPE_BEERCONTAINERS,
            self::TYPE_BEERLABELS => self::TYPE_BEERLABELS,
            self::TYPE_BEERBOTTLES => self::TYPE_BEERBOTTLES,
            self::TYPE_BEERPLATEAUS => self::TYPE_BEERPLATEAUS,
            self::TYPE_BEERADVERTISEMENTS => self::TYPE_BEERADVERTISEMENTS,
            self::TYPE_BEERCOASTERS => self::TYPE_BEERCOASTERS,
            self::TYPE_BEERSTONEJUGS => self::TYPE_BEERSTONEJUGS,
        ];
    }

    public static function getCollectionType_Beerglasses()
    {
        return [
            self::TYPE_BEERGLASSES => self::TYPE_BEERGLASSES,
        ];
    }

    public static function getCollectionTypesPerUser($user)
    {
        return [
            Collection::where('user_id', $user)
        ];
    }

    public function beeritem()
    {
        return $this->hasMany('App\Beeritem');
    }

}
