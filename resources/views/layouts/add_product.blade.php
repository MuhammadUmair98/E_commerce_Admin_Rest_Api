@include('layouts.app')
<html>
	<meta charset="utf-8" /> 
<head>
<style>
  html { 
  visibility:hidden; 
}
</style>

</head>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
@yield('sidebar')
<body>
    
    
    <div class="container-fluid mydiv">
        
      <section class="content"> 
        <!-- general form elements -->
             <div class="card card-info">
             
               <div class="card-header" id="headerFormProduct">
                 <h3 class="card-title">Add your Categories</h3>
               </div>
               <!-- /.card-header -->
               <!-- form start -->
              <form role="form" method="POST" action="{{route('MartsProducts')}}">
                @csrf
               
                 <div class="card-body">
 
                   <div class="form-group">
                     <label>Select Main Category</label>
                     <select  id="mainCatDropDown" required name="category" class="form-control select2" style="width: 100%;">
                     <option value="OK" disabled selected hidden>Please Choose Main Category</option>
                      
                      @foreach($cat as $cats)
                      
                     <option value="{{$cats->categories}}">{{$cats->categories}}</option>
              
                     @endforeach
                     </select>
                   </div>
 
                    <div class="form-group">
                     <label>Select Sub Category</label>
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
 
                 
                   
 
                 
 
               
                 <!-- /.card-body -->
 
                 <div class="card-footer" >
                  <input id="submitProduct" style="  " type="submit" class="btn btn-success ok"  value="Add Product">
                 </div>
               </form>
       
             </div>
            
     </section>
     @if($errors->any())
     <div class="alert alert-danger" role="alert">
               You have already Registered this Category.Please try an other one.     
    </div>
    @else
    @if (Session::has('success'))
    <div class="alert alert-success" role="alert">
     {{ Session::get('success')}}
    </div>
    @endif
@endif

    </div>
    <script>
          
      $(document).ready(function() {
        
        
       var category= <?php echo $categorie;?>
    // alert(JSON.stringify(category));
    $.each(category, function( index, value ) {
      gindex=index.split(" ")[0];
     //
      
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