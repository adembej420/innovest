<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify controller file exists
$skillsControllerPath = '../../Controller/CondidatsSkillsC.php';
if (!file_exists($skillsControllerPath)) {
    die("Error: CondidatsSkills Controller file not found at $skillsControllerPath");
}

require_once $skillsControllerPath;

// Initialize variables
$skill_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$errors = [];
$success = '';
$skill = null;

try {
    $skillsController = new CondidatsSkillsC();

    // Fetch skill data
    if ($skill_id > 0) {
        $skill = $skillsController->getSkillById($skill_id);
        if (!$skill) {
            $errors[] = "Skill not found.";
        }
    } else {
        $errors[] = "Invalid skill ID.";
    }

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $skill_name = trim($_POST['skill_name'] ?? '');
        $skill_level = trim($_POST['skill_level'] ?? '');

        // Validation
        if (empty($skill_name)) {
            $errors[] = "Skill name is required.";
        }
        if (empty($skill_level)) {
            $errors[] = "Skill level is required.";
        }

        if (empty($errors)) {
            // Update skill
            $data = [
                'skill_name' => $skill_name,
                'skill_level' => $skill_level
            ];
            if ($skillsController->updateSkill($skill_id, $data)) {
                $success = "Skill updated successfully.";
                // Redirect to tables.php after 1 second
                header("Refresh: 1; url=tables.php");
            } else {
                $errors[] = "Failed to update skill. Please try again.";
            }
        }
    }
} catch (Exception $e) {
    $errors[] = "Error: " . htmlspecialchars($e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Update Skill - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f5f6fa;
            font-family: 'Inter', sans-serif;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            font-weight: 600;
            color: #343a40;
            padding: 1.5rem;
            border-radius: 12px 12px 0 0;
        }
        .card-body {
            padding: 2rem;
        }
        .form-label {
            font-weight: 500;
            color: #495057;
        }
        .form-control {
            border-radius: 6px;
            font-size: 0.95rem;
        }
        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        .btn-primary {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 0.5rem 1.5rem;
            font-size: 0.95rem;
            border-radius: 6px;
        }
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
        }
        .alert {
            border-radius: 6px;
        }
        @media (max-width: 768px) {
            .card-header {
                font-size: 1rem;
                padding: 1rem;
            }
            .card-body {
                padding: 1rem;
            }
        }
    </style>
</head>
<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php">Start Bootstrap</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            <div class="input-group">
                <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
            </div>
        </form>
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="#!">Settings</a></li>
                    <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="#!">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Core</div>
                        <a class="nav-link" href="index.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            Dashboard
                        </a>
                        <div class="sb-sidenav-menu-heading">Interface</div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                            Layouts
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Pages
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Authentication
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="login.html">Login</a>
                                        <a class="nav-link" href="register.html">Register</a>
                                        <a class="nav-link" href="password.html">Forgot Password</a>
                                    </nav>
                                </div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                    Error
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="401.html">401 Page</a>
                                        <a class="nav-link" href="404.html">404 Page</a>
                                        <a class="nav-link" href="500.html">500 Page</a>
                                    </nav>
                                </div>
                            </nav>
                        </div>
                        <div class="sb-sidenav-menu-heading">Addons</div>
                        <a class="nav-link" href="charts.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                            Charts
                        </a>
                        <a class="nav-link" href="tables.php">
                            <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                            Tables
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    Start Bootstrap
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-5">
                    <h1 class="mt-4 mb-3">Update Skill</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="tables.php">Candidates</a></li>
                        <li class="breadcrumb-item active">Update Skill</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-edit me-1"></i>
                            Edit Skill Details
                        </div>
                        <div class="card-body">
                            <?php if (!empty($errors)) : ?>
                                <div class="alert alert-danger">
                                    <?php foreach ($errors as $error) : ?>
                                        <p class="mb-0"><?= htmlspecialchars($error) ?></p>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif; ?>
                            <?php if ($success) : ?>
                                <div class="alert alert-success">
                                    <p class="mb-0"><?= htmlspecialchars($success) ?></p>
                                </div>
                            <?php endif; ?>
                            <?php if ($skill) : ?>
                                <form method="POST" action="">
                                    <div class="mb-3">
                                        <label for="skill_name" class="form-label">Skill Name</label>
                                        <input type="text" class="form-control" id="skill_name" name="skill_name" value="<?= htmlspecialchars($skill['skill_name']) ?>" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="skill_level" class="form-label">Skill Level</label>
                                        <select class="form-control" id="skill_level" name="skill_level" required>
                                            <option value="Beginner" <?= $skill['skill_level'] === 'Beginner' ? 'selected' : '' ?>>Beginner</option>
                                            <option value="Intermediate" <?= $skill['skill_level'] === 'Intermediate' ? 'selected' : '' ?>>Intermediate</option>
                                            <option value="Advanced" <?= $skill['skill_level'] === 'Advanced' ? 'selected' : '' ?>>Advanced</option>
                                            <option value="Expert" <?= $skill['skill_level'] === 'Expert' ? 'selected' : '' ?>>Expert</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Update Skill</button>
                                    <a href="tables.php" class="btn btn-secondary">Cancel</a>
                                </form>
                            <?php else : ?>
                                <p class="text-danger">Unable to load skill data.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright © Your Website 2023</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            ·
                            <a href="#">Terms & Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>
</html>