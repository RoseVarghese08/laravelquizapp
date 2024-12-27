<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gradient-to-r from-blue-500 to-purple-600">
    <div class="container mx-auto p-8">
        <div class="bg-white p-6 rounded shadow">
            <h1 class="text-xl font-bold mb-4">{{ $question['question'] }}</h1>
            <form action="{{ route('quiz.answer') }}" method="POST">
                @csrf
                <div class="grid grid-cols-2 gap-4">
                    @foreach($question['incorrect_answers'] as $option)
                        <button class="bg-gray-200 p-4 rounded shadow hover:bg-gray-300" type="submit" name="answer" value="{{ $option }}">
                            {{ $option }}
                        </button>
                    @endforeach
                    <button class="bg-gray-200 p-4 rounded shadow hover:bg-gray-300" type="submit" name="answer" value="{{ $question['correct_answer'] }}">
                        {{ $question['correct_answer'] }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
