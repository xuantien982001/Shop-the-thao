<?php

namespace App\Http\Controllers;

use App\Models\ChiTietNhapKho;
use Illuminate\Http\Request;

class ChiTietNhapKhoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Admin.Pages.NhapKho.index');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Admin.Pages.NhapKho.index');


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
     * @param  \App\Models\ChiTietNhapKho  $chiTietNhapKho
     * @return \Illuminate\Http\Response
     */
    public function show(ChiTietNhapKho $chiTietNhapKho)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ChiTietNhapKho  $chiTietNhapKho
     * @return \Illuminate\Http\Response
     */
    public function edit(ChiTietNhapKho $chiTietNhapKho)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ChiTietNhapKho  $chiTietNhapKho
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ChiTietNhapKho $chiTietNhapKho)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ChiTietNhapKho  $chiTietNhapKho
     * @return \Illuminate\Http\Response
     */
    public function destroy(ChiTietNhapKho $chiTietNhapKho)
    {
        //
    }
}
