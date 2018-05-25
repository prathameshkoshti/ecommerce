<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Brand;
use Auth;
class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$brands = Brand::all();
        return view('admin.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.brands.create');
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

		Brand::create([
			'name' => request('name'),
			'status' => $request->status == 'on'? 1: 0,
			'created_by' => Auth::user()->id,
			'updated_by' => Auth::user()->id,
		]);

		\Session::flash('success', 'Brand: '.$request->name.' created successfully!');
		return redirect('/admin/brands');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$brand = Brand::find($id);
		if($brand)
			return view('admin.brands.view', compact('brand'));
		else
		{
			\Session::flash('danger', 'No brand found having the id '.$id.'!');
			return redirect('admin/brands');
		}
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$brand = Brand::find($id);
		if($brand)
			return view('admin.brands.edit', compact('brand'));
		else
		{
			\Session::flash('danger', 'No brand found having the id '.$id.'!');
			return redirect('admin/brands');
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
		$brand = Brand::find($id);
		if(!$brand)
		{
			\Session::flash('danger', 'No brand found having the id '.$id.'!');
			return redirect('admin/brands');
		}

        $this->validate($request,[
			'name' => 'required',
		]);

		$brand->name = $request->name;
		$brand->status = $request->status == 'on' ? 1 : 0;
		$brand->updated_by = Auth::user()->id;
		$brand->save();

		\Session::flash('success', 'Brand: '.$request->name.' updated successfully!');
		return redirect('/admin/brands');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$brand = Brand::find($id);
		if(!$brand)
		{
			\Session::flash('danger', 'No brand found having the id '.$id.'!');
			return redirect('admin/brands');
		}

		$brand->status = 0;
		$brand->updated_by = Auth::user()->id;

		$brand->save();

		\Session::flash('warning', 'Brand: '.$brand->name.' deleted successfully!');
		return redirect('admin/brands');
    }
}
