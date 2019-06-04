<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;



class Beeritem extends Model implements HasMedia
{
    use Sortable;
    use HasMediaTrait;


    protected $fillable = [
        'user_id',
        'collection_id',
        'brewery_id',
        'category_id',
        'item_type',
        'item_name',
        'item_description',
        'item_amount',
        'item_wishlist',
        'item_type_1',
        'item_text',
        'item_color',
        'item_text_color',
        'item_type_print',
        'item_drawing',
        'item_cluster',
        'item_height',
        'item_width',
        'item_length',
        'item_diameter_top',
        'item_diameter_bottom',
        'item_weight',
        'item_size_indication',
        'item_rib_type',
        'item_facets',
        'item_model',
        'item_material',
        'item_year',
        'item_language',
        'item_size',
        'item_boxes',
        'item_extra_1',
        'item_extra_2',
        'created_at',
        'updated_at'
    ];

    public $sortable = [
        'id','item_name', 'created_at'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function collection()
    {
        return $this->belongsTo('App\Collection');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag', 'beeritems_tag');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function brewery()
    {
        return $this->belongsTo('App\Brewery');
    }

}
