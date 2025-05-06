<?php
require_once '../../Controller/CondidatsC.php';
require_once '../../Controller/CondidatsSkillsC.php';
require_once '../../Model/Condidats.php';
require_once '../../Model/CondidatsSkills.php';

$error = "";
$condidat = null;
$success = false;

$condidatsC = new CondidatsC();
$condidatsSkillsC = new CondidatsSkillsC();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        if (
            isset($_POST["nom"], $_POST["prenom"], $_POST["email"], $_POST["telephone"])
            && !empty(trim($_POST["nom"])) && !empty(trim($_POST["prenom"]))
            && !empty(trim($_POST["email"])) && !empty(trim($_POST["telephone"]))
        ) {
            // Handle CV upload
            $cv_path = null;
            if (isset($_FILES['cv']) && $_FILES['cv']['error'] === UPLOAD_ERR_OK) {
                $uploadDir = __DIR__ . '/../../uploads/cv/';
                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $allowedTypes = ['application/pdf'];
                if (!in_array($_FILES['cv']['type'], $allowedTypes)) {
                    throw new Exception('Only PDF files are allowed for CV upload.');
                }

                $fileInfo = pathinfo($_FILES['cv']['name']);
                $cvFileName = uniqid() . '.' . $fileInfo['extension'];
                $cv_path = $uploadDir . $cvFileName;

                if (!move_uploaded_file($_FILES['cv']['tmp_name'], $cv_path)) {
                    throw new Exception('Failed to upload CV file.');
                }
            }

            // Create and save candidate
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

            // Save candidate and get the ID
            $condidat_id = $condidatsC->addCondidats($condidat);

            // Handle skills
            if (isset($_POST['competences']) && is_array($_POST['competences'])) {
                foreach ($_POST['competences'] as $skill) {
                    if (!empty($skill['nom']) && !empty($skill['niveau'])) {
                        $skillObj = new Condidats_Skills(
                            null, // id will be auto-generated
                            $condidat_id,
                            $skill['nom'],
                            $skill['niveau']
                        );
                        try {
                            $condidatsSkillsC->addCondidatsSkills($skillObj);
                        } catch (Exception $e) {
                            error_log("Error adding skill: " . $e->getMessage());
                        }
                    }
                }
            }

            $success = true;
            
            // Return JSON response for AJAX requests
            if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                header('Content-Type: application/json');
                echo json_encode([
                    'success' => true,
                    'message' => 'Your application has been submitted successfully!'
                ]);
                exit;
            }

        } else {
            throw new Exception("Please fill in all required fields.");
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            header('Content-Type: application/json');
            echo json_encode(['success' => false, 'message' => $error]);
            exit;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Candidate</title>
    <link href="/innovest/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Add Candidate</h2>

        <?php if ($error): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <?php if ($success): ?>
            <div class="alert alert-success">Candidate added successfully!</div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" id="candidateForm">
            <!-- Basic Information -->
            <div class="card mb-4">
                <div class="card-header">Basic Information</div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Last Name</label>
                            <input type="text" name="nom" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">First Name</label>
                            <input type="text" name="prenom" class="form-control" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Phone</label>
                            <input type="tel" name="telephone" class="form-control" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Professional Information -->
            <div class="card mb-4">
                <div class="card-header">Professional Information</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label class="form-label">LinkedIn Profile</label>
                        <input type="url" name="linkedin" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Portfolio URL</label>
                        <input type="url" name="portfolio" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">CV (PDF only)</label>
                        <input type="file" name="cv" class="form-control" accept="application/pdf">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cover Letter</label>
                        <textarea name="lettre_motivation" class="form-control" rows="4"></textarea>
                    </div>
                </div>
            </div>

            <!-- Skills Section -->
            <div class="card mb-4">
                <div class="card-header">Skills</div>
                <div class="card-body">
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
                                            <option value="débutant">Beginner</option>
                                            <option value="intermédiaire">Intermediate</option>
                                            <option value="avancé">Advanced</option>
                                            <option value="expert">Expert</option>
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
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>
    </div>

    <script src="/innovest/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const skillsContainer = document.querySelector('.skills-container');
            const addSkillBtn = document.getElementById('add-skill');
            let skillCount = 1;

            // Add new skill field
            addSkillBtn.addEventListener('click', function() {
                const skillEntry = document.createElement('div');
                skillEntry.className = 'skill-entry mb-3';
                skillEntry.innerHTML = `
                    <div class="row g-3">
                        <div class="col-md-6">
                            <input type="text" class="form-control" name="competences[${skillCount}][nom]" placeholder="Skill Name" required>
                        </div>
                        <div class="col-md-4">
                            <select class="form-select" name="competences[${skillCount}][niveau]" required>
                                <option value="">Select Level</option>
                                <option value="débutant">Beginner</option>
                                <option value="intermédiaire">Intermediate</option>
                                <option value="avancé">Advanced</option>
                                <option value="expert">Expert</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button type="button" class="btn btn-danger remove-skill w-100">Remove</button>
                        </div>
                    </div>
                `;
                skillsContainer.appendChild(skillEntry);
                skillCount++;
            });

            // Remove skill field
            skillsContainer.addEventListener('click', function(e) {
                if (e.target.classList.contains('remove-skill')) {
                    e.target.closest('.skill-entry').remove();
                }
            });

            // Form validation
            document.querySelector('form').addEventListener('submit', function(e) {
                const skillInputs = document.querySelectorAll('input[name^="competences"][name$="[nom]"]');
                const skillLevels = document.querySelectorAll('select[name^="competences"][name$="[niveau]"]');
                
                let hasEmptySkills = false;
                skillInputs.forEach((input, index) => {
                    if (!input.value || !skillLevels[index].value) {
                        hasEmptySkills = true;
                    }
                });
                
                if (hasEmptySkills) {
                    e.preventDefault();
                    alert('Please fill in all skill fields or remove empty ones.');
                }
            });
        });
    </script>
</body>
</html>









