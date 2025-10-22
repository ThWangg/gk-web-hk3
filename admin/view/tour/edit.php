<h2>Sửa tour</h2>
<form method="POST">
    <label>Tên tour:</label>
    <input type="text" name="name" value="<?= htmlspecialchars($tour['name']) ?>" required><br>

    <label>Giá:</label>
    <input type="number" name="price" value="<?= $tour['price'] ?>" required><br>

    <label>Ngày:</label>
    <input type="text" name="day" value="<?= htmlspecialchars($tour['day']) ?>" required><br>

    <label>Đánh giá:</label>
    <input type="number" step="0.1" name="rating" value="<?= $tour['rating'] ?>" required><br>

    <label>Thông tin:</label><br>
    <textarea name="info" rows="5" cols="40"><?= htmlspecialchars($tour['info']) ?></textarea><br>

    <button type="submit">Cập nhật</button>
</form>
