<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Aprovado</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #28a745;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }

        .content {
            background-color: #f9f9f9;
            padding: 30px;
            border: 1px solid #ddd;
            border-top: none;
            border-radius: 0 0 5px 5px;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>🎉 Parabéns!</h1>
    </div>
    <div class="content">
        <p>Olá, <strong>{{ $associado->nome }}</strong>!</p>

        <p>Temos o prazer de informar que seu cadastro na <strong>{{ config('app.name') }}</strong> foi
            <strong>aprovado</strong>!</p>

        <p>A partir de agora, você já pode acessar todos os benefícios e serviços disponíveis para nossos associados.
        </p>

        <p>Em caso de dúvidas, entre em contato conosco através dos nossos canais de atendimento.</p>

        <p>Seja bem-vindo(a)!</p>

        <p style="margin-top: 30px;">
            <strong>Atenciosamente,</strong><br>
            Equipe {{ config('app.name') }}
        </p>
    </div>
    <div class="footer">
        <p>Este é um e-mail automático. Por favor, não responda.</p>
        <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.</p>
    </div>
</body>

</html>