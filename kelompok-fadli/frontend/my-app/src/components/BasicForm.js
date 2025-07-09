// src/components/BasicForm.js
import React from 'react';
import './BasicForm.css'; // Opsional: Anda bisa membuat file CSS terpisah untuk form ini

function BasicForm() {
  // Anda bisa menambahkan state dan event handler di sini nanti
  // untuk membuat form menjadi interaktif (misalnya, menangani input user)

  return (
    <div className="form-container">
      <h2>Formulir Kontak Sederhana</h2>
      <form>
        <div className="form-group">
          <label htmlFor="name">Nama:</label>
          <input
            type="text"
            id="name"
            name="name"
            placeholder="Masukkan nama Anda"
            required
          />
        </div>

        <div className="form-group">
          <label htmlFor="email">Email:</label>
          <input
            type="email"
            id="email"
            name="email"
            placeholder="Masukkan email Anda"
            required
          />
        </div>

        <div className="form-group">
          <label htmlFor="message">Pesan:</label>
          <textarea
            id="message"
            name="message"
            rows="5" // Menentukan tinggi textarea
            placeholder="Tulis pesan Anda di sini..."
            required
          ></textarea>
        </div>

        <button type="submit" className="submit-button">
          Kirim Pesan
        </button>
      </form>
    </div>
  );
}

export default BasicForm;