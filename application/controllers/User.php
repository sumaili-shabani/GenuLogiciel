<?php 

defined('BASEPATH') OR exit('No direct script access allowed');  
class user extends CI_Controller
{
	private $token;
	private $connected;
	public function __construct()
	{
	  parent::__construct();
	  if(!$this->session->userdata('id'))
	  {
	      	redirect(base_url().'login');
	  }
	  $this->load->library('form_validation');
	  $this->load->library('encryption');
      $this->load->library('pdf');
	  $this->load->model('crud_model'); 

	  $this->load->helper('url');

	  $this->token = "sk_test_51GzffmHcKfZ3B3C9DATC3YXIdad2ummtHcNgVK4E5ksCLbFWWLYAyXHRtVzjt8RGeejvUb6Z2yUk740hBAviBSyP00mwxmNmP1";
	  $this->connected = $this->session->userdata('id');

	  /*
	  je script pour les galeries du contrat d'expiration
	
		// $this->crud_model->show_galery_expire();
		$this->crud_model->show_galery_expire();
	  */



	}

	function index(){
		$data['title']="mon profile entreprise";
		$data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
		$this->load->view('backend/user/templete_admin', $data);
  		// $this->load->view('backend/user/templete_admin', $data);
	}

   function client(){
        $data['title']="Paramètrage des clients";
        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
        $data['users'] = $this->crud_model->fetch_connected($this->connected);

        $data['equipes']  = $this->crud_model->Select_equipes(); 
        $data['roles']      = $this->crud_model->Select_formations_ok("idrole","role");

        $this->load->view('backend/user/client', $data);
      }

      function stade(){
        $data['title']="Paramètrage des stades";
        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
        $data['users'] = $this->crud_model->fetch_connected($this->connected);

        $data['equipes']  = $this->crud_model->Select_equipes(); 
        $data['roles']      = $this->crud_model->Select_formations_ok("idrole","role");

        $this->load->view('backend/user/stade', $data);
      }

      function place(){
        $data['title']="Paramètrage des places";
        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
        $data['users'] = $this->crud_model->fetch_connected($this->connected);

        $data['equipes']  = $this->crud_model->Select_equipes(); 
        $data['roles']      = $this->crud_model->Select_formations_ok("idrole","role");

        $data['stades']     = $this->crud_model->Select_formations_ok("nom","stade");

        $this->load->view('backend/user/place', $data);
      }


	

	function dashbord(){
		  $data['title']="Tableau de bord";
		  $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 

		  $data['nombre_paiement'] = $this->crud_model->statistiques_nombre_client("reservation",$this->connected);
	      // $data['nombre_location'] = $this->crud_model->statistiques_nombre("profile_location");


	      $data['nombre_client'] = $this->crud_model->statistiques_nombre_tag_by_column("users", 2);

	      $data['nombre_membre'] = $this->crud_model->statistiques_nombre_tag_by_column("users", 3);

	     

	      $data['nombre_users'] = $this->crud_model->statistiques_nombre("users");
	      $data['nombre_matchs'] = $this->crud_model->statistiques_nombre("matchs");
	      $this->load->view('backend/user/dashbord', $data);
	}

	function calendrier(){
		  $data['title']="mon profile entreprise";
	      $data['users'] = $this->crud_model->fetch_connected($this->connected);
	      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
	      // $this->load->view('backend/user/viewx', $data);
	      $this->load->view('backend/user/calendrier', $data);
	}



	function profile(){
      $data['title']="mon profile entreprise";
      $data['users'] = $this->crud_model->fetch_connected($this->connected);
      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
      // $this->load->view('backend/user/viewx', $data);
      $this->load->view('backend/user/profile', $data);
    }

    function basic(){
        $data['title']="Information basique de mon compte";
        $data['users'] = $this->crud_model->fetch_connected($this->connected);
        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
        $this->load->view('backend/user/basic', $data);
    }

    function basic_image(){
        $data['title']="Information basique de ma photo";
        $data['users'] = $this->crud_model->fetch_connected($this->connected);
        $this->load->view('backend/user/basic_image', $data);
        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
    }

    function basic_secure(){
        $data['title']="Paramètrage de sécurité de mon compte";
        $data['users'] = $this->crud_model->fetch_connected($this->connected);
        $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
        $this->load->view('backend/user/basic_secure', $data);
    }

    function notification($param1=''){
      $data['title']    ="Listes des formations";
      $data['users']    = $this->crud_model->fetch_connected($this->connected);
      $data['contact_info_site']  = $this->crud_model->Select_contact_info_site(); 
      $this->load->view('backend/user/notification', $data);
    }


	  // script de client
  function fetch_client(){  

       $fetch_data = $this->crud_model->make_datatables_client();  
       $data = array();  
       foreach($fetch_data as $row)  
       {  
            $sub_array = array();  
           
            $sub_array[] = nl2br(substr($row->fullname, 0,50));
            $sub_array[] = nl2br(substr($row->tel, 0,15));
            $sub_array[] = nl2br(substr($row->email, 0,20));

            $sub_array[] = nl2br(substr($row->adresse, 0,20));

            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idclient="'.$row->idclient.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idclient="'.$row->idclient.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_client(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_client(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_client()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_client($_POST["idclient"]);  
       foreach($data as $row)  
       {  
            $output['fullname'] 	= $row->fullname;
            $output['tel'] 			= $row->tel;
            $output['email'] 		= $row->email;
            $output['adresse'] 		= $row->adresse;
            
           
       }  
       echo json_encode($output);  
  }  


  function operation_client(){

      $insert_data = array(  
           'fullname'   =>     $this->input->post('fullname'),
           'tel'     	=>     $this->input->post('tel'),
           'email'     	=>     $this->input->post('email'),
           'adresse'    =>     $this->input->post('adresse')
	  );  

      $requete=$this->crud_model->insert_client($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_client(){

      $updated_data = array(  
           'fullname'   =>     $this->input->post('fullname'),
           'tel'     	=>     $this->input->post('tel'),
           'email'     	=>     $this->input->post('email'),
           'adresse'    =>     $this->input->post('adresse')
	  );

      $this->crud_model->update_client($this->input->post("idclient"), $updated_data);
      echo("modification avec succès");
  }

  function supression_client(){

      $this->crud_model->delete_client($this->input->post("idclient"));
      echo("suppression avec succès");
    
  }

  // fin de script  client 

   // script de location
  function fetch_location(){  

       $fetch_data = $this->crud_model->make_datatables_location();  
       $data = array(); 
       $etat =''; 
       foreach($fetch_data as $row)  
       {  
            $sub_array = array(); 

            if ($row->etat == 0) {
             	$etat ='<span class="badge badge-info">innocupée</span>';
            }
            else{
            	$etat ='<span class="badge badge-success">occupée</span>';
            } 
           
            $sub_array[] = nl2br(substr($row->nom, 0,50)).' ...';
            $sub_array[] = nl2br(substr($row->fullname, 0,15)).' ...';

            $sub_array[] = nl2br(substr($row->montant, 0,20));

            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->date_debit)), 0, 23));
            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->date_fin)), 0, 23));
            $sub_array[] = $etat;

            $sub_array[] = nl2br(substr(date(DATE_RFC822, strtotime($row->created_at)), 0, 23)); 
           

            $sub_array[] = '<button type="button" name="update" idl="'.$row->idl.'" class="btn btn-warning btn-circle btn-sm update"><i class="fa fa-edit"></i></button>';  
            $sub_array[] = '<button type="button" name="delete" idl="'.$row->idl.'" idchambre="'.$row->idchambre.'" class="btn btn-danger btn-circle btn-sm delete"><i class="fa fa-trash"></i></button>';  
            $data[] = $sub_array;  
       }  
       $output = array(  
            "draw"                =>     intval($_POST["draw"]),  
            "recordsTotal"        =>     $this->crud_model->get_all_data_location(),  
            "recordsFiltered"     =>     $this->crud_model->get_filtered_data_location(),  
            "data"                =>     $data  
       );  
       echo json_encode($output);  
  }

  function fetch_single_location()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_location($_POST["idl"]);  
       foreach($data as $row)  
       {  
            $output['montant'] 			= $row->montant;
            $output['idclient'] 		= $row->idclient;
            $output['idchambre'] 		= $row->idchambre;
            $output['date_debit'] 		= $row->date_debit;
            $output['date_fin'] 		= $row->date_fin;
       }  
       echo json_encode($output);  
  }  

  function fetch_single_location_2()  
  {  
       $output = array();  
       $data = $this->crud_model->fetch_single_location_2($_POST["idl"]);  
       foreach($data as $row)  
       {  
            $output['montant'] 			= $row->montant;
            $output['idclient'] 		= $row->idclient;
            $output['idchambre'] 		= $row->idchambre;

            $output['date_debit'] = nl2br(substr(date(DATE_RFC822, strtotime($row->date_debit)), 0, 23));
            $output['date_fin'] = nl2br(substr(date(DATE_RFC822, strtotime($row->date_fin)), 0, 23));
           
            $output['nom'] 				= $row->nom;
            $output['fullname'] 		= $row->fullname;
            $output['adresse'] 			= $row->adresse;

            $output['tel'] 				= $row->tel;
            $output['email'] 			= $row->email;
            $output['montant'] 			= $row->montant;

       }  
       echo json_encode($output);  
  }  


  function operation_location(){

      $insert_data = array(  
           'montant'   		=>     $this->input->post('montant'),
           'idchambre'  	=>     $this->input->post('idchambre'),
           'idclient'   	=>     $this->input->post('idclient'),
           'date_debit'     =>     $this->input->post('date_debit'),
           'date_fin'    	=>     $this->input->post('date_fin')
	  );  

      $requete=$this->crud_model->insert_location($insert_data);
      echo("Ajout information avec succès");
      
  }

  function modification_location(){

      $updated_data = array(  
           'montant'   		=>     $this->input->post('montant'),
           'idchambre'  	=>     $this->input->post('idchambre'),
           'idclient'   	=>     $this->input->post('idclient'),
           'date_debit'     =>     $this->input->post('date_debit'),
           'date_fin'    	=>     $this->input->post('date_fin')
	  );

      $this->crud_model->update_location($this->input->post("idl"), $updated_data);
      echo("modification avec succès");
  }

  function supression_location(){

  		$idchambre = $this->input->post('idchambre');
  		if ($idchambre !='') {
  			
  			$updated_data = array(  
	           'etat'   =>     0
			);

		    $this->crud_model->update_chambre($idchambre, $updated_data);
  		}

      $this->crud_model->delete_location($this->input->post("idl"));
      echo("suppression avec succès");
    
  }

  // fin de script  location 

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
         redirect('user/basic', 'refresh');
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
           redirect('user/basic_image', 'refresh');
     }
     else{

        $this->session->set_flashdata('message2', 'Veillez selectionner la photo');
        redirect('user/basic_image', 'refresh');

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
                   redirect('user/basic_secure', 'refresh');

               }
               else{
   
                $this->session->set_flashdata('message2', 'les deux mot de passe doivent être identiques');
                redirect('user/basic_secure', 'refresh');
               }
         
          }

       }
       else{

          $this->session->set_flashdata('message2', 'information incorecte');
          redirect('user/basic_secure', 'refresh');
       }
     
  } 

  function view_1($param1='', $param2='', $param3=''){
      
	  if($param1=='display_delete') {
	  	$this->session->set_flashdata('message', 'suppression avec succès ');
	    $query = $this->crud_model->delete_notifacation_tag($param2);
	    redirect('user/notification');
	  }

	  if($param1=='display_delete_message') {

	    $query = $this->crud_model->delete_message_tag($param3);
	    redirect('user/message/'.$param2);
	  }
	  else{

	  }

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
              $output['nom']        = $row->nom; 
              $output['nomPlace']     = $row->nomPlace;
              $output['idstade']      = $row->idstade; 
              
             
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

    








}