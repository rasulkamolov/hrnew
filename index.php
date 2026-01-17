<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>Oxford Learning Centre - HR</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        :root{ --primary:#002147; --primary-dark:#001635; --light:#f9fafb; --border:#e5e7eb; --radius:14px }
        *{box-sizing:border-box}
        body{font-family:'Roboto',sans-serif;margin:0;background:#f6f7f9;color:#111;min-height:100vh;display:flex;flex-direction:column}

        header{background:var(--primary);color:#fff;text-align:center;padding:20px;position:sticky;top:0;z-index:50;box-shadow:0 2px 10px rgba(0,0,0,0.1)}
        header h1{margin:0;font-size:1.4rem}
        header p{margin:5px 0 0;font-size:0.9rem;opacity:0.8}

        .container{max-width:800px;margin:0 auto;padding:20px;flex:1;width:100%}

        /* Role Selection */
        #role-screen { display: flex; flex-direction: column; gap: 20px; align-items: center; justify-content: center; min-height: 60vh; }
        .role-grid { display: grid; grid-template-columns: 1fr; gap: 20px; width: 100%; max-width: 500px; }
        .role-card { background: #fff; border: 1px solid var(--border); border-radius: var(--radius); padding: 30px; text-align: center; cursor: pointer; transition: 0.2s; box-shadow: 0 4px 6px rgba(0,0,0,0.05); }
        .role-card:hover { border-color: var(--primary); transform: translateY(-3px); box-shadow: 0 10px 15px rgba(0,0,0,0.1); }
        .role-card i { font-size: 3rem; color: var(--primary); margin-bottom: 15px; }
        .role-title { font-size: 1.2rem; font-weight: 700; color: #333; }

        /* Wizard Form */
        #wizard-container { display: none; }
        .steps { display: flex; gap: 8px; overflow-x: auto; padding-bottom: 10px; margin-bottom: 15px; -webkit-overflow-scrolling: touch; }
        .chip { flex: 0 0 auto; background: #fff; border: 1px solid var(--border); padding: 6px 12px; border-radius: 20px; font-size: 0.85rem; font-weight: 500; color: #555; display: flex; align-items: center; gap: 6px; }
        .chip.active { border-color: var(--primary); color: var(--primary); background: #f0fdf4; }
        .chip.completed { background: #dcfce7; border-color: #16a34a; color: #166534; }

        .card { background: #fff; padding: 20px; border-radius: var(--radius); box-shadow: 0 1px 3px rgba(0,0,0,0.05); }

        .q-info { margin-bottom: 15px; display: flex; justify-content: space-between; align-items: center; color: var(--primary); font-weight: 700; }
        .q-count { color: #888; font-weight: 400; font-size: 0.9rem; }

        .input-group { margin-bottom: 15px; animation: fadeIn 0.3s ease; }
        @keyframes fadeIn { from { opacity:0; transform:translateY(5px); } to { opacity:1; transform:translateY(0); } }

        label { display: block; margin-bottom: 8px; font-weight: 600; color: #333; }
        .req::after { content:" *"; color: red; }

        input, select, textarea { width: 100%; padding: 12px; border: 1px solid var(--border); border-radius: 8px; font-size: 16px; background: #fdfdfd; font-family: inherit; }
        input:focus, textarea:focus { outline: none; border-color: var(--primary); background: #fff; }
        textarea { resize: vertical; min-height: 100px; }

        /* File Upload */
        .file-box { border: 2px dashed var(--border); padding: 20px; text-align: center; border-radius: 10px; position: relative; background: #fafafa; transition: 0.2s; }
        .file-box:hover { border-color: var(--primary); background: #f0f7ff; }
        .file-box input { position: absolute; inset: 0; opacity: 0; cursor: pointer; }
        .file-icon { font-size: 24px; color: var(--primary); margin-bottom: 5px; }
        .file-name { font-size: 0.85rem; color: #666; margin-top: 5px; font-weight: 500; }

        /* Navigation */
        .nav { position: fixed; bottom: 0; left: 0; right: 0; background: #fff; padding: 15px; border-top: 1px solid var(--border); display: flex; gap: 10px; z-index: 100; justify-content: center; }
        .nav-inner { width: 100%; max-width: 800px; display: flex; gap: 10px; }
        .btn { flex: 1; padding: 14px; border: none; border-radius: 10px; font-weight: 700; font-size: 1rem; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-secondary { background: #e5e7eb; color: #333; }
        .btn:disabled { opacity: 0.5; cursor: not-allowed; }

        /* Progress */
        .progress-wrap { margin-bottom: 15px; display: flex; align-items: center; gap: 10px; }
        .progress-bg { flex: 1; height: 8px; background: #e5e7eb; border-radius: 4px; overflow: hidden; }
        .progress-fill { height: 100%; background: var(--primary); width: 0%; transition: width 0.3s; }
        .progress-txt { font-size: 0.85rem; font-weight: 700; color: #555; width: 40px; text-align: right; }

        /* Modals */
        .modal-bg { position: fixed; inset: 0; background: rgba(0,0,0,0.5); z-index: 200; display: none; align-items: center; justify-content: center; padding: 20px; }
        .modal { background: #fff; padding: 30px; border-radius: 16px; text-align: center; max-width: 400px; width: 100%; box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1); }
        .modal i { font-size: 50px; color: #16a34a; margin-bottom: 15px; }
        .modal h3 { margin: 0 0 10px; font-size: 1.5rem; }
        .modal p { color: #666; margin-bottom: 20px; }

        @media(min-width: 600px) { .role-grid { grid-template-columns: 1fr 1fr; } }
    </style>
</head>
<body>

<header>
    <h1>Oxford Learning Centre</h1>
    <p id="header-sub">HR Application Form</p>
</header>

<div class="container" id="role-screen">
    <h2 style="text-align: center; margin-bottom: 30px; color: #333;">Kim bo'lib ishga kirmoqchisiz?</h2>
    <div class="role-grid">
        <div class="role-card" onclick="initForm('teacher')">
            <i class="fa-solid fa-chalkboard-user"></i>
            <div class="role-title">O'qituvchi</div>
            <div style="font-size:0.9rem; color:#666; margin-top:5px">English, Rus tili, va h.k</div>
        </div>
        <div class="role-card" onclick="initForm('staff')">
            <i class="fa-solid fa-briefcase"></i>
            <div class="role-title">Xodim (Staff)</div>
            <div style="font-size:0.9rem; color:#666; margin-top:5px">Admin, Manager, Yordamchi</div>
        </div>
    </div>
</div>

<div class="container" id="wizard-container">
    <div class="steps" id="steps-bar"></div>

    <div class="progress-wrap">
        <div class="progress-bg"><div class="progress-fill" id="p-fill"></div></div>
        <div class="progress-txt" id="p-text">0%</div>
    </div>

    <form id="mainForm" class="card" onsubmit="return false;">
        <div class="q-info">
            <span id="sec-title">Asosiy</span>
            <span class="q-count" id="q-count">1/20</span>
        </div>
        <div id="form-content"></div>
        <div style="height: 60px;"></div> </form>
</div>

<div class="nav" id="nav-bar" style="display:none">
    <div class="nav-inner">
        <button class="btn btn-secondary" id="btn-prev" onclick="move(-1)"><i class="fa-solid fa-arrow-left"></i> Oldingi</button>
        <button class="btn btn-primary" id="btn-next" onclick="move(1)">Keyingi <i class="fa-solid fa-arrow-right"></i></button>
        <button class="btn btn-primary" id="btn-submit" style="display:none; background:#16a34a" onclick="submitForm()">Yuborish <i class="fa-solid fa-paper-plane"></i></button>
    </div>
</div>

<div class="modal-bg" id="loading-modal">
    <div class="modal">
        <i class="fa-solid fa-circle-notch fa-spin" style="color:var(--primary); font-size:40px"></i>
        <h3 style="font-size:1.2rem; margin-top:15px">Yuborilmoqda...</h3>
        <p>Iltimos, kutib turing.</p>
    </div>
</div>

<div class="modal-bg" id="success-modal">
    <div class="modal">
        <i class="fa-solid fa-check-circle"></i>
        <h3>Muvaffaqiyatli!</h3>
        <p>Arizangiz qabul qilindi. Tez orada aloqaga chiqamiz.</p>
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
        {id: 'full_name', sec: S_MAIN, label: '1) Ism sharifingiz', type: 'text', req: true},
        {id: 'phone', sec: S_MAIN, label: '2) Telefon raqamingiz', type: 'tel', req: true, hint: '+998 90 123 45 67'},
        {id: 'birthdate', sec: S_MAIN, label: '3) Tug\'ilgan kuningiz', type: 'date', req: true},
        {id: 'time135', sec: 'Vaqt', label: '4) 1-3-5 kunlari bo\'sh vaqtlar', type: 'text', req: true},
        {id: 'time246', sec: 'Vaqt', label: '5) 2-4-6 kunlari bo\'sh vaqtlar', type: 'text', req: true},
        {id: 'duration', sec: 'Vaqt', label: '6) Biz bilan qancha muddat ishlamoqchisiz?', type: 'text', req: true},
        {id: 'levels', sec: S_WORK, label: '7) Qaysi darajadagi o\'quvchilar?', type: 'text', req: true},
        {id: 'russian', sec: S_WORK, label: '8) Rus tilida dars bera olasizmi?', type: 'select', opts: ['Ha', 'Yo\'q', 'Qisman'], req: true},
        {id: 'second_job', sec: S_WORK, label: '9) Ikkinchi ishingiz haqida', type: 'textarea', req: true},
        {id: 'experience', sec: S_WORK, label: '10) Tajribangiz haqida', type: 'textarea', req: true},
        {id: 'students_taught', sec: S_WORK, label: '11) Qancha o\'quvchiga dars bergansiz?', type: 'number', req: true},
        {id: 'education', sec: S_WORK, label: '12) Qaysi bilim dargohlarini tugatgansiz?', type: 'text', req: true},
        {id: 'ielts_trainer', sec: S_WORK, label: '13) O\'zingiz kimda tayyorlangansiz?', type: 'text', req: true},
        {id: 'strengths', sec: S_EXTRA, label: '14) Ustun tomoningiz', type: 'textarea', req: true},
        {id: 'strategy', sec: S_EXTRA, label: '15) O\'quvchi tezroq o\'rganishi uchun nima qilasiz?', type: 'textarea', req: true},
        {id: 'goals', sec: S_EXTRA, label: '16) 3 yillikdagi 3 ta maqsadingiz', type: 'textarea', req: true},
        {id: 'father', sec: 'Oila', label: '17) Otangiz haqida', type: 'textarea', req: true},
        {id: 'mother', sec: 'Oila', label: '18) Onangiz haqida', type: 'textarea', req: true},
        {id: 'partner', sec: 'Oila', label: '19) Turmush o\'rtog\'ingiz haqida', type: 'textarea', req: true},
        {id: 'relatives', sec: 'Oila', label: '20) Boshqa oila a\'zolaringiz haqida', type: 'textarea', req: true},
        {id: 'ielts_cert', sec: S_FILES, label: '21) Fan sertifikatingiz (IELTS/CEFR)', type: 'file', req: true, icon: 'fa-file-pdf'},
        {id: 'photo', sec: S_FILES, label: '22) O\'zingizning rasmingiz', type: 'file', req: true, icon: 'fa-camera'}
    ];

    // Staff Questions (Requested Specifics)
    const staffConfig = [
        {id: 'photo', sec: S_FILES, label: '1) Rasmingiz (qanday bo\'lishi ahamiyatsiz)', type: 'file', req: true, icon: 'fa-camera'},
        {id: 'full_name', sec: S_MAIN, label: '2) Ism sharifingiz', type: 'text', req: true},
        {id: 'birthdate', sec: S_MAIN, label: '3) Tug\'ilgan yilingiz (Sana)', type: 'date', req: true},
        {id: 'address', sec: S_MAIN, label: '4) Doimiy va hozirgi manzilingiz', type: 'textarea', req: true},
        {id: 'education', sec: S_MAIN, label: '5) Qayerni tugatgansiz? (yoki o\'qiyapsiz)', type: 'text', req: true},
        {id: 'languages', sec: S_MAIN, label: '8) Qaysi chet tilini bilasiz?', type: 'text', req: true},
        {id: 'work_history', sec: S_WORK, label: '9) Oldin ishlagan joylaringiz va muddati', type: 'textarea', req: true},
        {id: 'reason_leave', sec: S_WORK, label: '10) Nimaga oldingi ishingizdan bo\'shagansiz?', type: 'textarea', req: true},
        {id: 'computer_skills', sec: S_WORK, label: '11) Kompyuter, Word va Excel darajangiz?', type: 'text', req: true},
        {id: 'marital_status', sec: S_EXTRA, label: '12) Oila qurganmisiz?', type: 'select', opts: ['Ha', 'Yo\'q'], req: true},
        {id: 'duration', sec: S_EXTRA, label: '14) Biz bilan qancha muddat ishlamoqchisiz?', type: 'text', req: true},
        {id: 'why_you', sec: S_EXTRA, label: '15) Nega aynan sizni tanlashimiz kerak?', type: 'textarea', req: true},
        {id: 'phone', sec: S_EXTRA, label: '16) Telefon raqamingiz', type: 'tel', req: true},
        {id: 'current_activity', sec: S_EXTRA, label: '17) Hozirda nima qilasiz? (o\'qish/ish)', type: 'textarea', req: true, hint: 'Iltimos to\'liq yozing'},
        {id: 'socials', sec: S_EXTRA, label: '18) Instagram va Facebook sahifangiz', type: 'text', req: true}
    ];

    let currentRole = '';
    let questions = [];
    let currentIndex = 0;

    function initForm(role) {
        currentRole = role;
        questions = (role === 'teacher') ? teacherConfig : staffConfig;
        currentIndex = 0;

        // UI Switch
        document.getElementById('role-screen').style.display = 'none';
        document.getElementById('wizard-container').style.display = 'block';
        document.getElementById('nav-bar').style.display = 'flex';
        document.getElementById('header-sub').innerText = (role === 'teacher' ? 'O\'qituvchi' : 'Xodim') + ' Anketasi';

        renderStepper();
        renderQuestion();
    }

    function renderStepper() {
        const bar = document.getElementById('steps-bar');
        bar.innerHTML = '';
        const uniqueSecs = [...new Set(questions.map(q => q.sec))];
        uniqueSecs.forEach(sec => {
            const chip = document.createElement('div');
            chip.className = 'chip';
            chip.id = 'chip-' + sec;
            chip.innerHTML = `<span>${sec}</span>`;
            bar.appendChild(chip);
        });
    }

    function renderQuestion() {
        const q = questions[currentIndex];
        const container = document.getElementById('form-content');

        // Update Header info
        document.getElementById('sec-title').innerText = q.sec;
        document.getElementById('q-count').innerText = `${currentIndex + 1} / ${questions.length}`;

        // Progress Bar
        const pct = Math.round(((currentIndex) / questions.length) * 100);
        document.getElementById('p-fill').style.width = pct + '%';
        document.getElementById('p-text').innerText = pct + '%';

        // Highlight Chip
        document.querySelectorAll('.chip').forEach(c => c.classList.remove('active'));
        const activeChip = document.getElementById('chip-' + q.sec);
        if(activeChip) activeChip.classList.add('active');

        // Build Input HTML
        let inputHtml = '';
        if (q.type === 'textarea') {
            inputHtml = `<textarea id="inp" class="input-group" placeholder="Javobingiz..."></textarea>`;
        } else if (q.type === 'select') {
            let opts = `<option value="" disabled selected>Tanlang...</option>`;
            q.opts.forEach(o => opts += `<option value="${o}">${o}</option>`);
            inputHtml = `<select id="inp" class="input-group">${opts}</select>`;
        } else if (q.type === 'file') {
            inputHtml = `
        <div class="file-box input-group" onclick="document.getElementById('inp').click()">
          <i class="fa-solid ${q.icon} file-icon"></i>
          <div>Faylni yuklash uchun bosing</div>
          <div class="file-name" id="fname">Tanlanmadi</div>
          <input type="file" id="inp" accept="image/*, application/pdf" onchange="document.getElementById('fname').innerText = this.files[0].name">
        </div>`;
        } else {
            inputHtml = `<input type="${q.type}" id="inp" class="input-group" placeholder="${q.hint || 'Javobingiz...'}" />`;
        }

        container.innerHTML = `
      <div class="input-group">
        <label class="${q.req ? 'req' : ''}">${q.label}</label>
        ${inputHtml}
        ${q.hint ? `<small style="color:#666">${q.hint}</small>` : ''}
      </div>
    `;

        // Restore value if exists
        const storedVal = sessionStorage.getItem(currentRole + '_' + q.id);
        const inp = document.getElementById('inp');
        if (storedVal && q.type !== 'file') inp.value = storedVal;

        // Focus
        if(q.type !== 'file') setTimeout(() => inp.focus(), 100);

        // Button States
        document.getElementById('btn-prev').disabled = currentIndex === 0;
        if (currentIndex === questions.length - 1) {
            document.getElementById('btn-next').style.display = 'none';
            document.getElementById('btn-submit').style.display = 'flex';
        } else {
            document.getElementById('btn-next').style.display = 'flex';
            document.getElementById('btn-submit').style.display = 'none';
        }
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
        if (q.req) {
            if (q.type === 'file') {
                // For files, we need to check if file is selected OR if it was already selected in a previous session (complex for simple JS, so we enforce re-select for now or check simple validation)
                if (inp.files.length === 0) {
                    alert("Iltimos, faylni yuklang.");
                    return false;
                }
            } else {
                if (!inp.value.trim()) {
                    inp.style.borderColor = "red";
                    inp.focus();
                    return false;
                }
            }
        }
        return true;
    }

    function saveCurrent() {
        const q = questions[currentIndex];
        const inp = document.getElementById('inp');
        if (q.type !== 'file') {
            sessionStorage.setItem(currentRole + '_' + q.id, inp.value);
        }
        // Files are handled by the DOM element staying alive or re-upload,
        // but here we are swapping innerHTML, so we must store file objects globally
        if (q.type === 'file' && inp.files.length > 0) {
            fileStorage[q.id] = inp.files[0];
        }
    }

    // Helper to store files because innerHTML wipes inputs
    const fileStorage = {};

    function submitForm() {
        if (!validateCurrent()) return;
        saveCurrent(); // Save last answer

        const formData = new FormData();
        formData.append('role', currentRole);

        // Append all text fields from SessionStorage
        questions.forEach(q => {
            if (q.type !== 'file') {
                const val = sessionStorage.getItem(currentRole + '_' + q.id);
                formData.append(q.id, val || '-');
            } else {
                // Append files from global storage
                if (fileStorage[q.id]) {
                    formData.append(q.id, fileStorage[q.id]);
                }
            }
        });

        // UI
        document.getElementById('loading-modal').style.display = 'flex';

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
                    alert('Xatolik: ' + res.error);
                }
            })
            .catch(err => {
                document.getElementById('loading-modal').style.display = 'none';
                alert('Internet xatosi yoki server ishlamayapti.');
            });
    }
</script>
</body>
</html>