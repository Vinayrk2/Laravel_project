<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\News; // Import the News model

class NewsController extends Controller
{
    public function viewNews(Request $request)
    {
        // Fetch the latest 10 news items
        $notifications = News::orderBy('created_at', 'desc')->take(10)->get();

        // Paginate the results (12 items per page)
        $paginatedNotifications = News::orderBy('created_at', 'desc')->paginate(12);

        // Get the current page number from the request
        $pageNumber = $request->query('page', 1);

        // Get the paginated results for the current page
        $pageObj = $paginatedNotifications->appends($request->query());

        // Count the total number of notifications
        $count = [
            'notifications' => $notifications->count(),
        ];

        // Pass data to the view
        return view('news.index', [
            'notifications' => $pageObj,
            'count' => $count,
        ]);
    }
}