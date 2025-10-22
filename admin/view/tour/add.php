<h2>Thêm tour mới</h2>
<form method="POST">
    <label>Tên tour:</label>
    <input type="text" name="name" required><br>

    <label>Giá:</label>
    <input type="number" name="price" required><br>

    <label>Ngày:</label>
    <input type="text" name="day" required><br>

    <label>Đánh giá:</label>
    <input type="number" step="0.1" name="rating" required><br>

    <label>Thông tin:</label><br>
    <textarea name="info" rows="5" cols="40"></textarea><br>

    <button type="submit">Lưu</button>
</form>
