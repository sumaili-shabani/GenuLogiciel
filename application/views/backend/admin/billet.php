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

                                  <div class="col-md-4">
                                   <select class="form-control" id="matchs" name="matchs">
                                      <?php 
                                        if ($matchs->num_rows() > 0) {
                                          ?>
                                          <option value="">Selectionnez un match</option>
                                          <?php
                                          foreach ($matchs->result_array() as $key) {
                                              ?>
                                                <option value="<?php echo($key['idmath']) ?>"><?php echo(substr($key['nomMatch'], 0,35)) ?>...</option>
                                              <?php
                                          }
                                        }
                                        else{

                                          ?>                                
                                          <option value="">Aucune catégorie n'est diponible</option>
                                          <?php
                                        }
                                      ?>
                                   </select>

                                  </div>
                                  <div class="col-md-3"> </div>

                                  <div class="col-md-5">
                                    <div class="col-md-12 mb-4 mt-2"><div class="form-group">
                                      <div class="input-group">

                                        
                                       
                                       <input type="text" name="search_text" id="search_text2" placeholder="Rechercher un billet" class="form-control mr-1" />
                                       <span class="input-group-addon btn btn-primary  mr-1"><i class="fa fa-search mr-2"></i></span>

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

                                  <input type="hidden" name="idmath" id="idmath" />



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


   <script type="text/javascript" language="javascript" >  
   $(document).ready(function(){ 

         var $message = ''; 
        
          // pour les utilisateurs 
          function load_sms_sender_users(page)
          {
            $.ajax({
              url:"<?php echo base_url(); ?>admin/pagination_reservation_client_ok/"+page,
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
             url:"<?php echo base_url(); ?>admin/search_reservation_client_ok",
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

          $(document).on('change', '#matchs', function(event) {
            event.preventDefault();
            /* Act on the event */
                var idmath = $(this).val();
                if (idmath !='') {
                  $('#idmath').val(idmath);
                  load_category_by_match(1);
                }
                else{

                  $('#idmath').val("");

                  swal("Erreur!!!"," Veillez selectionner un match 😰","error");
                }
          });

        
           // pour les utilisateurs 
          function load_category_by_match(page)
          {
            var idmath = $('#idmath').val();
            if (idmath !='') {

                $.ajax({
                  url:"<?php echo base_url(); ?>admin/pagination_match_billet/"+page,
                  method:"POST",
                  dataType:"json",
                  data:{idmath:idmath},
                  beforeSend:function()
                  {
                     $('#country_table2').html('<div id="loading" style="" ></div>');
                  },
                  success:function(data)
                  {
                    $('#country_table2').html(data.country_table);
                    $('#pagination_link2').html(data.pagination_link2);
                  }
                });
            }
          }

          $(document).on("click", ".pagination_filter li a", function(event){
            event.preventDefault();
            var page = $(this).data("ci-pagination-page");
            load_category_by_match(page);
          });

         

          




   });  
   </script>



</body>

</html>