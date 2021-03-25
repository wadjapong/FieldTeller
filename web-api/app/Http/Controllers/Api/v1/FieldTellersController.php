<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\FieldTellers;
use App\Http\Resources\FieldTellers as FieldTellersResource;
use App\ClientPairs;
use App\Http\Resources\ClientPairs as ClientPairResource;
use App\FieldTellerFloatTransfers;
use App\Http\Resources\FieldTellerFloatTransfers as TransferResource;
use App\FieldTellerCommissionSettlements;
use App\Http\Resources\FieldTellerCommissionSettlements as SettlementsResource;

class FieldTellersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $fts = FieldTellers::with(['creator'])->get();

        return new FieldTellersResource($fts);
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
            'first_name'=> 'required|string',
            'last_name'=> 'required|string',
            'type'=> 'required',
            'float_source'=> 'required|string',
            'commission_account_number'=> 'required|string',
            'commission_account_balance'=> 'required',
            'country'=> 'required|string',
            'region'=> 'required|string',
            'gps_location'=> 'required|string',
            'phone'=> 'required|integer',
            'email'=> 'required|string',
            'cash_carrying_limit'=> 'required',
            'topup_discount'=> 'required',
            'is_active'=> 'required|boolean',  
        ]);

        $ft = $request->isisMethod('put') ?
            FieldTellers::findOrFail($request->input('id')) : new FieldTellers;

        $ft->id = $request->input('id');
        $ft->prefix = $request->input('prefix');
        $ft->business_name = $request->input('business_name');
        $ft->type = $request->input('type');
        $ft->parent_id = $request->input('parent_id');
        $ft->vending_account_number = $request->input('vending_account_number');
        $ft->vending_account_balance = $request->input('vending_account_balance');
        $ft->country = $request->input('country');
        $ft->region = $request->input('region');
        $ft->office_gps_location = $request->input('office_gps_location');
        $ft->office_phone = $request->input('office_phone');
        $ft->email = $request->input('email');
        $ft->topup_discount = $request->input('topup_discount');
        $ft->is_active = $request->input('is_active');
        $ft->approval_status = $request->input('approval_status');
        $ft->decline_reason = $request->input('decline_reason');
        $ft->creator_id = $request->user();
        $ft->approver_id = $request->input('approver_id');

        if ($ft->save()) {
            return new FieldTellersResource($ft);
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
        $ft = FieldTellers::onlyTrashed()->find($id);

        if ($ft->delete()) {
            return new FieldTellersResource($ft);
        }
    }

    public function get_merchant_pairs()
    {
        $res = ClientPairs::with(['merchants', 'creator', 'approver'])->get();
        return ClientPairResource::collection($res);
    }

    public function pair_to_merchant(Request $request)
    {
        $request->validate([
            'field_teller_id'=> 'required',
            'merchant_id'=> 'required',
        ]);

        $pair = new ClientPairs;

        $pair->field_teller_id = $request->input('field_teller_id');
        $pair->merchant_id = $request->input('merchant_id');
        $pair->is_active = $request->input('is_active');

        if ($pair->save()) {
            return $pair;
        }
    }

    public function get_float_transfers()
    {
        $res = FieldTellerFloatTransfers::with(['sender', 'receiver', 'creator', 'approver'])->get();
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
            'receiver_id'=> 'required',
            'creator_id'=> 'required'
        ]);

        $trans = new FieldTellerFloatTransfers;

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

    public function get_commission_settlement()
    {
        $res = FieldTellerCommissionSettlements::with(['sender', 'receiver', 'user'])->get();
        return SettlementsResource::collection($res);
    }

    public function commission_settlement(Request $request)
    {
        $request->validate([
            'transaction_reference'=> 'required|string',
            'sender_balance_before'=> 'required',
            'sender_balance_after'=> 'required',
            'receiver_balance_before'=> 'required',
            'receiver_balance_after'=> 'required',
            'commission_amount'=> 'required',
            'transaction_date'=> 'required|date',
            'transaction_status'=> 'required',
            'sender_id'=> 'required',
            'receiver_id'=> 'required',
            'user_id'=> 'required'
        ]);

        $trans = new FieldTellerCommissionSettlements;

        $trans->id = $request->input('id');
        $trans->transaction_reference = $request->input('transaction_reference');
        $trans->sender_balance_before = $request->input('sender_balance_before');
        $trans->sender_balance_after = $request->input('sender_balance_after');
        $trans->receiver_balance_before = $request->input('receiver_balance_before');
        $trans->receiver_balance_after = $request->input('receiver_balance_after');
        $trans->commission_amount = $request->input('commission_amount');
        $trans->transaction_date = $request->input('transaction_date');
        $trans->transaction_status = $request->input('transaction_status');
        $trans->sender_id = $request->input('sender_id');
        $trans->receiver_id = $request->input('receiver_id');

        if ($trans->save()) {
            return new SettlementsResource($trans);
        }
    }

    public function reports(Request $request)
    {
        $from = $request->input('start_date');
        $to = $request->input('end_date');
        $ft_id = $request->input('field_teller_id');

        $ft = FieldTellers::findOrFail($ft_id);

        $float_transfers = FieldTellerFloatTransfers::where('created_at', '>=', $from)
        ->where('created_at', '<=', $to)
        ->where('sender_id', $ft_id)->get();

        $settlements = FieldTellerCommissionSettlements::where('created_at', '>=', $from)
        ->where('created_at', '<=', $to)
        ->where('sender_id', $ft_id)->get();

        for ($i=0; $i<$float_transfers->length; $i++) {
            $float_transfers[$i]->transaction_type = "Float Transfer";
        }

        for ($i=0; $i<$settlements->length; $i++) {
            $settlements[$i]->transaction_type = "Commission Settlement";
        }

        $res = [];
        $res->user = $ft;
        $res->float_transfers = $float_transfers;
        $res->settlements = $settlements;

        return $res;       

    }
}
