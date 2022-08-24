@extends('layouts.dashboard')
@section('content')
<form action="" method="GET">
    @csrf
    Tên dịch vụ: <input type="text" name="name"><br>
    <label for="">Sắp xếp theo giá</label>
    <select name="order_by">

            <option value="asc">Tăng dần</option>
            <option value="desc">Giảm dần</option>
        </select>
        <br>

     <button type="submit">TÌM KIẾM</button>

 </form>

  <main>
    <div class="container-fluid disable-text-selection">
      <div class="row">
        <div class="col-12">
            <div class="mb-3">

                    <div class="text-zero top-right-button-container">
                        <a href="{{route('dashboard.service.add')}}"  class="btn btn-primary btn-lg top-right-button mr-1 text-white">Thêm dịch vụ</a>
                    </div>

            </div>

            <div class="mb-2">
                <div class="collapse d-md-block" id="displayOptions">
                    <form action="">
                        <div class="d-block d-md-inline-block">
                            <div class="search-sm d-inline-block float-md-left mr-1 mb-1 align-top">
                                <input name="name" placeholder="Search..." >
                            </div>
                            <div class="d-inline-block float-md-left mr-1 mb-1 align-top">
                                <button class="text-white outline-0 border-0"
                                        style="padding: 4px 35px; border-radius: 20px; background-color: #ed7117"
                                        type="submit">Lọc</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
    <div class="col-lg-12 col-md-12 mb-4">
      <div class="card">
          <div class="card-body">
              <h5 class="card-title">Striped Rows</h5>

              <table class="table table-striped">
                  <thead>
                      <tr>
                          <th scope="col">#</th>
                          <th scope="col">Ảnh</th>
                          <th scope="col">Tên</th>
                          <th scope="col">Giá tiền</th>
                          <th scope="col">Giảm giá</th>
                          <th scope="col">Trạng thái</th>
                          <th><a class="btn-btn" href="{{ route('dashboard.service.add') }}">Thêm mới</a></th>
                      </tr>
                  </thead>
                  <tbody>

                    @foreach ($models as $item)
                    <tr>
                      <th scope="row">{{$item->id}}</th>
                      <td><img src="{{$item->image}}" alt="{{$item->name}}" width="200px"> </td>
                      <td>{{$item->name}}</td>
                      <td>{{$item->price}}</td>
                      <td>{{$item->discount}}</td>
                      <td>{{$item->status}}</td>
                      <td><a href="{{route('dashboard.service.edit', ['id' => $item->id])}}">Sửa</a></td>
                  </tr>
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
  </div>
  <div class="mt-2">

</div>
</main>
  @endsection
