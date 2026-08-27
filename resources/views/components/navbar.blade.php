<style>
    .ios-nav-container {
        position: fixed;
        top: 16px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        width: calc(100% - 32px);
        max-width: 480px;
    }

    .ios-nav {
        background: rgba(15, 23, 42, 0.7);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 99px;
        padding: 6px;
        display: flex;
        justify-content: space-between;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    }

    .ios-nav a {
        flex: 1;
        text-decoration: none;
        color: var(--text-muted);
        font-weight: 500;
        font-size: 14px;
        padding: 10px 16px;
        border-radius: 99px;
        text-align: center;
        transition: all 0.25s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .ios-nav a.active {
        color: #FFFFFF;
        background: rgba(255, 255, 255, 0.12);
        box-shadow: inset 0 1px 0 rgba(255, 255, 255, 0.15);
        font-weight: 600;
    }
</style>

<div class="ios-nav-container">
    <nav class="ios-nav">
        <a href="{{ route('registration') }}" class="{{ request()->routeIs('registration') ? 'active' : '' }}">
            <svg class="icon-svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-2 10h-4v4h-2v-4H7v-2h4V7h2v4h4v2z"/></svg>
            Registration
        </a>
        <a href="{{ route('saved.registration') }}" class="{{ request()->routeIs('saved.registration') ? 'active' : '' }}">
            <svg class="icon-svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            Saved Entries
        </a>
    </nav>
</div>