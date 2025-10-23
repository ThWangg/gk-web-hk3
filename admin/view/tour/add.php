<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Thêm tour mới</title>

  <style>
    /* Container */
    .form-wrapper {
      max-width: 700px;
      margin: 32px auto;
      background: #ffffff;
      border-radius: 12px;
      box-shadow: 0 6px 20px rgba(8, 20, 40, 0.08);
      padding: 28px;
      font-family: "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
      color: #1f2937;
    }

    h2 {
      margin: 0 0 18px;
      font-size: 1.5rem;
      letter-spacing: -0.2px;
      color: #0f172a;
    }

    /* Grid layout for fields */
    .form-grid {
      display: grid;
      grid-template-columns: 1fr 1fr;
      gap: 14px 18px;
      margin-bottom: 14px;
    }

    /* Make textarea full width under grid */
    .form-grid--full {
      grid-column: 1 / -1;
    }

    label {
      display: block;
      font-size: 0.9rem;
      margin-bottom: 6px;
      color: #374151;
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
      transition: border-color .15s ease, box-shadow .15s ease;
    }

    input:focus,
    textarea:focus {
      outline: none;
      border-color: #60a5fa;
      box-shadow: 0 6px 18px rgba(96, 165, 250, 0.12);
    }

    textarea {
      min-height: 120px;
      resize: vertical;
    }

    .form-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
      margin-top: 12px;
    }

    .btn {
      padding: 10px 16px;
      border-radius: 10px;
      font-size: 0.95rem;
      cursor: pointer;
      border: none;
    }

    .btn--primary {
      background: linear-gradient(90deg,#2563eb,#3b82f6);
      color: #fff;
      box-shadow: 0 6px 18px rgba(59,130,246,0.18);
      transition: transform .08s ease, box-shadow .12s ease;
    }

    .btn--primary:active {
      transform: translateY(1px);
    }

    .btn--secondary {
      background: transparent;
      border: 1px solid #e5e7eb;
      color: #374151;
    }

    /* Small screens */
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
    <h2>Thêm tour mới</h2>

    <form method="POST" novalidate>
      <div class="form-grid">
        <div>
          <label for="name">Tên tour:</label>
          <input id="name" type="text" name="name" required>
        </div>

        <div>
          <label for="price">Giá (VND):</label>
          <input id="price" type="number" name="price" required>
        </div>

        <div>
          <label for="day">Ngày (ví dụ: 3 ngày 2 đêm):</label>
          <input id="day" type="text" name="day" required>
        </div>

        <div>
          <label for="rating">Đánh giá (0.0 - 5.0):</label>
          <input id="rating" type="number" step="0.1" min="0" max="5" name="rating" required>
        </div>

        <div class="form-grid--full">
          <label for="info">Thông tin:</label>
          <textarea id="info" name="info" rows="5" cols="40" placeholder="Mô tả chi tiết, lịch trình, điểm nổi bật..."></textarea>
        </div>
      </div>

      <div class="form-actions">
        <button type="reset" class="btn btn--secondary">Xóa</button>
        <button type="submit" class="btn btn--primary">Lưu</button>
      </div>
    </form>
  </div>
</body>
</html>
