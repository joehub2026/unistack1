# Testing Document — UniStack
## INES Digital Notice Board + Marketplace

---

## Test Environment
- **Server**: PHP 8.1 + MySQL 8.0 (XAMPP / InfinityFree)
- **Browsers tested**: Chrome 120, Firefox 121, Mobile Safari (iOS 17)
- **Testers**: Group members (see names in README)
- **Date**: March 2026

---

## Test Cases

### TC-01: Register with valid INES email
| Field | Detail |
|---|---|
| **Test ID** | TC-01 |
| **Feature** | User Registration |
| **Input** | full_name="Jean Pierre", email="jp@ines.ac.rw", password="test123", confirm="test123" |
| **Expected** | Account created, redirected to login with success flash |
| **Result** | ✅ PASS |
| **Notes** | Email stored in lowercase; password stored as bcrypt hash |

---

### TC-02: Register with non-INES email
| Field | Detail |
|---|---|
| **Test ID** | TC-02 |
| **Feature** | Email Validation |
| **Input** | email="student@gmail.com" |
| **Expected** | Form rejected with error: "Must use @ines.ac.rw email" |
| **Result** | ✅ PASS |
| **Notes** | Both client-side JS and server-side PHP validation triggered |

---

### TC-03: Login with correct credentials
| Field | Detail |
|---|---|
| **Test ID** | TC-03 |
| **Feature** | Authentication |
| **Input** | email="student@ines.ac.rw", password="password" |
| **Expected** | Session started, redirected to /board.php |
| **Result** | ✅ PASS |

---

### TC-04: Login with wrong password
| Field | Detail |
|---|---|
| **Test ID** | TC-04 |
| **Feature** | Authentication |
| **Input** | email="student@ines.ac.rw", password="wrongpass" |
| **Expected** | Error flash: "Invalid email or password" — no session created |
| **Result** | ✅ PASS |

---

### TC-05: Student creates a For Sale post
| Field | Detail |
|---|---|
| **Test ID** | TC-05 |
| **Feature** | Post CRUD — Create |
| **Input** | type=for_sale, title="Calculus Book", description="Good condition", price=5000 |
| **Expected** | Post saved with status="pending"; visible in student dashboard; NOT on public board |
| **Result** | ✅ PASS |

---

### TC-06: Moderator approves a pending post
| Field | Detail |
|---|---|
| **Test ID** | TC-06 |
| **Feature** | Approval Workflow |
| **Actor** | Moderator account |
| **Steps** | Login as moderator → Pending queue → Click Approve on TC-05 post |
| **Expected** | Post status changes to "approved"; post appears on public board |
| **Result** | ✅ PASS |

---

### TC-07: Moderator rejects a pending post
| Field | Detail |
|---|---|
| **Test ID** | TC-07 |
| **Feature** | Approval Workflow |
| **Actor** | Moderator account |
| **Steps** | Login as moderator → Pending queue → Click Reject |
| **Expected** | Post status="rejected"; student dashboard shows "Rejected" badge |
| **Result** | ✅ PASS |

---

### TC-08: Student flags a post
| Field | Detail |
|---|---|
| **Test ID** | TC-08 |
| **Feature** | Flagging / Report System |
| **Steps** | View an approved post → Click "Flag" → Enter reason → Submit |
| **Expected** | Report created with status="open"; moderator sees it in Reports queue |
| **Result** | ✅ PASS |

---

### TC-09: Search and category filter
| Field | Detail |
|---|---|
| **Test ID** | TC-09 |
| **Feature** | Search & Filter |
| **Steps** | Type "laptop" in search bar → submit; then click "For Sale" filter |
| **Expected** | Only posts matching "laptop" shown; filter shows only For Sale type |
| **Result** | ✅ PASS |

---

### TC-10: Student edits a rejected post
| Field | Detail |
|---|---|
| **Test ID** | TC-10 |
| **Feature** | Post CRUD — Edit |
| **Steps** | Dashboard → Find rejected post → Click Edit → Update title → Save |
| **Expected** | Post status resets to "pending" and enters review queue again |
| **Result** | ✅ PASS |

---

### TC-11: Admin changes user role to moderator
| Field | Detail |
|---|---|
| **Test ID** | TC-11 |
| **Feature** | Admin User Management |
| **Steps** | Admin → Users → Edit user → Change role to "moderator" → Save |
| **Expected** | User can now access /moderator/dashboard.php |
| **Result** | ✅ PASS |

---

### TC-12: JS polling updates notice board
| Field | Detail |
|---|---|
| **Test ID** | TC-12 |
| **Feature** | Real-time Simulation (JS Polling) |
| **Steps** | Open board in browser; in another tab, approve a new post as moderator |
| **Expected** | Within 10 seconds, "🟢 1 new post(s)" indicator appears on board |
| **Result** | ✅ PASS |
| **Notes** | Full page refresh still required to render new card — indicator alerts user |

---

### TC-13: Role-based access control
| Field | Detail |
|---|---|
| **Test ID** | TC-13 |
| **Feature** | Authorization |
| **Steps** | As student, manually navigate to /admin/dashboard.php |
| **Expected** | Redirect to /403.php — access denied |
| **Result** | ✅ PASS |

---

### TC-14: Deactivated user cannot login
| Field | Detail |
|---|---|
| **Test ID** | TC-14 |
| **Feature** | Account Suspension |
| **Steps** | Admin deactivates a student account; student tries to login |
| **Expected** | Flash: "Your account has been deactivated. Contact admin." |
| **Result** | ✅ PASS |

---

### TC-15: SQL Injection prevention
| Field | Detail |
|---|---|
| **Test ID** | TC-15 |
| **Feature** | Security — Prepared Statements |
| **Input** | email field: `' OR '1'='1` |
| **Expected** | Login fails normally; no SQL error; no unauthorized access |
| **Result** | ✅ PASS |
| **Notes** | All DB queries use MySQLi prepared statements |

---

## Test Summary
| Total Tests | Passed | Failed | Skipped |
|---|---|---|---|
| 15 | 15 | 0 | 0 |
