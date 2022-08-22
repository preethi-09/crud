<?php

  $conn=mysqli_connect("localhost","root","","college");
  $action=$_POST["action"];
  //$profile_pic = $_POST['profile_pic'];

print_r($_POST);
  $target_path = "profile/";  
$target_path = $target_path.basename( $_FILES['profile_pic']['name']);   

if(move_uploaded_file($_FILES['profile_pic']['tmp_name'], $target_path)){

  echo "uploaded";
}else{
  echo "not uploaded";
}



  if($action=="Insert"){
    $first_name=mysqli_real_escape_string($conn,$_POST["first_name"]);
    $last_name=mysqli_real_escape_string($conn,$_POST["last_name"]);
    $dob=mysqli_real_escape_string($conn,$_POST["dob"]);
    $course=mysqli_real_escape_string($conn,$_POST["course"]);
    $gender=mysqli_real_escape_string($conn,$_POST["gender"]);
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $profile_pic=mysqli_real_escape_string($conn,$_POST["profile_pic"]);

    
    $sql="insert into students (first_name,last_name,dob,course,gender,email,profile_pic) values ('{$first_name}','{$last_name}','{$dob}','{$course}','{$gender}','{$email}','{$profile_pic}') ";
    if($conn->query($sql)){
      $id=$conn->insert_id;
      echo "
        <tr> <td>{$id}</td>
          <td>{$row["first_name"]}</td>
              <td>{$row["last_name"]}</td>
              <td>{$row["dob"]}</td>
              <td>{$row["course"]}</td>
              <td>{$row["gender"]}</td>
              <td>{$row["email"]}</td>
              <td>{$row["profile_pic"]}</td>
           <td><a href='#' class='btn btn-primary view'>view</a></td>
          <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
          <td><a href='#' class='btn btn-danger delete'>Delete</a></td> 
        $run=mysqli_query($conn,$query); 
          
        </tr>";
    }else{
      echo false;
    }
  
  }else if($action=="Update"){
     $first_name=mysqli_real_escape_string($conn,$_POST["first_name"]);
    $last_name=mysqli_real_escape_string($conn,$_POST["last_name"]);
    $dob=mysqli_real_escape_string($conn,$_POST["dob"]);
    $course=mysqli_real_escape_string($conn,$_POST["course"]);
    $gender=mysqli_real_escape_string($conn,$_POST["gender"]);
    $email=mysqli_real_escape_string($conn,$_POST["email"]);
    $profile_pic=mysqli_real_escape_string($conn,$_POST["profile_pic"]);

    $sql="update students SET first_name='{$first_name}',last_name='{$last_name}',dob='{$dob}',course='{$course}',gender='{$gender}',email='{$email}',profile_pic='{$profile_pic}'  where ID='{$id}'";
    if($conn->query($sql)){
      echo "
        <<td>{$row["first_name"]}</td>
              <td>{$row["last_name"]}</td>
              <td>{$row["dob"]}</td>
              <td>{$row["course"]}</td>
              <td>{$row["gender"]}</td>
              <td>{$row["email"]}</td>
              <td>{$row["profile_pic"]}</td>
        <td><a href='#' class='btn btn-primary view'>view</a></td>
        <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
        <td><a href='#' class='btn btn-danger delete'>Delete</a></td>";
        
    }else{
      echo false;
    }
  }else if($action=="Delete"){
    $id=$_POST["uid"];
    $sql="delete from students where ID='{$id}'";
    if($conn->query($sql)){
      echo true;
    }else{
      echo false;
    }
  }
?>