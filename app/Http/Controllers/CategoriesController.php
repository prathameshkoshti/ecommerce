<?php

namespace App\Http\Controllers;

use App\Category;
use Auth;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$categories = Category::all();
		return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
			'name' => 'required',
		]);

		Category::create([
			'name' => request('name'),
			'status' => $request->status == 'on'? 1: 0,
			'created_by' => Auth::user()->id,
		]);

		\Session::flash('create', 'Category added successfully!');
		return redirect('/admin/categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$category = Category::find($id);
		return view('admin.categories.view', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$category = Category::find($id);
		return view('admin.categories.edit', compact('category'));
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
		$this->validate($request, [
			'name' => 'required',
		]);

		$category = Category::find($id);

		$category->name = $request->name;
		$category->status = $request->status == 'on'? 1 : 0;
		$category->updated_by = Auth::user()->id;

		$category->save();
		\Session::flash('update', 'Category updated succssfully!');

		return redirect('admin/categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$category = Category::find($id);

		if($category)
		{
			$category->status = 0;
			$category->save();

			\Session::flash('delete', 'Category deleted successfully!');
			return redirect('/admin/categories');
		}
    }
}
