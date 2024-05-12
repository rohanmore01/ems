$(document).ready(function() 
{
		var now;
		setInterval(function() {

			var time = new Date();

			now = time.toLocaleString('en-US', {
				hour: 'numeric',
				minute: 'numeric',
				second: 'numeric',
				hour12: true
			});
			$('#now').html(now)
		}, 500)

	//photo capture code using webcam
			
	Webcam.set({
        width: 320,
        height: 240,
        image_format: 'jpeg',
        jpeg_quality: 90
    });

	//for capture sound
	var shutter = new Audio();
	shutter.autoplay = false;
	shutter.src = 'shutter.mp3';


    $('.log_now').on('click', function() {
       
        Webcam.on('error', function() {
            $('#photoModal').modal('hide');
            swal({
                title: 'Warning',
                text: 'Please give permission to access your webcam',
                icon: 'warning'
            });

			$('.swal-button--confirm').on('click', function() {
				$('.closeModal').click();
			});
        });
        
		var eno = $('[name="eno"]').val()
		if (eno == '') 
		{
			alert("Please Enter Employee ID");
			location.reload();
		} 
		else 
		{ 
			$.ajax({
					url: 'check-employee-id-for-attendance.php',
					method: 'POST',
					data: {
						eno: $('[name="eno"]').val(),
					},
					error: err => console.log(err),
					success: function(resp) {

						resp = JSON.parse(resp)
						if(resp.status == 0)
						{
							$('.modal-content').addClass('d-none');
							$('[name="eno"]').val('')
							$('#log_display').html(resp.msg)
							$('.log_now').show()
							$('.loading').hide()
							setTimeout(function() {
								$('#log_display').html('')
							}, 5000)
							$('.attendanceDetailshow').addClass('d-none')
							window.setTimeout(function(){location.reload()},2000);
						}
						else
						{
							$('.modal-content').removeClass('d-none');
							Webcam.reset();
							Webcam.attach('#my_camera');
							$('.log_now').hide();
							$('.loading').show();
						}
					}
			});
		}
    });

    $('#takephoto').on('click', take_snapshot);

    $('#retakephoto').on('click', function() {
        $('#my_camera').addClass('d-block');
        $('#my_camera').removeClass('d-none');

        $('#results').addClass('d-none');

        $('#takephoto').addClass('d-block');
        $('#takephoto').removeClass('d-none');

        $('#retakephoto').addClass('d-none');
        $('#retakephoto').removeClass('d-block');

        $('#uploadphoto').addClass('d-none');
        $('#uploadphoto').removeClass('d-block');
    });

    $('#photoForm').on('submit', function(e) {

        e.preventDefault();
        $.ajax({
            url: 'mark-attendance-upload-photo.php',
            type: 'POST',
			data: {
					photo: $('#photoStore').val(),
					eno: $('[name="eno"]').val(),
				},
            success: function(resp) {
				
				if (typeof resp != undefined) 
				{
					resp = JSON.parse(resp);

					if (resp.status == 1) 
					{

						Webcam.reset();

						$('#my_camera').addClass('d-block');
						$('#my_camera').removeClass('d-none');

						$('#results').addClass('d-none');

						$('#takephoto').addClass('d-block');
						$('#takephoto').removeClass('d-none');

						$('#retakephoto').addClass('d-none');
						$('#retakephoto').removeClass('d-block');

						$('#uploadphoto').addClass('d-none');
						$('#uploadphoto').removeClass('d-block');

						swal({
							title: 'Success',
							text: 'Attendance Marked Successfully',
							icon: 'success',
							buttons: false,
							closeOnClickOutside: false,
							closeOnEsc: false,
							timer: 2000
						})

						$('[name="eno"]').val('')
						$('#log_display').html(resp.msg)
						$('.log_now').show()
						$('.loading').hide()
						setTimeout(function() {
							$('#log_display').html('')
						}, 5000)

						$('#my_camera').attr('style','');
						$('#exampleModalLabel').html('Your Attendance Information');
						$('#takephoto').addClass('d-none').removeClass('d-block');
						$('.attendanceDetailshow').removeClass('d-none')
						$('#name').html(resp.name);
						$('#emp_id').html(resp.emp_id)
						$('#in_time').html(resp.in_time)
						$('#out_time').html(resp.out_time)
						$('#total_duration').html(resp.total_duration)
						$('#photo_insert').attr('src','uploads/'+resp.photo);
					} 
					else if (resp.status == 0) 
					{
						$('[name="eno"]').val('')
						$('#log_display').html(resp.msg)
						$('.log_now').show()
						$('.loading').hide()
						setTimeout(function() {
							$('#log_display').html('')
						}, 5000)
						$('.attendanceDetailshow').addClass('d-none')
					}
					else if (resp.status == 2) 
					{
						swal({
								title: 'Warning',
								text: 'Attendance Mark Option Not Available Today',
								icon: 'warning'
							})					
						$('.log_now').show()
						$('.loading').hide()
					}
					else
					{
						swal({
								title: 'Error',
								text: 'Something went wrong',
								icon: 'error'
							})					
						$('.log_now').show()
						$('.loading').hide()
					}
				}
            }
        })
    })

function take_snapshot()
{
	shutter.play();
    //take snapshot and get image data
    Webcam.snap(function(data_uri) {		
        //display result image
        $('#results').html('<img src="' + data_uri + '" class="d-block mx-auto rounded"/>');

        var raw_image_data = data_uri.replace(/^data\:image\/\w+\;base64\,/, '');
        $('#photoStore').val(raw_image_data);
    });

    $('#my_camera').removeClass('d-block');
    $('#my_camera').addClass('d-none');

    $('#results').removeClass('d-none');

    $('#takephoto').removeClass('d-block');
    $('#takephoto').addClass('d-none');

    $('#retakephoto').removeClass('d-none');
    $('#retakephoto').addClass('d-block');

    $('#uploadphoto').removeClass('d-none');
    $('#uploadphoto').addClass('d-block');
}

$('.closeModal').click(function(e){
	location.reload();
});

});