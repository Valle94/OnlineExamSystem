<?php
require "requires.php";

if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true || empty($_SESSION['is_admin'])) {
    header("Location: login.php");
    exit();
}

$filters = [
    'studentid' => trim($_GET['studentid'] ?? ''),
    'firstname' => trim($_GET['firstname'] ?? ''),
    'lastname' => trim($_GET['lastname'] ?? ''),
    'email' => trim($_GET['email'] ?? ''),
    'examdate' => trim($_GET['examdate'] ?? ''),
    'minscore' => trim($_GET['minscore'] ?? ''),
    'maxscore' => trim($_GET['maxscore'] ?? '')
];

$sql = "SELECT 
            a.StudentID,
            a.FirstName,
            a.LastName,
            a.Email,
            e.Date,
            e.Time,
            e.Score,
            e.CorrectAnswers,
            e.WrongAnswers
        FROM account a
        LEFT JOIN examresults e ON a.StudentID = e.StudentID
        WHERE 1=1";

$params = [];

if ($filters['studentid'] !== '') {
    $sql .= " AND a.StudentID = :studentid";
    $params[':studentid'] = $filters['studentid'];
}

if ($filters['firstname'] !== '') {
    $sql .= " AND a.FirstName LIKE :firstname";
    $params[':firstname'] = '%' . $filters['firstname'] . '%';
}

if ($filters['lastname'] !== '') {
    $sql .= " AND a.LastName LIKE :lastname";
    $params[':lastname'] = '%' . $filters['lastname'] . '%';
}

if ($filters['email'] !== '') {
    $sql .= " AND a.Email LIKE :email";
    $params[':email'] = '%' . $filters['email'] . '%';
}

if ($filters['examdate'] !== '') {
    $sql .= " AND e.Date = :examdate";
    $params[':examdate'] = $filters['examdate'];
}

if ($filters['minscore'] !== '') {
    $sql .= " AND e.Score >= :minscore";
    $params[':minscore'] = $filters['minscore'];
}

if ($filters['maxscore'] !== '') {
    $sql .= " AND e.Score <= :maxscore";
    $params[':maxscore'] = $filters['maxscore'];
}

$sql .= " ORDER BY e.Date DESC, e.Time DESC, a.LastName ASC, a.FirstName ASC";

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$records = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php require "header.php"; ?>

    <h2>Admin Search Page</h2>
    <p>You are logged in as the admin user. Search all student exam results below.</p>

    <form method="GET" action="adminSearch.php">
        <p>Student ID:
            <input type="number" name="studentid" value="<?php echo htmlspecialchars($filters['studentid']); ?>">
        </p>

        <p>First Name:
            <input type="text" name="firstname" value="<?php echo htmlspecialchars($filters['firstname']); ?>">
        </p>

        <p>Last Name:
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($filters['lastname']); ?>">
        </p>

        <p>Email:
            <input type="text" name="email" value="<?php echo htmlspecialchars($filters['email']); ?>">
        </p>

        <p>Exam Date:
            <input type="date" name="examdate" value="<?php echo htmlspecialchars($filters['examdate']); ?>">
        </p>

        <p>Minimum Score:
            <input type="number" step="0.01" name="minscore" value="<?php echo htmlspecialchars($filters['minscore']); ?>">
        </p>

        <p>Maximum Score:
            <input type="number" step="0.01" name="maxscore" value="<?php echo htmlspecialchars($filters['maxscore']); ?>">
        </p>

        <p><input type="submit" value="Search Results"></p>
    </form>

    <h2>Search Results</h2>

    <?php if (count($records) > 0) { ?>
        <table>
            <thead>
                <tr>
                    <th>Student ID</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Score</th>
                    <th>Correct</th>
                    <th>Wrong</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($records as $row) { ?>
                    <tr>
                        <td><?php echo $row['StudentID']; ?></td>
                        <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
                        <td><?php echo htmlspecialchars($row['LastName']); ?></td>
                        <td><?php echo htmlspecialchars($row['Email']); ?></td>
                        <td><?php echo $row['Date'] ?? ''; ?></td>
                        <td><?php echo $row['Time'] ?? ''; ?></td>
                        <td><?php echo $row['Score'] ?? ''; ?></td>
                        <td><?php echo $row['CorrectAnswers'] ?? ''; ?></td>
                        <td><?php echo $row['WrongAnswers'] ?? ''; ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>No matching records found.</p>
    <?php } ?>
</body>
</html>