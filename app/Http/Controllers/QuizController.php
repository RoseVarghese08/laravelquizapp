<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class QuizController extends Controller
{
    public function dashboard(Request $request) 
    {
      
        $response = Http::get('https://the-trivia-api.com/api/categories');
        
        Log::info('Trivia API Response:', ['response' => $response->json()]);

        if ($response->successful()) {
            $categories = $response->json();
        } else {
            $categories = [];
        }

        $categoriesPerPage = 6;
        $currentPage = $request->get('page', 1); 

        $categoriesForCurrentPage = array_slice($categories, ($currentPage - 1) * $categoriesPerPage, $categoriesPerPage);

        $totalPages = ceil(count($categories) / $categoriesPerPage);

        return view('dashboard', [
            'categories' => $categoriesForCurrentPage,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }
    public function start(Request $request, $category)
    {

        $apiUrl = "https://the-trivia-api.com/api/questions?categories={$category}&limit=15";
        $response = file_get_contents($apiUrl);
        $questions = json_decode($response, true);
    
        if (!isset($questions) || empty($questions)) {
            return redirect()->route('dashboard')->with('error', 'Unable to fetch questions. Please try again.');
        }
    
        session(['questions' => $questions]);
    
       
        session(['answers' => []]);
    
        $currentPage = $request->get('page', 1);
    
        return view('quiz.start', [
            'questions' => $questions,
            'category' => $category,
            'currentPage' => $currentPage,
        ]);
    }
    
    public function nextQuestion(Request $request, $category)
    {
        $currentPage = $request->input('current_page', 1);
        $nextPage = $currentPage + 1;

        if ($nextPage > 15) {
            return redirect()->route('quiz.results');
        }

        return redirect()->route('quiz.start', [
            'category' => $category,
            'page' => $nextPage,
        ]);
    }

    public function results(Request $request, $category)
    {
        $questions = session('questions');
        $answers = session('answers'); 
    
        if (!is_array($questions) || !is_array($answers)) {
            return redirect()->route('quiz.start', ['category' => $category])->with('error', 'No quiz data found.');
        }

        $perPage = 4;
        $currentPage = $request->get('page', 1);
        $totalPages = ceil(count($questions) / $perPage);
        
     
        $questionsForCurrentPage = array_slice($questions, ($currentPage - 1) * $perPage, $perPage);
    
        return view('quiz.results', [
            'questions' => $questionsForCurrentPage,
            'answers' => $answers,
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
            'category' => $category,
        ]);
    }
    

    public function submit(Request $request)
    {
        $answers = $request->input('answers');
        $score = 0;

        foreach ($answers as $questionIndex => $answer) {
            if (session('questions')[$questionIndex]['correctAnswer'] === $answer) {
                $score++;
            }
        }

        session()->forget('questions');

        return redirect()->route('dashboard')->with('success', "You scored {$score} out of " . count($answers));
    }
    
}
