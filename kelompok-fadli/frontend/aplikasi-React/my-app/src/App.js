// src/App.js (dengan Tailwind CSS)
import React, { useState, useEffect } from 'react';
// import './App.css'; // Hapus ini jika Anda menggunakan Tailwind penuh

function App() {
  const [users, setUsers] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchUsers = async () => {
      try {
        const response = await fetch('https://jsonplaceholder.typicode.com/users');
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        const data = await response.json();
        setUsers(data);
      } catch (error) {
        setError(error);
        console.error("Terjadi masalah saat mengambil data pengguna:", error);
      } finally {
        setLoading(false);
      }
    };

    fetchUsers();
  }, []);

  if (loading) {
    return <div className="flex justify-center items-center h-screen text-xl font-semibold">Memuat data pengguna...</div>;
  }

  if (error) {
    return (
      <div className="flex justify-center items-center h-screen text-xl text-red-600 font-semibold">
        Terjadi kesalahan: {error.message}
      </div>
    );
  }

  return (
    <div className="min-h-screen bg-gray-100 p-8 text-center">
      <header className="mb-10">
        <h1 className="text-5xl font-extrabold text-gray-800">Daftar Pengguna</h1>
      </header>
      <main>
        <div className="max-w-6xl mx-auto p-6 bg-white rounded-xl shadow-2xl">
          {users.length > 0 ? (
            <ul className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
              {users.map(user => (
                <li key={user.id} className="bg-white border border-gray-200 rounded-lg p-6 shadow-md hover:shadow-lg transform hover:-translate-y-1 transition duration-300">
                  <h3 className="text-2xl font-bold text-blue-700 mb-2">{user.name}</h3>
                  <p className="text-gray-700 text-base mb-1">
                    <strong className="font-semibold text-gray-800">Username:</strong> {user.username}
                  </p>
                  <p className="text-gray-700 text-base mb-1">
                    <strong className="font-semibold text-gray-800">Email:</strong> {user.email}
                  </p>
                  <p className="text-gray-700 text-base mb-1">
                    <strong className="font-semibold text-gray-800">Telepon:</strong> {user.phone}
                  </p>
                  <p className="text-gray-700 text-base mb-1">
                    <strong className="font-semibold text-gray-800">Website:</strong>{' '}
                    <a href={`http://${user.website}`} target="_blank" rel="noopener noreferrer" className="text-blue-500 hover:underline">
                      {user.website}
                    </a>
                  </p>
                  <p className="text-gray-700 text-base">
                    <strong className="font-semibold text-gray-800">Kota:</strong> {user.address.city}
                  </p>
                </li>
              ))}
            </ul>
          ) : (
            <p className="text-gray-600 text-lg">Tidak ada data pengguna yang ditemukan.</p>
          )}
        </div>
      </main>
      <footer className="mt-16 text-gray-500 text-sm">
        <p>&copy; 2025 Aplikasi Pengguna React. Dibuat dengan cinta.</p>
      </footer>
    </div>
  );
}

export default App;