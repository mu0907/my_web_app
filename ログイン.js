document.getElementById('loginForm').addEventListener('submit', async (e) => {
    e.preventDefault();
  
    const username = document.getElementById('loginUsername').value;
    const password = document.getElementById('loginPassword').value;
  
    const response = await fetch('/login', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ username, password })
    });
  
    const data = await response.json();
    if (response.ok) {
      alert('Login successful!');
      // 必要に応じてトークンをローカルストレージに保存
      // localStorage.setItem('token', data.token);
    } else {
      alert('Error: ' + data.error);
    }
  });