-- ============================================================
-- UniStack — INES Digital Notice Board + Marketplace
-- MySQL Database Schema
-- ============================================================

CREATE DATABASE IF NOT EXISTS unistack_db
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_unicode_ci;

USE unistack_db;

-- ============================================================
-- USERS TABLE
-- ============================================================
CREATE TABLE users (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    full_name   VARCHAR(100) NOT NULL,
    email       VARCHAR(150) NOT NULL UNIQUE,
    password    VARCHAR(255) NOT NULL,
    role        ENUM('student', 'moderator', 'admin') NOT NULL DEFAULT 'student',
    is_active   TINYINT(1) NOT NULL DEFAULT 1,
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

-- ============================================================
-- POSTS TABLE
-- ============================================================
CREATE TABLE posts (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    user_id      INT NOT NULL,
    title        VARCHAR(200) NOT NULL,
    description  TEXT NOT NULL,
    post_type    ENUM('for_sale', 'housing', 'announcement') NOT NULL,
    price        DECIMAL(10,2) DEFAULT NULL,       -- NULL for non-sale posts
    status       ENUM('pending', 'approved', 'rejected') NOT NULL DEFAULT 'pending',
    reviewed_by  INT DEFAULT NULL,                 -- FK to users (moderator/admin)
    reviewed_at  DATETIME DEFAULT NULL,
    created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    updated_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id)     REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (reviewed_by) REFERENCES users(id) ON DELETE SET NULL
);

-- ============================================================
-- REPORTS (FLAGGING) TABLE
-- ============================================================
CREATE TABLE reports (
    id           INT AUTO_INCREMENT PRIMARY KEY,
    post_id      INT NOT NULL,
    reported_by  INT NOT NULL,
    reason       VARCHAR(300) NOT NULL,
    status       ENUM('open', 'reviewed', 'dismissed') NOT NULL DEFAULT 'open',
    actioned_by  INT DEFAULT NULL,
    actioned_at  DATETIME DEFAULT NULL,
    created_at   DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id)     REFERENCES posts(id) ON DELETE CASCADE,
    FOREIGN KEY (reported_by) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (actioned_by) REFERENCES users(id) ON DELETE SET NULL
);

-- ============================================================
-- AUDIT LOG TABLE (optional but good practice)
-- ============================================================
CREATE TABLE audit_log (
    id          INT AUTO_INCREMENT PRIMARY KEY,
    user_id     INT DEFAULT NULL,
    action      VARCHAR(100) NOT NULL,   -- e.g. 'approved_post', 'rejected_post', 'banned_user'
    target_type VARCHAR(50),             -- 'post' or 'user'
    target_id   INT DEFAULT NULL,
    notes       VARCHAR(300),
    created_at  DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE SET NULL
);

-- ============================================================
-- SEED DATA — Default admin account
-- Password: admin123 (bcrypt hash — change in production!)
-- ============================================================
INSERT INTO users (full_name, email, password, role) VALUES
(
    'System Admin',
    'admin@ines.ac.rw',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'admin'
),
(
    'Demo Moderator',
    'moderator@ines.ac.rw',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'moderator'
),
(
    'Demo Student',
    'student@ines.ac.rw',
    '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'student'
);

-- Demo posts
INSERT INTO posts (user_id, title, description, post_type, price, status, reviewed_by, reviewed_at) VALUES
(3, 'HP Laptop for Sale', 'Selling my HP 250 G8 laptop. Good condition, 8GB RAM, 256GB SSD. Selling because I upgraded.', 'for_sale', 250000.00, 'approved', 2, NOW()),
(3, 'Room Available Near Campus', 'Spacious room available in Karisimbi sector, 5 min walk to INES. WiFi included. 60,000 RWF/month.', 'housing', 60000.00, 'approved', 2, NOW()),
(3, 'Study Group - Linear Algebra', 'Forming a study group for Linear Algebra final exam. Meet every Saturday 2PM in Library Room 3.', 'announcement', NULL, 'pending', NULL, NULL);
