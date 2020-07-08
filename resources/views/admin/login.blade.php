<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{trans('admin.login')}}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('/')}}/design/AdminLTE/dist/css/AdminLTE.min.css">
    <!---intlTelInput-->
    <link rel="stylesheet" href="{{url('/')}}/design/Telinput/css/intlTelInput.css">
   <!---custom-->
    <link rel="stylesheet" href="{{url('/')}}/design/custom.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <!--<a href="../../index2.html"><b>Admin</b>LTE</a>-->
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to control news site</p>

    <form action="{{admin_url('/')}}" method="post" id="login-form">
        @csrf()
        @if ($errors->any())
        <div class="alert alert-danger">
           <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif
      @if (isset($error_msg))
      <div class="api-error alert alert-danger">{{$error_msg}}</div>
      @endif
      <div class="form-group has-feedback">
        <input type="tel" class="form-control"  name="mobile" id="phone" autocomplete="false">
        
         <div class="mobile_veritify">
        <span id="valid-msg" class="hide">✓ Valid</span>
        <span id="error-msg" class="hide"></span>
         </div>
        <input type="hidden" name="country_name" id="country_name"/>
        <input type="hidden" name="country_code" id="country_code"/>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" autocomplete="false">
      </div>
      
      <div class="row">
        <div class="col-md-12 col-xs-8">
          <div class="checkbox ">
            <label>
              <input type="checkbox"> Remember Me
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-md-12 col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 2.2.3 -->
<script src="{{url('/')}}/design/AdminLTE/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="{{url('/')}}/design/AdminLTE/bootstrap/js/bootstrap.min.js"></script>

<script src="{{url('/')}}/design/Telinput/js/intlTelInput.js"></script>
<script>
    // get the country data from the plugin
var countryData = window.intlTelInputGlobals.getCountryData(),
  input = document.querySelector("#phone")
  password = document.querySelector("#password"),
  password_error=document.querySelector("#pass_error"),
  country_code = document.querySelector("#country_code")
  country_name = document.querySelector("#country_name"),
  errorMsg = document.querySelector("#error-msg"),
  validMsg = document.querySelector("#valid-msg");
  var errorMap = ["Invalid number", "Invalid country code", "Too short", "Too long", "Invalid number"];

    // initialise plugin
    var iti =  window.intlTelInput(phone, {
      separateDialCode:true,
      /*  initialCountry: "auto",
        geoIpLookup: function(callback) {
            $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                var countryCode = (resp && resp.country) ? resp.country : "";
                callback(countryCode);
            });
        },*/
        utilsScript: "{{url('/')}}/design/Telinput/js/utils.js"
    });
    var reset = function() {
  input.classList.remove("error");
  errorMsg.innerHTML = "";
  errorMsg.classList.add("hide");
  validMsg.classList.add("hide");
};

// on blur: validate
input.addEventListener('blur', function() {
  reset();
  if (input.value.trim()) {
    if (iti.isValidNumber()) {
      validMsg.classList.remove("hide");
    } else {
      input.classList.add("error");
      var errorCode = iti.getValidationError();
      errorMsg.innerHTML = errorMap[errorCode];
      errorMsg.classList.remove("hide");
    }
  }
});
// on keyup / change flag: reset
input.addEventListener('change', reset);
input.addEventListener('keyup', reset);

// set it's initial value
country_name.value = iti.getSelectedCountryData().iso2;
country_code.value = iti.getSelectedCountryData().dialCode;
// listen to the telephone input for changes
input.addEventListener('countrychange', function(e) {
  country_name.value = iti.getSelectedCountryData().iso2;
  country_code.value = iti.getSelectedCountryData().dialCode;
});

// listen to the address dropdown for changes
country_name.addEventListener('change', function() {
  iti.setCountry(this.value);
});
    
country_code.addEventListener('change', function() {
  iti.setCountry(this.value);
});
</script>
</body>
</html>
