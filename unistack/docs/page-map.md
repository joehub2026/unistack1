# Page Map — UniStack

## Public Pages (No Login Required)
```
/                    → Landing page (platform intro + login/register CTA)
/login               → Login form
/register            → Registration form (school email validation)
```

## Student Pages (Role: student)
```
/board               → Public notice board (search + filter + auto-refresh)
/post/create         → Create new post (type selector: For Sale / Housing / Announcement)
/post/view/{id}      → Single post detail view + Report button
/post/edit/{id}      → Edit own post (only if Pending or Rejected)
/post/delete/{id}    → Delete own post (confirmation)
/dashboard           → Student dashboard (my posts, stats, status overview)
/logout              → Session destroy + redirect to login
```

## Moderator Pages (Role: moderator)
```
/moderator/dashboard → Overview: pending count, flagged count
/moderator/pending   → Queue of all Pending posts → Approve / Reject
/moderator/flagged   → Queue of Flagged posts → Action / Dismiss
/moderator/approved  → List of approved posts (can reject if needed)
```

## Admin Pages (Role: admin)
```
/admin/dashboard     → Overview stats: total users, total posts, pending, flagged
/admin/users         → Full user list: name, email, role, status
/admin/users/edit/{id} → Change role / activate / deactivate user
/admin/posts         → All posts (any status) with full controls
/admin/reports       → All flag reports log
```

## System / Utility
```
/api/poll            → JSON endpoint for JS polling (returns new approved posts since timestamp)
404.php              → Custom not found page
403.php              → Access denied page
```

---

## Navigation Flow Diagram

```
[Landing Page]
    ↓
[Login / Register]
    ↓
[Role Check]
    ├── student    → [Notice Board] ←→ [Dashboard] ←→ [Create Post]
    ├── moderator  → [Mod Dashboard] ←→ [Pending Queue] ←→ [Flagged Queue]
    └── admin      → [Admin Dashboard] ←→ [Users] ←→ [Posts] ←→ [Reports]
```
