@extends('templates.login')
@section('container')
    <style>
        :root {
            --primary-color: #4f46e5;
            --primary-hover: #4338ca;
            --text-dark: #333;
            --text-muted: #6b7280;
            --border-color: #e2e8f0;
            --error-color: #ef4444;
            --bg-light: #f9fafb;
            --shadow-sm: 0 1px 2px rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            --radius-sm: 4px;
            --radius-md: 6px;
            --radius-lg: 10px;
        }
        
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Roboto, sans-serif;
        }
        
        .login-container {
            max-width: 420px;
            margin: 2rem auto;
            padding: 2.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            background-color: #fff;
        }
        
        .login-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
            color: var(--text-dark);
            letter-spacing: -0.025em;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--text-dark);
            font-size: 0.95rem;
        }
        
        .form-control {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 1rem;
            transition: all 0.2s ease;
            background-color: #fff;
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
            outline: none;
        }
        
        .form-control::placeholder {
            color: #a0aec0;
        }
        
        .is-invalid {
            border-color: var(--error-color);
        }
        
        .invalid-feedback {
            color: var(--error-color);
            font-size: 0.875rem;
            margin-top: 0.375rem;
        }
        
        .password-group {
            position: relative;
        }
        
        .password-addon {
            position: absolute;
            right: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-muted);
            cursor: pointer;
            transition: color 0.2s;
        }
        
        .password-addon:hover {
            color: var(--primary-color);
        }
        
        .btn-primary {
            display: block;
            width: 100%;
            padding: 0.875rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: var(--radius-md);
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            box-shadow: var(--shadow-sm);
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .text-right {
            text-align: right;
        }
        
        .mt-2 {
            margin-top: 0.75rem;
        }
        
        .forgot-password {
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            transition: color 0.2s;
        }
        
        .forgot-password:hover {
            color: var(--primary-color);
        }
        
        .signup-text {
            text-align: center;
            margin-top: 1.75rem;
            color: var(--text-muted);
            font-size: 0.95rem;
        }
        
        .auth-link {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .auth-link:hover {
            text-decoration: underline;
        }
        
        .attendance-section {
            margin-top: 2.5rem;
            display: flex;
            gap: 1rem;
        }
        
        .attendance-column {
            flex: 1;
            padding: 1.25rem;
            border-radius: var(--radius-md);
            background-color: var(--bg-light);
            box-shadow: var(--shadow-sm);
            transition: all 0.2s;
            display: flex;
            flex-direction: column;
        }
        
        .attendance-column:hover {
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }
        
        .attendance-title {
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 1rem;
            text-align: center;
            color: var(--text-dark);
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .attendance-links {
            list-style: none;
            padding: 0;
            margin: 0;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }
        
        .attendance-links li {
            margin-bottom: 0.75rem;
            flex: 1;
            display: flex;
        }
        
        .attendance-links li:last-child {
            margin-bottom: 0;
        }
        
        .attendance-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.625rem;
            text-align: center;
            background-color: white;
            color: var(--primary-color);
            border-radius: var(--radius-sm);
            text-decoration: none;
            transition: all 0.2s;
            border: 1px solid var(--border-color);
            font-weight: 500;
            font-size: 0.95rem;
            width: 100%;
        }
        
        .attendance-links a:hover {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-1px);
            box-shadow: var(--shadow-sm);
        }
        
        /* Media Queries for Mobile View */
        @media (max-width: 768px) {
            .login-container {
                max-width: 90%;
                margin: 1.5rem auto;
                padding: 1.5rem;
            }
            
            .attendance-section {
                flex-direction: column;
                align-items: center;
                gap: 1.5rem;
            }
            
            .attendance-column {
                width: 100%;
                max-width: 300px;
            }
            
            .login-title {
                font-size: 1.5rem;
            }
            
            .btn-primary {
                padding: 0.75rem;
            }
        }
    </style>
    
    <div class="login-container">
        <h1 class="login-title">{{ $title }}</h1>
        
        <form action="{{ url('/login-proses') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                       placeholder="Enter your username" name="username" value="{{ old('username') }}">
                @error('username')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="password-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Enter your password" name="password">
                    <a class="password-addon" id="password-addon"><i class="fa fa-eye"></i></a>
                </div>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-primary">Log In</button>
            
            <div class="text-right mt-2">
                <a href="{{ url('/forgot-password') }}" class="forgot-password">Forgot Password?</a>
            </div>
        </form>
        
        <p class="signup-text">Don't have an account? <a href="{{ url('/register') }}" class="auth-link">Sign up</a></p>
        
        <div class="attendance-section">
            <div class="attendance-column">
                <div class="attendance-title">Face Recognition</div>
                <ul class="attendance-links">
                    <li><a href="{{ url('/presensi') }}">Absen Masuk</a></li>
                    <li><a href="{{ url('/presensi-pulang') }}">Absen Pulang</a></li>
                </ul>
            </div>
            
            <div class="attendance-column">
                <div class="attendance-title">QR Code</div>
                <ul class="attendance-links">
                    <li><a href="{{ url('/qr-masuk') }}">Absen Masuk</a></li>
                    <li><a href="{{ url('/qr-pulang') }}">Absen Pulang</a></li>
                </ul>
            </div>
        </div>
    </div>
@endsection
