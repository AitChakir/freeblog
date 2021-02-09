<?php 
namespace App\Model;
use \PDO;
class Post {
	protected $conn;
	public function __construct(PDO $conn)
	{
		$this->conn = $conn;
	}


	public function all()
	{
		$result = [];

		$stm = $this->conn->query('select * from posts');
		if ($stm) {
			$result = $stm->fetchAll(PDO::FETCH_OBJ);
		}

		return $result;
	}

	public function find($postId)
	{
		$postId = (int)$postId;
		$result = [];
		$sql = "select * from posts where id = $postId";
		$stm = $this->conn->prepare($sql);
		$stm->execute(['id'=>$postId]);
		if ($stm) {
			$result = $stm->fetch(PDO::FETCH_OBJ);
		}

		return $result;
	}

	public function save($data = [])
	{
		
		$sql = "insert into posts (title, message, email, datecreated) ";
		$sql .= "values(:title, :message, :email, :datecreated)";

		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'title' => $data['title'],
			'message' => $data['message'],
			'email' => $data['email'],
			'datecreated' => date('Y-m-d H:i:s')
		]);
		return $stm->rowCount();
	}

	public function store(array $data = [])
	{
		//var_dump($data['id']);die();
		$sql = "update posts  set title = :title, message = :message , email = :email where id = :id";

		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'id' =>  $data['id'],
			'title' => $data['title'],
			'message' => $data['message'],
			'email' => $data['email']
		]);
		return $stm->rowCount();
	}

	public function delete($id)
	{
		//var_dump($id);die();
		$sql = "delete from posts where id = :id";

		$stm = $this->conn->prepare($sql);
		$stm->execute(['id'=> $id ]);
		return $stm->rowCount();
	}
}