<script type="text/javascript">
	// DOMContentLoaded function
	document.addEventListener("DOMContentLoaded", () => {
		load_data();
	});

	// jQuery document ready function
	$(() => {
		load_data();
	});

	// JS XMLHttpRequest

	/*const serialize = (obj, prefix) => {
	  var str = [], p;
	  for (p in obj) {
	    if (obj.hasOwnProperty(p)) {
	      var k = prefix ? prefix + "[" + p + "]" : p, v = obj[p];
	      str.push((v !== null && typeof v === "object") ? serialize(v, k) : encodeURIComponent(k) + "=" + encodeURIComponent(v));
	    }
	  }
	  return str.join("&");
	}*/

	/*const load_data = () => {
	    let xhr = new XMLHttpRequest();
	    let url = "../../process/admin/admin-accounts_processor.php", type = "POST";
	    var data = serialize({
	      method: 'fetch_data',
	      id: id,
	      search: i_search,
	      c: loader_count
	    });
	    xhr.onreadystatechange = () => {
	      if (xhr.readyState === XMLHttpRequest.DONE) {
	        let response = xhr.responseText;
	        if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)) {
	          console.log(response);
	        } else {
	          console.log(xhr);
	          swal('System Error', `Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${url}, method: ${type} ( HTTP ${xhr.status} - ${xhr.statusText} ) Press F12 to see Console Log for more info.`, 'error');
	        }
	      }
	    };
	    xhr.open(type, url, true);
	    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	    xhr.send(data);
	}*/

	/*const upload_csv = () => {
	  var file_form = document.getElementById('file_form');
	  var form_data = new FormData(file_form);
	  let xhr = new XMLHttpRequest();
	  let url = "../../process/import/import_kanban_reg.php", type = "POST";
	  swal('Upload CSV', 'Loading please wait...', {
	    buttons: false,
	    closeOnClickOutside: false,
	    closeOnEsc: false,
	  });
	  xhr.onreadystatechange = () => {
	    if (xhr.readyState === XMLHttpRequest.DONE) {
	      let response = xhr.responseText;
	      if (xhr.readyState == 4 && (xhr.status >= 200 && xhr.status < 400)) {
	        setTimeout(() => {
	          swal.close();
	          if (response != '') {
	            swal('Upload CSV', `Error: ${response}`, 'error');
	          } else {
	            swal('Upload CSV', 'Uploaded and updated successfully', 'success');
	            load_data(1);
	            $('#UploadCsvModal').modal('hide');
	          }
	        }, 500);
	      } else {
	        console.log(xhr);
	        swal('System Error', `Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${url}, method: ${type} ( HTTP ${xhr.status} - ${xhr.statusText} ) Press F12 to see Console Log for more info.`, 'error');
	      }
	    }
	  };
	  xhr.open(type, url, true);
	  xhr.send(form_data);
	}*/

	// AJAX JQuery

	const load_data = () => {
	    $.ajax({
	      url: '../../process/admin/admin-accounts_processor.php',
	      type: 'POST',
	      cache: false,
	      data: {
	        method: 'fetch_data',
	        id: id,
	        search: i_search,
	        c: loader_count
	      }, 
	      beforeSend: (jqXHR, settings) => {
	        jqXHR.url = settings.url;
	        jqXHR.type = settings.type;
	      }, 
	      success: response => {
	      	console.log(response);
	      }
	    })
	    .fail((jqXHR, textStatus, errorThrown) => {
	      console.log(jqXHR);
	      swal('System Error', `Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} ) Press F12 to see Console Log for more info.`, 'error');
	    });
	}

	const upload_csv = () => {
	  var form_data = new FormData();
	  var ins = document.getElementById('file').files.length;
	  for (var x = 0; x < ins; x++) {
	    form_data.append("file", document.getElementById('file').files[x]);
	  }
	  $.ajax({
	    url: '../../process/import/import_kanban_reg.php',
	    type: 'POST',
	    dataType: 'text',
	    cache: false,
	    contentType: false,
	    processData: false,
	    data: form_data,
	    beforeSend: (jqXHR, settings) => {
	      swal('Upload CSV', 'Loading please wait...', {
	        buttons: false,
	        closeOnClickOutside: false,
	        closeOnEsc: false,
	      });
	      jqXHR.url = settings.url;
	      jqXHR.type = settings.type;
	    }, 
	    success: response => {
	      setTimeout(() => {
	        swal.close();
	        if (response != '') {
	          swal('Upload CSV', `Error: ${response}`, 'error');
	        } else {
	          swal('Upload CSV', 'Uploaded and updated successfully', 'success');
	          load_data(1);
	          $('#UploadCsvModal').modal('hide');
	        }
	      }, 500);
	    }
	  })
	  .fail((jqXHR, textStatus, errorThrown) => {
	    console.log(jqXHR);
	    swal('System Error', `Call IT Personnel Immediately!!! They will fix it right away. Error: url: ${jqXHR.url}, method: ${jqXHR.type} ( HTTP ${jqXHR.status} - ${jqXHR.statusText} ) Press F12 to see Console Log for more info.`, 'error');
	  });
	}
	
	$('#UploadCsvModal').modal('hide');
	$('#UploadCsvModal').modal('show');

	$("#UploadCsvModal").on('show.bs.modal', e => {
	  $('#file').val('');
	});
	$("#UploadCsvModal").on('shown.bs.modal', e => {
	  $('#file').val('');
	});

	$("#UploadCsvModal").on('hide.bs.modal', e => {
	  $('#file').val('');
	});
	$("#UploadCsvModal").on('hidden.bs.modal', e => {
	  $('#file').val('');
	});

	// JS DOM Events
	document.getElementById("h1").addEventListener("keyup", e => {
	  if (e.which === 13) {
	    e.preventDefault();
	    load_data();
	  }
	});

	// JQuery DOM Events
	$('#h1').on("keyup", e => {
	  if (e.which === 13) {
	    e.preventDefault();
	    load_data();
	  }
	});

	// GET ELEMENT

	// By ID innerHTML
	var myHeading = document.querySelector("#h1").innerHTML;
	var myHeading = document.getElementById("h1").innerHTML;
	var myHeading = $('#h1').html(); //Jquery

	// By ID value
	var myHeading = document.querySelector("#h1").value;
	var myHeading = document.getElementById("h1").value;
	var myHeading = $('#h1').val(); //Jquery

	// By ID attribute
	var myHeading = document.querySelector("#h1").getAttribute("maxlength");
	var myHeading = document.getElementById("#h1").getAttribute("maxlength");
	var myHeading = $('#h1').attr("maxlength"); //Jquery

	// By ID data attribute
	var myHeading = document.getElementById("#h1").dataset.test;
	var myHeading = $('#h1').data("h1"); //Jquery

	// By Class Name
	var myHeading = document.querySelector(".h1");
	var myHeading = document.getElementsByClassName("h1");
	var myHeading = $('.h1'); //Jquery

	// By Tag Name
	var myHeading = document.querySelector("h1");
	var myHeading = document.getElementsByTagName("h1");
	var myHeading = $('h1'); //Jquery

	// By Name
	var myHeading = document.getElementsByName("h1");


	// SET ELEMENT

	// By ID innerHTML
	document.querySelector("#h1").innerHTML = 'Name<h2></h2>';
	document.getElementById("h1").innerHTML = 'Name<h2></h2>';
	$('#h1').html('Name<h2></h2>'); //Jquery

	// By ID value
	document.querySelector("#h1").value = 'TEST';
	document.getElementById("h1").value = 'TEST';
	$('#h1').val('TEST'); //Jquery

	// By ID attribute
	document.querySelector("#h1").setAttribute("maxlength", "255");
	document.getElementById("#h1").setAttribute("maxlength", "255");
	$('#h1').attr("maxlength", "255"); //Jquery

	// By Class Name (Single)
	document.querySelector(".h1").innerHTML = 'Name<h2></h2>';
	document.getElementsByClassName("h1")[0].innerHTML = 'Name<h2></h2>';

	// By Class Name (Multiple)
	for (let i = 0; i < 3; i++) {
		document.querySelectorAll(".h1")[i].innerHTML = 'Name<h2></h2>';
	}
	for (let i = 0; i < 3; i++) {
		document.getElementsByClassName("h1")[i].innerHTML = 'Name<h2></h2>';
	}
	$('.h1').html('Name<h2></h2>'); //Jquery

</script>

<!-- <h1 class="h1" id="h1" name="h1" value="Name">Name<h2></h2></h1> -->
<!-- <input type="text" id="h1" class="form-control" maxlength="255" data-test="TEST" autocomplete="off"> -->