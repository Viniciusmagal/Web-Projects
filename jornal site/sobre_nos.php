<?php
    date_default_timezone_set('America/Sao_Paulo');
    include 'nav.php';
    ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 40px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border: 2px solid #0a51ae; 
        }
        h1 {
            color:  #088c39;
            margin-top: 0;
            margin-bottom: 30px;
            font-size: 24px;
        }
        .logosobre {
            max-width: 200px;
            margin-bottom: 20px;
        }
        @media (max-width: 600px) {
            .container {
                max-width: 300px;
                padding: 20px;
            }

            h1 {
                font-size: 20px;
            }
        }
    </style>
</head>
<body style="overflow-x: hidden;">
    <div class="container">
        <img src="Imagens/logo.png" alt="Logo do Site" class="logosobre">
        <div class="sobre"></div>
        <h1 >Bem-vindo à ETEC!</h1>
        <br> <br>
        <h2>Nossa História:</h2>

        <p>
        Desde a nossa fundação, a ETEC tem sido um farol de excelência educacional e profissionalização, iluminando o caminho para um futuro promissor. Com uma trajetória enriquecida por décadas de dedicação ao ensino técnico de qualidade, nos orgulhamos de ser uma referência no cenário educacional da cidade de Atibaia.
        </p>
        <h2> Nossa Missão:</h2>
        <p>
        Na ETEC, nossa missão é clara e inspiradora: proporcionar aos nossos alunos as ferramentas necessárias para alcançar seus objetivos profissionais e pessoais. Através de um ambiente de aprendizado inovador e dinâmico, combinado com um corpo docente altamente qualificado, buscamos capacitar nossos estudantes a se tornarem líderes em suas respectivas áreas, preparando-os para os desafios e oportunidades do mundo moderno.
        </p>
        <h2>Nossos Valores:</h2>
        <p>
        Acreditamos em valores fundamentais que guiam nossas ações diárias:
        <p>
1. Excelência Acadêmica: Buscamos incessantemente a excelência em todos os aspectos do nosso trabalho, desde o planejamento curricular até a execução das aulas e atividades práticas.
</p><p>
2. Inovação: Abraçamos a mudança e a inovação como catalisadores do crescimento e do aprimoramento contínuo. Estamos comprometidos em estar na vanguarda das tendências educacionais e tecnológicas.
</p><p>
3. Respeito e Diversidade: Celebramos a diversidade de nossos alunos e funcionários, promovendo um ambiente inclusivo e respeitoso, onde cada indivíduo é valorizado e reconhecido.
</p><p>
4. Comprometimento Social: Reconhecemos nossa responsabilidade para com a sociedade e nos esforçamos para contribuir positivamente, formando cidadãos conscientes, éticos e socialmente responsáveis.        </p>  

<h2>Nossos Cursos:</h2>
<p>Oferecemos uma variedade de cursos técnicos que abrangem diversas áreas do conhecimento, desde tecnologia da informação, administração e saúde. Nossos programas acadêmicos são cuidadosamente desenvolvidos para atender às demandas do mercado de trabalho e proporcionar aos nossos alunos as habilidades necessárias para se destacarem em suas carreiras.
</p>
<p>Estamos entusiasmados em receber você na família ETEC e compartilhar essa jornada emocionante de aprendizado e crescimento. Junte-se a nós e faça parte de uma comunidade dedicada à excelência, inovação e sucesso.</p>
<p>Seja bem-vindo à ETEC - preparando líderes, moldando futuros!
</p>
<p>Atenciosamente,</p>
<h3> <span style="color:  #088c39;">ETEC</span></h3>
</div>
<?php include 'rodape.php'?>
</body>
</html>
