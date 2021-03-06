<?php
	
	namespace Hcode;

	use Rain\Tpl;

	class Page
	{

		private $tpl;
		private $options=[];
		private $defaults = [
			'data' => []
		];

		public function __construct($opts = array(), $tpl_dir = "/views/")
		{

			$this->options = array_merge($this->defaults, $opts);

			$config = array(
					"tpl_dir"       => $_SERVER['DOCUMENT_ROOT'].$tpl_dir,
					"cache_dir"     => $_SERVER['DOCUMENT_ROOT']."/views-cache/",
					"debug"         => false // set to false to improve the speed
			);

			Tpl::configure( $config );

			$this->tpl = new Tpl();

			$this->setdata($this->options);

			$this->tpl->draw('head', false);


		}

		public function __destruct()
		{

			$this->tpl->draw('footer', false);

		}

		private function setData($data = array())
		{

			foreach($data as $key => $val){
				$this->tpl->assign($key, $val);
			}

		}

		public function setTpl($tplName, $data = array(), $returnHTML = false)
		{

			$this->setData($data);

			return $this->tpl->draw($tplName, $returnHTML);

		}

	}	

?>