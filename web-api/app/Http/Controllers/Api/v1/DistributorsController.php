<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Distributors;
use App\Http\Resources\Distributors as DistributorsResource;
use App\DistributorAccountTopups;
use App\Http\Resource\DistributorAccountTopups as TopupsResource;
use App\DistributorFloatTransfers;
use App\Http\Resource\DistributorFloatTransfers as TransferResource;
use App\DistributorFloatSales;
use App\Http\Resource\DistributorFloatSales as FloatSalesResource;

class DistributorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dists = Distributors::with(['creator'])->get();

        return new DistributorsResource($dists);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'prefix'=> 'required',
            'business_name'=> 'required|string',
            'type'=> 'required',
            'vending_account_number'=> 'required|string',
            'vending_account_balance'=> 'required',
            'country'=> 'required|string',
            'region'=> 'required|string',
            'office_gps_location'=> 'required|string',
            'office_phone'=> 'required|integer',
            'email'=> 'required|string',
            'topup_discount'=> 'required',
            'creator_id'=> 'required',            
        ]);

        $dist = $request->isisMethod('put') ?
            Distributors::findOrFail($request->input('id')) : new Distributors;

        $dist->id = $request->input('id');
        $dist->prefix = $request->input('prefix');
        $dist->business_name = $request->input('business_name');
        $dist->type = $request->input('type');
        $dist->parent_id = $request->input('parent_id');
        $dist->vending_account_number = $request->input('vending_account_number');
        $dist->vending_account_balance = $request->input('vending_account_balance');
        $dist->country = $request->input('country');
        $dist->region = $request->input('region');
        $dist->office_gps_location = $request->input('office_gps_location');
        $dist->office_phone = $request->input('office_phone');
        $dist->email = $request->input('email');
        $dist->topup_discount = $request->input('topup_discount');
        $dist->is_active = $request->input('is_active');
        $dist->creator_id = $request->user();
        $dist->approver_id = $request->input('approver_id');

        if ($dist->save()) {
            return DistributorsResource::collection($dist);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dist = Distributors::onlyTrashed()->find($id);

        if ($dist->forceDelete()) {
            return new DistributorsResource($dist);
        }
    }

    public function search($keyword)
    {
        $result = Distributors::where('office_phone', $keyword)->get();

        return new DistributorsResource($result);
    }

    public function get_account_topups()
    {
        $res = DistributorAccountTopups::with(['creator', 'user'])->get();
        return TopupsResource::collection($res);
    }

    public function topup_vending_account(Request $request)
    {
        $request->validate([
            'transaction_reference'=> 'required|string',
            'total_amount'=> 'required',
            'balance_before'=> 'required',
            'balance_after'=> 'required',
            'transaction_amount'=> 'required',
            'transaction_date'=> 'required|date',
            'transaction_status'=> 'required',
            'distributor_id'=> 'required',
            'user_id'=> 'required'
        ]);

        $topup = new DistributorAccountTopups;

        $topup->id = $request->input('id');
        $topup->transaction_reference = $request->input('transaction_reference');
        $topup->total_amount = $request->input('total_amount');
        $topup->balance_before = $request->input('balance_before');
        $topup->balance_after = $request->input('balance_after');
        $topup->transaction_amount = $request->input('transaction_amount');
        $topup->transaction_date = $request->input('transaction_date');
        $topup->transaction_status = $request->input('transaction_status');
        $topup->distributor_id = $request->input('distributor_id');

        if ($topup->save()) {
            return new TopupsResource($topup);
        }
    }

    public function get_float_transfers()
    {
        $res = DistributorFloatTransfer::with(['sender', 'receiver', 'creator', 'approver'])->get();
        return TransferResource::collection($res);
    }

    public function transfer_float(Request $request)
    {
        $request->validate([
            'transaction_reference'=> 'required|string',
            'sender_balance_before'=> 'required',
            'sender_balance_after'=> 'required',
            'receiver_balance_before'=> 'required',
            'receiver_balance_after'=> 'required',
            'transaction_amount'=> 'required',
            'transaction_date'=> 'required|date',
            'transaction_status'=> 'required',
            'sender_id'=> 'required',
            'receiver_id'=> 'required'
        ]);

        $trans = new DistributorFloatTransfer;

        $trans->id = $request->input('id');
        $trans->transaction_reference = $request->input('transaction_reference');
        $trans->sender_balance_before = $request->input('sender_balance_before');
        $trans->sender_balance_after = $request->input('sender_balance_after');
        $trans->receiver_balance_before = $request->input('receiver_balance_before');
        $trans->receiver_balance_after = $request->input('receiver_balance_after');
        $trans->transaction_amount = $request->input('transaction_amount');
        $trans->transaction_date = $request->input('transaction_date');
        $trans->transaction_status = $request->input('transaction_status');
        $trans->sender_id = $request->input('sender_id');
        $trans->receiver_id = $request->input('receiver_id');

        if ($trans->save()) {
            return new TransferResource($trans);
        }
    }

    public function get_float_sales()
    {
        $res = DistributorFloatSales::with(['creator', 'user'])->get();
        return FloatSalesResource::collection($res);
    }

    public function sell_float(Request $request)
    {
        $request->validate([
            'transaction_reference'=> 'required|string',
            'balance_before'=> 'required',
            'balance_after'=> 'required',
            'transaction_amount'=> 'required',
            'transaction_date'=> 'required|date',
            'transaction_status'=> 'required|string',
            'distributor_id'=> 'required',
            'field_teller_id'=> 'required',
        ]);

        $sale = new DistributorFloatSales;

        $sale->id = $request->input('id');
        $sale->transaction_reference = $request->input('transaction_reference');
        $sale->balance_before = $request->input('balance_before');
        $sale->balance_after = $request->input('balance_after');
        $sale->transaction_amount = $request->input('transaction_amount');
        $sale->transaction_date = $request->input('transaction_date');
        $sale->transaction_status = $request->input('transaction_status');
        $sale->distributor_id = $request->input('distributor_id');
        $sale->field_teller_id = $request->input('field_teller_id');

        if ($sale->save()) {
            return new FloatSaleResource($sale);
        }
    }

    public function reports(Request $request)
    {
        $from = $request->input('start_date');
        $to = $request->input('end_date');
        $dist_id = $request->input('distributor_id');

        $dist = Distributors::findOrFail($dist_id);

        $float_transfers = DistributorFloatTransfers::where('created_at', '>=', $from)
        ->where('created_at', '<=', $to)
        ->where('distributor_id', $dist_id)->get();

        $float_sales = DistributorFloatSales::where('created_at', '>=', $from)
        ->where('created_at', '<=', $to)
        ->where('distributor_id', $dist_id)->get();

        for ($i=0; $i<$float_transfers->length; $i++) {
            $float_transfers[$i]->transaction_type = "Float Transfer";
        }

        for ($i=0; $i<$float_sales->length; $i++) {
            $float_sales[$i]->transaction_type = "Float Sales To Field Teller";
        }

        $res = [];
        $res->user = $dist;
        $res->float_transfers = $float_transfers;
        $res->float_sales = $float_sales;

        return $res;       

    }
}
