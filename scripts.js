let userData = {};

function sendCode() {
    const phone = document.getElementById('phone').value;
    if (phone.match(/^[0-9]{10,14}$/)) {
        userData.phone = phone;
        fetch('http://localhost:3000/send-code', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ phone })
        }).then(response => response.json())
          .then(data => {
              if (data.success) {
                  document.getElementById('verificationSection').style.display = 'block';
              } else {
                  alert('Erro ao enviar código. Tente novamente.');
              }
          });
    } else {
        alert('Por favor, insira um número de telefone válido.');
    }
}

document.getElementById('registerForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const username = document.getElementById('username').value;
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;
    const phone = userData.phone;
    const code = document.getElementById('verificationCode').value;

    fetch('http://localhost:3000/verify-code', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ phone, code })
    }).then(response => response.json())
      .then(data => {
          if (data.success) {
              fetch('http://localhost:3000/register', {
                  method: 'POST',
                  headers: {
                      'Content-Type': 'application/json'
                  },
                  body: JSON.stringify({ username, email, password, phone })
              }).then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Registrado com sucesso!');
                        window.location.href = "botoes.html";
                    } else {
                        alert('Erro ao registrar. Tente novamente.');
                    }
                });
          } else {
              alert('Código de verificação inválido.');
          }
      });
});

function cancel() {
    document.getElementById('registerForm').reset();
    document.getElementById('verificationSection').style.display = 'none';
    window.location.href = "index.html";
}

function login() {
    let username = document.getElementById("username").value;
    let password = document.getElementById("password").value;

    // Verificação simples do usuário e senha
    if (username === "seu_usuario" && password === "sua_senha") {
        // Se o login for bem-sucedido, redirecione para a página dos botões
        window.location.href = "botoes.html";
    } else {
        // Caso contrário, exiba uma mensagem de erro (pode ser melhorado)
        alert("Usuário ou senha incorretos. Tente novamente.");
    }
}

function redirectToRegister() {
    window.location.href = "registro.html";
}
