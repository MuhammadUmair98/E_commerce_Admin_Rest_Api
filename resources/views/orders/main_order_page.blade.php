@include('layouts.app')
<html>
    <head>
        <script src="https://code.jquery.com/jquery-3.1.1.min.js">
        </script>
    </head>

    @yield('sidebar')
    <style>
        
     
        .dash-content {
    -webkit-box-flex: 2;
    -webkit-flex-grow: 2;
    -ms-flex-positive: 2;
    flex-grow: 2;
    padding-top: 8px !important;
    padding-right: 25px;
    padding-bottom: 25px;
    padding-left: 25px;
    
    }
    ///
    
    </style>
    <body>
        
        <main class="dash-content">
            <div class="container-fluid">
                <h1 class="dash-title">Orders</h1>
                    <div class="row">
                        <div class="col-lg-12 ">
                            <div class="card spur-card">
                                <div class="card-header">
                                    <div class="spur-card-icon">
                                        <i class="fas fa-table"></i>
                                        <?php $i=0;?>
                                    </div>
                                    <div class="spur-card-title">Your Orders</div>
                                </div>
                                
                                <div class="card-body ">
                                   
                                    <table class="table table-hover table-in-card">
                                        <thead>
                                            <tr>
                                                
                                                <th scope="col">Order no</th>
                                                <th scope="col">User's Name</th>
                                                <th scope="col">Order Status</th>
                                                <th scope="col">Total Price</th>
                                                <th scope="col">Total Items</th>
                                                <th scope="col">Order Date</th>
                                                <th scope="col">Show more</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($order as $orders)
                                            <?php $i=$i+1; ?>
                                            <tr class="parent">
                                            <th scope="row">{{$i}}</th>
                                            <td>{{ucwords($orders->name)}}</td>
                                            <td>{{ucfirst($orders->order_status)}}</td> 
                                            <td>{{$orders->total_price}}</td>   
                                            <td>{{$orders->total_items}}</td>
                                            <td>{{$orders->created_at}}</td>
                                            <td>
                                                <button title="see products" type="button" id="view" onclick="get({{$orders->id}},{{$i}})" class="btn btn-primary">
                                                    
                                                    <i class="far fa-eye"></i></button>
                                            </td>
                                            </tr>
                                           
                                        <div id="child-"{{$i}} class="child-{{$i}}">
                                            <tr id="child-"{{$i}} class="child-{{$i}}">
                                               
                                               
                                            </tr>
                                        </div>
                                        
                                        

                                          @endforeach
                                            
                                         
                                        </tbody>
                                       
                                    </table>
                                
                                </div>
                            </div>
                
                        </div>
                       
            </div>
            
        </main>
        <script>
       $("#child-*").hide();
       
function get(my_id,ok){
    //$("#child-*").show();
    $("#loader").show(); 
    $('.parent').siblings('.child-' + ok).toggle(800);
    $.ajax({
        //"{{ URL::to('/view/products') }}/"+my_id
                url : "{{ URL::to('/view/products') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data:{id:my_id},
                beforeSend: function() {
                     
                  
               },
                success:function(data){
                   
                    $('.child-' +ok).html(data);

                },

            });
   

  

  

}




        </script>
    </body>
</html>