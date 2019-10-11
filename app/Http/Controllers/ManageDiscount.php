<?php

namespace App\Http\Controllers;

use App\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Sales;
use DateTime;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class ManageDiscount extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('verifyRoles');
        $this->middleware('getRoles');
    }

    public function index()
    {
        $dat = Discount::all();
        return view('discount.show')->with(compact('dat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Sales::where("available", ">", 0)->get();
        return view('discount.create')->with(compact('data'));
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
            'title'       => 'required',
            'amount'      => 'required|numeric',
            'product_id'  => 'required|numeric',
            'expire_date' => 'required'
        ], [
            'amount.numeric' => 'This field must be a number.',
            'product_id.numeric' => 'This field must be a number.'
        ]);
        $date = strtotime($request->expire_date);
        $disc = Discount::all();
        foreach ($disc as $d)
        {
            if (strcmp($d->title, $request->title) === 0)
            {
                $validator = Validator::make([], []); // Empty data and rules fields
                $validator->errors()->add('same_name', 'Error: A discount with a same name already exists!');
                throw new ValidationException($validator);
            }
        }

        foreach ($disc as $d)
        {
            if ($d->product_id == $request->product_id)
            {
                $validator = Validator::make([], []); // Empty data and rules fields
                $validator->errors()->add('same_id', 'Error: A discount for this product already exists!');
                throw new ValidationException($validator);
            }
        }

        $foundProduct = Sales::find($request->product_id);
        if ($request->amount > $foundProduct->price)
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('same_id', 'Error: Invalid discount amount assigned for this product!');
            throw new ValidationException($validator);
        }

        $inject = new Discount;
        $inject->title = $request->title;
        $inject->amount = $request->amount;
        $inject->product_id = $request->product_id;
        $inject->expire_date = date("Y-m-d H:i:s",$date);
        $inject->save();
        return redirect(route('discount.index'))->with('inssuccess', 'success');

    }

    function checkIsAValidDate($myDateString){
        return (bool)strtotime($myDateString);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Discount  $discountController
     * @return \Illuminate\Http\Response
     */
    public function show(ManageDiscount $discountController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Discount  $discountController
     * @return \Illuminate\Http\Response
     */
    public function edit(ManageDiscount $discountController, $id)
    {
        $dat = Discount::find($id);
        $data = Sales::where("available", ">", 0)->get();
        return view('discount.edit')->with(compact('dat', 'data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount  $discountController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title'       => 'required',
            'amount'      => 'required|numeric',
            'product_id'  => 'required|numeric',
            'expire_date' => 'required'
        ], [
            'expire_date.required' => 'This field is required.',
            'amount.numeric' => 'This field must be a number.',
            'product_id.required' => 'This field is required.',
            'product_id.numeric' => 'Invalid submission process. Please refresh the page and re-submit.'
        ]);
        $date = strtotime($request->expire_date);
        $disc = Discount::all();
        $foundProductID = Discount::where("product_id", "=" , (string)$request->product_id)->get();

        if (count($foundProductID) == 0)
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('product_id_changed', 'Invalid submission process. Please refresh the page and re-submit.');
            throw new ValidationException($validator);
        }

        $foundProduct = Sales::find($request->product_id);
        if ($request->amount > $foundProduct->price)
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('same_id', 'Error: Invalid discount amount assigned for this product.');
            throw new ValidationException($validator);
        }

        if ($request->expire_date > Carbon::now())
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('invaliddate', 'Error: Invalid expire date.');
            throw new ValidationException($validator);
        }

        $inject = Discount::find($id);
        $inject->title = $request->title;
        $inject->amount = $request->amount;
        $inject->expire_date = date("Y-m-d H:i:s",$date);
        $inject->save();
        return redirect(route('discount.index'))->with('edt', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discountController
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Discount::find($id)->delete();
        return redirect(route('discount.index'))->with('dltsuccess', 'success');
    }
}
