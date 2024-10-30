
<?php  include './header.php'; ?>

<?php  


include '../config.php';

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


		<?php 
		
		


    $ad_query = "SELECT * FROM admin";
    $ad_result = mysqli_query($conn, $ad_query);

    if (!$ad_result) {
        die("Query Failed" . mysqli_error($conn));
    }
?>

<div class="card-box mb-30">
    <h2 class="h4 pd-20">Admin Details</h2>

    <div class="pb-20">
        <table class="data-table table stripe hover nowrap">
            <thead>
                <tr>
                    <th class="table-plus datatable-nosort">id</th>
                    <th>user_id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Telephone</th>
                    <th>adress</th>
                    <th>Date</th>
                    <th class="datatable-nosort">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($row = mysqli_fetch_assoc($ad_result)) {
                    $id = $row['id'];
                    $ad_id = $row['user_id'];
                    $f_name = $row['fname'];
                    $s_name = $row['lname'];
                    $ad_email = $row['email'];
                    $ad_tp = $row['phone_number'];
                    $ad_address = $row['address'];
                    $ad_date = $row['date'];
                ?>
                    <tr>
                        <td class="table-plus"><?php echo $id; ?></td>
                        <td><?php echo $ad_id; ?></td>
                        <td><?php echo $f_name . $s_name ; ?></td>
                        <td><?php echo $ad_email; ?></td>
                        <td><?php echo $ad_tp; ?></td>
                        <td><?php echo $ad_address; ?></td>
                        <td><?php echo $ad_date; ?></td>
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
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

					<!-- Simple Datatable End -->
					
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

		






