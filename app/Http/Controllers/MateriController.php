<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materi;
use App\Models\Application;

class MateriController extends Controller
{
    public function index()
    {
        return view('admin.datamateri.index', [
            'app' => Application::all(),
            'materis' => Materi::latest()->paginate(10),
            'title' => 'Lessons Data'
        ]);
    }

    // users show
    public function show()
    {
        return view('users.materi.index', [
            'app' => Application::all(),
            'materis' => Materi::all(),
            'title' => 'Lessons'
        ]);
    }

    public function testlesson()
    {
        return view('users.materi.lesson.test', [
            'app' => Application::all(),
            'materis' => Materi::all(),
            'title' => 'Test'
        ]);
    }

    public function testlesson2()
    {
        return view('users.materi.lesson.test2', [
            'app' => Application::all(),
            'materis' => Materi::all(),
            'title' => 'Test'
        ]);
    }

        public function testlesson3()
    {
        return view('users.materi.lesson.test3', [
            'app' => Application::all(),
            'materis' => Materi::all(),
            'title' => 'Test'
        ]);
    }

            public function testlesson4()
    {
        return view('users.materi.lesson.test4', [
            'app' => Application::all(),
            'materis' => Materi::all(),
            'title' => 'Test'
        ]);
    }



    public function showlesson($id)
    {
        $lesson = Materi::findOrFail($id);
        
        return view('users.materi.lesson.show', [
            'lesson' => $lesson,
            'app' => Application::all(),
            'title' => 'Lesson: ' . $lesson->title,
            'materis' => Materi::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'image|file|max:500',
            'title' => 'required|max:255|string',
            'category' => 'required|in:past_simple_regular_verbs,past_simple_irregular_verbs,past_continuous,past_perfect,storytelling',
            'audio' => 'mimes:mp3|max:250',
            'text' => 'nullable|max:1000|string',
            'video' => 'nullable|max:255|string',
            'link' => 'nullable|max:255|string',
        ]);

        // Check if an image was uploaded
        if ($request->file('image')) {
            // If image exists, store it
            $validatedData['image'] = $request->file('image')->store('aksara');
        } else {
            // If no image is uploaded, use the default image
            $validatedData['image'] = 'logo-aplikasi/logo.png';  // This path should be relative to the 'public' folder
        }

        if ($request->file('audio')) {
            $validatedData['audio'] = $request->file('audio')->store('audio');
        }
        if ($request->file('video')) {
            $validatedData['video'] = $request->file('video')->store('video');
        }

        Materi::create($validatedData);
        return back()->with('addMateriSuccess', 'Lessons added successfully!');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'imageEdit' => 'image|file|max:500',
            'titleEdit' => 'max:255|string',
            'categoryEdit' => 'required|in:past_simple_regular_verbs,past_simple_irregular_verbs,past_continuous,past_perfect,storytelling',
            'audioEdit' => 'mimes:mp3|max:250',
            'textEdit' => 'nullable|string',
            'videoEdit' => 'nullable|max:255|string',
            'linkEdit' => 'nullable|max:255|string',
        ], [
            'imageEdit.image' => 'The image field must be an image.',
            'imageEdit.max' => 'The image field must not be greater than 500 kilobytes.',
            'audioEdit.mimes' => 'The audio field must be a file of type: mp3',
            'audioEdit.max' => 'The audio field must not be greater than 250 kilobytes.',
        ]);
        if ($request->file('imageEdit')) {
            $validatedData['imageEdit'] = $request->file('imageEdit')->store('aksara');
            $validatedData['image'] = $validatedData['imageEdit'];
            unset($validatedData['imageEdit']);
        }

        if ($request->file('audioEdit')) {
            $validatedData['audioEdit'] = $request->file('audioEdit')->store('audio');
            $validatedData['audio'] = $validatedData['audioEdit'];
            unset($validatedData['audioEdit']);
        }
        if ($request->file('videoEdit')) {
            $validatedData['videoEdit'] = $request->file('videoEdit')->store('video');
            $validatedData['video'] = $validatedData['videoEdit'];
            unset($validatedData['videoEdit']);
        }
        $validatedData['title'] = $validatedData['titleEdit'];
        $validatedData['category'] = $validatedData['categoryEdit'];
        $validatedData['text'] = $validatedData['textEdit'];
        // $validatedData['link'] = $validatedData['linkEdit'];
        
        unset($validatedData['textEdit']);
        unset($validatedData['titleEdit']);
        unset($validatedData['categoryEdit']);
        unset($validatedData['linkEdit']);

        // dd($request->all());

        Materi::where('id', decrypt($request->codeMateri))->update($validatedData);
        return back()->with('editMateriSuccess', 'Lessons updated successfully!');
    }

    public function destroy(Request $request)
    {
        Materi::destroy(decrypt($request->codeMateri));
        return back()->with('deleteMateriSuccess', 'Lessons deleted successfully!');
    }

    public function search()
    {
        if (request('q') === null) {
            return redirect('/admin/data-materi');
            exit;
        }

        return view('admin.datamateri.search', [
            'app' => Application::all(),
            'title' => 'Lessons Data',
            'materis' => Materi::latest()->searching(request('q'))->paginate(10)
        ]);
    }

    public function uploadImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('quill-images', 'public');
            return response()->json(['url' => '/storage/' . $path]); // Only return relative path
        }
    
        return response()->json(['error' => 'No image uploaded'], 400);
    }
}
