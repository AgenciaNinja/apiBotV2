toastr.options = {
    "progressBar" : true,
    "showMethod" : 'slideDown',
    "showEasing" : 'linear',
    "positionClass": "toast-top-right",
};

const toastrError = function(title, text){
    toastr.error(title, text, {timeOut: 3000});
};
const toastrSuccess = function(title, text){
    toastr.success(title, text, {timeOut: 3000});
};

