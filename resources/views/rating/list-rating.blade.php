<h2>Danh sách đánh giá Stylist</h2>
<table border="1">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên nhân viên</th>
            <th>Điểm</th>
            <th>Nội dung</th>
            <th>Đã đánh giá</th>
            <th>Có thể sửa</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_ratings as $key => $item)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $array_slylist_name[$item->stylist_id] }}</td>
                <td></td>
                <td></td>
                <td>{{ $item->is_rating == 0 ? 'Chưa đánh giá' : 'Đã đánh giá' }}</td>
                <td>{{ $item->can_edit == 0 ? 'Chưa đánh giá' : 'Đã đánh giá' }}</td>
                <td>
                    <a href="{{ route('dashboard.rating.rating', ['detail_rating_id' => $item->id]) }}">Đánh giá</a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
