// File: StudentManager.jsx
import React, { useEffect, useState } from 'react';

const studentAPI = {
    async fetchAll() {
        const res = await fetch('http://localhost:3001/api/students');
        const json = await res.json();
        return json.data || [];
    },

    async deleteById(id) {
        return await fetch(`http://localhost:3001/api/students/${id}`, {
            method: 'DELETE',
        });
    },
};

function StudentList({ list, onDelete }) {
    return (
        <section className="border rounded-lg bg-slate-100 p-4 overflow-x-auto">
            <table className="table-auto w-full text-sm">
                <thead className="bg-blue-200 text-blue-800 uppercase">
                    <tr>
                        <th className="px-3 py-2">NIM</th>
                        <th className="px-3 py-2">Nama Mahasiswa</th>
                        <th className="px-3 py-2">Jurusan</th>
                        <th className="px-3 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    {list.length === 0 ? (
                        <tr>
                            <td colSpan="4" className="text-center text-gray-500 py-5">
                                Data belum tersedia.
                            </td>
                        </tr>
                    ) : (
                        list.map((mhs) => (
                            <tr key={mhs.id} className="border-t">
                                <td className="px-3 py-2">{mhs.nim}</td>
                                <td className="px-3 py-2">{mhs.nama}</td>
                                <td className="px-3 py-2">{mhs.jurusan}</td>
                                <td className="px-3 py-2 text-center">
                                    <button
                                        onClick={() => onDelete(mhs.id)}
                                        className="bg-rose-500 hover:bg-rose-600 text-white text-xs px-3 py-1 rounded"
                                    >
                                        Hapus
                                    </button>
                                </td>
                            </tr>
                        ))
                    )}
                </tbody>
            </table>
        </section>
    );
}

export default function StudentManager() {
    const [students, setStudents] = useState([]);
    const [loading, setLoading] = useState(true);
    const [error, setError] = useState('');

    useEffect(() => {
        const load = async () => {
            try {
                const result = await studentAPI.fetchAll();
                setStudents(result);
            } catch (err) {
                setError('Gagal memuat data mahasiswa.');
            } finally {
                setLoading(false);
            }
        };
        load();
    }, []);

    const handleDelete = async (id) => {
        try {
            await studentAPI.deleteById(id);
            setStudents((prev) => prev.filter((m) => m.id !== id));
        } catch (err) {
            setError('Gagal menghapus data.');
        }
    };

    return (
        <div className="min-h-screen bg-slate-50 flex flex-col justify-center items-center p-6">
            <div className="w-full max-w-4xl bg-white shadow-md rounded-xl p-6">
                <h1 className="text-2xl font-semibold text-slate-800 mb-5 text-center">
                    Sistem Informasi Mahasiswa
                </h1>

                {loading ? (
                    <p className="text-center text-blue-600">Memuat data...</p>
                ) : error ? (
                    <p className="text-center text-red-500">{error}</p>
                ) : (
                    <StudentList list={students} onDelete={handleDelete} />
                )}
            </div>
        </div>
    );
}
