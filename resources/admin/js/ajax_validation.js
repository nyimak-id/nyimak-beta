
/**
 * @package : ajax validation form
 * @author  : Fika Ridaul maulayya
 * @since   : 2017
 */

//ajax validation form add category
$(document).ready(function(){
    $(".add-category form").submit(function() {
        var thumbnail    = $("[name='userfile']").val();
        var nama         = $("[name='nama_category']").val();
        var descriptions = $("[name='descriptions']").val();
        if(thumbnail.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Pilih Gambar Thumbnail.", "ERROR !", opts);
            }, 1000);
        }else if(nama.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan Nama Category.", "ERROR !", opts);
            }, 1000);
        }else if(descriptions.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan Descriptions Category.", "ERROR !", opts);
            }, 1000);
        }else{
            return true;
        }
        return false;
    })
});

//ajax validation edit category
$(document).ready(function(){
    $(".edit-category form").submit(function() {
        var nama         = $("[name='nama_category']").val();
        var descriptions = $("[name='descriptions']").val();
        if(nama.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan nama category.", "ERROR !", opts);
            }, 1000);
        }else if(descriptions.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan descriptions category.", "ERROR !", opts);
            }, 1000);
        }else{
            return true;
        }
        return false;
    })
});

//ajax search
$(document).ready(function(){
    $(".search form").submit(function() {
        var search  = $("[name='q']").val();
        if(search.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan kata kunci Anda.", "ERROR !", opts);
            }, 1000);
        }else if(search.length < 3){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan minimum setidaknya 3 karakter.", "ERROR !", opts);
            }, 1000);
        }else{
            return true;
        }
        return false;
    })
});

//ajax validation add video
$(document).ready(function(){
    $(".add-video form").submit(function() {
        var thumbnail    = $("[name='userfile']").val();
        var judul        = $("[name='judul_video']").val();
        var category     = $("[name='category_video']").val();
        var embed        = $("[name='embed_video']").val();
        var descriptions = $("[name='descriptions']").val();
        if(thumbnail.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Pilih Gambar Thumbnail.", "ERROR !", opts);
            }, 1000);
        }else if(judul.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan Judul video.", "ERROR !", opts);
            }, 1000);
        }else if(category.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Pilih category video.", "ERROR !", opts);
            }, 1000);
        }else if(embed.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan link embed video.", "ERROR !", opts);
            }, 1000);
        }else if(descriptions.length == 0) {
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan descriptions video.", "ERROR !", opts);
            }, 1000);
        }else{
            return true;
        }
        return false;
    })
});

//ajax validation edit video
$(document).ready(function(){
    $(".edit-video form").submit(function() {
        var judul        = $("[name='judul_video']").val();
        var category     = $("[name='category_video']").val();
        var embed        = $("[name='embed_video']").val();
        var descriptions = $("[name='descriptions']").val();
        if(judul.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan Judul video.", "ERROR !", opts);
            }, 1000);
        }else if(category.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Pilih category video.", "ERROR !", opts);
            }, 1000);
        }else if(embed.length == 0){
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan link embed video.", "ERROR !", opts);
            }, 1000);
        }else if(descriptions.length == 0) {
            setTimeout(function() {
                /*toastr.error('Email is still empty');*/
                var opts = {
                    "debug": false,
                    "positionClass": "toast-top-right",
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "2000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                };
                toastr.error("Masukkan descriptions video.", "ERROR !", opts);
            }, 1000);
        }else{
            return true;
        }
        return false;
    })
});