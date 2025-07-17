import React, { useState, useEffect } from "react";

// === Simulasi API Service ===
const apiService = {
  async fetchItems() {
    const resultPromise = await fetch("http://localhost:3005/api/visitors", {
      method: "GET",
      headers: {
        "Content-Type": "application/json",
      },
    });

    const response = await resultPromise.json();
    return response.data.results;
  },

  // Menghapus item berdasarkan ID
  async deleteItem(id) {
    return fetch(`http://localhost:3005/visitors/${id}`, {
      method: "DELETE",
    });
  },

  // Menambah pengunjung baru
  async createItem(name, address, phone_number, visit_date) {
    return fetch("http://localhost:3005/visitors", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ name, address, phone_number, visit_date }),
    });
  },

  // Mengupdate pengunjung
  async updateItem(id, name, address, phone_number, visit_date) {
    return fetch(`http://localhost:3005/visitors/${id}`, {
      method: "PATCH",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({ name, address, phone_number, visit_date }),
    });
  },
};

// === Komponen DataTable ===
const DataTable = ({ items, onDeleteItem, onEditItem }) => {
  return (
    <div className="overflow-x-auto bg-white p-4 rounded-lg shadow-md border border-gray-200">
      <table className="min-w-full divide-y divide-gray-200">
        <thead className="bg-gray-100">
          <tr>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              ID
            </th>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Nama
            </th>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Alamat
            </th>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              No. Telepon
            </th>
            <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
              Tanggal Kunjungan
            </th>
            <th className="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
              Aksi
            </th>
          </tr>
        </thead>
        <tbody className="bg-white divide-y divide-gray-200">
          {items.length === 0 ? (
            <tr>
              <td
                colSpan="6"
                className="px-6 py-4 whitespace-nowrap text-center text-gray-500 text-sm italic"
              >
                Tidak ada data.
              </td>
            </tr>
          ) : (
            items.map((item) => (
              <tr key={item.id}>
                <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                  {item.id}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                  {item.name}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {item.address}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {item.phone_number}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                  {item.visit_date}
                </td>
                <td className="px-6 py-4 whitespace-nowrap text-center">
                  <button
                    onClick={() => onEditItem(item.id)}
                    className="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
                  >
                    Edit
                  </button>
                  <button
                    onClick={() => onDeleteItem(item.id)}
                    className="inline-flex items-center px-3 py-1.5 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors duration-200 ml-2"
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            ))
          )}
        </tbody>
      </table>
    </div>
  );
};

// === Komponen Utama ===
export default function App() {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchData = async () => {
      try {
        setLoading(true);
        setError(null);
        const items = await apiService.fetchItems();
        setData(items);
      } catch (err) {
        setError("Gagal memuat data.");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, []);

  const handleDeleteItem = async (id) => {
    try {
      setLoading(true);
      setError(null);
      await apiService.deleteItem(id);
      setData((prevData) => prevData.filter((item) => item.id !== id));
    } catch (err) {
      setError(`Gagal menghapus item: ${err.message}`);
    } finally {
      setLoading(false);
    }
  };

  const handleEditItem = async (id) => {
    // Logika untuk edit pengunjung
    // Bisa menggunakan modal atau form
  };

  if (loading) {
    return <div>Memuat data...</div>;
  }

  if (error) {
    return <div>{error}</div>;
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 p-8 flex items-center justify-center font-sans">
      <div className="bg-white p-10 rounded-2xl shadow-xl w-full max-w-4xl border border-gray-100">
        <h1 className="text-4xl font-extrabold text-center text-gray-900 mb-8">
          Manajemen Pengunjung Perpustakaan
        </h1>
        <DataTable
          items={data}
          onDeleteItem={handleDeleteItem}
          onEditItem={handleEditItem}
        />
      </div>
    </div>
  );
}
