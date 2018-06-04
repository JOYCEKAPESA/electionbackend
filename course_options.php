<?php
include './config/database.php';

$faculty_id = mysqli_escape_string($link, $_POST['faculty_id']);

$result_course = mysqli_query($link, "SELECT * FROM courses WHERE faculty_id = {$faculty_id}") or die(mysqli_error($link));
while ($row = mysqli_fetch_array($result_course)) {
    ?>
    <option value="<?php echo $row['id'] ?>"><?php echo $row['course_name'] ?></option>
    <?php
}
?>

