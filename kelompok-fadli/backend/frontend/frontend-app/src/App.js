import React, { useState, useEffect } from 'react';

// === API Service ===
// Objek ini berisi fungsi untuk berinteraksi dengan API backend.
const apiService = {
  /**
   * Mengambil semua item (pengguna) dari API backend.
   * @returns {Promise<Array>} Sebuah Promise yang me-resolve ke array objek pengguna.
   */
  async fetchItems() {
    try {
      // URL API backend Anda yang berjalan di port 3001
      const response = await fetch('http://localhost:3001/users', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      });

      // Memeriksa apakah respons HTTP berhasil (status 2xx)
      if (!response.ok) {
        // Melemparkan error jika respons tidak OK
        const errorData = await response.json(); // Coba parse error message dari body
        throw new Error(`HTTP error! Status: ${response.status} - ${errorData.message || response.statusText}`);
      }

      const data = await response.json();
      console.log("Data diterima dari backend:", data); // Log data yang diterima

      // Backend kita langsung mengembalikan array pengguna
      return data;
    } catch (error) {
      console.error("Gagal mengambil data dari backend:", error);
      throw error; // Melemparkan error agar ditangkap oleh useEffect
    }
  },

  /**
   * Menghapus item (pengguna) berdasarkan ID di API backend.
   * @param {number} id ID pengguna yang akan dihapus.
   * @returns {Promise<Response>} Sebuah Promise yang me-resolve ke objek Response.
   */
  async deleteItem(id) {
    try {
      const response = await fetch(`http://localhost:3001/users/${id}`, {
        method: 'DELETE',
      });

      // Untuk DELETE, status 204 No Content berarti berhasil
      if (!response.ok && response.status !== 204) {
        const errorData = await response.json();
        throw new Error(`HTTP error! Status: ${response.status} - ${errorData.message || response.statusText}`);
      }
      return response;
    } catch (error) {
      console.error(`Gagal menghapus item dengan ID ${id}:`, error);
      throw error;
    }
  },
};

// === Komponen UserCard (Kartu Pengguna) ===
// Komponen ini merender detail satu pengguna dalam format kartu.
const UserCard = ({ user, onDelete }) => {
  return (
    <li className="bg-white border border-gray-200 rounded-xl p-6 shadow-lg hover:shadow-2xl transform hover:-translate-y-2 transition duration-300 ease-in-out flex flex-col justify-between">
      <div>
        <h3 className="text-2xl font-bold text-indigo-800 mb-3">{user.name}</h3>
        <p className="text-gray-800 text-lg mb-1">
          <strong className="font-semibold text-gray-900">Username:</strong> {user.username}
        </p>
        <p className="text-gray-800 text-lg mb-1">
          <strong className="font-semibold text-gray-900">Email:</strong> {user.email}
        </p>
        <p className="text-gray-800 text-lg mb-1">
          <strong className="font-semibold text-gray-900">Telepon:</strong> {user.phone || 'N/A'}
        </p>
        <p className="text-gray-800 text-lg mb-1">
          <strong className="font-semibold text-gray-900">Website:</strong>{' '}
          {user.website ? (
            <a href={`http://${user.website}`} target="_blank" rel="noopener noreferrer" className="text-blue-600 hover:underline hover:text-blue-800">
              {user.website}
            </a>
          ) : 'N/A'}
        </p>
        <p className="text-gray-800 text-lg mt-auto pt-2">
          <strong className="font-semibold text-gray-900">Kota:</strong> {user.city || 'N/A'}
        </p>
      </div>
      <div className="mt-6 text-right">
        <button
          onClick={() => onDelete(user.id)}
          className="inline-flex items-center px-4 py-2 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
        >
          Hapus Pengguna
        </button>
      </div>
    </li>
  );
};

// === Komponen ConfirmationModal ===
// Modal sederhana untuk konfirmasi tindakan.
const ConfirmationModal = ({ isOpen, message, onConfirm, onCancel }) => {
  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 bg-gray-600 bg-opacity-75 flex items-center justify-center z-50">
      <div className="bg-white p-8 rounded-lg shadow-2xl max-w-sm w-full mx-4">
        <p className="text-xl font-semibold text-gray-800 mb-6 text-center">{message}</p>
        <div className="flex justify-end space-x-4">
          <button
            onClick={onCancel}
            className="px-5 py-2 border border-gray-300 rounded-md text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition-colors duration-200"
          >
            Batal
          </button>
          <button
            onClick={onConfirm}
            className="px-5 py-2 border border-transparent rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200"
          >
            Konfirmasi
          </button>
        </div>
      </div>
    </div>
  );
};

// === Komponen Utama: App ===
// Ini adalah komponen induk yang mengelola state global aplikasi dan logika pengambilan data.
export default function App() {
  // State untuk menyimpan array item (pengguna)
  const [data, setData] = useState([]);
  // State untuk menunjukkan apakah data sedang dimuat
  const [loading, setLoading] = useState(true);
  // State untuk menyimpan pesan kesalahan jika terjadi
  const [error, setError] = useState(null);
  // State untuk mengelola visibilitas modal konfirmasi
  const [isModalOpen, setIsModalOpen] = useState(false);
  // State untuk menyimpan ID item yang akan dihapus (digunakan oleh modal)
  const [itemToDeleteId, setItemToDeleteId] = useState(null);

  // Hook useEffect untuk melakukan pengambilan data saat komponen dimuat
  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true); // Set loading ke true sebelum memulai fetching
        setError(null); // Reset error
        const items = await apiService.fetchItems(); // Panggil API service
        setData(items); // Perbarui state 'data' dengan item yang diterima
      } catch (err) {
        console.error('Gagal mengambil data:', err);
        setError('Gagal memuat data. Silakan coba lagi.'); // Set pesan error
      } finally {
        setLoading(false); // Set loading ke false setelah fetching selesai
      }
    };

    fetchData(); // Panggil fungsi fetchData saat komponen dimuat
  }, []); // Array dependensi kosong berarti efek ini hanya berjalan sekali (saat mount)

  // Handler untuk membuka modal konfirmasi penghapusan
  const confirmDelete = (id) => {
    setItemToDeleteId(id);
    setIsModalOpen(true);
  };

  // Handler untuk membatalkan penghapusan (menutup modal)
  const cancelDelete = () => {
    setIsModalOpen(false);
    setItemToDeleteId(null);
  };

  // Handler untuk melanjutkan penghapusan setelah konfirmasi
  const executeDelete = async () => {
    setIsModalOpen(false); // Tutup modal
    if (itemToDeleteId === null) return; // Pastikan ada ID yang akan dihapus

    try {
      setLoading(true); // Tampilkan indikator loading saat menghapus
      setError(null); // Bersihkan error sebelumnya
      await apiService.deleteItem(itemToDeleteId); // Panggil API untuk menghapus

      // Perbarui state 'data' secara lokal untuk mencerminkan perubahan.
      setData((prevData) => prevData.filter((item) => item.id !== itemToDeleteId));
      console.log(`Item dengan ID ${itemToDeleteId} berhasil dihapus dari UI.`);
    } catch (err) {
      console.error('Gagal menghapus item:', err);
      setError(`Gagal menghapus item: ${err.message}`); // Tampilkan pesan error spesifik
    } finally {
      setLoading(false); // Sembunyikan indikator loading
      setItemToDeleteId(null); // Reset ID item yang akan dihapus
    }
  };

  // Rendering Kondisional:
  // Menampilkan UI yang berbeda tergantung pada status loading atau error.
  if (loading) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-gray-50">
        <p className="text-xl font-semibold text-blue-600 animate-pulse">Memuat data...</p>
      </div>
    );
  }

  if (error) {
    return (
      <div className="min-h-screen flex items-center justify-center bg-red-100 text-red-700 text-2xl font-semibold p-4 rounded-lg shadow-md m-4">
        <p>Error: {error}</p>
      </div>
    );
  }

  // Setelah data berhasil dimuat dan tidak ada error,
  // komponen ini akan merender judul dan daftar kartu pengguna.
  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-8 flex flex-col items-center justify-center font-sans">
      <div className="bg-white p-10 rounded-2xl shadow-xl w-full max-w-7xl border border-gray-100">
        <header className="mb-12 text-center">
          <h1 className="text-5xl font-extrabold text-gray-900 mb-4 tracking-tight">
            Daftar Pengguna dari Backend
          </h1>
          <p className="text-lg text-gray-600">
            Data diambil dari API Express.js Anda di <code className="bg-gray-100 text-gray-700 px-2 py-1 rounded-md font-mono">http://localhost:3001/users</code>
          </p>
        </header>
        <main>
          {data.length > 0 ? (
            <ul className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
              {data.map((user) => (
                <UserCard key={user.id} user={user} onDelete={confirmDelete} />
              ))}
            </ul>
          ) : (
            <p className="text-gray-600 text-xl text-center py-10">Tidak ada data pengguna yang ditemukan dari backend.</p>
          )}
        </main>
        <footer className="mt-16 text-center text-gray-500 text-sm">
          <p>&copy; 2025 Aplikasi Pengguna Terintegrasi. Dibuat dengan React & Express.</p>
        </footer>
      </div>

      {/* Modal Konfirmasi */}
      <ConfirmationModal
        isOpen={isModalOpen}
        message={`Apakah Anda yakin ingin menghapus pengguna dengan ID ${itemToDeleteId}?`}
        onConfirm={executeDelete}
        onCancel={cancelDelete}
      />
    </div>
  );
}
