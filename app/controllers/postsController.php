<?php 
namespace App\Controllers;
use \PDO;

use \App\Model\Post;
use \App\Model\Comment;
class PostsController {
	public $content;
	protected $conn;
	protected $Post;
	protected $layout = 'layout/index.tpl.php';
	
	function __construct(\PDO $conn)
	{
		$this->conn= $conn;	
		$this->Post =  new Post($conn);
	}

	public function display()
	{
		require $this->layout;
	}

	public function getPosts()
	{
		$posts = $this->Post->all();
		$this->content = view('posts', compact('posts'));
	}

	public function show($postId)
	{
		$post = $this->Post->find($postId);
		$comment = new Comment($this->conn);
        $comments =  $comment->all($postId);
        //var_dump($comments);die();
		$this->content = view('post', compact('post', 'comments'));
	}

	public function update($postId)
	{
		$post = $this->Post->find($postId);
		$this->content = view('editPost', compact('post'));
	}

	public function create()
	{
		$this->content = view('newPost');
	}

	public function save()
	{
		$this->Post->save($_POST);
		redirect('/');
	}

	public function store(string $id)
	{
		$_POST['id'] = $id;
		$this->Post->store($_POST);
		redirect('/');
	}

	public function delete(string $id)
	{
		$this->Post->delete($id);
		redirect('/');
	}

	public function saveComment(int $postid)
	{	
		
		$comment = new Comment($this->conn);
		$_POST['postid'] = (int)$postid;
		$comment->saveComment($_POST);
		//var_dump($comment);die();
		redirect('/post/'.$postid);
	}
}


