<?php
include './config/database.php';

$course_id = mysqli_escape_string($link, $_POST['courseId']);

$result_batch = mysqli_query($link, "SELECT * FROM batches WHERE course_id = {$course_id}") or die(mysqli_error($link));
while ($row = mysqli_fetch_array($result_batch)) {
    ?>
    <option value="<?php echo $row['id'] ?>"><?php echo $row['batch_name'] ?></option>
    <?php
}
?>

