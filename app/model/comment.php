<?php 
namespace App\Model;
use \PDO;
class Comment {
	protected $conn;
	public function __construct(PDO $conn)
	{
		$this->conn = $conn;
	}


   public function all(int $postid)
    {
        $result = [];
         $sql ='select * from postscomments where post_id=:postid ORDER BY datecreated DESC';
          
         $stm = $this->conn->prepare($sql);
       
          $stm->bindParam(':postid', $postid, PDO::PARAM_INT);
      
      	$stm->execute();
      	return $stm->fetchAll();
          	
    }

	public function saveComment($data = [])
	{
		//var_dump($data); die();
		$sql = "insert into postsComments (text, datecreated, post_id) values(:text, :datecreated, :post_id)";

		$stm = $this->conn->prepare($sql);
		$stm->execute([
			'post_id' => $data['postid'],
			'text' => $data['message'],
			'datecreated' => date('Y-m-d H:i:s')
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