$('.datatables').DataTable();
$('.alert').delay(3000).fadeOut();

$(document).on('submit', '.delete-form', function(e) {
    e.preventDefault();
    swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this data!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    url: $(this).attr('action'),
                    method: $(this).attr('method'),
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        location.reload();
                        swal("Record has been deleted successfully.", {
                            icon: "success",
                        });
                    }
                });
            }
        });
});


$("#profileImage").click(function(e) {
    $("#imageUpload").click();
});

function fasterPreview(uploader) {
    if (uploader.files && uploader.files[0]) {
        $('#profileImage').attr('src',
            window.URL.createObjectURL(uploader.files[0]));
    }
}

$("#imageUpload").change(function() {
    fasterPreview(this);
});

function allnumeric(inputtxt) {
    var numbers = /^[0-9]+$/;
    if (inputtxt.value.match(numbers)) {
        // alert('Your Registration number has accepted....');
        document.form1.text1.focus();
        // return true;
    } else {
        document.form1.text1.focus();
        return 0;
    }
}
var fileupload = 1
$(function() {
    $(document).on('click', '.btn-add', function(e) {
        e.preventDefault();

        var controlForm = $('.controls:first'),
            currentEntry = $(this).parents('.entry:first'),

            newEntry = '';
        newEntry = $(currentEntry.clone()).appendTo(controlForm);
        // var image = $(this).parents().find('div.gallery');
        // console.log(image);
        newEntry.find('input').val('');
        controlForm.find('.entry:not(:last) .btn-add')
            .removeClass('btn-add').addClass('btn-remove')
            .removeClass('btn-success').addClass('btn-danger')
            .html('<span class="fa fa-trash"></span>');
    }).on('click', '.btn-remove', function(e) {
        $(this).parents('.entry:first').remove();
        fileupload--;
        e.preventDefault();
        return false;
    });
    // Multiple images preview in browser
    var imagesPreview = function(input, placeToInsertImagePreview) {

        if (input.files) {
            var filesAmount = input.files.length;

            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();

                reader.onload = function(event) {
                    $($.parseHTML('<img>')).attr('src', event.target.result).appendTo(placeToInsertImagePreview);
                }

                reader.readAsDataURL(input.files[i]);
            }
        }

    };

    $('.upload-file').on('change', function() {

        imagesPreview(this, 'div.gallery');
    });

});

function audio(event) {
    var files = event.target.files;
    $("#src").attr("src", URL.createObjectURL(files[0]));
    document.getElementById("audio").load();
}

function demo(event) {
    var files = event.target.files;
    $("#srcdemo").attr("src", URL.createObjectURL(files[0]));
    document.getElementById("demo").load();
}
// document.getElementById("audio-upload").addEventListener("change", audio, false);
document.getElementById("audio-upload1").addEventListener("change", demo, false);
$('.select2-multiple').select2({
    placeholder: 'Select an option'
});

// Create a WaveSurfer instance