<?php

	class cwpRenderView {
		public $data = array();
		private $css = array();
		private $js = array();
		public   $tabs = array();
		public $options = array();
		public function __construct(){
		
			$css_path = cwp_config("admin_template_directory_uri")."/css/";
			$js_path = cwp_config("admin_template_directory_uri")."/js/"; 
			$this->add_css("main_page_css",$css_path."main_page.css"); 
			$this->add_js("main_page_js",$js_path."admin.js");
			$this->add_js("typsy",$js_path."tipsy.js");
			$this->add_js("jquery" );
			$this->add_js("media" );
			 
			$this->options =  get_option(cwp_config("menu_slug"));
			$this->add_js('wp-color-picker' );
			$this->add_css('wp-color-picker' );
			
			
		}
		
		public function add_element($tabid,$field ){
  
			 
								switch($field['type']){
									case 'input_text': 
										 
										$this->add_input_text($tabid,esc_html($field['name']),esc_html($field["description"]),esc_attr($field['id']));
			
									break;
									case 'input_number': 
										 
										$this->add_input_number($tabid,esc_html($field['name']),esc_html($field["description"]),esc_attr($field['id']));
			
									break;
									case 'textarea': 
										 
										$this->add_textarea($tabid,esc_html($field['name']),esc_html($field["description"]),esc_attr($field['id']));
			
									break;
									case 'editor': 
										 
										$this->add_editor($tabid,esc_html($field['name']),esc_html($field["description"]),esc_attr($field['id']));
			
									break;
									case 'color': 
										 
										$this->add_color($tabid,esc_html($field['name']),esc_html($field["description"]),esc_attr($field['id']));
			
									break;
									case 'image': 
										 
										$this->add_image($tabid,esc_html($field['name']),esc_html($field["description"]),esc_attr($field['id']));
			
									break;
									case 'typography': 
										   
										
										$this->add_typography($tabid,esc_html($field['name']),esc_html($field["description"]),esc_attr($field['id']));
									break;
									case 'background': 
										  
										
										$this->add_background($tabid,esc_html($field['name']),esc_html($field["description"]),esc_attr($field['id']));
									break; 
									case 'select':
										 
										$no = array();
										foreach($field['options'] as $ov=>$op){
											$no[esc_attr($ov)] = esc_html($op);
										} 	
										$this->add_select($tabid,esc_html($field['name']),esc_html($field['description']),esc_attr($field['id']),$no);
									break;
									case 'radio':
										 
										$no = array();
										foreach($field['options'] as $ov=>$op){
											$no[esc_attr($ov)] = esc_html($op);
										} 		
									$this->add_radio($tabid,esc_html($field['name']),esc_html($field['description']),esc_attr($field['id']),$no);
									break;
									case 'multiselect':
										  
										$no = array();
										foreach($field['options'] as $ov=>$op){
											$no[esc_attr($ov)] = esc_html($op);
										}  
										
										$this->add_multiselect($tabid,esc_html($field['name']),esc_html($field['description']),esc_attr($field['id']),$no);
									break;
									case 'checkbox':
										  
										$no = array();
										foreach($field['options'] as $ov=>$op){
											$no[esc_attr($ov)] = esc_html($op);
										} 
										 
										$this->add_checkbox($tabid,esc_html($field['name']),esc_html($field['description']),esc_attr($field['id']),$no);
									break;
									case 'title':
										$this->add_title($tabid,esc_html($field['name']));
									break; 
									
									
								}
					return $errors;
		}
		public  function show(){ 
			$structure = cwpConfig::$structure;
			$errors  = cwp_check_config();
			if(!empty($errors)) return false;
			foreach($structure as $k=>$fields){
					 
					if($fields['type'] == 'tab'){
						$tname = esc_html($fields['name']);
						$tabid = $this->add_tab($tname);
						 
						
						foreach ($fields['options'] as $r=>$field){ 
  
								if($field['type'] == 'group'){
 
									$this->start_group($tabid,esc_html($field['name']));
									foreach($field['options'] as $m=>$gfield){
 
										$this->add_element($tabid,$gfield ) ;
									}
									
									$this->end_group($tabid); 
								}else{
									 $this->add_element($tabid,$field) ;
								}
								
							} 
						
						}
						 
			}    
			$this->render_view('main_page');
			 
		}
		public function add_css($name,$location =''){
			if($location!='')
				wp_register_style($name, $location, array(), "201306" ); 
			$this->css[] = $name;
		} 
		public function add_js($name,$location = '',$deps = array()){
			
			if($location!='')
				wp_register_script($name, $location, $deps, "201306", true ); 
			$this->js[] = $name;
			
		}
		
		public function render_view($name){
			$this->data["tabs"] = $this->tabs;
			foreach($this->data as $k=>$v){
				$$k = $v;
			}
			foreach($this->css as $file){
				 wp_enqueue_style($file);
			}
			foreach($this->js as $file){
				if($file == "media"){
					
						wp_enqueue_media(); 
				}
				 wp_enqueue_script($file) ;
			}
			include(locate_template("admin/layout/".$name.".php")); 
		} 
		public function add_tab($name){
			$id = strtolower(preg_replace("/[^a-zA-Z0-9]|\s/", "_",$name)); 
			$this->tabs[] = 
				array(
					"name"=>$name,
					"id" =>$id,
					"elements"=>array()
					);
					
			return count($this->tabs) - 1;
		}
		public function add_input_text($tabid,$name,$description,$id,$class=''){   
			$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p> <input class="cwp_input " placeholder="'.$name.'" name="'.cwp_config("menu_slug").'['.$id.']" type="text" value="'.$this->options[$id].'"></div>';
			
			$this->tabs[$tabid]["elements"][] = array("type"=>"input_text",
				"html"=>$html
			);
			
		}
		public function get_fonts(){
			return array(
						'arial'     => 'Arial',
						'verdana'   => 'Verdana, Geneva',
						'trebuchet' => 'Trebuchet',
						'georgia'   => 'Georgia',
						'times'     => 'Times New Roman',
						'tahoma'    => 'Tahoma, Geneva',
						'palatino'  => 'Palatino',
						'helvetica' => 'Helvetica*'
					);
		}
		public function get_font_styles(){
				return array(
							'normal'      => __( 'Normal', 'cwp' ),
							'italic'      => __( 'Italic', 'cwp' ),
							'bold'        => __( 'Bold', 'cwp' ),
							'bold italic' => __( 'Bold Italic', 'cwp' )
							);
		}
		public function get_font_sizes(){
			$sizes = range( 9, 71 ); 
			$sizes = array_map( 'absint', $sizes );
			return $sizes;
		}
		public function add_typography($tabid,$name,$description,$id,$class=''){  
			$fonts = $this->get_fonts();
			$style = $this->get_font_styles();
			$sizes = $this->get_font_sizes();
			$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p> <div class="cwp_typo"> 
			 
					 <input type="hidden" id="'.$id.'_color" name="'.cwp_config("menu_slug").'['.$id.'][color]" value="'.$this->options[$id]['color'].'"/> 
				<input type="text" name=""	class="subo-color-picker" id="'.$id.'_color_selector" value="'.$this->options[$id]['color'].'" />	
					 
						<select class="cwp_select cwp_tipsy" original-title="Font family" name="'.cwp_config("menu_slug").'['.$id.'][font]" > ';
					foreach($fonts as $k=>$v){
						
						$html.="<option value='".$k."' ".($this->options[$id]['font'] == $k ? 'selected' : '').">".$v."</option>";
					}
				
					$html .='</select>
						<select class="cwp_select cwp_tipsy" original-title="Font style"  name="'.cwp_config("menu_slug").'['.$id.'][style]" > ';
					foreach($style as $k=>$v){
						
						$html.="<option value='".$k."' ".($this->options[$id]['style'] == $k ? 'selected' : '').">".$v."</option>";
					}
				
					$html .='</select>
						<select class="cwp_select cwp_tipsy" original-title="Font size" " name="'.cwp_config("menu_slug").'['.$id.'][size]" > ';
					foreach($sizes as $v){
						 
						$html.="<option value='".$v."' ".($this->options[$id]['size'] == $v ? 'selected' : '').">".$v."px</option>";
					}
				
					$html .='</select>
					 
				</div></div>';
			
			$this->tabs[$tabid]["elements"][] = array("type"=>"typography",
				"html"=>$html
			);
			
		}
		
		public function get_bg_repeat(){
		
			return array(
					'no-repeat' => __('No Repeat', 'cwp'),
					'repeat-x'  => __('Repeat Horizontally', 'cwp'),
					'repeat-y'  => __('Repeat Vertically', 'cwp'),
					'repeat'    => __('Repeat All', 'cwp'),
					);
		}
		public function get_bg_position(){
			return array(
						'top left'      => __('Top Left', 'cwp'),
						'top center'    => __('Top Center', 'cwp'),
						'top right'     => __('Top Right', 'cwp'),
						'center left'   => __('Middle Left', 'cwp'),
						'center center' => __('Middle Center', 'cwp'),
						'center right'  => __('Middle Right', 'cwp'),
						'bottom left'   => __('Bottom Left', 'cwp'),
						'bottom center' => __('Bottom Center', 'cwp'),
						'bottom right'  => __('Bottom Right', 'cwp')
						);
		}
		public function get_bg_attachment(){
			return array(
					'scroll' => __('Scroll Normally', 'optionsframework'),
					'fixed'  => __('Fixed in Place', 'optionsframework')
					);
		
		}
		public function add_background($tabid,$name,$description,$id,$class=''){  
			$repeats = $this->get_bg_repeat();
			$positions = $this->get_bg_position();
			$attachments = $this->get_bg_attachment(); 
			$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p><div class="cwp_background">
					<div class="cwp_bgstyle">
						<div class="cwp_bgimage">
						<input type="hidden" id="'.$id.'" name="'.cwp_config("menu_slug").'['.$id.'][bgimage]" value="'.$this->options[$id]['bgimage'].'"/>
				<img src="'.$this->options[$id]['bgimage'].'" id="'.$id.'_image" class="image-preview-input"/><br/>
				<a id="'.$id.'_button" class="selector-image button"  >Select Image</a>
						
				<a id="'.$id.'_buttonclear" class="clear-image button"  >Clear image</a>		
						</div>
						<div class="cwp_bgcolor">
						<input type="hidden" id="'.$id.'_color" name="'.cwp_config("menu_slug").'['.$id.'][bgcolor]" value="'.$this->options[$id]['bgcolor'].'"/> <br/>
				<input type="text" name=""	class="subo-color-picker" id="'.$id.'_color_selector" value="'.$this->options[$id]['bgcolor'].'" />	
						</div><div class="clear"></div>
					</div>
					<div class="cwp_bgformat">
						
						<select class="cwp_select cwp_tipsy" original-title="Background repeat"  name="'.cwp_config("menu_slug").'['.$id.'][bgrepeat]" > ';
					foreach($repeats as $k=>$v){
						
						$html.="<option value='".$k."' ".($this->options[$id]['bgrepeat'] == $k ? 'selected' : '').">".$v."</option>";
					}
				
					$html .='</select>
						<select class="cwp_select cwp_tipsy" original-title="Background position"  name="'.cwp_config("menu_slug").'['.$id.'][bgposition]" > ';
					foreach($positions as $k=>$v){
						
						$html.="<option value='".$k."' ".($this->options[$id]['bgposition'] == $k ? 'selected' : '').">".$v."</option>";
					}
				
					$html .='</select>
						<select class="cwp_select cwp_tipsy" original-title="Background attachament"  name="'.cwp_config("menu_slug").'['.$id.'][bgattachment]" > ';
					foreach($attachments as $k=>$v){
						
						$html.="<option value='".$k."' ".($this->options[$id]['bgattachment'] == $k ? 'selected' : '').">".$v."</option>";
					}
				
					$html .='</select>
					</div>
				
				</div>
					
				
				</div>';
			
			$this->tabs[$tabid]["elements"][] = array("type"=>"textarea",
				"html"=>$html
			);
			
		}
		public function add_textarea($tabid,$name,$description,$id,$class=''){  
 
			$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p> <textarea class="cwp_textarea " placeholder="'.$name.'" name="'.cwp_config("menu_slug").'['.$id.']"    >'.$this->options[$id].'</textarea></div>';
			
			$this->tabs[$tabid]["elements"][] = array("type"=>"textarea",
				"html"=>$html
			);
			
		}
		public function add_editor($tabid,$name,$description,$id,$class=''){  
			ob_start();
 
			wp_editor($this->options[$id], cwp_config("menu_slug").'['.$id.']'); 
			
			$editor_contents = ob_get_clean();
			
			$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p>'.$editor_contents.'</div>';
			
			$this->tabs[$tabid]["elements"][] = array("type"=>"editor",
				"html"=>$html
			);
			
		}
		public function add_input_number($tabid,$name, $description, $id, $min = false, $max = false, $step = false, $class = ""){ 
			$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p>  <input placeholder="'.$name.'" type="number"  class="cwp_input" value="'.$this->options[$id].'" name="'.cwp_config("menu_slug").'['.$id.']"  
					'.($min === false ? '' : ' min = "'.$min.'" ').'
					'.($max === false ? '' : ' max = "'.$max.'" ').'
					'.($step === false ? '' : ' step = "'.$step.'" ').'
				> </div>';
			
			$this->tabs[$tabid]["elements"][] = array("type"=>"input_number",
				"html"=>$html
			);
			
		}
		
		public function add_select($tabid,$name,$description,$id,$options,$class=""){
	 
				$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p>   <select class=" cwp_select" name="'.cwp_config("menu_slug").'['.$id.']" > ';
					foreach($options as $k=>$v){
						
						$html.="<option value='".$k."' ".($this->options[$id] == $k ? 'selected' : '').">".$v."</option>";
					}
				
				$html .='</select></div>';
				$this->tabs[$tabid]["elements"][] = array("type"=>"select",
															"html"=>$html 
										);
		}
		public function add_multiselect($tabid,$name,$description,$id,$options,$class=""){
	 
				$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p>   <select   name="'.cwp_config("menu_slug").'['.$id.'][]" class="cwp_multiselect" multiple > ';
					foreach($options as $k=>$v){
						
						$html.="<option value='".$k."' ".(in_array($k,$this->options[$id]) ? 'selected' : '').">".$v."</option>";
					}
				
				$html .='</select></div>';
				$this->tabs[$tabid]["elements"][] = array("type"=>"multiselect",
															"html"=>$html 
										);
		}
		public function add_checkbox($tabid,$name,$description,$id,$options,$class=""){
	 
				$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p>  ';
					foreach($options as $k=>$v){
						
						$html.="<label class='cwp_label'><input class='cwp_checkbox' type=\"checkbox\" name='".cwp_config("menu_slug")."[".$id."][]' value='".$k."' ".(in_array($k,$this->options[$id]) ? 'checked' : '')." >".$v."</label>";
					}
				
				$html .='</div>';
				$this->tabs[$tabid]["elements"][] = array("type"=>"checkbox",
															"html"=>$html 
										);
		}
		public function add_radio($tabid,$name,$description,$id,$options,$class=""){
	 
				$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p>  ';
					foreach($options as $k=>$v){
						
						$html.="<label class='cwp_label'><input class='cwp_radio' type=\"radio\" name='".cwp_config("menu_slug")."[".$id."]' value='".$k."' ".($this->options[$id] == $k ? 'checked' : '').">".$v."</label>";
					}
				
				$html .='</div>';
				$this->tabs[$tabid]["elements"][] = array("type"=>"radio",
															"html"=>$html 
										);
		}
		
		
		
		public function add_image($tabid,$name,$description,$id,$class = ''){
		$html = '
				<div class="controls '.$class.'">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p>  
				<input type="hidden" id="'.$id.'" name="'.cwp_config("menu_slug").'['.$id.']" value="'.$this->options[$id].'"/>
				<img src="'.$this->options[$id].'" id="'.$id.'_image" class="image-preview-input"/><br/>
				<a id="'.$id.'_button" class="selector-image button"  >Select Image</a>
				<a id="'.$id.'_buttonclear" class="clear-image button"  >Clear image</a>
										
									</div>';
		 
		 
				$this->tabs[$tabid]["elements"][] = array("type"=>"image",
															"html"=>$html 
										);
		}
		public function add_color($tabid,$name,$description,$id,$class =  ''){
		 

		$html = '
				<div class="controls '.$class.' ">
				<div class="explain">'.$name.'</div><p class="field_description">'.$description.'</p>  
				<input type="hidden" id="'.$id.'_color" name="'.cwp_config("menu_slug").'['.$id.']" value="'.$this->options[$id].'"/> </br> 
				<input type="text" name=""	class="subo-color-picker" id="'.$id.'_color_selector" value="'.$this->options[$id].'" />				<br/>	
									</div>';
		 
		 
				$this->tabs[$tabid]["elements"][] = array(	"type"=>"color",
															"html"=>$html 
										);
		} 
		public function add_title($tabid,$name){
				$html = '<h1 class="tab-title-area">'.$name.'</h1>';
				$this->tabs[$tabid]["elements"][] = array(
						"type"=>"title",
						"html"=>$html
				);
				 
		}
		
		public function start_group($tabid, $name){
				$html = '<div class="group-in-tab">
						<p class="group-name">'.$name.'</p>
						<div class="group-content">
				';
				$this->tabs[$tabid]["elements"][] = array(
						"type"=>"group_start",
						"html"=>$html
				);
		}
		public function end_group($tabid){
				$html = '</div></div>
				';
				$this->tabs[$tabid]["elements"][] = array(
						"type"=>"end",
						"html"=>$html
				);
		}
	}