<?php
include ("../includes/config.php");
include ("./header.php");
include ("./sidebar.php");
include ("./footer.php");
error_reporting(0);

?>





              <?php
               $record = "SELECT * FROM students ";
               $result = mysqli_query($conn, $record);
               $row = mysqli_fetch_assoc($result);
               $class_id = $row['class_id'];

             
$query = mysqli_query($conn, "SELECT * FROM students WHERE class_id= '$class_id'");


while ($student = mysqli_fetch_object($query)) {
  
    $studentId = $student->student_id; 
    $studentemail = $student->email; // Teacher ID

    $email = $_SESSION['email'];
    $record = "SELECT * FROM teachers WHERE email='$email'";
    $result = mysqli_query($conn, $record);
    
    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }
    
    $teacher = mysqli_fetch_object($result);
    $teacherId = $teacher->teacher_id;
    $chatSessionId = $studentId . '_' . $teacherId; 
   

    ?>
<br><br>
    <section class="chat-area">
        <div class="chat-header">
            <header>
            <?php 

 
// Get image data from database 

$result = mysqli_query($conn, "SELECT image FROM students WHERE email = '$studentemail'" ); 
?>

<?php if($result->num_rows > 0){ ?> 
    
        <?php while($row = $result->fetch_assoc()){ ?> 
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
        <?php } ?> 
   
<?php }else{ ?> 
    <img  src="vector1.png" />
<?php } ?>

                <div class="details">
                    <span><?= $student->name ?></span>
                    <p></p>
                </div>
            </header>
        </div>
        <div class="chat-content hidden">
        <div class="chat-box">
            <?php
             // ...
           $chatMessages = array(); // Initialize an array to store chat messages
           
           // Fetch chat messages in descending order by timestamp or message ID
           $chatSessionQuery = "SELECT * FROM chats WHERE session_id = '$chatSessionId'"; // Replace 'timestamp_column' with the actual timestamp column name
           $chatSessionResult = mysqli_query($conn, $chatSessionQuery);
           
           while ($chat = mysqli_fetch_object($chatSessionResult)) {
               $chatMessages[] = $chat; // Store each chat message in the array
           }
           
           // Loop through chat messages in reverse order to display the newest messages at the bottom
           for ($i = count($chatMessages) - 1; $i >= 0; $i--) {
               $chat = $chatMessages[$i];
               $messageId = $chat->message_id; // Replace 'message_id' with the actual message ID column name
               // Define a CSS class for styling based on message sender (outgoing/incoming)
               $messageClass = ($chat->from_id == $studentId) ? 'outgoing' : 'incoming';
               ?>
               <div class="chat" id="message<?= $messageId ?>">
                   <div class="<?= $messageClass ?>">
                       <div class="details">
                           <p><?= $chat->message ?></p>
                       </div>
                   </div>
               </div>
            <?php }  ?>
            
        </div>

        <?php
        $uniqueChatQuery = "SELECT * FROM chats WHERE session_id = '$chatSessionId'";
        $uniqueChatResult = mysqli_query($conn, $uniqueChatQuery);
        $chatExists = mysqli_num_rows($uniqueChatResult) > 0;
        ?>

       
            <form action="insert-chat.php" method="POST" class="chat-insert">
                <input name="session_id" value="<?= $chatSessionId ?>" hidden>
                <input name="ID" value="<?=$teacherId ?>" hidden>
                <input name="id" value="<?= $studentId ?>" hidden>
                <input id="message" name="message">
                <button id="myButton" name="submit"><i class="fa fa-paper-plane"></i></button>
            </form>
            </div>
    </section>

<?php }   ?>



<script>
  const chatHeaders = document.querySelectorAll('.chat-header');
  const chatContents = document.querySelectorAll('.chat-content');
  
  chatHeaders.forEach((header, index) => {
    header.addEventListener('click', function() {
      chatContents[index].classList.toggle('hidden');
      const isVisible = !chatContents[index].classList.contains('hidden');
      localStorage.setItem(`chat-${index}-visible`, isVisible);
    });
    
    // Retrieve visibility state from localStorage
    const isVisible = localStorage.getItem(`chat-${index}-visible`);
    if (isVisible === 'true') {
      chatContents[index].classList.remove('hidden');
    } else {
      chatContents[index].classList.add('hidden');
    }
  });


  
</script>

<script src="./js/dashboard.js"></script>

