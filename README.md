NAME: Pollene Joy . De Chavez
SECTION: BSIS 3A


Student Enrollment System (CRUD + Async)
#Project Description
-This is a Student Enrollment System built with PHP (PDO) for the backend and JavaScript (fetch API with async/await) for the frontend.
It supports full CRUD operations (Create, Read, Update, Delete) for Students, Programs, Years, Semesters, Subjects, and Enrollments.

The system allows:
-Managing students and their program details.
-Adding, updating, and deleting programs, years, semesters, and subjects.
-Enrolling students in subjects per semester.
-Searching and filtering students by program and subjects by semester.
-Managing all records dynamically without page reloads.

#Features Implemented
-Students Management – Add, view, update, delete students with allowance and program assignment; search and filter.
-Programs Management – Add, update, delete programs with institute ID.
-Years & Semesters Management – Manage school years and semesters.
-Subjects Management – Manage subjects per semester; search and filter subjects.
-Enrollments Management – Enroll a student in subjects; update/remove enrollment.
-UI & UX – Modal forms for add/edit, async fetch API, DOM updates, basic sanitization.

#Known Issues & Limitations
Not perfect code – There are areas for refactoring and better structure.
Editing/Validation – Forms rely on HTML required; missing inline validation/error messages.
Errors may occur if backend constraints are not fully enforced (e.g., deleting programs with students, deleting subjects with enrollments).
Stretch goals not implemented – Pagination, spinners, and more advanced validation.

#Setup Instructions
1. Requirements
-XAMPP Control Panel v3.3.0 (Compiled: Apr 6th 2021)
-Includes Apache, PHP, and MySQL/MariaDB.
-A modern browser (Chrome, Edge, Firefox recommended).