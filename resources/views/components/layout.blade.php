<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CIT Registration Portal</title>
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #050811 0%, #0d1527 50%, #080c18 100%);
            --card-bg: rgba(15, 23, 42, 0.75);
            --card-border: rgba(255, 255, 255, 0.08);
            --ios-blue: #3B82F6;
            --ios-blue-glow: rgba(59, 130, 246, 0.25);
            --ios-blue-dark: #1D4ED8;
            --text-main: #F8FAFC;
            --text-muted: #94A3B8;
            --input-bg: rgba(30, 41, 59, 0.6);
            --input-border: rgba(255, 255, 255, 0.12);
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, "SF Pro Display", "SF Pro Text", "Helvetica Neue", sans-serif;
            background: var(--bg-gradient);
            background-attachment: fixed;
            color: var(--text-main);
            margin: 0;
            padding: 0;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
        }

        .container {
            max-width: 640px;
            margin: 100px auto 40px;
            padding: 0 20px;
        }

        .page-intro {
            text-align: center;
            margin-bottom: 28px;
        }

        .page-intro h1 {
            font-size: 28px;
            font-weight: 700;
            letter-spacing: -0.5px;
            margin: 0 0 8px 0;
            background: linear-gradient(180deg, #FFFFFF 0%, #CBD5E1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .page-intro p {
            color: var(--text-muted);
            font-size: 15px;
            margin: 0;
            line-height: 1.5;
        }

        .ios-card {
            background: var(--card-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--card-border);
            border-radius: 20px;
            padding: 32px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4), inset 0 1px 0 rgba(255, 255, 255, 0.1);
        }

        .ios-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .ios-input {
            width: 100%;
            padding: 14px 16px;
            margin-bottom: 20px;
            background: var(--input-bg);
            border: 1px solid var(--input-border);
            border-radius: 12px;
            font-size: 15px;
            color: var(--text-main);
            box-sizing: border-box;
            transition: all 0.2s ease;
        }

        .ios-input:focus {
            outline: none;
            border-color: var(--ios-blue);
            box-shadow: 0 0 0 4px var(--ios-blue-glow);
            background: rgba(30, 41, 59, 0.85);
        }

        .ios-input option {
            background-color: #0F172A;
            color: var(--text-main);
        }

        .ios-btn {
            background: linear-gradient(180deg, #3B82F6 0%, #2563EB 100%);
            color: white;
            border: none;
            padding: 14px 24px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.3);
            transition: all 0.2s ease;
        }

        .ios-btn:hover {
            opacity: 0.95;
            transform: translateY(-1px);
        }

        .ios-btn-secondary {
            background: rgba(255, 255, 255, 0.08);
            color: var(--text-main);
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: none;
            margin-top: 10px;
        }

        .ios-btn-secondary:hover {
            background: rgba(255, 255, 255, 0.12);
        }

        .hidden { display: none; }
        .icon-svg { width: 18px; height: 18px; fill: currentColor; }
    </style>
</head>
<body>
    @include('components.navbar')
    <div class="container">
        @yield('content')
    </div>
</body>
@if(session('success'))
    <div style="background: rgba(52, 211, 153, 0.2); border: 1px solid #34D399; color: #10B981; padding: 16px; border-radius: 12px; max-width: 600px; margin: 80px auto -60px; text-align: center; font-weight: 600; backdrop-filter: blur(10px);">
        <svg style="width: 20px; height: 20px; vertical-align: middle; margin-right: 8px;" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/></svg>
        {{ session('success') }}
    </div>
@endif
</html>