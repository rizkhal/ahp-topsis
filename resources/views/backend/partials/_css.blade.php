<!-- General CSS Files -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- Toastr -->
<link rel="stylesheet" href="https://demo.getstisla.com/assets/modules/izitoast/css/iziToast.min.css">

<!-- Template CSS -->
<link rel="stylesheet" href="{{asset('backend/css/style.css')}}">
<link rel="stylesheet" href="{{asset('backend/css/components.css')}}">
<style type="text/css">
    .dataTables_length {
        float:left!important;
    }
    select {
       -o-appearance: none;
       -ms-appearance: none;
       -webkit-appearance: none;
       -moz-appearance: none;
       appearance: none;
    }
    textarea.form-control {
        min-height: 7em!important;
    }
</style>
@stack('styles')
