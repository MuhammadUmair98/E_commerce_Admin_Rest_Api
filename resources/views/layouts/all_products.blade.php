@include('layouts.app')
<html>
    <head>
        
    </head>
    @yield('sidebar')
    <body>
        <div class="container-fluid mydiv">
        
          <section class="content"> 
            <!-- general form elements -->
                 <div class="card card-info">
                 
                   <div class="card-header" id="headerFormProduct">
                     <h3 class="card-title">View Deleted Products</h3>
                   </div>
                   <!-- /.card-header -->
                   <!-- form start -->
                  <form role="form" method="POST" action="{{route('postAllProducts')}}">
                    @csrf
                     <div class="card-body">
     
                       <div class="form-group">
                         <label>Select Main Category</label>
                         
                         <select  id="mainCatDropDown" required name="category" class="form-control select2" style="width: 100%;">
                          @if(isset($err))

                         </select>
                         <br>
                          @endif
                         <option value="OK" disabled selected hidden>Please Choose Main Category</option>
                         
                          @if(isset($cat))
                          @foreach($cat as $cats)
                          
                         <option value="{{$cats["categories"]}}">{{$cats["categories"]}}</option>
                  
                         @endforeach
                         </select>

                       </div>
                       
                     
                  
                       <div class="form-group">
                        <label>Select Sub Category</label>
                        @if(isset($categorie))
                        @foreach($categorie as $categories => $value)
                      
                        <select id={{$categories}} name="subcategory" class="form-control select2" required style="width: 100%;">
                        @foreach($value as $values)
                         <option value="OK" disabled selected hidden>Please Choose Sub Category</option>
                         <option value="{{$values->subcategory}}">{{$values->subcategory}}</option>
                        @endforeach
                        </select>
                        @endforeach
                        @endif
                        <select id="itsok" name="subcategory" disabled class="form-control select2"  required style="width: 100%;">
                         <option value="OK" disabled selected hidden>Please Choose Category First</option> 
                       </select>
                      </div>
    
    
     @endif
                     
                       
     
                     
     
                   
                     <!-- /.card-body -->
                     
                     <div class="card-footer" >
                      
                      <input id="submitProduct" style="  " type="submit" class="btn btn-success ok"  value="View Product">
                     </div>
                   </form>
           
                 </div>
                
         </section>
           @if (isset($Rec))
           <div class="alert alert-success" role="alert">
            {{$Rec}}
           </div>
           @elseif(isset($Ruc))
           <div class="alert alert-danger" role="alert">
            {{$Ruc}}
           </div>
          @elseif(isset($nopro))
           <div class="alert alert-danger" role="alert">
           {{$nopro}}
           </div>
           @endif
           <div>
            @if(isset($err))
       <div class="alert alert-danger" role="alert">
                 There is no category added.Please go to add category to add one.    
      </div>
          </div>
          
          @endif

           @if(isset($all_product))
           <div class="container">
         
            <div class="row">
              @foreach($all_product as $all_products)
              
              <div class="col-12 col-sm-8 col-md-6 col-lg-4">
               
                <div class="card">
                    <div class="card">
                        <div class="img-hover-zoom img-hover-zoom--xyz">
                          @if(is_Null($all_products->product_pic))
                          <img class="card-img" src="{{asset('/photos/clickmarts.png')}}" alt="Vans">
                          @else
                          <img class="card-img" src="\public\image\{{$all_products->product_pic}}" alt="image to be uploaded">
                          @endif
                </div>
                  <div class="card-img-overlay d-flex justify-content-end">
                    <a href="#" class="card-link text-danger like">
                      
                    </a>
                  </div>
                </div>
                
                  <div class="card-body">
                  
                    <div style="">
                      <h4 style="display:inline;" class="card-title"><strong>{{$all_products->product_name}}</strong></h4> 
                     <h4 style="display:inline; float: right;" class="card-title">{{$all_products->product_quantity}}</h4>
                       </div>
                 
                    
                
                    <div class="buy d-flex justify-content-between align-items-center">
                    <div class="price text-success "><h5 class="mt-4">{{$all_products->product_price}}<i> RS </i></h5></div>
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                 
                    
                    <a href="{{route('addtoProduct',['id'=>$all_products->id,'product_price' => $all_products->product_price])}}"><button style="color:white; " class="btn btn-success mt-3" type="button"><i class="fas fa-save"></i>&nbsp;  Add to Products</button></a>
                
                  </div>
                 
                    </div>
                </div>
                  </div>
                  
                </div>
               
           @endforeach
              </div>
              
            </div>
          
        </div>
        @endif
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
</html>