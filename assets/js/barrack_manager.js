$(document).ready(function(){

	setTimeout(function() {
    $('#auto-close').trigger('click');
}, 5000);
});

document.getElementById("barrackUnitImage").addEventListener("change", function () {
    const fileInput = this;
    const previewImage = document.getElementById("imagePreview");

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            previewImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    } else {
        previewImage.src = ""; // Clear the preview if no file is selected
    }
});

//LOAD BARRACK ID TO  BARACK UNIT IMAGE MODAL
$('.barrackUnitImageID').click(function(){
   var barrackUnitImageID = $(this).attr('data-barrackId');
   var barrackUnitImageCode = $(this).attr('data-barrackCode');
   $('#barrackUnitImageID').val(barrackUnitImageID);
   $('#barrackUnitImageCode').val(barrackUnitImageCode);
});


//LOAD BARRACK ID TO NEW BARACK UNIT MODAL
$('.barrackId').click(function(){
   var barrackId = $(this).attr('data-barrackId');
   var barrackName = $(this).attr('data-barrackName');
   $('#barrackId').val(barrackId);
   $('.barrackName').html(barrackName);
});



//DEPENDABLE DROPDOWN FOR BARRACK LGA FROM BARRACK STATE OF ORIGIN
$('#barrackState').change(function(){
	var barrackstateId = $('#barrackState').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { stateId: barrackstateId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#barrackLGA').html(data);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
});