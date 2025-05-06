<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify controller files exist
$condidatsControllerPath = '../../Controller/CondidatsC.php';
$skillsControllerPath = '../../Controller/CondidatsSkillsC.php';

if (!file_exists($condidatsControllerPath)) {
    die("Error: Condidats Controller file not found at $condidatsControllerPath");
}
if (!file_exists($skillsControllerPath)) {
    die("Error: CondidatsSkills Controller file not found at $skillsControllerPath");
}

require_once $condidatsControllerPath;
require_once $skillsControllerPath;

try {
    // Fetch candidates data
    $condidatsController = new CondidatsC();
    $condidats = $condidatsController->listCondidats();

    // Fetch skills data
    $skillsController = new CondidatsSkillsC();
    $condidatsSkills = $skillsController->listCondidatsSkills();

    // Process data for charts
    $candidatesByDate = [];
    $linkedinStats = ['With LinkedIn' => 0, 'Without LinkedIn' => 0];
    $cumulativeCandidates = [];

    foreach ($condidats as $c) {
        // Bar Chart: Candidates by registration date
        $date = date('Y-m-d', strtotime($c['date_enregistrement']));
        $candidatesByDate[$date] = ($candidatesByDate[$date] ?? 0) + 1;

        // Pie Chart: LinkedIn presence
        if (!empty($c['linkedin'])) {
            $linkedinStats['With LinkedIn']++;
        } else {
            $linkedinStats['Without LinkedIn']++;
        }
    }

    // Area Chart: Cumulative candidates over time
    ksort($candidatesByDate); // Sort dates
    $cumulativeCount = 0;
    foreach ($candidatesByDate as $date => $count) {
        $cumulativeCount += $count;
        $cumulativeCandidates[$date] = $cumulativeCount;
    }

    // Prepare data for JavaScript
    $dates = array_keys($candidatesByDate);
    $counts = array_values($candidatesByDate);
    $cumulativeDates = array_keys($cumulativeCandidates);
    $cumulativeCounts = array_values($cumulativeCandidates);
    $linkedinLabels = array_keys($linkedinStats);
    $linkedinCounts = array_values($linkedinStats);

    // Calculate summary statistics for cards
    $totalCandidates = count($condidats);
    $recentCandidates = count(array_filter($condidats, function($c) {
        return strtotime($c['date_enregistrement']) >= strtotime('-30 days');
    }));
    $withLinkedIn = $linkedinStats['With LinkedIn'];
    $avgRegistrationPerDay = $totalCandidates / (count($candidatesByDate) ?: 1);

} catch (Exception $e) {
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
    exit;
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
    <title>Dashboard - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
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
        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            border-radius: 0 0 12px 12px;
        }
        .table-container {
            overflow-x: auto;
        }
        .table {
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
        }
        .table thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            padding: 1rem;
            border-bottom: 2px solid #dee2e6;
        }
        .table tbody tr {
            transition: background-color 0.2s ease;
        }
        .table tbody tr:hover {
            background-color: #f1f3f5;
        }
        .table td {
            padding: 1rem;
            vertical-align: middle;
            color: #495057;
            font-size: 0.95rem;
        }
        .btn-action {
            padding: 0.4rem 0.8rem;
            font-size: 0.85rem;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-update {
            background-color: #0d6efd;
            color: #ffffff;
        }
        .btn-update:hover {
            background-color: #0b5ed7;
            color: #ffffff;
        }
        .btn-delete {
            background-color: #dc3545;
            color: #ffffff;
        }
        .btn-delete:hover {
            background-color: #c82333;
            color: #ffffff;
        }
        .no-data {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 2rem;
        }
        canvas {
            max-height: 400px;
        }
        #searchInput, #skillsSearchInput {
            max-width: 300px;
            border-radius: 6px;
            border: 1px solid #ced4da;
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
        }
        #searchInput:focus, #skillsSearchInput:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }
        @media (max-width: 768px) {
            .table thead {
                font-size: 0.75rem;
            }
            .table td {
                font-size: 0.85rem;
                padding: 0.75rem;
            }
            .btn-action {
                padding: 0.3rem 0.6rem;
                font-size: 0.75rem;
            }
            .card-header {
                font-size: 1rem;
                padding: 1rem;
            }
            .card-body {
                padding: 1rem;
            }
            canvas {
                max-height: 300px;
            }
            #searchInput, #skillsSearchInput {
                max-width: 100%;
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
                    <h1 class="mt-4 mb-3">Candidate Dashboard</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                    <div class="row">
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-primary text-white mb-4">
                                <div class="card-body">Total Candidates: <?php echo $totalCandidates; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="tables.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-success text-white mb-4">
                                <div class="card-body">Recent Candidates (30 Days): <?php echo $recentCandidates; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="tables.php">View Details</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-info text-white mb-4">
                                <div class="card-body">With LinkedIn: <?php echo $withLinkedIn; ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="charts.php">View Analytics</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-warning text-white mb-4">
                                <div class="card-body">Avg. Registrations/Day: <?php echo round($avgRegistrationPerDay, 1); ?></div>
                                <div class="card-footer d-flex align-items-center justify-content-between">
                                    <a class="small text-white stretched-link" href="charts.php">View Analytics</a>
                                    <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Candidates DataTable
                        </div>
                        <div class="card-body table-container">
                            <!-- Search Input for Candidates -->
                            <div class="mb-3">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search candidates by name, email, or phone..." aria-label="Search candidates" />
                            </div>
                            <table id="datatablesSimple" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nom</th>
                                        <th>Prénom</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>LinkedIn</th>
                                        <th>Portfolio</th>
                                        <th>Lettre de motivation</th>
                                        <th>Date d'enregistrement</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($condidats)) : ?>
                                        <?php foreach ($condidats as $c) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($c['id']) ?></td>
                                                <td><?= htmlspecialchars($c['nom']) ?></td>
                                                <td><?= htmlspecialchars($c['prenom']) ?></td>
                                                <td><?= htmlspecialchars($c['email']) ?></td>
                                                <td><?= htmlspecialchars($c['telephone']) ?></td>
                                                <td>
                                                    <?php if (!empty($c['linkedin'])) : ?>
                                                        <a href="<?= htmlspecialchars($c['linkedin']) ?>" target="_blank" class="text-primary">View</a>
                                                    <?php else : ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <?php if (!empty($c['portfolio'])) : ?>
                                                        <a href="<?= htmlspecialchars($c['portfolio']) ?>" target="_blank" class="text-primary">View</a>
                                                    <?php else : ?>
                                                        -
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($c['lettre_motivation'] ?: '-') ?></td>
                                                <td><?= htmlspecialchars($c['date_enregistrement']) ?></td>
                                                <td>
                                                    <a href="updateCondidats.php?id=<?= urlencode($c['id']) ?>" class="btn-action btn-update">Update</a>
                                                    <a href="deleteCondidats.php?id=<?= urlencode($c['id']) ?>" class="btn-action btn-delete" onclick="return confirm('Supprimer ce condidat ?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="10" class="no-data">No candidates found in the database.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Candidate Skills DataTable
                        </div>
                        <div class="card-body table-container">
                            <!-- Search Input for Skills -->
                            <div class="mb-3">
                                <input type="text" id="skillsSearchInput" class="form-control" placeholder="Search skills by name or level..." aria-label="Search skills" />
                            </div>
                            <table id="datatablesSkills" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Skill ID</th>
                                        <th>Candidate ID</th>
                                        <th>Skill Name</th>
                                        <th>Skill Level</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($condidatsSkills)) : ?>
                                        <?php foreach ($condidatsSkills as $s) : ?>
                                            <tr>
                                                <td><?= htmlspecialchars($s['skill_id']) ?></td>
                                                <td><?= htmlspecialchars($s['condidats_id']) ?></td>
                                                <td><?= htmlspecialchars($s['skill_name']) ?></td>
                                                <td><?= htmlspecialchars($s['skill_level']) ?></td>
                                                <td>
                                                    <a href="updateCondidatsSkills.php?id=<?= urlencode($s['skill_id']) ?>" class="btn-action btn-update">Update</a>
                                                    <a href="deleteCondidatsSkills.php?id=<?= urlencode($s['skill_id']) ?>" class="btn-action btn-delete" onclick="return confirm('Supprimer cette compétence ?')">Delete</a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <tr>
                                            <td colspan="5" class="no-data">No skills found in the database.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-chart-area me-1"></i>
                            Cumulative Candidates Over Time
                        </div>
                        <div class="card-body"><canvas id="myAreaChart" width="100%" height="30"></canvas></div>
                        <div class="card-footer small text-muted">Updated on <?php echo date('Y-m-d H:i:s'); ?></div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-bar me-1"></i>
                                    Candidates by Registration Date
                                </div>
                                <div class="card-body"><canvas id="myBarChart" width="100%" height="50"></canvas></div>
                                <div class="card-footer small text-muted">Updated on <?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <i class="fas fa-chart-pie me-1"></i>
                                    LinkedIn Profile Distribution
                                </div>
                                <div class="card-body"><canvas id="myPieChart" width="100%" height="50"></canvas></div>
                                <div class="card-footer small text-muted">Updated on <?php echo date('Y-m-d H:i:s'); ?></div>
                            </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
    <script src="js/datatables-simple-demo.js"></script>
    <script>
        // Area Chart: Cumulative Candidates Over Time
        var ctxArea = document.getElementById("myAreaChart").getContext("2d");
        new Chart(ctxArea, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($cumulativeDates); ?>,
                datasets: [{
                    label: "Cumulative Candidates",
                    lineTension: 0.3,
                    backgroundColor: "rgba(13, 110, 253, 0.2)",
                    borderColor: "rgba(13, 110, 253, 1)",
                    pointRadius: 5,
                    pointBackgroundColor: "rgba(13, 110, 253, 1)",
                    pointBorderColor: "rgba(255, 255, 255, 0.8)",
                    pointHoverRadius: 5,
                    pointHoverBackgroundColor: "rgba(13, 110, 253, 1)",
                    pointHitRadius: 50,
                    pointBorderWidth: 2,
                    data: <?php echo json_encode($cumulativeCounts); ?>,
                }],
            },
            options: {
                scales: {
                    xAxes: [{
                        time: { unit: 'date' },
                        gridLines: { display: false },
                        ticks: { maxTicksLimit: 7 }
                    }],
                    yAxes: [{
                        ticks: { min: 0, maxTicksLimit: 5 },
                        gridLines: { color: "rgba(0, 0, 0, .125)" }
                    }],
                },
                legend: { display: false }
            }
        });

        // Bar Chart: Candidates by Registration Date
        var ctxBar = document.getElementById("myBarChart").getContext("2d");
        new Chart(ctxBar, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($dates); ?>,
                datasets: [{
                    label: "Candidates",
                    backgroundColor: "rgba(13, 110, 253, 0.5)",
                    borderColor: "rgba(13, 110, 253, 1)",
                    data: <?php echo json_encode($counts); ?>,
                }],
            },
            options: {
                scales: {
                    xAxes: [{ gridLines: { display: false }, ticks: { maxTicksLimit: 6 } }],
                    yAxes: [{ ticks: { min: 0, maxTicksLimit: 5 }, gridLines: { display: true } }],
                },
                legend: { display: false }
            }
        });

        // Pie Chart: LinkedIn Profile Distribution
        var ctxPie = document.getElementById("myPieChart").getContext("2d");
        new Chart(ctxPie, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($linkedinLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($linkedinCounts); ?>,
                    backgroundColor: ['#0d6efd', '#6c757d'],
                    hoverBackgroundColor: ['#0b5ed7', '#5c636a'],
                }],
            },
            options: {
                legend: { display: true, position: 'bottom' }
            }
        });

        // Dynamic Search for Candidates DataTable
        const candidatesTable = new simpleDatatables.DataTable("#datatablesSimple");
        document.getElementById("searchInput").addEventListener("input", function() {
            candidatesTable.search(this.value);
        });

        // Dynamic Search for Skills DataTable
        const skillsTable = new simpleDatatables.DataTable("#datatablesSkills");
        document.getElementById("skillsSearchInput").addEventListener("input", function() {
            skillsTable.search(this.value);
        });
    </script>
</body>
</html>