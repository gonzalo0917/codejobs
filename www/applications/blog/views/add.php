<?php 
	/*
	if(!defined("_access")) {
		die("Error: You don't have permission to access here..."); 
	}

	$ID        = isset($data) ? recoverPOST("ID", $data[0]["ID_Post"]) 			 : 0;
	$ID_URL    = isset($data) ? recoverPOST("ID_URL", $data[0]["ID_URL"]) 		 : recoverPOST("ID_URL");
	$title     = isset($data) ? recoverPOST("title", $data[0]["Title"])   		 : recoverPOST("title");		
	$tags      = isset($data) ? recoverPOST("tags", $data[0]["Tags"])   		 : recoverPOST("tags");
	$content   = isset($data) ? $data[0]["Content"] 	 : recoverPOST("content");	
	$situation = isset($data) ? recoverPOST("situation", $data[0]["Situation"])  : recoverPOST("situation");				
	$language  = isset($data) ? recoverPOST("language", $data[0]["Language"])  	 : recoverPOST("language");
	$pwd   	   = isset($data) ? recoverPOST("pwd", $data[0]["Pwd"])				 : recoverPOST("pwd");
	$edit      = isset($data) ? TRUE											 : FALSE;
	$action	   = isset($data) ? "edit"											 : "save";
	$href 	   = isset($data) ? path(whichApplication() ."/cpanel/$action/$ID/") : path(whichApplication() ."/cpanel/add");
	
	echo div("add-form", "class");
		echo formOpen($href, "form-add", "form-add");
			echo p(__(ucfirst(whichApplication())), "resalt");
			
			echo isset($alert) ? $alert : NULL;

			echo formInput(array(	
				"name" 	=> "title", 
				"class" => "span10 required", 
				"field" => __("Title"), 
				"p" 	=> TRUE, 
				"value" => stripslashes($title)
			));

			echo formInput(array(	
				"name" 	=> "tags", 
				"class" => "span10 required", 
				"field" => __("Tags"), 
				"p" 	=> TRUE, 
				"value" => $tags
			));

			echo formTextarea(array(	 
				"name" 	 => "content", 
				"class"  => "markItUp",
				"field"  => __("Content"), 
				"p" 	 => TRUE, 
				"value"  => $content
			));

			echo formField(NULL, __("Language of the post") ."<br />". getLanguagesInput($language, "language", "select"));

			$options = array(
				0 => array("value" => 1, "option" => __("Yes"), "selected" => TRUE),
				1 => array("value" => 0, "option" => __("No"))
			);

			echo formSelect(array(
				"name" 	=> "enable_comments", 
				"class" => "required", 
				"p" 	=> TRUE, 
				"field" => __("Enable Comments")), 
				$options
			);				
			
			$options = array(
				0 => array("value" => "Active",   "option" => __("Active"), 	  "selected" => ($situation === "Active")   ? TRUE : FALSE),
				1 => array("value" => "Inactive", "option" => __("Inactive"),  "selected" => ($situation === "Inactive") ? TRUE : FALSE)
			);

			echo formSelect(array(
				"name" 	=> "situation", 
				"p" 	=> TRUE, 
				"class" => "required", 
				"field" => __("Situation")), 
				$options
			);
						
			if(!isset($pwd)) { 
				echo formInput(array(
					"name" 	=> "pwd", 
					"class" => "span10", 
					"field" => __("Password"), 
					"p" 	=> TRUE, 
					"value" => $pwd)
				);	
			} else { 
				echo formField(NULL, __("Password") ."<br />");
				
				echo formInput(array(
					"id" 	=> "lock", 
					"class" => "lock", 
					"type" 	=> "button")
				);

							
				echo formInput(array(
					"id" 	=> "password", 
					"type" 	=> "hidden", 
					"value" => $pwd
				));
			}
			
			echo formInput(array(
				"type" 	=> "file", 
				"name" 	=> "image", 
				"field" => __("Image for this post"), 
				"p" 	=> TRUE
			));

			if(isset($medium)) {
				echo img(path($medium, TRUE));
			}
			
			echo formInput(array(
				"type" 	=> "file", 
				"name" 	=> "mural", 
				"class" => "required", 
				"field" => __("Mural image") ." (". _muralSize .")", 
				"p" 	=> TRUE
			));
	
			if(isset($muralImage) and is_array($muralImage)) {
				echo formInput(array(
					"type" 	=> "hidden", 
					"name" 	=> "mural_exist", 
					"class" => "span10", 
					"field" => __("Current mural image"), 
					"p" 	=> TRUE)
				);
				
				echo img(path($muralImage[0]["Image"], TRUE), array("style" => "width: 98%; border: 1px solid #000;"));
                
                echo $this->js("var URL = '$muralDeleteURL';", TRUE);
 				
 				echo formInput(array(
					"type" 	=> "submit", 
					"id" 	=> "delete_mural", 
					"name" 	=> "delete_mural_image", 
					"value" => __("Delete Mural"), 
					"class" => "btn error", 
					"p" 	=> TRUE
				));
			}
			
			echo formSave($action, TRUE, $ID);
			
			echo formInput(array("name" => "ID", "type" => "hidden", "value" => $ID, "id" => "ID_Post"));
		echo formClose();
	echo div(FALSE);
 */
?>
<div class="add-form">
	
	<form id="form-add" action="http://www.codejobs.biz/es/blog/cpanel/add" method="post" class="form-add" enctype="multipart/form-data">
	<fieldset>
		

	
	<p class="resalt">
		
		Blog
	
	</p>

	<p>
							<span class="field">&raquo; Título</span><br />
							<input name="title" class="span10 required" value="" type="text" /> 

						</p>	<p>
							<span class="field">&raquo; Etiquetas</span><br />
							<input name="tags" class="span10 required" value="" type="text" /> 

						</p>	<p>
							<span class="field">&raquo; Contenido</span><br />
							<textarea name="content" class="markItUp"></textarea>
						</p><p class="field">
	&raquo; Idioma de la publicación<br /><select name="language" size="1"> <option value="Italian">Italiano</option> <option value="French">Francés</option> <option value="English">Inglés</option> <option value="Portuguese">Portugués</option> <option value="Spanish" selected="selected">Español</option></select>
</p>
	<p>
							<span class="field">&raquo; Comentarios Activos</span><br />
								<select name="enable_comments" class="required" size="1">
		<option value="1" selected="selected">Si</option>
		<option value="0">No</option>
	</select>

						</p>	<p>
							<span class="field">&raquo; Situación</span><br />
								<select name="situation" class="required" size="1">
		<option value="Active">Activo</option>
		<option value="Inactive">Inactivo</option>
	</select>

						</p>	<p>
							<span class="field">&raquo; Contraseña</span><br />
							<input name="pwd" class="span10" value="" type="text" /> 

						</p>	<p>
							<span class="field">&raquo; Imágen para la publicación</span><br />
							<input name="image" type="file" /> 

						</p>	<p>
							<span class="field">&raquo; Imágen de mural (960x300px)</span><br />
							<input name="mural" class="required" type="file" /> 

						</p>	
		<p class="save-cancel">
			<input id="save" name="save" value="Guardar" type="submit" class="btn btn-success">
			<input id="cancel" name="cancel" value="Cancelar" type="submit" class="btn btn-danger" />
		</p><input name="ID" value="0" id="ID_Post" type="hidden" /> 
	</fieldset>
</form></div>