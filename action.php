<?php

  $con=mysqli_connect("localhost","root","","college");
  
  $action=$_POST["action"];
  if($action=="Insert"){
    $name=mysqli_real_escape_string($con,$_POST["name"]);
    $regno=mysqli_real_escape_string($con,$_POST["regno"]);
    $email=mysqli_real_escape_string($con,$_POST["email"]);
    $password=mysqli_real_escape_string($con,$_POST["password"]);
    $sql="insert into student (name,regno,email,password) values ('{$name}','{$regno}','{$email}','{$password}') ";
    if($con->query($sql)){
      $id=$con->insert_id;
      echo "
        <tr> <td>{$id}</td>
          <td>{$name}</td>
          <td>{$regno}</td>
          <td>{$email}</td>
          <td>{$password}</td>
          <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
          <td><a href='#' class='btn btn-danger delete'>Delete</a></td>
          
        </tr>";
    }else{
      echo false;
    }
  
  }else if($action=="Update"){
    $id=mysqli_real_escape_string($con,$_POST["id"]);
    $name=mysqli_real_escape_string($con,$_POST["name"]);
    $regno=mysqli_real_escape_string($con,$_POST["regno"]);
    $email=mysqli_real_escape_string($con,$_POST["email"]);
    $password=mysqli_real_escape_string($con,$_POST["password"]);

    $sql="update student SET name='{$name}',regno='{$regno}',email='{$email}',password='{$password}'  where ID='{$id}'";
    if($con->query($sql)){
      echo "
        <td>{$id}</td>
        <td>{$name}</td>
        <td>{$regno}</td>
        <td>{$email}</td>
        <td>{$password}</td>
        <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
        <td><a href='#' class='btn btn-danger delete'>Delete</a></td>";
        
    }else{
      echo false;
    }
  }else if($action=="Delete"){
    $id=$_POST["uid"];
    $sql="delete from student where ID='{$id}'";
    if($con->query($sql)){
      echo true;
    }else{
      echo false;
    }
  }
?>