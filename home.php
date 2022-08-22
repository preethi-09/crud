<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Student Details</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
    
  </head>
  <body>
<div class="modal" tabindex="-1" role="dialog" id='modal_frm'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Student Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id='frm'>
      <input type='hidden' name='action' id='action' value='Insert'>
      <input type='hidden' name='id' id='uid' value='0'>
      <div class='form-group'>
        <label>Name</label>
        <input type='text' name='name' id='name' required class='form-control'>
      </div>
      <div class='form-group'>
        <label>Register No</label>
        <input type="text" name='regno' id='regno' required class='form-control'>     
      </div>
    
      <div class='form-group'>
        <label>Email Id</label>
        <input type='text' name='email' id='email' required class='form-control'>
      </div>
      <div class='form-group'>
        <label>Password</label>
        <input type='password' name='password' id='password' required class='form-control'>
      </div>
      <input type='submit' value='Submit' class='btn btn-success'>
    </form>
      </div>
    </div>
  </div>
</div>

  <div class='container mt-5'>
      <p class='text-right'><a href='#' class='btn btn-success' id='add_record'>Add Record</a></p>
    
    <table class='table table-bordered'>
    <thead>
      <th>Id</th>
      <th>Name</th>
      <th>Register No</th>
      <th>Email</th>
      <th>Password</th>
      <th>Edit</th>
      <th>Delete</th>
      
    </thead>
    <tbody id='tbody'>
      <?php 
        $con=mysqli_connect("localhost","root","","college");
        $sql="select * from student";
        $res=$con->query($sql);
        while($row=$res->fetch_assoc()){
          echo "
            <tr><td>{$row["id"]}</td>
              <td>{$row["name"]}</td>
              <td>{$row["regno"]}</td>
              <td>{$row["email"]}</td>
              <td>{$row["password"]}</td>
              <td><a href='#' class='btn btn-primary edit'>Edit</a></td>
              <td><a href='#' class='btn btn-danger delete'>Delete</a></td>
              
            </tr>
          ";
        }
      ?>
    </tbody>
    </table>
  </div>

    <script>
      $(document).ready(function(){
        var current_row=null;
        $("#add_record").click(function(){
          $("#modal_frm").modal();
        });
        
        $("#frm").submit(function(event){
          event.preventDefault();
          $.ajax({
            url:"action.php",
            type:"post",
            data:$("#frm").serialize(),
            beforeSend:function(){
              $("#frm").find("input[type='submit']").val('Loading...');
            },
            success:function(res){
              if(res){
                if($("#uid").val()=="0"){
                  $("#tbody").append(res);
                }else{
                  $(current_row).html(res);
                }
              }else{
                alert("Failed Try Again");
              }
              $("#frm").find("input[type='submit']").val('Submit');
              clear_input();
              $("#modal_frm").modal('hide');
            }
          });
        });

        $("body").on("click",".edit",function(event){
          event.preventDefault();
          current_row=$(this).closest("tr");
          $("#modal_frm").modal();
          var id=$(this).closest("tr").find("td:eq(0)").text();
          var name=$(this).closest("tr").find("td:eq(1)").text();
          var regno=$(this).closest("tr").find("td:eq(2)").text();
          var email=$(this).closest("tr").find("td:eq(3)").text();
          var password=$(this).closest("tr").find("td:eq()").text();
          
          $("#action").val("Update");
          $("#uid").val(id);
          $("#name").val(name);
          $("#regno").val(regno);
          $("#email").val(email);
          $("#password").val(password);
        });
        
        $("body").on("click",".delete",function(event){
          event.preventDefault();
          var id=$(this).closest("tr").attr("uid");
          var cls=$(this);
          if(confirm("Are You Sure")){
            $.ajax({
              url:"action.php",
              type:"post",
              data:{uid:id,action:'Delete'},
              beforeSend:function(){
                $(cls).text("Loading...");
              },
              success:function(res){
                if(res){
                  $(cls).closest("tr").remove();
                }else{
                  alert("Failed TryAgain");
                  $(cls).text("Try Again");
                }
              }
            });
          }
        });
        
        function clear_input(){
          $("#frm").find(".form-control").val("");
          $("#action").val("Insert");
          $("#uid").val("0");
        }
    
        
       
      });
    </script>
  </body>
</html>