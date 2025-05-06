<?php
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/php/logs/php_error_log');

session_start();
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];

define('BASE_URL', '/innovest/View/FrontOffice/');

require_once __DIR__ . '/../../controller/CondidatsC.php';
require_once __DIR__ . '/../../controller/CondidatsSkillsC.php';
require_once __DIR__ . '/../../model/Condidats.php';
require_once __DIR__ . '/../../model/CondidatsSkills.php';

$error = "";
$condidat = null;
$success = false;

try {
    $condidatsC = new CondidatsC();
    $condidatsSkillsC = new CondidatsSkillsC();
} catch (Exception $e) {
    error_log("Initialization error: " . $e->getMessage());
    $error = "Server initialization error";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $request_id = uniqid('req_');
    error_log("[$request_id] Received POST request: " . print_r($_POST, true));

    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        $error = "Invalid CSRF token";
        error_log("[$request_id] CSRF validation failed");
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            http_response_code(403);
            echo json_encode(['success' => false, 'message' => $error]);
            exit;
        }
    }
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Regenerate token

    if (
        isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"])
        && !empty(trim($_POST["nom"])) && !empty(trim($_POST["prenom"]))
        && !empty(trim($_POST["email"])) && !empty(trim($_POST["telephone"]))
    ) {
        $cv_path = null;
        if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = __DIR__ . '/../../Uploads/cv/';
            if (!file_exists($uploadDir)) {
                if (!mkdir($uploadDir, 0777, true)) {
                    $error = 'Failed to create upload directory.';
                    error_log("[$request_id] Upload Error: Failed to create directory " . $uploadDir);
                }
            }

            $allowedTypes = ['application/pdf'];
            if (!in_array($_FILES['cv']['type'], $allowedTypes)) {
                $error = 'Only PDF files are allowed for CV upload.';
                error_log("[$request_id] Upload Error: Invalid file type " . $_FILES['cv']['type']);
            } else {
                $fileInfo = pathinfo($_FILES['cv']['name']);
                $cvFileName = uniqid() . '.' . $fileInfo['extension'];
                $cv_path = $uploadDir . $cvFileName;

                if (!move_uploaded_file($_FILES['cv']['tmp_name'], $cv_path)) {
                    $error = 'Failed to upload CV file.';
                    error_log("[$request_id] Upload Error: Failed to move file to " . $cv_path);
                } else {
                    $cv_path = '/Uploads/cv/' . $cvFileName;
                    error_log("[$request_id] CV uploaded successfully: " . $cv_path);
                }
            }
        } elseif (isset($_FILES['cv']) && $_FILES['cv']['error'] !== UPLOAD_ERR_NO_FILE) {
            $error = 'CV upload error: ' . $_FILES['cv']['error'];
            error_log("[$request_id] Upload Error Code: " . $_FILES['cv']['error']);
        }

        if (empty($error)) {
            try {
                $condidat = new Condidats(
                    null,
                    trim($_POST["nom"]),
                    trim($_POST["prenom"]),
                    trim($_POST["email"]),
                    trim($_POST["telephone"]),
                    isset($_POST["linkedin"]) ? trim($_POST["linkedin"]) : null,
                    isset($_POST["portfolio"]) ? trim($_POST["portfolio"]) : null,
                    isset($_POST["lettre_motivation"]) ? trim($_POST["lettre_motivation"]) : null,
                    $cv_path,
                    new DateTime()
                );

                $condidat_id = $condidatsC->addCondidats($condidat);
                error_log("[$request_id] Candidate inserted with ID: $condidat_id");

                if (isset($_POST['competences']) && is_array($_POST['competences'])) {
                    error_log("[$request_id] Processing competences: " . print_r($_POST['competences'], true));
                    foreach ($_POST['competences'] as $index => $skillData) {
                        if (!empty($skillData['nom']) && !empty($skillData['niveau'])) {
                            error_log("[$request_id] Adding skill $index: " . print_r($skillData, true));
                            $skill = new CondidatsSkills(
                                null,
                                $condidat_id,
                                trim($skillData['nom']),
                                $skillData['niveau']
                            );
                            try {
                                $skill_id = $condidatsSkillsC->addCondidatsSkills($skill);
                                error_log("[$request_id] Skill $index added with ID: $skill_id");
                            } catch (Exception $e) {
                                error_log("[$request_id] Failed to add skill $index: " . $e->getMessage());
                                $error .= "Failed to add skill '$skillData[nom]': " . $e->getMessage() . "; ";
                            }
                        } else {
                            error_log("[$request_id] Skipping skill $index: Empty name or level");
                        }
                    }
                } else {
                    error_log("[$request_id] No competences provided in POST data");
                }

                $success = true;

                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'message' => 'Your application has been submitted. Thank you!',
                        'data' => ['condidat_id' => $condidat_id]
                    ]);
                    exit;
                }
            } catch (Exception $e) {
                error_log("[$request_id] Error in condidats.php: " . $e->getMessage() . "\nStack Trace: " . $e->getTraceAsString());
                $error = "Error: " . $e->getMessage();
                if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    header('Content-Type: application/json');
                    http_response_code(500);
                    echo json_encode(['success' => false, 'message' => $error]);
                    exit;
                }
            }
        } else {
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                http_response_code(400);
                echo json_encode(['success' => false, 'message' => $error]);
                exit;
            }
        }
    } else {
        $error = "Please fill in all required fields.";
        error_log("[$request_id] Form Validation Error: Missing required fields - " . print_r($_POST, true));
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            http_response_code(400);
            echo json_encode(['success' => false, 'message' => $error]);
            exit;
        }
    }

    if (isset($_GET['debug']) && $_GET['debug'] == 1) {
        echo '<pre>';
        echo 'Success: ' . ($success ? 'true' : 'false') . "\n";
        echo 'Error: ' . htmlspecialchars($error) . "\n";
        echo 'POST Data: ' . print_r($_POST, true) . "\n";
        echo 'FILES Data: ' . print_r($_FILES, true) . "\n";
        echo '</pre>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Condidats - Innovest Bootstrap Template</title>
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- Favicons -->
    <link href="/innovest/assets/img/favicon.png" rel="icon">
    <link href="/innovest/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com" rel="preconnect">
    <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Nunito:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="/innovest/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/innovest/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="/innovest/assets/vendor/aos/aos.css" rel="stylesheet">
    <link href="/innovest/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="/innovest/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

    <!-- Main CSS File -->
    <link href="/innovest/assets/css/main.css" rel="stylesheet">
</head>

<body class="condidats-page">
    <header id="header" class="header d-flex align-items-center sticky-top">
        <div class="container-fluid container-xl position-relative d-flex align-items-center">
            <a href="/innovest/index.html" class="logo d-flex align-items-center me-auto">
                <img src="/innovest/assets/img/logo.png" alt="">
                <h1 class="sitename">Innovest</h1>
            </a>
            <nav id="navmenu" class="navmenu">
                <ul>
                    <li><a href="/innovest/#hero">Home<br></a></li>
                    <li><a href="/innovest/#about">About</a></li>
                    <li><a href="/innovest/#services">Services</a></li>
                    <li><a href="/innovest/#portfolio">Portfolio</a></li>
                    <li><a href="/innovest/#team">Team</a></li>
                    <li><a href="<?php echo BASE_URL; ?>condidats.php" class="active">Condidats</a></li>
                    <li class="dropdown"><a href="#"><span>Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li><a href="#">Dropdown 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                                <ul>
                                    <li><a href="#">Deep Dropdown 1</a></li>
                                    <li><a href="#">Deep Dropdown 2</a></li>
                                    <li><a href="#">Deep Dropdown 3</a></li>
                                    <li><a href="#">Deep Dropdown 4</a></li>
                                    <li><a href="#">Deep Dropdown 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Dropdown 2</a></li>
                            <li><a href="#">Dropdown 3</a></li>
                            <li><a href="#">Dropdown 4</a></li>
                        </ul>
                    </li>
                    <li class="listing-dropdown"><a href="#"><span>Listing Dropdown</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                        <ul>
                            <li>
                                <a href="#">Column 1 link 1</a>
                                <a href="#">Column 1 link 2</a>
                                <a href="#">Column 1 link 3</a>
                            </li>
                            <li>
                                <a href="#">Column 2 link 1</a>
                                <a href="#">Column 2 link 2</a>
                                <a href="#">Column 3 link 3</a>
                            </li>
                            <li>
                                <a href="#">Column 3 link 1</a>
                                <a href="#">Column 3 link 2</a>
                                <a href="#">Column 3 link 3</a>
                            </li>
                            <li>
                                <a href="#">Column 4 link 1</a>
                                <a href="#">Column 4 link 2</a>
                                <a href="#">Column 4 link 3</a>
                            </li>
                            <li>
                                <a href="#">Column 5 link 1</a>
                                <a href="#">Column 5 link 2</a>
                                <a href="#">Column 5 link 3</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="/innovest/#contact">Contact</a></li>
                </ul>
                <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
            </nav>
            <a class="btn-getstarted flex-md-shrink-0" href="/innovest/index.html#about">Get Started</a>
        </div>
    </header>

    <main class="main">
        <div class="page-title">
            <div class="heading">
                <div class="container">
                    <div class="row d-flex justify-content-center text-center">
                        <div class="col-lg-8">
                            <h1>Condidats</h1>
                            <p class="mb-0">Join our talent pool by submitting your application and showcasing your skills.</p>
                        </div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumbs">
                <div class="container">
                    <ol>
                        <li><a href="/innovest/index.html">Home</a></li>
                        <li class="current">Condidats</li>
                    </ol>
                </div>
            </nav>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <section id="condidats-posts" class="condidats-posts section">
                        <div class="container">
                            <div class="row gy-4">
                                <div class="col-12">
                                    <article>
                                        <!-- Condidates Form Section -->
                                        <section id="condidates-form" class="condidates-form section">
                                            <div class="container section-title" data-aos="fade-up">
                                                <h2>Candidate Application</h2>
                                                <p>Submit your information to join our talent pool</p>
                                            </div>
                                            <div class="container" data-aos="fade-up" data-aos-delay="100">
                                                <?php if (!empty($error)): ?>
                                                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                                                <?php endif; ?>
                                                <form action="<?php echo BASE_URL; ?>condidats.php" method="post" enctype="multipart/form-data" class="php-email-form">
                                                    <input type="hidden" name="csrf_token" value="<?php echo htmlspecialchars($csrf_token); ?>">
                                                    <div class="row gy-4">
                                                        <div class="col-md-6">
                                                            <input type="text" name="nom" class="form-control" placeholder="Last Name (Nom)" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" name="prenom" class="form-control" placeholder="First Name (Prénom)" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="email" name="email" class="form-control" placeholder="Email" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="tel" name="telephone" class="form-control" placeholder="Phone Number" required>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="url" name="linkedin" class="form-control" placeholder="LinkedIn Profile URL">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="url" name="portfolio" class="form-control" placeholder="Portfolio URL">
                                                        </div>
                                                        <div class="col-12">
                                                            <textarea class="form-control" name="lettre_motivation" rows="5" placeholder="Cover Letter (Lettre de Motivation)"></textarea>
                                                        </div>
                                                        <div class="col-12">
                                                            <input type="file" name="cv" class="form-control" accept="application/pdf" placeholder="Upload CV (PDF)">
                                                        </div>
                                                        <!-- Skills Section -->
                                                        <div class="col-12">
                                                            <h5>Skills</h5>
                                                            <div class="skills-container">
                                                                <div class="skill-entry mb-3">
                                                                    <div class="row g-3">
                                                                        <div class="col-md-6">
                                                                            <input type="text" class="form-control" name="competences[0][nom]" placeholder="Skill Name" required>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <select class="form-select" name="competences[0][niveau]" required>
                                                                                <option value="">Select Level</option>
                                                                                <option value="Beginner">Beginner</option>
                                                                                <option value="Intermediate">Intermediate</option>
                                                                                <option value="Advanced">Advanced</option>
                                                                                <option value="Expert">Expert</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <button type="button" class="btn btn-danger remove-skill w-100">Remove</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <button type="button" class="btn btn-secondary mt-2" id="add-skill">Add Another Skill</button>
                                                        </div>
                                                        <div class="col-12 text-center">
                                                            <div class="sent-message" style="display: none;">Your application has been submitted. Thank you!</div>
                                                            <button type="submit">Submit Application <span class="transition"></span><span class="gradient"></span><span class="transition"></span></button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </section>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section id="condidats-pagination" class="condidats-pagination section">
                        <div class="container">
                            <div class="d-flex justify-content-center">
                                <ul>
                                    <li><a href="#"><i class="bi bi-chevron-left"></i></a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#" class="active">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li>...</li>
                                    <li><a href="#">10</a></li>
                                    <li><a href="#"><i class="bi bi-chevron-right"></i></a></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>
                <div class="col-lg-4 sidebar">
                    <div class="col-12 text-center">
                        <div class="sent-message" style="display: none;">Your application has been submitted. Thank you!</div>
                    </div>
                    <div class="widgets-container">
                        <div class="search-widget widget-item">
                            <h3 class="widget-title">Search</h3>
                            <form action="">
                                <input type="text">
                                <button type="submit" title="Search"><i class="bi bi-search"></i></button>
                            </form>
                        </div>
                        <div class="categories-widget widget-item">
                            <h3 class="widget-title">Categories</h3>
                            <ul class="mt-3">
                                <li><a href="#">General <span>(25)</span></a></li>
                                <li><a href="#">Lifestyle <span>(12)</span></a></li>
                                <li><a href="#">Travel <span>(5)</span></a></li>
                                <li><a href="#">Design <span>(22)</span></a></li>
                                <li><a href="#">Creative <span>(8)</span></a></li>
                                <li><a href="#">Educaion <span>(14)</span></a></li>
                            </ul>
                        </div>
                        <div class="recent-posts-widget widget-item">
                            <h3 class="widget-title">Recent Posts</h3>
                            <div class="post-item">
                                <img src="/innovest/assets/img/condidats/condidats-recent-1.jpg" alt="" class="flex-shrink-0">
                                <div>
                                    <h4><a href="condidats-details.html">Nihil blanditiis at in nihil autem</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div>
                            <div class="post-item">
                                <img src="/innovest/assets/img/condidats/condidats-recent-2.jpg" alt="" class="flex-shrink-0">
                                <div>
                                    <h4><a href="condidats-details.html">Quidem autem et impedit</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div>
                            <div class="post-item">
                                <img src="/innovest/assets/img/condidats/condidats-recent-3.jpg" alt="" class="flex-shrink-0">
                                <div>
                                    <h4><a href="condidats-details.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div>
                            <div class="post-item">
                                <img src="/innovest/assets/img/condidats/condidats-recent-4.jpg" alt="" class="flex-shrink-0">
                                <div>
                                    <h4><a href="condidats-details.html">Laborum corporis quo dara net para</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div>
                            <div class="post-item">
                                <img src="/innovest/assets/img/condidats/condidats-recent-5.jpg" alt="" class="flex-shrink-0">
                                <div>
                                    <h4><a href="condidats-details.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                    <time datetime="2020-01-01">Jan 1, 2020</time>
                                </div>
                            </div>
                        </div>
                        <div class="tags-widget widget-item">
                            <h3 class="widget-title">Tags</h3>
                            <ul>
                                <li><a href="#">App</a></li>
                                <li><a href="#">IT</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Mac</a></li>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Office</a></li>
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Studio</a></li>
                                <li><a href="#">Smart</a></li>
                                <li><a href="#">Tips</a></li>
                                <li><a href="#">Marketing</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer id="footer" class="footer">
        <div class="footer-newsletter">
            <div class="container">
                <div class="row justify-content-center text-center">
                    <div class="col-lg-6">
                        <h4>Join Our Newsletter</h4>
                        <p>Subscribe to our newsletter and receive the latest news about our products and services!</p>
                        <form action="/innovest/forms/newsletter.php" method="post" class="php-email-form">
                            <div class="newsletter-form"><input type="email" name="email"><input type="submit" value="Subscribe"></div>
                            <div class="sent-message">Your subscription request has been sent. Thank you!</div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="container footer-top">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="/innovest/index.html" class="d-flex align-items-center">
                        <span class="sitename">Innovest</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>A108 Adam Street</p>
                        <p>New York, NY 535022</p>
                        <p class="mt-3"><strong>Phone:</strong> <span>+1 5589 55488 55</span></p>
                        <p><strong>Email:</strong> <span>info@example.com</span></p>
                    </div>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Useful Links</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="/innovest/">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/innovest/#about">About us</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="/innovest/#services">Services</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
                    </ul>
                </div>
                <div class="col-lg-2 col-md-3 footer-links">
                    <h4>Our Services</h4>
                    <ul>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Design</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Web Development</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Product Management</a></li>
                        <li><i class="bi bi-chevron-right"></i> <a href="#">Marketing</a></li>
                    </ul>
                </div>
                <div class="col-lg-4 col-md-12">
                    <h4>Follow Us</h4>
                    <p>Cras fermentum odio eu feugiat lide par naso tierra videa magna derita valies</p>
                    <div class="social-links d-flex">
                        <a href=""><i class="bi bi-twitter-x"></i></a>
                        <a href=""><i class="bi bi-facebook"></i></a>
                        <a href=""><i class="bi bi-instagram"></i></a>
                        <a href=""><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container copyright text-center mt-4">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">Innovest</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> Distributed by <a href="https://themewagon.com">ThemeWagon</a>
            </div>
        </div>
    </footer>

    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <script src="/innovest/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/innovest/assets/vendor/php-email-form/validate.js"></script>
    <script src="/innovest/assets/vendor/aos/aos.js"></script>
    <script src="/innovest/assets/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="/innovest/assets/vendor/purecounter/purecounter_vanilla.js"></script>
    <script src="/innovest/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="/innovest/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="/innovest/assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="/innovest/assets/js/main.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skillsContainer = document.querySelector('.skills-container');
            const addSkillBtn = document.getElementById('add-skill');
            const form = document.querySelector('.php-email-form');
            let skillCount = 1;

            addSkillBtn.addEventListener('click', function() {
                const newSkill = document.createElement('div');
                newSkill.className = 'skill-entry mb-3';
                newSkill.innerHTML = `
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="competences[${skillCount}][nom]" placeholder="Skill Name" required>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" name="competences[${skillCount}][niveau]" required>
                                <option value="">Select Level</option>
                                <option value="Beginner">Beginner</option>
                                <option value="Intermediate">Intermediate</option>
                                <option value="Advanced">Advanced</option>
                                <option value="Expert">Expert</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-skill w-100">Remove</button>
                        </div>
                    </div>
                `;
                skillsContainer.appendChild(newSkill);
                skillCount++;
            });

            skillsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-skill')) {
                    e.target.closest('.skill-entry').remove();
                }
            });

            function formSubmitHandler(e) {
                e.preventDefault();
                const submitButton = form.querySelector('button[type="submit"]');
                submitButton.disabled = true; // Disable button to prevent multiple submissions

                const skillInputs = document.querySelectorAll('.skill-entry input[name$="[nom]"]');
                const skillSelects = document.querySelectorAll('.skill-entry select[name$="[niveau]"]');
                let hasValidSkills = true;
                skillInputs.forEach((input, index) => {
                    const select = skillSelects[index];
                    if (input.value.trim() === '' || !select.value) {
                        hasValidSkills = false;
                        input.classList.add('is-invalid');
                        select.classList.add('is-invalid');
                    } else {
                        input.classList.remove('is-invalid');
                        select.classList.remove('is-invalid');
                    }
                });
                if (!hasValidSkills) {
                    const errorMessage = document.querySelector('.error-message');
                    errorMessage.textContent = 'Please fill in all skill names and levels';
                    errorMessage.style.display = 'block';
                    submitButton.disabled = false;
                    return;
                }

                const formData = new FormData(form);
                console.log('FormData:', Array.from(formData.entries()));
                const sentMessage = document.querySelector('.sent-message');
                const errorMessage = document.querySelector('.error-message');
                const loading = document.querySelector('.loading');

                // Reset form
                form.reset();
                const skillEntries = document.querySelectorAll('.skill-entry');
                skillEntries.forEach((entry, index) => {
                    if (index > 0) entry.remove();
                });
                skillCount = 1;

                loading.style.display = 'block';
                sentMessage.style.display = 'none';
                errorMessage.style.display = 'none';

                fetch('<?php echo BASE_URL; ?>condidats.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    console.log('Response Status:', response.status);
                    if (!response.ok) {
                        return response.text().then(text => {
                            throw new Error('Network response was not ok: ' + response.status + ' ' + text);
                        });
                    }
                    return response.json().catch(error => {
                        throw new Error('Invalid JSON response: ' + error.message);
                    });
                })
                .then(data => {
                    console.log('Response Data:', data);
                    loading.style.display = 'none';
                    if (data.success) {
                        sentMessage.style.display = 'block';
                    } else {
                        errorMessage.textContent = data.message || 'Unknown server error';
                        errorMessage.style.display = 'block';
                    }
                })
                .catch(error => {
                    console.log('Fetch Error:', error);
                    loading.style.display = 'none';
                    errorMessage.textContent = 'An error occurred while submitting the form: ' + error.message;
                    errorMessage.style.display = 'block';
                })
                .finally(() => {
                    submitButton.disabled = false; // Re-enable button
                });
            }

            // Remove any existing listeners and add the submit handler
            form.removeEventListener('submit', formSubmitHandler);
            form.addEventListener('submit', formSubmitHandler);
        });
    </script>
</body>
</html>