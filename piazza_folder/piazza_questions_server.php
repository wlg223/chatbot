<?php
   # NOTE: These are some example functions that have been defined for you. 
   # You may choose to keep them, remove them, or modify them as you see fit for your application usage.
   

   # What other parameters do you need to insert a post into piazza_questions database?
   function createPost($table_name, $post_id, $post_problem, $post_subject, $post_error, $post_answer, $post_pid) {
      $con_db = mysqli_connect("localhost", "root", "root", "piazza_questions"); 
      if(mysqli_connect_errno($con_db)) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $sql_command= "INSERT INTO $table_name (id, problem, subject, error, answer, pid) VALUES ('$post_id', '$post_problem', '$post_subject', '$post_error', '$post_answer', '$post_pid')";

      if(mysqli_query($con_db, $sql_command)) {
         echo "Query successfully completed";
      }
      else {
         echo "Query failed to execute";
      }
      mysqli_close($con_db);
     
   }

   function deletePost($table_name, $post_id) {
      $con_db = mysqli_connect("localhost", "root", "root", "piazza_questions"); 
      if(mysqli_connect_errno($con_db)) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $sql_command = "DELETE FROM $table_name WHERE id=$post_id";

      if(mysqli_query($con_db, $sql_command)) {
         echo "Query successfully completed";
      }
      else {
         echo "Query failed to execute";
      }
      mysqli_close($con_db);
     
   }

   function updatePost($table_name, $post_id, $post_problem, $post_subject, $post_error, $post_answer, $post_pid) {
      $con_db = mysqli_connect("localhost", "root", "root", "piazza_questions"); 
      if(mysqli_connect_errno($con_db)) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $sql_command = "UPDATE $table_name SET 
      `problem` = '$post_problem', 
      `subject` = '$post_subject', 
      `error` = '$post_error', 
      `answer` = '$post_answer', 
      `pid` = '$post_pid' 
      WHERE id=$post_id ";

      if(mysqli_query($con_db, $sql_command)) {
         echo "Query successfully completed";
      }
      else {
         echo "Query failed to execute";
      }
      mysqli_close($con_db);
     
   }

   function readPost($table_name, $post_id) {
      $con_db = mysqli_connect("localhost", "root", "root", "piazza_questions"); 
      if(mysqli_connect_errno($con_db)) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $sql_command = "SELECT * FROM $table_name WHERE $post_id";

      if(mysqli_query($con_db, $sql_command)) {
         echo "Query successfully completed";
      }
      else {
         echo "Query failed to execute";
      }
      mysqli_close($con_db);
     
   }

   function readAllPost($table_name, $post_id) {
      $con_db = mysqli_connect("localhost", "root", "root", "piazza_questions"); 
      if(mysqli_connect_errno($con_db)) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $sql_command = "SELECT * FROM $table_name";

      if(mysqli_query($con_db, $sql_command)) {
         echo "Query successfully completed";
      }
      else {
         echo "Query failed to execute";
      }
      mysqli_close($con_db);
     
   }

   
?>