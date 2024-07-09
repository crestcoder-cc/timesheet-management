<?php

namespace App\Http\Controllers\Web;


use App\Http\Controllers\Controller;
use App\Http\Requests\Company\AdminLoginRequest;
use App\Models\EmployeeTask;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $currentDate = Carbon::now();
        $currentMonth = $currentDate->format('m'); // Full month name
        $currentYear = $currentDate->year;
        $startDate = Carbon::now()->startOfWeek(Carbon::SUNDAY);
        $endDate = Carbon::now()->endOfWeek(Carbon::SATURDAY);

        $period = CarbonPeriod::create($startDate, $endDate);
        $dateArrays = [];
        foreach ($period as $date) {
            $dayName = $date->format('l');
            $dateArrays[$dayName] = $date->format('Y-m-d');
        }
        $dateArrays = array_reverse($dateArrays, true);

        // Adjust to start and end of month, ensuring Sunday to Saturday weeks
        $startOfMonth = Carbon::now()->startOfMonth()->startOfWeek(Carbon::SUNDAY);
        $endOfMonth = Carbon::now()->endOfMonth()->endOfWeek(Carbon::SATURDAY);
        $ranges = [];
        $current = $startOfMonth->copy();
        $currentWeekRange = null;

        while ($current->lte($endOfMonth)) {
            $start = $current->copy();
            $end = $current->copy()->endOfWeek(Carbon::SATURDAY);

            if ($end->gt($endOfMonth)) {
                $end = $endOfMonth;
            }

            $range = $start->format('M d') . ' - ' . $end->format('M d');
            $ranges[] = [
                'range' => $range,
                'start' => $start->format('Y-m-d'),
                'end' => $end->format('Y-m-d'),
            ];

            // Check if current date is within this range
            if ($startDate->between($start, $end)) {
                $currentWeekRange = $range;
            }

            $current->addWeek();
        }

        return view('web.home.index', [
            'ranges' => $ranges,
            'dateArrays' => $dateArrays,
            'currentWeekRange' => $currentWeekRange,
            'currentMonth' => $currentMonth,
            'currentYear' => $currentYear,
        ]);
    }
    public function MonthYearFilter(Request $request)
    {
        try {
            // Ensure the month and year are passed and properly formatted
            $currentMonth = str_pad($request->input('month_wise_filter'), 2, '0', STR_PAD_LEFT);
            $currentYear = $request->input('year_wise_filter');

            // Create a Carbon instance for the first day of the given month and year
            $startOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->startOfWeek(Carbon::SUNDAY);
            $endOfMonth = Carbon::createFromDate($currentYear, $currentMonth, 1)->endOfMonth()->endOfWeek(Carbon::SATURDAY);

            // Create date range for the specified month
            $period = CarbonPeriod::create($startOfMonth, $endOfMonth);
            $dateArrays = [];
            foreach ($period as $date) {
                $dayName = $date->format('l');
                $dateArrays[$dayName] = $date->format('Y-m-d');
            }
            $dateArrays = array_reverse($dateArrays, true);

            // Generate weekly ranges for the selected month
            $ranges = [];
            $current = $startOfMonth->copy();
            $currentWeekRange = null;

            while ($current->lte($endOfMonth)) {
                $start = $current->copy();
                $end = $current->copy()->endOfWeek(Carbon::SATURDAY);

                if ($end->gt($endOfMonth)) {
                    $end = $endOfMonth;
                }

                $range = $start->format('M d') . ' - ' . $end->format('M d');
                $ranges[] = [
                    'range' => $range,
                    'start' => $start->format('Y-m-d'),
                    'end' => $end->format('Y-m-d'),
                ];

                // Check if current date is within this range
                if (Carbon::now()->between($start, $end)) {
                    $currentWeekRange = $range;
                }

                $current->addWeek();
            }

            $view = view('web.home.month_year_wise_filter', [
                'ranges' => $ranges,
                'dateArrays' => $dateArrays,
                'currentWeekRange' => $currentWeekRange,
                'currentMonth' => $currentMonth,
                'currentYear' => $currentYear,
            ])->render();

            return response()->json([
                'data' => $view
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to process request: ' . $e->getMessage()
            ], 400);
        }
    }



    public function cardDateFilter(Request $request)
    {

        $period = CarbonPeriod::create($request->start_date, $request->end_date);
        $dateArrays = [];
        foreach ($period as $date) {
            $dayName = $date->format('l');
            $dateArrays[$dayName] = $date->format('Y-m-d');
        }
        $dateArrays = array_reverse($dateArrays, true);
        $view = view('web.home.week_wise_filter', [
            'dateArrays' => $dateArrays
        ])->render();
        return response()->json([
            'data' => $view
        ]);
    }

}
