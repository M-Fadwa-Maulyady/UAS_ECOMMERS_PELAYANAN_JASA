

const roleSelect = document.getElementById("roleSelect");
const jasaFields = document.getElementById("jasaFields");

roleSelect.addEventListener("change", () => {
    jasaFields.style.display = roleSelect.value === "pekerja" ? "block" : "none";
});

// Toggle password field by id
function togglePassword(id){
  const el = document.getElementById(id);
  if(!el) return;
  el.type = el.type === 'password' ? 'text' : 'password';
}

// Show/hide jasa fields on register page
document.addEventListener('DOMContentLoaded', function(){
  const role = document.getElementById('roleSelect');
  const jasaBox = document.getElementById('jasaFields');

  if(role){
    role.addEventListener('change', function(){
      if(this.value === 'jasa'){
        jasaBox.style.display = 'flex';
      } else {
        jasaBox.style.display = 'none';
      }
    });
    // initial state
    if(role.value === 'jasa') jasaBox.style.display = 'flex';
    else jasaBox.style.display = 'none';
  }

  // example: handle submit for demo (prevent real submit)
  const loginForm = document.getElementById('loginForm');
  if(loginForm){
    loginForm.addEventListener('submit', function(e){
      // remove this in production (or handle via normal POST to server)
      e.preventDefault();
      alert('Login submitted (demo). Integrate with backend.');
    });
  }

  const registerForm = document.getElementById('registerForm');
  if(registerForm){
    registerForm.addEventListener('submit', function(e){
      e.preventDefault();
      // gather minimal data for demo
      const data = new FormData(registerForm);
      const roleValue = data.get('role') || 'user';
      if(roleValue === 'jasa'){
        // basic client-side validation example
        if(!data.get('nama_usaha')){
          alert('Isi Nama Usaha untuk pendaftar Jasa');
          return;
        }
      }
      alert('Register submitted (demo). Integrate with backend.');
    });
  }
});
