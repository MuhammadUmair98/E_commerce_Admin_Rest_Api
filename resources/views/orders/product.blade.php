<html>

<head>

</head>
<body>
    <td colspan="999">
        <div>
    <table class="table table-hover table-in-card">
        <thead>
            <tr>
                
                <th scope="col">Product Id</th>
                <th scope="col">Product Category</th>
                <th scope="col">Product Subcategory</th>
                <th scope="col">Product Name</th>
                <th scope="col">Product Price</th>
                <th scope="col">Product Size</th>
                <th scope="col">Order Address</th>
            </tr>
            
        </thead>
        @foreach($data as $datas)
    <tbody>
        
        <tr>
            
        <td scope="col">{{$datas->id}}</td>
        <td scope="col">{{$datas->category}}</td>
            <td scope="col">{{$datas->subcategory}}</td>
            <td scope="col">{{$datas->product_name}}</td>
            <td scope="col">{{$datas->product_price}}</td>
            <td scope="col">{{$datas->product_quantity}}</td>
            <td scope="col">Head Quaters 15 div ok road Sialkot cantt</td>
        </tr>
    </tbody>
    @endforeach
    </table>
</div>
    </td>
</body>

</html>
