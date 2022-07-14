<form action="" method="POST">
    @csrf
    <div>
        <label for="">Họ</label>
        <input type="text" name="last_name">
    </div>
    <div>
        <label for="">Tên</label>
        <input type="text" name="first_name">
    </div>
    <div>
        <label for="">Email</label>
        <input type="email" name="email">
    </div>
    <div>
        <label for="">Số điện thoại</label>
        <input type="number" name="phone">
    </div>
    <div>
        <label for="">Giới tính</label>
        <select name="gender">
            <option value="">Chọn giới tính</option>
            <option value="1">Nam</option>
            <option value="2">Nữ</option>
        </select>
    </div>
    <div>
        <label for="">Ngày sinh</label>
        <input type="date" name="dob">
    </div>
    <div>
        <label for="">Trạng thái</label>
        <select name="status">
            <option value="">Chọn trạng thái</option>
            <option value="0">Không hoạt động</option>
            <option value="1">Đang hoạt động</option>
        </select>
    </div>
    <div>
        <button type="submit">Đăng ký</button>
    </div>
</form>
