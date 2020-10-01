<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <!-- Title Page-->
    <title>Register</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyBUD-udhrnP-UYqQIzXeq0rZ6GjRZ4KCi0"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Main CSS-->
<link href="{{asset('/css/main.css')}}" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h2 class="title">Register</h2>
                    
                </div>
                <div class="card-body">
                <form method="POST" action="{{route('registered')}}">
                    @csrf
                        <div class="form-row">
                            <div class="name">Name</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="name" placeholder="Enter Your Name" required>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Email address</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6 " type="email" name="email" placeholder="example@email.com" required>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Password</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6 " type="password" name="password" placeholder="Enter Your Password" required>
                                    @error('password')
                                        
                                    <strong class="text-danger">Password should atleast be of 6 characters</strong>
                               
                            @enderror
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Address</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6 " type="text" id="address" name="address"  required>
                                  
                                   
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Contact Number</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" pattern="[0-9]{11}" type="tel" name="contact" placeholder="Enter Your Phone Number"  required>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="input--style-6 " type="hidden" id="loc_lat" name="lat">
                        </div>
                        <div class="input-group">
                            <input class="input--style-6 " type="hidden" id="loc_long" name="long">
                        </div>
                        
                        <div class="card-footer">
                            <button class="btn btn--radius-2 btn--blue-2" name="place_changed" id="place_changed" type="submit">Register</button>

                        
                        <a href="{{route('login')}}"><button class="btn btn--radius-2 btn--blue-2" type="button" style="background-color:green">Already a user?</button></a>
                        </div>
                    </form>
                </div>
                
            </div>
        </div>
    </div>

    <!-- Jquery JS-->
    <script src="vendor/jquery/jquery.min.js"></script>


    <!-- Main JS-->
    <script src="js/global.js"></script>
    <script>
        var searchInput = 'address'
        $(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
    });
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        document.getElementById('loc_lat').value = near_place.geometry.location.lat();
        document.getElementById('loc_long').value = near_place.geometry.location.lng();
	    var value =	$('#loc_lat').val();
        
    });
        });


        $('form').on('keyup keypress', function(e) {
  var keyCode = e.keyCode || e.which;
  if (keyCode === 13) { 
    e.preventDefault();
    return false;
  }
});
        
    </script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->