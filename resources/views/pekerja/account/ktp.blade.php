<x-layoutJasa>

<style>
.ktp-card {
    max-width: 600px;
    margin: 20px auto;
    background: #ffffff;
    padding: 28px;
    border-radius: 18px;
    border: 1px solid #e3ebe7;
    box-shadow: 0 6px 20px rgba(0,0,0,0.05);
}

.ktp-title {
    font-size: 20px;
    font-weight: 700;
    color: #0d3d30;
    margin-bottom: 18px;
}

.preview-box {
    width: 100%;
    height: 220px;
    background: #f2f7f5;
    border: 1px solid #ccd8d3;
    border-radius: 14px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
    margin-bottom: 15px;
}

.preview-box img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.input-file {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid #cfded9;
    background: #ffffff;
}

.btn-upload {
    width: 100%;
    background: #0d5c4a;
    color: white;
    padding: 12px;
    border-radius: 10px;
    font-weight: 600;
    transition: .2s;
}

.btn-upload:hover {
    background: #0b4a39;
}
</style>


<div class="ktp-card">

    <div class="ktp-title">Upload KTP</div>

    {{-- PREVIEW GAMBAR --}}
    <div class="preview-box" id="previewBox">
        @if($user->ktp)
            <img src="{{ asset('storage/' . $user->ktp) }}" id="previewImg">
        @else
            <span class="text-muted">Belum ada gambar</span>
        @endif
    </div>

    {{-- FORM UPLOAD --}}
    <form action="{{ route('pekerja.account.ktp.upload') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input 
            type="file" 
            name="ktp" 
            class="input-file" 
            accept="image/*" 
            onchange="previewImage(event)"
            required
        >

        <br><br>

        <button class="btn-upload">Upload KTP</button>
    </form>

</div>

{{-- PREVIEW JS --}}
<script>
function previewImage(event) {
    const box = document.getElementById('previewBox');
    box.innerHTML = "";

    const img = document.createElement('img');
    img.src = URL.createObjectURL(event.target.files[0]);
    img.style.objectFit = 'cover';
    img.style.width = '100%';
    img.style.height = '100%';

    box.appendChild(img);
}
</script>

</x-layoutJasa>
