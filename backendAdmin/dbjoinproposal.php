<?php
require_once("models/joinproposal.php");
$proposal = new Proposal();

$limit = 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $limit;

if (isset($_GET['searchProposal'])) {
    $searchProposal = $_GET['searchProposal'];
    $result = $proposal->getProposal($searchProposal, $limit, $offset);
    $total_records = $proposal->getTotalProposal($searchProposal);
} else {
    $result = $proposal->getProposal("", $limit, $offset);
    $total_records = $proposal->getTotalProposal();
}
$total_pages = ceil($total_records / $limit);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Proposal</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="stylesheet" href="css/paging.css">
    <link rel="icon" href="icon/logo.png" type="image/png">
    <script src="jquery-3.5.1.min.js"></script>
</head>

<body>

    <h1>Proposal Management</h1>
    <form action="" method="get">
        <input type="text" name="searchProposal" placeholder="input proposal name">
        <input type="submit" value="search" class="btn-add"> <br><br>
    </form>
    <?php
    echo "<table><tr>
            <th>Nama Member</th>
            <th>Mengajukan Diri di Team</th>
            <th>Divisi Game yang Dipilih</th>
            <th>Deskripsi</th>
            <th>Aksi</th>";
    while ($row = $result->fetch_assoc()) {
        $idproposal = $row['idjoin_proposal'];
        echo "<tr>";

        $idmember = $row['idmember'];
        echo "<td>" . $row['membername'] . "</td>";
        echo "<td>" . $row['teamname'] . "</td>";
        echo "<td>" . $row['gamename'] . "</td>";
        echo "<td>" . $row['description'] . "</td>";
        echo "<td><a href='joinproposal/process.php?action=approved&idproposal=" . $row['idjoin_proposal'] . "&idmember=" . $row['idmember'] . "&idteam=" . $row['idteam'] . "&desc=" . urlencode($row['description']) . "'>Approved</a> | 
        <a href='joinproposal/process.php?action=rejected&idproposal=" . $row['idjoin_proposal'] . "&idmember=" . $row['idmember'] . "&idteam=" . $row['idteam'] . "'>Rejected</a></td>";

    }
    echo "</table>"
    ?>
    <div class="pagination">
        <?php
        if ($page > 1) {
            $prev_page = $page - 1;
            $search_param = isset($_GET['searchProposal']) ? $_GET['searchProposal'] : '';
            echo "<a href='?page=$prev_page&searchProposal=$search_param'>Previous</a>";
        }

        for ($i = 1; $i <= $total_pages; $i++) {
            $search_param = isset($_GET['searchProposal']) ? $_GET['searchProposal'] : '';
            $active_class = $i == $page ? 'active' : '';
            echo "<a href='?page=$i&searchProposal=$search_param' class='$active_class'>$i</a>";
        }

        if ($page < $total_pages) {
            $next_page = $page + 1;
            $search_param = isset($_GET['searchProposal']) ? $_GET['searchProposal'] : '';
            echo "<a href='?page=$next_page&searchProposal=$search_param'>Next</a>";
        }
        ?>
    </div>
    <div class="menu">
        <div class="menu-item">
            <a href="../DashboardAdmin.php">Back to Dashboard</a>
        </div>
    </div>
</body>

</html>