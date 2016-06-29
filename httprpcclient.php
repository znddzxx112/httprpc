<?php 


	/**
	* http rpc client
	*/
	class Httprpcclient
	{
		
		function __construct()
		{
			
		}

		public function run($url,$class,$func,$param=array())
		{
			$d = array(
					'class' => $class,
					'func'	=> $func,
					'param' => $param
				 );
			$ser_d = $this->_ser($d);
			$response = $this->_http_request($url,true,array('data'=>$ser_d));
			return $response;
		}

		private function _http_request($url, $is_post = false, $data = array())
		{
			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		    if ($is_post) {
		        curl_setopt($ch, CURLOPT_POST, TRUE);
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		    }
		    curl_setopt($ch, CURLOPT_AUTOREFERER, true);
		    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($ch, CURLOPT_URL, $url);
		    $ret = curl_exec($ch);
		    curl_close($ch);
		    return $ret;
		}

		/**
		 * 序列化参数
		 * @param  array  $data [description]
		 * @return [type]       [description]
		 */
		private function _ser($data=array())
		{
			return json_encode($data,JSON_UNESCAPED_UNICODE);
		}
	}
