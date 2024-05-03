

```markdown
# Projeto de Envio de Email com PHPMailer

Este projeto demonstra a implementação de um sistema de envio de e-mails usando PHPMailer com SMTP. Ele permite que um formulário web colete dados do usuário e envie essas informações via e-mail usando um servidor SMTP configurado.

## Requisitos

- PHP 7.2 ou superior
- Composer para gerenciamento de dependências
- Acesso a um servidor SMTP (como Gmail, SendGrid, etc.)

## Instalação do Composer

O Composer é uma ferramenta para gerenciamento de dependências em PHP que permite declarar as bibliotecas das quais seu projeto depende e as gerencia para você.

### Instalação no Windows:

1. Baixe o instalador do Composer [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe).
2. Execute o instalador e siga as instruções para instalar o Composer.

### Instalação no Linux e macOS:

1. Abra o terminal e execute o seguinte comando:
   ```bash
   php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
   php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e382ee0e602f8688c37cd670abba807da3d950cfe30a036d7abf') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
   php composer-setup.php
   php -r "unlink('composer-setup.php');"
   ```

2. Você pode mover o composer.phar para um diretório que está no seu PATH para uso global:
   ```bash
   mv composer.phar /usr/local/bin/composer
   ```

## Uso do PHPMailer

O PHPMailer é uma biblioteca de envio de e-mails que suporta vários protocolos de e-mail, incluindo SMTP. É altamente recomendável usar SMTP para enviar e-mails devido à autenticação necessária que melhora a segurança e aumenta a probabilidade de seus e-mails serem entregues corretamente.

### Instalando PHPMailer via Composer

No diretório do seu projeto, execute o seguinte comando:
```bash
composer require phpmailer/phpmailer
```

## Configuração

1. Configure as informações de SMTP no arquivo `envia_email.php`, incluindo host, porta, usuário e senha.
2. Ajuste os campos necessários no formulário HTML conforme o seu cenário.

## Uso

Para usar o aplicativo, basta acessar o formulário HTML, preencher os dados e submeter. Os dados serão então enviados para o e-mail configurado via SMTP.

## Contribuições

Contribuições são sempre bem-vindas! Para contribuir, faça um fork do repositório, crie uma branch para sua feature, faça as alterações e envie um pull request.
```

### Explicação do Conteúdo

- **Requisitos**: Define o ambiente necessário para o projeto, incluindo a versão do PHP e a necessidade do Composer.
- **Instalação do Composer**: Instruções detalhadas sobre como instalar o Composer em diferentes sistemas operacionais.
- **Uso do PHPMailer**: Explica como instalar o PHPMailer através do Composer, que é essencial para o envio de e-mails neste projeto.
- **Configuração**: Breve descrição de como configurar o servidor SMTP e ajustar o formulário para uso.
- **Uso**: Descrição de como operar o sistema uma vez configurado.
- **Contribuições**: Encoraja outros desenvolvedores a contribuir com o projeto.

