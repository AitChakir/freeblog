<?php

return [
	'ruoters' => 
	[
		'GET' => 
		[
			'' 							=> 'App\Controllers\PostsController@getPosts',
			'posts' 					=> 'App\Controllers\PostsController@getPosts',
			'post/create' 				=> 'App\Controllers\PostsController@create',
			'post/:id' 					=> 'App\Controllers\PostsController@show',
			'post/:postId/update' 		=> 'App\Controllers\PostsController@update',
			'experement/freeblog/public'=> 'App\Controllers\PostsController@getPosts',
		],

		'POST' => 
		[
			'post/save' 				=> 'App\Controllers\PostsController@save',
			'post/:postId/store' 		=> 'App\Controllers\PostsController@store',
			'post/:postId/delete' 		=> 'App\Controllers\PostsController@delete',
			'post/:id/comment' 			=>  'App\Controllers\PostsController@saveComment',
		],
	],
];	