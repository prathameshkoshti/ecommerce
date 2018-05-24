<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Material;
use Auth;

class MaterialsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$materials = Material::all();
		return view('admin.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.materials.create');
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

		Material::create([
			'name' => request('name'),
			'status' => $request->status == 'on'? 1 : 0,
			'created_by' => Auth::user()->id,
			'updted_by' => Auth::user()->id,
		]);

		\Session::flash('success', 'Material: '.$request->name.' added successfully!');
		return redirect('/admin/materials');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$material = Material::find($id);
		if($material)
			return view('admin.materials.view', compact('material'));
		else
		{
			\Session::flash('danger', 'No material found having the id '.$id.'!');
			return redirect('admin/materials');
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
		$material = Material::find($id);
		if($material)
			return view('admin.materials.edit', compact('material'));
		else
		{
			\Session::flash('danger', 'No material found having the id '.$id.'!');
			return redirect('admin/materials');
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
		$material = Material::find($id);
		if(!$material)
		{
			\Session::flash('danger', 'No material found having the id '.$id.'!');
			return redirect('admin/materials');
		}

		$this->validate($request, [
			'name' => 'required',
		]);

		$material->name = $request->name;
		$material->status = $request->status == 'on'? 1 : 0;
		$material->updated_by = Auth::user()->id;

		$material->save();
		\Session::flash('success', 'Material: '.$request->name.' updated successfully!');

		return redirect('admin/materials');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$material = Material::find($id);
		if(!$material)
		{
			\Session::flash('danger', 'No material found having the id '.$id.'!');
			return redirect('admin/materials');
		}

		$material->status = 0;
		$material->save();

		\Session::flash('warning', 'Material: '.$material->name.' deleted successfully!');
		return redirect('/admin/materials');
    }
}
