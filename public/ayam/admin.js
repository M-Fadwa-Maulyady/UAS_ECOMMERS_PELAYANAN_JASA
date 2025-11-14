// --------- MOCK DATA ----------
const txData = [
  {name:'Dividend Payout', account:'VISA — Platinum Plus', date:'2024-09-25 09:40', amount:200.00, status:'Completed'},
  {name:'Grocery Shopping', account:'VISA — Platinum Plus', date:'2024-09-24 14:30', amount:-154.20, status:'Completed'},
  {name:'Freelance Payment', account:'Mastercard — Freedom', date:'2024-09-20 15:09', amount:850.00, status:'Completed'},
  {name:'Electricity Bill', account:'Mastercard — Freedom', date:'2024-09-19 12:05', amount:-120.75, status:'Completed'},
  {name:'Online Subscription', account:'VISA — Platinum Plus', date:'2024-09-18 08:20', amount:-12.99, status:'Pending'},
];

const interviews = [
  {name:'Emery Donnell', role:'UI/UX Designer', time:'Sen, 12 Mei 2025 • 10.00'},
  {name:'Charlie Korsgaard', role:'ReactJS Developer', time:'Sen, 12 Mei 2025 • 13.00'},
  {name:'Ryan Vaccaro', role:'Backend (Go)', time:'Sel, 13 Mei 2025 • 09.00'},
];

const activities = [
  {icon:'🔔', text:'Reviewed alerts for low balance', when:'11:45 AM · Today'},
  {icon:'👁️', text:'Checked account balance', when:'09:22 AM · Today'},
  {icon:'📱', text:'Logged in from mobile device', when:'07:15 AM · Today'},
  {icon:'🗓️', text:'Scheduled a recurring utility payment', when:'05:50 PM · Yesterday'},
  {icon:'💳', text:'Updated payment method', when:'03:30 PM · Yesterday'},
];

// --------- HELPERS ----------
const fmtMoney = v => (v<0?'-':'') + '$' + Math.abs(v).toLocaleString(undefined,{minimumFractionDigits:2, maximumFractionDigits:2});

function renderTx(){
  const tbody = document.querySelector('#txTable tbody');
  tbody.innerHTML = '';
  txData.forEach(row=>{
    const tr = document.createElement('tr');
    tr.innerHTML = `
      <td>${row.name}</td>
      <td>${row.account}</td>
      <td>${row.date}</td>
      <td style="font-weight:600;${row.amount<0?'color:var(--bad)':'color:var(--good)'}">${fmtMoney(row.amount)}</td>
      <td><span class="status ${row.status==='Completed'?'done':'pending'}">${row.status}</span></td>
    `;
    tbody.appendChild(tr);
  });
}

function renderInterviews(){
  const list = document.getElementById('interviewList');
  list.innerHTML = '';
  interviews.forEach(i=>{
    const el = document.createElement('div');
    el.className = 'item';
    el.innerHTML = `
      <div style="width:36px;height:36px;border-radius:12px;background:var(--mint-100);display:grid;place-items:center;font-weight:700;color:#0d5c4a">${i.name[0]}</div>
      <div style="display:flex;flex-direction:column">
        <strong>${i.name}</strong>
        <span class="subtle">${i.role}</span>
      </div>
      <span class="badge" style="margin-left:auto">${i.time}</span>
    `;
    list.appendChild(el);
  });
}

function renderActivities(){
  const list = document.getElementById('activityList');
  list.innerHTML = '';
  activities.forEach(a=>{
    const el = document.createElement('div');
    el.className = 'item';
    el.innerHTML = `
      <div style="width:28px;height:28px;border-radius:8px;background:var(--mint-100);display:grid;place-items:center">${a.icon}</div>
      <div style="display:flex;flex-direction:column">
        <span>${a.text}</span>
        <span class="subtle" style="font-size:12px">${a.when}</span>
      </div>
    `;
    list.appendChild(el);
  });
}

// --------- CHARTS ----------
const mint600 = getComputedStyle(document.documentElement).getPropertyValue('--mint-600').trim();
const mint300 = getComputedStyle(document.documentElement).getPropertyValue('--mint-300').trim();
const text500 = getComputedStyle(document.documentElement).getPropertyValue('--text-500').trim();

function buildCharts(){
  const cashCtx = document.getElementById('cashflow');
  new Chart(cashCtx, {
    type:'line',
    data:{
      labels:['Min','Sen','Sel','Rab','Kam','Jum','Sab'],
      datasets:[
        {label:'Income', data:[1100,1600,1200,6000,1800,2100,1700], tension:.4, borderWidth:2, borderColor:mint600, pointRadius:0, fill:false},
        {label:'Expense', data:[900,1200,1100,1500,1400,1300,1200], tension:.4, borderWidth:2, borderColor:mint300, pointRadius:0, fill:false}
      ]
    },
    options:{
      responsive:false,
      maintainAspectRatio:false,
      plugins:{legend:{labels:{color:text500}}},
      scales:{
        x:{ticks:{color:text500}, grid:{display:false}},
        y:{ticks:{color:text500}, grid:{color:'#eef2f7'}}
      }
    }
  });

  const expCtx = document.getElementById('expense');
  new Chart(expCtx, {
    type:'doughnut',
    data:{
      labels:['Food & Dining','Utilities','Investment'],
      datasets:[{data:[50,30,20], backgroundColor:[mint600,'#f59e0b','#cbd5e1']}]
    },
    options:{
      responsive:false,
      maintainAspectRatio:false,
      cutout:'68%',
      plugins:{legend:{display:false}}
    }
  });
}

// --------- ACTIONS ----------
document.getElementById('btnExport').addEventListener('click', ()=>{
  const head = ['Transaction Name','Account','Date & Time','Amount','Status'];
  const rows = txData.map(t=>[t.name,t.account,t.date,t.amount,t.status]);
  const csv = [head, ...rows].map(r=>r.map(x=>`"${String(x).replaceAll('"','""')}"`).join(',')).join('\n');
  const blob = new Blob([csv], {type:'text/csv;charset=utf-8;'});
  const url = URL.createObjectURL(blob);
  const a = document.createElement('a');
  a.href = url; a.download = 'transactions.csv'; a.click();
  URL.revokeObjectURL(url);
});

document.getElementById('btnAddTx').addEventListener('click', ()=>{
  const now = new Date();
  txData.unshift({
    name:'Service Order #'+Math.floor(Math.random()*900+100),
    account:'VISA — Platinum Plus',
    date: now.toISOString().slice(0,16).replace('T',' '),
    amount: Math.random()>0.5? (Math.random()*300+50) : -(Math.random()*200+20),
    status: Math.random()>0.2? 'Completed':'Pending'
  });
  renderTx();
});

document.getElementById('btnRefresh').addEventListener('click', ()=>{
  renderTx(); renderInterviews(); renderActivities();
});

// --------- INIT ---------
renderTx(); renderInterviews(); renderActivities(); buildCharts();


// ===== ACTIVE JOBS & UPCOMING INTERVIEWS =====
const activeJobs = [
  {icon:'🎨', title:'Senior Product Designer', location:'On-Site'},
  {icon:'🧩', title:'NodeJS Developer', location:'On-Site'},
  {icon:'⚛️', title:'ReactJS Developer', location:'On-Site'},
  {icon:'💻', title:'WordPress Developer', location:'On-Site'}
];

const upcomingInterviews = [
  {avatar:'👨‍💻', name:'Ruben Philips', role:'UI/UX Designer', time:'Mon 12, 2025 - 10:00 AM'},
  {avatar:'👩‍🎨', name:'Emery Donin', role:'ReactJS Developer', time:'Mon 12, 2025 - 11:00 AM'},
  {avatar:'👨‍🔧', name:'Charlie Korsgaard', role:'MongoDB Architect', time:'Mon 12, 2025 - 01:00 PM'},
  {avatar:'👨‍💼', name:'Ryan Vaccaro', role:'NodeJS Developer', time:'Mon 12, 2025 - 03:00 PM'},
];

function renderActiveJobs(){
  const container = document.getElementById('activeJobs');
  container.innerHTML = '';
  activeJobs.forEach(job=>{
    const div = document.createElement('div');
    div.className = 'job-item';
    div.innerHTML = `
      <div class="job-info">
        <div class="job-icon">${job.icon}</div>
        <div class="job-details">
          <strong>${job.title}</strong><br>
          <span>${job.location}</span>
        </div>
      </div>
    `;
    container.appendChild(div);
  });
}

function renderUpcomingInterviews(){
  const container = document.getElementById('upcomingInterviews');
  container.innerHTML = '';
  upcomingInterviews.forEach(inter=>{
    const div = document.createElement('div');
    div.className = 'interview-item';
    div.innerHTML = `
      <div class="job-info">
        <div class="job-icon">${inter.avatar}</div>
        <div class="job-details">
          <strong>${inter.name}</strong><br>
          <span>${inter.role}</span>
        </div>
      </div>
      <span class="interview-time">${inter.time}</span>
    `;
    container.appendChild(div);
  });
}

// ===== EXPENSE DONUT (Finance Section) =====
const expCtx = document.getElementById('expenseDonut');
new Chart(expCtx, {
  type: 'doughnut',
  data: {
    labels: ['Food & Dining', 'Utilities', 'Investment'],
    datasets: [{
      data: [50, 30, 20],
      backgroundColor: ['#5dad87', '#f59e0b', '#cbd5e1']
    }]
  },
  options: {
    cutout: '70%',
    plugins: { legend: { display: false } },
    responsive: false,
    maintainAspectRatio: false
  }
});

// ===== RATING CHART =====
const ratingCtx = document.getElementById('ratingChart');
new Chart(ratingCtx, {
  type: 'bar',
  data: {
    labels: ['5★', '4★', '3★', '2★', '1★'],
    datasets: [{
      label: 'Jumlah Ulasan',
      data: [750, 310, 120, 45, 20],
      backgroundColor: [
        'rgba(22,163,74,0.8)',
        'rgba(74,222,128,0.8)',
        'rgba(251,191,36,0.8)',
        'rgba(251,146,60,0.8)',
        'rgba(239,68,68,0.8)'
      ],
      borderRadius: 6
    }]
  },
  options: {
    responsive: false,
    maintainAspectRatio: false,
    plugins: { legend: { display: false } },
    scales: {
      x: { ticks: { color: '#64748b' }, grid: { display: false } },
      y: { ticks: { color: '#64748b' }, grid: { color: '#eef2f7' } }
    }
  }
});



// panggil fungsi supaya tampil
renderActiveJobs();
renderUpcomingInterviews();

