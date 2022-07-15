<form action="" method="POST">
    @csrf
    <div>
        <label for="">Họ</label>
        <input type="text" name="last_name" value="{{ $model->last_name }}">
    </div>
    <div>
        <label for="">Tên</label>
        <input type="text" name="first_name" value="{{ $model->first_name }}">
    </div>
    <div>
        <label for="">Email</label>
        <input type="email" name="email" value="{{ $model->email }}">
    </div>
    <div>
        <label for="">Số điện thoại</label>
        <input type="number" name="phone" value="{{ $model->phone }}">
    </div>
    <div>
        <label for="">Giới tính</label>
        <select name="gender">
            <option value="">Chọn giới tính</option>
            <option value="1" @if ($model->gender == 1) echo "selected" @endif>Nam</option>
            <option value="2" @if ($model->gender == 2) echo "selected" @endif>Nữ</option>
        </select>
    </div>
    <div>
        <label for="">Ngày sinh</label>
        <input type="date" name="dob" value="{{ date('Y-m-d', strtotime($model->dob)) }}">
    </div>
    <div>
        <label for="">Trạng thái</label>
        <select name="status">
            <option value="">Chọn trạng thái</option>
            <option value="0" @if ($model->gender == 0) echo "selected" @endif>Không hoạt động</option>
            <option value="1" @if ($model->gender == 1) echo "selected" @endif>Đang hoạt động</option>
        </select>
    </div>
    <div>
        <button type="submit">Đăng ký</button>
    </div>
</form>
