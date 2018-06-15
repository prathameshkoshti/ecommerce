<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Size;
use Auth;

class SizesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$sizes = Size::all();
		return view('admin.sizes.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.sizes.create');
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

		Size::create([
			'name' => request('name'),
			'status' => ($request->status == 'on' ? 1 : 0),
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);

		\Session::flash('success', 'Size created successfully!');
		return redirect('/admin/sizes');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$size = Size::find($id);
		if(!$size)
		{
			\Session::flash('danger', 'ID: '.$id.' not found');
			return redirect('/admin/sizes');
		}
		return view('admin.sizes.view', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$size = Size::find($id);
		if(!$size)
		{
			\Session::flash('danger', 'Size not found having id: '.$id);
			return redirect('/admin/sizes');
		}
		return view('admin.sizes.edit', compact('size'));
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
		$size = Size::find($id);

		if(!$size)
		{
			\Session::flash('danger', 'Size not found having id: '.$id);
			return redirect('/admin/sizes');
		}

        $this->validate($request, [
			'name' => 'required',
		]);

		$size->name = $request->name;
		$size->status = $request->status == 'on' ? 1 : 0;
		$size->updated_by = Auth::user()->id;

		$size->save();

		\Session::flash('success', 'Size: '.$size->name.' updated successfully!');
		return redirect('/admin/sizes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$size = Size::find($id);

		if(!$size)
		{
			\Session::flash('danger', 'Size not found having id: '.$id);
			return redirect('/admin/sizes');
		}

		$size->status = 0;
		$size->updated_by = Auth::user()->id;

		$size->save();

		\Session::flash('warning', 'Size: '.$size->name.' delted successfully!');
		return redirect('/admin/sizes');
    }
}
