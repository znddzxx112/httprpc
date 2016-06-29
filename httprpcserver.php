<?php 

	/**
	* http rpc 
	*/
	class Httprpcserver
	{
		private $class="";#类名
		private $func="";#函数名
		private $param=array();#参数

		function __construct()
		{

		}

		public function proc()
		{
			$conf = $_POST['data'];
			if($conf != "" && is_string($conf))
			{
				$data = $this->_unser($conf);
				$this->_resolve($data);
			}

			#调用class func
			$tmp_data = array();
			try
			{
				$instance = new $this->class;
				$tmp_data = call_user_func_array(array($instance,$this->func), $this->param);
			}
			catch(Exception $e)
			{
				$tmp_data = $e->getMessage();
			}
			echo json_encode($tmp_data,JSON_UNESCAPED_UNICODE);
		}

		/**
		 * 参数解析
		 * @param  array  $data [description]
		 * @return [type]       [description]
		 */
		public function _resolve($data=array())
		{
			if(!empty($data))
			{
				foreach ($data as $k => $v) {
					$this->$k = $v;
				}
			}
		}

		/**
		 * 逆序列化
		 * @return [type] [description]
		 */
		private function _unser($str)
		{
			return json_decode($str,true);
		}
	}


	/**
	* rpc 被调用函数
	*/
	class Product
	{
		
		function __construct()
		{
			
		}

		public function buy($param=array())
		{
			return $param;
		}
	}

