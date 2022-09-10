var base_url = window.location.origin;  // base url

$(() => {
    list();
})

// fetch list
function list(){
    var table = $('#url_shortner').DataTable({
        processing: true,
        serverSide: true,
        "ajax": {
            "url": base_url + "/index",
            "type": "GET",
        },
        columns: [{
            data: 'short_link',
            name: 'short_link'
        },
        {
            data: 'link',
            name: 'link'
        },
        {
            data: 'created_at',
            name: 'created_at'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
        ]
    });
}


// save short  links
$(document).on('click', '#save_event', function (e) {

    e.preventDefault();
    var name = $("#name").val();

    $.ajax({
        type: 'POST',
        url: base_url+"/create",
        dataType: "json",
        data: { url: $('#url').val() },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        beforeSend: function () {
            $("#save_event").prop('disabled', true);// disable button to prevent duplicate
        },
        success: function (data) {
            toastr.success(data.message);
            $('#url_shortner').dataTable().fnClearTable();
            $('#url_shortner').dataTable().fnDestroy();
            list();
        }, error: function (xhr, ajaxOptions, thrownError) {
            toastr.error(xhr.responseJSON.message);
        }, complete: function () {
            $("#save_event").prop('disabled', false);// enable  prevented button
        }
    });

});



// copy to clip board short url
function copyToClipboard(id) {
    var url = $('#copy_'+id).attr('newVal');
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(url).select();
    document.execCommand("copy");
    $temp.remove();
    toastr.success("Url copied");
  }
