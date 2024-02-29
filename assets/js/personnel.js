$(document).ready(function(){
    
    //DEPENDABLE DROPDOWN FOR LGA FROM STATE OF ORIGIN ONLOAD
	var stateId = $('#state').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { stateId: stateId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#lga').html(data);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
    
    
    
    //DEPENDABLE DROPDOWN FOR LGA FROM STATE OF ORIGIN ONLOAD
	var stateId2 = $('#state1').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { stateId: stateId2 },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#lga1').html(data);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );


	$('.reason-div').hide();
	$('.barracks-div').hide();
	$('.interdicted-div').hide();
	$('.unit-div').hide();
	$('.role-div').hide();
	$('.unitEmolument-div').hide();
	$('.unitUser-div').hide();
	$('.barrack_allocation_div').hide();
	setTimeout(function() {
    $('#auto-close').trigger('click');
}, 5000);
});


//TERMINAL SELECTOR BASE ON COMMAND

$('#command').change(function(){
	var commandId = $('#command').val();
    $.post('../personnel/backend.php', { commandId: commandId},function(data) //send id to updating page
	 {		
		$('#unit').html(data);

	 });

});



//DEPENDABLE DROPDOWN FOR LGA FROM STATE OF ORIGIN SELECTION
$('#state').change(function(){
	var stateId = $('#state').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { stateId: stateId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#lga').html(data);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
});





//DEPENDABLE DROPDOWN FOR LGA FROM STATE OF RESIDENCE SELECTION
$('#state1').change(function(){
	var stateId = $('#state1').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { stateId: stateId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#lga1').html(data);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
});



$('#svcModal').change(function(){
   var svcModal = $(this).val();
   	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { svcModal: svcModal},
            dataType: 'json',
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#rankModal').val(data.rank);
            	$('#initialsModal').val(data.initials);
            	$('#surnameModal').val(data.surname);
            	$('#firstNameModal').val(data.firstName);
            	$('#otherNameModal').val(data.otherName);
            	$('#genderModal').val(data.gender);
            	$('#phoneModal').val(data.phone);
            	$('#emailModal').val(data.email);
            	
            },
            timeout: 500000 // sets timeout to 3 seconds
        }
    );
   
});

//View Emolument Modal
$('.viewEmolument').click(function(){
   var emolID = $(this).attr('data-emolumentId');
   $('#emolId').val( emolID);
   	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { emolID: emolID},
            dataType: 'json',
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
                	
            	$('#modalRank').val(data.rank);
            	$('#modalInitials').val(data.initials);
            	$('#modalName').val(data.surname);
            	$('#modalSVN').val(data.svn);
            	$('#modalUnit').val(data.unit);
            	$('#modalStation').val(data.command);
            	$('#modalPhone').val(data.phone);
            	$('#modalEmail').val(data.email);
            	$('#modalQuartered').val(data.quartered);
            	$('#modalInterdicted').val(image);
            	$('#modalBank').val(data.bank);
            	$('#modalAccountNumber').val(data.account_number);
            	$('#modalPFA').val(data.pfa);
            	$('#modalRSApin').val(data.rsa_pin);
            	$('#modalStatus').val(data.emolument_status);
            	var imageAlt = 'Passport';
                if (data.emolumentImage) {
                    var imageElement = $("<img>");
                    var image = 'passports/'.data.emolumentImage;
                    imageElement.attr("src", image);
                    imageElement.attr("alt", imageAlt);
                    $("#image-container").html(imageElement);
                } else {
                    console.error('Invalid image URL:', data.emolumentImage);
                    // Optionally, you can display an error message or handle this case accordingly.
                }
                            	
            },
            timeout: 500000 // sets timeout to 3 seconds
        }
    );
   
});


//Terminate Emolument Period
$('.viewScheduleEmolument').click(function(){
   var emolumentTerminationId = $(this).attr('data-endEmolument');
   $('#emolumentTerminationId').val( emolumentTerminationId);
});


//LOAD BARRACK ID TO NEW BARACK UNIT MODAL
$('.barrackId').click(function(){
   var barrackId = $(this).attr('data-barrackId');
   var barrackName = $(this).attr('data-barrackName');
   $('#barrackId').val(barrackId);
   $('.barrackName').html(barrackName);
});

//Edit Emolument Period
$('.viewScheduleEmolument').click(function(){
   var editEmolumentId = $(this).attr('data-editEmolument');
   $('#editEmolumentId').val(editEmolumentId);
});

//Reject Single Officer Emolument
$('.rejectEmolument').click(function(){
   var rejectId = $(this).attr('data-emolumentId2');
   $('#rejectId').val(rejectId);
});


//View Emolument Modal
$('.editEmolumentDate').click(function(){
        var editEmolId = $(this).attr('data-modifySchedule');
        $('#editEmolumentId').val(editEmolId);
   
   	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { editEmolId: editEmolId},
            dataType: 'json',
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
                	
            	$('#editStartDate').val(data.start_date);
            	$('#editEndDate').val(data.end_date);
                            	
            },
            timeout: 500000 // sets timeout to 3 seconds
        }
    );
   
});


//Load Officer Postings to Table on Modal
$('.officerId').click(function(){
   var officerId = $(this).attr('data-officerId');
   $('#officerID').attr('value', officerId);
   	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { officerId: officerId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
                //alert ('Try Again');
            	$('.tbl').html(data);
            	//$('.stockListDiv').hide();
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );

});


//USER UPDATE

$('#barracks').change(function(){
	var barracks = $('#barracks').val();
	if (barracks == "YES") {
		$('.barracks-div').show();
		$('#dateQuartered').removeAttr('disabled');
		
	}else{
		
		$('#dateQuartered').removeAttr('required');
		$('#dateQuartered').attr('disabled', 'disabled');
		$('.barracks-div').hide();
	}
});


//Barracks & Interdicted Selector

$('#userRole').change(function(){
	var userRole = $('#userRole').val();
	if (userRole != "Officer") {
		$('.role-div').show();
		$('#roleCommand').removeAttr('disabled');
		$('#roleCommand').removeAttr('required');
		
		$('.unitUser-div').show();
		$('#unitUser').removeAttr('disabled');
		$('#unitUser').removeAttr('required');
		
	}else{
		
		$('#roleCommand').removeAttr('required');
		$('#roleCommand').attr('disabled', 'disabled');
		$('.role-div').hide();
		
		$('#unitUser').removeAttr('required');
		$('#unitUser').attr('disabled', 'disabled');
		$('.unitUser-div').hide();
	}
});

//Picture Source Selector
$('#source').change(function(){
	var source = $('#source').val();
	if (source == "Upload") {
		$('.passport-div').show();
		$('.photograph-div').hide();
	}else{
		$('.passport-div').hide();
		$('.photograph-div').show();
	}
});

//Command Selector

$('#commandPost').change(function(){
	var command = $('#commandPost').val();
	if (command == "1") {
		$('.unit-div').show();
		$('#unit').removeAttr('disabled');
		$('#unit').attr('required', 'required');
	}else{
		$('#unit').attr('disabled', 'disabled');
		$('#unit').removeAttr('required');
		$('.unit-div').hide();
	}
});


$('#commandPostEmolument').change(function(){
	var command = $('#commandPostEmolument').val();
	if (command == "1") {
		$('.unitEmolument-div').show();
		$('#unitEmolument').removeAttr('disabled');
		$('#unitEmolument').attr('required', 'required');
	}else{
		$('#unitEmolument').attr('disabled', 'disabled');
		$('#unitEmolument').removeAttr('required');
		$('.unitEmolument-div').hide();
	}
});

$('#interdicted').change(function(){
	var interdicted = $('#interdicted').val();
	if (interdicted == "YES") {
		$('.interdicted-div').show();
		$('#dateInterdicted').removeAttr('disabled');
	}else{
		
		$('#dateInterdicted').removeAttr('required');
		$('#dateInterdicted').attr('disabled', 'disabled');
		$('.interdicted-div').hide();
	}
});


//DEPENDABLE DROPDOWN FOR UNITS FROM COMMAND SELECTION
$('#commandPost').change(function(){
	var commId = $('#commandPost').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { commId: commId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#unit').html(data);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
});


//DEPENDABLE DROPDOWN FOR UNITS FROM COMMAND SELECTION FROM USER RECORD UPDATE
$('#roleCommand').change(function(){
	var commId = $('#roleCommand').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { commId: commId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#unitUser').html(data);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
});

//DEPENDABLE DROPDOWN FOR UNITS FROM COMMAND SELECTION
$('#commandPostEmolument').change(function(){
	var commId = $('#commandPostEmolument').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { commId: commId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#unitEmolument').html(data);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
});


//DEPENDABLE DROPDOWN FOR DESIGNATION FROM DEPARTMENT SELECTION
$('#department').change(function(){
	var departmentId = $('#department').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { departmentId: departmentId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#designation').html(data);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
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


//DEPENDABLE DROPDOWN FOR BARRACK UNIT FROM BARRACK SELECTION
$('#barrackNameSelect').change(function(){
	var barrackAllocationId = $('#barrackNameSelect').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { barrackAllocationId: barrackAllocationId },
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#barrackUnitSelect').html(data);
            	$('.barrack_allocation_div').hide();
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
});


//LOAD BARRACK AND UNIT INFORMATION TO NEW ALLOCATION MODAL
$('#barrackUnitSelect').change(function(){
	var barrackUnitSelectId = $('#barrackUnitSelect').val();
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { barrackUnitSelectId: barrackUnitSelectId },
            dataType: 'json',
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#barrackCode').val(data.barrack_code);
            	$('#barrackCategory').val(data.category);
            	$('#barrackUnitName').val(data.unit_name);
            	$('#barrackUnitCode').val(data.unit_code);
            	$('#barrackUnitStatus').val(data.unit_status);
            	$('#barrackAllocationStatus').val(data.allocation_status);
            	$('#barrackState').val(data.barrack_state);
            	$('#barrackLGA').val(data.barrack_lga);
            	$('#barrackAddress').val(data.address);
            	$('.barrack_allocation_div').show();
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
});


//LOAD BARRACK UNIT IMAGES MODAL
$('.barrackImageId').click(function(){
 var barrackImageId = $(this).attr('data-barrackUnitImageId');
 
	$.ajax({
            type: 'POST',
            url: 'backend.php',
            data: { barrackImageId: barrackImageId },
            dataType: 'json',
            error: function(){
		        // will fire when timeout is reached
		        alert('Timeout: Please check your internet connection');
		    },
            success: function (data) {
            	$('#image1').attr('src', '../barrackImages/' + data.image3);
            	$('.imageTitle1').html(data.imageTitle1);
            	$('#image2').attr('src', '../barrackImages/' + data.image2);
            	$('.imageTitle2').html(data.imageTitle2);
            	$('#image3').attr('src', '../barrackImages/' + data.image1);
            	$('.imageTitle3').html(data.imageTitle3);
            	$('#image4').attr('hrsrcef', 'barrackImages/' + data.image4);
            	$('.imageTitle4').html(data.imageTitle4);
            	$('#image5').attr('src', '../barrackImages/' + data.image5);
            	$('.imageTitle5').html(data.imageTitle5);
            	$('.image6').attr('src', '../barrackImages/' + data.image6);
            	$('.imageTitle6').html(data.imageTitle6);
            	$('.image7').attr('src', '../barrackImages/' + data.image7);
            	$('.imageTitle7').html(data.imageTitle7);
            	$('.image8').attr('src', '../barrackImages/' + data.image8);
            	$('.imageTitle8').html(data.imageTitle8);
            },
            timeout: 50000 // sets timeout to 3 seconds
        }
    );
});