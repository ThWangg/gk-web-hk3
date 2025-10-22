<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vietnam Tour</title>
    <!-- Font Awesome Free CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../controller/index.css">
</head>

<body>

    <?php require_once('header.php'); ?>

    <!-- carousel banner -->
    <div id="carouselExample" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../upload/image/carousel1.webp" class="d-block w-100 carousel-img" alt="...">
            </div>

            <div class="carousel-item">
                <img src="../upload/image/carousel2.jpg" class="d-block w-100 carousel-img" alt="...">
            </div>

            <div class="carousel-item">
                <img src="../upload/image/carousel3.jpg" class="d-block w-100 carousel-img" alt="...">
            </div>
        </div>

        <!-- overlay trên ảnh -->
        <div class="carousel-overlay"></div>

        <!-- text trên ảnh -->
        <div class="carousel-text">
            <h1 class="text-center">Khám phá Việt Nam</h1>
            <h3>Bắt đầu chuyến đi tuyệt vời cùng VietNamTourist</h3>
            <button class="btn-book">
                Đặt tour ngay
                <div class="arrow"><i class="bi bi-suitcase2-fill"></i></div>
            </button>

        </div>

        <!-- prev-next -->
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
        </button>
    </div>

    <!-- intro -->
    <section class="container mt-5 mb-5">
        <div class="text-center">
            <h2 class="fw-bold mb-3">Chào mừng đến với <span class="text-success">VietnamTourist</span></h2>
            <p class="lead text-muted">
                VietnamTourist tự hào là công ty du lịch hàng đầu, đồng hành cùng bạn khám phá trọn vẹn vẻ đẹp Việt Nam từ Bắc
                chí Nam.
            </p>
        </div>

        <div class="row text-center mt-4">
            <div class="col-md-4">
                <img src="../upload/image/chua1cot.jpg" width="100" alt="Travel" style="border-radius: 50%;">
                <h5 class="mt-3">Miền Bắc</h5>
                <p>Trải nghiệm những cao nguyên hùng vĩ, bản làng văn hóa độc đáo, và vịnh Hạ Long – kỳ quan thiên nhiên nổi
                    tiếng thế giới.</p>
            </div>
            <div class="col-md-4">
                <img src="../upload/image/mientrung.jpg" width="100" alt="Plane" style="border-radius: 50%;">
                <h5 class=" mt-3">Miền Trung</h5>
                <p>Thưởng ngoạn các bãi biển tuyệt đẹp ở Đà Nẵng, Hội An cổ kính, Huế mộng mơ và những cung đường biển tuyệt
                    hảo.</p>
            </div>
            <div class="col-md-4">
                <img src="../upload/image/miennam.png" width="100" alt="Support" style="border-radius: 50%;">
                <h5 class=" mt-3">Miền Nam</h5>
                <p>Khám phá miền sông nước miền Tây với chợ nổi sôi động, rừng tràm Tràm Chim, và thành phố Hồ Chí Minh hiện
                    đại, nhộn nhịp.</p>
            </div>
        </div>
    </section>
    <!-- vé du lịch -->
    <section class="ticket-section py-5">
        <div class="container text-center mb-4">
            <h2 class="section-title">Các Tour nổi bật</h2>
        </div>

        <?php
        require_once '../model/tour.php';
        $tourModel = new Tour();
        $tours = $tourModel->getLimitTours(6);
        ?>

        <div class="container">
            <div class="row g-4">
                <?php foreach ($tours as $tour): ?>
                    <div class="col-md-4">
                        <div class="ticket-card position-relative overflow-hidden">
                            <a href="tour_detail.php?id=<?= $tour['id'] ?>" class="text-decoration-none text-white">
                                <img src="../upload/image/<?= htmlspecialchars($tour['image']) ?>"
                                    alt="<?= htmlspecialchars($tour['name']) ?>"
                                    class="ticket-img w-100 rounded"
                                    style="height: 230px; object-fit: cover;">
                                <div class="ticket-overlay position-absolute bottom-0 start-0 w-100 p-3 bg-dark bg-opacity-50">
                                    <p class="text-left mb-1 fw-bold"><?= htmlspecialchars($tour['name']) ?></p>
                                    <p class="text-right mb-0">Giá từ <?= number_format($tour['price'], 0, ',', '.') ?>đ</p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>


    <?php
    require_once '../model/post.php';
    $postModel = new Post();
    $posts = $postModel->getAllPosts();
    ?>
    <!-- đăng bài -->
    <section class="container my-5">
        <h2 class="fw-bold mb-4 text-center text-uppercase">Các bài viết nổi bật</h2>

        <?php if (empty($posts)): ?>
            <div class="text-center text-muted">No posts available.</div>
        <?php else: ?>
            <div class="row justify-content-center">
                <?php foreach ($posts as $post): ?>
                    <div class="col-md-8 mb-4">
                        <div class="p-3 border bg-light">
                            <a href="post.php?id=<?php echo $post['id']; ?>" class="text-decoration-none">
                                <div class="d-flex">
                                    <img src="../uploads/<?php echo htmlspecialchars($post['image'] ?? 'default.jpg'); ?>" alt="Post image"
                                        style="width: 180px; height: 150px; object-fit: cover; margin-right: 15px;">
                                    <div>
                                        <h4 class="text-primary fw-bold mb-2">
                                            <?php echo htmlspecialchars($post['title']); ?>
                                        </h4>
                                        <p class="text-muted small mb-2">
                                            <?php
                                            echo !empty($post['content'])
                                                ? mb_strimwidth(htmlspecialchars($post['content']), 0, 150, '...')
                                                : '<i>No content available.</i>';
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </a>
                            <hr class="mt-3 mb-2">
                            <p class="text-end text-muted small mb-0">
                                posted by <strong><?php echo htmlspecialchars($post['author'] ?? 'Admin'); ?></strong>
                            </p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const carousel = document.querySelector('#carouselExample');
    const carouselInstance = new bootstrap.Carousel(carousel, {
        interval: 5000, // tự động 5s
        ride: 'carousel'
    });
</script>

</html>