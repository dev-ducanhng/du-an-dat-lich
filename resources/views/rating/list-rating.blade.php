<h2>Danh sách đánh giá Stylist</h2>
<table border="1">
    <thead>
        <tr>
            <th>STT</th>
            <th>Tên nhân viên</th>
            <th>Điểm</th>
            <th>Bạn đã đánh giá chưa?</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($all_stylist as $item)
            <tr>
                <td>{{ $item['stt'] }}</td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['rating'] }}</td>
                <td>{{ $item['is_rating'] == 0 ? 'Bạn chưa đánh giá' : 'Bạn đã đánh giá' }}</td>
                <td>
                    @if ($item['is_rating'] == 0)
                        <a
                            href="{{ route('dashboard.rating.rating', ['detail_rating_id' => $item['detail_rating_id']]) }}">Sửa</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
