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

                                 
                                  <div class="col-md-5">
                                    
                                  </div>

                                  <div class="col-md-7">
                                    <div class="col-md-12 mb-4 mt-2"><div class="form-group">
                                      <div class="input-group">

                                        
                                       
                                       <input type="text" name="search_text" id="search_text2" placeholder="Rechercher un client" class="form-control mr-1" />
                                       <span class="input-group-addon btn btn-primary  mr-1"><i class="fa fa-search mr-2"></i></span>

                                        <button class="btn btn-secondary add_button"><i class="fa fa-send"></i> Effectuer l'opération</button>

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
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">

              <div class="modal-header bg-dark text-center">
                    <span class="nk-block-title modal-title text-white">Paramètrage admin</span>
                    
                </div>
                <a href="#" class="close" data-dismiss="modal"><em class="icon ni ni-cross-sm"></em></a>
                <div class="modal-body modal-body-lg">
                    
                    <div class="nk-block">

                        <form method="post" id="user_form" enctype="multipart/form-data" class="col-md-12 row">
                            
                          <div class="col-md-12">
                          <div class="row">

                           

                            <div class="col-md-6 form-group">
                              
                              <label><i class="fa fa-user"></i> nom</label>  
                                  <input type="text" name="first_name" id="first_name" class="form-control" required="required" placeholder="Nom" /> 
                            </div>
                            <div class="col-md-6 form-group">
                              <label><i class="fa fa-user"></i> postnom</label>  
                                  <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Postnom" required="required" />
                            </div>

                            <div class="form-group col-md-6">
                              <label><i class="fa fa-google"></i> email</label>  
                                  <input type="text" name="email" id="email" class="form-control" required="required" placeholder="nom@gmail.com" /> 
                            </div>


                            <div class="form-group col-md-6">
                              <label><i class="fa fa-phone"></i> téléphone</label>  
                                  <input type="text" name="telephone" id="telephone" class="form-control" placeholder="+243817883541" /> 
                            </div>

                            

                            <div class="form-group col-md-12">
                              <label><i class="fa fa-calendar"></i> date de naissace</label>  
                                  <input type="date" name="date_nais" id="date_nais" class="form-control" required="required" /> 
                            </div>

                            <div class="form-group col-md-6">
                              <label><i class="fa fa-male"></i> Son Sexe</label>  
                                  <select name="sexe_ok" id="sexe_ok" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Selectionnez son sexe</option>
                                    <option value="M">masculin</option>
                                    <option value="F">feminin</option>
                                  </select>
                            </div>

                            <div class="form-group col-md-6">
                              <label><i class="fa fa-male"></i> Son rôle</label>  
                                  <select name="role_ok" id="role_ok" class="form-control selectpicker" data-live-search="true">
                                    <option value="">Selectionnez son privilege</option>
                                    <?php
                                      if ($roles->num_rows() > 0) {
                                       foreach ($roles->result_array() as $key) {
                                         if ($key['idrole'] ==2) {
                                           ?>
                                           <option value="<?php echo($key['idrole']) ?>"><?php echo($key['nom']) ?></option>
                                           <?php
                                         }
                                       }
                                      }
                                      else{
                                        ?>
                                        <option value="">aucun privilege n'est disponible</option>
                                        <?php
                                      }
                                    ?>
                                    
                                  </select>
                            </div>

                           <!--  <div class="form-group col-md-6">
                              <label><i class="fa fa-facebook"></i> Facebook</label>  
                                  <input type="text" name="facebook" id="facebook" class="form-control" placeholder="Adresse facebook" /> 
                            </div>

                            <div class="form-group col-md-6">
                              <label><i class="fa fa-twitter"></i> Twitter</label>  
                                  <input type="text" name="twitter" id="twitter" class="form-control" placeholder="Adresse twitter" /> 
                            </div>

                            <div class="form-group col-md-12">
                              <label><i class="fa fa-linkedin"></i> Linkedin</label>  
                                  <input type="text" name="linkedin" id="linkedin" class="form-control" placeholder="Adresse linkedin" /> 
                            </div>


                            <div class="form-group col-md-12">
                                    <label><i class="fa fa-camera"></i> Selectionner l'image de l'utilisateur</label>
                                    <input type="file" name="user_image" id="user_image" class="form-control" />
                                    
                            </div>
                            -->
                                

                            <div class="form-group jf-inputwithicon col-md-12">
                                <label><i class="fa fa-map-marker"></i> Adresse domicile</label>
                                <textarea class="form-control" name="full_adresse" id="full_adresse" placeholder="Adresse domicile"></textarea>
                            </div>

                            



                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="row">

                            <div class="col-md-1 mb-2"></div>
                            <div class="col-md-10">
                              <div class="col-md-12">
                                <div class="row">
                                  <div class="col-3"></div>
                                  <div class="col-6">
                                    <div class="col-md-12" style="margin-top: 7px;">
                                      <span id="user_uploaded_image"></span>
                                    </div>
                                  </div>
                                  <div class="col-3"></div>
                                  
                                </div>
                              </div>
                              
                              
                            </div>
                            <div class="col-md-1"></div>
                            
                          </div>
                        </div>

                        <div class="col-md-12">
                          <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                              <div class="buysell-field form-action text-center mb-2">
                                    <div>

                                      <input type="hidden" name="sexe" id="sexe" />
                                      <input type="hidden" name="idrole" id="idrole" />
                                      <input type="hidden" name="id" id="id" />
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
               $('.modal-title').text("Ajout d'un client");  
               $('#action').val("Add"); 
               $('#userModal').modal('show');  
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
        var dataTable = $('#user_data').DataTable({  
             "processing":true,  
             "serverSide":true,  
             "order":[],  
             "ajax":{  
                  url:"<?php echo base_url() . 'admin/fetch_users'; ?>",  
                  type:"POST"  
             },  
             "columnDefs":[  
                  {  
                       "targets":[0, 0, 0],  
                       "orderable":false,  
                  },  
             ],  
        });


        $(document).on('submit', '#user_form', function(event){  
                 event.preventDefault();  
                 var first_name   = $('#first_name').val();  
                 var last_name  = $('#last_name').val(); 
                 var email    = $('#email').val();
                 
                 var idrole       = $('#idrole').val(); 
                 var action       = $('#action').val();

                 // var extension  = $('#user_image').val().split('.').pop().toLowerCase(); 
                 // if(extension != '')  
                 // {  
                 //      if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                 //      {  

                 //           var erreur = "Invalid Image File";
                 //           swal("Succès!!!",erreur,'error');

                 //           $('#user_image').val('');  
                 //           return false;  
                 //      }  
                 // }

                


                 if(first_name != '' && last_name != '' && email != '' && idrole != '' )
                  {

                    if (action =="Add") {
                         
                        $.ajax({  
                             url:"<?php echo base_url() . 'admin/operation_users_client'?>",  
                             method:'POST',  
                             data:new FormData(this),  
                             contentType:false,  
                             processData:false,  
                             success:function(data)  
                             {  
                                  var message =  data;
                                  swal("Succès!!!",message,'success');

                                  $('#user_form')[0].reset();  
                                  $('#userModal').modal('hide');  
                                   load_sms_sender_users(1); 
                             }  
                        });
                          // alert("insertion");

                    }
                    if (action == 'Edit') {

                          $.ajax({  
                               url:"<?php echo base_url() . 'admin/modification_users_client'?>",  
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
             var id = $(this).attr("id");  
             $.ajax({  
                  url:"<?php echo base_url(); ?>admin/fetch_single_users",  
                  method:"POST",  
                  data:{id:id},  
                  dataType:"json",  
                  success:function(data)  
                  {  
                        $('#userModal').modal('show');  
                        $('#first_name').val(data.first_name);  
                        $('#last_name').val(data.last_name); 

                        $('#email').val(data.email);
                        $('#telephone').val(data.telephone);
                        $('#full_adresse').val(data.full_adresse);
                        $('#biographie').val(data.biographie);
                        $('#date_nais').val(data.date_nais);

                        $('#telephone').val(data.telephone);

                        $('#sexe').val(data.sexe);
                        $('#facebook').val(data.facebook);
                        $('#linkedin').val(data.linkedin);
                        $('#twitter').val(data.twitter);
                        $('#idrole').val(data.idrole);

                       $('.modal-title').text("détail de profile et information de l'utilisateur "+data.first_name);
                       $('#user_uploaded_image').html(data.user_image);
                       $('#user_uploaded_image2').html(data.user_image2);  
                       $('#action').val("Edit"); 
                       $('#id').val(id);  
                  }  
             });  
        });

        $(document).on('click', '.delete', function(event){
            event.preventDefault();
             var id = $(this).attr("id");
            
            if(confirm("Are you sure you want to delete this?"))
            {
              
                $.ajax({
                    url:"<?php echo base_url(); ?>admin/supression_users",
                    method:"POST",
                    data:{id:id},
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

       
      $("#sexe_ok").on("change", function(t) {

          var sexe = $(this).val();
              if (sexe !='') {
                $('#sexe').val(sexe);
              }
              else{

                  $('#sexe').val("");

                  var erreur = "Veillez complèter son sexe 😰";
                 swal("Oups!!!",erreur,'error');
                 
              }
        })

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

         const showErrrorMessage = function(erreur) {
            swal("Oups!!!", erreur, "info");
          };

          const showSuccessMessage = function(message) {
            swal("Succès!!!", message, "success");
          };


          // pour les utilisateurs 
          function load_sms_sender_users(page)
          {
            $.ajax({
              url:"<?php echo base_url(); ?>admin/pagination_message_users/"+page,
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
             url:"<?php echo base_url(); ?>admin/search_message_users",
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

         

          




   });  
   </script>



</body>

</html>