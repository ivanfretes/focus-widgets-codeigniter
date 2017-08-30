<?

/**
 * Lista el nombre de las etiquetas, de los archivos enviados
 * @param {string} $file_list : Listado de archivos subidos
 * 
 * @return {array} 
 */
if (! function_exists('file_tag_list')){

	function file_tag_list($file_list){
		return array_keys($file_list);
	}

}


	

/**
 * Sube un archivo
 * Retorna todos los datos del archivo subido
 * 
 * @param {string} $file_tag_name : $_REQUEST[field_tab_name]
 * @param {array} $custom_config : configuraciones personalizadas
 * 
 * @return {array} : datos del archivo 
 */
if (! function_exists('upload_file')){
	function upload_file($file_tag_name,$custom_config = array()){

		$ci = & get_instance();
		
		// Configuraciones por defecto
		$config['upload_path']	=  './uploads/images/raw/';
  		$config['allowed_types'] = 'gif|jpg|png';
  		$config['remove_spaces'] = TRUE;
  		$config['file_permissions'] = '0777';
  		$config['max_size'] = 10240; // 10 MB

        // Agrega o remplazamos configuraciones 
		if (0 < count($custom_config)){
			foreach ($custom_config as $key => $value) {
				$config[$key] = $value;
			}	
		}

		// Subimos el archivo en caso que no existan inc
		$ci->upload->initialize($config);
		if (!$ci->upload->do_upload(trim($file_tag_name)))
	        return NULL;
		
		// Datos del archivo
		$file_data = $ci->upload->data();
		
		return $file_data;

	}
}


/**
 * Verificar funcion
 * Redimensiona una imagen en base al width
 * de forma proporcional
 * @param {string} $string_value : Texto pajar, donde buscar 
 * @param {array} $extension_list : conjunto de extensiones a buscar
 * @return {array} or NULL
 */
if (! function_exists('remove_extension_files')){ 
	
	function remove_extension_files($string_value, $extension_list = array()){
		foreach ($extension_list as $extension) {
			$array_result = [];

			$a = explode($extension, $string_value);

			if (1 < count($a)){
				return array( $a[0] , $extension);

			}
			else 
				continue;
		}

		return NULL;
	}	
}




?>