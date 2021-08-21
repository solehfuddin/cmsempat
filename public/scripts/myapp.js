// Handle Form Login
$(document).ready(function() {
    $('.formLogin').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnLogin').prop('disabled', true);
                $('.btnLogin').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnLogin').prop('disabled', false);
                $('.btnLogin').html('Login');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.inputuser){
                        $('#inputuser').addClass('is-invalid');
                        $('.handlermail').html('');
                    }
                    else
                    {
                        $('#inputuser').removeClass('is-invalid');
                        $('.handlermail').html('<span class="input-group-text"><i class="icon-copy dw dw-user1"></i></span>');
                    }

                    if (response.error.password){
                        $('#password').addClass('is-invalid');
                        $('.handlerpass').html('');
                    }
                    else
                    {
                        $('#password').removeClass('is-invalid');
                        $('.handlerpass').html('<span class="input-group-text"><i class="dw dw-padlock1"></i></span>');
                    }

                    if (response.error.password)
                    {
                        Swal.fire(
                            'Pemberitahuan',
                            response.error.password,
                            'error',
                        );
                    }

                    if (response.error.inputuser)
                    {
                        Swal.fire(
                            'Pemberitahuan',
                            response.error.inputuser,
                            'error',
                        );
                    }

                    if (response.error.errorauth)
                    {
                        Swal.fire(
                            'Pemberitahuan',
                            response.error.errorauth,
                            'warning',
                        );
                    }
                }
                else
                {
                    window.location = response.success.link;
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    })
});

//Datatables article type
$(document).ready( function () {
    var url = '/article/ajax_list';
    var table = $('#datatable-article').DataTable({
		scrollCollapse: true,
		autoWidth: false,
		responsive: true,
        "serverSide": true,
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
        "ajax": {
            "url": BASE_URL + url,
            "type": "POST"
        },
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'  
			}
		},
		dom: 'Bfrtp',
		buttons: [
		'copy', 'csv', 'pdf', 'print'
		]
	});
});

//Datatables article type
$(document).ready( function () {
    var url = '/custom/ajax_list';
    var table = $('#datatable-custom').DataTable({
		scrollCollapse: true,
		autoWidth: false,
		responsive: true,
        "serverSide": true,
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
        "ajax": {
            "url": BASE_URL + url,
            "type": "POST"
        },
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'  
			}
		},
		dom: 'Bfrtp',
		buttons: [
		'copy', 'csv', 'pdf', 'print'
		]
	});
});

//Datatables article type
$(document).ready( function () {
    var url = '/testimoni/ajax_list';
    var table = $('#datatable-testi').DataTable({
		scrollCollapse: true,
		autoWidth: false,
		responsive: true,
        "serverSide": true,
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
        "ajax": {
            "url": BASE_URL + url,
            "type": "POST"
        },
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'  
			}
		},
		dom: 'Bfrtp',
		buttons: [
		'copy', 'csv', 'pdf', 'print'
		]
	});
});

//Datatables article type
$(document).ready( function () {
    var url = '/articletype/ajax_list';
    var table = $('#datatable-articletype').DataTable({
		scrollCollapse: true,
		autoWidth: false,
		responsive: true,
        "serverSide": true,
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
        "ajax": {
            "url": BASE_URL + url,
            "type": "POST"
        },
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'  
			}
		},
		dom: 'Bfrtp',
		buttons: [
		'copy', 'csv', 'pdf', 'print'
		]
	});
});

//Datatables faq
$(document).ready( function () {
    var url = '/faq/ajax_list';
    var table = $('#datatable-faq').DataTable({
		scrollCollapse: true,
		autoWidth: false,
		responsive: true,
        "serverSide": true,
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
        "ajax": {
            "url": BASE_URL + url,
            "type": "POST"
        },
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'  
			}
		},
		dom: 'Bfrtp',
		buttons: [
		'copy', 'csv', 'pdf', 'print'
		]
	});
});

//Datatables account
$(document).ready( function () {
    var url = '/account/ajax_list';
    var table = $('#datatable-uaccount').DataTable({
		scrollCollapse: true,
		autoWidth: false,
		responsive: true,
        "serverSide": true,
		columnDefs: [{
			targets: "datatable-nosort",
			orderable: false,
		}],
        "ajax": {
            "url": BASE_URL + url,
            "type": "POST"
        },
		"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		"language": {
			"info": "_START_-_END_ of _TOTAL_ entries",
			searchPlaceholder: "Search",
			paginate: {
				next: '<i class="ion-chevron-right"></i>',
				previous: '<i class="ion-chevron-left"></i>'  
			}
		},
		dom: 'Bfrtp',
		buttons: [
		'copy', 'csv', 'pdf', 'print'
		]
	});
});