@include('Super_Admin.myAdmin')
<html>
    <head>

    </head>
    <body>
        @yield('superAdmin')
        
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="white-box">
                <form class="form-horizontal form-material" method="POST" action="{{route('categorySaved')}}">
                    @csrf 
                    <div class="form-group">
                            <label class="col-md-12">Category Name</label>

                            <div class="col-md-12">

                                <input type="text" name="main" required placeholder="Category"
                                    class="form-control form-control-line"> 
                                </div>
                        </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">SubCategory Name</label>
                            <div class="col-md-12">
                                <input type="text" name="sub" required placeholder="SubCategory"
                                    class="form-control form-control-line" 
                                    id="example-email"> </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">Save Category</button>
                            </div>
                        </div>
                    </form>
                </div>
                @if(Session::has('successfull'))
                <div class="alert alert-success">
                    <strong>Success!</strong> Your Category has been Successfully Registered
                  </div>
                  @endif
            </div> 
           
        </div>

    
    </div>
    <!-- /.container-fluid -->
    <footer class="footer text-center"> 2020 &copy; Admin brought to you by Muhammad Umair</footer>
</div>
<!-- ============================================================== -->
<!-- End Page Content -->
<!-- ============================================================== -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->

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