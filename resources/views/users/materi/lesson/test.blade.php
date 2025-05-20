@extends('layouts.main.index')

@section('css')
  <link rel="stylesheet" href="{{ asset('assets/css/jquery.quiz.css') }}">
@endsection
 
@section('container')
<div class="container">
    {{-- Back Button --}}
  <div class="mb-3">
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
    ← Back
    </a>
  </div>
  <div id="quiz">
  <div class="quiz-header">
    <h1>Basic Quiz Demo</h1>
    <p><a class="quiz-home-btn">← Return to Home</a></p>
  </div>
  <div class="quiz-start-screen">
    <p>Test your knowledge with this interactive quiz!</p>
    <p><a href="#" class="quiz-start-btn quiz-button">Start Quiz</a></p>
  </div>
</div>

</div>

@section('script')
<script src="https://code.jquery.com/jquery-1.12.4.min.js" 
    integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" 
    crossorigin="anonymous">
</script>
<script src="{{ asset('assets/js/materi/jquery.quiz-min.js') }}"></script>
<script>
      $('#quiz').quiz({
    counterFormat: 'Question %current of %total',
    questions: [
      {
        'q': 'A sample question?',
        'options': [
          'Answer 1',
          'Answer 2',
          'Answer 3',
          'Answer 4'
        ],
        'correctIndex': 1,
        'correctResponse': 'Custom correct response.',
        'incorrectResponse': 'Custom incorrect response.'
      },
      {
        'q': 'A sample question?',
        'options': [
          'Answer 1',
          'Answer 2'
        ],
        'correctIndex': 1,
        'correctResponse': 'Custom correct response.',
        'incorrectResponse': 'Custom incorrect response.'
      },
      {
        'q': 'A sample question?',
        'options': [
          'Answer 1',
          'Answer 2',
          'Answer 3',
          'Answer 4'
        ],
        'correctIndex': 3,
        'correctResponse': 'Custom correct response.',
        'incorrectResponse': 'Custom incorrect response.'
      }
    ]
  });

</script>
@endsection

@endsection
