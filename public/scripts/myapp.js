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

//Datatables article
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

//Datatables custom
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

//Datatables testimoni
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

//Fungsi generate account
function generatekodeuaccount() {
  var url = "/account/getdata";
  $.ajax({
      url: BASE_URL + url,
      dataType: "JSON",
      success: function(response) {
          $('#account_kode').val(response.kodegen);
      },
      error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
  });
}

//Fungsi generate kode tipe artikel
function generatekodearticletype() {
  var url = "/articletype/getdata";
  $.ajax({
      url: BASE_URL + url,
      dataType: "JSON",
      success: function(response) {
          $('#articletype_kode').val(response.kodegen);
      },
      error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
  });
}

//Fungsi generate kode testimoni
function generatekodetestimoni() {
  var url = "/testimoni/getdata";
  $.ajax({
      url: BASE_URL + url,
      dataType: "JSON",
      success: function(response) {
          $('#testimoni_kode').val(response.kodegen);
      },
      error: function(xhr, ajaxOptions, thrownError) {
          alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
      }
  });
}

//Fungsi modal add account
$(document).ready(function() {
  $('.formModaltambahaccount').submit(function(e) {
      e.preventDefault();

      var data = new FormData(this);

      $.ajax({
          type: "post",
          url: $(this).attr('action'),
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          data: data,
          dataType: "json",
          beforeSend: function() {
              $('.btnmodaltambahaccount').prop('disabled', true);
              $('.btnmodaltambahaccount').html('<i class="fa fa-spin fa-spinner"></i> Processing');
          },
          complete: function() {
              $('.btnmodaltambahaccount').prop('disabled', false);
              $('.btnmodaltambahaccount').html('Simpan');
          },
          success: function(response) {
              if (response.error){
                  if (response.error.account_kode){
                      $('#account_kode').addClass('is-invalid');
                      $('.errorAccountKode').html(response.error.account_kode);
                  }
                  else
                  {
                      $('#account_kode').removeClass('is-invalid');
                      $('.errorAccountKode').html('');
                  }

                  if (response.error.account_nama){
                      $('#account_nama').addClass('is-invalid');
                      $('.errorAccountNama').html(response.error.account_nama);
                  }
                  else
                  {
                      $('#account_nama').removeClass('is-invalid');
                      $('.errorAccountNama').html('');
                  }
				  
				  if (response.error.account_email){
                      $('#account_email').addClass('is-invalid');
                      $('.errorAccountEmail').html(response.error.account_email);
                  }
                  else
                  {
                      $('#account_email').removeClass('is-invalid');
                      $('.errorAccountEmail').html('');
                  }
				  
				  if (response.error.account_password){
                      $('#account_password').addClass('is-invalid');
                      $('.errorAccountPassword').html(response.error.account_password);
                  }
                  else
                  {
                      $('#account_password').removeClass('is-invalid');
                      $('.errorAccountPassword').html('');
                  }
              }
              else
              {
                  $('#modaltambahuaccount').modal('hide');

                  Swal.fire(
                      'Pemberitahuan',
                      response.success.data,
                      'success',
                  ).then(function() {
                      $('#account_nama').val('');
					  $('#account_email').val('');
					  $('#account_password').val('');
                      $('#datatable-uaccount').DataTable().ajax.reload();
                  });
              }
          },
          error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }
      });
  });
});

//Fungsi modal add data tipe artikel
$(document).ready(function() {
  $('.formModaltambaharticletype').submit(function(e) {
      e.preventDefault();

      var data = new FormData(this);

      $.ajax({
          type: "post",
          url: $(this).attr('action'),
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          data: data,
          dataType: "json",
          beforeSend: function() {
              $('.btnmodaltambaharticletype').prop('disabled', true);
              $('.btnmodaltambaharticletype').html('<i class="fa fa-spin fa-spinner"></i> Processing');
          },
          complete: function() {
              $('.btnmodaltambaharticletype').prop('disabled', false);
              $('.btnmodaltambaharticletype').html('Simpan');
          },
          success: function(response) {
              if (response.error){
                  if (response.error.articletype_kode){
                      $('#articletype_kode').addClass('is-invalid');
                      $('.errorArticletypeKode').html(response.error.articletype_kode);
                  }
                  else
                  {
                      $('#articletype_kode').removeClass('is-invalid');
                      $('.errorArticletypeKode').html('');
                  }

                  if (response.error.articletype_judul){
                      $('#articletype_judul').addClass('is-invalid');
                      $('.errorArticletypeJudul').html(response.error.articletype_judul);
                  }
                  else
                  {
                      $('#articletype_judul').removeClass('is-invalid');
                      $('.errorArticletypeJudul').html('');
                  }
              }
              else
              {
                  $('#modaltambaharticletype').modal('hide');

                  Swal.fire(
                      'Pemberitahuan',
                      response.success.data,
                      'success',
                  ).then(function() {
                      $('#articletype_judul').val('');
                      $('#datatable-articletype').DataTable().ajax.reload();
                  });
              }
          },
          error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }
      });
  });
});

//Fungsi modal add testimoni
$(document).ready(function() {
  $('.formModaltambahtestimoni').submit(function(e) {
      e.preventDefault();

      var data = new FormData(this);

      $.ajax({
          type: "post",
          url: $(this).attr('action'),
          enctype: 'multipart/form-data',
          processData: false,
          contentType: false,
          cache: false,
          data: data,
          dataType: "json",
          beforeSend: function() {
              $('.btnmodaltambahtestimoni').prop('disabled', true);
              $('.btnmodaltambahtestimoni').html('<i class="fa fa-spin fa-spinner"></i> Processing');
          },
          complete: function() {
              $('.btnmodaltambahtestimoni').prop('disabled', false);
              $('.btnmodaltambahtestimoni').html('Simpan');
          },
          success: function(response) {
              if (response.error){
                  if (response.error.testimoni_kode){
                      $('#testimoni_kode').addClass('is-invalid');
                      $('.errorTestimoniKode').html(response.error.testimoni_kode);
                  }
                  else
                  {
                      $('#testimoni_kode').removeClass('is-invalid');
                      $('.errorTestimoniKode').html('');
                  }

                  if (response.error.testimoni_nama){
                      $('#testimoni_nama').addClass('is-invalid');
                      $('.errorTestimoniNama').html(response.error.testimoni_nama);
                  }
                  else
                  {
                      $('#testimoni_nama').removeClass('is-invalid');
                      $('.errorTestimoniNama').html('');
                  }
				  
				  if (response.error.testimoni_company){
                      $('#testimoni_company').addClass('is-invalid');
                      $('.errorTestimoniCompany').html(response.error.testimoni_company);
                  }
                  else
                  {
                      $('#testimoni_company').removeClass('is-invalid');
                      $('.errorTestimoniCompany').html('');
                  }
				  
				  if (response.error.testimoni_position){
                      $('#testimoni_position').addClass('is-invalid');
                      $('.errorTestimoniPosition').html(response.error.testimoni_position);
                  }
                  else
                  {
                      $('#testimoni_position').removeClass('is-invalid');
                      $('.errorTestimoniPosition').html('');
                  }
				  
				  if (response.error.testimoni_content){
                      $('#testimoni_content').addClass('is-invalid');
                      $('.errorTestimoniContent').html(response.error.testimoni_content);
                  }
                  else
                  {
                      $('#testimoni_content').removeClass('is-invalid');
                      $('.errorTestimoniContent').html('');
                  }
				  
				  if (response.error.testimoni_image){
                      $('#testimoni_image').addClass('is-invalid');
                      $('.errorTestimoniImage').html(response.error.testimoni_image);
                  }
                  else
                  {
                      $('#testimoni_image').removeClass('is-invalid');
                      $('.errorTestimoniImage').html('');
                  }
              }
              else
              {
                  $('#modaltambahtestimoni').modal('hide');

                  Swal.fire(
                      'Pemberitahuan',
                      response.success.data,
                      'success',
                  ).then(function() {
                      $('#testimoni_kode').val('');
					  $('#testimoni_nama').val('');
					  $('#testimoni_company').val('');
					  $('#testimoni_position').val('');
					  $('#testimoni_content').val('');
                      $('#datatable-testi').DataTable().ajax.reload();
                  });
              }
          },
          error: function(xhr, ajaxOptions, thrownError) {
              alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
          }
      });
  });
});

//Fungsi select tipe artikel
function editaccount($kode) {
    var url = "/account/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#account_kodeubah').val(response.success.kode);
            $('#account_namaubah').val(response.success.nama);
			$('#account_emailubah').val(response.success.email);
			$('#account_levelubah').val(response.success.level);

            $('#account_namaubah').removeClass('is-invalid');
            $('.errorAccountNamaubah').html('');
			
			$('#account_emailubah').removeClass('is-invalid');
            $('.errorAccountEmail').html('');

            $('#modalubahuaccount').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi select tipe artikel
function editarticletype($kode) {
    var url = "/articletype/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#articletype_kodeubah').val(response.success.kode);
            $('#articletype_judulubah').val(response.success.judul);

            $('#articletype_judulubah').removeClass('is-invalid');
            $('.errorArticletypeJudulubah').html('');

            $('#modalubaharticletype').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi select tipe artikel
function edittestimoni($kode) {
    var url = "/testimoni/pilihdata";
    $.ajax({
        url: BASE_URL + url,
        type: "post",
        data: {
            kode: $kode,
        },
        dataType: "JSON",
        success: function(response) {
            $('#testimoni_kodeubah').val(response.success.kode);
            $('#testimoni_namaubah').val(response.success.nama);
			$('#testimoni_companyubah').val(response.success.perusahaan);
			$('#testimoni_positionubah').val(response.success.jabatan);
			$('#testimoni_contentubah').val(response.success.testimoni);
			 $('#testimoni_recentimg').attr("src", response.success.image);

            $('#testimoni_namaubah').removeClass('is-invalid');
            $('.errorTestimoniNamaubah').html('');
			
			$('#testimoni_companyubah').removeClass('is-invalid');
            $('.errorTestimoniCompanyubah').html('');
			
			$('#testimoni_positionubah').removeClass('is-invalid');
            $('.errorTestimoniPositionubah').html('');
			
			$('#testimoni_contentubah').removeClass('is-invalid');
            $('.errorTestimoniContentubah').html('');
			
			$('#testimoni_imageubah').removeClass('is-invalid');
            $('.errorTestimoniImageubah').html('');

            $('#modalubahtestimoni').modal('show');
        },
        error: function(xhr, ajaxOptions, thrownError) {
            alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
        }
    });
}

//Fungsi update tipe artikel
$(document).ready(function() {
    $('.formModalubaharticletype').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubaharticletype').prop('disabled', true);
                $('.btnmodalubaharticletype').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubaharticletype').prop('disabled', false);
                $('.btnmodalubaharticletype').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.articletype_judulubah){
                        $('#articletype_judulubah').addClass('is-invalid');
                        $('.errorArticletypeJudulubah').html(response.error.articletype_judulubah);
                    }
                    else
                    {
                        $('#articletype_judulubah').removeClass('is-invalid');
                        $('.errorArticletypeJudulubah').html('');
                    }
                }
                else
                {
                    $('#modalubaharticletype').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-articletype').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});

//Fungsi update account
$(document).ready(function() {
    $('.formModalubahaccount').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahaccount').prop('disabled', true);
                $('.btnmodalubahaccount').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahaccount').prop('disabled', false);
                $('.btnmodalubahaccount').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.account_namaubah){
                        $('#account_namaubah').addClass('is-invalid');
                        $('.errorAccountNamaubah').html(response.error.account_namaubah);
                    }
                    else
                    {
                        $('#account_namaubah').removeClass('is-invalid');
                        $('.errorAccountNamaubah').html('');
                    }
					
					if (response.error.account_emailubah){
                        $('#account_emailubah').addClass('is-invalid');
                        $('.errorAccountEmailubah').html(response.error.account_emailubah);
                    }
                    else
                    {
                        $('#account_emailubah').removeClass('is-invalid');
                        $('.errorAccountEmailubah').html('');
                    }
                }
                else
                {
                    $('#modalubahuaccount').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        $('#datatable-uaccount').DataTable().ajax.reload();
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});

//Fungsi update info profile
$(document).ready(function() {
    $('.formUpdateProfil').submit(function(e) {
        e.preventDefault();

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: "json",
            beforeSend: function() {
                $('.btnubahprofile').prop('disabled', true);
                $('.btnubahprofile').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnubahprofile').prop('disabled', false);
                $('.btnubahprofile').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.profile_nama){
                        $('#profile_nama').addClass('is-invalid');
                        $('.errorProfileNama').html(response.error.profile_nama);
                    }
                    else
                    {
                        $('#profile_nama').removeClass('is-invalid');
                        $('.errorProfileNama').html('');
                    }
					
					if (response.error.profile_email){
                        $('#profile_email').addClass('is-invalid');
                        $('.errorProfileEmail').html(response.error.profile_email);
                    }
                    else
                    {
                        $('#profile_email').removeClass('is-invalid');
                        $('.errorProfileEmail').html('');
                    }
					
					if (response.error.profile_newpass){
                        $('#profile_newpass').addClass('is-invalid');
                        $('.errorProfileNewPass').html(response.error.profile_newpass);
                    }
                    else
                    {
                        $('#profile_newpass').removeClass('is-invalid');
                        $('.errorProfileNewPass').html('');
                    }
					
					if (response.error.profile_confirmpass){
                        $('#profile_confirmpass').addClass('is-invalid');
                        $('.errorProfileConfirmPass').html(response.error.profile_confirmpass);
                    }
                    else
                    {
                        $('#profile_confirmpass').removeClass('is-invalid');
                        $('.errorProfileConfirmPass').html('');
                    }
                }
                else
                {
                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        window.location = response.success.link;
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});

//Fungsi update testimoni
$(document).ready(function() {
    $('.formModalubahtestimoni').submit(function(e) {
        e.preventDefault();
		
		var data = new FormData(this);

        $.ajax({
            type: "post",
            url: $(this).attr('action'),
			enctype: 'multipart/form-data',
			processData: false,
			contentType: false,
			cache: false,
			data: data,
			dataType: "json",
            beforeSend: function() {
                $('.btnmodalubahtestimoni').prop('disabled', true);
                $('.btnmodalubahtestimoni').html('<i class="fa fa-spin fa-spinner"></i> Processing');
            },
            complete: function() {
                $('.btnmodalubahtestimoni').prop('disabled', false);
                $('.btnmodalubahtestimoni').html('Ubah');
            },
            success: function(response) {
                if (response.error){
                    if (response.error.testimoni_namaubah){
                        $('#testimoni_namaubah').addClass('is-invalid');
                        $('.errorTestimoniNamaubah').html(response.error.testimoni_namaubah);
                    }
                    else
                    {
                        $('#testimoni_namaubah').removeClass('is-invalid');
                        $('.errorTestimoniNamaubah').html('');
                    }
					
					if (response.error.testimoni_companyubah){
                        $('#testimoni_companyubah').addClass('is-invalid');
                        $('.errorTestimoniCompanyubah').html(response.error.testimoni_companyubah);
                    }
                    else
                    {
                        $('#testimoni_companyubah').removeClass('is-invalid');
                        $('.errorTestimoniCompanyubah').html('');
                    }
					
					if (response.error.testimoni_positionubah){
                        $('#testimoni_positionubah').addClass('is-invalid');
                        $('.errorTestimoniPositionubah').html(response.error.testimoni_positionubah);
                    }
                    else
                    {
                        $('#testimoni_positionubah').removeClass('is-invalid');
                        $('.errorTestimoniPositionubah').html('');
                    }
					
					if (response.error.testimoni_contentubah){
                        $('#testimoni_contentubah').addClass('is-invalid');
                        $('.errorTestimoniContentubah').html(response.error.testimoni_contentubah);
                    }
                    else
                    {
                        $('#testimoni_contentubah').removeClass('is-invalid');
                        $('.errorTestimoniContentubah').html('');
                    }
					
					if (response.error.testimoni_imageubah){
                        $('#testimoni_imageubah').addClass('is-invalid');
                        $('.errorTestimoniImageubah').html(response.error.testimoni_imageubah);
                    }
                    else
                    {
                        $('#testimoni_imageubah').removeClass('is-invalid');
                        $('.errorTestimoniImageubah').html('');
                    }
                }
                else
                {
                    $('#modalubahtestimoni').modal('hide');

                    Swal.fire(
                        'Pemberitahuan',
                        response.success.data,
                        'success',
                    ).then(function() {
                        //$('#datatable-testi').DataTable().ajax.reload();
						window.location = response.success.link;
                    });
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
            }
        });

        return false;
    });
});

//Fungsi delete tipe artikel
function deletearticletype($kode) {
  Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'Data akan terhapus permanen dari sistem',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
  }).then(function(result) {
      if (result.value)
      {
          var url =  '/articletype/hapusdata';

          $.ajax({
              type: "post",
              url: BASE_URL + url,
              data: {
                  kode: $kode,
              },
              dataType: "json",
              success: function(response) {
                  if (response.success){
                      Swal.fire(
                          'Pemberitahuan',
                          response.success.data,
                          'success',
                      ).then(function() {
                          $('#datatable-articletype').DataTable().ajax.reload();
                      });
                  }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
              }
          });
      }
      else if (result.dismiss == 'batal')
      {
          swal.dismiss();
      }
  });
}

//Fungsi delete account
function deleteaccount($kode) {
  Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'Data akan terhapus permanen dari sistem',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
  }).then(function(result) {
      if (result.value)
      {
          var url =  '/account/hapusdata';

          $.ajax({
              type: "post",
              url: BASE_URL + url,
              data: {
                  kode: $kode,
              },
              dataType: "json",
              success: function(response) {
                  if (response.success){
                      Swal.fire(
                          'Pemberitahuan',
                          response.success.data,
                          'success',
                      ).then(function() {
                          $('#datatable-uaccount').DataTable().ajax.reload();
                      });
                  }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
              }
          });
      }
      else if (result.dismiss == 'batal')
      {
          swal.dismiss();
      }
  });
}

//Fungsi delete account
function deletetestimoni($kode) {
  Swal.fire({
      title: 'Apakah anda yakin?',
      text: 'Data akan terhapus permanen dari sistem',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Hapus',
      cancelButtonText: 'Batal'
  }).then(function(result) {
      if (result.value)
      {
          var url =  '/testimoni/hapusdata';

          $.ajax({
              type: "post",
              url: BASE_URL + url,
              data: {
                  kode: $kode,
              },
              dataType: "json",
              success: function(response) {
                  if (response.success){
                      Swal.fire(
                          'Pemberitahuan',
                          response.success.data,
                          'success',
                      ).then(function() {
                          $('#datatable-testi').DataTable().ajax.reload();
                      });
                  }
              },
              error: function(xhr, ajaxOptions, thrownError) {
                  alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError);
              }
          });
      }
      else if (result.dismiss == 'batal')
      {
          swal.dismiss();
      }
  });
}