# User Stories — UniStack

## Student Role

### US-01: Register with School Email
**As a** student,  
**I want to** register using my INES school email (e.g., s.names@ines.ac.rw),  
**So that** only real INES students can access the platform.  
**Acceptance Criteria:**
- System validates email matches pattern `*@ines.ac.rw`
- Duplicate emails are rejected
- Password is stored securely (hashed)

### US-02: Post a For Sale Listing
**As a** student,  
**I want to** create a "For Sale" post with title, description, price, and category,  
**So that** other students can find and contact me about the item.  
**Acceptance Criteria:**
- Post is saved with status "Pending"
- Student sees it in their dashboard as "Pending"
- Post is not visible on public board until approved

### US-03: Post a Housing Notice
**As a** student,  
**I want to** post a housing listing with location, rent, and description,  
**So that** classmates looking for accommodation can find it.  
**Acceptance Criteria:**
- Post type "Housing" is selectable
- Post enters Pending queue for moderation
- Approved posts appear under Housing category filter

### US-04: Post an Announcement
**As a** student,  
**I want to** post an announcement (event, lost item, study group),  
**So that** the INES community is informed.  
**Acceptance Criteria:**
- Post type "Announcement" is selectable
- Approved announcements appear in notice board view

### US-05: Search and Filter Posts
**As a** student,  
**I want to** search posts by keyword and filter by category,  
**So that** I can quickly find what I'm looking for.  
**Acceptance Criteria:**
- Search bar filters live on the board
- Category buttons filter between: All | For Sale | Housing | Announcement
- Only approved posts appear in results

### US-06: View My Dashboard
**As a** student,  
**I want to** see all my posts with their status (Pending/Approved/Rejected),  
**So that** I know which posts are live and which need attention.  
**Acceptance Criteria:**
- Dashboard shows: My Posts count, Approved count, Pending count
- Each post shows its current status badge

### US-07: Flag / Report a Post
**As a** student,  
**I want to** report a post I believe is a scam or inappropriate,  
**So that** moderators are alerted and can take action.  
**Acceptance Criteria:**
- Each post has a "Report" button
- Clicking it prompts for a brief reason
- Report is logged and visible to moderators
- Student sees confirmation: "Report submitted"

### US-08: See Real-Time Updates
**As a** student,  
**I want** the notice board to refresh automatically every 10 seconds,  
**So that** I can see new approved posts without manually reloading.  
**Acceptance Criteria:**
- JS polling runs every 10 seconds
- New posts appear without full page reload
- A subtle "Updated" indicator is shown when refresh occurs

---

## Moderator Role

### US-09: Review Pending Posts
**As a** moderator,  
**I want to** see all posts awaiting approval in one queue,  
**So that** I can efficiently review and action them.  
**Acceptance Criteria:**
- Moderator dashboard shows all Pending posts
- Each post shows: type, content, author, submitted time
- Approve and Reject buttons are present

### US-10: Review Flagged Posts
**As a** moderator,  
**I want to** see posts that have been flagged by students,  
**So that** I can investigate and take action.  
**Acceptance Criteria:**
- Flagged posts appear in a separate "Reports" queue
- Moderator can approve, reject, or dismiss the flag

---

## Admin Role

### US-11: Manage Users
**As an** admin,  
**I want to** view all registered users and suspend or delete accounts,  
**So that** bad actors can be removed from the platform.  
**Acceptance Criteria:**
- Admin sees a full user list with roles and status
- Can activate/deactivate any account

### US-12: Promote User to Moderator
**As an** admin,  
**I want to** change a student's role to Moderator,  
**So that** trusted students can help moderate content.  
**Acceptance Criteria:**
- Role dropdown on user management panel
- Change is saved and reflected immediately
