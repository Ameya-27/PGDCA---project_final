<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['user_master_id'])) {
	
	$page_title = "admin";
	$Dashboard = "ADMIN";
	$Department = "DEPARTMENT";
	$Employee = "EMPLOYEE";
	$Dashboard_link = "admin-dashboard.php";
	$Department_link = "../department/create_dept.php";
	$All_Employee = "ALL EMPLOYEES";
	$My_Team = "MY TEAM";
	$AllEmployee_link = "allEmployee.php";
	$MyTeam_link = "admin_myteam.php";
	$Parameter = "PARAMETER";
	$Parameter_link = "../parameter/view_para.php";
	$Evaluation_link = "../evaluation_form/view_admin_task.php";
	$Evaluation =  "Evaluation";
	$user_icon = "../assets/images/others/admin-default.png";
	$edit = "../edit_profile/edit_profile.php";
	$Session_name = $_SESSION['name'];
	$name = "$Session_name";
	$Report_link = "../report/report.php";
	$logout = "../logout.php";
	
	include "../master/db_conn.php";
	include "../master/pre-header.php"; ?>

	<?php
	include "../master/close_header.php";
	include "../master/header.php";
	include "../master/navbar_admin.php";
	include "../master/breadcrumbs.php" ?>
	<!-- system logo button start-->
	<button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#logo" style="float:right;">
		Change system logo
	</button>
	<!-- system logo button end-->

	<!-- system logo modal start-->
	<div class="modal fade" id="logo" tabindex="-1" aria-labelledby="logoModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="logoModalLabel">Select logo</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form action="logo.php" method='post' enctype="multipart/form-data">


					<div class="modal-body">
						<div class="form-group">
							<div class="input-affix">
								<input type="file" class="form-control" id="file-upload" name="file-upload">
							</div>
						</div>
						<div class="form-group">
							<div class="input-affix">
								
								<input type="text" class="form-control" id="company_name" name="company_name" placeholder="Enter your company name">
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary" name="submit" value="submit">submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- system logo modal end-->
	<div style="padding:30px;">
		<?php if (isset($_GET['error'])) { ?>
			<div class="alert alert-danger" role="alert">
				<?= $_GET['error'] ?>
			</div>
		<?php }
		?>

	</div>

	<div class="container d-flex justify-content-center align-items-center" style="min-height: 30vh">
		<div class="card" style="width: 18rem;">
			<img src="../assets/images/others/admin-default.png" class="card-img-top" alt="admin image">
			<div class="card-body text-center">
				<h5 class="card-title">
					<?= ucfirst($_SESSION['name']) ?>
				</h5>
			</div>
		</div>
	</div>


	<?php
	include "../master/footer.php";
	include "../master/after-footer.php";
	?>
<?php } else {
	header("Location:../login.php");
} ?>