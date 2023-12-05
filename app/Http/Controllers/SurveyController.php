<?php

namespace App\Http\Controllers;

use App\Services\CategoryService;
use App\Services\SurveyService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SurveyController extends Controller
{
    /**
     * @var SurveyService
     */
    private $surveyService;


    /**
     * @var CategoryService
     */
    private $categoryService;

    public function __construct(SurveyService $surveyService, CategoryService $categoryService)
    {
        $this->surveyService = $surveyService;
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     * @return View
     */
    public function index(): View
    {
        $categories = $this->categoryService->getAll();

        return view('common.survey', compact('categories'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->surveyService->addSurvey($request);

        return redirect()->route('home');
    }
}
