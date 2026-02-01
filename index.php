<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no, viewport-fit=cover" />
    <title>Oxford Learning Centre - HR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root{
            --primary: #002147;
            --primary-light: #003366;
            --accent: #2563eb;
            --bg: #f8fafc;
            --surface: #ffffff;
            --border: #e2e8f0;
            --text: #1e293b;
            --text-light: #64748b;
            --radius: 16px;
            --safe-bottom: env(safe-area-inset-bottom, 20px);
        }

        * { box-sizing: border-box; -webkit-tap-highlight-color: transparent; }

        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background: var(--bg);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            padding-bottom: calc(80px + var(--safe-bottom)); /* Space for nav */
        }

        /* Typography */
        h1, h2, h3 { margin: 0; font-weight: 700; color: var(--primary); }
        p { margin: 0; color: var(--text-light); }

        /* Header */
        header {
            background: var(--surface);
            padding: 16px 20px;
            position: sticky;
            top: 0;
            z-index: 50;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
            text-align: center;
        }
        header h1 { font-size: 1.1rem; }
        header p { font-size: 0.85rem; margin-top: 2px; }

        /* Containers */
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            flex: 1;
        }

        /* Role Selection */
        #role-screen {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-height: 60vh;
        }
        .role-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 16px;
            margin-top: 24px;
        }
        .role-card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            text-align: center;
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.05);
        }
        .role-card:active { transform: scale(0.98); }
        .role-card i {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 12px;
            display: block;
        }
        .role-title { font-size: 1.1rem; font-weight: 600; color: var(--text); }
        .role-desc { font-size: 0.85rem; color: var(--text-light); margin-top: 4px; }

        /* Wizard UI */
        #wizard-container { display: none; }

        /* Progress Header */
        .wizard-header {
            margin-bottom: 24px;
        }
        .step-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 8px;
        }
        .step-title { font-weight: 600; color: var(--primary); font-size: 0.9rem; text-transform: uppercase; letter-spacing: 0.5px; }
        .step-count { font-size: 0.85rem; color: var(--text-light); font-feature-settings: "tnum"; }

        .progress-track {
            height: 6px;
            background: #e2e8f0;
            border-radius: 10px;
            overflow: hidden;
        }
        .progress-fill {
            height: 100%;
            background: var(--accent);
            width: 0%;
            transition: width 0.4s ease;
            border-radius: 10px;
        }

        /* Form Card */
        .card {
            background: var(--surface);
            padding: 24px;
            border-radius: var(--radius);
            box-shadow: 0 4px 12px rgba(0,0,0,0.03);
            animation: slideUp 0.3s ease-out;
        }
        @keyframes slideUp { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* Inputs */
        .input-group { margin-bottom: 0; }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: var(--text);
            font-size: 0.95rem;
            line-height: 1.4;
        }
        .req::after { content:" *"; color: #ef4444; }

        input, select, textarea {
            width: 100%;
            padding: 14px 16px;
            border: 1px solid var(--border);
            border-radius: 12px;
            font-size: 16px; /* Prevents iOS zoom */
            background: #fdfdfd;
            font-family: inherit;
            color: var(--text);
            transition: border-color 0.2s;
            appearance: none;
        }
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--accent);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
            background: #fff;
        }
        textarea { min-height: 120px; resize: none; }
        select { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%2364748b'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; background-size: 20px; padding-right: 40px; }

        /* File Upload */
        .file-box {
            border: 2px dashed var(--border);
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            cursor: pointer;
            background: #fafafa;
            transition: 0.2s;
            position: relative;
            overflow: hidden;
        }
        .file-box:active { background: #f0f7ff; border-color: var(--accent); }
        .file-content { position: relative; z-index: 2; pointer-events: none; }
        .file-icon { font-size: 32px; color: var(--text-light); margin-bottom: 8px; }
        .file-text { font-size: 0.9rem; color: var(--accent); font-weight: 500; }
        .file-hint { font-size: 0.8rem; color: var(--text-light); margin-top: 4px; }

        .file-preview {
            margin-top: 15px;
            display: none;
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .file-preview.active { display: block; }

        input[type="file"] { position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%; z-index: 10; }

        /* Navigation Bar */
        .nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-top: 1px solid var(--border);
            padding: 12px 20px;
            padding-bottom: max(12px, var(--safe-bottom));
            z-index: 100;
            display: flex;
            justify-content: center;
        }
        .nav-inner {
            width: 100%;
            max-width: 600px;
            display: flex;
            gap: 12px;
        }
        .btn {
            flex: 1;
            padding: 14px;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: 0.2s;
            -webkit-user-select: none;
        }
        .btn:active { transform: scale(0.97); }
        .btn-primary { background: var(--primary); color: #fff; box-shadow: 0 4px 12px rgba(0, 33, 71, 0.2); }
        .btn-secondary { background: #f1f5f9; color: var(--text); }
        .btn-success { background: #16a34a; color: #fff; box-shadow: 0 4px 12px rgba(22, 163, 74, 0.2); }
        .btn:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none; background: #e2e8f0; color: #94a3b8; }

        /* Modals */
        .modal-bg {
            position: fixed; inset: 0; background: rgba(0,0,0,0.6); z-index: 200;
            display: none; align-items: center; justify-content: center; padding: 20px;
            backdrop-filter: blur(4px);
        }
        .modal {
            background: #fff; padding: 32px 24px; border-radius: 20px;
            text-align: center; max-width: 340px; width: 100%;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
        }
        .modal h3 { margin: 16px 0 8px; font-size: 1.25rem; }

        /* Loader */
        .loader {
            width: 48px; height: 48px;
            border: 5px solid #e2e8f0;
            border-bottom-color: var(--accent);
            border-radius: 50%;
            display: inline-block;
            box-sizing: border-box;
            animation: rotation 1s linear infinite;
        }
        @keyframes rotation { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }

    </style>
</head>
<body>

<header>
    <h1>Oxford Learning Centre</h1>
    <p id="header-sub">HR Application Form</p>
</header>

<div class="container" id="role-screen">
    <h2 style="text-align: center; color: var(--primary);">Kim bo'lib ishga kirmoqchisiz?</h2>
    <div class="role-grid">
        <div class="role-card" onclick="initForm('teacher')">
            <i class="fa-solid fa-chalkboard-user"></i>
            <div class="role-title">O'qituvchi</div>
            <div class="role-desc">English, Rus tili, va h.k</div>
        </div>
        <div class="role-card" onclick="initForm('staff')">
            <i class="fa-solid fa-briefcase"></i>
            <div class="role-title">Xodim (Staff)</div>
            <div class="role-desc">Admin, Manager, Yordamchi</div>
        </div>
    </div>
</div>

<div class="container" id="wizard-container">
    <div class="wizard-header">
        <div class="step-info">
            <span class="step-title" id="sec-title">Personal</span>
            <span class="step-count" id="q-count">1 / 20</span>
        </div>
        <div class="progress-track">
            <div class="progress-fill" id="p-fill"></div>
        </div>
    </div>

    <form id="mainForm" class="card" onsubmit="return false;">
        <div id="form-content"></div>
    </form>
</div>

<div class="nav" id="nav-bar" style="display:none">
    <div class="nav-inner">
        <button class="btn btn-secondary" id="btn-prev" onclick="move(-1)"><i class="fa-solid fa-arrow-left"></i></button>
        <button class="btn btn-primary" id="btn-next" onclick="move(1)">Keyingi <i class="fa-solid fa-arrow-right"></i></button>
        <button class="btn btn-success" id="btn-submit" style="display:none;" onclick="submitForm()">Yuborish <i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>

<!-- Loading Modal -->
<div class="modal-bg" id="loading-modal">
    <div class="modal">
        <span class="loader"></span>
        <h3 id="loading-text">Yuborilmoqda...</h3>
        <p>Iltimos, sahifani yopmang.</p>
    </div>
</div>

<!-- Success Modal -->
<div class="modal-bg" id="success-modal">
    <div class="modal">
        <div style="width: 60px; height: 60px; background: #dcfce7; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto;">
            <i class="fa-solid fa-check" style="color: #16a34a; font-size: 30px;"></i>
        </div>
        <h3>Muvaffaqiyatli!</h3>
        <p style="margin-bottom: 24px;">Arizangiz qabul qilindi. Tez orada aloqaga chiqamiz.</p>
        <button class="btn btn-primary" style="width:100%" onclick="location.reload()">Bosh sahifa</button>
    </div>
</div>

<script>
    // === CONFIGURATION ===
    const S_MAIN = "Shaxsiy";
    const S_WORK = "Ish/Tajriba";
    const S_EXTRA = "Qo'shimcha";
    const S_FILES = "Fayllar";

    // Teacher Questions
    const teacherConfig = [
        {id: 'full_name', sec: S_MAIN, label: 'Ism sharifingiz', type: 'text', req: true, placeholder: 'Familiya Ism Sharif'},
        {id: 'phone', sec: S_MAIN, label: 'Telefon raqamingiz', type: 'tel', req: true, placeholder: '+998 90 123 45 67'},
        {id: 'birthdate', sec: S_MAIN, label: 'Tug\'ilgan kuningiz', type: 'date', req: true},
        {id: 'time135', sec: 'Vaqt', label: '1-3-5 kunlari bo\'sh vaqtlar', type: 'text', req: true, placeholder: 'Masalan: 14:00 - 18:00'},
        {id: 'time246', sec: 'Vaqt', label: '2-4-6 kunlari bo\'sh vaqtlar', type: 'text', req: true, placeholder: 'Masalan: 09:00 - 12:00'},
        {id: 'duration', sec: 'Vaqt', label: 'Biz bilan qancha muddat ishlamoqchisiz?', type: 'text', req: true},
        {id: 'levels', sec: S_WORK, label: 'Qaysi darajadagi o\'quvchilar?', type: 'text', req: true, placeholder: 'Beginner, Elementary...'},
        {id: 'russian', sec: S_WORK, label: 'Rus tilida dars bera olasizmi?', type: 'select', opts: ['Ha', 'Yo\'q', 'Qisman'], req: true},
        {id: 'second_job', sec: S_WORK, label: 'Ikkinchi ishingiz haqida', type: 'textarea', req: true},
        {id: 'experience', sec: S_WORK, label: 'Tajribangiz haqida', type: 'textarea', req: true},
        {id: 'students_taught', sec: S_WORK, label: 'Qancha o\'quvchiga dars bergansiz?', type: 'number', req: true},
        {id: 'education', sec: S_WORK, label: 'Qaysi bilim dargohlarini tugatgansiz?', type: 'text', req: true},
        {id: 'ielts_trainer', sec: S_WORK, label: 'O\'zingiz kimda tayyorlangansiz?', type: 'text', req: true},
        {id: 'strengths', sec: S_EXTRA, label: 'Ustun tomoningiz', type: 'textarea', req: true},
        {id: 'strategy', sec: S_EXTRA, label: 'O\'quvchi tezroq o\'rganishi uchun nima qilasiz?', type: 'textarea', req: true},
        {id: 'goals', sec: S_EXTRA, label: '3 yillikdagi 3 ta maqsadingiz', type: 'textarea', req: true},
        {id: 'father', sec: 'Oila', label: 'Otangiz haqida (Ismi, kasbi)', type: 'textarea', req: true},
        {id: 'mother', sec: 'Oila', label: 'Onangiz haqida (Ismi, kasbi)', type: 'textarea', req: true},
        {id: 'partner', sec: 'Oila', label: 'Turmush o\'rtog\'ingiz haqida', type: 'textarea', req: true},
        {id: 'relatives', sec: 'Oila', label: 'Boshqa oila a\'zolaringiz haqida', type: 'textarea', req: true},
        {id: 'ielts_cert', sec: S_FILES, label: 'Fan sertifikatingiz (IELTS/CEFR)', type: 'file', req: true, icon: 'fa-file-pdf'},
        {id: 'photo', sec: S_FILES, label: 'O\'zingizning rasmingiz', type: 'file', req: true, icon: 'fa-camera'}
    ];

    // Staff Questions
    const staffConfig = [
        {id: 'photo', sec: S_FILES, label: 'Rasmingiz', type: 'file', req: true, icon: 'fa-camera'},
        {id: 'full_name', sec: S_MAIN, label: 'Ism sharifingiz', type: 'text', req: true},
        {id: 'birthdate', sec: S_MAIN, label: 'Tug\'ilgan sanangiz', type: 'date', req: true},
        {id: 'address', sec: S_MAIN, label: 'Doimiy va hozirgi manzilingiz', type: 'textarea', req: true},
        {id: 'education', sec: S_MAIN, label: 'Qayerni tugatgansiz? (yoki o\'qiyapsiz)', type: 'text', req: true},
        {id: 'languages', sec: S_MAIN, label: 'Qaysi chet tilini bilasiz?', type: 'text', req: true},
        {id: 'work_history', sec: S_WORK, label: 'Oldin ishlagan joylaringiz va muddati', type: 'textarea', req: true},
        {id: 'reason_leave', sec: S_WORK, label: 'Nimaga oldingi ishingizdan bo\'shagansiz?', type: 'textarea', req: true},
        {id: 'computer_skills', sec: S_WORK, label: 'Kompyuter, Word va Excel darajangiz?', type: 'text', req: true},
        {id: 'marital_status', sec: S_EXTRA, label: 'Oila qurganmisiz?', type: 'select', opts: ['Ha', 'Yo\'q'], req: true},
        {id: 'duration', sec: S_EXTRA, label: 'Biz bilan qancha muddat ishlamoqchisiz?', type: 'text', req: true},
        {id: 'why_you', sec: S_EXTRA, label: 'Nega aynan sizni tanlashimiz kerak?', type: 'textarea', req: true},
        {id: 'phone', sec: S_EXTRA, label: 'Telefon raqamingiz', type: 'tel', req: true},
        {id: 'current_activity', sec: S_EXTRA, label: 'Hozirda nima qilasiz? (o\'qish/ish)', type: 'textarea', req: true},
        {id: 'socials', sec: S_EXTRA, label: 'Instagram va Facebook sahifangiz', type: 'text', req: true}
    ];

    let currentRole = '';
    let questions = [];
    let currentIndex = 0;

    // Global storage for files: { id: Blob }
    const fileStorage = {};

    function initForm(role) {
        currentRole = role;
        questions = (role === 'teacher') ? teacherConfig : staffConfig;
        currentIndex = 0;

        document.getElementById('role-screen').style.display = 'none';
        document.getElementById('wizard-container').style.display = 'block';
        document.getElementById('nav-bar').style.display = 'flex';
        document.getElementById('header-sub').innerText = (role === 'teacher' ? 'O\'qituvchi' : 'Xodim') + ' Anketasi';

        // Add safety check
        window.addEventListener('beforeunload', handleBeforeUnload);

        renderQuestion();
    }

    function handleBeforeUnload(e) {
        e.preventDefault();
        e.returnValue = '';
    }

    function renderQuestion() {
        const q = questions[currentIndex];
        const container = document.getElementById('form-content');

        // Header Update
        document.getElementById('sec-title').innerText = q.sec;
        document.getElementById('q-count').innerText = `${currentIndex + 1} / ${questions.length}`;
        const pct = Math.round(((currentIndex + 1) / questions.length) * 100);
        document.getElementById('p-fill').style.width = pct + '%';

        // Input Construction
        let inputHtml = '';
        const commonClass = 'input-group';
        const ph = q.placeholder || 'Javobingizni kiriting...';

        if (q.type === 'textarea') {
            inputHtml = `<textarea id="inp" class="${commonClass}" placeholder="${ph}"></textarea>`;
        } else if (q.type === 'select') {
            let opts = `<option value="" disabled selected>Tanlang...</option>`;
            q.opts.forEach(o => opts += `<option value="${o}">${o}</option>`);
            inputHtml = `<select id="inp" class="${commonClass}">${opts}</select>`;
        } else if (q.type === 'file') {
            inputHtml = `
            <div class="file-box">
                <div class="file-content">
                    <i class="fa-solid ${q.icon} file-icon"></i>
                    <div class="file-text" id="ftxt">Fayl tanlash</div>
                    <div class="file-hint">Rasm yoki PDF (Max 20MB)</div>
                </div>
                <img id="img-preview" class="file-preview" alt="Preview">
                <input type="file" id="inp" accept="image/*, application/pdf" onchange="handleFileSelect(event, '${q.id}')">
            </div>`;
        } else {
            inputHtml = `<input type="${q.type}" id="inp" class="${commonClass}" placeholder="${ph}" />`;
        }

        container.innerHTML = `
          <div class="input-group">
            <label class="${q.req ? 'req' : ''}">${q.label}</label>
            ${inputHtml}
            ${q.hint ? `<small style="display:block; margin-top:6px; color:#64748b;">${q.hint}</small>` : ''}
          </div>
        `;

        // Restore values
        const inp = document.getElementById('inp');

        if (q.type === 'file') {
            // Check if we have a file stored
            if (fileStorage[q.id]) {
                const f = fileStorage[q.id];
                document.getElementById('ftxt').innerText = "Tanlangan: " + (f.name || "Image.jpg");
                // If it's an image, show preview
                if (f.type.startsWith('image/')) {
                    const url = URL.createObjectURL(f);
                    const img = document.getElementById('img-preview');
                    img.src = url;
                    img.classList.add('active');
                }
            }
        } else {
            const storedVal = sessionStorage.getItem(currentRole + '_' + q.id);
            if (storedVal) inp.value = storedVal;
            // Auto focus for text
            setTimeout(() => inp.focus(), 150);
        }

        // Nav Buttons
        document.getElementById('btn-prev').disabled = currentIndex === 0;
        const isLast = currentIndex === questions.length - 1;
        document.getElementById('btn-next').style.display = isLast ? 'none' : 'flex';
        document.getElementById('btn-submit').style.display = isLast ? 'flex' : 'none';
    }

    // === IMAGE COMPRESSION LOGIC ===
    async function handleFileSelect(event, qId) {
        const file = event.target.files[0];
        if (!file) return;

        const ftxt = document.getElementById('ftxt');
        const imgPrev = document.getElementById('img-preview');

        ftxt.innerText = "Yuklanmoqda...";

        // If PDF, just store it
        if (file.type === 'application/pdf') {
            fileStorage[qId] = file;
            ftxt.innerText = file.name;
            imgPrev.classList.remove('active');
            return;
        }

        // If Image, compress it
        if (file.type.startsWith('image/')) {
            try {
                const compressedBlob = await compressImage(file);
                // Attach original name for reference
                compressedBlob.name = file.name.replace(/\.[^/.]+$/, "") + ".jpg";

                fileStorage[qId] = compressedBlob;

                // Show preview
                ftxt.innerText = "Tanlandi";
                const url = URL.createObjectURL(compressedBlob);
                imgPrev.src = url;
                imgPrev.classList.add('active');
            } catch (err) {
                console.error(err);
                alert("Rasmni qayta ishlashda xatolik. Iltimos boshqa rasm tanlang.");
                ftxt.innerText = "Xatolik";
            }
        }
    }

    function compressImage(file) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = (e) => {
                const img = new Image();
                img.src = e.target.result;
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const MAX_WIDTH = 1200;
                    const MAX_HEIGHT = 1200;
                    let width = img.width;
                    let height = img.height;

                    if (width > height) {
                        if (width > MAX_WIDTH) {
                            height *= MAX_WIDTH / width;
                            width = MAX_WIDTH;
                        }
                    } else {
                        if (height > MAX_HEIGHT) {
                            width *= MAX_HEIGHT / height;
                            height = MAX_HEIGHT;
                        }
                    }

                    canvas.width = width;
                    canvas.height = height;
                    const ctx = canvas.getContext('2d');
                    ctx.drawImage(img, 0, 0, width, height);

                    // Compress to JPEG 0.7
                    canvas.toBlob((blob) => {
                        if (blob) resolve(blob);
                        else reject(new Error("Compression failed"));
                    }, 'image/jpeg', 0.7);
                };
                img.onerror = (err) => reject(err);
            };
            reader.onerror = (err) => reject(err);
        });
    }

    function move(dir) {
        if (dir === 1 && !validateCurrent()) return;
        saveCurrent();
        currentIndex += dir;
        renderQuestion();
    }

    function validateCurrent() {
        const q = questions[currentIndex];
        const inp = document.getElementById('inp');

        // Required Check
        if (q.req) {
            if (q.type === 'file') {
                if (!fileStorage[q.id]) {
                    alert("Iltimos, faylni yuklang.");
                    return false;
                }
            } else {
                if (!inp.value.trim()) {
                    inp.style.borderColor = "#ef4444";
                    inp.focus();
                    return false;
                }
            }
        }
        return true;
    }

    function saveCurrent() {
        const q = questions[currentIndex];
        if (q.type !== 'file') {
            const inp = document.getElementById('inp');
            sessionStorage.setItem(currentRole + '_' + q.id, inp.value);
        }
    }

    function submitForm() {
        if (!validateCurrent()) return;
        saveCurrent();

        document.getElementById('loading-modal').style.display = 'flex';

        // Disable warning
        window.removeEventListener('beforeunload', handleBeforeUnload);

        const formData = new FormData();
        formData.append('role', currentRole);

        questions.forEach(q => {
            if (q.type !== 'file') {
                const val = sessionStorage.getItem(currentRole + '_' + q.id);
                formData.append(q.id, val || '-');
            } else {
                if (fileStorage[q.id]) {
                    formData.append(q.id, fileStorage[q.id], fileStorage[q.id].name);
                }
            }
        });

        fetch('submit.php', {
            method: 'POST',
            body: formData
        })
        .then(r => r.json())
        .then(res => {
            document.getElementById('loading-modal').style.display = 'none';
            if (res.ok) {
                document.getElementById('success-modal').style.display = 'flex';
                sessionStorage.clear();
            } else {
                alert('Xatolik yuz berdi: ' + (res.error || 'Server javob bermadi'));
                window.addEventListener('beforeunload', handleBeforeUnload); // Re-enable if failed
            }
        })
        .catch(err => {
            document.getElementById('loading-modal').style.display = 'none';
            alert('Internet bilan aloqa yo\'q yoki server ishlamayapti.');
            window.addEventListener('beforeunload', handleBeforeUnload); // Re-enable
        });
    }
</script>
</body>
</html>