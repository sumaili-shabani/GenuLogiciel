<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  
class admin extends CI_Controller
{
		private $token;
		private $connected;
		protected $email_sites;
		public function __construct()
		{
		  parent::__construct();
		  if(!$this->session->userdata('admin_login'))
		  {
		      	redirect(base_url().'login');
		  }

		  $this->load->library('Ciqrcode');
    	  $this->load->library('Zend');


		  $this->load->library('form_validation');
		  $this->load->library('encryption');
	      $this->load->library('pdf');
		  $this->load->model('crud_model'); 

		  $this->load->helper('url');

		  $this->token = "sk_test_51GzffmHcKfZ3B3C9DATC3YXIdad2ummtHcNgVK4E5ksCLbFWWLYAyXHRtVzjt8RGeejvUb6Z2yUk740hBAviBSyP00mwxmNmP1";
		  $this->connected = $this->session->userdata('admin_login');
		  $this->email_sites = $this->crud_model->get_email_du_site();

		}

		function index(){
			$data['title']="mon profile admin";
			$data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
			$this->load->view('backend/admin/templete_admin', $data);
		}

		function equipe(){
	      $data['title']="Paramètrage des équipes";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['users'] = $this->crud_model->fetch_connected($this->connected);

	      $this->load->view('backend/admin/equipe', $data);
	    }

	    function match(){
	      $data['title']="Paramètrage des matchs";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['users'] = $this->crud_model->fetch_connected($this->connected);

	      $data['equipes']  = $this->crud_model->Select_equipes(); 

	      $this->load->view('backend/admin/match', $data);
	    }

	    function reservation(){
	      $data['title']="Paramètrage des reservations";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['users'] = $this->crud_model->fetch_connected($this->connected);

	      $data['equipes']  = $this->crud_model->Select_equipes();
	      $data['roles']  		= $this->crud_model->Select_formations_ok("idrole","role"); 

	      $data['stades']  		= $this->crud_model->Select_formations_ok("idstade","stade"); 
	      $data['matchs']  		= $this->crud_model->Select_formations_ok("idmath","matchs"); 
	      $data['clients']  	= $this->crud_model->fetch_all_client(); 
	      
	      $this->load->view('backend/admin/reservation', $data);
	    }

	    function billet(){
	      $data['title']="Paramètrage des billets";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['users'] = $this->crud_model->fetch_connected($this->connected);

	      $data['equipes']  = $this->crud_model->Select_equipes();
	      $data['roles']  		= $this->crud_model->Select_formations_ok("idrole","role"); 

	      $data['stades']  		= $this->crud_model->Select_formations_ok("idstade","stade"); 
	      $data['matchs']  		= $this->crud_model->Select_formations_ok("idmath","matchs"); 


	      $data['clients']  	= $this->crud_model->fetch_all_client(); 
	      
	      $this->load->view('backend/admin/billet', $data);
	    }

	    

	     function client(){
	      $data['title']="Paramètrage des clients";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['users'] = $this->crud_model->fetch_connected($this->connected);

	      $data['equipes']  = $this->crud_model->Select_equipes(); 
	      $data['roles']  		= $this->crud_model->Select_formations_ok("idrole","role");

	      $this->load->view('backend/admin/client', $data);
	    }

	    function stade(){
	      $data['title']="Paramètrage des stades";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['users'] = $this->crud_model->fetch_connected($this->connected);

	      $data['equipes']  = $this->crud_model->Select_equipes(); 
	      $data['roles']  		= $this->crud_model->Select_formations_ok("idrole","role");

	      $this->load->view('backend/admin/stade', $data);
	    }

	    function place(){
	      $data['title']="Paramètrage des places";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['users'] = $this->crud_model->fetch_connected($this->connected);

	      $data['equipes']  = $this->crud_model->Select_equipes(); 
	      $data['roles']  		= $this->crud_model->Select_formations_ok("idrole","role");

	      $data['stades']  		= $this->crud_model->Select_formations_ok("nom","stade");

	      $this->load->view('backend/admin/place', $data);
	    }

		function dashbord(){
			  $data['title']="Tableau de bord";
			  $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
		      // $data['nombre_location'] = $this->crud_model->statistiques_nombre("profile_location");
		      $data['nombre_client'] = $this->crud_model->statistiques_nombre_tag_by_column("users", 2);

		      $data['nombre_membre'] = $this->crud_model->statistiques_nombre_tag_by_column("users", 3);

		      $data['nombre_paiement'] = $this->crud_model->statistiques_nombre("reservation");

		      $data['nombre_users'] = $this->crud_model->statistiques_nombre("users");
		      $this->load->view('backend/admin/dashbord', $data);
		}

		

	    function stat_fichestock(){

	       $data['title']="Fiche de stock des marchandises";
	       $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	       $customer_id = "Fiche de stock ";
	       $html_content = '';
	       $html_content .= $this->crud_model->Fiche_impressionFichedeStock();

	       // echo($html_content);

	       $this->pdf->loadHtml($html_content);
	       $this->pdf->render();
	       $this->pdf->stream("".$customer_id.".pdf", array("Attachment"=>0));
	    }

	    public function QRcode($kodenya)
		{
		    //render  qr code dengan format gambar PNG
		    QRcode::png(
		      $kodenya,
		      $outfile = false,
		      $level = QR_ECLEVEL_H,
		      $size  = 6,
		      $margin = 2
		    );
		}

		public function Barcode($kodenya)
		{
		    $this->zend->load('Zend/Barcode');
		    Zend_Barcode::render('code128', 'image', array('text' => $kodenya));
		}

	    function pdf_billet($parem1=''){

	       $data['title']="Bille de match";
	       $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	       $customer_id = "Bilet de match ";
	       $html_content = '';
	       $url = base_url('admin/QRcode/'.$parem1);
	       $html_content .= $this->crud_model->Fiche_billet($parem1);

	       // echo($html_content);

	       $this->pdf->loadHtml($html_content);
	       $this->pdf->render();
	       $this->pdf->stream("".$customer_id.".pdf", array("Attachment"=>0));
	    }

	    function pdf_billet_list($parem1=''){

	       $data['title']="Liste des Billes de match";
	       $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	       $customer_id = "Bilet de match ";
	       $html_content = '';
	       $html_content .= $this->crud_model->Fiche_Liste_billet_by_match($parem1);

	       // echo($html_content);

	       $this->pdf->loadHtml($html_content);
	       $this->pdf->render();
	       $this->pdf->stream("Liste des Billes de match ".$customer_id.".pdf", array("Attachment"=>0));
	    }

	    /*

	    DEBIT FONCTION APPEL DES VIEWS UTILISATION DE PORTALI Ecommerce
	    MES SCRIPTS EcommerceB COMMENCE DEJE
	    ========================================================
	    */

	    function evaluation(){
			$data['title']="Evaluation de paiement";
	    	$data['users'] = $this->crud_model->fetch_connected($this->connected);
		    $data['contact_info_site']  = $this->crud_model->Select_contact_info_site();

	        $data['dates']    = $this->crud_model->fetch_categores_dates_compt();
	        $data['chart_data'] = $this->crud_model->get_stat_paie();
	        $this->load->view('backend/admin/evaluation_paiement', $data);
		}

	   


		function profile(){
	      $data['title']="mon profile admin";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['users'] = $this->crud_model->fetch_connected($this->connected);
	      // $this->load->view('backend/admin/viewx', $data);
	      $this->load->view('backend/admin/profile', $data);
	    }

	    function basic(){
	        $data['title']="Information basique de mon compte";
	        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	        $data['users'] = $this->crud_model->fetch_connected($this->connected);
	        $this->load->view('backend/admin/basic', $data);
	    }

	    function basic_image(){
	        $data['title']="Information basique de ma photo";
	        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	        $data['users'] = $this->crud_model->fetch_connected($this->connected);
	        $this->load->view('backend/admin/basic_image', $data);
	    }

	    function basic_secure(){
	        $data['title']="Paramètrage de sécurité de mon compte";
	        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	        $data['users'] = $this->crud_model->fetch_connected($this->connected);
	        $this->load->view('backend/admin/basic_secure', $data);
	    }

	    function notification($param1=''){
	      $data['title']    ="Listes des formations";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['users']    = $this->crud_model->fetch_connected($this->connected);
	      $this->load->view('backend/admin/notification', $data);
	    }


		function site(){
			$data['title']="Paramétrage  du site";
			$data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	    	$data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
			$this->load->view('backend/admin/site', $data);		
		}
		function role(){
			$data['title']="Paramètrage de roles";
			$data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
			$this->load->view('backend/admin/role', $data);
		}

		function category(){

			$data['title']="Paramètrage cétegorie produit";
			$data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
			$this->load->view('backend/admin/category', $data);
		}

		function users(){
	      $data['title']="Nos utilisateurs";
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      $data['nombre_users']   = $this->crud_model->statistiques_nombre("users");
	      $data['nombre_users_m'] = $this->crud_model->statistiques_nombre_where("users","sexe","M");
	      $data['nombre_users_f'] = $this->crud_model->statistiques_nombre_where("users","sexe","F");
	      $data['nombre_users_a'] = $this->crud_model->statistiques_nombre_where_null("users","sexe","NULL");
	      $data['users']  = $this->crud_model->Select_users();   
	      $data['roles']  = $this->crud_model->Select_roles();    
	      $this->load->view('backend/admin/users', $data);
	    }

	    function stat_users(){
		    $data['title']="Statistique sur nos utilisateurs";
		    $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
		    $data['nombre_users']   = $this->crud_model->statistiques_nombre("users");
		    $data['nombre_users_m'] = $this->crud_model->statistiques_nombre_where("users","sexe","M");
		    $data['nombre_users_f'] = $this->crud_model->statistiques_nombre_where("users","sexe","F");
		    $data['nombre_users_a'] = $this->crud_model->statistiques_nombre_where_null("users","sexe","NULL");
		    $this->load->view('backend/admin/stat_users', $data);
		}


		// script pour la sauvegarge de données 
	    function database($param1 = '', $param2 = '')
	    {
	        
	        if($param1 == 'restore')
	        {
	            // $this->crud_model->import_db();
	            $this->session->set_flashdata('message',"Importation de la base des données avec succès!!!");
	            redirect(base_url() . 'admin/database/', 'refresh');
	        }
	        if($param1 == 'create')
	        {
	          $this->crud_model->create_backup();
	          $this->session->set_flashdata('message',"Sauvegarde de la base des données avec succès!!!");
	          redirect(base_url() . 'admin/database/', 'refresh');
	        }

	        $data['title'] = "Sauvegarde et restauration de la base des données";
	        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	         $data['contact_info_site']  = $this->crud_model->Select_contact_info_site();
	        $data['users'] = $this->crud_model->fetch_connected($this->connected);
	        $this->load->view('backend/admin/database', $data);
	    }
	    // fin script sauvegarde des données 

	    function approvisionnement(){
			$data['title']="Approvisionnement des produits";
			$data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
			$data['categories'] = $this->crud_model->fetch_categores();
			$data['produits'] = $this->crud_model->fetch_produits();
			$this->load->view('backend/admin/approvisionnement', $data);
		}

		

		function contact_info(){
		    $data['title']="Les informations de contact";
		    $data['contact_info_site']  = $this->crud_model->Select_contact_info_site();
		    $this->load->view('backend/admin/contact_info', $data);
		}

		/*

	    DEBIT FONCTION APPEL DES VIEWS UTILISATION DE PORTALI Ecommerce
	    MES SCRIPTS EcommerceB COMMENCE DEJE
	    ========================================================
	    */


	    function modification_panel($param1='', $param2='', $param3=''){

		      if ($param1="option1") {
		         $data = array(
		            'first_name'        => $this->input->post('first_name'),
		            'last_name'       => $this->input->post('last_name'),
		            'telephone'       => $this->input->post('telephone'),
		            'full_adresse'      => $this->input->post('full_adresse'),
		            'biographie'        => $this->input->post('biographie'),
		            'date_nais'       => $this->input->post('date_nais'),
		            'sexe'          => $this->input->post('sexe'),
		            'email'         => $this->input->post('mail_ok'), 

		            'facebook'        => $this->input->post('facebook'),
		            'linkedin'        => $this->input->post('linkedin'),
		            'twitter'         => $this->input->post('twitter')
		        );

		        $id_user= $this->connected;
		        $query = $this->crud_model->update_crud($id_user, $data);
		        $this->session->set_flashdata('message', 'votre profile a été mis à jour avec succès!!!🆗');
		         redirect('admin/basic', 'refresh');
		      }

		  }

		  function modification_photo(){

		     $id_user= $this->connected;
		     if ($_FILES['user_image']['size'] > 0) {
		       # code...
		        $data = array(
		          'image'     => $this->upload_image()
		        );
		       $query = $this->crud_model->update_crud($id_user, $data);
		       $this->session->set_flashdata('message', 'modification avec succès');
		           redirect('admin/basic_image', 'refresh');
		     }
		     else{

		        $this->session->set_flashdata('message2', 'Veillez selectionner la photo');
		        redirect('admin/basic_image', 'refresh');

		     }
		     
		  }


		  function upload_image()  
		  {  
		       if(isset($_FILES["user_image"]))  
		       {  
		            $extension = explode('.', $_FILES['user_image']['name']);  
		            $new_name = rand() . '.' . $extension[1];  
		            $destination = './upload/photo/' . $new_name;  
		            move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
		            return $new_name;  
		       }  
		  }

		  function modification_account($param1=''){
		       $id_user= $this->connected;
		       $first_name;

		       $passwords = md5($this->input->post('user_password_ancien'));
		       
		       $users = $this->db->query("SELECT * FROM users WHERE passwords='".$passwords."' AND id='".$id_user."' ");

		       if ($users->num_rows() > 0) {
		          
		          foreach ($users->result_array() as $row) {
		            $first_name = $row['first_name'];
		            // echo($first_name);
		             $nouveau   =  $this->input->post('user_password_nouveau');
		             $confirmer =  $this->input->post('user_password_confirmer');
		             if ($nouveau == $confirmer) {
		              $new_pass= md5($nouveau);

		              $data = array(
		                  'passwords'  => $new_pass
		                );

		                 $query = $this->crud_model->update_crud($id_user, $data);
		                 $this->session->set_flashdata('message', 'votre clée de sécurité a été changer avec succès '.$first_name);
		                   redirect('admin/basic_secure', 'refresh');

		               }
		               else{
		   
		                $this->session->set_flashdata('message2', 'les deux mot de passe doivent être identiques');
		                redirect('admin/basic_secure', 'refresh');
		               }
		         
		          }

		       }
		       else{

		          $this->session->set_flashdata('message2', 'information incorecte');
		          redirect('admin/basic_secure', 'refresh');
		       }
		     
		  } 

		  function view_1($param1='', $param2='', $param3=''){
		      
			  if($param1=='display_delete') {
			  	$this->session->set_flashdata('message', 'suppression avec succès ');
			    $query = $this->crud_model->delete_notifacation_tag($param2);
			    redirect('admin/notification');
			  }

			  if($param1=='display_delete_message') {

			    $query = $this->crud_model->delete_message_tag($param3);
			    redirect('admin/message/'.$param2);
			  }
			  else{

			  }

		  }


		// script de produit en stock

		function pagination_view_product()
		{

		  $this->load->library("pagination");
		  $config = array();
		  $config["base_url"] = "#";
		  $config["total_rows"] = $this->crud_model->count_all_view_product();
		  $config["per_page"] = 10;
		  $config["uri_segment"] = 3;
		  $config["use_page_numbers"] = TRUE;
		  $config["full_tag_open"] = '<ul class="nav pagination">';
		  $config["full_tag_close"] = '</ul>';
		  $config["first_tag_open"] = '<li class="page-item">';
		  $config["first_tag_close"] = '</li>';
		  $config["last_tag_open"] = '<li class="page-item">';
		  $config["last_tag_close"] = '</li>';
		  $config['next_link'] = '<li class="page-item active"><i class="btn btn-info">&gt;&gt;</i>';
		  $config["next_tag_open"] = '<li class="page-item">';
		  $config["next_tag_close"] = '</li>';
		  $config["prev_link"] = '<li class="page-item active"><i class="btn btn-info">&lt;&lt;</i>';
		  $config["prev_tag_open"] = "<li class='page-item'>";
		  $config["prev_tag_close"] = "</li>";
		  $config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
		  $config["cur_tag_close"] = "</a></li>";
		  $config["num_tag_open"] = "<li class='page-item'>";
		  $config["num_tag_close"] = "</li>";
		  $config["num_links"] = 1;
		  $this->pagination->initialize($config);
		  $page = $this->uri->segment(3);
		  $start = ($page - 1) * $config["per_page"];

		  $output = array(
		   'pagination_link'  => $this->pagination->create_links(),
		   'country_table'   => $this->crud_model->fetch_details_view_product($config["per_page"], $start)
		  );
		  echo json_encode($output);
		}


		function fetch_search_view_product()
		{
		  $output = '';
		  $query = '';
		  if($this->input->post('query'))
		  {
		   $query = $this->input->post('query');
		  }
		  $data = $this->crud_model->fetch_data_search_view_product($query);
		  $output .= '
	      <table class="table-striped  nk-tb-list nk-tb-ulist dataTable no-footer" data-auto-responsive="false" id="user_data" role="grid" aria-describedby="DataTables_Table_1_info">
	          <thead>  
	            <tr>         
	               <th width="10%">Image</th>
	               <th width="15%">Nom du produit</th>  
	               <th width="10%">Prix</th>
	               <th width="10%">Catégorie produit</th>
	               <th width="15%">Qte en stock</th>
	               <th width="10%">Utilisateur action</th>
	               <th width="5%">Modifier</th> 
	               <th width="5%">Supprimer</th>  
	            </tr> 
	         </thead> 
	      ';
	      if ($data->num_rows() < 0) {
	        
	      }
	      else{

	        foreach($data->result() as $row)
	        {
	         $output .= '
	         <tr>
	          <td><img src="'.base_url().'upload/product/'.$row->product_image.'" class="img img-responsive img-thumbnail" width="50" height="35" style="border-radius:50%;" /></td>

	          <td>'.nl2br(substr($row->product_name, 0,10)).'...'.'</td>
	          <td>'.nl2br(substr($row->product_price, 0,10)).' $'.'</td>
	          <td>'.nl2br(substr($row->nom, 0,20)).' ...'.'</td>
	          <td>'.nl2br(substr($row->Qte, 0,10)).' '.'</td>
	          <td>'.nl2br(substr($row->first_name, 0,10)).'...'.'</td>
	          
	          <td><button type="button" name="update" product_id="'.$row->product_id.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button></td>
	          <td><button type="button" name="delete" product_id="'.$row->product_id.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button></td>
	          

	         </tr>
	         ';
	        }
	      }
	      $output .= '
	          <tfoot>  
	            <tr>         
	               <th width="10%">Image</th>
	               <th width="15%">Nom du produit</th>  
	               <th width="10%">Prix</th>
	               <th width="10%">Catégorie produit</th>
	               <th width="15%">Qte en stock</th>
	               <th width="10%">Utilisateur action</th>
	               <th width="5%">Modifier</th> 
	               <th width="5%">Supprimer</th>  
	            </tr> 
	         </tfoot>   
	            
	        </table>';
		  echo $output;
		}


        function fetch_product(){  

           $fetch_data = $this->crud_model->make_datatables_product();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = '<img src="'.base_url().'upload/product/'.$row->product_image.'" class="img-thumbnail" width="50" height="35" />';  
                $sub_array[] = nl2br(substr($row->product_name, 0,10)).'...'; 
                $sub_array[] = nl2br(substr($row->product_price, 0,10)).'...';  
                $sub_array[] = nl2br(substr($row->nom, 0,10)).'...'; 

                // $sub_array[] = '<img src="'.base_url().'upload/photo/'.$row->image.'" class="img-thumbnail" width="50" height="35" />';
                $sub_array[] = nl2br(substr($row->first_name, 0,10)).'...'; 
                
 
                $sub_array[] = '<button type="button" name="update" product_id="'.$row->product_id.'" class="btn btn-warning btn-xs update"><i class="fa fa-edit"></i></button>';  
                $sub_array[] = '<button type="button" name="delete" product_id="'.$row->product_id.'" class="btn btn-danger btn-xs delete"><i class="fa fa-trash"></i></button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                =>     intval($_POST["draw"]),  
                "recordsTotal"        =>     $this->crud_model->get_all_data_product(),  
                "recordsFiltered"     =>     $this->crud_model->get_filtered_data_product(),  
                "data"                =>     $data  
           );  
           echo json_encode($output);  
       }

      function fetch_single_product()  
      {  
           $output = array();  
           $data = $this->crud_model->fetch_single_product($_POST["product_id"]);  
           foreach($data as $row)  
           {  
                $output['product_name'] 		= $row->product_name;  
                $output['product_price'] 		= $row->product_price; 
                $output['category_id'] 			= $row->category_id; 
                $output['Qte'] 					= $row->Qte;
                $output['nom'] 					= $row->nom;
                

                if($row->product_image != '')  
                {  
                     $output['user_image'] = '<img src="'.base_url().'upload/product/'.$row->product_image.'" class="img-thumbnail" width="70" height="70" /><input type="hidden" name="hidden_user_image" value="'.$row->product_image.'" />';  
                }  
                else  
                {  
                     $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
                }  
           }  
           echo json_encode($output);  
      }  


      function operation_product(){

      	$id_user = $this->session->userdata("admin_login");


      	  if($_FILES["user_image"]["size"] > 0)  
          {  
               $insert_data = array(  
		           'product_name'           =>     $this->input->post('product_name'),  
		           'product_price'          =>     $this->input->post("product_price"), 
		           'Qte'          			=>     $this->input->post("Qte"),
		           'category_id'         	=>     $this->input->post('category_id'), 
		           'id_user'           		=>     $id_user, 
		           'product_image'          =>     $this->upload_image_product()
			  	);    
          }  
          else  
          {  
               $user_image = "photoDefaut.jpg";  
               $insert_data = array(  
		           'product_name'           =>     $this->input->post('product_name'),  
		           'product_price'          =>     $this->input->post("product_price"), 
		           'Qte'          			=>     $this->input->post("Qte"),
		           'category_id'         	=>     $this->input->post('category_id'), 
		           'id_user'           		=>     $id_user, 
		           'product_image'          =>     $user_image
			  	); 
          }

	      
	       
	      $requete=$this->crud_model->insert_product($insert_data);
	      echo("Ajout information avec succès");
	      
      }

      function modification_product(){
  
          if($_FILES["user_image"]["size"] > 0)  
          {  
               $updated_data = array(  
		           'product_name'           =>     $this->input->post('product_name'),  
		           'product_price'          =>     $this->input->post("product_price"), 
		           'category_id'         	=>     $this->input->post('category_id'),  
		           'Qte'          			=>     $this->input->post("Qte"),
		           'product_image'          =>     $this->upload_image_product()
			  	);    
          }  
          else  
          {  
               $updated_data = array(  
		           'product_name'           =>     $this->input->post('product_name'),  
		           'product_price'          =>     $this->input->post("product_price"), 
		           'Qte'          			=>     $this->input->post("Qte"),
		           'category_id'         	=>     $this->input->post('category_id')  
			  	);    
          }
  
          $this->crud_model->update_product($this->input->post("product_id"), $updated_data);

          echo("modification avec succès");
      }

      


      function supression_product(){
 
          $this->crud_model->delete_product($this->input->post("product_id"));

          echo("suppression avec succès");
        
      }


      function upload_image_product()  
	  {  
	       if(isset($_FILES["user_image"]))  
	       {  
	            $extension = explode('.', $_FILES['user_image']['name']);  
	            $new_name = rand() . '.' . $extension[1];  
	            $destination = './upload/product/' . $new_name;  
	            move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
	            return $new_name;  
	       }  
	  } 
	  // fin de script product 


	  // script de galery produit en stock
        function fetch_galery(){  

           $fetch_data = $this->crud_model->make_datatables_galery();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = '<img src="'.base_url().'upload/product/galery/'.$row->photos.'" class="img-thumbnail" width="50" height="35" />';  
                $sub_array[] = nl2br(substr($row->product_name, 0,10)).'...'; 
                $sub_array[] = nl2br(substr($row->product_price, 0,10)).'...';  
                $sub_array[] = nl2br(substr($row->Qte, 0,10)).'...'; 

                
 
                $sub_array[] = '<button type="button" name="update" idgalery="'.$row->idgalery.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
                $sub_array[] = '<button type="button" name="delete" idgalery="'.$row->idgalery.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                =>     intval($_POST["draw"]),  
                "recordsTotal"        =>     $this->crud_model->get_all_data_galery(),  
                "recordsFiltered"     =>     $this->crud_model->get_filtered_data_galery(),  
                "data"                =>     $data  
           );  
           echo json_encode($output);  
       }

      function fetch_single_galery()  
      {  
           $output = array();  
           $data = $this->crud_model->fetch_single_galery($_POST["idgalery"]);  
           foreach($data as $row)  
           {  
                $output['product_name'] 		= $row->product_name;  
                $output['product_price'] 		= $row->product_price; 
                $output['product_id'] 			= $row->product_id;

                $output['Qte'] 					= $row->Qte;
                

                if($row->photos != '')  
                {  
                     $output['user_image'] = '<img src="'.base_url().'upload/product/galery/'.$row->photos.'" class="img-thumbnail" width="70" height="70" /><input type="hidden" name="hidden_user_image" value="'.$row->photos.'" />';  
                }  
                else  
                {  
                     $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
                }  
           }  
           echo json_encode($output);  
      }  


      function operation_galery(){

      
      	  if($_FILES["user_image"]["size"] > 0)  
          {  
                $insert_data = array(  
		           'product_id'      =>     $this->input->post('product_id'),  
		           'photos'          =>     $this->upload_image_galery()
			  	);    
          }  
          else  
          {  
               $user_image = "photoDefaut.jpg";  
               $insert_data = array(  
		           'product_id'      =>     $this->input->post('product_id'),  
		           'photos'          =>     $user_image
			   ); 
          }

	      
	       
	      $requete=$this->crud_model->insert_galery($insert_data);
	      echo("Ajout information avec succès");
	      
      }

      function modification_galery(){
  
          if($_FILES["user_image"]["size"] > 0)  
          {  
               $updated_data = array(  
		           'product_id'      =>     $this->input->post('product_id'),  
		           'photos'          =>     $this->upload_image_galery()
			  	);    
          }  
          else  
          {  
               $updated_data = array(  
		           'product_id'      =>     $this->input->post('product_id')  
			  	);    
          }
  
          $this->crud_model->update_galery($this->input->post("idgalery"), $updated_data);

          echo("modification avec succès");
      }

      


      function supression_galery(){
 
          $this->crud_model->delete_galery($this->input->post("idgalery"));

          echo("suppression avec succès");
        
      }


      function upload_image_galery()  
	  {  
	       if(isset($_FILES["user_image"]))  
	       {  
	            $extension = explode('.', $_FILES['user_image']['name']);  
	            $new_name = rand() . '.' . $extension[1];  
	            $destination = './upload/product/galery/' . $new_name;  
	            move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
	            return $new_name;  
	       }  
	  } 
	  // fin de script product galery


		// script de category
	    function fetch_category(){  

	           $fetch_data = $this->crud_model->make_datatables_category();  
	           $data = array();  
	           foreach($fetch_data as $row)  
	           {  
	                $sub_array = array();  
	               
	                $sub_array[] = nl2br(substr($row->nom, 0,50)); 
	                $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
	               
	 
	                $sub_array[] = '<button type="button" name="update" idcat="'.$row->idcat.'" class="btn btn-warning btn-sm btn-circle update"><i class="fa fa-edit"></i></button>';  
	                $sub_array[] = '<button type="button" name="delete" idcat="'.$row->idcat.'" class="btn btn-danger btn-sm btn-circle delete"><i class="fa fa-trash"></i></button>';  
	                $data[] = $sub_array;  
	           }  
	           $output = array(  
	                "draw"                =>     intval($_POST["draw"]),  
	                "recordsTotal"        =>     $this->crud_model->get_all_data_category(),  
	                "recordsFiltered"     =>     $this->crud_model->get_filtered_data_category(),  
	                "data"                =>     $data  
	           );  
	           echo json_encode($output);  
	      }

	      function fetch_single_category()  
	      {  
	           $output = array();  
	           $data = $this->crud_model->fetch_single_category($_POST["idcat"]);  
	           foreach($data as $row)  
	           {  
	                $output['nom'] 		= $row->nom;  
	                
	               
	           }  
	           echo json_encode($output);  
	      }  


	      function operation_category(){

	          $insert_data = array(  
		           'nom'           	=>     $this->input->post('nom')
			  );  

		      $requete=$this->crud_model->insert_category($insert_data);
		      echo("Ajout information avec succès");
		      
	      }

	      function modification_category(){
	  
	          $updated_data = array(  
		           'nom'           	=>     $this->input->post('nom')
			  );
	  
	          $this->crud_model->update_category($this->input->post("idcat"), $updated_data);

	          echo("modification avec succès");
	      }

	      function supression_category(){
	 
	          $this->crud_model->delete_category($this->input->post("idcat"));
	          echo("suppression avec succès");
	        
	      }

		  // fin de sript parametrage 



	    // script des utilisateurs 
	    function fetch_users(){  

	           $fetch_data = $this->crud_model->make_datatables_users();  
	           $data = array(); 
	           $etat =''; 
	           foreach($fetch_data as $row)  
	           {  
	           		if ($row->idrole == 1) {
	           			$etat ='<span class="badge badge-success">Admin</span>';
	           		}
	           		else if ($row->idrole == 2) {
	           			$etat ='<span class="badge badge-danger">Client</span>';
	           		}
	           		else if ($row->idrole == 3) {
	           			$etat ='<span class="badge badge-info">Membre</span>';
	           		}
	           		else{
	           			$etat ='<span class="badge badge-danger">User</span>';
	           		}

	                $sub_array = array();  
	                $sub_array[] = '<img src="'.base_url().'upload/photo/'.$row->image.'" class="table-user-thumb" style="border-radius: 50%; width: 50px; height: 30px;" />';  
	                $sub_array[] = nl2br(substr($row->first_name, 0,50)).'...';  
	                $sub_array[] = nl2br(substr($row->last_name, 0,50)).'...'; 

	                $sub_array[] = nl2br(substr($row->sexe, 0,50)).'';

	                $sub_array[] = nl2br(substr($row->email, 0,50));

	                $sub_array[] = nl2br(substr($row->telephone, 0,50));
	                $sub_array[] = $etat;

	                
	 
	                $sub_array[] = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>'; 

	                $sub_array[] = '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';
	                
	                $data[] = $sub_array;  
	           }  
	           $output = array(  
	                "draw"                =>     intval($_POST["draw"]),  
	                "recordsTotal"        =>     $this->crud_model->get_all_data_users(),  
	                "recordsFiltered"     =>     $this->crud_model->get_filtered_data_users(),  
	                "data"                =>     $data  
	           );  
	           echo json_encode($output);  
	      }

	      function operation_users(){

	          if($_FILES["user_image"]["size"] > 0)  
	          {  
	               $insert_data = array(  
	                   'first_name'     =>     $this->input->post('first_name'),  
	                   'last_name'      =>     $this->input->post("last_name"),
	                   'email'          =>     $this->input->post("email"),
	                   'telephone'      =>     $this->input->post("telephone"),
	                   'full_adresse'   =>     $this->input->post("full_adresse"),
	                   'date_nais'      =>     $this->input->post("date_nais"), 
	                   'idrole'         =>     $this->input->post("idrole"),
	                   'sexe'           =>     $this->input->post("sexe"),
	                   'facebook'       =>     $this->input->post("facebook"),
	                   'twitter'        =>     $this->input->post("twitter"),
	                   'linkedin'       =>     $this->input->post("linkedin"),
	                   'passwords'      =>     md5(123456),
	                   'idrole'         =>     $this->input->post("idrole"), 
	                   'image'          =>     $this->upload_image_users()
	                );    
	          }  
	          else  
	          {  
	                 $user_image = "icone-user.png";  
	                 $insert_data = array(  
	                   'first_name'     =>     $this->input->post('first_name'),  
	                   'last_name'      =>     $this->input->post("last_name"),
	                   'email'          =>     $this->input->post("email"),
	                   'telephone'      =>     $this->input->post("telephone"),
	                   'full_adresse'   =>     $this->input->post("full_adresse"),
	                   'date_nais'      =>     $this->input->post("date_nais"), 
	                   'idrole'         =>     $this->input->post("idrole"),
	                   'sexe'           =>     $this->input->post("sexe"),
	                   'facebook'       =>     $this->input->post("facebook"),
	                   'twitter'        =>     $this->input->post("twitter"),
	                   'linkedin'       =>     $this->input->post("linkedin"),
	                   'idrole'         =>     $this->input->post("idrole"),
	                   'image'          =>     $user_image
	                );   
	          }

	        $requete=$this->crud_model->insert_users($insert_data);
	        echo("Ajout information avec succès");
	        
	      }

	      function modification_users(){

	          if($_FILES["user_image"]["size"] > 0)  
	          {  
	               $updated_data = array(  
	                   'first_name'     =>     $this->input->post('first_name'),  
	                   'last_name'      =>     $this->input->post("last_name"),
	                   'email'          =>     $this->input->post("email"),
	                   'telephone'      =>     $this->input->post("telephone"),
	                   'full_adresse'   =>     $this->input->post("full_adresse"),
	                   'date_nais'      =>     $this->input->post("date_nais"), 
	                   'sexe'           =>     $this->input->post("sexe"),
	                   'facebook'       =>     $this->input->post("facebook"),
	                   'twitter'        =>     $this->input->post("twitter"),
	                   'linkedin'       =>     $this->input->post("linkedin"),
	                   'idrole'         =>     $this->input->post("idrole"),
	                   'image'          =>     $this->upload_image_users()
	                );    
	          }  
	          
	          else  
	          {   
	               $updated_data = array(  
	                   'first_name'     =>     $this->input->post('first_name'),  
	                   'last_name'      =>     $this->input->post("last_name"),
	                   'email'          =>     $this->input->post("email"),
	                   'telephone'      =>     $this->input->post("telephone"),
	                   'full_adresse'   =>     $this->input->post("full_adresse"),
	                   'date_nais'      =>     $this->input->post("date_nais"), 
	                   'sexe'           =>     $this->input->post("sexe"),
	                   'facebook'       =>     $this->input->post("facebook"),
	                   'twitter'        =>     $this->input->post("twitter"),
	                   'idrole'         =>     $this->input->post("idrole"),
	                   'linkedin'       =>     $this->input->post("linkedin")
	                );   
	          }
	  
	          
	          $this->crud_model->update_users($this->input->post("id"), $updated_data);

	          echo("modification avec succès");
	      }

	      function supression_users(){
	 
	          $this->crud_model->delete_users($this->input->post("id"));
	          echo("suppression avec succès");
	        
	      }

	      function fetch_single_users()  
	      {  
	           $output = array();  
	           $data = $this->crud_model->fetch_single_users($this->input->post('id'));  
	           foreach($data as $row)  
	           {  
	                $output['first_name'] = $row->first_name;  
	                $output['last_name'] = $row->last_name; 

	                $output['email'] = $row->email;
	                $output['telephone'] = $row->telephone;
	                $output['full_adresse'] = $row->full_adresse;
	                $output['biographie'] = $row->biographie;
	                $output['date_nais'] = $row->date_nais;
	                $output['sexe'] = $row->sexe;
	                $output['idrole'] = $row->idrole;

	                $output['facebook'] = $row->facebook;
	                $output['linkedin'] = $row->linkedin;
	                $output['twitter'] = $row->twitter;
	                $output['image'] = $row->image;

	                if($row->image != '')  
	                {  
	                     $output['user_image'] = '<img src="'.base_url().'upload/photo/'.$row->image.'" class="img-thumbnail" width="300" height="250" /><input type="hidden" name="hidden_user_image" value="'.$row->image.'" />';  
	                }  
	                else  
	                {  
	                     $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
	                }  

	                
	           }  
	           echo json_encode($output);  
	      }

      // fun script utilisateurs 



	    // script de role
		function fetch_role(){  

		       $fetch_data = $this->crud_model->make_datatables_role();  
		       $data = array();  
		       foreach($fetch_data as $row)  
		       {  
		            $sub_array = array();  
		           
		            $sub_array[] = nl2br(substr($row->nom, 0,50)); 
		            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
		           

		            $sub_array[] = '<button type="button" name="update" idrole="'.$row->idrole.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
		            $sub_array[] = '<button type="button" name="delete" idrole="'.$row->idrole.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
		            $data[] = $sub_array;  
		       }  
		       $output = array(  
		            "draw"                =>     intval($_POST["draw"]),  
		            "recordsTotal"        =>     $this->crud_model->get_all_data_role(),  
		            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_role(),  
		            "data"                =>     $data  
		       );  
		       echo json_encode($output);  
		  }

		  function fetch_single_role()  
		  {  
		       $output = array();  
		       $data = $this->crud_model->fetch_single_role($_POST["idrole"]);  
		       foreach($data as $row)  
		       {  
		            $output['nom']    = $row->nom;  
		            
		           
		       }  
		       echo json_encode($output);  
		  }  


		  function operation_role(){

		    $insert_data = array(  
		           'nom'            =>     $this->input->post('nom')
		    );  

		      $requete=$this->crud_model->insert_role($insert_data);
		      echo("Ajout information avec succès");
		      
		  }

		  function modification_role(){

		      $updated_data = array(  
		           'nom'            =>     $this->input->post('nom')
		    );

		      $this->crud_model->update_role($this->input->post("idrole"), $updated_data);

		      echo("modification avec succès");
		  }

		  function supression_role(){

		      $this->crud_model->delete_role($this->input->post("idrole"));
		      echo("suppression avec succès");
		    
		  }

		  // fin role

		// script de tbl_info
	    function fetch_tbl_info(){  

	           $fetch_data = $this->crud_model->make_datatables_tbl_info();  
	           $data = array();  
	           foreach($fetch_data as $row)  
	           {  
	                $sub_array = array();  
	                $sub_array[] = '<img src="'.base_url().'upload/tbl_info/'.$row->icone.'" class="img-thumbnail img-responsive" width="50" height="35" style="border-radius:50%;" />';  
	                $sub_array[] = nl2br(substr($row->nom_site, 0,10)).'...'; 
	                $sub_array[] = nl2br(substr($row->email, 0,10)).'...';  
	                $sub_array[] = nl2br(substr($row->tel1, 0,10)).'...'; 
	                // $sub_array[] = nl2br(substr($row->tel2, 0,5)).'...'; 
	                $sub_array[] = nl2br(substr($row->adresse, 0,10)).'...'; 
	                $sub_array[] = nl2br(substr($row->facebook, 0,10)).'...'; 
	                $sub_array[] = nl2br(substr($row->twitter, 0,10)).'...'; 
	                $sub_array[] = nl2br(substr($row->linkedin, 0,10)).'...'; 
	                // $sub_array[] = nl2br(substr($row->termes, 0,10)).'...'; 
	                // $sub_array[] = nl2br(substr($row->confidentialite, 0,10)).'...'; 
	                
	 
	                $sub_array[] = '<button type="button" name="update" idinfo="'.$row->idinfo.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
	                $sub_array[] = '<button type="button" name="delete" idinfo="'.$row->idinfo.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
	                $data[] = $sub_array;  
	           }  
	           $output = array(  
	                "draw"                =>     intval($_POST["draw"]),  
	                "recordsTotal"        =>     $this->crud_model->get_all_data_tbl_info(),  
	                "recordsFiltered"     =>     $this->crud_model->get_filtered_data_tbl_info(),  
	                "data"                =>     $data  
	           );  
	           echo json_encode($output);  
	      }

	      function fetch_single_tbl_info()  
	      {  
	           $output = array();  
	           $data = $this->crud_model->fetch_single_tbl_info($_POST["idinfo"]);  
	           foreach($data as $row)  
	           {  
	                $output['nom_site']     = $row->nom_site;  
	                $output['adresse']      = $row->adresse; 
	                $output['tel1']       = $row->tel1; 
	                $output['tel2']       = $row->tel2; 
	                $output['email']      = $row->email; 
	                $output['facebook']     = $row->facebook; 
	                $output['twitter']      = $row->twitter; 
	                $output['linkedin']     = $row->linkedin;

	                $output['termes']       = $row->termes;
	                $output['confidentialite']  = $row->confidentialite;

	                $output['description']   = $row->description;
	                $output['mission']       = $row->mission;
	                $output['objectif']      = $row->objectif;
	                $output['blog']      = $row->blog;


	                if($row->icone != '')  
	                {  
	                     $output['user_image'] = '<img src="'.base_url().'upload/tbl_info/'.$row->icone.'" class="img-thumbnail" width="70" height="70" /><input type="hidden" name="hidden_user_image" value="'.$row->icone.'" />';  
	                }  
	                else  
	                {  
	                     $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
	                }  
	           }  
	           echo json_encode($output);  
	      }  


	      function operation_tbl_info(){


	          if($_FILES["user_image"]["size"] > 0)  
	          {  
	               $insert_data = array(  
	               'nom_site'             =>     $this->input->post('nom_site'),  
	               'tel1'               =>     $this->input->post("tel1"), 
	               'tel2'                 =>     $this->input->post('tel2'), 
	               'adresse'              =>     $this->input->post("adresse"), 
	               'facebook'             =>     $this->input->post("facebook"), 
	               'twitter'              =>     $this->input->post("twitter"),
	               'linkedin'             =>     $this->input->post("linkedin"), 
	               'email'              =>     $this->input->post("email"),
	               'termes'               =>     $this->input->post("termes"),
	               'confidentialite'        =>     $this->input->post("confidentialite"), 
	               'description'        =>     $this->input->post("description"), 
	               'mission'            =>     $this->input->post("mission"), 
	               'objectif'           =>     $this->input->post("objectif"),
	               'blog'               =>     $this->input->post("blog"), 
	               'icone'              =>     $this->upload_image_tbl_info()
	          );    
	          }  
	          else  
	          {  
	               $user_image = "icone-user.png";  
	               $insert_data = array(  
	               'nom_site'           =>     $this->input->post('nom_site'),  
	               'tel1'               =>     $this->input->post("tel1"), 
	               'tel2'               =>     $this->input->post('tel2'), 
	               'adresse'            =>     $this->input->post("adresse"), 
	               'facebook'           =>     $this->input->post("facebook"), 
	               'twitter'            =>     $this->input->post("twitter"),
	               'linkedin'           =>     $this->input->post("linkedin"), 
	               'email'              =>     $this->input->post("email"),
	               'termes'             =>     $this->input->post("termes"),
	               'confidentialite'    =>     $this->input->post("confidentialite"), 
	               'description'        =>     $this->input->post("description"), 
	               'mission'            =>     $this->input->post("mission"), 
	               'objectif'           =>     $this->input->post("objectif"), 
	               'blog'               =>     $this->input->post("blog"), 
	               'icone'              =>     $user_image
	          );   
	          }

	        
	         
	        $requete=$this->crud_model->insert_tbl_info($insert_data);
	        echo("Ajout information avec succès");
	        
	      }

	      function modification_tbl_info(){
	  
	          if($_FILES["user_image"]["size"] > 0)  
	          {  
	               $updated_data = array(  
	               'nom_site'             =>     $this->input->post('nom_site'),  
	               'tel1'               =>     $this->input->post("tel1"), 
	               'tel2'                 =>     $this->input->post('tel2'), 
	               'adresse'              =>     $this->input->post("adresse"), 
	               'facebook'             =>     $this->input->post("facebook"), 
	               'twitter'              =>     $this->input->post("twitter"),
	               'linkedin'             =>     $this->input->post("linkedin"), 
	               'email'              =>     $this->input->post("email"),
	               'termes'               =>     $this->input->post("termes"),
	               'confidentialite'        =>     $this->input->post("confidentialite"), 
	               'description'        =>     $this->input->post("description"), 
	               'mission'            =>     $this->input->post("mission"), 
	               'objectif'           =>     $this->input->post("objectif"),
	               'blog'               =>     $this->input->post("blog"), 
	               'icone'                  =>     $this->upload_image_tbl_info()
	          );    
	          }  
	          else  
	          {  
	               $updated_data = array(  
	               'nom_site'             =>     $this->input->post('nom_site'),  
	               'tel1'               =>     $this->input->post("tel1"), 
	               'tel2'                 =>     $this->input->post('tel2'), 
	               'adresse'              =>     $this->input->post("adresse"), 
	               'facebook'             =>     $this->input->post("facebook"), 
	               'twitter'              =>     $this->input->post("twitter"),
	               'linkedin'             =>     $this->input->post("linkedin"), 
	               'email'              =>     $this->input->post("email"),
	               'termes'               =>     $this->input->post("termes"),
	               'description'        =>     $this->input->post("description"), 
	               'mission'            =>     $this->input->post("mission"), 
	               'objectif'           =>     $this->input->post("objectif"), 
	               'blog'               =>     $this->input->post("blog"),
	               'confidentialite'        =>     $this->input->post("confidentialite")
	          );    
	          }
	  
	          $this->crud_model->update_tbl_info($this->input->post("idinfo"), $updated_data);

	          echo("modification avec succès");
	      }

	      


	      function supression_tbl_info(){
	 
	          $this->crud_model->delete_tbl_info($this->input->post("idinfo"));

	          echo("suppression avec succès");
	        
	      }

	      // fin script tbl_info


	    // script de galery produit en stock

	    function pagination_view_sortie()
		{

		  $this->load->library("pagination");
		  $config = array();
		  $config["base_url"] = "#";
		  $config["total_rows"] = $this->crud_model->count_all_view_sortie();
		  $config["per_page"] = 10;
		  $config["uri_segment"] = 3;
		  $config["use_page_numbers"] = TRUE;
		  $config["full_tag_open"] = '<ul class="nav pagination">';
		  $config["full_tag_close"] = '</ul>';
		  $config["first_tag_open"] = '<li class="page-item">';
		  $config["first_tag_close"] = '</li>';
		  $config["last_tag_open"] = '<li class="page-item">';
		  $config["last_tag_close"] = '</li>';
		  $config['next_link'] = '<li class="page-item active"><i class="btn btn-info">&gt;&gt;</i>';
		  $config["next_tag_open"] = '<li class="page-item">';
		  $config["next_tag_close"] = '</li>';
		  $config["prev_link"] = '<li class="page-item active"><i class="btn btn-info">&lt;&lt;</i>';
		  $config["prev_tag_open"] = "<li class='page-item'>";
		  $config["prev_tag_close"] = "</li>";
		  $config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
		  $config["cur_tag_close"] = "</a></li>";
		  $config["num_tag_open"] = "<li class='page-item'>";
		  $config["num_tag_close"] = "</li>";
		  $config["num_links"] = 1;
		  $this->pagination->initialize($config);
		  $page = $this->uri->segment(3);
		  $start = ($page - 1) * $config["per_page"];

		  $output = array(
		   'pagination_link'  => $this->pagination->create_links(),
		   'country_table'   => $this->crud_model->fetch_details_view_sortie($config["per_page"], $start)
		  );
		  echo json_encode($output);
		}


		function fetch_search_view_sortie()
		{
		  $output = '';
		  $query = '';
		  if($this->input->post('query'))
		  {
		   $query = $this->input->post('query');
		  }
		  $data = $this->crud_model->fetch_data_search_view_sortie($query);
		  $output .= '
	      <table class="table-striped  nk-tb-list nk-tb-ulist dataTable no-footer" data-auto-responsive="false" id="user_data" role="grid" aria-describedby="DataTables_Table_1_info">
	          <thead>  
	            <tr>         
	               <th width="10%">Image</th>
	               <th width="25%">Nom du produit</th>  
	               <th width="10%">Prix</th>
	               <th width="10%">Qte en stock</th>
	                 
	               <th width="10%">Qte en sortie</th>

	               <th width="25%">Mise à jour</th>

	               <th width="5%">Modifier</th> 
	               <th width="5%">Supprimer</th>  
	            </tr> 
	         </thead> 
	      ';
	      if ($data->num_rows() < 0) {
	        
	        $output .= '
	         <tr>
	          <td colspan="8">Aucune donnée n\'est à présent</td>

	         </tr>
	         ';
	      }
	      else{

	        foreach($data->result() as $row)
	        {
	         $output .= '
	         <tr>
	          <td><img src="'.base_url().'upload/product/'.$row->product_image.'" class="img img-responsive img-thumbnail" width="50" height="35" style="border-radius:50%;" /></td>

	          <td>'.nl2br(substr($row->product_name, 0,10)).'...'.'</td>
	          <td>'.nl2br(substr($row->product_price, 0,10)).' $'.'</td>
	          <td>'.nl2br(substr($row->Qte, 0,10)).'...'.'</td>
	          <td>'.nl2br(substr($row->QteEntree, 0,10)).'...'.'</td>
	          <td>'.nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)).'</td>

	          <td><button type="button" name="update" ids="'.$row->ids.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button></td>
	          <td><button type="button" name="delete" ids="'.$row->ids.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button></td>
	          

	         </tr>
	         ';
	        }
	      }
	      $output .= '
	          <tfoot>  
	                <tr>         
	                  <th width="10%">Image</th>
	                  <th width="25%">Nom du produit</th>  
	                  <th width="10%">Prix</th>
	                  <th width="10%">Qte en stock</th>
	                   
	                  <th width="10%">Qte en sortie</th>

	                  <th width="25%">Mise à jour</th>

	                  
	                  <th width="5%">Modifier</th> 
	                  <th width="5%">Supprimer</th>      
	              </tr> 
	         </tfoot>   
	            
	        </table>';
		  echo $output;
		}



        function fetch_entree(){  

           $fetch_data = $this->crud_model->make_datatables_entree();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = '<img src="'.base_url().'upload/product/'.$row->product_image.'" class="img img-responsive img-thumbnail" width="50" height="35" style="border-radius:50%;" />';  
                $sub_array[] = nl2br(substr($row->product_name, 0,10)).'...'; 
                $sub_array[] = nl2br(substr($row->product_price, 0,10)).' $';  
                $sub_array[] = nl2br(substr($row->Qte, 0,10)).'...'; 

                $sub_array[] = nl2br(substr($row->QteEntree, 0,10)).'...';

                $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
                
                $sub_array[] = '<button type="button" name="update" ide="'.$row->ide.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
                $sub_array[] = '<button type="button" name="delete" ide="'.$row->ide.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                =>     intval($_POST["draw"]),  
                "recordsTotal"        =>     $this->crud_model->get_all_data_entree(),  
                "recordsFiltered"     =>     $this->crud_model->get_filtered_data_entree(),  
                "data"                =>     $data  
           );  
           echo json_encode($output);  
        }

      function fetch_single_entree()  
      {  
           $output = array();  
           $data = $this->crud_model->fetch_single_entree($_POST["ide"]);  
           foreach($data as $row)  
           {  
                $output['product_name'] 		= $row->product_name;  
                $output['product_price'] 		= $row->product_price; 
                $output['product_id'] 			= $row->product_id;

                $output['Qte'] 					= $row->Qte;
                $output['QteEntree'] 			= $row->QteEntree;
                

           }  
           echo json_encode($output);  
      }  


      function operation_entree(){

      	    $insert_data = array(  
	           'product_id'      =>    $this->input->post('product_id'),  
	           'QteEntree'      =>     $this->input->post('QteEntree') 
		  	);

		  	$updated_data = array(  
	           'Qte'      =>    $this->input->post('qte_disponsible')
		  	);  
	       
	      	$requete=$this->crud_model->insert_entree($insert_data);
	      	if ($requete > 0) {
	      		$this->crud_model->update_product($this->input->post("product_id"), $updated_data);
	      	}

	      	echo("Ajout information avec succès");
	      
      }

      function modification_entree(){
  
        $updated_data = array(  
           'product_id'     =>    $this->input->post('product_id'),  
           'QteEntree'      =>     $this->input->post('QteEntree') 
	  	);

        $this->crud_model->update_entree($this->input->post("ide"), $updated_data);

        echo("modification avec succès");
      }

      function supression_entree(){
 
          $this->crud_model->delete_entree($this->input->post("ide"));

          echo("suppression avec succès");
        
      }
	  // fin de script entree product

	  // script de sortie produit en stock
       function fetch_sortie(){  

           $fetch_data = $this->crud_model->make_datatables_sortie();  
           $data = array();  
           foreach($fetch_data as $row)  
           {  
                $sub_array = array();  
                $sub_array[] = '<img src="'.base_url().'upload/product/'.$row->product_image.'" class="img img-responsive img-thumbnail" width="50" height="35" style="border-radius:50%;" />';  
                $sub_array[] = nl2br(substr($row->product_name, 0,10)).'...'; 
                $sub_array[] = nl2br(substr($row->product_price, 0,10)).' $';  
                $sub_array[] = nl2br(substr($row->Qte, 0,10)).'...'; 

                $sub_array[] = nl2br(substr($row->QteEntree, 0,10)).'...';

                $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
                
                $sub_array[] = '<button type="button" name="update" ids="'.$row->ids.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
                $sub_array[] = '<button type="button" name="delete" ids="'.$row->ids.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
                $data[] = $sub_array;  
           }  
           $output = array(  
                "draw"                =>     intval($_POST["draw"]),  
                "recordsTotal"        =>     $this->crud_model->get_all_data_sortie(),  
                "recordsFiltered"     =>     $this->crud_model->get_filtered_data_sortie(),  
                "data"                =>     $data  
           );  
           echo json_encode($output);  
       }

      function fetch_single_sortie()  
      {  
           $output = array();  
           $data = $this->crud_model->fetch_single_sortie($_POST["ids"]);  
           foreach($data as $row)  
           {  
                $output['product_name'] 		= $row->product_name;  
                $output['product_price'] 		= $row->product_price; 
                $output['product_id'] 			= $row->product_id;

                $output['Qte'] 					= $row->Qte;
                $output['QteEntree'] 			= $row->QteEntree;
                

           }  
           echo json_encode($output);  
      }  


      function operation_sortie(){

      	    $insert_data = array(  
	           'product_id'      =>    $this->input->post('product_id'),  
	           'QteEntree'      =>     $this->input->post('QteEntree') 
		  	);

		  	$updated_data = array(  
	           'Qte'      =>    $this->input->post('qte_disponsible')
		  	);  
	       
	      	$requete=$this->crud_model->insert_sortie($insert_data);
	      	if ($requete > 0) {
	      		$this->crud_model->update_product($this->input->post("product_id"), $updated_data);
	      	}

	      	echo("Ajout information avec succès");
	      
      }

      function modification_sortie(){
  
        $updated_data = array(  
           'product_id'     =>    $this->input->post('product_id'),  
           'QteEntree'      =>     $this->input->post('QteEntree') 
	  	);

        $this->crud_model->update_sortie($this->input->post("ids"), $updated_data);

        echo("modification avec succès");
      }

      function supression_sortie(){
 
          $this->crud_model->delete_sortie($this->input->post("ids"));
          echo("suppression avec succès");
        
      }
	  // fin de script sortie product









      function upload_image_users()  
      {  
           if(isset($_FILES["user_image"]))  
           {  
                $extension = explode('.', $_FILES['user_image']['name']);  
                $new_name = rand() . '.' . $extension[1];  
                $destination = './upload/photo/' . $new_name;  
                move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
                return $new_name;  
           }  
      }

      function upload_image_equipe()  
      {  
           if(isset($_FILES["user_image"]))  
           {  
                $extension = explode('.', $_FILES['user_image']['name']);  
                $new_name = rand() . '.' . $extension[1];  
                $destination = './upload/equipe/' . $new_name;  
                move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
                return $new_name;  
           }  
      }

      function upload_image_tbl_info()  
  	  {  
  	       if(isset($_FILES["user_image"]))  
  	       {  
  	            $extension = explode('.', $_FILES['user_image']['name']);  
  	            $new_name = rand() . '.' . $extension[1];  
  	            $destination = './upload/tbl_info/' . $new_name;  
  	            move_uploaded_file($_FILES['user_image']['tmp_name'], $destination);  
  	            return $new_name;  
  	       }  
  	  }

  	// script pour formulaire de contact 
    // ajout des contacts
    function fetch_contact(){  

       $fetch_data = $this->crud_model->make_datatables_contact();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  

          if ($row->fichier != '') {
            $etat = '<a href="'.base_url().'upload/contact/'.$row->fichier.'" class="badge badge-white"><i class="fa fa-file"></i></a>';
          }
          else{
            $etat = '';
          }

            $sub_array = array();

            $sub_array[] = '
            <input type="checkbox" class="delete_checkbox" value="'.$row->email.'" />
            ';  
              
            $sub_array[] = nl2br(substr($row->nom, 0,20)).'...';  
            $sub_array[] = nl2br(substr($row->sujet, 0,20)).'...'; 
            $sub_array[] = $row->email; 
            $sub_array[] = nl2br(substr($row->message, 0,50)).'...';
            $sub_array[] = substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23);

            $sub_array[] = $etat; 

            $sub_array[] = '<button type="button" name="delete" idcontact="'.$row->id.'" class="btn btn-dark btn-circle btn-sm update"><i class="fa fa-comment-o"></i></button>'; 

            $sub_array[] = '<button type="button" name="delete" idcontact="'.$row->id.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_contact(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_contact(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_contact()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_contact($this->input->post('idcontact'));  
       foreach($data as $row)  
       {  
            $output['nom'] = $row->nom;  
            $output['message'] = $row->message;
            $output['email'] = $row->email;
            $output['sujet'] = $row->sujet; 

       }  
       echo json_encode($output);  
  } 

  function operation_contact(){

    $insert_data = array(  
         'nom'          =>     $this->input->post('name'),  
         'sujet'       =>     $this->input->post("subject"),
         'email'         =>     $this->input->post("email"),  
         'message'       =>     $this->input->post("message")  
         
  );  
     
    $requete=$this->crud_model->insert_contact($insert_data);
    echo("Ajout message  avec succès");
    
  }

  
  function supression_contact()
  {

      $this->crud_model->delete_contact($this->input->post("idcontact"));

      echo("suppression avec succès");
    
  }

    function infomation_par_mail()
    {
        if($this->input->post('checkbox_value'))
        {
           $id = $this->input->post('checkbox_value');
           for($count = 0; $count < count($id); $count++)
           {
               
                $mail    = $id[$count];
                $website = $this->email_sites;

                $to =$id[$count];
                $subject = $this->input->post('sujet');
                $message2 = $this->input->post('message');
                 

                $headers= "MIME Version 1.0\r\n";
                $headers .= "Content-type: text/html; charset=UTF-8\r\n";
                $headers .= "From: no-reply@etskase.com" . "\r\n" ."Reply-to: sumailiroger681@gmail.com"."\r\n"."X-Mailer: PHP/".phpversion();

                mail($to,$subject,$message2,$headers);

           }

           if(mail($to,$subject,$message2,$headers) > 0){
                echo("message envoyé avec succès");
           } 
           else {
                echo("échec lors de l'envoie de message!!!!!!!!!!!!");
           }


        }
    }
     // fin contact

     // script de equipe
	function fetch_equipe(){  

       $fetch_data = $this->crud_model->make_datatables_equipe();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array(); 

            $sub_array[] = '<img src="'.base_url().'upload/equipe/'.$row->logo.'" class="table-user-thumb" style="border-radius: 50%; width: 50px; height: 30px;" />'; 
           
            $sub_array[] = nl2br(substr($row->nom, 0,50)); 
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idequipe="'.$row->idequipe.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idequipe="'.$row->idequipe.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_equipe(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_equipe(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_equipe()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_equipe($_POST["idequipe"]);  
       foreach($data as $row)  
       {  
            $output['nom']    = $row->nom;  
            if($row->logo != '')  
            {  
                 $output['user_image'] = '<img src="'.base_url().'upload/equipe/'.$row->logo.'" class="img-thumbnail" width="300" height="250" /><input type="hidden" name="hidden_user_image" value="'.$row->logo.'" />';  
            }  
            else  
            {  
                 $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
            }  
            
           
       }  
       echo json_encode($output);  
  }  

  function fetch_single_equipe_by_name()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_equipe_name($_POST["nom"]);  
       foreach($data as $row)  
       {  
            $output['nom']    = $row->nom;  
            if($row->logo != '')  
            {  
                 $output['user_image'] = '<img src="'.base_url().'upload/equipe/'.$row->logo.'" class="img-thumbnail" width="300" height="250" /><input type="hidden" name="hidden_user_image" value="'.$row->logo.'" />';  
            }  
            else  
            {  
                 $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
            }  
            
           
       }  
       echo json_encode($output);  
  }  


  function operation_equipe(){

    $data['nom'] = $this->input->post('nom');

    if($_FILES["user_image"]["size"] > 0)  
  	{  
  		$data['logo'] = $this->upload_image_equipe();
      
  	}
  	else{
  		$data['logo'] = 'logo.jpg';
  	}

    $requete=$this->crud_model->insert_equipe($data);
    echo("Ajout information avec succès");
      
  }

  function modification_equipe(){

    $data['nom'] = $this->input->post('nom');

    if($_FILES["user_image"]["size"] > 0)  
  	{  
  		$data['logo'] = $this->upload_image_equipe();
      
  	}
  	
    $this->crud_model->update_equipe($this->input->post("idequipe"), $data);

    echo("modification avec succès");
  }

  function supression_equipe(){

      $this->crud_model->delete_equipe($this->input->post("idequipe"));
      echo("suppression avec succès");
    
  }

  // fin equipe

  // script de matchs
	function fetch_matchs(){  

       $fetch_data = $this->crud_model->make_datatables_matchs();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array(); 

           	$sub_array[] = nl2br(substr($row->nomMatch, 0,50));
            $sub_array[] = nl2br(substr($row->nom_equipe1, 0,50)); 
            $sub_array[] = nl2br(substr($row->equipe2, 0,50));

            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->jour)), 0, 23));
            $sub_array[] = nl2br(substr($row->heure, 0,50));  

            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idmath="'.$row->idmath.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idmath="'.$row->idmath.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_matchs(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_matchs(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_matchs()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_matchs($_POST["idmath"]);  
       foreach($data as $row)  
       {  
            $output['nomMatch']    		= $row->nomMatch;
            $output['equipe1']    		= $row->equipe1;
            $output['equipe2']    		= $row->equipe2;
            $output['jour']    			= $row->jour;
            $output['heure']    		= $row->heure;

       }  
       echo json_encode($output);  
  }  


  function operation_matchs(){

    $data['nomMatch'] = $this->input->post('nomMatch');
    $data['equipe1'] = $this->input->post('equipe1');
    $data['equipe2'] = $this->input->post('equipe2');
    $data['jour'] = $this->input->post('jour');
    $data['heure'] = $this->input->post('heure');

    $requete=$this->crud_model->insert_matchs($data);
    echo("Ajout information avec succès");
      
  }

  function modification_matchs(){

    $data['nomMatch'] = $this->input->post('nomMatch');
    $data['equipe1'] = $this->input->post('equipe1');
    $data['equipe2'] = $this->input->post('equipe2');
    $data['jour'] = $this->input->post('jour');
    $data['heure'] = $this->input->post('heure');
  	
    $this->crud_model->update_matchs($this->input->post("idmath"), $data);

    echo("modification avec succès");
  }

  function supression_matchs(){

      $this->crud_model->delete_matchs($this->input->post("idmath"));
      echo("suppression avec succès");
    
  }

  // fin equipe

  // pagination user to sms 
    function pagination_message_users()
   {

    $this->load->library("pagination");
    $config = array();
    $config["base_url"] = "#";
    $config["total_rows"] = $this->crud_model->count_all_message_users();
    $config["per_page"] = 4;
    $config["uri_segment"] = 3;
    $config["use_page_numbers"] = TRUE;
    $config["full_tag_open"] = '<ul class="pagination pagination2">';
    $config["full_tag_close"] = '</ul>';
    $config["first_tag_open"] = '<li class="page-item">';
    $config["first_tag_close"] = '</li>';
    $config["last_tag_open"] = '<li class="page-item">';
    $config["last_tag_close"] = '</li>';
    $config['next_link'] = '<li class="page-item active"><i class="btn btn-info">&gt;&gt;</i>';
    $config["next_tag_open"] = '<li class="page-item">';
    $config["next_tag_close"] = '</li>';
    $config["prev_link"] = '<li class="page-item active"><i class="btn btn-info">&lt;&lt;</i>';
    $config["prev_tag_open"] = "<li class='page-item'>";
    $config["prev_tag_close"] = "</li>";
    $config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
    $config["cur_tag_close"] = "</a></li>";
    $config["num_tag_open"] = "<li class='page-item'>";
    $config["num_tag_close"] = "</li>";
    $config["num_links"] = 1;
    $this->pagination->initialize($config);
    $page = $this->uri->segment(3);
    $start = ($page - 1) * $config["per_page"];

    $output = array(
     'pagination_link'  => $this->pagination->create_links(),
     'country_table'   => $this->crud_model->fetch_detailsmessage_users($config["per_page"], $start)
    );
    echo json_encode($output);
  }

   function search_message_users()
   {
	  $output = '';
	  $query = '';

	  if($this->input->post('query'))
	  {
	   $query = $this->input->post('query');
	  }
	  $data = $this->crud_model->fetch_data_sms_users($query);
	   $output .= '
   
	    <table class="table-striped table-bordered nk-tb-list nk-tb-ulist dataTable no-footer" data-auto-responsive="true" id="user_data" role="grid" aria-describedby="DataTables_Table_1_info">
	     <theader>
	       <tr>
	        <th width="5%">Selectionner</th>
	        <th width="5%">Avatar</th>
	        <th width="20%">Nom complet</th>
	        <th width="15%">Télephone</th>
	        <th width="10%">Statut</th>
	        <th width="20%">Email</th>
	        <th width="5%">Sexe</th>
	        <th width="10%">Adresse</th>

	        <th width="5%">Editer</th>
	        <th width="5%">Supprimer</th>
	        
	        
	       </tr>
	     <theader>
	     <tbody>
	    ';
	      foreach($data->result() as $row)
	      {

	          $btn1 = '<button type="button" name="update" id="'.$row->id.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>'; 

	          $btn2= '<button type="button" name="delete" id="'.$row->id.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';
	                  

	          $etat ='<span class="badge badge-warning"><i class="fa fa-user"></i> Client </span>';

	          $link = '<a href="tel:'.$row->telephone.'" class="text-primary"><i class="fa fa-phone"></i></a>
	           <input type="checkbox" name="tel" value="'.$row->telephone.'" class="tels delete_checkbox">
	          ';

	           $email = '<a href="mailto:'.$row->email.'" class="text-primary"><i class="fa fa-google mr-1"></i> '.$row->email.'</a>
	          
	          ';

	          if ($row->full_adresse !='') {
	            # code...
	            $adresse = substr($row->full_adresse, 0,20).'...';
	          }
	          else{
	            $adresse = "Inconue!";
	          }

	          if ($row->sexe !='') {
	            # code...
	            $sexe = $row->sexe;
	          }
	          else{
	            $sexe = "Inconue!";
	          }

	           $output .= '
	           <tr>
	            <td>'.$link.'</td>
	            <td><img src="'.base_url().'upload/photo/'.$row->image.'" class="table-user-thumb" style="border-radius: 50%; width: 50px; height: 30px;" /></td>

	             <td>'.substr($row->first_name.' '.$row->last_name, 0,20).'...</td>

	            <td>'.$row->telephone.'</td>
	            <td>'.$etat.'</td>
	            <td>'.$email.'</td>
	            <td>'.$sexe.'</td>

	            <td>'.$adresse.'</td>

	            <td>'.$btn1.'</td>
	            <td>'.$btn2.'</td>
	           
	           </tr>
	           ';

	      }
	        $output .= '
	            <tbody>
	            <tfooter>
	             <tr>
	              <th width="5%">Selectionner</th>
	              <th width="5%">Avatar</th>
	              <th width="20%">Nom complet</th>
	              <th width="15%">Télephone</th>
	              <th width="10%">Statut</th>
	              <th width="20%">Email</th>
	              <th width="5%">Sexe</th>
	              <th width="10%">Adresse</th>

	              <th width="5%">Editer</th>
	              <th width="5%">Supprimer</th>
	              
	             </tr>
	           <tfooter>
	        </table>';
	  	echo $output;
	}


	function operation_users_client(){

        $user_image = "icone-user.png";  
	    $insert_data = array(  
	       'first_name'     =>     $this->input->post('first_name'),  
	       'last_name'      =>     $this->input->post("last_name"),
	       'email'          =>     $this->input->post("email"),
	       'telephone'      =>     $this->input->post("telephone"),
	       'full_adresse'   =>     $this->input->post("full_adresse"),
	       'date_nais'      =>     $this->input->post("date_nais"), 
	       'idrole'         =>     $this->input->post("idrole"),
	       'sexe'           =>     $this->input->post("sexe"),
	       'image'          =>     $user_image
	    );   
    $requete=$this->crud_model->insert_users($insert_data);
    echo("Ajout information avec succès");
    
  }

  function modification_users_client(){

       $updated_data = array(  
	       'first_name'     =>     $this->input->post('first_name'),  
	       'last_name'      =>     $this->input->post("last_name"),
	       'email'          =>     $this->input->post("email"),
	       'telephone'      =>     $this->input->post("telephone"),
	       'full_adresse'   =>     $this->input->post("full_adresse"),
	       'date_nais'      =>     $this->input->post("date_nais"), 
	       'sexe'           =>     $this->input->post("sexe"),
	       'idrole'         =>     $this->input->post("idrole")
	    );   

      
      $this->crud_model->update_users($this->input->post("id"), $updated_data);

      echo("modification avec succès");
    }


    // script de stade
	function fetch_stade(){  

       $fetch_data = $this->crud_model->make_datatables_stade();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
           
            $sub_array[] = nl2br(substr($row->nom, 0,50)); 
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idstade="'.$row->idstade.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idstade="'.$row->idstade.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_stade(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_stade(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
	}

	  function fetch_single_stade()  
	  {  
	       $output = array();  
	       $data = $this->crud_model->fetch_single_stade($_POST["idstade"]);  
	       foreach($data as $row)  
	       {  
	            $output['nom']    = $row->nom;  
	            
	           
	       }  
	       echo json_encode($output);  
	  }  


	  function operation_stade(){

	    $insert_data = array(  
	           'nom'            =>     $this->input->post('nom')
	    );  

	      $requete=$this->crud_model->insert_stade($insert_data);
	      echo("Ajout information avec succès");
	      
	  }

	  function modification_stade(){

	      $updated_data = array(  
	           'nom'            =>     $this->input->post('nom')
	    );

	      $this->crud_model->update_stade($this->input->post("idstade"), $updated_data);

	      echo("modification avec succès");
	  }

	  function supression_stade(){

	      $this->crud_model->delete_stade($this->input->post("idstade"));
	      echo("suppression avec succès");
	    
	  }

	  // fin stade

	// script de place
	function fetch_place(){  

       $fetch_data = $this->crud_model->make_datatables_place();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
            $sub_array[] = nl2br(substr($row->nomPlace, 0,50));
            $sub_array[] = nl2br(substr($row->nom, 0,50)); 
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idplace="'.$row->idplace.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idplace="'.$row->idplace.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_place(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_place(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
	}

	  function fetch_single_place()  
	  {  
	       $output = array();  
	       $data = $this->crud_model->fetch_single_place($_POST["idplace"]);  
	       foreach($data as $row)  
	       {  
	            $output['nom']    		= $row->nom; 
	            $output['nomPlace']    	= $row->nomPlace;
	            $output['idstade']    	= $row->idstade; 
	            
	           
	       }  
	       echo json_encode($output);  
	  }  


	  function operation_place(){

	  	$idstade = $this->input->post('idstade');
	  	$nomPlace = $this->input->post('nomPlace');

	  	$query = $this->crud_model->fetch_single_place_in_stadium($idstade,$nomPlace);
	  	if ($query > 0) {
	  		# code...
	  		echo "echec!!!";
	  	}
	  	else{

		    $insert_data = array(  
		           'idstade'             =>     $this->input->post('idstade'),
		           'nomPlace'            =>     $this->input->post('nomPlace')
		    );  

		    $requete=$this->crud_model->insert_place($insert_data);
		    echo("Ajout information avec succès");
	  	}

	      
	  }

	  function modification_place(){

	      $updated_data = array(  
	          'idstade'             =>     $this->input->post('idstade'),
	          'nomPlace'            =>     $this->input->post('nomPlace')
	      );

	      $this->crud_model->update_place($this->input->post("idplace"), $updated_data);

	      echo("modification avec succès");
	  }

	  function supression_place(){

	      $this->crud_model->delete_place($this->input->post("idplace"));
	      echo("suppression avec succès");
	    
	  }
	  // fin place

	// script de reservation
	function fetch_reservation(){  

       $fetch_data = $this->crud_model->make_datatables_reservation();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
            $sub_array[] = nl2br(substr($row->nomPlace, 0,50));
            $sub_array[] = nl2br(substr($row->nom, 0,50)); 
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idplace="'.$row->idplace.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idplace="'.$row->idplace.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_place(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_place(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
	}

	  function fetch_single_reservation()  
	  {  
	       $output = array();  
	       $data = $this->crud_model->fetch_single_reservation($_POST["idreservation"]);  
	       foreach($data as $row)  
	       {  
	            $output['idclient']    			= $row->idclient;
	            $output['idmath']    			= $row->idmath;
	            $output['montant']    			= $row->montant;
	            $output['idstade']    			= $row->idstade;
	            $output['idplace']    			= $row->idplace;
	            $output['etat_reservation']    	= $row->etat_reservation;
	            $output['codeReservation']    	= $row->codeReservation;
	            $output['nomMatch']    			= $row->nomMatch;
	            $output['first_name']    		= $row->first_name; 
	            $output['last_name']   			= $row->last_name;
	            $output['telephone']    		= $row->telephone; 
	            
	           
	       }  
	       echo json_encode($output);  
	  }  


	  function operation_reservation(){

	  	$idstade 	= $this->input->post('idstade');
	  	$idplace 	= $this->input->post('idplace');
	  	$idclient 	= $this->input->post('idclient');
	  	$idmath 	= $this->input->post('idmath');
	  	
	  	$codeReservation = str_shuffle(substr("abcdefghijklmnopqrstuvwxyz123456789", 0,10));

	  	$query = $this->crud_model->fetch_single_reservation_in_stadium($idstade, $idplace, $idmath);
	  	if ($query > 0) {
	  		# code...
	  		echo "echec!!!";
	  	}
	  	else{

		    $insert_data = array(  
		           'idclient'            =>     $this->input->post('idclient'),
		           'idmath'              =>     $this->input->post('idmath'),
		           'montant'             =>     $this->input->post('montant'),
		           'idstade'             =>     $this->input->post('idstade'),
		           'idplace'             =>     $this->input->post('idplace'),
		           'etat_reservation'    =>     0,
		           'codeReservation'  	 =>     $codeReservation
		          
		    );  

		    $requete=$this->crud_model->insert_reservation($insert_data);
		    echo("Ajout information avec succès");
	  	}

	      
	  }

	  function modification_reservation(){

	      $updated_data = array(  
	      	   'idclient'            =>     $this->input->post('idclient'),
	           'idmath'              =>     $this->input->post('idmath'),
	           'montant'             =>     $this->input->post('montant'),
	           'idstade'             =>     $this->input->post('idstade'),
	           'idplace'             =>     $this->input->post('idplace'),
	      );

	      $this->crud_model->update_reservation($this->input->post("idreservation"), $updated_data);

	      echo("modification avec succès");
	  }

	   function modification_Etat_reservation(){

	      $updated_data = array(  
	      	   'etat_reservation'    =>     1,
	      );

	      $this->crud_model->update_reservation($this->input->post("idreservation"), $updated_data);

	      echo("Activation avec succès");
	  }

	  function supression_reservation(){

	      $this->crud_model->delete_reservation($this->input->post("idreservation"));
	      echo("suppression avec succès");
	    
	  }

	   // pagination user to sms 
    function pagination_reservation_client()
   {

    $this->load->library("pagination");
    $config = array();
    $config["base_url"] = "#";
    $config["total_rows"] = $this->crud_model->count_all_reservations();
    $config["per_page"] = 4;
    $config["uri_segment"] = 3;
    $config["use_page_numbers"] = TRUE;
    $config["full_tag_open"] = '<ul class="pagination pagination2">';
    $config["full_tag_close"] = '</ul>';
    $config["first_tag_open"] = '<li class="page-item">';
    $config["first_tag_close"] = '</li>';
    $config["last_tag_open"] = '<li class="page-item">';
    $config["last_tag_close"] = '</li>';
    $config['next_link'] = '<li class="page-item active"><i class="btn btn-info">&gt;&gt;</i>';
    $config["next_tag_open"] = '<li class="page-item">';
    $config["next_tag_close"] = '</li>';
    $config["prev_link"] = '<li class="page-item active"><i class="btn btn-info">&lt;&lt;</i>';
    $config["prev_tag_open"] = "<li class='page-item'>";
    $config["prev_tag_close"] = "</li>";
    $config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
    $config["cur_tag_close"] = "</a></li>";
    $config["num_tag_open"] = "<li class='page-item'>";
    $config["num_tag_close"] = "</li>";
    $config["num_links"] = 1;
    $this->pagination->initialize($config);
    $page = $this->uri->segment(3);
    $start = ($page - 1) * $config["per_page"];

    $output = array(
     'pagination_link'  => $this->pagination->create_links(),
     'country_table'   => $this->crud_model->fetch_detail_reservations($config["per_page"], $start)
    );
    echo json_encode($output);
  }

   function search_reservation_client()
   {
	  $output = '';
	  $query = '';

	  if($this->input->post('query'))
	  {
	   $query = $this->input->post('query');
	  }
	  $data = $this->crud_model->fetch_data_reservation($query);
	  $output .= '
   
    <table class="table-striped table-bordered nk-tb-list nk-tb-ulist dataTable no-footer" data-auto-responsive="true" id="user_data" role="grid" aria-describedby="DataTables_Table_1_info">
     <theader>
       <tr>
        <th width="5%">Selectionner</th>
        <th width="5%">Avatar</th>
        <th width="20%">Nom complet</th>
        <th width="15%">Rencontre</th>
        <th width="10%">Statut</th>
        <th width="20%">Jour</th>
        <th width="5%">Heure</th>
        <th width="10%">Place</th>

        <th width="10%">Action</th>
        
        
       </tr>
     <theader>
     <tbody>
    ';
      foreach($data->result() as $row)
      {
          if ($row->etat_reservation ==0) {


          $link = '<a href="tel:'.$row->telephone.'" class="text-primary"><i class="fa fa-phone"></i></a>
           <input type="checkbox" name="tel" value="'.$row->telephone.'" class="tels mr-1 delete_checkbox">
            &nbsp;
            <a href="javascript:void(0);" idreservation="'.$row->idreservation.'" class="btn btn-dark btn-sm btn-circle valider"><i class="fa fa-check text-white"></i> </a>
           
          ';




            $etat_reservation = '
              <button type="button" name="update" idreservation="'.$row->idreservation.'" class="btn btn-warning btn-circle btn-sm update mr-2"><i class="fa fa-edit"></i></button>
                 
              <button type="button" name="delete" idreservation="'.$row->idreservation.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>
            ';
          }
          else{
              $etat_reservation = '
                 &nbsp;
                 <a href="javascript:void(0);" idreservation="'.$row->idreservation.'" class="btn btn-success btn-sm btn-sm"><i class="fa fa-check text-white"></i> valide</a>
              ';

              $link = '<a href="tel:'.$row->telephone.'" class="text-primary"><i class="fa fa-phone"></i></a>
               <input type="checkbox" name="tel" value="'.$row->telephone.'" class="tels mr-1 delete_checkbox">
                &nbsp;
               <a href="javascript:void(0);" idreservation="'.$row->idreservation.'" class="btn btn-success btn-circle btn-sm"><i class="fa fa-check text-white"></i></a>
              ';
          }
          

          $etat ='<span class="badge badge-warning"><i class="fa fa-user"></i> Client </span>';


           $email = '<a href="mailto:'.$row->email.'" class="text-primary"><i class="fa fa-google mr-1"></i> '.$row->email.'</a>
          
          ';

         
           $output .= '
           <tr>
            <td>'.$link.'</td>
            <td><img src="'.base_url().'upload/photo/'.$row->image.'" class="table-user-thumb" style="border-radius: 50%; width: 50px; height: 30px;" /></td>

             <td>'.substr($row->first_name.' '.$row->last_name, 0,20).'...</td>

            <td>'.$row->nomMatch.'</td>
            <td>'.$etat.'</td>
            <td>'.nl2br(substr(date(DATE_RFC822, strtotime($row->jour)), 0, 23)).'</td>
            <td>'.$row->heure.'</td>

            <td>'.$row->nomStade.' <br>'.$row->nomPlace.'</td>

            <td>'.$etat_reservation.'</td>
            
           </tr>
           ';

      }
        $output .= '
            <tbody>
            <tfooter>
             <tr>
              <th width="5%">Selectionner</th>
              <th width="5%">Avatar</th>
              <th width="20%">Nom complet</th>
              <th width="15%">Rencontre</th>
              <th width="10%">Statut</th>
              <th width="20%">Jour</th>
              <th width="5%">Heure</th>
              <th width="10%">Place</th>

              <th width="10%">Action</th>
              
              
             </tr>
           <tfooter>
        </table>';
	  	echo $output;
	}

	// fin reservation

	function fetch_single_personne_user()  
	{  
       $output = array();  
       $data = $this->crud_model->fetch_single_personne_user($_POST["id"]);  
       foreach($data as $row)  
       {  
            $output['first_name'] 		= $row->first_name;  
            $output['last_name'] 		= $row->last_name; 
            $output['email'] 			= $row->email; 
            $output['date_nais'] 		= $row->date_nais; 
            $output['telephone'] 		= $row->telephone; 
            $output['full_adresse'] 	= $row->full_adresse; 

            $output['sexe'] 			= $row->sexe;
            
            if($row->image != '')  
            {  
                $output['user_image'] = '<img src="'.base_url().'upload/photo/'.$row->image.'" class="img-thumbnail" width="70" height="70" /><input type="hidden" name="hidden_user_image" value="'.$row->image.'" />';  
            }  
            else  
            {  
                $output['user_image'] = '<input type="hidden" name="hidden_user_image" value="" />';  
            }  
       }  
       echo json_encode($output);  
	}

	function fetch_stade_requete(){
  	  if($this->input->post('idstade'))
	  {
	   	echo $this->crud_model->fetch_place_requete($this->input->post('idstade'));
	  }

    }

       // pagination user to sms 
    function pagination_reservation_client_ok()
   {

    $this->load->library("pagination");
    $config = array();
    $config["base_url"] = "#";
    $config["total_rows"] = $this->crud_model->count_all_reservations_ok();
    $config["per_page"] = 4;
    $config["uri_segment"] = 3;
    $config["use_page_numbers"] = TRUE;
    $config["full_tag_open"] = '<ul class="pagination pagination2">';
    $config["full_tag_close"] = '</ul>';
    $config["first_tag_open"] = '<li class="page-item">';
    $config["first_tag_close"] = '</li>';
    $config["last_tag_open"] = '<li class="page-item">';
    $config["last_tag_close"] = '</li>';
    $config['next_link'] = '<li class="page-item active"><i class="btn btn-info">&gt;&gt;</i>';
    $config["next_tag_open"] = '<li class="page-item">';
    $config["next_tag_close"] = '</li>';
    $config["prev_link"] = '<li class="page-item active"><i class="btn btn-info">&lt;&lt;</i>';
    $config["prev_tag_open"] = "<li class='page-item'>";
    $config["prev_tag_close"] = "</li>";
    $config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
    $config["cur_tag_close"] = "</a></li>";
    $config["num_tag_open"] = "<li class='page-item'>";
    $config["num_tag_close"] = "</li>";
    $config["num_links"] = 1;
    $this->pagination->initialize($config);
    $page = $this->uri->segment(3);
    $start = ($page - 1) * $config["per_page"];

    $output = array(
     'pagination_link'  => $this->pagination->create_links(),
     'country_table'   => $this->crud_model->fetch_detail_reservations_ok($config["per_page"], $start)
    );
    echo json_encode($output);
  }

   function search_reservation_client_ok()
   {
	  $output = '';
	  $query = '';

	  if($this->input->post('query'))
	  {
	   $query = $this->input->post('query');
	  }
	  $data = $this->crud_model->fetch_data_reservation_ok($query);
	  $output .= '
   
    <table class="table-striped table-bordered nk-tb-list nk-tb-ulist dataTable no-footer" data-auto-responsive="true" id="user_data" role="grid" aria-describedby="DataTables_Table_1_info">
     <theader>
       <tr>
        <th width="5%">Selectionner</th>
        <th width="5%">Avatar</th>
        <th width="20%">Nom complet</th>
        <th width="15%">Rencontre</th>
        <th width="10%">Statut</th>
        <th width="20%">Jour</th>
        <th width="5%">Heure</th>
        <th width="10%">Place</th>

        <th width="10%">Action</th>
        
        
       </tr>
     <theader>
     <tbody>
    ';
      foreach($data->result() as $row)
      {
          if ($row->etat_reservation ==0) {


          $link = '<a href="tel:'.$row->telephone.'" class="text-primary"><i class="fa fa-phone"></i></a>
           <input type="checkbox" name="tel" value="'.$row->telephone.'" class="tels mr-1 delete_checkbox">
            &nbsp;
            <a href="javascript:void(0);" idreservation="'.$row->idreservation.'" class="btn btn-dark btn-sm btn-circle valider"><i class="fa fa-check text-white"></i> </a>
           
          ';




            $etat_reservation = '
              
              <a type="button" href="'.base_url().'admin/pdf_billet/'.$row->codeReservation.'" class="btn btn-primary btn-circle btn-sm print"><i class="fa fa-print"></i></a>
            ';
          }
          else{
            $etat_reservation = '
              <a type="button" href="'.base_url().'admin/pdf_billet/'.$row->codeReservation.'" class="btn btn-primary btn-circle btn-sm print"><i class="fa fa-print"></i></a>
            ';

              $link = '<a href="tel:'.$row->telephone.'" class="text-primary"><i class="fa fa-phone"></i></a>
               <input type="checkbox" name="tel" value="'.$row->telephone.'" class="tels mr-1 delete_checkbox">
                &nbsp;
               <a href="javascript:void(0);" idreservation="'.$row->idreservation.'" class="btn btn-success btn-circle btn-sm"><i class="fa fa-check text-white"></i></a>
              ';
          }
          

          $etat ='<span class="badge badge-warning"><i class="fa fa-user"></i> Client </span>';


           $email = '<a href="mailto:'.$row->email.'" class="text-primary"><i class="fa fa-google mr-1"></i> '.$row->email.'</a>
          
          ';

         
           $output .= '
           <tr>
            <td>'.$link.'</td>
            <td><img src="'.base_url().'upload/photo/'.$row->image.'" class="table-user-thumb" style="border-radius: 50%; width: 50px; height: 30px;" /></td>

             <td>'.substr($row->first_name.' '.$row->last_name, 0,20).'...</td>

            <td>'.$row->nomMatch.'</td>
            <td>'.$etat.'</td>
            <td>'.nl2br(substr(date(DATE_RFC822, strtotime($row->jour)), 0, 23)).'</td>
            <td>'.$row->heure.'</td>

            <td>'.$row->nomStade.' <br>'.$row->nomPlace.'</td>

            <td>'.$etat_reservation.'</td>
            
           </tr>
           ';

      }
        $output .= '
            <tbody>
            <tfooter>
             <tr>
              <th width="5%">Selectionner</th>
              <th width="5%">Avatar</th>
              <th width="20%">Nom complet</th>
              <th width="15%">Rencontre</th>
              <th width="10%">Statut</th>
              <th width="20%">Jour</th>
              <th width="5%">Heure</th>
              <th width="10%">Place</th>

              <th width="10%">Action</th>
              
              
             </tr>
           <tfooter>
        </table>';
	  	echo $output;
	}

	// fin reservation

	// fultrage de match 
	// pagination user to sms 
    function pagination_match_billet()
	{
		sleep(1);
		$idmath = $this->input->post('idmath');

	    $this->load->library("pagination");
	    $config = array();
	    $config["base_url"] = "#";
	    $config["total_rows"] = $this->crud_model->count_all_match_bymatch($idmath);
	    $config["per_page"] = 3;
	    $config["uri_segment"] = 3;
	    $config["use_page_numbers"] = TRUE;
	    $config["full_tag_open"] = '<ul class="pagination pagination_filter">';
	    $config["full_tag_close"] = '</ul>';
	    $config["first_tag_open"] = '<li class="page-item">';
	    $config["first_tag_close"] = '</li>';
	    $config["last_tag_open"] = '<li class="page-item">';
	    $config["last_tag_close"] = '</li>';
	    $config['next_link'] = '<li class="page-item active"><i class="btn btn-info">&gt;&gt;</i>';
	    $config["next_tag_open"] = '<li class="page-item">';
	    $config["next_tag_close"] = '</li>';
	    $config["prev_link"] = '<li class="page-item active"><i class="btn btn-info">&lt;&lt;</i>';
	    $config["prev_tag_open"] = "<li class='page-item'>";
	    $config["prev_tag_close"] = "</li>";
	    $config["cur_tag_open"] = "<li class='page-item active'><a href='#' class='page-link'>";
	    $config["cur_tag_close"] = "</a></li>";
	    $config["num_tag_open"] = "<li class='page-item'>";
	    $config["num_tag_close"] = "</li>";
	    $config["num_links"] = 1;
	    $this->pagination->initialize($config);
	    $page = $this->uri->segment(3);
	    $start = ($page - 1) * $config["per_page"];

	    $output = array(
	     'pagination_link2'  => $this->pagination->create_links(),
	     'country_table'   => $this->crud_model->fetch_detailbille_de_match($config["per_page"], $start, $idmath)
	    );
	    echo json_encode($output);
	}

	 // filtrage de piement par date 
	function fetch_datebetwine_paiement_filtre()
	{
	    $output = '';
	    $query = '';
	    $total;
	    $jour1 =$this->input->post('jour1');
	    $jour2 =$this->input->post('jour2');
	    if($jour1 > $jour2)
	    {
	     $data = $this->crud_model->fetch_data_paiement_date($jour2, $jour1);
	     $total = $this->crud_model->fetch_sum_data_paiement_date($jour2, $jour1);
	    }
	    else{
	      $data = $this->crud_model->fetch_data_paiement_date($jour1, $jour2);
	      $total = $this->crud_model->fetch_sum_data_paiement_date($jour1, $jour2);
	    }

	    $money = $this->crud_model->fetch_data_paiement_date_montant($jour1, $jour2);
	    

	    $pdf_link ='<a class="btn btn-outline-warning pull-right mt-2 mb-2" 
	      href="'.base_url().'admin/pdf_liste_facture/'.$jour1.'/'.$jour2.' "><i class="fa fa-print mr-1"></i> PDF</a>';
	    
	    $output .= '

	    <div align="right" class="pull-right mb-2">
	   
	    '.$pdf_link.'
	    </div>
	   
	    <table class="table-striped table-bordered nk-tb-list nk-tb-ulist dataTable no-footer" data-auto-responsive="true" id="user_data" role="grid" aria-describedby="DataTables_Table_1_info">
	     <theader>
	       <tr>
	        <th width="5%">Selectionner</th>
	        <th width="5%">Avatar</th>
	        <th width="20%">Nom complet</th>
	        <th width="15%">Rencontre</th>
	        <th width="10%">Statut</th>
	        <th width="20%">Jour</th>
	        <th width="5%">Heure</th>
	        <th width="10%">Place</th>

	        <th width="10%">Imprimer</th>
	        
	        
	       </tr>
	     <theader>
	     <tbody>
	    ';
	      foreach($data->result() as $row)
	      {
	          if ($row->etat_reservation ==0) {


	          $link = '<a href="tel:'.$row->telephone.'" class="text-primary"><i class="fa fa-phone"></i></a>
	           <input type="checkbox" name="tel" value="'.$row->telephone.'" class="tels mr-1 delete_checkbox">
	            &nbsp;
	            <a href="javascript:void(0);" idreservation="'.$row->idreservation.'" class="btn btn-dark btn-sm btn-circle valider"><i class="fa fa-check text-white"></i> </a>
	           
	          ';

	            $etat_reservation = '
	              
	            <a type="button" href="'.base_url().'admin/pdf_billet/'.$row->codeReservation.'" class="btn btn-primary btn-circle btn-sm print"><i class="fa fa-print"></i></a>
	            ';
	          }
	          else{
	              $etat_reservation = '
	              
	                <a type="button" href="'.base_url().'admin/pdf_billet/'.$row->codeReservation.'" class="btn btn-primary btn-circle btn-sm print"><i class="fa fa-print"></i></a>
	              ';

	              $link = '<a href="tel:'.$row->telephone.'" class="text-primary"><i class="fa fa-phone"></i></a>
	               <input type="checkbox" name="tel" value="'.$row->telephone.'" class="tels mr-1 delete_checkbox">
	                &nbsp;
	               <a href="javascript:void(0);" idreservation="'.$row->idreservation.'" class="btn btn-success btn-circle btn-sm"><i class="fa fa-check text-white"></i></a>
	              ';
	          }
	          

	          $etat ='<span class="badge badge-warning"><i class="fa fa-user"></i> Client </span>';


	           $email = '<a href="mailto:'.$row->email.'" class="text-primary"><i class="fa fa-google mr-1"></i> '.$row->email.'</a>
	          
	          ';

	         
	           $output .= '
	           <tr>
	            <td>'.$link.'</td>
	            <td><img src="'.base_url().'upload/photo/'.$row->image.'" class="table-user-thumb" style="border-radius: 50%; width: 50px; height: 30px;" /></td>

	             <td>'.substr($row->first_name.' '.$row->last_name, 0,20).'...</td>

	            <td>'.$row->nomMatch.'</td>
	            <td>'.$etat.'</td>
	            <td>'.nl2br(substr(date(DATE_RFC822, strtotime($row->jour)), 0, 23)).'</td>
	            <td>'.$row->heure.'</td>

	            <td>'.$row->nomStade.' <br>'.$row->nomPlace.'</td>

	            <td>'.$etat_reservation.'</td>
	            
	           </tr>
	           ';

	      }

	       $output .='
	      <tr>
	        <td colspan="8">Montant total </td>
	        <td><h4>'.$total.'$</h4></td>
	        
	      </tr>
	      
	      ';
	        $output .= '
	            <tbody>
	            <tfooter>
	             <tr>
	              <th width="5%">Selectionner</th>
	              <th width="5%">Avatar</th>
	              <th width="20%">Nom complet</th>
	              <th width="15%">Rencontre</th>
	              <th width="10%">Statut</th>
	              <th width="20%">Jour</th>
	              <th width="5%">Heure</th>
	              <th width="10%">Place</th>

	              <th width="10%">Action</th>
	              
	              
	             </tr>
	           <tfooter>
	        </table>';
	    echo $output;
	}

	function pdf_liste_facture($jour1='', $jour2=''){
       $customer_id = "Liste de paiement de paiement du ".$jour1." au ".$jour2;
       $html_content = '';
      
       if ($jour1 > $jour2) {
         # code...
        $html_content .= $this->crud_model->fetch_single_details_listePaiement($jour2, $jour1);

       }
       else{
        $html_content .= $this->crud_model->fetch_single_details_listePaiement($jour1, $jour2);

       }

       // echo($html_content);
       $this->load->library('pdf');
       $this->pdf->loadHtml($html_content);
       $this->pdf->render();
       $this->pdf->stream("".$customer_id.".pdf", array("Attachment"=>0));
    }


	function fetch_limit_view_paiements()
	{
	  $output = '';
	  $query = '';
	  if($this->input->post('limit'))
	  {
	   $query = $this->input->post('limit');
	  }
	  $data = $this->crud_model->fetch_data_limit_paiement($query);
	  $output .= '
	   
	    <table class="table-striped table-bordered nk-tb-list nk-tb-ulist dataTable no-footer" data-auto-responsive="true" id="user_data" role="grid" aria-describedby="DataTables_Table_1_info">
	     <theader>
	       <tr>
	        <th width="5%">Selectionner</th>
	        <th width="5%">Avatar</th>
	        <th width="20%">Nom complet</th>
	        <th width="15%">Rencontre</th>
	        <th width="10%">Statut</th>
	        <th width="20%">Jour</th>
	        <th width="5%">Heure</th>
	        <th width="10%">Place</th>

	        <th width="10%">Imprimer</th>
	        
	        
	       </tr>
	     <theader>
	     <tbody>
	    ';
	      foreach($data->result() as $row)
	      {
	          if ($row->etat_reservation ==0) {


	          $link = '<a href="tel:'.$row->telephone.'" class="text-primary"><i class="fa fa-phone"></i></a>
	           <input type="checkbox" name="tel" value="'.$row->telephone.'" class="tels mr-1 delete_checkbox">
	            &nbsp;
	            <a href="javascript:void(0);" idreservation="'.$row->idreservation.'" class="btn btn-dark btn-sm btn-circle valider"><i class="fa fa-check text-white"></i> </a>
	           
	          ';




	            $etat_reservation = '
	              
	              <a type="button" href="'.base_url().'admin/pdf_billet/'.$row->codeReservation.'" class="btn btn-primary btn-circle btn-sm print"><i class="fa fa-print"></i></a>
	            ';
	          }
	          else{
	              $etat_reservation = '
	              
	                <a type="button" href="'.base_url().'admin/pdf_billet/'.$row->codeReservation.'" class="btn btn-primary btn-circle btn-sm print"><i class="fa fa-print"></i></a>
	              ';

	              $link = '<a href="tel:'.$row->telephone.'" class="text-primary"><i class="fa fa-phone"></i></a>
	               <input type="checkbox" name="tel" value="'.$row->telephone.'" class="tels mr-1 delete_checkbox">
	                &nbsp;
	               <a href="javascript:void(0);" idreservation="'.$row->idreservation.'" class="btn btn-success btn-circle btn-sm"><i class="fa fa-check text-white"></i></a>
	              ';
	          }
	          

	          $etat ='<span class="badge badge-warning"><i class="fa fa-user"></i> Client </span>';


	           $email = '<a href="mailto:'.$row->email.'" class="text-primary"><i class="fa fa-google mr-1"></i> '.$row->email.'</a>
	          
	          ';

	         
	           $output .= '
	           <tr>
	            <td>'.$link.'</td>
	            <td><img src="'.base_url().'upload/photo/'.$row->image.'" class="table-user-thumb" style="border-radius: 50%; width: 50px; height: 30px;" /></td>

	             <td>'.substr($row->first_name.' '.$row->last_name, 0,20).'...</td>

	            <td>'.$row->nomMatch.'</td>
	            <td>'.$etat.'</td>
	            <td>'.nl2br(substr(date(DATE_RFC822, strtotime($row->jour)), 0, 23)).'</td>
	            <td>'.$row->heure.'</td>

	            <td>'.$row->nomStade.' <br>'.$row->nomPlace.'</td>

	            <td>'.$etat_reservation.'</td>
	            
	           </tr>
	           ';

	      }
	        $output .= '
	            <tbody>
	            <tfooter>
	             <tr>
	              <th width="5%">Selectionner</th>
	              <th width="5%">Avatar</th>
	              <th width="20%">Nom complet</th>
	              <th width="15%">Rencontre</th>
	              <th width="10%">Statut</th>
	              <th width="20%">Jour</th>
	              <th width="5%">Heure</th>
	              <th width="10%">Place</th>

	              <th width="10%">Action</th>
	              
	              
	             </tr>
	           <tfooter>
	        </table>';
	  echo $output;
	}
























}



 ?>