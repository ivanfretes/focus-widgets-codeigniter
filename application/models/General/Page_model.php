<?

/**
 * @package GestionCMS
 * @subpackage Website/pages
 */
class Page_model extends CI_Model {


	/**
	 * Create a page
	 * 
	 * @param {string} $page_title
	 * @param {string} $page_subtitle
	 * @param {string} $page_description
	 * @param {string} $page_url
	 * @param {string} $page_portada
	 * @param {string} $date_modified Date()
	 */
	public function create_page($page_title,$page_subtitle,$page_description,
						   $page_url, $page_portada, $date_modified){

		if ('' !== $page_portada)
			$this->db->set('page_portada_url', $page_portada);

		$this->db->set('page_url', $page_url);
		$this->db->set('page_subtitle', $page_subtitle);
		$this->db->set('page_description', $page_description);
		$this->db->set('page_title', $page_title);
		$this->db->set('page_date_modified',  $date_modified);
	    $this->db->set('page_status', 1);

		if ($this->db->insert('pages')) return TRUE;
		return FALSE;
		
		//return $this->db->insert_id();
	    
	}	



	/**
	 * Count the number of pages
	 * @return {int} 
	 */
	public function count_pages(){
		$this->db->select('COUNT(1) AS cantPages');
		$query = $this->db->get('pages');

		return $query->row()->cantPages;    
	}

	/**
	 * Edit a page
	 * 
	 * @param {string} $page_title
	 * @param {string} $page_subtitle
	 * @param {string} $page_description
	 * @param {string} $page_url
	 * @param {string} $page_portada
	 * @param {string} $date_modified Date()
	 */
	public function edit_page($page_id, $page_title,$page_subtitle,
						 $page_description,$page_url, 
						 $page_portada, $date_modified){

		if ('' !== $page_portada)
			$this->db->set('page_portada_url', $page_portada);

		if ('' !== $page_url)
			$this->db->set('page_url', $page_url);

		$this->db->set('page_subtitle', $page_subtitle);
		$this->db->set('page_description', $page_description);
		$this->db->set('page_title', $page_title);
		$this->db->set('page_date_modified',  $date_modified);
	    $this->db->where('id_page', $page_id);
	    $this->db->set('page_status', 1);


		if ($this->db->update('pages')) return TRUE;
		else return FALSE;
	}	


	/**
	 * Remove Page
	 * 
	 * @param {number} $page_id
	 */

	public function remove_page($page_id){
		$this->db->where('id_page', $page_id);

		if ($this->db->delete('pages')) return TRUE;
		return FALSE;

	}

	/**
	 * Get the page by Id
	 * 
	 * @param {number} $page_id
	 * @return {object} 
	 */
	public function get_page_by_id($page_id){
		$this->db->where('id_page',$page_id);
		$query = $this->db->get('pages');

		return $query->row();
	}


	/**
	 * Get the all page 
	 * @return {object}
	 */
	public function get_pages($limit_start, $limit_end){
		
		$this->db->limit($limit_start, $limit_end);
		$query = $this->db->get('pages');

		return $query->result();	
	}

	/**
	 * Get the page by URL
	 * 
	 * @param {string} $param_url
	 * @return {object} 
	 */
	public function get_page_by_url($param_url){
		
		$this->db->where('page_url',trim($param_url));
		$query = $this->db->get('pages');

		return $query->row();
	}

	/**
	 * @param {number} $paramname description
	 */
	public function get_page_list($limit = ''){
		
		if ($limit !== '' && is_numeric($limit)){
			$this->db->limit($limit);	
		}
		$this->db->order_by('page_date_modified','desc');
		$query = $this->db->get('pages');
		return $query->result();
	}
	

}

?>