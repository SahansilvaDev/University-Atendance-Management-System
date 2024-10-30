
<?php 
include './header.php'; 
include '../config.php';


?>

<?php

    $course_details_query = "SELECT * FROM degree_module";

    $course_details_result = mysqli_query ($conn ,$course_details_query  );

    if(!$course_details_result){
        echo "Error";
    }











?>
		
		
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />

		<div class="mobile-menu-overlay"></div>


				

					
				
					<div class="main-container">
    <div class="card-box mb-30">
        <h2 class="h4 pd-20">Module Details</h2>
        <div class="pb-20">
            <table class="data-table table stripe hover nowrap">
                <thead>
                    <tr>
                        <th class="table-plus datatable-nosort">Degree Name</th>
                        <th>Module Name</th>
                        <th>Faculty</th>
                        <th>Start Date</th>
                        <th class="datatable-nosort">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($course_details_result)) {
                        $degree_code = $row['degree_code'];
                        $degree_name = $row['degree_name'];
                        $Module_code = $row['module_code'];
                        $module_name = $row['module_name'];
                        $Faculty_code = $row['Faculty_code'];
                        $Faculty_name = $row['Faculty_name'];
                        $startdate = $row['date'];
                        ?>
                        <tr>
                            <td class="table-plus"><?php echo $degree_code . ' - ' . $degree_name; ?></td>
                            <td><?php echo $Module_code . ' - ' . $module_name; ?></td>
                            <td><?php echo $Faculty_code . ' - ' . $Faculty_name; ?></td>
                            <td><?php echo $startdate; ?></td>
                            <td>
                                <div class="dropdown">
                                    <a class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                                        <i class="dw dw-more"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                                        <a class="dropdown-item" href="#"><i class="dw dw-eye"></i> View</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-edit2"></i> Edit</a>
                                        <a class="dropdown-item" href="#"><i class="dw dw-delete-3"></i> Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


			<!-- js -->
			<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

		<script src="src/plugins/datatables/js/dataTables.buttons.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.print.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.html5.min.js"></script>
		<script src="src/plugins/datatables/js/buttons.flash.min.js"></script>
		<script src="src/plugins/datatables/js/pdfmake.min.js"></script>
		<script src="src/plugins/datatables/js/vfs_fonts.js"></script>

		<script src="vendors/scripts/datatable-setting.js"></script>
	
		<!-- End Google Tag Manager (noscript) -->

		

