<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Merchants;
use App\Http\Resources\Merchants as MerchantsResource;
use App\MerchantPickupRequests;
use App\Http\Resources\MerchantPickupRequests as PickupRequestResource;
use App\MerchantPickupSchedules;
use App\Http\Resources\MerchantPickupSchedules as PickupScheduleResource;
use App\MerchantSettlements;
use App\Http\Resources\MerchantSettlements as SettlementResource;

class MerchantsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $merchs = Merchants::with(['creator'])->get();

        return new MerchantsResource($merchs);
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
            'collection_account_number'=> 'required|string',
            'collection_account_balance'=> 'required',
            'country'=> 'required|string',
            'region'=> 'required|string',
            'office_gps_location'=> 'required|string',
            'office_phone'=> 'required|integer',
            'email'=> 'required|string',
            'pickup_charge'=> 'required',
            'field_teller_commission'=> 'required',
            'firm_commission'=> 'required',
            'settlement_account'=> 'required',
            'settlement_account_network'=> 'required',
            'settlement_account_number'=> 'required',
        ]);

        $merch = $request->isisMethod('put') ?
            Merchants::findOrFail($request->input('id')) : new Merchants;

        $merch->id = $request->input('id');
        $merch->prefix = $request->input('prefix');
        $merch->business_name = $request->input('business_name');
        $merch->type = $request->input('type');
        $merch->parent_id = $request->input('parent_id');
        $merch->vending_account_number = $request->input('collection_account_number');
        $merch->vending_account_balance = $request->input('collection_account_balance');
        $merch->country = $request->input('country');
        $merch->region = $request->input('region');
        $merch->office_gps_location = $request->input('office_gps_location');
        $merch->office_phone = $request->input('office_phone');
        $merch->email = $request->input('email');
        $merch->pickup_charge = $request->input('pickup_charge');
        $merch->pickup_charge = $request->input('pickup_charge');
        $merch->is_active = $request->input('is_active');
        $merch->approval_status = $request->input('approval_status');
        $merch->decline_reason = $request->input('decline_reason');
        $merch->creator_id = $request->user();
        $merch->approver_id = $request->input('approver_id');

        if ($merch->save()) {
            return new MerchantsResource($merch);
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
        $merchs = Merchants::onlyTrashed()->find($id);

        return new MerchantsResource($merch);
    }

    public function get_pickup_schedules()
    {
        $res = MerchantPickupSchedules::with(['merchant', 'user',])->get();
        return PickupScheduleResource::collection($res);
    }

    public function schedule_cash_pickup(Request $request)
    {
        $request->validate([
            'day'=> 'required|string',
            'time_slot'=> 'required',
            'merchant_id'=> 'required'
        ]);

        $pickup = $request->isMethod('put') ? 
        MerchantPickupSchedules::findOrFail($request->$id) : new MerchantPickupSchedules;

        $pickup->id = $request->input('id');
        $pickup->day = $request->input('day');
        $pickup->time_slot = $request->input('time_slot');
        $pickup->merchant_id = $request->input('merchant_id');

        if ($pickup->save()) {
            return new PickupScheduleResource($pickup);
        }
    }    

    public function get_pickup_requests()
    {
        $res = MerchantPickupRequests::with(['merchant', 'field_teller', 'user'])->get();
        return PickupRequestResource::collection($res);
    }

    public function request_cash_pickup(Request $request)
    {
        $request->validate([
            'transaction_reference'=> 'required|string',
            'balance_before'=> 'required',
            'balance_after'=> 'required',
            'transaction_amount'=> 'required',
            'transaction_date'=> 'required|date',
            'transaction_status'=> 'required|string',
            'merchant_id'=> 'required'
        ]);

        $pickup = $request->isMethod('put') ? 
        MerchantPickupRequests::findOrFail($request->$id) : new MerchantPickupRequests;

        $pickup->id = $request->input('id');
        $pickup->transaction_reference = $request->input('transaction_reference');
        $pickup->balance_before = $request->input('balance_before');
        $pickup->balance_after = $request->input('balance_after');
        $pickup->transaction_amount = $request->input('transaction_amount');
        $pickup->transaction_date = $request->input('transaction_date');
        $pickup->transaction_status = $request->input('transaction_status');
        $pickup->merchant_id = $request->input('merchant_id');

        if ($pickup->save()) {
            return new PickupRequestResource($pickup);
        }
    }

    public function get_commission_settlements()
    {
        $res = MerchantSettlements::with(['merchant', 'user'])->get();
        return SettlementResource::collection($res);
    }

    public function commission_settlement(Request $request)
    {
        $request->validate([
            'transaction_reference'=> 'required|string',
            'balance_before'=> 'required',
            'balance_after'=> 'required',
            'transaction_amount'=> 'required',
            'transaction_date'=> 'required|date',
            'transaction_status'=> 'required|string',
            'merchant_id'=> 'required',
            'user_id'=> 'required'
        ]);

        $set = $request->isMethod('put') ? 
        MerchantSettlements::findOrFail($request->$id) : new MerchantManualSettlements;

        $set->id = $request->input('id');
        $set->transaction_reference = $request->input('transaction_reference');
        $set->balance_before = $request->input('balance_before');
        $set->balance_after = $request->input('balance_after');
        $set->transaction_amount = $request->input('transaction_amount');
        $set->transaction_date = $request->input('transaction_date');
        $set->transaction_status = $request->input('transaction_status');
        $set->merchant_id = $request->input('merchant_id');

        if ($set->save()) {
            return new SettlementResource($set);
        }
    }

    public function reports(Request $request)
    {
        $from = $request->input('start_date');
        $to = $request->input('end_date');
        $merch_id = $request->input('merchant_id');

        $merch = Merchants::findOrFail($ft_id);

        $pickup_requests = MerchantPickupRequests::where('created_at', '>=', $from)
        ->where('created_at', '<=', $to)
        ->where('sender_id', $merch_id)->get();

        $pickup_schedules = MerchantPickupSchedules::where('created_at', '>=', $from)
        ->where('created_at', '<=', $to)
        ->where('sender_id', $merch_id)->get();

        $settlements = MerchantSettlements::where('created_at', '>=', $from)
        ->where('created_at', '<=', $to)
        ->where('sender_id', $merch_id)->get();

        for ($i=0; $i<$pickup_requests->length; $i++) {
            $pickup_requests[$i]->transaction_type = "Pickup Request";
        }

        for ($i=0; $i<$pickup_schedules->length; $i++) {
            $pickup_schedules[$i]->transaction_type = "Pickup Schedule";
        }

        for ($i=0; $i<$settlements->length; $i++) {
            $settlements[$i]->transaction_type = "Manual Settlement";
        }

        $res = [];
        $res->user = $merch;
        $res->requests = $pickup_requests;
        $res->schedules = $pickup_schedules;
        $res->settlements = $settlements;

        return $res;       

    }
}
