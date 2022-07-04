<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Models\Post;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION
//     ]);
// });
Route::redirect("/","/login");

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {


        $friendsIds = Auth::user()->getFriends()->map(function ($friend) {
            return $friend->id;
        })->toArray();
        $friendsIds[] = Auth::id();
        $posts = Post::query()
            ->with('user')
            ->withCount('comments')
            ->where(function ($query) use ($friendsIds) {
                $query->whereIn("user_id", $friendsIds)
                    ->orWhere(function ($subquery) {
                        $subquery
                            ->whereIn("user_id", Auth::user()->getFriendsOfFriends()->pluck('id'));
                    });

            })
            ->latest()
            ->paginate(10)
            ->withQueryString();


        return Inertia::render('Dashboard', [
        'posts' => $posts
        ]);
    })->name('dashboard');

    Route::post('/post/text', [PostController::class, 'storeText'])->name('post.text');
    Route::post('/post/media', [PostController::class, 'storeMedia'])->name('post.media');
    Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
    Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');
    Route::get('/search', [PostController::class, 'search'])->name('user.search');

    Route::get('/users/{user}', [UserController::class, 'show'])->name('users.show');
    Route::get('/me', [UserController::class, 'me'])->name('users.me');
    Route::post('/users/add', [UserController::class, 'addFriend'])->name('users.add');
    Route::get('/like-unlike/{post}', [PostController::class, 'likeUnlike'])->name("post.like-unlike");

});

Route::get('makogai', function() {
   return Inertia::render('Dashboard');
})->name('makogai');



Route::get('about', function() {
    return Inertia::render('About');
 })->name('about');
