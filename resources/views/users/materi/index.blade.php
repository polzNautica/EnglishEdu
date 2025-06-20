@extends('layouts.main.index')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
@endsection
@section('style')
<style>
  .swiper {
    padding: 10px 40px; /* Increased padding to accommodate arrows */
    position: relative;
  }
  
  /* Navigation buttons base styling */
  .notes-swiper-button-prev,
  .notes-swiper-button-next,
  .exercises-swiper-button-prev,
  .exercises-swiper-button-next,
  .sentences-swiper-button-prev,
  .sentences-swiper-button-next {
    position: absolute;
    top: 50%;
    width: 40px;
    height: 40px;
    margin-top: -20px;
    z-index: 10;
    cursor: pointer;
    background-color: rgba(255,255,255,0.5);
    /* border-radius: 50%; */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  /* Arrow styling using Swiper's default classes */
  .notes-swiper-button-prev::after,
  .notes-swiper-button-next::after,
  .exercises-swiper-button-prev::after,
  .exercises-swiper-button-next::after,
  .sentences-swiper-button-prev::after,
  .sentences-swiper-button-next::after {
    font-family: 'swiper-icons';
    font-size: 24px;
    font-weight: bold;
    color: inherit;
  }
  
  /* Previous arrow content */
  .notes-swiper-button-prev::after,
  .exercises-swiper-button-prev::after,
  .sentences-swiper-button-prev::after {
    content: 'prev';
  }
  
  /* Next arrow content */
  .notes-swiper-button-next::after,
  .exercises-swiper-button-next::after,
  .sentences-swiper-button-next::after {
    content: 'next';
  }

  /* Position and color customization */
  .notes-swiper-button-prev,
  .exercises-swiper-button-prev,
  .sentences-swiper-button-prev {
    left: 5px;
    color: #0d6efd;
  }
  
  .notes-swiper-button-next,
  .exercises-swiper-button-next,
  .sentences-swiper-button-next {
    right: 5px;
    color: #0d6efd;
  }
  
  .exercises-swiper-button-prev,
  .exercises-swiper-button-next {
    color: #dc3545;
  }
  
  .sentences-swiper-button-prev,
  .sentences-swiper-button-next {
    color: #ffc107;
  }

  /* Pagination Styles */
.notes-swiper-pagination,
.exercises-swiper-pagination,
.sentences-swiper-pagination {
  position: relative;
  margin-top: 15px;
  
}

.notes-swiper-pagination .swiper-pagination-bullet,
.exercises-swiper-pagination .swiper-pagination-bullet,
.sentences-swiper-pagination .swiper-pagination-bullet {
  width: 8px;
  height: 8px;
  display: inline-block;
  border-radius: 50%;
  background: #ccc;
  margin: 0 4px;
  opacity: 0.5;
  cursor: pointer;
}

.notes-swiper-pagination .swiper-pagination-bullet-active {
  background: #0d6efd;
  opacity: 1;
}

.exercises-swiper-pagination .swiper-pagination-bullet-active {
  background: #dc3545;
  opacity: 1;
}

.sentences-swiper-pagination .swiper-pagination-bullet-active {
  background: #ffc107;
  opacity: 1;
}
</style>
@endsection
@section('container')
<h1 class="fs-5 mt-4">Notes and Examples</h1>
<div class="swiper notes-swiper">
  <div class="swiper-wrapper">
    @forelse ($materis->where('category', 'notes_example') as $lesson)
      <div class="swiper-slide">
        <div class="card shadow-sm materi-card">
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
            <div class="card-text" style="max-height: 200px; overflow: auto;">
              {!! Str::limit(strip_tags($lesson->text, '<h1>'), 250, '...') !!}
            </div>
          </div>
          <div class="card-footer text-end bg-transparent border-top-0">
            <a href="{{ route('lesson.show', $lesson->id) }}" class="btn btn-sm btn-outline-primary">See more</a>
          </div>
        </div>
      </div>
    @empty
      <p class="text-muted">No lessons found.</p>
    @endforelse

  </div>

  <div class="notes-swiper-button-prev"></div>
  <div class="notes-swiper-button-next"></div>
  <div class="notes-swiper-pagination"></div>

</div>

<h1 class="fs-5 mt-4">Exercises and Activities</h1>
<div class="swiper exercises-swiper">
  <div class="swiper-wrapper">
    @forelse ($materis->where('category', 'exercises_activities') as $lesson)
      <div class="swiper-slide">
        <div class="card shadow-sm materi-card h-100">
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
            <div class="card-text" style="max-height: 200px; overflow: auto;">
              {!! Str::limit(strip_tags($lesson->text, '<h1>'), 250, '...') !!}
            </div>
          </div>
          <div class="card-footer text-end bg-transparent border-top-0">
            <a href="{{ route('lesson.show', $lesson->id) }}" class="btn btn-sm btn-outline-primary">See more</a>
          </div>
        </div>
      </div>
    @empty
      <!-- <p class="text-muted">No lessons found.</p> -->
    @endforelse

    <div class="swiper-slide">
      <div class="card shadow-sm materi-card h-100">
      <img src='assets/img/aksara/quiz.jpg'
        class="card-img-top" 
        style="height:150px; object-fit: contain;" 
        alt="Lesson image">
        <div class="card-body">
          <h5 class="card-title">Interactive Quiz</h5>
          <div class="card-text" style="max-height: 200px; overflow: auto;">
            <h1>Past Tense Quiz</h1>
            <p>
              Answer all the questions to help your understanding on Past Tense. This will help you understand the usage of past tense in a sentence.
            </p>
          </div>
        </div>
        <div class="card-footer text-end bg-transparent border-top-0">
          <a href="{{ route('test.show') }}" class="btn btn-sm btn-outline-primary">See more</a>
        </div>
      </div>
    </div>

    <div class="swiper-slide">
      <div class="card shadow-sm materi-card h-100">
      <img src='assets/img/aksara/drag.jpg'
        class="card-img-top" 
        style="height:150px; object-fit: contain;" 
        alt="Lesson image">
        <div class="card-body">
          <h5 class="card-title">Dragging Word Game</h5>
          <div class="card-text" style="max-height: 200px; overflow: auto;">
            <h1>Past Tense Irregular Verbs and Regular Verbs Sorting Game</h1>
            <p>
              Arrange the words to the correct section.
            </p>
          </div>
        </div>
        <div class="card-footer text-end bg-transparent border-top-0">
          <a href="{{ route('test4.show') }}" class="btn btn-sm btn-outline-primary">See more</a>
        </div>
      </div>
    </div>
  </div>

  <div class="exercises-swiper-button-prev"></div>
  <div class="exercises-swiper-button-next"></div>
  <div class="exercises-swiper-pagination"></div>

</div>

<h1 class="fs-5 mt-4">Sentences using Past Simple</h1>
<div class="swiper sentences-swiper">
  <div class="swiper-wrapper">
    @forelse ($materis->where('category', 'sentences') as $lesson)
      <div class="swiper-slide">
        <div class="card shadow-sm materi-card">
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
          <div class="card-text" style="max-height: 200px; overflow: auto;">
            {!! Str::limit(strip_tags($lesson->text, '<h1>'), 250, '...') !!}
          </div>
        </div>
        <div class="card-footer text-end bg-transparent border-top-0">
          <a href="{{ route('lesson.show', $lesson->id) }}" class="btn btn-sm btn-outline-primary">See more</a>
        </div>
      </div>
      </div>
    @empty
      <!-- <p class="text-muted">No lessons found.</p> -->
    @endforelse

    <div class="swiper-slide">
              <div class="card shadow-sm materi-card">
      <img src='assets/img/aksara/magicbook.jpg'
        class="card-img-top" 
        style="height:150px; object-fit: contain;" 
        alt="Lesson image">
      <div class="card-body">
        <h5 class="card-title">Magic Picture</h5>
        <div class="card-text" style="max-height: 200px; overflow: auto;">
          <h1>Past Tense Sentences.</h1>
          <p>
            Click the image shown to read and listen to sentences constructed using past tense.
          </p>
        </div>
      </div>
      <div class="card-footer text-end bg-transparent border-top-0">
        <a href="{{ route('test2.show') }}" class="btn btn-sm btn-outline-primary">See more</a>
      </div>
    </div>
    </div>
    
    <div class="swiper-slide">
                <div class="card shadow-sm materi-card">
      <img src='assets/img/aksara/storytelling.jpg'
        class="card-img-top" 
        style="height:150px; object-fit: contain;" 
        alt="Lesson image">
      <div class="card-body">
        <h5 class="card-title">Scrolling Lesson</h5>
        <div class="card-text" style="max-height: 200px; overflow: auto;">
          <h1>Types of Past Tense</h1>
          <p>
            Discover how the past tense is used to describe actions and events that have already happened. Learn through examples and explanations to better understand how we talk about the past.
          </p>
        </div>
      </div>
      <div class="card-footer text-end bg-transparent border-top-0">
        <a href="{{ route('test3.show') }}" class="btn btn-sm btn-outline-primary">See more</a>
      </div>
    </div>
    </div>

  </div>

  <div class="sentences-swiper-button-prev"></div>
  <div class="sentences-swiper-button-next"></div>
  <div class="sentences-swiper-pagination"></div>

</div>

@section('script')
<script src="{{ asset('assets/js/materi/index.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    new Swiper('.exercises-swiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      navigation: {
        nextEl: '.exercises-swiper-button-next',
        prevEl: '.exercises-swiper-button-prev',
      },
        pagination: {
        el: '.exercises-swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 50,
        },
      },
    });

    new Swiper('.notes-swiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      navigation: {
        nextEl: '.notes-swiper-button-next',
        prevEl: '.notes-swiper-button-prev',
      },
      pagination: {
        el: '.notes-swiper-pagination',
        clickable: true,
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 50,
        },
      },
    });

    new Swiper('.sentences-swiper', {
      slidesPerView: 1,
      spaceBetween: 20,
      navigation: {
        nextEl: '.sentences-swiper-button-next',
        prevEl: '.sentences-swiper-button-prev',
      },
            pagination: {
        el: '.sentences-swiper-pagination',
        clickable: true,
        //type: 'progressbar',
      },

      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 40,
        },
        1024: {
          slidesPerView: 2,
          spaceBetween: 50,
        },
      },
    });
  });
</script>
@endsection
@endsection