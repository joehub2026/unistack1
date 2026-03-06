# UI Style Guide — UniStack

## Brand Concept
**"Clean Campus"** — A trustworthy, academic-grade interface that feels official enough
to be taken seriously, but friendly enough for student daily use.

---

## Color Palette
```
--primary:       #1B4F72   /* Deep Navy — trust, academia */
--primary-light: #2E86C1   /* Medium Blue — interactive */
--accent:        #F39C12   /* Amber — CTAs, highlights */
--success:       #27AE60   /* Green — Approved status */
--warning:       #F1C40F   /* Yellow — Pending status */
--danger:        #E74C3C   /* Red — Rejected / Report */
--bg:            #F4F6F8   /* Light grey background */
--surface:       #FFFFFF   /* Card / panel surface */
--text-primary:  #1A252F   /* Near black body text */
--text-muted:    #717D7E   /* Muted/secondary text */
--border:        #D5D8DC   /* Subtle borders */
```

---

## Typography
- **Headings**: `'Merriweather', serif` — academic authority
- **Body/UI**: `'DM Sans', sans-serif` — modern readability
- **Code/IDs**: `'JetBrains Mono', monospace`

### Scale
| Element | Size | Weight |
|---|---|---|
| Page Title (h1) | 2rem | 700 |
| Section Heading (h2) | 1.5rem | 600 |
| Card Title (h3) | 1.125rem | 600 |
| Body Text | 1rem | 400 |
| Small/Muted | 0.875rem | 400 |
| Label | 0.75rem | 500 (uppercase) |

---

## Component Styles

### Status Badges
```
Pending  → background: #FEF9E7, color: #B7950B, border: 1px solid #F1C40F
Approved → background: #EAFAF1, color: #1E8449, border: 1px solid #27AE60
Rejected → background: #FDEDEC, color: #C0392B, border: 1px solid #E74C3C
Flagged  → background: #FDF2F8, color: #8E44AD, border: 1px solid #9B59B6
```

### Buttons
```
Primary   → bg: #1B4F72, text: white, hover: #2E86C1
Secondary → bg: transparent, border: #1B4F72, text: #1B4F72
Danger    → bg: #E74C3C, text: white
Success   → bg: #27AE60, text: white
```

### Cards
- White background, 8px border radius
- 1px solid #D5D8DC border
- `box-shadow: 0 2px 8px rgba(0,0,0,0.06)`
- 20px padding

---

## Layout Principles
- **Grid**: 12-column CSS Grid for desktop, single column for mobile
- **Breakpoints**: Mobile < 768px | Tablet 768–1024px | Desktop > 1024px
- **Sidebar**: Fixed left sidebar for authenticated user dashboards
- **Notice Board**: Card grid (3 columns desktop, 1 column mobile)
- **Max container width**: 1200px, centered

---

## Iconography
- Use inline SVG icons or Unicode symbols (no external icon library dependency)
- Category icons:
  - 🛒 For Sale
  - 🏠 Housing
  - 📢 Announcement
  - 🚩 Flagged
  - ✅ Approved
  - ⏳ Pending
