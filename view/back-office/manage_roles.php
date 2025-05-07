<?php
// Start output buffering
ob_start();
?>
<div class="container-fluid px-4">
    <h1 class="mt-4">Manage User Roles</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="index.php?page=admin_dashboard">Dashboard</a></li>
        <li class="breadcrumb-item active">Manage Roles</li>
    </ol>
    
    <?php if (isset($error_message) && !empty($error_message)): ?>
        <div class="alert alert-danger" role="alert">
            <i class="fas fa-exclamation-triangle me-2"></i><?php echo $error_message; ?>
        </div>
    <?php endif; ?>
    
    <?php if (isset($success_message) && !empty($success_message)): ?>
        <div class="alert alert-success" role="alert">
            <i class="fas fa-check-circle me-2"></i><?php echo $success_message; ?>
        </div>
    <?php endif; ?>
    
    <div class="card mb-4">
        <div class="card-header">
            <i class="fas fa-users-cog me-1"></i>
            User Roles
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Current Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (isset($users) && is_array($users)): ?>
                        <?php foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($user['user_id']); ?></td>
                                <td><?php echo htmlspecialchars($user['username']); ?></td>
                                <td><?php echo htmlspecialchars($user['email']); ?></td>
                                <td>
                                    <span class="badge bg-<?php echo $user['role'] === 'admin' ? 'danger' : 'primary'; ?>">
                                        <?php echo ucfirst(htmlspecialchars($user['role'])); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($user['user_id'] != $_SESSION['user_id']): ?>
                                        <form action="index.php?page=manage_roles" method="POST" class="d-inline">
                                            <input type="hidden" name="user_id" value="<?php echo $user['user_id']; ?>">
                                            <input type="hidden" name="role" value="<?php echo $user['role'] === 'admin' ? 'user' : 'admin'; ?>">
                                            <button type="submit" class="btn btn-sm btn-<?php echo $user['role'] === 'admin' ? 'warning' : 'success'; ?>">
                                                <?php echo $user['role'] === 'admin' ? 'Demote to User' : 'Promote to Admin'; ?>
                                            </button>
                                        </form>
                                    <?php else: ?>
                                        <span class="text-muted">Current User</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">No users found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <a href="index.php?page=admin_dashboard" class="btn btn-primary">Back to Dashboard</a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add confirmation to role change buttons
    const roleForms = document.querySelectorAll('form[action="index.php?page=manage_roles"]');
    roleForms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const roleInput = this.querySelector('input[name="role"]');
            const userId = this.querySelector('input[name="user_id"]').value;
            const newRole = roleInput.value;
            
            const message = newRole === 'admin' 
                ? `Are you sure you want to promote user #${userId} to Admin?` 
                : `Are you sure you want to demote user #${userId} to regular User?`;
                
            if (!confirm(message)) {
                e.preventDefault();
            }
        });
    });
});
</script>

<?php
// Store the content in a variable
$content = ob_get_clean();

// Include the layout file which will use the $content variable
include __DIR__ . '/layout.php';
?>
