<?php

class Pills extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

		$this->load->model('map');
	}

	public function index()
	{

		$this->_program();

		if( is_file('cache/table'))
			
			$table = file_get_contents( 'cache/table');

		else 

			$table = 'posts';


		$rule = $this->map->get_file_ergodic( FCPATH . 'cache/rule');

		$source = $this->map->get_file_ergodic( FCPATH . 'cache/source');

		$data = $this->map->get_struct( $table);

		$this->template->build('pills/index' , array( 'data' => $data ,
													  'rule' => $rule , 
													  'source'=>$source ,
													)
							  );
	}

	public function view( $source)
	{
		$source = trim( $source);

		$s = json_decode( file_get_contents( 'cache/source/'.$source) , true );

		$r = json_decode( file_get_contents( 'cache/rule/'.$s['rule']) , true );

		$this->map->copy_links( $r , $s);

		$this->template->build('pills/view');
	}


	private function _program()
	{
		if( $this->input->post('posts'))
		{
			$table = trim( $this->input->post('table_name'));
			file_put_contents('cache/table', $table);
		}

		if( $this->input->post('set_rule'))
		{

			$rule_name = trim( $this->input->post('rulename'));

			unset( $_POST['rulename']);
			unset( $_POST['set_rule']);

			$this->map->save_rule( $rule_name);
		}

		if( $this->input->post('set_source'))
		{
			$source = trim( $this->input->post('source'));

			unset( $_POST['source']);
			unset( $_POST['set_source']);

			$this->map->save_source( $source);
		}
	} 
}