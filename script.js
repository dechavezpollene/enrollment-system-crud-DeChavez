
async function fetchJson(url, options = {}) {
  try {
    const res = await fetch(url, options);
    if (!res.ok) return { success: false, message: `HTTP ${res.status}` };
    return await res.json();
  } catch (err) {
    return { success: false, message: err.message };
  }
}

function escapeHtml(str) {
  if (str === null || str === undefined) return '';
  return String(str)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

const allData = { students: [], programs: [], years: [], semesters: [], subjects: [], enrollments: [] };

// Students
async function loadStudents() {
  const res = await fetchJson("api/students/getStudent.php");
  if (!res.success) { alert(res.message); return; }
  allData.students = res.data || [];

  const filterProgram = document.getElementById("filterProgram") ? document.getElementById("filterProgram").value : "";
  const searchText = document.getElementById("searchStudent") ? document.getElementById("searchStudent").value.toLowerCase() : "";

  const tbody = document.querySelector("#tblStudents tbody");
  tbody.innerHTML = "";

  allData.students
    .filter(s => !filterProgram || s.program_id == filterProgram)
    .filter(s => `${s.First_Name} ${s.Last_Name}`.toLowerCase().includes(searchText))
    .forEach(s => {
      tbody.innerHTML += `<tr>
        <td>${s.stud_id}</td>
        <td>${escapeHtml(s.First_Name)}</td>
        <td>${escapeHtml(s.Middle_Name)}</td>
        <td>${escapeHtml(s.Last_Name)}</td>
        <td>${escapeHtml(s.program_name || '')}</td>
        <td>${s.Allowance}</td>
        <td>
          <button onclick='showForm("students", ${JSON.stringify(s)})'>Edit</button>
          <button onclick='deleteRow("students", ${s.stud_id})'>Delete</button>
        </td>
      </tr>`;
    });
}

// Programs
async function loadPrograms() {
  const res = await fetchJson("api/program/getPrograms.php");
  if (!res.success) { alert(res.message); return; }
  allData.programs = res.data || [];
  const tbody = document.querySelector("#tblPrograms tbody");
  tbody.innerHTML = "";
  allData.programs.forEach(p => {
    tbody.innerHTML += `<tr>
      <td>${p.program_id}</td>
      <td>${escapeHtml(p.program_name)}</td>
      <td>${p.ins_id}</td>
      <td>
        <button onclick='showForm("program", ${JSON.stringify(p)})'>Edit</button>
        <button onclick='deleteRow("program", ${p.program_id})'>Delete</button>
      </td>
    </tr>`;
  });
}

//YEars
async function loadYears() {
  const res = await fetchJson("api/Years&Semesters/getYears.php");
  if (!res.success) { alert(res.message); return; }
  allData.years = res.data || [];
  const tbody = document.querySelector("#tblYears tbody");
  tbody.innerHTML = "";
  allData.years.forEach(y => {
    tbody.innerHTML += `<tr>
      <td>${y.year_id}</td>
      <td>${y.year_from}</td>
      <td>${y.year_to}</td>
      <td>
        <button onclick='showForm("year", ${JSON.stringify(y)})'>Edit</button>
        <button onclick='deleteRow("year", ${y.year_id})'>Delete</button>
      </td>
    </tr>`;
  });
}

// Semesters 
async function loadSemesters() {
  const res = await fetchJson("api/Years&Semesters/getSemesters.php");
  if (!res.success) { alert(res.message); return; }
  allData.semesters = res.data || [];
  const tbody = document.querySelector("#tblSemesters tbody");
  tbody.innerHTML = "";
  allData.semesters.forEach(s => {
    tbody.innerHTML += `<tr>
      <td>${s.sem_id}</td>
      <td>${escapeHtml(s.sem_name)}</td>
      <td>${s.year_id}</td>
      <td>
        <button onclick='showForm("semester", ${JSON.stringify(s)})'>Edit</button>
        <button onclick='deleteRow("semester", ${s.sem_id})'>Delete</button>
      </td>
    </tr>`;
  });
}

//  Subjects
async function loadSubjects() {
  const res = await fetchJson("api/Subjects/getSubjects.php");
  if (!res.success) { alert(res.message); return; }
  allData.subjects = res.data || [];

  const filterSemester = document.getElementById("filterSemester") ? document.getElementById("filterSemester").value : "";
  const searchText = document.getElementById("searchSubject") ? document.getElementById("searchSubject").value.toLowerCase() : "";

  const tbody = document.querySelector("#tblSubjects tbody");
  tbody.innerHTML = "";

  allData.subjects
    .filter(sub => !filterSemester || sub.sem_id == filterSemester)
    .filter(sub => sub.subject_name.toLowerCase().includes(searchText))
    .forEach(sub => {
      tbody.innerHTML += `<tr>
        <td>${sub.subject_id}</td>
        <td>${escapeHtml(sub.subject_name)}</td>
        <td>${sub.sem_id}</td>
        <td>
          <button onclick='showForm("subject", ${JSON.stringify(sub)})'>Edit</button>
          <button onclick='deleteRow("subject", ${sub.subject_id})'>Delete</button>
        </td>
      </tr>`;
    });
}

// Enrollment
async function loadEnrollments() {
  const res = await fetchJson("api/Enrollments/getEnrollments.php");
  if (!res.success) { alert(res.message); return; }
  allData.enrollments = res.data || [];
  const tbody = document.querySelector("#tblEnrollments tbody");
  tbody.innerHTML = "";
  allData.enrollments.forEach(e => {
    tbody.innerHTML += `<tr>
      <td>${e.load_id}</td>
      <td>${escapeHtml(e.First_Name)} ${escapeHtml(e.Last_Name)}</td>
      <td>${escapeHtml(e.subject_name)}</td>
      <td>${escapeHtml(e.sem_name)}</td>
      <td>
        <button onclick='showForm("enrollment", ${JSON.stringify(e)})'>Edit</button>
        <button onclick='deleteRow("enrollment", ${e.load_id})'>Remove</button>
      </td>
    </tr>`;
  });
}


function showForm(table, data = null) {
  const modal = document.getElementById("modal");
  const modalTitle = document.getElementById("modalTitle");
  const mainForm = document.getElementById("mainForm");

  modal.style.display = "block";
  modalTitle.textContent = data ? `Edit ${table}` : `Add ${table}`;
  mainForm.dataset.table = table;

  if (table === 'students') {
    const programOptions = allData.programs.map(p =>
      `<option value="${p.program_id}" ${data && data.program_id == p.program_id ? "selected" : ""}>${escapeHtml(p.program_name)}</option>`
    ).join("");
    mainForm.innerHTML = `
      <input type="hidden" name="stud_id" value="${data ? data.stud_id : ''}">
      <label>First Name: <input type="text" name="First_Name" value="${data ? escapeHtml(data.First_Name) : ''}" required></label>
      <label>Middle Name: <input type="text" name="Middle_Name" value="${data ? escapeHtml(data.Middle_Name) : ''}"></label>
      <label>Last Name: <input type="text" name="Last_Name" value="${data ? escapeHtml(data.Last_Name) : ''}" required></label>
      <label>Program: <select name="program_id" required>${programOptions}</select></label>
      <label>Allowance: <input type="number" name="Allowance" value="${data ? data.Allowance : ''}" required></label>
      <button type="submit">Save</button>`;
  }
  else if (table === 'program') {
    mainForm.innerHTML = `
      <input type="hidden" name="program_id" value="${data ? data.program_id : ''}">
      <label>Program Name: <input type="text" name="program_name" value="${data ? escapeHtml(data.program_name) : ''}" required></label>
      <label>Ins ID: <input type="number" name="ins_id" value="${data ? data.ins_id : ''}" required></label>
      <button type="submit">Save</button>`;
  }
  else if (table === 'year') {
    mainForm.innerHTML = `
      <input type="hidden" name="year_id" value="${data ? data.year_id : ''}">
      <label>Year From: <input type="number" name="year_from" value="${data ? data.year_from : ''}" required></label>
      <label>Year To: <input type="number" name="year_to" value="${data ? data.year_to : ''}" required></label>
      <button type="submit">Save</button>`;
  }
  else if (table === 'semester') {
    const yearOptions = allData.years.map(y =>
      `<option value="${y.year_id}" ${data && data.year_id == y.year_id ? "selected" : ""}>${y.year_from}-${y.year_to}</option>`
    ).join("");
    mainForm.innerHTML = `
      <input type="hidden" name="sem_id" value="${data ? data.sem_id : ''}">
      <label>Semester Name: <input type="text" name="sem_name" value="${data ? escapeHtml(data.sem_name) : ''}" required></label>
      <label>Year: <select name="year_id" required>${yearOptions}</select></label>
      <button type="submit">Save</button>`;
  }
  else if (table === 'subject') {
    const semOptions = allData.semesters.map(s =>
      `<option value="${s.sem_id}" ${data && data.sem_id == s.sem_id ? "selected" : ""}>${escapeHtml(s.sem_name)}</option>`
    ).join("");
    mainForm.innerHTML = `
      <input type="hidden" name="subject_id" value="${data ? data.subject_id : ''}">
      <label>Subject Name: <input type="text" name="subject_name" value="${data ? escapeHtml(data.subject_name) : ''}" required></label>
      <label>Semester: <select name="sem_id" required>${semOptions}</select></label>
      <button type="submit">Save</button>`;
  }
  else if (table === 'enrollment') {
    const studentOptions = allData.students.map(s =>
      `<option value="${s.stud_id}" ${data && data.stud_id == s.stud_id ? "selected" : ""}>${escapeHtml(s.First_Name)} ${escapeHtml(s.Last_Name)}</option>`
    ).join("");
    const subjectOptions = allData.subjects.map(sub =>
      `<option value="${sub.subject_id}" ${data && data.subject_id == sub.subject_id ? "selected" : ""}>${escapeHtml(sub.subject_name)}</option>`
    ).join("");
    const semOptions = allData.semesters.map(s =>
      `<option value="${s.sem_id}" ${data && data.sem_id == s.sem_id ? "selected" : ""}>${escapeHtml(s.sem_name)}</option>`
    ).join("");

    mainForm.innerHTML = `
      <input type="hidden" name="load_id" value="${data ? data.load_id : ''}">
      <label>Student: <select name="stud_id" required>${studentOptions}</select></label>
      <label>Subject: <select name="subject_id" required>${subjectOptions}</select></label>
      <label>Semester: <select name="sem_id" required>${semOptions}</select></label>
      <button type="submit">Save</button>`;
  }
}


document.getElementById("mainForm").addEventListener("submit", async (e) => {
  e.preventDefault();
  const table = e.target.dataset.table;
  const formData = new FormData(e.target);
  let payload = {};
  formData.forEach((val, key) => payload[key] = val);
  let url;

  if (table === 'students') url = payload.stud_id ? "api/students/updateStudent.php" : "api/students/addStudent.php";
  else if (table === 'program') url = payload.program_id ? "api/program/updateProgram.php" : "api/program/addProgram.php";
  else if (table === 'year') url = payload.year_id ? "api/Years&Semesters/updateYear.php" : "api/Years&Semesters/addYear.php";
  else if (table === 'semester') url = payload.sem_id ? "api/Years&Semesters/updateSemester.php" : "api/Years&Semesters/addSemester.php";
  else if (table === 'subject') url = payload.subject_id ? "api/Subjects/updateSubject.php" : "api/Subjects/addSubject.php";
  else if (table === 'enrollment') url = payload.load_id ? "api/Enrollments/updateEnrollment.php" : "api/Enrollments/enrollStudent.php";

  const res = await fetchJson(url, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(payload)
  });

  if (res.success) {
    if (table === 'students') await loadStudents();
    else if (table === 'program') await loadPrograms();
    else if (table === 'year') await loadYears();
    else if (table === 'semester') await loadSemesters();
    else if (table === 'subject') await loadSubjects();
    else if (table === 'enrollment') await loadEnrollments();
    closeForm();
  } else alert(res.message);
});


async function deleteRow(table, id) {
  if (!confirm("Are you sure?")) return;
  let url, body;

  if (table === 'students') { url = "api/students/deleteStudent.php"; body = { stud_id: id }; }
  else if (table === 'program') { url = "api/program/deleteProgram.php"; body = { program_id: id }; }
  else if (table === 'year') { url = "api/Years&Semesters/deleteYear.php"; body = { year_id: id }; }
  else if (table === 'semester') { url = "api/Years&Semesters/deleteSemester.php"; body = { sem_id: id }; }
  else if (table === 'subject') { url = "api/Subjects/deleteSubject.php"; body = { subject_id: id }; }
  else if (table === 'enrollment') { url = "api/Enrollments/removeEnrollment.php"; body = { load_id: id }; }

  const res = await fetchJson(url, {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(body)
  });

  if (res.success) {
    if (table === 'students') await loadStudents();
    else if (table === 'program') await loadPrograms();
    else if (table === 'year') await loadYears();
    else if (table === 'semester') await loadSemesters();
    else if (table === 'subject') await loadSubjects();
    else if (table === 'enrollment') await loadEnrollments();
  } else alert(res.message);
}


function closeForm() {
  document.getElementById("modal").style.display = "none";
  document.getElementById("mainForm").innerHTML = "";
}


function populateProgramFilter() {
  const filter = document.getElementById("filterProgram");
  if (!filter) return;
  filter.innerHTML = `<option value="">All Programs</option>` +
    allData.programs.map(p => `<option value="${p.program_id}">${escapeHtml(p.program_name)}</option>`).join("");
  filter.addEventListener("change", () => loadStudents());
}

function populateSemesterFilter() {
  const filter = document.getElementById("filterSemester");
  if (!filter) return;
  filter.innerHTML = `<option value="">All Semesters</option>` +
    allData.semesters.map(s => `<option value="${s.sem_id}">${escapeHtml(s.sem_name)}</option>`).join("");
  filter.addEventListener("change", () => loadSubjects());
}


function showSection(sectionId, link) {
  document.querySelectorAll(".section").forEach(sec => sec.style.display = "none");
  document.getElementById(sectionId).style.display = "block";

  document.querySelectorAll("nav ul li a").forEach(a => a.classList.remove("active"));
  if (link) link.classList.add("active");
}


document.addEventListener("DOMContentLoaded", () => {
  populateProgramFilter();
  populateSemesterFilter();

  const searchStudentInput = document.getElementById("searchStudent");
  if (searchStudentInput) searchStudentInput.addEventListener("input", () => loadStudents());

  loadStudents();
  loadPrograms();
  loadYears();
  loadSemesters();
  loadSubjects();
  loadEnrollments();

  // Default open "students"
  const firstNav = document.querySelector("nav ul li a");
  if (firstNav) {
    showSection("students", firstNav);
  }
});
