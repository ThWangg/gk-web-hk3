<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vietnam Tour</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <?php require_once('header.php'); ?>

    <!-- Carousel -->
    <div id="vietnamCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#vietnamCarousel" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#vietnamCarousel" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#vietnamCarousel" data-bs-slide-to="2"></button>
        </div>

        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1551334787-21e6bd3ab135" class="d-block w-100" alt="Ha Long Bay" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-2">
                    <h5>Hạ Long Bay</h5>
                    <p>Vịnh Hạ Long - kỳ quan thiên nhiên thế giới.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1586769852836-bc069f19e1fd" class="d-block w-100" alt="Hoi An" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-2">
                    <h5>Hội An</h5>
                    <p>Phố cổ Hội An - di sản văn hoá thế giới.</p>
                </div>
            </div>

            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1543248939-ff40856f65d4" class="d-block w-100" alt="Sapa" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block bg-dark bg-opacity-50 rounded-3 p-2">
                    <h5>Sapa</h5>
                    <p>Vẻ đẹp hùng vĩ của núi rừng Tây Bắc.</p>
                </div>
            </div>
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#vietnamCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#vietnamCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- intro -->
    <section class="container mt-5 mb-5">
        <div class="text-center">
            <h2 class="fw-bold mb-3">Welcome to <span class="text-success">VietnamTourist</span></h2>
            <p class="lead text-muted">
                VietnamTourist tự hào là công ty du lịch hàng đầu, mang đến cho bạn những chuyến đi tuyệt vời khám phá vẻ đẹp của Việt Nam.
                Từ những bãi biển tuyệt đẹp ở Đà Nẵng đến cao nguyên hùng vĩ ở Tây Bắc - hãy để chúng tôi đồng hành cùng bạn!
            </p>
        </div>

        <div class="row text-center mt-4">
            <div class="col-md-4">
                <img src="https://cdn-icons-png.flaticon.com/512/201/201623.png" width="70" alt="Travel">
                <h5 class="mt-3">Tour Trong Nước</h5>
                <p>Khám phá mọi miền Tổ quốc với các gói tour hấp dẫn và giá ưu đãi.</p>
            </div>
            <div class="col-md-4">
                <img src="https://cdn-icons-png.flaticon.com/512/854/854878.png" width="70" alt="Plane">
                <h5 class="mt-3">Tour Nước Ngoài</h5>
                <p>Trải nghiệm hành trình quốc tế đẳng cấp, dịch vụ tận tâm.</p>
            </div>
            <div class="col-md-4">
                <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="70" alt="Support">
                <h5 class="mt-3">Hỗ Trợ 24/7</h5>
                <p>Đội ngũ tư vấn viên sẵn sàng hỗ trợ bạn mọi lúc, mọi nơi.</p>
            </div>
        </div>
    </section>
</body>

</html>
