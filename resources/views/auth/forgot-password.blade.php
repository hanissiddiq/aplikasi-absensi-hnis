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
        
        .forgot-container {
            max-width: 420px;
            margin: 2rem auto;
            padding: 2.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            background-color: #fff;
        }
        
        .forgot-title {
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-align: center;
            color: var(--text-dark);
            letter-spacing: -0.025em;
        }
        
        .forgot-subtitle {
            text-align: center;
            margin-bottom: 2rem;
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.5;
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
            margin-top: 1.5rem;
        }
        
        .btn-primary:hover {
            background-color: var(--primary-hover);
            transform: translateY(-1px);
            box-shadow: var(--shadow-md);
        }
        
        .btn-primary:active {
            transform: translateY(0);
        }
        
        .login-text {
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
        
        /* Media Queries for Mobile View */
        @media (max-width: 768px) {
            .forgot-container {
                max-width: 90%;
                margin: 1.5rem auto;
                padding: 1.5rem;
            }
            
            .forgot-title {
                font-size: 1.5rem;
            }
            
            .btn-primary {
                padding: 0.75rem;
            }
        }
    </style>
    
    <div class="forgot-container">
        <h1 class="forgot-title">{{ $title }}</h1>
        <p class="forgot-subtitle">Enter your email address and we'll send you a link to reset your password.</p>
        
        <form action="{{ url('/forgot-password/link') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="Enter your email" name="email" value="{{ old('email') }}">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-primary">Send Reset Link</button>
        </form>
        
        <p class="login-text">Remember your password? <a href="{{ url('/') }}" class="auth-link">Sign in</a></p>
    </div>
@endsection
