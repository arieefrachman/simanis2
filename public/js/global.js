const base_url = `${location.hostname}`;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});



const openFormModal = () => {
    $('#formModal').modal({backdrop: 'static', keyboard: false});
};

const closeFormModal = () => {
    $('#formModal').modal('hide');
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','none');
    $('#modalForm').trigger("reset");
};

const printErrorModal = (data) => {
    let arr_err = [];
    $.each(data, (k, v) => {
        arr_err.push(v[0]);
    });
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $.each( arr_err, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
};

const addDataModal = (url, table, formData) => {
    $.LoadingOverlay("show");
    $.ajax({
        url: url,
        type: 'POST',
        processData: false,
        contentType: false,
        data: formData,
        statusCode: {
            400: (err) => {
                let data = JSON.parse(err.responseText);
                printErrorModal(data);
                $.LoadingOverlay("hide");
            },
            404: (err) => {
                let data = JSON.parse(err.responseText);
                printErrorModal(data);
                $.LoadingOverlay("hide");
            },
            500: (err) => {
                let errMsg = JSON.parse(err.responseText);
                $.LoadingOverlay("hide");
                Swal.fire({
                    icon: 'error',
                    title: `${errMsg.msg}`,
                });
            }
        },
        success: (res, textStatus, jqXHR) => {
            $.LoadingOverlay("hide");
            $('#formModal').modal('hide');
            table.ajax.reload();
            $('#modalForm').trigger("reset");
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: `Sukses memasukan data!`,
                width: 200,
                height: 100,
                showConfirmButton: false,
                timer: 1000
            });
        }
    });
};

const inspectionLabel = (inspect) => {
    switch (inspect) {
        case 'A':
            return 'Annually';
        case 'S':
            return  'Semi-annual';
        default:
            return `Three-yearly`;
    }
};



