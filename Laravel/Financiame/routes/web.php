<?php


Auth::routes();
Route::resource('/posts','PostController');

// Admin Dashboard Crud operations for users, posts and categories
Route::middleware(['admin' ])->group(function () 
{
Route::get('/admin','AdminController@index')->name('dashboard'); 
Route::get('/admin/users','AdminController@showUsers')->name('users');
Route::get('/admin/users/delete-user/{id}', 'AdminController@deleteUser')->name('delete-user'); 
Route::get('/admin/{user}/edit', 'AdminController@editUser')->name('admin-edit-user');
Route::patch('/admin/users/edit-user/{user}/update', 'AdminController@updateUser')->name('admin-update-user'); 
Route::get('/admin/users/{user}/projects','AdminController@showUserProjects')->name('user-projects');
Route::get('/admin/users/projects/{id}/delete','AdminController@deleteUserProject')->name('admin-delete-user-project');
Route::get('/admin/users/project/{id}/edit','AdminController@editUserProject')->name('admin-edit-user-project');
Route::get('/admin/posts','AdminController@showPosts')->name('admin-posts');
Route::get('/admin/posts/{id}/delete','AdminController@deletePost')->name('admin-delete-post');
Route::get('/admin/categories','AdminController@showCategories')->name('admin-categories');
Route::patch('/admin/categories/{category}/update','AdminController@updateCategory')->name('admin-update-category');
Route::post('/admin/categories/store','AdminController@storeCategory')->name('admin-store-category');
Route::get('/admin/categories/{id}/delete','AdminController@deleteCategory')->name('admin-delete-category');
});
 
// Projects 

Route::resource('/projects','ProjectController');
Route::get('/user/projects', 'ProjectController@showUserProjects')->name('user-dashboard');
Route::get('/project/{project}/packages','ProjectController@showPackages')->name('packages-show');

// Credits & Payment

Route::get('/credits/buy','PaymentController@create')->name('buy-credits');
Route::post('/credits/buy/','PaymentController@store')->name('store-credits');
Route::post('/finance','PaymentController@fundProject')->name('sponsor-project');

 // Packages Crud 
Route::middleware(['auth'])->group(function()
  {
    Route::get('/packages','PackageController@index')->name('packages-index');
    Route::get('/packages/create','PackageController@create')->name('packages-create');
    Route::post('/packages/store','PackageController@store')->name('packages-store');
    Route::get('/packages/{id}/delete','PackageController@destroy')->name('packages-delete');
    Route::get('/packages/{id}/edit','PackageController@edit')->name('packages-edit');
  }
);

