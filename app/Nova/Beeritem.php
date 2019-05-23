<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;

use Illuminate\Http\Request;
use Laravel\Nova\Http\Requests\NovaRequest;

use Laravel\Nova\Metrics\ItemsPerDay;
use Laravel\Nova\Metrics\BeeritemsPerCategory;
use Laravel\Nova\Metrics\NewBeeritems;

class Beeritem extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Beeritem';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'item_name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Item Name')
                ->sortable(),

            Text::make('Item Description')
                ->sortable(),

            DateTime::make('Created At')
                ->sortable()
                ->exceptOnForms()
                ->rules('required', 'max:255')
                ->format('DD MMM YYYY'),

            DateTime::make('Updated At')
                ->sortable()
                ->exceptOnForms()
                ->rules('required', 'max:255')
                ->format('DD MMM YYYY'),


            BelongsToMany::make('Tags'),

            BelongsTo::make('User'),

            BelongsTo::make('Category')
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request)
    {
        return [
            (new Metrics\ItemsPerDay)->width('1/3'),
            (new Metrics\NewBeeritems)->width('1/3'),
            (new Metrics\BeeritemsPerCategory)->width('1/3')
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [


        ];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request)
    {
        return [];
    }
}
