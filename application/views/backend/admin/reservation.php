<!DOCTYPE html>
<html lang="fr">

<head>

   <?php include('_meta.php') ?>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

      <?php include('_navigation.php') ?>

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <?php include('_menuheader.php') ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="col-md-12 card">
                       <div class="row card-body">
                           <!-- mes scripts commencent -->
                          
                           

                             <div class="col-md-12">
                              <div class="row">

                                  <div class="col-md-2">
                                  <!--  <select class="form-control" id="roles" name="roles">
                                      <?php 
                                        if ($roles->num_rows() > 0) {
                                          ?>
                                          <option value="">Selectionnez une catégorie</option>
                                          <?php
                                          foreach ($roles->result_array() as $key) {
                                            if ($key['idrole'] == 2) {
                                              # code...
                                              ?>
                                                <option value="<?php echo($key['idrole']) ?>"><?php echo(substr($key['nom'], 0,35)) ?>...</option>
                                              <?php
                                            }
                                          }
                                        }
                                        else{

                                          ?>                                
                                          <option value="">Aucune catégorie n'est diponible</option>
                                          <?php
                                        }
                                      ?>
                                   </select> -->

                                   <button class="btn btn-hub add_button"><i class="fa fa-send mb-2"></i> Sms</button>
                                  </div>
                                  <div class="col-md-3"> </div>

                                  <div class="col-md-7">
                                    <div class="col-md-12 mb-4 mt-2"><div class="form-group">
                                      <div class="input-group">

                                        
                                       
                                       <input type="text" name="search_text" id="search_text2" placeholder="Rechercher une reservation" class="form-control mr-1 mb-2" />
                                       <span class="input-group-addon btn btn-primary  mr-1"><i class="fa fa-search mb-2"></i></span>

                                        <button class="btn btn-secondary add_button2 mb-2"><i class="fa fa-send"></i> Effectuer l'opération</button>

                                      </div>
                                     </div>
                                   </div>
                                  </div>

                                  <div class="col-md-12">
                                    
                                      <hr>
                                  </div>



                                  <!-- resultat -->
                                  <div class="col-md-12 mb-2">
                                     
                                     <div class="col-md-12 table-responsive" id="country_table2">
                                      
                                      
                                     </div>
                                     <div class="col-md-12">

                                       <div align="right" class="col-md-12" id="pagination_link2"></div>
                                       
                                     </div>
                                  </div>
                                  <!-- fin resultat -->



                              </div>
                            </div>
                         
                           <!-- fin de mes scripts commencent -->
                       </div>
                   </div>
                     <!-- Fin Page Heading -->

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <?php include('_footer.php') ?>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

   
   <?php include('_script.php') ?>




     <!-- modal ajout radio -->
    <div class="modal fade" tabindex="-1" role="dialog" id="userModal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">

              <div class="modal-header bg-dark text-center">
                    <span class="nk-block-title modal-title text-white">Paramètrage admin</span>
                    
                </div>
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    
                    <div class="nk-block">

                        <form method="post" id="user_form" enctype="multipart/form-data" class="col-md-12 row">

                        <div class="form-group col-md-6">
                            <label><i class="fa fa-male"></i> Client</label>  
                                <select name="client_ok" id="client_ok" class="form-control selectpicker" data-live-search="true">
                                  <option value="">Selectionnez le client</option>
                                  <?php
                                    if ($clients->num_rows() > 0) {
                                     foreach ($clients->result_array() as $key) {
                                       ?>
                                         <option value="<?php echo($key['id']) ?>"><?php echo($key['first_name']) ?> <?php echo($key['last_name']) ?></option>
                                        <?php
                                     }
                                    }
                                    else{
                                      ?>
                                      <option value="">aucun client n'est disponible</option>
                                      <?php
                                    }
                                  ?>
                                  
                                </select>
                          </div>

                          <div class="form-group col-md-6">
                            <label><i class="fa fa-globe"></i> Selectionnez le match</label>  
                                <select name="match_ok" id="match_ok" class="form-control selectpicker" data-live-search="true">
                                  <option value="">Selectionnez le match</option>
                                  <?php
                                    if ($matchs->num_rows() > 0) {
                                     foreach ($matchs->result_array() as $key) {
                                       ?>
                                         <option value="<?php echo($key['idmath']) ?>"><?php echo($key['nomMatch']) ?></option>
                                        <?php
                                     }
                                    }
                                    else{
                                      ?>
                                      <option value="">aucun match n'est disponible</option>
                                      <?php
                                    }
                                  ?>
                                  
                                </select>
                          </div>


                          <div class="form-group col-md-6">
                            <label><i class="fa fa-university"></i> Selectionnez le stade</label>  
                                <select name="stade_ok" id="stade_ok" class="form-control selectpicker" data-live-search="true">
                                  <option value="">Selectionnez le stade</option>
                                  <?php
                                    if ($stades->num_rows() > 0) {
                                     foreach ($stades->result_array() as $key) {
                                       ?>
                                         <option value="<?php echo($key['idstade']) ?>"><?php echo($key['nom']) ?></option>
                                        <?php
                                     }
                                    }
                                    else{
                                      ?>
                                      <option value="">aucun stade n'est disponible</option>
                                      <?php
                                    }
                                  ?>
                                  
                                </select>
                          </div>

                          <div class="form-group col-md-6">
                            <label><i class="fa fa-map-marker"></i> Selectionnez la place</label>  
                                <select name="place_ok" id="place_ok" class="form-control" data-live-search="true">
                                  <option value="">Selectionnez la place</option>
                                  
                                  
                                </select>
                          </div>


                          <div class="form-group col-md-12 mb-2">
                              <label><i class="fa fa-money"></i> Saisissez le prix à payer</label>  
                              <input type="number" name="montant" min="1" id="montant" placeholder="LE prix en $ ex:40$" class="form-control">
                          </div>

                          <div class="col-md-12 aff">
                            <div class="row">
                              <div class="col-md-5">
                                <span id="nom_complet" class="text-center"></span>
                              </div>
                              
                              <div class="col-md-5">
                                <span id="info" class="text-center"></span>
                              </div>
                              <div class="col-md-2">
                                <span id="user_uploaded_image"></span>
                              </div>

                            </div>
                          </div>
                          
                          
                          
                        

                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <div class="buysell-field form-action text-center mb-2">
                                    <div>

                                      <input type="hidden" name="idclient" id="idclient" />
                                      <input type="hidden" name="idmath" id="idmath" />

                                      <input type="hidden" name="idstade" id="idstade" />
                                      <input type="hidden" name="idplace" id="idplace" />

                                      <input type="hidden" name="idreservation" id="idreservation" />

                                      <input type="hidden" name="operation" id="operation" />

                                      <input type="submit" name="action" id="action" class="btn btn-dark mb-2" value="Add" />
                                    </div>
                                    <div class="pt-3">
                                        <a href="javascript:void(0);" data-dismiss="modal" class="link link-danger">Annuler l'opération</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                          </div>
                        </div>

                        </form>
                        
                        
                        
                    </div><!-- .nk-block -->
                </div><!-- .modal-body -->
            </div><!-- .modal-content -->
        </div><!-- .modla-dialog -->
    </div>
    <!-- fin modal-->



    <div class="modal fade" id="userModal3">
      <div class="modal-dialog modal-md">
          <div class="modal-content">
              <div class="modal-header bg-secondary text-white">
                 <div class="modal-title">information personnele aux termes de contrat</div> 
              </div>
              
            

              <div class="modal-body">
                  <div class="col-md-12">
                      <div class="row">

                          
                       <form method="POST" id="user_form2" class="col-md-12">

                       <div class="col-md-12">
                          <div class="row">

                            
                              
                             <div class="col-md-12">
                                <label><i class="fa fa-envelope"></i>Entrez le message Message</label>
                                <textarea class="form-control textarea" id="message1" name="message" style="width: 100%; height: 100px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;" placeholder="Quoi de news?">
                                  
                                </textarea>
                               
                             </div>

                          </div>
                      </div>
                          

                          
                      </div>
                  </div>
              </div>
              <div class="modal-footer bg-white">

                  <button type="submit" class="btn btn-hub envoyer_message" name="valider" id="envoyer_message">
                      <i class="fa fa-send"></i> Envoyer
                  </button>
                  <a href="javascript:void(0);" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> fermer</a>
              </div> 
              </form>
              
          </div>
      </div>
    </div>






    <script type="text/javascript">
        $(document).ready(function(){
            //alert("boom");
            $('.add_button').click(function(e){ 
               e.preventDefault(); 
               $('#user_form')[0].reset();  
               $('.modal-title').text("Envoie des sms");  
               $('#action').val("Add"); 
               $('#userModal3').modal('show');  
            }); 

            $('.add_button2').click(function(e){ 
               e.preventDefault(); 
               $('#user_form')[0].reset();  
               $('.modal-title').text("Ajout d'une reservation");  
               $('#action').val("Add"); 
               $('#userModal').modal('show'); 
               $('#user_uploaded_image').html(''); 
               $('.aff').hide();  
            }); 
        });
    </script>

   <script type="text/javascript" language="javascript" >  
   $(document).ready(function(){ 

      var $message = ''; 
        $('#add_button').click(function(){  
             $('#user_form')[0].reset();  
             $('.modal-title').text("Ajout d'un utilisateur");  
             $('#action').val("Add");  
             $('#user_uploaded_image').html('');  
        })
        // var dataTable = $('#user_data').DataTable();
        


        $(document).on('submit', '#user_form', function(event){  
                 event.preventDefault();  
                 var idclient   = $('#idclient').val();  
                 var idmath     = $('#idmath').val(); 
                 var montant    = $('#montant').val();
                 var idstade    = $('#idstade').val();
                 var idplace    = $('#idplace').val();

                 var action     = $('#action').val();

                 if(idclient != '' && idmath != '' && montant != '' && idstade != '' && idplace != '')
                  {

                    if (action =="Add") {
                         
                        $.ajax({  
                             url:"<?php echo base_url() . 'admin/operation_reservation'?>",  
                             method:'POST',  
                             data:new FormData(this),  
                             contentType:false,  
                             processData:false,  
                             success:function(data)  
                             {  
                                  var message  = data;
                                  if (message == "echec!!!") {
                                    swal("Error!!!", "Erreur! la reservation pour cette place n'est pas disponible", "info");
                                  }
                                  else{
                                    swal('succès 👌', data, 'success');
                                    $('#user_form')[0].reset(); 
                                    $('#userModal').modal('hide'); 
                                  }

                                    
                                   
                                  load_sms_sender_users(1);  
                             }  
                        });
                         
                    }
                    if (action == 'Edit') {

                          $.ajax({  
                               url:"<?php echo base_url() . 'admin/modification_reservation'?>",  
                               method:'POST',  
                               data:new FormData(this),  
                               contentType:false,  
                               processData:false,  
                               success:function(data)  
                               {  
                                    
                                    var message =  data;
                                    swal("Succès!!!",message,'success');
                                    $('#userModal').modal('hide'); 

                                    load_sms_sender_users(1); 

                               }  
                          });

                    }

                  }
                  else
                  {
                    
                     var erreur = "Tous les champs doivent être remplis";
                     swal("Succès!!!",erreur,'error');

                  }


                   
            });  

        
           $(document).on('click', '.update', function(){  
             var idreservation = $(this).attr("idreservation");  
             $.ajax({  
                  url:"<?php echo base_url(); ?>admin/fetch_single_reservation",  
                  method:"POST",  
                  data:{idreservation:idreservation},  
                  dataType:"json",  
                  success:function(data)  
                  {  
                        $('#userModal').modal('show');  
                        $('#idclient').val(data.idclient);  
                        $('#idmath').val(data.idmath); 

                        $('#montant').val(data.montant);
                        $('#idstade').val(data.idstade);
                        $('#idplace').val(data.idplace);
                       
                        $('.modal-title').text("Modification de la reservation de"+data.first_name+" au match:"+data.nomMatch);
                          
                        $('#action').val("Edit"); 
                        $('#idreservation').val(idreservation); 

                        detail_user(data.idclient); 
                  }  
             });  
        });

        $(document).on('click', '.delete', function(event){
            event.preventDefault();
             var idreservation = $(this).attr("idreservation");
            
            if(confirm("Are you sure you want to delete this?"))
            {
              
                $.ajax({
                    url:"<?php echo base_url(); ?>admin/supression_reservation",
                    method:"POST",
                    data:{idreservation:idreservation},
                    success:function(data)
                    {
                       
                         var message =  data;
                         swal("Succès!!!",message,'success');
                         
                         load_sms_sender_users(1);
                    }
                  });
            }
            else
            {
              var erreur = "opération annulée :)";
              swal("Oups!!!",erreur,'info');
            }

        });

        $(document).on('click', '.valider', function(){  
            var idreservation = $(this).attr("idreservation"); 

            if(confirm("Etes-vous sûre de vouloire l'approuver?"))
            {
              
               $.ajax({  
                    url:"<?php echo base_url(); ?>admin/modification_Etat_reservation",  
                    method:"POST",  
                    data:{idreservation:idreservation},  
                    success:function(data)  
                    {  
                        load_sms_sender_users(1);  
                    }  
               });  
            }
            else
            {
              var erreur = "opération annulée :)";
              swal("Oups!!!",erreur,'info');
            } 
             
        });

       
      $("#client_ok").on("change", function() {

          var idclient = $(this).val();
          detail_user(idclient);
            
      });

      function detail_user(id_user){

        if (id_user !='') {
          
          $.ajax({  
                url:"<?php echo base_url(); ?>admin/fetch_single_personne_user",  
                method:"POST",  
                data:{id:id_user},  
                dataType:"json",  
                success:function(data)  
                {   
                     
                     $('.aff').show();
        
                     $('#nom_complet').text('NOM:'+data.first_name+' '+data.last_name+' '+data.prenom+' SEXE:'+data.sexe+' Date de naissance:'+data.date_nais);

                     $('#info').text('email:'+data.email+' adresse:'+data.full_adresse+' téléphone:'+data.telephone );

                     $('#user_uploaded_image').html(data.user_image);

                      $('#idclient').val(id_user);
                     
                }  
           });  

        }
        else{
           $('#idclient').val("");
          swal("Erreur!!!","veillez selectionner le nom de la personne","error");
        }

      } 

         $("#role_ok").on("change", function(t) {

              var idrole = $(this).val();
              if (idrole !='') {
                  $('#idrole').val(idrole);
              }
              else{

                   var erreur = "Veillez complèter son rôle au privilege 😰";
                   swal("Oups!!!",erreur,'error');
              }
          });


          // pour les utilisateurs 
          function load_sms_sender_users(page)
          {
            $.ajax({
              url:"<?php echo base_url(); ?>admin/pagination_reservation_client/"+page,
              method:"GET",
              dataType:"json",
              beforeSend:function()
              {
                 $('#country_table2').html('<div id="loading" style="" ></div>');
              },
              success:function(data)
              {
                $('#country_table2').html(data.country_table);
                $('#pagination_link2').html(data.pagination_link);
              }
            });
          }

          function search_message_users(query)
          {
            $.ajax({
             url:"<?php echo base_url(); ?>admin/search_reservation_client",
             method:"POST",
             data:{query:query},
              beforeSend:function()
              {
                 $('#country_table2').html('<div id="loading" style="" ></div>');
              },
             success:function(data){
              $('#country_table2').html(data);
             }
            })
           }



          $(document).on('keyup', '#search_text2', function(event) {
             event.preventDefault();
             /* Act on the event */
              var search = $(this).val();
              if(search != '')
              {
               search_message_users(search);
              }
              else
              {
                load_sms_sender_users(1);
              }
          });
           
         
          $(document).on("click", ".pagination2 li a", function(event){
            event.preventDefault();
            var page = $(this).data("ci-pagination-page");
            load_sms_sender_users(page);
          });

          load_sms_sender_users(1);

          $(document).on('change', '#stade_ok', function(){
              var idstade = $(this).val();
              if(idstade != '')
              {
                // alert(idstade);
                 $.ajax({
                    url:"<?php echo base_url(); ?>admin/fetch_stade_requete",
                    method:"POST",
                    data:{idstade:idstade},
                    beforeSend:function()
                    {
                       $('#place_ok').html('<div id="loading" style="" ></div>');
                    },
                    success:function(data)
                    {
                     $('#place_ok').html(data);

                     $('#idstade').val(idstade);

                    }
                 });
              }
              else
              {
                 $('#place_ok').html('<option value="">Selectionner un stade</option>');
                 swal("Error", "veillez completer le stade", "error");
                 $('#idstade').val("");
                 
              }
              // alert(idv);
          });

            $(document).on('change', '#place_ok', function(){
              var idplace = $(this).val();
              if(idplace != '')
              {
                // alert(idplace);
                 $('#idplace').val(idplace);
              }
              else
              {
                
                 swal("Error", "veillez completer la place", "error");
                 $('#idplace').val("");
              }
              // alert(idv);
            });

            $(document).on('change', '#match_ok', function(){
              var idmath = $(this).val();
              if(idmath != '')
              {
                // alert(idmath);
                 $('#idmath').val(idmath);
              }
              else
              {
                
                 swal("Error", "veillez completer le math de rencontre", "error");
                 $('#idmath').val("");
              }
              // alert(idv);
          });

         

          




   });  
   </script>



</body>

</html>