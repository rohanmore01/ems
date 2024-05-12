$(document).ready(function() {

    var leaveApplicationId;
    var leaveApplicationAction;

    $(document).on('click', '.btn-action', function() {

        leaveApplicationId = $(this).attr('data-id');
        leaveApplicationAction = $(this).attr('id');

        if(leaveApplicationAction == 'reject')
        {
          $("#submit_reject_reason").click(function(){
      
          var rejectReason = $('#reject_reason').val();
          
          if(rejectReason =='')
          {
            alert('Please Enter reason to reject');
          }
          else
          {
            $.ajax({
                  url: 'leave-application-action.php',
                  method: 'POST',
                  data: {
                      rejectReason: rejectReason,
                      leaveApplicationId: leaveApplicationId,
                      leaveApplicationAction: leaveApplicationAction
                  },
                  error: err => console.log(err),
                  success: function(resp) {
                    
                      resp = JSON.parse(resp)
                      if(resp.status == 1 && resp.action == "Rejected")
                      {
                          $('#'+resp.row_id).find(".status").html("Rejected").css('color','red');
                          $('#'+resp.row_id).find(".reason").html(resp.reject_reason);
                          $('.closeLeaveApplicationModal').click();
                          swal({
                              title: 'Success',
                              text: 'Reject Reason Added Successfully',
                              icon: 'success',
                              buttons: false,
                              closeOnClickOutside: false,
                              closeOnEsc: false,
                              timer: 2000
                            })
                      }
                  }
              });
          }

          }); 
        }
        if(leaveApplicationAction == 'approved')
        {
               $.ajax({
                url: 'leave-application-action.php',
                method: 'POST',
                data: {
                    leaveApplicationId: leaveApplicationId,
                    leaveApplicationAction: leaveApplicationAction
                },
                error: err => console.log(err),
                success: function(resp) {
                   
                    resp = JSON.parse(resp)
                    if (resp.status == 1 && resp.action == "Approved") 
                    {
                        $('#'+resp.row_id).find(".status").html("Approved").css('color','green');
                        $('#'+resp.row_id).find(".reason").html('');
                        swal({
                              title: 'Success',
                              text: 'Leave Application Approved Successfully',
                              icon: 'success',
                              buttons: false,
                              closeOnClickOutside: false,
                              closeOnEsc: false,
                              timer: 2000
                            })
                    }
                }
            });
        }

     });  
})