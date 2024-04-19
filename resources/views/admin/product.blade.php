@extends('layout.main')
@section('content')
<div class="d-md-flex mb-3 align-items-center justify-content-between">
    <h3 class="box-title mb-0">Dashboard</h3>
    <a type="submit" class="btn btn-primary" href="{{route ('store')}}"
        style="text-decoration: none; color: inherit;">Add product</a>

</div>
<div class="table-responsive">
    <table class="table no-wrap">
        <thead>
            <tr>
                <th class="border-top-0">#</th>
                <th class="border-top-0">Name</th>
                <th class="border-top-0">Status</th>
                <th class="border-top-0">Date</th>
                <th class="border-top-0">Price</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = 1;
            @endphp

            $@foreach ($products as $product)
                
            
            <tr>
                <td>1</td>
                <td class="txt-oflo">Elite admin</td>
                <td>SALE</td>
                <td class="txt-oflo">April 18, 2021</td>
                <td><span class="text-success">$24</span></td>
            </tr>
            <tr>
                <td>2</td>
                <td class="txt-oflo">Real Homes WP Theme</td>
                <td>EXTENDED</td>
                <td class="txt-oflo">April 19, 2021</td>
                <td><span class="text-info">$1250</span></td>
            </tr>
            <tr>
                <td>3</td>
                <td class="txt-oflo">Ample Admin</td>
                <td>EXTENDED</td>
                <td class="txt-oflo">April 19, 2021</td>
                <td><span class="text-info">$1250</span></td>
            </tr>
            <tr>
                <td>4</td>
                <td class="txt-oflo">Medical Pro WP Theme</td>
                <td>TAX</td>
                <td class="txt-oflo">April 20, 2021</td>
                <td><span class="text-danger">-$24</span></td>
            </tr>
            <tr>
                <td>5</td>
                <td class="txt-oflo">Hosting press html</td>
                <td>SALE</td>
                <td class="txt-oflo">April 21, 2021</td>
                <td><span class="text-success">$24</span></td>
            </tr>
            <tr>
                <td>6</td>
                <td class="txt-oflo">Digital Agency PSD</td>
                <td>SALE</td>
                <td class="txt-oflo">April 23, 2021</td>
                <td><span class="text-danger">-$14</span></td>
            </tr>
            <tr>
                <td>7</td>
                <td class="txt-oflo">Helping Hands WP Theme</td>
                <td>MEMBER</td>
                <td class="txt-oflo">April 22, 2021</td>
                <td><span class="text-success">$64</span></td>
            </tr>
        </tbody>
    </table>
</div>
@endsection