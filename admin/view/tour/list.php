<h2>Danh sách tour</h2>
<a href="index.php?page=tour_add" class="btn btn-primary">+ Thêm tour mới</a>
<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>Tên tour</th>
        <th>Giá</th>
        <th>Ngày</th>
        <th>Đánh giá</th>
        <th>Thao tác</th>
    </tr>

    <?php foreach ($tours as $tour): ?>
    <tr>
        <td><?= $tour['id'] ?></td>
        <td><?= htmlspecialchars($tour['name']) ?></td>
        <td><?= number_format($tour['price']) ?>đ</td>
        <td><?= htmlspecialchars($tour['day']) ?></td>
        <td><?= htmlspecialchars($tour['rating']) ?></td>
        <td>
            <a href="index.php?page=tour_edit&id=<?= $tour['id'] ?>">Sửa</a> |
            <a href="controller/tour_delete.php?id=<?= $tour['id'] ?>" onclick="return confirm('Xóa tour này?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>