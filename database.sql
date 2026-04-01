-- Newsly Database Schema
CREATE DATABASE IF NOT EXISTS newsly CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE newsly;

-- Users Table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    avatar VARCHAR(255) NULL,
    bio TEXT NULL,
    verification_token VARCHAR(64) NULL,
    email_verified_at TIMESTAMP NULL,
    reset_token VARCHAR(64) NULL,
    is_admin TINYINT(1) DEFAULT 0,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_users_email (email)
);

-- Categories Table
CREATE TABLE IF NOT EXISTS categories (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    slug VARCHAR(100) NOT NULL UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Articles Table
CREATE TABLE IF NOT EXISTS articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_url VARCHAR(255) NULL,
    source_name VARCHAR(100) NULL,
    source_url VARCHAR(255) NULL,
    published_at DATETIME NOT NULL,
    category_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE CASCADE,
    INDEX idx_articles_category (category_id),
    INDEX idx_articles_published (published_at)
);

-- Bookmarks Table
CREATE TABLE IF NOT EXISTS bookmarks (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    article_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    UNIQUE KEY unique_bookmark (user_id, article_id)
);

-- Optional Likes Table
CREATE TABLE IF NOT EXISTS likes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    article_id INT NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (article_id) REFERENCES articles(id) ON DELETE CASCADE,
    UNIQUE KEY unique_like (user_id, article_id)
);

-- Insert Demo Admin User (Password: admin123)
INSERT IGNORE INTO users (name, email, password, is_admin) VALUES 
('System Admin', 'admin@newsly.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);

-- Insert Demo Categories
INSERT IGNORE INTO categories (name, slug) VALUES 
('Technology', 'technology'),
('World News', 'world-news'),
('Business', 'business'),
('Science', 'science'),
('Entertainment', 'entertainment');

-- Insert Many Demo Articles (Mock Data to ensure density)
INSERT IGNORE INTO articles (title, content, image_url, source_name, source_url, published_at, category_id) VALUES
('AI Breakthrough in 2026', 'Artificial intelligence has taken a massive leap forward this year... <p>Full detailed content goes here.</p>', 'public/images/unsplash/ai.jpg', 'Tech Daily', 'https://example.com/ai', '2026-03-31 10:00:00', 1),
('Global Markets Rally', 'Stock markets around the world saw unprecedented growth today... <p>Full detailed content goes here.</p>', 'public/images/unsplash/markets.jpg', 'Finance News', 'https://example.com/finance', '2026-03-30 14:30:00', 3),
('New Exoplanet Discovered', 'Astronomers have found an Earth-sized exoplanet in the habitable zone... <p>Full detailed content goes here.</p>', 'public/images/unsplash/space.jpg', 'Space Weekly', 'https://example.com/space', '2026-03-29 09:15:00', 4),
('The Future of Quantum Computing', 'Quantum supremacy is finally being achieved in mainstream laboratories.', 'public/images/unsplash/quantum.jpg', 'Science Today', 'https://example.com/quantum', NOW(), 1),
('Billionaire Space Race Heats Up', 'Commercial space travel is becoming more than just a dream for the elite.', 'public/images/unsplash/rocket.jpg', 'Astro Gazette', 'https://example.com/space-race', NOW(), 1),
('Electric Vehicle Sales Surge 200%', 'Sustainability meets efficiency as the world moves away from fossil fuels.', 'public/images/unsplash/tesla.jpg', 'World News', 'https://example.com/ev', NOW(), 2),
('Virtual Reality in Education', 'Students are now exploring the solar system from their classrooms.', 'public/images/unsplash/vr.jpg', 'Tech Weekly', 'https://example.com/vr-edu', NOW(), 1),
('Sustainable Cities of 2030', 'Architects are designing green oasis in the heart of concrete jungles.', 'public/images/unsplash/green.jpg', 'Guardian World', 'https://example.com/green-city', NOW(), 2),
('Cryptocurrency Market Trends', 'Volatility remains high but institutional adoption is on the rise.', 'public/images/unsplash/crypto.jpg', 'Finance Times', 'https://example.com/crypto-news', NOW(), 3),
('Breakthrough in Cancer Research', 'New immunotherapy techniques show consistent positive results in clinical trials.', 'public/images/unsplash/med.jpg', 'Health Science', 'https://example.com/med-tech', NOW(), 4),
('New Film Nominated for 10 Oscars', 'A masterpiece of cinema has taken the industry by storm this awards season.', 'public/images/unsplash/cinema.jpg', 'Entertainment Now', 'https://example.com/oscar-winner', NOW(), 5),
('Music Industry Shifts to VR Concerts', 'Fans are experiencing their favorite artists like never before in digital arenas.', 'public/images/unsplash/live.jpg', 'Rolling News', 'https://example.com/live-vr', NOW(), 5),
('Robotics in HealthCare', 'Precision surgery is reaching new heights with autonomous assistants.', 'public/images/unsplash/robot.jpg', 'Future Health', 'https://example.com/healthcare-robot', NOW(), 4),
('Renewable Energy Goals for 2050', 'Nations are pledging to reach carbon neutrality through wind and solar power.', 'public/images/unsplash/wind.jpg', 'World Earth', 'https://example.com/energy-goals', NOW(), 2),
('Cybersecurity Trends for 2026', 'Protecting user data has become the number one priority for tech giants.', 'public/images/unsplash/cyber.jpg', 'Security Hub', 'https://example.com/cyber-news', NOW(), 1),
('Remote Work and Global Connectivity', 'The work-from-home revolution is reshaping the traditional office concept.', 'public/images/unsplash/work.jpg', 'Business Insider', 'https://example.com/remote-work', NOW(), 3),
('AI-Driven Artistic Expression', 'Computers are now creating art that challenges human creativity.', 'public/images/unsplash/art.jpg', 'Arts and Tech', 'https://example.com/ai-art', NOW(), 5),
('The Impact of Ocean Conservation', 'New marine protected areas are helping restore biodiversity in the Atlantic.', 'public/images/unsplash/ocean.jpg', 'Eco News', 'https://example.com/ocean', NOW(), 4),
('Global Education Reform', 'Adaptive learning platforms are personalizing education for millions.', 'public/images/unsplash/edu.jpg', 'Global Learner', 'https://example.com/edu-reform', NOW(), 2),
('5G Expansion and Mobile Speeds', 'High-speed internet is reaching even the most remote areas of the globe.', 'public/images/unsplash/5g.jpg', 'Carrier News', 'https://example.com/5g-news', NOW(), 1),
('Mental Health Awareness in 2026', 'Digital therapy programs are becoming as standard as physical checkups.', 'public/images/unsplash/health.jpg', 'Wellbeing Digest', 'https://example.com/wellbeing', NOW(), 4);

