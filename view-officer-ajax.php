<?php
require_once('connections/connect-db.php');

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM officers WHERE officerID = ?");
    $stmt->execute([$id]);
    $off = $stmt->fetch();

    if ($off) {
        echo '<div class="text-center mb-3">';
        if (!empty($off['officer_image']) && file_exists('uploads/' . $off['officer_image'])) {
            echo '<img src="uploads/' . $off['officer_image'] . '" class="rounded-circle border border-info" width="100" height="100">';
        } else {
            echo '<i class="mdi mdi-account-circle text-info" style="font-size: 80px;"></i>';
        }
        echo '</div>';
        echo '<ul class="list-group list-group-flush bg-transparent text-light">';
        echo '<li class="list-group-item bg-transparent text-light"><strong>Service No:</strong> ' . htmlspecialchars($off['officer_service_no']) . '</li>';
        echo '<li class="list-group-item bg-transparent text-light"><strong>Rank:</strong> ' . htmlspecialchars($off['rank']) . '</li>';
        echo '<li class="list-group-item bg-transparent text-light"><strong>Full Name:</strong> ' . htmlspecialchars($off['full_name']) . '</li>';
        echo '<li class="list-group-item bg-transparent text-light"><strong>Gender:</strong> ' . htmlspecialchars($off['gender']) . '</li>';
        echo '<li class="list-group-item bg-transparent text-light"><strong>Dept/Unit:</strong> ' . htmlspecialchars($off['dept_unit']) . '</li>';
        echo '<li class="list-group-item bg-transparent text-light"><strong>Phone:</strong> ' . htmlspecialchars($off['phone']) . '</li>';
        echo '<li class="list-group-item bg-transparent text-light"><strong>Email:</strong> ' . htmlspecialchars($off['email']) . '</li>';
        echo '</ul>';
    } else {
        echo '<p class="text-danger">Officer not found.</p>';
    }
}
?>