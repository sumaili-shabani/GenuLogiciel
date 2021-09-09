<?php 
class crud_model extends CI_Model{
   // opertion role
  var $table1 = "role";  
  var $select_column1 = array("idrole", "nom", "created_at");  
  var $order_column1 = array(null, "nom", "created");
  // fin de la role

  //opertion tbl_info
  var $table2 = "tbl_info";  
  var $select_column2 = array("idinfo", "nom_site", "icone", "adresse", "tel1","tel2","facebook","twitter", "linkedin", "email", "termes", "confidentialite", 
    "description", "mission", "objectif","blog");  
  var $order_column2 = array(null, "nom_site", "adresse","tel1","tel2", 
    "description", "mission", "objectif","blog", null, null);
    // fin de la tbl_info

  // script equipe
  var $table3 = "equipe";  
  var $select_column3 = array("idequipe", "logo","nom", "created_at");  
  var $order_column3 = array(null, "logo","nom", "created");
  // fin de la role

  // script match
  var $table4 = "profile_match";  
  var $select_column4 = array("idmath", "nomMatch","nom_equipe1", "equipe2", "jour","heure", "created_at");  
  var $order_column4 = array(null, "nomMatch","nom_equipe1","equipe2","jour","heure", "created");
  // fin de la role

  // opertion stade
  var $table5 = "stade";  
  var $select_column5 = array("idstade", "nom", "created_at");  
  var $order_column5 = array(null, "nom", "created");
  // fin de la stade

  // opertion place
  var $table6 = "profile_place";  
  var $select_column6 = array("idplace","idstade", "nomPlace","nom", "created_at");  
  var $order_column6 = array(null, "nomPlace","nom", "created");
  // fin de la place

  // opertion reservation
  var $table7 = "profile_reservation";  
  var $select_column7 = array("idreservation","idstade","idplace","montant","etat_reservation","first_name","last_name","telephone","nomEquipe", "nomPlace","heure","jour","nomStade", "created_at");  
  var $order_column7 = array(null, "idstade","idplace","montant","etat_reservation","first_name","last_name","telephone","nomEquipe", "nomPlace","heure","jour","nomStade", "created");
  // fin de la reservation

   //users
  var $table8 = "users";  
  var $select_column8 = array("id", "first_name", "last_name", "email","image","telephone","full_adresse","biographie","date_nais","facebook","twitter","linkedin","idrole","sexe");  
  var $order_column8 = array(null, "first_name", "last_name","telephone","sexe","id", null, null);
  // fin information

   // contact
  var $table12 = "contact";  
  var $select_column12 = array("id", "nom", "sujet","email", "message","fichier","created_at");  
  var $order_column12 = array(null, "nom", "sujet","email","fichier", null, null);
  // fin contact





  function fetch_produits()
  {
    $this->db->order_by("product_id", "DESC");
    $this->db->limit(100);
    return $this->db->get('profile_product');
  } 

  function fetch_categores()
  {
    $this->db->order_by('nom','ASC');
      return $this->db->get('category');
  }

  // information basique du site
  function Select_contact_info_site()
  {
      return $this->db->query('SELECT * FROM tbl_info  LIMIT 1');
  }

  // contact 
  function insert_contact($data)  
  {  
       $this->db->insert('contact', $data);  
  }

// test_email si existe
  function get_users_email($email)
  {
      $this->db->limit(1);
      return $this->db->get_where('users', array('email' => $email));
  }
// utilisateur connecte
  function fetch_connected($id){
      $this->db->where('id',$id);
      return $this->db->get('users')->result_array();
  }

  function fetch_all_client(){
      $this->db->where('idrole',2);
      return $this->db->get('users');
  }
  // online 
  function insert_online($data){
      $this->db->insert('online', $data);
  }
  // creation de compte
  function insert_user($data)
  {
    $this->db->insert('users', $data);
    return $this->db->insert_id();
  } 

  // insertion dans la table recuper pwd 
  function insert_recupere($data){
     $this->db->insert('recupere', $data);
  }

  // suppression deconnexion en ligne 
  function delete_online($id_user){
    $this->db->where('id_user', $id_user);
    $this->db->delete("online");
  }

  //modification des utilisateurs
  function update_user($email, $data)
  {
    $this->db->where('email', $email);
    return $this->db->update('users', $data);
  }

  // insertion des notifications 
  function insert_notification($data)  
  {  
     $this->db->insert('notification', $data);  
  }
  function update_crud($user_id, $data)  
  {  
       $this->db->where("id", $user_id);  
       $this->db->update("users", $data);  
  }
  //supression de notification
  function delete_notifacation_tag($id){
    $this->db->where('id', $id);
    $this->db->delete('notification');
  }

  //supression de favories
  function delete_favory_tag($idfovorie){
    $this->db->where('idfovorie', $idfovorie);
    $this->db->delete('favories');
  }

  //supression de favories
  function delete_favory_vente($code){
    $this->db->where('code', $code);
    $this->db->delete('pading_vente');
  }

  function Select_users()
  {
      $this->db->order_by('first_name','ASC');
      $this->db->limit(50);
      return $this->db->get('users');
  }

  function Select_roles()
  {
      $this->db->order_by('nom','ASC');
      $this->db->limit(50);
      return $this->db->get('role');
  }

  function Select_equipes()
  {
      $this->db->order_by('nom','ASC');
      $this->db->limit(50);
      return $this->db->get('equipe');
  }

  // utilisateur vente en attente
  function fetch_connected_vente($user_id){
      $this->db->where('user_id',$user_id);
      $this->db->group_by('code');
      return $this->db->get('profile_padding_vente')->result_array();
  }

  // nombre des produits au panier 
  function fetch_number_Panier_connected($user_id){
      $nombreTotal;
      $query= $this->db->query("SELECT COUNT(product_id) AS nombre FROM cart WHERE user_id=".$user_id." ");
      if ($query->num_rows() > 0) {
        foreach ($query->result_array() as $key) {
          # code...
          $nombreTotal = $key['nombre'];
        }

      }
      else{
        $nombreTotal = 0;
      }
      return $nombreTotal;
  }

 

  function get_info_user(){
      $nom = $this->db->get("users")->result_array();
      return $nom;
  }

  function statistiques_nombre_entree_enstock($query){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;
  }

  function statistiques_nombre_entree_enstock_cat($query){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." GROUP BY nom ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;
  }



  function statistiques_nombre_tag_by_column($query, $value){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." WHERE idrole=".$value." ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;
  }


  function statistiques_nombre($query){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;
  }

  function statistiques_nombre_client($query, $idclient){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." WHERE idclient=".$idclient." AND etat_reservation=1 ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;
  }


  function statistiques_nombre_where($query, $colone,$value){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." WHERE ".$colone."='".$value."' ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;

  }

  function statistiques_nombre_where_null($query, $colone,$value){
      $my_nombre;
      $data_ok = $this->db->query("SELECT count(*) AS nombre from ".$query." WHERE ".$colone." is ".$value." ");
      if ($data_ok->num_rows() > 0) {

        foreach ($data_ok->result_array() as $key) {
          $my_nombre = $key['nombre'];
        }
        # code...
      }
      else{
           $my_nombre = 0;
      }

      return $my_nombre;

  }


   // script pour ctegorie mrchandise du site
    function make_query_category()  
    {  
          
         $this->db->select($this->select_column3);  
         $this->db->from($this->table3);
         
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idcat", $_POST["search"]["value"]);  
              $this->db->or_like("nom", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column3[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idcat', 'DESC');  
         }  
    }

   function make_datatables_category(){  
         $this->make_query_category();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_category(){  
         $this->make_query_category();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_category()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table3);  
         return $this->db->count_all_results();  
    }

    function insert_category($data)  
    {  
         $this->db->insert('category', $data);  
    }

    
    function update_category($idcat, $data)  
    {  
         $this->db->where("idcat", $idcat);  
         $this->db->update("category", $data);  
    }


    function delete_category($idcat)  
    {  
         $this->db->where("idcat", $idcat);  
         $this->db->delete("category");  
    }

    function fetch_single_category($idcat)  
    {  
         $this->db->where("idcat", $idcat);  
         $query=$this->db->get('category');  
         return $query->result();  
    } 

  // script pour role du site
   function make_query_role()  
   {  
          
         $this->db->select($this->select_column1);  
         $this->db->from($this->table1);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idrole", $_POST["search"]["value"]);  
              $this->db->or_like("nom", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column1[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idrole', 'DESC');  
         }  
    }

   function make_datatables_role(){  
         $this->make_query_role();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_role(){  
         $this->make_query_role();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_role()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table1);  
         return $this->db->count_all_results();  
    }

    function insert_role($data)  
    {  
         $this->db->insert('role', $data);  
    }

    
    function update_role($idrole, $data)  
    {  
         $this->db->where("idrole", $idrole);  
         $this->db->update("role", $data);  
    }


    function delete_role($idrole)  
    {  
         $this->db->where("idrole", $idrole);  
         $this->db->delete("role");  
    }

    function fetch_single_role($idrole)  
    {  
         $this->db->where("idrole", $idrole);  
         $query=$this->db->get('role');  
         return $query->result();  
    } 
    // fin de script role

    // script pour information du site
    function make_query_tbl_info()  
    {  
          
         $this->db->select($this->select_column2);  
         $this->db->from($this->table2);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("adresse", $_POST["search"]["value"]);  
              $this->db->or_like("nom_site", $_POST["search"]["value"]);
              $this->db->or_like("tel1", $_POST["search"]["value"]); 
              $this->db->or_like("tel2", $_POST["search"]["value"]);
              $this->db->or_like("email", $_POST["search"]["value"]);
              $this->db->or_like("idinfo", $_POST["search"]["value"]);
              $this->db->or_like("termes", $_POST["search"]["value"]);
              $this->db->or_like("confidentialite", $_POST["search"]["value"]);  
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column2[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idinfo', 'DESC');  
         }  
    }

   function make_datatables_tbl_info(){  
         $this->make_query_tbl_info();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_tbl_info(){  
         $this->make_query_tbl_info();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_tbl_info()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table2);  
         return $this->db->count_all_results();  
    }

    function insert_tbl_info($data)  
    {  
         $this->db->insert('tbl_info', $data);  
    }

    
    function update_tbl_info($idinfo, $data)  
    {  
         $this->db->where("idinfo", $idinfo);  
         $this->db->update("tbl_info", $data);  
    }


    function delete_tbl_info($idinfo)  
    {  
         $this->db->where("idinfo", $idinfo);  
         $this->db->delete("tbl_info");  
    }

    function delete_compte_utilisateur($id)  
    {  
         $this->db->where("id", $id);  
         $this->db->delete("users");  
    }

    function fetch_single_tbl_info($idinfo)  
    {  
         $this->db->where("idinfo", $idinfo);  
         $query=$this->db->get('tbl_info');  
         return $query->result();  
    } 

    function fetch_single_to_modal($product_id)  
    {  
         $this->db->where("product_id", $product_id);  
         $query=$this->db->get('profile_product');  
         return $query->result();  
    } 

    function fetch_single_galery_to_modal($product_id)  
    {  
         $this->db->where("product_id", $product_id);  
         $query=$this->db->get('profile_galery');  
         return $query->result();  
    } 

    function fetch_single_rand_pro_one()  
    {  
         $img='';
         $query = $this->db->query("SELECT * FROM profile_product ORDER BY RAND() LIMIT 1"); 
          if ($query->num_rows() > 0) {
            foreach ($query->result() as $row) {
              $img ='
                <a class="category-item mb-4" 
                   href="'.base_url().'user/detailProduct/'.$row->product_id.'">
                   <img class="img-fluid" src="'.base_url().'upload/product/'.$row->product_image.'" alt=""><strong class="category-item-title">'.$row->nom.'</strong>
                </a>

              ';
            }
          }
          else{

          } 
         return $img;  
    }

    /*

    OPERATION DE FILTRE POUR LES CATEGORIES
    DES SRTICLE CLOMMECE
    ===================================================
    ===================================================

    */

    // filtrage de category 
    function filtre_de_nom_Category_produit()  
    {   
         $query=$this->db->query("SELECT * FROM profile_product ORDER BY RAND() LIMIT 6");  
         return $query;  
    } 

    // filtrage de category 
    function filtre_de_donnees_produit_tag($product_id)  
    {   
         $query=$this->db->query("SELECT * FROM profile_product WHERE product_id=".$product_id." LIMIT 1");  
         return $query;  
    } 

     // filtrage de category 
    function filtre_de_cat_Category_produit()  
    {   
         $query=$this->db->query("SELECT * FROM profile_product GROUP BY category_id LIMIT 40");  
         return $query;  
    } 

     /*

    FIN OPERATION DE FILTRE POUR LES CATEGORIES
    DES SRTICLE CLOMMECE
    ===================================================
    ===================================================

    */




    // fin de tbl_info 

    // script users
    function make_query_users()  
    {  
          
         $this->db->select($this->select_column8);  
         $this->db->from($this->table8);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("first_name", $_POST["search"]["value"]);  
              $this->db->or_like("last_name", $_POST["search"]["value"]); 
              $this->db->or_like("full_adresse", $_POST["search"]["value"]); 
              $this->db->or_like("biographie", $_POST["search"]["value"]);  
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column8[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('id', 'DESC');  
         }  
    }

    function make_datatables_users(){  
         $this->make_query_users();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_users(){  
         $this->make_query_users();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_users()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table8);  
         return $this->db->count_all_results();  
    }

    function insert_users($data)  
    {  
         $this->db->insert('users', $data);  
    }

    
    function update_users($id, $data)  
    {  
         $this->db->where("id", $id);  
         $this->db->update("users", $data);  
    }


    function delete_users($id)  
    {  
         $this->db->where("id", $id);  
         $this->db->delete("users");  
    }

    function fetch_single_users($id)  
    {  
         $this->db->where("id", $id);  
         $query=$this->db->get('users');  
         return $query->result();  
    }

    //fin de script users

    // script pour information du produit en stock

    function fetch_details_view_product($limit, $start)
    {
      $output = '';
      $this->db->select("*");
      $this->db->from("profile_product");
      $this->db->order_by("product_id", "DESC");
      $this->db->limit($limit, $start);
      $query = $this->db->get();
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
      if ($query->num_rows() < 0) {
        
      }
      else{

        foreach($query->result() as $row)
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
      return $output;
    }


   function fetch_data_search_view_product($query)
   {
      $this->db->select("*");
      $this->db->from("profile_product");
      $this->db->limit(10);
      if($query != '')
      {
       $this->db->like('product_id', $query);
       $this->db->or_like('Qte', $query);
       $this->db->or_like('product_name', $query);
       $this->db->or_like('product_price', $query);
       $this->db->or_like('nom', $query);
      }
      $this->db->order_by('product_id', 'DESC');
      return $this->db->get();
   }


    function make_query_product()  
    {  
          
         $this->db->select($this->select_column4);  
         $this->db->from($this->table4);
         $this->db->limit(30);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("nom", $_POST["search"]["value"]);  
              $this->db->or_like("product_price", $_POST["search"]["value"]);
              $this->db->or_like("product_name", $_POST["search"]["value"]); 
              $this->db->or_like("first_name", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column4[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('product_id', 'DESC');  
         }  
    }

   function make_datatables_product(){  
         $this->make_query_product();  
         if($_POST["length"])  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_product(){  
         $this->make_query_product();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_product()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table4);  
         return $this->db->count_all_results();  
    }

    function insert_product($data)  
    {  
         $this->db->insert('product', $data);  
    }

    
    
    function update_product($product_id, $data)  
    {  
         $this->db->where("product_id", $product_id);  
         $this->db->update("product", $data);  
    }


    function delete_product($product_id)  
    {  
         $this->db->where("product_id", $product_id);  
         $this->db->delete("product");  
    }

    function fetch_single_product($product_id)  
    {  
         $this->db->where("product_id", $product_id);  
         $query=$this->db->get('profile_product');  
         return $query->result();  
    } 

    // fin de produit en stock 


    // script pour information galery du produit en stock
    function make_query_galery()  
    {  
          
         $this->db->select($this->select_column5);  
         $this->db->from($this->table5);
         $this->db->limit(30);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("product_name", $_POST["search"]["value"]);  
              $this->db->or_like("product_price", $_POST["search"]["value"]);
              $this->db->or_like("Qte", $_POST["search"]["value"]); 
             
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column5[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idgalery', 'DESC');  
         }  
    }

   function make_datatables_galery(){  
         $this->make_query_galery();  
         if($_POST["length"])  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_galery(){  
         $this->make_query_galery();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_galery()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table5);  
         return $this->db->count_all_results();  
    }

    function insert_galery($data)  
    {  
         $this->db->insert('galery', $data);  
    }

    
    function update_galery($idgalery, $data)  
    {  
         $this->db->where("idgalery", $idgalery);  
         $this->db->update("galery", $data);  
    }


    function delete_galery($idgalery)  
    {  
         $this->db->where("idgalery", $idgalery);  
         $this->db->delete("galery");  
    }

    function fetch_single_galery($idgalery)  
    {  
         $this->db->where("idgalery", $idgalery);  
         $query=$this->db->get('profile_galery');  
         return $query->result();  
    } 

    // fin de galery produit en stock 


     // script pour information entreee du produit en stock
    function make_query_entree()  
    {  
          
         $this->db->select($this->select_column6);  
         $this->db->from($this->table6);
         $this->db->limit(30);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("product_name", $_POST["search"]["value"]);  
              $this->db->or_like("product_price", $_POST["search"]["value"]);
              $this->db->or_like("Qte", $_POST["search"]["value"]); 
              $this->db->or_like("QteEntree", $_POST["search"]["value"]);
             
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column6[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('ide', 'DESC');  
         }  
    }

   function make_datatables_entree(){  
         $this->make_query_entree();  
         if($_POST["length"])  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_entree(){  
         $this->make_query_entree();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_entree()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table6);  
         return $this->db->count_all_results();  
    }

    function insert_entree($data)  
    {  
         $this->db->insert('entree', $data); 
         return $this->db->insert_id(); 
    }

    
    function update_entree($ide, $data)  
    {  
         $this->db->where("ide", $ide);  
         $this->db->update("entree", $data);  
    }


    function delete_entree($ide)  
    {  
         $this->db->where("ide", $ide);  
         $this->db->delete("entree");  
    }

    function fetch_single_entree($ide)  
    {  
         $this->db->where("ide", $ide);  
         $query=$this->db->get('profile_entree_stock');  
         return $query->result();  
    } 

    // fin de entree produit en stock 

    // script pour information sortie du produit en stock
    function count_all_view_sortie()
    {
      $query = $this->db->get("profile_sortie_stock");
      $this->db->limit(30);
      return $query->num_rows();
    }

    // script pour information  des produits en stock
    function count_all_view_product()
    {
      $query = $this->db->get("profile_product");
      $this->db->limit(30);
      return $query->num_rows();
    }

    function fetch_details_view_sortie($limit, $start)
    {
      $output = '';
      $this->db->select("*");
      $this->db->from("profile_sortie_stock");
      $this->db->order_by("ids", "DESC");
      $this->db->limit($limit, $start);
      $query = $this->db->get();
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
      if ($query->num_rows() < 0) {
        
        $output .= '
         <tr>
          <td colpan="8">Aucune donnée n\'est à présent</td>

         </tr>
         ';
      }
      else{

        foreach($query->result() as $row)
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
      return $output;
    }


   function fetch_data_search_view_sortie($query)
   {
      $this->db->select("*");
      $this->db->from("profile_sortie_stock");
      $this->db->limit(10);
      if($query != '')
      {
       $this->db->like('product_id', $query);
       $this->db->or_like('QteEntree', $query);
       $this->db->or_like('product_name', $query);
       $this->db->or_like('product_price', $query);
       $this->db->or_like('nom', $query);
      }
      $this->db->order_by('ids', 'DESC');
      return $this->db->get();
   }


    function make_query_sortie()  
    {  
          
         $this->db->select($this->select_column7);  
         $this->db->from($this->table7);
         $this->db->limit(30);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("product_name", $_POST["search"]["value"]);  
              $this->db->or_like("product_price", $_POST["search"]["value"]);
              $this->db->or_like("Qte", $_POST["search"]["value"]); 
              $this->db->or_like("QteEntree", $_POST["search"]["value"]);
             
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column7[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('ids', 'DESC');  
         }  
    }

   function make_datatables_sortie(){  
         $this->make_query_sortie();  
         if($_POST["length"])  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_sortie(){  
         $this->make_query_sortie();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_sortie()  
    {  
         $this->db->select("*");  
         $this->db->limit(30); 
         $this->db->from($this->table7);  
         return $this->db->count_all_results();  
    }

    function insert_sortie($data)  
    {  
         $this->db->insert('sortie', $data); 
         return $this->db->insert_id(); 
    }

    
    function update_sortie($ids, $data)  
    {  
         $this->db->where("ids", $ids);  
         $this->db->update("sortie", $data);  
    }


    function delete_sortie($ids)  
    {  
         $this->db->where("ids", $ids);  
         $this->db->delete("sortie");  
    }

    function fetch_single_sortie($ids)  
    {  
         $this->db->where("ids", $ids);  
         $query=$this->db->get('profile_sortie_stock');  
         return $query->result();  
    } 
    // fin de entree produit en stock 

    // impression bon d'entrée
    function Fiche_impressionStockEntrant()
    {

        $data = $this->db->get('profile_entree_stock');

        $nom_site = '';
        $icone    = '';
        $email    = '';

        $info = $this->db->get('tbl_info')->result_array();
        foreach ($info as $key) {
          $nom_site = $key['nom_site'];
          $icone    = $key['icone'];
          $email    = $key['email'];
          
        }

        $output = '';
        $nomf;
        $created_at;
        $nom;
        $icone;

         

         $message = "REPUBLIQUE DEMOCRATIQUE DU CONGO <br/>
         <h3>
            Fiche de stock des produits entrants ".$nom_site."
         <h3>
         ";

         $output = '<div align="right">';
         $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data" >';
         $output .= '
         <tr>
          <td width="25%"><img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100"/></td>
          <td width="50%" align="center">
           <p><b>'.$message.' </b></p>
           <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

           <hr>
           
          </td>

          <td width="25%">
          <img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100" />
          </td>


         </tr>
         ';
      
        $output .= '</table>';

         $output .= '</div>';

         $output .= '
            <table border="1" style="
                width: 100%;
                  margin-bottom: 1rem;
                  background-color: transparent;
                  border: 1px solid #dee2e6;
                  border-collapse: collapse;

             ">
              <thead>
                <tr>
                  <th>Photo</th>
                  <th>Nom du produit</th>
                  <th>Qte entrée</th>
                  <th>Categoré</th>
                  <th>Prix utinitaire</th>
                  <th>Mise à jour</th>
                </tr>
              </thead>
              <tbody>

          ';

            if ($data->num_rows() > 0) {

              foreach($data->result_array() as $items)
              {
                
                  $data_paie = $this->db->query("SELECT Count(product_id) AS montant FROM profile_entree_stock ");
                  if ($data_paie->num_rows() > 0) {
                      # code...
                      foreach($data_paie->result_array() as $items2)
                      {
                        $montantT =  $items2["montant"];
                      }

                  }
                  else{
                    $montantT = 0;
                  }

                   $retour = "javascript:history.go(-1);";

                   $output .= '

                   <!-- detail des produits commencent par ici
                  view ok fiche de stock -->
                  <tr>
                    <td>
                      <img src="'.base_url().'upload/product/'.$items["product_image"].'" style="height: 40px; width: 50px; border-radius: 50%;"/>
                    </td>
                    <td>'.$items["product_name"].'</td>
                    <td>'.$items["QteEntree"].'</td>
                    <td>'.$items["nom"].'</td>
                    <td>'.$items["product_price"].' $</td>
                    <td>'.nl2br(substr(date(DATE_RFC822, strtotime($items["created_at"])), 0, 23)).'</td>

                  </tr>
                  <!-- fin boucle -->

                   ';
              }

              $output .= '

                <tr>
                  <td colspan="5" align="right">Nombre Total de produit entrant &nbsp;&nbsp;</td>
                  <td>'.$montantT.' produit(s)</td>
                </tr>

               ';
              # code...
            }
            $output .= '
            </tbody>
          </table>

       
    
        <div align="right" style="margin-botton:20px;">

            <a href="'.base_url().'admin/stat_entree" style="text-decoration: none; color: black;">signature:</a>
      
        </div>
       
        ';

        return $output;

    }

     // impression bon de sortie
    function Fiche_impressionStockSortie()
    {

        $data = $this->db->get('profile_sortie_stock');

        $nom_site = '';
        $icone    = '';
        $email    = '';

        $info = $this->db->get('tbl_info')->result_array();
        foreach ($info as $key) {
          $nom_site = $key['nom_site'];
          $icone    = $key['icone'];
          $email    = $key['email'];
          
        }

        $output = '';
        $nomf;
        $created_at;
        $nom;
        $icone;

         

         $message = "REPUBLIQUE DEMOCRATIQUE DU CONGO <br/>
         <h3>
            Bon de sortie de stock des produits  ".$nom_site."
         <h3>
         ";

         $output = '<div align="right">';
         $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data" >';
         $output .= '
         <tr>
          <td width="25%"><img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100"/></td>
          <td width="50%" align="center">
           <p><b>'.$message.' </b></p>
           <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

           <hr>
           
          </td>

          <td width="25%">
          <img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100" />
          </td>


         </tr>
         ';
      
        $output .= '</table>';

         $output .= '</div>';

         $output .= '
            <table  style="
                width: 100%;
                  margin-bottom: 1rem;
                  background-color: transparent;
                  border: 1px solid #dee2e6;
                  border-collapse: collapse;

             ">
              <thead>
                <tr>
                  <th>Photo</th>
                  <th>Nom du produit</th>
                  <th>Qte entrée</th>
                  <th>Categoré</th>
                  <th>Prix utinitaire</th>
                  <th>Mise à jour</th>
                </tr>
              </thead>
              <tbody>

          ';

            if ($data->num_rows() > 0) {

              foreach($data->result_array() as $items)
              {
                
                  $data_paie = $this->db->query("SELECT Count(product_id) AS montant FROM profile_sortie_stock ");
                  if ($data_paie->num_rows() > 0) {
                      # code...
                      foreach($data_paie->result_array() as $items2)
                      {
                        $montantT =  $items2["montant"];
                      }

                  }
                  else{
                    $montantT = 0;
                  }

                   $retour = "javascript:history.go(-1);";

                   $output .= '

                   <!-- detail des produits commencent par ici
                  view ok fiche de stock -->
                  <tr>
                    <td>
                      <img src="'.base_url().'upload/product/'.$items["product_image"].'" style="height: 40px; width: 50px; border-radius: 50%;"/>
                    </td>
                    <td>'.$items["product_name"].'</td>
                    <td>'.$items["QteEntree"].'</td>
                    <td>'.$items["nom"].'</td>
                    <td>'.$items["product_price"].' $</td>
                    <td>'.nl2br(substr(date(DATE_RFC822, strtotime($items["created_at"])), 0, 23)).'</td>

                  </tr>
                  <!-- fin boucle -->

                   ';
              }

              $output .= '

                <tr>
                  <td colspan="5" align="right">Nombre Total de produit entrant &nbsp;&nbsp;</td>
                  <td>'.$montantT.' produit(s)</td>
                </tr>

               ';
              # code...
            }
            $output .= '
            </tbody>
          </table>

       
    
        <div align="right" style="margin-botton:20px;">

            <a href="'.base_url().'admin/stat_sortie" style="text-decoration: none; color: black;">signature:</a>
      
        </div>
       
        ';

        return $output;

    }

     // impression bon d'entrée filtrage de date
    function Fiche_impressionStockEntrant_Date($date1,$date2)
    {

        $data = $this->db->query("SELECT * FROM profile_entree_stock WHERE created_at BETWEEN '".$date1."'
         AND '".$date2."' ");

        $nom_site = '';
        $icone    = '';
        $email    = '';

        $info = $this->db->get('tbl_info')->result_array();
        foreach ($info as $key) {
          $nom_site = $key['nom_site'];
          $icone    = $key['icone'];
          $email    = $key['email'];
          
        }

        $output = '';
        $nomf;
        $created_at;
        $nom;
        $icone;

         

         $message = "REPUBLIQUE DEMOCRATIQUE DU CONGO <br/>
         <h3>
            Fiche de stock des produits entrants ".$nom_site." du date de ".nl2br(substr(date(DATE_RFC822, strtotime($date1)), 0, 15))." au ".nl2br(substr(date(DATE_RFC822, strtotime($date2)), 0, 15))."
         <h3>
         ";

         $output = '<div align="right">';
         $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data" >';
         $output .= '
         <tr>
          <td width="25%"><img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100"/></td>
          <td width="50%" align="center">
           <p><b>'.$message.' </b></p>
           <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

           <hr>
           
          </td>

          <td width="25%">
          <img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100" />
          </td>


         </tr>
         ';
      
        $output .= '</table>';

         $output .= '</div>';

         $output .= '
            <table border="1" style="
                width: 100%;
                  margin-bottom: 1rem;
                  background-color: transparent;
                  border: 1px solid #dee2e6;
                  border-collapse: collapse;

             ">
              <thead>
                <tr>
                  <th>Photo</th>
                  <th>Nom du produit</th>
                  <th>Qte entrée</th>
                  <th>Categoré</th>
                  <th>Prix utinitaire</th>
                  <th>Mise à jour</th>
                </tr>
              </thead>
              <tbody>

          ';

            if ($data->num_rows() > 0) {

              foreach($data->result_array() as $items)
              {
                
                  $data_paie = $this->db->query("SELECT Count(product_id) AS montant FROM profile_entree_stock 
                  WHERE created_at BETWEEN '".$date1."' AND '".$date2."' ");
                  if ($data_paie->num_rows() > 0) {
                      # code...
                      foreach($data_paie->result_array() as $items2)
                      {
                        $montantT =  $items2["montant"];
                      }

                  }
                  else{
                    $montantT = 0;
                  }

                   $retour = "javascript:history.go(-1);";

                   $output .= '

                   <!-- detail des produits commencent par ici
                  view ok fiche de stock -->
                  <tr>
                    <td>
                      <img src="'.base_url().'upload/product/'.$items["product_image"].'" style="height: 40px; width: 50px; border-radius: 50%;"/>
                    </td>
                    <td>'.$items["product_name"].'</td>
                    <td>'.$items["QteEntree"].'</td>
                    <td>'.$items["nom"].'</td>
                    <td>'.$items["product_price"].' $</td>
                    <td>'.nl2br(substr(date(DATE_RFC822, strtotime($items["created_at"])), 0, 23)).'</td>

                  </tr>
                  <!-- fin boucle -->

                   ';
              }

              $output .= '

                <tr>
                  <td colspan="5" align="right">Nombre Total de produit entrant &nbsp;&nbsp;</td>
                  <td>'.$montantT.' produit(s)</td>
                </tr>

               ';
              # code...
            }
            $output .= '
            </tbody>
          </table>

       
    
        <div align="right" style="margin-botton:20px;">

            <a href="'.base_url().'admin/stat_entree" style="text-decoration: none; color: black;">signature:</a>
      
        </div>
       
        ';

        return $output;

    }

     // impression bon de sortie filtrage de date
    function Fiche_impressionStockSortie_Date($date1,$date2)
    {

        $data = $this->db->query("SELECT * FROM profile_sortie_stock WHERE created_at BETWEEN '".$date1."'
         AND '".$date2."' ");

        $nom_site = '';
        $icone    = '';
        $email    = '';

        $info = $this->db->get('tbl_info')->result_array();
        foreach ($info as $key) {
          $nom_site = $key['nom_site'];
          $icone    = $key['icone'];
          $email    = $key['email'];
          
        }

        $output = '';
        $nomf;
        $created_at;
        $nom;
        $icone;

         

         $message = "REPUBLIQUE DEMOCRATIQUE DU CONGO <br/>
         <h3>
            Bon de sortie des produits ".$nom_site." du date de ".nl2br(substr(date(DATE_RFC822, strtotime($date1)), 0, 15))." au ".nl2br(substr(date(DATE_RFC822, strtotime($date2)), 0, 15))."
         <h3>
         ";

         $output = '<div align="right">';
         $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data" >';
         $output .= '
         <tr>
          <td width="25%"><img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100"/></td>
          <td width="50%" align="center">
           <p><b>'.$message.' </b></p>
           <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

           <hr>
           
          </td>

          <td width="25%">
          <img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100" />
          </td>


         </tr>
         ';
      
        $output .= '</table>';

         $output .= '</div>';

         $output .= '
            <table style="
                width: 100%;
                  margin-bottom: 1rem;
                  background-color: transparent;
                  border: 1px solid #dee2e6;
                  border-collapse: collapse;

             ">
              <thead>
                <tr>
                  <th>Photo</th>
                  <th>Nom du produit</th>
                  <th>Qte entrée</th>
                  <th>Categoré</th>
                  <th>Prix utinitaire</th>
                  <th>Mise à jour</th>
                </tr>
              </thead>
              <tbody>

          ';

            if ($data->num_rows() > 0) {

              foreach($data->result_array() as $items)
              {
                
                  $data_paie = $this->db->query("SELECT Count(product_id) AS montant FROM profile_sortie_stock 
                  WHERE created_at BETWEEN '".$date1."' AND '".$date2."' ");
                  if ($data_paie->num_rows() > 0) {
                      # code...
                      foreach($data_paie->result_array() as $items2)
                      {
                        $montantT =  $items2["montant"];
                      }

                  }
                  else{
                    $montantT = 0;
                  }

                   $retour = "javascript:history.go(-1);";

                   $output .= '

                   <!-- detail des produits commencent par ici
                  view ok fiche de stock -->
                  <tr>
                    <td>
                      <img src="'.base_url().'upload/product/'.$items["product_image"].'" style="height: 40px; width: 50px; border-radius: 50%;"/>
                    </td>
                    <td>'.$items["product_name"].'</td>
                    <td>'.$items["QteEntree"].'</td>
                    <td>'.$items["nom"].'</td>
                    <td>'.$items["product_price"].' $</td>
                    <td>'.nl2br(substr(date(DATE_RFC822, strtotime($items["created_at"])), 0, 23)).'</td>

                  </tr>
                  <!-- fin boucle -->

                   ';
              }

              $output .= '

                <tr>
                  <td colspan="5" align="right">Nombre Total de produit entrant &nbsp;&nbsp;</td>
                  <td>'.$montantT.' produit(s)</td>
                </tr>

               ';
              # code...
            }
            $output .= '
            </tbody>
          </table>

       
    
        <div align="right" style="margin-botton:20px;">

            <a href="'.base_url().'admin/stat_sortie" style="text-decoration: none; color: black;">signature:</a>
      
        </div>
       
        ';

        return $output;

    }

    // impression fiche de stock
    function Fiche_impressionFichedeStock()
    {

        $data = $this->db->get('fiche_de_stock');

        $nom_site = '';
        $icone    = '';
        $email    = '';

        $info = $this->db->get('tbl_info')->result_array();
        foreach ($info as $key) {
          $nom_site = $key['nom_site'];
          $icone    = $key['icone'];
          $email    = $key['email'];
          
        }

        $output = '';
        $nomf;
        $created_at;
        $nom;
        $icone;

         

         $message = "REPUBLIQUE DEMOCRATIQUE DU CONGO <br/>
         <h3>
            Fiche de stock pour les produits ".$nom_site."
         <h3>
         ";

         $output = '<div align="right">';
         $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data" >';
         $output .= '
         <tr>
          <td width="25%"><img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100"/></td>
          <td width="50%" align="center">
           <p><b>'.$message.' </b></p>
           <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

           <hr>
           
          </td>

          <td width="25%">
          <img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100" />
          </td>


         </tr>
         ';
      
        $output .= '</table>';

         $output .= '</div>';

         $output .= '
            <table border="1" style="
                width: 100%;
                margin-bottom: 1rem;
                background-color: transparent;
                border: 1px solid #dee2e6;
                border-collapse: collapse;
           ">
            <thead>
              <tr>
                <th rowspan="2" colspan="4">Entree</th>
                <th rowspan="2" colspan="3">Sortie</th>
                <th rowspan="2" colspan="3">Stock final</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th>Nom du produit</th>
                <th>Qte entrée</th>
                <th>Prix Unitaire</th>
                <th>Prix total</th>

                <th>Qte sortant</th>
                <th>Prix sortant</th>
                <th>Prix sortant</th>

                <th>Qte en stoock</th>
                <th>Prix en stoock</th>
                <th>Prix en stoock</th>
              </tr>
          ';

            if ($data->num_rows() > 0) {

              foreach($data->result_array() as $items)
              {
                
                  $data_paie = $this->db->query("SELECT Count(product_id) AS montant FROM fiche_de_stock ");
                  if ($data_paie->num_rows() > 0) {
                      # code...
                      foreach($data_paie->result_array() as $items2)
                      {
                        $montantT =  $items2["montant"];
                      }

                  }
                  else{
                    $montantT = 0;
                  }

                   $retour = "javascript:history.go(-1);";

                   $output .= '

                   <!-- detail des produits commencent par ici
                    view ok fiche de stock -->
                    <tr>
                      <td>'.$items["product_name"].'</td>
                      <td>'.$items["qte_E"].'</td>
                      <td>'.$items["pu_E"].' $</td>
                      <td>'.$items["pt_E"].' $</td>

                      <td>'.$items["qte_s"].'</td>
                      <td>'.$items["pu_s"].' $</td>
                      <td>'.$items["pt_s"].' $</td>

                      <td>'.$items["qte_stock"].'</td>
                      <td>'.$items["pu_stock"].' $</td>
                      <td>'.$items["pt_stock"].' $</td>
                      
                    </tr>
                    <!-- fin boucle -->

                   ';
              }

              $output .= '

                <tr>
                  <td colspan="9" align="right">Nombre Total de produit &nbsp;&nbsp;</td>
                  <td>'.$montantT.' produit(s)</td>
                </tr>

               ';
              # code...
            }
            $output .= '
            </tbody>
          </table>

       
    
        <div align="right" style="margin-botton:20px;">

            <a href="'.base_url().'admin/stat_entree" style="text-decoration: none; color: black;">signature:</a>
      
        </div>
       
        ';

        return $output;

    }


    /*

    LES SCRIPTS POUR LA GESTION D'AFFICHAGE DE PRODUITS COMMENCENTS
    =================================================================
    USER INTERFACE
    *************

    */

     /*
      favorie
     =======================
     */

     // ajouter au favorie
    function insert_to_favories($data)
    {
      $this->db->insert('favories', $data);
    } 

    function verification_favory($id_user, $product_id){
      return $this->db->get_where('favories', array(
        'id_user'     =>  $id_user,
        'product_id'  =>  $product_id  
      ));
    }

    // retourner le nom  
    function get_name_article_tag($product_id){
      $this->db->where("product_id", $product_id);
      $this->db->limit(1);
      $nom = $this->db->get("product")->result_array();
      foreach ($nom as $key) {
        $titre = $key["product_name"];
        return $titre ;
      }

    }

    // retourner les numéros  
    function get_telephone_du_site(){
      $this->db->limit(1);
      $nom = $this->db->get("tbl_info");
      $numeros = '';
      if ($nom->num_rows() > 0) {
        foreach ($nom->result_array() as $key) {
          $numeros = $key["tel1"].' ou '.$key["tel2"];
          
        }
      }
      else{
         $numeros ="+243817883541 ou +243970524665";
      }
      return $numeros ;
      

    }

     // retourner les numéros  
    function get_email_du_site(){
      $this->db->limit(1);
      $nom = $this->db->get("tbl_info");
      $numeros = '';
      if ($nom->num_rows() > 0) {
        foreach ($nom->result_array() as $key) {
          $numeros = $key["email"];
          
        }
      }
      else{
         $numeros ="etsyetu@gmail.com";
      }
      return $numeros ;
      

    }


   



    // ajouter au panier
    function insert_to_cart($data)
    {
      $this->db->insert('cart', $data);
    } 

    // suppression panier
    function suppression_produit_cart($idc){
      $this->db->where("idc", $idc);
      $this->db->delete("cart");
    }
    // insertion padding vente 
    function insert_pading_vente($data){
      $this->db->insert('pading_vente', $data);
    }

    // voir les administrateurs
    function get_admins(){
        $user = $this->db->get_where("users", array(
          'idrole'  =>  1
        ))->result_array();
        return $user;
    }

    // vider panier 
    function vide_suppression_produit_cart($user_id){
      $this->db->where("user_id", $user_id);
      $this->db->delete("cart");
    }
    // solde net à payer
    function calcul_net_apayer($user_id){
        $query = $this->db->query("SELECT SUM(product_priceTotal) AS total_a_payer FROM cart WHERE user_id= '".$user_id."'");
        $montant;
        if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $key) {
            $montant = $key['total_a_payer'];
          }
        }
        else{

          $montant = 0;
        }

        return $montant;

    }


    // solde net à payer
    function padding_vente_calcul_net_apayer($user_id, $code){
        $query = $this->db->query("SELECT SUM(product_priceTotal) AS total_a_payer FROM pading_vente WHERE user_id= '".$user_id."' AND code= '".$code."'");
        $montant;
        if ($query->num_rows() > 0) {
          foreach ($query->result_array() as $key) {
            $montant = $key['total_a_payer'];
          }
        }
        else{

          $montant = 0;
        }

        return $montant;

    }

    // detail des produits 
    function detail_cart($user_id){
      $this->db->order_by("idc","DESC");
      $query = $this->db->get_where("cart",array(
        'user_id' =>  $user_id
      ));
      return $query;
    }

    // detail des produits en attente de vente
    function padding_vente_detail_cart($user_id, $code){
      $this->db->order_by("idv","DESC");
      $query = $this->db->get_where("pading_vente",array(
        'user_id' =>  $user_id,
        'code' =>  $code,

      ));
      return $query;
    }

    // acheteur
    function detail_acheteur($id){
      $this->db->where("id", $id);
      $user = $this->db->get("users")->result_array();
      return $user;
    }




    // pagination product
    function fetch_pagination_product(){
      $this->db->limit(300);
      $query = $this->db->get("product");
      return $query->num_rows();
    }

     // recherche des produits par fultres
    function fetch_data_search_product_to_lean($query)
     {
      $this->db->select("*");
      $this->db->from("product");
      $this->db->limit(12);
      if($query != '')
      {
       $this->db->like('product_id', $query);
       $this->db->or_like('product_name', $query);
       $this->db->or_like('product_price', $query);

      }
      $this->db->order_by('product_name', 'ASC');
      return $this->db->get();
    }

    // pagination de produits
    function fetch_details_pagination_product($limit, $start){
        $output = '';
        $this->db->select("*");
        $this->db->from("product");
        $this->db->order_by("product_name", "ASC");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        
        foreach($query->result() as $row)
        {

         $output .= '
         
        <div class="col-xl-3 col-lg-4 col-sm-6">
          <div class="product text-center">
            <div class="position-relative mb-3">
              <div class="badge text-white badge-"></div><a class="d-block" href="javascript:void(0);"><img class="img-fluid w-100" src="'.base_url().'upload/product/'.$row->product_image.'" alt="..." style="height: 250px;"></a>
              <div class="product-overlay">
                <ul class="mb-0 list-inline">
                <input type="number" min="1" max="'.$row->Qte.'" name="quantity" class="form-control quantity" id="'.$row->product_id.'" placeholder="Entrez la quantité" /><br />
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark add_favory" href="javascript:void(0);" favoryProduct="'.$row->product_id.'"><i class="far fa-heart"></i></a></li> 
                  <li class="list-inline-item m-0 p-0">
                   <a class="btn btn-sm btn-dark add_cart" 
                      data-productname="'.$row->product_name.'" 
                      data-price="'.$row->product_price.'" 
                      data-productid="'.$row->product_id.'" 
                      data-product_image="'.$row->product_image.'" 
                      Qte="'.$row->Qte.'"
                      href="javascript:void(0);">
                    Ajouter au panier
                    </a></li>
                  <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark modalView" product_id="'.$row->product_id.'"><i class="fas fa-expand"></i></a></li>
                </ul>
              </div>
            </div>
            <h6> <a class="reset-anchor" href="'.base_url().'user/detailProduct/'.$row->product_id.'">'.$row->product_name.'</a></h6>
            <p class="small text-muted">'.$row->product_price.'$</p>
          </div>
        </div>



         ';
        }
        
        return $output;
    }
    // fin pagination

    // pagination de produits
    function fetch_details_pagination_product_shop($limit, $start){
        $output = '';
        $this->db->select("*");
        $this->db->from("product");
        $this->db->order_by("product_name", "ASC");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        
        foreach($query->result() as $row)
        {

         $output .= '

        <div class="col-lg-4 col-sm-6">
          <div class="product text-center">
            <div class="position-relative mb-3">
              <div class="badge text-white badge-"></div><a class="d-block" href="javascript:void(0);"><img class="img-fluid w-100" src="'.base_url().'upload/product/'.$row->product_image.'" alt="..." style="height: 250px;"></a>
              <div class="product-overlay">
                <ul class="mb-0 list-inline">
                <input type="number" min="1" max="'.$row->Qte.'" name="quantity" class="form-control quantity" id="'.$row->product_id.'" placeholder="Entrez la quantité" /><br />
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark add_favory" href="javascript:void(0);" favoryProduct="'.$row->product_id.'"><i class="far fa-heart"></i></a></li> 
                  <li class="list-inline-item m-0 p-0">
                   <a class="btn btn-sm btn-dark add_cart" 
                      data-productname="'.$row->product_name.'" 
                      data-price="'.$row->product_price.'" 
                      data-productid="'.$row->product_id.'" 
                      data-product_image="'.$row->product_image.'" 
                      Qte="'.$row->Qte.'"
                      href="javascript:void(0);">
                    + Au panier
                    </a></li>
                  <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark modalView" product_id="'.$row->product_id.'"><i class="fas fa-expand"></i></a></li>
                </ul>
              </div>
            </div>
            <h6> <a class="reset-anchor" href="'.base_url().'user/detailProduct/'.$row->product_id.'">'.$row->product_name.'</a></h6>
            <p class="small text-muted">'.$row->product_price.'$</p>
          </div>
        </div>



         ';
        }
        
        return $output;
    }
    // fin pagination

    // recent produits 
    function fetch_details_recent_products($limit, $start){
        $output = '';
        $this->db->select("*");
        $this->db->from("product");
        $this->db->order_by("product_id", "DESC");
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        
        foreach($query->result() as $row)
        {

         $output .= '

        <div class="col-lg-4 col-sm-6">
          <div class="product text-center">
            <div class="position-relative mb-3">
              <div class="badge text-white badge-"></div><a class="d-block" href="javascript:void(0);"><img class="img-fluid w-100" src="'.base_url().'upload/product/'.$row->product_image.'" alt="..." style="height: 250px;"></a>
              <div class="product-overlay">
                <ul class="mb-0 list-inline">
                <input type="number" min="1" max="'.$row->Qte.'" name="quantity" class="form-control quantity" id="'.$row->product_id.'" placeholder="Entrez la quantité" /><br />
                  <li class="list-inline-item m-0 p-0"><a class="btn btn-sm btn-outline-dark add_favory" href="javascript:void(0);" favoryProduct="'.$row->product_id.'"><i class="far fa-heart"></i></a></li> 
                  <li class="list-inline-item m-0 p-0">
                   <a class="btn btn-sm btn-dark add_cart" 
                      data-productname="'.$row->product_name.'" 
                      data-price="'.$row->product_price.'" 
                      data-productid="'.$row->product_id.'" 
                      data-product_image="'.$row->product_image.'" 
                      Qte="'.$row->Qte.'"
                      href="javascript:void(0);">
                    + Au panier
                    </a></li>
                  <li class="list-inline-item mr-0"><a class="btn btn-sm btn-outline-dark modalView" product_id="'.$row->product_id.'"><i class="fas fa-expand"></i></a></li>
                </ul>
              </div>
            </div>
            <h6> <a class="reset-anchor" href="'.base_url().'user/detailProduct/'.$row->product_id.'">'.$row->product_name.'</a></h6>
            <p class="small text-muted">'.$row->product_price.'$</p>
          </div>
        </div>



         ';
        }
        
        return $output;
    }
    // fin pagination

    // fultre selon la categorie des formations
   function fultrage_fetch_data_search_product_by_product_id($query)
   {
    
    $this->db->limit(24);
    $this->db->order_by('product_name', 'ASC');
    $resultat = $this->db->get_where("product", array(
      'product_id' =>  $query
    ));

    return $resultat;
   
   }

   // fultre selon la categorie des formations
   function fultrage_fetch_data_search_product_by_category_id($query)
   {
    
    $this->db->limit(24);
    $this->db->order_by('product_name', 'ASC');
    $resultat = $this->db->get_where("product", array(
      'category_id' =>  $query
    ));

    return $resultat;
   }

   // fultre selon le prix des formations
   function fultrage_fetch_data_search_product_by_product_price($query)
   {
    
    $this->db->limit(24);
    $this->db->order_by('product_name', 'ASC');
    $resultat = $this->db->get_where("product", array(
      'product_price' =>  $query
    ));

    return $resultat;
   }

   /*

   Gestion de paiement
   =====================================
   =====================================

   */

    function insert_paiement_pading($data){
        $this->db->insert('paiement_pading', $data);
        return $this->db->insert_id();
    }

    function insert_paiement_compte($data){
        $this->db->insert('paiement', $data);
        return $this->db->insert_id();
    }

    function get_name_user($id){
      $this->db->where("id", $id);
      $nom = $this->db->get("users")->result_array();
      foreach ($nom as $key) {
        return $key["first_name"];
      }

    }

     // script de contact 
  // contact
  function make_query_contact()  
  {  
      
     $this->db->select($this->select_column12);  
     $this->db->from($this->table12);  
     if(isset($_POST["search"]["value"]))  
     {  
          $this->db->like("sujet", $_POST["search"]["value"]);  
          $this->db->or_like("nom", $_POST["search"]["value"]);  
          $this->db->or_like("email", $_POST["search"]["value"]);  
     }  
     if(isset($_POST["order"]))  
     {  
          $this->db->order_by($this->order_column12[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
     }  
     else  
     {  
          $this->db->order_by('id', 'DESC');  
     }  
  }

  function make_datatables_contact(){  
     $this->make_query_contact();  
     if($_POST["length"] != -1)  
     {  
          $this->db->limit($_POST['length'], $_POST['start']);  
     }  
     $query = $this->db->get();  
     return $query->result();  
  }

  function get_filtered_data_contact(){  
     $this->make_query_contact();  
     $query = $this->db->get();  
     return $query->num_rows();  
  }       
  function get_all_data_contact()  
  {  
     $this->db->select("*");  
     $this->db->from($this->table12);  
     return $this->db->count_all_results();  
  }



  function update_contact($id, $data)  
  {  
     $this->db->where("id", $id);  
     $this->db->update("contact", $data);  
  }


  function delete_contact($id)  
  {  
     $this->db->where("id", $id);  
     $this->db->delete("contact");  
  }

  function fetch_single_contact($id)  
  {  
     $this->db->where("id", $id);  
     $query=$this->db->get('contact');  
     return $query->result();  
  }

  // script pour role du equipe
   function make_query_equipe()  
   {  
          
         $this->db->select($this->select_column3);  
         $this->db->from($this->table3);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idequipe", $_POST["search"]["value"]);  
              $this->db->or_like("nom", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column3[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idequipe', 'DESC');  
         }  
    }

   function make_datatables_equipe(){  
         $this->make_query_equipe();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_equipe(){  
         $this->make_query_equipe();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_equipe()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table3);  
         return $this->db->count_all_results();  
    }

    function insert_equipe($data)  
    {  
         $this->db->insert('equipe', $data);  
    }

    
    function update_equipe($idequipe, $data)  
    {  
         $this->db->where("idequipe", $idequipe);  
         $this->db->update("equipe", $data);  
    }


    function delete_equipe($idequipe)  
    {  
         $this->db->where("idequipe", $idequipe);  
         $this->db->delete("equipe");  
    }

    function fetch_single_equipe($idequipe)  
    {  
         $this->db->where("idequipe", $idequipe);  
         $query=$this->db->get('equipe');  
         return $query->result();  
    } 

    function fetch_single_equipe_name($nom)  
    {  
         $this->db->where("nom", $nom);  
         $query=$this->db->get('equipe');  
         return $query->result();  
    } 
    // fin de script equipe


    // script pour role du matchs
   function make_query_matchs()  
   {  
          
         $this->db->select($this->select_column4);  
         $this->db->from($this->table4);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idmath", $_POST["search"]["value"]);  
              $this->db->or_like("nomMatch", $_POST["search"]["value"]);
              $this->db->or_like("equipe2", $_POST["search"]["value"]);
              $this->db->or_like("nom_equipe1", $_POST["search"]["value"]);
              $this->db->or_like("jour", $_POST["search"]["value"]);
              $this->db->or_like("heure", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column4[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idmath', 'DESC');  
         }  
    }

   function make_datatables_matchs(){  
         $this->make_query_matchs();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_matchs(){  
         $this->make_query_matchs();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_matchs()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table4);  
         return $this->db->count_all_results();  
    }

    function insert_matchs($data)  
    {  
         $this->db->insert('matchs', $data);  
    }

    
    function update_matchs($idmath, $data)  
    {  
         $this->db->where("idmath", $idmath);  
         $this->db->update("matchs", $data);  
    }


    function delete_matchs($idmath)  
    {  
         $this->db->where("idmath", $idmath);  
         $this->db->delete("matchs");  
    }

    function fetch_single_matchs($idmath)  
    {  
         $this->db->where("idmath", $idmath);  
         $query=$this->db->get('matchs');  
         return $query->result();  
    } 
    // fin de script matchs

    function Select_formations_ok($column, $table)
    {
        $this->db->group_by($column);
        $this->db->limit(20);
        return $this->db->get($table);
    }

    // voir tous les messages 
   function count_all_message_users()
   {
    $query = $this->db->get("profile_client");
    return $query->num_rows();
   }

    // voir tous les messages 
   function count_all_reservations()
   {
    $query = $this->db->get("profile_reservation");
    return $query->num_rows();
   }

   // voir tous les messages 
   function count_all_reservations_ok()
   {
    $this->db->where("etat_reservation", 1);
    $query = $this->db->get("profile_reservation");
    return $query->num_rows();
   }

   // pagination users 
   function fetch_detailsmessage_users($limit, $start)
   {
    $output = '';
    $sexe = '';
    $adresse = "";
    $this->db->select("*");
    $this->db->from("profile_client");

    $this->db->order_by("id", "DESC");
    $this->db->limit($limit, $start);
    $query = $this->db->get();
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
      foreach($query->result() as $row)
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
        return $output;
   }

   function fetch_data_sms_users($query)
   {
      $this->db->select("*");
      $this->db->limit(10);
      $this->db->from("profile_client");
     
      if($query != '')
      {
       $this->db->like('id', $query);
       $this->db->or_like('first_name', $query);
       $this->db->or_like('last_name', $query);
       $this->db->or_like('telephone', $query);
      }
      $this->db->order_by('first_name', 'ASC');
      return $this->db->get();
   }

   function fetch_data_reservation_ok($query)
   {
      $this->db->select("*");
      $this->db->limit(10);
      $this->db->from("profile_reservation");
     
      if($query != '')
      {
       $this->db->like('nomEquipe', $query);
       $this->db->or_like('equipe2', $query);
       $this->db->or_like('jour', $query);
       $this->db->or_like('heure', $query);
       $this->db->or_like('first_name', $query);
       $this->db->or_like('last_name', $query);
       $this->db->or_like('telephone', $query);
       $this->db->or_like('nomMatch', $query);
       $this->db->or_like('nomPlace', $query);
      }
      $this->db->where("etat_reservation", 1);
      $this->db->order_by('first_name', 'ASC');
      return $this->db->get();
   }

   // script pour stade du site
   function make_query_stade()  
   {  
          
         $this->db->select($this->select_column5);  
         $this->db->from($this->table5);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idstade", $_POST["search"]["value"]);  
              $this->db->or_like("nom", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column5[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idstade', 'DESC');  
         }  
    }

   function make_datatables_stade(){  
         $this->make_query_stade();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_stade(){  
         $this->make_query_stade();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_stade()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table5);  
         return $this->db->count_all_results();  
    }

    function insert_stade($data)  
    {  
         $this->db->insert('stade', $data);  
    }

    
    function update_stade($idstade, $data)  
    {  
         $this->db->where("idstade", $idstade);  
         $this->db->update("stade", $data);  
    }


    function delete_stade($idstade)  
    {  
         $this->db->where("idstade", $idstade);  
         $this->db->delete("stade");  
    }

    function fetch_single_stade($idstade)  
    {  
         $this->db->where("idstade", $idstade);  
         $query=$this->db->get('stade');  
         return $query->result();  
    } 
    // fin de script stade

     // script pour place du site
   function make_query_place()  
   {  
          
         $this->db->select($this->select_column6);  
         $this->db->from($this->table6);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idstade", $_POST["search"]["value"]);  
              $this->db->or_like("nom", $_POST["search"]["value"]);
              $this->db->or_like("nomPlace", $_POST["search"]["value"]);
              $this->db->or_like("idplace", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column6[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idplace', 'DESC');  
         }  
    }

   function make_datatables_place(){  
         $this->make_query_place();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_place(){  
         $this->make_query_place();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_place()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table6);  
         return $this->db->count_all_results();  
    }

    function insert_place($data)  
    {  
         $this->db->insert('place', $data);  
    }

    
    function update_place($idplace, $data)  
    {  
         $this->db->where("idplace", $idplace);  
         $this->db->update("place", $data);  
    }


    function delete_place($idplace)  
    {  
         $this->db->where("idplace", $idplace);  
         $this->db->delete("place");  
    }

    function fetch_single_place($idplace)  
    {  
         $this->db->where("idplace", $idplace);  
         $query=$this->db->get('profile_place');  
         return $query->result();  
    } 

    function fetch_single_place_in_stadium($idstade, $nomPlace)  
    {    
         $query=$this->db->get_where("place",array(
          'idstade'     =>  $idstade,
          'nomPlace'    =>  $nomPlace
         ));  
         return $query->num_rows();  
    } 
    // fin de script place

    // script pour reservation du site
   function make_query_reservation()  
   {  
          
         $this->db->select($this->select_column7);  
         $this->db->from($this->table7);  
         if(isset($_POST["search"]["value"]))  
         {  
              $this->db->like("idstade", $_POST["search"]["value"]);  
              $this->db->or_like("nom", $_POST["search"]["value"]);
              $this->db->or_like("nomPlace", $_POST["search"]["value"]);
              $this->db->or_like("idplace", $_POST["search"]["value"]);
         }  
         if(isset($_POST["order"]))  
         {  
              $this->db->order_by($this->order_column7[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
         }  
         else  
         {  
              $this->db->order_by('idplace', 'DESC');  
         }  
    }

   function make_datatables_reservation(){  
         $this->make_query_reservation();  
         if($_POST["length"] != -1)  
         {  
              $this->db->limit($_POST['length'], $_POST['start']);  
         }  
         $query = $this->db->get();  
         return $query->result();  
    }

    function get_filtered_data_reservation(){  
         $this->make_query_reservation();  
         $query = $this->db->get();  
         return $query->num_rows();  
    }       
    function get_all_data_reservation()  
    {  
         $this->db->select("*");  
         $this->db->from($this->table7);  
         return $this->db->count_all_results();  
    }

    function insert_reservation($data)  
    {  
         $this->db->insert('reservation', $data);  
    }

    
    function update_reservation($idreservation, $data)  
    {  
         $this->db->where("idreservation", $idreservation);  
         $this->db->update("reservation", $data);  
    }


    function delete_reservation($idreservation)  
    {  
         $this->db->where("idreservation", $idreservation);  
         $this->db->delete("reservation");  
    }

    function fetch_single_reservation($idreservation)  
    {  
         $this->db->where("idreservation", $idreservation);  
         $query=$this->db->get('profile_reservation');  
         return $query->result();  
    } 

    function fetch_single_reservation_in_stadium($idstade,$idplace, $idmath)  
    {    
         $query=$this->db->get_where("reservation",array(
            'idstade'     =>  $idstade,
            'idplace'     =>  $idplace,
            'idmath'      =>  $idmath
         ));  
         return $query->num_rows();  
    } 
    // fin de script place

    // pagination users 
   function fetch_detail_reservations($limit, $start)
   {
    $output = '';
    $sexe = '';
    $adresse = "";
    $this->db->select("*");
    $this->db->from("profile_reservation");
    $this->db->order_by("idreservation", "DESC");
    $this->db->limit($limit, $start);
    $query = $this->db->get();
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
      foreach($query->result() as $row)
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
        return $output;
   }

    function fetch_single_personne_user($id)  
    {  
         $this->db->where("id", $id);  
         $query=$this->db->get('users');  
         return $query->result();  
    }

    function fetch_place_requete($idstade)
    {
      $this->db->where('idstade', $idstade);
      $this->db->order_by('nomPlace', 'ASC');
      $query = $this->db->get('place');
      $output = '<option value="">Selectionner une place à rester</option>';
      foreach($query->result() as $row)
      {
       $output .= '<option value="'.$row->idplace.'">'.$row->nomPlace.'</option>';
      }
      return $output;
    }

    // pagination users 
   function fetch_detail_reservations_ok($limit, $start)
   {
    $output = '';
    $sexe = '';
    $adresse = "";
    $this->db->select("*");
    $this->db->from("profile_reservation");
    $this->db->order_by("idreservation", "DESC");
     $this->db->where("etat_reservation", 1);
    $this->db->limit($limit, $start);
    $query = $this->db->get();
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
      foreach($query->result() as $row)
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
        return $output;
   }

   // impression fiche de stock
    function Fiche_billet($codeReservation)
    {

        $data = $this->db->get_where('profile_reservation', array(
          'etat_reservation'  =>  1,
          'codeReservation'   =>  $codeReservation

        ));

        $nom_site = '';
        $icone    = '';
        $email    = '';

        $info = $this->db->get('tbl_info')->result_array();
        foreach ($info as $key) {
          $nom_site = $key['nom_site'];
          $icone    = $key['icone'];
          $email    = $key['email'];
          
        }

        $output = '';
        $nomf;
        $created_at;
        $nom;
        $icone;


        foreach($data->result_array() as $items)
        {
            $nomEquipe = $items["nomEquipe"].' VS '.$items["equipe2"];
            $nomMatch = $items["nomMatch"];
            $NomComplet = $items["first_name"]." ".$items["last_name"];
            
            
        }

         

         

            if ($data->num_rows() > 0) {

              foreach($data->result_array() as $items)
              {
                
                $message = "<b>Droit de participation au match de footbal. Billet appartier au spectateur:".$NomComplet."</b>
                 <h3>
                    ".$nomMatch."
                 <h3>
                 ";

                 $output = '<div align="right"><hr>';
                 $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data">';
                 $output .= '
                 <tr>
                  <td width="25%"><img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100"/></td>
                  <td width="50%" align="center">
                   <p><b>'.$message.' </b></p>
                   <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

                   <hr>
                   
                  </td>

                  <td width="25%">
                  <img src="'.base_url().'upload/tbl_info/jlogo.jpg" width="150" height="100" />
                  </td>


                 </tr>
                 ';
              
                $output .= '</table>';

                 $output .= '</div>';

                 $output .= '
                    <table border="1" style="
                        width: 100%;
                        margin-bottom: 1rem;
                        background-color: transparent;
                        border: 1px solid #dee2e6;
                        border-collapse: collapse;
                   ">
                    <thead>
                      <tr>
                        <th>N° de billet</th>
                        <th>Date et heure</th>
                        <th>Stade</th>
                        <th>Place</th>
                        <th>Prix</th>
                      </tr>
                    </thead>
                    <tbody>
                      
                  ';
                  
                   $retour = "javascript:history.go(-1);";

                   $output .= '

                   <!-- detail des produits commencent par ici
                    view ok fiche de stock -->
                    <tr>
                      <td>
                          '.$items["codeReservation"].'
                          
                      </td>
                      <td>'.nl2br(substr(date(DATE_RFC822, strtotime($items["jour"])), 0, 23)).' Heure: '.$items["heure"].'</td>
                      <td>'.$items["nomStade"].'</td>
                      <td>'.$items["nomPlace"].'</td>
                      <td>'.$items["montant"].' $</td>

                    </tr>
                    <!-- fin boucle -->
                   ';


                   $output .= '
                      </tbody>
                    </table>
              
                    <div align="right" style="margin-botton:20px;">

                        <a href="'.base_url().'admin/billet" style="text-decoration: none; color: black;">signature:</a>
                  
                    </div>
                    <hr>


                 
                  ';


              }

             
            }
            

        return $output;

    }


    // impression fiche de stock
    function Fiche_Liste_billet_by_match($idmath)
    {

        $data = $this->db->get_where('profile_reservation', array(
          'etat_reservation'  =>  1,
          'idmath'            =>  $idmath

        ));

        $money;



        $montant = $this->db->query("SELECT SUM(montant) AS montant FROM profile_reservation WHERE idmath=".$idmath." AND etat_reservation=1");
        if ($montant->num_rows() > 0) {
          # code...
          foreach ($montant->result_array() as $key) {
            # code...
            $money = $key['montant'];
          }
        }
        else{
          $money = 0;
        }

        $nombre = $data->num_rows();

        $nom_site = '';
        $icone    = '';
        $email    = '';

        $info = $this->db->get('tbl_info')->result_array();
        foreach ($info as $key) {
          $nom_site = $key['nom_site'];
          $icone    = $key['icone'];
          $email    = $key['email'];
          
        }

        $output = '';
        $nomf;
        $created_at;
        $nom;
        $icone;

        if ($data->num_rows() > 0) {

          foreach($data->result_array() as $items)
          {

            $nomEquipe = $items["nomEquipe"].' VS '.$items["equipe2"];
            $nomMatch = $items["nomMatch"];
            $NomComplet = $items["first_name"]." ".$items["last_name"];
              
            $message = "<b>Droit de participation au match de footbal. Billet appartier au spectateur:".$NomComplet."</b>
             <h3>
                ".$nomMatch."
             <h3>
             ";

             $output .= '<div align="right"><hr>';
             $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data">';
             $output .= '
             <tr>
              <td width="25%"><img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100"/></td>
              <td width="50%" align="center">
               <p><b>'.$message.' </b></p>
               <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

               <hr>
               
              </td>

              <td width="25%">
              <img src="'.base_url().'upload/tbl_info/jlogo.jpg" width="150" height="100" />
              </td>


             </tr>
             ';
          
            $output .= '</table>';

             $output .= '</div>';

             $output .= '
                <table border="1" style="
                    width: 100%;
                    margin-bottom: 1rem;
                    background-color: transparent;
                    border: 1px solid #dee2e6;
                    border-collapse: collapse;
               ">
                <thead>
                  <tr>
                    <th>N° de billet</th>
                    <th>Date et heure</th>
                    <th>Stade</th>
                    <th>Place</th>
                    <th>Prix</th>
                  </tr>
                </thead>
                <tbody>
                  
              ';
              
               $retour = "javascript:history.go(-1);";

               $output .= '

               <!-- detail des produits commencent par ici
                view ok fiche de stock -->
                <tr>
                  <td>
                      '.$items["codeReservation"].'
                      
                  </td>
                  <td>'.nl2br(substr(date(DATE_RFC822, strtotime($items["jour"])), 0, 23)).' Heure: '.$items["heure"].'</td>
                  <td>'.$items["nomStade"].'</td>
                  <td>'.$items["nomPlace"].'</td>
                  <td>'.$items["montant"].' $</td>

                </tr>
                <!-- fin boucle -->
               ';


               $output .= '
                  </tbody>
                </table>
          
                <div align="right" style="margin-botton:20px;">

                    <a href="'.base_url().'admin/billet" style="text-decoration: none; color: black;">signature:</a>
              
                </div>
                <hr>


             
              ';


          }

         
        }
            

        return $output;

    }



     // voir tous les match 
   function count_all_match_bymatch($idmath)
   {

      $query = $this->db->get_where("profile_reservation", array(
        'idmath'              =>  $idmath,
        'etat_reservation'    =>  1
      ));
      return $query->num_rows();
    
   }

    // pagination users 
   function fetch_detailbille_de_match($limit, $start, $idmath)
   {
    $output = '';
    $this->db->limit($limit, $start);
    $query = $this->db->get_where("profile_reservation", array(
      'idmath'              =>  $idmath,
      'etat_reservation'    =>  1
    ));

    $money;
    $montant = $this->db->query("SELECT SUM(montant) AS montant FROM profile_reservation WHERE idmath=".$idmath." AND etat_reservation=1");
    if ($montant->num_rows() > 0) {
      # code...
      foreach ($montant->result_array() as $key) {
        # code...
        $money = $key['montant'];
      }
    }
    else{
      $money = 0;
    }


    $output .= '

    <div align="right" class="pull-right mb-2">
    <span class="badge badge-success mr-1"><i class="fa fa-money"></i> Montant total payer  :<b>'.$money.'$</b></span>
    <a href="'.base_url().'admin/pdf_billet_list/'.$idmath.'" class="btn btn-outline-primary btn-sm"><i class="fa fa-print mr-1"></i> PDF</a>
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
      foreach($query->result() as $row)
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
        return $output;
    }

    // appel de dates 
    function fetch_categores_dates_compt()
    {
        $this->db->group_by('jour');
        $this->db->order_by('jour','DESC');
        return $this->db->get('profile_reservation');
    }

    function get_stat_paie(){
          $chart_data = '';
          $montant;
          $nom = $this->db->query("SELECT SUM(montant) AS montant,jour FROM profile_reservation WHERE etat_reservation=1 GROUP BY jour")->result_array();
          foreach ($nom as $key) {

            $sexe = "jour:".nl2br(substr(date(DATE_RFC822, strtotime($key["jour"])), 0, 23));
            $montant = $key["montant"];
            $chart_data .= "{ indexLabel:'".$sexe."', y:".$montant."}, ";
            
          }

          return $chart_data;

    }

    // pour le paiement 
    function fetch_data_paiement_date($jour1, $jour2)
    {
        $query = $this->db->query("SELECT * FROM profile_reservation WHERE jour BETWEEN '".$jour1."' AND '".$jour2."' AND etat_reservation=1 ");
        return $query;
    }

     // pour le paiement 
    function fetch_data_paiement_date_montant($jour1, $jour2)
    {
        $money;
        $montant = $this->db->query("SELECT SUM(montant) AS montant FROM profile_reservation WHERE jour BETWEEN '".$jour1."' AND '".$jour2."' AND etat_reservation=1 ");
        if ($montant->num_rows() > 0) {
          # code...
          foreach ($montant->result_array() as $key) {
            # code...
            $money = $key['montant'];
          }
        }
        else{
          $money = 0;
        }
        return $money;
    }


    // pour la somme du paiement 
    function fetch_sum_data_paiement_date($jour1, $jour2)
    {
        $montant;
        $query = $this->db->query("SELECT SUM(montant) AS montant FROM profile_reservation WHERE jour BETWEEN '".$jour1."' AND '".$jour2."' AND etat_reservation=1 ");
        if ($query->num_rows() > 0) {
          # code...

          foreach ($query->result_array() as $key) {
            # code...
            $montant = $key['montant'];
          }
        }
        else{
          $montant = 0;
        }

        return $montant;
    }

     // impression paiement de galerie
    function fetch_single_details_listePaiement($jour1,$jour2)
    {

       $data = $this->db->query("SELECT * FROM profile_reservation WHERE jour BETWEEN '".$jour1."' AND '".$jour2."' ");

        $montantT = $this->fetch_sum_data_paiement_date($jour1, $jour2);
       

        $nom_site = '';
        $icone    = '';
        $email    = '';
        $retour = "javascript:history.go(-1);";

        $info = $this->db->get('tbl_info')->result_array();
        foreach ($info as $key) {
          $nom_site = $key['nom_site'];
          $icone    = $key['icone'];
          $email    = $key['email'];
          
        }

        $output = '';
        $nomf;
        $created_at;
        $nom;
        $icone;

         

        foreach($data->result_array() as $items)
        {
          
          $nomEquipe = $items["nomEquipe"].' VS '.$items["equipe2"];
            $nomMatch = $items["nomMatch"];
            $NomComplet = $items["first_name"]." ".$items["last_name"];
              
            $message = "<b>Droit de participation au match de footbal. Billet appartier au spectateur:".$NomComplet."</b>
             <h3>
                ".$nomMatch."
             <h3>
             ";

             $output .= '<div align="right"><hr>';
             $output .= '<table width="100%" cellspacing="5" cellpadding="5" id="user_data">';
             $output .= '
             <tr>
              <td width="25%"><img src="'.base_url().'upload/tbl_info/'.$icone.'" width="150" height="100"/></td>
              <td width="50%" align="center">
               <p><b>'.$message.' </b></p>
               <p><b>Mise à jour : </b>'.date('d/m/Y').'</p>

               <hr>
               
              </td>

              <td width="25%">
              <img src="'.base_url().'upload/tbl_info/jlogo.jpg" width="150" height="100" />
              </td>


             </tr>
             ';
          
            $output .= '</table>';

             $output .= '</div>';

             $output .= '
                <table border="1" style="
                    width: 100%;
                    margin-bottom: 1rem;
                    background-color: transparent;
                    border: 1px solid #dee2e6;
                    border-collapse: collapse;
               ">
                <thead>
                  <tr>
                    <th>N° de billet</th>
                    <th>Date et heure</th>
                    <th>Stade</th>
                    <th>Place</th>
                    <th>Prix</th>
                  </tr>
                </thead>
                <tbody>
                  
              ';
              
               $retour = "javascript:history.go(-1);";

               $output .= '

               <!-- detail des produits commencent par ici
                view ok fiche de stock -->
                <tr>
                  <td>
                      '.$items["codeReservation"].'
                      
                  </td>
                  <td>'.nl2br(substr(date(DATE_RFC822, strtotime($items["jour"])), 0, 23)).' Heure: '.$items["heure"].'</td>
                  <td>'.$items["nomStade"].'</td>
                  <td>'.$items["nomPlace"].'</td>
                  <td>'.$items["montant"].' $</td>

                </tr>
                <!-- fin boucle -->
               ';


               $output .= '
                  </tbody>
                </table>
          
                <div align="right" style="margin-botton:20px;">

                    <a href="'.base_url().'admin/billet" style="text-decoration: none; color: black;">signature:</a>
              
                </div>
                <hr>


             
              ';


        }

        return $output;
    }

    // pour le paiement 
    function fetch_data_limit_paiement($query)
    {
        $this->db->select("*");
        $this->db->from("profile_reservation");
       
        if($query != '')
        {
          $this->db->limit($query);
        }
        return $this->db->get();
    }


























   // validation
  function can_login($email, $password_ok)
  {
      $this->db->where('email', $email);
      $query = $this->db->get('users');
      if($query->num_rows() > 0)
      {
       foreach($query->result() as $row)
       {
          if($row->idrole == '1')
          {

             $password = md5($password_ok);
             $store_password = $row->passwords;
             if($password == $store_password)
             {
              $this->session->set_userdata('admin_login', $row->id);
             }
             else
             {
              return 'mot de passe incorrect';
             }

          }
          elseif($row->idrole == '2')
          {
             $password = md5($password_ok);
             $store_password = $row->passwords;
             if($password == $store_password)
             {
              $this->session->set_userdata('id', $row->id);
             }
             else
             {
              return 'mot de passe incorrect';
             }

          }
          elseif($row->idrole == '3')
          {
             $password = md5($password_ok);
             $store_password = $row->passwords;
             if($password == $store_password)
             {
              $this->session->set_userdata('instuctor_login', $row->id);
             }
             else
             {
              return 'mot de passe incorrect';
             }

            }
          else
          {
           return 'les informations incorrectes';
          }
          



       }
      }
      else
      {
       return 'adresse email incorrecte';
      }
    
  }


  function can_recuperation($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get('users');
        if($query->num_rows() > 0)
        {
            foreach($query->result() as $row)
            {
               
            }
        }
        else
        {
        return 'Adresse email non trouvée!!!!';
        }
    }


    // sauvegarde des donnees  et controle d'acces 
      function create_backup() 
      {
          $this->load->dbutil();
          $options = array(
              'format' => 'txt', 
              'add_drop' => TRUE,
              'add_insert' => TRUE,
              'newline' => "\n"
          );
          $tables = array('');
          $file_name = 'etsyetu';
          $backup = & $this->dbutil->backup(array_merge($options, $tables));
          $this->load->helper('download');
          force_download($file_name . '.sql', $backup);
      }

      function import_db()
      {
          $this->load->database();
          // $this->db->truncate('users');
          // $this->db->truncate('categorie_aprenant');
          // $this->db->truncate('derogation');
          // $this->db->truncate('edition');
          // $this->db->truncate('formation');
          // $this->db->truncate('inscription_formation');
          // $this->db->truncate('messagerie');
          // $this->db->truncate('notification');
          // $this->db->truncate('online');
          // $this->db->truncate('paiement');
          // $this->db->truncate('presence');
          // $this->db->truncate('question');
          // $this->db->truncate('recouvrement');
          // $this->db->truncate('recupere');
          // $this->db->truncate('reponse');
          // $this->db->truncate('role');
          // $this->db->truncate('rubrique');
          // $this->db->truncate('tbl_info');
          // $this->db->truncate('tranche');
          

          $file_n = $_FILES["file_name"]["name"];
          move_uploaded_file($_FILES["file_name"]["tmp_name"], "upload/" . $_FILES["file_name"]["name"]);
          $filename = "upload/".$file_n;
          $mysql_host = 'localhost';
          $mysql_username = 'root';
          $mysql_password = '';
          $mysql_database = 'media';
          mysql_connect($mysql_host, $mysql_username, $mysql_password) or die('Error connect to MySQL: ' . mysql_error());
          mysql_select_db($mysql_database) or die('Error to connect MySQL: ' . mysql_error());
          $templine = '';
          $lines = file($filename);
          foreach ($lines as $line)
          {
                  if (substr($line, 0, 2) == '--' || $line == '')
                  {
                      continue;
                  }
                  $templine .= $line;
                  if (substr(trim($line), -1, 1) == ';')
                  {
                      mysql_query($templine) or print('Error \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
                      $templine = '';
                  if (mysql_errno() == 1062) 
                  {
                  print 'no way!';
                  }
              }
          }
          unlink("upload/" . $file_n);

      }
    //fin validation et sauvegarde des données

}


?>