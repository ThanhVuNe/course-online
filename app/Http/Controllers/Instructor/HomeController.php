<?php

namespace App\Http\Controllers\Instructor;

use App\Http\Controllers\Controller;
use App\Http\Requests\RevenueReportRequest;
use App\Http\Requests\StatisticsStudentRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @var CourseService;
     */
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    public function getStatisticsStudentData($start, $end, $type)
    {
        $statistStudentData = [
            'start_date' => $start,
            'end_date' => $end,
            'type' => $type
        ];

        $request = new StatisticsStudentRequest($statistStudentData);
        $result = $this->courseService->totalStudentsByTime($request);

        return $result;
    }

    public function getRevenueStatistics($start, $end, $type)
    {
        $revenueReportData = [
            'start_date' => $start,
            'end_date' => $end,
            'statisBy' => $type
        ];

        $request = new RevenueReportRequest($revenueReportData);
        $result = $this->courseService->getCourseRevenueStatistics($request);
        return $result;
    }

    public function salePercent($saleToday, $saleSubDay)
    {
        // dd($saleToday, $saleSubDay);
        try {
            return round(
                (($saleToday - $saleSubDay) / $saleSubDay) * 100,
                2
            );
        } catch (\Throwable $th) {
            return 100;
        }
    }

    public function home(Request $request): View
    {
        $type = $request->type ?? 'today';

        $today = now()->toDateString();
        $addDay = now()->addDay()->toDateString();
        $subDay = now()->subDay()->toDateString();
        $twoDayAgo = now()->subDay()->subDay()->toDateString();

        $statisticsStudentToday = $this->getStatisticsStudentData($subDay, $addDay, 'day')->first();
        // dd($statisticsStudentToday);
        $statisticsStudentSubDay = $this->getStatisticsStudentData($twoDayAgo, $subDay, 'day')->first();
        $totalStudentToday = $statisticsStudentToday ? $statisticsStudentToday->getAttribute('total_student') : 0;
        $totalStudentSubDay = $statisticsStudentSubDay ? $statisticsStudentSubDay->getAttribute('total_student') : 0;

        $studentPercentToday = $this->salePercent($totalStudentToday, $totalStudentSubDay);

        $statisticsRevenueToday = $this->getRevenueStatistics($subDay, $addDay, 'day')->first();
        $statisticsRevenueSubDay = $this->getRevenueStatistics($twoDayAgo, $subDay, 'day')->first();
        $totalRevenueToday = $statisticsRevenueToday ? $statisticsRevenueToday->getAttribute('total_price') : 0;
        $totalRevenueSubDay = $statisticsRevenueSubDay ? $statisticsRevenueSubDay->getAttribute('total_price') : 0;

        $revenuePercentToday = $this->salePercent($totalRevenueToday, $totalRevenueSubDay);

        if ($type == 'year') {
            $studentReportData = $this->getStatisticsStudentData(now()->subYear()->toDateString(), $today, 'year');
            $revenueReportData = $this->getRevenueStatistics(now()->subYear()->toDateString(), $today, 'year');
        } elseif ($type == 'month') {
            $studentReportData = $this->getStatisticsStudentData(now()->subMonth()->toDateString(), $today, 'month');
            $revenueReportData = $this->getRevenueStatistics(now()->subMonth()->toDateString(), $today, 'month');
        } else {
            $studentReportData = $this->getStatisticsStudentData($subDay, $today, 'day');
            $revenueReportData = $this->getRevenueStatistics($subDay, $today, 'day');
        }
        
        $enrollmentRecent = $this->courseService->getInstructorCoursesRecent(auth()->id());


        $topSells = Course::select('courses.*', 
        DB::raw('SUM(courses.price) as totalRevenue'), 
        DB::raw('COUNT(DISTINCT enrollments.user_id) as totalUsers'))
        ->join('enrollments', 'courses.id', '=', 'enrollments.course_id')
        ->where('courses.instructor_id', auth()->id())
        ->groupBy('courses.id')
        ->orderByRaw('COUNT(enrollments.id) DESC')
        ->limit(10)
        ->get();

        // dd($topSells);
        return view('instructor.home', [
            'enrollmentRecent' => $enrollmentRecent,
            'studentToday' => $totalStudentToday,
            'studentPercentToday' => $studentPercentToday,
            'revenueToday' => $totalRevenueToday,
            'revenuePercentToday' => $revenuePercentToday,
            'studentReportData' => $studentReportData->pluck('total_student'),
            'studentReportLabel' => $studentReportData->pluck('enrollment_date'),
            'revenueReportData' => $revenueReportData->pluck('total_price'),
            'revenueReportLabel' => $studentReportData->pluck('date_order'),
            'type' => $type,
            'topSells' => $topSells
        ]);
    }
}
