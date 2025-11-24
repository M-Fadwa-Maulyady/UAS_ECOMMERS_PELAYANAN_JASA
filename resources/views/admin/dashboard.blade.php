<x-layoutAdmin>
  <div class="grid">
        <!-- KPI / STATS -->
        <div class="stats">
          <div class="stat"><div class="muted">Income (Bulan ini)</div><div class="value">$8,500 <span class="trend up">+1.7%</span></div></div>
          <div class="stat"><div class="muted">Expense</div><div class="value">$4,900 <span class="trend down">-2.4%</span></div></div>
          <div class="stat"><div class="muted">Savings</div><div class="value">$2,000 <span class="trend up">+1.5%</span></div></div>
          <div class="stat"><div class="muted">Investment</div><div class="value">$1,600 <span class="trend up">+3.8%</span></div></div>
          <div class="stat"><div class="muted">Total Employees</div><div class="value">3,109 <span class="trend up">+0.5%</span></div></div>
          <div class="stat"><div class="muted">Total Applicants</div><div class="value">1,244 <span class="trend up">+5.0%</span></div></div>
        </div>

        <!-- LEFT -->
        <div class="col-left">
          <div class="kpi-grid card">
            <div>
              <h3>Cashflow</h3>
              <div class="subtle">7 hari terakhir</div>
              <canvas id="cashflow" height="150"></canvas>
            </div>
            <div>
              <h3>Expense Breakdown</h3>
              <div class="subtle">Hari ini</div>
              <canvas id="expense" height="150"></canvas>
              <div class="list" style="margin-top:10px">
                <div class="item"><span class="dot green"></span><span>Food & Dining</span><span class="subtle" style="margin-left:auto">50%</span></div>
                <div class="item"><span class="dot orange"></span><span>Utilities</span><span class="subtle" style="margin-left:auto">30%</span></div>
                <div class="item"><span class="dot gray"></span><span>Investment</span><span class="subtle" style="margin-left:auto">20%</span></div>
              </div>
            </div>
          </div>

          <div class="card">
            <div style="display:flex;justify-content:space-between;align-items:center;gap:10px">
              <h3>Recent Transactions</h3>
              <div>
                <span class="pill" id="filterMonth">This Month</span>
                <button class="btn" style="margin-left:8px;color:var(--text-700);border-color:var(--border)" id="btnAddTx">+ Add</button>
              </div>
            </div>
            <table id="txTable">
              <thead>
                <tr>
                  <th>Transaction Name</th>
                  <th>Account</th>
                  <th>Date & Time</th>
                  <th>Amount</th>
                  <th>Status</th>
                </tr>
              </thead>
              <tbody></tbody>
            </table>
          </div>

          <!-- ACTIVE JOBS + UPCOMING INTERVIEWS -->
          <div class="card kpi-grid" style="margin-top:18px;">
            <div>
              <h3>Active Jobs</h3>
              <div class="subtle">24 Jobs</div>
              <div id="activeJobs" class="list"></div>
            </div>
            <div>
              <h3>Upcoming Interviews</h3>
              <div class="subtle">12 Interviews</div>
              <div id="upcomingInterviews" class="list"></div>
            </div>
          </div>
        </div>

        <!-- RIGHT -->
        <div class="col-right">
          <div class="card">
            <h3>Upcoming Interviews</h3>
            <div class="list" id="interviewList"></div>
          </div>

          <div class="card">
            <h3>Employment Status</h3>
            <div class="list">
              <div class="item"><div style="width:100%"><div class="subtle">Permanent Employees</div><div class="bar"><span style="width:62%"></span></div></div><div class="subtle">1930</div></div>
              <div class="item"><div style="width:100%"><div class="subtle">Contract Employees</div><div class="bar"><span style="width:18%"></span></div></div><div class="subtle">560</div></div>
              <div class="item"><div style="width:100%"><div class="subtle">Freelancers</div><div class="bar"><span style="width:12%"></span></div></div><div class="subtle">375</div></div>
              <div class="item"><div style="width:100%"><div class="subtle">Interns</div><div class="bar"><span style="width:8%"></span></div></div><div class="subtle">244</div></div>
            </div>
          </div>

          <div class="card">
            <h3>Recent Activities</h3>
            <div class="list" id="activityList"></div>
          </div>

          <!-- FINANCE SECTION -->
          <div class="card">
            <h3>Expense Breakdown</h3>
            <div class="subtle">Today</div>
            <canvas id="expenseDonut" height="160"></canvas>
            <div class="list" style="margin-top:10px">
              <div class="item"><span class="dot green"></span><span>Food & Dining</span><span class="subtle" style="margin-left:auto">50%</span></div>
              <div class="item"><span class="dot orange"></span><span>Utilities</span><span class="subtle" style="margin-left:auto">30%</span></div>
              <div class="item"><span class="dot gray"></span><span>Investment</span><span class="subtle" style="margin-left:auto">20%</span></div>
            </div>
          </div>

          <div class="card">
            <h3>Finance Score</h3>
            <div class="muted">Finance Quality</div>
            <div style="display:flex;justify-content:space-between;align-items:center;margin-top:10px;">
              <span style="font-weight:700;font-size:18px;">Excellent</span>
              <span style="color:var(--mint-600);font-weight:700;">92%</span>
            </div>
            <div class="bar" style="margin-top:6px;"><span style="width:92%;"></span></div>
          </div>

          <div class="card">
            <h3>Balance</h3>
            <div class="muted">Total Balance</div>
            <h2 style="margin:6px 0;">$1,377,000</h2>
            <div class="bank-card">
              <div class="bank visa">
                <div class="bank-name">VISA</div>
                <div class="bank-amount">$415,000</div>
                <div class="bank-number">4532 •••• •••• 9967</div>
              </div>
              <div class="bank mc">
                <div class="bank-name">Mastercard</div>
                <div class="bank-amount">$532,000</div>
                <div class="bank-number">5582 •••• •••• 5487</div>
              </div>
            </div>
          </div>

          <div class="card">
            <h3>Saving Plans</h3>
            <div class="muted">Total Savings</div>
            <h2 style="margin:6px 0;">$12,000</h2>
            <div class="saving-item">
              <div class="flex-between"><span>Emergency Fund</span><span class="subtle">$4,500 / $10,000</span></div>
              <div class="bar"><span style="width:45%;"></span></div>
            </div>
            <div class="saving-item">
              <div class="flex-between"><span>Retirement Fund</span><span class="subtle">$5,000 / $20,000</span></div>
              <div class="bar"><span style="width:25%;"></span></div>
            </div>
            <div class="saving-item">
              <div class="flex-between"><span>Vacation Fund</span><span class="subtle">$2,500 / $5,000</span></div>
              <div class="bar"><span style="width:50%;"></span></div>
            </div>
          </div>
          <!-- STATISTIK RATING & FEEDBACK -->
            <div class="card" id="ratingCard">
            <h3>Statistik Rating & Feedback</h3>
            <div class="rating-container">
                <div class="rating-summary">
                <div class="avg-rating">4.7</div>
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <div class="muted">Rata-rata dari 1.245 ulasan</div>
                </div>
                <div class="rating-chart">
                <canvas id="ratingChart" height="120"></canvas>
                </div>
            </div>

            <div class="feedback-list">
                <div class="feedback-item">
                <strong>🌟 Aulia Permata</strong>
                <p>"Pelayanannya cepat dan ramah!"</p>
                </div>
                <div class="feedback-item">
                <strong>⭐ Rafi Rahman</strong>
                <p>"Hasil kerja sangat memuaskan, recommended banget!"</p>
                </div>
                <div class="feedback-item">
                <strong>✨ Bunga Salsabila</strong>
                <p>"Sedikit terlambat tapi kualitas oke 👍"</p>
                </div>
            </div>
            </div>
        </div>
      </div>
</x-layoutAdmin>