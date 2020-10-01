@include('Super_Admin.myAdmin')
<html>
    <head>
<style>
    .ok{
        text-decoration: none !important;
        color: inherit !important;
    }
</style>
    </head>
    <body>
        @yield('superAdmin')
        <div class="row">
            @foreach($viewCategorie as $viewCategories)
            <div class="col-sm-12 col-md-6">
                <div class="white-box">
                    <h3 class="box-title">Categories Table</h3>
                    
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($viewCategories as $viewCategoriess)
                                <tr>
                               <td>{{$viewCategoriess->id}}</td>
                                 <td><a style="" href="{{route('addadminproduct',['id'=>$viewCategoriess->id,'category'=>$viewCategoriess->categories,'categoryName'=>$viewCategoriess->subcategories])}}">{{$viewCategoriess->categories}}</a></td> 
                                 <td> <a style="" href="{{route('addadminproduct',['id'=>$viewCategoriess->id,'category'=>$viewCategoriess->categories,'categoryName'=>$viewCategoriess->subcategories])}}">   {!! $viewCategoriess->subcategories !!}</a></td>
                                 <td> <a style="" href="{{route('addadminproduct',['id'=>$viewCategoriess->id,'category'=>$viewCategoriess->categories,'categoryName'=>$viewCategoriess->subcategories])}}">   {!! $viewCategoriess->count !!}</a></td>
                                </tr>
                               
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                    
                </div>
               
                
            </div>
            @endforeach

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
</html>