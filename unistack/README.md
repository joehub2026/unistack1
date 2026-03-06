# UniStack — INES Digital Notice Board + Marketplace

> **Assignment #2 — From Street to Stack**  
> INES-Ruhengeri | Faculty of Sciences & IT | Advanced Web Design & Development  
> Scenario C: UniStack (Advanced)

---

## 🎯 Project Summary
A student-only marketplace and digital notice board for INES-Ruhengeri, replacing
unsafe WhatsApp-based buying/selling and information sharing with a moderated,
role-protected web platform.

---

## 👥 Team Members & Roles

| Name | Role | GitHub Contributions |
|---|---|---|
| [Name 1] | Team Lead + Backend (Models/Controllers) | Auth, Post CRUD |
| [Name 2] | Frontend (Views + CSS) | UI, board, dashboard |
| [Name 3] | Database Design + Admin Panel | Schema, Admin views |
| [Name 4] | Moderator Panel + Testing | Mod workflows, docs |
| [Name 5] | Deployment + Documentation | README, testing.md |

---

## 🔑 Test Login Credentials

| Role | Email | Password |
|---|---|---|
| Admin | admin@ines.ac.rw | password |
| Moderator | moderator@ines.ac.rw | password |
| Student | student@ines.ac.rw | password |

---

## 🗂 Repository Structure

```
unistack/
├── index.php                  ← Landing page
├── login.php                  ← Login entry
├── register.php               ← Register entry
├── logout.php
├── board.php                  ← Notice board
├── dashboard.php              ← Student dashboard
├── post/
│   ├── create.php
│   ├── view.php
│   ├── edit.php
│   ├── delete.php
│   └── report.php
├── moderator/
│   ├── dashboard.php
│   ├── approve.php
│   ├── reject.php
│   └── report_action.php
├── admin/
│   ├── dashboard.php
│   ├── users.php
│   ├── update_user.php
│   ├── posts.php (all_posts.php)
│   └── reports.php
├── api/
│   └── poll.php               ← JS polling endpoint
├── app/
│   ├── config/
│   │   ├── db.php             ← DB connection + constants
│   │   └── auth.php           ← Session + auth helpers
│   ├── models/
│   │   ├── UserModel.php
│   │   ├── PostModel.php
│   │   └── ReportModel.php
│   ├── controllers/
│   │   ├── AuthController.php
│   │   ├── PostController.php
│   │   ├── ModeratorController.php
│   │   └── AdminController.php
│   ├── views/
│   │   ├── shared/ (header, footer, login, register)
│   │   ├── student/ (board, dashboard, post_*)
│   │   ├── moderator/ (dashboard)
│   │   └── admin/ (dashboard, users, reports)
│   └── schema.sql             ← Full database schema + seed data
├── public/
│   ├── css/style.css
│   └── js/main.js
└── docs/
    ├── street-report.md
    ├── problem.md
    ├── stakeholders.md
    ├── user-stories.md
    ├── scope.md
    ├── ui-style.md
    ├── page-map.md
    ├── testing.md
    ├── AI-usage.md
    └── wireframes/
        └── wireframes.md
```

---

## ⚙️ Setup Instructions

### Requirements
- PHP 8.0+
- MySQL 8.0+
- Web server (Apache via XAMPP, or InfinityFree/000webhost for deployment)

### Local Setup (XAMPP)

1. **Clone the repo** into your `htdocs` folder:
   ```
   git clone <repo-url> htdocs/unistack
   ```

2. **Create the database:**
   - Open phpMyAdmin at `http://localhost/phpmyadmin`
   - Click "New" → create database named `unistack_db`
   - Select the database → click "Import"
   - Upload `app/schema.sql` → click "Go"

3. **Configure DB credentials:**  
   Edit `app/config/db.php`:
   ```php
   define('DB_HOST', 'localhost');
   define('DB_USER', 'root');
   define('DB_PASS', '');         // your MySQL password
   define('DB_NAME', 'unistack_db');
   define('BASE_URL', 'http://localhost/unistack');
   ```

4. **Visit** `http://localhost/unistack/` in your browser.

---

### Deployment (InfinityFree / 000webhost)

1. Upload all files via File Manager or FTP to `htdocs/`
2. Create MySQL database from hosting control panel
3. Import `app/schema.sql` via phpMyAdmin in the control panel
4. Update `app/config/db.php` with hosting DB credentials and live URL
5. Visit your live domain

---

## ✅ Features Implemented

- [x] School email pattern login (simulation: @ines.ac.rw)
- [x] 3 roles: Student / Moderator / Admin
- [x] Post types: For Sale | Housing | Announcement
- [x] Approval workflow: Pending → Approved / Rejected
- [x] Student dashboard with stats
- [x] Report/flag system with reason
- [x] Search + category filter
- [x] JS polling (simulated real-time, 10s)
- [x] Admin user management + role assignment
- [x] Moderator queue (pending + reports)
- [x] MVC architecture (Views never write SQL)
- [x] MySQLi prepared statements throughout
- [x] Responsive design (mobile + desktop)
- [x] All 5 phases documented in /docs

---

## 📎 Links
- **Live URL**: `[insert after deployment]`
- **GitHub Repo**: `[insert repo URL]`
- **Submission Email**: mclement@ines.ac.rw
