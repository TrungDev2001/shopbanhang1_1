@extends('layouts.admin')
@section('title')
    Voucher
@endsection
@section('css')
    <link rel="stylesheet" href="{{ asset('admins/product/index/index.css') }}">
    <link href="{{ asset('vendors/select2/select2.min.css') }}" rel="stylesheet" />
    <style>
        .colored-toast.swal2-icon-success {
            background-color: #a5dc86 !important;
        }
    </style>
@endsection
@section('content')

<button type="button" style="float: left" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal0">
    Bảng cửu chương
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal0" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Bảng cửu chương</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <table class="table table-striped">
        <thead class="table-striped thead-dark">
            <tr>
            <th scope="col">Nhân 2</th>
            <th scope="col">Nhân 3</th>
            <th scope="col">Nhân 4</th>
            <th scope="col">Nhân 5</th>
            <th scope="col">Nhân 6</th>
            <th scope="col">Nhân 7</th>
            <th scope="col">Nhân 8</th>
            <th scope="col">Nhân 9</th>
            </tr>
        </thead>
        <tbody>
        <tr>
            <td>
                @for ($i = 1; $i < 11; $i++)
                    2 x {{ $i }} = {{ 2*$i }} {!! '</br>' !!}
                @endfor
            </td>
            <td>
                @for ($i = 1; $i < 11; $i++)
                    3 x {{ $i }} = {{ 3*$i }} {!! '</br>' !!}
                @endfor
            </td>
            <td>
                @for ($i = 1; $i < 11; $i++)
                    4 x {{ $i }} = {{ 4*$i }} {!! '</br>' !!}
                @endfor
            </td>
            <td>
                @for ($i = 1; $i < 11; $i++)
                    5 x {{ $i }} = {{ 5*$i }} {!! '</br>' !!}
                @endfor
            </td>
            <td>
                @for ($i = 1; $i < 11; $i++)
                    6 x {{ $i }} = {{ 6*$i }} {!! '</br>' !!}
                @endfor
            </td>
            <td>
                @for ($i = 1; $i < 11; $i++)
                    7 x {{ $i }} = {{ 7*$i }} {!! '</br>' !!}
                @endfor
            </td>
            <td>
                @for ($i = 1; $i < 11; $i++)
                    8 x {{ $i }} = {{ 8*$i }} {!! '</br>' !!}
                @endfor
            </td>
            <td>
                @for ($i = 1; $i < 11; $i++)
                    9 x {{ $i }} = {{ 9*$i }} {!! '</br>' !!}
                @endfor
            </td>
        </tr>
        </tbody>
    </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <!-- Button trigger modal -->
<button type="button" style="float: left" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">
    Hình tam giác
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hình tam giác</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{-- <form>
            <div class="form-group">
                <label for="exampleInputEmail1">Nhập dòng</label>
                <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted" style="display: none">We'll never share your email with anyone else.</small>
            </div>
        </form> --}}
        <h5>Vòng lặp for</h5>
        @for ($i = 1; $i < 10; $i++)
            @for ($j = 1; $j <= $i; $j++)
                {{ "*" }}
            @endfor
            {!! '</br>' !!}
        @endfor
        <br>
        @php
            for($i=1; $i<5; $i++){
                for ($j = 1; $j <= 5; $j++){
                echo "  *  ";
                }
                echo "</br>";
            }
        @endphp
        <h5>Vòng lặp while</h5>
        @php
            $i = 0; // Biến dùng để lặp
            while ($i < 5){ // Nếu $i <= 10 thì mới lặp
                echo "</br>";
                $j = 0;
                while($j < $i){
                    echo ' * ';
                    $j++;
                }
                $i++;
            }
        @endphp
        <br>
        @php
            $i = 0;
            while ($i <= 3) {
                echo "</br>";
                $j = 0;
                while ($j <=3){
                    echo ' * ';
                    $j++;
                }
                $i++;
            }
        @endphp
        <h5>Vòng lặp do while</h5>
        @php
            $i = 0;
            do{
                echo "</br>";
                $i++;
                $j = 0;
                do{
                    echo ' * ';
                    $j++;
                }while($j<$i);
            }while($i<5);
        @endphp
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection



