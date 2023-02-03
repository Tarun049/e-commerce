$(document).ready(function(){
    $("#add_to_cart").on('click', function(){
        var base_url = window.location.origin;
        let csrf_token = $("input[name=_token]").val();
        let product_quantity = $("#input_addToCart").val();
        let product_id = $("#productId").val();

        jQuery.ajax({
            url: base_url + "/product/add-to-cart",
            // url:'http://127.0.0.1:8000/api/member-list',
            type: "post",
            data: {
                _token: csrf_token,
                product_quantity: product_quantity,
                product_id: product_id,
            },
            success: function (response) {
                let data = JSON.parse(response);
                if( data.status == "success" ) {
                    Swal.fire('Product Add Succesfully!')
                } else {
                    Swal.fire({
                        icon: 'error',
                        text: 'Something went wrong!',
                      })
                }
            },
        });
    });
});