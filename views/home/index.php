<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Newsly+ — Your Intelligent News Feed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,600;0,700;1,600;1,700&family=Instrument+Sans:wght@400;500;600&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= BASE_URL ?>public/style.css">

    <style>
        :root {
            --ink: #0D0D0D;
            --paper: #F7F4EF;
            --warm: #F2EDE4;
            --accent: #C94B2B;
            --accent2: #E8A87C;
            --gold: #B8913F;
            --muted: #7A7165;
            --border: rgba(13, 13, 13, 0.1);
            --glass: rgba(247, 244, 239, 0.72);
        }

        body.dark-mode {
            --ink: #F7F4EF;
            --paper: #0D0D0D;
            --warm: #1a1a1a;
            --muted: #9CA3AF;
            --border: rgba(247, 244, 239, 0.1);
            --glass: rgba(13, 13, 13, 0.72);
        }

        /* Enhanced Home Page Dark Mode */
        body.dark-mode .site-nav {
            background: rgba(13, 13, 13, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border-bottom: 1px solid var(--border);
        }

        body.dark-mode .nav-logo {
            color: var(--ink);
        }

        body.dark-mode .nav-links-center a {
            color: var(--muted);
        }

        body.dark-mode .nav-links-center a:hover,
        body.dark-mode .nav-links-center a:first-child {
            color: var(--ink);
        }

        body.dark-mode .btn-login {
            color: var(--muted);
        }

        body.dark-mode .btn-login:hover {
            color: var(--ink);
        }

        body.dark-mode .btn-cta-nav {
            background: var(--ink);
            color: var(--paper);
            border-color: var(--ink);
        }

        body.dark-mode .btn-cta-nav:hover {
            background: var(--accent);
            border-color: var(--accent);
        }

        body.dark-mode .hero {
            background: linear-gradient(135deg, var(--paper) 0%, #1a1a1a 100%);
        }

        body.dark-mode .hero-title {
            color: var(--ink);
        }

        body.dark-mode .hero-text {
            color: var(--muted);
        }

        body.dark-mode .hero-actions .btn-primary-custom {
            background: var(--accent);
            border-color: var(--accent);
        }

        body.dark-mode .hero-actions .btn-outline-pill {
            border-color: var(--border);
            color: var(--ink);
        }

        body.dark-mode .hero-actions .btn-outline-pill:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: var(--paper);
        }

        body.dark-mode .features-grid .feature-card {
            background: var(--warm);
            border-color: var(--border);
        }

        body.dark-mode .features-grid .feature-card h3 {
            color: var(--ink);
        }

        body.dark-mode .features-grid .feature-card p {
            color: var(--muted);
        }

        body.dark-mode .testimonials-section {
            background: var(--warm);
        }

        body.dark-mode .testimonial-card {
            background: var(--paper);
            border-color: var(--border);
        }

        body.dark-mode .testimonial-text {
            color: var(--muted);
        }

        body.dark-mode .testimonial-author {
            color: var(--ink);
        }

        body.dark-mode .pricing-section {
            background: var(--paper);
        }

        body.dark-mode .pricing-card {
            background: var(--warm);
            border-color: var(--border);
        }

        body.dark-mode .pricing-card.featured {
            background: var(--accent);
            color: var(--paper);
        }

        body.dark-mode .pricing-card h3,
        body.dark-mode .pricing-card .price {
            color: inherit;
        }

        body.dark-mode .pricing-card ul li {
            color: var(--muted);
        }

        body.dark-mode .faq-section {
            background: var(--warm);
        }

        body.dark-mode .faq-item {
            background: var(--paper);
            border-color: var(--border);
        }

        body.dark-mode .faq-question {
            color: var(--ink);
        }

        body.dark-mode .faq-answer {
            color: var(--muted);
        }

        body.dark-mode .contact-section {
            background: var(--paper);
        }

        body.dark-mode .contact-form {
            background: var(--warm);
            border-color: var(--border);
        }

        body.dark-mode .contact-form input,
        body.dark-mode .contact-form textarea {
            background: var(--paper);
            border-color: var(--border);
            color: var(--ink);
        }

        body.dark-mode .contact-form input::placeholder,
        body.dark-mode .contact-form textarea::placeholder {
            color: var(--muted);
        }

        body.dark-mode .footer {
            background: var(--paper);
            border-top: 1px solid var(--border);
        }

        body.dark-mode .footer h4 {
            color: var(--ink);
        }

        body.dark-mode .footer p,
        body.dark-mode .footer a {
            color: var(--muted);
        }

        body.dark-mode .footer a:hover {
            color: var(--ink);
        }

        body.dark-mode .mobile-menu {
            background: var(--paper);
        }

        body.dark-mode .mobile-menu-links a {
            color: var(--ink);
        }

        body.dark-mode .mobile-menu-links a:hover {
            color: var(--accent);
        }

        body.dark-mode .m-login {
            color: var(--ink);
            border-color: var(--border);
        }

        body.dark-mode .m-login:hover {
            background: var(--warm);
        }

        body.dark-mode .m-cta {
            background: var(--accent);
            color: var(--paper);
        }

        body.dark-mode .m-cta:hover {
            background: var(--gold);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Instrument Sans', sans-serif;
            background: var(--paper);
            color: var(--ink);
            overflow-x: hidden;
        }

        /* ── TYPOGRAPHY ── */
        .serif {
            font-family: 'Cormorant Garamond', Georgia, serif;
        }

        /* ── NAVBAR ── */
        .site-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 900;
            padding: 22px 48px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.4s ease;
        }

        .site-nav.scrolled {
            background: rgba(247, 244, 239, 0.92);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            padding: 14px 48px;
            border-bottom: 1px solid var(--border);
        }

        .nav-logo {
            font-family: 'Cormorant Garamond', serif;
            font-size: 26px;
            font-weight: 700;
            color: var(--ink);
            text-decoration: none;
            letter-spacing: -0.03em;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .nav-logo-dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: var(--accent);
            margin-bottom: 2px;
            flex-shrink: 0;
        }

        .nav-logo sup {
            font-size: 14px;
            color: var(--accent);
            font-weight: 700;
            vertical-align: super;
            line-height: 0;
        }

        .nav-links-center {
            display: flex;
            gap: 36px;
            font-size: 13.5px;
            font-weight: 500;
            letter-spacing: 0.02em;
        }

        .nav-links-center a {
            color: var(--ink);
            text-decoration: none;
            opacity: 0.55;
            transition: opacity 0.2s;
            position: relative;
        }

        .nav-links-center a:first-child {
            opacity: 1;
        }

        .nav-links-center a::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 1px;
            background: var(--accent);
            transition: width 0.25s ease;
        }

        .nav-links-center a:hover {
            opacity: 1;
        }

        .nav-links-center a:hover::after {
            width: 100%;
        }

        .nav-right {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .btn-login {
            font-size: 13.5px;
            font-weight: 500;
            color: var(--ink);
            text-decoration: none;
            opacity: 0.65;
            transition: opacity 0.2s;
        }

        .btn-login:hover {
            opacity: 1;
            color: var(--ink);
        }

        .btn-cta-nav {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--ink);
            color: var(--paper);
            font-size: 13px;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 4px;
            text-decoration: none;
            transition: all 0.2s;
            letter-spacing: 0.01em;
            border: 1.5px solid var(--ink);
        }

        .btn-cta-nav:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            transform: translateY(-1px);
        }

        .btn-cta-nav .free-badge {
            font-size: 10px;
            opacity: 0.5;
            font-weight: 400;
        }

        /* ── HERO ── */
        .hero {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            position: relative;
            overflow: hidden;
            padding-top: 80px;
        }

        /* Noise texture overlay */
        .hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1;
            opacity: 0.4;
        }

        .hero-inner {
            flex: 1;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 0;
            max-width: 1280px;
            margin: 0 auto;
            padding: 60px 48px 40px;
            align-items: center;
            position: relative;
            z-index: 2;
            width: 100%;
        }

        /* LEFT */
        .hero-left {
            padding-right: 60px;
        }

        .hero-eyebrow {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: rgba(13, 13, 13, 0.06);
            border: 1px solid var(--border);
            border-radius: 100px;
            padding: 6px 14px 6px 8px;
            margin-bottom: 32px;
            animation: fadeUp 0.7s ease both;
        }

        .hero-eyebrow-dot {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--ink);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .hero-eyebrow-dot i {
            color: var(--paper);
            font-size: 12px;
        }

        .hero-eyebrow-text {
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.04em;
        }

        .hero-eyebrow-sub {
            font-size: 11px;
            color: var(--muted);
        }

        .hero-title {
            font-family: 'Cormorant Garamond', Georgia, serif;
            font-size: clamp(68px, 9vw, 112px);
            font-weight: 700;
            letter-spacing: -0.04em;
            line-height: 0.9;
            color: var(--ink);
            margin-bottom: 28px;
            animation: fadeUp 0.7s 0.1s ease both;
        }

        .hero-title .italic {
            font-style: italic;
            color: var(--accent);
        }

        .hero-title .plus {
            font-size: 0.45em;
            color: var(--accent);
            vertical-align: super;
            line-height: 0;
        }

        .hero-sub {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.7;
            max-width: 420px;
            margin-bottom: 40px;
            font-weight: 400;
            animation: fadeUp 0.7s 0.2s ease both;
        }

        .hero-social-proof {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 40px;
            padding: 16px 0;
            border-top: 1px solid var(--border);
            border-bottom: 1px solid var(--border);
            animation: fadeUp 0.7s 0.3s ease both;
        }

        .avatars {
            display: flex;
        }

        .avatars img,
        .avatars .av {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2px solid var(--paper);
            margin-left: -8px;
            object-fit: cover;
        }

        .avatars img:first-child,
        .avatars .av:first-child {
            margin-left: 0;
        }

        .av {
            background: linear-gradient(135deg, var(--accent), var(--accent2));
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            font-weight: 700;
            color: #fff;
        }

        .sp-divider {
            width: 1px;
            height: 28px;
            background: var(--border);
        }

        .sp-stars {
            display: flex;
            gap: 2px;
            margin-bottom: 2px;
        }

        .sp-stars i {
            color: var(--gold);
            font-size: 12px;
        }

        .sp-label {
            font-size: 12px;
            font-weight: 600;
        }

        .sp-sub {
            font-size: 11px;
            color: var(--muted);
        }

        .hero-actions {
            display: flex;
            align-items: center;
            gap: 24px;
            animation: fadeUp 0.7s 0.4s ease both;
        }

        .btn-hero-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--ink);
            color: var(--paper);
            font-size: 14.5px;
            font-weight: 600;
            padding: 16px 32px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.25s;
            border: 2px solid var(--ink);
            letter-spacing: 0.01em;
        }

        .btn-hero-primary:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(201, 75, 43, 0.28);
        }

        .btn-hero-primary .arrow-wrap {
            width: 22px;
            height: 22px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: transform 0.2s;
        }

        .btn-hero-primary:hover .arrow-wrap {
            transform: translateX(3px);
        }

        .btn-hero-secondary {
            display: flex;
            align-items: center;
            gap: 8px;
            color: var(--ink);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            transition: gap 0.2s;
        }

        .btn-hero-secondary:hover {
            color: var(--ink);
            gap: 12px;
        }

        .btn-hero-secondary i {
            color: var(--muted);
        }

        /* RIGHT - VISUAL COMPOSITION */
        .hero-right {
            position: relative;
            height: 580px;
            animation: fadeUp 0.9s 0.15s ease both;
        }

        .hero-main-card {
            position: absolute;
            top: 0;
            left: 40px;
            right: 0;
            height: 460px;
            border-radius: 20px;
            overflow: hidden;
            background: var(--ink);
            box-shadow: 0 40px 80px rgba(13, 13, 13, 0.22);
        }

        .hero-main-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.65;
        }

        .hero-main-card-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(13, 13, 13, 0.88) 0%, rgba(13, 13, 13, 0.1) 55%, transparent 100%);
        }

        .hero-main-card-content {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 28px;
            color: #fff;
        }

        .hero-card-cat {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent2);
            margin-bottom: 8px;
        }

        .hero-card-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 22px;
            font-weight: 600;
            line-height: 1.25;
            margin-bottom: 10px;
            color: #fff;
        }

        .hero-card-meta {
            font-size: 12px;
            color: rgba(255, 255, 255, 0.55);
            display: flex;
            gap: 12px;
        }

        /* Floating cards */
        .float-card {
            position: absolute;
            background: var(--glass);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.7);
            border-radius: 16px;
            box-shadow: 0 16px 40px rgba(13, 13, 13, 0.12);
        }

        .float-stat {
            top: 28px;
            left: 0;
            padding: 18px 22px;
            width: 148px;
            animation: float 5s ease-in-out infinite;
        }

        .float-stat-pct {
            font-family: 'Cormorant Garamond', serif;
            font-size: 48px;
            font-weight: 700;
            letter-spacing: -0.04em;
            line-height: 1;
            color: var(--ink);
        }

        .float-stat-label {
            font-size: 11px;
            color: var(--muted);
            margin-top: 3px;
            line-height: 1.4;
        }

        .float-tag {
            bottom: 100px;
            left: -10px;
            padding: 12px 18px;
            display: flex;
            align-items: center;
            gap: 10px;
            animation: float 5s 1.5s ease-in-out infinite;
        }

        .float-tag i {
            color: var(--accent);
            font-size: 14px;
        }

        .float-tag-text {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink);
        }

        .float-mini {
            bottom: 20px;
            right: -10px;
            padding: 16px 18px;
            width: 150px;
            animation: float 5s 0.8s ease-in-out infinite;
        }

        .float-mini-img {
            width: 100%;
            height: 68px;
            border-radius: 10px;
            object-fit: cover;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #e8a87c, #c94b2b);
        }

        .float-mini-title {
            font-size: 12px;
            font-weight: 600;
            line-height: 1.4;
            color: var(--ink);
        }

        .float-mini-stars {
            display: flex;
            gap: 1px;
            margin-top: 5px;
        }

        .float-mini-stars i {
            font-size: 9px;
            color: var(--gold);
        }

        /* ── PUBLISHERS STRIP ── */
        .publishers-strip {
            border-top: 1px solid var(--border);
            background: var(--warm);
            padding: 24px 48px;
            position: relative;
            z-index: 2;
            overflow: hidden;
        }

        .publishers-strip::before {
            content: 'TRUSTED SOURCES';
            position: absolute;
            left: 48px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.14em;
            color: var(--muted);
        }

        .publishers-track {
            display: flex;
            gap: 60px;
            align-items: center;
            padding-left: 200px;
            animation: marquee 22s linear infinite;
            width: max-content;
        }

        .pub-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--ink);
            opacity: 0.35;
            letter-spacing: -0.02em;
            white-space: nowrap;
            transition: opacity 0.2s;
        }

        .pub-name:hover {
            opacity: 0.8;
        }

        @keyframes marquee {
            from {
                transform: translateX(0);
            }

            to {
                transform: translateX(-50%);
            }
        }

        /* ── FEATURES ── */
        .features-section {
            padding: 120px 48px;
            max-width: 1280px;
            margin: 0 auto;
        }

        .section-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--accent);
            margin-bottom: 20px;
        }

        .section-label::before {
            content: '';
            width: 24px;
            height: 1px;
            background: var(--accent);
        }

        .section-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(40px, 5vw, 60px);
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.05;
            color: var(--ink);
            max-width: 600px;
        }

        .section-heading em {
            font-style: italic;
            color: var(--accent);
        }

        .section-sub {
            font-size: 16px;
            color: var(--muted);
            max-width: 480px;
            line-height: 1.7;
            margin-top: 18px;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;
            margin-top: 64px;
        }

        .feature-card {
            border-radius: 18px;
            padding: 36px 32px 32px;
            transition: transform 0.25s, box-shadow 0.25s;
            cursor: default;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 24px 56px rgba(13, 13, 13, 0.1);
        }

        .fc-light {
            background: #fff;
            border: 1px solid var(--border);
        }

        .fc-dark {
            background: var(--ink);
            color: #fff;
        }

        .fc-warm {
            background: var(--warm);
            border: 1px solid var(--border);
        }

        .feature-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            font-size: 22px;
        }

        .fc-light .feature-icon {
            background: rgba(201, 75, 43, 0.1);
            color: var(--accent);
        }

        .fc-dark .feature-icon {
            background: rgba(255, 255, 255, 0.1);
            color: var(--accent2);
        }

        .fc-warm .feature-icon {
            background: rgba(184, 145, 63, 0.15);
            color: var(--gold);
        }

        .feature-title {
            font-family: 'Cormorant Garamond', serif;
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 14px;
            line-height: 1.15;
        }

        .fc-dark .feature-title {
            color: #fff;
        }

        .feature-text {
            font-size: 14px;
            line-height: 1.75;
        }

        .fc-light .feature-text,
        .fc-warm .feature-text {
            color: var(--muted);
        }

        .fc-dark .feature-text {
            color: rgba(255, 255, 255, 0.5);
        }

        .feature-tag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            font-weight: 600;
            margin-top: 20px;
            padding: 5px 12px;
            border-radius: 100px;
        }

        .fc-light .feature-tag {
            background: rgba(201, 75, 43, 0.08);
            color: var(--accent);
        }

        .fc-dark .feature-tag {
            background: rgba(255, 255, 255, 0.1);
            color: rgba(255, 255, 255, 0.7);
        }

        .fc-warm .feature-tag {
            background: rgba(184, 145, 63, 0.15);
            color: var(--gold);
        }

        /* ── STATS BAND ── */
        .stats-band {
            background: var(--ink);
            padding: 72px 48px;
        }

        .stats-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 0;
        }

        .stat-item {
            padding: 0 40px;
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }

        .stat-item:last-child {
            border-right: none;
        }

        .stat-num {
            font-family: 'Cormorant Garamond', serif;
            font-size: 64px;
            font-weight: 700;
            color: #fff;
            letter-spacing: -0.04em;
            line-height: 1;
            margin-bottom: 6px;
        }

        .stat-num span {
            color: var(--accent2);
        }

        .stat-label {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.45);
            letter-spacing: 0.02em;
        }

        /* ── CTA ── */
        .cta-section {
            padding: 120px 48px;
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .cta-label {
            margin-bottom: 20px;
        }

        .cta-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(44px, 5.5vw, 68px);
            font-weight: 700;
            letter-spacing: -0.04em;
            line-height: 1;
            margin-bottom: 24px;
        }

        .cta-heading em {
            font-style: italic;
            color: var(--accent);
        }

        .cta-sub {
            font-size: 16px;
            color: var(--muted);
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 400px;
        }

        .cta-btns {
            display: flex;
            gap: 16px;
            align-items: center;
            flex-wrap: wrap;
        }

        .btn-cta-main {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--accent);
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            padding: 17px 36px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s;
            letter-spacing: 0.01em;
        }

        .btn-cta-main:hover {
            background: #a83920;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 14px 36px rgba(201, 75, 43, 0.3);
        }

        .btn-cta-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: var(--ink);
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            border-bottom: 1px solid var(--border);
            padding-bottom: 2px;
            transition: all 0.2s;
        }

        .btn-cta-outline:hover {
            color: var(--accent);
            border-color: var(--accent);
        }

        /* CTA Visual */
        .cta-visual {
            position: relative;
            height: 420px;
        }

        .cta-main-img {
            width: 100%;
            height: 380px;
            border-radius: 20px;
            object-fit: cover;
            background: linear-gradient(135deg, #1a1a2e, #2d1b69);
            overflow: hidden;
            position: absolute;
            top: 20px;
            left: 0;
            right: 0;
            box-shadow: 0 32px 64px rgba(13, 13, 13, 0.18);
        }

        .cta-card-stack {
            position: absolute;
            bottom: 0;
            left: -20px;
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 20px;
            width: 220px;
            box-shadow: 0 16px 40px rgba(13, 13, 13, 0.12);
        }

        .cta-card-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            color: var(--muted);
            text-transform: uppercase;
            margin-bottom: 8px;
        }

        .cta-card-sources {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .cta-source {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13px;
            font-weight: 500;
        }

        .cta-source-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            flex-shrink: 0;
        }

        /* ── FOOTER ── */
        .site-footer {
            background: var(--warm);
            border-top: 1px solid var(--border);
            padding: 60px 48px 32px;
        }

        .footer-inner {
            max-width: 1280px;
            margin: 0 auto;
        }

        .footer-top {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 48px;
            padding-bottom: 48px;
            border-bottom: 1px solid var(--border);
        }

        .footer-brand-name {
            font-family: 'Cormorant Garamond', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--ink);
            letter-spacing: -0.03em;
            display: flex;
            align-items: center;
            gap: 6px;
            text-decoration: none;
            margin-bottom: 14px;
        }

        .footer-brand-name sup {
            font-size: 14px;
            color: var(--accent);
            vertical-align: super;
            line-height: 0;
        }

        .footer-desc {
            font-size: 13.5px;
            color: var(--muted);
            line-height: 1.7;
            max-width: 260px;
        }

        .footer-col-title {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--ink);
            margin-bottom: 18px;
        }

        .footer-links {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 11px;
        }

        .footer-links a {
            font-size: 13.5px;
            color: var(--muted);
            text-decoration: none;
            transition: color 0.15s;
        }

        .footer-links a:hover {
            color: var(--ink);
        }

        .footer-bottom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 28px;
            font-size: 12.5px;
            color: var(--muted);
        }

        .footer-socials {
            display: flex;
            gap: 16px;
        }

        .footer-socials a {
            color: var(--muted);
            font-size: 16px;
            text-decoration: none;
            transition: color 0.15s;
        }

        .footer-socials a:hover {
            color: var(--ink);
        }

        /* ── ANIMATIONS ── */
        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(24px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        /* Scroll reveal */
        .reveal {
            opacity: 0;
            transform: translateY(32px);
            transition: opacity 0.7s ease, transform 0.7s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: none;
        }

        .reveal-delay-1 {
            transition-delay: 0.1s;
        }

        .reveal-delay-2 {
            transition-delay: 0.2s;
        }

        .reveal-delay-3 {
            transition-delay: 0.3s;
        }

        /* ── MOBILE NAV ── */
        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
            padding: 4px;
            background: none;
            border: none;
        }

        .hamburger span {
            display: block;
            width: 24px;
            height: 2px;
            background: var(--ink);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .hamburger.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .hamburger.open span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }

        .hamburger.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        .mobile-menu {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--paper);
            z-index: 800;
            flex-direction: column;
            padding: 100px 36px 48px;
            overflow-y: auto;
        }

        .mobile-menu.open {
            display: flex;
        }

        .mobile-menu-links {
            display: flex;
            flex-direction: column;
            gap: 0;
            margin-bottom: 40px;
        }

        .mobile-menu-links a {
            font-family: 'Cormorant Garamond', serif;
            font-size: 42px;
            font-weight: 700;
            letter-spacing: -0.03em;
            color: var(--ink);
            text-decoration: none;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            opacity: 0.45;
            transition: opacity 0.2s;
            line-height: 1.2;
        }

        .mobile-menu-links a:hover,
        .mobile-menu-links a:first-child {
            opacity: 1;
        }

        .mobile-menu-btns {
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-top: 32px;
        }

        .mobile-menu-btns a {
            display: block;
            text-align: center;
            padding: 15px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
        }

        .mobile-menu-btns .m-login {
            border: 1.5px solid var(--border);
            color: var(--ink);
        }

        .mobile-menu-btns .m-cta {
            background: var(--accent);
            color: #fff;
        }

        /* ── PRICING ── */
        .pricing-section {
            padding: 120px 48px;
            max-width: 1280px;
            margin: 0 auto;
        }

        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 64px;
            align-items: start;
        }

        .pricing-card {
            border-radius: 20px;
            padding: 36px 32px 32px;
            border: 1px solid var(--border);
            background: #fff;
            position: relative;
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .pricing-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 48px rgba(13, 13, 13, 0.09);
        }

        .pricing-card.featured {
            background: var(--ink);
            border-color: var(--ink);
            transform: scale(1.04);
        }

        .pricing-card.featured:hover {
            transform: scale(1.04) translateY(-4px);
        }

        .featured-badge {
            position: absolute;
            top: -13px;
            left: 50%;
            transform: translateX(-50%);
            background: var(--accent);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 100px;
            white-space: nowrap;
        }

        .pricing-name {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            margin-bottom: 16px;
        }

        .pricing-card:not(.featured) .pricing-name {
            color: var(--muted);
        }

        .pricing-card.featured .pricing-name {
            color: var(--accent2);
        }

        .pricing-price {
            font-family: 'Cormorant Garamond', serif;
            font-size: 56px;
            font-weight: 700;
            letter-spacing: -0.04em;
            line-height: 1;
            margin-bottom: 6px;
        }

        .pricing-card:not(.featured) .pricing-price {
            color: var(--ink);
        }

        .pricing-card.featured .pricing-price {
            color: #fff;
        }

        .pricing-price sup {
            font-size: 22px;
            vertical-align: super;
            line-height: 0;
        }

        .pricing-price sub {
            font-size: 16px;
            color: var(--muted);
            font-weight: 400;
            vertical-align: baseline;
            font-family: 'Instrument Sans', sans-serif;
        }

        .pricing-card.featured .pricing-price sub {
            color: rgba(255, 255, 255, 0.4);
        }

        .pricing-desc {
            font-size: 13.5px;
            color: var(--muted);
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
            line-height: 1.6;
        }

        .pricing-card.featured .pricing-desc {
            color: rgba(255, 255, 255, 0.4);
            border-color: rgba(255, 255, 255, 0.1);
        }

        .pricing-features {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 32px;
        }

        .pricing-features li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 13.5px;
        }

        .pricing-card:not(.featured) .pricing-features li {
            color: var(--ink);
        }

        .pricing-card.featured .pricing-features li {
            color: rgba(255, 255, 255, 0.8);
        }

        .pricing-features li i {
            font-size: 14px;
            flex-shrink: 0;
        }

        .pricing-card:not(.featured) .pricing-features li i {
            color: var(--accent);
        }

        .pricing-card.featured .pricing-features li i {
            color: var(--accent2);
        }

        .btn-pricing {
            display: block;
            text-align: center;
            padding: 14px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s;
            letter-spacing: 0.01em;
        }

        .btn-pricing-outline {
            border: 1.5px solid var(--border);
            color: var(--ink);
            background: transparent;
        }

        .btn-pricing-outline:hover {
            background: var(--warm);
            color: var(--ink);
            border-color: var(--ink);
        }

        .btn-pricing-solid {
            background: var(--accent);
            color: #fff;
            border: 1.5px solid var(--accent);
        }

        .btn-pricing-solid:hover {
            background: #a83920;
            color: #fff;
        }

        /* ── TESTIMONIALS ── */
        .testimonials-section {
            padding: 120px 48px;
            background: var(--warm);
        }

        .testimonials-inner {
            max-width: 1280px;
            margin: 0 auto;
        }

        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-top: 64px;
        }

        .testimonial-card {
            background: #fff;
            border: 1px solid var(--border);
            border-radius: 18px;
            padding: 32px;
            transition: transform 0.25s, box-shadow 0.25s;
        }

        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(13, 13, 13, 0.08);
        }

        .testimonial-card.dark {
            background: var(--ink);
            border-color: var(--ink);
        }

        .t-stars {
            display: flex;
            gap: 3px;
            margin-bottom: 18px;
        }

        .t-stars i {
            color: var(--gold);
            font-size: 13px;
        }

        .t-quote {
            font-family: 'Cormorant Garamond', serif;
            font-size: 20px;
            font-weight: 600;
            line-height: 1.45;
            margin-bottom: 24px;
            font-style: italic;
        }

        .testimonial-card:not(.dark) .t-quote {
            color: var(--ink);
        }

        .testimonial-card.dark .t-quote {
            color: #fff;
        }

        .t-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .t-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .t-name {
            font-size: 13.5px;
            font-weight: 600;
        }

        .testimonial-card:not(.dark) .t-name {
            color: var(--ink);
        }

        .testimonial-card.dark .t-name {
            color: #fff;
        }

        .t-role {
            font-size: 12px;
            color: var(--muted);
            margin-top: 1px;
        }

        .testimonial-card.dark .t-role {
            color: rgba(255, 255, 255, 0.35);
        }

        /* ── FAQ ── */
        .faq-section {
            padding: 120px 48px;
            max-width: 1280px;
            margin: 0 auto;
        }

        .faq-layout {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 80px;
            margin-top: 64px;
            align-items: start;
        }

        .faq-sticky {
            position: sticky;
            top: 100px;
        }

        .faq-sticky-desc {
            font-size: 15px;
            color: var(--muted);
            line-height: 1.7;
            margin-top: 18px;
            margin-bottom: 28px;
            max-width: 320px;
        }

        .btn-faq-contact {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--ink);
            color: var(--paper);
            font-size: 14px;
            font-weight: 600;
            padding: 13px 24px;
            border-radius: 6px;
            text-decoration: none;
            transition: all 0.2s;
        }

        .btn-faq-contact:hover {
            background: var(--accent);
            color: #fff;
        }

        .faq-list {
            display: flex;
            flex-direction: column;
        }

        .faq-item {
            border-bottom: 1px solid var(--border);
            overflow: hidden;
        }

        .faq-item:first-child {
            border-top: 1px solid var(--border);
        }

        .faq-question {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 22px 0;
            cursor: pointer;
            user-select: none;
            gap: 16px;
        }

        .faq-q-text {
            font-size: 15.5px;
            font-weight: 500;
            color: var(--ink);
            line-height: 1.4;
        }

        .faq-icon {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: var(--warm);
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            font-size: 14px;
            color: var(--ink);
            transition: all 0.3s;
        }

        .faq-item.open .faq-icon {
            background: var(--ink);
            color: var(--paper);
            transform: rotate(45deg);
        }

        .faq-answer {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.4s ease;
            font-size: 14.5px;
            color: var(--muted);
            line-height: 1.75;
        }

        .faq-item.open .faq-answer {
            max-height: 300px;
            padding-bottom: 20px;
        }

        /* ── CONTACT ── */
        .contact-section {
            padding: 120px 48px;
            background: var(--ink);
        }

        .contact-inner {
            max-width: 1280px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 80px;
            align-items: start;
        }

        .contact-left .section-label {
            color: var(--accent2);
        }

        .contact-left .section-label::before {
            background: var(--accent2);
        }

        .contact-heading {
            font-family: 'Cormorant Garamond', serif;
            font-size: clamp(40px, 5vw, 58px);
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.05;
            color: #fff;
            margin-bottom: 20px;
        }

        .contact-heading em {
            font-style: italic;
            color: var(--accent2);
        }

        .contact-desc {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.4);
            line-height: 1.7;
            margin-bottom: 40px;
            max-width: 400px;
        }

        .contact-info-items {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .contact-info-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
        }

        .c-icon {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 17px;
            color: var(--accent2);
            flex-shrink: 0;
        }

        .c-info-label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.3);
            margin-bottom: 3px;
        }

        .c-info-val {
            font-size: 14.5px;
            color: rgba(255, 255, 255, 0.75);
            font-weight: 500;
        }

        .contact-form {
            background: #fff;
            border-radius: 20px;
            padding: 40px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
            margin-bottom: 14px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 14px;
        }

        .form-lbl {
            font-size: 11.5px;
            font-weight: 700;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .form-inp,
        .form-select,
        .form-textarea {
            border: 1.5px solid var(--border);
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 14px;
            font-family: 'Instrument Sans', sans-serif;
            color: var(--ink);
            background: var(--paper);
            outline: none;
            transition: border 0.2s, background 0.2s;
            width: 100%;
        }

        .form-inp:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--ink);
            background: #fff;
        }

        .form-textarea {
            resize: vertical;
            min-height: 110px;
        }

        .btn-submit {
            width: 100%;
            background: var(--accent);
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 15px;
            font-size: 15px;
            font-weight: 600;
            font-family: 'Instrument Sans', sans-serif;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background: #a83920;
            transform: translateY(-1px);
            box-shadow: 0 10px 28px rgba(201, 75, 43, 0.3);
        }

        .form-note {
            font-size: 12px;
            color: var(--muted);
            text-align: center;
            margin-top: 12px;
        }

        /* ── RESPONSIVE COMPLETE ── */
        @media (max-width: 1100px) {
            .pricing-grid {
                grid-template-columns: 1fr;
                max-width: 480px;
                margin-left: auto;
                margin-right: auto;
            }

            .pricing-card.featured {
                transform: scale(1);
            }

            .pricing-card.featured:hover {
                transform: translateY(-4px);
            }

            .testimonials-grid {
                grid-template-columns: 1fr 1fr;
            }

            .faq-layout {
                grid-template-columns: 1fr;
                gap: 48px;
            }

            .faq-sticky {
                position: static;
            }

            .contact-inner {
                grid-template-columns: 1fr;
                gap: 48px;
            }
        }

        @media (max-width: 992px) {
            .hero-inner {
                grid-template-columns: 1fr;
                gap: 40px;
            }

            .hero-right {
                height: 380px;
            }

            .hero-left {
                padding-right: 0;
            }

            .hero-main-card {
                left: 0;
            }

            .site-nav {
                padding: 18px 24px;
            }

            .site-nav.scrolled {
                padding: 12px 24px;
            }

            .nav-links-center {
                display: none;
            }

            .nav-right .btn-cta-nav {
                display: none;
            }

            .hamburger {
                display: flex;
            }

            .features-grid {
                grid-template-columns: 1fr;
                max-width: 560px;
                margin-left: auto;
                margin-right: auto;
            }

            .stats-inner {
                grid-template-columns: 1fr 1fr;
                gap: 0;
            }

            .stat-item {
                border-right: none;
                border-bottom: 1px solid rgba(255, 255, 255, 0.1);
                padding: 32px 20px;
            }

            .stat-item:last-child {
                border-bottom: none;
            }

            .cta-section {
                grid-template-columns: 1fr;
            }

            .cta-visual {
                display: none;
            }

            .footer-top {
                grid-template-columns: 1fr 1fr;
            }

            .publishers-strip {
                padding: 20px 24px;
            }

            .publishers-strip::before {
                display: none;
            }

            .publishers-track {
                padding-left: 0;
            }

            .features-section,
            .pricing-section,
            .faq-section {
                padding: 80px 24px;
            }

            .stats-band {
                padding: 60px 24px;
            }

            .cta-section {
                padding: 80px 24px;
            }

            .testimonials-section,
            .contact-section {
                padding: 80px 24px;
            }

            .site-footer {
                padding: 48px 24px 24px;
            }
        }

        @media (max-width: 768px) {
            .hero-inner {
                padding: 40px 20px 32px;
            }

            .hero-title {
                font-size: 80px;
            }

            .hero-right {
                height: 320px;
            }

            .float-stat {
                display: none;
            }

            .float-tag {
                left: 0;
                bottom: 120px;
            }

            .testimonials-grid {
                grid-template-columns: 1fr;
                max-width: 480px;
                margin-left: auto;
                margin-right: auto;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .contact-form {
                padding: 28px 20px;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 62px;
            }

            .hero-right {
                height: 260px;
            }

            .float-mini {
                display: none;
            }

            .hero-eyebrow-sub {
                display: none;
            }

            .hero-actions {
                flex-direction: column;
                align-items: flex-start;
                gap: 14px;
            }

            .hero-social-proof {
                flex-wrap: wrap;
                gap: 10px;
            }

            .sp-divider {
                display: none;
            }

            .footer-top {
                grid-template-columns: 1fr;
            }

            .footer-bottom {
                flex-direction: column;
            .stats-inner {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>

<body>

    <!-- ── NAVBAR ── -->
    <nav class="site-nav" id="siteNav">
        <a href="<?= BASE_URL ?>" class="nav-logo">
            <div class="nav-logo-dot"></div>
            Newsly<sup>+</sup>
        </a>

        <div class="nav-links-center">
            <a href="<?= BASE_URL ?>dashboard">Feed</a>
            <a href="#features">Features</a>
            <a href="#pricing">Pricing</a>
            <a href="#faq">FAQ</a>
            <a href="#contact">Contact</a>
        </div>

        <div class="nav-right">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= BASE_URL ?>dashboard" class="btn-login">Dashboard</a>
                <a href="<?= BASE_URL ?>auth/logout" class="btn-login ms-3">Log Out</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>auth/login" class="btn-login">Log In</a>
            <?php endif; ?>
            
            <button id="themeToggleHome" class="btn btn-link text-dark p-0 mx-3 border-0">
                <i class="bi bi-moon-stars fs-5"></i>
            </button>
            
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= BASE_URL ?>dashboard" class="btn-cta-nav">Go to Feed</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>auth/register" class="btn-cta-nav">Get It Now <span class="free-badge">— Free</span></a>
            <?php endif; ?>
            <button class="hamburger" id="hamburger" aria-label="Menu"
                onclick="toggleMenu()"><span></span><span></span><span></span></button>
        </div>
    </nav>

    <div class="mobile-menu" id="mobileMenu">
        <div class="mobile-menu-links">
            <a href="<?= BASE_URL ?>dashboard" onclick="toggleMenu()">Feed</a>
            <a href="#features" onclick="toggleMenu()">Features</a>
            <a href="#pricing" onclick="toggleMenu()">Pricing</a>
            <a href="#testimonials" onclick="toggleMenu()">Reviews</a>
            <a href="#faq" onclick="toggleMenu()">FAQ</a>
            <a href="#contact" onclick="toggleMenu()">Contact Us</a>
        </div>
        <div class="mobile-menu-btns">
            <?php if (isset($_SESSION['user_id'])): ?>
                <a href="<?= BASE_URL ?>dashboard" class="m-login">Dashboard</a>
                <a href="<?= BASE_URL ?>dashboard" class="m-cta">Go to Feed</a>
            <?php else: ?>
                <a href="<?= BASE_URL ?>auth/login" class="m-login">Log In</a>
                <a href="<?= BASE_URL ?>auth/register" class="m-cta">Get It Now — Free</a>
            <?php endif; ?>
        </div>
    </div>

    <!-- ── HERO ── -->
    <section class="hero">
        <div class="hero-inner">

            <!-- LEFT -->
            <div class="hero-left">
                <div class="hero-eyebrow">
                    <div class="hero-eyebrow-dot"><i class="bi bi-people-fill"></i></div>
                    <div>
                        <div class="hero-eyebrow-text">20M+ Active Readers</div>
                        <div class="hero-eyebrow-sub">Join them today — it's free</div>
                    </div>
                </div>

                <h1 class="hero-title">
                    News<br><span class="italic">ly</span><span class="plus">+</span>
                </h1>

                <p class="hero-sub">
                    Drive content consumption and harness AI-powered news delivery —
                    all your trusted publishers, one beautifully curated feed.
                </p>

                <div class="hero-social-proof">
                    <div class="avatars">
                        <div class="av">M</div>
                        <div class="av" style="background:linear-gradient(135deg,#1a7a6b,#3daaa0);">J</div>
                        <div class="av" style="background:linear-gradient(135deg,#2d5fa5,#5b8ed4);">A</div>
                        <div class="av" style="background:linear-gradient(135deg,#7b3fa0,#b07ad4);">R</div>
                    </div>
                    <div class="sp-divider"></div>
                    <div>
                        <div class="sp-stars">
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                        </div>
                        <div class="sp-label">4.9 / 5.0</div>
                    </div>
                    <div class="sp-divider"></div>
                    <div>
                        <div class="sp-label">100% Satisfied</div>
                        <div class="sp-sub">from 4,200+ verified reviews</div>
                    </div>
                </div>

                <div class="hero-actions">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="<?= BASE_URL ?>dashboard" class="btn-hero-primary">
                            Go to Dashboard
                            <div class="arrow-wrap"><i class="bi bi-arrow-right"></i></div>
                        </a>
                    <?php else: ?>
                        <a href="<?= BASE_URL ?>auth/register" class="btn-hero-primary">
                            Start Reading Free
                            <div class="arrow-wrap"><i class="bi bi-arrow-right"></i></div>
                        </a>
                    <?php endif; ?>
                    <a href="#pricing" class="btn-hero-secondary">
                        Our Pricing <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>
            </div>

            <!-- RIGHT -->
            <div class="hero-right">
                <!-- Main article card -->
                <div class="hero-main-card">
                    <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=900&q=80" alt="News"
                        class="hero-main-card-img">
                    <div class="hero-main-card-overlay"></div>
                    <div class="hero-main-card-content">
                        <div class="hero-card-cat">World · Breaking News</div>
                        <div class="hero-card-title">Global Markets Rally as Central Banks Signal Pause in Rate Hikes
                        </div>
                        <div class="hero-card-meta">
                            <span><i class="bi bi-clock me-1"></i>2 hours ago</span>
                            <span>Bloomberg · Reuters</span>
                        </div>
                    </div>
                </div>

                <!-- Float: Stats -->
                <div class="float-card float-stat">
                    <div class="float-stat-pct">60<span style="font-size:22px;color:var(--accent);">%</span></div>
                    <div class="float-stat-label">More reading time this week</div>
                </div>

                <!-- Float: Tag -->
                <div class="float-card float-tag">
                    <i class="bi bi-check-circle-fill"></i>
                    <div class="float-tag-text">Feed curated for you</div>
                </div>

                <!-- Float: Mini card -->
                <div class="float-card float-mini">
                    <div class="float-mini-img" style="background:linear-gradient(135deg,#e8a87c 0%,#c94b2b 100%);">
                    </div>
                    <div class="float-mini-title">Latest Stories</div>
                    <div class="float-mini-stars">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                    </div>
                    <div style="font-size:11px;color:var(--muted);margin-top:4px;">Included in all plans</div>
                </div>
            </div>

        </div>

        <!-- Publishers strip -->
        <div class="publishers-strip">
            <div class="publishers-track">
                <span class="pub-name">New York Times</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Bloomberg</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">The Atlantic</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Forbes</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Medium</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Reuters</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Wired</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Economist</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <!-- Duplicate for seamless loop -->
                <span class="pub-name">New York Times</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Bloomberg</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">The Atlantic</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Forbes</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Medium</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Reuters</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Wired</span>
                <span class="pub-name" style="opacity:0.2;">·</span>
                <span class="pub-name">Economist</span>
            </div>
        </div>
    </section>

    <!-- ── FEATURES ── -->
    <section id="features" style="background: var(--paper);">
        <div class="features-section">
            <div class="reveal">
                <div class="section-label">Powerful Capabilities</div>
                <h2 class="section-heading">Redefining how you<br><em>consume the web</em></h2>
                <p class="section-sub">Stop jumping between platforms. Newsly centralizes premium publishers into one
                    intelligently organized feed.</p>
            </div>

            <div class="features-grid">
                <div class="feature-card fc-light reveal reveal-delay-1">
                    <div class="feature-icon"><i class="bi bi-lightning-charge-fill"></i></div>
                    <h3 class="feature-title">AI Speed Delivery</h3>
                    <p class="feature-text">Our engine pre-fetches and categorizes articles in milliseconds. Content
                        loads before you even ask for it.</p>
                    <span class="feature-tag"><i class="bi bi-arrow-right"></i> 50x faster</span>
                </div>

                <div class="feature-card fc-dark reveal reveal-delay-2">
                    <div class="feature-icon"><i class="bi bi-shield-lock-fill"></i></div>
                    <h3 class="feature-title">Zero Ads. Ever.</h3>
                    <p class="feature-text">A clean environment designed for reading. No popups, no trackers, no
                        interruptions. Just pure, distraction-free content.</p>
                    <span class="feature-tag"><i class="bi bi-check-circle"></i> Privacy-first</span>
                </div>

                <div class="feature-card fc-warm reveal reveal-delay-3">
                    <div class="feature-icon"><i class="bi bi-bookmark-star-fill"></i></div>
                    <h3 class="feature-title">Save for Later</h3>
                    <p class="feature-text">Build your personal reading library. Bookmark breaking stories in one tap
                        and sync them across every device.</p>
                    <span class="feature-tag"><i class="bi bi-devices"></i> Cross-device sync</span>
                </div>
            </div>
        </div>
    </section>

    <!-- ── STATS ── -->
    <div class="stats-band">
        <div class="stats-inner">
            <div class="stat-item reveal">
                <div class="stat-num">20<span>M</span></div>
                <div class="stat-label">Monthly Active Users</div>
            </div>
            <div class="stat-item reveal reveal-delay-1">
                <div class="stat-num">4.9<span>★</span></div>
                <div class="stat-label">Average App Rating</div>
            </div>
            <div class="stat-item reveal reveal-delay-2">
                <div class="stat-num">500<span>+</span></div>
                <div class="stat-label">Publisher Sources</div>
            </div>
            <div class="stat-item reveal reveal-delay-3">
                <div class="stat-num">60<span>%</span></div>
                <div class="stat-label">More Reading Per Session</div>
            </div>
        </div>
    </div>


    <!-- ── PRICING ── -->
    <section id="pricing" style="background:var(--paper);">
        <div class="pricing-section">
            <div class="reveal">
                <div class="section-label">Simple Pricing</div>
                <h2 class="section-heading">Plans that grow<br><em>with you</em></h2>
                <p class="section-sub">No hidden fees. Start free, upgrade when ready. Cancel anytime.</p>
            </div>
            <div class="pricing-grid">
                <div class="pricing-card reveal reveal-delay-1">
                    <div class="pricing-name">Starter</div>
                    <div class="pricing-price"><sup>$</sup>0<sub>/mo</sub></div>
                    <p class="pricing-desc">Perfect for casual readers who want to consolidate their news without paying
                        a cent.</p>
                    <ul class="pricing-features">
                        <li><i class="bi bi-check-circle-fill"></i>Up to 5 publisher sources</li>
                        <li><i class="bi bi-check-circle-fill"></i>Basic news feed</li>
                        <li><i class="bi bi-check-circle-fill"></i>10 bookmarks / month</li>
                        <li><i class="bi bi-check-circle-fill"></i>Mobile & web access</li>
                        <li><i class="bi bi-x-circle" style="color:#ddd;"></i>AI personalization</li>
                        <li><i class="bi bi-x-circle" style="color:#ddd;"></i>Ad-free experience</li>
                    </ul>
                    <a href="<?= BASE_URL ?>auth/register" class="btn-pricing btn-pricing-outline">Get Started Free</a>
                </div>
                <div class="pricing-card featured reveal reveal-delay-2">
                    <div class="featured-badge">Most Popular</div>
                    <div class="pricing-name">Pro</div>
                    <div class="pricing-price"><sup>$</sup>9<sub>/mo</sub></div>
                    <p class="pricing-desc">For serious readers who want AI-powered curation and a fully ad-free
                        experience.</p>
                    <ul class="pricing-features">
                        <li><i class="bi bi-check-circle-fill"></i>Unlimited publisher sources</li>
                        <li><i class="bi bi-check-circle-fill"></i>AI-personalized feed</li>
                        <li><i class="bi bi-check-circle-fill"></i>Unlimited bookmarks</li>
                        <li><i class="bi bi-check-circle-fill"></i>100% ad-free</li>
                        <li><i class="bi bi-check-circle-fill"></i>Offline reading</li>
                        <li><i class="bi bi-check-circle-fill"></i>Priority support</li>
                    </ul>
                    <a href="<?= BASE_URL ?>auth/register" class="btn-pricing btn-pricing-solid">Start Pro &mdash; $9/mo</a>
                </div>
                <div class="pricing-card reveal reveal-delay-3">
                    <div class="pricing-name">Enterprise</div>
                    <div class="pricing-price" style="font-size:42px;line-height:1.1;">Custom</div>
                    <p class="pricing-desc">For newsrooms and teams that need custom integrations, analytics, and
                        dedicated support.</p>
                    <ul class="pricing-features">
                        <li><i class="bi bi-check-circle-fill"></i>Everything in Pro</li>
                        <li><i class="bi bi-check-circle-fill"></i>Custom API access</li>
                        <li><i class="bi bi-check-circle-fill"></i>Team seats & admin panel</li>
                        <li><i class="bi bi-check-circle-fill"></i>Advanced analytics</li>
                        <li><i class="bi bi-check-circle-fill"></i>White-label option</li>
                        <li><i class="bi bi-check-circle-fill"></i>Dedicated account manager</li>
                    </ul>
                    <a href="#contact" class="btn-pricing btn-pricing-outline">Talk to Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ── TESTIMONIALS ── -->
    <section id="testimonials" class="testimonials-section">
        <div class="testimonials-inner">
            <div class="reveal" style="text-align:center;">
                <div class="section-label" style="justify-content:center;">What Readers Say</div>
                <h2 class="section-heading" style="margin:0 auto;text-align:center;">Loved by <em>20
                        million</em><br>readers worldwide</h2>
            </div>
            <div class="testimonials-grid">
                <div class="testimonial-card reveal reveal-delay-1">
                    <div class="t-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <div class="t-quote">&ldquo;I replaced six different news apps with Newsly+. The AI curation is
                        genuinely uncanny &mdash; it knows what I want before I do.&rdquo;</div>
                    <div class="t-author">
                        <div class="t-avatar" style="background:linear-gradient(135deg,#c94b2b,#e8a87c);">SR</div>
                        <div>
                            <div class="t-name">Sophie R.</div>
                            <div class="t-role">Tech journalist, London</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card dark reveal reveal-delay-2">
                    <div class="t-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <div class="t-quote">&ldquo;The zero-ad experience alone is worth every cent. I read 40% more now
                        because nothing interrupts my flow. Game changer.&rdquo;</div>
                    <div class="t-author">
                        <div class="t-avatar" style="background:linear-gradient(135deg,#1a7a6b,#3daaa0);">MK</div>
                        <div>
                            <div class="t-name">Marcus K.</div>
                            <div class="t-role">Investor, New York</div>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card reveal reveal-delay-3">
                    <div class="t-stars"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i
                            class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                    </div>
                    <div class="t-quote">&ldquo;As a researcher I need to follow 30+ sources daily. Newsly condensed
                        that into one beautiful, structured feed. Incredible.&rdquo;</div>
                    <div class="t-author">
                        <div class="t-avatar" style="background:linear-gradient(135deg,#7b3fa0,#b07ad4);">AL</div>
                        <div>
                            <div class="t-name">Amara L.</div>
                            <div class="t-role">Academic researcher, Paris</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FAQ ── -->
    <section id="faq" style="background:var(--paper);">
        <div class="faq-section">
            <div class="faq-layout">
                <div class="faq-sticky reveal">
                    <div class="section-label">FAQ</div>
                    <h2 class="section-heading">Questions,<br><em>answered.</em></h2>
                    <p class="faq-sticky-desc">Can't find what you're looking for? Our support team is happy to help you
                        directly.</p>
                    <a href="#contact" class="btn-faq-contact">Contact Support <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="faq-list reveal reveal-delay-1">
                    <div class="faq-item open">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span class="faq-q-text">Is Newsly+ really free to start?</span>
                            <div class="faq-icon"><i class="bi bi-plus"></i></div>
                        </div>
                        <div class="faq-answer">Yes &mdash; our Starter plan is completely free, forever. No credit card
                            required. You get access to 5 publisher sources, a basic news feed, and 10 bookmarks per
                            month. Upgrade to Pro anytime to unlock the full experience.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span class="faq-q-text">How does the AI personalization work?</span>
                            <div class="faq-icon"><i class="bi bi-plus"></i></div>
                        </div>
                        <div class="faq-answer">Our AI engine analyzes your reading patterns &mdash; what you click, how
                            long you read, what you bookmark &mdash; and continuously fine-tunes your feed. You can also
                            manually tune it via your profile settings at any time.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span class="faq-q-text">Which publishers and sources are available?</span>
                            <div class="faq-icon"><i class="bi bi-plus"></i></div>
                        </div>
                        <div class="faq-answer">We aggregate content from 500+ premium sources including NYT, Bloomberg,
                            The Atlantic, Forbes, Wired, Reuters, The Economist, and many more. Pro users can also
                            request specific sources to be added.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span class="faq-q-text">Can I cancel my Pro subscription anytime?</span>
                            <div class="faq-icon"><i class="bi bi-plus"></i></div>
                        </div>
                        <div class="faq-answer">Absolutely. There are no contracts or lock-in periods. Cancel from your
                            account settings anytime. You keep Pro access until the end of your billing period, then
                            automatically revert to the free Starter plan.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span class="faq-q-text">Is my reading data private?</span>
                            <div class="faq-icon"><i class="bi bi-plus"></i></div>
                        </div>
                        <div class="faq-answer">We take privacy seriously. Your reading data is used solely to improve
                            your personal feed &mdash; never sold to advertisers. You can export or delete all your data
                            at any time. We are fully GDPR and CCPA compliant.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question" onclick="toggleFaq(this)">
                            <span class="faq-q-text">Do you have a mobile app?</span>
                            <div class="faq-icon"><i class="bi bi-plus"></i></div>
                        </div>
                        <div class="faq-answer">Yes! Newsly+ is available on iOS and Android. Your feed, bookmarks, and
                            preferences sync seamlessly across all devices in real time. The mobile app also supports
                            offline reading.</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ── CTA ── -->
    <section style="background: var(--paper);">
        <div class="cta-section">
            <div class="reveal">
                <div class="section-label cta-label">Get Started Today</div>
                <h2 class="cta-heading">Your smartest<br><em>read starts</em><br>right now.</h2>
                <p class="cta-sub">Join 20 million readers who've replaced scattered tabs with one intelligent,
                    beautiful feed.</p>
                <div class="cta-btns">
                    <a href="<?= BASE_URL ?>auth/register" class="btn-cta-main">
                        Get It Now — Free <i class="bi bi-arrow-right"></i>
                    </a>
                    <a href="#features" class="btn-cta-outline">
                        Explore Features <i class="bi bi-arrow-up-right"></i>
                    </a>
                </div>
            </div>

            <div class="cta-visual reveal reveal-delay-2">
                <div class="cta-main-img">
                    <img src="https://images.unsplash.com/photo-1585829365295-ab7cd400c167?w=700&q=80" alt="Reading"
                        style="width:100%;height:100%;object-fit:cover;border-radius:20px;opacity:0.75;">
                    <div
                        style="position:absolute;inset:0;background:linear-gradient(to bottom,transparent 40%,rgba(13,13,13,0.7));border-radius:20px;">
                    </div>
                    <div style="position:absolute;bottom:24px;left:24px;right:24px;">
                        <div
                            style="font-size:11px;font-weight:700;letter-spacing:0.1em;color:var(--accent2);margin-bottom:6px;">
                            FEATURED STORY</div>
                        <div
                            style="font-family:'Cormorant Garamond',serif;font-size:20px;font-weight:700;color:#fff;line-height:1.25;">
                            The Future of Digital Journalism in an AI-First World</div>
                    </div>
                </div>
                <div class="cta-card-stack">
                    <div class="cta-card-label">Connected Sources</div>
                    <div class="cta-card-sources">
                        <div class="cta-source">
                            <div class="cta-source-dot" style="background:#E63946;"></div>New York Times
                        </div>
                        <div class="cta-source">
                            <div class="cta-source-dot" style="background:#1A7A6B;"></div>Bloomberg
                        </div>
                        <div class="cta-source">
                            <div class="cta-source-dot" style="background:#2D5FA5;"></div>The Atlantic
                        </div>
                        <div class="cta-source">
                            <div class="cta-source-dot" style="background:#B8913F;"></div>Forbes
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- ── CONTACT ── -->
    <section id="contact" class="contact-section">
        <div class="contact-inner">
            <div class="contact-left reveal">
                <div class="section-label">Contact Us</div>
                <h2 class="contact-heading">Let's talk.<br><em>We're here</em><br>for you.</h2>
                <p class="contact-desc">Whether you have a question, partnership idea, or just want to say hello &mdash;
                    our team responds within 24 hours.</p>
                <div class="contact-info-items">
                    <div class="contact-info-item">
                        <div class="c-icon"><i class="bi bi-envelope"></i></div>
                        <div>
                            <div class="c-info-label">Email</div>
                            <div class="c-info-val">hello@newslyplus.com</div>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="c-icon"><i class="bi bi-telephone"></i></div>
                        <div>
                            <div class="c-info-label">Phone</div>
                            <div class="c-info-val">+1 (415) 555-0192</div>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="c-icon"><i class="bi bi-geo-alt"></i></div>
                        <div>
                            <div class="c-info-label">Office</div>
                            <div class="c-info-val">340 Pine St, San Francisco, CA 94104</div>
                        </div>
                    </div>
                    <div class="contact-info-item">
                        <div class="c-icon"><i class="bi bi-clock"></i></div>
                        <div>
                            <div class="c-info-label">Support Hours</div>
                            <div class="c-info-val">Mon &ndash; Fri, 9am &ndash; 6pm PST</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="reveal reveal-delay-2">
                <div class="contact-form">
                    <h3
                        style="font-family:'Cormorant Garamond',serif;font-size:28px;font-weight:700;letter-spacing:-0.02em;margin-bottom:28px;color:var(--ink);">
                        Send us a message</h3>
                    <div class="form-row">
                        <div class="form-group" style="margin-bottom:0;"><label class="form-lbl">First
                                Name</label><input type="text" class="form-inp" placeholder="Sophie"></div>
                        <div class="form-group" style="margin-bottom:0;"><label class="form-lbl">Last Name</label><input
                                type="text" class="form-inp" placeholder="Reynolds"></div>
                    </div>
                    <div class="form-group"><label class="form-lbl">Email Address</label><input type="email"
                            class="form-inp" placeholder="sophie@example.com"></div>
                    <div class="form-group">
                        <label class="form-lbl">Subject</label>
                        <select class="form-select">
                            <option value="">Select a topic...</option>
                            <option>General Inquiry</option>
                            <option>Billing &amp; Subscription</option>
                            <option>Publisher Partnership</option>
                            <option>Enterprise / Sales</option>
                            <option>Bug Report</option>
                            <option>Feature Request</option>
                        </select>
                    </div>
                    <div class="form-group"><label class="form-lbl">Message</label><textarea class="form-textarea"
                            placeholder="Tell us how we can help..."></textarea></div>
                    <button class="btn-submit" onclick="handleSubmit(this)">Send Message <i
                            class="bi bi-send"></i></button>
                    <p class="form-note"><i class="bi bi-shield-check me-1"></i>We respect your privacy. No spam, ever.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- ── FOOTER ── -->
    <footer class="site-footer">
        <div class="footer-inner">
            <div class="footer-top">
                <div>
                    <a href="#" class="footer-brand-name">Newsly<sup>+</sup></a>
                    <p class="footer-desc">The world's most intelligent news aggregator. One feed, 500+ publishers, zero
                        noise.</p>
                    <div class="footer-socials mt-4">
                        <a href="#"><i class="bi bi-twitter-x"></i></a>
                        <a href="#"><i class="bi bi-instagram"></i></a>
                        <a href="#"><i class="bi bi-linkedin"></i></a>
                        <a href="#"><i class="bi bi-github"></i></a>
                    </div>
                </div>
                <div>
                    <div class="footer-col-title">Product</div>
                    <ul class="footer-links">
                        <li><a href="#">Features</a></li>
                        <li><a href="#">Pricing</a></li>
                        <li><a href="#">Publishers</a></li>
                        <li><a href="#">Mobile App</a></li>
                        <li><a href="#">API Docs</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title">Company</div>
                    <ul class="footer-links">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Press Kit</a></li>
                        <li><a href="#">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <div class="footer-col-title">Legal</div>
                    <ul class="footer-links">
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms of Service</a></li>
                        <li><a href="#">Cookie Policy</a></li>
                        <li><a href="#">Accessibility</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <span>© 2026 Newsly Inc. All rights reserved.</span>
                <span>Crafted with precision · San Francisco, CA</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Sticky nav
        const nav = document.getElementById('siteNav');
        window.addEventListener('scroll', () => {
            if(nav) nav.classList.toggle('scrolled', window.scrollY > 60);
        });

        // Theme toggle functionality
        const themeToggleHome = document.getElementById('themeToggleHome');
        if(themeToggleHome) {
            themeToggleHome.addEventListener('click', function() {
                document.body.classList.toggle('dark-mode');
                const icon = this.querySelector('i');
                if (document.body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                    if(icon) icon.className = 'bi bi-sun fs-5';
                } else {
                    localStorage.setItem('theme', 'light');
                    if(icon) icon.className = 'bi bi-moon-stars fs-5';
                }
            });
        }

        // Initialize theme on page load
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
            const icon = document.querySelector('#themeToggleHome i');
            if(icon) icon.className = 'bi bi-sun fs-5';
        }

        // FAQ accordion
        function toggleFaq(el) {
            const item = el.parentElement;
            const isOpen = item.classList.contains('open');
            document.querySelectorAll('.faq-item').forEach(i => i.classList.remove('open'));
            if (!isOpen) item.classList.add('open');
        }

        // Contact form submit
        function handleSubmit(btn) {
            btn.innerHTML = '<i class="bi bi-check-circle-fill"></i> Message Sent!';
            btn.style.background = '#2d7a4f';
            btn.disabled = true;
            setTimeout(() => {
                btn.innerHTML = 'Send Message <i class="bi bi-send"></i>';
                btn.style.background = '';
                btn.disabled = false;
            }, 3500);
        }

        // Scroll reveal
        const revealEls = document.querySelectorAll('.reveal');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(e => {
                if (e.isIntersecting) { e.target.classList.add('visible'); observer.unobserve(e.target); }
            });
        }, { threshold: 0.1 });
        revealEls.forEach(el => observer.observe(el));

        // Mobile menu toggle
        function toggleMenu() {
            const mobileMenu = document.getElementById('mobileMenu');
            const hamburger = document.getElementById('hamburger');
            if(mobileMenu) mobileMenu.classList.toggle('open');
            if(hamburger) hamburger.classList.toggle('open');
        }
    </script>
</body>

</html>