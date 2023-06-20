<?php

namespace App\Http\Controllers\Api\V1\Categories;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    use HttpResponses;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // - Show All Categories
        //=============================================
        try{
            return CategoryResource::collection(Category::all());
        }catch(\Exception $e) {
            return $this->error('', 'Something went wrong', 501);        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // TODO: Ask if They Want to make user can make a category
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        // - Show The Specified Categories
        //=============================================
        try {
            $category = Category::find($category->id)->first();
            return new CategoryResource($category);
        }catch(\Exception $e) {
            return $this->error('', 'Something went Wrong', 500);
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // TODO: Ask if They Want to make user can update a category data
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // TODO: Ask if They Want to make user can delete a category
    }


}
