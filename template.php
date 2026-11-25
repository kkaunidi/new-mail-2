<?php
/**
 * Основной шаблон страницы
 * Стили вынесены в отдельный файл styles.css
 */

$pageTitle = "Мой сайт";
$currentYear = date("Y");
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?></title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

    <!-- Шапка сайта -->
    <header class="header">
        <div class="header__container">
            <a href="/" class="header__logo">МойСайт</a>
            <nav class="header__nav">
                <a href="#home" class="header__nav-link">Главная</a>
                <a href="#features" class="header__nav-link">Возможности</a>
                <a href="#about" class="header__nav-link">О нас</a>
                <a href="#contact" class="header__nav-link">Контакты</a>
            </nav>
        </div>
    </header>

    <!-- Главный баннер -->
    <section class="hero" id="home">
        <h1 class="hero__title">Добро пожаловать</h1>
        <p class="hero__subtitle">Создавайте современные веб-проекты с чистым и структурированным кодом</p>
        <a href="#features" class="hero__btn">Узнать больше</a>
    </section>

    <!-- Основной контент -->
    <main class="main">

        <!-- Секция возможностей -->
        <section class="section" id="features">
            <h2 class="section__title">Наши возможности</h2>
            <div class="cards">

                <article class="card">
                    <div class="card__icon">⚡</div>
                    <h3 class="card__title">Быстродействие</h3>
                    <p class="card__text">Оптимизированный код и минимальное время загрузки для лучшего пользовательского опыта.</p>
                </article>

                <article class="card">
                    <div class="card__icon">🎨</div>
                    <h3 class="card__title">Дизайн</h3>
                    <p class="card__text">Современный и адаптивный интерфейс, который отлично выглядит на любых устройствах.</p>
                </article>

                <article class="card">
                    <div class="card__icon">🔒</div>
                    <h3 class="card__title">Безопасность</h3>
                    <p class="card__text">Надёжная защита данных и соблюдение лучших практик информационной безопасности.</p>
                </article>

            </div>
        </section>

        <!-- Секция "О нас" -->
        <section class="section" id="about">
            <h2 class="section__title">О нас</h2>
            <div class="cards">
                <article class="card">
                    <div class="card__icon">🚀</div>
                    <h3 class="card__title">Наша миссия</h3>
                    <p class="card__text">Мы стремимся создавать качественные веб-решения, которые помогают бизнесу расти и развиваться.</p>
                </article>

                <article class="card">
                    <div class="card__icon">🤝</div>
                    <h3 class="card__title">Команда</h3>
                    <p class="card__text">Опытные специалисты, которые любят своё дело и постоянно совершенствуют свои навыки.</p>
                </article>

                <article class="card">
                    <div class="card__icon">💡</div>
                    <h3 class="card__title">Инновации</h3>
                    <p class="card__text">Используем современные технологии и подходы для реализации самых амбициозных проектов.</p>
                </article>
            </div>
        </section>

    </main>

    <!-- Подвал сайта -->
    <footer class="footer" id="contact">
        <div class="footer__container">
            <p class="footer__text">&copy; <?= $currentYear ?> МойСайт. Все права защищены.</p>
            <div class="footer__links">
                <a href="#" class="footer__link">Политика конфиденциальности</a>
                <a href="#" class="footer__link">Условия использования</a>
                <a href="mailto:info@example.com" class="footer__link">info@example.com</a>
            </div>
        </div>
    </footer>

</body>
</html>
