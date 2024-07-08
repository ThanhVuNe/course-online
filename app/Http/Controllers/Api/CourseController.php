<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\CourseService;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;
    /**
     * Display a listing of the resource.
     */

    public function __construct(CourseService $courseService) {
        $this->courseService = $courseService;
    }

    public function index()
    {
        return $this->courseService->getAllCourse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
