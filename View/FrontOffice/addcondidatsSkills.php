<?php
require_once __DIR__ . '/../../controller/CondidatsSkillsC.php';


$error = "";
$skill = null;
// create an instance of the controller
$skillController = new CondidatsSkillsController();

if (
    isset($_POST["condidats_id"]) && 
    isset($_POST["skill_name"]) && 
    isset($_POST["skill_level"])
) {
    if (
        !empty($_POST["condidats_id"]) && 
        !empty($_POST["skill_name"]) && 
        !empty($_POST["skill_level"])
    ) {
        $skill = new CondidatsSkills(
            null,
            $_POST['condidats_id'],
            $_POST['skill_name'],
            $_POST['skill_level']
        );
            
        $skillController->addSkill($skill);
        header('Location:skillsList.php');
    } else {
        $error = "Missing information";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <title>Add Candidate Skill - Dashboard</title>
    
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
                <div class="sidebar-brand-text mx-3">Skills Management</div>
            </a>
            
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            
            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="#">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            
            <li class="nav-item active">
                <a class="nav-link" href="skillsList.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Candidates Skills List</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->
        
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                </nav>
                <!-- End of Topbar -->
                
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Add a Candidate Skill</h1>
                    </div>
                    
                    <!-- Content Row -->
                    <div class="row">
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-12 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <form id="addSkillForm" action="" method="POST">
                                            <label for="condidats_id">Candidate ID:</label><br>
                                            <input class="form-control form-control-user" type="number" id="condidats_id" name="condidats_id">
                                            <span id="condidats_id_error"></span><br>
                                            
                                            <label for="skill_name">Skill Name:</label><br>
                                            <input class="form-control form-control-user" type="text" id="skill_name" name="skill_name">
                                            <span id="skill_name_error"></span><br>
                                            
                                            <label for="skill_level">Skill Level:</label><br>
                                            <select class="form-control form-control-user" id="skill_level" name="skill_level">
                                                <option value="Beginner">Beginner</option>
                                                <option value="Intermediate">Intermediate</option>
                                                <option value="Advanced">Advanced</option>
                                                <option value="Expert">Expert</option>
                                            </select>
                                            <span id="skill_level_error"></span><br>
                                            
                                            <button type="submit" 
                                                    class="btn btn-primary btn-user btn-block" 
                                                    onClick="validerFormulaire()">Add Skill</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright © Skills Management 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <script src="js/addSkill.js"></script>
    
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
    
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>
    
    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>
    
    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>
</body>
</html>