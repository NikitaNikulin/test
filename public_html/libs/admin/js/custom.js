$(function () {
    //$.get('/getCsrfToken', function(data){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    //});
    //$.fn.editable.defaults.mode = 'inline';
    $(document).ready(function () {
        if ($('.editable').length > 0) {
            $('.editable').editable({
                selector: 'a'
            });
        }
    });
    //var elemets = 'input[name=work_in_mon],input[name=work_in_tue],input[name=work_in_wed],input[name=work_in_thu],input[name=work_in_fri],input[name=work_in_sat],input[name=work_in_sun]';
    //$(elemets).on('click', function(e){
    //    var self = $(this);
    //    var from = self.closest('.col-lg-3').next();
    //    var to = self.closest('.col-lg-3').next().next();
    //    if(self.is(':checked')){
    //        from.show(); to.show();
    //    }else{
    //        from.hide(); to.hide();
    //    }
    //});

});