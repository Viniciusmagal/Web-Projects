<?php include 'nav.php';?>
<link rel="shortcut icon" href="icone/logo.ico" type="image/x-icon" />
<style>
  body {
    overflow-x: hidden;
  }
  .contato-form {
    max-width: 400px;
    margin: 25px auto; 
    background-color: #f5f5f5;
    padding: 40px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 10px; 
    border: 2px solid #0a51ae; 

  }
  
  .contato-form h2 {
  font-size: 1.5rem; 
  margin-bottom: 2rem;
  color: #333;
  text-transform: uppercase;
  font-weight: bold;
  text-align: center;
  }
  
  .contato-form label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
    text-align: left;
    color: #333;
    font-size: 14px;
    text-transform: uppercase;
  }
  
  .contato-form input[type="text"],
  .contato-form input[type="email"],
  .contato-form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 20px;
    border: none;
    border-bottom: 1px solid #ccc;
    background-color: transparent;
    font-family: Arial, sans-serif;
    font-size: 14px;
    transition: border-color 0.3s;
  }
  
  .contato-form input[type="text"]:focus,
  .contato-form input[type="email"]:focus,
  .contato-form textarea:focus {
    border-color: #666;
  }
  
  .contato-form textarea {
    height: 120px;
  }
  
  .contato-form button {
    background-color: #0a51ae;
    color: white;
    padding: 12px 24px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-family: Arial, sans-serif;
    font-size: 0.9rem;   
   text-transform: uppercase;
    transition: background-color 0.3s;
    width: 100%;
  }
  
  .contato-form button:hover {
    background-color: #0056b3;
  }
  
  .logocontato {
    text-align: center;
    margin-bottom: 20px;
  }
  
  .logocontato img {
    max-width: 200px;
    height: auto;
  }
  /* Estilos para tornar o formulário responsivo */
  @media (max-width: 600px) {
    .contato-form {
      max-width: 100%;
      padding: 20px;
    }
  }

  /* Estilos responsivos */
@media (max-width: 600px) {
  .contato-form {
    padding: 10px; /* Padding menor para telas pequenas */
  }

  .contato-form h2 {
    font-size: 1.2rem; /* Tamanho de fonte menor para telas pequenas */
  }

  .contato-form input[type="text"],
  .contato-form input[type="email"],
  .contato-form textarea {
    font-size: 0.9rem; /* Tamanho de fonte menor para inputs em telas pequenas */
  }

  .contato-form button {
    padding: 10px 20px; /* Padding menor para o botão */
  }
}

@media (max-width: 400px) {
  .contato-form {
    width: 95%; /* Permita um pouco mais de largura para telas muito pequenas */
    padding: 15px; /* Padding ainda menor para telas muito pequenas */
  }
}
</style>

<script>
function validateEmail() {
  var emailInput = document.getElementById('email');
  var email = emailInput.value;
  
  if (!email.includes('@')) {
    alert('Seu email deve conter o símbolo "@"');
    return false;
  }
  
  return true;
}
</script>

<div class="contato-form">
  <div class="logocontato">
    <img src="imagens/logo.png" alt="Logo da Empresa">
  </div>
  <h2>Entre em Contato</h2>
  <form action="https://formsubmit.co/contatojornaletec@gmail.com" method="POST" onsubmit="return validateEmail();">
    <label for="nome">Nome:</label>
    <input type="text" name="name" placeholder="Digite seu nome" required>
    
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Digite seu email" required>
    
    <label for="message">Mensagem:</label>
    <textarea id="message" name="message" placeholder="Digite sua mensagem" rows="6" required></textarea>
    
    <button type="submit">Enviar Mensagem</button>
  </form>
</div>
<?php include 'rodape.php';?>