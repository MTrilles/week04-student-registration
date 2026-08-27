<style>
    /* =========================================
       DEFAULT / DARK MODE STYLES
    ========================================= */
    .ios-nav-container {
        position: fixed; /*[cite: 13] */
        top: 16px; /*[cite: 13] */
        left: 50%; /*[cite: 13] */
        transform: translateX(-50%); /*[cite: 13] */
        z-index: 1000; /*[cite: 13] */
        width: calc(100% - 32px); /*[cite: 13] */
        max-width: 480px; /*[cite: 13] */
    }

    .ios-nav {
        background: rgba(15, 23, 42, 0.7); /*[cite: 13] */
        backdrop-filter: blur(16px); /*[cite: 13] */
        -webkit-backdrop-filter: blur(16px); /*[cite: 13] */
        border: 1px solid rgba(255, 255, 255, 0.1); /*[cite: 13] */
        border-radius: 99px; /*[cite: 13] */
        padding: 6px; /*[cite: 13] */
        display: flex; /*[cite: 13] */
        justify-content: space-between; /*[cite: 13] */
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5); /*[cite: 13] */
        transition: all 0.3s ease;
    }

    .ios-nav a {
        flex: 1; /*[cite: 13] */
        text-decoration: none; /*[cite: 13] */
        color: var(--text-muted, #94a3b8); /* Added fallback[cite: 13] */
        font-weight: 500; /*[cite: 13] */
        font-size: 14px; /*[cite: 13] */
        padding: 10px 16px; /*[cite: 13] */
        border-radius: 99px; /*[cite: 13] */
        text-align: center; /*[cite: 13] */
        transition: all 0.25s ease; /*[cite: 13] */
        display: flex; /*[cite: 13] */
        align-items: center; /*[cite: 13] */
        justify-content: center; /*[cite: 13] */
        gap: 8px; /*[cite: 13] */
    }

    .ios-nav a:hover {
        color: #ffffff;
    }

    .ios-nav a.active {
        color: #FFFFFF; /*[cite: 13] */
        background: rgba(255, 255, 255, 0.12); /*[cite: 13] */
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15); /*[cite: 13] */
        font-weight: 600; /*[cite: 13] */
    }

    .icon-svg {
        width: 18px;
        height: 18px;
        fill: currentColor;
    }

    /* =========================================
       LIGHT MODE OVERRIDES
    ========================================= */
    body.theme-light .ios-nav {
        background: rgba(255, 255, 255, 0.75); /* Frosty white background */
        border-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 10px 25px rgba(30, 58, 138, 0.1); /* Subtle blue shadow */
    }

    body.theme-light .ios-nav a {
        color: #64748b; /* Darker slate for readability against light background */
    }

    body.theme-light .ios-nav a:hover {
        color: #1e3a8a; /* Dark blue on hover */
    }

    body.theme-light .ios-nav a.active {
        color: #1e3a8a; /* Deep blue for the active state text */
        background: rgba(219, 234, 254, 0.8); /* Soft blue highlight background */
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.8);
    }
    
    /* Ensure page titles (like "Student Portal") are visible in light mode */
    body.theme-light h1, 
    body.theme-light h2, 
    body.theme-light h3,
    body.theme-light .page-title {
        color: #0f172a !important; /* Forces dark slate text in light mode */
        text-shadow: none !important;
    }
</style>

<div class="ios-nav-container">
    <nav class="ios-nav">
        <!-- Registration Link[cite: 13] -->
        <a href="{{ route('registration') }}" class="{{ request()->routeIs('registration') ? 'active' : '' }}">
            <svg class="icon-svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
            Registration
        </a>
        
        <!-- Saved Entries Link[cite: 13] -->
        <a href="{{ route('saved.registration') }}" class="{{ request()->routeIs('saved.registration') ? 'active' : '' }}">
            <svg class="icon-svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            Saved Entries
        </a>
    </nav>
</div>