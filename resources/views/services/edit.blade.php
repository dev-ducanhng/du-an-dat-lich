<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên</label>
        <input type="text" name="name" value="{{$model->name}}">
        @error('name')
                    <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="">Gía</label>
        <input type="text" name="price" value="{{$model->price}}">
        @error('price')
                    <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="">Khuyến mãi</label>
        <input type="text" name="discount" value="{{$model->discount}}">
        @error('discount')
        <p class="text-danger">{{$message}}</p>
@enderror
    </div>
    <div>
        <label for="">trạng thái</label>
        <input type="text" name="status" value="{{$model->status}}">
        @error('status')
        <p class="text-danger">{{$message}}</p>
@enderror
    </div>
    <button type="submit">OK</button>
</form>