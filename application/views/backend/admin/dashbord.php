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

                   <div class="col-md-12 card">
                       <div class="row card-body">
                           <!-- mes scripts commencent -->
                          	<?php include('component/__stat_dashbord.php') ?>
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
	  var chart = new CanvasJS.Chart("chartContainer", {
	        theme: "theme2",
	        animationEnabled: true,
	        title: {
	            text: ""
	        },
	        data: [
		        {
		            type: "area",
		            showInLegend: true,
	                legendText: "{indexLabel}",                
		            dataPoints: [<?php echo $chart_data2; ?>]
		        }
	        ]
	    });
	    chart.render();

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


	    var chart3 = new CanvasJS.Chart("chartContainer3", {
	        theme: "theme2",
	        animationEnabled: true,
	        title: {
	            text: ""
	        },
	        data: [
		        {
		            type: "bar",
		            showInLegend: true,
	                legendText: "{indexLabel}",                
		            dataPoints: [<?php echo $chart_data2; ?>]
		        }
	        ]
	    });
	    chart3.render();


	    var chart4 = new CanvasJS.Chart("chartContainer4", {
	        theme: "theme2",
	        animationEnabled: true,
	        title: {
	            text: ""
	        },
	        data: [
		        {
		            type: "area",
		            showInLegend: true,
	                legendText: "{indexLabel}",                
		            dataPoints: [<?php echo $chart_data3; ?>]
		        }
	        ]
	    });
	    chart4.render();

	</script>

</body>

</html>