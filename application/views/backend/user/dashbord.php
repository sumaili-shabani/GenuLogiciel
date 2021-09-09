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
                           <!-- mes scripts commencent -->
                          	<div class="col-lg-12 mt-5">
                              <div class="row">

                                  <!-- fin de blocs  -->

                                  <!-- Earnings (Monthly) Card Example -->
                                  <div class="col-xl-4 col-md-6 mb-4">
                                      <div class="card border-left-primary shadow h-100 py-2">
                                          <div class="card-body">
                                              <div class="row no-gutters align-items-center">
                                                  <div class="col mr-2">
                                                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                          Nombre Total des matchs</div>
                                                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($nombre_matchs); ?></div>
                                                  </div>
                                                  <div class="col-auto">
                                                      <a href="<?php echo(base_url()) ?>user/calendrier">
                                                          <i class="fas fa-home fa-2x text-gray-300"></i>
                                                      </a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                  <!-- Earnings (Annual) Card Example -->
                                  <div class="col-xl-4 col-md-6 mb-4">
                                      <div class="card border-left-success shadow h-100 py-2">
                                          <div class="card-body">
                                              <div class="row no-gutters align-items-center">
                                                  <div class="col mr-2">
                                                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                           Mes paiements </div>
                                                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($nombre_paiement); ?></div>
                                                  </div>
                                                  <div class="col-auto">
                                                      <a href="<?php echo(base_url()) ?>user/reservation">
                                                          
                                                          <i class="fas fa-dollar fa-2x text-gray-300"></i>
                                                      </a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                 

                                  <!-- Pending Requests Card Example -->
                                  <div class="col-xl-4 col-md-6 mb-4">
                                      <div class="card border-left-warning shadow h-100 py-2">
                                          <div class="card-body">
                                              <div class="row no-gutters align-items-center">
                                                  <div class="col mr-2">
                                                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                          Les spectateurs </div>
                                                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo($nombre_users); ?></div>
                                                  </div>
                                                  <div class="col-auto">
                                                      <a href="javascript:void(0);">
                                                          
                                                          <i class="fas fa-group fa-2x text-gray-300"></i>
                                                      </a>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                                  
                              </div>
                          </div>
                           <!-- fin de mes scripts commencent -->
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

    <script type="text/javascript">
	  

	    var chart = new CanvasJS.Chart("chartContainer2", {
	        theme: "theme2",
	        animationEnabled: true,
	        title: {
	            text: ""
	        },
	        data: [
		        {
		            type: "pie",
		            showInLegend: true,
	                legendText: "{indexLabel}",                
		            dataPoints: [<?php echo $chart_data; ?>]
		        }
	        ]
	    });
	    chart.render();


	</script>

</body>

</html>