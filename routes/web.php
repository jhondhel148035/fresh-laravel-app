<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Ideas;
use App\Models\Post;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Welcome / Dashboard Route
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    // Fetch users so they can be displayed in the table on the welcome page
    $users = User::all();

    return view('welcome', [
        'users' => $users,
        'greeting' => 'Hello, World!',
        'name' => 'John Doe',
        'age' => 30,
        'tasks' => [
            'Learn Laravel',
            'Build a project',
            'Deploy to production',
        ],
    ]);
})->name('users.index');

/*
|--------------------------------------------------------------------------
| Existing Post / Formtest Routes
|--------------------------------------------------------------------------
*/
Route::view('/about', 'about');
Route::view('/contact', 'contact');

Route::get('/formtest', function () {
    $posts = Post::all();

    return view('formtest', [
        'posts' => $posts,
    ]);
});

Route::post('/formtest', function () {
    Post::create([
        'description' => request('description'),
    ]);

    return redirect('/formtest');
});

Route::delete('/formtest/{id}', function ($id) {
    Post::findOrFail($id)->delete();

    return redirect('/formtest');
});

Route::get('/delete', function () {
    Post::truncate();

    return redirect('/formtest');
});

/*
|--------------------------------------------------------------------------
| User CRUD Routes
|--------------------------------------------------------------------------
*/

// Task 4: Store Data (Integrated exactly as provided)
Route::post('/users', function (Request $request) {
    // Create the user using the data from the form
    User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'middle_name' => $request->middle_name,
        'nickname' => $request->nickname,
        'email' => $request->email,
        'age' => $request->age,
        'address' => $request->address,
        'contact_number' => $request->contact_number,
        'password' => Hash::make($request->password), // Securely hash the password
    ]);

    return redirect('/')->with('success', 'User registered successfully!');
})->name('users.store');

// Task 7: Show Update Form
Route::get('/user-edit/{id}', function ($id) {
    $user = User::findOrFail($id);
    return view('user_edit', compact('user'));
})->name('users.edit');

// Task 7: Process Update
Route::put('/user-update/{id}', function (Request $request, $id) {
    $user = User::findOrFail($id);
    $user->update([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'middle_name' => $request->middle_name,
        'nickname' => $request->nickname,
        'email' => $request->email,
        'age' => $request->age,
        'address' => $request->address,
        'contact_number' => $request->contact_number,
    ]);
    return redirect()->route('users.index');
})->name('users.update');

// Task 6: Delete Function
Route::delete('/user-delete/{id}', function ($id) {
    $user = User::findOrFail($id);
    $user->delete();
    return redirect()->route('users.index');
})->name('users.destroy');

Route::get('/books', function (Request $request) {
    $genres = Book::select('genre')->distinct()->orderBy('genre')->pluck('genre');
    $books = Book::query();

    if ($search = $request->query('search')) {
        $books->where(function ($query) use ($search) {
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('author', 'like', "%{$search}%");
        });
    }

    if ($genre = $request->query('genre')) {
        $books->where('genre', $genre);
    }

    return view('books.index', [
        'books' => $books->orderBy('created_at', 'desc')->get(),
        'genres' => $genres,
    ]);
})->name('books.index');

Route::get('/books/create', function () {
    return view('books.create');
})->name('books.create');

Route::post('/books', function (Request $request) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'required|string',
        'genre' => 'required|string|max:255',
        'published_year' => 'required|integer',
        'isbn' => 'required|string|unique:books,isbn',
        'pages' => 'required|integer',
        'language' => 'required|string|max:255',
        'publisher' => 'required|string|max:255',
        'price' => 'required|numeric',
        'cover_image' => 'nullable|image|max:2048',
        'is_available' => 'sometimes|boolean',
    ]);

    if ($request->hasFile('cover_image')) {
        $image = $request->file('cover_image');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_.]/', '_', $image->getClientOriginalName());
        $destination = public_path('cover_images');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $image->move($destination, $filename);
        $validated['cover_image'] = 'cover_images/' . $filename;
    }

    $validated['is_available'] = $request->has('is_available');
    Book::create($validated);

    return redirect()->route('books.index');
})->name('books.store');

Route::get('/books/{book}', function (Book $book) {
    return view('books.show', compact('book'));
})->name('books.show');

Route::get('/books/{book}/edit', function (Book $book) {
    return view('books.edit', compact('book'));
})->name('books.edit');

Route::put('/books/{book}', function (Request $request, Book $book) {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'required|string',
        'genre' => 'required|string|max:255',
        'published_year' => 'required|integer',
        'isbn' => 'required|string|unique:books,isbn,' . $book->id,
        'pages' => 'required|integer',
        'language' => 'required|string|max:255',
        'publisher' => 'required|string|max:255',
        'price' => 'required|numeric',
        'cover_image' => 'nullable|image|max:2048',
        'is_available' => 'sometimes|boolean',
    ]);

    if ($request->hasFile('cover_image')) {
        $image = $request->file('cover_image');
        $filename = time() . '_' . preg_replace('/[^A-Za-z0-9\-_.]/', '_', $image->getClientOriginalName());
        $destination = public_path('cover_images');

        if (!file_exists($destination)) {
            mkdir($destination, 0755, true);
        }

        $image->move($destination, $filename);
        $validated['cover_image'] = 'cover_images/' . $filename;
    } else {
        $validated['cover_image'] = $book->cover_image;
    }

    $validated['is_available'] = $request->has('is_available');
    $book->update($validated);

    return redirect()->route('books.index');
})->name('books.update');

Route::delete('/books/{book}', function (Book $book) {
    $book->delete();
    return redirect()->route('books.index');
})->name('books.destroy');
