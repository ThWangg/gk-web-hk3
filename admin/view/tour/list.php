<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Danh sách tour</title>

  <style>

    h2 {
      text-align: center;
      color: #0f172a;
      margin-bottom: 20px;
      font-size: 1.6rem;
    }

    .btn {
      display: inline-block;
      padding: 10px 16px;
      border-radius: 8px;
      text-decoration: none;
      font-size: 0.95rem;
      transition: all 0.2s ease;
      cursor: pointer;
    }

    .btn-primary {
      background: green;
      color: #fff;
      margin-bottom: 18px;
    }

    .btn-primary:hover {
      transform: translateY(-1px);
      box-shadow: 0 6px 16px rgba(59,130,246,0.35);
    }

    /* Table styling */
    table {
      width: 100%;
      border-collapse: collapse;
      background: #ffffff;
      border-radius: 12px;
      overflow: hidden;
      box-shadow: 0 4px 16px rgba(0,0,0,0.06);
    }

    th, td {
      padding: 14px 16px;
      text-align: left;
      border-bottom: 1px solid #e5e7eb;
    }

    th {
      background-color: #f3f4f6;
      font-weight: 600;
      color: #111827;
      text-transform: uppercase;
      font-size: 0.85rem;
      letter-spacing: 0.5px;
    }

    tr:hover td {
      background-color: #f9fafb;
    }

    td {
      font-size: 0.95rem;
    }

    /* Action links */
    td a {
      color: #2563eb;
      text-decoration: none;
      font-weight: 500;
    }

    td a:hover {
      text-decoration: underline;
    }

    /* Price column style */
    td:nth-child(3) {
      color: #047857;
      font-weight: 600;
    }

    /* Responsive */
    @media (max-width: 768px) {
      body {
        padding: 16px;
      }

      table, thead, tbody, th, td, tr {
        display: block;
      }

      thead {
        display: none;
      }

      tr {
        margin-bottom: 12px;
        background: #fff;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        padding: 10px;
      }

      td {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        border: none;
        border-bottom: 1px solid #f3f4f6;
      }

      td:last-child {
        border-bottom: none;
      }

      td::before {
        content: attr(data-label);
        font-weight: 600;
        color: #374151;
      }
    }
  </style>
</head>

<body>
  <h2>Danh sách tour</h2>
  <a href="index.php?page=tour_add" class="btn btn-primary">+ Thêm tour mới</a>

  <table>
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên tour</th>
        <th>Giá</th>
        <th>Ngày</th>
        <th>Đánh giá</th>
        <th>Thao tác</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($tours as $tour): ?>
      <tr>
        <td data-label="ID"><?= $tour['id'] ?></td>
        <td data-label="Tên tour"><?= htmlspecialchars($tour['name']) ?></td>
        <td data-label="Giá"><?= number_format($tour['price']) ?>đ</td>
        <td data-label="Ngày"><?= htmlspecialchars($tour['day']) ?></td>
        <td data-label="Đánh giá"><?= htmlspecialchars($tour['rating']) ?></td>
        <td data-label="Thao tác">
          <a href="index.php?page=tour_edit&id=<?= $tour['id'] ?>">Sửa</a> |
          <a href="controller/tour_delete.php?id=<?= $tour['id'] ?>" onclick="return confirm('Xóa tour này?')">Xóa</a>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
