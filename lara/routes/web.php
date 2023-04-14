<?php

use Illuminate\Support\Facades\Route;
use Dbfx\LaravelStrapi\LaravelStrapi;
use Illuminate\Http\Request;

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

Route::get('/', function () {
    $strapi = new LaravelStrapi();
    $blogs = $strapi->collection('api/blogs');
    $blogs = $blogs['data'];
    return view('blogs.index', compact('blogs'));
});

Route::get('/register', function () {
    return view('blogs.register');
});

Route::post('/register', function (Request $request) {
    $dataInput = $request->all();
    $strapi = new LaravelStrapi();
    $result = $strapi->postAction('api/blogs', array(
        'data' => array(
            'Title' => $dataInput['title'],
            'Author' => $dataInput['author'],
            'Content' => $dataInput['content']
        )
    ));
    return redirect('/');
});

Route::get('/edit/{id}', function ($id) {
    $strapi = new LaravelStrapi();
    $blog = $strapi->collection('api/blogs/' . $id);
    if (empty($blog['data'])) {
        $blog = [];
    } else {
        $blog = $blog['data'];
    }
    return view('blogs.register', compact('blog'));
});

Route::post('/edit/{id}', function (Request $request, $id) {
    $dataInput = $request->all();
    $strapi = new LaravelStrapi();
    $result = $strapi->putAction('api/blogs/'. $id, array(
        'data' => array(
            'Title' => $dataInput['title'],
            'Author' => $dataInput['author'],
            'Content' => $dataInput['content']
        )
    ));
    return redirect('/');
});

Route::get('/delete/{id}', function ($id) {
    $strapi = new LaravelStrapi();
    $blog = $strapi->deleteAction('api/blogs/' . $id);
    return redirect('/');
});