@include('Super_Admin.myAdmin')
<html>
    <head>

    </head>
    <body>
        @yield('superAdmin')
        <div class="row">
            <div class="col-md-8 col-xs-12">
                <div class="white-box">
                <form class="form-horizontal form-material" method="POST" action="{{route('mypost')}}">
                    @csrf 
                    <div class="form-group">
                            <label class="col-md-12">Category Name</label>

                            <div class="col-md-12">

                                <select  id="mainCatDropDown" required name="main" class="form-control select2" style="width: 100%;">
                                    <option value="OK" disabled selected hidden>Please Choose Main Category</option>
                                     @if(isset($cat)){
                                     @foreach($cat as $cats)
                                     
                                    <option value="{{$cats->categories}}">{{$cats->categories}}</option>
                             
                                    @endforeach
                                     }
                                     @endif
                                    </select>
                         <!--   <   <input type="text" name="main" required placeholder="Category"
                                    class="form-control form-control-line"> </div>-->
                                
                        </div>
                    </div>
                        <div class="form-group">
                            <label for="example-email" class="col-md-12">SubCategory Name</label>
                            <div class="col-md-12">
                                
                        @foreach($categorie as $categories => $value)
                   
                     <select id={{$categories}} name="subcategory" class="form-control select2" required style="width: 100%;">
                     @foreach($value as $values)
                      <option value="OK" disabled selected hidden>Please Choose Sub Category</option>
                     <option value="{{$values->subcategories}}" id={{$values->subcategories}} >{{$values->subcategories}}</option>
                     @endforeach
                     </select>
                     @endforeach
                     <select id="itsok" name="subcategory" disabled class="form-control select2"  required style="width: 100%;">
                      <option value="OK" disabled selected hidden>Please Choose Category First</option> 
                    </select>
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-success">View Product</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            @if(isset($product))
            @foreach($product as $products)
        <div class="col-md-4 col-xs-12">
            
            <div class="white-box">
                <div style="color: white !important" class="user-bg"> 
                   
                   

                    <div style="background: white; !important" class="overlay-box">
                        <div class="user-content">
                            @if(is_Null($products->product_pic))
                        <a href="javascript:void(0)"><img src="{{asset('/photos/clickmarts.png')}}"
                            style="width: 150px; height:100px;" 
                            
                                    class="thumb-lg img-circle" alt="img"></a>
                                    @else
                                    <a href="javascript:void(0)"><img  style="width: 150px; height:100px;" src="\public\image\{{$products->product_pic}}"
                            
                                        class="thumb-lg img-circle" alt="img"></a>
                                    @endif
                                    <hr>
                            <h4 style="display:inline; color:black !important" class="text-white"><b>{{$products->product_name}}:</b></h4>
                            <h5 style="display:inline; color:black !important" class="text-white"><b>{{$products->product_price}} </b><b></b>  </h5>
                            <h4 style="margin-top: 6px; color:black !important" class="text-white"><b>{{$products->product_quantity}}</b></h4>       
                        </div>
                    </div>
                </div>
                <div class="user-btm-box">
                    <div class="col-md-12 col-sm-4 text-center">
                    <form method="POST" action="{{route('submitFile',['category'=>$products->category,'subcategory'=>$products->subcategory,'id'=>$products->id])}}" enctype="multipart/form-data">
                        @csrf
                            <input class='form-control' name="pics" type="file" >
                            <br>
                            <button class="btn btn-success">Submit File</button>
                        </form>
                        
                    </div>
                  
                </div>
            </div>

        </div>
        @endforeach
        @endif
        
        
    </div>
    @if(isset($msg))
    <div class="row">
        <div class="alert alert-danger">
        <strong>{{$msg}}</strong> 
          </div>
    </div>
    @endif
        </div>
        <script>
          
            $(document).ready(function() {
              
              
             var category= <?php echo $categorie;?>
          // alert(JSON.stringify(category));
          $.each(category, function( index, value ) {
            gindex=index.split(" ")[0];
           $("#"+gindex+"").hide();
        
         
      });
           
        
        
      $("#mainCatDropDown").change(function() {
        
         
         var val = $("#mainCatDropDown option:selected").text();
         // alert(JSON.stringify(value));
           // alert(index);
          $.each(category, function( index, value ) {
            gindex=index.split(" ")[0];
            
            if(val==index){
             
            $("#"+gindex+"").show();
            $("#itsok").hide();
            }
            else{
              
              $("#itsok").hide();
              $("#"+gindex+"").hide();
            }
         
      });
         
      
      
            });
            
      document.getElementsByTagName("html")[0].style.visibility = "visible";
      
            });
          </script>
          
    </body>
       <!-- Menu Plugin JavaScript -->
       <script src="{{asset('/js/sidebar-nav.min.js')}}"></script>
       <!--slimscroll JavaScript -->
       <script src="{{asset('js/jquery.slimscroll.js')}}"></script>
       <!--Wave Effects -->
       <script src="{{asset('/js/jquery.slimscroll.js')}}"></script>
       <!-- Custom Theme JavaScript -->
       <script src="{{asset('/js/custom.min.js')}}"></script>
</html>