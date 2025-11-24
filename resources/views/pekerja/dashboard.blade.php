<x-layoutJasa>
<!-- Topbar -->
      <header class="topbar">
        <div class="search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Cari proyek, klien, file…">
        </div>

        <div class="top-actions">
          <div class="locale">
            <img src="https://flagcdn.com/w20/id.png" alt="ID">
            <span>Ind (ID)</span>
            <i class="fa-solid fa-chevron-down"></i>
          </div>
          <button class="icon-btn"><i class="fa-regular fa-bell"></i></button>
          <div class="profile">
            <img src="https://i.pravatar.cc/100?img=15" alt="avatar">
            <div class="info">
              <strong>Rafli Saputra</strong>
              <span class="muted">Freelance Designer</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Content -->
      <section class="grid">
        <!-- Stats -->
        <div class="stats-row">
          <div class="stat card"><div class="pill">Order Selesai</div><div class="stat-val">59</div></div>
          <div class="stat card"><div class="pill">Jam Kerja (minggu ini)</div><div class="stat-val">72 h</div></div>
          <div class="stat card"><div class="pill">Rating Saya</div><div class="stat-val">4.8</div></div>
          <div class="stat card"><div class="pill">Jasa Aktif</div><div class="stat-val">6</div></div>
        </div>

        <!-- Vacancy Chart -->
        <div class="card vacancy">
          <div class="card-head">
            <h3>Vacancy Stats</h3>
            <div class="legend">
              <span><i class="dot blue"></i> Application Sent</span>
              <span><i class="dot green"></i> Interviews</span>
              <span><i class="dot pink"></i> Rejected</span>

              <!-- Dropdown -->
              <div class="dropdown">
                <button class="btn-mini" id="rangeBtn">This Month <i class="fa-solid fa-chevron-down"></i></button>
                <div class="dropdown-menu" id="rangeMenu">
                  <div data-range="week">This Week</div>
                  <div data-range="month">This Month</div>
                  <div data-range="year">This Year</div>
                </div>
              </div>
            </div>
          </div>
          <canvas id="vacancyChart"></canvas>
        </div>

        <!-- Yearly Progress -->
        <div class="yearly card">
          <div class="card-head"><h3>Progress Tahunan</h3></div>
          <div class="ring-wrap">
            <canvas id="yearlyRing" width="220" height="220"></canvas>
            <div class="ring-center">
              <div class="ring-num" id="yearlyNum">63%</div>
              <div class="muted small">Main Goals</div>
            </div>
          </div>
          <ul class="ring-legend">
            <li><i class="dot green"></i> Pekerjaan</li>
            <li><i class="dot blue"></i> Belajar</li>
            <li><i class="dot pink"></i> Desain UI</li>
            <li><i class="dot mint"></i> Membaca</li>
          </ul>
        </div>

        <!-- Tasks -->
        <div class="task card">
          <div class="card-head"><h3>Tugas Harian</h3><button class="link">Detail</button></div>
          <ul class="checklist" id="dailyTask"></ul>
          <div class="task-footer">
            <input id="newDaily" type="text" placeholder="Tambah tugas…">
            <button class="icon-btn" id="addDaily"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>

        <div class="task card">
          <div class="card-head"><h3>Tugas Mingguan</h3><button class="link">Detail</button></div>
          <ul class="checklist" id="weeklyTask"></ul>
          <div class="task-footer">
            <input id="newWeekly" type="text" placeholder="Tambah tugas…">
            <button class="icon-btn" id="addWeekly"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>

        <!-- In Progress -->
        <div class="inprogress card">
          <div class="card-head"><h3>In Progress</h3><button class="link">View all</button></div>
          <div class="progress-list" id="progressList"></div>
          <button class="btn-primary" id="btnNewProject"><i class="fa-solid fa-plus"></i> Buat Proyek Baru</button>
        </div>
      </section>
    <main class="main">
      <!-- Topbar -->
      <header class="topbar">
        <div class="search">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Cari proyek, klien, file…">
        </div>

        <div class="top-actions">
          <div class="locale">
            <img src="https://flagcdn.com/w20/id.png" alt="ID">
            <span>Ind (ID)</span>
            <i class="fa-solid fa-chevron-down"></i>
          </div>
          <button class="icon-btn"><i class="fa-regular fa-bell"></i></button>
          <div class="profile">
            <img src="https://i.pravatar.cc/100?img=15" alt="avatar">
            <div class="info">
              <strong>Rafli Saputra</strong>
              <span class="muted">Freelance Designer</span>
            </div>
          </div>
        </div>
      </header>

      <!-- Content -->
      <section class="grid">
        <!-- Stats -->
        <div class="stats-row">
          <div class="stat card"><div class="pill">Order Selesai</div><div class="stat-val">59</div></div>
          <div class="stat card"><div class="pill">Jam Kerja (minggu ini)</div><div class="stat-val">72 h</div></div>
          <div class="stat card"><div class="pill">Rating Saya</div><div class="stat-val">4.8</div></div>
          <div class="stat card"><div class="pill">Jasa Aktif</div><div class="stat-val">6</div></div>
        </div>

        <!-- Vacancy Chart -->
        <div class="card vacancy">
          <div class="card-head">
            <h3>Vacancy Stats</h3>
            <div class="legend">
              <span><i class="dot blue"></i> Application Sent</span>
              <span><i class="dot green"></i> Interviews</span>
              <span><i class="dot pink"></i> Rejected</span>

              <!-- Dropdown -->
              <div class="dropdown">
                <button class="btn-mini" id="rangeBtn">This Month <i class="fa-solid fa-chevron-down"></i></button>
                <div class="dropdown-menu" id="rangeMenu">
                  <div data-range="week">This Week</div>
                  <div data-range="month">This Month</div>
                  <div data-range="year">This Year</div>
                </div>
              </div>
            </div>
          </div>
          <canvas id="vacancyChart"></canvas>
        </div>

        <!-- Yearly Progress -->
        <div class="yearly card">
          <div class="card-head"><h3>Progress Tahunan</h3></div>
          <div class="ring-wrap">
            <canvas id="yearlyRing" width="220" height="220"></canvas>
            <div class="ring-center">
              <div class="ring-num" id="yearlyNum">63%</div>
              <div class="muted small">Main Goals</div>
            </div>
          </div>
          <ul class="ring-legend">
            <li><i class="dot green"></i> Pekerjaan</li>
            <li><i class="dot blue"></i> Belajar</li>
            <li><i class="dot pink"></i> Desain UI</li>
            <li><i class="dot mint"></i> Membaca</li>
          </ul>
        </div>

        <!-- Tasks -->
        <div class="task card">
          <div class="card-head"><h3>Tugas Harian</h3><button class="link">Detail</button></div>
          <ul class="checklist" id="dailyTask"></ul>
          <div class="task-footer">
            <input id="newDaily" type="text" placeholder="Tambah tugas…">
            <button class="icon-btn" id="addDaily"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>

        <div class="task card">
          <div class="card-head"><h3>Tugas Mingguan</h3><button class="link">Detail</button></div>
          <ul class="checklist" id="weeklyTask"></ul>
          <div class="task-footer">
            <input id="newWeekly" type="text" placeholder="Tambah tugas…">
            <button class="icon-btn" id="addWeekly"><i class="fa-solid fa-plus"></i></button>
          </div>
        </div>

        <!-- In Progress -->
        <div class="inprogress card">
          <div class="card-head"><h3>In Progress</h3><button class="link">View all</button></div>
          <div class="progress-list" id="progressList"></div>
          <button class="btn-primary" id="btnNewProject"><i class="fa-solid fa-plus"></i> Buat Proyek Baru</button>
        </div>
      </section>
    </main>
    <!-- End Main -->
</x-layoutJasa>