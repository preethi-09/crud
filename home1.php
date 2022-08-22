<!DOCTYPE html>
<html lang="en">
  <head>
     <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students Details</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
     <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> 
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
 
  </head>
  <script>

</script>
  <body style="background-image:url('table-img.webp');background-size:cover; ">
<div class="modal" tabindex="-1" role="dialog" id='modal_frm'>
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        
        <h5 class="modal-title" style="color:darkblue; font-weight: bold ;">REGISTRATION</h5>
    
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id='frm' method="POST" enctype="multipart/form-data">
      <input type='hidden' name='action' id='action' value='Insert'>
      <input type='hidden' name='id' id='uid' value='0'>
      <div class='form-group'>
       <label>First Name</label>
        <input type='text' name='first_name' id='first_name' required class='form-control'>
      </div>
      <div class='form-group'>
        <label>Last Name</label>
        <input type="text" name='last_name' id='last_name' required class='form-control'>     
      </div>
    
      <div class='form-group'>
        <label>DOB</label>
        <input type='date' name='dob' id='dob' required class='form-control'>
      </div>
      <div class='form-group'>
        <label for="course">Course</label>
            <select class='form-control' name="course" id="course" required>
              <option value="" disabled selected="selected">Select Course</option>
              <option value="Python">Python</option>
              <option value="Java">Java</option>
              <option value="Lamp">Lamp</option>
              <option value=".Net">.Net</option>
            </select>
         
      </div>
      <div class='form-group'>
        <label required class='' >Gender</label>
        <div class="form-control">         
         <label class="radio-container m-r-46" >Male
            <input type="radio" name="gender"  value="Male" required="required">
            <span class="checkmark"></span>
        </label>
        <label class="radio-container" >Female
            <input type="radio" name="gender"  value="Female" required="required">
            <span class="checkmark"></span>
        </label>
        <label class="radio-container">Others
            <input type="radio" name="gender"  value="Others" required="required">
            <span class="checkmark"></span>
        </label>
        </div>
      </div>
    
      <div class='form-group'>
        <label>Email Id</label>
        <input type='email' name='email' id='email' required class='form-control'>
      </div>
      <div class='form-group'>
        <label>Profile</label>
        <input type="file" name="profile_pic" id="profile_pic" class="profile_pic" required>
      </div><center>
      <input type='submit' value='Submit' id="submit" onclick="uploadfile()"class='btn btn-primary'>
      </center>
    </form>
      </div>
    </div>
  </div>
</div>


<!-- view -->

 <!-- Table -->

  <div class='container mt-5'>
    
    
    <table id="example" class='table table-bordered' style="border: 3px solid black;">
        <h1 style="text-align:center; font-family:'times new roman';color:red"><b>STUDENTS DETAILS</b></h1>
         
         
            <p class='text-right'><a href='logout.php' class='btn btn-success'>Logout</a></p>
              <a href='#' type="button" class='btn btn-primary' id='add_record' class="text-left">Add</a>
              <br/><br/>
    <thead>
                <th>ID</th>
                <th>FIRST NAME</th>
                <th>LAST NAME</th>
                <th>DOB</th>
                <th>COURSE</th>
                <th>GENDER</th>
                <th>EMAIL</th>
                <th>PROFILE</th>
                <th>VIEW</th>
                <th>EDIT</th>
                <th>DELETE</th>

      
    </thead>
    <tbody id='tbody'>
      <?php 
        $conn=mysqli_connect("localhost","root","","college");
        $sql="select * from students";
        $res=$conn->query($sql);
        while($row=$res->fetch_assoc()){
          echo "
            <tr><td>{$row["id"]}</td>
              <td>{$row["first_name"]}</td>
              <td>{$row["last_name"]}</td>
              <td>{$row["dob"]}</td>
              <td>{$row["course"]}</td>
              <td>{$row["gender"]}</td>
              <td>{$row["email"]}</td>
              <td>{$row["profile_pic"]}</td>
              <td><a href='#' class='btn btn-primary view'>View</a></td>
              <td><a href='#' class='btn btn-success edit'>Edit</a></td>
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
            data: new FormData(this),
            contentType:false,
            processData:false,

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
          var first_name=$(this).closest("tr").find("td:eq(1)").text();
          var last_name=$(this).closest("tr").find("td:eq(2)").text();
          var dob=$(this).closest("tr").find("td:eq(3)").text();
          var course=$(this).closest("tr").find("td:eq(4)").text();
          var gender=$(this).closest("tr").find("td:eq(5)").text();
          var email=$(this).closest("tr").find("td:eq(6)").text();
          var profile_pic=$(this).closest("tr").find("td:eq(7)").text();
          
          $("#action").val("Update");
          $("#uid").val(id);
          $("#first_name").val(firsr_name);
          $("#last_name").val(last_name);
          $("#dob").val(dob);
          $("#course").val(course);
          $("#gender").val(gender);
          $("#email").val(email);
          $("#profile_pic").val(profile_pic);
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
        
         $(document).ready(function(){
        var current_row=null;
        $("#view").click(function(){
          $("#view_modal").modal();
        });
        


        function clear_input(){
          $("#frm").find(".form-control").val("");
          $("#action").val("Insert");
          $("#uid").val("0");
        }
  });

    </script>
    <script type="text/javascript">
  $(document).ready(function () {
  $('#example').DataTable({
   "ordering": false // false to disable sorting (or any other option)
  });
  $('.dataTables_length').addClass('bs-select');
});
   </script>
  </body>
</html>