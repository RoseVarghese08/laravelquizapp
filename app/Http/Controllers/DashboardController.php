<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index()
    {
      
        $response = Http::get('https://the-trivia-api.com/api/questions?categories={$category}&limit=15');
        $categories = $response->json()['trivia_categories'];

        return view('dashboard', ['categories' => $categories]);
    }
}
