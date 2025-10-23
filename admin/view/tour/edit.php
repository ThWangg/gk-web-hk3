<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sửa tour</title>
  <style>
    /* Tổng thể form */
    .form-wrapper {
      max-width: 700px;
      margin: 40px auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(8, 20, 40, 0.08);
      padding: 28px;
      font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      color: #1f2937;
    }

    h2 {
      text-align: center;
      margin-bottom: 24px;
      font-size: 1.5rem;
      color: #0f172a;
    }

    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 16px 20px;
    }

    .form-grid--full {
      grid-column: 1 / -1;
    }

    label {
      display: block;
      font-size: 0.9rem;
      font-weight: 500;
      color: #374151;
      margin-bottom: 6px;
    }

    input[type="text"],
    input[type="number"],
    textarea {
      width: 100%;
      box-sizing: border-box;
      padding: 10px 12px;
      border: 1px solid #d1d5db;
      border-radius: 8px;
      font-size: 0.95rem;
      background: #fbfdff;
      transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    input:focus,
    textarea:focus {
      outline: none;
      border-color: #3b82f6;
      box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
    }

    textarea {
      min-height: 120px;
      resize: vertical;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 20px;
    }

    .btn {
      padding: 10px 16px;
      border-radius: 10px;
      font-size: 0.95rem;
      cursor: pointer;
      border: none;
      transition: all 0.2s ease;
    }

    .btn--primary {
      background: linear-gradient(90deg,#2563eb,#3b82f6);
      color: #fff;
      box-shadow: 0 4px 12px rgba(59,130,246,0.2);
    }

    .btn--primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 18px rgba(59,130,246,0.25);
    }

    .btn--secondary {
      background: #f3f4f6;
      color: #374151;
      border: 1px solid #e5e7eb;
    }

    .btn--secondary:hover {
      background: #e5e7eb;
    }

    @media (max-width: 600px) {
      .form-grid {
        grid-template-columns: 1fr;
      }
      .form-wrapper {
        margin: 20px;
        padding: 18px;
      }
    }
  </style>
</head>

<body>
  <div class="form-wrapper">
    <h2>Sửa tour</h2>
    <form method="POST">
      <div class="form-grid">
        <div>
          <label for="name">Tên tour:</label>
          <input type="text" id="name" name="name" value="<?= htmlspecialchars($tour['name']) ?>" required>
        </div>

        <div>
          <label for="price">Giá (VND):</label>
          <input type="number" id="price" name="price" value="<?= $tour['price'] ?>" required>
        </div>

        <div>
          <label for="day">Ngày:</label>
          <input type="text" id="day" name="day" value="<?= htmlspecialchars($tour['day']) ?>" required>
        </div>

        <div>
          <label for="rating">Đánh giá (0.0 - 5.0):</label>
          <input type="number" id="rating" step="0.1" min="0" max="5" name="rating" value="<?= $tour['rating'] ?>" required>
        </div>

        <div class="form-grid--full">
          <label for="info">Thông tin:</label>
          <textarea id="info" name="info" rows="5" cols="40"><?= htmlspecialchars($tour['info']) ?></textarea>
        </div>
      </div>

      <div class="form-actions">
        <button type="button" class="btn btn--secondary" onclick="history.back()">Hủy</button>
        <button type="submit" class="btn btn--primary">Cập nhật</button>
      </div>
    </form>
  </div>
</body>
</html>
