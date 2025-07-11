// import logo from './logo.svg';
// import './App.css';

// function App() {
//   return (
//     <div className="App">
//       <header className="App-header">
//         <img src={logo} className="App-logo" alt="logo" />
//         <p>
//           Edit <code>src/App.js</code> and save to reload.
//         </p>
//         <a
//           className="App-link"
//           href="https://reactjs.org"
//           target="_blank"
//           rel="noopener noreferrer"
//         >
//           Learn React
//         </a>
//       </header>
//     </div>
//   );
// }

// export default App;


import { useEffect, useState } from 'react';
import './App.css';

function App() {
  const [post, setPost] = useState(null);

  useEffect(() => {
    fetch('https://jsonplaceholder.typicode.com/posts/1') // ambil data postingan pertama
      .then(res => res.json())
      .then(data => setPost(data));
  }, []);

  if (!post) return <div>Loading...</div>;

  return (
    <div className="App" style={{ padding: '2rem', fontFamily: 'Arial' }}>
      <h1>Nasya Kemal Giffari</h1>
      <p><strong>ID:</strong> {post.id}</p>
      <p><strong>Judul:</strong> {post.title}</p>
      <p><strong>Isi:</strong> {post.body}</p>
    </div>
  );
}

export default App;



