<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên</label>
        <input type="text" name="name" >
        @error('name')
                    <p class="text-danger">{{$message}}</p>
        @enderror
    </div>
    <div>
        <label for="">Gía</label>
        <input type="text" name="price">
        @error('price')
        <p class="text-danger">{{$message}}</p>
@enderror
    </div>
    <div>
        <label for="">Gía giảm</label>
        <input type="text" name="discount" >
        @error('discount')
        <p class="text-danger">{{$message}}</p>
@enderror
    </div>
    <div>
        <label for="">trạng thái</label>
        
        <select name="status" >
            <option value="">Chọn trạng thai</option>
            <option value="0">Không kích hoạt</option>
            <option value="1">Kích hoạt</option>
            @error('status')
            <p class="text-danger">{{$message}}</p>
    @enderror
        </select>
    </div>
    <button type="submit">OK</button>
</form>