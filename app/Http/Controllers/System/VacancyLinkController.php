<?php

namespace App\Http\Controllers\System;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\VacancyLink;
use Illuminate\Http\Request;

class VacancyLinkController extends Controller
{
    private $vacancyLink;

    public function __construct(VacancyLink $vacancyLink)
    {
        $this->vacancyLink = $vacancyLink;
    }

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
     * @param  \App\Models\VacancyLink  $vacancyLink
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\VacancyLink  $vacancyLink
     * @return \Illuminate\Http\Response
     */
    public function edit(VacancyLink $vacancyLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\VacancyLink  $vacancyLink
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VacancyLink $vacancyLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\VacancyLink  $vacancyLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(VacancyLink $vacancyLink)
    {
        //
    }
}
