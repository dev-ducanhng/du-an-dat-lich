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
        @foreach ($list_ratings as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td>{{ $array_stylists_name[$item->stylist] }}</td>
                <td>{{ isset($item->rating) ? $item->rating : 'Chưa đánh giá' }}</td>
                <td>{{ isset($item->rating) ? 'Đã đánh giá' : 'Chưa đánh giá' }}</td>
                <td>
                    @if (!isset($item->rating))
                        <a href="{{ route('rating.rating', ['booking_id' => $item->id]) }}">Đánh giá</a>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
