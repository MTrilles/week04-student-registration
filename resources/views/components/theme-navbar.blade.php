<style>
    body {
        margin: 0;
        min-height: 100vh;
        background: linear-gradient(135deg, #020617 0%, #1e3a8a 100%);
        background-attachment: fixed;
        color: #f8fafc;
        font-family: 'Poppins', sans-serif;
        transition: background 0.5s ease, color 0.5s ease;
    }

    /* Dark Mode Glass Elements */
    .glass-theme {
        background: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }
    
    .modal-card, .info-panel {
        background: rgba(15, 23, 42, 0.75);
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    /* Upper Left Theme Switcher Navigation */
    .theme-nav-container {
        position: fixed;
        top: 16px;
        left: 16px;
        z-index: 1000;
    }

    .theme-nav {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.15);
        border-radius: 99px;
        padding: 4px;
        display: flex;
        gap: 4px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
        transition: all 0.3s ease;
    }

    .theme-btn {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.6);
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        font-size: 12px;
        padding: 6px 12px;
        border-radius: 99px;
        cursor: pointer;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .theme-btn:hover {
        color: #ffffff;
    }

    .theme-btn.active {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.15);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.1);
        font-weight: 600;
    }

    /* =========================================
       GLOBAL LIGHT MODE OVERRIDES
       Background: White to Light Blue Gradient
    ========================================= */
    body.theme-light {
        background: linear-gradient(135deg, #ffffff 0%, #bfdbfe 100%);
        background-attachment: fixed;
        color: #0f172a;
    }

    /* Typography & Headers */
    body.theme-light .page-intro h1 { color: #0f172a; font-weight: 700; text-shadow: none; }
    body.theme-light .page-intro p { color: #334155; font-weight: 500; }
    body.theme-light .phase-title { color: #0f172a; text-shadow: none; font-weight: 700; }
    body.theme-light .ios-label, 
    body.theme-light .info-label { color: #1e293b; text-shadow: none; font-weight: 600; }

    /* Theme Switcher in Light Mode */
    body.theme-light .theme-nav {
        background: rgba(255, 255, 255, 0.7);
        border-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1);
    }
    body.theme-light .theme-btn { color: #64748b; }
    body.theme-light .theme-btn:hover { color: #1e3a8a; }
    body.theme-light .theme-btn.active {
        color: #1e3a8a;
        background: rgba(219, 234, 254, 0.8);
        box-shadow: none;
    }

    /* Main Cards in Light Mode */
    body.theme-light .glass-theme {
        background: rgba(255, 255, 255, 0.65) !important;
        border-color: rgba(255, 255, 255, 0.9) !important;
        color: #0f172a !important;
        box-shadow: 0 10px 30px rgba(30, 58, 138, 0.1) !important;
    }

    /* Inputs & Selects */
    body.theme-light .ios-input {
        background: rgba(255, 255, 255, 0.7) !important;
        border-color: rgba(148, 163, 184, 0.4) !important;
        color: #0f172a !important;
        box-shadow: inset 0 2px 4px rgba(0,0,0,0.02);
    }
    body.theme-light .ios-input:focus {
        background: #ffffff !important;
        border-color: #2563eb !important;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15) !important;
    }
    body.theme-light .ios-input::placeholder { color: #94a3b8 !important; }
    body.theme-light select.ios-input option { background-color: #ffffff; color: #0f172a; }

    /* Modals & Info Panels in Light Mode */
    body.theme-light .modal-card,
    body.theme-light .info-panel {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(20px);
        color: #0f172a;
        border: 1px solid rgba(255, 255, 255, 0.8);
        box-shadow: 0 20px 40px rgba(30, 58, 138, 0.15);
    }
    body.theme-light .modal-close { color: #64748b; }
    body.theme-light .modal-close:hover { color: #0f172a; }
    body.theme-light .modal-info-grid {
        background: rgba(241, 245, 249, 0.7); 
        border-color: rgba(226, 232, 240, 0.8);
    }
    body.theme-light .modal-info-grid p,
    body.theme-light .info-panel p {
        border-bottom-color: rgba(203, 213, 225, 0.6);
    }
    body.theme-light .modal-label { color: #64748b; font-weight: 600; }

    /* Buttons in Light Mode */
    body.theme-light .ios-btn {
        background: #1e3a8a; /* Deep blue for primary actions */
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(30, 58, 138, 0.2);
    }
    body.theme-light .ios-btn:hover { 
        background: #172554; 
        box-shadow: 0 6px 20px rgba(30, 58, 138, 0.3); 
    }
    body.theme-light .ios-btn-secondary {
        background: rgba(255, 255, 255, 0.6);
        border: 1px solid rgba(148, 163, 184, 0.5);
        color: #1e3a8a;
    }
    body.theme-light .ios-btn-secondary:hover { 
        background: #ffffff; 
        box-shadow: 0 4px 15px rgba(30, 58, 138, 0.1);
    }

    /* Scanner Box */
    body.theme-light .scan-box {
        border-color: rgba(148, 163, 184, 0.6);
        background: rgba(255, 255, 255, 0.5);
        color: #1e293b;
        text-shadow: none;
    }
    body.theme-light .scan-box:hover {
        background: rgba(255, 255, 255, 0.8);
        border-color: #2563eb;
    }

    /* Tables in Light Mode */
    body.theme-light .ios-table th { color: #475569; border-bottom-color: rgba(148, 163, 184, 0.3); }
    body.theme-light .ios-table td { color: #1e293b; border-bottom-color: rgba(148, 163, 184, 0.15); }
    body.theme-light .ios-table tbody tr:hover td { background: rgba(241, 245, 249, 0.8); }
    body.theme-light .empty-state { color: #64748b; }
    
    /* Badges */
    body.theme-light .ios-badge {
        background: #eff6ff;
        color: #2563eb;
        border-color: #bfdbfe;
        box-shadow: none;
    }
</style>

<div class="theme-nav-container">
    <nav class="theme-nav">
        <button type="button" class="theme-btn" id="theme-light-btn" onclick="setTheme('light')">
            <svg style="width:14px;height:14px;fill:currentColor" viewBox="0 0 24 24"><path d="M12 7c-2.76 0-5 2.24-5 5s2.24 5 5 5 5-2.24 5-5-2.24-5-5-5zM2 13h2c.55 0 1-.45 1-1s-.45-1-1-1H2c-.55 0-1 .45-1 1s.45 1 1 1zm18 0h2c.55 0 1-.45 1-1s-.45-1-1-1h-2c-.55 0-1 .45-1 1s.45 1 1 1zM11 2v2c0 .55.45 1 1 1s1-.45 1-1V2c0-.55-.45-1-1-1s-1 .45-1 1zm0 18v2c0 .55.45 1 1 1s1-.45 1-1v-2c0-.55-.45-1-1-1s-1 .45-1 1zM5.99 4.58c-.39-.39-1.03-.39-1.41 0s-.39 1.03 0 1.41l1.06 1.06c.39.39 1.03.39 1.41 0s.39-1.03 0-1.41L5.99 4.58zm12.37 12.37c-.39-.39-1.03-.39-1.41 0s-.39 1.03 0 1.41l1.06 1.06c.39.39 1.03.39 1.41 0s.39-1.03 0-1.41l-1.06-1.06zm1.06-12.37c-.39-.39-1.03-.39-1.41 0l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06c.39-.38.39-1.02 0-1.41zM7.05 18.36l-1.06 1.06c-.39.39-.39 1.03 0 1.41s1.03.39 1.41 0l1.06-1.06c.39-.39.39-1.03 0-1.41s-1.02-.39-1.41 0z"/></svg>
            Light
        </button>
        <button type="button" class="theme-btn" id="theme-dark-btn" onclick="setTheme('dark')">
            <svg style="width:14px;height:14px;fill:currentColor" viewBox="0 0 24 24"><path d="M12.3 2a10 10 0 0 0-1.9 20 10 10 0 0 0 9.2-6.1 1 1 0 0 0-1.1-1.3 8 8 0 1 1-8.2-11.4 1 1 0 0 0-.8-1.2z"/></svg>
            Dark
        </button>
        <button type="button" class="theme-btn" id="theme-system-btn" onclick="setTheme('system')">
            <svg style="width:14px;height:14px;fill:currentColor" viewBox="0 0 24 24"><path d="M20 3H4c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h6v2H8v2h8v-2h-2v-2h6c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 12H4V5h16v10z"/></svg>
            System
        </button>
    </nav>
</div>

<script>
    function applyTheme(mode) {
        let actualTheme = mode;
        if (mode === 'system') {
            actualTheme = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
        }

        if (actualTheme === 'light') {
            document.body.classList.add('theme-light');
        } else {
            document.body.classList.remove('theme-light');
        }

        document.querySelectorAll('.theme-btn').forEach(btn => btn.classList.remove('active'));
        const activeBtn = document.getElementById('theme-' + mode + '-btn');
        if (activeBtn) activeBtn.classList.add('active');
    }

    function setTheme(mode) {
        localStorage.setItem('user-theme', mode);
        applyTheme(mode);
    }

    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('user-theme') || 'system';
        applyTheme(savedTheme);

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', () => {
            if ((localStorage.getItem('user-theme') || 'system') === 'system') {
                applyTheme('system');
            }
        });
    });
</script>