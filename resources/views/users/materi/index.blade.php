@extends('layouts.main.index')
@section('container')
<h1 class="fs-5 mt-4">Past Simple (Regular Verbs)</h1>
<div class="overflow-auto pb-2">
  <div class="d-flex flex-nowrap gap-3" style="scroll-snap-type: x mandatory;">
    @forelse ($materis->where('category', 'past_simple_regular_verbs') as $lesson)
      <div class="card shadow-sm" style="width: 500px; height:500px; flex: 0 0 auto; scroll-snap-align: start;">
        <img src="@if($lesson->image === 'logo-aplikasi/logo.png') 
                  {{ asset('assets/img/logo-aplikasi/logo.png') }}
              @elseif(Storage::disk('public')->exists($lesson->image)) 
                  {{ asset('storage/' . $lesson->image) }} 
              @else 
                  {{ asset('assets/img/' . $lesson->image) }} 
              @endif"
            class="card-img-top" style="height:150px; object-fit: contain;" alt="Lesson image: {{ $lesson->title }}">
        <div class="card-body">
          <h5 class="card-title">{{ $lesson->title }}</h5>
          <div class="card-text" style="max-height: 150px; overflow: auto;">
            {!! Str::limit(strip_tags($lesson->text, '<h1>'), 250, '...') !!}
          </div>
        </div>
        <div class="card-footer text-end bg-transparent border-top-0">
          <a href="{{ route('lesson.show', $lesson->id) }}" class="btn btn-sm btn-outline-primary">See more</a>
        </div>
      </div>
    @empty
      <p class="text-muted">No lessons found.</p>
    @endforelse
    <div class="card shadow-sm" style="width: 500px; height:500px; flex: 0 0 auto; scroll-snap-align: start;">
      <img src='assets/img/logo-aplikasi/logo.png'
        class="card-img-top" 
        style="height:150px; object-fit: contain;" 
        alt="Lesson image">
      <div class="card-body">
        <h5 class="card-title">Title Test Interactive Quiz</h5>
        <div class="card-text" style="max-height: 150px; overflow: auto;">
          <h1>Text Test Interactive Quiz</h1>
          <p>
            This is Text Test Interactive Quiz Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, quos...
          </p>
        </div>
      </div>
      <div class="card-footer text-end bg-transparent border-top-0">
        <a href="{{ route('test.show') }}" class="btn btn-sm btn-outline-primary">See more</a>
      </div>
    </div>
  </div>
</div>

<h1 class="fs-5 mt-4">Past Simple (Irregular Verbs)</h1>
<div class="overflow-auto pb-2">
  <div class="d-flex flex-nowrap gap-3" style="scroll-snap-type: x mandatory;">
    @forelse ($materis->where('category', 'past_simple_irregular_verbs') as $lesson)
      <div class="card shadow-sm" style="width: 500px; height:500px; flex: 0 0 auto; scroll-snap-align: start;">
        <img src="@if($lesson->image === 'logo-aplikasi/logo.png') 
                  {{ asset('assets/img/logo-aplikasi/logo.png') }}
              @elseif(Storage::disk('public')->exists($lesson->image)) 
                  {{ asset('storage/' . $lesson->image) }} 
              @else 
                  {{ asset('assets/img/' . $lesson->image) }} 
              @endif"
            class="card-img-top" style="height:150px; object-fit: contain;" alt="Lesson image: {{ $lesson->title }}">
        <div class="card-body">
          <h5 class="card-title">{{ $lesson->title }}</h5>
          <div class="card-text" style="max-height: 150px; overflow: auto;">
            {!! Str::limit(strip_tags($lesson->text, '<h1>'), 250, '...') !!}
          </div>
        </div>
        <div class="card-footer text-end bg-transparent border-top-0">
          <a href="{{ route('lesson.show', $lesson->id) }}" class="btn btn-sm btn-outline-primary">See more</a>
        </div>
      </div>
    @empty
      <!-- <p class="text-muted">No lessons found.</p> -->
    @endforelse
    <div class="card shadow-sm" style="width: 500px; height:500px; flex: 0 0 auto; scroll-snap-align: start;">
      <img src='assets/img/logo-aplikasi/logo.png'
        class="card-img-top" 
        style="height:150px; object-fit: contain;" 
        alt="Lesson image">
      <div class="card-body">
        <h5 class="card-title">Title Test Interactive Quiz</h5>
        <div class="card-text" style="max-height: 150px; overflow: auto;">
          <h1>Text Test Interactive Quiz</h1>
          <p>
            This is Text Test Interactive Quiz Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, quos...
          </p>
        </div>
      </div>
      <div class="card-footer text-end bg-transparent border-top-0">
        <a href="{{ route('test2.show') }}" class="btn btn-sm btn-outline-primary">See more</a>
      </div>
    </div>
  </div>
</div>

<h1 class="fs-5 mt-4">Past Continous</h1>
<div class="overflow-auto pb-2">
  <div class="d-flex flex-nowrap gap-3" style="scroll-snap-type: x mandatory;">
    @forelse ($materis->where('category', 'past_continuous') as $lesson)
      <div class="card shadow-sm" style="width: 500px; height:500px; flex: 0 0 auto; scroll-snap-align: start;">
        <img src="@if($lesson->image === 'logo-aplikasi/logo.png') 
                  {{ asset('assets/img/logo-aplikasi/logo.png') }}
              @elseif(Storage::disk('public')->exists($lesson->image)) 
                  {{ asset('storage/' . $lesson->image) }} 
              @else 
                  {{ asset('assets/img/' . $lesson->image) }} 
              @endif"
            class="card-img-top" style="height:150px; object-fit: contain;" alt="Lesson image: {{ $lesson->title }}">
        <div class="card-body">
          <h5 class="card-title">{{ $lesson->title }}</h5>
          <div class="card-text" style="max-height: 150px; overflow: auto;">
            {!! Str::limit(strip_tags($lesson->text, '<h1>'), 250, '...') !!}
          </div>
        </div>
        <div class="card-footer text-end bg-transparent border-top-0">
          <a href="{{ route('lesson.show', $lesson->id) }}" class="btn btn-sm btn-outline-primary">See more</a>
        </div>
      </div>
    @empty
      <p class="text-muted">No lessons found.</p>
    @endforelse
  </div>
</div>

<h1 class="fs-5 mt-4">Past Perfect</h1>
<div class="overflow-auto pb-2">
  <div class="d-flex flex-nowrap gap-3" style="scroll-snap-type: x mandatory;">
    @forelse ($materis->where('category', 'past_perfect') as $lesson)
      <div class="card shadow-sm" style="width: 500px; height:500px; flex: 0 0 auto; scroll-snap-align: start;">
        <img src="@if($lesson->image === 'logo-aplikasi/logo.png') 
                  {{ asset('assets/img/logo-aplikasi/logo.png') }}
              @elseif(Storage::disk('public')->exists($lesson->image)) 
                  {{ asset('storage/' . $lesson->image) }} 
              @else 
                  {{ asset('assets/img/' . $lesson->image) }} 
              @endif"
            class="card-img-top" style="height:150px; object-fit: contain;" alt="Lesson image: {{ $lesson->title }}">
        <div class="card-body">
          <h5 class="card-title">{{ $lesson->title }}</h5>
          <div class="card-text" style="max-height: 150px; overflow: auto;">
            {!! Str::limit(strip_tags($lesson->text, '<h1>'), 250, '...') !!}
          </div>
        </div>
        <div class="card-footer text-end bg-transparent border-top-0">
          <a href="{{ route('lesson.show', $lesson->id) }}" class="btn btn-sm btn-outline-primary">See more</a>
        </div>
      </div>
    @empty
      <p class="text-muted">No lessons found.</p>
    @endforelse
  </div>
</div>

<h1 class="fs-5 mt-4">Storytelling</h1>
<div class="overflow-auto pb-2">
  <div class="d-flex flex-nowrap gap-3" style="scroll-snap-type: x mandatory;">
    @forelse ($materis->where('category', 'storytelling') as $lesson)
      <div class="card shadow-sm" style="width: 500px; height:500px; flex: 0 0 auto; scroll-snap-align: start;">
        <img src="@if($lesson->image === 'logo-aplikasi/logo.png') 
                  {{ asset('assets/img/logo-aplikasi/logo.png') }}
              @elseif(Storage::disk('public')->exists($lesson->image)) 
                  {{ asset('storage/' . $lesson->image) }} 
              @else 
                  {{ asset('assets/img/' . $lesson->image) }} 
              @endif"
            class="card-img-top" style="height:150px; object-fit: contain;" alt="Lesson image: {{ $lesson->title }}">
        <div class="card-body">
          <h5 class="card-title">{{ $lesson->title }}</h5>
          <div class="card-text" style="max-height: 150px; overflow: auto;">
            {!! Str::limit(strip_tags($lesson->text, '<h1>'), 250, '...') !!}
          </div>
        </div>
        <div class="card-footer text-end bg-transparent border-top-0">
          <a href="{{ route('lesson.show', $lesson->id) }}" class="btn btn-sm btn-outline-primary">See more</a>
        </div>
      </div>
    @empty
      <p class="text-muted">No lessons found.</p>
    @endforelse
    <!-- <div class="card shadow-sm" style="width: 500px; height:500px; flex: 0 0 auto; scroll-snap-align: start;">
      <img src='logo-aplikasi/logo.png'
        class="card-img-top" 
        style="height:150px; object-fit: contain;" 
        alt="Lesson image">
      <div class="card-body">
        <h5 class="card-title">Test Title</h5>
        <div class="card-text" style="max-height: 150px; overflow: auto;">
          Test text
        </div>
      </div>
      <div class="card-footer text-end bg-transparent border-top-0">
        <a href="{{ route('test.show') }}" class="btn btn-sm btn-outline-primary">See more</a>
      </div>
    </div> -->
  </div>
</div>

@section('script')
<script src="{{ asset('assets/js/materi/index.js') }}"></script>
@endsection
@endsection