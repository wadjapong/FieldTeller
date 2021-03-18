<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Distributors;
use App\Http\Resources\Distributors as DistributorsResource;
use App\DistributorAccountTopups;
use App\Http\Resource\DistributorAccountTopups as TopupsResource;

class FirmController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
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
        //
    }

    public function reports(Request $request)
    {
        $from = $request->input('start_date');
        $to = $request->input('end_date');
        $dist_id = $request->input('distributor_id');

        $topups = DistributorAccountTopups::where('created_at', '>=', $from)
        ->where('created_at', '<=', $to)
        ->where('distributor_id', $id)->get();

        $topups->transaction_type = "Distributor Account Topup";

        $res = [];
        $res[0] = $dist;
        

    }
}
