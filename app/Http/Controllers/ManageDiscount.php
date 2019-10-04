<?php

namespace App\Http\Controllers;

use App\Discount;
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
        return view('discount.show');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = Sales::all();
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
            'product_id'  => 'required',
            'expire_date' => 'required'
        ], [
            'amount.numeric' => 'This field must be a number.'
        ]);
        $date = stripcslashes($request->expire_date);
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
        if (!$this->checkIsAValidDate($date))
        {
            $validator = Validator::make([], []); // Empty data and rules fields
            $validator->errors()->add('invalid_date', 'Error: The date format is invalid!');
            throw new ValidationException($validator);
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
    public function edit(ManageDiscount $discountController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Discount  $discountController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ManageDiscount $discountController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Discount  $discountController
     * @return \Illuminate\Http\Response
     */
    public function destroy(ManageDiscount $discountController)
    {
        //
    }
}
