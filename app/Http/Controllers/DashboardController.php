<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Beeritem;
use App\Tag;
use App\Category;
use App\Collection;
use App\Brewery;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{
       public function __construct()
    {
         $this->middleware(['auth']);
         $this->middleware(['role:Admin|Collector']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $beeritem_count = Beeritem::where('user_id', Auth::id())->count();
        $beerglasses_count = Beeritem::where('user_id', Auth::id())->where('item_type', '=', 'beerglasses')->count();
        $beerashtrays_count = Beeritem::where('user_id', Auth::id())->where('item_type', '=', 'beerashtrays')->count();
        $beercontainers_count = Beeritem::where('user_id', Auth::id())->where('item_type', '=', 'beercontainers')->count();
        $beerlabels_count = Beeritem::where('user_id', Auth::id())->where('item_type', '=', 'beerlabels')->count();
        $beerbottles_count = Beeritem::where('user_id', Auth::id())->where('item_type', '=', 'beerbottles')->count();
        $beerplatteaus_count = Beeritem::where('user_id', Auth::id())->where('item_type', '=', 'beerplateaus')->count();
        $beeradvertisements_count = Beeritem::where('user_id', Auth::id())->where('item_type', '=', 'beeradvertisements')->count();
        $beercoasters_count = Beeritem::where('user_id', Auth::id())->where('item_type', '=', 'beercoasters')->count();
        $beerstonejugs_count = Beeritem::where('user_id', Auth::id())->where('item_type', '=', 'beerstonejugs')->count();
        $brewery_count = Brewery::where('user_id', Auth::id())->count();
        $collection_count = Collection::where('user_id', Auth::id())->count();
        $tag_count = Tag::count();
        $category_count = Category::where('user_id', Auth::id())->count();

        return view('backend.dashboard.dashboard', compact(
            'beeritem_count',
            'beerglasses_count',
            'beerashtrays_count',
            'beercontainers_count',
            'beerlabels_count',
            'beerbottles_count',
            'beerplatteaus_count',
            'beeradvertisements_count',
            'beercoasters_count',
            'beerstonejugs_count',
            'brewery_count',
            'collection_count',
            'tag_count',
            'category_count'));
    }
}
