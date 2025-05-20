@extends('layouts.main.index')

@section('container')
<div class="container">

  {{-- Back Button --}}
  <div class="mb-3">
    <a href="{{ url()->previous() }}" class="btn btn-outline-primary">
    ← Back
    </a>
  </div>

  <div class="card shadow-sm">
    <img src="@if($lesson->image === 'logo-aplikasi/logo.png') 
                {{ asset('assets/img/logo-aplikasi/logo.png') }}
              @elseif(Storage::disk('public')->exists($lesson->image)) 
                {{ asset('storage/' . $lesson->image) }} 
              @else 
                {{ asset('assets/img/' . $lesson->image) }} 
              @endif"
         class="card-img-top" style="width: fit-content; height: 100px; margin-left: 5vw;" alt="{{ $lesson->title }}">

    <div class="card-body">
      <h3 class="card-title">{{ $lesson->title }}</h3>
      <div class="card-text" style="white-space: normal;">

      
      @if ($lesson->audio)
        <audio controls class="mt-3 w-100">
          <source src="{{ asset('storage/' . $lesson->audio) }}" type="audio/mpeg">
          Your browser does not support the audio element.
        </audio>
      @endif    
<!--         
      @if($lesson->audio)
        <audio id="lesson-audio" controls class="w-100 mt-3">
          <source src="@if(Storage::disk('public')->exists($lesson->audio)) 
                          {{ asset('storage/' . $lesson->audio) }} 
                      @else 
                          {{ asset('assets/' . $lesson->audio) }} 
                      @endif" 
                  type="audio/mpeg">
          Your browser does not support the audio element.
        </audio>
      @else
        <div class="text-muted mt-3">No audio available for this lesson.</div>
      @endif -->

      <div class="card-text" style="white-space: normal; overflow-x: hidden; word-wrap: break-word; word-break: break-word;">
        {!! $lesson->text !!}
      </div>
      </div>

      @if ($lesson->video)
        <div class="mt-3">
          <video controls class="w-100" style="max-height: 400px;">
            <source src="{{ asset('storage/' . $lesson->video) }}" type="video/mp4">
            Your browser does not support the video tag.
          </video>
        </div>
      @endif
    </div>
  </div>
</div>
@endsection
