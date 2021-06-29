class Notification{

    success(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Successfully Done..',
            timeout: 1000,
        }).show();
    }

    alert(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Are You Sure?',
            timeout: 1000,
        }).show();
    }

    error(){
        new Noty({
            type: 'alert',
            layout: 'topRight',
            text: 'Something went wrong..',
            timeout: 1000,
        }).show();
    }

    warning(){
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Oops something is wrong..',
            timeout: 1000,
        }).show();
    }

    image_validation(){
        new Noty({
            type: 'error',
            layout: 'topRight',
            text: 'Upload image less than 1MB',
            timeout: 1000,
        }).show();
    }

    cart_success(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Add To Cart',
            timeout: 1000,
        }).show();
    }

    cart_removed(){
        new Noty({
            type: 'warning',
            layout: 'topRight',
            text: 'Removed From Cart',
            timeout: 1000,
        }).show();
    }

    success_payment(){
        new Noty({
            type: 'success',
            layout: 'topRight',
            text: 'Payment Successfully Done',
            timeout: 1000,
        }).show();
    }

}

export default Notification = new Notification();