@include('Super_Admin.myAdmin');
<html>

<head>

</head>
<body>
@yield('superAdmin')
   <div class="row">
    <div class="col-md-8 col-xs-12">
        <div class="white-box">
        <form class="form-horizontal form-material" method="POST" action="{{route('Saved')}}">
            @csrf
                <div class="form-group">
                    <label class="col-md-12">Category Name</label>
                    <div class="col-md-12">
                     
                        <input type="text" value="{{$category}}" readonly placeholder="Add a Category"
                            class="form-control form-control-line" name='category' readonly>
                    
                        </div>
                </div>
                <div class="form-group">
                    <label for="example-email" class="col-md-12">Subcategory Name</label>
                    <div class="col-md-12">
                     
                        <input type="email"  readonly placeholder="Add a Subcategory"
                            class="form-control form-control-line" name='sub' value="{{$categoryName}}" 
                            id="example-email">
                      
                        </div>
                </div>
            
                <div class="form-group">
                    <label class="col-md-12">Name</label>
                    <div class="col-md-12">
                        <input type="text" placeholder="Add a Name"
                        name='name'
                            class="form-control form-control-line"> </div>
                </div>
                <div class="form-group">
                    <label class="col-md-12">Add The Product Quantity</label>
                    <div class="col-md-12">
                        <input type="text" placeholder="Add the Quantity"
                        name='quantity'
                        class="form-control form-control-line"> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12">Price</label>
                        <div class="col-md-12">
                            <input type="number"
                            name='price' placeholder="Add the Price"
                            class="form-control form-control-line"> </div>
                        </div>
               
              
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">Store Product</button>
                    </div>
                </div>

                </div>
            </form>
            @if(isset($nice))
            <div class="alert alert-success">
                <strong>Success!</strong> Your Product has been Successfully Saved
              </div>
              @endif
        </div>
        
    </div>
    
       
    
</div>
    </div>
 <!-- /.container-fluid -->
 <footer class="footer text-center"> 2020 &copy; Admin brought to you by Muhammad Umair  </footer>
 <!-- Menu Plugin JavaScript -->
 <script src="{{asset('/js/sidebar-nav.min.js')}}"></script>
 <!--slimscroll JavaScript -->
 <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
 <!--Wave Effects -->
 <script src="{{asset('/js/jquery.slimscroll.js')}}"></script>
 <!-- Custom Theme JavaScript -->
 <script src="{{asset('/js/custom.min.js')}}"></script>
</body>
</html>