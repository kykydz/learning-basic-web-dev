// domUtils.js

// Fungsi untuk menambah elemen ke dalam parent
export function appendElement(parentSelector, elementType, textContent = '', attributes = {}) {
  const parent = document.querySelector(parentSelector);
  if (!parent) return null;
  const el = document.createElement(elementType);
  el.textContent = textContent;
  Object.entries(attributes).forEach(([key, value]) => {
    el.setAttribute(key, value);
  });
  parent.appendChild(el);
  return el;
}

// Fungsi untuk menghapus semua child dari sebuah elemen
export function clearElement(selector) {
  const el = document.querySelector(selector);
  if (el) {
    while (el.firstChild) {
      el.removeChild(el.firstChild);
    }
  }
}

// Fungsi untuk mengupdate teks sebuah elemen
export function updateText(selector, newText) {
  const el = document.querySelector(selector);
  if (el) {
    el.textContent = newText;
  }
}