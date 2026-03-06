# Scope & Non-Functional Requirements — UniStack

## In Scope
| Feature | Description |
|---|---|
| Authentication | Register/Login with school email validation |
| Post CRUD | Create, Read, Update, Delete posts (student) |
| Post Types | For Sale, Housing, Announcement |
| Approval Workflow | Pending → Approved / Rejected |
| Student Dashboard | My posts, approved, pending counts |
| Moderator Queue | Approve/reject pending posts, handle reports |
| Admin Panel | User management, role assignment, deactivation |
| Flag System | Students can report posts with reason |
| Search & Filter | Keyword search + category filter on board |
| JS Polling | Auto-refresh every 10s (simulated real-time) |
| Responsive UI | Mobile + desktop layouts |

## Out of Scope (v1)
- Real-time chat / messaging between users
- Payment processing
- Email notification system
- Image uploads (placeholders used)
- Mobile app

---

## Non-Functional Requirements

### Security
- Passwords must be hashed using `password_hash()` (bcrypt)
- All DB queries use MySQLi prepared statements (no raw SQL injection risk)
- Session-based authentication; role checked on every protected page
- School email pattern enforced: must end in `@ines.ac.rw`

### Performance
- Pages load within 3 seconds on standard campus WiFi
- JS polling uses lightweight AJAX (JSON response only, no full page reload)
- Pagination on the notice board (max 20 posts per page)

### Usability
- Mobile-first responsive design
- Intuitive navigation; max 2 clicks to reach any core feature
- Clear status badges (color-coded: Pending=yellow, Approved=green, Rejected=red)
- Accessible contrast ratios (WCAG AA minimum)

### Reliability
- Input validation on both client (JS) and server (PHP) side
- Graceful error messages for failed operations
- All workflow state changes are stored with timestamps

### Maintainability
- Strict MVC separation: Views never contain SQL
- Reusable PHP partials (header, footer, nav)
- Config file for DB credentials (not hardcoded in logic files)
- Code commented for team clarity

### Git Discipline
- Minimum 25 commits total
- Every member: minimum 3 commits
- Commit messages follow format: `feat:`, `fix:`, `docs:`, `style:`
