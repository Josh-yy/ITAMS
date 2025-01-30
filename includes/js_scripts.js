function fire_message(title,message,icon)
{
  Swal.fire({
        title: message,
        icon: icon,
        timer: 2000,
    });
} 



function validate_form(form_id,url,msg_title,msg_content,err_div,msg_icon,control_arrays,control_names){
  var counter = 0;

    for(var i = 0;i<control_arrays.length; i++){
      if($('#' + control_arrays[i]).val().length>0){
         $('#' + err_div).empty();
        $('#' + control_arrays[i]).removeClass('bg-red-100');
        $('#' + control_arrays[i]).removeClass('adderrborder');
        $('#' + control_arrays[i]).removeClass('text-danger');
      }else{
        counter++;
        $('#' + err_div).addClass('text-red-900');
        $('#' + control_arrays[i]).focus();
        $('#' + control_arrays[i]).addClass('bg-red-100');
        $('#' + err_div).html("Please enter " + control_names[i]);
        $('#' + control_arrays[i]).addClass('adderrborder');
      }
    }
    if(counter==0){
      esubmit("controllers/verify",$('#' + form_id).serialize(),1,"index");
    }
    
}

function esubmit(my_url,data,redirect,redirect_page){
 $.ajax({
  type:'POST',
  cache:false,
  data:data,
  url:my_url,
  success:function(data){

   swal_interval("Account Verification","Verifying Account Please wait",redirect_page,data);
  }
 })
}

function listrecord(url,display_div,a)
        {
         
          var mydata="param=" + a ;
          $.ajax({type: 'POST',
            url: url,
            data: mydata,
            cache:false,
           success: function(data){$("#" + display_div).html(data);}
          })
        } 
  function listdata(url,display_div,a)
        {
         
          var mydata="param=" + a ;
          $.ajax({type: 'POST',
            url: url,
            data: mydata,
            cache:false,
            beforeSend: function (){
            $("#" + display_div).html("<br><br><center><img src='assets/images/fbload.gif' style='width:50%' /></center>");},
           success: function(data){$("#" + display_div).html(data);}
          })
        } 

         
function submit_form(form_name,btn_name,url,message,listurl,div,modal)
{
    var logForm = $('#' + form_name).serialize();
    //alert(logForm);
        $.ajax({type: 'POST',
        url: url,
        data: logForm,
        cache:false,
        beforeSend: function (){
        $("#" + btn_name).attr("disabled",true);
      },success: function(data){
          $("#" + btn_name).attr("disabled",false);
          $("#" + modal + ' .close').click();
          if(data==1){

          fire_message("Record exist","The item you want to add is already existing","error");
          $("#" + btn_name).attr("disabled",false);
          }else if(data==0){
             fire_message("Notifier",message ,"success");
            if(modal!=='')
            { 
               document.getElementById(form_name).reset();
              $("#" + btn_name).attr("disabled",false); 
              listrecord(listurl,div,"1&search=");

            }
            else
            {
              setTimeout("reload_window()",1000);
            }
           
          }
         
          else
          {
            fire_message("System Message","Sorry but you cannot delete this item because there is a data referenced to this item." ,"info");
          }

        }})
  
}



function delete_record(id,name,action,url,display_area,param){
  Swal.fire({
  title: 'Delete Record?',
  text: "Are you sure you want to remove " + name + '?',
  icon: 'question',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes, delete it!'
}).then((result) => {
  if (result.isConfirmed) {
       $.ajax({
        type: 'POST',
        url:'../controllers/delete_records',
        cache: false,
        data: 'action=' + action + "&id=" + id,
        beforeSend: function(){
            $('#btn' + id).attr('disabled',true);
        },
        success:function(data){

             Swal.fire(
            'Record Deleted!',
            'Transaction Completed',
            'success'
          )
          listrecord(url,display_area,param + "&search=");
        }
    })
    
 
  }
})
}

//save usertype
  $('#btnsaveselection').on("click",function() {
  var letters = $('input[name="lab_id[]"]:checked').map(function(){return this.value;}).get()
  var mydata = "action=addrole" + "&usertypeid=" + $('#txttypeid').val()  + "&facility=" + letters;
  //alert(mydata);
  if(letters=="")
  {
      fire_message("Notifier","Please select facilities" ,"info");
  }
  else
    {
     $.ajax({
                  url: '../controllers/add_role',
                  type: 'POST',
                  data: mydata,
                  cache:false,
                  beforeSend: function() {
                    $('#btnsaveselection').attr('disabled', true);
                  },
                  success: function(data) {
              
                    $('#closemodal').click();
                    $('#btnsaveselection').attr('disabled', false);
                    listrecord('listviews/v_usertype','display_list',1 + '&search=');
                    
                  }
                })
    }
})

   $('#btnsaveselectedsubject').on("click",function() {
    var year_level,semester;
  var letters = $('input[name="lab_id[]"]:checked').map(function(){return this.value;}).get()
  var curr = $("#curr_id").val();
  year_level =$('#cboyl').val();
  semester =$('#txtsem').val();
  var mydata = "action=addrole" + "&usertypeid=" + $('#txttypeid').val() + "&curr=" + curr + "&year_level=" + year_level + "&semester=" + semester  + "&facility=" + letters ;


  if(year_level=="")
  {
     $('#closemodal').click();
     fire_message("Notifier","Select Year Level","info");

  }
  else if(semester=="")
  {
     $('#closemodal').click();
     fire_message("Notifier","Select Semester","info");
  }
  else if(letters.length==0)
  {
      $('#closemodal').click();
     fire_message("Notifier","Select Subjects","info");
  }
  else
    {
     $.ajax({
                  url: '../controllers/add_curr_subjects',
                  type: 'POST',
                  data: mydata,
                  cache:false,
                  beforeSend: function() {
                    $('#btnsaveselection').attr('disabled', true);
                  },
                  success: function(data) {
                    fire_message("Notifier","Record Added","info");
                    $('#closemodal').click();
                    $('#btnsaveselection').attr('disabled', false);
                    listrecord('listviews/v_curriculum_subjects','dusplay_curr_subjects',1 + '&search='+'&curr_id=' + curr);
                    
                  }
                })
    }
})

 

function previewFile(input,imgid){
        var file = $('#' + input)[0].files[0]
 
        if(file){
            var reader = new FileReader();
 
            reader.onload = function(){
                $("#" + imgid).attr("src", reader.result);
            }
 
            reader.readAsDataURL(file);
        }
    }