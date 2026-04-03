<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - Aplikasi Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding: 20px 0;
        }
        .register-container {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 450px;
            width: 100%;
            backdrop-filter: blur(10px);
        }
        .register-header {
            text-align: center;
            margin-bottom: 30px;
        }
        .register-header h1 {
            color: #333;
            font-weight: 600;
            margin-bottom: 10px;
        }
        .register-header p {
            color: #666;
            font-size: 14px;
        }
        .form-control {
            border: 2px solid #e1e5e9;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 16px;
            transition: all 0.3s ease;
        }
        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        .btn-register {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
            border-radius: 10px;
            padding: 12px 30px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
        }
        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
            color: white;
            text-decoration: none;
        }
        .alert {
            border-radius: 10px;
            border: none;
        }
        .input-group-text {
            background: #f8f9fa;
            border: 2px solid #e1e5e9;
            border-right: none;
            border-radius: 10px 0 0 10px;
        }
        .form-control:focus + .input-group-text,
        .input-group-text:focus {
            border-color: #667eea;
        }
        .password-requirement {
            font-size: 12px;
            color: #666;
            margin-top: 5px;
        }
        .form-text {
            color: #666;
            font-size: 13px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="register-container">
                    <div class="register-header">
                        <i class="fas fa-user-plus fa-3x text-primary mb-3"></i>
                        <h1>Daftar Akun</h1>
                        <p>Buat akun baru Anda sekarang</p>
                    </div>

                    <?php if(isset($validation)):?>
                        <div class="alert alert-danger">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <strong>Kesalahan Validasi:</strong>
                            <?= $validation->listErrors() ?>
                        </div>
                    <?php endif;?>

                    <form action="<?= base_url('/register'); ?>" method="post">
                        <?= csrf_field(); ?>

                        <!-- Username Field -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="username" class="form-control" id="InputForUsername"
                                   placeholder="Username" value="<?= set_value('username') ?>" required>
                        </div>
                        <small class="form-text d-block mb-3">Username harus minimal 3 karakter</small>

                        <!-- Email Field -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" id="InputForEmail"
                                   placeholder="Email address" value="<?= set_value('email') ?>" required>
                        </div>

                        <!-- Password Field -->
                        <div class="input-group mb-3">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" id="InputForPassword"
                                   placeholder="Password" required>
                        </div>
                        <small class="password-requirement">Password harus minimal 8 karakter</small>

                        <!-- Password Confirm Field -->
                        <div class="input-group mb-4">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="password_confirm" class="form-control" id="InputForPasswordConfirm"
                                   placeholder="Konfirmasi Password" required>
                        </div>

                        <button type="submit" class="btn btn-register">
                            <i class="fas fa-user-plus me-2"></i>Daftar Sekarang
                        </button>
                    </form>

                    <div class="text-center mt-4">
                        <small class="text-muted">Sudah punya akun? <a href="<?= base_url('/login'); ?>" class="text-primary text-decoration-none">Login di sini</a></small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>