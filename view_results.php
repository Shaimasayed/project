<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header('Location: login.php'); 
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_question'])) {
    $question_text = $_POST['question_text'];
    $option_a = $_POST['option_a'];
    $option_b = $_POST['option_b'];
    $option_c = $_POST['option_c'];
    $option_d = $_POST['option_d'];
    $correct_option = $_POST['correct_option'];

    $sql = "INSERT INTO questions (question_text, option_a, option_b, option_c, option_d, correct_option) 
            VALUES ('$question_text', '$option_a', '$option_b', '$option_c', '$option_d', '$correct_option')";
    mysqli_query($conn, $sql);
}

$sql = "SELECT * FROM questions";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Manage Questions</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Manage Questions</h1>
        <form method="POST">
            <textarea name="question_text" placeholder="Question" required></textarea>
            <input type="text" name="option_a" placeholder="Option A" required>
            <input type="text" name="option_b" placeholder="Option B" required>
            <input type="text" name="option_c" placeholder="Option C" required>
            <input type="text" name="option_d" placeholder="Option D" required>
            <input type="text" name="correct_option" placeholder="Correct Option (A/B/C/D)" required>
            <button type="submit" name="add_question">Add Question</button>
        </form>

        <table>
            <tr>
                <th>ID</th>
                <th>Question</th>
                <th>Correct Option</th>
            </tr>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['question_text']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['correct_option']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No questions found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>
</html>

<?php
mysqli_close($conn);
?>