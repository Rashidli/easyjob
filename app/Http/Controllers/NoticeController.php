<?php

namespace App\Http\Controllers;

use App\Models\Notice;
use Illuminate\Http\Request;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(): void {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): void {}

    /**
     * Display the specified resource.
     */
    public function show(Notice $notice): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Notice $notice): void {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Notice $notice): void {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Notice $notice): void {}
}
