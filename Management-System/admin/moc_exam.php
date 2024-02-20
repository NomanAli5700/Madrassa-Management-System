
<?php

//session_start();


include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);
?>



<?php

$edit_state = false;

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_state = true;

    $quiz_query = mysqli_query($conn, "SELECT * FROM quiz WHERE CourseID = $id");
    $quiz_data = mysqli_fetch_array($quiz_query);
    
    $course = $quiz_data['CourseName'];
    $quizNumber = $quiz_data['QuizNumber'];
    $quizTopic = $quiz_data['TopicName'];

    $questions_query = mysqli_query($conn, "SELECT * FROM questions WHERE CourseID = $id");
    $questions_data = mysqli_fetch_all($questions_query, MYSQLI_ASSOC);
}


$errorMessage = "";
if (isset($_POST['submit_part1'])) {
    $course = $_POST['course_name'];
    $quizNumber = $_POST['quiz_number'];
    $quiztopic = $_POST['quiz_topic'];
    $numQuestions = (int)$_POST['num_questions'];
    $showPart2 = true;
} else {
    $showPart2 = false;
}

if (isset($_POST['submit_part2'])) {
    $course = $_POST['course_name'];
    $quizNumber = $_POST['quiz_number'];
    $quiztopic = $_POST['quiz_topic'];
    $numQuestions = (int)$_POST['num_questions'];
    $quizId = 0; // To store the quiz ID

    // Insert the quiz information into the database
   

        // Loop through the questions and options submitted by the user and insert them into the database
       
        
            $query = mysqli_query($conn, "INSERT INTO quiz (CourseName,TopicName, QuizNumber) 
                    VALUES ('$course','$quiztopic', '$quizNumber')");
                    if ($query) {
                        $ID = mysqli_insert_id($conn);}
            
        for ($i = 1; $i <= $numQuestions; $i++) {
            $question = $_POST['question'][$i];
           
            $option1 = $_POST['option1'][$i];
            $option2 = $_POST['option2'][$i];
            $option3 = $_POST['option3'][$i];
            $option4 = $_POST['option4'][$i];
            $answer = $_POST['answer'][$i];
        
    $query = mysqli_query($conn, "INSERT INTO questions ( question, option1, option2, option3, option4 ,answer,CourseID) 
    VALUES ( '$question', '$option1', '$option2', '$option3', '$option4' ,'$answer' ,' $ID')");
    if ($query) {
       
    
        echo 'Quiz added successfully!';
        $showPart2 = false; // Don't show Part 2 after submitting the questions
    }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
</head>
<body>
<?php if(isset($_GET['action'])   )  {?>
    <?php if (!$showPart2): ?>
       
        <div class="ad_mocbody">
        <h2 style="margin-top:10%;margin-left:-10%;font-size:30px; color:#B22B4F;">Add Quiz </h2>
        <form action="#" method="post" class="ad_mocform">
            <label for="course_name">Course Name:</label>
            <input type="text" name="course_name" ><br>

            <label for="quiz_number">Quiz Number:</label>
            <input type="text" name="quiz_number" ><br>

            <label for="quiz_topic">Quiz Topic:</label>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="quiz_topic" ><br>

            <label for="num_questions">Number of Questions:</label>
            <input style="margin-left:14%;" type="number" name="num_questions" min="1" ><br>
           

            <input type="submit" value="Continue to Part 2" name="submit_part1" class="part2">
        </form>
    </div>
    <?php else: ?>
        <h2 style="margin-top:10%;margin-left:-10%;font-size:30px; color:#B22B4F;"> Enter Questions and Answers</h2>
        <div class="ad_mocbody">
        <form action="#" method="post" class="ad_mocform">
            
        <?php for ($i = 1; $i <= $numQuestions; $i++): ?>
                <h3>Question <?php echo $i; ?></h3>
                <label for="question[<?php echo $i; ?>]">Question:</label>
                <input type="text" name="question[<?php echo $i; ?>]"   required><br>

                <label for="option1[<?php echo $i; ?>]">Option 1:</label>
                <input type="text" name="option1[<?php echo $i; ?>]"   required><br>

                <label for="option2[<?php echo $i; ?>]">Option 2:</label>
                <input type="text" name="option2[<?php echo $i; ?>]"  required><br>

                <label for="option3[<?php echo $i; ?>]">Option 3:</label>
                <input type="text" name="option3[<?php echo $i; ?>]"   required><br>

                <label for="option4[<?php echo $i; ?>]">Option 4:</label>
                <input type="text" name="option4[<?php echo $i; ?>]"   required><br>

                <label for="answer[<?php echo $i; ?>]">Correct Answer:</label>
                <input  style="margin-left:14%;"  type="text" name="answer[<?php echo $i; ?>]"   required><br><br>
            <?php endfor; ?>

            <input type="hidden" name="course_name" value="<?php echo $_POST['course_name']; ?>">
            <input type="hidden" name="quiz_number" value="<?php echo $_POST['quiz_number']; ?>">
            <input type="hidden" name="quiz_topic" value="<?php echo $_POST['quiz_topic']; ?>">
            <input type="hidden" name="num_questions" value="<?php echo $_POST['num_questions']; ?>">
            <input  style="padding:20px; color:white; background:green; border-radius:20px; font-size:15px;"  type="submit" value="Submit" name="submit_part2">
        </form>
        </div>
    <?php endif; ?>

    <?php } elseif(isset($_GET['actions'])) { ?>
    <!-- Edit Existing Quiz -->
    <?php if (!$showPart2): ?>
        <!-- Part 1 Form for Edit -->
        <div class="up_mocbody">
        <h2>Edit Quiz </h2>
        <form action="#" method="post">
            <label for="course_name">Course Name:</label>
            <input type="text" name="course" value="<?php echo $course; ?>" required><br>

            <label for="quiz_number">Quiz Number:</label>
            <input type="text" name="quiz_num" value="<?php echo $quizNumber; ?>" required><br>

            <label for="quiz_topic">Quiz Topic:</label>
            &nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="topic" value="<?php echo $quizTopic; ?>" required><br>
           

            <label for="num_questions">Number of Questions:</label>
            <input  type="number" name="num_questions" min="1" value="<?php echo count($questions_data); ?>" required><br>

            
       
            <?php foreach ($questions_data as $i => $question_data): ?>
                <h3>Question <?php echo $i + 1; ?></h3>

                
                <label for="question[<?php echo $i; ?>]">Question:</label>
                <input type="text" name="question[<?php echo $i; ?>]" value="<?php echo $question_data['question']; ?>" ><br>

                <label for="option1[<?php echo $i; ?>]">Option 1:</label>
                <input type="text" name="option1[<?php echo $i; ?>]" value="<?php echo $question_data['option1']; ?>" ><br>

                <label for="option2[<?php echo $i; ?>]">Option 2:</label>
                <input type="text" name="option2[<?php echo $i; ?>]" value="<?php echo $question_data['option2']; ?>" ><br>

                <label for="option3[<?php echo $i; ?>]">Option 3:</label>
                <input type="text" name="option3[<?php echo $i; ?>]" value="<?php echo $question_data['option3']; ?>" ><br>

                <label for="option4[<?php echo $i; ?>]">Option 4:</label>
                <input type="text" name="option4[<?php echo $i; ?>]" value="<?php echo $question_data['option4']; ?>" ><br>

                <label for="answer[<?php echo $i; ?>]">Correct Answer:</label>
                <input type="text" name="answer[<?php echo $i; ?>]" value="<?php echo $question_data['answer']; ?>" ><br><br>
            <?php endforeach; ?>

            <input type="hidden" name="course_name" value="<?php echo $course; ?>">
            <input type="hidden" name="quiz_number" value="<?php echo $quizNumber; ?>">
            <input type="hidden" name="quiz_topic" value="<?php echo $quizTopic; ?>">
            <input type="hidden" name="num_questions" value="<?php echo count($questions_data); ?>">
            <input type="submit" value="Update" name="update" class="moc_btn">
        </form>
            </div>
    <?php endif; ?>


      
    <?php  }  else   { ?>
        
        <h2 class="ad_moc">MOC_Exam</h2>

<div class="ad_moccard">
    <a href="../admin/moc_exam.php?user=&action=add-new" class="add">Add New</a><br><br>

    <table class="ad_moctable">
    <thead>
        <tr>
            <th>Course</th>
            <th>Quiz Number</th>
            <th>Topic</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $user_query = 'SELECT * FROM quiz ORDER BY CourseName';
        $user_result = mysqli_query($conn, $user_query);

        $courses = array(); // To keep track of course names and their quiz counts

        while ($users = mysqli_fetch_object($user_result)) {
            $courseName = $users->CourseName;
            if (!isset($courses[$courseName])) {
                $courses[$courseName] = 0; // Initialize quiz count for the course
            }
            $courses[$courseName]++; // Increment the quiz count for the course
        }

        mysqli_data_seek($user_result, 0); // Reset result pointer

        while ($users = mysqli_fetch_object($user_result)) {
            $courseName = $users->CourseName;
            echo '<tr>';
            if (isset($courses[$courseName])) {
                echo '<td rowspan="' . $courses[$courseName] . '">' . $courseName . '</td>';
                unset($courses[$courseName]); // Remove the course from the array to avoid repetition
            }
            ?>
            <td><?= $users->QuizNumber ?></td>
            <td><?= $users->TopicName ?></td>
            <td>
                <a href="../admin/moc_exam.php?edit=<?= $users->CourseID ?>&actions=update" class="edit_btn"><i class='bx bxs-edit'></i></a>
                <a href="../admin/moc_exam.php?delete=<?= $users->CourseID ?>" class="del_btn" ><i class='bx bxs-trash'></i></a>
            </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
    </div>


          <?php } ?>

<?php


if (isset($_POST['update'])) {
    $quizId = $_GET['edit']; // Assuming you're passing the edit ID via URL
    $course = $_POST['course'];
    $quizNumber = $_POST['quiz_num'];
    $quizTopic = $_POST['topic'];
    $numQuestions = (int)$_POST['num_questions'];
    $updateQuizQuery = "UPDATE quiz SET CourseName='$course', QuizNumber='$quizNumber', TopicName='$quizTopic' WHERE CourseID=$quizId";
    $updateQuizResult = mysqli_query($conn, $updateQuizQuery);

    if (!$updateQuizResult) {
        echo 'Error updating quiz information: ' . mysqli_error($conn);
    } else {
        for ($i = 0; $i < $numQuestions; $i++) {
           
            $question = $_POST['question'][$i];
            $option1 = $_POST['option1'][$i];
            $option2 = $_POST['option2'][$i];
            $option3 = $_POST['option3'][$i];
            $option4 = $_POST['option4'][$i];
            $answer = $_POST['answer'][$i];

            $updateQuestionQuery = "UPDATE questions SET question='$question', option1='$option1', option2='$option2', option3='$option3', option4='$option4', answer='$answer' WHERE CourseID=$quizId ";
            $updateQuestionResult = mysqli_query($conn, $updateQuestionQuery);

            if (!$updateQuestionResult) {
                echo 'Error updating question ' . ($i + 1) . ': ' . mysqli_error($conn);
            }
        }

        echo 'Quiz information and questions updated successfully!';
    }
}
?>

<?php


if (isset($_GET['delete']))  {
    $quizID = $_GET['delete'];
   
    // Perform the deletion query
   
   $result= mysqli_query($conn, "DELETE FROM quiz WHERE CourseID= $quizID ");
   if ($result) {
    echo 'Quiz information and questions updated successfully!';
    
   
        
        header("Location: ../admin/moc_exam.php");
       
    } else {
        echo 'sorry!';
    
   
        
        header("Location: ../admin/moc_exam.php");
    }
}
?>

        
        <!--===== MAIN JS =====-->
        <script src="./js/dashboard.js"></script>
       
    </body>
</html>

