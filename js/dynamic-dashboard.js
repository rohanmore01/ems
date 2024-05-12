$(document).ready(function() {

    setTimeout(function() {
        $(".date_selection").trigger('change');
    });

    var fromDate;
    var toDate;

    $(".date_selection").change(function(){

        if($(this).val() == 'custom_date')
        {
           $('#custom_date').modal('toggle');

           $("#submit_custom_date").click(function(e){
                fromDate = $('#from_date').val();
                toDate = $('#to_date').val();

                if(fromDate == '')
                {
                    alert('Please Enter From Date');
                    e.preventDefault();
                }
                if(toDate == '')
                {
                    alert('Please Enter To Date');
                    e.preventDefault();
                }

                if(e.isDefaultPrevented() != true)
                {
                    $('.closeCustomDateModal').click();
                    callDynamicDashboard();  
                } 
           });
        }

        if($(this).val() == 'Today')
        {
            fromDate = $('.Today').attr('data-id');
            toDate = $('.Today').attr('data-id');
        }

        if($(this).val() == 'Yesterday')
        {
            fromDate = $('.Yesterday').attr('data-id');
            toDate = $('.Yesterday').attr('data-id');
        }

        if($(this).val() == 'this_month')
        {
            fromDate = $('.this_month').attr('from-date');
            toDate = $('.this_month').attr('to-date');
        }

        if($(this).val() == 'this_year')
        {
            fromDate = $('.this_year').attr('from-date');
            toDate = $('.this_year').attr('to-date');
        }

        callDynamicDashboard();
    });

    function callDynamicDashboard()
    {
        if(fromDate != undefined && toDate != undefined)
        {
            var userType = $('.main-panel').attr('user-type');
            var userId = $('.main-panel').attr('user-id');
            
            $.ajax({
                url: 'dynamic-dashboard.php',
                method: 'POST',
                data: {
                    fromDate: fromDate,
                    toDate: toDate,
                    userType: userType,
                    userId: userId
                },
                error: err => console.log(err),
                success: function(resp) {
                
                    resp = JSON.parse(resp);
                    $('.totalEmp').html(resp.total_emp_count);
                    $('.presentEmpCount').html(resp.present_attendance_count);
                    $('.absentEmpCount').html(resp.absent_attendance_count);
                    $('.leaveRequestCount').html(resp.leave_request_count);
                    $('.leaveApprovedCount').html(resp.leave_approve_count);
                    $('.leaveRejectedCount').html(resp.leave_reject_count);
                    
                    $('.totalEmpCard').attr('data-query',resp.total_emp_query);
                    $('.presentEmpCard').attr('data-query',resp.present_attendance_query);
                    $('.absentEmpCard').attr('data-query',resp.absent_attendance_query);
                    $('.leaveRequestCard').attr('data-query',resp.leave_request_query);
                    $('.leaveApprovedCard').attr('data-query',resp.leave_approve_query);
                    $('.leaveRejectedCard').attr('data-query',resp.leave_reject_query);
                }
            });
        }
    }

    $(".cardClick").click(function(){

        var urlRoute = $(this).attr('date-route');
        var dashboardQuery = $(this).attr('data-query');
        var dashboardType = $('.main-panel').attr('user-type');
        var cardColor = $(this).attr('card-color');
        var getDashboardCountClassName = $(this).find('h2').attr('class').split(' ').pop();
        var mainDashboardCount = $('.'+getDashboardCountClassName).html();

        if(dashboardType == 'admin' && mainDashboardCount != 0)
        {
            window.location.href = "sub-dashboard.php?cardColor="+cardColor+"&urlRoute="+urlRoute+"&dashboardQuery="+dashboardQuery;
        }
        else if(mainDashboardCount != 0)
        {
            window.location.href = urlRoute+"?dashboardQuery="+dashboardQuery;
            
            // $.ajax({
            //     url: urlRoute,
            //     method: 'POST',
            //     data: { dashboardQuery: dashboardQuery},
            //     error: err => console.log(err),
            //     success: function(resp) {
                
            //         var htmlContent = $('.main-panel', resp).html();
            //         $('.main-panel').html(htmlContent);
            //     }
            // });
        }
        else
        {
            alert('Record not available');
        }
    });


});

