$(document).ready(function(){

    $(".btnFileUpload").click(function(){

      $('#doc_upload').trigger('click')

      $('#doc_upload').change(function(e) {
        var file = e.target.files[0].name;

        var ext = file.split('.').pop();

        if(ext != "pdf")
        {
          alert('Please Upload PDF Files Only');
          return false;
        }
        
        $('.fa-upload').html(" " + file.substr(0,25)).attr('title',file);
      });

    });

    $("#from_date , #to_date").change(function(){

      var fromDate = new Date($('#from_date').val());
      var toDate = new Date($('#to_date').val());
      var Difference_In_Time = toDate.getTime() - fromDate.getTime();
      var Difference_In_Days = Difference_In_Time / (1000 * 3600 * 24);
      $("#no_of_days").val(Difference_In_Days+1);

      $('#to_date').prop('min',$('#from_date').val());
      $('#from_date').prop('max',$('#to_date').val());
    });

    var form = new FormData();

    $("[name='update-leave-application-form']").click(function(e){
      
    if($('#subject').val() != '' && $('#leave_type').val() != '' && $('#from_date').val() != '' && $('#to_date').val() != '')
    {
        var formData = $('form').serialize();
        var doc_file = $('#doc_upload')[0].files[0];
        form.append('doc_file', doc_file);
        form.append('data', formData);
        form.append('action','edit');
        form.append('attachedFile',$('.fa-upload').attr('title'));
        form.append('encodedFile',$('.fa-upload').attr('encoded-file'));

        $.ajax({
                  url: 'ajax-pdf-leave-application.php',
                  method: 'POST',
                  data: form,
                  contentType: false,
                  processData: false,
                  xhrFields: {
                  responseType: 'blob'
                  },
                  error: err => console.log(err),
                  success: function(resp) {
          
                    genDocFile = resp;
                    src= URL.createObjectURL(resp);
                    $('#pdfView').attr('src', src);
                  }
              });
    }
    else
    {
      e.stopPropagation();
      alert('Please Fill The Application with All Details');
    }
    });

    $("#submit_verify_pdf").click(function(){

    if($('#verify_pdf').prop('checked'))
    {
      $.ajax({
                  url: 'ajax-leave-application-update.php',
                  method: 'POST',
                  contentType: false,
                  processData: false,
                  data: form,
                  error: err => console.log(err),
                  success: function(resp) {

                    $('#pdfVerifyModal').modal('hide');
                    window.location = 'leave-application.php';
                  }
              });
    }
    else
    {
      alert('Please Verify Your Application');
    }

    });
});