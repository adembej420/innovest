<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Verify controller file exists
$controllerPath = '../../Controller/CondidatsC.php';
if (!file_exists($controllerPath)) {
    die("Error: Controller file not found at $controllerPath");
}

require_once $controllerPath;

try {
    $controller = new CondidatsC();
    $condidats = $controller->listCondidats();

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
    <title>Charts - SB Admin</title>
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
        .card-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #e9ecef;
            border-radius: 0 0 12px 12px;
        }
        canvas {
            max-height: 400px;
        }
        @media (max-width: 768px) {
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
                    <h1 class="mt-4 mb-3">Candidate Analytics</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Charts</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-body">
                            These charts visualize candidate data using Chart.js. The data is sourced from the candidates database. For more customization options, visit the
                            <a target="_blank" href="https://www.chartjs.org/docs/latest/">Chart.js documentation</a>.
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
    <script src="js/scripts.js"></script>
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
    </script>
</body>
</html>