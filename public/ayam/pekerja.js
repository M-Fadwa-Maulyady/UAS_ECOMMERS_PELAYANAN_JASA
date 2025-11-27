// ===== Warna dari CSS variable =====
const css = getComputedStyle(document.documentElement);
const mint = css.getPropertyValue('--mint-600').trim();
const blue = css.getPropertyValue('--blue').trim();
const green = css.getPropertyValue('--green').trim();
const pink = css.getPropertyValue('--pink').trim();

// ===============================
// 1️⃣  VACANCY STATS CHART (GRAFIK GARIS)
// ===============================
const vacancyCtx = document.getElementById('vacancyChart');

if (vacancyCtx) {
  new Chart(vacancyCtx, {
    type: 'line',
    data: {
      labels: [
        'Week 01', 'Week 02', 'Week 03', 'Week 04', 'Week 05',
        'Week 06', 'Week 07', 'Week 08', 'Week 09', 'Week 10'
      ],
      datasets: [
        {
          label: 'Application Sent',
          data: [80, 60, 50, 90, 75, 60, 40, 30, 20, 35],
          borderColor: blue,
          backgroundColor: 'rgba(79, 124, 255, 0.08)',
          tension: 0.4,
          fill: false,
          pointBackgroundColor: blue,
          borderWidth: 2
        },
        {
          label: 'Interviews',
          data: [40, 35, 45, 55, 50, 48, 30, 35, 25, 20],
          borderColor: green,
          backgroundColor: 'rgba(34, 197, 94, 0.1)',
          tension: 0.4,
          fill: false,
          pointBackgroundColor: green,
          borderWidth: 2
        },
        {
          label: 'Rejected',
          data: [20, 25, 30, 40, 35, 28, 38, 45, 40, 30],
          borderColor: pink,
          backgroundColor: 'rgba(244, 114, 182, 0.1)',
          tension: 0.4,
          fill: false,
          pointBackgroundColor: pink,
          borderWidth: 2
        }
      ]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false
        },
        tooltip: {
          mode: 'index',
          intersect: false,
          backgroundColor: '#0d5c4a',
          titleColor: '#fff',
          bodyColor: '#fff',
          cornerRadius: 8
        }
      },
      interaction: { intersect: false, mode: 'nearest' },
      scales: {
        x: {
          grid: { display: false },
          ticks: { color: '#475569', font: { weight: 500 } }
        },
        y: {
          grid: { color: '#eef2f7' },
          ticks: { color: '#64748b', beginAtZero: true, stepSize: 20 }
        }
      }
    }
  });
}

// ===============================
// 2️⃣  IN PROGRESS PROJECT LIST
// ===============================
const projects = [
  { title: 'Project 1 — Design Landing Page', progress: 76 },
  { title: 'Project 2 — Brand Guideline', progress: 49 },
  { title: 'Project 3 — Social Media Posts', progress: 31 },
];

const list = document.getElementById('progressList');
function renderProjects() {
  list.innerHTML = '';
  projects.forEach(p => {
    const row = document.createElement('div');
    row.className = 'progress-item';
    row.innerHTML = `
      <span class="progress-label">${p.title}</span>
      <span class="muted" style="width:42px;text-align:right">${p.progress}%</span>
      <div class="progress"><span style="width:${p.progress}%"></span></div>
    `;
    list.appendChild(row);
  });
}
renderProjects();

document.getElementById('btnNewProject').addEventListener('click', () => {
  const n = projects.length + 1;
  projects.unshift({ title: `Project ${n} — New Brief`, progress: Math.floor(Math.random() * 40) + 15 });
  if (projects.length > 4) projects.pop();
  renderProjects();
});

// ===============================
// 3️⃣  TASKS (Harian & Mingguan)
// ===============================
const dailyEl = document.getElementById('dailyTask');
const weeklyEl = document.getElementById('weeklyTask');
const daily = [
  'Kirim konsep revisi ke klien A',
  'Upload file final proyek B',
  'Balas pesan calon klien'
];
const weekly = [
  'Perbarui portofolio di profil',
  'Riset tren desain minggu ini',
  'Buat template posting IG'
];

function renderTasks(arr, ul) {
  ul.innerHTML = '';
  arr.forEach((t, i) => {
    const li = document.createElement('li');
    li.innerHTML = `<input type="checkbox" id="${ul.id}${i}"><label for="${ul.id}${i}">${t}</label>`;
    ul.appendChild(li);
  });
}
renderTasks(daily, dailyEl);
renderTasks(weekly, weeklyEl);

document.getElementById('addDaily').addEventListener('click', () => {
  const inp = document.getElementById('newDaily');
  if (!inp.value.trim()) return;
  daily.unshift(inp.value.trim());
  renderTasks(daily, dailyEl);
  inp.value = '';
});

document.getElementById('addWeekly').addEventListener('click', () => {
  const inp = document.getElementById('newWeekly');
  if (!inp.value.trim()) return;
  weekly.unshift(inp.value.trim());
  renderTasks(weekly, weeklyEl);
  inp.value = '';
});

// ===============================
// 4️⃣  YEARLY PROGRESS RING
// ===============================
const ring = new Chart(document.getElementById('yearlyRing'), {
  type: 'doughnut',
  data: {
    labels: ['Pekerjaan', 'Belajar', 'Desain UI', 'Membaca'],
    datasets: [{
      data: [63, 14, 13, 10],
      backgroundColor: [green, blue, pink, mint],
      cutout: '72%',
      borderWidth: 0
    }]
  },
  options: {
    plugins: { legend: { display: false } },
    responsive: true,
    maintainAspectRatio: false
  }
});

// ===== RANGE DROPDOWN FILTER =====
const rangeBtn = document.getElementById('rangeBtn');
const rangeMenu = document.getElementById('rangeMenu');
let currentRange = 'month';

rangeBtn.addEventListener('click', (e) => {
  e.stopPropagation();
  const dropdown = rangeBtn.closest('.dropdown');
  dropdown.classList.toggle('open');
  rangeMenu.style.display = dropdown.classList.contains('open') ? 'flex' : 'none';
});

rangeMenu.querySelectorAll('div').forEach(opt => {
  opt.addEventListener('click', () => {
    currentRange = opt.dataset.range;
    rangeBtn.innerHTML = `${opt.innerText} <i class="fa-solid fa-chevron-down"></i>`;
    rangeBtn.closest('.dropdown').classList.remove('open');
    rangeMenu.style.display = 'none';

    // update data chart simulasi
    const factor = currentRange === 'week' ? 0.6 : currentRange === 'year' ? 1.4 : 1;
    vacancyChart.data.datasets.forEach(d => {
      d.data = d.data.map(x => Math.floor(x * factor + Math.random() * 5));
    });
    vacancyChart.update();
  });
});

document.addEventListener('click', (e) => {
  if (!rangeBtn.contains(e.target) && !rangeMenu.contains(e.target)) {
    rangeMenu.style.display = 'none';
    rangeBtn.closest('.dropdown')?.classList.remove('open');
  }
});

