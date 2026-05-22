<?php
include 'config.php';
$cartCount = array_sum($_SESSION['cart']);
$isLoggedIn = isset($_SESSION['user_id']);
$isAdmin = ($isLoggedIn && $_SESSION['role'] === 'admin');
$username = $_SESSION['username'] ?? '';
// دریافت ۴ محصول جدید
$stmt = $pdo->query("SELECT * FROM products ORDER BY id DESC LIMIT 4");
$featured = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>چرم کومت | لوکس‌ترین محصولات چرمی</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="leather-pattern"></div>

<header class="glass-header" id="header">
    <div class="container">
        <nav>
            <div class="logo"><i class="fas fa-crown"></i> چرم کومت</div>
            <ul class="nav-links" id="navLinks">
                <li><a href="index.php">خانه</a></li>
                <li><a href="shop.php">محصولات</a></li>
                <?php if($isAdmin): ?>
                    <li><a href="admin/products.php">مدیریت محصولات</a></li>
                    <li><a href="admin/categories.php">دسته‌بندی</a></li>
                <?php endif; ?>
                <li><a href="cart.php"><i class="fas fa-shopping-bag"></i> سبد (<span id="cartCount"><?= $cartCount ?></span>)</a></li>
            </ul>
            <div class="user-menu">
                <?php if($isLoggedIn): ?>
                    <div class="dropdown">
                        <span class="user-name"><i class="fas fa-user"></i> <?= htmlspecialchars($username) ?></span>
                        <div class="dropdown-content">
                            <a href="logout.php">خروج</a>
                        </div>
                    </div>
                <?php else: ?>
                    <a href="login.php">ورود</a>
                    <a href="register.php">عضویت</a>
                <?php endif; ?>
            </div>
            <div class="menu-toggle" id="mobileMenu"><i class="fas fa-bars"></i></div>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="hero-content">
        <span class="gold-text">هارمونی هنر و چرم</span>
        <h1>زیبایی که <span class="gold-text">لمس</span> می‌کنی</h1>
        <p>محصولات چرم دست‌دوز با کیفیت ایتالیایی</p>
        <a href="shop.php" class="btn-luxury">مشاهده مجموعه <i class="fas fa-arrow-left"></i></a>
    </div>
</section>

<div class="container">
    <h2 style="text-align:center; margin:60px 0 20px;">محصولات ویژه</h2>
    <div class="products-grid">
        <?php foreach($featured as $product): ?>
        <div class="product-card">
            <div class="product-img">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>">
            </div>
            <div class="product-info">
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p><?= htmlspecialchars($product['description']) ?></p>
                <div class="price"><?= number_format($product['price']) ?> تومان</div>
                <button class="add-to-cart" data-id="<?= $product['id'] ?>">افزودن به سبد</button>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer>
    <div class="container">© 2025 چرم کومت - تمامی حقوق محفوظ است</div>
</footer>

<script src="script.js"></script>
<script>
    const mobileBtn = document.getElementById('mobileMenu');
    const nav = document.getElementById('navLinks');
    mobileBtn?.addEventListener('click', () => nav.classList.toggle('show'));
    window.addEventListener('scroll', () => {
        const header = document.getElementById('header');
        if(window.scrollY > 50) header.classList.add('scrolled');
        else header.classList.remove('scrolled');
    });
    // AJAX add to cart (مشابه قبل)
</script>
</body>
</html>
