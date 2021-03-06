<?php
	session_start();

	include '../../library/config.php';
	include '../../classes/class.equipment.php';
	include '../../classes/class.event.php';
	include '../../classes/class.category.php';
	include '../../classes/class.staff.php';
	include '../../classes/class.gymclass.php';
	include '../../classes/class.membership.php';

	$module = (isset($_GET['mod']) && $_GET['mod'] != '') ? $_GET['mod'] : '';
	$sub = (isset($_GET['sub']) && $_GET['sub'] != '') ? $_GET['sub'] : '';
	$subsub = (isset($_GET['subsub']) && $_GET['subsub'] != '') ? $_GET['subsub'] : '';
	$process = (isset($_GET['pro']) && $_GET['pro'] != '') ? $_GET['pro'] : '';

	$equipment = new Equipment();
	$staff = new Staff();
	$category = New Category();
	$gymclass = New GymClass();
	$membership = New Membership();

    if(!$staff->get_session())
            header('location: ../../index.php');
    else{
        switch($_SESSION['level']){
            case 'CASHIER':
                header('location: ../cashier/index.php');
            break;
            case 'COACH':
                header('location: ../coach/index.php');
            break;
            default:
                //do nothing
            break;
        }
    }

    date_default_timezone_set('Asia/Manila');
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="cache-control" content="no-cache">
		<META HTTP-EQUIV="Pragma" CONTENT="no-cache">

		<title>Admin Module</title>
        <link rel="icon" href="../../img/logo.png">

        <script src="../../js/jquery213.min.js"></script>

		<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed" rel="stylesheet">
		<link href="../../rsc/bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="../../rsc/magnific-popup/magnific-popup.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="../../css/module/module.css">
		<link rel="stylesheet" type="text/css" href="../../css/module/bootstrap_modal.css">
		<link rel="stylesheet" type="text/css" href="../../css/module/modal.css">
		<link rel="stylesheet" type="text/css" href="../../css/main.css">

		<script src="../../js/jquery.dataTables.min.js"></script>
		<script src="../../js/dataTables.bootstrap.min.js"></script>
		<link rel="stylesheet" href="../../css/module/dataTable_1_10_12_css_dataTables.bootstrap.min.css" />
		<script src="../../js/bootstrapv337.min.js"></script>
		<link href='../../css/module/fullcalendar.css' rel='stylesheet' />
		<script src="../../js/Chart.bundle.js"></script>
	</head>

	<body id="page-top">
		<div id="HEADER">
	       <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                            <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                        </button>
                        <a class="navbar-brand page-scroll" href="../../index.php"><img src="../../img/logo_long.png" alt="6100"></a>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a class="page-scroll" href="index.php?mod=dashboard">Dashboard</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="index.php?mod=managesvcs">Services</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="index.php?mod=equipment">Equipment</a>
                            </li>
                            <li>
                                <a class="page-scroll" href="index.php?mod=report">Reports</a>
                            </li>
                            <li class="login-btn hover-menu">
                                <a class="page-scroll"><?php echo strtoupper($_SESSION['username']);?><?php echo file_get_contents("../../svg/dropdown.svg");?></a>

                                <ul class="dropdown-menu">
                                    <a class="page-scroll" href="index.php?mod=profile"><li>Profile</li></a>
                                    <a class="page-scroll" href="index.php?mod=settings"><li>Settings</li></a>
                                    <a class="page-scroll" href="../../logout.php"><li>Logout</li></a>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container-fluid -->
            </nav>
		</div>

		<div id="MAIN_CONTENT">
			<?php
				switch($module){
					case 'dashboard':
						require_once 'dashboard/dashboard.php';
					break;
					case 'profile':
						require_once 'profile.php';
					break;
					case 'settings':
						require_once 'settings.php';
					break;
					case 'managesvcs':
						require_once 'managesvcs.php';
					break;
					case 'equipment':
						require_once 'equipments.php';
					break;
					case 'staff':
						require_once 'datatable/staff/index.php';
					break;
					case 'report':
						require_once 'reports.php';
					break;
					default:
						require_once 'dashboard/dashboard.php';
					break;
				}
			?>
		</div>
	</body>
</html>
