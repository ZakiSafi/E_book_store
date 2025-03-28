<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BorrowedBook;
use App\Models\OnlineBook;
use Carbon\Carbon;

class ChartController extends Controller
{
    public function getBooksBorrowedData()
    {
        // Fetch data for books borrowed per month
        $data = BorrowedBook::selectRaw('MONTH(created_at) as month, COUNT(*) as count')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format the data for the chart
        $labels = [];
        $counts = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->format('F');
            $counts[] = $data->where('month', $i)->first()->count ?? 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $counts,
        ]);
    }

    public function getBooksDownloadedData()
    {
        // Fetch data for books downloaded per month
        $data = OnlineBook::selectRaw('MONTH(created_at) as month, SUM(downloads) as total_downloads')
            ->whereYear('created_at', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        // Format the data for the chart
        $labels = [];
        $downloads = [];
        for ($i = 1; $i <= 12; $i++) {
            $labels[] = Carbon::create()->month($i)->format('F');
            $downloads[] = $data->where('month', $i)->first()->total_downloads ?? 0;
        }

        return response()->json([
            'labels' => $labels,
            'data' => $downloads,
        ]);
    }
}
