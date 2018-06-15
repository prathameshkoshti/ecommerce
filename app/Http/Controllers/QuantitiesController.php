<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Size;
use App\Quantity;
use Auth;

class QuantitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$quantities = Quantity::all();
		return view('admin.quantities.index', compact('quantities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$products = Product::where('status', 1)->get();
		$sizes = Size::where('status', 1)->get();
        return view('admin.quantities.create', compact('products', 'sizes'));
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
			'product' => 'required|numeric',
			'size' => 'required|numeric',
			'quantity' => 'required|numeric|min:0',
		]);

		try{
			$quantity = Quantity::create([
				'product_id' => request('product'),
				'size_id' => request('size'),
				'quantity' => request('quantity'),
				'status' => ($request->status == 'on' ? 1 : 0),
				'created_by' => Auth::user()->id,
				'updated_by' => Auth::user()->id,
			]);
		}
		catch(\PDOException $e)
		{
			\Session::flash('danger', $e->errorInfo[2].': Product already exist!');
			return redirect('/admin/quantities/create');
		}

		\Session::flash('success', 'Quantity added for product: '.$quantity->product->name.' having size: '.$quantity->size->name.' successfully!');
		return redirect('/admin/quantities');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
		$quantity = Quantity::find($id);
		if(!$quantity)
		{
			\Session::flash('danger', 'Quantity not found having id: '.$id);
			return redirect('/admin/quantities');
		}
		return view('admin.quantities.view', compact('quantity'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quantity = Quantity::find($id);
		if(!$quantity)
		{
			\Session::flash('danger', 'Quantity not found having id: '.$id);
			return redirect('/admin/quantities');
		}

		$products = Product::where('status', 1)->get();
		$sizes = Size::where('status', 1)->get();

		return view('admin.quantities.edit', compact('quantity', 'products', 'sizes'));
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
		$quantity = Quantity::find($id);
		if(!$quantity)
		{
			\Session::flash('danger', 'Quantity not found having id: '.$id);
			return redirect('/admin/quantities');
		}

        $this->validate($request, [
			'product' => 'required',
			'size' => 'required',
			'quantity' => 'required|numeric|min:0',
		]);

		$quantity->product_id = $request->product;
		$quantity->size_id = $request->size;
		$quantity->quantity = $request->quantity;
		$quantity->status = $request->status == 'on' ? 1 : 0;
		$quantity->updated_by = Auth::user()->id;

		try{
			$quantity->save();
		}
		catch(\PDOException $e)
		{
			\Session::flash('danger', $e->errorInfo[2].': Product already exist!');
			return redirect('/admin/quantities/edit');
		}

		\Session::flash('success', 'Quantity for product: '.$quantity->product->name.' having size:'.$quantity->size->name.' updated successfully');
		return redirect('/admin/quantities');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quantity = Quantity::find($id);
		if(!$quantity)
		{
			\Session::flash('danger', 'Quantity not found having id: '.$id);
			return redirect('/admin/quantities');
		}

		$quantity->status = 0;
		$quantity->updated_by = Auth::user()->id;

		$quantity->save();

		\Session::flash('warning', 'Quantity for product: '.$quantity->product->name.' having size: '.$quantity->size->name.' deleted successfully');
		return redirect('/admin/quantities');
    }
}
