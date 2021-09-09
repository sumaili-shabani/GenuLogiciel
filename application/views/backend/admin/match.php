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
                <div class="container-fluid mb-4">

                    

                    <div class="col-md-12 card">
                    	<div class="row card-body">

                    		<!-- mes script commencent -->
		                      <div class="col-md-12">
		                         <div class="row">
		                           <div class="col-md-12">
		                             <button class="btn btn-dim btn-sm btn-outline-secondary pull-right  mb-4" id="add_button" data-toggle="modal" data-target="#userModal"><i class="fa fa-plus"></i>Effectuer l'opération</button>
		                           </div>
		                         </div>
		                      </div>
		                      <!-- insertion de tableau -->
		                      <div class="col-md-12">
		                        <div class="table-responsive">
		                            <table class="table-striped  nk-tb-list nk-tb-ulist dataTable no-footer" data-auto-responsive="false" id="user_data" role="grid" aria-describedby="DataTables_Table_1_info">
		                                <thead>  
		                                    <tr>  
		                                        <th width="20%">Rencontre</th>
                                            <th width="15%">Equipe domicile</th>
                                            <th width="15%">Equipe Adverse</th>
                                            <th width="15%">Jour</th>
                                            <th width="5%">Heure</th>

		                                        <th width="20%">Mise à jour</th>
		                                         
		                                        
		                                        <th width="5%">Modifier</th> 
		                                        <th width="5%">Supprimer</th>  
		                                    </tr>  
		                               </thead> 

		                               

                                    <tfoot>  
                                        <tr>  
                                            <th width="20%">Rencontre</th>
                                            <th width="15%">Equipe domicile</th>
                                            <th width="15%">Equipe Adverse</th>
                                            <th width="15%">Jour</th>
                                            <th width="5%">Heure</th>

                                            <th width="20%">Mise à jour</th>
                                             
                                            
                                            <th width="5%">Modifier</th> 
                                            <th width="5%">Supprimer</th>    
                                        </tr>  
                                   </tfoot>   
		                                
		                            </table>
		                        </div>
		                      </div>
		                      <!-- fin insertion tableau -->
		                      <!-- fin de mes scripts -->
		                   
		        			<!-- fin -->
                    		
                    	</div>
                    </div>

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
     <div id="userModal" class="modal fade">
      <div class="modal-dialog">
        <form method="post" id="user_form" enctype="multipart/form-data">
          <div class="modal-content">
            <div class="modal-header bg-dark text-white">
              <p class="modal-title text-center">role</p>
              <button type="button" class="close text-danger" data-dismiss="modal"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                    

                <div class="col-md-12">
                  <div class="row">

                    <div class="form-group col-md-12">
                         <label> <i class="fa fa-globe"></i> Entrer le nom de la rencontre</label>
                         <input type="text" name="nomMatch" id="nomMatch" class="form-control" placeholder="Entrez le nom d'une recontre" />
                    </div>

                    <div class="form-group col-md-6">
                      <label><i class="fa fa-male"></i> L'équipe domicile</label>  
                          <select name="equipe_domicile" id="equipe_domicile" class="select" data-live-search="true">
                            <option value="">Selectionnez l'équipe domicile</option>
                            <?php
                              if ($equipes->num_rows() > 0) {
                               foreach ($equipes->result_array() as $key) {
                                  ?>
                                  <option value="<?php echo($key['idequipe']) ?>"><?php echo($key['nom']) ?></option>
                                 <?php
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

                     <div class="form-group col-md-6">
                      <label><i class="fa fa-male"></i> L'équipe adverse</label>  
                          <select name="equipe_adverse" id="equipe_adverse" class="select" data-live-search="true">
                            <option value="">Selectionnez l'équipe adverse</option>
                            <?php
                              if ($equipes->num_rows() > 0) {
                               foreach ($equipes->result_array() as $key) {
                                  ?>
                                  <option value="<?php echo($key['idequipe']) ?>"><?php echo($key['nom']) ?></option>
                                  <?php
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




                    <div class="form-group col-md-6">
                         <label> <i class="fa fa-calendar"></i> Le jour du match</label>
                         <input type="date" name="jour" id="jour" class="form-control" />
                    </div>

                     <div class="form-group col-md-6 mb-2">
                         <label> <i class="fa fa-globe"></i> L'heure du match</label>
                         <input type="time" name="heure" id="heure" class="form-control"/>
                    </div>

                    <div class="col-md-12 info">
                      <div class="row">
                        <div class="col-2"></div>
                        <div class="col-3">
                          <div class="col-md-12" style="margin-top: 7px;">
                            <span id="user_uploaded_image"></span>
                          </div>
                        </div>
                        <div class="col-2"><h1 id="vs">VS</h1></div>
                        <div class="col-3">
                          <div class="col-md-12" style="margin-top: 7px;">
                            <span id="user_uploaded_image2"></span>
                          </div>
                        </div>
                        <div class="col-2"></div>
                        
                      </div>
                    </div>

                    
                  </div>
                </div>

                    
              
            </div>
            <div class="modal-footer">
              <input type="hidden" name="idmath" id="idmath" />

              <input type="hidden" name="equipe1" id="equipe1" />
              <input type="hidden" name="equipe2" id="equipe2" />

              <input type="hidden" name="operation" id="operation" />
              <input type="submit" name="action" id="action" class="btn btn-dark" value="Add" />
              <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-close"></i> Fermer</button>
            </div>
          </div>
        </form>
      </div>
    </div> 
    <!-- fin modal-->


     <script type="text/javascript" language="javascript" >  
     $(document).ready(function(){  

     	 var  $message = '';
          $('#add_button').click(function(){  
               $('#user_form')[0].reset();  
               $('.modal-title').text("Paramètrage des matchs");  
               $('#action').val("Add");  
               $('#vs').text("");
               $('#user_uploaded_image').html("");
               $('#user_uploaded_image2').html("");
          })  
          // var dataTable = $('#user_data').DataTable();
          var dataTable = $('#user_data').DataTable({  
               "processing":true,  
               "serverSide":true,  
               "order":[],  
               "ajax":{  
                    url:"<?php echo base_url() . 'admin/fetch_matchs'; ?>",  
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
               var nomMatch = $('#nomMatch').val();
               var equipe1 = $('#equipe1').val();
               var equipe2 = $('#equipe2').val();
               var jour = $('#jour').val();
               var heure = $('#heure').val();

               
               var action = $('#action').val();


               if(nomMatch != '' && equipe1 != '' && equipe2 != '' && jour != '' && heure != '')
                {

                  if (action =="Add") {
                       
                      $.ajax({  
                           url:"<?php echo base_url() . 'admin/operation_matchs'?>",  
                           method:'POST',  
                           data:new FormData(this),  
                           contentType:false,  
                           processData:false,  
                           success:function(data)  
                           {  
                                swal('succès 👌', data, 'success'); 
                               

                                $('#user_form')[0].reset();  
                                $('#userModal').modal('hide');  
                                dataTable.ajax.reload();  
                           }  
                      });

                  }
                  if (action == 'Edit') {

                        $.ajax({  
                             url:"<?php echo base_url() . 'admin/modification_matchs'?>",  
                             method:'POST',  
                             data:new FormData(this),  
                             contentType:false,  
                             processData:false,  
                             success:function(data)  
                             {  
                                  swal('succès 👌', data, 'success');
                                   

                                  $('#user_form')[0].reset();  
                                  $('#userModal').modal('hide');  
                                  dataTable.ajax.reload();  
                             }  
                        });

                  }

                }
                else
                {
                  swal("Erreur 🙆!!!", "Tous les champs doivent être remplis", "error");
                }


                 
          });  


          $(document).on('click', '.update', function(){  
               var idmath = $(this).attr("idmath");  
               $.ajax({  
                    url:"<?php echo base_url(); ?>admin/fetch_single_matchs",  
                    method:"POST",  
                    data:{idmath:idmath},  
                    dataType:"json",  
                    success:function(data)  
                    {  
                         $('#userModal').modal('show');  
                         $('#nomMatch').val(data.nomMatch);
                         $('#equipe1').val(data.equipe1);
                         $('#equipe2').val(data.equipe2);
                         $('#jour').val(data.jour);
                         $('#heure').val(data.heure);

                         showEquipeByName(data.equipe2);
                         showEquipe1(data.equipe1);
                         
                         $('.modal-title').text("modification du match "+data.nomMatch);  
                         $('#idmath').val(idmath);   
                         $('#action').val("Edit");  
                    }  
               });  
          });

          $(document).on('click', '.delete', function(){
              var idmath = $(this).attr("idmath");

              if(confirm("Are you sure you want to delete this?"))
		          {
		            
		           		$.ajax({
	                    url:"<?php echo base_url(); ?>admin/supression_matchs",
	                    method:"POST",
	                    data:{idmath:idmath},
	                    success:function(data)
	                    {
	                       swal('succès 👌', data, 'success');
	                        
	                       dataTable.ajax.reload();
	                    }

                  });
		          }
		          else
		          {
		            swal("Ouf!!!", "opération annulée :)", "info");
		          }

               

          });

          $(document).on('change', '#equipe_domicile', function(){  
               var idequipe = $(this).val();  
               showEquipe1(idequipe);
               
          });

          $(document).on('change', '#equipe_adverse', function(){  
               var idequipe = $(this).val();  
               showEquipe2(idequipe);
               
          });

          function showEquipe1(idequipe){
              if(idequipe !=''){

                $.ajax({  
                    url:"<?php echo base_url(); ?>admin/fetch_single_equipe",  
                    method:"POST",  
                    data:{idequipe:idequipe},  
                    dataType:"json",  
                    success:function(data)  
                    {  
                         $('#vs').text("VS");
                         $('#user_uploaded_image').html(data.user_image);
                         $('#equipe1').val(idequipe);
                    }  
                });  

              }
              else{
                swal("Error!!!", "Veillez completer l'équipe", "error");
                 $('#vs').text("");
                 $('#equipe1').val("");
              }
          }

          function showEquipe2(idequipe){
              if(idequipe !=''){

                  $.ajax({  
                      url:"<?php echo base_url(); ?>admin/fetch_single_equipe",  
                      method:"POST",  
                      data:{idequipe:idequipe},  
                      dataType:"json",  
                      success:function(data)  
                      {  
                           $('#equipe2').val(data.nom);
                           $('#vs').text("VS");  
                           $('#user_uploaded_image2').html(data.user_image);
                          
                      }  
                 });  

              }
              else{
                swal("Error!!!", "Veillez completer l'équipe", "error");
                $('#vs').text("");
                $('#equipe2').val("");
              }

          }

          function showEquipeByName(nom){
              if(nom !=''){

                  $.ajax({  
                      url:"<?php echo base_url(); ?>admin/fetch_single_equipe_by_name",  
                      method:"POST",  
                      data:{nom:nom},  
                      dataType:"json",  
                      success:function(data)  
                      {  
                           $('#equipe2').val(data.nom);
                           $('#vs').text("VS");  
                           $('#user_uploaded_image2').html(data.user_image);
                          
                      }  
                 });  

              }
              else{
                swal("Error!!!", "Veillez completer l'équipe adverse", "error");
                $('#vs').text("");
                $('#equipe2').val("");
              }

          }

          $('.select').selectpicker();

          






     });  
     </script>






</body>

</html>