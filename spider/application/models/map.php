<?php
set_time_limit(0);
require_once 'vendor/phpquery/phpquery.php';

class Map extends CI_Model
{
	public function get_struct( $table )
	{
		return $this->db->limit(1)->get( $table )->row_array();
	}

	public function save_rule( $rule_name)
	{

		$list = array();
		$constant = array();

		foreach ($_POST as $key => $value) {

			if( !trim( $value))

				continue;

			if( preg_match('/(^[%])|(^\d$)/', $value))
			{
				$value = preg_replace('/^[%]/', '', $value);

				$constant[$key] = trim( $value);
			}

			else
			{
				$list [$key] = trim( $value);
			}

		}

		file_put_contents( 'cache/rule/'.$rule_name , json_encode( array( 'tag'=>$list , 'constant'=>$constant )));
		
		redirect( site_url('pills/index'));
	}

	public function save_source( $source)
	{

		$links = explode('@', $this->input->post('link'));

		$data = array('rule'=>$this->input->post('rule') , 
					  'link_rule' => $this->input->post('links') , 
					  'links' => $links , 
					  'split' => trim( $this->input->post('split')) , 
					  'unique' => trim( $this->input->post('unique')) , 
					  );

		file_put_contents( 'cache/source/'.$source , json_encode( $data));

		redirect( site_url('pills/index'));
	}

	public function copy_links( $rule , $info , $view_mode = FALSE)
	{

		var_dump( $rule);
		
		var_dump( $info);
		
		//echo $info['links'][0];

		preg_match('/^http:\/\/[a-zA-Z0-9\._-]+/', $info['links'][0] , $match);

		$table = file_get_contents( 'cache/table');

		$handle = @fopen("cache/list", "r");

		if ($handle) {

 	   		while (!feof($handle)) {

        		$buffer = fgets($handle, 4096);

        		$links[] = $buffer;

    		}
    	
    		fclose($handle);
		}

		foreach ( $links as $link) {

			$link = trim( $link);

			$html = file_get_contents( $link);

			phpQuery::newDocumentHTML( $html , 'utf-8');

			$news_list = pq( $info['link_rule']);

			$links = array();

			foreach ($news_list as $news) {

				$z = pq( $news);

				$t = $z->attr('href');

				if( preg_match('/^http:\/\//', $t))
					$links[] = $t;
				else
					$links[] = $match[0] . $t;
			}

			foreach ($links as $url) {

				$html = file_get_contents( $url);

				phpQuery::newDocumentHTML( $html , 'utf-8');

				foreach ($rule['tag'] as $key => $value) {
				
					$z = pq( $value);

					if( $info['split'])
					
						$x = preg_split('/'.$info['split'].'/', $z->html()) ;
				
					else

						$x = $z->html();

					$rule['constant'][$key] = trim( $x[0]);

					if( $view_mode)

						return $rule['constant'];

			 		$rule['constant']['post_date'] = date('Y-m-d h:i:s');

					if( $this->is_post_exist( $rule['constant'][$info['unique']] , $info['unique']) === 0)
					{
				
						echo 'insert';
						$this->db->insert( $table , $rule['constant']);
					}
				}
			}
		}
	}


	public function is_post_exist( $title , $unique)
	{
		$table = file_get_contents( 'cache/table');

		return $this->db->like( array( $unique => $title))
				 ->from( $table)
				 ->get()
				 ->num_rows();
	}

	public function get_file_ergodic( $path)
	{
		if( !is_dir( $path))
			return false;

		$f = opendir( $path);

		$result = array();

		while( $file = readdir( $f))
		{
			if( preg_match('/^\.|\.\.$/', $file))
				continue;
			$result[] = $file;
		}

		return $result;
	}
}