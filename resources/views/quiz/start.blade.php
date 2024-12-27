@extends('layouts.app')

@section('content')
<div class="container text-center" style="background: linear-gradient(to right, rgba(9,121,187,255), rgba(115,86,183,255)); padding: 50px; color: white;">

    <div class="row">
        <div class="col-12"></div>
    </div>
    <div class="row">
        <div style="position: absolute; top: 20px; left: 20px; font-size: 24px; font-weight: bold; color: white; background-color: orange; width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
            <div style="width: 50px; height: 50px; background-color: orange; border: 2px solid white; color: white; display: flex; align-items: center; justify-content: center; border-radius: 50%;">
                {{ $currentPage }}
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div id="timer" style="position: absolute; top: 20px; right: 20px; font-size: 24px; font-weight: bold; color: black; background-color: white; padding: 10px 20px; border-radius: 5px; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);"></div>
        </div>
    </div>

    <form method="POST" action="{{ route('quiz.next', ['category' => $category]) }}" id="quizForm" data-current-page="{{ $currentPage }}" style="display: flex; flex-direction: column; align-items: center; gap: 20px;">
        @csrf
        <input type="hidden" name="current_page" value="{{ $currentPage }}">

        <div style="background-color: #2b5f8d; color: white; padding: 20px; border-radius: 5px; text-align: center; max-width: 800px; height:150px; width: 100%;">
            <p style="font-size: 24px; margin: 0;">{{ $questions[$currentPage - 1]['question'] }}</p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap:40px; justify-content: center; max-width: 700px; height:200px; width: 100%;">
            @foreach (array_merge($questions[$currentPage - 1]['incorrectAnswers'], [$questions[$currentPage - 1]['correctAnswer']]) as $answer)
                <div class="option-block" style="background-color: #2b5f8d; color: white; text-align: center; padding: 15px; border-radius: 10px; clip-path: polygon(50% 0%, 100% 25%, 100% 75%, 50% 100%, 0% 75%, 0% 25%); cursor: pointer;">
                    <input class="form-check-input" type="radio" name="answer" value="{{ $answer }}" required style="display: none;">
                    <label>{{ $answer }}</label>
                </div>
            @endforeach
        </div>

        <a href="{{ route('dashboard') }}" style="background-color: #2b5f8d; color: white; padding: 10px 40px; text-align: center; text-decoration: none; display: inline-block; border: none; border-radius:5%;">
            Reset
        </a>
    </form>
</div>

<script>
    let timeLeft = 30;
    const timerDisplay = document.getElementById('timer');
    const quizForm = document.getElementById('quizForm');
    const optionBlocks = document.querySelectorAll('.option-block');
    const currentPageInput = quizForm.querySelector('input[name="current_page"]');
    let currentPage = parseInt(quizForm.dataset.currentPage);

    const countdown = setInterval(() => {
        if (timeLeft <= 0) {
            clearInterval(countdown);
         
            currentPage++;
            currentPageInput.value = currentPage;
            quizForm.submit();
        } else {
            timeLeft--;
            const minutes = Math.floor(timeLeft / 60);
            const seconds = timeLeft % 60;
            timerDisplay.textContent = `${minutes}:${seconds.toString().padStart(2, '0')}`;
        }
    }, 1000);

    optionBlocks.forEach(option => {
        option.addEventListener('click', function(event) {
            event.preventDefault();

            optionBlocks.forEach(opt => {
                opt.style.backgroundColor = '#2b5f8d';
                opt.querySelector('input').checked = false;
            });

            this.style.backgroundColor = '#1d4d70';
            this.querySelector('input').checked = true;
            quizForm.submit(); 
        });
    });
</script>
@endsection
