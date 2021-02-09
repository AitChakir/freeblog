<?php
use App\Controllers;
class Rotte {
	protected $conn;
	protected $routers = [
		'GET' => [],
		'POST' => []
	];
	public function __construct(\PDO $conn) {
        $this->conn = $conn;
    }
	 

	public function loadRouters(array $routers)
	{
		$this->routers = $routers;
	}

	public function getRouters()
	{
		return $this->routers;
	}
	//array_key_exists(key, array)
	public function dispatch()
	{
		$queryStringUrl = $_SERVER['REQUEST_URI'];
		$url = parse_url($queryStringUrl, PHP_URL_PATH);
		$url = trim($url, '/');
		$method = $_SERVER['REQUEST_METHOD'];
							 // GET
		if (array_key_exists($method, $this->routers) && array_key_exists($url, $this->routers[$method])) {
			return $this->route($this->routers[$method][$url]);
			//echo $this->routers[$method][$url];
		}else{
			return $this->processQueue($url, $method);
			
		}
	}

	protected function processQueue($uri, $method = 'GET')
	{
        $routes = $this->routers[$method];

        foreach ($routes as $route => $callback) {
            // converte url come '/post/:id' in regular expression
            $regMatch = preg_quote($route);
			//echo $regMatch."\n";die();
            // :id([a-zA-Z0-9\-\_]+)

            // post/([a-zA-Z0-9\-\_]+)
           // $subPattern = preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)',  $regMatch);
           $subPattern = preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)',  $regMatch);

            $pattern = "@^" . $subPattern. "$@D";
			//var_dump($pattern);
             // post/4
            // @^post/([a-zA-Z0-9\-\_]+)$@;
            $matches = [];

            // $uri =  post/2
            // $pattern = @^post/([a-zA-Z0-9\-\_]+)$@
            //  $matches = 2
            if (preg_match($pattern, $uri, $matches)) {
                // rimuove la prima parte trovata
                // /post/2
                // 2
                array_shift($matches);
                 return $this->route($callback, $matches);

            }
        }
       	throw new Exception('No matchin routes found for ' . $uri);
    }

    protected function route($callback, array $matches =[])
    {
    	//var_dump($callback); die();
         try {

             if(is_callable($callback)){
               return   call_user_func_array($callback, $matches);
             }

         $tokens = explode('@',$callback);
         //var_dump($tokens); die();
         $controller = $tokens[0];

         $method = $tokens[1];

           $class =  new $controller($this->conn);
           //method_exists(object, method_name)
            if(method_exists($controller, $method)){

              call_user_func_array([$class, $method], $matches);
              return $class;

            } else {
                throw new Exception('Method '.$method.' not found in class '. $controller);
            }
         // $controller = new $class;
         } catch (Exception $e){
             die($e->getMessage());
         }
     }



}

//post/4 -- post/djhsjdhs
/*public function dispatch()
	{
		$queryStringUrl = $_SERVER['REQUEST_URI'];
		$url = parse_url($queryStringUrl, PHP_URL_PATH);
		$url = trim($url, '/');

		$tokens = explode('/', $url);
		$action = $tokens[0];
		$action2 =isset($tokens[1])? $tokens[1] : '';
		switch ($action) {
			case 'posts':
			case '':
			case 'getPosts':

				$this->content = $this-> getPosts();
			break;
			case 'post':
				if ($_SERVER['REQUEST_METHOD'] === 'GET') {
					if($action2){
						if(is_numeric($action2)){
							$this->content = $this->show($action2);
						}else{
							if (method_exists($this, $action2)) {
								$this->content = $this->{$action2}();
							}else{
								$this->content = "Method is not found";
							}
						}
					}else{
						$this->content = "Metodo non trovato";
					}
				}else{
					if ($_SERVER['REQUEST_METHOD'] === 'POST') {
						if($action2){
							if(is_numeric($action2)){
								$this->content = $this->update($action2);
							}else{
								if (method_exists($this, $action2)) {
									$this->content = $this->{$action2}();
								}else{
									$this->content = "Method is not found";
								}
							}
						}else{
							$this->content = "Metodo non trovato";
						}
					}
				break;
			}
		}	
	}*/