<?php

namespace App\Http\Controllers;

use App\Beeritem;
use App\Tag;
use App\Category;
use App\Collection;
use App\Brewery;
use Spatie\Image\Image;
use Spatie\MediaLibrary\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\storeBeeritem;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;


class BeeritemController extends Controller
{
    public function __construct()
    {
         $this->middleware(['auth']);
         $this->middleware(['role:Admin|Collector']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //return $request->item_type;
        $spare = false;
        $wishlist = false;
        $search = false;

        if ($request->has('item_type') && count($request->item_type)) {
            try {
                $beeritems = Beeritem::where('user_id', Auth::id())
                    ->where('item_type', '=', $request->item_type)
                    ->sortable(['id' => 'desc'])
                    ->paginate(10);

                $type = ucfirst($request->item_type);

                return view('backend.beeritems.index', compact('type', 'spare', 'wishlist', 'search', 'beeritems'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }
        else {
            try {
                $beeritems = Beeritem::where('user_id', Auth::id())
                    ->sortable(['id' => 'desc'])
                    ->paginate(10);



                $type = ucfirst('beeritems');

                return view('backend.beeritems.index', compact('type', 'spare', 'wishlist', 'search', 'beeritems'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }



    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = Category::where('user_id', Auth::id())->get();
        $tags = Tag::where('user_id', Auth::id())->get();
        $breweries = Brewery::where('user_id', Auth::id())->get();
        $type = $request->item_type;
        $collection_types = Collection::where('user_id', Auth::id())->distinct()->pluck('collection_type');




        // Check if the user has a collection with this $type. If yes then continue, if not show error page
        // Using following code
        /*
        $collections_access = Collection::where('user_id', Auth::id())
            ->where('collection_type', '=', $request->item_type)->get();


        if (!$collections_access->isEmpty()) {

        } else {

        }
        */


        if ($request->has('item_type') && count($request->item_type)) {
            $collections = Collection::where('user_id', Auth::id())
                ->where('collection_type', '=', $request->item_type)
                ->orderBy('id','DESC')->get();
            $type = ucfirst($request->item_type);

        }
        else {
            $collections = Collection::where('user_id', Auth::id())
                ->orderBy('id','DESC')->get();
            $type = ucfirst('beeritem');

        }

        return view('backend.beeritems.create', compact('type', 'tags', 'categories', 'collections', 'breweries', 'collection_types'));
    }


    public function test(Request $request)
    {
        return view('backend.beeritems.test');
    }


    public function storeImage(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');
        $imageName = $file->getClientOriginalName();

        $name = 'user_' . Auth::id() . '_' . uniqid() . '_' . trim($file->getClientOriginalName());
        $file->move($path, $name);

        Image::load($path .'/'.$name)
            ->width(500)
            ->height(500)
            ->optimize()
            ->save(storage_path('tmp/uploads/final_'. $name ));

        unlink(storage_path('tmp/uploads/'. $name ));
        //$request->session()->push('filenames', '_new'.$imageName);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    /*
    public function storeImage(Request $request)
    {
        $image = $request->file('file');
                Log::info("Inside storeImage: Image: ". $image);
        $imageName = $image->getClientOriginalName();
                Log::info("Inside storeImage: imageName: ". $imageName);
        $image->move(public_path('images'),$imageName);
                Log::info("Inside storeImage: imageMove to: ". public_path('images/').$imageName);
        //$request->session()->push('filenames', $imageName);
                Log::info("Inside storeImage: Add to session filenames: ".$imageName);

        Image::load(public_path('images/'.$imageName))
            ->width(200)
            ->height(200)
            ->optimize()
            ->save(public_path('images/').'_new'.$imageName);
        $request->session()->push('filenames', '_new'.$imageName);

        return response()->json(['success'=>$imageName]);
    }
    */


    public function store(storeBeeritem $request)
    {
        //return $request;
        $validated = $request->validated();

        /*
        $validator = Validator::make($request->all(), [
            'item_name'=>'required',
            'item_description'=> 'required',
            'category_id'=> 'required',
            'collection_id'=> 'required',
            'brewery_id'=> 'required',
            'amount_beeritems' => 'required',
            'wishlist' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('beeritems/create?item_type=beerglasses')
                        ->withErrors($validator)
                        ->withInput();
        }
        */



        $wishlist = $this->processWishlist($request);
        $type = $request->item_type;


        $beeritem = new Beeritem([
            'user_id'               =>      Auth::id(),
            'item_type'             =>      $type,
            'item_name'             =>      $request->item_name,
            'item_description'      =>      $request->item_description,
            'category_id'           =>      $request->category_id,
            'collection_id'         =>      $request->collection_id,
            'brewery_id'            =>      $request->brewery_id,
            'item_wishlist'         =>      $wishlist,
            'item_amount'           =>      $request->amount_beeritems,
            'item_type_1'           =>      $request->item_type_1,
            'item_text'             =>      $request->item_text,
            'item_color'            =>      $request->item_color,
            'item_text_color'       =>      $request->item_text_color,
            'item_type_print'       =>      $request->item_type_print,
            'item_drawing'          =>      $request->item_drawing,
            'item_cluster'          =>      $request->item_cluster,
            'item_height'           =>      $request->item_height,
            'item_width'            =>      $request->item_width,
            'item_length'           =>      $request->item_length,
            'item_diameter_top'     =>      $request->item_diameter_top,
            'item_diameter_bottom'  =>      $request->item_diameter_bottom,
            'item_weight'           =>      $request->item_weight,
            'item_size_indication'  =>      $request->item_size_indication,
            'item_rib_type'         =>      $request->item_rib_type,
            'item_facets'           =>      $request->item_facets,
            'item_model'            =>      $request->item_model,
            'item_material'         =>      $request->item_material,
            'item_year'             =>      now(),
            'item_language'         =>      $request->item_language,
            'item_size'             =>      $request->item_size,
            'item_boxes'            =>      $request->item_boxes,
            'item_extra_1'          =>      $request->item_extra_1,
            'item_extra_2'          =>      $request->item_extra_2
        ]);
        $beeritem->save();

        //$lastInsertedId = $beeritem->id;

        foreach ($request->input('document', []) as $file) {
            switch (strtolower($type)) {
                case 'beerglasses':
                    $beeritem->addMedia(storage_path('tmp/uploads/final_' . $file ))->toMediaCollection('images_beerglasses');
                    break;
                case 'beerlabels':
                    $beeritem->addMedia(storage_path('tmp/uploads/final_'. $file ))->toMediaCollection('images_beerlabels');
                    break;
                case 'beerlcoasters':
                    $beeritem->addMedia(storage_path('tmp/uploads/final_'. $file ))->toMediaCollection('images_beercoaster');
                    break;
                case 'beerashtrays':
                    $beeritem->addMedia(storage_path('tmp/uploads/final_'. $file ))->toMediaCollection('images_beerashtrays');
                    break;
                case 'beercontainers':
                    $beeritem->addMedia(storage_path('tmp/uploads/final_'. $file ))->toMediaCollection('images_beercontainers');
                    break;
                case 'beerbottles':
                    $beeritem->addMedia(storage_path('tmp/uploads/final_'. $file ))->toMediaCollection('images_beerbottels');
                    break;
                case 'beerplateaus':
                    $beeritem->addMedia(storage_path('tmp/uploads/final_'. $file ))->toMediaCollection('images_beerplateaus');
                    break;
                case 'beeradvertisements':
                    $beeritem->addMedia(storage_path('tmp/uploads/final_'. $file ))->toMediaCollection('images_beeradvertisements');
                    break;
                case 'beerstonejugs':
                    $beeritem->addMedia(storage_path('tmp/uploads/final_'. $file ))->toMediaCollection('images_beerstonejugs');
                    break;
            }
        }







        /*
        $values=$request->session()->pull('filenames');

        foreach ($values as $value) {
           Log::info("Adding file ". $value) . " to MediaLibrary";
           $width = Image::load(public_path('images/'.$value))->getWidth();
           $beeritem
                ->addMedia(public_path('images/'.$value))
                ->toMediaCollection('BeeritemImagesCollection');
        }

        */

        $beeritem->tags()->attach($request->beeritem_tags);
        //$request->session()->forget('filenames');

        return redirect('beeritems')->with('success', 'Beeritem has been created successfully');
    }

    private function processWishlist($request) {
        if($request->wishlist == '1'){
            return true;
        }
        else{
            return false;
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Beeritem  $beeritem
     * @return \Illuminate\Http\Response
     */


    public function show(Beeritem $beeritem) {

        $tags =  Tag::where('user_id', Auth::id())->get();
        //$breweries = Brewery::where('user_id', Auth::id())->get();
        $category = $beeritem->category()->first();
        $brewery = $beeritem->brewery()->first();
        $collection = $beeritem->collection()->first();

        $type = $beeritem->item_type;
        $type = ucfirst($type);

        switch (strtolower($type)) {
            case 'beerglasses':
                $beeritemImages = $beeritem->getMedia('images_beerglasses');
                break;
            case 'beerlabels':
                $beeritemImages = $beeritem->getMedia('images_beerlabels');
                break;
            case 'beerlcoasters':
                $beeritemImages = $beeritem->getMedia('images_beercoaster');
                break;
            case 'beerashtrays':
                $beeritemImages = $beeritem->getMedia('images_beerashtrays');
                break;
            case 'beercontainers':
                $beeritemImages = $beeritem->getMedia('images_beercontainers');
                break;
            case 'beerbottles':
                $beeritemImages = $beeritem->getMedia('images_beerbottels');
                break;
            case 'beerplateaus':
                $beeritemImages = $beeritem->getMedia('images_beerplateaus');
                break;
            case 'beeradvertisements':
                $beeritemImages = $beeritem->getMedia('images_beeradvertisements');
                break;
            case 'beerstonejugs':
                $beeritemImages = $beeritem->getMedia('images_beerstonejugs');
                break;
        }

/*
 if($beeritem->user_id == Auth::id()) {
            return view('beeritems.show', compact('type', 'beeritem', 'beeritemImages'));
        }
        else {
            abort(403);
        }
*/
        /*
        if ($type) {
            $collections = Collection::where('user_id', Auth::id())
                ->where('collection_type', '=', $type)
                ->orderBy('id','DESC')->get();
            $type = ucfirst($type);

        }
        else {
            $collections = Collection::where('user_id', Auth::id())
                ->orderBy('id','DESC')->get();
            $type = ucfirst('Teeritem');
        }
        */
        return view('backend.beeritems.show', compact('beeritem', 'beeritemImages', 'type', 'tags', 'category', 'collection', 'brewery'));


    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Beeritem  $beeritem
     * @return \Illuminate\Http\Response
     */
    public function edit(Beeritem $beeritem)
    {
        $categories = Category::where('user_id', Auth::id())->get();
        $tags =  Tag::where('user_id', Auth::id())->get(); //contains all the tags
        $tags_user =  $beeritem->tags()->get(); //contains all the tags the user has selected
        //the id's for each tag the user selected are stored in an array 'tagIds' so we can use it in the edit
        //view to loop over it
        foreach($tags_user as $tag_user)
        {
            $tagIds[] = $tag_user->id;
        }

        $breweries = Brewery::where('user_id', Auth::id())->get();
        $type = $beeritem->item_type;
        $type = ucfirst($type);

        if ($type) {
            $collections = Collection::where('user_id', Auth::id())
                ->where('collection_type', '=', $type)
                ->orderBy('id','DESC')->get();
            $type = ucfirst($type);

        }
        else {
            $collections = Collection::where('user_id', Auth::id())
                ->orderBy('id','DESC')->get();
            $type = ucfirst('Teeritem');
        }

        return view('backend.beeritems.edit', compact('beeritem', 'type', 'tags', 'tagIds', 'categories', 'collections', 'breweries'));
    }





    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Beeritem  $beeritem
     * @return \Illuminate\Http\Response
     */
    public function update(storeBeeritem $request, Beeritem $beeritem)
    {
        $validated = $request->validated();
        $wishlist = $this->processWishlist($request);

        if($beeritem->user_id == auth()->user()->id) {
            $beeritem->user_id                  =   Auth::id();
            $beeritem->item_name                =   $request->item_name;
            $beeritem->item_description         =   $request->item_description;
            $beeritem->category_id              =   $request->category_id;
            $beeritem->collection_id            =   $request->collection_id;
            $beeritem->brewery_id               =   $request->brewery_id;
            $beeritem->item_wishlist            =   $wishlist;
            $beeritem->item_amount              =   $request->amount_beeritems;
            $beeritem->item_type_1              =   $request->item_type_1;
            $beeritem->item_text                =   $request->item_text;
            $beeritem->item_color               =   $request->item_color;
            $beeritem->item_text_color          =   $request->item_text_color;
            $beeritem->item_type_print          =   $request->item_type_print;
            $beeritem->item_drawing             =   $request->item_drawing;
            $beeritem->item_cluster             =   $request->item_cluster;
            $beeritem->item_height              =   $request->item_height;
            $beeritem->item_width               =   $request->item_width;
            $beeritem->item_length              =   $request->item_length;
            $beeritem->item_diameter_top        =   $request->item_diameter_top;
            $beeritem->item_diameter_bottom     =   $request->item_diameter_bottom;
            $beeritem->item_weight              =   $request->item_weight;
            $beeritem->item_size_indication     =   $request->item_size_indication;
            $beeritem->item_rib_type            =   $request->item_rib_type;
            $beeritem->item_facets              =   $request->item_facets;
            $beeritem->item_model               =   $request->item_model;
            $beeritem->item_material            =   $request->item_material;
            $beeritem->item_year                =   now();
            $beeritem->item_language            =   $request->item_language;
            $beeritem->item_size                =   $request->item_size;
            $beeritem->item_boxes               =   $request->item_boxes;
            $beeritem->item_extra_1             =   $request->item_extra_1;
            $beeritem->item_extra_2             =   $request->item_extra_2;
            $beeritem->save();
        }
        else {
            abort('403');
        }
        $beeritem->tags()->sync($request->beeritem_tags, true);

        return redirect('beeritems')->with('success', 'Beeritem has been updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Beeritem  $beeritem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Beeritem $beeritem)
    {
          try {
            if($beeritem->user_id == Auth::id()) {
                $beeritem->tags()->detach($beeritem->tags);
                $beeritem->delete();
                return redirect()->route('beeritems.index')->with('success','Beeritem has been deleted successfully');
            }
            else {
                abort('403');
            }
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('beeritems.index')->with('error', 'Beeritem cannot be deleted due to integrity constraints (beerglass has one or more tags)');

        }
    }

    public function spares(Request $request) {
        $spare = true;
        $wishlist = false;
        $search = false;

        if ($request->has('item_type') && count($request->item_type)) {
            try {
                $beeritems = Beeritem::where('user_id', Auth::id())
                    ->where('item_amount', '>=', '2')
                    ->where('item_type', '=', $request->item_type)
                    ->sortable(['id' => 'desc'])
                    ->paginate(10);

                $type = ucfirst($request->item_type);

                return view('backend.beeritems.index', compact('type', 'spare', 'wishlist', 'search', 'beeritems'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }
        else {
            try {
                $beeritems = Beeritem::where('user_id', Auth::id())
                    ->where('item_amount', '>=', '2')
                    ->sortable(['id' => 'desc'])
                    ->paginate(10);

                $type = ucfirst('beeritems');

                return view('backend.beeritems.index', compact('type', 'spare', 'wishlist', 'search', 'beeritems'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }

    }

    public function wishlist(Beeritem $beeritem, Request $request) {
        $wishlist = true;
        $spare = false;
        $search = false;

        if ($request->has('item_type') && count($request->item_type)) {
            try {
                $beeritems = Beeritem::where('user_id', Auth::id())
                    ->where('item_wishlist', true)
                    ->where('item_type', '=', $request->item_type)
                    ->sortable(['id' => 'desc'])
                    ->paginate(10);

                $type = ucfirst($request->item_type);

                return view('backend.beeritems.index', compact('type', 'spare', 'wishlist', 'search', 'beeritems'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }
        else {
            try {
                $beeritems = Beeritem::where('user_id', Auth::id())
                    ->where('item_wishlist', true)
                    ->sortable(['id' => 'desc'])
                    ->paginate(10);

                $type = ucfirst('beeritems');

                return view('backend.beeritems.index', compact('type', 'spare', 'wishlist', 'search', 'beeritems'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Beeritem  $beeritem
     * @return \Illuminate\Http\Response
     */
    public function importexport(Beeritem $beeritem)
    {

        return view('backend.importexport.index');
    }

    public function displayGrid(Request $request)
    {
        if ($request->has('item_type') && count($request->item_type)) {
            try {
                $beeritems = Beeritem::where('user_id', Auth::id())
                    ->where('item_type', '=', $request->item_type)
                    ->sortable(['id' => 'desc'])
                    ->get();


                $type = ucfirst($request->item_type);

                $media = Media::all();


                return view('backend.beeritems.grid', compact('type', 'beeritems', 'media'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }
        else {
            try {
                $beeritems = Beeritem::where('user_id', Auth::id())
                    ->sortable(['id' => 'desc'])
                    ->get();


                $type = ucfirst('beeritems');

                $media = Media::all();

                return view('backend.beeritems.grid', compact('type', 'beeritems', 'media'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }

    }

    public function displayGallery(Request $request)
    {
        if ($request->has('item_type') && count($request->item_type)) {
            try {
                $type = ucfirst($request->item_type);




                $media = Media::where('collection_name', 'images_' . strtolower($type) )->paginate(5);
                $media->appends($request->all());


                return view('backend.beeritems.gallery', compact('type', 'media'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }
        else {
            try {
                $type = ucfirst('beeritems');


                $media = Media::paginate(5);
                $media->appends($request->all());

                return view('backend.beeritems.gallery', compact('type', 'media'));
            }
            catch (\Kyslik\ColumnSortable\Exceptions\ColumnSortableException $e) {
                dd($e);
            }
        }




    }


    public function search(Request $request)
    {
        $spare = false;
        $wishlist = false;
        $search = true;

        $type = ucfirst($request->item_type);
        $q = Input::get( 'q' );

        if ($request->item_type == 'Beeritems') {


            $beeritems = Beeritem::where('item_type', '<>', $type)
                ->where(function($query) use ($q) {
                    $query
                        ->where('item_name', 'LIKE' ,'%'.$q.'%')
                        ->orWhere('item_description', 'LIKE' ,'%'.$q.'%')
                        ->orWhere('item_color', 'LIKE' ,'%'.$q.'%');
                })
                ->orWhereHas('category', function ($query) use ($q) {
                    $query->where('category_name', $q);
                })
            ->sortable(['id' => 'desc'])
            ->paginate(10);

        }
        else {
            $beeritems = Beeritem::where('item_type', '=', $type)
                ->where(function($query) use ($q) {
                    $query->where('item_name','LIKE','%'.$q.'%');
                })

            ->sortable(['id' => 'desc'])
            ->paginate(10);
        }

        if(count($beeritems) > 0) {
            return view('backend.beeritems.index', compact('type', 'spare', 'wishlist', 'search', 'q', 'beeritems'));
        }
        else {
            return redirect()->route('backend.beeritems.index')->with('error', 'No beeritems found via search functionality');
        }

    }

}
