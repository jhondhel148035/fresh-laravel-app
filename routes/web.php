<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Ideas;
use App\Models\Post;
use App\Models\User;
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