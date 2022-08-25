<form action="" method="POST">
    @csrf
    <div>
        <label for="">Tên Stylist</label>
        <input type="text" name="stylist_id" value="{{ $array_slylist_name[$booking->stylist] }}" disabled>
    </div>
    <div>
        <label for="">Số điện thoại</label>
        <input type="text" name="phone" value="{{ $array_stylist_phone[$booking->stylist] }}" disabled>
    </div>
    <div>
        <label for="">Điểm</label>
        <input type="number" name="rating">
    </div>
    <div>
        <label for="">Ghi chú</label>
        <textarea name="content" id="" cols="30" rows="10"></textarea>
    </div>
    <div>
        <button type="submit">Đánh giá</button>
    </div>
</form>
