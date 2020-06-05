@extends('layouts.alert')
@extends('layouts.app-admin')
@section('content')
<style type="text/css">

  .table th { 
    background-color: #f5f5f5 !important; 
  } 
  .red  { 
    color: red !important; 
  } 
  .table td.red { 
    background-color: red !important; 
  } 
}

.table td.red { 
  background-color: red !important; 
} 

.ungu  { 
  color: #d961f9 !important; 
} 
.table td.ungu { 
  background-color: #d961f9 !important; 
} 
}

.table td.ungu { 
  background-color: #d961f9 !important; 
} 
@media print { 
    .table th { 
    background-color: #f5f5f5 !important; 
  } 
  .red  { 
    color: red !important; 
  } 
  .table td.red { 
    background-color: red !important; 
  } 
}

.table td.red { 
  background-color: red !important; 
} 

.ungu  { 
  color: #d961f9 !important; 
} 
.table td.ungu { 
  background-color: #d961f9 !important; 
} 
}

.table td.ungu { 
  background-color: #d961f9 !important; 
} 

</style>
<h1 class="mt-4">Laporan Detail Presensi</h1><hr>
<a id="print" onclick="window.print()" class="btn btn-primary d-print-none" style="color: white;"><i class="fa fa-print"></i> Cetak</a>
<div class="row">
  <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12">
    <div class="table-responsive">
    <table class="table table-striped table-bordered table-hover" >
      <thead>
        <tr>
          <th class="text-center" rowspan="2">NO</th>
          <th class="text-center" rowspan="2">Nama</th>
          <th class="text-center" colspan="31">Tanggal</th>
          <th class="text-center" colspan="6">Total</th>
        </tr>
        <tr>
          <th>26</th>
          <th>27</th>
          <th>28</th>
          <th>29</th>
          <th>30</th>
          <th>31</th>
          <th>1</th>
          <th>2</th>
          <th>3</th>
          <th>4</th>
          <th>5</th>
          <th>6</th>
          <th>7</th>
          <th>8</th>
          <th>9</th>
          <th>10</th>
          <th>11</th>
          <th>12</th>
          <th>13</th>
          <th>14</th>
          <th>15</th>
          <th>16</th>
          <th>17</th>
          <th>18</th>
          <th>19</th>
          <th>20</th>
          <th>21</th>
          <th>22</th>
          <th>23</th>
          <th>24</th>
          <th>25</th>
          <th>S</th>
          <th>I</th>
          <th>A</th>
          <th>T</th>
          <th>O</th>
          <th>B</th>
        </tr>
      </thead>
      <tbody>
        <?php $no = 1; ?>
        @foreach($detail as $row)
        <tr>
          <td>{{$no}}</td>
          <td>{{$row->name}}</td>
          @if($row->h26 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h26 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h26 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h26 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h26 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h27 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h27 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h27 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h27 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h27 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h28 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h28 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h28 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h28 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h28 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h29 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h29 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h29 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h29 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h29 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h30 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h30 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h30 == 3)
          <td><strong>A</strong></td>
          @elseiff($row->h30 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h30 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h31 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h31 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h31 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h31 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h31 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h1 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h1 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h1 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h1 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h1 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h2 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h2 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h2 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h2 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h2 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h3 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h3 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h3 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h3 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h3 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h4 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h4 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h4 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h4 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h4 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h5 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h5 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h5 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h5 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h5 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h6 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h6 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h6 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h6 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h6 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h7 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h7 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h7 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h7 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h7 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h8 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h8 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h8 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h8 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h8 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h9 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h9 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h9 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h9 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h9 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h10 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h10 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h10 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h10 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h10 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h11 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h11 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h11 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h11 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h11 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h12 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h12 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h12 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h12 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h12 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h13 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h13 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h13 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h13 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h13 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h14 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h14 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h14 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h14 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h14 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h15 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h15 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h15 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h15 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h15 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h16 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h16 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h16 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h16 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h16 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h17 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h17 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h17 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h17 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h17 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h18 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h18 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h18 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h18 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h18 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h19 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h19 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h19 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h19 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h19 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h20 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h20 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h20 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h20 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h20 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h21 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h21 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h21 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h21 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h21 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h22 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h22 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h22 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h22 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h22 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h23 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h23 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h23 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h23 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h23 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          @if($row->h24 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h24 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h24 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h24 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h24 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>   
          @endif
          @if($row->h25 == 1)
          <td><strong>S</strong></td>
          @elseif($row->h25 == 2)
          <td><strong>I</strong></td>
          @elseif($row->h25 == 3)
          <td><strong>A</strong></td>
          @elseif($row->h25 > 0)
          <td><strong class="red">T</strong></td> @elseif ($row->h25 == 0) <td class = "ungu">-</td>
          @else
          <td><strong style="color: green;"><i class = "fa fa-check"></i></strong></td>
          @endif
          <td align="center">

            <?php
            if ($row->h1 == 1) {
              $h1 = 1;
            } else {
              $h1 = 0;
            }

            if ($row->h2 == 1) {
              $h2 = 1;
            } else {
              $h2 = 0;
            }

            if ($row->h3 == 1) {
              $h3 = 1;
            } else {
              $h3 = 0;
            }

            if ($row->h4 == 1) {
              $h4 = 1;
            } else {
              $h4 = 0;
            }

            if ($row->h5 == 1) {
              $h5 = 1;
            } else {
              $h5 = 0;
            }

            if ($row->h6 == 1) {
              $h6 = 1;
            } else {
              $h6 = 0;
            }

            if ($row->h7 == 1) {
              $h7 = 1;
            } else {
              $h7 = 0;
            }

            if ($row->h8 == 1) {
              $h8 = 1;
            } else {
              $h8 = 0;
            }

            if ($row->h9 == 1) {
              $h9 = 1;
            } else {
              $h9 = 0;
            }

            if ($row->h10 == 1) {
              $h10 = 1;
            } else {
              $h10 = 0;
            }

            if ($row->h11 == 1) {
              $h11 = 1;
            } else {
              $h11 = 0;
            }

            if ($row->h12 == 1) {
              $h12 = 1;
            } else {
              $h12 = 0;
            }

            if ($row->h13 == 1) {
              $h13 = 1;
            } else {
              $h13 = 0;
            }

            if ($row->h14 == 1) {
              $h14 = 1;
            } else {
              $h14 = 0;
            }

            if ($row->h15 == 1) {
              $h15 = 1;
            } else {
              $h15 = 0;
            }

            if ($row->h16 == 1) {
              $h16 = 1;
            } else {
              $h16 = 0;
            }

            if ($row->h17 == 1) {
              $h17 = 1;
            } else {
              $h17 = 0;
            }

            if ($row->h18 == 1) {
              $h18 = 1;
            } else {
              $h18 = 0;
            }

            if ($row->h19 == 1) {
              $h19 = 1;
            } else {
              $h19 = 0;
            }

            if ($row->h20 == 1) {
              $h20 = 1;
            } else {
              $h20 = 0;
            }

            if ($row->h21 == 1) {
              $h21 = 1;
            } else {
              $h21 = 0;
            }

            if ($row->h22 == 1) {
              $h22 = 1;
            } else {
              $h22 = 0;
            }

            if ($row->h23 == 1) {
              $h23 = 1;
            } else {
              $h23 = 0;
            }

            if ($row->h24 == 1) {
              $h24 = 1;
            } else {
              $h24 = 0;
            }

            if ($row->h25 == 1) {
              $h25 = 1;
            } else {
              $h25 = 0;
            }

            if ($row->h26 == 1) {
              $h26 = 1;
            } else {
              $h26 = 0;
            }

            if ($row->h27 == 1) {
              $h27 = 1;
            } else {
              $h27 = 0;
            }

            if ($row->h28 == 1) {
              $h28 = 1;
            } else {
              $h28 = 0;
            }

            if ($row->h29 == 1) {
              $h29 = 1;
            } else {
              $h29 = 0;
            }

            if ($row->h30 == 1) {
              $h30 = 1;
            } else {
              $h30 = 0;
            }

            if ($row->h31 == 1) {
              $h31 = 1;
            } else {
              $h31 = 0;
            }


            ?>

          {{$h1 + $h2 + $h3 + $h4 + $h5 + $h6 + $h7 + $h8 + $h9 + $h10 + $h11 + $h12 + $h13 + $h14 + $h15 + $h16 + $h17 + $h18 + $h19 + $h20 + $h21 + $h22 + $h23 + $h24 + $h25 + $h26 + $h27 + $h28 + $h29 + $h30 + $h31 }}</td>

          <td align="center">

            <?php
            if ($row->h1 == 2) {
              $h1 = 1;
            } else {
              $h1 = 0;
            }

            if ($row->h2 == 2) {
              $h2 = 1;
            } else {
              $h2 = 0;
            }

            if ($row->h3 == 2) {
              $h3 = 1;
            } else {
              $h3 = 0;
            }

            if ($row->h4 == 2) {
              $h4 = 1;
            } else {
              $h4 = 0;
            }

            if ($row->h5 == 2) {
              $h5 = 1;
            } else {
              $h5 = 0;
            }

            if ($row->h6 == 2) {
              $h6 = 1;
            } else {
              $h6 = 0;
            }

            if ($row->h7 == 2) {
              $h7 = 1;
            } else {
              $h7 = 0;
            }

            if ($row->h8 == 2) {
              $h8 = 1;
            } else {
              $h8 = 0;
            }

            if ($row->h9 == 2) {
              $h9 = 1;
            } else {
              $h9 = 0;
            }

            if ($row->h10 == 2) {
              $h10 = 1;
            } else {
              $h10 = 0;
            }

            if ($row->h11 == 2) {
              $h11 = 1;
            } else {
              $h11 = 0;
            }

            if ($row->h12 == 2) {
              $h12 = 1;
            } else {
              $h12 = 0;
            }

            if ($row->h13 == 2) {
              $h13 = 1;
            } else {
              $h13 = 0;
            }

            if ($row->h14 == 2) {
              $h14 = 1;
            } else {
              $h14 = 0;
            }

            if ($row->h15 == 2) {
              $h15 = 1;
            } else {
              $h15 = 0;
            }

            if ($row->h16 == 2) {
              $h16 = 1;
            } else {
              $h16 = 0;
            }

            if ($row->h17 == 2) {
              $h17 = 1;
            } else {
              $h17 = 0;
            }

            if ($row->h18 == 2) {
              $h18 = 1;
            } else {
              $h18 = 0;
            }

            if ($row->h19 == 2) {
              $h19 = 1;
            } else {
              $h19 = 0;
            }

            if ($row->h20 == 2) {
              $h20 = 1;
            } else {
              $h20 = 0;
            }

            if ($row->h21 == 2) {
              $h21 = 1;
            } else {
              $h21 = 0;
            }

            if ($row->h22 == 2) {
              $h22 = 1;
            } else {
              $h22 = 0;
            }

            if ($row->h23 == 2) {
              $h23 = 1;
            } else {
              $h23 = 0;
            }

            if ($row->h24 == 2) {
              $h24 = 1;
            } else {
              $h24 = 0;
            }

            if ($row->h25 == 2) {
              $h25 = 1;
            } else {
              $h25 = 0;
            }

            if ($row->h26 == 2) {
              $h26 = 1;
            } else {
              $h26 = 0;
            }

            if ($row->h27 == 2) {
              $h27 = 1;
            } else {
              $h27 = 0;
            }

            if ($row->h28 == 2) {
              $h28 = 1;
            } else {
              $h28 = 0;
            }

            if ($row->h29 == 2) {
              $h29 = 1;
            } else {
              $h29 = 0;
            }

            if ($row->h30 == 2) {
              $h30 = 1;
            } else {
              $h30 = 0;
            }

            if ($row->h31 == 2) {
              $h31 = 1;
            } else {
              $h31 = 0;
            }


            ?>

          {{$h1 + $h2 + $h3 + $h4 + $h5 + $h6 + $h7 + $h8 + $h9 + $h10 + $h11 + $h12 + $h13 + $h14 + $h15 + $h16 + $h17 + $h18 + $h19 + $h20 + $h21 + $h22 + $h23 + $h24 + $h25 + $h26 + $h27 + $h28 + $h29 + $h30 + $h31 }}</td>

          <td align="center">

            <?php
            if ($row->h1 == 3) {
              $h1 = 1;
            } else {
              $h1 = 0;
            }

            if ($row->h2 == 3) {
              $h2 = 1;
            } else {
              $h2 = 0;
            }

            if ($row->h3 == 3) {
              $h3 = 1;
            } else {
              $h3 = 0;
            }

            if ($row->h4 == 3) {
              $h4 = 1;
            } else {
              $h4 = 0;
            }

            if ($row->h5 == 3) {
              $h5 = 1;
            } else {
              $h5 = 0;
            }

            if ($row->h6 == 3) {
              $h6 = 1;
            } else {
              $h6 = 0;
            }

            if ($row->h7 == 3) {
              $h7 = 1;
            } else {
              $h7 = 0;
            }

            if ($row->h8 == 3) {
              $h8 = 1;
            } else {
              $h8 = 0;
            }

            if ($row->h9 == 3) {
              $h9 = 1;
            } else {
              $h9 = 0;
            }

            if ($row->h10 == 3) {
              $h10 = 1;
            } else {
              $h10 = 0;
            }

            if ($row->h11 == 3) {
              $h11 = 1;
            } else {
              $h11 = 0;
            }

            if ($row->h12 == 3) {
              $h12 = 1;
            } else {
              $h12 = 0;
            }

            if ($row->h13 == 3) {
              $h13 = 1;
            } else {
              $h13 = 0;
            }

            if ($row->h14 == 3) {
              $h14 = 1;
            } else {
              $h14 = 0;
            }

            if ($row->h15 == 3) {
              $h15 = 1;
            } else {
              $h15 = 0;
            }

            if ($row->h16 == 3) {
              $h16 = 1;
            } else {
              $h16 = 0;
            }

            if ($row->h17 == 3) {
              $h17 = 1;
            } else {
              $h17 = 0;
            }

            if ($row->h18 == 3) {
              $h18 = 1;
            } else {
              $h18 = 0;
            }

            if ($row->h19 == 3) {
              $h19 = 1;
            } else {
              $h19 = 0;
            }

            if ($row->h20 == 3) {
              $h20 = 1;
            } else {
              $h20 = 0;
            }

            if ($row->h21 == 3) {
              $h21 = 1;
            } else {
              $h21 = 0;
            }

            if ($row->h22 == 3) {
              $h22 = 1;
            } else {
              $h22 = 0;
            }

            if ($row->h23 == 3) {
              $h23 = 1;
            } else {
              $h23 = 0;
            }

            if ($row->h24 == 3) {
              $h24 = 1;
            } else {
              $h24 = 0;
            }

            if ($row->h25 == 3) {
              $h25 = 1;
            } else {
              $h25 = 0;
            }

            if ($row->h26 == 3) {
              $h26 = 1;
            } else {
              $h26 = 0;
            }

            if ($row->h27 == 3) {
              $h27 = 1;
            } else {
              $h27 = 0;
            }

            if ($row->h28 == 3) {
              $h28 = 1;
            } else {
              $h28 = 0;
            }

            if ($row->h29 == 3) {
              $h29 = 1;
            } else {
              $h29 = 0;
            }

            if ($row->h30 == 3) {
              $h30 = 1;
            } else {
              $h30 = 0;
            }

            if ($row->h31 == 3) {
              $h31 = 1;
            } else {
              $h31 = 0;
            }


            ?>

          {{$h1 + $h2 + $h3 + $h4 + $h5 + $h6 + $h7 + $h8 + $h9 + $h10 + $h11 + $h12 + $h13 + $h14 + $h15 + $h16 + $h17 + $h18 + $h19 + $h20 + $h21 + $h22 + $h23 + $h24 + $h25 + $h26 + $h27 + $h28 + $h29 + $h30 + $h31 }}</td>
          <td align="center">

            <?php
            if ($row->h1 <= 0) {
              $h1 = 0;
            } elseif($row->h1 == 1) {
              $h1 = 0;
            } elseif($row->h1 == 2) {
              $h1 = 0;
            } elseif($row->h1 == 3) {
              $h1 = 0;
            } else {
              $h1 = 1;
            }

            if ($row->h2 <= 0) {
              $h2 = 0;
            } elseif($row->h2 == 1) {
              $h2 = 0;
            } elseif($row->h2 == 2) {
              $h2 = 0;
            } elseif($row->h2 == 3) {
              $h2 = 0;
            } else {
              $h2 = 1;
            }

            if ($row->h3 <= 0) {
              $h3 = 0;
            } elseif($row->h3 == 1) {
              $h3 = 0;
            } elseif($row->h3 == 2) {
              $h3 = 0;
            } elseif($row->h3 == 3) {
              $h3 = 0;
            } else {
              $h3 = 1;
            }

            if ($row->h4 <= 0) {
              $h4 = 0;
            } elseif($row->h4 == 1) {
              $h4 = 0;
            } elseif($row->h4 == 2) {
              $h4 = 0;
            } elseif($row->h4 == 3) {
              $h4 = 0;
            } else {
              $h4 = 1;
            }

            if ($row->h5 <= 0) {
              $h5 = 0;
            } elseif($row->h5 == 1) {
              $h5 = 0;
            } elseif($row->h5 == 2) {
              $h5 = 0;
            } elseif($row->h5 == 3) {
              $h5 = 0;
            } else {
              $h5 = 1;
            }

            if ($row->h6 <= 0) {
              $h6 = 0;
            } elseif($row->h6 == 1) {
              $h6 = 0;
            } elseif($row->h6 == 2) {
              $h6 = 0;
            } elseif($row->h6 == 3) {
              $h6 = 0;
            } else {
              $h6 = 1;
            }

            if ($row->h7 <= 0) {
              $h7 = 0;
            } elseif($row->h7 == 1) {
              $h7 = 0;
            } elseif($row->h7 == 2) {
              $h7 = 0;
            } elseif($row->h7 == 3) {
              $h7 = 0;
            } else {
              $h7 = 1;
            }

            if ($row->h8 <= 0) {
              $h8 = 0;
            } elseif($row->h8 == 1) {
              $h8 = 0;
            } elseif($row->h8 == 2) {
              $h8 = 0;
            } elseif($row->h8 == 3) {
              $h8 = 0;
            } else {
              $h8 = 1;
            }

            if ($row->h9 <= 0) {
              $h9 = 0;
            } elseif($row->h9 == 1) {
              $h9 = 0;
            } elseif($row->h9 == 2) {
              $h9 = 0;
            } elseif($row->h9 == 3) {
              $h9 = 0;
            } else {
              $h9 = 1;
            }

            if ($row->h10 <= 0) {
              $h10 = 0;
            } elseif($row->h10 == 1) {
              $h10 = 0;
            } elseif($row->h10 == 2) {
              $h10 = 0;
            } elseif($row->h10 == 3) {
              $h10 = 0;
            } else {
              $h10 = 1;
            }

            if ($row->h11 <= 0) {
              $h11 = 0;
            } elseif($row->h11 == 1) {
              $h11 = 0;
            } elseif($row->h11 == 2) {
              $h11 = 0;
            } elseif($row->h11 == 3) {
              $h11 = 0;
            } else {
              $h11 = 1;
            }

            if ($row->h12 <= 0) {
              $h12 = 0;
            } elseif($row->h12 == 1) {
              $h12 = 0;
            } elseif($row->h12 == 2) {
              $h12 = 0;
            } elseif($row->h12 == 3) {
              $h12 = 0;
            } else {
              $h12 = 1;
            }

            if ($row->h13 <= 0) {
              $h13 = 0;
            } elseif($row->h13 == 1) {
              $h13 = 0;
            } elseif($row->h13 == 2) {
              $h13 = 0;
            } elseif($row->h13 == 3) {
              $h13 = 0;
            } else {
              $h13 = 1;
            }

            if ($row->h14 <= 0) {
              $h14 = 0;
            } elseif($row->h14 == 1) {
              $h14 = 0;
            } elseif($row->h14 == 2) {
              $h14 = 0;
            } elseif($row->h14 == 3) {
              $h14 = 0;
            } else {
              $h14 = 1;
            }

            if ($row->h15 <= 0) {
              $h15 = 0;
            } elseif($row->h15 == 1) {
              $h15 = 0;
            } elseif($row->h15 == 2) {
              $h15 = 0;
            } elseif($row->h15 == 3) {
              $h15 = 0;
            } else {
              $h15 = 1;
            }

            if ($row->h16 <= 0) {
              $h16 = 0;
            } elseif($row->h16 == 1) {
              $h16 = 0;
            } elseif($row->h16 == 2) {
              $h16 = 0;
            } elseif($row->h16 == 3) {
              $h16 = 0;
            } else {
              $h16 = 1;
            }

            if ($row->h17 <= 0) {
              $h17 = 0;
            } elseif($row->h17 == 1) {
              $h17 = 0;
            } elseif($row->h17 == 2) {
              $h17 = 0;
            } elseif($row->h17 == 3) {
              $h17 = 0;
            } else {
              $h17 = 1;
            }

            if ($row->h18 <= 0) {
              $h18 = 0;
            } elseif($row->h18 == 1) {
              $h18 = 0;
            } elseif($row->h18 == 2) {
              $h18 = 0;
            } elseif($row->h18 == 3) {
              $h18 = 0;
            } else {
              $h18 = 1;
            }

            if ($row->h19 <= 0) {
              $h19 = 0;
            } elseif($row->h19 == 1) {
              $h19 = 0;
            } elseif($row->h19 == 2) {
              $h19 = 0;
            } elseif($row->h19 == 3) {
              $h19 = 0;
            } else {
              $h19 = 1;
            }

            if ($row->h20 <= 0) {
              $h20 = 0;
            } elseif($row->h20 == 1) {
              $h20 = 0;
            } elseif($row->h20 == 2) {
              $h20 = 0;
            } elseif($row->h20 == 3) {
              $h20 = 0;
            } else {
              $h20 = 1;
            }

            if ($row->h21 <= 0) {
              $h21 = 0;
            } elseif($row->h21 == 1) {
              $h21 = 0;
            } elseif($row->h21 == 2) {
              $h21 = 0;
            } elseif($row->h21 == 3) {
              $h21 = 0;
            } else {
              $h21 = 1;
            }

            if ($row->h22 <= 0) {
              $h22 = 0;
            } elseif($row->h22 == 1) {
              $h22 = 0;
            } elseif($row->h22 == 2) {
              $h22 = 0;
            } elseif($row->h22 == 3) {
              $h22 = 0;
            } else {
              $h22 = 1;
            }

            if ($row->h23 <= 0) {
              $h23 = 0;
            } elseif($row->h23 == 1) {
              $h23 = 0;
            } elseif($row->h23 == 2) {
              $h23 = 0;
            } elseif($row->h23 == 3) {
              $h23 = 0;
            } else {
              $h23 = 1;
            }

            if ($row->h24 <= 0) {
              $h24 = 0;
            } elseif($row->h24 == 1) {
              $h24 = 0;
            } elseif($row->h24 == 2) {
              $h24 = 0;
            } elseif($row->h24 == 3) {
              $h24 = 0;
            } else {
              $h24 = 1;
            }

            if ($row->h25 <= 0) {
              $h25 = 0;
            } elseif($row->h25 == 1) {
              $h25 = 0;
            } elseif($row->h25 == 2) {
              $h25 = 0;
            } elseif($row->h25 == 3) {
              $h25 = 0;
            } else {
              $h25 = 1;
            }

            if ($row->h26 <= 0) {
              $h26 = 0;
            } elseif($row->h26 == 1) {
              $h26 = 0;
            } elseif($row->h26 == 2) {
              $h26 = 0;
            } elseif($row->h26 == 3) {
              $h26 = 0;
            } else {
              $h26 = 1;
            }

            if ($row->h27 <= 0) {
              $h27 = 0;
            } elseif($row->h27 == 1) {
              $h27 = 0;
            } elseif($row->h27 == 2) {
              $h27 = 0;
            } elseif($row->h27 == 3) {
              $h27 = 0;
            } else {
              $h27 = 1;
            }

            if ($row->h28 <= 0) {
              $h28 = 0;
            } elseif($row->h28 == 1) {
              $h28 = 0;
            } elseif($row->h28 == 2) {
              $h28 = 0;
            } elseif($row->h28 == 3) {
              $h28 = 0;
            } else {
              $h28 = 1;
            }

            if ($row->h29 <= 0) {
              $h29 = 0;
            } elseif($row->h29 == 1) {
              $h29 = 0;
            } elseif($row->h29 == 2) {
              $h29 = 0;
            } elseif($row->h29 == 3) {
              $h29 = 0;
            } else {
              $h29 = 1;
            }

            if ($row->h30 <= 0) {
              $h30 = 0;
            } elseif($row->h30 == 1) {
              $h30 = 0;
            } elseif($row->h30 == 2) {
              $h30 = 0;
            } elseif($row->h30 == 3) {
              $h30 = 0;
            } else {
              $h30 = 1;
            }

            if ($row->h31 <= 0) {
              $h31 = 0;
            } elseif($row->h31 == 1) {
              $h31 = 0;
            } elseif($row->h31 == 2) {
              $h31 = 0;
            } elseif($row->h31 == 3) {
              $h31 = 0;
            } else {
              $h31 = 1;
            }


            ?>

          {{$h1 + $h2 + $h3 + $h4 + $h5 + $h6 + $h7 + $h8 + $h9 + $h10 + $h11 + $h12 + $h13 + $h14 + $h15 + $h16 + $h17 + $h18 + $h19 + $h20 + $h21 + $h22 + $h23 + $h24 + $h25 + $h26 + $h27 + $h28 + $h29 + $h30 + $h31 }}</td>
          <td align="center">

            <?php
            if ($row->h1 >= 0) {
              $h1 = 0;
            } else {
              $h1 = 1;
            }

            if ($row->h2 >= 0) {
              $h2 = 0;
            } else {
              $h2 = 1;
            }

            if ($row->h3 >= 0) {
              $h3 = 0;
            } else {
              $h3 = 1;
            }

            if ($row->h4 >= 0) {
              $h4 = 0;
            } else {
              $h4 = 1;
            }

            if ($row->h5 >= 0) {
              $h5 = 0;
            } else {
              $h5 = 1;
            }

            if ($row->h6 >= 0) {
              $h6 = 0;
            } else {
              $h6 = 1;
            }

            if ($row->h7 >= 0) {
              $h7 = 0;
            } else {
              $h7 = 1;
            }

            if ($row->h8 >= 0) {
              $h8 = 0;
            } else {
              $h8 = 1;
            }

            if ($row->h9 >= 0) {
              $h9 = 0;
            } else {
              $h9 = 1;
            }

            if ($row->h10 >= 0) {
              $h10 = 0;
            } else {
              $h10 = 1;
            }

            if ($row->h11 >= 0) {
              $h11 = 0;
            } else {
              $h11 = 1;
            }

            if ($row->h12 >= 0) {
              $h12 = 0;
            } else {
              $h12 = 1;
            }

            if ($row->h13 >= 0) {
              $h13 = 0;
            } else {
              $h13 = 1;
            }

            if ($row->h14 >= 0) {
              $h14 = 0;
            } else {
              $h14 = 1;
            }

            if ($row->h15 >= 0) {
              $h15 = 0;
            } else {
              $h15 = 1;
            }

            if ($row->h16 >= 0) {
              $h16 = 0;
            } else {
              $h16 = 1;
            }

            if ($row->h17 >= 0) {
              $h17 = 0;
            } else {
              $h17 = 1;
            }

            if ($row->h18 >= 0) {
              $h18 = 0;
            } else {
              $h18 = 1;
            }

            if ($row->h19 >= 0) {
              $h19 = 0;
            } else {
              $h19 = 1;
            }

            if ($row->h20 >= 0) {
              $h20 = 0;
            } else {
              $h20 = 1;
            }

            if ($row->h21 >= 0) {
              $h21 = 0;
            } else {
              $h21 = 1;
            }

            if ($row->h22 >= 0) {
              $h22 = 0;
            } else {
              $h22 = 1;
            }

            if ($row->h23 >= 0) {
              $h23 = 0;
            } else {
              $h23 = 1;
            }

            if ($row->h24 >= 0) {
              $h24 = 0;
            } else {
              $h24 = 1;
            }

            if ($row->h25 >= 0) {
              $h25 = 0;
            } else {
              $h25 = 1;
            }

            if ($row->h26 >= 0) {
              $h26 = 0;
            } else {
              $h26 = 1;
            }

            if ($row->h27 >= 0) {
              $h27 = 0;
            } else {
              $h27 = 1;
            }

            if ($row->h28 >= 0) {
              $h28 = 0;
            } else {
              $h28 = 1;
            }

            if ($row->h29 >= 0) {
              $h29 = 0;
            } else {
              $h29 = 1;
            }

            if ($row->h30 >= 0) {
              $h30 = 0;
            } else {
              $h30 = 1;
            }

            if ($row->h31 >= 0) {
              $h31 = 0;
            } else {
              $h31 = 1;
            }
            ?>

          {{$h1 + $h2 + $h3 + $h4 + $h5 + $h6 + $h7 + $h8 + $h9 + $h10 + $h11 + $h12 + $h13 + $h14 + $h15 + $h16 + $h17 + $h18 + $h19 + $h20 + $h21 + $h22 + $h23 + $h24 + $h25 + $h26 + $h27 + $h28 + $h29 + $h30 + $h31 }}</td>
          <td align="center">

            <?php
            if ($row->h1 == 0) {
              $h1 = 0;
            } elseif($row->h1 == 1) {
              $h1 = 0;
            } elseif($row->h1 == 2) {
              $h1 = 0;
            } elseif($row->h1 == 3) {
              $h1 = 0;
            } else {
              $h1 = 1;
            }

            if ($row->h2 == 0) {
              $h2 = 0;
            } elseif($row->h2 == 1) {
              $h2 = 0;
            } elseif($row->h2 == 2) {
              $h2 = 0;
            } elseif($row->h2 == 3) {
              $h2 = 0;
            } else {
              $h2 = 1;
            }

            if ($row->h3 == 0) {
              $h3 = 0;
            } elseif($row->h3 == 1) {
              $h3 = 0;
            } elseif($row->h3 == 2) {
              $h3 = 0;
            } elseif($row->h3 == 3) {
              $h3 = 0;
            } else {
              $h3 = 1;
            }

            if ($row->h4 == 0) {
              $h4 = 0;
            } elseif($row->h4 == 1) {
              $h4 = 0;
            } elseif($row->h4 == 2) {
              $h4 = 0;
            } elseif($row->h4 == 3) {
              $h4 = 0;
            } else {
              $h4 = 1;
            }

            if ($row->h5 == 0) {
              $h5 = 0;
            } elseif($row->h5 == 1) {
              $h5 = 0;
            } elseif($row->h5 == 2) {
              $h5 = 0;
            } elseif($row->h5 == 3) {
              $h5 = 0;
            } else {
              $h5 = 1;
            }

            if ($row->h6 == 0) {
              $h6 = 0;
            } elseif($row->h6 == 1) {
              $h6 = 0;
            } elseif($row->h6 == 2) {
              $h6 = 0;
            } elseif($row->h6 == 3) {
              $h6 = 0;
            } else {
              $h6 = 1;
            }

            if ($row->h7 == 0) {
              $h7 = 0;
            } elseif($row->h7 == 1) {
              $h7 = 0;
            } elseif($row->h7 == 2) {
              $h7 = 0;
            } elseif($row->h7 == 3) {
              $h7 = 0;
            } else {
              $h7 = 1;
            }

            if ($row->h8 == 0) {
              $h8 = 0;
            } elseif($row->h8 == 1) {
              $h8 = 0;
            } elseif($row->h8 == 2) {
              $h8 = 0;
            } elseif($row->h8 == 3) {
              $h8 = 0;
            } else {
              $h8 = 1;
            }

            if ($row->h9 == 0) {
              $h9 = 0;
            } elseif($row->h9 == 1) {
              $h9 = 0;
            } elseif($row->h9 == 2) {
              $h9 = 0;
            } elseif($row->h9 == 3) {
              $h9 = 0;
            } else {
              $h9 = 1;
            }

            if ($row->h10 == 0) {
              $h10 = 0;
            } elseif($row->h10 == 1) {
              $h10 = 0;
            } elseif($row->h10 == 2) {
              $h10 = 0;
            } elseif($row->h10 == 3) {
              $h10 = 0;
            } else {
              $h10 = 1;
            }

            if ($row->h11 == 0) {
              $h11 = 0;
            } elseif($row->h11 == 1) {
              $h11 = 0;
            } elseif($row->h11 == 2) {
              $h11 = 0;
            } elseif($row->h11 == 3) {
              $h11 = 0;
            } else {
              $h11 = 1;
            }

            if ($row->h12 == 0) {
              $h12 = 0;
            } elseif($row->h12 == 1) {
              $h12 = 0;
            } elseif($row->h12 == 2) {
              $h12 = 0;
            } elseif($row->h12 == 3) {
              $h12 = 0;
            } else {
              $h12 = 1;
            }

            if ($row->h13 == 0) {
              $h13 = 0;
            } elseif($row->h13 == 1) {
              $h13 = 0;
            } elseif($row->h13 == 2) {
              $h13 = 0;
            } elseif($row->h13 == 3) {
              $h13 = 0;
            } else {
              $h13 = 1;
            }

            if ($row->h14 == 0) {
              $h14 = 0;
            } elseif($row->h14 == 1) {
              $h14 = 0;
            } elseif($row->h14 == 2) {
              $h14 = 0;
            } elseif($row->h14 == 3) {
              $h14 = 0;
            } else {
              $h14 = 1;
            }

            if ($row->h15 == 0) {
              $h15 = 0;
            } elseif($row->h15 == 1) {
              $h15 = 0;
            } elseif($row->h15 == 2) {
              $h15 = 0;
            } elseif($row->h15 == 3) {
              $h15 = 0;
            } else {
              $h15 = 1;
            }

            if ($row->h16 == 0) {
              $h16 = 0;
            } elseif($row->h16 == 1) {
              $h16 = 0;
            } elseif($row->h16 == 2) {
              $h16 = 0;
            } elseif($row->h16 == 3) {
              $h16 = 0;
            } else {
              $h16 = 1;
            }

            if ($row->h17 == 0) {
              $h17 = 0;
            } elseif($row->h17 == 1) {
              $h17 = 0;
            } elseif($row->h17 == 2) {
              $h17 = 0;
            } elseif($row->h17 == 3) {
              $h17 = 0;
            } else {
              $h17 = 1;
            }

            if ($row->h18 == 0) {
              $h18 = 0;
            } elseif($row->h18 == 1) {
              $h18 = 0;
            } elseif($row->h18 == 2) {
              $h18 = 0;
            } elseif($row->h18 == 3) {
              $h18 = 0;
            } else {
              $h18 = 1;
            }

            if ($row->h19 == 0) {
              $h19 = 0;
            } elseif($row->h19 == 1) {
              $h19 = 0;
            } elseif($row->h19 == 2) {
              $h19 = 0;
            } elseif($row->h19 == 3) {
              $h19 = 0;
            } else {
              $h19 = 1;
            }

            if ($row->h20 == 0) {
              $h20 = 0;
            } elseif($row->h20 == 1) {
              $h20 = 0;
            } elseif($row->h20 == 2) {
              $h20 = 0;
            } elseif($row->h20 == 3) {
              $h20 = 0;
            } else {
              $h20 = 1;
            }

            if ($row->h21 == 0) {
              $h21 = 0;
            } elseif($row->h21 == 1) {
              $h21 = 0;
            } elseif($row->h21 == 2) {
              $h21 = 0;
            } elseif($row->h20 == 3) {
              $h21 = 0;
            } else {
              $h21 = 1;
            }

            if ($row->h22 == 0) {
              $h22 = 0;
            } elseif($row->h22 == 1) {
              $h22 = 0;
            } elseif($row->h22 == 2) {
              $h22 = 0;
            } elseif($row->h22 == 3) {
              $h22 = 0;
            } else {
              $h22 = 1;
            }

            if ($row->h23 == 0) {
              $h23 = 0;
            } elseif($row->h23 == 1) {
              $h23 = 0;
            } elseif($row->h3 == 2) {
              $h23 = 0;
            } elseif($row->h3 == 3) {
              $h23 = 0;
            } else {
              $h23 = 1;
            }

            if ($row->h24 == 0) {
              $h24 = 0;
            } elseif($row->h24 == 1) {
              $h24 = 0;
            } elseif($row->h24 == 2) {
              $h24 = 0;
            } elseif($row->h24 == 3) {
              $h24 = 0;
            } else {
              $h24 = 1;
            }

            if ($row->h25 == 0) {
              $h25 = 0;
            } elseif($row->h25 == 1) {
              $h25 = 0;
            } elseif($row->h25 == 2) {
              $h25 = 0;
            } elseif($row->h25 == 3) {
              $h25 = 0;
            } else {
              $h25 = 1;
            }

            if ($row->h26 == 0) {
              $h26 = 0;
            } elseif($row->h26 == 1) {
              $h26 = 0;
            } elseif($row->h26 == 2) {
              $h26 = 0;
            } elseif($row->h26 == 3) {
              $h26 = 0;
            } else {
              $h26 = 1;
            }

            if ($row->h27 == 0) {
              $h27 = 0;
            } elseif($row->h7 == 1) {
              $h27 = 0;
            } elseif($row->h27 == 2) {
              $h27 = 0;
            } elseif($row->h27 == 3) {
              $h27 = 0;
            } else {
              $h27 = 1;
            }

            if ($row->h28 == 0) {
              $h28 = 0;
            } elseif($row->h28 == 1) {
              $h28 = 0;
            } elseif($row->h28 == 2) {
              $h28 = 0;
            } elseif($row->h28 == 3) {
              $h28 = 0;
            } else {
              $h28 = 1;
            }

            if ($row->h29 == 0) {
              $h29 = 0;
            } elseif($row->h29 == 1) {
              $h29 = 0;
            } elseif($row->h29 == 2) {
              $h29 = 0;
            } elseif($row->h29 == 3) {
              $h29 = 0;
            } else {
              $h29 = 1;
            }

            if ($row->h30 == 0) {
              $h30 = 0;
            } elseif($row->h30 == 1) {
              $h30 = 0;
            } elseif($row->h30 == 2) {
              $h30 = 0;
            } elseif($row->h30 == 3) {
              $h30 = 0;
            } else {
              $h30 = 1;
            }

            if ($row->h31 == 0) {
              $h31 = 0;
            } elseif($row->h31 == 1) {
              $h31 = 0;
            } elseif($row->h31 == 2) {
              $h31 = 0;
            } elseif($row->h31 == 3) {
              $h31 = 0;
            } else {
              $h31 = 1;
            }

            ?>

          {{$h1 + $h2 + $h3 + $h4 + $h5 + $h6 + $h7 + $h8 + $h9 + $h10 + $h11 + $h12 + $h13 + $h14 + $h15 + $h16 + $h17 + $h18 + $h19 + $h20 + $h21 + $h22 + $h23 + $h24 + $h25 + $h26 + $h27 + $h28 + $h29 + $h30 + $h31 }}</td>
        </tr>
        <?php $no++; ?>
        @endforeach
      </tbody>
    </table>
  </div><hr>
  <div class="alert alert-info">
    <strong>KETERANGAN</strong>
    <ul>
      <li>Centang Hijau : Berangkat On Time</li>
      <li>T Merah : Berangkat Terlambat</li>
      <li>Kolom Ungu : Tidak Hadir</li>
      <li>S : Total Sakit</li>
      <li>I : Total Ijin</li>
      <li>A : Total Alfa</li>
      <li>T : Total Terlambat</li>
      <li>O : Total On Time</li>
      <li>B : Total Berangkat</li>
    </ul>
</div>
</div>
</div>
</div>
<script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
<script src="{{asset('assets/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/js/dataTables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('assets/js/custom.js')}}"></script>
@endsection