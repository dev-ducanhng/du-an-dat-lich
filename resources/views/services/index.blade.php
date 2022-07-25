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
<table class="table" border="1">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Tên</th>
        <th scope="col">Trạng thái</th>
        <th scope="col">Gía tiền</th>
        <th scope="col">Khuyến mãi</th>
        <th scope="col">Ảnh</th>
        <th><a href="{{route('service.add')}}">Thêm mới</a></th>
      </tr>
    </thead>
    <tbody>

    @foreach ($models as $item)
    <tr>
        <th scope="row">{{$item->id}}</th>
        <td>{{$item->name}}</td>
        <td>{{$item->status}}</td>
        <td>{{$item->price}}</td>
        <td>{{$item->discount}}</td>
        <td>{{$item->image}}</td>
        <td>
            <a href="{{route('service.edit', ['id' => $item->id])}}" >Sửa</a>

        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
