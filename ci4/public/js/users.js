// Data users disimpan dalam format JSON untuk kemudahan parsing
// Format: [{id: 1, username: 'admin', email: 'admin@gmail.som', password: 'hashed_password'}, ...]

const users = [
    {
        id: 1,
        username: 'admin',
        email: 'admin@gmail.som',
        password: '$2y$10$ketZ5UuJNI0pdkxbaEEhduEDM2RGOCnID4HAD7o.f/zcNT5QGlN3O'
    },
    {
        id: 2,
        username: 'user123',
        email: 'user123@gmail.com',
        password: '$2y$10$BOWYrOIavQogWWFMATF8i./Bucj59adRrIffUa2AgSGZ1rMGsq7sS'
    }
];

// Fungsi untuk mendapatkan user berdasarkan email (untuk client-side jika diperlukan)
function getUserByEmail(email) {
    return users.find(user => user.email === email);
}

// Fungsi untuk mengecek login (untuk client-side jika diperlukan)
function checkLogin(email, password) {
    const user = getUserByEmail(email);
    if (user && user.password === password) { // Note: ini plain text, sebenarnya harus verify hash
        return user;
    }
    return null;
}