const fs = require('fs');

async function testAPIs() {
    const baseUrl = 'http://127.0.0.1:8000/api';
    let output = "=== Laporan Testing API E-Pengadaan ===\n\n";

    // 1. Register User
    output += "1. Register User...\n";
    let res = await fetch(`${baseUrl}/auth/user/register`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({
            nama_user: 'Panitia Lelang',
            email_user: 'panitia@test.com',
            password_user: 'password123',
            id_role: 1,
            id_sistem: 1
        })
    });
    let data = await res.json();
    output += `Status: ${res.status}\n`;
    output += `Response: ${JSON.stringify(data, null, 2)}\n\n`;
    const userToken = data.access_token;

    // 2. Register Penyedia
    output += "2. Register Penyedia...\n";
    res = await fetch(`${baseUrl}/auth/penyedia/register`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
        body: JSON.stringify({
            nama_perusahaan: 'PT Makmur Jaya',
            email_penyedia: 'makmur@test.com',
            password_penyedia: 'password123',
            nib: '1234567890',
            id_sistem: 1
        })
    });
    data = await res.json();
    output += `Status: ${res.status}\n`;
    output += `Response: ${JSON.stringify(data, null, 2)}\n\n`;
    
    // 3. Create Pengadaan
    output += "3. Create Pengadaan (menggunakan token user)...\n";
    res = await fetch(`${baseUrl}/pengadaan`, {
        method: 'POST',
        headers: { 
            'Content-Type': 'application/json', 
            'Accept': 'application/json',
            'Authorization': `Bearer ${userToken}`
        },
        body: JSON.stringify({
            nama_pengadaan: 'Pengadaan Laptop 2026',
            pagu_anggaran: '50000000',
            id_user: 1,
            id_penyedia: 1
        })
    });
    data = await res.json();
    output += `Status: ${res.status}\n`;
    output += `Response: ${JSON.stringify(data, null, 2)}\n\n`;
    const pengadaanId = data.id_pengadaan;

    // 4. Get All Pengadaan
    output += "4. Get All Pengadaan...\n";
    res = await fetch(`${baseUrl}/pengadaan`, {
        method: 'GET',
        headers: { 
            'Accept': 'application/json',
            'Authorization': `Bearer ${userToken}`
        }
    });
    data = await res.json();
    output += `Status: ${res.status}\n`;
    output += `Response: ${JSON.stringify(data, null, 2)}\n\n`;

    fs.writeFileSync('test_results.txt', output);
    console.log("Testing selesai! Hasil tersimpan di test_results.txt");
}

testAPIs();
