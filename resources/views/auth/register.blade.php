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
        
        .register-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2.5rem;
            border-radius: var(--radius-lg);
            box-shadow: var(--shadow-lg);
            background-color: #fff;
        }
        
        .register-title {
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
        
        .form-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-md);
            font-size: 1rem;
            transition: all 0.2s ease;
            background-color: #fff;
            appearance: none;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%236b7280' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.25rem;
        }
        
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(79, 70, 229, 0.15);
            outline: none;
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
            margin-top: 2rem;
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
            .register-container {
                max-width: 90%;
                margin: 1.5rem auto;
                padding: 1.5rem;
            }
            
            .register-title {
                font-size: 1.5rem;
            }
            
            .btn-primary {
                padding: 0.75rem;
            }
        }
    </style>
    
    <div class="register-container">
        <h1 class="register-title">{{ $title }}</h1>
        
        <form action="{{ url('/register-proses') }}" method="POST">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" 
                       placeholder="Enter your full name" name="name" value="{{ old('name') }}">
                @error('name')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Username</label>
                <input type="text" class="form-control @error('username') is-invalid @enderror" 
                       placeholder="Choose a username" name="username" value="{{ old('username') }}">
                @error('username')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" 
                       placeholder="example@mail.com" name="email" value="{{ old('email') }}">
                @error('email')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="password-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           placeholder="Create a password" name="password">
                    <a class="password-addon" id="password-addon"><i class="fa fa-eye"></i></a>
                </div>
                @error('password')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Re-type Password</label>
                <div class="password-group">
                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" 
                           placeholder="Confirm your password" name="password_confirmation">
                    <a class="password-addon" id="password-confirm-addon"><i class="fa fa-eye"></i></a>
                </div>
                @error('password_confirmation')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Jabatan</label>
                <select class="form-select @error('jabatan_id') is-invalid @enderror" name="jabatan_id" id="jabatan_id">
                  <option value="">-- Pilih Jabatan --</option>
                  @foreach ($data_jabatan as $dj)
                    @if(old('jabatan_id') == $dj->id)
                      <option value="{{ $dj->id }}" selected>{{ $dj->nama_jabatan }}</option>
                    @else
                      <option value="{{ $dj->id }}">{{ $dj->nama_jabatan }}</option>
                    @endif
                  @endforeach
                </select>
                @error('jabatan_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="form-group">
                <label class="form-label">Lokasi</label>
                <select class="form-select @error('lokasi_id') is-invalid @enderror" name="lokasi_id" id="lokasi_id">
                  <option value="">-- Pilih Lokasi --</option>
                  @foreach ($data_lokasi as $dl)
                    @if(old('lokasi_id') == $dl->id)
                      <option value="{{ $dl->id }}" selected>{{ $dl->nama_lokasi }}</option>
                    @else
                      <option value="{{ $dl->id }}">{{ $dl->nama_lokasi }}</option>
                    @endif
                  @endforeach
                </select>
                @error('lokasi_id')
                  <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <button type="submit" class="btn-primary">Register</button>
        </form>
        
        <p class="login-text">Already have an account? <a href="{{ url('/') }}" class="auth-link">Log In</a></p>
    </div>
    
    <script>
        // Toggle password visibility
        document.getElementById('password-addon').addEventListener('click', function() {
            const passwordInput = document.querySelector('input[name="password"]');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
        
        document.getElementById('password-confirm-addon').addEventListener('click', function() {
            const passwordInput = document.querySelector('input[name="password_confirmation"]');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    </script>
@endsection
