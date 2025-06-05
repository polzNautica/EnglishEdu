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
        'q': 'Choose the correct past tense form of the verb in the following sentence: "Yesterday, I _______ (go) to the park."',  
        'options': [
          'go',
          'gone',
          'went',
          // 'Answer 4'
        ],
        'correctIndex': 2,
        'correctResponse': 'Good! "Went" is the past tense of "go." The action happened in the past, specifically yesterday, so we use "went."',
        'incorrectResponse': 'Oh no. "Went" is the past tense of "go." The action happened in the past, specifically yesterday, so we use "went."'
      },
      {
        'q': 'Fill in the blank with the correct past tense verb: "We _______ (eat) dinner at a restaurant last night."',
        'options': [
          'eat',
          'eaten',
          'ate'
        ],
        'correctIndex': 2,
        'correctResponse': 'Good! "Ate" is the past tense of "eat." Since the action happened last night, we use "ate" for the past tense.',
        'incorrectResponse': 'Oh no. "Ate" is the past tense of "eat." Since the action happened last night, we use "ate" for the past tense.'
      },
      {
        'q': 'Which sentence is in the past tense?',
        'options': [
          'She plays the piano every day.',
          'She will play the piano tomorrow.',
          'She played the piano yesterday.',
        ],
        'correctIndex': 2,
        'correctResponse': 'Good! "Played" is the past tense of "play." The action happened in the past (yesterday), so this is the correct choice.',
        'incorrectResponse': 'Oh no. "Played" is the past tense of "play." The action happened in the past (yesterday), so this is the correct choice.'
      },
      {
        'q': 'Choose the correct past tense form: "He _______ (watch) a movie last weekend."',
        'options': [
          'watches',
          'watching',
          'watched',
        ],
        'correctIndex': 2,
        'correctResponse': 'Good! "Watched" is the correct past tense of "watch." The sentence refers to an action in the past, so we use "watched."',
        'incorrectResponse': 'Oh no. "Watched" is the correct past tense of "watch." The sentence refers to an action in the past, so we use "watched."'
      },
      {
        'q': 'Which of the following is the correct past tense of "run"?',
        'options': [
          'ran',
          'run',
          'runned',
        ],
        'correctIndex': 0,
        'correctResponse': 'Good! "Ran" is the correct past tense form of "run." "Runned" is incorrect, and "run" is the base form of the verb.',
        'incorrectResponse': 'Oh no. "Ran" is the correct past tense form of "run." "Runned" is incorrect, and "run" is the base form of the verb.'
      },
      {
        'q': 'Complete the sentence with the past tense form of the verb in brackets: "They _______ (not like) the weather last week."',
        'options': [
          'did not like',
          'not liked',
          'do not like',
        ],
        'correctIndex': 0,
        'correctResponse': 'Good! To make a negative sentence in the past tense, we use "did not" (didn\'t) followed by the base form of the verb, "like."',
        'incorrectResponse': 'Oh no. To make a negative sentence in the past tense, we use "did not" (didn\'t) followed by the base form of the verb, "like."'
      },
      {
        'q': 'Fill in the blank with the correct past tense verb: "Last month, my family _______ (travel) to Johor."',
        'options': [
          'traveled',
          'travels',
          'travelling',
        ],
        'correctIndex': 0,
        'correctResponse': 'Good! "Traveled" is the correct past tense form of the verb "travel." The action happened in the past (last month), so "traveled" is the appropriate choice.',
        'incorrectResponse': 'Oh no. "Traveled" is the correct past tense form of the verb "travel." The action happened in the past (last month), so "traveled" is the appropriate choice.'
      },
      {
        'q': 'Choose the correct past tense form: "We _______ (finish) our homework before the teacher arrived."',
        'options': [
          'finishes',
          'finished',
          'finishing',
        ],
        'correctIndex': 1,
        'correctResponse': 'Good! "Finished" is the correct past tense form of "finish." The action (finishing homework) happened in the past, before the teacher arrived.',
        'incorrectResponse': 'Oh no. "Finished" is the correct past tense form of "finish." The action (finishing homework) happened in the past, before the teacher arrived.'
      },
      {
        'q': 'What is the past tense of the verb "eat"?',
        'options': [
          'eats',
          'ate',
          'eaten',
        ],
        'correctIndex': 1,
        'correctResponse': 'Good! "Ate" is the past tense of "eat." "Eats" is the present tense, and "eaten" is the past participle form, which is used with auxiliary verbs.',
        'incorrectResponse': 'Oh no. "Ate" is the past tense of "eat." "Eats" is the present tense, and "eaten" is the past participle form, which is used with auxiliary verbs.'
      },
      {
        'q': 'Complete the sentence with the correct past tense verb: "She _______ (study) for the test last night."',
        'options': [
          'studies',
          'studying',
          'studied',
        ],
        'correctIndex': 2,
        'correctResponse': 'Good! "Studied" is the past tense of "study." The action happened in the past (last night), so we use the past tense form "studied."',
        'incorrectResponse': 'Oh no. "Studied" is the past tense of "study." The action happened in the past (last night), so we use the past tense form "studied."'
      }
    ]
  });

</script>
@endsection

@endsection
