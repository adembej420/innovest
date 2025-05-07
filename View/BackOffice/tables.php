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

    // Debug: Check if data is retrieved
    if (empty($condidats)) {
        echo "<p><strong>Debug:</strong> No data returned from listCondidats(). Check database connection or table data.</p>";
    } else {
        echo "<p><strong>Debug:</strong> " . count($condidats) . " candidate records retrieved.</p>";
    }

    // Debug: Check skills data
    if (empty($condidatsSkills)) {
        echo "<p><strong>Debug:</strong> No skills returned from listCondidatsSkills(). Check database connection or skills table data.</p>";
    } else {
        echo "<p><strong>Debug:</strong> " . count($condidatsSkills) . " skill records retrieved.</p>";
    }
} catch (Exception $e) {
    echo "<p><strong>Error:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
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
    <title>Tables - SB Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
        .btn-export {
            background-color: #28a745;
            color: #ffffff;
            padding: 0.5rem 1rem;
            font-size: 0.95rem;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-export:hover {
            background-color: #218838;
            color: #ffffff;
        }
        .no-data {
            text-align: center;
            color: #6c757d;
            font-style: italic;
            padding: 2rem;
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
        .input-group {
            max-width: 350px;
        }
        @media (max-width: 768px) {
            .table thead {
                font-size: 0.75rem;
            }
            .table td {
                font-size: 0.85rem;
                padding: 0.75rem;
            }
            .btn-action, .btn-export {
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
            #searchInput, #skillsSearchInput {
                max-width: 100%;
            }
            .input-group {
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
                    <h1 class="mt-4 mb-3">Candidates</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">Candidates</li>
                    </ol>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Candidates DataTable
                        </div>
                        <div class="card-body table-container">
                            <!-- Search Input and Export Button for Candidates -->
                            <div class="mb-3 input-group">
                                <input type="text" id="searchInput" class="form-control" placeholder="Search candidates by name, email, or phone..." aria-label="Search candidates" />
                                <button id="exportCandidatesPDF" class="btn btn-export"><i class="fas fa-file-pdf me-1"></i>Export PDF</button>
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
                            <!-- Search Input and Export Button for Skills -->
                            <div class="mb-3 input-group">
                                <input type="text" id="skillsSearchInput" class="form-control" placeholder="Search skills by name or level..." aria-label="Search skills" />
                                <button id="exportSkillsPDF" class="btn btn-export"><i class="fas fa-file-pdf me-1"></i>Export PDF</button>
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
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script>
        // Initialize DataTables
        const candidatesTable = new simpleDatatables.DataTable("#datatablesSimple");
        const skillsTable = new simpleDatatables.DataTable("#datatablesSkills");

        // Dynamic Search for Candidates DataTable
        document.getElementById("searchInput").addEventListener("input", function() {
            candidatesTable.search(this.value);
        });

        // Dynamic Search for Skills DataTable
        document.getElementById("skillsSearchInput").addEventListener("input", function() {
            skillsTable.search(this.value);
        });

        // Export Candidates to PDF
        document.getElementById("exportCandidatesPDF").addEventListener("click", function() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const pageWidth = doc.internal.pageSize.width;
            const margin = 10;
            const tableWidth = pageWidth - 2 * margin;
            const colWidths = [20, 30, 30, 40, 25, 30, 30, 40, 30];

            doc.setFontSize(18);
            doc.text("Candidates Report", margin, 20);
            doc.setFontSize(10);
            doc.text("Generated on: " + new Date().toLocaleDateString(), margin, 30);

            let y = 40;
            const headers = ["ID", "Nom", "Prénom", "Email", "Téléphone", "LinkedIn", "Portfolio", "Lettre de motivation", "Date d'enregistrement"];
            const data = <?php echo json_encode($condidats); ?>.map(row => ({
                values: [
                    row.id,
                    row.nom,
                    row.prenom,
                    row.email,
                    row.telephone,
                    row.linkedin || "-",
                    row.portfolio || "-",
                    row.lettre_motivation || "-",
                    row.date_enregistrement
                ],
                linkedin: row.linkedin,
                portfolio: row.portfolio
            }));

            doc.setFillColor(200, 220, 255);
            doc.rect(margin, y, tableWidth, 10, 'F');
            headers.forEach((header, i) => {
                doc.setFont(undefined, 'bold');
                doc.text(header, margin + colWidths.slice(0, i).reduce((a, b) => a + b, 0), y + 8);
            });
            y += 10;

            data.forEach(row => {
                if (y > 280) {
                    doc.addPage();
                    y = 20;
                    doc.setFillColor(200, 220, 255);
                    doc.rect(margin, y, tableWidth, 10, 'F');
                    headers.forEach((header, i) => {
                        doc.setFont(undefined, 'bold');
                        doc.text(header, margin + colWidths.slice(0, i).reduce((a, b) => a + b, 0), y + 8);
                    });
                    y += 10;
                }
                row.values.forEach((cell, i) => {
                    const xPos = margin + colWidths.slice(0, i).reduce((a, b) => a + b, 0);
                    doc.setFont(undefined, 'normal');
                    if (i === 5 && cell !== "-") { // LinkedIn column
                        doc.setTextColor(0, 0, 255);
                        doc.text("View", xPos, y + 8, { maxWidth: colWidths[i] });
                        doc.link(xPos, y, 20, 10, { url: row.linkedin });
                        doc.setTextColor(0, 0, 0);
                    } else if (i === 6 && cell !== "-") { // Portfolio column
                        doc.setTextColor(0, 0, 255);
                        doc.text("View", xPos, y + 8, { maxWidth: colWidths[i] });
                        doc.link(xPos, y, 20, 10, { url: row.portfolio });
                        doc.setTextColor(0, 0, 0);
                    } else {
                        doc.text(String(cell), xPos, y + 8, { maxWidth: colWidths[i] });
                    }
                });
                y += 10;
            });

            doc.save("candidates_report.pdf");
        });

        // Export Skills to PDF
        document.getElementById("exportSkillsPDF").addEventListener("click", function() {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();
            const pageWidth = doc.internal.pageSize.width;
            const margin = 10;
            const tableWidth = pageWidth - 2 * margin;
            const colWidths = [25, 25, 40, 30];

            doc.setFontSize(18);
            doc.text("Candidate Skills Report", margin, 20);
            doc.setFontSize(10);
            doc.text("Generated on: " + new Date().toLocaleDateString(), margin, 30);

            let y = 40;
            const headers = ["Skill ID", "Candidate ID", "Skill Name", "Skill Level"];
            const data = <?php echo json_encode($condidatsSkills); ?>.map(row => [
                row.skill_id,
                row.condidats_id,
                row.skill_name,
                row.skill_level
            ]);

            doc.setFillColor(200, 220, 255);
            doc.rect(margin, y, tableWidth, 10, 'F');
            headers.forEach((header, i) => {
                doc.setFont(undefined, 'bold');
                doc.text(header, margin + colWidths.slice(0, i).reduce((a, b) => a + b, 0), y + 8);
            });
            y += 10;

            data.forEach(row => {
                if (y > 280) {
                    doc.addPage();
                    y = 20;
                    doc.setFillColor(200, 220, 255);
                    doc.rect(margin, y, tableWidth, 10, 'F');
                    headers.forEach((header, i) => {
                        doc.setFont(undefined, 'bold');
                        doc.text(header, margin + colWidths.slice(0, i).reduce((a, b) => a + b, 0), y + 8);
                    });
                    y += 10;
                }
                row.forEach((cell, i) => {
                    doc.setFont(undefined, 'normal');
                    doc.text(String(cell), margin + colWidths.slice(0, i).reduce((a, b) => a + b, 0), y + 8, { maxWidth: colWidths[i] });
                });
                y += 10;
            });

            doc.save("skills_report.pdf");
        });
    </script>
</body>
</html>