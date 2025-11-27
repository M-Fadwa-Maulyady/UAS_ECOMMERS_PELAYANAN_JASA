document.addEventListener('DOMContentLoaded', () => {
  const modal = document.getElementById('detailModal');
  const closeBtn = document.querySelector('.close-btn');

  const modalImage = document.getElementById('modalImage');
  const modalTitle = document.getElementById('modalTitle');
  const modalDesc = document.getElementById('modalDesc');
  const modalHarga = document.getElementById('modalHarga');
  const modalDurasi = document.getElementById('modalDurasi');
  const modalKontak = document.getElementById('modalKontak');

  document.querySelectorAll('.btn-offer').forEach(btn => {
    btn.addEventListener('click', () => {
      modal.style.display = 'flex';
      modalImage.src = btn.dataset.gambar;
      modalTitle.textContent = btn.dataset.nama;
      modalDesc.textContent = btn.dataset.deskripsi;
      modalHarga.textContent = btn.dataset.harga || '-';
      modalDurasi.textContent = btn.dataset.durasi || '-';
      modalKontak.textContent = btn.dataset.kontak || '-';
    });
  });

  closeBtn.addEventListener('click', () => modal.style.display = 'none');
  window.addEventListener('click', e => {
    if (e.target === modal) modal.style.display = 'none';
  });
});
