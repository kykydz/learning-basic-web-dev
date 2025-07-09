import React from 'react';
import './App.css'; // CSS global untuk App
import BasicForm from './components/BasicForm'; // Impor komponen formulir kita

function App() {
  return (
    <div className="App">
      <header className="App-header">
        {/* Anda bisa menambahkan elemen lain di sini, seperti navigasi atau logo */}
        <h1>Selamat Datang di Aplikasi Frontend Saya</h1>
      </header>
      <main>
        <BasicForm /> {/* Render komponen formulir di sini */}
      </main>
      <footer>
        <p>&copy; 2025 Aplikasi Frontend Saya. Hak Cipta Dilindungi.</p>
      </footer>
    </div>
  );
}

export default App;