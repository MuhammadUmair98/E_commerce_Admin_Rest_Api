@include('layouts.app')
<html>
<head>
  <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="{{asset('/css/image_hover.css')}}"/>
<style>
html { 
  visibility:hidden; 
}

    body {
		font-family: 'Varela Round', sans-serif;
	}
	.modal-confirm {		
		color: #636363;
		width: 400px;
	}
	.modal-confirm .modal-content {
		padding: 20px;
		border-radius: 5px;
		border: none;
    text-align: center;
		font-size: 14px;
	}
	.modal-confirm .modal-header {
		border-bottom: none;   
        position: relative;
	}
	.modal-confirm h4 {
		text-align: center;
		font-size: 26px;
		margin: 30px 0 -10px;
	}
	.modal-confirm .close {
        position: absolute;
		top: -5px;
		right: -2px;
	}
	.modal-confirm .modal-body {
		color: #999;
	}
	.modal-confirm .modal-footer {
		border: none;
		text-align: center;		
		border-radius: 5px;
		font-size: 13px;
		padding: 10px 15px 25px;
	}
	.modal-confirm .modal-footer a {
		color: #999;
	}		
	.modal-confirm .icon-box {
		width: 80px;
		height: 80px;
		margin: 0 auto;
		border-radius: 50%;
		z-index: 9;
		text-align: center;
		border: 3px solid #f15e5e;
	}
	.modal-confirm .icon-box i {
		color: #f15e5e;
		font-size: 46px;
		display: inline-block;
		margin-top: 13px;
	}
    .modal-confirm .btn {
        color: #fff;
        border-radius: 4px;
		background: #60c7c1;
		text-decoration: none;
		transition: all 0.4s;
        line-height: normal;
		min-width: 120px;
        border: none;
		min-height: 40px;
		border-radius: 3px;
		margin: 0 5px;
		outline: none !important;
    }
	.modal-confirm .btn-info {
        background: #c1c1c1;
    }
    .modal-confirm .btn-info:hover, .modal-confirm .btn-info:focus {
        background: #a8a8a8;
    }
    .modal-confirm .btn-danger {
        background: #f15e5e;
    }
    .modal-confirm .btn-danger:hover, .modal-confirm .btn-danger:focus {
        background: #ee3535;
    }
	.trigger-btn {
		display: inline-block;
		margin: 100px auto;
  }
  @media only screen and (max-width: 561px) {
div.card.xyz{
  float: left;
  width: 391px;
  height: 220px;

}

  }
</style>

</head>
@yield('sidebar')
<body>
   
    <div class="container-fluid mydiv">
        
        <section class="content"> 
            <!-- general form elements -->
                 <div class="card card-info">
                 
                   <div class="card-header" id="headerFormProduct">
                     <h3 class="card-title">View your Products</h3>
                   </div>
                   <!-- /.card-header -->
                   <!-- form start -->
                  <form role="form" method="POST" action="{{route('viewproducts')}}">
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
        <div>
         @if($errors->any())
         <div class="alert alert-danger" role="alert">
          You have not entered your price
         </div>
         @elseif(isset($youaregood))
         <div class="alert alert-success" role="alert">
          {{$youaregood}}
         </div>
         @endif
        </div>
        <div>
          @if(isset($err))
     <div class="alert alert-danger" role="alert">
               There is no category added.Please go to add category to add one.    
    </div>
        </div>
        @endif
         <div class="container">
          
            <div class="row">
              @if(isset($data))
              @foreach($data as $datas)
              <div class="col-12 col-sm-8 col-md-6 col-lg-4">
               
                <div  class="card xyz">
                    <div class="card">
                        <div class="img-hover-zoom img-hover-zoom--xyz">
                         @if(is_Null($datas['product_pic']))
                <img class="card-img" style="width:100% !important; height:220px !important; " src="{{asset('/photos/clickmarts.png')}}" alt="Vans">
                @else
                <img class="card-img" style="width:100% !important; height:220px !important; " src="\public\image\{{$datas['product_pic']}}" alt="image to be uploaded">
                @endif

                </div>
                  <div class="card-img-overlay d-flex justify-content-end">
                    <a href="#" class="card-link text-danger like">
                      
                    </a>
                  </div>
                </div>
                
                  <div class="card-body">
                  
                  <div style="">
                 <h4 style="display:inline;" class="card-title"><strong>{{$datas['product_name']}}</strong></h4> 
                <h4 style="display:inline; float: right;" class="card-title">{{$datas['product_quantity']}}</h4>
                  </div>
                  <br>
                    <div class="options d-flex flex-fill">
                      <form role="form" style="width:100%" method="POST" action="{{route('setPrice',['id' => $datas['product_id'] , 'email' => Auth::guard('admin')->user()->email,'category' => $datas['category'],'subcategory' => $datas['subcategory']] )}}">
                       <input style="width:100%" class="form-control" name="price" type="number" placeholder="Enter your price (Optional)">
                       @csrf
                   
                    
                    </div>
                
                    <div class="buy d-flex justify-content-between align-items-center">
                    <div class="price text-success "><h5 class="mt-4">{{$datas['product_price']}}<i> RS </i></h5></div>
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <button type="button" class="btn btn-danger mt-3" href="#myModal" class="trigger-btn" data-toggle="modal"><i class="fas fa-trash-alt"></i>&nbsp;Delete</button></a>
                    &nbsp;

                       <button style="color:white" class="btn btn-success mt-3" type="submit"><i class="fas fa-save"></i>&nbsp;Save</button>
                    </div>
                  </form>
                    </div>
                </div>
                  </div>
                
                </div>
                <div id="myModal" class="modal fade">
                  <div class="modal-dialog modal-confirm">
                    <div class="modal-content">
                      <div class="modal-header">
                        <div class="icon-box">
                          <i class="material-icons">&#xE5CD;</i>
                        </div>				
                        <h4 class="modal-title">Are you sure?</h4>	
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      <div class="modal-body">
                        <p>Do you really want to delete these records? This process can be undone by going to deleted tab.</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-info" data-dismiss="modal">Cancel</button>
                        <a href="{{route('destroy',['id' => $datas['product_id'] , 'email' => Auth::guard('admin')->user()->email,'category' => $datas['category'],'subcategory' => $datas['subcategory']] )}}"> <button type="button" class="btn btn-danger">Delete</button></a>
                      </div>
                    </div>
                  </div>
                </div>     
                @endforeach
                @endif
              </div>
            </div>
          </div>
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
</html>