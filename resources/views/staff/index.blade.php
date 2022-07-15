<h2>Danh sách nhân viên</h2>
<table border="1">
    <thead>
        <tr>
            <th>STT</th>
            <th>Họ tên</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th>Giới tính</th>
            <th>Ngày sinh</th>
            <th>Avatar</th>
            <th>Trạng thái</th>
            <th>Ngày tạo tài khoản</th>
            <th>
                <a href="{{ route('staff.add') }}">Thêm mới</a>
            </th>
        </tr>
    </thead>
    <tbody>
        @foreach ($staffs as $key => $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $item->last_name . ' ' . $item->first_name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->phone }}</td>
                <td>{{ $item->gender == 1 ? 'Nam' : 'Nữ' }}</td>
                <td>{{ date('d/m/Y', strtotime($item->dob)) }}</td>
                <td>
                    <img src="{{ asset($item->avatar) }}" alt="avatar">
                </td>
                <td>{{ $item->status == 1 ? 'Đang hoạt động' : 'Không hoạt động' }}</td>
                <td>{{ date('d/m/Y H:i', strtotime($item->created_at)) }}</td>
                <td>
                    <a href="{{ route('staff.edit', ['id' => $item->id]) }}">Sửa</a>
                    <a href="{{ route('staff.remove', ['id' => $item->id]) }}">Xóa</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
