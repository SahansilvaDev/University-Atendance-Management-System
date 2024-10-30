<?php
include './header.php';
include '../config.php';

$querys = "SELECT * FROM faculty";
$result1 = mysqli_query($conn, $querys);

$querys = "SELECT * FROM teacher";
$result = mysqli_query($conn, $querys);

// Form submission handling

?>


<div class="main-container">

    <div class="pd-20 card-box">
        <h5 class="h4 text-blue mb-20">Users Adding Section</h5>
        <div class="pd-20">
            <div class="admin_main ">
                <div class="row">
                    <div class="col-md-12">

                        <h2 class="h4 pd-20">Faculty Details</h2>

                        <form action="./php/Faculty_hed_update.php" method="post">

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Faculty Name</label>

                                        <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="Update_Faculty">
                                            <?php
                                            // if (mysqli_num_rows($result) > 0) {
                                            //     while ($row = mysqli_fetch_assoc($result)) {
                                            //         $faculty_id = $row['id']; // Assuming faculty_id is the primary key
                                            //         $faculty_name = $row['faculty_name'];
                                            //         echo "<option value='$faculty_id'>$faculty_name</option>";
                                            //     }
                                            // } else {
                                            //     echo "<option value=''>No faculty available</option>";
                                            // }
                                            ?>
                                        </select>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Faculty Name</label>

                                        <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="Update_Faculty">
                                            <?php
                                            // if (mysqli_num_rows($result) > 0) {
                                            //     while ($row = mysqli_fetch_assoc($result)) {
                                            //         $faculty_id = $row['id']; // Assuming faculty_id is the primary key
                                            //         $faculty_name = $row['faculty_name'];
                                            //         echo "<option value='$faculty_id'>$faculty_name</option>";
                                            //     }
                                            // } else {
                                            //     echo "<option value=''>No faculty available</option>";
                                            // }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                            </div>


                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label>Faculty Name</label>

                                        <select class="selectpicker form-control" data-style="btn-outline-primary" title="Not Chosen" multiple data-selected-text-format="count" data-count-selected-text="{0} selected" name="Update_Faculty">
                                            <?php
                                            // if (mysqli_num_rows($result) > 0) {
                                            //     while ($row = mysqli_fetch_assoc($result)) {
                                            //         $faculty_id = $row['id']; // Assuming faculty_id is the primary key
                                            //         $faculty_name = $row['faculty_name'];
                                            //         echo "<option value='$faculty_id'>$faculty_name</option>";
                                            //     }
                                            // } else {
                                            //     echo "<option value=''>No faculty available</option>";
                                            // }
                                            ?>
                                        </select>
                                    </div>
                                </div>


                                <div class="col-sm-6  mt-4 pt-2">



                                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>


                                </div>


                            </div>


                        </form>


                    </div>
                </div>
            </div>


                                                    <!--  -->
                                                    <h2 class="h4 pd-20  mt-3 mb-3">Student Details</h2>

                                                    <table class="data-table table stripe hover nowrap">
								<thead>
									<tr>
										<th class="table-plus datatable-nosort">Name</th>
										<th>Age</th>
										<th>Office</th>
										<th>Address</th>
										<th>Start Date</th>
										<th class="datatable-nosort">Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="table-plus">Gloria F. Mead</td>
										<td>25</td>
										<td>Sagittarius</td>
										<td>2829 Trainer Avenue Peoria, IL 61602</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>30</td>
										<td>Gemini</td>
										<td>1280 Prospect Valley Road Long Beach, CA 90802</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>20</td>
										<td>Gemini</td>
										<td>2829 Trainer Avenue Peoria, IL 61602</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>30</td>
										<td>Sagittarius</td>
										<td>1280 Prospect Valley Road Long Beach, CA 90802</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>25</td>
										<td>Gemini</td>
										<td>2829 Trainer Avenue Peoria, IL 61602</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>20</td>
										<td>Sagittarius</td>
										<td>1280 Prospect Valley Road Long Beach, CA 90802</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>18</td>
										<td>Gemini</td>
										<td>1280 Prospect Valley Road Long Beach, CA 90802</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>30</td>
										<td>Sagittarius</td>
										<td>1280 Prospect Valley Road Long Beach, CA 90802</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>30</td>
										<td>Sagittarius</td>
										<td>1280 Prospect Valley Road Long Beach, CA 90802</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>30</td>
										<td>Gemini</td>
										<td>1280 Prospect Valley Road Long Beach, CA 90802</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>30</td>
										<td>Gemini</td>
										<td>1280 Prospect Valley Road Long Beach, CA 90802</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
									<tr>
										<td class="table-plus">Andrea J. Cagle</td>
										<td>30</td>
										<td>Gemini</td>
										<td>1280 Prospect Valley Road Long Beach, CA 90802</td>
										<td>29-03-2018</td>
										<td>
											<div class="dropdown">
												<a
													class="btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle"
													href="#"
													role="button"
													data-toggle="dropdown"
												>
													<i class="dw dw-more"></i>
												</a>
												<div
													class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
												>
													<a class="dropdown-item" href="#"
														><i class="dw dw-eye"></i> View</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-edit2"></i> Edit</a
													>
													<a class="dropdown-item" href="#"
														><i class="dw dw-delete-3"></i> Delete</a
													>
												</div>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
					<!-- Simple Datatable End -->





                                                        <!--  -->



        </div>
    </div>
</div>








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




<?php
// include './footer.php';

?>