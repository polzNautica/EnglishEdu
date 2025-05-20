@extends('layouts.main.index')
@section('container')
@section('style')
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
<style>
  ::-webkit-scrollbar {
    display: none;
  }

  @media screen and (min-width: 1320px) {
    #search {
      width: 250px;
    }
  }

  .required-label::after {
    content: " *";
    color: red;
  }

  @media screen and (max-width: 575px) {
    .pagination-mobile {
      display: flex;
      justify-content: end;
    }
  }

  audio {
    height: 35px;
    outline: none;
  }

  audio::-webkit-media-controls-panel {
    background-color: #f1f1f1;
    color: #333;
    border-radius: 8px;
    padding: 0px;
  }

  audio::-webkit-media-controls-play-button,
  audio::-webkit-media-controls-pause-button {
    background-color: #696cff;
    color: #fff;
    border-radius: 50%;
    padding: 0px;
    border: none;
    cursor: pointer;
  }
</style>
@endsection
<div class="flash-message" data-add-materi="@if(session()->has('addMateriSuccess')) {{ session('addMateriSuccess') }} @endif" data-edit-materi="@if(session()->has('editMateriSuccess')) {{ session('editMateriSuccess') }} @endif" data-delete-materi="@if(session()->has('deleteMateriSuccess')) {{ session('deleteMateriSuccess') }} @endif"></div>
<div class="row">
  <div class="col-md-12 col-lg-12 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between" style="margin-bottom: -0.7rem;">
        <div class="justify-content-start">
          <button type="button" class="btn btn-xs btn-dark fw-bold p-2 buttonAddMateri" data-bs-toggle="modal" data-bs-target="#formModalAdminMateri">
            <i class='bx bx-book-content fs-6'></i>&nbsp;ADD LESSONS
          </button>
        </div>
        <div class="justify-content-end">
          <form action="/admin/data-materi/search">
            <div class="input-group">
              <input type="search" class="form-control" value="{{ request('q') }}" name="q" id="search" style="border: 1px solid #d9dee3;" placeholder="Search Lessons Data..." autocomplete="off" />
            </div>
          </form>
        </div>
      </div>
      <div class="card-body">
        <ul class="p-0 m-0">
          <div class="table-responsive text-nowrap" style="border-radius: 3px;">
            <table class="table table-striped">
              <thead class="table-dark">
                <tr>
                <th class="text-white">No</th>
                <th class="text-white">Image</th>
                <th class="text-white text-center">Lesson Title</th>
                <th class="text-white text-center">Category</th>
                <th class="text-white text-center">Audio</th>
                <th class="text-white">Creation Date</th>
                <th class="text-white">Update Date</th>
                <th class="text-white text-center">Actions</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($materis as $index => $materi)
                <tr>
                  <td>{{ $materis->firstItem() + $index }}</td>
                  <td><img src="@if(Storage::disk('public')->exists($materi->image)) {{ asset('storage/'. $materi->image) }} @else {{ asset('assets/img/'. $materi->image) }} @endif" alt="Materi Image - {{ $materi->title }}" class="materiImage" data-url-img="@if(Storage::disk('public')->exists($materi->image)) {{ asset('storage/'. $materi->image) }} @else {{ asset('assets/img/'. $materi->image) }} @endif" data-title-materi="{{ $materi->title }}" style="width: 40px;"></td>
                  <td class="text-capitalize text-center">{{ $materi->title }}</td>
                  <td class="text-center">
                      @switch($materi->category)
                          @case('past_simple_regular_verbs')
                              <span class="badge bg-label-success fw-bold">Past Simple (Regular Verbs)</span>
                              @break
                          @case('past_simple_irregular_verbs')
                              <span class="badge bg-label-info fw-bold">Past Simple (Irregular Verbs)</span>
                              @break
                          @case('past_continuous')
                              <span class="badge bg-label-warning fw-bold">Past Continuous</span>
                              @break
                          @case('past_perfect')
                              <span class="badge bg-label-primary fw-bold">Past Perfect</span>
                              @break
                          @case('storytelling')
                              <span class="badge bg-label-dark fw-bold">Storytelling and Practice</span>
                              @break
                          @default
                              <span class="badge bg-label-secondary fw-bold">Unknown</span>
                      @endswitch
                  </td>
                  <td>@if($materi->audio)<audio controls>
                      <source src="@if(Storage::disk('public')->exists($materi->audio)) {{ asset('storage/'. $materi->audio) }} @else {{ asset('assets/'. $materi->audio) }} @endif" type="audio/mpeg">
                    </audio>@else No Audio @endif
                  </td>
                  <td>{{ $materi->created_at->locale('en')->isoFormat('D MMMM YYYY | H:mm') }}</td>
                  <td>{{ $materi->updated_at->locale('en')->isoFormat('D MMMM YYYY | H:mm') }}</td>
                  <td class="text-center">
                  <button type="button" class="btn btn-icon btn-primary btn-sm buttonEditMateri" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Edit Lesson" data-code-materi="{{ encrypt($materi->id) }}" data-title-materi="{{ $materi->title }}" data-category-materi="{{ $materi->category }}" data-text-materi="{{ $materi->text }}" data-link-materi="{{ $materi->link }}">
                  <span class="tf-icons bx bx-edit" style="font-size: 15px;"></span>
                    </button>
                    <button type="button" class="btn btn-icon btn-danger btn-sm buttonDeleteMateri" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Delete Lessons" data-code-materi="{{ encrypt($materi->id) }}" data-title-materi="{{ $materi->title }}">
                      <span class="tf-icons bx bx-trash" style="font-size: 14px;"></span>
                    </button>
                  </td>
                </tr>
                @endforeach
                @if($materis->isEmpty())
                <tr>
                  <td colspan="100" class="text-center">Data tidak ditemukan dengan keyword pencarian: <b>"{{request('q')}}"</b></td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </ul>
        @if(!$materis->isEmpty())
        <div class="mt-3 pagination-mobile">{{ $materis->withQueryString()->onEachSide(1)->links() }}</div>
        @endif
      </div>
    </div>
  </div>
</div>

<div id="errorModalAddMateri" data-error-title="@error('title') {{ $message }} @enderror" data-error-image="@error('image') {{ $message }} @enderror" data-error-audio="@error('audio') {{ $message }} @enderror" data-error-category="@error('category') {{ $message }} @enderror"></div>
<!-- Modal Add Materi-->
<div class="modal fade" id="formModalAdminMateri" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="/admin/data-materi" method="post" class="modalAdminMateri" enctype="multipart/form-data">
      @csrf
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title text-primary fw-bold">Add New Lessons&nbsp;<i class='bx bx-book-content fs-5' style="margin-bottom: 1px;"></i></h5>
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow cancelModalAddMateri" data-bs-dismiss="modal"><i class="bx bx-x-circle text-danger fs-4" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Close"></i></button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col mb-3">
              <label for="title" class="form-label required-label">Lesson Title</label>
              <input type="text" id="title" name="title" value="{{ old('title') }}" class="form-control @error('title') is-invalid @enderror" placeholder="Enter Lessons Title" autocomplete="off" required>
              @error('title')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col mb-3">
              <label for="text" class="form-label">Lesson Text</label>
              <textarea id="text" name="text" class="d-none @error('text') is-invalid @enderror">{{ old('text') }}</textarea>
              <!-- Quill editor container -->
              <div id="textQuill" style="height: 200px;">{{ old('text') }}</div>

              <!-- Hidden textarea to submit Quill content -->
              <!-- <textarea name="text" id="text" class="d-none"></textarea> -->

              @error('text')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col mb-3">
              <label for="image" class="form-label required-label">Upload Picture</label>
              <input type="file" id="image" name="image" class="form-control @error('image') is-invalid @enderror">
              @error('image')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
              <div class="form-text @error('image') d-none @enderror">Maximum size 500 KB with a 1:1 ratio. Format: JPG, PNG, JPEG.</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="audio" class="form-label">Upload Audio</label>
              <input type="file" id="audio" name="audio" class="form-control @error('audio') is-invalid @enderror">
              @error('audio')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
              <div class="form-text @error('audio') d-none @enderror">Ukuran audio maks 250 KB</div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="category" class="form-label required-label">Category</label>
              <select class="form-select @error('category') is-invalid @enderror" name="category" id="category" style="cursor: pointer;">
                  <option value="" selected disabled>Choose Category</option>
                  <option @if(old('category') == 'past_simple_regular_verbs') selected @endif value="past_simple_regular_verbs">Past Simple (Regular Verbs)</option>
                  <option @if(old('category') == 'past_simple_irregular_verbs') selected @endif value="past_simple_irregular_verbs">Past Simple (Irregular Verbs)</option>
                  <option @if(old('category') == 'past_continuous') selected @endif value="past_continuous">Past Continuous</option>
                  <option @if(old('category') == 'past_perfect') selected @endif value="past_perfect">Past Perfect</option>
                  <option @if(old('category') == 'storytelling') selected @endif value="storytelling">Storytelling and Practice</option>
              </select>
              @error('category')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger cancelModalAddMateri" data-bs-dismiss="modal"><i class='bx bx-share fs-6' style="margin-bottom: 3px;"></i>&nbsp;Cancel</button>
          <button type="submit" class="btn btn-primary"><i class='bx bx-paper-plane fs-6' style="margin-bottom: 3px;"></i>&nbsp;Add</button>
        </div>
      </div>
    </form>
  </div>
</div>

<div id="errorModalEditMateri" data-error-edit-title="@error('titleEdit') {{ $message }} @enderror" data-error-edit-image="@error('imageEdit') {{ $message }} @enderror" data-error-edit-audio="@error('audioEdit') {{ $message }} @enderror" data-error-edit-category="@error('categoryEdit') {{ $message }} @enderror"></div>
<!-- Modal Edit Lessons-->
<div class="modal fade" id="formEditModalAdminMateri" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="/admin/data-materi/update" method="post" class="modalAdminMateri" enctype="multipart/form-data">
      @csrf
      <input type="hidden" class="codeMateri" value="{{ old('codeMateri') }}" name="codeMateri">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title text-primary fw-bold">Edit Lessons&nbsp;<i class='bx bx-joystick fs-5' style="margin-bottom: 1px;"></i></h5>
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow cancelModalEditMateri" data-bs-dismiss="modal"><i class="bx bx-x-circle text-danger fs-4" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Close"></i></button>
        </div>
        <div class="modal-body">

          <div class="row">
            <div class="col mb-3">
              <label for="titleEdit" class="form-label required-label">Lesson Title</label>
              <input type="text" id="titleEdit" name="titleEdit" value="{{ old('titleEdit') }}" class="form-control @error('titleEdit') is-invalid @enderror" autocomplete="off" placeholder="Enter Lessons Title" required>
              @error('titleEdit')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col mb-3">
              <label for="textEdit" class="form-label">Lesson Text</label>
              <textarea id="textEdit" name="textEdit" class="d-none @error('textEdit') is-invalid @enderror">{{ old('textEdit') }}</textarea>

               <!-- Wrapper for dynamic editor injection -->
              <div id="quill-modal-wrapper">
                <div id="textEditQuill" style="height: 200px;">{{ old('textEdit') }}</div>
              </div>

              <!-- Hidden textarea to submit Quill content -->
              <!-- <textarea name="textEdit" id="textEdit" class="d-none"></textarea> -->

              @error('textEdit')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>

          <div class="row">
            <div class="col mb-3">
              <label for="imageEdit" class="form-label">Upload Picture</label>
              <input type="file" id="imageEdit" name="imageEdit" class="form-control @error('imageEdit') is-invalid @enderror">
              @error('imageEdit')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
              <div class="form-text @error('imageEdit') d-none @enderror">Maximum size 500 KB with a 1:1 ratio. Format: JPG, PNG, JPEG.</div>
            </div>
          </div>
          <div class="row">
            <div class="col mb-3">
              <label for="audioEdit" class="form-label">Upload Audio</label>
              <input type="file" id="audioEdit" name="audioEdit" class="form-control @error('audioEdit') is-invalid @enderror">
              @error('audioEdit')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
              <div class="form-text @error('audioEdit') d-none @enderror">Ukuran audio maks 250 KB</div>
            </div>
          </div>
          <div class="row">
            <div class="col">
              <label for="categoryEdit" class="form-label required-label">Category</label>
              <select class="form-select @error('categoryEdit') is-invalid @enderror" name="categoryEdit" id="categoryEdit" style="cursor: pointer;">
                  <option value="" selected disabled>Choose Category</option>
                  <option id="past_simple_regular_verbs" @if(old('categoryEdit') == 'past_simple_regular_verbs') selected @endif value="past_simple_regular_verbs">Past Simple (Regular Verbs)</option>
                  <option id="past_simple_irregular_verbs" @if(old('categoryEdit') == 'past_simple_irregular_verbs') selected @endif value="past_simple_irregular_verbs">Past Simple (Irregular Verbs)</option>
                  <option id="past_continuous" @if(old('categoryEdit') == 'past_continuous') selected @endif value="past_continuous">Past Continuous</option>
                  <option id="past_perfect" @if(old('categoryEdit') == 'past_perfect') selected @endif value="past_perfect">Past Perfect</option>
                  <option id="storytelling" @if(old('categoryEdit') == 'storytelling') selected @endif value="storytelling">Storytelling and Practice</option>
              </select>
              @error('categoryEdit')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger cancelModalEditMateri" data-bs-dismiss="modal"><i class='bx bx-share fs-6' style="margin-bottom: 3px;"></i>&nbsp;Cancel</button>
          <button type="submit" class="btn btn-primary"><i class='bx bx-save fs-6' style="margin-bottom: 3px;"></i>&nbsp;Update</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- modal delete Materi -->
<div class="modal fade" id="deleteMateriConfirm" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="/admin/data-materi/delete" method="post" id="formDeleteMateri">
      @csrf
      <input type="hidden" class="codeMateri" value="{{ old('codeMateri') }}" name="codeMateri">
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title text-primary fw-bold">Confirmation&nbsp;<i class='bx bx-check-shield fs-5' style="margin-bottom: 3px;"></i></h5>
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-dismiss="modal"><i class="bx bx-x-circle text-danger fs-4" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Close"></i></button>
        </div>
        <div class="modal-body" style="margin-top: -10px;">
          <div class="col-sm fs-6 materiMessagesDelete"></div>
        </div>
        <div class="modal-footer" style="margin-top: -5px;">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class='bx bx-share fs-6' style="margin-bottom: 3px;"></i>&nbsp;No</button>
          <button type="submit" class="btn btn-primary"><i class='bx bx-trash fs-6' style="margin-bottom: 3px;"></i>&nbsp;Yes, Delete!</button>
        </div>
      </div>
    </form>
  </div>
</div>

@section('script')
<script src="{{ asset('assets/js/datamateri/index.js') }}"></script>
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<script src="https://cdn.jsdelivr.net/npm/quill-image-resize-module@latest/image-resize.min.js"></script>

<script>
let quill;
let quillText;

function imageHandler() {
  const input = document.createElement('input');
  input.setAttribute('type', 'file');
  input.setAttribute('accept', 'image/*');
  input.click();

  input.onchange = () => {
    const file = input.files[0];
    const formData = new FormData();
    formData.append('image', file);

    fetch("{{ route('quill.upload') }}", {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": document.querySelector('meta[name=\"csrf-token\"]').getAttribute('content')
      },
      body: formData
    })
    .then(response => response.json())
    .then(result => {
      const range = this.quill.getSelection();
      this.quill.insertEmbed(range.index, 'image', result.url);
    })
    .catch(error => {
      console.error("Image upload failed", error);
    });
  };
}

// Initialize main editor (outside modal)
function initMainEditor() {
  if (document.getElementById('textQuill') && !quillText) {
    quillText = new Quill('#textQuill', {
      modules: {
        toolbar: {
          container: [
            [{ header: [1, 2, 3, 4, false] }],
            ['bold', 'italic', 'underline', 'strike'],
            [{ list: 'ordered' }, { list: 'bullet' }],
            [{ 'indent': '-1'}, { 'indent': '+1' }],
            [{ 'color': [] }, { 'background': [] }],
            [{ 'font': [] }],
            [{ 'align': [] }],
            ['link', 'blockquote', 'code-block', 'image', 'video'],
          ],
          handlers: {
            image: imageHandler
          }
        }
      },
      imageResize: {
        displaySize: true,
        modules: ['Resize', 'DisplaySize'] // You can customize which handles to show
      },
      placeholder: 'Enter Lessons Text...',
      theme: 'snow'
    });

    const initialContent = document.getElementById('text').value;
    if (initialContent) {
      quillText.root.innerHTML = initialContent;
    }

    quillText.on('text-change', function() {
      document.getElementById('text').value = quillText.root.innerHTML;
    });
  }
}

// Initialize modal editor
function initModalEditor() {
  const container = document.getElementById('textEditQuill');
  
  // Completely destroy previous instance
  if (quill) {
    quill.off('text-change'); // Remove all event listeners
    quill = null;
  }
  
  // Recreate the container element
  const wrapper = container.parentNode;
  wrapper.innerHTML = '<div id="textEditQuill" style="height: 200px;"></div>';
  
  // Get fresh reference to the new container
  const newContainer = document.getElementById('textEditQuill');
  
  // Initialize new Quill instance
  quill = new Quill(newContainer, {
    modules: {
      toolbar: {
        container: [
          [{ header: [1, 2, 3, 4, false] }],
          ['bold', 'italic', 'underline', 'strike'],
          [{ list: 'ordered' }, { list: 'bullet' }],
          [{ 'indent': '-1'}, { 'indent': '+1' }],
          [{ 'color': [] }, { 'background': [] }],
          [{ 'font': [] }],
          [{ 'align': [] }],
          ['link', 'blockquote', 'code-block', 'image', 'video'],
        ],
        handlers: {
          image: imageHandler
        }
      },
      imageResize: {
        displaySize: true,
        modules: ['Resize', 'DisplaySize'] // You can customize which handles to show
      }
    },
    placeholder: 'Enter Lessons Text...',
    theme: 'snow'
  });

  const hiddenText = document.getElementById('textEdit').value;
  if (hiddenText) {
    quill.root.innerHTML = hiddenText;
  }

  quill.on('text-change', function() {
    document.getElementById('textEdit').value = quill.root.innerHTML;
  });
}

// Initialize main editor on page load
document.addEventListener('DOMContentLoaded', function() {
  initMainEditor();
});

// Modal event handlers
$('#formEditModalAdminMateri').on('shown.bs.modal', function() {
  initModalEditor();
});

$('#formEditModalAdminMateri').on('hidden.bs.modal', function() {
  // Clean up but don't destroy completely as we'll reuse it
  if (quill) {
    quill.off('text-change');
    quill = null;
  }
});
</script>
@endsection
@endsection