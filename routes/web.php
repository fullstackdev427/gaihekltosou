<?php

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
    return view('top');
})->name('top');

Route::get('/entry', function () {
    return view('entry');
})->name('entry');

Route::get('/entry_login', function () {
    return view('entry_login');
})->name('entry_login');

Route::get('/coming_soon', function () {
    return view('coming_soon');
})->name('coming_soon');

Route::get('inquiries', function() { return view('common.inquiries'); })->name('inquiries');

Route::prefix('admin')->group(function(){
    Route::match(['get', 'post'], 'login', 'AdministratorController@login')->name('admin.login');

    Route::middleware('auth:admin')->group(function(){
        Route::get('logout', 'AdministratorController@logout')->name('admin.logout');
        Route::get('administrator_list', function() { return view(config('const.template.admin.admin_list')); })->name('admin.list');
        Route::put('administrator_restore/{id}', 'AdministratorController@administrator_restore');
        Route::get('painter_list', function() { return view(config('const.template.admin.painter_list')); });
        Route::get('painters', 'AdministratorController@painters');
        Route::get('painter_detail', function() { return view(config('const.template.admin.painter_detail')); });
        Route::put('painter_approve/{id}', 'AdministratorController@painter_approve');
        Route::delete('painter_del/{id}', 'AdministratorController@painter_del');
        Route::put('painter_restore/{id}', 'AdministratorController@painter_restore');
        Route::get('user_list', function() { return view(config('const.template.admin.user_list')); });
        Route::get('users', 'AdministratorController@users');
        Route::get('user_detail', function() { return view(config('const.template.admin.user_detail')); });
        Route::delete('user_del/{id}', 'AdministratorController@user_del');
        Route::put('user_restore/{id}', 'AdministratorController@user_restore');
        Route::get('column_list', function() { return view(config('const.template.admin.column_list')); });
        Route::get('columns', 'AdministratorController@columns');
        Route::get('column_detail', function() { return view(config('const.template.admin.column_detail')); });
        Route::delete('column_del/{id}', 'AdministratorController@column_del');
        Route::get('example_list', function() { return view(config('const.template.admin.example_list')); });
        Route::get('examples', 'AdministratorController@examples');
        Route::get('example_detail', function() { return view(config('const.template.admin.example_detail')); });
        Route::delete('example_del/{id}', 'AdministratorController@example_del');
        Route::get('evaluation_list', function() { return view(config('const.template.admin.evaluation_list')); });
        Route::get('evaluations', 'AdministratorController@evaluations');
        Route::get('notice_list', function() { return view(config('const.template.admin.notice_list')); });
    });
});

Route::prefix('user')->group(function(){
    Route::match(['get', 'post'], 'login', 'UserController@login')->name('user.login');
    Route::get('mypage', 'UserController@show')->name('user.mypage');
    Route::get('logout', 'UserController@logout')->name('user.logout');
    Route::get('entry', 'UserController@create')->name('user.entry');
    Route::get('entry/complete', function() { return view(config('const.template.user.complete')); })->name('user.complete');
    Route::get('profile', 'UserController@edit')->name('user.edit');
    Route::put('edit', 'UserController@update')->name('user.update');
    Route::get('withdraw', 'UserController@withdraw')->name('user.withdraw');
    Route::get('detail/{id}', 'UserController@detail')->name('user.detail');
    Route::get('chat/{painter_id}/{request_id}', 'UserController@chat')->name('user.chat');
    Route::get('search_painter', 'UserController@search_painter')->name('user.search_painter');
    Route::get('favorite', 'FavoriteController@favorite')->name('user.favorite');
    Route::get('construction_case_list', 'UserController@construction_case_list')->name('user.construction_case_list');
    Route::get('evalution/{evaluation_id}/{painter_name}', 'UserController@evaluation')->name('user.evaluation');
    Route::get('search_detail', function() { return view('user.search_detail'); })->name('user.search_detail');

    Route::middleware('auth:user')->group(function(){
        Route::get('inquiries', function() { return view('user.inquiries'); })->name('user.inquiries');
        Route::get('setting', function() { return view('user.setting'); })->name('user.setting');
        Route::get('update_password', function() { return view('user.update_password'); })->name('user.update_password');
    });
});

Route::prefix('painter')->group(function(){
    Route::match(['get', 'post'], 'login', 'PainterController@login')->name('painter.login');
    Route::get('mypage', 'PainterController@show')->name('painter.mypage');
    Route::get('logout', 'PainterController@logout')->name('painter.logout');
    Route::get('entry', 'PainterController@create')->name('painter.entry');
    Route::get('entry/complete', function() { return view(config('const.template.painter.complete')); })->name('painter.complete');
    Route::get('profile', 'PainterController@edit')->name('painter.edit');
    Route::put('edit', 'PainterController@update')->name('painter.update');
    Route::get('preview', 'PainterController@preview')->name('painter.preview');
    Route::get('withdraw', 'PainterController@withdraw')->name('painter.withdraw');
    Route::post('find', 'PainterController@find')->name('painter.find');
    Route::get('detail/{id}', 'PainterController@detail')->name('painter.detail');
    Route::get('chat/{request_id}', 'PainterController@chat')->name('painter.chat');
    Route::get('exampleentry', 'PainterController@exampleentry')->name('painter.exampleentry');
    Route::get('construction_case_list', 'PainterController@construction_case_list')->name('painter.construction_case_list');
    Route::get('column_list', 'PainterController@column_list')->name('painter.column_list');

    Route::middleware('auth:painter')->group(function(){
        Route::get('inquiries', function() { return view('painter.inquiries'); })->name('painter.inquiries');
        Route::get('setting', function() { return view('painter.setting'); })->name('painter.setting');
        Route::get('update_password', function() { return view('painter.update_password'); })->name('painter.update_password');
    });
});

Route::prefix('example')->group(function(){
    Route::get('publish/{id}', 'ExampleController@publish')->name('example.publish');
    Route::get('list', 'ExampleController@list')->name('example.list');
});

Route::prefix('column')->group(function(){
    Route::get('list', 'ColumnController@list')->name('column.list');
    Route::get('create', 'ColumnController@create')->name('column.create');
});

Route::prefix('evaluation')->group(function(){
    Route::get('list', 'ExampleController@list')->name('evaluation.list');
});

Route::prefix('password')->group(function(){
    Route::get('reset/{arg}', 'Auth\ForgotPasswordController@showLinkRequestForm')->where('arg', 'users|painters')->name('password.request');
    Route::post('email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('reset/{arg}/{token}', 'Auth\ResetPasswordController@showResetForm')->where('arg', 'users|painters')->name('password.reset');
    Route::post('reset', 'Auth\ResetPasswordController@reset')->name('password.update');
});

Route::post('notice/send', 'NoticeController@send');

Route::resources([
    'admin'      => 'AdministratorController',
    'column'     => 'ColumnController',
    'contract'   => 'ContractController',
    'evaluation' => 'EvaluationController',
    'example'    => 'ExampleController',
    'favorite'   => 'FavoriteController',
    'notice'     => 'NoticeController',
    'property'   => 'PropertyController',
    'proposal'   => 'ProposalController',
    'request'    => 'RequestController',
]);
