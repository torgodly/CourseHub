# Laravel Routes Implementation Checklist

## GET Requests

### Auth

-   [x] `/login` – Login view (guest only)
-   [x] `/register` – Registration form (guest only)

### Home & Courses

-   [x] `/` – Homepage (`HomePageController@index`)
-   [x] `/courses` – Course listing
-   [x] `/courses/{course:slug}` – Single course view
-   [x] `/courses/{course}/sections/{section}` – Show section content
-   [x] `/favorites` – Favorites page (auth only) – **needs Blade view**
-   [ ] `/my-courses` – Purchased courses page (auth only)
-   [ ] `/wallet` – Wallet page (auth only)

### Profile

-   [x] `/profile` – Show user profile

### Trainer

-   [ ] `/trainer/apply` – Trainer application form (auth only)

---

## POST / Other Requests

### Auth

-   [x] `/register` – Handle registration (guest only)
-   [x] `/login` – Handle login (guest only)
-   [x] `/logout` – Logout (auth only)

### Courses

-   [x] `/courses/{course}/buy` – Purchase course
-   [ ] `/courses/{course}/enroll` – Enroll in course (not done)
-   [x] `/courses/{course}/favorite` – Toggle favorite
-   [ ] `/courses/{course}/rate` – Rate a course (not done)

### Profile

-   [x] `/profile/update` – Update profile info
-   [x] `/profile/password` – Update password

### Trainer

-   [ ] `/trainer/apply` – Submit trainer application (not done)

### Voucher

-   [ ] `/vouchers/redeem` – Redeem voucher code

---

## Extra To-Do

-   [ ] Add **rating display in views** (average + user rating)
-   [ ] Make **new Blade page for favorites**
-   [x] Apply **auth / guest middleware** properly (already applied)
-   [ ] Add **browser-side auth checks** (JS/Alpine) to hide/show buttons for guests
