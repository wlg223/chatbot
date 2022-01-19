<?php
   # NOTE: These are some example functions that have been defined for you. 
   # You may choose to keep them, remove them, or modify them as you see fit for your application usage.
   
   $servername = "localhost";
   $db = "piazza_questions";
   $password = "password";
  


   function My_create_database($database_name) {
      $con = mysqli_connect($servername, $database_name, $password);
      $sql_command = "CREATE DATABASE $database_name";
      if(mysqli_query($con, $sql_command)) {
         echo "Query successfully completed";
      }
      else {
         echo "Query failed to execute";
      }
      mysqli_close($con);
   }

   function My_delete_database($database_name) {
      $con = mysqli_connect($servername, $database_name, $password);
      $sql_command = "DROP DATABASE $database_name";
      if(mysqli_query($con, $sql_command)) {
         echo "Query successfully completed";
      }
      else {
         echo "Query failed to execute";
      }
      mysqli_close($con);

   }

   # What other parameters do you need to insert a post into piazza_questions database?
   function My_insert_post($table_name, $post_id, $post_problem, $post_subject, $post_error, $post_answer, $post_pid) {
      $con_db = mysqli_connect("localhost", "piazza_questions", "password");      
      if(mysqli_connect_errno($con_db)) {
         echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }

      $sql_command = "INSERT INTO $table_name (id, problem, subject, error, answer, pid) VALUES ($post_id, $post_problem, $post_subject, $post_error, $post_answer, $post_pid)";

      if(mysqli_query($con_db, $sql_command)) {
         echo "Query successfully completed";
      }
      else {
         echo "Query failed to execute";
      }
      mysqli_close($con);
     
   }

   function My_delete_post($table_name, $post_id) {
      $con_db = mysqli_connect("localhost", "piazza_questions", "password");      
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
      mysqli_close($con);
     
   }

   function My_modify_post($table_name, $post_id, $post_problem, $post_subject, $post_error, $post_answer, $post_pid) {
      $con_db = mysqli_connect("localhost", "piazza_questions", "password");      
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
      mysqli_close($con);
     
   }

   function My_read_post($table_name, $post_id) {
      $con_db = mysqli_connect("localhost", "piazza_questions", "password");      
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
      mysqli_close($con);
     
   }

   function My_readall_post($table_name, $post_id) {
      $con_db = mysqli_connect("localhost", "piazza_questions", "password");      
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
      mysqli_close($con);
     
   }

   $method = $_POST['method'];
   switch($method) {
      case 'insert_post':
         My_insert_post($table_name, $post_id, $post_problem, $post_subject, $post_error, $post_answer, $post_pid);
         break;
      case 'delete_post':
         My_delete_post($table_name, $post_id);
         break;
      case 'modify_post':
         My_modify_post($table_name, $post_id, $post_problem, $post_subject, $post_error, $post_answer, $post_pid);
         break;
      case 'read_post':
         My_read_post($table_name, $post_id);
         break;
      case 'read_all_post':
         My_readall_post($table_name, $post_id);
         break;
      default:
         echo "error";
         break;
   }
?>