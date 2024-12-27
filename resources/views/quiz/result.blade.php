@extends('layouts.app')

@section('content')
<div class="container text-center" style="background: linear-gradient(to right, rgba(9,121,187,255), rgba(115,86,183,255)); padding: 50px; color: white;">

    <div class="row">
        <div class="col-12">
            <p class="mt-2">Category: {{ $category }}</p>
            <p>Page {{ $currentPage }} of {{ $totalPages }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @foreach ($questions as $question)
                <div class="question-block mb-4">
                    <p>{{ $question['question'] }}</p>
                    <p><strong>Correct Answer:</strong> {{ $question['correctAnswer'] }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            @if ($currentPage < $totalPages)
                <a href="{{ route('quiz.results', ['category' => $category, 'page' => $currentPage + 1]) }}" class="btn btn-primary">Next Page</a>
            @else
                <a href="{{ route('dashboard') }}" class="btn btn-secondary">Finish</a>
            @endif
        </div>
    </div>
</div>
@endsection

