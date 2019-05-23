<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Brewery extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = 'App\Brewery';

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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

            Text::make('Brewery Name')
                ->sortable(),

            Text::make('Brewery Description')
                ->sortable(),

            Text::make('Brewery Zipcode')
                ->hideFromIndex()
                ->sortable(),

            Text::make('Brewery Town')
                ->hideFromIndex()
                ->sortable(),

            Text::make('Brewery Subtown')
                ->hideFromIndex()
                ->sortable(),

            Text::make('Brewery Province')
                ->hideFromIndex()
                ->sortable(),

            Text::make('Brewery Country')
                ->hideFromIndex()
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

            HasMany::make('Beeritem'),

            BelongsTo::make('User')

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
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
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
