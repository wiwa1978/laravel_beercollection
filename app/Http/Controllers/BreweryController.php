<?php

namespace App\Http\Controllers;

use App\Brewery;
use App\Category;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\storeBrewery;
use Illuminate\Support\Facades\Input;

class BreweryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = false;
        $breweries = Brewery::where('user_id', Auth::id())->orderBy('id','DESC')->paginate(10);
        return view('backend.breweries.index', compact('breweries', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = DB::table("countries")->pluck("name","id");
        return view('backend.breweries.create',compact('countries'));

    }


    public function getCountryList()
    {
        $countries = DB::table("countries")->pluck("name","id");
        return view('backend.breweries.create',compact('countries'));
    }

    public function getStateList(Request $request)
    {
        $states = DB::table("states")
            ->where("country_id",$request->country_id)
            ->pluck("name","id");
        return response()->json($states);
    }

    public function getCityList(Request $request)
    {
        $cities = DB::table("cities")
            ->where("state_id",$request->state_id)
            ->pluck("name","id");
        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(storeBrewery $request)
    {
        $validated = $request->validated();

        $brewery = new Brewery([
            'user_id' => Auth::id(),
            'brewery_name' => $request->brewery_name,
            'brewery_description' => $request->brewery_description,
            'brewery_zipcode' => $request->brewery_zipcode,
            'brewery_subtown' => $request->brewery_subtown,
            'brewery_town' => $request->brewery_town,
            'brewery_province' => $request->brewery_province,
            'brewery_country' => $request->brewery_country,
        ]);
        $brewery->save();

        return redirect('/breweries')->with('success', 'Brewery has been added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Brewery  $brewery
     * @return \Illuminate\Http\Response
     */
    public function show(Brewery $brewery)
    {
        if($brewery->user_id == Auth::id()) {
            return view('backend.breweries.show', compact('brewery'));
        }
        else {
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brewery  $brewery
     * @return \Illuminate\Http\Response
     */
    public function edit(Brewery $brewery)
    {
        if($brewery->user_id == Auth::id()) {
            return view('backend.breweries.edit', compact('brewery'));
        }
         else {
            abort(403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brewery  $brewery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brewery $brewery)
    {
        if($brewery->user_id == auth()->user()->id) {
            $brewery->user_id = Auth::id();
            $brewery->brewery_name = $request->brewery_name;
            $brewery->brewery_description = $request->brewery_description;
            $brewery->brewery_zipcode = $request->brewery_zipcode;
            $brewery->brewery_town = $request->brewery_town;
            $brewery->brewery_subtown = $request->brewery_subtown;
            $brewery->brewery_province = $request->brewery_province;
            $brewery->brewery_country = $request->brewery_country;
            $brewery->save();

            return redirect('breweries')->with('success', 'Brewery has been updated successfully');
        } else {
            abort('403');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brewery  $brewery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brewery $brewery)
    {
        try {
            if($brewery->user_id == Auth::id()) {
                $brewery->delete();
                return redirect()->route('breweries.index')->with('success','Brewery has been deleted successfully');
            }
            else {
                abort('403');
            }
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('breweries.index')->with('error', 'Brewery cannot be deleted due to integrity constraints');

        }

    }

    public function search(Request $request)
    {
        $search = true;

        $q = Input::get( 'q' );

        $breweries = Brewery::where(function($query) use ($q) {
                    $query->where('brewery_name','LIKE','%'.$q.'%');
                })

            ->paginate(10);



        if(count($breweries) > 0) {
            return view('backend.breweries.index', compact('q', 'breweries', 'search'));
        }
        else {
            return redirect()->route('breweries.index')->with('error', 'No breweries found via search functionality');
        }

    }

    public function search123(Request $request)
    {
        $type = ucfirst('beeritems');

        $q = Input::get( 'q' );

        $breweries = Brewery::where('brewery_name','LIKE','%'.$q.'%')
                ->orWhere('brewery_description','LIKE','%'.$q.'%')
                ->sortable(['id' => 'desc'])
                ->paginate(10);
            if(count($breweries) > 0) {
                //return view('beeritems.index')->withDetails($beeritems)->withQuery ( $q );
                return view('backend.breweries.index', compact('breweries'));
            }
            else {
                return view ('welcome')->withMessage('No details found. Try to search again !');
            }

    }




}
