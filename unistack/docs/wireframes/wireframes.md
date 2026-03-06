# Wireframes — UniStack
*(Text-based wireframes — visual mockups in wireframes/ folder)*

---

## DESKTOP WIREFRAME — Notice Board (/board)

```
┌─────────────────────────────────────────────────────────────────────┐
│  NAVBAR: [INES UniStack Logo]    [Board] [Dashboard] [+ Post] [Logout] │
├─────────────────────────────────────────────────────────────────────┤
│                                                                     │
│  🔍 [Search posts...                    ] [🔄 Updated 2s ago]      │
│                                                                     │
│  [All] [🛒 For Sale] [🏠 Housing] [📢 Announcement]               │
│                                                                     │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐             │
│  │ 🛒 FOR SALE  │  │ 🏠 HOUSING   │  │ 📢 ANNOUNCE  │             │
│  │ Laptop HP    │  │ Room near    │  │ Exam Timetable│             │
│  │ 250,000 RWF  │  │ campus 60k   │  │ Posted by:    │             │
│  │ Posted: John │  │ Posted: Mary │  │ Admin         │             │
│  │ [View] [Flag]│  │ [View] [Flag]│  │ [View]        │             │
│  └──────────────┘  └──────────────┘  └──────────────┘             │
│                                                                     │
│  ┌──────────────┐  ┌──────────────┐  ┌──────────────┐             │
│  │  ...         │  │  ...         │  │  ...         │             │
│  └──────────────┘  └──────────────┘  └──────────────┘             │
│                                                                     │
│  [← Prev]  Page 1 of 3  [Next →]                                   │
└─────────────────────────────────────────────────────────────────────┘
```

---

## DESKTOP WIREFRAME — Student Dashboard (/dashboard)

```
┌──────────────────────────────────────────────────────────────┐
│  NAVBAR                                                      │
├────────────┬─────────────────────────────────────────────────┤
│  SIDEBAR   │  MY DASHBOARD                                   │
│            │                                                 │
│ 📋 My Posts│  ┌──────────┐ ┌──────────┐ ┌──────────┐       │
│ ➕ New Post│  │ Total: 5 │ │ ✅ Appr:3│ │ ⏳ Pend:1│       │
│ 🏠 Board  │  └──────────┘ └──────────┘ └──────────┘       │
│ 🚪 Logout │                                                 │
│            │  MY POSTS                                       │
│            │  ┌─────────────────────────────────────────┐   │
│            │  │ Title       │ Type    │ Status  │ Actions│   │
│            │  │ Laptop HP   │ For Sale│ ✅ Appr │ Edit   │   │
│            │  │ Room avail  │ Housing │ ⏳ Pend │ Edit   │   │
│            │  │ Lost phone  │ Announce│ ❌ Rej  │ Re-edit│   │
│            │  └─────────────────────────────────────────┘   │
└────────────┴─────────────────────────────────────────────────┘
```

---

## DESKTOP WIREFRAME — Moderator Pending Queue

```
┌──────────────────────────────────────────────────────────────┐
│  NAVBAR (Moderator)                                          │
├────────────┬─────────────────────────────────────────────────┤
│  SIDEBAR   │  PENDING APPROVAL (12 items)                    │
│            │                                                 │
│ ⏳ Pending │  ┌─────────────────────────────────────────────┐│
│ 🚩 Flagged│  │ [Post Title: Calculus Textbook - For Sale]  ││
│ ✅ Approved│  │ Type: For Sale | By: alice@ines.ac.rw       ││
│            │  │ "Selling my 2nd year calculus book, 3000rwf"││
│            │  │              [✅ Approve] [❌ Reject]       ││
│            │  ├─────────────────────────────────────────────┤│
│            │  │ [Post Title: Room in Karisimbi sector]      ││
│            │  │ Type: Housing | By: bob@ines.ac.rw          ││
│            │  │ "Spacious room, 50,000 RWF/month, WiFi"    ││
│            │  │              [✅ Approve] [❌ Reject]       ││
│            │  └─────────────────────────────────────────────┘│
└────────────┴─────────────────────────────────────────────────┘
```

---

## MOBILE WIREFRAME — Notice Board

```
┌─────────────────────┐
│ ≡  INES UniStack  + │
├─────────────────────┤
│ 🔍 [Search...     ] │
│ [All][Sale][Housing]│
│       [Announce]    │
├─────────────────────┤
│ ┌───────────────┐   │
│ │ 🛒 FOR SALE   │   │
│ │ HP Laptop     │   │
│ │ 250,000 RWF   │   │
│ │ John · 2h ago │   │
│ │ [View] [Flag] │   │
│ └───────────────┘   │
│ ┌───────────────┐   │
│ │ 🏠 HOUSING    │   │
│ │ Room Karisimbi│   │
│ │ 60,000/month  │   │
│ │ Mary · 5h ago │   │
│ │ [View] [Flag] │   │
│ └───────────────┘   │
│   [Load More...]    │
└─────────────────────┘
```

---

## MOBILE WIREFRAME — Login

```
┌─────────────────────┐
│                     │
│   INES UniStack     │
│   Campus Marketplace│
│                     │
│  Email:             │
│  [________________] │
│                     │
│  Password:          │
│  [________________] │
│                     │
│  [    LOGIN    ]    │
│                     │
│  Don't have account?│
│  [Register here]    │
│                     │
└─────────────────────┘
```
