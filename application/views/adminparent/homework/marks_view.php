
<div class="main-panel">
<div class="content">
<div class="col-md-12">

                  <!-- end card -->
						
						
						 <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="header">
                                <h4 class="title">View Marks Details <button onclick="history.go(-1);" class="btn btn-wd btn-default pull-right" style="margin-top:-10px;">Go Back</button></h4>
                            </div>
                            <div class="content table-responsive table-full-width">
                               <table id="bootstrap-table" class="table">
                                    <thead>
                                        <th>S.No</th>
										<th>Name</th>
										
                                    	<th>Marks</th>
                                    	<th>ReMarks</th>
                                    </thead>
		      <form method="post" action="<?php echo base_url(); ?>homework/update" class="form-horizontal" enctype="multipart/form-data" id="markform">
                                    <tbody>
									<?php
									if(empty($res)){
									echo "No Marks Added";}else{
									$i=1;
									foreach ($res as $rows)
									{
										//$sub=$res->subject_name;
										$enr_id=$rows->enroll_mas_id;
										$sql="SELECT enroll_id,name FROM edu_enrollment WHERE enroll_id='$enr_id'";
									    $result=$this->db->query($sql);
										$res=$result->result();
										$sname=$res[0]->name;
									?>
									
                                        <tr>
                                        	<td><?php echo $i; ?>
											
											<input type="hidden" name="enroll[]" value="<?php echo $rows->enroll_mas_id;?>"/>
									        <input type="hidden" name="hwid" value="<?php echo $rows->hw_mas_id;?>"/>
									       </td>
										   <td><?php echo $sname; ?></td>
                                        	<td style="width:20%;"> 
											<input type="text" readonly name="marks[]" value="<?php echo $rows->marks; ?>" class="form-control"/>
											</td>
                                        	<td> 
											<textarea readonly name="remarks[]" value="" class="form-control" rows="1" cols="03"><?php echo $rows->remarks; ?></textarea></td>
                                        	
                                        </tr>
										
									<?php $i++;  } }?>
								   <tr>
								   <td></td><td></td>
                          <td> 
                              
                                  <!-- <button type="submit" id="save" class="btn btn-info btn-fill center">Update </button>-->
							  
							</td>	<td></td><td></td>							   
								   </tr>
                                    </tbody>
									
								</form>
                                </table>

                            </div>
                        </div>
                    </div><!-- end col-md-12 -->
                </div>

                    </div>
</div>
</div>
<script type="text/javascript">
var loadFile = function(event) {
 var output = document.getElementById('output');
 output.src = URL.createObjectURL(event.target.files[0]);
};


$(document).ready(function () {

$('#teachermenu').addClass('collapse in');
$('#teacher').addClass('active');
$('#teacher2').addClass('active');
 $('#admissionform').validate({ // initialize the plugin
     rules: {

         name:{required:true }, address:{required:true },
         email:{required:true,email:true
         },
         sex:{required:true },
         dob:{required:true },
         age:{required:true,number:true,maxlength:2 },
         nationality:{required:true },
         religion:{required:true },
         community_class:{required:true },
         community:{required:true },

         mobile:{required:true }

     },
     messages: {

           address: "Enter Address",
           admission_date: "Select Admission Date",
           name: "Enter Name",
            email: "Enter Email Address",
             remote: "Email already in use!",
           sex: "Select Gender",
           dob: "Select Date of Birth",
           age: "Enter AGE",
           nationality: "Nationality",
           religion: "Enter the Religion",
           community:"Enter the Community",
           community_class:"Enter the Community Class",
           mother_tongue:"Enter The Mother tongue",
           mobile:"Enter the mobile Number"

         }
 });
});

</script>
<script type="text/javascript">
function checkMailStatus(){
    //alert("came");
var email=$("#email").val();// value in field email
alert(email);
$.ajax({
        type:'post',
        url:'check_email',// put your real file name
        data:{email: email},
        success:function(msg){
        alert(msg); // your message will come here.
        }
 });
}



</script>
